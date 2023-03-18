<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once "header.php";
    require_once "../connect.php";
    session_start();
    if (empty($_SESSION["user_id"])) {
        header("location: index.php");
    }
    ?>

</head>
<style>
    .bg-r {
        background-color: #ff8880;
        color: black;
    }

    .bg-y {
        background-color: #ffdf80;
        color: black;

    }

    .bg-g {
        background-color: #9dfacc;
        color: black;
    }

    .alert-box {
        width: auto;
        height: 10vh;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once "menu.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once "topBar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ประวัติรายการจอง</h6>
                        </div>
                        <div class="card-body">
                            <table class="table text-nowrap" id="bookingTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อห้องประชุม</th>
                                        <th>ชื่อการประชุม</th>
                                        <th>เวลาเริ่ม</th>
                                        <th>เวลาจบ</th>
                                        <th>ชื่อผู้จอง</th>
                                        <th>ฝ่ายงาน</th>
                                        <th>เบอร์ติดต่อ</th>
                                        <th>สถานะ</th>
                                        <th>ผู้ทำรายการ</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $sql = "select b.id as bId,m.name as mname,b.tel as btel, u.*,b.*,m.*,p.people_name,p.people_surname from booking b
                                    inner join meet_room m on m.id = b.meet_room_id
                                    inner join people p on p.people_id = b.user_id
                                    left join users u on b.make_list = u.id
                                    ";
                                    $res = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $row["mname"]; ?></td>
                                            <td><?php echo $row["meet_name"]; ?></td>
                                            <td><?php echo DateThai($row["time_strat"]); ?></td>
                                            <td><?php echo DateThai($row["time_end"]); ?></td>
                                            <td><?php echo $row["people_name_booking"]; ?></td>
                                            <td><?php echo $row["department_booking"]; ?></td>
                                            <td><?php echo $row["btel"]; ?></td>
                                            <td><?php echo $row["status_booking"]; ?></td>
                                            <td><?php echo !empty($row["username"]) ? $row["username"] : ""; ?></td>
                                            <td><button class="btn btn-info btn-detail" id="<?php echo $row["bId"]; ?>">รายละเอียด</button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer> -->
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php require_once "footer.php"; ?>
</body>

</html>

<div class="modal" tabindex="-1" id="showDetailModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดการจอง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="addBooking.php" method="post" id="formBooking">
                    <div class="row">
                        <div class="col-md-12">
                            <label><strong>ชื่อห้องประชุม</strong></label>
                            <input class="form-control" type="text" id="room_name" name="room_name" disabled>
                        </div>
                    </div>
                    <label><strong>วันเวลาที่จอง</strong></label>
                    <div class="row">
                        <div class="col-md-6">
                            <label>เริ่ม</label>
                            <input class="form-control" type="datetime-local" name="time_strat" id="time_strat" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>จบ</label>
                            <input class="form-control" type="datetime-local" name="time_end" id="time_end" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>ชื่อการประชุม</strong></label>
                            <input class="form-control" type="text" name="meet_name" id="meet_name" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label><strong>จำนวนคนที่เข้าร่วมประชุม</strong></label>
                            <input class="form-control" type="text" name="number_people" id="number_people" disabled>
                        </div>
                        <div class="col-md-6">
                            <label><strong>ฝ่ายงานตำแหน่งผู้เข้าร่วมประชุม</strong></label>
                            <input class="form-control" type="text" name="type_people" id="type_people" placeholder="นักเรียน, ผู้บริหาร, หัวหน้างาน" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>รายละเอียดเพิ่มในการประชุม</strong></label>
                            <textarea class="form-control" name="detail_meet" id="detail_meet" cols="30" rows="5" disabled></textarea>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-md-6">
                            <label><strong>ชื่อผู้ทำการจอง</strong></label>
                            <input class="form-control" type="text" name="people_name_booking" id="people_name_booking" disabled>
                        </div>
                        <div class="col-md-6">
                            <label><strong>ฝ่ายงานที่จอง</strong></label>
                            <input class="form-control" type="text" name="department_booking" id="department_booking" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label><strong>เบอร์โทรติดต่อ</strong></label>
                            <input class="form-control" type="text" name="tel" id="tel" maxlength="10" disabled>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        table = new DataTable('#bookingTable', {
            scrollX: true,
            width: "100%",
            lengthMenu: [50, 100, 200, 500],
            responsive: true
        })

        $(document).on("click", ".btn-detail", function() {
            let id = $(this).attr("id")
            $.ajax({
                type: 'POST',
                url: 'getMeetDetail.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    console.log('Submission was successful.');
                    console.log(data)
                    let dataM = data[0];
                    $("#room_name").val(dataM.mname);
                    $("#time_strat").val(dataM.time_strat);
                    $("#time_end").val(dataM.time_end);
                    $("#meet_name").val(dataM.meet_name);
                    $("#number_people").val(dataM.number_people);
                    $("#type_people").val(dataM.type_people);
                    $("#detail_meet").val(dataM.detail_meet);
                    $("#people_name_booking").val(dataM.people_name_booking);
                    $("#department_booking").val(dataM.department_booking);
                    $("#tel").val(dataM.btel);
                    $('#showDetailModal').modal('show')
                },
                error: function(data) {
                    console.log('An error occurred.')
                    console.log(data);
                },
            });

        })
        ห
    })
</script>