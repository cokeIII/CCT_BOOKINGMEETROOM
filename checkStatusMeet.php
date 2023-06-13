<?php
require_once "connect.php";
$id = $_POST["id"];
date_default_timezone_set('asia/bangkok');
$dataCer = date('Y-m-d H:i:s');
$sql = "select *
from booking 
where ('$dataCer' BETWEEN time_strat and time_end) and meet_room_id='$id' and status_booking = 'อนุมัติ' limit 1";
$data = array();
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$numRow = mysqli_num_rows($res);
if ($numRow > 0) {
    $sqlUpdate = "update meet_room set status = 'ไม่ว่าง' where id = '$id'";
    mysqli_query($conn, $sqlUpdate);
    $data["name"] = $row["meet_name"];
    $data["time"] = explode(" ", $row["time_strat"])[1] . " " .  explode(" ", $row["time_end"])[1];
} else {
    $sqlUpdate = "update meet_room set status = 'ว่าง' where id = '$id'";
    mysqli_query($conn, $sqlUpdate);
}
echo json_encode($data);
