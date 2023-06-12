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

     .bg-room-6 {
         background-color: #055ff0;
         border-radius: 10px;
         color: black;
     }

     #sumAllMeet {
         color: blue;
         font-size: 30px;
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
                     <div class="row">
                         <div class="col-md-4">
                             <h4>จำนวนครั้งในการจอง ทั้งหมด <span id="sumAllMeet"></span></h4>
                         </div>
                         <!-- <div class="col-md-8">
                             <div class="row ">
                                 <div class="col-md-2 bg-room-1">
                                     ห้องประชุมพิกุล
                                 </div>
                                 <div class="col-md-2 bg-room-2 ml-1">
                                     ห้องประชุมทิวสน
                                 </div>
                                 <div class="col-md-2 bg-room-3 ml-1">
                                     ห้องประชุม อีอีซี
                                 </div>
                                 <div class="col-md-2 bg-room-4 ml-1">
                                     ห้องประชุมกาสะลอง
                                 </div>
                                 <div class="col-md-2 bg-room-5 ml-1">
                                     หอประชุมคมสัน
                                 </div>
                                 <div class="col-md-2 bg-room-6 ml-1">
                                     ห้องประชุมชมพูพันธ์ุทิพย์
                                 </div>
                             </div>
                         </div> -->
                     </div>
                     <div class="row">
                         <div class="col-md-1">
                             ประจำปี
                         </div>
                         <div class="col-md-1">
                             <select class="form-control" name="yearChart" id="yearChart">
                                 <option value="<?php echo date('Y') + 543; ?>"> <?php echo date('Y') + 543; ?> </option>
                                 <option value="<?php echo date('Y') + 542; ?>"><?php echo date('Y') + 542; ?></option>
                                 <option value="<?php echo date('Y') + 541; ?>"><?php echo date('Y') + 541; ?></option>
                             </select>
                         </div>
                     </div>
                     <div class="chart-area">
                         <canvas id="myAreaChart"></canvas>
                     </div>
                     <!-- Approach -->
                     <hr>
                     <div class="row mt-3">
                         <div class="col-md-6">
                             <div id="chartProgress">

                             </div>
                         </div>
                         <div class="col-md-6 mt-auto">
                             <canvas id="myPieChart"></canvas>
                         </div>
                     </div>
                     <hr>
                     <h4>จำนวนครั้งในการจองของบุคคลและฝ่ายงาน</h4>
                     <div class="row">
                         <div class="col-md-6">
                             <table class="table table-bordered">
                                 <thead class="table-primary">
                                     <tr>
                                         <th>ลำดับ</th>
                                         <th>ชื่อ</th>
                                         <th>จำนวนครั้ง</th>
                                     </tr>
                                 </thead>
                                 <tbody id="personCountMeet">

                                 </tbody>
                             </table>
                         </div>
                         <div class="col-md-6">
                             <table class="table table-bordered">
                                 <thead class="table-primary">
                                     <tr>
                                         <th>ลำดับ</th>
                                         <th>ชื่อฝ่ายงาน</th>
                                         <th>จำนวนครั้ง</th>
                                     </tr>
                                 </thead>
                                 <tbody id="departmentCountMeet">

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

 <!-- Page level plugins -->
 <script src="vendor/chart.js/Chart.min.js"></script>
 <script>
     $(document).ready(function() {
         // Set new default font family and font color to mimic Bootstrap's default styling
         Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
         Chart.defaults.global.defaultFontColor = '#858796';
         let yearChart = $('#yearChart').val()

         function number_format(number, decimals, dec_point, thousands_sep) {
             // *     example: number_format(1234.56, 2, ',', ' ');
             // *     return: '1 234,56'
             number = (number + '').replace(',', '').replace(' ', '');
             var n = !isFinite(+number) ? 0 : +number,
                 prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                 sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                 dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                 s = '',
                 toFixedFix = function(n, prec) {
                     var k = Math.pow(10, prec);
                     return '' + Math.round(n * k) / k;
                 };
             // Fix for IE parseFloat(0.55).toFixed(0) = 0;
             s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
             if (s[0].length > 3) {
                 s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
             }
             if ((s[1] || '').length < prec) {
                 s[1] = s[1] || '';
                 s[1] += new Array(prec - s[1].length + 1).join('0');
             }
             return s.join(dec);
         }
         chartProgress()
         loadPersonTable()
         loadDepTable()

         function loadDepTable() {
             $.ajax({
                 type: 'POST',
                 url: 'getDepartmentCount.php',
                 data: {
                     yearChart: yearChart,
                 },
                 success: function(resData) {
                     $('#departmentCountMeet').html(resData)
                 }
             })
         }

         function loadPersonTable() {
             $.ajax({
                 type: 'POST',
                 url: 'getPersonCount.php',
                 data: {
                     yearChart: yearChart,
                 },
                 success: function(resData) {
                     $('#personCountMeet').html(resData)
                 }
             })
         }

         function chartProgress() {
             $.ajax({
                 type: 'POST',
                 url: 'getProgress.php',
                 data: {
                     yearChart: yearChart,
                 },
                 dataType: 'json',
                 success: function(resData) {
                     $('#chartProgress').html(resData.data)
                     $('#sumAllMeet').html('' + resData.sumAllMeet + '')
                 }
             })
         }

         let color = {}
         color['ห้องประชุมพิกุล'] = '#ed544a'
         color['ห้องประชุมทิวสน'] = '#dedc6d'
         color['ห้องประชุม อีอีซี'] = '#57cf5d'
         color['ห้องประชุมกาสะลอง'] = '#54d9e3'
         color['หอประชุมคมสัน'] = '#ca26eb'
         color['ห้องประชุมชมพูพันธ์ุทิพย์'] = '#055ff0'

         let chartData = []
         var myLineChart = []
         loadChart()
         var myPieChart = []
         loadChartPie()
         $('#yearChart').change(function() {
             yearChart = $('#yearChart').val()
             loadPersonTable()
             chartProgress()
             loadDepTable()
             $.ajax({
                 type: 'POST',
                 url: 'getPieChart.php',
                 data: {
                     yearChart: yearChart,
                 },
                 dataType: 'json',
                 success: function(resData) {
                     console.log(resData)
                     let labels = []
                     let datas = []
                     let backgroundColor = []
                     if (Object.keys(resData).length) {

                         $.each(resData.label, function(keyR, valueR) {
                             labels.push(valueR + " (%) ")
                             backgroundColor.push(color[valueR])
                         })

                         $.each(resData.data, function(keyR, valueR) {
                             datas.push(valueR)
                         })
                     }
                     data = {
                         labels: labels,
                         datasets: [{
                             data: datas,
                             backgroundColor: backgroundColor,
                             hoverBackgroundColor: 'white',
                             hoverBorderColor: "rgba(234, 236, 244, 1)",
                         }],
                     }
                     myPieChart.data = data ? data : [];
                     myPieChart.update()
                 }
             })

             $.ajax({
                 type: 'POST',
                 url: 'getAreaChart.php',
                 data: {
                     yearChart: yearChart,
                 },
                 dataType: 'json',
                 success: function(data) {
                     console.log(data)
                     chartData = []
                     let i = 0
                     if (Object.keys(data).length) {
                         $.each(data, function(keyR, valueR) {
                             let countMeet = []
                             $.each(valueR, function(keyM, valueM) {
                                 console.log(valueR)
                                 countMeet[keyM - 1] = valueM
                             })
                             chartData[i] = {
                                 label: keyR,
                                 lineTension: 0.3,
                                 borderColor: color[keyR],
                                 pointRadius: 3,
                                 pointBackgroundColor: color[keyR],
                                 pointBorderColor: color[keyR],
                                 pointHoverRadius: 3,
                                 pointHoverBackgroundColor: color[keyR],
                                 pointHoverBorderColor: color[keyR],
                                 pointHitRadius: 10,
                                 pointBorderWidth: 2,
                                 data: countMeet
                             }
                             i++
                         })
                     } else {
                         chartData = []
                     }

                     myLineChart.data.datasets = chartData
                     myLineChart.update()
                 }
             })
         })

         // Pie Chart Example
         function loadChartPie() {
             let data = {}
             $.ajax({
                 type: 'POST',
                 url: 'getPieChart.php',
                 data: {
                     yearChart: yearChart,
                 },
                 dataType: 'json',
                 success: function(resData) {
                     console.log(resData)
                     let labels = []
                     let datas = []
                     let backgroundColor = []
                     if (Object.keys(resData).length) {

                         $.each(resData.label, function(keyR, valueR) {
                             labels.push(valueR + " (%) ")
                             backgroundColor.push(color[valueR])
                         })

                         $.each(resData.data, function(keyR, valueR) {
                             datas.push(valueR)
                         })
                     }
                     data = {
                         labels: labels,
                         datasets: [{
                             data: datas,
                             backgroundColor: backgroundColor,
                             hoverBackgroundColor: 'white',
                             hoverBorderColor: "rgba(234, 236, 244, 1)",
                         }],
                     }
                     console.log(data)
                     var ctx = document.getElementById("myPieChart");
                     myPieChart = new Chart(ctx, {
                         type: 'doughnut',
                         data: data,
                         options: {
                             aspectRatio: 1.3,
                             maintainAspectRatio: false,
                             tooltips: {
                                 backgroundColor: "rgb(255,255,255)",
                                 bodyFontColor: "#858796",
                                 borderColor: '#dddfeb',
                                 borderWidth: 1,
                                 xPadding: 15,
                                 yPadding: 15,
                                 displayColors: false,
                                 caretPadding: 10,
                             },
                             legend: {
                                 display: false
                             },

                         },
                     });
                 }
             })
         }


         function loadChart() {
             $.ajax({
                 type: 'POST',
                 url: 'getAreaChart.php',
                 data: {
                     yearChart: yearChart,
                 },
                 dataType: 'json',
                 success: function(data) {
                     console.log(data)
                     let i = 0
                     if (Object.keys(data).length) {
                         $.each(data, function(keyR, valueR) {
                             let countMeet = []
                             $.each(valueR, function(keyM, valueM) {
                                 console.log(valueR)
                                 countMeet[keyM - 1] = valueM
                             })
                             chartData[i] = {
                                 label: keyR,
                                 lineTension: 0.3,
                                 borderColor: color[keyR],
                                 pointRadius: 3,
                                 pointBackgroundColor: color[keyR],
                                 pointBorderColor: color[keyR],
                                 pointHoverRadius: 3,
                                 pointHoverBackgroundColor: color[keyR],
                                 pointHoverBorderColor: color[keyR],
                                 pointHitRadius: 10,
                                 pointBorderWidth: 2,
                                 data: countMeet
                             }
                             i++
                         })
                         // Area Chart Example
                         var ctx = document.getElementById("myAreaChart");

                         myLineChart = new Chart(ctx, {
                             type: 'line',
                             data: {
                                 labels: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
                                 datasets: chartData,
                             },
                             options: {
                                 maintainAspectRatio: false,
                                 layout: {
                                     padding: {
                                         left: 10,
                                         right: 25,
                                         top: 25,
                                         bottom: 0
                                     }
                                 },
                                 scales: {
                                     xAxes: [{
                                         time: {
                                             unit: 'date'
                                         },
                                         gridLines: {
                                             display: true,
                                             drawBorder: false
                                         },
                                         //  ticks: {
                                         //      maxTicksLimit: 7
                                         //  }
                                     }],
                                     yAxes: [{
                                         ticks: {
                                             //   maxTicksLimit: 5,
                                             step: 1,
                                             padding: 0,
                                             callback: function(value, index, values) {
                                                 return '' + number_format(value);
                                             }
                                         },
                                         gridLines: {
                                             color: "rgb(234, 236, 244)",
                                             zeroLineColor: "rgb(234, 236, 244)",
                                             drawBorder: false,
                                             borderDash: [2],
                                             zeroLineBorderDash: [2]
                                         }
                                     }],
                                 },
                                 legend: {
                                     display: false
                                 },
                                 tooltips: {
                                     backgroundColor: "rgb(255,255,255)",
                                     bodyFontColor: "#858796",
                                     titleMarginBottom: 10,
                                     titleFontColor: '#6e707e',
                                     titleFontSize: 14,
                                     borderColor: '#dddfeb',
                                     borderWidth: 1,
                                     xPadding: 15,
                                     yPadding: 15,
                                     displayColors: false,
                                     intersect: false,
                                     mode: 'index',
                                     caretPadding: 10,
                                     callbacks: {
                                         label: function(tooltipItem, chart) {
                                             var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                             return datasetLabel + ' ' + number_format(tooltipItem.yLabel);
                                         }
                                     }
                                 }
                             }
                         });

                     }
                 },
                 error: function(data) {
                     console.log('An error occurred.')
                     console.log(data);
                 },
             });
         }
     })
 </script>