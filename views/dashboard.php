<!doctype html>
<html lang="en">
    <head>
        <?php require_once './others/sub_pages/all_css.php'; ?>
    </head>
    <body>
        <?php require_once './others/sub_pages/header.php'; ?>
        <section class="main">
            <?php require_once './others/sub_pages/sidebar.php'; ?>
            <div class="main--content">
                <div class="overview">
                    <div class="title">
                        <h2 class="section--title">Overview</h2>
                    </div>
                    <div class="cards ">
                        <a href="./?custReg" id="custRegCard" class="<?php echo ($_SESSION['designation'] == 'Deliver') ? 'd-none' : ''; ?> <?php echo ($_SESSION['designation'] == 'Cashier') ? 'd-none' : ''; ?>">
                            <div class="card card-1">
                                <div class="card--data">
                                    <div class="card--content">
                                        <h5 class="card--title"> Total Customers</h5>
                                        <div id="cusCount"></div>
                                    </div>
                                    <span class="material-symbols-outlined card--icon--lg">group</span>
                                </div>
                            </div>
                        </a>
                        <a href="./?orderStatus" id="orderStatusCard" class="<?php echo ($_SESSION['designation'] == 'Cashier') ? 'd-none' : ''; ?>">
                            <div class="card card-2">
                                <div class="card--data">
                                    <div class="card--content">
                                        <h5 class="card--title"> Ongoing Orders</h5>
                                        <div id="orderCount"></div>
                                    </div>
                                    <span class="material-symbols-outlined card--icon--lg">shopping_cart</span>
                                </div>
                            </div>
                        </a>
                        <div class="card card-3 <?php echo ($_SESSION['designation'] == 'Deliver') ? 'd-none' : ''; ?>" id="todaySalesCard">
                            <div class="card--data">
                                <div class="card--content">
                                    <h5 class="card--title">Today Sales</h5>
                                    <div id="todaySales"></div>
                                </div>
                                <span class="material-symbols-outlined card--icon--lg">calendar_month</span>
                            </div>
                        </div>
                        <div class="card card-4 <?php echo ($_SESSION['designation'] == 'Deliver') ? 'd-none' : ''; ?>" id="currentStockCard">
                            <div class="card--data">
                                <div class="card--content">
                                    <h5 class="card--title">Current Stock Value</h5>
                                    <div id="stockValue"></div>
                                </div>
                                <span class="material-symbols-outlined card--icon--lg">attach_money</span>
                            </div>
<!--                            <div class="card--stats">
                                <span><i class="ri-bar-chart-fill card--icon stat--icon"></i>85%</span>
                                <span><i class="ri-arrow-up-s-fill card--icon up--arrow"></i>12</span>
                                <span><i class="ri-arrow-down-s-fill card--icon down--arrow"></i>2</span>
                            </div>-->
                        </div>
                    </div>
                </div>

                <div class="recent--orders <?php echo ($_SESSION['designation'] == 'Cashier') ? 'd-none' : ''; ?>">
                    <div class="title">
                        <h2 class="section--title">Recent orders</h2>

                        <div class="items--right--btns">
                            <div class="tooltip">
                                <span class="material-symbols-outlined">help</span>
                                <span class="tooltiptext">
                                    🟡 - Pending<br>
                                    🔵 - Processing<br>
                                    🟢 - Order Completed<br>
                                    🟢🟢 - Payment completed<br>
                                    🟢🟢🟢 - Delivered<br>
                                    🔴 - Cancelled
                                </span>
                            </div>
                            <select name="date" id="orderStatusPicker" class="dropdown item--filter">
                                <option value="99">All orders</option>
                                <option value="0">Pending</option>
                                <option value="1">Processing</option>
                                <option value="2">Completed</option>
                                <option value="3">Payment completed</option>
                                <option value="4">Delivered</option>
                                <option value="5">Cancelled</option>
                            </select>
                            <a href="./?newOrder" class="<?php echo ($_SESSION['designation'] == 'Deliver') ? 'd-none' : ''; ?>">
                                <button class="add"><i class="ri-add-line"></i>Add order</button>
                            </a>
                        </div>
                    </div>
                    <div class="table">
                        <div class="searchbox" style="text-align: center">
                                        <input
                                            type="text" id="search"
                                            aria-label="Search for a place on the map"
                                            autocomplete="off"
                                            inputmode="search"
                                            placeholder="Search here (Order No., Customer No.)"
                                            type="search"
                                            style="text-align: center"
                                            />
                                    </div>
                        <table id="addedOrder_tbl" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>Order no.</th>
                                    <th>Status</th>
                                    <th>Customer no.</th>
                                    <th>Order amount</th>
                                    <th>Advanced</th>
                                    <th>Balance</th>
                                    <th>Order required date</th>
                                    <th>Ordered date</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <?php require_once './others/sub_pages/all_js.php'; ?>
        <script type="text/javascript" src="./controllers/dashboard_controller.js"></script>

        <style>
            .tooltip {
                position: absolute;
                display: inline-block;
                font-size: 15px;
                margin-left: -30px;
                cursor: default;
            }

            .tooltip .tooltiptext {
                visibility: hidden;
                width: 300px;
                background-color: #ffffff;
                border: 0.5px solid #3b3a3a ;
                color: #363949;
                font-size: 15px;
                text-align: left;
                border-radius: 6px;
                padding: 5px 0;
                padding-left: 30px;
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


