-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2021 a las 17:47:48
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trovimo_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `additional_services`
--

CREATE TABLE `additional_services` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `additional_services`
--

INSERT INTO `additional_services` (`id`, `product_id`, `service`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'directv', 15, '2020-11-13 14:04:44', '2020-11-13 14:04:44'),
(2, 1, 'name', 200, '2020-12-16 13:43:51', '2020-12-16 13:43:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `building_details`
--

CREATE TABLE `building_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `building_details`
--

INSERT INTO `building_details` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'prueba1\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'prueba2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `option_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'House', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Apartament', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Office', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Land', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Commercial space', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'Parking', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Warehouse', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Chalet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Medical space', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 'Tiny House', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 'Other', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coworking_place_details`
--

CREATE TABLE `coworking_place_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coworking_place_details`
--

INSERT INTO `coworking_place_details` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'prueba 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expert_profiles`
--

CREATE TABLE `expert_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `areas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `picture_profile` varchar(255) DEFAULT NULL,
  `cover_picture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cover_picture`)),
  `about_us` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `emails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`emails`)),
  `phones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`phones`)),
  `address` text DEFAULT NULL,
  `networks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`networks`)),
  `24/7` tinyint(1) DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `expert_profiles`
--

INSERT INTO `expert_profiles` (`id`, `user_id`, `company_name`, `company_id`, `areas`, `picture_profile`, `cover_picture`, `about_us`, `url`, `emails`, `phones`, `address`, `networks`, `24/7`, `verified`, `created_at`, `updated_at`) VALUES
(1, 1, 'prueba', NULL, '{otro}', NULL, NULL, NULL, NULL, NULL, NULL, '{venezuela-juangriego}', NULL, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expert_services`
--

CREATE TABLE `expert_services` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`services`)),
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shared_space_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `product_id`, `shared_space_id`, `project_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_details`
--

CREATE TABLE `home_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `home_details`
--

INSERT INTO `home_details` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'prueba1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mails`
--

INSERT INTO `mails` (`id`, `user_id`, `product_id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'prueba', 'fjms93@gmail.com', '12365895', 'hola mundo', '2021-01-04 14:47:52', '2021-01-04 14:47:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
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

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('3127d94dbf5e6d7f26e9a24d7d68c84a842d0751a266de672061ada19e06e6f57f15de9b8a0c130c', 4, 1, 'Personal Access Token', '[]', 0, '2020-12-16 17:38:29', '2020-12-16 17:38:29', '2021-12-16 13:38:29'),
('52713fde583eee7f9967d283f4ea53d117a66330c2b9b2cefdc853610527eb9fafd826fa930b3009', 1, 1, 'Personal Access Token', '[]', 0, '2020-12-03 08:43:25', '2020-12-03 08:43:25', '2021-12-03 03:43:25'),
('626dc6b524a21c32e21a8790d2042709d383d7d5bcb78b4795cbc322fe10fb29e5048b0e5fd4cc3a', 1, 1, 'Personal Access Token', '[]', 0, '2020-11-13 17:47:32', '2020-11-13 17:47:32', '2021-11-13 13:47:32'),
('6a641f305fc70721e602ec580163ba70ea3a2f77a5c84192ff654cac20838551c9a200d03b05d2f1', 1, 1, 'Personal Access Token', '[]', 0, '2020-11-20 08:36:12', '2020-11-20 08:36:12', '2021-11-20 03:36:12'),
('6c7741a1223786b8dfc04da83212bd860763717c3e504c5307a31c52e08d94388be896bf592b9628', 1, 1, 'Personal Access Token', '[]', 0, '2020-11-05 04:40:14', '2020-11-05 04:40:14', '2021-11-05 00:40:14'),
('77a180501f54ca103131a1a0ca4c0fae266ea2ee6a55a2bb7a8c5a5dbe6858f9806f5d4e80967a66', 2, 1, 'Personal Access Token', '[]', 0, '2020-11-05 18:14:17', '2020-11-05 18:14:17', '2021-11-05 14:14:17'),
('788b82cdc74441041e4ed673fce719d8834d6fcfca57b8dd966d21d5fa3d5b4206ec8bfe94f15c12', 1, 1, 'Personal Access Token', '[]', 1, '2020-11-17 03:56:30', '2020-11-17 03:56:30', '2021-11-16 22:56:30'),
('7bb193bf70db91a5d19c8852dd02531ce138d3fa07a8bfef625000d6ca62814ff61ce1a8fa695e64', 1, 1, 'Personal Access Token', '[]', 0, '2020-11-09 17:13:22', '2020-11-09 17:13:22', '2021-11-09 13:13:22'),
('847a07cbed3bceee6d49b57c3d142e74f5d740dc66d3c6fae672ae8597339257e9825412a8cdab9e', 1, 1, 'Personal Access Token', '[]', 0, '2020-11-05 18:07:19', '2020-11-05 18:07:19', '2021-11-05 14:07:19'),
('9d55a2585eb7fe3642700a710b633ca956c4b60708782dc34d9a274846139074bc8d5260d6237ca1', 1, 1, 'Personal Access Token', '[]', 0, '2020-11-14 06:03:32', '2020-11-14 06:03:32', '2021-11-14 01:03:32'),
('a798c7a5c9e89119446a376646526109107885e2f7d72abcd4709516046def3c8c41e970059f5fd3', 3, 1, 'Personal Access Token', '[]', 0, '2020-12-11 01:41:25', '2020-12-11 01:41:25', '2021-12-10 21:41:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
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
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'FVNtNRnQFJ37oZ35OnHP43n1ZVViGLWJYKsZdL0u', NULL, 'http://localhost', 1, 0, 0, '2020-11-05 02:52:40', '2020-11-05 02:52:40'),
(2, NULL, 'Laravel Password Grant Client', 'IaH2NyBqsiYxELxYrL4GL2LjpAryyOKquCBIENk6', 'users', 'http://localhost', 0, 1, 0, '2020-11-05 02:52:40', '2020-11-05 02:52:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-11-05 02:52:40', '2020-11-05 02:52:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sale', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'rent', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Shared spaces', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'New projects', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `show_price` tinyint(1) NOT NULL DEFAULT 1,
  `rooms` int(11) NOT NULL,
  `bath` int(11) NOT NULL,
  `parking_spots` int(11) NOT NULL,
  `n_pieces` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `year_built` int(11) DEFAULT NULL,
  `year_remodeled` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `tour` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `condition` int(11) DEFAULT NULL COMMENT '0:nueva, 1:usada',
  `furnished` int(11) DEFAULT NULL COMMENT '0:no, 1:parcialmente, 2:full',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `user_id`, `option_id`, `category_id`, `price`, `show_price`, `rooms`, `bath`, `parking_spots`, `n_pieces`, `area`, `year_built`, `year_remodeled`, `description`, `country`, `city`, `postal_code`, `lat`, `lon`, `tour`, `name`, `email`, `phone`, `condition`, `furnished`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 50, 1, 2, 1, 2, 3, 2, NULL, NULL, 'Esto es un nuevo inmueble', 'Venezuela', 'Porlamar', '6301', 10.2545871012, -6.25426841587, 'Prueba', 'Freddy', 'fjms93@gmail.com', '04120924871', 1, 1, '2020-11-13 13:55:43', '2020-12-16 13:43:51'),
(2, 4, 1, 1, 50, 1, 2, 1, 2, 3, 2, 1, 1, 'Esto es un nuevo inmueble', 'Venezuela', 'Porlamar', '6301', 10.2545871012, -6.25426841587, 'Prueba', 'Freddy', 'fjms93@gmail.com', '04120924871', NULL, NULL, '2020-12-16 13:40:29', '2020-12-16 13:40:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_building_details`
--

CREATE TABLE `product_building_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `building_detail_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_building_details`
--

INSERT INTO `product_building_details` (`id`, `product_id`, `building_detail_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-16 13:43:51', '2020-12-16 13:43:51'),
(2, 1, 2, '2020-12-16 13:43:51', '2020-12-16 13:43:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_home_details`
--

CREATE TABLE `product_home_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `home_detail_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_home_details`
--

INSERT INTO `product_home_details` (`id`, `product_id`, `home_detail_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-16 13:41:15', '2020-12-16 13:41:15'),
(2, 1, 2, '2020-12-16 13:41:15', '2020-12-16 13:41:15'),
(3, 1, 1, '2020-12-16 13:43:51', '2020-12-16 13:43:51'),
(4, 1, 2, '2020-12-16 13:43:51', '2020-12-16 13:43:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shared_space_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `shared_space_id`, `project_id`, `url`, `created_at`, `updated_at`) VALUES
(7, 1, 0, NULL, 'image_11605277522.jpg', '2020-11-13 14:25:22', '2020-11-13 14:25:22'),
(8, 1, NULL, NULL, 'image_11608126056.jpg', '2020-12-16 13:40:56', '2020-12-16 13:40:56'),
(9, NULL, 1, NULL, 'image_11608126492.jpg', '2020-12-16 13:48:12', '2020-12-16 13:48:12'),
(10, NULL, NULL, 3, 'image_31608127057.jpg', '2020-12-16 13:57:37', '2020-12-16 13:57:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_videos`
--

CREATE TABLE `product_videos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `shared_space_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_videos`
--

INSERT INTO `product_videos` (`id`, `product_id`, `shared_space_id`, `project_id`, `type`, `url`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, NULL, 1, 'video_11605277699.png', '2020-11-13 14:28:19', '2020-11-13 14:28:19'),
(5, NULL, 1, NULL, 2, 'https://www.youtube.com/watch?v=OHUktPPdTaM&list=RDOHUktPPdTaM&start_radio=1', '2020-12-16 13:49:28', '2020-12-16 13:49:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `show_price` tinyint(1) NOT NULL DEFAULT 1,
  `rooms` int(11) NOT NULL,
  `bath` int(11) NOT NULL,
  `parking_spots` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `description` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `tour` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `category_id`, `price`, `show_price`, `rooms`, `bath`, `parking_spots`, `area`, `description`, `country`, `city`, `postal_code`, `lat`, `lon`, `tour`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 50, 1, 2, 1, 2, 2, 'Esto es un nuevo inmueble', 'Venezuela', 'Porlamar', '6301', 10.2545871012, -6.25426841587, 'Prueba', 'Freddy', 'fjms93@gmail.com', '04120924871', '2020-11-26 18:13:41', '2020-11-26 18:13:41'),
(3, 4, 1, 50, 1, 2, 1, 2, 2, 'Esto es un nuevo inmueble', 'Venezuela', 'Porlamar', '6301', 10.2545871012, -6.25426841587, 'Prueba', 'Freddy', 'fjms93@gmail.com', '04120924871', '2020-12-16 13:55:23', '2020-12-16 13:55:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_details`
--

CREATE TABLE `project_details` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_details_name_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `project_details`
--

INSERT INTO `project_details` (`id`, `project_id`, `project_details_name_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2020-12-16 13:59:20', '2020-12-16 13:59:20'),
(2, 3, 15, '2020-12-16 13:59:20', '2020-12-16 13:59:20'),
(3, 3, 2, '2020-12-16 13:59:20', '2020-12-16 13:59:20'),
(4, 3, 1, '2020-12-16 14:00:05', '2020-12-16 14:00:05'),
(5, 3, 15, '2020-12-16 14:00:05', '2020-12-16 14:00:05'),
(6, 3, 2, '2020-12-16 14:00:05', '2020-12-16 14:00:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_details_names`
--

CREATE TABLE `project_details_names` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `project_details_names`
--

INSERT INTO `project_details_names` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'prueba1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'prueba2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'prueba3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_professional_group`
--

CREATE TABLE `project_professional_group` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `project_professional_group`
--

INSERT INTO `project_professional_group` (`id`, `project_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'prueba', '2020-11-26 18:40:44', '2020-11-26 18:40:44'),
(2, 3, 'prueba', '2020-12-16 14:01:25', '2020-12-16 14:01:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `especifications` text NOT NULL,
  `price` double NOT NULL,
  `rooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `properties`
--

INSERT INTO `properties` (`id`, `project_id`, `area`, `especifications`, `price`, `rooms`, `bathrooms`, `created_at`, `updated_at`) VALUES
(1, 2, 20, '20*20', 200, 2, 2, '2020-11-26 18:22:32', '2020-11-26 18:22:32'),
(2, 3, 20, '20*20', 200, 2, 2, '2020-12-16 13:56:11', '2020-12-16 13:56:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recommendations`
--

INSERT INTO `recommendations` (`id`, `user_id`, `recommendation`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mejorar la forma de mostrar contenido', '2020-11-05 20:05:08', '2020-11-05 20:05:08'),
(2, 1, 'Mejorar la forma de mostrar contenido', '2020-11-09 13:41:56', '2020-11-09 13:41:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reference_points`
--

CREATE TABLE `reference_points` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `point` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reference_points`
--

INSERT INTO `reference_points` (`id`, `product_id`, `project_id`, `point`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Villa El Griego', 'Villa El Griego', '2020-11-13 14:06:15', '2020-11-13 14:06:15'),
(2, 1, NULL, 'point', 'name', '2020-12-16 13:43:51', '2020-12-16 13:43:51'),
(3, NULL, 2, 'name', 'point', '2020-12-16 14:00:05', '2020-12-16 14:00:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_office_place_equipment`
--

CREATE TABLE `shared_office_place_equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_office_place_equipment`
--

INSERT INTO `shared_office_place_equipment` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'prueba 2\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'prueba 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_office_preferences`
--

CREATE TABLE `shared_office_preferences` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_office_preferences`
--

INSERT INTO `shared_office_preferences` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'prueba1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'prueba 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_spaces`
--

CREATE TABLE `shared_spaces` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `show_price` tinyint(1) NOT NULL DEFAULT 1,
  `bathroom` int(11) NOT NULL,
  `furnished` int(11) DEFAULT NULL,
  `pets` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pets`)),
  `avaliable_date` date DEFAULT NULL,
  `description` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `tour` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_spaces`
--

INSERT INTO `shared_spaces` (`id`, `user_id`, `category_id`, `price`, `show_price`, `bathroom`, `furnished`, `pets`, `avaliable_date`, `description`, `country`, `city`, `postal_code`, `lat`, `lon`, `tour`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 50, 1, 1, NULL, NULL, NULL, 'Esto es un nuevo inmueble', 'Venezuela', 'Porlamar', '6301', 10.2545871012, -6.25426841587, 'Prueba', 'Freddy', 'fjms93@gmail.com', '04120924871', '2020-12-16 13:47:12', '2020-12-16 13:47:12'),
(2, 4, 1, 50, 1, 1, NULL, NULL, NULL, 'Esto es un nuevo inmueble', 'Venezuela', 'Porlamar', '6301', 10.2545871012, -6.25426841587, 'Prueba', 'Freddy', 'fjms93@gmail.com', '04120924871', '2020-12-16 13:47:38', '2020-12-16 13:47:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_spaces_place_details`
--

CREATE TABLE `shared_spaces_place_details` (
  `id` int(11) NOT NULL,
  `shared_space_id` int(11) NOT NULL,
  `coworking_place_details_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_spaces_place_details`
--

INSERT INTO `shared_spaces_place_details` (`id`, `shared_space_id`, `coworking_place_details_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-16 13:54:21', '2020-12-16 13:54:21'),
(2, 1, 2, '2020-12-16 13:54:21', '2020-12-16 13:54:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_spaces_place_equipment`
--

CREATE TABLE `shared_spaces_place_equipment` (
  `id` int(11) NOT NULL,
  `shared_space_id` int(11) NOT NULL,
  `shared_office_place_equipment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_spaces_place_equipment`
--

INSERT INTO `shared_spaces_place_equipment` (`id`, `shared_space_id`, `shared_office_place_equipment_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-16 13:51:36', '2020-12-16 13:51:36'),
(2, 1, 2, '2020-12-16 13:51:36', '2020-12-16 13:51:36'),
(3, 1, 1, '2020-12-16 13:52:49', '2020-12-16 13:52:49'),
(4, 1, 2, '2020-12-16 13:52:49', '2020-12-16 13:52:49'),
(5, 1, 1, '2020-12-16 13:54:21', '2020-12-16 13:54:21'),
(6, 1, 2, '2020-12-16 13:54:21', '2020-12-16 13:54:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_spaces_preferences`
--

CREATE TABLE `shared_spaces_preferences` (
  `id` int(11) NOT NULL,
  `shared_space_id` int(11) NOT NULL,
  `shared_office_preference_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_spaces_preferences`
--

INSERT INTO `shared_spaces_preferences` (`id`, `shared_space_id`, `shared_office_preference_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-16 13:52:49', '2020-12-16 13:52:49'),
(2, 1, 2, '2020-12-16 13:52:49', '2020-12-16 13:52:49'),
(3, 1, 1, '2020-12-16 13:54:21', '2020-12-16 13:54:21'),
(4, 1, 2, '2020-12-16 13:54:21', '2020-12-16 13:54:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shared_space_plans`
--

CREATE TABLE `shared_space_plans` (
  `id` int(11) NOT NULL,
  `shared_space_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `shared_space_plans`
--

INSERT INTO `shared_space_plans` (`id`, `shared_space_id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'name', 2000, 'description', '2020-12-16 13:47:39', '2020-12-16 13:47:39'),
(2, 2, 'name2', 1000, 'description2', '2020-12-16 13:47:39', '2020-12-16 13:47:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `today_coins`
--

CREATE TABLE `today_coins` (
  `id` int(11) NOT NULL,
  `usd` double NOT NULL,
  `chf` double NOT NULL,
  `eur` double NOT NULL,
  `cop` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `today_coins`
--

INSERT INTO `today_coins` (`id`, `usd`, `chf`, `eur`, `cop`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, 5, '0000-00-00 00:00:00', '2020-11-09 13:16:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_name` tinyint(1) NOT NULL DEFAULT 1,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '1: persona, 2: empresa, 3:experto',
  `phone` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`phone`)),
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_type` int(11) NOT NULL COMMENT '0:normal, 1:google, 2:facebook',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `show_name`, `username`, `email`, `email_verified_at`, `password`, `role`, `phone`, `country`, `city`, `address`, `postal_code`, `linkedin`, `facebook`, `youtube`, `twitter`, `instagram`, `remember_token`, `id_company`, `register_type`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 'admin@gmail.com', NULL, '$2y$10$.ZSBtR/ZBbM/KN9hyMEU.ucZRj.Zk42DLlGYQXxiTCGM6N/awBbb6', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-11-05 04:40:14', '2020-11-05 04:40:14'),
(2, NULL, 1, NULL, 'freddy@gmail.com', NULL, '$2y$10$E6PbupzXetfZf0D.ndGv4.zATmz3MU4mDpkUeVCe7Qj3rJo/xuX/e', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '2020-11-05 18:14:16', '2020-11-05 18:14:16'),
(3, 'prueba', 0, 'pruebausername', 'fjms93@gmail.com', NULL, '$2y$10$EmQ7Fu6aicBxfoy7sxdhW.Lowo8mrnj8e/j36MrM897NhmNvyR4lG', 1, '[\"04169951608\",\"2532695\"]', 'venezuela', 'juan griego', '[\"venezuela\\/caracas\\/avenida15\",\"colombia\\/cali\\/avenida15\"]', '0256', 'linkedin', 'facebook', 'youtube', 'twitter', 'instagram', NULL, '1234567878', 1, '2020-12-11 01:41:24', '2020-12-11 02:09:19'),
(4, NULL, 1, NULL, 'admin1@gmail.com', NULL, '$2y$10$3dji9ZWDQOHPqe4NrMOun.pS5E4YFBuBxtZ9/ifAOpGvCmJJ5O7OK', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-12-16 17:38:27', '2020-12-16 17:38:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `additional_services`
--
ALTER TABLE `additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `building_details`
--
ALTER TABLE `building_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coworking_place_details`
--
ALTER TABLE `coworking_place_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expert_profiles`
--
ALTER TABLE `expert_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expert_services`
--
ALTER TABLE `expert_services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `home_details`
--
ALTER TABLE `home_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_building_details`
--
ALTER TABLE `product_building_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_home_details`
--
ALTER TABLE `product_home_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_videos`
--
ALTER TABLE `product_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `project_details`
--
ALTER TABLE `project_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `project_details_names`
--
ALTER TABLE `project_details_names`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `project_professional_group`
--
ALTER TABLE `project_professional_group`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reference_points`
--
ALTER TABLE `reference_points`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_office_place_equipment`
--
ALTER TABLE `shared_office_place_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_office_preferences`
--
ALTER TABLE `shared_office_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_spaces`
--
ALTER TABLE `shared_spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_spaces_place_details`
--
ALTER TABLE `shared_spaces_place_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_spaces_place_equipment`
--
ALTER TABLE `shared_spaces_place_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_spaces_preferences`
--
ALTER TABLE `shared_spaces_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shared_space_plans`
--
ALTER TABLE `shared_space_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `today_coins`
--
ALTER TABLE `today_coins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `building_details`
--
ALTER TABLE `building_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `coworking_place_details`
--
ALTER TABLE `coworking_place_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expert_profiles`
--
ALTER TABLE `expert_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `expert_services`
--
ALTER TABLE `expert_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `home_details`
--
ALTER TABLE `home_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `product_building_details`
--
ALTER TABLE `product_building_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `product_home_details`
--
ALTER TABLE `product_home_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `product_videos`
--
ALTER TABLE `product_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `project_details`
--
ALTER TABLE `project_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `project_details_names`
--
ALTER TABLE `project_details_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `project_professional_group`
--
ALTER TABLE `project_professional_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reference_points`
--
ALTER TABLE `reference_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `shared_office_place_equipment`
--
ALTER TABLE `shared_office_place_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `shared_office_preferences`
--
ALTER TABLE `shared_office_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shared_spaces`
--
ALTER TABLE `shared_spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shared_spaces_place_details`
--
ALTER TABLE `shared_spaces_place_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shared_spaces_place_equipment`
--
ALTER TABLE `shared_spaces_place_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `shared_spaces_preferences`
--
ALTER TABLE `shared_spaces_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `shared_space_plans`
--
ALTER TABLE `shared_space_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `today_coins`
--
ALTER TABLE `today_coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
