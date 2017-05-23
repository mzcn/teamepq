# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `creater_user_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `project_id`, `task_id`, `description`, `creater_user_id`, `created`, `modified`)
VALUES
	(1,2,1,'starting task','1','2015-12-02 16:43:29',NULL),
	(2,2,1,'pendding','1','2015-12-02 17:06:02',NULL),
	(3,2,1,'completed','1','2015-12-02 17:11:16',NULL);

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`)
VALUES
	(9,'策划'),
	(10,'研发'),
	(11,'设计'),
	(12,'行政'),
	(13,'人事'),
	(14,'工程'),
	(15,'销售');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table levels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `levels`;

CREATE TABLE `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;

INSERT INTO `levels` (`id`, `name`, `color`)
VALUES
	(1,'??','danger'),
	(2,'2','warning'),
	(3,'3','dark'),
	(4,'4','primary');

/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(20) NOT NULL,
  `menu_name` varchar(20) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `menu_id`, `menu_name`, `remark`)
VALUES
	(1,'projects','项目管理','项目管理'),
	(2,'maintasks','主任务管理','主任务管理'),
	(3,'subtasks','子任务管理','子任务管理'),
	(4,'reports','报表中心','报表中心'),
	(5,'params','工作系数','工作系数'),
	(6,'departments','部门管理','部门管理'),
	(7,'roles','权限管理','权限管理'),
	(8,'users','用户管理','用户管理');

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table params
# ------------------------------------------------------------

DROP TABLE IF EXISTS `params`;

CREATE TABLE `params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `value` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `params` WRITE;
/*!40000 ALTER TABLE `params` DISABLE KEYS */;

INSERT INTO `params` (`id`, `from`, `to`, `value`)
VALUES
	(1,6000,9000,0.5),
	(2,8000,15000,0.8),
	(3,15000,20000,1),
	(4,20000,NULL,1.2);

/*!40000 ALTER TABLE `params` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `keywords` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `work` int(11) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `level_id` int(11) NOT NULL DEFAULT '2',
  `company_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `owner_user_id` int(11) NOT NULL,
  `creater_user_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `num`, `name`, `description`, `price`, `keywords`, `work`, `note`, `level_id`, `company_id`, `start_date`, `delivery_date`, `status`, `owner_user_id`, `creater_user_id`, `created`, `modified`)
VALUES
	(12,'PJ000001','测试项目','包含重音\r\nautocomplete 域使用自定义的 source 选项来匹配带有重音字符的结果项，即使文本域不包含重音字符也会匹配。但是如果您在文本域中键入了重音字符，则不会显示非重音的结果项。\r\n尝试键入 \"Jo\"，会看到 \"John\" 和 \"Jörn\"，然后 键入 \"Jö\"，只会看到 \"Jörn\"。\r\n<!doctype html>\r\n<html lang=\"en\">\r\n<head>\r\n  <meta charset=\"utf-8\">\r\n  <title>jQuery UI 自动完成（Autocomplete） - 包含重音</title>\r\n  <link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css\">\r\n  <script src=\"//code.jquery.com/jquery-1.9.1.js\"></script>\r\n  <script src=\"//code.jquery.com/ui/1.10.4/jquery-ui.js\"></script>\r\n  <link rel=\"stylesheet\" href=\"http://jqueryui.com/resources/demos/style.css\">\r\n  <script>\r\n  $(function() {\r\n    var names = [ \"Jörn Zaefferer\", \"Scott González\", \"John Resig\" ];\r\n \r\n    var accentMap = {\r\n      \"á\": \"a\",\r\n      \"ö\": \"o\"\r\n    };\r\n    var normalize = function( term ) {\r\n      var ret = \"\";\r\n      for ( var i = 0; i < term.length; i++ ) {\r\n        ret += accentMap[ term.charAt(i) ] || term.charAt(i);\r\n      }\r\n      return ret;\r\n    };','','',0,NULL,2,0,'2016-02-16','2016-02-29','启动',2,'2','2016-02-16 09:19:03','2016-02-16 09:19:03');

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `rights` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `remark`, `rights`)
VALUES
	(1,'超级管理员','超级管理员','projects,maintasks,subtasks,reports,params,departments,roles,users,'),
	(2,'管理员','阿斯蒂芬飞','params,departments,roles,users,'),
	(3,'项目负责人','','projects,maintasks,subtasks,reports,'),
	(4,'普通组员','','subtasks,'),
	(5,'人事','','reports,params,');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id`, `name`)
VALUES
	(1,'未开始'),
	(2,'进行中'),
	(3,'已完成');

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目id',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '????',
  `work` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '????',
  `level` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '????',
  `server` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `report_user_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `owner_user_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `estimate_hours` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `status` varchar(255) CHARACTER SET utf8 DEFAULT '1' COMMENT '????',
  `rank` int(1) DEFAULT '1' COMMENT '1为主任务,2为子任务',
  `price` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0' COMMENT '子任务对应的父任务',
  `group_id` int(11) DEFAULT NULL,
  `percent` int(5) DEFAULT NULL,
  `cow` float DEFAULT NULL,
  `progress` int(11) DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `project_id`, `name`, `work`, `level`, `server`, `report_user_id`, `owner_user_id`, `estimate_hours`, `description`, `status`, `rank`, `price`, `parent_id`, `group_id`, `percent`, `cow`, `progress`, `start_time`, `end_time`, `delivery_date`, `created`, `modified`)
VALUES
	(37,12,'主要任务',NULL,'1',NULL,NULL,'3',NULL,'下次 v','2',1,9000,0,9,NULL,0.5,50,NULL,NULL,NULL,'2016-02-16 09:19:46','2016-02-16 09:19:46'),
	(38,12,'测试小','1','1','172.18.10.1','2','2','8','阿斯顿发','3',2,NULL,37,10,50,NULL,0,'2016-02-16 16:21:01','2016-02-16 16:21:03','2016-02-17','2016-02-16 09:20:37','2016-02-16 09:20:37');

/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL DEFAULT NULL,
  `role_id` int(11) DEFAULT '1',
  `group_id` int(11) DEFAULT '1',
  `is_leader` int(1) DEFAULT '0',
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT '',
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `token`, `active`, `created`, `role_id`, `group_id`, `is_leader`, `phone`, `email`, `modified`)
VALUES
	(2,'jean','张鸿丽','96e79218965eb72c92a549dd5a330112',NULL,1,'2015-12-22 04:55:04',1,10,1,'14','22658481@qq.com','2016-01-18 14:47:21'),
	(3,'lizhi','lizhi','96e79218965eb72c92a549dd5a330112',NULL,1,'2015-12-22 09:39:35',4,9,1,'','','2016-02-16 09:22:15'),
	(6,'admin','admin','21232f297a57a5a743894a0e4a801fc3',NULL,1,'0000-00-00 00:00:00',2,0,0,'','','2016-01-18 16:04:36'),
	(7,'test','二师兄','e10adc3949ba59abbe56e057f20f883e',NULL,1,'0000-00-00 00:00:00',4,11,1,'','','2016-01-18 16:04:50'),
	(8,'ljj','李俊杰','e99a18c428cb38d5f260853678922e03',NULL,0,'0000-00-00 00:00:00',3,9,1,'','','2016-02-04 17:15:08');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
