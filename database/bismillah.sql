-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2025 at 06:31 AM
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
-- Database: `bismillah`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_platform`
--

CREATE TABLE `akun_platform` (
  `id_akun` bigint(20) UNSIGNED NOT NULL,
  `id_platform` bigint(20) UNSIGNED NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun_platform`
--

INSERT INTO `akun_platform` (`id_akun`, `id_platform`, `nama_akun`, `created_at`, `updated_at`) VALUES
(1, 4, 'lampungprovgoid', '2025-07-08 06:50:21', '2025-07-10 07:57:03'),
(2, 4, 'diskominfotik.lampung', '2025-07-08 06:51:32', '2025-07-10 07:57:10'),
(3, 5, 'Diskominfotik ProvLampung', '2025-07-08 07:21:57', '2025-07-08 07:21:57'),
(4, 6, 'ppid.lampungprov', '2025-07-08 07:22:33', '2025-07-08 07:22:33'),
(6, 6, 'diskominfotik.lampungprov', '2025-07-08 07:24:05', '2025-07-08 07:24:05'),
(9, 1, 'Kominfo.lampung', '2025-07-21 23:23:33', '2025-07-21 23:23:33'),
(14, 1, 'pemprov.lampung', '2025-07-28 20:08:39', '2025-07-28 20:08:39'),
(16, 4, 'kominfotik.lampung', '2025-07-31 20:34:21', '2025-07-31 20:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `arsip_konten`
--

CREATE TABLE `arsip_konten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_platform` bigint(20) UNSIGNED NOT NULL,
  `id_akun` bigint(20) UNSIGNED NOT NULL,
  `id_tema` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `like` int(10) UNSIGNED DEFAULT NULL,
  `view` int(10) UNSIGNED DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arsip_konten`
--

INSERT INTO `arsip_konten` (`id`, `id_platform`, `id_akun`, `id_tema`, `judul`, `tanggal`, `jam`, `like`, `view`, `gambar`, `created_at`, `updated_at`) VALUES
(16, 4, 2, 4, 'Gubernur Rahmat Mirzani Djausal bersama keluarga melaksanakan Salat Idul Adha 1446 H / Tahun 2025, di Lapangan Saburai', '2025-06-07', '09:00:00', 0, 0, 'arsip/gswhvw7tikJN1EgikNXI5h5MzUXrKuYQP7D6WMQO.png', '2025-07-13 18:14:49', '2025-07-24 20:26:18'),
(17, 5, 3, NULL, 'Bapenda Provinsi Lampung mengucapkan selamat memperingati Hari Lahir Pancasila 1 Juni 2025 \"Memperkokoh Ideologi Pancasila, Menuju Indonesia Raya\".', '2027-02-14', '12:00:00', NULL, NULL, 'arsip/hvl60YG204hD8ou0Y7IcWk8OQshcjiFpZTE0QnCS.png', '2025-07-13 18:21:43', '2025-07-13 18:21:43'),
(20, 4, 1, 2, 'pemutihan pajak', '2025-07-14', '08:00:00', 109, 1111, 'arsip/L7PrFQDemCePiO1iylWmjmEuhetntLE3n6NvuPHs.jpg', '2025-07-13 19:00:14', '2025-07-15 00:22:59'),
(24, 4, 2, 2, 'Program Pemutihan dengan membayar pajak kendaraan tahunan atau perpanjangan STNK 5 tahunan di Bandar Lampung .', '2025-07-15', '12:00:00', 202, 300, 'arsip/bUwaBJKansgGbZmA4iLqqZvzNsyI2HClnzOaI8e4.jpg', '2025-07-14 23:50:48', '2025-07-14 23:50:48'),
(25, 5, 3, 1, 'Pemerintah Provinsi Lampung menggelar Upacara Peringatan Hari Lahir (Harlah) Pancasila ke-80 Tahun 2025 bertempat di Lapangan Korpri', '2025-07-15', '12:00:00', 100, 111, 'arsip/6W6HPXlmmJFIdCNHrdGiaONSiZUTL7lqQHI81dru.jpg', '2025-07-14 23:56:06', '2025-07-15 01:45:50'),
(26, 4, 1, 1, 'Ayo segera manfaatkan Pemutihan Pajak Kendaraan bermotor yang telah diimulai tanggal 1 Mei s/d 31 Juli 2025', '2025-07-31', '12:00:00', 11, 12, 'arsip/f1s3MWcHDT1oTwedPHLolO9pCZ2n86afnK6HlAmO.jpg', '2025-07-15 01:46:25', '2025-07-15 01:46:54'),
(29, 6, 4, 1, 'Pelantikan Ketua Palang Merah Indonesia (PMI) Provinsi Lampung Masa Bhakti 2025–2030', '2025-07-01', '09:03:00', 100, 100, 'arsip/JRlTJPmPSSifv9dRUNEbROwRssnHtjLKIN2mdJ9h.jpg', '2025-07-20 19:15:57', '2025-07-20 19:20:47'),
(30, 6, 4, 1, 'Infografis Sekolah Kedinasan', '2025-07-01', '11:40:00', 11, 12, 'arsip/H8pNkjkvB2g3alrCXL7Y2cIBD6qUBkbDYWGOhuRm.jpg', '2025-07-20 19:20:32', '2025-07-20 19:20:32'),
(31, 6, 4, 1, 'Pemprov Lampung Apresiasi Bank Indonesia Sebagai Mitra Strategis, Dorong Ekonomi Inklusif dan Stabil di Lampung', '2025-07-02', '10:47:00', 12, 13, 'arsip/QmiyQI8t4QuUf4Brv7JTlkObHTw8qmUAvGD5ZHOb.jpg', '2025-07-20 19:22:19', '2025-07-20 19:27:50'),
(32, 6, 4, 4, 'Dukung Kawasan Tanpa Rokok di Sekitarmu', '2025-07-02', '13:10:00', 10, 9, 'arsip/1z9ZHv7EZFPovo0qfj9bG7U7uHScEGLx4tHra7F8.jpg', '2025-07-20 19:26:58', '2025-07-20 19:28:09'),
(33, 6, 4, 4, 'Ke DPR RI, Gubernur Mirza Perjuangkan Aspirasi Petani Singkong Lampung', '2025-07-03', '09:14:00', 12, 13, 'arsip/MrYbHbQ9kp6zqURp2JS5Z8Mztd4BBDmIvvQhqMzX.jpg', '2025-07-20 19:29:19', '2025-07-20 19:29:19'),
(34, 6, 4, 4, 'Selama 2018–2024, Provinsi Lampung Berkontribusi Dalam Program Transmigrasi Nasional', '2025-07-03', '11:21:00', 12, 21, 'arsip/zEcgogeWGwDiy2My3RZqddqyr8YthcYIGX69dk74.jpg', '2025-07-20 19:30:38', '2025-07-20 19:30:38'),
(35, 6, 4, 4, 'Hilirisasi Komoditas Unggulan Lampung Jadi Fokus Pertemuan Gubernur dan Menperin', '2025-07-04', '09:46:00', 19, 20, 'arsip/LAk1QawykXMynjIXO8aFsQsHdb0p161AM20Q1yV6.jpg', '2025-07-20 19:32:18', '2025-07-20 19:32:18'),
(36, 6, 4, 6, 'Lampung Dukung Energi Terbarukan, Groundbreaking Eksplorasi Gunung Tiga Resmi Dimulai', '2025-07-04', '11:02:00', 20, 20, 'arsip/ZcRMfqZpYJ2DP4ivrwPVGDKyr4r3HLNd357V7vap.jpg', '2025-07-20 19:33:49', '2025-07-20 19:33:49'),
(37, 6, 4, 6, 'Pemprov Lampung Dorong Transparansi dan Investasi Lewat Dua Raperda Strategis', '2025-07-05', '08:54:00', 13, 11, 'arsip/1H7Kw2KnscBcZE0FxY78Lx5XefIqxaPPVinHKBhr.jpg', '2025-07-20 19:39:00', '2025-07-20 19:39:00'),
(38, 6, 4, 1, 'Mengenal Program Sekolah Rakyat', '2025-07-05', '11:00:00', 12, 13, 'arsip/jHPSWmmgp2TAXTXUFXuKV3QIwUyn2VNZOIKyYkvN.jpg', '2025-07-20 19:40:09', '2025-07-20 19:40:09'),
(39, 6, 4, 4, 'Rata-Rata Pengeluaran Masyarakat Lampung Setiap Bulan', '2025-07-06', '10:00:00', 10, 10, 'arsip/XpaSgo9PT99CQY2RvyO2DEig4FAPokpOlrepLGrB.jpg', '2025-07-20 19:41:17', '2025-07-20 19:41:17'),
(40, 6, 4, 4, 'Penyerahan SK PPPK Pemprov Lampung Paling Lambat Akhir Juli 2025', '2025-07-06', '11:02:00', 2, 3, 'arsip/eaBvGsqyEfsfVtlPyyW9wXzfbpnGw6OJoQbImEp6.jpg', '2025-07-20 19:42:27', '2025-07-20 19:42:27'),
(41, 6, 4, 4, 'Jadwal Lengkap Pendaftaran Sekolah Kedinasan Tahun 2025', '2025-07-07', '09:00:00', 4, 5, 'arsip/Le6FAFSCUIbZPiJBWwcWhcAQkdvfZhMHqfOqQZDC.jpg', '2025-07-20 19:44:58', '2025-07-20 19:44:58'),
(42, 6, 4, 4, 'Mangga Isem Kumbang, Varietas Lokal Provinsi Lampung', '2025-07-07', '10:59:00', 11, 11, 'arsip/SmImx8bEQB8h58llOzWsyQe2k3PZdHQ4S7B2pi9s.jpg', '2025-07-20 19:49:02', '2025-07-20 19:49:02'),
(43, 6, 4, 4, 'Petai Pakhi Manis, Varietas Lokal Provinsi Lampung', '2025-07-08', '09:19:00', 11, 13, 'arsip/KsiOmJmpvCm1nmvtqWxJxy0WUgFlXIz4yTQeeG8Q.jpg', '2025-07-20 19:50:04', '2025-07-20 19:50:04'),
(44, 6, 4, 4, 'Pisang Muli, Varietas Lokal Provinsi Lampung', '2025-07-08', '10:57:00', 10, 14, 'arsip/zwe7oIlf641SE5maerCqoMxPYrks4vheklU9QRcL.jpg', '2025-07-20 19:51:22', '2025-07-20 19:51:22'),
(45, 6, 4, 1, 'Gerakan Makan 2 Butir Telur Sehari, Berapa Gizinya?', '2025-07-09', '11:04:00', 11, 4, 'arsip/12zXJF0EEIZcQWKVVuc4zpdakinJzrwQ1w9rAIgx.jpg', '2025-07-20 19:53:23', '2025-07-20 19:53:23'),
(46, 6, 4, 4, 'Pemerintah Provinsi Lampung menggelar Upacara Peringatan Hari Lahir (Harlah) Pancasila ke-80 Tahun 2025 bertempat di Lapangan Korpri', '2025-08-01', '12:00:00', 12, 13, 'arsip/0JakFEgaPm7KFibzuV9YhbL7sGhPlCCqTwuociRi.png', '2025-07-28 21:35:52', '2025-07-28 21:35:52'),
(47, 6, 4, 4, 'Tren Kepegawaian Negeri Sipil di Lingkungan Pemerintah Provinsi Lampung (2020–2024)', '2025-09-30', '12:00:00', 12, 15, 'arsip/joGaNxSpJcdqDRKGqTxubRCYwq4kcXSUd43DRUHr.jpg', '2025-07-29 17:24:20', '2025-07-29 17:24:20');

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
(5, '2025_07_06_043151_add_role_to_users_table', 1),
(6, '2025_07_08_122514_create_platform_table', 2),
(7, '2025_07_08_132955_create_akun_platform_table', 3),
(8, '2025_07_08_150338_create_arsip_konten_table', 4),
(10, '2025_07_14_025150_create_tema_konten_table', 5),
(11, '2025_07_15_021648_add_like_view_to_arsip_konten_table', 6);

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
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `id_platform` bigint(20) UNSIGNED NOT NULL,
  `nama_platform` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`id_platform`, `nama_platform`, `created_at`, `updated_at`) VALUES
(1, 'Tiktok', '2025-07-08 06:11:12', '2025-07-17 00:56:33'),
(4, 'Instagram', '2025-07-08 06:19:32', '2025-07-08 06:19:32'),
(5, 'Facebook', '2025-07-08 06:19:43', '2025-07-08 06:19:43'),
(6, 'Website', '2025-07-08 06:20:08', '2025-07-08 06:20:08'),
(12, 'Twitter', '2025-07-24 18:25:17', '2025-07-24 18:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tema_konten`
--

CREATE TABLE `tema_konten` (
  `id_tema` bigint(20) UNSIGNED NOT NULL,
  `nama_tema` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tema_konten`
--

INSERT INTO `tema_konten` (`id_tema`, `nama_tema`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', '2025-07-14 18:03:23', '2025-07-21 23:18:51'),
(4, 'Ekonomi', '2025-07-20 18:10:10', '2025-07-20 18:10:10'),
(6, 'Pariwisata', '2025-07-20 18:13:47', '2025-07-20 18:13:47'),
(7, 'Sosial', '2025-07-21 23:14:57', '2025-07-21 23:34:04'),
(9, 'Budaya', '2025-07-21 23:35:01', '2025-07-21 23:35:01'),
(10, 'Kesehatan', '2025-07-24 18:40:22', '2025-07-24 18:40:22'),
(15, 'Perikanan', '2025-07-31 20:34:44', '2025-07-31 20:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'operator',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'ppidutamalampung@gmail.com', NULL, '$2y$10$iOoMqVLemWtyvi0yN.FB4Ox5bOvO/450o5THHgWTWpvfw/9pJb4Va', 'admin', NULL, '2025-07-05 22:36:20', '2025-07-15 19:16:40'),
(3, 'Publi', 'operatorplip', 'mentor1@example.com', NULL, '$2y$10$gIzRbBew23V1ZEszs3VlQuec/1mc1nwWzCfuXwwa/Onh5aDg1j4uu', 'operator', NULL, '2025-07-08 06:21:37', '2025-07-29 19:26:55'),
(5, 'Plip', 'plip11', 'mentor@gmail.com', NULL, '$2y$10$aijree2qi/kT2gTTyqt3.eFoMBFyR5WgaxSl32HUn6IsWjQB5VTOe', 'operator', NULL, '2025-07-15 19:40:40', '2025-07-16 23:20:49'),
(10, 'kominfotik', 'operator', 'operator@gmail.com', NULL, '$2y$10$Nsf7okyVrQ4Ejggh8XAthelzCtPanzAnPHk7CymAgk.jja5xtjBgi', 'operator', NULL, '2025-07-31 20:35:43', '2025-07-31 20:35:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_platform`
--
ALTER TABLE `akun_platform`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `akun_platform_id_platform_foreign` (`id_platform`);

--
-- Indexes for table `arsip_konten`
--
ALTER TABLE `arsip_konten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arsip_konten_id_platform_foreign` (`id_platform`),
  ADD KEY `arsip_konten_id_akun_foreign` (`id_akun`);

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
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`id_platform`);

--
-- Indexes for table `tema_konten`
--
ALTER TABLE `tema_konten`
  ADD PRIMARY KEY (`id_tema`);

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
-- AUTO_INCREMENT for table `akun_platform`
--
ALTER TABLE `akun_platform`
  MODIFY `id_akun` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `arsip_konten`
--
ALTER TABLE `arsip_konten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
  MODIFY `id_platform` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tema_konten`
--
ALTER TABLE `tema_konten`
  MODIFY `id_tema` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun_platform`
--
ALTER TABLE `akun_platform`
  ADD CONSTRAINT `akun_platform_id_platform_foreign` FOREIGN KEY (`id_platform`) REFERENCES `platform` (`id_platform`) ON DELETE CASCADE;

--
-- Constraints for table `arsip_konten`
--
ALTER TABLE `arsip_konten`
  ADD CONSTRAINT `arsip_konten_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `akun_platform` (`id_akun`) ON DELETE CASCADE,
  ADD CONSTRAINT `arsip_konten_id_platform_foreign` FOREIGN KEY (`id_platform`) REFERENCES `platform` (`id_platform`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
