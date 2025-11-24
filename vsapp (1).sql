-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 07:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tournament_id` bigint(20) UNSIGNED DEFAULT NULL,
  `round` int(10) UNSIGNED DEFAULT NULL,
  `team1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `team2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `winner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score_team1` int(11) NOT NULL DEFAULT 0,
  `score_team2` int(11) NOT NULL DEFAULT 0,
  `played_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `player1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `player2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `winner_player_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `tournament_id`, `round`, `team1_id`, `team2_id`, `winner_id`, `score_team1`, `score_team2`, `played_at`, `created_at`, `updated_at`, `player1_id`, `player2_id`, `winner_player_id`) VALUES
(1, 1, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-20 03:55:52', '2025-11-20 03:56:13', 2, 5, 2),
(2, 1, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-20 03:55:52', '2025-11-20 03:56:19', 4, 3, 3),
(3, 1, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-11-20 03:56:19', '2025-11-20 03:56:27', 2, 3, 3),
(4, 2, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-21 21:35:56', '2025-11-21 21:40:14', 2, 5, 5),
(5, 2, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-21 21:35:56', '2025-11-21 21:40:19', 3, 4, 4),
(6, 2, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-11-21 21:40:19', '2025-11-21 21:40:25', 5, 4, 5),
(7, 7, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-22 01:20:16', '2025-11-22 01:20:54', 2, 5, 5),
(8, 7, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-22 01:20:16', '2025-11-22 01:20:59', 4, 3, 3),
(9, 7, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-11-22 01:20:59', '2025-11-22 01:21:06', 5, 3, 3),
(10, 14, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-11-23 06:34:12', '2025-11-23 06:34:30', 3, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `game_participations`
--

CREATE TABLE `game_participations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `result` enum('win','loss') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_participations`
--

INSERT INTO `game_participations` (`id`, `game_id`, `team_id`, `user_id`, `role`, `result`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 2, 'player', 'win', '2025-11-20 03:55:52', '2025-11-20 03:55:52'),
(2, 1, NULL, 5, 'player', 'win', '2025-11-20 03:55:52', '2025-11-20 03:55:52'),
(3, 2, NULL, 4, 'player', 'win', '2025-11-20 03:55:52', '2025-11-20 03:55:52'),
(4, 2, NULL, 3, 'player', 'win', '2025-11-20 03:55:52', '2025-11-20 03:55:52'),
(5, 3, NULL, 2, 'player', 'win', NULL, NULL),
(6, 3, NULL, 3, 'player', 'win', NULL, NULL),
(7, 4, NULL, 2, 'player', 'win', '2025-11-21 21:35:56', '2025-11-21 21:35:56'),
(8, 4, NULL, 5, 'player', 'win', '2025-11-21 21:35:56', '2025-11-21 21:35:56'),
(9, 5, NULL, 3, 'player', 'win', '2025-11-21 21:35:56', '2025-11-21 21:35:56'),
(10, 5, NULL, 4, 'player', 'win', '2025-11-21 21:35:56', '2025-11-21 21:35:56'),
(11, 6, NULL, 5, 'player', 'win', NULL, NULL),
(12, 6, NULL, 4, 'player', 'win', NULL, NULL),
(13, 7, NULL, 2, 'player', 'win', '2025-11-22 01:20:16', '2025-11-22 01:20:16'),
(14, 7, NULL, 5, 'player', 'win', '2025-11-22 01:20:16', '2025-11-22 01:20:16'),
(15, 8, NULL, 4, 'player', 'win', '2025-11-22 01:20:16', '2025-11-22 01:20:16'),
(16, 8, NULL, 3, 'player', 'win', '2025-11-22 01:20:16', '2025-11-22 01:20:16'),
(17, 9, NULL, 5, 'player', 'win', NULL, NULL),
(18, 9, NULL, 3, 'player', 'win', NULL, NULL),
(19, 10, NULL, 3, 'player', 'win', '2025-11-23 06:34:12', '2025-11-23 06:34:12'),
(20, 10, NULL, 5, 'player', 'win', '2025-11-23 06:34:12', '2025-11-23 06:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_11_174305_create_sessions_table', 1),
(7, '2025_09_21_183508_create_regions_table', 1),
(8, '2025_09_22_160636_create_player_profiles_table', 1),
(9, '2025_09_22_183002_create_teams_table', 1),
(10, '2025_09_22_192000_add_unique_user_to_player_profiles', 1),
(11, '2025_09_22_195425_add_riot_fields_to_player_profiles', 1),
(12, '2025_09_23_050118_tune_player_profiles_indexes', 1),
(13, '2025_09_23_211703_create_games_table', 1),
(14, '2025_09_24_034408_create_game_participations_table', 1),
(15, '2025_09_24_035554_add_role_to_users_table', 1),
(16, '2025_09_24_110042_create_team_invitations_table', 1),
(17, '2025_09_24_120024_add_type_and_message_to_team_invitations_table', 1),
(18, '2025_10_15_010834_create_wallets_table', 1),
(19, '2025_10_15_013208_add_user_id_to_wallets_table', 1),
(20, '2025_10_15_013616_add_balance_and_user_id_to_wallets_table', 1),
(21, '2025_10_16_204459_create_tournaments_table', 1),
(22, '2025_10_16_210656_create_tournament_registrations_table', 1),
(23, '2025_10_16_215831_add_type_to_tournaments_table', 1),
(24, '2025_10_16_225019_add_tournament_id_to_games_table', 1),
(25, '2025_10_16_230401_add_players_to_games_table', 1),
(26, '2025_10_17_214255_add_round_to_games_table', 1),
(27, '2025_10_18_003225_update_tournaments_table_add_scheduled_at', 1),
(28, '2025_11_19_190337_create_wallet_transactions_table', 1),
(29, '2025_11_21_184125_add_entry_fee_to_tournaments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_profiles`
--

CREATE TABLE `player_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `summoner_name` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `riot_game_name` varchar(255) DEFAULT NULL,
  `riot_tag_line` varchar(255) DEFAULT NULL,
  `puuid` varchar(255) DEFAULT NULL,
  `summoner_id` varchar(255) DEFAULT NULL,
  `profile_icon_id` int(10) UNSIGNED DEFAULT NULL,
  `summoner_level` int(10) UNSIGNED DEFAULT NULL,
  `rank_queue` varchar(255) DEFAULT NULL,
  `rank_tier` varchar(255) DEFAULT NULL,
  `rank_division` varchar(255) DEFAULT NULL,
  `rank_lp` int(11) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `player_profiles`
--

INSERT INTO `player_profiles` (`id`, `user_id`, `summoner_name`, `rank`, `country`, `phone`, `created_at`, `updated_at`, `riot_game_name`, `riot_tag_line`, `puuid`, `summoner_id`, `profile_icon_id`, `summoner_level`, `rank_queue`, `rank_tier`, `rank_division`, `rank_lp`, `platform`, `region`) VALUES
(1, 6, 'Tryndamere#VDC', 'EMERALD IV', 'Canada', '2142510070', '2025-11-20 00:37:15', '2025-11-20 00:37:15', 'Tryndamere', 'VDC', 'MRINxcxoh-hTuvYkiiSaiDTygwp7wqiUdbMxaRjR1ZjZM2h7iLOfZuDAzzXR4u3YkIY0UbQmqlpxoQ', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'EMERALD', 'IV', 66, 'la1', 'americas'),
(2, 2, 'SanYeii#LAN', 'SILVER II', 'Venezuela', '+584241393840', '2025-11-20 00:43:14', '2025-11-20 00:43:14', 'SanYeii', 'LAN', 'wV1eM_SJLPZGE89yHhfQ2wxw01Zwza46JSm8e48dUJhyYK2eXDIlJcwdd_WUO9llwawYXRKjgpaUWg', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'SILVER', 'II', 1, 'la1', 'americas'),
(3, 4, 'Zerocheck#LAN', 'PLATINUM III', 'Venezuela', '+584125387557', '2025-11-20 00:46:17', '2025-11-20 00:46:17', 'Zerocheck', 'LAN', '5CcmBxxfmRNIfVuh6QXVvgK-vBlbT-81RZe8SXedjr00owtKKBzkQ17m2O0cOTc8LJG277GKb1MnEA', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'PLATINUM', 'III', 51, 'la1', 'americas'),
(4, 3, 'YueYsaya#LAN', 'GOLD IV', 'Argentina', '+5491123899524', '2025-11-20 00:48:10', '2025-11-20 00:48:10', 'YueYsaya', 'LAN', 'qWonyxIqRHOilkH_V1bLqHI9yGb9pRhLqSe1qyKfvl7fI7EmOZ496ycRz66B6p7LxBiHxP8Rt7zRFQ', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'GOLD', 'IV', 36, 'la1', 'americas'),
(5, 5, 'Nartsuki#LAN', 'EMERALD I', 'Estados Unidos', '+12544361956', '2025-11-21 21:06:59', '2025-11-21 21:06:59', 'Nartsuki', 'LAN', '90t8VV35wP-dFaNRiZFVIOVtV5yxGAAZ4Dlb0yR1y1OH5kw96nmguLJUq1wGOpfePcCRfMEy1oqH6g', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'EMERALD', 'I', 99, 'la1', 'americas');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pSMoiOXyjsQDmFNHQZ5EbZ66TOzmilWPzoE1Hkyq', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMHlFVjZpbEpveTB4ekt0TklGdzJBeHB3YWVGMm5YRHdRMlFVS0NmbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvdnNhcHAvcHVibGljL3RvdXJuYW1lbnRzLzE0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRlLkJ5V3E1UzVVL3pRc0wxTmlGSmguWkFJYjNXVWxJUUFpUkxhMVFFSkVYZjA4ZVJpaTNtLiI7fQ==', 1763879671);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `g_win` int(11) NOT NULL DEFAULT 0,
  `g_lost` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `type` varchar(255) NOT NULL DEFAULT 'invite',
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'jugador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Carlos Martinez', 'carlos@gmail.com', NULL, '$2y$12$e.ByWq5S5U/zQsL1NiFJh.ZAIb3WUlIQAiRLa1QEJEXf08eRii3m.', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 00:21:19', '2025-11-20 00:21:19', 'admin'),
(2, 'Yei', 'yei@gmail.com', NULL, '$2y$12$N935rTYFL7.4r5V67DOwe.RThVJ5k13GIAyvP2NbmGA5f1ys2XM9m', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 00:24:08', '2025-11-20 00:24:08', 'jugador'),
(3, 'Luis Ysaya', 'luisd@gmail.com', NULL, '$2y$12$jkIGmJkM4rBelDC6whM6HelQf/jDI1p0QdMgQELpF8kc7IE14/JXO', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 00:24:41', '2025-11-20 00:24:41', 'jugador'),
(4, 'Jesus Goldo', 'jesus@gmail.com', NULL, '$2y$12$wwU7ENXLAnzjUwvIQgw4zOdB3cBMMi6ijzmh2kJILshIFL63.r3jy', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 00:32:10', '2025-11-20 00:32:10', 'jugador'),
(5, 'Leonardo Rojas', 'leo@gmail.com', NULL, '$2y$12$EombSrJ1kqv8mg8EDjMqj.z2/1yWAiB5yTDESLH.7xOLSty1q1omy', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 00:32:46', '2025-11-20 00:32:46', 'jugador'),
(6, 'CIndy Rojas', 'cindy@gmail.com', NULL, '$2y$12$0p1FInakVZfES0Rz6qQapuce4JLjOBSIxLrfLPCEtYP6LgL1QLVT2', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 00:33:39', '2025-11-20 00:33:39', 'jugador');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `created_at`, `updated_at`, `balance`) VALUES
(1, 1, '2025-11-20 00:21:19', '2025-11-20 00:21:19', 0.00),
(2, 2, '2025-11-20 00:24:09', '2025-11-23 06:13:03', 1.00),
(3, 3, '2025-11-20 00:24:41', '2025-11-23 06:21:00', 0.00),
(4, 4, '2025-11-20 00:32:11', '2025-11-23 06:19:29', 0.00),
(5, 5, '2025-11-20 00:32:46', '2025-11-23 06:21:25', 0.00),
(6, 6, '2025-11-20 00:33:39', '2025-11-20 00:33:39', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `type`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'mint', 1.00, 'Mint by admin', '2025-11-22 02:28:28', '2025-11-22 02:28:28'),
(2, 5, 'mint', 1.00, 'Mint by admin', '2025-11-22 02:31:44', '2025-11-22 02:31:44'),
(3, 2, 'mint', 4.00, 'Mint by admin', '2025-11-23 05:46:38', '2025-11-23 05:46:38'),
(4, 2, 'debit', 5.00, 'Registro en torneo: 2do Prueba de Domicoins', '2025-11-23 06:09:10', '2025-11-23 06:09:10'),
(5, 5, 'mint', 4.00, 'Mint by admin', '2025-11-23 06:10:27', '2025-11-23 06:10:27'),
(6, 5, 'debit', 5.00, 'Registro en torneo: 2do Prueba de Domicoins', '2025-11-23 06:11:05', '2025-11-23 06:11:05'),
(7, 4, 'mint', 1.00, 'Mint by admin', '2025-11-23 06:12:46', '2025-11-23 06:12:46'),
(8, 3, 'mint', 1.00, 'Mint by admin', '2025-11-23 06:12:51', '2025-11-23 06:12:51'),
(9, 5, 'mint', 1.00, 'Mint by admin', '2025-11-23 06:12:58', '2025-11-23 06:12:58'),
(10, 2, 'mint', 1.00, 'Mint by admin', '2025-11-23 06:13:03', '2025-11-23 06:13:03'),
(11, 4, 'debit', 1.00, 'Registro en torneo: 1er de Hoy', '2025-11-23 06:19:29', '2025-11-23 06:19:29'),
(12, 3, 'debit', 1.00, 'Registro en torneo: 1er de Hoy', '2025-11-23 06:21:00', '2025-11-23 06:21:00'),
(13, 5, 'debit', 1.00, 'Registro en torneo: 1er de Hoy', '2025-11-23 06:21:25', '2025-11-23 06:21:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_team1_id_foreign` (`team1_id`),
  ADD KEY `games_team2_id_foreign` (`team2_id`),
  ADD KEY `games_winner_id_foreign` (`winner_id`),
  ADD KEY `games_tournament_id_foreign` (`tournament_id`),
  ADD KEY `games_player1_id_foreign` (`player1_id`),
  ADD KEY `games_player2_id_foreign` (`player2_id`),
  ADD KEY `games_winner_player_id_foreign` (`winner_player_id`);

--
-- Indexes for table `game_participations`
--
ALTER TABLE `game_participations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_participations_game_id_foreign` (`game_id`),
  ADD KEY `game_participations_team_id_foreign` (`team_id`),
  ADD KEY `game_participations_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `player_profiles`
--
ALTER TABLE `player_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `player_profiles_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `player_profiles_puuid_unique` (`puuid`),
  ADD UNIQUE KEY `player_profiles_summoner_id_unique` (`summoner_id`),
  ADD KEY `player_profiles_puuid_index` (`puuid`),
  ADD KEY `player_profiles_summoner_id_index` (`summoner_id`),
  ADD KEY `player_profiles_riot_game_name_index` (`riot_game_name`),
  ADD KEY `player_profiles_riot_tag_line_index` (`riot_tag_line`),
  ADD KEY `player_profiles_platform_index` (`platform`),
  ADD KEY `player_profiles_region_index` (`region`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_region_id_foreign` (`region_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_invitations_sender_id_foreign` (`sender_id`),
  ADD KEY `team_invitations_receiver_id_foreign` (`receiver_id`),
  ADD KEY `team_invitations_team_id_foreign` (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_user_id_unique` (`user_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_wallet_id_foreign` (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `game_participations`
--
ALTER TABLE `game_participations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_profiles`
--
ALTER TABLE `player_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_player1_id_foreign` FOREIGN KEY (`player1_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `games_player2_id_foreign` FOREIGN KEY (`player2_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `games_team1_id_foreign` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `games_team2_id_foreign` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `games_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `games_winner_id_foreign` FOREIGN KEY (`winner_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `games_winner_player_id_foreign` FOREIGN KEY (`winner_player_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `game_participations`
--
ALTER TABLE `game_participations`
  ADD CONSTRAINT `game_participations_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_participations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_participations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `player_profiles`
--
ALTER TABLE `player_profiles`
  ADD CONSTRAINT `player_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_invitations_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
