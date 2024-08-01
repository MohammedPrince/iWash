-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2024 at 02:53 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_29_061058_create_tbl_services_table', 1),
(6, '2024_07_29_061059_create_tbl_payment_provider_table', 1),
(7, '2024_07_29_061101_create_tbl_offers_table', 1),
(8, '2024_07_29_061102_create_tbl_vehicles_table', 1),
(9, '2024_07_29_061103_create_tbl_service_booking_tracking_table', 1),
(10, '2024_07_29_061104_create_tbl_service_provider_rating_table', 1),
(11, '2024_07_29_061105_create_tbl_v_models_table', 1),
(12, '2024_07_29_061106_create_tbl_colors_table', 1),
(13, '2024_07_29_061107_create_tbl_service_provider_review_table', 1),
(14, '2024_07_29_061108_create_tbl_booking_table', 1),
(15, '2024_07_29_061109_create_tbl_service_booking_payment_table', 1),
(16, '2024_07_29_061110_create_tbl_roles_table', 1),
(17, '2024_07_29_061111_create_tbl_locations_table', 1),
(18, '2024_07_29_061112_create_tbl_reviews_rating_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '0684b8e805281918a028b9d543a36dba6a086f6a0ca3d1436a6bd10f651ee390', '[\"*\"]', NULL, NULL, '2024-07-30 06:58:53', '2024-07-30 06:58:53'),
(2, 'App\\Models\\User', 1, 'auth_token', 'b6e5f5362bf7e4fc7c29cb3fdda377fe2d39480f0bc15f47637c5d971b0d03d1', '[\"*\"]', NULL, NULL, '2024-07-30 07:00:46', '2024-07-30 07:00:46'),
(3, 'App\\Models\\User', 1, 'auth_token', '566869ea3e627bdafcb3475cbd0480b75f5f3fb114355846640abed36512e539', '[\"*\"]', '2024-07-31 08:03:22', NULL, '2024-07-30 07:01:17', '2024-07-31 08:03:22'),
(4, 'App\\Models\\User', 2, 'auth_token', '20c1fac3f8ad3a9054293810496e3ac9694d1c92ff049df486d4ddfa5077b21f', '[\"*\"]', NULL, NULL, '2024-07-30 07:07:03', '2024-07-30 07:07:03'),
(5, 'App\\Models\\User', 3, 'auth_token', 'de6f569812b9e2409b65c5df450629d790434509abd7196faf8f90c3ffeeaa01', '[\"*\"]', NULL, NULL, '2024-07-30 07:09:43', '2024-07-30 07:09:43'),
(6, 'App\\Models\\User', 1, 'auth_token', '905987356082445f1668fe3c4bcf660b9f76adc8435fcd03581d43143f8cbba1', '[\"*\"]', '2024-07-30 12:31:39', NULL, '2024-07-30 12:25:23', '2024-07-30 12:31:39'),
(7, 'App\\Models\\User', 1, 'auth_token', '123c381206a339b17088920d63e20ff361d876a5752db6fa5176bbb7614ea79a', '[\"*\"]', NULL, NULL, '2024-07-30 12:36:39', '2024-07-30 12:36:39'),
(8, 'App\\Models\\User', 5, 'auth_token', '34abb7984d4e93ade4143a3f3e0a27a1bc88292df5c3b12ca9df2c4c2c0ab9e6', '[\"*\"]', '2024-07-31 01:27:33', NULL, '2024-07-30 12:40:10', '2024-07-31 01:27:33'),
(9, 'App\\Models\\User', 5, 'auth_token', '5b90e8727151bf3cd81e720a5c317e5608ef5b0417676455596b6128924d0076', '[\"*\"]', '2024-07-31 01:32:30', NULL, '2024-07-31 01:28:40', '2024-07-31 01:32:30'),
(10, 'App\\Models\\User', 5, 'auth_token', '36b92a3ab7c9df1885decd3eeaca2a8ffe217a694d5088f5d3157e3be36d39f0', '[\"*\"]', '2024-07-31 01:42:43', NULL, '2024-07-31 01:33:14', '2024-07-31 01:42:43'),
(11, 'App\\Models\\User', 5, 'auth_token', 'a021ea600a75b0e3e8865a71876f2d13a3b3a9b1f0c73486d1222e19202d45cf', '[\"*\"]', '2024-07-31 01:45:25', NULL, '2024-07-31 01:42:58', '2024-07-31 01:45:25'),
(12, 'App\\Models\\User', 5, 'auth_token', 'c226d4bf9645570189902eb1fcdba5f102cb3f34958f7d26ea3e0fd02017a70c', '[\"*\"]', '2024-07-31 01:52:15', NULL, '2024-07-31 01:45:34', '2024-07-31 01:52:15'),
(13, 'App\\Models\\User', 5, 'auth_token', '71b49c6055950fdccb973b6ec9548fe09adc2a33896a4c43573eb75d3717816d', '[\"*\"]', '2024-07-31 02:04:11', NULL, '2024-07-31 01:52:38', '2024-07-31 02:04:11'),
(14, 'App\\Models\\User', 5, 'auth_token', '41ae707b1b6f793b3b8417d3fd3c324aee8b472cf243a62320c06b202b1d6d63', '[\"*\"]', NULL, NULL, '2024-07-31 02:04:20', '2024-07-31 02:04:20'),
(15, 'App\\Models\\User', 5, 'auth_token', 'eceaaf2944bd491771d6c0e172d42a4f5461e1f828c7e00f81294c27632d5ddb', '[\"*\"]', '2024-08-01 09:04:14', NULL, '2024-07-31 03:32:15', '2024-08-01 09:04:14'),
(16, 'App\\Models\\User', 6, 'auth_token', '4c94f5ebdee32ae93fd0476fa1f56701293136bec960941491bb50ad647f8bd0', '[\"*\"]', NULL, NULL, '2024-07-31 12:33:34', '2024-07-31 12:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

DROP TABLE IF EXISTS `tbl_booking`;
CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT 'Foreignkeyto`users`table, identifyingcustomer',
  `service_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `service_provider_id` int NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `booking_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` date NOT NULL,
  `user_note` longtext COLLATE utf8mb4_unicode_ci,
  `service_provider_note` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','confirmed','declined','canceled','blocked','deleted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending,confirmed,declined,canceled,blocked,deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `user_id`, `service_id`, `vehicle_id`, `service_provider_id`, `start_date`, `booking_time`, `end_date`, `user_note`, `service_provider_note`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 1, 1, 2, 8, '2024-07-31', '05:30Pm', '2024-08-01', 'Please make sure to wash it perfectlly, thank you !', NULL, 'confirmed', '2024-08-01 07:50:29', '2024-08-01 07:50:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colors`
--

DROP TABLE IF EXISTS `tbl_colors`;
CREATE TABLE IF NOT EXISTS `tbl_colors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_colors`
--

INSERT INTO `tbl_colors` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Red', 'active', 1, '2024-07-30 13:33:01', '2024-07-31 04:40:29', '2024-07-31 04:40:29'),
(2, 'Blue', 'active', 1, '2024-07-30 13:33:01', '2024-07-30 13:33:01', '2024-07-30 13:33:01'),
(3, 'Green', 'active', 1, '2024-07-30 13:33:01', '2024-07-30 13:33:01', '2024-07-30 13:33:01'),
(4, 'White', 'active', 1, '2024-07-30 13:33:01', '2024-07-30 13:33:01', '2024-07-30 13:33:01'),
(5, 'Black', 'active', 1, '2024-07-30 13:33:01', '2024-07-30 13:33:01', '2024-07-30 13:33:01'),
(6, 'Yellow', 'active', 0, '2024-07-31 04:16:56', '2024-07-31 04:34:25', '2024-07-31 08:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

DROP TABLE IF EXISTS `tbl_locations`;
CREATE TABLE IF NOT EXISTS `tbl_locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT 'Foreignkeyto`users`table, identifyingcustomer',
  `latitude` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` int NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_locations`
--

INSERT INTO `tbl_locations` (`id`, `user_id`, `latitude`, `longitude`, `address`, `city`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '24.9978543', '55.1701887', 'Dubai,DIP,Bayan Building', 0, 'active', '2024-07-31 13:48:10', '2024-07-31 13:48:10', '2024-07-31 13:48:10'),
(2, 3, '24.9865589', '55.159907', 'Dubai,DIP,Dubai Investment Park', 0, 'active', '2024-07-31 13:48:10', '2024-07-31 13:48:10', '2024-07-31 13:48:10'),
(3, 4, '24.3782629', '54.6732559', 'AlShamkhah, Abu Dhabi', 0, 'active', '2024-07-31 13:48:10', '2024-07-31 13:48:10', '2024-07-31 13:48:10'),
(4, 7, '24.9722357', '55.1719165', 'Dubai,DIP,Hard Precast Building Systems', 0, 'active', '2024-07-31 13:48:10', '2024-07-31 13:48:10', '2024-07-31 13:48:10'),
(5, 8, '24.9865589', '55.159907', 'Dubai,DIP,Dubai Investment Park', 0, 'active', '2024-07-31 13:48:10', '2024-07-31 13:48:10', '2024-07-31 13:48:10'),
(6, 9, '25.4123003', '55.5040009', 'Ajman, Ajman UNI', 0, 'active', '2024-07-31 13:48:10', '2024-07-31 13:48:10', '2024-07-31 13:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

DROP TABLE IF EXISTS `tbl_offers`;
CREATE TABLE IF NOT EXISTS `tbl_offers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` bigint NOT NULL DEFAULT '0',
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_offers`
--

INSERT INTO `tbl_offers` (`id`, `service_id`, `name`, `desc`, `discount`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Offer 1', 'Offer 1 desc', 5, 'active', 0, '2024-07-30 13:14:26', '2024-07-31 07:00:17', '2024-07-31 07:00:17'),
(2, 2, 'Offer 2', 'iWash offering you a free car wash !', 10, 'active', 0, '2024-07-30 13:14:42', '2024-07-30 13:14:42', '2024-07-30 13:14:42'),
(3, 2, 'Offer 3', 'iWash offering you a free car wash !', 15, 'active', 0, '2024-07-30 13:14:42', '2024-07-30 13:14:42', '2024-07-30 13:14:42'),
(4, 2, 'Offer 4', 'iWash offering you a free car wash !', 20, 'active', 0, '2024-07-30 13:14:42', '2024-07-30 13:14:42', '2024-07-30 13:14:42'),
(5, 11, 'from api', 'from api offer', 6, 'active', 0, '2024-07-31 06:26:21', '2024-07-31 06:26:21', '2024-07-31 10:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_provider`
--

DROP TABLE IF EXISTS `tbl_payment_provider`;
CREATE TABLE IF NOT EXISTS `tbl_payment_provider` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment_provider`
--

INSERT INTO `tbl_payment_provider` (`id`, `name`, `desc`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Stripe', 'Stripe paymwnt getway, best payment getway for payment', 'active', 0, '2024-07-31 07:30:50', '2024-07-31 08:03:40', '2024-07-31 08:03:40'),
(2, 'Stripe II', 'Stripe payment provider', 'deleted', 0, '2024-07-31 07:31:38', '2024-07-31 07:31:38', '2024-07-31 11:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews_rating`
--

DROP TABLE IF EXISTS `tbl_reviews_rating`;
CREATE TABLE IF NOT EXISTS `tbl_reviews_rating` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `review_count` int NOT NULL,
  `rating_value` double NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active' COMMENT 'active,inactive,blocked,deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `name`, `desc`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Admin Role', 'active', '2024-07-30 07:14:19', '2024-07-30 07:14:19', '2024-07-30 11:14:19'),
(2, 'Service Provider', 'Service Provider Role', 'active', '2024-07-30 07:14:37', '2024-07-30 07:14:37', '2024-07-30 11:14:37'),
(3, 'Service Admin', 'Service Admin Role', 'active', '2024-07-30 07:15:24', '2024-07-30 07:15:24', '2024-07-30 11:15:24'),
(4, 'Customer ', 'Customer Role', 'active', '2024-07-30 07:15:36', '2024-07-30 07:15:36', '2024-07-30 11:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

DROP TABLE IF EXISTS `tbl_services`;
CREATE TABLE IF NOT EXISTS `tbl_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Examples',
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `name`, `desc`, `price`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Car Wash', 'Car wash service', 100, 'active', 0, '2024-07-30 08:10:17', '2024-07-30 08:10:17', '2024-07-30 12:10:17'),
(2, 'Car Wax', 'Car Wax Service', 150, 'active', 0, '2024-07-30 08:11:40', '2024-07-30 08:26:48', '2024-07-30 12:11:40'),
(3, 'Fuel it', 'Fuel  it service', 500, 'active', 0, '2024-07-30 08:28:27', '2024-07-30 08:28:27', '2024-07-30 12:28:27'),
(4, 'Wax it', 'Wax it service from iWash', 150, 'active', 0, '2024-07-31 07:06:51', '2024-07-31 07:06:51', '2024-07-31 11:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_booking_payment`
--

DROP TABLE IF EXISTS `tbl_service_booking_payment`;
CREATE TABLE IF NOT EXISTS `tbl_service_booking_payment` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `service_provider_id` int NOT NULL,
  `payment_provider_id` int NOT NULL,
  `payment_transactintion_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date` datetime NOT NULL,
  `payment_status` enum('pending','received','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_booking_tracking`
--

DROP TABLE IF EXISTS `tbl_service_booking_tracking`;
CREATE TABLE IF NOT EXISTS `tbl_service_booking_tracking` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_provider_rating`
--

DROP TABLE IF EXISTS `tbl_service_provider_rating`;
CREATE TABLE IF NOT EXISTS `tbl_service_provider_rating` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_provider_id` int NOT NULL COMMENT 'service_provider_id from users table when role == servie provider',
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `rating` double NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_provider_review`
--

DROP TABLE IF EXISTS `tbl_service_provider_review`;
CREATE TABLE IF NOT EXISTS `tbl_service_provider_review` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_provider_id` int NOT NULL COMMENT 'from users table when role_id == service provider',
  `booking_id` int NOT NULL,
  `customer_id` int NOT NULL COMMENT 'Foreignkeyto`users`table, identifyingcustomer',
  `review_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `login_type` enum('mobile','email','google','apple') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mobile',
  `login_identity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','blocked','available','busy','deleted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `username`, `password`, `phone`, `email`, `email_verified_at`, `verified`, `image_url`, `role_id`, `login_type`, `login_identity`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mohammed', 'Abuelgassim', 'mohammed', '$2y$10$mT4f9KD3eaqAFxprdSQ8Q.0x.QF3tK7NecI/M3yeku8BlKCSo6oUq', '09165542211', 'mohammed.beng@email.com', NULL, 'YES', 'path/to/img', 1, 'mobile', 'login_identity', 'available', NULL, '2024-07-30 06:58:53', '2024-07-30 06:58:53', '2024-07-30 10:58:53'),
(3, 'Osman', 'Hamid', 'osso', '$2y$10$7gs8VG9jh6tqb4klq3Rvw.vAbOPgkOqEPjLvkNAw/BR2Yg.M4zOr2', '0916554412', 'osos@email.com', NULL, 'YES', 'path/to/img', 2, 'mobile', 'login_identity', 'available', NULL, '2024-07-30 07:09:43', '2024-07-30 07:09:43', '2024-07-30 11:09:43'),
(4, 'Mave', 'Reick', 'ody', '$2y$10$7gs8VG9jh6tqb4klq3Rvw.vAbOPgkOqEPjLvkNAw/BR2Yg.M4zOr2', '0916554412', 'osos@email.com', NULL, 'YES', 'path/to/img', 2, 'mobile', 'login_identity', 'available', NULL, '2024-07-30 07:09:43', '2024-07-30 07:09:43', '2024-07-30 11:09:43'),
(5, 'Mohamed', 'Prince', 'prince', '$2y$10$boBoIxynwpOUX4Y.oa2dG.1H/xiPWd.wcSZ9hqUagJ4jqRw8cH0K2', '0987654321', 'prince@email.com', NULL, 'YES', 'path/to/img', 1, 'mobile', 'login_identity', 'active', NULL, '2024-07-30 12:40:09', '2024-07-30 12:40:09', '2024-07-30 16:40:09'),
(6, 'Ali', 'Ahmed', 'Ali', '$2y$10$k/GafDfgG8fsciHQCqDb0eqe9ipte.FNsAzVxdzncsjT.XgMOKxiy', '0987654398', 'ali_ahmed@email.com', NULL, 'YES', 'path/to/img', 4, 'mobile', 'login_identity', 'active', NULL, '2024-07-31 12:33:34', '2024-07-31 12:33:34', '2024-07-31 16:33:34'),
(7, 'Test', 'Service', 'test_SPI', '$2y$10$k/GafDfgG8fsciHQCqDb0eqe9ipte.FNsAzVxdzncsjT.XgMOKxiy', '098700000', 'test_SPI@email.com', NULL, 'YES', 'path/to/img', 2, 'mobile', 'login_identity', 'available', NULL, '2024-07-31 12:33:34', '2024-08-01 07:38:38', '2024-07-31 16:33:34'),
(8, 'Test', 'Service II', 'test_SPII', '$2y$10$k/GafDfgG8fsciHQCqDb0eqe9ipte.FNsAzVxdzncsjT.XgMOKxiy', '09870000000', 'test_SPII@email.com', NULL, 'YES', 'path/to/img', 2, 'mobile', 'login_identity', 'busy', NULL, '2024-07-31 12:33:34', '2024-08-01 07:50:29', '2024-07-31 16:33:34'),
(9, 'Test', 'Service III', 'test_SPIII', '$2y$10$k/GafDfgG8fsciHQCqDb0eqe9ipte.FNsAzVxdzncsjT.XgMOKxiy', '09800000000', 'test_SPIII@email.com', NULL, 'YES', 'path/to/img', 2, 'mobile', 'login_identity', 'available', NULL, '2024-07-31 12:33:34', '2024-07-31 12:33:34', '2024-07-31 16:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

DROP TABLE IF EXISTS `tbl_vehicles`;
CREATE TABLE IF NOT EXISTS `tbl_vehicles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` int NOT NULL,
  `color_id` int NOT NULL,
  `plate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mfg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `make_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '2001',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`id`, `user_id`, `name`, `model_id`, `color_id`, `plate`, `mfg`, `status`, `make_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'my 1st car', 1, 1, 'Dubai 1863', 'none', 'active', '2015', '2024-07-30 10:18:23', '2024-07-30 10:18:23', '2024-07-30 14:18:23'),
(3, 1, 'my 2nd car', 2, 2, 'Dubai 1862', 'none', 'active', '2015', '2024-07-31 03:33:41', '2024-07-31 03:33:41', '2024-07-31 07:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_v_models`
--

DROP TABLE IF EXISTS `tbl_v_models`;
CREATE TABLE IF NOT EXISTS `tbl_v_models` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'path/to/img',
  `status` enum('active','inactive','blocked','deleted') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_by` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_v_models`
--

INSERT INTO `tbl_v_models` (`id`, `name`, `desc`, `image_url`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Toyota', 'Toyota', 'path/to/img', 'active', 1, '2024-07-30 13:49:49', '2024-07-31 06:08:08', '2024-07-31 06:08:08'),
(2, 'KIA', 'KIA', 'path/to/img', 'active', 1, '2024-07-30 13:50:03', '2024-07-30 13:50:03', '2024-07-30 13:50:03'),
(3, 'Mercedes', 'Mercedes Model', 'path/to/img', 'active', 1, '2024-07-30 13:50:03', '2024-07-31 06:03:32', '2024-07-30 13:50:03'),
(4, 'Mitsubishi', 'Mitsubishi', 'path/to/img', 'active', 1, '2024-07-30 13:50:03', '2024-07-30 13:50:03', '2024-07-30 13:50:03'),
(5, 'Honda', 'Honda Model', 'path/to/img', 'active', 0, '2024-07-31 04:57:21', '2024-07-31 04:57:21', '2024-07-31 08:57:21'),
(6, 'Hondai', 'Hondai Model', 'path/to/img', 'active', 0, '2024-07-31 05:14:45', '2024-07-31 05:14:45', '2024-07-31 09:14:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
