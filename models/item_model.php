<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'checkNameAndBrand') {
        $query = "SELECT
                ims_item_details.item_name,
                ims_item_details.brand_id 
                FROM
                ims_item_details 
                WHERE
                ims_item_details.item_name = '{$_POST['name']}' AND 
                ims_item_details.brand_id = '{$_POST['brand']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'saveItem') {
        $query = "INSERT INTO `ims_item_details` "
            . "(`item_cat_id`, `item_name`, `item_metric`, `item_code`, `brand_id`,`reorder_level`)"
            . "VALUES "
            . "('{$_POST['cat']}', '{$_POST['name']}', '{$_POST['metric']}', '{$_POST['itemCode']}', '{$_POST['brand']}', '{$_POST['rLevel']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedItemTable') {
        $query = "SELECT
                ims_item_details.item_id, 
                IF(item_cat_id = 1, 'Ingredients', 'Others') AS itmCat, 
                ims_item_details.item_name, 
                ims_item_details.item_code, 
                ims_brand_details.brand_name
                FROM
                ims_item_details
                INNER JOIN
                ims_brand_details
                ON 
		        ims_item_details.brand_id = ims_brand_details.brand_id
                WHERE
                ims_item_details.item_status = 1 AND
                (LOWER(ims_item_details.`item_name`) LIKE LOWER('{$_POST['search']}%') OR
                LOWER(ims_item_details.item_code) LIKE LOWER('%{$_POST['search']}%') OR
                LOWER(ims_brand_details.brand_name) LIKE LOWER('{$_POST['search']}%'))
                ORDER BY ims_item_details.item_id DESC LIMIT 10";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['item_code'] . '</td>';
            $tblData .= '<td>' . $x['itmCat'] . '</td>';
            $tblData .= '<td>' . $x['item_name'] . '</td>';
            $tblData .= '<td>' . $x['brand_name'] . '</td>';
            $tblData .= '<td><button class="my-save-btn select" type="button" value="' . $x['item_id'] . '">Select</button><button class="my-del-btn deleteItem" type="button"  value="' . $x['item_id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'get_item_data_for_update') {
        $query = "SELECT
                  ims_item_details.item_cat_id,
                  ims_item_details.item_name,
                  ims_item_details.item_metric,
                  ims_item_details.brand_id,
                  ims_item_details.reorder_level,
                  ims_item_details.item_code
                  FROM `ims_item_details`
                  WHERE
                  ims_item_details.item_id = '{$_POST['itemID']}'";
        $app->json_encoded_select_query($query);
    } elseif ($_POST['action'] == 'update_item_details') {
        $query = "UPDATE `ims_item_details` SET "
            . "`item_cat_id` = '{$_POST['catId']}', `item_name` = '{$_POST['name']}', `brand_id` = '{$_POST['brandId']}', `reorder_level` = '{$_POST['reorderLevel']}' "
            . "WHERE (`item_id` = '{$_POST['itemID']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'delete_item_record') {
        $query = "DELETE FROM `ims_item_details` WHERE `item_id` = '{$_POST['itemID']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'getNewItemCode') {
        $query = "SELECT IFNULL(MAX(ims_item_details.item_id)+1,'1') AS itemId FROM ims_item_details";
        $data = $app->basic_Select_Query($query);
        $itemName = $_POST['itemName'];
        $code = substr($itemName, 0, 2);
        echo $code . '0' . $data[0]['itemId'];
    } elseif ($_POST['action'] == 'loadBrandDetails') {
        $query = "SELECT ims_brand_details.brand_id,ims_brand_details.brand_name FROM ims_brand_details WHERE status='1'";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select Brand</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['brand_id'] . '">' . $x['brand_name'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'checkBrand') {
        $query = "SELECT brand_name,ims_brand_details.brand_id FROM ims_brand_details WHERE ims_brand_details.brand_name='{$_POST['brand']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'addNewBrand') {
        $query = "INSERT INTO `ims_brand_details` (`brand_name`) VALUES ('{$_POST['newBrand']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedBrands') {
        $query = "SELECT
                ims_brand_details.brand_id, 
                ims_brand_details.brand_name
                FROM
                ims_brand_details
                WHERE
                ims_brand_details.`status` = '1' AND
                LOWER(ims_brand_details.`brand_name`) LIKE LOWER('{$_POST['search']}%')
                ORDER BY
                ims_brand_details.brand_name ASC
                LIMIT 5;";

        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['brand_name'] . '</td>';
            $tblData .= '<td><button class="my-del-btn deleteBrand" type="button"  value="' . $x['brand_id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    }elseif ($_POST['action'] == 'deleteBrand') {
        $query = "DELETE FROM `ims_brand_details` WHERE `brand_id` = '{$_POST['id']}';";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}