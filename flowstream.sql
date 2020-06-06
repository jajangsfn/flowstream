-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2020 at 04:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowstream`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_goods`
--

CREATE TABLE `m_goods` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `barcode` varchar(50) NOT NULL,
  `sku_code` varchar(50) NOT NULL,
  `plu_code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `division` int(11) NOT NULL,
  `sub_division` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `package` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `hpp` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `rekening_no` int(11) NOT NULL,
  `tax` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_reference`
--

CREATE TABLE `s_reference` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `group_data` varchar(100) NOT NULL,
  `detail_data` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'Nathanael', 'nathanael71@ui.ac.id', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_goods`
--
ALTER TABLE `m_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division` (`division`),
  ADD KEY `sub_division` (`sub_division`),
  ADD KEY `category` (`category`),
  ADD KEY `sub_category` (`sub_category`),
  ADD KEY `color` (`color`),
  ADD KEY `package` (`package`),
  ADD KEY `unit` (`unit`);

--
-- Indexes for table `m_unit`
--
ALTER TABLE `m_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_reference`
--
ALTER TABLE `s_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_goods`
--
ALTER TABLE `m_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_reference`
--
ALTER TABLE `s_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_goods`
--
ALTER TABLE `m_goods`
  ADD CONSTRAINT `m_goods_ibfk_1` FOREIGN KEY (`division`) REFERENCES `s_reference` (`id`),
  ADD CONSTRAINT `m_goods_ibfk_2` FOREIGN KEY (`sub_division`) REFERENCES `s_reference` (`id`),
  ADD CONSTRAINT `m_goods_ibfk_3` FOREIGN KEY (`category`) REFERENCES `s_reference` (`id`),
  ADD CONSTRAINT `m_goods_ibfk_4` FOREIGN KEY (`sub_category`) REFERENCES `s_reference` (`id`),
  ADD CONSTRAINT `m_goods_ibfk_5` FOREIGN KEY (`color`) REFERENCES `s_reference` (`id`),
  ADD CONSTRAINT `m_goods_ibfk_6` FOREIGN KEY (`package`) REFERENCES `s_reference` (`id`),
  ADD CONSTRAINT `m_goods_ibfk_7` FOREIGN KEY (`unit`) REFERENCES `m_unit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
