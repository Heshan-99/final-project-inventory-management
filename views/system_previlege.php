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

                <table class="table" style="height: 400px">
                    <thead>
                    <tr>
                        <td colspan="3">
                            <h1 class="mainHeading">Privilege Management</h1>
                        </td>
                    </tr>
                    </thead>
                    <tr style="text-align: center">
                        <td colspan="3"><label>Select Employee</label>
                            <div class="selectoccasion">
                                <select id="emp" style="width: 50%; height: 30px; ">
                                    <option disabled selected value="">Select employee</option>
                                </select>
                            </div>
                            </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <label style="font-size: 20px">Available previleges</label>
                            <select id="ava_priv" multiple="" style="text-indent: 20px; font-size:15px; height: 300px; width: 450px; border-radius: 20px;margin-left: 8px">
                            </select>
                            <br>

                        </td>
                        <br>
                        <td style="width: 20%; text-align: center">
                            <span><button class="my-detail-btn" id="custAssign" type="button" style="width: 70%">Custom Assign ></button></span><br>
                            <span><button class="my-save-btn" id="allAsign" type="button" style="width: 70%">All Assign >></button></span><br>
                            <span><button class="update-btn" id="custRemove" type="button" style="width: 70%">< Custom Remove</button></span><br>
                            <span><button class="my-del-btn" id="allRemove" type="button" style="width: 70%"><< All Remove</button></span><br>
                        </td>
                        <td style="text-align: center">
                            <label style="font-size: 20px">Assigned privileges</label>
                            <select id="assi_priv" multiple="" style="text-indent: 20px; font-size:15px; height: 300px; width: 450px; border-radius: 20px"></select>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center"><h4>(Note - Press and hold "Ctrl" for select multiple previleges)</h4></td>
                    </tr>

                </table>
            </div>
            <!--==============================================================================-->                
        </div>
    </section>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/system_previlege_controller.js"></script>
</body>
</html>


