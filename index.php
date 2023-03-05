<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "headerSetup.php" ?>
</head>
<?php
include "connect.php";
session_start();
$_SESSION["link_room"] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!isset($_COOKIE["people_id"])) {
    header("location: login.php");
} else {
    if (!empty($_GET["idRoom"])) {
        $id = $_GET["idRoom"];
        $sql = "select * from meet_room where id = '$id' limit 1";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);

        $roomName = $row["name"];
    } else {
        header("location: selectRoom.php");
    }
}
?>

<body>
    <div>
        <div class="row bg-head text-light p-2">
            <div class="col-md-12">
                <div class="haed-time">
                    <h4 id="nowDate"></h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="head-name-meetroom">
                    <?php echo $roomName ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="head-status">
                    ว่าง
                </div>
            </div>
        </div>
        <div class="container body-row">
            <div class="row justify-content-md-center mt-5">
                <div class="col-md-6">
                    <div class="body-head bg-head text-light p-2 rounded-pill">
                        <h5>รายการที่กำลังจะมาถึง</h5>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="text-light text-meet-detail mt-5">
                        ประชุมครูผู้ช่วย
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="detail-time">
                        09:00 - 10:45 น.
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="detail-by text-light">
                        By ผอ.
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12  text-light">
                <hr class="hr-footer">
                <div class="meet-soon text-center">
                    Next : ประชุมนักศึกษาฝึกงาน 13.30 - 15.30 น.
                </div>
                <hr class="hr-footer">
            </div>
        </div>
        <div class="row justify-content-md-center mt-2">
            <div class="col-md-4 d-grid">
                <button class="btn btn btn-outline-secondary" id="moreMeetSoon"> รายการประชุมอื่นๆ</button>
            </div>
        </div>
        <div class="row justify-content-md-center mt-2">
            <div class="col-md-4 d-grid">
                <button class="btn btn btn-outline-light" id="booking">จองห้องประชุม</button>
            </div>
        </div>
    </div>
</body>
<div class="modal" tabindex="-1" id="moreMeetSoonModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายการประชุมอื่นๆ <span id="headMoreMeetSoonModal"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>ลำดับ</th>
                        <th>ชื่อรายการ</th>
                        <th>วันเวลา</th>
                    </thead>
                    <tbody id="contentMeetSoon"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="bookingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">จองห้องประชุม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <label><strong>วันเวลาที่จอง</strong></label>
                    <div class="row">
                        <div class="col-md-6">
                            <label>เริ่ม</label>
                            <input class="form-control" type="datetime-local" name="time_strat" id="time_strat" required>
                        </div>
                        <div class="col-md-6">
                            <label>จบ</label>
                            <input class="form-control" type="datetime-local" name="time_end" id="time_end" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>ชื่อการประชุม</strong></label>
                            <input class="form-control" type="text" name="meet_name" id="meet_name" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label><strong>จำนวนคนที่เข้าร่วมประชุม</strong></label>
                            <input class="form-control" type="text" name="number_people" id="number_people">
                        </div>
                        <div class="col-md-6">
                            <label><strong>ฝ่ายงานตำแหน่งผู้เข้าร่วมประชุม</strong></label>
                            <input class="form-control" type="text" name="type_people" id="type_people" placeholder="นักเรียน, ผู้บริหาร, หัวหน้างาน">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>รายละเอียดเพิ่มในการประชุม</strong></label>
                            <textarea class="form-control" name="detail_meet" id="detail_meet" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-md-6">
                            <label><strong>ชื่อผู้ทำการจอง</strong></label>
                            <input class="form-control" type="text" name="people_name_booking" id="people_name_booking" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>ฝ่ายงานที่จอง</strong></label>
                            <select class="form-control" name="department_booking" id="department_booking" required>
                                <option value="">-- กรุณาเลือกฝายงาน --</option>
                                <?php
                                $sqlDep = "select people_dep_id,people_dep_name from people_dep";
                                $resDep = mysqli_query($conn, $sqlDep);
                                while ($rowDep = mysqli_fetch_array($resDep)) {
                                ?>
                                    <option value="<?php echo $rowDep["people_dep_name"]; ?>"><?php echo $rowDep["people_dep_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>เบอร์โทรติดต่อ</strong></label>
                            <input class="form-control" type="text" name="tel" id="tel" maxlength="10" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end">จองห้อง</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>
<?php include "footerSetup.php" ?>
<script>
    $(document).ready(function() {
        let roomName = "<?php echo $roomName; ?>"
        $("#nowDate").html(getTime())
        setInterval(function() {
            $("#nowDate").html(getTime())
        }, 1000)

        $(document).on("click", "#moreMeetSoon", function() {
            $("#headMoreMeetSoonModal").html(roomName)
            $('#moreMeetSoonModal').modal('show');
        })

        $(document).on("click", "#booking", function() {
            $('#bookingModal').modal('show');
        })
    })

    function getTime() {
        var dt = new Date();
        let dateTH = dt.toLocaleDateString('th-TH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        })
        var time = ("0" + dt.getHours()).slice(-2) + ":" + ("0" + dt.getMinutes()).slice(-2) + " น. " + dateTH;

        return time;
    }
</script>