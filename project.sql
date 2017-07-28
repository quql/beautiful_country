---------数据表
--user表
CREATE TABLE `hc_users` (
  `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`char(10) NOT NULL,
  `pass`varchar(20) NOT NULL,
  `phone` char(11) NOT NULL,
  `photo` varchar(50),
  `sex` tinyint(1),
  `age` char(5)
)ENGINE=innoDB DEFAULT CHARSET=utf8;

--address表
CREATE TABLE `hc_address`(
    `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `uid`int DEFAULT NULL,
    `pro` char(10) COMMENT'省',
    `city`char(10) COMMENT'市',
    `area`char(10) COMMENT'区/县',
    `street` varchar(50) COMMENT'街道',
    `get_user`char(10) COMMENT'收货人',
    `get_phone` char(11) COMMENT'收货人手机号'
)ENGINE=innoDB DEFAULT CHARSET=utf8;
--商家信息表
CREATE TABLE `hc_business`(
    `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `bid`int DEFAULT NULL,
    `bus_name` char(10) COMMENT'商户名',
    `pro`char(10) COMMENT'省',
    `city`char(10) COMMENT'市',
    `area`char(10) COMMENT'区/县',
    `bus_type` ENUM('1','2','3','4') COMMENT'1表示酒店,2表示度假村,3表示农家乐,4表示景区',
    `bus_username`char(10) COMMENT'店铺负责人',
    `bus_phone` char(11) COMMENT'店铺负责人手机号',
    `pass` varchar(20) COMMENT'店铺登录密码',
    `logo` varchar(50) COMMENT'店铺logo'
)ENGINE=innoDB DEFAULT CHARSET=utf8;