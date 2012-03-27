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
-- Table structure for table `poll`
--

DROP TABLE IF EXISTS `poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll`
--

LOCK TABLES `poll` WRITE;
/*!40000 ALTER TABLE `poll` DISABLE KEYS */;
INSERT INTO `poll` VALUES (1,'Which of the following risk factors are related to lethal intimate partner violence:','Research has demonstrated that the victim’s level of fear (related to male to female aggression) increases as the severity of abuse increases. Ready access to weapons in the home and any history of choking or strangulation of the partner has been associated with lethal intimate partner violence. ',1),(2,'Which of the following psychiatric disorders has been linked to severity of abuse perpetuation in BOTH MEN AND WOMEN?','Out of all the disorders, depression has been found in both male and female perpetuators of intimate partner violence. ',1),(3,'True or false? There is a strong relationship between growing up in a violent home and perpetuating intimate partner violence for males.','This is sometimes referred as the intergenerational transmission of violence. Violence can become a normalized and accepted expression of behavior in individuals growing up in violent home.  ',1),(4,'Across the board, __________ has been related to intimate partner victimization and perpetuation in both heterosexual and same-sex relationships:','Substance abuse is a significant risk factor for intimate partner violence in both straight and same-sex couples. ',1),(5,'True or false? Women are just as likely as men to engage in intimate partner violence, including physical aggression.','Countless representative studies have demonstrated that women are just as likely as men to engage in intimate partner violence, including physical aggression. ',1),(6,'On which day of the year are woman at most risk for being victimized by their partner?','Super Bowl Sunday is one of the worse days of the year for domestic violence in the home. ',1),(7,'True of false? A positive HIV status is related to intimate partner violence with gay and heterosexual relationships.','A positive HIV status has been found to be related to IPV with gay and heterosexual relationships, which may be due to the stress provoked by this type of diagnosis.',1),(8,'True or false? Research suggests that Hispanic and Native American men may suffer more IPV than other ethnicities. ','However, it is impossible to make any valid assumption based on the limited amount of research available. It is also necessary that researchers utilize uniform language in terms of ethnicity, and explain their intended meaning so that results can be meaningfully collated and compared. ',1),(9,'True or false? 90% cases reported to police perpetrators report drinking or using substances on the day of the assault','And heavier substance abuse is associated with more dangerous and frequent physical violence. ',1),(10,'Socio-demographic correlates of intimate partner violence are largely similar for gay and heterosexual male victims, who tend to be...','Heterosexual and gay male victims tend to be well educated and have well paying jobs.',1),(11,'Which of the following is not associated with intimate partner violence among lesbian couples?','To date, no study has showed a correlation between SES and IPV among lesbian couples, however further research is indicated, given the limited sample size of existing studies. ',1),(12,'Which type of attachment classification is associated with both victimization and perpetuation of intimate partner violence?','An insecure attachment style has been associated with both victimization and perpetuation of IPV in both heterosexual and same-sex relationships.',1);
/*!40000 ALTER TABLE `poll` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-27 11:02:31
