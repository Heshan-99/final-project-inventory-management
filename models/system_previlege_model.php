<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadEmployees') {
        $query = "SELECT
                  employee.emp_id,
                  CONCAT_WS(' / ',`name`,nic,mobile) AS emp_details
                  FROM `employee`
                  WHERE
                  employee.emp_status = 1";
        $data = $app->basic_Select_Query($query);
        $employee = '';
        $options = '';
        $employee .= '<option disabled selected value="">Select employee</option>';
        foreach ($data AS $x) {
            $options .= '<option value="' . $x['emp_id'] . '">' . $x['emp_details'] . '</option>';
        }
        echo $employee;
        echo $options;
    } elseif ($_POST['action'] == 'loadAvaiPrevilege') {
        $query = "SELECT
                  ims_system_privileges.priv_id,
                  ims_system_privileges.priv_name
                  FROM `ims_system_privileges`
                  WHERE
                  ims_system_privileges.priv_type != 0 AND
                  ims_system_privileges.priv_status = 1 AND
                  ims_system_privileges.priv_id NOT IN (SELECT
                  ims_assigned_privileges.priv_id
                  FROM `ims_assigned_privileges`
                  WHERE
                  ims_assigned_privileges.emp_id = '{$_POST['empId']}')";
        $data = $app->basic_Select_Query($query);
        $options = '';
        foreach ($data AS $x) {
            $options .= '<option value="' . $x['priv_id'] . '">' . $x['priv_name'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'loadAssignedPrevilege') {
        $query = "SELECT
                  ims_assigned_privileges.priv_id,
                  ims_system_privileges.priv_name
                  FROM
                  ims_assigned_privileges
                  INNER JOIN ims_system_privileges ON ims_assigned_privileges.priv_id = ims_system_privileges.priv_id
                  WHERE
                  ims_assigned_privileges.emp_id = '{$_POST['empId']}'";
        $data = $app->basic_Select_Query($query);
        $options = '';
        foreach ($data AS $x) {
            $options .= '<option value="' . $x['priv_id'] . '">' . $x['priv_name'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'custAssignPrevilege') {
        $selectedPrvId = $_POST['selectedPrvId'];
        foreach ($selectedPrvId AS $x) {
            $query = "INSERT INTO `ims_assigned_privileges` (`emp_id`, `priv_id`) VALUES ('{$_POST['empId']}', '{$x}');";
            $app->basic_command_query($query);
        }
        echo 1;
    } elseif ($_POST['action'] == 'custRemovePrevilege') {
        $selectedPrvId = $_POST['selectedPrvId'];
        foreach ($selectedPrvId AS $x) {
            $query = "DELETE FROM `ims_assigned_privileges` WHERE (`emp_id`='{$_POST['empId']}') AND (`priv_id`='{$x}')";
            $app->basic_command_query($query);
        }
        echo 1;
    } elseif ($_POST['action'] == 'allRemovePrevilege') {
        $query = "DELETE FROM `ims_assigned_privileges` WHERE (`emp_id`='{$_POST['empId']}')";
        $app->basic_command_query($query);
        echo 1;
    } elseif ($_POST['action'] == 'allAssignPrevilege') {
        $query = "SELECT
                  ims_system_privileges.priv_id
                  FROM `ims_system_privileges`
                  WHERE
                  ims_system_privileges.priv_type != 0 AND
                  ims_system_privileges.priv_status = 1 AND
                  ims_system_privileges.priv_id NOT IN (SELECT
                  ims_assigned_privileges.priv_id
                  FROM `ims_assigned_privileges`
                  WHERE
                  ims_assigned_privileges.emp_id = '{$_POST['empId']}')";
        $data = $app->basic_Select_Query($query);
        foreach ($data AS $x) {
            $query = "INSERT INTO `ims_assigned_privileges` (`emp_id`, `priv_id`) VALUES ('{$_POST['empId']}', '{$x['priv_id']}');";
            $app->basic_command_query($query);
        }
        echo 1;
    }
}