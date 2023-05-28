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
    date_default_timezone_set('Asia/Bangkok');
    ?>

</head>
<style>
    .bg-room-1 {
        background-color: #ed544a;
        border-radius: 10px;
        color: white;
    }

    .bg-room-2 {
        background-color: #dedc6d;
        border-radius: 10px;
        color: black;
    }

    .bg-room-3 {
        background-color: #57cf5d;
        border-radius: 10px;
        color: black;
    }

    .bg-room-4 {
        background-color: #54d9e3;
        border-radius: 10px;
        color: black;
    }

    .bg-room-5 {
        background-color: #ca26eb;
        border-radius: 10px;
        color: white;
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
                    <div id='calendar'></div>

                    <!-- Approach -->

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

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            timeZone: 'UTC+7',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: function(fetchInfo, successCallback, failureCallback) { //custom events function to be called every time the view changes
                $.ajax({
                    url: 'getMeetData.php',
                    type: 'POST',
                    data: {
                    
                    },
                    dataType: 'json',
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error loading events: ' + textStatus + " - " + errorThrown);
                    },
                    success: function(data) {
                        console.log(data)
                        successCallback(data) //pass the event data to fullCalendar via the supplied callback function)
                    }
                }).done(function(data, textStatus, jqXHR) {

                });
                $('#modalCalendar').modal('show')
            },
            eventDidMount: function(info) {
                $(info.el).tooltip({
                    title: info.event.extendedProps.description,
                    placement: "top",
                    trigger: "hover",
                    container: "body",
                    html: true,
                });
            },
        });
        calendar.render()
    })
</script>