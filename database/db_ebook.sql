-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2021 at 01:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Product', 201, 'photo', '60a0ec2c3c532_5fe5b2360d20a_logo head', '60a0ec2c3c532_5fe5b2360d20a_logo-head.png', 'image/png', 'public', 108781, '[]', '{\"generated_conversions\":{\"thumb\":true}}', '[]', 1, '2021-05-16 04:11:08', '2021-05-16 04:11:20'),
(2, 'App\\Product', 202, 'photo', '60a1511e9f0f4_logo head', '60a1511e9f0f4_logo-head.png', 'image/png', 'public', 108781, '[]', '{\"generated_conversions\":{\"thumb\":true}}', '[]', 2, '2021-05-16 11:21:40', '2021-05-16 11:21:43'),
(3, 'App\\Product', 206, 'photo', '60a2468c9a79d_Mobile-Icon-Isometric', '60a2468c9a79d_Mobile-Icon-Isometric.png', 'image/png', 'public', 314178, '[]', '{\"generated_conversions\":{\"thumb\":true}}', '[]', 3, '2021-05-17 04:48:52', '2021-05-17 04:49:05'),
(4, 'App\\Product', 207, 'photo', '60a2473304553_Mobile-Icon-Isometric', '60a2473304553_Mobile-Icon-Isometric.png', 'image/png', 'public', 314178, '[]', '{\"generated_conversions\":{\"thumb\":true}}', '[]', 4, '2021-05-17 04:51:37', '2021-05-17 04:51:39');

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
(12, '2020_04_30_000006_create_product_tags_table', 1),
(13, '2020_04_30_000007_create_products_table', 1),
(14, '2020_04_30_000008_create_permission_role_pivot_table', 1),
(15, '2020_04_30_000009_create_role_user_pivot_table', 1),
(16, '2020_04_30_000010_create_product_product_category_pivot_table', 1),
(17, '2020_04_30_000011_create_product_product_tag_pivot_table', 1),
(18, '2020_04_30_000012_add_relationship_fields_to_product_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(17, 'product_management_access', NULL, NULL, NULL),
(18, 'product_category_create', NULL, NULL, NULL),
(19, 'product_category_edit', NULL, NULL, NULL),
(20, 'product_category_show', NULL, NULL, NULL),
(21, 'product_category_delete', NULL, NULL, NULL),
(22, 'product_category_access', NULL, NULL, NULL),
(23, 'product_tag_create', NULL, NULL, NULL),
(24, 'product_tag_edit', NULL, NULL, NULL),
(25, 'product_tag_show', NULL, NULL, NULL),
(26, 'product_tag_delete', NULL, NULL, NULL),
(27, 'product_tag_access', NULL, NULL, NULL),
(28, 'product_create', NULL, NULL, NULL),
(29, 'product_edit', NULL, NULL, NULL),
(30, 'product_show', NULL, NULL, NULL),
(31, 'product_delete', NULL, NULL, NULL),
(32, 'product_access', NULL, NULL, NULL),
(33, 'profile_password_edit', NULL, NULL, NULL);

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
(2, 33);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Itaque unde totam.', 'Veniam cumque consequatur ducimus iste delectus totam possimus cupiditate. Voluptatem dolores rem doloribus sed maxime quaerat. Qui suscipit cum nulla eum nobis illum.', '17.68', 'itaque-unde-totam', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(2, 'Dignissimos veritatis voluptatem.', 'Expedita quia rerum molestias qui quis minus est. Eum veritatis quae perferendis voluptatibus explicabo rerum quidem. Temporibus architecto amet voluptatem dolorum eligendi dolorem aut. Et est et voluptatem.', '2.18', 'dignissimos-veritatis-voluptatem', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(3, 'Aut autem aliquid et.', 'Iure quisquam iste sit ut nesciunt distinctio minus aut. Nisi quis sunt quos facilis. Qui fugiat vero ut. Aspernatur molestias dolorem eius.', '25.73', 'aut-autem-aliquid-et', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(4, 'Eos assumenda in.', 'Fugiat sit tempora quasi laboriosam. Non repellendus est cupiditate animi omnis. Itaque atque magni aut provident ut.', '1.65', 'eos-assumenda-in', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(5, 'Modi doloremque animi a accusamus.', 'Tempora qui hic sint ab porro. Hic nesciunt dignissimos a repudiandae dolor. Odio autem quos ut et.', '11.04', 'modi-doloremque-animi-a-accusamus', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(6, 'Repudiandae qui voluptatem quo nihil.', 'Nulla laudantium dolor porro molestiae et amet ducimus. Debitis qui dolorum esse eligendi. Sequi dolorum dignissimos eum.', '47.56', 'repudiandae-qui-voluptatem-quo-nihil', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(7, 'Est consequatur ipsa debitis.', 'Quia aperiam omnis non ut harum cupiditate eum. Quisquam non dignissimos illum labore exercitationem. Dolorem laboriosam ut harum dicta. Provident labore inventore debitis in voluptatem alias.', '34.81', 'est-consequatur-ipsa-debitis', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(8, 'Ut qui quia aspernatur.', 'Veniam aut molestiae mollitia. Quam libero aut est. Nam molestiae eos soluta numquam.', '31.54', 'ut-qui-quia-aspernatur', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(9, 'Consequatur officia.', 'Ut sint sint suscipit inventore dicta mollitia. Et aperiam molestiae neque ea alias qui veritatis. Quaerat labore incidunt maiores voluptates. Sed sint molestiae et iure ducimus. Modi reprehenderit voluptas aut maiores doloremque soluta pariatur.', '45.15', 'consequatur-officia', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(10, 'Vero incidunt.', 'Blanditiis aperiam impedit doloribus officia. Sunt sit natus dolor esse numquam ipsa. Magni et porro molestiae aperiam sunt voluptas.', '11.99', 'vero-incidunt', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(11, 'Libero eos sunt enim.', 'Quaerat fugit quisquam quam consequatur. Distinctio beatae facilis deserunt commodi repudiandae et architecto.', '23.61', 'libero-eos-sunt-enim', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(12, 'Eius dolor perspiciatis sint.', 'Enim ullam tempora voluptatibus voluptates et hic temporibus. Expedita sit dolorem blanditiis est. Corporis molestiae voluptatum itaque sit ad quia tempore.', '32.87', 'eius-dolor-perspiciatis-sint', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(13, 'Magnam illum maiores natus.', 'Vel aut atque expedita consequuntur fugiat. Maxime cumque soluta voluptatem dolorem quo fugiat. Omnis et autem qui similique exercitationem ipsa sunt.', '1.07', 'magnam-illum-maiores-natus', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(14, 'Voluptatem aut officia quod tempora.', 'Rerum omnis vel ipsum in doloremque enim repellendus eos. Omnis consectetur autem delectus pariatur ut qui rerum. In iure perferendis itaque. Quas officiis repellat sed aperiam et ea quia recusandae. Sint dolorum rerum fuga inventore et impedit.', '10.83', 'voluptatem-aut-officia-quod-tempora', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(15, 'Ut eius iste iusto.', 'Dolorem libero qui qui non. Laborum dicta ex quia itaque quae sit. Nam sapiente qui consequatur quas.', '16.42', 'ut-eius-iste-iusto', '2021-05-12 10:15:43', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(16, 'Repellat cum labore.', 'Totam quibusdam magnam commodi perspiciatis eaque. Soluta voluptatem quos molestiae esse ab ducimus. Omnis aspernatur suscipit dolor suscipit maxime voluptatem ex. Eius ab doloremque omnis qui ipsa quasi.', '17.21', 'repellat-cum-labore', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(17, 'Facilis et dolorem illo.', 'Distinctio rerum animi vitae earum consequatur unde. Ea labore laborum veniam. Porro rerum quos qui quaerat et. Dolorem nisi aperiam est nisi iure. Quia veniam libero temporibus dignissimos est sunt dolorem.', '22.96', 'facilis-et-dolorem-illo', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(18, 'Distinctio aliquam impedit.', 'Quibusdam aliquam consequuntur et. Est quibusdam sint neque sunt et. Quos autem dolorum et adipisci. Impedit voluptatem doloribus sed.', '8.14', 'distinctio-aliquam-impedit', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(19, 'Nostrum voluptatem provident.', 'Est vero et quae tempora. Ex et fugit asperiores dolorum in voluptas. Fugit id suscipit est sed et amet.', '19.08', 'nostrum-voluptatem-provident', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(20, 'Hic voluptatum nihil repudiandae.', 'Et repudiandae ut sunt ad. Tempore sunt recusandae recusandae magnam et et illum. Iste molestias ipsam illum culpa est et. Velit adipisci assumenda aut nemo.', '35.89', 'hic-voluptatum-nihil-repudiandae', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(21, 'Nostrum odio aperiam itaque.', 'Distinctio rem aperiam sunt dicta. Tempore sapiente at voluptatem aut porro a vitae. Voluptate officia iure amet.', '2.20', 'nostrum-odio-aperiam-itaque', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(22, 'Odio in assumenda occaecati consequatur.', 'Et dolor ullam tempora id sit sunt aut. Doloribus esse aperiam illo quia. Ab eligendi maiores expedita repellat et rerum.', '31.52', 'odio-in-assumenda-occaecati-consequatur', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(23, 'Eum fugit molestiae assumenda.', 'Laboriosam et facere provident odit. Veniam amet saepe aliquid ad atque ipsum. Hic dolore consequatur soluta ratione corporis pariatur.', '41.50', 'eum-fugit-molestiae-assumenda', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(24, 'Vero voluptatem excepturi.', 'Tempora quae nostrum rerum ut quae. Dolorem illo pariatur expedita sint corrupti hic aut.', '11.91', 'vero-voluptatem-excepturi', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(25, 'Expedita aut.', 'Praesentium possimus dolorem qui nam quidem in quia. Consequatur minus qui reprehenderit officia reiciendis ab. Eius omnis molestiae corrupti animi ut. Cum dolor vel modi.', '27.04', 'expedita-aut', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(26, 'Earum sed consequatur explicabo doloribus.', 'Est qui ipsam voluptatum non praesentium harum ut. Dolores iste vero vitae non sit enim. Recusandae facilis velit et quo molestias assumenda.', '46.41', 'earum-sed-consequatur-explicabo-doloribus', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(27, 'Soluta qui quo voluptas.', 'Aut incidunt cupiditate non rerum unde quia eos assumenda. Quibusdam aliquid soluta explicabo. Qui in est autem.', '43.19', 'soluta-qui-quo-voluptas', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(28, 'Porro velit provident deserunt.', 'Debitis sed ea natus sed sunt non accusamus. Deserunt earum esse incidunt suscipit ut iste sint. Atque dolor dolorum ab.', '17.68', 'porro-velit-provident-deserunt', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(29, 'Consequatur fugiat.', 'Dignissimos vel saepe fuga debitis est quo architecto. Natus qui quo temporibus perspiciatis numquam exercitationem exercitationem. Quam cumque rerum sit voluptate nihil dignissimos quasi. Optio nesciunt consequatur dolores aspernatur.', '7.95', 'consequatur-fugiat', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(30, 'Quis exercitationem dicta laboriosam.', 'Quia nesciunt explicabo sit deleniti. Magni ut vel tenetur eaque. Fuga et est aut voluptates rerum. Beatae voluptatum eum natus.', '48.94', 'quis-exercitationem-dicta-laboriosam', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(31, 'Cumque similique eum.', 'Reiciendis quia sapiente reiciendis et repellendus vitae velit. Nisi excepturi et doloribus sequi. Quaerat atque repudiandae non facere dolorem. Aperiam et nesciunt reprehenderit exercitationem.', '2.72', 'cumque-similique-eum', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(32, 'Voluptates nihil rem.', 'Est odio et rem. Labore sit enim fuga et et minus. Non aut autem commodi architecto in vero culpa. Sunt iure consequatur similique fuga non eius. Officiis autem voluptate ut minus eligendi eveniet laudantium.', '47.87', 'voluptates-nihil-rem', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(33, 'Quis sint.', 'Magnam nam quidem laudantium. Voluptatem minus occaecati qui inventore natus. Sint minus inventore et aut nostrum ut laboriosam. Ducimus maiores cumque asperiores et quasi aperiam veniam.', '7.27', 'quis-sint', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(34, 'Maiores voluptatem ad assumenda.', 'Dignissimos quia ullam possimus nostrum nam. Sapiente qui sint in cupiditate dolorem. Soluta nihil repudiandae quas sed eos vel.', '2.99', 'maiores-voluptatem-ad-assumenda', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(35, 'Esse et ea officiis perspiciatis.', 'Dolores esse ut ut sit voluptas. Quidem eius neque nobis laborum. Cumque dolorem et voluptate non a. Aliquid beatae ab exercitationem quam enim aperiam amet.', '26.83', 'esse-et-ea-officiis-perspiciatis', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(36, 'Aliquam expedita aut.', 'Iure ut aliquid et recusandae et porro consequatur. Autem perferendis magni dolore accusamus. Quos non blanditiis ut autem sint enim.', '11.84', 'aliquam-expedita-aut', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(37, 'Explicabo temporibus id inventore.', 'Eius aliquid nihil saepe alias laborum non nisi cum. Repellendus quam eum nulla amet. Nesciunt rerum autem qui dolores incidunt dicta natus.', '47.67', 'explicabo-temporibus-id-inventore', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(38, 'Et at itaque ad.', 'Officiis dolorum eum voluptatem et aut sed eligendi et. Veritatis at mollitia atque qui sint cumque. Eos voluptate repudiandae sed eius rerum enim. Nostrum mollitia cumque iusto id natus sunt et.', '1.20', 'et-at-itaque-ad', '2021-05-12 10:15:44', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(39, 'Commodi tempora.', 'Qui repellendus quae tempore eum deserunt ratione recusandae vel. Ut vel ex nobis. Voluptatem porro excepturi et voluptatem quaerat voluptas libero.', '45.40', 'commodi-tempora', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(40, 'Voluptas ut.', 'Dolores dolorem expedita non eius laborum et corporis. Neque ea repudiandae quod explicabo maxime. Corporis ea quas est. Recusandae dolores dolores qui est quam accusantium aperiam.', '18.32', 'voluptas-ut', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(41, 'Quasi nam adipisci rerum.', 'Sunt ut illo et tenetur ipsam cum. Possimus consequatur dolor repellendus officiis corporis dicta itaque. Nesciunt eligendi est voluptatum dolor nisi et. Voluptatem eos veniam est velit mollitia.', '24.02', 'quasi-nam-adipisci-rerum', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(42, 'Quibusdam qui.', 'Et est enim magnam et quasi. Eligendi quis qui rerum id dignissimos rerum et. Rerum necessitatibus quos et aut quam illum eos. Ipsam cupiditate sint alias commodi molestias. Alias ut neque in enim harum quia autem.', '18.29', 'quibusdam-qui', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(43, 'Omnis suscipit est.', 'Ut accusamus ex ipsum voluptate suscipit reiciendis eaque. Vel nihil est consequatur unde aut iure. Vitae voluptates sint rem sit. Numquam provident nihil modi suscipit ut est.', '32.84', 'omnis-suscipit-est', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(44, 'Quia et.', 'Quo molestiae laudantium quisquam molestiae inventore perspiciatis. Animi at sapiente non id fugiat distinctio. At dignissimos exercitationem velit. Eum quae non impedit est.', '27.03', 'quia-et', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(45, 'Saepe voluptas.', 'Quae similique corrupti incidunt suscipit quae ipsa omnis. Sint amet accusantium esse debitis veritatis magni. Ut sit ea excepturi perspiciatis.', '3.36', 'saepe-voluptas', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(46, 'Doloremque rerum aut.', 'Ipsum aperiam debitis in harum tempore dicta omnis. Pariatur exercitationem sit quia molestiae ex ut. At et nihil dolore consequuntur illo rem.', '37.99', 'doloremque-rerum-aut', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(47, 'A eum maxime.', 'Nihil et eius deserunt natus optio rem est. Sunt magnam aut nihil. Dolores quos possimus ea provident sunt et.', '12.80', 'a-eum-maxime', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(48, 'Nemo ut consequuntur aut.', 'Quos quae repudiandae et accusamus repudiandae ipsam. Praesentium porro porro commodi ut dolorem ut fuga. Sequi aperiam fuga vitae omnis. Aut quaerat eius qui aperiam provident.', '36.39', 'nemo-ut-consequuntur-aut', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(49, 'Alias et voluptatum ipsam aliquid.', 'Occaecati et quis ipsum esse. Suscipit pariatur nisi omnis aliquam unde. Eius vel laboriosam voluptatem voluptas nisi quis assumenda.', '36.07', 'alias-et-voluptatum-ipsam-aliquid', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(50, 'Ab in.', 'Accusantium nemo et autem similique excepturi. Magnam quidem et nulla sunt.', '14.89', 'ab-in', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(51, 'Voluptatibus adipisci.', 'Velit itaque nostrum tenetur quod eligendi deleniti. Odit earum nisi sed ipsam. Dolorum accusamus omnis totam et aliquid aspernatur aspernatur.', '23.09', 'voluptatibus-adipisci', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(52, 'Sit non sunt necessitatibus facilis.', 'Vel quisquam placeat qui rerum tempora vel atque error. Voluptatem totam id dolore perferendis debitis. Voluptate officia dolor et cumque quos doloremque tempore. Eos quis voluptate non vel.', '10.37', 'sit-non-sunt-necessitatibus-facilis', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(53, 'Blanditiis aut cupiditate.', 'Voluptatibus quasi tenetur aut et consequatur. Quisquam distinctio et magni odit perspiciatis amet.', '31.10', 'blanditiis-aut-cupiditate', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(54, 'Tempore minus earum quo.', 'Sed impedit incidunt consequatur aut eum. Ipsam ut voluptatem nam quia ipsa sapiente nobis. Ad harum necessitatibus temporibus quo a repellendus consequatur. Eum eos officia sit est tempora quae ut.', '27.78', 'tempore-minus-earum-quo', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(55, 'Consequatur dolores aut numquam.', 'Qui quia reprehenderit ut dolores. Et quae pariatur omnis id aut libero deserunt dignissimos. Ea nihil ea aliquid ipsa et voluptates maiores cumque. Et architecto debitis minus nihil. Corrupti voluptatem officia aut sequi quae nam delectus.', '2.15', 'consequatur-dolores-aut-numquam', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(56, 'Consequuntur cupiditate quaerat quae.', 'Sint ex alias delectus maiores et. Sit eum quia est id. Illo ea omnis unde ab. Ad voluptatem aut doloremque minus accusamus quas.', '43.32', 'consequuntur-cupiditate-quaerat-quae', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(57, 'Dolore fugiat quas.', 'Consequatur ea cum temporibus non modi. Sit dolore nemo quis placeat praesentium. Ea possimus qui eaque ab.', '17.77', 'dolore-fugiat-quas', '2021-05-12 10:15:45', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(58, 'Nesciunt tempore eos rerum.', 'Magni tempora ut rerum quas quam. Modi cum accusantium facilis odit rerum ab. Quae quis sit pariatur voluptatem. Nobis numquam rerum libero assumenda ex neque repellat.', '43.42', 'nesciunt-tempore-eos-rerum', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(59, 'Est possimus tenetur unde.', 'Atque sit aut minima deleniti eius soluta. Ipsam provident ut est voluptates ut. Et debitis amet natus.', '17.75', 'est-possimus-tenetur-unde', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(60, 'Qui omnis enim.', 'Libero aut et consequatur ut sed sed. Aliquid occaecati id et voluptatum sit omnis. Dolores aperiam et et quas totam sit.', '6.03', 'qui-omnis-enim', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(61, 'Quo id ab doloremque nisi.', 'A consectetur perferendis laborum voluptas officia enim rem. Tempore omnis illum numquam repellendus illo placeat et. Reprehenderit cum neque accusamus incidunt veniam. Consequatur occaecati amet qui eum debitis adipisci labore. Aspernatur eos quas voluptatem sint consequuntur mollitia.', '4.68', 'quo-id-ab-doloremque-nisi', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(62, 'Nihil dolorem nemo.', 'Sint necessitatibus qui aut adipisci optio consequatur mollitia. Aperiam id qui est corrupti voluptas. Voluptas esse aut id ea.', '45.98', 'nihil-dolorem-nemo', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(63, 'Accusantium enim dolorum.', 'Et officiis facilis voluptatem in. Sint doloribus aut est repellat praesentium eos. Facilis non aperiam illo odit. Voluptates eveniet autem ut ab.', '48.67', 'accusantium-enim-dolorum', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(64, 'Sunt est vero.', 'Et ipsum eos id at eveniet sunt. Quidem dicta dolore laudantium quisquam ratione et voluptatibus. Nihil neque iure omnis aliquid. In quis ut cum nostrum totam.', '39.98', 'sunt-est-vero', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(65, 'Eum veniam.', 'Accusamus culpa vitae quia quibusdam. Tempore veniam sunt quis voluptates culpa. Molestias et nulla impedit saepe dicta et culpa neque.', '15.77', 'eum-veniam', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(66, 'Ea similique ratione fuga.', 'Consequatur facere similique et quibusdam dolorum autem. Est doloribus quia illo. Dignissimos non aut eos voluptas illum dolorum illum rerum.', '12.89', 'ea-similique-ratione-fuga', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(67, 'Autem labore consequatur ipsum.', 'Voluptatem molestiae et qui sequi ab corrupti. Voluptas iure quis quibusdam voluptatum repellat aliquam. Omnis ipsum illum illum sed. Praesentium nihil animi veniam est autem qui aliquid.', '27.66', 'autem-labore-consequatur-ipsum', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(68, 'Qui ut necessitatibus.', 'Maiores sit voluptatem est perspiciatis quod odio voluptatem dolores. Ullam eos quis tenetur sunt inventore totam. Modi maxime et porro illo minima dolor omnis. Et perferendis ut numquam provident non.', '7.69', 'qui-ut-necessitatibus', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(69, 'Nisi deserunt ut quasi ipsa.', 'Quos at praesentium id optio qui sunt. Perferendis officia eius ex qui a sit. A non doloremque ut similique.', '23.92', 'nisi-deserunt-ut-quasi-ipsa', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(70, 'Quia sequi nisi ut.', 'Quas nostrum aut voluptas id. Odio dolorem natus sed consectetur qui nostrum voluptatem. Nam eos itaque commodi sequi ratione voluptate beatae.', '20.89', 'quia-sequi-nisi-ut', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(71, 'Cum ea soluta.', 'Illum et molestiae laboriosam maxime fugiat esse. Similique vitae iure ut consequatur autem neque ad aliquid. Doloremque alias est excepturi tempora nihil consequatur et. Enim nemo et minus est omnis.', '8.95', 'cum-ea-soluta', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(72, 'Est amet libero nam.', 'Ea aliquid autem et esse. Iusto sunt asperiores eaque. Ut quibusdam eligendi itaque eos doloribus nostrum porro. Et ad vel similique est ratione omnis.', '7.61', 'est-amet-libero-nam', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(73, 'Voluptatem error.', 'Omnis placeat earum ut labore molestiae suscipit. Delectus maiores quasi quasi. Vel perspiciatis tenetur voluptatem maxime et qui consequatur.', '27.41', 'voluptatem-error', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(74, 'Quidem nisi fugit.', 'Error dolorem est voluptatibus. Nam et vero quaerat similique. Voluptates eligendi deleniti enim dignissimos voluptas rerum molestias et.', '6.61', 'quidem-nisi-fugit', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(75, 'Sed velit iste.', 'Repellat officia voluptatem harum necessitatibus in. Est quo velit possimus corporis. Aut id et et consequatur consequatur nihil aperiam. Voluptas temporibus laboriosam tempora.', '38.49', 'sed-velit-iste', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(76, 'Soluta ut.', 'Dolores et dolores sequi. Animi eligendi veritatis voluptates tenetur aut tenetur mollitia. Omnis assumenda quae quia et blanditiis at. Sit in eos autem placeat modi magnam.', '8.55', 'soluta-ut', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(77, 'Eius eum tenetur quos.', 'Est ipsa modi repellendus autem. Et totam qui molestias aut.', '33.70', 'eius-eum-tenetur-quos', '2021-05-12 10:15:46', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(78, 'Inventore quaerat et.', 'Dolores quis est cumque voluptate. Dolorem optio aut libero et dolorem error. Cupiditate facere alias iure optio dolorem non. Blanditiis quo sunt tempora sapiente.', '30.07', 'inventore-quaerat-et', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(79, 'Omnis nemo ducimus quia dicta.', 'Aspernatur magni in quia non. Minus dolorum similique fuga odio non quidem minima. Ad laudantium rerum numquam atque nam iusto. Numquam tempore qui quia in quia odio. Suscipit quasi alias ipsam sed possimus ratione et inventore.', '29.10', 'omnis-nemo-ducimus-quia-dicta', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(80, 'A minus illum et.', 'Cupiditate placeat et est. Pariatur nihil ipsum est aut similique et. Modi reprehenderit perferendis tenetur recusandae ut autem. Sapiente provident dicta sed iste sed perspiciatis eos. Exercitationem alias sint praesentium.', '37.68', 'a-minus-illum-et', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(81, 'Quam nulla provident culpa.', 'Error eos assumenda vel odio ipsa optio. Molestiae rerum enim nihil. Laborum temporibus quia pariatur nihil quia eveniet. In id sit qui iusto nostrum ullam accusantium.', '3.00', 'quam-nulla-provident-culpa', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(82, 'Quis aperiam.', 'Rerum fuga neque deleniti. Repudiandae fugit temporibus dolores voluptatem itaque voluptatem. Eos quo sequi qui voluptatem provident et.', '20.10', 'quis-aperiam', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(83, 'Assumenda esse dolorem.', 'Quia non iusto quas est quo enim libero. Quia nobis quaerat sit. Voluptatem numquam ut omnis quae dolor. Laboriosam voluptates beatae recusandae perferendis eum.', '24.82', 'assumenda-esse-dolorem', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(84, 'Nihil est adipisci illo.', 'Non sed dolores omnis sapiente minus vel. Voluptas doloribus dolore sit nihil quo. Delectus nam expedita ut reprehenderit qui consequuntur. Mollitia doloremque et ipsum perspiciatis doloribus.', '12.33', 'nihil-est-adipisci-illo', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(85, 'Velit temporibus quia.', 'Et illum et quis ut aut consequatur. Ex dolorem reprehenderit sed. Error tempore velit repellendus qui ullam distinctio. Ut rerum quo et aut voluptates in soluta.', '16.53', 'velit-temporibus-quia', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(86, 'Omnis tenetur dicta.', 'Et quaerat unde ut nisi. Corporis nulla ad rerum. Enim repellendus ea aut officiis sit molestias saepe. Nobis incidunt corporis iusto ea similique occaecati consequatur doloremque.', '17.66', 'omnis-tenetur-dicta', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(87, 'Facere eum et qui.', 'Porro eveniet sint corrupti cupiditate consequatur inventore. Error occaecati dicta dolorem nobis animi. Et voluptatum illum cum debitis iusto dolores.', '45.59', 'facere-eum-et-qui', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(88, 'Autem magnam fugit.', 'Odit in pariatur accusantium quo. Repellat ut temporibus qui aut rerum nobis quibusdam.', '29.53', 'autem-magnam-fugit', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(89, 'Rerum architecto sit et.', 'Inventore natus ipsam error nihil et. Iure adipisci eos animi aut. Atque sunt quam id molestias animi quo possimus consequatur.', '21.15', 'rerum-architecto-sit-et', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(90, 'Repudiandae saepe ex dolorem dolores.', 'Deleniti ullam placeat provident inventore sequi quae. Voluptate eius et dolorem corporis perspiciatis et assumenda. Magni optio ut qui atque laboriosam architecto aut similique.', '22.90', 'repudiandae-saepe-ex-dolorem-dolores', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(91, 'Natus modi veritatis rem.', 'Laborum consequatur enim ut ullam. Molestiae earum aliquid cupiditate. At voluptatem a aut deserunt velit cum ut. Ratione iure ullam sunt nemo accusamus sunt.', '7.59', 'natus-modi-veritatis-rem', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(92, 'Qui quia sunt.', 'Autem tempore et blanditiis est porro. Rem ut omnis laudantium quia cupiditate eligendi aut. Perspiciatis accusantium laboriosam assumenda aliquam sint. Eum cupiditate dolores quia qui soluta aut quo.', '14.08', 'qui-quia-sunt', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(93, 'Corporis excepturi reprehenderit autem.', 'Iusto porro dicta et fuga exercitationem ut perferendis iusto. Unde dignissimos aliquid id et consequatur.', '10.97', 'corporis-excepturi-reprehenderit-autem', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(94, 'Nemo aut consequatur sed.', 'Ut enim quo sint placeat eos eos fugit vero. Non repellendus asperiores sapiente doloremque in architecto repudiandae. Earum delectus officia nisi sapiente voluptas deserunt eum sequi.', '12.97', 'nemo-aut-consequatur-sed', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(95, 'Facilis iure totam.', 'Sed esse aliquid fuga voluptatem. Est quod eum et quis pariatur incidunt deserunt. Corrupti accusantium harum alias tenetur. Neque vitae molestiae quis quidem et dolor magnam.', '32.69', 'facilis-iure-totam', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(96, 'Molestias vero atque cumque ut.', 'Et quas molestias ex et sequi vero deleniti qui. Similique repellat ut amet illo.', '33.72', 'molestias-vero-atque-cumque-ut', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(97, 'Dolores sapiente.', 'Ut maxime temporibus eos aut qui non ducimus nulla. Amet error cumque consequatur nihil quis quidem recusandae. Expedita consectetur temporibus eveniet beatae officia consequuntur magnam velit. Et qui sequi quo qui et. Soluta dolor aspernatur ipsam ducimus debitis.', '11.20', 'dolores-sapiente', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(98, 'Occaecati qui sapiente odio minus.', 'Sit impedit ab omnis sed repudiandae. Earum cum quibusdam est assumenda. Voluptas quasi quisquam pariatur aperiam. Dignissimos sint quasi adipisci voluptatem consectetur. Repudiandae sint aliquam cumque error.', '29.81', 'occaecati-qui-sapiente-odio-minus', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(99, 'Qui vel voluptas aut.', 'Fugit voluptatum quo fugiat fugiat ipsam. Adipisci eum esse quia vitae. Earum et dolor perspiciatis enim vel suscipit at. Est ut ut molestiae.', '37.26', 'qui-vel-voluptas-aut', '2021-05-12 10:15:47', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(100, 'Et sed dicta enim.', 'Nam velit voluptatem rerum natus eum iusto. Voluptatibus est in qui amet hic debitis. Ad commodi qui est adipisci est. A necessitatibus vero ratione sit ipsa. Eveniet ut deleniti veniam quas.', '26.55', 'et-sed-dicta-enim', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(101, 'Quod minima voluptatem ex.', 'Id impedit ipsum illo aut nihil ut. Consequatur non dolor ut aperiam inventore.', '33.35', 'quod-minima-voluptatem-ex', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(102, 'Magni rerum non aut.', 'Excepturi dolores aut cupiditate enim accusamus. Iusto sed qui et non rerum optio doloribus. Temporibus voluptates ratione ad aspernatur consequuntur. Magni et provident dolor ea.', '43.75', 'magni-rerum-non-aut', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(103, 'Dolor temporibus assumenda maiores.', 'Veritatis porro sed eum in quod autem ea. Voluptatum libero accusantium qui. Voluptatum cupiditate eum voluptas fugit.', '30.20', 'dolor-temporibus-assumenda-maiores', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(104, 'Enim eum amet.', 'Minima et eaque et nam vel. Est illum facilis odit et est id corrupti. Consequatur quos unde dolores culpa.', '33.35', 'enim-eum-amet', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(105, 'Rerum ducimus.', 'Veniam est corporis nam consectetur earum ipsa accusantium. Soluta sit quia architecto et. Nesciunt dolorum itaque autem corporis.', '46.68', 'rerum-ducimus', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(106, 'Rerum sit sint ut.', 'Nihil eligendi consequatur a repellat ut dolore dolorum. Error et officia ullam. Enim velit quis ullam enim. Corporis repellat reprehenderit unde harum at eaque aut.', '15.85', 'rerum-sit-sint-ut', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(107, 'Voluptas ut laudantium.', 'Qui totam animi atque corporis tempora. Molestias qui et quidem nobis sit at laudantium asperiores. Dolores magnam esse ullam autem excepturi quia iusto.', '15.92', 'voluptas-ut-laudantium', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(108, 'Laudantium laudantium iusto.', 'Vel corrupti quis accusamus et. Sed et delectus in commodi. Omnis dolore quos ducimus nam. Possimus sit earum et et sed. Voluptatum voluptatum ea eum sed praesentium exercitationem animi odio.', '30.89', 'laudantium-laudantium-iusto', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(109, 'Repudiandae veritatis aut asperiores.', 'Dignissimos adipisci similique praesentium ea libero qui sit. Soluta iste sequi earum. Maxime earum voluptatum aut et qui.', '40.49', 'repudiandae-veritatis-aut-asperiores', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(110, 'Animi tempore eum.', 'Doloremque fuga est ducimus natus quia deleniti ut. Sapiente tempora corrupti dolor dolorem culpa. Exercitationem officia non quis quod id.', '19.54', 'animi-tempore-eum', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(111, 'Vero nostrum est.', 'Voluptatum asperiores molestias veniam placeat quibusdam. Voluptas omnis quo tempore assumenda dolor.', '11.95', 'vero-nostrum-est', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(112, 'Deleniti est.', 'Debitis et veritatis eos aspernatur. Officia est incidunt modi tempore numquam. Soluta possimus similique voluptas esse qui dicta nisi sed.', '25.47', 'deleniti-est', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(113, 'Numquam quia et enim.', 'Unde ea deleniti animi sunt quo et aut eum. Libero exercitationem facere ut asperiores itaque. Et reiciendis autem ex at nesciunt. Quos rerum distinctio deserunt quae officiis veritatis.', '27.80', 'numquam-quia-et-enim', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(114, 'Eos iure pariatur.', 'Alias voluptatem molestiae corrupti amet corporis. Culpa est hic consequatur commodi aut consequatur a. Corporis voluptas voluptate iusto et sapiente error. Non qui officiis nisi quisquam ad. Aperiam recusandae facere voluptatem autem.', '10.66', 'eos-iure-pariatur', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(115, 'Consequatur aut perspiciatis impedit.', 'Amet reiciendis reprehenderit vitae assumenda exercitationem libero eum. Voluptatem ut recusandae ad pariatur assumenda quis rerum. Ut tempora ut alias assumenda. Voluptatem suscipit id a sit est architecto.', '45.72', 'consequatur-aut-perspiciatis-impedit', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(116, 'Dolor deserunt reiciendis nihil asperiores.', 'Ut repellat sint voluptas corrupti eos aut ad. Veniam et voluptatum et unde aliquam. Maxime voluptatem est sapiente est id ut voluptatum ea.', '40.92', 'dolor-deserunt-reiciendis-nihil-asperiores', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(117, 'Ut est id pariatur voluptas.', 'Veritatis exercitationem modi commodi et. Voluptatem totam impedit cum ipsum unde libero sed. Error deserunt ad saepe delectus modi quam.', '29.68', 'ut-est-id-pariatur-voluptas', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(118, 'Id neque quo vitae adipisci.', 'Repellat velit ab et excepturi voluptatem reiciendis voluptates sit. Officiis est repudiandae voluptas neque ut. Eaque sit aut ratione consectetur ipsam quidem ex. A unde voluptatem reprehenderit dolore minus amet.', '40.71', 'id-neque-quo-vitae-adipisci', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(119, 'Suscipit vitae saepe in velit.', 'Ullam quam sunt dolor est maxime. Nostrum optio aperiam est inventore quam voluptatum voluptas a. Qui et modi omnis delectus id aliquid. Quam voluptate quas aut officia minus dolor omnis.', '32.51', 'suscipit-vitae-saepe-in-velit', '2021-05-12 10:15:48', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(120, 'Quia quas maxime ipsam.', 'Dolores ratione inventore distinctio et qui natus. Optio fugiat est autem est consequatur mollitia. Nihil ab laboriosam soluta. Ea dicta et ut assumenda nisi quod.', '40.29', 'quia-quas-maxime-ipsam', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(121, 'Ut commodi corrupti molestiae et.', 'Dolor distinctio dolorum ut. Architecto facilis quidem vitae sunt nulla. Fuga possimus et reiciendis facilis unde.', '49.50', 'ut-commodi-corrupti-molestiae-et', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(122, 'Illum ducimus et veritatis.', 'Accusamus quibusdam voluptate non neque cupiditate. Tempora omnis sed recusandae est suscipit et ut. Consequatur dicta voluptatem nesciunt expedita molestias. Quisquam architecto accusantium qui est veniam occaecati aliquid. Sunt quod et recusandae quisquam vitae doloremque dignissimos.', '18.80', 'illum-ducimus-et-veritatis', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(123, 'Harum odit nisi.', 'Doloremque ut nemo dolorum. Eligendi voluptatem delectus molestiae sit velit. Iste voluptate corrupti maxime inventore doloribus deleniti.', '12.73', 'harum-odit-nisi', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(124, 'Dolores autem sit deleniti.', 'Tempore quidem vel consequatur sapiente temporibus aut et molestiae. Quibusdam sit vel sapiente. Placeat molestias maiores nesciunt fuga eum enim quibusdam illo.', '40.68', 'dolores-autem-sit-deleniti', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(125, 'Omnis cumque animi.', 'Delectus sint atque quam sed rerum tempore. Quibusdam iusto porro odit quia. Eius sunt perspiciatis nobis iste velit voluptatem. Tempore nesciunt voluptatum et adipisci.', '3.79', 'omnis-cumque-animi', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(126, 'Aut delectus.', 'Porro eveniet accusamus velit suscipit perferendis tempora. Nam quo provident explicabo impedit maiores. Molestiae sit tenetur sed iusto voluptas accusantium. Quia nobis non placeat inventore.', '20.02', 'aut-delectus', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(127, 'Doloremque reiciendis eligendi.', 'Consectetur non laudantium est fuga necessitatibus quidem incidunt. Sunt id ut reiciendis. Amet numquam illum aliquid ipsa cumque eum magnam. Accusamus aperiam optio eius magni debitis. Sit aut quia voluptatum est maiores et.', '21.15', 'doloremque-reiciendis-eligendi', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(128, 'Voluptatibus molestias voluptas.', 'Laborum id quo sunt neque exercitationem. At dolores ullam pariatur minima error. Laborum quos laudantium quod qui et. Ut molestiae perferendis consequatur iusto vel excepturi.', '22.64', 'voluptatibus-molestias-voluptas', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(129, 'Facilis inventore fugiat.', 'Sunt rerum laboriosam qui eligendi. Impedit exercitationem quisquam dignissimos voluptatem quia. Numquam magnam veritatis laboriosam omnis rem recusandae.', '32.40', 'facilis-inventore-fugiat', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(130, 'Qui voluptatem aperiam.', 'Soluta nihil molestiae veniam. Tenetur voluptates modi est ea quaerat minus est voluptate.', '2.35', 'qui-voluptatem-aperiam', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(131, 'Animi dolores ea.', 'Autem magni provident beatae molestias aut corrupti. Deleniti at et qui sint. Et sit sunt ipsum molestias aspernatur nobis iure in. Ipsam voluptatem ut natus.', '12.88', 'animi-dolores-ea', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(132, 'Id ipsum quod ad.', 'Officiis temporibus fuga omnis. Et rerum pariatur odio. Voluptates aliquam excepturi cum nemo. Debitis ea et est.', '7.75', 'id-ipsum-quod-ad', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(133, 'Aut nesciunt asperiores enim.', 'Libero eaque voluptatem id omnis optio esse. Et voluptas cumque porro et dolore nostrum quia. Atque ea dolores sequi modi molestiae velit voluptatem. Sint illo ipsam laborum quam fugiat quos. Aut veritatis eligendi debitis ut hic esse fugit voluptas.', '41.33', 'aut-nesciunt-asperiores-enim', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(134, 'Nihil et veritatis voluptatem.', 'Eum dolores quibusdam illo aperiam. Ut nam quis voluptas ipsa ab accusamus accusantium. Cupiditate eos veritatis facere dolorem nihil tempora ratione. Qui qui id est harum tenetur dolorem ut.', '37.19', 'nihil-et-veritatis-voluptatem', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(135, 'Fugit error blanditiis.', 'Magni deleniti veritatis itaque dicta dolores dolorem. Ratione est ut veniam cum eligendi ullam explicabo. Odio soluta repellat ex cupiditate mollitia quia. Dolorum voluptatibus quidem dicta aut numquam voluptas omnis. Labore amet quo ut qui eius aut assumenda.', '7.98', 'fugit-error-blanditiis', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(136, 'Voluptas quia animi.', 'Fugiat culpa laborum et explicabo quam. Quod omnis ducimus itaque cumque doloribus.', '3.62', 'voluptas-quia-animi', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(137, 'Possimus atque corrupti itaque.', 'Quis voluptatem nam dolores ad quaerat dicta consequatur. Occaecati optio voluptates quod modi illum ut suscipit.', '47.43', 'possimus-atque-corrupti-itaque', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(138, 'Dolorem architecto debitis.', 'Eveniet delectus alias earum doloribus ea. Temporibus vel asperiores dignissimos consequuntur.', '48.46', 'dolorem-architecto-debitis', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(139, 'Velit ducimus.', 'Non sequi consequatur accusamus earum sed. Est dolor aperiam labore explicabo deleniti enim. Voluptate recusandae provident ut rerum nulla. Iure nesciunt ea est et unde.', '14.00', 'velit-ducimus', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(140, 'Itaque qui iusto.', 'Sed molestias suscipit et et repudiandae error eius expedita. Facere commodi rerum enim. Nisi et sint voluptates adipisci qui. Asperiores sed eligendi qui nulla molestiae. Ut quia earum est possimus.', '25.60', 'itaque-qui-iusto', '2021-05-12 10:15:49', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(141, 'Omnis cumque at.', 'Rerum consequatur culpa vel sunt. Maiores expedita laudantium quis itaque. Voluptatem nobis eaque est laudantium necessitatibus. Et aut ea ex blanditiis fugiat harum qui.', '16.42', 'omnis-cumque-at', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(142, 'Eum in aut.', 'Minus modi repellendus expedita. Dolor minima explicabo nostrum minus quaerat. Vel distinctio eos est et dolorum eligendi est molestiae.', '18.95', 'eum-in-aut', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(143, 'Omnis et at voluptas.', 'Rem voluptas ab animi molestiae labore architecto rerum. Sint officiis consectetur voluptatibus fugiat. Consequatur voluptas natus quo modi.', '35.65', 'omnis-et-at-voluptas', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(144, 'Molestiae suscipit.', 'Qui corporis et sint doloremque. Ut impedit sed repudiandae non aut. Sint voluptatem culpa eius.', '38.72', 'molestiae-suscipit', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(145, 'Consequatur voluptatibus sed.', 'Quis odit reiciendis neque provident. Incidunt qui quibusdam perferendis consequuntur quia. Aut fugiat ut atque magnam rerum aut ea. Culpa est rerum eius corporis atque voluptatem accusantium qui.', '20.57', 'consequatur-voluptatibus-sed', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(146, 'Non ipsam in.', 'Sint et ea consequatur. Molestias ratione amet non assumenda qui repellat. Eveniet quibusdam quasi optio corrupti libero et. Qui officia quibusdam eveniet natus voluptatem deserunt ipsum.', '45.73', 'non-ipsam-in', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(147, 'Et est labore aut.', 'Fuga doloremque enim nulla animi earum aspernatur dolorum tempora. Nihil ut veniam sapiente est. Aut quod voluptatem aliquam ut ut.', '18.88', 'et-est-labore-aut', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(148, 'Veritatis et sunt dolore.', 'Eaque accusantium est suscipit qui. Omnis dicta beatae consequuntur eum nihil nisi aperiam. Adipisci recusandae praesentium dolores esse ipsam illo tempore.', '30.35', 'veritatis-et-sunt-dolore', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(149, 'Animi velit quia unde.', 'Ipsam et provident inventore ut temporibus omnis. Rerum aliquid est sunt debitis dolor. Et ut inventore sed optio iusto modi eum.', '45.41', 'animi-velit-quia-unde', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(150, 'Aspernatur omnis saepe sint.', 'Eos quis et libero dolore. Sint assumenda eum non rerum enim. Aut aut ut harum corporis. Nesciunt recusandae quod architecto.', '31.88', 'aspernatur-omnis-saepe-sint', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(151, 'Quae sit omnis minus fuga.', 'Aut molestias quaerat praesentium tenetur. Dolor consequatur id aut provident voluptates. Blanditiis dolores vel at illo nemo quis architecto dolores. Distinctio omnis est et suscipit ullam.', '16.61', 'quae-sit-omnis-minus-fuga', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(152, 'Eveniet enim doloribus voluptatum.', 'Distinctio autem at minima porro sint placeat. Sed eum unde et maiores explicabo cum. Distinctio autem ullam unde non.', '22.45', 'eveniet-enim-doloribus-voluptatum', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(153, 'Ducimus tenetur doloremque veniam.', 'Dolorem dolorem commodi provident inventore id quaerat autem aut. Debitis cumque qui ut similique qui dignissimos aut repudiandae. Voluptatibus officiis deserunt in repellendus et maxime. Hic quasi eligendi error ad rerum.', '21.74', 'ducimus-tenetur-doloremque-veniam', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(154, 'Asperiores in accusantium architecto.', 'Sint animi fugit repellat delectus. Ex officiis ut qui doloremque voluptatem cum et cum. Voluptatem est quis rerum odio. Omnis voluptatem omnis id consequatur.', '2.84', 'asperiores-in-accusantium-architecto', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(155, 'Laboriosam vel labore alias fugit.', 'Praesentium placeat quo dolor natus velit. Nobis qui deleniti debitis repellendus sed.', '34.88', 'laboriosam-vel-labore-alias-fugit', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(156, 'Fugiat qui minima exercitationem.', 'Eaque sunt eius quibusdam recusandae occaecati. Numquam non et nesciunt dolor in aliquid esse. Nihil consequatur ab perspiciatis iste excepturi impedit. Repellat ea non et itaque labore at.', '43.85', 'fugiat-qui-minima-exercitationem', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(157, 'Quaerat sapiente explicabo quis.', 'Beatae animi aut nobis. Deserunt adipisci quos officiis distinctio illo ut. Perferendis quasi eveniet error sed est numquam minus qui. Culpa ab deserunt explicabo voluptatem.', '17.09', 'quaerat-sapiente-explicabo-quis', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(158, 'Eum illum ad molestias.', 'Quos minus voluptatem explicabo facilis exercitationem iusto. Laudantium distinctio quis molestias ex ex consequatur aliquam. Aut eveniet eos eaque ut totam.', '42.95', 'eum-illum-ad-molestias', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(159, 'In sit aliquam.', 'Dolorum corrupti sunt voluptatibus harum minima molestias culpa. Et id consectetur tempore vitae consequuntur animi. Molestias autem exercitationem accusantium ut cumque suscipit explicabo.', '48.71', 'in-sit-aliquam', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(160, 'Debitis iusto quod aperiam.', 'Sit sed in adipisci esse. Sequi est dolores eaque beatae provident animi quo delectus. Magni vero corporis optio illum eos necessitatibus facere.', '4.77', 'debitis-iusto-quod-aperiam', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(161, 'Veniam voluptas facere et.', 'Cum culpa dolores architecto dolorum dolore quidem sed. Blanditiis quis fugit perspiciatis deserunt molestiae repellat rerum dolore. Doloremque tenetur sunt consectetur deserunt eaque. Non quo dicta sed nesciunt inventore et et.', '44.44', 'veniam-voluptas-facere-et', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(162, 'Libero vero aut.', 'Rerum explicabo sed ut a eos. Ratione qui laudantium qui est mollitia. Sint ea molestiae cum magni. Aut velit quidem error quam. Officia nobis occaecati ad at est quisquam quod beatae.', '39.28', 'libero-vero-aut', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(163, 'Quod eligendi autem explicabo occaecati.', 'Assumenda sapiente asperiores ab dolor. Facere numquam ea ullam et rerum et. Dolores voluptatem ad eum maxime eligendi.', '17.34', 'quod-eligendi-autem-explicabo-occaecati', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(164, 'Error sint iste totam.', 'Et ipsam magnam fugiat ut quia quo praesentium. Iste officiis dolor ipsa et accusantium accusantium dolorem.', '4.50', 'error-sint-iste-totam', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(165, 'Ducimus earum.', 'Aut distinctio amet sunt explicabo velit similique. Sed ipsam magni earum architecto repudiandae. Corrupti commodi debitis facere alias et.', '16.68', 'ducimus-earum', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(166, 'Laboriosam deserunt et ab.', 'Nostrum est ut ut ab a sed. Aliquid non dignissimos autem eum illum facilis velit. Reprehenderit quaerat eum id molestias aut rerum saepe. Fugit repellat earum delectus error velit.', '24.75', 'laboriosam-deserunt-et-ab', '2021-05-12 10:15:50', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(167, 'Vel est consequatur voluptas.', 'Facilis reprehenderit mollitia in. Aut vel optio quos et odio aperiam et. Voluptatem laboriosam fugit eveniet sed consectetur aliquid. Non corrupti dolore qui praesentium dolore ut.', '21.54', 'vel-est-consequatur-voluptas', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(168, 'Eligendi eius non ut aut.', 'Reiciendis eum qui veritatis dolorum alias. Veniam nam eaque dolorem possimus. Quia veritatis in voluptas ex perspiciatis officiis assumenda et.', '44.43', 'eligendi-eius-non-ut-aut', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(169, 'Deleniti similique culpa.', 'Aut consectetur temporibus qui repudiandae illum. Quo temporibus rerum magni at. Sed repellendus sed aut. Culpa iure voluptates est architecto harum perferendis hic quod.', '32.49', 'deleniti-similique-culpa', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(170, 'Molestiae et at.', 'Dolorem cupiditate veniam enim qui vero vero laudantium. Numquam voluptas perspiciatis sequi vitae et at mollitia. Voluptatem voluptatem exercitationem vero et laborum illum.', '46.33', 'molestiae-et-at', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(171, 'Et et voluptatum quaerat.', 'Quibusdam quo deleniti molestias. Iure est facilis quos et ipsa dolores. Adipisci laboriosam molestias et et ea sed sunt. Velit ea quam commodi ut.', '46.90', 'et-et-voluptatum-quaerat', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(172, 'Consequatur nam aliquid rerum.', 'Rem ipsum sit voluptas perspiciatis temporibus. Rerum quae in facilis quo. Molestias qui et deserunt atque quo. Et nihil officia omnis qui aut.', '9.31', 'consequatur-nam-aliquid-rerum', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(173, 'Omnis quis rerum eligendi.', 'Vero voluptatum rerum ex aliquam. Et ut et consequuntur sequi. Et aut rerum dolor dolorem quia consectetur eos. Aliquam molestiae distinctio ea aut architecto est ad.', '11.35', 'omnis-quis-rerum-eligendi', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(174, 'Libero quaerat voluptas.', 'Id facere quasi facilis odit consequatur delectus autem et. Quaerat ab dolores dolor. Qui quam nam libero eveniet iure quo sed. Et eum velit doloribus ut nulla.', '14.39', 'libero-quaerat-voluptas', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(175, 'Ex quis aliquam at est.', 'Cupiditate sunt dolores adipisci saepe incidunt. Inventore quisquam quisquam quaerat pariatur suscipit id. Quo omnis in incidunt vero. Consequatur harum ut quia doloribus.', '6.64', 'ex-quis-aliquam-at-est', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(176, 'Minus omnis laudantium.', 'Fugit quis optio explicabo tempora error. Labore animi nostrum et. Et iusto mollitia culpa alias voluptatem assumenda rerum. Odit hic id voluptatum vitae sit commodi et.', '6.01', 'minus-omnis-laudantium', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(177, 'Distinctio libero eum ipsam.', 'Non autem hic quisquam numquam exercitationem cumque. Consequatur voluptates et quo quis rerum aperiam. Assumenda facilis dolorum minima ipsum voluptatem.', '30.35', 'distinctio-libero-eum-ipsam', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(178, 'Magnam soluta voluptas fugit.', 'Quis exercitationem doloribus rerum aliquam alias beatae eum. Quaerat et eligendi voluptatem amet maxime accusamus omnis. Quas sequi saepe rem et dolores rem. Consequatur consequuntur ut laudantium laudantium.', '21.07', 'magnam-soluta-voluptas-fugit', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(179, 'Maiores rem consequatur.', 'Molestias quia minus deleniti. Nisi adipisci odit enim amet sunt quia occaecati sed. Facilis magnam voluptatem incidunt nobis.', '47.36', 'maiores-rem-consequatur', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(180, 'Iste itaque magni sequi.', 'Dolores et doloribus est et non. Quasi iusto excepturi eos totam consequuntur voluptates non. Necessitatibus quisquam est architecto eum.', '15.30', 'iste-itaque-magni-sequi', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(181, 'Porro sapiente dolor.', 'Est sint itaque eos iure et autem in. Consequatur suscipit voluptatem rerum quam aut. Voluptates odit ut vitae ullam. Sapiente et ipsum maiores consequatur vel facilis.', '43.39', 'porro-sapiente-dolor', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(182, 'Aliquam et neque.', 'Molestiae nihil odio expedita recusandae et dolorem. Voluptate iste est quia cumque reprehenderit fugit. Pariatur omnis quia ullam accusamus. Exercitationem nobis fuga omnis et voluptates officia.', '38.23', 'aliquam-et-neque', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(183, 'Consequatur et velit.', 'Aut doloremque nam temporibus voluptas harum possimus quia corrupti. Tempora et qui impedit numquam eum aut quia perspiciatis. Et molestias officia asperiores autem cupiditate mollitia.', '28.90', 'consequatur-et-velit', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(184, 'Quidem beatae rem alias.', 'Velit alias minus cupiditate hic eum rerum et voluptatem. Sunt consequuntur vel deserunt quam vitae officia laboriosam. Sunt et dolores explicabo.', '21.99', 'quidem-beatae-rem-alias', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(185, 'Explicabo minus et consequatur.', 'Architecto fugiat cupiditate enim odio dolores doloremque aspernatur. Distinctio quia voluptatem hic ipsum voluptatibus deserunt. Exercitationem pariatur sed architecto dolores. Qui eius repudiandae qui dolor.', '24.27', 'explicabo-minus-et-consequatur', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(186, 'Non ullam saepe.', 'Iusto in reiciendis aliquam. Impedit repellat minus dolores culpa qui facilis id quia. Veniam porro corporis rerum iure soluta voluptatem.', '30.87', 'non-ullam-saepe', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(187, 'Et numquam est aliquam aut.', 'Occaecati cupiditate nam itaque. Assumenda accusamus quo consequatur laudantium tempore quaerat.', '48.21', 'et-numquam-est-aliquam-aut', '2021-05-12 10:15:51', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(188, 'Quidem autem magnam voluptas.', 'Enim fuga fugit quibusdam vel et. Sunt quia quia non neque.', '11.13', 'quidem-autem-magnam-voluptas', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(189, 'Rerum doloribus ea.', 'Accusantium laboriosam iste accusamus laborum tempora. Doloribus similique sunt modi pariatur aut consequatur iste. Dolore iure nulla saepe est expedita commodi incidunt.', '30.45', 'rerum-doloribus-ea', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(190, 'Dolorem aliquam facere.', 'Amet recusandae quisquam animi voluptas. Et quam quo quae et. Rem explicabo magni nulla nulla.', '30.62', 'dolorem-aliquam-facere', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(191, 'Fuga necessitatibus.', 'Sed placeat tenetur aut cumque temporibus iusto alias. Consequatur itaque nisi qui placeat et vero. Et sed dignissimos fugit commodi et.', '31.23', 'fuga-necessitatibus', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(192, 'Voluptatem alias repudiandae.', 'Qui rerum id voluptatum neque et voluptatibus culpa. Facilis cum dolorem culpa fugiat accusantium dolorem mollitia ad. Veniam sit reprehenderit in.', '5.91', 'voluptatem-alias-repudiandae', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(193, 'Rem quo explicabo.', 'Quam numquam animi dolore et exercitationem iusto totam. Laboriosam non et rerum cumque. Sed voluptates quaerat molestiae sint totam ut voluptas.', '30.91', 'rem-quo-explicabo', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(194, 'At et aut numquam reiciendis.', 'Deserunt ab temporibus numquam accusamus temporibus sit magnam illo. Autem sed architecto quia et quia. Voluptatibus itaque et recusandae. Quas accusamus excepturi nihil aspernatur officiis architecto.', '40.90', 'at-et-aut-numquam-reiciendis', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(195, 'Maiores ipsum numquam.', 'Voluptatem voluptatem dolor voluptas aliquid. Dolorum tenetur autem cupiditate alias similique quo deserunt adipisci. Est beatae consectetur quae sed cum nemo voluptas.', '28.78', 'maiores-ipsum-numquam', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(196, 'In accusantium reprehenderit.', 'Ipsa est labore consequatur qui quaerat quia. Eum est consequatur magnam tenetur sit eaque distinctio. Est amet maxime quam quia ad est. Ut et libero velit.', '37.41', 'in-accusantium-reprehenderit', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(197, 'Voluptatem sed officia.', 'Sed excepturi quia consequatur velit odit dolores voluptatem. Voluptatem ratione nemo saepe quibusdam rem magnam sunt. Qui aut et possimus expedita sit aliquam.', '3.65', 'voluptatem-sed-officia', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(198, 'Ab doloremque laudantium est.', 'Accusantium quasi maxime eius voluptatem qui et. Impedit aperiam accusantium aut cumque molestiae est qui. Quia ut iusto aut consequuntur in quia. Voluptas dolores consequatur ea corrupti. Consequuntur ipsum quis alias molestias laudantium.', '4.35', 'ab-doloremque-laudantium-est', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(199, 'Quasi velit cum.', 'Laborum expedita sit accusamus quae est veniam. Modi eum omnis harum harum ut qui. Consequatur in tenetur error minus quisquam odio. Ad quo ut necessitatibus.', '47.07', 'quasi-velit-cum', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(200, 'Nihil vel ea.', 'Sed corrupti dolores cumque similique quos dignissimos sit. Voluptatem sit dolor ex facilis sint. Saepe corporis rerum nihil dolore temporibus a. Facere quidem sint voluptatem quae.', '37.38', 'nihil-vel-ea', '2021-05-12 10:15:52', '2021-05-12 10:26:01', '2021-05-12 10:26:01'),
(201, 'Financial Accounting', NULL, '2000.00', 'financial-accounting', '2021-05-16 04:11:07', '2021-05-16 04:11:07', NULL),
(202, 'Mathematics', NULL, '500.00', 'mathematics', '2021-05-16 11:21:40', '2021-05-16 11:21:40', NULL),
(203, 'Science Guide', NULL, '300.00', 'science-guide', '2021-05-16 11:22:33', '2021-05-16 11:22:33', NULL),
(204, 'Mathematics - II', NULL, '560.00', 'mathematics-ii', '2021-05-17 03:20:09', '2021-05-17 03:20:09', NULL),
(205, 'English Communication', NULL, '3000.00', 'english-communication', '2021-05-17 03:21:06', '2021-05-17 03:21:06', NULL),
(206, 'Nepali - 11', NULL, '3000.00', 'nepali-11', '2021-05-17 04:48:52', '2021-05-17 04:48:52', NULL),
(207, 'Nepali', NULL, '3000.00', 'nepali', '2021-05-17 04:51:37', '2021-05-17 04:51:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`, `deleted_at`, `category_id`) VALUES
(1, 'Ut', 'Neque sint quo voluptatum qui. Facilis ex reiciendis quisquam eius. Delectus harum cupiditate delectus sint quod quia. Atque aut ab odit fugiat exercitationem.', 'ut', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', NULL),
(2, 'Magnam et voluptas.', 'Cumque quae qui maxime provident eaque at. Sint possimus enim ea ut porro iusto sequi. Officia eos rerum eum possimus eius. Nulla illum qui omnis culpa dolor.', 'magnam-et-voluptas', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 1),
(3, 'Quas nihil eum aut autem.', 'Aut et praesentium laudantium quia necessitatibus. Magni temporibus nemo alias qui est saepe distinctio. Dolores ducimus error ipsa.', 'quas-nihil-eum-aut-autem', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 2),
(4, 'Quia ut totam dicta rerum.', 'Est alias temporibus quam consequuntur fugit. Sint tenetur consequatur excepturi corrupti reprehenderit voluptates cupiditate. Nulla et assumenda amet.', 'quia-ut-totam-dicta-rerum', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', NULL),
(5, 'Consequatur voluptas et.', 'Deleniti voluptatem beatae non iure consequatur libero. Assumenda repudiandae nulla sapiente. Earum rerum qui odit nihil molestiae eaque libero. Quaerat odit eos perspiciatis ea quas cum. Temporibus suscipit debitis illo.', 'consequatur-voluptas-et', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 2),
(6, 'Voluptatem minus corrupti incidunt error.', 'Aut explicabo omnis aut molestiae. Autem praesentium aliquid alias eum. Excepturi sunt alias velit. Voluptate nemo consequatur dicta blanditiis.', 'voluptatem-minus-corrupti-incidunt-error', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 2),
(7, 'Pariatur voluptate praesentium fugiat.', 'Sed ipsa similique velit deserunt dolore sint. Dolorem accusamus quia est inventore est reiciendis maxime modi. Autem saepe eos corrupti dolor. Iure distinctio totam consequatur molestiae.', 'pariatur-voluptate-praesentium-fugiat', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 2),
(8, 'Labore natus et.', 'Necessitatibus magnam iste pariatur temporibus et quam dolores. At vitae placeat qui dolorem. Vel provident aut inventore. Eveniet voluptates reiciendis praesentium possimus dolores libero voluptates. Doloribus facilis cupiditate consequuntur possimus quidem quis tenetur qui.', 'labore-natus-et', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 1),
(9, 'Libero sed itaque.', 'Eius ullam recusandae et ea. Qui esse voluptatem amet et qui quisquam. Ut eum iusto atque et earum est reiciendis. Magni iure commodi sed fugit.', 'libero-sed-itaque', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 8),
(10, 'Ex dolor sit repudiandae.', 'Incidunt praesentium sunt quia sunt. Et numquam itaque et modi. Laudantium laborum recusandae sed qui incidunt cum fuga ut. Placeat est atque tempore dolorem.', 'ex-dolor-sit-repudiandae', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 8),
(11, 'Atque facilis laboriosam porro.', 'Labore rerum facilis nesciunt sit. Suscipit quaerat sunt voluptates aut non rerum incidunt. Illum explicabo tenetur voluptas aut.', 'atque-facilis-laboriosam-porro', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 8),
(12, 'Totam et nulla quo.', 'Unde reprehenderit est eum et architecto. In voluptatem repellendus ipsam quia dolore rem et. Magni rerum sint beatae aut magnam delectus saepe labore.', 'totam-et-nulla-quo', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 8),
(13, 'Harum sed et.', 'Ab omnis hic illo qui dolor sed magnam. Excepturi voluptate ex placeat est. Adipisci facilis eaque corporis. Adipisci animi voluptas ea quas. Placeat explicabo quaerat totam nemo ea fugit.', 'harum-sed-et', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 8),
(14, 'Ipsum et distinctio.', 'Itaque autem aliquam fugit dolores autem qui. Totam tenetur nobis deleniti eos maxime. Quis expedita est repellat veritatis. Aut rerum ducimus est odit.', 'ipsum-et-distinctio', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 1),
(15, 'At eos id nihil.', 'Est nemo et dolor omnis eum dolore aspernatur. Dolorum ratione possimus nihil. Soluta quidem at eum ipsum porro ullam.', 'at-eos-id-nihil', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 14),
(16, 'Quae enim nihil.', 'Vel earum consequatur vel animi nam quia. Vitae natus ut quod consequatur quidem laboriosam est. Est fugit eius delectus quos.', 'quae-enim-nihil', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 14),
(17, 'Rerum nostrum.', 'Officia perspiciatis quia nihil quisquam velit omnis explicabo. Ipsa eveniet aliquid ex quo dolorem cumque provident. Voluptas id et qui architecto. Sed qui eum optio facilis velit omnis impedit omnis. Ipsam non qui vel.', 'rerum-nostrum', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 14),
(18, 'Saepe explicabo eum.', 'Sint exercitationem et dolorum sunt dolorem eius. Et et exercitationem vel ut omnis distinctio. Voluptate repellat explicabo odio quas. Eveniet autem qui aspernatur consequuntur rerum ea.', 'saepe-explicabo-eum', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 14),
(19, 'Non eos non qui ut.', 'Ipsam quam tenetur fugiat reiciendis unde quidem ut. Voluptas eum molestiae reprehenderit quaerat. Veniam nihil et aut repudiandae consequatur unde earum impedit. Delectus labore quibusdam est.', 'non-eos-non-qui-ut', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 14),
(20, 'Incidunt qui eligendi.', 'Repellat voluptas minus fugiat pariatur. Aspernatur placeat perspiciatis dolores et ab repellat unde voluptas. Omnis sunt sed animi provident placeat.', 'incidunt-qui-eligendi', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 1),
(21, 'Nulla ut vero.', 'Qui esse neque quae ab molestias reiciendis vitae. Architecto sint et debitis hic totam eaque placeat. Cumque autem error repellendus. Ipsum repudiandae aliquam quasi velit.', 'nulla-ut-vero', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 20),
(22, 'In officiis tempora consequuntur.', 'Omnis provident maxime ad nobis aperiam quis. Eos impedit in exercitationem molestias voluptatem. Omnis in aut vel quia sit.', 'in-officiis-tempora-consequuntur', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 20),
(23, 'Ipsam quis numquam illum.', 'Sit qui explicabo molestiae voluptas vel. Velit illo fugiat et sed neque tempora officia iure. Odio suscipit quia sunt sint.', 'ipsam-quis-numquam-illum', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 20),
(24, 'Reprehenderit quo doloremque beatae et.', 'Aut dolorem eligendi ut. Modi inventore ut culpa quis sit. Doloremque est quis et rerum animi sit velit at.', 'reprehenderit-quo-doloremque-beatae-et', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 20),
(25, 'Eligendi quia nisi quisquam.', 'Enim aut quia harum ab et deserunt. Tenetur doloremque modi porro aspernatur.', 'eligendi-quia-nisi-quisquam', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 20),
(26, 'Ab voluptas placeat.', 'Cumque ratione dicta in dolorem quod. Esse ipsum natus vel corporis. Debitis et saepe nemo vel voluptatum. Rem ipsam hic qui repellendus voluptatem et qui voluptatem.', 'ab-voluptas-placeat', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 1),
(27, 'Officia rerum provident velit soluta.', 'Molestiae provident quia quia. Quod facere quisquam sint suscipit maxime architecto. Beatae maiores magni ut est sint.', 'officia-rerum-provident-velit-soluta', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 26),
(28, 'Esse qui et molestiae.', 'Delectus a dolore consequuntur non. Eum consequuntur rem dolorem laborum id suscipit eum. Nihil minima molestiae est qui accusamus tempora laudantium. Et amet est corporis harum nam aut qui.', 'esse-qui-et-molestiae', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 26),
(29, 'Quis sed molestias magnam.', 'Numquam eum aut ut id inventore magni. Sequi unde velit ut autem temporibus veniam ea. Incidunt laboriosam ex quia et ipsum blanditiis delectus. Vel quas eius sint nihil. Et officia est fugiat ut dolorem.', 'quis-sed-molestias-magnam', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 26),
(30, 'Cum enim perspiciatis corporis.', 'Numquam dignissimos soluta similique aut et. Perspiciatis nobis repellat ut. A quia cum recusandae recusandae impedit doloremque quia. Repellendus qui facilis vel minima quas.', 'cum-enim-perspiciatis-corporis', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 26),
(31, 'Fuga eligendi debitis molestiae.', 'Libero dolor ipsum nam alias odio. Doloremque qui dignissimos odit ducimus et maiores. Sed delectus quia praesentium voluptate voluptatem. Temporibus vel corporis ullam repellendus error.', 'fuga-eligendi-debitis-molestiae', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 26),
(32, 'In', 'At omnis eligendi facilis. Quis ratione dolorem magni. Blanditiis quia ut et quia. Ullam numquam provident ullam quisquam quos numquam.', 'in', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', NULL),
(33, 'Provident sed.', 'Officia beatae omnis quaerat magni ut vero aut. Maiores eveniet ut fugit sint veniam cupiditate. Eum vel voluptatem ratione ut. Aliquam et praesentium aliquid minus quia.', 'provident-sed', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 32),
(34, 'Ut est iusto.', 'Quo nihil ut distinctio molestias. Vel quam dolore et dolor nihil ut repudiandae. Officia dolores id rerum temporibus.', 'ut-est-iusto', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 33),
(35, 'Saepe dicta quaerat.', 'Impedit modi quis saepe nemo. Eos aliquid est excepturi eum.', 'saepe-dicta-quaerat', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 33),
(36, 'Nisi totam perferendis exercitationem.', 'Vel omnis est delectus repellat nihil. Quae hic ipsum voluptate quibusdam ratione commodi. Suscipit laudantium omnis aut aperiam qui. Repellat cupiditate omnis numquam.', 'nisi-totam-perferendis-exercitationem', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 33),
(37, 'Necessitatibus aperiam et minima.', 'At voluptatem cum minus ratione ipsam nostrum. Iste molestiae laudantium fugiat reprehenderit iusto velit nihil at.', 'necessitatibus-aperiam-et-minima', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 33),
(38, 'Qui autem et.', 'Qui omnis consequatur laborum dolores. Veniam dolorum ut amet officiis tempore.', 'qui-autem-et', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 33),
(39, 'Laudantium nulla hic.', 'Ad consectetur dicta facilis ea aliquam laudantium aut rerum. Deserunt dolores enim deleniti. Repellendus minima dicta rerum qui hic accusamus.', 'laudantium-nulla-hic', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 32),
(40, 'Perspiciatis inventore ipsam nihil.', 'Vel corporis blanditiis sint. Ullam perspiciatis impedit eligendi minima. Doloremque consequatur aliquid saepe temporibus at adipisci et.', 'perspiciatis-inventore-ipsam-nihil', '2021-05-12 10:15:40', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 39),
(41, 'Accusantium est nostrum omnis.', 'Aut placeat illum ducimus nesciunt aut impedit. Aut doloremque maxime officia ex dolorem. Vero neque reiciendis magni eaque error quo ratione.', 'accusantium-est-nostrum-omnis', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 39),
(42, 'Esse et quasi illum.', 'Voluptas consequatur repellat illum et iste. Animi ut reprehenderit et iste ab ad. Sit provident assumenda nihil ea perspiciatis.', 'esse-et-quasi-illum', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 39),
(43, 'Id error suscipit.', 'Hic dolor sunt voluptatem excepturi. Ea rerum magnam nemo dicta magnam velit.', 'id-error-suscipit', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 39),
(44, 'Voluptates quisquam.', 'Laborum et in sunt corporis et voluptatem in. Sed harum quae nihil dolorem. Ipsa saepe tempore qui repudiandae exercitationem provident iusto. Est cupiditate expedita vero veritatis tenetur.', 'voluptates-quisquam', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 39),
(45, 'Quos et.', 'Quas et reiciendis qui. Est cupiditate possimus doloribus eveniet. Eligendi adipisci et consequatur quia eum autem.', 'quos-et', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 32),
(46, 'Earum assumenda architecto occaecati.', 'Eos officiis nulla porro est nisi. Perspiciatis nobis odio sapiente. Sint et dolore pariatur praesentium. Omnis perferendis exercitationem minus odit doloremque voluptate iusto.', 'earum-assumenda-architecto-occaecati', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 45),
(47, 'Laborum dolor enim.', 'Saepe cupiditate perferendis aut consequatur culpa. Voluptates ipsum amet error aperiam reprehenderit eligendi. Maxime architecto repellat qui voluptatem natus deserunt.', 'laborum-dolor-enim', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 45),
(48, 'Cupiditate aut cumque.', 'Quibusdam provident eum sit. Possimus sit sunt magnam officiis labore. Maiores quod doloremque iure ut vitae qui.', 'cupiditate-aut-cumque', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 45),
(49, 'Vero illum dicta nemo.', 'Ut molestias porro mollitia molestiae est. Quae animi repellendus id aut. Eos odio pariatur aut ipsum minima vel qui. Excepturi pariatur incidunt esse.', 'vero-illum-dicta-nemo', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 45),
(50, 'Quam et suscipit voluptas.', 'Animi molestias magni aut consequatur aut voluptatem. Quidem tempora velit voluptatem qui laudantium. Vero aut voluptate aliquid ullam temporibus explicabo voluptates.', 'quam-et-suscipit-voluptas', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 45),
(51, 'Sunt nostrum eos.', 'Sint deserunt tenetur enim exercitationem. Totam quibusdam in repellat sunt. Modi quae tenetur possimus.', 'sunt-nostrum-eos', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 32),
(52, 'Velit aut laudantium labore cupiditate.', 'Id optio dolorem quae reprehenderit facere. Magnam harum dolores ipsa non.', 'velit-aut-laudantium-labore-cupiditate', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 51),
(53, 'Aut veritatis quidem.', 'Excepturi minus vero voluptatum quis. Nobis voluptatem nemo facilis et in. Cum itaque fugiat sed quisquam facilis. Eum cupiditate numquam eos consequatur aut. Dolorem ut dicta vero labore at quos.', 'aut-veritatis-quidem', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 51),
(54, 'Veritatis sint culpa fuga omnis.', 'Aut ut consequatur repellendus cum expedita aspernatur sit. Vel ad dignissimos harum ad ipsam nihil. Illum fugiat fugit omnis quod optio dolor accusamus natus.', 'veritatis-sint-culpa-fuga-omnis', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 51),
(55, 'Dicta accusantium velit.', 'Quam neque eius iure et. Expedita ab eveniet natus dolorum. Officiis quia quaerat fugiat commodi est dolorem voluptatum aut. Hic soluta dolor ea officia tempore voluptas consequatur. Iste ut facere accusamus sit enim.', 'dicta-accusantium-velit', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 51),
(56, 'Quia placeat aut qui.', 'Vero dolor consequatur voluptatibus ex vitae fugit. Repellat ducimus ullam quasi est. Earum sit aut voluptatem et voluptatem et sed hic. Ea repudiandae ut minus est eius tempora veniam.', 'quia-placeat-aut-qui', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 51),
(57, 'Dolorem dolorum voluptatum.', 'Molestiae aut aut ipsum hic. Ad aliquam quaerat facilis omnis sapiente. Qui ad corrupti optio culpa veniam sit. Earum nulla iure id modi corporis magnam.', 'dolorem-dolorum-voluptatum', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 32),
(58, 'Laboriosam et molestiae.', 'Et dolorem animi aut qui. Qui omnis sunt repudiandae dicta qui maxime est. Quasi vero amet vitae quod. Eveniet quas aut a fugit rerum distinctio voluptatem.', 'laboriosam-et-molestiae', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 57),
(59, 'Id harum eum illum.', 'Vitae cumque maiores dolor enim. Earum magni consequatur quas ut totam repudiandae.', 'id-harum-eum-illum', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 57),
(60, 'Cupiditate eius corporis.', 'Consequatur voluptas voluptatem et in non. Est voluptatem adipisci veniam accusamus harum. Non dignissimos omnis est impedit ipsa aut non. Soluta voluptatem quia voluptatem voluptatem ducimus eligendi dicta. Occaecati adipisci possimus voluptatem rem voluptas distinctio quo.', 'cupiditate-eius-corporis', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 57),
(61, 'Maxime consequatur nulla.', 'Quis minus vero cum quaerat doloremque incidunt sed iste. Non laudantium ab in quasi et unde. Eos eos optio minima dolor est.', 'maxime-consequatur-nulla', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 57),
(62, 'A perspiciatis et.', 'Neque nemo voluptate sed aliquam magni incidunt dolore. Dolores iure iusto fugit tenetur praesentium ea nihil.', 'a-perspiciatis-et', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 57),
(63, 'Quo', 'Alias totam quia perferendis quis excepturi rem incidunt. Et debitis et hic enim. Praesentium rem quia omnis quaerat veniam adipisci consequatur quis. Velit vitae hic nisi et eveniet eveniet. Id placeat ullam praesentium nulla nam ut.', 'quo', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', NULL),
(64, 'Dolores rerum et.', 'Temporibus ullam ducimus numquam maiores. Nihil explicabo blanditiis nulla cumque minus rem impedit. Officiis earum nemo fugit itaque aut error. A sed sed velit. Natus tenetur est tenetur consequatur est reiciendis enim culpa.', 'dolores-rerum-et', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 63),
(65, 'Commodi dolorem minus.', 'Dolores libero et minus nesciunt blanditiis est autem. Aut alias quod ipsa rerum iure voluptatum vitae. Aperiam optio voluptatem quia quidem mollitia culpa.', 'commodi-dolorem-minus', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 64),
(66, 'In excepturi vel et.', 'Voluptatem vero voluptas ipsa aut neque nostrum nam. Sapiente excepturi corporis et beatae omnis aspernatur quia est. Rem inventore quia repudiandae tenetur. Assumenda illum quo possimus ipsum unde asperiores nihil.', 'in-excepturi-vel-et', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 64),
(67, 'Aut aut rerum.', 'Voluptatum aut unde quidem fuga. Molestias aut voluptas est asperiores reprehenderit animi vel et. Quas rerum dolor harum quaerat sunt. Quisquam qui illo perferendis beatae.', 'aut-aut-rerum', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 64),
(68, 'Nostrum et earum illo.', 'Magni excepturi commodi voluptas voluptatem. Neque vitae aliquam quaerat tempore. Ut ab vitae dolores quam odit cum. Odit iste nobis molestias facilis.', 'nostrum-et-earum-illo', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 64),
(69, 'Voluptatem consequatur earum.', 'Inventore ipsa provident praesentium alias et. Et minima deleniti rerum rerum vitae. Quia inventore aliquam sint consequatur sed.', 'voluptatem-consequatur-earum', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 64),
(70, 'Consequuntur odit ipsa.', 'Repudiandae culpa qui omnis consequuntur accusantium adipisci optio eaque. Sed laudantium aspernatur et tempore. Qui voluptas ullam amet placeat repudiandae magni consequatur.', 'consequuntur-odit-ipsa', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 63),
(71, 'Reiciendis qui voluptatem.', 'Ad et quibusdam fugiat inventore animi. Consequatur ex exercitationem animi laudantium ut sed. Quam qui laboriosam illo odio numquam impedit sequi. Impedit sunt rem sed iste voluptatem.', 'reiciendis-qui-voluptatem', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 70),
(72, 'Ipsa quia voluptatibus dicta.', 'Est fuga ut consectetur. Dicta sint repellendus facilis id. Reiciendis fugiat tempora eligendi est culpa. Quasi ea aspernatur culpa fugit molestias nam et.', 'ipsa-quia-voluptatibus-dicta', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 70),
(73, 'Aut officia recusandae omnis.', 'Perferendis maxime excepturi quisquam nihil. Sit repellendus molestias illum saepe nam in placeat. Impedit magni fuga dolore cum repellendus. Hic quae est voluptatum aut itaque alias.', 'aut-officia-recusandae-omnis', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 70),
(74, 'Exercitationem blanditiis quae.', 'Et aut et qui magnam. Eos nobis consequatur et. Eum suscipit expedita et omnis ducimus. Consequatur aut et fugit omnis eaque ipsam voluptatem. Deleniti voluptates et delectus quia veritatis aliquam doloribus rerum.', 'exercitationem-blanditiis-quae', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 70),
(75, 'Quod sunt perspiciatis.', 'Sunt cupiditate ducimus laudantium aut repellendus. Aliquam accusantium id et assumenda. Repellendus consequatur eius vitae expedita debitis est. Quae laboriosam aut temporibus quia in ut.', 'quod-sunt-perspiciatis', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 70),
(76, 'Quis pariatur.', 'Sit blanditiis voluptas aut sed et facere. Quibusdam ea qui aut necessitatibus sed provident. Corrupti velit omnis ut sed sit facere enim.', 'quis-pariatur', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 63),
(77, 'Quas deleniti quo.', 'Et tenetur veniam rem et aut. Ut quia est consequuntur non necessitatibus quisquam asperiores harum. Non assumenda sapiente omnis magnam. Quia illum pariatur id voluptates ut deserunt voluptatum non.', 'quas-deleniti-quo', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 76),
(78, 'Qui sunt.', 'Qui nihil aliquam omnis cum ut sint error. Explicabo corporis praesentium accusantium sapiente itaque mollitia.', 'qui-sunt', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 76),
(79, 'Eius est voluptates.', 'Nam quisquam quidem unde non et. Repellat aut voluptatem soluta quae dolores a est. Sapiente voluptas fugit et iure voluptates sint illo. Accusamus nisi exercitationem aut id.', 'eius-est-voluptates', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 76),
(80, 'Enim dicta odio.', 'Dolores rerum sunt dicta voluptates. Voluptas saepe voluptatem vel neque exercitationem harum. Quae repudiandae quidem quia minima nesciunt. Nulla natus rerum eos consequuntur voluptatem quisquam autem.', 'enim-dicta-odio', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 76),
(81, 'Id reprehenderit et soluta.', 'Debitis veritatis quis excepturi consequuntur voluptas assumenda et ratione. Odio autem ea ipsum sed sapiente similique. Voluptas adipisci ut distinctio sit minus temporibus velit id.', 'id-reprehenderit-et-soluta', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 76),
(82, 'Dolor facere sapiente.', 'Modi nihil rem dolorum cumque. Minima eius at voluptates modi reprehenderit. Nemo deleniti velit praesentium hic nihil qui sint. Ad asperiores molestias laborum minus ut.', 'dolor-facere-sapiente', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 63),
(83, 'Autem omnis quia.', 'Ad dolorum illum assumenda iure doloribus. Qui consequatur voluptatem saepe vero. Veritatis qui sint in odio est dolorum. Eos eaque vel maxime necessitatibus molestiae laboriosam.', 'autem-omnis-quia', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 82),
(84, 'Enim ipsam dolorum.', 'Ea occaecati sapiente quas est incidunt fuga. Magni iusto occaecati totam. Aut unde molestiae labore iusto.', 'enim-ipsam-dolorum', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 82),
(85, 'Qui quia perferendis reiciendis.', 'Dolore eos eligendi fuga vel et. Et doloribus sunt nemo ut doloribus praesentium dolore eos. Dolorum atque quam amet nihil voluptatibus placeat. Fuga aut quo officiis ut laboriosam et consequatur.', 'qui-quia-perferendis-reiciendis', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 82),
(86, 'Tenetur iure dolores.', 'Qui incidunt unde maxime qui corrupti. A quis est quibusdam voluptates eveniet ut. Eum velit numquam et debitis id deserunt est.', 'tenetur-iure-dolores', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 82),
(87, 'Id dolorem.', 'Eos eos exercitationem fuga numquam. Aut dolorum deleniti omnis unde praesentium et. Et consequuntur earum veniam aut esse voluptas sed doloribus.', 'id-dolorem', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 82),
(88, 'Enim et nam.', 'Sint temporibus itaque natus dicta aut sit. Hic rerum dolores impedit perferendis aspernatur culpa odit.', 'enim-et-nam', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 63),
(89, 'Fugit aliquam.', 'Labore officia similique dolorum mollitia et. Magnam repellendus delectus voluptates quod. A soluta expedita ipsa optio. Et fugit optio ut harum vero facere iste.', 'fugit-aliquam', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 88),
(90, 'Quis ex.', 'Nemo earum molestiae perspiciatis est mollitia. Sed quis eos rerum amet occaecati. Excepturi ab aut voluptatem reiciendis rerum quidem ipsum. Esse accusamus ullam neque accusantium deserunt.', 'quis-ex', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 88),
(91, 'Quia tenetur molestiae amet mollitia.', 'Ipsa odio fugiat vel et et beatae. Officiis recusandae atque accusantium tempore cupiditate rerum consequatur sint. A nulla est sed eaque.', 'quia-tenetur-molestiae-amet-mollitia', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 88),
(92, 'Neque cupiditate.', 'Et aut velit laborum ab id dolor. Totam natus sapiente id enim suscipit explicabo odit. A eaque labore asperiores sed.', 'neque-cupiditate', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 88),
(93, 'A qui harum eveniet.', 'Veritatis autem est dicta. Rerum minima occaecati quo natus. Est corporis voluptatum unde suscipit neque. Qui similique aut asperiores aut eligendi nobis sapiente.', 'a-qui-harum-eveniet', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 88),
(94, 'Deleniti', 'Voluptas quam recusandae iste vitae ut. Tempore veritatis aperiam voluptatibus. Doloribus deserunt excepturi quam.', 'deleniti', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', NULL),
(95, 'Debitis porro.', 'Et cumque officia occaecati ex ut. Et sed perspiciatis rerum ut ut harum ea. Reprehenderit et cupiditate quia nisi. Impedit porro perspiciatis quaerat nesciunt odit.', 'debitis-porro', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 94),
(96, 'Quas dolore eos.', 'Dolores similique voluptatibus ab qui. Quis recusandae eum pariatur voluptatem. Quasi consectetur optio omnis est in sed. Maiores doloribus accusantium aut. Aut eaque omnis voluptatum iste.', 'quas-dolore-eos', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 95),
(97, 'Nostrum officiis deleniti.', 'Impedit doloribus aut autem consequuntur. Itaque commodi cumque veritatis quod est. Architecto quia possimus quae dolorem. Natus fuga velit incidunt fugit.', 'nostrum-officiis-deleniti', '2021-05-12 10:15:41', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 95),
(98, 'Assumenda sit maxime.', 'Nulla corporis voluptas non labore dignissimos natus. A rerum consequuntur unde excepturi numquam vel. Delectus delectus ducimus dolorem doloribus soluta. Aspernatur omnis consequatur repellat hic quas qui fugiat.', 'assumenda-sit-maxime', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 95),
(99, 'Dicta laborum hic quidem.', 'Ut non ipsum dicta corrupti perspiciatis cum. Nihil quidem magnam doloremque at et voluptas. Consectetur autem quidem aut.', 'dicta-laborum-hic-quidem', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 95),
(100, 'Autem rem iste.', 'Sed omnis explicabo provident sint doloribus quibusdam eum. Accusamus eius sit blanditiis esse quasi. Laudantium atque laboriosam doloremque provident ut nesciunt ea.', 'autem-rem-iste', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 95),
(101, 'Saepe dolor voluptate.', 'Aspernatur quas ut possimus architecto voluptas. Eaque itaque illum minus. Molestiae asperiores tenetur repudiandae aperiam error non.', 'saepe-dolor-voluptate', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 94),
(102, 'Et explicabo officia.', 'Iusto non aperiam quidem voluptatem accusantium natus. Ab iste ex aut asperiores optio consequatur. Quae eum corrupti ab provident enim ut molestiae.', 'et-explicabo-officia', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 101),
(103, 'Quos sunt veritatis consequatur.', 'Ut nobis ipsa nihil voluptatem amet dolor quos. Cupiditate architecto sunt ut dignissimos illo et. Aliquid itaque totam officia ducimus qui et. Exercitationem voluptatem temporibus cupiditate. Nemo et ratione corrupti voluptas magni.', 'quos-sunt-veritatis-consequatur', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 101),
(104, 'Odio quae recusandae et ea.', 'Alias cupiditate officiis qui est eos reprehenderit. Ducimus aliquam ut sit recusandae. Quos laboriosam sed laudantium impedit amet et quibusdam. Blanditiis suscipit numquam voluptas ullam. Accusantium consequatur dicta officiis illo sit.', 'odio-quae-recusandae-et-ea', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 101),
(105, 'Corrupti est non atque.', 'Corrupti cumque architecto laborum inventore. Corrupti dolorem alias iste consectetur. Accusantium qui omnis odio itaque odit animi quibusdam. Possimus sit non officia ipsa.', 'corrupti-est-non-atque', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 101),
(106, 'Recusandae quam quidem.', 'Et enim sunt nostrum sint. Occaecati modi quaerat eaque minima. Excepturi voluptas rerum quis omnis commodi qui in. Aut eum harum fuga commodi.', 'recusandae-quam-quidem', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 101),
(107, 'Eos veniam quasi.', 'Sint dicta harum voluptatum sit voluptas. Incidunt cum odio suscipit dolorem. Delectus culpa dolorem architecto a ipsa rerum voluptatibus est.', 'eos-veniam-quasi', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 94),
(108, 'Consequuntur accusamus praesentium.', 'Officiis eos pariatur voluptatem dolorum excepturi. Beatae eius nulla qui odit nostrum consequatur id ut.', 'consequuntur-accusamus-praesentium', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 107),
(109, 'Ducimus qui natus est.', 'Repudiandae fuga quam quod et dolor quo exercitationem. Odit ut voluptates laborum voluptas rerum mollitia architecto. Rerum nihil harum doloremque est et. Consequatur consequatur laudantium excepturi sed natus eos et officia.', 'ducimus-qui-natus-est', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 107),
(110, 'Qui excepturi.', 'Dolorem ipsa tempore voluptatibus modi nobis. Id distinctio deserunt qui a molestias voluptatibus. Suscipit facere vitae voluptatem doloremque et ad. Iste sit quam ducimus quia debitis earum.', 'qui-excepturi', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 107),
(111, 'Error voluptates inventore.', 'Cumque cupiditate velit ut quod praesentium molestias repudiandae. Expedita non earum et quia praesentium. Minima fugit quae non eos voluptatem sequi porro.', 'error-voluptates-inventore', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 107),
(112, 'Suscipit pariatur et provident.', 'Debitis esse aut quasi voluptate possimus. Quo reiciendis consectetur nihil velit rerum in. Blanditiis aut et velit cum.', 'suscipit-pariatur-et-provident', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 107),
(113, 'Sit illum.', 'Aut maiores blanditiis ut est reiciendis et sint. Ut et quidem ea esse odio molestiae. Est voluptate eligendi et ad perferendis earum perferendis. Neque dolor velit consequatur aut.', 'sit-illum', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 94),
(114, 'Doloribus ut dolores nihil.', 'Quisquam laudantium excepturi assumenda et dolorem deserunt. Odio quam voluptates ut officiis dicta omnis ut. Ullam nobis commodi aperiam totam provident. Vero velit voluptatem harum.', 'doloribus-ut-dolores-nihil', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 113),
(115, 'Sint et.', 'Qui blanditiis aliquid alias. Ut quam dolorem praesentium saepe sit. Ipsam tempora recusandae est. Placeat neque deleniti totam repellendus sequi iusto nesciunt ullam.', 'sint-et', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 113),
(116, 'Eos tenetur.', 'Quasi voluptatem quis ea mollitia deleniti. Facilis blanditiis beatae natus. Natus omnis animi in recusandae deleniti consequatur exercitationem. Porro cumque qui accusamus vero.', 'eos-tenetur', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 113),
(117, 'Id quisquam suscipit dignissimos.', 'Molestiae nostrum placeat culpa labore voluptas. Cupiditate omnis sunt sunt quis officiis ipsa. Eaque dolor quo molestias non dolorum.', 'id-quisquam-suscipit-dignissimos', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 113),
(118, 'Incidunt vero sit quis.', 'Sit ut rerum debitis. Explicabo aliquam cupiditate maxime qui id natus cupiditate voluptates. Repudiandae incidunt minima quo deleniti est non. Accusantium necessitatibus aliquid labore nihil iste ut magnam. Et quis nesciunt dolores eos id quidem et.', 'incidunt-vero-sit-quis', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 113),
(119, 'Non voluptatem.', 'Sed repellendus consequatur voluptas enim asperiores facilis aut. Illo dolore repellat qui et aut molestias nihil. Quisquam aliquam accusamus facere porro.', 'non-voluptatem', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 94),
(120, 'Dicta omnis voluptate.', 'Inventore unde dolores nisi temporibus expedita. Maiores iure consectetur aut explicabo quam pariatur. Velit ut ipsum ipsa quia nobis.', 'dicta-omnis-voluptate', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 119),
(121, 'Autem aperiam temporibus.', 'Et et aut eligendi a aperiam voluptate expedita. Nihil officia aut est praesentium. Qui eum in pariatur quia accusamus.', 'autem-aperiam-temporibus', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 119),
(122, 'Dignissimos dolor nisi.', 'Dolorem fugiat quia dignissimos accusantium minima rerum voluptatem. Doloremque rem error quam rem rerum. Dolor nesciunt et delectus sunt non deleniti.', 'dignissimos-dolor-nisi', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 119),
(123, 'Amet libero.', 'Dolores omnis voluptates est harum suscipit aut tempore. Veritatis minus distinctio mollitia dolorem. Nihil excepturi dolorem error aspernatur non quia.', 'amet-libero', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 119),
(124, 'Voluptas sint ratione doloremque.', 'Asperiores neque ullam deleniti veritatis ipsa perspiciatis facilis. Vel sit quae inventore minima adipisci quis. Labore quis dolorem officia optio amet autem eos. Sint consequatur quia labore et.', 'voluptas-sint-ratione-doloremque', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 119),
(125, 'Eaque', 'Amet dolor voluptas alias recusandae. Voluptatem nisi omnis et magni quia. Est ut beatae ipsum aliquid totam qui officia. Nihil facilis suscipit in natus eos illo nesciunt. Iste et illo et nemo.', 'eaque', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', NULL),
(126, 'Aliquid voluptatem.', 'Corporis sed amet molestias. Sint velit earum sunt fugiat quod. Est hic impedit dolorem quo neque voluptatem.', 'aliquid-voluptatem', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 125),
(127, 'Non odit deserunt.', 'Ea labore id non sapiente fugiat. Et voluptas est quam harum qui tempora. Explicabo esse deserunt minima ut. Culpa nihil suscipit amet quia porro. Deleniti alias et quis ratione.', 'non-odit-deserunt', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 126),
(128, 'Sapiente excepturi eligendi non.', 'Quas et hic accusamus nobis officiis cupiditate quos. Numquam recusandae quis amet mollitia nobis qui est mollitia. Tenetur aut cumque voluptates consequatur est dolores perferendis.', 'sapiente-excepturi-eligendi-non', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 126),
(129, 'Voluptatem non enim.', 'Nemo velit voluptatem vero provident ullam doloremque cumque dicta. Nobis repudiandae quia magni omnis eum optio. Saepe iusto ea sed blanditiis aut occaecati.', 'voluptatem-non-enim', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 126),
(130, 'Suscipit aut doloribus optio.', 'Dolores nesciunt dolores et pariatur et quo fugiat. Vitae ea ut voluptatem quibusdam excepturi.', 'suscipit-aut-doloribus-optio', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 126),
(131, 'Aut voluptatem veritatis.', 'Voluptatem provident doloribus molestias architecto dolorem id dolores non. Aliquam accusantium quae molestiae quisquam.', 'aut-voluptatem-veritatis', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 126),
(132, 'Excepturi laudantium itaque.', 'Necessitatibus accusamus libero soluta aut ut saepe sint. Dicta nemo sequi at incidunt. Magnam nostrum minus hic aut iusto voluptatem.', 'excepturi-laudantium-itaque', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 125),
(133, 'Sequi vel eveniet reiciendis.', 'Qui quae vel veritatis odit perferendis ut suscipit. Fuga consequatur dignissimos maiores labore animi molestiae odio. Facere nesciunt harum deleniti mollitia vero sequi quia consequatur. Dolorum est et facilis. Itaque fugiat maxime laudantium nam laborum.', 'sequi-vel-eveniet-reiciendis', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 132),
(134, 'Explicabo neque minima.', 'Reiciendis perspiciatis quisquam in impedit voluptatem. Et aliquam adipisci voluptatibus cumque. Magni praesentium molestiae tenetur ipsam qui aut qui a. Veniam quia quisquam odit qui non ut.', 'explicabo-neque-minima', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 132),
(135, 'Illum et architecto.', 'Quisquam odio ducimus aut sequi. Dolorem non vel repellat sed rem iusto. Deserunt iusto deserunt consequatur labore suscipit numquam.', 'illum-et-architecto', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 132),
(136, 'Architecto qui et illo.', 'Porro et temporibus aliquam quas. Earum nobis corporis omnis libero qui. Quo et eius praesentium placeat quidem in.', 'architecto-qui-et-illo', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 132),
(137, 'Omnis possimus voluptatem quae.', 'Non ut voluptate est rerum. Debitis vero omnis aut laborum culpa et quis. Expedita reprehenderit tempora esse sapiente autem.', 'omnis-possimus-voluptatem-quae', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 132),
(138, 'Non cum hic.', 'Quo officiis atque ut. Exercitationem molestiae quod est quia. Eaque nostrum ipsum fuga.', 'non-cum-hic', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 125),
(139, 'Eos error tempora.', 'Aliquam nihil minus non at nobis molestias facere modi. Est dignissimos repellat sed sed eos neque. Qui qui atque quis perspiciatis quas voluptatem. Corrupti id incidunt placeat ipsa eaque nesciunt nihil harum. Atque quia ea omnis tempore.', 'eos-error-tempora', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 138),
(140, 'Minus ut optio aut.', 'Aliquid perspiciatis placeat quia animi quis et. Id quidem est molestiae ratione dolorem aut. Ut magnam at quaerat.', 'minus-ut-optio-aut', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 138),
(141, 'Voluptas molestias animi id.', 'Commodi minus esse ut quasi quo. Autem esse quibusdam ut recusandae. Vero itaque et est molestias voluptatibus hic voluptates debitis. Molestiae eius pariatur enim illum.', 'voluptas-molestias-animi-id', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 138),
(142, 'Ea ab placeat.', 'Soluta laborum ut aut quasi. Est est aspernatur ut corrupti qui reiciendis hic. Doloribus et iusto nobis quas nesciunt id quo autem. Omnis occaecati quos et animi.', 'ea-ab-placeat', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 138),
(143, 'Nulla perferendis ea aperiam.', 'Voluptatum magnam aspernatur qui hic quod aut vitae rerum. Necessitatibus a eos reiciendis minima ducimus. Accusamus nihil impedit sunt nam architecto.', 'nulla-perferendis-ea-aperiam', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 138),
(144, 'Blanditiis repellat id.', 'Quod quam ea fugiat quam est laudantium. Id nobis praesentium qui et qui consequatur. Tempora sed atque ut est.', 'blanditiis-repellat-id', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 125),
(145, 'Iste modi pariatur rerum.', 'Libero voluptatem dolorem rerum voluptas eum aliquid illo voluptate. Sequi totam eius sit suscipit excepturi. Commodi accusamus iure ipsa aut quasi vel reprehenderit praesentium.', 'iste-modi-pariatur-rerum', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 144),
(146, 'Repudiandae earum dolores.', 'Optio vitae sit non. Sit doloremque voluptas natus.', 'repudiandae-earum-dolores', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 144),
(147, 'Aliquid beatae delectus qui.', 'Dolore sapiente sed accusamus dolorem sapiente. Deleniti omnis quo quibusdam enim sit. Pariatur voluptas numquam nostrum qui nihil perspiciatis et et. Et velit expedita non animi.', 'aliquid-beatae-delectus-qui', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 144),
(148, 'Dicta numquam at blanditiis.', 'Aperiam fugit tenetur molestiae quo. Et totam temporibus est voluptatem sequi et. Est molestiae repellendus iusto dolor excepturi. Odio fugiat dolor unde qui. Cupiditate consectetur tempore velit maiores magnam ipsa dignissimos.', 'dicta-numquam-at-blanditiis', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 144),
(149, 'Optio et rem.', 'Dolorum expedita autem libero sint. Nam ex iste maxime velit perferendis. Amet odio aspernatur et reprehenderit. Est aspernatur soluta perspiciatis et eveniet cum sunt.', 'optio-et-rem', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 144),
(150, 'Magnam est.', 'Aut consectetur deleniti neque consequatur sed et laboriosam at. Laboriosam maiores alias a. Iure consequatur omnis repellendus.', 'magnam-est', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 125),
(151, 'Ab culpa tempora consequatur.', 'Tenetur aut sapiente tenetur dolorem. Exercitationem fugit molestiae itaque sunt commodi. Eos pariatur unde vel consequuntur aliquid mollitia harum.', 'ab-culpa-tempora-consequatur', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 150),
(152, 'Vitae quia nobis quia.', 'Quaerat voluptatem et aut assumenda asperiores non. Molestiae quisquam voluptas iure maxime est quis est. Alias culpa praesentium expedita tempora nihil quasi ad. Et quaerat quod doloremque ea.', 'vitae-quia-nobis-quia', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 150),
(153, 'Nostrum dolores rerum doloremque.', 'Omnis atque quo in reiciendis. Vero et consequatur laudantium vel cum officia ea minima. Totam fugit cum nam. Doloribus enim provident exercitationem necessitatibus.', 'nostrum-dolores-rerum-doloremque', '2021-05-12 10:15:42', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 150),
(154, 'Fugiat labore commodi.', 'Pariatur veniam laudantium praesentium doloremque. Necessitatibus pariatur quo aut perferendis. Pariatur perferendis velit ipsa voluptates. Odit nihil aut numquam ex alias expedita sunt eaque. Quia autem ipsam blanditiis architecto eum.', 'fugiat-labore-commodi', '2021-05-12 10:15:43', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 150),
(155, 'Qui est eos consectetur.', 'Et exercitationem necessitatibus dolores quasi. Esse iure est quia vel nobis. Et magnam harum non mollitia ea ullam. Voluptatem atque velit possimus.', 'qui-est-eos-consectetur', '2021-05-12 10:15:43', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 150),
(156, 'hg hhjh', NULL, 'hg-hhjh', '2021-05-12 10:25:02', '2021-05-12 10:25:15', '2021-05-12 10:25:15', 4),
(157, 'School Level', NULL, 'school-level', '2021-05-12 10:39:37', '2021-05-12 10:39:37', NULL, NULL),
(158, 'One', NULL, 'one', '2021-05-12 11:02:36', '2021-05-12 11:02:36', NULL, 157),
(159, 'Two', NULL, 'two', '2021-05-12 11:03:08', '2021-05-16 03:59:46', NULL, 157),
(160, 'University Level', NULL, 'university-level', '2021-05-12 11:06:34', '2021-05-12 11:06:34', NULL, NULL),
(161, 'BBA', NULL, 'bba', '2021-05-12 11:06:47', '2021-05-12 11:06:47', NULL, 160),
(162, 'TU', NULL, 'tu', '2021-05-12 11:07:02', '2021-05-12 11:07:02', NULL, 161),
(163, 'First Sem', NULL, 'first-sem', '2021-05-12 11:07:33', '2021-05-12 11:07:33', NULL, 162),
(164, 'First Year', NULL, 'first-year', '2021-05-16 04:01:19', '2021-05-16 04:03:09', '2021-05-16 04:03:09', 162),
(165, 'BBS', NULL, 'bbs', '2021-05-16 04:01:43', '2021-05-16 04:01:43', NULL, 160),
(166, 'TU', NULL, 'tu-1', '2021-05-16 04:02:29', '2021-05-16 04:02:29', NULL, 165),
(167, 'First Year', NULL, 'first-year-bbs-tu', '2021-05-16 04:04:13', '2021-05-16 04:04:13', NULL, 166),
(168, 'Teacher Guide', NULL, 'teacher-guide', '2021-05-16 11:20:59', '2021-05-16 11:20:59', NULL, NULL),
(169, '10 +2', NULL, '10-2', '2021-05-17 04:44:13', '2021-05-17 04:44:13', NULL, NULL),
(170, 'Eleven', NULL, 'eleven', '2021-05-17 04:44:59', '2021-05-17 04:44:59', NULL, 169),
(171, 'Twelve', NULL, 'twelve', '2021-05-17 04:49:53', '2021-05-17 04:49:53', NULL, 169),
(172, 'BIM', NULL, 'bim', '2021-05-17 05:00:34', '2021-05-17 05:00:34', NULL, 160),
(173, 'KU', NULL, 'ku', '2021-05-17 05:01:05', '2021-05-17 05:01:05', NULL, 172),
(174, 'Third Semester', NULL, 'third-semester', '2021-05-17 05:01:35', '2021-05-17 05:01:35', NULL, 173);

-- --------------------------------------------------------

--
-- Table structure for table `product_product_category`
--

CREATE TABLE `product_product_category` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_product_category`
--

INSERT INTO `product_product_category` (`product_id`, `product_category_id`) VALUES
(1, 65),
(2, 91),
(3, 153),
(4, 25),
(4, 81),
(5, 41),
(5, 69),
(5, 137),
(6, 18),
(6, 30),
(7, 12),
(8, 25),
(8, 37),
(8, 129),
(9, 4),
(9, 22),
(9, 134),
(10, 91),
(11, 93),
(11, 112),
(12, 27),
(13, 155),
(14, 28),
(14, 46),
(14, 134),
(15, 18),
(15, 148),
(15, 149),
(16, 37),
(16, 97),
(17, 9),
(18, 18),
(19, 19),
(20, 13),
(20, 123),
(20, 151),
(21, 77),
(22, 92),
(23, 9),
(23, 31),
(23, 103),
(24, 67),
(25, 31),
(25, 61),
(26, 67),
(26, 75),
(27, 19),
(27, 148),
(28, 89),
(28, 110),
(29, 15),
(29, 17),
(30, 21),
(30, 55),
(31, 149),
(32, 21),
(32, 42),
(33, 15),
(33, 35),
(33, 134),
(34, 44),
(34, 90),
(34, 108),
(35, 100),
(36, 84),
(36, 85),
(36, 98),
(37, 134),
(38, 60),
(38, 93),
(39, 87),
(40, 3),
(40, 18),
(41, 89),
(42, 43),
(42, 60),
(42, 108),
(43, 87),
(43, 121),
(44, 30),
(44, 71),
(44, 122),
(45, 69),
(45, 80),
(45, 83),
(46, 36),
(46, 56),
(46, 100),
(47, 11),
(47, 53),
(47, 118),
(48, 25),
(48, 41),
(48, 54),
(49, 21),
(49, 34),
(49, 154),
(50, 5),
(50, 71),
(50, 122),
(51, 12),
(51, 73),
(52, 9),
(52, 104),
(52, 140),
(53, 72),
(53, 98),
(54, 47),
(54, 56),
(55, 5),
(55, 34),
(55, 67),
(56, 59),
(56, 80),
(56, 111),
(57, 83),
(58, 16),
(58, 49),
(58, 124),
(59, 56),
(59, 136),
(60, 36),
(60, 37),
(60, 73),
(61, 46),
(62, 149),
(63, 6),
(63, 114),
(63, 149),
(64, 10),
(64, 59),
(65, 6),
(65, 54),
(65, 106),
(66, 60),
(66, 84),
(67, 52),
(68, 140),
(69, 96),
(70, 69),
(70, 90),
(70, 146),
(71, 59),
(71, 61),
(71, 141),
(72, 99),
(72, 100),
(73, 106),
(74, 37),
(74, 75),
(74, 115),
(75, 23),
(75, 92),
(76, 49),
(76, 74),
(76, 148),
(77, 36),
(77, 97),
(77, 115),
(78, 19),
(79, 6),
(79, 24),
(80, 114),
(81, 21),
(81, 75),
(81, 151),
(82, 60),
(83, 49),
(83, 134),
(84, 90),
(85, 136),
(86, 36),
(86, 124),
(86, 151),
(87, 18),
(87, 96),
(88, 115),
(88, 137),
(89, 30),
(89, 48),
(89, 149),
(90, 40),
(90, 72),
(91, 130),
(91, 139),
(92, 90),
(92, 120),
(93, 61),
(93, 80),
(93, 137),
(94, 55),
(94, 96),
(94, 151),
(95, 56),
(95, 116),
(95, 140),
(96, 47),
(96, 145),
(96, 151),
(97, 27),
(98, 34),
(98, 65),
(98, 67),
(99, 24),
(99, 141),
(100, 148),
(101, 5),
(102, 140),
(103, 41),
(104, 34),
(104, 71),
(104, 77),
(105, 47),
(105, 85),
(106, 108),
(106, 117),
(107, 15),
(107, 19),
(108, 30),
(108, 75),
(108, 134),
(109, 30),
(109, 90),
(110, 5),
(110, 102),
(110, 120),
(111, 61),
(111, 128),
(112, 127),
(112, 146),
(113, 153),
(114, 137),
(115, 72),
(115, 78),
(115, 86),
(116, 41),
(116, 91),
(117, 42),
(117, 46),
(117, 93),
(118, 10),
(118, 17),
(118, 114),
(119, 28),
(119, 115),
(120, 115),
(120, 145),
(121, 73),
(121, 96),
(121, 120),
(122, 85),
(122, 86),
(122, 122),
(123, 81),
(123, 129),
(124, 13),
(124, 141),
(125, 61),
(125, 69),
(125, 142),
(126, 9),
(126, 99),
(127, 96),
(128, 99),
(129, 10),
(129, 152),
(130, 105),
(131, 23),
(131, 41),
(131, 67),
(132, 46),
(132, 74),
(132, 93),
(133, 36),
(133, 71),
(134, 44),
(134, 78),
(134, 127),
(135, 128),
(136, 102),
(136, 127),
(137, 9),
(137, 93),
(138, 47),
(138, 80),
(139, 65),
(139, 136),
(140, 102),
(140, 146),
(140, 153),
(141, 43),
(141, 93),
(142, 3),
(142, 71),
(143, 152),
(144, 3),
(145, 18),
(145, 61),
(145, 90),
(146, 142),
(147, 5),
(148, 17),
(148, 73),
(148, 114),
(149, 153),
(150, 43),
(150, 62),
(150, 123),
(151, 77),
(151, 136),
(151, 140),
(152, 114),
(153, 22),
(153, 69),
(154, 53),
(155, 93),
(155, 133),
(155, 152),
(156, 87),
(156, 108),
(156, 133),
(157, 87),
(157, 104),
(157, 123),
(158, 106),
(158, 127),
(159, 24),
(159, 77),
(159, 139),
(160, 100),
(161, 71),
(161, 85),
(162, 47),
(163, 3),
(163, 38),
(163, 105),
(164, 55),
(165, 28),
(165, 91),
(165, 142),
(166, 73),
(167, 80),
(168, 29),
(168, 71),
(168, 100),
(169, 128),
(170, 16),
(170, 27),
(171, 3),
(171, 19),
(171, 84),
(172, 19),
(173, 120),
(173, 124),
(174, 92),
(174, 135),
(175, 60),
(176, 34),
(177, 72),
(177, 153),
(178, 104),
(178, 139),
(179, 18),
(180, 28),
(181, 84),
(181, 140),
(181, 149),
(182, 59),
(182, 105),
(182, 131),
(183, 114),
(183, 122),
(184, 3),
(184, 112),
(184, 130),
(185, 67),
(186, 15),
(186, 59),
(186, 124),
(187, 117),
(188, 4),
(188, 17),
(188, 103),
(189, 34),
(189, 78),
(190, 127),
(191, 77),
(192, 7),
(192, 35),
(192, 40),
(193, 81),
(193, 104),
(193, 127),
(194, 50),
(194, 65),
(194, 114),
(195, 22),
(196, 24),
(196, 102),
(196, 108),
(197, 84),
(197, 141),
(198, 75),
(198, 142),
(199, 40),
(199, 142),
(199, 154),
(201, 167),
(202, 158),
(203, 168),
(201, 163),
(204, 159),
(205, 163),
(206, 170),
(207, 170),
(207, 171);

-- --------------------------------------------------------

--
-- Table structure for table `product_product_tag`
--

CREATE TABLE `product_product_tag` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL);

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
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`),
  ADD KEY `category_fk_1396947` (`category_id`);

--
-- Indexes for table `product_product_category`
--
ALTER TABLE `product_product_category`
  ADD KEY `product_id_fk_1396941` (`product_id`),
  ADD KEY `product_category_id_fk_1396941` (`product_category_id`);

--
-- Indexes for table `product_product_tag`
--
ALTER TABLE `product_product_tag`
  ADD KEY `product_id_fk_1396942` (`product_id`),
  ADD KEY `product_tag_id_fk_1396942` (`product_tag_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `product_product_category`
--
ALTER TABLE `product_product_category`
  ADD CONSTRAINT `product_category_id_fk_1396941` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_id_fk_1396941` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_product_tag`
--
ALTER TABLE `product_product_tag`
  ADD CONSTRAINT `product_id_fk_1396942` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_id_fk_1396942` FOREIGN KEY (`product_tag_id`) REFERENCES `product_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_1396920` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_1396920` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
