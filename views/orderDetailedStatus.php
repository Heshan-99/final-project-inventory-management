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

        <table cellspacing="5" class="table topform">
            <thead>
            <tr>
                <th colspan="3"><h1 class="mainHeading">Order Details</h1></th>
            </tr>
            </thead>
            <tr>
                <td>
                    <label>Order number</label>
                </td>
                <td>
                    <div class="selectoccasion">
                        <select type="text" name="orderNo" id="orderNoField"><br>
                            <option disabled selected value="">Select order number</option>
                        </select>
<!--                        <button class="my-save-btn" type="button" id="getDetailsBtn">Get Details</button>-->
<!--                        <button class="my-del-btn" type="clear" id="resetForm" >Clear</button>-->
                        <br>
                        <span class="error-msg" id="orderNo_msg"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Order Status</label>
                </td>
                <td>
                    <input type="text" name="orderStatus" id="orderStatus" disabled style="background-color: #eeeeee;">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Ordered date</label>
                </td>
                <td>
                    <input type="text" name="orderedDate" id="orderedDate" disabled style="background-color: #eeeeee;">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Required date</label>
                </td>
                <td>
                    <input type="text" name="reqDate" id="reqDate" disabled style="background-color: #eeeeee;">
                </td>
            </tr>

            <tr>
                <td colspan="2"></td>
            </tr>

            <tr>
                <td>
                    <label>Total order amount</label>
                </td>
                <td>
                    <input type="text" name="totalAmt" id="totalAmt" disabled style="background-color: #eeeeee"><br>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Paid amount</label>
                </td>
                <td>
                    <input type="text" name="paidAmt" id="paidAmt" disabled style="background-color: #eeeeee"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Balance</label>
                </td>
                <td>
                    <input type="text" name="balanceAmt" id="balanceAmt" disabled style="background-color: #eeeeee; font-size: 20px; font-weight: bold"><br>
                </td>
            </tr>
        </table>
        <br>

        <div class="bottomTable">
            <table cellspacing="0" cellpadding="5" id="orderDetail_tbl" class="table">
                <thead>
                <tr>
                    <th width="30%">Cake name</th>
                    <th width="10%">QTY</th>
                    <th width="10%">Weight</th>
                    <th width="50%">Note</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/orderDetailedStatus_controller.js"></script>
</body>
</html>


