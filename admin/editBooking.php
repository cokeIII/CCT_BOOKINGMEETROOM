<?php

require_once "../connect.php";
$id  = $_POST["edit_booking_id"];
$meet_room_id  = $_POST["meet_room_id"];
$time_strat  = $_POST["time_strat"];
$time_end  = $_POST["time_end"];
$meet_name  = $_POST["meet_name"];
$number_people  = $_POST["number_people"];
$type_people  = $_POST["type_people"];
$detail_meet  = $_POST["detail_meet"];
$people_name_booking_arr = explode("_", $_POST["people_name_booking"]);
$people_name_booking = $people_name_booking_arr[0];
$people_id_booking = $people_name_booking_arr[1];
$department_booking  = $_POST["department_booking"];
$tel  = $_POST["tel"];

$sql = "update booking set 
meet_room_id = '$meet_room_id',
time_strat = '$time_strat',
time_end = '$time_end',
meet_name = '$meet_name',
number_people = '$number_people',
type_people = '$type_people',
detail_meet = '$detail_meet',
people_name_booking = '$people_name_booking',
people_id_booking = '$people_id_booking',
department_booking = '$department_booking',
tel = '$tel'
where id = '$id'";

$res = mysqli_query($conn,$sql);

if($res){
    echo "SUCCESS";
}