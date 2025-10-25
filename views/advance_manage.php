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
                <th colspan="3"><h1 class="mainHeading">Order payment update form </h1></th>
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
                        <br>
                        <span class="error-msg" id="orderNo_msg"></span>
                    </div>
                </td>
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
                    <label>Payable amount</label>
                </td>
                <td>
                    <input type="text" name="balanceAmt" id="balanceAmt" disabled style="background-color: #eeeeee; font-size: 20px; font-weight: bold"><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>
                    <label>Received amount</label>
                </td>
                <td>
                    <input type="text" name="recAmt" id="recAmt" style="font-size: 20px; font-weight: bold"><br>
                    <span class="error-msg" id="recAmt_msg"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Balance</label>
                </td>
                <td>
                    <input type="text" name="balance" id="balance" disabled readonly style="background-color: #eeeeee;"><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td></td>
                <td class="tablebtn">
                    <button class="update-btn" type="button" id="updateBalance">Complete Payment</button>
                    <button class="my-del-btn" type="button" id="resetForm">Clear Form</button>
                </td>
            </tr>
        </table>
        <br>
    </div>
</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/advance_manage_controller.js"></script>
</body>
</html>


