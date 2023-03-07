-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 12:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cct_bookingmeetroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `meet_room_id` int(11) NOT NULL,
  `time_strat` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `meet_name` text NOT NULL,
  `number_people` int(11) NOT NULL,
  `type_people` text NOT NULL,
  `detail_meet` text NOT NULL,
  `people_name_booking` varchar(200) NOT NULL,
  `department_booking` varchar(200) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `date_time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_booking` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `user_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `meet_room_id`, `time_strat`, `time_end`, `meet_name`, `number_people`, `type_people`, `detail_meet`, `people_name_booking`, `department_booking`, `tel`, `date_time_stamp`, `status_booking`, `note`, `user_id`) VALUES
(25, 1, '2023-03-07 20:25:00', '2023-03-07 21:25:00', 'ฝึกงาน', 210, 'หัวหน้างานทวภาคี', 'notebook', 'นายกษมา เจริญศรี', 'งานอาชีวศึกษาทวิภาคี', '0800533202', '2023-03-07 11:25:37', 'รอการยืนยัน', 'notebook', '1209501099179'),
(26, 0, '2023-03-07 20:25:00', '2023-03-07 21:26:00', 'ฝึกงาน', 210, 'หัวหน้างานทวภาคี', 'test', 'test', 'งานอาชีวศึกษาทวิภาคี', '0800533202', '2023-03-07 11:26:46', 'รอการยืนยัน', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `meet_room`
--

CREATE TABLE `meet_room` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meet_room`
--

INSERT INTO `meet_room` (`id`, `name`, `pic`, `status`) VALUES
(1, 'ห้องประชุม 1', 'meet_room1.jpg', 'ว่าง'),
(2, 'ห้องประชุม 2', 'meet_room2.jpg', 'ว่าง');

-- --------------------------------------------------------

--
-- Stand-in structure for view `people`
-- (See below for the actual view)
--
CREATE TABLE `people` (
`people_id` varchar(13)
,`people_name` varchar(100)
,`people_surname` varchar(100)
,`people_pic` varchar(160)
,`people_nickname` varchar(160)
,`people_birthday` date
,`people_user` varchar(32)
,`people_pass` varchar(32)
,`people_budget` varchar(10)
,`sex_id` int(1)
,`edu_id` int(2)
,`people_address` varchar(50)
,`people_startdate` date
,`people_position_number` varchar(10)
,`position_id` int(2)
,`position2_id` int(2)
,`people_std_id` varchar(10)
,`province_id` int(8)
,`amphure_id` int(8)
,`tumbol_id` int(8)
,`people_tel` varchar(15)
,`people_mobile` varchar(15)
,`people_email` varchar(250)
,`type_id` int(2)
,`typebud_id` int(2)
,`people_exit` int(1)
,`school_id` varchar(16)
,`std_id` varchar(15)
,`sgs_id` varchar(15)
,`sync_order` int(5)
,`lastlogin` datetime
,`mms_counter` int(5)
,`ath_pass` varchar(32)
,`usergrp_id` varchar(5)
,`barcode_disable` int(1)
,`scan_disable` int(1)
,`deactivate` varchar(1)
,`people_website` varchar(100)
,`people_rfid` varchar(32)
,`linetoken` text
,`std2018_user` varchar(64)
,`std2018_pass` varchar(64)
,`people_lineid` varchar(128)
,`web_only` int(1)
,`anylocate` int(1)
,`plicense_id` int(2)
,`plicense_file` text
,`people_endlicense` date
,`slb_dataorder` int(1)
,`mail_dataorder` int(1)
,`pms_app_connect` int(1)
,`app_lastlogin` datetime
,`cov_vaccine_status_id` varchar(5)
,`cov_infected_status_id` varchar(5)
,`cov_vaccine_file` varchar(250)
,`cov_atk_status_id` varchar(5)
,`people_atk` date
,`people_dist` varchar(10)
,`cartype_id1` varchar(3)
,`cardetail1` varchar(10)
,`province_id1` varchar(4)
,`cartype_id2` varchar(3)
,`cardetail2` varchar(10)
,`province_id2` varchar(4)
,`car_brand1` varchar(100)
,`car_color1` varchar(100)
,`car_pic11` varchar(64)
,`car_pic12` varchar(64)
,`car_pic13` varchar(64)
,`car_pic14` varchar(64)
,`car_brand2` varchar(100)
,`car_color2` varchar(100)
,`car_pic21` varchar(64)
,`car_pic22` varchar(64)
,`car_pic23` varchar(64)
,`car_pic24` varchar(64)
,`pdpa_status` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `people_dep`
-- (See below for the actual view)
--
CREATE TABLE `people_dep` (
`people_dep_id` int(2)
,`people_depgroup_id` int(2)
,`people_dep_name` varchar(200)
,`people_dep_show` int(1)
);

-- --------------------------------------------------------

--
-- Structure for view `people`
--
DROP TABLE IF EXISTS `people`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `people`  AS SELECT `rms2012`.`people`.`people_id` AS `people_id`, `rms2012`.`people`.`people_name` AS `people_name`, `rms2012`.`people`.`people_surname` AS `people_surname`, `rms2012`.`people`.`people_pic` AS `people_pic`, `rms2012`.`people`.`people_nickname` AS `people_nickname`, `rms2012`.`people`.`people_birthday` AS `people_birthday`, `rms2012`.`people`.`people_user` AS `people_user`, `rms2012`.`people`.`people_pass` AS `people_pass`, `rms2012`.`people`.`people_budget` AS `people_budget`, `rms2012`.`people`.`sex_id` AS `sex_id`, `rms2012`.`people`.`edu_id` AS `edu_id`, `rms2012`.`people`.`people_address` AS `people_address`, `rms2012`.`people`.`people_startdate` AS `people_startdate`, `rms2012`.`people`.`people_position_number` AS `people_position_number`, `rms2012`.`people`.`position_id` AS `position_id`, `rms2012`.`people`.`position2_id` AS `position2_id`, `rms2012`.`people`.`people_std_id` AS `people_std_id`, `rms2012`.`people`.`province_id` AS `province_id`, `rms2012`.`people`.`amphure_id` AS `amphure_id`, `rms2012`.`people`.`tumbol_id` AS `tumbol_id`, `rms2012`.`people`.`people_tel` AS `people_tel`, `rms2012`.`people`.`people_mobile` AS `people_mobile`, `rms2012`.`people`.`people_email` AS `people_email`, `rms2012`.`people`.`type_id` AS `type_id`, `rms2012`.`people`.`typebud_id` AS `typebud_id`, `rms2012`.`people`.`people_exit` AS `people_exit`, `rms2012`.`people`.`school_id` AS `school_id`, `rms2012`.`people`.`std_id` AS `std_id`, `rms2012`.`people`.`sgs_id` AS `sgs_id`, `rms2012`.`people`.`sync_order` AS `sync_order`, `rms2012`.`people`.`lastlogin` AS `lastlogin`, `rms2012`.`people`.`mms_counter` AS `mms_counter`, `rms2012`.`people`.`ath_pass` AS `ath_pass`, `rms2012`.`people`.`usergrp_id` AS `usergrp_id`, `rms2012`.`people`.`barcode_disable` AS `barcode_disable`, `rms2012`.`people`.`scan_disable` AS `scan_disable`, `rms2012`.`people`.`deactivate` AS `deactivate`, `rms2012`.`people`.`people_website` AS `people_website`, `rms2012`.`people`.`people_rfid` AS `people_rfid`, `rms2012`.`people`.`linetoken` AS `linetoken`, `rms2012`.`people`.`std2018_user` AS `std2018_user`, `rms2012`.`people`.`std2018_pass` AS `std2018_pass`, `rms2012`.`people`.`people_lineid` AS `people_lineid`, `rms2012`.`people`.`web_only` AS `web_only`, `rms2012`.`people`.`anylocate` AS `anylocate`, `rms2012`.`people`.`plicense_id` AS `plicense_id`, `rms2012`.`people`.`plicense_file` AS `plicense_file`, `rms2012`.`people`.`people_endlicense` AS `people_endlicense`, `rms2012`.`people`.`slb_dataorder` AS `slb_dataorder`, `rms2012`.`people`.`mail_dataorder` AS `mail_dataorder`, `rms2012`.`people`.`pms_app_connect` AS `pms_app_connect`, `rms2012`.`people`.`app_lastlogin` AS `app_lastlogin`, `rms2012`.`people`.`cov_vaccine_status_id` AS `cov_vaccine_status_id`, `rms2012`.`people`.`cov_infected_status_id` AS `cov_infected_status_id`, `rms2012`.`people`.`cov_vaccine_file` AS `cov_vaccine_file`, `rms2012`.`people`.`cov_atk_status_id` AS `cov_atk_status_id`, `rms2012`.`people`.`people_atk` AS `people_atk`, `rms2012`.`people`.`people_dist` AS `people_dist`, `rms2012`.`people`.`cartype_id1` AS `cartype_id1`, `rms2012`.`people`.`cardetail1` AS `cardetail1`, `rms2012`.`people`.`province_id1` AS `province_id1`, `rms2012`.`people`.`cartype_id2` AS `cartype_id2`, `rms2012`.`people`.`cardetail2` AS `cardetail2`, `rms2012`.`people`.`province_id2` AS `province_id2`, `rms2012`.`people`.`car_brand1` AS `car_brand1`, `rms2012`.`people`.`car_color1` AS `car_color1`, `rms2012`.`people`.`car_pic11` AS `car_pic11`, `rms2012`.`people`.`car_pic12` AS `car_pic12`, `rms2012`.`people`.`car_pic13` AS `car_pic13`, `rms2012`.`people`.`car_pic14` AS `car_pic14`, `rms2012`.`people`.`car_brand2` AS `car_brand2`, `rms2012`.`people`.`car_color2` AS `car_color2`, `rms2012`.`people`.`car_pic21` AS `car_pic21`, `rms2012`.`people`.`car_pic22` AS `car_pic22`, `rms2012`.`people`.`car_pic23` AS `car_pic23`, `rms2012`.`people`.`car_pic24` AS `car_pic24`, `rms2012`.`people`.`pdpa_status` AS `pdpa_status` FROM `rms2012`.`people``people`  ;

-- --------------------------------------------------------

--
-- Structure for view `people_dep`
--
DROP TABLE IF EXISTS `people_dep`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `people_dep`  AS SELECT `rms2012`.`people_dep`.`people_dep_id` AS `people_dep_id`, `rms2012`.`people_dep`.`people_depgroup_id` AS `people_depgroup_id`, `rms2012`.`people_dep`.`people_dep_name` AS `people_dep_name`, `rms2012`.`people_dep`.`people_dep_show` AS `people_dep_show` FROM `rms2012`.`people_dep``people_dep`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meet_room`
--
ALTER TABLE `meet_room`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `meet_room`
--
ALTER TABLE `meet_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
