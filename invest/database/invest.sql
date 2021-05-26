-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2021 at 09:53 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invest`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE IF NOT EXISTS `deposits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `MerchantRequestID` varchar(250) NOT NULL,
  `CheckoutRequestID` varchar(250) NOT NULL,
  `response_code` int(11) NOT NULL,
  `response_message` varchar(200) NOT NULL,
  `time` varchar(300) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_code` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `MerchantRequestID`, `CheckoutRequestID`, `response_code`, `response_message`, `time`, `phone`, `amount`, `transaction_code`) VALUES
(1, 1, '8061-338473-1', 'ws_CO_20052021113532578105', 0, 'The service request is processed successfully.', '2021-05-20 at 11:47:59', '254708552578', 1, 'PEK663VK4W'),
(2, 1, '2504-446353-1', 'ws_CO_20052021132119941066', 0, 'The service request is processed successfully.', '2021-05-20 at 13:21:34', '254708552578', 1, 'PEK468KPK0'),
(3, 5, '30805-1480068-1', 'ws_CO_21052021091616138417', 0, 'The service request is processed successfully.', '2021-05-20 at 22:25:38', '254705557746', 1, 'PEL878HQY6'),
(4, 5, '30794-1490205-1', 'ws_CO_21052021092626697624', 0, 'The service request is processed successfully.', '2021-05-20 at 22:35:56', '254701403708', 10, 'PEL778WN11'),
(5, 6, '2515-1444869-1', 'ws_CO_21052021093243431443', 0, 'The service request is processed successfully.', '2021-05-20 at 22:42:09', '254701403708', 1, 'PEL4795PLM'),
(6, 6, '107956-438099-1', 'ws_CO_24052021154328939537', 0, 'The service request is processed successfully.', '2021-05-24 at 15:43:18', '254701403708', 2, 'PEO2BL2OJA');

-- --------------------------------------------------------

--
-- Table structure for table `interest_earnings`
--

DROP TABLE IF EXISTS `interest_earnings`;
CREATE TABLE IF NOT EXISTS `interest_earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `msg` text NOT NULL,
  `msg_read` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL DEFAULT 'out',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `receiver` varchar(20) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `receiver_id`, `subject`, `msg`, `msg_read`, `tag`, `date`, `time`, `receiver`) VALUES
(1, 1, 3, 'Test Sbj', 'A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture\r\nA collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture\r\nA collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture', 1, 'out', '2021-05-25', '14:24:00', 'admi'),
(2, 2, NULL, 'Account Opening', 'How do I get my account activated please?', 1, 'out', '2021-05-26', '10:16:01', 'admin'),
(3, 2, NULL, 'Password Reset', 'Kindly reset my password', 1, 'out', '2021-05-26', '10:41:56', 'admin'),
(4, 1, 2, 'Password Reset', 'This id done', 1, 'out', '2021-05-26', '11:27:47', 'user'),
(5, 3, NULL, 'Test', 'Test Message', 1, 'out', '2021-05-26', '12:33:27', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `details` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `days` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `details`, `amount`, `days`) VALUES
(1, 'Basic', 'Earn an interest of 10% daily.', 500, 100),
(2, 'Advanced', 'Advanced plan. Earn an interest of 10% daily.', 1000, 100),
(4, 'Gold', 'this is a gold package', 1500, 100);

-- --------------------------------------------------------

--
-- Table structure for table `package_users`
--

DROP TABLE IF EXISTS `package_users`;
CREATE TABLE IF NOT EXISTS `package_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `last_update` datetime DEFAULT NULL,
  `day` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_users`
--

INSERT INTO `package_users` (`id`, `user_id`, `package_id`, `start_date`, `amount`, `status`, `last_update`, `day`) VALUES
(1, 3, 1, '2021-05-14 17:08:14', 50, 1, '2021-05-25 15:00:00', 11),
(2, 1, 1, '2021-05-16 04:00:25', 50, 1, '2021-05-23 04:00:25', 8),
(12, 3, 2, '2021-05-20 16:16:34', 100, 1, '2021-05-25 16:16:34', 5),
(4, 5, 2, '2021-05-19 16:02:40', 100, 1, '2021-05-20 16:45:00', 1),
(14, 6, 1, '2021-05-21 09:59:52', 50, 1, '2021-05-24 10:15:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

DROP TABLE IF EXISTS `referrals`;
CREATE TABLE IF NOT EXISTS `referrals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `referrer` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `user_id`, `referrer`, `level`, `amount`) VALUES
(1, 2, 1, 1, 0),
(2, 3, 2, 1, 80),
(3, 3, 1, 2, 20),
(4, 5, 4, 1, 80),
(5, 7, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `referral_bonus`
--

DROP TABLE IF EXISTS `referral_bonus`;
CREATE TABLE IF NOT EXISTS `referral_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `wallet` int(11) NOT NULL DEFAULT '0',
  `deposit` int(11) NOT NULL DEFAULT '0',
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `refer` varchar(30) DEFAULT NULL,
  `mpesaId` varchar(255) DEFAULT NULL,
  `interest` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `wallet`, `deposit`, `role`, `active`, `country`, `date`, `refer`, `mpesaId`, `interest`) VALUES
(1, 'First', 'dennis.onkeo81@gmail.com', 'user1', '$2y$10$jXgDi9jZSloAyPGxaQCqKOS3bXRFA.C5VpVARbLs2xlLTFqHmWU9m', '0799912129', 710, 150, 'admin', 0, 'Kenya', '2021-05-11', '', '2504-446353-1', 1000),
(2, 'Demo User2', 'dennis.onkeo81@gmail.com', 'user2', '$2y$10$jXgDi9jZSloAyPGxaQCqKOS3bXRFA.C5VpVARbLs2xlLTFqHmWU9m', '254758512129', 681, 100, 'user', 0, 'Tanzania', '2021-05-14', '1', NULL, 0),
(3, 'Demo User3', 'user3@gmail.com', 'user3', '$2y$10$jXgDi9jZSloAyPGxaQCqKOS3bXRFA.C5VpVARbLs2xlLTFqHmWU9m', '99912129', 600, 200, 'user', 0, 'Ugand', '2021-05-14', '2', NULL, 850),
(4, 'hittmeyer Nyabuto', 'hittmeyer@gmail.com', 'hittmeyer', '$2y$10$duFDEcXjACDZCrg8y..iz.eUCkIkawKp/3/syK9Ul6T8rvGO/k.VK', '0701403708', 1430, 500, 'admin', 0, 'Kenya', '2021-05-19', '', '44915-729614-1', 0),
(5, 'webster webster', 'webster@gmail.com', 'webster', '$2y$10$lI6kEbFF7TEyh1BQ6vlF.u8Q3X/Q9VkPv6OO4RuJKteHQQybbtorO', '0705557746', 1000, 411, 'user', 0, 'Kenya', '2021-05-19', '4', '30794-1490205-1', 400),
(6, 'Test1u', 'test@gmail.com', 'Test', '$2y$10$t0ahSE4ZKWHBCeGX0tws2OvdH5ZL0kJiJ8KcMkB2/86p4M81/TMzu', '0701403709', 14400, 2003, 'user', 0, 'Kenya', '2021-05-20', '', '107956-438099-1', 100),
(7, 'Test2', 'test2@gmail.com', 'Test2', '$2y$10$FeIGetjDGR/Lwt6VXx2PJeF17.gMZPkVY9LUbagSKgCzqysiCP.xi', '0701403707', 0, 0, 'user', 0, 'Kenya', '2021-05-21', '6', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `amount`, `status`, `date`) VALUES
(1, 1, 300, 0, '2021-05-20 11:04:59'),
(2, 6, 500, 1, '2021-05-24 15:48:49'),
(3, 6, 5600, 0, '2021-05-24 16:09:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
