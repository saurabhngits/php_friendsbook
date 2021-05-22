-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 03:30 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_facebook_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(50) NOT NULL,
  `message` longtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `request_id` int(50) NOT NULL,
  `friend1_id` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `friend2_id` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `status` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`request_id`, `friend1_id`, `friend2_id`, `status`) VALUES
(44, 'prajakta_sh01@gmail.com', 'vikrant_j02@gmail.com', 1),
(43, 'prajakta_sh01@gmail.com', 'sush_p01@yahoo.com', 2),
(41, 'khaire_919@gmail.com', 'vikrant_j02@gmail.com', 2),
(42, 'prajakta_sh01@gmail.com', 'khaire_919@gmail.com', 2),
(40, 'sush_p01@yahoo.com', 'vikrant_j02@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `introduction`
--

CREATE TABLE `introduction` (
  `id` int(150) NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `institute` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `district` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(150) COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `introduction`
--

INSERT INTO `introduction` (`id`, `email`, `institute`, `city`, `district`, `state`, `country`, `status`) VALUES
(2, 'vikrant_j02@gmail.com', 'Viva', 'Virar', 'Palghar', 'Maharashtra', 'India', 'Single'),
(3, 'sush_p01@yahoo.com', 'Ryans', 'Dahisar', 'Mumbai', 'Maharashtra', 'India', 'Married'),
(4, 'khaire_919@gmail.com', 'Viva', 'Virar', 'Palghar', 'Maharashtra', 'India', 'Engaged'),
(5, 'prajakta_sh01@gmail.com', 'Williams', 'NSP', 'Palghar', 'Maharashtra', 'India', 'Single');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(50) NOT NULL,
  `friend1_id` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `friend2_id` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `message` longtext COLLATE utf8mb4_bin NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `time` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `friend1_id`, `friend2_id`, `message`, `date`, `time`) VALUES
(59, 'vikrant_j02@gmail.com', 'khaire_919@gmail.com', 'I am in San\'s Pada ðŸ˜Ž', '22/May/2021', '08:55'),
(58, 'vikrant_j02@gmail.com', 'khaire_919@gmail.com', 'Where are you ?', '17/May/2021', '10:42'),
(55, 'khaire_919@gmail.com', 'prajakta_sh01@gmail.com', 'I need your data structure notes, will you please send this on my emai id', '16/May/2021', '11:22'),
(56, 'khaire_919@gmail.com', 'prajakta_sh01@gmail.com', '', '16/May/2021', '11:22'),
(57, 'vikrant_j02@gmail.com', 'khaire_919@gmail.com', 'Hey bro ....', '17/May/2021', '10:42'),
(53, 'prajakta_sh01@gmail.com', 'sush_p01@yahoo.com', 'Do we know each other ? ðŸ¤¨', '16/May/2021', '11:09'),
(52, 'prajakta_sh01@gmail.com', 'khaire_919@gmail.com', 'Yes please ...', '16/May/2021', '11:07'),
(51, 'sush_p01@yahoo.com', 'prajakta_sh01@gmail.com', 'hii praju', '16/May/2021', '10:40'),
(50, 'khaire_919@gmail.com', 'prajakta_sh01@gmail.com', 'hii....', '16/May/2021', '10:33');

-- --------------------------------------------------------

--
-- Table structure for table `my_post`
--

CREATE TABLE `my_post` (
  `email` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `post_id` int(100) NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `time` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `path` varchar(300) COLLATE utf8mb4_bin DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_bin,
  `security_status` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `my_post`
--

INSERT INTO `my_post` (`email`, `post_id`, `date`, `time`, `path`, `name`, `description`, `security_status`) VALUES
('khaire_919@gmail.com', 56, '16 May', '10:31', 'database/khaire_919@gmail.com/Cycle stunds.mp4', 'Cycling', 'ðŸ˜Ž', 'public'),
('sush_p01@yahoo.com', 55, '16 May', '10:06', 'database/sush_p01@yahoo.com/IMG-20131005-WA0003.jpg', 'Fresh.... !', 'ðŸ˜‹', 'public'),
('sush_p01@yahoo.com', 54, '16 May', '09:27', NULL, 'Status', 'â£HÄ“! Akkaá¸a nÄ“nu phÄ“sbuk upayÅgistunnÄnu.<br />\r\nðŸ˜ŽðŸ¤˜<br />', 'public'),
('vikrant_j02@gmail.com', 53, '16 May', '09:17', 'database/vikrant_j02@gmail.com/1366014458977.jpg', 'In the Air', 'Lol ....ðŸ˜œ', 'public'),
('vikrant_j02@gmail.com', 52, '16 May', '09:15', NULL, 'Status', 'Feeling Very Excited! To use the applicationðŸ¤Ÿ', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `my_post_like`
--

CREATE TABLE `my_post_like` (
  `like_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `date` varchar(150) COLLATE utf8mb4_bin DEFAULT NULL,
  `time` varchar(150) COLLATE utf8mb4_bin DEFAULT NULL,
  `liker_name` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `my_post_like`
--

INSERT INTO `my_post_like` (`like_id`, `post_id`, `email`, `date`, `time`, `liker_name`) VALUES
(72, 54, 'prajakta_sh01@gmail.com', '16 May', '11:29', 'Prajakta Shinde'),
(71, 53, 'prajakta_sh01@gmail.com', '16 May', '10:34', 'Prajakta Shinde'),
(70, 55, 'prajakta_sh01@gmail.com', '16 May', '10:34', 'Prajakta Shinde'),
(69, 56, 'prajakta_sh01@gmail.com', '16 May', '10:34', 'Prajakta Shinde'),
(68, 53, 'vikrant_j02@gmail.com', '16 May', '09:17', 'Vikrant Jadhav');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `day` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `cover_photo` varchar(300) DEFAULT NULL,
  `profile_photo` varchar(300) DEFAULT NULL,
  `online_status` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`firstname`, `lastname`, `email`, `question`, `answer`, `password`, `day`, `month`, `year`, `gender`, `cover_photo`, `profile_photo`, `online_status`) VALUES
('Prajakta', 'Shinde', 'prajakta_sh01@gmail.com', 'Who is your favourite pet?', '$2y$10$CY7APicInwJWtp69GpNFLO6VV31NoQoqqANwmc7WU2AuHMguQQZgK', '$2y$10$ISMYAlHeW1oUFtQqX.UN4eZztgFMgaBb2U2gUybQ0Gr2fIqaVX3ci', '17', 'sept', '1996', 'female', 'database/prajakta_sh01@gmail.com/cover_photo/1621183868.png', 'database/prajakta_sh01@gmail.com/profile_photo/1621183934.png', 0),
('Saurabh', 'Khaire', 'khaire_919@gmail.com', 'What is your best friend name?', '$2y$10$xCnozkVfeT1hWhgX8PcJguemoGRE85aOhFor94E/hoYqiGOTGq1lK', '$2y$10$ydU2wFM46p9ISiIJRd8v0uEZDuUB9G3wLNoPMWo9ScXtFVcepmGIe', '2', 'nov', '1995', 'male', 'database/khaire_919@gmail.com/cover_photo/1621183339.png', 'database/khaire_919@gmail.com/profile_photo/1621183403.png', 0),
('Sushma', 'Prajapati', 'sush_p01@yahoo.com', 'Who is your favourite pet?', '$2y$10$ABJHqkDw8B.brd7QXfU1s.E.dyYg1TdeGSgVjKSrnwwqFtdeu8p6C', '$2y$10$EupnGRSVMU4xNpZd9EJJi.KOs8QedM8Pgsbm0CWDdnOgXc9AJeHie', '27', 'oct', '1997', 'female', 'database/sush_p01@yahoo.com/cover_photo/1621182071.png', 'database/sush_p01@yahoo.com/profile_photo/1621182041.png', 0),
('Vikrant', 'Jadhav', 'vikrant_j02@gmail.com', 'Who is your favourite pet?', '$2y$10$K7PazacTTpwsgTEcOBqQKOealpCDSJm3ARK7BQumTLagcTXn/P7Iu', '$2y$10$WYN6rZrdwbQ8GOlZA.yjG.G8fbf1NMjmAGeOdVD84upnAGOpphKTi', '2', 'nov', '1994', 'male', 'database/vikrant_j02@gmail.com/cover_photo/1621179785.png', 'database/vikrant_j02@gmail.com/profile_photo/1621179823.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `friend1_id` (`friend1_id`),
  ADD KEY `friend2_id` (`friend2_id`);

--
-- Indexes for table `introduction`
--
ALTER TABLE `introduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `friend1_id` (`friend1_id`),
  ADD KEY `friend2_id` (`friend2_id`);

--
-- Indexes for table `my_post`
--
ALTER TABLE `my_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fkey` (`email`);

--
-- Indexes for table `my_post_like`
--
ALTER TABLE `my_post_like`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `request_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `introduction`
--
ALTER TABLE `introduction`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `my_post`
--
ALTER TABLE `my_post`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `my_post_like`
--
ALTER TABLE `my_post_like`
  MODIFY `like_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
