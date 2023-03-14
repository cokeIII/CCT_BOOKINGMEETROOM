<?php

include "connect.php";
function DateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}
$people_id = $_POST["people_id"];

$sql = "select * from booking where user_id = '$people_id' and status_booking != 'อนุมัติ' and status_booking != 'ยกเลิก'";
$res = mysqli_query($conn, $sql);
$data = "";
$numRow = mysqli_num_rows($res);
$i = 1;
if ($numRow > 0) {
    while ($row = mysqli_fetch_array($res)) {
        $data .= '<tr>';
        $data .= '<td>' . $i . '</td>';
        $data .= '<td>' . $row['meet_name'] . '</td>';
        $data .= '<td>' . DateThai($row['time_strat']) . ' - <br>' . DateThai($row['time_end']) . '</td>';
        $data .= '<td><button class="btn btn-danger cancelMeet" id="' . $row['id'] . '">ยกเลิก</button></td>';
        $data .= '</tr>';

        $i++;
    }
} else {
    $data = "ไม่มีรายการ";
}
echo json_encode($data);
