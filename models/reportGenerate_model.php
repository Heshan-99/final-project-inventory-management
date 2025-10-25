<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadAvailableGRNNo') {
        $query = "SELECT
                CONCAT_WS(' - ', grn_no, CONCAT('(', grn_date, ')')) AS grn_no
                FROM
                ims_grn_summary";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select GRN No.</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['grn_no'] . '">' . $x['grn_no'] . '</option>';
        }
        echo $options;
    }
}