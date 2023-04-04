<?php
// header("Content-Type: image/png");
$id = $_GET['id'];
$url = $_SERVER['SERVER_NAME'];

include('../phpqrcode/qrlib.php');
QRcode::png('http://'.$url.'/ctc_meet/index.php?idRoom='.$id);