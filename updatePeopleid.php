<?php
include "connect.php";
$sql = "select id,people_name_booking from booking";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $name = explode(" ", $row['people_name_booking']);
    $people_name = $name[0];
    $people_surname = $name[1];
    $sqlS = "select people_name, people_surname, people_id from people where people_name = '$people_name' and people_surname = '$people_surname'";
    $resS = mysqli_query($conn, $sqlS);
    $rowS = mysqli_fetch_array($resS);
    $people_id_booking = $rowS['people_id'];
    $id = $row['id'];
    $sqlUp = "update booking set people_id_booking = '$people_id_booking' where id = '$id'";
    mysqli_query($conn, $sqlUp);
}
