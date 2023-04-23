-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2021 at 04:08 PM
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
-- Database: `fswd14_cr11_petadoption_AndrewGorman`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `pet_id` int(11) NOT NULL,
  `pet_name` varchar(128) NOT NULL,
  `picture` varchar(55) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(10) NOT NULL,
  `age` int(3) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `breed` varchar(128) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT 'available',
  `species` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`pet_id`, `pet_name`, `picture`, `location`, `description`, `size`, `age`, `hobbies`, `breed`, `status`, `species`) VALUES
(1, 'Paul', 'bear1.jpg', '23 Praterstrasse', 'big cuddly polar bear. Loves cool temperatures', 'large', 12, 'hunting, fishing, long-distance roaming.', 'ursus maritimus Domesticus', 'available', 'large mammal'),
(2, 'Carl', 'cat1.jpg', '24 Praterstrasse', 'small cuddly pussycat. Loves warm temperatures', 'small', 9, 'sitting in the window, fishing, purring', 'felis catus pussicus', 'available', 'cat'),
(3, 'Camille', 'chameleon1.jpg', '25 Praterstrasse', 'chameleon master of disguise. Loves warm temperatures', 'small', 4, 'listening to Herbie Hancock, hiding, sticking tongue out', 'reptilia iguania squamata chamaelionidae', 'available', 'small reptile'),
(4, 'Dingo', 'dog1.jpg', '26 Praterstrasse', 'playfull canine buddy. Loves warm temperatures', 'large', 5, 'chasing balls, fetching slippers', 'canis familiaris', 'available', 'dog'),
(5, 'Harald', 'hamster1.jpg', '27 Praterstrasse', 'furry hamster friend. Loves warm temperatures', 'small', 2, 'running in wheels, eating seeds, sleeping', 'rodentia cricetinae', 'available', 'rodent'),
(6, 'Lenny', 'lemur1.jpg', '28 Praterstrasse', 'long-tailed Lemur. Loves warm temperatures', 'large', 6, 'climbing, eating fruit, hanging out', 'lemures lustigus', 'available', 'primate'),
(7, 'Minna', 'monkey1.jpg', '29 Praterstrasse', 'cheeky monkey chum. Loves warm temperatures', 'small', 3, 'stealing hats, climbing, eating fruit, hanging out', 'siricus simia', 'available', 'primate'),
(8, 'Peter', 'parrot1.jpg', '30 Praterstrasse', 'chatty chipper parrot. loves warm temperatures', 'small', 13, 'squawking and talking. Sitting on pirate shoulders', 'pionites melanocephalus', 'available', 'bird'),
(9, 'Terry', 'terrapin1.jpg', '31 Praterstrasse', 'timid terrapin. Loves land and water', 'small', 33, 'swimming, hiding in shell.', 'malaclemys terrapin terrapin', 'available', 'reptile'),
(10, 'Toni', 'tiger1.jpg', '32 Praterstrasse', 'bengal white tiger. Requires 9kg meat per day', 'large', 13, 'stealth-hunting. Swamp-swimming. Sunbathing.', 'panthera tigris tigris', 'available', 'large cat'),
(11, 'Freddy', 'frog1.jpg', '33 Praterstrasse', 'amphibious amigo. Loves slimy wet swampy areas', 'small', 1, 'sitting on logs. Croaking. Mating and swimming', 'canus lupis', 'available', 'amphibian'),
(12, 'Sonic', '61990ebcaec13.jpeg', '34 Praterstrasse', 'A fun guy to run with fast', 'small', 9, 'Walking and playing with a ball', 'Hedgehog', 'reserved', '5');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_id` int(11) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_pet_id` int(11) DEFAULT NULL,
  `adoption_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`adoption_id`, `fk_user_id`, `fk_pet_id`, `adoption_date`) VALUES
(1, 2, 12, '2021-11-20 15:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `user_address`, `phone_number`, `email`, `picture`, `status`) VALUES
(1, 'Andi', 'Admin', 'a589ffa7732ffd2f26d23953e26af5c8f6c006690b7982d5f07f671915c0b561', '1987-03-16', '1 Adminstrasse 1020 Wien', '06602301564', 'andi@admin.com', 'avatar.png', 'adm'),
(2, 'Ursula', 'User', 'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446', '1999-01-01', '2 Userstrasse 1030 Wien', '', 'ursula@user.com', 'avatar.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_pet_id`) REFERENCES `animals` (`pet_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
