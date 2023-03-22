<?php
// header("Content-Type: image/png");
$id = $_GET['id'];
$url = $_SERVER['SERVER_NAME'];

include('../phpqrcode/qrlib.php');
QRcode::png($url.'/CCT_BOOKINGMEETROOM/index.php?idRoom='.$id);