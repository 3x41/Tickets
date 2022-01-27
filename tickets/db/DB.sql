-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 11:14 PM
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
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `catagory` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `catagory`) VALUES
(2, 'Software'),
(3, 'Hardware'),
(4, 'Printer');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`) VALUES
(2, 'IT'),
(3, 'Accounts');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(2, 'Room 101'),
(3, '22');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `priority` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `priority`) VALUES
(5, 'High'),
(6, 'Normal'),
(7, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `type`) VALUES
(5, 'Phone'),
(6, 'Email'),
(7, 'In Person'),
(8, 'Other');

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
  `location` varchar(250) DEFAULT NULL,
  `source` varchar(200) DEFAULT NULL,
  `catagory` varchar(250) DEFAULT NULL,
  `priority` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `msg`, `email`, `created`, `status`, `assigned`, `resolved`, `department`, `location`, `source`, `catagory`, `priority`) VALUES
(1, 'Test Ticket', 'This is your first ticket.', 'support@codeshack.io', '2020-06-10 13:06:17', 'closed', 'alex', '2022-01-13 00:00:00', NULL, NULL, NULL, NULL, NULL),
(2, 'rewrew', 'rew', 'ffds@Fds.com', '2022-01-09 21:07:35', 'closed', 'aa', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'test', 'sdadsa', 'test@te.com', '2022-01-09 21:17:58', 'closed', 'alex', '2022-01-25 00:00:00', 'IT', 'Room 101', 'Email', 'Software', 'qqq'),
(4, 'This is a test title', 'sdjkaldjal dasj ddjsla djskl dsajkl jkljkl adas asj ajdas\r\nd sdjska lklas ja a\r\ns\r\nd sadas das \r\nas dsjakldjskljdlkajskdj kl\r\n s', 'as@as.com', '2022-01-09 21:28:56', 'resolved', 'alex', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'cc', 'cxz', 'c@cx.com', '2022-01-09 21:50:41', 'closed', 'alex', '2022-01-26 00:00:00', 'IT', 'Room 101', 'Phone', '', NULL),
(6, 'This is asas ', 'dssa', 'dsa@dsa.com', '2022-01-09 22:21:59', 'closed', 'alex', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'ss', 'ss', 'ss@ss.com', '2022-01-11 00:06:31', 'resolved', 'aa', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(8, 'lll', 'xzxz', 'll@ll.com', '2022-01-11 22:06:49', 'closed', 'alex', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'aaaaaaaaaaaaaaaaa', 'aaaaaaa', 'ss@ss.com', '2022-01-11 22:09:17', 'closed', 'alex', '2022-01-26 00:00:00', '', '', '', 'Software', ''),
(10, 'w', 'TEST', 'ss@ss.com', '2022-01-11 23:45:15', 'resolved', 'aa', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(11, 'vcv', 'dsdsa', 'vcx@vcx.com', '2022-01-12 21:48:15', 'resolved', 'aa', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(12, 'ssssss', 'qqqqqqqqqqqqqqq', 'ss@ss.com', '2022-01-12 22:49:03', 'closed', 'alex', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(13, 'New ticket in', 'This is a test', 'a@a.com', '2022-01-13 22:25:36', 'closed', 'alex', '2022-01-16 00:00:00', 'IT', 'Room 101', 'Phone', 'Hardware', NULL),
(14, 's', 'saa', 'ss@ss.com', '2022-01-13 22:31:16', 'resolved', 'alex', '2022-01-26 00:00:00', 'Accounts', 'Room 101', 'Phone', 'Hardware', 'ddd'),
(15, 'dsad', 'ccccccccccccccc', 'cookloz@aol.com', '2022-01-13 23:21:53', 'closed', 'alex', '2022-01-26 00:00:00', '', 'Room 101', 'Phone', '', NULL),
(16, 'qqqqq', 'qqqq', 'cookloz@aol.com', '2022-01-13 23:25:34', 'open', '', '2022-01-26 00:00:00', '', '', '', '', ''),
(17, 'c', 'sa', 'a@a.com', '2022-01-18 22:25:22', 'resolved', 'alex', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(18, 'a', 'ss', 'ss@ss.com', '2022-01-19 22:30:32', 'resolved', 'alex', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(19, 'ff', 'ffffffffff', 'ss@ss.com', '2022-01-19 22:32:14', 'closed', 'alex', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, NULL),
(20, 'q11111', '111', 'ss@ss.com', '2022-01-25 21:47:09', 'resolved', 'alex', '2022-01-26 00:00:00', NULL, NULL, NULL, NULL, 'ddd'),
(21, '333', '33', 'a@a.com', '2022-01-25 22:06:38', 'open', 'Hardware', NULL, 'Phone', 'alex', 'Room 101', 'Accounts', 'qqq'),
(22, 'qqqqqqqqqqqqqqqqq', 'qq', 'cookloz@aol.com', '2022-01-25 22:08:40', 'closed', 'Software', '2022-01-26 00:00:00', 'Phone', 'alex', 'Room 101', 'IT', 'ddd'),
(23, 's', 'sss', 'ss@ss.com', '2022-01-26 22:04:05', 'resolved', 'Hardware', '2022-01-26 00:00:00', 'Phone', 'alex', 'Room 101', '', ''),
(24, 'd', 'dd', 'dsa@dsa.com', '2022-01-26 22:11:39', 'closed', 'Software', '2022-01-26 00:00:00', 'Phone', 'alex', 'Room 101', 'Accounts', 'ddd'),
(25, '11', '11', 'a@a.com', '2022-01-26 22:15:19', 'resolved', 'Hardware', '2022-01-26 00:00:00', 'Phone', 'alex', 'Room 101', 'IT', 'qqq'),
(26, '11', '11', 'a@a.com', '2022-01-26 22:17:29', 'resolved', 'Hardware', '2022-01-26 00:00:00', 'Phone', 'alex', 'Room 101', 'IT', 'qqq'),
(27, 'd', '11111', 'cookloz@aol.com', '2022-01-26 22:19:50', 'resolved', 'Hardware', '2022-01-26 00:00:00', 'Phone', 'aa', '22', 'Accounts', 'qqq'),
(28, 'd', '11111', 'cookloz@aol.com', '2022-01-26 22:20:14', 'resolved', 'Hardware', '2022-01-26 00:00:00', 'Phone', 'aa', '22', 'Accounts', 'qqq'),
(29, 'xx', 'xx', 'a@a.com', '2022-01-26 22:23:44', 'resolved', 'Software', '2022-01-26 00:00:00', 'Email', 'alex', 'Room 101', 'Accounts', 'ddd'),
(30, 'zz', 'zz', 'ss@ss.com', '2022-01-26 22:36:29', 'open', 'Hardware', NULL, '', 'alex', 'Room 101', '', ''),
(31, 'xxxx', 'xx', 'a@a.com', '2022-01-26 22:37:01', 'open', '', NULL, '', 'alex', 'Room 101', '', ''),
(32, 'xxxx', 'xx', 'a@a.com', '2022-01-26 22:37:21', 'open', '', NULL, '', 'alex', 'Room 101', '', ''),
(33, 'rr', 'rrr', 'a@a.com', '2022-01-26 22:41:10', 'hold', 'alex', '2022-01-26 00:00:00', 'Accounts', 'Room 101', '', '', ''),
(34, 'kkkkkkkk', 'kk', 'ss@ss.com', '2022-01-26 22:42:22', 'open', 'alex', NULL, 'IT', '22', 'Phone', 'Software', 'qqq');

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
(24, 12, 'ssasa', '2022-01-13 22:51:30', 'alex'),
(25, 3, 'ss', '2022-01-19 22:25:07', 'alex'),
(26, 3, 'xx', '2022-01-19 22:25:14', 'alex'),
(27, 3, 'qq', '2022-01-19 22:25:24', 'alex'),
(28, 3, 'dsds', '2022-01-19 22:27:52', 'alex'),
(29, 14, 'aa', '2022-01-26 22:26:48', 'alex');

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
(2, 'alex', 'alex', 'active'),
(4, 'aa', 'aa', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
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
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
