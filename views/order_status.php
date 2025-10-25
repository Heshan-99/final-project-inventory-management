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
            <table cellspacing="0" cellpadding="5" id="addedOrder_tbl" style="text-align: center">
                <thead>
                <tr>
                    <th colspan="9"><h1 class="mainHeading">Order status</h1></th>
                </tr>
                <tr>
                    <th colspan="9">
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
                        <br>
                        <div class="selectoccasion">
                            <select name="date" id="orderStatusPicker" class="dropdown item--filter"
                                    style="width: 200px">
                                <option value="99">All orders</option>
                                <option value="0">Pending</option>
                                <option value="1">Processing</option>
                                <option value="2">Completed</option>
                                <option value="3">Payment completed</option>
                                <option value="4">Delivered</option>
                                <option value="5">Cancelled</option>
                            </select>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Order no.</th>
                    <th>Customer name</th>
                    <th>Order amount</th>
                    <th>Advanced</th>
                    <th>Balance</th>
                    <th>Ordered date</th>
                    <th>Order required date</th>
                    <th>Status</th>
                    <th>
                        Update Status
                        <div class="tooltip">
                            <span class="material-symbols-outlined">help</span>
                            <span class="tooltiptext">Note - You cannot rollback after order status change to "Process".</span>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br><br><br><br><br>
    </div>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/order_status_controller.js"></script>
    <style>
        .tooltip {
            position: absolute;
            display: inline-block;
            font-size: 15px;
            margin-left: 10px;
            cursor: default;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 300px;
            background-color: #ffffff;
            border: 0.5px solid #3b3a3a ;
            color: #363949;
            font-size: 15px;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            top: -5px;
            right: 110%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 1s;
            box-shadow: 0 0.5rem 1rem rgba(132, 139, 200, 1);
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</body>
</html>