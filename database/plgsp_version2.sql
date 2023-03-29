-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 11:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plgsp_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `feedback` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `form_detail_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `verified_by` int(10) UNSIGNED DEFAULT NULL,
  `audited_by` int(10) UNSIGNED DEFAULT NULL,
  `final_verified_by` int(10) UNSIGNED DEFAULT NULL,
  `verified_at` date DEFAULT NULL,
  `audited_at` date DEFAULT NULL,
  `final_verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `total_marks` decimal(8,2) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `is_audited` int(11) NOT NULL DEFAULT 0,
  `final_verified` int(11) NOT NULL DEFAULT 0,
  `total_marks_verifier` decimal(8,2) DEFAULT NULL,
  `total_marks_auditor` decimal(8,2) DEFAULT NULL,
  `total_marks_finalVerifier` decimal(8,2) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_subject_area`
--

CREATE TABLE `form_subject_area` (
  `id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_area_id` int(10) UNSIGNED DEFAULT NULL,
  `marks` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `marksByVerifier` decimal(8,2) DEFAULT NULL,
  `marksByAuditor` decimal(8,2) DEFAULT NULL,
  `marksByFinalVerifier` decimal(8,2) DEFAULT NULL,
  `status_verifier` int(11) NOT NULL DEFAULT 0,
  `status_auditor` int(11) NOT NULL DEFAULT 0,
  `status_final_verifier` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_subject_area_parameter`
--

CREATE TABLE `form_subject_area_parameter` (
  `id` int(10) UNSIGNED NOT NULL,
  `form_subject_area_id` int(10) UNSIGNED DEFAULT NULL,
  `parameter_id` int(10) UNSIGNED DEFAULT NULL,
  `marks` decimal(8,2) DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_id` int(10) UNSIGNED DEFAULT NULL,
  `marksByVerifier` decimal(8,2) DEFAULT NULL,
  `marksByAuditor` decimal(8,2) DEFAULT NULL,
  `marksByFinalVerifier` decimal(8,2) DEFAULT NULL,
  `is_applicable` tinyint(1) NOT NULL DEFAULT 0,
  `reassign` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Permission', '2022-04-21 04:56:01', '2022-04-21 04:56:01', NULL),
(2, 'Role', '2022-04-21 04:56:37', '2022-04-21 04:56:37', NULL),
(3, 'User', '2022-04-21 04:58:30', '2022-04-21 04:58:30', NULL),
(4, 'Group', '2022-04-21 04:58:58', '2022-04-21 04:58:58', NULL),
(5, 'Setting', '2022-04-21 04:59:25', '2022-04-21 04:59:25', NULL),
(6, 'Subject Area', '2022-04-21 05:00:15', '2022-04-21 05:00:15', NULL),
(7, 'Parameter', '2022-04-21 05:00:56', '2022-04-21 05:00:56', NULL),
(8, 'Province', '2022-04-21 05:01:43', '2022-04-21 05:01:43', NULL),
(9, 'Organization', '2022-04-21 05:02:27', '2022-04-21 05:02:27', NULL),
(10, 'Form', '2022-04-21 05:02:59', '2022-04-21 05:02:59', NULL),
(11, 'Product Category', '2022-04-21 05:04:07', '2022-04-21 05:04:07', NULL),
(12, 'Slider', '2022-04-21 05:04:43', '2022-04-21 05:04:43', NULL),
(13, 'Popup', '2022-04-21 05:05:07', '2022-04-21 05:05:07', NULL),
(14, 'Others', '2022-04-21 05:06:08', '2022-04-21 05:06:08', NULL),
(15, 'Document', '2022-04-21 05:12:00', '2022-04-21 05:12:00', NULL),
(16, 'Type', '2022-05-15 06:30:28', '2022-05-15 06:30:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `permission_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`group_id`, `permission_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(4, 61),
(4, 62),
(4, 63),
(4, 64),
(4, 65),
(5, 33),
(6, 36),
(6, 37),
(6, 38),
(6, 39),
(6, 40),
(7, 41),
(7, 42),
(7, 43),
(7, 44),
(7, 45),
(8, 46),
(8, 47),
(8, 48),
(8, 49),
(8, 50),
(9, 51),
(9, 52),
(9, 53),
(9, 54),
(9, 55),
(10, 66),
(10, 67),
(10, 68),
(10, 69),
(11, 18),
(11, 19),
(11, 20),
(11, 21),
(11, 22),
(12, 23),
(12, 24),
(12, 25),
(12, 26),
(12, 27),
(13, 28),
(13, 29),
(13, 30),
(13, 31),
(13, 32),
(14, 1),
(14, 17),
(14, 34),
(14, 35),
(15, 56),
(15, 57),
(15, 58),
(15, 59),
(15, 60),
(16, 70),
(16, 71),
(16, 72),
(16, 73),
(16, 74);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_id` int(10) UNSIGNED DEFAULT NULL
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
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2020_04_30_000001_create_media_table', 1),
(8, '2020_04_30_000002_create_permissions_table', 1),
(9, '2020_04_30_000003_create_roles_table', 1),
(10, '2020_04_30_000004_create_users_table', 1),
(11, '2020_04_30_000005_create_product_categories_table', 1),
(12, '2020_04_30_000008_create_permission_role_pivot_table', 1),
(13, '2020_04_30_000009_create_role_user_pivot_table', 1),
(14, '2020_04_30_000012_add_relationship_fields_to_product_categories_table', 1),
(15, '2021_05_19_052903_create_settings_table', 1),
(16, '2021_05_23_081950_create_user_other_info_table', 1),
(17, '2021_05_28_085032_add_sort_order_to_product_categories_table', 1),
(18, '2021_06_16_054546_create_sliders_table', 1),
(19, '2021_06_16_071701_create_popups_table', 1),
(20, '2021_07_13_073123_add_card_columns_to_userdetails_table', 1),
(21, '2022_01_12_153539_add_columns_to_settings_table', 1),
(22, '2022_02_13_075140_create_subject_areas_table', 1),
(23, '2022_02_13_105431_create_parameters_table', 1),
(24, '2022_02_13_110144_create_options_table', 1),
(25, '2022_02_14_094950_add_created_by_in_roles_table', 1),
(26, '2022_02_14_100013_add_created_by_in_users_table', 1),
(27, '2022_02_15_065604_create_organizations_table', 1),
(28, '2022_02_16_091705_add_shareable_colomn_to_roles_table', 1),
(29, '2022_02_17_060539_create_provinces_table', 1),
(30, '2022_02_17_060930_create_districts_table', 1),
(31, '2022_02_17_074533_add_province_id_to_organizations_table', 1),
(32, '2022_02_17_084858_create_documents_table', 1),
(33, '2022_02_18_071321_create_forms_table', 1),
(34, '2022_03_04_055846_create_form_subject_area_table', 1),
(35, '2022_03_08_091546_add_timestamps_to_form_subject_area_table', 1),
(36, '2022_03_11_073300_create_organization_user_table', 1),
(37, '2022_03_13_103211_create_form_subject_area_parameter_table', 1),
(38, '2022_03_13_160206_add_option_id_to_form_suject_area_parameter_table', 1),
(39, '2022_03_14_061506_create_feedbacks_table', 1),
(40, '2022_03_14_073516_add_status_to_forms_table', 1),
(41, '2022_03_20_072732_add_is_verified_to_forms_table', 1),
(42, '2022_03_22_060035_change_data_type_of_feedback_status', 1),
(43, '2022_03_23_072039_create_groups_table', 1),
(44, '2022_03_23_072402_create_group_permission_pivot_table', 1),
(45, '2022_03_29_091739_add_marks_by_verifier_to_form_subject_area_parameter_table', 1),
(46, '2022_03_29_101247_add_marks_by_verifier_to_form_subject_area_table', 1),
(47, '2022_03_29_101857_add_marks_by_verifier_to_forms_table', 1),
(48, '2022_03_29_114605_add_status_to_form_subject_area_parameter_table', 1),
(49, '2022_03_30_095916_add_status_to_subject_area_table', 1),
(50, '2022_03_30_103353_add_status_to_parameter_table', 1),
(51, '2022_03_30_111747_add_status_to_option_table', 1),
(52, '2022_03_30_111851_add_status_to_document_table', 1),
(53, '2022_03_31_055102_add_status_to_users_table', 1),
(54, '2022_04_12_134436_change_status_to_one_in_users_table', 1),
(55, '2022_04_19_081114_add_document_id_to_media_table', 1),
(56, '2022_04_19_115147_add_publish_to_forms_table', 1),
(57, '2022_03_28_103801_create_types_table', 2),
(58, '2022_04_27_115205_add_type_id_to_organizations_table', 2),
(59, '2022_04_27_133511_add_organization_id_to_organizations_table', 2),
(60, '2022_04_29_103228_add_status_to_form_subject_area_table', 2),
(61, '2022_05_09_153018_add_reassign_to_form_subject_area_parameter_table', 2),
(62, '2022_05_09_170514_change_data_type_of_status', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` decimal(3,2) DEFAULT NULL,
  `parameter_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `province_id` int(10) UNSIGNED DEFAULT NULL,
  `district_id` int(10) UNSIGNED DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `organization_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_user`
--

CREATE TABLE `organization_user` (
  `organization_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_area_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'cms_access', NULL, NULL, NULL),
(18, 'product_category_create', NULL, NULL, NULL),
(19, 'product_category_edit', NULL, NULL, NULL),
(20, 'product_category_show', NULL, NULL, NULL),
(21, 'product_category_delete', NULL, NULL, NULL),
(22, 'product_category_access', NULL, NULL, NULL),
(23, 'slider_access', NULL, NULL, NULL),
(24, 'slider_create', NULL, NULL, NULL),
(25, 'slider_edit', NULL, NULL, NULL),
(26, 'slider_show', NULL, NULL, NULL),
(27, 'slider_delete', NULL, NULL, NULL),
(28, 'popup_access', NULL, NULL, NULL),
(29, 'popup_create', NULL, NULL, NULL),
(30, 'popup_edit', NULL, NULL, NULL),
(31, 'popup_show', NULL, NULL, NULL),
(32, 'popup_delete', NULL, NULL, NULL),
(33, 'setting_create', NULL, NULL, NULL),
(34, 'product_management_access', NULL, NULL, NULL),
(35, 'profile_password_edit', NULL, NULL, NULL),
(36, 'subject_area_create', NULL, NULL, NULL),
(37, 'subject_area_edit', NULL, NULL, NULL),
(38, 'subject_area_show', NULL, NULL, NULL),
(39, 'subject_area_delete', NULL, NULL, NULL),
(40, 'subject_area_access', NULL, NULL, NULL),
(41, 'parameter_create', NULL, NULL, NULL),
(42, 'parameter_edit', NULL, NULL, NULL),
(43, 'parameter_show', NULL, NULL, NULL),
(44, 'parameter_delete', NULL, NULL, NULL),
(45, 'parameter_access', NULL, NULL, NULL),
(46, 'province_create', NULL, NULL, NULL),
(47, 'province_edit', NULL, NULL, NULL),
(48, 'province_show', NULL, NULL, NULL),
(49, 'province_delete', NULL, NULL, NULL),
(50, 'province_access', NULL, NULL, NULL),
(51, 'organization_create', NULL, NULL, NULL),
(52, 'organization_edit', NULL, NULL, NULL),
(53, 'organization_show', NULL, NULL, NULL),
(54, 'organization_delete', NULL, NULL, NULL),
(55, 'organization_access', NULL, NULL, NULL),
(56, 'document_create', NULL, NULL, NULL),
(57, 'document_edit', NULL, NULL, NULL),
(58, 'document_show', NULL, NULL, NULL),
(59, 'document_delete', NULL, NULL, NULL),
(60, 'document_access', NULL, NULL, NULL),
(61, 'group_create', NULL, NULL, NULL),
(62, 'group_edit', NULL, NULL, NULL),
(63, 'group_show', NULL, NULL, NULL),
(64, 'group_delete', NULL, NULL, NULL),
(65, 'group_access', NULL, NULL, NULL),
(66, 'form_create', NULL, NULL, NULL),
(67, 'form_edit', NULL, NULL, NULL),
(68, 'form_access', NULL, NULL, NULL),
(69, 'form_publish', NULL, NULL, NULL),
(70, 'type_create', '2022-05-15 06:28:15', '2022-05-15 06:28:15', NULL),
(71, 'type_edit', '2022-05-15 06:28:33', '2022-05-15 06:28:33', NULL),
(72, 'type_access', '2022-05-15 06:28:51', '2022-05-15 06:28:51', NULL),
(73, 'type_show', '2022-05-15 06:29:24', '2022-05-15 06:29:24', NULL),
(74, 'type_delete', '2022-05-15 06:29:43', '2022-05-15 06:29:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(2, 1),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 44),
(3, 45),
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52),
(3, 53),
(3, 54),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60),
(3, 61),
(3, 62),
(3, 63),
(3, 64),
(3, 65),
(3, 66),
(3, 67),
(3, 68),
(3, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(4, 67),
(4, 68),
(5, 66),
(5, 67),
(5, 68),
(6, 67),
(6, 68),
(6, 69);

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_shareable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `can_shareable`) VALUES
(1, 'IT Admin', NULL, '2022-05-15 06:31:27', NULL, '1', '1', NULL, 0),
(2, 'System Admin', NULL, '2022-05-15 06:31:46', NULL, '1', '1', NULL, 0),
(3, 'User', NULL, NULL, NULL, '1', NULL, NULL, 0),
(4, 'Auditor', '2022-05-15 06:39:15', '2022-05-15 06:39:15', NULL, '1', NULL, NULL, 0),
(5, 'Organization Admin', '2022-05-15 06:40:01', '2022-05-15 06:40:01', NULL, '1', NULL, NULL, 0),
(6, 'Final Verifier', '2022-05-15 06:40:35', '2022-05-15 06:40:35', NULL, '1', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `rightclick` tinyint(4) NOT NULL DEFAULT 0,
  `inspect` tinyint(4) NOT NULL DEFAULT 0,
  `wel_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w_email_enable` tinyint(4) DEFAULT NULL,
  `meta_data_desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_data_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_ana` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_login_enable` tinyint(4) DEFAULT NULL,
  `google_login_enable` tinyint(4) DEFAULT NULL,
  `gitlab_login_enable` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `favicon`, `copyright`, `footer_logo`, `created_at`, `updated_at`, `deleted_at`, `rightclick`, `inspect`, `wel_email`, `w_email_enable`, `meta_data_desc`, `meta_data_keyword`, `google_ana`, `fb_login_enable`, `google_login_enable`, `gitlab_login_enable`) VALUES
(1, 'Plgsp', 'logo.png', 'favicon.png', 'Copyright © 2022 Plgsp Pvt. Ltd.', 'logo.png', NULL, NULL, NULL, 0, 0, 'admin@admin.com', 1, NULL, NULL, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_areas`
--

CREATE TABLE `subject_areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `status`, `token`) VALUES
(1, 'IT Admin', 'itadmin@admin.com', '2022-04-21 10:11:46', '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe', NULL, NULL, NULL, NULL, '', NULL, NULL, 1, NULL),
(2, 'Admin', 'admin@admin.com', '2022-04-21 10:11:46', '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe', NULL, NULL, NULL, NULL, '', NULL, NULL, 1, NULL),
(3, 'User', 'user@user.com', '2022-04-21 10:11:46', '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe', NULL, NULL, NULL, NULL, '', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `can_read_book` int(11) NOT NULL DEFAULT 0,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muncipality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teaching_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_muncipality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_ward` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_street_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_principal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_province_id_foreign` (`province_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_parameter_id_foreign` (`parameter_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_user_id_foreign` (`user_id`),
  ADD KEY `feedbacks_form_detail_id_foreign` (`form_detail_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forms_organization_id_foreign` (`organization_id`),
  ADD KEY `forms_user_id_foreign` (`user_id`),
  ADD KEY `forms_updated_by_foreign` (`updated_by`),
  ADD KEY `forms_verified_by_foreign` (`verified_by`),
  ADD KEY `forms_audited_by_foreign` (`audited_by`),
  ADD KEY `forms_final_verified_by_foreign` (`final_verified_by`);

--
-- Indexes for table `form_subject_area`
--
ALTER TABLE `form_subject_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_subject_area_form_id_foreign` (`form_id`),
  ADD KEY `form_subject_area_subject_area_id_foreign` (`subject_area_id`);

--
-- Indexes for table `form_subject_area_parameter`
--
ALTER TABLE `form_subject_area_parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_subject_area_parameter_form_subject_area_id_foreign` (`form_subject_area_id`),
  ADD KEY `form_subject_area_parameter_parameter_id_foreign` (`parameter_id`),
  ADD KEY `form_subject_area_parameter_option_id_foreign` (`option_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD KEY `group_permission_group_id_foreign` (`group_id`),
  ADD KEY `group_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_document_id_foreign` (`document_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_parameter_id_foreign` (`parameter_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_slug_unique` (`slug`),
  ADD KEY `organizations_province_id_foreign` (`province_id`),
  ADD KEY `organizations_district_id_foreign` (`district_id`),
  ADD KEY `organizations_type_id_foreign` (`type_id`),
  ADD KEY `organizations_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `organization_user`
--
ALTER TABLE `organization_user`
  ADD KEY `organization_user_organization_id_foreign` (`organization_id`),
  ADD KEY `organization_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parameters_slug_unique` (`slug`),
  ADD KEY `parameters_subject_area_id_foreign` (`subject_area_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_1396911` (`role_id`),
  ADD KEY `permission_id_fk_1396911` (`permission_id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`),
  ADD KEY `category_fk_1396947` (`category_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_1396920` (`user_id`),
  ADD KEY `role_id_fk_1396920` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_areas`
--
ALTER TABLE `subject_areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_areas_slug_unique` (`slug`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_slug_unique` (`slug`),
  ADD KEY `types_type_id_foreign` (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_subject_area`
--
ALTER TABLE `form_subject_area`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_subject_area_parameter`
--
ALTER TABLE `form_subject_area_parameter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_areas`
--
ALTER TABLE `subject_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_form_detail_id_foreign` FOREIGN KEY (`form_detail_id`) REFERENCES `form_subject_area_parameter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_audited_by_foreign` FOREIGN KEY (`audited_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forms_final_verified_by_foreign` FOREIGN KEY (`final_verified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forms_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forms_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forms_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `form_subject_area`
--
ALTER TABLE `form_subject_area`
  ADD CONSTRAINT `form_subject_area_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_subject_area_subject_area_id_foreign` FOREIGN KEY (`subject_area_id`) REFERENCES `subject_areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `form_subject_area_parameter`
--
ALTER TABLE `form_subject_area_parameter`
  ADD CONSTRAINT `form_subject_area_parameter_form_subject_area_id_foreign` FOREIGN KEY (`form_subject_area_id`) REFERENCES `form_subject_area` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_subject_area_parameter_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_subject_area_parameter_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD CONSTRAINT `group_permission_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `organizations_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `organizations_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `organizations_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `organization_user`
--
ALTER TABLE `organization_user`
  ADD CONSTRAINT `organization_user_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `organization_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parameters`
--
ALTER TABLE `parameters`
  ADD CONSTRAINT `parameters_subject_area_id_foreign` FOREIGN KEY (`subject_area_id`) REFERENCES `subject_areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_1396911` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_1396911` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `category_fk_1396947` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_1396920` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_1396920` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
