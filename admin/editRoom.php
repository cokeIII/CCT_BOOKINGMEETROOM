<?php

require_once "../connect.php";
$id  = $_POST["id"];
$name = $_POST['name'];
$status = $_POST['status'];

if (filesize($_FILES["pic"]["tmp_name"])) {
    $target_dir = "../img/";
    $picName = basename($_FILES["pic"]["name"]);
    $target_file = $target_dir . $picName;
    $uploadOk = 1;

    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            $sql = "update meet_room set name = '$name ', pic = '$picName', status = '$status' where id = '$id'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                header('location: roomManager.php');
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $sql = "update meet_room set name = '$name', status = '$status' where id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header('location: roomManager.php');
    }
}
