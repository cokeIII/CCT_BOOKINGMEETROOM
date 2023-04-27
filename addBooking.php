<?php
include "connect.php";
function getRoomName($id)
{
    global $conn;
    $sqlN = "select name from meet_room where id = '$id' limit 1";
    $resN = mysqli_query($conn, $sqlN);
    $rowN = mysqli_fetch_array($resN);

    return $rowN["name"];
}
function sendLineNotify($message, $tokens)
{
    $token = $tokens;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '',);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);

    if (curl_error($ch)) {
        // echo 'error:' . curl_error($ch);
    } else {
        $res = json_decode($result, true);
        // echo "status : " . $res['status'];
        // echo "message : " . $res['message'];
    }
    curl_close($ch);
}

$sqlToken = "select line_noti from users";
$resToken = mysqli_query($conn, $sqlToken);

$data = array();
$meet_room_id = $_POST["meet_room_id"];

/*$time_strat = new DateTimeImmutable($_POST["time_strat"]);
$time_strat  = $time_strat->format('Y-m-d H:i:s');*/
$time_strat  = $_POST["time_strat"];
/*$time_end = new DateTimeImmutable($_POST["time_end"]);
$time_end  = $time_end->format('Y-m-d H:i:s');*/
$time_end  = $_POST["time_end"];
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
        while ($rowToken = mysqli_fetch_array($resToken)) {
            $mess = "จองห้องประชุม" . getRoomName($meet_room_id) . "\nหัวข้อ: " . $meet_name . "\nเวลา: " . $time_strat . " - " . $time_end . "\nฝ่ายงาน: $department_booking" . "\nผู้จอง: $people_name_booking\nเบอร์ติดต่อ: $tel\n**การจองห้องประชุมซ้ำกับรายการอื่น";
            $tokens =  $rowToken["line_noti"];
            sendLineNotify($mess, $tokens);
        }
    } else {
        $data["status"] = "410";
        echo $sql;
    }
} else {

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $data["status"] = "200";
        $data["sql"] = $sqlCheck;
        while ($rowToken = mysqli_fetch_array($resToken)) {
            $mess = "จองห้องประชุม" . getRoomName($meet_room_id) . "\nหัวข้อ: " . $meet_name . "\nเวลา: " . $time_strat . " - " . $time_end . "\nฝ่ายงาน: $department_booking" . "\nผู้จอง: $people_name_booking\nเบอร์ติดต่อ: $tel";
            $tokens =  $rowToken["line_noti"];
            sendLineNotify($mess, $tokens);
        }
    } else {
        $data["status"] = "410";
        echo $sql;
    }
}
echo json_encode($data);
