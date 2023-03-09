<?php 

include "connect.php";

$id = $_POST["id"];
$sql = "update booking set status_booking = 'ยกเลิก' where id = '$id'";
$res = mysqli_query($conn,$sql);

if($res){
    echo "200";
}