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
    <div class="main--content" style="text-align: left">
        <br>
        <h1 style="text-align: center">Cake configurations</h1><br>
        <div class="searchbox" style="text-align: center;">
            <input
                    type="text" id="search" class="search"
                    aria-label="Search for a place on the map"
                    autocomplete="off"
                    inputmode="search"
                    placeholder="Search here"
                    type="search"
            /><br><br>
            <label>(Following quantities showing with Kg, L, Pc)</label>
        </div><br>
        <div id="configs"></div>


    </div>
</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/viewConfig_controller.js"></script>
</body>
</html>


