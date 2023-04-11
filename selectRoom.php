<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "headerSetup.php";
    include "connect.php";
    session_start();
    $people_id = "";
    $people_name  = "";
    if (!isset($_COOKIE["people_id"]) && !isset($_SESSION["people_id"])) {
        header("location: login.php");
    }
    ?>
</head>
<style>
    .pic-room {
        width: auto !important;
        height: 300px !important;
    }
</style>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4>เลือกห้องประชุม</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $sql = "select * from meet_room";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo $row["name"] ?></h5>
                                </div>
                                <div class="card-body">
                                    <img src="img/<?php echo $row["pic"] ?>" class="img-fluid pic-room">
                                </div>
                                <div class="card-footer">
                                    <a href="index.php?idRoom=<?php echo $row["id"]; ?>" class="btn btn-primary float-end">เลือก</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>

</script>