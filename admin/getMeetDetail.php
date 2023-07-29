<?php
require_once "../connect.php";

$id = $_POST['id'];

$sql = "select  b.id as bId,m.name as mname,b.tel as btel, b.*,m.*,p.people_name,p.people_surname from booking b
inner join meet_room m on m.id = b.meet_room_id
inner join people p on p.people_id = b.people_id_booking
where b.id = '$id'
";

$res = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_array($res)) {
    $data[] = $row;
}

echo json_encode($data);
