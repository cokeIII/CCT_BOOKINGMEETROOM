<?php
require_once "../connect.php";
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$line_noti = $_POST['line_noti'];

$sql = "update users set username='$username', password = '$password', line_noti = '$line_noti' where id = '$id'";
$res = mysqli_query($conn, $sql);

if ($res) {
    header('location: userManager.php');
}
