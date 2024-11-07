-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 12:19 PM
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
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL COMMENT '1 admin 2 sme 3 TA',
  `lob_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_super_admin` int(11) DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `role_id`, `lob_id`, `status`, `is_super_admin`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'university@evalueserve.com', '8000000006', '$2y$12$VzaahZCf8raSCTQcgBkVuOJuOeE6i6c4vqtGCtfGIeCOZrV8yIjF6', 1, 0, 1, 1, 'af8a25160432df17a8017176b7c8ccb79893fa7cd499fc14ad80e1eebfb488b7', '2024-08-17 12:37:52', '2024-11-05 20:31:27'),
(20, 'Sumit Joshi', 'sumit.joshi@evalueserve.com', '9898987878', '$2y$12$LUD9WyFhpeTg.ClgN290seU5IGjm94XO0n1yeHuNxmK9ZVfxcH4I2', 2, 0, 1, 0, 'e525483110a3003f08ff605b55910f1fe95708457151106ea622df6ce694a872', '2024-10-29 20:50:09', '2024-10-29 20:50:09'),
(21, 'Sushant Raj', 'sushant.raj@evalueserve.com', '7777778877', '$2y$12$Qdx8fI/V/xMnJmWDNY1O2e7OZSvr4OJK/e06KHHl3VCHpPfjxl7g6', 2, 0, 1, 0, '9b94ab7125da5d723f2536bee459746a253cb57224812ac9a7bb0d2d0184f121', '2024-10-29 20:50:34', '2024-10-29 20:50:34'),
(22, 'Ravi Shankar Jha', 'ravi.jha@evalueserve.com', '9999998899', '$2y$12$ADO6n3iFB73AygTrpwqBgO7GBp6kPdC0IhIfQt/Y5njQGVO1SzXRO', 2, 0, 1, 0, '0a8fe63aa98dcef31191d75588c090ec8f22b0645bcfe43207510205bc5f5b0f', '2024-10-29 20:50:59', '2024-10-29 20:50:59'),
(23, 'Ravinder Ahuja', 'ravinder.ahuja@evalueserve.com', '6677667777', '$2y$12$HgPxHlKFNPwvbHvRnjjUSeQ4yS2/jYI6EcmmuaQ1ZxV9MDtaIO1XK', 2, 0, 1, 0, '07069526d2386ca2a9b28b7685c9e41503ee5b0f4b307087f7cb639a03c92312', '2024-10-29 20:51:22', '2024-10-29 20:51:22'),
(24, 'Mohak Pachisia', 'mohak.pachisia@evalueserve.com', '7766776677', '$2y$12$qlC1YEbCttlkcAKYPsvhXuuuRZ.sH1fZD6Z2hNa/mEbPPqgPM5nue', 2, 0, 0, 0, 'de1daec3c541d25c1c398865d165ca8dac22750a80a63e2fc1c2d9bba32268c0', '2024-10-29 20:51:55', '2024-11-05 20:49:10'),
(25, 'Ankita Singh', 'ankita.singh@evalueserve.com', '9999999988', '$2y$12$m2ZjEVow2OJwZ0mX34VqHOnU9ZA1ducruIA1YeqxjE6MYkkxuDM5u', 3, 0, 1, 0, '23c2467c55fddff15611ab2636566c178f28556752946508f8cf4a4a358e99a7', '2024-10-29 21:08:00', '2024-10-29 21:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subset` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `subset`, `status`, `created_at`, `updated_at`) VALUES
(15, 'INSTILL', '1730978285.jpg', 'Domain and Functional', 1, '2024-10-29 20:52:42', '2024-11-07 05:48:05'),
(16, 'INNOVATE', '1730978258.jpg', 'Digital and Technology', 1, '2024-10-29 20:53:27', '2024-11-07 05:47:38'),
(17, 'IMBIBE', '1730978205.jpg', 'Behavioral and Communication', 1, '2024-10-29 20:54:17', '2024-11-07 05:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `coursemaps`
--

CREATE TABLE `coursemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lob_id` int(11) NOT NULL,
  `quiz_status` int(11) NOT NULL DEFAULT 0,
  `quiz_score` int(11) NOT NULL DEFAULT 0,
  `assignment_status` int(11) NOT NULL DEFAULT 0,
  `assignment_file` varchar(255) DEFAULT NULL,
  `assignment_remark` text DEFAULT NULL,
  `assignment_download_status` int(11) NOT NULL DEFAULT 0,
  `assignment_assign` varchar(255) DEFAULT NULL COMMENT 'sme id',
  `assignment_sme_file` varchar(250) DEFAULT NULL,
  `is_complete` int(11) NOT NULL DEFAULT 0,
  `is_read_video` text DEFAULT NULL,
  `is_read_docs` text DEFAULT NULL,
  `assignment_upload_date` date DEFAULT NULL,
  `sme_submission_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coursemaps`
--

INSERT INTO `coursemaps` (`id`, `user_id`, `course_id`, `lob_id`, `quiz_status`, `quiz_score`, `assignment_status`, `assignment_file`, `assignment_remark`, `assignment_download_status`, `assignment_assign`, `assignment_sme_file`, `is_complete`, `is_read_video`, `is_read_docs`, `assignment_upload_date`, `sme_submission_date`, `created_at`, `updated_at`) VALUES
(49, 33, 8, 37, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, '8', '2024-10-30', NULL, '2024-10-30 03:30:33', '2024-10-30 06:27:06'),
(50, 33, 9, 37, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, '2024-10-30', NULL, '2024-10-30 03:30:33', '2024-10-30 03:30:33'),
(51, 33, 10, 37, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, '2024-10-30', NULL, '2024-10-30 03:30:33', '2024-10-30 03:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `assignment` varchar(250) DEFAULT NULL,
  `sme_id` varchar(250) NOT NULL,
  `lob_id` varchar(250) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `isquiz` int(11) DEFAULT NULL,
  `author` varchar(250) NOT NULL,
  `uploader` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_id`, `course_name`, `description`, `image`, `assignment`, `sme_id`, `lob_id`, `category_id`, `isquiz`, `author`, `uploader`, `status`, `updated_at`, `created_at`) VALUES
(8, 5411, 'Trading Comparables', 'http://localhost:8081/learnbridge/login', '1730956658.jpg', '1730255189.xlsx', '21', '37', 15, NULL, 'Sushant Raj', 1, 1, '2024-11-06 23:47:38', '2024-10-29 20:56:29'),
(9, 7909, 'Communicating with Empathy', 'Communicating with Empathy', '1730956629.jpg', '', '22', '34,35,36,37', 17, NULL, 'Ravi Shankar Jha', 1, 1, '2024-11-06 23:47:09', '2024-10-29 21:02:48'),
(10, 3081, 'Working Across Cultures', 'Working Across Cultures', '1730956598.jpg', '', '22', '34,35,36,37', 17, NULL, 'Ravi Shankar Jha', 1, 1, '2024-11-06 23:46:38', '2024-10-29 21:04:49'),
(12, 9979, 'xyz', 'dfsdfsd', '1730288944.jpg', '', '22,20', '36', 17, NULL, 'Ravi Jha', 1, 0, '2024-10-30 06:19:04', '2024-10-30 06:19:04');

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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `lobs`
--

CREATE TABLE `lobs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lobs`
--

INSERT INTO `lobs` (`id`, `name`, `description`, `status`, `updated_at`, `created_at`) VALUES
(34, 'ITC', 'Information Technology Center', 1, '2024-10-29 20:48:41', '2024-10-29 20:48:41'),
(35, 'DA', 'Data Analytics', 1, '2024-10-29 20:48:53', '2024-10-29 20:48:53'),
(36, 'RQS', 'Risk & Quant', 1, '2024-10-29 20:49:11', '2024-10-29 20:49:11'),
(37, 'CIB', 'cibb', 1, '2024-11-05 06:24:42', '2024-10-29 20:49:23'),
(38, 'ITC', 'rwerwer', 1, '2024-11-05 06:25:37', '2024-11-05 06:25:37');

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
(9, '0001_01_01_000000_create_users_table', 1),
(10, '0001_01_01_000001_create_cache_table', 1),
(11, '0001_01_01_000002_create_jobs_table', 1),
(12, '2024_08_16_061428_create_admins_table', 1),
(13, '2024_10_06_123138_create_quizes_table', 2),
(14, '2024_10_06_152505_create_modules_table', 3),
(15, '2024_10_10_171202_create_coursemap_table', 4),
(16, '2024_10_13_161041_create_user_quiz_answer_table', 5),
(17, '2024_10_24_192021_create_category__table', 6),
(18, '2024_10_24_192036_create_subcategory__table', 6),
(19, '2024_10_24_193256_create_categories_table', 7),
(20, '2024_10_24_193303_create_sub_categories_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `video` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `module_name`, `description`, `duration`, `video`, `document`, `status`, `created_at`, `updated_at`) VALUES
(8, 8, 'Trading Comparables - Fundamentals', 'Trading Comparables - Fundamentals', 90, '1730255311.mp4', '1730255311.pdf', 1, '2024-10-29 20:58:31', '2024-10-29 20:58:31'),
(9, 8, 'Trading Comparables - Balance Sheet Components', 'Trading Comparables - Balance Sheet Components', 20, '1730255396.mp4', '1730255397.pdf', 1, '2024-10-29 20:59:57', '2024-10-29 20:59:57'),
(10, 8, 'Balance Sheet Components - Case Study', 'Trading Comparables - Balance Sheet Components - Case Study', 45, '1730255447.mp4', '', 1, '2024-10-29 21:00:47', '2024-10-29 21:00:47'),
(11, 9, 'Communicating with Empathy', 'Communicating with Empathy', 9, '1730255615.mp4', '', 1, '2024-10-29 21:03:35', '2024-10-29 21:03:35'),
(12, 10, 'Working Across Cultures', 'Working Across Cultures', 8, '1730266988.mp4', '', 1, '2024-10-29 21:06:25', '2024-10-30 00:13:08');

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
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(200) NOT NULL,
  `option_b` varchar(200) NOT NULL,
  `option_c` varchar(200) NOT NULL,
  `option_d` text NOT NULL,
  `correct_answer` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
('CLDgDfqnCBuieBeL9cB8gb0sIcaZqLUQPPhMrMMw', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZVJvdnFuTTRESElKYWVqU3hzQ0YyZnRsMXRYQTJpVThCSFd4NTBYaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MS9sZWFybmJyaWRnZS9hZG1pbi91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyNTt9', 1730968965),
('OtYXoAoc7yV4nZ6DEVC8J8cinNYhDBRTzx2mUErH', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUZwM2lyMVhMQnB2eG5xTG0xZ0ZtRFowaU1pM1I0Y3o0NEVkU3ZxUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MS9sZWFybmJyaWRnZS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1730882557),
('p9akGnGax6Q6UI3Xebf8JG3hqdepVeBk998rSHQT', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWJZOXV4cFp1SnZlbGZpZ05MeXF1NjFDbmJINXdrR1pJYnlOdXV1TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MS9sZWFybmJyaWRnZS9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1730877028),
('pEXTibEst493OYQtmqUhspomimxoDxw3uqblm5Co', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidW0wdDM2aVdOZmJteWppUXNzbzRyNmV0YUZUTVRJWW1hRUtVM1hyMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MS9sZWFybmJyaWRnZS9hZG1pbi90YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1730880221),
('zGDRXPCntUD0f2QhxjyvEQOqLkcLBf6XB05VkyLY', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUo3RDMya3dFMmZBbVVxSDZpZlJOSktDRHpIQmxSTkRjVHRoN25XcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MS9sZWFybmJyaWRnZS9hZG1pbi9jYXRlZ29yaWVzLzE1L2VkaXQiO31zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1730978286);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `lob_id` int(11) DEFAULT 0,
  `designation` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `sub_lob` varchar(200) DEFAULT NULL,
  `college_name` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `specialization` varchar(200) DEFAULT NULL,
  `college_location` varchar(200) DEFAULT NULL,
  `offer_release_spoc` varchar(200) DEFAULT NULL,
  `doj` date NOT NULL,
  `trf` varchar(200) DEFAULT NULL,
  `expectance_date` date DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=pending, 1 active, 2 suspended',
  `joiner_status` varchar(200) DEFAULT NULL,
  `revokes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `lob_id`, `designation`, `grade`, `gender`, `sub_lob`, `college_name`, `location`, `specialization`, `college_location`, `offer_release_spoc`, `doj`, `trf`, `expectance_date`, `token`, `status`, `joiner_status`, `revokes`, `created_at`, `updated_at`) VALUES
(33, 'anuj singh', 'joshisummi@gmail.com', 7788777777, '$2y$12$XzZp9v4Kkb331eGDzZm7s.XVzpzaenuohtTLI9XKnyXfPpC2CYdAa', 37, 'Junior', '1', 'Male', 'FS', 'Chitkara', 'Gurugram', 'btech', 'Punjab', 'Ankita Singh', '2024-11-28', '8989', '2024-10-30', '98d9ac8ac1f319e45d64473f7a09cf3004db2b48f407c9baa45b5284b5656f34', 1, 'xyz', 0, '2024-10-29 21:12:13', '2024-11-06 03:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_answers`
--

CREATE TABLE `user_quiz_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursemaps`
--
ALTER TABLE `coursemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lobs`
--
ALTER TABLE `lobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `coursemaps`
--
ALTER TABLE `coursemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lobs`
--
ALTER TABLE `lobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
