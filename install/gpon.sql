-- MySQL dump 10.13  Distrib 5.7.37, for Linux (x86_64)
--
-- Host: localhost    Database: gpon
-- ------------------------------------------------------
-- Server version	5.7.37-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mib`
--

DROP TABLE IF EXISTS `mib`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mib` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mib` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mib`
--

LOCK TABLES `mib` WRITE;
/*!40000 ALTER TABLE `mib` DISABLE KEYS */;
INSERT INTO `mib` VALUES (1,'getSnmpOnuModel','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.17.',''),(2,'getSnmpZnacznik','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.4',''),(3,'getSnmpOnuUpTime','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.61.',''),(4,'getSnmpOnuInActiveTime','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.85.',''),(5,'getSnmpOnuActiveTime','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.23.',''),(6,'getSnmpOnuSygnal','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.16.',''),(7,'getSnmpOnuStatus','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.2.',''),(8,'getSnmpOnuDeactiveReason','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.45.',''),(9,'getSnmpOnuId','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.1.',''),(10,'getSnmpOnuDystans','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.10.',''),(11,'getSnmpOnuProfil','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.8.',''),(12,'getSnmpOnuBlokada','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.55.',''),(13,'getSnmpOnuActiveFirmware','Dasan','.1.3.6.1.4.1.6296.101.23.3.1.1.12.',''),(14,'getSnmpOnuIPWan','Dasan','.1.3.6.1.4.1.6296.101.23.12.1.1.13.',''),(15,'getSnmpOnuMACWan','Dasan','.1.3.6.1.4.1.6296.101.23.12.1.1.10.','');
/*!40000 ALTER TABLE `mib` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `community` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-26 13:47:02
