-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 08:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repositorydb`
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

INSERT INTO `archives` (`id`, `archive_code`, `category`, `department_id`, `curriculum_id`, `year`, `title`, `abstract`, `members`, `adviser`, `banner_path`, `document_path`, `status`, `student_id`, `slug`, `count_rank`, `google_id`, `created_at`, `updated_at`) VALUES
(3, '318109', 'Capstone/Thesis', 1, 4, '2020', 'payroll system', '<p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>', '<ol><li>lus deguzman</li><li>may ramos</li><li>agnes madrigal</li><li>angie apel</li></ol>', 'estilla estaneslao', '1729454032.jpg', '1729454032.pdf', 1, 5, 'payroll-system', 9, '102605668188768116142', '2024-10-20 11:53:52', '2024-11-19 22:46:12'),
(4, '1253350403', 'Capstone/Thesis', 1, 3, '2024', 'OPS', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<ol><li>Tesy</li><li>carl</li><li>mike</li></ol>', 'Sir Tan', '1730534144.png', '1730534144.pdf', 1, 5, 'ops', 7, '102605668188768116142', '2024-11-01 23:55:44', '2024-11-19 22:46:06'),
(5, '2020530952', 'Project', 1, 3, '2024', 'laundry system', '<p>this My System</p>', '<p>nel</p>', 'john doe', '1731951210.jpeg', '1731951210.pdf', 0, 2, 'laundry-system', 0, '102605668188768116142', '2024-11-18 09:33:30', '2024-11-18 09:59:49'),
(6, '305217157', 'Research', 2, 4, '2022', 'inventory system', '<p>this is my inventory system</p>', '<p>john rick</p>', 'kenley carmen', '1731951791.jpeg', '1731951791.pdf', 0, 2, 'inventory-system', 0, '102605668188768116142', '2024-11-18 09:43:11', '2024-11-18 09:43:11'),
(7, '508068427', 'Project', 1, 3, '2024', 'test', '<p>wfasgrysgsfaw</p>', '<p>wrawfsfdfef</p>', 'defsdf', '1732167327.png', '1732167327.pdf', 0, 3, 'test', 0, '104144111589295803981', '2024-11-20 21:35:27', '2024-11-20 21:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `curricula`
--

CREATE TABLE `curricula` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curricula`
--

INSERT INTO `curricula` (`id`, `department_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 1, 'BSIS', 'Bachelor of Science in Information Systems', NULL, '2024-11-03 01:58:58'),
(4, 2, 'BSIT', 'Bachelor of Science in Information Technology', NULL, NULL),
(5, 1, 'HRM', 'this is about cooking course', '2024-11-03 01:47:09', '2024-11-03 01:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'College of Industrial Technology', 'Develop world-class industrial workers and middle-level managers equipped with scientific knowledge, technological skills, and ethical work values to achieve a desirable quality of life.', NULL, '2024-11-03 00:57:49'),
(2, 'College of Education', 'Implement Teacher Education Programs for the elementary and secondary levels and endeavor to achieve quality and excellence, relevance and responsiveness, equity and access, and efficiency and effectiveness in instruction, research, extension, and product', NULL, NULL);

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
(1, 'staff', 's', 'staff', 'lib@gmail.com', NULL, '$2y$10$.sajg8z9aZJXGUvRDMnR9eILj9EaQ5xY6S2zgVJNFFOHbPKzXjtVq', 'active', NULL, '2024-11-20 07:26:00', '2024-11-20 21:17:04'),
(3, 'Faculty', NULL, 'staff', 'faculty@gmail.com', NULL, '$2y$10$uDSs/l77qGzCGSp5b/pCF.zcza9aLuuhQsSXER3fAmqcLvAvzCQ7m', 'active', NULL, '2024-11-19 23:30:38', '2024-11-19 23:34:37'),
(6, 'test', NULL, 'test', 'test@gmail.com', NULL, '$2y$10$EPn5r.ADyrqVv2zm7zKEneSk367dQDOhujH6JSljy/6Jjjmp/RTNq', 'active', NULL, '2024-11-20 21:20:42', '2024-11-20 21:20:58');

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

--
-- Dumping data for table `student_models`
--

INSERT INTO `student_models` (`id`, `fullname`, `email`, `password`, `department_id`, `curriculum_id`, `role`, `status`, `google_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'archives', 'archives@gmail.com', '$2y$10$ALRAgDOc2AUvNm8qicRvvuCq6cMISLYYIC8vFAAt1XDYnd.x68iUq', 2, 3, 'student', 1, NULL, NULL, '2024-10-13 08:28:29', '2024-11-04 00:43:00');

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
(1, 'STI Web-Based Repository System', 'Repository System', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', 'sti@gmail.com', '09789999999', '289 L. de Guzman Street, Concepcion I, Marikina City, 1807 Metro Manila', NULL, '2024-11-20 21:23:41');

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
(3, 6, 0, 1, 0, '2024-11-21 10:13:46', '2024-11-21 10:13:46');

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
(2, 'Geo De Leon', 'dgeo7212@gmail.com', NULL, '116263033900147419063', '$2y$10$Ygikdlxlcg.4GuG3XapVLOGK3zuqnw.GBiQQwrngOqRau/OVuCjni', 'student', '1', 'GMTzqiNp2EoirmuLnv4ATzEFh5eib7IY9pTN1ZgBqe4xBTedURLlcXYg0mTE', '2024-11-19 04:56:49', '2024-11-21 07:43:59'),
(3, 'Alexander Josh Bea', 'alexander951bea@gmail.com', NULL, '104144111589295803981', '$2y$10$oNtOOWftKPPBNYxXKT3FJO/Pvho/tPetU3RX/ZlmO9HkwoHheK8kW', 'student', '1', '9jBXo8s1tp9cjPzk70segZhLQRfNIQwb2Bws30J0xkOpSa6fbcbdwtAABPe3', '2024-11-20 21:32:52', '2024-11-20 21:32:52'),
(5, 'Junil toledo', 'toledojonel557@gmail.com', NULL, '102605668188768116142', '$2y$10$SniGhzwMd3UR9Em8le.ype9wG9d4Sd4G2UN1rTYYdahwUkBmMjSgS', 'student', '1', 'NSppNNjJVNJrerF3qXVwVyt2WMFsq6vDkgu9eMBL4jKdKRJKPpXinQm9oYWm', '2024-11-21 07:13:05', '2024-11-21 07:13:05');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `curricula`
--
ALTER TABLE `curricula`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
