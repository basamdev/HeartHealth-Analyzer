-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 05:42 PM
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
-- Database: `heartcare_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE `checks` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checks`
--

INSERT INTO `checks` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2025-04-23 01:02:00', 'pending', 'based on your symtoms  you need a fast check up as fast as possible', '2025-04-22 21:12:14', '2025-04-22 21:12:14'),
(2, 7, 0, '2025-04-22 01:00:00', 'pending', 'good', '2025-04-22 21:12:51', '2025-04-22 21:12:51'),
(3, 4, 0, '2025-04-22 01:00:00', 'pending', 'k', '2025-04-22 21:13:11', '2025-04-22 21:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'default-avatar.png',
  `theme` varchar(20) DEFAULT 'light',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `username`, `password`, `email`, `mobile`, `profile_picture`, `theme`, `registration_date`, `last_login`) VALUES
(1, 'Ace', '$2y$10$NQa2cFeQo8F9/XERCQAiXeOUUYmpmYWNVk63icsq2yJ4sMu4tjxRa', 'qader308@gmail.com', '', 'uploads/profile_68082ca7737f0.jpeg', 'light', '2025-04-22 16:51:46', '2025-04-24 15:30:16'),
(2, 'ace21', '$2y$10$sYgofVOMgdULejvPwbXENO5xC65DLWnyqFF5Hk08pjMbYAOt8R4SK', 'reko@gmail.com', '', 'uploads/profile_6807de540f4a2.jpeg', 'light', '2025-04-22 16:57:02', '2025-04-22 16:59:15'),
(3, 'ciahn', '$2y$10$qX8inJxfpPgEuj.X2rYHhOnSG.fIdM1w7afQhuHRKS0Np.cuFRBl6', 'cihan@gmail.com', '', 'uploads/profiles/680a5864f2104.jpg', 'light', '2025-04-24 15:27:33', '2025-04-24 15:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(1, 2, 'eb8397bd794e5cf0cdbf00074f903c67', '2025-04-18 07:16:07', '2025-04-18 04:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `height` decimal(5,2) NOT NULL COMMENT 'Height in cm',
  `weight` decimal(5,2) NOT NULL COMMENT 'Weight in kg',
  `condition_status` enum('Good','Fair','Bad','Critical') NOT NULL,
  `checkup_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `additional_symptoms` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `user_id`, `name`, `height`, `weight`, `condition_status`, `checkup_date`, `notes`, `additional_symptoms`, `created_at`, `updated_at`) VALUES
(2, 2, '44', 44.00, 44.00, 'Bad', '2025-04-23', 'dfgh', 'chest_pressure,chest_burning,sweating,fatigue,pain_back,trigger_stress,trigger_cold,risk_diabetes,risk_family', '2025-04-23 02:00:13', '2025-04-23 02:37:16'),
(3, 8, '33', 188.00, 67.00, 'Good', '2025-04-23', '', 'chest_pressure,pain_lower,fatigue,pain_arm,trigger_stress,trigger_cold,risk_family', '2025-04-23 02:01:53', '2025-04-23 02:51:10'),
(4, 2, '33', 133.00, 63.00, '', '2025-04-24', '', 'pain_arm,pain_back,trigger_cold,risk_diabetes,risk_family', '2025-04-24 14:40:09', '2025-04-24 14:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_profile` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password_hash`, `created_at`, `user_profile`) VALUES
(1, 'ace', 'ace', 'ace@gmail.com', 'Ace921', '$2y$10$w9ZRP3IUwic5OPgeRE9bjel/QeZEv5xyLT8KWGbM3jYfIQFfBpFO2', '2025-04-18 04:00:55', NULL),
(2, 'qader', 'mamand', 'qader308@gmail.com', 'Ace', '$2y$10$A4xUN5oPQIkNwT9HrWBI8e3p/hLQX/3/QRxp6i5vvGwryaHZykL.m', '2025-04-18 04:16:01', 0x70726f66696c655f325f313734353337363931312e6a706567),
(3, 'basamm', 'basam', 'basamm@gmail.com', 'basam15', '$2y$10$j1eC586R7vc28X0sgaDPZulaLR4xw9TZZw9ilqlyD.yLHD/jHUuVG', '2025-04-18 20:16:04', NULL),
(4, 'bassam', 'bassam', 'admin@gmail.com', 'basam11', '$2y$10$0X0WF1uGV8439W.qlsXbpOyZumrC/PmT9GBWWI1tCeE3/WVwR0Jv6', '2025-04-19 18:18:17', NULL),
(5, 'basam', 'ali', 'basambasam@gmail.com', 'basam921', '$2y$10$4H.GXwAOcCqTGDyk2HdL2ObJz9yl9QGrUS9K0vqNsxWXLaMqVb3vK', '2025-04-20 17:15:45', NULL),
(6, 'basam01', 'basam', 'basam1@gmail.com', 'basam01', '$2y$10$zvGjlFkpDef0S6C50tsTbu6BVo2grP39lWPvk.29ZTnwmQPr.Z8p.', '2025-04-21 06:22:33', NULL),
(8, 'barzan', 'yaseen', 'barzan@gmail.com', 'barzan', '$2y$10$Wp/hxRrUwPvLuFx6ZQx00OiVZ2Gtl9oh3oLqjTkTAZ/DTIzMahZRC', '2025-04-22 18:23:45', 0x70726f66696c655f385f313734353337333638362e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
