<?php
require_once "../connect.php";
$year = $_POST["yearChart"] - 543;
$sqlRoom = "select id,name from meet_room";
$resRoom = mysqli_query($conn, $sqlRoom);
$data = array();

while ($rowRoom = mysqli_fetch_array($resRoom)) {
    $meet_room_id = $rowRoom['id'];
    $sql = "select count(id) as countMeet,MONTH(time_strat) as monthMeet from booking 
    where YEAR(time_strat) = '$year' and meet_room_id = '$meet_room_id' and status_booking = 'อนุมัติ'
    group by MONTH(time_strat) 
    ";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        $data[$rowRoom['name']][$row['monthMeet']] = $row['countMeet'];
    }
}

echo json_encode($data);
