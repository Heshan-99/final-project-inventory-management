<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAddedItems') {
        $query = "SELECT
                  ims_item_details.item_id,
                  ims_item_details.item_cat_id,
                  ims_item_details.item_name,
                  ims_item_details.item_code,
                  ims_item_details.brand_id
                  FROM `ims_item_details`
                  WHERE
                  ims_item_details.item_status = 1
                  ORDER BY ims_item_details.item_id;";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        $index = 1;
        foreach ($data as $x) {
            if ($x['item_cat_id'] == 2) {
                $tblData .= '<tr>';
                $tblData .= '<td>' . $x['item_name'] . '</td>';
                $tblData .= '<td><input type="checkbox" value="0" class="itemChecked" id="ch_' . $index . '" data-itmid="' . $x['item_id'] . '" data-index="' . $index . '"></td>';
                $tblData .= '<td><input class="itemAmount other" id="input_' . $index . '" data-index="' . $index . '" type="text" style="width: 50px;" disabled></td>';
                $tblData .= '</tr>';
            } else {
                $tblData .= '<tr>';
                $tblData .= '<td>' . $x['item_name'] . '</td>';
                $tblData .= '<td><input type="checkbox" value="0" class="itemChecked" id="ch_' . $index . '" data-itmid="' . $x['item_id'] . '" data-index="' . $index . '"></td>';
                $tblData .= '<td><input class="itemAmount ing" id="input_' . $index . '" data-index="' . $index . '" type="text" style="width: 50px;" disabled></td>';
                $tblData .= '</tr>';
            }
            $index++;
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'addSelectedItems') {
        $item = $_POST['items'];
        $qty = $_POST['issueQty'];
        $itmCount = count($item) - 1;
        $itmCountCheck = count($item);
        if ($itmCountCheck > 0) {
            $error = TRUE;
            for ($x = 0; $x <= $itmCount; $x++) {
                $query = "INSERT INTO `ims_cake_config_details` (`cake_id`,`item_id`,`usage_qty`) VALUES ('{$_POST['cakeId']}','{$item[$x]}','{$qty[$x]}');";
                $result = $app->basic_command_query($query);
                if (!$result) {
                    $error = FALSE;
                }
            }
            if ($error) {
                echo 1;
            } else {
                echo 99;
            }
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadCakeTypes') {
        $query = "SELECT cake.id,CONCAT_WS(' / ',IF(type = 1,'Cake','Other'),`name`) AS itemName FROM cake WHERE cake.cake_status=1;";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select item type</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['id'] . '">' . $x['itemName'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'loadAddedCakes') {
        $query = "SELECT
            	 ims_cake_config_details.cake_config_table_id,
                 ims_item_details.item_name,
                 ims_cake_config_details.usage_qty,
                 ims_cake_config_details.cake_id,
                 IFNULL(ims_main_stock_summary.item_last_stock_price,'0') AS costPrice,
                 cake.price
                 FROM
                 ims_cake_config_details
                 INNER JOIN ims_item_details ON ims_cake_config_details.item_id = ims_item_details.item_id
                 LEFT JOIN ims_main_stock_summary ON ims_item_details.item_id = ims_main_stock_summary.item_id
                 INNER JOIN cake ON ims_cake_config_details.cake_id = cake.id
                 WHERE ims_cake_config_details.cake_id = '{$_POST['cakeId']}';";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        $totalCost = 0;
        $sellPrice = 0;
        $index = 1;
        foreach ($data as $x) {
            $sellPrice = $x['price'];
            if ($x['costPrice'] != 0) {
                $itemCost = $x['costPrice'] * $x['usage_qty'];
                $totalCost += $itemCost;
            } else {
                $itemCost = "Out Of Stock";
            }
            $tblData .= '<tr style="height: 20px">';
            $tblData .= '<td><button  value="' . $x['cake_config_table_id'] . '" class="my-remove-btn item_remove">&nbsp;&nbsp;-&nbsp;&nbsp;</button></td>';
            $tblData .= '<td>' . $x['item_name'] . '</td>';
            $tblData .= '<td>' . $x['usage_qty'] . '</td>';
            $tblData .= '<td>' . $x['costPrice'] . '</td>';
            $tblData .= '<td>' . $itemCost . '</td>';
            $tblData .= '</tr>';
            $index++;
        }
        echo $tblData . '~' . $totalCost . '~' . $sellPrice;
    } elseif ($_POST['action'] == 'finishCakeConfiguration') {
        $query = "UPDATE `cake` SET `price`='{$_POST['sellingPrice']}' WHERE (`id`='{$_POST['cakeId']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'removeItem') {
        $query = "DELETE FROM `ims`.`ims_cake_config_details` WHERE `cake_config_table_id` = '{$_POST['index']}';";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
    
    