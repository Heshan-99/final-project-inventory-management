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
                <th colspan="3"><h1 class="mainHeading">Item form</h1></th>
            </tr>
            </thead>
            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                    <div class="selectoccasion">
                        <select type="text" name="catId" id="catIdfield"><br>
                            <option disabled selected value="0">Select a category</option>
                            <option value="1">Ingredients</option>
                            <option value="2">Others</option>
                        </select>
                        <div class="tooltip">
                            <span class="material-symbols-outlined">help</span>
                            <span class="tooltiptext">Ingredients - Sugar, flour, butter, etc.<br>Others - Tray, candles, etc.</span>
                        </div>
                        <br>
                        <span class="error-msg" id="category_msg"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Item name</label>
                </td>
                <td>
                    <input type="text" name="name" id="itemNamefield" placeholder="Ex - Sugar / Flour"><br>
                    <span class="error-msg" id="itemName_msg"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Metric</label>
                </td>
                <td>
                    <lable><input class="radio" value="kg" type="radio" name="metric" id="metricfield1">Kg
                    </lable>&nbsp;&nbsp;
                    <lable><input class="radio" value="l" type="radio" name="metric" id="metricfield2">L
                    </lable>&nbsp;&nbsp;
                    <lable><input class="radio" value="pc" type="radio" name="metric" id="metricfield3">Pc
                    </lable>&nbsp;&nbsp;
                    <br>
                    <span class="error-msg" id="metric_msg"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Item code</label>
                </td>
                <td>
                    <div class="itemSelect">
                        <input type="text" id="itemCode" style="background-color: #eeeeee" disabled readonly>
                        <span class="error-msg" id="category_msg"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Brand</label>
                </td>
                <td>
                    <div class="selectbrand">
                        <select type="text" name="brandId" id="brandIdfield"></select>
                        <button class="my-detail-btn" id="notListedBtn">Not listed?</button>
                        <br>
                        <span class="error-msg" id="brand_msg"></span>
                    </div>
                    <input type="text" id="newBrandField" class="d-none" placeholder="Enter new brand here"
                           style="width: 300px">
                    <button class="my-save-btn d-none" id="addNewBrandBtn">Add brand</button>
                    <br>
                    <span class="error-msg" id="newBrand_msg"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Reorder level</label>
                </td>
                <td>
                    <input type="text" name="reorderLevel" id="reorderLevelfield" placeholder=""><br>
                    <span class="error-msg" id="reorderLevel_msg"></span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="tablebtn">
                    <button class="my-save-btn" type="button" id="SaveItem">Save Item Details</button>
                    <button class="update-btn d-none" type="button" id="updateItem">Update Item Details</button>
                    <button class="my-del-btn" type="button" id="resetItem">Clear Form</button>
                </td>
            </tr>
        </table>
        <br>

        <!--==============================================================================-->

        <div class="bottomTable">
            <table cellspacing="0" cellpadding="5" id="addedItem_tbl" class="table">
                <thead>
                <tr>
                    <th colspan="5"><h1 class="mainHeading">All Item details</h1></th>
                </tr>
                <tr>
                    <th colspan="5">
                        <div class="searchbox">
                            <input
                                    type="text" id="search"
                                    aria-label="Search for a place on the map"
                                    autocomplete="off"
                                    inputmode="search"
                                    placeholder="Search here (Item name/Brand name)"
                                    type="search"
                            />
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Item Code</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br>

        <div class="bottomTable">
            <table cellspacing="0" cellpadding="5" id="addedbrand_tbl" class="table">
                <thead>
                <tr>
                    <th colspan="5"><h1 class="mainHeading">Brands</h1></th>
                </tr>
                <tr>
                    <th colspan="5">
                        <div class="searchbox">
                            <input
                                    type="text" id="Brandsearch"
                                    aria-label="Search for a place on the map"
                                    autocomplete="off"
                                    inputmode="search"
                                    placeholder="Search here (Item name/Brand name)"
                                    type="search"
                            />
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Brand name</th>
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

    <style>
        .tooltip {
            position: absolute;
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
            right: 110%;
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


</section>
<?php require_once './others/sub_pages/all_js.php'; ?>
<script type="text/javascript" src="./controllers/item_controller.js"></script>
</body>
</html>


