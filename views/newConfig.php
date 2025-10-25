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
                <h1 class="mainHeading">New configuration</h1>
                <table cellspacing="5" >
                    <tr>
                        <!--===============Block 1===============-->
                        <td width="50%">
                            <table cellspacing="5" class="configTable" id="addedItem_tbl">
                                <thead>
                                    <tr>
                                        <td>
                                            <label>Select cake type</label>
                                        </td>
                                        <td >
                                            <div class="selectweight">
                                                <select type="text" name="title" id="cakeType"></select>
                                                <br>
                                                <span class="error-msg" id="errorSelectfield" style="font-size: 15px; color: red "></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><h3 style="text-align: center">Available ingredients and items</h3>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2"><span class="error-msg" id="errorMsgMain" style="font-size: 15px; color: red; text-align: center"></span></td>
                                </tr>
                                <td colspan="2" style="text-align: right">
                                    <button class="my-del-btn" type="button" id="removeItem" style="margin-right: 10px">Reset</button>
                                    <button class="my-save-btn" type="button" id="addItem" style=" margin-right: 10px">Add items</button>
                                </td>
                                </tfoot>
                            </table>
                        </td>

                        <!--===============Block 2===============-->
                        <td rowspan="2">
                            
                            <table class="configTable" id="addedCakeDetail_tbl" style="text-align: center; max-height: 420px; height: 420px">
                                <thead style="font-weight: bold">
                                <td>Remove</td>
                                <td>Name</td>
                                <td>Qty/Amt</td>
                                <td>Unit price</td>
                                <td>Total</td>
                                </thead>
                                <tbody >
                                <tfoot>
                                    <tr colspan="5">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight: bold">Total Cost</td>
                                        <td><input type="text" id="grandTotal" style="font-weight: bold; background-color: #eeeeee" disabled readonly class="pricebox"></td>
                                    </tr>
                                    <tr colspan="5">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight: bold">Selling price</td>
                                        <td style="font-weight: bold"><input type="text" id="sellingPrice" class="pricebox"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="10">
                                            <button class="my-save-btn" type="button" id="finishConfig">Finish configuration</button>
                                        </td>
                                    </tr>
                                </tfoot>
                                </tbody>
                            </table>
                            
                        </td>
                    </tr>


                    <!--===============Block 3===============-->
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>

                <!--<a class="my-btn" href="table.php">Show all employees</a>-->
                <!--<button class="save-btn" type="submit">Save changes</button>-->


            </div>
        </div>
        <!--==============================================================================-->                
    </div>
</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/newConfig_controller.js"></script>
</body>
</html>



