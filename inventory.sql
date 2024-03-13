-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 09:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` int(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `mobile`, `address`, `email`) VALUES
(35235, 'Tanjilul Islam', 2147483647, 'Banskhali, Chittagong,', 'tanjilulislam37@gmai');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `order_id` int(20) NOT NULL,
  `order_product` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `order_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`order_id`, `order_product`, `customer_name`, `order_date`) VALUES
(3534, 'cola', 'md emon', '2024-02-22 11:48:37.000000'),
(4634, 'gdfg', 'dsgsgd', '0000-00-00 00:00:00.000000'),
(35234, 'fsdgsd', 'sdg', '0000-00-00 00:00:00.000000'),
(352344, 'dfg', 'dfgd', '0000-00-00 00:00:00.000000'),
(4353245, 'dsfsd', 'sfgdfgs', '2024-02-28 01:35:33.000000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `productionCost` int(20) NOT NULL,
  `sellingPrice` int(20) NOT NULL,
  `supplier` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category`, `name`, `productionCost`, `sellingPrice`, `supplier`) VALUES
(10, 'gfh', 'gf', 5, 2, 'fg'),
(353, 'cold drinks', 'Tiger', 34, 55, 'Unilever BD LTD'),
(552, 'hhdh', 'hhh', 20, 20, 'ddd'),
(25000, '20', 'jhh', 5252, 2, 'jhhg'),
(6757581, '', 'jhdfj', 0, 0, 'hjdfhhks'),
(6757582, '', 'mango', 0, 0, 'fr');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(20) NOT NULL,
  `product` varchar(50) NOT NULL,
  `quantity` int(20) NOT NULL,
  `supplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `product`, `quantity`, `supplier`) VALUES
(20, 'fg', 1, 'ffg'),
(6757580, 'jdg', 25, 'gfdj'),
(6757581, 'jhdfj', 100, 'hjdfhhks'),
(6757582, 'mango', 25, 'fr');

--
-- Triggers `purchase`
--
DELIMITER $$
CREATE TRIGGER `update_product_after_purchase` AFTER INSERT ON `purchase` FOR EACH ROW BEGIN
    INSERT INTO product (id, name, supplier)
    VALUES (NEW.id, NEW.product, NEW.supplier);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_name` AFTER INSERT ON `purchase` FOR EACH ROW BEGIN
    UPDATE product
    SET name = NEW.product
    WHERE id = NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `s_id` int(10) NOT NULL,
  `s_name` varchar(20) NOT NULL,
  `s_mobile` int(20) NOT NULL,
  `s_address` varchar(50) NOT NULL,
  `s_email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`s_id`, `s_name`, `s_mobile`, `s_address`, `s_email`) VALUES
(3345, 'Tanjil', 2147483647, 'Banskhali, Chittagong,', 'tanjilulislam37@gmai'),
(90980, 'Mr Alex', 87686888, 'Silicon Valley', 'Alex@gmail.com'),
(334535, 'Tanjilul Islam', 2147483647, 'Banskhali, Chittagong,', 'tanjilulislam37@gmai'),
(334538, 'Tanjilul ', 2147483647, 'Banskhali, Chittagong,', 'tanjilulislam37@gmai'),
(334535987, 'Tanjilul Islam', 2147483647, 'Banskhali, Chittagong,', 'tanjilulislam37@gmai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35236;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4353246;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6757583;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6757583;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334535988;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
