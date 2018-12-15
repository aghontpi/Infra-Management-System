-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: management
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(24) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (0,''),(1,'chennai'),(2,'delhi');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_other`
--

DROP TABLE IF EXISTS `device_other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `serial` varchar(30) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `other_info` varchar(200) NOT NULL,
  `used_by` varchar(20) NOT NULL,
  PRIMARY KEY (`device_id`),
  UNIQUE KEY `serial` (`serial`),
  UNIQUE KEY `device_id` (`device_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_other`
--

LOCK TABLES `device_other` WRITE;
/*!40000 ALTER TABLE `device_other` DISABLE KEYS */;
INSERT INTO `device_other` VALUES (6,'02','mouse','mouse_345','iball','max characters can be upto 200, .. anyother info can be provided here','emp_847'),(1,'id_02','Keyboard','keyboard 4533','iball','none','linus');
/*!40000 ALTER TABLE `device_other` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_pc`
--

DROP TABLE IF EXISTS `device_pc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_pc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(20) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `device_serial` varchar(30) NOT NULL,
  `cpu` varchar(20) NOT NULL,
  `ram` varchar(10) NOT NULL,
  `charger_serial_number` varchar(30) NOT NULL,
  `hard_disk_capacity` varchar(10) NOT NULL,
  `model` varchar(20) NOT NULL,
  `os` varchar(20) NOT NULL,
  `used_by` int(11) NOT NULL,
  PRIMARY KEY (`device_id`),
  UNIQUE KEY `device_serial` (`device_serial`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `device_id` (`device_id`),
  UNIQUE KEY `charger_serial_number` (`charger_serial_number`),
  KEY `user_by_fk` (`used_by`),
  CONSTRAINT `user_by_fk` FOREIGN KEY (`used_by`) REFERENCES `device_users` (`device_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_pc`
--

LOCK TABLES `device_pc` WRITE;
/*!40000 ALTER TABLE `device_pc` DISABLE KEYS */;
INSERT INTO `device_pc` VALUES (46,'desktop_01','custom build','dv 3863973','i3 4th Gen','8GB','not applicable','500 GB','custom build','win/linux',0),(19,'id_03','hp','hp 73618','i3 5th Gen','4GB','charger 473','1TB','mid range','win',0),(18,'laptop_02','asus ','asus 3874','i5 7th Gen','4GB','charger 7684','1 TB','asus gaming','win',0),(1,'pc_01','dell','dell 678574853','i5 3rd gen','4GB','dell charger 675','500GB','lattitude E4352','win',4);
/*!40000 ALTER TABLE `device_pc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_users`
--

DROP TABLE IF EXISTS `device_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_users` (
  `device_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `r_branch_id` int(11) NOT NULL,
  PRIMARY KEY (`device_user_id`),
  KEY `device_users_fk` (`r_branch_id`),
  KEY `device_user_id` (`device_user_id`),
  CONSTRAINT `device_users_fk` FOREIGN KEY (`r_branch_id`) REFERENCES `branch` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_users`
--

LOCK TABLES `device_users` WRITE;
/*!40000 ALTER TABLE `device_users` DISABLE KEYS */;
INSERT INTO `device_users` VALUES (0,'',0),(1,'Gopinath',1),(3,'BluePie',1),(4,'frostin',1),(6,'waffle',0);
/*!40000 ALTER TABLE `device_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `pwd` char(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_name`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$mYxAnh8AQb3Mn2Oi0UETmusRJ85ANHRDwfWijJciXn358u9ZYHr.2','2018-12-15 18:17:37',1),(7,'bluepie','$2y$10$YCyXgPaTOUB2rdREhCdvCexNVkU9oq/WazP1BetOYi.j5GHghl2Xu','0000-00-00 00:00:00',1),(2,'gopi','$2y$10$.O2MhcglGlBixD01lu8VX.N.lXyTrYpfKcqFRBVzQl53Y7MXTuNaC','2018-07-06 09:06:35',1),(11,'paarnica','$2y$10$D5Bw6KSXXyLp26DF0PMIMukROzEegYOdefc7Np32EgF.qHpn.B0CW','0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-16  2:02:52
