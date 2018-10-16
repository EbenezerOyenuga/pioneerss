-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 08:27 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citizenship`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assigned_roles`
--

CREATE TABLE `tbl_assigned_roles` (
  `ASSIGNED_ROLE_ID` int(11) NOT NULL,
  `LOGIN_ID` int(11) NOT NULL,
  `ASSIGNED_ROLE` int(5) NOT NULL,
  `ASSIGNED_SUBROLE` char(4) NOT NULL,
  `ASSIGNED_SUBROLE2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assigned_roles`
--

INSERT INTO `tbl_assigned_roles` (`ASSIGNED_ROLE_ID`, `LOGIN_ID`, `ASSIGNED_ROLE`, `ASSIGNED_SUBROLE`, `ASSIGNED_SUBROLE2`) VALUES
(3, 11, 4, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `DEPARTMENT_ID` char(5) NOT NULL,
  `SCHOOL_ID` char(4) NOT NULL,
  `DEPARTMENT` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grades`
--

CREATE TABLE `tbl_grades` (
  `GRADE` char(1) NOT NULL,
  `MIN_RANGE` int(2) NOT NULL,
  `MAX_RANGE` int(2) NOT NULL,
  `GRADE_WEIGHT` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_levels`
--

CREATE TABLE `tbl_levels` (
  `LEVEL_ID` int(11) NOT NULL,
  `LEVEL` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_levels`
--

INSERT INTO `tbl_levels` (`LEVEL_ID`, `LEVEL`) VALUES
(1, 100),
(2, 200),
(3, 300),
(4, 400),
(5, 500),
(6, 600),
(7, 700);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `LOGIN_ID` int(11) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `TITLE_ID` int(2) NOT NULL,
  `FIRSTNAME` varchar(25) NOT NULL,
  `SURNAME` varchar(25) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL DEFAULT 'Password1',
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`LOGIN_ID`, `EMAIL`, `TITLE_ID`, `FIRSTNAME`, `SURNAME`, `PASSWORD`, `STATUS`) VALUES
(11, 'registryadmin@babcock.edu.ng', 2, 'Veronica', 'Idowu', '70ccd9007338d6d81dd3b6271621b9cf9a97ea00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lookup`
--

CREATE TABLE `tbl_lookup` (
  `LOOKUP_ID` int(11) NOT NULL,
  `LOOKUP_TYPE` varchar(100) NOT NULL,
  `LOOKUP_NAME` varchar(100) NOT NULL,
  `LOOKUP_VALUE` varchar(10) NOT NULL,
  `LOOKUP_DESCRIPTION` varchar(255) NOT NULL,
  `ATTRI1` int(2) NOT NULL,
  `ATTRI2` int(2) NOT NULL,
  `ATTRI3` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`LOOKUP_ID`, `LOOKUP_TYPE`, `LOOKUP_NAME`, `LOOKUP_VALUE`, `LOOKUP_DESCRIPTION`, `ATTRI1`, `ATTRI2`, `ATTRI3`) VALUES
(2, 'Pass Marks', 'Pass Marks', 'PASSMARK', 'Pass Marks for Citizenship Grading System', 40, 40, 40);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programs`
--

CREATE TABLE `tbl_programs` (
  `PROGRAM_ID` varchar(6) NOT NULL,
  `DEPARTMENT_ID` varchar(6) NOT NULL,
  `PROGRAM` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residence`
--

CREATE TABLE `tbl_residence` (
  `RESIDENCE_ID` varchar(6) NOT NULL,
  `RESIDENCE_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `ROLE_ID` int(11) NOT NULL,
  `ROLE` varchar(100) NOT NULL,
  `ROLE_STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`ROLE_ID`, `ROLE`, `ROLE_STATUS`) VALUES
(1, 'Chapel Seminar', 1),
(2, 'Residence', 1),
(3, 'Worship', 1),
(4, 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schools`
--

CREATE TABLE `tbl_schools` (
  `SCHOOL_ID` varchar(6) NOT NULL,
  `SCHOOL` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semesters`
--

CREATE TABLE `tbl_semesters` (
  `SEMESTER_ID` int(11) NOT NULL,
  `SEMESTER` varchar(15) NOT NULL,
  `CURRENT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_passmark`
--

CREATE TABLE `tbl_semester_passmark` (
  `SEMESTER_PASSMARK_ID` int(11) NOT NULL,
  `SEMESTER_ID` int(11) NOT NULL,
  `CHAPEL_PASSMARK` int(2) NOT NULL DEFAULT '12',
  `RESIDENCE_PASSMARK` int(2) NOT NULL DEFAULT '50',
  `WORSHIP_PASSMARK` int(2) NOT NULL DEFAULT '48'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_requirements`
--

CREATE TABLE `tbl_semester_requirements` (
  `SEMESTER_REQUIREMENT_ID` int(11) NOT NULL,
  `SEMESTER_ID` int(11) NOT NULL,
  `CHAPEL_REQUIREMENT` int(2) NOT NULL DEFAULT '12',
  `RESIDENCE_REQUIREMENT` int(2) NOT NULL DEFAULT '50',
  `WORSHIP_REQUIREMENT` int(2) NOT NULL DEFAULT '48'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_scores`
--

CREATE TABLE `tbl_semester_scores` (
  `SEMESTER_SCORE_ID` int(11) NOT NULL,
  `SEMESTER_STUDENT_ID` int(11) NOT NULL,
  `CHAPEL_SCORES` int(2) UNSIGNED DEFAULT NULL,
  `RESIDENCE_SCORES` int(2) UNSIGNED DEFAULT NULL,
  `WORSHIP_SCORES` int(2) UNSIGNED DEFAULT NULL,
  `CHAPEL_STATUS` int(1) NOT NULL,
  `RESIDENCE_STATUS` int(1) NOT NULL,
  `WORSHIP_STATUS` int(1) NOT NULL,
  `CHAPEL_OLD_SCORE` int(2) DEFAULT NULL,
  `RESIDENCE_OLD_SCORE` int(2) DEFAULT NULL,
  `WORSHIP_OLD_SCORE` int(2) DEFAULT NULL,
  `CHAPEL_GRADER` int(2) UNSIGNED DEFAULT NULL,
  `RESIDENCE_GRADER` int(2) UNSIGNED DEFAULT NULL,
  `WORSHIP_GRADER` int(2) UNSIGNED DEFAULT NULL,
  `CHAPEL_REASON` varchar(255) NOT NULL,
  `RESIDENCE_REASON` varchar(255) NOT NULL,
  `WORSHIP_REASON` varchar(255) NOT NULL,
  `CHAPEL_APPROVAL_REASON` varchar(255) NOT NULL,
  `RESIDENCE_APPROVAL_REASON` varchar(255) NOT NULL,
  `WORSHIP_APPROVAL_REASON` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_students`
--

CREATE TABLE `tbl_semester_students` (
  `SEMESTER_STUDENT_ID` int(11) NOT NULL,
  `SEMESTER_ID` int(11) NOT NULL,
  `MATRIC_NO` varchar(10) NOT NULL,
  `STUDENT_NAME` varchar(150) NOT NULL,
  `RESIDENCE_ID` varchar(6) NOT NULL,
  `PROGRAM_ID` varchar(6) NOT NULL,
  `LEVEL_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_weights`
--

CREATE TABLE `tbl_semester_weights` (
  `SEMESTER_WEIGHT_ID` int(11) NOT NULL,
  `SEMESTER_ID` int(11) NOT NULL,
  `LEVEL_ID` int(3) NOT NULL,
  `CHAPEL_WEIGHT` int(2) NOT NULL DEFAULT '20',
  `RESIDENCE_WEIGHT` int(2) NOT NULL DEFAULT '40',
  `WORSHIP_WEIGHT` int(2) NOT NULL DEFAULT '40'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_titles`
--

CREATE TABLE `tbl_titles` (
  `titleId` int(11) NOT NULL,
  `title` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_titles`
--

INSERT INTO `tbl_titles` (`titleId`, `title`) VALUES
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Miss.'),
(4, 'Dr.'),
(5, 'Prof.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_assigned_roles`
--
ALTER TABLE `tbl_assigned_roles`
  ADD PRIMARY KEY (`ASSIGNED_ROLE_ID`),
  ADD KEY `LOGIN_ID` (`LOGIN_ID`,`ASSIGNED_ROLE`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`DEPARTMENT_ID`),
  ADD KEY `SCHOOL_ID` (`SCHOOL_ID`),
  ADD KEY `SCHOOL_ID_2` (`SCHOOL_ID`);

--
-- Indexes for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  ADD PRIMARY KEY (`GRADE`);

--
-- Indexes for table `tbl_levels`
--
ALTER TABLE `tbl_levels`
  ADD PRIMARY KEY (`LEVEL_ID`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`LOGIN_ID`);

--
-- Indexes for table `tbl_lookup`
--
ALTER TABLE `tbl_lookup`
  ADD PRIMARY KEY (`LOOKUP_ID`);

--
-- Indexes for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  ADD PRIMARY KEY (`PROGRAM_ID`),
  ADD KEY `DEPARTMENT_ID` (`DEPARTMENT_ID`);

--
-- Indexes for table `tbl_residence`
--
ALTER TABLE `tbl_residence`
  ADD PRIMARY KEY (`RESIDENCE_ID`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `tbl_schools`
--
ALTER TABLE `tbl_schools`
  ADD PRIMARY KEY (`SCHOOL_ID`);

--
-- Indexes for table `tbl_semesters`
--
ALTER TABLE `tbl_semesters`
  ADD PRIMARY KEY (`SEMESTER_ID`);

--
-- Indexes for table `tbl_semester_passmark`
--
ALTER TABLE `tbl_semester_passmark`
  ADD PRIMARY KEY (`SEMESTER_PASSMARK_ID`),
  ADD UNIQUE KEY `SEMESTER_ID` (`SEMESTER_ID`);

--
-- Indexes for table `tbl_semester_requirements`
--
ALTER TABLE `tbl_semester_requirements`
  ADD PRIMARY KEY (`SEMESTER_REQUIREMENT_ID`),
  ADD UNIQUE KEY `SEMESTER_ID` (`SEMESTER_ID`);

--
-- Indexes for table `tbl_semester_scores`
--
ALTER TABLE `tbl_semester_scores`
  ADD PRIMARY KEY (`SEMESTER_SCORE_ID`);

--
-- Indexes for table `tbl_semester_students`
--
ALTER TABLE `tbl_semester_students`
  ADD PRIMARY KEY (`SEMESTER_STUDENT_ID`),
  ADD KEY `SEMESTER_ID` (`SEMESTER_ID`,`PROGRAM_ID`),
  ADD KEY `SEMESTER_ID_2` (`SEMESTER_ID`,`PROGRAM_ID`),
  ADD KEY `RESIDENCE_ID` (`RESIDENCE_ID`);

--
-- Indexes for table `tbl_semester_weights`
--
ALTER TABLE `tbl_semester_weights`
  ADD PRIMARY KEY (`SEMESTER_WEIGHT_ID`),
  ADD KEY `SEMESTER_ID_2` (`LEVEL_ID`),
  ADD KEY `SEMESTER_ID` (`SEMESTER_ID`);

--
-- Indexes for table `tbl_titles`
--
ALTER TABLE `tbl_titles`
  ADD PRIMARY KEY (`titleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_assigned_roles`
--
ALTER TABLE `tbl_assigned_roles`
  MODIFY `ASSIGNED_ROLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_levels`
--
ALTER TABLE `tbl_levels`
  MODIFY `LEVEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `LOGIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_lookup`
--
ALTER TABLE `tbl_lookup`
  MODIFY `LOOKUP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_semesters`
--
ALTER TABLE `tbl_semesters`
  MODIFY `SEMESTER_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_semester_passmark`
--
ALTER TABLE `tbl_semester_passmark`
  MODIFY `SEMESTER_PASSMARK_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_semester_requirements`
--
ALTER TABLE `tbl_semester_requirements`
  MODIFY `SEMESTER_REQUIREMENT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_semester_scores`
--
ALTER TABLE `tbl_semester_scores`
  MODIFY `SEMESTER_SCORE_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_semester_students`
--
ALTER TABLE `tbl_semester_students`
  MODIFY `SEMESTER_STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_semester_weights`
--
ALTER TABLE `tbl_semester_weights`
  MODIFY `SEMESTER_WEIGHT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_titles`
--
ALTER TABLE `tbl_titles`
  MODIFY `titleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
