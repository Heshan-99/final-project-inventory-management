<?php
require_once './others/class/common_function.php';
$app = new setting();
if (isset($_GET['all'])) {
    $query = "SELECT
	ims_order_summary.order_no, 
	ims_order_summary.order_paid_amt, 
	ims_order_summary.order_balance_amt, 
	DATE_FORMAT(order_date_time, '%Y-%m-%d') AS orderDate,
	DATE_FORMAT(order_req_date, '%Y-%m-%d') AS reqDate,
	ims_order_summary.order_total, 
	CONCAT_WS(' / ',`name`,mobile) AS cusName
        FROM
	ims_order_summary
	INNER JOIN
	customer
	ON 
        ims_order_summary.order_cust_id = customer.id";
} else {
    $query = "SELECT
	ims_order_summary.order_no, 
	ims_order_summary.order_paid_amt, 
	ims_order_summary.order_balance_amt, 
	DATE_FORMAT(order_date_time, '%Y-%m-%d') AS orderDate,
	DATE_FORMAT(order_req_date, '%Y-%m-%d') AS reqDate,
	ims_order_summary.order_total, 
	CONCAT_WS(' / ',`name`,mobile) AS cusName
        FROM
	ims_order_summary
	INNER JOIN
	customer
	ON 
        ims_order_summary.order_cust_id = customer.id
        WHERE
	DATE_FORMAT(order_date_time, '%Y-%m-%d') BETWEEN '{$_GET['from']}' AND '{$_GET['to']}'";
}
$data = $app->basic_Select_Query($query);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Report</title>
        <link rel="stylesheet" href="style.css">
        <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
        <script src="script.js"></script>
    </head>
    <body>
        <table class="buttonSection">
            <tr>
                <td>
                    <button type="button" onclick="window.location='./?reportsGenerate'" class="update-btn">Back</button>
                </td>
                <td>
                    <button type="button" onclick="window.print()" class="my-save-btn">Print</button>
                </td>
            </tr>
        </table>
        <header>
            <h1>Order Summary</h1>
            <table>
                <tr>
                    <td style="text-align: left">
                        <address>
                            <img src="./others/images/bill_logo.png" style="width: 200px">
                            <p>106/3, Dewala Road,<br>Katubedda,<br>Moratuwa</p>
                            <p>071 569 0189</p>
                        </address>
                    </td>
                    <td tyle="text-align: right">
                        <table style="margin-top:8px">
                            <tr>
                                <th><span>Created date</span></th>
                                <td><span><?php echo date('Y-m-d'); ?></span></td>
                            </tr>
                            <tr>
                                <th><span>Created user</span></th>
                                <td></span><span><?php echo $_SESSION['name']; ?></span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </header>
        <table style="margin-top: -40px;">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Customer</th>
                    <th>Added date</th>
                    <th>Required date</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $pageNo = 1;
                $rowCount = 0;
                $orderCount = 0;
                $totalAmt = 0;
                $paidAmt = 0;
                $balanceAmt = 0;
                foreach ($data as $x) {
                    $totalAmt += $x['order_total'];
                    $paidAmt += $x['order_paid_amt'];
                    $balanceAmt += $x['order_balance_amt'];
                    echo '<tr>
                                <td>' . $x['order_no'] . '</td>
                                <td>' . $x['cusName'] . '</td>
                                <td>' . $x['orderDate'] . '</td>
                                <td>' . $x['reqDate'] . '</td>
                                <td style="text-align:right">' . $x['order_total'] . '</td>
                                <td style="text-align:right">' . $x['order_paid_amt'] . '</td>
                                <td style="text-align:right">' . $x['order_balance_amt'] . '</td>
                            </tr>';
                    $orderCount++;
                }
                ?>

            </tbody>
        </table>
        <table class="balance" style="margin-top: 20px;">
            <tr style="font-size:13px; font-weight: bold">
                <th style="width:40%"><span>Total Orders</span></th>
                <td><span><?php echo $orderCount; ?></span></td>
            </tr>
            <tr style="font-size:13px; font-weight: bold">
                <th style="width:40%"><span>Total Order Amount</span></th>
                <td><span><?php echo number_format($totalAmt, 2); ?></span></td>
            </tr>
            <tr style="font-size:13px; font-weight: bold">
                <th style="width:40%"><span>Total Paid Amount</span></th>
                <td><span><?php echo number_format($paidAmt, 2); ?></span></td>
            </tr>
            <tr style="font-size:13px; font-weight: bold">
                <th style="width:40%"><span>Total Balance Amount</span></th>
                <td><span><?php echo number_format($balanceAmt, 2); ?></span></td>
            </tr>

        </table>
        <aside>
            <h1></h1>
        </aside>


        <style>
            * {
                border: 0;
                box-sizing: content-box;
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                line-height: inherit;
                list-style: none;
                margin: 0;
                padding: 0;
                text-decoration: none;
                vertical-align: top;
            }


            /* heading */

            h1 {
                font: bold 100% sans-serif;
                letter-spacing: 0.5em;
                text-align: center;
                text-transform: uppercase;
            }

            /* table */

            table {
                font-size: 75%;
                width: 100%;
            }

            table {
                border-collapse: separate;
                border-spacing: 2px;
            }

            th, td {
                border-width: 1px;
                padding: 0.5em;
                position: relative;
                text-align: left;
            }

            th, td {
                border-radius: 0.25em;
                border-style: solid;
            }

            th {
                background: #EEE;
                border-color: #BBB;
            }

            td {
                border-color: #DDD;
            }

            /* page */

            html {
                font: 16px/1 'Open Sans', sans-serif;
                overflow: auto;
                padding: 0.5in;
            }

            html {
                background: #999;
                cursor: default;
            }

            body {
                box-sizing: border-box;
                height: 11in;
                margin: 0 auto;
                overflow: hidden;
                padding: 0.5in;
                width: 8.5in;
            }

            body {
                background: #FFF;
                border-radius: 1px;
                box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            }

            /* header */

            header {
                margin: 0 0 3em;
            }

            header:after {
                clear: both;
                content: "";
                display: table;
            }

            header h1 {
                background: #000;
                border-radius: 0.25em;
                color: #FFF;
                margin: 0 0 1em;
                padding: 0.5em 0;
            }

            header address {
                float: left;
                font-size: 75%;
                font-style: normal;
                line-height: 1.25;
                margin: 0 1em 1em 0;
            }

            header address p {
                margin: 0 0 0.25em;
            }

            header span, header img {
                display: block;
                float: right;
            }

            header span {
                margin: 0 0 1em 1em;
                max-height: 25%;
                max-width: 60%;
                position: relative;
            }

            header img {
                max-height: 100%;
                max-width: 100%;
            }

            header input {
                cursor: pointer;
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                height: 100%;
                left: 0;
                opacity: 0;
                position: absolute;
                top: 0;
                width: 100%;
            }

            /* article */

            article, article address, table.meta, table.inventory {
                margin: 0 0 3em;
            }

            article:after {
                clear: both;
                content: "";
                display: table;
            }

            article h1 {
                clip: rect(0 0 0 0);
                position: absolute;
            }

            article address {
                float: left;
                font-size: 125%;
                font-weight: bold;
            }

            /* table meta & balance */

            table.meta, table.balance {
                float: right;
                width: 55%;
            }

            table.meta:after, table.balance:after {
                clear: both;
                content: "";
                display: table;
            }

            /* table meta */

            table.meta th {
                width: auto
            }

            table.meta td {
                width: auto;
            }

            /* table items */

            table.inventory {
                clear: both;
                width: 100%;
            }

            table.inventory th {
                font-weight: bold;
                text-align: center;
            }

            table.inventory td:nth-child(1) {
                width: auto;
            }

            table.inventory td:nth-child(2) {
                width: auto;
            }

            table.inventory td:nth-child(3) {
                text-align: right;
                width: auto;
            }

            table.inventory td:nth-child(4) {
                text-align: right;
                width: auto;
            }

            table.inventory td:nth-child(5) {
                text-align: right;
                width: auto;
            }

            /* table balance */

            table.balance th, table.balance td {
                width: 50%;
            }

            table.balance td {
                text-align: right;
            }

            /* aside */

            aside h1 {
                border: none;
                border-width: 0 0 1px;
                margin: 0 0 1em;
            }

            aside h1 {
                border-color: #999;
                border-bottom-style: solid;
            }

            /* javascript */

            .cut {
                opacity: 0;
                position: absolute;
                top: 0;
                left: -1.5em;
            }

            .cut {
                -webkit-transition: opacity 100ms ease-in;
            }


            @media print {
                * {
                    -webkit-print-color-adjust: exact;
                }

                html {
                    background: none;
                    padding: 0;
                }

                body {
                    box-shadow: none;
                    margin: 0;
                }

                span:empty {
                    display: none;
                }

                .add, .cut {
                    display: none;
                }

                .buttonSection {
                    display: none;
                }
            }

            @page {
                margin: 0;
            }
        </style>

        <style type="text/css">
            .pageBreak {
                page-break-after: always;
            }

            .update-btn {
                background-color: rgb(255, 172, 64);
                color: white;
                padding: 3px 10px;
                text-decoration: none;
                font-size: 16px;
                height: 26px;
                font-family: Poppins, sans-serif;
                border-radius: 5px;
                border: none;
                margin: 5px;
                transition: .2s ease
            }

            .update-btn:hover {
                background-color: rgb(219, 118, 3);
            }

            .my-save-btn {
                background-color: rgb(89, 175, 89);
                color: white;
                padding: 3px 10px;
                text-decoration: none;
                font-size: 16px;
                height: 26px;
                font-family: Poppins, sans-serif;
                border-radius: 5px;
                border: none;
                margin: 5px;
                transition: .2s ease
            }

            .my-save-btn:hover {
                background-color: rgb(160, 218, 23);
            }

        </style>
    </body>
</html>