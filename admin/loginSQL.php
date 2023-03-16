<?php
require_once "../connect.php";
$username = $_POST['username'];
$password = $_POST['password'];
session_start();
$sql = "select * from users where username = '$username' and password = '$password' limit 1";
$res = mysqli_query($conn, $sql);
$numRow = mysqli_num_rows($res);
$row = mysqli_fetch_array($res);
if ($numRow > 0) {
    $_SESSION["user_id"] = $row["id"];
    $_SESSION["name"] = $row["username"];
    $_SESSION["status"] = $row["status"];
    header("location: home.php");
} else {
    header("location: index.php");
}
