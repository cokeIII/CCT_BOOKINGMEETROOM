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
                            <h6 class="m-0 font-weight-bold text-primary">จัดการผู้ใช้งาน</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <button class="btn btn-primary float-right" id="btnInsert">เพิ่มผูังาน</button>
                                </div>
                            </div>
                            <table class="table text-nowrap mt-3" id="userTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>Username</th>
                                        <th>สถานะ</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $sql = "select * from users where status != 'admin'";
                                    $res = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $row["username"]; ?></td>
                                            <td><?php echo $row["status"]; ?></td>
                                            <td><button id="<?php echo $row["id"]; ?>" class="btn btn-warning btnEdit">แก้ไข</button></td>
                                            <td><button id="<?php echo $row["id"]; ?>" class="btn btn-danger btnDel">ลบ</button></td>
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

<div class="modal" tabindex="-1" id="insertModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มข้อมูลผู้ใช้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="insertUser.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>username</label>
                            <input class="form-control" type="text" name="username" id="Username" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 ">
                            <label>Password</label>
                            <input class="form-control" type="text" name="password" id="Password" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label>Line Token</label>
                            <input class="form-control" type="text" name="line_noti" id="line_noti">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right">เพิ่มข้อมูล</button>
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

<div class="modal" tabindex="-1" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูลผู้ใช้งาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="editUser.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>username</label>
                            <input class="form-control" type="text" name="username" id="editUsername" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Password</label>
                            <input class="form-control" type="text" name="password" id="editPassword" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Line Token</label>
                            <input class="form-control" type="text" name="line_noti" id="editLine_noti" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="editId">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-warning float-right">แก้ไขข้อมูล</button>
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

        table = new DataTable('#userTable', {
            scrollX: true,
            width: "100%",
            lengthMenu: [50, 100, 200, 500],
            responsive: true
        })

        $(document).on('click', '#btnInsert', function() {
            $('#insertModal').modal('show')
        })

        $(document).on('click', '.btnEdit', function() {
            let id = $(this).attr("id")

            $.ajax({
                type: 'POST',
                url: 'getUser.php',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    console.log('Submission was successful.');
                    if (data.length > 0) {
                        let rowData = data[0]
                        $("#editId").val(rowData.id)
                        $("#editUsername").val(rowData.username)
                        $("#editPassword").val(rowData.password)
                        $("#editLine_noti").val(rowData.line_noti)
                        $('#editModal').modal('show')
                    }
                },
                error: function(data) {
                    console.log('An error occurred.')
                    console.log(data);
                },
            });
        })

        $(document).on('click', '.btnDel', function() {
            let id = $(this).attr("id")
            if (confirm('ต้องการลบรายการนี้ใช่หรือไม่ ?')) {

                $.ajax({
                    type: 'POST',
                    url: 'delUser.php',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log('Submission was successful.');
                        if (data == "200") {
                            window.location.href = "userManager.php ";
                        } else {
                            alert("ลบไม่สำเร็จ")
                        }
                    },
                    error: function(data) {
                        console.log('An error occurred.')
                        console.log(data);
                    },
                });

            }
        })
    })
</script>