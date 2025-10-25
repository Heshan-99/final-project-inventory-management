<?php
require_once './others/class/common_function.php';
$app = new setting();
?>

<html>
<head>
    <?php require_once './others/sub_pages/all_css.php'; ?>
</head>
<body>

<?php require_once './others/sub_pages/header.php'; ?>
<section class="main">
    <?php require_once './others/sub_pages/sidebar.php'; ?>
    <div class="main--content">


        <div class="table" style="height: 100%">
            <h1 class="mainHeading">Stock summery</h1>
            <table cellspacing="0" cellpadding="5" id="addedStock_tbl" style="text-align: center">

                <thead>
                <tr>
                    <th colspan="7">
                        <div class="searchbox">
                            <input
                                    type="text" id="search" class="search"
                                    aria-label="Search for a place on the map"
                                    autocomplete="off"
                                    inputmode="search"
                                    placeholder="Search here"
                                    type="search"
                            />
                        </div>
                    </th>
                </tr>
                <tr>
                    <th  colspan="7">
                        <button class="my-print-btn" type="button" id="printLowQty" style="width: 170px; height: 40px"><span><span style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">print</span>&nbsp;  Low Items (<span  style="color: red" id="lowQunt">-</span>)</span></button>

                    </th>
                </tr>
                <tr>
                    <th>Item Code</th>
                    <th>Item name</th>
                    <th>Qty.</th>
                    <th>Reorder Level</th>
                    <th>Status</th>
                    <th>Last added Qty.</th>
                    <th>Last updated date</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <br><br><br><br><br>
        </div>
    </div>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/stock_controller.js"></script>
</body>
</html>