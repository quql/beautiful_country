/*
Navicat MySQL Data Transfer

Source Server         : 14term
Source Server Version : 50711
Source Host           : 127.0.0.1:3306
Source Database       : country

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-08-03 23:25:09
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
INSERT INTO `ml_admin_user` VALUES ('2', '鼠没人', '1', '123456', '0', '20', '1.jpg', '1');
INSERT INTO `ml_admin_user` VALUES ('5', 'aaaa', '1', '123456', '1', '23', '1.jpg', '1');
INSERT INTO `ml_admin_user` VALUES ('7', 'qql', '2', '123456', '1', '11', '1.jpg', '1');

-- ----------------------------
-- Table structure for `ml_business`
-- ----------------------------
DROP TABLE IF EXISTS `ml_business`;
CREATE TABLE `ml_business` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_type` tinyint(4) NOT NULL,
  `b_username` char(32) NOT NULL,
  `b_name` char(32) NOT NULL,
  `b_password` char(32) NOT NULL,
  `b_phone` char(11) NOT NULL,
  `b_province` char(30) NOT NULL,
  `b_city` char(30) DEFAULT NULL,
  `b_area` char(30) DEFAULT NULL,
  `b_logo` varchar(100) DEFAULT NULL,
  `b_create_time` char(30) NOT NULL,
  `is_approve` char(1) NOT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_name` (`b_name`),
  UNIQUE KEY `b_phone` (`b_phone`),
  UNIQUE KEY `b_logo` (`b_logo`),
  KEY `b_password` (`b_password`) USING BTREE,
  KEY `b_username` (`b_username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_business
-- ----------------------------
INSERT INTO `ml_business` VALUES ('1', '0', '1', '1', '123456', '12345678901', '湖北省', '黄石市', '西塞山区', null, '2017-07-31 22:19:34', 'N');
INSERT INTO `ml_business` VALUES ('12', '0', '2', '2', '123456', '12345678900', '安徽省', '合肥市', '瑶海区', null, '2017-08-01 13:52:13', 'N');
INSERT INTO `ml_business` VALUES ('13', '0', '3', '3', '123456', '12345678902', '安徽省', '合肥市', '瑶海区', null, '2017-08-01 13:55:13', 'N');
INSERT INTO `ml_business` VALUES ('14', '0', '4', '4', 'e10adc3949ba59abbe56e057f20f883e', '12345678903', '安徽省', '合肥市', '瑶海区', null, '2017-08-01 13:56:53', 'Y');
INSERT INTO `ml_business` VALUES ('15', '0', 'shine', 'shine', 'e10adc3949ba59abbe56e057f20f883e', '12345678904', '河南省', '南阳市', '宛城区', null, '2017-08-01 21:13:59', 'Y');

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
  KEY `ca_gdid` (`ca_gdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_cate`;
CREATE TABLE `ml_cate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_name` (`c_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_cate
-- ----------------------------
INSERT INTO `ml_cate` VALUES ('4', '住宿');
INSERT INTO `ml_cate` VALUES ('5', '旅游线路');
INSERT INTO `ml_cate` VALUES ('1', '景区');
INSERT INTO `ml_cate` VALUES ('3', '活动');
INSERT INTO `ml_cate` VALUES ('6', '特产');
INSERT INTO `ml_cate` VALUES ('2', '美食');

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
  KEY `co_gdid` (`co_gdid`)
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
  KEY `c_uid` (`c_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `ml_hotel`
-- ----------------------------
DROP TABLE IF EXISTS `ml_hotel`;
CREATE TABLE `ml_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `gd_title` varchar(100) DEFAULT NULL,
  `gd_abstract` varchar(100) DEFAULT NULL,
  `gd_hot` tinyint(5) DEFAULT NULL,
  `gd_is_sale` tinyint(5) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `h_cate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel
-- ----------------------------
INSERT INTO `ml_hotel` VALUES ('1', '4', '单人间11', 'dadafsf', '0', '1', '14', '1');
INSERT INTO `ml_hotel` VALUES ('3', '4', '假日酒店', 'ww', '0', '1', '15', '9');

-- ----------------------------
-- Table structure for `ml_hotel_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_hotel_detail`;
CREATE TABLE `ml_hotel_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_gid` int(11) DEFAULT NULL,
  `gd_details` varchar(255) NOT NULL,
  `gd_price` double(10,2) NOT NULL,
  `gd_store` char(5) NOT NULL,
  `gd_discount` varchar(30) NOT NULL,
  `gd_num` char(11) DEFAULT NULL,
  `gd_view` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gd_gid` (`c_gid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_detail
-- ----------------------------
INSERT INTO `ml_hotel_detail` VALUES ('1', '1', '313211', '44.00', '2', '22', '0', '0');
INSERT INTO `ml_hotel_detail` VALUES ('7', '3', 'dwadwfd', '33.00', '11', '66', '0', '0');

-- ----------------------------
-- Table structure for `ml_hotel_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ml_hotel_pic`;
CREATE TABLE `ml_hotel_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `is_first` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_pic
-- ----------------------------
INSERT INTO `ml_hotel_pic` VALUES ('9', '1', '20170803\\b8ea350db9eea09ee38ee89a6e7e7c97.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('10', '1', '20170803\\9573688e9a17cb4a7c30da671e344b4c.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('13', '3', '2.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('14', '3', '20170803\\f36f20ab5ffd427ec13338c8a132c2a3.jpg', '1');

-- ----------------------------
-- Table structure for `ml_h_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_h_cate`;
CREATE TABLE `ml_h_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `h_name` varchar(50) NOT NULL,
  `bus_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_h_cate
-- ----------------------------
INSERT INTO `ml_h_cate` VALUES ('1', '4', '酒店3', '14');
INSERT INTO `ml_h_cate` VALUES ('2', '4', '自然', '1');
INSERT INTO `ml_h_cate` VALUES ('4', '4', '五星酒店', '14');
INSERT INTO `ml_h_cate` VALUES ('6', '4', '旅馆5', '15');
INSERT INTO `ml_h_cate` VALUES ('7', '4', '三级酒店', '15');
INSERT INTO `ml_h_cate` VALUES ('8', '4', '农庄', '14');
INSERT INTO `ml_h_cate` VALUES ('9', '4', '假日酒店', '15');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_node
-- ----------------------------
INSERT INTO `ml_node` VALUES ('1', '访问管理员列表', 'User', 'index', '1');
INSERT INTO `ml_node` VALUES ('2', '修改管理员信息', 'User', 'edit', '1');
INSERT INTO `ml_node` VALUES ('3', '访问后台首页', 'Index', 'index', '1');
INSERT INTO `ml_node` VALUES ('20', '管理员添加', 'User', 'save', '1');
INSERT INTO `ml_node` VALUES ('21', '修改管理员信息', 'User', 'update', '1');
INSERT INTO `ml_node` VALUES ('22', '删除管理员', 'User', 'delete', '1');
INSERT INTO `ml_node` VALUES ('23', '退出登录', 'Index', 'loginexit', '1');

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
  KEY `o_aid` (`o_aid`)
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
INSERT INTO `ml_role_node` VALUES ('2', '1');
INSERT INTO `ml_role_node` VALUES ('2', '2');
INSERT INTO `ml_role_node` VALUES ('2', '3');
INSERT INTO `ml_role_node` VALUES ('2', '23');
INSERT INTO `ml_role_node` VALUES ('6', '3');
INSERT INTO `ml_role_node` VALUES ('6', '23');

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
  UNIQUE KEY `ua_uid` (`ua_uid`)
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
  UNIQUE KEY `ud_uid` (`ud_uid`)
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
