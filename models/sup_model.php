<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'checkName') {
        $query = "SELECT sup_name,ims_supplier.sup_id FROM ims_supplier WHERE ims_supplier.sup_name='{$_POST['name']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'saveSupplier') {
        $query = "INSERT INTO `ims_supplier` "
            . "(`supCode`,`sup_title`, `sup_name`, `sup_address`, `sup_mobile`, `sup_email`)"
            . "VALUES "
            . "('{$_POST['code']}', '{$_POST['title']}', '{$_POST['name']}', '{$_POST['address']}', '{$_POST['mobile']}', '{$_POST['email']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedSupTable') {
        $query = "SELECT
                  ims_supplier.supCode,
                  ims_supplier.sup_id,
                  CONCAT_WS(' ',sup_title,`sup_name`) AS supName,
                  ims_supplier.sup_address,
                  ims_supplier.sup_mobile,
                  ims_supplier.sup_email
                  FROM `ims_supplier`
                  WHERE
                  ims_supplier.sup_status = 1 AND
                  (LOWER(ims_supplier.`supCode`) LIKE LOWER('%{$_POST['search']}%') OR
                   LOWER(ims_supplier.`sup_name`) LIKE LOWER('%{$_POST['search']}%') OR
                   LOWER(ims_supplier.sup_address) LIKE LOWER('%{$_POST['search']}%') OR
                   LOWER(ims_supplier.sup_mobile) LIKE LOWER('{$_POST['search']}%') OR
                   LOWER(ims_supplier.sup_email) LIKE LOWER('{$_POST['search']}%'))
                   ORDER BY ims_supplier.sup_id DESC LIMIT 15";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['supCode'] . '</td>';
            $tblData .= '<td>' . $x['supName'] . '</td>';
            $tblData .= '<td>' . $x['sup_address'] . '</td>';
            $tblData .= '<td>' . $x['sup_mobile'] . '</td>';
            $tblData .= '<td>' . $x['sup_email'] . '</td>';
            $tblData .= '<td><button class="my-save-btn select" type="button" value="' . $x['sup_id'] . '">Select</button><button class="my-del-btn delete" type="button"  value="' . $x['sup_id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'get_sup_data_for_update') {
        $query = "SELECT
                  ims_supplier.supCode,
                  ims_supplier.sup_title,
                  ims_supplier.`sup_name`,
                  ims_supplier.sup_address,
                  ims_supplier.sup_mobile,
                  ims_supplier.sup_email
                  FROM `ims_supplier`
                  WHERE
                  ims_supplier.sup_id = '{$_POST['supID']}'";
        $app->json_encoded_select_query($query);
    } elseif ($_POST['action'] == 'update_sup_details') {
        $query = "UPDATE `ims_supplier` SET "
            . "`sup_title` = '{$_POST['title']}', `sup_name` = '{$_POST['name']}', `sup_address` = '{$_POST['address']}', `sup_mobile` = '{$_POST['mobile']}', `sup_email` = '{$_POST['email']}' "
            . "WHERE (`sup_id` = '{$_POST['supID']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'delete_sup_record') {
//        $query = "UPDATE `ims_supplier` SET `sup_status`='0' WHERE (`sup_id`='{$_POST['supID']}')";
        $query = "DELETE FROM `ims_supplier` WHERE (`sup_id`='{$_POST['supID']}')";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'getNextSupCode') {
        $query = "SELECT IFNULL(MAX(sup_id)+1,'1') AS last_id FROM ims_supplier";
        $data = $app->basic_Select_Query($query);
        echo 'SU00' . $data[0]['last_id'];
    }
}