-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2024 at 12:46 PM
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
-- Database: `reportdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `SheetSrNo` varchar(7) NOT NULL,
  `enrol` varchar(12) NOT NULL,
  `examDate` date NOT NULL DEFAULT current_timestamp(),
  `issueDate` date DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `sem` int(1) DEFAULT NULL,
  `sgpa` decimal(3,2) DEFAULT NULL,
  `cgpa` decimal(3,2) DEFAULT NULL,
  `passFail` varchar(1) DEFAULT NULL,
  `ex` varchar(1) DEFAULT NULL,
  `mobile` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `SheetSrNo`, `enrol`, `examDate`, `issueDate`, `name`, `sem`, `sgpa`, `cgpa`, `passFail`, `ex`, `mobile`) VALUES
(1, '1933243', '0902CS211045', '2024-07-01', '2011-11-04', 'Fdsj', 4, 7.80, 8.88, '0', '1', 8732423422),
(3, '1232131', '0902CS211037', '2024-08-01', '2024-07-03', 'Piyush Yadav', 2, 9.99, 9.99, '1', '0', 2147483647),
(4, '2343248', '0902CS211045', '2024-11-01', '2024-07-14', 'Fdsj', 5, 9.99, 2.30, '1', '0', 4734873332),
(5, '2442432', '0902CS211037', '2024-08-01', '2024-07-05', 'Piyush Yadav', 8, 1.00, 1.00, '1', '0', 2343254222),
(6, '2874278', '0902CS211045', '2024-12-01', '2024-07-06', 'Customber1', 5, 2.30, 3.40, '0', '0', 9234828434),
(7, '3334435', '0902CS211045', '2024-11-01', '2024-07-13', '23432', 5, 2.20, 3.30, '0', '1', 2323422333),
(8, '3442234', '0902CS211045', '2024-12-01', '2024-07-05', 'Fdsj', 3, 3.00, 9.00, '1', '0', 4234223422),
(9, '456783', '0902IT211011', '2024-07-01', '2024-07-04', 'Sumit', 2, 7.80, 8.80, '1', '0', 7879621130),
(10, '7612323', '0902CS211037', '2024-11-01', '2024-07-03', 'Piyush Yadav', 6, 9.99, 9.99, '1', '0', 2147483647),
(11, '8734782', '0902CS211037', '2024-07-01', '2024-07-02', 'Piyush Yadav', 5, 9.99, 9.99, '1', '0', 2147483647),
(12, '3409340', '0902CS211045', '2024-08-01', '2024-07-12', 'Ram', 3, 4.44, 2.22, '0', '0', 3242343242),
(13, '3485734', '0902CS211034', '2024-07-01', '2024-07-15', 'Galaxy Ranger Acheron , An Self-eminator', 5, 4.40, 4.20, '1', '0', 2389472892),
(14, '3454353', '0902CS211045', '2024-08-01', '2024-07-15', 'Customber1', 2, 3.00, 4.00, '0', '1', 3453435334),
(15, '3454353', '0902IT211011', '2024-11-01', '2024-07-15', 'Fdsj', 1, 2.00, 2.00, '0', '0', 2342424242),
(16, '2423443', '2342434', '2024-07-01', '2024-07-15', 'Customber1', 2, 7.80, 8.80, '0', '1', 3423424242),
(17, '3242434', '0902CS211045', '2024-07-01', '2024-07-15', 'Vendor1', 3, 7.80, 8.80, '0', '0', 2423234324),
(18, '2343242', '0902CS211045', '2024-04-01', '2024-07-15', 'Vendor1', 3, 3.00, 3.00, '0', '0', 2343243233),
(19, '3244242', '0902IT211011', '2024-11-01', '2024-07-15', 'Customber1', 3, 3.00, 4.00, '0', '0', 4334535435),
(20, '545454', '0902IT211011', '2024-12-01', '2024-07-06', 'Customber1', 3, 7.80, 8.80, '0', '0', 3424243334),
(21, '343443', '0902IT211011', '2024-06-01', '2024-07-15', 'Customber1', 2, 4.00, 4.00, '0', '0', 3434343433),
(22, '2343243', 'F00999999', '2024-07-01', '2024-07-14', 'Customber1', 3, 7.80, 8.80, '0', '0', 2332323232),
(23, '3242434', 'F00999999', '2024-12-01', '2024-07-15', 'Customber1', 3, 3.00, 3.00, '0', '0', 2342424324),
(24, '455454', '09', '2024-08-01', '2024-07-15', 'Fdsj', 3, 4.00, 4.00, '0', '0', 4554545455);

-- --------------------------------------------------------

--
-- Table structure for table `report2`
--

CREATE TABLE `report2` (
  `SheetSrNo` varchar(7) NOT NULL,
  `enrol` varchar(12) NOT NULL,
  `examDate` date NOT NULL DEFAULT current_timestamp(),
  `issueDate` date DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `sem` int(1) DEFAULT NULL,
  `sgpa` decimal(3,2) DEFAULT NULL,
  `cgpa` decimal(3,2) DEFAULT NULL,
  `passFail` varchar(1) DEFAULT NULL,
  `ex` varchar(1) DEFAULT NULL,
  `mobile` decimal(10,0) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report2`
--

INSERT INTO `report2` (`SheetSrNo`, `enrol`, `examDate`, `issueDate`, `name`, `sem`, `sgpa`, `cgpa`, `passFail`, `ex`, `mobile`, `id`) VALUES
('193', '0902CS211045', '2024-07-01', '2011-11-04', 'Fdsj', 4, 7.80, 8.88, '0', '1', 87, NULL),
('23423', '0902CS211045', '2024-12-01', '2024-07-11', 'Ram Ram Ram', 3, 2.22, 2.22, '0', '1', 1231, NULL),
('234233', '0902cs211037', '0000-00-00', '2024-07-03', 'Piyush Yadav', 2, 9.99, 9.99, '1', '0', 2147483647, NULL),
('234324', '0902CS211045', '0000-00-00', '2024-07-14', 'Fdsj', 5, 9.99, 2.30, '1', '0', 473487, NULL),
('2442432', '0902cs211037', '0000-00-00', '2024-07-05', 'Piyush Yadav', 8, 1.00, 1.00, '1', '0', 23432542, NULL),
('2874278', '0902CS211045', '2024-12-01', '2024-07-06', 'Customber1', 5, 2.30, 3.40, '0', '0', 9234828, NULL),
('3334435', '0902CS211045', '0000-00-00', '2024-07-13', '23432', 5, 2.20, 3.30, '0', '1', 23234, NULL),
('3442', '0902cs211045', '0000-00-00', '2024-07-05', 'Fdsj', 3, 3.00, 9.00, '1', '0', 42342, NULL),
('45678', 'F00999999', '2024-07-01', '2024-07-04', 'Sumit', 2, 7.80, 8.80, '1', '0', 7879621130, NULL),
('76123', '0902cs211037', '0000-00-00', '2024-07-03', 'Piyush Yadav', 6, 9.99, 9.99, '1', '0', 2147483647, NULL),
('8734782', '0902cs211037', '0000-00-00', '2024-07-02', 'Piyush Yadav', 5, 9.99, 9.99, '1', '0', 2147483647, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2024-07-16 08:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report2`
--
ALTER TABLE `report2`
  ADD PRIMARY KEY (`SheetSrNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
