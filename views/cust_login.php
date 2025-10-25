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
<?php require_once './others/sub_pages/cust_header.php'; ?>
<section class="cust--main">
    <div class="cust--main--content">

        <div class="custRegForm" style="padding-top:100px; align-content: center align-content: center; width: 50%; height: 100%; margin: 0 auto;">
            <div class="form" style="box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18); width: 40%; align-content: center align-content: center; width: 50%; max-height:300px; height: 100%; margin: 0 auto;">
                <table style="align-content: center align-content: center; width: 70%; max-height:200px; height: 100%; margin: 0 auto;">
                    <tr>
                        <td></td>
                        <td colspan="2"><h2 style="color: black; text-align: center">Login</h2></td>
                    </tr>
                        <td><label>Email</label></td>
                        <td><input type="text" placeholder="Ex - name@gmail.com"></td>
                    </tr>
                    <tr>
                        <td><label>Password</label></td>
                        <td><input type="password"></td>
                    </tr>
                    <tr>

                        <td colspan="2" style="text-align: center">
                            <button type="submit" class="my-save-btn">Login</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <label>Dont have an account?</label><br>
                            <a href="./?cus=customerRegistration">Register here</a>
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


