<?php
require_once "../connect.php";
session_start();
$id = $_POST['id'];
$status  =  $_POST['status'];

$user_id = $_SESSION["user_id"];

$sql = "update booking set status_booking = '$status', make_list='$user_id' where id ='$id'";
$res = mysqli_query($conn, $sql);

if ($res) {
    echo "200";
}
