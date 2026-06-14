-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: mbcenterDB
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
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
INSERT INTO `audit_log` VALUES (1,1,'LOGIN','users',1,NULL,'2026-06-10 22:55:17'),(2,1,'LOGOUT','users',1,NULL,'2026-06-10 22:59:49'),(3,1,'LOGIN','users',1,NULL,'2026-06-10 23:07:31'),(4,1,'CREATE','users',2,'{\"username\":\"admin1\",\"role\":\"admin\"}','2026-06-10 23:32:03'),(5,1,'CREATE','users',3,'{\"username\":\"teacher1\",\"role\":\"teacher\"}','2026-06-10 23:38:31'),(6,1,'CREATE','users',4,'{\"username\":\"staff1\",\"role\":\"staff\"}','2026-06-10 23:44:55'),(7,1,'UPDATE','users',5,'{\"updated\":\"guardian1\"}','2026-06-10 23:49:25'),(8,1,'UPDATE','users',5,'{\"updated\":\"guardian1\"}','2026-06-10 23:49:50'),(9,1,'UPDATE','users',6,'{\"updated\":\"guardian2\"}','2026-06-10 23:56:29'),(10,1,'LOGOUT','users',1,NULL,'2026-06-10 23:56:36'),(11,2,'LOGIN','users',2,NULL,'2026-06-10 23:56:46'),(12,2,'CREATE','users',7,'{\"username\":\"admin2\",\"role\":\"admin\"}','2026-06-11 00:00:03'),(13,2,'LOGOUT','users',2,NULL,'2026-06-11 00:01:48'),(14,2,'LOGIN','users',2,NULL,'2026-06-11 00:02:00'),(15,2,'LOGOUT','users',2,NULL,'2026-06-11 00:02:43'),(16,1,'LOGIN','users',1,NULL,'2026-06-11 00:02:49'),(17,1,'LOGOUT','users',1,NULL,'2026-06-11 00:24:53'),(18,5,'LOGIN','users',5,NULL,'2026-06-11 00:25:01'),(19,5,'LOGOUT','users',5,NULL,'2026-06-11 00:26:25'),(20,1,'LOGOUT','users',1,NULL,'2026-06-11 01:12:31'),(21,1,'LOGIN','users',1,NULL,'2026-06-11 01:12:39'),(22,1,'LOGOUT','users',1,NULL,'2026-06-11 01:29:52'),(23,2,'LOGIN','users',2,NULL,'2026-06-11 01:30:01'),(24,2,'LOGOUT','users',2,NULL,'2026-06-11 01:30:15'),(25,1,'LOGIN','users',1,NULL,'2026-06-11 01:30:57'),(26,1,'LOGIN','users',1,NULL,'2026-06-11 08:50:12'),(27,1,'CREATE','users',9,'{\"username\":\"admin3\",\"role\":\"admin\"}','2026-06-11 09:07:19'),(28,1,'UPDATE','users',9,'{\"is_active\":false}','2026-06-11 09:07:40'),(29,1,'UPDATE','users',9,'{\"is_active\":true}','2026-06-11 09:07:44'),(30,1,'CREATE','users',10,'{\"username\":\"guardian4\",\"role\":\"guardian\"}','2026-06-11 09:11:43'),(31,1,'UPDATE','guardian',4,'{\"updated\":\"Mariane Andrea Rosero Ariba\"}','2026-06-11 09:12:01'),(32,1,'CREATE','student',1,'{\"name\":\"Hezekiah Rico Mejilla\"}','2026-06-11 09:15:26'),(33,1,'UPDATE','student',1,'{\"name\":\"Hezekiah Rico Mejilla\"}','2026-06-11 09:16:32'),(34,1,'DELETE','student',1,'{\"deleted\":\"1\"}','2026-06-11 09:17:12'),(35,1,'CREATE','student',2,'{\"name\":\"Hezekiah Rico Mejilla\"}','2026-06-11 09:18:09'),(36,1,'LOGOUT','users',1,NULL,'2026-06-11 09:18:24'),(37,5,'LOGIN','users',5,NULL,'2026-06-11 09:18:43'),(38,5,'LOGOUT','users',5,NULL,'2026-06-11 09:21:47'),(39,2,'LOGIN','users',2,NULL,'2026-06-11 09:21:57'),(40,2,'LOGOUT','users',2,NULL,'2026-06-11 09:22:08'),(41,3,'LOGIN','users',3,NULL,'2026-06-11 09:22:20'),(42,3,'LOGOUT','users',3,NULL,'2026-06-11 09:22:29'),(43,4,'LOGIN','users',4,NULL,'2026-06-11 09:23:11'),(44,4,'LOGOUT','users',4,NULL,'2026-06-11 09:24:54'),(45,1,'LOGIN','users',1,NULL,'2026-06-11 09:25:04'),(46,1,'LOGIN','users',1,NULL,'2026-06-11 13:03:58'),(47,1,'LOGOUT','users',1,NULL,'2026-06-11 13:06:27'),(48,5,'LOGIN','users',5,NULL,'2026-06-11 13:06:35'),(49,5,'CREATE','enrollment',1,'{\"type\":\"online\",\"student_id\":\"2\"}','2026-06-11 13:07:31'),(50,5,'LOGOUT','users',5,NULL,'2026-06-11 13:07:54'),(51,1,'LOGIN','users',1,NULL,'2026-06-11 13:08:04'),(52,1,'UPDATE','guardian',1,'{\"updated\":\"Roselle Rico Mejilla\"}','2026-06-11 13:09:17'),(53,1,'UPDATE','enrollment',1,'{\"action\":\"rejected\",\"reason\":\"Wrong uploaded files.\"}','2026-06-11 13:14:35'),(54,1,'CREATE','users',11,'{\"username\":\"staff2\",\"role\":\"staff\"}','2026-06-11 13:18:46'),(55,1,'LOGOUT','users',1,NULL,'2026-06-11 13:22:15'),(56,1,'LOGIN','users',1,NULL,'2026-06-11 13:22:22'),(57,1,'LOGOUT','users',1,NULL,'2026-06-11 13:23:23'),(58,2,'LOGIN','users',2,NULL,'2026-06-11 13:23:29'),(59,2,'LOGOUT','users',2,NULL,'2026-06-11 13:23:40'),(60,3,'LOGIN','users',3,NULL,'2026-06-11 13:23:48'),(61,3,'LOGOUT','users',3,NULL,'2026-06-11 13:24:40'),(62,4,'LOGIN','users',4,NULL,'2026-06-11 13:24:47'),(63,4,'LOGOUT','users',4,NULL,'2026-06-11 13:25:22'),(64,1,'LOGIN','users',1,NULL,'2026-06-11 13:25:28'),(65,1,'UPDATE','users',5,'{\"updated\":\"guardian1\"}','2026-06-11 13:25:59'),(66,1,'CREATE','users',12,'{\"username\":\"guardian5\",\"role\":\"guardian\"}','2026-06-11 13:33:29'),(67,1,'CREATE','student',3,'{\"name\":\"Ari Rosero Ariba\"}','2026-06-11 13:37:47'),(68,1,'DELETE','student',2,'{\"deleted\":\"2\"}','2026-06-11 13:43:59'),(69,1,'DELETE','enrollment',1,'{\"deleted_enrollment\":\"1\"}','2026-06-11 13:44:39'),(70,1,'UPDATE','users',10,'{\"is_active\":false}','2026-06-11 13:44:54'),(71,1,'UPDATE','users',10,'{\"is_active\":true}','2026-06-11 13:45:16'),(72,1,'CREATE','enrollment',2,'{\"student\":\"Ari Rosero Ariba\",\"school_year\":\"2025-2026\"}','2026-06-11 13:46:25'),(73,1,'UPDATE','enrollment',2,'{\"status\":\"pending\"}','2026-06-11 13:46:46'),(74,1,'DELETE','enrollment',2,'{\"deleted_enrollment\":\"2\"}','2026-06-11 13:47:29'),(75,1,'CREATE','enrollment',3,'{\"student\":\"Ari Rosero Ariba\",\"school_year\":\"2025-2026\"}','2026-06-11 13:56:05'),(76,1,'LOGOUT','users',1,NULL,'2026-06-11 13:59:26'),(77,1,'LOGIN','users',1,NULL,'2026-06-11 13:59:40'),(78,1,'CREATE','student',4,'{\"name\":\"Hezekiah Rico Mejilla\"}','2026-06-11 14:00:35'),(79,1,'LOGOUT','users',1,NULL,'2026-06-11 14:00:48'),(80,5,'LOGIN','users',5,NULL,'2026-06-11 14:00:55'),(81,5,'LOGOUT','users',5,NULL,'2026-06-11 14:37:41'),(82,1,'LOGIN','users',1,NULL,'2026-06-11 14:37:53'),(83,1,'LOGOUT','users',1,NULL,'2026-06-11 14:38:52'),(84,1,'LOGIN','users',1,NULL,'2026-06-11 14:39:01'),(85,1,'LOGOUT','users',1,NULL,'2026-06-11 14:39:50'),(86,5,'LOGIN','users',5,NULL,'2026-06-11 14:39:57'),(87,5,'LOGOUT','users',5,NULL,'2026-06-11 14:40:20'),(88,1,'LOGIN','users',1,NULL,'2026-06-11 14:40:29'),(89,1,'DELETE','enrollment',3,'{\"deleted_enrollment\":\"3\"}','2026-06-11 14:40:40'),(90,1,'DELETE','student',3,'{\"deleted\":\"3\"}','2026-06-11 14:40:46'),(91,1,'DELETE','student',4,'{\"deleted\":\"4\"}','2026-06-11 14:40:50'),(92,1,'LOGIN','users',1,NULL,'2026-06-11 19:48:09'),(93,1,'LOGOUT','users',1,NULL,'2026-06-11 19:48:22'),(94,5,'LOGIN','users',5,NULL,'2026-06-11 19:48:34'),(95,5,'CREATE','enrollment',4,'{\"type\":\"online\",\"student\":\"Hezekiah Rico Mejilla\"}','2026-06-11 19:49:58'),(96,5,'LOGOUT','users',5,NULL,'2026-06-11 19:50:07'),(97,1,'LOGIN','users',1,NULL,'2026-06-11 19:50:14'),(98,1,'UPDATE','enrollment',4,'{\"action\":\"approved\",\"status\":\"pending_payment\"}','2026-06-11 19:59:25'),(99,1,'LOGOUT','users',1,NULL,'2026-06-11 21:12:46'),(100,13,'CREATE','users',13,'{\"action\":\"self_registration\",\"username\":\"guardian6\"}','2026-06-11 21:14:41'),(101,13,'LOGOUT','users',13,NULL,'2026-06-11 21:15:21'),(102,1,'LOGIN','users',1,NULL,'2026-06-11 21:15:28'),(103,1,'LOGOUT','users',1,NULL,'2026-06-11 21:51:05'),(104,1,'LOGIN','users',1,NULL,'2026-06-11 21:51:12'),(105,1,'UPDATE','enrollment',4,'{\"status\":\"pending\"}','2026-06-11 21:52:49'),(106,1,'UPDATE','enrollment',4,'{\"action\":\"approved\",\"status\":\"pending_payment\"}','2026-06-11 21:53:00'),(107,1,'CREATE','payment',1,'{\"enrollment_id\":4,\"amount\":\"3000.00\",\"or_number\":\"OR-2026-00001\"}','2026-06-11 21:54:13'),(108,1,'UPDATE','enrollment',4,'{\"status\":\"payment_confirmed\"}','2026-06-11 21:54:37'),(109,1,'UPDATE','enrollment',4,'{\"status\":\"pending\"}','2026-06-11 21:54:53'),(110,1,'UPDATE','enrollment',4,'{\"action\":\"approved\",\"status\":\"pending_payment\"}','2026-06-11 21:55:00'),(111,1,'UPDATE','enrollment',4,'{\"status\":\"payment_confirmed\"}','2026-06-11 21:55:52'),(112,1,'DELETE','enrollment',4,'{\"deleted_enrollment\":\"4\"}','2026-06-11 21:57:13'),(113,1,'CREATE','enrollment',5,'{\"student\":\"Hezekiah Rico Mejilla\",\"school_year\":\"2025-2026\"}','2026-06-11 22:02:23'),(114,1,'CREATE','payment',2,'{\"enrollment_id\":5,\"amount\":\"3000.00\",\"or_number\":\"OR-2026-00002\"}','2026-06-11 22:11:20'),(115,1,'LOGIN','users',1,NULL,'2026-06-12 01:46:52'),(116,1,'CREATE','student',6,'{\"name\":\"Ari Ariba\"}','2026-06-12 01:49:54'),(117,1,'CREATE','enrollment',6,'{\"student\":\"Ari Ariba\",\"school_year\":\"2025-2026\"}','2026-06-12 01:53:34'),(118,1,'UPDATE','enrollment',6,'{\"status\":\"withdrawn\"}','2026-06-12 01:54:27'),(119,1,'DELETE','enrollment',6,'{\"deleted_enrollment\":\"6\"}','2026-06-12 01:54:46'),(120,1,'CREATE','enrollment',7,'{\"student\":\"Ari Ariba\",\"school_year\":\"2025-2026\"}','2026-06-12 01:55:33'),(121,1,'CREATE','payment',3,'{\"enrollment_id\":7,\"amount\":\"3000.00\"}','2026-06-12 01:55:48'),(122,1,'LOGOUT','users',1,NULL,'2026-06-12 01:57:03'),(123,5,'LOGIN','users',5,NULL,'2026-06-12 01:57:11'),(124,5,'CREATE','enrollment',8,'{\"type\":\"online\",\"student\":\"Ezekiel Rico Mejilla\"}','2026-06-12 01:58:48'),(125,5,'LOGOUT','users',5,NULL,'2026-06-12 01:59:05'),(126,1,'LOGIN','users',1,NULL,'2026-06-12 01:59:18'),(127,1,'UPDATE','enrollment',8,'{\"action\":\"approved\",\"status\":\"pending_payment\"}','2026-06-12 01:59:32'),(128,1,'CREATE','payment',4,'{\"enrollment_id\":8,\"amount\":\"3000\"}','2026-06-12 01:59:58'),(129,1,'LOGOUT','users',1,NULL,'2026-06-12 02:00:14'),(130,3,'LOGIN','users',3,NULL,'2026-06-12 02:00:25'),(131,3,'LOGOUT','users',3,NULL,'2026-06-12 02:00:59'),(132,1,'LOGIN','users',1,NULL,'2026-06-12 02:11:34'),(133,1,'LOGOUT','users',1,NULL,'2026-06-12 02:11:57'),(134,6,'LOGIN','users',6,NULL,'2026-06-12 02:12:09'),(135,6,'CREATE','enrollment',9,'{\"type\":\"online\",\"student\":\"Lorenzo Rico\"}','2026-06-12 02:13:39'),(136,6,'LOGOUT','users',6,NULL,'2026-06-12 02:14:08'),(137,1,'LOGIN','users',1,NULL,'2026-06-12 02:14:18'),(138,1,'UPDATE','enrollment',9,'{\"action\":\"approved\",\"status\":\"pending_payment\"}','2026-06-12 02:14:41'),(139,1,'CREATE','payment',5,'{\"enrollment_id\":9,\"amount\":\"3000\"}','2026-06-12 02:14:59'),(140,1,'CREATE','student',9,'{\"name\":\"Billy Butcher\"}','2026-06-12 02:16:43'),(141,1,'UPDATE','student',9,'{\"name\":\"Billy Butcher\"}','2026-06-12 02:17:26'),(142,1,'UPDATE','student',9,'{\"name\":\"Billy Butcher\"}','2026-06-12 02:18:35'),(143,1,'CREATE','enrollment',10,'{\"student\":\"Billy Butcher\",\"school_year\":\"2025-2026\"}','2026-06-12 02:19:31'),(144,1,'CREATE','payment',6,'{\"enrollment_id\":10,\"amount\":\"3000\"}','2026-06-12 02:19:56'),(145,1,'LOGIN','users',1,NULL,'2026-06-12 09:01:53'),(146,1,'LOGOUT','users',1,NULL,'2026-06-12 09:03:03'),(147,5,'LOGIN','users',5,NULL,'2026-06-12 09:03:10'),(148,5,'LOGOUT','users',5,NULL,'2026-06-12 09:03:34'),(149,3,'LOGIN','users',3,NULL,'2026-06-12 09:03:45'),(150,3,'LOGOUT','users',3,NULL,'2026-06-12 09:04:07'),(151,1,'LOGIN','users',1,NULL,'2026-06-12 09:04:30'),(152,1,'LOGIN','users',1,NULL,'2026-06-12 12:16:44'),(153,1,'create','student',1,NULL,'2026-06-12 12:23:15'),(154,1,'delete','student',NULL,NULL,'2026-06-12 12:23:52'),(155,1,'delete','student',NULL,NULL,'2026-06-12 12:23:59'),(156,1,'LOGOUT','users',1,NULL,'2026-06-12 12:28:37'),(157,5,'LOGIN','users',5,NULL,'2026-06-12 12:28:45'),(158,2,'LOGIN','users',2,NULL,'2026-06-12 12:29:14'),(159,2,'LOGOUT','users',2,NULL,'2026-06-12 12:29:37'),(160,4,'LOGIN','users',4,NULL,'2026-06-12 12:29:46'),(161,4,'LOGOUT','users',4,NULL,'2026-06-12 12:29:55'),(162,5,'LOGIN','users',5,NULL,'2026-06-12 12:30:01'),(163,1,'LOGIN','users',1,NULL,'2026-06-12 12:30:59'),(164,1,'CREATE','users',14,'{\"username\":\"guardian7\",\"role\":\"guardian\"}','2026-06-12 12:32:29'),(165,1,'delete','student',NULL,NULL,'2026-06-12 12:55:49'),(166,1,'create','student',2,NULL,'2026-06-12 12:57:24'),(167,1,'delete','student',NULL,NULL,'2026-06-12 13:04:20'),(168,1,'delete','student',2,NULL,'2026-06-12 13:17:45'),(169,1,'delete','student',1,NULL,'2026-06-12 13:17:47'),(170,1,'create','student',3,NULL,'2026-06-12 13:19:46'),(171,1,'create','enrollment',1,NULL,'2026-06-12 13:26:43'),(172,1,'create','enrollment',2,NULL,'2026-06-12 13:27:12'),(173,1,'create','enrollment',3,NULL,'2026-06-12 13:27:53'),(174,1,'delete','enrollment',NULL,NULL,'2026-06-12 13:30:26'),(175,1,'LOGOUT','users',1,NULL,'2026-06-12 13:33:45'),(176,15,'CREATE','users',15,'{\"action\":\"self_registration\",\"username\":\"guardian8\"}','2026-06-12 13:35:26'),(177,15,'LOGOUT','users',15,NULL,'2026-06-12 13:36:04'),(178,1,'LOGIN','users',1,NULL,'2026-06-12 13:36:10'),(179,1,'LOGOUT','users',1,NULL,'2026-06-12 13:48:11'),(180,5,'LOGIN','users',5,NULL,'2026-06-12 13:48:21'),(181,5,'LOGOUT','users',5,NULL,'2026-06-12 13:48:31'),(182,15,'LOGIN','users',15,NULL,'2026-06-12 13:48:41'),(183,15,'LOGOUT','users',15,NULL,'2026-06-12 13:50:31'),(184,1,'LOGIN','users',1,NULL,'2026-06-12 13:50:36'),(185,1,'delete','enrollment',3,NULL,'2026-06-12 13:54:19'),(186,1,'delete','enrollment',2,NULL,'2026-06-12 13:54:22'),(187,1,'delete','enrollment',1,NULL,'2026-06-12 13:54:24'),(188,1,'create','enrollment',4,NULL,'2026-06-12 13:57:16'),(189,1,'delete','enrollment',4,NULL,'2026-06-12 13:57:44'),(190,1,'create','enrollment',5,NULL,'2026-06-12 13:58:27'),(191,1,'update','enrollment',5,NULL,'2026-06-12 13:58:42'),(192,1,'delete','enrollment',5,NULL,'2026-06-12 13:59:33'),(193,1,'create','enrollment',6,NULL,'2026-06-12 14:01:17'),(194,1,'update','enrollment',6,NULL,'2026-06-12 14:04:49'),(195,1,'CREATE','payment',1,'{\"enrollment_id\":6,\"amount\":\"3000.00\"}','2026-06-12 14:05:50'),(196,1,'LOGOUT','users',1,NULL,'2026-06-12 14:07:32'),(197,1,'LOGIN','users',1,NULL,'2026-06-12 14:07:40'),(198,1,'LOGOUT','users',1,NULL,'2026-06-12 14:10:21'),(199,5,'LOGIN','users',5,NULL,'2026-06-12 14:10:29'),(200,5,'LOGOUT','users',5,NULL,'2026-06-12 14:17:37'),(201,1,'LOGIN','users',1,NULL,'2026-06-12 14:36:51'),(202,1,'create','student',4,NULL,'2026-06-12 14:41:36'),(203,1,'update','student',4,NULL,'2026-06-12 14:42:23'),(204,1,'create','enrollment',7,NULL,'2026-06-12 14:42:59'),(205,1,'update','enrollment',7,NULL,'2026-06-12 14:43:27'),(206,1,'CREATE','payment',2,'{\"enrollment_id\":7,\"amount\":\"3000.00\"}','2026-06-12 14:45:49'),(207,1,'LOGOUT','users',1,NULL,'2026-06-12 14:46:10'),(208,8,'LOGIN','users',8,NULL,'2026-06-12 14:46:18'),(209,8,'LOGOUT','users',8,NULL,'2026-06-12 14:47:26'),(210,1,'LOGIN','users',1,NULL,'2026-06-12 14:47:31'),(211,1,'LOGOUT','users',1,NULL,'2026-06-12 14:49:00'),(212,5,'LOGIN','users',5,NULL,'2026-06-12 14:49:09'),(213,5,'LOGOUT','users',5,NULL,'2026-06-12 14:51:27'),(214,1,'LOGIN','users',1,NULL,'2026-06-12 14:51:33'),(215,1,'LOGOUT','users',1,NULL,'2026-06-12 14:51:36'),(216,2,'LOGIN','users',2,NULL,'2026-06-12 14:51:41'),(217,2,'LOGOUT','users',2,NULL,'2026-06-12 14:56:56'),(218,3,'LOGIN','users',3,NULL,'2026-06-12 14:57:03'),(219,1,'LOGIN','users',1,NULL,'2026-06-12 21:00:03'),(220,1,'approve','enrollment',8,NULL,'2026-06-12 21:00:22'),(221,1,'update','enrollment',8,NULL,'2026-06-12 21:01:22'),(222,1,'LOGOUT','users',1,NULL,'2026-06-12 21:01:42'),(223,6,'LOGIN','users',6,NULL,'2026-06-12 21:01:51'),(224,6,'LOGOUT','users',6,NULL,'2026-06-12 21:03:20'),(225,5,'LOGIN','users',5,NULL,'2026-06-12 21:03:29'),(226,5,'LOGOUT','users',5,NULL,'2026-06-12 21:03:54'),(227,1,'LOGIN','users',1,NULL,'2026-06-12 21:04:01'),(228,1,'approve','enrollment',9,NULL,'2026-06-12 21:08:05'),(229,1,'delete','enrollment',9,NULL,'2026-06-12 21:08:17'),(230,1,'LOGOUT','users',1,NULL,'2026-06-12 21:08:21'),(231,5,'LOGIN','users',5,NULL,'2026-06-12 21:08:30'),(232,5,'LOGOUT','users',5,NULL,'2026-06-12 21:08:44'),(233,1,'LOGIN','users',1,NULL,'2026-06-12 21:08:51'),(234,1,'delete','enrollment',8,NULL,'2026-06-12 21:15:37'),(235,1,'LOGOUT','users',1,NULL,'2026-06-12 21:15:42'),(236,1,'LOGIN','users',1,NULL,'2026-06-12 21:23:11'),(237,1,'LOGOUT','users',1,NULL,'2026-06-12 21:23:25'),(238,5,'LOGIN','users',5,NULL,'2026-06-12 21:23:32'),(239,5,'LOGOUT','users',5,NULL,'2026-06-12 21:25:04'),(240,1,'LOGIN','users',1,NULL,'2026-06-12 21:25:11'),(241,1,'approve','enrollment',10,NULL,'2026-06-12 21:25:43'),(242,1,'LOGOUT','users',1,NULL,'2026-06-12 21:27:50'),(243,5,'LOGIN','users',5,NULL,'2026-06-12 21:27:57'),(244,5,'LOGOUT','users',5,NULL,'2026-06-12 21:28:07'),(245,1,'LOGIN','users',1,NULL,'2026-06-12 21:28:13'),(246,1,'CREATE','payment',3,'{\"enrollment_id\":10,\"amount\":\"3000\"}','2026-06-12 21:28:31'),(247,1,'delete','student',6,NULL,'2026-06-12 21:31:04'),(248,1,'create','enrollment',11,NULL,'2026-06-12 21:32:00'),(249,1,'update','enrollment',11,NULL,'2026-06-12 21:32:44'),(250,1,'LOGOUT','users',1,NULL,'2026-06-12 21:39:10'),(251,5,'LOGIN','users',5,NULL,'2026-06-12 21:39:18'),(252,5,'LOGOUT','users',5,NULL,'2026-06-12 21:40:50'),(253,1,'LOGIN','users',1,NULL,'2026-06-12 21:40:57'),(254,1,'approve','enrollment',12,NULL,'2026-06-12 21:41:04'),(255,1,'CREATE','payment',4,'{\"enrollment_id\":12,\"amount\":\"100\"}','2026-06-12 21:51:04');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_log`
--

LOCK TABLES `auth_log` WRITE;
/*!40000 ALTER TABLE `auth_log` DISABLE KEYS */;
INSERT INTO `auth_log` VALUES (1,1,'login','127.0.0.1','2026-06-13 02:31:04'),(2,1,'logout','127.0.0.1','2026-06-13 02:42:42'),(3,5,'login','127.0.0.1','2026-06-13 02:42:50'),(4,5,'logout','127.0.0.1','2026-06-13 02:52:08'),(5,1,'login','127.0.0.1','2026-06-13 02:52:15'),(6,1,'logout','127.0.0.1','2026-06-13 03:03:26'),(7,3,'login','127.0.0.1','2026-06-13 03:03:42'),(8,3,'logout','127.0.0.1','2026-06-13 03:03:52'),(9,5,'login','127.0.0.1','2026-06-13 03:04:01'),(10,5,'logout','127.0.0.1','2026-06-13 03:07:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment`
--

LOCK TABLES `enrollment` WRITE;
/*!40000 ALTER TABLE `enrollment` DISABLE KEYS */;
INSERT INTO `enrollment` VALUES (1,'2026-06-12','pending','walk_in',1,NULL,NULL,3,1,NULL,1,'2026-06-12 05:26:43','2026-06-12 05:54:24','2026-06-12 05:54:24'),(2,'2026-06-12','pending','walk_in',1,NULL,NULL,3,1,NULL,1,'2026-06-12 05:27:12','2026-06-12 05:54:22','2026-06-12 05:54:22'),(3,'2026-06-12','pending','walk_in',1,NULL,NULL,3,1,NULL,1,'2026-06-12 05:27:53','2026-06-12 05:54:19','2026-06-12 05:54:19'),(4,'2026-06-12','pending','walk_in',1,NULL,NULL,3,1,NULL,1,'2026-06-12 05:57:16','2026-06-12 05:57:44','2026-06-12 05:57:44'),(5,'2026-06-12','pending_payment','walk_in',0,NULL,NULL,3,1,NULL,1,'2026-06-12 05:58:27','2026-06-12 05:59:33','2026-06-12 05:59:33'),(6,'2026-06-12','enrolled','walk_in',1,NULL,NULL,3,1,NULL,1,'2026-06-12 06:01:17','2026-06-12 06:05:50',NULL),(7,'2026-06-12','enrolled','walk_in',1,NULL,NULL,4,1,NULL,1,'2026-06-12 06:42:59','2026-06-12 06:45:49',NULL),(8,'2026-06-12','pending_payment','online',1,NULL,NULL,5,1,NULL,1,'2026-06-12 06:50:05','2026-06-12 13:15:37','2026-06-12 13:15:37'),(9,'2026-06-12','pending_payment','online',1,NULL,NULL,6,1,3,1,'2026-06-12 13:03:06','2026-06-12 13:08:17','2026-06-12 13:08:17'),(10,'2026-06-12','enrolled','online',1,NULL,NULL,7,1,3,1,'2026-06-12 13:24:54','2026-06-12 13:28:31',NULL),(11,'2026-06-12','pending_payment','walk_in',1,NULL,NULL,5,1,NULL,1,'2026-06-12 13:31:59','2026-06-12 13:32:44',NULL),(12,'2026-06-12','enrolled','online',1,NULL,NULL,8,1,NULL,1,'2026-06-12 13:40:44','2026-06-12 13:51:04',NULL);
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
  `file_path` varchar(255) DEFAULT NULL,
  `notes` text,
  `enrollment_id` int NOT NULL,
  `document_type_id` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enrollment_doc_id`),
  KEY `enrollment_id` (`enrollment_id`),
  KEY `document_type_id` (`document_type_id`),
  CONSTRAINT `enrollment_document_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`enrollment_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `enrollment_document_ibfk_2` FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`document_type_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment_document`
--

LOCK TABLES `enrollment_document` WRITE;
/*!40000 ALTER TABLE `enrollment_document` DISABLE KEYS */;
INSERT INTO `enrollment_document` VALUES (1,'pending',NULL,'enrollment_documents/HSQABn9TxX4WrgxkGU3TajjFPSUlhoJRn6Heq1Xu.pdf',NULL,1,1,NULL),(2,'pending',NULL,'enrollment_documents/pj6Po5SIAQYlQdDYmTb7Q4l23B4TT2rLLkX4B2Kp.pdf',NULL,1,2,NULL),(3,'pending',NULL,'enrollment_documents/WalVzDez1EeD7vYs8aY8tQYqNEXvUewPOmzOX02M.pdf',NULL,1,3,NULL),(4,'pending',NULL,'enrollment_documents/aGTT7GJOfVLLQgaEyaQZs7200x9JuVc1avOunLOj.pdf',NULL,1,4,NULL),(5,'pending',NULL,'enrollment_documents/kxpViF4T5qIyEf3HGOLhm4740oKMLxCFJSEzVXOG.pdf',NULL,2,1,NULL),(6,'pending',NULL,'enrollment_documents/DfRuLPtxbmuH8vYjfDPdWhJb7FLf88IODOM2HVa9.pdf',NULL,2,2,NULL),(7,'pending',NULL,'enrollment_documents/6qBQaWAD7w5hiToKURYNdYRPH1lRInTQi45mFhOB.pdf',NULL,2,3,NULL),(8,'pending',NULL,'enrollment_documents/lyv5Xyqr62bDuOzohQi4WPpWxG17DvLxiii8ouFz.pdf',NULL,2,4,NULL),(9,'pending',NULL,'enrollment_documents/W3WPYyGEZf4Dx7BjgqtEUjP1TGXTPJb9bFKwdRk0.pdf',NULL,3,1,NULL),(10,'pending',NULL,'enrollment_documents/Rmn0Tjcz1qvdZIHvxZaT8ewnlaDh1zg7SWx4NohH.pdf',NULL,3,2,NULL),(11,'pending',NULL,'enrollment_documents/VsdCjxDO90AKqABJjCDFlGOtHIBHCSsF0MAgXO7t.pdf',NULL,3,3,NULL),(12,'pending',NULL,'enrollment_documents/dhpmk7KXY2V172ejYNOclLcUFic5c35OMQWBQwFX.pdf',NULL,3,4,NULL),(13,'pending',NULL,'enrollment_documents/Q09QoOuuyvZIa9rQPbvr9RcWxh53xyPs9E1xMFcU.pdf',NULL,4,1,NULL),(14,'pending',NULL,'enrollment_documents/VX8EL8RPl7GwZQpfiN5wdTXc5mfhWuzxE4EGkmAB.pdf',NULL,4,2,NULL),(15,'pending',NULL,'enrollment_documents/FtoAcc3dpNi9qIQ3YOcxt7KFdaJtqy1Hxko179fm.pdf',NULL,4,3,NULL),(16,'pending',NULL,'enrollment_documents/J8WIetLMgvGnhOnplAuuBQH3yMgtbzfSsewsNLY6.pdf',NULL,4,4,NULL),(17,'pending',NULL,'enrollment_documents/sBQ2Fa4o2TWHpPS450IuoB1zmeK59IIuQysnkTYS.pdf',NULL,5,1,NULL),(18,'pending',NULL,'enrollment_documents/iOlZwLJRfvrEMsfmStrBh3IilptqvqSLfbZiaVDG.pdf',NULL,5,2,NULL),(19,'pending',NULL,'enrollment_documents/McLDuETHvDJdjN6Sb41ARjFaU1WRsRBT1didRWDl.pdf',NULL,5,3,NULL),(20,'pending',NULL,'enrollment_documents/hfNayrikHZ5i9ykwpuwSFF8AUt8lilXj8evwCRfp.pdf',NULL,5,4,NULL),(21,'submitted',NULL,'enrollment_documents/Z9qJ3rZaJlBbhv6w21PFAHIyVGGYpEzwQJv7mRqC.pdf',NULL,6,1,NULL),(22,'submitted',NULL,'enrollment_documents/fCOIM9fOWMoZICnVPEeMVL3q9Y3GEqBvVAERMK9L.pdf',NULL,6,2,NULL),(23,'submitted',NULL,'enrollment_documents/HQJOfAOsuYVefLYWY8g9zjyZ9yzAjfge7nbYKitx.pdf',NULL,6,3,NULL),(24,'submitted',NULL,'enrollment_documents/ydy6Sn9zD94zvX2zQOcVZ4wWMIK9MbDCX7FRfqpK.pdf',NULL,6,4,NULL),(25,'submitted',NULL,'enrollment_documents/StIP2aVoLLaVmgGRK7N5iaWtfUHhfClQU2unWPjs.pdf',NULL,7,1,NULL),(26,'submitted',NULL,'enrollment_documents/JAOvAe71T2TKJ3IXEiBedzof4QQNkd3VT1lFrMAM.pdf',NULL,7,2,NULL),(27,'submitted',NULL,'enrollment_documents/RogHW6D3allcjI4hHpNxE6Hc0V64bGFqr8LUheq4.pdf',NULL,7,3,NULL),(28,'submitted',NULL,'enrollment_documents/iTt1vcxN2yhduqoyDywhK4hjgzY0PMu0dTPbCSQ5.pdf',NULL,7,4,NULL),(29,'submitted',NULL,'enrollment_documents/En7PyPiEPnjKm1zgctML09Hk48qwa8KWYh4KXQkv.pdf',NULL,8,1,NULL),(30,'submitted',NULL,'enrollment_documents/Brc2dZluCm8gJPzsg6ZXuI7uYY4bXXQTe5u396r4.pdf',NULL,8,2,NULL),(31,'submitted',NULL,'enrollment_documents/2hkvP7fl3y5JfkT1CfzXrrSNY1HbosBnZK6cxjVt.pdf',NULL,8,3,NULL),(32,'submitted',NULL,'enrollment_documents/fM8LJf8Zcj4E7MVXNTbqQgEUVS2qVFCJsgblb76M.pdf',NULL,8,4,NULL),(33,'pending',NULL,'enrollment_documents/nb0z9DgNJr2a2VqFRaNRAkiQBJmKPdgKXHlww5dM.pdf',NULL,9,1,NULL),(34,'pending',NULL,'enrollment_documents/zmzTei5xdN509Oa3RD4ucwx6k8GzcHXAkQfoex9S.pdf',NULL,9,2,NULL),(35,'pending',NULL,'enrollment_documents/HKH9d3crzHpJ8T0AAAM2Y5lGB6Ablq1iTejEyfHv.pdf',NULL,9,3,NULL),(36,'pending',NULL,'enrollment_documents/d7lNB7yP45E985vTuQpGUeKhLHOK7nKGWvVRtGQZ.pdf',NULL,9,4,NULL),(37,'submitted',NULL,'enrollment_documents/re1TtdCw5zZwWxVEToCPtteksISDc133SmwcOkX7.pdf',NULL,10,1,NULL),(38,'submitted',NULL,'enrollment_documents/0x7m5V6LLHMmok0kZch0batVMVsrYcdkIwgQ6ZNR.pdf',NULL,10,2,NULL),(39,'submitted',NULL,'enrollment_documents/cNpRLmqzrE4sdNqMba0BOcuPPDHmsCRgzu7D7U1a.pdf',NULL,10,3,NULL),(40,'submitted',NULL,'enrollment_documents/UCGqoturMqPIXYhOe6Y2iG17Q4v1Woh5YdhLXU8T.pdf',NULL,10,4,NULL),(41,'submitted',NULL,'enrollment_documents/rgUku2AIJ1cRbwSPGTnUhXb7M91L5CJbBiEYlz7C.pdf',NULL,11,1,NULL),(42,'submitted',NULL,'enrollment_documents/q9fxrbA3I7xQS3oX2Xfmj2GKtICvG9QjRIqtvC37.pdf',NULL,11,2,NULL),(43,'submitted',NULL,'enrollment_documents/mufycUmpFOJEba9wQ51QILT19LTlZkH4b1Z6xQcC.pdf',NULL,11,3,NULL),(44,'submitted',NULL,'enrollment_documents/aIMC4yNIimGG4o9gGBl7E6FAHB8of1LpaRQZM9lR.pdf',NULL,11,4,NULL),(45,'submitted',NULL,'enrollment_documents/pWV9p3WupaaEa8AwOaTDaXGwmPVm4mRdNBb2oauO.pdf',NULL,12,1,NULL),(46,'submitted',NULL,'enrollment_documents/zNlo2pJvBYuHeOC45LcjfWG23OkoE6XpOSIwpPwl.pdf',NULL,12,2,NULL),(47,'submitted',NULL,'enrollment_documents/v2zFccOyM9oFjFGvvgITnRKMypPn0pSnyZFdngXK.pdf',NULL,12,3,NULL),(48,'submitted',NULL,'enrollment_documents/h8WQOeC4H7ADYFQSksv4dYzGO2dLEjHxlNsSbYMz.pdf',NULL,12,4,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardian`
--

LOCK TABLES `guardian` WRITE;
/*!40000 ALTER TABLE `guardian` DISABLE KEYS */;
INSERT INTO `guardian` VALUES (1,5,NULL,NULL,NULL,NULL,'Mother',NULL,'2026-06-10 16:48:58','2026-06-11 05:09:17',NULL),(2,6,NULL,NULL,NULL,NULL,'Not specified',NULL,'2026-06-10 16:48:58','2026-06-10 16:48:58',NULL),(3,8,NULL,NULL,NULL,NULL,'Not specified',NULL,'2026-06-10 16:48:58','2026-06-10 16:48:58',NULL),(4,10,NULL,NULL,NULL,NULL,'Sibling',NULL,'2026-06-11 01:11:43','2026-06-11 01:11:43',NULL),(5,12,NULL,NULL,NULL,NULL,'Sibling',NULL,'2026-06-11 05:33:29','2026-06-11 05:33:29',NULL),(6,13,NULL,NULL,NULL,NULL,'Father',NULL,'2026-06-11 13:14:41','2026-06-11 13:14:41',NULL),(7,14,NULL,NULL,NULL,NULL,'Legal Guardian',NULL,'2026-06-12 04:32:29','2026-06-12 04:32:29',NULL),(8,15,NULL,NULL,NULL,NULL,'Mother',NULL,'2026-06-12 05:35:26','2026-06-12 05:35:26',NULL);
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,3000.00,'2026-06-12','cash',NULL,NULL,'2026-06-12 06:05:50','2026-06-12 06:05:50',6,1,NULL),(2,3000.00,'2026-06-12','cash',NULL,NULL,'2026-06-12 06:45:49','2026-06-12 06:45:49',7,1,NULL),(3,3000.00,'2026-06-12','cash',NULL,NULL,'2026-06-12 13:28:31','2026-06-12 13:28:31',10,1,NULL),(4,100.00,'2026-06-12','cash',NULL,NULL,'2026-06-12 13:51:04','2026-06-12 13:51:04',12,1,NULL);
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
INSERT INTO `role_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(1,2),(2,2),(3,2),(4,2),(1,3),(2,3),(1,4),(2,4),(1,5),(2,5),(1,6),(2,6),(1,7),(2,7),(4,7),(1,8),(2,8),(4,8),(1,9),(2,9),(3,9),(4,9),(1,10),(2,10),(1,11),(2,11),(1,12),(2,12),(1,13),(2,13),(3,13),(4,13),(1,14),(2,14),(4,14),(1,15),(2,15),(5,15),(1,16),(2,16),(1,17),(2,17),(3,17),(4,17),(1,18),(2,18),(1,19),(2,19),(3,19),(4,19),(5,19),(1,20),(2,20),(3,20),(4,20),(5,20),(1,21),(2,21),(3,21),(4,21),(1,22),(2,22),(3,22),(4,22),(5,22),(1,23),(2,23),(1,24),(2,24),(1,25),(2,25),(3,25),(4,25),(5,25),(1,26),(2,26),(3,26),(4,26);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Hezekiah','Mejilla','Rico','2005-12-30','male',NULL,'profile_pictures/students/4Y09nYIV5zBenbIccOIQ0JJ1gEVvDfehHQxirQd9.jpg','09764213607',NULL,NULL,'active',1,1,NULL,NULL,1,3,3,'2026-06-12 05:17:47','National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 04:23:15','2026-06-12 05:17:47'),(2,'Lorenzo','Rico',NULL,'2012-02-21','male',NULL,'profile_pictures/students/HxacV2Kweov5ekyjEWX82xnyK5OViwhtxSkjtQID.png',NULL,NULL,NULL,'active',7,1,NULL,NULL,1,3,3,'2026-06-12 05:17:45','National Capital Region (NCR)','Metro Manila','Taguig City','#21','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 04:57:24','2026-06-12 05:17:45'),(3,'Hezekiah','Mejilla','Rico','2005-12-30','male',NULL,'profile_pictures/students/I1BwiGGsn71SqeTmdP3DYcpoKlsgYNCVnp5kacZ1.png',NULL,NULL,NULL,'active',1,2,NULL,NULL,5,25,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 05:19:46','2026-06-12 05:19:46'),(4,'John','Lloyd','Rico','2005-12-01','male',NULL,NULL,NULL,NULL,NULL,'active',2,1,NULL,NULL,4,20,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 06:41:36','2026-06-12 06:42:23'),(5,'Ari','Mari',NULL,'1994-04-04','female',NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,NULL,4,22,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 06:50:05','2026-06-12 06:50:05'),(6,'Leonard','Rico',NULL,'2006-02-04','male',NULL,NULL,NULL,NULL,NULL,'active',2,NULL,NULL,NULL,1,1,3,'2026-06-12 13:31:04','National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 13:03:06','2026-06-12 13:31:04'),(7,'Leonard','Rico',NULL,'2006-02-04','male',NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,NULL,1,1,3,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','#21','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 13:24:54','2026-06-12 13:24:54'),(8,'Hamil','Millah',NULL,'1992-02-02','male',NULL,NULL,NULL,NULL,NULL,'active',1,NULL,NULL,NULL,3,15,NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','2026-06-12 13:40:44','2026-06-12 13:40:44');
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
INSERT INTO `user_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(7,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(1,2),(2,2),(3,2),(4,2),(7,2),(9,2),(11,2),(1,3),(2,3),(7,3),(9,3),(1,4),(2,4),(7,4),(9,4),(1,5),(2,5),(7,5),(9,5),(1,6),(2,6),(7,6),(9,6),(1,7),(2,7),(4,7),(7,7),(9,7),(11,7),(1,8),(2,8),(4,8),(7,8),(9,8),(11,8),(1,9),(2,9),(3,9),(4,9),(7,9),(9,9),(11,9),(1,10),(2,10),(7,10),(9,10),(1,11),(2,11),(7,11),(9,11),(1,12),(2,12),(7,12),(9,12),(1,13),(2,13),(3,13),(4,13),(7,13),(9,13),(11,13),(1,14),(2,14),(4,14),(7,14),(9,14),(11,14),(1,15),(2,15),(7,15),(9,15),(10,15),(12,15),(13,15),(14,15),(15,15),(1,16),(2,16),(7,16),(9,16),(1,17),(2,17),(3,17),(4,17),(7,17),(9,17),(11,17),(1,18),(2,18),(7,18),(9,18),(1,19),(2,19),(3,19),(4,19),(7,19),(9,19),(10,19),(11,19),(12,19),(13,19),(14,19),(15,19),(1,20),(2,20),(3,20),(4,20),(7,20),(9,20),(10,20),(11,20),(12,20),(13,20),(14,20),(15,20),(1,21),(2,21),(3,21),(4,21),(7,21),(9,21),(11,21),(1,22),(2,22),(3,22),(4,22),(7,22),(9,22),(10,22),(11,22),(12,22),(13,22),(14,22),(15,22),(1,23),(2,23),(7,23),(9,23),(1,24),(2,24),(7,24),(9,24),(1,25),(2,25),(3,25),(4,25),(7,25),(9,25),(10,25),(11,25),(12,25),(13,25),(14,25),(15,25),(1,26),(2,26),(3,26),(4,26),(7,26),(9,26),(11,26);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Directress','Only','female',NULL,NULL,'1969-01-01','09123456789',NULL,'profile_pictures/users/djKOHt7KeeG1kYivSPBKu5OSH2sf9AhuiVRtNI3K.jpg','National Capital Region (NCR)','Metro Manila','Taguig City','12','Aquino St.','Maharlika','1630','directress@gmail.com','directress','$2y$12$WnbuA9dJ0acrguVz8/PmEOSjyp6gS6MR5gx9JxVfAjqI0T7iBX.X6',1,0,NULL,1,'2026-06-10 14:54:35','2026-06-11 05:16:34',NULL),(2,'Administrator','One',NULL,NULL,NULL,'1970-02-02','09987654321',NULL,'profile_pictures/users/kkv27u07atAI3NKjb22rKSvzm6RBjNOxsDeBCxZK.png','National Capital Region (NCR)','Metro Manila','Taguig City','13','John St.','Tipaz','1631','admin1@gmail.com','admin1','$2y$12$3O93/A4kTOlF8YG6WLl.j.2N3l6lgZ1VamoVX8G0sft2AMCXqh1e2',1,0,NULL,2,'2026-06-10 15:32:03','2026-06-10 15:32:03',NULL),(3,'Mary Elizabeth','Salvador',NULL,NULL,'Salarda','2004-12-07','09135798642',NULL,'profile_pictures/users/5bw2jQ9d3YdfGlAVEkWphyJp2rZudV7cpUrPZhRn.jpg','National Capital Region (NCR)','Metro Manila','Taguig City','14','Resma St.','Central Signal Village','1633','teacher1@gmail.com','teacher1','$2y$12$35cqxBlisFRqhlOHJeHPm.6pC2p8zRckPqmkUGZ4vKLjoWS/g8kCC',1,0,NULL,3,'2026-06-10 15:38:31','2026-06-12 19:03:42',NULL),(4,'Clark Justin','Vasquez',NULL,NULL,NULL,'2005-03-03','09777712345',NULL,'profile_pictures/users/YjWnzVeCsrUrg6EnyRQ8U0L9VoKQo4kOenACEvQb.jpg','National Capital Region (NCR)','Metro Manila','Taguig City','15','Friendship St.','South Signal Village','1633','staff1@gmail.com','staff1','$2y$12$ffzb17dUf83o/fqEGoVsdOHi7Y8nMOtO5vLpFPFqbILhr051rOEqO',1,0,NULL,4,'2026-06-10 15:44:55','2026-06-11 01:23:11',NULL),(5,'Roselle','Mejilla','female',NULL,'Rico','1974-10-01','09278326358',NULL,'profile_pictures/users/HGzO2AsFm09ojfD8n33aZpobTxXm26M6EoFoGbsU.png','National Capital Region (NCR)','Metro Manila','Taguig City','19','Pres. Macapagal St.','South Signal Village','1633','guardian1@gmail.com','guardian1','$2y$12$FN3JWQopiEKh9038NWnsI.luFH5NhxXeFSF4aXF7bwg6d8pK8M6x6',1,0,NULL,5,'2026-06-10 15:48:45','2026-06-11 05:25:59',NULL),(6,'Guardian','Two',NULL,NULL,NULL,'1985-05-05','09857564321',NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','16','Patrick St.','Pateros','1632','guardian2@gmail.com','guardian2','$2y$12$GDCNL1q3sE6fTUxanXM2B.gQxTh0BxdWnNcSshoZP0.N83QftT0Ce',1,0,NULL,5,'2026-06-10 15:53:07','2026-06-10 15:53:07',NULL),(7,'Administrator','Two',NULL,NULL,NULL,'1977-07-07','09777767890',NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','17','Bacani St.','New Lower Bicutan','1634','admin2@gmail.com','admin2','$2y$12$IuStzL4roElf43mVFdkohuYnj37vHfMMq0uigVCAFXlTI1K6vBBqK',1,0,NULL,2,'2026-06-10 16:00:03','2026-06-10 16:00:03',NULL),(8,'Guardian','Three',NULL,NULL,NULL,'1988-08-08','0988887898',NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','21','Garcia St.','South Signal Village','1633','guardian3@gmail.com','guardian3','$2y$12$2VYs7l/A5PKFZgIcu8.3keXDno3LQ9.89SXXpqdGQ0u/ojI8N.bSq',1,0,NULL,5,'2026-06-10 16:09:10','2026-06-10 16:09:10',NULL),(9,'Administrator','Three','male',NULL,NULL,'1999-09-09','09999987981',NULL,'profile_pictures/users/295VVtN7SB6IwdjUOiNLEHYGMgorht4M9ZEOHLGh.jpg','National Capital Region (NCR)','Metro Manila','Taguig City','22','Hagonoy St.','Vistamall','1636','admin3@gmail.com','admin3','$2y$12$3BBmTviJJ.l4LD9fkkU/YO0e5zUlJ1CojoqwZQLTi0bz7wKNkTiKS',1,0,NULL,2,'2026-06-11 01:07:19','2026-06-11 01:07:44',NULL),(10,'Mariane Andrea','Ariba','female',NULL,'Rosero','2005-12-10','09773564129',NULL,'profile_pictures/users/a8YACEARMaiN8XDdq6r7cX2vRTJ51T4IRotTw5gf.jpg','Region IV-A - CALABARZON','Rizal','Taytay','36','Fishport St.','Waterfun','1432','guardian4@gmail.com','guardian4','$2y$12$ta.817vuqw7aK0It1hcjEeFzizKGar25hDfSbyCUMU7ldY1.Xqtw6',1,0,NULL,5,'2026-06-11 01:11:43','2026-06-11 05:45:16',NULL),(11,'Staff','Two','male',NULL,NULL,'1981-10-10','09101049812',NULL,'profile_pictures/users/NEgr2KYl5aTyUxEHRsXJD1bVFAuBu76lVgpfktXh.png','National Capital Region (NCR)','Metro Manila','Taguig City','23','Rongo St.','Maharlika','1637','staff2@gmail.com','staff2','$2y$12$a3yp5.tW93buWI2Czw5D2uLVROu0I7E5elDH6pfQrH2ukTB9esEUe',1,0,NULL,4,'2026-06-11 05:18:46','2026-06-11 05:18:46',NULL),(12,'Guardian','Five','prefer_not_to_say',NULL,NULL,'1991-11-11','09119112375',NULL,NULL,'Region IV-A - CALABARZON','Cavite','General Mariano Alvarez','57','Miguel St.','Mariano','1421','guardian5@gmail.com','guardian5','$2y$12$wbnxPvW6iS45aTMcz8jaeePQZGVXeClRzJhayBIlWTOb1u9SC0xfW',1,0,NULL,5,'2026-06-11 05:33:29','2026-06-11 05:33:29',NULL),(13,'Jose','Mejilla','male',NULL,'Cabuhat','1973-12-30','09777747112',NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','#19','Pres. Macapagal St.','South Signal Village','1633','guardian6@gmail.com','guardian6','$2y$12$rtUTQa0920.UjjN7h0C/eeLMlT06CCt8KyCbTndb.eF7rrfhiuR1y',1,0,NULL,5,'2026-06-11 13:14:41','2026-06-11 13:14:41',NULL),(14,'Flowchart','Process','prefer_not_to_say',NULL,NULL,'1992-12-12','09321912471',NULL,'profile_pictures/users/75JgR7vjrDo29eFK94Tul1h2HJYwjcNNlkzUaWZ2.png','National Capital Region (NCR)','Metro Manila','Taguig City','27','Garcia St.','South Signal Village','1633','guardian7@gmail.com','guardian7','$2y$12$YPCPUnyVt/Yz2n8FW5I15u/f7gVhpL6ceMkCvZT0oJWns.I5W/dVK',1,0,NULL,5,'2026-06-12 04:32:29','2026-06-12 04:32:29',NULL),(15,'Guardian','Nigga','prefer_not_to_say',NULL,NULL,'1991-12-31','09776856968',NULL,NULL,'National Capital Region (NCR)','Metro Manila','Taguig City','67','Resma St.','Central Signal Village','1633','guardian8@gmail.com','guardian8','$2y$12$jUcpeWIFt3wDxZK4v2i77eiCvcbobcRSlS07Vg4SmRVvKaEzmgfcu',1,0,NULL,5,'2026-06-12 05:35:26','2026-06-12 05:35:26',NULL);
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

-- Dump completed on 2026-06-13 10:34:25
