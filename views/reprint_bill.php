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
                <br>
                <div class="table" style="height: auto">
                    <h1 class="mainHeading">Bill Reprint</h1>
                    <table cellspacing="0" cellpadding="5" id="oldBill_tbl" style="text-align: center">
                        <thead>
                            <tr>
                                <th colspan="5">
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
                                <th>Bill No.</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br>
            </div>
            <?php require_once './others/sub_pages/all_js.php'; ?>
            <script type="text/javascript" src="./controllers/reprint_bill_controller.js"></script>
    </body>
</html>