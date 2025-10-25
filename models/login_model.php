<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'systemLogin') {
        $encryptedPassword = $app->password_encrypt($_POST['password']);
        $username = $_POST['username'];
        $query = "SELECT
                  employee.emp_id,
                  employee.`name`,
                  employee.designation,
                  employee.`photo`
                  FROM `employee`
                  WHERE
                  employee.`password` = '{$encryptedPassword}' AND
                  employee.nic = '{$username}' AND
                  employee.emp_status = 1;";
        $count = $app->row_count_query($query);
        if ($count == 1) {
            $data = $app->basic_Select_Query($query);
            $_SESSION['emp_id'] = $data[0]['emp_id'];
            $_SESSION['name'] = $data[0]['name'];
            $_SESSION['designation'] = $data[0]['designation'];
            $_SESSION['photo'] = $data[0]['photo'];
            echo 1;
        } else {
            echo 0;
        }
    } else if ($_POST['action'] == 'system_logout') {
        unset($_SESSION['emp_id']);
        unset($_SESSION['name']);
        unset($_SESSION['designation']);
        unset($_SESSION['photo']);
        echo 1;
    } elseif ($_POST['action'] == 'changePassword') {
        $oldEncripted = $app->password_encrypt($_POST['oldPass']);
        $q1 = "SELECT 
               employee.emp_id 
               FROM employee 
               WHERE employee.`password`='{$oldEncripted}' AND 
               employee.emp_id='{$_SESSION['emp_id']}'";
        $count = $app->row_count_query($q1);
        if ($count == 1) {
            $newEncripted = $app->password_encrypt($_POST['newPass']);
            $q2 = "UPDATE `employee` SET `password` = '{$newEncripted}' WHERE `emp_id` = '{$_SESSION['emp_id']}'";
            $app->basic_command_query($q2);
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'getLowItems') {
        $query = "SELECT 
                ims_main_stock_summary.item_qty, 
                ims_item_details.reorder_level
                FROM
                ims_item_details
                INNER JOIN
                ims_main_stock_summary
                ON 
                ims_item_details.item_id = ims_main_stock_summary.item_id";
        $data = $app->basic_Select_Query($query);
        $count = 0;
        foreach ($data AS $x) {
            if ($x['reorder_level'] != 0) {
                if ($x['item_qty'] <= $x['reorder_level']) {
                    $count++;
                }
            }
        }
        echo $count;
    }
}