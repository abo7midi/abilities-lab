-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 02:02 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentications`
--

CREATE TABLE `authentications` (
  `auth_id` int(11) NOT NULL,
  `auth_name` varchar(255) NOT NULL,
  `auth_state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_state` int(11) NOT NULL,
  `cat_created_at` datetime NOT NULL,
  `cat_updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `updates` text NOT NULL,
  `cat_main_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `choice_id` text NOT NULL,
  `choice_content` text NOT NULL,
  `choice_true_answer` int(1) NOT NULL,
  `q_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`choice_id`, `choice_content`, `choice_true_answer`, `q_id`) VALUES
('34', 'sg2', 1, '2147483647'),
('35', 'sg3', 0, '2147483647'),
('36', 'sg4', 0, '2147483647'),
('5e243e656540e', 'p1', 0, '2147483647'),
('5e243e6565414', 'p2', 0, '2147483647'),
('5e243e6565415', 'p3', 0, '2147483647'),
('5e243e6565416', 'p4', 0, '2147483647'),
('5e243f1fcf1a9', 'cs1_1', 0, '5e243f1fa2f57'),
('5e243f1fcf1af', 'cs1_2', 0, '5e243f1fa2f57'),
('5e243f1fcf1b0', 'cs1_3', 0, '5e243f1fa2f57'),
('5e243f1fcf1b1', 'cs1_4', 0, '5e243f1fa2f57'),
('5e243f2008f16', 'cs2_1', 0, '5e243f2003a87'),
('5e243f2008f1d', 'cs2_2', 0, '5e243f2003a87'),
('5e243f2008f1e', 'cs2_3', 0, '5e243f2003a87'),
('5e243f2008f1f', 'cs2_4', 0, '5e243f2003a87'),
('5e25499e75bfb', 'cg1', 0, '5e25499e59a6c'),
('5e25499e75c00', 'ch2', 0, '5e25499e59a6c'),
('5e25499e75c01', 'ch3', 0, '5e25499e59a6c'),
('5e25499e75c02', 'cg4', 0, '5e25499e59a6c'),
('5e25499eaafa4', '1', 0, '5e25499ea2b84'),
('5e25499eaafaa', '2', 0, '5e25499ea2b84'),
('5e25499eaafab', '3', 0, '5e25499ea2b84'),
('5e25499eaafac', '4', 0, '5e25499ea2b84'),
('5e254c2e49ce6', '1-1', 0, '5e254c2e2d468'),
('5e254c2e49ced', '1-2', 0, '5e254c2e2d468'),
('5e254c2e49cee', '1-3', 0, '5e254c2e2d468'),
('5e254c2e49cef', '1-4', 0, '5e254c2e2d468'),
('5e254c2e80aea', '2-1', 0, '5e254c2e7b818'),
('5e254c2e80aef', '2-2', 0, '5e254c2e7b818'),
('5e254c2e80af0', '2-3', 0, '5e254c2e7b818'),
('5e254c2e80af1', '2-4', 0, '5e254c2e7b818'),
('5e254c463a1a5', '1-1', 1, '5e254c4622618'),
('5e254c463a1aa', '1-2', 0, '5e254c4622618'),
('5e254c463a1ab', '1-3', 0, '5e254c4622618'),
('5e254c463a1ac', '1-4', 0, '5e254c4622618'),
('5e254c467305a', '2-1', 0, '5e254c466db9d'),
('5e254c4673062', '2-2', 1, '5e254c466db9d'),
('5e254c4673063', '2-3', 0, '5e254c466db9d'),
('5e254c4673064', '2-4', 0, '5e254c466db9d'),
('5e254f0dd5c9e', 's1', 0, '5e254f0db19ab'),
('5e254f0dd5ca5', 's2', 0, '5e254f0db19ab'),
('5e254f0dd5ca6', 's3', 0, '5e254f0db19ab'),
('5e254f0dd5ca7', 's4', 1, '5e254f0db19ab'),
('5e25510142316', 'it_1_a', 0, '5e25510119a61'),
('5e2551014231d', 'it_1_b', 0, '5e25510119a61'),
('5e2551014231e', 'it_1_c', 1, '5e25510119a61'),
('5e2551014231f', 'it_1_d', 0, '5e25510119a61'),
('5e25515f56338', 'a', 1, '5e25515f3374b'),
('5e25515f5633e', 'b', 0, '5e25515f3374b'),
('5e25515f56340', 'c', 0, '5e25515f3374b'),
('5e25515f56341', 'd', 0, '5e25515f3374b'),
('5e25571bdf221', 'Arabic1', 1, '5e25571bb5811'),
('5e25571bdf227', 'Arabic2', 0, '5e25571bb5811'),
('5e25571bdf228', 'Arabic3', 0, '5e25571bb5811'),
('5e25571bdf229', 'Arabic4', 0, '5e25571bb5811'),
('5e255a8ee5230', 'lev1', 0, '5e255a8eb877f'),
('5e255a8ee5237', 'lev', 1, '5e255a8eb877f'),
('5e255a8ee5238', 'lev2', 0, '5e255a8eb877f'),
('5e255a8ee5239', 'lev3', 0, '5e255a8eb877f'),
('5e255ba221358', 'lev2_1', 0, '5e255ba1f1ae3'),
('5e255ba22135e', 'lev2_2', 0, '5e255ba1f1ae3'),
('5e255ba22135f', 'lev2_3', 0, '5e255ba1f1ae3'),
('5e255ba221360', 'lev2_4', 1, '5e255ba1f1ae3'),
('5e259bfbdccc4', '1', 0, '5e259bfbba323'),
('5e259bfbdccca', '2', 1, '5e259bfbba323'),
('5e259bfbdcccb', '3', 0, '5e259bfbba323'),
('5e259bfbdcccc', '4', 0, '5e259bfbba323'),
('5e259bfc270e3', '1', 1, '5e259bfc22e10'),
('5e259bfc270e9', '2', 0, '5e259bfc22e10'),
('5e259bfc270ea', '3', 0, '5e259bfc22e10'),
('5e259bfc270eb', '4', 0, '5e259bfc22e10');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` text NOT NULL,
  `exam_name` text NOT NULL,
  `exam_description` text NOT NULL,
  `exam_level` int(11) NOT NULL,
  `exam_q_num` int(11) NOT NULL,
  `exam_duration` int(11) NOT NULL,
  `exam_price` decimal(10,0) NOT NULL,
  `exam_paid` int(1) NOT NULL,
  `exam_state` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_total_mark` int(11) NOT NULL,
  `exam_pass_mark` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `exam_name`, `exam_description`, `exam_level`, `exam_q_num`, `exam_duration`, `exam_price`, `exam_paid`, `exam_state`, `user_id`, `exam_total_mark`, `exam_pass_mark`, `cat_id`) VALUES
('5e2435afc224c', 'Exame 100', 'exam 100  exam 100  exam 100  ', 0, 2, 30, '150', 0, 0, 1, 100, 50, 1),
('5e2437cfc5ea9', 'E99', 'fdsdsf', 0, 2, 10, '160', 0, 0, 1, 50, 25, 1),
('5e2439b1d4d2f', 'E70', 'gdsf', 0, 2, 30, '20', 0, 0, 1, 100, 50, 1),
('5e243a5a78191', 'E80', 'E80E80E80E80E80', 0, 1, 30, '120', 0, 0, 1, 10, 5, 1),
('5e243b71dc78f', 'E12', 'fdsfs', 0, 1, 30, '21', 0, 0, 1, 50, 30, 1),
('5e243c8044ee2', 'G', 'ds\r\n', 0, 1, 84, '54', 0, 0, 1, 2, 74, 1),
('5e243e12ee6c6', 'Php', 'php exam', 0, 1, 30, '120', 0, 0, 1, 100, 50, 1),
('5e243ec6e0e26', 'Cs Exam', 'CS Exam', 0, 2, 30, '120', 0, 0, 1, 100, 50, 1),
('5e25489091363', 'Is Exam', 'IS Exam   IS Exam   IS Exam   IS Exam   ', 0, 2, 30, '150', 0, 0, 1, 100, 50, 1),
('5e254bfe21c85', 'Ex', 'lko', 0, 2, 30, '150', 0, 0, 1, 20, 10, 1),
('5e254ee16059f', 'P', 'yttrt', 0, 1, 30, '20', 0, 0, 1, 10, 5, 1),
('5e2550be4e70b', 'It', 'popo', 0, 1, 30, '150', 0, 0, 1, 100, 50, 1),
('5e2556e762e40', 'Arabic', 'oioj', 0, 1, 30, '120', 0, 0, 1, 100, 50, 1),
('5e255a299cb4d', 'Level', 'ioo', 0, 1, 20, '100', 0, 0, 1, 100, 50, 1),
('5e255aa704b97', 'Lev2', 'ko', 2, 1, 3, '10', 0, 0, 1, 10, 5, 1),
('5e25611c39fb5', 'Paid_ex', 'oio', 3, 1, 30, '10', 1, 0, 1, 10, 5, 1),
('5e259ba035c7d', 'E10', 'lk', 3, 2, 30, '120', 1, 0, 1, 100, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group-auth`
--

CREATE TABLE `group-auth` (
  `group_auth_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `group_state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` text NOT NULL,
  `q_content` text NOT NULL,
  `q_degree` decimal(10,0) NOT NULL,
  `sample_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `q_content`, `q_degree`, `sample_id`) VALUES
('5e2437162f56f', 'r1', '10', '5e2435e1b9ffa'),
('5e2437162f56f', 'r2', '10', '5e2435e1b9ffa'),
('5e2438118d0a8', 'lkslk', '15', '5e2437dd5ef12'),
('5e2438118d0a8', 'afg', '20', '5e2437dd5ef12'),
('5e243a7e13543', 'QE80', '10', '5e243a60ac810'),
('5e243bbaef1ed', 'Qe12', '10', '5e243b793c5c9'),
('5e243c9b5ee4b', 'Qsg', '10', '5e243c85a609d'),
('5e243e653cc4f', 'php Q', '10', '5e243e20c3f29'),
('5e243f1fa2f57', 'Q_cs1', '10', '5e243ed197e9e'),
('5e243f2003a87', 'Q_cs2', '15', '5e243ed197e9e'),
('5e254901a9d2e', 'Q_IS_1', '10', '5e25489ae48cd'),
('5e25499e59a6c', 'Q_IS_1', '10', '5e25489ae48cd'),
('5e25499ea2b84', 'Q_IS_2', '15', '5e25489ae48cd'),
('5e254c2e2d468', 'ex1', '10', '5e254c036cd5c'),
('5e254c2e7b818', 'ex2', '10', '5e254c036cd5c'),
('5e254c4622618', 'ex1', '10', '5e254c036cd5c'),
('5e254c466db9d', 'ex2', '10', '5e254c036cd5c'),
('5e254f0db19ab', 's', '10', '5e254ee8c3f9d'),
('5e25510119a61', 'IT_s1_Q1', '10', '5e2550cba86b5'),
('5e25515f3374b', 'Q_IT2', '10', '5e25513a63f62'),
('5e25571bb5811', 'Arabic_Q_1', '10', '5e2556f3b162f'),
('5e255a8eb877f', 'levelQ', '10', '5e255a765fee7'),
('5e255ba1f1ae3', 'lev2_q', '10', '5e255b8014e7b'),
('5e259bfbba323', 'gedj', '10', '5e259bb77b7e0'),
('5e259bfc22e10', 'yy', '10', '5e259bb77b7e0');

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `sample_id` text NOT NULL,
  `sample_name` varchar(255) NOT NULL,
  `sample_state` int(1) NOT NULL,
  `exam_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`sample_id`, `sample_name`, `sample_state`, `exam_id`) VALUES
('5e2437dd5ef12', 's99', 0, '2147483647'),
('5e2439c0c9748', 's70', 0, '2147483647'),
('5e243a60ac810', 'E80', 0, '2147483647'),
('5e243b793c5c9', 's12', 0, '2147483647'),
('5e243c85a609d', 'sg', 0, '2147483647'),
('5e243e20c3f29', 'php_sample1', 0, '2147483647'),
('5e243ed197e9e', 'CS_Exam_Sample', 0, '5e243ec6e0e26'),
('5e25489ae48cd', 'IS_Sample', 0, '5e25489091363'),
('5e254c036cd5c', 'ex_s', 0, '5e254bfe21c85'),
('5e254ee8c3f9d', 'sss1', 0, '5e254ee16059f'),
('5e254f1c7e2aa', 's2', 0, ''),
('5e2550cba86b5', 'IT_s_1', 0, '5e2550be4e70b'),
('5e25513a63f62', 'IT_s_2', 0, '5e2550be4e70b'),
('5e2556f3b162f', 'Arabic_s_1', 0, '5e2556e762e40'),
('5e25575099299', 'Arabic_s_2', 0, '5e2556e762e40'),
('5e255a765fee7', 'level_s', 0, '5e255a299cb4d'),
('5e255b8014e7b', 'lev2_s', 0, '5e255aa704b97'),
('5e259bb77b7e0', 'sampl_E10', 0, '5e259ba035c7d');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` text NOT NULL,
  `user_pass` text NOT NULL,
  `user_state` int(1) NOT NULL,
  `user_entry_date` datetime NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_choice`
--

CREATE TABLE `user_choice` (
  `user_choice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_exam`
--

CREATE TABLE `user_exam` (
  `user_exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_exam_state` int(1) NOT NULL,
  `user_exam_date` datetime NOT NULL,
  `user_exam_result` decimal(10,0) NOT NULL,
  `user_exam_finish_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL,
  `profile_img` text NOT NULL,
  `profile_social_media` text NOT NULL,
  `profile_create_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentications`
--
ALTER TABLE `authentications`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `group-auth`
--
ALTER TABLE `group-auth`
  ADD PRIMARY KEY (`group_auth_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_choice`
--
ALTER TABLE `user_choice`
  ADD PRIMARY KEY (`user_choice_id`);

--
-- Indexes for table `user_exam`
--
ALTER TABLE `user_exam`
  ADD PRIMARY KEY (`user_exam_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authentications`
--
ALTER TABLE `authentications`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
