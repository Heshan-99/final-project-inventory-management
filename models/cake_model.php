<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'checkName') {
        $query = "SELECT name,cake.id FROM cake WHERE cake.name='{$_POST['name']}'";
        $count = $app->row_count_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }elseif ($_POST['action'] == 'saveCake') {
        $query = "INSERT INTO `cake` "
                . "(`code`,`name`, `occasion`, `description`,`type`)"
                . "VALUES "
                . "('{$_POST['code']}', '{$_POST['name']}', '{$_POST['occasion']}', '{$_POST['description']}', '{$_POST['type']}');";
        $result = $app->command_query_with_lastInset_ID($query);
        if ($result != -1) {
            $_SESSION['cakeDesignID'] = $result;
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadAddedCakeTable') {
        $query = "SELECT
                  cake.id, 
                  cake.code, 
                  cake.name,
                  cake.occasion,
                  cake.description
                  FROM `cake`
                  WHERE
                  cake.cake_status = 1 AND
                  (LOWER(cake.`name`) LIKE LOWER('%{$_POST['search']}%') OR
                  LOWER(cake.`code`) LIKE LOWER('%{$_POST['search']}%') OR
                  LOWER(cake.occasion) LIKE LOWER('%{$_POST['search']}%')) ORDER BY cake.id DESC LIMIT 10";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['code'] . '</td>';
            $tblData .= '<td>' . $x['name'] . '</td>';
            $tblData .= '<td>' . $x['occasion'] . '</td>';
            $tblData .= '<td><button class="my-save-btn select" type="button" value="' . $x['id'] . '">Select</button><button class="my-del-btn delete" type="button"  value="' . $x['id'] . '">Delete</button></td>';
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'get_cake_data_for_update') {
        $query = "SELECT
                  cake.code,
                  cake.type,
                  cake.name,
                  cake.occasion,
                  cake.description,
                  cake.photo
                  FROM `cake`
                  WHERE
                  cake.id = '{$_POST['cakeID']}'";
        $app->json_encoded_select_query($query);
    } elseif ($_POST['action'] == 'update_cake_details') {
        $query = "UPDATE `cake` SET "
                . "`name` = '{$_POST['name']}', `occasion` = '{$_POST['occasion']}', `description` = '{$_POST['description']}' "
                . "WHERE (`id` = '{$_POST['cakeID']}');";
        $result = $app->basic_command_query($query);
        if ($result) {
            $_SESSION['cakeDesignID'] = $_POST['cakeID'];
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'delete_cake_record') {
//        $query = "UPDATE `cake` SET `cake_status`='0' WHERE (`id`='{$_POST['cakeID']}')";
        $query = "DELETE FROM `cake` WHERE (`id`='{$_POST['cakeID']}')";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'getNextCakeCode') {
        $query = "SELECT IFNULL(MAX(id)+1,'1') AS last_id FROM cake";
        $data = $app->basic_Select_Query($query);
        echo 'ITM00' . $data[0]['last_id'];
    }
}