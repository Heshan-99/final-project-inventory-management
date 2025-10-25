<?php

//require_once '../others/class/comm_functions.php'; //file name invalid
require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAddedConfig') {
        $query = "SELECT
                CONCAT_WS( ' - ', `code`, `name`,CONCAT('Rs.', price)) AS cakeName,
                cake.photo,
                GROUP_CONCAT( CONCAT( ims_item_details.item_name, ' - ', ims_cake_config_details.usage_qty ) SEPARATOR ' , ' ) AS ingredients,
                ims_item_details.item_metric
                FROM
                ims_cake_config_details
                INNER JOIN cake ON ims_cake_config_details.cake_id = cake.id
                INNER JOIN ims_item_details ON ims_cake_config_details.item_id = ims_item_details.item_id 
                WHERE
                cake.`name` lIKE '%{$_POST['search']}%' OR
                cake.`code` lIKE '%{$_POST['search']}%' GROUP BY
                cake.id";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<table class="table">';
            $tblData .= '<tr style="text-align: center; max-height: 100px; height: 100px">';
            $tblData .= '<td style="width: 20%">';
            $tblData .= '<div><img src="./others/upload_cake_designs/'. $x['photo'] .' " alt="Cake photo" style=" margin-left: 40px; border-radius: 10px;width: 50%;height: 100%;">';
            $tblData .= '</td>';
            $tblData .= '<td style="text-align: left"><h3>' . $x['cakeName'] . '</h3></td>';
            $tblData .= '<td>' . $x['ingredients'] . '</td>';
            $tblData .= '</tr>';
            $tblData .= '</table><br>';
        }
        echo $tblData;
    }
}