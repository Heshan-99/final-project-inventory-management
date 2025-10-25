<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadOrderNumber') {
        $query = "SELECT
                ims_order_summary.order_table_id, 
                ims_order_summary.order_no
                FROM
                ims.ims_order_summary";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select order number</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['order_table_id'] . '">' . $x['order_no'] . '</option>';
        }
        echo $options;
    } else if ($_POST['action'] == 'getOrderSummary') {
        $q2 = "SELECT
                customer.cusCode, 
                customer.title, 
                customer.`name`, 
                ims_order_summary.order_total, 
                DATE_FORMAT(ims_order_summary.order_date_time,'%Y-%m-%d') AS orderDate, 
                ims_order_summary.order_req_date, 
                ims_order_summary.order_paid_amt, 
                ims_order_summary.order_balance_amt, 
                if(order_status = '0', 'Pending',if(order_status = '1', 'Processing',if(order_status = '2', 'Completed',if(order_status = '3', 'Payment completed',if(order_status = '4', 'Delivered','Cancelled'))))) AS orderStatus
                FROM
                ims_order_summary
                LEFT JOIN
                customer
                ON 
                ims_order_summary.order_cust_id = customer.id
                WHERE
                ims_order_summary.order_table_id = '{$_POST['orderNo']}'";
        $app->json_encoded_select_query($q2);
    } else if ($_POST['action'] == 'fillFields') {
        $query = "SELECT
                    ims_order_cake_details.order_cake_table_id, 
                    ims_order_cake_details.order_no, 
                    CONCAT_WS(' - ',cake.`name`,cake.`code`) AS cakeName, 
                    ims_order_cake_details.qty, 
                    ims_order_cake_details.order_cake_weight, 
                    ims_order_cake_details.order_spl_note, 
                    customer.cusCode, 
                    customer.title, 
                    customer.`name`, 
                    ims_order_summary.order_total, 
                    ims_order_summary.order_date_time, 
                    ims_order_summary.order_req_date, 
                    ims_order_summary.order_paid_amt, 
                    ims_order_summary.order_balance_amt, 
                    ims_order_summary.order_status
                    FROM
                    ims_order_cake_details
                    INNER JOIN
                    cake
                    ON 
                    ims_order_cake_details.order_cake_id = cake.id
                    LEFT JOIN
                    ims_order_summary
                    ON 
                    ims_order_cake_details.order_no = ims_order_summary.order_no
                    LEFT JOIN
                    customer
                    ON 
                    ims_order_summary.order_cust_id = customer.id
                    WHERE
                    ims_order_summary.order_table_id = '{$_POST['orderNo']}'";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['cakeName'] . '</td>';
            $tblData .= '<td>' . $x['qty'] . '</td>';
            $tblData .= '<td>' . $x['order_cake_weight'] . '</td>';
            $tblData .= '<td>' . $x['order_spl_note'] . '</td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    }
}