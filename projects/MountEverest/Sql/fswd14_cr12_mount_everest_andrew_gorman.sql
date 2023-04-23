-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2021 at 08:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd14_cr12_mount_everest_andrew_gorman`
--
CREATE DATABASE IF NOT EXISTS `fswd14_cr12_mount_everest_andrew_gorman` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fswd14_cr12_mount_everest_andrew_gorman`;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `loc_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `activities` varchar(255) DEFAULT 'Climbing and hiking',
  `latitude` decimal(8,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`loc_id`, `location_name`, `price`, `description`, `activities`, `latitude`, `longitude`, `picture`, `created_at`) VALUES
(1, 'Rax', '1000.00', 'Mountains in the vicinity of Austria\'s capital city', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', '47.701958', '15.740246', 'rax.jpeg', '2021-11-26 22:19:31'),
(2, 'Ghandruk', '2000.00', 'A village development committee in the Kaski District of the Gandaki Province of Nepal in the Himalayas', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', '28.467074', '83.824528', 'ghandruk.jpeg', '2021-11-26 22:19:31'),
(3, 'Skardu', '2500.00', 'Skardu is situated at an elevation of nearly 2,500 metres in the Skardu Valley, Pakistan in the Karakoram mountains', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', '35.325086', '75.551319', 'skardu.jpeg', '2021-11-26 22:19:31'),
(4, 'Pamir mountain', '3500.00', 'Central Asian mountain range in a highland region, falling mostly within Tajikistan.', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', '39.001599', '72.000085', 'pamir.jpg', '2021-11-26 22:19:31'),
(12, 'Snowdonia', '2000.00', 'Beautiful Welsh mountain Range', 'Climbing and hiking', '53.072978', '-4.076000', '61a1daea4beff.jpeg', '2021-11-27 07:14:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`loc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
