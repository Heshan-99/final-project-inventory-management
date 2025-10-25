<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAddedItems') {
        $query = "SELECT
                  CONCAT_WS(' - ',`code`,`name`) AS itemName, 
                  ims_outlet_stock_details.outlet_item_qty, 
                  ims_outlet_stock_details.outlet_item_exp_date, 
                  ims_outlet_stock_details.outlet_item_id, 
                  cake.price
                  FROM
                  ims_outlet_stock_details
                  INNER JOIN
                  cake
                  ON 
                  ims_outlet_stock_details.outlet_item_id = cake.id
                  WHERE
                  cake.`code` LIKE '{$_POST['search']}%' OR
                  cake.`name` LIKE '{$_POST['search']}%'";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        $index = 1;
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['itemName'] . '</td>';
            $tblData .= '<td>' . $x['price'] . '</td>';
            $tblData .= '<td>' . $x['outlet_item_exp_date'] . '</td>';
            $tblData .= '<td>' . $x['outlet_item_qty'] . '</td>';
            $tblData .= '<td style="width: 100px"x"><button class="my-save-btn select select" id="itm_' . $index . '" type="button" value="' . $x['outlet_item_id'] . '~' . $x['itemName'] . '~' . $x['price'] . '~' . $x['outlet_item_qty'] . '">Select</button></td>';
            $tblData .= '</tr>';
            $index++;
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'addItemToLog') {
        $query = "INSERT INTO `ims_outlet_bill_item_details` (`item_id`, `item_qty`, `item_total`, `bill_no`) VALUES ('{$_POST['item_id']}','{$_POST['itemQuantity']}','{$_POST['itemTotal']}','{$_POST['billNo']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            $q2 = "UPDATE `ims_outlet_stock_details` SET `outlet_item_qty`=`outlet_item_qty`-'{$_POST['itemQuantity']}' WHERE `outlet_item_id` = '{$_POST['item_id']}'";
            $stockResult = $app->basic_command_query($q2);
            if ($stockResult) {
//                echo 1;
            } else {
                echo 0;
            }
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadItemToBill') {
        $query = "SELECT
	          CONCAT_WS(' / ',`name`,`code`) AS itemName, 
	          ims_outlet_bill_item_details.item_qty, 
	          ims_outlet_bill_item_details.item_total, 
	          ims_outlet_bill_item_details.bill_item_table_id
                  FROM          
	          ims_outlet_bill_item_details
	          INNER JOIN
	          cake
	          ON 
		  ims_outlet_bill_item_details.item_id = cake.id
                  WHERE
                  ims_outlet_bill_item_details.bill_no = '{$_POST['billNo']}'";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['itemName'] . '</td>';
            $tblData .= '<td>' . $x['item_qty'] . '</td>';
            $tblData .= '<td>' . $x['item_total'] . '</td>';
            $tblData .= '<td style="width: 100px; text-align: center"><button class="my-del-btn remove" type="button" value="' . $x['bill_item_table_id'] . '">-</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'getBillNo') {
        $query = "SELECT
                ims_user_wise_outlet_bill_number.bill_no
                FROM
                ims_user_wise_outlet_bill_number
                WHERE
                ims_user_wise_outlet_bill_number.user_id = '{$_SESSION['emp_id']}' AND
                ims_user_wise_outlet_bill_number.`status` = '0'";
        $count = $app->row_count_query($query);
        $billNo = '';
        if ($count == 1) {
            $data = $app->basic_Select_Query($query);
            $billNo = $data[0]['bill_no'];
        } else {
            $q2 = "SELECT IFNULL(MAX(ims_user_wise_outlet_bill_number.bill_no)+1,1) AS bill_no FROM ims_user_wise_outlet_bill_number";
            $data2 = $app->basic_Select_Query($q2);
            $q3 = "INSERT INTO `ims_user_wise_outlet_bill_number` (`user_id`, `bill_no`, `status`) VALUES ('{$_SESSION['emp_id']}', '{$data2[0]['bill_no']}', 0);";
            $app->basic_command_query($q3);
            $billNo = $data2[0]['bill_no'];
        }
        echo $billNo;
    } elseif ($_POST['action'] == 'getBillTotal') {
        $query = "SELECT SUM(item_total) AS grandTot FROM ims_outlet_bill_item_details WHERE ims_outlet_bill_item_details.bill_no='{$_POST['billNo']}'";
        $data = $app->basic_Select_Query($query);
        echo $data[0]['grandTot'];
    } elseif ($_POST['action'] == 'removeAddedItem') {
        $q1 = "SELECT
                ims_outlet_bill_item_details.item_id, 
                ims_outlet_bill_item_details.item_qty
                FROM
                ims_outlet_bill_item_details
                WHERE
                ims_outlet_bill_item_details.bill_item_table_id = '{$_POST['removeId']}'";
        $data = $app->basic_Select_Query($q1);
        $q2 = "UPDATE `ims_outlet_stock_details`
                SET `outlet_item_qty`=`outlet_item_qty` + '{$data[0]['item_qty']}' WHERE `outlet_item_id`='{$data[0]['item_id']}'";
        $result = $app->basic_command_query($q2);
        if ($result) {
            $query = "DELETE FROM `ims_outlet_bill_item_details` WHERE `bill_item_table_id` = '{$_POST['removeId']}'";
            $app->basic_command_query($query);
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'finishBill') {
        $query = "INSERT INTO `ims_outlet_bill_summary` (`outlet_bill_no`, `outlet_bill_amt`, `outler_bill_user_id`, `paid_amt`, `balance_amt`) VALUES ('{$_POST['billNo']}', '{$_POST['grandTotal']}', '{$_SESSION['emp_id']}', '{$_POST['paidamt']}', '{$_POST['balanceamt']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            $q1 = "UPDATE `ims_user_wise_outlet_bill_number` SET `status` = 1 WHERE `user_id` = '{$_SESSION['emp_id']}' AND `bill_no` = '{$_POST['billNo']}' AND `status` = 0";
            $app->basic_command_query($q1);
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'resetBill') {
        $query = "DELETE FROM `ims_outlet_bill_item_details` WHERE `bill_no` = '{$_POST['billNo']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
