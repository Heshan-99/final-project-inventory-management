<?php
require_once './others/class/common_function.php';
$app = new setting();

if (!isset($_GET['cakeId'])) {
    die("Error: Cake ID is missing.");
}

$cakeno = $_GET['cakeId'];

$query = "SELECT
        cake.`name`, 
        cake.occasion, 
        cake.photo, 
        cake.price, 
        cake.description, 
        cake.id, 
        cake.`code`, 
        CASE
        WHEN cake.cake_status = 0 THEN 'out of stock'
        WHEN cake.cake_status = 1 THEN 'in stock'
        END AS stock_status
        FROM
        cake
        WHERE
        cake.id = '{$cakeno}';";
$mainData = $app->basic_Select_Query($query);

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
        <div class="custLoginForm"
             style="padding-top:60px; align-content: center align-content: center; width: 70%; max-height:200px; height: 100%; margin: 0 auto;">
            <div class="form" style="box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18); width: 70%; height: 500px">
                <table style="width: 70%; align-content: center align-content: center; width: 70%; max-height:500px; height: 100%; margin: 0 auto;">
                    <tr>
                        <td rowspan="6"><img src="./others/upload_cake_designs/<?php echo $mainData[0]['photo']; ?> " alt="Cake image"
                                             style="height: 300px; width: 400px"></td>

                    </tr>
                    <tr valign="top">
                        <td>
                            <h1><?php echo $mainData[0]['name']; ?></h1>
                            <label><?php echo $mainData[0]['occasion']; ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td><p><?php echo $mainData[0]['description']; ?></p>
                    </tr>
                    <td><h1><?php echo $mainData[0]['price']; ?></h1>
                        <br>
                        <h4><?php echo $mainData[0]['stock_status']; ?></h4>
                    </td>
                    <tr>

                        <td>
                            <lable>Qty</lable>
                            <button id="plusBtn">&nbsp; - &nbsp;</button>
                            <input type="text" style="width: 50px" id="cakeQty">
                            <button id="minBtn">&nbsp; + &nbsp;</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="update-btn">Add to cart</button>
                            <button class="my-save-btn">Buy now</button>
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


