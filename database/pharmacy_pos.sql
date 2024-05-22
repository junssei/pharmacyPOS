-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 01:31 PM
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
(2, 'Ibuprofen', 'Advil', 458.38, 56, '2024-05-10', 1),
(3, 'Vitamin C', 'Natures Beauty', 570.83, 91, '2024-05-10', 3),
(4, 'Hydrocortisone Cream', 'Cortizone-10', 387.24, 44, '2024-05-10', 4),
(8, 'Amoxicillin', 'Amoxil', 905.63, 48, '2024-05-16', 2),
(9, 'Loratadine', 'Claritin', 718.18, 178, '2024-05-16', 1),
(10, 'Calcium Carbonate', 'Caltrate', 500.00, 100, '2024-05-16', 3),
(11, 'Benzoyl Peroxide Gel', 'Neutrogena Rapid Clear', 450.00, 60, '2024-05-16', 4),
(12, 'Burn Jel', 'Water Jel', 350.00, 40, '2024-05-16', 6),
(14, 'Adult Diapers', 'Tena', 600.00, 50, '2024-05-20', 7),
(15, 'Medical Adhesive Tape', '3M Micropore', 100.00, 100, '2024-05-22', 6);

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
(97, 1, 2, '2024-05-22');

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
(97, 3, 5);

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
(2, 6000.00, 994556733982);

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
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
