-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2023 at 09:07 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(4) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(5, 'German Shepherd'),
(6, 'Rottweiler'),
(7, 'Ekimo'),
(8, 'Caucasian'),
(9, 'Lhasa');

-- --------------------------------------------------------

--
-- Table structure for table `dogs`
--

CREATE TABLE `dogs` (
  `id` int(15) NOT NULL,
  `name` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `petid` varchar(40) DEFAULT NULL,
  `user_id` int(5) NOT NULL,
  `healthy` text,
  `medication` text,
  `date_added` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`id`, `name`, `category`, `gender`, `dob`, `age`, `image`, `price`, `quantity`, `petid`, `user_id`, `healthy`, `medication`, `date_added`) VALUES
(1, 'jackie', '7', '1', '2018-10-13', '4 years 6 months', '202304130623522023032112003149.jpg', '50000', 1, 'cvft23', 22, 'good standing ', 'indomie', '2023/04/13'),
(2, 'mikey', '5', '2', '2022-06-07', '10 months', '202304130624492023031710422648.jpg', '6000', 1, 'hnsjj23', 22, 'good walking', 'sodium', '2023/04/13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentMethod` enum('on delivery','paystack') DEFAULT NULL,
  `payment_status` enum('not paid','paid') NOT NULL DEFAULT 'not paid',
  `orderStatus` enum('delivered','pending','on transit') DEFAULT 'pending',
  `delivery_address` text,
  `payment_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `orderDate`, `paymentMethod`, `payment_status`, `orderStatus`, `delivery_address`, `payment_date`) VALUES
(41, 23, '50000', '2023-04-13 06:31:20', 'on delivery', 'not paid', 'pending', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `dog_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `dog_id`, `quantity`, `order_id`, `created_at`) VALUES
(8, 22, 1, 39, '24-03-2023'),
(9, 23, 1, 40, '03-04-2023'),
(10, 1, 1, 41, '13-04-2023');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(4) NOT NULL,
  `sub_cat` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `sub_cat`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `role_id` enum('1','2','3') NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `status` enum('not_active','active') NOT NULL DEFAULT 'active',
  `date_joined` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `role_id`, `password`, `email`, `phone`, `address`, `status`, `date_joined`) VALUES
(1, 'John', 'Moses', '1', '$2y$10$njQP9W99LDDgp9alKfunue4Wvgq6JwXL7JM21TeZjLrmAoBJvxC9m', 'admin@babcock.com', '08099687837', 'ogun', 'active', ''),
(12, 'test ', 'client', '2', '$2y$10$sYSlvNTxAHTinzmYPHNnP.4GHOGSFSP/U6knQX.mPLgrIKlZvWByW', 'test@mail.com', '09078689484', 'test address', 'active', '2023/03/23'),
(17, 'best', 'breeder', '3', '$2y$10$.12r3ObyK2zpp7WgTTKrZeLTLCUygqvJkiwupB9kLJvEBRulWEcna', 'breader@mail.com', '09078689482', 'test breeder address', 'active', '2023/03/23'),
(18, 'breader ', 'breed', '2', '$2y$10$EbO/ptaRwcP43KsSqZUSRuXfNomP2RX/ziF4u9Dm7rE6ESTQ5QM2K', 'bread@mail.com', '09078689482', 'test', 'active', '2023/03/23'),
(22, 'css', 'php', '3', '$2y$10$.GJpnZPlnvT0JomJJLZijunSwWrxm0N.eG6HlJt49QR.A1ScKUPZS', 'james@gmail.com', '08169677396', 'fggg', 'active', '2023/04/12'),
(23, 'mj', 'kk', '2', '$2y$10$PVcSqotSGo1VAofnPSnSdeEoc6oKSgKRtf0dWp9HITvGXEQ/40y2e', 'logistic@gmail.comd', '08169677392', 'ikeja lagos', 'active', '2023/04/13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
