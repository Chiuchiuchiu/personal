/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : zwx

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-12-28 17:53:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbadmin`
-- ----------------------------
DROP TABLE IF EXISTS `tbadmin`;
CREATE TABLE `tbadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdLogo` varchar(64) DEFAULT NULL COMMENT '头像',
  `fdName` varchar(32) NOT NULL DEFAULT '',
  `fdPassword` varchar(32) NOT NULL DEFAULT '',
  `fdCreate` date DEFAULT NULL,
  `fdToken` varchar(32) DEFAULT NULL,
  `fdLoginTime` date DEFAULT NULL COMMENT '登录时间',
  `fdType` smallint(11) DEFAULT '0' COMMENT '权限id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbadmin
-- ----------------------------
INSERT INTO `tbadmin` VALUES ('1', '', 'chiu', '14e1b600b1fd579f47433b88e8d85291', '2016-03-20', '651468b37f95f5f421cccbf8fb7ee376', '2016-12-26', '1');

-- ----------------------------
-- Table structure for `tbcategory`
-- ----------------------------
DROP TABLE IF EXISTS `tbcategory`;
CREATE TABLE `tbcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdCategoryName` varchar(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `fdType` int(11) NOT NULL DEFAULT '0' COMMENT '分类类型 1=图片，2=技术文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbcategory
-- ----------------------------

-- ----------------------------
-- Table structure for `tbmessage`
-- ----------------------------
DROP TABLE IF EXISTS `tbmessage`;
CREATE TABLE `tbmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdParentId` int(11) NOT NULL DEFAULT '0' COMMENT '回复评论的id，首评论为0',
  `fdUserId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论者id',
  `fdArticleId` int(11) NOT NULL DEFAULT '0' COMMENT '文章id，0=首页留言',
  `fdContent` text NOT NULL COMMENT '内容',
  `fdAddTime` int(11) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `fdDel` smallint(2) NOT NULL DEFAULT '0' COMMENT '是否删除，1=是，0=否',
  `fdIP` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tbnote`
-- ----------------------------
DROP TABLE IF EXISTS `tbnote`;
CREATE TABLE `tbnote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdName` varchar(32) DEFAULT NULL COMMENT '文章名',
  `fdText` text COMMENT '文章内容',
  `fdCategoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbnote
-- ----------------------------

-- ----------------------------
-- Table structure for `tbphoto`
-- ----------------------------
DROP TABLE IF EXISTS `tbphoto`;
CREATE TABLE `tbphoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdName` varchar(32) DEFAULT NULL COMMENT '文件名',
  `fdUrl` varchar(255) DEFAULT NULL COMMENT '路径',
  `fdCreate` date DEFAULT NULL,
  `fdCategoryId` int(11) NOT NULL COMMENT '分类id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbphoto
-- ----------------------------

-- ----------------------------
-- Table structure for `tbusers`
-- ----------------------------
DROP TABLE IF EXISTS `tbusers`;
CREATE TABLE `tbusers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fdNickName` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `fdPassword` varchar(32) NOT NULL DEFAULT '',
  `fdAddTime` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `fdLogTime` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `fdPhone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号',
  `fdMail` varchar(32) NOT NULL DEFAULT '' COMMENT '注册邮箱',
  `fdType` smallint(6) unsigned NOT NULL DEFAULT '2' COMMENT '权限id：2=普通用户',
  `fdIp` varchar(16) NOT NULL DEFAULT '' COMMENT 'ip',
  `fdDel` smallint(6) NOT NULL DEFAULT '0' COMMENT '是否删除 1=是，0=否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbusers
-- ----------------------------
INSERT INTO `tbusers` VALUES ('1', 'chiu', '14e1b600b1fd579f47433b88e8d85291', '1479201054', '1482918516', '0', '0', '2', '0', '0');

-- ----------------------------
-- Table structure for `tbverify`
-- ----------------------------
DROP TABLE IF EXISTS `tbverify`;
CREATE TABLE `tbverify` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fdMail` varchar(32) NOT NULL DEFAULT '' COMMENT '验证邮箱',
  `fdVerify` varchar(11) NOT NULL DEFAULT '' COMMENT '验证码',
  `fdAddTime` int(11) NOT NULL DEFAULT '0' COMMENT '生成时间',
  `fdSendTime` int(11) NOT NULL DEFAULT '0' COMMENT '发送时间',
  `fdUsed` smallint(2) NOT NULL DEFAULT '0' COMMENT '是否已使用，1=是，0=否',
  `fdState` smallint(2) NOT NULL DEFAULT '1' COMMENT '状态，1=有效，0=失效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tbvisitors`
-- ----------------------------
DROP TABLE IF EXISTS `tbvisitors`;
CREATE TABLE `tbvisitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fdIP` varchar(32) DEFAULT NULL COMMENT '访客IP地址',
  `fdCreate` int(11) unsigned DEFAULT '0',
  `fdLng` varchar(16) DEFAULT NULL COMMENT '经度',
  `fdLat` varchar(16) DEFAULT NULL COMMENT '纬度',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

