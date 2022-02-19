-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2021 at 05:48 AM
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
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'color', 'Color', 'select', NULL, 0, 0, 1, 1, 1, 1, '2021-05-15 01:00:34', '2021-05-15 01:02:48'),
(2, 'size', 'Size', 'select', NULL, 0, 0, 1, 1, 1, 1, '2021-05-15 01:01:26', '2021-05-15 01:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attribute_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Red', '2021-05-15 01:00:49', '2021-05-15 01:00:49'),
(2, 1, 'Green', '2021-05-15 01:00:53', '2021-05-15 01:00:53'),
(3, 1, 'Blue', '2021-05-15 01:00:57', '2021-05-15 01:00:57'),
(4, 2, 'S', '2021-05-15 01:01:36', '2021-05-15 01:01:36'),
(5, 2, 'M', '2021-05-15 01:01:40', '2021-05-15 01:01:40'),
(6, 2, 'L', '2021-05-15 01:01:44', '2021-05-15 01:01:44'),
(7, 2, 'XL', '2021-05-15 01:01:48', '2021-05-15 01:01:48'),
(8, 2, 'XXL', '2021-05-15 01:01:52', '2021-05-15 01:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Pakaian Pria', 'pakaian-pria', 0, 1, NULL, '2021-05-14 01:17:56', '2021-05-14 01:17:56'),
(2, 'Pakaian Wanita', 'pakaian-wanita', NULL, 1, NULL, '2021-05-14 01:18:09', '2021-05-14 01:18:09'),
(3, 'Muslim Pria', 'muslim-pria', 1, 1, 1, '2021-05-14 01:18:37', '2021-05-15 00:50:12'),
(6, 'Muslim Wanita', 'muslim-wanita', 2, 1, NULL, '2021-05-15 00:50:41', '2021-05-15 00:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'database', 'webEcom', '{\"displayName\":\"App\\\\Jobs\\\\SendMailOrderReceivedJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailOrderReceivedJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendMailOrderReceivedJob\\\":10:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:56;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:7:\\\"webEcom\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\Order]. in /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:479\nStack trace:\n#0 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(102): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(57): App\\Jobs\\SendMailOrderReceivedJob->restoreModel()\n#2 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(122): App\\Jobs\\SendMailOrderReceivedJob->getRestoredPropertyValue()\n#3 [internal function]: App\\Jobs\\SendMailOrderReceivedJob->__unserialize()\n#4 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(53): unserialize()\n#5 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call()\n#6 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#7 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(314): Illuminate\\Queue\\Worker->process()\n#8 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(134): Illuminate\\Queue\\Worker->runJob()\n#9 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\\Queue\\Worker->daemon()\n#10 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#11 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#12 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Container/Util.php(37): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Container/Container.php(590): Illuminate\\Container\\BoundMethod::call()\n#16 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Console/Command.php(134): Illuminate\\Container\\Container->call()\n#17 /home/vagrant/code/ecom/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute()\n#18 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#19 /home/vagrant/code/ecom/vendor/symfony/console/Application.php(1009): Illuminate\\Console\\Command->run()\n#20 /home/vagrant/code/ecom/vendor/symfony/console/Application.php(273): Symfony\\Component\\Console\\Application->doRunCommand()\n#21 /home/vagrant/code/ecom/vendor/symfony/console/Application.php(149): Symfony\\Component\\Console\\Application->doRun()\n#22 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run()\n#23 /home/vagrant/code/ecom/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(131): Illuminate\\Console\\Application->run()\n#24 /home/vagrant/code/ecom/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#25 {main}', '2021-05-28 09:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(6, 'webAdmin', '{\"displayName\":\"App\\\\Jobs\\\\SendMailOrderShipped\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailOrderShipped\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendMailOrderShipped\\\":9:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:28:\\\"Modules\\\\Order\\\\Entities\\\\Order\\\";s:2:\\\"id\\\";i:57;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:8:\\\"webAdmin\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1622906899, 1622906899),
(7, 'webEcom', '{\"displayName\":\"App\\\\Jobs\\\\SendMailOrderReceivedJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailOrderReceivedJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendMailOrderReceivedJob\\\":10:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:60;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:7:\\\"webEcom\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1622909469, 1622909469),
(8, 'webAdmin', '{\"displayName\":\"App\\\\Jobs\\\\SendMailOrderShipped\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailOrderShipped\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendMailOrderShipped\\\":9:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:28:\\\"Modules\\\\Order\\\\Entities\\\\Order\\\";s:2:\\\"id\\\";i:60;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:8:\\\"webAdmin\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1622909807, 1622909807),
(9, 'webEcom', '{\"displayName\":\"App\\\\Jobs\\\\SendMailOrderReceivedJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailOrderReceivedJob\",\"command\":\"O:33:\\\"App\\\\Jobs\\\\SendMailOrderReceivedJob\\\":10:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:61;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:7:\\\"webEcom\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1622910682, 1622910682),
(10, 'webAdmin', '{\"displayName\":\"App\\\\Jobs\\\\SendMailOrderShipped\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMailOrderShipped\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendMailOrderShipped\\\":9:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:28:\\\"Modules\\\\Order\\\\Entities\\\\Order\\\";s:2:\\\"id\\\";i:61;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:8:\\\"webAdmin\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1622910767, 1622910767);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(180, '2014_10_12_000000_create_users_table', 1),
(181, '2014_10_12_100000_create_password_resets_table', 1),
(182, '2019_08_19_000000_create_failed_jobs_table', 1),
(183, '2021_04_22_081440_create_categories_table', 1),
(184, '2021_04_23_034959_create_products_table', 1),
(185, '2021_04_24_044232_create_attributes_table', 1),
(186, '2021_04_24_044555_create_product_attribute_values_table', 1),
(187, '2021_04_24_044856_create_product_inventories_table', 1),
(188, '2021_04_24_045031_create_product_categories_table', 1),
(189, '2021_04_24_074540_create_product_images_tabel', 1),
(190, '2021_04_25_135927_create_attribute_options_table', 1),
(191, '2021_05_10_143135_create_permission_tables', 1),
(192, '2020_04_24_142324_add_parent_product_id_to_product_attribute_values_table', 2),
(193, '2020_05_03_154113_rename_column_and_add_columns_in_users_table', 3),
(194, '2020_05_09_163433_create_orders_table', 4),
(195, '2020_05_09_163816_create_order_items_table', 4),
(196, '2020_05_09_164011_create_payments_table', 4),
(197, '2020_05_09_164155_create_shipments_table', 4),
(198, '2020_05_11_163514_create_jobs_table', 5),
(199, '2020_05_15_155845_add_payment_token_to_orders_table', 6),
(200, '2020_05_15_155956_add_status_to_payments_table', 6),
(201, '2020_05_21_221514_add_columns_to_product_images_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_due` datetime NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_total_price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax_percent` decimal(16,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `discount_percent` decimal(16,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` decimal(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(16,2) NOT NULL DEFAULT '0.00',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `customer_company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_province_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_postcode` int DEFAULT NULL,
  `shipping_courier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `cancelled_by` bigint UNSIGNED DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `cancellation_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `code`, `status`, `order_date`, `payment_due`, `payment_status`, `payment_token`, `payment_url`, `base_total_price`, `tax_amount`, `tax_percent`, `discount_amount`, `discount_percent`, `shipping_cost`, `grand_total`, `note`, `customer_company`, `customer_first_name`, `customer_last_name`, `customer_address1`, `customer_address2`, `customer_phone`, `customer_email`, `customer_city_id`, `customer_province_id`, `customer_postcode`, `shipping_courier`, `shipping_service_name`, `approved_by`, `approved_at`, `cancelled_by`, `cancelled_at`, `cancellation_note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(57, 3, 'INV/20210528/V/XXVIII/00001', 'completed', '2021-05-28 16:09:03', '2021-06-04 16:09:03', 'paid', '8bb16438-e0e4-465d-8889-610d49c005e9', 'https://app.sandbox.midtrans.com/snap/v2/vtweb/8bb16438-e0e4-465d-8889-610d49c005e9', '200000.00', '20000.00', '10.00', '0.00', '0.00', '24000.00', '244000.00', NULL, NULL, 'Obit', 'Yulian', 'Jalan Dahlia 3 depan SMA 1 natar', NULL, '085268194028', 'obit@mail.com', '21', '18', 35362, 'tiki', 'TIKI - ECO', 1, '2021-06-05 15:28:21', NULL, NULL, NULL, NULL, '2021-05-28 09:09:03', '2021-06-05 15:28:21'),
(60, 3, 'INV/20210605/VI/V/00001', 'completed', '2021-06-05 16:11:08', '2021-06-12 16:11:08', 'paid', '72b74005-b541-49ab-8a9f-ebfa115f6e4c', 'https://app.sandbox.midtrans.com/snap/v2/vtweb/72b74005-b541-49ab-8a9f-ebfa115f6e4c', '200000.00', '20000.00', '10.00', '0.00', '0.00', '24000.00', '244000.00', NULL, NULL, 'Obit', 'Yulian', 'Jalan Dahlia 3 depan SMA 1 natar', NULL, '085268194028', 'obit@mail.com', '21', '18', 35362, 'tiki', 'TIKI - ECO', 1, '2021-06-05 16:16:49', NULL, NULL, NULL, NULL, '2021-06-05 16:11:08', '2021-06-05 16:16:49'),
(61, 3, 'INV/20210605/VI/V/00002', 'completed', '2021-06-05 16:31:21', '2021-06-12 16:31:21', 'paid', 'b2cf5e73-73ce-4d4f-ad69-562a9e8a348d', 'https://app.sandbox.midtrans.com/snap/v2/vtweb/b2cf5e73-73ce-4d4f-ad69-562a9e8a348d', '120000.00', '12000.00', '10.00', '0.00', '0.00', '24000.00', '156000.00', NULL, NULL, 'Obit', 'Yulian', 'Jalan Dahlia 3 depan SMA 1 natar', NULL, '085268194028', 'obit@mail.com', '21', '18', 35362, 'tiki', 'TIKI - ECO', 1, '2021-06-05 16:32:49', NULL, NULL, NULL, NULL, '2021-06-05 16:31:21', '2021-06-05 16:32:49');

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
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attributes` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `base_price`, `base_total`, `tax_amount`, `tax_percent`, `discount_amount`, `discount_percent`, `sub_total`, `sku`, `type`, `name`, `weight`, `attributes`, `created_at`, `updated_at`) VALUES
(48, 57, 14, 1, '200000.00', '200000.00', '0.00', '0.00', '0.00', '0.00', '200000.00', 'AT150520210002', 'simple', 'Gamis Pria', '100.00', '[]', '2021-05-28 09:09:03', '2021-05-28 09:09:03'),
(51, 60, 14, 1, '200000.00', '200000.00', '0.00', '0.00', '0.00', '0.00', '200000.00', 'AT150520210002', 'simple', 'Gamis Pria', '100.00', '[]', '2021-06-05 16:11:08', '2021-06-05 16:11:08'),
(52, 61, 12, 1, '120000.00', '120000.00', '0.00', '0.00', '0.00', '0.00', '120000.00', 'AT150520210001-3-6', 'configurable', 'Koko Kurta - Blue - L', '100.00', '{\"size\": \"L\", \"color\": \"Blue\"}', '2021-06-05 16:31:21', '2021-06-05 16:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payloads` json DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `va_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biller_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `number`, `amount`, `method`, `status`, `token`, `payloads`, `payment_type`, `va_number`, `vendor_name`, `biller_code`, `bill_key`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 57, 'PAY/20210528/V/XXVIII/00001', '244000.00', 'midtrans', 'pending', '4e43fa42-bfeb-4127-8e7f-776f26752bce', '{\"currency\": \"IDR\", \"order_id\": \"INV/20210528/V/XXVIII/00001\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"06316839444\"}], \"merchant_id\": \"G982406316\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"244000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"9ecbaed3a4658e37bdab2867c78701073f67bd9fdf2640aeb0c2b69db94afa193d0969700035ab6bd267073e2baddd8f8b1a21335890bc4795c7cfbdfa7c3f9d\", \"status_message\": \"midtrans payment notification\", \"transaction_id\": \"4e43fa42-bfeb-4127-8e7f-776f26752bce\", \"payment_amounts\": [], \"transaction_time\": \"2021-05-28 23:12:18\", \"transaction_status\": \"pending\"}', 'bank_transfer', '06316839444', 'bca', NULL, NULL, NULL, '2021-05-28 09:12:20', '2021-05-28 09:12:20'),
(2, 57, 'PAY/20210528/V/XXVIII/00002', '244000.00', 'midtrans', 'settlement', '4e43fa42-bfeb-4127-8e7f-776f26752bce', '{\"currency\": \"IDR\", \"order_id\": \"INV/20210528/V/XXVIII/00001\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"06316839444\"}], \"merchant_id\": \"G982406316\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"244000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"827aa92a477aa257d5ee86237b2399538f85897bf4e3110656b3b0f9723d374ad98158cef1971db38f518d103e76269648b1132452f9861fb4cd5f2701ae819b\", \"status_message\": \"midtrans payment notification\", \"transaction_id\": \"4e43fa42-bfeb-4127-8e7f-776f26752bce\", \"payment_amounts\": [], \"settlement_time\": \"2021-05-28 23:15:22\", \"transaction_time\": \"2021-05-28 23:12:18\", \"transaction_status\": \"settlement\"}', 'bank_transfer', '06316839444', 'bca', NULL, NULL, NULL, '2021-05-28 09:15:24', '2021-05-28 09:15:24'),
(5, 60, 'PAY/20210605/VI/V/00001', '244000.00', 'midtrans', 'settlement', 'e454e9c5-57f9-48c6-a024-c29f19c10eb7', '{\"currency\": \"IDR\", \"order_id\": \"INV/20210605/VI/V/00001\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"06316216118\"}], \"merchant_id\": \"G982406316\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"244000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"ccae6b64e967d736e5eabdb2e592358692fc38a4a3374da67ea92f80befeab38be844310c069b6e23abb34a8e7ea2ec74b674141d13cd5452c69e74baa699a0c\", \"status_message\": \"midtrans payment notification\", \"transaction_id\": \"e454e9c5-57f9-48c6-a024-c29f19c10eb7\", \"payment_amounts\": [], \"settlement_time\": \"2021-06-05 23:15:56\", \"transaction_time\": \"2021-06-05 23:11:26\", \"transaction_status\": \"settlement\"}', 'bank_transfer', '06316216118', 'bca', NULL, NULL, NULL, '2021-06-05 16:15:58', '2021-06-05 16:15:58'),
(6, 61, 'PAY/20210605/VI/V/00002', '156000.00', 'midtrans', 'pending', '5226095e-df01-4cff-abc5-3cf7cfcda5df', '{\"currency\": \"IDR\", \"order_id\": \"INV/20210605/VI/V/00002\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"06316771326\"}], \"merchant_id\": \"G982406316\", \"status_code\": \"201\", \"fraud_status\": \"accept\", \"gross_amount\": \"156000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"0315788adb9605ff9e5cb10282492663926b772b9f6228f9d989743f02867d3806ccf684541dcda5823ccd38218a1e969635e9237380c4768adbf10886eab781\", \"status_message\": \"midtrans payment notification\", \"transaction_id\": \"5226095e-df01-4cff-abc5-3cf7cfcda5df\", \"payment_amounts\": [], \"transaction_time\": \"2021-06-05 23:31:31\", \"transaction_status\": \"pending\"}', 'bank_transfer', '06316771326', 'bca', NULL, NULL, NULL, '2021-06-05 16:31:33', '2021-06-05 16:31:33'),
(7, 61, 'PAY/20210605/VI/V/00003', '156000.00', 'midtrans', 'settlement', '5226095e-df01-4cff-abc5-3cf7cfcda5df', '{\"currency\": \"IDR\", \"order_id\": \"INV/20210605/VI/V/00002\", \"va_numbers\": [{\"bank\": \"bca\", \"va_number\": \"06316771326\"}], \"merchant_id\": \"G982406316\", \"status_code\": \"200\", \"fraud_status\": \"accept\", \"gross_amount\": \"156000.00\", \"payment_type\": \"bank_transfer\", \"signature_key\": \"ca379dffa965f39a87b4caa92961133484383cd38b1dd039b4023df54a3fc119e244a096da08228d8745af5e0048efe5712839ee3a3cfe3bb7d3e62d65d31693\", \"status_message\": \"midtrans payment notification\", \"transaction_id\": \"5226095e-df01-4cff-abc5-3cf7cfcda5df\", \"payment_amounts\": [], \"settlement_time\": \"2021-06-05 23:32:00\", \"transaction_time\": \"2021-06-05 23:31:31\", \"transaction_status\": \"settlement\"}', 'bank_transfer', '06316771326', 'bca', NULL, NULL, NULL, '2021-06-05 16:32:01', '2021-06-05 16:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_users', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(2, 'add_users', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(3, 'edit_users', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(4, 'delete_users', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(5, 'view_roles', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(6, 'add_roles', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(7, 'edit_roles', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(8, 'delete_roles', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(9, 'view_products', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(10, 'add_products', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(11, 'edit_products', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(12, 'delete_products', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(13, 'view_orders', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(14, 'add_orders', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(15, 'edit_orders', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(16, 'delete_orders', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(17, 'view_categories', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(18, 'add_categories', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(19, 'edit_categories', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(20, 'delete_categories', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(21, 'view_attributes', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(22, 'add_attributes', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(23, 'edit_attributes', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(24, 'delete_attributes', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(26, 'view_shipments', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(27, 'add_shipments', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(28, 'edit_shipments', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48'),
(29, 'delete_shipments', 'web', '2021-05-10 08:25:48', '2021-05-10 08:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
(1, NULL, 1, 'AT150520210001', 'configurable', 'Koko Kurta', 'koko-kurta', '180000.00', '100.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10', 2),
(2, 1, 1, 'AT150520210001-1-4', 'simple', 'Koko Kurta - Red - S', 'koko-kurta-red-s', '11.00', '100.00', NULL, NULL, NULL, 'short_description', 'description', 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:27:26', 2),
(3, 1, 1, 'AT150520210001-1-5', 'simple', 'Koko Kurta - Red - M', 'koko-kurta', '1.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:40', 2),
(4, 1, 1, 'AT150520210001-1-6', 'simple', 'Koko Kurta - Red - L', 'koko-kurta', '2.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:40', 2),
(5, 1, 1, 'AT150520210001-1-7', 'simple', 'Koko Kurta - Red - XL', 'koko-kurta', '3.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:40', 2),
(6, 1, 1, 'AT150520210001-2-4', 'simple', 'Koko Kurta - Green - S', 'koko-kurta', '4.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:41', 2),
(7, 1, 1, 'AT150520210001-2-5', 'simple', 'Koko Kurta - Green - M', 'koko-kurta', '5.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:41', 2),
(8, 1, 1, 'AT150520210001-2-6', 'simple', 'Koko Kurta - Green - L', 'koko-kurta-green-l', '6.00', '100.00', NULL, NULL, NULL, 'short_description', 'description', 1, 1, '2021-05-15 01:04:10', '2021-05-21 07:39:42', 2),
(9, 1, 1, 'AT150520210001-2-7', 'simple', 'Koko Kurta - Green - XL', 'koko-kurta', '7.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:41', 2),
(10, 1, 1, 'AT150520210001-3-4', 'simple', 'Koko Kurta - Blue - S', 'koko-kurta', '8.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:41', 2),
(11, 1, 1, 'AT150520210001-3-5', 'simple', 'Koko Kurta - Blue - M', 'koko-kurta', '9.00', '100.00', NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:41', 2),
(12, 1, 1, 'AT150520210001-3-6', 'simple', 'Koko Kurta - Blue - L', 'koko-kurta-blue-l', '120000.00', '100.00', NULL, NULL, NULL, 'short_description', 'description', 1, 1, '2021-05-15 01:04:10', '2021-05-21 07:40:17', 2),
(13, 1, 1, 'AT150520210001-3-7', 'simple', 'Koko Kurta - Blue - XL', 'koko-kurta-blue-xl', '150000.00', '100.00', NULL, NULL, NULL, 'short_description', 'description', 1, 1, '2021-05-15 01:04:10', '2021-05-15 09:25:41', 2),
(14, NULL, 1, 'AT150520210002', 'simple', 'Gamis Pria', 'gamis-pria', '200000.00', '100.00', NULL, NULL, NULL, 'short_description', 'description', 1, NULL, '2021-05-15 02:26:39', '2021-05-15 02:26:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_product_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `text_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int DEFAULT NULL,
  `float_value` decimal(8,2) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `json_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `parent_product_id`, `product_id`, `attribute_id`, `text_value`, `boolean_value`, `integer_value`, `float_value`, `datetime_value`, `date_value`, `json_value`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(2, 1, 2, 2, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(3, 1, 3, 1, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(4, 1, 3, 2, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(5, 1, 4, 1, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(6, 1, 4, 2, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(7, 1, 5, 1, 'Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(8, 1, 5, 2, 'XL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(9, 1, 6, 1, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(10, 1, 6, 2, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(11, 1, 7, 1, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(12, 1, 7, 2, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(13, 1, 8, 1, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(14, 1, 8, 2, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(15, 1, 9, 1, 'Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(16, 1, 9, 2, 'XL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(17, 1, 10, 1, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(18, 1, 10, 2, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(19, 1, 11, 1, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(20, 1, 11, 2, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(21, 1, 12, 1, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(22, 1, 12, 2, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(23, 1, 13, 1, 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10'),
(24, 1, 13, 2, 'XL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-15 01:04:10', '2021-05-15 01:04:10');

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
(4, 2, 3, NULL, NULL, NULL, NULL),
(5, 3, 1, NULL, NULL, NULL, NULL),
(6, 3, 3, NULL, NULL, NULL, NULL),
(7, 4, 1, NULL, NULL, NULL, NULL),
(8, 4, 3, NULL, NULL, NULL, NULL),
(9, 5, 1, NULL, NULL, NULL, NULL),
(10, 5, 3, NULL, NULL, NULL, NULL),
(11, 6, 1, NULL, NULL, NULL, NULL),
(12, 6, 3, NULL, NULL, NULL, NULL),
(13, 7, 1, NULL, NULL, NULL, NULL),
(14, 7, 3, NULL, NULL, NULL, NULL),
(15, 8, 1, NULL, NULL, NULL, NULL),
(16, 8, 3, NULL, NULL, NULL, NULL),
(17, 9, 1, NULL, NULL, NULL, NULL),
(18, 9, 3, NULL, NULL, NULL, NULL),
(19, 10, 1, NULL, NULL, NULL, NULL),
(20, 10, 3, NULL, NULL, NULL, NULL),
(21, 11, 1, NULL, NULL, NULL, NULL),
(22, 11, 3, NULL, NULL, NULL, NULL),
(23, 12, 1, NULL, NULL, NULL, NULL),
(24, 12, 3, NULL, NULL, NULL, NULL),
(25, 13, 1, NULL, NULL, NULL, NULL),
(26, 13, 3, NULL, NULL, NULL, NULL),
(27, 14, 1, NULL, NULL, NULL, NULL),
(28, 14, 3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(4, 14, 'uploads/images/gamis-pria_1622881300.jpg', '/uploads/images/xlarge/gamis-pria_1622881300.jpg', '/uploads/images/large/gamis-pria_1622881300.jpg', '/uploads/images/medium/gamis-pria_1622881300.jpg', '/uploads/images/small/gamis-pria_1622881300.jpg', 1, NULL, '2021-06-05 08:21:41', '2021-06-05 08:21:41'),
(5, 14, 'uploads/images/gamis-pria_1622881393.jpg', '/uploads/images/xlarge/gamis-pria_1622881393.jpg', '/uploads/images/large/gamis-pria_1622881393.jpg', '/uploads/images/medium/gamis-pria_1622881393.jpg', '/uploads/images/small/gamis-pria_1622881393.jpg', 1, NULL, '2021-06-05 08:23:14', '2021-06-05 08:23:14'),
(6, 1, 'uploads/images/koko-kurta_1622902613.jpg', '/uploads/images/xlarge/koko-kurta_1622902613.jpg', '/uploads/images/large/koko-kurta_1622902613.jpg', '/uploads/images/medium/koko-kurta_1622902613.jpg', '/uploads/images/small/koko-kurta_1622902613.jpg', 1, NULL, '2021-06-05 14:16:54', '2021-06-05 14:16:54'),
(7, 1, 'uploads/images/koko-kurta_1622902622.jpg', '/uploads/images/xlarge/koko-kurta_1622902622.jpg', '/uploads/images/large/koko-kurta_1622902622.jpg', '/uploads/images/medium/koko-kurta_1622902622.jpg', '/uploads/images/small/koko-kurta_1622902622.jpg', 1, NULL, '2021-06-05 14:17:02', '2021-06-05 14:17:02'),
(8, 1, 'uploads/images/koko-kurta_1622902740.jpg', '/uploads/images/xlarge/koko-kurta_1622902740.jpg', '/uploads/images/large/koko-kurta_1622902740.jpg', '/uploads/images/medium/koko-kurta_1622902740.jpg', '/uploads/images/small/koko-kurta_1622902740.jpg', 1, NULL, '2021-06-05 14:19:01', '2021-06-05 14:19:01');

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

--
-- Dumping data for table `product_inventories`
--

INSERT INTO `product_inventories` (`id`, `product_id`, `qty`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 11, NULL, NULL, '2021-05-15 01:08:30', '2021-05-15 09:27:26'),
(3, 13, 10, NULL, NULL, '2021-05-15 08:39:39', '2021-05-15 08:39:39'),
(4, 3, 1, NULL, NULL, '2021-05-15 09:25:40', '2021-05-15 09:25:40'),
(5, 4, 2, NULL, NULL, '2021-05-15 09:25:40', '2021-05-15 09:25:40'),
(6, 5, 3, NULL, NULL, '2021-05-15 09:25:40', '2021-05-15 09:25:40'),
(7, 6, 4, NULL, NULL, '2021-05-15 09:25:41', '2021-05-15 09:25:41'),
(8, 7, 5, NULL, NULL, '2021-05-15 09:25:41', '2021-05-15 09:25:41'),
(9, 8, 10, NULL, NULL, '2021-05-15 09:25:41', '2021-05-21 07:39:42'),
(10, 9, 7, NULL, NULL, '2021-05-15 09:25:41', '2021-05-15 09:25:41'),
(11, 10, 8, NULL, NULL, '2021-05-15 09:25:41', '2021-05-15 09:25:41'),
(12, 11, 9, NULL, NULL, '2021-05-15 09:25:41', '2021-05-15 09:25:41'),
(13, 12, 9, NULL, NULL, '2021-05-15 09:25:41', '2021-06-05 16:31:21'),
(14, 14, 2, NULL, NULL, '2021-05-25 07:44:48', '2021-06-05 16:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-05-10 08:25:56', '2021-05-10 08:25:56'),
(2, 'Operator', 'web', '2021-05-10 08:25:56', '2021-05-10 08:25:56'),
(3, 'User', 'web', '2021-05-13 00:27:38', '2021-05-13 00:27:38'),
(4, 'Obit', 'web', '2021-05-13 00:28:05', '2021-05-13 00:28:05'),
(5, 'Raisa', 'web', '2021-05-13 00:29:35', '2021-05-13 00:29:35'),
(6, 'Tai', 'web', '2021-05-13 00:30:44', '2021-05-13 00:30:44');

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
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(1, 2),
(2, 2),
(5, 2),
(9, 2),
(13, 2),
(17, 2),
(21, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `track_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_qty` int NOT NULL,
  `total_weight` int NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `shipped_by` bigint UNSIGNED DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `user_id`, `order_id`, `track_number`, `status`, `total_qty`, `total_weight`, `first_name`, `last_name`, `address1`, `address2`, `phone`, `email`, `city_id`, `province_id`, `postcode`, `shipped_by`, `shipped_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 3, 57, 'sdfgdget', 'shipped', 1, 100, 'Obit', 'Yulian', 'Jalan Dahlia 3 depan SMA 1 natar', NULL, '085268194028', 'obit@mail.com', '21', '18', 35362, 1, '2021-06-05 15:28:18', NULL, '2021-05-28 09:09:04', '2021-06-05 15:28:18'),
(8, 3, 60, 'vcbcvb', 'shipped', 1, 100, 'Obit', 'Yulian', 'Jalan Dahlia 3 depan SMA 1 natar', NULL, '085268194028', 'obit@mail.com', '21', '18', 35362, 1, '2021-06-05 16:16:47', NULL, '2021-06-05 16:11:09', '2021-06-05 16:16:47'),
(9, 3, 61, 'fdgdfg', 'shipped', 1, 100, 'Obit', 'Yulian', 'Jalan Dahlia 3 depan SMA 1 natar', NULL, '085268194028', 'obit@mail.com', '21', '18', 35362, 1, '2021-06-05 16:32:47', NULL, '2021-06-05 16:31:22', '2021-06-05 16:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'Zoie Medhurst', 'mail', 'Jacynthe Morar', 'admin@mail.com', NULL, '2021-05-10 08:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mo2Bst3NZquQmiz8MqVL0juqTj9lPXba9IeHLbt1lRF5Zk5gLozP94eo9Q2m', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-10 08:25:56', '2021-05-10 08:25:56'),
(2, 'Claire Johnston PhD', 'mail', 'Marina Schamberger IV', 'operator@mail.com', NULL, '2021-05-10 08:25:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AgAQzaMf3VJa1A0nDuJGlwYaWOLyQz4iJXYMLIEsQSpdBUT2w0K2BhEMjajQ', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-10 08:25:56', '2021-05-10 08:25:56'),
(3, 'Obit', 'Yulian', NULL, 'obit@mail.com', NULL, NULL, '$2y$10$w9fldME.WSfH5.avT8kACegP0cj7qI4shqRnl5G1ARMzLNDEUu.JW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-13 08:43:08', '2021-05-13 20:00:02'),
(4, 'Raisa', 'Mail', NULL, 'raisa@mail.com', NULL, NULL, '$2y$10$THSS0NKf8joHkx.7KOidZeRjiBdvEZtEkwAjFk8mq1v4RDoqsQ5iO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-13 08:49:17', '2021-05-13 19:59:49'),
(6, 'first', 'last', NULL, 'first@last.com', NULL, NULL, '$2y$10$S7svbWGraQlFWAFF0.Bfv.BhtuHGEF65a6npQ3EjW29MsuTFBloU2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-21 08:37:12', '2021-05-21 08:37:12');

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
  ADD KEY `orders_code_order_date_index` (`code`,`order_date`),
  ADD KEY `orders_payment_token_index` (`payment_token`);

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
  ADD KEY `product_attribute_values_product_id_foreign` (`product_id`),
  ADD KEY `product_attribute_values_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_attribute_values_parent_product_id_foreign` (`parent_product_id`);

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
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_user_id_foreign` (`user_id`),
  ADD KEY `shipments_order_id_foreign` (`order_id`),
  ADD KEY `shipments_shipped_by_foreign` (`shipped_by`),
  ADD KEY `shipments_track_number_index` (`track_number`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `product_attribute_values_parent_product_id_foreign` FOREIGN KEY (`parent_product_id`) REFERENCES `products` (`id`),
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
