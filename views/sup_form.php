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
                    <th colspan="3"><h1 class="mainHeading">Supplier form</h1></th>
                </tr>
                </thead>
                <tr>
                    <td>
                        <label>Code</label>
                    </td>
                    <td>
                        <label id="codefield"></label>
                        <span class="error-msg" id="code_msg"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <div class="selecttitle">
                            <select type="text" name="title" id="titlefield"><br>
                                <option disabled selected value="">Select a title</option>
                                <option>Mr.</option>
                                <option>Mrs.</option>
                                <option>Miss.</option>
                                <option>Rev.</option>
                                <option>Other.</option>
                            </select>
                            <input class="namefield" type="text" name="name" id="namefield" placeholder="Ex - John Smith"><br>
                            <span class="error-msg" id="name_msg"></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <textarea name="address" id="addressfield"></textarea><br>
                        <span class="error-msg" id="address_msg"></span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Contact No.</label>
                    </td>
                    <td>
                        <input type="text" name="mobile" id="mobilefield" placeholder="Ex - 07XXXXXXXX"><br>
                        <span class="error-msg" id="mobile_msg"></span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email (optional)</label>
                    </td>
                    <td>
                        <input type="text" name="email" id="emailfield" placeholder="Ex - name@gmail.com"><br>
                        <span class="error-msg" id="email_msg"></span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="tablebtn">
                        <button class="my-save-btn" type="button" id="SaveSup">Save Supplier Details</button>
                        <button class="update-btn d-none" type="button" id="updateSup">Update Supplier Details</button>
                        <button class="my-del-btn" type="button" id="resetSup">Clear Form</button>
                    </td>
                </tr>
            </table>
            <br>

            <div class="bottomTable">
                <table cellspacing="0" cellpadding="5" id="addedSup_tbl" class="table">
                    <thead>
                    <tr>
                        <th colspan="6"><h1 class="mainHeading">All Supplier details</h1></th>
                    </tr>
                    <tr>
                        <th colspan="6">
                            <div class="searchbox">
                                <input
                                        type="text" id="search"
                                        aria-label="Search for a place on the map"
                                        autocomplete="off"
                                        inputmode="search"
                                        placeholder="Search here (Name,Address,Contact No.,etc.)"
                                        type="search"
                                />
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Supplier Code</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <br><br><br><br><br>

    </div>


</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/sup_controller.js"></script>
</body>
</html>


