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

                <table cellspacing="5" class="table topform">
                    <thead>
                    <th colspan="3"><h1 class="mainHeading">Insert expenses</h1></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Expense type</td>
                            <td>
                                <div class="selectoccasion">
                                    <select id="expenseField">
                                    </select>
                                    <br>
                                    <span class="error-msg" id="expenseField_msg"></span>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label>Paid amount</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="amountfield"><br>
                                <span class="error-msg" id="amount_msg"></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Paid date</label>
                            </td>
                            <td>
                                <input type="date" name="date" id="datefield"><br>
                                <span class="error-msg" id="date_msg"></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Note (optional)</label>
                            </td>
                            <td>
                                <input type="text" name="note" id="notefield"><br>
                                <span class="error-msg" id="note_msg"></span>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="tablebtn">
                                <button class="my-save-btn" type="button" id="SaveExpense">Save expense Details</button>
                                <button class="update-btn d-none" type="button" id="updateCake">Update Cake Details</button>
                                <button class="my-del-btn" type="button" id="resetExpense">Clear Form</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                <div class="bottomTable">
                    <table cellspacing="0" cellpadding="5" id="addedExpenses_tbl" class="table">
                        <thead>
                        <tr>
                            <th colspan="5"><h1 class="mainHeading">Paid expenses</h1></th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <input type="text" value="<?php echo date('Y-m'); ?>" id="date">
                                <div class="tooltip">
                                    <span class="material-symbols-outlined">help</span>
                                    <span class="tooltiptext">Search paid expense by date with following format "YYYY-MM". <br> Ex - "2024-06"</span>
                                </div>
                            </th>
                            <th colspan="3">
                                <span class="error-msg" id="expenseField2_msg"></span>
                                <div class="selectoccasion">
                                    <select id="expenseField2">
                                    </select>
                                    <br>
                                    <span class="error-msg" id="expenseField2_msg"></span>
                                </div>
                            </th>
                        </tr>
                            <tr>
                                <th>Expense type</th>
                                <th>Amount</th>
                                <th>Paid date</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br><br>
                <!--==============================================================================-->
            </div>
        </section>
    </div>

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
    <script type="text/javascript" src="./controllers/expenses_controller.js"></script>

</body>
</html>


