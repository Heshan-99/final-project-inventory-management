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
            <th colspan="3"><h1 class="mainHeading">Employee form</h1></th>
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
                            <option>Dr.</option>
                        </select>
                        <input class="namefield" type="text" name="name" id="empnamefield" placeholder="Ex - John Smith"><br>
                        <!--                                <h6 style="color: red;" class="d-none" id="name_msg">Required field</h6>-->
                        <span class="error-msg" id="name_msg"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label>NIC number</label>
                </td>
                <td>
                    <input type="text" name="nic" id="nicfield" placeholder="Ex - 99XXXXXXXV / 1999XXXXXXXX"><br>
                    <!--                            <h6 style="color: red;" class="d-none" id="nic_msg">Required field</h6>-->
                    <span class="error-msg" id="nic_msg"></span>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Date of birth</label>
                </td>
                <td>
                    <input type="date" name="dob" id="dobfield"><br>
                    <span class="error-msg" id="dob_msg"></span>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Gender</label>
                </td>
                <td>
                    <lable><input class="radio" value="Male" type="radio" name="gender" id="genderfield1">Male
                    </lable>&nbsp;&nbsp;
                    <lable><input class="radio" value="Female" type="radio" name="gender" id="genderfield2">Female
                    </lable>
                    <br>
                    <span class="error-msg" id="gender_msg"></span>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Mobile No.</label>
                </td>
                <td>
                    <input type="text" name="mobile" id="mobilefield" placeholder="Ex - 07XXXXXXXX"><br>
                    <!--                            <h6 style="color: red;" class="d-none" id="mobile_msg">Required field</h6>-->
                    <span class="error-msg" id="mobile_msg"></span>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Land No. (optional)</label>
                </td>
                <td>
                    <input type="text" name="land" id="landfield" placeholder="Ex - 03XXXXXXXX"><br>
                    <!--                            <h6 style="color: red;" class="d-none" id="land_msg">Required field</h6>-->
                    <span class="error-msg" id="land_msg"></span>
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
                    <label>Email</label>
                </td>
                <td>
                    <input type="text" name="email" id="emailfield" placeholder="Ex - name@gmail.com"><br>
                    <span class="error-msg" id="email_msg"></span>
                    <!--                            <h6 style="color: red;" class="d-none" id="email_msg">Required field</h6>-->
                </td>
            </tr>

            <tr>
                <td>
                    <label>Designation</label>
                </td>
                <td>
                    <div class="selectDesignation">
                        <select type="text" name="designation" id="designationfield">
                            <option diabled selected value="">Select a title</option>
                            <option>Owner</option>
                            <option>Admin</option>
                            <option>Baker</option>
                            <option>Deliver</option>
                            <option>Stock keeper</option>
                            <option>Cashier</option>
                        </select>
                        <br>
                        <span class="error-msg" id="designation_msg"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Recruite date</label>
                </td>
                <td>
                    <input type="date" name="recdate" id="recdatefield"><br>
                    <span class="error-msg" id="recdate_msg"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Photo</label>
                </td>
                <td>
                    <img style="width:150px; margin-bottom:5px; border-radius:10%; border:1px solid #ccc"
                         id="empPhotoPreview"
                         src="./others/Assets/Images/dummyphoto.jpg"
                         style="width:70px; margin-bottom:5px; border-radius:10%; border:1px solid #ccc"><br>
                    <input type="file" name="photo" id="empPhotofield"><br>
                    <span class="error-msg" id="photo_msg"></span>
                </td>
            </tr>
            <tr style="font-weight: bold">
                <td>
                    <label>Password</label>
                </td>
                <td>
                    <input type="password" name="pass" id="Passwordfield"><br>
                    <span class="error-msg" id="pass_msg"></span>
                </td>
            </tr>
            <tr style="font-weight: bold">
                <td>
                    <label>Confirm Password</label>
                </td>
                <td>
                    <input type="password" name="conPass" id="conPasswordfield" style="background-color: white"><br>
                    <span class="error-msg" id="conPass_msg"></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="tablebtn">
                    <button class="my-save-btn" type="button" id="SaveEmp">Save Employee Details</button>
                    <button class="my-del-btn" type="button" id="resetEmp">Clear Form</button>
                    <button class="update-btn d-none" type="button" id="updateEmp">Update Employee Details</button>
                </td>
            </tr>
        </table>
        <br>

        <div class="bottomTable">
            <table cellspacing="0" cellpadding="5" id="addedEmp_tbl" class="table">
                <thead>
                <tr>
                    <th colspan="8"><h1 class="mainHeading">All Employees detail</h1></th>
                </tr>
                <tr>
                    <th colspan="8">
                        <div class="searchbox">
                            <input
                                    class="searchbox"
                                    type="text" id="search"
                                    aria-label="Search for a place on the map"
                                    autocomplete="off"
                                    inputmode="search"
                                    placeholder="Search here (Name,Address,Mobile,etc.)"
                                    type="search"
                            />
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Employee Code</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br><br><br><br><br>
    </div>


    </div>


    <!--==============================================================================-->
    </div>

</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/emp_controller.js"></script>
</body>
</html>


