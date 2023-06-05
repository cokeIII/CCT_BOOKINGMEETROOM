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
                <div class="row">
                    <div class="col-md-6">
                        <h4>เลือกห้องประชุม</h4>
                    </div>
                    <div class="col-md-6">
                        <!-- <button class="float-end btn btn-info" id="btnCalendar"><img src="img/schedule.png" width="25px" height="auto"> ปฏิทิน</button> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $sql = "select * from meet_room";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <div class="col-md-4">
                            <div class="card mt-3">
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
<!-- calendar -->
<div class="modal" tabindex="-1" role="dialog" id="modalCalendar">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ปฏิทิน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id='calendar'></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
include "footerSetup.php";
?>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btnCalendar', function() {
            let roomId = $(this).attr('roomId')
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
                        url: 'getMeetDataAll.php',
                        type: 'POST',
                        data: {
                            roomId: roomId
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
    })
</script>