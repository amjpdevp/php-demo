-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: demo
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `employee_id` int NOT NULL AUTO_INCREMENT,
  `entity_id` int DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwords` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `permissions` varchar(300) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  `department_id` int DEFAULT NULL,
  `active` int DEFAULT '1',
  PRIMARY KEY (`employee_id`),
  KEY `entity_id` (`entity_id`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (17,7,'anil','Ambani','Anilambani@ambani.com','dae25370b4b2cd9c9d8483059950cdf4','male','2006-07-01','{\"add\":true,\"edit\":true,\"delete\":true}','anil_ambani.jpeg','2022-09-20 06:36:22','2022-09-22 06:02:57',7,1),(18,7,'Artair','Staton','astaton2@mayoclinic.com','b1164b0d531a368d206c1896ab1bcce3','male','2001-01-10','{\"add\":true,\"edit\":true,\"delete\":true}','newprofile.png','2022-09-20 06:38:00','2022-09-20 06:38:00',8,1),(20,7,'Dickie','Mooreed','dmooreed70@facebook.com','dae25370b4b2cd9c9d8483059950cdf4','female','2001-07-10','{\"add\":true,\"edit\":true,\"delete\":true}','Screenshot from 2022-09-20 10-19-51.png','2022-09-20 06:42:24','2022-09-21 13:21:35',6,1),(21,7,'DuffinNew','DuffinNew','Merladuffin@ambani.com','dae25370b4b2cd9c9d8483059950cdf4','male','1998-02-01','{\"add\":true,\"delete\":true}','newprofile.png','2022-09-20 06:49:56','2022-09-21 09:56:15',8,1),(25,7,'Jeff','Bezos','jeff@amazon.com','7440da479f6533e79ab58fc153307c3b','male','2004-01-10','{\"add\":true,\"delete\":true}','jeffprofile.png','2022-09-20 10:35:33','2022-09-23 07:13:20',8,0),(30,7,'soniya ','gandhi','soniya@gandhi.com','5abf8bfd2f458d02cc9ddd544538a67f','male','2021-05-10','{\"add\":true,\"edit\":true,\"delete\":true}','soniya.jpeg','2022-09-23 06:34:20','2022-09-23 06:34:20',12,0);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-23 12:58:34
