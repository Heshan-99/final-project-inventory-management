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

                <table cellspacing="5" class="table topform">
                    <thead>
                    <th colspan="3"><h1 class="mainHeading">Insert new cake/other item</h1></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><b>(Note - If you are entering cake, the cake weight should be 1Kg)<b></td>
                                        </tr>
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
                                            <td>Type</td>
                                            <td>
                                                <div class="selectoccasion">
                                                    <select id="typeField">
                                                        <option value="0" selected>Select option</option>
                                                        <option value="1">Cake</option>
                                                        <option value="2">Other item (Cup cake, pastry, buns, etc.)</option>
                                                    </select>
                                                    <br>
                                                    <span class="error-msg" id="itemType_msg"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Name</label>
                                            </td>
                                            <td>
                                                <input type="text" name="name" id="namefield"><br>
                                                <span class="error-msg" id="name_msg"></span>
                                            </td>
                                        </tr>

                                        <tr class="d-none" id="itemTypeSection">
                                            <td>
                                                <label>Occasion</label>
                                            </td>
                                            <td>
                                                <div class="selectoccasion">
                                                    <select name="occasion" id="occasionfield">
                                                        <option selected value="0">Select a occasion</option>
                                                        <option>Other</option>
                                                        <option>Anniversary Cakes</option>
                                                        <option>Baby Shower Cakes</option>
                                                        <option>Birthday Cakes</option>
                                                        <option>Bridal Shower Cakes</option>
                                                        <option>Corporate Events</option>
                                                        <option>Cultural Celebrations</option>
                                                        <option>Graduation Cakes</option>
                                                        <option>Halloween Cakes</option>
                                                        <option>Holiday Cakes</option>
                                                        <option>Mother’s Day/Father’s Day Cakes</option>
                                                        <option>New Year’s Eve Cakes</option>
                                                        <option>Religious Celebrations</option>
                                                        <option>Retirement Cakes</option>
                                                        <option>Seasonal Cakes</option>
                                                        <option>Thanksgiving Cakes</option>
                                                        <option>Valentine’s Day Cakes</option>
                                                        <option>Wedding Cakes</option>
                                                    </select>
                                                    <br>
                                                    <span class="error-msg" id="occasion_msg"></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Description (Optional)</label>
                                            </td>
                                            <td>
                                                <textarea name="description" id="descriptionfield"></textarea><br>
                                                <span class="error-msg" id="description_msg"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Photo</label>
                                            </td>
                                            <td>
                                                <img style="width:150px; margin-bottom:5px; border-radius:10%; border:1px solid #ccc"
                                                     id="photoPreview" src="./others/images/dummycake.jpg"
                                                     style="width:70px; margin-bottom:5px"><br>
                                                <input type="file" name="photo" id="photofield">
                                                <br>
                                                <span class="error-msg" id="photo_msg"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="tablebtn">
                                                <button class="my-save-btn" type="button" id="SaveCake">Save cake Details</button>
                                                <button class="update-btn d-none" type="button" id="updateCake">Update Cake Details</button>
                                                <button class="my-del-btn" type="button" id="resetCake">Clear Form</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        </table>
                                        <br>

                                        <div class="bottomTable">
                                            <table cellspacing="0" cellpadding="5" id="addedcake_tbl" class="table">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4"><h1 class="mainHeading">All cake details</h1></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="4">
                                                            <div class="searchbox">
                                                                <input
                                                                    type="text" id="search" class="search"
                                                                    aria-label="Search for a place on the map"
                                                                    autocomplete="off"
                                                                    inputmode="search"
                                                                    placeholder="Search here (Name,Code,Occasion)"
                                                                    type="search"
                                                                    />
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Cake Code</th>
                                                        <th>Name</th>
                                                        <th>Occasion</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br><br><br><br><br>
                                        <!--==============================================================================-->
                                        </div>
                                        </section>
                                        </div>
                                        <?php require_once './others/sub_pages/all_js.php'; ?>
                                        <script type="text/javascript" src="./controllers/cake_controller.js"></script>


                                        <!--===================More details popup window==================-->
                                        <div class="popup" id="popup-1">
                                            <div class="overlay"></div>
                                            <div class="content">
                                                <div class="close-btn" onclick="togglePopup()"></div>
                                                <h1>More details</h1>
                                                <div>
                                                    <table>

                                                    </table>
                                                </div>
                                                <button type="button" class="close-btn my-del-btn" onclick="togglePopup()">Close</button>
                                                <button type="button" class="btn btn-primary my-save-btn" id="resetPassword">Reset Password</button>
                                            </div>
                                        </div>

                                        <li>

                                        </li>

                                        <style>
                                            .popup .overlay {
                                                position: fixed;
                                                top: 0px;
                                                left: 0px;
                                                width: 100vw;
                                                height: 100vh;
                                                background: rgba(0, 0, 0, 0.7);
                                                z-index: 1;
                                                display: none;
                                            }

                                            .popup .content {
                                                position: absolute;
                                                top: 50%;
                                                left: 260%;
                                                transform: translate(-50%, -50%) scale(0);
                                                background: #fff;
                                                width: 450px;
                                                height: 220px;
                                                z-index: 2;
                                                padding: 20px;
                                                box-sizing: border-box;
                                                border-radius: 20px;
                                            }

                                            .popup.active .overlay {
                                                display: block;
                                            }

                                            .popup.active .content {
                                                transition: all 300ms ease-in-out;
                                                transform: translate(-50%, -50%) scale(1);
                                            }
                                        </style>

                                        <script>
                                            function togglePopup() {
                                                document.getElementById("popup-1").classList.toggle("active");
                                            }
                                        </script>


                                        </body>
                                        </html>


