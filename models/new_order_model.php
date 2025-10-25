<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadCakeTypes') {
        $query = "SELECT cake.id,CONCAT_WS(' / ',occasion,`name`) AS cakeName ,cake.price,cake.weight FROM cake WHERE cake.cake_status=1;";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0" disabled selected value="0">Select a cake type</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['id'] . '~' . $x['price'] . '~' . $x['weight'] . '">' . $x['cakeName'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'getOrderNo') {
        $query = "SELECT
                ims_user_wise_order_number.order_no
                FROM
                ims_user_wise_order_number
                WHERE
                ims_user_wise_order_number.user_id = '{$_SESSION['emp_id']}' AND
                ims_user_wise_order_number.`status` = '0'";
        $count = $app->row_count_query($query);
        $orderNO = '';
        if ($count == 1) {
            $data = $app->basic_Select_Query($query);
            $orderNO = $data[0]['order_no'];
        } else {
            $q2 = "SELECT IFNULL(MAX(ims_user_wise_order_number.order_no)+1,1) AS orderNo FROM ims_user_wise_order_number";
            $data2 = $app->basic_Select_Query($q2);
            $q3 = "INSERT INTO `ims_user_wise_order_number` (`user_id`, `order_no`, `status`) 
                    VALUES ('{$_SESSION['emp_id']}', '{$data2[0]['orderNo']}', 0);";
            $app->basic_command_query($q3);
            $orderNO = $data2[0]['orderNo'];
        }
        echo 'OR00' . $orderNO;
    } elseif ($_POST['action'] == 'addCakeToOrderSummary') {
        $query = "INSERT INTO `ims_order_cake_details` (`order_no`, `order_cake_id`, `qty`, `order_cake_weight`, `order_spl_note`) VALUES ('{$_POST['orderNo']}','{$_POST['x']}', '{$_POST['quantity']}', '{$_POST['weight']}', '{$_POST['splNote']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedCakesDetailsForOrder') {
        $query = "SELECT
                ims_order_cake_details.qty, 
                ims_order_cake_details.order_cake_weight, 
                CONCAT_WS( ' / ', occasion, `name` ) AS cakeName, 
                ims_order_cake_details.order_cake_table_id, 
                cake.price
                FROM
                ims_order_cake_details
                INNER JOIN
                cake
                ON 
                ims_order_cake_details.order_cake_id = cake.id
                WHERE
                ims_order_cake_details.order_no = '{$_POST['orderNo']}'
                ORDER BY
                ims_order_cake_details.order_cake_table_id DESC";
        $totalAmount = 0;
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $totalAmount += $x['price'] * $x['qty'];
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['cakeName'] . '</td>';
            $tblData .= '<td>' . $x['order_cake_weight'] . '</td>';
            $tblData .= '<td>' . $x['qty'] . '</td>';
            $tblData .= '<td>' . $x['price'] * $x['qty'] . '</td>';
            $tblData .= '<td><button class="my-del-btn delete" type="button"  value="' . $x['order_cake_table_id'] . '">Remove</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData . '~' . $totalAmount;
    } elseif ($_POST['action'] == 'removeAddedCake') {
        $query = "DELETE FROM `ims_order_cake_details` WHERE (`order_cake_table_id`='{$_POST['cakeId']}')";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadCustomers') {
        $query = "SELECT
                  customer.id,
                  CONCAT_WS(' / ',`name`,mobile) AS cust_details
                  FROM `customer`
                  WHERE
                  customer.cus_status = 1";
        $data = $app->basic_Select_Query($query);
        $customer = '';
        $options = '';
        $customer .= '<option selected value="0">Select customer</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['id'] . '" >' . $x['cust_details'] . '</option>';
        }
        echo $customer;
        echo $options;
    } elseif ($_POST['action'] == 'completeOrder') {
        $query = "INSERT INTO `ims_order_summary` (`order_no`, `order_cust_id`, `order_total`, `order_req_date`, `order_paid_amt`, `order_balance_amt`, `order_system_user`) VALUES ('{$_POST['orderNo']}','{$_POST['custId']}', '{$_POST['orderAmount']}', '{$_POST['reqDate']}', '{$_POST['advancedAmount']}', '{$_POST['balanceAmount']}', '{$_SESSION['emp_id']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            $q2 = "UPDATE `ims_user_wise_order_number` SET `status` = 1 WHERE `user_id` = '{$_SESSION['emp_id']}'";
            $app->basic_command_query($q2);
            echo 1;
        } else {
            echo 0;
        }
    }
}



