-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 09:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multigraharadhika`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_code`
--

CREATE TABLE `account_code` (
  `id_code` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `code` smallint(5) UNSIGNED NOT NULL,
  `name_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_code`
--

INSERT INTO `account_code` (`id_code`, `id_kategori`, `code`, `name_code`) VALUES
(1, 1, 401, 'Pendapatan Penjualan Produk'),
(2, 1, 402, 'Pendapatan Jasa'),
(3, 1, 403, 'Pendapatan Langganan (Subscription)'),
(4, 1, 404, 'Pendapatan Servis'),
(5, 1, 405, 'Pendapatan Penjualan Produk Tambahan'),
(6, 1, 411, 'Pendapatan Sewa Gedung'),
(7, 1, 412, 'Pendapatan Sewa Peralatan'),
(8, 1, 413, 'Pendapatan Komisi'),
(9, 1, 414, 'Pendapatan Denda Pelanggan'),
(10, 1, 415, 'Pendapatan Royalti'),
(11, 1, 416, 'Pendapatan Investasi'),
(12, 1, 421, 'Keuntungan Penjualan Aset Tetap'),
(13, 1, 422, 'Pendapatan Hibah/Donasi'),
(14, 1, 423, 'Pendapatan dari Selisih Kurs Mata Uang'),
(15, 1, 424, 'Pendapatan Lain yang Tidak Terduga'),
(16, 1, 431, 'Pelunasan Piutang Jasa'),
(17, 1, 432, 'Pelunasan Piutang Penjualan'),
(18, 2, 501, 'Biaya Produksi Bahan Baku'),
(19, 2, 502, 'Biaya Produksi Tenaga Kerja'),
(20, 2, 503, 'Biaya Overhead Produksi'),
(21, 2, 504, 'Biaya Packing dan Pengiriman'),
(22, 2, 511, 'Biaya Gaji dan Tunjangan'),
(23, 2, 512, 'Biaya Listrik dan Air'),
(24, 2, 513, 'Biaya Internet dan Telepon'),
(25, 2, 514, 'Biaya Sewa Gedung'),
(26, 2, 515, 'Biaya Transportasi dan Perjalanan Dinas'),
(27, 2, 516, 'Biaya Marketing dan Iklan'),
(28, 2, 517, 'Biaya Pemeliharaan dan Perbaikan'),
(29, 2, 518, 'Biaya ATK (Alat Tulis Kantor)'),
(30, 2, 521, 'Biaya Bunga Pinjaman'),
(31, 2, 522, 'Biaya Penyusutan Aset Tetap'),
(32, 2, 523, 'Biaya Pajak dan Retribusi'),
(33, 2, 524, 'Biaya Hukum dan Konsultan'),
(34, 2, 525, 'Biaya Lain yang Tidak Terduga'),
(35, 2, 531, 'Biaya Denda'),
(36, 2, 532, 'Biaya Keanggotaan/Subscription'),
(37, 2, 533, 'Biaya CSR (Corporate Social Responsibility)'),
(38, 3, 101, 'Kas dan Bank'),
(39, 3, 102, 'Piutang Usaha'),
(40, 3, 103, 'Persediaan Barang'),
(41, 3, 104, 'Aset Tetap - Bangunan'),
(42, 3, 105, 'Aset Tetap - Kendaraan'),
(43, 3, 106, 'Aset Tetap - Peralatan'),
(44, 3, 107, 'Investasi Jangka Panjang'),
(45, 4, 201, 'Hutang Usaha'),
(46, 4, 202, 'Hutang Bank'),
(47, 4, 203, 'Hutang Pajak'),
(48, 4, 204, 'Hutang Gaji'),
(49, 4, 205, 'Uang Muka dari Pelanggan'),
(50, 4, 206, 'Hutang Jangka Panjang'),
(51, 5, 301, 'Modal Disetor'),
(52, 5, 302, 'Laba Ditahan'),
(53, 5, 303, 'Laba Tahun Berjalan'),
(54, 5, 304, 'Dividen'),
(55, 5, 305, 'Tambahan Modal'),
(56, 5, 306, 'Penarikan Pribadi (Prive)');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id_address` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `blok` varchar(50) NOT NULL,
  `kode_pos` smallint(6) NOT NULL,
  `spesifik` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id_address`, `id_employee`, `provinsi`, `kabupaten`, `kecamatan`, `desa`, `blok`, `kode_pos`, `spesifik`) VALUES
(1, 51, '', 'Indramayu', 'Gabus', 'Kedung', 'Kawolu  RT 06 RW 03', 32767, ' Jalan irigasi Sungai Amazon No.12'),
(2, 47, '', 'Indramayu', 'Gabus', 'Kedung', 'Kawolu  RT 06 RW 03', 1212, 'test'),
(3, 52, '', 'Indramayu', 'Gabus', 'Kedung', 'Kawolu  RT 06 RW 03', 32767, ' r5rrr'),
(4, 53, '', 'Indramayu', 'Gabus', 'Kedung', 'Kawolu  RT 06 RW 03', 32767, ' test'),
(5, 41, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, 'Jalan amx'),
(6, 54, '', '123121', 'dqwdawdawdasd', 'dwaddawd', 'awdawdawd', 32767, 'wadwa'),
(7, 55, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' 1213132'),
(8, 56, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' tadasdas'),
(9, 57, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' RTes'),
(12, 60, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' edsfds'),
(13, 61, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' asdasd'),
(14, 62, '', 'Jepang', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, 'asdsasdas'),
(15, 63, '', 'Indramayu', 'Gabuswetan', 'Kedungdawa', 'Kawolu', 32767, ' ASDASD'),
(16, 64, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' asdwqe2'),
(17, 65, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' 12wqwedawd'),
(18, 66, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' asdasd'),
(19, 67, '', 'jEPANG', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' sdfsdfds'),
(20, 68, '', 'Indramayu', 'Gabuswetan', 'Kedungdawa', 'Kawolu', 32767, ' ASDASD'),
(21, 69, '', 'Indramayu', 'Gabuswetan', 'Kedungdawa', 'Kawolu  RT 06 RW 03', 32767, ' sadasdas');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = ROOT, 2 = ADMIN, 3 = EMPLOYEE, 4 = HRD',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `last_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `created_at`, `name`, `email`, `password`, `role`, `status`, `last_update`, `last_login`, `ip_address`, `avatar`) VALUES
(7, '2024-12-17 11:32:08', 'Admin', 'admin@admin.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-03-17 17:00:57', '2025-03-15 16:47:32', '127.0.0.1', ''),
(8, '2024-12-17 11:32:33', 'Super User', 'superuser@superuser.com', 'd1pEeHVad0diUnBTeUpPL0RTNTA3QT09', 1, 1, '2025-03-28 15:39:24', '2025-03-28 15:39:24', '127.0.0.1', '20fa8f15cecb411184ecb29b07b84a83.jpg'),
(9, '2025-01-20 14:56:04', 'Aditia', 'aditia@gmail.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-01-20 15:57:34', '2025-01-20 15:57:34', '127.0.0.1', ''),
(10, '2025-01-20 15:09:09', 'sssUser', '222sa@superuser.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 1, 1, '2025-01-20 15:52:58', '2025-01-20 15:52:58', '127.0.0.1', ''),
(11, '2025-01-20 15:09:27', 'Aditia', 'aditiasss@gmail.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-01-20 15:48:16', '2025-01-20 15:48:16', '127.0.0.1', ''),
(12, '2025-02-05 15:17:28', 'Rita Rika ', 'rita@email.com', 'bCszR1FkMGkzMzlSSTNDOTYwaFV2QT09', 3, 1, '2025-03-11 08:06:22', '2025-03-11 08:06:22', '127.0.0.1', '0c921eca68e0b0cb88bd3c03a4c8fd47.jpg'),
(13, '2025-02-12 10:25:58', 'agus', 'suga@gmail.com', 'NDJCVVNYQlI0dldpd0JDT3Y3b3VwQT09', 3, 1, '2025-03-27 12:27:57', '2025-02-25 15:31:49', '127.0.0.1', '10f534cac5ec1482b2feee85c83738dc.jpg'),
(14, '2025-02-14 14:51:26', 'Luna', 'luna@gmail.com', 'bCszR1FkMGkzMzlSSTNDOTYwaFV2QT09', 3, 1, '2025-02-14 15:55:03', '2025-02-14 15:55:03', '127.0.0.1', ''),
(15, '2025-02-15 08:28:48', 'Alex', 'alex@gmail.com', 'di9lNWwxR0JNYlk0TXRjUkRnNUFuUT09', 3, 1, '2025-03-25 16:40:18', '2025-03-25 16:40:18', '127.0.0.1', ''),
(16, '2025-02-15 08:31:22', 'Zilong', 'zilong@gmail.com', 'TjJ4RGw4azRWNkhxZk5kb2c0b3ZSQT09', 3, 1, '2025-03-01 16:17:35', '2025-03-01 16:17:35', '127.0.0.1', ''),
(17, '2025-02-15 08:35:58', 'Pika', 'pika@gmail.com', 'SVFXY0VKV203TTlmNCtZc0NMWlJTUT09', 3, 1, '2025-03-22 15:23:30', '2025-03-22 15:23:30', '127.0.0.1', ''),
(18, '2025-02-15 08:42:32', 'Zuki', 'zuki@gmail.com', 'cUtPSlNrc3VtZUZRZE9vS0xqVnZoUT09', 3, 1, '2025-03-25 16:38:26', '2025-03-25 16:38:26', '127.0.0.1', ''),
(19, '2025-02-21 16:47:47', 'Dita', 'dita@gmail.com', 'NUxFM2N5UkwwSkhuUVlheVdHdklXQT09', 3, 1, '2025-03-07 08:15:37', '2025-03-07 08:15:37', '127.0.0.1', ''),
(20, '2025-02-21 16:59:24', 'Dito', 'dito@gmail.com', 'VXZjM2ZpQnQ1OEdRcFZXRDRoQk9tQT09', 3, 1, '2025-02-28 16:00:46', '2025-02-28 16:00:46', '127.0.0.1', ''),
(21, '2025-02-21 17:01:52', 'Diki', 'diki@gmail.com', 'bU1zOE5ndXdpd0h4OGNCREhraHhiZz09', 3, 1, '2025-02-21 17:01:52', NULL, NULL, ''),
(22, '2025-02-21 17:04:19', 'Dodi', 'dodi@gmail.com', 'UGxUbzBqVml6OUxnZDY0bGl2V2Jidz09', 3, 1, '2025-02-21 17:04:19', NULL, NULL, ''),
(23, '2025-02-24 10:15:17', 'Arga', 'arga@gmail.com', 'ZitRNXp1bnBaZGFlVDlDTzFLZ3RtUT09', 3, 1, '2025-02-24 10:15:17', NULL, NULL, ''),
(24, '2025-02-24 10:16:54', 'Gara', 'gara@gmail.com', 'ajl5bHFKazlXT3JTZzJmbjZ2UDRqdz09', 3, 1, '2025-02-24 10:16:54', NULL, NULL, ''),
(25, '2025-02-24 10:21:22', 'Pawa', 'pawa@gmail.com', 'aEhxYnBteFhWTVRibTZMYXRWZGxhUT09', 3, 1, '2025-02-24 10:21:22', NULL, NULL, ''),
(27, '2025-02-26 16:53:36', 'Sumiyati', 'sumiyati@gmail.com', 'Rm80a01yc0xZVXgraDhLRy92aHZQQT09', 3, 1, '2025-03-28 15:06:07', '2025-03-28 15:06:07', '127.0.0.1', ''),
(28, '2025-02-27 12:00:37', 'Titis', 'titis@gmail.com', 'SjdzNFI3U1AzUlV1c1ArZ2JtNUR4QT09', 3, 1, '2025-02-27 12:00:37', NULL, NULL, ''),
(29, '2025-02-27 13:08:59', 'Titis', 'tatas@gmail.com', 'enRmd1lJaCtkQ1REdVJxdlVnNHN3Zz09', 3, 1, '2025-02-28 11:18:57', '2025-02-28 11:18:57', '127.0.0.1', ''),
(30, '2025-03-11 11:19:30', 'Rikarik', 'rikarik@gmail.com', 'dEVBQ0lDWkYxbmp2NGtQejBNTTlPZz09', 3, 1, '2025-03-11 11:19:30', NULL, NULL, ''),
(31, '2025-03-12 14:50:57', 'Richman', 'richman@gmail.com', 'dGY0YTJ4YkhYRCs0YllHUU5BcEs3QT09', 3, 1, '2025-03-26 14:24:20', '2025-03-26 14:24:20', '127.0.0.1', ''),
(32, '2025-03-14 16:41:52', 'Murayama', 'murayama@gmail.com', 'MFZpSExsWVJTeVVRaTY1WWpISjRnZz09', 3, 1, '2025-03-17 16:51:18', '2025-03-17 16:51:18', '127.0.0.1', ''),
(33, '2025-03-15 10:48:54', 'Genji', 'genji@gmail.com', 'RmhINWJqYVdWTEV1UloyMDRZQzBNUT09', 3, 1, '2025-03-15 10:48:54', NULL, NULL, ''),
(36, '2025-03-15 11:09:42', 'Harumichi', 'harumichi@gmail.com', 'M0R4bThFbmo5TjVNbWVPR0ZSekJ3Zz09', 3, 1, '2025-03-28 15:39:35', '2025-03-28 15:39:35', '127.0.0.1', ''),
(37, '2025-03-15 11:37:22', 'Tsubasa', 'tsubasa@gmail.com', 'aFQ0S0tFVC9JSDVLdEhFU1o1TzY0dz09', 3, 1, '2025-03-15 11:37:22', NULL, NULL, ''),
(38, '2025-03-15 11:44:56', 'Jarwo', 'jarwo@gmail.com', 'L0FIcVAzU2plcjkzcEVCRjZPNEhDQT09', 3, 1, '2025-03-15 11:44:56', NULL, NULL, ''),
(39, '2025-03-15 15:45:07', 'HRD', 'hrd@hrd.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 4, 1, '2025-03-17 17:01:37', '2025-03-17 17:01:37', '127.0.0.1', ''),
(40, '2025-03-19 16:46:14', 'Aditiya Weh', 'aditiyaweh@gmail.com', 'SVIxenZ5U3lxekdkU2laVTYxZWJWdz09', 3, 1, '2025-03-22 15:47:59', '2025-03-22 15:47:59', '127.0.0.1', ''),
(41, '2025-03-20 09:36:01', 'Shanks', 'shanks@gmail.com', 'RVRXTmc0NmpBbDFMWmt5bEhmSGhzZz09', 3, 1, '2025-03-20 09:36:01', NULL, NULL, ''),
(42, '2025-03-21 15:04:32', 'Kambuaya', 'kambuaya@gmail.com', 'Z1duTS9RTzUwYytTYlpmUnFKdkNvdz09', 3, 1, '2025-03-25 14:45:40', '2025-03-25 14:45:40', '127.0.0.1', ''),
(43, '2025-03-21 15:15:46', 'Janggar', 'janggar@gmail.com', 'Vk1XdFRteW11TlMrVW5GeVlqK0ZIdz09', 3, 1, '2025-03-22 11:57:46', '2025-03-22 11:57:46', '127.0.0.1', ''),
(44, '2025-03-21 15:19:54', 'Sulisti', 'sulisti@gmail.com', 'eWY0SEhQbXlVZFVIeEpMMFRPR2FTQT09', 3, 1, '2025-03-21 15:19:54', NULL, NULL, ''),
(45, '2025-03-21 15:39:01', 'Torres', 'torres@gmail.com', 'WWtabDZMK0Q4Q0NVOWhYcHNnbDNqdz09', 4, 1, '2025-03-21 15:42:09', '2025-03-21 15:40:02', '127.0.0.1', 'bc470af40522fba286389f21fa034bfc.jpeg'),
(46, '2025-03-21 15:52:35', 'Admin 2', 'admin2@admin.com', 'QmdwSTR3MU81c2JVN2FMSzQ0bzI4QT09', 2, 1, '2025-03-21 15:52:59', '2025-03-21 15:52:59', '127.0.0.1', '0b12b9fb67297adf37d8e74caae01e9f.png'),
(47, '2025-03-21 16:05:20', 'Admin 3', 'admin3@admin.com', 'Z0RNTEpQNlZZRTlQTElYR21BODQ1UT09', 2, 1, '2025-03-21 16:05:20', NULL, NULL, '79b14e80c9470c28f5c0006d60e0a8c4.png'),
(48, '2025-03-21 16:05:25', 'Admin 3', 'admin4@admin.com', 'Z0RNTEpQNlZZRTlQTElYR21BODQ1UT09', 2, 1, '2025-03-21 16:05:25', NULL, NULL, 'f6632dc2cda00d079e14662cbf24a079.png'),
(49, '2025-03-21 16:05:51', 'Admin 3', 'adsadasdas@admin.com', 'Z0RNTEpQNlZZRTlQTElYR21BODQ1UT09', 2, 1, '2025-03-21 16:05:51', NULL, NULL, '197a3a17bbde4f189b988413a24b18bd.png'),
(50, '2025-03-21 16:12:23', 'Admin 10', 'admin36@admin.com', 'TnE5OEJ2dE5yWjFHQzNkZm5IQ1hkdz09', 2, 1, '2025-03-21 16:12:23', NULL, NULL, 'd782ddd6a2ce85e6d48ec6ff50ddcad1.png'),
(51, '2025-03-22 16:34:39', 'Guriko', 'guriko@gmail.com', 'ZDcvc2VnVnhRUWlMNWVsL3dCd3J2QT09', 3, 1, '2025-03-22 16:34:39', NULL, NULL, ''),
(52, '2025-03-24 16:56:48', 'Lucky', 'lucky@gmail.com', 'Rm9BL3hYRFQyK3JINlNrN1RROGxvUT09', 3, 1, '2025-03-24 16:56:48', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id_attendance` int(10) UNSIGNED NOT NULL,
  `id_schedule` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `jam_masuk` time NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = Tidak Hadir, 2 = Hadir, 3 = Belum Absen',
  `time_management` tinyint(1) NOT NULL COMMENT 'true = on time, false = telat masuk',
  `potongan_telat` decimal(15,0) NOT NULL,
  `location_latitude` varchar(70) NOT NULL DEFAULT '0',
  `location_longitude` varchar(70) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id_attendance`, `id_schedule`, `id_employee`, `jam_masuk`, `tanggal_masuk`, `status`, `time_management`, `potongan_telat`, `location_latitude`, `location_longitude`) VALUES
(55, 1351, 39, '16:10:52', '2025-03-22', 2, 0, '222222', '-6.5310354378826325', '107.47361059468409'),
(56, 1354, 55, '16:11:15', '2025-03-22', 2, 0, '1000', '-6.5310354378826325', '107.47361059468409'),
(57, 1380, 39, '14:49:18', '2025-03-25', 2, 0, '0', '-6.5310354378826325', '107.47361059468409');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id_bank` smallint(5) UNSIGNED NOT NULL,
  `id_employee` smallint(5) UNSIGNED NOT NULL,
  `bank_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_holder_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`id_bank`, `id_employee`, `bank_number`, `bank_name`, `bank_holder_name`) VALUES
(9, 39, '107282888', 'BNI', 'Alex'),
(10, 40, '101281921', 'Mandiri', 'Zilong'),
(11, 41, '1022231231', 'BSI', 'Pika'),
(12, 42, '102192919', 'BNI', 'Zuki'),
(13, 43, '021212133', 'BNI', 'Dita'),
(14, 44, '12121212', 'BNI', 'DitO'),
(15, 45, '12121212', 'BNI', 'Diki'),
(16, 46, '12121212', 'BNI', 'Diki'),
(17, 47, '12121212', 'BNI', 'Diki'),
(18, 48, '12121212', 'BNI', 'Diki'),
(19, 49, '12121212', 'BNI', 'Diki'),
(21, 51, '122241', 'OCBC', 'Sumiyati'),
(22, 52, '122241', 'OCBC', 'Sumiyati'),
(23, 53, '122241', 'OCBC', 'Sumiyati'),
(24, 54, '234332323', 'sssss', 'Aditiya Sulistiyani'),
(25, 41, '1212', 'sssss', 'ASDSADA'),
(26, 55, '1212', 'sssss', 'ASDSADA'),
(27, 56, '1212', 'sssss', 'ASDSADA'),
(28, 57, '1212', 'sssss', 'ASDSADA'),
(31, 60, '1212', 'sssss', 'ASDSADA'),
(32, 61, '1212', 'sssss', 'ASDSADA'),
(33, 62, '1212', 'sssss', 'ASDSADA'),
(34, 63, '1231232131', 'ASDSAD', 'ASDASDASD'),
(35, 66, '122121', 'sssss', 'sadasdas'),
(36, 67, '122121', 'sssss', 'sadasdas'),
(37, 68, '12121212', 'AWQD', 'AWSDSASd'),
(38, 69, '3211321312', 'sssss', 'sssss');

-- --------------------------------------------------------

--
-- Table structure for table `batch_uang_makan`
--

CREATE TABLE `batch_uang_makan` (
  `id_batch_uang_makan` int(11) NOT NULL,
  `code_batch_uang_makan` varchar(20) NOT NULL,
  `auto_finance_record` tinyint(1) NOT NULL,
  `include_holiday` tinyint(1) NOT NULL,
  `include_leave` tinyint(1) NOT NULL,
  `include_absen` tinyint(1) NOT NULL,
  `total_uang_makan` decimal(15,0) DEFAULT NULL,
  `total_employee` smallint(6) DEFAULT NULL,
  `tanggal_batch_uang_makan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch_uang_makan`
--

INSERT INTO `batch_uang_makan` (`id_batch_uang_makan`, `code_batch_uang_makan`, `auto_finance_record`, `include_holiday`, `include_leave`, `include_absen`, `total_uang_makan`, `total_employee`, `tanggal_batch_uang_makan`) VALUES
(18, 'UM032814204830', 2, 1, 1, 1, NULL, NULL, '2025-03-28'),
(19, 'UM032814204830', 2, 1, 1, 1, NULL, NULL, '2025-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `bpjs_config`
--

CREATE TABLE `bpjs_config` (
  `id_bpjs_config` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `no_bpjs` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bpjs_config`
--

INSERT INTO `bpjs_config` (`id_bpjs_config`, `id_employee`, `no_bpjs`) VALUES
(1, 54, '1234567891234'),
(3, 41, '12121214511'),
(4, 55, '9876543219028'),
(5, 39, '3214567891234'),
(6, 56, '9812349878123'),
(7, 57, '0'),
(10, 60, ''),
(11, 61, NULL),
(12, 62, '1234561234098'),
(13, 63, NULL),
(14, 64, NULL),
(15, 65, NULL),
(16, 66, '1234567891232'),
(17, 67, '2121212121'),
(18, 68, NULL),
(19, 69, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `name_kategori` varchar(100) NOT NULL,
  `type_kategori` enum('I','E','A','L','EQ') NOT NULL COMMENT '''I = Income, E = Expense, A = Asset, L = Liability'',\r\nEQ = Equity'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `name_kategori`, `type_kategori`) VALUES
(1, 'Income', 'I'),
(2, 'Expenses', 'E'),
(3, 'Assets', 'A'),
(4, 'Liabilities', 'L'),
(5, 'Equity', 'EQ');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'image.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `name`, `address`, `contact`, `email`, `logo`) VALUES
(1, 'Gadget Shop', 'Munjul', '08122334232', 'gadgetshop@dummy.com', '98c303fcd51494be7d75db45422a0a13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `total_days` int(11) NOT NULL,
  `start_day` date NOT NULL,
  `end_day` date DEFAULT NULL,
  `type` tinyint(2) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = Ditolak, 2 = Disetujui, 3 = belum disetujui',
  `input_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `id_employee`, `total_days`, `start_day`, `end_day`, `type`, `description`, `status`, `input_at`) VALUES
(24, 41, 1, '2025-02-20', NULL, 1, 'test', 1, '2025-02-20'),
(25, 38, 2, '2025-02-20', '2025-02-21', 2, 'test', 1, '2025-02-20'),
(26, 41, 2, '2025-03-13', '2025-03-14', 2, 'trsss', 2, '2025-02-28'),
(27, 40, 1, '2025-03-01', NULL, 1, 'rtesst', 2, '2025-03-01'),
(28, 41, 1, '2025-03-07', NULL, 1, 'test', 2, '2025-03-05'),
(29, 39, 1, '2025-03-07', NULL, 1, 'test', 2, '2025-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `day_off`
--

CREATE TABLE `day_off` (
  `id_day_off` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `tgl_day_off` date NOT NULL,
  `input_at` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = Ditolak, 2 = Disetujui, 3 = belum disetujui'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `day_off`
--

INSERT INTO `day_off` (`id_day_off`, `id_employee`, `tgl_day_off`, `input_at`, `description`, `status`) VALUES
(9, 38, '2025-02-22', '2025-02-17', 'test', 2),
(10, 30, '2025-02-27', '2025-02-21', 'test', 2),
(11, 39, '2025-02-27', '2025-02-25', 'TESDT', 2),
(12, 41, '2025-03-01', '2025-02-28', 'test', 3),
(13, 39, '2025-03-09', '2025-03-05', 'esdt', 2),
(15, 39, '2025-03-16', '2025-03-15', 'test', 2),
(16, 65, '2025-03-25', '2025-03-25', 'testtt', 2),
(17, 65, '2025-03-26', '2025-03-25', 'sadsa', 2),
(19, 65, '2025-03-31', '2025-03-25', 'gfdgdf', 2),
(20, 41, '2025-03-26', '2025-03-25', 'sdasd', 2),
(21, 41, '2025-03-30', '2025-03-25', 'sdasd', 2),
(22, 68, '2025-03-26', '2025-03-25', 'sdsad', 2),
(23, 68, '2025-03-30', '2025-03-25', 'sdsad', 2),
(24, 68, '2025-03-28', '2025-03-25', 'sdsad', 2);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id_division` int(10) UNSIGNED NOT NULL,
  `code_division` varchar(20) NOT NULL,
  `name_division` varchar(100) NOT NULL,
  `payday` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id_division`, `code_division`, `name_division`, `payday`) VALUES
(1, 'IT', 'IT', 20),
(3, 'FIN', 'Finance', 20),
(4, 'TKS', 'Teknisi', 20),
(5, 'CRV', 'Creative', 20);

-- --------------------------------------------------------

--
-- Table structure for table `domisili`
--

CREATE TABLE `domisili` (
  `id_domisili` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `provinsi_domisili` varchar(50) NOT NULL,
  `kabupaten_domisili` varchar(50) NOT NULL,
  `kecamatan_domisili` varchar(50) NOT NULL,
  `desa_domisili` varchar(50) NOT NULL,
  `blok_domisili` varchar(50) NOT NULL,
  `kode_pos_domisili` smallint(6) NOT NULL,
  `spesifik_domisili` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domisili`
--

INSERT INTO `domisili` (`id_domisili`, `id_employee`, `provinsi_domisili`, `kabupaten_domisili`, `kecamatan_domisili`, `desa_domisili`, `blok_domisili`, `kode_pos_domisili`, `spesifik_domisili`) VALUES
(1, 51, '', 'Purwakarta', 'Purwakarta', 'Gantri tengah', 'Situ bulued', 12002, 'Kosan Purwakarta '),
(2, 47, '', 'Purwakarta', 'Purwakarta', 'Gantri Tengah', 'Situ bulued', 1212, 'tes'),
(3, 52, '', 'Purwakarta', 'Purwakarta', 'Gantri', 'Situ bulued', 12002, ' rwewe'),
(4, 53, '', 'Purwakarta', 'Purwakarta', 'Gantri', 'Situ bulued', 12002, ' test'),
(5, 41, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, 'Jalan Cmx'),
(6, 54, '', 'awdaw', 'dwdadawd', 'aawedwada', 'wadwada', 32767, ' tteadsda'),
(7, 55, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' 1313131'),
(8, 56, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' sadasdsad'),
(9, 57, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' test'),
(12, 60, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' wqrqwr'),
(13, 61, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' asdasdas'),
(14, 62, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' adsadass'),
(15, 63, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' WADWQADAW'),
(16, 64, '', 'Purwakarta', 'Purwakarta', 'Gantri tengah', 'Gantri', 32767, ' dasdsadas'),
(17, 65, '', 'Purwakarta', 'Purwakarta', 'Gantri Tengah', 'Gantri', 12002, ' sadasdas'),
(18, 66, '', 'Purwakarta', 'Purwakarta', 'Gantri Tengah', 'Gantri', 12002, ' sadasdsas'),
(19, 67, '', 'Purwakarta', 'Purwakarta', 'Gantri Tengah', 'Gantri', 12002, ' dsfsdfds'),
(20, 68, '', 'Purwakarta', 'Purwakarta', 'Munjul', 'Gantri', 32767, ' SADAS'),
(21, 69, '', 'Purwakarta', 'Purwakarta', 'Gantri Tengah', 'Gantri', 12002, ' sadasdas');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `id_contact` smallint(5) UNSIGNED NOT NULL,
  `id_employee` int(5) UNSIGNED NOT NULL,
  `name_contact` varchar(100) DEFAULT NULL,
  `number_contact` varchar(50) DEFAULT NULL,
  `as_contact` tinyint(4) DEFAULT NULL COMMENT '0 = Keluarga, 1= Teman,',
  `address_contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emergency_contact`
--

INSERT INTO `emergency_contact` (`id_contact`, `id_employee`, `name_contact`, `number_contact`, `as_contact`, `address_contact`) VALUES
(10, 39, 'Rika', '08121212121', 1, 'Priuk'),
(11, 40, 'Alucard', '0812121212', 1, 'London'),
(12, 41, 'Anju', '0812123334', 0, 'Campaka'),
(13, 42, 'Zaka', '0828282828', 0, 'Purwakarta'),
(14, 43, 'Aditiya Sulistiyani', '02323231231', 1, 'awdwda'),
(15, 44, 'Aditiya Sulistiyani', '02323231231', 0, 'Indramayu'),
(16, 45, 'Aditiya Sulistiyani', '02323231231', 0, 'Indramayu'),
(17, 46, 'Aditiya Sulistiyani', '02323231231', 0, 'Indramayu'),
(18, 47, 'Aditiya Sulistiyani', '02323231231', 1, 'Indramayu'),
(19, 48, 'Aditiya Sulistiyani', '02323231231', 0, 'awdwda'),
(20, 49, 'Aditiya Sulistiyani', '02323231231', 0, 'awdwda'),
(22, 51, 'Luna', '08223311223', 1, 'Indramayu'),
(23, 52, 'Luna', '08223311223', 1, 'e2e23e2'),
(24, 53, 'Luna', '08223311223', 1, 'tes'),
(25, 54, 'Aditiya Sulistiyani', '02323231231', 1, 'adawdawd'),
(26, 55, 'Aditiya Sulistiyani', '121212', 0, 'test'),
(27, 56, 'Aditiya Sulistiyani', '121212', 0, 'adsadasdasd'),
(28, 57, 'Aditiya Sulistiyani', '121212', 0, 'tesdt'),
(31, 60, 'Aditiya Sulistiyani', '121212', 0, 'wdwdawq'),
(32, 61, 'Aditiya Sulistiyani', '121212', 0, 'ssadasdas'),
(33, 62, 'Aditiya Sulistiyani', '121212', 0, 'asdasdasdas'),
(34, 63, '121212', '1131313213', 0, '13131312'),
(35, 66, 'Aditiya Sulistiyani', '12121334432', 0, 'adsdas'),
(36, 67, 'sdf', '232323232', 1, 'asefdasdf'),
(37, 68, 'Alucard', '121212', 1, 'asdfasdsa');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` smallint(5) UNSIGNED NOT NULL,
  `id_division` int(11) NOT NULL,
  `id_position` int(11) NOT NULL,
  `id_product` smallint(5) UNSIGNED NOT NULL,
  `email` varchar(80) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `date_in` date NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `basic_salary` decimal(15,2) NOT NULL,
  `uang_makan` decimal(15,2) NOT NULL,
  `type_uang_makan` tinyint(1) NOT NULL COMMENT '1 = Harian, 2 = Mingguan, 3 = Bulanan',
  `type_employee` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Kontrak, 2 = Magang, 3 = Permanen',
  `contract_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `id_division`, `id_position`, `id_product`, `email`, `no_hp`, `date_in`, `nip`, `name`, `gender`, `place_of_birth`, `date_of_birth`, `status`, `basic_salary`, `uang_makan`, `type_uang_makan`, `type_employee`, `contract_expired`) VALUES
(27, 1, 1, 48, 'suga@gmail.com', '0', '2022-12-01', '1212121213', 'Agus', 'L', 'Indramayu', '2001-12-01', 1, '4800000.00', '480000.00', 0, 1, NULL),
(30, 3, 2, 52, 'luna@gmail.com', '0', '2025-02-05', '11111222', 'Luna', 'P', 'Tangerang', '2012-12-01', 1, '3000000.00', '22222.00', 0, 1, NULL),
(38, 3, 2, 44, 'rita@email.com', '0', '2022-12-01', '10519199', 'Rita Rika ', 'L', '1212121', '2000-12-01', 1, '11000000.00', '480000.00', 0, 1, NULL),
(39, 1, 4, 45, 'alex@gmail.com', '6285724416416', '2024-01-17', '1051919991', 'Alex', 'L', 'Priuk', '2001-05-15', 1, '7000000.00', '480000.00', 3, 1, '0000-00-00'),
(40, 3, 2, 45, 'zilong@gmail.com', '0', '2021-12-22', '12121212121', 'Zilong', 'L', 'London', '1999-12-01', 1, '4500000.00', '480000.00', 2, 1, NULL),
(41, 5, 1, 45, 'pika@gmail.com', '0', '2020-12-22', '1958238288', 'Pika', 'P', 'Campaka', '2002-02-22', 1, '3000000.00', '480000.00', 2, 1, '2025-04-30'),
(42, 1, 2, 44, 'zuki@gmail.com', '0', '2023-12-02', '121212121', 'Zuki', 'L', 'Purwakarta', '2001-12-12', 1, '4000000.00', '480000.00', 2, 1, NULL),
(43, 3, 4, 52, 'dita@gmail.com', '0', '2024-12-14', '12121212', 'Dita', 'P', 'Cikampek', '2000-12-01', 1, '3000000.00', '190000.00', 2, 1, NULL),
(44, 5, 5, 52, 'dito@gmail.com', '0', '2025-02-08', '12121212212', 'Dito', 'L', 'Cikopo', '2002-12-12', 1, '1800000.00', '480000.00', 2, 1, NULL),
(45, 1, 2, 43, 'diki@gmail.com', '0', '2025-02-15', '121212121212', 'Diki', 'L', 'Cikopo', '2001-02-26', 1, '4000000.00', '480000.00', 2, 2, '2025-04-30'),
(46, 1, 1, 48, 'dodi@gmail.com', '0', '2025-02-01', '12121234', 'Dodi', 'L', 'Cikopo', '2000-02-13', 1, '1000000.00', '400000.00', 2, 2, '2025-08-23'),
(47, 4, 1, 48, 'arga@gmail.com', '0', '2025-02-01', '107239984', 'Arga', 'L', 'Indramayu', '1999-12-12', 1, '0.00', '480000.00', 2, 1, '2025-04-29'),
(48, 4, 4, 43, 'gara@gmail.com', '0', '2025-02-20', '108277533', 'Gara', 'L', 'Indramayu', '2002-12-01', 1, '0.00', '0.00', 2, 1, '2026-12-01'),
(49, 4, 1, 48, 'pawa@gmail.com', '0', '2025-02-17', '18092331', 'Pawa', 'L', 'Tangerang', '2000-12-09', 1, '0.00', '0.00', 2, 1, '2026-02-12'),
(51, 1, 1, 52, 'sumiyati@gmail.com', '0812223121', '2025-02-01', '11122112', 'Sumiyati', 'L', 'Indr', '1999-02-14', 1, '3000000.00', '380000.00', 2, 1, '2025-09-30'),
(52, 1, 2, 46, 'titis@gmail.com', '02323231231', '2025-02-01', '121213221', 'Titis', 'P', 'Tangerang', '2000-12-31', 1, '3000000.00', '480000.00', 2, 1, '2025-03-20'),
(53, 1, 4, 46, 'tatas@gmail.com', '02323231231', '2025-02-01', '12122122222', 'Tatas', 'L', 'Tangerang', '2000-02-22', 1, '3500000.00', '380000.00', 2, 1, '2025-04-30'),
(54, 1, 1, 48, 'rikarik@gmail.com', '02323231231', '2025-03-01', '12313131312312', 'Rikarik', 'L', 'adadsadasdasd', '2000-03-13', 1, '2000000.00', '100000.00', 2, 1, '2025-08-20'),
(55, 1, 1, 45, 'richman@gmail.com', '02323231231', '2025-01-01', '121097822212', 'Richman', 'L', 'Indramayu', '2001-12-12', 1, '57000000.00', '1200000.00', 2, 3, NULL),
(56, 3, 1, 45, 'murayama@gmail.com', '02323231231', '2025-03-01', '9812349878123456', 'Murayama', 'L', 'Tangerang', '2002-12-01', 1, '1000000.00', '480000.00', 2, 3, NULL),
(57, 1, 2, 45, 'genji@gmail.com', '02323231231', '2025-03-01', '9812349878123451', 'Genji', 'L', 'Brazil', '1999-12-12', 1, '5000000.00', '480000.00', 2, 1, '2025-07-31'),
(60, 4, 1, 45, 'harumichi@gmail.com', '02323231231', '2025-03-01', '9812349878123459', 'Harumichi', 'L', 'Indramayu', '1998-02-01', 1, '1500000.00', '280000.00', 2, 2, '2025-07-01'),
(61, 1, 1, 54, 'tsubasa@gmail.com', '02323231231', '2025-03-01', '1234561234098741', 'Tsubasa', 'L', 'Indramayu', '2025-03-28', 1, '5000000.00', '480000.00', 2, 1, '2025-07-31'),
(62, 1, 1, 48, 'jarwo@gmail.com', '02323231231', '2025-03-01', '1234561234098746', 'Jarwo', 'L', 'Indramayu', '1999-03-01', 1, '5000000.00', '500000.00', 2, 3, NULL),
(63, 1, 1, 45, 'aditiyaweh@gmail.com', '08122234441', '2025-03-01', '1212121212', 'Aditiya Weh', 'L', 'TEST', '2001-03-04', 1, '1221212.00', '48000.00', 3, 3, NULL),
(64, 1, 1, 45, 'shanks@gmail.com', '02323231231', '2025-03-01', '232323212212', 'Shanks', 'L', 'Cikampek', '2000-12-12', 1, '768678768.00', '678768768.00', 2, 1, '2025-09-06'),
(65, 1, 1, 45, 'kambuaya@gmail.com', '121212121212', '2025-03-01', '12121212134', 'Kambuaya', 'L', 'Tangerang', '2025-03-01', 1, '3400000.00', '480000.00', 3, 1, '2025-05-01'),
(66, 3, 1, 45, 'janggar@gmail.com', '121212121212', '2025-03-01', '1212121213423', 'Janggar', 'L', 'Cilacap', '2000-03-07', 1, '5000000.00', '360000.00', 2, 1, '2025-04-01'),
(67, 1, 2, 44, 'sulisti@gmail.com', '02323231231', '2025-03-01', '121212112', 'Sulisti', 'L', 'Test', '1999-03-19', 1, '4000000.00', '120000.00', 2, 1, '2025-06-07'),
(68, 1, 2, 45, 'guriko@gmail.com', '0811223433445', '2025-03-01', '1234567891', 'Guriko', 'L', 'Indramayu', '2000-03-22', 1, '1000000.00', '420000.00', 2, 1, '2025-05-31'),
(69, 1, 1, 44, 'lucky@gmail.com', '02323231231', '2025-03-01', '121212122121', 'Lucky', 'L', 'Brazil', '2000-03-14', 1, '1200000.00', '120000.00', 2, 1, '2025-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `finance_records`
--

CREATE TABLE `finance_records` (
  `id_record` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `record_date` datetime NOT NULL DEFAULT current_timestamp(),
  `product_id` smallint(5) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `id_code` int(10) UNSIGNED NOT NULL COMMENT 'ID Kode Akun',
  `description` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance_records`
--

INSERT INTO `finance_records` (`id_record`, `created_at`, `record_date`, `product_id`, `amount`, `id_code`, `description`, `updated_at`) VALUES
(194, '2025-03-21 14:52:13', '2025-03-30 00:00:00', 45, '5275928.00', 22, 'Gaji Alex Dengan Code TESS', '2025-03-21 14:52:13'),
(195, '2025-03-24 11:03:51', '2025-03-24 00:00:00', 45, '11111.00', 22, 'Gaji Alex Dengan Code AZXAX', '2025-03-24 15:35:38'),
(196, '2025-03-24 11:03:51', '2025-03-24 00:00:00', 45, '57100000.00', 22, 'Gaji Richman Dengan Code AZXAX', '2025-03-24 11:03:51'),
(197, '2025-03-24 13:23:15', '2025-03-24 00:00:00', 45, '7290001.00', 22, 'Gaji Alex Dengan Code 11112', '2025-03-24 13:23:15'),
(198, '2025-03-24 13:23:15', '2025-03-24 00:00:00', 45, '57000001.00', 22, 'Gaji Richman Dengan Code 11112', '2025-03-24 13:23:15'),
(199, '2025-03-24 13:27:55', '2025-03-31 00:00:00', 45, '7300005.00', 22, 'Gaji Alex Dengan Code gyjtgy', '2025-03-24 13:27:55'),
(200, '2025-03-24 13:27:55', '2025-03-31 00:00:00', 45, '57000005.00', 22, 'Gaji Richman Dengan Code gyjtgy', '2025-03-24 13:27:55'),
(201, '2025-03-24 13:41:11', '2025-03-24 00:00:00', 45, '8290000.00', 22, 'Gaji Alex Dengan Code 454534', '2025-03-24 13:41:11'),
(202, '2025-03-24 13:41:11', '2025-03-24 00:00:00', 45, '58000000.00', 22, 'Gaji Richman Dengan Code 454534', '2025-03-24 13:41:11'),
(203, '2025-03-24 15:26:57', '2025-03-24 15:26:00', 45, '112222.00', 16, 'test', '2025-03-24 15:26:57'),
(204, '2025-03-24 15:27:41', '2025-03-24 15:26:00', 52, '122221.00', 36, 'testr', '2025-03-24 15:27:41'),
(205, '2025-03-24 16:58:33', '2025-03-24 00:00:00', 45, '1200000.00', 22, 'sdasdasd', '2025-03-24 16:58:33'),
(206, '2025-03-24 16:59:04', '2025-03-24 00:00:00', 52, '380000.00', 22, 'sadasdsa', '2025-03-24 16:59:04'),
(207, '2025-03-24 16:59:04', '2025-03-24 00:00:00', 52, '480000.00', 22, 'sadasdsa', '2025-03-24 16:59:04'),
(208, '2025-03-24 16:59:43', '2025-03-24 00:00:00', 45, '480000.00', 22, 'dasdas', '2025-03-24 16:59:43'),
(209, '2025-03-24 16:59:43', '2025-03-24 00:00:00', 45, '360000.00', 22, 'dasdas', '2025-03-24 16:59:43'),
(210, '2025-03-26 13:50:26', '2025-03-26 00:00:00', 45, '57110111.00', 22, 'Gaji Richman Dengan Code PR032613500814', '2025-03-26 13:50:26'),
(211, '2025-03-26 13:50:26', '2025-03-26 00:00:00', 45, '3500000.00', 22, 'Gaji Kambuaya Dengan Code PR032613500814', '2025-03-26 13:50:26'),
(212, '2025-03-26 16:18:18', '2025-03-26 00:00:00', 45, '6877778.00', 22, 'Gaji Alex Dengan Code PR032616180670', '2025-03-26 16:18:18'),
(213, '2025-03-26 16:18:32', '2025-03-26 00:00:00', 52, '3000000.00', 22, 'Gaji Sumiyati Dengan Code PR032616182030', '2025-03-26 16:18:32'),
(214, '2025-03-28 09:14:30', '2025-03-28 00:00:00', 45, '7887778.00', 22, 'Gaji Alex Dengan Code PR032809140769', '2025-03-28 09:14:30'),
(215, '2025-03-28 09:17:19', '2025-03-28 00:00:00', 45, '7887778.00', 22, 'Gaji Alex Dengan Code PR032809143185', '2025-03-28 09:17:19'),
(216, '2025-03-28 09:18:45', '2025-03-28 00:00:00', 45, '7010000.00', 22, 'Gaji Alex Dengan Code PR032809181073', '2025-03-28 09:18:45'),
(217, '2025-03-28 09:25:38', '2025-03-28 00:00:00', 45, '7467778.00', 22, 'Gaji Alex Dengan Code PR032809251681', '2025-03-28 09:25:38'),
(218, '2025-03-28 09:26:43', '2025-03-28 00:00:00', 45, '57210111.00', 22, 'Gaji Richman Dengan Code PR032809253963', '2025-03-28 09:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `holyday`
--

CREATE TABLE `holyday` (
  `id_holyday` int(10) UNSIGNED NOT NULL,
  `id_division` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `start_day` date DEFAULT NULL,
  `type_group` tinyint(1) NOT NULL COMMENT '1= All Product, 2 = All Division, 3 = All Division & products, 4 = Custom',
  `type_day` tinyint(1) NOT NULL COMMENT '1 = Single Day, 2 = Multiple Days',
  `status_day` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1 = Libur Nasional, 2 = Libur Minggu',
  `end_day` date DEFAULT NULL,
  `code_holyday` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holyday`
--

INSERT INTO `holyday` (`id_holyday`, `id_division`, `id_product`, `start_day`, `type_group`, `type_day`, `status_day`, `end_day`, `code_holyday`, `date`) VALUES
(609, 1, 46, '2025-02-27', 4, 2, 1, '2025-03-02', '121212', '2025-02-27'),
(610, 1, 46, '2025-02-27', 4, 2, 1, '2025-03-02', '121212', '2025-02-28'),
(611, 1, 46, '2025-02-27', 4, 2, 1, '2025-03-02', '121212', '2025-03-01'),
(612, 1, 46, '2025-02-27', 4, 2, 1, '2025-03-02', '121212', '2025-03-02'),
(617, 1, 45, NULL, 2, 1, 1, NULL, 'TESTssssss', '2025-03-11'),
(618, 3, 45, NULL, 2, 1, 1, NULL, 'TESTssssss', '2025-03-11'),
(619, 4, 45, NULL, 2, 1, 1, NULL, 'TESTssssss', '2025-03-11'),
(620, 5, 45, NULL, 2, 1, 1, NULL, 'TESTssssss', '2025-03-11'),
(621, 1, 45, NULL, 2, 1, 2, NULL, 'TTESTwswsws', '2025-03-13'),
(622, 3, 45, NULL, 2, 1, 2, NULL, 'TTESTwswsws', '2025-03-13'),
(623, 4, 45, NULL, 2, 1, 2, NULL, 'TTESTwswsws', '2025-03-13'),
(624, 5, 45, NULL, 2, 1, 2, NULL, 'TTESTwswsws', '2025-03-13'),
(656, 1, 45, NULL, 4, 3, 1, NULL, 'asdasdasdaaa', '2025-04-22'),
(657, 1, 45, NULL, 4, 3, 1, NULL, 'asdasdasdaaa', '2025-04-28'),
(658, 1, 45, NULL, 4, 3, 1, NULL, 'asdasdasdaaa', '2025-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id_izin` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `alasan_izin` varchar(80) NOT NULL,
  `input_at` datetime NOT NULL,
  `tanggal_izin` date NOT NULL,
  `bukti_surat_sakit` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = Ditolak, 2 = Disetujui, 3 = belum disetujui',
  `description` varchar(150) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `izin`
--

INSERT INTO `izin` (`id_izin`, `id_employee`, `alasan_izin`, `input_at`, `tanggal_izin`, `bukti_surat_sakit`, `status`, `description`) VALUES
(11, 40, '1', '2025-02-15 00:00:00', '2025-02-15', 'e38013bb278e6ba3fc3679b561b990f0.png', 2, 'test'),
(12, 39, '1', '2025-02-22 00:00:00', '2025-02-22', '-', 2, 'test'),
(13, 39, 'Izin Menghadiri Acara Keagamaan', '2025-02-22 00:00:00', '2025-02-23', '8cc08230537e020eec9caa84a99c5b66.jpeg', 2, 'test'),
(14, 41, 'Izin Menghadiri Acara Keagamaan', '2025-02-28 00:00:00', '2025-03-01', '-', 2, 'test'),
(15, 41, 'Keperluan Mendesak Lainnya', '2025-02-28 00:00:00', '2025-02-08', '-', 3, 'test'),
(16, 41, 'Izin Keluarga Melahirkan', '2025-02-28 00:00:00', '2025-02-01', '-', 3, 'test'),
(17, 41, 'Izin Menghadiri Acara Keagamaan', '2025-02-28 00:00:00', '2025-02-28', 'fd78606cdb37fc376ee25ea8bc4da393.jpeg', 3, 'test'),
(19, 51, 'Izin Keluarga Melahirkan', '2025-03-22 00:00:00', '2025-03-22', '-', 2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `name_location` varchar(255) NOT NULL,
  `latitude` varchar(80) NOT NULL,
  `longitude` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id_location`, `name_location`, `latitude`, `longitude`, `created_at`) VALUES
(1, 'Purwakarta, munjul jaya, gadgetcare purwakarta', '-6.5308924538605', '107.47401311012979', '2025-02-28 03:07:28'),
(2, 'Subang', '-6.564517', '107.795412', '2025-02-28 03:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `log_contract_extension`
--

CREATE TABLE `log_contract_extension` (
  `id_log_contract_extension` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `old_contract` date NOT NULL,
  `new_contract` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `input_contract_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_contract_extension`
--

INSERT INTO `log_contract_extension` (`id_log_contract_extension`, `id_employee`, `old_contract`, `new_contract`, `description`, `input_contract_at`) VALUES
(1, 46, '2025-04-24', '2025-08-23', 'test', '2025-02-22 10:56:40'),
(2, 52, '2025-03-31', '2025-03-20', 'test', '2025-03-04 09:34:09'),
(3, 63, '0000-00-00', '2025-03-22', 'qtradsa', '2025-03-20 09:44:12'),
(4, 63, '2025-03-22', '2025-03-21', 'test', '2025-03-20 10:10:10'),
(5, 63, '2025-03-21', '2025-05-22', 'asdasd', '2025-03-20 10:10:28'),
(6, 64, '2025-05-10', '2025-07-12', 'sdfasd', '2025-03-20 10:12:01'),
(7, 63, '2025-05-22', '2025-03-21', 'asdasd', '2025-03-20 10:12:40'),
(8, 64, '2025-07-12', '2025-09-06', 'test', '2025-03-20 10:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id_overtime` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `input_at` date NOT NULL DEFAULT current_timestamp(),
  `time_spend` decimal(15,2) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = ditolak, 2 = disetujui, 3 = pending',
  `pay` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id_overtime`, `id_employee`, `tanggal`, `input_at`, `time_spend`, `start`, `end`, `description`, `status`, `pay`) VALUES
(13, 30, '2025-02-28', '2025-02-28', '1.00', '18:00:00', '19:00:00', 'test', 2, '1000000.00'),
(14, 43, '2025-02-28', '2025-02-28', '1.00', '18:00:00', '19:00:00', 'test', 2, '100000.00'),
(15, 39, '2025-03-08', '2025-03-06', '1.00', '19:00:00', '20:00:00', 'test', 2, '100000.00'),
(16, 40, '2025-03-08', '2025-03-06', '1.00', '19:00:00', '20:00:00', 'test', 2, '100000.00'),
(17, 41, '2025-03-08', '2025-03-06', '1.00', '19:00:00', '20:00:00', 'test', 2, '100000.00'),
(18, 39, '2025-03-28', '2025-03-07', '3.00', '17:00:00', '20:00:00', 'test', 2, '10000.00'),
(19, 40, '2025-03-28', '2025-03-07', '3.00', '17:00:00', '20:00:00', 'test', 2, '10000.00'),
(20, 41, '2025-03-28', '2025-03-07', '3.00', '17:00:00', '20:00:00', 'test', 2, '10000.00'),
(34, 64, '2025-03-24', '2025-03-24', '2.00', '14:00:00', '16:00:00', 'test', 2, '120000.00'),
(35, 55, '2025-03-24', '2025-03-24', '1.00', '12:00:00', '13:00:00', 'test', 2, '11111.00'),
(36, 67, '2025-03-24', '2025-03-24', '1.00', '23:00:00', '00:00:00', 'tst', 2, '1212121.00');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id_payroll` int(10) UNSIGNED NOT NULL,
  `code_payroll` varchar(15) DEFAULT NULL,
  `total_salary` decimal(10,0) DEFAULT NULL,
  `total_employee` int(11) DEFAULT NULL,
  `input_at` date NOT NULL,
  `include_piutang` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Include, 2 = Exclude',
  `include_finance_record` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Auto Insert, 2 = Manual',
  `include_potongan_telat` tinyint(1) NOT NULL,
  `include_bpjs` tinyint(1) NOT NULL DEFAULT 2,
  `include_pph` tinyint(1) NOT NULL DEFAULT 2,
  `include_uang_makan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id_payroll`, `code_payroll`, `total_salary`, `total_employee`, `input_at`, `include_piutang`, `include_finance_record`, `include_potongan_telat`, `include_bpjs`, `include_pph`, `include_uang_makan`) VALUES
(153, '454534', NULL, NULL, '2025-03-24', 1, 1, 1, 2, 2, 0),
(154, 'PR032613500814', NULL, NULL, '2025-03-26', 1, 1, 1, 2, 2, 0),
(155, 'PR032616180670', NULL, NULL, '2025-03-26', 1, 1, 1, 2, 2, 0),
(156, 'PR032616182030', NULL, NULL, '2025-03-26', 1, 1, 1, 2, 2, 0),
(157, 'PR032809140769', NULL, NULL, '2025-03-28', 1, 1, 1, 2, 2, 0),
(158, 'PR032809143185', NULL, NULL, '2025-03-28', 1, 1, 1, 2, 2, 0),
(159, 'PR032809181073', NULL, NULL, '2025-03-28', 1, 1, 1, 2, 2, 0),
(160, 'PR032809251681', NULL, NULL, '2025-03-28', 1, 1, 1, 2, 2, 1),
(161, 'PR032809253963', NULL, NULL, '2025-03-28', 1, 1, 1, 2, 2, 0),
(162, 'PR032809253963', NULL, NULL, '2025-03-28', 2, 2, 1, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_component`
--

CREATE TABLE `payroll_component` (
  `id_payroll_component` int(10) UNSIGNED NOT NULL,
  `id_employee` int(11) UNSIGNED NOT NULL,
  `id_payroll` int(10) UNSIGNED NOT NULL,
  `bonus` decimal(10,0) NOT NULL DEFAULT 0,
  `periode_gajian` date NOT NULL,
  `tanggal_gajian` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `total_overtime` decimal(15,0) NOT NULL,
  `total_dayoff` tinyint(2) NOT NULL,
  `piutang` decimal(15,0) DEFAULT NULL,
  `total_absen` int(11) NOT NULL,
  `potongan_absen` decimal(15,0) NOT NULL,
  `absen_hari` decimal(15,0) NOT NULL,
  `total_potongan_telat` decimal(15,0) NOT NULL,
  `total_potongan` decimal(15,0) NOT NULL,
  `jht` decimal(15,0) NOT NULL,
  `jp` decimal(15,0) NOT NULL,
  `total` decimal(15,0) NOT NULL,
  `gaji_bersih` decimal(15,0) NOT NULL,
  `gaji_pokok` decimal(15,0) NOT NULL,
  `basic_uang_makan` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_component`
--

INSERT INTO `payroll_component` (`id_payroll_component`, `id_employee`, `id_payroll`, `bonus`, `periode_gajian`, `tanggal_gajian`, `description`, `total_overtime`, `total_dayoff`, `piutang`, `total_absen`, `potongan_absen`, `absen_hari`, `total_potongan_telat`, `total_potongan`, `jht`, `jp`, `total`, `gaji_bersih`, `gaji_pokok`, `basic_uang_makan`) VALUES
(137, 39, 153, '1000000', '2025-03-01', '2025-03-24', 'dfgfg', '290000', 0, '0', 0, '0', '259259', '0', '0', '0', '0', '8290000', '8290000', '7000000', '0.00'),
(138, 55, 153, '1000000', '2025-03-01', '2025-03-24', 'dfgfg', '0', 0, '0', 0, '0', '2111111', '0', '0', '0', '0', '58000000', '58000000', '57000000', '0.00'),
(139, 55, 154, '100000', '2025-03-01', '2025-03-26', 'treassst', '11111', 0, '0', 0, '0', '2111111', '1000', '1000', '0', '0', '57110111', '57110111', '57000000', '0.00'),
(140, 65, 154, '100000', '2025-03-01', '2025-03-26', 'treassst', '0', 2, '0', 0, '0', '125926', '0', '0', '0', '0', '3500000', '3500000', '3400000', '0.00'),
(141, 39, 155, '0', '2025-03-01', '2025-03-26', 'sdfdsfsd', '100000', 0, '0', 0, '0', '259259', '222222', '222222', '0', '0', '6877778', '6877778', '7000000', '0.00'),
(142, 51, 156, '0', '2025-03-01', '2025-03-26', 'sadaws', '0', 0, '0', 0, '0', '111111', '0', '0', '0', '0', '3000000', '3000000', '3000000', '0.00'),
(143, 39, 157, '1000000', '2025-03-01', '2025-03-28', 'sass', '110000', 0, '0', 0, '0', '259259', '222222', '222222', '0', '0', '7887778', '7887778', '7000000', '0.00'),
(144, 39, 158, '1000000', '2025-03-01', '2025-03-28', 'test', '110000', 0, '0', 0, '0', '259259', '222222', '222222', '0', '0', '7887778', '7887778', '7000000', '0.00'),
(145, 39, 159, '122222', '2025-03-01', '2025-03-28', 'sadasd', '110000', 0, '0', 0, '0', '259259', '222222', '222222', '0', '0', '7010000', '7010000', '7000000', '0.00'),
(146, 39, 160, '100000', '2025-03-01', '2025-03-28', 'include_uang_makan', '110000', 0, '0', 0, '0', '259259', '222222', '222222', '0', '0', '7467778', '7467778', '7000000', '480000.00'),
(147, 55, 161, '200000', '2025-03-01', '2025-03-28', 'test', '11111', 0, '0', 0, '0', '2111111', '1000', '1000', '0', '0', '57210111', '57210111', '57000000', '0.00'),
(148, 63, 162, '100000', '2025-03-01', '2025-03-28', 'tres', '0', 0, '0', 0, '0', '45230', '0', '0', '0', '0', '1321212', '1321212', '1221212', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id_piutang` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `type_piutang` tinyint(1) NOT NULL COMMENT '2 = kasbon, 1 = pinjaman',
  `tenor_piutang` int(10) UNSIGNED NOT NULL COMMENT '2 = 1 bulan, 1 = 3 bulan',
  `amount_piutang` decimal(15,2) NOT NULL,
  `tgl_lunas` date NOT NULL,
  `remaining_piutang` decimal(15,2) NOT NULL,
  `status_piutang` tinyint(1) NOT NULL COMMENT '2 = unpaid, 1 = paid',
  `progress_piutang` tinyint(4) NOT NULL COMMENT '2 = on process, 1 = completed',
  `description_piutang` text NOT NULL,
  `piutang_date` date NOT NULL,
  `type_tenor` tinyint(1) NOT NULL COMMENT '1 = hari, 2 = minggu, 3 = bulan, 4 = tahun',
  `angsuran` decimal(15,0) NOT NULL,
  `jatuh_tempo` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id_piutang`, `id_employee`, `type_piutang`, `tenor_piutang`, `amount_piutang`, `tgl_lunas`, `remaining_piutang`, `status_piutang`, `progress_piutang`, `description_piutang`, `piutang_date`, `type_tenor`, `angsuran`, `jatuh_tempo`) VALUES
(60, 40, 2, 1, '10000.00', '2025-04-12', '0.00', 1, 0, 'test', '2025-02-17', 3, '10000', 12),
(62, 27, 1, 4, '10000.00', '2025-06-25', '5000.00', 2, 0, 'test', '2025-02-25', 3, '2500', 25),
(63, 43, 1, 2, '100000.00', '2025-04-03', '0.00', 1, 0, 'test', '2025-01-25', 3, '50000', 3),
(64, 44, 1, 2, '10000.00', '2025-03-26', '10000.00', 2, 0, 'test', '2025-01-25', 3, '5000', 26),
(65, 30, 1, 2, '20000.00', '2025-03-26', '0.00', 1, 0, 'test', '2025-01-25', 3, '10000', 26),
(66, 40, 1, 2, '10000.00', '2025-04-29', '0.00', 1, 0, 'test', '2025-02-28', 3, '5000', 20);

-- --------------------------------------------------------

--
-- Table structure for table `pkp`
--

CREATE TABLE `pkp` (
  `id_pkp` int(10) UNSIGNED NOT NULL,
  `code_pkp` varchar(10) NOT NULL,
  `tarif_pajak` float NOT NULL,
  `lapisan_pkp` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pkp`
--

INSERT INTO `pkp` (`id_pkp`, `code_pkp`, `tarif_pajak`, `lapisan_pkp`) VALUES
(1, 'L/1', 0.05, '0'),
(2, 'L/2', 0.15, '60000000'),
(3, 'L/3', 0.25, '250000000'),
(4, 'L/4', 0.3, '500000000'),
(5, 'L/5', 0.35, '5000000000');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id_position` int(10) UNSIGNED NOT NULL,
  `code_position` varchar(20) NOT NULL,
  `name_position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id_position`, `code_position`, `name_position`) VALUES
(1, 'JR', 'Junior '),
(2, 'MDL', 'Middle'),
(4, 'SR', 'Senior'),
(5, 'SF', 'Staff'),
(6, 'MGR', 'Manager'),
(8, 'ITR', 'Internship');

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

CREATE TABLE `potongan` (
  `id_potongan` int(10) UNSIGNED NOT NULL,
  `tidak_hadir` decimal(10,0) NOT NULL,
  `potongan_izin` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pph_config`
--

CREATE TABLE `pph_config` (
  `id_pph_config` int(10) UNSIGNED NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_ptkp` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pph_config`
--

INSERT INTO `pph_config` (`id_pph_config`, `id_employee`, `id_ptkp`, `nik`, `npwp`) VALUES
(1, 54, 1, '1234567891234567', '1234567891234567'),
(2, 41, 2, '1234567899123458', '1234567899123459'),
(3, 55, 1, '9876543219028765', '9876543219028765'),
(4, 39, 1, '3214567891234567', '3214567891234567'),
(5, 56, 1, '9812349878123456', '9812349878123456'),
(6, 57, 1, '9812349878123451', NULL),
(7, 60, 1, '9812349878123453', ''),
(8, 61, 1, '1234561234098741', NULL),
(9, 62, 1, '1234561234098746', '1234561234098746'),
(10, 63, 1, '1234567812345670', NULL),
(11, 64, 0, '', NULL),
(12, 65, 0, '', NULL),
(13, 66, 1, '1234567891232145', '1234567891232145'),
(14, 67, 0, '', '12121212'),
(15, 68, 0, '', NULL),
(16, 69, 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` smallint(5) UNSIGNED NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) DEFAULT 'image.png',
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `visibility` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = show, 0 = hide',
  `latitude` varchar(80) DEFAULT NULL,
  `longitude` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description`, `logo`, `url`, `status`, `visibility`, `latitude`, `longitude`) VALUES
(43, 'Gadget Shop Purwakarta', 'Purwakarta', 'c389982f02a469c3682c5cdf77e0bb49.png', '', 1, 1, NULL, NULL),
(44, 'Gadget Care Purwakarta', 'Purwakarta', 'b443e31dcaa71818ae499c4af77075b3.png', '', 1, 1, '-6.242268188654924', '107.0063585338026'),
(45, 'CV.Multi Graha Radhika', 'Center', '4c6b65e753c369905c7ca9ac963af9b0.png', '', 1, 1, '-6.531342747894624', '107.47357585642601'),
(46, 'PT Mencari Cinta Sejati', 'Dummy', 'faca02c6699118518c4d8aa38dd182e9.png', 'http://localhost/starter_ci/admin/product/product_page', 1, 1, NULL, NULL),
(48, 'Gadget Shop Karawang', 'Karawang', 'adeacff83d2b31fee87dd30eb4b72568.png', 'http://localhost/phpmyadmin/sql.php?server=1&db=multigraharadhika&table=products&pos=0', 1, 1, NULL, NULL),
(52, 'Gadget Care Subang', 'Subang', 'd5bebf1e289bfa9ce66420060a0982c9.jpg', '', 1, 1, NULL, NULL),
(53, 'tos', 'test', 'f30a3fab6edcd19d9731d99341121e17.jpg', 'adasda.com', 1, 1, NULL, NULL),
(54, 'Gadget Shop Cikampek', 'Gadget Shop Cikampek', '2aa82d30d575861616920a6ad9c99edd.png', '', 1, 1, '-6.561571334806689', '107.45181230035162');

-- --------------------------------------------------------

--
-- Table structure for table `ptkp`
--

CREATE TABLE `ptkp` (
  `id_ptkp` int(10) UNSIGNED NOT NULL,
  `code_ptkp` varchar(20) NOT NULL,
  `keterangan_ptkp` varchar(100) NOT NULL,
  `pot_ptkp` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ptkp`
--

INSERT INTO `ptkp` (`id_ptkp`, `code_ptkp`, `keterangan_ptkp`, `pot_ptkp`) VALUES
(1, 'TK/0', 'Tidak Kawin, tanpa tanggungan', '54000000'),
(2, 'TK/1', 'Tidak Kawin, dengan 1 tanggungan', '58500000'),
(3, 'TK/2', 'Tidak Kawin, dengan 2 tanggungan', '63000000'),
(4, 'TK/3', 'Tidak Kawin, dengan 3 tanggungan', '67500000'),
(5, 'K/0', 'Kawin, tanpa tanggungan', '58500000'),
(6, 'K/1', 'Kawin, dengan 1 tanggungan', '63000000'),
(7, 'K/2', 'Kawin, dengan 2 tanggungan', '67500000'),
(8, 'K/3', 'Kawin, dengan 3 tanggungan (maksimal)', '72000000');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id_purchases` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `input_at` date NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `pot_amount` decimal(15,2) NOT NULL,
  `final_amount` decimal(15,2) NOT NULL,
  `remaining_amount` decimal(15,2) NOT NULL,
  `status_purchases` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = unpaid, 1 = paid',
  `description` text NOT NULL DEFAULT '-',
  `payment_type` tinyint(1) NOT NULL COMMENT '1 = debit, 2 = kredit',
  `jatuh_tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id_purchases`, `id_supplier`, `created_at`, `input_at`, `total_amount`, `pot_amount`, `final_amount`, `remaining_amount`, `status_purchases`, `description`, `payment_type`, `jatuh_tempo`) VALUES
(22, 5, '2025-01-24 09:59:10', '2025-01-24', '100000.00', '1000.00', '99000.00', '0.00', 1, 'test', 2, '2025-02-20'),
(25, 5, '2025-02-01 09:26:39', '2025-02-01', '10000.00', '2100.00', '7900.00', '0.00', 1, 'test', 2, '2025-02-20'),
(26, 5, '2025-02-01 09:27:06', '2025-02-01', '100000.00', '2000.00', '98000.00', '90991.00', 0, 'test', 2, '2025-02-01'),
(27, 5, '2025-02-04 10:23:38', '2025-02-04', '109000.00', '20000.00', '89000.00', '79000.00', 0, 'test', 2, '2025-12-02'),
(29, 5, '2025-02-04 13:41:24', '2025-02-04', '100000.00', '10000.00', '90000.00', '90000.00', 0, 'test', 2, '2025-02-04'),
(30, 6, '2025-02-28 14:32:39', '2025-02-28', '1212222.00', '1000.00', '1211222.00', '0.00', 1, 'test', 2, '2025-03-31'),
(31, 6, '2025-02-28 14:34:27', '2025-02-28', '100000.00', '10000.00', '90000.00', '0.00', 1, 'test', 1, '2025-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id_payment` int(10) UNSIGNED NOT NULL,
  `id_purchases` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_date` date NOT NULL DEFAULT current_timestamp(),
  `payment_amount` decimal(15,2) NOT NULL,
  `description` text NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_payments`
--

INSERT INTO `purchase_payments` (`id_payment`, `id_purchases`, `created_at`, `payment_date`, `payment_amount`, `description`) VALUES
(59, 22, '2025-01-24 10:05:29', '2025-01-24', '10000.00', 'test'),
(60, 26, '2025-02-01 09:28:04', '2025-02-01', '9.00', ' test'),
(61, 26, '2025-02-01 11:42:47', '2025-02-01', '7000.00', ' test'),
(62, 25, '2025-02-01 13:49:01', '2025-02-01', '7900.00', 'TEST '),
(63, 22, '2025-02-04 09:43:51', '2025-02-04', '9000.00', 'test '),
(64, 27, '2025-02-04 10:26:48', '2025-02-04', '10000.00', 'test '),
(66, 22, '2025-02-20 16:40:48', '2025-02-20', '80000.00', ' tges'),
(67, 30, '2025-02-28 14:33:02', '2025-02-28', '10000.00', ' test'),
(68, 30, '2025-02-28 14:33:13', '2025-02-28', '1201222.00', ' test');

--
-- Triggers `purchase_payments`
--
DELIMITER $$
CREATE TRIGGER `after_payment_delete` AFTER DELETE ON `purchase_payments` FOR EACH ROW BEGIN
    -- Update remaining_amount di tabel purchases
    UPDATE purchases
    SET remaining_amount = final_amount - (
        SELECT IFNULL(SUM(payment_amount), 0)
        FROM purchase_payments
        WHERE id_purchases = OLD.id_purchases
    )
    WHERE id_purchases = OLD.id_purchases;

    -- Update status_purchases berdasarkan remaining_amount
    UPDATE purchases
    SET status_purchases = CASE
        WHEN remaining_amount = 0 THEN 1
        ELSE 0
    END
    WHERE id_purchases = OLD.id_purchases;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_payment_insert` AFTER INSERT ON `purchase_payments` FOR EACH ROW BEGIN
    -- Update remaining_amount di tabel purchases
    UPDATE purchases
    SET remaining_amount = final_amount - (
        SELECT IFNULL(SUM(payment_amount), 0)
        FROM purchase_payments
        WHERE id_purchases = NEW.id_purchases
    )
    WHERE id_purchases = NEW.id_purchases;

    -- Update status_purchases berdasarkan remaining_amount
    UPDATE purchases
    SET status_purchases = CASE
        WHEN remaining_amount = 0 THEN 1
        ELSE 0
    END
    WHERE id_purchases = NEW.id_purchases;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_payment_update` AFTER UPDATE ON `purchase_payments` FOR EACH ROW BEGIN
    -- Update remaining_amount di tabel purchases
    UPDATE purchases
    SET remaining_amount = final_amount - (
        SELECT IFNULL(SUM(payment_amount), 0)
        FROM purchase_payments
        WHERE id_purchases = NEW.id_purchases
    )
    WHERE id_purchases = NEW.id_purchases;

    -- Update status_purchases berdasarkan remaining_amount
    UPDATE purchases
    SET status_purchases = CASE
        WHEN remaining_amount = 0 THEN 1
        ELSE 0
    END
    WHERE id_purchases = NEW.id_purchases;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_piutang`
--

CREATE TABLE `purchase_piutang` (
  `id_purchase_piutang` int(10) UNSIGNED NOT NULL,
  `id_piutang` int(10) UNSIGNED NOT NULL,
  `pay_amount` decimal(15,2) NOT NULL,
  `description` text NOT NULL,
  `pay_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_piutang`
--

INSERT INTO `purchase_piutang` (`id_purchase_piutang`, `id_piutang`, `pay_amount`, `description`, `pay_date`) VALUES
(45, 60, '10000.00', ' test', '2025-02-25'),
(47, 62, '2500.00', ' test', '2025-03-19'),
(48, 65, '10000.00', '2025-02-25-testjan-Test111', '2025-02-25'),
(49, 63, '50000.00', '2025-02-25-testjan-Test111', '2025-02-25'),
(50, 62, '2500.00', '2025-02-27-TEST-RRRR', '2025-02-27'),
(51, 66, '5000.00', ' test', '2025-02-28'),
(52, 66, '5000.00', ' 5000', '2025-02-28'),
(53, 65, '10000.00', '2025-03-31-SSSS-TWST', '2025-03-31'),
(54, 63, '50000.00', '2025-03-31-SSSS-TWST', '2025-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(10) UNSIGNED NOT NULL,
  `id_workshift` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = Tersedia, 2 = Dayoff, 3 = Holyday, 4 = Cuti, 5 = Izin, 6 = Hadir, 7 = Absen',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_workshift`, `id_employee`, `status`, `start_date`, `end_date`, `waktu`) VALUES
(1351, 9, 39, 6, '2025-03-21', '2025-03-22', '2025-03-21'),
(1352, 9, 39, 7, '2025-03-21', '2025-03-22', '2025-03-22'),
(1353, 3, 55, 7, '2025-03-21', '2025-03-22', '2025-03-21'),
(1354, 3, 55, 6, '2025-03-21', '2025-03-22', '2025-03-22'),
(1355, 3, 52, 7, '2025-03-24', '2025-03-24', '2025-03-24'),
(1362, 3, 65, 2, '2025-03-25', '2025-03-31', '2025-03-25'),
(1363, 3, 65, 2, '2025-03-25', '2025-03-31', '2025-03-26'),
(1364, 3, 65, 1, '2025-03-25', '2025-03-31', '2025-03-29'),
(1365, 3, 65, 2, '2025-03-25', '2025-03-31', '2025-03-31'),
(1366, 3, 41, 7, '2025-03-25', '2025-03-31', '2025-03-25'),
(1367, 3, 41, 2, '2025-03-25', '2025-03-31', '2025-03-26'),
(1368, 3, 41, 7, '2025-03-25', '2025-03-31', '2025-03-27'),
(1369, 3, 41, 1, '2025-03-25', '2025-03-31', '2025-03-28'),
(1370, 3, 41, 1, '2025-03-25', '2025-03-31', '2025-03-29'),
(1371, 3, 41, 2, '2025-03-25', '2025-03-31', '2025-03-30'),
(1372, 3, 41, 1, '2025-03-25', '2025-03-31', '2025-03-31'),
(1373, 3, 68, 7, '2025-03-25', '2025-03-31', '2025-03-25'),
(1374, 3, 68, 2, '2025-03-25', '2025-03-31', '2025-03-26'),
(1375, 3, 68, 7, '2025-03-25', '2025-03-31', '2025-03-27'),
(1376, 3, 68, 2, '2025-03-25', '2025-03-31', '2025-03-28'),
(1377, 3, 68, 1, '2025-03-25', '2025-03-31', '2025-03-29'),
(1378, 3, 68, 2, '2025-03-25', '2025-03-31', '2025-03-30'),
(1379, 3, 68, 1, '2025-03-25', '2025-03-31', '2025-03-31'),
(1380, 3, 39, 6, '2025-03-25', '2025-03-25', '2025-03-25'),
(1381, 3, 42, 7, '2025-03-25', '2025-03-27', '2025-03-26'),
(1382, 3, 42, 7, '2025-03-25', '2025-03-27', '2025-03-27'),
(1383, 3, 42, 7, '2025-03-25', '2025-03-27', '2025-03-25'),
(1384, 9, 60, 7, '2025-03-27', '2025-03-29', '2025-03-27'),
(1385, 9, 60, 1, '2025-03-27', '2025-03-29', '2025-03-28'),
(1386, 9, 60, 1, '2025-03-27', '2025-03-29', '2025-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `service_teknisi`
--

CREATE TABLE `service_teknisi` (
  `id_service_teknisi` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `pendapatan_service` decimal(15,0) NOT NULL,
  `total_service` int(11) NOT NULL,
  `tanggal_service` date NOT NULL,
  `input_at` datetime NOT NULL DEFAULT current_timestamp(),
  `type_service` varchar(80) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_teknisi`
--

INSERT INTO `service_teknisi` (`id_service_teknisi`, `id_employee`, `pendapatan_service`, `total_service`, `tanggal_service`, `input_at`, `type_service`, `description`, `status`) VALUES
(1, 47, '100000', 1000000, '2025-02-24', '2025-02-24 00:00:00', 'Ganti LCD', 'test', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `name_supplier` varchar(100) NOT NULL,
  `contact_info` varchar(20) NOT NULL,
  `status_supplier` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `date_created`, `name_supplier`, `contact_info`, `status_supplier`, `updated_at`) VALUES
(3, '2025-01-10 10:44:10', 'Sinar Abadi', '08111234322', 0, '2025-01-16 10:04:47'),
(5, '2025-01-14 15:36:17', 'PT Sadbor', '0812121212', 1, '2025-01-21 10:38:19'),
(6, '2025-02-28 14:31:43', 'PT.Timah', '0827772224', 1, '2025-02-28 14:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `tax_config`
--

CREATE TABLE `tax_config` (
  `id_tax_config` int(10) UNSIGNED NOT NULL,
  `id_payroll_component` int(11) NOT NULL,
  `pkp` decimal(15,0) NOT NULL,
  `bruto` decimal(15,0) NOT NULL,
  `netto` decimal(15,0) NOT NULL,
  `biaya_jabatan` decimal(15,0) NOT NULL,
  `pengurang_pajak` decimal(15,0) NOT NULL,
  `pot_ptkp` decimal(15,0) NOT NULL,
  `akumulatif_pph` decimal(15,0) NOT NULL,
  `hasil_pph` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_izin`
--

CREATE TABLE `type_izin` (
  `id_type_izin` tinyint(2) UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uang_makan`
--

CREATE TABLE `uang_makan` (
  `id_uang_makan` int(10) UNSIGNED NOT NULL,
  `id_batch_uang_makan` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `total_izin` int(11) NOT NULL,
  `total_holiday` int(11) NOT NULL,
  `total_cuti` int(11) NOT NULL,
  `pot_izin` decimal(15,0) NOT NULL,
  `pot_cuti` decimal(15,0) NOT NULL,
  `pot_holiday` decimal(15,0) NOT NULL,
  `total_absen` int(11) NOT NULL,
  `pot_absen` decimal(15,0) NOT NULL,
  `bonus` decimal(15,2) NOT NULL DEFAULT 0.00,
  `basic_uang_makan` decimal(15,2) NOT NULL,
  `total_pot_uang_makan` decimal(10,0) NOT NULL,
  `total_uang_makan` decimal(15,0) NOT NULL,
  `input_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uang_makan`
--

INSERT INTO `uang_makan` (`id_uang_makan`, `id_batch_uang_makan`, `id_employee`, `total_izin`, `total_holiday`, `total_cuti`, `pot_izin`, `pot_cuti`, `pot_holiday`, `total_absen`, `pot_absen`, `bonus`, `basic_uang_makan`, `total_pot_uang_makan`, `total_uang_makan`, `input_at`) VALUES
(14, 18, 55, 0, 0, 0, '0', '0', '0', 0, '0', '10000.00', '1200000.00', '0', '1210000', '2025-03-28'),
(15, 19, 65, 0, 0, 0, '0', '0', '0', 0, '0', '0.00', '480000.00', '0', '480000', '2025-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `workshift`
--

CREATE TABLE `workshift` (
  `id_workshift` int(10) UNSIGNED NOT NULL,
  `code_workshift` varchar(15) NOT NULL,
  `name_workshift` varchar(60) NOT NULL,
  `clock_in` time NOT NULL,
  `clock_out` time NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workshift`
--

INSERT INTO `workshift` (`id_workshift`, `code_workshift`, `name_workshift`, `clock_in`, `clock_out`, `description`) VALUES
(3, 'SHFT1', 'Shift 01', '06:00:00', '20:00:00', 'TYRS'),
(4, 'SHIFTSUPPORT', 'SUPPORT', '05:00:00', '15:00:00', 'ASDSAD'),
(8, 'TEST', 'TEST', '13:00:00', '15:25:00', 'ASSA'),
(9, '32e3', '3212', '23:00:00', '16:13:00', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_code`
--
ALTER TABLE `account_code`
  ADD PRIMARY KEY (`id_code`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id_attendance`),
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id_bank`),
  ADD KEY `id_employee` (`id_employee`) USING BTREE;

--
-- Indexes for table `batch_uang_makan`
--
ALTER TABLE `batch_uang_makan`
  ADD PRIMARY KEY (`id_batch_uang_makan`);

--
-- Indexes for table `bpjs_config`
--
ALTER TABLE `bpjs_config`
  ADD PRIMARY KEY (`id_bpjs_config`),
  ADD UNIQUE KEY `no_bpjs` (`no_bpjs`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `day_off`
--
ALTER TABLE `day_off`
  ADD PRIMARY KEY (`id_day_off`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id_division`);

--
-- Indexes for table `domisili`
--
ALTER TABLE `domisili`
  ADD PRIMARY KEY (`id_domisili`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD PRIMARY KEY (`id_contact`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_division` (`id_division`),
  ADD KEY `id_position` (`id_position`);

--
-- Indexes for table `finance_records`
--
ALTER TABLE `finance_records`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `holyday`
--
ALTER TABLE `holyday`
  ADD PRIMARY KEY (`id_holyday`),
  ADD KEY `id_division` (`id_division`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`);

--
-- Indexes for table `log_contract_extension`
--
ALTER TABLE `log_contract_extension`
  ADD PRIMARY KEY (`id_log_contract_extension`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id_overtime`),
  ADD KEY `id_overtime` (`id_overtime`,`id_employee`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id_payroll`);

--
-- Indexes for table `payroll_component`
--
ALTER TABLE `payroll_component`
  ADD PRIMARY KEY (`id_payroll_component`),
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_payroll` (`id_payroll`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id_piutang`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `pkp`
--
ALTER TABLE `pkp`
  ADD PRIMARY KEY (`id_pkp`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`),
  ADD UNIQUE KEY `code_position` (`code_position`);

--
-- Indexes for table `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indexes for table `pph_config`
--
ALTER TABLE `pph_config`
  ADD PRIMARY KEY (`id_pph_config`),
  ADD UNIQUE KEY `nik` (`nik`,`npwp`),
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_ptkp` (`id_ptkp`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `ptkp`
--
ALTER TABLE `ptkp`
  ADD PRIMARY KEY (`id_ptkp`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id_purchases`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_purchases` (`id_purchases`);

--
-- Indexes for table `purchase_piutang`
--
ALTER TABLE `purchase_piutang`
  ADD PRIMARY KEY (`id_purchase_piutang`),
  ADD KEY `id_piutang` (`id_piutang`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_workshift` (`id_workshift`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `service_teknisi`
--
ALTER TABLE `service_teknisi`
  ADD PRIMARY KEY (`id_service_teknisi`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tax_config`
--
ALTER TABLE `tax_config`
  ADD PRIMARY KEY (`id_tax_config`),
  ADD KEY `id_payroll_component` (`id_payroll_component`) USING BTREE;

--
-- Indexes for table `type_izin`
--
ALTER TABLE `type_izin`
  ADD PRIMARY KEY (`id_type_izin`);

--
-- Indexes for table `uang_makan`
--
ALTER TABLE `uang_makan`
  ADD PRIMARY KEY (`id_uang_makan`),
  ADD KEY `id_batch_uang_makan` (`id_batch_uang_makan`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `workshift`
--
ALTER TABLE `workshift`
  ADD PRIMARY KEY (`id_workshift`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_code`
--
ALTER TABLE `account_code`
  MODIFY `id_code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id_attendance` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id_bank` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `batch_uang_makan`
--
ALTER TABLE `batch_uang_makan`
  MODIFY `id_batch_uang_makan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bpjs_config`
--
ALTER TABLE `bpjs_config`
  MODIFY `id_bpjs_config` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `day_off`
--
ALTER TABLE `day_off`
  MODIFY `id_day_off` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id_division` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `domisili`
--
ALTER TABLE `domisili`
  MODIFY `id_domisili` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id_contact` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `finance_records`
--
ALTER TABLE `finance_records`
  MODIFY `id_record` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `holyday`
--
ALTER TABLE `holyday`
  MODIFY `id_holyday` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=659;

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_contract_extension`
--
ALTER TABLE `log_contract_extension`
  MODIFY `id_log_contract_extension` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id_overtime` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id_payroll` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `payroll_component`
--
ALTER TABLE `payroll_component`
  MODIFY `id_payroll_component` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `pkp`
--
ALTER TABLE `pkp`
  MODIFY `id_pkp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id_position` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `potongan`
--
ALTER TABLE `potongan`
  MODIFY `id_potongan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pph_config`
--
ALTER TABLE `pph_config`
  MODIFY `id_pph_config` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `ptkp`
--
ALTER TABLE `ptkp`
  MODIFY `id_ptkp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id_purchases` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id_payment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `purchase_piutang`
--
ALTER TABLE `purchase_piutang`
  MODIFY `id_purchase_piutang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1387;

--
-- AUTO_INCREMENT for table `service_teknisi`
--
ALTER TABLE `service_teknisi`
  MODIFY `id_service_teknisi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tax_config`
--
ALTER TABLE `tax_config`
  MODIFY `id_tax_config` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `type_izin`
--
ALTER TABLE `type_izin`
  MODIFY `id_type_izin` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uang_makan`
--
ALTER TABLE `uang_makan`
  MODIFY `id_uang_makan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `workshift`
--
ALTER TABLE `workshift`
  MODIFY `id_workshift` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
