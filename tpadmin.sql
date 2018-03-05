/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-03-06 00:02:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_job
-- ----------------------------
DROP TABLE IF EXISTS `admin_job`;
CREATE TABLE `admin_job` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(24) DEFAULT NULL,
  `explain` varchar(120) DEFAULT NULL,
  `vaild` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_job
-- ----------------------------
INSERT INTO `admin_job` VALUES ('1', '超级管理员', 'chaojiguanl', '1');
INSERT INTO `admin_job` VALUES ('3', '管理员', '管理员', '1');

-- ----------------------------
-- Table structure for admin_job_auth
-- ----------------------------
DROP TABLE IF EXISTS `admin_job_auth`;
CREATE TABLE `admin_job_auth` (
  `admin_job_id` int(8) NOT NULL,
  `func_key` varchar(24) NOT NULL,
  `auth_key` varchar(24) NOT NULL,
  PRIMARY KEY (`admin_job_id`,`func_key`,`auth_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_job_auth
-- ----------------------------
INSERT INTO `admin_job_auth` VALUES ('1', 'administrato', 'export');
INSERT INTO `admin_job_auth` VALUES ('1', 'func', 'add');
INSERT INTO `admin_job_auth` VALUES ('1', 'func', 'delete');
INSERT INTO `admin_job_auth` VALUES ('1', 'func', 'edit');
INSERT INTO `admin_job_auth` VALUES ('1', 'func', 'export');
INSERT INTO `admin_job_auth` VALUES ('1', 'job', 'add');
INSERT INTO `admin_job_auth` VALUES ('1', 'job', 'delete');
INSERT INTO `admin_job_auth` VALUES ('1', 'job', 'edit');
INSERT INTO `admin_job_auth` VALUES ('1', 'job', 'export');
INSERT INTO `admin_job_auth` VALUES ('1', 'menu', 'add');
INSERT INTO `admin_job_auth` VALUES ('1', 'menu', 'delete');
INSERT INTO `admin_job_auth` VALUES ('1', 'menu', 'edit');
INSERT INTO `admin_job_auth` VALUES ('1', 'menu', 'export');
INSERT INTO `admin_job_auth` VALUES ('1', 'staff', 'add');
INSERT INTO `admin_job_auth` VALUES ('1', 'staff', 'delete');
INSERT INTO `admin_job_auth` VALUES ('1', 'staff', 'edit');
INSERT INTO `admin_job_auth` VALUES ('1', 'staff', 'export');
INSERT INTO `admin_job_auth` VALUES ('3', 'administrato', 'export');
INSERT INTO `admin_job_auth` VALUES ('3', 'func', 'add');
INSERT INTO `admin_job_auth` VALUES ('3', 'func', 'delete');
INSERT INTO `admin_job_auth` VALUES ('3', 'func', 'export');
INSERT INTO `admin_job_auth` VALUES ('3', 'menu', 'export');
INSERT INTO `admin_job_auth` VALUES ('3', 'staff', 'delete');
INSERT INTO `admin_job_auth` VALUES ('3', 'staff', 'edit');
INSERT INTO `admin_job_auth` VALUES ('3', 'staff', 'export');

-- ----------------------------
-- Table structure for background_func
-- ----------------------------
DROP TABLE IF EXISTS `background_func`;
CREATE TABLE `background_func` (
  `key` varchar(24) NOT NULL,
  `func_name` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of background_func
-- ----------------------------
INSERT INTO `background_func` VALUES ('administrato', '后台管理');
INSERT INTO `background_func` VALUES ('func', '功能管理');
INSERT INTO `background_func` VALUES ('job', '职位管理');
INSERT INTO `background_func` VALUES ('menu', '菜单管理');
INSERT INTO `background_func` VALUES ('staff', '管理员管理');

-- ----------------------------
-- Table structure for func_auth
-- ----------------------------
DROP TABLE IF EXISTS `func_auth`;
CREATE TABLE `func_auth` (
  `func_key` varchar(24) NOT NULL,
  `key` varchar(24) NOT NULL,
  `auth_name` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`func_key`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of func_auth
-- ----------------------------
INSERT INTO `func_auth` VALUES ('func', 'add', '添加');
INSERT INTO `func_auth` VALUES ('func', 'delete', '删除');
INSERT INTO `func_auth` VALUES ('func', 'edit', '编辑');
INSERT INTO `func_auth` VALUES ('job', 'add', '添加');
INSERT INTO `func_auth` VALUES ('job', 'delete', '删除');
INSERT INTO `func_auth` VALUES ('job', 'edit', '编辑');
INSERT INTO `func_auth` VALUES ('menu', 'add', '添加');
INSERT INTO `func_auth` VALUES ('menu', 'delete', '删除');
INSERT INTO `func_auth` VALUES ('menu', 'edit', '编辑');
INSERT INTO `func_auth` VALUES ('staff', 'add', '添加');
INSERT INTO `func_auth` VALUES ('staff', 'delete', '删除');
INSERT INTO `func_auth` VALUES ('staff', 'edit', '编辑');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `named` varchar(36) DEFAULT NULL,
  `icon` varchar(120) DEFAULT NULL,
  `url` varchar(120) DEFAULT NULL,
  `sort` int(3) DEFAULT '100',
  `level` int(2) DEFAULT '1',
  `parent` int(11) DEFAULT '0',
  `screen_auth` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '后台管理', '/Public/upload/2018-03-05/1520263146452193.jpg', '', '100', '0', '0', '{\"administrato\":[\"export\"]}');
INSERT INTO `menu` VALUES ('2', '管理员管理', '', '/admin/staff/index', '100', '1', '1', '{\"staff\":[\"export\"]}');
INSERT INTO `menu` VALUES ('3', '职位管理', '/Public/upload/2018-03-05/1520263985738720.png', '/admin/job/index', '100', '1', '1', '{\"job\":[\"export\"]}');
INSERT INTO `menu` VALUES ('4', '功能管理', '', '/admin/func/index', '100', '1', '1', '{\"func\":[\"export\"]}');
INSERT INTO `menu` VALUES ('5', '菜单管理', '', '/admin/menu/index', '100', '1', '1', '{\"menu\":[\"export\"]}');

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(24) NOT NULL,
  `true_name` varchar(24) DEFAULT NULL,
  `header_img` varchar(120) DEFAULT NULL,
  `staff_num` varchar(16) DEFAULT NULL,
  `pwd` varchar(64) NOT NULL,
  `job` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES ('1', 'admin', '超级管理员', '/Public/upload/2018-03-05/1520248171918791.png', '001', 'e10adc3949ba59abbe56e057f20f883e', '[\"1\"]', '2018-03-05 22:29:06', '2018-03-05 22:29:06');
INSERT INTO `staff` VALUES ('5', 'ceshi', '管理员', '/Public/upload/2018-03-05/1520263920488611.jpg', '002', '4acb4bc224acbbe3c2bfdcaa39a4324e', '[\"3\"]', '2018-03-05 23:32:12', '2018-03-05 23:32:12');

-- ----------------------------
-- Table structure for staff_job
-- ----------------------------
DROP TABLE IF EXISTS `staff_job`;
CREATE TABLE `staff_job` (
  `staff_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`staff_id`,`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of staff_job
-- ----------------------------
INSERT INTO `staff_job` VALUES ('1', '1');
INSERT INTO `staff_job` VALUES ('5', '3');
