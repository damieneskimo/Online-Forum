# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: online_forum
# Generation Time: 2016-06-17 02:35:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(121) NOT NULL DEFAULT '',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;

INSERT INTO `brands` (`id`, `name`, `description`)
VALUES
	(1,'Maori Language Learning Community','Maori Language Learning Community is the place for everyone who is interested in learning Maori. A guest can only read and browse the content on the forum. If the guest wants to post a thread or comment on other\'s thread, he/she has to sign up or log in if he/she has an account. Please join us, if you want to learn Maori more efficiently.');

/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table replies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `replies`;

CREATE TABLE `replies` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int(6) unsigned DEFAULT NULL,
  `topic_id` int(6) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `replies` WRITE;
/*!40000 ALTER TABLE `replies` DISABLE KEYS */;

INSERT INTO `replies` (`id`, `content`, `user_id`, `topic_id`, `created_on`)
VALUES
	(1,'what is that?',2,1,'2016-04-28 15:35:22'),
	(2,'ahhah   very good ',2,1,'2016-06-13 14:35:42'),
	(14,'fdsafsffsdfsdf',1,1,'2016-06-15 22:57:07'),
	(15,'fdsafsdfdddrrrrrdddddd',1,1,'2016-06-16 09:22:10'),
	(16,'dfasdrrrr',1,1,'2016-06-16 10:03:43'),
	(17,'fsdaf',1,1,'2016-06-16 10:05:06'),
	(22,'fdf',2,42,'2016-06-16 10:31:44'),
	(23,'fdfd',2,42,'2016-06-16 10:31:47'),
	(24,'dsafsfsd',2,42,'2016-06-16 10:31:52'),
	(25,'fsdfds',2,43,'2016-06-16 10:40:01'),
	(27,'fsdafdsfsdf',1,1,'2016-06-16 12:10:08'),
	(29,'fdfdfdfdfdfdf',1,1,'2016-06-16 12:10:43'),
	(30,'fdsfsdaffffffff',2,1,'2016-06-16 12:13:35'),
	(31,'fsdafsadf',2,1,'2016-06-16 12:17:03'),
	(32,'fdfdfdfd',2,1,'2016-06-16 12:17:10'),
	(33,'fdfasfdsaf',2,47,'2016-06-16 12:31:09'),
	(34,'fdsfasdfsa',1,48,'2016-06-16 12:31:46'),
	(35,'fasdfsaf',1,3,'2016-06-16 12:38:43'),
	(36,'fdfsafsdf',2,5,'2016-06-16 14:19:17'),
	(37,'fdsfadfdfdffdfdsfsaf',2,1,'2016-06-16 16:24:11');

/*!40000 ALTER TABLE `replies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table topics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `topics`;

CREATE TABLE `topics` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(6) unsigned DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;

INSERT INTO `topics` (`id`, `title`, `content`, `user_id`, `created_on`)
VALUES
	(1,'what is that please? please','this is a test...\r\n\r\nthis is a test',1,'2016-06-16 23:23:46'),
	(3,'test two','this is a test...',1,'2016-04-28 15:44:37'),
	(4,'test three','this is a test...',1,'2016-04-28 15:45:02'),
	(5,'test four','this is a test...',1,'2016-04-28 15:45:16'),
	(8,'fdsf','fsdfs',1,'2016-06-13 16:50:04'),
	(9,'fdf','fdsf',1,'2016-06-13 16:50:09'),
	(11,'fdf','fdsf',1,'2016-06-13 16:51:26'),
	(12,'fdf','fdsf',1,'2016-06-13 16:51:29'),
	(13,'fdf','fdsf',1,'2016-06-13 16:51:50'),
	(16,'fdf','fdsf',1,'2016-06-13 16:52:36'),
	(17,'fdf','fdsf',1,'2016-06-13 16:52:44'),
	(18,'fsdfasdf','fdsfasf',1,'2016-06-13 16:54:30'),
	(19,'fsdfasdf','fdsfasf',1,'2016-06-13 16:57:14'),
	(20,'fsdfasdf','fdsfasf',1,'2016-06-13 16:57:14'),
	(21,'fsdfasdf','fdsfasf',1,'2016-06-13 16:57:14'),
	(22,'fsdfasdf','fdsfasf',1,'2016-06-13 16:57:14'),
	(23,'fsdfasdf','fdsfasf',1,'2016-06-13 16:57:14'),
	(24,'fsdfasdf','fdsfasf',1,'2016-06-13 16:57:14'),
	(25,'fdsfas','fdsaf',1,'2016-06-13 17:26:02'),
	(26,'new ','new',1,'2016-06-13 17:26:15'),
	(27,'new ','new',1,'2016-06-15 13:37:30'),
	(28,'fsdf','fsdfas',1,'0000-00-00 00:00:00'),
	(29,'fdf','fdsffdsfs',1,'2016-06-15 14:10:08'),
	(30,'fdfsafsd','fdsafdsa',1,'2016-06-15 14:12:45'),
	(31,'new topic ','new ',1,'2016-06-15 14:17:50'),
	(32,'fdsf','fdsf',1,'2016-06-15 14:20:57'),
	(33,'fdsf','fdsfs',1,'2016-06-15 14:24:03'),
	(34,'fds','fdsafdf',1,'2016-06-15 14:26:42'),
	(36,'what is that please?','this is a test...',1,'2016-06-15 14:47:12'),
	(37,'fdfdsa','fsdafas',1,'2016-06-16 10:20:02'),
	(38,'new ','new ',1,'2016-06-16 10:22:36'),
	(40,'new','new topic',2,'2016-06-16 12:07:46'),
	(41,'dfds','fdsaf',2,'2016-06-16 10:30:27'),
	(42,'fdfd','fdsa',2,'2016-06-16 10:30:51'),
	(43,'fdsfa','fdsfs',2,'2016-06-16 10:38:35'),
	(44,'fdfd','fdsafs',2,'2016-06-16 10:40:23'),
	(46,'ff','fdsfas',2,'2016-06-16 12:27:39'),
	(47,'fdfd','fasdf',2,'2016-06-16 12:30:36'),
	(48,'fdsafsd','fasfdsaf',1,'2016-06-16 12:31:35'),
	(49,'fdsfasd','fsdafasf',1,'2016-06-16 12:32:02'),
	(50,'fsdaf','fsdafsf',2,'2016-06-16 16:23:27');

/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(50) DEFAULT NULL,
  `contribution` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `created_on`, `password`, `contribution`)
VALUES
	(1,'Darren','darren@test.com','2016-06-16 10:23:14','1234',12),
	(2,'Damien','damien@test.com','2016-04-28 15:29:28','1234',9);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
