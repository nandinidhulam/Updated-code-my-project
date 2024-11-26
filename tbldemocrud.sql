-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 11:25 AM
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
-- Database: `dbcrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldemocrud`
--

CREATE TABLE `tbldemocrud` (
  `Id` int(50) NOT NULL,
  `crudUId` varchar(50) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `MobileNumber` bigint(11) NOT NULL,
  `date` bigint(20) NOT NULL,
  `selectsubjects` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Status` enum('Active','Deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldemocrud`
--

INSERT INTO `tbldemocrud` (`Id`, `crudUId`, `Name`, `Email`, `MobileNumber`, `date`, `selectsubjects`, `gender`, `Address`, `Status`) VALUES
(1, 'ef908926-9b5f-11ef-ae46-e839354c95b9', 'nandinidhulsm@gmail.com', 'nandinidhulsm@gmail.com', 7038710930, 2024, 'C', 'Female', 'Plot no.1 Vinayak Nagar Solapur', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldemocrud`
--
ALTER TABLE `tbldemocrud`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldemocrud`
--
ALTER TABLE `tbldemocrud`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
