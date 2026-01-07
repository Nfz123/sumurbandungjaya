# Host: localhost  (Version 5.5.5-10.4.32-MariaDB)
# Date: 2025-05-28 16:50:25
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "details"
#

DROP TABLE IF EXISTS `details`;
CREATE TABLE `details` (
  `header_id` bigint(20) unsigned NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `details_header_id_foreign` (`header_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "details"
#

INSERT INTO `details` VALUES (6,'name','admin','2023-07-13 22:50:14','2023-07-13 22:50:14'),(6,'email','admin1@gmail.com','2023-07-13 22:50:14','2023-07-13 22:50:14'),(7,'name','admin','2023-07-13 22:50:55','2023-07-13 22:50:55'),(7,'email','admin1@gmail.com','2023-07-13 22:50:55','2023-07-13 22:50:55'),(8,'name','admin1','2023-07-13 22:52:56','2023-07-13 22:52:56'),(8,'email','admin1@gmail.com1','2023-07-13 22:52:56','2023-07-13 22:52:56'),(9,'name','admin1','2023-07-13 22:52:57','2023-07-13 22:52:57'),(9,'email','admin1@gmail.com1','2023-07-13 22:52:57','2023-07-13 22:52:57'),(10,'name','ahmad','2023-07-13 22:54:06','2023-07-13 22:54:06'),(10,'email','sbjofficialchannel@gmail.com','2023-07-13 22:54:06','2023-07-13 22:54:06'),(11,'name','ddd','2023-07-13 22:54:33','2023-07-13 22:54:33'),(11,'email','12@gmail.com','2023-07-13 22:54:33','2023-07-13 22:54:33'),(12,'name','ddd','2023-07-13 22:55:35','2023-07-13 22:55:35'),(12,'email','12@gmail.com','2023-07-13 22:55:35','2023-07-13 22:55:35'),(13,'name','admin','2023-07-14 18:35:48','2023-07-14 18:35:48'),(13,'email','admin1@gmail.com','2023-07-14 18:35:48','2023-07-14 18:35:48');

#
# Structure for table "failed_jobs"
#

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "failed_jobs"
#


#
# Structure for table "headers"
#

DROP TABLE IF EXISTS `headers`;
CREATE TABLE `headers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_header` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "headers"
#

INSERT INTO `headers` VALUES (1,'data','2023-07-13 22:00:38','2023-07-13 22:00:38'),(2,'data','2023-07-13 22:00:38','2023-07-13 22:00:38'),(3,'kk','2023-07-13 22:04:56','2023-07-13 22:04:56'),(4,'kk','2023-07-13 22:38:04','2023-07-13 22:38:04'),(5,'ccdd','2023-07-13 22:49:49','2023-07-13 22:49:49'),(6,'ccdd','2023-07-13 22:50:14','2023-07-13 22:50:14'),(7,'cek','2023-07-13 22:50:55','2023-07-13 22:50:55'),(8,'cek','2023-07-13 22:52:56','2023-07-13 22:52:56'),(9,'cek','2023-07-13 22:52:57','2023-07-13 22:52:57'),(10,'cd','2023-07-13 22:54:06','2023-07-13 22:54:06'),(11,'cd','2023-07-13 22:54:33','2023-07-13 22:54:33'),(12,'cd','2023-07-13 22:55:35','2023-07-13 22:55:35'),(13,'cek','2023-07-14 18:35:48','2023-07-14 18:35:48');

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_07_01_164558_create_permission_tables',1),(6,'2023_07_01_164722_create_products_table',2),(7,'2023_07_10_134309_create_typebarang',3),(8,'2023_07_10_142023_create_transaksis_table',4),(9,'2023_07_10_142205_create_transaksi_detils_table',4),(10,'2023_07_13_200715_create_headers_table',5),(11,'2023_07_13_200946_create_details_table',5);

#
# Structure for table "password_resets"
#

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "password_resets"
#


#
# Structure for table "permissions"
#

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "permissions"
#

INSERT INTO `permissions` VALUES (1,'role-list','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(2,'role-create','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(3,'role-edit','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(4,'role-delete','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(5,'product-list','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(6,'product-create','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(7,'product-edit','web','2023-07-01 17:13:20','2023-07-01 17:13:20'),(8,'product-delete','web','2023-07-01 17:13:20','2023-07-01 17:13:20');

#
# Structure for table "model_has_permissions"
#

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "model_has_permissions"
#


#
# Structure for table "personal_access_tokens"
#

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "personal_access_tokens"
#


#
# Structure for table "products"
#

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "products"
#

INSERT INTO `products` VALUES (1,'bukan admin','bukan admin hanya liat list','2023-07-12 18:15:24','2023-07-12 18:15:24');

#
# Structure for table "roles"
#

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "roles"
#

INSERT INTO `roles` VALUES (1,'Admin','web','2023-07-01 17:13:45','2023-07-01 17:13:45'),(2,'bukan admin','web','2023-07-12 18:14:57','2023-07-12 18:14:57');

#
# Structure for table "role_has_permissions"
#

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "role_has_permissions"
#

INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(2,1),(3,1),(4,1),(5,1),(5,2),(6,1),(7,1),(8,1);

#
# Structure for table "model_has_roles"
#

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "model_has_roles"
#

INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',6),(2,'App\\Models\\User',4);

#
# Structure for table "transaksi"
#

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `perusahaan` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=419 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "transaksi"
#

INSERT INTO `transaksi` VALUES (418,'2025-00001SBJ3-DSC','2025-04-09','M. Naziullah','2025-04-09 11:33:49','2025-04-09 11:33:49');

#
# Structure for table "transaksi_detils"
#

DROP TABLE IF EXISTS `transaksi_detils`;
CREATE TABLE `transaksi_detils` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint(20) unsigned NOT NULL,
  `kodetype` char(20) DEFAULT NULL,
  `namatype` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ppn` decimal(20,0) DEFAULT NULL,
  `hargajual` decimal(20,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_detils_transaksi_id_foreign` (`transaksi_id`),
  CONSTRAINT `transaksi_detils_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1029 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "transaksi_detils"
#

INSERT INTO `transaksi_detils` VALUES (1023,418,'SBJ2023-00001','CONES KERTAS BEKAS','KG',640,555,1200,'2025-04-09 11:33:49','2025-04-09 11:33:49'),(1024,418,'SBJ2023-00008','KERTAS NOBLEN','KG',140,666,2000,'2025-04-09 11:33:49','2025-04-09 11:33:49'),(1025,418,'SBJ2023-00002','BS KALENG','KG',240,1166,3000,'2025-04-09 11:33:49','2025-04-09 11:33:49'),(1026,418,'INV2025-00047','CELO CRUSHER BS (BERSIH) KATEGORY K','KG',480,111,1000,'2025-04-09 11:33:49','2025-04-09 11:33:49'),(1027,418,'INV2025-00048','CELO CRUSHER BS (BERSIH) KATEGORY U','KG',620,222,1000,'2025-04-09 11:33:49','2025-04-09 11:33:49'),(1028,418,'SBJ2023-00018','CELO CRUSHER BS (KOTOR) KATEGORY A','KG',520,1110,2000,'2025-04-09 11:33:49','2025-04-09 11:33:49');

#
# Structure for table "typebarang"
#

DROP TABLE IF EXISTS `typebarang`;
CREATE TABLE `typebarang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kodetype` varchar(255) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `namatype` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `no_mesin` varchar(50) DEFAULT NULL,
  `pajak_tahun` varchar(50) DEFAULT NULL,
  `pajak_kir` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "typebarang"
#

INSERT INTO `typebarang` VALUES (1,'',NULL,'CDD LONG. ( A 9750 ZC )','Mitsubishi','MHMFE74EHRK005573','4V21U63312','02.11.25','8/5/2025',NULL,NULL),(2,'',NULL,'CDE  ( A8731 ZG ) SBJ 001','Mitsubishi ','MHMFE71P1BK028243','4D34TG83278','03.10.2025','24.10.2024',NULL,NULL),(3,'',NULL,'BLINVAN. ( B 9369 NCG )','GRAND MAX','MHKB3BA1JJK051990','K3MH29628','07.08.2024','20.04.2021',NULL,NULL),(4,'',NULL,'PICKUP ( A 8149 ZR ) SBJ-010','Suzuki',NULL,NULL,NULL,NULL,NULL,'2025-05-28 03:41:30'),(5,'',NULL,'Pajero SBJ ( B 2329 SJE )','Mitsubishi ','MK2KRWPNUMJ006309','4N15UHJ3884','23.07.2023',NULL,NULL,NULL),(6,'',NULL,'CDD LONG ( B 9013 FXW )','Mitsubishi ','MHMFE74PVMK005463','4D34TX55303','09.07.2025','10.07.2025',NULL,NULL),(7,'SBJ2025-00007','1748406632_hIMATA.png','cdcdCDCDCDCDCD','cdcd212','cdcd','cdcd','cdcd','cdcd','2025-05-28 04:30:32','2025-05-28 09:14:33');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'Hardik Savani','admin@gmail.com',NULL,'$2y$10$8b86uT4.vStsAlz..S3EYeZBvdZQ3Jx0cR.jv8a4s1Br6wBrasNDm',NULL,'2023-07-01 17:13:45','2023-07-01 17:13:45'),(2,'ahmad','ahmad@gmail.com',NULL,'$2y$10$7eqwbGAIJcxEory3KY5BX.UWYofZq99guL9YhinsxdhgrFtDZXtXu',NULL,'2023-07-01 17:16:14','2023-07-01 17:16:14'),(3,'sbj','sbj@gmail.com',NULL,'$2y$10$LBP85krsQykMM3pfA4v72Oi59h5ZZ5JH0d4fp69UPugHgs1ON/zBy',NULL,'2023-07-10 12:28:55','2023-07-10 12:28:55'),(4,'sbj','sbj1313@gmail.com',NULL,'$2y$10$A7ij6oeRKoxN761AH/CkD.oTQdM3lC/a6D0UqelCtDAvUnjXIbPHC',NULL,'2023-07-12 18:16:50','2023-07-12 18:16:50'),(6,'nazi','nazi@gmail.com',NULL,'$2y$10$8ewq0Q.oC/wI3Y.fqoNdfegLDQUsFJxY4tHkvcJ95l6U4JQ0ITleS','DI3w74fzl1zo3e8dQzd25vyJCiWXdXCzIIaJ0j2PVr9ighvVFcqyuH8nyCRN','2023-09-14 10:14:25','2023-09-14 10:14:25');
