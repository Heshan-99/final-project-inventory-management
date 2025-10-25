<div class="sidebar">
    <div class="logo">
        <h2>Happy<span>Cakies</span></h2>
    </div>
    <div class="sidebar--items" id="navbar">
        <li class="sidebar--top-items">
        <li>
            <!--                type active in class if want to highlight-->
            <a class="btn" href="./?dashboard" target="">
                <span class="icon icon-1"><span class="material-symbols-outlined">grid_view</span></span>
                <span class="sidebar--item">Dashboard</span>
            </a>
<!--            <a class="btn" href="./?outletManagement" target="">
                <span class="icon icon-8"><span class="material-symbols-outlined">storefront</span></span>
                <span class="sidebar--item">Outlet Management</span>
            </a>-->
        </li>
        <!--=================drop down================-->
        <?php
        $q1 = "SELECT
                   ims_system_privileges.priv_name,
                   ims_system_privileges.priv_id
                   FROM `ims_system_privileges`
                   WHERE
                   ims_system_privileges.priv_type = 0
                   ORDER BY
                   ims_system_privileges.priv_priority ASC";
        $mainPr = $app->basic_Select_Query($q1);
        foreach ($mainPr as $x) {
            $q2 = "SELECT
                       ims_system_privileges.priv_name,
                       ims_system_privileges.priv_path
                       FROM
                       ims_system_privileges
                       INNER JOIN ims_assigned_privileges ON ims_system_privileges.priv_id = ims_assigned_privileges.priv_id
                       WHERE
                       ims_system_privileges.priv_type = '{$x['priv_id']}' AND
                       ims_assigned_privileges.emp_id = '{$_SESSION['emp_id']}'
                       ORDER BY
                       ims_system_privileges.priv_priority ASC";
            $subPrCount = $app->row_count_query($q2);
            $subPr = $app->basic_Select_Query($q2);
            if ($subPrCount > 0) {
                $icon = '';
                if ($x['priv_id'] == 100) {
                    $icon = '<span class="icon icon-6"><span class="material-symbols-outlined">app_registration</span></span>';
                } elseif ($x['priv_id'] == 200) {
                    $icon = '<span class="icon icon-4"><span class="material-symbols-outlined">inventory</span></span>';
                } elseif ($x['priv_id'] == 300) {
                    $icon = '<span class="icon icon-5"><span class="material-symbols-outlined">manage_accounts</span></span>';
                } elseif ($x['priv_id'] == 400) {
                    $icon = '<span class="icon icon-3"><span class="material-symbols-outlined">cake_add</span></span>';
                } elseif ($x['priv_id'] == 500) {
                    $icon = '<span class="icon icon-1"><span class="material-symbols-outlined">list_alt</span></span>';
                } elseif ($x['priv_id'] == 600) {
                    $icon = '<span class="icon icon-1"><span class="material-symbols-outlined">query_stats</span></span>';
                } elseif ($x['priv_id'] == 700) {
                    $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">storefront</span></span>';
                } elseif ($x['priv_id'] == 800) {
                    $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">attach_money</span></span>';
                }
                echo '<li  style=" padding-top: 5px">
                            <button class="dropdown-btn">
                                <a class="btn">' . $icon . '<span id="navName" class="sidebar--item" style="width: 170px; text-align: left">' . $x['priv_name'] . '</span><span class="material-symbols-outlined droparrow">expand_more</span>
                                </a>
                            </button>
                            <div class="dropdown-container">';
                foreach ($subPr as $y) {
                    $icon = '';
                    if ($y['priv_name'] == "Cake Type Reg.") {
                        $icon = '<span class="icon icon-6"><span class="material-symbols-outlined">cake</span></span>';
                    } elseif ($y['priv_name'] == "Employee Reg") {
                        $icon = '<span class="icon icon-4"><span class="material-symbols-outlined">badge</span></span>';
                    } elseif ($y['priv_name'] == "Supplier Reg.") {
                        $icon = '<span class="icon icon-5"><span class="material-symbols-outlined">forklift</span></span>';
                    } elseif ($y['priv_name'] == "Items Reg.") {
                        $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">category</span></span>';
                    } elseif ($y['priv_name'] == "Customer Reg.") {
                        $icon = '<span class="icon icon-6"><span class="material-symbols-outlined">person</span></span>';
                    } elseif ($y['priv_name'] == "New GRN") {
                        $icon = '<span class="icon icon-3"><span class="material-symbols-outlined">add</span></span>';
                    } elseif ($y['priv_name'] == "View Stock") {
                        $icon = '<span class="icon icon-1"><span class="material-symbols-outlined">visibility</span></span>';
                    } elseif ($y['priv_name'] == "Item movement") {
                        $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">move_up</span></span>';
                    } elseif ($y['priv_name'] == "Manage privilege") {
                        $icon = '<span class="icon icon-7"><span class="material-symbols-outlined">supervisor_account</span></span>';
                    } elseif ($y['priv_name'] == "Password Change") {
                        $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">password</span></span>';
                    } elseif ($y['priv_name'] == "Add new config") {
                        $icon = '<span class="icon icon-4"><span class="material-symbols-outlined">add</span></span>';
                    } elseif ($y['priv_name'] == "View configuration") {
                        $icon = '<span class="icon icon-6"><span class="material-symbols-outlined">visibility</span></span>';
                    } elseif ($y['priv_name'] == "Password reset") {
                        $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">lock_reset</span></span>';
                    } elseif ($y['priv_name'] == "Add new order") {
                        $icon = '<span class="icon icon-4"><span class="material-symbols-outlined">add</span></span>';
                    } elseif ($y['priv_name'] == "Change order status") {
                        $icon = '<span class="icon icon-3"><span class="material-symbols-outlined">visibility</span></span>';
                    } elseif ($y['priv_name'] == "Add custom config") {
                        $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">add</span></span>';
                    } elseif ($y['priv_name'] == "Charts") {
                        $icon = '<span class="icon icon-8"><span class="material-symbols-outlined">monitoring</span></span>';
                    } elseif ($y['priv_name'] == "Report Generate") {
                        $icon = '<span class="icon icon-4"><span class="material-symbols-outlined">print</span></span>';
                    } elseif ($y['priv_name'] == "Outlet item Reg.") {
                        $icon = '<span class="icon icon-6"><span class="material-symbols-outlined">storefront</span></span>';
                    } elseif ($y['priv_name'] == "Cashier") {
                        $icon = '<span class="icon icon-5"><span class="material-symbols-outlined">paid</span></span>';
                    } elseif ($y['priv_name'] == "Outlet Stock Update") {
                        $icon = '<span class="icon icon-2"><span class="material-symbols-outlined">inventory</span></span>';
                    } elseif ($y['priv_name'] == "Expenses") {
                        $icon = '<span class="icon icon-5"><span class="material-symbols-outlined">currency_exchange</span></span>';
                    } elseif ($y['priv_name'] == "Re-print Bill") {
                        $icon = '<span class="icon icon-4"><span class="material-symbols-outlined">print</span></span>';
                    } elseif ($y['priv_name'] == "Advance manage") {
                        $icon = '<span class="icon icon-3"><span class="material-symbols-outlined">payments</span></span>';
                    } elseif ($y['priv_name'] == "GRN Payment") {
                        $icon = '<span class="icon icon-3"><span class="material-symbols-outlined">payments</span></span>';
                    } elseif ($y['priv_name'] == "Order Details") {
                        $icon = '<span class="icon icon-1"><span class="material-symbols-outlined">search</span></span>';
                    }
                    echo '<a class="btn" href="' . $y['priv_path'] . '" target="">'
                        . $icon .
                        '<span class="sidebar--item">' . $y['priv_name'] . '</span>
                                </a>';
                }
                echo '</div></li>';
            }
        }
        ?>

        <script>
            // close all dropdown when start
            document.addEventListener('DOMContentLoaded', (event) => {

                var dropdownButtons = document.getElementsByClassName("dropdown-btn");
                for (var i = 0; i < dropdownButtons.length; i++) {
                    var dropdownButton = dropdownButtons[i];
                    var dropdownContent = dropdownButton.nextElementSibling;

                    dropdownContent.style.display = "none";

                }
            });

            // Show and hide dropdown when click
            var dropdown = document.getElementsByClassName("dropdown-btn");
            for (var i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', (event) => {
                // Get all dropdown buttons
                var dropdownButtons = document.getElementsByClassName("dropdown-btn");

                // Iterate over each dropdown button
                for (var i = 0; i < dropdownButtons.length; i++) {
                    var dropdownButton = dropdownButtons[i];
                    dropdownButton.addEventListener("click", function () {
                        var dropdownContent = this.nextElementSibling;

                        closeAllDropdowns();

                        // Toggle visibility of clicked dropdown content
                        dropdownContent.style.display = (dropdownContent.style.display === "block") ? "none" : "block";
                    });
                }

                // Function to close all dropdowns
                function closeAllDropdowns() {
                    var dropdownContents = document.querySelectorAll(".dropdown-container");
                    dropdownContents.forEach(function (dropdownContent) {
                        dropdownContent.style.display = "none";

                    });
                }
            });
        </script>

        </ul>
    </div>
    <ul class="sidebar--bottom-items">
        <li>
            <div class="popup" id="popup-1">
                <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup()"></div>
                    <h1>Change Password</h1>
                    <div>
                        <table class="table">
                            <tr valign="top">
                                <td>
                                    <label>Old password</label>
                                </td>
                                <td>
                                    <input type="password" name="oldPass" id="oldPassfield"><br>
                                    <h6 style="color: red;" class="d-none" id="oldPass_msg">Required field</h6>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <label>New password</label>
                                </td>
                                <td>
                                    <input type="password" name="newPass" id="newPassfield"><br>
                                    <h6 style="color: red;" class="d-none" id="newPass_msg">Required field</h6>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <label>Confirm password</label>
                                </td>
                                <td>
                                    <input type="password" name="confirmPass" id="confirmPassfield"><br>
                                    <h6 style="color: red;" class="d-none" id="confirmPass_msg">Required field</h6>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button type="button" class="close-btn my-del-btn" onclick="togglePopup()">Close</button>
                    <button type="button" class="btn btn-primary my-save-btn" id="resetPassword">Reset Password</button>
                </div>
            </div>
        </li>

        <li>
            <a class="btn" id="changePass" onclick="togglePopup()">
                <span class="icon icon-6"><span class="material-symbols-outlined">lock_reset</span></span>
                <span class="sidebar--item">Reset Password</span>
            </a>
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
                width: 550px;
                height: 250px;
                z-index: 2;
                text-align: center;
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

        <li>
            <a class="btn" href="#" id="logout">
                <span class="icon icon-7"><span class="material-symbols-outlined">logout</span></span>
                <span class="sidebar--item">Logout</span>
            </a>
        </li>
    </ul>
</div>


