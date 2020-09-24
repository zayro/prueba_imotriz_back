/*
 Navicat Premium Data Transfer

 Source Server         : mysql_localhost
 Source Server Type    : MySQL
 Source Server Version : 80016
 Source Host           : localhost:3306
 Source Schema         : imotriz

 Target Server Type    : MySQL
 Target Server Version : 80016
 File Encoding         : 65001

 Date: 23/09/2020 19:40:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(248) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reference` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `stock` int(11) NOT NULL,
  `currency` set('USD','COP') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `price` double(15, 2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'dfg', 'nuvas', 4, 'USD', 34.00, 'https://source.unsplash.com/100x100/?medicine,box,product');
INSERT INTO `product` VALUES (2, 'dfgdg', 'dfgdfg', 34, 'COP', 4.02, 'https://source.unsplash.com/200x200/?box,product');
INSERT INTO `product` VALUES (4, 'f', 'f', 4, 'COP', 5.00, 'https://source.unsplash.com/200x200/?product');

SET FOREIGN_KEY_CHECKS = 1;
