-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: db_plgsp_audit
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name_ne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_province_id_foreign` (`province_id`),
  CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES (78,'Bhojpur',1,NULL,NULL,NULL,'भोजपुर'),(79,'Dhankuta',1,NULL,NULL,NULL,'धनकुटा'),(80,'Jhapa',1,NULL,NULL,NULL,'झापा'),(81,'Khotang',1,NULL,NULL,NULL,'खोटाङ'),(82,'Morang',1,NULL,NULL,NULL,'मोरङ'),(83,'Okhaldhunga',1,NULL,NULL,NULL,'ओखलढुंगा'),(84,'Panchthar',1,NULL,NULL,NULL,'पाँचथर'),(85,'Sankhuwasabha',1,NULL,NULL,NULL,'संखुवासभा'),(86,'Solukhumbu',1,NULL,NULL,NULL,'सोलुखुम्बु'),(87,'Sunsari',1,NULL,NULL,NULL,'सुनसरी'),(88,'Taplejung',1,NULL,NULL,NULL,'ताप्लेजुङ'),(89,'Terhathum',1,NULL,NULL,NULL,'तेह्रथुम'),(90,'Ilam',1,NULL,NULL,NULL,'इलाम'),(91,'Udayapur',1,NULL,NULL,NULL,'उदयपुर'),(92,'Dhanusha',2,NULL,NULL,NULL,'धनुषा'),(93,'Bara',2,NULL,NULL,NULL,'बारा'),(94,'Parsa',2,NULL,NULL,NULL,'पर्सा'),(95,'Rautahat',2,NULL,NULL,NULL,'रौतहट'),(96,'Siraha',2,NULL,NULL,NULL,'सिराहा'),(97,'Saptari',2,NULL,NULL,NULL,'सप्तरी'),(98,'Sarlahi',2,NULL,NULL,NULL,'सर्लाही'),(99,'Mahottari',2,NULL,NULL,NULL,'महोत्तरी'),(100,'Dolakha',3,NULL,NULL,NULL,'दोलखा'),(101,'Sindhupalchok',3,NULL,NULL,NULL,'सिन्धुपाल्चोक'),(102,'Rasuwa',3,NULL,NULL,NULL,'रसुवा'),(103,'Dhading',3,NULL,NULL,NULL,'धादिङ्ग'),(104,'Nuwakot',3,NULL,NULL,NULL,'नुवाकोट'),(105,'Kabhrepalanchok',3,NULL,NULL,NULL,'काभ्रेपलाञ्चोक'),(106,'Sindhuli',3,NULL,NULL,NULL,'सिन्धुली'),(107,'Ramechhap',3,NULL,NULL,NULL,'रामेछाप'),(108,'Makawanpur',3,NULL,NULL,NULL,'मकवानपुर'),(109,'Chitawan',3,NULL,NULL,NULL,'चितवन'),(110,'Kathmandu',3,NULL,NULL,NULL,'काठमाडौं'),(111,'Lalitpur',3,NULL,NULL,NULL,'ललितपुर'),(112,'Bhaktapur',3,NULL,NULL,NULL,'भक्तपुर'),(113,'Mustang',4,NULL,NULL,NULL,'मुस्तांग'),(114,'Myagdi',4,NULL,NULL,NULL,'म्याग्दी'),(115,'Baglung',4,NULL,NULL,NULL,'बागलुङ'),(116,'Manang',4,NULL,NULL,NULL,'मनाङ'),(117,'Kaski',4,NULL,NULL,NULL,'कास्की'),(118,'Parbat',4,NULL,NULL,NULL,'पर्वत'),(119,'Syangja',4,NULL,NULL,NULL,'स्याङ्‍जा'),(120,'East Nawalparasi',4,NULL,NULL,NULL,'नवलपरासी पूर्व'),(121,'Tanahu',4,NULL,NULL,NULL,'तनहुँ'),(122,'Lamjung',4,NULL,NULL,NULL,'लमजुङ'),(123,'Gorkha',4,NULL,NULL,NULL,'गोरखा'),(124,'East Rukum',5,NULL,NULL,NULL,'रुकुम पूर्व'),(125,'Rolpa',5,NULL,NULL,NULL,'रोल्पा'),(126,'Pyuthan',5,NULL,NULL,NULL,'प्यूठान'),(127,'Gulmi',5,NULL,NULL,NULL,'गुल्मी'),(128,'Arghakhanchi',5,NULL,NULL,NULL,'अर्घाखाची'),(129,'Palpa',5,NULL,NULL,NULL,'पाल्पा'),(130,'Nawalparasi (Bardaghar Susta West)',5,NULL,NULL,NULL,'नवलपरासी (बर्दघाट सुस्ता पश्चिम)'),(131,'Rupandehi',5,NULL,NULL,NULL,'रुपन्देही'),(132,'Kapilbastu',5,NULL,NULL,NULL,'कपिलवस्तु'),(133,'Dang',5,NULL,NULL,NULL,'दाङ्ग'),(134,'Banke',5,NULL,NULL,NULL,'बाँके'),(135,'Bardiya',5,NULL,NULL,NULL,'बर्दिया'),(136,'West Rukum',6,NULL,NULL,NULL,'रुकुम पश्चिम'),(137,'Salyan',6,NULL,NULL,NULL,'सल्यान'),(138,'Surkhet',6,NULL,NULL,NULL,'सुर्खेत'),(139,'Dailekh',6,NULL,NULL,NULL,'दैलेख'),(140,'Jajarkot',6,NULL,NULL,NULL,'जाजरकोट'),(141,'Dolpa',6,NULL,NULL,NULL,'डोल्पा'),(142,'Jumla',6,NULL,NULL,NULL,'जुम्ला'),(143,'Kalikot',6,NULL,NULL,NULL,'कालिकोट'),(144,'Mugu',6,NULL,NULL,NULL,'मुगु'),(145,'Humla',6,NULL,NULL,NULL,'हुम्ला'),(146,'Bajura',7,NULL,NULL,NULL,'बाजुरा'),(147,'Bajhang',7,NULL,NULL,NULL,'बझाङ'),(148,'Darchula',7,NULL,NULL,NULL,'दार्चुला'),(149,'Baitadi',7,NULL,NULL,NULL,'बैतडी'),(150,'Dadeldhura',7,NULL,NULL,NULL,'डडेल्धुरा'),(151,'Doti',7,NULL,NULL,NULL,'डोटी'),(152,'Achham',7,NULL,NULL,NULL,'अछाम'),(153,'Kailali',7,NULL,NULL,NULL,'कैलाली'),(154,'Kanchanpur',7,NULL,NULL,NULL,'कञ्चनपुर');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `documents_parameter_id_foreign` (`parameter_id`),
  CONSTRAINT `documents_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'पहिचान गरिएका नीति तथा कानुनको सङ्ख्यासम्बन्धी प्रतिवेदन',1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(2,'प्रतिवेदन बमोजिम निर्माण भएका नीति तथा कानुन नीतिको सङ्ख्या',1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(3,'निर्माण गर्नुपर्ने भनी पहिचान गरिएका नियमावली, कार्यविधि, निर्देशिका, मापदण्डको विवरण',2,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(4,'निर्माण भएका नियमावली, कार्यविधि, निर्देशिका, मापदण्डको विवरण',2,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(5,'सार्जजनिक निकायसँग सम्बन्धित निर्माण भएका नीतिहरूको विवरण',3,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(6,'आवधिक समीक्षा तथा नीति परीक्षण गरिएका नीतिहरूको विवरण',3,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(7,'स्वीकृत दरबन्दी',4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1),(8,'कार्यरत कर्मचारी',4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1),(9,'दरबन्दीभन्दा बढी रहेका  कर्मचारीहरुको विवरण',4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1),(10,'रिक्त पदको लोक सेवा आयोगमा माग गरिएको विवरण\r\n(लोक सेवा आयोगमा माग भएको विवरण समेतलाई पूर्ति भए सरह मान्ने)',4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedbacks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `feedback` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int unsigned DEFAULT NULL,
  `form_detail_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedbacks_user_id_foreign` (`user_id`),
  KEY `feedbacks_form_detail_id_foreign` (`form_detail_id`),
  CONSTRAINT `feedbacks_form_detail_id_foreign` FOREIGN KEY (`form_detail_id`) REFERENCES `form_subject_area_parameter` (`id`) ON DELETE CASCADE,
  CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
INSERT INTO `feedbacks` VALUES (4,'Please submit the document',0,22,21,'2023-03-22 06:38:14','2023-03-22 06:38:20');
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_subject_area`
--

DROP TABLE IF EXISTS `form_subject_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_subject_area` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int unsigned DEFAULT NULL,
  `subject_area_id` int unsigned DEFAULT NULL,
  `marks` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `marksByVerifier` decimal(8,2) DEFAULT NULL,
  `marksByAuditor` decimal(8,2) DEFAULT NULL,
  `marksByFinalVerifier` decimal(8,2) DEFAULT NULL,
  `status_verifier` int NOT NULL DEFAULT '0',
  `status_auditor` int NOT NULL DEFAULT '0',
  `status_final_verifier` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `form_subject_area_form_id_foreign` (`form_id`),
  KEY `form_subject_area_subject_area_id_foreign` (`subject_area_id`),
  CONSTRAINT `form_subject_area_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `form_subject_area_subject_area_id_foreign` FOREIGN KEY (`subject_area_id`) REFERENCES `subject_areas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_subject_area`
--

LOCK TABLES `form_subject_area` WRITE;
/*!40000 ALTER TABLE `form_subject_area` DISABLE KEYS */;
INSERT INTO `form_subject_area` VALUES (9,7,2,0.75,'2023-03-22 06:16:39','2023-03-22 06:43:44',0.75,0.75,0.00,1,1,1),(10,7,1,3.00,'2023-03-22 06:18:48','2023-03-22 06:50:18',3.00,3.00,3.00,1,1,1);
/*!40000 ALTER TABLE `form_subject_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_subject_area_parameter`
--

DROP TABLE IF EXISTS `form_subject_area_parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_subject_area_parameter` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `form_subject_area_id` int unsigned DEFAULT NULL,
  `parameter_id` int unsigned DEFAULT NULL,
  `marks` decimal(8,2) DEFAULT NULL,
  `remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `option_id` int unsigned DEFAULT NULL,
  `marksByVerifier` decimal(8,2) DEFAULT NULL,
  `marksByAuditor` decimal(8,2) DEFAULT NULL,
  `marksByFinalVerifier` decimal(8,2) DEFAULT NULL,
  `is_applicable` tinyint(1) NOT NULL DEFAULT '0',
  `reassign` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `form_subject_area_parameter_form_subject_area_id_foreign` (`form_subject_area_id`),
  KEY `form_subject_area_parameter_parameter_id_foreign` (`parameter_id`),
  KEY `form_subject_area_parameter_option_id_foreign` (`option_id`),
  CONSTRAINT `form_subject_area_parameter_form_subject_area_id_foreign` FOREIGN KEY (`form_subject_area_id`) REFERENCES `form_subject_area` (`id`) ON DELETE CASCADE,
  CONSTRAINT `form_subject_area_parameter_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `form_subject_area_parameter_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_subject_area_parameter`
--

LOCK TABLES `form_subject_area_parameter` WRITE;
/*!40000 ALTER TABLE `form_subject_area_parameter` DISABLE KEYS */;
INSERT INTO `form_subject_area_parameter` VALUES (20,9,4,0.75,NULL,14,0.75,0.75,NULL,0,0),(21,10,1,1.00,NULL,1,1.00,1.00,1.00,0,0),(22,10,2,1.00,NULL,5,1.00,1.00,1.00,0,0),(23,10,3,1.00,NULL,9,1.00,1.00,1.00,0,0);
/*!40000 ALTER TABLE `form_subject_area_parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `year` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int unsigned DEFAULT NULL,
  `verified_by` int unsigned DEFAULT NULL,
  `audited_by` int unsigned DEFAULT NULL,
  `final_verified_by` int unsigned DEFAULT NULL,
  `verified_at` date DEFAULT NULL,
  `audited_at` date DEFAULT NULL,
  `final_verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `total_marks` decimal(8,2) DEFAULT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `is_audited` int NOT NULL DEFAULT '0',
  `final_verified` int NOT NULL DEFAULT '0',
  `total_marks_verifier` decimal(8,2) DEFAULT NULL,
  `total_marks_auditor` decimal(8,2) DEFAULT NULL,
  `total_marks_finalVerifier` decimal(8,2) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forms_organization_id_foreign` (`organization_id`),
  KEY `forms_user_id_foreign` (`user_id`),
  KEY `forms_updated_by_foreign` (`updated_by`),
  KEY `forms_verified_by_foreign` (`verified_by`),
  KEY `forms_audited_by_foreign` (`audited_by`),
  KEY `forms_final_verified_by_foreign` (`final_verified_by`),
  CONSTRAINT `forms_audited_by_foreign` FOREIGN KEY (`audited_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_final_verified_by_foreign` FOREIGN KEY (`final_verified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (7,1,21,'2079/80',21,21,22,24,'2023-03-22','2023-03-22','2023-03-22','2023-03-22 06:16:39','2023-03-24 06:02:56',NULL,1,3.75,1,1,1,3.75,3.75,3.00,1,'C','खराब');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `governances`
--

DROP TABLE IF EXISTS `governances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `governances` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `governances`
--

LOCK TABLES `governances` WRITE;
/*!40000 ALTER TABLE `governances` DISABLE KEYS */;
INSERT INTO `governances` VALUES (1,'सङ्‍घ','2022-09-07 10:51:37','2022-11-09 08:57:31',NULL),(2,'प्रदेश','2022-09-07 10:51:48','2022-11-09 08:57:39',NULL),(3,'स्थानीय तह','2022-09-07 10:51:54','2022-11-09 08:57:48',NULL);
/*!40000 ALTER TABLE `governances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_permission`
--

DROP TABLE IF EXISTS `group_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_permission` (
  `group_id` int unsigned DEFAULT NULL,
  `permission_id` int unsigned DEFAULT NULL,
  KEY `group_permission_group_id_foreign` (`group_id`),
  KEY `group_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `group_permission_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `group_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_permission`
--

LOCK TABLES `group_permission` WRITE;
/*!40000 ALTER TABLE `group_permission` DISABLE KEYS */;
INSERT INTO `group_permission` VALUES (1,NULL),(1,NULL),(1,NULL),(1,NULL),(1,NULL),(2,NULL),(2,NULL),(2,NULL),(2,NULL),(2,NULL),(3,NULL),(3,NULL),(3,NULL),(3,NULL),(3,NULL),(4,NULL),(4,NULL),(4,NULL),(4,NULL),(4,NULL),(5,NULL),(6,NULL),(6,NULL),(6,NULL),(6,NULL),(6,NULL),(7,NULL),(7,NULL),(7,NULL),(7,NULL),(7,NULL),(8,NULL),(8,NULL),(8,NULL),(8,NULL),(8,NULL),(9,NULL),(9,NULL),(9,NULL),(9,NULL),(9,NULL),(10,NULL),(10,NULL),(10,NULL),(10,NULL),(11,NULL),(11,NULL),(11,NULL),(11,NULL),(11,NULL),(12,NULL),(12,NULL),(12,NULL),(12,NULL),(12,NULL),(13,NULL),(13,NULL),(13,NULL),(13,NULL),(13,NULL),(14,NULL),(14,NULL),(14,NULL),(14,NULL),(15,NULL),(15,NULL),(15,NULL),(15,NULL),(15,NULL),(16,NULL),(16,NULL),(16,NULL),(16,NULL),(16,NULL),(1,2),(1,3),(1,4),(1,5),(1,6),(2,7),(2,8),(2,9),(2,10),(2,11),(3,12),(3,13),(3,14),(3,15),(3,16),(4,61),(4,62),(4,63),(4,64),(4,65),(5,33),(6,36),(6,37),(6,38),(6,39),(6,40),(7,41),(7,42),(7,43),(7,44),(7,45),(8,46),(8,47),(8,48),(8,49),(8,50),(9,51),(9,52),(9,53),(9,54),(9,55),(10,66),(10,67),(10,68),(10,69),(15,56),(15,57),(15,58),(15,59),(15,60),(16,70),(16,71),(16,72),(16,73),(16,74),(17,80),(17,81),(17,82),(17,83),(17,84),(18,75),(18,76),(18,77),(18,78),(18,79),(11,18),(11,19),(11,20),(11,21),(11,22),(12,23),(12,24),(12,25),(12,26),(12,27),(13,28),(13,29),(13,30),(13,31),(13,32),(14,1),(14,17),(14,34),(14,85);
/*!40000 ALTER TABLE `group_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Permission','2022-04-21 04:56:01','2022-04-21 04:56:01',NULL),(2,'Role','2022-04-21 04:56:37','2022-04-21 04:56:37',NULL),(3,'User','2022-04-21 04:58:30','2022-04-21 04:58:30',NULL),(4,'Group','2022-04-21 04:58:58','2022-04-21 04:58:58',NULL),(5,'Setting','2022-04-21 04:59:25','2022-04-21 04:59:25',NULL),(6,'Subject Area','2022-04-21 05:00:15','2022-04-21 05:00:15',NULL),(7,'Parameter','2022-04-21 05:00:56','2022-04-21 05:00:56',NULL),(8,'Province','2022-04-21 05:01:43','2022-04-21 05:01:43',NULL),(9,'Organization','2022-04-21 05:02:27','2022-04-21 05:02:27',NULL),(10,'Form','2022-04-21 05:02:59','2022-04-21 05:02:59',NULL),(11,'Product Category','2022-04-21 05:04:07','2022-04-21 05:04:07',NULL),(12,'Slider','2022-04-21 05:04:43','2022-04-21 05:04:43',NULL),(13,'Popup','2022-04-21 05:05:07','2022-04-21 05:05:07',NULL),(14,'Others','2022-04-21 05:06:08','2022-04-21 05:06:08',NULL),(15,'Document','2022-04-21 05:12:00','2022-04-21 05:12:00',NULL),(16,'Type','2022-05-15 06:30:28','2022-05-15 06:30:28',NULL),(17,'Level','2022-09-07 11:05:22','2022-09-07 11:05:22',NULL),(18,'Governance','2022-09-07 11:05:59','2022-09-07 11:05:59',NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level_organization`
--

DROP TABLE IF EXISTS `level_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `level_organization` (
  `level_id` int unsigned DEFAULT NULL,
  `organization_id` int unsigned DEFAULT NULL,
  KEY `level_organization_level_id_foreign` (`level_id`),
  KEY `level_organization_organization_id_foreign` (`organization_id`),
  CONSTRAINT `level_organization_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `level_organization_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level_organization`
--

LOCK TABLES `level_organization` WRITE;
/*!40000 ALTER TABLE `level_organization` DISABLE KEYS */;
INSERT INTO `level_organization` VALUES (1,1),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,1),(2,28),(2,29);
/*!40000 ALTER TABLE `level_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `levels` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES (1,'Auditor','2022-09-07 10:52:24','2022-09-07 10:52:24',NULL),(2,'Auditee','2022-09-07 10:52:31','2022-09-07 10:52:31',NULL);
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `collection_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_document_id_foreign` (`document_id`),
  CONSTRAINT `media_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE SET NULL,
  CONSTRAINT `media_chk_1` CHECK (json_valid(`manipulations`)),
  CONSTRAINT `media_chk_2` CHECK (json_valid(`custom_properties`)),
  CONSTRAINT `media_chk_3` CHECK (json_valid(`responsive_images`))
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'App\\FormDetail',1,'documents','purchase-details (7)','0122e1e892c9fd5fe1c1ca12d2a00881.pdf','application/pdf','public',1408,'[]','[]','[]',1,'2022-09-09 04:49:02','2022-09-09 04:49:02',1),(2,'App\\FormDetail',1,'documents','purchase-details','e6d25bedcc801907078758296c109fe2.pdf','application/pdf','public',1322,'[]','[]','[]',2,'2022-09-09 04:49:02','2022-09-09 04:49:02',2),(3,'App\\FormDetail',2,'documents','purchase-details (5)','b21f10f41e97a5b07bd23fc3a7550f3f.pdf','application/pdf','public',1377,'[]','[]','[]',3,'2022-09-09 04:49:03','2022-09-09 04:49:03',3),(4,'App\\FormDetail',2,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',4,'2022-09-09 04:49:03','2022-09-09 04:49:03',4),(5,'App\\FormDetail',3,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',5,'2022-09-09 04:49:03','2022-09-09 04:49:03',5),(6,'App\\FormDetail',3,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',6,'2022-09-09 04:49:03','2022-09-09 04:49:03',6),(7,'App\\FormDetail',4,'documents','purchase-details (7)','0122e1e892c9fd5fe1c1ca12d2a00881.pdf','application/pdf','public',1408,'[]','[]','[]',7,'2022-09-09 05:48:46','2022-09-09 05:48:46',1),(8,'App\\FormDetail',4,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',8,'2022-09-09 05:48:46','2022-09-09 05:48:46',2),(9,'App\\FormDetail',6,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',9,'2022-09-09 05:48:46','2022-09-09 05:48:46',5),(10,'App\\FormDetail',6,'documents','purchase-details (5)','b21f10f41e97a5b07bd23fc3a7550f3f.pdf','application/pdf','public',1377,'[]','[]','[]',10,'2022-09-09 05:48:46','2022-09-09 05:48:46',6),(11,'App\\FormDetail',10,'documents','purchase-details (7)','0122e1e892c9fd5fe1c1ca12d2a00881.pdf','application/pdf','public',1408,'[]','[]','[]',11,'2022-09-12 07:24:27','2022-09-12 07:24:28',1),(12,'App\\FormDetail',10,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',12,'2022-09-12 07:24:28','2022-09-12 07:24:28',2),(13,'App\\FormDetail',12,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',13,'2022-09-12 07:24:28','2022-09-12 07:24:28',5),(14,'App\\FormDetail',12,'documents','purchase-details (6)','0316545e2f37de614d641ae7c08d4be5.pdf','application/pdf','public',1377,'[]','[]','[]',14,'2022-09-12 07:24:28','2022-09-12 07:24:28',6),(15,'App\\FormDetail',13,'documents','test','0412c29576c708cf0155e8de242169b1.jpg','image/jpeg','public',441821,'[]','[]','[]',15,'2022-09-12 09:17:48','2022-09-12 09:17:48',1),(17,'App\\Models\\CMS\\Slider',2,'photo','6347b7ecd24cd_Cb1','6347b7ecd24cd_Cb1.jpg','image/jpeg','public',39077,'[]','{\"generated_conversions\":{\"thumb\":true}}','[]',16,'2022-10-13 07:02:22','2022-10-13 07:02:22',NULL),(18,'App\\FormDetail',20,'documents','Front Part editcopy','96126e9734d4e52ec6e78dd8afff247e.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','public',50129,'[]','[]','[]',17,'2023-03-22 06:16:40','2023-03-22 06:16:40',NULL),(19,'App\\FormDetail',20,'documents','Front Part editcopy','96126e9734d4e52ec6e78dd8afff247e.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','public',50129,'[]','[]','[]',18,'2023-03-22 06:17:22','2023-03-22 06:17:22',NULL);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2016_06_01_000001_create_oauth_auth_codes_table',1),(3,'2016_06_01_000002_create_oauth_access_tokens_table',1),(4,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(5,'2016_06_01_000004_create_oauth_clients_table',1),(6,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(7,'2020_04_30_000001_create_media_table',1),(8,'2020_04_30_000002_create_permissions_table',1),(9,'2020_04_30_000003_create_roles_table',1),(10,'2020_04_30_000004_create_users_table',1),(11,'2020_04_30_000005_create_product_categories_table',1),(12,'2020_04_30_000008_create_permission_role_pivot_table',1),(13,'2020_04_30_000009_create_role_user_pivot_table',1),(14,'2020_04_30_000012_add_relationship_fields_to_product_categories_table',1),(15,'2021_05_19_052903_create_settings_table',1),(16,'2021_05_23_081950_create_user_other_info_table',1),(17,'2021_05_28_085032_add_sort_order_to_product_categories_table',1),(18,'2021_06_16_054546_create_sliders_table',1),(19,'2021_06_16_071701_create_popups_table',1),(20,'2021_07_13_073123_add_card_columns_to_userdetails_table',1),(21,'2022_01_12_153539_add_columns_to_settings_table',1),(22,'2022_02_13_075140_create_subject_areas_table',1),(23,'2022_02_13_105431_create_parameters_table',1),(24,'2022_02_13_110144_create_options_table',1),(25,'2022_02_14_094950_add_created_by_in_roles_table',1),(26,'2022_02_14_100013_add_created_by_in_users_table',1),(27,'2022_02_15_065604_create_organizations_table',1),(28,'2022_02_16_091705_add_shareable_colomn_to_roles_table',1),(29,'2022_02_17_060539_create_provinces_table',1),(30,'2022_02_17_060930_create_districts_table',1),(31,'2022_02_17_074533_add_province_id_to_organizations_table',1),(32,'2022_02_17_084858_create_documents_table',1),(33,'2022_02_18_071321_create_forms_table',1),(34,'2022_03_04_055846_create_form_subject_area_table',1),(35,'2022_03_08_091546_add_timestamps_to_form_subject_area_table',1),(36,'2022_03_11_073300_create_organization_user_table',1),(37,'2022_03_13_103211_create_form_subject_area_parameter_table',1),(38,'2022_03_13_160206_add_option_id_to_form_suject_area_parameter_table',1),(39,'2022_03_14_061506_create_feedbacks_table',1),(40,'2022_03_14_073516_add_status_to_forms_table',1),(41,'2022_03_20_072732_add_is_verified_to_forms_table',1),(42,'2022_03_22_060035_change_data_type_of_feedback_status',1),(43,'2022_03_23_072039_create_groups_table',1),(44,'2022_03_23_072402_create_group_permission_pivot_table',1),(45,'2022_03_29_091739_add_marks_by_verifier_to_form_subject_area_parameter_table',1),(46,'2022_03_29_101247_add_marks_by_verifier_to_form_subject_area_table',1),(47,'2022_03_29_101857_add_marks_by_verifier_to_forms_table',1),(48,'2022_03_29_114605_add_status_to_form_subject_area_parameter_table',1),(49,'2022_03_30_095916_add_status_to_subject_area_table',1),(50,'2022_03_30_103353_add_status_to_parameter_table',1),(51,'2022_03_30_111747_add_status_to_option_table',1),(52,'2022_03_30_111851_add_status_to_document_table',1),(53,'2022_03_31_055102_add_status_to_users_table',1),(54,'2022_04_12_134436_change_status_to_one_in_users_table',1),(55,'2022_04_19_081114_add_document_id_to_media_table',1),(56,'2022_04_19_115147_add_publish_to_forms_table',1),(57,'2022_03_28_103801_create_types_table',2),(58,'2022_04_27_115205_add_type_id_to_organizations_table',2),(59,'2022_04_27_133511_add_organization_id_to_organizations_table',2),(60,'2022_04_29_103228_add_status_to_form_subject_area_table',2),(61,'2022_05_09_153018_add_reassign_to_form_subject_area_parameter_table',2),(62,'2022_05_09_170514_change_data_type_of_status',2),(63,'2022_04_06_080435_create_notifications_table',3),(64,'2022_05_16_170601_change_data_type_of_status_in_forms_table',3),(65,'2022_06_10_130513_add_grade_to_forms_table',3),(66,'2022_07_01_084839_add_nep_name_in_province_table',3),(67,'2022_07_01_085823_add_nep_name_in_district_table',3),(68,'2022_09_01_164132_create_governances_table',4),(69,'2022_09_01_173052_create_levels_table',4),(70,'2022_09_02_075848_add_governance_id_to_organizations_table',4),(71,'2022_09_02_080741_create_level_organization_table',4),(72,'2022_09_04_120613_add_display_name_in_permissions_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('00875ff8-213d-4894-a79e-517a0c735fe6','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:18:55','2023-03-22 06:18:55'),('008c5a1e-8334-4b01-91aa-1fb2ccf48c60','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name Auditor Satbise by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-11-09 09:18:31','2022-11-09 09:18:31'),('0098c32d-d4cc-4f6d-958e-fe166cdf0567','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',16,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:42:31','2022-09-12 07:42:31'),('0176383e-d497-466e-b8aa-3e15156242e1','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name final by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:48:20','2023-03-22 06:48:20'),('02e00902-f4ea-48b1-8805-4d1392c6ea9a','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',11,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:50:08','2022-09-09 11:50:08'),('0392f8af-0b33-4889-9f98-8a73e55256e4','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DAO Ilam User by DAO Ilam\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:11:24','2022-09-08 12:11:24'),('03bad805-bd2a-465e-ab73-5530b2b07b84','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DAO Ilam by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 11:57:44','2022-09-08 11:57:44'),('0ae93961-f171-4750-a447-632e248eda9d','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Biratnagar by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 09:11:06','2022-09-12 09:11:06'),('0b049d8a-f934-46d3-955c-352db47789e3','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name AAO Mangalbare User by AAO Mangalbare\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:13:51','2022-09-08 12:13:51'),('0f5c4a63-4a3e-42e5-9dbb-9a83f2d220e1','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',8,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Mangalbare, Ilam<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 04:49:09','2022-09-09 04:49:09'),('0f8b5bb5-042a-4b42-8e9a-afb094adbe77','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Kodari by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 10:15:15','2022-09-12 10:15:15'),('1092eeb3-c5c4-454d-b2f1-e17f5f2b9c42','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 10:49:29','2022-09-09 10:49:29'),('16b35d7d-3e8a-4762-b20c-e0ecb81f333e','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',17,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:47','2022-09-12 09:19:47'),('173e30f8-e231-403e-8493-8a04cab7929e','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>Area Administration Office, Mangalbare, Ilam<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 04:49:03','2022-09-09 04:49:03'),('185cde8b-c4f7-4af7-ace6-25db0a6a04f7','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',11,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:40:48','2022-09-09 11:40:48'),('19fadd59-bd04-46e4-8222-59cd9a7908b2','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:13:04','2022-09-12 09:13:04'),('1f0d64a2-815f-475b-8584-c45c70cbafc6','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:41:57','2023-03-22 06:41:57'),('219c11d1-a382-4128-bc5a-b7e529fb6ed2','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:25:56','2022-09-12 07:25:56'),('22a847fe-5ab3-496f-a310-613ca9583135','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Pokhara by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 07:21:32','2022-09-12 07:21:32'),('2301968a-0b56-4451-9479-179396c14d82','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',5,'{\"message\":\"User was added with a name DAO Ilam User by DAO Ilam\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:11:24','2022-09-08 12:11:24'),('25447a7c-65ab-4f1c-bd37-0eaf9be25e20','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:47','2022-09-12 09:19:47'),('2567ca4d-16c3-4b64-9f01-dd3e57c1fa9b','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name \\u0907\\u0932\\u093e\\u0915\\u093e \\u092a\\u094d\\u0930\\u0936\\u093e\\u0938\\u0928 \\u0915\\u093e\\u0930\\u094d\\u092f\\u093e\\u0932\\u092f, \\u0938\\u093e\\u0924\\u092c\\u093f\\u0938\\u0947, \\u0928\\u0941\\u0935\\u093e\\u0915\\u094b\\u091f by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-11-09 09:08:19','2022-11-09 09:08:19'),('277f7805-05fc-421e-b332-697cc186d438','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:40:48','2022-09-09 11:40:48'),('280d7548-be4f-423e-9461-70f36ffd06d6','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Final Verifier by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-11 05:44:28','2022-09-11 05:44:28'),('2c4e8d75-6215-4528-b339-9a7c6023fec2','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}','2022-09-12 05:45:39','2022-09-09 11:50:08','2022-09-12 05:45:39'),('2dec957b-e9aa-4190-a53a-d08657b68ff5','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name final by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:48:20','2023-03-22 06:48:20'),('2f1a1f15-8d0f-4b11-acb1-e02a2615d5b6','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name Final Verifier by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-11 05:44:28','2022-09-11 05:44:28'),('2f923563-de9d-49b2-bc92-5b42b633f21a','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',12,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:50:08','2022-09-09 11:50:08'),('2fab52a2-324c-4f03-9692-357d9056a02d','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',23,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:41:57','2023-03-22 06:41:57'),('38d25348-8019-4781-9750-cffd87b58445','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',17,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:24:07','2022-09-12 09:24:07'),('3c523e43-2eec-47d0-bef5-e9ab51be75e8','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Auditor Satbise by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}','2023-03-22 05:59:18','2022-11-09 09:18:31','2023-03-22 05:59:18'),('3df84e05-2340-4b18-89d5-67c3abf27e21','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DAO Ilam by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 11:57:44','2022-09-08 11:57:44'),('40b77c80-793d-4488-a74f-5614cf4c84f6','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:24:07','2022-09-12 09:24:07'),('41067b21-662a-4d4e-9e4b-29e3fe054a93','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Mangalbare, Ilam<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 04:49:09','2022-09-09 04:49:09'),('42de1e96-ca49-410c-bc9e-0be2c7b39362','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:18:24','2023-03-22 06:18:24'),('442e3905-4bec-43b3-bd0b-6a5a39ab80f6','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:42:30','2022-09-12 07:42:30'),('46e656b8-14f9-4350-8cf4-135e7bdf2a15','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Mangalbare, Ilam<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 04:49:09','2022-09-09 04:49:09'),('47d63f07-7b78-469d-9ab8-4642e6e84cb7','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name MOHA admin by IT Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-07 11:14:54','2022-09-07 11:14:54'),('488ee27a-04ce-4d57-9012-24c96ec26efa','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name user-moha by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:22:56','2023-03-22 06:22:56'),('49765d68-d771-40a1-a51c-5f78dff08c98','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:43:46','2023-03-22 06:43:46'),('49850fea-d9ea-443f-8a0c-9d3424b3a125','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',22,'{\"message\":\"Form was auditted for organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:43:46','2023-03-22 06:43:46'),('4b1ffba4-160c-4046-8902-cfd360d446e5','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:13:04','2022-09-12 09:13:04'),('4b738986-8d16-4100-a110-d4ae0625b33d','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:41:57','2023-03-22 06:41:57'),('4c38fa8d-817c-496b-9211-fef1820bed5d','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DAO Jhapa by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 05:27:08','2022-09-09 05:27:08'),('541c0ff5-f047-460b-9213-4d56b88f5634','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:40:44','2022-09-09 11:40:44'),('541ffdb7-3d66-4963-b983-73d74c72da50','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:50:07','2022-09-09 11:50:07'),('56efaaf3-7ec6-44b0-ac64-0432099d71f4','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-11-09 09:09:05','2022-11-09 09:09:05'),('59847adb-647a-4c5c-a37a-a2119f660a89','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',17,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:03','2022-09-12 09:19:03'),('5a2e1cbf-69e2-46d3-bcc8-c15252f61b64','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name \\u0907\\u0932\\u093e\\u0915\\u093e \\u092a\\u094d\\u0930\\u0936\\u093e\\u0938\\u0928 \\u0915\\u093e\\u0930\\u094d\\u092f\\u093e\\u0932\\u092f, \\u0938\\u093e\\u0924\\u092c\\u093f\\u0938\\u0947, \\u0928\\u0941\\u0935\\u093e\\u0915\\u094b\\u091f by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}','2023-03-22 05:59:10','2022-11-09 09:08:19','2023-03-22 05:59:10'),('5d107401-bcd4-40ff-964f-674709cd5dbf','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Final Verifier by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-11 05:44:28','2022-09-11 05:44:28'),('5e479be3-7255-49a5-b340-721c571bf456','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',3,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:18:55','2023-03-22 06:18:55'),('629ca4a8-a2e5-4e42-aae5-c849eafab85c','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Rasuwa User by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-11 06:19:13','2022-09-11 06:19:13'),('6543215b-bf49-4e19-a64c-c16fa71757df','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name AAO Damak by DAO Jhapa\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 05:44:53','2022-09-09 05:44:53'),('663e01cc-ca60-45dc-b9fd-edc04a1a40f9','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DAO Jhapa by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 05:27:08','2022-09-09 05:27:08'),('6736c729-0cf7-4b90-9368-e7ce9d141898','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DOI Rasuwa User by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-11 06:19:13','2022-09-11 06:19:13'),('69cbdd42-93f2-4542-a0c2-ca4cae7f52c7','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:12:35','2022-09-12 09:12:35'),('6a76703c-f0f1-4ad0-9e6b-7db1753191f0','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:47','2022-09-12 09:19:47'),('6ecf46d6-f068-4c8d-bda9-f1f47887933f','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 10:49:09','2022-09-09 10:49:09'),('6efab988-9097-49aa-8500-4f66fd207355','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',23,'{\"message\":\"Form was auditted for organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:43:46','2023-03-22 06:43:46'),('70307e77-d7e4-4dc8-890f-23fb0fbf9788','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:43:39','2022-09-12 07:43:39'),('705185a0-85c4-4d24-bf04-95dbaf40f5ea','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:42:30','2022-09-12 07:42:30'),('71e8d22d-e2a4-4a22-86bc-36d3459a1db0','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',22,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:41:57','2023-03-22 06:41:57'),('71f4d207-6752-4891-9b4f-5a915782afec','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Auditor Satbise by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}','2023-03-22 05:59:22','2022-11-09 09:18:31','2023-03-22 05:59:22'),('7212db60-6b80-41be-988c-1d818343d166','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 10:49:09','2022-09-09 10:49:09'),('74e1dc51-90e1-4ae3-a524-083ee4e9a618','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:44:50','2022-09-12 07:44:50'),('766b01e1-d646-439d-a588-133e0c3ad3f5','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',4,'{\"message\":\"User was added with a name DOI Pashupatinagar by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 11:40:07','2022-09-09 11:40:07'),('76a74e08-3569-44cb-8f69-213c372cc697','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',13,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:47','2022-09-12 09:19:47'),('77ab9c53-b615-4337-b4a9-a18a542553fe','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',16,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:43:39','2022-09-12 07:43:39'),('77fb4fbd-b91c-498c-abdd-d4551a273c18','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name final by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:48:20','2023-03-22 06:48:20'),('79298754-ec6e-4a23-8823-0195ffee01e8','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:25:56','2022-09-12 07:25:56'),('7a3fd576-80a7-4271-8ec4-92322a612428','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:18:15','2022-09-12 09:18:15'),('7ac9e194-4669-4d30-94e1-2f5cd31e1642','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',10,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 10:49:29','2022-09-09 10:49:29'),('7eb86d13-2773-43ea-95f6-1ef78ae3d2c9','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',3,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:41:57','2023-03-22 06:41:57'),('808c360e-90f7-4296-b8e0-6f2353c4dec9','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name MOHA admin by IT Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-07 11:14:54','2022-09-07 11:14:54'),('814639dc-d37d-404e-8ad6-c33aba9cf1cf','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Biratnagar by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 09:11:06','2022-09-12 09:11:06'),('899a995b-52f4-46ca-81d9-a89f70b9e6da','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name AAO Mangalbare by DAO Ilam\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:08:21','2022-09-08 12:08:21'),('8dcfd9c3-bbcd-4eb8-9df2-23bb74081b03','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:18:15','2022-09-12 09:18:15'),('8e2661d8-4788-48e3-833e-76893c8e083f','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',16,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:25:56','2022-09-12 07:25:56'),('8e53f617-95d4-4fd3-9797-46b2cb6801f3','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:44:50','2022-09-12 07:44:50'),('92ba4cf6-114b-4003-8630-be3c6cddfb39','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:18:24','2023-03-22 06:18:24'),('9402b406-ab9d-4219-a0ae-297f39a1ffb1','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DOI Biratnagar by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 09:11:06','2022-09-12 09:11:06'),('966dd291-8d6e-4460-bbba-c6ecc3fb7d12','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',17,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:13:04','2022-09-12 09:13:04'),('9a20301b-13d6-4d0b-b9c4-ff69720df873','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',21,'{\"message\":\"Form was auditted for organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:43:46','2023-03-22 06:43:46'),('9a953332-7111-48ae-81b8-199678a046b8','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name auditor by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:22:00','2023-03-22 06:22:00'),('9b6d7a32-def7-4817-a383-645319d54d8e','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name Auditor by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 11:47:02','2022-09-09 11:47:02'),('9c54ab16-ff76-4100-b9ea-00ac476690d8','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Pokhara by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 07:10:04','2022-09-12 07:10:04'),('9e1b0f6d-4c79-4215-bdb8-c9490d4c9a2e','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:40:48','2022-09-09 11:40:48'),('9f479bb3-6767-4488-9ba1-fe4885c7106f','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Kodari by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 10:15:15','2022-09-12 10:15:15'),('a0a7537f-9bb2-4e37-bed5-b6b1dcedec60','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DOI Pashupatinagar by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 11:40:07','2022-09-09 11:40:07'),('a1b83111-f365-46c9-8655-734f9ba8a624','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name AAO Mangalbare by DAO Ilam\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:08:21','2022-09-08 12:08:21'),('a1f899ca-1772-484b-afa2-422ea8c79109','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',6,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Mangalbare, Ilam<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 04:49:09','2022-09-09 04:49:09'),('a24f2682-0724-4791-a479-bd9c3c928bf8','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:42:30','2022-09-12 07:42:30'),('a2a555f9-be3a-4bb5-884e-f9f0e8f5d4e6','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:03','2022-09-12 09:19:03'),('a2e6dc4c-dbb9-4880-bdb2-c33f891ca81a','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was submitted for verification by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 10:49:29','2022-09-09 10:49:29'),('a3867263-3b7c-4d3b-8174-8d95b547832d','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Bikash by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:13:19','2023-03-22 06:13:19'),('a54b34e0-29f7-4f26-a910-71ca99721b82','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name user-moha by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:22:56','2023-03-22 06:22:56'),('a6683056-d250-4e02-8ba3-3f7edd29f7dd','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',3,'{\"message\":\"Form was auditted for organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:43:46','2023-03-22 06:43:46'),('a6b42bae-515b-4ec5-960c-07455eb7ccc7','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:43:46','2023-03-22 06:43:46'),('a6eb60ca-e531-4f87-83a2-fc2ab6b71b41','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',4,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:50:08','2022-09-09 11:50:08'),('a88382fe-c8b8-4870-bd42-1e1506ac5796','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',17,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:18:15','2022-09-12 09:18:15'),('aa71ac0c-d84e-4cba-a6e0-bfab6b0c32ab','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name auditor by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:22:00','2023-03-22 06:22:00'),('acb89c64-a031-4403-b3cb-fd90694f8cb1','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}','2022-10-10 11:19:50','2022-09-12 09:18:15','2022-10-10 11:19:50'),('ae63cde1-bddd-4143-972a-58edc64bc821','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:27:23','2022-09-12 09:27:23'),('afe396d6-66d0-48ee-a8f9-e1627f451872','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:18:55','2023-03-22 06:18:55'),('b1d2593c-6b72-4355-91cd-f6ebc208a5ee','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:44:50','2022-09-12 07:44:50'),('b25b0448-3523-4e50-8040-032b7a7a87a9','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name Bikash by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:13:19','2023-03-22 06:13:19'),('b2ca0f2d-fec5-4d56-9888-d35ba0696623','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 05:48:46','2022-09-09 05:48:46'),('b34a82f6-c0f5-4ed6-8bb0-8eb4f6557209','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:24:07','2022-09-12 09:24:07'),('b663bfcc-2a1b-4611-8e1a-5e33c748007e','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>Area Administration Office, Damak<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 05:48:46','2022-09-09 05:48:46'),('b8c4c9fe-b3a4-4010-8da4-8afd00edf128','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Pokhara by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 07:21:32','2022-09-12 07:21:32'),('b97f4652-c56f-4ff3-a605-3991fa0273fe','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Bikash by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:13:19','2023-03-22 06:13:19'),('badf7925-b050-4463-b444-4a4b35a0b1c3','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name MOHA admin by IT Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-07 11:14:54','2022-09-07 11:14:54'),('bb7786e1-eb52-4816-9978-1fb3adb0c568','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DOI Pokhara by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 07:10:04','2022-09-12 07:10:04'),('bc462b30-9595-43ae-aa39-bd3246c41a26','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name user-moha by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:22:56','2023-03-22 06:22:56'),('bcedcd08-4077-4608-b99c-edae5ec95fbf','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:03','2022-09-12 09:19:03'),('c231a3a8-69fa-49d0-9aa5-9ec9024af32e','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',9,'{\"message\":\"User was added with a name AAO Damak by DAO Jhapa\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 05:44:53','2022-09-09 05:44:53'),('c5489f0a-313e-43a9-bf88-17d787b49c8c','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Pashupatinagar by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 11:40:07','2022-09-09 11:40:07'),('ca3acfe3-eadc-43c7-a059-a7d2b682c7f4','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',13,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:27:23','2022-09-12 09:27:23'),('cbfba382-27bf-4f47-bc13-379bb1efa90d','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name \\u0907\\u0932\\u093e\\u0915\\u093e \\u092a\\u094d\\u0930\\u0936\\u093e\\u0938\\u0928 \\u0915\\u093e\\u0930\\u094d\\u092f\\u093e\\u0932\\u092f, \\u0938\\u093e\\u0924\\u092c\\u093f\\u0938\\u0947, \\u0928\\u0941\\u0935\\u093e\\u0915\\u094b\\u091f by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-11-09 09:08:19','2022-11-09 09:08:19'),('cd5ebd24-bdff-46b9-8636-7ca3fc16dbd8','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',4,'{\"message\":\"User was added with a name DAO Jhapa by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 05:27:08','2022-09-09 05:27:08'),('cda2b857-2326-4e0f-ba2a-27c327444073','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:43:39','2022-09-12 07:43:39'),('cefd31dc-bec5-41da-9c89-61c15ce4cb65','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',13,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:18:15','2022-09-12 09:18:15'),('cf4657be-1d62-4199-b56e-0b87288b5109','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',21,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:18:55','2023-03-22 06:18:55'),('d17aca8b-fc21-47fb-b8d8-8948ad5d9e57','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:47','2022-09-12 09:19:47'),('d359d58e-b8bf-40a4-a705-84311b9e2494','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:25:56','2022-09-12 07:25:56'),('d3b47d27-644b-468c-b909-51404fd973f5','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"New form was created by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:24:28','2022-09-12 07:24:28'),('dae670db-12cb-4389-8b3f-d101c30e313d','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DOI Kodari by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 10:15:15','2022-09-12 10:15:15'),('dcb37fad-27ea-4dbf-85c9-cc8c855a7515','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',16,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:44:50','2022-09-12 07:44:50'),('dec8d499-952a-41fc-adfb-cb32f9730130','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',4,'{\"message\":\"User was added with a name DAO Ilam by MOHA admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 11:57:44','2022-09-08 11:57:44'),('e100cb8d-4817-4cf1-9196-8f9cfc5cf738','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',13,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:03','2022-09-12 09:19:03'),('e102e867-ef80-4aef-8fd8-f76929f0f1e2','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name AAO Damak by DAO Jhapa\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 05:44:53','2022-09-09 05:44:53'),('e1ca6274-5478-4885-b26f-8d22b783fc4e','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:43:39','2022-09-12 07:43:39'),('e1cbd9e0-f907-4c4e-9345-4f11b582d9e1','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>Department of Immigration, Pashupatinagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 11:40:44','2022-09-09 11:40:44'),('e2ec9ace-dc8a-4d9d-a2f8-658336aa4994','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-11-09 09:09:05','2022-11-09 09:09:05'),('e4082d34-f409-406e-ade3-5bd5f4fc97ff','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',21,'{\"message\":\"New form was submitted for verification by organization : <b>\\u0917\\u0943\\u0939 \\u092e\\u0928\\u094d\\u0924\\u094d\\u0930\\u093e\\u0932\\u092f<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2023-03-22 06:41:57','2023-03-22 06:41:57'),('e5020b27-456e-4440-b617-825a5323d151','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Auditor by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 11:47:02','2022-09-09 11:47:02'),('e5c6e35d-219c-4417-8636-a389c3f666b6','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DAO Ilam User by DAO Ilam\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:11:24','2022-09-08 12:11:24'),('e74b6f25-2145-4015-9322-31b57866ea96','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name Auditor by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-09 11:47:02','2022-09-09 11:47:02'),('e74e23a2-e11b-4b0f-9193-09384544cedb','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',5,'{\"message\":\"User was added with a name AAO Mangalbare by DAO Ilam\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:08:21','2022-09-08 12:08:21'),('e789ba37-5486-46f4-9671-350ecc502a5e','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',13,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:24:07','2022-09-12 09:24:07'),('e9afad31-023d-4725-9ce2-f79e2635c4b3','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:27:23','2022-09-12 09:27:23'),('eadb0b1c-de68-4aa0-b1e3-08b1d07c077d','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name auditor by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2023-03-22 06:22:00','2023-03-22 06:22:00'),('eaf712ea-94cd-4523-8635-3810fdb61b49','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>Department of Immigration, Pokhara<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 07:24:28','2022-09-12 07:24:28'),('edc5a1db-fff2-4096-82ba-08250a31e4c2','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:12:35','2022-09-12 09:12:35'),('ee5b135b-a2b1-44a0-8f35-ed5576ecdf1f','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',17,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:27:23','2022-09-12 09:27:23'),('eea558ca-42c4-4ecc-bed1-ac0a8208cf09','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',1,'{\"message\":\"User was added with a name DOI Pokhara by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 07:21:32','2022-09-12 07:21:32'),('f39bf589-d08b-4c94-a2e4-7137a75c7677','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',6,'{\"message\":\"User was added with a name AAO Mangalbare User by AAO Mangalbare\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:13:51','2022-09-08 12:13:51'),('f79d2db8-dfbe-4920-99f6-693bfe26d9ab','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Pokhara by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-12 07:10:04','2022-09-12 07:10:04'),('f90f12f9-4899-4a5b-a806-c4494015c195','App\\Notifications\\FormCreatedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"New form was created by organization : <b>Area Administration Office, Mangalbare, Ilam<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-09 04:49:03','2022-09-09 04:49:03'),('fa543231-045f-4aa3-bc66-cbda86e0552e','App\\Notifications\\FormSubmittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"New form was submitted for verification by organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:19:03','2022-09-12 09:19:03'),('fa90f5e2-b3f7-495a-9fd1-10b5589c8087','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',15,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:27:23','2022-09-12 09:27:23'),('feb2c33a-487f-42fd-a8cd-e561f0897722','App\\Notifications\\FormAudittedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"Form was auditted for organization : <b>Department of Immigration, Biratnagar<\\/b> for year 2079\\/80\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/forms\"}',NULL,'2022-09-12 09:24:07','2022-09-12 09:24:07'),('ff5acdd1-4ee4-4764-8257-2f5f275aee9c','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name AAO Mangalbare User by AAO Mangalbare\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-08 12:13:51','2022-09-08 12:13:51'),('ff64598c-9bfc-443d-bdc8-2d0e1f693d1b','App\\Notifications\\UserAddedNotification','App\\Models\\Authorization\\User\\User',2,'{\"message\":\"User was added with a name DOI Rasuwa User by Admin\",\"url\":\"http:\\/\\/maudit.mofaga.gov.np:8050\\/admins\\/users\"}',NULL,'2022-09-11 06:19:13','2022-09-11 06:19:13');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('00790b4081881d74e4a1042f8042ca5d6c7ddbea12922cc771d2903d3797af16420a6e846f391aa6',1,1,'authToken','[]',0,'2022-11-15 04:39:51','2022-11-15 04:39:51','2023-11-15 10:24:51'),('0133cbcd7b2c6b9199603d8d5380bb7557ee18f65310e1e70f5a83fcc91fd4cefe8a700276934a68',1,1,'authToken','[]',0,'2022-10-20 10:54:46','2022-10-20 10:54:46','2023-10-20 16:39:46'),('028ab9290b41fd40d1be44bf77ab2d46ad9b4bfbccb039b322c135462bb7fa6477c23ee5dfe4aeb9',1,1,'authToken','[]',0,'2022-09-09 10:03:44','2022-09-09 10:03:44','2023-09-09 15:48:44'),('02c5a2dd8c79a35f073e15e7ccf48933269977ff15e3f0287f4008b432e2f329d6a87ba6c18b5c51',1,1,'authToken','[]',0,'2022-09-07 10:56:46','2022-09-07 10:56:46','2023-09-07 16:41:46'),('0347f4c48c7043e3191cb32f74712bd8556382f6fc97c2074b020f2469966daaa0c9e88ab8bd0e5d',2,1,'authToken','[]',0,'2022-07-01 09:40:03','2022-07-01 09:40:03','2023-07-01 15:25:03'),('0570a2887a5f1feac7ee041019c7bdca68a896cf9203e8c72ced70775ea44b468e348a91241c6ff9',2,1,'authToken','[]',0,'2022-06-23 10:54:40','2022-06-23 10:54:40','2023-06-23 16:39:40'),('06a215f5fe7c7c11d41115d15c57edaf6b72693a5bad2df2c269b9803a75d3f11003cb50da3f9784',8,1,'authToken','[]',1,'2022-09-11 05:22:51','2022-09-11 05:22:51','2023-09-11 11:07:51'),('08ab6edd720c70f97e5e313950201edda063892781c25ce6ee06468b2942f7286ce60808a43eadef',2,1,'authToken','[]',0,'2022-06-26 06:03:36','2022-06-26 06:03:36','2023-06-26 11:48:36'),('0aeb0bb4e43ca90eece5fb987e863f193b68af162160ebb74ce4df425d737cb334a31523fb59216b',12,1,'authToken','[]',0,'2022-09-09 11:48:48','2022-09-09 11:48:48','2023-09-09 17:33:48'),('0b4be9c124c9ba1b8602504a2dc330d7427c36fcc76064a766943029f505213691d94e853903f1e7',2,1,'authToken','[]',0,'2022-10-19 06:48:21','2022-10-19 06:48:21','2023-10-19 12:33:21'),('0b63eb89e4dc8fe24114266f43f566cf374faa42772e23266aec77531dd4e662f935e88492da6866',2,1,'authToken','[]',0,'2022-06-27 17:41:02','2022-06-27 17:41:02','2023-06-27 23:26:02'),('127d4cb0c1202f9f2e41c99cc95ad0bced7f34864b2408634e513a5a087515de0bc0f20c48616ec7',21,3,'authToken','[]',1,'2023-03-22 06:39:44','2023-03-22 06:39:44','2024-03-22 12:24:44'),('135102066cb607f11059904c91b8fa75ad741ac4fca1d4b5dab63505b4a259b8c660b53988d7ab03',2,1,'authToken','[]',0,'2022-10-09 09:08:26','2022-10-09 09:08:26','2023-10-09 14:53:26'),('1386d66c644fac21b6f06343d0339372daa71f9080203a90b86c96a9ba367112fe3ef4ab349d7322',2,1,'authToken','[]',0,'2022-10-11 06:19:46','2022-10-11 06:19:46','2023-10-11 12:04:46'),('13af4aa033e75ca35ced598b9b9737cc547c54ef4d08e93da914a07b6263f0e6db8cd22570c3f4ca',1,3,'authToken','[]',0,'2023-03-22 05:54:19','2023-03-22 05:54:19','2024-03-22 11:39:19'),('14dc13fae53a7360dc741cca8fcb46b7daec144fce7f38415d5ac63f9a2b4b9abfaac75c066c7940',7,1,'authToken','[]',1,'2022-09-11 05:33:25','2022-09-11 05:33:25','2023-09-11 11:18:25'),('163e3f0a99ecc01093dec01f67dabb592ce64f1d15dad11554d6b488bc1a63c887f8e14960c9ee92',1,3,'authToken','[]',0,'2023-03-22 05:33:25','2023-03-22 05:33:25','2024-03-22 11:18:25'),('173e13a76932ed97a435ce80abe957b960474b73fdf02b18e17265726a72e89332ef527905eadcda',9,1,'authToken','[]',0,'2022-09-09 09:53:02','2022-09-09 09:53:02','2023-09-09 15:38:02'),('175ebf1a5cc0074888af18fe663e7774d460f3a147f1574de4d223bca2ba9a57ec58c2b7f12326ac',2,1,'authToken','[]',1,'2022-06-26 07:01:23','2022-06-26 07:01:23','2023-06-26 12:46:23'),('1883e987c66d37525b285f72e691885197fd9b488c18bbadbc30a479c1e7f4dd9e6e388b0a9cc339',2,1,'authToken','[]',0,'2022-06-27 09:54:41','2022-06-27 09:54:41','2023-06-27 15:39:41'),('197514a2a968129dd75350512d34d0ee460139171e1dba8b6b6f951e02b2ee1b806dc342df17f045',5,1,'authToken','[]',1,'2022-09-09 11:21:18','2022-09-09 11:21:18','2023-09-09 17:06:18'),('1a1f9a45ce145515e2f4331becae646bb6fffd5a1690dca04fd952b621133e00da900e15d5fbcf82',7,1,'authToken','[]',1,'2022-09-11 05:31:50','2022-09-11 05:31:50','2023-09-11 11:16:50'),('1a9b518960d4f8ddc2f33bb0a555f6574331a1370f98aa543cd7f28faa231071d79fd6db1f6f106c',5,1,'authToken','[]',0,'2022-09-09 04:52:05','2022-09-09 04:52:05','2023-09-09 10:37:05'),('1ac79ee22695004f38914bca9c4b1b4c7ebd5f66f1301b199ff015d9826a7a953d892ab7deac1e2c',2,1,'authToken','[]',0,'2022-06-26 06:04:04','2022-06-26 06:04:04','2023-06-26 11:49:04'),('1e2ff4824bdb57e1dd506f010296183ce50875a3131e4e915b077bb640ec58fd2876ba4554585c36',2,1,'authToken','[]',0,'2022-06-23 10:53:03','2022-06-23 10:53:03','2023-06-23 16:38:03'),('23561ff500e927480ebd5b60b9e634403916ebcbca32f0876bfc6e3e7d526ca6347d69f8e48390b0',1,1,'authToken','[]',0,'2022-09-08 12:10:09','2022-09-08 12:10:09','2023-09-08 17:55:09'),('28e6b03478641344024304cc31d571c5c5b9e2a48a785eebb58160686c3c440c8fa78a073419cf13',2,1,'authToken','[]',0,'2022-09-09 06:19:05','2022-09-09 06:19:05','2023-09-09 12:04:05'),('2922f391decd87e0cb8a7b35a346f942182c1256e32b0748c9220003a6cf7b1d450ceee12f0cdb70',2,1,'authToken','[]',0,'2022-06-26 07:07:25','2022-06-26 07:07:25','2023-06-26 12:52:25'),('296776c13005b11331d4d38c0c2d2a0e3aa16b7c3fa24e2039975c17447682fbcac636d045fb557b',2,1,'authToken','[]',0,'2022-09-11 05:34:17','2022-09-11 05:34:17','2023-09-11 11:19:17'),('29ad34a0239679088d52edfc72c6df7b5b9e794678c6188d7547e3db27d8fe23a5ffe689df8bd29d',16,1,'authToken','[]',1,'2022-09-12 07:22:14','2022-09-12 07:22:14','2023-09-12 13:07:14'),('2a3da8a0ca0da9642afc2c33b29fc3df6c138f55b35d9a665cf49040139b233663c92ca212517f69',2,1,'authToken','[]',0,'2022-09-12 04:55:53','2022-09-12 04:55:53','2023-09-12 10:40:53'),('2ab28a8f451acfebdb5cc21e1e6dda4de53456c1cd0f687afd68685594569347a0923ea631aadfb4',2,1,'authToken','[]',0,'2022-09-12 02:31:05','2022-09-12 02:31:05','2023-09-12 08:16:05'),('2d1bd4241a2c415d0f5fee3046dd68353f15b3628ed964ac902b67c8e4c3545cf3fd4739346448f6',19,1,'authToken','[]',1,'2022-11-09 09:08:41','2022-11-09 09:08:41','2023-11-09 14:53:41'),('2e6500b6cedf6a304d12fe1fb1a1c483da95f754a8e2fc9854820939fe0179cedd3cc1de9810fe9d',2,1,'authToken','[]',0,'2022-09-12 05:44:03','2022-09-12 05:44:03','2023-09-12 11:29:03'),('2ef18640124e08845b5249b03ecaa57100a169adb61b81b17596326531fb2fe680cc9df813f24250',9,1,'authToken','[]',0,'2022-09-14 07:17:56','2022-09-14 07:17:56','2023-09-14 13:02:56'),('2f369d542bba970d2eb9f1adf2fe3e2d572e57a4bcad4c67fa83fc5166048afaf753acebbdfa13ff',19,1,'authToken','[]',0,'2022-11-09 09:24:46','2022-11-09 09:24:46','2023-11-09 15:09:46'),('332377f118ef8cdb4bcb3b2d157052b0a1a3dce9ec58db187518ae1da8ffd9e1b18c798779f4d916',4,1,'authToken','[]',0,'2022-09-09 11:36:26','2022-09-09 11:36:26','2023-09-09 17:21:26'),('33ed7f5acdbcecced22e0906fcbc6bc3649fa319eddd143de3e99abe7342351aae3c33c1b0adf218',4,1,'authToken','[]',0,'2022-09-09 05:25:46','2022-09-09 05:25:46','2023-09-09 11:10:46'),('33f98211522c58f0e3a0afaa1b73de05ee2221655e19e9d3daaf9110416b6d8a0078b8e615c65220',2,1,'authToken','[]',0,'2022-10-20 11:11:03','2022-10-20 11:11:03','2023-10-20 16:56:03'),('34afdb8d7f60fd8d6f0745acbb74fbcb2922a0bf14ca435f8030c677faca5352ff232352e95a98ca',2,1,'authToken','[]',1,'2022-06-27 06:24:02','2022-06-27 06:24:02','2023-06-27 12:09:02'),('3857f1f6fbeb208a935e2f452761fdbf5ec84555366284b133b0f423770a5b960e6caa7cc17da3d1',14,1,'authToken','[]',1,'2022-09-11 06:19:33','2022-09-11 06:19:33','2023-09-11 12:04:33'),('3da42334cbb5d5944eda9a8d2d7b340ba86d1757029a35c3096ff40363d27063491afb704bd85e2f',4,1,'authToken','[]',0,'2022-09-12 07:27:36','2022-09-12 07:27:36','2023-09-12 13:12:36'),('3e5a01a1622c3cc3b61670aaaa018dc1418b8ce0a4088ceb3b3aafd6240be888211d1e59b9546562',2,1,'authToken','[]',0,'2022-09-11 06:28:12','2022-09-11 06:28:12','2023-09-11 12:13:12'),('3e83884541a7b7144922db75da326c0e69d591dcd517015278763f42578126ea47d064e6f0373ef8',2,1,'authToken','[]',0,'2022-11-09 05:09:26','2022-11-09 05:09:26','2023-11-09 10:54:26'),('3fa95fa2a86f542263bd698d4256cce2e0cba5e9c7fed1059fa52924b914868289564fbbef3f71a2',2,1,'authToken','[]',0,'2022-10-19 05:14:03','2022-10-19 05:14:03','2023-10-19 10:59:03'),('453ac3893677587099fab2770a99d622e69d62ac50f55268541a131f47ff43a3422bbaffa0b87d1a',2,1,'authToken','[]',0,'2022-06-27 17:39:05','2022-06-27 17:39:05','2023-06-27 23:24:05'),('4684f8a0f8260cc8bf9085b19d4699a35216a1ecd4d46de3be1936e147e6e074c214074655a63342',2,1,'authToken','[]',0,'2022-06-26 07:00:44','2022-06-26 07:00:44','2023-06-26 12:45:44'),('48fcfe920317ad4400ac7a482cc9108b885b3a11681d4a9db3a5e7675033ee6c7b86e6a2eaa7dff5',2,1,'authToken','[]',0,'2022-10-09 07:10:10','2022-10-09 07:10:10','2023-10-09 12:55:10'),('4ab35059c1b8a6ca49181125073406f42f90d720e181a61671255dd649985620505f7db7a9b03db5',5,1,'authToken','[]',1,'2022-09-11 05:35:26','2022-09-11 05:35:26','2023-09-11 11:20:26'),('4ae04d2a4e45db38083bc740622be98f0d62ceb7f8cded41ea0d889180cfd5cbbd680d7dc7a950bf',5,1,'authToken','[]',0,'2022-09-09 11:04:16','2022-09-09 11:04:16','2023-09-09 16:49:16'),('4cb0cc9fdb9a272e5319ca73fa09f22d4ed7ac87364386a7e8e30f58955cae73d1bd799f717c730f',2,1,'authToken','[]',1,'2022-09-09 10:23:12','2022-09-09 10:23:12','2023-09-09 16:08:12'),('4cc4a40bd3bc73682923a15dbb760324ffe2f56ce16cd83f83b60b941aa99a938ea61a7f01e02cd0',2,1,'authToken','[]',0,'2022-09-09 11:45:55','2022-09-09 11:45:55','2023-09-09 17:30:55'),('4e7217dd3209e59532358d88b5e102aeecf9cd0ade26dbb35edc6671a590194b2240bc3ad443a0d5',2,1,'authToken','[]',0,'2022-09-11 08:03:31','2022-09-11 08:03:31','2023-09-11 13:48:31'),('4ec911f74b5f0b8324eea057b6b46b5560fe04c271121c9ecea24b957c3631f815458074689e86da',1,1,'authToken','[]',0,'2022-09-08 10:03:28','2022-09-08 10:03:28','2023-09-08 15:48:28'),('4fe814684c58a1936bf92ae8324e03da8e338554b923369228b46b52d57ab293187a71010b6541ec',2,1,'authToken','[]',0,'2022-10-18 09:43:21','2022-10-18 09:43:21','2023-10-18 15:28:21'),('516da90c1996da5ea46f7470c46e14d71df4d9d4b183647376ebf5bd038c306de8c7dc556f199063',2,1,'authToken','[]',0,'2022-09-20 06:16:34','2022-09-20 06:16:34','2023-09-20 12:01:34'),('52774275693d2905f4934345ba18a6dba127f9e6bc45d76feafc5542c428a7a08eec34f5e1564a2b',1,3,'authToken','[]',0,'2023-03-24 06:00:16','2023-03-24 06:00:16','2024-03-24 11:45:16'),('52ff918fdc43aaae1e26125a66cddb216da33cb27b311055583d49efad7c3920fdd710fb8b7c07d0',2,1,'authToken','[]',0,'2022-09-09 05:55:03','2022-09-09 05:55:03','2023-09-09 11:40:03'),('534dd440c05cd531164748baca65358412a28b839ede51717085a4d2bbcf8cbf440b18f0cc4a30d3',20,1,'authToken','[]',0,'2022-11-09 09:18:45','2022-11-09 09:18:45','2023-11-09 15:03:45'),('54c0ed95f8530e95307a43dcd21036e767ef161a5dc78add20ffab7efaa1beb995dc040df2280fad',19,1,'authToken','[]',1,'2022-11-09 09:19:24','2022-11-09 09:19:24','2023-11-09 15:04:24'),('5554784ab2242d05c71ac9419b2f78ca19785cf6f442c6e3e05d742fef13f63f81eb85c7bd1ec36d',2,1,'authToken','[]',0,'2022-09-08 09:28:39','2022-09-08 09:28:39','2023-09-08 15:13:39'),('5690d822b2f2ca859c93ba47419e2bbbe47b5a7b6c10d88facd26de4a6a1ed402e9a98a6e4ea22ec',2,1,'authToken','[]',0,'2022-10-11 04:32:32','2022-10-11 04:32:32','2023-10-11 10:17:32'),('578c68d8b518ab5f5c454b293e9a04c7574b3492caa27565ca98dba0ec7db4ae9fe43be2a08dc225',2,1,'authToken','[]',0,'2022-06-30 06:53:50','2022-06-30 06:53:50','2023-06-30 12:38:50'),('57a9578475da2feff5a68cdafc755560feed785bf1dfea82043e70a92dfe961f31a913bcf4423d9c',10,1,'authToken','[]',0,'2022-09-09 10:44:45','2022-09-09 10:44:45','2023-09-09 16:29:45'),('580f26e68b0b4b84bfa08f41b062f4d2fa6d7471d3ca2d9a3caf0380822057db0d7a3d36ac7ee465',2,1,'authToken','[]',0,'2022-10-11 10:06:23','2022-10-11 10:06:23','2023-10-11 15:51:23'),('58bc127e90f08b1095a5d902741732513720f8c68f7efad5965b8294fa7e0247a0f14df10d506410',9,1,'authToken','[]',0,'2022-09-14 07:37:48','2022-09-14 07:37:48','2023-09-14 13:22:48'),('5a8811c951f6ccc174f17ad95511e19a60f2ae9620788ac50a7cf566085cdc8fcc244c04bbcad1a4',1,1,'authToken','[]',0,'2022-09-09 11:32:05','2022-09-09 11:32:05','2023-09-09 17:17:05'),('5aab617dbf6a4ef5c4cfef94a5da7753082ae515bf60872b023de417bbc90ca9057ccfb7ebdc4b47',2,1,'authToken','[]',0,'2022-09-06 05:00:21','2022-09-06 05:00:21','2023-09-06 10:45:21'),('5b127b6b0bebf486912033ededd7cbabfd5254c992d6efef09b2481cb7ada5c49317ecc809d253e1',8,1,'authToken','[]',1,'2022-09-11 05:33:52','2022-09-11 05:33:52','2023-09-11 11:18:52'),('5ccadfde30a232feed1e78e322a504fbf4cd91cf1c2839bfd64223d14fd928fa6dc6e2944ea9f5b0',2,1,'authToken','[]',0,'2022-10-10 11:07:49','2022-10-10 11:07:49','2023-10-10 16:52:49'),('5df812edec73144274ee71a25e36e2fa48ef557dbd5e199a6d396619276825f73e0c949753f021cd',2,1,'authToken','[]',0,'2022-09-05 06:42:23','2022-09-05 06:42:23','2023-09-05 12:27:23'),('5f2ebe60761a219f961a01d9e467797274ce0fce3e57fcd0b11070e5090c88638716efe1e290552b',2,1,'authToken','[]',0,'2022-10-20 11:16:55','2022-10-20 11:16:55','2023-10-20 17:01:55'),('6007123031505540672b4043d33e73772e3a48ea9859373c2dd305d6b5891f0c57dfe06adc75435b',13,1,'authToken','[]',0,'2022-09-11 06:49:13','2022-09-11 06:49:13','2023-09-11 12:34:13'),('60b7418eae2db22e245d9effc93db2f7513053303c46d8b45ab9579d39df090f4a3ace0f1e73c63a',2,1,'authToken','[]',0,'2022-06-22 08:07:36','2022-06-22 08:07:36','2023-06-22 13:52:36'),('60e34cebee74f179e847b8360f2e8c14cf8b5da7a4797cc6da8ad26bbc006aff9011db2fa6361b2e',12,1,'authToken','[]',0,'2022-10-20 11:17:26','2022-10-20 11:17:26','2023-10-20 17:02:26'),('617be0bf77cd1f61424d2a4b71eec4fddc0b61e091bab5d5488323a3cf4212dc39dde6e48c6ddac4',2,1,'authToken','[]',1,'2022-09-11 05:32:10','2022-09-11 05:32:10','2023-09-11 11:17:10'),('6404b84f7cdc9c497a09c425a3f2a77b8aa9f1cd8662c4fc3239945979d3ff732589dea1c2fc292b',2,1,'authToken','[]',0,'2022-06-30 06:53:56','2022-06-30 06:53:56','2023-06-30 12:38:56'),('649cabf6345cce54855271376a3856e8d770e50b2da1edcd6ba36b192c3f77b7dc8ecc207d83f31a',2,1,'authToken','[]',0,'2022-10-19 05:02:19','2022-10-19 05:02:19','2023-10-19 10:47:19'),('66967c9745c36daeb8328f61d3d6c9e772477fe2e653ca337561cf7f1c2ffec6740716c951651082',2,1,'authToken','[]',0,'2022-06-27 09:55:11','2022-06-27 09:55:11','2023-06-27 15:40:11'),('6756728057eba617a45f5ee338e9ce03a625d3fdb8d808b7dbf48fe69bfa5812dc8a2478c57171c2',2,1,'authToken','[]',0,'2022-09-14 07:16:31','2022-09-14 07:16:31','2023-09-14 13:01:31'),('68cf99b1ba5417edce7e6975b9921189f72541ade4abc82e74e05aa58239bd9b3ff8ad32a31acf61',2,1,'authToken','[]',0,'2022-09-01 04:43:54','2022-09-01 04:43:54','2023-09-01 10:28:54'),('6b78cb86e21543e7c921cea1a99f7f88d5123ba38d4506e75d95595327f218937e9c98bccb759fff',9,1,'authToken','[]',1,'2022-09-09 10:38:06','2022-09-09 10:38:06','2023-09-09 16:23:06'),('6d48fc4307bac6e44e28b5c16378359e2cb19b87a8ddd25e4f7e877db0e9bc0d08931f78691c2579',1,1,'authToken','[]',0,'2022-09-09 11:42:39','2022-09-09 11:42:39','2023-09-09 17:27:39'),('6f275b05eecac16973efe395f4f0af2cffc71802902c1ac07c79a30dd4167570d900a8efdf89f51c',2,1,'authToken','[]',0,'2022-06-26 05:58:34','2022-06-26 05:58:34','2023-06-26 11:43:34'),('6f5da5791e809d20d8740165a007fa39800bc2d808cc3ded6e711c31703865c3be885ecf9632c4d9',2,1,'authToken','[]',0,'2022-09-12 05:26:49','2022-09-12 05:26:49','2023-09-12 11:11:49'),('707921afbbf0be9f98f1bd462649d86f2a292f80ec1b3a28ca713b8eae983e3b8ae4955f18ca4b14',5,1,'authToken','[]',0,'2022-09-08 11:58:30','2022-09-08 11:58:30','2023-09-08 17:43:30'),('70a810e154b71e819bebe21e8cb3b8fa332f99401c73966f1dd2fcc375c46cd1398e8e8667a2c688',2,1,'authToken','[]',0,'2022-10-13 06:48:01','2022-10-13 06:48:01','2023-10-13 12:33:01'),('72121ca0a24792cc33aa771858201ef425d11c7f4ea68fc3dd3360515a701b57335b31e5842c4c29',2,1,'authToken','[]',1,'2022-06-23 09:40:28','2022-06-23 09:40:28','2023-06-23 15:25:28'),('73efd16b0c63de89efd482ee3792dc29ca5abf929e7c9842997a425eda7746a98ee52c21b90870d6',8,1,'authToken','[]',1,'2022-09-09 11:01:47','2022-09-09 11:01:47','2023-09-09 16:46:47'),('76633f8763b9ab6dc5e2b6bf4973497775705d136c6c61c60404931f7acca384cbb030985a913c0c',2,1,'authToken','[]',0,'2022-09-08 05:41:12','2022-09-08 05:41:12','2023-09-08 11:26:12'),('77693e184a9332b0d148e31243fc367677aed970a8eeebd59b7d376dccdd611ec8a0f2b1b7374104',4,1,'authToken','[]',1,'2022-09-09 11:34:48','2022-09-09 11:34:48','2023-09-09 17:19:48'),('79fc23d495c3d52d7bf74f4f39a95f8925f8d4903c95749fbb3d4f4ea133725dc7d7f4a6b0d7f9e0',1,1,'authToken','[]',1,'2022-09-09 10:24:01','2022-09-09 10:24:01','2023-09-09 16:09:01'),('7afd9d399e2c90827a26582f1d66f00c9b64a764c3403030b2ae5483c2e82afdc1fec6091bf7eb79',7,1,'authToken','[]',0,'2022-09-12 11:46:05','2022-09-12 11:46:05','2023-09-12 17:31:05'),('7bb1c2d54a3e021a2310779b60d0e031afe3c261e32126365cb610260856aacf188fbeb288c7a7ae',4,1,'authToken','[]',1,'2022-09-07 11:15:34','2022-09-07 11:15:34','2023-09-07 17:00:34'),('7cc3c67c3041ac45b47210883413c40eda1bfcf4e3d713958af0a756d0b8fe4b43e55911525d4119',8,1,'authToken','[]',1,'2022-09-09 11:03:18','2022-09-09 11:03:18','2023-09-09 16:48:18'),('7eda8a435940a8037683f3e1fc68f5e2c1fbbfc1b34e7e6e4517df5e6faf05339b9a81e1a522a062',22,3,'authToken','[]',1,'2023-03-22 06:33:31','2023-03-22 06:33:31','2024-03-22 12:18:31'),('808cc7e687d5976d9e8d6868b701956ab5c3fc35e492daaf426221819a2790c3b4dc4b8bf7f35730',2,1,'authToken','[]',0,'2022-11-09 08:50:12','2022-11-09 08:50:12','2023-11-09 14:35:12'),('823173af74070a0205b35e67f1fcbbd43525c32b310a2a7445445fbffa4c9213113802f877b03f5b',3,3,'authToken','[]',1,'2023-03-22 06:08:53','2023-03-22 06:08:53','2024-03-22 11:53:53'),('84fd63255101e498efe0ef6c84de8a42198f847cb45b75718daddc61e263656dbde10db293fec94e',2,1,'authToken','[]',0,'2022-06-27 11:10:09','2022-06-27 11:10:09','2023-06-27 16:55:09'),('877ba430c3933e7ecdd45f9d229a2a7422011c7d187064af3f9158cfbaff7053ba053d2c499990ca',15,1,'authToken','[]',0,'2022-09-12 09:14:14','2022-09-12 09:14:14','2023-09-12 14:59:14'),('878d737efbfb7d077ac7fb21e6946a8d43fc8257ba3242fbaa98962e2561e99013b4d90a40659cb6',8,1,'authToken','[]',1,'2022-09-09 11:06:16','2022-09-09 11:06:16','2023-09-09 16:51:16'),('88bfee03e078cdb33481263f3284f4982c219bd32497453b66c7d7c320cacb22227cbf14ab2589a9',2,1,'authToken','[]',0,'2022-09-13 09:46:22','2022-09-13 09:46:22','2023-09-13 15:31:22'),('8990f3efc8c8385eedbba785ffbb292870bc8efc2518ea3ef73f130c154c8a2f3146a43812916df0',2,1,'authToken','[]',0,'2022-06-23 10:17:27','2022-06-23 10:17:27','2023-06-23 16:02:27'),('8a437bf0a9c4da554d30c0237ae75026cfe8be19a6f8775d948bc99de3089365e7d07b3b73a5023d',18,1,'authToken','[]',0,'2022-09-12 10:15:39','2022-09-12 10:15:39','2023-09-12 16:00:39'),('8aceaab358385b61078ff95ac951d571dd0a500d6adf877c75189707a29c57ed1475c5e9e571ee43',4,1,'authToken','[]',0,'2022-11-09 09:22:22','2022-11-09 09:22:22','2023-11-09 15:07:22'),('8b5a68917600364106b031702c34b4ef27c646bb702d5de8644d978b8817b1c26a4af3056d4e591b',2,1,'authToken','[]',0,'2022-10-19 05:02:17','2022-10-19 05:02:17','2023-10-19 10:47:17'),('8b8190e204f8814d7baef893c9d3db4f9cf5ffb7e2df97f000066aca360b3679745dfdddae0a923f',6,1,'authToken','[]',0,'2022-09-09 04:50:14','2022-09-09 04:50:14','2023-09-09 10:35:14'),('8e58b4d0c9da71f702845f052c653a73d04f6cc60feca6f7de7e433fded491e97659ed3531094a8a',2,1,'authToken','[]',0,'2022-09-12 10:23:56','2022-09-12 10:23:56','2023-09-12 16:08:56'),('8ebb4d11fb81e4d397ea799b0523605bf3204392cf0ed0a904aad450793115d96fafd7fe555a0b8c',2,1,'authToken','[]',0,'2022-06-23 06:36:02','2022-06-23 06:36:02','2023-06-23 12:21:02'),('8ee0a24da819f827f1439c6aacebc968100420e22a9731f7cd3d67aa6d822dcda42e9b22300430ed',2,1,'authToken','[]',0,'2022-09-09 04:45:47','2022-09-09 04:45:47','2023-09-09 10:30:47'),('905ea91d06a3615bff1be1301fbd93a7518374e9375f29ee5ba0a3314c7db05eda29e202dc25141e',3,1,'authToken','[]',0,'2022-10-20 11:21:44','2022-10-20 11:21:44','2023-10-20 17:06:44'),('91319d1568be34d2d17fd5cdc2703ec10f03de7afab072bcbb4dec3af744dab443e541b2532c1631',9,1,'authToken','[]',0,'2022-09-09 05:30:41','2022-09-09 05:30:41','2023-09-09 11:15:41'),('9403c43ee6160a05902eb8766aad989f48abb0398ee67550b2f88fddb915fe53a20a3c30f8677ae2',5,1,'authToken','[]',0,'2022-09-09 05:29:59','2022-09-09 05:29:59','2023-09-09 11:14:59'),('94f39f707e4be9bbdb10b889fa7e7278751102fa4ae150d0b0ee6e185343cebcc49b0cd7cc52cee6',1,1,'authToken','[]',1,'2022-09-09 10:22:16','2022-09-09 10:22:16','2023-09-09 16:07:16'),('95b4b0fffb4f7fb70cdc5dd6e0541b1762d37c05baa085e59afd7f2fc7e13f9f02f3cfa428da0040',2,1,'authToken','[]',0,'2022-06-27 06:23:01','2022-06-27 06:23:01','2023-06-27 12:08:01'),('99cd3b9c6213e8cfa334269657606a6ddac5a834350b7655e637ce0e151a1ffe6590b081ad8a9eff',11,1,'authToken','[]',1,'2022-09-09 11:40:27','2022-09-09 11:40:27','2023-09-09 17:25:27'),('9b11f039a65ec32b33b7d9ef83e26405ae5716d8ce8aea8daad537407c48e7bfe34efd080f036c2d',4,1,'authToken','[]',0,'2022-09-09 05:36:41','2022-09-09 05:36:41','2023-09-09 11:21:41'),('9bd96e1475bdf9c18853b3defeca5cebe9cfdd79bb0d52830094626bd504e72a1b17d8895bbe4d64',13,1,'authToken','[]',0,'2022-09-11 05:45:03','2022-09-11 05:45:03','2023-09-11 11:30:03'),('9dc04ec9d8d79f92b81d321ad05dfbd7440ba1c3f9f05c3237e665279d8815262cf940c0a74eedd3',7,1,'authToken','[]',1,'2022-09-11 06:27:11','2022-09-11 06:27:11','2023-09-11 12:12:11'),('a17e8733c061b74611fe8a919324b5e51481172cc407505880635741248a5a035ac5ca1895ad140b',2,1,'authToken','[]',0,'2022-07-01 11:42:32','2022-07-01 11:42:32','2023-07-01 17:27:32'),('a2b84e955c21938e05970f5727fc04f5cdf63f8cf3674ec13ad6c6d23e7c448077418319891892b4',9,1,'authToken','[]',1,'2022-09-09 10:05:09','2022-09-09 10:05:09','2023-09-09 15:50:09'),('a2f778b16f48d7c95e605bf990e1547064f17ef221588586eed693ce5bdb593fc959d1f3ea873df5',4,1,'authToken','[]',0,'2022-10-11 04:40:24','2022-10-11 04:40:24','2023-10-11 10:25:24'),('a318176b1dc6221ee877912265897e3b047bc4a436f76c523b54d801250cec1e6f1f1cc1785431fa',9,1,'authToken','[]',0,'2022-09-09 11:52:27','2022-09-09 11:52:27','2023-09-09 17:37:27'),('a6fd802637924d19398cf5ff22894d9366ff78aff7d7d50f3b156c70eaa2a572226e1f7b32bf1c6f',13,1,'authToken','[]',0,'2022-10-20 11:11:48','2022-10-20 11:11:48','2023-10-20 16:56:48'),('a705f5524bd1c4bf2cf41da59be68bedf8e40531a3bf75c1342d473bf0e88e23bcfe72c3211a674f',4,1,'authToken','[]',0,'2022-09-07 11:18:35','2022-09-07 11:18:35','2023-09-07 17:03:35'),('a9073cb976ad107b1b5e21ac9405aa6e1a3ec3e6a22f53108bd7da90f9eacf96b87f62f96dcaf485',2,1,'authToken','[]',0,'2022-09-07 11:17:40','2022-09-07 11:17:40','2023-09-07 17:02:40'),('a91577c8fa2234b9572af296299e2288d0c6180688b588f452251981e51e36588c73d5a65ae4858a',2,1,'authToken','[]',0,'2022-06-27 11:36:39','2022-06-27 11:36:39','2023-06-27 17:21:39'),('a9a22631883f647c4c432d46da02511acbb1476c067c119c699695b7dab3c4dd54365ba84cebf4bf',10,1,'authToken','[]',0,'2022-09-09 09:55:21','2022-09-09 09:55:21','2023-09-09 15:40:21'),('aa6a95144d72f221f59960096193969fef91e45d506831389c04a10eccac01d02cac1a4ebe826a60',2,1,'authToken','[]',0,'2022-06-28 11:03:13','2022-06-28 11:03:13','2023-06-28 16:48:13'),('ab4ab7a32bfd3cb1c734f5ba7bb6e3121baae2c59501f97b40baf515b3c3c7feea10baaad58f923e',9,1,'authToken','[]',1,'2022-10-11 04:42:40','2022-10-11 04:42:40','2023-10-11 10:27:40'),('ab7c8123130d7947d3dc037c73f01e784ce1cdc07757c72ac35326f699abd0a5033cd519dbf73653',5,1,'authToken','[]',1,'2022-09-11 06:29:50','2022-09-11 06:29:50','2023-09-11 12:14:50'),('ab93a8fa3f9a09a06b9e133f82a4bb3b8170f24d84c9d717bcb05bbe14579b275300826f6c5aa269',2,3,'authToken','[]',0,'2023-03-22 05:54:19','2023-03-22 05:54:19','2024-03-22 11:39:19'),('ad8be0e82209736aa578a4c6d896e34119de34650394073a5718dae47e486356b73310b0a5daed9c',17,1,'authToken','[]',0,'2022-09-12 09:11:39','2022-09-12 09:11:39','2023-09-12 14:56:39'),('ae71fe155a00c57c70094c4649f1b26ca2275db6dc4ba8b112380682abb00a53cf67f157522345c3',7,1,'authToken','[]',1,'2022-09-09 11:02:18','2022-09-09 11:02:18','2023-09-09 16:47:18'),('b064bd12bb10fed7c1e72895aadd9346bd7b480a2ee644a8a9782a3403503af6d6a6d7dd4451bf49',7,1,'authToken','[]',0,'2022-09-11 06:31:14','2022-09-11 06:31:14','2023-09-11 12:16:14'),('b0e1ab6f61e20e0b5277ea22f3843fb955f128c3fa8d7fe8f97e2a7afe07006ee00c00327d076e31',2,1,'authToken','[]',1,'2022-06-30 06:48:58','2022-06-30 06:48:58','2023-06-30 12:33:58'),('b10fd60abfdd99757b52522df353ccaf1352a8e3a8f73b60df031df7ed92d27bcae09f8646497a94',13,1,'authToken','[]',0,'2022-09-12 04:59:50','2022-09-12 04:59:50','2023-09-12 10:44:50'),('b1dead0dbb41b81209c219cc9ba0c06d23fa6884cf1d2bedf9c52dec7e495cc5a9c8d4ca8ff6cbaa',2,1,'authToken','[]',0,'2022-06-26 11:49:37','2022-06-26 11:49:37','2023-06-26 17:34:37'),('b23dea4ac98b99838782e5fb311a4490bcd13f0ba33a47c3ca8391e9a6570c6407edd5b7ff06869e',4,1,'authToken','[]',0,'2022-10-11 04:38:14','2022-10-11 04:38:14','2023-10-11 10:23:14'),('b2c2e97a2b9eb196b135bf60bbb48f6c2ba40fffd5d6cbec5394ba3674b5587a4237a439d8dccc49',21,3,'authToken','[]',0,'2023-03-22 06:46:13','2023-03-22 06:46:13','2024-03-22 12:31:13'),('b37e7256bba4661756c7e8faa99942f13d276a8df996db4ee921b30383ad44c47fb3ac86a2163bc9',2,1,'authToken','[]',0,'2022-10-20 11:20:47','2022-10-20 11:20:47','2023-10-20 17:05:47'),('b3bc552e5b65acddad6f7257f9e0a7f083867cb0dc993cdfeb8aa6013df0bf19c95d659d317a9e08',2,1,'authToken','[]',0,'2022-06-24 06:27:16','2022-06-24 06:27:16','2023-06-24 12:12:16'),('b473516409c4d915d4c7653918dfefa5c1b239281d0defe0ecb2a1e1fea12e56522661b9ca039437',2,1,'authToken','[]',0,'2022-09-12 08:48:16','2022-09-12 08:48:16','2023-09-12 14:33:16'),('b5a509bce8b926282fa56c7ad9e4327dcc7a8e7e19e4bb99f5114f895920ed3f78782a3d1875e029',2,1,'authToken','[]',0,'2022-09-11 10:53:16','2022-09-11 10:53:16','2023-09-11 16:38:16'),('b6ed761226859b370b7fd55059b3dcee0fbd7930ebee4dc8f5f6ec97502da83055203aec7b989e89',2,1,'authToken','[]',0,'2022-09-12 07:07:21','2022-09-12 07:07:21','2023-09-12 12:52:21'),('b7f4baa511c887e67116c2e9ff68cc0509d123e0b97fd875fe1a642cffbffb72753ced5289951d7d',7,1,'authToken','[]',0,'2022-09-12 11:45:57','2022-09-12 11:45:57','2023-09-12 17:30:57'),('ba00d74435afdb195d751c2b297e5b2ea9f8ba5c7791d3e920972746c672bed4c5cd0339eaf5ee91',1,1,'authToken','[]',0,'2022-09-14 07:38:10','2022-09-14 07:38:10','2023-09-14 13:23:10'),('bae0bc0b00d239c94be7e5063bae7d8202f47e59e8404025efb059552778f6cad54b0a020f7779a3',9,1,'authToken','[]',0,'2022-09-09 05:37:23','2022-09-09 05:37:23','2023-09-09 11:22:23'),('bb1815d591912c2ba01816b307b595856a631319815ad5d5da3ba7c660d5ccbc0eae615ce269f6a3',9,1,'authToken','[]',0,'2022-09-09 10:00:59','2022-09-09 10:00:59','2023-09-09 15:45:59'),('bd25393944fe32e2e841bc7224e9f71fdda1394ec7fcbf41a57a9ede3273deebb34f0ceaf8ae106c',2,1,'authToken','[]',0,'2022-11-14 05:34:08','2022-11-14 05:34:08','2023-11-14 11:19:08'),('bd3d0d689a08c2ccdf8c6c0a43f175a3f16a623322055a468670b54e7528999ad08f284691d05378',4,1,'authToken','[]',0,'2022-09-09 04:52:41','2022-09-09 04:52:41','2023-09-09 10:37:41'),('bd7df2d4c452b805f4da42014b700f9e7c5cbc097cc9b1404e62bde0f3b81d08840668cb51706adb',4,1,'authToken','[]',0,'2022-09-11 05:52:14','2022-09-11 05:52:14','2023-09-11 11:37:14'),('bef662df28f2fa9f50bcff127a844ae5c4e0234c26935928ec1c038efa67ab191ebc541c6543980f',2,1,'authToken','[]',0,'2022-06-28 11:03:34','2022-06-28 11:03:34','2023-06-28 16:48:34'),('bf21822f76a6dc5c4fbe147f6187e2bbb4b04b9a67cdee9dbe135cc0879ed88959770a0261d15d3f',2,1,'authToken','[]',0,'2022-11-09 09:23:41','2022-11-09 09:23:41','2023-11-09 15:08:41'),('c19dd2d2aed007a66dcee87e892c344f4dbb5be1d06cb2ec2a05a2f90634a7fdbec9a625447edafc',2,1,'authToken','[]',1,'2022-06-26 06:18:36','2022-06-26 06:18:36','2023-06-26 12:03:36'),('c1ad4bbc69e53c98fe73e9f08b3a49a7f472d7904f51123b7b03ea49ead0d7872a934f79ba126e74',5,1,'authToken','[]',0,'2022-09-09 11:30:35','2022-09-09 11:30:35','2023-09-09 17:15:35'),('c24cae0cf7cb15e317be6a477b1e70778f18a02c420527601afc4cda727926df102e29bd166d6a56',4,1,'authToken','[]',0,'2022-09-08 11:36:07','2022-09-08 11:36:07','2023-09-08 17:21:07'),('c26eae1bde397a2cd929cbf13c7e0eccf39eb0d34d8b5c3a0daaa1d0479722ba742828114199c162',21,3,'authToken','[]',1,'2023-03-22 06:13:45','2023-03-22 06:13:45','2024-03-22 11:58:45'),('c4c4dcc94adef36c278434cf1ed4b85e75d8494ca8a6021e5d75e894fd69d597eef984f28ec69347',2,1,'authToken','[]',0,'2022-10-20 09:21:08','2022-10-20 09:21:08','2023-10-20 15:06:08'),('c53e030aa8da9cc114cc14e60ed61c564be0d53e58a82a42643bf2938aeefad05aef30e6948aaa32',13,1,'authToken','[]',1,'2022-09-14 07:18:55','2022-09-14 07:18:55','2023-09-14 13:03:55'),('c7833963a06169fad22915c95c7efb77ba9f7a86f90fe3987e42e476b978c8644766662e4fd1fa0b',2,1,'authToken','[]',0,'2022-06-27 17:38:57','2022-06-27 17:38:57','2023-06-27 23:23:57'),('c7e0a834648d655fda062a985fff3105cc9eb3a6b451760d96448f8ba45561a22015726e8aea2ac9',2,1,'authToken','[]',0,'2022-09-07 10:47:02','2022-09-07 10:47:02','2023-09-07 16:32:02'),('ca818efe2f0c2bd042423362ba04a2d0b3d147ae8612200f4683b12f15c6f38eb7291f7e725a03ab',1,1,'authToken','[]',0,'2022-11-16 05:50:43','2022-11-16 05:50:43','2023-11-16 11:35:43'),('ca98286df8539ff1a554583d777c29dc70bdc7e754dea541ed259655595981451114d10d8d5410a2',7,1,'authToken','[]',1,'2022-09-11 05:49:08','2022-09-11 05:49:08','2023-09-11 11:34:08'),('cb2ab206df405b77b87883e7c509c022180b6ba571f6450106956cac9b0ade3676978414c4974e68',7,1,'authToken','[]',1,'2022-09-09 10:52:39','2022-09-09 10:52:39','2023-09-09 16:37:39'),('cbc787567047081f86c12e8c09eb05ead3dcf46f97bda29489a369421e26031592b2fbe8fb1a2fef',1,1,'authToken','[]',0,'2022-09-09 11:35:43','2022-09-09 11:35:43','2023-09-09 17:20:43'),('cdc64039d0d070f74d86495b9f6c36daccf39473d97896368e3557d1521d03aaeae4d0c82ec620d8',2,1,'authToken','[]',0,'2022-07-11 10:37:18','2022-07-11 10:37:18','2023-07-11 16:22:18'),('ce468835b75dc89bcd7014d31f4ae2743ff728f886fc29e938f7e6869b41dfbe15994f66839469a7',4,1,'authToken','[]',0,'2022-09-07 11:18:41','2022-09-07 11:18:41','2023-09-07 17:03:41'),('d09ce1dbd81886cfdb4889b3db2788971d60ff74a4fa4b07e70681b8635d362f4bf087500f72e6e0',1,1,'authToken','[]',0,'2022-09-11 05:21:23','2022-09-11 05:21:23','2023-09-11 11:06:23'),('d0f10395b4f2dd0d82559fbb26a218446781e61d5e0da294e93ceb2a44f9e2241d42dc935af2612c',10,1,'authToken','[]',0,'2022-09-09 05:45:39','2022-09-09 05:45:39','2023-09-09 11:30:39'),('d1cd24242dddb2ff86679d661c3bbeb05a5d9df6abc5b2f82a3e740c3079ca470cab1a02acd554ce',2,1,'authToken','[]',1,'2022-10-11 04:53:41','2022-10-11 04:53:41','2023-10-11 10:38:41'),('d713db9be79a8e4078cad51386df4b1048508876dbf70e42d62cf1005fbb22d1d60578c489a141a9',2,1,'authToken','[]',0,'2022-09-14 06:23:43','2022-09-14 06:23:43','2023-09-14 12:08:43'),('d7af3081db072375583c865217d5c6450d788eb3c6b1707b4749740738893ecbd3559a2f11fc5346',2,1,'authToken','[]',0,'2022-09-09 05:43:01','2022-09-09 05:43:01','2023-09-09 11:28:01'),('d93149c4304512d895d9df7c4b7d045f03da95bcb4e3f39a64a80a06c395417b1327d851cac37ef7',1,1,'authToken','[]',0,'2022-11-16 04:51:36','2022-11-16 04:51:36','2023-11-16 10:36:36'),('d9670554e7b4448158684218742a4e67e88788f7dfd645a429685dbc0e81c26ccd28a0a1625592c6',8,1,'authToken','[]',1,'2022-09-11 05:31:20','2022-09-11 05:31:20','2023-09-11 11:16:20'),('d9b157178cb4a14254ddf42d961ce56d38961602f1ebca2b1000ae477e6e3f52493e081061e84643',2,1,'authToken','[]',0,'2022-09-08 12:14:58','2022-09-08 12:14:58','2023-09-08 17:59:58'),('da43926bc16997c4624092888ea3bc0d7f682dca824e7a065a94e879698bdd14cd7eb1ee96bb687e',2,1,'authToken','[]',0,'2022-11-17 04:30:22','2022-11-17 04:30:22','2023-11-17 10:15:22'),('db0f54b212cca8feac340d2d2b3a9e1c98b0917740e9dc6e33287e29d32f5087aa71b9aebb0cd5d8',24,3,'authToken','[]',0,'2023-03-22 06:48:49','2023-03-22 06:48:49','2024-03-22 12:33:49'),('db398bb2420f0cffbb310e1a25b26030eae8d052c964eb19ebb835f86e08bc1bde7e5e1cab1ee8ca',2,1,'authToken','[]',0,'2022-09-06 10:29:52','2022-09-06 10:29:52','2023-09-06 16:14:52'),('df6d64aee3f8bb48656723fc93fce3eb3c0f1adbd253ee67210abb42e000660f52ecb7d594244246',6,1,'authToken','[]',0,'2022-09-08 12:11:57','2022-09-08 12:11:57','2023-09-08 17:56:57'),('e0ed58c400be196a038712b03e01f13ec5ef0df7b152f908b44e5968c7421dc4efd2782aa6eca3e2',2,1,'authToken','[]',0,'2022-11-14 09:53:14','2022-11-14 09:53:14','2023-11-14 15:38:14'),('e3040b5fc76861b7849045fc57ed546bd1846efaf1eac50447102ef4eafd84697d12a41928ea1e2d',13,1,'authToken','[]',0,'2022-09-12 08:47:42','2022-09-12 08:47:42','2023-09-12 14:32:42'),('e30d8b0941b17d53a0085a1f0333f8e45019aa21b23d424c7f0d5b9a22f333423d402e59dc6b99e9',7,1,'authToken','[]',1,'2022-09-12 10:26:09','2022-09-12 10:26:09','2023-09-12 16:11:09'),('e45eb962d95ea18894b838f53e637c08e4cf7e8e927c290fadce6c73b9021ff369c2c19bdf96756e',2,1,'authToken','[]',0,'2022-11-16 05:48:49','2022-11-16 05:48:49','2023-11-16 11:33:49'),('e47344685babc42134f2cdbede8264e2ac3c6821f092d8096a115239b0dbb274acd908a0cc5ec78e',1,1,'authToken','[]',1,'2022-09-09 10:38:26','2022-09-09 10:38:26','2023-09-09 16:23:26'),('e4a9ce1bdb98def25a51edab827e9ebb2fbef02a8fd5aa5af2d9b5ba123a86e3f22bcd37ec317f86',2,1,'authToken','[]',0,'2022-10-20 09:48:49','2022-10-20 09:48:49','2023-10-20 15:33:49'),('e6af9d47443826f7dc1fa366c6b30daa78ca49c0558aec50c7441954c32cf4f1036382e7ddb8e97b',2,1,'authToken','[]',1,'2022-06-23 10:45:49','2022-06-23 10:45:49','2023-06-23 16:30:49'),('e6ea0e9d5195cfe6b073bfce49101ddebae0a4f56467a91f2c02b0f866d971faf1baae0c1fb77d9f',2,1,'authToken','[]',1,'2022-11-09 08:50:41','2022-11-09 08:50:41','2023-11-09 14:35:41'),('e8e69994fa87a384fe30db395fd33023f0cd204be177bc20a92c26df655a136a8b63380918da0d61',13,1,'authToken','[]',1,'2022-09-12 06:34:42','2022-09-12 06:34:42','2023-09-12 12:19:42'),('e993c5401ba4511362bff4b2871247e025c45fb03699fae07833afe6d4cb55514fe09f7ddd379a01',1,3,'authToken','[]',0,'2023-03-22 05:46:35','2023-03-22 05:46:35','2024-03-22 11:31:35'),('ea11aaf3c1fa008a14adf425db6491c86b9408bb6163cf0521c8c086559370cec94731f935fb0afe',8,1,'authToken','[]',1,'2022-09-12 10:28:37','2022-09-12 10:28:37','2023-09-12 16:13:37'),('eeecf67fe339ab068b566504f0473e804c7d4747b54317c5c4b0c32bf13bcbe97bfa0eaedede241c',16,1,'authToken','[]',1,'2022-09-12 07:29:37','2022-09-12 07:29:37','2023-09-12 13:14:37'),('f079625eca68aed980dfcf89eb7efe9c7861f4fe2f9d0bca210725d71850f94f1c72f04a0c00fd2b',8,1,'authToken','[]',1,'2022-09-09 04:46:58','2022-09-09 04:46:58','2023-09-09 10:31:58'),('f3d64e46c0611ccc7a14a7a1c8d8e78564079b2946409c5597cc848cabe1306be402a333578bef82',4,1,'authToken','[]',0,'2022-09-12 07:11:49','2022-09-12 07:11:49','2023-09-12 12:56:49'),('f5fdfa8a1800353c538d6993eaac2f53584a4077af59f08e4808e24c70c83a0ff856a1b9cb3bd4a1',13,1,'authToken','[]',0,'2022-09-12 09:06:37','2022-09-12 09:06:37','2023-09-12 14:51:37'),('fa46132b1789c9e1b48ac7cd2034cafba4738a07a9a2e9e6c4cd9f984670f63e1cbc70f21810d7ab',1,3,'authToken','[]',0,'2023-03-22 07:28:55','2023-03-22 07:28:55','2024-03-22 13:13:55'),('fa77fc1aa49c75f5d39f670ba306982ca582a7b2eb3a4f86310c4a9d2e7726a872d0b0d7316192f7',6,1,'authToken','[]',0,'2022-09-09 05:00:14','2022-09-09 05:00:14','2023-09-09 10:45:14'),('fc4587f20a0cfd4cfbbcee5392449c7d85fddb5d52f398f156d9c917c4ececf87fef101d6a3d32b3',23,3,'authToken','[]',1,'2023-03-22 06:23:45','2023-03-22 06:23:45','2024-03-22 12:08:45'),('fd013b15e43167c885b27a77072fa143188efb77abdaf78b35394ebf8d590940d3ab9c3c50fb765e',21,3,'authToken','[]',1,'2023-03-22 06:28:16','2023-03-22 06:28:16','2024-03-22 12:13:16'),('fd0cfdce7d82d8963d75cbc82a45b8983e309b0e00b06d7b9d3cc163b8128678e2024e4bb7e012a3',2,1,'authToken','[]',0,'2022-06-30 07:46:35','2022-06-30 07:46:35','2023-06-30 13:31:35'),('feec8fa7f64e13665ab20f924ef78d49c6b77a2f43d06ca56d24c65d686d9444f5cc4a810070deca',15,1,'authToken','[]',0,'2022-09-12 07:28:42','2022-09-12 07:28:42','2023-09-12 13:13:42');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Plgsp Personal Access Client','ikBnAwiCtn7WK4VL3coiJ4oNUtshlgJszlAys29n','http://localhost',1,0,0,'2022-06-05 09:41:52','2022-06-05 09:41:52'),(2,NULL,'Plgsp Password Grant Client','9g7iMdddndiKrESkCsbvqBjDzX5DSEsllWdKxDML','http://localhost',0,1,0,'2022-06-05 09:41:52','2022-06-05 09:41:52'),(3,NULL,'Plgsp Personal Access Client','PwcGX1Ss2udKje4UWgmn3C6snmfC3koj1ffrqG1H','http://localhost',1,0,0,'2023-03-22 05:33:18','2023-03-22 05:33:18'),(4,NULL,'Plgsp Password Grant Client','eGbxkobCFMUbr2tiukGpnP7fHQEwr3lKiugluQxz','http://localhost',0,1,0,'2023-03-22 05:33:18','2023-03-22 05:33:18');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2022-06-05 09:41:52','2022-06-05 09:41:52'),(2,3,'2023-03-22 05:33:18','2023-03-22 05:33:18');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `points` decimal(3,2) DEFAULT NULL,
  `parameter_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `options_parameter_id_foreign` (`parameter_id`),
  CONSTRAINT `options_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'निर्माण गर्नुपर्ने कानुनको पहिचान भई सबै नीति तथा कानुन निर्माण भएको',1.00,1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(2,'पहिचान भएको मध्ये 80 प्रतिशत भन्दा बढी नीति तथा कानुन निर्माण भएको',0.75,1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(3,'पहिचान भएको मध्ये 80 प्रतिशत भन्दा कम नीति तथा कानुन निर्माण भएको',0.50,1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(4,'निर्माण गर्नुपर्ने नीति तथा कानुनको पहिचान नै नभएको',0.00,1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(5,'निर्माण गर्नुपर्ने नियमावली, कार्यविधि, निर्देशिका, मापदण्डको पहिचान भई सबै निर्माण भएको',1.00,2,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(6,'निर्माण गर्नुपर्ने नियमावली, कार्यविधि, निर्देशिका, मापदण्डको पहिचान भई 80 प्रतिशत भन्दा बढी निर्माण भएको',0.75,2,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(7,'निर्माण गर्नुपर्ने नियमावली, कार्यविधि, निर्देशिका, मापदण्डको\r\nपहिचान भई 80 प्रतिशत भन्दा कम निर्माण भएको',0.50,2,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(8,'निर्माण गर्नुपर्ने नियमावली, कार्यविधि, निर्देशिका, मापदण्डको\r\nपहिचान नै नभएको',0.00,2,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(9,'नीति कार्यान्वयनको आवधिक समीक्षा र नीति परीक्षण गरिएको',1.00,3,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(10,'नीति कार्यान्वयनको आवधिक समीक्षा मात्र गरिएको वा नीति परीक्षण मात्र गरिएको',0.50,3,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(11,'आवधिक समीक्षा तथा नीति परीक्षण तोकिएको समयमा नगरिएको',0.25,3,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(12,'आवधिक समीक्षा तथा नीति परीक्षण नै नगरिएको',0.00,3,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(13,'स्वीकृत दरबन्दीबमोजिम कर्मचारी पदपूर्ति भएको',1.00,4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1),(14,'स्वीकृत दरबन्दीको 90 प्रतिशतभन्दा बढी पूर्ति वा स्वीकृत दरबन्दीभन्दा बढी कर्मचारी कार्यरत रहेको',0.75,4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1),(15,'स्वीकृत दरबन्दीको 80 प्रतिशत भन्दा बढी पदपूर्ति भएको',0.50,4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1),(16,'स्वीकृत दरबन्दीको 80 प्रतिशतभन्दा कम पदपूर्ति भएको',0.25,4,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_user`
--

DROP TABLE IF EXISTS `organization_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_user` (
  `organization_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  KEY `organization_user_organization_id_foreign` (`organization_id`),
  KEY `organization_user_user_id_foreign` (`user_id`),
  CONSTRAINT `organization_user_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `organization_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_user`
--

LOCK TABLES `organization_user` WRITE;
/*!40000 ALTER TABLE `organization_user` DISABLE KEYS */;
INSERT INTO `organization_user` VALUES (1,3),(1,21),(1,22),(1,23),(1,24);
/*!40000 ALTER TABLE `organization_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `province_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `type_id` int unsigned DEFAULT NULL,
  `organization_id` int unsigned DEFAULT NULL,
  `governance_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizations_slug_unique` (`slug`),
  KEY `organizations_province_id_foreign` (`province_id`),
  KEY `organizations_district_id_foreign` (`district_id`),
  KEY `organizations_type_id_foreign` (`type_id`),
  KEY `organizations_organization_id_foreign` (`organization_id`),
  KEY `organizations_governance_id_foreign` (`governance_id`),
  CONSTRAINT `organizations_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `organizations_governance_id_foreign` FOREIGN KEY (`governance_id`) REFERENCES `governances` (`id`) ON DELETE SET NULL,
  CONSTRAINT `organizations_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `organizations_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE SET NULL,
  CONSTRAINT `organizations_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,'गृह मन्त्रालय','ministry-of-home-affairs',NULL,'सिंहदरबार','2022-09-07 10:53:07','2022-11-09 09:04:32',NULL,NULL,NULL,1,NULL,1),(2,'Department of Immigration, Pashupatinagar','department-of-immigration-pashupatinagar',NULL,NULL,'2022-09-07 11:22:32','2022-09-07 11:22:32',NULL,NULL,NULL,2,1,NULL),(3,'Department of Immigration, Kakarvitta','department-of-immigration-kakarvitta',NULL,NULL,'2022-09-07 11:23:34','2022-09-07 11:23:34',NULL,NULL,NULL,2,1,NULL),(4,'Department of Immigration, Biratnagar','department-of-immigration-biratnagar',NULL,NULL,'2022-09-07 11:24:10','2022-09-07 11:24:10',NULL,NULL,NULL,2,1,NULL),(5,'Department of Immigration, Rasuwa','department-of-immigration-rasuwa',NULL,NULL,'2022-09-07 11:24:41','2022-09-07 11:24:41',NULL,NULL,NULL,2,1,NULL),(6,'Department of Immigration, Kodari','department-of-immigration-kodari',NULL,NULL,'2022-09-07 11:25:02','2022-09-07 11:25:02',NULL,NULL,NULL,2,1,NULL),(7,'Department of Immigration, Tribhuvan International Airport','department-of-immigration-tribhuvan-international-airport',NULL,NULL,'2022-09-07 11:25:26','2022-09-07 11:25:26',NULL,NULL,NULL,2,1,NULL),(8,'Department of Immigration, Birganj','department-of-immigration-birganj',NULL,NULL,'2022-09-07 11:26:00','2022-09-07 11:26:00',NULL,NULL,NULL,2,1,NULL),(9,'Department of Immigration, Belahia','department-of-immigration-belahia',NULL,NULL,'2022-09-07 11:26:25','2022-09-07 11:26:25',NULL,NULL,NULL,2,1,NULL),(10,'Department of Immigration, Bhairahawa','department-of-immigration-bhairahawa',NULL,NULL,'2022-09-07 11:27:01','2022-09-07 11:27:01',NULL,NULL,NULL,2,1,NULL),(11,'Department of Immigration, Pokhara','department-of-immigration-pokhara',NULL,NULL,'2022-09-07 11:27:21','2022-09-07 11:27:21',NULL,NULL,NULL,2,1,NULL),(12,'Department of Immigration, Jamunaha','department-of-immigration-jamunaha',NULL,NULL,'2022-09-07 11:27:44','2022-09-07 11:27:44',NULL,NULL,NULL,2,1,NULL),(13,'Department of Immigration, Mohana','department-of-immigration-mohana',NULL,NULL,'2022-09-07 11:28:10','2022-09-07 11:28:10',NULL,NULL,NULL,2,1,NULL),(14,'Department of Immigration, Gaddhachauki','department-of-immigration-gaddhachauki',NULL,NULL,'2022-09-07 11:28:34','2022-09-07 11:28:34',NULL,NULL,NULL,2,1,NULL),(15,'District Administration Office, Taplejung','district-administration-office-taplejung',NULL,NULL,'2022-09-07 11:35:00','2022-09-07 11:35:00',NULL,1,88,3,1,NULL),(16,'District Administration Office, Panchthar','district-administration-office-panchthar',NULL,NULL,'2022-09-07 11:36:12','2022-09-07 11:36:12',NULL,1,84,3,1,NULL),(17,'District Administration Office, Ilaam','district-administration-office-ilaam',NULL,NULL,'2022-09-07 11:36:56','2022-09-07 11:36:56',NULL,1,90,3,1,NULL),(18,'District Administration Office, Jhapa','district-administration-office-jhapa',NULL,NULL,'2022-09-07 11:37:28','2022-10-11 04:41:55',NULL,1,80,3,1,1),(19,'District Administration Office, Morang','district-administration-office-morang',NULL,NULL,'2022-09-07 11:38:06','2022-09-07 11:38:06',NULL,1,82,3,1,NULL),(20,'District Administration Office, Sunsari','district-administration-office-sunsari',NULL,NULL,'2022-09-07 11:38:47','2022-09-07 11:38:47',NULL,1,87,3,1,NULL),(21,'Area Administration Office, Mangalbare, Ilam','area-administration-office-mangalbare-ilam',NULL,'Mangalbare','2022-09-08 12:05:47','2022-09-08 12:05:47',NULL,1,90,4,17,NULL),(22,'Area Administration Office, Damak','area-administration-office-damak',NULL,'Damak','2022-09-09 05:40:38','2022-09-09 05:40:38',NULL,1,80,4,18,NULL),(23,'ऊर्जा, सिंचाइ तथा जलस्रोत मन्त्रालय','uura-ja-sa-ca-i-tatha-jalsa-ra-ta-mana-ta-ra-lya',NULL,'सिंहदरबार','2022-09-20 06:31:07','2022-09-20 06:31:07',NULL,NULL,NULL,1,NULL,1),(24,'विद्युत विकास विभाग','va-tha-ya-ta-va-ka-sa-va-bha-ga',NULL,'सानो गौचरन, काठमाडौं','2022-09-20 06:33:14','2022-09-20 06:33:14',NULL,NULL,NULL,2,23,1),(25,'अर्थ मन्त्रालय','ara-tha-mana-ta-ra-lya',NULL,'सिंहदरबार','2022-11-09 09:00:29','2022-11-09 09:00:29',NULL,NULL,NULL,1,NULL,1),(26,'आन्तरिक राजस्व विभाग','aana-tara-ka-ra-jasa-va-va-bha-ga',NULL,'लाजिम्पाट, काठमाडौं','2022-11-09 09:01:34','2022-11-09 09:01:34',NULL,NULL,NULL,2,25,1),(27,'आन्तरिक राजस्व कार्यालय, पुतलीसडक','aana-tara-ka-ra-jasa-va-ka-ra-ya-lya-pa-tal-sadaka',NULL,'पुतलीसडक, काठमाडौं','2022-11-09 09:03:02','2022-11-09 09:03:02',NULL,3,110,5,26,1),(28,'जिल्ला प्रशासन कार्यालय, नुवाकोट','ja-l-l-pa-rasha-sana-ka-ra-ya-lya-na-va-ka-ta',NULL,'विदुर, नुवाकोट','2022-11-09 09:05:23','2022-11-09 09:05:41',NULL,3,104,3,1,1),(29,'इलाका प्रशासन कार्यालय, सातबिसे, नुवाकोट','il-ka-pa-rasha-sana-ka-ra-ya-lya-sa-tab-sa-na-va-ka-ta',NULL,'सातबिसे, नुवाकोट','2022-11-09 09:06:39','2022-11-09 09:06:39',NULL,3,104,4,28,1);
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameters`
--

DROP TABLE IF EXISTS `parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parameters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort` int DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subject_area_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `parameters_slug_unique` (`slug`),
  KEY `parameters_subject_area_id_foreign` (`subject_area_id`),
  CONSTRAINT `parameters_subject_area_id_foreign` FOREIGN KEY (`subject_area_id`) REFERENCES `subject_areas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameters`
--

LOCK TABLES `parameters` WRITE;
/*!40000 ALTER TABLE `parameters` DISABLE KEYS */;
INSERT INTO `parameters` VALUES (1,'नेपालको संविधानबमोजिमको कार्य विस्तृतीकरण प्रतिवेदन तथा नेपाल सरकार(कार्य विभाजन) नियमावलीबमोजिम निर्माण गर्नुपर्ने नीति तथा कानुनको पहिचान तथा निर्माणको अवस्था',1,'na-pa-lka-sa-va-thha-nabma-ja-maka-ka-ra-ya-va-sa-ta-ta-karanae-pa-rata-va-thana-tatha-na-pa-l-saraka-ra-ka-ra-ya-va-bha-jana-na-yama-val-bma-ja-ma-na-ra-ma-nae-gara-na-para-na-na-ta-tatha-ka','प्रादेशिक निकायका हकमा प्रदेश सरकार(कार्यविभाजन) नियमावली बमोजिम',1,'2022-09-06 05:09:10','2022-09-06 05:09:10',NULL,1),(2,'सम्बन्धित निकायको विद्यमान नीति तथा कानुनबमोजिम निर्माण गर्नुपर्ने नियमावली, कार्यविधि, निर्देशिका, मापदण्ड पहिचान गरी निर्माणको अवस्था',6,'sama-bna-thha-ta-na-ka-yaka-va-tha-yama-na-na-ta-tatha-ka-na-nabma-ja-ma-na-ra-ma-nae-gara-na-para-na-na-yama-val-ka-ra-yava-thha-na-ra-tha-sha-ka-ma-pathanae-da-paha-ca-na-gara-na-ra-ma-naek',NULL,1,'2022-09-06 05:14:16','2022-09-06 05:14:16',NULL,1),(3,'नीति कार्यान्वयनको आवधिक समीक्षा तथा नीति परीक्षणको अवस्था',11,'na-ta-ka-ra-ya-na-vayanaka-aavathha-ka-sama-ka-shha-tatha-na-ta-para-ka-shhanaeka-avasa-tha','नीतिको आवधिक समीक्षा अवधि प्रत्येक दुई वर्ष तथा नीति परीक्षणको अवधि प्रत्येक पाँच वर्षमा गर्नुपर्ने',1,'2022-09-06 05:18:06','2022-09-06 05:18:06',NULL,1),(4,'५',16,'','स्वीकृत दरबन्दीबमोजिमको कर्मचारी पदपूर्तिको अवस्था',2,'2022-09-20 06:27:47','2022-09-20 06:27:47',NULL,1);
/*!40000 ALTER TABLE `parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `role_id` int unsigned NOT NULL,
  `permission_id` int unsigned NOT NULL,
  KEY `role_id_fk_1396911` (`role_id`),
  KEY `permission_id_fk_1396911` (`permission_id`),
  CONSTRAINT `permission_id_fk_1396911` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_fk_1396911` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,47),(1,48),(1,49),(1,50),(1,51),(1,52),(1,53),(1,54),(1,55),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,75),(1,76),(1,77),(1,78),(1,79),(1,80),(1,81),(1,82),(1,83),(1,84),(2,1),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(2,33),(2,34),(2,35),(2,36),(2,37),(2,38),(2,39),(2,40),(2,41),(2,42),(2,43),(2,44),(2,45),(2,46),(2,47),(2,48),(2,49),(2,50),(2,51),(2,52),(2,53),(2,54),(2,55),(2,56),(2,57),(2,58),(2,59),(2,60),(2,66),(2,67),(2,68),(2,69),(2,70),(2,71),(2,72),(2,73),(2,74),(2,75),(2,76),(2,77),(2,78),(2,79),(2,80),(2,81),(2,82),(2,83),(2,84),(3,17),(3,18),(3,19),(3,20),(3,21),(3,22),(3,23),(3,24),(3,25),(3,26),(3,27),(3,28),(3,29),(3,30),(3,31),(3,32),(3,33),(3,34),(3,35),(3,36),(3,37),(3,38),(3,39),(3,40),(3,41),(3,42),(3,43),(3,44),(3,45),(3,46),(3,47),(3,48),(3,49),(3,50),(3,51),(3,52),(3,53),(3,54),(3,55),(3,56),(3,57),(3,58),(3,59),(3,60),(3,61),(3,62),(3,63),(3,64),(3,65),(3,66),(3,67),(3,68),(3,69),(3,70),(3,71),(3,72),(3,73),(3,74),(3,75),(3,76),(3,77),(3,78),(3,79),(3,80),(3,81),(3,82),(3,83),(3,84),(4,67),(4,68),(5,12),(5,13),(5,14),(5,15),(5,16),(5,51),(5,52),(5,53),(5,54),(5,55),(5,66),(5,67),(5,68),(6,67),(6,68),(6,69),(5,1),(5,85);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'user_management_access',NULL,NULL,NULL,'Access User Management'),(2,'permission_create',NULL,NULL,NULL,'Create Permission'),(3,'permission_edit',NULL,NULL,NULL,'Edit Permission'),(4,'permission_show',NULL,NULL,NULL,'Show Permission'),(5,'permission_delete',NULL,NULL,NULL,'Delete Permission'),(6,'permission_access',NULL,NULL,NULL,'Access Permission'),(7,'role_create',NULL,NULL,NULL,'Role Create'),(8,'role_edit',NULL,NULL,NULL,'Role Edit'),(9,'role_show',NULL,NULL,NULL,'Role Show'),(10,'role_delete',NULL,NULL,NULL,'Role Delete'),(11,'role_access',NULL,NULL,NULL,'Role Access'),(12,'user_create',NULL,NULL,NULL,'User Create'),(13,'user_edit',NULL,NULL,NULL,'User Edit'),(14,'user_show',NULL,NULL,NULL,'Show User'),(15,'user_delete',NULL,NULL,NULL,'Delete User'),(16,'user_access',NULL,NULL,NULL,'Access User'),(17,'cms_access',NULL,NULL,NULL,'Access CMS'),(18,'product_category_create',NULL,NULL,NULL,'Create Product Category'),(19,'product_category_edit',NULL,NULL,NULL,'Edit Product Category'),(20,'product_category_show',NULL,NULL,NULL,'Show Product Category'),(21,'product_category_delete',NULL,NULL,NULL,'Delete Product Category'),(22,'product_category_access',NULL,NULL,NULL,'Access Product Category'),(23,'slider_access',NULL,NULL,NULL,'Access Slider'),(24,'slider_create',NULL,NULL,NULL,'Create Slider'),(25,'slider_edit',NULL,NULL,NULL,'Edit Slider'),(26,'slider_show',NULL,NULL,NULL,'Show Slider'),(27,'slider_delete',NULL,NULL,NULL,'Delete Slider'),(28,'popup_access',NULL,NULL,NULL,'Access Popup'),(29,'popup_create',NULL,NULL,NULL,'Create Popup'),(30,'popup_edit',NULL,NULL,NULL,'Edit Popup'),(31,'popup_show',NULL,NULL,NULL,'Show Popup'),(32,'popup_delete',NULL,NULL,NULL,'Delete Popup'),(33,'setting_create',NULL,NULL,NULL,'Create Setting'),(34,'product_management_access',NULL,NULL,NULL,'Access Product Management'),(35,'profile_password_edit',NULL,NULL,NULL,'Edit Profile Password'),(36,'subject_area_create',NULL,NULL,NULL,'Create Subject Area'),(37,'subject_area_edit',NULL,NULL,NULL,'Edit Subject Area'),(38,'subject_area_show',NULL,NULL,NULL,'Show Subject Area'),(39,'subject_area_delete',NULL,NULL,NULL,'Delete Subject Area'),(40,'subject_area_access',NULL,NULL,NULL,'Access Subject Area'),(41,'parameter_create',NULL,NULL,NULL,'Create Parameter'),(42,'parameter_edit',NULL,NULL,NULL,'Edit Parameter'),(43,'parameter_show',NULL,NULL,NULL,'Show Parameter'),(44,'parameter_delete',NULL,NULL,NULL,'Delete Parameter'),(45,'parameter_access',NULL,NULL,NULL,'Access Parameter'),(46,'province_create',NULL,NULL,NULL,'Create Province'),(47,'province_edit',NULL,NULL,NULL,'Edit Province'),(48,'province_show',NULL,NULL,NULL,'Show Province'),(49,'province_delete',NULL,NULL,NULL,'Delete Province'),(50,'province_access',NULL,NULL,NULL,'Access Province'),(51,'organization_create',NULL,NULL,NULL,'Create Organization'),(52,'organization_edit',NULL,NULL,NULL,'Edit Organization'),(53,'organization_show',NULL,NULL,NULL,'Show Organization'),(54,'organization_delete',NULL,NULL,NULL,'Delete Organization'),(55,'organization_access',NULL,NULL,NULL,'Access Organization'),(56,'document_create',NULL,NULL,NULL,'Create Document'),(57,'document_edit',NULL,NULL,NULL,'Edit Document'),(58,'document_show',NULL,NULL,NULL,'Show Document'),(59,'document_delete',NULL,NULL,NULL,'Delete Document'),(60,'document_access',NULL,NULL,NULL,'Access Document'),(61,'group_create',NULL,NULL,NULL,'Create Group'),(62,'group_edit',NULL,NULL,NULL,'Edit Group'),(63,'group_show',NULL,NULL,NULL,'Show Group'),(64,'group_delete',NULL,NULL,NULL,'Delete Group'),(65,'group_access',NULL,NULL,NULL,'Access Group'),(66,'form_create',NULL,NULL,NULL,'Create Form'),(67,'form_edit',NULL,NULL,NULL,'Edit Form'),(68,'form_access',NULL,NULL,NULL,'Access Form'),(69,'form_publish',NULL,NULL,NULL,'Publish Form'),(70,'type_create',NULL,NULL,NULL,'Create Type'),(71,'type_edit',NULL,NULL,NULL,'Edit Type'),(72,'type_delete',NULL,NULL,NULL,'Delete Type'),(73,'type_show',NULL,NULL,NULL,'Show Type'),(74,'type_access',NULL,NULL,NULL,'Access Type'),(75,'governance_create',NULL,NULL,NULL,'Create Governance'),(76,'governance_edit',NULL,NULL,NULL,'Edit Governance'),(77,'governance_delete',NULL,NULL,NULL,'Delete Governance'),(78,'governance_show',NULL,NULL,NULL,'Show Governance'),(79,'governance_access',NULL,NULL,NULL,'Access Governance'),(80,'level_create',NULL,NULL,NULL,'Create Level'),(81,'level_edit',NULL,NULL,NULL,'Edit Level'),(82,'level_delete',NULL,NULL,NULL,'Delete Level'),(83,'level_show',NULL,NULL,NULL,'Show Level'),(84,'level_access',NULL,NULL,NULL,'Access Level'),(85,'access-sub-organization-forms','2022-09-14 07:38:51','2022-09-14 07:38:51',NULL,'Access Sub-organizations Forms');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `popups`
--

DROP TABLE IF EXISTS `popups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `popups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `popups`
--

LOCK TABLES `popups` WRITE;
/*!40000 ALTER TABLE `popups` DISABLE KEYS */;
/*!40000 ALTER TABLE `popups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` int unsigned DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_slug_unique` (`slug`),
  KEY `category_fk_1396947` (`category_id`),
  CONSTRAINT `category_fk_1396947` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provinces` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name_ne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` VALUES (1,'Province 1',NULL,NULL,NULL,'प्रदेश नं. १'),(2,'Madhesh Province',NULL,NULL,NULL,'मधेश प्रदेश'),(3,'Bagmati Province',NULL,NULL,NULL,'बागमती प्रदेश'),(4,'Gandaki Province',NULL,NULL,NULL,'गण्डकी प्रदेश'),(5,'Lumbini Province',NULL,NULL,NULL,'लुम्बिनी प्रदेश'),(6,'Karnali Province',NULL,NULL,NULL,'कर्णाली प्रदेश'),(7,'Sudurpashchim Province',NULL,NULL,NULL,'सुदुर पश्चिम प्रदेश');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `user_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  KEY `user_id_fk_1396920` (`user_id`),
  KEY `role_id_fk_1396920` (`role_id`),
  CONSTRAINT `role_id_fk_1396920` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_1396920` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(2,2),(3,5),(21,5),(22,4),(23,3),(22,6),(24,6);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_shareable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'IT Admin',NULL,NULL,NULL,'1',NULL,NULL,0),(2,'System Admin',NULL,NULL,NULL,'1',NULL,NULL,0),(3,'User',NULL,NULL,NULL,'1',NULL,NULL,0),(4,'Auditor','2022-09-09 10:40:10','2022-09-09 10:40:10',NULL,'1',NULL,NULL,0),(5,'Organization Admin','2022-09-09 10:42:17','2022-09-09 11:38:45',NULL,'1','1',NULL,1),(6,'Final Verifier','2022-09-09 10:42:37','2022-09-09 10:42:37',NULL,'1',NULL,NULL,0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `rightclick` tinyint NOT NULL DEFAULT '0',
  `inspect` tinyint NOT NULL DEFAULT '0',
  `wel_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w_email_enable` tinyint DEFAULT NULL,
  `meta_data_desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_data_keyword` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_ana` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_login_enable` tinyint DEFAULT NULL,
  `google_login_enable` tinyint DEFAULT NULL,
  `gitlab_login_enable` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Management Audit System, MoFAGA','634402b163627_nishan chhap.jpg','6347bff3355b4_npb.php','Copyright © 2022 Ministry of Federal Affairs and General Affairs','logo.png',NULL,'2022-10-13 07:36:19',NULL,0,0,'admin@admin.com',1,NULL,NULL,NULL,1,1,1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'product',1,'2022-10-13 06:50:39','2022-10-13 06:52:27','2022-10-13 06:52:27'),(2,'product',1,'2022-10-13 06:50:56','2022-10-13 07:04:34','2022-10-13 07:04:34');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_areas`
--

DROP TABLE IF EXISTS `subject_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject_areas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort` int DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject_areas_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_areas`
--

LOCK TABLES `subject_areas` WRITE;
/*!40000 ALTER TABLE `subject_areas` DISABLE KEYS */;
INSERT INTO `subject_areas` VALUES (1,'नीतिगत तथा कानुनी व्यवस्था',1,'na-ta-gata-tatha-ka-na-na-va-yavasa-tha','2022-09-06 05:04:02','2022-11-09 05:17:53',NULL,1),(2,'कर्मचारी प्रशासन तथा व्यवस्थापन',6,'va-shhayaka-shha-ta-ra-kara-maca-ra-pa-rasha-sana-tatha-va-yavasa-tha-pana','2022-09-20 06:24:09','2022-09-20 06:29:14',NULL,1);
/*!40000 ALTER TABLE `subject_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `types_slug_unique` (`slug`),
  KEY `types_type_id_foreign` (`type_id`),
  CONSTRAINT `types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'मन्त्रालय/सङ्‍घीय निकाय','ministry',NULL,'2022-09-07 10:50:31','2022-11-09 08:55:31',NULL),(2,'विभाग/विभागस्तरीय कार्यालय','department',1,'2022-09-07 10:50:46','2022-11-09 08:55:47',NULL),(3,'जिल्लास्तरीय कार्यालय','district',1,'2022-09-07 10:51:00','2022-11-09 08:56:07',NULL),(4,'जिल्ला कार्यालय अन्तर्गतका कार्यालय','area',3,'2022-09-07 10:51:12','2022-11-09 08:59:30',NULL),(5,'विभाग मातहतका कार्यालय','ka-ra-ya-lya',2,'2022-11-09 08:56:46','2022-11-09 08:59:09',NULL),(6,'मन्त्रालय/सङ्‍घीय निकाय मातहतका कार्यालय','ka-ra-ya-lya-1',1,'2022-11-09 08:57:09','2022-11-09 08:59:56',NULL);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `can_read_book` int NOT NULL DEFAULT '0',
  `contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muncipality` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teaching_level` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_district` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_muncipality` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_ward` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_street_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_principal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_details_user_id_index` (`user_id`),
  CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'IT Admin','itadmin@admin.com','2023-03-22 11:20:09','$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe',NULL,NULL,NULL,NULL,'',NULL,NULL,1,NULL),(2,'Admin','admin@admin.com','2023-03-22 11:20:09','$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe',NULL,NULL,NULL,NULL,'',NULL,NULL,1,NULL),(3,'User','user@user.com','2023-03-22 11:20:09','$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe',NULL,NULL,'2023-03-22 06:10:36',NULL,'','2',NULL,1,'11111'),(21,'Bikash','bikash@gmail.com','2023-03-22 11:58:18','$2y$10$ZM3MnT2vhYjywWNTLzgbSeO/nghcg4.5b5raezAzX11fvdu9P7RzO',NULL,'2023-03-22 06:13:18','2023-03-22 06:13:18',NULL,'2',NULL,NULL,1,'211765'),(22,'auditor','auditor@gmail.com','2023-03-22 12:07:00','$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe',NULL,'2023-03-22 06:22:00','2023-03-22 06:44:53',NULL,'2','2',NULL,1,'217065'),(23,'user-moha','moha-user@gmail.com','2023-03-22 12:07:55','$2y$10$Q3stoxq1AkWDhd0hm0x6J.MJrcVfmqv7OQ3hbCgaY0GijQTGP0xQW',NULL,'2023-03-22 06:22:56','2023-03-22 06:22:56',NULL,'2',NULL,NULL,1,'121212'),(24,'final','final@gmail.com','2023-03-22 12:33:20','$2y$10$noCrHgcaDXrbjASwvfDwmeMy517skJdOjeKvNYwGaPezP7/MHF5NW',NULL,'2023-03-22 06:48:20','2023-03-22 06:48:20',NULL,'2',NULL,NULL,1,'121223');
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

-- Dump completed on 2023-03-24 12:52:27
