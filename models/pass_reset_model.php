<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadEmployees') {
        $query = "SELECT
                  employee.emp_id,
                  CONCAT_WS(' / ',`name`,nic,mobile) AS emp_details,
                  CONCAT_WS('/',`name`,nic,mobile) AS emp_details_for_set
                  FROM `employee`
                  WHERE
                  employee.emp_status = 1";
        $data = $app->basic_Select_Query($query);
        $employee = '';
        $options = '';
        $employee .= '<option disabled selected value="">Select employee</option>';
        foreach ($data AS $x) {
            $options .= '<option value="' . $x['emp_id'] . '~' . $x['emp_details_for_set'] . '">' . $x['emp_details'] . '</option>';
        }
        echo $employee;
        echo $options;
    } elseif ($_POST['action'] == 'resetPassword') {
        $newPass = rand(100000,999999);
        $encryptedPassword = $app->password_encrypt($newPass);
        $query = "UPDATE `employee` SET `password` = '{$encryptedPassword}' WHERE `emp_id` = '{$_POST['empId']}'";
        $result = $app->basic_command_query($query);
        if($result){
            echo $newPass;
        } else {
            echo 0;
        }
    }
}
