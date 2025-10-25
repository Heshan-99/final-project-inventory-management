<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadGrnNumber') {
        $query = "SELECT
                ims_grn_summary.grn_no, 
	            CONCAT_WS(' / ',grn_no,grn_date) AS grnName
                FROM
                ims_grn_summary
                WHERE
                ims_grn_summary.grn_bal_amt NOT LIKE '0.00'";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select order number</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['grn_no'] . '">' . $x['grnName'] . '</option>';
        }
        echo $options;
    } else if ($_POST['action'] == 'fillFields') {
        $query = "SELECT
                ims_grn_summary.grn_no, 
                ims_grn_summary.grn_tot_amt, 
                ims_grn_summary.grn_paid_amt, 
                ims_grn_summary.grn_bal_amt
                FROM
                ims_grn_summary
                WHERE
                ims_grn_summary.grn_no = '{$_POST['grnNo']}'";
        $app->json_encoded_select_query($query);
    } else if ($_POST['action'] == 'updateBalance') {
        $query = "UPDATE `ims_grn_summary` SET `grn_paid_amt` = `grn_paid_amt`+ '{$_POST['payment']}', `grn_bal_amt` = `grn_bal_amt`-'{$_POST['payment']}' WHERE `grn_no` = '{$_POST['grnNo']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}