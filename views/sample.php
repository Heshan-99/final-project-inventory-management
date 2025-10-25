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
                <h1>Employee form</h1>
                <table cellspacing="5">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <div class="selectweight">
                                <select type="text" name="title" id="titlefield"><br>
                                    <option disabled selected value="">Select a title</option>
                                    <option>Mr.</option>
                                    <option>Mrs.</option>
                                    <option>Miss.</option>
                                    <option>Rev.</option>
                                    <option>Dr.</option>
                                </select>
                                <input type="text" name="name" id="namefield"><br>
                                <span class="error-msg" id="errornamefield"></span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>NIC number</label>
                        </td>
                        <td>
                            <input type="text" name="nic" id="nicfield"><br>
                            <span class="error-msg" id="errornicfield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Date of birth</label>
                        </td>
                        <td>
                            <input type="date" name="dob" id="dobfield"><br>
                            <span class="error-msg" id="errordobfield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Gender</label>
                        </td>
                        <td>
                    <lable><input class="radio" value="Male" type="radio" name="gender" id="genderfield">Male</lable>&nbsp;&nbsp;
                    <lable><input class="radio" value="Female" type="radio" name="gender" id="genderfield">Female</lable>
                    <br>
                    <span class="error-msg" id="errorgenderfield"></span>
                    </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Mobile No.</label>
                        </td>
                        <td>
                            <input type="text" name="mobile" id="mobilefield"><br>
                            <span class="error-msg" id="errormobilefield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Land No.</label>
                        </td>
                        <td>
                            <input type="text" name="land" id="landfield"><br>
                            <span class="error-msg" id="errorlandfield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Address</label>
                        </td>
                        <td>
                            <textarea name="address" id="addressfield"></textarea><br>
                            <span class="error-msg" id="erroraddressfield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" id="emailfield"><br>
                            <span class="error-msg" id="erroremailfield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Designation</label>
                        </td>
                        <td>
                            <div class="selectweight">
                                <select type="text" name="designation" id="designationfield">
                                    <option diabled selected value="">Select a title</option>
                                    <option>Lecturer</option>
                                    <option>Demostrator</option>
                                    <option>CEO</option>
                                    <option>Receptionist</option>
                                    <option>Secretory</option>
                                </select>
                                <span class="error-msg" id="errordesignationfield"></span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Recruite date</label>
                        </td>
                        <td>
                            <input type="date" name="recdate" id="recdatefield"><br>
                            <span class="error-msg" id="errorrecdatefield"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Status</label>
                        </td>
                        <td>
                    <lable><input class="radio" id="statusfield" value="Working" type="radio" name="workingstatus">Working</lable>&nbsp;&nbsp;
                    <lable><input class="radio" id="statusfield" value="Non working" type="radio" name="nonworkingstatus">Non working</lable>
                    <br>
                    <span class="error-msg" id="errorstatusfield"></span>
                    </td>
                    </tr>


                    <tr>
                        <td>
                            <label>Photo</label>
                        </td>
                        <td>
                            <img style="width:150px; margin-bottom:5px; border-radius:10%; border:1px solid #ccc" id="photoPreview"
                                 src = "../../Assets/images/dummyphoto.png"
                                 style="width:70px; margin-bottom:5px; border-radius:10%; border:1px solid #ccc"><br>
                            <input type="file" name="photo" id="photofield">
                            <span class="error-msg" id="errorphotofield"></span>
                        </td>
                    </tr>


                </table>
                <!--<a class="my-btn" href="table.php">Show all employees</a>-->
                <!--<button class="save-btn" type="submit">Save changes</button>-->

                <button class="my-save-btn" type="button" id="SaveEmp">Save Employee Details</button>
                <button class="my-del-btn" type="button" id="resetEmp">Reset Form</button>
            </div>
            <!--==============================================================================-->                
        </div>
    </section>
    <?php require_once './others/sub_pages/all_js.php'; ?>
    <script type="text/javascript" src="./controllers/emp_insert_controller.js"></script>
</body>
</html>


