-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 02:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipment_info` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `user_id`, `inventory_id`, `title`, `equipment_info`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'CHILLER', '{\"title\":\"CHILLER\",\"type\":\"CHILLER\",\"asset_#\":\"vfgdfg\",\"asset_tag\":\"hjghj\",\"site_(aaa)\":\"Air Side\",\"aaa_(maximo)_location\":\"jghjghj\",\"location\":\"U1-20\",\"assets_type\":\"FUTUR\",\"asset_description_(maximo)\":\"jghjghj\",\"asset_description\":\"hgjgh\",\"parent_of_assets_clarification\":\"hgjghj\",\"asset_class_(maximo)\":\"jhg\",\"vendor\\/supplier\":\"CHS\",\"manufacturer\":\"MULTI AQUA\",\"year_made\":\"2008\",\"model_#\":\"dfgf\",\"serial_#\":\"dfgdfgdfg\",\"cost_(afl.)\":\"1000\",\"installation_date\":\"06\\/27\\/2022\",\"expected_life_(years)\":\"6\",\"subcontracto\":\"CHS\",\"status\":\"Deactive\"}', 2, 1, NULL, '2022-06-28 02:13:03', '2022-06-28 02:13:03'),
(2, 1, 3, 'CEILING FAN', '{\"title\":\"CEILING FAN\",\"type\":\"CEILING FAN\",\"asset_#\":\"ffgdfg\",\"asset_tag\":\"fgdfg\",\"site_(aaa)\":\"Land Side\",\"aaa_(maximo)_location\":\"fdfdf\",\"location\":\"U1-07\",\"assets_type\":\"JK\",\"asset_description_(maximo)\":\"fgh\",\"asset_description\":\"iyuiyu\",\"parent_of_assets_clarification\":\"llkk\",\"asset_class_(maximo)\":\"hfgh\",\"vendor\\/supplier\":\"CHS\",\"manufacturer\":\"J&D\",\"year_made\":\"2009\",\"model_#\":\"gdg\",\"serial_#\":\"rtyyuyu\",\"cost_(afl.)\":\"2000\",\"installation_date\":\"06\\/28\\/2022\",\"expected_life_(years)\":\"9\",\"subcontracto\":\"CHS\",\"status\":\"Active\"}', 1, 1, NULL, '2022-06-28 02:13:03', '2022-06-28 02:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_logs`
--

CREATE TABLE `file_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_logs`
--

INSERT INTO `file_logs` (`id`, `filename`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'dmart_equipments_1656334693_892455852.csv', 2, 1, NULL, '2022-06-28 00:44:11', '2022-06-28 00:44:11'),
(2, 'dmart_equipments_1656398361_342389006.csv', 2, 1, NULL, '2022-06-28 01:09:35', '2022-06-28 01:09:35'),
(3, 'dmart_equipments_1656398361_342389006.csv', 1, 1, NULL, '2022-06-28 01:12:09', '2022-06-28 01:12:09'),
(4, 'dmart_equipments_1656398361_342389006.csv', 1, 1, NULL, '2022-06-28 02:13:03', '2022-06-28 02:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'BigBasketMart', 1, 1, 1, '2022-06-23 06:31:46', '2022-06-23 06:40:09'),
(3, 1, 'DMart', 1, 1, NULL, '2022-06-23 06:45:24', '2022-06-23 06:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_23_072953_create_permissions_table', 1),
(6, '2022_06_23_073001_create_roles_table', 1),
(7, '2022_06_23_073121_create_users_permissions_table', 1),
(8, '2022_06_23_073216_create_users_roles_table', 1),
(9, '2022_06_23_082042_create_permission_tables', 2),
(12, '2022_06_23_112901_create_inventories_table', 3),
(15, '2022_06_24_042203_create_taxonomies_table', 5),
(17, '2022_06_24_050617_create_taxonomy_data_table', 7),
(19, '2022_06_23_122047_create_equipment_table', 8),
(24, '2022_06_28_060653_create_file_logs_table', 10),
(25, '2022_06_29_070456_create_usersbkup_table', 11),
(30, '2022_06_27_064412_create_work_orders_table', 14),
(32, '2022_06_29_093143_create_work_order_images_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 8);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'login', 'web', '2022-06-23 04:06:30', '2022-06-23 04:18:25'),
(2, 'logout', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(3, 'register', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(4, 'password.request', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(5, 'password.email', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(6, 'password.reset', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(7, 'password.update', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(8, 'password.confirm', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(9, 'logout.perform', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(10, 'users', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(11, 'addUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(12, 'storeUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(13, 'editUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(14, 'updateUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(15, 'viewUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(16, 'deleteUser', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(17, 'roles.create', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(18, 'roles.store', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(19, 'roles.show', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(20, 'roles.edit', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(21, 'roles.update', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(22, 'roles.destroy', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(23, 'permissions.index', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(24, 'permissions.create', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(25, 'permissions.store', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(26, 'permissions.show', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(27, 'permissions.edit', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(28, 'permissions.update', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(29, 'permissions.destroy', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(30, 'dashboard', 'web', '2022-06-23 04:06:30', '2022-06-23 04:06:30'),
(32, 'roles.index', 'web', '2022-06-23 05:17:17', '2022-06-23 05:17:17'),
(33, 'inventory.index', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(34, 'inventory.create', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(35, 'inventory.store', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(36, 'inventory.show', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(37, 'inventory.edit', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(38, 'inventory.update', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(39, 'inventory.destroy', 'web', '2022-06-23 06:13:52', '2022-06-23 06:13:52'),
(47, 'equipment.index', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(48, 'equipment.create', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(49, 'equipment.store', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(50, 'equipment.show', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(51, 'equipment.edit', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(52, 'equipment.update', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(53, 'equipment.destroy', 'web', '2022-06-23 07:19:28', '2022-06-23 07:19:28'),
(54, 'taxonomy.index', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(55, 'taxonomy.create', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(56, 'taxonomy.store', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(57, 'taxonomy.show', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(58, 'taxonomy.edit', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(59, 'taxonomy.update', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(60, 'taxonomy.destroy', 'web', '2022-06-23 23:09:17', '2022-06-23 23:09:17'),
(61, 'taxonomyData.index', 'web', '2022-06-23 23:39:46', '2022-06-23 23:39:46'),
(62, 'taxonomyData.create', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(63, 'taxonomyData.store', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(64, 'taxonomyData.show', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(65, 'taxonomyData.edit', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(66, 'taxonomyData.update', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(67, 'taxonomyData.destroy', 'web', '2022-06-23 23:39:47', '2022-06-23 23:39:47'),
(68, 'equipment.downloadPDF', 'web', '2022-06-24 06:27:19', '2022-06-24 06:27:19'),
(69, 'equipment.getQRCode', 'web', '2022-06-26 23:51:01', '2022-06-26 23:51:01'),
(70, 'work_order.index', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(71, 'work_order.create', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(72, 'work_order.store', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(73, 'work_order.show', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(74, 'work_order.edit', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(75, 'work_order.update', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(76, 'work_order.destroy', 'web', '2022-06-27 01:15:58', '2022-06-27 01:15:58'),
(77, 'equipment.export', 'web', '2022-06-27 04:15:54', '2022-06-27 04:15:54'),
(78, 'equipment.import', 'web', '2022-06-27 04:15:54', '2022-06-27 04:15:54'),
(79, 'work_order.report', 'web', '2022-06-28 04:05:50', '2022-06-28 04:05:50'),
(80, 'dashboard.clientStaff', 'web', '2022-06-28 06:07:06', '2022-06-28 06:07:06'),
(81, 'clientUser', 'web', '2022-06-28 06:08:21', '2022-06-28 06:08:21'),
(82, 'staffsUser', 'web', '2022-06-28 06:08:21', '2022-06-28 06:08:21'),
(83, 'user.profile', 'web', '2022-06-29 00:52:21', '2022-06-29 00:52:21'),
(84, 'authRemove', 'web', '2022-06-29 01:30:10', '2022-06-29 01:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-06-23 04:09:09', '2022-06-23 04:09:09'),
(2, 'Super-Admin', 'web', '2022-06-23 04:43:17', '2022-06-23 04:43:17'),
(3, 'Client', 'web', '2022-06-23 04:44:05', '2022-06-23 04:44:05'),
(4, 'Staff', 'web', '2022-06-27 01:50:29', '2022-06-27 01:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 1),
(30, 2),
(30, 3),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(70, 4),
(71, 2),
(72, 2),
(73, 2),
(73, 4),
(74, 2),
(74, 4),
(75, 2),
(75, 4),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 1),
(83, 2),
(83, 3),
(83, 4),
(84, 1),
(84, 2),
(84, 3),
(84, 4);

-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

CREATE TABLE `taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_field_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_required` tinyint(4) DEFAULT NULL,
  `order_no` bigint(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomies`
--

INSERT INTO `taxonomies` (`id`, `name`, `input_field_type`, `input_required`, `order_no`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Type', 'Select', 1, 1, 1, 1, 1, '2022-06-23 23:20:42', '2022-06-24 04:34:17'),
(2, 'Site (AAA)', 'Select', 1, 4, 1, 1, 1, '2022-06-23 23:22:47', '2022-06-24 04:35:48'),
(3, 'Location', 'Select', 1, 6, 1, 1, 1, '2022-06-23 23:23:02', '2022-06-24 04:36:50'),
(4, 'Assets Type', 'Select', 0, 7, 1, 1, 1, '2022-06-23 23:23:16', '2022-06-24 04:37:03'),
(5, 'Vendor/Supplier', 'Select', 1, 12, 1, 1, 1, '2022-06-23 23:23:31', '2022-06-24 04:38:17'),
(6, 'Manufacturer', 'Select', 1, 13, 1, 1, 1, '2022-06-23 23:23:44', '2022-06-24 04:38:27'),
(7, 'Subcontracto', 'Select', 1, 20, 1, 1, 1, '2022-06-23 23:24:01', '2022-06-24 04:40:17'),
(9, 'AAA (MAXIMO) LOCATION', 'Text', 0, 5, 1, 1, 1, '2022-06-24 01:28:34', '2022-06-24 04:36:06'),
(10, 'Asset #', 'Text', 0, 2, 1, 1, 1, '2022-06-24 01:42:55', '2022-06-24 04:34:45'),
(11, 'Asset Tag', 'Text', 0, 3, 1, 1, 1, '2022-06-24 02:15:04', '2022-06-24 04:35:20'),
(12, 'Asset description (MAXIMO)', 'Textarea', 0, 8, 1, 1, 1, '2022-06-24 02:16:06', '2022-06-24 04:37:15'),
(13, 'Asset description', 'Text', 0, 9, 1, 1, 1, '2022-06-24 02:17:17', '2022-06-24 04:37:31'),
(14, 'Parent of Assets Clarification', 'Text', 0, 10, 1, 1, 1, '2022-06-24 02:17:36', '2022-06-24 04:37:43'),
(15, 'ASSET CLASS (MAXIMO)', 'Text', 0, 11, 1, 1, 1, '2022-06-24 02:18:18', '2022-06-24 04:37:52'),
(16, 'Year Made', 'Text', 0, 14, 1, 1, 1, '2022-06-24 02:18:53', '2022-06-24 04:38:35'),
(17, 'Model #', 'Text', 0, 15, 1, 1, 1, '2022-06-24 02:19:08', '2022-06-24 04:38:46'),
(18, 'Serial #', 'Text', 1, 16, 1, 1, 1, '2022-06-24 02:19:36', '2022-06-24 04:38:56'),
(19, 'Cost (Afl.)', 'Number', 0, 17, 1, 1, 1, '2022-06-24 02:19:47', '2022-06-27 07:11:26'),
(20, 'Installation Date', 'Date', 0, 18, 1, 1, 1, '2022-06-24 02:20:43', '2022-06-24 04:39:31'),
(21, 'Expected Life (Years)', 'Text', 0, 19, 1, 1, 1, '2022-06-24 02:21:01', '2022-06-24 04:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy_data`
--

CREATE TABLE `taxonomy_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomy_data`
--

INSERT INTO `taxonomy_data` (`id`, `taxonomy_id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 7, 'CHS', 1, 1, NULL, '2022-06-23 23:54:50', '2022-06-23 23:54:50'),
(2, 6, 'J&D', 1, 1, NULL, '2022-06-23 23:58:03', '2022-06-23 23:58:03'),
(3, 6, 'GRUNDFOS', 1, 1, NULL, '2022-06-24 00:00:11', '2022-06-24 00:00:11'),
(4, 6, 'CARRIER', 1, 1, NULL, '2022-06-24 00:02:14', '2022-06-24 00:02:14'),
(5, 6, 'FUTURE', 1, 1, NULL, '2022-06-24 00:04:00', '2022-06-24 00:04:00'),
(6, 6, 'SES', 1, 1, NULL, '2022-06-24 00:04:55', '2022-06-24 00:04:55'),
(7, 6, 'PROTEC', 1, 1, NULL, '2022-06-24 00:06:24', '2022-06-24 00:06:24'),
(8, 6, 'ELKAY', 1, 1, NULL, '2022-06-24 00:07:46', '2022-06-24 00:07:46'),
(9, 6, 'MULTI AQUA', 1, 1, NULL, '2022-06-24 00:08:02', '2022-06-24 00:08:02'),
(10, 6, 'LIEBERT', 1, 1, NULL, '2022-06-24 00:08:12', '2022-06-24 00:08:12'),
(11, 6, 'REFLEX', 1, 1, NULL, '2022-06-24 00:08:24', '2022-06-24 00:08:24'),
(12, 6, 'DAALDEROP', 1, 1, NULL, '2022-06-24 00:08:33', '2022-06-24 00:08:33'),
(13, 6, 'BERSON', 1, 1, NULL, '2022-06-24 00:08:43', '2022-06-24 00:08:43'),
(14, 6, 'ABB', 1, 1, NULL, '2022-06-24 00:08:52', '2022-06-24 00:08:52'),
(15, 5, 'CHS', 1, 1, NULL, '2022-06-24 00:49:16', '2022-06-24 00:49:16'),
(16, 4, 'FUTUR', 1, 1, NULL, '2022-06-24 00:51:13', '2022-06-24 00:51:13'),
(18, 3, 'U1-01', 1, 1, NULL, '2022-06-24 00:53:44', '2022-06-24 00:53:44'),
(19, 3, 'U1-11', 1, 1, NULL, '2022-06-24 00:53:56', '2022-06-24 00:53:56'),
(20, 3, 'U1-24', 1, 1, NULL, '2022-06-24 00:54:14', '2022-06-24 00:54:14'),
(21, 3, 'GH-02', 1, 1, NULL, '2022-06-24 00:54:23', '2022-06-24 00:54:23'),
(22, 3, 'D1-07', 1, 1, NULL, '2022-06-24 00:54:33', '2022-06-24 00:54:33'),
(23, 3, 'G.House', 1, 1, NULL, '2022-06-24 00:54:42', '2022-06-24 00:54:42'),
(24, 3, 'U1-07', 1, 1, NULL, '2022-06-24 00:54:55', '2022-06-24 00:54:55'),
(25, 3, 'U1-08', 1, 1, NULL, '2022-06-24 00:55:04', '2022-06-24 00:55:04'),
(26, 3, 'U1-12', 1, 1, NULL, '2022-06-24 00:55:27', '2022-06-24 00:55:27'),
(27, 3, 'U1-19', 1, 1, NULL, '2022-06-24 00:55:37', '2022-06-24 00:55:37'),
(28, 3, 'U1-20', 1, 1, NULL, '2022-06-24 00:55:46', '2022-06-24 00:55:46'),
(29, 3, 'U1-21', 1, 1, NULL, '2022-06-24 00:55:55', '2022-06-24 00:55:55'),
(30, 3, 'U1-23', 1, 1, NULL, '2022-06-24 00:56:07', '2022-06-24 00:56:07'),
(31, 3, 'U1-18', 1, 1, NULL, '2022-06-24 00:59:03', '2022-06-24 00:59:03'),
(32, 2, 'Land', 1, 1, NULL, '2022-06-24 01:00:47', '2022-06-24 01:00:47'),
(33, 2, 'Air Side', 1, 1, NULL, '2022-06-24 01:00:56', '2022-06-24 01:00:56'),
(34, 2, 'Land Side', 1, 1, NULL, '2022-06-24 01:01:07', '2022-06-24 01:01:07'),
(35, 2, 'G1-01', 1, 1, NULL, '2022-06-24 01:01:19', '2022-06-24 01:01:19'),
(36, 1, 'CEILING FAN', 1, 1, NULL, '2022-06-24 01:02:00', '2022-06-24 01:02:00'),
(37, 1, 'CHILLED WATER PUMP', 1, 1, NULL, '2022-06-24 01:02:10', '2022-06-24 01:02:10'),
(38, 1, 'CHILLER', 1, 1, NULL, '2022-06-24 01:02:21', '2022-06-24 01:02:21'),
(39, 1, 'CHILLER CONTROL PANEL', 1, 1, NULL, '2022-06-24 01:02:32', '2022-06-24 01:02:32'),
(40, 1, 'CONDENSER WATER', 1, 1, NULL, '2022-06-24 01:02:42', '2022-06-24 01:02:42'),
(41, 1, 'COOLING TOWER', 1, 1, NULL, '2022-06-24 01:02:53', '2022-06-24 01:02:53'),
(42, 1, 'DOMESTIC WATER PUMP', 1, 1, NULL, '2022-06-24 01:03:05', '2022-06-24 01:03:05'),
(43, 1, 'DOMESTIC WATER PUMP CONTROLLER', 1, 1, NULL, '2022-06-24 01:03:20', '2022-06-24 01:03:20'),
(44, 1, 'DRINKING FOUNTAIN', 1, 1, NULL, '2022-06-24 01:03:32', '2022-06-24 01:03:32'),
(45, 1, 'EXHAUST FAN', 1, 1, NULL, '2022-06-24 01:03:45', '2022-06-24 01:03:45'),
(46, 1, 'AIR HANDLER UNIT', 1, 1, NULL, '2022-06-24 01:03:54', '2022-06-24 01:03:54'),
(47, 1, 'AIR HANDLER UNIT (outdoor)', 1, 1, NULL, '2022-06-24 01:04:05', '2022-06-24 01:04:05'),
(48, 1, 'FAN COIL UNIT', 1, 1, NULL, '2022-06-24 01:04:23', '2022-06-24 01:04:23'),
(49, 1, 'NOT AN ASSET IN MAXIMO', 1, 1, NULL, '2022-06-24 01:04:34', '2022-06-24 01:04:34'),
(50, 1, 'UV-FILTER - EXSITING', 1, 1, NULL, '2022-06-24 01:04:45', '2022-06-24 01:04:45'),
(51, 1, 'UV-FILTER - NEW', 1, 1, NULL, '2022-06-24 01:04:54', '2022-06-24 01:04:54'),
(52, 1, 'VAR. FREQ. DRIVE', 1, 1, 1, '2022-06-24 01:05:09', '2022-06-24 01:16:50'),
(53, 4, 'JK', 1, 1, NULL, '2022-06-28 02:13:03', '2022-06-28 02:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissionid` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `permissionid`, `status`, `deleted_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'jyoti.610weblab@gmail.com', NULL, '$2y$10$mjuoGReNxtHNgDsgaoW8zuMK9LbjEQesmcCos45aGn/A6bwfwN5eW', 'avatar2.png_1656483160.png', NULL, 1, 1, NULL, NULL, 1, '2022-06-23 02:37:41', '2022-06-29 00:42:40'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$py6DGlIAEuY1K0RLhaU.k.Fpn9mXWhpkqcs7gCFdwib5CkiojJYvO', 'avatar.png_1656483140.png', NULL, 1, 1, NULL, NULL, 1, '2022-06-23 04:09:09', '2022-06-29 00:42:20'),
(3, 'Nick', 'nick@gmail.com', NULL, '$2y$10$hTb1GpysrTERzj/0lWX9DOALgdQfNfKXzURNxZT7kRLaImhSZXd8S', 'avatar4.png_1656483131.png', NULL, NULL, 1, '2022-06-29 02:34:55', NULL, 1, '2022-06-27 01:49:58', '2022-06-29 02:34:55'),
(4, 'Ele', 'ele@gmail.com', NULL, '$2y$10$XRC/kX51O5qCDOuDqKLo/eEDwPSrx4zm5SJupvPx/r0JghVbdfBbS', 'avatar3.png_1656483113.png', NULL, NULL, 1, '2022-06-29 01:41:59', NULL, 1, '2022-06-27 01:53:37', '2022-06-29 01:41:59'),
(5, 'Mick', 'mick@gmail.com', NULL, '$2y$10$OMVPW2oFq5h3zCRpNlZB2uqpb5iaSLQLPD4BZINDJM9Y00EhwmQme', 'avatar5.png_1656486781.png', NULL, NULL, 1, '2022-06-29 01:43:29', NULL, 1, '2022-06-29 01:43:01', '2022-06-29 01:43:29'),
(6, 'Rahul', 'rahul@gmail.com', NULL, '$2y$10$Rs56cvXtL7tE4jMTdnIC7OOpfnN98C/qjhHNi395j9wphRmqW39bO', 'avatar5.png_1656489475.png', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 02:27:55', '2022-06-29 02:27:55'),
(7, 'Yogesh', 'yogesh@gmail.com', NULL, '$2y$10$DLglPsQXdKjSYozgrZ.Pq.xojOxU4OwBzQfuLDWf40YumJmc3LfHW', 'avatar.png_1656489854.png', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 02:34:14', '2022-06-29 02:34:14'),
(8, 'Sachin', 'sachin@gmail.com', NULL, '$2y$10$WMGKCrAgHJ55ZohaMjU.1.moCbvamabX/GJZyxhC3DX4DodCmwzMK', 'avatar4.png_1656489882.png', NULL, NULL, 1, NULL, NULL, 1, '2022-06-29 02:34:42', '2022-06-29 02:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `usersbkup`
--

CREATE TABLE `usersbkup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `permissionid` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `user_id`, `title`, `description`, `staff_id`, `client_id`, `orderdate`, `start_date`, `end_date`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test Order', 'Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.', 8, 7, '2022-06-29 10:13:56', '1970-01-01 06:30:00', '1970-01-01 06:30:00', 3, 1, 1, NULL, '2022-06-29 04:40:37', '2022-06-29 04:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_images`
--

CREATE TABLE `work_order_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workorder_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_order_images`
--

INSERT INTO `work_order_images` (`id`, `workorder_id`, `user_id`, `title`, `image`, `type`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Before start work', 'images/work_order/2022/06/29/photo1_62bc349131a1c.png', 0, 1, NULL, NULL, '2022-06-29 05:46:33', '2022-06-29 05:46:33'),
(2, 1, 1, 'Before start work', 'images/work_order/2022/06/29/photo2_62bc34913254f.png', 0, 1, NULL, NULL, '2022-06-29 05:46:33', '2022-06-29 05:46:33'),
(3, 1, 1, 'Before start work', 'images/work_order/2022/06/29/photo3_62bc349132d77.jpg', 0, 1, NULL, NULL, '2022-06-29 05:46:33', '2022-06-29 05:46:33'),
(4, 1, 1, 'Before start work', 'images/work_order/2022/06/29/photo4_62bc3491336a4.jpg', 0, 1, NULL, NULL, '2022-06-29 05:46:33', '2022-06-29 05:46:33'),
(5, 1, 1, 'End work', 'images/work_order/2022/06/29/ggdf_62bc37844ba78.jpg', 1, 1, NULL, NULL, '2022-06-29 05:59:08', '2022-06-29 05:59:08'),
(6, 1, 1, 'End work', 'images/work_order/2022/06/29/gdfg_62bc37844c99f.jpg', 1, 1, NULL, NULL, '2022-06-29 05:59:08', '2022-06-29 05:59:08'),
(7, 1, 1, 'End work', 'images/work_order/2022/06/29/ddsds_62bc37844d24c.jpg', 1, 1, NULL, NULL, '2022-06-29 05:59:08', '2022-06-29 05:59:08'),
(8, 1, 1, 'End work', 'images/work_order/2022/06/29/photo-1579353977828-2a4eab540b9a_62bc378451d04.jpg', 1, 1, NULL, NULL, '2022-06-29 05:59:08', '2022-06-29 05:59:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_user_id_foreign` (`user_id`),
  ADD KEY `equipment_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_logs`
--
ALTER TABLE `file_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `taxonomies`
--
ALTER TABLE `taxonomies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomy_data`
--
ALTER TABLE `taxonomy_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy_data_taxonomy_id_foreign` (`taxonomy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usersbkup`
--
ALTER TABLE `usersbkup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usersbkup_email_unique` (`email`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_orders_user_id_foreign` (`user_id`),
  ADD KEY `work_orders_staff_id_foreign` (`staff_id`),
  ADD KEY `work_orders_client_id_foreign` (`client_id`);

--
-- Indexes for table `work_order_images`
--
ALTER TABLE `work_order_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_order_images_workorder_id_foreign` (`workorder_id`),
  ADD KEY `work_order_images_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_logs`
--
ALTER TABLE `file_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxonomies`
--
ALTER TABLE `taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `taxonomy_data`
--
ALTER TABLE `taxonomy_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usersbkup`
--
ALTER TABLE `usersbkup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_order_images`
--
ALTER TABLE `work_order_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taxonomy_data`
--
ALTER TABLE `taxonomy_data`
  ADD CONSTRAINT `taxonomy_data_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD CONSTRAINT `work_orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_orders_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_order_images`
--
ALTER TABLE `work_order_images`
  ADD CONSTRAINT `work_order_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_order_images_workorder_id_foreign` FOREIGN KEY (`workorder_id`) REFERENCES `work_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
