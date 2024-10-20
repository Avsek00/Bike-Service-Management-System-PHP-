-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 07:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bscmss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin123'),
(2, 'Administrator', 'admin@gmail.com', 'admin123'),
(3, 'admin two', 'admin2@gmail.com', '$2y$10$DYG/JXLtAeGcq4YI8GlJg.3Xmv80ZynM82FnAziFnmO');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'avishek', 'avishek@gmail.com', 'thanks', 'thanks', '2024-05-23 13:52:11'),
(2, 'avishek', 'avishek@gmail.com', 'thanks', 'thanks', '2024-05-23 13:53:51'),
(3, 'test', 'test@gmail.com', 'tets', 'test', '2024-05-23 14:01:17'),
(10, 'diwas', 'diwas@gmail.com', 'enquiry', 'is the motul engine oil available?', '2024-06-14 05:17:36'),
(11, 'diwas', 'diwas@gmail.com', 'test', 'test', '2024-06-14 05:33:03'),
(12, 'anjan', 'anjan@gmail.com', 'enquiry', 'is liquimolly engine oil available?', '2024-06-15 04:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `mailbox`
--

CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mailbox`
--

INSERT INTO `mailbox` (`id`, `to_email`, `subject`, `message`, `attachment`, `created_at`) VALUES
(1, 'avishek@gmail.com', 'Service notice', '                            Dear Customer,\n\n                            This is to inform you about servicing notice. You are due for your next servicing.\n                        ', NULL, '2024-05-23 12:35:26'),
(2, 'avishek@gmail.com', 'test', '                            Dear Customer,\r\n\r\n                            This is to inform you about servicing notice.\r\n                        ', NULL, '2024-05-23 13:07:25'),
(3, 'avishek@gmail.com', 'hello', '             test', NULL, '2024-05-31 15:35:41'),
(4, 'avishek@gmail.com', 'hello ', 'test for bulk mail', NULL, '2024-05-31 15:51:49'),
(5, 'harir@gmail.com', 'hello ', 'test for bulk mail', NULL, '2024-05-31 15:51:49'),
(6, 'sita@gmail.com', 'hello ', 'test for bulk mail', NULL, '2024-05-31 15:51:49'),
(7, 'avishek1@gmail.com', 'Hello ', '  Welcome, your service request has been assigned.', NULL, '2024-06-05 13:32:38'),
(8, 'avishek1@gmail.com', 'Welcome', '                            Dear Customer,\r\n\r\n                            This is to inform you about servicing notice.\r\n                        ', 'uploads/mailbox.txt', '2024-06-07 12:18:30'),
(9, 'avishek2@gmail.com', 'hello ', '                            Dear Customer,\r\n\r\n                            This is to inform you about servicing notice.\r\n                        ', NULL, '2024-06-09 09:24:33'),
(10, 'diwas@gmail.com', 'Warm welcome', '                       Hello Mr. Diwas ,\r\nWelcome to bhairab bike service\r\n\r\n                        ', NULL, '2024-06-13 12:45:21'),
(11, 'avishek@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(12, 'harir@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(13, 'sita@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(14, 'avishek1@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(15, 'avishek2@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(16, 'jenish@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(17, 'diwas@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(18, 'sagar@gmail.com', 'Hello ', 'test for bulk message', NULL, '2024-06-13 13:12:59'),
(19, 'diwas@gmail.com', 'reply - enquiry', '                            Dear Customer,\r\n\r\n                            This is to inform you  that we do have Motul engine oil availabe.\r\n                        ', NULL, '2024-06-14 05:18:48'),
(20, 'atit@gmail.com', 'hello', '                            Dear Customer,\r\n\r\n                            Your service requested has been accepted.\r\n                        ', NULL, '2024-06-15 03:22:39'),
(21, 'avishek1@gmail.com', 'Hello', 'Hope everything is well for you machine.', NULL, '2024-06-15 03:23:23'),
(22, 'avishek2@gmail.com', 'Hello', 'Hope everything is well for you machine.', NULL, '2024-06-15 03:23:23'),
(23, 'jenish@gmail.com', 'Hello', 'Hope everything is well for you machine.', NULL, '2024-06-15 03:23:23'),
(24, 'diwas@gmail.com', 'Hello', 'Hope everything is well for you machine.', NULL, '2024-06-15 03:23:23'),
(25, 'sagar@gmail.com', 'Hello', 'Hope everything is well for you machine.', NULL, '2024-06-15 03:23:23'),
(26, 'atit@gmail.com', 'Hello', 'Hope everything is well for you machine.', NULL, '2024-06-15 03:23:23'),
(27, 'anjan@gmail.com', 'hello', '                            Dear Customer,\r\n\r\n                            This is to inform you about servicing notice. Your service request has been processed.\r\n                        ', NULL, '2024-06-15 04:00:25'),
(28, 'avishek1@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(29, 'avishek2@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(30, 'jenish@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(31, 'diwas@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(32, 'sagar@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(33, 'atit@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(34, 'anjan@gmail.com', 'Hello', 'wish you a good morning.', NULL, '2024-06-15 04:00:52'),
(35, 'anjan@gmail.com', 'Enquiry reply', '                            Dear Customer,\r\n\r\n                            Yes LiquiMolly engine oil is available.\r\n                        ', NULL, '2024-06-15 04:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic_list`
--

CREATE TABLE `mechanic_list` (
  `id` int(11) NOT NULL,
  `mechanic_name` varchar(70) NOT NULL,
  `mechanic_contact` bigint(10) NOT NULL COMMENT '10-digits only'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanic_list`
--

INSERT INTO `mechanic_list` (`id`, `mechanic_name`, `mechanic_contact`) VALUES
(1, 'hari', 9846346563),
(2, 'ram bahadur', 9822422100),
(3, 'test', 9861493842);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `customer_id` int(11) NOT NULL,
  `service_price` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `additional_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`customer_id`, `service_price`, `vat`, `additional_price`, `total_price`) VALUES
(1, 900.00, 117.00, -300.00, 717.00),
(2, 1200.00, 156.00, 1300.00, 2656.00),
(3, 1200.00, 156.00, 2000.00, 3356.00),
(4, 2000.00, 260.00, 5000.00, 7260.00),
(5, 2000.00, 260.00, 1800.00, 4060.00),
(6, 2200.00, 286.00, 1400.00, 3886.00),
(7, 0.00, 0.00, 800.00, 800.00),
(8, 0.00, 0.00, 2000.00, 2000.00),
(9, 0.00, 0.00, 1000.00, 1000.00),
(10, 0.00, 0.00, 1800.00, 1800.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(20) NOT NULL,
  `service` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `service`, `description`, `price`) VALUES
(1, 'Change Oil', 'We use the best Engine oil for your machine', '900'),
(2, 'Tire Replacement ', 'Replace your old tires with best match and best quality.', '500'),
(3, 'Engine Tune-up', 'Tune your engine with the best available technicians', '800'),
(4, 'Overall Checkup', 'Let us chek your machine for the best performance', '300');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(70) NOT NULL,
  `owner_contact` bigint(10) NOT NULL COMMENT '10-digits only',
  `address` varchar(100) NOT NULL,
  `owner_email` varchar(50) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `vehicle_regnumber` varchar(100) NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `service_date` date NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `service_type` varchar(50) NOT NULL,
  `request_type` varchar(50) NOT NULL,
  `problem_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `owner_name`, `owner_contact`, `address`, `owner_email`, `vehicle_name`, `vehicle_regnumber`, `vehicle_model`, `service_date`, `date_created`, `service_type`, `request_type`, `problem_description`) VALUES
(1, 'avi', 9861493842, 'damauli', 'avishek@gmail.com', 'suzuki gixxer', 'GA 2022', '2017', '2024-05-24', '2024-05-21', 'Change Oil', 'Drop Off', 'test'),
(2, 'hari', 9846346180, 'lalitpur', 'harir@gmail.com', 'yamaha rayzr', 'BA 4404', '2020', '2024-05-27', '2024-05-21', 'Change Oil, Engine Tune up, Overall Checkup, Tire ', 'Drop Off', 'brake oil'),
(3, 'sitashma', 9862483941, 'gongabu', 'sita@gmail.com', 'honda crf', 'ba 3033', '2019', '2024-05-30', '2024-05-23', 'Change Oil, Engine Tune up, Overall Checkup', 'Drop Off', 'test'),
(4, 'avishek1', 9862483941, 'force park', 'avishek1@gmail.com', 'apache200', 'ga 77', '2020', '2024-06-09', '2024-06-07', 'Change Oil, Engine Tune-up, Overall Checkup, Tire ', 'Drop Off', 'hehehe'),
(5, 'avishek2', 9862483941, 'dallu', 'avishek2@gmail.com', 'fz150', 'Ba 808', '2020', '2024-06-16', '2024-06-09', 'Change Oil, Engine Tune-up, Overall Checkup, Tire ', 'Drop Off', 'adada'),
(6, 'Jenish Singh', 9862422122, 'koteshwor', 'jenish@gmail.com', 'aprilia150', 'KO 353', '2019', '2024-06-10', '2024-06-09', 'Change Oil, Tire Replacement , Engine Tune-up, Ove', 'Drop Off', 'problem'),
(7, 'Diwas Karki', 9846243113, 'thamel', 'diwas@gmail.com', 'duke200', 'BA 4405', '2019', '2024-06-13', '2024-06-13', 'Change Oil, Tire Replacement , Engine Tune-up, Ove', 'Drop Off', 'chain'),
(8, 'sagar lamichane', 9846346150, 'swoyambu', 'sagar@gmail.com', 'honda grazia', 'GA 4645', '2017', '2024-06-14', '2024-06-13', 'Change Oil, Tire Replacement , Engine Tune-up, Ove', 'Drop Off', 'acceleration lagging'),
(9, 'Atit Gurung', 9846346160, 'lalitpur', 'atit@gmail.com', 'yamaha r15', 'GA 2021', '2019', '2024-06-17', '2024-06-15', 'Change Oil, Tire Replacement , Engine Tune-up, Ove', 'Drop Off', 'check my brakes'),
(10, 'Anjan Gurung', 9846243122, 'talghare', 'anjan@gmail.com', 'rc200', 'GA 3301', '2019', '2024-06-15', '2024-06-15', 'Change Oil, Tire Replacement , Engine Tune-up, Ove', 'Drop Off', 'please check my throttle body');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Timeslot_Date` date NOT NULL,
  `Timeslot_Time` time(6) NOT NULL,
  `admin_comment` varchar(200) NOT NULL,
  `status` enum('active','inactive','pending','completed') NOT NULL DEFAULT 'active',
  `mechanic_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `user_id`, `Timeslot_Date`, `Timeslot_Time`, `admin_comment`, `status`, `mechanic_name`) VALUES
(1, 0, '0000-00-00', '10:13:00.000000', 'please visit service center at 10 am', 'completed', 'test'),
(2, 0, '0000-00-00', '11:00:00.000000', 'service is done', 'completed', 'hari'),
(3, 0, '0000-00-00', '12:30:00.000000', 'please visit service center at 12:30 pm', 'completed', 'ram bahadur'),
(4, 0, '0000-00-00', '13:00:00.000000', 'please visit service center at 1 pm', 'pending', 'ram bahadur'),
(5, 0, '0000-00-00', '12:30:00.000000', 'please visit service center at 12:30 pm', 'active', 'test'),
(6, 0, '0000-00-00', '10:00:00.000000', 'please visit service center at 10 am', 'active', 'ram bahadur'),
(7, 0, '0000-00-00', '11:00:00.000000', 'please visit service center at 11 am ', 'pending', 'ram bahadur'),
(8, 0, '0000-00-00', '12:00:00.000000', 'please visit service center at 12 pm ', 'inactive', 'hari'),
(9, 0, '0000-00-00', '11:00:00.000000', 'please visit service center at 11 am ', 'active', 'ram bahadur'),
(10, 0, '0000-00-00', '13:00:00.000000', 'please visit service center at 1 pm ', 'pending', 'hari');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL,
  `confirm_password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `confirm_password`) VALUES
(1, 'avishek', 'avishek@gmail.com', '$2y$10$ef6m7XhG9Xc8e4XWzRbuuuACfblzkAIFlU06ow12gNP9XV08k51c6', ''),
(2, 'hari', 'hari@gmail.com', '$2y$10$qnpeaOSQtL/ABwRzXn7QR.O4SQwV/f4M.k6IBNMIBbqRf1v3TGCH.', ''),
(3, 'sita', 'sita@gmail.com', '$2y$10$ak1Y26pYo.kq8Y8fSvnqmOdFe5mptqIvjR1FDCW2Z93WedZwfIjsq', ''),
(4, 'avishek1', 'avishek1@gmail.com', '$2y$10$Dt4/uUvN85bX32xWUS/qd.JqxF8rumkZIriNk4yzVwN2lXnklmTB2', ''),
(5, 'avishek2', 'avishek2@gmail.com', '$2y$10$j7qRzZW6iB9.g9e/365mHO.R1eEqRaJACHpJfCGF3r32ctr.e88qS', ''),
(6, 'Jenish Singh', 'jenish@gmail.com', '$2y$10$mRQVx2XpbyjwKudnJTmq9OdTAnAGG1YmHkGX6xBn2tO5Ta3Eq1bRe', ''),
(7, 'Diwas Karki', 'diwas@gmail.com', '$2y$10$3KscAQEvU1YbVHDb0hC3pOhTdkyEdaeEo5.fesccbS0dxZ.b9CSLu', ''),
(8, 'sagar lamichane', 'sagar@gmail.com', '$2y$10$cVdJAC/fm9hCKQPLRSKw/OMMUXGbW.nXgY2eYfMQa0VMjXS7bXTHC', ''),
(9, 'Atit Gurung', 'atit@gmail.com', '$2y$10$sYprM8y9F7iFmH5W.vHAZuKFqGVHEjPARXpuFvzR0uiAp9B.rZjja', ''),
(10, 'Anjan Gurung', 'anjan@gmail.com', '$2y$10$ecorPBD8NFMNZllHiP7W3OUF/RLaW2jQS9hOMXroivI15VQA1nZSO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanic_list`
--
ALTER TABLE `mechanic_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `owner_email` (`owner_email`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `mechanic_list`
--
ALTER TABLE `mechanic_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
