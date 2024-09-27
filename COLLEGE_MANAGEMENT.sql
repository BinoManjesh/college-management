-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 09:04 PM
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
(6, 'Transaction', '2023-12-15 22:44:00', 11, 0),
(7, 'Locks', '2023-11-20 22:46:00', 11, 0),
(8, 'Socket Programming', '2023-11-16 22:46:00', 13, 0),
(9, '8051 lab', '2023-12-01 22:48:00', 14, 0),
(10, 'Lab', '2023-11-28 22:49:00', 16, 0),
(11, 'Turing Machine', '2023-11-20 22:50:00', 12, 0),
(12, 'presentation', '2023-11-27 22:51:00', 15, 0),
(13, 'AutoCad', '2023-11-02 22:52:00', 17, 0),
(14, 'Windmill', '2023-11-30 22:52:00', 18, 0);

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
(19, '2023-11-01', 11, 1),
(19, '2023-11-17', 11, 1),
(19, '2023-11-27', 15, 1),
(19, '2023-11-01', 17, 0),
(20, '2023-11-20', 12, 1),
(20, '2023-11-27', 12, 1),
(20, '2023-11-01', 13, 1),
(20, '2023-11-05', 13, 0),
(20, '2023-11-28', 14, 1),
(21, '2023-11-28', 14, 1),
(21, '2023-11-13', 16, 1),
(21, '2023-11-01', 18, 1),
(22, '2023-11-01', 13, 1),
(22, '2023-11-05', 13, 0),
(22, '2023-11-28', 14, 1),
(23, '2023-11-20', 12, 1),
(23, '2023-11-27', 12, 1),
(23, '2023-11-01', 19, 1),
(23, '2023-10-05', 20, 1),
(24, '2023-11-01', 11, 0),
(24, '2023-11-17', 11, 1),
(24, '2023-11-01', 17, 0),
(24, '2023-11-01', 18, 1);

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

--
-- Dumping data for table `coursematerial`
--

INSERT INTO `coursematerial` (`Course_id`, `Mat_file`, `Mat_name`) VALUES
(11, '1700068509-Basic-SQL-Tutorial-Sol.pdf', 'Basic-SQL-Tutorial-Sol.pdf'),
(12, '1700068783-Sipser_Introduction.to.the.Theory.of.Co', 'Sipser_Introduction.to.the.Theory.of.Computation.3'),
(13, '1700068652-Textbook.pdf', 'Textbook.pdf'),
(14, '1700068690-8051 Ayala.pdf', '8051 Ayala.pdf'),
(15, '1700068859-I st chapter.pdf', 'I st chapter.pdf'),
(16, '1700068742-Atomic Structure!doping.pdf', 'Atomic Structure!doping.pdf');

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

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`Announcement`, `Course_id`, `Not_id`) VALUES
('New Assignment Added - Transaction', 11, 9),
('New Attendance Added - 2023-11-01', 11, 10),
('Attendance of date - 2023-11-01 Edited', 11, 11),
('New Attendance Added - 2023-11-17', 11, 12),
('Attendance of date - 2023-11-17 Edited', 11, 13),
('Sutdy Material Uploaded - Basic-SQL-Tutorial-Sol.pdf', 11, 14),
('Marks of - Marks_s1 Edited', 11, 15),
('Marks of - Marks_s2 Edited', 11, 16),
('New Assignment Added - Locks', 11, 17),
('New Assignment Added - Socket Programming', 13, 18),
('New Attendance Added - 2023-11-01', 13, 19),
('New Attendance Added - 2023-11-05', 13, 20),
('Attendance of date - 2023-11-01 Edited', 13, 21),
('Attendance of date - 2023-11-05 Edited', 13, 22),
('Sutdy Material Uploaded - Textbook.pdf', 13, 23),
('Marks of - Marks_s1 Edited', 13, 24),
('Marks of - Marks_s2 Edited', 13, 25),
('Sutdy Material Uploaded - 8051 Ayala.pdf', 14, 26),
('New Assignment Added - 8051 lab', 14, 27),
('New Attendance Added - 2023-11-28', 14, 28),
('Attendance of date - 2023-11-28 Edited', 14, 29),
('Marks of - Marks_s1 Edited', 14, 30),
('Sutdy Material Uploaded - Atomic Structure!doping.pdf', 16, 31),
('New Assignment Added - Lab', 16, 32),
('New Attendance Added - 2023-11-13', 16, 33),
('Attendance of date - 2023-11-13 Edited', 16, 34),
('Marks of - Marks_s1 Edited', 16, 35),
('Sutdy Material Uploaded - Sipser_Introduction.to.the.Theory.of.Computation.3E.pdf', 12, 36),
('New Attendance Added - 2023-11-20', 12, 37),
('New Attendance Added - 2023-11-27', 12, 38),
('Attendance of date - 2023-11-20 Edited', 12, 39),
('Attendance of date - 2023-11-27 Edited', 12, 40),
('New Assignment Added - Turing Machine', 12, 41),
('Marks of - Marks_s1 Edited', 12, 42),
('Sutdy Material Uploaded - I st chapter.pdf', 15, 43),
('New Assignment Added - presentation', 15, 44),
('New Attendance Added - 2023-11-27', 15, 45),
('Attendance of date - 2023-11-27 Edited', 15, 46),
('Marks of - Marks_s1 Edited', 15, 47),
('New Attendance Added - 2023-11-01', 19, 48),
('Attendance of date - 2023-11-01 Edited', 19, 49),
('New Attendance Added - 2023-10-05', 20, 50),
('Attendance of date - 2023-10-05 Edited', 20, 51),
('Marks of - Marks_s1 Edited', 20, 52),
('New Attendance Added - 2023-11-01', 17, 53),
('New Assignment Added - AutoCad', 17, 54),
('New Assignment Added - Windmill', 18, 55),
('New Attendance Added - 2023-11-01', 18, 56),
('Attendance of date - 2023-11-01 Edited', 18, 57),
('Marks of - Marks_s1 Edited', 18, 58),
('Marks of - Marks_s2 Edited', 18, 59),
('Marks of - Marks_endsem Edited', 18, 60);

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
(19, 11, 10, 0, 0, NULL),
(19, 15, 15, 0, 0, NULL),
(19, 17, 0, 0, 0, NULL),
(20, 12, 15, 0, 0, NULL),
(20, 13, 10, 5, 0, NULL),
(20, 14, 6, 0, 0, NULL),
(21, 14, 4, 0, 0, NULL),
(21, 16, 10, 0, 0, NULL),
(21, 18, 10, 8, 34, NULL),
(22, 13, 11, 4, 0, NULL),
(22, 14, 3, 0, 0, NULL),
(23, 12, 15, 0, 0, NULL),
(23, 19, 0, 0, 0, NULL),
(23, 20, 6, 0, 0, NULL),
(24, 11, 11, 5, 0, NULL),
(24, 17, 0, 0, 0, NULL),
(24, 18, 7, 9, 45, NULL);

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
(9, 24),
(10, 24),
(11, 19),
(11, 24),
(12, 19),
(12, 24),
(13, 19),
(13, 24),
(14, 19),
(14, 24),
(15, 19),
(15, 24),
(16, 19),
(16, 24),
(17, 19),
(17, 24),
(18, 20),
(18, 22),
(19, 20),
(19, 22),
(20, 20),
(20, 22),
(21, 20),
(21, 22),
(22, 20),
(22, 22),
(23, 20),
(23, 22),
(24, 20),
(24, 22),
(25, 20),
(25, 22),
(26, 20),
(26, 21),
(26, 22),
(27, 20),
(27, 21),
(27, 22),
(28, 20),
(28, 21),
(28, 22),
(29, 20),
(29, 21),
(29, 22),
(30, 20),
(30, 21),
(30, 22),
(31, 21),
(32, 21),
(33, 21),
(34, 21),
(35, 21),
(36, 20),
(36, 23),
(37, 20),
(37, 23),
(38, 20),
(38, 23),
(39, 20),
(39, 23),
(40, 20),
(40, 23),
(41, 20),
(41, 23),
(42, 20),
(42, 23),
(43, 19),
(44, 19),
(45, 19),
(46, 19),
(47, 19),
(48, 23),
(49, 23),
(50, 23),
(51, 23),
(52, 23),
(53, 19),
(53, 24),
(54, 19),
(54, 24),
(55, 21),
(55, 24),
(56, 21),
(56, 24),
(57, 21),
(57, 24),
(58, 21),
(58, 24),
(59, 21),
(59, 24),
(60, 21),
(60, 24);

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
(6, 19, '2023-11-16 00:49:26', '1700075966-BT21CSE08', NULL),
(7, 19, '2023-11-16 00:51:01', '1700076061-Resume.pd', NULL),
(12, 19, '2023-11-16 00:51:19', '1700076079-ses2.pdf', NULL);

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
(18, 'Puja', '123', 'Puja', 'Gudadhe', 'emp006', 'CIVIL', '', 'HOD', 0),
(19, 'student1', '123', 'student1', ' ', 'stu001', 'CSE', 'CORE', 'student', 1),
(20, 'student2', '123', 'student2', ' ', 'stu002', 'CSE', 'CORE', 'student', 4),
(21, 'student3', '123', 'student3', ' ', 'stu003', 'ECE', 'IOTICS', 'student', 6),
(22, 'student4', '123', 'student4', ' ', 'stu004', 'ECE', 'IOTICS', 'student', 7),
(23, 'student5', '123', 'student5', ' ', 'stu005', 'MECH', 'STRUCTURE', 'student', 5),
(24, 'student6', '123', 'student6', ' ', 'stu006', 'CIVIL', '', 'student', 2);

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
  MODIFY `Assn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
