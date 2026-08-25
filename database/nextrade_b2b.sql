-- MySQL dump 10.13  Distrib 9.2.0, for macos14.7 (x86_64)
--
-- Host: localhost    Database: nextrade_b2b
-- ------------------------------------------------------
-- Server version	9.2.0

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
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advertisements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placement` enum('hero_slider','category_top','search_sponsored','sidebar_banner','homepage_featured') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hero_slider',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `clicks_count` int unsigned NOT NULL DEFAULT '0',
  `impressions_count` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertisements_supplier_id_foreign` (`supplier_id`),
  KEY `advertisements_is_active_index` (`is_active`),
  CONSTRAINT `advertisements_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisements`
--

LOCK TABLES `advertisements` WRITE;
/*!40000 ALTER TABLE `advertisements` DISABLE KEYS */;
INSERT INTO `advertisements` VALUES (1,1,'Mega Industrial Tech Expo 2026 - Up to 15% Off CNC Machines','hero_slider','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1600&auto=format&fit=crop&q=80','/suppliers/apex-industrial-machineries','2026-08-20 09:01:46','2026-09-19 09:01:46',1,0,0,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(2,2,'Switch Your Factory to Solar - Zero Capital Expenditure Models','hero_slider','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=1600&auto=format&fit=crop&q=80','/suppliers/novatech-solar-energy','2026-08-23 09:01:46','2026-09-24 09:01:46',1,0,0,'2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `advertisements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buyers`
--

DROP TABLE IF EXISTS `buyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buyers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'India',
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buyers_user_id_foreign` (`user_id`),
  KEY `buyers_city_index` (`city`),
  KEY `buyers_state_index` (`state`),
  KEY `buyers_pincode_index` (`pincode`),
  CONSTRAINT `buyers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyers`
--

LOCK TABLES `buyers` WRITE;
/*!40000 ALTER TABLE `buyers` DISABLE KEYS */;
INSERT INTO `buyers` VALUES (1,3,'Apex Infra Projects Pvt Ltd','Infrastructure Contractor','27AAACA9876Q1Z2','Mumbai','Maharashtra','India','400051','Plot 42, Bandra Kurla Complex, Bandra East','2026-08-25 09:01:41','2026-08-25 09:01:41',NULL),(2,4,'Zenith Retail & Supermarkets','Retail Chain / Wholesaler','07AAACZ1234F1Z8','Delhi','Delhi','India','110020','Okhla Industrial Area Phase 3','2026-08-25 09:01:42','2026-08-25 09:01:42',NULL),(3,5,'Gujarat Petro & Solvents Trading','Industrial Distributor','24AAACG5566K1Z3','Ahmedabad','Gujarat','India','382445','GIDC Naroda Industrial Estate','2026-08-25 09:01:42','2026-08-25 09:01:42',NULL);
/*!40000 ALTER TABLE `buyers` ENABLE KEYS */;
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Industrial Machinery','industrial-machinery','cog','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Heavy industrial machinery, CNC tooling, hydraulic systems, processing plants, and packaging machines.','Industrial Machinery Manufacturers & Suppliers','Find verified industrial machinery suppliers, CNC machines, lathe tools, and hydraulic equipment.','industrial machinery, suppliers, manufacturers, wholesale',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(2,'Solar & Renewable Energy','solar-products','sun','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','Solar panels, inverters, solar power plants, lithium batteries, and green energy solutions.','Solar Panel & Inverter Suppliers in India','Connect with top solar panel manufacturers, on-grid inverters, and solar battery distributors.','solar & renewable energy, suppliers, manufacturers, wholesale',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(3,'Electronics & Electrical','electronics-electrical','zap','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Electronic components, industrial sensors, switchgear, electric motors, and copper wiring.','Electrical Equipment & Industrial Electronic Components','Wholesale electrical cables, induction motors, switchgear, and semiconductor components.','electronics & electrical, suppliers, manufacturers, wholesale',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(4,'Construction Materials','construction-materials','building','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','TMT rebar steel, cement, precast blocks, scaffolding, and architectural hardware.','Construction Materials & Structural Steel Suppliers','Bulk supply of TMT bars, structural steel beams, ready-mix concrete, and scaffolding.','construction materials, suppliers, manufacturers, wholesale',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(5,'Packaging Materials','packaging-materials','package','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Corrugated carton boxes, stretch wrap films, BOPP tape, glass & PET bottles, and pouches.','Packaging Materials & Corrugated Boxes Wholesale','Wholesale corrugated boxes, packaging rolls, airtight pouches, and protective packaging.','packaging materials, suppliers, manufacturers, wholesale',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(6,'Chemicals & Minerals','chemicals-minerals','flask-conical','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80','Industrial chemicals, laboratory reagents, polymers, solvents, and specialty additives.','Industrial Chemicals & Polymer Raw Material Suppliers','Direct manufacturers of industrial solvents, Caustic Soda, polymer granules, and specialty chemicals.','chemicals & minerals, suppliers, manufacturers, wholesale',1,6,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(7,'Medical & Healthcare','medical-equipment','activity','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Diagnostic equipment, hospital furniture, surgical instruments, and medical disposables.','Medical Devices & Hospital Equipment Manufacturers','Source hospital beds, patient monitors, oxygen concentrators, and surgical disposables.','medical & healthcare, suppliers, manufacturers, wholesale',1,7,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(8,'Textiles & Apparel','textile-products','scissors','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Yarn, cotton fabrics, industrial workwear, uniform fabrics, and garment accessories.','Textile Mills, Fabric Manufacturers & Uniform Suppliers','Wholesale cotton yarn, denim fabrics, flame-retardant workwear, and garment fabrics.','textiles & apparel, suppliers, manufacturers, wholesale',1,8,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(9,'Agriculture & Food','agriculture-food','sprout','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Agro commodities, organic spices, pulses, drip irrigation equipment, and cold-pressed oils.','Agro Commodities & Spices Wholesalers','Buy Indian spices, Basmati rice, cold pressed edible oils, and precision drip irrigation pipes.','agriculture & food, suppliers, manufacturers, wholesale',1,9,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(10,'Automobile & EV Parts','automobile-parts','truck','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80','OEM automotive spares, electric vehicle powertrain parts, heavy vehicle brake assemblies, and batteries.','Auto Spare Parts & EV Component Manufacturers','Automotive filters, brake pads, EV charging stations, and suspension parts wholesale.','automobile & ev parts, suppliers, manufacturers, wholesale',1,10,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(11,'Commercial Furniture','furniture','armchair','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Ergonomic office workstations, executive chairs, warehouse pallet racks, and institutional furniture.','Office Furniture & Warehouse Storage Racks','Modular office workstations, ergonomic mesh chairs, and heavy duty warehouse pallet racking.','commercial furniture, suppliers, manufacturers, wholesale',1,11,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(12,'Security & Safety Systems','security-products','shield-check','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','IP CCTV surveillance, biometric access control, fire suppression systems, and industrial PPE.','Industrial Security Cameras & Fire Safety Equipment','Commercial CCTV systems, biometric attendance machines, and ABC fire extinguishers.','security & safety systems, suppliers, manufacturers, wholesale',1,12,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(13,'IT Services & Software','it-services','laptop','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Custom enterprise ERP, cloud hosting, IoT industrial monitoring, and B2B portal development.','B2B Software Development & Enterprise ERP Solutions','Custom ERP for manufacturing, IoT SCADA solutions, and enterprise software services.','it services & software, suppliers, manufacturers, wholesale',1,13,'2026-08-25 09:01:42','2026-08-25 09:01:42');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorites_user_id_product_id_supplier_id_unique` (`user_id`,`product_id`,`supplier_id`),
  KEY `favorites_product_id_foreign` (`product_id`),
  KEY `favorites_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `favorites_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `buyer_id` bigint unsigned DEFAULT NULL,
  `buyer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `expected_price` decimal(12,2) DEFAULT NULL,
  `delivery_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','read','accepted','rejected','quoted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `supplier_reply` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inquiries_product_id_foreign` (`product_id`),
  KEY `inquiries_supplier_id_foreign` (`supplier_id`),
  KEY `inquiries_buyer_id_foreign` (`buyer_id`),
  KEY `inquiries_status_index` (`status`),
  CONSTRAINT `inquiries_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `inquiries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `inquiries_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES (1,1,1,1,'Rajesh Kumar','buyer@ozura.com','+91 98201 12345',2,720000.00,'Mumbai, Maharashtra','Hello Apex Machinery team, we are expanding our tool room and looking to order 2 units of your 3000 RPM CNC Lathe machine. Can you provide lead time, installation support in Mumbai, and best export commercial terms?','accepted','Dear Rajesh, thank you for your inquiry. We have units ready in stock and our Mumbai engineering team will handle on-site installation and operator training at no extra charge. We have sent you a detailed technical proposal.','2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
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
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'India',
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_city_index` (`city`),
  KEY `locations_state_index` (`state`),
  KEY `locations_pincode_index` (`pincode`),
  KEY `locations_is_popular_index` (`is_popular`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Delhi','Delhi','India','110001','https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(2,'Mumbai','Maharashtra','India','400001','https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(3,'Bengaluru','Karnataka','India','560001','https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(4,'Hyderabad','Telangana','India','500001','https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(5,'Ahmedabad','Gujarat','India','380001','https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(6,'Pune','Maharashtra','India','411001','https://images.unsplash.com/photo-1616088410192-39c4d6836423?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(7,'Chennai','Tamil Nadu','India','600001','https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(8,'Kolkata','West Bengal','India','700001','https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(9,'Surat','Gujarat','India','395001','https://images.unsplash.com/photo-1590496793929-36417d3117de?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(10,'Jaipur','Rajasthan','India','302001','https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(11,'Noida','Uttar Pradesh','India','201301','https://images.unsplash.com/photo-1562975871-33230b777a83?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(12,'Gurugram','Haryana','India','122001','https://images.unsplash.com/photo-1577495508048-b635879837f1?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(13,'Coimbatore','Tamil Nadu','India','641001','https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(14,'Ludhiana','Punjab','India','141001','https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(15,'Rajkot','Gujarat','India','360001','https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(16,'Indore','Madhya Pradesh','India','452001','https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(17,'Vadodara','Gujarat','India','390001','https://images.unsplash.com/photo-1590496793929-36417d3117de?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(18,'Kanpur','Uttar Pradesh','India','208001','https://images.unsplash.com/photo-1562975871-33230b777a83?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(19,'Kochi','Kerala','India','682001','https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(20,'Nagpur','Maharashtra','India','440001','https://images.unsplash.com/photo-1616088410192-39c4d6836423?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 09:01:41','2026-08-25 09:01:41');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `inquiry_id` bigint unsigned DEFAULT NULL,
  `quote_id` bigint unsigned DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_receiver_id_foreign` (`receiver_id`),
  KEY `messages_inquiry_id_foreign` (`inquiry_id`),
  KEY `messages_quote_id_foreign` (`quote_id`),
  KEY `messages_is_read_index` (`is_read`),
  CONSTRAINT `messages_inquiry_id_foreign` FOREIGN KEY (`inquiry_id`) REFERENCES `inquiries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `messages_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,3,6,NULL,NULL,'Hi Arunachalam, following up on our inquiry for the Apex CNC Lathe 3000X. Is it possible to schedule a video demonstration of the machine spindle under load test?',NULL,1,'2026-08-25 04:01:46','2026-08-25 03:01:46','2026-08-25 09:01:46'),(2,6,3,NULL,NULL,'Hello Mr. Rajesh! Absolutely. I can connect you live with our chief testing engineer at our Coimbatore assembly plant today at 3:30 PM. Would that work for you?',NULL,1,'2026-08-25 06:01:46','2026-08-25 05:01:46','2026-08-25 09:01:46'),(3,3,6,NULL,NULL,'3:30 PM works great! Please share the meeting link. Also, please confirm if the Siemens 808D controller comes with conversational programming enabled.',NULL,0,NULL,'2026-08-25 08:31:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_25_000001_create_core_entities_table',1),(5,'2026_08_25_000002_create_catalog_and_locations_table',1),(6,'2026_08_25_000003_create_interactions_and_monetization_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  KEY `notifications_is_read_index` (`is_read`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,6,'inquiry','New Product Inquiry Received','Rajesh Kumar from Apex Infra Projects sent an inquiry for \"Apex UltraPrecision CNC Lathe Machine\".','/supplier/inquiries',0,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(2,3,'quote','New Quotation Received for your RFQ','NovaTech Solar has submitted a quotation of ₹10,950/Piece for your 200kW Solar Modules requirement.','/buyer/quotes',0,'2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
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
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(2,2,'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(3,3,'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(4,4,'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(5,5,'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(6,6,'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(7,7,'https://images.unsplash.com/photo-1548345680-f5475ea5df84?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(8,8,'https://images.unsplash.com/photo-1545208942-e1c9c916524b?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(9,9,'https://images.unsplash.com/photo-1466611653911-95081537e5b7?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(10,10,'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(11,11,'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(12,12,'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(13,13,'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(14,14,'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(15,15,'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(16,16,'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(17,17,'https://images.unsplash.com/photo-1590069261209-f8e9b8642343?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(18,18,'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(19,19,'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(20,20,'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(21,21,'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(22,22,'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(23,23,'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(24,24,'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(25,25,'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(26,26,'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(27,27,'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(28,28,'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(29,29,'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(30,30,'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(31,31,'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(32,32,'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(33,33,'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(34,34,'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(35,35,'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(36,36,'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(37,37,'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(38,38,'https://images.unsplash.com/photo-1582418702059-97ebafb35d09?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(39,39,'https://images.unsplash.com/photo-1604014237800-1c9102c219da?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(40,40,'https://images.unsplash.com/photo-1609743522653-52354461eb27?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(41,41,'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(42,42,'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(43,43,'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(44,44,'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(45,45,'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(46,46,'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(47,47,'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(48,48,'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(49,49,'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(50,50,'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(51,51,'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(52,52,'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(53,53,'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(54,54,'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(55,55,'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(56,56,'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(57,57,'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(58,58,'https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(59,59,'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(60,60,'https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(61,61,'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(62,62,'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(63,63,'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(64,64,'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(65,65,'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL,
  `price_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Piece',
  `moq` int NOT NULL DEFAULT '1',
  `stock_qty` int NOT NULL DEFAULT '100',
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specifications` json DEFAULT NULL,
  `features` text COLLATE utf8mb4_unicode_ci,
  `packaging_details` text COLLATE utf8mb4_unicode_ci,
  `delivery_info` text COLLATE utf8mb4_unicode_ci,
  `payment_terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_sponsored` tinyint(1) NOT NULL DEFAULT '0',
  `views_count` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  KEY `products_brand_index` (`brand`),
  KEY `products_sku_index` (`sku`),
  KEY `products_price_index` (`price`),
  KEY `products_is_active_index` (`is_active`),
  KEY `products_is_featured_index` (`is_featured`),
  KEY `products_is_sponsored_index` (`is_sponsored`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,1,'Apex UltraPrecision Heavy Duty CNC Lathe Machine 3000 RPM','apex-ultraprecision-heavy-duty-cnc-lathe-machine-3000-rpm-RpuWe','Apex CNC','APX-CNC-3000X','Heavy duty slant-bed CNC Lathe Machine equipped with Fanuc / Siemens controller, 8-station hydraulic turret, automatic chip conveyor, and hardened ground guideways. Perfect for aerospace, automotive, and heavy industrial precision shaft turning.',750000.00,'Set',1,15,'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Control System\", \"value\": \"Siemens 808D / Fanuc 0i-TF\"}, {\"key\": \"Spindle Motor Power\", \"value\": \"11 kW / 15 HP\"}, {\"key\": \"Max Machining Diameter\", \"value\": \"320 mm\"}, {\"key\": \"Weight of Machine\", \"value\": \"3,800 kg\"}, {\"key\": \"Warranty\", \"value\": \"2 Years On-Site Warranty\"}]','• Max Swing over bed: 500 mm\n• Max Turning Length: 1000 mm\n• Spindle Speed Range: 50 - 3500 RPM\n• Chuck Size: 8 Inch 3-Jaw Hydraulic\n• Full Enclosed Splash Guard & Auto Lubrication','Export standard vacuum sealed waterproof packaging in fumigated wooden crate.','Dispatched within 10-14 days via heavy cargo transport across India & Global ports.','30% Advance, 70% against BL / Letter of Credit (LC)',1,1,1,1253,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(2,15,1,2,'High Pressure Variable Displacement Axial Piston Hydraulic Pump','high-pressure-variable-displacement-axial-piston-hydraulic-pump-rFb7q','ApexHydra','APX-HYD-P450','Industrial grade axial piston pump designed for open-circuit hydraulic systems requiring constant pressure and load sensing capabilities. Features high efficiency, low noise emissions, and extended bearing lifespan.',38500.00,'Piece',2,80,'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Displacement\", \"value\": \"71 cc/rev\"}, {\"key\": \"Max Pressure\", \"value\": \"350 Bar\"}, {\"key\": \"Rotation\", \"value\": \"Clockwise / Bi-directional\"}, {\"key\": \"Fluid Compatibility\", \"value\": \"Mineral Hydraulic Oil ISO VG 46/68\"}]','• Displacement: 45 cc/rev to 140 cc/rev\n• Nominal Pressure: 350 bar (Max 400 bar)\n• SAE Flange Mounting\n• Cast iron housing with anti-corrosion coating','Individually boxed in heavy protective foam casing.','Ready in stock. Dispatches in 24-48 hours.','100% Advance / UPI / Net Banking / Net 30 for verified buyers',1,1,0,840,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(3,1,1,3,'Apex 50 HP Industrial Rotary Screw Air Compressor with Inverter VFD','apex-50-hp-industrial-rotary-screw-air-compressor-with-inverter-vfd-5sE8A','ApexAir','APX-CMP-50VFD','Energy saving Variable Frequency Drive (VFD) rotary screw compressor. Provides continuous 210 CFM compressed air with ultra-quiet acoustic canopy and touch screen intelligent controller.',320000.00,'Set',1,20,'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Free Air Delivery\", \"value\": \"6.0 m³/min (210 CFM)\"}, {\"key\": \"Working Pressure\", \"value\": \"8.0 to 10.0 Bar\"}, {\"key\": \"Cooling Method\", \"value\": \"Forced Air Cooled\"}, {\"key\": \"Noise Level\", \"value\": \"68 ± 2 dB(A)\"}]','• Motor Power: 37 kW / 50 HP\n• Air Flow: 210 CFM @ 8 bar\n• Integrated Air Dryer & Dual Micro Filters\n• Energy Savings up to 35% with PM Motor','Fumigated wooden box with anti-moisture silica packing.','Shipped in 3-5 days across all Indian industrial hubs.','50% Advance, 50% on Delivery',1,0,0,620,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(4,14,1,4,'Heavy Duty Automated Modular Belt Conveyor System for Warehouses','heavy-duty-automated-modular-belt-conveyor-system-for-warehouses-Vpir9','Rajputana Convey','RAJ-CNV-100M','Automated modular PVC & stainless steel belt conveyor for cartons, bags, and bulk manufacturing transport with variable speed VFD controls and heavy-duty geared motor.',185000.00,'Set',1,12,'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Length Options\", \"value\": \"10 to 50 Meters Modular\"}, {\"key\": \"Load Capacity\", \"value\": \"80 kg / meter\"}, {\"key\": \"Motor Drive\", \"value\": \"3-Phase Bonfiglioli Geared Motor\"}]','• Belt Width: 600 mm to 1200 mm\n• Frame: SS304 or Powder Coated Mild Steel\n• Speed: 5 to 30 meters/min variable\n• Emergency stop pull cords throughout length','Modular flat packed in steel crates for easy assembly.','Dispatches within 7 days from Jaipur.','40% Advance, 60% upon dispatch',1,1,0,450,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(5,14,1,5,'180 Ton Servo Hydraulic Plastic Injection Molding Machine','180-ton-servo-hydraulic-plastic-injection-molding-machine-BuVxc','Rajputana Plast','RAJ-INJ-180T','High-precision energy-saving servo plastic injection molding machine equipped with Techmation controller and high-response servo motor pump system for caps, closures, and auto plastic parts.',1250000.00,'Set',1,8,'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Controller\", \"value\": \"Techmation Color LCD Display\"}, {\"key\": \"Screw Diameter\", \"value\": \"45 mm\"}, {\"key\": \"Hydraulic Pressure\", \"value\": \"17.5 MPa\"}]','• Clamping Force: 1800 kN (180 Ton)\n• Shot Weight (PS): 380 grams\n• Tie Bar Distance: 510 x 510 mm\n• Energy Saving: 40% to 70% compared to standard hydraulic','Full container loading with protective vacuum wrap.','Delivered in 15 days across all states.','30% Advance, 70% LC / Bank Transfer',1,0,0,710,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(6,2,2,7,'NovaTech 550W Bifacial Mono PERC Half-Cut Solar PV Panel','novatech-550w-bifacial-mono-perc-half-cut-solar-pv-panel-vHyW5','NovaTech Solar','NTS-550W-BIF','High efficiency 144 Half-Cut Cell Bifacial Monocrystalline PERC solar module. Generates up to 25% extra energy from the rear side. Tested and certified under IEC 61215 and ALMM approved for government and commercial solar projects.',11200.00,'Piece',25,5000,'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Rated Maximum Power (Pmax)\", \"value\": \"550 W\"}, {\"key\": \"Open Circuit Voltage (Voc)\", \"value\": \"49.80 V\"}, {\"key\": \"Short Circuit Current (Isc)\", \"value\": \"13.98 A\"}, {\"key\": \"Module Dimensions\", \"value\": \"2278 x 1134 x 35 mm\"}, {\"key\": \"Certification\", \"value\": \"BIS, ALMM, IEC 61215, IEC 61730\"}]','• Module Efficiency: 21.6%\n• PID Resistant & Anti-Reflective 3.2mm Tempered Glass\n• Robust 35mm Anodized Aluminum Alloy Frame\n• 30 Years Linear Performance Warranty (85% at Year 30)','31 Panels per pallet, 682 panels per 40ft High Cube container.','Immediate bulk dispatch from Bengaluru & Delhi warehouses.','100% Irrevocable LC at sight or 20% advance & balance before dispatch',1,1,1,3120,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(7,2,2,8,'NovaTech 50kW Three Phase Commercial On-Grid Solar Inverter','novatech-50kw-three-phase-commercial-on-grid-solar-inverter-NxqS6','NovaTech Grid','NTS-INV-50K','Commercial grid-tied transformerless string inverter with 4 MPPT trackers, 98.8% max efficiency, built-in WiFi/Ethernet monitoring, AFCI arc fault protection, and IP66 outdoor rated weather resistance.',145000.00,'Set',1,45,'https://images.unsplash.com/photo-1548345680-f5475ea5df84?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Max AC Output Power\", \"value\": \"55 kVA\"}, {\"key\": \"Nominal AC Grid Voltage\", \"value\": \"400V, 3L+N+PE\"}, {\"key\": \"MPPT Voltage Range\", \"value\": \"200V - 1000V\"}, {\"key\": \"Ingress Protection\", \"value\": \"IP66 Waterproof\"}]','• Max DC Input: 1100V\n• 4 Independent MPPTs with 8 String Inputs\n• Integrated DC Switch & Type II AC/DC Surge Protection\n• 10-Year Standard Factory Warranty','Corrugated carton with shock-absorbent EPE foam.','Dispatches within 48 hours.','Online Bank Transfer / RTGS / LC',1,1,0,1100,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(8,2,2,9,'48V 100Ah Lithium Ferro Phosphate (LiFePO4) Solar Storage Battery','48v-100ah-lithium-ferro-phosphate-lifepo4-solar-storage-battery-gKpWT','NovaTech Power','NTS-BAT-48V100','Modular rack-mount 5.12 kWh LiFePO4 battery pack with built-in smart BMS, 6000+ cycle life at 80% DOD, RS485/CAN communication, and 10-year design life for solar home & commercial backup.',78000.00,'Piece',2,150,'https://images.unsplash.com/photo-1545208942-e1c9c916524b?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Nominal Voltage\", \"value\": \"51.2 V\"}, {\"key\": \"Max Charge / Discharge\", \"value\": \"100 A (1C peak)\"}, {\"key\": \"Operating Temperature\", \"value\": \"-10°C to 55°C\"}]','• Capacity: 5.12 kWh (48V / 100Ah)\n• Chemistry: Premium Grade A Lithium Iron Phosphate\n• Cycle Life: 6000+ cycles @ 25°C\n• Wall-mount or 19-inch Server Rack compatible','Heavy duty wooden box with anti-static foam lining.','Express surface cargo dispatch across India.','100% Prepayment or 30% advance on PO',1,0,0,890,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(9,2,2,10,'200 LPD ETC Commercial Pressurized Solar Water Heating System','200-lpd-etc-commercial-pressurized-solar-water-heating-system-WQWjg','NovaTech Thermal','NTS-SWH-200L','Evacuated Tube Collector (ETC) solar water heating system with food-grade SUS304 stainless steel inner tank and 50mm high-density polyurethane insulation for hot water up to 85°C.',28500.00,'Set',2,60,'https://images.unsplash.com/photo-1466611653911-95081537e5b7?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Daily Hot Water Yield\", \"value\": \"200 Liters @ 65°C - 80°C\"}, {\"key\": \"Inner Tank Material\", \"value\": \"SUS304-2B Stainless Steel\"}, {\"key\": \"Structure\", \"value\": \"Hot Dip Galvanized 1.5mm Angle Frame\"}]','• Capacity: 200 Liters Per Day (LPD)\n• Tubes: 20 Three-Target High Absorption Glass Tubes\n• Backup: 2 kW Incoloy Electric Heating Element Included\n• Tank: 2.0 mm SS304 Argon Welded','Separate protective carton boxes for tank and glass tubes.','Dispatches within 3-4 days.','50% Advance, balance against delivery',1,0,0,510,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(10,2,2,11,'60W All-In-One Integrated Solar LED Street Light with Motion Sensor','60w-all-in-one-integrated-solar-led-street-light-with-motion-sensor-lF7gR','NovaTech Lumina','NTS-SSL-60W','Integrated IP65 all-in-one solar street light combining mono solar panel, Bridgelux LED optical lens, LiFePO4 battery pack, and PIR microwave motion sensor for streets, factory roads, and campuses.',6800.00,'Piece',10,400,'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Solar Panel Wattage\", \"value\": \"18V 70W Monocrystalline\"}, {\"key\": \"Waterproof Rating\", \"value\": \"IP65 Outdoor Cast Aluminum\"}, {\"key\": \"Installation Height\", \"value\": \"6 to 8 Meters Pole Mounting\"}]','• LED Lumens: 9,000 Lumens (150 lm/W)\n• Battery: Built-in 3.2V 36Ah LiFePO4 Battery\n• Lighting Time: 12-14 Hours per night with 3 rainy days backup\n• Auto on at dusk, auto off at dawn with remote programming','Individual carton box with mounting bracket accessories.','Same-day dispatch for quantities under 100 pieces.','Online Payment / GST Invoice Advance',1,1,0,970,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(11,7,3,12,'15 HP 11 kW IE3 Premium Efficiency Three-Phase Induction Motor','15-hp-11-kw-ie3-premium-efficiency-three-phase-induction-motor-qEgb2','ElectroMatrix','EMX-MOT-15HP-IE3','Heavy duty cast iron body IE3 energy efficient 4-Pole (1440 RPM) AC induction motor for continuous industrial driving of pumps, blowers, crushers, and conveyors. Class F insulation with IP55 protection.',46500.00,'Set',1,40,'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Frame Size\", \"value\": \"160M Cast Iron\"}, {\"key\": \"Speed\", \"value\": \"1450 RPM (4 Pole)\"}, {\"key\": \"Protection Class\", \"value\": \"IP55 / Class F (Temp rise Class B)\"}]','• Rated Power: 11 kW / 15 HP @ 415V 50Hz\n• Full Load Efficiency: 92.1% (IE3 Certified)\n• Foot & Flange Mounting Options Available\n• 100% Electrolytic Copper Winding','Mounted on wooden pallet and sealed with shrink wrap.','Dispatches within 2 business days from Delhi.','Bank RTGS / 100% against dispatch',1,1,1,1430,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(12,7,3,13,'1.1 kV 4-Core 50 sq.mm XLPE Insulated Armoured Aluminium Power Cable','11-kv-4-core-50-sqmm-xlpe-insulated-armoured-aluminium-power-cable-R4Qr6','ElectroMatrix Cable','EMX-CBL-4C50AL','Heavy duty underground armoured power cable compliant with IS 7098 (Part 1). Stranded compacted EC grade aluminium conductors, XLPE cross-linked polyethylene insulation, and galvanized steel flat strip armouring.',380.00,'Meter',100,5000,'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Conductor Size\", \"value\": \"4 Core x 50 sq.mm\"}, {\"key\": \"Current Rating (Air)\", \"value\": \"145 Amps\"}, {\"key\": \"Standard Drum Length\", \"value\": \"500 / 1000 Meters Wooden Drum\"}]','• Voltage Grade: 1100 Volts (1.1 kV)\n• Conductor: High Conductivity EC Grade Aluminium\n• Outer Sheath: Heavy Duty Flame Retardant (FR) PVC\n• ISI Mark and CPRI Type Tested','Supplied in heavy treated wooden drums with sealed ends.','Immediate drum dispatch across Northern and Western India.','30% Advance, 70% against weighment/MTC',1,0,0,890,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(13,7,3,14,'M18 Inductive Proximity Sensor PNP Normally Open (Flush Mount)','m18-inductive-proximity-sensor-pnp-normally-open-flush-mount-hoQ2w','ElectroMatrix Sensor','EMX-SNR-M18NO','Industrial M18 cylindrical inductive proximity switch with 8mm sensing distance, 10-30V DC operating range, high switching frequency 500Hz, and IP67 nickel-plated brass housing with LED status indicator.',650.00,'Piece',10,800,'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Supply Voltage\", \"value\": \"10 to 30 VDC\"}, {\"key\": \"Max Load Current\", \"value\": \"200 mA\"}, {\"key\": \"Operating Temperature\", \"value\": \"-25°C to +70°C\"}]','• Sensing Distance: 8 mm (Ferrous metals)\n• Output Type: PNP Normally Open (NO) 3-Wire\n• Protection: Short circuit & reverse polarity protection\n• Cable: 2 Meter oil-resistant PVC pre-wired','Individually blister packed with fixing lock nuts.','Dispatches within 24 hours.','Online payment / UPI / Net Banking',1,0,0,620,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(14,7,3,15,'415V 630A 4-Pole Microprocessor Air Circuit Breaker (ACB) Panel','415v-630a-4-pole-microprocessor-air-circuit-breaker-acb-panel-FCIUG','ElectroMatrix Power','EMX-ACB-630A4P','Drawout type 630 Amps 4-Pole Air Circuit Breaker panel equipped with microprocessor release for overload, short circuit, and earth fault protection. Built in 2.0mm CRCA sheet steel enclosure.',125000.00,'Set',1,15,'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Rated Current (In)\", \"value\": \"630 Amps\"}, {\"key\": \"Rated Voltage (Ue)\", \"value\": \"415V AC 50Hz\"}, {\"key\": \"Standards\", \"value\": \"IS/IEC 60947-2 Certified\"}]','• Breaking Capacity: 50 kA for 1 sec\n• Release: Smart Microprocessor with LCD Metering\n• Motorized Charging & Shunt Trip mechanism included\n• Busbar: High Conductivity Electrolytic Copper Busbars','Wooden crate with internal polythene barrier.','Custom panel assembly and testing in 7-10 days.','50% Advance with order, 50% on pre-dispatch inspection',1,1,0,930,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(15,7,3,16,'True RMS Industrial Digital Multimeter 1000V Auto-Ranging','true-rms-industrial-digital-multimeter-1000v-auto-ranging-JMXhE','ElectroMatrix Tech','EMX-DMM-6000','Professional 6000-count True RMS digital multimeter with AC/DC 1000V, 20A current, resistance, capacitance, frequency, temperature, non-contact voltage (NCV) detection and CAT III 1000V safety rating.',3200.00,'Piece',5,350,'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"DC Voltage Range\", \"value\": \"600mV to 1000V (±0.5%)\"}, {\"key\": \"AC Voltage Range\", \"value\": \"600mV to 750V True RMS (±0.8%)\"}, {\"key\": \"Current Range\", \"value\": \"60uA to 20A AC/DC\"}]','• Display: 6000 Count Backlit LCD with Analog Bar Graph\n• Safety: CAT III 1000V / CAT IV 600V Overload Protection\n• Includes: Gold-plated silicone test leads, K-type thermocouple & case\n• Auto Power Off & Data Hold Functionality','Full retail color box with zipped protective carrying pouch.','Dispatches same day via courier.','100% Online Payment',1,0,0,740,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(16,5,4,17,'Primary Brand Fe 550D High Ductility Corrosion Resistant TMT Rebar Steel','primary-brand-fe-550d-high-ductility-corrosion-resistant-tmt-rebar-steel-Vm2RJ','Vanguard TMT','VAN-TMT-550D','Thermo-Mechanically Treated (TMT) Fe 550D reinforcing steel bars complying with IS 1786:2008 standards. Superior earthquake resistance, higher bendability, and superior bonding with concrete for infrastructure projects.',58500.00,'Metric Ton',10,2500,'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Standard Specification\", \"value\": \"IS 1786:2008 Fe 550D\"}, {\"key\": \"Carbon Equivalent (Max)\", \"value\": \"0.42%\"}, {\"key\": \"Length per Bar\", \"value\": \"12 Meters Standard\"}, {\"key\": \"Tolerance on Weight\", \"value\": \"Within BIS limits ±3%\"}]','• Diameters Available: 8mm, 10mm, 12mm, 16mm, 20mm, 25mm, 32mm\n• Min Yield Strength: 550 N/mm²\n• Min Elongation: 16.0%\n• Includes Mill Test Certificate (MTC) with every trailer dispatch','Bundled with heavy steel wire ties and color-coded identification tags.','Trailer load direct to construction sites in Maharashtra, Gujarat, Goa & MP.','Advance RTGS before dispatch / Bank Guarantee (BG)',1,1,1,1890,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(17,5,4,20,'Heavy Duty Cuplock Scaffolding System & Steel Prop Jacks','heavy-duty-cuplock-scaffolding-system-steel-prop-jacks-ioI39','Vanguard Scaffold','VAN-SCF-CUP100','Complete modular Cuplock scaffolding system including vertical standards with forged cups at 500mm intervals, horizontal ledgers, base jacks, and galvanized steel walking catwalk planks.',74000.00,'Metric Ton',3,450,'https://images.unsplash.com/photo-1590069261209-f8e9b8642343?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Tube Outer Diameter\", \"value\": \"48.3 mm\"}, {\"key\": \"Steel Grade\", \"value\": \"YST 240 / IS 1161\"}, {\"key\": \"Cup Spacing\", \"value\": \"500 mm Centers\"}]','• Material: High Tensile MS Pipe 48.3mm OD x 3.2mm Wall\n• Surface Finish: Hot Dip Galvanized or Anti-Rust Painted\n• Rapid assembly and dismantling with single hammer blow lock','Stacked on steel pallets and strapped for forklift handling.','Immediate stock dispatch.','30% Advance, 70% against Proforma Invoice',1,0,0,710,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(18,5,4,19,'UltraTech / ACC Grade 53 OPC Cement 50kg HDPE Bags (Bulk Supply)','ultratech-acc-grade-53-opc-cement-50kg-hdpe-bags-bulk-supply-EszWX','Vanguard Infra','VAN-CEM-53OPC','Fresh direct factory dispatch Ordinary Portland Cement (OPC 53 Grade) complying with IS 269:2015. High early strength development for high-rise RCC columns, bridges, and precast products.',345.00,'Piece',300,20000,'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Grade\", \"value\": \"OPC 53 Grade (IS 269)\"}, {\"key\": \"Initial Setting Time\", \"value\": \"90 Minutes (Min 30 mins)\"}, {\"key\": \"Soundness (Le Chatelier)\", \"value\": \"1.5 mm\"}]','• Compressive Strength 28 Days: 53 MPa minimum (Actual 60+ MPa)\n• Packaging: Tamper-proof 50kg Laminated HDPE Bags\n• Fresh stock within 10 days of grinding','50kg moisture-resistant HDPE woven bags in full truckloads.','Direct mill truck delivery within 24-48 hours.','100% Advance / RTGS',1,1,0,1250,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(19,5,4,18,'ISMB 300 Heavy Structural Steel Universal Beams & Columns (IS 2062)','ismb-300-heavy-structural-steel-universal-beams-columns-is-2062-TdkVq','Vanguard Steel','VAN-STL-ISMB300','Hot rolled structural steel joists (ISMB 300 x 140 mm) manufactured from prime Grade E250/E350 IS 2062 steel for industrial shed framing, mezzanine floors, and PEB structural buildings.',61000.00,'Metric Ton',5,1200,'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Steel Grade\", \"value\": \"IS 2062:2011 Grade E250A / BR\"}, {\"key\": \"Yield Strength\", \"value\": \"250 N/mm² minimum\"}, {\"key\": \"Tensile Strength\", \"value\": \"410 N/mm²\"}]','• Dimensions: Web Height 300 mm, Flange Width 140 mm\n• Weight: 44.2 kg/meter\n• Lengths: 11 to 12 Meters standard straight lengths\n• Surface: Mill standard with rust-preventive primer coating option','Bundles banded with heavy steel straps.','Trailer delivery to project site within 3 days.','Advance RTGS / Letter of Credit',1,0,0,680,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(20,5,4,21,'600x1200mm Heavy Glazed Vitrified Tiles (GVT/PGVT) Premium Marble Finish','600x1200mm-heavy-glazed-vitrified-tiles-gvtpgvt-premium-marble-finish-J8hUx','Morbi Ceramic','MC-TILE-60120','Commercial high-traffic Polish Glazed Vitrified Porcelain Floor Tiles in 600x1200mm large format with digital Italian marble veins, nano-coating stain resistance, and zero water absorption (<0.05%).',48.00,'Sq.Ft',2000,85000,'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Coverage per Box\", \"value\": \"2 Pieces = 15.50 Sq.Ft (1.44 Sq.M)\"}, {\"key\": \"Modulus of Rupture\", \"value\": \"Min 38 N/mm²\"}, {\"key\": \"Abrasion Resistance\", \"value\": \"PEI Class IV (High Commercial)\"}]','• Size: 600 x 1200 mm (2x4 Feet)\n• Thickness: 9.0 mm heavy body\n• Surface Finish: High Gloss / Carving / Matte\n• Water Absorption: <0.05% Vitrified Body','Corrugated box packaging with 4-corner plastic protectors on wooden pallets.','Full container/truckload from Morbi, Gujarat.','30% Advance, 70% before truck dispatch',1,1,0,950,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(21,3,5,22,'Custom Printed 5-Ply Heavy Duty Kraft Corrugated Shipping Boxes','custom-printed-5-ply-heavy-duty-kraft-corrugated-shipping-boxes-bxxRy','BharatPack','BHP-BOX-5PLY','Industrial strength 5-Ply fluted corrugated shipping cartons manufactured using virgin semi-kraft paper. High edge crush test (ECT) and bursting strength rating suitable for e-commerce, warehousing, and export shipping.',32.50,'Piece',1000,50000,'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Box Style\", \"value\": \"RSC (Regular Slotted Carton)\"}, {\"key\": \"Material\", \"value\": \"100% Recyclable Virgin Semi-Kraft\"}, {\"key\": \"Load Capacity\", \"value\": \"Up to 35 kg Stack Load\"}]','• Flute Type: AB / BC Combination Double Wall\n• Paper GSM: 150 GSM Outer Virgin Kraft + 120 GSM Fluting\n• Custom Flexographic Multi-Color Logo & Barcode Printing\n• Bursting Factor (BF): 24+ BF','Bundled in packs of 25 with shrink wrap and protective edge boards.','Custom production in 4-6 business days.','50% Advance with Purchase Order, 50% on Delivery',1,1,0,950,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(22,3,5,23,'Cast LLDPE Manual & Machine Pallet Stretch Wrap Film Rolls 23 Micron','cast-lldpe-manual-machine-pallet-stretch-wrap-film-rolls-23-micron-1TrPM','BharatFilm','BHP-FLM-23M','High clarity 5-layer co-extruded LLDPE cast stretch film with up to 300% elongation pre-stretch capabilities. Exceptional puncture resistance and one-sided cling properties.',148.00,'Kg',100,8000,'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Raw Material\", \"value\": \"100% Prime Virgin Dow / Sabic LLDPE\"}, {\"key\": \"Stretch Capacity\", \"value\": \"Up to 300%\"}, {\"key\": \"Color\", \"value\": \"Ultra Clear Transparent / Opaque Black\"}]','• Thickness: 23 Micron (Options: 17µ, 29µ available)\n• Roll Width: 500 mm (20 inches)\n• Core Weight: 1.0 kg High Strength Paper Tube\n• Silent unwinding and tear resistance','4 Rolls per carton, 48 cartons per pallet.','Ready stock available for same-day dispatch.','Cash / Cheque / Bank Transfer',1,0,0,540,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(23,3,5,24,'Custom Rotogravure Printed Zipper Stand-Up Barrier Pouches (Multi-layer)','custom-rotogravure-printed-zipper-stand-up-barrier-pouches-multi-layer-DN4gd','BharatPouch','BHP-PCH-ZIP250','Food-grade multi-layer (PET/MET-PET/Poly) zipper stand-up pouches with high oxygen and moisture barrier for spices, dry fruits, snacks, and protein supplements.',3.80,'Piece',10000,200000,'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Sizes Available\", \"value\": \"100g, 250g, 500g, 1kg\"}, {\"key\": \"Food Grade Compliance\", \"value\": \"US FDA & FSSAI Approved\"}, {\"key\": \"Finish\", \"value\": \"Matte / Gloss / Metallic Holographic\"}]','• Structure: 3-Layer Metallized Barrier Laminate (110 Micron)\n• High-grade re-closable press-to-close zipper\n• Tear notch for easy opening\n• Up to 9-color HD rotogravure printing','Packed 1000 pouches per carton.','Cylinder engraving & printing within 10-12 days.','50% with order, balance on dispatch',1,1,0,1120,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(24,3,5,26,'210 Liter Heavy Duty L-Ring Narrow Mouth HM-HDPE Blue Plastic Drum','210-liter-heavy-duty-l-ring-narrow-mouth-hm-hdpe-blue-plastic-drum-lDKrk','BharatBarrel','BHP-DRM-210L','Blow molded 210L High Molecular High Density Polyethylene (HM-HDPE) L-Ring drum with dual 2-inch bung plugs for hazardous chemicals, oils, and industrial solvents.',1650.00,'Piece',50,1500,'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Total Capacity\", \"value\": \"215 Liters (210L Nominal)\"}, {\"key\": \"Material\", \"value\": \"100% Virgin HM-HDPE\"}, {\"key\": \"Closures\", \"value\": \"2x 2\\\\\\\" Bung Openings with EPDM Gaskets\"}]','• UN Certified for Packaging Group II & III Liquids\n• Drop & stack test certified up to 3 tiers\n• Non-corrosive UV stabilized body\n• Tare Weight: 8.5 kg to 10.0 kg options','Protected with stretch hood wrapping in truckload bundles.','Direct dispatch from Ahmedabad.','Advance / Net 15 for registered suppliers',1,0,0,610,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(25,3,5,25,'48mm x 65m BOPP Self-Adhesive Carton Sealing Packaging Tape (Brown & Transparent)','48mm-x-65m-bopp-self-adhesive-carton-sealing-packaging-tape-brown-transparent-wyLiO','BharatTape','BHP-TPE-4865','Industrial grade 42 Micron BOPP packaging tape coated with high tack water-based acrylic adhesive for sealing corrugated cartons in warehouses and automated taping machines.',28.00,'Piece',144,15000,'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Adhesive Type\", \"value\": \"Water Based Acrylic Emulsion\"}, {\"key\": \"Box Quantity\", \"value\": \"72 Rolls per master carton\"}, {\"key\": \"Colors\", \"value\": \"Brown Kraft / Ultra Clear / Custom Printed\"}]','• Width: 48 mm (2 Inches)\n• Length: 65 Meters Guaranteed\n• Thickness: 42 Micron Heavy Duty\n• High initial tack and shear adhesion','Tower shrink wrap of 6 rolls, 72 rolls in 5-ply carton.','Same-day dispatch.','100% Advance Payment',1,0,0,490,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(26,4,6,27,'Industrial Grade Caustic Soda Flakes (Sodium Hydroxide NaOH 99.5%)','industrial-grade-caustic-soda-flakes-sodium-hydroxide-naoh-995-bBnVw','DeltaChem','DLT-NAOH-99FL','High purity membrane cell grade Caustic Soda Flakes (Sodium Hydroxide 99.5% min). Widely utilized in textile processing, paper manufacturing, soap & detergents, water treatment, and alumina refining.',42.00,'Kg',500,25000,'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"CAS Number\", \"value\": \"1310-73-2\"}, {\"key\": \"Molecular Formula\", \"value\": \"NaOH\"}, {\"key\": \"Purity (Assay)\", \"value\": \"99.50% Min\"}, {\"key\": \"Hazard Class\", \"value\": \"Class 8 (Corrosive)\"}]','• Appearance: Pure white deliquescent flakes\n• Purity: 99.5% NaOH Minimum\n• Sodium Carbonate (Na2CO3): 0.4% Max\n• Chlorides (as NaCl): 0.03% Max\n• Heavy Metals: Below 5 ppm','25kg HDPE woven bags with airtight inner LDPE liner.','Full truckload or LCL dispatch with MSDS and COA certificates.','100% Advance / LC at Sight',1,1,0,1400,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(27,4,6,28,'High Purity Isopropyl Alcohol (IPA 99.8% Electronic / Pharma Grade)','high-purity-isopropyl-alcohol-ipa-998-electronic-pharma-grade-7xGF4','DeltaSolv','DLT-IPA-998','Anhydrous high-purity Isopropanol (99.8% min) with ultra-low moisture content (<0.1%) used for semiconductor cleaning, pharmaceutical synthesis, cosmetics, and disinfectant manufacturing.',95.00,'Liter',200,10000,'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"CAS Number\", \"value\": \"67-63-0\"}, {\"key\": \"Boiling Point\", \"value\": \"82.6 °C\"}, {\"key\": \"Flash Point\", \"value\": \"12 °C (Closed Cup)\"}]','• Purity: 99.80% minimum by Gas Chromatography\n• Water Content: <0.08% w/w\n• Acidity: <0.002% Max\n• Clear colorless liquid with clean evaporation','160kg steel drums or 800kg IBC totes with explosion-proof bung seals.','Dispatches via certified PESO hazchem tankers / drums.','Advance Bank Transfer / LC at Sight',1,1,0,980,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(28,4,6,29,'Suspension PVC Resin K-67 Grade for Rigid Pipes & Profiles','suspension-pvc-resin-k-67-grade-for-rigid-pipes-profiles-u6Ac0','DeltaPoly','DLT-PVC-K67','Prime suspension grade Polyvinyl Chloride (PVC) resin with K-value 67. Ideal for rigid CPVC/UPVC agricultural pipes, electrical conduits, window profiles, and heavy injection fittings.',78.00,'Kg',1000,45000,'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"CAS Number\", \"value\": \"9002-86-2\"}, {\"key\": \"Particle Size (60 mesh)\", \"value\": \"99.5% Pass\"}, {\"key\": \"VCM Content\", \"value\": \"<2 ppm\"}]','• K-Value: 66 - 68\n• Apparent Density: 0.54 - 0.58 g/ml\n• Volatile Matter: <0.3%\n• Excellent thermal stability and easy plastification','25kg paper-poly composite valve bags on shrink wrapped pallets.','Immediate supply from Hyderabad & Vadodara godowns.','100% Advance / LC',1,0,0,670,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(29,4,6,30,'Coconut Shell Activated Carbon Granules 8x16 Mesh (Iodine 1000+ mg/g)','coconut-shell-activated-carbon-granules-8x16-mesh-iodine-1000-mgg-8ldcv','DeltaCarbon','DLT-ACT-CARB','Steam-activated high-adsorption coconut shell granular activated carbon. Outstanding microporosity for municipal water purification, gold recovery, air filtration, and catalyst carriers.',135.00,'Kg',500,12000,'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Mesh Size\", \"value\": \"8 x 16 Mesh (2.36mm - 1.18mm)\"}, {\"key\": \"Apparent Density\", \"value\": \"0.48 to 0.52 g/cc\"}, {\"key\": \"CTC Activity\", \"value\": \"55% - 60% Min\"}]','• Iodine Number: 1000 - 1100 mg/g\n• Hardness Number: 98% Minimum (Ultra low dusting)\n• Ash Content: <3.0% Max\n• Moisture: <5.0%','25kg poly-lined PP bags and 500kg jumbo bags.','Shipped in 3 business days.','Advance RTGS',1,0,0,580,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(30,4,6,31,'Rutile Grade Titanium Dioxide (TiO2 White Pigment 98% Min)','rutile-grade-titanium-dioxide-tio2-white-pigment-98-min-EY6OK','DeltaPigment','DLT-TIO2-RUT','Zirconia and alumina surface-treated rutile titanium dioxide pigment manufactured via the chloride process. Superb whiteness, high tinting strength, superior opacity, and high weatherability for paints and masterbatches.',210.00,'Kg',250,18000,'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"CAS Number\", \"value\": \"13463-67-7\"}, {\"key\": \"Crystal Form\", \"value\": \"Rutile (>99.5% Rutile Conversion)\"}, {\"key\": \"pH Value\", \"value\": \"6.5 - 8.5\"}]','• TiO2 Content: 94.0% Minimum (Total Assay >98%)\n• Oil Absorption: 18 - 22 g/100g\n• Specific Gravity: 4.1 g/cm³\n• High gloss and dispersibility in plastics & coatings','25kg multi-wall paper valve bags on 1-ton shrink wrapped pallets.','Immediate pan-India dispatch.','100% Advance Payment / LC',1,1,0,890,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(31,10,7,32,'12.1-Inch ICU Multiparameter Patient Vital Signs Monitor with ECG & SpO2','121-inch-icu-multiparameter-patient-vital-signs-monitor-with-ecg-spo2-5AdUQ','MedLife Pro','ML-MON-12ICU','Full touchscreen 12.1\\\" TFT LCD multi-para ICU monitor displaying 7-lead ECG, Digital SpO2, NIBP, Respiration, Dual Temperature, and Arrhythmia analysis. Built-in thermal printer and 4-hour rechargeable lithium battery.',42000.00,'Set',1,60,'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Display\", \"value\": \"12.1\\\\\\\" High Resolution Color TFT Screen\"}, {\"key\": \"Battery Backup\", \"value\": \"4 Hours continuous operation\"}, {\"key\": \"Trend Storage\", \"value\": \"168 Hours tabular & graphical trends\"}]','• Parameters: ECG, HR, SpO2, NIBP, 2-TEMP, RESP, PR (Optional: EtCO2, IBP)\n• Anti-motion & low perfusion pulse oximetry technology\n• Central Monitoring Station (CMS) network connectivity\n• CDSCO & CE Medical Device Directive Certified','Export medical foam carton with full adult probe accessories.','Dispatches within 24-48 hours with 2-year warranty.','100% Advance / Bank Wire',1,1,1,1650,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(32,10,7,33,'5-Function Fully Motorized Electric ICU Hospital Bed with CPR Release','5-function-fully-motorized-electric-icu-hospital-bed-with-cpr-release-TYNKe','MedLife Care','ML-BED-5MOT','Heavy duty motorized ICU hospital bed with Linak / TiMotion electric actuators controlling backrest, kneerest, Trendelenburg, reverse Trendelenburg, and height elevation. Features tuck-away ABS side rails and central braking casters.',78000.00,'Piece',2,35,'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Bed Frame\", \"value\": \"CRCA Tubular Steel with Anti-Bacterial Epoxy Coating\"}, {\"key\": \"Casters\", \"value\": \"125mm Central Locking Dust-Proof Wheels\"}, {\"key\": \"Mattress\", \"value\": \"4-Section High Density Foam Mattress with Rexine Cover\"}]','• Functions: Backrest (0-75°), Kneerest (0-45°), Trendelenburg (±15°), Height (450-800mm)\n• Integrated hand remote & nurse control panel at footboard\n• Emergency quick mechanical CPR lever\n• Safe Working Load: 250 kg','Heavy duty corrugated crate with edge corner shock protectors.','Direct hospital site delivery and assembly support.','30% Advance, 70% against delivery / LC',1,1,0,1100,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(33,10,7,34,'Medical Grade Powder-Free Nitrile Examination Gloves (Box of 100 Pcs)','medical-grade-powder-free-nitrile-examination-gloves-box-of-100-pcs-BfywH','MedShield Nitrile','ML-GLV-NIT100','Non-sterile powder-free medical blue nitrile gloves with textured fingertips for superior wet/dry grip. Hypoallergenic latex-free formulation offering superior puncture and chemical resistance.',280.00,'Box',50,5000,'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Packaging\", \"value\": \"100 Pieces per Box, 10 Boxes per Master Carton\"}, {\"key\": \"Tensile Strength\", \"value\": \"Min 18 MPa\"}, {\"key\": \"Certification\", \"value\": \"ISO 13485, CE, US FDA 510(k)\"}]','• AQL 1.5 Medical Grade Standard (EN 455 Parts 1, 2, 3 & 4)\n• 100% Synthetic Nitrile Polymer (Zero Natural Rubber Latex)\n• Thickness: 4.0 Mil Finger, 3.5 Mil Palm\n• Sizes: Small, Medium, Large, X-Large','1000 pieces (10 boxes) per heavy corrugated master carton.','Immediate stock dispatch.','100% Advance Payment',1,0,0,840,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(34,10,7,35,'32 kW High Frequency Floor Mounted Digital Radiography (DR) X-Ray Machine','32-kw-high-frequency-floor-mounted-digital-radiography-dr-x-ray-machine-rEbZG','MedLife Ray','ML-XRAY-32KW','State-of-the-art 32 kW / 400 mA high-frequency floor mounted digital X-Ray machine paired with 14x17 inch Wireless Flat Panel Detector (FPD) and DICOM 3.0 image acquisition workstation.',950000.00,'Set',1,10,'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"mA Range\", \"value\": \"10 to 400 mA\"}, {\"key\": \"kV Range\", \"value\": \"40 to 125 kV (1 kV steps)\"}, {\"key\": \"Detector Resolution\", \"value\": \"16-Bit A/D, 3.6 lp/mm\"}]','• Generator: 32 kW High Frequency 100 kHz with anatomical APR programming\n• Tube: Dual Focus Rotating Anode X-Ray Tube (140 kHU)\n• Table: 4-Way Floating Top Table with Electro-Magnetic Brakes\n• AERB Type Approved & CDSCO Certified','Heavy shock-mounted wooden crate packing.','Installation, darkroom planning, and AERB compliance handover included.','30% Advance, 70% upon site delivery',1,1,0,1240,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(35,10,7,36,'10 Liter Dual Flow Medical Oxygen Concentrator 93% ± 3% (Continuous Duty)','10-liter-dual-flow-medical-oxygen-concentrator-93-3-continuous-duty-GdRDN','MedLife O2','ML-O2-10L','Heavy-duty 10 L/min medical oxygen generator with French imported CECA molecular sieve, dual flow meters for treating 2 patients simultaneously, built-in oxygen purity sensor, and nebulizer port.',48500.00,'Piece',2,80,'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Outlet Pressure\", \"value\": \"0.04 to 0.07 MPa\"}, {\"key\": \"Power Consumption\", \"value\": \"650 Watts @ 220V 50Hz\"}, {\"key\": \"Weight\", \"value\": \"23.5 kg with omnidirectional wheels\"}]','• Flow Rate: 1 to 10 Liters / minute adjustable\n• Oxygen Purity: 93% ± 3% at full 10 LPM flow\n• Compressor: Ultra-quiet pure copper oil-free compressor (<48 dB)\n• Safety Alarms: Low O2 purity alarm, power failure alarm, high/low pressure alarm','Heavy honeycomb corrugated box with dual humidity cannulas and filters.','Same-day dispatch.','100% Advance Payment',1,0,0,910,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(36,6,8,37,'100% Combed Compact Ring Spun Cotton Yarn 30s Count for Knitting','100-combed-compact-ring-spun-cotton-yarn-30s-count-for-knitting-7my7g','RoyalCotton','RSW-YRN-30C','Export quality 100% Shankar-6 virgin cotton 30s combed compact yarn with ultra-low hairiness, high CSP (2800+), and excellent tensile strength for circular knitting of premium t-shirts and fabrics.',265.00,'Kg',1000,30000,'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Cone Weight\", \"value\": \"1.89 kg Paper Cone\"}, {\"key\": \"Twist per Inch (TPI)\", \"value\": \"19.5 - 20.5\"}, {\"key\": \"Moisture Regain\", \"value\": \"7.5% - 8.5%\"}]','• Yarn Count: 30s Ne Combed Compact\n• Raw Material: 100% Prime Indian Shankar-6 Cotton\n• CSP (Count Strength Product): 2800 - 2900\n• Imperfection Index (IPI): < 50 / km','24 Cones per PP woven bag (45.36 kg net weight) or palletized.','Full truckload dispatch within 3 days from Surat / Coimbatore mills.','Advance RTGS / LC at Sight',1,1,1,1340,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(37,6,8,38,'Heavy Duty 100% Cotton Drill Flame Retardant Industrial Uniform Fabric','heavy-duty-100-cotton-drill-flame-retardant-industrial-uniform-fabric-tTfy7','RoyalShield','RSW-FAB-FR240','Premium 240 GSM 100% Cotton 3/1 Twill fabric with EN ISO 11612 certified flame retardant finish. Engineered for oil & gas refinery coveralls, mining boiler suits, and electrical substation workwear.',125.00,'Meter',500,15000,'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Composition\", \"value\": \"100% Ring Spun Combed Cotton\"}, {\"key\": \"Weave Pattern\", \"value\": \"3/1 Heavy Twill Drill\"}, {\"key\": \"Tensile Strength\", \"value\": \"Warp > 1100 N, Weft > 800 N\"}, {\"key\": \"Shrinkage\", \"value\": \"Less than 2.5%\"}]','• Width: 58/60 inches\n• Weight: 240 GSM ± 5%\n• Color Fastness to Washing: 4-5 Grade\n• OEKO-TEX Standard 100 Certified\n• Available Colors: Navy Blue, Orange, Royal Blue, Khaki, Hi-Vis Yellow','Double folded rolls of 100 meters wrapped in protective poly bags.','Dispatches in 3 business days from Surat warehouse.','30% Advance, 70% against delivery / LC',1,1,0,880,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(38,6,8,39,'14.5 Oz Heavyweight Raw Indigo 100% Cotton Selvedge Denim Fabric','145-oz-heavyweight-raw-indigo-100-cotton-selvedge-denim-fabric-xBbFl','RoyalDenim','RSW-DNM-145','Authentic shuttle-loom woven 14.5 Oz rigid raw indigo denim fabric with red-line selvedge edge. Ideal for premium jeans manufacturers and streetwear fashion brands.',185.00,'Meter',300,20000,'https://images.unsplash.com/photo-1582418702059-97ebafb35d09?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Yarn Warp/Weft\", \"value\": \"7s x 6s Ring Spun Slub\"}, {\"key\": \"Shrinkage\", \"value\": \"Sanforized (3-4%)\"}]','• Weight: 14.50 Oz/sq.yd (490 GSM)\n• Width: 32 Inches (Selvedge) / 58 Inches (Standard Open Width)\n• Dyeing: Deep Pure Indigo Rope Dyed (12 Dips)\n• Weave: 3/1 Right Hand Twill','Rolls of 100 meters in heavy polythene barrier wrap.','Immediate stock dispatch from Surat / Ahmedabad.','Advance / Net 30 for established apparel exporters',1,0,0,760,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(39,6,8,40,'70 GSM Hydrophobic Polypropylene Spunbond Non-Woven Fabric Rolls','70-gsm-hydrophobic-polypropylene-spunbond-non-woven-fabric-rolls-E9JpR','RoyalBond','RSW-NWV-70G','100% virgin PP spunbond non-woven fabric with high tensile strength and uniform fiber distribution. Utilized for shopping carry bags, furniture interlining, agriculture crop covers, and medical gowns.',118.00,'Kg',500,15000,'https://images.unsplash.com/photo-1604014237800-1c9102c219da?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Raw Material\", \"value\": \"100% Virgin Polypropylene (PP)\"}, {\"key\": \"Tensile Strength MD\", \"value\": \">140 N/5cm\"}, {\"key\": \"Elongation at Break\", \"value\": \"50% - 70%\"}]','• GSM Range: 30 to 120 GSM (Standard 70 GSM)\n• Width: 1.6m to 3.2m roll widths\n• 100% Recyclable and eco-friendly polymer\n• Available in 30+ vibrant solid shades','Tightly wound rolls wrapped in transparent stretch film with cardboard core.','Dispatches within 2 days.','Advance RTGS / UPI',1,0,0,610,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(40,6,8,41,'100% Spun Polyester High Tenacity Industrial Sewing Thread 40/2 (5000m)','100-spun-polyester-high-tenacity-industrial-sewing-thread-402-5000m-bVVBD','RoyalThread','RSW-THD-402','Silicon lubricated 40/2 count spun polyester thread for high-speed multi-needle industrial lockstitch sewing machines. Zero breaking at 5000 SPM with high color fastness and knotless quality.',82.00,'Piece',100,5000,'https://images.unsplash.com/photo-1609743522653-52354461eb27?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Fiber\", \"value\": \"100% High Tenacity Staple Polyester\"}, {\"key\": \"Lubrication\", \"value\": \"Specialized Silicone Thread Lubricant (4%)\"}]','• Count: 40/2 (Ticket 120)\n• Length per Spool: 5000 Meters\n• Breaking Strength: >1150 cN\n• 400+ Pantone matched shades in stock','Boxes of 12 spools, 120 spools per master carton.','Immediate stock dispatch.','100% Advance Payment',1,0,0,510,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(41,8,9,42,'1121 Steam Extra Long Grain Traditional Indian Basmati Rice (XXL Length)','1121-steam-extra-long-grain-traditional-indian-basmati-rice-xxl-length-QMRDj','KisanAgro Royal','KAG-RICE-1121S','Naturally aged 1121 Steam Basmati Rice with an average grain length (AGL) of 8.35 mm before cooking and elongating over 22mm after cooking. Delicate aroma, non-sticky pearly white grains for export and hospitality.',92.00,'Kg',1000,100000,'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Crop Year\", \"value\": \"Current Season (Aged 12+ Months)\"}, {\"key\": \"Admixture\", \"value\": \"< 5% Max\"}, {\"key\": \"Certification\", \"value\": \"FSSAI, APEDA, ISO 22000, HACCP\"}]','• Average Grain Length (Raw): 8.35 mm Minimum\n• Moisture: < 12.5%\n• Broken Grains: < 1.0%\n• Purity: 95% Pure 1121 Variety with AGMARK certification','10kg, 25kg, and 50kg Non-Woven Fabric / BOPP Laminated export bags.','Full container / truckload dispatch from Punjab & Haryana.','30% Advance, 70% against BL copy / 100% LC at sight',1,1,1,2450,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(42,8,9,43,'Pure Organic Salem Turmeric Powder (Curcumin 4.5% Min) & Stem Finger','pure-organic-salem-turmeric-powder-curcumin-45-min-stem-finger-zjunW','KisanAgro Spices','KAG-TRM-CURC45','Farm-fresh Salem grade organic turmeric powder and polished fingers with guaranteed 4.5% to 5.0% natural Curcumin content. Free from lead chromate, artificial coloring agents, or starch fillers.',145.00,'Kg',200,15000,'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Mesh Size\", \"value\": \"80 - 100 Mesh Fine Powder\"}, {\"key\": \"Pesticide Residue\", \"value\": \"Complies with EU / US FDA limits\"}, {\"key\": \"Certification\", \"value\": \"NPOP Organic, FSSAI, Spice Board India\"}]','• Curcumin Content: > 4.50% by HPLC analysis\n• Moisture: < 9.0%\n• Total Ash: < 6.5%\n• 100% Pure ground whole fingers with rich natural golden color','25kg food-grade multi-wall kraft paper bags with inner poly barrier.','Dispatches within 3-4 days with COA report.','100% Advance / Bank Wire',1,1,0,1180,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(43,8,9,44,'16mm Inline Cylindrical Drip Irrigation Lateral Pipe (Class 2 / 2.0 LPH)','16mm-inline-cylindrical-drip-irrigation-lateral-pipe-class-2-20-lph-tIm84','KisanDrip','KAG-DRP-16MM','IS 13488 certified 16mm inline drip lateral pipe with built-in pressure-compensating turbulent flow cylindrical drippers spaced at 30cm / 40cm / 50cm intervals for precision horticulture and crop irrigation.',1850.00,'Piece',5,500,'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Roll Length\", \"value\": \"400 Meters / 500 Meters standard roll\"}, {\"key\": \"Working Pressure\", \"value\": \"0.8 to 2.5 bar\"}, {\"key\": \"Emission Uniformity (EU)\", \"value\": \"> 95%\"}]','• Outer Diameter: 16 mm (Wall thickness: 0.9 mm Class 2)\n• Dripper Discharge: 2.0 LPH or 4.0 LPH @ 1.0 kg/cm²\n• Material: UV stabilized virgin LLDPE polymer\n• High clog resistance with self-flushing labyrinth path','400m wrapped coils strapped with heavy PVC binding.','Prompt dispatch across all agricultural zones.','Online Bank Transfer / RTGS',1,0,0,780,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(44,8,9,45,'Pure Cold Pressed Kachi Ghani Mustard Oil (High Pungency & Zero Chemical)','pure-cold-pressed-kachi-ghani-mustard-oil-high-pungency-zero-chemical-UJI3P','KisanPure','KAG-OIL-MUST15L','Traditional wooden kolhu cold-pressed unrefined virgin mustard oil extracted from premium black mustard seeds. Rich in natural Omega-3 fatty acids, natural antioxidants, and authentic pungent aroma.',1950.00,'Piece',20,2000,'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Pungency (Allyl Isothiocyanate)\", \"value\": \"Min 0.32%\"}, {\"key\": \"Volume\", \"value\": \"15 Liters (13.65 kg net)\"}, {\"key\": \"AGMARK Grade\", \"value\": \"Grade 1 Certified Raw Kachi Ghani\"}]','• Extraction: Cold Pressed under 40°C in wooden presses\n• Free Fatty Acid (FFA): < 0.8%\n• Packaging: 15 Liter Food Grade Tin Cans (or 1L Bottles)\n• 100% Pure virgin oil with no palm or argemone blending','15 Liter heavy export tin with seal cap.','Full truckload or LCL dispatch.','100% Advance Payment',1,0,0,640,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(45,8,9,46,'100% Water Soluble NPK 19:19:19 Foliar & Fertigation Fertilizer (25kg Bag)','100-water-soluble-npk-191919-foliar-fertigation-fertilizer-25kg-bag-NWEfE','KisanGrow NPK','KAG-NPK-191919','Fully water-soluble balanced NPK 19-19-19 foliar fertilizer enriched with chelated trace micronutrients (Zn, Fe, Mn, Cu, B, Mo). Rapid nutrient uptake for high-yield vegetables, fruits, and floriculture.',2450.00,'Piece',20,1500,'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"FCO Compliance\", \"value\": \"Fertilizer Control Order 1985 Approved\"}, {\"key\": \"Moisture\", \"value\": \"< 0.5% Max\"}, {\"key\": \"Bag Weight\", \"value\": \"25 kg Poly-Lined HDPE Bag\"}]','• Total Nitrogen (N): 19.0% (Ammoniacal + Nitrate + Urea)\n• Water Soluble Phosphate (P2O5): 19.0%\n• Water Soluble Potash (K2O): 19.0%\n• 100% Instant Solubility with zero residue in drip emitters','25kg laminated bags with inner sealed liner.','Dispatches within 24 hours.','Advance Payment / Bank Transfer',1,0,0,520,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(46,9,10,47,'OEM Heavy Duty Semi-Metallic Commercial Vehicle Brake Pads & Liners','oem-heavy-duty-semi-metallic-commercial-vehicle-brake-pads-liners-pRhC7','AutoDrive OEM','ADV-BRK-700CV','Heavy duty commercial disc brake pad sets engineered for Tata, Ashok Leyland, and BharatBenz heavy commercial trucks and buses. Low rotor wear, zero fade at 650°C, and exceptional stopping power.',1450.00,'Set',10,2500,'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Operating Temperature\", \"value\": \"-40°C to 650°C\"}, {\"key\": \"Shear Strength\", \"value\": \"> 3.5 MPa\"}, {\"key\": \"Application\", \"value\": \"Commercial Trucks, Buses & Heavy Trailers\"}]','• Friction Coefficient: 0.38 - 0.42 (Class FF)\n• Friction Material: Non-Asbestos Semi-Metallic with Kevlar & Copper fibers\n• ISO/TS 16949 & ECE R90 Certified\n• Includes stainless steel anti-rattle shims and wear sensor slots','Shrink-wrapped 4-piece axle set in heavy branded box.','Immediate dispatch from Chennai and Pune hubs.','30% Advance, 70% against delivery',1,1,1,1560,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(47,9,10,48,'Heavy Duty Dual-Stage Engine Air Filter & Spin-On Oil Filter Assembly','heavy-duty-dual-stage-engine-air-filter-spin-on-oil-filter-assembly-EpawM','AutoDrive Filter','ADV-FLT-DUAL','High filtration efficiency cellulose and synthetic microfiber pleated radial seal air filters and heavy gauge spin-on lube oil filters offering 99.9% dust and particle trapping efficiency.',680.00,'Piece',20,4000,'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Filter Media\", \"value\": \"Ahlstrom High Efficiency Microfiber Paper\"}, {\"key\": \"Burst Pressure\", \"value\": \"20 Bar (Oil Filter)\"}]','• Filtration Efficiency: 99.9% @ 10 Micron\n• Radial seal polyurethane gasket for airtight fit\n• High dust holding capacity for dusty Indian road conditions\n• OEM replacement for leading commercial vehicle engines','Individually boxed in moisture-sealed cartons.','Dispatches within 24 hours.','Advance / Net 30 for distributors',1,0,0,840,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(48,9,10,49,'60 kW Dual Gun CCS2 Commercial Electric Vehicle DC Fast Charger','60-kw-dual-gun-ccs2-commercial-electric-vehicle-dc-fast-charger-tZiYl','AutoDrive EV','ADV-EVC-60KW','Commercial dual-gun CCS Type-2 electric vehicle DC fast charging station with 95.5% conversion efficiency, OCPP 1.6J protocol for automated billing and CMS, 7\\\" touchscreen, and IP54 outdoor rating.',485000.00,'Set',1,20,'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Gun Cable Length\", \"value\": \"5.0 Meters Dual Phoenix / REMA Cables\"}, {\"key\": \"Ingress Protection\", \"value\": \"IP54 Outdoor Weatherproof Galvanized Steel\"}, {\"key\": \"Certification\", \"value\": \"ARAI / ICAT Certified for Indian Grid Standards\"}]','• Output Power: 60 kW (Dynamic load sharing 30kW+30kW or 60kW single)\n• Output Voltage: 150V - 1000V DC wide range (400V & 800V EV compatible)\n• Connectivity: 4G LTE, Ethernet, Wi-Fi, RFID Reader\n• Protections: Over-voltage, under-voltage, short circuit, insulation monitoring','Heavy wooden pallet packing with weather protection cover.','Dispatched in 7-10 days with on-site commissioning support.','50% Advance with order, 50% before dispatch',1,1,0,1890,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(49,9,10,50,'High Tensile 65Si7 Alloy Steel Multi-Leaf Suspension Spring Assembly','high-tensile-65si7-alloy-steel-multi-leaf-suspension-spring-assembly-pjpfY','AutoDrive Springs','ADV-SPG-10LF','Parabolic and multi-leaf automotive suspension springs manufactured from 65Si7 / SUP9 alloy steel. Shot-peened and heat-treated for maximum fatigue endurance under severe axle overload.',5800.00,'Set',4,600,'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Width x Thickness\", \"value\": \"90 mm x 16 mm (10-Leaf Assembly)\"}, {\"key\": \"Load Capacity per Axle\", \"value\": \"Up to 16 Metric Tons\"}]','• Material: 65Si7 / 60Si7 High Tensile Spring Steel\n• Hardness: 400 - 450 BHN (HRC 42-47)\n• Surface: Shot-peened with anti-rust phosphate zinc primer\n• Tested for 200,000+ continuous load cycles without fatigue','Bundled on heavy wooden skids with steel strapping.','Direct dispatch from Chennai.','30% Advance, 70% on dispatch',1,0,0,670,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(50,9,10,51,'72V 100Ah Lithium Iron Phosphate (LiFePO4) EV Battery Pack for 3-Wheelers','72v-100ah-lithium-iron-phosphate-lifepo4-ev-battery-pack-for-3-wheelers-y0Ioj','AutoDrive Power','ADV-BAT-72V100','AIS 156 (Phase 2) certified 7.2 kWh LiFePO4 battery pack with smart Bluetooth/CAN BMS, thermal propagation runaway protection, and IP67 waterproof aluminum casing for commercial electric auto rickshaws and delivery loaders.',92000.00,'Piece',2,80,'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Cycle Life\", \"value\": \"3500+ Cycles @ 80% DOD (5-8 Years Life)\"}, {\"key\": \"Enclosure\", \"value\": \"IP67 Heavy Duty Die-Cast Aluminum\"}, {\"key\": \"Compliance\", \"value\": \"AIS 156 Phase 2 Certified by ARAI\"}]','• Nominal Voltage: 76.8 V (24S Configuration)\n• Energy: 7.68 kWh\n• Continuous Discharge Current: 100 A (Peak 200 A for 10s)\n• Built-in GPS/GSM IoT tracking & remote battery monitoring','UN 3480 Class 9 dangerous goods certified wooden crate.','Dispatches in 3-5 days.','50% Advance, 50% against invoice',1,1,0,1430,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(51,11,11,52,'UrbanWork High-Back Ergonomic Synchronized Mesh Executive Office Chair','urbanwork-high-back-ergonomic-synchronized-mesh-executive-office-chair-YfTI4','UrbanWork Pro','UBW-CHR-EXEC','BIFMA X5.1 certified ergonomic high-back task chair featuring Korean breathable mesh back, 3D adjustable armrests, 3-position synchronized tilt-lock mechanism, adjustable lumbar support, and Class 4 Korean gas lift.',7800.00,'Piece',5,300,'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Gas Lift\", \"value\": \"Class 4 BIFMA Certified 100mm Stroke\"}, {\"key\": \"Headrest\", \"value\": \"2D Height & Angle Adjustable Headrest\"}, {\"key\": \"Warranty\", \"value\": \"3 Years Comprehensive Warranty\"}]','• Mechanism: Self-calibrating weight-sensing synchro tilt mechanism\n• Seat: High density moulded PU foam cushion (55 kg/m³)\n• Base: 350mm Die-Cast Polished Aluminum Base with 60mm nylon castors\n• Tested for 136 kg continuous user capacity','Semi-knocked-down (SKD) single chair packaging in 7-ply export carton.','Immediate stock dispatch.','100% Advance Payment / Net 15 for corporate orders',1,1,1,1670,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(52,11,11,53,'Modular 4-Person Back-to-Back Office Linear Workstation with Cable Trays','modular-4-person-back-to-back-office-linear-workstation-with-cable-trays-qXAUV','UrbanWork Desk','UBW-WRK-4MOD','4-Seater modular linear workstation pod featuring 25mm E1 grade pre-laminated engineered wood tabletops, 50x50mm triangular powder-coated steel legs, pinnable acoustic fabric dividers, and concealed wire raceways.',26500.00,'Set',1,50,'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Tabletop Material\", \"value\": \"25mm Action TESA / Greenlam Pre-lam with 2mm PVC Edge Bending\"}, {\"key\": \"Wire Management\", \"value\": \"Integrated dual-side metal cable tray & flip-up power box\"}]','• Table Size per Person: 1200 x 600 mm (Total pod 2400 x 1200 mm)\n• Metal Structure: Heavy duty 1.6mm MS frame with pure polyester powder coating\n• Partition: 300mm acoustic fabric screen with magnetic accessory bar\n• Includes 3-drawer mobile pedestals with central key lock','Flat-packed knock-down (KD) boxes with assembly manual and hardware.','On-site installation support available across major Indian cities.','50% Advance with order, 50% before dispatch',1,1,0,1120,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(53,11,11,54,'Industrial Heavy Duty Selective Pallet Storage Rack System (Up to 3 Ton/Level)','industrial-heavy-duty-selective-pallet-storage-rack-system-up-to-3-tonlevel-55Inb','UrbanRack','UBW-RCK-3TON','High-bay modular selective pallet racking constructed from high tensile CRCA steel uprights and roll-formed box beams with safety locking pins for warehouse logistics and manufacturing raw material inventory.',18500.00,'Set',2,120,'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Upright Section\", \"value\": \"90 x 70 x 2.0 mm Omega Profile\"}, {\"key\": \"Beam Section\", \"value\": \"100 x 50 x 1.6 mm Box Beam with 3-claw connector\"}]','• Height: 3000 mm to 9000 mm customized\n• Beam Length: 2700 mm standard (holds two 1200x1000mm standard pallets)\n• Load Capacity: 1000 kg to 3000 kg Uniformly Distributed Load (UDL) per pair of beams\n• Epoxy powder coated in international standard Blue & Orange','Bundled on wood runners with heavy strapping.','Dispatches within 5-7 days from Kolkata & Pune factories.','30% Advance, 70% against delivery',1,0,0,780,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(54,11,11,55,'4-Drawer Heavy Gauge Steel Vertical Filing Cabinet with Central Lock','4-drawer-heavy-gauge-steel-vertical-filing-cabinet-with-central-lock-xXReX','UrbanWork Safe','UBW-CAB-4DRW','Heavy gauge 0.8mm CRCA cold rolled steel 4-drawer vertical filing cabinet with ball-bearing telescopic runners, anti-tilt mechanism (only one drawer opens at a time for safety), and central locking system.',11500.00,'Piece',2,80,'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Material\", \"value\": \"Prime CRCA Steel Sheet (IS 513 Grade)\"}, {\"key\": \"Locking Mechanism\", \"value\": \"Godrej / Camlock Central High-Security Lock with 2 duplicate keys\"}]','• Dimensions: 1320 (H) x 460 (W) x 620 (D) mm\n• Suitable for Legal / Foolscap and A4 hanging suspension files\n• Drawer Capacity: 40 kg load per drawer\n• Anti-scratch epoxy polyester powder coat finish','Fully assembled cabinet in 5-ply honeycomb carton with corner buffers.','Dispatches in 24-48 hours.','100% Advance Payment',1,0,0,540,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(55,11,11,56,'Executive 3-Seater Top Grain Leather Office Reception Sofa','executive-3-seater-top-grain-leather-office-reception-sofa-uU8KR','UrbanWork Luxe','UBW-SOF-3STR','Contemporary minimalist executive office sofa with premium breathable PU leather upholstery, solid neem wood internal skeleton frame, high resilience supersoft foam, and polished chrome stainless steel base.',28000.00,'Set',1,25,'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Dimensions\", \"value\": \"1950 (L) x 850 (D) x 780 (H) mm\"}, {\"key\": \"Leg Base\", \"value\": \"SS304 Polished Stainless Steel Tubular Frame\"}]','• Seating: 3 Persons Comfortable Wide Seating (1950 mm Length)\n• Upholstery: Tear-resistant breathable leatherette in Matte Black / Tan Brown\n• Cushion: 40 Density High Resilience Foam with pocket spring layer\n• Frame: Kiln-dried solid hardwood treated against termites','Multi-layer bubble wrap, edge protectors, and corrugated outer crate.','Dispatches within 3 days.','50% Advance with order, 50% on dispatch',1,0,0,690,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(56,12,12,57,'Hikvision / Dahua 8MP 4K Ultra HD IP Dome Surveillance Camera with Smart AI','hikvision-dahua-8mp-4k-ultra-hd-ip-dome-surveillance-camera-with-smart-ai-5H4lb','SecureTech Vision','SEC-CAM-4K8MP','8 Megapixel 4K real-time (3840x2160 @ 30fps) outdoor IP camera with Sony Starvis low-light sensor, 30m Smart EXIR Night Vision, H.265+ high compression, built-in mic, PoE power, and AI human/vehicle classification.',6200.00,'Piece',5,500,'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Lens\", \"value\": \"2.8mm Ultra-Wide Angle Lens (108° FOV)\"}, {\"key\": \"Power Supply\", \"value\": \"PoE (802.3af) or 12V DC\"}, {\"key\": \"WDR\", \"value\": \"120 dB True Wide Dynamic Range\"}]','• Resolution: 8MP 4K Ultra High Definition\n• AI Features: AcuSense Human & Vehicle deep learning false alarm filter\n• Housing: IP67 Waterproof & IK10 Vandal-Proof Metal Casing\n• Built-in MicroSD slot supporting up to 256GB edge recording','Full retail packaging with waterproof cable gland and mounting drill template.','Same-day courier dispatch.','100% Advance Payment / Online Payment',1,1,1,1980,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(57,12,12,58,'AI Facial Recognition & Fingerprint Time Attendance Access Control Terminal','ai-facial-recognition-fingerprint-time-attendance-access-control-terminal-NXsUK','SecureTech Bio','SEC-BIO-FACE100','Contactless dual-camera AI face recognition attendance machine with 0.2 second recognition speed, anti-spoofing algorithm, 6000 face capacity, fingerprint sensor, RFID reader, and cloud HRMS software integration.',14500.00,'Piece',1,120,'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Screen\", \"value\": \"5.0-Inch IPS Touchscreen Display\"}, {\"key\": \"Recognition Distance\", \"value\": \"0.5m to 2.5m Walk-Through Speed\"}]','• Capacity: 6,000 Faces, 10,000 Fingerprints, 200,000 Log Records\n• Dual Visible Light + Infrared Cameras for 0 Lux dark room recognition\n• Connectivity: TCP/IP, Wi-Fi, USB, Wiegand output for door electromagnetic locks\n• Includes free multi-location cloud attendance & payroll management software','Retail box with wall mounting plate, power adapter, and software CD.','Dispatches within 24 hours.','100% Advance Online Payment',1,1,0,1420,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(58,12,12,59,'Automatic Novec 1230 / FM200 Clean Agent Gas Fire Extinguishing System','automatic-novec-1230-fm200-clean-agent-gas-fire-extinguishing-system-nCsTo','SecureTech Fire','SEC-FIR-NOV100','UL Listed and PESO approved Total Flooding Clean Agent Fire Suppression system for data centers, server rooms, electrical panels, and battery rooms. Leaves zero residue and electrically non-conductive.',85000.00,'Set',1,25,'https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Cylinder Volume\", \"value\": \"40L / 67L / 120L Seamless Steel Cylinder\"}, {\"key\": \"Working Pressure\", \"value\": \"25 Bar / 42 Bar Nitrogen Super-pressurized\"}]','• Extinguishing Agent: FK-5-1-12 (Novec 1230) or HFC-227ea (FM200)\n• Discharge Time: Rapid discharge within 10 seconds\n• Includes: Seamless cylinder, solenoid release valve, pressure switch & 360° discharge nozzle\n• Zero ozone depletion potential (ODP 0) and safe for occupied spaces','Heavy steel framed crate with valve protector cap.','Includes hydraulic piping design and commissioning guidance.','50% Advance, 50% on site dispatch',1,0,0,690,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(59,12,12,60,'IS 2925 Industrial Safety Helmets with Ratchet Adjustment & High-Vis PPE Vests','is-2925-industrial-safety-helmets-with-ratchet-adjustment-high-vis-ppe-vests-TNX94','SecureTech PPE','SEC-PPE-HLM100','High-impact HDPE industrial safety helmets conforming to IS 2925:1984 with 6-point textile suspension, quick ratchet headband adjustment, sweatband, and 2-inch reflective tape safety vests.',145.00,'Piece',50,5000,'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Standard\", \"value\": \"BIS IS 2925:1984 & CE EN 397\"}, {\"key\": \"Suspension\", \"value\": \"6-Point Textile Cradle with Ratchet Adjuster\"}]','• Shell Material: Virgin High Density Polyethylene (HDPE)\n• Electrical Insulation: Tested up to 2000V AC\n• Chin Strap & Sweatband: Adjustable chin strap with quick-release buckle\n• Colors Available: Yellow, White, Blue, Red, Green','Packed 40 helmets per carton box.','Same-day bulk dispatch.','100% Advance Payment',1,0,0,820,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(60,12,12,61,'2-Loop Addressable Fire Alarm Control Panel (500 Devices Capacity)','2-loop-addressable-fire-alarm-control-panel-500-devices-capacity-nIiyv','SecureTech Alarm','SEC-ALM-2LOOP','Microprocessor controlled 2-Loop intelligent addressable fire alarm panel with 240x64 graphical LCD display, capacity for up to 504 smoke/heat detectors and call points, built-in battery charger, and event logger.',38000.00,'Set',1,40,'https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Operating Voltage\", \"value\": \"230V AC 50Hz (24V DC Internal)\"}, {\"key\": \"Sounder Outputs\", \"value\": \"2 Supervised Monitored Alarm Circuits (1A max each)\"}]','• Capacity: 2 Loops x 252 Addresses = 504 Devices\n• Protocol: Digital loop communication with peer-to-peer networking\n• Event Storage: 4,000 history event log with time stamp\n• Certified to EN 54-2 and EN 54-4 standards','Heavy foam-cushioned carton with installation manual.','Dispatches within 2 business days.','Advance Bank Wire',1,1,0,610,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(61,13,13,62,'CloudLogic Enterprise Manufacturing ERP & Production Planning Software','cloudlogic-enterprise-manufacturing-erp-production-planning-software-X3qBk','CloudLogic ERP','CLD-ERP-MFG','Comprehensive multi-branch cloud ERP platform tailored for Indian manufacturing businesses. Covers Bill of Materials (BOM), shop-floor work orders, raw material MRP, GST e-Invoicing & e-Way bill, and real-time inventory management.',150000.00,'Project',1,999,'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Deployment\", \"value\": \"Cloud SaaS or On-Premise Private Server\"}, {\"key\": \"API Integrations\", \"value\": \"GST Portal, Razorpay, Tally Prime, SAP Connector\"}, {\"key\": \"Support\", \"value\": \"Dedicated Account Manager & 24/7 Technical SLA\"}]','• Modules: Production & MRP, Procurement, Inventory, Sales CRM, GST Accounts, Quality Control, HRMS\n• Automated WhatsApp and SMS customer order dispatch alerts\n• Cloud Hosted on AWS Mumbai with 99.9% uptime SLA\n• Includes 50 concurrent user licenses & custom workflow configuration','Digital delivery with full source code deployment and user training.','Deployment and custom rollout within 3-4 weeks.','30% Milestone Advance, 40% on UAT, 30% on Go-Live',1,1,1,2100,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(62,13,13,63,'Industrial IoT Smart Gateway & Real-Time Machine SCADA Telemetry System','industrial-iot-smart-gateway-real-time-machine-scada-telemetry-system-yZKZL','CloudLogic IoT','CLD-IOT-GW100','DIN-rail mounted industrial IoT Edge Gateway supporting Modbus RTU/TCP, OPC-UA, and RS485 for reading CNC machines, energy meters, PLC controllers, and streaming data to cloud analytics dashboards.',35000.00,'Set',1,50,'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Processor\", \"value\": \"ARM Cortex-A7 Industrial Grade 800MHz\"}, {\"key\": \"Operating Temperature\", \"value\": \"-40°C to +85°C Rugged Aluminum Enclosure\"}]','• Protocols: Modbus, MQTT, OPC-UA, BACnet, HTTP REST\n• Connectivity: 4G LTE Cat-M1/NB-IoT + Dual Ethernet + RS485/RS232\n• Security: Hardware Secure Element (TPM 2.0) & TLS 1.3 encryption\n• Pre-configured web dashboard for Overall Equipment Effectiveness (OEE) tracking','Industrial packaging with 4G magnetic antenna and DIN rail clips.','Dispatches in 3 days with cloud dashboard setup credentials.','100% Advance Payment',1,1,0,1250,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(63,13,13,64,'Enterprise Cybersecurity Vulnerability Assessment & VAPT Penetration Testing','enterprise-cybersecurity-vulnerability-assessment-vapt-penetration-testing-L2YC6','CloudLogic Cyber','CLD-SEC-VAPT','CERT-In empaneled standard Vulnerability Assessment & Penetration Testing (VAPT) for web applications, mobile apps, and cloud network infrastructure with detailed remediation report and re-test certificate.',65000.00,'Project',1,999,'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Standards Followed\", \"value\": \"OWASP ASVS 4.0, NIST SP 800-115, ISO 27001\"}, {\"key\": \"Turnaround Time\", \"value\": \"5 to 7 Business Days\"}]','• Scope: OWASP Top 10, SANS Top 25, Network Ports, Cloud IAM Configuration\n• Certified ethical hackers (CEH, OSCP, CISSP Certified Team)\n• Comprehensive executive summary & developer-level remediation POCs\n• Final Safe-to-Host VAPT clearance certificate','Encrypted digital audit report & signed compliance certificate.','Immediate remote kickoff with NDA.','50% on kickoff, 50% upon final certificate issuance',1,0,0,980,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(64,13,13,65,'Custom B2B Marketplace & Dealer Management Mobile App Development','custom-b2b-marketplace-dealer-management-mobile-app-development-VdRsq','CloudLogic Apps','CLD-APP-B2B','Full-stack cross-platform iOS & Android mobile application development with Laravel / Node backend for B2B supplier order taking, dealer management, field sales GPS tracking, and payment gateways.',120000.00,'Project',1,999,'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Platforms\", \"value\": \"Android (Google Play) & iOS (Apple App Store) + Admin Panel\"}, {\"key\": \"Development Timeline\", \"value\": \"4 to 6 Weeks Agile Sprints\"}]','• Technology: Flutter / React Native + RESTful API Backend\n• Features: Offline catalog browsing, barcode product scanning, WhatsApp invoice sharing\n• Integrated Razorpay / Cashfree B2B virtual account payment reconciliation\n• 100% Source Code Ownership & App Store / Play Store deployment included','Full source code repository access on GitHub / GitLab.','Sprint-wise deliverables with weekly review meetings.','4 Milestone-based installments (25% each)',1,1,0,1450,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(65,13,13,66,'Managed AWS / Azure High-Availability Cloud Server Infrastructure & 24/7 DevOps','managed-aws-azure-high-availability-cloud-server-infrastructure-247-devops-yYTJm','CloudLogic Cloud','CLD-INFRA-MGD','Architecting auto-scaling, load-balanced, and disaster-recovery compliant cloud infrastructure on AWS Mumbai / Microsoft Azure with Docker containers, CI/CD pipelines, automated daily backups, and 24/7 uptime monitoring.',45000.00,'Project',1,999,'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Uptime SLA\", \"value\": \"99.95% Guaranteed Availability\"}, {\"key\": \"Monitoring\", \"value\": \"Prometheus + Grafana + CloudWatch with SMS/Call alerts\"}]','• Architecture: Multi-AZ Auto Scaling EC2 / ECS Clusters with Application Load Balancer\n• Database: AWS Aurora MySQL / PostgreSQL with read-replicas & automated snapshots\n• Security: AWS WAF, Shield DDoS protection, SSL/TLS enforcement, and VPC isolation\n• CI/CD: Automated GitHub Actions continuous deployment pipeline','Infrastructure as Code (Terraform / CloudFormation) templates and documentation.','Setup completed within 5-7 business days.','50% Advance, 50% upon signoff',1,0,0,820,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `requirement_id` bigint unsigned NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `buyer_id` bigint unsigned NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `quantity` int NOT NULL,
  `moq` int NOT NULL DEFAULT '1',
  `delivery_time_days` int NOT NULL DEFAULT '7',
  `shipping_charges` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100% Advance / LC',
  `validity_date` date DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','accepted','rejected','negotiating','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotes_requirement_id_foreign` (`requirement_id`),
  KEY `quotes_supplier_id_foreign` (`supplier_id`),
  KEY `quotes_buyer_id_foreign` (`buyer_id`),
  KEY `quotes_status_index` (`status`),
  CONSTRAINT `quotes_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quotes_requirement_id_foreign` FOREIGN KEY (`requirement_id`) REFERENCES `requirements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quotes_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,1,2,1,10950.00,380,100,7,15000.00,'20% Advance, 80% against dispatch invoice','2026-09-08','We can supply 380 units of NovaTech 550W Bifacial Mono PERC modules immediately from our Bhiwandi warehouse with BIS & ALMM test certificates included.',NULL,'pending','2026-08-25 09:01:46','2026-08-25 09:01:46'),(2,2,5,1,58000.00,50,10,3,0.00,'100% RTGS against Proforma','2026-09-01','Special infrastructure rate: ₹58,000/MT inclusive of transportation to Hinjewadi, Pune. Full 12m lengths with original Mill Test Certificates (MTC).',NULL,'accepted','2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recently_viewed`
--

DROP TABLE IF EXISTS `recently_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recently_viewed` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recently_viewed_user_id_foreign` (`user_id`),
  KEY `recently_viewed_product_id_foreign` (`product_id`),
  KEY `recently_viewed_session_id_index` (`session_id`),
  CONSTRAINT `recently_viewed_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recently_viewed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recently_viewed`
--

LOCK TABLES `recently_viewed` WRITE;
/*!40000 ALTER TABLE `recently_viewed` DISABLE KEYS */;
/*!40000 ALTER TABLE `recently_viewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requirements`
--

DROP TABLE IF EXISTS `requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `quantity_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pieces',
  `target_price` decimal(12,2) DEFAULT NULL,
  `preferred_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required_by` date DEFAULT NULL,
  `payment_terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_requirements` text COLLATE utf8mb4_unicode_ci,
  `attachments` json DEFAULT NULL,
  `status` enum('open','quoted','fulfilled','closed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requirements_buyer_id_foreign` (`buyer_id`),
  KEY `requirements_category_id_foreign` (`category_id`),
  KEY `requirements_status_index` (`status`),
  CONSTRAINT `requirements_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `requirements_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requirements`
--

LOCK TABLES `requirements` WRITE;
/*!40000 ALTER TABLE `requirements` DISABLE KEYS */;
INSERT INTO `requirements` VALUES (1,1,2,'Urgent Requirement: 200kW Mono PERC 540W+ Solar PV Modules for Factory Rooftop','We require 380 units of Tier-1 certified 540W to 550W Mono PERC Solar Panels with minimum 21% efficiency and ALMM approval for our industrial plant in Navi Mumbai. Delivery required within 20 days.',380,'Pieces',11000.00,'Mumbai / Maharashtra / Gujarat','Turbhe MIDC, Navi Mumbai, Maharashtra','400705','2026-09-14','30% Advance, 70% on Site Delivery','Must include 12-year product warranty and BIS certification certificate.',NULL,'open','2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(2,1,4,'Bulk Purchase: 50 Metric Tons Primary Fe 550D TMT Rebars (12mm, 16mm, 20mm)','Looking for direct quotes from primary steel distributors/mills for 50 Metric Tons of Fe 550D TMT bars for our commercial infrastructure project in Pune. Immediate trailer delivery needed.',50,'Metric Tons',57500.00,'Pune / Mumbai / Western India','Hinjewadi Phase 2, Pune, Maharashtra','411057','2026-09-04','100% RTGS against weighbridge slip & MTC','Test certificates must match heat number stamped on rebars.',NULL,'quoted','2026-08-25 09:01:46','2026-08-25 09:01:46',NULL),(3,2,5,'Monthly Contract: 20,000 Custom Printed 5-Ply Corrugated Delivery Boxes','Seeking reliable packaging manufacturer for ongoing monthly requirement of 20,000 5-ply kraft corrugated boxes (Size: 18x12x10 inches) with 2-color brand logo printing for our retail distribution chain.',20000,'Pieces',30.00,'Delhi NCR / Haryana / Rajasthan / Gujarat','Kundli Industrial Area, Sonipat, Haryana','131028','2026-09-09','Net 30 Days Credit after initial 2 cycles','Must submit physical sample box for drop test approval before PO.',NULL,'open','2026-08-25 09:01:46','2026-08-25 09:01:46',NULL);
/*!40000 ALTER TABLE `requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `buyer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `quality_rating` tinyint unsigned NOT NULL DEFAULT '5',
  `communication_rating` tinyint unsigned NOT NULL DEFAULT '5',
  `delivery_rating` tinyint unsigned NOT NULL DEFAULT '5',
  `pricing_rating` tinyint unsigned NOT NULL DEFAULT '5',
  `service_rating` tinyint unsigned NOT NULL DEFAULT '5',
  `overall_rating` decimal(3,2) NOT NULL DEFAULT '5.00',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `supplier_reply` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_supplier_id_foreign` (`supplier_id`),
  KEY `reviews_buyer_id_foreign` (`buyer_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_overall_rating_index` (`overall_rating`),
  KEY `reviews_status_index` (`status`),
  CONSTRAINT `reviews_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reviews_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,1,1,5,5,5,5,5,5.00,'Top notch precision machinery & exceptional on-site support!','We procured 3 CNC Lathe units from Apex Industrial for our automotive components plant. The spindle accuracy and rigid bed construction are world-class. Arunachalam and his engineering team provided outstanding commissioning support.','Thank you Rajesh for your valued partnership and feedback! We look forward to supporting your upcoming plant expansions.','approved','2026-08-25 09:01:46','2026-08-25 09:01:46'),(2,2,1,NULL,5,5,4,5,5,4.80,'Excellent generation performance from 550W Bifacial modules','Our 150kW rooftop installation has been running for 6 months now and generating approx 8-10% higher than estimated PVsyst models. Highly recommended supplier for commercial solar projects.',NULL,'approved','2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_history`
--

DROP TABLE IF EXISTS `search_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `search_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `query` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `results_count` int NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `search_history_user_id_foreign` (`user_id`),
  KEY `search_history_query_index` (`query`),
  CONSTRAINT `search_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_history`
--

LOCK TABLES `search_history` WRITE;
/*!40000 ALTER TABLE `search_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_range` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `services_supplier_id_foreign` (`supplier_id`),
  KEY `services_category_id_foreign` (`category_id`),
  CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `services_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,1,'Custom CNC Precision Tooling & Turnkey Machine Retrofitting','custom-cnc-precision-tooling-retrofitting','Complete engineering design, CAD/CAM programming, machine retrofitting with CNC controls, and on-site commissioning services for heavy manufacturing plants.','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','₹50,000 - ₹5,00,000 / Project',1,'2026-08-25 09:01:46','2026-08-25 09:01:46'),(2,2,2,'Turnkey Commercial & Industrial MW Solar EPC Contracting','turnkey-commercial-industrial-solar-epc','End-to-end solar EPC contracting including site shadow analysis, net-metering approvals, structural mounting, electrical installation, and 25-year O&M maintenance.','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','₹32,000 - ₹38,000 / kW Installed',1,'2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subcategories_slug_unique` (`slug`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  KEY `subcategories_is_active_index` (`is_active`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'CNC Lathe Machines','cnc-lathe-machines','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','CNC Lathe Machines wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(2,1,'Hydraulic Pumps & Valves','hydraulic-pumps-valves','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Hydraulic Pumps & Valves wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(3,1,'Air Compressors','air-compressors','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Air Compressors wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(4,1,'Industrial Conveyors','industrial-conveyors','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Industrial Conveyors wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(5,1,'Plastic Molding Machines','plastic-molding-machines','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Plastic Molding Machines wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(6,1,'Water Treatment Plants','water-treatment-plants','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Water Treatment Plants wholesale supply and manufacturing options.',1,6,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(7,2,'Mono Perc Solar Panels','mono-perc-solar-panels','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','Mono Perc Solar Panels wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(8,2,'On-Grid Solar Inverters','on-grid-solar-inverters','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','On-Grid Solar Inverters wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(9,2,'Solar Tubular & Lithium Batteries','solar-tubular-lithium-batteries','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','Solar Tubular & Lithium Batteries wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(10,2,'Solar Water Heaters','solar-water-heaters','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','Solar Water Heaters wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(11,2,'Solar Street Lights','solar-street-lights','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80','Solar Street Lights wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(12,3,'Three-Phase Induction Motors','three-phase-induction-motors','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Three-Phase Induction Motors wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(13,3,'HT/LT Power Cables','htlt-power-cables','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','HT/LT Power Cables wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(14,3,'Industrial Proximity Sensors','industrial-proximity-sensors','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Industrial Proximity Sensors wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(15,3,'LT Switchgear & Panels','lt-switchgear-panels','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','LT Switchgear & Panels wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(16,3,'Digital Multimeters','digital-multimeters','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Digital Multimeters wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(17,4,'Fe 550D TMT Rebars','fe-550d-tmt-rebars','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Fe 550D TMT Rebars wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(18,4,'Structural Steel Beams','structural-steel-beams','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Structural Steel Beams wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(19,4,'OPC / PPC Cement 50kg','opc-ppc-cement-50kg','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','OPC / PPC Cement 50kg wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(20,4,'Tubular Scaffolding Systems','tubular-scaffolding-systems','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Tubular Scaffolding Systems wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(21,4,'Vitrified Floor Tiles','vitrified-floor-tiles','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Vitrified Floor Tiles wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(22,5,'3-Ply & 5-Ply Corrugated Boxes','3-ply-5-ply-corrugated-boxes','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','3-Ply & 5-Ply Corrugated Boxes wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(23,5,'LLDPE Stretch Wrap Films','lldpe-stretch-wrap-films','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','LLDPE Stretch Wrap Films wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(24,5,'Printed Stand-up Pouches','printed-stand-up-pouches','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Printed Stand-up Pouches wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(25,5,'Corrugated Shipping Rolls','corrugated-shipping-rolls','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Corrugated Shipping Rolls wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(26,5,'Rigid Plastic Drums','rigid-plastic-drums','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Rigid Plastic Drums wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(27,6,'Caustic Soda Flakes','caustic-soda-flakes','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80','Caustic Soda Flakes wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(28,6,'Industrial Solvents & IPA','industrial-solvents-ipa','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80','Industrial Solvents & IPA wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(29,6,'Polymer & PVC Resins','polymer-pvc-resins','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80','Polymer & PVC Resins wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(30,6,'Activated Carbon Granules','activated-carbon-granules','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80','Activated Carbon Granules wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(31,6,'Pigments & Color Dyes','pigments-color-dyes','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80','Pigments & Color Dyes wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(32,7,'ICU Multipara Patient Monitors','icu-multipara-patient-monitors','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','ICU Multipara Patient Monitors wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(33,7,'Motorized Hospital Beds','motorized-hospital-beds','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Motorized Hospital Beds wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(34,7,'Surgical Gloves & Disposables','surgical-gloves-disposables','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Surgical Gloves & Disposables wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(35,7,'Digital X-Ray Machines','digital-x-ray-machines','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Digital X-Ray Machines wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(36,7,'Oxygen Concentrators 10L','oxygen-concentrators-10l','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Oxygen Concentrators 10L wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(37,8,'100% Combed Cotton Yarn','100-combed-cotton-yarn','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','100% Combed Cotton Yarn wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(38,8,'Industrial Boiler Suits & Workwear','industrial-boiler-suits-workwear','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Industrial Boiler Suits & Workwear wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(39,8,'Denim & Twill Fabrics','denim-twill-fabrics','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Denim & Twill Fabrics wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(40,8,'Non-Woven Fabric Rolls','non-woven-fabric-rolls','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Non-Woven Fabric Rolls wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(41,8,'Polyester Sewing Thread','polyester-sewing-thread','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Polyester Sewing Thread wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(42,9,'Premium Basmati Rice','premium-basmati-rice','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Premium Basmati Rice wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(43,9,'Organic Turmeric & Chili Powder','organic-turmeric-chili-powder','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Organic Turmeric & Chili Powder wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(44,9,'Drip Irrigation Pipe Lines','drip-irrigation-pipe-lines','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Drip Irrigation Pipe Lines wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(45,9,'Cold Pressed Mustard Oil','cold-pressed-mustard-oil','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Cold Pressed Mustard Oil wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(46,9,'NPK Water Soluble Fertilizers','npk-water-soluble-fertilizers','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','NPK Water Soluble Fertilizers wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(47,10,'Heavy Duty Ceramic Brake Pads','heavy-duty-ceramic-brake-pads','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80','Heavy Duty Ceramic Brake Pads wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(48,10,'Automotive Oil & Air Filters','automotive-oil-air-filters','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80','Automotive Oil & Air Filters wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(49,10,'EV Fast DC Charging Stations','ev-fast-dc-charging-stations','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80','EV Fast DC Charging Stations wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(50,10,'Commercial Vehicle Leaf Springs','commercial-vehicle-leaf-springs','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80','Commercial Vehicle Leaf Springs wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(51,10,'Lithium EV Battery Packs','lithium-ev-battery-packs','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80','Lithium EV Battery Packs wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(52,11,'High-Back Ergonomic Mesh Chairs','high-back-ergonomic-mesh-chairs','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','High-Back Ergonomic Mesh Chairs wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(53,11,'Modular 4-Person Office Workstations','modular-4-person-office-workstations','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Modular 4-Person Office Workstations wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(54,11,'Heavy Duty Pallet Storage Racks','heavy-duty-pallet-storage-racks','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Heavy Duty Pallet Storage Racks wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(55,11,'Fireproof Steel Filing Cabinets','fireproof-steel-filing-cabinets','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Fireproof Steel Filing Cabinets wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(56,11,'Executive Leather Office Sofas','executive-leather-office-sofas','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Executive Leather Office Sofas wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(57,12,'4K Ultra HD IP CCTV Cameras','4k-ultra-hd-ip-cctv-cameras','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','4K Ultra HD IP CCTV Cameras wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(58,12,'Biometric Face & Fingerprint Terminals','biometric-face-fingerprint-terminals','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','Biometric Face & Fingerprint Terminals wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(59,12,'Automatic CO2 Fire Suppression Systems','automatic-co2-fire-suppression-systems','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','Automatic CO2 Fire Suppression Systems wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(60,12,'High-Visibility Safety Helmets & Vests','high-visibility-safety-helmets-vests','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','High-Visibility Safety Helmets & Vests wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(61,12,'Addressable Fire Alarm Control Panels','addressable-fire-alarm-control-panels','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','Addressable Fire Alarm Control Panels wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(62,13,'Cloud Manufacturing ERP Software','cloud-manufacturing-erp-software','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Cloud Manufacturing ERP Software wholesale supply and manufacturing options.',1,1,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(63,13,'Industrial IoT Gateway & SCADA','industrial-iot-gateway-scada','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Industrial IoT Gateway & SCADA wholesale supply and manufacturing options.',1,2,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(64,13,'Cybersecurity Audit & Compliance','cybersecurity-audit-compliance','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Cybersecurity Audit & Compliance wholesale supply and manufacturing options.',1,3,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(65,13,'Custom Mobile & Web Apps','custom-mobile-web-apps','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Custom Mobile & Web Apps wholesale supply and manufacturing options.',1,4,'2026-08-25 09:01:42','2026-08-25 09:01:42'),(66,13,'Managed Cloud Infrastructure Hosting','managed-cloud-infrastructure-hosting','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Managed Cloud Infrastructure Hosting wholesale supply and manufacturing options.',1,5,'2026-08-25 09:01:42','2026-08-25 09:01:42');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_payments`
--

DROP TABLE IF EXISTS `subscription_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Razorpay',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('success','failed','pending','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'success',
  `gateway_response` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscription_payments_supplier_id_foreign` (`supplier_id`),
  KEY `subscription_payments_plan_id_foreign` (`plan_id`),
  CONSTRAINT `subscription_payments_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscription_payments_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_payments`
--

LOCK TABLES `subscription_payments` WRITE;
/*!40000 ALTER TABLE `subscription_payments` DISABLE KEYS */;
INSERT INTO `subscription_payments` VALUES (1,1,3,14999.00,'Razorpay Live','pay_razor_HIjrAUa6pQ','success','{\"status\": \"captured\"}','2026-08-25 09:01:42','2026-08-25 09:01:42'),(2,2,3,14999.00,'Razorpay Live','pay_razor_Kkrzeh4D5j','success','{\"status\": \"captured\"}','2026-08-25 09:01:43','2026-08-25 09:01:43'),(3,3,3,14999.00,'Razorpay Live','pay_razor_ChDRsHybgp','success','{\"status\": \"captured\"}','2026-08-25 09:01:43','2026-08-25 09:01:43'),(4,4,3,14999.00,'Razorpay Live','pay_razor_f0aSk30Fkq','success','{\"status\": \"captured\"}','2026-08-25 09:01:43','2026-08-25 09:01:43'),(5,5,3,14999.00,'Razorpay Live','pay_razor_yotkdQg96T','success','{\"status\": \"captured\"}','2026-08-25 09:01:43','2026-08-25 09:01:43'),(6,6,3,14999.00,'Razorpay Live','pay_razor_NrajkKf1kS','success','{\"status\": \"captured\"}','2026-08-25 09:01:43','2026-08-25 09:01:43'),(7,7,3,14999.00,'Razorpay Live','pay_razor_WgQM8cc81f','success','{\"status\": \"captured\"}','2026-08-25 09:01:44','2026-08-25 09:01:44'),(8,8,3,14999.00,'Razorpay Live','pay_razor_KDOOJsZq5V','success','{\"status\": \"captured\"}','2026-08-25 09:01:44','2026-08-25 09:01:44'),(9,9,3,14999.00,'Razorpay Live','pay_razor_40XJ0upEK9','success','{\"status\": \"captured\"}','2026-08-25 09:01:44','2026-08-25 09:01:44'),(10,10,3,14999.00,'Razorpay Live','pay_razor_mzgCkiR9SI','success','{\"status\": \"captured\"}','2026-08-25 09:01:44','2026-08-25 09:01:44'),(11,11,3,14999.00,'Razorpay Live','pay_razor_RuGddNCxEd','success','{\"status\": \"captured\"}','2026-08-25 09:01:45','2026-08-25 09:01:45'),(12,12,3,14999.00,'Razorpay Live','pay_razor_BYokFixpQd','success','{\"status\": \"captured\"}','2026-08-25 09:01:45','2026-08-25 09:01:45'),(13,13,3,14999.00,'Razorpay Live','pay_razor_lFq3zLlixM','success','{\"status\": \"captured\"}','2026-08-25 09:01:45','2026-08-25 09:01:45'),(14,14,3,14999.00,'Razorpay Live','pay_razor_J7Ep810lcH','success','{\"status\": \"captured\"}','2026-08-25 09:01:45','2026-08-25 09:01:45'),(15,15,3,14999.00,'Razorpay Live','pay_razor_2iQ08qwsnM','success','{\"status\": \"captured\"}','2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `subscription_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `billing_cycle` enum('monthly','yearly','lifetime') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yearly',
  `product_limit` int NOT NULL DEFAULT '5',
  `inquiry_limit` int NOT NULL DEFAULT '10',
  `has_verified_badge` tinyint(1) NOT NULL DEFAULT '0',
  `has_priority_listing` tinyint(1) NOT NULL DEFAULT '0',
  `has_rfq_access` tinyint(1) NOT NULL DEFAULT '0',
  `has_analytics` tinyint(1) NOT NULL DEFAULT '0',
  `features` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_plans_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_plans`
--

LOCK TABLES `subscription_plans` WRITE;
/*!40000 ALTER TABLE `subscription_plans` DISABLE KEYS */;
INSERT INTO `subscription_plans` VALUES (1,'Free Starter','free-starter',0.00,'yearly',5,15,0,0,0,0,'[\"List up to 5 Products\", \"15 Monthly Inquiries\", \"Basic Company Profile\", \"Standard Search Listing\"]',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(2,'Business Pro','business-pro',4999.00,'yearly',50,150,1,1,1,1,'[\"List up to 50 Products\", \"150 Monthly Inquiries\", \"GST & Trust Verified Badge\", \"Priority Search Placement\", \"Full Buy Requirement (RFQ) Access\", \"Analytics & Profile View Insights\"]',1,'2026-08-25 09:01:41','2026-08-25 09:01:41'),(3,'Enterprise Elite','enterprise-elite',14999.00,'yearly',500,1000,1,1,1,1,'[\"Unlimited Products Listing\", \"Unlimited Inquiries & Lead Access\", \"Gold Premium Verified Badge\", \"Top #1 Search Ranking & Homepage Feature\", \"Instant RFQ Lead Notifications via SMS/Email\", \"Dedicated Account Manager & 24/7 Support\"]',1,'2026-08-25 09:01:41','2026-08-25 09:01:41');
/*!40000 ALTER TABLE `subscription_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `starts_at` timestamp NOT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired','cancelled','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_supplier_id_foreign` (`supplier_id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`),
  CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,1,3,'2026-06-25 09:01:42','2027-06-25 09:01:42','active','pay_razor_hD2VslyF4c','2026-08-25 09:01:42','2026-08-25 09:01:42'),(2,2,3,'2026-06-25 09:01:43','2027-06-25 09:01:43','active','pay_razor_KarCas5SjP','2026-08-25 09:01:43','2026-08-25 09:01:43'),(3,3,3,'2026-06-25 09:01:43','2027-06-25 09:01:43','active','pay_razor_whXuEnOLXY','2026-08-25 09:01:43','2026-08-25 09:01:43'),(4,4,3,'2026-06-25 09:01:43','2027-06-25 09:01:43','active','pay_razor_ZBhBl5xXhN','2026-08-25 09:01:43','2026-08-25 09:01:43'),(5,5,3,'2026-06-25 09:01:43','2027-06-25 09:01:43','active','pay_razor_7y7pfjKcn6','2026-08-25 09:01:43','2026-08-25 09:01:43'),(6,6,3,'2026-06-25 09:01:43','2027-06-25 09:01:43','active','pay_razor_LhZShuFNj2','2026-08-25 09:01:43','2026-08-25 09:01:43'),(7,7,3,'2026-06-25 09:01:44','2027-06-25 09:01:44','active','pay_razor_GZyFqzrsJm','2026-08-25 09:01:44','2026-08-25 09:01:44'),(8,8,3,'2026-06-25 09:01:44','2027-06-25 09:01:44','active','pay_razor_Cp4XR4TacF','2026-08-25 09:01:44','2026-08-25 09:01:44'),(9,9,3,'2026-06-25 09:01:44','2027-06-25 09:01:44','active','pay_razor_yZ8ksu7mQK','2026-08-25 09:01:44','2026-08-25 09:01:44'),(10,10,3,'2026-06-25 09:01:44','2027-06-25 09:01:44','active','pay_razor_naosrOwVqR','2026-08-25 09:01:44','2026-08-25 09:01:44'),(11,11,3,'2026-06-25 09:01:45','2027-06-25 09:01:45','active','pay_razor_NOP3ILSnx7','2026-08-25 09:01:45','2026-08-25 09:01:45'),(12,12,3,'2026-06-25 09:01:45','2027-06-25 09:01:45','active','pay_razor_UzC8vQyz4v','2026-08-25 09:01:45','2026-08-25 09:01:45'),(13,13,3,'2026-06-25 09:01:45','2027-06-25 09:01:45','active','pay_razor_AxLvewvZLF','2026-08-25 09:01:45','2026-08-25 09:01:45'),(14,14,3,'2026-06-25 09:01:45','2027-06-25 09:01:45','active','pay_razor_MbbyZbDJPp','2026-08-25 09:01:45','2026-08-25 09:01:45'),(15,15,3,'2026-06-25 09:01:46','2027-06-25 09:01:46','active','pay_razor_gcGXbiDYro','2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_documents`
--

DROP TABLE IF EXISTS `supplier_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `doc_type` enum('GST_Certificate','PAN_Card','Business_License','ISO_Certificate','MSME_Udyam','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_documents_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `supplier_documents_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_documents`
--

LOCK TABLES `supplier_documents` WRITE;
/*!40000 ALTER TABLE `supplier_documents` DISABLE KEYS */;
INSERT INTO `supplier_documents` VALUES (1,1,'GST_Certificate','33AAACA1122D1Z9','documents/verified_gst_1.pdf','approved',NULL,'2026-08-25 09:01:42','2026-08-25 09:01:42','2026-08-25 09:01:42'),(2,2,'GST_Certificate','29AAACN8877K1Z4','documents/verified_gst_2.pdf','approved',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43','2026-08-25 09:01:43'),(3,3,'GST_Certificate','24AAACB3344J1Z1','documents/verified_gst_3.pdf','approved',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43','2026-08-25 09:01:43'),(4,4,'GST_Certificate','36AAACD9900L1Z7','documents/verified_gst_4.pdf','approved',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43','2026-08-25 09:01:43'),(5,5,'GST_Certificate','27AAACV7766M1Z3','documents/verified_gst_5.pdf','approved',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43','2026-08-25 09:01:43'),(6,6,'GST_Certificate','24AAACR1144F1Z9','documents/verified_gst_6.pdf','approved',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43','2026-08-25 09:01:43'),(7,7,'GST_Certificate','07AAACE5544B1Z5','documents/verified_gst_7.pdf','approved',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44','2026-08-25 09:01:44'),(8,8,'GST_Certificate','03AAACK8899P1Z2','documents/verified_gst_8.pdf','approved',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44','2026-08-25 09:01:44'),(9,9,'GST_Certificate','33AAACA7788R1Z1','documents/verified_gst_9.pdf','approved',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44','2026-08-25 09:01:44'),(10,10,'GST_Certificate','36AAACM4433E1Z4','documents/verified_gst_10.pdf','approved',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44','2026-08-25 09:01:44'),(11,11,'GST_Certificate','19AAACU9988G1Z7','documents/verified_gst_11.pdf','approved',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45','2026-08-25 09:01:45'),(12,12,'GST_Certificate','09AAACS3322H1Z6','documents/verified_gst_12.pdf','approved',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45','2026-08-25 09:01:45'),(13,13,'GST_Certificate','06AAACC1199K1Z8','documents/verified_gst_13.pdf','approved',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45','2026-08-25 09:01:45'),(14,14,'GST_Certificate','08AAACR8822J1Z0','documents/verified_gst_14.pdf','approved',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45','2026-08-25 09:01:45'),(15,15,'GST_Certificate','24AAACS9911N1Z3','documents/verified_gst_15.pdf','approved',NULL,'2026-08-25 09:01:46','2026-08-25 09:01:46','2026-08-25 09:01:46');
/*!40000 ALTER TABLE `supplier_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `subscription_plan_id` bigint unsigned DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_type` enum('Manufacturer','Wholesaler','Distributor','Trader','Service Provider','Exporter') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manufacturer',
  `year_established` year DEFAULT NULL,
  `employees_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'India',
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_level` enum('None','Mobile','Email','Business','GST','KYC','Premium') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `rating_avg` decimal(3,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int unsigned NOT NULL DEFAULT '0',
  `views_count` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('pending','active','suspended','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_slug_unique` (`slug`),
  KEY `suppliers_user_id_foreign` (`user_id`),
  KEY `suppliers_subscription_plan_id_foreign` (`subscription_plan_id`),
  KEY `suppliers_gst_number_index` (`gst_number`),
  KEY `suppliers_city_index` (`city`),
  KEY `suppliers_state_index` (`state`),
  KEY `suppliers_pincode_index` (`pincode`),
  KEY `suppliers_is_verified_index` (`is_verified`),
  KEY `suppliers_is_featured_index` (`is_featured`),
  CONSTRAINT `suppliers_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,6,3,'Apex Industrial Machineries Pvt Ltd','apex-industrial-machineries','Manufacturer',2006,'51-100 People','33AAACA1122D1Z9','AAACA1122D','SF No 142/2, Peelamedu Industrial Estate, Avinashi Road','Coimbatore','Tamil Nadu','India','641006','https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&auto=format&fit=crop&q=80','Apex Industrial Machineries is a premier manufacturer and exporter of heavy-duty CNC lathe machines, industrial hydraulic pumps, and automated conveyor systems with ISO 9001:2015 certification.','https://www.apex-industrial-machineries.example.com',1,'Premium',4.90,38,1420,1,'active','2026-08-25 09:01:42','2026-08-25 09:01:42',NULL),(2,7,3,'NovaTech Solar & Green Energy Ltd','novatech-solar-energy','Manufacturer',2012,'101-250 People','29AAACN8877K1Z4','AAACN8877K','Plot 88, Electronic City Phase 1, Hosur Road','Bengaluru','Karnataka','India','560100','https://images.unsplash.com/photo-1572021335469-31706a17aaef?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=1200&auto=format&fit=crop&q=80','NovaTech Solar is a Tier-1 certified manufacturer of high-efficiency Mono PERC Solar Panels, Hybrid Inverters, and Smart Lithium-Ion Energy Storage systems for commercial, industrial, and utility projects.','https://www.novatech-solar-energy.example.com',1,'Premium',4.85,45,2190,1,'active','2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(3,8,3,'Bharat Polymer & Packaging Solutions','bharat-polymer-packaging','Manufacturer',2010,'25-50 People','24AAACB3344J1Z1','AAACB3344J','Phase IV, GIDC Vatva Industrial Area','Ahmedabad','Gujarat','India','382445','https://images.unsplash.com/photo-1557804506-669a67965ba0?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=1200&auto=format&fit=crop&q=80','Bharat Polymer is a leader in heavy duty 5-ply corrugated shipping boxes, automated LLDPE stretch wrap films, and tamper-proof printed multilayer pouches, serving Fortune 500 FMCG and logistics companies.','https://www.bharat-polymer-packaging.example.com',1,'GST',4.70,24,980,1,'active','2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(4,9,3,'Delta Chemicals & Pharma Ingredients','delta-chemicals-pharma','Manufacturer',2015,'51-100 People','36AAACD9900L1Z7','AAACD9900L','Plot 15, IDA Kukatpally, Near Balanagar','Hyderabad','Telangana','India','500072','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=1200&auto=format&fit=crop&q=80','Delta Chemicals manufactures high-purity industrial solvents, Caustic Soda flakes 99%, active pharmaceutical intermediaries, and activated carbon filters with GLP and GMP compliant laboratories.','https://www.delta-chemicals-pharma.example.com',1,'KYC',4.90,19,870,1,'active','2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(5,10,3,'Vanguard Steel & Structural Infrastructure','vanguard-steel-infra','Distributor',2002,'101-250 People','27AAACV7766M1Z3','AAACV7766M','MIDC Bhosari Industrial Area, Telco Road','Pune','Maharashtra','India','411018','https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&auto=format&fit=crop&q=80','Authorized prime distributors of primary Fe 550D TMT bars, heavy structural beams, MS plates, and Cuplock scaffolding systems for highway bridges, high-rises, and industrial sheds.','https://www.vanguard-steel-infra.example.com',1,'Premium',4.80,31,1650,1,'active','2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(6,11,3,'Royal Surat Weaves & Technical Textiles','royal-surat-weaves','Manufacturer',2011,'51-100 People','24AAACR1144F1Z9','AAACR1144F','Surat Special Economic Zone (SurSEZ), Sachin','Surat','Gujarat','India','395006','https://images.unsplash.com/photo-1508873696983-2df57046475a?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=1200&auto=format&fit=crop&q=80','Royal Surat Weaves specializes in ISO-certified flame-retardant industrial uniform fabrics, combed cotton yarn, non-woven rolls, and high tensile industrial workwear fabrics.','https://www.royal-surat-weaves.example.com',1,'Business',4.75,22,790,1,'active','2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(7,12,3,'ElectroMatrix India Systems Pvt Ltd','electromatrix-india','Manufacturer',2008,'100-250 People','07AAACE5544B1Z5','AAACE5544B','Naraina Industrial Area Phase 1','Delhi','Delhi','India','110028','https://images.unsplash.com/photo-1518770660439-4636190af475?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1555664424-778a1e5e1b48?w=1200&auto=format&fit=crop&q=80','Premier Indian manufacturer of three-phase heavy duty induction motors, HT/LT power cables, digital multimeters, and high voltage switchgear panels.','https://www.electromatrix-india.example.com',1,'Premium',4.88,29,1340,1,'active','2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(8,13,3,'KisanAgro Commodities & Spices Hub','kisanagro-commodities','Exporter',2005,'50-100 People','03AAACK8899P1Z2','AAACK8899P','Focal Point Phase 5, Industrial Area','Ludhiana','Punjab','India','141003','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=1200&auto=format&fit=crop&q=80','Direct agricultural processing unit and spice exporters supplying Premium Basmati Rice, Salem Turmeric, precision drip irrigation tubes, and organic cold-pressed edible oils.','https://www.kisanagro-commodities.example.com',1,'Premium',4.92,41,1890,1,'active','2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(9,14,3,'AutoDrive Engineering & EV Components','autodrive-ev-components','Manufacturer',2014,'100-250 People','33AAACA7788R1Z1','AAACA7788R','Ambattur Industrial Estate, 3rd Main Road','Chennai','Tamil Nadu','India','600058','https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=1200&auto=format&fit=crop&q=80','OEM tier-1 supplier of heavy vehicle ceramic brake pads, EV DC fast charging units, automotive filters, and commercial leaf springs for commercial and electric vehicles.','https://www.autodrive-ev-components.example.com',1,'Premium',4.86,34,1560,1,'active','2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(10,15,3,'MedLife Diagnostics & Hospital Systems','medlife-hospital-systems','Manufacturer',2013,'50-100 People','36AAACM4433E1Z4','AAACM4433E','Road No. 12, Banjara Hills Industrial Cluster','Hyderabad','Telangana','India','500034','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1200&auto=format&fit=crop&q=80','ISO 13485 certified medical device manufacturer specializing in ICU multipara patient monitors, electric motorized hospital beds, digital X-Ray systems, and nitrile surgical gloves.','https://www.medlife-hospital-systems.example.com',1,'Premium',4.95,48,2300,1,'active','2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(11,16,3,'UrbanWork Ergonomic Commercial Furniture','urbanwork-furniture','Manufacturer',2009,'50-100 People','19AAACU9988G1Z7','AAACU9988G','Sector V, Salt Lake Industrial Hub','Kolkata','West Bengal','India','700091','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=1200&auto=format&fit=crop&q=80','Designers and manufacturers of ergonomic high-back mesh office chairs, modular multi-person workstations, heavy warehouse pallet storage racks, and fireproof filing cabinets.','https://www.urbanwork-furniture.example.com',1,'Business',4.78,26,1120,1,'active','2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(12,17,3,'SecureTech Industrial Surveillance & Fire Systems','securetech-safety-systems','Distributor',2011,'50-100 People','09AAACS3322H1Z6','AAACS3322H','Sector 63, Electronic City & Industrial Zone','Noida','Uttar Pradesh','India','201305','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=1200&auto=format&fit=crop&q=80','Industrial security integrator supplying 4K IP CCTV cameras, AI facial recognition attendance biometric devices, clean agent fire suppression systems, and industrial PPE gear.','https://www.securetech-safety-systems.example.com',1,'Premium',4.89,37,1780,1,'active','2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(13,18,3,'CloudLogic Enterprise & Industrial IoT Solutions','cloudlogic-solutions','Service Provider',2016,'25-50 People','06AAACC1199K1Z8','AAACC1199K','Cyber City Phase 2, DLF Industrial Area','Gurugram','Haryana','India','122002','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&auto=format&fit=crop&q=80','Custom B2B software engineering enterprise providing cloud manufacturing ERP, SCADA IoT industrial monitoring, ISO 27001 cybersecurity audits, and scalable web/mobile portals.','https://www.cloudlogic-solutions.example.com',1,'Premium',4.94,33,1490,1,'active','2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(14,19,3,'Rajputana Industrial Machineries & Foundry','rajputana-machineries','Manufacturer',2007,'50-100 People','08AAACR8822J1Z0','AAACR8822J','VKIA Industrial Area Road No. 9','Jaipur','Rajasthan','India','302013','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1200&auto=format&fit=crop&q=80','Manufacturers of plastic injection molding machinery, industrial belt conveyors, water effluent treatment plants, and heavy cast iron engineering assemblies.','https://www.rajputana-machineries.example.com',1,'Business',4.82,21,930,1,'active','2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(15,20,3,'Saurashtra Precision Forgings & Pumps','saurashtra-precision-pumps','Manufacturer',2004,'100-250 People','24AAACS9911N1Z3','AAACS9911N','Aji GIDC Industrial Estate Phase 2','Rajkot','Gujarat','India','360002','https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=1200&auto=format&fit=crop&q=80','Specialized in high-pressure variable displacement hydraulic piston pumps, heavy directional control valves, and precision agricultural/industrial fluid transmission systems.','https://www.saurashtra-precision-pumps.example.com',1,'Premium',4.87,36,1620,1,'active','2026-08-25 09:01:46','2026-08-25 09:01:46',NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
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
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','supplier','buyer','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buyer',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','banned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`),
  KEY `users_role_index` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ozura Administrator','admin@ozura.com','+91 98765 43210','admin',NULL,'active','2026-08-25 09:01:41','2026-08-25 09:01:41','$2y$12$2idOv4HJM24lPiob8CH9eeqm5Jm3FU4UAlxQKGj9R8hYzAmsmCuqW',NULL,'2026-08-25 09:01:41','2026-08-25 09:01:41',NULL),(2,'Pooja Verma (Moderator)','staff@ozura.com','+91 98765 43211','staff',NULL,'active','2026-08-25 09:01:41','2026-08-25 09:01:41','$2y$12$E.EJCMJhyiHcU/LuorAhXeoG7MpzFuH8vihlBiaQTbRU.qPUtcXkO',NULL,'2026-08-25 09:01:41','2026-08-25 09:01:41',NULL),(3,'Rajesh Kumar','buyer@ozura.com','+91 98201 12345','buyer',NULL,'active','2026-08-25 09:01:41','2026-08-25 09:01:41','$2y$12$YPFRhM2qVZUJjpdaTjpQ2uvUng0NO9NVjItw4T.9q7b0QhCVb.z1S',NULL,'2026-08-25 09:01:41','2026-08-25 09:01:41',NULL),(4,'Ananya Sharma','buyer2@ozura.com','+91 98111 23456','buyer',NULL,'active','2026-08-25 09:01:42','2026-08-25 09:01:42','$2y$12$pzE5kjBUAk1ya4UHy7p1v.KR4gu1Gfh0lzPhIYSUYKsDuglr/QOg2',NULL,'2026-08-25 09:01:42','2026-08-25 09:01:42',NULL),(5,'Vikram Patel','buyer3@ozura.com','+91 98250 98765','buyer',NULL,'active','2026-08-25 09:01:42','2026-08-25 09:01:42','$2y$12$stuqwkezY/ZSptQgVX5EGuiSaIqWBCw2v6g1eRIXwe16VKNuWzvKS',NULL,'2026-08-25 09:01:42','2026-08-25 09:01:42',NULL),(6,'Arunachalam Murthy','supplier@ozura.com','+91 94432 10987','supplier',NULL,'active','2026-08-25 09:01:42','2026-08-25 09:01:42','$2y$12$zM6e5WAHJYms1S3jO9tk..FOZhkAfV3taQ09/eTtEeqopeob/BPAK',NULL,'2026-08-25 09:01:42','2026-08-25 09:01:42',NULL),(7,'Sunil Joshi','supplier2@ozura.com','+91 98450 76543','supplier',NULL,'active','2026-08-25 09:01:43','2026-08-25 09:01:43','$2y$12$YwkgZcn9FIjNypVeXff3quxR2NEFqNe70.mKPvdOlFsKLBStGyZDK',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(8,'Hiren Shah','supplier3@ozura.com','+91 98980 43210','supplier',NULL,'active','2026-08-25 09:01:43','2026-08-25 09:01:43','$2y$12$0H6UdeiqH7BHHX.gSfKaSeD7NH8H1vMsuvuhsbZFrdHcZZGmd/CTK',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(9,'Dr. K. Srinivas Rao','supplier4@ozura.com','+91 98490 11223','supplier',NULL,'active','2026-08-25 09:01:43','2026-08-25 09:01:43','$2y$12$k6DWQXabX4duuIF9ho7Ck.IUyIXpHMbzuLVyCM5t70Xi5dTxk2t5K',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(10,'Mahesh Gaikwad','supplier5@ozura.com','+91 98220 54321','supplier',NULL,'active','2026-08-25 09:01:43','2026-08-25 09:01:43','$2y$12$55xo29.VyKoHJ995H7FvLeYPYwOo.WGeeQGrOerQ04i5dGLSP27G6',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(11,'Chetan Kulkarni','supplier6@ozura.com','+91 98260 88776','supplier',NULL,'active','2026-08-25 09:01:43','2026-08-25 09:01:43','$2y$12$lucK7lUUXNDfcCFWG9V7NuJxj1CzffSsXCYYSTE6jL7S.jxpOUUs2',NULL,'2026-08-25 09:01:43','2026-08-25 09:01:43',NULL),(12,'Karan Singhal','supplier7@ozura.com','+91 98100 44556','supplier',NULL,'active','2026-08-25 09:01:44','2026-08-25 09:01:44','$2y$12$FiAKkrGqeKw6vz.C5NikqeN9lPYvgbIpo.7q5oXfpBvLXVv.qLC6S',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(13,'Sanjeev Bansal','supplier8@ozura.com','+91 98160 33221','supplier',NULL,'active','2026-08-25 09:01:44','2026-08-25 09:01:44','$2y$12$ujeqgc03E0huyYiMO0dZsuetcC76hf/x7E4YA955G1H2UuOwcb4t.',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(14,'Vivek Radhakrishnan','supplier9@ozura.com','+91 94440 99887','supplier',NULL,'active','2026-08-25 09:01:44','2026-08-25 09:01:44','$2y$12$uoPQ80fthmASqFGxTCbuF.qKcg5brJlrBTanKMs0sSM/pU9rn5PA6',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(15,'Ramanathan Iyer','supplier10@ozura.com','+91 98480 55443','supplier',NULL,'active','2026-08-25 09:01:44','2026-08-25 09:01:44','$2y$12$.iPlr/5ABAFiysNihZwnPeAfnNaoa4mftS.rjgRdo/F80j6sRlD5i',NULL,'2026-08-25 09:01:44','2026-08-25 09:01:44',NULL),(16,'Amitabh Sen','supplier11@ozura.com','+91 98300 77889','supplier',NULL,'active','2026-08-25 09:01:45','2026-08-25 09:01:45','$2y$12$Bu5zpQtyYrS5R.0ucoc7OeQ6PCGqfKR8870sWYhNLoY6H.OiukXQS',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(17,'Naveen Aggarwal','supplier12@ozura.com','+91 98180 66778','supplier',NULL,'active','2026-08-25 09:01:45','2026-08-25 09:01:45','$2y$12$FF67YoGNNSmWICfNmKa8V.P.311M1u7E5LzTajdkNiDBxZi0DeLue',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(18,'Rohit Saxena','supplier13@ozura.com','+91 98101 22334','supplier',NULL,'active','2026-08-25 09:01:45','2026-08-25 09:01:45','$2y$12$aTN1ZaRrqZ5NfrW67EEive0eJS9j3WkGNvrBw1p9eQqxcpXqh42Im',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(19,'Praveen Rathore','supplier14@ozura.com','+91 98290 55667','supplier',NULL,'active','2026-08-25 09:01:45','2026-08-25 09:01:45','$2y$12$QAoFETIlrHd2oR5TkrZY0.RivMXqRHl.sknaEgIxTI0NbT/vX//M6',NULL,'2026-08-25 09:01:45','2026-08-25 09:01:45',NULL),(20,'Dharmesh Makwana','supplier15@ozura.com','+91 98240 12389','supplier',NULL,'active','2026-08-25 09:01:46','2026-08-25 09:01:46','$2y$12$0QGVMKOnXqIrvqfbefJ54OrwZ2gVkyBNMbamLOwcAbvS.BtaRj/yC',NULL,'2026-08-25 09:01:46','2026-08-25 09:01:46',NULL);
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

-- Dump completed on 2026-08-25 20:02:33
