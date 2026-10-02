-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: laz_persis
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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `aktivitas` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referensi_id` bigint unsigned DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,2,'create','penerimaan',1,'Tambah penerimaan: TRX-IN-2026-0001','2026-09-24 20:34:53','2026-09-24 20:34:53'),(2,1,'create','penyaluran',1,'Tambah penyaluran: TRX-OUT-2026-0001','2026-09-25 05:57:12','2026-09-25 05:57:12'),(3,1,'ajukan','penyaluran',1,'Ajukan: TRX-OUT-2026-0001','2026-09-25 05:57:40','2026-09-25 05:57:40'),(4,3,'approve','persetujuan',1,'Setujui penyaluran: TRX-OUT-2026-0001','2026-09-25 05:58:30','2026-09-25 05:58:30'),(5,1,'create','mustahik',NULL,'Tambah mustahik: yanto','2026-09-25 06:03:55','2026-09-25 06:03:55'),(6,1,'create','program',3,'Tambah program: Santunan Pelajar Berprestasi','2026-09-25 06:07:57','2026-09-25 06:07:57'),(7,1,'create','penerimaan',2,'Tambah penerimaan: TRX-IN-2026-0002','2026-09-25 06:10:36','2026-09-25 06:10:36'),(8,1,'validasi','penerimaan',2,'Validasi: TRX-IN-2026-0002 → valid','2026-09-25 06:10:49','2026-09-25 06:10:49'),(9,1,'create','penyaluran',2,'Tambah penyaluran: TRX-OUT-2026-0002','2026-09-25 06:34:11','2026-09-25 06:34:11'),(10,1,'ajukan','penyaluran',2,'Ajukan: TRX-OUT-2026-0002','2026-09-25 06:34:20','2026-09-25 06:34:20'),(11,3,'approve','persetujuan',2,'Setujui penyaluran: TRX-OUT-2026-0002','2026-09-25 06:35:13','2026-09-25 06:35:13'),(12,1,'create','penyaluran',3,'Tambah penyaluran: TRX-OUT-2026-0003','2026-09-25 06:39:40','2026-09-25 06:39:40'),(13,1,'ajukan','penyaluran',3,'Ajukan: TRX-OUT-2026-0003','2026-09-25 06:39:53','2026-09-25 06:39:53'),(14,3,'approve','persetujuan',3,'Setujui penyaluran: TRX-OUT-2026-0003','2026-09-25 06:40:14','2026-09-25 06:40:14'),(15,1,'realisasi','penyaluran',3,'Realisasi: TRX-OUT-2026-0003','2026-09-25 06:42:38','2026-09-25 06:42:38'),(16,1,'realisasi','penyaluran',2,'Realisasi: TRX-OUT-2026-0002','2026-09-25 06:42:48','2026-09-25 06:42:48'),(17,1,'realisasi','penyaluran',1,'Realisasi: TRX-OUT-2026-0001','2026-09-25 06:42:53','2026-09-25 06:42:53'),(18,1,'create','mustahik',NULL,'Tambah mustahik: Desil','2026-09-25 19:43:22','2026-09-25 19:43:22'),(19,1,'create','program',4,'Tambah program: Kesejahteraan Guru Ngaji','2026-09-25 19:50:47','2026-09-25 19:50:47'),(20,1,'create','penyaluran',4,'Tambah penyaluran: TRX-OUT-2026-0004','2026-09-25 19:57:40','2026-09-25 19:57:40'),(21,1,'ajukan','penyaluran',4,'Ajukan: TRX-OUT-2026-0004','2026-09-25 19:57:48','2026-09-25 19:57:48'),(22,3,'approve','persetujuan',4,'Setujui penyaluran: TRX-OUT-2026-0004','2026-09-25 19:59:17','2026-09-25 19:59:17'),(23,1,'realisasi','penyaluran',4,'Realisasi: TRX-OUT-2026-0004','2026-09-25 20:11:31','2026-09-25 20:11:31'),(24,1,'create','penerimaan',3,'Tambah penerimaan: TRX-IN-2026-0003','2026-09-25 20:18:22','2026-09-25 20:18:22'),(25,1,'validasi','penerimaan',3,'Validasi: TRX-IN-2026-0003 → valid','2026-09-25 20:18:27','2026-09-25 20:18:27'),(26,1,'create','penerimaan',4,'Tambah penerimaan: TRX-IN-2026-0004','2026-09-25 20:20:39','2026-09-25 20:20:39');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amil`
--

DROP TABLE IF EXISTS `amil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amil` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nip_amil` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `status` enum('aktif','nonaktif','cuti') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `amil_nip_amil_unique` (`nip_amil`),
  KEY `amil_user_id_foreign` (`user_id`),
  CONSTRAINT `amil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amil`
--

LOCK TABLES `amil` WRITE;
/*!40000 ALTER TABLE `amil` DISABLE KEYS */;
INSERT INTO `amil` VALUES (2,2,'099999999999','PIMPINAN LAZ','GEDUNG','PIM','2026-09-26','aktif','2026-09-25 19:12:27','2026-09-25 19:12:27');
/*!40000 ALTER TABLE `amil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
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
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_23_074904_create_roles_table',1),(5,'2026_09_23_074916_add_role_to_users_table',1),(6,'2026_09_23_074925_create_muzakki_table',1),(7,'2026_09_23_074939_create_mustahik_table',1),(8,'2026_09_23_074951_create_program_table',1),(9,'2026_09_23_075001_create_penerimaan_table',1),(10,'2026_09_23_075008_create_penyaluran_table',1),(11,'2026_09_23_075056_create_persetujuan_table',1),(12,'2026_09_23_075106_create_activity_logs_table',1),(13,'2026_09_24_072839_add_role_to_users_table',1),(14,'2026_09_24_091921_create_amil_table',2),(15,'2026_09_24_092359_add_nama_column_to_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mustahik`
--

DROP TABLE IF EXISTS `mustahik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mustahik` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_asnaf` enum('fakir','miskin','amil','muallaf','riqab','gharim','fisabilillah','ibnu_sabil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_verifikasi` enum('pending','terverifikasi','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mustahik_kode_unique` (`kode`),
  KEY `mustahik_created_by_foreign` (`created_by`),
  CONSTRAINT `mustahik_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mustahik`
--

LOCK TABLES `mustahik` WRITE;
/*!40000 ALTER TABLE `mustahik` DISABLE KEYS */;
INSERT INTO `mustahik` VALUES (1,'MST-2026-0001','Budi Santoso','Jl. Melati No. 5','082111111111','fakir','terverifikasi','aktif',NULL,'2026-09-24 02:14:32','2026-09-24 02:14:32'),(2,'MST-2026-0002','Siti Aminah','Jl. Anggrek No. 3','082222222222','miskin','terverifikasi','aktif',NULL,'2026-09-24 02:14:32','2026-09-24 02:14:32'),(3,'MST-2026-0003','yanto','jl. gunung','008986666','fakir','terverifikasi','aktif',1,'2026-09-25 06:03:55','2026-09-25 06:33:13'),(4,'MST-2026-0004','Desil','jl kolong jembatan','097547845096','fisabilillah','terverifikasi','aktif',1,'2026-09-25 19:43:22','2026-09-25 19:54:39');
/*!40000 ALTER TABLE `mustahik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muzakki`
--

DROP TABLE IF EXISTS `muzakki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `muzakki` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kategori` enum('individu','perusahaan','lembaga') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'individu',
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `muzakki_kode_unique` (`kode`),
  KEY `muzakki_created_by_foreign` (`created_by`),
  CONSTRAINT `muzakki_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muzakki`
--

LOCK TABLES `muzakki` WRITE;
/*!40000 ALTER TABLE `muzakki` DISABLE KEYS */;
INSERT INTO `muzakki` VALUES (1,'MZK-2026-0001','Ahmad Fauzi','081234567890',NULL,'Jl. Merdeka No. 1','individu','aktif',NULL,'2026-09-24 02:14:32','2026-09-24 02:14:32'),(2,'MZK-2026-0002','PT Berkah Jaya','0211234567',NULL,'Jl. Sudirman No. 10','perusahaan','aktif',NULL,'2026-09-24 02:14:32','2026-09-24 02:14:32'),(3,'MZK-2026-0003','nani','0987728732','nani@gmail.com','indonesia','lembaga','aktif',2,'2026-09-24 20:33:16','2026-09-24 20:33:16'),(4,'MZK-2026-0004','susanti','0988888888','susan@gmail.com','kuala lumpur','individu','aktif',1,'2026-09-25 06:00:13','2026-09-25 06:00:13'),(5,'MZK-2026-0005','Ayuni Rizky Pertiwi','089507748764','ayy2454@gmail.com','bojongkantong margasari RT/06 RW/06 langensari kota banjar','individu','aktif',1,'2026-09-25 19:38:57','2026-09-25 19:38:57');
/*!40000 ALTER TABLE `muzakki` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `penerimaan`
--

DROP TABLE IF EXISTS `penerimaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penerimaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `muzakki_id` bigint unsigned DEFAULT NULL,
  `nama_donatur` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint unsigned DEFAULT NULL,
  `jenis_dana` enum('zakat','infaq','sedekah','wakaf','dana_kemanusiaan','csr') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `metode_pembayaran` enum('tunai','transfer_bank','qris','e_wallet','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_referensi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','valid','ditolak','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `validated_by` bigint unsigned DEFAULT NULL,
  `validated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penerimaan_nomor_transaksi_unique` (`nomor_transaksi`),
  KEY `penerimaan_muzakki_id_foreign` (`muzakki_id`),
  KEY `penerimaan_program_id_foreign` (`program_id`),
  KEY `penerimaan_validated_by_foreign` (`validated_by`),
  KEY `penerimaan_created_by_foreign` (`created_by`),
  CONSTRAINT `penerimaan_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `penerimaan_muzakki_id_foreign` FOREIGN KEY (`muzakki_id`) REFERENCES `muzakki` (`id`),
  CONSTRAINT `penerimaan_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  CONSTRAINT `penerimaan_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerimaan`
--

LOCK TABLES `penerimaan` WRITE;
/*!40000 ALTER TABLE `penerimaan` DISABLE KEYS */;
INSERT INTO `penerimaan` VALUES (1,'TRX-IN-2026-0001','2026-09-25',3,NULL,1,'infaq',40000.00,'qris',NULL,'bukti-penerimaan/xikMZY4SgGjXeEFdaS3HpoX2XGGomnJj0dPtev69.png',NULL,'valid',2,'2026-09-24 20:34:53',2,'2026-09-24 20:34:53','2026-09-24 20:34:53'),(2,'TRX-IN-2026-0002','2026-09-25',4,NULL,3,'zakat',10000000.00,'transfer_bank',NULL,NULL,NULL,'valid',1,'2026-09-25 06:10:49',1,'2026-09-25 06:10:36','2026-09-25 06:10:49'),(3,'TRX-IN-2026-0003','2026-09-26',5,NULL,4,'sedekah',5000000.00,'tunai',NULL,NULL,'SEMOGA BERKAH','valid',1,'2026-09-25 20:18:27',1,'2026-09-25 20:18:22','2026-09-25 20:18:27'),(4,'TRX-IN-2026-0004','2026-09-26',1,NULL,2,'zakat',1000000.00,'tunai',NULL,NULL,NULL,'valid',1,'2026-09-25 20:20:39',1,'2026-09-25 20:20:39','2026-09-25 20:20:39');
/*!40000 ALTER TABLE `penerimaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyaluran`
--

DROP TABLE IF EXISTS `penyaluran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penyaluran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_realisasi` date DEFAULT NULL,
  `program_id` bigint unsigned NOT NULL,
  `mustahik_id` bigint unsigned NOT NULL,
  `jenis_bantuan` enum('uang','barang','jasa','beasiswa','sembako') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `deskripsi_bantuan` text COLLATE utf8mb4_unicode_ci,
  `bukti_penyaluran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','diajukan','disetujui','ditolak','direalisasi','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penyaluran_nomor_transaksi_unique` (`nomor_transaksi`),
  KEY `penyaluran_program_id_foreign` (`program_id`),
  KEY `penyaluran_mustahik_id_foreign` (`mustahik_id`),
  KEY `penyaluran_created_by_foreign` (`created_by`),
  CONSTRAINT `penyaluran_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `penyaluran_mustahik_id_foreign` FOREIGN KEY (`mustahik_id`) REFERENCES `mustahik` (`id`),
  CONSTRAINT `penyaluran_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyaluran`
--

LOCK TABLES `penyaluran` WRITE;
/*!40000 ALTER TABLE `penyaluran` DISABLE KEYS */;
INSERT INTO `penyaluran` VALUES (1,'TRX-OUT-2026-0001','2026-09-25','2026-09-25',2,1,'barang',800000.00,'jnasxublsaxbtugxs',NULL,'direalisasi',NULL,1,'2026-09-25 05:57:12','2026-09-25 06:42:53'),(2,'TRX-OUT-2026-0002','2026-09-25','2026-09-25',3,3,'uang',299987.00,NULL,NULL,'direalisasi',NULL,1,'2026-09-25 06:34:11','2026-09-25 06:42:48'),(3,'TRX-OUT-2026-0003','2026-09-25','2026-09-25',3,2,'barang',20000000.00,'kompor',NULL,'direalisasi',NULL,1,'2026-09-25 06:39:40','2026-09-25 06:42:38'),(4,'TRX-OUT-2026-0004','2026-09-26','2026-09-26',4,4,'uang',200000.00,'SEMOGA BERKAH','bukti-penyaluran/u919zVlEjSClZeCZfIC6tKhuDFhgxrNNwzNppGLb.png','direalisasi',NULL,1,'2026-09-25 19:57:40','2026-09-25 20:11:31');
/*!40000 ALTER TABLE `penyaluran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persetujuan`
--

DROP TABLE IF EXISTS `persetujuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persetujuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `referensi_tipe` enum('penyaluran','penerimaan','program') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referensi_id` bigint unsigned NOT NULL,
  `approver_id` bigint unsigned DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `persetujuan_approver_id_foreign` (`approver_id`),
  KEY `persetujuan_referensi_tipe_referensi_id_index` (`referensi_tipe`,`referensi_id`),
  CONSTRAINT `persetujuan_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persetujuan`
--

LOCK TABLES `persetujuan` WRITE;
/*!40000 ALTER TABLE `persetujuan` DISABLE KEYS */;
INSERT INTO `persetujuan` VALUES (1,'penyaluran',1,3,'disetujui',NULL,'2026-09-25 05:58:30','2026-09-25 05:57:40','2026-09-25 05:58:30'),(2,'penyaluran',2,3,'disetujui','yyyyyyyyyyyyyyyy','2026-09-25 06:35:13','2026-09-25 06:34:20','2026-09-25 06:35:13'),(3,'penyaluran',3,3,'disetujui',NULL,'2026-09-25 06:40:14','2026-09-25 06:39:53','2026-09-25 06:40:14'),(4,'penyaluran',4,3,'disetujui',NULL,'2026-09-25 19:59:17','2026-09-25 19:57:48','2026-09-25 19:59:17');
/*!40000 ALTER TABLE `persetujuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_program` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_program` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `kategori` enum('pendidikan','kesehatan','ekonomi','dakwah','sosial','kemanusiaan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('penghimpunan','penyaluran') COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_dana` decimal(15,2) NOT NULL DEFAULT '0.00',
  `dana_terkumpul` decimal(15,2) NOT NULL DEFAULT '0.00',
  `dana_tersalurkan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `periode_mulai` date NOT NULL,
  `periode_selesai` date DEFAULT NULL,
  `status` enum('draft','aktif','selesai','ditutup') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_kode_program_unique` (`kode_program`),
  KEY `program_created_by_foreign` (`created_by`),
  CONSTRAINT `program_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (1,'PRG-2026-0001','Beasiswa Anak Yatim','Program beasiswa untuk anak yatim','pendidikan','penyaluran',50000000.00,0.00,0.00,'2026-09-24',NULL,'aktif',NULL,'2026-09-24 02:14:32','2026-09-24 02:14:32'),(2,'PRG-2026-0002','Zakat Produktif','Pemberdayaan ekonomi mustahik','ekonomi','penghimpunan',100000000.00,0.00,800000.00,'2026-09-24',NULL,'aktif',NULL,'2026-09-24 02:14:32','2026-09-25 06:42:53'),(3,'PRG-2026-0003','Santunan Pelajar Berprestasi','reward untuk pelajar berprestasi dari keluarga kurang mampu','pendidikan','penyaluran',40000000.00,10000000.00,20299987.00,'2026-09-25','2026-09-30','aktif',1,'2026-09-25 06:07:57','2026-09-25 06:42:48'),(4,'PRG-2026-0004','Kesejahteraan Guru Ngaji','rogram bantuan insentif bulanan untuk para guru ngaji di daerah terpencil agar mereka dapat fokus mengajar tanpa memikirkan beban ekonomi.','pendidikan','penyaluran',10000000.00,5000000.00,200000.00,'2026-09-26','2026-09-30','aktif',1,'2026-09-25 19:50:47','2026-09-25 20:18:27');
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nama_role_unique` (`nama_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','Pengelola sistem utama','2026-09-24 02:14:30','2026-09-24 02:14:30'),(2,'admin_amil','Petugas operasional','2026-09-24 02:14:30','2026-09-24 02:14:30'),(3,'pimpinan','Pengawas/pengambil keputusan','2026-09-24 02:14:30','2026-09-24 02:14:30');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('IUURGnyCy2gIKwbA6eZywDdXq9JmJk8NvQfNIfWz',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','eyJfdG9rZW4iOiI4OVM1eUloQkkydTRDUWRrWHBtVWpFRmF0cHd1ZGdDWnZIVTczbTM1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790751078),('ujuII8gBW7fAYuvPxFlrrxMyx2Hg2BIOPSipu03J',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','eyJfdG9rZW4iOiJ3Vlc4bWE4UUlsSnFveVJGSUV1NTZGeFQxamlSVThHak41anliSHV4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9tdXpha2tpIiwicm91dGUiOiJtdXpha2tpLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiNDNjYjM4YTVkMTQ4MDg4YmE5MWE1OGViNGM2MDAxMTZhNzllYzBiMDJkMDVkZGZhNWYyNGQ5Zjg2YThmY2VlYiJ9',1790753006);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super Admin LAZ','Super Admin','admin@lazpersis.com',NULL,'$2y$12$X35QmlXref2YczXM6S8EP.8NfxKSnsd7ZWlqP885WsOZuBMM86Reu','CmuKPfmURtk19PSGJY5kjon6moTjyEZMieNCMrcN58ctMdB50cx07cXX5Yt5','2026-09-24 02:14:30','2026-09-24 02:20:29','aktif'),(2,2,'Amil Satu','Amil Satu','amil@lazpersis.com',NULL,'$2y$12$08kJOSKqSYidKo87V4Nzh.hG/rf0GtaPK9ZNBqgetagjzjhEmcNLS','6gA0ehamjw2d8jKsnca6lECkiHVgflHoEJkr1TIeZCM1Da4rMOYNkLXo2SAb','2026-09-24 02:14:31','2026-09-24 02:20:51','aktif'),(3,3,'Pimpinan LAZ','Pimpinan LAZ','pimpinan@lazpersis.com',NULL,'$2y$12$nXozA7FLOJinEuYD/FeJruF56OgfvIFrSgihMunJ2GmsaOPikrZcK','2pfxTmBGZNbKYkUxWrolb7ErhKv2ww6JyuViQBJ5R4x8YLB2hbGIiP7HfGKb','2026-09-24 02:14:32','2026-09-24 02:20:58','aktif');
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

-- Dump completed on 2026-09-30 14:27:35
