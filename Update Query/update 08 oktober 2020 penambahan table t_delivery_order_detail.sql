/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : 127.0.0.1:3306
 Source Schema         : flowstream

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 08/10/2020 20:55:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_delivery_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_delivery_order_detail`;
CREATE TABLE `t_delivery_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_order_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `flag` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;