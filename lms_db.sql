-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2024 at 08:29 PM
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
(1, 'admin', 'admin@gmail.com', '8000000006', '$2y$12$G1n3scAJ9xHv6aAy7ZPsrO3MhpFiYy8p0GDRMzp6qyK89KxyoJUL.', 1, 0, 1, 1, '', '2024-08-17 12:37:52', '2024-10-27 08:23:29'),
(8, 'SME', 'sme@gmail.com', '8700000000', '$2y$12$qM/XL6yCqrKOMLEWnP6jruXzz9vErq9PQ2Oimr8Eua0a24cgqPAjy', 2, 1, 1, 0, 'b871ff290ba19a8ed7c3e4f465b35fcdfc66564bdabfd8a19da3318fff26ebea', '2024-10-10 10:46:40', '2024-10-27 08:26:49'),
(11, 'admin1', 'admin11@gmail.com', '8000010006', '$2y$12$G1n3scAJ9xHv6aAy7ZPsrO3MhpFiYy8p0GDRMzp6qyK89KxyoJUL.', 1, 0, 1, 0, '', '2024-08-17 12:37:52', '2024-10-27 03:04:55'),
(12, 'sme12', 'sme2@gmail.com', '9999798316', '$2y$12$zHdW16Jgh.hQgGdl15Z6pePdoc3gUAXzBbLNJGFS.UvOYUkQSYTz2', 2, 1, 1, 0, '51470b8722303eec26f1a50b94d4cb4a76c19d2040b61be1516afd5a437f55bf', '2024-10-27 05:43:12', '2024-10-29 03:56:55'),
(13, 'vipin', 'ta@gmail.com', '7777778888', '$2y$12$ePOtqz0HmPccBf/8o55R8.WsaIfOpRag0vuWMXU4Eu2pFXh.lYGUi', 3, 1, 1, 0, 'da7e61c8a65434f42f7fb89528bc95b73393c378a5131a4aeedf6894fd4c4058', '2024-10-29 03:50:38', '2024-10-29 03:59:45'),
(14, 'vipin sme', 'smes@gmail.com', '8885798316', '$2y$12$nOXp20GKlURAA6JlCM1Qyui14t8AGkEoMRqKTQb/mAIhGE5zkJbBm', 2, 0, 1, 0, '52c5513531cb4e07ee88f8807b115f6a61a28e6700ce72cc0ae89b12b5e599c9', '2024-10-29 03:57:32', '2024-10-29 03:57:32'),
(15, 'tas', 'tas@gmail.com', '3333798316', '$2y$12$VZf02TR0aUXNSYRgnTIn9uc5MBeSSCn34.PtZkd1D22sgjtkD7vdC', 3, 0, 1, 0, 'aaa363ad677fcccd5681b36d0bdb21a21a72623d3073fb0d2bff787addbe03d2', '2024-10-29 03:58:15', '2024-10-29 03:58:15'),
(16, 'Quincy Wilkinson', 'mefdab@evalueserve.com', '8080808080', '$2y$12$zKl7PMPERSP2BA1CEsmaTu8HwCMNZlgrvR3ihxm9fE9.xtU4Hxr9K', 3, 0, 1, 0, '261191c49fff029b2b0634829e633d9a05c89566f5984fc834d22fc6d1d94612', '2024-10-29 11:48:54', '2024-10-29 11:49:10'),
(17, 'Samuel Cotton', 'fonussi@evalueserve.com', '7676767676', '$2y$12$FTWQs0HnpAjrNE44QYbcr.JttJ.ZjDZNFipzAkVqK6i6iQMaTdYx.', 2, 0, 1, 0, '8e3ddad73b888670860fb368f393307e0e7143e913ec5fef08f837be3d5e8afc', '2024-10-29 11:49:39', '2024-10-29 11:49:54'),
(18, 'Cruz Wynn', 'tiqusz@evalueserve.com', '8585858585', '$2y$12$zgEyIaSitvADGLpZ0pxgZOAjLHHSalS4aVvhoNFiqx4s3dwseKmSe', 1, 0, 1, 0, '368493c71c962e716ff9e1d854832f2dbad6ba52bc9fbfe271ca14b1d2b46143', '2024-10-29 11:50:33', '2024-10-29 11:50:44');

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
(12, 'INSTILL', '1729928283.jpg', 'Domain and Functional', 1, '2024-10-26 02:08:03', '2024-10-26 02:08:03'),
(13, 'INNOVATE', '1729928311.jpg', 'Technology and Digital', 1, '2024-10-26 02:08:31', '2024-10-26 02:08:31'),
(14, 'IMBIBE', '1729928334.jpg', 'Behavioral and Communication', 1, '2024-10-26 02:08:54', '2024-10-29 01:59:42');

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
(38, 22, 6, 1, 1, 0, 1, '1730226644.csv', NULL, 1, '8', NULL, 1, '5', '6', '2024-10-29', '2024-10-29', '2024-10-26 03:07:43', '2024-10-29 13:58:20'),
(40, 22, 7, 1, 0, 0, 1, '1730018611.pdf', NULL, 1, '8', NULL, 1, NULL, '7', NULL, NULL, '2024-10-27 03:08:55', '2024-10-27 03:13:49'),
(41, 22, 5, 1, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, '2024-10-29', NULL, '2024-10-29 13:18:45', '2024-10-29 13:18:45'),
(42, 22, 4, 1, 0, 0, 0, '', '', 0, NULL, NULL, 0, NULL, NULL, '2024-10-29', NULL, '2024-10-29 13:19:02', '2024-10-29 13:19:02');

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
(4, 3357, 'Laravel', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '1729929104.jpg', '1729929104.pdf', '8,12', '1,2,26', 14, 1, 'Jack and Annie', 1, 1, '2024-10-27 05:43:31', '2024-10-26 02:21:44'),
(5, 6439, 'React', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '1729929585.png', '', '8', '1,2,26', 13, 1, 'Jack', 1, 1, '2024-10-26 02:31:34', '2024-10-26 02:29:45'),
(6, 4423, 'CWM', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '1729929762.jpg', '1729929762.pdf', '8', '1,2,26', 12, NULL, 'Annie', 1, 1, '2024-10-29 12:56:53', '2024-10-26 02:32:42'),
(7, 9986, 'Testing', 'this is for test', '1730018281.jpg', '1730018281.pdf', '8,12', '1,2,26', 12, NULL, 'Jack and Annie', 1, 1, '2024-10-29 12:56:50', '2024-10-27 03:08:01');

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
(1, 'lob1', 'Non ea nisi eveniet nemo corporis aliquid fugit quidem. Quis commodi dolor itaque consequatur sunt.', 1, '2024-10-26 07:45:11', '2024-09-29 06:01:45'),
(2, 'lob2', 'Earum temporibus cum aut sit nobis. Sapiente non reprehenderit ut quo. Aut laudantium optio ipsum.', 1, '2024-10-26 07:45:22', '2024-09-29 06:01:45'),
(26, 'lob3', 'Qui alias ut repellat quod. Cupiditate qui voluptatem temporibus at.', 1, '2024-10-26 07:45:28', '2024-09-29 06:01:45');

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
(1, 4, 'Daria Martin', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 20, '1729929394.mp4', '1729964527.pdf', 1, '2024-10-26 02:26:34', '2024-10-26 12:12:07'),
(2, 4, 'Lorem ipsum is placeholder', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 20, '1729929443.mp4', '1729929443.pdf', 1, '2024-10-26 02:27:23', '2024-10-26 02:27:23'),
(3, 5, 'React introduction', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 10, '', '1729929654.pdf', 1, '2024-10-26 02:30:54', '2024-10-26 02:30:54'),
(4, 5, 'React setup', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 30, '1729929687.mp4', '1729964468.pdf', 1, '2024-10-26 02:31:27', '2024-10-26 12:11:08'),
(5, 6, 'CWM', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 30, '1729929804.mp4', '', 1, '2024-10-26 02:33:24', '2024-10-26 02:33:24'),
(6, 6, 'CWM Concept', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 40, '', '1729929853.pdf', 1, '2024-10-26 02:34:13', '2024-10-26 02:34:13'),
(7, 7, 'Concept Of Wealth Management', 'cdscdcid sijifdu ifsdifi sdi', 12, '', '1730018303.pdf', 1, '2024-10-27 03:08:23', '2024-10-27 03:08:23');

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

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `status`, `updated_at`, `created_at`) VALUES
(1, 4, 'What is the capital of india 1', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:55:35', '2024-10-26 07:55:35'),
(2, 4, 'What is the capital of india 2', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:55:35', '2024-10-26 07:55:35'),
(3, 4, 'What is the capital of india 3', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:55:35', '2024-10-26 07:55:35'),
(4, 4, 'What is the capital of india 4', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:55:35', '2024-10-26 07:55:35'),
(5, 4, 'What is the capital of india 5', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:55:35', '2024-10-26 07:55:35'),
(6, 4, 'What is the capital of india 6', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:55:35', '2024-10-26 07:55:35'),
(7, 5, 'What is the capital of india 1', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:59:54', '2024-10-26 07:59:54'),
(8, 5, 'What is the capital of india 2', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:59:54', '2024-10-26 07:59:54'),
(9, 5, 'What is the capital of india 3', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:59:54', '2024-10-26 07:59:54'),
(10, 5, 'What is the capital of india 4', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:59:54', '2024-10-26 07:59:54'),
(11, 5, 'What is the capital of india 5', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:59:54', '2024-10-26 07:59:54'),
(12, 5, 'What is the capital of india 6', 'New Delhi', 'Karnal', 'Chandigarh', 'Dubai', 'A', 1, '2024-10-26 07:59:54', '2024-10-26 07:59:54');

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
('AqFplWyUFAHi14JnhCziECTaMdkgt2mM2Ra9xdvH', 22, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicnA5Sms1R3dqb2habW51OHY5NFdLOVdSdmNJSmhrQjNISzlRTE1iViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9sZWFybmJyaWRnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIyO3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1730230119);

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
(22, 'user', 'user@gmail.com', 9797979797, '$2y$12$2aqJLZzNm4JbNOL104gBYO3H0Gp/mCpvJU2lN5dQjwHqRRcSGWdbO', 1, 'IT', 'A', 'male', 'This is for sub lob', 'S.M.T.', 'Noida', 'Web Development', 'Delhi', 'abc', '2024-10-26', 'xyz', '2024-10-30', '2b42809b170df7dba1fca019974c0957ea272bc7eed2ed3cfa6b4b3c2308cac4', 1, 'active', 0, '2024-10-26 02:37:48', '2024-10-29 18:48:08');

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
-- Dumping data for table `user_quiz_answers`
--

INSERT INTO `user_quiz_answers` (`id`, `course_id`, `user_id`, `question_id`, `answer`, `updated_at`, `created_at`) VALUES
(13, 5, 22, 7, 'A', '2024-10-27 03:29:09', '2024-10-27 03:29:09'),
(14, 5, 22, 8, 'A', '2024-10-27 03:29:11', '2024-10-27 03:29:11'),
(15, 5, 22, 9, 'A', '2024-10-27 03:29:13', '2024-10-27 03:29:13'),
(16, 5, 22, 10, 'A', '2024-10-27 03:29:15', '2024-10-27 03:29:15'),
(17, 5, 22, 11, 'A', '2024-10-27 03:29:18', '2024-10-27 03:29:18'),
(18, 5, 22, 12, 'A', '2024-10-27 03:29:20', '2024-10-27 03:29:20');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `coursemaps`
--
ALTER TABLE `coursemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
