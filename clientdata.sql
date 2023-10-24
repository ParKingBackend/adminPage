-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230315.e24d2201c5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3311:3311
-- Generation Time: Oct 24, 2023 at 07:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clientdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `bank_account`, `email`, `password`, `username`) VALUES
(1247, NULL, 'naturefan@email.com', '$2a$12$W7Vo/P9kxM7J6eBc0JgIv.LAK2H5XI9NYi7bSAL/cslTK5Uy3HCtC', 'naturelover'),
(1248, NULL, 'fit@guru.com', '$2a$12$g3I6YYCWzEpKET44Y/Sk5unldQZdMOag7NkgrWg4jQCAI39Ym5nVa', 'fitnessguru'),
(1249, NULL, 'travelbug@gmail.com', '$2a$12$dwJGKMNqSiAU5PEjQoqV9.0nCWLwQtcmd3FQLAUsVH3izfCiANKxe', 'traveller'),
(1250, NULL, 'foodlover@email.com', '$2a$12$SwNkpDj4Dz0bYJ8u0HJRZOd/UP9KnIcoAfXDkV4xwKtn1Rmiop.TO', 'foodie'),
(1251, NULL, 'reader@bookworm.com', '$2a$12$TgaNky2YsEMsRP2ururrd.36hzEDbuNYePZEsNqWv.UPHfeJIFGum', 'bookworm'),
(1252, NULL, 'musicfan@email.com', '$2a$12$9bvm5WWdsKCIVsJ9QYcluOR4y8TQ7v0Mg0d3p9BIhvHFsY10FxCKm', 'musiclover'),
(1253, NULL, 'code@pro.com', '$2a$12$sVd5jVBekTBo1M.QSXe1R.uNNlc5ckzv2yxJcJJBm2OtDuN4idFkq', 'codingpro'),
(1254, NULL, 'happygamer@email.com', '$2a$12$aaH0JQ6ERJuwCgWy/OmRXua0lLTnS3cPPEHbpCCHUWzzVxFV/04Tq', 'happygamer'),
(1255, NULL, 'sneaky@gmail.com', '$2a$12$R/9VCEf/z9D9Ata7NH.YF.md1hiIcOrdCMjjnjA6XP3abHECs.B5q', 'sneakyuser');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `comp_name` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `bio`, `comp_name`, `client_id`) VALUES
(2, 'Pioneering technology solutions for a smarter future.', 'Tech Innovators', 1247),
(3, 'Leading the way in sustainable and eco-friendly solutions.', 'GreenEco Ventures', 1248),
(4, 'Bringing your visions to life through innovative design.', 'Creative Designs Inc.', 1249),
(5, 'Dedicated to improving global health with cutting-edge research.', 'HealthWell Labs', 1250),
(6, 'Efficient logistics solutions for seamless supply chains.', 'SwiftLogistics', 1251),
(7, 'Mastering the art of financial strategy and planning.', 'Financial Wizards', 1252),
(8, 'Serving mouthwatering cuisine to satisfy your cravings.', 'Foodie Delights', 1253),
(9, 'Eco-conscious technologies for a cleaner planet.', 'CleanTech Solutions', 1254),
(10, 'Expressing creativity through art and craftsmanship.', 'Artistic Creations Studio', 1255);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `first_name`, `surname`, `client_id`) VALUES
(12, 'John', 'Doe', 1248),
(13, 'Alice', 'Smith', 1249),
(14, 'David', 'Johnson', 1250),
(15, 'Sarah', 'Williams', 1251),
(16, 'Robert', 'Brown', 1252),
(17, 'Emily', 'Davis', 1253),
(18, 'Michael', 'Wilson', 1254),
(19, 'Olivia', 'Martinez', 1255);

-- --------------------------------------------------------

--
-- Table structure for table `premium_subscriptions`
--

CREATE TABLE `premium_subscriptions` (
  `id` bigint(20) NOT NULL,
  `discount_amount` decimal(38,2) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_2pksgf6wqfo61ieuasqjb6oo4` (`client_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_6b6euufurlajtqob631ql2uml` (`client_id`);

--
-- Indexes for table `premium_subscriptions`
--
ALTER TABLE `premium_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_daco94tv3i713ccgab5ud5ohn` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1256;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `premium_subscriptions`
--
ALTER TABLE `premium_subscriptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `FKdhqegwru1ufpol7nt7y8natuo` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `FK7156hv9tes23fk6pdyl0mvve7` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `premium_subscriptions`
--
ALTER TABLE `premium_subscriptions`
  ADD CONSTRAINT `FKcdt7tkmica5gxeudxpfpn1v15` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
