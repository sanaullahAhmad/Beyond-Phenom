/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : devon_new

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-05-19 14:51:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) DEFAULT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `adminDate` datetime DEFAULT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'Peham Raza', 'peham@pakipreneurs.com', '46e530a7a0ee0994774fb852af0fd9fd', '2016-05-19 11:51:34');
INSERT INTO `admins` VALUES ('3', 'Nousheen', 'nousheen@pakipreneurs.com', 'd655fb2e5498367920e6a3af3d8c86fe', '2016-05-17 00:00:00');
INSERT INTO `admins` VALUES ('4', 'Awais Gul', 'awais@pakipreneurs.com', '595f8d889c3ea3e410165919794a6320', '2016-05-19 11:51:08');

-- ----------------------------
-- Table structure for `fonts`
-- ----------------------------
DROP TABLE IF EXISTS `fonts`;
CREATE TABLE `fonts` (
  `fontId` int(11) NOT NULL AUTO_INCREMENT,
  `fontTitle` varchar(150) DEFAULT NULL,
  `fontUrl` varchar(255) DEFAULT NULL,
  `fontFamily` varchar(150) DEFAULT NULL,
  `fontDate` datetime DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  PRIMARY KEY (`fontId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fonts
-- ----------------------------
INSERT INTO `fonts` VALUES ('1', 'Roboto', 'https://fonts.googleapis.com/css?family=Roboto', 'Roboto', '2016-05-17 14:53:46', '1');

-- ----------------------------
-- Table structure for `patterns`
-- ----------------------------
DROP TABLE IF EXISTS `patterns`;
CREATE TABLE `patterns` (
  `patternId` int(11) NOT NULL AUTO_INCREMENT,
  `patternTitle` varchar(150) DEFAULT NULL,
  `patternImage` varchar(255) DEFAULT NULL,
  `patternDate` datetime DEFAULT NULL,
  `collectionId` int(11) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  PRIMARY KEY (`patternId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of patterns
-- ----------------------------
INSERT INTO `patterns` VALUES ('1', 'Fabric 99', 'fabric99.jpg', '2016-05-18 06:48:36', null, '1');

-- ----------------------------
-- Table structure for `pattern_collections`
-- ----------------------------
DROP TABLE IF EXISTS `pattern_collections`;
CREATE TABLE `pattern_collections` (
  `collectionId` int(11) NOT NULL AUTO_INCREMENT,
  `collectionTitle` varchar(150) DEFAULT NULL,
  `collectionDescription` text,
  `collectionImage` varchar(255) DEFAULT NULL,
  `collectionDate` datetime DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  PRIMARY KEY (`collectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pattern_collections
-- ----------------------------

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productTitle` varchar(255) NOT NULL,
  `productDescription` text,
  `ProductThumbnail` varchar(255) DEFAULT NULL,
  `productImageUrl` varchar(255) DEFAULT NULL,
  `productJson` text,
  `productPrice` int(11) DEFAULT NULL,
  `productType` int(11) DEFAULT NULL,
  `productDate` datetime DEFAULT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for `templates`
-- ----------------------------
DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `templateId` int(11) NOT NULL AUTO_INCREMENT,
  `templateTitle` varchar(255) NOT NULL,
  `templateDescription` text,
  `templateThumbnail` varchar(255) DEFAULT NULL,
  `templateImageUrl` varchar(255) DEFAULT NULL,
  `templateJson` text,
  `templatePrice` int(11) DEFAULT NULL,
  `templateType` int(11) DEFAULT NULL,
  `templateDate` datetime DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`templateId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of templates
-- ----------------------------
INSERT INTO `templates` VALUES ('1', 'My99 Collection - Compression Shirt', 'Awesome variation of Compression Shirt', 'compression-template.jpg', null, null, '28', '0', '2016-05-18 07:26:15', '1', '1');
