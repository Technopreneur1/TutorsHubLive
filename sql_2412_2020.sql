-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: 
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Current Database: `forge`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `forge` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `forge`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `neighborhood_id` int(10) unsigned DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `discipline_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (4,20,1,432,557,20723,NULL,NULL,26,6,'wanna learn fusha','need private tutoring','2020-02-15 17:16:52','2020-02-15 17:16:52'),(5,45,1094,2086,4002,0,NULL,NULL,35,3,'Math Tutor','I want to make inquiry if you are available to take my 13 year old daughter for Math lessons, please do get back to me ASAP.','2020-02-18 23:17:41','2020-02-18 23:17:41'),(7,77,1094,12369,13138,20725,NULL,NULL,60,4,'Looking for a business tutor','Hi, \n\nI’m looking for a business tutor that specializes in economics or finance for college level student. Please kindly reply back, thanks.','2020-04-27 23:20:33','2020-04-27 23:20:33'),(9,133,20780,20808,111,0,NULL,NULL,43,5,'Need a tutor','apples','2020-08-19 18:40:57','2020-08-19 18:40:57'),(10,2,1094,12369,13004,20708,NULL,NULL,75,1,'john toturs','i am lookin tutors','2020-09-04 09:46:50','2020-09-04 09:46:50'),(11,47,1094,12369,13138,20709,NULL,NULL,54,4,'tutor','testing','2020-12-12 08:31:50','2020-12-12 08:31:50');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,'Test','<p>asda asdasdad ad zvcvzv as&nbsp;</p>','15f5e446666f7bblog1895.jpg','2020-09-11 23:03:21','2020-09-13 16:10:14'),(2,'Learn and Earn','<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>','15f5e444c76e5eblog5597.jpg','2020-09-13 16:03:18','2020-09-13 16:09:48');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplines`
--

DROP TABLE IF EXISTS `disciplines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplines`
--

LOCK TABLES `disciplines` WRITE;
/*!40000 ALTER TABLE `disciplines` DISABLE KEYS */;
INSERT INTO `disciplines` VALUES (2,'GRE',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(3,'Physics',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(4,'French',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(7,'LSAT',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(8,'Chemistry',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(9,'Spanish',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(12,'SAT',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(13,'Biology',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(14,'Chinese - Mandarin',0,'2020-01-14 22:29:47','2020-04-19 02:22:41'),(17,'ACT',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(19,'Other',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(26,'Arabic',0,'2020-01-14 22:29:47','2020-01-14 22:29:47'),(31,'Medical - MCAT',0,'2020-01-14 22:29:47','2020-04-19 02:32:12'),(34,'English',0,'2020-01-16 00:20:11','2020-01-16 00:20:11'),(35,'Math',0,'2020-01-16 00:20:17','2020-01-16 00:20:17'),(36,'Regents',0,'2020-01-16 00:20:56','2020-01-16 00:20:56'),(37,'SHSAT',0,'2020-01-16 00:21:26','2020-01-16 00:21:26'),(38,'History',0,'2020-01-16 00:21:38','2020-01-16 00:21:38'),(39,'Earth Science',0,'2020-01-16 00:21:52','2020-01-16 00:21:52'),(40,'Reading',0,'2020-01-16 00:22:32','2020-01-16 00:22:32'),(41,'Writing',0,'2020-01-16 00:22:36','2020-01-16 00:22:36'),(42,'Astronomy',0,'2020-01-16 00:22:50','2020-01-16 00:22:50'),(43,'Art',0,'2020-01-16 00:23:12','2020-01-16 00:23:12'),(44,'Computer science',0,'2020-01-16 00:23:20','2020-01-16 00:23:20'),(45,'Graphic design',0,'2020-01-16 00:23:27','2020-01-16 00:23:27'),(46,'Entrepreneurship',0,'2020-01-16 00:23:34','2020-01-16 00:23:34'),(47,'Accounting',0,'2020-01-16 00:23:40','2020-01-16 00:23:40'),(48,'Marketing',0,'2020-01-16 00:23:46','2020-01-16 00:23:46'),(49,'Personal finance',0,'2020-01-16 00:23:52','2020-01-16 00:23:52'),(50,'Tax',0,'2020-01-16 00:23:57','2020-01-16 00:23:57'),(51,'Culinary arts',0,'2020-01-16 00:24:08','2020-01-16 00:24:08'),(52,'Cosmetology',0,'2020-01-16 00:24:19','2020-01-16 00:24:19'),(53,'Electronics',0,'2020-01-16 00:24:27','2020-01-16 00:24:27'),(54,'Auto repair',0,'2020-01-16 00:24:32','2020-01-16 00:24:32'),(55,'Information Technology',0,'2020-01-16 00:24:41','2020-01-16 00:24:41'),(56,'Paralegal',0,'2020-01-16 00:25:04','2020-01-16 00:25:04'),(57,'Construction',0,'2020-01-16 00:25:12','2020-01-16 00:25:12'),(58,'Architecture',0,'2020-01-16 00:25:32','2020-01-16 00:25:32'),(59,'Resume /Career Prep',0,'2020-01-16 00:29:48','2020-01-16 00:29:48'),(60,'Economics',0,'2020-01-16 00:30:38','2020-01-16 00:30:38'),(61,'Finance',0,'2020-01-16 00:30:46','2020-01-16 00:30:46'),(62,'Management',0,'2020-01-16 00:32:44','2020-01-16 00:32:44'),(63,'Psychology',0,'2020-01-16 00:33:18','2020-01-16 00:33:18'),(64,'Speech Therapy',0,'2020-01-16 00:33:27','2020-01-16 00:33:44'),(65,'Quaran',0,'2020-02-02 02:11:19','2020-02-02 02:11:19'),(66,'Chinese  -  Cantonese',0,'2020-03-14 22:08:29','2020-04-19 02:15:26'),(67,'Chemistry - Organic',0,'2020-04-19 01:43:24','2020-04-19 01:43:24'),(68,'Chemistry - Inorganic',0,'2020-04-19 01:43:36','2020-04-19 01:43:36'),(69,'Chemistry - Analytical',0,'2020-04-19 01:43:52','2020-04-19 01:43:52'),(70,'Chemistry - Physical',0,'2020-04-19 01:44:09','2020-04-19 01:44:09'),(71,'Biology - Molecular',0,'2020-04-19 01:44:41','2020-04-19 01:44:41'),(72,'Biology - Microbiology',0,'2020-04-19 01:46:10','2020-04-19 01:46:10'),(73,'Biology - Cellular',0,'2020-04-19 01:46:52','2020-04-19 01:46:52'),(74,'Genetics',0,'2020-04-19 01:53:02','2020-04-19 01:53:02'),(75,'Biochemistry',0,'2020-04-19 01:53:11','2020-04-19 01:53:11'),(76,'Physics - Mechanics',0,'2020-04-19 01:57:23','2020-04-19 01:57:23'),(77,'Physics - Thermodynamics',0,'2020-04-19 01:58:01','2020-04-19 01:58:01'),(78,'Physics - Electromagnetism and electronics',0,'2020-04-19 01:58:59','2020-04-19 01:58:59'),(79,'Physics - Quantum mechanics',0,'2020-04-19 01:59:52','2020-04-19 01:59:52'),(80,'Physics - Optics',0,'2020-04-19 02:00:55','2020-04-19 02:00:55'),(81,'Physics - Astrophysics',0,'2020-04-19 02:02:09','2020-04-19 02:02:09'),(82,'Physics - Engineering physics',0,'2020-04-19 02:02:50','2020-04-19 02:02:50'),(83,'Physics - Medical',0,'2020-04-19 02:03:27','2020-04-19 02:03:27'),(84,'Physics - Biophysics',0,'2020-04-19 02:04:06','2020-04-19 02:04:06'),(85,'Environmental Sciences',0,'2020-04-19 02:05:21','2020-04-19 02:05:33'),(86,'Civil Engineering',0,'2020-04-19 02:06:05','2020-04-19 02:06:05'),(87,'Physics - Materials & Polymers',0,'2020-04-19 02:16:37','2020-04-19 02:16:37'),(88,'Chemistry - Polymers',0,'2020-04-19 02:16:49','2020-04-19 02:16:49'),(89,'Geography',0,'2020-04-19 02:17:29','2020-04-19 02:17:29'),(90,'Philosophy',0,'2020-04-19 02:17:53','2020-04-19 02:17:53'),(91,'Statistics',0,'2020-04-19 02:18:28','2020-04-19 02:18:28'),(92,'Probability',0,'2020-04-19 02:18:33','2020-04-19 02:18:33'),(93,'GMAT',0,'2020-04-19 02:24:00','2020-04-19 02:24:00'),(94,'Geophysics',0,'2020-04-19 02:24:28','2020-04-19 02:24:28'),(95,'Anatomy',0,'2020-04-19 02:25:01','2020-04-19 02:25:01'),(96,'Histology',0,'2020-04-19 02:25:13','2020-04-19 02:25:13'),(97,'Sociology',0,'2020-04-19 02:25:30','2020-04-19 02:25:30'),(98,'SSAT',0,'2020-04-19 02:28:33','2020-04-19 02:28:33'),(99,'ISEE',0,'2020-04-19 02:28:42','2020-04-19 02:28:42'),(100,'HSPT',0,'2020-04-19 02:29:08','2020-04-19 02:29:08'),(101,'PSAT',0,'2020-04-19 02:29:19','2020-04-19 02:29:19'),(103,'USMLE',0,'2020-04-19 02:30:10','2020-04-19 02:30:10'),(104,'COMLEX',0,'2020-04-19 02:30:25','2020-04-19 02:30:25'),(105,'Medical - Coursework',0,'2020-04-19 02:31:12','2020-04-19 02:31:12'),(106,'Medical - Shelf Exams',0,'2020-04-19 02:31:35','2020-04-19 02:31:35'),(107,'Medical - Admission',0,'2020-04-19 02:31:47','2020-04-19 02:31:47'),(108,'Special Education - Down Syndrome',0,'2020-04-19 02:34:04','2020-04-19 02:34:04'),(109,'Special Education -Autism',0,'2020-04-19 02:34:18','2020-04-19 02:34:18'),(110,'Special Education -Hearing/Visual Impairment',0,'2020-04-19 02:35:30','2020-04-19 02:35:30'),(111,'Special Education - ADD/ADHD',0,'2020-04-19 02:39:02','2020-04-19 02:39:02'),(112,'Botanical Science',0,'2020-04-19 02:46:46','2020-04-19 02:46:46'),(113,'Biology - Plant',0,'2020-04-19 02:47:40','2020-04-19 02:47:40');
/*!40000 ALTER TABLE `disciplines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

