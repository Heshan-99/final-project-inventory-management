<?php
require_once './others/class/common_function.php';
$app = new setting();

$billNo = $_GET['billNo'];
$q1 = "SELECT
        ims_outlet_bill_summary.outlet_bill_amt, 
        ims_outlet_bill_summary.paid_amt, 
	    ims_outlet_bill_summary.balance_amt,
        DATE_FORMAT( ims_outlet_bill_summary.outlet_bill_date_time, '%Y-%m-%d %h:%i %p') AS date_time,
        employee.`name` AS sys_user
        FROM
        ims_outlet_bill_summary
        INNER JOIN
        employee
        ON 
        ims_outlet_bill_summary.outler_bill_user_id = employee.emp_id
        WHERE
	    ims_outlet_bill_summary.outlet_bill_no = '{$billNo}'";
$mainData = $app->basic_Select_Query($q1);

$q2 = "SELECT
        CONCAT_WS(' / ',`code`,`name`) AS itemName,
	ims_outlet_bill_item_details.item_qty, 
	ims_outlet_bill_item_details.item_total, 
	cake.price
        FROM
	ims_outlet_bill_item_details
	INNER JOIN
	cake
	ON 
        ims_outlet_bill_item_details.item_id = cake.id
        WHERE
	ims_outlet_bill_item_details.bill_no = '{$billNo}'";
$itemData = $app->basic_Select_Query($q2);

//$q1 = "SELECT
//	ims_order_summary.order_total, 
//	customer.`name`, 
//	DATE_FORMAT( ims_order_summary.order_date_time, '%Y-%m-%d %h:%i %p') AS date_time, 
//	ims_order_summary.order_req_date, 
//	ims_order_summary.order_paid_amt, 
//	ims_order_summary.order_balance_amt, 
//	employee.`name` AS sys_user
//        FROM
//	ims_order_summary
//	INNER JOIN
//	customer
//	ON 
//	ims_order_summary.order_cust_id = customer.id
//	INNER JOIN
//	employee
//	ON 
//        ims_order_summary.order_system_user = employee.emp_id
//        WHERE
//	ims_order_summary.order_no = '{$orderNo}'";
//$mainData = $app->basic_Select_Query($q1);
//$q2 = "SELECT
//	ims_order_cake_details.qty, 
//	ims_order_cake_details.order_cake_weight, 
//	CONCAT_WS(' / ',`code`,`name`) AS item,
//        cake.price
//        FROM
//	ims_order_cake_details
//	INNER JOIN
//	cake
//	ON 
//	ims_order_cake_details.order_cake_id = cake.id
//        WHERE
//	ims_order_cake_details.order_no = '{$orderNo}'";
//$itemData = $app->basic_Select_Query($q2);
?>

<style type="text/css">
    @media Print {
        .displayHide {
            display: none;
        }
    }

    .tbl_border {
        border: 1px double black;
        border-collapse: collapse;
    }

    table.tbl_border td, table.tbl_border th {
        border: 1px double black;
        padding: 3px;
    }

    * {
        font-family: Courier New;
    }

    img {
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
    }
    
    .boldText{
        font-weight: bold
    }
</style>


<!--=============================table for db=================================-->
<head>
    <script src="./others/Assets/js/JsBarcode.all.min.js"></script>
</head>
<table style="width: 8cm; border: 1px solid black" class="displayHide">
    <tr>
        <td>
            <?php if (isset($_GET['reprint'])) { ?>
                <a type="button" class="update-btn" href="./?reprintBill">Back</a>
            <?php } else { ?>
                <a type="button" class="update-btn" href="./?outletSale">Back</a>
            <?php } ?>

        </td>
        <td>
            <button class="my-save-btn" onclick="window.print();">Print</button>
        </td>
    </tr>
</table>
<table style="width: 8cm; border: 1px solid black">
    <thead>
        <tr>
            <th>
                <img src="./others/images/bill_logo.png" width="200px"><br>
                <span>106/3, dewala road,<br>katubedda,<br>Moratuwa<br>071 569 0189</span>
            </th>
        </tr>
        <tr>
            <th>
                <hr>
            </th>
        </tr>
        <tr>
            <th style="text-align: left">
                <span>Bill No. : <?php echo $billNo; ?></span><br>
                <span>Date : <?php echo $mainData[0]['date_time']; ?></span><br>
                <span>Cashier : <?php echo $mainData[0]['sys_user']; ?></span><br>
            </th>
        </tr>
        <tr>
            <th>
                <hr>
            </th>
        </tr>
    </thead>
</table>

<table style="width: 8cm; border: 1px solid black" class="tbl_border">
    <tr>
        <td colspan="3">Item Name</td>
    </tr>
    <tr>
        <td style="text-align: center; padding-right: 5px; width: 2.5cm">Qty.</td>
        <td style="text-align: center; padding-right: 5px; width: 2.5cm">Unit Price</td>
        <td style="text-align: center; padding-right: 5px; width: 3cm">Total Amount</td>
    </tr>
</table>

<table style="width: 8cm; border: 1px solid black" class="tbl_border">
    <?php
    $items = '';
    $totalPrice = 0;
    foreach ($itemData as $x) {
        $totalPrice = $x['price'] * $x['item_qty'];
        $items .= '<tr>
        <td colspan="3" class="boldText">' . $x['itemName'] . '</td>
    </tr>
    <tr class="boldText">
        <td style="text-align: center; padding-right: 5px;  width: 2.5cm">' . $x['item_qty'] . '</td>
        <td style="text-align: right; padding-right: 5px;  width: 2.5cm">' . $x['price'] . '</td>
        <td style="text-align: right; padding-right: 5px;  width: 3cm">' . $totalPrice . '</td>
    </tr>';
        $totalPrice = 0;
    }
    echo $items;
    ?>

</table>
<table style="width: 8cm; border: 1px solid black; font-weight: bold" class="tbl_border">
    <tr>
        <td style="text-align: right; padding-right: 5px;  width: 5cm">Total Amount :</td>
        <td style="text-align: right; padding-right: 5px;  width: 3cm"><?php echo $mainData[0]['outlet_bill_amt']; ?></td>
    </tr>
    <tr>
        <td style="text-align: right; padding-right: 5px;  width: 5cm">Paid Amount :</td>
        <td style="text-align: right; padding-right: 5px;  width: 3cm"><?php echo $mainData[0]['paid_amt']; ?></td>
    </tr>
    <tr>
        <td style="text-align: right; padding-right: 5px;  width: 5cm">Balance Amount :</td>
        <td style="text-align: right; padding-right: 5px;  width: 3cm"><?php echo $mainData[0]['balance_amt']; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center">
            <svg class="barcode"
                 jsbarcode-format="auto"
                 jsbarcode-value="0000<?php echo $billNo; ?>"
                 jsbarcode-textmargin="0"
                 jsbarcode-fontoptions="bold"
                 jsbarcode-height="40">
            </svg>
        </td>
    </tr>
</table>
<script>JsBarcode(".barcode").init();</script>


<table style="width: 8cm; border: 1px solid black" class="tbl_border">
    <tr>
        <td style="text-align: center">Thank you. Come again.</td>
    </tr>
</table>


<style>
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



