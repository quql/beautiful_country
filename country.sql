/*
Navicat MySQL Data Transfer

Source Server         : 14term
Source Server Version : 50711
Source Host           : 127.0.0.1:3306
Source Database       : country

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-08-02 00:34:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ml_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `ml_admin_user`;
CREATE TABLE `ml_admin_user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `role` int(10) NOT NULL,
  `pass` char(32) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `age` int(10) NOT NULL,
  `photo` varchar(60) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_admin_user
-- ----------------------------
INSERT INTO `ml_admin_user` VALUES ('1', 'qql', '2', '123456', '0', '16', '20170801\\1f4788142820544e4985be892f073745.jpg', '1');
INSERT INTO `ml_admin_user` VALUES ('2', '鼠没人', '1', '123456', '0', '20', '1.jpg', '1');
INSERT INTO `ml_admin_user` VALUES ('5', 'aaaa', '1', '123456', '1', '23', '1.jpg', '1');
INSERT INTO `ml_admin_user` VALUES ('7', 'wwww', '1', '123456', '0', '33', '20170731\\125891e2d64feb21133ad11113271d15.jpg', '1');

-- ----------------------------
-- Table structure for `ml_business`
-- ----------------------------
DROP TABLE IF EXISTS `ml_business`;
CREATE TABLE `ml_business` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_type` tinyint(4) NOT NULL,
  `b_username` char(32) NOT NULL,
  `b_password` char(32) NOT NULL,
  `b_phone` char(11) NOT NULL,
  `b_create_time` char(8) NOT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_username` (`b_username`),
  UNIQUE KEY `b_password` (`b_password`),
  UNIQUE KEY `b_phone` (`b_phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_business
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_bus_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_bus_detail`;
CREATE TABLE `ml_bus_detail` (
  `bd_id` int(11) NOT NULL AUTO_INCREMENT,
  `bd_bid` int(11) NOT NULL,
  `bd_logo` varchar(100) NOT NULL,
  `bd_name` char(32) NOT NULL,
  `bd_province` char(30) NOT NULL,
  `bd_city` char(30) NOT NULL,
  `bd_area` char(30) NOT NULL,
  PRIMARY KEY (`bd_id`),
  UNIQUE KEY `bd_bid` (`bd_bid`),
  UNIQUE KEY `bd_logo` (`bd_logo`),
  UNIQUE KEY `bd_name` (`bd_name`),
  CONSTRAINT `ml_bus_detail_ibfk_1` FOREIGN KEY (`bd_bid`) REFERENCES `ml_business` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_bus_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_cart`
-- ----------------------------
DROP TABLE IF EXISTS `ml_cart`;
CREATE TABLE `ml_cart` (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_uid` int(11) DEFAULT NULL,
  `ca_gdid` int(11) DEFAULT NULL,
  `ca_num` tinyint(2) DEFAULT NULL,
  `ca_price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`ca_id`),
  KEY `ca_uid` (`ca_uid`),
  KEY `ca_gdid` (`ca_gdid`),
  CONSTRAINT `ml_cart_ibfk_1` FOREIGN KEY (`ca_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ml_cart_ibfk_2` FOREIGN KEY (`ca_gdid`) REFERENCES `ml_goods_detail` (`gd_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_category`
-- ----------------------------
DROP TABLE IF EXISTS `ml_category`;
CREATE TABLE `ml_category` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(30) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_name` (`c_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_category
-- ----------------------------
INSERT INTO `ml_category` VALUES ('1', '商品', '0');
INSERT INTO `ml_category` VALUES ('2', '店铺', '0');
INSERT INTO `ml_category` VALUES ('3', '美食', '1');
INSERT INTO `ml_category` VALUES ('4', '景区', '2');

-- ----------------------------
-- Table structure for `ml_collection`
-- ----------------------------
DROP TABLE IF EXISTS `ml_collection`;
CREATE TABLE `ml_collection` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `co_bid` int(11) DEFAULT NULL,
  `co_gdid` int(11) DEFAULT NULL,
  PRIMARY KEY (`co_id`),
  KEY `co_bid` (`co_bid`),
  KEY `co_gdid` (`co_gdid`),
  CONSTRAINT `ml_collection_ibfk_1` FOREIGN KEY (`co_bid`) REFERENCES `ml_business` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ml_collection_ibfk_2` FOREIGN KEY (`co_gdid`) REFERENCES `ml_goods_detail` (`gd_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_collection
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_comment`
-- ----------------------------
DROP TABLE IF EXISTS `ml_comment`;
CREATE TABLE `ml_comment` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_gid` int(11) DEFAULT NULL,
  `c_uid` int(11) DEFAULT NULL,
  `c_score` tinyint(4) DEFAULT NULL,
  `c_text` varchar(140) DEFAULT NULL,
  `c_time` char(14) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `c_gid` (`c_gid`),
  KEY `c_uid` (`c_uid`),
  CONSTRAINT `ml_comment_ibfk_1` FOREIGN KEY (`c_gid`) REFERENCES `ml_goods` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ml_comment_ibfk_2` FOREIGN KEY (`c_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_goods`
-- ----------------------------
DROP TABLE IF EXISTS `ml_goods`;
CREATE TABLE `ml_goods` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_bid` int(11) DEFAULT NULL,
  `g_ticket` varchar(50) DEFAULT NULL,
  `g_specialty` varchar(50) DEFAULT NULL,
  `g_food` varchar(50) DEFAULT NULL,
  `g_hotel` varchar(50) DEFAULT NULL,
  `g_route` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`g_id`),
  KEY `g_bid` (`g_bid`),
  CONSTRAINT `ml_goods_ibfk_1` FOREIGN KEY (`g_bid`) REFERENCES `ml_business` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_goods_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_goods_detail`;
CREATE TABLE `ml_goods_detail` (
  `gd_id` int(11) NOT NULL AUTO_INCREMENT,
  `gd_gid` int(11) DEFAULT NULL,
  `gd_title` char(11) NOT NULL,
  `gd_abstract` char(32) NOT NULL,
  `gd_details` varchar(255) NOT NULL,
  `gd_price` double(10,2) NOT NULL,
  `gd_store` char(5) NOT NULL,
  `gd_hot` tinyint(4) NOT NULL,
  `gd_is_sale` tinyint(4) NOT NULL,
  `gd_discount` tinyint(4) NOT NULL,
  `gd_num` char(11) DEFAULT NULL,
  `gd_view` char(11) DEFAULT NULL,
  PRIMARY KEY (`gd_id`),
  KEY `gd_gid` (`gd_gid`),
  CONSTRAINT `ml_goods_detail_ibfk_1` FOREIGN KEY (`gd_gid`) REFERENCES `ml_goods` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_goods_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_goods_photo`
-- ----------------------------
DROP TABLE IF EXISTS `ml_goods_photo`;
CREATE TABLE `ml_goods_photo` (
  `gp_id` int(11) NOT NULL AUTO_INCREMENT,
  `gp_gid` int(11) DEFAULT NULL,
  `gp_photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`gp_id`),
  KEY `gp_gid` (`gp_gid`),
  CONSTRAINT `ml_goods_photo_ibfk_1` FOREIGN KEY (`gp_gid`) REFERENCES `ml_goods` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_goods_photo
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_link`
-- ----------------------------
DROP TABLE IF EXISTS `ml_link`;
CREATE TABLE `ml_link` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_name` char(32) DEFAULT NULL,
  `l_logo` varchar(100) DEFAULT NULL,
  `l_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`l_id`),
  UNIQUE KEY `l_name` (`l_name`),
  UNIQUE KEY `l_logo` (`l_logo`),
  UNIQUE KEY `l_url` (`l_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_link
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_node`
-- ----------------------------
DROP TABLE IF EXISTS `ml_node`;
CREATE TABLE `ml_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_node
-- ----------------------------
INSERT INTO `ml_node` VALUES ('1', '访问管理员列表', 'User', 'index', '1');
INSERT INTO `ml_node` VALUES ('2', '修改管理员信息', 'User', 'edit', '1');
INSERT INTO `ml_node` VALUES ('3', '访问后台首页', 'Index', 'index', '1');
INSERT INTO `ml_node` VALUES ('20', '管理员添加', 'User', 'save', '1');
INSERT INTO `ml_node` VALUES ('21', '修改管理员信息', 'User', 'update', '1');

-- ----------------------------
-- Table structure for `ml_order`
-- ----------------------------
DROP TABLE IF EXISTS `ml_order`;
CREATE TABLE `ml_order` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_bid` int(11) DEFAULT NULL,
  `o_gid` int(11) DEFAULT NULL,
  `o_uid` int(11) DEFAULT NULL,
  `o_aid` int(11) DEFAULT NULL,
  `o_time` char(14) DEFAULT NULL,
  `o_status` tinyint(4) DEFAULT NULL,
  `o_num` tinyint(2) DEFAULT NULL,
  `o_price` double(10,2) DEFAULT NULL,
  `o_order_num` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`o_id`),
  KEY `o_bid` (`o_bid`),
  KEY `o_gid` (`o_gid`),
  KEY `o_uid` (`o_uid`),
  KEY `o_aid` (`o_aid`),
  CONSTRAINT `ml_order_ibfk_1` FOREIGN KEY (`o_bid`) REFERENCES `ml_business` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ml_order_ibfk_2` FOREIGN KEY (`o_gid`) REFERENCES `ml_goods` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ml_order_ibfk_3` FOREIGN KEY (`o_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ml_order_ibfk_4` FOREIGN KEY (`o_aid`) REFERENCES `ml_user_address` (`ua_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_order
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_role`
-- ----------------------------
DROP TABLE IF EXISTS `ml_role`;
CREATE TABLE `ml_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_role
-- ----------------------------
INSERT INTO `ml_role` VALUES ('1', '超级管理员', '1', '最大权限1');
INSERT INTO `ml_role` VALUES ('2', '项目经理', '1', '负责所有项目');
INSERT INTO `ml_role` VALUES ('3', '部门主任', '1', '负责当期部门管理');
INSERT INTO `ml_role` VALUES ('4', '普通员工', '1', '无');
INSERT INTO `ml_role` VALUES ('6', '临时工', '1', '一般权限');

-- ----------------------------
-- Table structure for `ml_role_node`
-- ----------------------------
DROP TABLE IF EXISTS `ml_role_node`;
CREATE TABLE `ml_role_node` (
  `rid` smallint(6) unsigned NOT NULL,
  `nid` smallint(6) unsigned NOT NULL,
  KEY `groupId` (`rid`),
  KEY `nodeId` (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_role_node
-- ----------------------------
INSERT INTO `ml_role_node` VALUES ('3', '1');
INSERT INTO `ml_role_node` VALUES ('1', '1');
INSERT INTO `ml_role_node` VALUES ('1', '2');
INSERT INTO `ml_role_node` VALUES ('1', '20');
INSERT INTO `ml_role_node` VALUES ('2', '3');

-- ----------------------------
-- Table structure for `ml_user`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user`;
CREATE TABLE `ml_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` char(32) NOT NULL,
  `u_password` char(32) NOT NULL,
  `u_phone` char(11) NOT NULL,
  `u_create_time` int(8) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_username` (`u_username`),
  UNIQUE KEY `u_password` (`u_password`),
  UNIQUE KEY `u_phone` (`u_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user
-- ----------------------------
INSERT INTO `ml_user` VALUES ('1', '张三', '123', '12345678901', '20170101');
INSERT INTO `ml_user` VALUES ('2', '李四', '000', '99999999999', '56789086');

-- ----------------------------
-- Table structure for `ml_user_address`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user_address`;
CREATE TABLE `ml_user_address` (
  `ua_id` int(11) NOT NULL AUTO_INCREMENT,
  `ua_uid` int(11) NOT NULL,
  `ua_province` char(30) NOT NULL,
  `ua_city` char(30) NOT NULL,
  `ua_area` char(30) NOT NULL,
  `ua_street` char(30) NOT NULL,
  `ua_phone` char(11) NOT NULL,
  PRIMARY KEY (`ua_id`),
  UNIQUE KEY `ua_uid` (`ua_uid`),
  CONSTRAINT `ml_user_address_ibfk_1` FOREIGN KEY (`ua_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user_address
-- ----------------------------
INSERT INTO `ml_user_address` VALUES ('1', '1', '福建', '厦门', '思明', '人名路1号', '12345678999');
INSERT INTO `ml_user_address` VALUES ('2', '2', '福建', '泉州', '鲤城区', '解放路', '12345678902');

-- ----------------------------
-- Table structure for `ml_user_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user_detail`;
CREATE TABLE `ml_user_detail` (
  `ud_id` int(11) NOT NULL AUTO_INCREMENT,
  `ud_uid` int(11) NOT NULL,
  `ud_photo` varchar(100) DEFAULT NULL,
  `ud_sex` tinyint(4) DEFAULT '1',
  `ud_type` tinyint(4) DEFAULT '0',
  `ud_point` int(11) DEFAULT NULL,
  `ud_picture` varchar(100) DEFAULT NULL,
  `ud_email` varchar(30) DEFAULT NULL,
  `ud_text` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`ud_id`),
  UNIQUE KEY `ud_uid` (`ud_uid`),
  CONSTRAINT `ml_user_detail_ibfk_1` FOREIGN KEY (`ud_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user_detail
-- ----------------------------
INSERT INTO `ml_user_detail` VALUES ('1', '1', null, '1', '0', '33', '', '123@qq.com', '啦啦啦');
INSERT INTO `ml_user_detail` VALUES ('2', '2', null, '0', '1', '99', null, '999@qq.com', '嘿嘿嘿');

-- ----------------------------
-- Table structure for `ml_user_role`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user_role`;
CREATE TABLE `ml_user_role` (
  `rid` mediumint(9) unsigned DEFAULT NULL,
  `uid` int(6) unsigned NOT NULL,
  KEY `group_id` (`rid`),
  KEY `user_id` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user_role
-- ----------------------------
INSERT INTO `ml_user_role` VALUES ('3', '5');
INSERT INTO `ml_user_role` VALUES ('2', '1');
INSERT INTO `ml_user_role` VALUES ('4', '4');
INSERT INTO `ml_user_role` VALUES ('3', '1');
INSERT INTO `ml_user_role` VALUES ('7', '5');
INSERT INTO `ml_user_role` VALUES ('7', '3');
