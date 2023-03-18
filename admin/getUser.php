<?php
require_once "../connect.php";

$id = $_POST['id'];

$sql = "select * from users where id = '$id' limit 1";

$res = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_array($res)) {
    $data[] = $row;
}

echo json_encode($data);
