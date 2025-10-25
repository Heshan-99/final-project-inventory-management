<!doctype html>
<html lang="en">
<head>
    <?php require_once './others/sub_pages/all_css.php'; ?>
</head>
<body>
<?php require_once './others/sub_pages/cust_header.php'; ?>
<section class="cust--main">
    <div class="cust--main--content">
        <div class="custLoginForm" style="padding-top:60px; align-content: center; align-content: center; width: 70%; max-height:200px; height: 100%; margin: 0 auto;">
            <div class="form" style="box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18); width: 70%; height: 500px">
                <table style="width: 70%; align-content: center; align-content: center; width: 70%; max-height:500px; height: 100%; margin: 0 auto;">
                    <tr>
                        <td></td>
                        <td colspan="2"><h2 style="color: black; text-align: center">Register</h2></td>
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
                                <input type="text" name="name" id="custnamefield" placeholder="Ex - John Smith"
                                       style="width: 330px"><br>
                                <span class="error-msg" id="name_msg"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Address</label></td>
                        <td><textarea></textarea></td>
                    </tr>
                    <tr>
                        <td><label>Mobile no.</label></td>
                        <td><input type="text" placeholder="Ex - 07XXXXXXXX"></td>
                    </tr>
                    <tr>
                        <td><label>Email</label></td>
                        <td><input type="text" placeholder="Ex - name@gmail.com"></td>
                    </tr>
                    <tr>
                        <td><label>Password</label></td>
                        <td><input type="password"></td>
                    </tr>
                    <tr>
                        <td><label>Confirm password</label></td>
                        <td><input type="password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <button type="submit" class="my-save-btn">Register</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>


<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/customer_home_controller.js"></script>


</body>
<?php //require_once './others/sub_pages/cust_footer.php'; ?>
</html>


