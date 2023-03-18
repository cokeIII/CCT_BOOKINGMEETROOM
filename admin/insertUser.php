<?php
require_once "../connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$line_noti = $_POST['line_noti'];

$sql = "insert into users (username,password,status,line_noti) values('$username','$password','user','$line_noti')";
$res = mysqli_query($conn, $sql);

if ($res) {
    header('location: userManager.php');
}
