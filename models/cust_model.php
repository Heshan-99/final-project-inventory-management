<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'checkEmail') {
        $query = "SELECT name,customer.id FROM customer WHERE customer.email='{$_POST['email']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'saveCustomer') {
        $query = "INSERT INTO `customer` "
            . "(`cusCode`,`title`, `name`, `address`, `mobile`, `email`)"
            . "VALUES "
            . "('{$_POST['code']}', '{$_POST['title']}', '{$_POST['name']}', '{$_POST['address']}', '{$_POST['mobile']}', '{$_POST['email']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddesCustTable') {
        $query = "SELECT
                  customer.id,
                  customer.cusCode,
                  CONCAT_WS(' ',title,`name`) AS cusName,
                  customer.address,
                  customer.mobile,
                  customer.email
                  FROM `customer`
                  WHERE
                  customer.cus_status = 1 AND
                  (LOWER(customer.`cusCode`) LIKE LOWER('%{$_POST['search']}%') OR
                   LOWER(customer.`name`) LIKE LOWER('%{$_POST['search']}%') OR
                   LOWER(customer.address) LIKE LOWER('%{$_POST['search']}%') OR
                   LOWER(customer.mobile) LIKE LOWER('{$_POST['search']}%') OR
                   LOWER(customer.email) LIKE LOWER('{$_POST['search']}%'))
                   ORDER BY customer.id DESC LIMIT 15";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['cusCode'] . '</td>';
            $tblData .= '<td>' . $x['cusName'] . '</td>';
            $tblData .= '<td>' . $x['address'] . '</td>';
            $tblData .= '<td>' . $x['mobile'] . '</td>';
            $tblData .= '<td>' . $x['email'] . '</td>';
            $tblData .= '<td><button class="my-save-btn select" type="button" value="' . $x['id'] . '">Select</button><button class="my-del-btn delete" type="button"  value="' . $x['id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'get_cus_data_for_update') {
        $query = "SELECT
                  customer.cusCode,
                  customer.title,
                  customer.`name`,
                  customer.address,
                  customer.mobile,
                  customer.email
                  FROM `customer`
                  WHERE
                  customer.id = '{$_POST['cusID']}'";
        $app->json_encoded_select_query($query);
    } elseif ($_POST['action'] == 'update_cust_details') {
        $query = "UPDATE `customer` SET "
            . "`title` = '{$_POST['title']}', `name` = '{$_POST['name']}', `address` = '{$_POST['address']}', `mobile` = '{$_POST['mobile']}', `email` = '{$_POST['email']}' "
            . "WHERE (`id` = '{$_POST['cusID']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'delete_cus_record') {
//        $query = "UPDATE `customer` SET `cus_status`='0' WHERE (`id`='{$_POST['cusID']}')";
        $query = "DELETE FROM `customer` WHERE (`id`='{$_POST['cusID']}')";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'getNextCusCode') {
        $query = "SELECT IFNULL(MAX(id)+1,'1') AS last_id FROM customer";
        $data = $app->basic_Select_Query($query);
        echo 'CU00' . $data[0]['last_id'];
    }
}