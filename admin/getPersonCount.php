<?php
require_once "../connect.php";
$year = $_POST["yearChart"] - 543;
header('Content-Type: text/html; charset=UTF-8');
$sql = "select people_name_booking, count(id) as personCount from booking
where YEAR(time_strat) = '$year' and status_booking = 'อนุมัติ' group by people_name_booking order by personCount DESC";

$res = mysqli_query($conn, $sql);
$data = "";
$i = 1;
while ($row = mysqli_fetch_array($res)) {
    $data .= '<tr>';
    $data .= '<td>' . $i . '</td>';
    $data .= '<td>' . $row['people_name_booking'] . '</td>';
    $data .= '<td>' . $row['personCount'] . '</td>';
    $data .= '</tr>';
    $i++;
}

echo $data;
