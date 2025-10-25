<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadOldBill') {
        $query = "SELECT
                ims_outlet_bill_summary.outlet_bill_no, 
                ims_outlet_bill_summary.outlet_bill_amt, 
                DATE_FORMAT(outlet_bill_date_time,'%Y-%m-%d %h:%i %p') AS billDate,  
                ims_outlet_bill_summary.outlet_bill_table_id
                FROM
                ims_outlet_bill_summary
                WHERE
                (ims_outlet_bill_summary.outlet_bill_no LIKE '{$_POST['search']}%' OR
                ims_outlet_bill_summary.outlet_bill_date_time LIKE '%{$_POST['search']}%' OR
                ims_outlet_bill_summary.outlet_bill_amt LIKE '{$_POST['search']}%') AND
                ims_outlet_bill_summary.bill_status = '1' LIMIT 50";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data AS $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['outlet_bill_no'] . '</td>';
            $tblData .= '<td>' . $x['outlet_bill_amt'] . '</td>';
            $tblData .= '<td>' . $x['billDate'] . '</td>';
            $tblData .= '<td><button value="' . $x['outlet_bill_no'] . '" class="my-detail-btn reprintBill" type="button" style="width: 82%; height: 40px"><span><span style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">print</span>&nbsp;   Print Bill</span></button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    }
}