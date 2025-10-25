<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'loadCakes') {
        $query = "SELECT
                  cake.id, 
                  cake.`name`, 
                  cake.occasion, 
                  cake.weight, 
                  cake.description, 
                  cake.price, 
	              cake.photo
                  FROM
                  cake
                  WHERE
                  cake.`name` LIKE '%{$_POST['search']}%' OR
                  cake.occasion LIKE '%{$_POST['search']}%' OR
                  cake.weight LIKE '{$_POST['search']}%' ORDER BY cake.id DESC LIMIT 15";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<div style="text-align: center" class="item listProductItem"  id="listProductItem">';
            $tblData .= '<div class="image"><img src="./others/upload_cake_designs/'. $x['photo'] .' " alt="Cake photo" id="'.$x['id'].'"></div>';
            $tblData .= '<div class="name"><h2>' . $x['name'] . '</h2></div>';
            $tblData .= '<div class="occasion">' . $x['occasion'] . '</div>';
            $tblData .= '<div class="totalPrice">' . $x['price'] . '</div>';
            $tblData .= '<button class="detailsbtn" value="'.$x['id'].'">View details</button>';
            $tblData .= '</div>';
        }
        echo $tblData;
    }
}