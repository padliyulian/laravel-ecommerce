-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2021 at 08:14 AM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.18

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
(1, 'color', 'Color', 'select', NULL, 0, 0, 1, 1, 2, NULL, '2021-07-13 08:05:14', '2021-07-13 08:05:14'),
(2, 'size', 'Size', 'select', NULL, 0, 0, 1, 1, 2, NULL, '2021-07-13 08:06:27', '2021-07-13 08:06:27');

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
(1, 2, 'S', '2021-07-13 08:07:05', '2021-07-13 08:07:05'),
(2, 2, 'M', '2021-07-13 08:07:10', '2021-07-13 08:07:10'),
(3, 2, 'L', '2021-07-13 08:07:13', '2021-07-13 08:07:13'),
(4, 2, 'XL', '2021-07-13 08:07:17', '2021-07-13 08:07:17'),
(5, 1, 'Red', '2021-07-13 08:07:31', '2021-07-13 08:07:31'),
(6, 1, 'Green', '2021-07-13 08:07:36', '2021-07-13 08:07:36'),
(7, 1, 'Blue', '2021-07-13 08:07:43', '2021-07-13 08:07:43'),
(8, 1, 'Gray', '2021-07-13 08:07:48', '2021-07-13 08:07:48');

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
(1, 'Pria', 'pria', NULL, 2, NULL, '2021-07-13 08:02:44', '2021-07-13 08:02:44'),
(2, 'Wanita', 'wanita', NULL, 2, NULL, '2021-07-13 08:02:50', '2021-07-13 08:02:50'),
(3, 'Pakaian Pria', 'pakaian-pria', 1, 2, 2, '2021-07-13 08:03:03', '2021-07-13 08:03:27'),
(4, 'Pakaian Wanita', 'pakaian-wanita', 2, 2, 2, '2021-07-13 08:03:13', '2021-07-13 08:03:20');

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
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
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
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_resets_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_09_10_143135_create_permission_tables', 1),
(25, '2020_05_11_163514_create_jobs_table', 1),
(26, '2021_04_22_081440_create_categories_table', 1),
(27, '2021_04_23_034959_create_products_table', 1),
(28, '2021_04_24_044232_create_attributes_table', 1),
(29, '2021_04_24_044555_create_product_attribute_values_table', 1),
(30, '2021_04_24_044856_create_product_inventories_table', 1),
(31, '2021_04_24_045031_create_product_categories_table', 1),
(32, '2021_04_24_074540_create_product_images_tabel', 1),
(33, '2021_04_25_135927_create_attribute_options_table', 1),
(34, '2021_05_23_055705_create_orders_table', 1),
(35, '2021_05_23_055816_create_order_items_table', 1),
(36, '2021_05_23_055902_create_payments_table', 1),
(37, '2021_05_23_055955_create_shipments_table', 1),
(38, '2021_06_12_140547_create_favorites_table', 1),
(39, '2021_06_13_055844_create_slides_table', 1),
(40, '2021_06_26_031449_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_due` datetime NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_total_price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax_percent` decimal(16,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `discount_percent` decimal(16,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` decimal(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(16,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `customer_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_city_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_province_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_postcode` int DEFAULT NULL,
  `shipping_courier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `cancelled_by` bigint UNSIGNED DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `cancellation_note` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `base_price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `base_total` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax_percent` decimal(16,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `discount_percent` decimal(16,2) NOT NULL DEFAULT '0.00',
  `sub_total` decimal(16,2) NOT NULL DEFAULT '0.00',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attributes` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payloads` json DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `va_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biller_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_users', 'web', '2021-07-13 07:28:56', '2021-07-13 07:28:56'),
(2, 'add_users', 'web', '2021-07-13 07:28:56', '2021-07-13 07:28:56'),
(3, 'edit_users', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(4, 'delete_users', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(5, 'view_roles', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(6, 'add_roles', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(7, 'edit_roles', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(8, 'delete_roles', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(9, 'view_products', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(10, 'add_products', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(11, 'edit_products', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(12, 'delete_products', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(13, 'view_orders', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(14, 'add_orders', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(15, 'edit_orders', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(16, 'delete_orders', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(17, 'view_categories', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(18, 'add_categories', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(19, 'edit_categories', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(20, 'delete_categories', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(21, 'view_attributes', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(22, 'add_attributes', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(23, 'edit_attributes', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(24, 'delete_attributes', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(25, 'view_shipments', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(26, 'add_shipments', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(27, 'edit_shipments', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(28, 'delete_shipments', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(29, 'view_slides', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(30, 'add_slides', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(31, 'edit_slides', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57'),
(32, 'delete_slides', 'web', '2021-07-13 07:28:57', '2021-07-13 07:28:57');

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
(1, NULL, 2, 'A2104250001', 'simple', 'Nike Air Jordan 12 Retro', 'nike-air-jordan-12-retro', '1700000.00', '700.00', NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 2, NULL, '2021-07-13 08:09:06', '2021-07-13 08:09:06', 2),
(2, NULL, 2, 'A2104250002', 'simple', 'Jersey Basket Lakers', 'jersey-basket-lakers', '500000.00', '400.00', NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 2, NULL, '2021-07-13 08:10:57', '2021-07-13 08:10:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_product_id` bigint UNSIGNED DEFAULT NULL,
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
(1, 1, 1, NULL, NULL, NULL, NULL),
(2, 1, 3, NULL, NULL, NULL, NULL),
(3, 2, 1, NULL, NULL, NULL, NULL),
(4, 2, 3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_large` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `large` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `path`, `extra_large`, `large`, `medium`, `small`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/images/nike-air-jordan-12-retro_1626163787.jpeg', '/uploads/images/xlarge/nike-air-jordan-12-retro_1626163787.jpeg', '/uploads/images/large/nike-air-jordan-12-retro_1626163787.jpeg', '/uploads/images/medium/nike-air-jordan-12-retro_1626163787.jpeg', '/uploads/images/small/nike-air-jordan-12-retro_1626163787.jpeg', 2, NULL, '2021-07-13 08:09:48', '2021-07-13 08:09:48'),
(2, 1, 'uploads/images/nike-air-jordan-12-retro_1626163801.jpeg', '/uploads/images/xlarge/nike-air-jordan-12-retro_1626163801.jpeg', '/uploads/images/large/nike-air-jordan-12-retro_1626163801.jpeg', '/uploads/images/medium/nike-air-jordan-12-retro_1626163801.jpeg', '/uploads/images/small/nike-air-jordan-12-retro_1626163801.jpeg', 2, NULL, '2021-07-13 08:10:01', '2021-07-13 08:10:01'),
(3, 1, 'uploads/images/nike-air-jordan-12-retro_1626163817.jpg', '/uploads/images/xlarge/nike-air-jordan-12-retro_1626163817.jpg', '/uploads/images/large/nike-air-jordan-12-retro_1626163817.jpg', '/uploads/images/medium/nike-air-jordan-12-retro_1626163817.jpg', '/uploads/images/small/nike-air-jordan-12-retro_1626163817.jpg', 2, NULL, '2021-07-13 08:10:17', '2021-07-13 08:10:17'),
(4, 2, 'uploads/images/jersey-basket-lakers_1626163895.jpg', '/uploads/images/xlarge/jersey-basket-lakers_1626163895.jpg', '/uploads/images/large/jersey-basket-lakers_1626163895.jpg', '/uploads/images/medium/jersey-basket-lakers_1626163895.jpg', '/uploads/images/small/jersey-basket-lakers_1626163895.jpg', 2, NULL, '2021-07-13 08:11:36', '2021-07-13 08:11:36'),
(5, 2, 'uploads/images/jersey-basket-lakers_1626163903.png', '/uploads/images/xlarge/jersey-basket-lakers_1626163903.png', '/uploads/images/large/jersey-basket-lakers_1626163903.png', '/uploads/images/medium/jersey-basket-lakers_1626163903.png', '/uploads/images/small/jersey-basket-lakers_1626163903.png', 2, NULL, '2021-07-13 08:11:44', '2021-07-13 08:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventories`
--

CREATE TABLE `product_inventories` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-07-13 07:29:37', '2021-07-13 07:29:37'),
(2, 'Seler', 'web', '2021-07-13 07:29:38', '2021-07-13 07:29:38'),
(3, 'Buyer', 'web', '2021-07-13 07:29:38', '2021-07-13 07:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(1, 2),
(5, 2),
(9, 2),
(13, 2),
(17, 2),
(21, 2),
(25, 2),
(29, 2),
(1, 3),
(5, 3),
(9, 3),
(13, 3),
(17, 3),
(21, 3),
(25, 3),
(29, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('masnTbbZlJfXpM78VsgShqrWvTY0dPINIK7NXU4K', 2, '192.168.10.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV05tTHc1R2FlQ0NheWlSYU9pT1hYeHh5QklGQ1IyM1E0RzFVdTRSdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9zZWxlci5lY29tLnRlc3QvcHJvZHVjdC9pbWFnZS8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjc6InN1Y2Nlc3MiO2E6MDp7fX0=', 1626163904),
('ZAJeeNb78B90G9S2OgwaOoxxEzTCgU1K5DECkWR3', NULL, '192.168.10.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM00zb21vZ1JYZzhUeGVURzQ1STVLcDFkZDBZTHVYYk1NYWl1Z2xpSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9lY29tLnRlc3QiO319', 1626164052);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `track_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_qty` int NOT NULL,
  `total_weight` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `shipped_by` bigint UNSIGNED DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `original` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_large` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `user_id`, `title`, `url`, `position`, `status`, `body`, `original`, `extra_large`, `small`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nike Air Jordan Retro', 'product/nike-air-jordan-12-retro', 1, 'active', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'uploads/images/slider/original/nike-air-jordan-retro_1626161795.jpeg', '/uploads/images/slider/xlarge/nike-air-jordan-retro_1626161795.jpeg', '/uploads/images/slider/small/nike-air-jordan-retro_1626161795.jpeg', '2021-07-13 07:36:36', '2021-07-13 08:12:19'),
(2, 1, 'IKEA Furniture', '#', 2, 'active', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'uploads/images/slider/original/ikea-furniture_1626161902.jpg', '/uploads/images/slider/xlarge/ikea-furniture_1626161902.jpg', '/uploads/images/slider/small/ikea-furniture_1626161902.jpg', '2021-07-13 07:38:22', '2021-07-13 07:38:22'),
(3, 1, 'Jersey Basket Lakers', 'product/jersey-basket-lakers', 3, 'active', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'uploads/images/slider/original/jersey-basket-lakers_1626161968.png', '/uploads/images/slider/xlarge/jersey-basket-lakers_1626161968.png', '/uploads/images/slider/small/jersey-basket-lakers_1626161968.png', '2021-07-13 07:39:28', '2021-07-13 08:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `company`, `address1`, `address2`, `province_id`, `city_id`, `postcode`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'mail', 'admin', 'admin@mail.com', NULL, '2021-07-13 07:29:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3jNSl4wM2x', NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 07:29:38', '2021-07-13 07:29:38'),
(2, 'seler', 'mail', 'seler', 'seler@mail.com', NULL, '2021-07-13 07:29:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xUbYZIccAM', NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 07:29:38', '2021-07-13 07:29:38'),
(3, 'buyer', 'mail', 'buyer', 'buyer@mail.com', NULL, '2021-07-13 07:29:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BRYkUIeEJK', NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-13 07:29:38', '2021-07-13 07:29:38');

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
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`),
  ADD KEY `favorites_user_id_product_id_index` (`user_id`,`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_code_unique` (`code`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_approved_by_foreign` (`approved_by`),
  ADD KEY `orders_cancelled_by_foreign` (`cancelled_by`),
  ADD KEY `orders_code_index` (`code`),
  ADD KEY `orders_code_order_date_index` (`code`,`order_date`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_sku_index` (`sku`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_number_unique` (`number`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_number_index` (`number`),
  ADD KEY `payments_method_index` (`method`),
  ADD KEY `payments_token_index` (`token`),
  ADD KEY `payments_payment_type_index` (`payment_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_parent_id_foreign` (`parent_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `search` (`name`,`slug`,`short_description`,`description`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_values_parent_product_id_foreign` (`parent_product_id`),
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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_user_id_foreign` (`user_id`),
  ADD KEY `shipments_order_id_foreign` (`order_id`),
  ADD KEY `shipments_shipped_by_foreign` (`shipped_by`),
  ADD KEY `shipments_track_number_index` (`track_number`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slides_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

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
  ADD CONSTRAINT `product_attribute_values_parent_product_id_foreign` FOREIGN KEY (`parent_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
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

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `shipments_shipped_by_foreign` FOREIGN KEY (`shipped_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `slides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
