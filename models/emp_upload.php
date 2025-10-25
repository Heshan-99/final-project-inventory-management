<?php

require_once '../others/class/common_function.php';
$app = new setting();

/* Getting file name */
$filename = $_FILES['file']['name'];

/* Location */
$img_id = $_SESSION['empPhotoID'];
$newName = 'emp_img_' . $img_id;
$extension = pathinfo($filename, PATHINFO_EXTENSION); // jpg
$basename = $newName . "." . $extension; // emp_img_2.jpg
$location = "../others/upload_emp/" . $basename;

$uploadOk = 1;
$imageFileType = pathinfo($location, PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg", "jpeg", "png");
/* Check file extension */
if (!in_array(strtolower($imageFileType), $valid_extensions)) {
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo 0;
} else {
    /* Upload file */
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
        $query = "UPDATE `employee` SET `photo`='{$basename}' WHERE (`emp_id`='{$_SESSION['empPhotoID']}')";
        $app->basic_command_query($query);
        echo 1;
    } else {
        echo 0;
    }
}