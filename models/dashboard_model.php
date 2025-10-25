<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'selectOrderDate') {
        $subQ = "";
        if ($_POST['status'] != 99) {
            $subQ = "AND ims_order_summary.order_status = '{$_POST['status']}'";
        }
        $query = "SELECT
                ims_order_summary.order_status,
                ims_order_summary.order_table_id,
                ims_order_summary.order_no,
                ims_order_summary.order_cust_id,
                ims_order_summary.order_total,
                ims_order_summary.order_date_time,
                ims_order_summary.order_req_date,
                ims_order_summary.order_paid_amt,
                ims_order_summary.order_balance_amt
                FROM
                `ims_order_summary`
                WHERE
                (LOWER(ims_order_summary.order_no) LIKE LOWER('%{$_POST['search']}%') or
                LOWER(ims_order_summary.order_cust_id) LIKE LOWER('%{$_POST['search']}%'))" . $subQ . "
                ORDER BY ims_order_summary.order_table_id DESC LIMIT 7";


        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['order_no'] . '</td>';
            if ($x['order_status'] == 0) {
                $tblData .= '<td>🟡</td>';
            } elseif ($x['order_status'] == 1) {
                $tblData .= '<td>🔵</td>';
            } elseif ($x['order_status'] == 2) {
                $tblData .= '<td>🟢</td>';
            } elseif ($x['order_status'] == 3) {
                $tblData .= '<td>🟢🟢</td>';
            } elseif ($x['order_status'] == 4) {
                $tblData .= '<td>🟢🟢🟢</td>';
            } elseif ($x['order_status'] == 5) {
                $tblData .= '<td>🔴</td>';
            }
            $tblData .= '<td>' . $x['order_cust_id'] . '</td>';
            $tblData .= '<td>' . $x['order_total'] . '</td>';
            $tblData .= '<td>' . $x['order_paid_amt'] . '</td>';
            $tblData .= '<td>' . $x['order_balance_amt'] . '</td>';
            $tblData .= '<td>' . $x['order_req_date'] . '</td>';
            $tblData .= '<td>' . $x['order_date_time'] . '</td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'getCusCount') {
        $query = "SELECT COUNT(*) AS count FROM customer WHERE customer.cus_status='1';";
        $data = $app->basic_Select_Query($query);
        $count = $data[0]['count'];
        $tblData = '<h1>' . $count . '</h1>';
        echo $tblData;
    } elseif ($_POST['action'] == 'getOrderCount') {
//        $query = "SELECT
//                    COUNT(*) AS count
//                    FROM
//                    ims_order_summary
//                    WHERE
//                    DATE_FORMAT(order_date_time,'%Y-%m-%d') = CURDATE()";
        $query = "SELECT
                COUNT(*) AS count
                FROM
                ims_order_summary
                WHERE
                ims_order_summary.order_status NOT LIKE '4' AND '5'";
        $data = $app->basic_Select_Query($query);
        $count = $data[0]['count'];
        $tblData = '<h1>' . $count . '</h1>';
        echo $tblData;
    } elseif ($_POST['action'] == 'getSalesAndStockValue') {
        $q1 = "SELECT
                SUM(ims_order_summary.order_paid_amt) AS orderSum
                FROM
                ims_order_summary
                WHERE
                DATE_FORMAT(order_date_time,'%Y-%m-%d') = CURDATE()";
        $sale1 = $app->basic_Select_Query($q1);
        $q2 = "SELECT
                SUM(ims_outlet_bill_summary.outlet_bill_amt) AS outletSales
                FROM
                ims_outlet_bill_summary
                WHERE
                DATE_FORMAT(outlet_bill_date_time,'%Y-%m-%d') = CURDATE()";
        $sale2 = $app->basic_Select_Query($q2);
        $totalSale = $sale1[0]['orderSum'] + $sale2[0]['outletSales'];
//==============================================================================
        $q3 = "SELECT
                SUM(ims_main_stock_summary.item_qty * ims_main_stock_summary.item_last_stock_price) AS stockTotal
                FROM
                ims_main_stock_summary
                WHERE
                ims_main_stock_summary.item_qty > 0";
        $stock = $app->basic_Select_Query($q3);
        $stockValue = $stock[0]['stockTotal'];

        echo number_format($totalSale, 2) . '~' . number_format($stockValue, 2);
    }
}