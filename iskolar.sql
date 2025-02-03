-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 12:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iskolar`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `aid` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `messageContent` longtext NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`aid`, `title`, `recipient`, `messageContent`, `dateCreated`, `status`, `photo`) VALUES
(58, 'Scholarship Registration', 'ALL', 'This is a message to inform everyone that they should update and pass their requirements for the 2nd Term of the year 2023-2024', '2024-10-22 05:00:56', 'active', 'unplogo.png'),
(86, 'Educational Assistance', 'ALL', 'Good day scholars! The SFAS will distribute educational assistance to active scholars @ UNP Student Center at 1pm. Bring your ID with you.', '2024-10-22 05:01:01', 'active', 'unplogo.png'),
(87, 'New Scholarship Applications Open', 'ALL', 'The UNP Student Center is now accepting applications for the upcoming academic year’s scholarship programs. Interested students are encouraged to submit their application forms before the deadline. Please visit the Student Center for more details  visit the Office.', '2024-10-22 05:01:04', 'active', 'unplogo.png'),
(88, 'Scholarship Orientation Session', 'ALL', 'A mandatory orientation session for new scholarship recipients will be held next week at the UNP Student Center. Attendance is required for all new scholars to understand the terms and conditions of the scholarship program. Please check the Student Center.', '2024-10-22 05:01:06', 'active', 'unplogo.png'),
(91, 'Scholarship Awarding Ceremony', 'ALL', 'The UNP Student Center invites all students to the upcoming Scholarship Awarding Ceremony. This event will celebrate the achievements of our scholars and recognize their hard work. The ceremony will take place next Friday at the Student Center Auditorium.', '2024-10-22 05:01:09', 'active', 'unplogo.png'),
(135, 'Submission of Requirements for Renewal of Scholarship Grant', 'CHED MEDICINE GRANT IN AID', 'Dear Scholars, the renewal process for your scholarship grant is now open. Please submit the following requirements: Certificate of Registration (COR) for the current semester, Certificate of Grades for the previous semester, and an Updated Contact Information Form. The submission period is from November 20 to December 10, 2024, through the iSkolar Online Portal. Ensure all files are in PDF format, clear, and complete. Incomplete submissions will not be processed. For questions, email unpiskolar@gmail.com. Submit on time to avoid disqualification!', '2024-11-26 17:09:33', 'active', 'unplogo.png'),
(143, 'Vigan City Scholars Issue', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'All Vigan City Scholarship Program Scholars MUST report to the SFAS located at 2nd Floor of Student Center building on January 15, 2025. Detail will be discussed on the site. Thank you!', '2025-01-11 13:58:39', 'active', 'unplogo.png'),
(144, 'Calling the Attention of Scholars', 'ALL', 'Scholars MUST report to the SFAS located at 2nd Floor of Student Center building until February 14, 2025. Details will be discussed on-site. Thank you!', '2025-01-11 14:00:54', 'active', 'unplogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `archivedinformation`
--

CREATE TABLE `archivedinformation` (
  `id` int(11) NOT NULL,
  `upId` int(11) NOT NULL,
  `idNum` varchar(30) NOT NULL,
  `scholarName` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(20) NOT NULL,
  `schoolYear` varchar(20) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `noOfSubjects` tinyint(4) NOT NULL,
  `noOfUnits` tinyint(4) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `userType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archivedinformation`
--

INSERT INTO `archivedinformation` (`id`, `upId`, `idNum`, `scholarName`, `college`, `course`, `year`, `schoolYear`, `sem`, `noOfSubjects`, `noOfUnits`, `grade`, `userType`) VALUES
(3, 69, '20-0001', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CBAA', 'BS IN BUSINESS ADMINISTRATION', '1ST YEAR', '2020-2021', '1ST SEMESTER', 8, 24, '2.00', 'iskolar'),
(4, 70, '21-04545', 'DOST SCHOLARSHIP PROGRAM', 'CN', 'BS IN NURSING', '3RD YEAR', '2021-2022', '1ST SEMESTER', 8, 24, '1.00', 'iskolar'),
(41, 57, '21-6969', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CTE', 'BACHELOR OF SECONDARY EDUCATION', '2ND YEAR', '2022-2023', '1ST SEMESTER', 5, 16, '5.00', 'dropped'),
(43, 69, '20-0001', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CBAA', 'BS IN BUSINESS ADMINISTRATION', '2RD YEAR', '2022-2023', '1ST SEMESTER', 5, 18, '2.00', 'iskolar'),
(44, 70, '21-04545', 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2020-2021', '2ND SEMESTER', 8, 24, '3.00', 'dropped'),
(68, 71, '19-23932', 'SANTA SCHOLARSHIP PROGRAM', 'CN', 'BS IN NURSING', '1ST YEAR', '2020-2021', '1ST SEMESTER', 9, 28, '1.00', 'iskolar'),
(81, 70, '21-04545', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2022-2023', '1ST SEMESTER', 6, 20, '1.00', 'archived'),
(83, 71, '19-23932', 'SANTA SCHOLARSHIP PROGRAM', 'CN', 'BS IN NURSING', '2ND YEAR', '2021-2022', '2ND SEMESTER', 9, 28, '1.00', 'iskolar'),
(91, 53, '20-14250', 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '3RD YEAR', '2022-2023', '1ST SEMESTER', 5, 5, '1.00', 'iskolar'),
(112, 60, '12', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 1, 1, '2.00', 'terminated'),
(113, 61, '1111', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 8, 24, '1.00', 'dropped'),
(114, 74, '19-0002', 'CHED MEDICINE GRANT IN AID', 'CN', 'BS IN NURSING', '1ST YEAR', '2023-2024', '1ST SEMESTER', 8, 24, '1.00', 'graduated'),
(119, 60, '12', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 1, 1, '2.00', 'terminated'),
(120, 61, '1111', 'CEAP', 'CARCH', 'BS IN INFORMATION TECHNOLOGY', '1ST YEAR', '2023-2024', '1ST SEMESTER', 8, 24, '1.00', 'dropped'),
(122, 60, '12', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 1, 1, '2.00', 'terminated'),
(123, 61, '1111', 'DOST SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 8, 24, '1.00', 'dropped'),
(125, 78, '1', 'CHED MEDICINE GRANT IN AID', 'CCIT', 'BS IN INFORMATION TECHNOLOGY', '4th Year', '2023-2024', '1ST Semester', 2, 6, '1', 'iskolar'),
(126, 53, '20-14250', 'CEAP', 'CARCH', 'BS IN ARCHITECTURE', '3RD YEAR', '2022-2023', '1ST SEMESTER', 5, 5, '1.00', 'iskolar'),
(127, 60, '12', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 1, 1, '2.00', 'terminated'),
(128, 61, '1111', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CARCH', 'BS IN ARCHITECTURE', '1ST YEAR', '2023-2024', '1ST SEMESTER', 8, 24, '1.00', 'dropped'),
(129, 74, '19-0002', 'CHED MEDICINE GRANT IN AID', 'CN', 'BS IN NURSING', '1ST YEAR', '2023-2024', '1ST SEMESTER', 8, 24, '1.00', 'graduated'),
(130, 75, '21-00259', 'DOST SCHOLARSHIP PROGRAM', 'CCIT', 'BS IN INFORMATION TECHNOLOGY', '4TH YEAR', '2023-2024', '1ST SEMESTER', 2, 6, '1.00', 'dropped'),
(131, 77, '20-03561', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CCIT', 'BS IN INFORMATION TECHNOLOGY', '4TH YEAR', '2023-2024', '1ST SEMESTER', 2, 6, '1.00', 'dropped'),
(132, 78, '1', 'VIGAN CITY SCHOLARSHIP PROGRAM', 'CCIT', 'BS IN INFORMATION TECHNOLOGY', '4th Year', '2023-2024', '1ST SEMESTER', 2, 6, '1', 'iskolar'),
(133, 79, '2', 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', 'CAS', 'BA IN COMMUNICATION', '4TH YEAR', '2024-2025', '1ST SEMESTER', 2, 6, '1.36', 'iskolar'),
(134, 82, '123', 'CHED MEDICINE GRANT IN AID', 'CCIT', 'BACHELOR OF LIBRARY AND INFORMATION SCIENCE', '4TH YEAR', '2023-2024', '2nd Semester', 2, 6, '1.78', 'iskolar'),
(135, 84, '21-56653', 'BEAUTEDERM INC.', 'CCIT', 'BS IN INFORMATION TECHNOLOGY', '4TH YEAR', '2024-2025', '2nd Semester', 1, 6, '1.76', 'dropped'),
(136, 85, '19-1111', 'BEAUTEDERM INC.', 'CCIT', 'BS IN INFORMATION TECHNOLOGY', '1ST YEAR', '2024-2025', '1st Semester', 8, 24, '89', 'iskolar');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `event_details` text DEFAULT NULL,
  `username` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `event_type`, `event_details`, `username`, `created_at`) VALUES
(1, 'User Update', 'Updated user type to iskolar for user with upId = 69', '21-03561', '2024-08-27 04:23:08'),
(2, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 53', '21-03561', '2024-08-27 04:33:37'),
(3, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 61', '21-03561', '2024-08-27 04:36:08'),
(4, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-08-27 04:36:39'),
(5, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 61', '21-03561', '2024-08-27 04:42:03'),
(6, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-08-27 04:42:46'),
(7, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 53', '21-03561', '2024-08-27 04:45:07'),
(8, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 61', '21-03561', '2024-08-27 04:45:48'),
(9, 'User Update', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-08-27 04:47:26'),
(10, 'User Status Update', 'User status updated to \'pending\' for user with upId = 53', '21-03561', '2024-08-27 04:52:21'),
(11, 'Create Announcement', 'Created announcement with title: Scholarship Registration', '21-03561', '2024-07-30 12:31:42'),
(12, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'id\' in \'field list\'', '21-03561', '2024-08-31 16:23:51'),
(13, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'id\' in \'field list\'', '21-03561', '2024-08-31 16:25:15'),
(14, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'id\' in \'field list\'', '21-03561', '2024-08-31 16:26:20'),
(15, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'id\' in \'field list\'', '21-03561', '2024-08-31 16:26:32'),
(16, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'id\' in \'field list\'', '21-03561', '2024-08-31 16:29:21'),
(17, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:30:15'),
(18, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:30:21'),
(19, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:30:25'),
(20, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:19'),
(21, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:24'),
(22, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:36'),
(23, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:54'),
(24, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:56'),
(25, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:56'),
(26, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:31:57'),
(27, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:36:31'),
(28, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.id\' in \'field list\'', '21-03561', '2024-08-31 16:38:12'),
(29, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:44:47'),
(30, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:44:47'),
(31, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:44:48'),
(32, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:45:08'),
(33, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:46:23'),
(34, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:46:52'),
(35, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:48:37'),
(36, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:49:30'),
(37, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:50:03'),
(38, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:50:07'),
(39, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Unknown column \'up.grades\' in \'field list\'', '21-03561', '2024-08-31 16:53:36'),
(40, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-08-31 16:54:39'),
(41, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-08-31 17:15:40'),
(42, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 70', '21-03561', '2024-08-31 17:29:22'),
(43, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-08-31 18:38:09'),
(44, 'Archive User Data Error', 'Failed to archive user data for iskolar users: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'up.schoolYear = \'\', \n                                up.noOfUnits = 0,\n    ...\' at line 5', '21-03561', '2024-08-31 20:11:30'),
(45, 'Archive User Data Error', 'Failed to archive user data for iskolar users: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'up.schoolYear = \'\', \r\n                                up.noOfUnits = 0,\r\n    ...\' at line 5', '21-03561', '2024-08-31 20:14:32'),
(46, 'Archive User Data Error', 'Failed to archive user data for iskolar users: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'up.schoolYear = \'\', \r\n                                up.noOfUnits = 0,\r\n    ...\' at line 5', '21-03561', '2024-08-31 20:14:33'),
(47, 'Archive User Data Error', 'Failed to archive user data for iskolar users: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'up.schoolYear = \'\', \r\n                                up.noOfUnits = 0,\r\n    ...\' at line 5', '21-03561', '2024-08-31 20:15:22'),
(48, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-08-31 20:22:04'),
(49, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-01 23:27:21'),
(50, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 53', '21-03561', '2024-09-02 00:09:58'),
(51, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-02 00:10:12'),
(52, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-02 00:10:19'),
(53, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-02 00:11:16'),
(54, 'User Status Update', 'User status updated to \'pending\' for user with upId = 53', '21-03561', '2024-09-02 00:11:20'),
(55, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-02 00:11:27'),
(56, 'Update User Status', 'Updated user status to \'dropped\' for upId: 53', '21-03561', '2024-09-02 00:11:49'),
(57, 'User Status Update', 'User status updated to \'pending\' for user with upId = 53', '21-03561', '2024-09-02 00:12:00'),
(58, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-02 00:12:03'),
(59, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-02 00:12:35'),
(60, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 53', '21-03561', '2024-09-02 00:12:40'),
(61, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-02 00:13:02'),
(62, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-02 00:13:49'),
(63, 'User Status Update', 'User status updated to \'pending\' for user with upId = 53', '21-03561', '2024-09-02 00:16:02'),
(64, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 53', '21-03561', '2024-09-02 00:16:08'),
(65, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-02 00:17:30'),
(66, 'Update User Status', 'Updated user status to \'dropped\' for upId: 69', '21-03561', '2024-09-02 00:17:39'),
(67, 'User Status Update', 'User status updated to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-02 00:22:53'),
(68, 'User Status Update', 'User status updated to \'iskolar\' for user with upId = 57', '21-03561', '2024-09-02 00:22:57'),
(69, 'User Status Update', 'User status updated to \'dropped\' for user with upId = 57', '21-03561', '2024-09-02 00:31:11'),
(70, 'User Status Update', 'User status updated to \'dropped\' for user with upId = 69', '21-03561', '2024-09-02 00:31:14'),
(71, 'User Registration', 'User account created successfully for username: 123', 'Unknown', '2024-09-02 05:04:39'),
(72, 'Update Scholarship Program', 'Scholarship program updated successfully', 'admin', '2024-09-08 08:59:18'),
(73, 'Update Scholarship Program', 'Scholarship program updated successfully', 'admin', '2024-09-08 09:01:15'),
(74, 'Update Scholarship Program', 'Scholarship program updated successfully', '21-03561', '2024-09-08 09:03:21'),
(75, 'Update Scholarship Program', 'Scholarship program updated successfully for user with upId = 69', '21-03561', '2024-09-08 09:07:16'),
(76, 'Update Scholarship Program', 'Scholarship program updated successfully for user with upId =69', '21-03561', '2024-09-08 09:09:47'),
(77, 'Create Announcement', 'Created announcement with title: Educational Assistance', '21-03561', '2024-09-09 04:09:25'),
(78, 'Create Announcement', 'Created announcement with title: New Scholarship Applications Open', '21-03561', '2024-09-09 04:11:23'),
(79, 'Create Announcement', 'Created announcement with title: Scholarship Orientation Session', '21-03561', '2024-09-09 04:19:39'),
(80, 'Create Announcement', 'Created announcement with title: Scholarship Orientation Session', '21-03561', '2024-09-09 04:19:47'),
(81, 'Create Announcement', 'Created announcement with title: Scholarship Orientation Session', '21-03561', '2024-09-09 04:24:48'),
(82, 'Delete Announcement', 'Deleted announcement with aid: 89', '21-03561', '2024-09-09 04:25:34'),
(83, 'Delete Announcement', 'Deleted announcement with aid: 90', '21-03561', '2024-09-09 04:25:39'),
(84, 'Create Announcement', 'Created announcement with title: Scholarship Awarding Ceremony', '21-03561', '2024-09-09 04:26:42'),
(85, 'Create Announcement', 'Created announcement with title: Scholarship Awarding Ceremony', '21-03561', '2024-09-09 04:27:19'),
(92, 'Delete Announcement', 'Deleted announcement with aid: 97', '21-03561', '2024-09-09 04:32:56'),
(93, 'Create Announcement', 'Created announcement with title: Title. Wokrking logs', '21-03561', '2024-09-09 04:35:03'),
(94, 'Delete Announcement', 'Deleted announcement with aid: 98', '21-03561', '2024-09-09 04:35:47'),
(95, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-09 04:36:22'),
(96, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-09 04:36:57'),
(97, 'Create Announcement', 'Created announcement with title: No uploaded file', '21-03561', '2024-09-09 16:26:38'),
(98, 'Create Announcement', 'Created announcement with title: It was uploaded', '21-03561', '2024-09-09 16:41:55'),
(99, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-10 01:57:13'),
(100, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-10 01:57:29'),
(101, 'User Status Update', 'User status updated to \'pending\' for user with upId = 69', '21-03561', '2024-09-13 04:34:24'),
(102, 'User Status Update', 'User status updated to \'pending\' for user with upId = 60', '21-03561', '2024-09-14 07:42:10'),
(103, 'Declined User', 'Updated user status to \'dropped\' for upId: 60', '21-03561', '2024-09-14 07:45:44'),
(104, 'User Status Update', 'User status updated to \'iskolar\' for user with upId = 60', '21-03561', '2024-09-14 07:46:00'),
(105, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-09-14 08:52:02'),
(106, 'Update Scholarship Program', 'Scholarship updated to VIGAN CITY SCHOLARSHIP PROGRAM for user with upId = 60. Reason: Change of Heart', '21-03561', '2024-09-15 04:17:51'),
(107, 'Add Scholarship', 'Added new scholarship program: ADDED NA BA?', '21-03561', '2024-09-16 11:09:42'),
(108, 'Add Scholarship', 'Added new scholarship program: THIS IS IT?', '21-03561', '2024-09-16 11:15:41'),
(109, 'Update Scholarship Status', 'Updated status to 1 for scholarship program with ID: 20', '21-03561', '2024-09-16 11:15:44'),
(110, 'User Status Update', 'User status updated to \'pending\' for user with upId = 75', '21-03561', '2024-10-01 14:30:18'),
(111, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 75', '21-03561', '2024-10-01 14:35:12'),
(112, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-10-01 14:44:45'),
(113, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-10-01 15:24:18'),
(114, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-10-01 15:24:35'),
(115, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-10-01 15:31:52'),
(116, 'User Status Update', 'User status updated to \'pending\' for user with upId = 76', '21-03561', '2024-10-01 16:27:14'),
(117, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 75', '21-03561', '2024-10-01 16:29:11'),
(118, 'User Status Update', 'User status updated to \'pending\' for user with upId = 76', '21-03561', '2024-10-01 16:29:49'),
(119, 'User Status Update', 'User status updated to \'pending\' for user with upId = 75', '21-03561', '2024-10-01 16:29:53'),
(120, 'User Status Update', 'User status updated to \'pending\' for user with upId = 76', '21-03561', '2024-10-01 16:38:32'),
(121, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 76', '21-03561', '2024-10-01 16:38:41'),
(122, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 71', '21-03561', '2024-10-01 16:41:57'),
(123, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 75', '21-03561', '2024-10-01 16:42:02'),
(124, 'User Status Update', 'User status updated to \'graduated\' for user with upId = 60', '21-03561', '2024-10-01 22:45:49'),
(125, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-10-01 23:26:42'),
(126, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 69', '21-03561', '2024-10-02 01:18:30'),
(127, 'Add Scholarship', 'Added new scholarship program: UNP SCHOLARSHIP PROGRAM', '21-03561', '2024-10-02 01:39:08'),
(128, 'Create Announcement', 'Created announcement with title: Test for All', '21-03561', '2024-10-22 05:04:12'),
(129, 'Create Announcement', 'Created announcement with title: Test for Specific', '21-03561', '2024-10-22 05:05:20'),
(130, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 16:33:07'),
(131, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:01:23'),
(132, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:01:36'),
(133, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:03:29'),
(134, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:03:40'),
(135, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:04:23'),
(136, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:04:31'),
(137, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:05:55'),
(138, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:06:06'),
(139, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:07:29'),
(140, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:07:38'),
(141, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:08:43'),
(142, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:08:51'),
(143, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:09:00'),
(144, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:13:00'),
(145, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:13:09'),
(146, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:14:44'),
(147, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:14:59'),
(148, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:17:45'),
(149, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:17:52'),
(150, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:18:46'),
(151, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:19:15'),
(152, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:19:25'),
(153, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:20:15'),
(154, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:21:42'),
(155, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:21:53'),
(156, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:22:30'),
(157, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:22:40'),
(158, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 77', '21-03561', '2024-10-27 17:28:33'),
(159, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2024-10-27 17:28:47'),
(160, 'Create Announcement', 'Created announcement with title: Testing for Email Notifications', '21-03561', '2024-11-07 06:56:11'),
(161, 'Create Announcement', 'Created announcement with title: Testing', '21-03561', '2024-11-07 07:03:36'),
(162, 'Create Announcement', 'Created announcement with title: testing', '21-03561', '2024-11-07 07:06:00'),
(163, 'Create Announcement', 'Created announcement with title: This is 100% WOrkig', '21-03561', '2024-11-07 07:08:45'),
(164, 'Create Announcement', 'Created announcement with title: Testing Spinner', '21-03561', '2024-11-07 07:14:12'),
(165, 'Create Announcement', 'Created announcement with title: Workin?', '21-03561', '2024-11-07 07:14:51'),
(166, 'Create Announcement', 'Created announcement with title: Testr', '21-03561', '2024-11-07 07:15:19'),
(167, 'Create Announcement', 'Created announcement with title: Testr', '21-03561', '2024-11-07 07:15:44'),
(168, 'Create Announcement', 'Created announcement with title: Test for all', '21-03561', '2024-11-07 07:21:25'),
(169, 'Create Announcement', 'Created announcement with title: Test For Spinner', '21-03561', '2024-11-07 07:25:47'),
(170, 'Create Announcement', 'Created announcement with title: Tetsing', '21-03561', '2024-11-07 07:30:21'),
(171, 'Create Announcement', 'Created announcement with title: Test', '21-03561', '2024-11-07 07:31:46'),
(172, 'Create Announcement', 'Created announcement with title: test', '21-03561', '2024-11-07 07:36:06'),
(173, 'Create Announcement', 'Created announcement with title: test', '21-03561', '2024-11-07 07:36:53'),
(174, 'Create Announcement', 'Created announcement with title: tet', '21-03561', '2024-11-07 07:37:58'),
(175, 'Create Announcement', 'Created announcement with title: Spinner Test', '21-03561', '2024-11-07 07:44:04'),
(176, 'Create Announcement', 'Created announcement with title: 52', '21-03561', '2024-11-07 07:45:56'),
(177, 'Create Announcement', 'Created announcement with title: Try', '21-03561', '2024-11-07 07:48:55'),
(178, 'Create Announcement', 'Created announcement with title: Try', '21-03561', '2024-11-07 07:49:40'),
(179, 'Create Announcement', 'Created announcement with title: Try', '21-03561', '2024-11-07 07:54:45'),
(180, 'Create Announcement', 'Created announcement with title: Try', '21-03561', '2024-11-07 07:55:40'),
(181, 'Create Announcement', 'Created announcement with title: try', '21-03561', '2024-11-07 07:58:04'),
(182, 'Create Announcement', 'Created announcement with title: Try', '21-03561', '2024-11-07 08:02:22'),
(183, 'Create Announcement', 'Created announcement with title: try', '21-03561', '2024-11-07 08:04:24'),
(184, 'Create Announcement', 'Created announcement with title: try', '21-03561', '2024-11-07 08:05:35'),
(185, 'Create Announcement', 'Created announcement with title: creata', '21-03561', '2024-11-07 08:12:35'),
(186, 'Create Announcement', 'Created announcement with title: try', 'Unknown', '2024-11-07 08:47:56'),
(187, 'Create Announcement', 'Created announcement with title: ctre', 'Unknown', '2024-11-07 08:51:32'),
(188, 'Create Announcement', 'Created announcement with title: Create', 'Unknown', '2024-11-07 08:53:28'),
(189, 'Create Announcement', 'Created announcement with title: Testing Announcement Spinner and Email Goood?', 'Unknown', '2024-11-07 08:56:10'),
(190, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-07 10:54:18'),
(191, 'User Status Update', 'User status updated to \'pending\' for user with upId = 78', '21-03561', '2024-11-07 11:34:31'),
(192, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-07 11:36:43'),
(193, 'User Status Update', 'User status updated to \'pending\' for user with upId = 78', '21-03561', '2024-11-07 11:46:55'),
(194, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-07 11:47:20'),
(195, 'User Status Update', 'User status updated to \'pending\' for user with upId = 78', '21-03561', '2024-11-07 11:48:28'),
(196, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-07 11:48:40'),
(197, 'User Status Update', 'User status updated to \'pending\' for user with upId = 78', '21-03561', '2024-11-07 12:06:36'),
(198, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-07 12:06:47'),
(199, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-09 21:39:13'),
(200, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-09 21:43:40'),
(201, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-09 21:43:53'),
(202, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-09 21:48:37'),
(203, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-09 21:49:31'),
(204, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-09 21:52:08'),
(205, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-09 21:53:46'),
(206, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-09 22:01:56'),
(207, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-09 22:02:04'),
(208, 'Create Announcement', 'Created announcement with title: This is announcement', 'Unknown', '2024-11-09 22:25:30'),
(209, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-09 22:26:48'),
(210, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-09 22:27:00'),
(211, 'Declined User', 'Updated user status to \'dropped\' for upId: 74', '21-03561', '2024-11-09 22:34:12'),
(212, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-16 03:27:36'),
(213, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-16 03:28:21'),
(214, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-16 03:35:46'),
(215, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-16 03:36:09'),
(216, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-16 03:45:16'),
(217, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-18 16:16:04'),
(218, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-18 16:18:19'),
(219, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-18 16:18:27'),
(220, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-18 16:19:49'),
(221, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-18 16:19:57'),
(222, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-18 16:20:37'),
(223, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-18 16:20:50'),
(224, 'Create Announcement', 'Created announcement with title: Submission of Requirements for Renewal of Scholarship Grant', 'Unknown', '2024-11-18 16:35:50'),
(225, 'Create Announcement', 'Created announcement with title: Submission of Requirements for Renewal of Scholarship Grant', 'Unknown', '2024-11-18 16:40:52'),
(226, 'User Status Update', 'User status updated to \'graduated\' for user with upId = 74', '21-03561', '2024-11-22 01:26:14'),
(227, 'User Status Update', 'User status updated to \'pending\' for user with upId = 79', '21-03561', '2024-11-25 04:59:13'),
(228, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2024-11-25 04:59:26'),
(229, 'Create Announcement', 'Created announcement with title: Educational Assistance', 'Unknown', '2024-11-25 05:00:28'),
(230, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 81', '21-03561', '2024-11-26 16:10:24'),
(231, 'User Status Update', 'User status updated to \'dropped\' for user with upId = 57', '21-03561', '2024-11-26 16:42:27'),
(232, 'User Status Update', 'User status updated to \'admin\' for user with upId = 57', '21-03561', '2024-11-26 16:42:52'),
(233, 'User Status Update', 'User status updated to \'admin\' for user with upId = 60', '21-03561', '2024-11-26 16:42:58'),
(234, 'User Status Update', 'User status updated to \'terminated\' for user with upId = 57', '21-03561', '2024-11-26 16:43:03'),
(235, 'User Status Update', 'User status updated to \'terminated\' for user with upId = 60', '21-03561', '2024-11-26 16:43:05'),
(236, 'Create Announcement', 'Created announcement with title: Scholarship Renewal', 'Unknown', '2024-11-26 16:54:32'),
(237, 'Delete Announcement', 'Deleted announcement with aid: 135', '21-03561', '2024-11-26 17:09:20'),
(238, 'Create Announcement', 'Created announcement with title: Testing', 'Unknown', '2024-11-26 17:33:20'),
(239, 'Create Announcement', 'Created announcement with title: Tsting', 'Unknown', '2024-11-26 17:36:39'),
(240, 'Create Announcement', 'Created announcement with title: Test', 'Unknown', '2024-11-26 17:41:03'),
(241, 'Create Announcement', 'Created announcement with title: Test', 'Unknown', '2024-11-26 17:56:37'),
(242, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:50:05'),
(243, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:51:29'),
(244, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:51:38'),
(245, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:51:47'),
(246, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:51:54'),
(247, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:51:55'),
(248, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:55:38'),
(249, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:55:46'),
(250, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:56:32'),
(251, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:57:08'),
(252, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:57:11'),
(253, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:57:24'),
(254, 'Archive User Data Error', 'Failed to archive user data for iskolar users: Column count doesn\'t match value count at row 1', '21-03561', '2024-11-26 19:57:29'),
(255, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-11-26 20:06:00'),
(256, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-11-26 20:25:02'),
(257, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-26 20:29:27'),
(258, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2024-11-26 20:33:53'),
(259, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 78', '21-03561', '2024-11-26 20:35:35'),
(260, 'Create Announcement', 'Created announcement with title: tESTOMG', 'Unknown', '2024-11-26 20:43:29'),
(261, 'Delete Announcement', 'Deleted announcement with aid: 142', '21-03561', '2024-12-02 21:29:22'),
(262, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 82', '21-03561', '2024-12-02 21:36:22'),
(263, 'Declined User', 'Updated user status to \'dropped\' for upId: 77', '21-03561', '2025-01-09 14:37:47'),
(264, 'User Status Update', 'User status updated to \'pending\' for user with upId = 77', '21-03561', '2025-01-09 14:40:23'),
(265, 'Declined User', 'Updated user status to \'dropped\' for upId: 77. Reason: Trip ko lang', '21-03561', '2025-01-09 14:41:44'),
(266, 'Update Scholarship Status', 'Updated status to 1 for scholarship program with ID: 21', '21-03561', '2025-01-10 07:11:16'),
(267, 'Add Scholarship', 'Added new scholarship program: UNP EMPLOYEE STUDY PRIVILEGE', '21-03561', '2025-01-10 07:13:38'),
(268, 'Add Scholarship', 'Added new scholarship program: ATHLETIC SCHOLAR', '21-03561', '2025-01-10 07:14:06'),
(269, 'Add Scholarship', 'Added new scholarship program: ADOPT-A-SCHOOL/COMMUNITY PROGRAM', '21-03561', '2025-01-10 07:14:23'),
(270, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 79', '21-03561', '2025-01-11 12:59:15'),
(271, 'Declined User', 'Updated user status to \'dropped\' for upId: 84. Reason: Low Grade, Incomplete File, INC Grade', '21-03561', '2025-01-11 13:23:09'),
(272, 'Update Scholarship Program', 'Scholarship updated to MAGSINGAL SCHOLARSHIP FOUNDATION(HAWAII/CALIFORNIA) for user with upId = 82. Reason: Lower maintaining grade.', '21-03561', '2025-01-11 13:53:46'),
(273, 'Create Announcement', 'Created announcement with title: Vigan City Scholars Issue', 'Unknown', '2025-01-11 13:58:39'),
(274, 'Create Announcement', 'Created announcement with title: Calling the Attention of Scholars', 'Unknown', '2025-01-11 14:00:54'),
(275, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 85', '21-03561', '2025-01-17 03:06:20'),
(276, 'Declined User', 'Updated user status to \'dropped\' for upId: 75. Reason: Trip ko lang', '21-03561', '2025-01-17 03:10:21'),
(277, 'Archive User Data', 'Archived user data for iskolar users', '21-03561', '2025-01-17 03:13:16'),
(278, 'Update Scholarship Program', 'Scholarship updated to ILOCOS SUR EDUCATIONAL ASSISTANCE  for user with upId = 85. Reason: Higher Allowance', '21-03561', '2025-01-17 03:27:16'),
(279, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 85', '21-03561', '2025-01-17 03:30:20'),
(280, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 81', '21-03561', '2025-01-17 03:31:21'),
(281, 'Hold User Application', 'Updated user status to \'hold\' for upId: 75. Reason: Testking', '21-03561', '2025-01-17 07:18:10'),
(282, 'Hold User Application', 'Updated user status to \'hold\' for upId: 77. Reason: Testing, Testinkh', '21-03561', '2025-01-17 08:35:15'),
(283, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: Testing', '21-03561', '2025-01-19 15:33:59'),
(284, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 15:48:50'),
(285, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: testing', '21-03561', '2025-01-19 15:49:18'),
(286, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 15:52:16'),
(287, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: testing', '21-03561', '2025-01-19 15:52:33'),
(288, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 15:53:42'),
(289, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: hold', '21-03561', '2025-01-19 15:54:00'),
(290, 'Accept User', 'Updated user type to \'iskolar\' for user with upId = 86', '21-03561', '2025-01-19 16:01:26'),
(291, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 16:06:18'),
(292, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: teest', '21-03561', '2025-01-19 16:06:45'),
(293, 'Declined User', 'Updated user status to \'dropped\' for upId: 86. Reason: Testing', '21-03561', '2025-01-19 16:10:17'),
(294, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: test', '21-03561', '2025-01-19 16:30:19'),
(295, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 16:33:37'),
(296, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: test', '21-03561', '2025-01-19 16:33:57'),
(297, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 18:30:38'),
(298, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: Missing Information: Civil Status', '21-03561', '2025-01-19 18:31:25'),
(299, 'User Status Update', 'User status updated to \'pending\' for user with upId = 86', '21-03561', '2025-01-19 19:19:36'),
(300, 'Hold User Application', 'Updated user status to \'hold\' for upId: 86. Reason: hold', '21-03561', '2025-01-19 19:20:11'),
(301, 'Hold User Application', 'Updated user status to \'hold\' for upId: 78. Reason: holding testing', '21-03561', '2025-01-19 21:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`) VALUES
(1, '21-03561', 'A new scholar (19-23932) has registered.', 1, '2024-09-16 02:26:18'),
(8, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 08:31:58'),
(9, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 08:37:20'),
(10, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:02:20'),
(11, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:04:15'),
(12, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:06:11'),
(13, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:09:06'),
(14, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:11:47'),
(15, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:13:36'),
(16, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:20:16'),
(17, '21-03561', 'A scholar, (21-0001) has updated their academic information.', 1, '2024-09-16 09:22:01'),
(18, '21-03561', 'A scholar, (20-0001) has updated their academic information.', 1, '2024-09-16 09:26:27'),
(19, '21-03561', 'A scholar, (20-0001) has updated their academic information.', 1, '2024-09-16 09:28:59'),
(20, '21-03561', 'A scholar, (20-0001) has updated their academic information.', 1, '2024-09-16 09:30:35'),
(21, '21-03561', 'A new scholar (19-0002) has registered.', 1, '2024-09-16 09:52:27'),
(22, '21-03561', 'A scholar, (19-0002) has updated their academic information.', 1, '2024-09-17 04:05:50'),
(23, '21-03561', 'A new scholar (21-00259) has registered.', 1, '2024-10-01 13:45:03'),
(24, '21-03561', 'A new scholar (21-78945) has registered.', 1, '2024-10-01 16:00:05'),
(25, '21-03561', 'A new scholar (21-78945) has registered.', 1, '2024-10-01 16:06:17'),
(26, '21-03561', 'A new scholar (21-78945) has registered.', 1, '2024-10-01 16:07:19'),
(27, '21-03561', 'A scholar, (21-00259) has updated their academic information.', 1, '2024-10-01 16:16:01'),
(28, '21-03561', 'A scholar, (21-78945) has updated their academic information.', 1, '2024-10-01 16:23:49'),
(29, '21-03561', 'A scholar, (21-78945) has updated their academic information.', 1, '2024-10-01 16:24:17'),
(30, '21-03561', 'A new scholar (20-03561) has registered.', 1, '2024-10-22 03:53:51'),
(31, '21-03561', 'A new scholar (1) has registered.', 1, '2024-11-07 10:40:17'),
(32, '21-03561', 'A new scholar (2) has registered.', 1, '2024-11-09 06:03:05'),
(33, '21-03561', 'A new scholar (21-03735) has registered.', 1, '2024-11-26 16:09:45'),
(34, '21-03561', 'A scholar, (1) has updated their academic information.', 1, '2024-11-26 20:28:20'),
(35, '21-03561', 'A scholar, (1) has updated their academic information.', 1, '2024-11-26 20:35:01'),
(36, '21-03561', 'A new scholar (123) has registered.', 1, '2024-12-02 21:28:26'),
(37, '21-03561', 'A new scholar (21-56653) has registered.', 1, '2025-01-11 13:22:19'),
(38, '21-03561', 'A new scholar (19-1111) has registered.', 1, '2025-01-17 03:01:39'),
(39, '21-03561', 'A scholar, (19-1111) has updated their academic information.', 1, '2025-01-17 03:24:48'),
(40, '21-03561', 'A new scholar (123332) has registered.', 1, '2025-01-19 15:32:34'),
(41, '21-03561', 'A scholar, () has updated their academic information.', 1, '2025-01-19 19:16:24'),
(42, '21-03561', 'A scholar, (123122) has updated their academic information.', 1, '2025-01-19 19:17:33'),
(43, '21-03561', 'A scholar, (123122) has updated their academic information.', 1, '2025-01-19 19:25:16'),
(44, '21-03561', 'A scholar, (123122) has updated their academic information.', 1, '2025-01-19 19:26:59'),
(45, '21-03561', 'A scholar, (123122) has updated their academic information.', 1, '2025-01-19 19:27:48'),
(46, '21-03561', 'A scholar, (123122) has updated their academic information.', 1, '2025-01-19 19:29:31'),
(47, '21-03561', 'A scholar, (123122) has updated their academic information.', 1, '2025-01-19 19:31:44'),
(48, '21-03561', 'A scholar, () has updated their academic information.', 1, '2025-01-19 21:18:38'),
(49, '21-03561', 'A scholar, (1) has updated their academic information.', 1, '2025-01-19 21:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(11) NOT NULL,
  `scholarName` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `scholarName`, `status`) VALUES
(1, 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', 0),
(2, 'VIGAN CITY SCHOLARSHIP PROGRAM', 0),
(3, 'SANTA SCHOLARSHIP PROGRAM', 0),
(4, 'CHED-FULL MERIT', 0),
(5, 'CHED-TULONG-DUNONG', 0),
(6, 'CEAP', 0),
(7, 'CHED MEDICINE GRANT IN AID', 0),
(8, 'DOST SCHOLARSHIP PROGRAM', 0),
(9, 'DOH SCHOLARSHIP', 0),
(10, 'CHED HALF-MERIT', 0),
(11, 'MUNICIPAL SCHOLARSHIP PROGRAM', 0),
(12, 'MAGSINGAL SCHOLARSHIP FOUNDATION(HAWAII/CALIFORNIA)', 0),
(13, 'LUIS CO CHI KIAT FOUNDATION', 0),
(14, 'JSLA', 0),
(15, 'BEAUTEDERM INC.', 0),
(16, 'LUIS CHAVIT SINGSON SCHOLARSHIP PROGRAM', 0),
(22, 'UNP EMPLOYEE STUDY PRIVILEGE', 0),
(23, 'ATHLETIC SCHOLAR', 0),
(24, 'ADOPT-A-SCHOOL/COMMUNITY PROGRAM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `upId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `upId`, `username`, `email`, `password`, `userType`, `photo_path`, `position`) VALUES
(9, 37, '21-03561', 'unpiskolar@gmail.com', '$2y$10$cvQMaqMXRED0sF10al8PPeV8GRzPHVePEEjpGkiQdhH5YZZnxRWNu', 'admin', 'uploads/avatars/21-03561.jpg', 'Head'),
(12, 53, '20-14250', 'zcatandijan12@gmail.com', '$2y$10$kUIc71UAIYEbJzmptOZ5BupCb/aAhU/N7NzYgvJYnEKsb0LkDDRou', 'archived', 'uploads/avatars/default_avatar.jpg', 'student'),
(37, 60, '12', 'wisecej157@reebsd.com', '$2y$10$mKlHj0CY5PlDXHFaNCN37.t.40INpKGn9Kw05pKJDb97f6uPt1dcO', 'terminated', 'uploads/avatars/12.jpg', 'FACULTY'),
(44, 61, '1111', 'fewici8798@alientex.com', '$2y$10$Rs7Zj66zmneJu8zB5xX6weLRyDvuqsrQDAyySMMTW2Rp59QvrwZ4a', 'dropped', 'uploads/avatars/1111.jpg', 'student'),
(47, 69, '20-0001', 'vasow64632@segichen.com', '$2y$10$79fmILcMrn2G4ZDaKCDmAu4vAGk5FYiIzVing4dMqO7a8wNhfDasq', 'pending', 'uploads/avatars/default_avatar.jpg', 'student'),
(48, 70, '21-04545', 'wenoba4677@ndiety.com', '$2y$10$He7bLcx4KITryoGKXrHOL.YZQ5/znie/oRSbV1M449Q1TfBPiT9u6', 'pending', 'uploads/avatars/default_avatar.jpg', 'student'),
(53, 71, '19-23932', 'sekoha4320@nastyx.com', '$2y$10$r7AgajMHkVM47lDhRfRfSOsisW.x6Rlee8Ol9Snp/RMX/D9Ol/f7C', 'pending', 'uploads/avatars/default_avatar.jpg', 'student'),
(54, 74, '19-0002', 'yikidov601@asaud.com', '$2y$10$vGbvHBpzP.0GkQPpqRFSc.uDfVIa9mbejbLLte5VSaVtMUSd58Mjm', 'graduated', 'uploads/avatars/default_avatar.jpg', 'student'),
(55, 75, '21-00259', 'cjgrojas.ccit@unp.edu.ph', '$2y$10$2oALUlWulE/JQAUlY7wEjOWWm0g6yaoE5/GFRj7TxWKdkYjaVcSrS', 'hold', 'uploads/avatars/default_avatar.jpg', 'student'),
(59, 77, '20-03561', 'zafcatandijan.ccit@unp.edu.ph', '$2y$10$h8Au2W/JPC6u35M9y8R6quDKdhVzkwCK4cvCeuc6Tmf09JV6aZUjS', 'hold', 'uploads/avatars/default_avatar.jpg', 'student'),
(60, 78, '1', 'zcatandijan01@gmail.com', '$2y$10$MqjU0i2SzEmGuxBXf0goEOCCOMeE0nJOnBENqI7MVPCc3BAY2vIKm', 'hold', 'uploads/avatars/default_avatar.jpg', 'student'),
(61, 79, '2', 'masow87002@inikale.com', '$2y$10$kUIc71UAIYEbJzmptOZ5BupCb/aAhU/N7NzYgvJYnEKsb0LkDDRou', 'archived', 'uploads/avatars/default_avatar.jpg', 'student'),
(62, 81, '21-03735', 'mayiv57319@gitated.com', '$2y$10$pBdxRwvJALJHW.MnMF.rkOiiJHR0b3F6eiXDYqVYnT.Izs4AYTSSy', 'iskolar', 'uploads/avatars/default_avatar.jpg', 'student'),
(63, 82, '123', 'haceret276@confmin.com', '$2y$10$4TGW8Zgo.2qv5ZTrw3UxQ.XMCINI5Q6nYuuMpJUEuAiglJ0kOR6.S', 'archived', 'uploads/avatars/123.jpg', 'student'),
(64, 84, '21-56653', 'sepeje6176@suggets.com', '$2y$10$xp6co5YeuHM/IsLl.IXllekfT31QviTZzH.mCDvOFVD2gunyxud5G', 'dropped', 'uploads/avatars/default_avatar.jpg', 'student'),
(65, 85, '19-1111', 'xejoya4078@maonyn.com', '$2y$10$.UgRTM.Ym.Wx7HEfvM5cb.L0csYTHo2EFTmiP3/e7K9i7x/vsQ7Ti', 'iskolar', 'uploads/avatars/default_avatar.jpg', 'student'),
(66, 86, '123332', 'wovof46900@citdaca.com', '$2y$10$Z24d9YO3jwTGBpaFzWBST.llkGqaZDX21F9uabZblOd4dMU3cIMGu', 'hold', 'uploads/avatars/default_avatar.jpg', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `upId` int(11) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `idNum` varchar(30) NOT NULL,
  `scholarName` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `schoolYear` varchar(20) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `major` varchar(100) NOT NULL,
  `noOfUnits` tinyint(4) NOT NULL,
  `noOfSubjects` tinyint(4) NOT NULL,
  `grade` varchar(4) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `suffix` varchar(10) DEFAULT '',
  `email` varchar(255) NOT NULL,
  `contactNumber` varchar(20) NOT NULL,
  `telNumber` varchar(11) NOT NULL,
  `dob` date NOT NULL,
  `age` tinyint(11) NOT NULL,
  `civilStatus` enum('SINGLE','MARRIED','DIVORCED','WIDOWED') NOT NULL,
  `childrenCount` int(11) NOT NULL,
  `cmi` varchar(255) NOT NULL,
  `sex` enum('MALE','FEMALE') NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`upId`, `verify_token`, `idNum`, `scholarName`, `year`, `schoolYear`, `sem`, `course`, `college`, `major`, `noOfUnits`, `noOfSubjects`, `grade`, `lastname`, `middlename`, `firstname`, `suffix`, `email`, `contactNumber`, `telNumber`, `dob`, `age`, `civilStatus`, `childrenCount`, `cmi`, `sex`, `gender`, `dateCreated`, `dateUpdated`, `region`, `province`, `city`, `barangay`) VALUES
(37, '4f6f78570ce0b5b7eedf1462f010d5e7', '21-03561', 'VIGAN CITY SCHOLARSHIP PROGRAM', '3RD YEAR', '2019-2020', '1ST SEMESTER', 'BS IN INFORMATION TECHNOLOGY', 'CCIT', '', 4, 4, '1.00', 'CATANDIJAN', 'ASHLEY', 'ZYNHEL ', '', 'unpiskolar@gmail.com', '+639924481326', '0', '2002-12-01', 21, 'SINGLE', 3, '', 'MALE', 'GAY', '2024-08-20 14:35:26', '2025-01-26 17:16:14', '01', '0129', '012934', 'PUROK-A-BASSIT'),
(53, '9654de2d8235cb2d370e8e048faeb66b', '20-14250', 'CEAP', '', '', '', 'BS IN ARCHITECTURE', 'CARCH', '', 0, 0, '0', 'PINZON', 'CABRALES', 'JOSE', 'IV', 'zcatandijan12@gmail.com', '+639676475003', '0', '2002-12-01', 21, 'SINGLE', 3, '', 'MALE', 'GAY', '2024-06-23 09:34:00', '2025-01-17 03:12:38', '01', '0128', '012802', 'BUYON'),
(60, '496e15fa2f86650e3f0c64bd858d0d34', '12', 'VIGAN CITY SCHOLARSHIP PROGRAM', '1ST YEAR', '2023-2024', '1ST SEMESTER', 'BS IN ARCHITECTURE', 'CARCH', '', 1, 1, '2.00', '3', '2', '1', '4', 'wisecej157@reebsd.com', '+639676475003', '0', '2002-12-01', 21, 'SINGLE', 1, '', 'MALE', 'MALE', '2024-07-22 01:49:30', '2024-11-26 18:23:38', '01', '0128', '012801', 'ADAMS (POB.)'),
(61, 'b95c4964ebfac21915b61e9ca74275a5', '1111', 'VIGAN CITY SCHOLARSHIP PROGRAM', '1ST YEAR', '2023-2024', '1ST SEMESTER', 'BS IN ARCHITECTURE', 'CARCH', '', 24, 8, '1.00', 'CABLUKAS', 'PRECKNO', 'JOHN DAVID', '', 'fewici8798@alientex.com', '+639676475003', '0', '2002-12-01', 21, 'SINGLE', 1, '', 'MALE', 'GAY', '2024-08-31 19:11:16', '2024-11-26 16:12:39', '01', '0129', '012934', 'CAMANGAAN'),
(69, '5a6ff761502c74af5ecb8958459e98e9', '20-0001', 'VIGAN CITY SCHOLARSHIP PROGRAM', '4TH YEAR', '2023-2024', '1ST SEMESTER', 'BS IN BUSINESS ADMINISTRATION', 'CBAA', 'FINANCIAL MANAGEMENT', 8, 2, '1.00', 'AXIS', 'DANIELLE', 'JOHN', 'III', 'vasow64632@segichen.com', '+639676475003', '0', '2002-12-01', 21, 'SINGLE', 1, '', 'MALE', 'GAY', '2024-08-31 19:11:18', '2024-11-26 16:12:36', '01', '0129', '012906', 'ALLANGIGAN SEGUNDO'),
(70, 'b35bf0696abf690ea777dda52e8a4d8a', '21-04545', 'VIGAN CITY SCHOLARSHIP PROGRAM', '1ST YEAR', '2022-2023', '1ST SEMESTER', 'BS IN ARCHITECTURE', 'CARCH', '', 20, 6, '1.00', 'CATANDIJAN', 'NHELSY', 'ZYREL', '', 'wenoba4677@ndiety.com', '+639676475003', '0', '2002-12-01', 21, 'SINGLE', 1, '', 'MALE', 'MALE', '2024-08-31 19:11:21', '2024-11-26 16:12:34', '01', '0129', '012903', 'MALINGEB'),
(71, '1ab868572c57089c2bc6d497f7377f9e', '19-23932', 'CHED MEDICINE GRANT IN AID', '1ST YEAR', '2020-2021', '1ST SEMESTER', 'BS IN NURSING', 'CN', '', 28, 9, '1.00', 'PALACPAC', 'QUANIS', 'CAMILLE', '', 'sekoha4320@nastyx.com', '+639924481326', '0', '1999-03-25', 25, 'SINGLE', 2, '', 'FEMALE', 'FEMALE', '2024-09-16 02:12:22', '2024-11-26 17:58:32', '01', '0129', '012918', 'CABAROAN'),
(74, '05ea1493cc3b07503fffcbae68f90c43', '19-0002', 'CHED MEDICINE GRANT IN AID', '1ST YEAR', '2023-2024', '1ST SEMESTER', 'BS IN NURSING', 'CN', '', 24, 8, '1.00', 'DEL CASTILLO', 'MAGNO', 'CHARLIE', '', 'yikidov601@asaud.com', '+639676475003', '0', '1998-07-24', 26, 'SINGLE', 2, '', 'MALE', 'MALE', '2024-09-16 09:49:05', '2024-11-18 16:33:06', '01', '0128', '012816', 'PARATONG'),
(75, '32f4b53884007dd765f0353b1da12df8', '21-00259', 'DOST SCHOLARSHIP PROGRAM', '4TH YEAR', '2023-2024', '1ST SEMESTER', 'BS IN INFORMATION TECHNOLOGY', 'CCIT', '', 6, 2, '1.00', 'ROJAS', 'GASPAR', 'CHARLIE JAKE', '', 'cjgrojas.ccit@unp.edu.ph', '+639676475003', '0', '2002-11-17', 21, 'SINGLE', 1, '', 'MALE', 'MALE', '2024-10-01 13:39:04', '2024-11-26 16:16:43', '01', '0129', '012905', 'CUANCABAL'),
(77, 'e31adc78c86b405032e844ca4919b07c', '20-03561', 'VIGAN CITY SCHOLARSHIP PROGRAM', '4TH YEAR', '2023-2024', '1ST SEMESTER', 'BS IN INFORMATION TECHNOLOGY', 'CCIT', '', 6, 2, '1.00', 'CATANDIJAN', 'FELISCO', 'ZYNHEL ASHLEY', '', 'zafcatandijan.ccit@unp.edu.ph', '+639676475003', '0', '2002-12-01', 21, 'SINGLE', 3, '', 'MALE', 'MALE', '2024-10-02 01:11:41', '2024-11-26 16:16:47', '01', '0129', '012934', 'PUROK-A-BASSIT'),
(78, '81727c2a93a4a1ddc957eb5bbb21fb33', '1', 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', '4TH YEAR', '2024-2025', '2ND SEMESTER', 'BA IN POLITICAL SCIENCE', 'CAS', '', 1, 1, '1', 'MACHINE', 'COPY', 'XEROX', 'III', 'zcatandijan01@gmail.com', '+639676475003', 'n/a', '2002-01-01', 23, 'SINGLE', 1, '0', 'MALE', 'MASCULINE', '2024-11-07 10:27:47', '2025-01-19 22:56:07', '01', '0128', '012809', 'MADAMBA (POB.)'),
(79, '16da2a52813e85101cceb7b3fa29eb76', '2', 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', '', '', '', 'BA IN COMMUNICATION', 'CAS', '', 0, 0, '0', 'RIZAL', 'ANGONO', 'STRAWBERRY', '', 'masow87002@inikale.com', '+639676475003', '422163163', '2002-03-24', 22, 'SINGLE', 2, '', 'FEMALE', 'FEMALE', '2024-11-09 06:02:04', '2025-01-17 03:12:38', '02', '0231', '023105', 'BACNOR EAST'),
(81, '0b4051f46aa69afaff14ac3cf892a94b', '21-03735', 'ILOCOS SUR EDUCATIONAL ASSISTANCE & SCHOLARSHIP PROGRAM', '4TH YEAR', '2024-2025', '1ST SEMESTER', 'BS IN BUSINESS ADMINISTRATION', 'CBAA', 'FINANCIAL MANAGEMENT', 6, 1, '1.75', 'PAA', 'PALACPAC', 'JANELA', '', 'mayiv57319@gitated.com', '+639057692368', '', '2003-04-12', 21, 'SINGLE', 2, '', 'FEMALE', 'FEMALE', '2024-11-26 16:08:58', '2024-11-26 20:39:29', '01', '0129', '012934', 'NAGSANGALAN'),
(82, 'f71f0c2bbaa56ed63d38efed147e83ac', '123', 'MAGSINGAL SCHOLARSHIP FOUNDATION(HAWAII/CALIFORNIA)', '', '', '', 'BACHELOR OF LIBRARY AND INFORMATION SCIENCE', 'CCIT', '', 0, 0, '0', 'DOE', 'PAUL', 'JOHN', '', 'haceret276@confmin.com', '+639676475003', '', '2003-02-04', 21, 'SINGLE', 2, 'BELOW 5,000', 'MALE', 'MALE', '2024-12-02 21:24:28', '2025-01-17 03:12:38', '01', '0129', '012902', 'BISANGOL'),
(83, 'fd59dc44b314c552c4bca127562bc069', '21-11245', 'LUIS CHAVIT SINGSON SCHOLARSHIP PROGRAM', '4TH YEAR', '2024-2025', '2nd Semester', 'BS IN INFORMATION TECHNOLOGY', 'CCIT', '', 6, 1, '1.56', 'QUITORIANO', 'SOBERANO', 'AMANCIO', 'III', 'asquitoriano.ccit@unp.edu.ph', '+639977733988', '', '2002-11-27', 22, 'SINGLE', 2, '15,001 - 20,000', 'MALE', 'MALE', '2025-01-11 12:37:52', '2025-01-11 12:37:52', '01', '0129', '012934', 'CAMANGAAN'),
(84, 'd84f37e028fe3ac1847b1609bcefac76', '21-56653', 'BEAUTEDERM INC.', '4TH YEAR', '2024-2025', '2nd Semester', 'BS IN INFORMATION TECHNOLOGY', 'CCIT', '', 6, 1, '1.76', 'SOLIVEN', 'TABIL', 'DENVER', '', 'sepeje6176@suggets.com', '+639652966557', '', '2002-12-05', 22, 'SINGLE', 2, '10,001 - 15,000', 'MALE', 'MALE', '2025-01-11 13:21:56', '2025-01-11 13:21:56', '01', '0129', '012934', 'BULALA'),
(85, '40c9ddb30a8bcd3a6e3c578d4bbf4bb5', '19-1111', 'ILOCOS SUR EDUCATIONAL ASSISTANCE ', '1st Year', '2024-2025', '2nd Semester', 'BACHELOR OF LIBRARY AND INFORMATION SCIENCE', 'CCIT', '', 30, 10, '1', 'BRAVO', 'BAYOLET', 'JOHNNY', '', 'xejoya4078@maonyn.com', '+639676475003', '', '2005-11-24', 19, 'SINGLE', 10, '5,001 - 10,000', 'MALE', 'PREFER NOT TO SAY', '2025-01-17 03:00:15', '2025-01-17 03:27:16', '05', '0520', '052004', 'BULALACAO'),
(86, 'c13eb48eeb18cf47e1863e6d7cade165', '123332', 'JSLA', '4TH YEAR', '2023-2024', '2nd Semester', 'BS IN INFORMATION TECHNOLOGY', 'CCIT', '', 4, 4, '1.69', 'CATANDIJAN', 'A', 'ZYNHEL', '', 'wovof46900@citdaca.com', '+639676475003', '', '2002-12-01', 22, '', 2, 'BELOW 5,000', 'MALE', 'MASCULINE', '2025-01-19 15:30:08', '2025-01-19 15:30:08', '01', '0128', '012803', 'MABUSAG SUR');

-- --------------------------------------------------------

--
-- Table structure for table `user_files`
--

CREATE TABLE `user_files` (
  `file_id` int(11) NOT NULL,
  `upId` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` varchar(50) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_files`
--

INSERT INTO `user_files` (`file_id`, `upId`, `file_name`, `file_path`, `file_type`, `file_size`, `upload_date`) VALUES
(25, 53, '2102391023_COS.pdf', 'uploads/2102391023\\2102391023_COS.pdf', 'application/pdf', '331148', '2024-07-05 01:41:48'),
(26, 53, '2102391023_Grades.pdf', 'uploads/2102391023\\2102391023_Grades.pdf', 'application/pdf', '331148', '2024-07-05 01:41:48'),
(27, 53, '2102391023_UNPCAT.pdf', 'uploads/2102391023\\2102391023_UNPCAT.pdf', 'application/pdf', '331148', '2024-07-05 01:41:48'),
(28, 53, '2102391023_GoodMoral.pdf', 'uploads/2102391023\\2102391023_GoodMoral.pdf', 'application/pdf', '331148', '2024-07-05 01:41:48'),
(29, 53, '2102391023_COR.pdf', 'uploads/2102391023\\2102391023_COR.pdf', 'application/pdf', '331148', '2024-07-05 01:41:48'),
(30, 59, 'TRIALANG_COS_2024.pdf', 'uploads/TRIALANG\\TRIALANG_COS_2024.pdf', 'application/pdf', '331148', '2024-07-21 23:58:23'),
(31, 59, 'TRIALANG_Grades_2024.pdf', 'uploads/TRIALANG\\TRIALANG_Grades_2024.pdf', 'application/pdf', '331148', '2024-07-21 23:58:23'),
(32, 59, 'TRIALANG_UNPCAT_2024.pdf', 'uploads/TRIALANG\\TRIALANG_UNPCAT_2024.pdf', 'application/pdf', '331148', '2024-07-21 23:58:23'),
(33, 59, 'TRIALANG_GoodMoral_2024.pdf', 'uploads/TRIALANG\\TRIALANG_GoodMoral_2024.pdf', 'application/pdf', '331148', '2024-07-21 23:58:23'),
(34, 59, 'TRIALANG_COR_2024.pdf', 'uploads/TRIALANG\\TRIALANG_COR_2024.pdf', 'application/pdf', '331148', '2024-07-21 23:58:23'),
(102, 69, '20-0001_COS_2024(1st_sem)(3).pdf', 'uploads/20-0001\\20-0001_COS_2024(1st_sem)(3).pdf', 'application/pdf', '514972', '2024-09-16 09:30:35'),
(103, 69, '20-0001_Grades_2024(1st_sem)(2).pdf', 'uploads/20-0001\\20-0001_Grades_2024(1st_sem)(2).pdf', 'application/pdf', '514972', '2024-09-16 09:30:35'),
(104, 69, '20-0001_COR_2024(1st_sem)(2).pdf', 'uploads/20-0001\\20-0001_COR_2024(1st_sem)(2).pdf', 'application/pdf', '514972', '2024-09-16 09:30:35'),
(105, 72, '19-0002_COS_2024.pdf', 'uploads/19-0002\\19-0002_COS_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:37:57'),
(106, 72, '19-0002_Grades_2024.pdf', 'uploads/19-0002\\19-0002_Grades_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:37:57'),
(107, 72, '19-0002_UNPCAT_2024.pdf', 'uploads/19-0002\\19-0002_UNPCAT_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:37:57'),
(108, 72, '19-0002_GoodMoral_2024.pdf', 'uploads/19-0002\\19-0002_GoodMoral_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:37:58'),
(109, 72, '19-0002_COR_2024.pdf', 'uploads/19-0002\\19-0002_COR_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:37:58'),
(110, 73, '19-0002_COS_2024.pdf', 'uploads/19-0002\\19-0002_COS_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:46:01'),
(111, 73, '19-0002_Grades_2024.pdf', 'uploads/19-0002\\19-0002_Grades_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:46:01'),
(112, 73, '19-0002_UNPCAT_2024.pdf', 'uploads/19-0002\\19-0002_UNPCAT_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:46:01'),
(113, 73, '19-0002_GoodMoral_2024.pdf', 'uploads/19-0002\\19-0002_GoodMoral_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:46:01'),
(114, 73, '19-0002_COR_2024.pdf', 'uploads/19-0002\\19-0002_COR_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:46:01'),
(115, 74, '19-0002_COS_2024.pdf', 'uploads/19-0002\\19-0002_COS_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:49:05'),
(116, 74, '19-0002_Grades_2024.pdf', 'uploads/19-0002\\19-0002_Grades_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:49:05'),
(117, 74, '19-0002_UNPCAT_2024.pdf', 'uploads/19-0002\\19-0002_UNPCAT_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:49:05'),
(118, 74, '19-0002_GoodMoral_2024.pdf', 'uploads/19-0002\\19-0002_GoodMoral_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:49:05'),
(119, 74, '19-0002_COR_2024.pdf', 'uploads/19-0002\\19-0002_COR_2024.pdf', 'application/pdf', '514972', '2024-09-16 09:49:05'),
(120, 75, '21-00259_COS_2024.pdf', 'auth/uploads/21-00259\\21-00259_COS_2024.pdf', 'application/pdf', '514972', '2024-10-01 13:39:04'),
(121, 75, '21-00259_Grades_2024.pdf', 'auth/uploads/21-00259\\21-00259_Grades_2024.pdf', 'application/pdf', '514972', '2024-10-01 13:39:04'),
(122, 75, '21-00259_UNPCAT_2024.pdf', 'auth/uploads/21-00259\\21-00259_UNPCAT_2024.pdf', 'application/pdf', '514972', '2024-10-01 13:39:04'),
(123, 75, '21-00259_GoodMoral_2024.pdf', 'auth/uploads/21-00259\\21-00259_GoodMoral_2024.pdf', 'application/pdf', '514972', '2024-10-01 13:39:04'),
(124, 75, '21-00259_COR_2024.pdf', 'auth/uploads/21-00259\\21-00259_COR_2024.pdf', 'application/pdf', '514972', '2024-10-01 13:39:04'),
(125, 76, '21-78945_COS_2024.pdf', 'uploads/21-78945\\21-78945_COS_2024.pdf', 'application/pdf', '514972', '2024-10-01 15:55:35'),
(126, 76, '21-78945_Grades_2024.pdf', 'uploads/21-78945\\21-78945_Grades_2024.pdf', 'application/pdf', '514972', '2024-10-01 15:55:35'),
(127, 76, '21-78945_UNPCAT_2024.pdf', 'uploads/21-78945\\21-78945_UNPCAT_2024.pdf', 'application/pdf', '514972', '2024-10-01 15:55:35'),
(128, 76, '21-78945_GoodMoral_2024.pdf', 'uploads/21-78945\\21-78945_GoodMoral_2024.pdf', 'application/pdf', '514972', '2024-10-01 15:55:35'),
(129, 76, '21-78945_COR_2024.pdf', 'uploads/21-78945\\21-78945_COR_2024.pdf', 'application/pdf', '514972', '2024-10-01 15:55:35'),
(130, 75, '21-00259_COS_2024(1st_sem)(1).pdf', 'uploads/21-00259\\21-00259_COS_2024(1st_sem)(1).pdf', 'application/pdf', '514972', '2024-10-01 16:16:01'),
(131, 75, '21-00259_COS_2024(1st_sem)(1).pdf', 'uploads/21-00259\\21-00259_Grades_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:16:01'),
(132, 75, '21-00259_COS_2024(1st_sem)(1).pdf', 'uploads/21-00259\\21-00259_COR_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:16:01'),
(133, 76, '21-78945_COS_2024(1st_sem).pdf', 'uploads/21-78945\\21-78945_COS_2024(1st_sem)(1).pdf', 'application/pdf', '514972', '2024-10-01 16:23:49'),
(134, 76, '21-78945_Grades_2024(1st_sem).pdf', 'uploads/21-78945\\21-78945_Grades_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:23:49'),
(135, 76, '21-78945_COR_2024(1st_sem).pdf', 'uploads/21-78945\\21-78945_COR_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:23:49'),
(136, 76, '21-78945_COS_2024(1st_sem).pdf', 'uploads/21-78945\\21-78945_COS_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:24:16'),
(137, 76, '21-78945_Grades_2024(1st_sem).pdf', 'uploads/21-78945\\21-78945_Grades_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:24:17'),
(138, 76, '21-78945_COR_2024(1st_sem).pdf', 'uploads/21-78945\\21-78945_COR_2024(1st_sem).pdf', 'application/pdf', '514972', '2024-10-01 16:24:17'),
(139, 77, '20-03561_COS_2024.pdf', 'uploads/20-03561\\20-03561_COS_2024.pdf', 'application/pdf', '514972', '2024-10-02 01:11:41'),
(140, 77, '20-03561_Grades_2024.pdf', 'uploads/20-03561\\20-03561_Grades_2024.pdf', 'application/pdf', '514972', '2024-10-02 01:11:41'),
(141, 77, '20-03561_UNPCAT_2024.pdf', 'uploads/20-03561\\20-03561_UNPCAT_2024.pdf', 'application/pdf', '514972', '2024-10-02 01:11:41'),
(142, 77, '20-03561_GoodMoral_2024.pdf', 'uploads/20-03561\\20-03561_GoodMoral_2024.pdf', 'application/pdf', '514972', '2024-10-02 01:11:41'),
(143, 77, '20-03561_COR_2024.pdf', 'uploads/20-03561\\20-03561_COR_2024.pdf', 'application/pdf', '514972', '2024-10-02 01:11:41'),
(144, 78, '1_COS_2024.pdf', 'uploads/1\\1_COS_2024.pdf', 'application/pdf', '28597', '2024-11-07 10:27:47'),
(145, 78, '1_Grades_2024.pdf', 'uploads/1\\1_Grades_2024.pdf', 'application/pdf', '28246', '2024-11-07 10:27:47'),
(146, 78, '1_GoodMoral_2024.pdf', 'uploads/1\\1_GoodMoral_2024.pdf', 'application/pdf', '27762', '2024-11-07 10:27:47'),
(147, 78, '1_COR_2024.pdf', 'uploads/1\\1_COR_2024.pdf', 'application/pdf', '28175', '2024-11-07 10:27:47'),
(148, 79, '2_COS_2024.pdf', 'uploads/2\\2_COS_2024.pdf', 'application/pdf', '28597', '2024-11-09 06:02:04'),
(149, 79, '2_Grades_2024.pdf', 'uploads/2\\2_Grades_2024.pdf', 'application/pdf', '28246', '2024-11-09 06:02:04'),
(150, 79, '2_GoodMoral_2024.pdf', 'uploads/2\\2_GoodMoral_2024.pdf', 'application/pdf', '27762', '2024-11-09 06:02:04'),
(151, 79, '2_COR_2024.pdf', 'uploads/2\\2_COR_2024.pdf', 'application/pdf', '28175', '2024-11-09 06:02:04'),
(157, 81, '21-03735_COS_2024.pdf', 'uploads/21-03735\\21-03735_COS_2024.pdf', 'application/pdf', '28597', '2024-11-26 16:08:58'),
(158, 81, '21-03735_Grades_2024.pdf', 'uploads/21-03735\\21-03735_Grades_2024.pdf', 'application/pdf', '28246', '2024-11-26 16:08:58'),
(159, 81, '21-03735_UNPCAT_2024.pdf', 'uploads/21-03735\\21-03735_UNPCAT_2024.pdf', 'application/pdf', '28886', '2024-11-26 16:08:58'),
(160, 81, '21-03735_GoodMoral_2024.pdf', 'uploads/21-03735\\21-03735_GoodMoral_2024.pdf', 'application/pdf', '27762', '2024-11-26 16:08:58'),
(161, 81, '21-03735_COR_2024.pdf', 'uploads/21-03735\\21-03735_COR_2024.pdf', 'application/pdf', '28175', '2024-11-26 16:08:58'),
(162, 78, '1_COS_2024(1st_sem).pdf', 'uploads/1\\1_COS_2024(1st_sem).pdf', 'application/pdf', '28597', '2024-11-26 20:28:20'),
(163, 78, '1_Grades_2024(1st_sem).pdf', 'uploads/1\\1_Grades_2024(1st_sem).pdf', 'application/pdf', '28246', '2024-11-26 20:28:20'),
(164, 78, '1_COR_2024(1st_sem).pdf', 'uploads/1\\1_COR_2024(1st_sem).pdf', 'application/pdf', '28175', '2024-11-26 20:28:20'),
(168, 82, '123_COS_2024.pdf', 'uploads/123\\123_COS_2024.pdf', 'application/pdf', '28597', '2024-12-02 21:24:28'),
(169, 82, '123_Grades_2024.pdf', 'uploads/123\\123_Grades_2024.pdf', 'application/pdf', '28246', '2024-12-02 21:24:28'),
(170, 82, '123_UNPCAT_2024.pdf', 'uploads/123\\123_UNPCAT_2024.pdf', 'application/pdf', '28886', '2024-12-02 21:24:28'),
(171, 82, '123_GoodMoral_2024.pdf', 'uploads/123\\123_GoodMoral_2024.pdf', 'application/pdf', '27762', '2024-12-02 21:24:28'),
(172, 82, '123_COR_2024.pdf', 'uploads/123\\123_COR_2024.pdf', 'application/pdf', '28175', '2024-12-02 21:24:28'),
(173, 83, '21-11245_COS_2025.pdf', 'uploads/21-11245\\21-11245_COS_2025.pdf', 'application/pdf', '28597', '2025-01-11 12:37:52'),
(174, 83, '21-11245_Grades_2025.pdf', 'uploads/21-11245\\21-11245_Grades_2025.pdf', 'application/pdf', '28246', '2025-01-11 12:37:52'),
(175, 83, '21-11245_UNPCAT_2025.pdf', 'uploads/21-11245\\21-11245_UNPCAT_2025.pdf', 'application/pdf', '28886', '2025-01-11 12:37:52'),
(176, 83, '21-11245_GoodMoral_2025.pdf', 'uploads/21-11245\\21-11245_GoodMoral_2025.pdf', 'application/pdf', '27762', '2025-01-11 12:37:52'),
(177, 83, '21-11245_COR_2025.pdf', 'uploads/21-11245\\21-11245_COR_2025.pdf', 'application/pdf', '28175', '2025-01-11 12:37:52'),
(178, 84, '21-56653_COS_2025.pdf', 'uploads/21-56653\\21-56653_COS_2025.pdf', 'application/pdf', '28597', '2025-01-11 13:21:56'),
(179, 84, '21-56653_Grades_2025.pdf', 'uploads/21-56653\\21-56653_Grades_2025.pdf', 'application/pdf', '28246', '2025-01-11 13:21:56'),
(180, 84, '21-56653_UNPCAT_2025.pdf', 'uploads/21-56653\\21-56653_UNPCAT_2025.pdf', 'application/pdf', '28886', '2025-01-11 13:21:56'),
(181, 84, '21-56653_GoodMoral_2025.pdf', 'uploads/21-56653\\21-56653_GoodMoral_2025.pdf', 'application/pdf', '27762', '2025-01-11 13:21:56'),
(182, 84, '21-56653_COR_2025.pdf', 'uploads/21-56653\\21-56653_COR_2025.pdf', 'application/pdf', '28175', '2025-01-11 13:21:56'),
(183, 85, '19-1111_COS_2025.pdf', 'uploads/19-1111\\19-1111_COS_2025.pdf', 'application/pdf', '28597', '2025-01-17 03:00:16'),
(184, 85, '19-1111_Grades_2025.pdf', 'uploads/19-1111\\19-1111_Grades_2025.pdf', 'application/pdf', '28246', '2025-01-17 03:00:16'),
(185, 85, '19-1111_UNPCAT_2025.pdf', 'uploads/19-1111\\19-1111_UNPCAT_2025.pdf', 'application/pdf', '28886', '2025-01-17 03:00:16'),
(186, 85, '19-1111_GoodMoral_2025.pdf', 'uploads/19-1111\\19-1111_GoodMoral_2025.pdf', 'application/pdf', '27762', '2025-01-17 03:00:16'),
(187, 85, '19-1111_COR_2025.pdf', 'uploads/19-1111\\19-1111_COR_2025.pdf', 'application/pdf', '28175', '2025-01-17 03:00:16'),
(188, 85, '19-1111_COS_2025(2nd_sem).pdf', 'uploads/19-1111\\19-1111_COS_2025(2nd_sem).pdf', 'application/pdf', '28597', '2025-01-17 03:24:48'),
(189, 85, '19-1111_Grades_2025(2nd_sem).pdf', 'uploads/19-1111\\19-1111_Grades_2025(2nd_sem).pdf', 'application/pdf', '28246', '2025-01-17 03:24:48'),
(190, 85, '19-1111_COR_2025(2nd_sem).pdf', 'uploads/19-1111\\19-1111_COR_2025(2nd_sem).pdf', 'application/pdf', '28175', '2025-01-17 03:24:48'),
(191, 86, '123332_COS_2025.pdf', 'uploads/123332\\123332_COS_2025.pdf', 'application/pdf', '28597', '2025-01-19 15:30:08'),
(192, 86, '123332_Grades_2025.pdf', 'uploads/123332\\123332_Grades_2025.pdf', 'application/pdf', '28246', '2025-01-19 15:30:08'),
(193, 86, '123332_GoodMoral_2025.pdf', 'uploads/123332\\123332_GoodMoral_2025.pdf', 'application/pdf', '28246', '2025-01-19 15:30:08'),
(194, 86, '123332_COR_2025.pdf', 'uploads/123332\\123332_COR_2025.pdf', 'application/pdf', '28175', '2025-01-19 15:30:08'),
(195, 78, '1_COS_2025(2nd_sem).pdf', 'uploads/1\\1_COS_2025(2nd_sem).pdf', 'application/pdf', '28597', '2025-01-19 21:25:20'),
(196, 78, '1_Grades_2025(2nd_sem).pdf', 'uploads/1\\1_Grades_2025(2nd_sem).pdf', 'application/pdf', '28246', '2025-01-19 21:25:20'),
(197, 78, '1_COR_2025(2nd_sem).pdf', 'uploads/1\\1_COR_2025(2nd_sem).pdf', 'application/pdf', '28175', '2025-01-19 21:25:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `archivedinformation`
--
ALTER TABLE `archivedinformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upId` (`upId`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `upId` (`upId`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`upId`);

--
-- Indexes for table `user_files`
--
ALTER TABLE `user_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `upId` (`upId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `aid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `archivedinformation`
--
ALTER TABLE `archivedinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `upId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user_files`
--
ALTER TABLE `user_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `upId` FOREIGN KEY (`upId`) REFERENCES `userprofile` (`upId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
