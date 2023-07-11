-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Waktu pembuatan: 10 Jul 2023 pada 14.35
-- Versi server: 5.7.41
-- Versi PHP: 8.1.17

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
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(10, '2023_07_08_035118_create_purchasing_detail_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing`
--

CREATE TABLE `purchasing` (
  `id_po` bigint(20) UNSIGNED NOT NULL,
  `po_number` int(11) NOT NULL,
  `id_tujuan_po` int(11) NOT NULL,
  `default_supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_destination` int(11) NOT NULL,
  `delivery_time` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchasing`
--

INSERT INTO `purchasing` (`id_po`, `po_number`, `id_tujuan_po`, `default_supplier_id`, `class`, `issue_date`, `currency_code`, `id_destination`, `delivery_time`, `status`) VALUES
(3, 90, 2, 2, 'SUPPLIER', '8/7/2023 - 20.53.14', 'IDR', 3, '2023-07-20 00:00:00', 'On Progress'),
(4, 91, 2, 2, 'SUPPLIER', '8/7/2023 - 21.17.49', 'EUR', 3, '2023-07-14 00:00:00', 'On Progress'),
(5, 111, 3, 1, 'SUBCON', '10/7/2023 - 20.41.50', 'IDR', 1, '2023-07-11 00:00:00', 'On Progress'),
(6, 1, 2, 2, 'SUPPLIER', '10/7/2023 - 21.18.14', 'IDR', 3, '2023-07-11 00:00:00', 'On Progress');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing_details`
--

CREATE TABLE `purchasing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_po` bigint(20) UNSIGNED NOT NULL,
  `part_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `composition` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `order_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchasing_details`
--

INSERT INTO `purchasing_details` (`id`, `id_po`, `part_no`, `part_name`, `unit_price`, `order_qty`, `unit`, `composition`, `amount`, `order_number`) VALUES
(2, 3, '90A', 'Besi', 90, 3, 'KG', '90', 24300, 'P90A'),
(3, 4, '91A', 'Baja Ringan', 90, 5, 'Ton', '800', 360000, 'PO91A'),
(4, 4, '91B', 'Alumunium', 90, 9, 'KG', '800', 360000, 'PO91B'),
(5, 5, '1', 'metal', 1000, 10000, 'pcs', '0.2', 2000000, '1'),
(6, 6, '1', 'metal', 1000, 2000, 'pcs', '0.2', 400000, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin HKI'),
(2, 'Admin Subcon'),
(3, 'Admin Supplier');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `no_surat` bigint(20) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `po_number` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`no_surat`, `tanggal`, `po_number`, `pengirim`, `penerima`, `status`) VALUES
(1, '2023-07-11 00:00:00', '90', 'Supplier 1', 'Subcon 1', 'Finish'),
(2, '2023-07-18 00:00:00', '111', 'Subcon 1', 'admin HKI', 'Finish'),
(3, '2023-07-11 00:00:00', '1', 'Supplier 1', 'Subcon 1', 'Finish');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_details`
--

CREATE TABLE `surat_details` (
  `no_surat` bigint(20) UNSIGNED NOT NULL,
  `part_no` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_details`
--

INSERT INTO `surat_details` (`no_surat`, `part_no`, `part_name`, `qty`, `unit`) VALUES
(1, '90A', 'Besi', '3', 'KG'),
(2, '1', 'metal', '10000', 'pcs'),
(3, '1', 'metal', '2000', 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `role_id`, `password`, `created_at`) VALUES
(1, 'hki', 'admin HKI', '1', '$2a$12$NP61H8qRLkmw5aqNaa2OfuEntASvkqCXD9NfE3l8kPeqj6ndDNIni', NULL),
(2, 'supplier', 'Supplier 1', '3', '$2a$12$NP61H8qRLkmw5aqNaa2OfuEntASvkqCXD9NfE3l8kPeqj6ndDNIni', NULL),
(3, 'subcon', 'Subcon 1', '2', '$2a$12$NP61H8qRLkmw5aqNaa2OfuEntASvkqCXD9NfE3l8kPeqj6ndDNIni', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_detail`
--

CREATE TABLE `users_detail` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users_detail`
--

INSERT INTO `users_detail` (`id_detail`, `id_user`, `id_perusahaan`, `class`, `email`, `telepon`, `fax`, `alamat`, `user_date`) VALUES
(1, '1', 1, 'HKI', 'admin@hki.co.id', '087778896543', '123456654321', 'Karawang', NULL),
(2, '2', 3, 'SUPPLIER', 'admin@supplier.co.id', '087778896097', '123456654321', 'Purwakarta', NULL),
(3, '3', 2, 'SUBCON', 'admin@subcon.co.id', '087778896678', '123456654321', 'Jakarta', NULL);

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
  ADD PRIMARY KEY (`id_po`);

--
-- Indeks untuk tabel `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchasing_details_id_po_foreign` (`id_po`);

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
-- Indeks untuk tabel `surat_details`
--
ALTER TABLE `surat_details`
  ADD KEY `surat_details_no_surat_index` (`no_surat`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id_po` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `purchasing_details`
--
ALTER TABLE `purchasing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `no_surat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD CONSTRAINT `purchasing_details_id_po_foreign` FOREIGN KEY (`id_po`) REFERENCES `purchasing` (`id_po`);

--
-- Ketidakleluasaan untuk tabel `surat_details`
--
ALTER TABLE `surat_details`
  ADD CONSTRAINT `surat_details_no_surat_foreign` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
