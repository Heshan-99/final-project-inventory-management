<?php
require_once './others/class/common_function.php';
$app = new setting();
?>
<html>
<head>
    <title></title>
    <?php require_once './others/sub_pages/all_css.php'; ?>
</head>
<body>
<?php require_once './others/sub_pages/header.php'; ?>
<section class="main">

    <?php require_once './others/sub_pages/sidebar.php'; ?>
    <div class="main--content">
        <h1 class="mainHeading">Add Goods Received Note (GRN)</h1>
        <table>
            <th>
                <div class="grnTable selGrn">

                    <!--==============================block 1 select item table=============================-->

                    <table cellspacing="0" cellpadding="5" id="grn_item_table"
                           style="max-height: 100%; height: 235px; width: 500px">
                        <thead style="display: inline">
                        <h2>Select item</h2>
                        <div>
                            <input
                                    class="searchbox"
                                    type="text" id="search"
                                    aria-label="Search for a place on the map"
                                    autocomplete="off"
                                    inputmode="search"
                                    placeholder="Search here "
                                    type="search"
                            />
                        </div>

                        <tr style="text-align: center">
                            <th style="width: 100px">Item Code</th>
                            <th style="width: 200px">Item</th>
                            <th style="width: 100px">Ava Qty</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody style="max-height: 200px; overflow-y: scroll; display: inline-block; ">
                        </tbody>
                    </table>
                </div>
            </th>
            <th>
                <div class="grnTable">

                    <!--==============================block 2 qty table=============================-->

                    <table cellspacing="0" cellpadding="5" id="">
                        <tbody>
                        <tr>
                            <td><label>Selected Item:</label></td>
                            <td><input type="text" name=selItem" id="selItemfield" style="background-color: #eeeeee"
                                       disabled readonly=""><br>
                                <span class="error-msg" id="selItem_msg"></span></td>
                        </tr>
                        <tr>
                            <td><label>Available Qty.:</label></td>
                            <td><input type="text" name=availableQty" id="availableQtyfield"
                                       style="background-color: #eeeeee" disabled readonly=""><br>
                                <span class="error-msg" id="availableQty_msg"></span></td>
                        </tr>
                        <tr>
                            <td>
                                <label>New Qty:</label>
                                <div class="tooltip">
                                    <span class="material-symbols-outlined">help</span>
                                    <span class="tooltiptext">New quantity should be whole number. <br> Ex - 1Kg / 1 Liter / 1 Item . etc</span>
                                </div>
                            </td>
                            <td><input type="text" name="newQty" id="newQty" placeholder="Ex - 100"><br>
                                <span class="error-msg" id="newQty_msg"></span></td>
                        </tr>
                        <tr>
                            <td><label>Total price (Rs.):</label></td>
                            <td><input type="text" name="totalPrice" id="totalPricefield" placeholder="Ex - 1000"><br>
                                <span class="error-msg" id="totalPrice_msg"></span></td>
                        </tr>
                        <tr id="unit">
                            <td>
                                <label>Unit price (Rs.):<br><span style="font-weight: bold; font-size: 12px">(1Kg / 1Liter / 1Item . etc)</span></label>
                            </td>
                            <td><input type="text" name="unit" id="unitfield" disabled style="background-color: #eeeeee" readonly><br>
                                <span class="error-msg" id="unit_msg"></span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="float: right">
                                <button class="my-save-btn" type="button" id="addItem">Add item</button>
                                <button class="my-del-btn" type="button" id="resetItemQty">Clear Form</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </th>
            <tr>
                <td>
                    <div class="grnTable">

                        <!--==============================block 3 GRN summary table=============================-->

                        <table cellspacing="0" cellpadding="5" id="grn_added_item_table"
                               style="max-height: 100%; height: 280px">
                            <thead>
                            <h5 style="text-align: center; font-size: 20px; padding-bottom: 10px">Added GRN item
                                summary</h5>
                            <tr>
                                <th>Item name</th>
                                <th>Added Qty</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </td>
                <td>
                    <div class="grnTable selGrn">

                        <!--==============================block 4 Finish GRN table=============================-->

                        <table cellspacing="0" cellpadding="5" id="" style="max-height: 100%; height: 310px">
                            <tbody>
                            <tr>
                                <td><label>GRN No.:</label></td>
                                <td><input type="text" name=GRNNo" id="GRNNofield" style="background-color: #eeeeee"
                                           disabled readonly><br>
                                    <span class="error-msg" id="GRNNo_msg"></span></td>
                            </tr>
                            <tr>
                                <td><label>GRN date:</label></td>
                                <td>
                                    <input type="date" name="GRNDate" id="GRNDatefield"
                                           value="<?php echo date('Y-m-d'); ?>"><br>
                                    <span class="error-msg" id="GRNDate_msg"></span>
                                </td>
                            </tr>
                            <tr id="supplierrow">
                                <td><label>Supplier:</label></td>
                                <td>
                                    <select id="sup">
                                        <option selected="selected">Select supplier</option>
                                    </select><br>
                                    <span class="error-msg" id="sup_msg"></span>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Total GRN Amount:</label></td>
                                <td><input type="text" style="background-color: #eeeeee" disabled readonly
                                           name="GRNAmount" id="grnTotalAmnt"><br>
                                    <span class="error-msg" id=""></span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="float: right">
                                    <button class="my-save-btn" type="button" id="finishGrn">Finish GRN</button>
                                    <button class="my-del-btn" type="button" id="resetGrn">Reset GRN</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

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

<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/grn_controller.js"></script>
</html>