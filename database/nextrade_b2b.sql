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
INSERT INTO `advertisements` VALUES (1,1,'Mega Industrial Tech Expo 2026 - Up to 15% Off CNC Machines','hero_slider','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1600&auto=format&fit=crop&q=80','/suppliers/apex-industrial-machineries','2026-08-20 07:10:30','2026-09-19 07:10:30',1,0,0,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(2,2,'Switch Your Factory to Solar - Zero Capital Expenditure Models','hero_slider','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=1600&auto=format&fit=crop&q=80','/suppliers/novatech-solar-energy','2026-08-23 07:10:30','2026-09-24 07:10:30',1,0,0,'2026-08-25 07:10:30','2026-08-25 07:10:30');
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
INSERT INTO `buyers` VALUES (1,3,'Apex Infra Projects Pvt Ltd','Infrastructure Contractor','27AAACA9876Q1Z2','Mumbai','Maharashtra','India','400051','Plot 42, Bandra Kurla Complex, Bandra East','2026-08-25 07:10:28','2026-08-25 07:10:28',NULL),(2,4,'Zenith Retail & Supermarkets','Retail Chain / Wholesaler','07AAACZ1234F1Z8','Delhi','Delhi','India','110020','Okhla Industrial Area Phase 3','2026-08-25 07:10:28','2026-08-25 07:10:28',NULL),(3,5,'Sunrise Agro Exporters Ltd','Exporters & Food Processing','24AAACS5432M1ZQ','Ahmedabad','Gujarat','India','380015','SG Highway, Bodakdev','2026-08-25 07:10:29','2026-08-25 07:10:29',NULL);
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
INSERT INTO `categories` VALUES (1,'Industrial Machinery','industrial-machinery','cog','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Heavy industrial machinery, CNC tooling, hydraulic systems, processing plants, and packaging machines.','Industrial Machinery Manufacturers & Suppliers','Find verified industrial machinery suppliers, CNC machines, lathe tools, and hydraulic equipment.','industrial machinery, suppliers, manufacturers, wholesale',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(2,'Solar & Renewable Energy','solar-products','sun','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','Solar panels, inverters, solar power plants, lithium batteries, and green energy solutions.','Solar Panel & Inverter Suppliers in India','Connect with top solar panel manufacturers, on-grid inverters, and solar battery distributors.','solar & renewable energy, suppliers, manufacturers, wholesale',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(3,'Electronics & Electrical','electronics-electrical','zap','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Electronic components, industrial sensors, switchgear, electric motors, and copper wiring.','Electrical Equipment & Industrial Electronic Components','Wholesale electrical cables, induction motors, switchgear, and semiconductor components.','electronics & electrical, suppliers, manufacturers, wholesale',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(4,'Construction Materials','construction-materials','building','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','TMT rebar steel, cement, precast blocks, scaffolding, and architectural hardware.','Construction Materials & Structural Steel Suppliers','Bulk supply of TMT bars, structural steel beams, ready-mix concrete, and scaffolding.','construction materials, suppliers, manufacturers, wholesale',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(5,'Packaging Materials','packaging-materials','package','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Corrugated carton boxes, stretch wrap films, BOPP tape, glass & PET bottles, and pouches.','Packaging Materials & Corrugated Boxes Wholesale','Wholesale corrugated boxes, packaging rolls, airtight pouches, and protective packaging.','packaging materials, suppliers, manufacturers, wholesale',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(6,'Chemicals & Minerals','chemicals-minerals','flask-conical','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=600&auto=format&fit=crop&q=80','Industrial chemicals, laboratory reagents, polymers, solvents, and specialty additives.','Industrial Chemicals & Polymer Raw Material Suppliers','Direct manufacturers of industrial solvents, Caustic Soda, polymer granules, and specialty chemicals.','chemicals & minerals, suppliers, manufacturers, wholesale',1,6,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(7,'Medical & Healthcare','medical-equipment','activity','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Diagnostic equipment, hospital furniture, surgical instruments, and medical disposables.','Medical Devices & Hospital Equipment Manufacturers','Source hospital beds, patient monitors, oxygen concentrators, and surgical disposables.','medical & healthcare, suppliers, manufacturers, wholesale',1,7,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(8,'Textiles & Apparel','textile-products','scissors','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Yarn, cotton fabrics, industrial workwear, uniform fabrics, and garment accessories.','Textile Mills, Fabric Manufacturers & Uniform Suppliers','Wholesale cotton yarn, denim fabrics, flame-retardant workwear, and garment fabrics.','textiles & apparel, suppliers, manufacturers, wholesale',1,8,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(9,'Agriculture & Food','agriculture-food','sprout','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Agro commodities, organic spices, pulses, drip irrigation equipment, and cold-pressed oils.','Agro Commodities & Spices Wholesalers','Buy Indian spices, Basmati rice, cold pressed edible oils, and precision drip irrigation pipes.','agriculture & food, suppliers, manufacturers, wholesale',1,9,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(10,'Automobile & EV Parts','automobile-parts','truck','https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=600&auto=format&fit=crop&q=80','OEM automotive spares, electric vehicle powertrain parts, heavy vehicle brake assemblies, and batteries.','Auto Spare Parts & EV Component Manufacturers','Automotive filters, brake pads, EV charging stations, and suspension parts wholesale.','automobile & ev parts, suppliers, manufacturers, wholesale',1,10,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(11,'Commercial Furniture','furniture','armchair','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Ergonomic office workstations, executive chairs, warehouse pallet racks, and institutional furniture.','Office Furniture & Warehouse Storage Racks','Modular office workstations, ergonomic mesh chairs, and heavy duty warehouse pallet racking.','commercial furniture, suppliers, manufacturers, wholesale',1,11,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(12,'Security & Safety Systems','security-products','shield-check','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','IP CCTV surveillance, biometric access control, fire suppression systems, and industrial PPE.','Industrial Security Cameras & Fire Safety Equipment','Commercial CCTV systems, biometric attendance machines, and ABC fire extinguishers.','security & safety systems, suppliers, manufacturers, wholesale',1,12,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(13,'IT Services & Software','it-services','laptop','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Custom enterprise ERP, cloud hosting, IoT industrial monitoring, and B2B portal development.','B2B Software Development & Enterprise ERP Solutions','Custom ERP for manufacturing, IoT SCADA solutions, and enterprise software services.','it services & software, suppliers, manufacturers, wholesale',1,13,'2026-08-25 07:10:29','2026-08-25 07:10:29');
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
INSERT INTO `inquiries` VALUES (1,1,1,1,'Rajesh Kumar','buyer@nextrade.com','+91 98201 12345',2,720000.00,'Mumbai, Maharashtra','Hello Apex Machinery team, we are expanding our tool room and looking to order 2 units of your 3000 RPM CNC Lathe machine. Can you provide lead time, installation support in Mumbai, and best export commercial terms?','accepted','Dear Rajesh, thank you for your inquiry. We have units ready in stock and our Mumbai engineering team will handle on-site installation and operator training at no extra charge. We have sent you a detailed technical proposal.','2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Delhi','Delhi','India','110001','https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(2,'Mumbai','Maharashtra','India','400001','https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(3,'Bengaluru','Karnataka','India','560001','https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(4,'Hyderabad','Telangana','India','500001','https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(5,'Ahmedabad','Gujarat','India','380001','https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(6,'Pune','Maharashtra','India','411001','https://images.unsplash.com/photo-1616088410192-39c4d6836423?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(7,'Chennai','Tamil Nadu','India','600001','https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(8,'Kolkata','West Bengal','India','700001','https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(9,'Surat','Gujarat','India','395001','https://images.unsplash.com/photo-1590496793929-36417d3117de?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(10,'Jaipur','Rajasthan','India','302001','https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(11,'Noida','Uttar Pradesh','India','201301','https://images.unsplash.com/photo-1562975871-33230b777a83?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(12,'Gurugram','Haryana','India','122001','https://images.unsplash.com/photo-1577495508048-b635879837f1?w=500&auto=format&fit=crop&q=80',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(13,'Coimbatore','Tamil Nadu','India','641001','https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',0,'2026-08-25 07:10:27','2026-08-25 07:10:27');
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
INSERT INTO `messages` VALUES (1,3,6,NULL,NULL,'Hi Arunachalam, following up on our inquiry for the Apex CNC Lathe 3000X. Is it possible to schedule a video demonstration of the machine spindle under load test?',NULL,1,'2026-08-25 02:10:30','2026-08-25 01:10:30','2026-08-25 07:10:30'),(2,6,3,NULL,NULL,'Hello Mr. Rajesh! Absolutely. I can connect you live with our chief testing engineer at our Coimbatore assembly plant today at 3:30 PM. Would that work for you?',NULL,1,'2026-08-25 04:10:30','2026-08-25 03:10:30','2026-08-25 07:10:30'),(3,3,6,NULL,NULL,'3:30 PM works great! Please share the meeting link. Also, please confirm if the Siemens 808D controller comes with conversational programming enabled.',NULL,0,NULL,'2026-08-25 06:40:30','2026-08-25 07:10:30');
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
INSERT INTO `notifications` VALUES (1,6,'inquiry','New Product Inquiry Received','Rajesh Kumar from Apex Infra Projects sent an inquiry for \"Apex UltraPrecision CNC Lathe Machine\".','/supplier/inquiries',0,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(2,3,'quote','New Quotation Received for your RFQ','NovaTech Solar has submitted a quotation of ₹10,950/Piece for your 200kW Solar Modules requirement.','/buyer/quotes',0,'2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(2,2,'https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(3,3,'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(4,4,'https://images.unsplash.com/photo-1509391365360-2e959784a276?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(5,5,'https://images.unsplash.com/photo-1548345680-f5475ea5df84?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(6,6,'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(7,7,'https://images.unsplash.com/photo-1541888946425-d0fbb180c5f5?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(8,8,'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(9,9,'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(10,10,'https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(11,11,'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',1,1,'2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,1,'Apex UltraPrecision Heavy Duty CNC Lathe Machine 3000 RPM','apex-ultraprecision-heavy-duty-cnc-lathe-machine-3000-rpm-7PsS3','Apex CNC','APX-CNC-3000X','Heavy duty slant-bed CNC Lathe Machine equipped with Fanuc / Siemens controller, 8-station hydraulic turret, automatic chip conveyor, and hardened ground guideways. Perfect for aerospace, automotive, and heavy industrial precision shaft turning.',750000.00,'Set',1,15,'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Control System\", \"value\": \"Siemens 808D / Fanuc 0i-TF\"}, {\"key\": \"Spindle Motor Power\", \"value\": \"11 kW / 15 HP\"}, {\"key\": \"Max Machining Diameter\", \"value\": \"320 mm\"}, {\"key\": \"Weight of Machine\", \"value\": \"3,800 kg\"}, {\"key\": \"Warranty\", \"value\": \"2 Years On-Site Warranty\"}]','• Max Swing over bed: 500 mm\n• Max Turning Length: 1000 mm\n• Spindle Speed Range: 50 - 3500 RPM\n• Chuck Size: 8 Inch 3-Jaw Hydraulic\n• Full Enclosed Splash Guard & Auto Lubrication','Export standard vacuum sealed waterproof packaging in fumigated wooden crate.','Dispatched within 10-14 days via heavy cargo transport across India & Global ports.','30% Advance, 70% against BL / Letter of Credit (LC)',1,1,1,1253,'2026-08-25 07:10:30','2026-08-25 07:32:09',NULL),(2,1,1,2,'High Pressure Variable Displacement Axial Piston Hydraulic Pump','high-pressure-variable-displacement-axial-piston-hydraulic-pump-NGGdz','ApexHydra','APX-HYD-P450','Industrial grade axial piston pump designed for open-circuit hydraulic systems requiring constant pressure and load sensing capabilities. Features high efficiency, low noise emissions, and extended bearing lifespan.',38500.00,'Piece',2,80,'https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Displacement\", \"value\": \"71 cc/rev\"}, {\"key\": \"Max Pressure\", \"value\": \"350 Bar\"}, {\"key\": \"Rotation\", \"value\": \"Clockwise / Bi-directional\"}, {\"key\": \"Fluid Compatibility\", \"value\": \"Mineral Hydraulic Oil ISO VG 46/68\"}]','• Displacement: 45 cc/rev to 140 cc/rev\n• Nominal Pressure: 350 bar (Max 400 bar)\n• SAE Flange Mounting\n• Cast iron housing with anti-corrosion coating','Individually boxed in heavy protective foam casing.','Ready in stock. Dispatches in 24-48 hours.','100% Advance / UPI / Net Banking / Net 30 for verified buyers',1,1,0,840,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(3,1,1,3,'Apex 50 HP Industrial Rotary Screw Air Compressor with Inverter VFD','apex-50-hp-industrial-rotary-screw-air-compressor-with-inverter-vfd-ZfG2A','ApexAir','APX-CMP-50VFD','Energy saving Variable Frequency Drive (VFD) rotary screw compressor. Provides continuous 210 CFM compressed air with ultra-quiet acoustic canopy and touch screen intelligent controller.',320000.00,'Set',1,20,'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Free Air Delivery\", \"value\": \"6.0 m³/min (210 CFM)\"}, {\"key\": \"Working Pressure\", \"value\": \"8.0 to 10.0 Bar\"}, {\"key\": \"Cooling Method\", \"value\": \"Forced Air Cooled\"}, {\"key\": \"Noise Level\", \"value\": \"68 ± 2 dB(A)\"}]','• Motor Power: 37 kW / 50 HP\n• Air Flow: 210 CFM @ 8 bar\n• Integrated Air Dryer & Dual Micro Filters\n• Energy Savings up to 35% with PM Motor','Fumigated wooden box with anti-moisture silica packing.','Shipped in 3-5 days across all Indian industrial hubs.','50% Advance, 50% on Delivery',1,0,0,620,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(4,2,2,7,'NovaTech 550W Bifacial Mono PERC Half-Cut Solar PV Panel','novatech-550w-bifacial-mono-perc-half-cut-solar-pv-panel-ZBb5k','NovaTech Solar','NTS-550W-BIF','High efficiency 144 Half-Cut Cell Bifacial Monocrystalline PERC solar module. Generates up to 25% extra energy from the rear side. Tested and certified under IEC 61215 and ALMM approved for government and commercial solar projects.',11200.00,'Piece',25,5000,'https://images.unsplash.com/photo-1509391365360-2e959784a276?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Rated Maximum Power (Pmax)\", \"value\": \"550 W\"}, {\"key\": \"Open Circuit Voltage (Voc)\", \"value\": \"49.80 V\"}, {\"key\": \"Short Circuit Current (Isc)\", \"value\": \"13.98 A\"}, {\"key\": \"Module Dimensions\", \"value\": \"2278 x 1134 x 35 mm\"}, {\"key\": \"Certification\", \"value\": \"BIS, ALMM, IEC 61215, IEC 61730\"}]','• Module Efficiency: 21.6%\n• PID Resistant & Anti-Reflective 3.2mm Tempered Glass\n• Robust 35mm Anodized Aluminum Alloy Frame\n• 30 Years Linear Performance Warranty (85% at Year 30)','31 Panels per pallet, 682 panels per 40ft High Cube container.','Immediate bulk dispatch from Bengaluru & Delhi warehouses.','100% Irrevocable LC at sight or 20% advance & balance before dispatch',1,1,1,3120,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(5,2,2,8,'NovaTech 50kW Three Phase Commercial On-Grid Solar Inverter','novatech-50kw-three-phase-commercial-on-grid-solar-inverter-t60VZ','NovaTech Grid','NTS-INV-50K','Commercial grid-tied transformerless string inverter with 4 MPPT trackers, 98.8% max efficiency, built-in WiFi/Ethernet monitoring, AFCI arc fault protection, and IP66 outdoor rated weather resistance.',145000.00,'Set',1,45,'https://images.unsplash.com/photo-1548345680-f5475ea5df84?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Max AC Output Power\", \"value\": \"55 kVA\"}, {\"key\": \"Nominal AC Grid Voltage\", \"value\": \"400V, 3L+N+PE\"}, {\"key\": \"MPPT Voltage Range\", \"value\": \"200V - 1000V\"}, {\"key\": \"Ingress Protection\", \"value\": \"IP66 Waterproof\"}]','• Max DC Input: 1100V\n• 4 Independent MPPTs with 8 String Inputs\n• Integrated DC Switch & Type II AC/DC Surge Protection\n• 10-Year Standard Factory Warranty','Corrugated carton with shock-absorbent EPE foam.','Dispatches within 48 hours.','Online Bank Transfer / RTGS / LC',1,1,0,1100,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(6,5,4,17,'Primary Brand Fe 550D High Ductility Corrosion Resistant TMT Rebar Steel','primary-brand-fe-550d-high-ductility-corrosion-resistant-tmt-rebar-steel-RMIA9','Vanguard TMT','VAN-TMT-550D','Thermo-Mechanically Treated (TMT) Fe 550D reinforcing steel bars complying with IS 1786:2008 standards. Superior earthquake resistance, higher bendability, and superior bonding with concrete for infrastructure projects.',58500.00,'Metric Ton',10,2500,'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Standard Specification\", \"value\": \"IS 1786:2008 Fe 550D\"}, {\"key\": \"Carbon Equivalent (Max)\", \"value\": \"0.42%\"}, {\"key\": \"Length per Bar\", \"value\": \"12 Meters Standard\"}, {\"key\": \"Tolerance on Weight\", \"value\": \"Within BIS limits ±3%\"}]','• Diameters Available: 8mm, 10mm, 12mm, 16mm, 20mm, 25mm, 32mm\n• Min Yield Strength: 550 N/mm²\n• Min Elongation: 16.0%\n• Includes Mill Test Certificate (MTC) with every trailer dispatch','Bundled with heavy steel wire ties and color-coded identification tags.','Trailer load direct to construction sites in Maharashtra, Gujarat, Goa & MP.','Advance RTGS before dispatch / Bank Guarantee (BG)',1,1,1,1890,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(7,5,4,20,'Heavy Duty Cuplock Scaffolding System & Steel Prop Jacks','heavy-duty-cuplock-scaffolding-system-steel-prop-jacks-KDrDW','Vanguard Scaffold','VAN-SCF-CUP100','Complete modular Cuplock scaffolding system including vertical standards with forged cups at 500mm intervals, horizontal ledgers, base jacks, and galvanized steel walking catwalk planks.',74000.00,'Metric Ton',3,450,'https://images.unsplash.com/photo-1541888946425-d0fbb180c5f5?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Tube Outer Diameter\", \"value\": \"48.3 mm\"}, {\"key\": \"Steel Grade\", \"value\": \"YST 240 / IS 1161\"}, {\"key\": \"Cup Spacing\", \"value\": \"500 mm Centers\"}]','• Material: High Tensile MS Pipe 48.3mm OD x 3.2mm Wall\n• Surface Finish: Hot Dip Galvanized or Anti-Rust Painted\n• Rapid assembly and dismantling with single hammer blow lock','Stacked on steel pallets and strapped for forklift handling.','Immediate stock dispatch.','30% Advance, 70% against Proforma Invoice',1,0,0,710,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(8,3,5,22,'Custom Printed 5-Ply Heavy Duty Kraft Corrugated Shipping Boxes','custom-printed-5-ply-heavy-duty-kraft-corrugated-shipping-boxes-mF2sa','BharatPack','BHP-BOX-5PLY','Industrial strength 5-Ply fluted corrugated shipping cartons manufactured using virgin semi-kraft paper. High edge crush test (ECT) and bursting strength rating suitable for e-commerce, warehousing, and export shipping.',32.50,'Piece',1000,50000,'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Box Style\", \"value\": \"RSC (Regular Slotted Carton)\"}, {\"key\": \"Material\", \"value\": \"100% Recyclable Virgin Semi-Kraft\"}, {\"key\": \"Load Capacity\", \"value\": \"Up to 35 kg Stack Load\"}]','• Flute Type: AB / BC Combination Double Wall\n• Paper GSM: 150 GSM Outer Virgin Kraft + 120 GSM Fluting\n• Custom Flexographic Multi-Color Logo & Barcode Printing\n• Bursting Factor (BF): 24+ BF','Bundled in packs of 25 with shrink wrap and protective edge boards.','Custom production in 4-6 business days.','50% Advance with Purchase Order, 50% on Delivery',1,1,0,950,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(9,3,5,23,'Cast LLDPE Manual & Machine Pallet Stretch Wrap Film Rolls 23 Micron','cast-lldpe-manual-machine-pallet-stretch-wrap-film-rolls-23-micron-xLVSp','BharatFilm','BHP-FLM-23M','High clarity 5-layer co-extruded LLDPE cast stretch film with up to 300% elongation pre-stretch capabilities. Exceptional puncture resistance and one-sided cling properties.',148.00,'Kg',100,8000,'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Raw Material\", \"value\": \"100% Prime Virgin Dow / Sabic LLDPE\"}, {\"key\": \"Stretch Capacity\", \"value\": \"Up to 300%\"}, {\"key\": \"Color\", \"value\": \"Ultra Clear Transparent / Opaque Black\"}]','• Thickness: 23 Micron (Options: 17µ, 29µ available)\n• Roll Width: 500 mm (20 inches)\n• Core Weight: 1.0 kg High Strength Paper Tube\n• Silent unwinding and tear resistance','4 Rolls per carton, 48 cartons per pallet.','Ready stock available for same-day dispatch.','Cash / Cheque / Bank Transfer',1,0,0,540,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(10,4,6,27,'Industrial Grade Caustic Soda Flakes (Sodium Hydroxide NaOH 99.5%)','industrial-grade-caustic-soda-flakes-sodium-hydroxide-naoh-995-NG5H9','DeltaChem','DLT-NAOH-99FL','High purity membrane cell grade Caustic Soda Flakes (Sodium Hydroxide 99.5% min). Widely utilized in textile processing, paper manufacturing, soap & detergents, water treatment, and alumina refining.',42.00,'Kg',500,25000,'https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"CAS Number\", \"value\": \"1310-73-2\"}, {\"key\": \"Molecular Formula\", \"value\": \"NaOH\"}, {\"key\": \"Purity (Assay)\", \"value\": \"99.50% Min\"}, {\"key\": \"Hazard Class\", \"value\": \"Class 8 (Corrosive)\"}]','• Appearance: Pure white deliquescent flakes\n• Purity: 99.5% NaOH Minimum\n• Sodium Carbonate (Na2CO3): 0.4% Max\n• Chlorides (as NaCl): 0.03% Max\n• Heavy Metals: Below 5 ppm','25kg HDPE woven bags with airtight inner LDPE liner.','Full truckload or LCL dispatch with MSDS and COA certificates.','100% Advance / LC at Sight',1,1,0,1400,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(11,6,8,38,'Heavy Duty 100% Cotton Drill Flame Retardant Industrial Uniform Fabric','heavy-duty-100-cotton-drill-flame-retardant-industrial-uniform-fabric-TiKj3','RoyalShield','RSW-FAB-FR240','Premium 240 GSM 100% Cotton 3/1 Twill fabric with EN ISO 11612 certified flame retardant finish. Engineered for oil & gas refinery coveralls, mining boiler suits, and electrical substation workwear.',125.00,'Meter',500,15000,'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',NULL,'[{\"key\": \"Composition\", \"value\": \"100% Ring Spun Combed Cotton\"}, {\"key\": \"Weave Pattern\", \"value\": \"3/1 Heavy Twill Drill\"}, {\"key\": \"Tensile Strength\", \"value\": \"Warp > 1100 N, Weft > 800 N\"}, {\"key\": \"Shrinkage\", \"value\": \"Less than 2.5%\"}]','• Width: 58/60 inches\n• Weight: 240 GSM ± 5%\n• Color Fastness to Washing: 4-5 Grade\n• OEKO-TEX Standard 100 Certified\n• Available Colors: Navy Blue, Orange, Royal Blue, Khaki, Hi-Vis Yellow','Double folded rolls of 100 meters wrapped in protective poly bags.','Dispatches in 3 business days from Surat warehouse.','30% Advance, 70% against delivery / LC',1,1,0,880,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL);
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
INSERT INTO `quotes` VALUES (1,1,2,1,10950.00,380,100,7,15000.00,'20% Advance, 80% against dispatch invoice','2026-09-08','We can supply 380 units of NovaTech 550W Bifacial Mono PERC modules immediately from our Bhiwandi warehouse with BIS & ALMM test certificates included.',NULL,'pending','2026-08-25 07:10:30','2026-08-25 07:10:30'),(2,2,5,1,58000.00,50,10,3,0.00,'100% RTGS against Proforma','2026-09-01','Special infrastructure rate: ₹58,000/MT inclusive of transportation to Hinjewadi, Pune. Full 12m lengths with original Mill Test Certificates (MTC).',NULL,'accepted','2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recently_viewed`
--

LOCK TABLES `recently_viewed` WRITE;
/*!40000 ALTER TABLE `recently_viewed` DISABLE KEYS */;
INSERT INTO `recently_viewed` VALUES (1,NULL,1,'htuVa9RwKwE9riACGljFIXzrbgmh4x7HHcERYWm4','2026-08-25 07:24:23','2026-08-25 07:24:23'),(2,NULL,1,'he300FbDBT6We6BKgEjPQFGKAaqlDqVobFk8OAFe','2026-08-25 07:27:58','2026-08-25 07:27:58'),(3,NULL,1,'4vVKEDXbYSAFwzFgcTjCsLhXyKGdwS7CzoEMPMS7','2026-08-25 07:32:09','2026-08-25 07:32:09');
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
INSERT INTO `requirements` VALUES (1,1,2,'Urgent Requirement: 200kW Mono PERC 540W+ Solar PV Modules for Factory Rooftop','We require 380 units of Tier-1 certified 540W to 550W Mono PERC Solar Panels with minimum 21% efficiency and ALMM approval for our industrial plant in Navi Mumbai. Delivery required within 20 days.',380,'Pieces',11000.00,'Mumbai / Maharashtra / Gujarat','Turbhe MIDC, Navi Mumbai, Maharashtra','400705','2026-09-14','30% Advance, 70% on Site Delivery','Must include 12-year product warranty and BIS certification certificate.',NULL,'open','2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(2,1,4,'Bulk Purchase: 50 Metric Tons Primary Fe 550D TMT Rebars (12mm, 16mm, 20mm)','Looking for direct quotes from primary steel distributors/mills for 50 Metric Tons of Fe 550D TMT bars for our commercial infrastructure project in Pune. Immediate trailer delivery needed.',50,'Metric Tons',57500.00,'Pune / Mumbai / Western India','Hinjewadi Phase 2, Pune, Maharashtra','411057','2026-09-04','100% RTGS against weighbridge slip & MTC','Test certificates must match heat number stamped on rebars.',NULL,'quoted','2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(3,2,5,'Monthly Contract: 20,000 Custom Printed 5-Ply Corrugated Delivery Boxes','Seeking reliable packaging manufacturer for ongoing monthly requirement of 20,000 5-ply kraft corrugated boxes (Size: 18x12x10 inches) with 2-color brand logo printing for our retail distribution chain.',20000,'Pieces',30.00,'Delhi NCR / Haryana / Rajasthan / Gujarat','Kundli Industrial Area, Sonipat, Haryana','131028','2026-09-09','Net 30 Days Credit after initial 2 cycles','Must submit physical sample box for drop test approval before PO.',NULL,'open','2026-08-25 07:10:30','2026-08-25 07:10:30',NULL);
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
INSERT INTO `reviews` VALUES (1,1,1,1,5,5,5,5,5,5.00,'Top notch precision machinery & exceptional on-site support!','We procured 3 CNC Lathe units from Apex Industrial for our automotive components plant. The spindle accuracy and rigid bed construction are world-class. Arunachalam and his engineering team provided outstanding commissioning support.','Thank you Rajesh for your valued partnership and feedback! We look forward to supporting your upcoming plant expansions.','approved','2026-08-25 07:10:30','2026-08-25 07:10:30'),(2,2,1,NULL,5,5,4,5,5,4.80,'Excellent generation performance from 550W Bifacial modules','Our 150kW rooftop installation has been running for 6 months now and generating approx 8-10% higher than estimated PVsyst models. Highly recommended supplier for commercial solar projects.',NULL,'approved','2026-08-25 07:10:30','2026-08-25 07:10:30');
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
INSERT INTO `services` VALUES (1,1,1,'Custom CNC Precision Tooling & Turnkey Machine Retrofitting','custom-cnc-precision-tooling-retrofitting','Complete engineering design, CAD/CAM programming, machine retrofitting with CNC controls, and on-site commissioning services for heavy manufacturing plants.','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','₹50,000 - ₹5,00,000 / Project',1,'2026-08-25 07:10:30','2026-08-25 07:10:30'),(2,2,2,'Turnkey Commercial & Industrial MW Solar EPC Contracting','turnkey-commercial-industrial-solar-epc','End-to-end solar EPC contracting including site shadow analysis, net-metering approvals, structural mounting, electrical installation, and 25-year O&M maintenance.','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','₹32,000 - ₹38,000 / kW Installed',1,'2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'CNC Lathe Machines','cnc-lathe-machines','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','CNC Lathe Machines wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(2,1,'Hydraulic Pumps & Valves','hydraulic-pumps-valves','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Hydraulic Pumps & Valves wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(3,1,'Air Compressors','air-compressors','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Air Compressors wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(4,1,'Industrial Conveyors','industrial-conveyors','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Industrial Conveyors wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(5,1,'Plastic Molding Machines','plastic-molding-machines','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Plastic Molding Machines wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(6,1,'Water Treatment Plants','water-treatment-plants','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80','Water Treatment Plants wholesale supply and manufacturing options.',1,6,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(7,2,'Mono Perc Solar Panels','mono-perc-solar-panels','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','Mono Perc Solar Panels wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(8,2,'On-Grid Solar Inverters','on-grid-solar-inverters','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','On-Grid Solar Inverters wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(9,2,'Solar Tubular & Lithium Batteries','solar-tubular-lithium-batteries','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','Solar Tubular & Lithium Batteries wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(10,2,'Solar Water Heaters','solar-water-heaters','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','Solar Water Heaters wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(11,2,'Solar Street Lights','solar-street-lights','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80','Solar Street Lights wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(12,3,'Three-Phase Induction Motors','three-phase-induction-motors','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Three-Phase Induction Motors wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(13,3,'HT/LT Power Cables','htlt-power-cables','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','HT/LT Power Cables wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(14,3,'Industrial Proximity Sensors','industrial-proximity-sensors','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Industrial Proximity Sensors wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(15,3,'LT Switchgear & Panels','lt-switchgear-panels','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','LT Switchgear & Panels wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(16,3,'Digital Multimeters','digital-multimeters','https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80','Digital Multimeters wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(17,4,'Fe 550D TMT Rebars','fe-550d-tmt-rebars','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Fe 550D TMT Rebars wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(18,4,'Structural Steel Beams','structural-steel-beams','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Structural Steel Beams wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(19,4,'OPC / PPC Cement 50kg','opc-ppc-cement-50kg','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','OPC / PPC Cement 50kg wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(20,4,'Tubular Scaffolding Systems','tubular-scaffolding-systems','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Tubular Scaffolding Systems wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(21,4,'Vitrified Floor Tiles','vitrified-floor-tiles','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80','Vitrified Floor Tiles wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(22,5,'3-Ply & 5-Ply Corrugated Boxes','3-ply-5-ply-corrugated-boxes','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','3-Ply & 5-Ply Corrugated Boxes wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(23,5,'LLDPE Stretch Wrap Films','lldpe-stretch-wrap-films','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','LLDPE Stretch Wrap Films wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(24,5,'Printed Stand-up Pouches','printed-stand-up-pouches','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Printed Stand-up Pouches wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(25,5,'Corrugated Shipping Rolls','corrugated-shipping-rolls','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Corrugated Shipping Rolls wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(26,5,'Rigid Plastic Drums','rigid-plastic-drums','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80','Rigid Plastic Drums wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(27,6,'Caustic Soda Flakes','caustic-soda-flakes','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=600&auto=format&fit=crop&q=80','Caustic Soda Flakes wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(28,6,'Industrial Solvents & IPA','industrial-solvents-ipa','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=600&auto=format&fit=crop&q=80','Industrial Solvents & IPA wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(29,6,'Polymer & PVC Resins','polymer-pvc-resins','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=600&auto=format&fit=crop&q=80','Polymer & PVC Resins wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(30,6,'Activated Carbon Granules','activated-carbon-granules','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=600&auto=format&fit=crop&q=80','Activated Carbon Granules wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(31,6,'Pigments & Color Dyes','pigments-color-dyes','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=600&auto=format&fit=crop&q=80','Pigments & Color Dyes wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(32,7,'ICU Multipara Patient Monitors','icu-multipara-patient-monitors','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','ICU Multipara Patient Monitors wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(33,7,'Motorized Hospital Beds','motorized-hospital-beds','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Motorized Hospital Beds wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(34,7,'Surgical Gloves & Disposables','surgical-gloves-disposables','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Surgical Gloves & Disposables wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(35,7,'Digital X-Ray Machines','digital-x-ray-machines','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Digital X-Ray Machines wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(36,7,'Oxygen Concentrators 10L','oxygen-concentrators-10l','https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80','Oxygen Concentrators 10L wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(37,8,'100% Combed Cotton Yarn','100-combed-cotton-yarn','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','100% Combed Cotton Yarn wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(38,8,'Industrial Boiler Suits & Workwear','industrial-boiler-suits-workwear','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Industrial Boiler Suits & Workwear wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(39,8,'Denim & Twill Fabrics','denim-twill-fabrics','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Denim & Twill Fabrics wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(40,8,'Non-Woven Fabric Rolls','non-woven-fabric-rolls','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Non-Woven Fabric Rolls wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(41,8,'Polyester Sewing Thread','polyester-sewing-thread','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80','Polyester Sewing Thread wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(42,9,'Premium Basmati Rice','premium-basmati-rice','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Premium Basmati Rice wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(43,9,'Organic Turmeric & Chili Powder','organic-turmeric-chili-powder','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Organic Turmeric & Chili Powder wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(44,9,'Drip Irrigation Pipe Lines','drip-irrigation-pipe-lines','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Drip Irrigation Pipe Lines wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(45,9,'Cold Pressed Mustard Oil','cold-pressed-mustard-oil','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','Cold Pressed Mustard Oil wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(46,9,'NPK Water Soluble Fertilizers','npk-water-soluble-fertilizers','https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80','NPK Water Soluble Fertilizers wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(47,10,'Heavy Duty Ceramic Brake Pads','heavy-duty-ceramic-brake-pads','https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=600&auto=format&fit=crop&q=80','Heavy Duty Ceramic Brake Pads wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(48,10,'Automotive Oil & Air Filters','automotive-oil-air-filters','https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=600&auto=format&fit=crop&q=80','Automotive Oil & Air Filters wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(49,10,'EV Fast DC Charging Stations','ev-fast-dc-charging-stations','https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=600&auto=format&fit=crop&q=80','EV Fast DC Charging Stations wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(50,10,'Commercial Vehicle Leaf Springs','commercial-vehicle-leaf-springs','https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=600&auto=format&fit=crop&q=80','Commercial Vehicle Leaf Springs wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(51,10,'Lithium EV Battery Packs','lithium-ev-battery-packs','https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=600&auto=format&fit=crop&q=80','Lithium EV Battery Packs wholesale supply and manufacturing options.',1,5,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(52,11,'High-Back Ergonomic Mesh Chairs','high-back-ergonomic-mesh-chairs','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','High-Back Ergonomic Mesh Chairs wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(53,11,'Modular 4-Person Office Workstations','modular-4-person-office-workstations','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Modular 4-Person Office Workstations wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(54,11,'Heavy Duty Pallet Storage Racks','heavy-duty-pallet-storage-racks','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Heavy Duty Pallet Storage Racks wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(55,11,'Fireproof Steel Filing Cabinets','fireproof-steel-filing-cabinets','https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80','Fireproof Steel Filing Cabinets wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(56,12,'4K Ultra HD IP CCTV Cameras','4k-ultra-hd-ip-cctv-cameras','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','4K Ultra HD IP CCTV Cameras wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(57,12,'Biometric Face & Fingerprint Terminals','biometric-face-fingerprint-terminals','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','Biometric Face & Fingerprint Terminals wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(58,12,'Automatic CO2 Fire Suppression Systems','automatic-co2-fire-suppression-systems','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','Automatic CO2 Fire Suppression Systems wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(59,12,'High-Visibility Safety Helmets & Vests','high-visibility-safety-helmets-vests','https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80','High-Visibility Safety Helmets & Vests wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(60,13,'Cloud Manufacturing ERP Software','cloud-manufacturing-erp-software','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Cloud Manufacturing ERP Software wholesale supply and manufacturing options.',1,1,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(61,13,'Industrial IoT Gateway & SCADA','industrial-iot-gateway-scada','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Industrial IoT Gateway & SCADA wholesale supply and manufacturing options.',1,2,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(62,13,'Cybersecurity Audit & Compliance','cybersecurity-audit-compliance','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Cybersecurity Audit & Compliance wholesale supply and manufacturing options.',1,3,'2026-08-25 07:10:29','2026-08-25 07:10:29'),(63,13,'Custom Mobile & Web Apps','custom-mobile-web-apps','https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80','Custom Mobile & Web Apps wholesale supply and manufacturing options.',1,4,'2026-08-25 07:10:29','2026-08-25 07:10:29');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_payments`
--

LOCK TABLES `subscription_payments` WRITE;
/*!40000 ALTER TABLE `subscription_payments` DISABLE KEYS */;
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
INSERT INTO `subscription_plans` VALUES (1,'Free Starter','free-starter',0.00,'yearly',5,15,0,0,0,0,'[\"List up to 5 Products\", \"15 Monthly Inquiries\", \"Basic Company Profile\", \"Standard Search Listing\"]',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(2,'Business Pro','business-pro',4999.00,'yearly',50,150,1,1,1,1,'[\"List up to 50 Products\", \"150 Monthly Inquiries\", \"GST & Trust Verified Badge\", \"Priority Search Placement\", \"Full Buy Requirement (RFQ) Access\", \"Analytics & Profile View Insights\"]',1,'2026-08-25 07:10:27','2026-08-25 07:10:27'),(3,'Enterprise Elite','enterprise-elite',14999.00,'yearly',500,1000,1,1,1,1,'[\"Unlimited Products Listing\", \"Unlimited Inquiries & Lead Access\", \"Gold Premium Verified Badge\", \"Top #1 Search Ranking & Homepage Feature\", \"Instant RFQ Lead Notifications via SMS/Email\", \"Dedicated Account Manager & 24/7 Support\"]',1,'2026-08-25 07:10:27','2026-08-25 07:10:27');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,1,3,'2026-06-25 07:10:29','2027-06-25 07:10:29','active','pay_demo_qpmgQmZeO3','2026-08-25 07:10:29','2026-08-25 07:10:29'),(2,2,3,'2026-06-25 07:10:29','2027-06-25 07:10:29','active','pay_demo_VfNydju7w6','2026-08-25 07:10:29','2026-08-25 07:10:29'),(3,3,2,'2026-06-25 07:10:29','2027-06-25 07:10:29','active','pay_demo_FsqrjQWSv2','2026-08-25 07:10:29','2026-08-25 07:10:29'),(4,4,2,'2026-06-25 07:10:30','2027-06-25 07:10:30','active','pay_demo_8FrKVitDTx','2026-08-25 07:10:30','2026-08-25 07:10:30'),(5,5,3,'2026-06-25 07:10:30','2027-06-25 07:10:30','active','pay_demo_q0QEkIwLgI','2026-08-25 07:10:30','2026-08-25 07:10:30'),(6,6,2,'2026-06-25 07:10:30','2027-06-25 07:10:30','active','pay_demo_W1gyNmXgxS','2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_documents`
--

LOCK TABLES `supplier_documents` WRITE;
/*!40000 ALTER TABLE `supplier_documents` DISABLE KEYS */;
INSERT INTO `supplier_documents` VALUES (1,1,'GST_Certificate','33AAACA1122D1Z9','documents/gst_cert_1.pdf','approved',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29','2026-08-25 07:10:29'),(2,1,'PAN_Card','AAACA1122D','documents/pan_card_1.pdf','approved',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29','2026-08-25 07:10:29'),(3,2,'GST_Certificate','29AAACN8877K1Z4','documents/gst_cert_2.pdf','approved',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29','2026-08-25 07:10:29'),(4,2,'PAN_Card','AAACN8877K','documents/pan_card_2.pdf','approved',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29','2026-08-25 07:10:29'),(5,3,'GST_Certificate','24AAACB3344J1Z1','documents/gst_cert_3.pdf','approved',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29','2026-08-25 07:10:29'),(6,3,'PAN_Card','AAACB3344J','documents/pan_card_3.pdf','approved',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29','2026-08-25 07:10:29'),(7,4,'GST_Certificate','36AAACD9900L1Z7','documents/gst_cert_4.pdf','approved',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30','2026-08-25 07:10:30'),(8,4,'PAN_Card','AAACD9900L','documents/pan_card_4.pdf','approved',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30','2026-08-25 07:10:30'),(9,5,'GST_Certificate','27AAACV7766M1Z3','documents/gst_cert_5.pdf','approved',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30','2026-08-25 07:10:30'),(10,5,'PAN_Card','AAACV7766M','documents/pan_card_5.pdf','approved',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30','2026-08-25 07:10:30'),(11,6,'GST_Certificate','24AAACR4455N1Z5','documents/gst_cert_6.pdf','approved',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30','2026-08-25 07:10:30'),(12,6,'PAN_Card','AAACR4455N','documents/pan_card_6.pdf','approved',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30','2026-08-25 07:10:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,6,3,'Apex Industrial Machineries Pvt Ltd','apex-industrial-machineries','Manufacturer',2006,'51-100 People','33AAACA1122D1Z9','AAACA1122D','SF No 142/2, Peelamedu Industrial Estate, Avinashi Road','Coimbatore','Tamil Nadu','India','641006','https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&auto=format&fit=crop&q=80','Apex Industrial Machineries is a premier manufacturer and exporter of heavy-duty CNC lathe machines, industrial hydraulic pumps, and automated conveyor systems with ISO 9001:2015 certification. Supplying over 4,000+ factories worldwide with high precision engineered machinery.','https://www.apexindustrialmachinery.example.com',1,'Premium',4.90,38,1425,1,'active','2026-08-25 07:10:29','2026-08-25 07:32:09',NULL),(2,7,3,'NovaTech Solar & Green Energy Ltd','novatech-solar-energy','Manufacturer',2012,'101-250 People','29AAACN8877K1Z4','AAACN8877K','Plot 88, Electronic City Phase 1, Hosur Road','Bengaluru','Karnataka','India','560100','https://images.unsplash.com/photo-1572021335469-31706a17aaef?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1509391365360-2e959784a276?w=1200&auto=format&fit=crop&q=80','NovaTech Solar is a Tier-1 certified manufacturer of high-efficiency Mono PERC Solar Panels, Hybrid Inverters, and Smart Lithium-Ion Energy Storage systems for commercial, industrial, and rooftop utility projects across India and the Middle East.','https://www.novatechsolar.example.com',1,'Premium',4.85,45,2190,1,'active','2026-08-25 07:10:29','2026-08-25 07:10:29',NULL),(3,8,2,'Bharat Polymer & Packaging Solutions','bharat-polymer-packaging','Manufacturer',2010,'25-50 People','24AAACB3344J1Z1','AAACB3344J','Phase IV, GIDC Vatva Industrial Area','Ahmedabad','Gujarat','India','382445','https://images.unsplash.com/photo-1557804506-669a67965ba0?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=1200&auto=format&fit=crop&q=80','Bharat Polymer is a leader in heavy duty 5-ply corrugated shipping boxes, automated LLDPE stretch wrap films, and tamper-proof printed multilayer pouches, serving Fortune 500 FMCG and logistics companies.','https://www.bharatpolymer.example.com',1,'GST',4.70,24,980,0,'active','2026-08-25 07:10:29','2026-08-25 07:10:29',NULL),(4,9,2,'Delta Chemicals & Pharma Ingredients','delta-chemicals-pharma','Manufacturer',2015,'51-100 People','36AAACD9900L1Z7','AAACD9900L','Plot 15, IDA Kukatpally, Near Balanagar','Hyderabad','Telangana','India','500072','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1603555501671-8f96b3fce8b4?w=1200&auto=format&fit=crop&q=80','Delta Chemicals manufactures high-purity industrial solvents, Caustic Soda flakes 99%, active pharmaceutical intermediaries, and activated carbon filters with GLP and GMP compliant laboratories.','https://www.deltachemicals.example.com',1,'KYC',4.90,19,870,1,'active','2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(5,10,3,'Vanguard Steel & Structural Infrastructure','vanguard-steel-infra','Distributor',2002,'101-250 People','27AAACV7766M1Z3','AAACV7766M','MIDC Bhosari Industrial Area, Telco Road','Pune','Maharashtra','India','411018','https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&auto=format&fit=crop&q=80','Authorized prime distributors of primary Fe 550D TMT bars, heavy structural beams, MS plates, and Cuplock scaffolding systems for highway bridges, high-rises, and industrial sheds.','https://www.vanguardsteel.example.com',1,'Premium',4.75,31,1650,1,'active','2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(6,11,2,'Royal Surat Weaves & Textile Mills','royal-surat-weaves','Manufacturer',2008,'250-500 People','24AAACR4455N1Z5','AAACR4455N','Ring Road, Surat Textile Market Complex','Surat','Gujarat','India','395002','https://images.unsplash.com/photo-1497366216548-37526070297c?w=200&auto=format&fit=crop&q=80','https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=1200&auto=format&fit=crop&q=80','Leading textile mill specialized in high-durability uniform fabrics, cotton twill, fire-retardant fabric rolls, and bulk dyed cotton yarns with monthly capacity exceeding 500,000 meters.','https://www.royalsuratweaves.example.com',1,'GST',4.65,17,790,0,'active','2026-08-25 07:10:30','2026-08-25 07:10:30',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'NexTrade Administrator','admin@nextrade.com','+91 98765 43210','admin',NULL,'active','2026-08-25 07:10:28','2026-08-25 07:10:28','$2y$12$Z/MR7hFc0HBGGdERE/n/Fu52mwpYWhBf7vkx6UwDi.KddFqSs.iSi',NULL,'2026-08-25 07:10:28','2026-08-25 07:10:28',NULL),(2,'Pooja Verma (Moderator)','staff@nextrade.com','+91 98765 43211','staff',NULL,'active','2026-08-25 07:10:28','2026-08-25 07:10:28','$2y$12$gB9zq448oorC0p7LjPrSyOtI2vdFREri8pXGdviivKaFoegV7texy',NULL,'2026-08-25 07:10:28','2026-08-25 07:10:28',NULL),(3,'Rajesh Kumar','buyer@nextrade.com','+91 98201 12345','buyer',NULL,'active','2026-08-25 07:10:28','2026-08-25 07:10:28','$2y$12$DmRfwwslpybZwZGSFKTxjOITUpcOGvfsSXfQKJhWdOlj2cDN5/DqG',NULL,'2026-08-25 07:10:28','2026-08-25 07:10:28',NULL),(4,'Ananya Sharma','buyer2@nextrade.com','+91 98111 23456','buyer',NULL,'active','2026-08-25 07:10:28','2026-08-25 07:10:28','$2y$12$ErFa7GXfxHcrzS9mMdIdXeoztmDMrsYOyhgAdHn/ZKEPlO60FUCVO',NULL,'2026-08-25 07:10:28','2026-08-25 07:10:28',NULL),(5,'Vikram Patel','buyer3@nextrade.com','+91 98250 98765','buyer',NULL,'active','2026-08-25 07:10:29','2026-08-25 07:10:29','$2y$12$b6Ryq37/ksT7rkaTGStAGeE/td8M6smjgGQstM3PwaueWr7KEUvIa',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29',NULL),(6,'Arunachalam Murthy','supplier@nextrade.com','+91 94432 10987','supplier',NULL,'active','2026-08-25 07:10:29','2026-08-25 07:10:29','$2y$12$aDPSkXhNTxUFjH2kRVnfEuU1IqgThfjHgq10Co51U3EXz7kN7Nb3W',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29',NULL),(7,'Sunil Joshi','supplier2@nextrade.com','+91 98450 76543','supplier',NULL,'active','2026-08-25 07:10:29','2026-08-25 07:10:29','$2y$12$n0IY/TV.p6PTD.D8cG4cyuTpZLjDgmi5GRESSRqGnCSjSKkQptAw6',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29',NULL),(8,'Hiren Shah','supplier3@nextrade.com','+91 98980 43210','supplier',NULL,'active','2026-08-25 07:10:29','2026-08-25 07:10:29','$2y$12$/v.AJqLeQRLugf/BEmOgm.G/B3ENOncg6.BUOzKOjJyUMDOlkl3Ju',NULL,'2026-08-25 07:10:29','2026-08-25 07:10:29',NULL),(9,'Dr. K. S. Reddy','supplier4@nextrade.com','+91 99490 87654','supplier',NULL,'active','2026-08-25 07:10:30','2026-08-25 07:10:30','$2y$12$WytKX2BPX/xDaIX68BtX..uj6NX.93QA1eWqP5EQkQCwz9fFrcRjC',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(10,'Mahesh Agarwal','supplier5@nextrade.com','+91 98220 54321','supplier',NULL,'active','2026-08-25 07:10:30','2026-08-25 07:10:30','$2y$12$gDFmL09hLygWUEpZbGSyTue8pHt5ki.H1Qj448sXkfCI5XuVuFD8q',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL),(11,'Paresh Mehta','supplier6@nextrade.com','+91 98241 65432','supplier',NULL,'active','2026-08-25 07:10:30','2026-08-25 07:10:30','$2y$12$XfTZOv14QYHkziElJXe.PuAilbcMjYpP.111odgrvEDaskFaPCYeW',NULL,'2026-08-25 07:10:30','2026-08-25 07:10:30',NULL);
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

-- Dump completed on 2026-08-25 18:37:01
