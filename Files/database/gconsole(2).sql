-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2025 at 04:09 PM
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
-- Database: `gconsole`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `audit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `code` text NOT NULL,
  `longdesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`audit_id`, `user_id`, `date`, `code`, `longdesc`) VALUES
(1, 12, '2025-10-09', 'reg', 'new user registered'),
(2, 1, '2025-10-09', 'log', 'user has successfully logged in'),
(3, 1, '2025-10-09', 'log', 'console successfully registered'),
(4, 1, '2025-10-09', 'log', 'user has successfully logged in'),
(5, 1, '2025-10-09', 'log', 'user has successfully logged out');

-- --------------------------------------------------------

--
-- Table structure for table `console`
--

CREATE TABLE `console` (
  `console_id` int(11) NOT NULL,
  `manufacturer` text NOT NULL,
  `c_name` text NOT NULL,
  `relse_date` text NOT NULL,
  `controller_no` int(11) NOT NULL,
  `bit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `console`
--

INSERT INTO `console` (`console_id`, `manufacturer`, `c_name`, `relse_date`, `controller_no`, `bit`) VALUES
(1, 'nintendo', 'nintendo switch ', '20/03/2000', 1, 1),
(2, 'nintendo', 'switch 2', '29/07/2001', 2, 2),
(3, 'Xbox', 'Xbox 2', '11/02/2008', 3, 3),
(4, 'xbox', 'xbox series x', '11/07/2009', 4, 4),
(5, 'playstation', 'playstation 1', '01/01/1999', 5, 5),
(6, 'playstation', 'playstation 2', '02/02/2001', 6, 6),
(7, 'xbox', 'xbox 5', '22/10/2010', 3, 4),
(8, 'xbox', 'xbox 9', '22/10/2010', 6, 18),
(9, 'playstatin', 'playstation 7', '22/10/2010', 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE `owns` (
  `owns_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buy_date` text NOT NULL,
  `link_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns`
--

INSERT INTO `owns` (`owns_id`, `console_id`, `user_id`, `buy_date`, `link_date`) VALUES
(1, 1, 4, '25/09/2025', '25/09/2025'),
(2, 2, 4, '25/09/2025', '25/09/2025'),
(3, 3, 4, '25/09/2025', '25/09/2025'),
(4, 6, 4, '25/09/2025', '25/09/2025'),
(7, 5, 4, '25/09/2025', '25/09/2025'),
(8, 3, 4, '25/09/2025', '25/09/2025'),
(9, 4, 4, '25/09/2025', '25/09/2025'),
(10, 2, 1, '25/09/2024', '25/09/2024'),
(11, 3, 1, '25/09/2024', '25/09/2024'),
(12, 5, 3, '25/01/2025', '25/01/2025'),
(13, 6, 3, '25/07/2025', '25/07/2025'),
(14, 4, 5, '06/09/2023', '06/09/2023'),
(15, 1, 5, '06/09/2025', '06/09/2025'),
(16, 5, 2, '25/09/2025', '25/09/2025'),
(17, 4, 2, '25/09/2025', '25/09/2025'),
(18, 3, 6, '25/07/2022', '25/07/2022'),
(19, 1, 6, '28/07/2022', '28/07/2022');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `sign_up_date` text NOT NULL,
  `d_o_b` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `sign_up_date`, `d_o_b`, `country`) VALUES
(1, 'barry', 'barry123', '02/09/2006', '01/03/1990', 'new zeland'),
(2, 'steve', 'steve123', '12/03/1999', '13/03/1986', 'japan'),
(3, 'bob', 'hello123', '18/05/2009', '30/11/2006', 'cuba'),
(4, 'james', 'gellos456', '26/08/2010', '04/06/2009', 'england'),
(5, 'goerge', 'uk678', '30/10/2000', '10/10/1979', 'england'),
(6, 'tom', 'toms/56', '07/07/2009', '07/07/2000', 'sealand'),
(7, 'lucy', '$2y$10$b6B3nZyN3kwp86mo0sTvbe8Dn36bwcOqujwdkf2JYRiIQki1e11EC', '26/09/2025', '15/02/2008', 'england'),
(10, 'ollie', '$2y$10$jYtlO2OU4F5HoYBjklChbO39T9/kW2AleX86xgfOkB4SFpZlhUQ4e', '26/08/2010', '15/02/2008', 'england'),
(12, 'maryam', '$2y$10$3Jn5gC2PtfvRgwNuZUioSuViKWwhAiKNS9cfRRzHNZjHTMupnZFkG', '26/08/2010', '15/02/2008', 'england');

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
-- Indexes for table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`console_id`);

--
-- Indexes for table `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`owns_id`),
  ADD KEY `console_id` (`console_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `console`
--
ALTER TABLE `console`
  MODIFY `console_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owns`
--
ALTER TABLE `owns`
  MODIFY `owns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`console_id`) REFERENCES `console` (`console_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
