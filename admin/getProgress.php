<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type: text/html; charset=UTF-8');
require_once "../connect.php";
$year = $_POST["yearChart"] - 543;
$color = array(
    'ห้องประชุมพิกุล' => '#ed544a',
    'ห้องประชุมทิวสน' => '#dedc6d',
    'ห้องประชุม อีอีซี' => '#57cf5d',
    'ห้องประชุมทิวสน' => '#dedc6d',
    'ห้องประชุมกาสะลอง' => '#54d9e3',
    'หอประชุมคมสัน' => '#ca26eb'
);
$sql = "select r.name,count(b.id) as countBooking from booking b 
inner join meet_room r on r.id = b.meet_room_id
where YEAR(time_strat) = '$year' and status_booking = 'อนุมัติ' group by b.meet_room_id order by countBooking DESC";
$data = "";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $name = $row['name'];
    $colorBar = $color[$name];
    $countBooking = $row['countBooking'];
    $data .= '<div class="progress mt-3" style="height: 30px;">
      <div class="progress-bar" role="progressbar" style="width: 100%; font-size: 16px; background-color:' . ($colorBar) . '; color: black; font-weight: bold;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' . ($name) . ' (' . ($countBooking) . ')' . '</div>
    </div>';
}

echo $data;
