<?php
require_once './others/class/common_function.php';
$app = new setting();
?>
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
                <!--==============================================================================-->
                <h1 class="mainHeading">Outlet billing system</h1>

                <div class="page_row">
                    <div class="page_div_6">
                        <div class="table_div">
                            <table id="itemTable">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                            <div class="searchbox" >
                                                <input
                                                    style="width: 100%; height: 40px; background-color: #ffe968; color: #000000; font-size: 28px;
                                                    type="text" id="search" class="search"
                                                    aria-label="Search for a place on the map"
                                                    autocomplete="off"
                                                    inputmode="search"
                                                    placeholder="Search item"
                                                    type="search"
                                                    />
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Exp Date</th>
                                        <th>Ava. Qty</th>
                                        <th>Add to bill</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <table class="table">
                            <tr class="d-none" id="selectItemMsg">
                                <td><span class="error-msg" style="font-size: 20px">Select an item</span></td>
                            </tr>
                            <tr style="line-height: 14px;">
                                <td style="font-weight: bold">Selected item</td>
                                <td style="font-weight: bold"><input type="text" id="selectedItm" readonly disabled class="pricebox" style="width: 100%; background-color: #eeeeee"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Quantity</td>
                                <td style="font-weight: bold"><input type="text" id="itemQty" class="pricebox"style="width: 100%; background: #ffe968; color: #000000; font-weight: bold; font-size: 25px;"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; font-size: 25px;">Item Total : <span id="itemTot">0.00</span></td>
                                <td style="vertical-align: central">
                                    <button class="my-detail-btn" type="button" id="addItemToLog" style="width: 100%; height: 40px"><span><span  style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">add</span>&nbsp; Add Item</span></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="page_div_1"></div>
                    <div class="page_div_4">
                        <div class="table_div_short">
                            <table id="addedBillItemDetails">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty.</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <table class="table" >
                            <tr class="d-none" id="totalMsg">
                                <td colspan="2"><span class="error-msg" style="font-size: 20px">No items added to the bill</span></td>
                            </tr>
                            <tr style="line-height: 14px;">
                                <td style="font-weight: bold">Bill No.</td>
                                <td style="font-weight: bold"><input type="text" id="billNo" readonly disabled class="pricebox" style="width: 100%; background-color: #eeeeee; font-size:22px; font-weight:bold; text-align: center "></td>
                            </tr>
                            <tr style="line-height: 14px;">
                                <td style="font-weight: bold">Total bill amount</td>
                                <td style="font-weight: bold"><input type="text" id="grandTotal"  class="pricebox" style="width: 100%; background-color: #eeeeee; font-size:22px; font-weight:bold; text-align: center"></td>
                            </tr>
                            <tr style="line-height: 14px;">
                                <td style="font-weight: bold">Paid amount</td>
                                <td style="font-weight: bold"><input type="text" id="paidAmt" class="pricebox" style="width: 100%;  font-size:22px; font-weight:bold; text-align: center"></td>
                            </tr>
                            <tr style="line-height: 14px;">
                                <td style="font-weight: bold">Balance</td>
                                <td style="font-weight: bold"><input type="text" id="balanceamt" readonly disabled class="pricebox" style="width: 100%; background-color: #eeeeee; font-size:22px; font-weight:bold; text-align: center"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="vertical-align: central">
                                    <button class="my-save-btn" type="button" id="finishBill" style="width: 82%; height: 40px"><span><span style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">print</span>&nbsp;   Finish Bill</span></button>
                                    <button class="my-del-btn" type="button" id="resetBill" style="width: 10%; height: 40px"><span><span style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">restart_alt</span></span></button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div><br><br><br>
            </div>
            <div></div>
            <!--==============================================================================-->
        </div>
    </section>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/outlet_management_controller.js"></script>
</body>
</html>


