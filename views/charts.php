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
<div class="headerLink">
    <?php require_once './others/sub_pages/header.php'; ?>
</div>
<section class="main">
    <div class="sidebarLink">
        <?php require_once './others/sub_pages/sidebar.php'; ?>
    </div>

    <div class="main--content">
        <h1 class="mainHeading">Analytics</h1>
        <br>
        <form method="POST" action="" class="main-form">
            <table cellspacing="5" class="table" id="inventoryTable">
                <thead>
                <tr>
                    <th colspan="3">Inventory reports</th>
                </tr>
                </thead>
                <tr>
                    <td>Select category</td>
                    <td>
                        <div class="selectoccasion">
                            <select id="categoryField" name="chartType">
                                <option selected>Select option</option>
                                <option value="1">Cake Sales(Fast and slow moving)</option>
                                <option value="2">Expenses</option>
                                <option value="3">Outlet sells</option>
                            </select>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr class="d-none itemCode">
                    <td>Enter item code</td>
                    <td>
                        <input type="text">
                    </td>
                </tr>
                <tr class="d-none dateRange">
                    <td></td>
                    <td><label>From</label></td>
                    <td><label>To</label></td>
                </tr>
                <tr class="d-none dateRange">
                    <td>Select date range</td>
                    <td>
                        <input type="date" id="startDate" name="startDate"><br>
                        <span class="error-msg" id="startDate_msg"></span>
                    </td>
                    <td>
                        <input type="date" id="endDate" name="endDate"><br>
                        <span class="error-msg" id="endDate_msg"></span>
                    </td>
                    <td></td>
                </tr>
                <tr class="d-none year_month_section">
                    <td>Select year and month</td>
                    <td>
                        <div class="selectoccasion">
                            <select id="" name="year">
                                <?php
                                $options = "";
                                for ($x = 0; $x <= 4; $x++) {
                                    $year = date("Y", strtotime("-" . $x . " year"));
                                    $options .= "<option>" . $year . "</option>";
                                }
                                echo $options;
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="selectoccasion">
                        <select id="" name="month">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="my-detail-btn" name="generate" type="submit" id="generate">Generate</button>
                        <button class="my-del-btn" type="clear">Clear</button>
                    </td>
                </tr>
            </table>
        </form>

        <br><br><br>
        <hr>



        <?php
        if (isset($_POST['generate'])) {
            if ($_POST['chartType'] == 1) {
                ?>
                <div class="chart printable">
                    <div style="text-align: center">
                        <img src="./others/images/bill_logo.png" alt="Happy Cakies Logo" style="width: 200px"><br>
                        <p>106/3, Dewala Road,
                            Katubedda,
                            Moratuwa<br>
                            071 569 0189</p><br><br>
                    </div>

                    <h3 style="text-align:center">Cake Sales(Fast and slow moving)</h3>
                    <canvas id="cakeMoving"
                            style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                </div>
                <?php
            } elseif ($_POST['chartType'] == 2) {
                ?>
                <div class="chart printable">
                    <div style="text-align: center">
                        <img src="./others/images/bill_logo.png" alt="Happy Cakies Logo" style="width: 200px"><br>
                        <p>106/3, Dewala Road,
                            Katubedda,
                            Moratuwa<br>
                            071 569 0189</p><br><br>
                    </div>
                    <h3 style="text-align:center">Expenses <br>(From: <?php echo $_POST['startDate']; ?> /
                        To: <?php echo $_POST['endDate']; ?>)</h3>
                    <canvas id="expenses"
                            style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                </div>
                <?php
            } elseif ($_POST['chartType'] == 3) {
                ?>
                <div class="chart printable">
                    <div style="text-align: center">
                        <img src="./others/images/bill_logo.png" alt="Happy Cakies Logo" style="width: 200px"><br>
                        <p>106/3, Dewala Road,
                            Katubedda,
                            Moratuwa<br>
                            071 569 0189</p><br><br>
                    </div>
                    <h3 style="text-align:center">Outlet sells <br>(Year and
                        month: <?php echo $date = $_POST['year'] . "-" . $_POST['month']; ?>)</h3>
                    <canvas id="outletSells"
                            style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                </div>
                <?php
            }
        }
        ?>


        <br>
        <div style="text-align: center">
            <button onclick="window.print()" class="my-save-btn" type="button" id="print"><span
                        style="vertical-align: bottom; font-size: 18px !important;"
                        class="inline-icon material-symbols-outlined">print</span>&nbsp;Print
            </button>
        </div>
        <br><br>
    </div>
</section>

<?php require_once './others/sub_pages/all_js.php'; ?>
<script src="./others/Assets/js/chart_js.js"></script>
<script type="text/javascript" src="./controllers/charts_controller.js"></script>


<!--===================================== Chart codes=========================================-->

<?php

function rand_color()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

if (isset($_POST['generate'])) {
    if ($_POST['chartType'] == 1) {

        $query = "SELECT
                SUM(ims_order_cake_details.qty) AS sellQty, 
                CONCAT_WS(' - ',TRIM(`code`),`name`) AS cakeType
                FROM
                ims_order_cake_details
                INNER JOIN
                cake
                ON 
                ims_order_cake_details.order_cake_id = cake.id
                INNER JOIN
                ims_order_summary
                ON 
                ims_order_cake_details.order_no = ims_order_summary.order_no
                WHERE
                ims_order_summary.order_status != '5'
                GROUP BY
                order_cake_id";
        $data = $app->basic_Select_Query($query);
        $label = "";
        $count = "";
        $colors = "";

        foreach ($data as $x) {
            $label .= "'" . trim($x['cakeType']) . "', ";
            $count .= $x['sellQty'] . ", ";
            $colors .= "'" . rand_color() . "', ";
        }
    } elseif ($_POST['chartType'] == 2) {
        $query = "SELECT
                    ims_expenses_type.expense_name, 
                    SUM(amount) AS total
                    FROM
                    ims_expense
                    INNER JOIN
                    ims_expenses_type
                    ON 
                    ims_expense.expense_type = ims_expenses_type.id
                    WHERE
                    ims_expense.date BETWEEN '{$_POST['startDate']}' AND '{$_POST['endDate']}'
                    GROUP BY
                    expense_type";
        $data = $app->basic_Select_Query($query);

        $exlabel = "";
        $excount = "";
        $excolors = "";

        foreach ($data as $x) {
            $exlabel .= "'" . $x['expense_name'] . "', ";
            $excount .= $x['total'] . ", ";
            $excolors .= "'" . rand_color() . "', ";
        }
    } elseif ($_POST['chartType'] == 3) {
        $date = $_POST['year'] . "-" . $_POST['month'];
        echo $query = "SELECT
                    ims_outlet_bill_summary.outlet_bill_table_id, 
                    SUM(ims_outlet_bill_summary.outlet_bill_amt) AS daySum, 
                    DATE_FORMAT(outlet_bill_date_time,'%Y-%m-%d') AS bill_date
                        FROM
                    ims_outlet_bill_summary
                    WHERE DATE_FORMAT(outlet_bill_date_time,'%Y-%m') = '{$date}'
                    GROUP BY
                    DATE_FORMAT(outlet_bill_date_time,'%Y-%m-%d')";
        $data = $app->basic_Select_Query($query);
        $outletlabel = "";
        $outletcount = "";
        $outletcolors = "";

        foreach ($data as $x) {
            $outletlabel .= "'" . $x['bill_date'] . "', ";
            $outletcount .= $x['daySum'] . ", ";
            $outletcolors .= "'" . rand_color() . "', ";
        }
    }
}
?>

<script type="text/javascript">
    //================================== cake Sales (fast slow) ===================
    var donutChartCanvas = $('#cakeMoving').get(0).getContext('2d');
    var donutData = {
        //                        labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator', ],
        labels: [<?php echo $label; ?>],
        datasets: [
            {
                //                                       data: [700, 500, 400, 600, 300, 100],
                data: [<?php echo $count; ?>],
                //                                       backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                backgroundColor: [<?php echo $colors; ?>],
            }
        ]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }

    var donutChart = new Chart(donutChartCanvas, {
        type: 'pie',
        data: donutData,
        options: donutOptions
    });
    //================================END cake fast slow===========================
</script>

<script type="text/javascript">
    //================================== Expenses ================================
    var expCanves = $('#expenses').get(0).getContext('2d');
    var expData = {
        //                labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator', ],
        labels: [<?php echo $exlabel; ?>],
        datasets: [
            {
                //                        data: [700, 500, 400, 600, 300, 100],
                data: [<?php echo $excount; ?>],
                //                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                backgroundColor: [<?php echo $excolors; ?>],
            }
        ]
    }
    var expOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or doughnut chart
    // You can switch between pie and doughnut using the method below.
    var donutChart = new Chart(expCanves, {
        type: 'doughnut',
        data: expData,
        options: expOptions
    });
    //========================= End of Expenses ===================================
</script>

<script type="text/javascript">
    // ================================ outlet sells ==================================
    var barchrtData = {
        // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        labels: [<?php echo $outletlabel; ?>],
        datasets: [
            {
                label: 'Total goods',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                // data                : [28, 48, 40, 19, 86, 27, 90]
                data: [<?php echo $outletcount; ?>]
            }
        ]
    }

    var barChartCanvas = $('#outletSells').get(0).getContext('2d')
    // var barChartData = $.extend(true, {}, areaChartData)
    // var temp0 = barchrtData.datasets[0]
    // var temp1 = barchrtData.datasets[1]
    // barchrtData.datasets[0] = temp1
    // barchrtData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barchrtData,
        options: barChartOptions
    })
    // ================================ end of outlet sells ==================================
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .printable, .printable * {
            visibility: visible;
        }

        .printable {
            position: fixed;
            top: 100px;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #ffffff;
        }

        .printable canvas {
            width: 100% !important;
            height: auto !important;
        }
    }
</style>
</body>
    <script>
        // $('#generate').click(function (){
        //     if($('#categoryField').val() == 2){
        //         if ()
        //         alert()
        //     }else{
        //         alert("hi")
        //     }
        // })
        //
        //
        // function getDateRange(){
        //
        //     var startDate = $('#startDate').val();
        //     var endDate = $('#endDate').val();
        //     alert(startDate + endDate)
        // }
    </script>
</html>


