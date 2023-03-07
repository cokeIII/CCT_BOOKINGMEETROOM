<?php
include "connect.php";
$data = array();
$meet_room_id = $_POST["meet_room_id"];
$time_strat = new DateTimeImmutable($_POST["time_strat"]);
$time_strat  = $time_strat->format('Y-m-d H:i:s');
$time_end = new DateTimeImmutable($_POST["time_end"]);
$time_end  = $time_end->format('Y-m-d H:i:s');
$meet_name = $_POST["meet_name"];
$number_people = $_POST["number_people"];
$type_people = $_POST["type_people"];
$detail_meet = $_POST["detail_meet"];
$people_name_booking = $_POST["people_name_booking"];
$department_booking = $_POST["department_booking"];
$tel = $_POST["tel"];
$status_booking = "รอการยืนยัน";
$note = $_POST["detail_meet"];
$user_id = $_POST["user_id"];

$sql = "insert into booking (
    meet_room_id,
    time_strat,
    time_end,
    meet_name,
    number_people,
    type_people,
    detail_meet,
    people_name_booking,
    department_booking,
    tel,
    status_booking,
    note,
    user_id
    ) values (
        '$meet_room_id',
        '$time_strat',
        '$time_end',
        '$meet_name',
        '$number_people',
        '$type_people',
        '$detail_meet',
        '$people_name_booking',
        '$department_booking',
        '$tel',
        '$status_booking',
        '$note',
        '$user_id'
    )";

$sqlCheck = "select *
from booking 
where meet_room_id = '$meet_room_id' and ((time_strat BETWEEN '$time_strat' and '$time_end') or (time_end BETWEEN '$time_strat' and '$time_end')) or ((time_strat <= '$time_strat' and '$time_strat' <= time_end) or (time_strat <= '$time_end' and '$time_end' <= time_end))";
$resCheck = mysqli_query($conn, $sqlCheck);
$numRowCheck = mysqli_num_rows($resCheck);
if ($numRowCheck > 0) {
    $rowCheck = mysqli_fetch_array($resCheck);
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data["status"] = "409";
        $data["row"] = $rowCheck;
        $data["sql"] = $sqlCheck;
    } else {
        $data["status"] = "410";
        echo $sql;
    }
} else {

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $data["status"] = "200";
        $data["sql"] = $sqlCheck;
    } else {
        $data["status"] = "410";
        echo $sql;
    }
}
echo json_encode($data);
