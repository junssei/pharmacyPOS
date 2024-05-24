-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 08:42 AM
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
-- Database: `pharmacy_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(10) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Over-the-Counter (OTC)'),
(2, 'Prescription Medications'),
(3, 'Vitamins and Supplements'),
(4, 'Personal Care Products'),
(5, 'Medical Devices and Equipment'),
(6, 'First Aid Supplies'),
(7, 'Home Health Care Products');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `position` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `username`, `password`, `position`, `admin`) VALUES
(1, 'admin', 'admin', 'Administrator', 1),
(2, 'user1', 'user1', 'Cashier', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineID` int(10) NOT NULL,
  `genericName` varchar(100) NOT NULL,
  `brandedName` varchar(100) NOT NULL,
  `price` double(100,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `dateAdded` date NOT NULL DEFAULT current_timestamp(),
  `categoryID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineID`, `genericName`, `brandedName`, `price`, `stock`, `dateAdded`, `categoryID`) VALUES
(2, 'Ibuprofen', 'Advil', 458.38, 44, '2024-05-23', 1),
(3, 'Vitamin C', 'Natures Beauty', 570.83, 95, '2024-05-23', 3),
(4, 'Hydrocortisone Cream', 'Cortizone-10', 387.24, 74, '2024-05-23', 4),
(8, 'Amoxicillin', 'Amoxil', 905.63, 49, '2024-05-23', 2),
(9, 'Loratadine', 'Claritin', 718.18, 50, '2024-05-23', 1),
(10, 'Calcium Carbonate', 'Caltrate', 500.00, 62, '2024-05-23', 3),
(11, 'Benzoyl Peroxide Gel', 'Neutrogena Rapid Clear', 450.00, 44, '2024-05-16', 4),
(12, 'Burn Jel', 'Water Jel', 350.00, 63, '2024-05-23', 6),
(14, 'Adult Diapers', 'Tena', 600.00, 50, '2024-05-23', 7),
(15, 'Medical Adhesive Tape', '3M Micropore', 100.00, 95, '2024-05-22', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orderf`
--

CREATE TABLE `orderf` (
  `orderID` int(10) NOT NULL,
  `employeeID` int(10) NOT NULL,
  `paymentID` int(10) NOT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderf`
--

INSERT INTO `orderf` (`orderID`, `employeeID`, `paymentID`, `orderDate`) VALUES
(96, 1, 1, '2024-05-22'),
(97, 1, 2, '2024-05-22'),
(98, 1, 3, '2024-05-23'),
(99, 1, 4, '2024-05-23'),
(100, 1, 5, '2024-05-23'),
(101, 1, 6, '2024-05-23'),
(102, 1, 7, '2024-05-23'),
(103, 1, 8, '2024-05-23'),
(104, 1, 9, '2024-05-23'),
(105, 1, 10, '2024-05-23'),
(106, 1, 11, '2024-05-23'),
(107, 1, 12, '2024-05-23'),
(108, 1, 13, '2024-05-23'),
(109, 1, 14, '2024-05-23'),
(110, 1, 15, '2024-05-23'),
(111, 1, 16, '2024-05-23'),
(112, 1, 17, '2024-05-23'),
(113, 1, 18, '2024-05-23'),
(114, 1, 19, '2024-05-23'),
(115, 1, 20, '2024-05-23'),
(116, 1, 21, '2024-05-23'),
(117, 1, 22, '2024-05-23'),
(118, 1, 23, '2024-05-23'),
(119, 1, 24, '2024-05-23'),
(120, 1, 25, '2024-05-23'),
(121, 1, 26, '2024-05-23'),
(122, 1, 27, '2024-05-23'),
(123, 1, 28, '2024-05-23'),
(124, 1, 29, '2024-05-23'),
(125, 1, 30, '2024-05-23'),
(126, 1, 31, '2024-05-23'),
(127, 1, 32, '2024-05-23'),
(128, 1, 33, '2024-05-23'),
(129, 1, 34, '2024-05-23'),
(130, 1, 35, '2024-05-23'),
(131, 1, 36, '2024-05-23'),
(132, 1, 37, '2024-05-23'),
(133, 1, 38, '2024-05-23'),
(134, 1, 39, '2024-05-23'),
(135, 2, 40, '2024-05-23'),
(136, 2, 41, '2024-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `order_medicine`
--

CREATE TABLE `order_medicine` (
  `orderID` int(10) NOT NULL,
  `medicineID` int(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_medicine`
--

INSERT INTO `order_medicine` (`orderID`, `medicineID`, `quantity`) VALUES
(96, 3, 2),
(96, 9, 2),
(97, 2, 5),
(97, 3, 5),
(98, 2, 100),
(99, 2, 100),
(100, 2, 100),
(101, 12, 40),
(102, 2, 100),
(103, 2, 100),
(104, 4, 100),
(105, 8, 100),
(106, 10, 100),
(107, 11, 5),
(108, 11, 5),
(109, 11, 5),
(110, 2, 5),
(111, 2, 2),
(112, 2, 1),
(113, 2, 2),
(114, 2, 5),
(114, 8, 1),
(115, 8, 5),
(116, 2, 5),
(116, 3, 2),
(117, 4, 5),
(117, 10, 2),
(118, 2, 5),
(118, 9, 2),
(119, 2, 2),
(119, 3, 2),
(120, 2, 2),
(120, 8, 2),
(121, 2, 1),
(121, 8, 2),
(122, 2, 2),
(122, 12, 1),
(123, 15, 2),
(123, 11, 1),
(124, 4, 2),
(124, 12, 1),
(125, 12, 1),
(125, 10, 1),
(126, 2, 2),
(126, 8, 1),
(127, 2, 3),
(127, 15, 1),
(128, 3, 1),
(128, 10, 2),
(129, 2, 2),
(129, 12, 1),
(130, 15, 1),
(130, 2, 1),
(131, 2, 1),
(131, 12, 2),
(132, 2, 2),
(132, 10, 1),
(133, 12, 10),
(133, 2, 1),
(134, 4, 2),
(134, 12, 1),
(134, 3, 1),
(135, 3, 3),
(135, 10, 2),
(136, 2, 1),
(136, 3, 1),
(136, 4, 1),
(136, 8, 1),
(136, 10, 1),
(136, 14, 1),
(136, 12, 1),
(136, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `reference_num` bigint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `amount`, `reference_num`) VALUES
(1, 3000.00, 0),
(2, 6000.00, 994556733982),
(3, 50000.00, 0),
(4, 50000.00, 0),
(5, 50000.00, 0),
(6, 20000.00, 0),
(7, 50000.00, 0),
(8, 50000.00, 0),
(9, 40000.00, 0),
(10, 90563.00, 949413105692),
(11, 50000.00, 786921643938),
(12, 3000.00, 850248887914),
(13, 3000.00, 850248887914),
(14, 2250.00, 147784765762),
(15, 3000.00, 0),
(16, 1000.00, 0),
(17, 500.00, 0),
(18, 1000.00, 0),
(19, 4000.00, 0),
(20, 5000.00, 0),
(21, 4000.00, 0),
(22, 3000.00, 0),
(23, 4000.00, 0),
(24, 3000.00, 0),
(25, 3002.00, 0),
(26, 3000.00, 0),
(27, 2000.00, 0),
(28, 1000.00, 0),
(29, 1200.00, 0),
(30, 1000.00, 0),
(31, 2000.00, 0),
(32, 2000.00, 0),
(33, 2000.00, 0),
(34, 1300.00, 0),
(35, 600.00, 0),
(36, 1158.38, 252439451515),
(37, 1416.76, 286063896384),
(38, 3958.38, 0),
(39, 1800.00, 0),
(40, 3000.00, 0),
(41, 4000.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `orderf`
--
ALTER TABLE `orderf`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `paymentID` (`paymentID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `order_medicine`
--
ALTER TABLE `order_medicine`
  ADD KEY `transactionID` (`orderID`),
  ADD KEY `medicineID` (`medicineID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orderf`
--
ALTER TABLE `orderf`
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints for table `orderf`
--
ALTER TABLE `orderf`
  ADD CONSTRAINT `orderf_ibfk_1` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`),
  ADD CONSTRAINT `orderf_ibfk_2` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`);

--
-- Constraints for table `order_medicine`
--
ALTER TABLE `order_medicine`
  ADD CONSTRAINT `order_medicine_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orderf` (`orderID`),
  ADD CONSTRAINT `order_medicine_ibfk_2` FOREIGN KEY (`medicineID`) REFERENCES `medicine` (`medicineID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
