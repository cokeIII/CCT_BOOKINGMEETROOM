<?php
header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
$date = date('Y_m_d');
header("Content-Disposition: attachment; filename=ctc_meet_report_$date.xls");
?>
<html>

<body>
    <?php
    include "../connect.php";
    $month = $_GET['monthReport'];
    $year = $_GET['yearReport'];
    if ($month != 0) {
        $sql = "select b.id as bId,m.name as mname,b.tel as btel, u.*,b.*,m.*,p.people_name,p.people_surname from booking b
        inner join meet_room m on m.id = b.meet_room_id
        inner join people p on p.people_id = b.user_id
        left join users u on b.make_list = u.id
        where YEAR(time_strat) = '$year' and MONTH(time_strat) = $month
        ";
    } else {
        $sql = "select b.id as bId,m.name as mname,b.tel as btel, u.*,b.*,m.*,p.people_name,p.people_surname from booking b
        inner join meet_room m on m.id = b.meet_room_id
        inner join people p on p.people_id = b.user_id
        left join users u on b.make_list = u.id
        where YEAR(time_strat) = '$year'
        ";
    }
    $strSQL = $sql;
    $objQuery = mysqli_query($conn, $strSQL);
    ?>
    <table border="1">
        <tr>
            <th>
                <div align="center">ห้องประชุม</div>
            </th>
            <th>
                <div align="center">เวลาเริ่ม</div>
            </th>
            <th>
                <div align="center">เวลาจบ</div>
            </th>
            <th>
                <div align="center">ชื่อการประชุม</div>
            </th>
            <th>
                <div align="center">จำนวนคนที่เข้าร่วมประชุม</div>
            </th>
            <th>
                <div align="center">ฝ่ายงานตำแหน่งผู้เข้าร่วมประชุม</div>
            </th>
            <th>
                <div align="center">รายละเอียดเพิ่มในการประชุม</div>
            </th>
            <th>
                <div align="center">ชื่อผู้ทำการจอง</div>
            </th>
            <th>
                <div align="center">ฝ่ายงานที่จอง</div>
            </th>
            <th>
                <div align="center">เบอร์โทรติดต่อ</div>
            </th>
        </tr>
        <?php
        while ($objResult = mysqli_fetch_array($objQuery)) {
        ?>
            <tr>
                <td>
                    <div align="center"><?php echo $objResult["mname"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["time_strat"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["time_end"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["meet_name"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["number_people"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["type_people"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["detail_meet"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["people_name_booking"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["department_booking"]; ?></div>
                </td>
                <td>
                    <div align="center"><?php echo $objResult["tel"]; ?></div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>