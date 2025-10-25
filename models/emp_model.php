<?php

//require_once '../others/class/comm_functions.php'; //file name invalid
require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'checkNic') {
        $query = "SELECT nic,employee.emp_id FROM employee WHERE employee.nic='{$_POST['nic']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } else if ($_POST['action'] == 'checkUpdateNic') {
        $query = "SELECT nic,employee.emp_id FROM employee WHERE employee.nic='{$_POST['nic']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'saveEmployee') {
        $encryptedPassword = $app->password_encrypt($_POST['password']);
        $query = "INSERT INTO `employee` "
            . "(`empCode`,`title`, `name`, `nic`, `dob`, `gender`, `mobile`, `land`, `address`, `email`, `designation`, `recdate`, `password`)"
            . "VALUES "
            . "('{$_POST['code']}','{$_POST['title']}', '{$_POST['name']}', '{$_POST['nic']}', '{$_POST['dob']}', '{$_POST['gender']}', '{$_POST['mobile']}', '{$_POST['land']}', '{$_POST['address']}', '{$_POST['email']}', '{$_POST['designation']}',  '{$_POST['recdate']}' , '{$encryptedPassword}');";
        $result = $app->command_query_with_lastInset_ID($query);
        if ($result != -1) {
            $_SESSION['empPhotoID'] = $result;
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedEmpTable') {
        $query = "SELECT
                  employee.emp_id,
                  employee.empCode,
                  CONCAT_WS(' ',title,`name`) AS empName,
                  employee.nic,
                  employee.dob,
                  employee.gender,
                  employee.mobile,
                  employee.land,
                  employee.address,
                  employee.email,
                  employee.designation,
                  employee.recdate
                  FROM `employee`
                  WHERE
                  employee.emp_status = 1 AND
                  (employee.`empCode` LIKE '%{$_POST['search']}%' OR
                  employee.`name` LIKE '%{$_POST['search']}%' OR
                  employee.address LIKE '%{$_POST['search']}%' OR
                  employee.mobile LIKE '{$_POST['search']}%' OR
                  employee.designation LIKE '{$_POST['search']}%' OR
                  employee.email LIKE '{$_POST['search']}%') ORDER BY employee.emp_id DESC LIMIT 15";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['empCode'] . '</td>';
            $tblData .= '<td>' . $x['empName'] . '</td>';
            $tblData .= '<td>' . $x['nic'] . '</td>';
            $tblData .= '<td>' . $x['mobile'] . '</td>';
            $tblData .= '<td>' . $x['address'] . '</td>';
            $tblData .= '<td>' . $x['email'] . '</td>';
            $tblData .= '<td>' . $x['designation'] . '</td>';
            $tblData .= '<td><button class="my-save-btn select" type="button" value="' . $x['emp_id'] . '">Select</button><button class="my-del-btn delete" type="button"  value="' . $x['emp_id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'get_emp_data_for_update') {
        $query = "SELECT
                  employee.empCode,
                  employee.title,
                  employee.`name`,
                  employee.nic,
                  employee.dob,
                  employee.gender,
                  employee.mobile,
                  employee.land,
                  employee.address,
                  employee.email,
                  employee.designation,
                  employee.recdate,
                  employee.photo
                  FROM `employee`
                  WHERE
                  employee.emp_id = '{$_POST['empID']}'";
        $app->json_encoded_select_query($query);
    } elseif ($_POST['action'] == 'update_emp_details') {
        $query = "UPDATE `employee` SET "
            . "`title` = '{$_POST['title']}', `name` = '{$_POST['name']}', `nic` = '{$_POST['nic']}', `dob` = '{$_POST['dob']}', `gender` = '{$_POST['gender']}', `mobile` = '{$_POST['mobile']}', `land` = '{$_POST['land']}', `address` = '{$_POST['address']}', `email` = '{$_POST['email']}', `designation` = '{$_POST['designation']}', `recdate` = '{$_POST['recdate']}' "
            . "WHERE (`emp_id` = '{$_POST['empID']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            $_SESSION['empPhotoID'] = $_POST['empID'];
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'delete_emp_record') {
//        $query = "UPDATE `employee` SET `emp_status`='0' WHERE (`emp_id`='{$_POST['empID']}')";
        $employeeId = $_POST['empID'];
        if($employeeId == $_SESSION['emp_id']){
            echo 2;
        }else {
            $query = "DELETE FROM `employee` WHERE (`emp_id`='{$_POST['empID']}')";
            $result = $app->basic_command_query($query);
            if ($result) {
                echo 1;
            } else {
                echo 0;
            }
        }

    } elseif ($_POST['action'] == 'getNextEmpCode') {
        $query = "SELECT IFNULL(MAX(emp_id)+1,'1') AS last_id FROM employee";
        $data = $app->basic_Select_Query($query);
        echo 'EM00' . $data[0]['last_id'];
    }
}
