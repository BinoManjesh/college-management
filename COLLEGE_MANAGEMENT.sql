-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 05:12 PM
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
(11, 'DBMS', 'CSE', 13, 4, 1),
(12, 'TOC', 'BASIC SCIENCES', 16, 4, 1),
(13, 'Computer Networks', 'CSE', 14, 4, 1),
(14, 'Embedded System', 'ECE', 15, 4, 1),
(15, 'Technical Communication', 'BASIC SCIENCES', 16, 3, 1),
(16, 'Electrionic Digital Communication', 'ECE', 15, 4, 1),
(17, 'Engineering Drawing', 'CIVIL', 18, 4, 1),
(18, 'Wind engineering', 'CIVIL', 18, 3, 1),
(19, 'Thermodynamics and fluid mechanics', 'MECH', 17, 5, 1),
(20, 'Control systems and robotics', 'MECH', 17, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursematerial`
--

CREATE TABLE `coursematerial` (
  `Course_id` int(11) NOT NULL,
  `Mat_file` varchar(50) NOT NULL,
  `Mat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('CSE', 14),
('ECE', 15),
('BASIC SCIENCES', 16),
('MECH', 17),
('CIVIL', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Announcement` varchar(255) NOT NULL,
  `Course_id` int(11) NOT NULL,
  `Not_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `stunotification`
--

CREATE TABLE `stunotification` (
  `Not_id` int(11) NOT NULL,
  `Stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(13, 'Shishupal', '123', 'Shishupal', ' ', 'emp001', 'CSE', ' ', 'faculty', 0),
(14, 'Tausif', '123', 'Tausif', 'Dewan', 'emp002', 'CSE', '', 'HOD', 0),
(15, 'Mayur', '123', 'Mayur', 'Parate', 'emp003', 'ECE', '', 'HOD', 0),
(16, 'Kirti', '123', 'Kirti', 'Doreshetwar', 'emp004', 'BASIC SCIENCES', '', 'HOD', 0),
(17, 'Aatish', '123', 'Aatish', 'Daryapurkar', 'emp005', 'MECH', '', 'HOD', 0),
(18, 'Puja', '123', 'Puja', 'Gudadhe', 'emp006', 'CIVIL', '', 'HOD', 0);

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
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
