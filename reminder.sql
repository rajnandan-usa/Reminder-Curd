-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 06:58 AM
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
-- Database: `crud_reminder`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_reminder`
--

CREATE TABLE `client_reminder` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `expiry_date_new` date DEFAULT NULL,
  `reminder_in` varchar(20) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `reminder_status` enum('Y','N') DEFAULT NULL,
  `new_copy` enum('Y','N') DEFAULT NULL,
  `expiry_date_hold` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_reminder`
--

INSERT INTO `client_reminder` (`id`, `name`, `phone`, `email`, `start_date`, `expiry_date`, `expiry_date_new`, `reminder_in`, `price`, `message`, `file`, `status`, `reminder_status`, `new_copy`, `expiry_date_hold`) VALUES
(1, 'Rajnandan bbbbbbbbb', '9523462488', 'rajnandanweb@gmail.com', '2023-11-30', '2023-11-30', '2024-01-02', '2', '1200', 'Test', '', 'Y', 'Y', NULL, 'Y'),
(3, 'Rajnandan', '9523462488', 'rajnandanweb@gmail.com', '2023-11-30', '2023-11-29', '2023-12-30', '2', '2246', 'Test', '', 'Y', 'Y', 'Y', NULL),
(4, 'Rajnandan', '9523462488', 'rajnandanweb@gmail.com', '2023-11-30', '2023-11-30', '2024-01-02', '2', '1200', 'Test', '', 'Y', 'Y', 'Y', NULL),
(5, 'Rajnandan', '952362488', 'rajnandanweb@gmail.com', '2023-12-02', '2023-12-02', '2024-01-04', '1', '1800', 'test', '', 'Y', 'Y', NULL, 'Y'),
(6, 'Rajnandan', '952362488', 'rajnandanweb@gmail.com', '2023-12-02', '2023-12-03', NULL, '1', '1200', 'sadsd', '', 'Y', '', NULL, NULL),
(7, 'Rajnandan', '952362488', 'rajnandanweb@gmail.com', '2023-12-02', '2023-12-05', NULL, '1', '1200', 'dfzdf', 'uploads/Screenshot_2.png', 'Y', NULL, NULL, NULL),
(8, 'Rajnandan', '952362488', 'rajnandanweb@gmail.com', '2023-12-02', '2023-12-14', NULL, '1', '2246', 'dfsfs', 'uploads/Screenshot_2.png', 'Y', NULL, NULL, NULL),
(9, 'Rajnandan', '952362488', 'rajnandanweb@gmail.com', '2023-12-02', '2023-12-02', NULL, '1', '1800', 'fgdf', 'uploads/Screenshot_2.png', 'Y', NULL, NULL, NULL),
(10, 'Rajnandan', '952362488', 'rajnandanweb@gmail.com', '2023-12-02', '2023-12-02', '2024-01-04', '1', '1800', 'test', '', 'Y', 'Y', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `services_date` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`services_date`)),
  `start_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `helpline` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `services_date_end` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'NULL',
  `status` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `name`, `type`, `services_date`, `start_date`, `expiry_date`, `price`, `contact_name`, `contact_phone`, `helpline`, `notes`, `file`, `services_date_end`, `status`) VALUES
(1, 'AC Service', 'EMI', '[\"2023-11-30\",\"2023-12-03\",\"2023-12-02\",\"2023-12-09\",\"2023-12-07\"]', '2023-12-01', '2023-12-03', '1800.5', 'Rajnandan', '9523462488', '9523462488', 'Test', 'uploads/app.newscatcherapi.com.plans.PNG', '[\"2023-11-30\",\"2023-12-03\",\"2023-12-02\",\"2023-12-07\"]', 'N'),
(3, 'AC Service', 'EMI', '[\"2023-12-02\",\"2023-11-29\",\"2023-12-08\",\"2023-12-21\"]', '2023-12-01', '2023-12-09', '2246', 'Rajnandan', '9523462488', '9523462488', 'Test', 'uploads/app.newscatcherapi.com.plans.PNG', '[\"2023-11-30\",\"2023-12-03\",\"2023-12-02\",\"2023-12-07\",\"2023-12-02\",\"2023-11-29\"]', 'N'),
(4, 'AC Service', 'AMC', '[\"2023-12-01\",\"2023-11-30\",\"2023-12-07\",\"2023-12-21\"]', '2023-12-01', '2023-12-14', '1800', 'Rajnandan', '9523462488', '9523462488', 'Test', 'uploads/client-document-upload.PNG', 'NULL', 'N'),
(5, 'werewrwwe', 'AMC', '[\"2023-12-03\",\"2023-12-20\",\"2023-12-31\"]', '2023-12-01', '2023-12-31', '1000', 'Rajnandan', '1234', '1234', '1234213', 'uploads/mediastack.com.plan.PNG', '[\"2023-12-03\"]', 'N'),
(6, 'xxxxxxxxxxxxxxxxxxxx', 'EMI', '[\"2023-12-01\",\"2023-12-07\",\"2023-12-13\"]', '2023-12-01', '2023-12-31', '2234', 'sdfsdf', '5643543545', '', 'ertret wewe trew ', 'uploads/Screenshot_2.png', 'NULL', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_reminder`
--
ALTER TABLE `client_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_reminder`
--
ALTER TABLE `client_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
