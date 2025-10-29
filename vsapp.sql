-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 03:05 PM
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
  `winner_id` int(10) UNSIGNED DEFAULT NULL,
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
(1, NULL, NULL, 1, 2, 1, 1, 0, '2025-09-25 03:57:31', '2025-09-25 03:57:31', '2025-09-25 03:57:31', NULL, NULL, NULL),
(2, 1, NULL, 1, 2, NULL, 0, 0, NULL, '2025-10-17 03:38:57', '2025-10-18 01:40:11', 5, 6, 5),
(3, 14, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-20 22:03:23', '2025-10-20 22:10:33', 6, 5, 5),
(4, 14, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-20 22:03:23', '2025-10-20 22:10:37', 7, 8, 7),
(5, 14, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-10-20 22:10:37', '2025-10-20 22:19:44', 5, 7, 7),
(6, 16, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 14:05:32', '2025-10-21 14:07:38', 7, 6, 6),
(7, 17, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 14:33:07', '2025-10-21 14:33:52', 8, 5, 5),
(8, 17, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 14:33:08', '2025-10-21 14:33:58', 7, 6, 6),
(9, 17, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 14:33:58', '2025-10-21 14:33:58', 6, 5, NULL),
(10, 17, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 14:34:02', '2025-10-21 14:34:02', 6, 5, NULL),
(11, 18, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 14:51:04', '2025-10-21 14:52:37', 7, 8, 7),
(12, 19, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 15:08:39', '2025-10-21 15:09:29', 5, 6, 6),
(13, 19, 1, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 15:08:39', '2025-10-21 15:09:36', 8, 7, 8),
(14, 19, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 15:09:36', '2025-10-21 15:14:29', 6, 8, 8),
(15, 19, 2, NULL, NULL, NULL, 0, 0, NULL, '2025-10-21 15:12:58', '2025-10-21 15:12:58', 8, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game_participations`
--

CREATE TABLE `game_participations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
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
(10, 1, 1, 2, 'top', 'win', '2025-09-25 04:01:41', '2025-09-25 04:01:41'),
(11, 1, 1, 5, 'adc', 'win', '2025-09-25 04:01:41', '2025-09-25 04:01:41'),
(12, 1, 1, 8, 'jungle', 'win', '2025-09-25 04:01:41', '2025-09-25 04:01:41'),
(13, 1, 2, 4, 'top', 'loss', '2025-09-25 04:01:41', '2025-09-25 04:01:41'),
(14, 1, 2, 6, 'mid', 'loss', '2025-09-25 04:01:41', '2025-09-25 04:01:41'),
(15, 1, 2, 7, 'jungle', 'loss', '2025-09-25 04:01:41', '2025-09-25 04:01:41'),
(16, 2, 1, 5, 'player', 'win', '2025-10-17 03:38:57', '2025-10-17 03:38:57'),
(17, 2, 2, 6, 'player', 'win', '2025-10-17 03:38:57', '2025-10-17 03:38:57'),
(18, 3, 2, 6, 'player', 'win', '2025-10-20 22:03:23', '2025-10-20 22:03:23'),
(19, 3, 1, 5, 'player', 'win', '2025-10-20 22:03:23', '2025-10-20 22:03:23'),
(20, 4, 2, 7, 'player', 'win', '2025-10-20 22:03:23', '2025-10-20 22:03:23'),
(21, 4, 1, 8, 'player', 'win', '2025-10-20 22:03:23', '2025-10-20 22:03:23'),
(22, 6, 2, 7, 'player', 'win', '2025-10-21 14:05:32', '2025-10-21 14:05:32'),
(23, 6, 2, 6, 'player', 'win', '2025-10-21 14:05:32', '2025-10-21 14:05:32'),
(24, 7, 1, 8, 'player', 'win', '2025-10-21 14:33:08', '2025-10-21 14:33:08'),
(25, 7, 1, 5, 'player', 'win', '2025-10-21 14:33:08', '2025-10-21 14:33:08'),
(26, 8, 2, 7, 'player', 'win', '2025-10-21 14:33:08', '2025-10-21 14:33:08'),
(27, 8, 2, 6, 'player', 'win', '2025-10-21 14:33:08', '2025-10-21 14:33:08'),
(28, 11, 2, 7, 'player', 'win', '2025-10-21 14:51:04', '2025-10-21 14:51:04'),
(29, 11, 1, 8, 'player', 'win', '2025-10-21 14:51:04', '2025-10-21 14:51:04'),
(30, 12, 1, 5, 'player', 'win', '2025-10-21 15:08:39', '2025-10-21 15:08:39'),
(31, 12, 2, 6, 'player', 'win', '2025-10-21 15:08:39', '2025-10-21 15:08:39'),
(32, 13, 1, 8, 'player', 'win', '2025-10-21 15:08:39', '2025-10-21 15:08:39'),
(33, 13, 2, 7, 'player', 'win', '2025-10-21 15:08:39', '2025-10-21 15:08:39');

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
(8, '2025_09_22_160636_create_player_profiles_table', 2),
(9, '2025_09_22_192000_add_unique_user_to_player_profiles', 3),
(10, '2025_09_22_195425_add_riot_fields_to_player_profiles', 4),
(11, '2025_09_23_050118_tune_player_profiles_indexes', 5),
(12, '2025_09_23_211703_create_games_table', 6),
(13, '2025_09_24_034408_create_game_participations_table', 7),
(14, '2025_09_24_035554_add_role_to_users_table', 8),
(15, '2025_09_24_110042_create_team_invitations_table', 9),
(16, '2025_09_24_120024_add_type_and_message_to_team_invitations_table', 10),
(17, '2025_09_24_143234_add_role_to_player_profiles_table', 11),
(18, '2025_10_15_010834_create_wallets_table', 12),
(19, '2025_10_15_010841_create_wallet_transactions_table', 12),
(21, '2025_10_15_013208_add_user_id_to_wallets_table', 13),
(22, '2025_10_15_013616_add_balance_and_user_id_to_wallets_table', 13),
(23, '2025_10_15_014328_add_wallet_id_to_wallet_transactions_table', 14),
(24, '2025_10_15_014528_add_type_to_wallet_transactions_table', 15),
(25, '2025_10_15_015250_create_wallet_transactions_table', 16),
(26, '2025_10_16_204459_create_tournaments_table', 17),
(27, '2025_10_16_204629_create_tournament_registrations_table', 17),
(28, '2025_10_16_210656_create_tournament_registrations_table', 18),
(29, '2025_10_16_215831_add_type_to_tournaments_table', 18),
(30, '2025_10_16_220056_add_type_to_tournaments_table', 18),
(31, '2025_10_16_225019_add_tournament_id_to_games_table', 19),
(32, '2025_10_16_230401_add_players_to_games_table', 20),
(33, '2025_10_17_214255_add_round_to_games_table', 21),
(34, '2025_10_18_003225_update_tournaments_table_add_scheduled_at', 22);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('carlos@gmail.com', '$2y$12$0Qxt5EzbbYFXtykJeON4ZucfMyeq4.CG85n5bf4TJW4zQjr.CPKFC', '2025-10-13 22:10:53');

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
  `role` varchar(50) DEFAULT NULL,
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

INSERT INTO `player_profiles` (`id`, `user_id`, `summoner_name`, `rank`, `role`, `country`, `phone`, `created_at`, `updated_at`, `riot_game_name`, `riot_tag_line`, `puuid`, `summoner_id`, `profile_icon_id`, `summoner_level`, `rank_queue`, `rank_tier`, `rank_division`, `rank_lp`, `platform`, `region`) VALUES
(3, 2, 'Trynda#VDC', 'PLATINUM IV', 'Top Lane', 'Canada', '2142510070', '2025-09-23 13:57:51', '2025-09-25 06:39:53', 'Trynda', 'VDC', 'nThpFqCryJcIVOJn3E6vNjqRjmDn2kjhW7qGVhJh4Io8EIo3Qc9bCGmx8zmStGOphIYLXNLdqCoQsw', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'PLATINUM', 'IV', 11, 'la1', 'americas'),
(4, 4, 'Tryndamere#VDC', 'EMERALD IV', 'Top Lane', 'Canada', '4378301829', '2025-09-24 08:42:57', '2025-09-25 06:24:14', 'Tryndamere', 'VDC', 'MRINxcxoh-hTuvYkiiSaiDTygwp7wqiUdbMxaRjR1ZjZM2h7iLOfZuDAzzXR4u3YkIY0UbQmqlpxoQ', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'EMERALD', 'IV', 44, 'la1', 'americas'),
(5, 5, 'YueYsaya#LAN', 'BRONZE III', 'Bot Lane', 'Argentina', '+5491123899524', '2025-09-24 14:40:05', '2025-09-24 14:40:05', 'YueYsaya', 'LAN', 'qWonyxIqRHOilkH_V1bLqHI9yGb9pRhLqSe1qyKfvl7fI7EmOZ496ycRz66B6p7LxBiHxP8Rt7zRFQ', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'BRONZE', 'III', 65, 'la1', 'americas'),
(6, 6, 'Nartsuki#LAN', 'DIAMOND IV', 'Mid Lane', 'Estados Unidos', '+12544361956', '2025-09-24 14:42:09', '2025-09-25 06:24:11', 'Nartsuki', 'LAN', '90t8VV35wP-dFaNRiZFVIOVtV5yxGAAZ4Dlb0yR1y1OH5kw96nmguLJUq1wGOpfePcCRfMEy1oqH6g', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'DIAMOND', 'IV', 31, 'la1', 'americas'),
(7, 7, 'SanYeii#LAN', 'SILVER II', 'Bot Lane', 'Venezuela', '+584241393840', '2025-09-24 14:44:03', '2025-09-26 01:03:06', 'SanYeii', 'LAN', 'wV1eM_SJLPZGE89yHhfQ2wxw01Zwza46JSm8e48dUJhyYK2eXDIlJcwdd_WUO9llwawYXRKjgpaUWg', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'SILVER', 'II', 1, 'la1', 'americas'),
(8, 8, 'Zerocheck#LAN', 'PLATINUM IV', 'Jungle', 'Venezuela', '+584125387557', '2025-09-24 14:46:14', '2025-09-25 06:39:57', 'Zerocheck', 'LAN', '5CcmBxxfmRNIfVuh6QXVvgK-vBlbT-81RZe8SXedjr00owtKKBzkQ17m2O0cOTc8LJG277GKb1MnEA', NULL, NULL, NULL, 'RANKED_SOLO_5x5', 'PLATINUM', 'IV', 47, 'la1', 'americas');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('J1JptIcRGr88RrejbBaBE9zfTHuyhOBlnYjim3pB', 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ3NOYTlBTnJKenZzR0dOZW0xNjNhSEYyUkdZbE1hYWFiZzdLcVhLVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdnNhcHAvcHVibGljL3RvdXJuYW1lbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRRaE92SDRIOUNoUlExbDhULzJIaUwuTTNLNFJhdHg4MXhKV2FUNnN2WUZ5aFRIaVBLM0U4VyI7fQ==', 1761063643),
('uydYw3awoBAmeH1dY8twsm94eo5gbfZ4o8ctqkMK', 7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZUhJaklpU0FxWUswMmd6eTNMVUZxV29Udkc5U1dTcW9Sa0djQUxVYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdnNhcHAvcHVibGljL3RvdXJuYW1lbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRBVzc3S2Z1RjBzcmhKT1JpZkg1L3h1UUw5ZXhJN3JQQ3gwMndFTWZoOXhEWjJSWjNwLmpBTyI7fQ==', 1761746635);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `region` int(10) NOT NULL,
  `rank` int(10) NOT NULL,
  `g_win` int(10) NOT NULL,
  `g_lost` int(10) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `region`, `rank`, `g_win`, `g_lost`, `created_at`, `updated_at`) VALUES
(1, 'EloVagabundos', 0, 0, 1, 0, '2025-09-23', '0000-00-00'),
(2, 'CaosCautivo', 0, 0, 0, 1, '2025-09-24', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'invite',
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_invitations`
--

INSERT INTO `team_invitations` (`id`, `sender_id`, `receiver_id`, `team_id`, `status`, `created_at`, `updated_at`, `type`, `message`) VALUES
(1, 2, 8, 1, 'accepted', '2025-09-24 15:31:44', '2025-09-24 15:32:19', 'invite', NULL),
(2, 2, 8, 1, 'accepted', '2025-09-24 15:54:00', '2025-09-24 15:55:04', 'invite', NULL),
(3, 2, 8, 1, 'accepted', '2025-09-24 16:05:00', '2025-09-24 16:13:01', 'invite', NULL),
(4, 8, 2, 1, 'rejected', '2025-09-24 16:13:01', '2025-09-24 16:17:47', 'invite', NULL),
(5, 2, 8, 1, 'accepted', '2025-09-24 16:17:47', '2025-09-24 16:36:58', 'invite', NULL),
(6, 8, 2, 1, 'rejected', '2025-09-24 16:36:58', '2025-09-24 16:37:56', 'invite', NULL),
(7, 2, 8, 1, 'accepted', '2025-09-24 16:37:56', '2025-09-24 16:58:07', 'invite', NULL),
(8, 6, 7, 2, 'accepted', '2025-09-24 17:01:53', '2025-09-24 17:02:29', 'invite', NULL),
(9, 6, 7, 2, 'accepted', '2025-09-24 17:23:17', '2025-09-24 17:24:00', 'invite', NULL),
(10, 6, 7, 2, 'accepted', '2025-09-24 17:47:32', '2025-09-24 17:47:59', 'invite', NULL),
(11, 6, 7, 2, 'accepted', '2025-09-25 04:32:36', '2025-09-25 04:32:57', 'invite', NULL),
(12, 6, 7, 2, 'accepted', '2025-09-26 01:03:42', '2025-09-26 01:04:09', 'invite', NULL),
(13, 6, 7, 2, 'accepted', '2025-10-03 01:47:47', '2025-10-03 01:48:19', 'invite', NULL),
(14, 6, 9, 2, 'accepted', '2025-10-13 22:51:33', '2025-10-13 22:52:02', 'invite', NULL);

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
(2, 'Cindy', 'madeliz@gmail.com', NULL, '$2y$12$vWchoWqVqdK9cqIzp5d94eVW3cllfPa4OStTLMocg7bUdVd7YOPXO', NULL, NULL, NULL, NULL, 1, NULL, '2024-01-23 21:02:20', '2024-01-23 21:02:20', 'captain'),
(4, 'carlos', 'carlos@gmail.com', NULL, '$2y$12$QhOvH4H9ChRQ1l8T/2HiL.M3K4Ratx81xJWaT6svYFyhTHiPK3E8W', NULL, NULL, NULL, NULL, 2, NULL, '2025-09-24 08:40:34', '2025-09-24 08:40:34', 'admin'),
(5, 'luis daniel', 'luisd@gmail.com', NULL, '$2y$12$XQa8wSdJvTCHgUu5yHtiyeHb027.EL4l0jK31Yia1qNg.504dyaRy', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-24 14:35:22', '2025-09-24 14:35:22', 'player'),
(6, 'leandro Rojas', 'leo@gmail.com', NULL, '$2y$12$ZFHi5KSx6yYvrcmXdJ.as.R8LeJlweEJqz29fkSDg6MLY3Vqoro26', NULL, NULL, NULL, NULL, 2, NULL, '2025-09-24 14:40:54', '2025-09-24 14:40:54', 'captain'),
(7, 'Yei', 'yei@gmail.com', NULL, '$2y$12$AW77KfuF0srhJORifH5/xuQL9exI7rPCx02wEMfh9xDZ2RZ3p.jAO', NULL, NULL, NULL, NULL, 2, NULL, '2025-09-24 14:42:48', '2025-10-03 01:48:19', 'player'),
(8, 'Jesus', 'jesus@gmail.com', NULL, '$2y$12$gmQ1KBKYGfqfy5ZlBQBz8OdN6.fZU618o0RbkpdCLQjjnpcXaHeVa', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-24 14:44:51', '2025-09-24 16:13:01', 'player'),
(9, 'carlos martinez', 'carlosmvera25@gmail.com', NULL, '$2y$12$eyETik6jKJMdKwQ/sBY9u.N5gjRVJ/Mn/tdbm/b20VcMraC8AmWwi', NULL, NULL, NULL, 'xy8hjsxUupDfk8JZYmSnuFuF9VBt7JfP83CBO4YnIuOiVxtPLjxBecP4FlQB', NULL, NULL, '2025-10-13 22:32:29', '2025-10-13 22:52:02', 'jugador');

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
(1, 4, '2025-10-15 05:40:11', '2025-10-15 05:55:47', 50.00),
(2, 6, '2025-10-17 02:26:10', '2025-10-17 02:26:10', 0.00),
(3, 5, '2025-10-17 02:36:24', '2025-10-17 02:36:24', 0.00),
(4, 7, '2025-10-18 03:41:10', '2025-10-18 03:41:10', 0.00),
(5, 8, '2025-10-20 21:09:37', '2025-10-20 21:09:37', 0.00),
(6, 2, '2025-10-20 20:29:46', '2025-10-20 20:29:46', 0.00);

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
(1, 1, 'mint', 10.00, 'Mint by admin', '2025-10-15 05:55:47', '2025-10-15 05:55:47');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `game_participations`
--
ALTER TABLE `game_participations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_profiles`
--
ALTER TABLE `player_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_player1_id_foreign` FOREIGN KEY (`player1_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `games_player2_id_foreign` FOREIGN KEY (`player2_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
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
