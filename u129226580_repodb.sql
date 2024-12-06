-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2024 at 08:09 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u129226580_repodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$f6YZMtWY5i/1wpogUkLH1uAmensekeirMz5ygY/.mbt1hHP1R9Lze', 'active', NULL, '2024-11-27 15:36:20', '2024-11-20 00:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `archive_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `category` text DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `curriculum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `abstract` varchar(1000) DEFAULT NULL,
  `members` varchar(255) DEFAULT NULL,
  `adviser` text DEFAULT NULL,
  `banner_path` text DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `status` tinyint(11) NOT NULL DEFAULT 0,
  `remark` varchar(1000) DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `count_rank` int(11) NOT NULL DEFAULT 0,
  `google_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `archive_code`, `type`, `category`, `department_id`, `curriculum_id`, `year`, `title`, `abstract`, `members`, `adviser`, `banner_path`, `document_path`, `status`, `remark`, `student_id`, `slug`, `count_rank`, `google_id`, `created_at`, `updated_at`) VALUES
(1, '922742076', 'Capstone 2', 'Web Application', 1, 4, '2020', 'test', '<p>asdfsaf</p>', '<ol><li>sdasd\\</li><li>asdasd</li><li>asda</li></ol>', 'Mr. Tristan Unabia', '1733400258.jpg', '1733400258.pdf', 1, 'rejected because oaf nasdfklasfjhasf', 1, 'test', 5, '116263033900147419063', '2024-12-05 12:04:18', '2024-12-06 15:27:21'),
(2, '110843417', 'CS Thesis 2', 'PC Application', 2, 4, '2012', 'asdaf', '<p>asdasd</p>', '<ol><li>dasd</li><li>dasd</li><li>sda</li></ol>', 'Mr. Tristan Unabia', '1733403371.jpg', '1733403371.pdf', 1, NULL, 1, 'asdaf', 3, '116263033900147419063', '2024-12-05 12:56:11', '2024-12-06 09:41:36'),
(3, '1422289360', 'BSTM Thesis', 'Web Application', 2, 4, '2012', 'dsd', '<p>sdasda</p>', '<ol><li>dsad</li><li>sdasd</li><li>sda</li></ol>', 'Mr. Tristan Unabia', '1733409234.jpg', '1733409234.pdf', 1, NULL, 1, 'dsd', 3, '116263033900147419063', '2024-12-05 14:33:54', '2024-12-06 15:26:53'),
(4, '1011041843', 'SHS Practical Research', 'Mobile Application', 1, 3, '2023', 'payroll', '<ol><li>john Doe</li><li>zedrick Fabros</li></ol>', '<p><strong>Lorem Ipsum</strong> Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry\'s Standard Dummy Text Ever Since The 1500s</p>', 'mr tan', '1733474131.png', '1733474131.pdf', 1, NULL, 17, 'payroll', 5, '102605668188768116142', '2024-12-06 08:35:31', '2024-12-06 09:41:52'),
(5, '1493177464', 'Capstone 2', 'Standalone Application', 5, 4, '2024', 'CRM', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</p>', '<ul><li>jona</li><li>maria</li></ul>', 'marlon', '1733474866.jpg', '1733474866.pdf', 2, NULL, 17, 'crm', 0, '102605668188768116142', '2024-12-06 08:47:46', '2024-12-06 08:47:46'),
(6, '788075281', 'SHS Practical Research', 'Standalone Application', 1, 4, '2024', 'testing', '<p>asdarasrd</p>', '<ol><li>dsad</li><li>dsada</li><li>dsad</li></ol>', 'Mr. Tristan Unabia', '1733497350.jpg', '1733497350.pdf', 2, NULL, 14, 'testing', 0, '106704371325745101819', '2024-12-06 15:02:30', '2024-12-06 15:02:30'),
(7, '303084906', 'CS Thesis 2', 'Web Application', 5, 4, '2019', 'sdasd', '<p>asdasdasd</p>', '<ol><li>dasda</li><li>dasda</li><li>sada</li></ol>', 'dsadas', '1733497482.jpg', '1733497482.pdf', 2, NULL, 14, 'sdasd', 0, '106704371325745101819', '2024-12-06 15:04:42', '2024-12-06 15:04:42'),
(8, '1574321746', 'CS Thesis 2', 'Mobile Application', 5, 5, '2024', 'wdad', '<p>awdawdaw</p>', '<ul><li>dawd</li><li>awdad</li><li>awda</li></ul>', 'Mr. Tristan Unabia', '1733497554.jpg', '1733497554.pdf', 2, NULL, 14, 'wdad', 0, '106704371325745101819', '2024-12-06 15:05:54', '2024-12-06 15:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `backupdatabase`
--

CREATE TABLE `backupdatabase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_store` varchar(255) DEFAULT NULL,
  `database_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backupdatabase`
--

INSERT INTO `backupdatabase` (`id`, `date_store`, `database_path`, `created_at`, `updated_at`) VALUES
(1, '2024-12-06_20-06-02', '/storage/app/backup/2024-12-06_20-06-02_backup.sql', NULL, NULL),
(2, '2024-12-06_20-07-02', '/storage/app/backup/2024-12-06_20-07-02_backup.sql', NULL, NULL),
(3, '2024-12-06_20-08-02', '/storage/app/backup/2024-12-06_20-08-02_backup.sql', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curricula`
--

CREATE TABLE `curricula` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curricula`
--

INSERT INTO `curricula` (`id`, `department_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 1, 'BSIS', 'Bachelor of Science in Information Systems', NULL, '2024-11-03 01:58:58'),
(4, 2, 'BSIT', 'Bachelor of Science in Information Technology (BSIT)', NULL, '2024-11-26 06:11:48'),
(5, 1, 'HRM', 'this is about cooking course', '2024-11-03 01:47:09', '2024-11-03 01:47:09'),
(7, 5, 'BSTM', 'Bachelor of Science in Tourism Management', '2024-11-25 13:56:41', '2024-11-25 13:56:41'),
(10, 1, 'Bachelor of Science in Computer Science', 'BSCS', '2024-11-26 10:07:15', '2024-11-26 10:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'College of Industrial Technology', 'Develop world-class industrial workers and middle-level managers equipped with scientific knowledge, technological skills, and ethical work values to achieve a desirable quality of life.', NULL, '2024-11-03 00:57:49'),
(2, 'College of Education', 'Implement Teacher Education Programs for the elementary and secondary levels and endeavor to achieve quality and excellence, relevance and responsiveness, equity and access, and efficiency and effectiveness in instruction, research, extension, and product', NULL, NULL),
(5, 'Hospitality and Tourism Education', 'It provides students the opportunity to become directly involved in managing and planning the world\'s biggest people industry hello', '2024-11-25 13:53:59', '2024-11-26 08:37:30'),
(6, 'College of Medicine', 'It provides students the opportunity to become directly involved in managing and planning the world\'s biggest people industry', '2024-11-26 08:38:08', '2024-11-26 08:38:08');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_01_021053_create_student_models_table', 1),
(6, '2024_10_06_063609_create_departments_table', 1),
(7, '2024_10_06_063717_create_curricula_table', 1),
(8, '2024_10_06_082515_create_faculties_table', 1),
(9, '2024_10_13_082331_create_archives_table', 2),
(10, '2024_10_13_083821_create_staff_table', 3),
(11, '2024_11_01_153308_create_admins_table', 4),
(12, '2024_11_02_072409_create_staff_table', 5),
(13, '2024_11_04_064308_create_system_information_table', 6),
(14, '2024_11_20_093739_create_usercontrols_table', 7),
(15, '2024_11_20_112914_create_usercontrols_table', 8);

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
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `middlename`, `lastname`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', NULL, 'test', 'test@gmail.com', NULL, '$2y$10$ts7MZCE8fbbqYBt2fsdGoeYY9pG41r1i3NcdNjNbwqJov4Qlmmn3y', 'active', NULL, '2024-12-05 15:03:03', '2024-12-05 15:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `student_models`
--

CREATE TABLE `student_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `curriculum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `google_id` text DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_information`
--

CREATE TABLE `system_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_name` varchar(255) DEFAULT NULL,
  `system_short_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_information`
--

INSERT INTO `system_information` (`id`, `system_name`, `system_short_name`, `description`, `about`, `email`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'STI Web-Based Repository System', 'Repository System', 'By digitizing and making these academic works readily available, we aim to foster innovation, collaboration, and knowledge sharing within the academic community and beyond.', 'This repository is a digital archive specifically designed to store and preserve theses and dissertations from [University Name]. It provides a centralized platform for researchers, faculty, and students to access and explore a wealth of scholarly work.', 'inquiry@marikina.sti.edu', '8942-3307', '289 L. de Guzman Street, Concepcion I, Marikina City, 1807 Metro Manila', NULL, '2024-11-25 14:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `usercontrols`
--

CREATE TABLE `usercontrols` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collectionlist_view` tinyint(4) NOT NULL DEFAULT 0,
  `collectionlist_updatestatus` tinyint(4) NOT NULL DEFAULT 0,
  `collectionlist_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usercontrols`
--

INSERT INTO `usercontrols` (`id`, `staff_id`, `collectionlist_view`, `collectionlist_updatestatus`, `collectionlist_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, '2024-11-21 10:13:11', '2024-11-21 11:19:35'),
(2, 3, 0, 1, 1, '2024-11-21 10:13:24', '2024-11-21 11:19:46'),
(3, 6, 0, 1, 0, '2024-11-21 10:13:46', '2024-11-21 10:13:46'),
(4, 7, 0, 0, 0, '2024-11-26 05:45:29', '2024-11-26 08:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `google_id` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `google_id`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Geo De Leon', 'dgeo7212@gmail.com', NULL, '116263033900147419063', '$2y$10$Ygikdlxlcg.4GuG3XapVLOGK3zuqnw.GBiQQwrngOqRau/OVuCjni', 'student', '1', 'dn1HCeVrYTW2dj2DawIyagEmffCoezOSCGRjdEsaR9E7yfBkmhW6b2YKtZ0c', '2024-11-19 04:56:49', '2024-11-21 07:43:59'),
(3, 'Alexander Josh A. Bea', 'alexander951bea@gmail.com', NULL, '104144111589295803981', '$2y$10$oNtOOWftKPPBNYxXKT3FJO/Pvho/tPetU3RX/ZlmO9HkwoHheK8kW', 'student', '1', 'OpviLhrW7wN3T3Ezk3WLYgvgA1QSfEIIGEWlJmV9xcUHP6dhdWxxJF07bLZB', '2024-11-20 21:32:52', '2024-11-26 04:12:44'),
(6, 'Kelvin Ryll Fortin', 'krfortin15@gmail.com', NULL, '109431017189038954951', '$2y$10$4jE9JwL1bUUo7.dgN7wqIOkfspLKjSgy512rdibPP63cFZ2DqOcbW', 'student', '1', 'YaNOJqVnwYZG5XNXOurqyZiFzwFPTZbYT5K4GVTKgkpeE8LZMbL1jjRGLHVD', '2024-11-25 12:30:13', '2024-11-25 12:30:13'),
(7, 'Geo De Leon', 'geodeleon@gmail.com', NULL, '106704371325745101819', '$2y$10$GhzRHFSDaQZDQwCD/kmEJumM8eqjxxAATIm.oORetnLedtdUt9G.S', 'student', '1', 'he4TSCzWR0qC5ubk8fMgCMJboxAFeWdkSsMsD3ptws6ON9v8KdOuTtDSnL1h', '2024-11-25 12:39:56', '2024-11-26 06:53:43'),
(8, 'Charliemagne Bacsafra', 'bacsafracharliemagne@gmail.com', NULL, '100097801177175832594', '$2y$10$K1eoCrLo1QO3aZj89xazmeVYAiHTI0Nl8RDmt7M0IfzBT2Qhh0PKO', 'student', '1', 'SIO0oM6zH4BUReCrWXWMD0WXdi9VB9lKPBxcfpW3e6N88Hi2cH0MgAH1ybP6', '2024-11-25 12:41:52', '2024-11-25 12:41:52'),
(9, 'Raye Hino', 'r4ye.hino00@gmail.com', NULL, '117327662626290123439', '$2y$10$Zwit3bfvXObMcFmg/s//NubyRest9svhkvidIbT6YJ7UhNO/8Ti5W', 'student', '1', 'NoiEoQKhbVQCJCKFLgu6FBIhtDmOD4IC1E4qZQEDDBGi13mPawthTWrMwQSw', '2024-11-25 13:00:27', '2024-11-25 13:00:27'),
(10, 'Lawrence', 'lawrencealbanoilovelol@gmail.com', NULL, '104873530181845096279', '$2y$10$xhNnuIVhkL4SPoWpkT/QZOMgoN71hkrLENYHKi4A/GPC/36fvLwxq', 'student', '1', 'sKLAn4xgUzCupSY4PP7tUKkRcWgXs3KWo37qNLHh5f3Bq4mWkqsHpFVUpa8F', '2024-11-25 13:00:44', '2024-11-25 13:00:44'),
(11, 'Naval, Jhon Carlos Q.', 'jc32naval@gmail.com', NULL, '117363188680408484679', '$2y$10$2QuS6kG88hU0GUsRpKxBAOIvg01/d4jNYanKBVMQvYkpVJJgsJsnG', 'student', '1', 'Rvyc39z8xSHMnjMTGcXqs4LvhFRGu1XYT74thC1vEBxHqRcPR3RhHQdGvD6z', '2024-11-25 13:32:55', '2024-11-25 13:32:55'),
(12, 'Andrei Tocol', 'tocstocs08@gmail.com', NULL, '117206071791309151498', '$2y$10$p.gJXMV6kg9MuXhkua1aXuumSAPbYG.s5WvJa5R0S7sdZ1srkI5ya', 'student', '1', '8W1oX352W837cu4XipqDBSqQy4Q3mZarxbjGHbkIU31JzEhxQ6cmtkMyuzKF', '2024-11-25 14:03:12', '2024-11-25 14:03:28'),
(13, 'Mhelron', 'aaronsalcedo52@gmail.com', NULL, '117924425773663003719', '$2y$10$lvt6dCcf2oRcu10ciz26KuOnYmjNrfnpCMQe7.A4no5PLu15xWXsC', 'student', '1', 'u0krhiLDwq4jR3cakGrW00jWlMyWrwH4PjBiVPsxCVQvG2Jx3Nwcc5KqLHLJ', '2024-11-25 15:36:53', '2024-11-25 15:36:53'),
(14, 'Geo De Leon', 'geodeleon301@gmail.com', NULL, '106704371325745101819', '$2y$10$lJ2zXiHM2/xDRmMZ4iLSJevkcQBoOYj1kYbOZ/42m7VUvCGPEi4qa', 'student', '1', '71FcPOXOeUhYkBFqBxIC5tT7zBuDTrVpwLgneVlc0W3JVcqYKiRGLVbHA6vz', '2024-11-26 06:54:39', '2024-11-26 06:54:57'),
(15, 'Rose Anne Dagta', 'roseannedagta984@gmail.com', NULL, '106934905272420144947', '$2y$10$q694JOTvpUQn9gnY2.TrEuFQSyjnGDvIPAP5RHV4./q9amTmiHSPm', 'student', '1', 'o4NYz1ThIGkRKl2Ckg8ieuxhrPYmKUVScpbv8CjUDZjNLlaFk7Bi5oXK64Ex', '2024-11-26 07:39:17', '2024-11-26 07:39:17'),
(16, 'Marklou Rosqueta', 'loukramtech02@gmail.com', NULL, '106793419705120256517', '$2y$10$qIGtritoXnmgTStxOUmv2O./Yiim1jnuEcTJke/HTUvrXSbVRHN9e', 'student', '1', 'wzbVCANLb4ggTDS6CzEESBSAnGbApfXUqmHTGnwSow53VRYwuF8Ya8Da9czR', '2024-11-26 09:59:03', '2024-11-26 09:59:03'),
(17, 'Junil toledo', 'toledojonel557@gmail.com', NULL, '102605668188768116142', '$2y$10$fmNgZd4Bf9WfKOM9q2xIsObTkyvstqwdofPhmO9BkwbjRuoXY6IhS', 'student', '1', 'JDseTLpEx5EuBYTVEhA5LYWkhA184bdJ6EFZlarH4ibnvxuFGT6BBQXCVFjH', '2024-11-26 16:07:21', '2024-11-26 16:07:21'),
(18, 'Grace Ann Gonzales', 'graceann.gonzales0122@gmail.com', NULL, '114206297437063589710', '$2y$10$s.o4gL/D6.fjq66VTW0HLeqfJlnEHUAbWJSsHz.f4GPjY.6fWEK.G', 'student', '1', '0Itm5b2HhEyf6MmJyzYyYFkAuvtbDbUKJUJPdx2ry2xNjCS6woBgfze7eRoZ', '2024-11-29 12:29:13', '2024-11-29 12:29:13');

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
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backupdatabase`
--
ALTER TABLE `backupdatabase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curricula`
--
ALTER TABLE `curricula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curricula_department_id_foreign` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_email_unique` (`email`);

--
-- Indexes for table `student_models`
--
ALTER TABLE `student_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_information`
--
ALTER TABLE `system_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usercontrols`
--
ALTER TABLE `usercontrols`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `backupdatabase`
--
ALTER TABLE `backupdatabase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `curricula`
--
ALTER TABLE `curricula`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_models`
--
ALTER TABLE `student_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `system_information`
--
ALTER TABLE `system_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usercontrols`
--
ALTER TABLE `usercontrols`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `curricula`
--
ALTER TABLE `curricula`
  ADD CONSTRAINT `curricula_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
