-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 04:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `Event_Creator` varchar(50) NOT NULL,
  `Event_Name` varchar(50) NOT NULL,
  `Short_Description` varchar(1000) NOT NULL,
  `Entry_fees` varchar(20) DEFAULT NULL,
  `Event_Coordinators` varchar(1000) NOT NULL,
  `Prize` varchar(300) DEFAULT NULL,
  `Event_Rules` varchar(1000) NOT NULL,
  `Participant_Type` varchar(20) NOT NULL,
  `Last_Date` date NOT NULL,
  `Event_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Event_Creator`, `Event_Name`, `Short_Description`, `Entry_fees`, `Event_Coordinators`, `Prize`, `Event_Rules`, `Participant_Type`, `Last_Date`, `Event_Date`) VALUES
(1, 'ICONS', 'CodeShode', 'fgrg  egtg  grtg  rgr rtgrt tgr t', '50', 'htehtehy, reygryhryh', '6000', 'rr r rr  bfbgb fgerg gggg ggr', '4', '2021-03-24', '2021-03-25'),
(3, 'ICONS', 'Codewar', 'gehgfgbg', '100', 'thrujthrtht', '', 'kykyuj', '4', '2021-03-24', '2021-03-25'),
(8, 'ICONS', 'Codeathon', 'gfdgfdg', '60', 'rgrefgr', 'fgsfdzg', 'fgfdsgzfvg', '2', '2021-03-16', '2021-03-23'),
(9, 'ICONS', 'Codinifty', 'vmfdkgmfdg', '60', 'dgsfggngfngfbnhgfbh', '6000', 'rggfdgrtgretvsfg', '3', '2021-03-23', '2021-03-26'),
(10, 'MESA', 'Machine', 'xbhdhgdhg', '50', 'hrhrhrhy', '6000', 'hdht tytye ytytd dyh', '2', '2021-03-23', '2021-03-30'),
(11, 'ICONS', 'C', 'fgrefhg', '50', 'htehtehy, reygryhryh', '6000', 'frgeg\r\neheh\r\nghteh', '2', '2021-03-25', '2021-04-01'),
(12, 'ICONS', 'CC', 'gjrig rihgrui\r\nrtngijwrt\r\nrtijgritgr\r\nrgkr9ietjg\r\nrktir9tj\r\nrtl0trt', '', 'ggergterg', 'fgsfdzg', 'sfgnurfgnrwu\r\ngritgrwi\r\nrtfrwirw\r\nr\r\nriruriri\r\nrtgirtgr', '3', '2021-03-27', '2021-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `ParticipantID` int(10) NOT NULL,
  `Participant_Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mobile` varchar(10) NOT NULL,
  `Team_Members` varchar(100) DEFAULT NULL,
  `Event_Name` varchar(50) NOT NULL,
  `Event_Creator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`ParticipantID`, `Participant_Name`, `Username`, `Email`, `Mobile`, `Team_Members`, `Event_Name`, `Event_Creator`) VALUES
(6, 'Bhavesh Sharma', 'participant1@gmail.com', 'abc@gmail.com', '1242689864', 'reyhtey', 'CodeShode', 'ICONS'),
(7, 'Bhavesh Sharma', 'participant1@gmail.com', 'abc@gmail.com', '1242689864', 'grfgtrfg\r\ngrfgr\r\ngrftg', 'Codinifty', 'ICONS');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_id` varchar(60) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `amount`, `payment_status`, `payment_id`, `added_on`) VALUES
(1, 'Bhavesh Sharma', 50, 'complete', 'pay_H8MBlgt1pm8Fuh', '2021-05-08 04:02:36'),
(2, 'Bhavesh Sharma', 60, 'pending', '', '2021-05-08 04:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserType` varchar(20) NOT NULL DEFAULT 'participant'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Username`, `Password`, `Created_at`, `UserType`) VALUES
(1, 'ICONS', 'icons@indiraicem.ac.in', '25c481cf6cda58eed02a921009320f37', '2021-03-18 17:50:42', 'organizer'),
(6, 'MESA', 'mesa@indiraicem.ac.in', 'aabd0957e66f1ca641e55fe3990055f1', '2021-03-19 00:56:47', 'organizer'),
(7, 'CESA', 'cesa@indiraicem.ac.in', 'd8ade3a2738973680e5496c306350c1d', '2021-03-19 00:59:05', 'organizer'),
(8, 'FESA', 'fesa@indiraicem.ac.in', 'cd38c389b13dd2b3ba404dc3d7cac9dd', '2021-03-19 01:00:02', 'organizer'),
(9, 'Student Council', 'studentcouncil@indiraicem.ac.i', '738116e65b4f68988b814bf341723e94', '2021-03-19 01:01:43', 'organizer'),
(10, 'Participant1', 'participant1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2021-03-21 00:03:29', 'participant'),
(11, 'Bhavesh Sharma', 'bhavesh.sharma@indiraicem.ac.i', 'e10adc3949ba59abbe56e057f20f883e', '2021-03-23 03:16:14', 'participant'),
(12, 'Bhavesh Sharma', 'sharmabhavesh390@gmail.com', '01cfcd4f6b8770febfb40cb906715822', '2021-03-23 03:39:00', 'participant'),
(13, 'Participant2', 'participant2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2021-05-08 21:05:32', 'participant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD UNIQUE KEY `Event_Name` (`Event_Name`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`ParticipantID`),
  ADD KEY `Event_Name_FK` (`Event_Name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username_index` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `ParticipantID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `Event_Name_FK` FOREIGN KEY (`Event_Name`) REFERENCES `events` (`Event_Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
