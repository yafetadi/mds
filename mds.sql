-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 04:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mds`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `branch_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('642876ed-50db-4569-9bf3-1469dda87b89', 'Kota', 3, '2023-03-08 05:03:06', '2023-03-08 05:03:06', NULL),
('965ca8fc-6a33-42f9-9dfc-428eb6b55acc', 'Tingkir', 3, '2023-03-08 05:03:15', '2023-03-08 05:03:15', NULL),
('b7e8a73c-2f36-47c9-8a87-901663aef6b7', 'Semarang Barat', 2, '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL),
('e7bd22a6-da4c-4978-ac81-b3025c0ec2c0', 'Mijen', 2, '2023-03-08 05:02:59', '2023-03-08 05:02:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Medishop', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL),
(2, 'Semarang', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL),
(3, 'Salatiga', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `code`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', 'ALAT TEST', 'ALT', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:34:05', '2023-03-08 06:34:05', NULL),
('2362d19c-9578-41d9-b183-fdcebe92aa4f', 'GIG', 'GIG', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:34:58', '2023-03-08 06:34:58', NULL),
('25409dc0-1051-4381-98aa-4ae5b7439735', 'SELANG', 'SLG', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:37:22', '2023-03-08 06:37:22', NULL),
('28087d33-1eb6-4c9c-a1e0-7550b385d8c9', 'ALAT BANTU BESAR', 'ABB', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:31:48', '2023-03-08 06:31:48', NULL),
('2ea2c6fb-555d-4959-8be3-b37f6da28004', 'GLASS', 'GLS', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:35:09', '2023-03-08 06:35:09', NULL),
('363afaa3-8c77-4628-8c31-45bba4aa0019', 'SPUIT', 'SPT', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:26', '2023-03-08 06:36:26', NULL),
('40cd3e06-4977-476a-ac95-42c92ccc6ba5', 'INSTRUMEN', 'INS', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:34:22', '2023-03-08 06:34:22', NULL),
('4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', 'SARUNG TANGAN', 'SRG', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:37:50', '2023-03-08 06:37:50', NULL),
('4595290f-d902-49ce-9a6f-f6f34404838d', 'PLESTER', 'PLS', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:51', '2023-03-08 06:36:51', NULL),
('45ca4eb4-eeca-464f-b7b5-3cc1c4a5b6bd', 'SCALE', 'SCL', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:37:13', '2023-03-08 06:37:13', NULL),
('623b10e3-334e-4507-9895-be42fcd67ef5', 'ALAT PELINDUNG DIRI', 'APD', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:32:30', '2023-03-08 06:32:30', NULL),
('6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', 'POT', 'POT', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:57', '2023-03-08 06:36:57', NULL),
('63814e26-3859-4fd4-87fc-832bd4fc7000', 'RIGHT SIGN', 'RSG', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:37:36', '2023-03-08 06:37:36', NULL),
('74ac957b-b8ec-4332-89fc-474a30650dc7', 'ALAT MESIN', 'ALM', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:32:59', '2023-03-08 06:32:59', NULL),
('79faa6e1-8a5d-4540-9895-51d9665f7a9c', 'THERMOMETER', 'TRM', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:38:29', '2023-03-08 06:38:29', NULL),
('85d90e94-dd93-4113-ba2a-b753cb6d9d64', 'STRIP', 'STR', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:37:58', '2023-03-08 06:37:58', NULL),
('8d671b48-6a18-4704-839c-341ef2ee8817', 'KERTAS', 'KER', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:35:48', '2023-03-08 06:35:48', NULL),
('8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', 'ACCESSORIES', 'ACC', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:32:47', '2023-03-08 06:32:47', NULL),
('9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', 'KASSA', 'KAS', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:35:36', '2023-03-08 06:35:36', NULL),
('a6bfdab5-31a7-49f3-a5f3-27b196881344', 'ALAT BANTU KECIL', 'ABK', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:32:04', '2023-03-08 06:32:04', NULL),
('c234fc14-8617-4d1b-8c08-d96095d5a1a4', 'CAIRAN', 'LIQ', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:14', '2023-03-08 06:36:14', NULL),
('c5c2883c-e664-4822-9e74-958557dbf2da', 'OBAT', 'OBT', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:43', '2023-03-08 06:36:43', NULL),
('ce3d64a2-3897-482e-bb81-2a4e0e68176d', 'JARUM', 'JRM', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:35:20', '2023-03-08 06:35:20', NULL),
('d0434f40-f27c-4f7b-9009-b008a6e3f973', 'MASKER', 'MSK', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:33', '2023-03-08 06:36:33', NULL),
('d20d35fb-9ce6-4df8-9fbd-6062877c6eae', 'TENSI', 'TNS', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:38:07', '2023-03-08 06:38:07', NULL),
('d8f8fdfe-f21e-40cf-a907-21214d4a3498', 'LABORATORIUM', 'LAB', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:36:05', '2023-03-08 06:36:05', NULL),
('ef51c47c-3b75-4433-a916-781d6f8b0d44', 'ALAT PENUNJANG', 'ALP', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:33:42', '2023-03-08 06:33:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `due` date NOT NULL,
  `tenor` int(11) NOT NULL,
  `status` enum('Belum Lunas','Lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Lunas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_details`
--

CREATE TABLE `credit_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenor` int(11) DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_01_25_051835_create_branches_table', 1),
(5, '2023_01_25_051840_create_areas_table', 1),
(6, '2023_01_25_051850_create_users_table', 1),
(7, '2023_01_25_052308_create_customers_table', 1),
(8, '2023_01_25_052620_create_operational_categories_table', 1),
(9, '2023_01_25_052720_create_operationals_table', 1),
(10, '2023_01_25_052737_create_categories_table', 1),
(11, '2023_01_25_052749_create_products_table', 1),
(12, '2023_01_25_052816_create_stocks_table', 1),
(13, '2023_01_25_052838_create_stock_transactions_table', 1),
(14, '2023_01_25_052902_create_stock_transaction_details_table', 1),
(15, '2023_01_25_052915_create_orders_table', 1),
(16, '2023_01_25_052926_create_order_details_table', 1),
(17, '2023_01_25_052938_create_credits_table', 1),
(18, '2023_01_25_052946_create_credit_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `operationals`
--

CREATE TABLE `operationals` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` int(11) NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operational_category_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operational_categories`
--

CREATE TABLE `operational_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `ppn` int(11) DEFAULT NULL,
  `delivery` int(11) DEFAULT NULL,
  `grandtotal` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `payment_method` enum('cash','transfer','credit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','print','return') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `return` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `disc` int(11) DEFAULT NULL,
  `ppn` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `status` enum('sold','return') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`, `unit`, `desc`, `category_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('00660e11-9d1e-4a5c-8a5d-6632f41c7481', 'KAS11', 'Kapas 1000gr', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:46:35', '2023-03-09 00:46:35', NULL),
('009a1374-2732-4d91-a602-232578786937', 'STR18', 'Strip Uright Glucose Tube', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:59:46', '2023-03-09 02:59:46', NULL),
('015e5b98-c536-4efe-b2b5-bcd28aa4636c', 'ACC17', 'Safety Box 12,5L', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:57:30', '2023-03-08 06:57:30', NULL),
('0166f238-c254-4198-b364-01e25a2fc88c', 'JRM30', 'Catgut Silk 3.0', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:41:28', '2023-03-09 00:41:28', NULL),
('02de6f7d-6d60-418e-8433-8e73734381ed', 'JRM46', 'Medisafe Lancet Terumo', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:44:30', '2023-03-09 00:44:30', NULL),
('02f285ef-d37b-47bb-af67-4fb2eef10357', 'LAB08', 'Blue Tips 1000 Kartel', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:50:26', '2023-03-09 00:50:26', NULL),
('03827dea-19c8-48d9-b781-b58e48f6cd0f', 'STR21', 'Strip Gluco Dr Biosensor', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:00:19', '2023-03-09 03:00:19', NULL),
('0449ffa4-127e-484c-9764-d913072ea880', 'TNS05', 'Tensi Dig Yuwell Ye 660B', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:01:18', '2023-03-09 03:01:18', NULL),
('045aef2d-9382-47c3-958d-756818d0ad65', 'SPT01', 'Spuit BD 3cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:02:40', '2023-03-09 01:02:40', NULL),
('0490d77f-2731-44ad-a3a0-692f7278b7f8', 'PLS24', 'Hansaplast Jumbo', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:17:03', '2023-03-09 01:17:03', NULL),
('04d6f858-6a91-4690-ad0a-53578f9c85af', 'INS14', 'Bak Intrumen SH 509', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:17', '2023-03-08 07:23:17', NULL),
('05c6b997-38bd-4ec5-afec-70b2b2e3a853', 'SRG21', 'Safeglove Exam M', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:43:11', '2023-03-09 02:43:11', NULL),
('065b7fa4-660b-4b1e-aca1-8899103d247e', 'ACC12', 'Medline', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:56:13', '2023-03-08 06:56:13', NULL),
('0687b6ba-d421-4d64-9f3d-c3912f483a99', 'PLS02', 'Hypafix 5x5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:11:52', '2023-03-09 01:11:52', NULL),
('06885324-acfa-4a36-b9f9-9e87e75225cb', 'INS16', 'Nierbeken Bengkok 23cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:31', '2023-03-08 07:23:31', NULL),
('06c763a1-a08f-4437-b958-d84c3bd451ed', 'ALP13', 'Gypsona 3\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:37', '2023-03-08 07:15:37', NULL),
('07187551-2f56-4a72-a142-0c8b17259a5c', 'PLS05', 'Ultrafix 5x1', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:12:25', '2023-03-09 01:12:25', NULL),
('07221a99-4ab7-444d-9f09-ec1510019116', 'ABB11', 'Trolley Oksigen Kecil', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:12', '2023-03-08 06:47:12', NULL),
('073f02b9-cb7b-4c4c-b4b7-4c1f4f2d5b21', 'ACC04', 'ECG Elektroda Dewasa OM Pack/ 50', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:16', '2023-03-08 06:55:16', NULL),
('07dd2a7a-a4dd-4777-8eb7-7745c94c99a7', 'LAB27', 'Golongan Darah Anti D Tulip', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:53:26', '2023-03-09 00:53:26', NULL),
('0816edfe-e072-4cb8-9af7-9ae0ba614931', 'INS30', 'Gunting TATA Bengkok 18cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:32', '2023-03-08 07:25:32', NULL),
('0823f78f-6e79-4372-9443-42ce1a74390f', 'SLG17', 'NN', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:50:09', '2023-03-09 02:52:03', NULL),
('086ebb73-6040-4b27-b436-14f773e0ee99', 'LAB28', 'Vaculab 3ml Edta OM', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:53:36', '2023-03-09 00:53:36', NULL),
('088c0930-a584-48cc-a94b-2e8ff933dc65', 'KER04', 'Usg Paper Sony', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:48:12', '2023-03-09 00:48:12', NULL),
('08aac0d6-2689-4b65-826a-8df23ec46f05', 'JRM13', 'Jarum Microfine Hijau BD', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:37:14', '2023-03-09 00:37:14', NULL),
('08dd9634-db88-4958-a446-91431fc0df14', 'STR04', 'Strip ET Cholesterol', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:56:47', '2023-03-09 02:56:47', NULL),
('090b9464-910a-4dde-b0b7-548eb7b529e2', 'SPT03', 'Spuit BD 10cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:03:00', '2023-03-09 01:03:00', NULL),
('093894b3-3921-446d-aeeb-600acd297037', 'ALP12', 'Arm Sling Weldaco L', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:29', '2023-03-08 07:15:29', NULL),
('0a84791b-5c19-43c7-9aec-86eaf61f89eb', 'ABB20', 'Chommode Chair Roda', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:26', '2023-03-08 06:48:26', NULL),
('0b8faed8-a16f-4bd3-9410-027bcb913584', 'RSG07', 'Right Sign Hcg Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:40:17', '2023-03-09 01:40:17', NULL),
('0c00bbd4-e17e-47fe-8caa-2aa541ab80f4', 'SLG42', 'Hi-Oxy Mask Anak', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:30:58', '2023-03-09 01:30:58', NULL),
('0c2417fa-7506-4edb-a0f9-e08f58c2847e', 'ABB03', 'Tongkat Kaki 4', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:45:38', '2023-03-08 06:45:38', NULL),
('0c5c60c9-6ad0-4afa-a6fb-922e4ee415ad', 'TNS14', 'Manset Abn', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:42', '2023-03-09 03:02:42', NULL),
('0cfa8cb0-79e4-4edb-9836-4937c8a91207', 'JRM26', 'Catgut Plain 3.0', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:40:32', '2023-03-09 00:40:32', NULL),
('0dee2dd7-eb1c-4bff-8b9c-01ff16b200cd', 'INS10', 'Speculum M', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:42', '2023-03-08 07:22:42', NULL),
('0e669242-6cfd-4570-873e-fb51d63ad8a5', 'LIQ32', 'Desinfektan 5L Poreklin', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:02:29', '2023-03-09 01:02:29', NULL),
('0e7b0184-585e-4bf2-bf42-b2a9301f58ad', 'RSG12', 'Answer Dengue Igg', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:41:32', '2023-03-09 01:41:32', NULL),
('0e8d85cc-4c66-452c-9609-6342dbcd968e', 'LIQ24', 'Handrub Solution 500ml Sae Care', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:01:12', '2023-03-09 01:01:12', NULL),
('0eb9315f-75ff-4e97-8a26-7a9e97c5db1b', 'STR10', 'Strip Benechek Gula', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:58:19', '2023-03-09 02:58:19', NULL),
('0ec75ec9-180e-47c4-b49b-efe005e98b6a', 'RSG21', 'Right Sign Fob Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:46:03', '2023-03-09 01:46:03', NULL),
('0ef738a0-d605-4c11-8dc9-1da62727c134', 'PLS23', 'Hansaplast Plester Kecil', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:16:52', '2023-03-09 01:16:52', NULL),
('0f5bf282-13e2-4f26-8e9f-27ffc90c6d62', 'ALP16', 'Celana Khitan S', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:16:01', '2023-03-08 07:16:01', NULL),
('0f609b68-62d5-4636-92e9-19a562d6bd44', 'SRG22', 'Safeglove Exam L', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:43:18', '2023-03-09 02:43:18', NULL),
('0ff391a0-6f76-4131-be62-b3772476094e', 'ABB23', 'Elektrik Hospital Bed 3 Crank', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:47', '2023-03-08 06:48:47', NULL),
('107fcb69-bed4-46a1-b19e-0d9bf8127fde', 'RSG10', 'Right Sign Dengue Ns1 Ag', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:40:45', '2023-03-09 01:40:45', NULL),
('10ae891f-839b-48a8-83db-14054015fee7', 'LAB16', 'Mindray M-52 LH-Lyse 100ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:51:47', '2023-03-09 00:51:47', NULL),
('10bd223b-2610-47a3-bccd-b77be24b88ae', 'SRG11', 'Ansel Gammex 7,5', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:56:53', '2023-03-09 01:56:53', NULL),
('10f021dc-04b7-4385-b2ce-8179047b5a06', 'LIQ15', 'Rivanol 100ml OM', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:58:56', '2023-03-09 00:58:56', NULL),
('11cb8b10-291e-4bde-8722-a866bf55eaf0', 'SLG15', 'Foley Cath Rusch No.24', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:26:07', '2023-03-09 01:26:07', NULL),
('11fa3f1b-94c6-4c1a-b155-7c786d82c922', 'JRM05', 'Inflo 26G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:35:57', '2023-03-09 00:35:57', NULL),
('121e240d-1229-46f6-aad0-f21843826e8c', 'ABK01', 'Wwz', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:57', '2023-03-08 06:48:57', NULL),
('1233604a-17c5-4a62-a8b9-5935ea44a768', 'ACC20', 'Statumeter', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:57:50', '2023-03-08 06:57:50', NULL),
('12f37034-7a24-40f7-ae40-3a03d4cf50c3', 'ALM02', 'Kasur Decubitus', 0, 'Kg', NULL, '74ac957b-b8ec-4332-89fc-474a30650dc7', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:17', '2023-03-08 06:58:17', NULL),
('1367b562-31e0-4590-9983-7bcfaef72b47', 'MSK11', 'Masker KN95', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:07:50', '2023-03-09 01:07:50', NULL),
('14946004-172e-4623-bd8a-1816f9bb963a', 'LAB18', 'Mindray M-52D Diluent 20L', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:04', '2023-03-09 00:52:04', NULL),
('14e4c7d2-0cf8-4513-b675-71d1c4774302', 'RSG02', 'Right Sign Hbsag Strip', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:32:46', '2023-03-09 01:32:46', NULL),
('16babbd9-b50a-488d-a756-9d60322843eb', 'SLG19', 'NN', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:50:29', '2023-03-09 02:52:30', NULL),
('170ea56f-61db-489e-a8b9-08dcf4d9de90', 'SRG09', 'Ansel Gammex 6,5', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:56:21', '2023-03-09 01:56:21', NULL),
('1756ac4d-dff1-4818-9abe-11a39ae9978b', 'JRM06', 'Jarum BD 23G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:36:08', '2023-03-09 00:36:08', NULL),
('17ffc0b5-55e6-429d-82de-ac3231888b52', 'SRG03', 'Safeglove Nitril Exam M', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:54:59', '2023-03-09 01:54:59', NULL),
('1886ae65-9f4f-41ac-9920-b55b1bcda539', 'TNS18', 'Bulb Local', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:03:14', '2023-03-09 03:03:14', NULL),
('19687e0b-787a-4ce1-9f69-380d5060587a', 'LAB26', 'Golongan Darah Anti AB Tulip', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:53:17', '2023-03-09 00:53:17', NULL),
('19b48b62-9859-4fc9-b9d3-999bfbb3f044', 'INS02', 'Gunting Verban', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:51', '2023-03-08 07:20:51', NULL),
('19c174b0-d87b-49df-b104-203a341e1ed0', 'TRM08', 'Termometer Ruang', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:04:44', '2023-03-09 03:04:44', NULL),
('1a33c7ad-a667-4850-9b76-0b0895ba55bb', 'INS19', 'Verban Tromol 15cm Dresing Drumb', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:58', '2023-03-08 07:23:58', NULL),
('1a8f665d-ffe5-40d7-86b1-103f51af36b6', 'ALP01', 'Medicrepe No. 3', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:47', '2023-03-08 06:58:47', NULL),
('1afc8b14-b28b-4f89-9db1-347c6051b7cb', 'PLS18', 'Leukoplast 2,5x4,5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:15:50', '2023-03-09 01:15:50', NULL),
('1c7bd86f-5e60-4d5d-bb00-1590bcf961bc', 'PLS16', 'Leukoplast 1,25x4,5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:15:26', '2023-03-09 01:15:26', NULL),
('1d4fcf65-8585-417b-b943-35fb33e91917', 'ABB08', 'Kruk Ketiak L', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:46:50', '2023-03-08 06:46:50', NULL),
('1d5af130-0b90-4522-acf7-59ec8fdd2d9f', 'SPT12', 'Spuit Terumo 20cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:04:43', '2023-03-09 01:04:43', NULL),
('1e3d5b71-21a6-48de-a4d6-138fa3fbe4b0', 'KAS06', 'Kasa Steril 16x16 Onemed', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:45:46', '2023-03-09 00:45:46', NULL),
('1f02ca7c-4294-4be9-85f9-6bb200682bdf', 'ALP03', 'Medicrepe No. 6', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:13:23', '2023-03-08 07:13:23', NULL),
('1f322cd5-8fbd-42d8-ba77-37be1666d74f', 'LAB24', 'Golongan Darah Anti A Tulip', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:58', '2023-03-09 00:52:58', NULL),
('2080d146-fae4-4da8-be97-e2e5a475da82', 'SPT09', 'Spuit Terumo 3cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:04:05', '2023-03-09 01:04:05', NULL),
('2136b0a8-be02-4f39-acfe-0e2d2722dce9', 'JRM04', 'Inflo 24G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:35:48', '2023-03-09 00:35:48', NULL),
('21877365-caff-4e31-8421-da158ef4ddd9', 'INS23', 'Bisturi Bbraun 511', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:24:30', '2023-03-08 07:24:30', NULL),
('22105911-9307-4e34-a7e4-fee113cfd61a', 'JRM03', 'Inflo 22G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:35:37', '2023-03-09 00:35:37', NULL),
('22378e1b-19b5-4e4a-ae57-583b2a6853e6', 'GLS06', 'Deck Glass 24x50', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:28:36', '2023-03-08 07:28:36', NULL),
('230a7608-4c6c-4d12-9237-960c1fc2b55f', 'SCL01', 'Timbangan Badan Dig Gea', 0, 'Kg', NULL, '45ca4eb4-eeca-464f-b7b5-3cc1c4a5b6bd', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:20:38', '2023-03-09 01:20:38', NULL),
('24215aa8-7182-442d-b956-2888c13de98b', 'KAS08', 'Kapas 100gr', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:46:04', '2023-03-09 00:46:04', NULL),
('24961a4d-1b87-4d6f-a9ea-041744fe282a', 'RSG04', 'Right Sign Hcv Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:33:05', '2023-03-09 01:33:05', NULL),
('24be5a40-cc3e-430d-8cfa-3a7459811f61', 'SRG18', 'Handscoon Altamed L', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:42:00', '2023-03-09 02:42:00', NULL),
('24e28b2b-102d-43dd-88bb-ceb600d0ee04', 'JRM47', 'Lancet', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:44:40', '2023-03-09 00:44:40', NULL),
('25a5b48f-9078-4f78-b983-0c752df07db9', 'SRG08', 'Maxter Steril 8', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:56:12', '2023-03-09 01:56:12', NULL),
('25f04b6a-b03a-4803-983f-c84605971cfe', 'SLG11', 'Foley Cath Rusch No.16', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:25:24', '2023-03-09 01:25:24', NULL),
('26109d8d-f955-4584-9e5b-b0e27df08bfb', 'LIQ25', 'Handrub Gel 500ml Sae', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:01:22', '2023-03-09 01:01:22', NULL),
('2614b0aa-243b-4bbd-9df9-3ae4f0e95c35', 'PLS04', 'Hypafix 15x5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:12:12', '2023-03-09 01:12:12', NULL),
('269e63d5-50b4-4e38-a498-93d23d03e426', 'SRG14', 'Sarung Tangan Obgyn Steril', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:41:23', '2023-03-09 02:41:23', NULL),
('26a4f399-0d31-4d4f-b890-8d6fb4dc4d30', 'ALT06', 'Alat Biohermes Hba1c Analyzer', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:10', '2023-03-08 07:20:10', NULL),
('2772cdcd-0afd-47b4-9ade-3e310b614597', 'GIG08', 'Amalgam Stoper', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:49', '2023-03-08 07:26:49', NULL),
('281052e5-27e5-423f-9e35-092a830378fb', 'JRM33', 'Jarum Mani SE-TH 24', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:41:58', '2023-03-09 00:41:58', NULL),
('282b728a-1516-44ae-86ab-ad2fcf2f1855', 'LAB12', 'Test Tube 12x75mm Greiner', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:51:01', '2023-03-09 00:51:01', NULL),
('28ec6633-8552-4d68-bf81-3c6f22164c61', 'ABB04', 'Tongkat Elbow/ Siku', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:46:17', '2023-03-08 06:46:17', NULL),
('2902f5a4-71b7-46c1-a4dd-557d24114259', 'KAS13', 'Cotton Swab', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:46:55', '2023-03-09 00:46:55', NULL),
('29138261-eabf-4ca9-8b2f-2e55f1496f2e', 'LIQ28', 'Aseptic Plus 500ml +Disp OM', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:01:51', '2023-03-09 01:01:51', NULL),
('29fa3785-f7fb-488e-8994-ce1e4491c428', 'LIQ29', 'Aseptic Plus Galon 5L OM', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:02:00', '2023-03-09 01:02:00', NULL),
('2bc70189-e147-4c41-9130-509c513888d4', 'APD06', 'APD Lokal', 0, 'Kg', NULL, '623b10e3-334e-4507-9895-be42fcd67ef5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:54:38', '2023-03-08 06:54:38', NULL),
('2bed6ba1-fd08-42ac-97ee-0094c4351d97', 'JRM07', 'Jarum BD 24G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:36:17', '2023-03-09 00:36:17', NULL),
('2cdad9b0-32d2-4436-8f3b-ac55c30aab64', 'SCL03', 'Timbangan Bayi 20Kg OM', 0, 'Kg', NULL, '45ca4eb4-eeca-464f-b7b5-3cc1c4a5b6bd', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:21:10', '2023-03-09 01:21:10', NULL),
('2d152ce5-f2ed-42e6-97fe-9f4cafbeeffd', 'KAS07', 'Kapas 50gr', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:45:55', '2023-03-09 00:45:55', NULL),
('2daace68-4252-4b8a-a6de-ef04a6a332a8', 'OBT07', 'Sendok Obat', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:10:09', '2023-03-09 01:10:09', NULL),
('2dadb2bd-5485-4d59-a73e-349293dce99a', 'GIG01', 'Dental Floss 50m', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:54', '2023-03-08 07:25:54', NULL),
('2e3be351-b788-4126-a540-3826b66a7ce8', 'SPT06', 'Spuit Onemed 10cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:03:33', '2023-03-09 01:03:33', NULL),
('2e46786a-4cd4-4297-b8ce-a1a596fce784', 'GIG07', 'Pinset', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:43', '2023-03-08 07:26:43', NULL),
('2e562c62-a2e5-4ad4-8583-9ca91706f72a', 'ABK12', 'Urinal Wanita', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:51:58', '2023-03-08 06:51:58', NULL),
('2f4257da-9bae-43d4-8eac-93f7ffc00d37', 'GLS08', 'Gelas Ukur 100ml Pyrex', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:29:03', '2023-03-08 07:29:03', NULL),
('2fb4b753-84e7-441a-8434-d91fa58b4a8d', 'INS27', 'Tenaculum', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:08', '2023-03-08 07:25:08', NULL),
('2fec8408-9517-429b-8638-af086c1008e1', 'MSK04', 'Masker Karet Hijau OM', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:06:15', '2023-03-09 01:06:15', NULL),
('30bf6426-261a-434c-a682-48929b890e54', 'INS22', 'Bisturi Bbraun 510', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:24:21', '2023-03-08 07:24:21', NULL),
('3116bb9d-f41f-4cb3-ae25-bf420e64fa51', 'ABB01', 'Tongkat Kaki 1', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:42:43', '2023-03-08 06:42:43', NULL),
('31a12951-c49e-4dc8-beb1-3fee03f3848b', 'LIQ26', 'Handrub Gel Plus 5L Sae', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:01:31', '2023-03-09 01:01:31', NULL),
('32f14246-1af4-4986-b7e1-d48358fbf3c7', 'KAS12', 'Kapas Bola Medisoft', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:46:44', '2023-03-09 00:46:44', NULL),
('32f2adf4-f689-41f0-bcf1-b9ac679b84b2', 'PLS06', 'Ultrafix 5x5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:12:35', '2023-03-09 01:12:35', NULL),
('33596e47-3de6-4480-9ffe-c8f29ac92c82', 'SLG44', 'Transofix OM', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:31:19', '2023-03-09 01:31:19', NULL),
('338449fb-bfe9-4b5b-aa96-66c911cbcf76', 'ABK02', 'Pisau Cukur', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:49:10', '2023-03-08 06:49:10', NULL),
('33fad6bc-5024-4218-808f-b3a42df5c517', 'SPT05', 'Spuit Onemed 5cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:03:21', '2023-03-09 01:03:21', NULL),
('3635adde-fd4a-4526-bfbd-053b4aabac0b', 'POT09', 'Pot Feaces', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:19:39', '2023-03-09 01:19:39', NULL),
('36816912-69a4-4488-b607-0323be2307da', 'JRM42', 'Jarum Akupuntur 0,25x25', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:43:47', '2023-03-09 00:43:47', NULL),
('368af713-dd4d-48f0-a5db-50b6d473f69d', 'SLG38', 'Condom Catheter M', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:30:05', '2023-03-09 01:30:05', NULL),
('369265ac-d15f-4374-91e6-0f4721d34d22', 'GIG12', 'Sendok Cetak Gigi Hijau Set', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:27:20', '2023-03-08 07:27:20', NULL),
('37dfbdd0-aac5-4bd5-bacb-9e94c12b1454', 'KER01', 'Kertas Puyer Kecil (7,5x10)', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:47:43', '2023-03-09 00:47:43', NULL),
('380e6432-6102-499f-8e5a-101a40aba0eb', 'PLS13', 'Lomatuell', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:14:37', '2023-03-09 01:14:37', NULL),
('382a37d2-803b-49ab-b448-c9bc03d23846', 'LAB15', 'Mindray M-30 Rinse 20L', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:51:33', '2023-03-09 00:51:33', NULL),
('382e3f93-fb5d-41c1-af9b-b10791fe81e9', 'APD04', 'APD Hazmat', 0, 'Kg', NULL, '623b10e3-334e-4507-9895-be42fcd67ef5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:54:17', '2023-03-08 06:54:17', NULL),
('38534e7a-212d-41e5-bae9-a876ebb1d62a', 'LIQ11', 'Alkohol 70% 300ml Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:47', '2023-03-09 00:55:47', NULL),
('38ca40ce-4e67-4e01-a4ba-4716577b4096', 'PLS10', 'Dermafix-T 10x25', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:13:40', '2023-03-09 01:13:40', NULL),
('38cff0cc-ff2f-4203-95d0-872537087d7a', 'SRG19', 'Altamed Nitril M', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:42:14', '2023-03-09 02:42:14', NULL),
('38d4552d-1753-4b04-9ab6-28259021d4d4', 'MSK06', 'Masker Karet Kuning OM', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:06:38', '2023-03-09 01:06:38', NULL),
('39123190-b5dd-4b22-9d76-77da5edffd10', 'LIQ18', 'Rivanol 300ml Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:00:10', '2023-03-09 01:00:10', NULL),
('39cee4de-66e1-44da-b646-10d051b1939a', 'SPT11', 'Spuit Terumo 10cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:04:33', '2023-03-09 01:04:33', NULL),
('3a01d691-48e5-4706-ad15-0c44b43bf15c', 'TRM02', 'Thermo Dig Alpha 3 OM', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:03:55', '2023-03-09 03:03:55', NULL),
('3a23a7bc-c9a2-469e-ad7d-e6c4ae7cc5ac', 'STR05', 'Strip ET UA (Asam Urat)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:57:03', '2023-03-09 02:57:03', NULL),
('3a38921b-2b29-414b-8035-60ba9b394919', 'KAS01', 'Verban 5cm', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:44:57', '2023-03-09 00:44:57', NULL),
('3a6a49b9-2182-41e6-99d6-9b1f4c2cb7b2', 'JRM44', 'Jarum 18G Agani Terumo', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:44:08', '2023-03-09 00:44:08', NULL),
('3b156ad5-440e-46de-b83f-7aa6f2d651d6', 'TNS08', 'Tensi Jarum Abn', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:01:55', '2023-03-09 03:01:55', NULL),
('3bc68f8d-7d31-499b-a98f-f2649ac5c926', 'SLG30', 'Infuset Dewasa Gea', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:48', '2023-03-09 01:28:48', NULL),
('3ccd1e97-c79a-44e7-89cb-adbb9ae36bcd', 'ALP28', 'Mitela Siku Pembalut', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:54', '2023-03-08 07:18:54', NULL),
('3d7abd13-afe5-4adb-8f3e-94bea791315b', 'GLS12', 'Tabung Erlenmeyer 500ml', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 08:00:27', '2023-03-08 08:00:27', NULL),
('3dba13ee-ad99-4e6e-932a-64f642472b4e', 'PLS11', 'Dermafix S IV 6x7cm 25s', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:14:08', '2023-03-09 01:14:08', NULL),
('3e0403d6-02ee-4b99-ad70-2509309deb6d', 'OBT09', 'Mortir Stamper 10cm', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:10:38', '2023-03-09 01:10:38', NULL),
('3e665fbb-33fb-439a-8f58-a3a03b7b7e0a', 'TRM07', 'Termometer Dig Kulkas', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:04:35', '2023-03-09 03:04:35', NULL),
('3e96144b-deec-4518-95b0-08a7a1ab27d8', 'GLS02', 'Pipet Pendek', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:27:47', '2023-03-08 07:27:47', NULL),
('3ec5c9dd-6140-4a24-bf82-234341bc2eb9', 'LIQ06', 'Asrhrol 70% 5L', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:05', '2023-03-09 00:55:05', NULL),
('3f13bb9c-6d60-4694-bf3d-637cb4c02db3', 'LIQ20', 'Povidone Iodine 60ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:00:32', '2023-03-09 01:00:32', NULL),
('3f6d5c88-1e43-4f1b-a22f-d330526e666e', 'ACC05', 'Gelang ID Bayi/ Anak', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:24', '2023-03-08 06:55:24', NULL),
('3fe691ee-a1f2-4279-9f97-84493a38a836', 'OBT06', 'Sharp Blender Obat', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:09:59', '2023-03-09 01:09:59', NULL),
('40c92e07-9487-4096-8384-eb3475068645', 'GLS05', 'Deck Glass 24x40', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:28:20', '2023-03-08 07:28:20', NULL),
('41363fb1-218e-4028-b25e-f35fa005763b', 'SRG06', 'Maxter Steril 7', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:55:27', '2023-03-09 01:55:27', NULL),
('41a698b4-23c7-4fc9-8510-ad16936c99cd', 'ABB06', 'Kruk Ketiak S', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:46:35', '2023-03-08 06:46:35', NULL),
('41ab950d-d0ac-4b3a-b4c6-9cc490302ac7', 'LIQ22', 'Handrub Asrub 5L', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:00:53', '2023-03-09 01:00:53', NULL),
('41bd0d6a-1b6d-4f30-9970-aff734b71e85', 'ALP08', 'Arm Sling M', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:14:50', '2023-03-08 07:14:50', NULL),
('4203362c-52d8-46be-ac73-1e8c862a4d46', 'SLG23', 'Stomach Tube No.16 Terumo', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:27:36', '2023-03-09 01:27:36', NULL),
('421f0f1c-78e1-4b63-a4da-76728bd59fd3', 'STR11', 'Strip Benechek Cholesterol', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:58:31', '2023-03-09 02:58:31', NULL),
('42729613-9e58-4c73-a301-b4ede266461f', 'STR13', 'Strip Autochek Gula', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:58:49', '2023-03-09 02:58:49', NULL),
('43153e54-3113-4f1d-bd4a-c6500824c6bf', 'ABB15', 'Walker Sella', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:45', '2023-03-08 06:47:45', NULL),
('434f7327-0bd7-425a-84ef-179411c04d57', 'RSG08', 'Right Sign Hcg Strip', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:40:26', '2023-03-09 01:40:26', NULL),
('43dc4a06-afe8-4f6d-9a5c-5f81ddad60d9', 'OBT03', 'Kapsul 1', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:09:17', '2023-03-09 01:09:17', NULL),
('440691f4-38f5-4dcd-bd99-d5723e9792c0', 'SCL04', 'Timbangan Badan Injak OM', 0, 'Kg', NULL, '45ca4eb4-eeca-464f-b7b5-3cc1c4a5b6bd', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:21:20', '2023-03-09 01:21:20', NULL),
('442913c2-5c01-45a6-920e-3798ed2bceb3', 'POT06', 'Pot Y 65gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:18:14', '2023-03-09 01:18:14', NULL),
('46173670-33d0-4b79-8478-2ba124921dc8', 'TNS15', 'Manset Dewasa', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:51', '2023-03-09 03:02:51', NULL),
('461929e8-0e07-4f3b-adfe-59a2aa7f9513', 'RSG28', 'Right Sign Amp Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:53:27', '2023-03-09 01:53:27', NULL),
('46d2bf7a-15b9-4aaf-b2f6-e1d78643a587', 'SLG43', 'Hi-Oxy Mask Dewasa', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:31:11', '2023-03-09 01:31:11', NULL),
('471aefe5-3580-4965-91f3-da16142eadd7', 'JRM34', 'Jarum Mani SE-TH 45', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:42:07', '2023-03-09 00:42:07', NULL),
('47c940c3-cd70-4f79-b6f8-611a793c63b0', 'ALT08', 'Alat Gula Uright', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:23', '2023-03-08 07:20:23', NULL),
('4841d5d6-cccb-489f-ab2d-16e1ed1deecc', 'TNS02', 'Tensi Digital Hem 7130 Omron', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:00:56', '2023-03-09 03:00:56', NULL),
('4874f426-d9f3-4c7b-a7a6-978c0f2b0e3d', 'KAS03', 'Verban 15cm', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:45:16', '2023-03-09 00:45:16', NULL),
('4b8f56fc-d542-4f2d-a510-5d4143a50a77', 'SLG31', 'Infuset Anak OM', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:56', '2023-03-09 01:28:56', NULL),
('4d0f19b6-05cb-4ada-bf80-695c93ebf4f0', 'LIQ30', 'Ultrasonic Gel 250gr', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:02:09', '2023-03-09 01:02:09', NULL),
('4d903c7a-03ea-4993-8376-ca2d60e52a2e', 'GIG03', 'Cotton Roll Size 1', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:10', '2023-03-08 07:26:10', NULL),
('4df0becb-4fe1-42af-ab81-1db0b32f3521', 'GLS04', 'Deck Glass 24x24', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:28:12', '2023-03-08 07:28:12', NULL),
('4e405806-4511-4dc0-b7ea-7356454f41c0', 'JRM24', 'Abbocath 26G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:39:41', '2023-03-09 00:39:41', NULL),
('4f199cc2-8eaa-4b60-88bf-8830bec74fdd', 'INS29', 'Gunting TATA Bengkok 14cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:25', '2023-03-08 07:25:25', NULL),
('50fee4b6-e905-4dce-89c1-064eb98dfd9e', 'LIQ10', 'Alkohol 70% 100ml Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:39', '2023-03-09 00:55:39', NULL),
('51fc54ef-47a4-4ed6-bf27-e0f9dbe982e2', 'ALT07', 'Alat Cholesterol Mission', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:17', '2023-03-08 07:20:17', NULL),
('525e537f-0215-4658-ad4e-30a739a3e91f', 'ABB07', 'Kruk Ketiak M', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:46:41', '2023-03-08 06:46:41', NULL),
('534d4f96-fd13-4958-869b-36f813a94caa', 'RSG29', 'Right Sign Thc Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:53:36', '2023-03-09 01:53:36', NULL),
('53807223-1cf9-4a2c-acc3-6c1c600377c9', 'TNS16', 'Manset Anak Manual', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:59', '2023-03-09 03:02:59', NULL),
('53c6546b-e549-4022-9a73-15ff664d3c53', 'SLG08', 'Fol Cath Well Lead No.18', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:24:53', '2023-03-09 01:24:53', NULL),
('54a6200b-ef03-4bb6-8a3b-dead996fcfb2', 'RSG24', 'Right Sign Met Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:48:59', '2023-03-09 01:48:59', NULL),
('5589d6be-d6e4-43ea-bb8c-9a8c63dd4b84', 'SRG15', 'Sarung Tangan Obgyn Non Steril', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:41:34', '2023-03-09 02:41:34', NULL),
('5718055a-d2d7-4db0-86e3-89022e37f516', 'SRG20', 'Safeglove Exam S', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:43:00', '2023-03-09 02:43:00', NULL),
('5783b5d7-f8ad-43f2-8ae1-517d7ff431ca', 'RSG17', 'Right Sign Coc Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:45:22', '2023-03-09 01:45:22', NULL),
('5867c965-1aef-411c-90c3-dc95a00b3cd1', 'INS31', 'Gunting TATA Bengkok 20cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:40', '2023-03-08 07:25:40', NULL),
('5871c11e-012e-42aa-ae2f-db698b28628a', 'JRM14', 'Surflo Teumo 18 G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:37:22', '2023-03-09 00:37:22', NULL),
('59eeaa67-3b4c-4d32-bf2a-47331c8c6cd7', 'LAB22', 'Mindray M-53 LH Lyse 500ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:40', '2023-03-09 00:52:40', NULL),
('5a39e1f5-879e-44c8-b2ee-b9af93a635da', 'INS12', 'Gunting Klem U', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:59', '2023-03-08 07:22:59', NULL),
('5b996151-681c-45f5-a83c-ff89479469bb', 'INS28', 'Nald Volder 14cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:17', '2023-03-08 07:25:17', NULL),
('5bb66bec-1e40-465c-9a32-80ed402e16e3', 'PLS09', 'Dermafix-T 10x12', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:13:29', '2023-03-09 01:13:29', NULL),
('5ceea978-7592-4b98-8303-3360401dd319', 'KAS15', 'Oneswab', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:47:13', '2023-03-09 00:47:13', NULL),
('5d608ea2-9d97-4ad5-9ace-e2d7dc9dcad9', 'SRG12', 'Ansel Gammex 8', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:57:07', '2023-03-09 01:57:07', NULL),
('5fa5993f-403b-4a28-ad8a-10cd4f5965dc', 'LAB01', 'Improve Edta 0,5ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:49:19', '2023-03-09 00:49:19', NULL),
('5faab5ec-3fbc-4dcb-a405-3f120fb54e35', 'SLG18', 'NN', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:50:20', '2023-03-09 02:52:17', NULL),
('60aa3f32-9868-4fed-b551-63cabc57a247', 'SLG09', 'Foley Cath Rusch No.12', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:25:02', '2023-03-09 01:25:02', NULL),
('612e52bb-fcbe-40fd-8f1e-2f529634b024', 'SCL02', 'Timbangan Bayi Dig. OM', 0, 'Kg', NULL, '45ca4eb4-eeca-464f-b7b5-3cc1c4a5b6bd', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:20:49', '2023-03-09 01:20:49', NULL),
('615bd766-b61b-4105-9374-470aff11a980', 'OBT04', 'Kapsul 2', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:09:26', '2023-03-09 01:09:26', NULL),
('618f88a7-366a-4c3f-9db9-9bb484a0e7e3', 'ALP02', 'Medicrepe No. 4', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:54', '2023-03-08 06:58:54', NULL),
('619919f9-6ab9-4f94-bf65-0178b078bc84', 'ABK04', 'Brespum Mami', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:49:25', '2023-03-08 06:49:25', NULL),
('61c283c2-03ad-436f-b1e9-7cc94c486a71', 'ABB12', 'Trolley Oksigen Besar', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:21', '2023-03-08 06:47:21', NULL),
('61edbaac-d5ed-4b3e-9889-ac7d6878d766', 'APD02', 'Soes Cover OM', 0, 'Kg', NULL, '623b10e3-334e-4507-9895-be42fcd67ef5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:53:59', '2023-03-08 06:53:59', NULL),
('624385e8-b8f4-4b18-9264-e7bf2d3733a1', 'LAB19', 'Mindray M-53 Leo I lyse 1L', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:13', '2023-03-09 00:52:13', NULL),
('62669a3d-ef39-4a24-94d2-14e6dc46202f', 'SLG36', 'Maxyflow Anak', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:29:45', '2023-03-09 01:29:45', NULL),
('62cbefee-6b39-450b-b48e-0051e4ee8580', 'KER05', 'Kertas Golongan Darah', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:48:37', '2023-03-09 00:48:37', NULL),
('62ffd013-8649-4b29-996b-f7e8c9731979', 'SLG14', 'Foley Cath Rusch No.22', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:25:58', '2023-03-09 01:25:58', NULL),
('645fe87d-db40-400d-9569-11b585b8eaeb', 'SLG20', 'NN', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:50:42', '2023-03-09 02:52:23', NULL),
('65bd2aeb-27e6-4cbb-92ad-cc0a39802a90', 'SLG37', 'Maxyflow Dewasa', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:29:56', '2023-03-09 01:29:56', NULL),
('660ca700-1042-42fb-8786-01da644960eb', 'ALP27', 'Softban 6\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:48', '2023-03-08 07:18:48', NULL),
('664d1f35-657d-4379-a25d-f59edcc1103e', 'ABK06', 'Hearing Aid Sammora', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:50:39', '2023-03-08 06:50:48', NULL),
('66939559-d784-439e-b82a-c87f7d40bb51', 'INS24', 'Bisturi Bbraun 515', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:24:40', '2023-03-08 07:24:40', NULL),
('66ef8dd6-3127-4ee0-89f5-d115eaddff4d', 'SLG32', 'Infuset Dewasa OM', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:29:05', '2023-03-09 01:29:05', NULL),
('66f6259e-23fb-419a-870c-dc69ad00baee', 'KAS14', 'Alcoswab', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:47:03', '2023-03-09 00:47:03', NULL),
('676f3780-496a-4a3d-af28-5079e0abc8bb', 'LIQ02', 'Asrhrol 70% 250ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:54:27', '2023-03-09 00:54:27', NULL),
('67eff074-1367-4be2-888e-5834f832f828', 'ABK07', 'Doppler Lcd Bistos', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:50:59', '2023-03-08 06:50:59', NULL),
('6917237b-31d5-4490-b554-932218595c8c', 'PLS17', 'Leukoplast 2,5x1', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:15:39', '2023-03-09 01:15:39', NULL),
('6925318e-7374-46c8-9019-51613e7d4432', 'JRM16', 'Surflo Teumo 22 G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:37:50', '2023-03-09 00:37:50', NULL),
('6a56b670-4776-4d0e-9845-94cc4f175800', 'GIG06', 'Sonde Half Moon', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:35', '2023-03-08 07:26:35', NULL),
('6a822275-3a00-4ae4-9793-a535e0ecd1e2', 'TRM03', 'Thermo Dig Avico', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:04:03', '2023-03-09 03:04:03', NULL),
('6a89a0f3-0113-4132-a5c6-86408d606c59', 'TNS13', 'Manset Dig Tensione XL', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:34', '2023-03-09 03:02:34', NULL),
('6ab2b902-845f-4e9f-abc7-9cfecdd57aa3', 'MSK10', 'Masker Orlee Hitam', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:07:31', '2023-03-09 01:07:31', NULL),
('6b55f4e9-585d-4275-b656-1f963eb18935', 'TNS10', 'Stetoscope Abn', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:10', '2023-03-09 03:02:10', NULL),
('6b5a70b6-3975-4024-884f-e92823d1ecd0', 'RSG09', 'Right Sign Typhoid Igg/Igm', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:40:34', '2023-03-09 01:40:34', NULL),
('6bedc028-cd0c-4287-b672-b36aea6be91c', 'ACC14', 'Pengukur Tinggi Badan Barner', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:56:29', '2023-03-08 06:56:29', NULL),
('6c538ac6-958f-4f67-955d-c66f8490b88b', 'ALP09', 'Arm Sling L', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:00', '2023-03-08 07:15:00', NULL),
('6da1f985-2893-48af-942b-b1e2800d4030', 'KAS02', 'Verban 10cm', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:45:06', '2023-03-09 00:45:06', NULL),
('6f4c3e71-57b8-49ae-aa38-9162ea1f7228', 'MSK02', 'Masker Hijab Altamed', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:05:53', '2023-03-09 01:05:53', NULL),
('6f62d24d-ac71-4df6-9307-a55cb33b9098', 'ALP23', 'Korset L', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:19', '2023-03-08 07:18:19', NULL),
('6fb48f33-83e9-43b0-ac89-9106e70a8c58', 'SLG01', 'Nasal Anak Gea', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:23:16', '2023-03-09 01:23:16', NULL),
('6febbded-4e6b-44b5-bbd3-890f7a7eb9c0', 'STR09', 'Strip Nesco UA (Asam Urat)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:58:09', '2023-03-09 02:58:09', NULL),
('70931d1b-804c-43a6-b3b4-4570a1f2acbe', 'JRM25', 'Catgut Plain 2.0', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:40:22', '2023-03-09 00:40:22', NULL),
('70a40ef3-272c-46b2-bd7f-39eae5670eec', 'RSG26', 'Right Sign Mop strip', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:53:05', '2023-03-09 01:53:05', NULL);
INSERT INTO `products` (`id`, `code`, `name`, `price`, `unit`, `desc`, `category_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('71a21f79-3c52-4faf-80fe-57a33c0d0c24', 'ABB21', 'Footstep Besi', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:33', '2023-03-08 06:48:33', NULL),
('7240bb01-ae71-458a-88c4-2f78f91746f1', 'KAS16', 'Underpad OM DRJ', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:47:23', '2023-03-09 00:47:23', NULL),
('72980211-43ca-493d-a607-490509e1a714', 'PLS07', 'Ultrafix 10x5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:12:49', '2023-03-09 01:12:49', NULL),
('72a15c7e-e08e-4d82-b4cb-3255f02956bf', 'ACC03', 'ECG Elektroda Anak OM Pack/ 50', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:09', '2023-03-08 06:55:09', NULL),
('73115636-320c-498e-8b89-6528a871dd09', 'MSK03', 'Masker Karet Biru OM', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:06:04', '2023-03-09 01:06:04', NULL),
('73a03377-5844-4caf-b4aa-99f566e98061', 'TRM01', 'Thermo Dig Alpha 1 OM', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:03:46', '2023-03-09 03:03:46', NULL),
('7421e452-597d-4bc8-964a-8677b7e5e710', 'MSK01', 'Masker Earloop Altamed', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:05:42', '2023-03-09 01:05:42', NULL),
('76598e31-1caf-43ac-8093-aecec5ed1c43', 'LIQ17', 'Rivanol 100ml Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:00:01', '2023-03-09 01:00:01', NULL),
('77e46490-b9c6-4b54-89ea-5468dda9b126', 'POT02', 'Pot T3 10gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:17:32', '2023-03-09 01:17:32', NULL),
('78aab4cf-0b18-4ba4-8b78-fb932e907d71', 'LIQ09', 'Alkohol 70% 1L OM', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:31', '2023-03-09 00:55:31', NULL),
('78dab03c-9339-49fb-bfd4-711197132f57', 'GLS01', 'Objek Glass Frosted', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:27:34', '2023-03-08 07:27:34', NULL),
('78f3ee89-dd19-4505-9884-fbc24aff102c', 'JRM35', 'Jarum Mani SE-TH 55', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:42:15', '2023-03-09 00:42:15', NULL),
('79c33a31-906a-4b94-8155-0c4149271ac1', 'INS26', 'Partuset', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:25:00', '2023-03-08 07:25:00', NULL),
('7a398dff-0dcf-4450-afc7-e4ec6847d3f5', 'TNS09', 'Tensi Jarum Spygmed', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:03', '2023-03-09 03:02:03', NULL),
('7a7e1942-0453-49c2-832d-36240c60ae5d', 'LIQ27', 'Aseptic Gel+Disp 500ml OM', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:01:40', '2023-03-09 01:01:40', NULL),
('7a8bd0af-5b8e-49a3-8821-16d9d87e952c', 'JRM21', 'Abbocath 20G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:39:01', '2023-03-09 00:39:01', NULL),
('7aea377f-6a71-4d80-8a02-c14f7bb6e7a5', 'STR06', 'Strip ET Hb', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:57:18', '2023-03-09 02:57:18', NULL),
('7afb2c1d-b320-4e5e-b301-e7105ccf5a62', 'LIQ31', 'Ultrasonic Gel 5L', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:02:19', '2023-03-09 01:02:19', NULL),
('7b9aff7e-1139-427a-9753-00868ae3bdbc', 'ALP14', 'Gypsona 4\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:44', '2023-03-08 07:15:44', NULL),
('7bdde3e3-b8f0-41d7-9bbc-9a78854cb897', 'SRG02', 'Safeglove Nitril Exam S', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:54:38', '2023-03-09 01:54:38', NULL),
('7c860eec-07f0-4d08-bcdc-1dcd23b90a41', 'PLS03', 'Hypafix 10x5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:12:03', '2023-03-09 01:12:03', NULL),
('7ca92901-a80c-41b7-b29f-43b06e0fe86b', 'SLG12', 'Foley Cath Rusch No.18', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:25:37', '2023-03-09 01:25:37', NULL),
('7cbb7776-88be-47c2-9d64-14242cff7876', 'ACC09', 'Lampu Baca Rongsent', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:53', '2023-03-08 06:55:53', NULL),
('7d59ac8c-b41c-4ce0-8fcc-62d92e58f223', 'ABB13', 'Tabung Oksigen Kecil', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:29', '2023-03-08 06:47:29', NULL),
('7d706814-fedb-4f5e-ab6f-da848f5e6baf', 'LAB04', 'Improve Clot Activator Tube 4ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:49:48', '2023-03-09 00:49:48', NULL),
('7e508bf2-fdee-44b0-9d27-55e38822885e', 'RSG16', 'Right Sign Troponin I', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:43:43', '2023-03-09 01:43:43', NULL),
('7f0cccfe-9344-4337-887c-6106d8bf284b', 'MSK05', 'Masker Karet Ungu OM', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:06:27', '2023-03-09 01:06:27', NULL),
('7f3b393c-54c2-44be-919f-0e02fbed0eec', 'JRM15', 'Surflo Teumo 20 G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:37:38', '2023-03-09 00:37:38', NULL),
('7f72cca8-ae23-4f3c-a9aa-441601b854ac', 'STR08', 'Strip Nesco Cholesterol', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:57:52', '2023-03-09 02:57:52', NULL),
('7f7b6c9e-713d-4760-a715-a206d8bbf80e', 'GIG11', 'Alat Kamera Gigi set', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:27:12', '2023-03-08 07:27:12', NULL),
('7f97bef0-3129-46d9-a68e-befff9b6bd4b', 'JRM12', 'Jarum Microfine Biru BD', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:37:04', '2023-03-09 00:37:04', NULL),
('82344cd5-9f05-49af-89dd-97921f2c7318', 'SLG10', 'Foley Cath Rusch No.14', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:25:11', '2023-03-09 01:25:11', NULL),
('8302d2b0-bb2d-4b20-93e6-579528dc2abd', 'JRM08', 'Jarum BD 25G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:36:27', '2023-03-09 00:36:27', NULL),
('8486bc9f-676d-476e-9df0-cabd8500a626', 'SPT02', 'Spuit BD 5cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:02:51', '2023-03-09 01:02:51', NULL),
('84d2e0ef-95a7-4210-8fed-483a65ea2c50', 'JRM32', 'Wing Needle 27G OM', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:41:48', '2023-03-09 00:41:48', NULL),
('8508366b-d754-43a4-b94e-51f4e9a82143', 'PLS01', 'Hypafix 5x1', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:11:38', '2023-03-09 01:11:38', NULL),
('85c5ccc1-d55e-4759-8bf3-4c0fce063255', 'SLG02', 'Nasal Dewasa Gea', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:23:41', '2023-03-09 01:23:41', NULL),
('85f441ec-8baf-4f95-829b-cd7f04e113e7', 'LAB10', 'Tabung Centrifuge Pcr 1,5', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:50:44', '2023-03-09 00:50:44', NULL),
('86eeeca7-cb52-42f1-9aae-2cb39bbcdfce', 'KAS09', 'Kapas 250gr', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:46:13', '2023-03-09 00:46:13', NULL),
('87ad14d2-c343-4151-b29f-3fa5bf1f8645', 'JRM29', 'Catgut Silk 2.0', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:41:13', '2023-03-09 00:41:13', NULL),
('87e31c65-f09e-4198-b4f2-77e75330eec7', 'KER02', 'Kertas Puyer Besar (8,3x12,5)', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:47:54', '2023-03-09 00:47:54', NULL),
('8805bfc3-3594-4521-9c5b-a133646cf5ac', 'RSG27', 'Right Sign Oxy Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:53:14', '2023-03-09 01:53:14', NULL),
('8828b3a1-dcdb-41e5-918a-0d6dc8d5d692', 'TRM06', 'Hygrometer HTC-2', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:04:27', '2023-03-09 03:04:27', NULL),
('883475a9-e234-4183-bd52-aceffe24681a', 'SLG03', 'Oxyflow Bayi OM', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:24:00', '2023-03-09 01:24:00', NULL),
('88aa3ffe-886d-4896-8fa9-45ffa2560f42', 'RSG19', 'Right Sign Bar Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:45:44', '2023-03-09 01:45:44', NULL),
('88aadb51-5405-4717-9ea8-d667f77d0b3f', 'SRG04', 'Safeglove Nitril Exam L', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:55:11', '2023-03-09 01:55:11', NULL),
('88e278fa-94eb-4b1a-8836-cf255251d9c3', 'INS01', 'Gunting TJ/ TJ', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:42', '2023-03-08 07:20:42', NULL),
('88fd242e-a086-4b4b-8d54-1c4a4ae8bfaf', 'INS18', 'Reflek Hammer Buck', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:51', '2023-03-08 07:23:51', NULL),
('8a6c4cf5-8c5b-49d1-a6b0-19a56159df10', 'SPT10', 'Spuit Terumo 5cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:04:19', '2023-03-09 01:04:19', NULL),
('8bebd165-3ec2-4dbb-a603-2b4ad0979e95', 'LIQ13', 'Alkohol 95% 100ml Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:56:05', '2023-03-09 00:56:05', NULL),
('8c23c21d-aa6c-4dbe-b1fd-197e9c50450c', 'ACC15', 'Penlight Led', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:56:35', '2023-03-08 06:56:35', NULL),
('8c791101-e8a6-43bb-bdda-4d22b151b43f', 'STR17', 'Strip Mission Cholesterol (25)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:59:32', '2023-03-09 02:59:32', NULL),
('8e128736-9220-4d6f-af58-947d070150f5', 'ABB09', 'Oksigen Set', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:46:58', '2023-03-08 06:46:58', NULL),
('8ece4a1b-d02b-46e9-bf94-eeee2838c957', 'SPT13', 'Spuit Terumo 1cc Tuberculin', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:04:54', '2023-03-09 01:04:54', NULL),
('8efb19c0-3ad2-4e4b-beb1-c985e70a3693', 'STR22', 'Urit 11G', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:00:28', '2023-03-09 03:00:28', NULL),
('8f04760e-339f-47f6-8d1a-d7f0b0ad9406', 'LIQ03', 'Asrhrol 70% 300ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:54:36', '2023-03-09 00:54:36', NULL),
('8f3bd5d4-0e37-4f98-9da0-44e8a1785c85', 'LAB17', 'Mindray M-52D Lyse 500ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:51:56', '2023-03-09 00:51:56', NULL),
('8f574efd-adde-47e7-92de-8dcc5a9c2005', 'LAB20', 'Mindray M-53 Leo II lyse 200ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:22', '2023-03-09 00:52:22', NULL),
('903d5fc8-aebc-4a6a-bd8f-45d27768ab1a', 'SLG40', 'Suction Catheter 14', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:30:34', '2023-03-09 01:30:34', NULL),
('904b587f-2def-4355-9ed7-908fd1b42f54', 'LAB25', 'Golongan Darah Anti B Tulip', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:53:07', '2023-03-09 00:53:07', NULL),
('904cd6e6-b26c-44fa-bb59-0b437d361e84', 'MSK09', 'Masker Orlee Putih', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:07:21', '2023-03-09 01:07:21', NULL),
('908b2ec0-9dac-4c5e-a473-243835db7e7e', 'GLS09', 'Gelas Ukur 500ml', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:29:12', '2023-03-08 07:29:12', NULL),
('908b4e2f-4b1d-4508-88d6-ef2365a6a370', 'KER07', 'Kertas Ecg 215x25m', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:49:02', '2023-03-09 00:49:02', NULL),
('90eb4fe5-c2e7-4d80-aff2-ee80061e2fe7', 'JRM31', 'Wing Needle 25G OM', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:41:38', '2023-03-09 00:41:38', NULL),
('912cf4c1-2175-41cb-bbff-48821b86a7dc', 'SLG05', 'Masker Nebulizer Anak Gea', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:24:21', '2023-03-09 01:24:21', NULL),
('917166b9-e719-4022-bfaa-185f50c14d03', 'LAB23', 'Mindray M-53 Diluent 20L', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:49', '2023-03-09 00:52:49', NULL),
('936dbfcc-2c51-44bf-9fc6-b00ecccb8b0e', 'TNS06', 'Tensi Dig Yuwell D', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:01:33', '2023-03-09 03:01:33', NULL),
('93e0732c-f154-41d4-bb75-e90c287ad098', 'JRM41', 'Jarum Akupuntur 0,20x13', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:43:34', '2023-03-09 00:43:34', NULL),
('94762489-16e1-41a2-818a-ada622faf7b6', 'ALP18', 'Celana Khitan L', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:16:20', '2023-03-08 07:16:20', NULL),
('95522b52-c5a8-4bfd-8e0e-f5956648eb48', 'TNS17', 'Bulb Tensi Abn', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:03:06', '2023-03-09 03:03:06', NULL),
('9578aa1d-e879-477c-8c25-3b6fa7bc2c75', 'POT04', 'Pot T6 20gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:17:54', '2023-03-09 01:17:54', NULL),
('95feb9de-cf7e-4f13-9e40-1d25baaeb8a8', 'STR07', 'Strip Nesco Gula', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:57:32', '2023-03-09 02:57:32', NULL),
('96540e56-e3f3-48eb-b10d-76bd758d1da1', 'ALP19', 'Celana Khitan XL', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:17:47', '2023-03-08 07:17:47', NULL),
('968af7ae-8d5a-43df-925a-5e0ea95abfc9', 'ALP11', 'Arm Sling Weldaco M', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:20', '2023-03-08 07:15:20', NULL),
('96bdee88-5b7c-4010-b315-c0a41f3d44dd', 'JRM01', 'Inflo 18G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:35:12', '2023-03-09 00:35:12', NULL),
('96cbf346-d321-40ac-904c-2d4dbc544cfc', 'LAB31', 'BloodBag Double 350ml Terumo', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:54:02', '2023-03-09 00:54:02', NULL),
('9788f56e-9ce9-4cb8-84f6-3fbd39af3a5b', 'OBT10', 'Mortir Stamper 13cm', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:11:02', '2023-03-09 01:11:02', NULL),
('97bcbc01-fcb9-44b7-a334-f75a01296d24', 'ALP26', 'Softban 4\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:41', '2023-03-08 07:18:41', NULL),
('97eb504f-d4b3-40d5-9c02-df8bcc90c5b1', 'POT03', 'Pot T4 15gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:17:43', '2023-03-09 01:17:43', NULL),
('98aa01a1-921b-4317-a132-12844b606e97', 'PLS19', 'Leukoplast 5x4,5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:16:02', '2023-03-09 01:16:02', NULL),
('997d4529-6227-4e02-80b8-cfe3c196ba19', 'RSG23', 'Right Sign Mdma Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:48:47', '2023-03-09 01:48:47', NULL),
('9a55a6b9-7dc0-4258-9f0d-ae8849546243', 'RSG01', 'Right Sign Hbsag Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:32:37', '2023-03-09 01:32:37', NULL),
('9a718c7a-02c5-4db5-8d36-6334cfaf0035', 'ACC13', 'Microplate U', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:56:22', '2023-03-08 06:56:22', NULL),
('9ac71764-8b5b-4ab8-a256-53b1a430250e', 'APD03', 'APD Kain Biru', 0, 'Kg', NULL, '623b10e3-334e-4507-9895-be42fcd67ef5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:54:08', '2023-03-08 06:54:08', NULL),
('9afbb993-ebe6-49e7-8db9-5cc8686920e1', 'INS08', 'Sonde Uterus', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:25', '2023-03-08 07:22:25', NULL),
('9b881f03-0252-4964-a822-9e90dd740324', 'PLS20', 'Hansaplast 7,5x4,5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:16:11', '2023-03-09 01:16:11', NULL),
('9ba044dd-4cb5-4ec4-b784-7187dda4e5d1', 'LIQ16', 'Rivanol 300ml OM', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:59:50', '2023-03-09 00:59:50', NULL),
('9bd6b650-7a6e-4002-b0c3-9a06ad81d38e', 'INS04', 'Pinset Chirugis 14cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:21:11', '2023-03-08 07:21:11', NULL),
('9bf7ffc4-bee3-405f-94ef-a167017d1f94', 'INS15', 'Nierbeken Bengkok 20cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:24', '2023-03-08 07:23:24', NULL),
('9c2bb3e5-5f2e-4851-a3cc-d59d987cf94e', 'SLG29', 'Infuset Anak Gea', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:38', '2023-03-09 01:28:38', NULL),
('9e510476-eb4d-478c-befe-0e7c36047f7b', 'GIG05', 'Kaca Mulut', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:28', '2023-03-08 07:26:28', NULL),
('9e62fd06-5987-4f40-a831-94f77e463b68', 'SLG39', 'Condom Catheter L', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:30:19', '2023-03-09 01:30:19', NULL),
('9e696ee5-729f-4c56-a111-595c68361736', 'MSK08', 'Masker Hijab Hijau OM', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:07:05', '2023-03-09 01:07:05', NULL),
('9fec9cca-1584-48d2-9ae6-a055753b2bf4', 'PLS21', 'Hansaplast 1,25x1', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:16:19', '2023-03-09 01:16:19', NULL),
('9ff77cb9-ca92-480e-a2cc-15f3cdbb3c72', 'RSG14', 'Right Sign Multi Drug 3p', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:43:14', '2023-03-09 01:43:14', NULL),
('a082797d-c2ec-4ec2-98ff-12aaeb6f60a7', 'INS17', 'Reflek Hammer Segitiga', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:40', '2023-03-08 07:23:40', NULL),
('a0b3fc59-c793-442c-8f91-11dc3271c6d7', 'LAB13', 'Mindray M-30P Probe Cleanser 17ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:51:10', '2023-03-09 00:51:10', NULL),
('a11801af-65ec-4024-af01-731eddf2e9c3', 'JRM36', 'Jarum Mani SE-ME 21', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:42:26', '2023-03-09 00:42:26', NULL),
('a139f71c-758f-4af6-8060-7b9520dfe8fe', 'LAB30', 'Gp Edta Ungu K3', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:53:53', '2023-03-09 00:53:53', NULL),
('a18a626e-8e79-430d-a397-a73b7e2b5cd8', 'ALP06', 'Tensocrepe 6\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:14:22', '2023-03-08 07:14:22', NULL),
('a1a6fd90-ae30-4a13-9635-60fc88e824c3', 'ALP22', 'Korset M', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:09', '2023-03-08 07:18:09', NULL),
('a27b0a3c-0a49-4734-bb65-c93c5a9c9edc', 'ALT01', 'Alat Clever Gula', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:33', '2023-03-08 07:19:33', NULL),
('a3475ff7-bdbb-45ae-9b7d-63fe94fbd7a7', 'SRG16', 'Handscoon Altamed S', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:41:42', '2023-03-09 02:41:42', NULL),
('a44164e2-a28b-4cb3-856f-1c8253cfa9df', 'LIQ19', 'Povidone Iodine 30ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:00:20', '2023-03-09 01:00:20', NULL),
('a453a5ab-35bf-4c1c-908b-f7251b75a45a', 'INS21', 'Klem Arteri Pean 14cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:24:14', '2023-03-08 07:24:14', NULL),
('a487a9ac-f425-4f64-9ad8-e2a03af04fe1', 'PLS14', 'Micropore 1/2\" Winner', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:14:49', '2023-03-09 01:14:49', NULL),
('a4c04e48-6ade-4df9-8a25-cf66554799fb', 'GLS11', 'Pengaduk Kaca Panjang', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 08:00:08', '2023-03-08 08:00:08', NULL),
('a4c88e08-64a3-4e94-a85f-f2f888bd6fec', 'ACC02', 'ECG Fukuda 50x30m', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:00', '2023-03-08 06:55:00', NULL),
('a4d09441-4172-4a6c-8343-fcc7abb3e827', 'INS07', 'Gunting 1/2 Koker', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:14', '2023-03-08 07:22:14', NULL),
('a4d51ae1-f330-4f1e-b338-6ae39ce8b762', 'APD05', 'APD Gown Head Cup', 0, 'Kg', NULL, '623b10e3-334e-4507-9895-be42fcd67ef5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:54:27', '2023-03-08 06:54:27', NULL),
('a4fb54e9-b273-4694-a258-204f1dc9b17c', 'OBT05', 'Kapsul 3', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:09:44', '2023-03-09 01:09:44', NULL),
('a581f2ca-2694-4227-8d7f-f8f80d155224', 'APD01', 'Nurse Cup 100 OM', 0, 'Kg', NULL, '623b10e3-334e-4507-9895-be42fcd67ef5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:52:09', '2023-03-08 06:53:43', NULL),
('a5c80661-d67c-4cef-95e9-3437b39ec364', 'RSG18', 'Right Sign Coc Strip', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:45:34', '2023-03-09 01:45:34', NULL),
('a6006337-b2a8-463b-9f24-1f9935abde40', 'SRG07', 'Maxter Steril 7,5', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:56:00', '2023-03-09 01:56:00', NULL),
('a652186f-c18a-4eb4-9758-c2411134081f', 'RSG20', 'Right Sign Bzo Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:45:54', '2023-03-09 01:45:54', NULL),
('a676c6d8-1529-4fe7-8a73-84f7f9d384c2', 'LAB05', 'Yellow Tips', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:49:58', '2023-03-09 00:49:58', NULL),
('a7422353-1e2a-4355-9346-c1cdfed11386', 'RSG31', 'Right Sign Covid -19 Ag', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:54:13', '2023-03-09 01:54:13', NULL),
('a7c5b39c-9026-44f5-9d26-fb4db83bbb6a', 'ALM03', 'Pulse Yuwell', 0, 'Kg', NULL, '74ac957b-b8ec-4332-89fc-474a30650dc7', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:25', '2023-03-08 06:58:25', NULL),
('a7df6201-4d8e-491b-8f42-110d64e09b95', 'SLG26', 'Feeding Tube Fr 5/100cm Terumo', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:09', '2023-03-09 01:28:09', NULL),
('a7e75c7f-b196-4b70-98b6-b2b9c13438fe', 'SLG04', 'Oxyflow Anak OM', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:24:10', '2023-03-09 01:24:10', NULL),
('a813d098-ba46-4a2e-a2c4-bbf48473104f', 'POT01', 'Pot T2 5gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:17:22', '2023-03-09 01:17:22', NULL),
('a837f04d-fdec-4c47-8037-b51bb3b7f7f4', 'OBT02', 'Kapsul 00', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:09:07', '2023-03-09 01:09:07', NULL),
('a87e35a0-19e7-4e61-bc5c-75cd9092d4e1', 'SRG10', 'Ansel Gammex 7', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:56:43', '2023-03-09 01:56:43', NULL),
('a91be512-92be-403f-82b1-f28ee73da518', 'LIQ01', 'Asrhrol 70% 100ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:54:18', '2023-03-09 00:54:18', NULL),
('aa09056f-cf84-4847-9a86-7a35580146da', 'TNS12', 'Manset Dig Omron L', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:26', '2023-03-09 03:02:26', NULL),
('aa179bbd-b379-4442-bacf-b944933707bd', 'OBT08', 'Mortir Stamper 8cm', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:10:19', '2023-03-09 01:10:19', NULL),
('aa3b3e6b-1698-45e0-b85d-27c53e7790e9', 'SLG22', 'Stomach Tube No.14 Terumo', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:27:17', '2023-03-09 01:27:17', NULL),
('aa80c0c2-e4d1-4d1c-ab1e-b37a984b3619', 'SRG17', 'Handscoon Altamed M', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:41:52', '2023-03-09 02:41:52', NULL),
('aaa10cbf-1aeb-40b4-9992-ce2bac6399fc', 'TNS07', 'Tensione 1A Dgn Suara+Adaptor', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:01:47', '2023-03-09 03:01:47', NULL),
('ab2b55cc-a3bb-447d-898c-c19abc1b25d1', 'ACC22', 'Umbilical OM', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:03', '2023-03-08 06:58:03', NULL),
('ab7c6b38-bc69-4ed3-b632-297679902672', 'LAB29', 'Vaculab 3ml Plain OM', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:53:45', '2023-03-09 00:53:45', NULL),
('ab9c9b2a-06d4-4f1b-9489-b380a9c510a1', 'SLG34', 'Colostomy Bag No.5', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:29:25', '2023-03-09 01:29:25', NULL),
('abeee9fc-1527-4456-b192-2acbc01d7388', 'PLS15', 'Isopore', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:15:14', '2023-03-09 01:15:14', NULL),
('aca63e19-da72-4009-a292-7ada1fbeb917', 'ABB05', 'Tongkat dan Tempat Duduk Tripot', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:46:26', '2023-03-08 06:46:26', NULL),
('acfc0fb7-fee3-4d51-8818-68e2b2ad214c', 'INS05', 'Pinset Anatomis', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:21:52', '2023-03-08 07:21:52', NULL),
('ad2f55a2-7eb4-4692-924a-ac0572ad5bc8', 'OBT11', 'Mortir Stamper 16cm', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:11:13', '2023-03-09 01:11:13', NULL),
('ad5763b4-e990-431f-ba16-ab1988eceb43', 'STR15', 'Strip Autochek UA (25)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:59:08', '2023-03-09 02:59:08', NULL),
('ad76ad3a-ac4f-46c3-ab52-0c9075c43df0', 'LAB03', 'Improve Edta K3 Tube 3ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:49:39', '2023-03-09 00:49:39', NULL),
('ad935200-87d4-4519-8d6a-b8ce679fd906', 'STR01', 'Strip Clever Gula (25) Tube', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:56:08', '2023-03-09 02:56:08', NULL),
('b01e79de-dd5b-424e-9124-c73bb9b8e5c3', 'ABB22', 'Manual Hospital Bed 3 Crank', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:40', '2023-03-08 06:48:40', NULL),
('b0a2519c-0302-4eca-afd6-8e98ef136a18', 'SLG21', 'Stomach Tube No.12 Terumo', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:26:39', '2023-03-09 01:26:39', NULL),
('b0abbfd9-aa64-4636-a249-bf9d291344fc', 'SLG28', 'Infuset Otsuka OI-44', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:29', '2023-03-09 01:28:29', NULL),
('b0e34dbb-3854-4743-b1a0-9526b350578c', 'SLG25', 'Feeding Tube 3,5 Terumo 35m', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:00', '2023-03-09 01:28:00', NULL),
('b248ee48-d4cc-4ef2-aa5b-232d42862e9d', 'ALT02', 'Alat ET Gcu 3in1', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:41', '2023-03-08 07:19:41', NULL),
('b2c59783-a11a-4c9a-bef9-28b4dc8b9d0c', 'LAB14', 'Mindray M-30D Diluent 20L', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:51:18', '2023-03-09 00:51:18', NULL),
('b2d1282d-1551-4479-ba51-7a8ad3482d56', 'SLG24', 'Stomach Tube No.18 Terumo', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:27:49', '2023-03-09 01:27:49', NULL),
('b3fa9094-bf2a-4aef-9e28-aa7fc4bf444b', 'LAB02', 'Improvacuter Citrate Tube 2,7ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:49:28', '2023-03-09 00:49:28', NULL),
('b4975c96-ea28-4651-bf0b-6d77d65362dc', 'STR14', 'Strip Autochek Cholesterol (10)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:59:00', '2023-03-09 02:59:00', NULL),
('b4c3d001-a215-44a7-8fcb-2b6cdbcf868f', 'TNS11', 'Stetoscope Spygmed', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:02:18', '2023-03-09 03:02:18', NULL),
('b4cf0e82-c19f-42ad-9b44-b1f6296e02a3', 'RSG13', 'Right Sign Hbsab Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:41:44', '2023-03-09 01:41:44', NULL),
('b587e64f-c919-4974-8e28-42dc01f5876c', 'JRM43', 'Jarum 23G OM', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:43:58', '2023-03-09 00:43:58', NULL),
('b599b8dd-949f-4b7e-9fce-c5b78f44603f', 'INS25', 'Bisturi Bbraun 523', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:24:48', '2023-03-08 07:24:48', NULL),
('b6e09bf0-e020-4ffb-a4c6-c38efa803b11', 'LIQ23', 'Handrub 70% 500ml Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:01:02', '2023-03-09 01:01:02', NULL),
('b7150437-e8bd-4ad5-aa05-434987518564', 'JRM22', 'Abbocath 22G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:39:14', '2023-03-09 00:39:14', NULL),
('b7308f8b-97bc-4604-8f19-545363c7f701', 'SLG48', 'Guedel Clear No. 4 100mm Merah', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:31:55', '2023-03-09 01:31:55', NULL),
('b76b7df0-35a0-4b9e-a999-6cc28aee5568', 'SRG05', 'Maxter Steril 6,5', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:55:18', '2023-03-09 01:55:18', NULL),
('b8488b39-e483-4c63-adac-f5ad670ae372', 'STR20', 'Urine Test 10P Verify', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:00:09', '2023-03-09 03:00:09', NULL),
('b858cad9-d74a-4cb8-af39-a12fa3c1d716', 'INS11', 'Speculum L', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:50', '2023-03-08 07:22:50', NULL),
('b8683523-20ad-4cf9-99a2-7ee9793d7725', 'KAS05', 'Kasa Gulung 40x80 Dinda', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:45:33', '2023-03-09 00:45:33', NULL),
('b86c704b-83ff-4d2c-bdaf-25287fb0ed98', 'STR03', 'Strip ET Gula', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:56:29', '2023-03-09 02:56:29', NULL),
('b8c1078b-d820-482e-a5f3-d8b77f269b92', 'PLS12', 'Plesterin Bulat Pe', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:14:21', '2023-03-09 01:14:21', NULL),
('b933e571-5604-45a7-807f-74431df63f6d', 'ACC08', 'Kotak P3k', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:45', '2023-03-08 06:55:45', NULL),
('b9c25ad9-2aee-44a8-9748-72d929ad27f3', 'JRM09', 'Jarum BD 26G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:36:35', '2023-03-09 00:36:35', NULL),
('b9ce5d92-1e5e-402e-ac57-26cff9c9f5e4', 'TNS04', 'Tensi Digital Hem 8712 Omron', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:01:10', '2023-03-09 03:01:10', NULL),
('b9f2fa26-268d-4fda-bcee-c03758db06e0', 'SLG46', 'Blood Tranfusion Set 20ml', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:31:35', '2023-03-09 01:31:35', NULL),
('ba32d60d-bf59-4f2d-a97a-91e409b6aa34', 'TRM04', 'Thermo Head Yuwell YT1C', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:04:11', '2023-03-09 03:04:11', NULL),
('ba64e706-ebc7-43ce-9f98-40045f0bd160', 'ABK08', 'Doppler Sound Bistos', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:51:19', '2023-03-08 06:51:19', NULL),
('bad61010-0fd4-4b00-b523-9ab19baf1e7c', 'SLG49', 'Urin Bag', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:32:04', '2023-03-09 01:32:04', NULL),
('bb57cc13-43f0-453e-9475-0a2feebe2659', 'ALT03', 'Alat Nesco 3in1', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:48', '2023-03-08 07:19:48', NULL),
('bb9dbb12-3c3d-450b-ba26-9f7ec54c3316', 'ABK11', 'Urinal Pria', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:51:51', '2023-03-08 06:51:51', NULL),
('bbca9ad2-1a3c-4bd5-8480-f0e382a47248', 'TNS01', 'Tensi Digital Hem 6161 Omron', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:00:47', '2023-03-09 03:00:47', NULL),
('bbddac1d-42c5-457e-8a5f-2fb8b7b8592b', 'ALP05', 'Tensocrepe 4\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:14:13', '2023-03-08 07:14:13', NULL),
('bc64df69-4fa2-4d14-a204-a4bec2007fba', 'LIQ07', 'Asrhrol 70% 20L', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:13', '2023-03-09 00:55:13', NULL),
('bd267601-f08d-4b15-8b36-230ec13b87db', 'ABB17', 'Kursi Roda Sella', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:02', '2023-03-08 06:48:02', NULL),
('bd49d3b2-79f2-4b5e-b10b-d463b8643596', 'GLS07', 'Deck Glass 24x60', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:28:54', '2023-03-08 07:28:54', NULL),
('bdf35c79-2d4e-42b0-8528-b3042bfc2f60', 'ABK10', 'Stikpan Besar', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:51:41', '2023-03-08 06:51:41', NULL),
('bf06b5f8-e789-45d5-ad42-323168ed1931', 'JRM19', 'Abbocath 16G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:38:32', '2023-03-09 00:38:32', NULL),
('bfc69d48-91ee-4ede-b775-e01be409b7e2', 'SLG47', 'Tranfusi Set Y JMS', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:31:44', '2023-03-09 01:31:44', NULL),
('c0197641-377e-4377-889d-823cd36af024', 'LIQ08', 'Asrhrol 95% 100ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:22', '2023-03-09 00:55:22', NULL),
('c038ac4b-9eec-406b-8215-38462ba3b29a', 'SLG06', 'Masker Nebulizer Dewasa Gea', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:24:31', '2023-03-09 01:24:31', NULL),
('c243f036-4b14-4de6-9d6c-36febb3673ac', 'OBT01', 'Kapsul 0', 0, 'Kg', NULL, 'c5c2883c-e664-4822-9e74-958557dbf2da', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:08:57', '2023-03-09 01:08:57', NULL),
('c2474a9a-753a-492c-86dd-e66ca938a4bc', 'RSG03', 'Right Sign Hiv Triline', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:32:57', '2023-03-09 01:32:57', NULL),
('c2926f40-9a10-4643-ac65-ffe291055d11', 'ACC07', 'Gelang ID Dewasa Biru', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:37', '2023-03-08 06:55:37', NULL),
('c2d8cebf-8e83-4fa2-88c4-c7c7718cd45f', 'ABB14', 'Tabung Oksigen Besar', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:36', '2023-03-08 06:47:36', NULL),
('c313044f-00df-40a5-bee9-1d1144fae54b', 'GLS03', 'Deck Glass 20x20', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:28:02', '2023-03-08 07:28:02', NULL),
('c3182c40-c60c-4ea2-8437-c2e1a3002ea6', 'ALP07', 'Arm Sling S', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:14:34', '2023-03-08 07:14:34', NULL),
('c327c9fb-95e1-433f-9b07-3dd6cf12e00d', 'GIG02', 'Sikat Gigi Anak', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:02', '2023-03-08 07:26:02', NULL),
('c338656a-fbae-4f5a-838f-80207b902b7c', 'ACC16', 'Pita Lila', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:57:23', '2023-03-08 06:57:23', NULL),
('c33e178a-11c1-4bfc-8947-0e6db687fee8', 'KAS10', 'Kapas 500gr', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:46:26', '2023-03-09 00:46:26', NULL),
('c368fe2c-6454-4bed-b30c-6b0b8a56f34a', 'JRM39', 'Jarum Mani SE-MH 45', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:43:13', '2023-03-09 00:43:13', NULL),
('c36e3880-f106-4b1d-bdfc-67e1331d2697', 'ABB18', 'Kursi Roda Juara', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:11', '2023-03-08 06:48:11', NULL),
('c4547dcf-e593-4338-b247-2a52a0290b72', 'ABB10', 'Regulator Oksigen', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:05', '2023-03-08 06:47:05', NULL),
('c4a9dec5-80e3-4bb1-874d-911d11742032', 'JRM17', 'Surflo Teumo 24 G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:38:00', '2023-03-09 00:38:00', NULL),
('c5133915-4137-4ef0-87cf-d305013a29da', 'ABK03', 'Bantal Panas', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:49:18', '2023-03-08 06:49:18', NULL),
('c5d0d03d-0c62-4e15-81b7-317b45b68a80', 'TRM05', 'Hygrometer HTC-1', 0, 'Kg', NULL, '79faa6e1-8a5d-4540-9895-51d9665f7a9c', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:04:19', '2023-03-09 03:04:19', NULL),
('c63c2629-d8d5-4898-b312-fa071758ad90', 'ALT04', 'Alat Autocheck 3in1', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:55', '2023-03-08 07:19:55', NULL),
('c6536477-89b2-4a2d-9876-4b6143ba657b', 'STR19', 'Urine Test 3P Verify (50)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:00:00', '2023-03-09 03:00:00', NULL),
('c6567fea-8c84-436a-a33a-2ab31df1534e', 'SLG41', 'Suction Catheter 16', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:30:46', '2023-03-09 01:30:46', NULL),
('c73d12af-132f-4bcb-9987-cc11b8446df1', 'INS20', 'Klem Arteri 14cm', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:24:06', '2023-03-08 07:24:06', NULL),
('c7927347-edff-4ef6-9745-586cfcfd9bb8', 'ALM01', 'Nebulizer Omron', 0, 'Kg', NULL, '74ac957b-b8ec-4332-89fc-474a30650dc7', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:11', '2023-03-08 06:58:11', NULL),
('c7aaa978-a755-437f-ac96-bfb85dadc356', 'TNS03', 'Tensi Digital Hem 7156 Omron', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:01:02', '2023-03-09 03:01:02', NULL),
('c8bee919-95d3-4f04-ad9a-b274d4987144', 'LAB11', 'Tabung Centrifuge Urin 15ml 100', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:50:52', '2023-03-09 00:50:52', NULL),
('c9226a99-875f-49ab-9ae4-e84cfc06a78b', 'ABB19', 'Chommode Chair Deluxe', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:48:20', '2023-03-08 06:48:20', NULL),
('c96ca8f8-eca4-4105-a061-18848aac4df2', 'JRM38', 'Jarum Mani SE-MH 21', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:42:49', '2023-03-09 00:42:49', NULL),
('ca67e6b4-2e9b-4f66-a523-fc55487ed250', 'ABB02', 'Tingkat Kaki 3', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:45:00', '2023-03-08 06:45:00', NULL),
('cac249e5-e7a5-426c-8b7f-0c856b04414c', 'POT05', 'Pot P 30gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:18:04', '2023-03-09 01:18:04', NULL),
('cc15200a-01f9-47ee-a335-4d76072a2601', 'ABK09', 'Pencil Couter', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:51:30', '2023-03-08 06:51:30', NULL),
('cddbe38a-f4ea-4605-b6da-bfa0888fbc49', 'LAB21', 'Mindray M-53 Probe Cleanser 50ml', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:52:31', '2023-03-09 00:52:31', NULL),
('ce64cc3b-a0bc-4fc0-b1fa-a4b1b279853f', 'TNS19', 'Adaptor Omron', 0, 'Kg', NULL, 'd20d35fb-9ce6-4df8-9fbd-6062877c6eae', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 03:03:22', '2023-03-09 03:03:22', NULL),
('cef69af9-4a3d-4af9-ad16-2b781d2005d9', 'ALP25', 'Softban 3\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:34', '2023-03-08 07:18:34', NULL),
('d02d3ce0-0ae2-455c-bd8a-f02da92cc833', 'LAB06', 'White Tips', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:50:07', '2023-03-09 00:50:07', NULL),
('d079219d-373f-4f28-b1f6-4287cf5b91eb', 'JRM27', 'Catgut Chromic 2.0', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:40:41', '2023-03-09 00:40:41', NULL),
('d0d3745a-5989-45cf-8b87-5cfbdc48349a', 'SPT14', 'Spuit Terumo 50cc Lubang Pinggir', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:05:03', '2023-03-09 01:05:03', NULL),
('d0d49923-0476-47fc-91bf-168b20ad2cca', 'MSK07', 'Masker Karet Pink OM', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:06:49', '2023-03-09 01:06:49', NULL),
('d0e78014-fa09-4d6f-ad7f-547793116e1b', 'INS06', 'Pinset Splinter', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:04', '2023-03-08 07:22:04', NULL),
('d23e0f84-bca7-4b09-8f3c-33efa6dde2ea', 'RSG06', 'Right Sign Syphilis Strip', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:39:54', '2023-03-09 01:39:54', NULL),
('d36dd48d-037c-4a69-80ef-04c8adf0cff9', 'ALP24', 'Korset XL', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:27', '2023-03-08 07:18:27', NULL),
('d412a056-1f3a-4f7d-ae27-6873cfa2602b', 'SRG13', 'Sarung Tangan Superguard S', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:41:11', '2023-03-09 02:41:11', NULL),
('d442c416-39ff-4eee-889f-fd12df681b08', 'SLG07', 'Fol Cath Well Lead No.16', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:24:41', '2023-03-09 01:24:41', NULL),
('d4acbadd-1fa4-46f3-9907-478f69baa0ea', 'SLG27', 'Feeding Tubr 8/100cm Terumo', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:28:19', '2023-03-09 01:28:19', NULL),
('d578e40e-d4d6-4703-a76c-a1a96566c8b6', 'LIQ12', 'Alkohol 70% 1L Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:55:56', '2023-03-09 00:55:56', NULL),
('d59f1dff-9be1-4404-a995-dc152b51d60c', 'INS03', 'Slip Sonde', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:21:00', '2023-03-08 07:21:00', NULL),
('d616a8ed-34a7-4856-ba8f-45d0a998e161', 'SLG13', 'Foley Cath Rusch No.20', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:25:50', '2023-03-09 01:25:50', NULL),
('d628dbad-78d2-4150-ba49-b6e0668ebd62', 'JRM23', 'Abbocath 24G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:39:25', '2023-03-09 00:39:25', NULL),
('d6c70b5a-b36a-4d65-8823-3098383debe7', 'INS09', 'Speculum S', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:22:34', '2023-03-08 07:22:34', NULL),
('d72c1352-0586-45d7-9f43-9c583545c891', 'KER03', 'Kertas Puyer Print 200', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:48:02', '2023-03-09 00:48:02', NULL),
('da26e39a-6c6f-43d0-adc1-af20934240e9', 'LAB09', 'Tabung Esr 1,28', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:50:35', '2023-03-09 00:50:35', NULL),
('db1a4beb-a429-4948-a4a6-dc1208962d79', 'SLG35', 'Maxyflow Bayi', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:29:35', '2023-03-09 01:29:35', NULL);
INSERT INTO `products` (`id`, `code`, `name`, `price`, `unit`, `desc`, `category_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('db5b28f1-7409-4b36-8dce-1fdf8b4528d9', 'GIG10', 'Suction Saliva', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:27:05', '2023-03-08 07:27:05', NULL),
('dc78b2e8-9f0a-4ed7-8151-b2b984852a7c', 'GIG04', 'Cotton Roll Size 2', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:18', '2023-03-08 07:26:18', NULL),
('dc8bcc3c-3e4a-421c-ad8e-2e8e1540d909', 'STR02', 'Strip Clever Gula (50)', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:56:19', '2023-03-09 02:56:19', NULL),
('dd142929-bc16-45fd-af54-505a52f9c8a9', 'ACC19', 'Snellen Chart', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:57:43', '2023-03-08 06:57:43', NULL),
('dd9b0c4c-d3a8-43f5-a8d4-e62aad707625', 'MSK13', 'Masker Earloop Safelock', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:08:23', '2023-03-09 01:08:23', NULL),
('dda78a81-cec0-4bf1-b33d-158a353aa1bf', 'ALM04', 'Infrared Nesco SN-5I', 0, 'Kg', NULL, '74ac957b-b8ec-4332-89fc-474a30650dc7', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:58:32', '2023-03-08 06:58:32', NULL),
('ddf2b69a-979f-4cd9-a032-cebb99e92649', 'JRM45', 'IV. Cath 26G Gea', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:44:20', '2023-03-09 00:44:20', NULL),
('deb84788-be13-437d-9549-2fe9b909a112', 'JRM02', 'Inflo 20G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:35:25', '2023-03-09 00:35:25', NULL),
('dfaa2a8c-7a29-4a4a-8c80-d85a1de3bb12', 'ALT09', 'Lancing', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:30', '2023-03-08 07:20:30', NULL),
('dfdcd7a8-584f-4610-84db-20fd5bef2b19', 'JRM18', 'Abbocath 14G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:38:17', '2023-03-09 00:38:17', NULL),
('dfe6b37d-dcd6-4884-99b6-ff9867f983e4', 'SPT04', 'Spuit Onemed 3cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:03:10', '2023-03-09 01:03:10', NULL),
('e028aa9d-c276-47c8-b1ce-5c85ab1d55c3', 'SPT08', 'Spuit Onemed 1cc Tuberculin', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:03:53', '2023-03-09 01:03:53', NULL),
('e103f508-1ad7-46c3-a09c-3c901c5365a2', 'ALP20', 'Celana Khitan XXL', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:17:55', '2023-03-08 07:17:55', NULL),
('e369127a-2c71-402b-bf73-ad8ae6a2e1ce', 'ALT05', 'Alat Benechek 3in1', 0, 'Kg', NULL, '0cd85fa7-f0f0-4a3d-b4cb-d4bc46c46bcb', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:20:02', '2023-03-08 07:20:02', NULL),
('e3f70563-d256-498e-88ba-f8f64d61935a', 'ACC18', 'Safety Box Hazard 5L', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:57:36', '2023-03-08 06:57:36', NULL),
('e4610115-00c2-4e13-bcbf-d3fcec3e0e58', 'GIG09', 'Sikat Interdental Set', 0, 'Kg', NULL, '2362d19c-9578-41d9-b183-fdcebe92aa4f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:26:57', '2023-03-08 07:26:57', NULL),
('e5acfdc2-f81d-4f08-ba30-2485773c7417', 'RSG22', 'Right Sign Hav Igm', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:46:13', '2023-03-09 01:46:13', NULL),
('e5c18b93-6a5f-41fc-a7fe-e09ccf0d4b7e', 'PLS08', 'Dermafix-T 5x7', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:13:14', '2023-03-09 01:13:14', NULL),
('e5d86add-d079-47e2-a16d-a2b8815050ab', 'JRM37', 'Jarum Mani SE-ME 24', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:42:35', '2023-03-09 00:42:35', NULL),
('e60d8833-85a4-4f5d-b35b-f2d9acea9bc0', 'JRM10', 'Jarum BD 30G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:36:44', '2023-03-09 00:36:44', NULL),
('e6efad39-df0e-4147-8206-9bd8ee642701', 'ACC21', 'Torniquet', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:57:57', '2023-03-08 06:57:57', NULL),
('e72f8b8e-254b-4174-a61e-9547c83ceac4', 'SLG45', 'Mucus Extractor OM', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:31:27', '2023-03-09 01:31:27', NULL),
('e7b7122e-5dac-443d-adab-e02e016a8820', 'RSG15', 'Right Sign Multi Drug 5p', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:43:25', '2023-03-09 01:43:25', NULL),
('e8209d62-26df-4663-9b37-df53c763fab8', 'JRM40', 'Jarum Mani SE-MH 55', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:43:23', '2023-03-09 00:43:23', NULL),
('e821cfe5-da8c-4e15-beac-e9bdc099fab5', 'LAB07', 'Blue Tips 500', 0, 'Kg', NULL, 'd8f8fdfe-f21e-40cf-a907-21214d4a3498', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:50:17', '2023-03-09 00:50:17', NULL),
('e86725cf-6cbf-4e40-bdb6-bc22a4ac6c76', 'POT08', 'Pot Urin Steril', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:18:37', '2023-03-09 01:18:37', NULL),
('e8a0b7ff-c596-4fd4-8f9b-3369dbe815a4', 'ACC06', 'Gelang ID Dewasa Pink', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:30', '2023-03-08 06:55:30', NULL),
('ea29645a-274c-48af-9b12-3a4bd4d3351f', 'ALP21', 'Korset S', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:18:02', '2023-03-08 07:18:02', NULL),
('ea5a117a-4192-4e03-9a62-01ff699bd061', 'JRM20', 'Abbocath 18G', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:38:50', '2023-03-09 00:38:50', NULL),
('eb19aa89-d100-4543-97cb-ff08660f6968', 'STR12', 'Strip Benechek UA', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:58:39', '2023-03-09 02:58:39', NULL),
('eb546346-e4ee-41a8-ab97-b3ad4f287d8f', 'KER06', 'Kertas Ecg 80x25m', 0, 'Kg', NULL, '8d671b48-6a18-4704-839c-341ef2ee8817', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:48:52', '2023-03-09 00:48:52', NULL),
('eb81fcae-8545-4467-ad38-b4ac3b515bd9', 'SLG33', 'Colostomy Bag No.3', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:29:14', '2023-03-09 01:29:14', NULL),
('ebd5d555-0a0d-482c-a662-e1d1c9c277ec', 'GLS10', 'Corong Lab Panjang', 0, 'Kg', NULL, '2ea2c6fb-555d-4959-8be3-b37f6da28004', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:29:23', '2023-03-08 07:29:23', NULL),
('ec50edd8-ce77-48d7-8f81-11ed7f5db940', 'ACC11', 'Lampu Beurer 1L 21', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:56:07', '2023-03-08 06:56:07', NULL),
('eca54914-8310-43b6-912e-d1043a018d06', 'RSG25', 'Right Sign Mop Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:49:09', '2023-03-09 01:49:09', NULL),
('edba2077-9a69-456b-a417-5efa358c242a', 'ALP31', 'Cervical Collar Resource M', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:16', '2023-03-08 07:19:16', NULL),
('edc8d28b-d08f-42cc-833d-5496295638c1', 'LIQ21', 'Povidone 1L', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:00:43', '2023-03-09 01:00:43', NULL),
('eec5e174-2a7d-401d-ba1a-5bc65e73f638', 'LIQ14', 'Alkohol 95% 1L Medika', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:56:14', '2023-03-09 00:57:35', NULL),
('ef9659ef-15b2-4822-985b-c98c8d07ff07', 'KAS04', 'Kasa Lipat Dinda', 0, 'Kg', NULL, '9a4c7e57-9f32-4ea0-bdef-cfaf4a66637f', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:45:24', '2023-03-09 00:45:24', NULL),
('eff327e3-9fef-4d91-b55c-526cf79751d8', 'MSK12', 'Masker Earloop GTT', 0, 'Kg', NULL, 'd0434f40-f27c-4f7b-9009-b008a6e3f973', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:07:59', '2023-03-09 01:07:59', NULL),
('f21f2560-9f1e-4848-8445-fbb72fef7049', 'SRG01', 'Safeglove Nitril Exam XS', 0, 'Kg', NULL, '4440e1cb-672e-4d4f-ad17-6d2016dd6aa2', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:54:29', '2023-03-09 01:54:29', NULL),
('f288b4b6-1c86-47b0-9efc-8fca6269596f', 'PLS22', 'Hansaplast 1,25x4,5', 0, 'Kg', NULL, '4595290f-d902-49ce-9a6f-f6f34404838d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:16:40', '2023-03-09 01:16:40', NULL),
('f2d0bceb-16ac-4eac-9e4e-4b36d213b6ea', 'LIQ04', 'Asrhrol 70% 500ml', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:54:47', '2023-03-09 00:54:47', NULL),
('f3194bfb-8b4d-4269-9942-d082ca7cf307', 'ALP17', 'Celana Khitan M', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:16:08', '2023-03-08 07:16:08', NULL),
('f330a81f-8fff-442d-96fa-f8a41bd421d1', 'ALP30', 'Jesper Op Knee L', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:08', '2023-03-08 07:19:08', NULL),
('f41e763b-ec47-43b2-8800-e0161e5ca237', 'SPT15', 'Spuit Terumo 50cc Lubang Tengah', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:05:14', '2023-03-09 01:05:14', NULL),
('f41ed805-edae-4140-be8e-73a9356e318d', 'RSG05', 'Right Sign Syphilis Device', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:39:45', '2023-03-09 01:39:45', NULL),
('f432379d-b85f-44e5-ab39-84895283b7b6', 'RSG30', 'Right Sign Thc Strip', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:54:01', '2023-03-09 01:54:01', NULL),
('f457dbec-4222-4216-92f8-bce4998ae486', 'ABK05', 'Alat Bekam 12', 0, 'Kg', NULL, 'a6bfdab5-31a7-49f3-a5f3-27b196881344', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:49:35', '2023-03-08 06:50:21', NULL),
('f5699fa0-033f-4e0f-ad25-459448aee55a', 'JRM28', 'Catgut Chromic 3.0', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:40:50', '2023-03-09 00:40:50', NULL),
('f6d58308-7caf-4b76-bf3f-b755d05d51e5', 'ACC10', 'Lampu Beurer 1L 11', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:55:59', '2023-03-08 06:55:59', NULL),
('f8741937-695e-4b79-9ebe-e62a034ff0f8', 'INS13', 'Bak Intrumen 508 (20x7x4)', 0, 'Kg', NULL, '40cd3e06-4977-476a-ac95-42c92ccc6ba5', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:23:07', '2023-03-08 07:23:07', NULL),
('f8857cf3-e3de-45cf-ad50-6e710ce03624', 'SPT07', 'Spuit Onemed 20cc', 0, 'Kg', NULL, '363afaa3-8c77-4628-8c31-45bba4aa0019', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:03:43', '2023-03-09 01:03:43', NULL),
('fa9df7f1-b68d-4448-8fe7-bc1a645d284c', 'RSG11', 'Right Sign Dengue Igg/Igm', 0, 'Kg', NULL, '63814e26-3859-4fd4-87fc-832bd4fc7000', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:41:23', '2023-03-09 01:41:23', NULL),
('faa734f2-083a-4b1d-90e7-7ee4f83c5bbd', 'ACC01', 'Buku Isihara', 0, 'Kg', NULL, '8e34787b-8acc-4b71-8fd1-c5b39f4a2b84', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:54:52', '2023-03-08 06:54:52', NULL),
('fb33ada1-88e5-4438-a0b9-c4a03eb14420', 'ALP15', 'Gypsona 6\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:54', '2023-03-08 07:15:54', NULL),
('fbade633-f638-4e5d-bab0-8eccf4997981', 'POT07', 'Pot H 90gr', 0, 'Kg', NULL, '6240d8f1-166e-4f4d-b9ff-fb7f3c01b5e0', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 01:18:25', '2023-03-09 01:18:25', NULL),
('fbbbd476-5f27-4cde-9cf0-5a8df42f61e1', 'ABB16', 'Walker Deluxe+ Roda', 0, 'Kg', NULL, '28087d33-1eb6-4c9c-a1e0-7550b385d8c9', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 06:47:55', '2023-03-08 06:47:55', NULL),
('fd071d10-021e-4769-9a66-a456d53d9ea5', 'STR16', 'Strip Biohermes Aic Ez', 0, 'Kg', NULL, '85d90e94-dd93-4113-ba2a-b753cb6d9d64', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:59:18', '2023-03-09 02:59:18', NULL),
('fd2f15c2-02bd-4387-b451-ed99d52580bc', 'JRM11', 'Jarum Microfine Ungu BD', 0, 'Kg', NULL, 'ce3d64a2-3897-482e-bb81-2a4e0e68176d', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:36:53', '2023-03-09 00:36:53', NULL),
('fdc1c0b0-e75e-478b-ab0a-a76a586ed81b', 'LIQ05', 'Asrhrol 70% 1L', 0, 'Kg', NULL, 'c234fc14-8617-4d1b-8c08-d96095d5a1a4', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 00:54:57', '2023-03-09 00:54:57', NULL),
('fe814ea6-47fe-44cd-8b12-692a7dc8d301', 'SLG16', 'NN', 0, 'Kg', NULL, '25409dc0-1051-4381-98aa-4ae5b7439735', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-09 02:43:40', '2023-03-09 02:43:40', NULL),
('fe8d91b9-5dd9-4525-9e9e-82578b8eb3dd', 'ALP29', 'Deker Lutut Agnesis M', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:19:01', '2023-03-08 07:19:01', NULL),
('ff079176-0b1f-4d29-9cf0-c9b3cfcbbc5b', 'ALP10', 'Arm Sling XL', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:15:11', '2023-03-08 07:15:11', NULL),
('ff0a0b30-b88b-457e-88ba-7c3342871524', 'ALP04', 'Tensocrepe 3\"', 0, 'Kg', NULL, 'ef51c47c-3b75-4433-a916-781d6f8b0d44', '83152d8c-86e7-481c-b4f3-4185f6770139', '2023-03-08 07:13:33', '2023-03-08 07:13:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `received_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `know` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('in','out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction_details`
--

CREATE TABLE `stock_transaction_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `ppn` int(11) DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('Owner','Manager','Admin','Gudang','Salesman') COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `role`, `branch_id`, `area_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('12d4350a-af62-44bb-9ed2-24dc5d7aa064', 'Jack S', 'jack@gmail.com', NULL, '$2y$10$DkOpdeiJDSj066Q4yd0XMe18rqjklIzVFZKpzHI1RvBLRd4nBFaQ2', '08123456789', 'Jl. Puri Anjasmoro Blok A No. --', 'Salesman', 2, 'b7e8a73c-2f36-47c9-8a87-901663aef6b7', NULL, '2023-03-08 05:03:57', '2023-03-08 05:03:57', NULL),
('3c7100ed-d6a5-4cf9-87f9-e50e5c8cd883', 'Brian', 'brian@gmail.com', '2023-03-08 05:02:22', '$2y$10$Uz4oXs3gjOEM6mw4SiVAeO9O86LOj/pUeNfcWHR4g7cUl0O2I9lAq', NULL, NULL, 'Gudang', 1, NULL, 'VqYLQAd1CY', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL),
('83152d8c-86e7-481c-b4f3-4185f6770139', 'Andhika', 'andhika@gmail.com', '2023-03-08 05:02:22', '$2y$10$hBXTOhe/4UaL0aJVxTnB3OdWw3sBB6i6MuJYZUhrmwzoK3ppuw4t.', NULL, NULL, 'Owner', 1, NULL, 'Gv2JhHyZ29', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL),
('a435fdcb-4673-4faf-8d6f-405c86bb134f', 'John G', 'john.g@gmail.com', NULL, '$2y$10$VD5O8/TAOxS4J2go42wgLeOlQOBXvDGUq90DYaMUkODVILkJG2OYK', '08132918321827', 'Jl. Beringin 3 No. 120', 'Salesman', 2, 'e7bd22a6-da4c-4978-ac81-b3025c0ec2c0', NULL, '2023-03-08 05:04:25', '2023-03-08 05:04:25', NULL),
('ad556b6a-3954-4d65-99b2-6abdf09918cc', 'Florence', 'florence@gmail.com', '2023-03-08 05:02:22', '$2y$10$vnk/Bez.ZWKPE6VnUSyxjOPLmiM5Oe89N7to/p/abTvEP7/Wj/BVG', NULL, NULL, 'Manager', 1, NULL, 'OGBjIt33G0', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL),
('c2ca38c2-e35a-4ec8-bc77-5c6b72b579c3', 'Puji', 'puji@gmail.com', '2023-03-08 05:02:22', '$2y$10$BgHwMhsgs/IurtozWQFLmO48E./l3dV0SzZv/r1tTNiJvapWiOGL2', NULL, NULL, 'Admin', 1, NULL, 'ZX1QSEdSfQ', '2023-03-08 05:02:22', '2023-03-08 05:02:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credits_order_id_foreign` (`order_id`);

--
-- Indexes for table `credit_details`
--
ALTER TABLE `credit_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_details_credit_id_foreign` (`credit_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operationals`
--
ALTER TABLE `operationals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operationals_user_id_foreign` (`user_id`),
  ADD KEY `operationals_operational_category_id_foreign` (`operational_category_id`);

--
-- Indexes for table `operational_categories`
--
ALTER TABLE `operational_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operational_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_branch_id_foreign` (`branch_id`),
  ADD KEY `stocks_user_id_foreign` (`user_id`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `stock_transaction_details`
--
ALTER TABLE `stock_transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transaction_details_stock_transaction_id_foreign` (`stock_transaction_id`),
  ADD KEY `stock_transaction_details_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`),
  ADD KEY `users_area_id_foreign` (`area_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `credits`
--
ALTER TABLE `credits`
  ADD CONSTRAINT `credits_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `credit_details`
--
ALTER TABLE `credit_details`
  ADD CONSTRAINT `credit_details_credit_id_foreign` FOREIGN KEY (`credit_id`) REFERENCES `credits` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `operationals`
--
ALTER TABLE `operationals`
  ADD CONSTRAINT `operationals_operational_category_id_foreign` FOREIGN KEY (`operational_category_id`) REFERENCES `operational_categories` (`id`),
  ADD CONSTRAINT `operationals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `operational_categories`
--
ALTER TABLE `operational_categories`
  ADD CONSTRAINT `operational_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `stocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_transaction_details`
--
ALTER TABLE `stock_transaction_details`
  ADD CONSTRAINT `stock_transaction_details_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`),
  ADD CONSTRAINT `stock_transaction_details_stock_transaction_id_foreign` FOREIGN KEY (`stock_transaction_id`) REFERENCES `stock_transactions` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
