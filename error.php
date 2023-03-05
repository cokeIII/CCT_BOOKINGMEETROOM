<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "headerSetup.php" ?>
</head>
<style>
    .mt-center {
        margin-top: 35vh;
    }
</style>

<body>
    <div class="container">
        <div class="card mt-center">
            <div class="card-head p-2">
                <h4 class="text-danger">เกิดข้อผิดพลาด</h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (!empty($_GET["error"])) {
                    $error = $_GET["error"];
                    if ($error == 1) {
                        echo "ท่านไม่มีสิทธิ์ในการจอง อาจเกิดจากรหัสบัตรผิด กรุณาลองใหม่ <a href='login.php'>ตรวจสอบอีกครั้ง</a>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php include "footerSetup.php" ?>