<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadOrderNumber') {
        $query = "SELECT
                ims_order_summary.order_table_id, 
                ims_order_summary.order_no
                FROM
                ims.ims_order_summary
                WHERE
                ims.ims_order_summary.order_balance_amt NOT LIKE '0.00'";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select order number</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['order_table_id'] . '">' . $x['order_no'] . '</option>';
        }
        echo $options;
    } else if ($_POST['action'] == 'fillFields') {
        $query = "SELECT
                    ims_order_summary.order_no, 
                    ims_order_summary.order_total, 
                    ims_order_summary.order_paid_amt, 
                    ims_order_summary.order_balance_amt
                    FROM
                    ims_order_summary
                    WHERE
                    ims_order_summary.order_table_id = '{$_POST['orderNo']}'";
        $app->json_encoded_select_query($query);
    } else if ($_POST['action'] == 'updateBalance') {
        $query = "UPDATE `ims_order_summary` SET `order_paid_amt` = `order_paid_amt`+ `order_balance_amt`, `order_balance_amt` = '0.00' WHERE `order_table_id` = '{$_POST['orderTblId']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}