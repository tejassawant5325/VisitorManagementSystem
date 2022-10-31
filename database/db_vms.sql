-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 01:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(10) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `status`) VALUES
(1, 'Ratnagiri Rural', '1'),
(2, 'Ratnagiri City', '1'),
(3, 'Dapoli', '1'),
(4, 'Dabhol', '1'),
(5, 'Mandangad ', '1'),
(6, 'Bankot', '1'),
(7, 'Khed', '1'),
(8, 'Chiplun', '1'),
(9, 'Guhagar', '1'),
(10, 'Sawarda', '1'),
(11, 'Alore Shirgaon', '1'),
(12, 'Jaigad', '1'),
(13, 'Sangmeshwar', '1'),
(14, 'Devrukh', '1'),
(15, 'Lanja', '1'),
(16, 'Rajapur', '1'),
(17, 'Nate', '1'),
(18, 'Purngad', '1');

-- --------------------------------------------------------

--
-- Table structure for table `info_visitor`
--

CREATE TABLE `info_visitor` (
  `Serial` int(11) NOT NULL,
  `public_id` int(20) NOT NULL,
  `Name` char(50) NOT NULL,
  `Middle_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Contact` bigint(10) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `Purpose` varchar(100) NOT NULL,
  `lwd` varchar(100) NOT NULL,
  `agent_name` varchar(30) NOT NULL,
  `agent_contact` varchar(20) NOT NULL,
  `owner_name` varchar(30) NOT NULL,
  `owner_contact` varchar(20) NOT NULL,
  `owner_address` varchar(100) NOT NULL,
  `visitor_caste` varchar(20) NOT NULL,
  `visitor_religion` varchar(20) NOT NULL,
  `Per_address` varchar(255) NOT NULL,
  `temp_address` varchar(255) NOT NULL,
  `meetingTo` varchar(100) NOT NULL,
  `ownername` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `Date` date NOT NULL,
  `application_approved` date DEFAULT NULL,
  `TimeIN` time NOT NULL,
  `ReceiptID` int(6) NOT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `Comment` varchar(100) NOT NULL,
  `TimeOUT` time NOT NULL,
  `registeredBy` varchar(30) NOT NULL,
  `department` varchar(20) NOT NULL,
  `loggedOutBy` varchar(30) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `age` int(10) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_id_card` varchar(255) NOT NULL,
  `user_agreement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_visitor`
--

INSERT INTO `info_visitor` (`Serial`, `public_id`, `Name`, `Middle_Name`, `Last_Name`, `Contact`, `Nationality`, `Purpose`, `lwd`, `agent_name`, `agent_contact`, `owner_name`, `owner_contact`, `owner_address`, `visitor_caste`, `visitor_religion`, `Per_address`, `temp_address`, `meetingTo`, `ownername`, `day`, `month`, `year`, `Date`, `application_approved`, `TimeIN`, `ReceiptID`, `Status`, `Comment`, `TimeOUT`, `registeredBy`, `department`, `loggedOutBy`, `dob`, `age`, `user_image`, `user_id_card`, `user_agreement`) VALUES
(1, 0, 'Rhonda', 'Basil Francis', 'Olsen', 9967458160, 'Nepal', 'Mango Farm', 'Laborum repudiandae ', 'Hayley Gregory', '9967458160', 'Brittany Holt', '9967458160', '19/15 Vanrai Mhada Colony Goregaon East', 'Et ad eos fuga Illo', 'Omnis consequatur A', 'Eius quia deserunt p', 'Non qui est molestia', '', '', '11', 10, 2022, '2022-10-11', NULL, '15:14:56', 324427, NULL, '', '00:00:00', 'root', 'Ratnagiri City', '', '2006-07-01', 40, 'visitorphotos/New Doc 2020-05-10 20.06.07_1.jpg', 'visitorsidcard/New Doc 2020-05-10 20.06.07_1.jpg', 'visitoragreement/New Doc 2020-05-10 20.06.07_1.jpg'),
(2, 1, 'Ezekiel', 'Sonya Patterson', 'Nicholson', 70, 'Pakistan', 'Mango Farm', '', 'Ayanna Allison', '652', 'Oliver Mcdaniel', '72', 'Delectus natus id e', 'Est in enim non anim', 'Aut voluptatem et po', 'Qui sed quis in ut o', 'Asperiores rerum con', '', '', '11', 10, 2022, '2022-10-11', NULL, '15:19:35', 385217, NULL, '', '00:00:00', 'tejas', 'Alore Shirgaon', '', '1984-08-21', 38, 'visitorphotos/New Doc 2020-05-10 20.06.07_3.jpg', 'visitorsidcard/New Doc 2020-05-10 20.06.07_3.jpg', 'visitoragreement/New Doc 2020-05-10 20.06.07_3.jpg'),
(3, 1, 'Timon', 'Kibo Pate', 'Ross', 25, 'Nepal', 'Mango Farm', '', 'Jarrod Booth', '355', 'Lunea Greer', '41', 'Culpa sint qui del', 'Laboris assumenda es', 'Mollitia rerum id ip', 'Laboriosam necessit', 'Enim ex ipsa ex del', '', '', '11', 10, 2022, '2022-10-11', NULL, '15:20:59', 243765, NULL, '', '00:00:00', 'tejas', 'Ratnagiri City', '', '1980-05-13', 63, 'visitorphotos/Pic.jpg', 'visitorsidcard/Pic.jpg', 'visitoragreement/Pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `SnoPrimary` int(11) NOT NULL,
  `userName` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `registered_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`SnoPrimary`, `userName`, `first_name`, `last_name`, `mobile`, `pass`, `registered_by`) VALUES
(1, 'admin', 'admin', 'admin', '7715992305', '$2y$10$kRzTabKRX3x90gxM0Upu3.DZZsogB7N9CfOC9rM17/jYrmDeyfd6.', 'tejas99');

-- --------------------------------------------------------

--
-- Table structure for table `operators_login_info`
--

CREATE TABLE `operators_login_info` (
  `operator_id` int(11) NOT NULL,
  `operator_username` varchar(20) NOT NULL,
  `operator_contact` varchar(20) NOT NULL,
  `police_station` varchar(50) NOT NULL,
  `operator_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operators_login_info`
--

INSERT INTO `operators_login_info` (`operator_id`, `operator_username`, `operator_contact`, `police_station`, `operator_password`) VALUES
(1, 'tejas', '7715992305', 'Ratnagiri City', '$2y$10$d0x3vU7Q5uehWTpIb2UhQOqojUi7wlJ0dOVXQMTVAcIE0CZWwKn6u'),
(2, 'rohit', '7715992305', 'Ratnagiri Rural', '$2y$10$.yHYAlUGKd7M/3eTffuT6eTFh9tv3n7ujq9WWE8fyI0a19KMzcSwq'),
(4, 'purva', '7715992305', 'Chiplun', '$2y$10$zs4j8JMQM4RQkDKmEChJCuq4vL6DzJ5vwNim5Vo92SmGjpSCenhmC');

-- --------------------------------------------------------

--
-- Table structure for table `public_login_info`
--

CREATE TABLE `public_login_info` (
  `public_id` int(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `public_login_info`
--

INSERT INTO `public_login_info` (`public_id`, `username`, `mobile`, `password`) VALUES
(1, 'tejas', '771599305', '$2y$10$CCTssiOfXPj5g6ry2byH2.M7p5Gb/pYW2eccoiPN/s6MfUQHvYAoq');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_record`
--

CREATE TABLE `visitor_record` (
  `serial_no` int(10) NOT NULL,
  `visitor_fname` varchar(50) NOT NULL,
  `visitor_mname` varchar(50) NOT NULL,
  `visitor_lname` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `nationality` varchar(40) NOT NULL,
  `application_filled` varchar(50) NOT NULL,
  `per_address` varchar(100) NOT NULL,
  `temp_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_record`
--

INSERT INTO `visitor_record` (`serial_no`, `visitor_fname`, `visitor_mname`, `visitor_lname`, `contact`, `nationality`, `application_filled`, `per_address`, `temp_address`) VALUES
(1, 'Ulysses', 'Edan Holloway', 'Welch', '4', 'Bangladesh', '2022/10/04', 'Quia reiciendis sint', 'Possimus laboriosam'),
(2, 'Rhiannon', 'Marsden Hess', 'Mullen', '85', 'Nepal', '2022/10/04', 'Aut vero est facere ', 'Saepe in pariatur D'),
(3, 'Tejas', 'Bhaskar', 'Sawant', '9967458160', 'Nepal', '2022/10/04', 'P/15 BEST Staff Quarters Sai Baba Road', 'Vanrai Mhada colony'),
(4, 'Rhonda', 'Basil Francis', 'Olsen', '9967458160', 'Nepal', '2022/10/11', 'Eius quia deserunt p', 'Non qui est molestia'),
(5, 'Ezekiel', 'Sonya Patterson', 'Nicholson', '70', 'Pakistan', '2022/10/11', 'Qui sed quis in ut o', 'Asperiores rerum con'),
(6, 'Timon', 'Kibo Pate', 'Ross', '25', 'Nepal', '2022/10/11', 'Laboriosam necessit', 'Enim ex ipsa ex del');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `info_visitor`
--
ALTER TABLE `info_visitor`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`SnoPrimary`);

--
-- Indexes for table `operators_login_info`
--
ALTER TABLE `operators_login_info`
  ADD PRIMARY KEY (`operator_id`);

--
-- Indexes for table `public_login_info`
--
ALTER TABLE `public_login_info`
  ADD PRIMARY KEY (`public_id`);

--
-- Indexes for table `visitor_record`
--
ALTER TABLE `visitor_record`
  ADD PRIMARY KEY (`serial_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `info_visitor`
--
ALTER TABLE `info_visitor`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_info`
--
ALTER TABLE `login_info`
  MODIFY `SnoPrimary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operators_login_info`
--
ALTER TABLE `operators_login_info`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `public_login_info`
--
ALTER TABLE `public_login_info`
  MODIFY `public_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_record`
--
ALTER TABLE `visitor_record`
  MODIFY `serial_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
