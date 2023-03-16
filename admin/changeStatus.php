<?php
require_once "../connect.php";
session_start();
$id = $_POST['id'];
$status  =  $_POST['status'];
$sql = "update booking set status_booking = '$status' where id ='$id'";
$res = mysqli_query($conn, $sql);

if ($res) {
    echo "200";
}
