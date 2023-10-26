-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230315.e24d2201c5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3311:3311
-- Generation Time: Oct 26, 2023 at 10:57 AM
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
-- Database: `parkingdati`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `bank_account`, `email`, `image`, `level`, `password`, `username`, `xp`) VALUES
(1, '9999888877', 'john.doe@example.com', 'images/user1.jpg', 1, '$2a$12$pxmX1XqCoM1APEgeJe7JXesyt2PPdd3.H.2rYXP/91ReM6b82toJ6', 'john_doe', 12),
(2, '1111222333', 'alice.smith@example.com', 'images/user2.jpg', 1, '$2a$12$TmuPW2l0Wcw6JicoeNC5ZO2P6DDkwkIeK9EaaSvsxUCol3OFqQ75W', 'alice_smith', 52),
(3, '4444555566', 'bob.jones@example.com', 'images/user3.jpg', 2, '$2a$12$9T068gZkauKhTYPPM2LpBOXO/AYfm9kJ5zM9vZAezP/uCudjZdvDG', 'bob_jones', 34),
(4, '7777888999', 'carol.wilson@example.com', 'images/user4.jpg', 2, '$2a$12$ZrLO9JVtw67swGhRwMzyd.ylc5KuHRZK3Phj66ChotA8Y0pENWorG', 'carol_wilson', 64),
(5, '3333444555', 'david.smith@example.com', 'images/user5.jpg', 1, '$2a$12$lSj4qRtHg2P5cF33D0lWMOiPl/JPJ2pQ1kH9/wXqfem5qkiQJ1Fzq', 'david_smith', 120),
(6, '6666777888', 'emily.miller@example.com', 'images/user6.jpg', 1, '$2a$12$l9hO7zzLUcJRzUtl9eEjwOLkQFFIXexSVxUPx9paZefb/GBgCGGpm', 'emily_miller', 99),
(7, '8888999000', 'frank.jackson@example.com', 'images/user7.jpg', 1, '$2a$12$xsfCs83AZYz/4CrZ4Bxv/e1QZCsi.i2AVcjBU.gYrrzhzQ5cVxlNe', 'frank_jackson', 24),
(8, '2222333444', 'grace.davis@example.com', 'images/user8.jpg', 3, '$2a$12$MEEvsQIwJk8B4UBO.5h8pO3X.1FsSwOaDJteNXKufXvm1uR28e8Xm', 'grace_davis', 54),
(9, '5555666777', 'harry.anderson@example.com', 'images/user9.jpg', 1, '$2a$12$IAOjfoJ44RIcVNBhHPUt9O7T/4sUV3l9g32GrQqLKRMnbQP6t4/KS', 'harry_anderson', 72),
(10, '9999000111', 'isabel.white@example.com', 'images/user10.jpg', 1, '$2a$12$WI.COfohY2HGSM9MdAdyLeW7VgBEdAcExtvmGVE64eQ9SzhGadFa.', 'isabel_white', 23);

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
(1, 'Pioneering technology solutions for a smarter future.', 'Tech Innovators', 1),
(2, 'Revolutionizing healthcare through cutting-edge biotechnology.', 'BioTech Insights', 2),
(3, 'Sustainable innovations for a greener tomorrow.', 'EcoVision Solutions', 3),
(4, 'Driving the digital transformation with innovation at its core.', 'Digital Dynamics Inc.', 4),
(5, 'Exploring the cosmos with advanced space technology.', 'Space Frontier Technologies', 5),
(6, 'Securing the digital world through groundbreaking cybersecurity.', 'CyberGuard Innovations', 6),
(7, 'Modernizing agriculture for a sustainable future.', 'AgriNexa Innovations', 7),
(8, 'Leading the way in clean and renewable energy solutions.', 'CleanEnergy Systems', 8),
(9, 'Empowering innovation through robotic excellence.', 'FutureMakers Robotics', 9),
(10, 'Elevating aviation with pioneering aerospace technology.', 'AeroTech Ventures', 10);

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `id` bigint(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_disabled` tinyint(1) DEFAULT NULL,
  `is_premium` tinyint(1) DEFAULT NULL,
  `max_spots_count` int(11) DEFAULT NULL,
  `partner_id` bigint(20) DEFAULT NULL,
  `price` decimal(38,2) DEFAULT NULL,
  `spots_taken` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `address`, `is_disabled`, `is_premium`, `max_spots_count`, `partner_id`, `price`, `spots_taken`) VALUES
(1, '1601 Cedar Street', 0, 1, 160, 19, 8.50, 85),
(2, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30),
(3, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30),
(4, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30),
(5, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30),
(6, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30),
(7, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30),
(8, '1701 Elm Street', 1, 0, 70, 20, 9.75, 30);

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
(1, 'John', 'Doe', 1),
(3, 'Sarah', 'Smith', 2),
(4, 'Michael', 'Davis', 3),
(5, 'Emily', 'Wilson', 4),
(6, 'Daniel', 'Brown', 5),
(7, 'Olivia', 'Miller', 6),
(8, 'James', 'Taylor', 7),
(9, 'Sophia', 'Anderson', 8),
(10, 'William', 'Jones', 9),
(11, 'Ava', 'Clark', 10);

-- --------------------------------------------------------

--
-- Table structure for table `premium_subscriptions`
--

CREATE TABLE `premium_subscriptions` (
  `id` bigint(20) NOT NULL,
  `discount_amount` double DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `premium_subscriptions`
--

INSERT INTO `premium_subscriptions` (`id`, `discount_amount`, `end_date`, `client_id`) VALUES
(2, 14.99, '2023-11-05', 1),
(3, 19.99, '2023-12-15', 2),
(4, 12.49, '2023-10-30', 3),
(5, 24.99, '2023-11-25', 4),
(6, 9.99, '2023-11-10', 5),
(7, 17.99, '2023-12-05', 6),
(8, 7.49, '2023-10-20', 7),
(9, 13.99, '2023-11-15', 8),
(10, 29.99, '2023-12-30', 9),
(11, 6.99, '2023-10-15', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `parking_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `description`, `client_id`, `parking_id`) VALUES
(1, 'Reali suka olas tas spots smh..', 1, 1),
(2, 'Reali suka olas tas spots smh..', 1, 2),
(3, 'Reali suka olas tas spots smh..', 1, 3),
(4, 'Reali suka olas tas spots smh..', 1, 4),
(5, 'Reali suka olas tas spots smh..', 1, 5),
(6, 'Reali suka olas tas spots smh..', 1, 6),
(7, 'Reali suka olas tas spots smh..', 1, 7),
(8, 'Reali suka olas tas spots smh..', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `end_time` datetime(6) DEFAULT NULL,
  `parking_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `client_id`, `end_time`, `parking_id`) VALUES
(1, 2, '2023-10-22 10:03:55.000000', 1),
(2, 2, '2023-10-22 10:03:55.000000', 1),
(3, 2, '2023-10-22 10:03:55.000000', 1),
(4, 2, '2023-10-22 10:03:55.000000', 1),
(5, 2, '2023-10-22 10:03:55.000000', 1),
(6, 2, '2023-10-22 10:03:55.000000', 1),
(7, 2, '2023-10-22 10:03:55.000000', 1),
(8, 2, '2023-10-22 10:03:55.000000', 1),
(9, 2, '2023-10-22 10:03:55.000000', 1),
(10, 2, '2023-10-22 10:03:55.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `posted_time` datetime(6) DEFAULT NULL,
  `rating` double NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `parking_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `client_id`, `description`, `posted_time`, `rating`, `title`, `parking_id`) VALUES
(1, 2, 'Really great parking spot !!!', '2023-10-26 02:46:04.000000', 5, 'Great parking spot', 1),
(2, 2, 'Really great parking spot !!!', '2023-10-26 02:46:08.000000', 5, 'Great parking spot', 1),
(3, 2, 'Really great parking spot !!!', '2023-10-26 02:46:09.000000', 5, 'Great parking spot', 1),
(4, 2, 'Really great parking spot !!!', '2023-10-26 02:46:09.000000', 5, 'Great parking spot', 1),
(5, 2, 'Really great parking spot !!!', '2023-10-26 02:46:10.000000', 5, 'Great parking spot', 1),
(6, 2, 'Really great parking spot !!!', '2023-10-26 02:46:11.000000', 5, 'Great parking spot', 1),
(7, 2, 'Really great parking spot !!!', '2023-10-26 02:46:11.000000', 5, 'Great parking spot', 1),
(8, 2, 'Really great parking spot !!!', '2023-10-26 02:46:12.000000', 5, 'Great parking spot', 1),
(9, 2, 'Really great parking spot !!!', '2023-10-26 02:46:13.000000', 5, 'Great parking spot', 1),
(10, 2, 'Really great parking spot !!!', '2023-10-26 03:06:10.000000', 5, 'Great parking spot', 1),
(11, 2, 'Really great parking spot !!!', '2023-10-26 03:06:11.000000', 5, 'Great parking spot', 1),
(12, 2, 'Really great parking spot !!!', '2023-10-26 03:06:11.000000', 5, 'Great parking spot', 1),
(13, 2, 'Really great parking spot !!!', '2023-10-26 03:06:12.000000', 5, 'Great parking spot', 1),
(14, 2, 'Really great parking spot !!!', '2023-10-26 03:06:13.000000', 5, 'Great parking spot', 1),
(15, 2, 'Really great parking spot !!!', '2023-10-26 03:06:13.000000', 5, 'Great parking spot', 1),
(16, 2, 'Really great parking spot !!!', '2023-10-26 03:13:00.000000', 5, 'Great parking spot', 1);

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
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKmiqk34gfam6emk63vq844fem2` (`client_id`),
  ADD KEY `FK721egg36hi82ngdg2rcvv64b0` (`parking_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKsvswfkx1nshsquxwdxu8er0k0` (`parking_id`),
  ADD KEY `FK6lekctbt4u88agg0b7cjsj6lf` (`client_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKjlb9ea856uatbq1py9kqigxli` (`parking_id`),
  ADD KEY `FKo2cmyvyjrvumg4b3de9dcvfxa` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `premium_subscriptions`
--
ALTER TABLE `premium_subscriptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `FK721egg36hi82ngdg2rcvv64b0` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`),
  ADD CONSTRAINT `FKmiqk34gfam6emk63vq844fem2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK6lekctbt4u88agg0b7cjsj6lf` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FKsvswfkx1nshsquxwdxu8er0k0` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FKjlb9ea856uatbq1py9kqigxli` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`),
  ADD CONSTRAINT `FKo2cmyvyjrvumg4b3de9dcvfxa` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
