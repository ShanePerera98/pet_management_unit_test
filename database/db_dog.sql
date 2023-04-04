-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2023 at 05:05 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `dogs`;
CREATE TABLE IF NOT EXISTS `dogs` (
  `d_id` int(15) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `age` varchar(50) NOT NULL,
  `d_image` varchar(200) NOT NULL,
  `price` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `petid` varchar(40) DEFAULT NULL,
  `user_id` int(5) NOT NULL,
  `date_added` varchar(15) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`d_id`, `d_name`, `category`, `gender`, `age`, `d_image`, `price`, `quantity`, `petid`, `user_id`, `date_added`) VALUES
(19, 'Doggie', '8', '2', '2023-03-01', '2023031710422648.jpg', '50000', 1, NULL, 4, '2023/03/17'),
(20, 'Tiger Cub', '5', '1', '2023-02-01', '2023032112003149.jpg', '70000', 1, NULL, 4, '2023/03/21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` varchar(255) DEFAULT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `productId`, `order_quantity`, `userId`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(4, '19', 1, 3, '2023-03-21 10:35:59', 'Payment on Delivery', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

DROP TABLE IF EXISTS `ordertrackhistory`;
CREATE TABLE IF NOT EXISTS `ordertrackhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(1, 4, 'Delivered', 'Thanks for your Trust', '2023-03-21 12:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `sub_cat` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `role_id` enum('1','2','3') NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` varchar(30) NOT NULL,
  `status` enum('not_active','active') NOT NULL DEFAULT 'active',
  `date_joined` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `role_id`, `username`, `password`, `email`, `phone`, `address`, `status`, `date_joined`) VALUES
(1, 'Mustapha', 'Salisu', '1', 'admin', 'admin', 'mustaphamungadi22@gmail.com', '08099687837', 'ksusta', 'active', ''),
(2, 'Abdulmajid', 'Abubakar', '2', 'abdul', '12345', 'abdul@gmail.com', '08167369433', 'Gra,Jega', 'active', '2019/07/29'),
(3, 'Hamza', 'Sani', '2', 'hamxa', '1255', 'hamxa22@gmail.com', '08089797666', 'ksuta', 'active', '2019/10/09'),
(4, 'John', 'Due', '3', 'john', '1234', 'john@gmail.com', '09130315160', 'Gra', 'active', '2023/03/17'),
(5, 'Shaharu', 'Muhammad', '3', 'deen', '1234', 'shafaatuabubakartari@gmail.com', '09065860127', 'Bayan Kara Area, Birnin Kebbi', 'active', '2023/03/20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
