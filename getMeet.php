<?php

include "connect.php";
$roomId = $_POST['roomId'];
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

$sql = "select * from booking where status_booking = 'อนุมัติ' and meet_room_id = '$roomId' and time_end > CURRENT_TIMESTAMP order by time_strat";
$res = mysqli_query($conn, $sql);
$data = "";
$numRow = mysqli_num_rows($res);
$i = 1;

if ($numRow > 0) {
    while ($row = mysqli_fetch_array($res)) {
        $data .= '<tr>';
        $data .= '<td>' . $i . '</td>';
        $data .= '<td>' . $row['meet_name'] . '</td>';
        $data .= '<td>' . $row['people_name_booking'] . '</td>';
        $data .= '<td>' . $row['department_booking'] . '</td>';
        $data .= '<td>' . DateThai($row['time_strat']) . ' - <br>' . DateThai($row['time_end']) . '</td>';
        $data .= '</tr>';

        $i++;
    }
} else {
    $data = "ไม่มีรายการ ที่อนุมัติ";
}
echo json_encode($data);
