-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 12:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hki`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `client_name`, `api_key`, `created_at`, `updated_at`) VALUES
(1, 'PLC', 'q1ZycDKiERZANEtDXZSZWnFpTljgfwce', '2023-07-30 00:45:56', '2023-07-30 00:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_part`
--

CREATE TABLE `master_part` (
  `id_part` int NOT NULL,
  `id_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `part_no` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `part_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `composition` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `unit_price` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_part`
--

INSERT INTO `master_part` (`id_part`, `id_user`, `part_no`, `part_name`, `composition`, `unit_price`) VALUES
(1, '2', '271671', 'hikmat', '1', '100'),
(2, '3', '271671', 'hikmat', '182', '7888');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2014_10_12_134109_create_users_table', 1),
(3, '2014_10_12_134110_create_role_table', 1),
(4, '2014_10_12_134111_create_users_detail_table', 1),
(5, '2014_10_12_134112_create_purchasing_table', 1),
(6, '2014_10_12_134113_create_surat_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_07_01_153555_create_surat_supplier_table', 1),
(10, '2023_07_08_035118_create_purchasing_detail_table', 1),
(11, '2023_07_12_150333_create_stocks_table', 2),
(12, '2023_07_15_150025_create_productions_table', 3);

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
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productions`
--

CREATE TABLE `productions` (
  `id` bigint UNSIGNED NOT NULL,
  `line` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productions`
--

INSERT INTO `productions` (`id`, `line`, `shift`, `nilai`, `tanggal`) VALUES
(1, 'AXEL', 'I', 70, '2023-07-17'),
(2, 'AXEL', 'II', 70, '2023-07-17'),
(3, 'AXEL', 'III', 70, '2023-07-17'),
(4, 'C/MBER', 'I', 70, '2023-07-17'),
(5, 'C/MBER', 'II', 70, '2023-07-17'),
(6, 'C/MBER', 'III', 70, '2023-07-17'),
(7, 'YH4', 'I', 70, '2023-07-17'),
(8, 'YH4', 'II', 70, '2023-07-17'),
(9, 'YH4', 'III', 70, '2023-07-17'),
(10, 'Y4L', 'I', 70, '2023-07-17'),
(11, 'Y4L', 'II', 70, '2023-07-17'),
(12, 'Y4L', 'III', 70, '2023-07-17'),
(13, 'LH CVT', 'I', 70, '2023-07-17'),
(14, 'LH CVT', 'II', 70, '2023-07-17'),
(15, 'LH CVT', 'III', 70, '2023-07-17'),
(16, 'LH RH CVT', 'I', 70, '2023-07-17'),
(17, 'LH RH CVT', 'II', 70, '2023-07-17'),
(18, 'LH RH CVT', 'III', 70, '2023-07-17'),
(19, 'ROD', 'I', 70, '2023-07-17'),
(20, 'ROD', 'II', 70, '2023-07-17'),
(21, 'ROD', 'III', 70, '2023-07-17'),
(22, 'TM BODY', 'I', 70, '2023-07-17'),
(23, 'TM BODY', 'II', 70, '2023-07-17'),
(24, 'TM BODY', 'III', 70, '2023-07-17'),
(25, 'AMT  LVUV', 'I', 70, '2023-07-17'),
(26, 'AMT  LVUV', 'II', 70, '2023-07-17'),
(27, 'AMT  LVUV', 'III', 70, '2023-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id_po` bigint UNSIGNED NOT NULL,
  `po_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tujuan_po` int DEFAULT NULL,
  `default_supplier_id` bigint UNSIGNED DEFAULT NULL,
  `class` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_destination` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id_po`, `po_number`, `id_tujuan_po`, `default_supplier_id`, `class`, `issue_date`, `currency_code`, `id_destination`, `status`) VALUES
(408, 'HKI230490', 30030, 30030, 'SUBCON', '2023-08-06 07:16:13', 'IDR', NULL, 'Unsend');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing_details`
--

CREATE TABLE `purchasing_details` (
  `id` bigint UNSIGNED NOT NULL,
  `id_po` bigint UNSIGNED NOT NULL,
  `part_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` int DEFAULT NULL,
  `order_qty` int DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `composition` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint NOT NULL,
  `order_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasing_details`
--

INSERT INTO `purchasing_details` (`id`, `id_po`, `part_no`, `part_name`, `unit_price`, `order_qty`, `unit`, `composition`, `amount`, `order_number`, `delivery_time`) VALUES
(16145, 408, '4000A389-1', 'PLATE,UPPER', 3639, -20, 'PC', NULL, 2911200, 'PU00145764', '2023-07-03'),
(16146, 408, '4000A389-1', 'PLATE,UPPER', 3639, -20, 'PC', NULL, 2328960, 'PU00145765', '2023-07-04'),
(16147, 408, '4000A389-1', 'PLATE,UPPER', 3639, 30, 'PC', NULL, 2328960, 'PU00145766', '2023-07-05'),
(16148, 408, '4000A389-1', 'PLATE,UPPER', 3639, 20, 'PC', NULL, 2328960, 'PU00145767', '2023-07-06'),
(16149, 408, '4000A389-1', 'PLATE,UPPER', 3639, 560, 'PC', NULL, 2911200, 'PU00145768', '2023-07-07'),
(16150, 408, '4000A389-1', 'PLATE,UPPER', 3639, 560, 'PC', NULL, 2911200, 'PU00145769', '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin HKI'),
(2, 'Admin Subcon'),
(3, 'Admin Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id_sisa` bigint UNSIGNED NOT NULL,
  `no_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty_requested` int NOT NULL,
  `qty_sent` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `sisa` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id_sisa`, `no_surat`, `part_name`, `order_number`, `qty_requested`, `qty_sent`, `tanggal`, `sisa`) VALUES
(208, '1/DO-SI/08/2023', 'PLATE,UPPER', 'PU00145768', 580, 20, '2023-08-07', 560),
(209, '1/DO-SI/08/2023', 'PLATE,UPPER', 'PU00145768', 580, 20, '2023-08-07', 560),
(210, '2/DO-SI/08/2023', 'PLATE,UPPER', 'PU00145769', 580, 20, '2023-08-07', 560);

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` bigint NOT NULL,
  `no_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `po_number` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `no_surat`, `tanggal`, `po_number`, `pengirim`, `penerima`, `status`, `tanggal_terbit`) VALUES
(1, '1/DO-SI/08/2023', '2023-08-07 00:00:00', 'HKI230490', 'MIYUKI INDONESIA', 'admin HKI', 'On Progress', '2023-08-07'),
(2, '2/DO-SI/08/2023', '2023-08-07 00:00:00', 'HKI230490', 'MIYUKI INDONESIA', 'admin HKI', 'On Progress', '2023-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `surat_details`
--

CREATE TABLE `surat_details` (
  `id_detail_surat` int NOT NULL,
  `no_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_no` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_details`
--

INSERT INTO `surat_details` (`id_detail_surat`, `no_surat`, `part_no`, `part_name`, `qty`, `unit`, `order_number`) VALUES
(154, '1/DO-SI/08/2023', '4000A389-1', 'PLATE,UPPER', '20', 'PC', 'PU00145768'),
(155, '2/DO-SI/08/2023', '4000A389-1', 'PLATE,UPPER', '20', 'PC', 'PU00145769');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `role_id`, `password`, `created_at`) VALUES
(1, 'hki', 'admin HKI', '1', '$2a$12$NP61H8qRLkmw5aqNaa2OfuEntASvkqCXD9NfE3l8kPeqj6ndDNIni', NULL),
(2, 'miyuki', 'MIYUKI INDONESIA', '2', '$2y$10$uTjUoQ9zjpQMckrzaOvO6.uvHXSQjA3XJZbRCTJNPB6bUVMg4gatW', '17-07-2023'),
(3, 'JFE', 'JFE SHOJI STEEL INDONESIA', '3', '$2y$10$DKZW8nBhoMHdfOPsK2WrZOcNzFdp3swgCc4v251d1irI0cyX1LU/q', '17-07-2023');

-- --------------------------------------------------------

--
-- Table structure for table `users_detail`
--

CREATE TABLE `users_detail` (
  `id_detail` bigint UNSIGNED NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_detail`
--

INSERT INTO `users_detail` (`id_detail`, `id_user`, `id_perusahaan`, `class`, `email`, `telepon`, `fax`, `alamat`, `user_date`) VALUES
(1, '1', 1, 'HKI', 'admin@hki.co.id', '087778896543', '123456654321', 'Karawang', NULL),
(4, '2', 30030, 'SUBCON', 'MIYUKIINDONESIA@gmail.com', '02189119670', '02189119670', 'KAWASAN INDUSTRI KIIC KARAWANG JL MALIGI VII LOT.Q-1B, Jawa Barat 41361', '17-07-2023'),
(5, '3', 50010, 'SUPPLIER', 'jfe@gmail.com', '0218980903', '0218980903', 'Kawasan Industri MM 2100 Blok B-4/2, Jalan Kalimantan 1, Cibitung, Gandamekar, Bekasi, Kabupaten Bekasi, Jawa Barat 17530', '17-07-2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `master_part`
--
ALTER TABLE `master_part`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id_po`);

--
-- Indexes for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchasing_details_id_po_foreign` (`id_po`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_sisa`),
  ADD KEY `stocks_id_po_foreign` (`no_surat`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`no_surat`);

--
-- Indexes for table `surat_details`
--
ALTER TABLE `surat_details`
  ADD PRIMARY KEY (`id_detail_surat`),
  ADD KEY `surat_details_no_surat_index` (`no_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productions`
--
ALTER TABLE `productions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id_po` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16151;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_sisa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `surat_details`
--
ALTER TABLE `surat_details`
  MODIFY `id_detail_surat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id_detail` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD CONSTRAINT `purchasing_details_id_po_foreign` FOREIGN KEY (`id_po`) REFERENCES `purchasing` (`id_po`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
