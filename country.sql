/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : country

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-08-08 23:49:45
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
INSERT INTO `ml_admin_user` VALUES ('2', '鼠没人', '1', '1234', '1', '20', '20170804\\9c05814307435c0a0588f773b256b22c.jpg', '1');
INSERT INTO `ml_admin_user` VALUES ('5', 'aaaa', '1', '123456', '1', '23', '20170804\\e6881379976ea9d0a9a7ce3d6ffa2f29.jpg', '1');
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
  `b_email` char(60) DEFAULT NULL,
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
INSERT INTO `ml_business` VALUES ('14', '0', '4', 'x', 'e10adc3949ba59abbe56e057f20f883e', '12345678906', '安徽省', '合肥市', '瑶海区', '/uploads/20170802\\f7c046aba22e97f50f1f1674711f6071.jpg', '2017-08-01 13:56:53', 'Y', '');
INSERT INTO `ml_business` VALUES ('15', '0', 'shine', 'shine', 'e10adc3949ba59abbe56e057f20f883e', '12345678904', '河南省', '南阳市', '宛城区', null, '2017-08-01 21:13:59', 'Y', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_cart
-- ----------------------------
INSERT INTO `ml_cart` VALUES ('1', '1', '8', '1', '444.00');
INSERT INTO `ml_cart` VALUES ('2', '1', '8', '1', '444.00');
INSERT INTO `ml_cart` VALUES ('3', '1', '8', '2', '444.00');
INSERT INTO `ml_cart` VALUES ('4', '1', '8', '2', '444.00');
INSERT INTO `ml_cart` VALUES ('5', '1', '8', '2', '444.00');
INSERT INTO `ml_cart` VALUES ('6', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('7', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('8', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('9', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('10', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('11', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('12', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('13', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('14', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('15', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('16', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('17', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('18', '1', '8', '3', '444.00');
INSERT INTO `ml_cart` VALUES ('19', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('20', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('21', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('22', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('23', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('24', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('25', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('26', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('27', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('28', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('29', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('30', '1', '8', '2', '222.00');
INSERT INTO `ml_cart` VALUES ('31', '1', '8', '2', '222.00');
INSERT INTO `ml_cart` VALUES ('32', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('33', '1', '10', '3', '77.00');
INSERT INTO `ml_cart` VALUES ('34', '1', '10', '3', '77.00');
INSERT INTO `ml_cart` VALUES ('35', '1', '8', '1', '222.00');
INSERT INTO `ml_cart` VALUES ('36', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('37', '1', '8', '1', '222.00');
INSERT INTO `ml_cart` VALUES ('38', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('39', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('40', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('41', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('42', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('43', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('44', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('45', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('46', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('47', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('48', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('49', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('50', '1', '8', '2', '222.00');
INSERT INTO `ml_cart` VALUES ('51', '1', '10', '3', '77.00');
INSERT INTO `ml_cart` VALUES ('52', '1', '10', '4', '77.00');
INSERT INTO `ml_cart` VALUES ('53', '1', '10', '4', '77.00');
INSERT INTO `ml_cart` VALUES ('54', '1', '8', '4', '222.00');
INSERT INTO `ml_cart` VALUES ('55', '1', '8', '4', '222.00');
INSERT INTO `ml_cart` VALUES ('56', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('57', '1', '8', '0', '333.00');
INSERT INTO `ml_cart` VALUES ('58', '1', '8', '0', '333.00');
INSERT INTO `ml_cart` VALUES ('59', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('60', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('61', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('62', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('63', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('64', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('65', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('66', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('67', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('68', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('69', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('70', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('71', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('72', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('73', '1', '10', '1', '77.00');
INSERT INTO `ml_cart` VALUES ('74', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('75', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('76', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('77', '1', '8', '0', '333.00');
INSERT INTO `ml_cart` VALUES ('78', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('79', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('80', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('81', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('82', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('83', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('84', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('85', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('86', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('87', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('88', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('89', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('90', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('91', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('92', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('93', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('94', '1', '8', '2', '333.00');
INSERT INTO `ml_cart` VALUES ('95', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('96', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('97', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('98', '1', '8', '4', '333.00');
INSERT INTO `ml_cart` VALUES ('99', '1', '8', '4', '333.00');
INSERT INTO `ml_cart` VALUES ('100', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('101', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('102', '1', '8', '1', '333.00');
INSERT INTO `ml_cart` VALUES ('103', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('104', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('105', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('106', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('107', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('108', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('109', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('110', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('111', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('112', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('113', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('114', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('115', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('116', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('117', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('118', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('119', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('120', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('121', '1', '8', '5', '333.00');
INSERT INTO `ml_cart` VALUES ('122', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('123', '1', '8', '3', '333.00');
INSERT INTO `ml_cart` VALUES ('124', '1', '8', '1', '333.00');

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
INSERT INTO `ml_cate` VALUES ('6', '特产美食');

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
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评价id',
  `c_gid` int(11) NOT NULL COMMENT '评价的商品id',
  `c_uid` int(11) NOT NULL COMMENT '用户的id',
  `c_score` tinyint(4) DEFAULT NULL COMMENT '评分',
  `c_text` varchar(140) DEFAULT NULL COMMENT '评价内容',
  `c_time` char(14) NOT NULL COMMENT '评价提交的时间',
  `is_ban` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁播此评价 0开放 1禁播',
  PRIMARY KEY (`c_id`),
  KEY `c_gid` (`c_gid`),
  KEY `c_uid` (`c_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_comment
-- ----------------------------
INSERT INTO `ml_comment` VALUES ('1', '4', '1', '4', 'hjfhcmcnvtjhfdfghyyuyhyfvgbbbbbbbbbbbbbbbbbbbbbbbbbbbbbfffffffffffffffffffffffffffffffffffffffffffffffffffffbbbbbbbbbbbbbbbbbbbbbbbbbb', '20170807', '1');

-- ----------------------------
-- Table structure for `ml_food`
-- ----------------------------
DROP TABLE IF EXISTS `ml_food`;
CREATE TABLE `ml_food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `gd_title` varchar(100) DEFAULT NULL,
  `gd_abstract` varchar(100) DEFAULT NULL,
  `gd_hot` tinyint(5) DEFAULT NULL,
  `gd_is_sale` tinyint(5) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `h_cate` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_food
-- ----------------------------
INSERT INTO `ml_food` VALUES ('9', '6', '板栗', '简介', '1', '1', '15', '16', '222.00');
INSERT INTO `ml_food` VALUES ('10', '6', '牛肉干', '牛肉干的简介', '1', '1', '15', '15', '88.00');

-- ----------------------------
-- Table structure for `ml_food_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_food_cate`;
CREATE TABLE `ml_food_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `h_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_food_cate
-- ----------------------------
INSERT INTO `ml_food_cate` VALUES ('15', '6', '土特产');
INSERT INTO `ml_food_cate` VALUES ('16', '6', '农产品');

-- ----------------------------
-- Table structure for `ml_food_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_food_detail`;
CREATE TABLE `ml_food_detail` (
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_food_detail
-- ----------------------------
INSERT INTO `ml_food_detail` VALUES ('10', '9', '详情介绍', '222.00', '22', '200', '888', '777');
INSERT INTO `ml_food_detail` VALUES ('11', '10', '牛肉干的详情', '88.00', '789', '77', '34', '222');

-- ----------------------------
-- Table structure for `ml_food_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ml_food_pic`;
CREATE TABLE `ml_food_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `is_first` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_food_pic
-- ----------------------------
INSERT INTO `ml_food_pic` VALUES ('20', '9', '20170808\\0f25685eb88995ce10125c92909a30e2.jpg', '0');
INSERT INTO `ml_food_pic` VALUES ('21', '9', '20170808\\59ef5da4b44c7dee09ce5539066649b7.jpg', '0');
INSERT INTO `ml_food_pic` VALUES ('22', '9', '20170808\\5547e35fbdeb25e6c6811583f56aac98.jpg', '0');
INSERT INTO `ml_food_pic` VALUES ('23', '9', '20170808\\e3a4e58910c74fd8debe909994c1cc34.jpg', '1');
INSERT INTO `ml_food_pic` VALUES ('25', '10', '20170808\\301a8439282059fe6c63f42ea3b2911e.jpg', '0');
INSERT INTO `ml_food_pic` VALUES ('26', '10', '20170808\\c7c82bd211d181e544cd599fd8e5fc0e.jpg', '0');
INSERT INTO `ml_food_pic` VALUES ('27', '10', '20170808\\0456abc78ca5068783f803796f82d1ff.jpg', '0');
INSERT INTO `ml_food_pic` VALUES ('28', '10', '20170808\\c3e5ece11e92b276ddf909972dc16dbe.jpg', '1');

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
  `price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel
-- ----------------------------
INSERT INTO `ml_hotel` VALUES ('4', '4', '德月阁', '标准间', '1', '1', '15', '13', '100.00');
INSERT INTO `ml_hotel` VALUES ('5', '4', '美豪丽致酒店', '美豪丽致酒店', '1', '1', '15', '14', '200.00');
INSERT INTO `ml_hotel` VALUES ('6', '4', '云睿酒店', '所有房型设施', '1', '1', '15', '14', '300.00');

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
  `is_wifi` tinyint(1) DEFAULT '0',
  `is_park` tinyint(1) DEFAULT '0',
  `gd_phone` varchar(12) DEFAULT NULL,
  `gd_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gd_gid` (`c_gid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_detail
-- ----------------------------
INSERT INTO `ml_hotel_detail` VALUES ('2', '4', '   高佬庄农家大院算得上是上海金山区数一数二的农家乐，不但可以参观生态种植、享用农家美味，还有很多娱乐配套设施，如射箭、骑马、垂钓等。特色菜高佬庄鱼羊鲜选用千岛湖的野生鱼头，加上农庄自己饲养的羊肉，还有手工打制的鱼丸，鱼羊一起，刚好组成了一个“鲜”字，味道自然鲜美无比。看似普通的稻香粽叶扎肉其实做法另有花样，粽叶里面包裹的并不是猪肉而是羊肉，软糯的羊肉带着粽叶的香气，是农庄大厨自创秘方，口感非常棒。农庄内还有几栋木别墅，可做客房。', '299.00', '11', '199', '12', '0', '1', '1', '1383838438', 'xx省xx市xx区xx路xx号');
INSERT INTO `ml_hotel_detail` VALUES ('3', '5', '美豪丽致酒店位于五羊新城和珠江新城CBD商圈交汇处，地处越秀区繁华商务地段，毗邻广州国际金融中心、琶洲国际会展中心，是上海美豪酒店集团倾心打造的中高端城市度假酒店。', '399.00', '13', '399', '0', '0', '1', '1', null, null);
INSERT INTO `ml_hotel_detail` VALUES ('4', '6', '　上海徐汇云睿酒店位于龙华西路，地处徐家汇商圈，毗邻八万人体育馆、内环高架、地铁站1、3、12、11号线（直达迪斯尼乐园）；邻近上海南站，方便去车前往虹桥机场、虹桥国际枢纽，坐拥便捷、高效的交通。', '333.00', '11', '222', '0', '0', '1', '1', null, null);

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_pic
-- ----------------------------
INSERT INTO `ml_hotel_pic` VALUES ('15', '4', '20170807\\8a1d4172d198325d2ca30c98a325b462.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('16', '5', '2.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('18', '6', '20170807\\e608ae2ad8657ea4ccf2533378edeee9.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('22', '4', '20170808\\ba42fe84f3508c66c054f25afbd015c7.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('23', '4', '20170808\\707775f7e45912476f9b412b02092335.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('24', '4', '20170808\\48ca22469e46f4aced0180a1cc035182.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('25', '4', '20170808\\d7a1cdae49934639eda5451e6e51dc04.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('26', '4', '20170808\\32b2f5a8671a1b856db80e6fcf6991c8.jpg', '1');

-- ----------------------------
-- Table structure for `ml_h_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_h_cate`;
CREATE TABLE `ml_h_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `h_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_h_cate
-- ----------------------------
INSERT INTO `ml_h_cate` VALUES ('13', '4', '农家乐1');
INSERT INTO `ml_h_cate` VALUES ('14', '4', '酒店');
INSERT INTO `ml_h_cate` VALUES ('15', '4', '民宿');

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
-- Table structure for `ml_money`
-- ----------------------------
DROP TABLE IF EXISTS `ml_money`;
CREATE TABLE `ml_money` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_uid` int(11) DEFAULT NULL,
  `m_ten` int(11) DEFAULT '0',
  `m_twenty` int(11) DEFAULT '0',
  `m_fifty` int(11) DEFAULT '0',
  `m_hundred` int(11) DEFAULT '0',
  PRIMARY KEY (`m_id`),
  KEY `m_uid` (`m_uid`),
  CONSTRAINT `ml_money_ibfk_1` FOREIGN KEY (`m_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_money
-- ----------------------------
INSERT INTO `ml_money` VALUES ('1', '1', '12', '2', '2', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

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
INSERT INTO `ml_node` VALUES ('24', '显示所有权限列表', 'User', 'power', '1');
INSERT INTO `ml_node` VALUES ('25', '修改管理员密码', 'User', 'password', '1');
INSERT INTO `ml_node` VALUES ('26', '查看角色列表', 'Cate', 'index', '1');
INSERT INTO `ml_node` VALUES ('27', '添加角色', 'Cate', 'save', '1');
INSERT INTO `ml_node` VALUES ('28', '显示此角色所有权限信息', 'Cate', 'read', '1');
INSERT INTO `ml_node` VALUES ('29', '显示角色编辑页面', 'Cate', 'edit', '1');
INSERT INTO `ml_node` VALUES ('30', '修改角色信息', 'Cate', 'update', '1');
INSERT INTO `ml_node` VALUES ('31', '删除角色', 'Cate', 'delete', '1');
INSERT INTO `ml_node` VALUES ('32', '修改此角色权限', 'Cate', 'nodeedit', '1');
INSERT INTO `ml_node` VALUES ('33', '查看节点列表', 'Node', 'index', '1');
INSERT INTO `ml_node` VALUES ('34', '添加节点', 'Node', 'save', '1');
INSERT INTO `ml_node` VALUES ('35', '显示编辑节点页面', 'Node', 'edit', '1');
INSERT INTO `ml_node` VALUES ('36', '修改节点', 'Node', 'update', '1');
INSERT INTO `ml_node` VALUES ('37', '删除节点', 'Node', 'delete', '1');
INSERT INTO `ml_node` VALUES ('38', '显示所有入驻商铺', 'Buspower', 'index', '1');
INSERT INTO `ml_node` VALUES ('39', '查看某个入驻商铺详情', 'Buspower', 'read', '1');
INSERT INTO `ml_node` VALUES ('40', '重置某个商铺的密码', 'Buspower', 'edit', '1');
INSERT INTO `ml_node` VALUES ('41', '同意商铺入驻的审核', 'Buspower', 'update', '1');
INSERT INTO `ml_node` VALUES ('42', '删除某个商铺', 'Buspower', 'delete', '1');

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
INSERT INTO `ml_role_node` VALUES ('6', '1');
INSERT INTO `ml_role_node` VALUES ('6', '3');
INSERT INTO `ml_role_node` VALUES ('6', '23');
INSERT INTO `ml_role_node` VALUES ('1', '1');
INSERT INTO `ml_role_node` VALUES ('1', '2');
INSERT INTO `ml_role_node` VALUES ('1', '3');
INSERT INTO `ml_role_node` VALUES ('1', '20');
INSERT INTO `ml_role_node` VALUES ('1', '21');
INSERT INTO `ml_role_node` VALUES ('1', '22');
INSERT INTO `ml_role_node` VALUES ('1', '23');
INSERT INTO `ml_role_node` VALUES ('1', '24');
INSERT INTO `ml_role_node` VALUES ('1', '25');
INSERT INTO `ml_role_node` VALUES ('1', '26');
INSERT INTO `ml_role_node` VALUES ('1', '27');
INSERT INTO `ml_role_node` VALUES ('1', '28');
INSERT INTO `ml_role_node` VALUES ('1', '29');
INSERT INTO `ml_role_node` VALUES ('1', '30');
INSERT INTO `ml_role_node` VALUES ('1', '31');
INSERT INTO `ml_role_node` VALUES ('1', '32');
INSERT INTO `ml_role_node` VALUES ('1', '33');
INSERT INTO `ml_role_node` VALUES ('1', '34');
INSERT INTO `ml_role_node` VALUES ('1', '35');
INSERT INTO `ml_role_node` VALUES ('1', '36');
INSERT INTO `ml_role_node` VALUES ('1', '37');
INSERT INTO `ml_role_node` VALUES ('1', '38');
INSERT INTO `ml_role_node` VALUES ('1', '39');
INSERT INTO `ml_role_node` VALUES ('1', '40');
INSERT INTO `ml_role_node` VALUES ('1', '41');
INSERT INTO `ml_role_node` VALUES ('1', '42');
INSERT INTO `ml_role_node` VALUES ('2', '1');
INSERT INTO `ml_role_node` VALUES ('2', '2');
INSERT INTO `ml_role_node` VALUES ('2', '3');
INSERT INTO `ml_role_node` VALUES ('2', '23');
INSERT INTO `ml_role_node` VALUES ('2', '24');
INSERT INTO `ml_role_node` VALUES ('2', '26');
INSERT INTO `ml_role_node` VALUES ('2', '38');
INSERT INTO `ml_role_node` VALUES ('2', '39');

-- ----------------------------
-- Table structure for `ml_route`
-- ----------------------------
DROP TABLE IF EXISTS `ml_route`;
CREATE TABLE `ml_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `gd_title` varchar(100) DEFAULT NULL,
  `gd_abstract` varchar(100) DEFAULT NULL,
  `gd_hot` tinyint(5) DEFAULT NULL,
  `gd_is_sale` tinyint(5) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `h_cate` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_route
-- ----------------------------
INSERT INTO `ml_route` VALUES ('8', '5', 'xx山庄一日游', '宿商务酒店，370元门票全含，激情漂流 一路尖叫 一路欢笑 ', '1', '1', '15', '14', '333.00');

-- ----------------------------
-- Table structure for `ml_route_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_route_cate`;
CREATE TABLE `ml_route_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `h_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_route_cate
-- ----------------------------
INSERT INTO `ml_route_cate` VALUES ('14', '5', '山庄路线');
INSERT INTO `ml_route_cate` VALUES ('15', '5', '渔乡路线');

-- ----------------------------
-- Table structure for `ml_route_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_route_detail`;
CREATE TABLE `ml_route_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_gid` int(11) DEFAULT NULL,
  `gd_details` varchar(255) NOT NULL,
  `gd_price` double(10,2) NOT NULL,
  `gd_store` char(5) NOT NULL,
  `gd_discount` varchar(30) NOT NULL,
  `gd_num` char(11) DEFAULT NULL,
  `gd_view` char(11) DEFAULT NULL,
  `gd_phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gd_gid` (`c_gid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_route_detail
-- ----------------------------
INSERT INTO `ml_route_detail` VALUES ('11', '8', '★精华景点，门票全含！让你湿身清凉一夏！要想漂的爽哪有不湿身！约上好友快快走起吧！\r\n★大明山+龙井峡漂流最经典行程，成功发班2年，不畏惧市场模仿，数百点评供您参考！', '333.00', '11', '222', '87', '210', '021-77887799');

-- ----------------------------
-- Table structure for `ml_route_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ml_route_pic`;
CREATE TABLE `ml_route_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `is_first` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_route_pic
-- ----------------------------
INSERT INTO `ml_route_pic` VALUES ('20', '8', '20170808\\3aba31989683fbc22ca328dc6f2a67cd.jpg', '1');
INSERT INTO `ml_route_pic` VALUES ('21', '8', '20170808\\684f048f7aea9c5fbddf729210c14ad9.jpg', '0');
INSERT INTO `ml_route_pic` VALUES ('22', '8', '20170808\\911f6b70911e25e8c96e616ca7dd776a.jpg', '0');
INSERT INTO `ml_route_pic` VALUES ('23', '8', '20170808\\3eb14af82a457c9195b236271e597fe3.jpg', '0');

-- ----------------------------
-- Table structure for `ml_scenery`
-- ----------------------------
DROP TABLE IF EXISTS `ml_scenery`;
CREATE TABLE `ml_scenery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `gd_title` varchar(100) DEFAULT NULL,
  `gd_abstract` varchar(100) DEFAULT NULL,
  `gd_hot` tinyint(5) DEFAULT NULL,
  `gd_is_sale` tinyint(5) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `h_cate` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery
-- ----------------------------
INSERT INTO `ml_scenery` VALUES ('8', '1', '温泉', '温泉的简介...', '1', '1', '15', '18', '444.00');

-- ----------------------------
-- Table structure for `ml_scenery_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_scenery_cate`;
CREATE TABLE `ml_scenery_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `h_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery_cate
-- ----------------------------
INSERT INTO `ml_scenery_cate` VALUES ('18', '1', '温泉景区');
INSERT INTO `ml_scenery_cate` VALUES ('19', '1', '自然风光');

-- ----------------------------
-- Table structure for `ml_scenery_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_scenery_detail`;
CREATE TABLE `ml_scenery_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_gid` int(11) DEFAULT NULL,
  `gd_details` varchar(255) NOT NULL,
  `gd_price` double(10,2) NOT NULL,
  `gd_store` char(5) NOT NULL,
  `gd_discount` varchar(30) NOT NULL,
  `gd_num` char(11) DEFAULT NULL,
  `gd_view` char(11) DEFAULT NULL,
  `gd_phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gd_gid` (`c_gid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery_detail
-- ----------------------------
INSERT INTO `ml_scenery_detail` VALUES ('11', '8', '温泉的详情介绍...', '444.00', '11', '333', '0', '0', '021-22118833');

-- ----------------------------
-- Table structure for `ml_scenery_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ml_scenery_pic`;
CREATE TABLE `ml_scenery_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `is_first` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery_pic
-- ----------------------------
INSERT INTO `ml_scenery_pic` VALUES ('20', '8', '20170808\\9c6dc8f01d9f88b8933c6b1f00e20b29.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('21', '8', '20170808\\dc775a7182772c75097850882de2e536.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('22', '8', '20170808\\f2c92b3aca2f2793122b3b279102bd29.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('23', '8', '20170808\\255838c2f20c2bb757e3bd671c2c17da.jpg', '1');

-- ----------------------------
-- Table structure for `ml_user`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user`;
CREATE TABLE `ml_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '是否对此用户禁言  默认0 可评论  冻结的评论数量大于三就禁言',
  `u_username` char(32) NOT NULL,
  `u_password` char(32) NOT NULL,
  `u_phone` char(11) NOT NULL,
  `u_create_time` int(8) NOT NULL,
  `is_comment` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_username` (`u_username`),
  UNIQUE KEY `u_password` (`u_password`),
  UNIQUE KEY `u_phone` (`u_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user
-- ----------------------------
INSERT INTO `ml_user` VALUES ('1', '张三', '123', '12345678901', '20170101', '0');
INSERT INTO `ml_user` VALUES ('2', '李四', '000', '99999999999', '56789086', '0');

-- ----------------------------
-- Table structure for `ml_user_address`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user_address`;
CREATE TABLE `ml_user_address` (
  `ua_id` int(11) NOT NULL AUTO_INCREMENT,
  `ua_uid` int(11) NOT NULL,
  `ua_street` char(30) NOT NULL,
  `ua_phone` char(11) NOT NULL,
  `ua_address` varchar(20) NOT NULL,
  `ua_name` char(8) NOT NULL,
  PRIMARY KEY (`ua_id`),
  KEY `ua_uid` (`ua_uid`),
  CONSTRAINT `ml_user_address_ibfk_1` FOREIGN KEY (`ua_uid`) REFERENCES `ml_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user_address
-- ----------------------------
INSERT INTO `ml_user_address` VALUES ('1', '1', '1111', '13375668768', '江苏省/常州市/溧阳市', '111');
INSERT INTO `ml_user_address` VALUES ('2', '1', '大街', '13375668768', '江苏省/常州市/溧阳市', '老王');

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
INSERT INTO `ml_user_detail` VALUES ('1', '1', '20170808/1dfc6f7c4bd01dddcd89fd3a25ba5c43.jpg', '1', '1', '899', '20170808/2d22cd35252195fa26a366644c58bbeb.jpg', '123@qq.com', '啦啦啦');
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
