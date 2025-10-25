<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAvailableItems') {
        $query = "SELECT
                 ims_item_details.item_id,
                 ims_item_details.item_name,
                 ims_item_details.item_metric,
                 ims_item_details.item_code,
                 IFNULL(ims_main_stock_summary.item_qty,'0') AS avalQTY,
                 CONCAT_WS('~',ims_item_details.item_id,CONCAT_WS(' - ',item_code,item_name),IFNULL(ims_main_stock_summary.item_qty,'0')) AS btnValue
                 FROM
                 ims_item_details
                 LEFT JOIN ims_main_stock_summary ON ims_item_details.item_id = ims_main_stock_summary.item_id
                 WHERE
                 LOWER(ims_item_details.item_name) LIKE LOWER('%{$_POST['search']}%') OR
                 ims_item_details.item_code LIKE '{$_POST['search']}%' ";
        $data = $app->basic_Select_Query($query);
        $tblData = "";


        foreach ($data as $x) {
            if ($x['item_metric'] == "kg") {
                $tblData .= '<tr>';
                $tblData .= '<td style="width: 100px">' . $x['item_code'] . '</td>';
                $tblData .= '<td style="width: 200px">' . $x['item_name'] . '</td>';
                $tblData .= '<td style="width: 100px">' . $x['avalQTY'] . ' kg</td>';
                $tblData .= '<td style="width: 100px"><button class="my-save-btn select" type="button" value="' . $x['btnValue'] . '">Select</button></td>';
                $tblData .= '</tr>';
            } else if ($x['item_metric'] == "l") {
                $tblData .= '<tr>';
                $tblData .= '<td style="width: 100px">' . $x['item_code'] . '</td>';
                $tblData .= '<td style="width: 200px">' . $x['item_name'] . '</td>';
                $tblData .= '<td style="width: 100px">' . $x['avalQTY'] . ' l</td>';
                $tblData .= '<td style="width: 100px"><button class="my-save-btn select" type="button" value="' . $x['btnValue'] . '">Select</button></td>';
                $tblData .= '</tr>';
            } else {
                $tblData .= '<tr>';
                $tblData .= '<td style="width: 100px">' . $x['item_code'] . '</td>';
                $tblData .= '<td style="width: 200px">' . $x['item_name'] . '</td>';
                $tblData .= '<td style="width: 100px">' . $x['avalQTY'] . ' pcs</td>';
                $tblData .= '<td style="width: 100px"><button class="my-save-btn select" type="button" value="' . $x['btnValue'] . '">Select</button></td>';
                $tblData .= '</tr>';
            }
        }
        echo $tblData;


//        foreach ($data as $x) {
//            $tblData .= '<tr>';
//            $tblData .= '<td style="width: 100px">' . $x['item_code'] . '</td>';
//            $tblData .= '<td style="width: 200px">' . $x['item_name'] . '</td>';
//            $tblData .= '<td style="width: 100px">' . $x['avalQTY'] . '</td>';
//            $tblData .= '<td style="width: 100px"><button class="my-save-btn select" type="button" value="' . $x['btnValue'] . '">Select</button></td>';
//            $tblData .= '</tr>';
//        }
//        echo $tblData;
    } elseif ($_POST['action'] == 'getGrnNo') {
        $count = $app->row_count_query("SELECT ims_grn_summary.grn_no FROM ims_grn_summary WHERE ims_grn_summary.grn_status=0");
        if ($count == 1) {
            $data = $app->basic_Select_Query("SELECT ims_grn_summary.grn_no FROM ims_grn_summary WHERE ims_grn_summary.grn_status=0");
            $grnNo = $data[0]['grn_no'];
        } else {
            $nextGrnNo = $app->basic_Select_Query("SELECT IFNULL(MAX(ims_grn_summary.grn_no)+1,'1') AS nexNo FROM `ims_grn_summary`");
            $addnew = $app->basic_command_query("INSERT INTO `ims_grn_summary` (`grn_no`,`grn_status`) VALUES ('{$nextGrnNo[0]['nexNo']}', 0)");
            $grnNo = $nextGrnNo[0]['nexNo'];
        }
        echo $grnNo;
    } elseif ($_POST['action'] == 'addItemToSummary') {
        $query = "INSERT INTO `ims_grn_item_added_log` "
            . "(`grn_no`,`grn_item_id`, `grn_item_recieved_qty`, `grn_item_unit_cost`)"
            . "VALUES "
            . "('{$_POST['grnNo']}','{$_POST['itemId']}','{$_POST['newQty']}', '{$_POST['unitfield']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } else if ($_POST['action'] == 'grnAddedItem') {
        $query = "SELECT
                  ims_grn_item_added_log.grn_item_table_id,
                  ims_item_details.item_name,
                  ims_grn_item_added_log.grn_item_recieved_qty,
                  ims_grn_item_added_log.grn_item_unit_cost
                  FROM
                  ims_grn_item_added_log
                  INNER JOIN ims_item_details ON ims_grn_item_added_log.grn_item_id = ims_item_details.item_id
                  WHERE
                  ims_grn_item_added_log.grn_no = '{$_POST['grnNo']}' ORDER BY
                  ims_grn_item_added_log.grn_item_table_id DESC";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        $finalTotal = 0;
        $index = 1;
        foreach ($data as $x) {
            $total = $x['grn_item_recieved_qty'] * $x['grn_item_unit_cost'];
            $finalTotal += $total;
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['item_name'] . '</td>';
            $tblData .= '<td>' . $x['grn_item_recieved_qty'] . '</td>';
            $tblData .= '<td>' . $x['grn_item_unit_cost'] . '</td>';
            $tblData .= '<td>' . $total . '</td>';
            $tblData .= '<td><button class="my-del-btn remove" value="' . $x['grn_item_table_id'] . '">Remove</button></td>';
            $tblData .= '</tr>';
            $index++;
        }
        echo $tblData . '~' . $finalTotal;
    } else if ($_POST['action'] == 'addFinalGrn') {
        $query = "UPDATE `ims_grn_summary` 
                  SET 
                  `grn_sup_id` = '{$_POST['supplierId']}',
                  `grn_tot_amt` = '{$_POST['grnTotal']}',
                  `grn_paid_amt` = 0,
                  `grn_bal_amt` = '{$_POST['grnTotal']}',
                  `grn_date` = '{$_POST['grnDate']}',
                  `grn_status` = 1
                  WHERE
	              `grn_no` = '{$_POST['grnNo']}';";
        $result = $app->basic_command_query($query);
        if ($result) {
            $q2 = "SELECT
               ims_grn_item_added_log.grn_item_id,
               ims_grn_item_added_log.grn_item_unit_cost,
               ims_grn_item_added_log.grn_item_recieved_qty
               FROM `ims_grn_item_added_log`
               WHERE
               ims_grn_item_added_log.grn_no = '{$_POST['grnNo']}'";
            $data = $app->basic_Select_Query($q2);
            foreach ($data as $x) {
                $q3 = "INSERT INTO `ims_main_stock_summary` "
                    . "( `item_id`, `item_qty`, `item_last_added_qty`, `item_last_update_date_time`, `item_last_update_user_id` ,`item_last_stock_price`) "
                    . "VALUES "
                    . "('{$x['grn_item_id']}', '{$x['grn_item_recieved_qty']}', '{$x['grn_item_recieved_qty']}', NOW(), '{$_SESSION['emp_id']}', '{$x['grn_item_unit_cost']}')  ON DUPLICATE KEY UPDATE "
                    . "`item_qty` = `item_qty`+'{$x['grn_item_recieved_qty']}', `item_last_added_qty`='{$x['grn_item_recieved_qty']}', `item_last_update_date_time`=NOW(),`item_last_update_user_id` = '{$_SESSION['emp_id']}', `item_last_stock_price` = '{$x['grn_item_unit_cost']}' ;";
                $app->basic_command_query($q3);
            }
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadSuppliers') {
        $query = "SELECT 
                  ims_supplier.sup_id, 
                  ims_supplier.sup_name
                  FROM
                  ims_supplier
                  WHERE
                  ims_supplier.sup_status = 1";
        $data = $app->basic_Select_Query($query);
        $defaultOptions = '';
        $options = '';
        $defaultOptions .= '<option selected value="0">Select supplier</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['sup_id'] . '">' . $x['sup_name'] . '</option>';
        }
        echo $defaultOptions;
        echo $options;
    } elseif ($_POST['action'] == 'removeItem') {
        $query = "DELETE FROM `ims`.`ims_grn_item_added_log` WHERE `grn_item_table_id` = '{$_POST['index']}';";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'resetGrnForm') {
        $query = "DELETE FROM `ims_grn_item_added_log` WHERE `grn_no` = '{$_POST['grnNo']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
