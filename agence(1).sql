-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 04:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agence`
--

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `numero_annouce` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  `categorie` varchar(50) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `numero_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announce`
--

INSERT INTO `announce` (`numero_annouce`, `titre`, `prix`, `description`, `date_publication`, `date_modification`, `categorie`, `Type`, `code_postal`, `Ville`, `numero_client`) VALUES
(2, 'Fuga Consectetur in', 83, 'lorem lorem lorem lorem loreml lorem lorem lorem lorem loreml lorem lorem lorem lorem loreml', '2023-02-22', '2023-02-27', 'villa', 'Location', NULL, 'Quam explicabo Nihi', 1),
(16, 'Officiis corporis co', 448, NULL, '2023-02-27', '2023-02-27', 'villa', 'Location', 94, 'Voluptatem voluptate', 1),
(18, 'Quis elit ut quis e', 368, NULL, '2023-02-27', '2023-02-27', 'villa', 'Vente', 23, 'Ipsum quas maxime qu', 1),
(20, 'Ex veritatis dolores', 2, NULL, '2023-02-27', '2023-02-27', 'maison', 'Location', 25, 'Laudantium perferen', 1),
(23, 'Aliqua Maiores ulla', 254, NULL, '2023-02-27', '2023-02-27', 'appartement', 'Location', 23, 'Qui aute esse nesciu', 1),
(24, 'ikraaaaaaaaaaaam waaa', 90, NULL, '2023-02-27', '2023-02-27', 'maison', 'Location', 52, 'Consectetur commodi ', 1),
(25, 'Voluptatem suscipit', 559, NULL, '2023-02-27', '2023-02-27', 'maison', 'Location', 48, 'Nam quia commodo fug', 1),
(26, 'TKHRBI9A', 471, NULL, '2023-02-27', '2023-02-27', 'villa', 'Location', NULL, 'Nisi natus quod cupi', 1),
(27, 'Molestias fugiat ape', 732, NULL, '2023-02-27', '2023-02-27', 'appartement', 'Location', 59, 'Sapiente et neque cu', 1),
(28, 'Qui deserunt nihil v', 637, NULL, '2023-02-27', '2023-02-27', 'maison', 'Vente', 67, 'Tempore aperiam asp', 1),
(29, 'bassam', 80, NULL, '2023-02-27', '2023-02-27', 'villa', 'Location', NULL, 'Impedit dolore culp', 1),
(30, 'Ut facilis excepteur', 566, NULL, '2023-02-27', '2023-02-27', 'villa', 'Vente', 93, 'Repellendus Qui tot', 1),
(31, 'Ut reprehenderit in ', 295, NULL, '2023-02-27', '2023-02-27', 'maison', 'Location', 100, 'Deserunt omnis liber', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `numero_client` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse_email` varchar(500) DEFAULT NULL,
  `mot_passe` varchar(500) DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`numero_client`, `nom`, `prenom`, `adresse_email`, `mot_passe`, `telephone`) VALUES
(1, 'ikrqAM', 'fggq', 'bassam.salik.solicode@gmail.com', 'DFHGJK', 6546789);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `image` varchar(3000) NOT NULL,
  `check_image` tinyint(1) NOT NULL,
  `numero_annouce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_image`, `image`, `check_image`, `numero_annouce`) VALUES
(2, '_ (2).jpeg', 0, 27),
(3, 'francesca-tosolini-tHkJAMcO3QE-unsplash (1).jpg', 0, 28),
(13, '', 0, 26),
(14, '', 0, 26),
(15, '_ (3).jpeg', 1, 26),
(19, 'francesca-tosolini-tHkJAMcO3QE-unsplash (1).jpg', 0, 30),
(20, 'jason-goodman-Oalh2MojUuk-unsplash.jpg', 1, 31),
(21, '', 0, 29),
(22, '', 0, 29),
(23, 'jason-goodman-Oalh2MojUuk-unsplash.jpg', 1, 29),
(24, 'bg2.jpg', 0, 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`numero_annouce`),
  ADD KEY `numero_client` (`numero_client`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numero_client`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `numero_annouce` (`numero_annouce`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `numero_annouce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `numero_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announce`
--
ALTER TABLE `announce`
  ADD CONSTRAINT `announce_ibfk_1` FOREIGN KEY (`numero_client`) REFERENCES `client` (`numero_client`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`numero_annouce`) REFERENCES `announce` (`numero_annouce`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
