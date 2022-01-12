-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 01:16 AM
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
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('open','closed','resolved','hold') NOT NULL DEFAULT 'open',
  `assigned` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `msg`, `email`, `created`, `status`, `assigned`) VALUES
(1, 'Test Ticket', 'This is your first ticket.', 'support@codeshack.io', '2020-06-10 13:06:17', 'closed', NULL),
(2, 'rewrew', 'rew', 'ffds@Fds.com', '2022-01-09 21:07:35', 'open', NULL),
(3, 'test', 'sdadsa', 'test@te.com', '2022-01-09 21:17:58', 'open', NULL),
(4, 'This is a test title', 'sdjkaldjal dasj ddjsla djskl dsajkl jkljkl adas asj ajdas\r\nd sdjska lklas ja a\r\ns\r\nd sadas das \r\nas dsjakldjskljdlkajskdj kl\r\n s', 'as@as.com', '2022-01-09 21:28:56', 'hold', NULL),
(5, 'cc', 'cxz', 'c@cx.com', '2022-01-09 21:50:41', 'hold', NULL),
(6, 'This is asas ', 'dssa', 'dsa@dsa.com', '2022-01-09 22:21:59', 'closed', NULL),
(7, 'ss', 'ss', 'ss@ss.com', '2022-01-11 00:06:31', 'open', NULL);

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
(6, 5, 'ddsd', '2022-01-09 22:30:36', NULL);

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
(2, 'alex', 'alex', 'active');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
