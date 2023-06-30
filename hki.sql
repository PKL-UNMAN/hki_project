-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2023 pada 05.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_purchasing_table', 1),
(2, '2014_10_12_000000_create_role_table', 1),
(3, '2014_10_12_000000_create_surat_table', 1),
(4, '2014_10_12_000000_create_users_detail_table', 1),
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing`
--

CREATE TABLE `purchasing` (
  `id_po` int(11) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `default_supplier_id` bigint(11) UNSIGNED DEFAULT NULL,
  `part_name` varchar(255) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `class` varchar(30) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `unit_price` int(70) NOT NULL,
  `amount` int(50) NOT NULL,
  `currency_code` varchar(20) NOT NULL,
  `delivery_time` datetime NOT NULL,
  `issue_date` varchar(30) NOT NULL,
  `order_number` varchar(128) NOT NULL,
  `composition` varchar(128) NOT NULL,
  `id_tujuan` int(11) NOT NULL,
  `id_destination` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchasing`
--

INSERT INTO `purchasing` (`id_po`, `part_no`, `default_supplier_id`, `part_name`, `order_qty`, `unit`, `class`, `po_number`, `unit_price`, `amount`, `currency_code`, `delivery_time`, `issue_date`, `order_number`, `composition`, `id_tujuan`, `id_destination`, `status`) VALUES
(1, '12', 3, '12', 12, '12', '12', '12', 12, 18, '', '2023-06-18 00:00:00', '', '', '', 0, 0, 'On Progress'),
(2, '14', 3, '14', 41, '41', '14', '14', 115, 18, '', '2023-06-20 00:00:00', '', '', '', 0, 0, 'On Progress'),
(3, '23', 2, '23', 23, '23', '23', '32', 12, 18, '', '2023-06-18 00:00:00', '', '', '', 0, 0, 'On Progress'),
(4, 'ds', 2, 'dfs', 34, '34', '10', '56', 40000, 5, '', '2023-06-15 00:00:00', '', '', '', 0, 0, 'On Progress'),
(5, '99', 3, 'Inwan', 4, 'KG', 'SUPPLIER', '89', 90, 900000, 'IDR', '2023-06-29 00:00:00', '25/6/2023', 'PO99', '9000', 3, 2, NULL),
(8, '91', 3, 'Tembaga', 4, 'KG', 'SUPPLIER', '90', 90, 900000, 'IDR', '2023-06-30 00:00:00', '25/6/2023 - 12.57.23', '91', '900', 3, 8, NULL),
(9, '92', 3, 'Perunggu', 90, 'KG', 'SUPPLIER', '90', 80, 810000, 'IDR', '2023-06-28 00:00:00', '25/6/2023 - 12.57.23', 'PO92', '900', 3, 8, NULL),
(10, '93', 3, 'Emas', 5, 'KG', 'SUPPLIER', '90', 90, 900000, 'IDR', '2023-06-30 00:00:00', '25/6/2023 - 12.57.23', 'PO93', '9000', 3, 8, 'On Progress'),
(11, '90', 3, 'Inwan', 89, 'kg', 'SUPPLIER', '90', 90, 720900, 'IDR', '2023-06-29 00:00:00', '25/6/2023 - 16.30.17', 'po90', '90', 3, 2, 'On Progress'),
(12, '90', 3, 'Bijih', 2, 'KG', 'SUPPLIER', '90', 90, 162000, 'IDR', '2023-06-30 00:00:00', '25/6/2023 - 16.32.08', 'PO90', '900', 3, 2, 'On Progress');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'HKI'),
(2, 'Subcon'),
(3, 'Supplier');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `no_surat` bigint(20) UNSIGNED NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `id_subcon` varchar(255) DEFAULT NULL,
  `id_tujuan` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `dibuat` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_supplier`
--

CREATE TABLE `surat_supplier` (
  `no_surat` bigint(20) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `id_pengirim` varchar(255) DEFAULT NULL,
  `id_tujuan` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_supplier`
--

INSERT INTO `surat_supplier` (`no_surat`, `po_number`, `id_pengirim`, `id_tujuan`, `tanggal`, `part_no`, `part_name`, `qty`, `unit`, `status`) VALUES
(1, '89', '3', '2', '30 juli 2023', '99', 'Inwan', '4', 'Kg', 'Finish');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `role_id`, `password`, `created_at`) VALUES
(1, 'hki', 'Admin HKI', '1', '$2a$12$DEQrrpCQ.shAVVdt2LC6tukIz80pP1Ev1MVCjsGAJnScfEVwjZI6m', NULL),
(2, 'subcon_bdg', 'Subcon Bandung', '2', '$2y$10$T2QHnzaH/CEEhvnjUSrtoujWKa4KXpMrxdEsK0rsnqW2Z45G60iCm', NULL),
(3, 'supplier_bdg', 'Supplier Bandung', '3', '$2a$12$DEQrrpCQ.shAVVdt2LC6tukIz80pP1Ev1MVCjsGAJnScfEVwjZI6m', NULL),
(7, 'supplier_sbg', 'Supplier Subang', '3', '$2a$12$DEQrrpCQ.shAVVdt2LC6tukIz80pP1Ev1MVCjsGAJnScfEVwjZI6m', NULL),
(8, 'subcon_sbg', 'Subcon Subang', '2', '$2y$10$T2QHnzaH/CEEhvnjUSrtoujWKa4KXpMrxdEsK0rsnqW2Z45G60iCm', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_detail`
--

CREATE TABLE `users_detail` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `user_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users_detail`
--

INSERT INTO `users_detail` (`id_detail`, `id_user`, `email`, `telepon`, `fax`, `alamat`, `user_date`) VALUES
(1, '1', 'hki@gmail.com', '021 88888', '021 88888', 'Subang', '30-05-2023'),
(2, '2', 'hki@gmail.com', '021 88888', '021 88888', 'Subang', '30-05-2023'),
(3, '3', 'hki@gmail.com', '021 88888', '021 88888', 'Subang', '30-05-2023');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `default_supplier_id` (`default_supplier_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`no_surat`);

--
-- Indeks untuk tabel `surat_supplier`
--
ALTER TABLE `surat_supplier`
  ADD PRIMARY KEY (`no_surat`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indeks untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `no_surat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `surat_supplier`
--
ALTER TABLE `surat_supplier`
  MODIFY `no_surat` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  ADD CONSTRAINT `purchasing_ibfk_1` FOREIGN KEY (`default_supplier_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
