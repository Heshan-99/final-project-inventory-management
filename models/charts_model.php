<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'generateExpensesChart') {
        $query = "SELECT name,cake.id FROM cake WHERE cake.name='{$_POST['name']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
}