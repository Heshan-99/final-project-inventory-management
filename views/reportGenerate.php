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
        <h1 class="mainHeading">Report Generate</h1>

        <table cellspacing="5" class="table" id="inventoryTable">
            <thead>
            <tr>
                <th colspan="3">Basic and inventory reports</th>
            </tr>
            </thead>
            <tr>
                <td>Select category</td>
                <td>
                    <div class="selectoccasion">
                        <select id="reportType">
                            <option value="0" selected>Select option</option>
                            <option value="1">Employees</option>
                            <option value="2">Suppliers</option>
                            <option value="3">Customers</option>
                            <option value="4">Orders</option>
                            <option value="5">GRN summary</option>
                            <option value="6">GRN detailed report</option>
                            <option value="7">Outlet order report</option>
                        </select><br>
                        <span class="error-msg" id="reportType_msg"></span>
                    </div>

                </td>
                <td></td>
            </tr>
            <tr class="d-none selectReportType">
                <td>Report type</td>
                <td>
                    <input type="radio" style="text-align: left" name="reportType" value="1" class="radio" checked>All
                    <input type="radio" style="text-align: left" name="reportType" value="2" class="radio">Custom
                </td>
            </tr>
            <tr class="d-none dateRange">
                <td></td>
                <td><label>From</label></td>
                <td><label>To</label></td>
            </tr>
            <tr class="d-none dateRange">
                <td>Select date range</td>
                <td>
                    <input type="date" id="startDate" name="from"><br>
                    <span class="error-msg" id="startDate_msg"></span>
                </td>
                <td>
                    <input type="date" id="endDate" name="to"><br>
                    <span class="error-msg" id="endDate_msg"></span>
                </td>
                <td></td>
            </tr>
            <tr class="d-none enterBatchNo">
                <td>Enter GRN no</td>
                <td>
                    <div class="selectoccasion">
                        <select id="batchNo">
                        </select><br>
                        <span class="error-msg" id="batchNo_msg"></span>
                    </div>
                </td>
<!--                <td>-->
<!--                    <input type="text" id="batchNo" name="batchNo"><br>-->
<!--                    <span class="error-msg" id="batchNo_msg"></span>-->
<!--                </td>-->
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button class="my-detail-btn" type="button" id="generateBtn">Generate</button>
                    <button class="my-del-btn" id="resetForm">Clear</button>
                </td>
            </tr>
        </table>
        <br>

        <!--==============================================================================-->
    </div>
</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/reportGenerate_controller.js"></script>
</body>
</html>


