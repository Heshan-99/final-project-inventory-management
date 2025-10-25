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
                <h1 class="mainHeading">Add new order</h1>
                <table cellspacing="5">
                    <tr>
                        <!--==========block 1==============-->
                        <td style="width: 40%" >

                            <table class="ordertable" style="height: 350px" >
                                <thead>
                                    <tr><td></td></tr>
                                </thead>
                                <tr>
                                    <td>
                                        <label>Select cake type</label>
                                    </td>
                                    <td>
                                        <div class="selectType">
                                            <select type="text" name="title" id="cakeType" class=""></select>
                                            <br>
                                            <span class="error-msg" id="errorSelectfield"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Weight (KG)</label>
                                    </td>
                                    <td>
                                        <input type="text" name="price" id="weightfield"><br>
                                        <span class="error-msg" id="errorweightfield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Price</label>
                                    </td>
                                    <td>
                                        <input type="text" name="price" id="pricefield" style="background-color: #eeeeee" disabled readonly><br>
                                        <span class="error-msg" id="errorpricefield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Quantity</label>
                                    </td>
                                    <td>
                                        <input type="text" name="quantity" id="quantityfield" value="1"><br>
                                        <span class="error-msg" id="errorquantityfield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Special notes<br>(optional)</label>
                                    </td>
                                    <td>
                                        <textarea type="text" id="splNote"></textarea><br>
                                        <span class="error-msg" id="errorsplNotefield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="my-save-btn" type="button" id="addOrder">Add cake to order</button>
                                        <button class="my-del-btn" type="button" id="resetCakeTypeForm">Clear Form</button>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <!--==========block 2==============-->
                        <td style="width: 40%" >
                            <table class="ordertable">
                                <thead><tr><td></td></tr></thead>
                                <tr>
                                    <td>
                                        <label>Order No.</label>
                                    </td>
                                    <td>
                                        <input type="text" id="orderNOfield" style="background-color: #eeeeee" disabled readonly><br>
                                        <span class="error-msg" id="errororderNOfield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Required date</label>
                                    </td>
                                    <td>
                                        <input type="date" id="reqDatefield"><br>
                                        <span class="error-msg" id="errorreqDatefield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Select customer</label>
                                    </td>
                                    <td>
                                        <div class="selectCustomer">
                                            <select type="text" id="selectCustomer" class="chosen" >
                                            </select>
                                            <br>
                                            <span class="error-msg" id="errorCustomer"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Order Amount</label>
                                    </td>
                                    <td>
                                        <input type="text" id="orderAmountfield" style="background-color: #eeeeee" disabled readonly><br>
                                        <span class="error-msg" id="errororderAmountfield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Advanced Amount</label>
                                    </td>
                                    <td>
                                        <input type="text" id="advancedAmountfield"><br>
                                        <span class="error-msg" id="erroradvancedAmountfield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Balance Amount</label>
                                    </td>
                                    <td>
                                        <input type="text" id="balanceAmountfield" style="background-color: #eeeeee" disabled readonly><br>
                                        <span class="error-msg" id="errorbalanceAmountfield"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="my-save-btn" type="button" id="completeOrder"><span style="vertical-align: bottom; font-size: 18px !important;" class="inline-icon material-symbols-outlined">print</span>&nbsp;Complete order</button>
                                        <button class="my-del-btn" type="button" id="resetOrder">Clear Form</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <br>


                <table class="table" id="orderSummary" style="max-height: 100%; height: 300px; overflow-y: auto">
                    <thead>
                    <tr>
                        <th colspan="5"><h3 style="text-align: center">Order Summary</h3></th>
                    </tr>
                        <tr>
                            <th>Cake type</th>
                            <th>Weight</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead >
                    <tbody style="text-align: center; height: 50px;">
                    </tbody>
                </table>
                <br><br><br><br><br><br>

            </div>
            <!--==============================================================================-->                
        </div>
    </section>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/new_order_controller.js"></script>
</body>
</html>


