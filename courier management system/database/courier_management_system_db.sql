-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 07:38 PM
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
-- Database: `courier_management_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(30) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `about` text NOT NULL,
  `company` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `twitter_profile` text NOT NULL,
  `facebook_profile` text NOT NULL,
  `instagram_profile` text NOT NULL,
  `linkedin_profile` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`, `about`, `company`, `job`, `country`, `address`, `contact`, `twitter_profile`, `facebook_profile`, `instagram_profile`, `linkedin_profile`, `date_created`) VALUES
(2, 'Abdullah', 'Siddiqui', 'abdullah.siddiqui13122002@gmail.com', '$2y$10$ZnC3a18.2lHK7o8uWSbHw.N2j/GLAqyNUnQeejPnv3Oywo8YBh7IS', 'Express Delivery is more than just a courier service; we\'re your reliable partner in seamless logistics. With a commitment to speed, efficiency, and reliability, we ensure your packages reach their destination on time, every time. Our user-friendly website simplifies the entire delivery process, offering easy order placement, real-time tracking, and personalized customer support. Trust Express Delivery for swift, secure, and stress-free shipping solutions. Your satisfaction is our priority, and your parcels are in safe hands with us!', 'Express Delivery', 'Web Developer', 'Pakistan', 'Main Shahra-E-Faisal, Karachi, Sindh 75350', '+92 335 2074636', 'https://twitter.com/', 'https://facebook.com/', 'https://instagram.com/', 'https://linkedin.com/', '2024-01-23 22:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(30) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `branch_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id`, `firstname`, `lastname`, `email`, `password`, `branch_id`, `date_created`) VALUES
(19, 'Kamran', 'Siddiqui', 'kamran@gmail.com', '$2y$10$TO.mIHuTmF3gxf.Q9xQdXePLuWGaIrPf0yGlDiZwKecdeg7LsMsyK', 47, '2024-02-06 22:49:51'),
(20, 'Faisal', 'Khan', 'faisal@gmail.com', '$2y$10$1nVboI0Dj20MHmsSgYFWreZ/iIPmLMl6SxFahFljq3PH6PVa0mqCe', 48, '2024-02-06 22:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(30) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`, `date_created`) VALUES
(47, '65c270c2c8b54', 'Opposite to Raja Hotel', 'Queeta', 'Balochistan', '678954', 'Pakistan', '03567865435', '2024-02-06 22:47:46'),
(48, '65c270e0b8854', 'Opposite to Badshahi Masjid', 'Lahore', 'Punjab', '678906', 'Pakistan', '03347892674', '2024-02-06 22:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `id` int(30) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_address` text NOT NULL,
  `sender_contact` varchar(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` varchar(255) NOT NULL,
  `parcel_description` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `parcel_status` int(11) NOT NULL DEFAULT 1,
  `weight` int(30) NOT NULL,
  `amount` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel`
--

INSERT INTO `parcel` (`id`, `tracking_id`, `sender_name`, `sender_email`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_email`, `recipient_address`, `recipient_contact`, `parcel_description`, `branch_id`, `agent_id`, `parcel_status`, `weight`, `amount`, `date_created`) VALUES
(47, '17072423339', 'Abdullah', 'abdullah.siddiqui13122002@gmail.com', 'Dawood Heights, North Karachi', '03325678965', 'Basit', 'basit@gmail.com', 'Opposite to Badshahi Masjid', '03321234567', 'no', 47, 19, 4, 9, 4500, '2024-02-06 22:58:53'),
(49, '17072436372', 'Abdullah', 'abdullah.siddiqui13122002@gmail.com', 'Dawood Heights, North Karachi', '03248888678', 'Faisal', 'faisalkhan@gmail.com', 'Opposite to Badshahi Masjid', '03333792872', 'hello', 47, 19, 2, 4, 2000, '2024-02-06 23:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_status`
--

CREATE TABLE `parcel_status` (
  `id` int(10) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel_status`
--

INSERT INTO `parcel_status` (`id`, `status`) VALUES
(1, 'Item Accepted by Courier'),
(2, 'Collected'),
(3, 'Shipped'),
(4, 'Delivered'),
(5, 'Unsuccessful Delivery Attempt');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `parcel_status` int(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `parcel_status`, `date_created`) VALUES
(76, 47, 1, '2024-02-06 22:58:58'),
(77, 47, 2, '2024-02-06 23:00:17'),
(78, 47, 3, '2024-02-06 23:02:18'),
(79, 47, 4, '2024-02-06 23:03:11'),
(82, 49, 1, '2024-02-06 23:20:37'),
(83, 49, 2, '2024-02-06 23:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_emails`
--

CREATE TABLE `subscribed_emails` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `token`, `date_created`) VALUES
(12, 'Abdullah', 'Siddique', 'abdullah.siddiqui13122002@gmail.com', '$2y$10$y9N0bQk8T9JZgsXL/oFZfOMY6fTzQlHl7xzPQ46dQTYgMREqPbHBe', '16482b97f6af33358ef7dbb763730060', '2024-02-06 22:40:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `parcel_status` (`parcel_status`);

--
-- Indexes for table `parcel_status`
--
ALTER TABLE `parcel_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_id` (`parcel_id`),
  ADD KEY `parcel_status` (`parcel_status`);

--
-- Indexes for table `subscribed_emails`
--
ALTER TABLE `subscribed_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `parcel_status`
--
ALTER TABLE `parcel_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `subscribed_emails`
--
ALTER TABLE `subscribed_emails`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `parcel_ibfk_3` FOREIGN KEY (`parcel_status`) REFERENCES `parcel_status` (`id`);

--
-- Constraints for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  ADD CONSTRAINT `parcel_tracks_ibfk_1` FOREIGN KEY (`parcel_id`) REFERENCES `parcel` (`id`),
  ADD CONSTRAINT `parcel_tracks_ibfk_2` FOREIGN KEY (`parcel_status`) REFERENCES `parcel_status` (`id`);

--
-- Constraints for table `subscribed_emails`
--
ALTER TABLE `subscribed_emails`
  ADD CONSTRAINT `subscribed_emails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
