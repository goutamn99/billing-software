-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2019 at 09:42 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `active` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `active` enum('1','2') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(1, 'HP', '1'),
(2, 'Dell', '1'),
(3, 'Zebronics', '1'),
(4, 'Intex', '1'),
(5, 'LOGITECH', '1'),
(6, 'LG', '1'),
(9, 'Exide', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `active` enum('1','2') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(1, 'Hardware', '1');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(225) NOT NULL,
  `gstin` varchar(16) NOT NULL,
  `service_charge_value` int(11) NOT NULL,
  `vat_charge_value` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `state` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(20) NOT NULL,
  `logo` varchar(225) NOT NULL,
  `sm_logo` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `gstin`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `state`, `country`, `message`, `currency`, `logo`, `sm_logo`) VALUES
(1, 'RLinfocomm PVT LTD', '19AAICR4640J1Z1', 0, 18, '180 KM. GT Road, Durgapur-713212', '1234567890', 'West Bengal', 'India', '<p>Company''s Bank Details  :-&nbsp;<b>RL Infocomm Pvt. Ltd.</b></p><p><b></b>Bank Name   &nbsp;     :- ICICI<b></b></p><p>A/C No        &nbsp; &nbsp;:- 271505000025</p><p>Branch &amp; IFSC Code  &nbsp; :-&nbsp;\r\n\r\n&nbsp;Bidhannagar &amp; ICIC0002715\r\n\r\n</p><p><br></p><p><b>Declaration: 1.&nbsp;</b>Please PAY in A/C payee Cheque only.&nbsp;<b>2.&nbsp;</b>Goods once sold could not be exchanged or taken back.&nbsp;<b>3.&nbsp;</b>Warranty by Principle Co. or by Auth. Service Center.&nbsp;<b>4.&nbsp;</b>No Warranty on Breakage, Burn or Natural disaster.<br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><i>For&nbsp;<b></b></i><b>RL infocomm Pvt. Ltd.</b><i><b></b></i><b></b></p>', '', 'RL-Infocomm-Logo.png', 'final_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(225) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(2, 'Admin (All Permission Granted)', 'a:36:{i:0;s:10:"createUser";i:1;s:10:"updateUser";i:2;s:8:"viewUser";i:3;s:10:"deleteUser";i:4;s:11:"createGroup";i:5;s:11:"updateGroup";i:6;s:9:"viewGroup";i:7;s:11:"deleteGroup";i:8;s:11:"createBrand";i:9;s:11:"updateBrand";i:10;s:9:"viewBrand";i:11;s:11:"deleteBrand";i:12;s:14:"createCategory";i:13;s:14:"updateCategory";i:14;s:12:"viewCategory";i:15;s:14:"deleteCategory";i:16;s:11:"createStore";i:17;s:11:"updateStore";i:18;s:9:"viewStore";i:19;s:11:"deleteStore";i:20;s:15:"createAttribute";i:21;s:15:"updateAttribute";i:22;s:13:"viewAttribute";i:23;s:15:"deleteAttribute";i:24;s:13:"createProduct";i:25;s:13:"updateProduct";i:26;s:11:"viewProduct";i:27;s:13:"deleteProduct";i:28;s:11:"createOrder";i:29;s:11:"updateOrder";i:30;s:9:"viewOrder";i:31;s:11:"deleteOrder";i:32;s:11:"viewReports";i:33;s:13:"updateCompany";i:34;s:11:"viewProfile";i:35;s:13:"updateSetting";}');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(225) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gross_amount` decimal(10,2) NOT NULL,
  `service_charge_rate` decimal(10,2) NOT NULL,
  `service_charge` decimal(10,2) NOT NULL,
  `vat_charge_rate` decimal(10,2) NOT NULL,
  `vat_charge` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `paid_status` char(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `customer_name`, `customer_address`, `customer_phone`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `net_amount`, `discount`, `profit`, `paid_status`, `user_id`) VALUES
(3, 'RLI/INV/2019-20/01', 'Rathin Dey', 'CD-31/1<br>MAMC, Durgapur -713210', '9876543210', '2019-05-02 11:31:50', '31750.00', '0.00', '0.00', '6.00', '1905.00', '33655.00', 0, '6150.00', '1', 1),
(4, 'RLI/INV/2019-20/04', '', '', '', '0000-00-00 00:00:00', '30000.00', '0.00', '0.00', '6.00', '1800.00', '31800.00', 0, '6000.00', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE IF NOT EXISTS `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `net_profit` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `cost_price`, `rate`, `net_profit`, `amount`) VALUES
(14, 3, 4, 1, '3500.00', '4200.00', '700.00', '4200.00'),
(15, 3, 5, 1, '1500.00', '2200.00', '700.00', '2200.00'),
(16, 3, 6, 1, '3500.00', '4200.00', '700.00', '4200.00'),
(17, 3, 7, 1, '450.00', '500.00', '50.00', '500.00'),
(18, 3, 8, 1, '1200.00', '1500.00', '300.00', '1500.00'),
(19, 3, 9, 1, '1500.00', '1800.00', '300.00', '1800.00'),
(20, 3, 10, 1, '1200.00', '1500.00', '300.00', '1500.00'),
(21, 3, 11, 1, '500.00', '550.00', '50.00', '550.00'),
(22, 3, 12, 1, '250.00', '300.00', '50.00', '300.00'),
(23, 3, 13, 1, '12000.00', '15000.00', '3000.00', '15000.00'),
(24, 4, 13, 1, '12000.00', '15000.00', '3000.00', '15000.00'),
(25, 4, 13, 1, '12000.00', '15000.00', '3000.00', '15000.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `cost_price`, `price`, `qty`, `image`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `store_id`, `availability`) VALUES
(4, 'CPU CORE 2 DUO 3.0', 'CP123', '3500.00', '4200.00', 0, '<p>You did not select a file to upload.</p>', '', 'null', '["4"]', '["1"]', 2, 1),
(5, 'CPU FAN ZEB', 'SL7548', '1500.00', '2200.00', 14, '<p>You did not select a file to upload.</p>', '', 'null', '["4"]', '["1"]', 2, 1),
(6, 'G-41 MOTHER BOARD ZEB', 'SL789456', '3500.00', '4200.00', 4, '<p>You did not select a file to upload.</p>', '', 'null', '["3"]', '["1"]', 2, 1),
(7, 'LOGITECH K/M+MSE', 'SL7895475', '450.00', '500.00', 24, '<p>You did not select a file to upload.</p>', '', 'null', '["5"]', '["1"]', 2, 1),
(8, '500 GB HDD (WD-93737)', 'SL321456', '1200.00', '1500.00', 19, '<p>You did not select a file to upload.</p>', '', 'null', 'null', '["1"]', 2, 1),
(9, 'LG DVD WRITER 24*SATA(143202)', 'SL36521447', '1500.00', '1800.00', 5, '<p>You did not select a file to upload.</p>', '', 'null', '["6"]', '["1"]', 2, 1),
(10, '4 GB DDR-3 (KINGSTONE)', 'SL652341', '1200.00', '1500.00', 9, '<p>You did not select a file to upload.</p>', '', 'null', 'null', '["1"]', 2, 1),
(11, 'SPEAKER JIL - 3400 680W FT (07372)', 'SL58/7456', '500.00', '550.00', 39, '<p>You did not select a file to upload.</p>', '', 'null', '["3"]', '["1"]', 2, 1),
(12, 'C REX CABINET WITH SMPS ZEB', 'SL48575454', '250.00', '300.00', 14, '<p>You did not select a file to upload.</p>', '', 'null', '["3"]', '["1"]', 2, 1),
(13, 'MONITOR DELL LED 18.5" (J1TW8R2)', 'SL568741254', '12000.00', '15000.00', 2, '<p>You did not select a file to upload.</p>', '', 'null', '["2"]', '["1"]', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(2, 'RLinfocomm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(75) NOT NULL,
  `lastname` varchar(75) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` enum('1','2') NOT NULL,
  `lastlogin` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`, `gender`, `lastlogin`, `status`, `create_date`) VALUES
(1, 'Admin', '$2y$10$CWO/rBduBi2rmPajLB41OO8LdAgVzbpqOq7TiRgnvqzG2ASKZQX4.', 'Goutam', 'Nayek', 'admin@admin.com', '1234567890', '1', '0000-00-00 00:00:00', '0', '2019-05-02 05:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
