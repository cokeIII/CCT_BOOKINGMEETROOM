<?php
include "connect.php";

$people_id = $_POST["people_id"];
session_start();
$sql = "select * from people where people_id  = '$people_id' limit 1";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$rowCount = mysqli_num_rows($res);
if ($rowCount > 0) {
    setcookie("people_id", $row["people_id"], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("people_name", $row["people_name"], time() + (86400 * 30), "/");
    setcookie("people_surname", $row["people_surname"], time() + (86400 * 30), "/");
    if (!empty($_SESSION["link_room"])) {
        $link_room = $_SESSION["link_room"];
        header("location: $link_room");
    } else {
        header("location: selectRoom.php");
    }
} else {
    header("location: error.php?error=1");
}
