-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: gmdapi
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

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
-- Table structure for table `causes`
--

DROP TABLE IF EXISTS `causes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `causes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causes`
--

LOCK TABLES `causes` WRITE;
/*!40000 ALTER TABLE `causes` DISABLE KEYS */;
INSERT INTO `causes` VALUES (1,'décès','2022-03-25 15:34:42','2022-03-25 15:34:42'),(2,'démission','2022-03-25 15:34:42','2022-03-25 15:34:42'),(3,'départ négocié','2022-03-25 15:34:42','2022-03-25 15:34:42'),(4,'licenciement pour motif économique','2022-03-25 15:34:42','2022-03-25 15:34:42'),(5,'licenciement pour faute','2022-03-25 15:34:42','2022-03-25 15:34:42'),(6,'retraite','2022-03-25 15:34:42','2022-03-25 15:34:42'),(7,'fin de cdd','2022-03-25 15:34:42','2022-03-25 15:34:42'),(8,'abandon','2022-03-25 15:34:42','2022-03-25 15:34:42');
/*!40000 ALTER TABLE `causes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `personnel_id` bigint unsigned NOT NULL,
  `type_contrat_id` bigint unsigned NOT NULL,
  `statut_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contrats_personnel_id_foreign` (`personnel_id`),
  KEY `contrats_type_contrat_id_foreign` (`type_contrat_id`),
  KEY `contrats_statut_id_foreign` (`statut_id`),
  CONSTRAINT `contrats_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`),
  CONSTRAINT `contrats_statut_id_foreign` FOREIGN KEY (`statut_id`) REFERENCES `statuts` (`id`),
  CONSTRAINT `contrats_type_contrat_id_foreign` FOREIGN KEY (`type_contrat_id`) REFERENCES `type_contrats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrats`
--

LOCK TABLES `contrats` WRITE;
/*!40000 ALTER TABLE `contrats` DISABLE KEYS */;
INSERT INTO `contrats` VALUES (4,'1986-01-01','1986-10-09','2022-03-25 17:07:48','2022-03-25 17:07:48',20,3,4),(5,'2010-07-15','1988-12-04','2022-03-25 17:07:48','2022-03-25 17:07:48',6,1,2),(6,'1994-02-27','2017-02-28','2022-03-25 17:07:48','2022-03-25 17:07:48',6,9,4),(7,'1990-07-27','2021-11-15','2022-03-25 17:07:48','2022-03-25 17:07:48',20,10,4),(8,'1971-03-31','1997-03-14','2022-03-25 17:07:48','2022-03-25 17:07:48',11,2,2),(9,'2016-12-26','2021-07-04','2022-03-25 17:07:48','2022-03-25 17:07:48',18,2,1),(10,'2007-08-12','1993-05-25','2022-03-25 17:07:48','2022-03-25 17:07:48',16,1,5),(11,'1994-09-12','1973-02-24','2022-03-25 17:07:48','2022-03-25 17:07:48',5,10,3),(12,'1976-11-07','2010-06-19','2022-03-25 17:07:48','2022-03-25 17:07:48',8,2,2),(13,'2014-12-24','1975-01-12','2022-03-25 17:07:48','2022-03-25 17:07:48',13,8,4);
/*!40000 ALTER TABLE `contrats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departs`
--

DROP TABLE IF EXISTS `departs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cause_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departs_cause_id_foreign` (`cause_id`),
  CONSTRAINT `departs_cause_id_foreign` FOREIGN KEY (`cause_id`) REFERENCES `causes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departs`
--

LOCK TABLES `departs` WRITE;
/*!40000 ALTER TABLE `departs` DISABLE KEYS */;
INSERT INTO `departs` VALUES (1,'1978-09-02','2022-03-25 16:00:39','2022-03-25 16:00:39',2),(2,'1985-11-12','2022-03-25 16:00:39','2022-03-25 16:00:39',8),(3,'1980-06-10','2022-03-25 16:00:39','2022-03-25 16:00:39',2),(4,'1999-07-27','2022-03-25 16:00:39','2022-03-25 16:00:39',2),(5,'1982-11-21','2022-03-25 16:00:39','2022-03-25 16:00:39',9),(6,'1985-11-27','2022-03-25 16:00:39','2022-03-25 16:00:39',5),(7,'1986-06-17','2022-03-25 16:00:39','2022-03-25 16:00:39',8),(8,'2004-06-11','2022-03-25 16:00:39','2022-03-25 16:00:39',5),(9,'2010-03-29','2022-03-25 16:00:39','2022-03-25 16:00:39',8),(10,'1993-02-20','2022-03-25 16:00:39','2022-03-25 16:00:39',1);
/*!40000 ALTER TABLE `departs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filieres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `structure_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filieres_structure_id_foreign` (`structure_id`),
  CONSTRAINT `filieres_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filieres`
--

LOCK TABLES `filieres` WRITE;
/*!40000 ALTER TABLE `filieres` DISABLE KEYS */;
INSERT INTO `filieres` VALUES (1,'production aliment animal','1982-04-03','1979-06-11',2,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(2,'direction générale','1983-07-30','1979-03-09',1,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(3,'direction adm et fin','2020-03-30','2020-05-25',6,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(4,'direction commerciale','1984-10-25','2019-01-13',2,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(5,'production d\'energie','2017-12-10','2015-05-04',7,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(6,'maintenance et travaux','2019-02-25','1989-02-25',7,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(7,'direction industrielle','1986-06-02','2015-04-02',9,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(8,'production farine','2005-02-25','1982-04-15',3,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(9,'direction rh et communication','1983-11-14','2003-09-23',1,'2022-03-25 15:58:08','2022-03-25 15:58:08'),(10,'direction logistique','1972-03-19','1981-01-02',9,'2022-03-25 15:58:08','2022-03-25 15:58:08');
/*!40000 ALTER TABLE `filieres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fonctions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonctions`
--

LOCK TABLES `fonctions` WRITE;
/*!40000 ALTER TABLE `fonctions` DISABLE KEYS */;
INSERT INTO `fonctions` VALUES (1,'encadreur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(2,'développeur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(3,'administrateur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(4,'operateur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(5,'analyste','2022-03-25 16:01:51','2022-03-25 16:01:51'),(6,'vendeur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(7,'melangeur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(8,'batteur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(9,'videur','2022-03-25 16:01:51','2022-03-25 16:01:51'),(10,'conducteur','2022-03-25 16:01:51','2022-03-25 16:01:51');
/*!40000 ALTER TABLE `fonctions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (20,'2014_10_12_000000_create_users_table',1),(21,'2014_10_12_100000_create_password_resets_table',1),(22,'2019_08_19_000000_create_failed_jobs_table',1),(23,'2019_12_14_000001_create_personal_access_tokens_table',1),(24,'2022_03_24_107147_create_type_contrats_table',1),(25,'2022_03_24_111416_create_statuts_table',1),(26,'2022_03_24_121616_create_structures_table',1),(27,'2022_03_24_121637_create_causes_table',1),(28,'2022_03_24_131531_create_filieres_table',1),(29,'2022_03_24_131552_create_departs_table',1),(30,'2022_03_24_171019_create_personnels_table',1),(31,'2022_03_24_171020_create_fonctions_table',1),(32,'2022_03_24_171022_create_personnel_fonctions_table',1),(33,'2022_03_24_171034_create_contrats_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel_fonctions`
--

DROP TABLE IF EXISTS `personnel_fonctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personnel_fonctions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `fonction_id` bigint unsigned NOT NULL,
  `personnel_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personnel_fonctions_fonction_id_foreign` (`fonction_id`),
  KEY `personnel_fonctions_personnel_id_foreign` (`personnel_id`),
  CONSTRAINT `personnel_fonctions_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`),
  CONSTRAINT `personnel_fonctions_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel_fonctions`
--

LOCK TABLES `personnel_fonctions` WRITE;
/*!40000 ALTER TABLE `personnel_fonctions` DISABLE KEYS */;
INSERT INTO `personnel_fonctions` VALUES (2,'2000-04-11','2002-03-30',1,6,'2022-03-25 16:12:32','2022-03-25 16:12:32'),(3,'1982-11-24','2007-08-18',3,8,'2022-03-25 16:12:32','2022-03-25 16:12:32'),(4,'2001-12-15','1982-10-22',3,6,'2022-03-25 16:12:32','2022-03-25 16:12:32');
/*!40000 ALTER TABLE `personnel_fonctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personnels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naissance` date NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enfant` int NOT NULL,
  `conjoint` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `filiere_id` bigint unsigned NOT NULL,
  `depart_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personnels_filiere_id_foreign` (`filiere_id`),
  KEY `personnels_depart_id_foreign` (`depart_id`),
  CONSTRAINT `personnels_depart_id_foreign` FOREIGN KEY (`depart_id`) REFERENCES `departs` (`id`),
  CONSTRAINT `personnels_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnels`
--

LOCK TABLES `personnels` WRITE;
/*!40000 ALTER TABLE `personnels` DISABLE KEYS */;
INSERT INTO `personnels` VALUES (5,'Jackson Brakus DDS','Gwen Toy','Reid Steuber','1970-08-02','Miss Heaven O\'Reilly Jr.','Dr. Herminia Kunde','Ms. Chelsie Jerde','Jaden Wyman',4,1,'2022-03-25 16:00:47','2022-03-25 16:00:47',9,7),(6,'Quinton Graham','Velma Williamson V','Ellis Schultz II','1982-05-23','Maximo Rodriguez','Filomena Pagac','Stephan Zieme','Mr. Christ Becker',3,7,'2022-03-25 16:00:47','2022-03-25 16:00:47',1,7),(7,'Mr. Donato Hettinger','Vicky Considine','Alverta Murray','1970-02-27','Jessika Pouros Sr.','Keyon Stracke','Lelah Turcotte','Alford Rath',2,1,'2022-03-25 16:00:47','2022-03-25 16:00:47',8,8),(8,'Maximillia Dare V','Queenie Stiedemann','Queen Langworth II','1982-08-22','Tristian Stark','Owen Batz I','Zula Murazik','Mrs. Elizabeth Huels I',7,2,'2022-03-25 16:00:47','2022-03-25 16:00:47',8,1),(9,'Dr. Nathanial Block','Dr. Jimmy Collins','Dr. Mariana Haag MD','2020-04-21','Elmira Gorczany','Odell Langworth','Kobe Hyatt','Easter Pfeffer Sr.',3,3,'2022-03-25 16:00:47','2022-03-25 16:00:47',3,4),(11,'Mireille Anderson','Kaelyn Tremblay','Jerod Kerluke','1976-08-26','Dustin Kohler','Dr. Ulises Keeling','Lacey Hills II','Dr. Salma Emard',0,2,'2022-03-25 16:01:25','2022-03-25 16:01:25',1,8),(12,'Jayda Lesch','Bryana Fisher','Ms. Josefina Skiles IV','1991-12-15','Ulises Sporer','Dr. Mya Simonis DDS','Don Jones','Miss Makayla Johnson',7,8,'2022-03-25 16:01:25','2022-03-25 16:01:25',1,7),(13,'Alessia Braun','Ladarius Bartell V','Madeline Renner','1971-08-18','Elna Shields','Earline Nicolas','Janie Harvey','Michael Little',2,0,'2022-03-25 16:01:25','2022-03-25 16:01:25',9,10),(14,'Claudie Gleason Sr.','Dr. Rosalyn Kertzmann PhD','Dr. Vernice Herman V','1983-08-02','Terrence Bode','Soledad Green','Hassie Kub','Prof. Roger Paucek IV',6,5,'2022-03-25 16:01:25','2022-03-25 16:01:25',4,1),(15,'Jalen Hoeger','Dr. Delfina Armstrong','Miss Katherine Ruecker III','2003-04-29','Glenna Wilderman','Vernice Rosenbaum','Jeff McCullough','Karl Koepp',4,9,'2022-03-25 16:01:25','2022-03-25 16:01:25',4,10),(16,'Prof. Delbert Lubowitz II','Mr. Brenden Johnson','Mr. Joesph Greenfelder II','1984-08-23','Kristina Harvey','Ivory Stracke I','Dr. Ima Hudson','Dr. Keegan Dibbert Sr.',0,6,'2022-03-25 16:01:25','2022-03-25 16:01:25',1,3),(17,'Dr. Fred Hackett II','Miss Josephine Turcotte','Prof. Vincent White','1971-08-25','Elwyn Raynor II','Robyn Kulas','Skyla Bogisich II','Arielle Dickens',7,9,'2022-03-25 16:01:25','2022-03-25 16:01:25',2,5),(18,'Dr. Elmo Bauch MD','Liliana Murazik DDS','Alden White','1971-05-24','Miss Misty Swift','Helmer Smith','Miss Marquise Torp','Prof. Jan Keebler PhD',0,5,'2022-03-25 16:01:25','2022-03-25 16:01:25',3,10),(19,'Rylan Rohan','Mr. Valentin Keebler','Miss Cristal Lubowitz','1987-02-04','Annabel Cole','Fermin Reinger','Wava Marvin','Travis Renner',9,9,'2022-03-25 16:01:25','2022-03-25 16:01:25',8,7),(20,'Nedra Hermann','Ms. Aileen Romaguera DVM','Leopold Howe','1997-02-23','Ally Schoen','Julien Quitzon','Verlie Murazik','Jacinthe Walter',2,1,'2022-03-25 16:01:25','2022-03-25 16:01:25',7,3);
/*!40000 ALTER TABLE `personnels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuts`
--

DROP TABLE IF EXISTS `statuts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuts`
--

LOCK TABLES `statuts` WRITE;
/*!40000 ALTER TABLE `statuts` DISABLE KEYS */;
INSERT INTO `statuts` VALUES (1,'ouvrier','2022-03-25 16:15:23','2022-03-25 16:15:23'),(2,'employe','2022-03-25 16:15:23','2022-03-25 16:15:23'),(3,'technicien','2022-03-25 16:15:23','2022-03-25 16:15:23'),(4,'agent de maitrise','2022-03-25 16:15:23','2022-03-25 16:15:23'),(5,'cadre','2022-03-25 16:15:23','2022-03-25 16:15:23');
/*!40000 ALTER TABLE `statuts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `structures`
--

DROP TABLE IF EXISTS `structures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `structures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `structures`
--

LOCK TABLES `structures` WRITE;
/*!40000 ALTER TABLE `structures` DISABLE KEYS */;
INSERT INTO `structures` VALUES (1,'achat/transit','2022-03-25 15:33:40','2022-03-25 15:33:40'),(2,'controle de gestion','2022-03-25 15:33:40','2022-03-25 15:33:40'),(3,'laboratoire','2022-03-25 15:33:40','2022-03-25 15:33:40'),(4,'commercial','2022-03-25 15:33:40','2022-03-25 15:33:40'),(5,'Ressources humaines','2022-03-25 15:33:40','2022-03-25 15:33:40'),(6,'logistique','2022-03-25 15:33:40','2022-03-25 15:33:40'),(7,'comptabilité','2022-03-25 15:33:40','2022-03-25 15:33:40'),(8,'informatique','2022-03-25 15:33:40','2022-03-25 15:33:40'),(9,'Maintenance','2022-03-25 15:33:40','2022-03-25 15:33:40'),(10,'moulin','2022-03-25 15:33:40','2022-03-25 15:33:40');
/*!40000 ALTER TABLE `structures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_contrats`
--

DROP TABLE IF EXISTS `type_contrats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_contrats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_contrats`
--

LOCK TABLES `type_contrats` WRITE;
/*!40000 ALTER TABLE `type_contrats` DISABLE KEYS */;
INSERT INTO `type_contrats` VALUES (1,'CDD','2022-03-25 16:15:40','2022-03-25 16:15:40'),(2,'CDI','2022-03-25 16:15:40','2022-03-25 16:15:40'),(3,'Stagiaire','2022-03-25 16:15:40','2022-03-25 16:15:40'),(4,'Interimaire','2022-03-25 16:15:40','2022-03-25 16:15:40');
/*!40000 ALTER TABLE `type_contrats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'hono','hono@hono.com',NULL,'$2y$10$6JyJvGb640x/nAzKATsuFOEiwGwGyZSzr18NYOAU.md02MNCABHee',NULL,'2022-03-25 23:10:41','2022-03-25 23:10:41');
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

-- Dump completed on 2022-03-29 15:53:37
