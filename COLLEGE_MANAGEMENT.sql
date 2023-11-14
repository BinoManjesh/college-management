-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 07:06 PM
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
-- Database: `college_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `Assn_id` int(11) NOT NULL,
  `Assn_name` varchar(50) NOT NULL,
  `Due_time` datetime NOT NULL,
  `Course_id` int(11) NOT NULL,
  `Open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`Assn_id`, `Assn_name`, `Due_time`, `Course_id`, `Open`) VALUES
(5, 'test', '2023-11-14 23:33:00', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Stu_id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Course_id` int(11) NOT NULL,
  `Present` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Stu_id`, `Date`, `Course_id`, `Present`) VALUES
(12, '2023-11-14', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Course_id` int(11) NOT NULL,
  `Course_name` varchar(40) NOT NULL,
  `Dept_name` varchar(40) NOT NULL,
  `Fac_id` int(11) NOT NULL,
  `Credits` int(11) NOT NULL,
  `Open` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Course_id`, `Course_name`, `Dept_name`, `Fac_id`, `Credits`, `Open`) VALUES
(9, 'DBMS', 'CSE', 11, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coursematerial`
--

CREATE TABLE `coursematerial` (
  `Course_id` int(11) NOT NULL,
  `Mat_file` varchar(50) NOT NULL,
  `Mat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursematerial`
--

INSERT INTO `coursematerial` (`Course_id`, `Mat_file`, `Mat_name`) VALUES
(9, '1699985010-Resume.pdf', 'Resume.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Dept_name` varchar(20) NOT NULL,
  `Head_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Dept_name`, `Head_id`) VALUES
('admin', 10),
('CSE', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Announcement` varchar(255) NOT NULL,
  `Course_id` int(11) NOT NULL,
  `Not_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`Announcement`, `Course_id`, `Not_id`) VALUES
('Sutdy Material Uploaded - Resume.pdf', 9, 1),
('New Assignment Added - test', 9, 2),
('New Attendance Added - 2023-11-14', 9, 3),
('Marks of - Marks_s1 Edited', 9, 4),
('Course Ended', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `stucourse`
--

CREATE TABLE `stucourse` (
  `Stu_id` int(11) NOT NULL,
  `Course_id` int(11) NOT NULL,
  `Marks_s1` int(11) DEFAULT 0,
  `Marks_s2` int(11) DEFAULT 0,
  `Marks_endsem` int(11) DEFAULT 0,
  `Grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stucourse`
--

INSERT INTO `stucourse` (`Stu_id`, `Course_id`, `Marks_s1`, `Marks_s2`, `Marks_endsem`, `Grade`) VALUES
(12, 9, 10, 0, 0, 'FF');

-- --------------------------------------------------------

--
-- Table structure for table `stunotification`
--

CREATE TABLE `stunotification` (
  `Not_id` int(11) NOT NULL,
  `Stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stunotification`
--

INSERT INTO `stunotification` (`Not_id`, `Stu_id`) VALUES
(1, 12),
(2, 12),
(3, 12),
(4, 12),
(5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `Assn_id` int(11) NOT NULL,
  `Stu_id` int(11) NOT NULL,
  `Sub_time` datetime DEFAULT current_timestamp(),
  `Sub_file` varchar(20) DEFAULT NULL,
  `Grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`Assn_id`, `Stu_id`, `Sub_time`, `Sub_file`, `Grade`) VALUES
(5, 12, '2023-11-14 23:35:52', '1699985152-Smit Aghe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `Off_id` varchar(20) NOT NULL,
  `Dept_name` varchar(20) NOT NULL,
  `Branch_name` varchar(20) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `Semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Username`, `Password`, `First_name`, `Last_name`, `Off_id`, `Dept_name`, `Branch_name`, `type`, `Semester`) VALUES
(10, 'admin', 'admin', 'Admin', ' ', 'Admin', 'admin', NULL, 'admin', NULL),
(11, 'SmitAghera', '123', 'Smit', 'Aghera', 'emp2101', 'CSE', '', 'HOD', 0),
(12, 'bino', '123', 'Bino', 'Manjesh', 'bt21cse098', 'CSE', 'CORE', 'student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`Assn_id`),
  ADD KEY `assn_cid` (`Course_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Stu_id`,`Course_id`,`Date`) USING BTREE,
  ADD KEY `att_cid` (`Course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Course_id`),
  ADD KEY `cou_dname` (`Dept_name`),
  ADD KEY `cou_fid` (`Fac_id`);

--
-- Indexes for table `coursematerial`
--
ALTER TABLE `coursematerial`
  ADD PRIMARY KEY (`Course_id`,`Mat_file`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Dept_name`),
  ADD KEY `dep_hid` (`Head_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Not_id`),
  ADD KEY `not_cid` (`Course_id`);

--
-- Indexes for table `stucourse`
--
ALTER TABLE `stucourse`
  ADD PRIMARY KEY (`Stu_id`,`Course_id`),
  ADD KEY `stc_cid` (`Course_id`);

--
-- Indexes for table `stunotification`
--
ALTER TABLE `stunotification`
  ADD PRIMARY KEY (`Not_id`,`Stu_id`),
  ADD KEY `stn_sid` (`Stu_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`Assn_id`,`Stu_id`),
  ADD KEY `sub_sid` (`Stu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `user_dname` (`Dept_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `Assn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assn_cid` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `att_cid` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `att_sid` FOREIGN KEY (`Stu_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `cou_dname` FOREIGN KEY (`Dept_name`) REFERENCES `department` (`Dept_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cou_fid` FOREIGN KEY (`Fac_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursematerial`
--
ALTER TABLE `coursematerial`
  ADD CONSTRAINT `mat_cid` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `dep_hid` FOREIGN KEY (`Head_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `not_cid` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stucourse`
--
ALTER TABLE `stucourse`
  ADD CONSTRAINT `stc_cid` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stc_sid` FOREIGN KEY (`Stu_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stunotification`
--
ALTER TABLE `stunotification`
  ADD CONSTRAINT `stn_nid` FOREIGN KEY (`Not_id`) REFERENCES `notification` (`Not_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stn_sid` FOREIGN KEY (`Stu_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `sub_aid` FOREIGN KEY (`Assn_id`) REFERENCES `assignments` (`Assn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_sid` FOREIGN KEY (`Stu_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_dname` FOREIGN KEY (`Dept_name`) REFERENCES `department` (`Dept_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
