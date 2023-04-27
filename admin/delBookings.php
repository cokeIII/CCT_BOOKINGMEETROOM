<?php

require_once "../connect.php";
$id = $_POST['id'];

$sql = "delete from booking where id = '$id'";
$res = mysqli_query($conn,$sql);

if($res){
    echo 200;
}

