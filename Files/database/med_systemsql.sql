-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: med_system
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit`
--

DROP TABLE IF EXISTS `audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit` (
  `audit_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `code` text COLLATE utf8mb4_general_ci NOT NULL,
  `longdesc` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`audit_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit`
--

LOCK TABLES `audit` WRITE;
/*!40000 ALTER TABLE `audit` DISABLE KEYS */;
INSERT INTO `audit` VALUES (1,1,'reg','new user registered','2025-10-10'),(2,1,'log','user has successfully logged in','2025-10-10'),(3,2,'reg','new user registered','2025-10-13'),(6,24,'reg','new user registered','2025-10-13'),(7,2,'reg','new user registered','2025-10-14'),(8,25,'reg','new user registered','2025-10-21'),(9,1,'log','user has successfully logged in','2025-10-21'),(10,1,'log','user has successfully logged in','2025-10-21'),(11,1,'log','user has successfully logged out','2025-10-21'),(12,1,'log','user has successfully logged in','2025-10-21'),(13,1,'log','user has successfully logged out','2025-10-21'),(14,1,'log','user has successfully logged in','2025-10-21'),(15,25,'log','user has successfully logged in25','2025-10-21'),(16,25,'log','user has successfully logged in25','2025-10-23'),(17,25,'log','user has successfully logged in25','2025-10-23');
/*!40000 ALTER TABLE `audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `user_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `aptdate` int NOT NULL,
  `bookedon` int NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`,`staff_id`),
  KEY `staff_id` (`staff_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `doctors` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (25,4,4,1761390720,1761221456),(25,4,5,1761912000,1761224102),(25,1,6,1761309600,1761226669),(25,4,7,1762004280,1761226683),(25,4,8,1761755880,1761226701);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctors` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `role` text COLLATE utf8mb4_general_ci NOT NULL,
  `surname` text COLLATE utf8mb4_general_ci NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `room` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'doc','timmothy','doctortim','$2y$10$mHhuu019O5Vl.nMxhY5WPuCeLNXxS2/FAeBZdE31UDdECv6dGRgey','2025-10-14'),(2,'doc','timmothy','doctorgarry','$2y$10$/QfdfezLvBo0JYFCVImfS.jWDSMQJ42f6g08i6u4QRitmnJOpU5Nm','10'),(3,'doc','smith','myguy','$2y$10$DtPsl18EbUJ9cK4wE5PWA.o62wCO38PI9Z3v.LMfUX7YF7ILCvPCC','13'),(4,'doc','richord','docterwill','$2y$10$RBGoBKZrI9UBeOUqFUkz9OeQHg4jwMipw4DBeMtZhwaGToMf7RNYG','2');
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_audit`
--

DROP TABLE IF EXISTS `staff_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff_audit` (
  `staff_audit_id` int NOT NULL AUTO_INCREMENT,
  `staff_id` int NOT NULL,
  `code` text COLLATE utf8mb4_general_ci NOT NULL,
  `longdesc` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`staff_audit_id`),
  KEY `staff_id` (`staff_id`),
  CONSTRAINT `staff_audit_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `doctors` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_audit`
--

LOCK TABLES `staff_audit` WRITE;
/*!40000 ALTER TABLE `staff_audit` DISABLE KEYS */;
INSERT INTO `staff_audit` VALUES (1,4,'reg','new user registered','2025-10-14');
/*!40000 ALTER TABLE `staff_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `first_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `surname` text COLLATE utf8mb4_general_ci NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL AUTO_INCREMENT,
  `d_o_b` text COLLATE utf8mb4_general_ci NOT NULL,
  `adress` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('ava','sheriff','avas','$2y$10$ZKloeVAKPI1o384CfKcOSuYbBOr.6CiJIe5O104I5KkZ3PmmQwpKq',1,'15/02/2008','hello'),('maryam','sheriff','maryams','$2y$10$CamwVS9Twu9YzlgqpbpyNe1EA6QdlHB6DTSe2u.4uUKEfiemkfXF2',2,'2025-10-13','hello'),('james','jenkins','jamesj','$2y$10$HUJBodr.RggDvV6jxLXBXO8027Fda9AUceVwzdaI8KPaVl3iVwsSO',3,'2025-10-13','hello'),('tom','jenkins','tomj','$2y$10$BCX7STvB.4LJ.8jkMgoqwuTwuyxeqr1fQXcp3QJmHZExOcV97v.sG',4,'2025-10-13','hello'),('laura','fansworth','lauraf','$2y$10$HVW.0GCWVxLEn5vSTWDPeum6fnIvej9mIl9WbAnXGXnaL1PNmT4Kq',5,'2025-10-13','hello'),('rod','sheriff','rods','$2y$10$jiI799hL48V7mM3Wp4y/TeyrnKCskFKDsHd3qE6uBMAT7vYshGUda',6,'2025-10-13','hello'),('tom','jenkins','tomj','$2y$10$ui/.hvwgpOHT8B4Liwo1Nuu948LkohJnjeguei80LLY1qC82XBnqa',8,'2025-10-13','hello'),('laura','fansworth','lauraf','$2y$10$.4g3TwP8x75O1T6PqFvZcuj2oY6pt2AAAGW7.XAIot4puXK.cgxWK',10,'2025-10-13','hello'),('ava()','sheriff....S','22sherifa<heelooo>','$2y$10$2v1HZ6pVBGF7Y73SN1yDnus8v5EvJXN7kI2LXyQF.NOjOGCT9Uv66',22,'2025-10-13','hellohttps://www.google.com/?safe=active&ssui=on'),('ava()','sheriff....S','22sherifaheelooo','$2y$10$.Gll2xas185yb3wyAYdHxOWMQ47/yMcGbp7yeuC6UyqAKQFNdXyJq',24,'2025-10-13','hellohttps://www.google.com/?safe=active&ssui=on'),('tim','lilttle','timmy','$2y$10$Qqc8SvtSf7Ad9k29Wz3.benXdIVQhYez5Q/Arf.UpktslRz0/uqta',25,'2025-10-21','ghgh');
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

-- Dump completed on 2025-11-07 12:39:48
