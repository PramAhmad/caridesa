-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: cari_desa6c7469ff-ba26-40d1-97fa-348cbeaf400d
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.10.1

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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_products`
--

DROP TABLE IF EXISTS `category_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama kategori produk',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Slug kategori produk',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi kategori produk',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif kategori produk',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_products`
--

LOCK TABLES `category_products` WRITE;
/*!40000 ALTER TABLE `category_products` DISABLE KEYS */;
INSERT INTO `category_products` VALUES (1,'2025-06-17 02:47:57','2025-06-17 02:47:57','Makanan Tradisional','makanan-tradisional','digunakan untuk makanan',1,NULL),(2,'2025-06-17 02:48:15','2025-06-17 02:48:15','Pakaian','pakaian','Digunakan untuk pakaian',1,NULL),(4,'2025-06-17 03:12:47','2025-06-17 03:12:47','Kerajinan Tangan','kerajinan-tangan','Produk kerajinan tangan buatan warga desa dengan kualitas tinggi dan desain unik.',1,NULL),(5,'2025-06-17 03:12:47','2025-06-17 03:12:47','Hasil Pertanian','hasil-pertanian','Produk segar dari hasil pertanian lokal yang berkualitas dan organik.',1,NULL),(6,'2025-06-17 03:12:47','2025-06-17 03:12:47','Minuman Herbal','minuman-herbal','Minuman herbal alami dari tanaman obat tradisional untuk kesehatan.',1,NULL),(7,'2025-06-17 03:12:47','2025-06-17 03:12:47','Tekstil & Batik','tekstil-batik','Produk tekstil dan batik dengan motif khas daerah yang indah dan berkualitas.',1,NULL),(8,'2025-06-17 03:12:47','2025-06-17 03:12:47','Produk Olahan','produk-olahan','Berbagai produk olahan makanan dan minuman hasil inovasi warga desa.',0,NULL);
/*!40000 ALTER TABLE `category_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_wisatas`
--

DROP TABLE IF EXISTS `category_wisatas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_wisatas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_wisatas_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_wisatas`
--

LOCK TABLES `category_wisatas` WRITE;
/*!40000 ALTER TABLE `category_wisatas` DISABLE KEYS */;
INSERT INTO `category_wisatas` VALUES (1,'2025-06-18 06:08:23','2025-06-18 06:08:23','Wisata Alam','wisata-alam','Ini adalah Wisata Alam',1);
/*!40000 ALTER TABLE `category_wisatas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_images`
--

DROP TABLE IF EXISTS `event_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_images_event_id_foreign` (`event_id`),
  CONSTRAINT `event_images_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_images`
--

LOCK TABLES `event_images` WRITE;
/*!40000 ALTER TABLE `event_images` DISABLE KEYS */;
INSERT INTO `event_images` VALUES (1,'2025-06-20 04:32:54','2025-06-20 04:32:54','/image/events/1750419174_tmE4nLq8lY.jpeg',1),(2,'2025-06-20 04:32:54','2025-06-20 04:32:54','/image/events/1750419174_P9S5Nx18jm.jpeg',1);
/*!40000 ALTER TABLE `event_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama acara',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Slug acara',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi acara',
  `start_date` datetime NOT NULL COMMENT 'Tanggal dan waktu mulai acara',
  `end_date` datetime NOT NULL COMMENT 'Tanggal dan waktu selesai acara',
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Lokasi acara',
  `organizer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Penyelenggara acara',
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Email kontak penyelenggara',
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Telepon kontak penyelenggara',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif acara',
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'2025-06-20 04:32:54','2025-06-20 04:32:54','Tarian mahabarata','tarian-mahabarata','Tarian ini sangat bagus ada 10 oenari terkuat dibumi yang disatukan agar bisa membantu satu sama lain','2025-06-20 18:32:00','2025-06-23 18:32:00','Jl purbaratu kp cihaji saroja uu','pramudita','pramu@mail.com','0859138483542',1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guide_images`
--

DROP TABLE IF EXISTS `guide_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guide_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama gambar pemandu wisata',
  `guide_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `guide_images_guide_id_foreign` (`guide_id`),
  CONSTRAINT `guide_images_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guide_images`
--

LOCK TABLES `guide_images` WRITE;
/*!40000 ALTER TABLE `guide_images` DISABLE KEYS */;
INSERT INTO `guide_images` VALUES (1,'2025-06-20 16:17:40','2025-06-20 16:17:40','/image/guides/1750461460_iwMtqXCPKa.jpg',1),(2,'2025-06-20 16:17:40','2025-06-20 16:17:40','/image/guides/1750461460_dI6qMA5qzQ.jpg',1);
/*!40000 ALTER TABLE `guide_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guides`
--

DROP TABLE IF EXISTS `guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama wisata',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Alamat wisata',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor telepon wisata',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Email wisata',
  `description` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi wisata',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Harga wisata',
  `discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Persentase diskon wisata',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif wisata',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guides`
--

LOCK TABLES `guides` WRITE;
/*!40000 ALTER TABLE `guides` DISABLE KEYS */;
INSERT INTO `guides` VALUES (1,'2025-06-20 16:17:40','2025-06-20 16:17:40','Galungung Jeep Offroad','JL galungung perum bumi asri','0859138483542','pramu@mail.com','Rasakan pengalaman manantang adrenalin dengan menaiki jeep mobil terkuat',500000.00,5.00,1);
/*!40000 ALTER TABLE `guides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_stay_images`
--

DROP TABLE IF EXISTS `home_stay_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_stay_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_stay_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `home_stay_images_home_stay_id_foreign` (`home_stay_id`),
  CONSTRAINT `home_stay_images_home_stay_id_foreign` FOREIGN KEY (`home_stay_id`) REFERENCES `home_stays` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_stay_images`
--

LOCK TABLES `home_stay_images` WRITE;
/*!40000 ALTER TABLE `home_stay_images` DISABLE KEYS */;
INSERT INTO `home_stay_images` VALUES (1,'2025-06-18 18:06:43','2025-06-18 18:06:43','/image/homestays/1750295203_iDOc8Q93Ui.png',2),(2,'2025-06-18 18:06:43','2025-06-18 18:06:43','/image/homestays/1750295203_ZmUi19oQhh.jpg',2);
/*!40000 ALTER TABLE `home_stay_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_stays`
--

DROP TABLE IF EXISTS `home_stays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_stays` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_stays`
--

LOCK TABLES `home_stays` WRITE;
/*!40000 ALTER TABLE `home_stays` DISABLE KEYS */;
INSERT INTO `home_stays` VALUES (2,'2025-06-18 18:06:43','2025-06-18 18:06:43','Rumah Pramudita','Jl raya cihaji city maniak wadidaw terkuat','0859138483542','pramudita@gmail.com','rumah terkuat yang pernah ada',900000.00,5.00,1);
/*!40000 ALTER TABLE `home_stays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2023_12_20_080838_create_permission_tables',1),(5,'2024_05_22_000001_add_module_and_description_to_permissions',1),(6,'2024_07_31_133819_add_description_to_roles_table',1),(7,'2025_05_25_111151_create_tenant_settings_table',2),(8,'2025_05_25_164814_create_activity_log_table',3),(9,'create_themes_table',4),(10,'2025_06_17_092239_create_category_products_table',5),(11,'2025_06_17_092414_create_products_table',5),(12,'2025_06_17_123521_create_category_wisatas_table',6),(13,'2025_06_18_123218_create_wisatas_table',6),(14,'2025_06_19_123214_create_wisata_images_table',6),(15,'2025_06_18_124221_is_active_category_products',7),(16,'2025_06_19_000023_create_home_stays_table',8),(17,'2025_06_19_000038_create_home_stay_images_table',8),(18,'2025_06_20_111642_create_guides_table',9),(19,'2025_06_20_112111_create_guide_images_table',9),(20,'2025_06_19_011233_create_events_table',10),(21,'2025_06_19_011237_create_event_images_table',10),(22,'2025_06_21_095210_add_view_links_in_produtcs',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'users',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view-users','web','users','View the list of users','2025-06-13 07:25:28','2025-06-17 02:44:55'),(2,'create-users','web','users','Create new users','2025-06-13 07:25:28','2025-06-17 02:44:55'),(3,'update-users','web','users','Update existing users','2025-06-13 07:25:28','2025-06-17 02:44:55'),(4,'delete-users','web','users','Delete users','2025-06-13 07:25:28','2025-06-17 02:44:55'),(5,'export-users','web','users','Export users data','2025-06-13 07:25:28','2025-06-13 07:25:28'),(6,'import-users','web','users','Import users data','2025-06-13 07:25:28','2025-06-13 07:25:28'),(7,'view-roles','web','roles','View the list of roles','2025-06-13 07:25:28','2025-06-17 02:44:55'),(8,'create-roles','web','roles','Create new permissions','2025-06-13 07:25:28','2025-06-17 02:44:55'),(9,'update-roles','web','roles','Update existing roles','2025-06-13 07:25:28','2025-06-17 02:44:55'),(10,'delete-roles','web','roles','Delete roles','2025-06-13 07:25:28','2025-06-13 07:25:28'),(11,'view-permissions','web','permissions','View the list of permissions','2025-06-13 07:25:28','2025-06-17 02:44:55'),(12,'create-permissions','web','permissions','Create new permissions','2025-06-13 07:25:28','2025-06-13 07:25:28'),(13,'update-permissions','web','permissions','Update existing permissions','2025-06-13 07:25:28','2025-06-17 02:44:55'),(14,'delete-permissions','web','permissions','Delete permissions','2025-06-13 07:25:28','2025-06-13 07:25:28'),(15,'view-dashboard','web','dashboard','View the main dashboard','2025-06-13 07:25:28','2025-06-17 02:44:55'),(16,'view-analytics','web','dashboard','View analytics and statistics','2025-06-13 07:25:28','2025-06-13 07:25:28'),(17,'view-reports','web','reports','View all reports','2025-06-13 07:25:28','2025-06-17 02:44:55'),(18,'export-reports','web','reports','Export reports data','2025-06-13 07:25:28','2025-06-17 02:44:55'),(19,'generate-reports','web','reports','Generate new reports','2025-06-13 07:25:28','2025-06-13 07:25:28'),(20,'manage-system-settings','web','system','Manage system configuration and settings','2025-06-13 07:25:28','2025-06-17 02:44:55'),(21,'view-logs','web','system','View system logs','2025-06-13 07:25:28','2025-06-17 02:44:55'),(22,'manage-backups','web','system','Manage system backups','2025-06-13 07:25:28','2025-06-17 02:44:55'),(23,'update-profile','web','profile','Update own profile information','2025-06-13 07:25:28','2025-06-17 02:44:55'),(24,'change-password','web','profile','Change own password','2025-06-13 07:25:28','2025-06-17 02:44:55'),(25,'manage-themes','web','themes','Full theme management access','2025-06-13 12:56:16','2025-06-13 12:56:16'),(26,'view-themes','web','themes','View available themes and their settings','2025-06-13 12:56:16','2025-06-13 12:56:16'),(27,'create-themes','web','themes','Create new themes','2025-06-13 12:56:16','2025-06-13 12:56:16'),(28,'edit-themes','web','themes','Edit theme settings and configurations','2025-06-13 12:56:16','2025-06-13 12:56:16'),(29,'delete-themes','web','themes','Delete themes','2025-06-13 12:56:16','2025-06-13 12:56:16'),(30,'activate-themes','web','themes','Activate/deactivate themes','2025-06-13 12:56:16','2025-06-13 12:56:16'),(31,'edit-theme-content','web','themes','Edit theme content and sections','2025-06-13 12:56:16','2025-06-13 12:56:16'),(32,'upload-theme-assets','web','themes','Upload theme images and assets','2025-06-13 12:56:16','2025-06-13 12:56:16'),(33,'manage-products','web','products','Full product management access','2025-06-17 03:17:15','2025-06-17 03:17:15'),(34,'view-products','web','products','View products list and details','2025-06-17 03:17:15','2025-06-17 03:17:15'),(35,'create-products','web','products','Create new products','2025-06-17 03:17:15','2025-06-17 03:17:15'),(36,'edit-products','web','products','Edit existing products','2025-06-17 03:17:15','2025-06-17 03:17:15'),(37,'delete-products','web','products','Delete products','2025-06-17 03:17:15','2025-06-17 03:17:15'),(38,'upload-product-images','web','products','Upload product images','2025-06-17 03:17:15','2025-06-17 03:17:15'),(39,'manage-product-stock','web','products','Manage product stock status','2025-06-17 03:17:15','2025-06-17 03:17:15'),(40,'set-product-discounts','web','products','Set product discounts and promotions','2025-06-17 03:17:15','2025-06-17 03:17:15'),(41,'export-products','web','products','Export products data','2025-06-17 03:17:15','2025-06-17 03:17:15'),(42,'import-products','web','products','Import products data','2025-06-17 03:17:15','2025-06-17 03:17:15'),(43,'publish-products','web','products','Publish/unpublish products','2025-06-17 03:17:15','2025-06-17 03:17:15'),(44,'duplicate-products','web','products','Duplicate existing products','2025-06-17 03:17:15','2025-06-17 03:17:15'),(45,'manage-categories','web','categories','Full category management access','2025-06-17 03:17:15','2025-06-17 03:17:15'),(46,'view-categories','web','categories','View product categories','2025-06-17 03:17:15','2025-06-17 03:17:15'),(47,'create-categories','web','categories','Create new product categories','2025-06-17 03:17:15','2025-06-17 03:17:15'),(48,'edit-categories','web','categories','Edit existing categories','2025-06-17 03:17:15','2025-06-17 03:17:15'),(49,'delete-categories','web','categories','Delete categories','2025-06-17 03:17:15','2025-06-17 03:17:15'),(50,'organize-categories','web','categories','Organize and structure categories','2025-06-17 03:17:15','2025-06-17 03:17:15'),(51,'export-categories','web','categories','Export categories data','2025-06-17 03:17:15','2025-06-17 03:17:15'),(52,'import-categories','web','categories','Import categories data','2025-06-17 03:17:15','2025-06-17 03:17:15'),(53,'view-product-analytics','web','product-analytics','View product performance analytics','2025-06-17 03:17:15','2025-06-17 03:17:15'),(54,'view-product-reports','web','product-analytics','View detailed product reports','2025-06-17 03:17:15','2025-06-17 03:17:15'),(55,'export-product-analytics','web','product-analytics','Export product analytics data','2025-06-17 03:17:15','2025-06-17 03:17:15'),(56,'view-sales-statistics','web','product-analytics','View product sales statistics','2025-06-17 03:17:15','2025-06-17 03:17:15'),(57,'view-inventory-reports','web','product-analytics','View inventory and stock reports','2025-06-17 03:17:15','2025-06-17 03:17:15'),(58,'manage-product-seo','web','product-seo','Manage product SEO settings','2025-06-17 03:17:15','2025-06-17 03:17:15'),(59,'edit-product-meta','web','product-seo','Edit product meta descriptions and keywords','2025-06-17 03:17:15','2025-06-17 03:17:15'),(60,'manage-product-urls','web','product-seo','Manage product URLs and slugs','2025-06-17 03:17:15','2025-06-17 03:17:15'),(61,'optimize-product-content','web','product-seo','Optimize product content for SEO','2025-06-17 03:17:15','2025-06-17 03:17:15'),(62,'manage-wisatas','web','wisatas','Full wisata management access','2025-06-18 05:52:46','2025-06-18 05:52:46'),(63,'view-wisatas','web','wisatas','View wisatas list and details','2025-06-18 05:52:46','2025-06-18 05:52:46'),(64,'create-wisatas','web','wisatas','Create new wisatas','2025-06-18 05:52:46','2025-06-18 05:52:46'),(65,'edit-wisatas','web','wisatas','Edit existing wisatas','2025-06-18 05:52:46','2025-06-18 05:52:46'),(66,'delete-wisatas','web','wisatas','Delete wisatas','2025-06-18 05:52:46','2025-06-18 05:52:46'),(67,'upload-wisata-images','web','wisatas','Upload wisata images and galleries','2025-06-18 05:52:46','2025-06-18 05:52:46'),(68,'manage-wisata-status','web','wisatas','Manage wisata active/inactive status','2025-06-18 05:52:46','2025-06-18 05:52:46'),(69,'set-wisata-pricing','web','wisatas','Set wisata ticket prices and packages','2025-06-18 05:52:46','2025-06-18 05:52:46'),(70,'export-wisatas','web','wisatas','Export wisatas data','2025-06-18 05:52:46','2025-06-18 05:52:46'),(71,'import-wisatas','web','wisatas','Import wisatas data','2025-06-18 05:52:46','2025-06-18 05:52:46'),(72,'publish-wisatas','web','wisatas','Publish/unpublish wisatas','2025-06-18 05:52:46','2025-06-18 05:52:46'),(73,'duplicate-wisatas','web','wisatas','Duplicate existing wisatas','2025-06-18 05:52:46','2025-06-18 05:52:46'),(74,'manage-wisata-facilities','web','wisatas','Manage wisata facilities and amenities','2025-06-18 05:52:46','2025-06-18 05:52:46'),(75,'manage-wisata-schedules','web','wisatas','Manage wisata opening hours and schedules','2025-06-18 05:52:46','2025-06-18 05:52:46'),(76,'manage-category-wisatas','web','category-wisatas','Full category wisata management access','2025-06-18 05:52:46','2025-06-18 05:52:46'),(77,'view-category-wisatas','web','category-wisatas','View wisata categories','2025-06-18 05:52:46','2025-06-18 05:52:46'),(78,'create-category-wisatas','web','category-wisatas','Create new wisata categories','2025-06-18 05:52:46','2025-06-18 05:52:46'),(79,'edit-category-wisatas','web','category-wisatas','Edit existing wisata categories','2025-06-18 05:52:46','2025-06-18 05:52:46'),(80,'delete-category-wisatas','web','category-wisatas','Delete wisata categories','2025-06-18 05:52:46','2025-06-18 05:52:46'),(81,'organize-category-wisatas','web','category-wisatas','Organize and structure wisata categories','2025-06-18 05:52:46','2025-06-18 05:52:46'),(82,'export-category-wisatas','web','category-wisatas','Export wisata categories data','2025-06-18 05:52:46','2025-06-18 05:52:46'),(83,'import-category-wisatas','web','category-wisatas','Import wisata categories data','2025-06-18 05:52:46','2025-06-18 05:52:46'),(84,'view-wisata-analytics','web','wisata-analytics','View wisata performance analytics','2025-06-18 05:52:46','2025-06-18 05:52:46'),(85,'view-wisata-reports','web','wisata-analytics','View detailed wisata reports','2025-06-18 05:52:46','2025-06-18 05:52:46'),(86,'export-wisata-analytics','web','wisata-analytics','Export wisata analytics data','2025-06-18 05:52:46','2025-06-18 05:52:46'),(87,'view-visitor-statistics','web','wisata-analytics','View wisata visitor statistics','2025-06-18 05:52:46','2025-06-18 05:52:46'),(88,'view-revenue-reports','web','homestay-analytics','View homestay revenue and booking reports','2025-06-18 05:52:46','2025-06-18 17:37:39'),(89,'view-popularity-metrics','web','wisata-analytics','View wisata popularity and rating metrics','2025-06-18 05:52:46','2025-06-18 05:52:46'),(90,'generate-wisata-insights','web','wisata-analytics','Generate wisata business insights','2025-06-18 05:52:46','2025-06-18 05:52:46'),(91,'manage-wisata-seo','web','wisata-marketing','Manage wisata SEO settings','2025-06-18 05:52:46','2025-06-18 05:52:46'),(92,'edit-wisata-meta','web','wisata-marketing','Edit wisata meta descriptions and keywords','2025-06-18 05:52:47','2025-06-18 05:52:47'),(93,'manage-wisata-urls','web','wisata-marketing','Manage wisata URLs and slugs','2025-06-18 05:52:47','2025-06-18 05:52:47'),(94,'optimize-wisata-content','web','wisata-marketing','Optimize wisata content for SEO','2025-06-18 05:52:47','2025-06-18 05:52:47'),(95,'manage-wisata-promotions','web','wisata-marketing','Manage wisata promotions and discounts','2025-06-18 05:52:47','2025-06-18 05:52:47'),(96,'create-wisata-packages','web','wisata-marketing','Create wisata tour packages','2025-06-18 05:52:47','2025-06-18 05:52:47'),(97,'manage-wisata-social-media','web','wisata-marketing','Manage wisata social media integration','2025-06-18 05:52:47','2025-06-18 05:52:47'),(98,'view-wisata-bookings','web','wisata-bookings','View wisata bookings and reservations','2025-06-18 05:52:47','2025-06-18 05:52:47'),(99,'manage-wisata-bookings','web','wisata-bookings','Manage wisata booking system','2025-06-18 05:52:47','2025-06-18 05:52:47'),(100,'process-wisata-payments','web','wisata-bookings','Process wisata booking payments','2025-06-18 05:52:47','2025-06-18 05:52:47'),(101,'handle-wisata-cancellations','web','wisata-bookings','Handle wisata booking cancellations','2025-06-18 05:52:47','2025-06-18 05:52:47'),(102,'manage-booking-calendar','web','homestay-bookings','Manage homestay availability calendar','2025-06-18 05:52:47','2025-06-18 17:37:40'),(103,'generate-booking-reports','web','homestay-bookings','Generate homestay booking reports','2025-06-18 05:52:47','2025-06-18 17:37:40'),(104,'view-wisata-reviews','web','wisata-reviews','View wisata reviews and ratings','2025-06-18 05:52:47','2025-06-18 05:52:47'),(105,'moderate-wisata-reviews','web','wisata-reviews','Moderate and manage wisata reviews','2025-06-18 05:52:47','2025-06-18 05:52:47'),(106,'respond-to-reviews','web','homestay-reviews','Respond to homestay reviews','2025-06-18 05:52:47','2025-06-18 17:37:40'),(107,'manage-review-settings','web','homestay-reviews','Manage homestay review system settings','2025-06-18 05:52:47','2025-06-18 17:37:40'),(108,'export-review-data','web','homestay-reviews','Export homestay review data','2025-06-18 05:52:47','2025-06-18 17:37:40'),(109,'manage-homestays','web','homestays','Full homestay management access','2025-06-18 17:37:39','2025-06-18 17:37:39'),(110,'view-homestays','web','homestays','View homestays list and details','2025-06-18 17:37:39','2025-06-18 17:37:39'),(111,'create-homestays','web','homestays','Create new homestays','2025-06-18 17:37:39','2025-06-18 17:37:39'),(112,'edit-homestays','web','homestays','Edit existing homestays','2025-06-18 17:37:39','2025-06-18 17:37:39'),(113,'delete-homestays','web','homestays','Delete homestays','2025-06-18 17:37:39','2025-06-18 17:37:39'),(114,'upload-homestay-images','web','homestays','Upload homestay images and galleries','2025-06-18 17:37:39','2025-06-18 17:37:39'),(115,'manage-homestay-status','web','homestays','Manage homestay active/inactive status','2025-06-18 17:37:39','2025-06-18 17:37:39'),(116,'set-homestay-pricing','web','homestays','Set homestay rates and pricing','2025-06-18 17:37:39','2025-06-18 17:37:39'),(117,'export-homestays','web','homestays','Export homestays data','2025-06-18 17:37:39','2025-06-18 17:37:39'),(118,'import-homestays','web','homestays','Import homestays data','2025-06-18 17:37:39','2025-06-18 17:37:39'),(119,'publish-homestays','web','homestays','Publish/unpublish homestays','2025-06-18 17:37:39','2025-06-18 17:37:39'),(120,'duplicate-homestays','web','homestays','Duplicate existing homestays','2025-06-18 17:37:39','2025-06-18 17:37:39'),(121,'manage-homestay-facilities','web','homestays','Manage homestay facilities and amenities','2025-06-18 17:37:39','2025-06-18 17:37:39'),(122,'manage-homestay-availability','web','homestays','Manage homestay room availability','2025-06-18 17:37:39','2025-06-18 17:37:39'),(123,'set-homestay-discounts','web','homestays','Set homestay discounts and promotions','2025-06-18 17:37:39','2025-06-18 17:37:39'),(124,'view-homestay-analytics','web','homestay-analytics','View homestay performance analytics','2025-06-18 17:37:39','2025-06-18 17:37:39'),(125,'view-homestay-reports','web','homestay-analytics','View detailed homestay reports','2025-06-18 17:37:39','2025-06-18 17:37:39'),(126,'export-homestay-analytics','web','homestay-analytics','Export homestay analytics data','2025-06-18 17:37:39','2025-06-18 17:37:39'),(127,'view-occupancy-statistics','web','homestay-analytics','View homestay occupancy statistics','2025-06-18 17:37:39','2025-06-18 17:37:39'),(128,'view-guest-statistics','web','homestay-analytics','View homestay guest statistics and demographics','2025-06-18 17:37:39','2025-06-18 17:37:39'),(129,'view-rating-metrics','web','homestay-analytics','View homestay rating and review metrics','2025-06-18 17:37:39','2025-06-18 17:37:39'),(130,'generate-homestay-insights','web','homestay-analytics','Generate homestay business insights','2025-06-18 17:37:39','2025-06-18 17:37:39'),(131,'view-seasonal-trends','web','homestay-analytics','View homestay seasonal booking trends','2025-06-18 17:37:39','2025-06-18 17:37:39'),(132,'manage-homestay-seo','web','homestay-marketing','Manage homestay SEO settings','2025-06-18 17:37:39','2025-06-18 17:37:39'),(133,'edit-homestay-meta','web','homestay-marketing','Edit homestay meta descriptions and keywords','2025-06-18 17:37:39','2025-06-18 17:37:39'),(134,'manage-homestay-urls','web','homestay-marketing','Manage homestay URLs and slugs','2025-06-18 17:37:39','2025-06-18 17:37:39'),(135,'optimize-homestay-content','web','homestay-marketing','Optimize homestay content for SEO','2025-06-18 17:37:39','2025-06-18 17:37:39'),(136,'manage-homestay-promotions','web','homestay-marketing','Manage homestay promotions and special offers','2025-06-18 17:37:39','2025-06-18 17:37:39'),(137,'create-homestay-packages','web','homestay-marketing','Create homestay packages and deals','2025-06-18 17:37:39','2025-06-18 17:37:39'),(138,'manage-homestay-social-media','web','homestay-marketing','Manage homestay social media integration','2025-06-18 17:37:39','2025-06-18 17:37:39'),(139,'manage-homestay-listings','web','homestay-marketing','Manage homestay listings on external platforms','2025-06-18 17:37:39','2025-06-18 17:37:39'),(140,'create-marketing-campaigns','web','homestay-marketing','Create homestay marketing campaigns','2025-06-18 17:37:39','2025-06-18 17:37:39'),(141,'view-homestay-bookings','web','homestay-bookings','View homestay bookings and reservations','2025-06-18 17:37:39','2025-06-18 17:37:39'),(142,'manage-homestay-bookings','web','homestay-bookings','Manage homestay booking system','2025-06-18 17:37:40','2025-06-18 17:37:40'),(143,'process-homestay-payments','web','homestay-bookings','Process homestay booking payments','2025-06-18 17:37:40','2025-06-18 17:37:40'),(144,'handle-homestay-cancellations','web','homestay-bookings','Handle homestay booking cancellations','2025-06-18 17:37:40','2025-06-18 17:37:40'),(145,'manage-check-in-out','web','homestay-bookings','Manage homestay check-in and check-out','2025-06-18 17:37:40','2025-06-18 17:37:40'),(146,'handle-booking-modifications','web','homestay-bookings','Handle homestay booking modifications','2025-06-18 17:37:40','2025-06-18 17:37:40'),(147,'manage-waiting-list','web','homestay-bookings','Manage homestay booking waiting list','2025-06-18 17:37:40','2025-06-18 17:37:40'),(148,'send-booking-confirmations','web','homestay-bookings','Send homestay booking confirmations','2025-06-18 17:37:40','2025-06-18 17:37:40'),(149,'view-homestay-reviews','web','homestay-reviews','View homestay reviews and ratings','2025-06-18 17:37:40','2025-06-18 17:37:40'),(150,'moderate-homestay-reviews','web','homestay-reviews','Moderate and manage homestay reviews','2025-06-18 17:37:40','2025-06-18 17:37:40'),(151,'flag-inappropriate-reviews','web','homestay-reviews','Flag inappropriate homestay reviews','2025-06-18 17:37:40','2025-06-18 17:37:40'),(152,'generate-review-reports','web','homestay-reviews','Generate homestay review analysis reports','2025-06-18 17:37:40','2025-06-18 17:37:40'),(153,'view-guest-profiles','web','homestay-guests','View homestay guest profiles','2025-06-18 17:37:40','2025-06-18 17:37:40'),(154,'manage-guest-communications','web','homestay-guests','Manage communications with homestay guests','2025-06-18 17:37:40','2025-06-18 17:37:40'),(155,'view-guest-history','web','homestay-guests','View homestay guest booking history','2025-06-18 17:37:40','2025-06-18 17:37:40'),(156,'manage-guest-preferences','web','homestay-guests','Manage homestay guest preferences','2025-06-18 17:37:40','2025-06-18 17:37:40'),(157,'handle-guest-requests','web','homestay-guests','Handle special guest requests','2025-06-18 17:37:40','2025-06-18 17:37:40'),(158,'manage-guest-feedback','web','homestay-guests','Manage homestay guest feedback','2025-06-18 17:37:40','2025-06-18 17:37:40'),(159,'create-guest-loyalty-programs','web','homestay-guests','Create guest loyalty programs','2025-06-18 17:37:40','2025-06-18 17:37:40'),(160,'send-guest-newsletters','web','homestay-guests','Send newsletters to homestay guests','2025-06-18 17:37:40','2025-06-18 17:37:40'),(161,'manage-homestay-maintenance','web','homestay-operations','Manage homestay maintenance schedules','2025-06-18 17:37:40','2025-06-18 17:37:40'),(162,'track-homestay-inventory','web','homestay-operations','Track homestay inventory and supplies','2025-06-18 17:37:40','2025-06-18 17:37:40'),(163,'manage-cleaning-schedules','web','homestay-operations','Manage homestay cleaning schedules','2025-06-18 17:37:40','2025-06-18 17:37:40'),(164,'handle-maintenance-requests','web','homestay-operations','Handle homestay maintenance requests','2025-06-18 17:37:40','2025-06-18 17:37:40'),(165,'manage-service-providers','web','homestay-operations','Manage homestay service providers','2025-06-18 17:37:40','2025-06-18 17:37:40'),(166,'track-operational-costs','web','homestay-operations','Track homestay operational costs','2025-06-18 17:37:40','2025-06-18 17:37:40'),(167,'manage-safety-protocols','web','homestay-operations','Manage homestay safety protocols','2025-06-18 17:37:40','2025-06-18 17:37:40'),(168,'generate-maintenance-reports','web','homestay-operations','Generate homestay maintenance reports','2025-06-18 17:37:40','2025-06-18 17:37:40'),(169,'view-homestay-finances','web','homestay-finance','View homestay financial data','2025-06-18 17:37:40','2025-06-18 17:37:40'),(170,'manage-homestay-expenses','web','homestay-finance','Manage homestay expenses and costs','2025-06-18 17:37:40','2025-06-18 17:37:40'),(171,'generate-financial-reports','web','homestay-finance','Generate homestay financial reports','2025-06-18 17:37:40','2025-06-18 17:37:40'),(172,'manage-tax-information','web','homestay-finance','Manage homestay tax information','2025-06-18 17:37:40','2025-06-18 17:37:40'),(173,'track-profit-loss','web','homestay-finance','Track homestay profit and loss','2025-06-18 17:37:40','2025-06-18 17:37:40'),(174,'manage-payment-methods','web','homestay-finance','Manage homestay payment methods','2025-06-18 17:37:40','2025-06-18 17:37:40'),(175,'handle-refunds','web','homestay-finance','Handle homestay booking refunds','2025-06-18 17:37:41','2025-06-18 17:37:41'),(176,'manage-invoicing','web','homestay-finance','Manage homestay invoicing system','2025-06-18 17:37:41','2025-06-18 17:37:41'),(177,'manage-events','web','events','Full event management access','2025-06-20 04:26:03','2025-06-20 04:26:03'),(178,'view-events','web','events','View events list and details','2025-06-20 04:26:03','2025-06-20 04:26:03'),(179,'create-events','web','events','Create new events','2025-06-20 04:26:03','2025-06-20 04:26:03'),(180,'edit-events','web','events','Edit existing events','2025-06-20 04:26:03','2025-06-20 04:26:03'),(181,'delete-events','web','events','Delete events','2025-06-20 04:26:03','2025-06-20 04:26:03'),(182,'publish-events','web','events','Publish/unpublish events','2025-06-20 04:26:04','2025-06-20 04:26:04'),(183,'toggle-event-status','web','events','Toggle event active status','2025-06-20 04:26:04','2025-06-20 04:26:04'),(184,'upload-event-images','web','event-images','Upload event images','2025-06-20 04:26:04','2025-06-20 04:26:04'),(185,'delete-event-images','web','event-images','Delete event images','2025-06-20 04:26:04','2025-06-20 04:26:04'),(186,'manage-event-gallery','web','event-images','Manage event image gallery','2025-06-20 04:26:04','2025-06-20 04:26:04'),(187,'view-event-analytics','web','event-analytics','View event analytics and statistics','2025-06-20 04:26:04','2025-06-20 04:26:04'),(188,'view-event-reports','web','event-analytics','View detailed event reports','2025-06-20 04:26:04','2025-06-20 04:26:04'),(189,'export-event-data','web','event-analytics','Export event data and reports','2025-06-20 04:26:04','2025-06-20 04:26:04'),(190,'view-event-calendar','web','event-calendar','View event calendar','2025-06-20 04:26:04','2025-06-20 04:26:04'),(191,'manage-event-schedule','web','event-calendar','Manage event scheduling','2025-06-20 04:26:04','2025-06-20 04:26:04'),(192,'view-upcoming-events','web','event-calendar','View upcoming events','2025-06-20 04:26:04','2025-06-20 04:26:04'),(193,'view-ongoing-events','web','event-calendar','View ongoing events','2025-06-20 04:26:04','2025-06-20 04:26:04'),(194,'manage-guides','web','guides','Full guide management access','2025-06-20 05:12:42','2025-06-20 05:12:42'),(195,'view-guides','web','guides','View guides list and details','2025-06-20 05:12:42','2025-06-20 05:12:42'),(196,'create-guides','web','guides','Create new guides','2025-06-20 05:12:42','2025-06-20 05:12:42'),(197,'edit-guides','web','guides','Edit existing guides','2025-06-20 05:12:42','2025-06-20 05:12:42'),(198,'delete-guides','web','guides','Delete guides','2025-06-20 05:12:42','2025-06-20 05:12:42'),(199,'publish-guides','web','guides','Publish/unpublish guides','2025-06-20 05:12:42','2025-06-20 05:12:42'),(200,'toggle-guide-status','web','guides','Toggle guide active status','2025-06-20 05:12:42','2025-06-20 05:12:42'),(201,'view-guide-details','web','guides','View detailed guide information','2025-06-20 05:12:42','2025-06-20 05:12:42'),(202,'manage-guide-pricing','web','guides','Manage guide pricing and discounts','2025-06-20 05:12:42','2025-06-20 05:12:42'),(203,'upload-guide-images','web','guide-images','Upload guide images','2025-06-20 05:12:42','2025-06-20 05:12:42'),(204,'delete-guide-images','web','guide-images','Delete guide images','2025-06-20 05:12:42','2025-06-20 05:12:42'),(205,'manage-guide-gallery','web','guide-images','Manage guide image gallery','2025-06-20 05:12:42','2025-06-20 05:12:42'),(206,'view-guide-images','web','guide-images','View guide images','2025-06-20 05:12:42','2025-06-20 05:12:42'),(207,'view-guide-analytics','web','guide-analytics','View guide analytics and statistics','2025-06-20 05:12:43','2025-06-20 05:12:43'),(208,'view-guide-reports','web','guide-analytics','View detailed guide reports','2025-06-20 05:12:43','2025-06-20 05:12:43'),(209,'export-guide-data','web','guide-analytics','Export guide data and reports','2025-06-20 05:12:43','2025-06-20 05:12:43'),(210,'view-guide-performance','web','guide-analytics','View guide performance metrics','2025-06-20 05:12:43','2025-06-20 05:12:43'),(211,'view-guide-bookings','web','guide-bookings','View guide bookings','2025-06-20 05:12:43','2025-06-20 05:12:43'),(212,'manage-guide-bookings','web','guide-bookings','Manage guide bookings','2025-06-20 05:12:43','2025-06-20 05:12:43'),(213,'approve-guide-bookings','web','guide-bookings','Approve guide bookings','2025-06-20 05:12:43','2025-06-20 05:12:43'),(214,'cancel-guide-bookings','web','guide-bookings','Cancel guide bookings','2025-06-20 05:12:43','2025-06-20 05:12:43'),(215,'view-booking-calendar','web','guide-bookings','View guide booking calendar','2025-06-20 05:12:43','2025-06-20 05:12:43'),(216,'view-guide-reviews','web','guide-reviews','View guide reviews and ratings','2025-06-20 05:12:43','2025-06-20 05:12:43'),(217,'manage-guide-reviews','web','guide-reviews','Manage guide reviews','2025-06-20 05:12:43','2025-06-20 05:12:43'),(218,'respond-guide-reviews','web','guide-reviews','Respond to guide reviews','2025-06-20 05:12:43','2025-06-20 05:12:43'),(219,'moderate-guide-reviews','web','guide-reviews','Moderate guide reviews','2025-06-20 05:12:43','2025-06-20 05:12:43'),(220,'view-guide-finances','web','guide-finances','View guide financial data','2025-06-20 05:12:43','2025-06-20 05:12:43'),(221,'manage-guide-payments','web','guide-finances','Manage guide payments','2025-06-20 05:12:43','2025-06-20 05:12:43'),(222,'view-guide-earnings','web','guide-finances','View guide earnings','2025-06-20 05:12:43','2025-06-20 05:12:43'),(223,'generate-guide-invoices','web','guide-finances','Generate guide invoices','2025-06-20 05:12:43','2025-06-20 05:12:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama produk',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Slug produk',
  `category_product_id` bigint unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi produk',
  `price` decimal(10,2) NOT NULL COMMENT 'Harga produk',
  `stock` enum('in_stock','out_of_stock','low_stock','preorder') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_stock' COMMENT 'Status stok produk',
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Diskon produk dalam persen',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif produk',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Gambar produk',
  `links` json DEFAULT NULL COMMENT 'Link ke olshop atau marketplace',
  `views` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_product_id_foreign` (`category_product_id`),
  CONSTRAINT `products_category_product_id_foreign` FOREIGN KEY (`category_product_id`) REFERENCES `category_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'2025-06-17 03:04:59','2025-06-18 05:31:14','Keripik Pisang','keripik-pisang',1,'Keripik Pisang ini memiliki kekuatan',1000000.00,'in_stock',10.00,1,'/image/products/1750249874_WI5S8h0ot5.png','{\"lazada\": \"https://tailwindcss.com/docs/colors\", \"shopee\": \"https://tailwindcss.com/docs/colors\", \"whatsapp\": \"0859138483542\", \"tokopedia\": \"https://tailwindcss.com/docs/colors\"}',0,NULL),(2,'2025-06-17 03:12:47','2025-06-17 03:12:47','Tas Anyaman Pandan','tas-anyaman-pandan',4,'Tas cantik dari anyaman daun pandan dengan kualitas premium. Ramah lingkungan dan tahan lama.',75000.00,'in_stock',0.00,1,NULL,'{\"instagram\": \"https://instagram.com/kerajinan-desa\", \"tokopedia\": \"https://tokopedia.com/tas-pandan\"}',0,NULL),(3,'2025-06-17 03:12:47','2025-06-17 03:12:47','Gelang Manik Tradisional','gelang-manik-tradisional',4,'Gelang manik-manik dengan motif tradisional yang indah. Cocok untuk aksesoris sehari-hari atau souvenir.',12000.00,'in_stock',20.00,1,NULL,NULL,0,NULL),(4,'2025-06-17 03:12:47','2025-06-17 03:12:47','Lukisan Kain Batik','lukisan-kain-batik',4,'Lukisan batik tulis dengan motif khas daerah. Karya seni yang memiliki nilai budaya tinggi.',150000.00,'preorder',0.00,1,NULL,'{\"website\": \"https://seni-batik-desa.com\", \"whatsapp\": \"6281234567891\"}',0,NULL),(5,'2025-06-17 03:12:47','2025-06-17 03:12:47','Beras Merah Organik','beras-merah-organik',5,'Beras merah organik berkualitas tinggi dari sawah lokal. Kaya nutrisi dan bebas pestisida.',18000.00,'in_stock',0.00,1,NULL,'{\"shopee\": \"https://shopee.co.id/beras-organik\", \"tokopedia\": \"https://tokopedia.com/beras-merah\"}',0,NULL),(6,'2025-06-17 03:12:47','2025-06-17 03:12:47','Cabai Rawit Segar','cabai-rawit-segar',5,'Cabai rawit segar dengan tingkat kepedasan tinggi. Dipetik langsung dari kebun untuk menjaga kesegaran.',45000.00,'in_stock',10.00,1,NULL,NULL,0,NULL),(7,'2025-06-17 03:12:47','2025-06-17 03:12:47','Jagung Manis','jagung-manis',5,'Jagung manis segar dengan biji yang berisi dan rasa yang manis alami. Cocok untuk berbagai olahan.',8000.00,'out_of_stock',0.00,1,NULL,NULL,0,NULL),(8,'2025-06-17 03:12:47','2025-06-17 03:12:47','Teh Daun Sirsak','teh-daun-sirsak',6,'Teh herbal dari daun sirsak kering dengan khasiat untuk kesehatan. Membantu meningkatkan daya tahan tubuh.',20000.00,'in_stock',0.00,1,NULL,'{\"whatsapp\": \"6281234567892\", \"tokopedia\": \"https://tokopedia.com/teh-sirsak\"}',0,NULL),(9,'2025-06-17 03:12:47','2025-06-20 20:54:08','Jamu Kunyit Asam','jamu-kunyit-asam',6,'Jamu tradisional kunyit asam dengan rasa segar dan khasiat untuk pencernaan. Dibuat dari bahan alami pilihan.',15000.00,'in_stock',5.00,1,'/image/products/1750478048_VhS35yE5Gj.jpeg','[]',0,NULL),(10,'2025-06-17 03:12:47','2025-06-17 03:12:47','Wedang Jahe Instan','wedang-jahe-instan',6,'Minuman jahe instan dengan rasa hangat dan pedas yang nikmat. Cocok untuk diminum saat cuaca dingin.',12000.00,'low_stock',15.00,1,NULL,NULL,0,NULL),(11,'2025-06-17 03:12:47','2025-06-17 03:12:47','Kain Batik Tulis Premium','kain-batik-tulis-premium',7,'Kain batik tulis dengan motif eksklusif dan kualitas premium. Cocok untuk baju formal atau koleksi.',250000.00,'preorder',0.00,1,NULL,'{\"website\": \"https://batik-desa-premium.com\", \"instagram\": \"https://instagram.com/batik-desa\"}',0,NULL),(12,'2025-06-17 03:12:47','2025-06-17 03:12:47','Selendang Tenun Tradisional','selendang-tenun-tradisional',7,'Selendang tenun dengan motif tradisional yang elegan. Hasil karya pengrajin lokal yang terampil.',85000.00,'in_stock',10.00,1,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(108,1),(109,1),(110,1),(111,1),(112,1),(113,1),(114,1),(115,1),(116,1),(117,1),(118,1),(119,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(128,1),(129,1),(130,1),(131,1),(132,1),(133,1),(134,1),(135,1),(136,1),(137,1),(138,1),(139,1),(140,1),(141,1),(142,1),(143,1),(144,1),(145,1),(146,1),(147,1),(148,1),(149,1),(150,1),(151,1),(152,1),(153,1),(154,1),(155,1),(156,1),(157,1),(158,1),(159,1),(160,1),(161,1),(162,1),(163,1),(164,1),(165,1),(166,1),(167,1),(168,1),(169,1),(170,1),(171,1),(172,1),(173,1),(174,1),(175,1),(176,1),(177,1),(178,1),(179,1),(180,1),(181,1),(182,1),(183,1),(184,1),(185,1),(186,1),(187,1),(188,1),(189,1),(190,1),(191,1),(192,1),(193,1),(194,1),(195,1),(196,1),(197,1),(198,1),(199,1),(200,1),(201,1),(202,1),(203,1),(204,1),(205,1),(206,1),(207,1),(208,1),(209,1),(210,1),(211,1),(212,1),(213,1),(214,1),(215,1),(220,1),(221,1),(222,1),(223,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(1,3),(2,3),(3,3),(5,3),(6,3),(7,3),(11,3),(15,3),(16,3),(17,3),(18,3),(19,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(30,3),(31,3),(32,3),(15,4),(23,4),(24,4),(15,5),(17,5),(18,5),(23,5),(24,5);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2025-06-13 07:25:28','2025-06-17 02:44:55','Super Admin role with full access to all features and functionality.'),(2,'admin','web','2025-06-13 07:25:29','2025-06-17 02:44:55','Administrator role with access to most features except critical system settings.'),(3,'manager','web','2025-06-13 07:25:29','2025-06-17 02:44:55','Manager role with access to common business functions but limited administrative capabilities.'),(4,'user','web','2025-06-13 07:25:29','2025-06-17 02:44:55','Basic user role with access to dashboard and profile management.'),(5,'editor','web','2025-06-13 07:25:29','2025-06-13 07:25:29','Editor role with permissions to create and edit content but not manage users or system settings.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'app_name','Desa Satu',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(2,'app_description',NULL,NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(3,'primary_color','#000000',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(4,'footer_text','© 2025 Perusahaan Anda. Semua hak dilindungi.',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(5,'timezone','Asia/Jakarta',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(6,'date_format','d/m/Y',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(7,'nomor_badan_hukum','12312312',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41'),(8,'mata_uang','USD',NULL,'2025-06-13 08:16:41','2025-06-13 08:16:41');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_contents`
--

DROP TABLE IF EXISTS `theme_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theme_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint unsigned NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `theme_contents_theme_id_foreign` (`theme_id`),
  CONSTRAINT `theme_contents_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_contents`
--

LOCK TABLES `theme_contents` WRITE;
/*!40000 ALTER TABLE `theme_contents` DISABLE KEYS */;
INSERT INTO `theme_contents` VALUES (17,6,'hero','Selamat Datang di Website Kami','Kami menyediakan layanan terbaik untuk kebutuhan Anda dengan teknologi terdepan dan tim profesional.',NULL,NULL,1,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(18,6,'about','Tentang Kami','Perusahaan yang bergerak di bidang teknologi informasi dengan pengalaman lebih dari 10 tahun.',NULL,NULL,2,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(19,6,'services','Layanan Kami','Kami menyediakan berbagai layanan teknologi untuk membantu bisnis Anda berkembang.',NULL,NULL,3,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(20,7,'hero','Selamat Datang di Website Kami','Kami menyediakan layanan terbaik untuk kebutuhan Anda dengan teknologi terdepan dan tim profesional.',NULL,NULL,1,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(21,7,'about','Tentang Kami','Perusahaan yang bergerak di bidang teknologi informasi dengan pengalaman lebih dari 10 tahun.',NULL,NULL,2,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(22,7,'services','Layanan Kami','Kami menyediakan berbagai layanan teknologi untuk membantu bisnis Anda berkembang.',NULL,NULL,3,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(23,8,'hero','Selamat Datang di Website Kami','Kami menyediakan layanan terbaik untuk kebutuhan Anda dengan teknologi terdepan dan tim profesional.',NULL,NULL,1,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(24,8,'about','Tentang Kami','Perusahaan yang bergerak di bidang teknologi informasi dengan pengalaman lebih dari 10 tahun.',NULL,NULL,2,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(25,8,'services','Layanan Kami','Kami menyediakan berbagai layanan teknologi untuk membantu bisnis Anda berkembang.',NULL,NULL,3,1,'2025-06-18 05:21:00','2025-06-18 05:21:00'),(26,9,'hero','Selamat Datang di Purbaratu','Kami merupakan desa dengan panorama dan keindahan terbaik, semoga kalian dapat menikmatinya','1750298606_99wgn38nah.jpeg',NULL,1,1,'2025-06-18 05:21:00','2025-06-18 19:04:26'),(27,9,'about','Tentang Kami','Perusahaan yang bergerak di bidang teknologi informasi dengan pengalaman lebih dari 10 tahun.',NULL,NULL,2,1,'2025-06-18 05:21:00','2025-06-18 19:04:26'),(28,9,'services','Layanan Kami','Kami menyediakan berbagai layanan teknologi untuk membantu bisnis Anda berkembang.',NULL,NULL,3,1,'2025-06-18 05:21:00','2025-06-18 19:04:26'),(29,9,'contact',NULL,NULL,NULL,NULL,0,1,'2025-06-18 19:03:26','2025-06-18 19:04:26');
/*!40000 ALTER TABLE `theme_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `preview_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `themes_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (6,'Soft Theme','soft','Theme dengan desain lembut dan gradasi warna',NULL,NULL,0,'2025-06-18 05:21:00','2025-06-18 19:02:48'),(7,'Modern Theme','modern','Theme dengan desain modern dan minimalis',NULL,NULL,0,'2025-06-18 05:21:00','2025-06-18 19:02:48'),(8,'Light Theme','light','Theme dengan desain terang dan bersih',NULL,NULL,0,'2025-06-18 05:21:00','2025-06-18 19:02:48'),(9,'Art Theme','art','Theme dengan desain artistik dan kreatif',NULL,NULL,1,'2025-06-18 05:21:00','2025-06-18 19:02:48');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'demo/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'desasatu','desasatu@mail.com','demo/default.png',NULL,'$2y$10$muXeagHp73ED6oGQ.OEFaO9PfRz.Ju5b3Zu6C1gEVrtaCwewmkupi',NULL,'2025-06-13 07:25:29','2025-06-13 07:25:29','desasatu',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wisata_images`
--

DROP TABLE IF EXISTS `wisata_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wisata_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wisata_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wisata_images_wisata_id_foreign` (`wisata_id`),
  CONSTRAINT `wisata_images_wisata_id_foreign` FOREIGN KEY (`wisata_id`) REFERENCES `wisatas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wisata_images`
--

LOCK TABLES `wisata_images` WRITE;
/*!40000 ALTER TABLE `wisata_images` DISABLE KEYS */;
INSERT INTO `wisata_images` VALUES (5,'2025-06-20 16:24:29','2025-06-20 16:24:29','/image/wisatas/1750461869_MuCdYYt9li.jpg',2),(6,'2025-06-20 16:24:29','2025-06-20 16:24:29','/image/wisatas/1750461869_oj4F6itC0y.jpg',2),(7,'2025-06-20 20:52:12','2025-06-20 20:52:12','/image/wisatas/1750477932_EY7UrZQAIy.jpg',1);
/*!40000 ALTER TABLE `wisata_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wisatas`
--

DROP TABLE IF EXISTS `wisatas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wisatas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `category_wisata_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wisatas_slug_unique` (`slug`),
  KEY `wisatas_category_wisata_id_foreign` (`category_wisata_id`),
  CONSTRAINT `wisatas_category_wisata_id_foreign` FOREIGN KEY (`category_wisata_id`) REFERENCES `category_wisatas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wisatas`
--

LOCK TABLES `wisatas` WRITE;
/*!40000 ALTER TABLE `wisatas` DISABLE KEYS */;
INSERT INTO `wisatas` VALUES (1,'2025-06-18 16:39:37','2025-06-18 16:39:37','Curug Badak Tasikmalaya','curug-badak-tasikmalaya','Ini adalah curug terkuat di tasikmalaya',-7.30702089,-7.30702089,1),(2,'2025-06-18 18:25:39','2025-06-20 16:24:29','Gunung Galungung','gunung-galungung','gunung tekuat yang pernah ada',-7.26632557,108.07158050,1);
/*!40000 ALTER TABLE `wisatas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-30 13:51:09
