# MySQL-Front 5.1  (Build 4.13)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: 127.0.0.1    Database: php_banjie
# ------------------------------------------------------
# Server version 5.6.14

#
# Source for table bj_matters
#

DROP TABLE IF EXISTS `bj_matters`;
CREATE TABLE `bj_matters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '事项名称',
  `content` text COLLATE utf8_unicode_ci COMMENT '事项依据',
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '事项类别',
  `duty_user_id` int(11) DEFAULT NULL COMMENT '责任人',
  `duty_department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '责任科室',
  `add_user_id` int(11) DEFAULT NULL COMMENT '事项录入人',
  `handle_date` date DEFAULT NULL COMMENT '办结时限',
  `complete_time` datetime DEFAULT NULL COMMENT '实际办结时间',
  `complete_user_id` int(11) DEFAULT NULL COMMENT '实际办结确认人',
  `add_time` datetime DEFAULT NULL COMMENT '录入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Dumping data for table bj_matters
#

LOCK TABLES `bj_matters` WRITE;
/*!40000 ALTER TABLE `bj_matters` DISABLE KEYS */;
INSERT INTO `bj_matters` VALUES (16,'测试：aaa','sdfsf','有关单位来文来电商办事项',17,'合作处',18,'2014-02-24','2014-03-05 14:21:08',17,'2014-02-21 10:46:41');
INSERT INTO `bj_matters` VALUES (17,'测试:bbb','sfsfsf','办重要文件决定事项',17,'区域处',18,'2014-02-21','2014-03-05 14:21:03',17,'2014-02-21 10:47:39');
INSERT INTO `bj_matters` VALUES (18,'测试：2-25','','办重要会议决定事项',17,'联络处',18,'2014-02-25','2014-03-05 14:20:56',17,'2014-02-21 10:48:17');
INSERT INTO `bj_matters` VALUES (19,'测试：2-26','','省领导批示事项',17,'联络处',18,'2014-02-26','2014-03-05 14:20:45',17,'2014-02-21 10:48:39');
INSERT INTO `bj_matters` VALUES (20,'会议','','上级机关来文来电交办事项',4,'综合处',4,'2014-03-08',NULL,0,'2014-03-05 14:17:32');
INSERT INTO `bj_matters` VALUES (21,'通知测试','','上级机关来文来电交办事项',4,'综合处',4,'2014-03-09',NULL,0,'2014-03-05 14:18:19');
INSERT INTO `bj_matters` VALUES (22,'督办系统测试','','办领导批示事项',5,'综合处',4,'2014-03-09',NULL,0,'2014-03-05 14:19:20');
INSERT INTO `bj_matters` VALUES (26,'关于抓紧上报测试数据的工作——（2014办件77号）','','上级机关来文来电交办事项',4,'综合处',4,'2014-03-11',NULL,0,'2014-03-06 10:39:57');
INSERT INTO `bj_matters` VALUES (27,'关于抓紧时间开始督办软件测试工作的通知——2014经合督办1号','测试','办领导批示事项',5,'综合处',4,'2014-03-10',NULL,0,'2014-03-06 10:41:52');
INSERT INTO `bj_matters` VALUES (28,'关于抓紧时间进行督办软件测试工作的通知——2014经合督办1号','','办领导批示事项',5,'综合处',4,'2014-03-10',NULL,0,'2014-03-06 10:43:35');
INSERT INTO `bj_matters` VALUES (29,'关于抓紧办理2014办件73号的通知（内网办件）','','上级机关来文来电交办事项',5,'综合处',4,'2014-03-10',NULL,0,'2014-03-06 10:46:45');
INSERT INTO `bj_matters` VALUES (30,'关于抓紧办理2014办件73号的通知（内网办件）','','上级机关来文来电交办事项',4,'综合处',4,'2014-03-10',NULL,0,'2014-03-06 10:53:01');
INSERT INTO `bj_matters` VALUES (31,'关于抓紧办理2014办件100号的通知（内网办件）','','上级机关来文来电交办事项',4,'综合处',4,'2014-03-11',NULL,0,'2014-03-06 10:53:51');
/*!40000 ALTER TABLE `bj_matters` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table bj_send_log
#

DROP TABLE IF EXISTS `bj_send_log`;
CREATE TABLE `bj_send_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matter_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `msg` varchar(250) DEFAULT NULL,
  `send_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

#
# Dumping data for table bj_send_log
#

LOCK TABLES `bj_send_log` WRITE;
/*!40000 ALTER TABLE `bj_send_log` DISABLE KEYS */;
INSERT INTO `bj_send_log` VALUES (21,17,17,'15658006351','办理提醒','2014-02-21 10:47:39');
INSERT INTO `bj_send_log` VALUES (22,18,17,'15658006351','待办','2014-02-21 10:50:46');
INSERT INTO `bj_send_log` VALUES (23,17,17,'15658006351','待办','2014-02-21 10:50:46');
INSERT INTO `bj_send_log` VALUES (24,17,18,'13818361965','创建人到期预警','2014-02-21 10:50:47');
INSERT INTO `bj_send_log` VALUES (25,16,17,'15658006351','待办','2014-02-21 10:50:47');
INSERT INTO `bj_send_log` VALUES (26,19,17,'15658006351','待办','2014-02-28 12:38:30');
INSERT INTO `bj_send_log` VALUES (27,18,17,'15658006351','待办','2014-02-28 12:38:30');
INSERT INTO `bj_send_log` VALUES (28,17,17,'15658006351','待办','2014-02-28 12:38:30');
INSERT INTO `bj_send_log` VALUES (29,16,17,'15658006351','待办','2014-02-28 12:38:30');
INSERT INTO `bj_send_log` VALUES (30,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:07:53');
INSERT INTO `bj_send_log` VALUES (31,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:08:24');
INSERT INTO `bj_send_log` VALUES (32,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:08:41');
INSERT INTO `bj_send_log` VALUES (33,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:08:47');
INSERT INTO `bj_send_log` VALUES (34,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:08:52');
INSERT INTO `bj_send_log` VALUES (35,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:08:56');
INSERT INTO `bj_send_log` VALUES (36,19,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:09:02');
INSERT INTO `bj_send_log` VALUES (37,18,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:09:03');
INSERT INTO `bj_send_log` VALUES (38,17,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:09:03');
INSERT INTO `bj_send_log` VALUES (39,16,17,'15658006351','您还有待办事项未处理,请及时处理！','2014-02-28 13:09:03');
INSERT INTO `bj_send_log` VALUES (40,19,17,'15658006351','您有待办事项“测试：2-26”,请及时处理！','2014-02-28 13:26:52');
INSERT INTO `bj_send_log` VALUES (41,18,17,'15658006351','您有待办事项“测试：2-25”,请及时处理！','2014-02-28 13:26:52');
INSERT INTO `bj_send_log` VALUES (42,17,17,'15658006351','您有待办事项“测试:bbb”,请及时处理！','2014-02-28 13:26:52');
INSERT INTO `bj_send_log` VALUES (43,16,17,'15658006351','您有待办事项“测试：aaa”,请及时处理！','2014-02-28 13:26:53');
INSERT INTO `bj_send_log` VALUES (44,19,17,'15658006351','您有待办事项“测试：2-26”,请及时处理！','2014-02-28 13:27:01');
INSERT INTO `bj_send_log` VALUES (45,18,17,'15658006351','您有待办事项“测试：2-25”,请及时处理！','2014-02-28 13:27:01');
INSERT INTO `bj_send_log` VALUES (46,17,17,'15658006351','您有待办事项“测试:bbb”,请及时处理！','2014-02-28 13:27:02');
INSERT INTO `bj_send_log` VALUES (47,16,17,'15658006351','您有待办事项“测试：aaa”,请及时处理！','2014-02-28 13:27:02');
INSERT INTO `bj_send_log` VALUES (48,19,17,'15658006351','您有待办事项“测试：2-26”,请及时处理！','2014-02-28 13:29:31');
INSERT INTO `bj_send_log` VALUES (49,18,17,'15658006351','您有待办事项“测试：2-25”,请及时处理！','2014-02-28 13:29:31');
INSERT INTO `bj_send_log` VALUES (50,17,17,'15658006351','您有待办事项“测试:bbb”,请及时处理！','2014-02-28 13:29:31');
INSERT INTO `bj_send_log` VALUES (51,16,17,'15658006351','您有待办事项“测试：aaa”,请及时处理！','2014-02-28 13:29:32');
INSERT INTO `bj_send_log` VALUES (52,19,17,'15658006351','您有待办事项“测试：2-26”,请及时处理！','2014-03-05 14:18:52');
INSERT INTO `bj_send_log` VALUES (53,18,17,'15658006351','您有待办事项“测试：2-25”,请及时处理！','2014-03-05 14:18:53');
INSERT INTO `bj_send_log` VALUES (54,17,17,'15658006351','您有待办事项“测试:bbb”,请及时处理！','2014-03-05 14:18:53');
INSERT INTO `bj_send_log` VALUES (55,16,17,'15658006351','您有待办事项“测试：aaa”,请及时处理！','2014-03-05 14:18:53');
INSERT INTO `bj_send_log` VALUES (56,20,4,'13505719286','您有待办事项“会议”,请及时处理！','2014-03-06 08:59:04');
INSERT INTO `bj_send_log` VALUES (57,21,4,'13505719286','您有待办事项“通知测试”,请及时处理！','2014-03-06 08:59:04');
INSERT INTO `bj_send_log` VALUES (58,22,5,'13958199677','您有待办事项“督办系统测试”,请及时处理！','2014-03-06 08:59:04');
INSERT INTO `bj_send_log` VALUES (59,20,4,'13505719286','您有待办事项“会议”,请及时处理！','2014-03-07 08:59:48');
INSERT INTO `bj_send_log` VALUES (60,21,4,'13505719286','您有待办事项“通知测试”,请及时处理！','2014-03-07 08:59:48');
INSERT INTO `bj_send_log` VALUES (61,22,5,'13958199677','您有待办事项“督办系统测试”,请及时处理！','2014-03-07 08:59:48');
INSERT INTO `bj_send_log` VALUES (62,23,21,'13735574142','您有待办事项“关于上报会议的通知”,请及时处理！','2014-03-07 08:59:48');
INSERT INTO `bj_send_log` VALUES (63,26,4,'13505719286','您有待办事项“关于抓紧上报测试数据的工作——（2014办件77号）”,请及时处理！','2014-03-07 08:59:49');
INSERT INTO `bj_send_log` VALUES (64,25,21,'13735574142','您有待办事项“上报有关数据”,请及时处理！','2014-03-07 08:59:49');
INSERT INTO `bj_send_log` VALUES (65,27,5,'13958199677','您有待办事项“关于抓紧时间开始督办软件测试工作的通知——2014经合督办1号”,请及时处理！','2014-03-07 08:59:49');
INSERT INTO `bj_send_log` VALUES (66,28,5,'13958199677','您有待办事项“关于抓紧时间进行督办软件测试工作的通知——2014经合督办1号”,请及时处理！','2014-03-07 08:59:49');
INSERT INTO `bj_send_log` VALUES (67,29,5,'13958199677','您有待办事项“关于抓紧办理2014办件73号的通知（内网办件）”,请及时处理！','2014-03-07 08:59:49');
INSERT INTO `bj_send_log` VALUES (68,30,4,'13505719286','您有待办事项“关于抓紧办理2014办件73号的通知（内网办件）”,请及时处理！','2014-03-07 08:59:50');
INSERT INTO `bj_send_log` VALUES (69,31,4,'13505719286','您有待办事项“关于抓紧办理2014办件100号的通知（内网办件）”,请及时处理！','2014-03-07 08:59:50');
/*!40000 ALTER TABLE `bj_send_log` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table bj_user
#

DROP TABLE IF EXISTS `bj_user`;
CREATE TABLE `bj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号码',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `is_deleted` int(3) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `upd_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Dumping data for table bj_user
#

LOCK TABLES `bj_user` WRITE;
/*!40000 ALTER TABLE `bj_user` DISABLE KEYS */;
INSERT INTO `bj_user` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','13813433411',1,NULL,NULL,0,'2013-11-30 15:04:37');
INSERT INTO `bj_user` VALUES (2,'林炜','e10adc3949ba59abbe56e057f20f883e','18805711246',0,NULL,NULL,0,'2013-11-30 14:52:02');
INSERT INTO `bj_user` VALUES (3,'丛静芳','e10adc3949ba59abbe56e057f20f883e','13588070588',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (4,'王强','e10adc3949ba59abbe56e057f20f883e','13505719286',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (5,'潘锡忠','e10adc3949ba59abbe56e057f20f883e','13958199677',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (6,'陈国良','e10adc3949ba59abbe56e057f20f883e','13958029639',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (7,'崔向科','e10adc3949ba59abbe56e057f20f883e','13989816958',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (8,'吴永平','e10adc3949ba59abbe56e057f20f883e','13857132233',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (9,'刘金良','e10adc3949ba59abbe56e057f20f883e','13958163481',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (10,'方小平','e10adc3949ba59abbe56e057f20f883e','13305715083',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (11,'韩海祥','e10adc3949ba59abbe56e057f20f883e','13306536582',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (12,'赵黎','e10adc3949ba59abbe56e057f20f883e','13205812345',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (13,'叶建军','e10adc3949ba59abbe56e057f20f883e','18657105070',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (14,'盛金根','e10adc3949ba59abbe56e057f20f883e','15990136973',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (15,'潘金明','e10adc3949ba59abbe56e057f20f883e','13185710528',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (16,'张嵘','e10adc3949ba59abbe56e057f20f883e','13757155225',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (17,'测试：李仲春','e10adc3949ba59abbe56e057f20f883e','15658006351',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (18,'测试：开发','e10adc3949ba59abbe56e057f20f883e','13818361965',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (19,'sdfdsf','106bc714c038b1dd6954dba7049b59e4','1231312313',0,NULL,NULL,1,NULL);
INSERT INTO `bj_user` VALUES (20,'杭州处长','d7322ed717dedf1eb4e6e52a37ea7bcd','13306536653',0,NULL,NULL,1,NULL);
INSERT INTO `bj_user` VALUES (21,'钱波','79b4425cb1e1a301c1175e87dc055b38','13735574142',0,NULL,NULL,0,NULL);
INSERT INTO `bj_user` VALUES (22,'杭州周华','d7322ed717dedf1eb4e6e52a37ea7bcd','13306536653',0,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `bj_user` ENABLE KEYS */;
UNLOCK TABLES;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
