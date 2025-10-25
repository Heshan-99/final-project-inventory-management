<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAddedOrderTable') {
        $statusType = $_POST['status'];
        if ($statusType != '99') {
            $q = 'AND ims_order_summary.order_status = "' . $_POST['status'] . '"';
        } else {
            $q = '';
        }
        $query = "SELECT
           	ims_order_summary.order_table_id,
                ims_order_summary.order_no, 
                ims_order_summary.order_total, 
                ims_order_summary.order_req_date, 
                DATE_FORMAT(ims_order_summary.order_date_time, '%Y-%m-%d') AS orderDate, 
                ims_order_summary.order_paid_amt, 
                ims_order_summary.order_balance_amt, 
                ims_order_summary.order_balance_amt, 
                if(order_status = 0,'Pending', if(order_status = 1,'Processing', if(order_status = 2,'Order Completed', if(order_status = 3,'Payment Completed', if(order_status = 5 ,'Cancelled', 'Delivered'))))) AS orderStatus, 
                customer.`name`,
                ims_order_summary.order_status
                FROM
                ims_order_summary
                INNER JOIN
                customer
                ON 
                ims_order_summary.order_cust_id = customer.id
                WHERE
                (LOWER(ims_order_summary.order_no) LIKE LOWER('%{$_POST['search']}%') OR
                LOWER(customer.`name`) LIKE LOWER('{$_POST['search']}%') OR
                LOWER(customer.mobile) LIKE LOWER('{$_POST['search']}%')) " . $q . " ORDER BY ims_order_summary.order_table_id DESC LIMIT 8;";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data AS $x) {
            if ($x['order_status'] == 0) {
                $tblData .= '<tr style="background-color:#adc8ff">';
            } elseif ($x['order_status'] == 1) {
                $tblData .= '<tr style="background-color:#fff8ad">';
            } elseif ($x['order_status'] == 2) {
                $tblData .= '<tr style="background-color:#ffc676">';
            } elseif ($x['order_status'] == 3) {
                $tblData .= '<tr style="background-color:#cbffb8">';
            } elseif ($x['order_status'] == 4) {
                $tblData .= '<tr style="background-color:#75ff67">';
            } elseif ($x['order_status'] == 5) {
                $tblData .= '<tr style="background-color:#f85959">';
            }
            $tblData .= '<td>' . $x['order_no'] . '</td>';
            $tblData .= '<td>' . $x['name'] . '</td>';
            $tblData .= '<td>' . $x['order_total'] . '</td>';
            $tblData .= '<td>' . $x['order_paid_amt'] . '</td>';
            $tblData .= '<td>' . $x['order_balance_amt'] . '</td>';
            $tblData .= '<td>' . $x['orderDate'] . '</td>';
            $tblData .= '<td>' . $x['order_req_date'] . '</td>';
            $tblData .= '<td>' . $x['orderStatus'] . '</td>';
            if ($x['order_status'] == 0) {
                $tblData .= '<td><button class="my-del-btn cancel" value="' . $x['order_table_id'] . '">Cancel</button><button class="my-del-btn pro" value="' . $x['order_table_id'] . '">Processing</button></td>';
            } elseif ($x['order_status'] == 1) {
                $tblData .= '<td><button class="my-remove-btn com" value="' . $x['order_table_id'] . '">Completed</button></td>';
            } elseif ($x['order_status'] == 2) {
                $tblData .= '<td><button class="rollback" value="' . $x['order_table_id'] . '"><</button><button class="my-detail-btn pay" value="' . $x['order_table_id'] . '">Paid</button></td>';
            } elseif ($x['order_status'] == 3) {
                $tblData .= '<td><button class="rollback" value="' . $x['order_table_id'] . '"><</button><button class="my-save-btn del" value="' . $x['order_table_id'] . '">Delivered</button></td>';
            } elseif ($x['order_status'] == 4) {
                $tblData .= '<td><button class="rollback" value="' . $x['order_table_id'] . '"><</button>Completed</td>';
            } elseif ($x['order_status'] == 5) {
                $tblData .= '<td>Cancelled</td>';
            }

            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'changeStatus') {
        $query = "UPDATE `ims_order_summary` SET `order_status` = '{$_POST['status']}' WHERE `order_table_id` = '{$_POST['id']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            $cusContact = "";
            if ($_POST['status'] == 2) {
                $q = "SELECT
                customer.mobile, 
	            customer.`name`, 
	            ims_order_summary.order_no
                FROM
                ims_order_summary
                INNER JOIN
                customer
                ON 
                ims_order_summary.order_cust_id = customer.id
                WHERE
                ims_order_summary.order_table_id = '{$_POST['id']}'";
                $contact = $app->basic_Select_Query($q);
                $cusContact = $contact[0]['mobile'] . "~" . $contact[0]['name'] . "~" . $contact[0]['order_no'];
                echo 1 . "~" . $cusContact;
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'updateStock') {
        $q1 = "SELECT
                ims_order_cake_details.order_cake_id, 
                ims_order_cake_details.qty, 
                ims_cake_config_details.item_id, 
                (ims_cake_config_details.usage_qty*ims_order_cake_details.qty) AS useQty
                FROM
                ims_order_summary
                INNER JOIN
                ims_order_cake_details
                ON 
                ims_order_summary.order_no = ims_order_cake_details.order_no
                INNER JOIN
                ims_cake_config_details
                ON 
                ims_order_cake_details.order_cake_id = ims_cake_config_details.cake_id
                WHERE
                ims_order_summary.order_table_id = '{$_POST['orderTblID']}'";
        $data = $app->basic_Select_Query($q1);
        foreach ($data AS $x) {
            $q2 = "UPDATE `ims_main_stock_summary` 
                    SET
                    `item_qty` = `item_qty` - '{$x['useQty']}',
                    `item_last_issue_qty` = '{$x['useQty']}',
                    `item_last_issue_date_time` = NOW(),
                    `item_last_update_user_id` = '{$_SESSION['emp_id']}'
                    WHERE
                    `item_id` = '{$x['item_id']}';";
            $app->basic_command_query($q2);
        }
        echo 1;
    } elseif ($_POST['action'] == 'rollbackStatus') {
        $query = "UPDATE `ims_order_summary`
                    SET `order_status` = GREATEST(`order_status` - 1, 0)
                    WHERE `order_table_id` = '{$_POST['id']}'";
        $app->basic_command_query($query);
        echo 1;
    } elseif ($_POST['action'] == 'cancelOrder') {
        $query = "UPDATE `ims_order_summary` SET `order_status` = 5 WHERE `order_table_id` = '{$_POST['id']}'";
        $app->basic_command_query($query);
        echo 1;
    }
}