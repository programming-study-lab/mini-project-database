-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) UNSIGNED NOT NULL,
  `Comment_Text` text DEFAULT NULL,
  `curDateTime` datetime DEFAULT current_timestamp(),
  `upDateTime` datetime DEFAULT current_timestamp(),
  `UserID` int(11) DEFAULT NULL,
  `TopicID` int(11) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `Comment_Text`, `curDateTime`, `upDateTime`, `UserID`, `TopicID`, `Email`) VALUES
(30, 'aaaa', '2024-10-06 23:41:58', '2024-10-06 23:41:58', 1, 1, 'admin@test.com'),
(32, 'ADDDD', '2024-10-06 23:44:11', '2024-10-06 23:44:11', 1, 1, 'admin@test.com'),
(33, 'ได้', '2024-10-07 00:18:33', '2024-10-07 00:18:33', 2, 20, 'a'),
(34, '1', '2024-10-07 00:32:07', '2024-10-07 00:32:07', 3, 23, 'b'),
(35, '2', '2024-10-07 00:32:09', '2024-10-07 00:32:09', 3, 23, 'b'),
(36, '3', '2024-10-07 00:32:11', '2024-10-07 00:32:11', 3, 23, 'b'),
(37, '??', '2024-10-07 00:40:05', '2024-10-07 00:40:05', 3, 23, NULL),
(38, 'test', '2024-10-07 00:41:51', '2024-10-07 00:41:51', 3, 23, 'b'),
(39, 'tttt', '2024-10-09 18:53:07', '2024-10-09 18:53:07', 1, 1, 'admin@test.com'),
(40, 'สวัสดีชาวโลก', '2024-10-09 18:54:02', '2024-10-09 18:54:02', 2, 1, 'a'),
(41, 'ฺทดสอบ.ทดสอบ', '2024-10-09 18:54:54', '2024-10-09 18:54:54', 2, 20, 'a'),
(42, 'อืม..', '2024-10-09 18:55:44', '2024-10-09 18:55:44', 1, 20, 'admin@test.com'),
(43, 'Hello World', '2024-10-09 18:57:38', '2024-10-09 18:57:38', 8, 20, 'b@b.com');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `ListID` int(11) NOT NULL,
  `UserID` int(11) UNSIGNED DEFAULT current_timestamp(),
  `TopicID` int(11) UNSIGNED DEFAULT current_timestamp(),
  `CommnetID` int(11) UNSIGNED DEFAULT current_timestamp(),
  `curDateTime` datetime DEFAULT NULL,
  `upDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `TopicID` int(10) UNSIGNED NOT NULL,
  `Topic` varchar(200) DEFAULT NULL,
  `Details` text DEFAULT NULL,
  `curDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `upDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `UserID` int(11) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`TopicID`, `Topic`, `Details`, `curDateTime`, `upDateTime`, `UserID`, `Email`) VALUES
(1, 'Admin', 'admin', '2024-09-30 15:10:48', '2024-09-30 15:10:48', 1, 'admin@test.com'),
(20, 'a', '', '2024-10-06 16:44:30', '2024-10-06 16:44:30', 2, 'a'),
(21, 'Test', '', '2024-10-06 17:18:48', '2024-10-06 17:18:48', 2, 'a'),
(22, 'Testemail', '', '2024-10-06 17:30:55', '2024-10-06 17:30:55', 2, 'a'),
(23, 'ทดสอบ', 'Test', '2024-10-06 17:31:36', '2024-10-06 17:31:36', 3, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) UNSIGNED NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `UserPassword` varchar(100) DEFAULT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `UserCode` varchar(100) DEFAULT NULL,
  `Role` varchar(20) NOT NULL DEFAULT 'User',
  `Status` varchar(10) NOT NULL DEFAULT 'Offline',
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Email`, `UserPassword`, `FirstName`, `LastName`, `UserCode`, `Role`, `Status`, `DateTime`) VALUES
(1, 'admin@test.com', '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e', 'Admin', 'Page', '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e', 'Admin', 'Offline', '2024-09-26 20:03:07'),
(2, 'a', '$2y$12$pBDWfo4/Uv2cOM2TY7o9Ge2PCg1ROIx7TRnBssWRMlf7/UX6HWceS', 'a', 'a', '$2y$12$pBDWfo4/Uv2cOM2TY7o9Ge2PCg1ROIx7TRnBssWRMlf7/UX6HWceS', 'User', 'Offline', '2024-09-26 22:57:37'),
(8, 'b@b.com', '$2y$12$tj0B861poB8pghggBy8BT.pR4nlLc50s5RJartVZeMyT2we05/ZnK', 'b', 'b', '$2y$12$tj0B861poB8pghggBy8BT.pR4nlLc50s5RJartVZeMyT2we05/ZnK', 'User', 'Offline', '2024-10-08 20:11:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`ListID`),
  ADD KEY `CommentID` (`CommnetID`),
  ADD KEY `TopicID` (`TopicID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`TopicID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `ListID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `TopicID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `CommentID` FOREIGN KEY (`CommnetID`) REFERENCES `comment` (`CommentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TopicID` FOREIGN KEY (`TopicID`) REFERENCES `topic` (`TopicID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
