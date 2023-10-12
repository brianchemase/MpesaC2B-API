-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2023 at 04:35 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Mpesa_transactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `id` int(11) NOT NULL,
  `TransactionType` varchar(50) DEFAULT NULL,
  `TransID` varchar(20) DEFAULT NULL,
  `TransTime` varchar(14) DEFAULT NULL,
  `TransAmount` decimal(10,2) DEFAULT NULL,
  `BusinessShortCode` varchar(10) DEFAULT NULL,
  `BillRefNumber` varchar(50) DEFAULT NULL,
  `InvoiceNumber` varchar(50) DEFAULT NULL,
  `OrgAccountBalance` decimal(10,2) DEFAULT NULL,
  `ThirdPartyTransID` varchar(20) DEFAULT NULL,
  `MSISDN` varchar(15) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `status` int(50) NOT NULL DEFAULT 0,
  `posting_date` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`id`, `TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`, `status`, `posting_date`) VALUES
(1, 'Pay Bill', 'RKTQDM7W6S', '20191122063845', 1267.00, '600638', '32326262', '', 0.00, '', '25470****149', 'John', '', 'Doe', 1, '2023-08-01'),
(2, 'Pay Bill', 'RKTQDM7WS', '20191122063845', 510.00, '600638', '32326262', '', 0.00, '', '25470****149', 'Brian', 'C', 'Anikayi', 1, '2023-08-07T11:55:24.595431Z'),
(3, 'Pay Bill', 'RKTQDM775', '20191122063845', 710.00, '600638', '32326262', '', 0.00, '', '25470****149', 'Brian', 'C', 'Anikayi', 1, '2023-08-07T11:55:31.256016Z'),
(4, 'Pay Bill', 'MSMLKDISKSDJH', '20230112206384', 1710.00, '58856582', '32326262', '', 0.00, '', '25470****149', 'Brian', 'C', 'Anikayi', 1, '2023-08-07T12:09:15.374848Z'),
(5, 'PAY BILL', 'RKSMDJFKS', '20230112206384', 800.00, '5585558', '32326262', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2023-10-12T12:31:50.351702Z'),
(6, 'Pay Bill', 'MkSMLKDISKSDJH', '20230112206384', 1710.00, '58856582', '32326262', '', 0.00, '', '25470****149', 'Brian', 'C', 'Anikayi', 1, '2023-10-12T12:32:36.777222Z');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `TransID` (`TransID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Transactions`
--
ALTER TABLE `Transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
