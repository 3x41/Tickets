-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 12:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('open','closed','resolved','hold') NOT NULL DEFAULT 'open',
  `assigned` varchar(50) DEFAULT NULL,
  `resolved` datetime DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `msg`, `email`, `created`, `status`, `assigned`, `resolved`, `department`, `location`) VALUES
(1, 'Test Ticket', 'This is your first ticket.', 'support@codeshack.io', '2020-06-10 13:06:17', 'closed', 'alex', '2022-01-13 00:00:00', NULL, NULL),
(2, 'rewrew', 'rew', 'ffds@Fds.com', '2022-01-09 21:07:35', 'closed', 'aa', NULL, NULL, NULL),
(3, 'test', 'sdadsa', 'test@te.com', '2022-01-09 21:17:58', 'hold', 'open', NULL, NULL, NULL),
(4, 'This is a test title', 'sdjkaldjal dasj ddjsla djskl dsajkl jkljkl adas asj ajdas\r\nd sdjska lklas ja a\r\ns\r\nd sadas das \r\nas dsjakldjskljdlkajskdj kl\r\n s', 'as@as.com', '2022-01-09 21:28:56', 'resolved', 'alex', NULL, NULL, NULL),
(5, 'cc', 'cxz', 'c@cx.com', '2022-01-09 21:50:41', 'open', 'alex', NULL, NULL, NULL),
(6, 'This is asas ', 'dssa', 'dsa@dsa.com', '2022-01-09 22:21:59', 'closed', 'alex', NULL, NULL, NULL),
(7, 'ss', 'ss', 'ss@ss.com', '2022-01-11 00:06:31', 'open', 'aa', NULL, NULL, NULL),
(8, 'lll', 'xzxz', 'll@ll.com', '2022-01-11 22:06:49', 'closed', 'alex', NULL, NULL, NULL),
(9, 'aaaaaaaaaaaaaaaaa', 'aaaaaaa', 'ss@ss.com', '2022-01-11 22:09:17', 'hold', 'alex', NULL, NULL, NULL),
(10, 'w', 'TEST', 'ss@ss.com', '2022-01-11 23:45:15', 'open', 'aa', NULL, NULL, NULL),
(11, 'vcv', 'dsdsa', 'vcx@vcx.com', '2022-01-12 21:48:15', 'open', 'aa', NULL, NULL, NULL),
(12, 'ssssss', 'qqqqqqqqqqqqqqq', 'ss@ss.com', '2022-01-12 22:49:03', 'open', 'alex', NULL, NULL, NULL),
(13, 'New ticket in', 'This is a test', 'a@a.com', '2022-01-13 22:25:36', 'closed', NULL, '2022-01-13 00:00:00', NULL, NULL),
(14, 's', 'saa', 'ss@ss.com', '2022-01-13 22:31:16', 'open', NULL, NULL, NULL, NULL),
(15, 'dsad', 'ccccccccccccccc', 'cookloz@aol.com', '2022-01-13 23:21:53', 'open', 'alex', NULL, NULL, NULL),
(16, 'qqqqq', 'qqqq', 'cookloz@aol.com', '2022-01-13 23:25:34', 'closed', '', '2022-01-13 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_comments`
--

CREATE TABLE `tickets_comments` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `assigned` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets_comments`
--

INSERT INTO `tickets_comments` (`id`, `ticket_id`, `msg`, `created`, `assigned`) VALUES
(1, 1, 'This is a test comment.', '2020-06-10 16:23:39', NULL),
(2, 2, 'dadasdas', '2022-01-09 21:07:41', NULL),
(3, 2, 'dsadsad', '2022-01-09 21:07:44', NULL),
(4, 3, 'aadsads', '2022-01-09 21:18:28', NULL),
(5, 4, 'fsdfds', '2022-01-09 21:34:30', NULL),
(6, 5, 'ddsd', '2022-01-09 22:30:36', NULL),
(7, 7, 'ssaaa', '2022-01-11 22:02:57', NULL),
(8, 9, 'ss', '2022-01-11 22:11:29', NULL),
(9, 5, 'sss', '2022-01-11 22:13:15', NULL),
(10, 9, 'sas', '2022-01-11 22:13:21', NULL),
(11, 9, 'sssssss', '2022-01-11 22:15:13', NULL),
(12, 9, 'ss', '2022-01-11 22:17:21', NULL),
(13, 9, 'sas', '2022-01-11 22:19:44', 'aa'),
(14, 9, 'qqqqqqqqqqqqqqq', '2022-01-11 22:19:53', 'aa'),
(15, 9, 'sasa', '2022-01-11 22:22:53', 'alex'),
(16, 9, 'dsa', '2022-01-11 22:28:09', 'aa'),
(17, 9, 'aaaa', '2022-01-11 22:31:04', 'alex'),
(18, 9, 'qqqqqqqq', '2022-01-11 22:31:13', 'aa'),
(19, 9, 'dd', '2022-01-11 22:46:19', 'alex'),
(20, 9, 'fff', '2022-01-11 23:19:09', 'aa'),
(21, 2, 'aa', '2022-01-12 23:36:14', NULL),
(22, 2, 'ssssssssss', '2022-01-12 23:38:30', NULL),
(23, 2, 'vv', '2022-01-12 23:47:59', 'alex'),
(24, 12, 'ssasa', '2022-01-13 22:51:30', 'alex');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 'aa', 'aa', 'active'),
(2, 'alex', 'alex', 'active'),
(3, 'unassigned', 'aaaaaaaaaaaaaaaaaaaa', 'deactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_comments`
--
ALTER TABLE `tickets_comments`
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
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
