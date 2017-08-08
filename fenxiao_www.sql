/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.5
Source Server Version : 50546
Source Host           : 192.168.1.5:3306
Source Database       : fenxiao_www

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2016-10-25 16:07:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_ad
-- ----------------------------
DROP TABLE IF EXISTS `t_ad`;
CREATE TABLE `t_ad` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_title` varchar(150) NOT NULL COMMENT '广告名称',
  `a_alias` varchar(50) NOT NULL COMMENT '别名',
  `a_picture` varchar(150) NOT NULL,
  `a_link` varchar(255) NOT NULL COMMENT '链接地址',
  `a_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1正常，2禁用',
  `a_addtime` datetime NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='广告管理';

-- ----------------------------
-- Records of t_ad
-- ----------------------------
INSERT INTO `t_ad` VALUES ('9', '嗯嗯', 'www', 'http://oc1bn3cfn.bkt.clouddn.com/product/20160817/c86b5594-b019-4971-a00d-f046682f4be9.png', 'http://www.baidu.com/', '1', '2016-08-17 14:21:14');
INSERT INTO `t_ad` VALUES ('10', '第五代PURTIER胎盘素', 'sky', 'http://image.visp.info/product/20160818/e90a75f9-cb0f-4513-a61f-d00dbf2501dc.jpg', 'http://x.eqxiu.com/s/WKtbXkK8', '1', '2016-08-17 16:33:58');
INSERT INTO `t_ad` VALUES ('11', 'PURTIER胎盘素', 'banner1471449600', 'http://image.visp.info/product/20160818/d0dad048-f16a-478c-b2f8-c006909f5191.jpg', 'http://x.eqxiu.com/s/WKtbXkK8', '1', '2016-08-17 16:35:07');

-- ----------------------------
-- Table structure for t_ad_group
-- ----------------------------
DROP TABLE IF EXISTS `t_ad_group`;
CREATE TABLE `t_ad_group` (
  `ag_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '组id',
  `ag_name` varchar(250) DEFAULT NULL COMMENT '广告组名',
  `ag_cname` varchar(50) DEFAULT NULL COMMENT '广告别名',
  `a_ids` varchar(250) DEFAULT NULL COMMENT '关联的广告id',
  `ag_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`ag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='广告组表';

-- ----------------------------
-- Records of t_ad_group
-- ----------------------------
INSERT INTO `t_ad_group` VALUES ('19', '首页轮播', 'home_focus', '10,9,11', '2016-08-18 15:45:01');
INSERT INTO `t_ad_group` VALUES ('20', '新闻轮播', 'news_focus', '10,11', '2016-08-20 15:42:09');
INSERT INTO `t_ad_group` VALUES ('21', '测试广告组', 'test', '11,10', null);

-- ----------------------------
-- Table structure for t_address
-- ----------------------------
DROP TABLE IF EXISTS `t_address`;
CREATE TABLE `t_address` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `a_phone` varchar(11) NOT NULL COMMENT '联系电话',
  `a_realname` varchar(25) NOT NULL COMMENT '联系人',
  `a_wechat_id` varchar(50) NOT NULL COMMENT '微信号',
  `a_province` varchar(25) NOT NULL COMMENT '省',
  `a_city` varchar(25) NOT NULL COMMENT '市',
  `a_area` varchar(25) NOT NULL COMMENT '区',
  `a_address` varchar(100) NOT NULL COMMENT '地址',
  `a_addtime` datetime NOT NULL,
  PRIMARY KEY (`a_id`),
  KEY `m_id` (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='收货地址';

-- ----------------------------
-- Records of t_address
-- ----------------------------
INSERT INTO `t_address` VALUES ('3', '1', '13509351822', '莫小白', 'moxiaobai', '福建', '福州', '鼓楼区', '恒宇国际', '2016-08-25 15:09:56');
INSERT INTO `t_address` VALUES ('4', '32', '13566899898', '叶师傅', 'vip', '湖北', '武汉', '江岸区', '恒宇国际', '2016-08-23 11:18:08');
INSERT INTO `t_address` VALUES ('5', '3', '13400507914', '22', '222', '内蒙古', '赤峰', '巴林右旗', '12', '2016-08-20 17:31:35');

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_username` varchar(50) NOT NULL COMMENT '登录帐号',
  `a_password` varchar(100) NOT NULL COMMENT '密码',
  `a_realname` varchar(50) NOT NULL COMMENT '真实姓名',
  `a_phone` varchar(11) NOT NULL COMMENT '联系电话',
  `a_addtime` datetime NOT NULL COMMENT '添加时间',
  `a_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `a_role` tinyint(4) NOT NULL DEFAULT '2' COMMENT '角色：1超级管理员，2普通管理员',
  `a_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1正常，2禁用',
  `a_openId` varchar(150) DEFAULT NULL COMMENT 'openId',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='系统管理员';

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'moxiaobai', '2d2d95373ee0ecda657ad8575a110aab', '任先生', '13509351822', '2016-05-03 21:09:14', '2016-09-07 14:34:16', '1', '1', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk');
INSERT INTO `t_admin` VALUES ('16', 'dexinlin', 'cc8a15d31a04d375382b2f2b32169193', '林德新', '13400507914', '2016-07-06 10:08:27', '2016-10-24 16:48:07', '1', '1', 'oBp4Jt5iXvIQC101nKLuuwkSVf_8');
INSERT INTO `t_admin` VALUES ('17', 'monyyip', 'cc8a15d31a04d375382b2f2b32169193', '叶财源222', '15806026996', '2016-07-07 10:38:18', '2016-10-17 15:41:01', '1', '1', null);
INSERT INTO `t_admin` VALUES ('18', 'huibaogd', 'cc8a15d31a04d375382b2f2b32169193', '汇宝国鼎', '15806026997', '2016-07-07 14:24:00', '2016-08-23 10:33:38', '1', '1', null);
INSERT INTO `t_admin` VALUES ('19', 'comylife', '2d2d95373ee0ecda657ad8575a110aab', 'mlkom', '13509351821', '2016-08-17 14:10:29', '2016-08-18 09:24:41', '2', '1', null);
INSERT INTO `t_admin` VALUES ('20', 'wendyHaw', 'cc8a15d31a04d375382b2f2b32169193', '何小八', '13509351829', '2016-08-18 10:25:01', '2016-08-18 11:37:45', '20', '1', '');

-- ----------------------------
-- Table structure for t_article
-- ----------------------------
DROP TABLE IF EXISTS `t_article`;
CREATE TABLE `t_article` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_title` varchar(80) DEFAULT NULL COMMENT '标题',
  `a_content` text COMMENT '文章内容',
  `a_status` tinyint(4) NOT NULL COMMENT '状态 1：正常 2：禁用',
  `a_addtime` datetime NOT NULL COMMENT '添加时间',
  `a_desc` varchar(80) DEFAULT NULL COMMENT '副标题',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='特色服务文章';

-- ----------------------------
-- Records of t_article
-- ----------------------------
INSERT INTO `t_article` VALUES ('1', '汇宝网特色', '<p><img src=\"http://www.huibao.loc/public/images/superiority.jpg\" height=\"525\" width=\"746\"/></p>', '1', '2016-07-18 10:32:59', 'CHARACTERISTICd');

-- ----------------------------
-- Table structure for t_basic_config
-- ----------------------------
DROP TABLE IF EXISTS `t_basic_config`;
CREATE TABLE `t_basic_config` (
  `bc_id` int(11) NOT NULL AUTO_INCREMENT,
  `bc_type` tinyint(4) NOT NULL COMMENT '类型: 1、SEO；2、提示信息，3、样式模板，4、购买配置，5收货配置，6提现配置',
  `bc_title` varchar(50) NOT NULL COMMENT '名称',
  `bc_key` varchar(50) NOT NULL COMMENT '键',
  `bc_value` text NOT NULL COMMENT '值',
  `bc_sort` int(11) NOT NULL COMMENT '排序',
  `bc_addtime` datetime NOT NULL,
  PRIMARY KEY (`bc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='基础配置表';

-- ----------------------------
-- Records of t_basic_config
-- ----------------------------
INSERT INTO `t_basic_config` VALUES ('1', '1', '网站名称', 'site_name', '阿斯达', '1', '2016-08-12 14:51:47');
INSERT INTO `t_basic_config` VALUES ('2', '2', '非会员获取二维码提示', 'not_member_tip', '您还不是代言人，请先购买产品成为代言人，然后生成推广二维码！', '2', '2016-08-13 16:00:58');
INSERT INTO `t_basic_config` VALUES ('3', '3', '样式模版', 'style template', '蓝白雨滴款', '3', '2016-08-13 16:01:45');
INSERT INTO `t_basic_config` VALUES ('6', '6', '多少金额可以提现', 'cash_config', '10', '6', '2016-08-13 16:03:30');
INSERT INTO `t_basic_config` VALUES ('7', '4', '自动取消订单时效', 'auto_cancle_order', '0.5', '7', '2016-08-13 16:16:08');
INSERT INTO `t_basic_config` VALUES ('8', '4', '重复购买折扣', 'mall_again', '9.5', '8', '2016-08-13 16:17:23');
INSERT INTO `t_basic_config` VALUES ('9', '5', '发货多少天自动收货', 'auto_complete_order', '10', '9', '2016-08-13 16:17:58');
INSERT INTO `t_basic_config` VALUES ('10', '6', '每日提现次数', 'withdraw_times', '10', '0', '0000-00-00 00:00:00');
INSERT INTO `t_basic_config` VALUES ('11', '6', '收货后多少天提现', 'receipt_day', '10', '0', '0000-00-00 00:00:00');
INSERT INTO `t_basic_config` VALUES ('14', '1', '分享标题', 'share_title', '我是{nickname},你还不快分享', '2', '2016-08-18 16:59:21');
INSERT INTO `t_basic_config` VALUES ('15', '1', '分享内容', 'share_content', '我是{nickname},据说，你要分享了，你今天买彩票能中大奖！你信不！', '3', '2016-08-18 17:00:34');
INSERT INTO `t_basic_config` VALUES ('16', '1', '第三方统计代码', 'stat_code', '<script> var _hmt = _hmt || []; (function() {     var hm = document.createElement(\"script\");     hm.src = \"//hm.baidu.com/hm.js?9c8b537a4ae72722fea3211cf4aa3117\";     var s = document.getElementsByTagName(\"script\")[0];     s.parentNode.insertBefore(hm, s); })(); </script>', '4', '2016-08-18 17:01:49');
INSERT INTO `t_basic_config` VALUES ('17', '6', '提现金额限制', 'withdraw_money', '200', '0', '0000-00-00 00:00:00');
INSERT INTO `t_basic_config` VALUES ('18', '1', '公众号名称', 'weixin_service_name', '上善网络', '1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for t_cron_log
-- ----------------------------
DROP TABLE IF EXISTS `t_cron_log`;
CREATE TABLE `t_cron_log` (
  `cl_id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_url` varchar(150) NOT NULL COMMENT '任务URL',
  `cl_status` tinyint(4) NOT NULL COMMENT '任务执行结果：1成功，2失败',
  `cl_result` varchar(255) NOT NULL COMMENT '任务执行结果',
  `cl_datetime` datetime NOT NULL COMMENT '执行时间',
  PRIMARY KEY (`cl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='任务日志表';

-- ----------------------------
-- Records of t_cron_log
-- ----------------------------
INSERT INTO `t_cron_log` VALUES ('29', '/cron/order/collectCancleOrder', '1', '{\"code\":1,\"info\":\"Count:13\"}', '2016-08-22 10:03:21');
INSERT INTO `t_cron_log` VALUES ('30', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u72b6\\u6001\\u66f4\\u6539\\u5931\\u8d25\"}', '2016-08-22 10:03:36');
INSERT INTO `t_cron_log` VALUES ('31', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:05:51');
INSERT INTO `t_cron_log` VALUES ('32', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:22');
INSERT INTO `t_cron_log` VALUES ('33', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:22');
INSERT INTO `t_cron_log` VALUES ('34', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:23');
INSERT INTO `t_cron_log` VALUES ('35', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:23');
INSERT INTO `t_cron_log` VALUES ('36', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:24');
INSERT INTO `t_cron_log` VALUES ('37', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:24');
INSERT INTO `t_cron_log` VALUES ('38', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:24');
INSERT INTO `t_cron_log` VALUES ('39', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:25');
INSERT INTO `t_cron_log` VALUES ('40', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:25');
INSERT INTO `t_cron_log` VALUES ('41', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:25');
INSERT INTO `t_cron_log` VALUES ('42', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:26');
INSERT INTO `t_cron_log` VALUES ('43', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u53d6\\u6d88\\u6210\\u529f\"}', '2016-08-22 10:06:38');
INSERT INTO `t_cron_log` VALUES ('44', '/cron/order/dealCancleOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-22 10:06:39');
INSERT INTO `t_cron_log` VALUES ('45', '/cron/order/collectCompleteOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-23 09:17:50');
INSERT INTO `t_cron_log` VALUES ('46', '/cron/order/collectCompleteOrder', '1', '{\"code\":1,\"info\":\"Count:1\"}', '2016-08-23 09:19:34');
INSERT INTO `t_cron_log` VALUES ('47', '/cron/order/dealCompleteOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u786e\\u8ba4\\u6210\\u529f\"}', '2016-08-23 09:19:49');
INSERT INTO `t_cron_log` VALUES ('48', '/cron/order/dealCompleteOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-23 09:20:58');
INSERT INTO `t_cron_log` VALUES ('49', '/cron/order/dealCompleteOrder', '1', '{\"code\":1,\"info\":\"\\u8ba2\\u5355\\u786e\\u8ba4\\u6210\\u529f\"}', '2016-08-23 09:21:16');
INSERT INTO `t_cron_log` VALUES ('50', '/cron/order/collectCancleOrder', '1', '{\"code\":1,\"info\":\"Count:8\"}', '2016-08-24 16:39:38');
INSERT INTO `t_cron_log` VALUES ('51', '/cron/order/collectCancleOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-24 16:40:22');
INSERT INTO `t_cron_log` VALUES ('52', '/cron/order/collectCancleOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-24 16:41:57');
INSERT INTO `t_cron_log` VALUES ('53', '/cron/order/collectCompleteOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-24 16:42:34');
INSERT INTO `t_cron_log` VALUES ('54', '/cron/order/collectCompleteOrder', '1', '{\"code\":1,\"info\":\"No data processing\"}', '2016-08-24 16:43:19');
INSERT INTO `t_cron_log` VALUES ('55', '/cron/queue/dealQueue', '1', '{\"code\":1,\"info\":\"Deal Success\"}', '2016-08-25 15:27:22');
INSERT INTO `t_cron_log` VALUES ('56', '/cron/queue/dealQueue', '1', '{\"code\":1,\"info\":\"Deal Success!ID:9\"}', '2016-08-25 15:27:56');

-- ----------------------------
-- Table structure for t_login_log
-- ----------------------------
DROP TABLE IF EXISTS `t_login_log`;
CREATE TABLE `t_login_log` (
  `ll_id` int(11) NOT NULL AUTO_INCREMENT,
  `ll_aid` int(11) NOT NULL COMMENT '管理员ID',
  `ll_username` varchar(50) NOT NULL COMMENT '登录帐号',
  `ll_realname` varchar(50) NOT NULL,
  `ll_login_ip` bigint(11) NOT NULL COMMENT '登录IP',
  `ll_login_time` datetime NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`ll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COMMENT='登录日志';

-- ----------------------------
-- Records of t_login_log
-- ----------------------------
INSERT INTO `t_login_log` VALUES ('73', '16', 'dexinlin', '林德新', '3232235893', '2016-08-12 10:12:57');
INSERT INTO `t_login_log` VALUES ('74', '16', 'dexinlin', '林德新', '3232235893', '2016-08-12 14:43:36');
INSERT INTO `t_login_log` VALUES ('75', '17', 'monyyip', '叶财源', '3232235894', '2016-08-12 14:49:36');
INSERT INTO `t_login_log` VALUES ('76', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-12 15:44:28');
INSERT INTO `t_login_log` VALUES ('77', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-13 10:03:44');
INSERT INTO `t_login_log` VALUES ('78', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-13 10:54:28');
INSERT INTO `t_login_log` VALUES ('79', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-13 14:07:08');
INSERT INTO `t_login_log` VALUES ('80', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-13 14:28:27');
INSERT INTO `t_login_log` VALUES ('81', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-13 14:28:40');
INSERT INTO `t_login_log` VALUES ('82', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-13 16:53:49');
INSERT INTO `t_login_log` VALUES ('83', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-15 09:06:21');
INSERT INTO `t_login_log` VALUES ('84', '17', 'monyyip', '叶财源', '3232235894', '2016-08-15 10:20:36');
INSERT INTO `t_login_log` VALUES ('85', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-16 09:30:09');
INSERT INTO `t_login_log` VALUES ('86', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-16 11:17:55');
INSERT INTO `t_login_log` VALUES ('87', '1', 'moxiaobai', '任先生1', '3232235882', '2016-08-16 16:46:35');
INSERT INTO `t_login_log` VALUES ('88', '16', 'dexinlin', '林德新1', '3232235893', '2016-08-17 09:19:52');
INSERT INTO `t_login_log` VALUES ('89', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-17 11:17:47');
INSERT INTO `t_login_log` VALUES ('90', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-17 11:45:20');
INSERT INTO `t_login_log` VALUES ('91', '19', 'comylife', 'mlkom', '3232235882', '2016-08-17 14:11:02');
INSERT INTO `t_login_log` VALUES ('92', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-17 14:11:11');
INSERT INTO `t_login_log` VALUES ('93', '16', 'dexinlin', '林德新', '3232235893', '2016-08-17 14:42:20');
INSERT INTO `t_login_log` VALUES ('94', '19', 'comylife', 'mlkom', '3232235882', '2016-08-17 17:57:35');
INSERT INTO `t_login_log` VALUES ('95', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-17 17:57:52');
INSERT INTO `t_login_log` VALUES ('96', '16', 'dexinlin', '林德新', '3232235893', '2016-08-18 09:09:26');
INSERT INTO `t_login_log` VALUES ('97', '19', 'comylife', 'mlkom', '3232235882', '2016-08-18 09:19:10');
INSERT INTO `t_login_log` VALUES ('98', '19', 'comylife', 'mlkom', '3232235882', '2016-08-18 09:24:41');
INSERT INTO `t_login_log` VALUES ('99', '16', 'dexinlin', '林德新', '3232235893', '2016-08-18 09:46:40');
INSERT INTO `t_login_log` VALUES ('100', '20', 'wendyHaw', '何小八', '3232235882', '2016-08-18 11:37:45');
INSERT INTO `t_login_log` VALUES ('101', '17', 'monyyip', '叶财源', '3232235894', '2016-08-18 15:38:32');
INSERT INTO `t_login_log` VALUES ('102', '16', 'dexinlin', '林德新', '3232235893', '2016-08-18 17:46:04');
INSERT INTO `t_login_log` VALUES ('103', '17', 'monyyip', '叶财源', '3232235894', '2016-08-19 09:20:34');
INSERT INTO `t_login_log` VALUES ('104', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-20 11:21:18');
INSERT INTO `t_login_log` VALUES ('105', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-20 14:29:13');
INSERT INTO `t_login_log` VALUES ('106', '16', 'dexinlin', '林德新', '3232235893', '2016-08-20 14:38:37');
INSERT INTO `t_login_log` VALUES ('107', '16', 'dexinlin', '林德新', '3232235893', '2016-08-20 17:56:47');
INSERT INTO `t_login_log` VALUES ('108', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-22 09:41:50');
INSERT INTO `t_login_log` VALUES ('109', '17', 'monyyip', '叶财源', '3232235893', '2016-08-22 10:26:14');
INSERT INTO `t_login_log` VALUES ('110', '16', 'dexinlin', '林德新', '3232235894', '2016-08-22 13:59:53');
INSERT INTO `t_login_log` VALUES ('111', '16', 'dexinlin', '林德新', '3232235894', '2016-08-22 17:42:28');
INSERT INTO `t_login_log` VALUES ('112', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-22 18:16:15');
INSERT INTO `t_login_log` VALUES ('113', '16', 'dexinlin', '林德新', '3232235894', '2016-08-23 10:27:26');
INSERT INTO `t_login_log` VALUES ('114', '18', 'huibaogd', '汇宝国鼎', '3232235894', '2016-08-23 10:33:38');
INSERT INTO `t_login_log` VALUES ('115', '16', 'dexinlin', '林德新', '3232235894', '2016-08-23 15:03:52');
INSERT INTO `t_login_log` VALUES ('116', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-24 10:35:51');
INSERT INTO `t_login_log` VALUES ('117', '16', 'dexinlin', '林德新', '3232235894', '2016-08-26 10:00:20');
INSERT INTO `t_login_log` VALUES ('118', '16', 'dexinlin', '林德新', '3232235893', '2016-08-29 09:05:08');
INSERT INTO `t_login_log` VALUES ('119', '1', 'moxiaobai', '任先生', '3232235882', '2016-08-29 09:39:05');
INSERT INTO `t_login_log` VALUES ('120', '16', 'dexinlin', '林德新', '3232235893', '2016-09-01 15:31:01');
INSERT INTO `t_login_log` VALUES ('121', '1', 'moxiaobai', '任先生', '3232235882', '2016-09-01 17:36:34');
INSERT INTO `t_login_log` VALUES ('122', '16', 'dexinlin', '林德新', '3232235893', '2016-09-05 10:48:30');
INSERT INTO `t_login_log` VALUES ('123', '1', 'moxiaobai', '任先生', '3232235882', '2016-09-06 15:35:12');
INSERT INTO `t_login_log` VALUES ('124', '16', 'dexinlin', '林德新', '3232235893', '2016-09-06 15:54:39');
INSERT INTO `t_login_log` VALUES ('125', '16', 'dexinlin', '林德新', '3232235893', '2016-09-07 11:00:39');
INSERT INTO `t_login_log` VALUES ('126', '16', 'dexinlin', '林德新', '3232235893', '2016-09-07 11:06:57');
INSERT INTO `t_login_log` VALUES ('127', '16', 'dexinlin', '林德新', '3232235893', '2016-09-07 11:15:59');
INSERT INTO `t_login_log` VALUES ('128', '16', 'dexinlin', '林德新', '3232235893', '2016-09-07 11:41:22');
INSERT INTO `t_login_log` VALUES ('129', '16', 'dexinlin', '林德新', '3232235893', '2016-09-07 11:44:41');
INSERT INTO `t_login_log` VALUES ('130', '16', 'dexinlin', '林德新', '3232235893', '2016-09-07 11:45:51');
INSERT INTO `t_login_log` VALUES ('131', '1', 'moxiaobai', '任先生', '3232235882', '2016-09-07 14:34:16');
INSERT INTO `t_login_log` VALUES ('132', '16', 'dexinlin', '林德新', '3232235893', '2016-09-27 10:11:05');
INSERT INTO `t_login_log` VALUES ('133', '16', 'dexinlin', '林德新', '3232235893', '2016-09-27 16:51:12');
INSERT INTO `t_login_log` VALUES ('134', '17', 'monyyip', '叶财源222', '3232235889', '2016-09-27 17:22:31');
INSERT INTO `t_login_log` VALUES ('135', '16', 'dexinlin', '林德新', '3232235889', '2016-09-29 09:50:18');
INSERT INTO `t_login_log` VALUES ('136', '17', 'monyyip', '叶财源222', '3232235893', '2016-09-29 10:05:40');
INSERT INTO `t_login_log` VALUES ('137', '16', 'dexinlin', '林德新', '3232235889', '2016-10-10 11:12:56');
INSERT INTO `t_login_log` VALUES ('138', '17', 'monyyip', '叶财源222', '3232235889', '2016-10-17 10:34:24');
INSERT INTO `t_login_log` VALUES ('139', '17', 'monyyip', '叶财源222', '3232235889', '2016-10-17 15:41:01');
INSERT INTO `t_login_log` VALUES ('140', '16', 'dexinlin', '林德新', '3232235893', '2016-10-20 14:29:31');
INSERT INTO `t_login_log` VALUES ('141', '16', 'dexinlin', '林德新', '3232235893', '2016-10-24 16:48:07');

-- ----------------------------
-- Table structure for t_member
-- ----------------------------
DROP TABLE IF EXISTS `t_member`;
CREATE TABLE `t_member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_openId` varchar(50) NOT NULL,
  `m_username` varchar(50) DEFAULT NULL COMMENT '登录名',
  `m_password` varchar(150) DEFAULT NULL COMMENT '密码',
  `m_nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `m_avatar` varchar(150) DEFAULT NULL COMMENT '用户头像',
  `m_realname` varchar(50) DEFAULT NULL COMMENT '姓名',
  `m_phone` varchar(11) DEFAULT NULL COMMENT '联系电话',
  `m_sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别: 1男，2女',
  `m_point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `m_consume` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '消费金额',
  `m_vip` tinyint(4) NOT NULL DEFAULT '1' COMMENT '会员类型: 1平台用户，2代言人',
  `m_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1正常，2禁用',
  `m_regIp` bigint(20) NOT NULL COMMENT '注册IP',
  `m_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`m_id`),
  KEY `m_openId` (`m_openId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t_member
-- ----------------------------
INSERT INTO `t_member` VALUES ('1', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'moxiaobai', 'cc8a15d31a04d375382b2f2b32169193', '莫小白', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBhS1EEs16icyFL2aFRRRetCPwPwBOfq6hRDTUyolUKgq2ECc3PfITIDicwc0s0ianhOwNUFnIYY6DJA/0', '小白', '13509351822', '1', '0', '165000.00', '2', '2', '1709325908', '2016-08-16 09:57:22');
INSERT INTO `t_member` VALUES ('3', 'opz6Fv1EQ9PfwXbhkEB3CDIKqbVY', 'dexinlin', 'cc8a15d31a04d375382b2f2b32169193', '林德新', 'http://wx.qlogo.cn/mmopen/ezTU5wa6lSpJBfeMBbYdZcicepnDEQmAjz8nbWIJ6CFRndZFmqKliatIO5A5iaVpsiaOmM4gxGO7bmvT7ibXcPcpK6Cq2n8AWwTSJ/0', '李四', '13400507914', '1', '0', '0.00', '1', '1', '1709369748', '2016-08-16 10:25:49');
INSERT INTO `t_member` VALUES ('32', 'oqejGwLCyUlzMN97g5pvSOg2ep48', 'monyyip', 'cc8a15d31a04d375382b2f2b32169193', 'monyyip', 'http://wx.qlogo.cn/mmopen/HdcibxMWpDGoibHH4KTA6dEbk7ia3hKUT6VzE113Gv6u1QHdfsuZSaQuRGjH3PBVFQpnLdfibKd4V10CWTnKag8CEw/0', '小叶', '13400507914', '1', '0', '0.00', '2', '1', '1709369748', '2016-08-18 15:20:00');
INSERT INTO `t_member` VALUES ('37', '', 'xiaobai', 'M^TIzNDU2', null, null, '小八', null, '1', '0', '0.00', '1', '1', '0', '2016-08-24 14:26:46');

-- ----------------------------
-- Table structure for t_member_wealth
-- ----------------------------
DROP TABLE IF EXISTS `t_member_wealth`;
CREATE TABLE `t_member_wealth` (
  `mw_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL COMMENT '用户ID',
  `mw_had_withdraw_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已经提现',
  `mw_not_withdraw_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '未提现',
  `mw_withdraw_money` decimal(10,2) NOT NULL COMMENT '总提现金额',
  `mw_sales_money` decimal(10,2) NOT NULL COMMENT '销售额',
  `mw_award_money` decimal(10,2) NOT NULL COMMENT '奖励金额',
  `mw_addtime` datetime NOT NULL,
  PRIMARY KEY (`mw_id`),
  KEY `m_id` (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户财富';

-- ----------------------------
-- Records of t_member_wealth
-- ----------------------------
INSERT INTO `t_member_wealth` VALUES ('6', '1', '2.00', '0.64', '2.64', '132.00', '2.64', '2016-08-22 11:09:32');
INSERT INTO `t_member_wealth` VALUES ('7', '32', '0.00', '2475.00', '2475.00', '137500.00', '4125.00', '2016-08-25 14:50:35');

-- ----------------------------
-- Table structure for t_menus
-- ----------------------------
DROP TABLE IF EXISTS `t_menus`;
CREATE TABLE `t_menus` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_parent_id` int(11) NOT NULL COMMENT '父菜单ID',
  `m_name` varchar(50) NOT NULL COMMENT '菜单名称',
  `m_url` varchar(50) NOT NULL DEFAULT '#' COMMENT '菜单url 地址',
  `m_tag` varchar(50) DEFAULT NULL,
  `m_memo` text COMMENT '帮助',
  `m_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '菜单状态 1代表正常,2代表禁用',
  `m_addtime` datetime NOT NULL,
  `m_order` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='菜单';

-- ----------------------------
-- Records of t_menus
-- ----------------------------
INSERT INTO `t_menus` VALUES ('1', '0', '系统菜单', '#Main-Nav-System', 'Main-Nav-System', '', '1', '2016-08-18 11:08:00', '1');
INSERT INTO `t_menus` VALUES ('2', '1', '菜单管理', 'menu/index', 'menuindex', '', '1', '2016-08-12 16:36:34', '2');
INSERT INTO `t_menus` VALUES ('3', '0', '文章管理', '#Main-Nav-News', 'Main-Nav-News', '', '1', '2016-08-22 09:42:40', '6');
INSERT INTO `t_menus` VALUES ('4', '0', '广告管理', '#Main-Nav-Ads', 'Main-Nav-Ads', '', '1', '2016-08-12 16:01:47', '4');
INSERT INTO `t_menus` VALUES ('5', '1', '权限管理', 'right/index', 'rightindex', '', '1', '2016-08-12 16:36:46', '2');
INSERT INTO `t_menus` VALUES ('6', '3', '文章分类', 'newscategory/index', 'newscategoryindex', '', '1', '2016-08-12 16:36:08', '2');
INSERT INTO `t_menus` VALUES ('7', '3', '文章列表', 'news/index', 'newsindex', '', '1', '2016-08-12 16:35:40', '1');
INSERT INTO `t_menus` VALUES ('8', '4', '广告管理', 'ads/index', 'adsindex', '', '1', '2016-08-12 16:37:13', '1');
INSERT INTO `t_menus` VALUES ('9', '4', '广告组管理', 'adsgroup/index', 'adsgroupindex', '', '1', '2016-08-12 16:37:38', '2');
INSERT INTO `t_menus` VALUES ('10', '0', '会员管理', '#Main-Nav-Member', 'Main-Nav-Member', '', '1', '2016-08-12 16:38:42', '5');
INSERT INTO `t_menus` VALUES ('11', '10', '会员管理', 'member/index', 'memberindex', '', '1', '2016-08-12 16:39:12', '1');
INSERT INTO `t_menus` VALUES ('12', '0', 'sasd ', '123', '123', '', '2', '2016-08-13 11:23:51', '123');
INSERT INTO `t_menus` VALUES ('13', '1', '系统管理员', 'admin/index', 'adminindex', '', '1', '2016-08-13 14:10:53', '1');
INSERT INTO `t_menus` VALUES ('14', '1', '配置管理', 'config/index', 'configindex', '', '1', '2016-08-13 15:02:45', '5');
INSERT INTO `t_menus` VALUES ('15', '0', '订单管理', '#Main-Nav-Order', 'Main-Nav-Order', '', '1', '2016-08-22 09:42:32', '3');
INSERT INTO `t_menus` VALUES ('16', '0', '商品管理', '#Main-Nav-Product', 'Main-Nav-Product', '', '1', '2016-08-22 09:42:22', '2');
INSERT INTO `t_menus` VALUES ('17', '16', '商品分类', 'category/index', 'categoryindex', '', '1', '2016-08-15 10:25:12', '1');
INSERT INTO `t_menus` VALUES ('18', '16', '商品管理', 'product/index', 'productindex', '', '1', '2016-08-15 10:25:17', '2');
INSERT INTO `t_menus` VALUES ('19', '16', '商品规格管理', 'profiletype/index', 'profiletypeindex', '', '1', '2016-08-15 10:25:23', '3');
INSERT INTO `t_menus` VALUES ('20', '0', '微信管理', '#Main-Nav-Weixin', 'Main-Nav-Weixin', '', '1', '2016-08-22 09:42:59', '10');
INSERT INTO `t_menus` VALUES ('21', '20', '微信公众号配置', 'weichatsub/index', 'weichatsubindex', '', '1', '2016-08-15 10:28:55', '1');
INSERT INTO `t_menus` VALUES ('22', '20', '自定义微信菜单', 'diymenu/index', 'diymenuindex', '', '1', '2016-08-18 15:12:43', '2');
INSERT INTO `t_menus` VALUES ('23', '20', '关注自动回复配置', 'focus/index', 'focusindex', '', '1', '2016-08-18 15:12:34', '3');
INSERT INTO `t_menus` VALUES ('24', '20', '自定义关键字回复', 'keywords/index', 'keywordsindex', '', '1', '2016-08-15 10:30:33', '4');
INSERT INTO `t_menus` VALUES ('25', '20', '客服消息模版配置', 'message/index', 'messageindex', '', '1', '2016-08-18 15:13:00', '5');
INSERT INTO `t_menus` VALUES ('26', '15', '订单列表', 'order/index', 'orderindex', '', '1', '2016-08-15 14:01:28', '1');
INSERT INTO `t_menus` VALUES ('27', '10', '用户财富', 'memberwealth/index', 'memberwealthindex', '', '1', '2016-08-16 15:15:42', '2');
INSERT INTO `t_menus` VALUES ('28', '0', '分销管理', '#Main-Nav-Distribution', 'Main-Nav-Distribution', '', '1', '2016-08-16 16:26:09', '8');
INSERT INTO `t_menus` VALUES ('29', '28', '佣金明细', 'ordersales/index', 'ordersalesindex', '', '1', '2016-08-16 16:27:13', '1');
INSERT INTO `t_menus` VALUES ('30', '3', '公告管理', 'article/index', 'articleindex', '', '1', '2016-08-17 17:31:40', '3');
INSERT INTO `t_menus` VALUES ('31', '0', '财务管理', '#Main-Nav-Finance', 'Main-Nav-Finance', '', '1', '2016-08-17 10:46:20', '9');
INSERT INTO `t_menus` VALUES ('32', '31', '支付明细', 'payment/index', 'paymentindex', '', '1', '2016-08-17 10:49:12', '1');
INSERT INTO `t_menus` VALUES ('33', '31', '提现记录', 'cashlog/index', 'cashlogindex', '', '1', '2016-08-17 10:49:51', '2');
INSERT INTO `t_menus` VALUES ('34', '31', '统计管理', 'cashcount/index', 'cashcountindex', '', '1', '2016-08-17 10:50:50', '3');
INSERT INTO `t_menus` VALUES ('35', '0', '测试', 'deg/index', '123123', '', '2', '2016-08-17 14:06:08', '5');
INSERT INTO `t_menus` VALUES ('36', '0', '测试', 'qweqw/qweqw', 'qweqweewqqew', '', '2', '2016-08-17 14:06:56', '8');
INSERT INTO `t_menus` VALUES ('37', '0', 'e速养车2', 'dege', 'dege', '', '2', '2016-08-17 14:19:16', '255');
INSERT INTO `t_menus` VALUES ('38', '0', 'te', 'te', 'te', '', '2', '2016-08-17 14:20:06', '255');
INSERT INTO `t_menus` VALUES ('39', '0', '其他', '#Main-Nav-Other', 'Main-Nav-Other', '', '2', '2016-08-17 17:24:15', '10');
INSERT INTO `t_menus` VALUES ('40', '39', '缴费送红包红包', 'community/redPack/index', 'CommunityRedPack', '', '2', '2016-08-17 17:24:58', '1');
INSERT INTO `t_menus` VALUES ('41', '16', '分类管理', 'nweq', 'dqweqw', '', '2', '2016-08-18 11:08:45', '2');
INSERT INTO `t_menus` VALUES ('42', '1', '预览用户', 'previewmember/index', 'PreviewmemberIndex', '', '2', '2016-09-07 09:43:24', '5');
INSERT INTO `t_menus` VALUES ('43', '0', '帮助管理', '#Main-Nav-Help', 'Main-Nav-Help', '', '1', '2016-09-07 15:47:07', '1');
INSERT INTO `t_menus` VALUES ('44', '43', '帮助列表', 'help/index', 'HelpIndex', '', '1', '2016-09-07 15:47:29', '1');

-- ----------------------------
-- Table structure for t_news
-- ----------------------------
DROP TABLE IF EXISTS `t_news`;
CREATE TABLE `t_news` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `nc_id` int(11) NOT NULL COMMENT '分类ID',
  `n_title` varchar(255) NOT NULL COMMENT '标题',
  `n_des` varchar(255) DEFAULT NULL COMMENT '导读',
  `n_cover` varchar(155) DEFAULT NULL COMMENT '封面',
  `n_content` text NOT NULL,
  `n_sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `n_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1正常，2禁用',
  `n_addtime` datetime NOT NULL COMMENT '添加时间',
  `n_recommend` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否推荐: 1不推荐，2推荐',
  PRIMARY KEY (`n_id`),
  KEY `nc_id` (`nc_id`),
  KEY `n_title` (`n_title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of t_news
-- ----------------------------
INSERT INTO `t_news` VALUES ('1', '25', '【环球时报驻印尼特约记者 游弦鹤】今天是印尼国庆日。', '【环球时报驻印尼特约记者 游弦鹤】今天是印尼国庆日。+1', 'http://image.visp.info/news/20160818/55b2ea89-3f09-4653-960b-5f7bd71737c3.jpg', '<p>【环球时报驻印尼特约记者 游弦鹤】今天是印尼国庆日。</p>', '1', '1', '2016-08-17 15:09:37', '1');
INSERT INTO `t_news` VALUES ('2', '23', '南海军演', '南海军演33', 'http://image.visp.info/news/20160818/a280782b-191b-4c06-8704-1a7b9fa7292d.jpg', '<p>南海军演</p>', '1', '1', '2016-08-18 11:13:11', '1');
INSERT INTO `t_news` VALUES ('3', '23', '33', '44', 'http://image.visp.info/news/20160818/10a65cca-1e86-4e4c-ab94-fe393f4f04cc.png', '<p><img src=\"http://image.visp.info/news/20160818/327057a7-3fc4-46ff-8c1c-7f6c495980e5.png\" _src=\"http://image.visp.info/news/20160818/327057a7-3fc4-46ff-8c1c-7f6c495980e5.png\"/></p>', '1', '1', '2016-08-18 11:37:47', '1');

-- ----------------------------
-- Table structure for t_news_category
-- ----------------------------
DROP TABLE IF EXISTS `t_news_category`;
CREATE TABLE `t_news_category` (
  `nc_id` int(11) NOT NULL AUTO_INCREMENT,
  `nc_parent_id` int(11) NOT NULL COMMENT '父分类',
  `nc_alias` varchar(50) NOT NULL COMMENT '别名',
  `nc_name` varchar(100) NOT NULL COMMENT '分类名称',
  `nc_sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `nc_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1正常，2禁用',
  `nc_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`nc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of t_news_category
-- ----------------------------
INSERT INTO `t_news_category` VALUES ('23', '0', 'information', '资讯', '1', '1', '2016-08-17 14:58:29');
INSERT INTO `t_news_category` VALUES ('25', '0', 'information2', '使用指南', '3', '1', '2016-08-17 15:03:32');

-- ----------------------------
-- Table structure for t_notify_log
-- ----------------------------
DROP TABLE IF EXISTS `t_notify_log`;
CREATE TABLE `t_notify_log` (
  `nl_id` int(11) NOT NULL AUTO_INCREMENT,
  `nl_platform` int(11) NOT NULL COMMENT '平台ID，1微信',
  `out_trade_no` varchar(100) DEFAULT NULL COMMENT '平台订单号',
  `transaction_id` varchar(100) DEFAULT NULL COMMENT '微信订单号',
  `nl_data` text NOT NULL COMMENT '日志',
  `nl_datetime` datetime NOT NULL COMMENT '通知时间',
  PRIMARY KEY (`nl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COMMENT='支付通知回调日志';

-- ----------------------------
-- Records of t_notify_log
-- ----------------------------
INSERT INTO `t_notify_log` VALUES ('131', '1', '2016121212111', '2016121212111666666', '{\"out_trade_no\":\"2016121212111\",\"transaction_id\":\"2016121212111666666\"}', '2016-08-20 10:15:43');

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_order_no` varchar(50) NOT NULL COMMENT '订单号',
  `m_id` int(11) NOT NULL COMMENT '用户ID',
  `p_id` int(11) NOT NULL COMMENT '产品ID',
  `p_title` varchar(150) NOT NULL COMMENT '商品名称',
  `pp_ids` varchar(50) DEFAULT NULL COMMENT '套餐ID',
  `pp_title` varchar(150) NOT NULL COMMENT '套餐名称',
  `p_price` decimal(10,2) NOT NULL COMMENT '商品单价',
  `o_number` int(11) NOT NULL COMMENT '购买数量',
  `o_order_amount` decimal(10,2) NOT NULL COMMENT '订单总额',
  `o_payment_amount` decimal(10,2) NOT NULL COMMENT '实付金额',
  `o_award_amount` decimal(10,2) DEFAULT NULL COMMENT '分成金额',
  `o_pay_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '支付状态:1未支付，2取消订单，3已经支付',
  `o_order_status` tinyint(4) NOT NULL COMMENT '订单状态:1未发货，2已经发货,3确认收货',
  `o_addtime` datetime NOT NULL,
  `o_updatetime` datetime DEFAULT NULL COMMENT '更新时间',
  `o_express_company` varchar(50) DEFAULT NULL COMMENT '快递公司',
  `o_express_number` varchar(25) DEFAULT NULL COMMENT '快递单号',
  `o_memo` varchar(255) DEFAULT NULL COMMENT '客户留言',
  `o_close_remark` varchar(255) DEFAULT NULL COMMENT '关闭订单备注',
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES ('69', '201608221106250879', '32', '176', '商品没有分成，有套餐', '247,245', 'M,黑色', '22.00', '1', '22.00', '22.00', '0.00', '3', '3', '2016-08-22 11:06:25', '2016-08-22 11:06:46', null, null, '', null);
INSERT INTO `t_order` VALUES ('70', '201608221107079381', '32', '176', '商品没有分成，有套餐', '247,245', 'M,黑色', '22.00', '1', '22.00', '22.00', '0.00', '2', '1', '2016-08-22 11:07:07', '2016-08-22 11:07:24', null, null, '', null);
INSERT INTO `t_order` VALUES ('71', '201608221109312668', '32', '176', '商品没有分成，有套餐', '247,245', 'M,黑色', '22.00', '1', '22.00', '22.00', '0.44', '3', '3', '2016-08-22 11:09:31', '2016-08-22 11:10:36', null, null, '', null);
INSERT INTO `t_order` VALUES ('72', '201608221110549522', '32', '176', '商品没有分成，有套餐', '246,245', 'L,黑色', '22.00', '5', '110.00', '110.00', '2.20', '3', '3', '2016-08-22 11:10:54', '2016-08-22 11:11:20', null, null, '', null);
INSERT INTO `t_order` VALUES ('73', '201608230910148822', '1', '176', '商品没有分成，有套餐', '247,245', 'M,黑色', '22.00', '1', '22.00', '22.00', '0.00', '2', '1', '2016-08-23 09:10:14', '2016-08-23 09:10:34', null, null, '', null);
INSERT INTO `t_order` VALUES ('74', '201608230910517179', '1', '176', '商品没有分成，有套餐', '247,245', 'M,黑色', '22.00', '1', '22.00', '22.00', '0.00', '3', '3', '2016-08-23 09:10:51', '2016-08-23 09:21:16', null, null, '', null);
INSERT INTO `t_order` VALUES ('75', '201608230935521000', '1', '176', '商品没有分成，有套餐', '247,245', 'M,黑色', '22.00', '1', '22.00', '22.00', '0.00', '1', '1', '2016-08-23 09:35:52', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('76', '201608231108565018', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '2', '1', '2016-08-23 11:08:56', '2016-08-23 11:09:10', null, null, '', null);
INSERT INTO `t_order` VALUES ('77', '201608231116154074', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '1', '1', '2016-08-23 11:16:15', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('78', '201608231116197854', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '1', '1', '2016-08-23 11:16:19', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('79', '201608231116288167', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '1', '1', '2016-08-23 11:16:28', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('80', '201608231116371822', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '1', '1', '2016-08-23 11:16:37', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('81', '201608231116441838', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '1', '1', '2016-08-23 11:16:44', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('82', '201608231116525724', '32', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '1', '1', '2016-08-23 11:16:52', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('83', '201608231118080448', '1', '175', '商品没有套餐，没有分成', '', '', '33.00', '1', '33.00', '33.00', '0.00', '3', '3', '2016-08-23 11:18:08', '2016-08-25 14:55:07', '顺丰快递', '123123', '', null);
INSERT INTO `t_order` VALUES ('84', '201608241203226454', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '0.00', '3', '3', '2016-08-24 12:03:22', '2016-08-25 14:54:59', null, null, '', null);
INSERT INTO `t_order` VALUES ('85', '201608241524199075', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '0.00', '1', '1', '2016-08-24 15:24:19', null, null, null, '', null);
INSERT INTO `t_order` VALUES ('86', '201608251450355884', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '2', '1', '2016-08-25 14:50:35', '2016-08-25 14:54:49', null, null, '', null);
INSERT INTO `t_order` VALUES ('87', '201608251455318901', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '3', '3', '2016-08-25 14:55:31', '2016-08-25 14:56:09', null, null, '', null);
INSERT INTO `t_order` VALUES ('88', '201608251457420579', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '3', '2', '2016-08-25 14:57:42', '2016-09-01 16:36:20', '顺丰快递', '3313253705855', '', null);
INSERT INTO `t_order` VALUES ('89', '201608251505445508', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '3', '2', '2016-08-25 15:05:44', '2016-09-01 15:35:34', '申通快递', '3313253705855', '', null);
INSERT INTO `t_order` VALUES ('90', '201608251508014931', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '3', '3', '2016-08-25 15:08:01', '2016-08-25 15:08:31', null, null, '', null);
INSERT INTO `t_order` VALUES ('91', '201608251509349205', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '2', '1', '2016-08-25 15:09:34', '2016-08-25 15:09:47', null, null, '', null);
INSERT INTO `t_order` VALUES ('92', '201608251509562665', '1', '174', '【上善若水】 电解还原水机-顶级产品值得信赖', '', '', '27500.00', '1', '27500.00', '27500.00', '825.00', '3', '3', '2016-08-25 15:09:56', '2016-08-25 15:10:10', null, null, '', null);

-- ----------------------------
-- Table structure for t_order_auto_close
-- ----------------------------
DROP TABLE IF EXISTS `t_order_auto_close`;
CREATE TABLE `t_order_auto_close` (
  `oac_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL COMMENT '订单ID',
  `oac_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '处理状态:1未处理，2处理完毕',
  `oac_addtime` datetime NOT NULL COMMENT '添加时间',
  `oac_updatetime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`oac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='订单自动关闭';

-- ----------------------------
-- Records of t_order_auto_close
-- ----------------------------
INSERT INTO `t_order_auto_close` VALUES ('37', '75', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('38', '77', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('39', '78', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('40', '79', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('41', '80', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('42', '81', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('43', '82', '1', '2016-08-24 16:39:37', null);
INSERT INTO `t_order_auto_close` VALUES ('44', '85', '1', '2016-08-24 16:39:38', null);

-- ----------------------------
-- Table structure for t_order_auto_complete
-- ----------------------------
DROP TABLE IF EXISTS `t_order_auto_complete`;
CREATE TABLE `t_order_auto_complete` (
  `oac_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL COMMENT '订单ID',
  `oac_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '处理状态: 1未处理，2已经处理',
  `oac_addtime` datetime NOT NULL COMMENT '添加时间',
  `oac_updatetime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`oac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='订单自动完成';

-- ----------------------------
-- Records of t_order_auto_complete
-- ----------------------------
INSERT INTO `t_order_auto_complete` VALUES ('3', '74', '2', '2016-08-23 09:19:34', '2016-08-23 09:21:16');

-- ----------------------------
-- Table structure for t_order_progress
-- ----------------------------
DROP TABLE IF EXISTS `t_order_progress`;
CREATE TABLE `t_order_progress` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL COMMENT '订单ID',
  `op_memo` varchar(50) NOT NULL COMMENT '订单备注',
  `op_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8 COMMENT='订单进度';

-- ----------------------------
-- Records of t_order_progress
-- ----------------------------
INSERT INTO `t_order_progress` VALUES ('30', '38', '用户取消订单', '2016-08-20 14:59:01');
INSERT INTO `t_order_progress` VALUES ('31', '39', '用户取消订单', '2016-08-20 14:58:40');
INSERT INTO `t_order_progress` VALUES ('32', '38', '用户取消订单', '2016-08-20 15:00:25');
INSERT INTO `t_order_progress` VALUES ('33', '38', '用户取消订单', '2016-08-20 15:01:27');
INSERT INTO `t_order_progress` VALUES ('34', '38', '用户取消订单', '2016-08-20 15:03:57');
INSERT INTO `t_order_progress` VALUES ('35', '38', '用户取消订单', '2016-08-20 15:09:21');
INSERT INTO `t_order_progress` VALUES ('36', '40', '创建订单', '2016-08-20 15:25:11');
INSERT INTO `t_order_progress` VALUES ('37', '40', '成功支付订单', '2016-08-20 15:26:45');
INSERT INTO `t_order_progress` VALUES ('38', '41', '创建订单', '2016-08-20 15:42:32');
INSERT INTO `t_order_progress` VALUES ('39', '42', '创建订单', '2016-08-20 15:55:44');
INSERT INTO `t_order_progress` VALUES ('40', '43', '创建订单', '2016-08-20 15:55:50');
INSERT INTO `t_order_progress` VALUES ('41', '44', '创建订单', '2016-08-20 15:56:55');
INSERT INTO `t_order_progress` VALUES ('42', '45', '创建订单', '2016-08-20 15:57:34');
INSERT INTO `t_order_progress` VALUES ('43', '46', '创建订单', '2016-08-20 15:58:36');
INSERT INTO `t_order_progress` VALUES ('44', '46', '用户取消订单', '2016-08-20 15:59:03');
INSERT INTO `t_order_progress` VALUES ('45', '45', '成功支付订单', '2016-08-20 16:00:36');
INSERT INTO `t_order_progress` VALUES ('46', '45', '用户确认订单', '2016-08-20 16:01:47');
INSERT INTO `t_order_progress` VALUES ('47', '47', '创建订单', '2016-08-20 16:17:20');
INSERT INTO `t_order_progress` VALUES ('48', '48', '创建订单', '2016-08-20 16:23:19');
INSERT INTO `t_order_progress` VALUES ('49', '48', '成功支付订单', '2016-08-20 16:24:03');
INSERT INTO `t_order_progress` VALUES ('50', '48', '用户确认订单', '2016-08-20 16:26:09');
INSERT INTO `t_order_progress` VALUES ('51', '49', '创建订单', '2016-08-20 16:43:19');
INSERT INTO `t_order_progress` VALUES ('52', '50', '创建订单', '2016-08-20 17:11:49');
INSERT INTO `t_order_progress` VALUES ('53', '51', '创建订单', '2016-08-20 17:31:35');
INSERT INTO `t_order_progress` VALUES ('54', '40', '填写快递信息', '2016-08-20 17:48:29');
INSERT INTO `t_order_progress` VALUES ('55', '52', '创建订单', '2016-08-20 17:58:19');
INSERT INTO `t_order_progress` VALUES ('56', '53', '创建订单', '2016-08-20 17:59:00');
INSERT INTO `t_order_progress` VALUES ('57', '54', '创建订单', '2016-08-20 18:00:30');
INSERT INTO `t_order_progress` VALUES ('58', '55', '创建订单', '2016-08-22 09:55:54');
INSERT INTO `t_order_progress` VALUES ('59', '56', '创建订单', '2016-08-22 09:59:40');
INSERT INTO `t_order_progress` VALUES ('60', '57', '创建订单', '2016-08-22 09:59:55');
INSERT INTO `t_order_progress` VALUES ('61', '57', '用户取消订单', '2016-08-22 10:01:04');
INSERT INTO `t_order_progress` VALUES ('62', '56', '用户取消订单', '2016-08-22 10:01:23');
INSERT INTO `t_order_progress` VALUES ('63', '55', '用户取消订单', '2016-08-22 10:01:48');
INSERT INTO `t_order_progress` VALUES ('64', '37', '用户取消订单', '2016-08-22 10:05:51');
INSERT INTO `t_order_progress` VALUES ('65', '39', '用户取消订单', '2016-08-22 10:06:22');
INSERT INTO `t_order_progress` VALUES ('66', '41', '用户取消订单', '2016-08-22 10:06:22');
INSERT INTO `t_order_progress` VALUES ('67', '42', '用户取消订单', '2016-08-22 10:06:23');
INSERT INTO `t_order_progress` VALUES ('68', '43', '用户取消订单', '2016-08-22 10:06:23');
INSERT INTO `t_order_progress` VALUES ('69', '44', '用户取消订单', '2016-08-22 10:06:23');
INSERT INTO `t_order_progress` VALUES ('70', '47', '用户取消订单', '2016-08-22 10:06:24');
INSERT INTO `t_order_progress` VALUES ('71', '49', '用户取消订单', '2016-08-22 10:06:24');
INSERT INTO `t_order_progress` VALUES ('72', '50', '用户取消订单', '2016-08-22 10:06:25');
INSERT INTO `t_order_progress` VALUES ('73', '51', '用户取消订单', '2016-08-22 10:06:25');
INSERT INTO `t_order_progress` VALUES ('74', '52', '用户取消订单', '2016-08-22 10:06:25');
INSERT INTO `t_order_progress` VALUES ('75', '53', '用户取消订单', '2016-08-22 10:06:26');
INSERT INTO `t_order_progress` VALUES ('76', '54', '用户取消订单', '2016-08-22 10:06:38');
INSERT INTO `t_order_progress` VALUES ('77', '58', '创建订单', '2016-08-22 10:07:51');
INSERT INTO `t_order_progress` VALUES ('78', '58', '成功支付订单', '2016-08-22 10:08:19');
INSERT INTO `t_order_progress` VALUES ('79', '58', '发货成功', '2016-08-22 10:11:37');
INSERT INTO `t_order_progress` VALUES ('80', '58', '填写快递信息', '2016-08-22 10:13:32');
INSERT INTO `t_order_progress` VALUES ('81', '58', '用户确认订单', '2016-08-22 10:14:28');
INSERT INTO `t_order_progress` VALUES ('82', '58', '用户确认订单', '2016-08-22 10:14:41');
INSERT INTO `t_order_progress` VALUES ('83', '59', '创建订单', '2016-08-22 10:14:52');
INSERT INTO `t_order_progress` VALUES ('84', '60', '创建订单', '2016-08-22 10:18:14');
INSERT INTO `t_order_progress` VALUES ('85', '60', '用户取消订单', '2016-08-22 10:19:03');
INSERT INTO `t_order_progress` VALUES ('86', '59', '用户取消订单', '2016-08-22 10:19:30');
INSERT INTO `t_order_progress` VALUES ('87', '61', '创建订单', '2016-08-22 10:20:30');
INSERT INTO `t_order_progress` VALUES ('88', '61', '用户取消订单', '2016-08-22 10:20:57');
INSERT INTO `t_order_progress` VALUES ('89', '62', '创建订单', '2016-08-22 10:23:19');
INSERT INTO `t_order_progress` VALUES ('90', '62', '用户取消订单', '2016-08-22 10:23:30');
INSERT INTO `t_order_progress` VALUES ('91', '63', '创建订单', '2016-08-22 10:26:31');
INSERT INTO `t_order_progress` VALUES ('92', '64', '创建订单', '2016-08-22 10:26:53');
INSERT INTO `t_order_progress` VALUES ('93', '64', '用户取消订单', '2016-08-22 10:27:05');
INSERT INTO `t_order_progress` VALUES ('94', '63', '用户取消订单', '2016-08-22 10:27:34');
INSERT INTO `t_order_progress` VALUES ('95', '65', '创建订单', '2016-08-22 10:29:22');
INSERT INTO `t_order_progress` VALUES ('96', '65', '成功支付订单', '2016-08-22 10:29:33');
INSERT INTO `t_order_progress` VALUES ('97', '66', '创建订单', '2016-08-22 10:32:52');
INSERT INTO `t_order_progress` VALUES ('98', '66', '修改订单价格为556.00', '2016-08-22 10:33:39');
INSERT INTO `t_order_progress` VALUES ('99', '67', '创建订单', '2016-08-22 10:45:48');
INSERT INTO `t_order_progress` VALUES ('100', '65', '用户确认订单', '2016-08-22 10:53:43');
INSERT INTO `t_order_progress` VALUES ('101', '58', '用户确认订单', '2016-08-22 10:53:54');
INSERT INTO `t_order_progress` VALUES ('102', '58', '用户确认订单', '2016-08-22 10:54:09');
INSERT INTO `t_order_progress` VALUES ('103', '66', '用户取消订单', '2016-08-22 10:58:51');
INSERT INTO `t_order_progress` VALUES ('104', '67', '用户取消订单', '2016-08-22 10:59:45');
INSERT INTO `t_order_progress` VALUES ('105', '68', '创建订单', '2016-08-22 11:00:39');
INSERT INTO `t_order_progress` VALUES ('106', '68', '成功支付订单', '2016-08-22 11:02:36');
INSERT INTO `t_order_progress` VALUES ('107', '68', '用户确认订单', '2016-08-22 11:03:06');
INSERT INTO `t_order_progress` VALUES ('108', '58', '用户确认订单', '2016-08-22 11:04:10');
INSERT INTO `t_order_progress` VALUES ('109', '40', '用户确认订单', '2016-08-22 11:04:38');
INSERT INTO `t_order_progress` VALUES ('110', '58', '用户确认订单', '2016-08-22 11:04:47');
INSERT INTO `t_order_progress` VALUES ('111', '69', '创建订单', '2016-08-22 11:06:25');
INSERT INTO `t_order_progress` VALUES ('112', '69', '成功支付订单', '2016-08-22 11:06:34');
INSERT INTO `t_order_progress` VALUES ('113', '69', '用户确认订单', '2016-08-22 11:06:46');
INSERT INTO `t_order_progress` VALUES ('114', '70', '创建订单', '2016-08-22 11:07:07');
INSERT INTO `t_order_progress` VALUES ('115', '70', '用户取消订单', '2016-08-22 11:07:24');
INSERT INTO `t_order_progress` VALUES ('116', '71', '创建订单', '2016-08-22 11:09:31');
INSERT INTO `t_order_progress` VALUES ('117', '71', '成功支付订单', '2016-08-22 11:09:53');
INSERT INTO `t_order_progress` VALUES ('118', '71', '用户确认订单', '2016-08-22 11:10:35');
INSERT INTO `t_order_progress` VALUES ('119', '72', '创建订单', '2016-08-22 11:10:54');
INSERT INTO `t_order_progress` VALUES ('120', '72', '成功支付订单', '2016-08-22 11:11:11');
INSERT INTO `t_order_progress` VALUES ('121', '72', '用户确认订单', '2016-08-22 11:11:20');
INSERT INTO `t_order_progress` VALUES ('122', '73', '创建订单', '2016-08-23 09:10:14');
INSERT INTO `t_order_progress` VALUES ('123', '73', '用户取消订单', '2016-08-23 09:10:34');
INSERT INTO `t_order_progress` VALUES ('124', '74', '创建订单', '2016-08-23 09:10:51');
INSERT INTO `t_order_progress` VALUES ('125', '74', '成功支付订单', '2016-08-23 09:11:49');
INSERT INTO `t_order_progress` VALUES ('126', '74', '发货成功', '2016-08-23 09:19:16');
INSERT INTO `t_order_progress` VALUES ('127', '74', '用户确认订单', '2016-08-23 09:19:49');
INSERT INTO `t_order_progress` VALUES ('128', '74', '用户确认订单', '2016-08-23 09:21:16');
INSERT INTO `t_order_progress` VALUES ('129', '75', '创建订单', '2016-08-23 09:35:52');
INSERT INTO `t_order_progress` VALUES ('130', '76', '创建订单', '2016-08-23 11:08:56');
INSERT INTO `t_order_progress` VALUES ('131', '76', '用户取消订单', '2016-08-23 11:09:09');
INSERT INTO `t_order_progress` VALUES ('132', '77', '创建订单', '2016-08-23 11:16:15');
INSERT INTO `t_order_progress` VALUES ('133', '78', '创建订单', '2016-08-23 11:16:19');
INSERT INTO `t_order_progress` VALUES ('134', '79', '创建订单', '2016-08-23 11:16:28');
INSERT INTO `t_order_progress` VALUES ('135', '80', '创建订单', '2016-08-23 11:16:37');
INSERT INTO `t_order_progress` VALUES ('136', '81', '创建订单', '2016-08-23 11:16:44');
INSERT INTO `t_order_progress` VALUES ('137', '82', '创建订单', '2016-08-23 11:16:52');
INSERT INTO `t_order_progress` VALUES ('138', '83', '创建订单', '2016-08-23 11:18:08');
INSERT INTO `t_order_progress` VALUES ('139', '83', '填写快递信息', '2016-08-23 11:32:24');
INSERT INTO `t_order_progress` VALUES ('140', '83', '填写快递信息', '2016-08-23 11:32:31');
INSERT INTO `t_order_progress` VALUES ('141', '83', '发货成功', '2016-08-23 11:33:05');
INSERT INTO `t_order_progress` VALUES ('142', '83', '发货成功', '2016-08-23 11:42:01');
INSERT INTO `t_order_progress` VALUES ('143', '83', '填写快递信息', '2016-08-23 11:50:25');
INSERT INTO `t_order_progress` VALUES ('144', '84', '创建订单', '2016-08-24 12:03:22');
INSERT INTO `t_order_progress` VALUES ('145', '84', '成功支付订单', '2016-08-24 12:03:37');
INSERT INTO `t_order_progress` VALUES ('146', '85', '创建订单', '2016-08-24 15:24:19');
INSERT INTO `t_order_progress` VALUES ('147', '86', '创建订单', '2016-08-25 14:50:35');
INSERT INTO `t_order_progress` VALUES ('148', '86', '用户取消订单', '2016-08-25 14:54:49');
INSERT INTO `t_order_progress` VALUES ('149', '84', '用户确认订单', '2016-08-25 14:54:59');
INSERT INTO `t_order_progress` VALUES ('150', '83', '用户确认订单', '2016-08-25 14:55:06');
INSERT INTO `t_order_progress` VALUES ('151', '87', '创建订单', '2016-08-25 14:55:31');
INSERT INTO `t_order_progress` VALUES ('152', '87', '成功支付订单', '2016-08-25 14:56:04');
INSERT INTO `t_order_progress` VALUES ('153', '87', '用户确认订单', '2016-08-25 14:56:09');
INSERT INTO `t_order_progress` VALUES ('154', '88', '创建订单', '2016-08-25 14:57:42');
INSERT INTO `t_order_progress` VALUES ('155', '88', '成功支付订单', '2016-08-25 14:57:49');
INSERT INTO `t_order_progress` VALUES ('156', '89', '创建订单', '2016-08-25 15:05:44');
INSERT INTO `t_order_progress` VALUES ('157', '89', '成功支付订单', '2016-08-25 15:05:56');
INSERT INTO `t_order_progress` VALUES ('158', '90', '创建订单', '2016-08-25 15:08:01');
INSERT INTO `t_order_progress` VALUES ('159', '90', '成功支付订单', '2016-08-25 15:08:09');
INSERT INTO `t_order_progress` VALUES ('160', '90', '用户确认订单', '2016-08-25 15:08:31');
INSERT INTO `t_order_progress` VALUES ('161', '91', '创建订单', '2016-08-25 15:09:34');
INSERT INTO `t_order_progress` VALUES ('162', '91', '用户取消订单', '2016-08-25 15:09:46');
INSERT INTO `t_order_progress` VALUES ('163', '92', '创建订单', '2016-08-25 15:09:56');
INSERT INTO `t_order_progress` VALUES ('164', '92', '成功支付订单', '2016-08-25 15:10:02');
INSERT INTO `t_order_progress` VALUES ('165', '92', '用户确认订单', '2016-08-25 15:10:10');
INSERT INTO `t_order_progress` VALUES ('166', '89', '填写快递信息', '2016-09-01 15:35:24');
INSERT INTO `t_order_progress` VALUES ('167', '89', '发货成功', '2016-09-01 15:35:34');
INSERT INTO `t_order_progress` VALUES ('168', '88', '填写快递信息', '2016-09-01 15:41:30');
INSERT INTO `t_order_progress` VALUES ('169', '88', '发货成功', '2016-09-01 16:36:20');
INSERT INTO `t_order_progress` VALUES ('170', '88', '用户确认订单', '2016-09-01 16:36:35');

-- ----------------------------
-- Table structure for t_pay_payment
-- ----------------------------
DROP TABLE IF EXISTS `t_pay_payment`;
CREATE TABLE `t_pay_payment` (
  `pp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `pp_type` tinyint(4) NOT NULL COMMENT '类型: 1门票，2酒水，3点歌',
  `pp_order_no` varchar(50) NOT NULL COMMENT '订单号',
  `pp_transaction_id` varchar(50) NOT NULL COMMENT '第三方平台订单号',
  `pp_money` decimal(10,2) NOT NULL COMMENT '支付总金额',
  `pp_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`pp_id`),
  UNIQUE KEY `p_order_no` (`pp_order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户支付表';

-- ----------------------------
-- Records of t_pay_payment
-- ----------------------------

-- ----------------------------
-- Table structure for t_pay_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `t_pay_withdraw`;
CREATE TABLE `t_pay_withdraw` (
  `pw_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `pw_money` decimal(10,2) NOT NULL,
  `pw_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态: 1未处理，2已完成 , 3失败',
  `pw_addtime` datetime NOT NULL COMMENT '申请时间',
  `pw_updatetime` datetime DEFAULT NULL COMMENT '处理时间',
  PRIMARY KEY (`pw_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='用户提现';

-- ----------------------------
-- Records of t_pay_withdraw
-- ----------------------------
INSERT INTO `t_pay_withdraw` VALUES ('17', '1', '10.00', '1', '2016-08-23 14:31:24', null);
INSERT INTO `t_pay_withdraw` VALUES ('18', '1', '2.00', '1', '2016-08-24 15:22:15', null);

-- ----------------------------
-- Table structure for t_product
-- ----------------------------
DROP TABLE IF EXISTS `t_product`;
CREATE TABLE `t_product` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_id` int(11) NOT NULL COMMENT '分类id',
  `p_title` varchar(255) NOT NULL COMMENT '标题',
  `p_cover` varchar(255) NOT NULL COMMENT '封面',
  `p_content` text,
  `p_sales` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `p_rate` int(11) NOT NULL DEFAULT '0' COMMENT '比例',
  `p_stock` int(11) NOT NULL COMMENT '商品库存',
  `p_original_price` decimal(10,2) DEFAULT '0.00' COMMENT '商品价格（前台显示）',
  `p_event_price` decimal(10,2) DEFAULT '0.00' COMMENT '活动价格（前台显示）',
  `p_sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `p_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态1为正常2为禁用3为删除',
  `p_updateTime` datetime DEFAULT NULL,
  `p_addTime` datetime NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `p_title` (`p_title`) USING BTREE,
  KEY `pc_id` (`pc_id`) USING BTREE,
  KEY `p_order` (`p_sort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='旅游产品';

-- ----------------------------
-- Records of t_product
-- ----------------------------
INSERT INTO `t_product` VALUES ('33', '36', '【上善若水】 电解还原水机-顶级产品值得信赖', 'http://oc1bn3cfn.bkt.clouddn.com/product/20160818/4711b40a-75ec-49da-a421-dcfeaad641dd.jpg', '<p><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160518/20160518152936_84761.jpg\" style=\"max-width: 100%; float: left; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/></p>', '1', '2', '0', '27500.00', '27500.00', '33', '1', '2016-08-20 18:09:56', '2016-08-13 14:28:32');
INSERT INTO `t_product` VALUES ('174', '36', '【上善若水】 电解还原水机-顶级产品值得信赖', 'http://oc1bn3cfn.bkt.clouddn.com/product/20160818/068922d1-60ad-4897-b6b4-54d68485f08e.jpg', '<hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><strong><span style=\"font-size: 24px;\">产地介绍</span></strong></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><strong></strong>&nbsp;</p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160513/20160513175808_66585.png\" width=\"500\" height=\"142\" style=\"max-width: 100%; float: left;\"/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Enagic公司于上个世纪1974年成立，是一家专门制造电解水生成器的企业，业务遍布全球多个国家和地区。从LeveLuk DX开始，LeveLuk Series、Anespa等产品都给大家的健康、美容、卫生、饮食等带来了革命性的变化。是一家提供高质量，具有强大功能的&quot;水的器材&quot;的专门厂商。作为集开发、制造、销售和服务为一体的综合型企业，且以美国为中心开设海外据点，向世界宣布信息全球化企业，在世界各地开展业务。</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><strong>&nbsp;</strong></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p><strong style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"font-size: 24px;\">Enagic&nbsp;SD501产品介绍&nbsp;</span></strong><span style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"></span></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p><br style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><span style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\">&nbsp;</span><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160516/20160516170209_74198.jpg\" style=\"max-width: 100%; float: left; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/><strong></strong></p><p><strong style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"></strong></p><table border=\"1\" cellspacing=\"0\" bordercolor=\"#000000\" cellpadding=\"2\" style=\"max-width: 100%; width: 598px;\"><tbody><tr><td style=\"max-width: 100%;\">产品名称</td><td style=\"max-width: 100%;\">Enagic电解还原水机</td><td style=\"max-width: 100%;\">品牌</td><td style=\"max-width: 100%;\">Enagic<br/></td></tr><tr><td style=\"max-width: 100%;\">产品型号</td><td style=\"max-width: 100%;\">SD501</td><td style=\"max-width: 100%;\">产地</td><td style=\"max-width: 100%;\">日本</td></tr><tr><td style=\"max-width: 100%;\">产品特点</td><td style=\"max-width: 100%;\">操作简单、轻小、功能强大</td><td style=\"max-width: 100%;\"><br/></td><td style=\"max-width: 100%;\"><br/></td></tr></tbody></table><p><strong style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/><br/></strong><span style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"></span></p><p></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\"><strong>1.电解槽由7层电解板组成</strong></span><br/><span style=\"line-height: 2;\">电解槽由7层钛镀白金电解板组成，功能强大。能稳定生成ORP由+1130mV至-800mV之电解水(因选择之生成水及自来水而不同)。自来水经电解后，增加了氢氧离子和阳离子，同时产生氢气。</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\"><strong>2.内藏电解促进液箱</strong></span><br/><span style=\"line-height: 2;\">可连续稳定地生成强酸性水、强还原水</span><br/><span style=\"line-height: 2;\">内藏电解促进液箱可方便稳定地连续生成强酸性水、强还原水。注入一次电解促进液(400g)，约可生成20~30公升强酸性水。</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\"><strong>3.大型液晶显示器及声音提示</strong></span><br/><span style=\"line-height: 2;\">操作简单、方便</span><br/><span style=\"line-height: 2;\">清晰大型的液晶显示屏幕和声音提示(生成中的还原水、酸性水、强酸性水、纯净水)，操作简单。</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\">※按下强酸性水按键时，强酸性水从灰色出水管流出，同时强还原水从软式导管流出。</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160516/20160516170019_85693.jpg\" style=\"max-width: 100%; float: left;\"/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><strong><span style=\"font-size: 24px;\">为什么选择Enagic</span></strong><span style=\"font-size: 24px;\"></span></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p><span style=\"font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; line-height: normal; white-space: normal; color: rgb(51, 127, 229); font-size: 14px;\"><strong>使用黄金标准的生产线…</strong></span><span style=\"font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; line-height: normal; white-space: normal; color: rgb(51, 127, 229); font-size: 14px;\"><strong></strong></span><span style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160516/20160516170044_56382.jpg\" style=\"max-width: 100%; float: left;\"/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\">Enagic好自豪可以成为全球其中一个净水及电解水生产商取得由‘水质量协会’(Water Quality Association-WQA, 国际上其中一个历史最悠久及有名的非牟利机构) 发出4张合格证书。‘水质量协会’ 颁授了黄金印章予Enagic，这是一个非常难得的奖项，只会授予最值得信赖及信任之高质量饮用水产品。而Enagic凭着卓越，高质素，谨慎的精神为全球业界定出电解水机的标准。</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/><strong><span style=\"color: rgb(51, 127, 229); line-height: 2; font-size: 14px;\">一台电解还原水机，轻松生成五种水质<strong>…</strong></span></strong></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160516/20160516164636_88515.jpg\" style=\"max-width: 100%; float: left;\"/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p><span style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; line-height: normal; white-space: normal; font-size: 24px;\"><strong>还原水®如何帮助我？</strong></span><span style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"></span></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(229, 102, 0); line-height: 2; font-size: 14px;\"><strong>水的类型重要吗？</strong></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\">当然！</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\">自来水含有污染物。只有碱性pH值的水可以有效清洗体内毒素。</span><br/><span style=\"line-height: 2;\">一个很强的抗氧化及抗炎的碱性pH值水是唯一预防疾病和衰老的途径。</span><br/><br/><img alt=\"\" src=\"http://www.visp.top/photos/visptop/attached/image/20160516/20160516164656_33658.jpg\" style=\"max-width: 100%; float: left;\"/><br/><br/><span style=\"color: rgb(51, 127, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">超级滋润细胞</span><span style=\"line-height: 2;\">（协助重建身体）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 24px;\"><br/></span><span style=\"color: rgb(51, 127, 229); line-height: 2;\">排毒和中和酸性</span><span style=\"line-height: 2;\">（疾病不能存在于碱性身体）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">令人难以置信的抗氧化来源</span><span style=\"line-height: 2;\">（降低身体的衰老过程）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">超强的抗炎性</span><br/><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">排除自由基</span><span style=\"line-height: 2;\">（重建身体“原本状态”）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><span style=\"color: rgb(51, 127, 229);\">恢复正常碱度碱性pH8.5 9.0 9.5</span>&nbsp;</span><span style=\"line-height: 2;\">（改变水的酸性PH值至碱性）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">产生微细的水分子团</span><span style=\"line-height: 2;\">（水更容易被细胞吸收）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">增强营养素的运送</span><br/><span style=\"color: rgb(153, 51, 229); line-height: 2;\"><br/></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229); line-height: 2;\">产生较高的负电位置</span><span style=\"line-height: 2;\">（高效的负氧功能）</span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229);\"><strong>还原水就是如此神奇，他在日本已经受卫生部认同和批准成为医疗设备（相当于日本FDA）</strong></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><span style=\"color: rgb(51, 127, 229);\"><strong><strong><span style=\"line-height: 2;\">把健康带给家人，是我们每一个人的责任</span></strong>，你还等什么？<br/></strong></span></p><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><hr style=\"color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"/><p style=\"list-style: none; margin-top: 0px; margin-bottom: 0px; -webkit-tap-highlight-color: transparent; color: rgb(0, 0, 0); font-family: &#39;Microsoft YaHei&#39;, Helvitica, Verdana, Tohoma, Arial, san-serif; font-size: 12px; line-height: normal; white-space: normal;\"><br/></p><p><br/></p>', '8', '3', '0', '27500.00', '27500.00', '3', '1', '2016-08-20 15:13:48', '2016-08-17 17:19:58');
INSERT INTO `t_product` VALUES ('175', '36', '商品没有套餐，没有分成', 'http://image.visp.info/product/20160818/ab0d8f1b-2634-4df9-9469-ff3a40802647.jpg', '<p>1<br/></p>', '2', '0', '313', '111.00', '33.00', '1', '1', '2016-08-22 10:09:50', '2016-08-18 16:13:38');
INSERT INTO `t_product` VALUES ('176', '38', '商品没有分成，有套餐', 'http://image.visp.info/product/20160818/bddb265d-e49d-4d79-9204-41f1c5abbcb5.jpg', '<p>霜<br/></p>', '9', '2', '2', '33.00', '22.00', '1', '1', '2016-08-22 11:09:23', '2016-08-18 16:14:27');
INSERT INTO `t_product` VALUES ('177', '36', '商品有分成，没有套餐', 'http://image.visp.info/product/20160818/6c261bf6-9808-420e-9a08-85d7076632d0.jpg', '<p>34432<br/></p>', '1', '4', '9', '330.00', '260.00', '1', '1', '2016-08-22 10:29:12', '2016-08-18 16:14:52');
INSERT INTO `t_product` VALUES ('178', '38', '商品五', 'http://image.visp.info/product/20160818/bb9df4a6-6fd9-4cc6-8d7c-7cef0a43bac8.jpg', '<p>44444<br/></p>', '0', '1', '0', '4.00', '3.00', '3', '1', '2016-08-18 18:00:07', '2016-08-18 16:15:18');
INSERT INTO `t_product` VALUES ('179', '38', '商品六', 'http://image.visp.info/product/20160818/05740a52-06df-4e33-a7ae-12c8d1c09c4f.jpg', '<p>3333<br/></p>', '0', '7', '0', '6.00', '4.00', '54', '1', '2016-08-22 17:31:34', '2016-08-18 16:15:44');
INSERT INTO `t_product` VALUES ('180', '38', '33', 'http://image.visp.info/product/20160818/3fd5d76a-185e-4383-b059-0cdd063f0134.jpg', '<p>323<br/></p>', '0', '44', '0', '22.00', '33.00', '11', '1', '2016-08-18 18:00:28', '2016-08-18 16:16:10');
INSERT INTO `t_product` VALUES ('181', '38', '商品有分成，有套餐', 'http://image.visp.info/product/20160818/e1d7cc8e-cbda-4bc0-bfd7-57d1aa92959a.jpg', '<p>33<br/></p>', '0', '9', '1', '700.00', '600.00', '2', '1', '2016-08-22 10:32:45', '2016-08-18 16:17:18');
INSERT INTO `t_product` VALUES ('182', '36', '3', 'http://image.visp.info/product/20160820/658a50ab-e6f8-4187-bc3a-d6e4c733a46d.jpg', '<p>3<br/></p>', '0', '3', '3', '3333.00', '333.00', '3', '1', null, '2016-08-20 17:52:08');

-- ----------------------------
-- Table structure for t_product_category
-- ----------------------------
DROP TABLE IF EXISTS `t_product_category`;
CREATE TABLE `t_product_category` (
  `pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级分类id',
  `pc_img` varchar(255) NOT NULL COMMENT '分类图片',
  `pc_name` varchar(255) NOT NULL COMMENT '分类名',
  `pc_alise` varchar(255) NOT NULL COMMENT '别名',
  `pc_order` int(11) NOT NULL COMMENT '排序 ',
  `pc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1为正常2为禁用',
  PRIMARY KEY (`pc_id`),
  KEY `pc_pid` (`pc_pid`) USING BTREE,
  KEY `pc_status` (`pc_status`) USING BTREE,
  KEY `pc_order` (`pc_order`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='产品分类表';

-- ----------------------------
-- Records of t_product_category
-- ----------------------------
INSERT INTO `t_product_category` VALUES ('36', '0', '', '上善若水', 'water', '1', '1');
INSERT INTO `t_product_category` VALUES ('37', '36', '', '33', '33', '1', '2');
INSERT INTO `t_product_category` VALUES ('38', '0', '', '上善关爱', 'love', '2', '1');

-- ----------------------------
-- Table structure for t_product_pic
-- ----------------------------
DROP TABLE IF EXISTS `t_product_pic`;
CREATE TABLE `t_product_pic` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL COMMENT '商品id',
  `pp_url` varchar(255) NOT NULL COMMENT '图片链接',
  `pp_order` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`pp_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1200 DEFAULT CHARSET=utf8 COMMENT='产品图片列表';

-- ----------------------------
-- Records of t_product_pic
-- ----------------------------
INSERT INTO `t_product_pic` VALUES ('1144', '178', 'http://image.visp.info/product/20160818/93042e80-c38e-44cb-8531-d0d64b6518f3.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1145', '180', 'http://image.visp.info/product/20160818/ba9e23f5-8fde-4e95-a4b1-5374c4fcba60.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1170', '182', 'http://image.visp.info/product/20160820/bcf8140a-60df-4175-bc3f-960de556a117.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1186', '175', 'http://image.visp.info/product/20160818/40a54896-16c7-46cf-a645-a73c75ac5fd3.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1187', '175', 'http://image.visp.info/product/20160819/ad3da613-e7b3-45ff-bc38-51b722393b0a.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1188', '175', 'http://image.visp.info/product/20160819/6a159b0d-48d7-42ff-93b7-b91dfdb701bc.jpg', '1');
INSERT INTO `t_product_pic` VALUES ('1195', '177', 'http://image.visp.info/product/20160818/d404951a-0b5c-491c-96e4-bd7a1b19136c.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1197', '181', 'http://image.visp.info/product/20160818/06bd168f-f8dd-43a2-ab8b-934cbb5641ba.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1198', '176', 'http://image.visp.info/product/20160818/f6b6a92e-10a5-4959-8bc7-14f54a1b0d61.jpg', '0');
INSERT INTO `t_product_pic` VALUES ('1199', '179', 'http://image.visp.info/product/20160822/ea87d809-f0fa-4000-9221-3a74b6e94a51.jpg', '0');

-- ----------------------------
-- Table structure for t_product_profile
-- ----------------------------
DROP TABLE IF EXISTS `t_product_profile`;
CREATE TABLE `t_product_profile` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `pt_id` int(11) DEFAULT '1' COMMENT '套餐类型',
  `pp_name` varchar(255) NOT NULL COMMENT '套餐名称',
  `pp_stock` int(11) NOT NULL COMMENT '库存',
  `pp_sales` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `pp_editTime` datetime NOT NULL COMMENT '修改时间',
  `pp_addTime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`pp_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8 COMMENT='基础套餐配置表';

-- ----------------------------
-- Records of t_product_profile
-- ----------------------------
INSERT INTO `t_product_profile` VALUES ('224', '1', '1', '3', '3', '0', '2016-08-13 15:25:38', '2016-08-13 15:15:37');
INSERT INTO `t_product_profile` VALUES ('226', '1', '2', '44', '44', '0', '2016-08-13 15:25:38', '2016-08-13 15:19:17');
INSERT INTO `t_product_profile` VALUES ('229', '181', '1', '红色', '20', '0', '2016-08-22 10:32:45', '2016-08-18 16:17:18');
INSERT INTO `t_product_profile` VALUES ('230', '181', '1', '黄色', '100', '0', '2016-08-22 10:32:45', '2016-08-18 16:17:18');
INSERT INTO `t_product_profile` VALUES ('231', '181', '2', 's', '100', '0', '2016-08-22 10:32:45', '2016-08-18 16:17:18');
INSERT INTO `t_product_profile` VALUES ('236', '176', '1', '红色', '76', '0', '2016-08-22 11:09:23', '2016-08-18 17:49:29');
INSERT INTO `t_product_profile` VALUES ('243', '182', '1', '3', '3', '0', '2016-08-20 17:52:08', '2016-08-20 17:52:08');
INSERT INTO `t_product_profile` VALUES ('244', '182', '2', '4', '4', '0', '2016-08-20 17:52:08', '2016-08-20 17:52:08');
INSERT INTO `t_product_profile` VALUES ('245', '176', '1', '黑色', '54', '9', '2016-08-22 11:09:23', '2016-08-22 10:16:52');
INSERT INTO `t_product_profile` VALUES ('246', '176', '2', 'L', '46', '6', '2016-08-22 11:09:23', '2016-08-22 10:16:52');
INSERT INTO `t_product_profile` VALUES ('247', '176', '2', 'M', '62', '3', '2016-08-22 11:09:23', '2016-08-22 10:16:53');

-- ----------------------------
-- Table structure for t_profile_type
-- ----------------------------
DROP TABLE IF EXISTS `t_profile_type`;
CREATE TABLE `t_profile_type` (
  `pt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_name` varchar(50) NOT NULL COMMENT '套餐类型名称',
  `pt_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1正常，2禁用',
  `pt_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`pt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='套餐类型表';

-- ----------------------------
-- Records of t_profile_type
-- ----------------------------
INSERT INTO `t_profile_type` VALUES ('1', '颜色', '1', '0000-00-00 00:00:00');
INSERT INTO `t_profile_type` VALUES ('2', '规格', '1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for t_red_pack
-- ----------------------------
DROP TABLE IF EXISTS `t_red_pack`;
CREATE TABLE `t_red_pack` (
  `rp_id` int(11) NOT NULL AUTO_INCREMENT,
  `openID` varchar(100) NOT NULL COMMENT 'openId',
  `rp_amout` decimal(10,2) NOT NULL,
  `rp_order_sn` varchar(50) NOT NULL COMMENT '商户订单号',
  `rp_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '发送状态: 1不成功，2成功',
  `rp_log` text NOT NULL COMMENT '支付日志',
  `rp_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`rp_id`),
  KEY `openID` (`openID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='发送红包日志';

-- ----------------------------
-- Records of t_red_pack
-- ----------------------------
INSERT INTO `t_red_pack` VALUES ('29', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', '1000.00', '1227754902201608231456381', '2', '{\"return_code\":\"SUCCESS\",\"return_msg\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"result_code\":\"FAIL\",\"err_code\":\"CA_ERROR\",\"err_code_des\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"mch_billno\":\"1227754902201608231456381\",\"mch_id\":\"1227754902\",\"wxappid\":\"wx621792d2d29aa578\",\"re_openid\":\"oBp4Jt0jr95a3XzWJci7BKK-sHOk\",\"total_amount\":\"1000\"}', '2016-08-23 14:56:38');
INSERT INTO `t_red_pack` VALUES ('30', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', '1000.00', '1227754902201608231502475', '1', '{\"return_code\":\"SUCCESS\",\"return_msg\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"result_code\":\"FAIL\",\"err_code\":\"CA_ERROR\",\"err_code_des\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"mch_billno\":\"1227754902201608231502475\",\"mch_id\":\"1227754902\",\"wxappid\":\"wx621792d2d29aa578\",\"re_openid\":\"oBp4Jt0jr95a3XzWJci7BKK-sHOk\",\"total_amount\":\"1000\"}', '2016-08-23 15:02:48');
INSERT INTO `t_red_pack` VALUES ('31', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', '1000.00', '1227754902201608231514471', '1', '{\"return_code\":\"SUCCESS\",\"return_msg\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"result_code\":\"FAIL\",\"err_code\":\"CA_ERROR\",\"err_code_des\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"mch_billno\":\"1227754902201608231514471\",\"mch_id\":\"1227754902\",\"wxappid\":\"wx621792d2d29aa578\",\"re_openid\":\"oBp4Jt0jr95a3XzWJci7BKK-sHOk\",\"total_amount\":\"1000\"}', '2016-08-23 15:14:47');
INSERT INTO `t_red_pack` VALUES ('32', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', '1000.00', '1227754902201608231521278', '1', '{\"return_code\":\"SUCCESS\",\"return_msg\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"result_code\":\"FAIL\",\"err_code\":\"CA_ERROR\",\"err_code_des\":\"CA\\u8bc1\\u4e66\\u51fa\\u9519\\uff0c\\u8bf7\\u767b\\u5f55\\u5fae\\u4fe1\\u652f\\u4ed8\\u5546\\u6237\\u5e73\\u53f0\\u4e0b\\u8f7d\\u8bc1\\u4e66\",\"mch_billno\":\"1227754902201608231521278\",\"mch_id\":\"1227754902\",\"wxappid\":\"wx621792d2d29aa578\",\"re_openid\":\"oBp4Jt0jr95a3XzWJci7BKK-sHOk\",\"total_amount\":\"1000\"}', '2016-08-23 15:21:27');

-- ----------------------------
-- Table structure for t_right
-- ----------------------------
DROP TABLE IF EXISTS `t_right`;
CREATE TABLE `t_right` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `m_ids` text NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of t_right
-- ----------------------------
INSERT INTO `t_right` VALUES ('50', '19', '5,14,17,18,19,26,11,22');
INSERT INTO `t_right` VALUES ('51', '18', '2,8');
INSERT INTO `t_right` VALUES ('52', '20', '7');

-- ----------------------------
-- Table structure for t_sales_order
-- ----------------------------
DROP TABLE IF EXISTS `t_sales_order`;
CREATE TABLE `t_sales_order` (
  `so_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL COMMENT '代言人用户ID',
  `so_spokesman` int(11) NOT NULL COMMENT '推广人用户ID',
  `so_order_no` varchar(50) NOT NULL COMMENT '订单号',
  `so_money` decimal(10,2) NOT NULL COMMENT '佣金金额',
  `so_type` tinyint(4) NOT NULL COMMENT '类型:1下单未购买，2下单已购买，3确认收货，4已完成',
  `so_addtime` datetime NOT NULL COMMENT '添加时间',
  `so_updatetime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`so_id`),
  KEY `so_order_no` (`so_order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='分销订单明细';

-- ----------------------------
-- Records of t_sales_order
-- ----------------------------
INSERT INTO `t_sales_order` VALUES ('44', '1', '32', '201608221109312668', '0.44', '3', '2016-08-22 11:09:32', '2016-08-22 11:10:35');
INSERT INTO `t_sales_order` VALUES ('45', '1', '32', '201608221110549522', '2.20', '3', '2016-08-22 11:10:54', '2016-08-22 11:11:20');
INSERT INTO `t_sales_order` VALUES ('47', '32', '1', '201608251455318901', '825.00', '3', '2016-08-25 14:55:31', '2016-08-25 14:56:09');
INSERT INTO `t_sales_order` VALUES ('48', '32', '1', '201608251457420579', '825.00', '2', '2016-08-25 14:57:42', '2016-08-25 14:57:49');
INSERT INTO `t_sales_order` VALUES ('49', '32', '1', '201608251505445508', '825.00', '2', '2016-08-25 15:05:44', '2016-08-25 15:05:56');
INSERT INTO `t_sales_order` VALUES ('50', '32', '1', '201608251508014931', '825.00', '3', '2016-08-25 15:08:01', '2016-08-25 15:08:31');
INSERT INTO `t_sales_order` VALUES ('52', '32', '1', '201608251509562665', '825.00', '3', '2016-08-25 15:09:57', '2016-08-25 15:10:10');

-- ----------------------------
-- Table structure for t_sales_promoter
-- ----------------------------
DROP TABLE IF EXISTS `t_sales_promoter`;
CREATE TABLE `t_sales_promoter` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL COMMENT '代言人用户ID 上家',
  `sp_spokesman` int(11) NOT NULL COMMENT '推广人用户ID :下家ID',
  `sp_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态: 1正常，2解除',
  `sp_addtime` datetime NOT NULL,
  PRIMARY KEY (`sp_id`),
  KEY `m_id` (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='分销推广员表';

-- ----------------------------
-- Records of t_sales_promoter
-- ----------------------------
INSERT INTO `t_sales_promoter` VALUES ('7', '32', '1', '1', '2016-08-20 15:32:50');

-- ----------------------------
-- Table structure for t_weixin_config
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_config`;
CREATE TABLE `t_weixin_config` (
  `wc_id` int(11) NOT NULL AUTO_INCREMENT,
  `wc_appid` varchar(50) NOT NULL COMMENT '微信appid',
  `wc_appsecret` varchar(100) NOT NULL COMMENT '微信appsecret',
  `wc_apptoken` varchar(100) NOT NULL COMMENT '微信token',
  `wc_mch_id` varchar(50) DEFAULT NULL COMMENT '支付密钥',
  `wc_pay_key` varchar(100) DEFAULT NULL COMMENT '商户支付密钥',
  `wc_sslcert_path` varchar(150) DEFAULT NULL COMMENT '证书路径',
  `wc_sslkey_path` varchar(150) DEFAULT NULL COMMENT '证书路径',
  `wc_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`wc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='微信公众号配置';

-- ----------------------------
-- Records of t_weixin_config
-- ----------------------------
INSERT INTO `t_weixin_config` VALUES ('1', 'wx621792d2d29aa578', '12e53fe7ed9766e92e1a1e2ff8b017d2', 'xJ4EPvdb7Pk8bm85y8JN', '1227754902', 'mDIayd5v2laxOSwILoSNQka5nhljs9PW', 'public/cert/apiclient_cert.pem', 'public/cert/apiclient_key.pem', null);

-- ----------------------------
-- Table structure for t_weixin_keywords
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_keywords`;
CREATE TABLE `t_weixin_keywords` (
  `k_id` int(11) NOT NULL AUTO_INCREMENT,
  `k_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `k_keys` varchar(255) DEFAULT NULL COMMENT '关键字',
  `k_type` varchar(255) DEFAULT NULL COMMENT '关键字类型',
  `k_content` text,
  `k_url` varchar(255) DEFAULT NULL COMMENT '跳转链接',
  `k_thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `addtime` datetime DEFAULT NULL,
  `k_status` tinyint(1) DEFAULT '1' COMMENT '状态（-1禁用，1为启用）',
  PRIMARY KEY (`k_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='微信关键字回复';

-- ----------------------------
-- Records of t_weixin_keywords
-- ----------------------------
INSERT INTO `t_weixin_keywords` VALUES ('14', '与可口米饭的相遇', '2', 'news', '<p>当一份历经春、夏、秋三季的大米来到你的面前，请不要辜负它。和爱的人，好好吃上一顿饭。</p>', 'http://mp.weixin.qq.com/s?__biz=MzIxMzE4MDU4Mw==&mid=403004953&idx=1&sn=5a4ddd0abb4a163c78c140195b2a70bd#rd', 'weixin/20160815/d1631575-814f-4ca4-a77b-f914b2937278.jpg', '2016-03-29 17:55:38', '-1');
INSERT INTO `t_weixin_keywords` VALUES ('15', '可米生活智慧社区综合服务平台，改变你的生活', '1', 'news', '我们致力于为社区居民提供高效便捷的品质生活服务。', 'http://property.comylife.com/guide/about', 'weixin/20160329/6b52f4bb-8a07-4c02-ba89-06f87195ed44.jpg', '2016-03-29 17:56:39', '-1');
INSERT INTO `t_weixin_keywords` VALUES ('16', '可米生活 为你放价', '3', 'news', '可米君来美伦浩洋丽都送福利啦！', 'http://property.comylife.com/event/firstpush/index', 'weixin/20160421/b81c9133-bd67-4f5f-9fae-d22cfbec91ea.jpg', '2016-04-21 10:15:51', '1');
INSERT INTO `t_weixin_keywords` VALUES ('17', '可米生活微信公众平台内测开放', '上可米有生活', 'news', '5月17日，可米生活综合服务平台开启内测，乐趣生活抢先体验！', 'http://property.comylife.com/home/index/', 'weixin/20160513/4e2d47d2-8ee0-4cc1-b0f5-7501de89338d.png', '2016-05-13 10:34:45', '-1');
INSERT INTO `t_weixin_keywords` VALUES ('18', '免费住 | 这一晚，住在全球最大房车院子里，看星辰大海', '房车', 'text', '报名已经截至咯~\n可以点击这里回顾活动详情<a href=\"http://mp.weixin.qq.com/s?__biz=MzIxMzE4MDU4Mw==&mid=2651615269&idx=1&sn=7ac63291d9a6deff85cd32abf64b9dc4#rd \">免费住 | 这一晚，住在全球最大房车院子里，看星辰大海</a>\n敬请期待晚上九点的开奖活动吧~', '', 'weixin/20160705/16fcc6ad-a64f-496e-8727-35072a001e3e.jpg', '2016-07-05 17:35:22', '1');
INSERT INTO `t_weixin_keywords` VALUES ('19', 'wonderful', 'wonderful', 'text', '<a href=\"http://m.baidu.com\">wonderful</a>', '', null, '2016-07-05 17:35:52', '-1');
INSERT INTO `t_weixin_keywords` VALUES ('20', '免费吃｜老板没有跑，公司没有倒，就想送你5斤大葡萄', '我要吃葡萄', 'text', '<a href=\"http://mp.weixin.qq.com/s?__biz=MzIxMzE4MDU4Mw==&mid=2651615321&idx=1&sn=36258e3a7462ae11b68e4ca341c80767&scene=0#wechat_redirect\n\">免费吃｜老板没有跑，公司没有倒，就想送你5斤大葡萄</a>活动报名已截止，点击蓝字可回顾活动详情。下一波活动马上来，敬请期待！\n\n', '', null, '2016-07-15 17:23:01', '1');
INSERT INTO `t_weixin_keywords` VALUES ('21', '关爱单身狗 七夕送口粮', '我是单身', 'text', '我知道你是单身啦！\n\n活动<a href=\"http://mp.weixin.qq.com/s?__biz=MzIxMzE4MDU4Mw==&mid=2651615392&idx=1&sn=a5eb34e8618e7e60b0c4756cbb052ccd#rd\">免费送 | 关爱单身狗，七夕送口粮</a>已结束，点击蓝字回顾活动详情~\n\n下一波活动马上就来喔！敬请期待！', '', null, '2016-08-01 14:37:52', '1');
INSERT INTO `t_weixin_keywords` VALUES ('22', 'fdas', '33', 'news', '什么是什么', '33', 'weixin/20160818/a4807ff8-8d0b-4f56-8bce-c9b27acf4a62.jpg', '2016-08-15 15:38:08', '-1');

-- ----------------------------
-- Table structure for t_weixin_log
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_log`;
CREATE TABLE `t_weixin_log` (
  `cl_id` int(11) NOT NULL,
  `cl_openId` varchar(50) NOT NULL COMMENT 'OpenId',
  `cl_type` varchar(10) NOT NULL COMMENT '消息类型',
  `cl_data` text NOT NULL,
  `cl_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信通讯日志';

-- ----------------------------
-- Records of t_weixin_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_weixin_media
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_media`;
CREATE TABLE `t_weixin_media` (
  `wm_id` int(11) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(150) NOT NULL COMMENT 'Open ID',
  `wm_type` tinyint(4) NOT NULL COMMENT '类型:1推广二维码',
  `wm_media_id` varchar(100) NOT NULL COMMENT '临时素材媒体ID',
  `wm_addtime` datetime NOT NULL,
  PRIMARY KEY (`wm_id`),
  KEY `open_id` (`open_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信公众号临时素材';

-- ----------------------------
-- Records of t_weixin_media
-- ----------------------------

-- ----------------------------
-- Table structure for t_weixin_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_menu`;
CREATE TABLE `t_weixin_menu` (
  `wm_id` int(11) NOT NULL AUTO_INCREMENT,
  `wm_pid` int(11) NOT NULL DEFAULT '0',
  `wm_type` varchar(100) DEFAULT NULL COMMENT '菜单事件',
  `wm_key` varchar(100) DEFAULT NULL COMMENT '菜单key',
  `wm_name` varchar(50) NOT NULL COMMENT '菜单名称',
  `wm_status` tinyint(1) DEFAULT '1' COMMENT '1为正常2为禁用',
  `wm_sort` int(11) DEFAULT NULL,
  `wm_addtime` datetime NOT NULL,
  PRIMARY KEY (`wm_id`),
  KEY `wm_pid` (`wm_pid`),
  KEY `wm_sort` (`wm_sort`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='微信菜单';

-- ----------------------------
-- Records of t_weixin_menu
-- ----------------------------
INSERT INTO `t_weixin_menu` VALUES ('1', '0', 'view', 'http://vips.visp.info/', '贵族养生', '1', '1', '2016-08-17 15:04:49');
INSERT INTO `t_weixin_menu` VALUES ('2', '0', '', '', '使用指南', '1', '2', '0000-00-00 00:00:00');
INSERT INTO `t_weixin_menu` VALUES ('3', '0', '', '', '会员中心', '1', '3', '0000-00-00 00:00:00');
INSERT INTO `t_weixin_menu` VALUES ('4', '3', 'click', 'myQrcode', '我的二维码', '1', '3', '2016-08-17 15:33:32');
INSERT INTO `t_weixin_menu` VALUES ('5', '1', 'view', 'http://m.comylife.com', '当季热卖', '2', '1', '0000-00-00 00:00:00');
INSERT INTO `t_weixin_menu` VALUES ('6', '1', 'view', 'http://www.visp.top/m/new.php?id=82', '招商合作', '2', '2', '2016-08-17 17:05:52');
INSERT INTO `t_weixin_menu` VALUES ('7', '3', 'view', 'http://vips.visp.info/mall/order/index/', '订单查询', '1', '1', '2016-08-24 10:54:11');
INSERT INTO `t_weixin_menu` VALUES ('8', '3', 'view', 'http://vips.visp.info/member/member/index/', '会员中心', '1', '2', '2016-08-24 10:54:34');
INSERT INTO `t_weixin_menu` VALUES ('9', '2', 'view', 'http://www.visp.top/purtier/', '产品介绍', '1', '1', '2016-08-24 10:57:09');
INSERT INTO `t_weixin_menu` VALUES ('10', '2', 'view', 'http://vips.visp.info/mall/news/index', '上善资讯', '1', '2', '2016-08-24 10:58:03');

-- ----------------------------
-- Table structure for t_weixin_message
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_message`;
CREATE TABLE `t_weixin_message` (
  `wm_id` int(11) NOT NULL AUTO_INCREMENT,
  `wm_key` varchar(30) NOT NULL COMMENT '键值',
  `wm_title` varchar(100) NOT NULL COMMENT '标题',
  `wm_content` varchar(255) NOT NULL COMMENT '模板内容',
  `wm_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为正常2为禁用',
  `wm_addtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`wm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='微信客服消息';

-- ----------------------------
-- Records of t_weixin_message
-- ----------------------------
INSERT INTO `t_weixin_message` VALUES ('1', 'subscribe_notice', '关注通知', '恭喜您由公众号：【榕城歌剧院】推荐成为第【{mid}】位会员！', '1', '0000-00-00 00:00:00');
INSERT INTO `t_weixin_message` VALUES ('2', 'subscribe_scan_notice', '扫码关注通知', '欢迎【{nickname}】关注榕城歌剧院公众号，如果没有购买门票成为会员，请购买成为会员，创建属于您的榕城歌剧院家族!', '1', '0000-00-00 00:00:00');
INSERT INTO `t_weixin_message` VALUES ('3', 'purchase_order_notice', '购买下单通知', '您的一级代言人【{nickname}】在{datetime}下单，订单号为：{orderNo}；订单金额为：{money}元；您将获得的提成为：{award}元。', '1', '2016-08-18 16:02:05');
INSERT INTO `t_weixin_message` VALUES ('5', 'confirm_order_notice', '确认订单通知', '您的一级代言人【{nickname}】在{datetime}确认消费，订单号为：{orderNo}；订单金额为：{money}元；您将获得的提成为：{award}元。', '1', '2016-08-18 16:05:10');
INSERT INTO `t_weixin_message` VALUES ('8', 'become_promoter_notice', '成为推广人通知', '【{nickname}】通过二维码关注了本公众号，成为了您的一级榕城歌剧院家族成员!', '1', '2016-08-18 16:28:44');

-- ----------------------------
-- Table structure for t_weixin_queue
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_queue`;
CREATE TABLE `t_weixin_queue` (
  `wq_id` int(11) NOT NULL AUTO_INCREMENT,
  `wq_openId` varchar(150) NOT NULL COMMENT 'Open_ID',
  `wq_key` varchar(100) NOT NULL COMMENT '键值',
  `wq_data` text NOT NULL COMMENT '发送的数据',
  `wq_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1未处理，2已经处理',
  `wq_addtime` datetime NOT NULL COMMENT '添加时间',
  `wq_updatetime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`wq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='微信客服消息队列';

-- ----------------------------
-- Records of t_weixin_queue
-- ----------------------------
INSERT INTO `t_weixin_queue` VALUES ('7', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'purchase_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:05:44\",\"orderNo\":\"201608251505445508\",\"money\":27500,\"award\":825}', '2', '2016-08-25 15:05:44', '2016-08-25 15:27:21');
INSERT INTO `t_weixin_queue` VALUES ('9', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'purchase_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:08:02\",\"orderNo\":\"201608251508014931\",\"money\":27500,\"award\":825}', '2', '2016-08-25 15:08:02', '2016-08-25 15:27:56');
INSERT INTO `t_weixin_queue` VALUES ('10', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'payment_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:08:09\",\"orderNo\":\"201608251508014931\",\"money\":\"27500.00\",\"award\":\"825.00\"}', '1', '2016-08-25 15:08:09', null);
INSERT INTO `t_weixin_queue` VALUES ('11', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'confirm_order_notice', '{\"nickname\":\"monyyip\",\"datetime\":\"2016-08-25 15:08:31\",\"orderNo\":\"201608251508014931\",\"money\":\"27500.00\",\"award\":\"825.00\"}', '1', '2016-08-25 15:08:31', null);
INSERT INTO `t_weixin_queue` VALUES ('12', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'purchase_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:09:34\",\"orderNo\":\"201608251509349205\",\"money\":27500,\"award\":825}', '1', '2016-08-25 15:09:34', null);
INSERT INTO `t_weixin_queue` VALUES ('13', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'cancle_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:09:47\",\"orderNo\":\"201608251509349205\"}', '1', '2016-08-25 15:09:47', null);
INSERT INTO `t_weixin_queue` VALUES ('14', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'purchase_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:09:57\",\"orderNo\":\"201608251509562665\",\"money\":27500,\"award\":825}', '1', '2016-08-25 15:09:57', null);
INSERT INTO `t_weixin_queue` VALUES ('15', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'payment_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:10:02\",\"orderNo\":\"201608251509562665\",\"money\":\"27500.00\",\"award\":\"825.00\"}', '1', '2016-08-25 15:10:02', null);
INSERT INTO `t_weixin_queue` VALUES ('16', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'confirm_order_notice', '{\"nickname\":\"\\u83ab\\u5c0f\\u767d\",\"datetime\":\"2016-08-25 15:10:10\",\"orderNo\":\"201608251509562665\",\"money\":\"27500.00\",\"award\":\"825.00\"}', '1', '2016-08-25 15:10:10', null);
INSERT INTO `t_weixin_queue` VALUES ('17', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'express_notice', '{\"title\":\"\\u3010\\u4e0a\\u5584\\u82e5\\u6c34\\u3011 \\u7535\\u89e3\\u8fd8\\u539f\\u6c34\\u673a-\\u9876\\u7ea7\\u4ea7\\u54c1\\u503c\\u5f97\\u4fe1\\u8d56\",\"company\":\"\\u7533\\u901a\\u5feb\\u9012\",\"number\":\"3313253705855\"}', '1', '2016-09-01 15:35:25', null);
INSERT INTO `t_weixin_queue` VALUES ('18', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'deliver_goods_notice', '{\"title\":\"\\u3010\\u4e0a\\u5584\\u82e5\\u6c34\\u3011 \\u7535\\u89e3\\u8fd8\\u539f\\u6c34\\u673a-\\u9876\\u7ea7\\u4ea7\\u54c1\\u503c\\u5f97\\u4fe1\\u8d56\",\"orderNo\":\"201608251505445508\"}', '1', '2016-09-01 15:35:34', null);
INSERT INTO `t_weixin_queue` VALUES ('19', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'express_notice', '{\"title\":\"\\u3010\\u4e0a\\u5584\\u82e5\\u6c34\\u3011 \\u7535\\u89e3\\u8fd8\\u539f\\u6c34\\u673a-\\u9876\\u7ea7\\u4ea7\\u54c1\\u503c\\u5f97\\u4fe1\\u8d56\",\"company\":\"\\u987a\\u4e30\\u5feb\\u9012\",\"number\":\"3313253705855\"}', '1', '2016-09-01 15:41:30', null);
INSERT INTO `t_weixin_queue` VALUES ('20', 'oBp4Jt0jr95a3XzWJci7BKK-sHOk', 'deliver_goods_notice', '{\"title\":\"\\u3010\\u4e0a\\u5584\\u82e5\\u6c34\\u3011 \\u7535\\u89e3\\u8fd8\\u539f\\u6c34\\u673a-\\u9876\\u7ea7\\u4ea7\\u54c1\\u503c\\u5f97\\u4fe1\\u8d56\",\"orderNo\":\"201608251457420579\"}', '1', '2016-09-01 16:36:20', null);

-- ----------------------------
-- Table structure for t_weixin_subscribe
-- ----------------------------
DROP TABLE IF EXISTS `t_weixin_subscribe`;
CREATE TABLE `t_weixin_subscribe` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_cate` tinyint(1) DEFAULT NULL,
  `s_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `s_type` varchar(255) DEFAULT NULL COMMENT '关键字类型',
  `s_content` text,
  `s_url` varchar(255) DEFAULT NULL COMMENT '跳转链接',
  `s_beginTime` datetime DEFAULT NULL COMMENT '开始时间',
  `s_endTime` datetime DEFAULT NULL COMMENT '结束时间',
  `s_thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `addtime` datetime DEFAULT NULL,
  `s_status` tinyint(1) DEFAULT '1' COMMENT '状态（-1禁用，1为启用）',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='微信关注回复';

-- ----------------------------
-- Records of t_weixin_subscribe
-- ----------------------------
INSERT INTO `t_weixin_subscribe` VALUES ('14', '1', '', 'text', '感谢您关注“可米生活”智慧社区综合服务平台！\n足不出户享受便捷物业服务，还能在线购买可米君为您精选的商品和旅游线路。\n\n上可米，有生活！\n', '', '2016-03-30 09:55:00', '2016-03-30 09:55:00', '', '2016-03-30 10:00:35', '1');
INSERT INTO `t_weixin_subscribe` VALUES ('15', '2', '上线预告', 'text', '亲爱的业主：\n感谢您长期以来对我们物业工作的支持和配合，\n为了更好地为大家提供服务，创造更好的生活，\n我们联合可米生活共同推出智慧社区综合服务平台。\n我们将于4月1日正式亮相，届时也将为大家送上见面礼！\n要等我喔~~~\n\n回复【1】我会告诉你平台有哪些服务\n回复【2】我会偷偷告诉你见面礼是什么', 'http://pms.comylife.com', '2016-03-23 10:00:00', '2016-04-01 00:00:00', 'weixin/20160330/02d79bd7-6e92-4706-8ad4-142b1f0802bd.jpg', '2016-03-30 10:02:51', '1');
INSERT INTO `t_weixin_subscribe` VALUES ('16', '2', '', 'news', '[{\"s_title\":\"\\u53ef\\u7c73\\u751f\\u6d3b\\u667a\\u6167\\u793e\\u533a\\u7efc\\u5408\\u670d\\u52a1\\u5e73\\u53f0\\uff0c\\u6539\\u53d8\\u4f60\\u7684\\u751f\\u6d3b\",\"s_url\":\"http:\\/\\/property.comylife.com\\/guide\\/about\",\"s_thumb\":\"weixin\\/20160818\\/2cb4c181-5b33-4112-9e82-fceca8da38c2.jpg\",\"s_order\":\"1\"},{\"s_title\":\"\\u4e0e\\u53ef\\u53e3\\u7c73\\u996d\\u7684\\u76f8\\u9047\",\"s_url\":\"http:\\/\\/mp.weixin.qq.com\\/s?__biz=MzIxMzE4MDU4Mw==&mid=403004953&idx=1&sn=5a4ddd0abb4a163c78c140195b2a70bd#rd\",\"s_thumb\":\"weixin\\/20160818\\/263e1abb-49c0-45d0-988f-467e461d781c.jpg\",\"s_order\":\"2\"}]', '', '2016-04-07 09:30:00', '2016-04-07 09:40:00', '', '2016-04-06 11:35:00', '-1');
INSERT INTO `t_weixin_subscribe` VALUES ('17', '2', '', 'news', '[{\"s_title\":\"\\u53ef\\u7c73\\u751f\\u6d3b \\u4e3a\\u4f60\\u653e\\u4ef7\",\"s_url\":\"http:\\/\\/property.comylife.com\\/event\\/firstpush\\/index\",\"s_thumb\":\"weixin\\/20160818\\/b30fbd27-e529-4283-bad2-a87a01980535.png\",\"s_order\":\"1\"},{\"s_title\":\"\\u53ef\\u7c73\\u751f\\u6d3b\\u667a\\u6167\\u793e\\u533a\\u7efc\\u5408\\u670d\\u52a1\\u5e73\\u53f0\\uff0c\\u6539\\u53d8\\u4f60\\u7684\\u751f\\u6d3b\",\"s_url\":\"http:\\/\\/property.comylife.com\\/guide\\/about\",\"s_thumb\":\"weixin\\/20160818\\/7b7c6a54-f36a-4fb5-9020-fa53164c01d2.jpg\",\"s_order\":\"2\"}]', '', '2016-04-21 17:00:00', '2016-04-21 18:30:00', '', '2016-04-21 17:04:54', '-1');
INSERT INTO `t_weixin_subscribe` VALUES ('18', '2', '', 'text', '感谢您关注“可米生活”智慧社区综合服务平台！\n足不出户享受便捷物业服务，还能在线购买可米君为您精选的商品和旅游线路。\n\n上可米，有生活！\n\n我们正在进行<a href=\"http://mp.weixin.qq.com/s?__biz=MzIxMzE4MDU4Mw==&mid=2651615392&idx=1&sn=a5eb34e8618e7e60b0c4756cbb052ccd#rd\">免费送 | 关爱单身狗，七夕送口粮</a>活动，点击蓝字查看活动详情，期待你的参与，可米君祝你好运！\n', '', '2016-08-01 21:00:00', '2016-08-08 12:00:00', '', '2016-07-15 17:36:51', '1');
INSERT INTO `t_weixin_subscribe` VALUES ('19', '2', '', 'text', '感谢您关注“可米生活”智慧社区综合服务平台！\n足不出户享受便捷物业服务，还能在线购买可米君为您精选的商品和旅游线路。\n\n上可米，有生活！\n\n', '', '2016-07-22 12:00:00', '2016-07-24 21:00:00', '', '2016-07-19 09:19:27', '-1');
INSERT INTO `t_weixin_subscribe` VALUES ('20', '2', '', 'news', '[{\"s_title\":\"44\",\"s_url\":\"44\",\"s_thumb\":\"weixin\\/20160822\\/30847fde-4e60-426f-a851-b0695ac44d07.jpg\",\"s_order\":\"1\"},{\"s_title\":\"3333\",\"s_url\":\"33\",\"s_thumb\":\"weixin\\/20160822\\/eca9a39a-2f99-4808-b8cb-051aa3ce3f2d.jpg\",\"s_order\":\"1\"}]', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2016-08-22 14:24:01', '1');
