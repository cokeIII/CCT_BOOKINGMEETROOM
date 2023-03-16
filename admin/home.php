<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once "header.php";
    session_start();
    if (empty($_SESSION["user_id"])) {
        header("location: index.php");
    }
    ?>

</head>

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
                            <h6 class="m-0 font-weight-bold text-primary">รายการจอง</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <th>ชื่อห้องประชุม</th>
                                <th>ชื่อการประชุม</th>
                                <th>เวลาเริ่ม</th>
                                <th>เวลาจบ</th>
                                <th>ชื่อผู้จอง</th>
                                <th>ฝ่ายงาน</th>
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