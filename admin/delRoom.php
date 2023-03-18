<?php

require_once "../connect.php";

$id = $_POST['id'];

$sql = "delete from meet_room where id = '$id'";
$res = mysqli_query($conn,$sql);

if($res){
    echo 200;
}

