-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 12:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(255) NOT NULL,
  `AdminFirstName` varchar(50) NOT NULL,
  `AdminLastName` varchar(50) NOT NULL,
  `DOB` text NOT NULL,
  `AdminUserName` varchar(50) NOT NULL,
  `AdminPassword` varchar(1000) NOT NULL,
  `AdminEmail` varchar(50) NOT NULL,
  `MobileNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminFirstName`, `AdminLastName`, `DOB`, `AdminUserName`, `AdminPassword`, `AdminEmail`, `MobileNumber`) VALUES
(1, 'Prashant', 'Thapa', '10/02/1997', 'ptthapa20', '202cb962ac59075b964b07152d234b70', 'ptthapa20@gmail.com', 404215478);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ClientID` int(255) NOT NULL,
  `ClientFirstName` varchar(50) NOT NULL,
  `ClientLastName` varchar(50) NOT NULL,
  `DOB` text NOT NULL,
  `ClientUserName` varchar(50) NOT NULL,
  `ClientPassword` varchar(100) NOT NULL,
  `ClientEmail` varchar(100) NOT NULL,
  `MobileNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ClientID`, `ClientFirstName`, `ClientLastName`, `DOB`, `ClientUserName`, `ClientPassword`, `ClientEmail`, `MobileNumber`) VALUES
(2, 'Samundra', 'KC', '10/2/2001', 'sam', '332532dcfaa1cbf61e2a266bd723612c', 'sam2026@gmail.com', '0124578544');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `AdminEmail` (`AdminEmail`),
  ADD UNIQUE KEY `MobileNumber` (`MobileNumber`),
  ADD UNIQUE KEY `AdminPassword` (`AdminPassword`) USING HASH;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `ID` (`ClientID`),
  ADD UNIQUE KEY `ClientEmail` (`ClientEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ClientID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
