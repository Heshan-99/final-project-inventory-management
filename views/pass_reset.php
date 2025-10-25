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
                        <th colspan="4"><h1 class="mainHeading">Employee reset form</h1></th>
                    </tr>
                    </thead>
                    <tr>
                        <td><label>Select Employee</label></td>
                        <td>
                            <div class="selectoccasion">
                                <select id="emp">
                                    <option disabled selected value="">Select employee</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Selected emp. name</label>
                        </td>
                        <td>
                            <input type="text" name="empName" id="empNamefield" style="background-color: #eeeeee" disabled readonly><br>
                            <span class="error-msg" id="errorempNamefield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>NIC number</label>
                        </td>
                        <td>
                            <input type="text" name="nic" id="nicfield" style="background-color: #eeeeee" disabled readonly><br>
                            <span class="error-msg" id="errornicfield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Mobile</label>
                        </td>
                        <td>
                            <input type="text" name="Mobile" id="Mobilefield" style="background-color: #eeeeee" disabled readonly><br>
                            <span class="error-msg" id="errorMobilefield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <h3 class="d-none" id="passSetion" style="color: green">New Password : <span id="newPass"></span></h3>
                            <div class="tooltip">
                                <span class="d-none material-symbols-outlined" id="hintSymbol">help</span>
                                <span class="tooltiptext">Enter this code as temporary password till change the password.<br>
                                <span style="font-weight: bold"> (Note - This code must send to the employee privateley.)</span></span>
                            </div>
                        </td>
                        <style>
                            .tooltip {
                                position: relative;
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
                                right: -1300%;
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
                    </tr>
                    <tr>
                        <td>
                            <button class="my-del-btn" type="button" id="resetEmpPass">Reset Password</button>
                        </td>
                    </tr>

                </table>



    </div>
    <!--==============================================================================-->
    </div>
</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/pass_reset_controller.js"></script>
</body>
</html>


