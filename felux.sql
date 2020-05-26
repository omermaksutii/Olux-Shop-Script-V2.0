-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2020 at 09:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `felux`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text DEFAULT NULL,
  `date` text NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acctype`, `country`, `infos`, `price`, `url`, `sold`, `sto`, `dateofsold`, `date`, `resseller`, `reported`, `sitename`, `login`, `pass`) VALUES
(1, 'account', 'Albania', 'dsfds', 12, 'Nerflix.com | fdsfds ', 1, 'omermaksuti', '2020-03-24 15:22:30', '22/03/2020 02:35:15 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(2, 'account', 'United States', 'Fresh Accounts', 7, 'Nerflix.com | fdsfdsf ', 1, 'omermaksuti', '2020-05-01 18:30:30', '22/03/2020 02:48:12 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(3, 'account', 'United States', 'Fresh Accounts', 4, 'Nerflix.com | fdsfdsfdsadsa ', 1, 'omermaksuti', '2020-04-29 10:09:59', '22/03/2020 02:48:23 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(4, 'account', 'United States', 'Fresh Accounts', 4, 'Nerflix.com | dsadsadsadsa ', 1, 'omermaksuti', '2020-04-05 19:08:37', '22/03/2020 02:48:27 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(5, 'account', 'United States', 'Fresh Accounts', 4, 'Nerflix.com | dsadsadsadsadsadsa ', 0, 'omermaksuti', '2020-04-29 10:09:57', '22/03/2020 02:48:32 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(6, 'account', 'United Arab Emirates', 'Fresh Accounts', 3, 'Nerflix.com | teste@gmail.com Pass: test1233 ', 1, 'omermaksuti', '2020-03-25 12:27:23', '24/03/2020 07:33:16 pm', 'omermaksuti', '', 'Nerflix.com', NULL, NULL),
(8, 'account', 'Albania', 'test upwork', 25, 'Upwork | teste@upwork.com | test ', 1, 'omermaksuti', '2020-05-01 21:13:36', '29/04/2020 10:39:49 am', 'omermaksuti', '', 'Upwork', NULL, NULL),
(11, 'account', 'Albania', 'dsfds', 12, 'Nerflix.com | fdsfds ', 0, 'omermaksuti', '2020-05-05 12:23:51', '22/03/2020 02:35:15 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(12, 'account', 'Albania', 'dsfds', 12, 'Nerflix.com | fdsfds ', 0, 'omermaksuti', '2020-05-04 15:44:04', '01/05/2020 01:01:15 pm', 'fisnik', '', 'Nerflix.com', '', ''),
(13, 'account', 'United Arab Emirates', 'Fresh Accounts', 3, 'Nerflix.com | teste@gmail.com Pass: test1233 ', 0, 'omermaksuti', '2020-03-25 12:27:23', '24/03/2020 07:33:16 pm', 'omermaksuti', '', 'Nerflix.com', NULL, NULL),
(15, 'account', 'Albania', 'Fresh Accounts', 50, 'https://lexoje.al/ | fsfdsfdsf ', 0, '', '0', '08/05/2020 07:35:40 pm', '', '', 'https://lexoje.al/', NULL, NULL),
(16, 'account', 'Albania', 'Fresh Accounts', 50, 'https://lexoje.al/ | fsfdsfdsf ', 0, '', '0', '08/05/2020 08:11:43 pm', '', '', 'https://lexoje.al/', NULL, NULL),
(17, 'account', 'Andorra', 'Fresh Accounts', 56, 'https://lexoje.al/ | fgfdg ', 0, '', '0', '08/05/2020 08:14:50 pm', 'omermaksuti', '', 'https://lexoje.al/', NULL, NULL),
(18, 'account', 'Andorra', 'Fresh Accounts', 56, 'https://lexoje.al/ | fgfdg ', 0, '', '0', '08/05/2020 08:16:01 pm', 'omermaksuti', '', 'https://lexoje.al/', NULL, NULL),
(19, 'account', 'American Samoa', 'dsfds', 5, 'https://lexoje.al/ | fdsaf ', 0, '', '0', '08/05/2020 08:16:26 pm', 'omermaksuti', '', 'https://lexoje.al/', NULL, NULL),
(20, 'account', 'American Samoa', 'dsfds', 15, 'https://lexoje.al/ | dfgsdfgfdgsfd ', 0, '', '0', '13/05/2020 01:30:46 am', 'omermaksuti', '', 'https://lexoje.al/', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `price` int(11) NOT NULL,
  `url` text NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL DEFAULT current_timestamp(),
  `date` text NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(255) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `acctype`, `country`, `infos`, `price`, `url`, `sold`, `sto`, `dateofsold`, `date`, `resseller`, `reported`, `bankname`, `balance`) VALUES
(1, 'banks', 'Germany', 'Fresh Accounts', 5, 'Kreis-Sparkasse Northeim | \r\nName	Hans-Walter Weigel\r\nAdresse	Brandenburgische Str 112\r\nStadt	55619 Hennweiler\r\nTelefon	00/4414371\r\nGeburtsdatum	27/07/1964\r\nEmail	hans-walter.weigel@gmx.de\r\nAusweisnummer	4431427391<<D<<6407276<2607274<<<<<<<0\r\nAblaufdatum	27/07/2026\r\nBank	Kreis-Sparkasse Northeim\r\nBLZ	26250001\r\nKontonummer	5495301235\r\nIBAN	\r\nDE80262500015495301235\r\n(Valid Check)\r\nBIC	\r\nCC.	Mastercard\r\nNo.	5232067330908730\r\nCVV2	451\r\nExp	08/23 ', 0, '', '', '24/03/2020 07:36:43 pm', 'omermaksuti', '', 'Kreis-Sparkasse Northeim', 10),
(2, 'banks', 'Germany', 'Fresh Accounts', 5, 'Kreis-Sparkasse Northeim | \r\nName	Hans-Walter Weigel\r\nAdresse	Brandenburgische Str 112\r\nStadt	55619 Hennweiler\r\nTelefon	00/4414371\r\nGeburtsdatum	27/07/1964\r\nEmail	hans-walter.weigel@gmx.de\r\nAusweisnummer	4431427391<<D<<6407276<2607274<<<<<<<0\r\nAblaufdatum	27/07/2026\r\nBank	Kreis-Sparkasse Northeim\r\nBLZ	26250001\r\nKontonummer	5495301235\r\nIBAN	\r\nDE80262500015495301235\r\n(Valid Check)\r\nBIC	\r\nCC.	Mastercard\r\nNo.	5232067330908730\r\nCVV2	451\r\nExp	08/23 ', 0, '', '', '24/03/2020 07:36:43 pm', 'omermaksuti', '', 'Kreis-Sparkasse Northeim', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cpanels`
--

CREATE TABLE `cpanels` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` timestamp NOT NULL DEFAULT current_timestamp(),
  `resseller` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reported` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL,
  `date` text NOT NULL,
  `number` text NOT NULL,
  `reported` text NOT NULL,
  `login` text DEFAULT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `acctype`, `country`, `infos`, `url`, `price`, `resseller`, `sold`, `sto`, `dateofsold`, `date`, `number`, `reported`, `login`, `pass`) VALUES
(1, 'leads', 'United States', 'Hotmail SHOP', 'https://google.com/', 3, 'omermaksuti', 1, 'omermaksuti', '2020-03-24 19:45:22', '24/03/2020 07:42:23 pm', '5k', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mailers`
--

CREATE TABLE `mailers` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateofsold` timestamp NOT NULL DEFAULT current_timestamp(),
  `reported` varchar(255) NOT NULL,
  `sto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `username`, `password`) VALUES
(1, 'omermaksuti', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date`) VALUES
(1, 'NEWS BUYER', 'Bugs Updated', '2020-03-24 02:28:56'),
(2, 'NEWS BUYER', 'New Accounts Addeded', '2020-03-24 02:29:14'),
(3, 'NEWS BUYER', 'Bugs Fixed!', '2020-03-24 02:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `newseller`
--

CREATE TABLE `newseller` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newseller`
--

INSERT INTO `newseller` (`id`, `title`, `content`, `date`) VALUES
(1, 'NEWS BUYER', 'Bugs Updated', '2020-03-24 02:28:56'),
(2, 'NEWS BUYER', 'New Accounts Addeded', '2020-03-24 02:29:14'),
(3, 'NEWS BUYER', 'Bugs Fixed!', '2020-03-24 02:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `amountusd` int(11) NOT NULL,
  `address` text NOT NULL,
  `p_data` text NOT NULL,
  `state` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user`, `method`, `amount`, `amountusd`, `address`, `p_data`, `state`, `date`) VALUES
(NULL, 'omermaksuti', 'Bitcoin', 0, 20, '3QQuujhjrfxxF6Z2ysY7rS4q881kPCNNCT', '22cad767b7f7d98c44ce29b34d573a87', 'pending', '2020/03/24 07:54:49'),
(NULL, 'omermaksuti', 'Bitcoin', 0.00375516, 25, '363R6Xfxv9eRo7rmgg7xb4WNxTvGQ4PDu2', 'bcdc521559b4bc0db3aa562d7d876c0b', 'pending', '2020/03/25 06:53:26'),
(NULL, 'omermaksuti', 'Bitcoin', 0.00289333, 20, '', '99b7e8afbf201806a4d212d8078ef2a8', 'pending', '2020/04/14 08:14:12'),
(NULL, 'omermaksuti', 'Bitcoin', 0.00289333, 20, '', '2bebf587e4d082c648c5748b2f6b1245', 'pending', '2020/04/14 08:14:30'),
(NULL, 'omermaksuti', 'Bitcoin', 0.00289333, 20, '', '3b9ecd210b05debf80b2095bb7ec7fb4', 'pending', '2020/04/14 08:14:42'),
(NULL, 'omermaksuti', 'PerfectMoney', 0.00250709, 20, '', '783d6f5e35851d0e49c8495209c06d5e', 'pending', '2020/04/29 09:57:04'),
(NULL, 'omermaksuti', 'Bitcoin', 0.00251983, 25, '', '04a97116c31b9694dcc296f890a3a998', 'pending', '2020/05/08 11:53:33'),
(NULL, 'omermaksuti', 'Bitcoin', 0.00201999, 20, '', '1a819af3f5456c8b1a6b049b3eb10f7b', 'pending', '2020/05/08 11:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `country` varchar(255) NOT NULL,
  `infos` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(100) NOT NULL,
  `reportid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `s_id`, `buyer`, `type`, `date`, `country`, `infos`, `url`, `login`, `pass`, `price`, `resseller`, `reported`, `reportid`) VALUES
(1, 8, 'fisnik', 'netflix', '2020-03-24 14:45:24', 'kosovo', 'hfjkdshfdsjk', 'hkjshfkdsj', 'hfbkdsjhkj', 'hfjkdshfkj', 10, 'omermaksuti', '', 0),
(2, 2, 'fisnik', 'nerflix', '2020-03-24 14:15:28', 'albania', 'shkruj', 'hgdsjagdhjsa', 'test', 'test', 10, 'fisnik', '', NULL),
(3, 3, 'omermaksuti', 'account', '2020-03-24 14:21:50', 'United States', 'Fresh Accounts', 'Nerflix.com | fdsfdsfdsadsa ', '', '', 4, 'fisnik', '', NULL),
(4, 1, 'omermaksuti', 'account', '2020-03-24 14:22:30', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(5, 1, 'omermaksuti', 'leads', '2020-03-24 18:45:22', 'United States', 'Hotmail SHOP', 'https://google.com/', '', '', 3, 'omermaksuti', '', NULL),
(6, 6, 'omermaksuti', 'account', '2020-03-25 11:27:23', 'United Arab Emirates', 'Fresh Accounts', 'Nerflix.com | teste@gmail.com Pass: test1233 ', '', '', 3, 'omermaksuti', '', NULL),
(7, 4, 'omermaksuti', 'account', '2020-04-05 17:08:37', 'United States', 'Fresh Accounts', 'Nerflix.com | dsadsadsadsa ', '', '', 4, 'fisnik', '', NULL),
(8, 7, 'omermaksuti', 'account', '2020-04-29 08:09:32', 'American Samoa', 'Fresh Accounts', 'Nerflix.com | fdsfdsf fdsgf ', '', '', 5, 'omermaksuti', '', NULL),
(9, 2, 'omermaksuti', 'account', '2020-04-29 08:09:55', 'United States', 'Fresh Accounts', 'Nerflix.com | fdsfdsf ', '', '', 7, 'fisnik', '', NULL),
(10, 5, 'omermaksuti', 'account', '2020-04-29 08:09:57', 'United States', 'Fresh Accounts', 'Nerflix.com | dsadsadsadsadsadsa ', '', '', 4, 'fisnik', '', NULL),
(11, 3, 'omermaksuti', 'account', '2020-04-29 08:09:59', 'United States', 'Fresh Accounts', 'Nerflix.com | fdsfdsfdsadsa ', '', '', 4, 'fisnik', '', NULL),
(12, 9, 'omermaksuti', 'account', '2020-04-29 08:40:25', 'Albania', 'Fresh Accounts', 'Upwork | test test ', '', '', 15, 'omermaksuti', '', NULL),
(13, 2, 'omermaksuti', 'account', '2020-05-01 16:30:30', 'United States', 'Fresh Accounts', 'Nerflix.com | fdsfdsf ', '', '', 7, 'fisnik', '', NULL),
(14, 8, 'omermaksuti', 'account', '2020-05-01 16:31:00', 'Albania', 'test upwork', 'Upwork | teste@upwork.com | test ', '', '', 25, 'omermaksuti', '', NULL),
(15, 9, 'omermaksuti', 'account', '2020-05-01 16:51:15', 'Albania', 'Fresh Accounts', 'Upwork | test test ', '', '', 15, 'omermaksuti', '', NULL),
(16, 12, 'omermaksuti', 'account', '2020-05-01 19:09:33', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(17, 11, 'omermaksuti', 'account', '2020-05-01 19:09:34', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(18, 10, 'omermaksuti', 'account', '2020-05-01 19:09:35', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(19, 8, 'omermaksuti', 'account', '2020-05-01 19:13:36', 'Albania', 'test upwork', 'Upwork | teste@upwork.com | test ', '', '', 25, 'omermaksuti', '', NULL),
(20, 10, 'omermaksuti', 'account', '2020-05-01 19:15:02', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(21, 12, 'omermaksuti', 'account', '2020-05-04 13:44:04', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(22, 11, 'omermaksuti', 'account', '2020-05-05 10:23:51', 'Albania', 'dsfds', 'Nerflix.com | fdsfds ', '', '', 12, 'fisnik', '', NULL),
(23, 9, 'omermaksuti', 'account', '2020-05-06 21:33:50', 'Albania', 'Fresh Accounts', 'Upwork | test test ', '', '', 15, 'omermaksuti', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rdps`
--

CREATE TABLE `rdps` (
  `id` int(11) DEFAULT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `hosting` varchar(255) NOT NULL,
  `ram` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `uid` varchar(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `acctype` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `orderid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `lastreply` text NOT NULL,
  `lastup` text NOT NULL,
  `resseller` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resseller`
--

CREATE TABLE `resseller` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `unsoldb` int(11) NOT NULL,
  `soldb` int(11) NOT NULL,
  `isold` int(11) NOT NULL,
  `iunsold` int(11) NOT NULL,
  `activate` text NOT NULL,
  `btc` text NOT NULL,
  `withdrawal` text NOT NULL,
  `allsales` int(11) DEFAULT NULL,
  `lastweek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resseller`
--

INSERT INTO `resseller` (`id`, `username`, `unsoldb`, `soldb`, `isold`, `iunsold`, `activate`, `btc`, `withdrawal`, `allsales`, `lastweek`) VALUES
(1, 'omermaksuti', 0, 106, 0, 0, '24/03/2020 04:19:53 pm', '', '', NULL, 20),
(2, 'fisnik', 0, 98, 0, 0, '2020/03/24 07:28:34', '', '', NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `scampages`
--

CREATE TABLE `scampages` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` text NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL,
  `date` text NOT NULL,
  `scamname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scampages`
--

INSERT INTO `scampages` (`id`, `acctype`, `country`, `infos`, `url`, `price`, `resseller`, `sold`, `sto`, `dateofsold`, `date`, `scamname`) VALUES
(1, 'scampage', '-', 'Fresh Accounts', 'https://google.com/', 12, 'omermaksuti', 0, 'omermaksuti', '2020-04-29 10:11:45', '24/03/2020 07:40:30 pm', 'PayPal ScamPage');

-- --------------------------------------------------------

--
-- Table structure for table `smtps`
--

CREATE TABLE `smtps` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `price` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `resseller` varchar(255) NOT NULL,
  `reported` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stufs`
--

CREATE TABLE `stufs` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `date` text NOT NULL,
  `dateofsold` text NOT NULL,
  `reported` varchar(255) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `domain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `s_url` text NOT NULL,
  `memo` text NOT NULL,
  `acctype` int(11) NOT NULL,
  `admin_r` int(11) NOT NULL,
  `date` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resseller` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `refounded` varchar(255) NOT NULL,
  `fmemo` text NOT NULL,
  `seen` int(11) NOT NULL,
  `lastreply` varchar(255) NOT NULL,
  `lastup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `uid`, `status`, `s_id`, `s_url`, `memo`, `acctype`, `admin_r`, `date`, `subject`, `type`, `resseller`, `price`, `refounded`, `fmemo`, `seen`, `lastreply`, `lastup`) VALUES
(1, 'omermaksuti', 1, 8, 'fbdsnfbdsmn', 'fbdnmsfbmdns<div class=\"panel panel-default\"><div class=\"panel-body\"><div class=\"ticket\"><b>hkjfdkjs\r\n</b></div></div><div class=\"panel-footer\"><div class=\"label label-warning\">Support</div> - 24/03/2020 04:19:53 pm</div></div>', 2, 2, '10.03.2020', 'fndsbfnmdsfbnm', 'Account', 22, 50, 'fdsfdsfdsf', 'fdsfds', 0, 'Support', '24/03/2020 04:19:53 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` int(11) NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` text NOT NULL,
  `date` text NOT NULL,
  `tutoname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `acctype`, `country`, `infos`, `url`, `price`, `resseller`, `sold`, `sto`, `dateofsold`, `date`, `tutoname`) VALUES
(1, 'tutorial', '-', 'Amazon GiftCards method Fresh March 2020', 'https://google.com/', 15, 'omermaksuti', 0, '', '', '24/03/2020 07:38:01 pm', 'Amazon.de');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `balance` int(11) DEFAULT 0,
  `ipurchassed` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `lastlogin` date DEFAULT NULL,
  `datereg` date DEFAULT NULL,
  `resseller` int(11) NOT NULL,
  `img` text DEFAULT NULL,
  `testemail` varchar(255) DEFAULT NULL,
  `resetpin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `balance`, `ipurchassed`, `ip`, `lastlogin`, `datereg`, `resseller`, `img`, `testemail`, `resetpin`) VALUES
(9, 'omermaksuti', 'cVZodkZROG9zcTZFVjFhOEVQMHZaUT09', 'omeri@gmai.com', 141, '37', '::1', '2020-03-22', '2020-03-22', 1, '', 'omermaksuti@yandex.com', 0),
(11, 'fisnik', 'by9aR2kzbm9VMW15ZnVrWGJ4QlVnZz09', 'omermma@gmail.com', 0, '0', '::1', '2020-03-24', '2020-03-24', 1, '', 'omermma@gmail.com', 0),
(12, 'testbaba', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09', 'omertest@gmail.com', 0, '0', '::1', '2020-03-29', '2020-03-29', 0, '', 'omertest@gmail.com', 0),
(13, 'tesnew', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09', 'testts@gmail.com', 0, '0', '::1', '2020-03-29', '2020-03-29', 0, '', 'testts@gmail.com', 0),
(14, 'testts', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09', 'test@upwork.com', 0, '0', '::1', '2020-04-29', '2020-04-29', 0, '', 'test@upwork.com', 0),
(15, 'upwork', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09', 'tests@upwork.com', 0, '0', '::1', '2020-04-29', '2020-04-29', 0, '', 'tests@upwork.com', 0),
(16, 'Kaveci', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09', 'omerbababs@umib.net', 0, '0', '::1', '2020-05-01', '2020-05-01', 0, '', 'omerbababs@umib.net', 0),
(17, 'testets', 'dXUyb1lYN1hIWVBuTVluOHVtT2JFZz09', 'omermaksuthfkjdh@gmail.com', 0, '0', '::1', '2020-05-06', '2020-05-06', 0, '', 'omermaksuthfkjdh@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpanels`
--
ALTER TABLE `cpanels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailers`
--
ALTER TABLE `mailers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newseller`
--
ALTER TABLE `newseller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resseller`
--
ALTER TABLE `resseller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scampages`
--
ALTER TABLE `scampages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtps`
--
ALTER TABLE `smtps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stufs`
--
ALTER TABLE `stufs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cpanels`
--
ALTER TABLE `cpanels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mailers`
--
ALTER TABLE `mailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newseller`
--
ALTER TABLE `newseller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `resseller`
--
ALTER TABLE `resseller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scampages`
--
ALTER TABLE `scampages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtps`
--
ALTER TABLE `smtps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stufs`
--
ALTER TABLE `stufs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
