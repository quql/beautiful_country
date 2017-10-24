/*
Navicat MySQL Data Transfer

Source Server         : 14term
Source Server Version : 50711
Source Host           : 127.0.0.1:3306
Source Database       : country

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-08-17 23:38:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ml_activities`
-- ----------------------------
DROP TABLE IF EXISTS `ml_activities`;
CREATE TABLE `ml_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ac_title` varchar(100) NOT NULL,
  `ac_abstract` varchar(255) NOT NULL,
  `ac_opentime` varchar(255) NOT NULL,
  `ac_closetime` varchar(255) NOT NULL,
  `ac_spot` varchar(100) NOT NULL,
  `ac_host` varchar(100) NOT NULL,
  `ac_cate` varchar(11) NOT NULL,
  `ac_details` varchar(10000) NOT NULL,
  `ac_price` varchar(255) NOT NULL DEFAULT '',
  `ac_status` varchar(11) NOT NULL,
  `ac_contain` varchar(11) NOT NULL,
  `ac_contact` varchar(255) DEFAULT NULL,
  `bus_id` tinyint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_activities
-- ----------------------------
INSERT INTO `ml_activities` VALUES ('30', '[暑期亲子盛会]葡萄采摘+水枪大战+泥潭游戏+水上闯关', '[暑期亲子盛会]葡萄采摘+水枪大战+泥潭游戏+水上闯关', '2017-08-23', '2017-08-30', '西安市·长安区·杨庄乡·红绿灯十字东800米路南悦芽谷·悠然南山', '悦芽谷景区', '3', '09:30：悦芽谷悠然南山大门口点名集合，亲子游戏 10:00：葡萄采摘（参与活动每个家庭赠送一斤，购买每斤15元） 11:00：DIY团扇彩绘，发挥想象力，锻炼小孩子的动手能力 12:00：午餐时间（馒头，米饭，凉皮，时令蔬菜等） 13:00：餐后休息（可以选择在游乐场自由玩耍） 14:00：创意蒸花馍。蝴蝶，兔子，花朵，小猪，天马行空想做就做 15:00：水枪大战，玩个痛快（记着带上雨衣雨鞋，最好多带一套衣服，也可以自带水枪哦） 16:00：泥潭游戏，泥潭湿身，模仿《跑男》，变身呆萌泥人 17:00：水上闯关，沙池游乐场拓展游戏 16:00：活动结束，带着满满的收获，返回温暖的家', '费用：¥198起', '1', '100', '18121280312', '15');
INSERT INTO `ml_activities` VALUES ('31', '[暑假亲子]帐篷露营+拓展训练+求生课堂+水枪大赛', '[暑假亲子]帐篷露营+拓展训练+求生课堂+水枪大赛', '2017-08-11', '2017-08-25', '西安市·长安区·沣峪口进山5公里大蒿沟度假山庄(近210国道)', '屈强龙', '23', '14:00-16:00：水枪大战 分三组进行，1-2组先上场比赛，名牌遇水变色，变色即为淘汰，换第三组上场。每人3张名牌，可进行3场比赛。 水枪大战.jpg 16:00-17:30：花馍大赛 由主持人演示，教授制作花馍；小朋友们尽情发挥想象力，做自己喜欢的花馍，蒸出来以后，鼓励和其他小朋友分享成果。 创意蒸花馍.jpg 19:30-20:30：篝火晚会 搭配音响设施，由主持人活跃气氛，唱歌、跳舞等，增进亲子感情。 篝火晚会.jpg 20:30-21:30：帐篷搭建 主持人在空地上演示帐篷搭建，演示结束，工作人员提供讲解与帮助。孩子和家长动手搭建自己的帐篷，增强动手能力。 帐篷露营.jpg 第二天：晨跑练操+徒步拓展+求生课堂+树叶拼图 7:30-8:30：晨练跑操 洗漱完毕，空地集合，由主持人带领跑圈和教授军体拳。 3.jpg 8:30-10:00：徒步拓展 主持人带领进山，感受秦岭山水的无限风光，注意避免暴晒，沿途介绍动植物知识。 2.jpg 10:00-10:30：求生课堂 预备纱布、指南针等道具，主持人介绍野外求生知识。 4.jpg 10:30-11:00：树叶拼图 主持人演示如何用树叶拼合一，小朋友们亲自动手，进行拼图。 树叶拼画.jpg 14:00-15:00：颁奖授勋 农家乐空地，拉横幅，由主持人颁奖，合影留念。', '费用：¥180起', '1', '100', '18121280312', '15');
INSERT INTO `ml_activities` VALUES ('32', '[周末特惠]登南五台山,游关中民俗艺术博物院', '[周末特惠]登南五台山,游关中民俗艺术博物院', '2017-08-01', '2017-08-10', '西安市·长安区·关中民俗艺术博物院', '谢东海', '2', '南五台，古称太乙山，上有灵应、观音、舍身、清凉、文殊五个台，故名南五台。自然景观优美，风景极为秀丽，人文景观丰富，至今保留有紫竹林、圣寿寺、弥陀寺、圆光寺、黑虎殿、印光大师影堂、观音大师应身塔（隋塔）等寺院塔堂，是久负盛名的佛教名山、皇家避暑之地。据<<关中通志>>载：', '费用：¥118起', '1', '111', '18121280312', '15');

-- ----------------------------
-- Table structure for `ml_activities_register`
-- ----------------------------
DROP TABLE IF EXISTS `ml_activities_register`;
CREATE TABLE `ml_activities_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ar_opentime` varchar(100) NOT NULL,
  `ar_closetime` varchar(255) NOT NULL,
  `ar_amount` varchar(255) NOT NULL,
  `ar_condinator` varchar(255) NOT NULL,
  `ar_contact` varchar(255) NOT NULL,
  `ar_comments` varchar(255) NOT NULL,
  `ar_submit_time` varchar(255) NOT NULL,
  `ar_bus_id` varchar(255) NOT NULL,
  `ar_activities_id` varchar(255) NOT NULL,
  `ar_user_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_activities_register
-- ----------------------------
INSERT INTO `ml_activities_register` VALUES ('34', '2017-08-19', '2017-08-19', '2DECX', 'CEEW C', '  D ', ' DS ', '1502802351', '15', '41', '1');
INSERT INTO `ml_activities_register` VALUES ('35', '2017-08-23', '2017-08-16', '无法的v', ' 风 ', ' 官方风', ' 浮动 ', '2017-08-15 21:12:58', '15', '41', '1');
INSERT INTO `ml_activities_register` VALUES ('36', '2017-08-12', '2017-08-19', '认为此次', '但是但是', '二次', ' 收到', '2017-08-15 22:05:45', '15', '41', '1');
INSERT INTO `ml_activities_register` VALUES ('37', '2017-08-17', '2017-08-26', '成都市从', ' 收到的', '是但是', '的', '2017-08-15 22:12:28', '15', '41', '1');
INSERT INTO `ml_activities_register` VALUES ('38', '2017-08-24', '2017-08-25', '22', 'dad', '12345678909', 'saDAD', '2017-08-15 23:54:55', '15', '30', '4');

-- ----------------------------
-- Table structure for `ml_ac_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_ac_cate`;
CREATE TABLE `ml_ac_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ac_name` varchar(50) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_ac_cate
-- ----------------------------
INSERT INTO `ml_ac_cate` VALUES ('23', '赏花踏青', '2');
INSERT INTO `ml_ac_cate` VALUES ('2', '文化古镇', '2');
INSERT INTO `ml_ac_cate` VALUES ('3', '休闲度假', '2');
INSERT INTO `ml_ac_cate` VALUES ('4', '户外拓展', '2');
INSERT INTO `ml_ac_cate` VALUES ('22', '自然风光', '2');

-- ----------------------------
-- Table structure for `ml_ac_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ml_ac_pic`;
CREATE TABLE `ml_ac_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(11) NOT NULL,
  `pic` varchar(60) DEFAULT NULL,
  `is_first` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_ac_pic
-- ----------------------------
INSERT INTO `ml_ac_pic` VALUES ('49', '33', '20170810\\6ca97f9bf66e0b3762e97b5a6e33f8b8.jpg', '0');
INSERT INTO `ml_ac_pic` VALUES ('46', '30', '20170810\\33ef793ce9a1533cbcc60553d130ce71.jpg', '1');
INSERT INTO `ml_ac_pic` VALUES ('47', '31', '20170810\\c9ac94f84b17362ddf8883c9e151ab96.jpg', '0');
INSERT INTO `ml_ac_pic` VALUES ('48', '32', '20170810\\6640690df6526d2154ec2b5d78ea71f5.jpg', '0');

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
INSERT INTO `ml_admin_user` VALUES ('2', '鼠没人', '1', '1234', '1', '20', '20170809\\8d201190c19bd806bde21ff9bb89f389.jpg', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_business
-- ----------------------------
INSERT INTO `ml_business` VALUES ('14', '0', '4', 'x', 'e10adc3949ba59abbe56e057f20f883e', '12345678906', '安徽省', '合肥市', '瑶海区', '/uploads/20170802\\f7c046aba22e97f50f1f1674711f6071.jpg', '2017-08-01 13:56:53', 'Y', '');
INSERT INTO `ml_business` VALUES ('15', '0', 'shine', 'shine', 'e10adc3949ba59abbe56e057f20f883e', '12345678904', '河南省', '南阳市', '宛城区', null, '2017-08-01 21:13:59', 'Y', null);
INSERT INTO `ml_business` VALUES ('16', '2', 'qql', '东海集团', 'e10adc3949ba59abbe56e057f20f883e', '12222222211', '安徽省', '蚌埠市', '固镇县', null, '2017-08-10 14:58:23', 'Y', null);
INSERT INTO `ml_business` VALUES ('19', '0', '123', '12', 'e10adc3949ba59abbe56e057f20f883e', '13127573831', '甘肃省', '嘉峪关市', '　', null, '2017-08-13 16:15:41', 'N', null);

-- ----------------------------
-- Table structure for `ml_bus_comment`
-- ----------------------------
DROP TABLE IF EXISTS `ml_bus_comment`;
CREATE TABLE `ml_bus_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评价id',
  `c_content` varchar(140) DEFAULT NULL COMMENT '评价内容',
  `c_atime` varchar(140) NOT NULL COMMENT '评价提交的时间',
  `com_id` tinyint(1) NOT NULL,
  `bid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_bus_comment
-- ----------------------------
INSERT INTO `ml_bus_comment` VALUES ('10', 'sdhfnmhfd', '2017-08-17 20:30:33', '2', '15');
INSERT INTO `ml_bus_comment` VALUES ('11', '学金融和繁荣和刚和他的规划提供合同号规划和机顶盒和推广和认同感', '2017-08-17 20:35:34', '3', '15');
INSERT INTO `ml_bus_comment` VALUES ('12', 'thankyou', '2017-08-17 20:46:48', '7', '15');

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
  `ca_photo` varchar(100) DEFAULT NULL,
  `ca_gname` varchar(20) DEFAULT NULL,
  `ca_gtype` varchar(20) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `ca_point` varchar(100) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  PRIMARY KEY (`ca_id`),
  KEY `ca_uid` (`ca_uid`),
  KEY `ca_gdid` (`ca_gdid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_cart
-- ----------------------------
INSERT INTO `ml_cart` VALUES ('1', '4', '9', '1', '222.00', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '板栗', '特产美食', '6', '11', '15');
INSERT INTO `ml_cart` VALUES ('2', '1', '13', '1', '444.00', '20170817\\05686f18907888d694f47976c7c71669.jpg', '婺源灵岩洞国家森林公园', '景区', '1', '22', '16');

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
  `c_time` varchar(140) NOT NULL COMMENT '评价提交的时间',
  `is_ban` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁播此评价 0开放 1禁播',
  `c_cid` tinyint(1) NOT NULL,
  `c_bid` int(11) NOT NULL,
  `c_gname` varchar(255) NOT NULL,
  `c_oid` int(11) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `c_gid` (`c_gid`),
  KEY `c_uid` (`c_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_comment
-- ----------------------------
INSERT INTO `ml_comment` VALUES ('2', '8', '1', '5', '第三次工业地铁 ', '2017-08-17 11:49:54', '0', '6', '15', '山庄', '0');
INSERT INTO `ml_comment` VALUES ('3', '8', '1', '5', '第三次工业地铁 ', '2017-08-17 11:52:53', '0', '6', '15', '山庄', '0');
INSERT INTO `ml_comment` VALUES ('4', '8', '1', '5', '第三次工业地铁 ', '2017-08-17 11:54:14', '0', '6', '15', '山庄', '0');
INSERT INTO `ml_comment` VALUES ('5', '8', '1', '1', '这个东西 垃圾..................', '2017-08-17 12:31:33', '0', '6', '15', '山庄', '46');
INSERT INTO `ml_comment` VALUES ('6', '9', '1', '2', '一般', '2017-08-17 14:19:40', '0', '6', '15', '板栗', '50');
INSERT INTO `ml_comment` VALUES ('7', '8', '1', '2', '还能说点什么呢', '2017-08-17 14:22:40', '0', '5', '15', '山庄', '53');
INSERT INTO `ml_comment` VALUES ('9', '8', '1', '5', 'snxfrr', '2017-08-17 18:04:04', '1', '6', '15', '山庄', '47');

-- ----------------------------
-- Table structure for `ml_count`
-- ----------------------------
DROP TABLE IF EXISTS `ml_count`;
CREATE TABLE `ml_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `view` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `login` int(11) DEFAULT '0',
  `register` int(11) DEFAULT '0',
  `trade` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  `hotel` int(11) DEFAULT '0',
  `food` int(11) DEFAULT '0',
  `scenery` int(11) DEFAULT '0',
  `route` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_count
-- ----------------------------
INSERT INTO `ml_count` VALUES ('1', '119', '29218', '0', '8', '1288', '130', '240', '523', '235', '187');

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
INSERT INTO `ml_food` VALUES ('9', '6', '板栗', 'saddd', '1', '1', '15', '16', '222.00');

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
INSERT INTO `ml_food_cate` VALUES ('15', '6', '土特产1');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_food_detail
-- ----------------------------
INSERT INTO `ml_food_detail` VALUES ('10', '9', 'sadas', '222.00', '22', '200', '0', '114');

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_food_pic
-- ----------------------------
INSERT INTO `ml_food_pic` VALUES ('20', '10', '2.jpg', '1');
INSERT INTO `ml_food_pic` VALUES ('21', '9', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel
-- ----------------------------
INSERT INTO `ml_hotel` VALUES ('4', '4', '德月阁', '高佬庄鱼羊鲜 木别墅 一日游', '1', '1', '15', '13', '100.00');
INSERT INTO `ml_hotel` VALUES ('5', '4', '美豪丽致酒店', '美豪丽致酒店', '1', '1', '15', '14', '200.00');
INSERT INTO `ml_hotel` VALUES ('6', '4', '云睿酒店', '所有房型设施', '1', '1', '15', '14', '300.00');
INSERT INTO `ml_hotel` VALUES ('9', '4', '大床房', 'sadadd', '1', '1', '16', '14', '333.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_detail
-- ----------------------------
INSERT INTO `ml_hotel_detail` VALUES ('2', '4', '   高佬庄农家大院算得上是上海金山区数一数二的农家乐，不但可以参观生态种植、享用农家美味，还有很多娱乐配套设施，如射箭、骑马、垂钓等。特色菜高佬庄鱼羊鲜选用千岛湖的野生鱼头，加上农庄自己饲养的羊肉，还有手工打制的鱼丸，鱼羊一起，刚好组成了一个“鲜”字，味道自然鲜美无比。看似普通的稻香粽叶扎肉其实做法另有花样，粽叶里面包裹的并不是猪肉而是羊肉，软糯的羊肉带着粽叶的香气，是农庄大厨自创秘方，口感非常棒。农庄内还有几栋木别墅，可做客房。', '299.00', '9', '199', '12', '4', '1', '1', '1383838438', 'xx省xx市xx区xx路xx号');
INSERT INTO `ml_hotel_detail` VALUES ('3', '5', '美豪丽致酒店位于五羊新城和珠江新城CBD商圈交汇处，地处越秀区繁华商务地段，毗邻广州国际金融中心、琶洲国际会展中心，是上海美豪酒店集团倾心打造的中高端城市度假酒店。', '399.00', '13', '399', '0', '29', '1', '1', '1111111111', 'xx省xx市xx区xx路xx号');
INSERT INTO `ml_hotel_detail` VALUES ('4', '6', '　上海徐汇云睿酒店位于龙华西路，地处徐家汇商圈，毗邻八万人体育馆、内环高架、地铁站1、3、12、11号线（直达迪斯尼乐园）；邻近上海南站，方便去车前往虹桥机场、虹桥国际枢纽，坐拥便捷、高效的交通。', '333.00', '11', '222', '0', '26', '1', '1', '1234323343', 'xx省xx市xx区xx路xx号');
INSERT INTO `ml_hotel_detail` VALUES ('5', '9', 'dadadd', '333.00', '2', '222', '0', '6', '1', '1', '12345678901', '长江东路');

-- ----------------------------
-- Table structure for `ml_hotel_order`
-- ----------------------------
DROP TABLE IF EXISTS `ml_hotel_order`;
CREATE TABLE `ml_hotel_order` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_bid` int(11) DEFAULT NULL,
  `o_gid` int(11) DEFAULT NULL,
  `o_uid` int(11) DEFAULT NULL,
  `o_time` char(30) DEFAULT NULL,
  `o_status` tinyint(4) DEFAULT NULL,
  `o_num` tinyint(2) DEFAULT NULL,
  `o_price` double(10,2) DEFAULT NULL,
  `o_order_num` varchar(32) DEFAULT NULL,
  `o_total` double(10,2) DEFAULT NULL,
  `o_gname` varchar(30) DEFAULT NULL,
  `o_photo` varchar(100) DEFAULT NULL,
  `intime` varchar(100) DEFAULT NULL,
  `inname` varchar(20) DEFAULT NULL,
  `inphone` char(11) DEFAULT NULL,
  PRIMARY KEY (`o_id`),
  KEY `o_bid` (`o_bid`),
  KEY `o_gid` (`o_gid`),
  KEY `o_uid` (`o_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_order
-- ----------------------------
INSERT INTO `ml_hotel_order` VALUES ('52', '15', '6', '1', '2017-08-11 20:03:15', '0', '2', '333.00', '1502452995568081032', '666.00', '所有房型设施', '20170807\\e608ae2ad8657ea4ccf2533378edeee9.jpg', '2017/08/11 to 2017/08/11', 'qwrw', '13083036399');
INSERT INTO `ml_hotel_order` VALUES ('53', '15', '6', '4', '2017-08-12 21:37:22', '0', '1', '333.00', '1502545042719615439', '1332.00', '所有房型设施', '20170807\\e608ae2ad8657ea4ccf2533378edeee9.jpg', '2017/08/12 to 2017/08/16', 'qwrw', '13083036399');
INSERT INTO `ml_hotel_order` VALUES ('54', '15', '5', '4', '2017-08-12 21:41:20', '0', '1', '399.00', '1502545280411451669', '399.00', '美豪丽致酒店', '2.jpg', '2017/08/12 to 2017/08/12', 'qwrw', '13083036399');
INSERT INTO `ml_hotel_order` VALUES ('55', '15', '6', '4', '2017-08-12 21:46:36', '0', '1', '333.00', '1502545596655703458', '333.00', '所有房型设施', '20170807\\e608ae2ad8657ea4ccf2533378edeee9.jpg', '2017/08/12 to 2017/08/12', 'qwrw', '13083036399');
INSERT INTO `ml_hotel_order` VALUES ('56', '15', '6', '4', '2017-08-15 23:51:04', '0', '2', '333.00', '1502812264916284307', '1332.00', '所有房型设施', '20170807\\e608ae2ad8657ea4ccf2533378edeee9.jpg', '2017/08/15 to 2017/08/17', 'qwrw', '13083036399');
INSERT INTO `ml_hotel_order` VALUES ('57', '15', '4', '4', '2017-08-17 21:43:17', '0', '1', '100.00', '1502977397974777272', '100.00', '德月阁', '20170807\\8a1d4172d198325d2ca30c98a325b462.jpg', '2017.08.17　to　2017.08.18', 'qq', '13083036399');
INSERT INTO `ml_hotel_order` VALUES ('58', '15', '4', '4', '2017-08-17 21:48:23', '0', '1', '100.00', '1502977703755118094', '900.00', '德月阁', '20170807\\8a1d4172d198325d2ca30c98a325b462.jpg', '2017.08.17　to　2017.08.26', 'ss', '13083036399');

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_hotel_pic
-- ----------------------------
INSERT INTO `ml_hotel_pic` VALUES ('15', '4', '20170807\\8a1d4172d198325d2ca30c98a325b462.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('16', '5', '2.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('18', '6', '20170807\\e608ae2ad8657ea4ccf2533378edeee9.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('21', '4', '20170809\\0b470b9c8b252a68f478ca22445a874f.jpg', '0');
INSERT INTO `ml_hotel_pic` VALUES ('23', '9', '2.jpg', '1');
INSERT INTO `ml_hotel_pic` VALUES ('24', '9', '20170810\\2cc99aea045246c7947a74ea7a7ec2b7.jpg', '0');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `l_name` char(32) DEFAULT NULL,
  `l_logo` varchar(100) DEFAULT NULL,
  `l_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `l_logo` (`l_logo`) USING BTREE,
  KEY `l_name` (`l_name`) USING BTREE,
  KEY `l_url` (`l_url`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_link
-- ----------------------------
INSERT INTO `ml_link` VALUES ('9', '百度', '20170810\\45989f34f13bb4090de8e1747e8a8c34.png', 'http://www.baidu.com');
INSERT INTO `ml_link` VALUES ('10', '阿里巴巴', '20170810\\2ff954248b3b827219b23e7f271a19c3.png', 'http://www.alibaba.com');
INSERT INTO `ml_link` VALUES ('11', '腾讯', '20170810\\b7fb9ed2e4665032857cfbdd8ef7f7f4.png', 'http://www.qq.com');

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
INSERT INTO `ml_money` VALUES ('1', '1', '3', '0', '2', '1');

-- ----------------------------
-- Table structure for `ml_morder`
-- ----------------------------
DROP TABLE IF EXISTS `ml_morder`;
CREATE TABLE `ml_morder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `total` double(10,2) DEFAULT NULL,
  `time` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_morder
-- ----------------------------
INSERT INTO `ml_morder` VALUES ('16', '1', '2', '1776.00', '2017-08-11 15:12:32');
INSERT INTO `ml_morder` VALUES ('17', '1', '2', '2442.00', '2017-08-11 15:17:09');
INSERT INTO `ml_morder` VALUES ('18', '1', '2', '2442.00', '2017-08-11 15:19:29');
INSERT INTO `ml_morder` VALUES ('19', '1', '2', '1998.00', '2017-08-11 15:20:05');
INSERT INTO `ml_morder` VALUES ('20', '1', '2', '1998.00', '2017-08-11 15:20:19');
INSERT INTO `ml_morder` VALUES ('21', '1', '2', '2664.00', '2017-08-11 15:22:13');
INSERT INTO `ml_morder` VALUES ('22', '1', '2', '444.00', '2017-08-11 16:05:55');
INSERT INTO `ml_morder` VALUES ('23', '1', '2', '1776.00', '2017-08-11 16:14:30');
INSERT INTO `ml_morder` VALUES ('24', '1', '2', '3108.00', '2017-08-11 16:15:19');
INSERT INTO `ml_morder` VALUES ('25', '4', '3', '222.00', '2017-08-12 14:53:11');
INSERT INTO `ml_morder` VALUES ('26', '4', '3', '555.00', '2017-08-15 23:51:51');

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
  `o_time` char(30) DEFAULT NULL,
  `o_status` tinyint(4) DEFAULT NULL,
  `o_num` tinyint(2) DEFAULT NULL,
  `o_price` double(10,2) DEFAULT NULL,
  `o_order_num` varchar(32) DEFAULT NULL,
  `o_total` double(10,2) DEFAULT NULL,
  `o_gname` varchar(30) DEFAULT NULL,
  `o_photo` varchar(100) DEFAULT NULL,
  `o_cid` int(11) DEFAULT NULL,
  `moid` int(11) DEFAULT NULL,
  PRIMARY KEY (`o_id`),
  KEY `o_bid` (`o_bid`),
  KEY `o_gid` (`o_gid`),
  KEY `o_uid` (`o_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_order
-- ----------------------------
INSERT INTO `ml_order` VALUES ('46', '15', '8', '1', '2017-08-11 15:22:13', '0', '3', '333.00', '1502436133983544916', '999.00', '山庄', '2.jpg', '6', '21');
INSERT INTO `ml_order` VALUES ('47', '15', '8', '1', '2017-08-11 15:22:13', '1', '5', '333.00', '1502436133983544916', '1665.00', '山庄', '2.jpg', '6', '21');
INSERT INTO `ml_order` VALUES ('48', '15', '9', '1', '2017-08-11 16:05:55', '2', '2', '222.00', '1502438755772383331', '444.00', '板栗', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '6', '22');
INSERT INTO `ml_order` VALUES ('49', '15', '9', '1', '2017-08-11 16:14:30', '3', '3', '222.00', '1502439270507013584', '666.00', '板栗', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '6', '23');
INSERT INTO `ml_order` VALUES ('50', '15', '9', '1', '2017-08-11 16:14:30', '1', '5', '222.00', '1502439270507013584', '1110.00', '板栗', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '6', '23');
INSERT INTO `ml_order` VALUES ('51', '15', '9', '1', '2017-08-11 16:15:19', '2', '14', '222.00', '1502439319422091664', '3108.00', '板栗', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '6', '24');
INSERT INTO `ml_order` VALUES ('52', '15', '9', '4', '2017-08-12 14:53:11', '0', '1', '222.00', '1502520791578162922', '222.00', '板栗', '20170809\\e7fbb988f5c41d673ae26884417bd06c.jpg', '6', '25');
INSERT INTO `ml_order` VALUES ('53', '15', '9', '4', '2017-08-15 23:51:51', '0', '1', '555.00', '1502812311451293138', '555.00', '云海', '2.jpg', '1', '26');

-- ----------------------------
-- Table structure for `ml_pic`
-- ----------------------------
DROP TABLE IF EXISTS `ml_pic`;
CREATE TABLE `ml_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(60) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_pic
-- ----------------------------
INSERT INTO `ml_pic` VALUES ('22', '20170809\\7a1d9b67454b6bdf83f33b61224c4f32.jpg', '1', 'sde');

-- ----------------------------
-- Table structure for `ml_register`
-- ----------------------------
DROP TABLE IF EXISTS `ml_register`;
CREATE TABLE `ml_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_register
-- ----------------------------
INSERT INTO `ml_register` VALUES ('1', '2017-08-17 14:22:40');
INSERT INTO `ml_register` VALUES ('2', '2017-08-16 14:22:40');
INSERT INTO `ml_register` VALUES ('3', '2017-08-15 14:22:40');
INSERT INTO `ml_register` VALUES ('4', '2017-08-14 14:22:40');
INSERT INTO `ml_register` VALUES ('5', '2017-08-13 14:22:40');
INSERT INTO `ml_register` VALUES ('6', '2017-08-12 14:22:40');
INSERT INTO `ml_register` VALUES ('7', '2017-08-11 14:22:40');
INSERT INTO `ml_register` VALUES ('8', '2017-08-10 14:22:40');
INSERT INTO `ml_register` VALUES ('9', '2017-08-09 14:22:40');
INSERT INTO `ml_register` VALUES ('10', '2017-08-08 14:22:40');
INSERT INTO `ml_register` VALUES ('11', '2017-08-07 14:22:40');
INSERT INTO `ml_register` VALUES ('12', '2017-08-06 14:22:40');
INSERT INTO `ml_register` VALUES ('13', '2017-08-05 14:22:40');
INSERT INTO `ml_register` VALUES ('14', '2017-08-04 14:22:40');
INSERT INTO `ml_register` VALUES ('15', '2017-08-03 14:22:40');
INSERT INTO `ml_register` VALUES ('16', '2017-08-02 14:22:40');
INSERT INTO `ml_register` VALUES ('17', '2017-08-01 14:22:40');
INSERT INTO `ml_register` VALUES ('18', '2017-08-17 14:22:41');
INSERT INTO `ml_register` VALUES ('19', '2017-08-17 14:22:42');
INSERT INTO `ml_register` VALUES ('20', '2017-08-16 14:22:48');
INSERT INTO `ml_register` VALUES ('21', '2017-08-17 15:37:31');

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
INSERT INTO `ml_route` VALUES ('8', '5', '山庄', 'sadd', '1', '1', '15', '14', '333.00');

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
INSERT INTO `ml_route_detail` VALUES ('11', '8', '★精华景点，门票全含！让你湿身清凉一夏！要想漂的爽哪有不湿身！约上好友快快走起吧！\r\n★大明山+龙井峡漂流最经典行程，成功发班2年，不畏惧市场模仿，数百点评供您参考！', '333.00', '11', '222', '87', '231', '021-77887799');

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_route_pic
-- ----------------------------
INSERT INTO `ml_route_pic` VALUES ('19', '8', '2.jpg', '1');

-- ----------------------------
-- Table structure for `ml_scenery`
-- ----------------------------
DROP TABLE IF EXISTS `ml_scenery`;
CREATE TABLE `ml_scenery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `gd_title` varchar(100) DEFAULT NULL,
  `gd_abstract` varchar(255) DEFAULT NULL,
  `gd_hot` tinyint(5) DEFAULT NULL,
  `gd_is_sale` tinyint(5) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `h_cate` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery
-- ----------------------------
INSERT INTO `ml_scenery` VALUES ('8', '1', '温泉', 'dfDdD', '1', '1', '15', '18', '444.00');
INSERT INTO `ml_scenery` VALUES ('9', '1', '云海', 'sasasa', '1', '1', '15', '19', '3333.00');
INSERT INTO `ml_scenery` VALUES ('10', '1', '最美的江南，最柔的水乡', '微风挟着春意，卷地而来…错杂的藤蔓带着深沉，交织在白色的墙架上，错落有致。', '1', '1', '15', '19', '222.00');
INSERT INTO `ml_scenery` VALUES ('11', '1', '中国云顶', '中国云顶,走于濒临深渊的悬崖栈道，饱览千万年原始峡谷，云中四季观景梯田，凌空飞越通天索道，还有一口万年不干直通地心的天池!所有一切，让你泊云、揽色、心自宽……', '1', '1', '16', '18', '111.00');
INSERT INTO `ml_scenery` VALUES ('12', '1', '南昌梅岭花谷漂流', '江西梅岭漂流旅游有限公司是由香港多伦多企业集团投资有限公司独家投资的，以漂流为主营项目的旅游型公司。其经营占地面积约3800亩，漂流河道全长近10公里。梅岭漂流所在地的常年气温比南昌市区低4-5度，空气中负离子的含量是市区的6倍左右，是天然的大氧吧。', '1', '1', '16', '19', '333.00');
INSERT INTO `ml_scenery` VALUES ('13', '1', '婺源灵岩洞国家森林公园', '公园以瑰奇深幽闻名，内分灵岩洞群、石城古树群、石林奇观三个小区，1993年列为国家森林公园；园内山岳为黄山余脉，是一个集自然风光与人文景观为一体的风景名胜区；', '1', '1', '16', '20', '444.00');
INSERT INTO `ml_scenery` VALUES ('14', '1', '湾里冰零城下', '冰零城下是集冰雕、滑雪、旅游、探险、亲子、聚会、狂欢为一体的综合性冰雕冰雪。打造了故事传说、传统文化、冰雪项目与现代科技相融合的室内冰雕体验馆', '1', '1', '16', '21', '222.00');

-- ----------------------------
-- Table structure for `ml_scenery_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ml_scenery_cate`;
CREATE TABLE `ml_scenery_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `h_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery_cate
-- ----------------------------
INSERT INTO `ml_scenery_cate` VALUES ('18', '1', '春季');
INSERT INTO `ml_scenery_cate` VALUES ('19', '1', '夏季');
INSERT INTO `ml_scenery_cate` VALUES ('20', '1', '秋季');
INSERT INTO `ml_scenery_cate` VALUES ('21', '1', '冬季');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery_detail
-- ----------------------------
INSERT INTO `ml_scenery_detail` VALUES ('11', '8', '温泉的详情介绍...', '444.00', '11', '333', '0', '7', '021-22118833');
INSERT INTO `ml_scenery_detail` VALUES ('12', '9', '山庄的情凉', '555.00', '10', '333', '7', '8', '002-33322222');
INSERT INTO `ml_scenery_detail` VALUES ('13', '10', '微风挟着春意，卷地而来…错杂的藤蔓带着深沉，交织在白色的墙架上，错落有致。一朵朵紫藤花，绽放在纠缠的枝蔓上，被一丝细如纤发的须条牵系在裸露的空中，好像随时都可能被一阵风刮跑……藤蔓间那零星点缀着的紫色小花犹如慵懒的女子沉睡在清晨最美的朝阳中。早春微寒，海棠花却开的热闹。海棠种类繁多，树形多样，叶茂花繁，丰盈娇艳。在江南，最让人倾情的当属垂丝海棠，红花满枝，纷披婉垂，院子里左右两边各栽上一株，绿红相映高悬枝间，恰似红灯点点，乘风荡漾，别具风姿。海棠树下，一对情人，温情相拥，浪漫着，幸福着。', '222.00', '2', '199', '0', '10', '021-2232424');
INSERT INTO `ml_scenery_detail` VALUES ('14', '11', '按照5A级标准建设的集观光休闲、度假养生、求知探险、科普教育为一体综合型的旅游目的地，努力打造成“福州人引以为傲的福建旅游新地标”和“中国省城特色的高山休闲度假基地”', '111.00', '11', '99', '0', '1', '13345678901');
INSERT INTO `ml_scenery_detail` VALUES ('15', '12', '南昌梅岭漂流沿线两岸峡谷险峻，风光旖旎，让游客在青山绿水中自由翱翔。梅岭漂流起点为龚家桥，终点到溪霞水库。一期开漂的河道长约5公里，漂流的时间为2.5-3个小时。因地势的变化，溪流时而温柔平静、时而湍急，故有平漂和急漂之别。平漂时让你体验“筏在水中漂，人在画中游”。急漂处让你体验惊心动魄之感。在每个急漂处都设有护漂人员，指引和保护你安全的漂流。', '333.00', '22', '232', '0', '1', '13345678901');
INSERT INTO `ml_scenery_detail` VALUES ('16', '13', '江西灵岩洞国家森林公园位于江西省婺源县境内，1988年建园，面积为3000公顷。灵岩洞群由卿云、莲华、涵虚、凌虚、萃灵、琼芝等36个溶洞组成。洞体大者雄浑奇伟，小者玲珑秀丽。洞内泉流澄清皎洁，水石相映成趣，石笋、石花、石柱、石幔琳琅满目，千姿百态。', '444.00', '11', '199', '0', '1', '13345678901');
INSERT INTO `ml_scenery_detail` VALUES ('17', '14', '南昌冰零城下之北极冰雪王国坐落于湾里区太平镇，利用现代制冷、声、光、电等技术，打造集故事传说、传统文化、冰雪项目与现代科技相融合的室内冰雕体验馆。项目建成后将提供冰雕、滑雪、滑冰、冰上保龄球、冰吧等娱乐项目。它引进国内外先进技术，邀请国内外冰雕大师细心打造的大型室内冰雕冰雪游乐园，集冰雕，滑雪，旅游，探险，亲子，聚会，狂欢为一体的综合性冰雕冰雪 园。让你感受冰雪世界的奇幻魅力，给你一夏的清凉和雪的世界', '222.00', '22', '111', '0', '1', '13345678901');

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_scenery_pic
-- ----------------------------
INSERT INTO `ml_scenery_pic` VALUES ('19', '8', '2.jpg', '1');
INSERT INTO `ml_scenery_pic` VALUES ('20', '9', '2.jpg', '1');
INSERT INTO `ml_scenery_pic` VALUES ('26', '10', '20170816\\58aac505bb801a6173730c38278fd807.jpg', '1');
INSERT INTO `ml_scenery_pic` VALUES ('28', '11', '20170817\\40661d74583501a0615ba70d061a290a.jpg', '1');
INSERT INTO `ml_scenery_pic` VALUES ('29', '11', '20170817\\96c8fd6b12f944ec7594c0999495e0ab.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('30', '11', '20170817\\ff68707a97cbaa0fe235a0509dce4574.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('32', '12', '20170817\\29ebc995727eb441f4328455a30c8f0a.jpg', '1');
INSERT INTO `ml_scenery_pic` VALUES ('33', '12', '20170817\\ab0f5251f9ecd8c6f227f78fb636fbe8.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('34', '12', '20170817\\a695714e4b1e63928b57241c146e5c0d.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('40', '14', '20170817\\19766a17a96c64433d4e53348e0efd34.png', '0');
INSERT INTO `ml_scenery_pic` VALUES ('36', '13', '20170817\\05686f18907888d694f47976c7c71669.jpg', '1');
INSERT INTO `ml_scenery_pic` VALUES ('37', '13', '20170817\\214a53dfff926027e1c8601de8d81688.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('38', '13', '20170817\\9b3299abbd86723bae4223eee8475e80.jpg', '0');
INSERT INTO `ml_scenery_pic` VALUES ('41', '14', '20170817\\7f0b7253397370b587ecbfe30974ef2a.png', '0');
INSERT INTO `ml_scenery_pic` VALUES ('42', '14', '20170817\\c4f136f0ec880300e2a746dcf2686488.png', '1');
INSERT INTO `ml_scenery_pic` VALUES ('43', '14', '20170817\\91ba16b83dfe94676dda27582e343aa6.png', '0');

-- ----------------------------
-- Table structure for `ml_trade`
-- ----------------------------
DROP TABLE IF EXISTS `ml_trade`;
CREATE TABLE `ml_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_trade
-- ----------------------------
INSERT INTO `ml_trade` VALUES ('1', '2017-08-17 14:22:40');
INSERT INTO `ml_trade` VALUES ('2', '2017-08-16 14:22:40');
INSERT INTO `ml_trade` VALUES ('3', '2017-08-15 14:22:40');
INSERT INTO `ml_trade` VALUES ('4', '2017-08-14 14:22:40');
INSERT INTO `ml_trade` VALUES ('5', '2017-08-13 14:22:40');
INSERT INTO `ml_trade` VALUES ('6', '2017-08-12 14:22:40');
INSERT INTO `ml_trade` VALUES ('7', '2017-08-11 14:22:40');
INSERT INTO `ml_trade` VALUES ('8', '2017-08-10 14:22:40');
INSERT INTO `ml_trade` VALUES ('9', '2017-08-09 14:22:40');
INSERT INTO `ml_trade` VALUES ('10', '2017-08-08 14:22:40');
INSERT INTO `ml_trade` VALUES ('11', '2017-08-07 14:22:40');
INSERT INTO `ml_trade` VALUES ('12', '2017-08-06 14:22:40');
INSERT INTO `ml_trade` VALUES ('13', '2017-08-05 14:22:40');
INSERT INTO `ml_trade` VALUES ('14', '2017-08-04 14:22:40');
INSERT INTO `ml_trade` VALUES ('15', '2017-08-03 14:22:40');
INSERT INTO `ml_trade` VALUES ('16', '2017-08-02 14:22:40');
INSERT INTO `ml_trade` VALUES ('17', '2017-08-01 14:22:40');
INSERT INTO `ml_trade` VALUES ('18', '2017-08-17 14:22:41');
INSERT INTO `ml_trade` VALUES ('19', '2017-08-17 14:22:42');
INSERT INTO `ml_trade` VALUES ('20', '2017-08-16 14:22:48');

-- ----------------------------
-- Table structure for `ml_user`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user`;
CREATE TABLE `ml_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '是否对此用户禁言  默认0 可评论  冻结的评论数量大于三就禁言',
  `u_username` char(32) NOT NULL,
  `u_password` char(32) NOT NULL DEFAULT '0',
  `u_phone` char(11) NOT NULL,
  `u_create_time` varchar(30) NOT NULL DEFAULT '0',
  `is_comment` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_username` (`u_username`),
  UNIQUE KEY `u_phone` (`u_phone`),
  KEY `u_password` (`u_password`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user
-- ----------------------------
INSERT INTO `ml_user` VALUES ('1', '张三', '123456', '12345678901', '20170101', '0');
INSERT INTO `ml_user` VALUES ('2', '李四', '123456', '99999999999', '56789086', '0');
INSERT INTO `ml_user` VALUES ('4', 'qql123', '123456', '17621172303', '1502333983', '1');
INSERT INTO `ml_user` VALUES ('7', '不能说的秘密', '0', '13083036399', '0', '0');
INSERT INTO `ml_user` VALUES ('10', 'qqq', '0', '', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user_address
-- ----------------------------
INSERT INTO `ml_user_address` VALUES ('1', '1', '1111', '13375668768', '江苏省/常州市/溧阳市', '111');
INSERT INTO `ml_user_address` VALUES ('2', '1', '大街', '13375668768', '江苏省/常州市/溧阳市', '老王');
INSERT INTO `ml_user_address` VALUES ('3', '4', '', '17621172303', '江苏省/常州市/溧阳市', '屈强龙');

-- ----------------------------
-- Table structure for `ml_user_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ml_user_detail`;
CREATE TABLE `ml_user_detail` (
  `ud_id` int(11) NOT NULL AUTO_INCREMENT,
  `ud_uid` int(11) NOT NULL,
  `ud_photo` varchar(100) DEFAULT '0',
  `ud_sex` tinyint(4) DEFAULT '1',
  `ud_type` tinyint(4) DEFAULT '0',
  `ud_point` int(11) DEFAULT NULL,
  `ud_picture` varchar(100) DEFAULT NULL,
  `ud_email` varchar(30) DEFAULT NULL,
  `ud_text` varchar(140) DEFAULT NULL,
  `qqphoto` varchar(200) DEFAULT '',
  PRIMARY KEY (`ud_id`),
  UNIQUE KEY `ud_uid` (`ud_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_user_detail
-- ----------------------------
INSERT INTO `ml_user_detail` VALUES ('1', '1', '20170810/eb3f905bc9cab3a2ae3271bd0857c8e4.jpg', '1', '0', '33', 'tou2.jpg', '123@qq.com', '啦啦啦', '0');
INSERT INTO `ml_user_detail` VALUES ('2', '2', '0', '0', '1', '99', 'tou2.jpg', '999@qq.com', '嘿嘿嘿', '0');
INSERT INTO `ml_user_detail` VALUES ('3', '4', 'tou1.jpg', '0', '0', '28', 'tou2.jpg', '', null, '0');
INSERT INTO `ml_user_detail` VALUES ('4', '7', '0', '1', '0', null, 'tou2.jpg', null, null, 'http://qzapp.qlogo.cn/qzapp/101416221/D6F093031891C6AAAE24E72EED58B537/100');
INSERT INTO `ml_user_detail` VALUES ('5', '10', '0', '1', '0', null, 'tou2.jpg', null, null, '1.jpg');

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

-- ----------------------------
-- Table structure for `ml_view`
-- ----------------------------
DROP TABLE IF EXISTS `ml_view`;
CREATE TABLE `ml_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_view
-- ----------------------------
INSERT INTO `ml_view` VALUES ('1', '2017-08-17 14:22:40');
INSERT INTO `ml_view` VALUES ('2', '2017-08-16 14:22:40');
INSERT INTO `ml_view` VALUES ('3', '2017-08-15 14:22:40');
INSERT INTO `ml_view` VALUES ('4', '2017-08-14 14:22:40');
INSERT INTO `ml_view` VALUES ('5', '2017-08-13 14:22:40');
INSERT INTO `ml_view` VALUES ('6', '2017-08-12 14:22:40');
INSERT INTO `ml_view` VALUES ('7', '2017-08-11 14:22:40');
INSERT INTO `ml_view` VALUES ('8', '2017-08-10 14:22:40');
INSERT INTO `ml_view` VALUES ('9', '2017-08-09 14:22:40');
INSERT INTO `ml_view` VALUES ('10', '2017-08-08 14:22:40');
INSERT INTO `ml_view` VALUES ('11', '2017-08-07 14:22:40');
INSERT INTO `ml_view` VALUES ('12', '2017-08-06 14:22:40');
INSERT INTO `ml_view` VALUES ('13', '2017-08-05 14:22:40');
INSERT INTO `ml_view` VALUES ('14', '2017-08-04 14:22:40');
INSERT INTO `ml_view` VALUES ('15', '2017-08-03 14:22:40');
INSERT INTO `ml_view` VALUES ('16', '2017-08-02 14:22:40');
INSERT INTO `ml_view` VALUES ('17', '2017-08-01 14:22:40');
INSERT INTO `ml_view` VALUES ('18', '2017-08-17 14:22:41');
INSERT INTO `ml_view` VALUES ('19', '2017-08-17 14:22:42');
INSERT INTO `ml_view` VALUES ('20', '2017-08-16 14:22:48');
INSERT INTO `ml_view` VALUES ('21', '2017-08-17 15:37:31');
INSERT INTO `ml_view` VALUES ('22', '2017-08-17 15:56:17');
INSERT INTO `ml_view` VALUES ('23', '2017-08-17 16:15:41');
INSERT INTO `ml_view` VALUES ('24', '2017-08-17 16:16:01');
INSERT INTO `ml_view` VALUES ('25', '2017-08-17 20:38:42');
INSERT INTO `ml_view` VALUES ('26', '2017-08-17 21:24:37');
INSERT INTO `ml_view` VALUES ('27', '2017-08-17 23:10:20');
INSERT INTO `ml_view` VALUES ('28', '2017-08-17 23:10:26');
INSERT INTO `ml_view` VALUES ('29', '2017-08-17 23:15:47');
INSERT INTO `ml_view` VALUES ('30', '2017-08-17 23:17:14');
INSERT INTO `ml_view` VALUES ('31', '2017-08-17 23:29:14');
INSERT INTO `ml_view` VALUES ('32', '2017-08-17 23:34:54');
