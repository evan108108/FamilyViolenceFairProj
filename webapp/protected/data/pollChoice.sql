-- MySQL dump 10.13  Distrib 5.1.48, for apple-darwin10.3.0 (i386)
--
-- Host: localhost    Database: fvfp
-- ------------------------------------------------------
-- Server version	5.1.48

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
-- Table structure for table `poll_choice`
--

DROP TABLE IF EXISTS `poll_choice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_choice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) unsigned NOT NULL,
  `label` varchar(255) NOT NULL DEFAULT '',
  `votes` int(11) unsigned NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `right_answer` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `choice_poll` (`poll_id`),
  CONSTRAINT `choice_poll` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_choice`
--

LOCK TABLES `poll_choice` WRITE;
/*!40000 ALTER TABLE `poll_choice` DISABLE KEYS */;
INSERT INTO `poll_choice` VALUES (1,1,'Victim’s level of fear',0,1,0),(2,1,'History of choking partner',0,2,0),(3,2,'Borderline Personality Disorder',0,1,0),(4,2,'PTSD',0,2,0),(5,1,'Ready access to weapons',0,3,0),(6,1,'All of the above',0,4,1),(7,2,'Depression',0,3,1),(8,2,'Antisocial Personality Disorder',0,4,0),(9,3,'True',0,1,1),(10,3,'False',0,2,0),(11,4,'Antisocial personality disorder',0,1,0),(12,4,'Bipolar Disorder',0,2,0),(13,4,'Substance abuse',0,3,1),(14,4,'Schizophrenia',0,4,0),(15,5,'True',04,1,1),(16,5,'False',0,2,0),(17,6,'Valentine\'s Day ',0,1,0),(18,6,'St. Patrick\'s Day',0,2,0),(19,6,'Christmas Day',0,3,0),(20,6,'Super Bowl Sunday',0,4,1),(21,7,'True',0,1,1),(22,7,'False',0,2,0),(23,8,'True',0,1,1),(24,8,'False',0,2,0),(25,9,'True',0,1,1),(26,9,'False',0,2,0),(27,10,'Poorly educated and have low paying jobs',0,1,0),(28,10,'Attitudes inhibiting seeking of social support',0,2,1),(29,10,'Socio-economic background (i.e. education, poverty)',0,3,0),(30,10,'HIV/STI risk behaviors',0,4,0),(31,11,'Power imbalance and inequality when making sex-related decisions',0,1,0),(32,11,'Attitudes inhibiting seeking of social support',0,2,0),(33,11,'Socio-economic background (i.e. education, poverty)',0,3,1),(34,11,'HIV/STI risk behaviors',0,4,0),(35,12,'Secure attachment',0,1,0),(36,12,'Avoidant attachment',0,2,0),(37,12,'Anxious-Ambivalent',0,3,0),(38,12,'Disorganized',0,4,0),(39,12,'Any one of the three insecure attachment styles.',0,5,1);
/*!40000 ALTER TABLE `poll_choice` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-27 11:03:17
