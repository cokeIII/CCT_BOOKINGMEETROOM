<?php
require_once "../connect.php";
$year = $_POST["yearChart"] - 543;

$sqlSum = "select count(id) as sumBooking from booking where status_booking = 'อนุมัติ' and YEAR(time_strat) = '$year'";
$resSum = mysqli_query($conn, $sqlSum);
$rowSum = mysqli_fetch_array($resSum);

$sql = "select r.name, count(b.id) as countBooking from booking b 
inner join meet_room r on r.id = b.meet_room_id
where YEAR(time_strat) = '$year' and status_booking = 'อนุมัติ' group by b.meet_room_id order by countBooking DESC";

$res = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_array($res)) {
    $data['label'][] = $row['name'];
    $data['data'][] = number_format((float)($row['countBooking'] * 100) / $rowSum['sumBooking'], 2, '.', '');
}

echo json_encode($data);
