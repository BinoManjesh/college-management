-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 03:13 PM
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
(1, 'hello', '2023-11-29 00:00:00', 1, 0),
(2, 'hello2', '2023-11-30 00:00:00', 1, 0),
(4, 'hello', '2023-11-17 19:02:00', 1, 0);

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
(1, '2023-11-22', 1, 0),
(1, '2023-11-28', 1, 0);

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
(1, 'DBMS', 'CSE', 1, 69, 1),
(2, 'DBMS2', 'CSE', 1, 4, 1),
(3, 'DBMS3', 'CSE', 1, 4, 1),
(4, 'DBMS4', 'CSE', 1, 5, 1),
(5, 'DBMS5', 'CSE', 1, 6, 1),
(6, 'DBMS6', 'CSE', 1, 7, 1),
(7, 'EMBB', 'ECE', 2, 6, 1),
(8, 'abcd', 'abcd', 9, 5, 1);

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
(1, '1699899391-Resume.pdf', 'Resume.pdf'),
(1, '1699900840-Smit Aghera_IIITN.pdf', 'Smit Aghera_IIITN.pdf'),
(1, '1699903706-Referall text.txt', 'Referall text.txt');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Dept_name` varchar(20) NOT NULL,
  `Head_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Marks_s1` int(11) DEFAULT NULL,
  `Marks_s2` int(11) DEFAULT NULL,
  `Marks_endsem` int(11) DEFAULT NULL,
  `Grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stucourse`
--

INSERT INTO `stucourse` (`Stu_id`, `Course_id`, `Marks_s1`, `Marks_s2`, `Marks_endsem`, `Grade`) VALUES
(1, 1, NULL, NULL, NULL, 'AA'),
(1, 2, NULL, NULL, NULL, NULL),
(1, 3, NULL, NULL, NULL, NULL),
(1, 6, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`Assn_id`, `Stu_id`, `Sub_time`, `Sub_file`, `Grade`) VALUES
(1, 1, '2023-11-14 16:05:40', '1699958140-Resume.pd', NULL);

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
(1, 'bino', 'heheboi', 'Bino', 'Manjesh', 'BT21CSE098', 'CSE', 'CSE Core', 'student', 5),
(2, 'smit007', '456123', 'smit', 'aghera', 'bt21cse086', 'CSE', 'CORE CSE', 'HOD', 5),
(9, 'root', 'root', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`Assn_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Stu_id`,`Course_id`,`Date`) USING BTREE;

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Course_id`);

--
-- Indexes for table `coursematerial`
--
ALTER TABLE `coursematerial`
  ADD PRIMARY KEY (`Course_id`,`Mat_file`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Dept_name`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Not_id`);

--
-- Indexes for table `stucourse`
--
ALTER TABLE `stucourse`
  ADD PRIMARY KEY (`Stu_id`,`Course_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`Assn_id`,`Stu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `Assn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Not_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
