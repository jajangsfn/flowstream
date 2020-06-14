-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 12:33 PM
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
-- Table structure for table `delivery_cost`
--

CREATE TABLE `delivery_cost` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `delivery_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order`
--

CREATE TABLE `delivery_order` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `delivery_no` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `car_number` varchar(10) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `flag` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_team`
--

CREATE TABLE `delivery_team` (
  `id` int(11) NOT NULL,
  `delivery_order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_description` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_branch`
--

CREATE TABLE `m_branch` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `tax_status` int(11) DEFAULT NULL,
  `online_status` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_delivery`
--

CREATE TABLE `m_delivery` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rekening_no` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_event`
--

CREATE TABLE `m_event` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_event_detail`
--

CREATE TABLE `m_event_detail` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `multiple_flag` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `free_goods` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `m_map`
--

CREATE TABLE `m_map` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_master`
--

CREATE TABLE `m_master` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_partner`
--

CREATE TABLE `m_partner` (
  `id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `partner_code` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `zip_code` int(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `tax_number` int(11) DEFAULT NULL,
  `salesman` varchar(50) NOT NULL,
  `partner_type` varchar(50) NOT NULL,
  `sales_price_level` int(11) NOT NULL,
  `tax_address` varchar(255) NOT NULL,
  `is_customer` tinyint(4) NOT NULL DEFAULT 0,
  `is_supplier` tinyint(4) NOT NULL DEFAULT 0,
  `flag` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_promo`
--

CREATE TABLE `m_promo` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `flag` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_rekening_code`
--

CREATE TABLE `m_rekening_code` (
  `id` int(11) NOT NULL,
  `rekening_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_salesman`
--

CREATE TABLE `m_salesman` (
  `id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_salesman_map`
--

CREATE TABLE `m_salesman_map` (
  `id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `flag` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_warehouse`
--

CREATE TABLE `m_warehouse` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ol_connection`
--

CREATE TABLE `ol_connection` (
  `id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `receive_id` int(11) DEFAULT NULL,
  `request_status` varchar(100) DEFAULT NULL,
  `receive_status` varchar(100) DEFAULT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ol_group`
--

CREATE TABLE `ol_group` (
  `id` int(11) NOT NULL,
  `connection_id` int(11) NOT NULL,
  `maker_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_date` int(11) NOT NULL DEFAULT current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ol_group_detail`
--

CREATE TABLE `ol_group_detail` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `production_detail`
--

CREATE TABLE `production_detail` (
  `id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `flag` smallint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_parameter`
--

CREATE TABLE `purchase_order_parameter` (
  `id` int(11) NOT NULL,
  `rekening_code_id` int(11) NOT NULL,
  `flag` tinyint(2) NOT NULL DEFAULT 1
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
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_cost`
--
ALTER TABLE `delivery_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_order_id` (`delivery_order_id`),
  ADD KEY `delivery_id` (`delivery_id`);

--
-- Indexes for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `delivery_team`
--
ALTER TABLE `delivery_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_order_id` (`delivery_order_id`);

--
-- Indexes for table `m_branch`
--
ALTER TABLE `m_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_delivery`
--
ALTER TABLE `m_delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `m_event`
--
ALTER TABLE `m_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `m_event_detail`
--
ALTER TABLE `m_event_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `promo_id` (`promo_id`);

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
-- Indexes for table `m_map`
--
ALTER TABLE `m_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `partner_id` (`partner_id`);

--
-- Indexes for table `m_master`
--
ALTER TABLE `m_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_partner`
--
ALTER TABLE `m_partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_id` (`master_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `m_promo`
--
ALTER TABLE `m_promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_rekening_code`
--
ALTER TABLE `m_rekening_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_salesman`
--
ALTER TABLE `m_salesman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partner_id` (`partner_id`);

--
-- Indexes for table `m_salesman_map`
--
ALTER TABLE `m_salesman_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salesman_id` (`salesman_id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Indexes for table `m_unit`
--
ALTER TABLE `m_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_warehouse`
--
ALTER TABLE `m_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `ol_connection`
--
ALTER TABLE `ol_connection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `receive_id` (`receive_id`);

--
-- Indexes for table `ol_group`
--
ALTER TABLE `ol_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `connection_id` (`connection_id`);

--
-- Indexes for table `ol_group_detail`
--
ALTER TABLE `ol_group_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_detail`
--
ALTER TABLE `production_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `production_id` (`production_id`);

--
-- Indexes for table `purchase_order_parameter`
--
ALTER TABLE `purchase_order_parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_code_id` (`rekening_code_id`);

--
-- Indexes for table `s_reference`
--
ALTER TABLE `s_reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_cost`
--
ALTER TABLE `delivery_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_order`
--
ALTER TABLE `delivery_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_team`
--
ALTER TABLE `delivery_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_branch`
--
ALTER TABLE `m_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_delivery`
--
ALTER TABLE `m_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_event`
--
ALTER TABLE `m_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_event_detail`
--
ALTER TABLE `m_event_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_goods`
--
ALTER TABLE `m_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_map`
--
ALTER TABLE `m_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_master`
--
ALTER TABLE `m_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_partner`
--
ALTER TABLE `m_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_promo`
--
ALTER TABLE `m_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_rekening_code`
--
ALTER TABLE `m_rekening_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_salesman`
--
ALTER TABLE `m_salesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_salesman_map`
--
ALTER TABLE `m_salesman_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_warehouse`
--
ALTER TABLE `m_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ol_connection`
--
ALTER TABLE `ol_connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ol_group`
--
ALTER TABLE `ol_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ol_group_detail`
--
ALTER TABLE `ol_group_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production_detail`
--
ALTER TABLE `production_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_parameter`
--
ALTER TABLE `purchase_order_parameter`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_cost`
--
ALTER TABLE `delivery_cost`
  ADD CONSTRAINT `delivery_cost_ibfk_1` FOREIGN KEY (`delivery_order_id`) REFERENCES `delivery_order` (`id`),
  ADD CONSTRAINT `delivery_cost_ibfk_2` FOREIGN KEY (`delivery_id`) REFERENCES `m_delivery` (`id`);

--
-- Constraints for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD CONSTRAINT `delivery_order_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `delivery_team`
--
ALTER TABLE `delivery_team`
  ADD CONSTRAINT `delivery_team_ibfk_1` FOREIGN KEY (`delivery_order_id`) REFERENCES `delivery_order` (`id`);

--
-- Constraints for table `m_delivery`
--
ALTER TABLE `m_delivery`
  ADD CONSTRAINT `m_delivery_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `m_event`
--
ALTER TABLE `m_event`
  ADD CONSTRAINT `m_event_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `m_event_detail`
--
ALTER TABLE `m_event_detail`
  ADD CONSTRAINT `m_event_detail_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `m_event` (`id`),
  ADD CONSTRAINT `m_event_detail_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `m_goods` (`id`),
  ADD CONSTRAINT `m_event_detail_ibfk_3` FOREIGN KEY (`promo_id`) REFERENCES `m_event` (`id`);

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

--
-- Constraints for table `m_map`
--
ALTER TABLE `m_map`
  ADD CONSTRAINT `m_map_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `m_event` (`id`),
  ADD CONSTRAINT `m_map_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `m_goods` (`id`),
  ADD CONSTRAINT `m_map_ibfk_3` FOREIGN KEY (`partner_id`) REFERENCES `m_partner` (`id`);

--
-- Constraints for table `m_partner`
--
ALTER TABLE `m_partner`
  ADD CONSTRAINT `m_partner_ibfk_1` FOREIGN KEY (`master_id`) REFERENCES `m_master` (`id`),
  ADD CONSTRAINT `m_partner_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `m_salesman`
--
ALTER TABLE `m_salesman`
  ADD CONSTRAINT `m_salesman_ibfk_1` FOREIGN KEY (`partner_id`) REFERENCES `m_partner` (`id`);

--
-- Constraints for table `m_salesman_map`
--
ALTER TABLE `m_salesman_map`
  ADD CONSTRAINT `m_salesman_map_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `m_salesman` (`id`),
  ADD CONSTRAINT `m_salesman_map_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `m_goods` (`id`);

--
-- Constraints for table `m_warehouse`
--
ALTER TABLE `m_warehouse`
  ADD CONSTRAINT `m_warehouse_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `ol_connection`
--
ALTER TABLE `ol_connection`
  ADD CONSTRAINT `ol_connection_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `m_branch` (`id`),
  ADD CONSTRAINT `ol_connection_ibfk_2` FOREIGN KEY (`receive_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `ol_group`
--
ALTER TABLE `ol_group`
  ADD CONSTRAINT `ol_group_ibfk_1` FOREIGN KEY (`connection_id`) REFERENCES `ol_connection` (`id`);

--
-- Constraints for table `ol_group_detail`
--
ALTER TABLE `ol_group_detail`
  ADD CONSTRAINT `ol_group_detail_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `ol_group` (`id`),
  ADD CONSTRAINT `ol_group_detail_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `m_branch` (`id`);

--
-- Constraints for table `production_detail`
--
ALTER TABLE `production_detail`
  ADD CONSTRAINT `production_detail_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `m_goods` (`id`),
  ADD CONSTRAINT `production_detail_ibfk_2` FOREIGN KEY (`production_id`) REFERENCES `production` (`id`);

--
-- Constraints for table `purchase_order_parameter`
--
ALTER TABLE `purchase_order_parameter`
  ADD CONSTRAINT `purchase_order_parameter_ibfk_1` FOREIGN KEY (`rekening_code_id`) REFERENCES `m_rekening_code` (`id`);

--
-- Constraints for table `s_reference`
--
ALTER TABLE `s_reference`
  ADD CONSTRAINT `s_reference_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `m_branch` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
