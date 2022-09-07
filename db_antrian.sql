-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 03:06 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_22_035810_create_pasien_table', 2),
(6, '2021_09_22_040141_create_nomor_antrian_table', 3),
(7, '2021_09_22_040248_create_poli_table', 4),
(8, '2021_09_22_040334_create_petugas_table', 4),
(9, '2021_10_16_070308_create_record_antrian_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian`
--

CREATE TABLE `nomor_antrian` (
  `id_antrian` int(10) UNSIGNED NOT NULL,
  `nomor_antrian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `status_antrian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nomor_antrian`
--

INSERT INTO `nomor_antrian` (`id_antrian`, `nomor_antrian`, `id_poli`, `id_pasien`, `status_antrian`, `created_at`, `updated_at`) VALUES
(5, 'GIG001', 1, 12, 2, '2022-03-21 13:48:07', NULL),
(6, 'KIA001', 2, 12, 2, '2022-03-21 13:50:15', NULL),
(7, 'GIG002', 1, 13, 2, '2022-03-21 13:48:07', NULL);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id_poli` int(10) UNSIGNED NOT NULL,
  `nama_poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_poli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id_poli`, `nama_poli`, `status_poli`, `created_at`, `updated_at`) VALUES
(1, 'POLI GIGI', 1, '2021-10-07 22:07:55', '2021-10-07 22:07:55'),
(2, 'POLI KIA', 1, '2021-10-07 22:16:22', '2021-10-07 22:16:22'),
(3, 'POLI UMUM', 1, '2021-10-07 22:18:03', '2021-10-07 22:18:03'),
(4, 'POLI HATI', 0, '2021-10-11 19:02:52', '2021-10-11 19:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `record_antrian`
--

CREATE TABLE `record_antrian` (
  `id_record` int(10) UNSIGNED NOT NULL,
  `id_antrian` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `record_antrian`
--

INSERT INTO `record_antrian` (`id_record`, `id_antrian`, `id_poli`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2022-03-21 14:01:40', NULL),
(2, 7, 1, '2022-03-21 14:01:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int(255) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nik`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 123456, 'a@a.com', '2021-09-21 19:52:36', '$2y$10$lDm42EUOEz2QyLvQJ45z6O6zsEmpEMJbzpvC9pY25sn4kq6XUwVh2', 1, NULL, '2021-09-21 19:52:37', '2021-09-21 19:52:37'),
(2, 'dipta ikromi m', 11234, '', NULL, '$2y$10$vmiWnndKJBEyXaKYs0mLyuCVC5eQPYNdYBFdO6BBF2UDleUDE0CmK', 3, 'LAbeNbKuh4hz4r8rbwSY35mEJGyl3sUJoBCPPKVm0rSDVEebEni7Hiwrgtkn', '2021-10-11 19:15:57', '2021-10-11 19:15:57'),
(3, 'alexander', 111111, '', NULL, '$2y$10$7FUSAacFzJHQGtYwB4N5uuOcrpCesmaoU8q4mSnFlOXtuxo93gwWm', 3, NULL, '2021-10-14 22:02:21', '2021-10-14 22:02:21'),
(4, 'petugas 1', 222222, '', NULL, '$2y$10$QN9DU6HXu9z0y1feouKN1e0Ssj4I75gjZQqP/cdC06SOfcs3hdfDO$2y$10$vmiWnndKJBEyXaKYs0mLyuCVC5eQPYNdYBFdO6BBF2UDleUDE0CmK', 2, NULL, '2021-10-15 22:02:15', '2021-10-15 22:02:15'),
(5, 'ikromi', 333333, '', NULL, '$2y$10$Gyx0HU3jFR7aC4o3FnrxZ.2vDP9.jjfJdab6.jZdA9Eu9I3O.zafG', 3, NULL, '2021-10-16 04:34:19', '2021-10-16 04:34:19'),
(6, 'john', 444444, '', NULL, '$2y$10$VdaW3UmWuWoayHw9WTfQJ.PRtvm4zJCZQWVVcyt2UHAOAP1Y3mM.G', 3, NULL, '2021-10-16 10:53:35', '2021-10-16 10:53:35'),
(7, 'Supriyadi', 555555, '', NULL, '$2y$10$vb7i3NtK9Dp5GihmatsD0.4K1xgROFsoStCXrLOf5IsgJgIJmRBfK', 3, NULL, '2021-10-16 10:54:27', '2021-10-16 10:54:27'),
(8, 'Nick', 666666, '', NULL, '$2y$10$sfNFmni7QXhXrkB91PByBuebO0E3TsgsfQ/Iau6P4DgbzYNmmk6qi', 3, NULL, '2021-10-16 10:55:10', '2021-10-16 10:55:10'),
(9, 'Jatuh cinta', 852852, '', NULL, '$2y$10$zRI1e7Sq3FwrT47JyeHIr.q2/uTbzEBVif.6yu.5wC2fA42YKa9Mm', 3, NULL, '2022-01-31 03:10:43', '2022-01-31 03:10:43'),
(10, 'dipta', 171717, '', NULL, '$2y$10$ZBln8bE0bciMV01GgCanaeCrCiVucTIfHOQ65AXrY4PUS2i5pd.S2', 3, NULL, '2022-02-01 05:48:24', '2022-02-01 05:48:24'),
(11, 'test1', 123123, '', NULL, '$2y$10$q25q1n9e3fMUp7p9/R.Xn.MG4BDpWSYsdbWuxo6f2jTm4SaS0Xvaq', 2, NULL, '2022-03-21 05:35:06', '2022-03-21 05:35:06'),
(12, 'Pasien 1', 321321, 'jhadi0123@gmail.com', NULL, '$2y$10$lDm42EUOEz2QyLvQJ45z6O6zsEmpEMJbzpvC9pY25sn4kq6XUwVh2', 3, NULL, '2022-03-21 05:36:03', '2022-03-21 05:36:03'),
(13, 'Pasien 23', 222333, 'jhadi0123@gmail.com', NULL, '$2y$10$LZtOpF5hbc99QgvG/dozCOmu3fANDyHdP7f6sFxxE2R7gqAHQ6TcC', 3, NULL, '2022-03-21 06:12:33', '2022-03-21 06:12:33');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `record_antrian`
--
ALTER TABLE `record_antrian`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  MODIFY `id_antrian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id_poli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `record_antrian`
--
ALTER TABLE `record_antrian`
  MODIFY `id_record` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
