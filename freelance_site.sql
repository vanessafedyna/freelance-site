-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 18 mars 2026 à 21:25
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `freelance_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('freelance-site-cache-vanessafedyna2002@gmail.com|127.0.0.1', 'i:2;', 1771617971),
('freelance-site-cache-vanessafedyna2002@gmail.com|127.0.0.1:timer', 'i:1771617971;', 1771617971);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Vanessa Fedyna julien', 'vanessafedyna2002@gmail.com', 'voici mon project', '2026-02-19 23:43:31', '2026-02-19 23:43:31');

-- --------------------------------------------------------

--
-- Structure de la table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `type_projet` varchar(80) NOT NULL,
  `budget_estime` varchar(80) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_19_180247_create_projects_table', 2),
(5, '2026_02_19_183721_create_contacts_table', 3),
(6, '2026_02_19_201738_add_is_admin_to_users_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `tech_stack` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tech_stack`)),
  `project_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `description`, `cover_image`, `tech_stack`, `project_url`, `created_at`, `updated_at`) VALUES
(1, 'Site Vitrine Restaurant', 'site-vitrine-restaurant', 'Site Laravel + JS pour un restaurant local', NULL, '[\"Laravel\",\"MySQL\",\"JS\"]', 'https://exemple.com', '2026-02-19 23:14:42', '2026-02-19 23:24:25');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5e4NDQK7JhUIPPGGzkAcfnvBbtXIE5xVsJbGW6UT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUxXZkpTODF5a3Z1U21FR1BWYklwcG0wbEh4VkpUekM0YXdOSFE0QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771530003),
('ApS6dL3nVWMNXeJ328Jd15d9ZgyDY31F0KHKUv8u', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXRDM05qRXF0Um5TZUJGZzJQQ0xaRTRyeUNOd3hzQUZYelA2endkVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9zZXJ2aWNlcyI7czo1OiJyb3V0ZSI7czo4OiJzZXJ2aWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771523718),
('BC35OymgPv6qmbmEzAaACy3dJBIDos0Ww7CpGfVN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibXBIdTY2UFlhcVFWVmR3N3M3TnkzZGY3RHJGOWFkTWJOY0lCeTdNdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDgwL2FkbWluL3Byb2plY3RzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9hZG1pbi9wcm9qZWN0cyI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ucHJvamVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1771529102),
('Ep4VV7JcLkk3AGYVABekv9BZNymRFBAoZa7vufFG', NULL, '127.0.0.1', 'curl/8.16.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFNOVndXbnJYMm5JWkdMcDdHenVrNDFXaDZTQVNPcTFVQlh3UVI0SSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDgwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771529119),
('iDsuIXvFBbwHVAGJpBvpU3eCZdYr6lP2hqIMK7FK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2hEdFR0SmQ5Y3RnRmRnTVFNY0Zmc1RUQXRURmdBVmxYMEhGODNvaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9wb3J0Zm9saW8iO3M6NToicm91dGUiO3M6OToicG9ydGZvbGlvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771523718),
('OY2xmNE4WnAfys8m2wdf7VdUsFYwL92QRX8Ou2xN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmNLaWM0UmVScU9hMUt6OUhQQUVQNDRlZHFpMFlOeW5XUzBMMUQyVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771530058),
('ozBisdJ87Hqq45ojjLbA9uKpVmkCE4hVApBAWIux', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2wyMGs2c0syd0NYZ2ZFckMwTGg3cUxpUDhSTVJEczV5ZkhVQzB5ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771523718),
('pHTzLAfNztoD1rpjHYEcJci5L8WEAUuwRsA2UV9h', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibWt3ak5oaXVhazkwclhPN0t6U0NyZU1XUWtTV2pUZ2lxeGxDZkJHbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjI6e2k6MDtzOjEwOiJfb2xkX2lucHV0IjtpOjE7czo2OiJlcnJvcnMiO31zOjM6Im5ldyI7YTowOnt9fXM6MTA6Il9vbGRfaW5wdXQiO2E6Mzp7czo1OiJlbWFpbCI7czoxNjoidGVzdEBleGFtcGxlLmNvbSI7czo4OiJyZW1lbWJlciI7czoyOiJvbiI7czo2OiJfdG9rZW4iO3M6NDA6Im1rd2pOaGl1YWs5MHJYTzdLelNDcmVNV1FrU1dqVGdpcXhsQ2ZCR2wiO31zOjY6ImVycm9ycyI7TzozMToiSWxsdW1pbmF0ZVxTdXBwb3J0XFZpZXdFcnJvckJhZyI6MTp7czo3OiIAKgBiYWdzIjthOjE6e3M6NzoiZGVmYXVsdCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XE1lc3NhZ2VCYWciOjI6e3M6MTE6IgAqAG1lc3NhZ2VzIjthOjE6e3M6NToiZW1haWwiO2E6MTp7aTowO3M6NDM6IlRoZXNlIGNyZWRlbnRpYWxzIGRvIG5vdCBtYXRjaCBvdXIgcmVjb3Jkcy4iO319czo5OiIAKgBmb3JtYXQiO3M6ODoiOm1lc3NhZ2UiO319fX0=', 1771530104),
('RBEFgCPqwby0OCz0U4fOo6bpC3Vn1qwRZfhBFD11', NULL, '127.0.0.1', 'curl/8.16.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRlo5R1BaV0RIQ2FYY2R2dGNVZUlGMk5OME00QkFnY1lqTzhKbEtKTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjI6e2k6MDtzOjEwOiJfb2xkX2lucHV0IjtpOjE7czo2OiJlcnJvcnMiO31zOjM6Im5ldyI7YTowOnt9fXM6MTA6Il9vbGRfaW5wdXQiO2E6Mjp7czo2OiJfdG9rZW4iO3M6NDA6IkZaOUdQWldESENhWGNkdnRjVWVJRjJOTjBNNEJBZ2NZak84SmxLSk8iO3M6NToiZW1haWwiO3M6MTY6InRlc3RAZXhhbXBsZS5jb20iO31zOjY6ImVycm9ycyI7TzozMToiSWxsdW1pbmF0ZVxTdXBwb3J0XFZpZXdFcnJvckJhZyI6MTp7czo3OiIAKgBiYWdzIjthOjE6e3M6NzoiZGVmYXVsdCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XE1lc3NhZ2VCYWciOjI6e3M6MTE6IgAqAG1lc3NhZ2VzIjthOjE6e3M6NToiZW1haWwiO2E6MTp7aTowO3M6NDM6IlRoZXNlIGNyZWRlbnRpYWxzIGRvIG5vdCBtYXRjaCBvdXIgcmVjb3Jkcy4iO319czo5OiIAKgBmb3JtYXQiO3M6ODoiOm1lc3NhZ2UiO319fX0=', 1771530205),
('sMovo6hvkMCTRBR4D4oQ2Xe0qW2vkOJDALPHWqmb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSlI1bGJyUzNVcFpZR3NOS3BCZmZsQ1UwVVpWMUtVWEI0VklneVZmYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDgwL2FkbWluL3Byb2plY3RzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1771529433),
('tg93qDsQgyzbQAJKkBzTjeseI7G9WAhsrEpaujte', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjliWjhpRTN0VnZyR3BvTEFodUo3WjlQNWFOVTlwSG9SV0RDRDhQViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9jb250YWN0IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1771523718),
('Uw0fQJYqJ4eyoDtjZoRvEGHZlkL8Z51RLSwzJWJ1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTd0M1BYN1JFekNCQk9sWmJpOUJIc0lwWEJ0RHBTeHpvMGJWNTl1WiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771530104),
('xqbcZFLNgHDbqIggm9AKexj4gFDGnO1s8uKShhaA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; fr-CA) WindowsPowerShell/5.1.26100.7705', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTF4ZUkza0FWVnlKQUxCTU9OajFOWWpmbnRBcFM3cVJXbzlDeDVibCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771530188);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Julien Fedyna Vanessa', 'vanessafedyna2002@gmail.com', NULL, '$2y$12$..JmVcMxKNmg/BycnHQ39elvMeNTGZI2PVeBOyXAQmB3Ee82kEy6C', 1, NULL, '2026-02-20 00:30:07', '2026-02-20 01:25:07'),
(2, 'Admin Test', 'admin@freelance-site.test', NULL, '$2y$12$kU5cWIlzbl/brssnAuE4lOCImNr5PILmHaUeSFqxU8aM7M2Y5kyYq', 1, NULL, '2026-02-20 00:51:53', '2026-02-20 01:23:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
