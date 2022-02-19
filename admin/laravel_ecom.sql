-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2021 at 02:14 PM
-- Server version: 8.0.20-0ubuntu0.20.04.1
-- PHP Version: 7.2.31-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `is_filterable` tinyint(1) NOT NULL DEFAULT '0',
  `is_configurable` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `code`, `name`, `type`, `validation`, `is_required`, `is_unique`, `is_filterable`, `is_configurable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'size', 'Size', 'select', NULL, 0, 0, 1, 1, 1, NULL, '2021-05-08 00:55:59', '2021-05-08 00:55:59'),
(4, 'color', 'Color', 'select', NULL, 0, 0, 1, 1, 1, NULL, '2021-05-08 00:56:52', '2021-05-08 00:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attribute_id`, `name`, `created_at`, `updated_at`) VALUES
(5, 3, 'S', '2021-05-08 00:56:09', '2021-05-08 00:56:09'),
(6, 3, 'M', '2021-05-08 00:56:16', '2021-05-08 00:56:16'),
(7, 3, 'L', '2021-05-08 00:56:20', '2021-05-08 00:56:20'),
(8, 3, 'XL', '2021-05-08 00:56:25', '2021-05-08 00:56:25'),
(9, 3, 'XXL', '2021-05-08 00:56:30', '2021-05-08 00:56:30'),
(10, 4, 'Red', '2021-05-08 00:57:13', '2021-05-08 00:57:13'),
(11, 4, 'Green', '2021-05-08 00:57:18', '2021-05-08 00:57:18'),
(12, 4, 'Blue', '2021-05-08 00:57:22', '2021-05-08 00:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Pakaian Pria', 'pakaian-pria', NULL, 1, NULL, '2021-04-24 01:57:36', '2021-04-24 01:57:36'),
(2, 'Pakaian Wanita', 'pakaian-wanita', NULL, 1, NULL, '2021-04-24 01:57:44', '2021-04-24 01:57:44'),
(3, 'Kemeja', 'kemeja', 1, 1, NULL, '2021-04-24 01:57:57', '2021-04-24 01:57:57'),
(4, 'Daster', 'daster', 2, 1, NULL, '2021-04-24 01:58:27', '2021-04-24 01:58:27'),
(5, 'Kemeja Batik', 'kemeja-batik', 3, 1, NULL, '2021-04-24 01:59:19', '2021-04-24 01:59:19'),
(6, 'Kemeja Kerah', 'kemeja-kerah', 3, 1, NULL, '2021-04-24 01:59:31', '2021-04-24 01:59:31'),
(7, 'Muslim Pria', 'muslim-pria', 1, 1, NULL, '2021-04-24 02:00:46', '2021-04-24 02:00:46'),
(8, 'Gamis', 'gamis', 7, 1, NULL, '2021-04-24 02:01:05', '2021-04-24 02:01:05'),
(9, 'Koko', 'koko', 7, 1, 1, '2021-04-24 02:01:15', '2021-04-24 02:05:41'),
(10, 'Peci', 'peci', 7, 1, NULL, '2021-04-24 02:01:25', '2021-04-24 02:01:25'),
(11, 'Sarung', 'sarung', 7, 1, NULL, '2021-04-24 02:01:33', '2021-04-24 02:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_22_081440_create_categories_table', 1),
(5, '2021_04_23_034959_create_products_table', 1),
(6, '2021_04_24_044232_create_attributes_table', 1),
(7, '2021_04_24_044555_create_product_attribute_values_table', 1),
(8, '2021_04_24_044856_create_product_inventories_table', 1),
(9, '2021_04_24_045031_create_product_categories_table', 1),
(10, '2021_04_24_074540_create_product_images_tabel', 1),
(11, '2021_04_25_135927_create_attribute_options_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `parent_id`, `user_id`, `sku`, `type`, `name`, `slug`, `price`, `weight`, `width`, `height`, `length`, `short_description`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(2, NULL, 1, 'A2104250001', 'simple', 'Koko Kurta', 'koko-kurta', '150000.00', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2021-04-25 08:04:14', '2021-04-25 08:04:14', 1),
(5, NULL, 1, 'A2104250002', 'configurable', 'Koko Kurta Pendek', 'koko-kurta-pendek', '150000.00', '10.00', '10.00', '10.00', '10.00', 'short_description', 'description', 1, NULL, '2021-04-25 08:15:42', '2021-04-25 08:15:42', 2),
(6, NULL, 1, 'A2104250003', 'simple', 'Batik Kerah Katun', 'batik-kerah-katun', '80000.00', '10.00', '10.00', '10.00', '10.00', 'short_description', 'description', 1, NULL, '2021-04-25 08:21:19', '2021-04-25 08:21:19', 1),
(8, NULL, 1, 'A2104250005', 'simple', 'Cealana Dalam', 'cealana-dalam', '150000.00', '1.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-08 09:09:48', '2021-05-08 09:09:48', 1),
(9, NULL, 1, 'A2104250006', 'configurable', 'Legin Wanita', 'legin-wanita', '80000.00', '1.00', '1.00', '1.00', '1.00', 'short_description', 'description', 1, NULL, '2021-05-08 09:13:12', '2021-05-08 09:13:12', 1),
(11, NULL, 1, 'A2104250007', 'configurable', 'Jaket DF', 'jaket-df', '300000.00', '1.00', '1.00', '1.00', '1.00', 'short_description', 'description', 1, NULL, '2021-05-08 09:24:44', '2021-05-08 09:24:44', 1),
(12, NULL, 1, 'A2104250008', 'configurable', 'Jaket 2', 'jaket-2', '2000.00', '1.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-08 09:26:18', '2021-05-08 09:26:18', 1),
(13, NULL, 1, 'A2104250009', 'configurable', 'jgkj', 'jgkj', '110000.00', '1.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-08 19:41:40', '2021-05-08 19:41:40', 1),
(14, NULL, 1, 'A2104250010', 'configurable', 'nnkjn', 'nnkjn', '110000.00', '1.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-08 19:50:19', '2021-05-08 19:50:19', 3),
(21, NULL, 1, 'sa', 'configurable', 'd', 'd', '150000.00', '1.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18', 2),
(22, 21, 1, 'sa-5-10', 'simple', 'd - S - Red', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 08:02:53', 2),
(23, 21, 1, 'sa-5-11', 'simple', 'd - S - Green', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 08:02:53', 2),
(24, 21, 1, 'sa-5-12', 'simple', 'd - S - Blue', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 07:39:52', 2),
(25, 21, 1, 'sa-6-10', 'simple', 'd - M - Red', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 07:39:52', 2),
(26, 21, 1, 'sa-6-11', 'simple', 'd - M - Green', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 07:39:52', 2),
(27, 21, 1, 'sa-6-12', 'simple', 'd - M - Blue', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 07:39:52', 2),
(28, 21, 1, 'sa-7-10', 'simple', 'd - L - Red', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 07:39:52', 2),
(29, 21, 1, 'sa-7-11', 'simple', 'd - L - Green', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-08 20:53:18', '2021-05-09 07:39:52', 2),
(30, 21, 1, 'sa-7-12', 'simple', 'd - L - Blue', 'd-l-blue', '10.00', '1.00', NULL, NULL, NULL, 'short_description', 'description', 1, 1, '2021-05-08 20:53:18', '2021-05-09 08:09:06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `text_value` text COLLATE utf8mb4_unicode_ci,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int DEFAULT NULL,
  `float_value` decimal(8,2) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `json_value` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `product_id`, `attribute_id`, `text_value`, `boolean_value`, `integer_value`, `float_value`, `datetime_value`, `date_value`, `json_value`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 22, 3, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(2, 22, 4, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(3, 23, 3, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(4, 23, 4, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(5, 24, 3, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(6, 24, 4, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(7, 25, 3, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(8, 25, 4, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(9, 26, 3, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(10, 26, 4, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(11, 27, 3, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(12, 27, 4, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(13, 28, 3, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(14, 28, 4, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(15, 29, 3, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(16, 29, 4, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(17, 30, 3, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18'),
(18, 30, 4, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-08 20:53:18', '2021-05-08 20:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 8, NULL, NULL, NULL, NULL),
(2, 2, 9, NULL, NULL, NULL, NULL),
(5, 6, 1, NULL, NULL, NULL, NULL),
(6, 6, 3, NULL, NULL, NULL, NULL),
(7, 6, 5, NULL, NULL, NULL, NULL),
(8, 8, 1, NULL, NULL, NULL, NULL),
(9, 9, 2, NULL, NULL, NULL, NULL),
(11, 11, 1, NULL, NULL, NULL, NULL),
(12, 12, 1, NULL, NULL, NULL, NULL),
(13, 13, 4, NULL, NULL, NULL, NULL),
(14, 14, 3, NULL, NULL, NULL, NULL),
(21, 21, 3, NULL, NULL, NULL, NULL),
(22, 21, 5, NULL, NULL, NULL, NULL),
(23, 22, 3, NULL, NULL, NULL, NULL),
(24, 22, 5, NULL, NULL, NULL, NULL),
(25, 23, 3, NULL, NULL, NULL, NULL),
(26, 23, 5, NULL, NULL, NULL, NULL),
(27, 24, 3, NULL, NULL, NULL, NULL),
(28, 24, 5, NULL, NULL, NULL, NULL),
(29, 25, 3, NULL, NULL, NULL, NULL),
(30, 25, 5, NULL, NULL, NULL, NULL),
(31, 26, 3, NULL, NULL, NULL, NULL),
(32, 26, 5, NULL, NULL, NULL, NULL),
(33, 27, 3, NULL, NULL, NULL, NULL),
(34, 27, 5, NULL, NULL, NULL, NULL),
(35, 28, 3, NULL, NULL, NULL, NULL),
(36, 28, 5, NULL, NULL, NULL, NULL),
(37, 29, 3, NULL, NULL, NULL, NULL),
(38, 29, 5, NULL, NULL, NULL, NULL),
(39, 30, 3, NULL, NULL, NULL, NULL),
(40, 30, 5, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_inventories`
--

CREATE TABLE `product_inventories` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_inventories`
--

INSERT INTO `product_inventories` (`id`, `product_id`, `qty`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 22, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 08:02:53'),
(4, 23, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 08:02:53'),
(5, 24, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 07:39:52'),
(6, 25, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 07:39:52'),
(7, 26, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 07:39:52'),
(8, 27, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 07:39:52'),
(9, 28, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 07:39:52'),
(10, 29, NULL, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 07:39:52'),
(11, 30, 5, NULL, NULL, '2021-05-09 07:39:52', '2021-05-09 08:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'mail', 'admin', 'admin@mail.com', '2021-04-25 07:08:19', '$2y$10$bcN6G1KV2BB4I8qO22.dvuhwcH2jeDt/eBiAmLJeIW.eUXRe1cFqy', NULL, '2021-04-25 07:08:19', NULL),
(2, 'user', 'mail', 'user', 'user@mail.com', '2021-04-25 07:08:19', '$2y$10$sKPCyNJOL4MsHBfNTZoyHOsogfW0AJqreXPj3rE7sPz1UUsPj0AAS', NULL, '2021-04-25 07:08:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_options_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_parent_id_foreign` (`parent_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_values_product_id_foreign` (`product_id`),
  ADD KEY `product_attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_inventories_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD CONSTRAINT `product_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
