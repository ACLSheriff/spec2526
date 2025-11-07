-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 11:25 AM
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
-- Database: `med_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `audit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `longdesc` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`audit_id`, `user_id`, `code`, `longdesc`, `date`) VALUES
(1, 1, 'reg', 'new user registered', '2025-10-10'),
(2, 1, 'log', 'user has successfully logged in', '2025-10-10'),
(3, 2, 'reg', 'new user registered', '2025-10-13'),
(6, 24, 'reg', 'new user registered', '2025-10-13'),
(7, 2, 'reg', 'new user registered', '2025-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `time` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `staff_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `surname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `room` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`staff_id`, `role`, `surname`, `username`, `password`, `room`) VALUES
(1, 'doc', 'timmothy', 'doctortim', '$2y$10$mHhuu019O5Vl.nMxhY5WPuCeLNXxS2/FAeBZdE31UDdECv6dGRgey', '2025-10-14'),
(2, 'doc', 'timmothy', 'doctorgarry', '$2y$10$/QfdfezLvBo0JYFCVImfS.jWDSMQJ42f6g08i6u4QRitmnJOpU5Nm', '10'),
(3, 'doc', 'smith', 'myguy', '$2y$10$DtPsl18EbUJ9cK4wE5PWA.o62wCO38PI9Z3v.LMfUX7YF7ILCvPCC', '13'),
(4, 'doc', 'richord', 'docterwill', '$2y$10$RBGoBKZrI9UBeOUqFUkz9OeQHg4jwMipw4DBeMtZhwaGToMf7RNYG', '2');

-- --------------------------------------------------------

--
-- Table structure for table `staff_audit`
--

CREATE TABLE `staff_audit` (
  `staff_audit_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `longdesc` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_audit`
--

INSERT INTO `staff_audit` (`staff_audit_id`, `staff_id`, `code`, `longdesc`, `date`) VALUES
(1, 4, 'reg', 'new user registered', '2025-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `first_name` text NOT NULL,
  `surname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `d_o_b` text NOT NULL,
  `adress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `surname`, `username`, `password`, `user_id`, `d_o_b`, `adress`) VALUES
('ava', 'sheriff', 'avas', '$2y$10$ZKloeVAKPI1o384CfKcOSuYbBOr.6CiJIe5O104I5KkZ3PmmQwpKq', 1, '15/02/2008', 'hello'),
('maryam', 'sheriff', 'maryams', '$2y$10$CamwVS9Twu9YzlgqpbpyNe1EA6QdlHB6DTSe2u.4uUKEfiemkfXF2', 2, '2025-10-13', 'hello'),
('james', 'jenkins', 'jamesj', '$2y$10$HUJBodr.RggDvV6jxLXBXO8027Fda9AUceVwzdaI8KPaVl3iVwsSO', 3, '2025-10-13', 'hello'),
('tom', 'jenkins', 'tomj', '$2y$10$BCX7STvB.4LJ.8jkMgoqwuTwuyxeqr1fQXcp3QJmHZExOcV97v.sG', 4, '2025-10-13', 'hello'),
('laura', 'fansworth', 'lauraf', '$2y$10$HVW.0GCWVxLEn5vSTWDPeum6fnIvej9mIl9WbAnXGXnaL1PNmT4Kq', 5, '2025-10-13', 'hello'),
('rod', 'sheriff', 'rods', '$2y$10$jiI799hL48V7mM3Wp4y/TeyrnKCskFKDsHd3qE6uBMAT7vYshGUda', 6, '2025-10-13', 'hello'),
('tom', 'jenkins', 'tomj', '$2y$10$ui/.hvwgpOHT8B4Liwo1Nuu948LkohJnjeguei80LLY1qC82XBnqa', 8, '2025-10-13', 'hello'),
('laura', 'fansworth', 'lauraf', '$2y$10$.4g3TwP8x75O1T6PqFvZcuj2oY6pt2AAAGW7.XAIot4puXK.cgxWK', 10, '2025-10-13', 'hello'),
('ava()', 'sheriff....S', '22sherifa<heelooo>', '$2y$10$2v1HZ6pVBGF7Y73SN1yDnus8v5EvJXN7kI2LXyQF.NOjOGCT9Uv66', 22, '2025-10-13', 'hellohttps://www.google.com/?safe=active&ssui=on'),
('ava()', 'sheriff....S', '22sherifaheelooo', '$2y$10$.Gll2xas185yb3wyAYdHxOWMQ47/yMcGbp7yeuC6UyqAKQFNdXyJq', 24, '2025-10-13', 'hellohttps://www.google.com/?safe=active&ssui=on');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`audit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `staff_audit`
--
ALTER TABLE `staff_audit`
  ADD PRIMARY KEY (`staff_audit_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_audit`
--
ALTER TABLE `staff_audit`
  MODIFY `staff_audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `doctors` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_audit`
--
ALTER TABLE `staff_audit`
  ADD CONSTRAINT `staff_audit_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `doctors` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
