-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mb_enrollment_system
-- ------------------------------------------------------
-- Server version	8.0.46

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
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `action` varchar(20) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `record_id` int DEFAULT NULL,
  `changes` text,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
INSERT INTO `audit_log` VALUES (1,1,'CREATE','users',2,'{\"username\":\"admin1\",\"role\":\"teacher\"}','2026-06-15 03:20:25'),(2,1,'UPDATE','users',2,'{\"updated\":\"admin1\"}','2026-06-15 03:20:47'),(3,2,'CREATE','users',3,'{\"username\":\"guardian1\",\"role\":\"guardian\"}','2026-06-15 03:23:43'),(4,2,'create','student',1,'Created student: Ezekiel R. Price','2026-06-15 03:30:07'),(5,2,'create','enrollment',1,'Created walk-in enrollment for student ID 1','2026-06-15 03:34:14'),(6,2,'update','enrollment',1,'Updated enrollment ID 1','2026-06-15 03:35:05'),(7,2,'CREATE','payment',1,'{\"enrollment_id\":1,\"amount\":\"3000.00\"}','2026-06-15 03:36:22'),(8,4,'CREATE','users',4,'{\"action\":\"self_registration\",\"username\":\"guardian2\"}','2026-06-15 03:40:03'),(9,4,'create','enrollment',2,'{\"student\":\"Hezekiah R. Mejilla\",\"school_year\":\"2025-2026\",\"status\":\"pending\"}','2026-06-15 03:42:39'),(10,2,'approve','enrollment',2,'Approved enrollment ID 2','2026-06-15 03:44:26'),(11,1,'UPDATE','users',2,'{\"updated\":\"admin1\"}','2026-06-15 13:43:40'),(12,1,'CREATE','users',5,'{\"username\":\"staff1\",\"role\":\"staff\"}','2026-06-15 13:45:59'),(13,1,'UPDATE','users',5,'{\"updated\":\"staff1\"}','2026-06-15 13:47:22'),(14,1,'UPDATE','users',5,'{\"updated\":\"staff1\"}','2026-06-15 13:47:33'),(15,1,'UPDATE','users',2,'{\"updated\":\"admin1\"}','2026-06-15 13:56:54'),(16,1,'CREATE','users',6,'{\"username\":\"admin2\",\"role\":\"admin\"}','2026-06-15 14:03:14'),(17,6,'UPDATE','users',5,'{\"updated\":\"staff1\"}','2026-06-15 14:14:37'),(18,5,'UPDATE','users',3,'{\"updated\":\"guardian1\"}','2026-06-15 14:17:08'),(19,1,'UPDATE','users',2,'{\"updated\":\"admin1\"}','2026-06-15 14:47:36'),(20,1,'CREATE','users',7,'{\"username\":\"teacher1\",\"role\":\"teacher\"}','2026-06-15 14:51:55'),(21,1,'CREATE','users',8,'{\"username\":\"staff2\",\"role\":\"staff\"}','2026-06-15 14:59:26'),(22,2,'UPDATE','users',5,'{\"updated\":\"staff1\"}','2026-06-19 10:53:33'),(23,2,'UPDATE','users',5,'{\"updated\":\"staff1\"}','2026-06-19 10:53:42'),(24,1,'update','enrollment',2,'Updated enrollment ID 2','2026-06-19 12:32:23'),(25,1,'create','enrollment',3,'Created walk-in enrollment for student ID 2','2026-06-19 12:38:46'),(26,1,'delete','enrollment',3,'Deleted enrollment ID 3','2026-06-19 15:04:30'),(27,1,'delete','enrollment',2,'Deleted enrollment ID 2','2026-06-19 15:04:34'),(28,1,'create','enrollment',4,'Created walk-in enrollment for student ID 2','2026-06-19 15:05:54'),(29,1,'update','enrollment',4,'Updated enrollment ID 4','2026-06-19 15:06:40'),(30,1,'update','enrollment',4,'Updated enrollment ID 4','2026-06-19 15:07:26'),(31,1,'update','enrollment',4,'Updated enrollment ID 4','2026-06-19 15:08:28'),(32,1,'update','enrollment',4,'Updated enrollment ID 4','2026-06-19 15:08:47'),(33,4,'create','enrollment',5,'{\"student\":\"Testing One\",\"school_year\":\"2025-2026\",\"status\":\"pending\"}','2026-06-19 15:11:47'),(34,1,'approve','enrollment',5,'Approved enrollment ID 5','2026-06-19 15:13:48'),(35,4,'create','enrollment',6,'{\"student\":\"Rico Test\",\"school_year\":\"2025-2026\",\"status\":\"pending\"}','2026-06-19 15:40:16'),(36,1,'UPDATE','users',4,'{\"is_active\":false}','2026-06-19 17:47:02'),(37,1,'UPDATE','users',4,'{\"is_active\":true}','2026-06-19 17:47:05'),(38,1,'approve','enrollment',6,'Approved enrollment ID 6','2026-06-19 18:25:56'),(39,1,'CREATE','payment',2,'{\"enrollment_id\":6,\"amount\":\"3000\"}','2026-06-20 08:00:05'),(40,1,'CREATE','payment',3,'{\"enrollment_id\":5,\"amount\":\"3000\"}','2026-06-20 08:02:00'),(41,1,'UPDATE','users',3,'{\"is_active\":false}','2026-06-20 17:38:24'),(42,1,'UPDATE','users',3,'{\"is_active\":true}','2026-06-20 17:39:22');
/*!40000 ALTER TABLE `audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_log`
--

DROP TABLE IF EXISTS `auth_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_log` (
  `auth_log_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `action` varchar(10) NOT NULL COMMENT 'login or logout',
  `ip_address` varchar(45) DEFAULT NULL,
  `logged_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`auth_log_id`),
  KEY `fk_auth_log_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_log`
--

LOCK TABLES `auth_log` WRITE;
/*!40000 ALTER TABLE `auth_log` DISABLE KEYS */;
INSERT INTO `auth_log` VALUES (1,1,'login','127.0.0.1','2026-06-15 03:01:50'),(2,1,'logout','127.0.0.1','2026-06-15 03:02:09'),(3,1,'login','127.0.0.1','2026-06-15 03:15:02'),(4,1,'logout','127.0.0.1','2026-06-15 03:20:56'),(5,2,'login','127.0.0.1','2026-06-15 03:21:16'),(6,2,'logout','127.0.0.1','2026-06-15 03:24:28'),(7,3,'login','127.0.0.1','2026-06-15 03:25:03'),(8,3,'logout','127.0.0.1','2026-06-15 03:25:30'),(9,2,'login','127.0.0.1','2026-06-15 03:25:49'),(10,2,'logout','127.0.0.1','2026-06-15 03:37:35'),(11,4,'logout','127.0.0.1','2026-06-15 03:40:15'),(12,4,'login','127.0.0.1','2026-06-15 03:40:27'),(13,4,'logout','127.0.0.1','2026-06-15 03:43:19'),(14,2,'login','127.0.0.1','2026-06-15 03:43:37'),(15,2,'logout','127.0.0.1','2026-06-15 03:45:00'),(16,4,'login','127.0.0.1','2026-06-15 03:45:15'),(17,4,'logout','127.0.0.1','2026-06-15 05:35:46'),(18,1,'login','127.0.0.1','2026-06-15 05:36:09'),(19,1,'logout','127.0.0.1','2026-06-15 05:37:10'),(20,1,'login','127.0.0.1','2026-06-15 05:37:56'),(21,1,'logout','127.0.0.1','2026-06-15 05:49:45'),(22,4,'login','127.0.0.1','2026-06-15 05:49:52'),(23,4,'logout','127.0.0.1','2026-06-15 05:50:03'),(24,2,'login','127.0.0.1','2026-06-15 13:42:10'),(25,2,'logout','127.0.0.1','2026-06-15 13:42:44'),(26,1,'login','127.0.0.1','2026-06-15 13:43:22'),(27,1,'logout','127.0.0.1','2026-06-15 14:07:33'),(28,4,'login','127.0.0.1','2026-06-15 14:07:42'),(29,4,'logout','127.0.0.1','2026-06-15 14:08:10'),(30,1,'login','127.0.0.1','2026-06-15 14:08:17'),(31,1,'logout','127.0.0.1','2026-06-15 14:09:56'),(32,6,'login','127.0.0.1','2026-06-15 14:10:05'),(33,6,'logout','127.0.0.1','2026-06-15 14:10:43'),(34,1,'login','127.0.0.1','2026-06-15 14:10:50'),(35,1,'logout','127.0.0.1','2026-06-15 14:11:09'),(36,3,'login','127.0.0.1','2026-06-15 14:11:37'),(37,3,'logout','127.0.0.1','2026-06-15 14:12:16'),(38,6,'login','127.0.0.1','2026-06-15 14:13:16'),(39,6,'logout','127.0.0.1','2026-06-15 14:15:43'),(40,5,'login','127.0.0.1','2026-06-15 14:15:53'),(41,5,'logout','127.0.0.1','2026-06-15 14:17:38'),(42,1,'login','127.0.0.1','2026-06-15 14:18:08'),(43,1,'logout','127.0.0.1','2026-06-15 14:18:19'),(44,2,'login','127.0.0.1','2026-06-15 14:18:27'),(45,2,'logout','127.0.0.1','2026-06-15 14:23:44'),(46,1,'login','127.0.0.1','2026-06-15 14:23:53'),(47,1,'logout','127.0.0.1','2026-06-15 14:37:54'),(48,2,'login','127.0.0.1','2026-06-15 14:38:06'),(49,2,'logout','127.0.0.1','2026-06-15 14:40:57'),(50,1,'login','127.0.0.1','2026-06-15 14:41:08'),(51,1,'logout','127.0.0.1','2026-06-15 14:47:53'),(52,5,'login','127.0.0.1','2026-06-15 14:48:06'),(53,5,'logout','127.0.0.1','2026-06-15 14:48:40'),(54,1,'login','127.0.0.1','2026-06-15 14:48:54'),(55,1,'logout','127.0.0.1','2026-06-15 14:52:03'),(56,7,'login','127.0.0.1','2026-06-15 14:52:13'),(57,7,'logout','127.0.0.1','2026-06-15 14:52:56'),(58,7,'login','127.0.0.1','2026-06-15 14:54:48'),(59,7,'logout','127.0.0.1','2026-06-15 14:54:58'),(60,5,'login','127.0.0.1','2026-06-15 14:55:08'),(61,5,'logout','127.0.0.1','2026-06-15 14:55:42'),(62,1,'login','127.0.0.1','2026-06-15 14:55:49'),(63,1,'logout','127.0.0.1','2026-06-15 14:57:14'),(64,5,'login','127.0.0.1','2026-06-15 14:57:50'),(65,5,'logout','127.0.0.1','2026-06-15 14:58:00'),(66,1,'login','127.0.0.1','2026-06-15 14:58:08'),(67,1,'logout','127.0.0.1','2026-06-15 14:59:41'),(68,8,'login','127.0.0.1','2026-06-15 14:59:51'),(69,8,'logout','127.0.0.1','2026-06-15 15:11:02'),(70,1,'login','127.0.0.1','2026-06-15 15:11:21'),(71,1,'logout','127.0.0.1','2026-06-15 15:11:44'),(72,2,'login','127.0.0.1','2026-06-15 15:11:58'),(73,2,'logout','127.0.0.1','2026-06-15 15:12:14'),(74,5,'login','127.0.0.1','2026-06-15 15:12:28'),(75,1,'login','127.0.0.1','2026-06-16 05:32:36'),(76,1,'logout','127.0.0.1','2026-06-16 05:32:42'),(77,1,'login','127.0.0.1','2026-06-19 09:56:30'),(78,1,'logout','127.0.0.1','2026-06-19 10:32:54'),(79,2,'login','127.0.0.1','2026-06-19 10:33:03'),(80,2,'logout','127.0.0.1','2026-06-19 10:33:08'),(81,7,'login','127.0.0.1','2026-06-19 10:33:16'),(82,7,'logout','127.0.0.1','2026-06-19 10:33:20'),(83,5,'login','127.0.0.1','2026-06-19 10:33:28'),(84,5,'logout','127.0.0.1','2026-06-19 10:33:32'),(85,1,'login','127.0.0.1','2026-06-19 10:33:41'),(86,1,'logout','127.0.0.1','2026-06-19 10:50:40'),(87,5,'login','127.0.0.1','2026-06-19 10:50:48'),(88,5,'logout','127.0.0.1','2026-06-19 10:51:33'),(89,2,'login','127.0.0.1','2026-06-19 10:51:44'),(90,2,'logout','127.0.0.1','2026-06-19 10:51:55'),(91,7,'login','127.0.0.1','2026-06-19 10:52:21'),(92,7,'logout','127.0.0.1','2026-06-19 10:52:33'),(93,1,'login','127.0.0.1','2026-06-19 10:52:39'),(94,1,'logout','127.0.0.1','2026-06-19 10:52:48'),(95,2,'login','127.0.0.1','2026-06-19 10:52:54'),(96,2,'logout','127.0.0.1','2026-06-19 10:54:20'),(97,3,'login','127.0.0.1','2026-06-19 10:54:31'),(98,3,'logout','127.0.0.1','2026-06-19 11:15:52'),(99,1,'login','127.0.0.1','2026-06-19 11:16:11'),(100,1,'logout','127.0.0.1','2026-06-19 11:25:19'),(101,3,'login','127.0.0.1','2026-06-19 11:25:26'),(102,3,'logout','127.0.0.1','2026-06-19 11:26:28'),(103,1,'login','127.0.0.1','2026-06-19 11:26:34'),(104,1,'logout','127.0.0.1','2026-06-19 11:27:46'),(105,4,'login','127.0.0.1','2026-06-19 11:27:53'),(106,4,'logout','127.0.0.1','2026-06-19 11:28:01'),(107,1,'login','127.0.0.1','2026-06-19 11:28:08'),(108,1,'logout','127.0.0.1','2026-06-19 11:33:16'),(109,1,'login','127.0.0.1','2026-06-19 11:33:21'),(110,1,'logout','127.0.0.1','2026-06-19 12:45:53'),(111,4,'login','127.0.0.1','2026-06-19 12:46:02'),(112,4,'logout','127.0.0.1','2026-06-19 12:58:59'),(113,1,'login','127.0.0.1','2026-06-19 12:59:06'),(114,1,'logout','127.0.0.1','2026-06-19 13:00:15'),(115,4,'login','127.0.0.1','2026-06-19 13:00:24'),(116,4,'logout','127.0.0.1','2026-06-19 13:00:49'),(117,1,'login','127.0.0.1','2026-06-19 15:03:56'),(118,1,'logout','127.0.0.1','2026-06-19 15:10:04'),(119,4,'login','127.0.0.1','2026-06-19 15:10:20'),(120,4,'logout','127.0.0.1','2026-06-19 15:13:27'),(121,1,'login','127.0.0.1','2026-06-19 15:13:32'),(122,1,'logout','127.0.0.1','2026-06-19 15:37:41'),(123,3,'login','127.0.0.1','2026-06-19 15:37:50'),(124,3,'logout','127.0.0.1','2026-06-19 15:38:03'),(125,3,'login','127.0.0.1','2026-06-19 15:38:09'),(126,3,'logout','127.0.0.1','2026-06-19 15:38:14'),(127,4,'login','127.0.0.1','2026-06-19 15:38:24'),(128,4,'logout','127.0.0.1','2026-06-19 16:05:07'),(129,1,'login','127.0.0.1','2026-06-19 16:05:14'),(130,1,'logout','127.0.0.1','2026-06-19 17:30:22'),(131,1,'login','127.0.0.1','2026-06-19 17:31:16'),(132,1,'logout','127.0.0.1','2026-06-19 17:40:06'),(133,1,'login','127.0.0.1','2026-06-19 17:40:33'),(134,1,'logout','127.0.0.1','2026-06-19 17:52:04'),(135,3,'login','127.0.0.1','2026-06-19 17:52:18'),(136,3,'logout','127.0.0.1','2026-06-19 18:19:52'),(137,1,'login','127.0.0.1','2026-06-19 18:20:07'),(138,1,'logout','127.0.0.1','2026-06-19 18:23:02'),(139,1,'login','127.0.0.1','2026-06-19 18:24:29'),(140,1,'logout','127.0.0.1','2026-06-19 18:28:32'),(141,5,'login','127.0.0.1','2026-06-19 18:28:40'),(142,1,'login','127.0.0.1','2026-06-20 07:32:44'),(143,1,'logout','127.0.0.1','2026-06-20 07:34:11'),(144,4,'login','127.0.0.1','2026-06-20 07:34:23'),(145,4,'logout','127.0.0.1','2026-06-20 07:34:53'),(146,1,'login','127.0.0.1','2026-06-20 07:48:20'),(147,1,'logout','127.0.0.1','2026-06-20 07:57:49'),(148,1,'login','127.0.0.1','2026-06-20 07:59:41'),(149,1,'logout','127.0.0.1','2026-06-20 08:02:23'),(150,1,'login','127.0.0.1','2026-06-20 08:02:52'),(151,1,'logout','127.0.0.1','2026-06-20 08:04:04'),(152,4,'login','127.0.0.1','2026-06-20 08:04:36'),(153,1,'login','127.0.0.1','2026-06-20 12:09:15'),(154,1,'logout','127.0.0.1','2026-06-20 12:37:04'),(155,1,'login','127.0.0.1','2026-06-20 12:38:20'),(156,1,'logout','127.0.0.1','2026-06-20 12:40:37'),(157,3,'login','127.0.0.1','2026-06-20 12:40:49'),(158,3,'logout','127.0.0.1','2026-06-20 12:41:19'),(159,1,'login','127.0.0.1','2026-06-20 17:37:46'),(160,1,'logout','127.0.0.1','2026-06-20 17:38:27'),(161,1,'login','127.0.0.1','2026-06-20 17:38:44'),(162,1,'logout','127.0.0.1','2026-06-20 17:41:37'),(163,1,'login','127.0.0.1','2026-06-20 17:45:45'),(164,1,'logout','127.0.0.1','2026-06-20 17:53:45'),(165,3,'login','127.0.0.1','2026-06-20 17:53:53'),(166,3,'logout','127.0.0.1','2026-06-20 18:00:56'),(167,1,'login','127.0.0.1','2026-06-20 18:03:43'),(168,1,'logout','127.0.0.1','2026-06-20 18:14:57');
/*!40000 ALTER TABLE `auth_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developmental_pediatrician`
--

DROP TABLE IF EXISTS `developmental_pediatrician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developmental_pediatrician` (
  `dev_ped_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `clinic_hospital` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`dev_ped_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developmental_pediatrician`
--

LOCK TABLES `developmental_pediatrician` WRITE;
/*!40000 ALTER TABLE `developmental_pediatrician` DISABLE KEYS */;
INSERT INTO `developmental_pediatrician` VALUES (1,'Maria','Santos','Santos Developmental Clinic','09171234567',NULL),(2,'Juan','Reyes','Reyes Pediatric Center','09281234567',NULL);
/*!40000 ALTER TABLE `developmental_pediatrician` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disability`
--

DROP TABLE IF EXISTS `disability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disability` (
  `disability_id` int NOT NULL AUTO_INCREMENT,
  `service_type_id` int NOT NULL,
  `disability_name` varchar(100) NOT NULL,
  `description` text,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`disability_id`),
  KEY `fk_disability_service_type` (`service_type_id`),
  CONSTRAINT `fk_disability_service_type` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`service_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disability`
--

LOCK TABLES `disability` WRITE;
/*!40000 ALTER TABLE `disability` DISABLE KEYS */;
INSERT INTO `disability` VALUES (1,1,'Autism Spectrum Disorder (ASD)',NULL,NULL),(2,1,'Global Developmental Delay (GDD)',NULL,NULL),(3,1,'Intellectual Disability',NULL,NULL),(4,1,'Down Syndrome',NULL,NULL),(5,1,'Learning Disability',NULL,NULL),(6,1,'Others',NULL,NULL),(7,2,'Articulation Disorder',NULL,NULL),(8,2,'Language Delay',NULL,NULL),(9,2,'Stuttering / Fluency Disorder',NULL,NULL),(10,2,'Expressive Language Disorder',NULL,NULL),(11,2,'Hearing Impairment',NULL,NULL),(12,2,'Others',NULL,NULL),(13,3,'Sensory Processing Disorder',NULL,NULL),(14,3,'Fine Motor Delay',NULL,NULL),(15,3,'Cerebral Palsy',NULL,NULL),(16,3,'Developmental Coordination Disorder',NULL,NULL),(17,3,'Autism Spectrum Disorder (ASD)',NULL,NULL),(18,3,'Others',NULL,NULL),(19,4,'Cerebral Palsy',NULL,NULL),(20,4,'Gross Motor Delay',NULL,NULL),(21,4,'Muscular Dystrophy',NULL,NULL),(22,4,'Down Syndrome',NULL,NULL),(23,4,'Developmental Coordination Disorder',NULL,NULL),(24,4,'Others',NULL,NULL),(25,5,'Learning Disability',NULL,NULL),(26,5,'ADHD',NULL,NULL),(27,5,'Dyslexia',NULL,NULL),(28,5,'Dyscalculia',NULL,NULL),(29,5,'Borderline Intellectual Functioning',NULL,NULL),(30,5,'Others',NULL,NULL);
/*!40000 ALTER TABLE `disability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_type`
--

DROP TABLE IF EXISTS `document_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_type` (
  `document_type_id` int NOT NULL AUTO_INCREMENT,
  `document_name` varchar(100) NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`document_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_type`
--

LOCK TABLES `document_type` WRITE;
/*!40000 ALTER TABLE `document_type` DISABLE KEYS */;
INSERT INTO `document_type` VALUES (1,'Medical Certificate',1,NULL,1),(2,'Assessment Results',1,NULL,1),(3,'Progress Report',1,NULL,1),(4,'Endorsement Letter',1,NULL,1);
/*!40000 ALTER TABLE `document_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollment` (
  `enrollment_id` int NOT NULL AUTO_INCREMENT,
  `enrollment_date` date NOT NULL,
  `status` enum('pending','pending_payment','payment_confirmed','enrolled','rejected','withdrawn','completed') NOT NULL DEFAULT 'pending',
  `enrollment_type` enum('online','walk_in') NOT NULL DEFAULT 'online',
  `waiver_signed` tinyint(1) NOT NULL DEFAULT '0',
  `rejection_reason` text,
  `remarks` text,
  `student_id` int NOT NULL,
  `school_year_id` int NOT NULL,
  `program_level_id` int DEFAULT NULL,
  `processed_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `student_id` (`student_id`),
  KEY `school_year_id` (`school_year_id`),
  KEY `program_level_id` (`program_level_id`),
  KEY `processed_by` (`processed_by`),
  CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`school_year_id`) REFERENCES `school_year` (`school_year_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `enrollment_ibfk_3` FOREIGN KEY (`program_level_id`) REFERENCES `program_level` (`program_level_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `enrollment_ibfk_4` FOREIGN KEY (`processed_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment`
--

LOCK TABLES `enrollment` WRITE;
/*!40000 ALTER TABLE `enrollment` DISABLE KEYS */;
INSERT INTO `enrollment` VALUES (1,'2026-06-15','enrolled','walk_in',1,NULL,NULL,1,1,3,2,'2026-06-14 19:34:13','2026-06-14 19:36:22',NULL),(2,'2026-06-15','withdrawn','online',1,NULL,NULL,2,1,NULL,2,'2026-06-14 19:42:39','2026-06-19 07:04:34','2026-06-19 07:04:34'),(3,'2026-06-19','pending','walk_in',1,NULL,NULL,2,1,NULL,1,'2026-06-19 04:38:46','2026-06-19 07:04:30','2026-06-19 07:04:30'),(4,'2026-06-19','pending_payment','walk_in',1,NULL,NULL,2,1,NULL,1,'2026-06-19 07:05:53','2026-06-19 07:08:47',NULL),(5,'2026-06-19','enrolled','online',1,NULL,NULL,3,1,NULL,1,'2026-06-19 07:11:47','2026-06-20 00:02:00',NULL),(6,'2026-06-19','enrolled','online',1,NULL,NULL,4,1,3,1,'2026-06-19 07:40:16','2026-06-20 00:00:05',NULL);
/*!40000 ALTER TABLE `enrollment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment_document`
--

DROP TABLE IF EXISTS `enrollment_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollment_document` (
  `enrollment_doc_id` int NOT NULL AUTO_INCREMENT,
  `submission_status` enum('pending','submitted','missing') NOT NULL DEFAULT 'pending',
  `submission_date` date DEFAULT NULL,
  `file_path` text,
  `notes` text,
  `enrollment_id` int NOT NULL,
  `document_type_id` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enrollment_doc_id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `document_type_id` (`document_type_id`),
  CONSTRAINT `enrollment_document_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`enrollment_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `enrollment_document_ibfk_2` FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`document_type_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment_document`
--

LOCK TABLES `enrollment_document` WRITE;
/*!40000 ALTER TABLE `enrollment_document` DISABLE KEYS */;
INSERT INTO `enrollment_document` VALUES (1,'submitted',NULL,'[\"enrollment_documents\\/S0Lob5H9QYIexoqEzwzzvy98VKDwFvG49CWP5yUp.pdf\"]',NULL,1,1,NULL),(2,'submitted',NULL,'[\"enrollment_documents\\/UHoDGPf658PZIZ6buxSt2gx4MzmKcc85I8Mqae2f.pdf\"]',NULL,1,2,NULL),(3,'submitted',NULL,'[\"enrollment_documents\\/YPl4MgTvYG9seE3KO6grgdvCY9KE34t0CGaP6JjM.pdf\"]',NULL,1,3,NULL),(4,'submitted',NULL,'[\"enrollment_documents\\/fLZYwQA1dqHfc3qUpzntHsvasNE4UnT3DdxsePTq.pdf\"]',NULL,1,4,NULL),(5,'pending',NULL,'[\"enrollment_documents\\/sCY4Ldm6TMebMj3RTTC0cfwGUiDmRFrWHD9JFgIp.pdf\"]',NULL,2,1,NULL),(6,'pending',NULL,'[\"enrollment_documents\\/mWVu1dZ1lUBpuHPzPMahwZ5C5SQjBze6r3DyQWhI.pdf\"]',NULL,2,2,NULL),(7,'pending',NULL,'[\"enrollment_documents\\/RRFf6BAZXWGvxksdKRTuHLZusvKIpLxT78ZssWeZ.pdf\"]',NULL,2,3,NULL),(8,'pending',NULL,'[\"enrollment_documents\\/X2jt07NWU1CGibV3fp2cZ3qXwrnomxUkoKlXRhjS.pdf\"]',NULL,2,4,NULL),(9,'pending',NULL,'[\"enrollment_documents\\/wIX2g0xkh8GqukFx1MlOPpLgJ5MzIzUOX0PdBmUJ.pdf\"]',NULL,3,1,NULL),(10,'pending',NULL,'[\"enrollment_documents\\/ce94Y1noeaEHqLm7P23d1soJQgiQc8M2pMHBirCy.pdf\"]',NULL,3,2,NULL),(11,'pending',NULL,'[\"enrollment_documents\\/B74pllHphro6jBOf75eMejPPG8Q4AXXqd7HtWz3Z.pdf\"]',NULL,3,3,NULL),(12,'pending',NULL,'[\"enrollment_documents\\/vDhZGUbbmQtr4WVEBVsDyJWzNRQ3IbNyzN7AThPA.pdf\"]',NULL,3,4,NULL),(13,'submitted',NULL,'[\"enrollment_documents\\/5MM2jMP1ruTsK0gVRnFQUVsNXxTyYo0Ks5OPw2xu.pdf\"]',NULL,4,1,NULL),(14,'submitted',NULL,'[\"enrollment_documents\\/H7ka2YvcuN1XZwa3LYhp86vQQ7UOpPgvEwZONcFO.pdf\"]',NULL,4,2,NULL),(15,'submitted',NULL,'[\"enrollment_documents\\/KQYgxZxUc0X5QWclHq1YCS7NVqD9XzMxVnhFgua0.pdf\"]',NULL,4,3,NULL),(16,'submitted',NULL,'[\"enrollment_documents\\/bdnks3TBTMfBZGZ9C92uM6fMCcXuQYmS0jlAgmwm.pdf\"]',NULL,4,4,NULL),(17,'submitted',NULL,'[\"enrollment_documents\\/y7Bb7w8Ul0TlH2cQXjVubWLG7PNfMugGGfy2zDqc.pdf\",\"enrollment_documents\\/8s1wVMF1Cw8rWQYQMHshTldjJ3hdraKWHhQcVEwv.png\"]',NULL,5,1,NULL),(18,'submitted',NULL,'[\"enrollment_documents\\/GFo8awalHtUxZvOyJZM8ZOBvcl1k2QDRZkKmsHip.pdf\"]',NULL,5,2,NULL),(19,'submitted',NULL,'[\"enrollment_documents\\/uUTFiAF4JnnZBdksZYlgHTIGzz8cVj1y73eMSefk.pdf\"]',NULL,5,3,NULL),(20,'submitted',NULL,'[\"enrollment_documents\\/tB1J78HdoNYmFTTZWEX9TSQnEv8VxsiLqMxgNGva.jpg\"]',NULL,5,4,NULL),(21,'submitted',NULL,'[\"enrollment_documents\\/uka6Kmi1J5ahTis7VrJgVt1wKnbk7d2ZZFfmlJvQ.png\"]',NULL,6,1,NULL),(22,'submitted',NULL,'[\"enrollment_documents\\/b6OpIn4ZflDFxdKqpSFFhCRd8WlkvMgfwG8qNUYg.png\"]',NULL,6,2,NULL),(23,'submitted',NULL,'[\"enrollment_documents\\/eRXfGrHTtKQ9muEz1btczyl5Jxe5ViS8Iap6UxBF.png\"]',NULL,6,3,NULL),(24,'submitted',NULL,'[\"enrollment_documents\\/g1HClzD0vxB4BXm5iylz72ZnPgZUTrBbQ0jsV9ga.png\"]',NULL,6,4,NULL);
/*!40000 ALTER TABLE `enrollment_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardian`
--

DROP TABLE IF EXISTS `guardian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guardian` (
  `guardian_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `relationship` varchar(50) NOT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`guardian_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `guardian_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardian`
--

LOCK TABLES `guardian` WRITE;
/*!40000 ALTER TABLE `guardian` DISABLE KEYS */;
INSERT INTO `guardian` VALUES (1,3,NULL,NULL,NULL,NULL,'Mother',NULL,'2026-06-14 19:23:43','2026-06-14 19:23:43',NULL),(2,4,NULL,NULL,NULL,NULL,'Mother',NULL,'2026-06-14 19:40:03','2026-06-14 19:40:03',NULL);
/*!40000 ALTER TABLE `guardian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_06_14_000001_add_facebook_link_to_enrollment_and_update_staff_permissions',1),(2,'2026_06_15_000001_fix_staff_teacher_permissions',2),(3,'2026_06_15_000002_move_facebook_link_to_users_table',3),(4,'2026_06_15_000003_add_view_user_permission_to_teacher',4),(5,'2026_06_16_000001_convert_enrollment_document_file_path_to_json_array',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(30) NOT NULL DEFAULT 'cash',
  `or_number` varchar(100) DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enrollment_id` int NOT NULL,
  `recorded_by` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `uq_payment_enrollment` (`enrollment_id`),
  KEY `received_by` (`recorded_by`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`enrollment_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,3000.00,'2026-06-15','cash',NULL,NULL,'2026-06-14 19:36:22','2026-06-14 19:36:22',1,2,NULL),(2,3000.00,'2026-06-20','cash',NULL,NULL,'2026-06-20 00:00:05','2026-06-20 00:00:05',6,1,NULL),(3,3000.00,'2026-06-20','cash',NULL,NULL,'2026-06-20 00:02:00','2026-06-20 00:02:00',5,1,NULL);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'general',
  `description` text,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_name` (`permission_name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_dashboard','General','View dashboard',NULL),(2,'view_audit_log','General','View system audit log',NULL),(3,'create_user','User Management','Create user accounts',NULL),(4,'edit_user','User Management','Edit user accounts',NULL),(5,'deactivate_user','User Management','Activate or deactivate user accounts',NULL),(6,'view_user','User Management','View user accounts',NULL),(7,'create_guardian','Guardian Management','Create guardian profiles',NULL),(8,'edit_guardian','Guardian Management','Edit guardian profiles',NULL),(9,'view_guardian','Guardian Management','View guardian profiles',NULL),(10,'create_student','Student Management','Create student records',NULL),(11,'edit_student','Student Management','Edit student records',NULL),(12,'delete_student','Student Management','Delete student records',NULL),(13,'view_student','Student Management','View student records',NULL),(14,'create_walkin_enrollment','Enrollment','Create walk-in enrollment',NULL),(15,'create_online_enrollment','Enrollment','Submit online enrollment',NULL),(16,'approve_enrollment','Enrollment','Approve or reject enrollment',NULL),(17,'edit_enrollment','Enrollment','Edit enrollment records',NULL),(18,'delete_enrollment','Enrollment','Delete enrollment records',NULL),(19,'view_enrollment','Enrollment','View enrollment records',NULL),(20,'upload_document','Documents','Upload enrollment documents',NULL),(21,'update_document_status','Documents','Update document submission status',NULL),(22,'view_document','Documents','View enrollment documents',NULL),(23,'create_payment','Payment','Record payments',NULL),(24,'confirm_payment','Payment','Confirm or reject payments',NULL),(25,'view_payment','Payment','View payment records',NULL),(26,'record_payment','Payment',NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_level`
--

DROP TABLE IF EXISTS `program_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_level` (
  `program_level_id` int NOT NULL AUTO_INCREMENT,
  `program_name` varchar(100) NOT NULL,
  `description` text,
  `max_capacity` int NOT NULL DEFAULT '35',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`program_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_level`
--

LOCK TABLES `program_level` WRITE;
/*!40000 ALTER TABLE `program_level` DISABLE KEYS */;
INSERT INTO `program_level` VALUES (1,'Early Intervention','Program for young children (0-6 years) with developmental delays',35,NULL),(3,'Adult Program','Vocational and life skills program for older students',35,NULL),(4,'Vocational Skills Program',NULL,35,NULL);
/*!40000 ALTER TABLE `program_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permissions` (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(1,2),(2,2),(3,2),(4,2),(1,3),(2,3),(4,3),(1,4),(2,4),(4,4),(1,5),(2,5),(1,6),(2,6),(3,6),(4,6),(1,7),(2,7),(4,7),(1,8),(2,8),(4,8),(1,9),(2,9),(3,9),(4,9),(1,10),(2,10),(4,10),(1,11),(2,11),(4,11),(1,12),(2,12),(4,12),(1,13),(2,13),(3,13),(4,13),(1,14),(2,14),(4,14),(1,15),(2,15),(5,15),(1,16),(2,16),(1,17),(2,17),(4,17),(1,18),(2,18),(4,18),(1,19),(2,19),(3,19),(4,19),(5,19),(1,20),(2,20),(4,20),(5,20),(1,21),(2,21),(4,21),(1,22),(2,22),(3,22),(4,22),(5,22),(1,23),(2,23),(1,24),(2,24),(4,24),(1,25),(2,25),(3,25),(4,25),(5,25),(1,26),(2,26),(4,26);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `description` text,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'directress','School directress with full system access',NULL),(2,'admin','Administrative staff',NULL),(3,'teacher','Teaching staff',NULL),(4,'staff','Support staff',NULL),(5,'guardian','Parent or guardian of a student',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_year`
--

DROP TABLE IF EXISTS `school_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_year` (
  `school_year_id` int NOT NULL AUTO_INCREMENT,
  `year_label` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`school_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_year`
--

LOCK TABLES `school_year` WRITE;
/*!40000 ALTER TABLE `school_year` DISABLE KEYS */;
INSERT INTO `school_year` VALUES (1,'2025-2026','2025-06-01','2026-07-31',1,NULL);
/*!40000 ALTER TABLE `school_year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_type` (
  `service_type_id` int NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  PRIMARY KEY (`service_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type`
--

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` VALUES (1,'Special Education Program (SpED)'),(2,'Speech Therapy (ST)'),(3,'Occupational Therapy (OT)'),(4,'Physical Therapy (PT)'),(5,'Tutorial Services');
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('male','female','others','prefer_not_to_say') NOT NULL,
  `sex_specify` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `contact_number_1` varchar(20) DEFAULT NULL,
  `contact_number_2` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','withdrawn','completed') NOT NULL DEFAULT 'active',
  `guardian_id` int NOT NULL,
  `dev_ped_id` int DEFAULT NULL,
  `dev_ped_document` varchar(255) DEFAULT NULL,
  `disability_other` varchar(255) DEFAULT NULL,
  `service_type_id` int DEFAULT NULL,
  `disability_id` int DEFAULT NULL,
  `program_level_id` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `house_unit_no` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`),
  KEY `guardian_id` (`guardian_id`),
  KEY `dev_ped_id` (`dev_ped_id`),
  KEY `program_level_id` (`program_level_id`),
  KEY `fk_student_service_type` (`service_type_id`),
  KEY `fk_student_disability` (`disability_id`),
  CONSTRAINT `fk_student_disability` FOREIGN KEY (`disability_id`) REFERENCES `disability` (`disability_id`),
  CONSTRAINT `fk_student_service_type` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`service_type_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `guardian` (`guardian_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `student_ibfk_2` FOREIGN KEY (`dev_ped_id`) REFERENCES `developmental_pediatrician` (`dev_ped_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `student_ibfk_3` FOREIGN KEY (`program_level_id`) REFERENCES `program_level` (`program_level_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Ezekiel','Price','Roger','2013-03-03','male',NULL,NULL,NULL,NULL,NULL,'active',1,2,NULL,NULL,1,3,3,NULL,'Region IV-A - CALABARZON','Rizal','Taytay','3','Tulay St.','Fishport','1432','2026-06-14 19:30:07','2026-06-14 19:30:07'),(2,'Hezekiah','Mejilla','Rico','2005-12-30','male',NULL,'profile_pictures/students/DZ87aJeUt46LassFSsxoM3kvk3JTSgh14cvMjG4Y.png',NULL,NULL,NULL,'active',2,NULL,NULL,NULL,4,22,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','19','Pres. Macapagal St.','South Signal Village','1633','2026-06-14 19:42:39','2026-06-14 19:42:39'),(3,'Testing','One',NULL,'2001-01-01','male',NULL,NULL,NULL,NULL,NULL,'active',2,NULL,NULL,NULL,5,25,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','19','Main St.','South Signal Village','1633','2026-06-19 07:11:47','2026-06-19 07:11:47'),(4,'Rico','Test',NULL,'2005-03-12','female',NULL,'profile_pictures/students/Ov9zWhoXl8o4JywLDkd1S9XNJAIbLWa8pwCONQnv.jpg',NULL,NULL,NULL,'active',2,NULL,NULL,NULL,1,1,3,NULL,'Region I - Ilocos Region','Ilocos Norte','Paoay','15','23rd street','South Signal Village','1635','2026-06-19 07:40:15','2026-06-19 07:40:15');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_permissions` (
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `user_permissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `user_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(1,2),(2,2),(5,2),(6,2),(7,2),(8,2),(1,3),(2,3),(5,3),(6,3),(8,3),(1,4),(2,4),(5,4),(6,4),(8,4),(1,5),(2,5),(6,5),(1,6),(2,6),(5,6),(6,6),(7,6),(8,6),(1,7),(2,7),(5,7),(6,7),(8,7),(1,8),(2,8),(5,8),(6,8),(8,8),(1,9),(2,9),(5,9),(6,9),(7,9),(8,9),(1,10),(2,10),(5,10),(6,10),(8,10),(1,11),(2,11),(5,11),(6,11),(8,11),(1,12),(2,12),(5,12),(6,12),(8,12),(1,13),(2,13),(5,13),(6,13),(7,13),(8,13),(1,14),(2,14),(5,14),(6,14),(8,14),(1,15),(2,15),(3,15),(4,15),(6,15),(1,16),(2,16),(6,16),(1,17),(2,17),(5,17),(6,17),(8,17),(1,18),(2,18),(5,18),(6,18),(8,18),(1,19),(2,19),(3,19),(4,19),(5,19),(6,19),(7,19),(8,19),(1,20),(2,20),(3,20),(4,20),(5,20),(6,20),(8,20),(1,21),(2,21),(5,21),(6,21),(8,21),(1,22),(2,22),(3,22),(4,22),(5,22),(6,22),(7,22),(8,22),(1,23),(2,23),(6,23),(1,24),(2,24),(5,24),(6,24),(8,24),(1,25),(2,25),(3,25),(4,25),(5,25),(6,25),(7,25),(8,25),(1,26),(2,26),(5,26),(6,26),(8,26);
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `sex_specify` varchar(100) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number_1` varchar(20) DEFAULT NULL,
  `contact_number_2` varchar(20) DEFAULT NULL,
  `facebook_link` varchar(500) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `house_unit_no` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `failed_attempts` int NOT NULL DEFAULT '0',
  `locked_until` datetime DEFAULT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Directress','Only','female',NULL,NULL,NULL,'09123456789',NULL,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','7','Col. Rongo St.','Central Signal Village','1633','directress@gmail.com','directress','$2y$12$wG8med/eoRltYCwC4idAn.wiGB39SmyBZVkyObuaY4J4r5ML.aSVW',1,0,NULL,1,'2026-06-14 18:59:09','2026-06-20 10:04:33',NULL),(2,'Administrator','One','male',NULL,NULL,'1991-01-01','09123456789',NULL,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','1','Main St.','South Signal Village','1633','admin1@gmail.com','admin1','$2y$12$X8Ur1nJWN5KWnfmANAmtwegtUDl5bP4G.GcUfQLGwjcvL2qvWAKxe',1,0,NULL,2,'2026-06-14 19:20:25','2026-06-15 06:47:36',NULL),(3,'Guardian','One','male',NULL,'Hehe','1992-02-02','09123456789',NULL,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','2','John St.','Central Signal Village','1634','guardian1@gmail.com','guardian1','$2y$12$9Sf0rUeXifr70sFgN5QA9.SngokSyqb4Ruu9B1WIthrXuCWMahBjm',1,0,NULL,5,'2026-06-14 19:23:43','2026-06-20 09:39:22',NULL),(4,'Guardian','Two','female',NULL,NULL,'1974-01-11','09123456789',NULL,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','19','Pres. Macapgal St.','South Signal Village','1633','guardian2@gmail.com','guardian2','$2y$12$Y.sQb9vZelcBwNQtq7GIOOyxNEGMp/PiVpgTnBgp2SlHdF03.S4Va',1,0,NULL,5,'2026-06-14 19:40:03','2026-06-19 09:47:05',NULL),(5,'Staff','One','male',NULL,NULL,'1994-04-04','09441234567',NULL,NULL,'profile_pictures/users/Hik5DxOwDFrUqnyM8m1ct4wsLzBUbZ2Dr4A9eTiH.jpg','National Capital Region (NCR)','Metro Manila','Taguig City','19','John St.','Center Signal Village','1633','staff1@gmail.com','staff1','$2y$12$CbFme.WZqQFpN.ILiVzViOWhw/IoxorW/2.sq0/bs6C6.H0JbUhXu',1,0,NULL,4,'2026-06-15 05:45:58','2026-06-19 10:30:20',NULL),(6,'Administrator','One','male',NULL,NULL,'2001-01-01','09200112345',NULL,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','19','Pres. Macapagal St.','South Signal Village','1633','admin2@gmail.com','admin2','$2y$12$AsXtlWYPt4wZCPgeMmcP4.wARQlxmVuAXgS.GoonkTo..BEaqE8cG',1,0,NULL,2,'2026-06-15 06:03:13','2026-06-15 06:03:13',NULL),(7,'Teacher','One','male',NULL,NULL,'1992-09-09','09764213607',NULL,NULL,'profile_pictures/users/PDGsCeITU57w6OK3GtpQ2kqdOZ6DjchFSikOq40c.png','National Capital Region (NCR)','Metro Manila','Taguig City','67','Six Even St.','South Signal Village','1633','teacher1@gmai.com','teacher1','$2y$12$6xMhr1Iz.QX2xY.6c707I./KHdiiLqS/31Ycsj9xpZ4dA/Vxc.dPG',1,0,NULL,3,'2026-06-15 06:51:55','2026-06-15 06:51:55',NULL),(8,'Staff','Two','male',NULL,NULL,'2000-04-04','09445671234',NULL,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','19','Six Even St.','Maharlika','1645','staff2@gmail.com','staff2','$2y$12$ULZmGKxIuh124Hm6uuGJ.uafXb67HU49W7E8MvYVfIIikgToRYQSW',1,0,NULL,4,'2026-06-15 06:59:26','2026-06-15 06:59:26',NULL);
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

-- Dump completed on 2026-06-20 18:17:20
