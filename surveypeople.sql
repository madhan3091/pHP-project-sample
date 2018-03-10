-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2018 at 05:34 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveypeople`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_category` int(11) NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `parent_category`, `status`) VALUES
(1, 'Programming', 0, 'active'),
(2, 'Sports', 0, 'active'),
(3, 'Movies', 0, 'active'),
(4, 'Gaming', 0, 'active'),
(5, 'Gadgets', 0, 'active'),
(6, 'Politics', 0, 'active'),
(7, 'Other', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(355) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `votes` int(20) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `survey_id`, `votes`, `status`) VALUES
(1, 'angular 1', 1, 0, 'active'),
(2, 'angular 2', 1, 2, 'active'),
(3, 'angular 3', 1, 2, 'active'),
(4, 'angular 4', 1, 0, 'active'),
(5, 'react 1', 2, 2, 'active'),
(6, 'react 2', 2, 0, 'active'),
(7, 'angular 4', 2, 1, 'active'),
(8, 'angular 5', 2, 0, 'active'),
(9, 'Option 1 *', 3, 0, 'active'),
(10, 'Option 2 *', 3, 1, 'active'),
(11, 'Option 3', 3, 0, 'active'),
(12, 'Option 4', 3, 0, 'active'),
(13, 'Option 1 *', 4, 0, 'active'),
(14, 'Option 2 *', 4, 0, 'active'),
(15, 'Option 3', 4, 2, 'active'),
(16, 'Option 4', 4, 0, 'active'),
(17, 'Option 1 *', 5, 1, 'active'),
(18, 'Option 2 *', 5, 0, 'active'),
(19, 'Option 3', 5, 1, 'active'),
(20, 'Option 4', 5, 0, 'active'),
(21, 'opt -1 ', 6, 1, 'active'),
(22, 'opt -2', 6, 0, 'active'),
(23, 'opt -3', 6, 0, 'active'),
(24, 'opt -4', 6, 0, 'active'),
(25, 'opt -1 ', 7, 0, 'inactive'),
(26, 'opt -2', 7, 0, 'active'),
(27, 'opt -3', 7, 0, 'active'),
(28, 'opt -4', 7, 1, 'active'),
(29, 'current test  Options 1', 8, 0, 'active'),
(30, 'current test Options 2', 8, 0, 'active'),
(31, 'current test Options 4', 8, 2, 'active'),
(32, 'current test Options 3', 8, 0, 'inactive'),
(33, 'current test  Options 1', 9, 0, 'active'),
(34, 'current test Options 2', 9, 0, 'active'),
(35, 'current test Options 3', 9, 4, 'active'),
(36, 'opt -5', 10, 1, 'active'),
(37, 'current test - 5', 11, 0, 'active'),
(38, '  current test Options 5', 8, 0, 'active'),
(39, 'demo', 11, 0, 'active'),
(40, 'test', 11, 3, 'active'),
(41, 'filter', 11, 0, 'active'),
(42, 'probability', 10, 0, 'active'),
(43, 'final option 1', 12, 0, 'active'),
(44, 'final option 2', 12, 0, 'active'),
(45, 'final option 3', 12, 0, 'active'),
(46, 'final option 4', 12, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL,
  `tags` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_deleted` varchar(20) NOT NULL DEFAULT 'no',
  `total_votes` int(50) NOT NULL,
  `url_slug` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `title`, `description`, `category`, `tags`, `user_id`, `created_on`, `updated_on`, `status`, `is_deleted`, `total_votes`, `url_slug`) VALUES
(1, 'which angular version has clear documentation now?', 'i need to know whichangular version has clear documentation now to learn from scratch', 1, 'angular js,angular versions', 1, '2018-02-03 18:08:53', '2018-02-06 18:07:28', 'active', 'no', 4, ''),
(2, 'React vs Angular, which is best', 'i need to know which has clear documentation now to learn from scratch', 1, 'angular js,react js', 1, '2018-02-03 18:08:53', '0000-00-00 00:00:00', 'active', 'no', 3, ''),
(3, 'Survey Title *', 'Survey Description *', 1, 'Survey Title *', 1, '2018-02-05 17:34:37', '2018-02-09 23:02:15', 'inactive', 'no', 1, 'Survey-Title-'),
(4, 'Survey Title *', 'Survey Description *', 1, 'Survey Title *', 1, '2018-02-05 17:35:09', '0000-00-00 00:00:00', 'active', 'no', 2, 'Survey-Title--1'),
(5, 'Survey Title *', 'Survey Description *', 1, 'Survey Title *', 1, '2018-02-05 17:36:34', '2018-02-06 18:08:09', 'active', 'no', 2, 'Survey-Title--1'),
(6, 'sports', 'description', 1, 'sports', 1, '2018-02-06 12:39:09', '0000-00-00 00:00:00', 'active', 'no', 1, 'sports'),
(7, 'sports', 'description', 1, 'sports', 1, '2018-02-06 12:39:50', '0000-00-00 00:00:00', 'active', 'no', 1, 'sports-1'),
(8, 'current test title - 1', 'current test Description  - 2', 1, 'current test title,demo test', 1, '2018-02-06 15:00:33', '2018-02-09 21:38:11', 'inactive', 'no', 2, 'current-test-title---1'),
(9, 'current test title', 'current test Description ', 3, 'current test title', 1, '2018-02-06 15:01:20', '2018-02-09 21:38:04', 'active', 'yes', 4, 'current-test-title-1'),
(10, 'sportss', 'descriptions', 2, 'react js,sports,sportss', 1, '2018-02-10 03:00:39', '0000-00-00 00:00:00', 'active', 'no', 1, 'sportss'),
(11, 'current test title', 'current test Description ', 3, 'current test title', 1, '2018-02-10 03:03:32', '2018-02-10 20:44:18', 'active', 'no', 3, 'current-test-title'),
(12, 'final test', 'final test desciption', 2, 'final test', 2, '2018-02-10 16:25:54', '0000-00-00 00:00:00', 'active', 'no', 0, 'final-test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(3000) NOT NULL,
  `auth_id` varchar(255) NOT NULL,
  `login_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `mail`, `password`, `avatar`, `auth_id`, `login_method`, `status`, `created_on`, `updated_on`, `role`) VALUES
(2, 'JanenRajasingh', 'male', '', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/c0.8.50.50/p50x50/25398640_1037113969763772_888046128201925144_n.jpg?oh=8e865198b9f6be3442ee61564c7de588&oe=5AE08637', '1063299590478543', 'facebook', 'active', '2018-02-04 07:04:33', '0000-00-00 00:00:00', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `voter_id` varchar(55) NOT NULL,
  `voter_type` varchar(55) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id`, `survey_id`, `option_id`, `voter_id`, `voter_type`, `created_on`) VALUES
(28, 9, 35, '2', 'user', '2018-02-10 07:22:51'),
(29, 11, 40, '2', 'user', '2018-02-10 08:42:04'),
(30, 1, 2, '2', 'user', '2018-02-10 16:11:49'),
(31, 5, 19, '2', 'user', '2018-02-10 16:13:44'),
(32, 2, 7, '2', 'user', '2018-02-10 16:13:50'),
(33, 4, 15, '2', 'user', '2018-02-10 16:21:29'),
(34, 6, 21, '2', 'user', '2018-02-10 16:23:09'),
(35, 11, 40, '::1', 'guest', '2018-02-10 16:23:31'),
(36, 9, 35, '::1', 'guest', '2018-02-10 16:23:35'),
(37, 7, 28, '2', 'user', '2018-02-10 16:31:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
