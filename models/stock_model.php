<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAddedStockTable') {
        $query = "SELECT
                  ims_main_stock_summary.item_id, 
                  ims_item_details.item_name, 
                  ims_item_details.item_metric,
                  ims_main_stock_summary.item_qty, 
                  ims_main_stock_summary.item_last_added_qty, 
                  ims_main_stock_summary.item_last_update_date_time, 
                  ims_main_stock_summary.item_last_issue_qty, 
                  ims_main_stock_summary.item_last_issue_date_time, 
                  ims_main_stock_summary.item_last_update_user_id, 
                  ims_item_details.item_code,
                  ims_item_details.reorder_level
                  FROM
                  ims_main_stock_summary
                  INNER JOIN
                  ims_item_details
                  ON 
                  ims_main_stock_summary.item_id = ims_item_details.item_id
                  WHERE
                  (LOWER(ims_item_details.item_name) LIKE LOWER('%{$_POST['search']}%') OR
                  LOWER(ims_item_details.item_code) LIKE LOWER('%{$_POST['search']}%') OR
                  LOWER(ims_main_stock_summary.item_last_update_user_id) LIKE LOWER('%{$_POST['search']}%'))";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            if ($x['item_metric'] == "kg") {
                $tblData .= '<tr>';
                $tblData .= '<td>' . $x['item_code'] . '</td>';
                $tblData .= '<td>' . $x['item_name'] . '</td>';
                $tblData .= '<td>' . $x['item_qty'] . ' kg</td>';
                $tblData .= '<td>' . $x['reorder_level'] . '</td>';
                if ($x['item_qty'] <= $x['reorder_level']) {
                    $tblData .= '<td>🔴</td>';
                } else {
                    $tblData .= '<td>🟢</td>';
                }
                $tblData .= '<td>' . $x['item_last_added_qty'] . '</td>';
                $tblData .= '<td>' . $x['item_last_update_date_time'] . '</td>';
                $tblData .= '</tr>';
            } else if ($x['item_metric'] == "l") {
                $tblData .= '<tr>';
                $tblData .= '<td>' . $x['item_code'] . '</td>';
                $tblData .= '<td>' . $x['item_name'] . '</td>';
                $tblData .= '<td>' . $x['item_qty'] . ' l</td>';
                $tblData .= '<td>' . $x['reorder_level'] . '</td>';
                if ($x['item_qty'] <= $x['reorder_level']) {
                    $tblData .= '<td>🔴</td>';
                } else {
                    $tblData .= '<td>🟢</td>';
                }
                $tblData .= '<td>' . $x['item_last_added_qty'] . '</td>';
                $tblData .= '<td>' . $x['item_last_update_date_time'] . '</td>';
                $tblData .= '</tr>';
            } else {
                $tblData .= '<tr>';
                $tblData .= '<td>' . $x['item_code'] . '</td>';
                $tblData .= '<td>' . $x['item_name'] . '</td>';
                $tblData .= '<td>' . $x['item_qty'] . ' pc</td>';
                $tblData .= '<td>' . $x['reorder_level'] . '</td>';
                if ($x['item_qty'] <= $x['reorder_level']) {
                    $tblData .= '<td>🔴</td>';
                } else {
                    $tblData .= '<td>🟢</td>';
                }
                $tblData .= '<td>' . $x['item_last_added_qty'] . '</td>';
                $tblData .= '<td>' . $x['item_last_update_date_time'] . '</td>';
                $tblData .= '</tr>';
            }
        }
        echo $tblData;
    }
}
