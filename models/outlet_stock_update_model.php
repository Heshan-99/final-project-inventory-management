<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadBatchNO') {
        $newBatchNO = '';
        $user = $_SESSION['emp_id'];
        $q1 = "SELECT
               ims_outlet_batch_details.outlet_batch_no
               FROM
               ims_outlet_batch_details
               WHERE
               ims_outlet_batch_details.outlet_batch_status = '0' AND
               ims_outlet_batch_details.outlet_batch_create_user_id = '{$user}'";
        $count = $app->row_count_query($q1);
        if ($count == 1) {
            $data = $app->basic_Select_Query($q1);
            $newBatchNO = $data[0]['outlet_batch_no'];
        } else {
            $q2 = "SELECT
                   IFNULL(MAX(ims_outlet_batch_details.outlet_batch_no) + 1,1) AS newBatchNo
                   FROM
                   ims_outlet_batch_details";
            $data = $app->basic_Select_Query($q2);
            $newBatchNO = $data[0]['newBatchNo'];
            $q3 = "INSERT INTO `ims_outlet_batch_details` ( `outlet_batch_no`, `outlet_batch_create_user_id`, `outlet_batch_status` )
                   VALUES
                   ('{$newBatchNO}','{$user}' ,'0' );";
            $app->basic_command_query($q3);
        }
        echo $newBatchNO;
    } elseif ($_POST['action'] == 'getItemDetails') {
        $query = "SELECT
                 cake.price, 
                 IFNULL(ims_outlet_stock_details.outlet_item_qty,'0') AS avaQty
                 FROM
                 cake
                 LEFT JOIN
                 ims_outlet_stock_details
                 ON 
                 cake.id = ims_outlet_stock_details.outlet_item_id
                 WHERE
                 cake.id = '{$_POST['itemId']}'";
        $data = $app->basic_Select_Query($query);
        echo $data[0]['price'] . '~' . $data[0]['avaQty'];
    } elseif ($_POST['action'] == 'saveStock') {
        $query = "INSERT INTO `ims_outlet_stock_details` ( `outlet_item_batch_no`, `outlet_item_id`, `outlet_item_qty`, `outlet_item_exp_date`, `outlet_item_selling_price`, `outlet_item_reorder_level`, `system_user_id` )
                  VALUES
                 ('{$_POST['batchNo']}', '{$_POST['itemId']}', '{$_POST['qty']}', '{$_POST['expDate']}', '{$_POST['sellPrice']}', '{$_POST['reorderLevel']}', '{$_SESSION['emp_id']}')
                 ON DUPLICATE KEY UPDATE `outlet_item_batch_no` = '{$_POST['batchNo']}', `outlet_item_qty` = `outlet_item_qty`+'{$_POST['qty']}', `outlet_item_exp_date` = '{$_POST['expDate']}', `outlet_item_selling_price` = '{$_POST['sellPrice']}', `outlet_item_reorder_level` = '{$_POST['reorderLevel']}', `system_date_time` = NOW(), `system_user_id` = '{$_SESSION['emp_id']}';";
        $result = $app->basic_command_query($query);
        if ($result) {
            $query2 = "INSERT INTO `ims_outlet_stock_update_log` ( `outlet_item_batch_no`, `outlet_item_id`, `outlet_item_qty`, `outlet_item_exp_date`, `outlet_item_selling_price`, `outlet_item_reorder_level`, `system_user_id` )
                  VALUES
                 ('{$_POST['batchNo']}', '{$_POST['itemId']}', '{$_POST['qty']}', '{$_POST['expDate']}', '{$_POST['sellPrice']}', '{$_POST['reorderLevel']}', '{$_SESSION['emp_id']}')";
            $app->basic_command_query($query2);
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'completeBatch') {
        $query = "UPDATE `ims_outlet_batch_details` SET `outlet_batch_status` = 1 WHERE `outlet_batch_no` = '{$_POST['batchNo']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            $q1 = "SELECT
                    ims_outlet_stock_update_log.outlet_item_qty, 
                    cake.id
                    FROM
                    ims_outlet_stock_update_log
                    INNER JOIN
                    cake
                    ON 
                    ims_outlet_stock_update_log.outlet_item_id = cake.id
                    WHERE
                    ims_outlet_stock_update_log.outlet_item_batch_no = '{$_POST['batchNo']}'";
            $data = $app->basic_Select_Query($q1);
            $deductQty = 0;
            foreach ($data AS $x) {
                $q2 = "SELECT
                       ims_cake_config_details.item_id, 
                       ims_cake_config_details.usage_qty
                       FROM
                       ims_cake_config_details
                       WHERE
                       ims_cake_config_details.cake_id = '{$x['id']}'";
                $data2 = $app->basic_Select_Query($q2);
                foreach ($data2 AS $y) {
                    $deductQty = $y['usage_qty'] * $x['outlet_item_qty'];
                    $q3 = "UPDATE `ims_main_stock_summary` SET "
                            . "`item_qty` = item_qty - '{$deductQty}', "
                            . "`item_last_issue_qty` = '{$deductQty}', "
                            . "`item_last_update_user_id` = '{$_SESSION['emp_id']}' "
                            . "WHERE "
                            . "`item_id` = '{$y['item_id']}'";
                    $app->basic_command_query($q3);
                }
            }
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedItems') {
        $query = "SELECT
	            CONCAT_WS(' - ',`code`,`name`) AS itemName, 
                ims_outlet_stock_details.outlet_item_qty, 
                ims_outlet_stock_details.outlet_item_exp_date, 
                cake.price
                FROM
                ims_outlet_stock_details
                INNER JOIN
                cake
                ON 
                ims_outlet_stock_details.outlet_item_id = cake.id
                WHERE
                ims_outlet_stock_details.outlet_item_batch_no = '{$_POST['batchNo']}';";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['itemName'] . '</td>';
            $tblData .= '<td>' . $x['outlet_item_qty'] . '</td>';
            $tblData .= '<td>' . $x['price'] . '</td>';
            $tblData .= '<td>' . $x['outlet_item_exp_date'] . '</td>';
//            $tblData .= '<td><button class="my-save-btn select" type="button" value="' . $x['id'] . '">Select</button><button class="my-del-btn delete" type="button"  value="' . $x['id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    }
}