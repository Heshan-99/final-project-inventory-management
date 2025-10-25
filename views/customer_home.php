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

        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">

                <div class="slide first">
                    <img src="./others/Assets/Images/Coverphotos/1.png" alt="cover photo 1">
                </div>
                <div class="slide">
                    <img src="./others/Assets/Images/Coverphotos/2.png" alt="cover photo 2">
                </div>
                <div class="slide">
                    <img src="./others/Assets/Images/Coverphotos/3.png" alt="cover photo 3">
                </div>
                <div class="slide">
                    <img src="./others/Assets/Images/Coverphotos/4.png" alt="cover photo 4">
                </div>

                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
            </div>

            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>

            <script type="text/javascript">
                var counter = 1;
                setInterval(function () {
                    document.getElementById('radio' + counter).checked = true;
                    counter++;
                    if (counter > 4) {
                        counter = 1;
                    }
                }, 5000);
            </script>
        </div>
        <br>
        <br>

        <div class="searchbox" style="text-align: center">
            <input
                    type="text" id="search" class="search"
                    aria-label="Search for a place on the map"
                    autocomplete="off"
                    inputmode="search"
                    placeholder="Search here"
                    type="search"
            />
        </div>
        <br>

        <div class="listProduct" id="listProductContainer">
            <div class="item" id="listProductItem">
                <div class="image"><img src="" alt="Cake photo"></div>
                <div class="occasion"></div>
                <div class="totalPrice"></div>
<!--                <button class="addCart">Add to cart</button>-->
            </div>
        </div>

        <div class="cartTab">
            <h1>Shopping cart</h1>
            <div class="listCart">
                <div class="item">
                </div>
            </div>
            <div class="btn">
                <button class="close">Close</button>
                <button class="checkOut">Check out</button>
            </div>
        </div>
    </div>


</section>


<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/customer_home_controller.js"></script>




</body>
<?php //require_once './others/sub_pages/cust_footer.php'; ?>
</html>


