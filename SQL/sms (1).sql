-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2018 at 06:11 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(10) UNSIGNED NOT NULL,
  `batch_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `batch_number`, `session`, `created_at`, `updated_at`) VALUES
(2, 'fds', 'df', '2018-01-12 04:29:33', '2018-01-12 04:29:33'),
(3, '18', '2013-2014', '2018-01-12 05:39:16', '2018-01-12 05:39:16');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_05_160852_create_user_roles_table', 1),
(4, '2018_01_12_100707_create_batches_table', 2),
(7, '2018_01_12_101835_create_students_table', 3),
(8, '2018_01_12_161149_create_semesters_table', 4),
(9, '2018_01_14_175748_create_subjects_table', 5),
(13, '2018_01_16_162536_create_user_personal_infos_table', 6),
(14, '2018_01_19_144229_create_subject_enrolls_table', 7),
(16, '2018_01_26_163852_create_student_enrolls_table', 8);

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
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(10) UNSIGNED NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester`, `created_at`, `updated_at`) VALUES
(1, '3', '2018-01-12 10:21:26', '2018-01-12 10:24:41'),
(3, '4', '2018-01-12 10:26:53', '2018-01-12 10:26:53'),
(4, '8', '2018-01-19 09:34:38', '2018-01-19 09:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` int(11) NOT NULL,
  `class_roll` int(11) NOT NULL,
  `exam_roll` int(11) NOT NULL,
  `reg_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `email`, `password`, `batch_id`, `class_roll`, `exam_roll`, `reg_no`, `gender`, `phone`, `blood_group`, `image`, `guardian`, `guardian_contact`, `is_present`, `is_active`, `created_at`, `updated_at`) VALUES
(3, '30401515598319', 'MIR HB RAHMAN', 'ahadcr0@gmail.com', '$2y$10$MKB3212Ru4ZMC3g/dS4D6eG7DlHD0KwFX.JNJaKu3rSF1UVgsuhS6', 3, 2, 545, 'GCE-2124/14', 1, '01954571053', 'A+', 'gce-2124141515765516.jpg', 'Myself', '01954571053', 1, 1, '2018-01-12 07:58:37', '2018-01-12 09:30:15'),
(5, '30401515598319', 'Test', 'test@gmail.com', '$2y$10$wFbahowhfQP2Eb9lctJc2.RtDE1OLU1YbLOR3/Z/5RGUGD3Xv8DKm', 3, 3, 344, 'GCE-2124/141', 2, '23432423423', 'O+', 'gce-21241411515770501.jpg', '533533', '5543343355', 1, 1, '2018-01-12 09:21:46', '2018-01-12 09:34:21'),
(6, '30401515598319', 'G54545545', 'ahadcr1@gmail.com', '$2y$10$mz2xzHlBmzQ8xN1uaI9mHuM28KqbLyWCq9mvvB3EoCxmq/sGIXDPO', 3, 33, 222, 'gggsd342', 1, '34324434535', 'A Positive', 'gggsd3421516872167.jpg', 'Sdfsdf', '23432443234', 1, 1, '2018-01-25 03:22:48', '2018-01-25 03:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrolls`
--

CREATE TABLE `student_enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `supervisor_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` int(10) UNSIGNED NOT NULL,
  `semester_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_enrolls`
--

INSERT INTO `student_enrolls` (`id`, `supervisor_id`, `batch_id`, `semester_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, '30401515598319', 3, 4, 3, NULL, NULL),
(2, '30401515598319', 3, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `user_id`, `type`, `name`, `code`, `credit`, `mark`, `created_at`, `updated_at`) VALUES
(1, '30401515598319', 1, 'test', 'test123', 3, 100, '2018-01-14 12:51:18', '2018-01-14 12:51:18'),
(3, '30401515598319', 2, 'Test Lab', 'LAB3434', 2, 50, '2018-01-14 13:19:35', '2018-01-19 07:55:04'),
(4, '30401515598319', 1, 'Test Lksdjf', 'TES DDD', 4, 100, '2018-01-19 08:02:37', '2018-01-19 08:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `subject_enrolls`
--

CREATE TABLE `subject_enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `supervisor_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_enrolls`
--

INSERT INTO `subject_enrolls` (`id`, `supervisor_id`, `semester_id`, `subject_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(6, '30401515598319', 4, 4, '30401515598319', '2018-01-20 11:16:47', '2018-01-20 11:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `verified`, `verification_token`, `role_id`, `is_active`, `is_admin`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
('23651515682452', 'Arif Hussion', 'test@gmail.com', '$2y$10$HI6RqdXlhqXPDL57LD3k4.oI1hSD6Xz6C61KUA7f4pG5SeW7sVHGi', 1, NULL, 1, 1, 0, 0, 'XDzzWiDjs0S3O5PpYCgZNZdI8uagy6EUwh1FqcQpFp4YE7ZrqQQ1pxuUvEL4', '2018-01-11 08:54:13', '2018-01-24 04:31:16'),
('30401515598319', 'MIR HB RAHMAN', 'ahadcr0@gmail.com', '$2y$10$wutlcTtkMSG313ZZ1kil4ugtjqWpZcpPZdXFiRMAbXkORhN73TWgu', 1, NULL, 1, 1, 1, 0, 'MZwznmGn4LYKp9lD6fQJFpwmG8OwDlt9oy00dJC0HEMfH8mmv5TZ6bRv3yt0', '2018-01-10 09:31:59', '2018-01-16 13:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_personal_infos`
--

CREATE TABLE `user_personal_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_personal_infos`
--

INSERT INTO `user_personal_infos` (`id`, `user_id`, `supervisor_id`, `designation`, `mobile`, `gender`, `blood_group`, `image`, `joining_date`, `about`, `created_at`, `updated_at`) VALUES
(4, '30401515598319', '30401515598319', 'Lecture', '23424324342', 1, 'A+', '01DKNfACdBBbY0mqdmaW1516199391.jpg', '2018-01-18', 'Sdf sdf sdf', '2018-01-17 08:11:54', '2018-01-17 08:29:51'),
(5, '23651515682452', '23651515682452', 'Lecture', '3232423423423', 1, 'A+', 'V4WcYCbuflnvAGmAPLJW1516783433.jpg', '2018-01-17', 'Sdfdsfsdf dsfsf', '2018-01-24 02:43:55', '2018-01-24 03:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'teacher', '2018-01-10 09:31:41', '2018-01-10 09:31:41'),
(3, 'test', '2018-01-12 10:30:14', '2018-01-12 10:30:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_user_id_index` (`user_id`),
  ADD KEY `students_exam_roll_index` (`exam_roll`),
  ADD KEY `students_reg_no_index` (`reg_no`),
  ADD KEY `class_role` (`class_roll`);

--
-- Indexes for table `student_enrolls`
--
ALTER TABLE `student_enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_user_id_index` (`user_id`);

--
-- Indexes for table `subject_enrolls`
--
ALTER TABLE `subject_enrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_enrolls_supervisor_id_index` (`supervisor_id`),
  ADD KEY `subject_enrolls_semester_id_index` (`semester_id`),
  ADD KEY `subject_enrolls_subject_id_index` (`subject_id`),
  ADD KEY `subject_enrolls_teacher_id_index` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`);

--
-- Indexes for table `user_personal_infos`
--
ALTER TABLE `user_personal_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_personal_infos_user_id_index` (`user_id`),
  ADD KEY `user_personal_infos_supervisor_id_index` (`supervisor_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_enrolls`
--
ALTER TABLE `student_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_enrolls`
--
ALTER TABLE `subject_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_personal_infos`
--
ALTER TABLE `user_personal_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `subject_enrolls`
--
ALTER TABLE `subject_enrolls`
  ADD CONSTRAINT `subject_enrolls_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `subject_enrolls_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `subject_enrolls_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `subject_enrolls_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_personal_infos`
--
ALTER TABLE `user_personal_infos`
  ADD CONSTRAINT `user_personal_infos_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_personal_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
