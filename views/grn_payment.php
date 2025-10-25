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
                <th colspan="3"><h1 class="mainHeading">GRN payment update form </h1></th>
            </tr>
            </thead>

            <tr>
                <td>
                    <label>GRN number</label>
                </td>
                <td>
                    <div class="selectoccasion">
                        <select type="text" name="grnNo" id="grnNoField"><br>
                            <option disabled selected value="" class="chosen">Select GRN number</option>
                        </select>
                        <br>
                        <span class="error-msg" id="grnNo_msg"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Total GRN amount</label>
                </td>
                <td>
                    <input type="text" name="totalGrnAmt" id="totalGrnAmt" disabled style="background-color: #eeeeee"><br>
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
                    <input type="text" name="balance" id="balance" disabled readonly style="background-color: #eeeeee; font-size: 20px; font-weight: bold""><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Payment</label>
                </td>
                <td>
                    <input type="text" name="payment" id="payment" placeholder="Ex - 1000"><br>
                    <span class="error-msg" id="payment_msg"></span>
                </td>
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
<script type="text/javascript" src="./controllers/grn_payment_controller.js"></script>
</body>
</html>


