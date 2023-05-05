<?php
require_once "connect.php";

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
    return "$strDay $strMonthThai $strYear "."$strHour : $strMinute : $strSeconds";
}

$roomId = $_POST['roomId'];
$sql = "select b.id as bId,m.name as mname,b.tel as btel, b.*,m.*,p.people_name,p.people_surname from booking b
inner join meet_room m on m.id = b.meet_room_id
inner join people p on p.people_id = b.user_id 
where b.status_booking='อนุมัติ' and b.meet_room_id = '$roomId'
";

$res = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_array($res)) {
    $data[] = ['title' => $row['meet_name'], 'start' => $row['time_strat'], 'end' => $row['time_end'], 'description' => $row['meet_name'] . '<br> เริ่ม ' . DateThai($row['time_strat']) . '<br> จบ ' . DateThai($row['time_end'])];
}

echo json_encode($data);
