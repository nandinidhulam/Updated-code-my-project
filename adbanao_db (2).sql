-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 10:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adbanao_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblframes`
--

CREATE TABLE `tblframes` (
  `Id` bigint(50) NOT NULL,
  `Frame` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblframes`
--

INSERT INTO `tblframes` (`Id`, `Frame`) VALUES
(1, 'Frames/Frame12.png'),
(2, 'Frames/Frame44.png'),
(3, 'Frames/Frame43.png'),
(4, 'Frames/Frame22.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblimages`
--

CREATE TABLE `tblimages` (
  `Id` bigint(100) NOT NULL,
  `ImagePath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblimages`
--

INSERT INTO `tblimages` (`Id`, `ImagePath`) VALUES
(1, 'images/diwali1.jpg'),
(2, 'images/diwali4.jpg'),
(3, 'images/color2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblinfo`
--

CREATE TABLE `tblinfo` (
  `Id` bigint(100) NOT NULL,
  `BusinessName` varchar(300) NOT NULL,
  `ContactNumber` bigint(255) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `Email` varchar(300) NOT NULL,
  `Website` varchar(300) NOT NULL,
  `Logo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblinfo`
--

INSERT INTO `tblinfo` (`Id`, `BusinessName`, `ContactNumber`, `Address`, `Email`, `Website`, `Logo`) VALUES
(1, 'NEWSOFT SOLUTIONS PVT.LTD.', 8983834813, '266/3 Raviwar Peth, Jodbasavanna Chowk Solapur.', 'tsnewsoft@gmail.com', 'newsoft.co.in', 'images\\logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblframes`
--
ALTER TABLE `tblframes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblimages`
--
ALTER TABLE `tblimages`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblinfo`
--
ALTER TABLE `tblinfo`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblframes`
--
ALTER TABLE `tblframes`
  MODIFY `Id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblimages`
--
ALTER TABLE `tblimages`
  MODIFY `Id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblinfo`
--
ALTER TABLE `tblinfo`
  MODIFY `Id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
