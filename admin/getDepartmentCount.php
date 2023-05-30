<?php
require_once "../connect.php";
$year = $_POST["yearChart"] - 543;
header('Content-Type: text/html; charset=UTF-8');
$sql = "select department_booking, count(id) as depCount from booking
where YEAR(time_strat) = '$year' and status_booking = 'อนุมัติ' group by department_booking order by depCount DESC";

$res = mysqli_query($conn, $sql);
$data = "";
$i = 1;
while ($row = mysqli_fetch_array($res)) {
    $data .= '<tr>';
    $data .= '<td>' . $i . '</td>';
    $data .= '<td>' . $row['department_booking'] . '</td>';
    $data .= '<td>' . $row['depCount'] . '</td>';
    $data .= '</tr>';
    $i++;
}

echo $data;
