-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 09:00 AM
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
(4, 53, '', 'Indramayu', 'Gabus', 'Kedung', 'Kawolu  RT 06 RW 03', 32767, ' test');

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
  `role` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = ROOT, 2 = ADMIN, 3 = EMPLOYEE',
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
(7, '2024-12-17 11:32:08', 'Admin', 'admin@admin.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-01-06 11:42:38', '2025-01-06 11:42:38', '127.0.0.1', ''),
(8, '2024-12-17 11:32:33', 'Super User', 'superuser@superuser.com', 'd1pEeHVad0diUnBTeUpPL0RTNTA3QT09', 1, 1, '2025-02-28 11:38:02', '2025-02-28 11:38:02', '127.0.0.1', '20fa8f15cecb411184ecb29b07b84a83.jpg'),
(9, '2025-01-20 14:56:04', 'Aditia', 'aditia@gmail.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-01-20 15:57:34', '2025-01-20 15:57:34', '127.0.0.1', ''),
(10, '2025-01-20 15:09:09', 'sssUser', '222sa@superuser.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 1, 1, '2025-01-20 15:52:58', '2025-01-20 15:52:58', '127.0.0.1', ''),
(11, '2025-01-20 15:09:27', 'Aditia', 'aditiasss@gmail.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-01-20 15:48:16', '2025-01-20 15:48:16', '127.0.0.1', ''),
(12, '2025-02-05 15:17:28', 'Rita Rika ', 'rita@email.com', 'bCszR1FkMGkzMzlSSTNDOTYwaFV2QT09', 3, 1, '2025-02-26 13:27:19', '2025-02-26 13:27:19', '127.0.0.1', '0c921eca68e0b0cb88bd3c03a4c8fd47.jpg'),
(13, '2025-02-12 10:25:58', 'agus', 'agus@gmail.com', 'bCszR1FkMGkzMzlSSTNDOTYwaFV2QT09', 3, 1, '2025-02-25 15:31:49', '2025-02-25 15:31:49', '127.0.0.1', ''),
(14, '2025-02-14 14:51:26', 'Luna', 'luna@gmail.com', 'bCszR1FkMGkzMzlSSTNDOTYwaFV2QT09', 3, 1, '2025-02-14 15:55:03', '2025-02-14 15:55:03', '127.0.0.1', ''),
(15, '2025-02-15 08:28:48', 'Alex', 'alex@email.com', 'di9lNWwxR0JNYlk0TXRjUkRnNUFuUT09', 3, 1, '2025-02-25 15:33:38', '2025-02-25 15:33:38', '127.0.0.1', ''),
(16, '2025-02-15 08:31:22', 'Zilong', 'zilong@gmail.com', 'TjJ4RGw4azRWNkhxZk5kb2c0b3ZSQT09', 3, 1, '2025-02-28 11:31:13', '2025-02-28 11:31:13', '127.0.0.1', ''),
(17, '2025-02-15 08:35:58', 'Pika', 'pika@gmail.com', 'SVFXY0VKV203TTlmNCtZc0NMWlJTUT09', 3, 1, '2025-02-28 11:38:35', '2025-02-28 11:38:35', '127.0.0.1', ''),
(18, '2025-02-15 08:42:32', 'Zuki', 'zuki@gmail.com', 'cUtPSlNrc3VtZUZRZE9vS0xqVnZoUT09', 3, 1, '2025-02-28 11:24:39', '2025-02-28 11:24:39', '127.0.0.1', ''),
(19, '2025-02-21 16:47:47', 'Dita', 'dita@gmail.com', 'NUxFM2N5UkwwSkhuUVlheVdHdklXQT09', 3, 1, '2025-02-21 16:47:47', NULL, NULL, ''),
(20, '2025-02-21 16:59:24', 'Dito', 'dito@gmail.com', 'VXZjM2ZpQnQ1OEdRcFZXRDRoQk9tQT09', 3, 1, '2025-02-21 16:59:24', NULL, NULL, ''),
(21, '2025-02-21 17:01:52', 'Diki', 'diki@gmail.com', 'bU1zOE5ndXdpd0h4OGNCREhraHhiZz09', 3, 1, '2025-02-21 17:01:52', NULL, NULL, ''),
(22, '2025-02-21 17:04:19', 'Dodi', 'dodi@gmail.com', 'UGxUbzBqVml6OUxnZDY0bGl2V2Jidz09', 3, 1, '2025-02-21 17:04:19', NULL, NULL, ''),
(23, '2025-02-24 10:15:17', 'Arga', 'arga@gmail.com', 'ZitRNXp1bnBaZGFlVDlDTzFLZ3RtUT09', 3, 1, '2025-02-24 10:15:17', NULL, NULL, ''),
(24, '2025-02-24 10:16:54', 'Gara', 'gara@gmail.com', 'ajl5bHFKazlXT3JTZzJmbjZ2UDRqdz09', 3, 1, '2025-02-24 10:16:54', NULL, NULL, ''),
(25, '2025-02-24 10:21:22', 'Pawa', 'pawa@gmail.com', 'aEhxYnBteFhWTVRibTZMYXRWZGxhUT09', 3, 1, '2025-02-24 10:21:22', NULL, NULL, ''),
(27, '2025-02-26 16:53:36', 'Sumiyati', 'sumiyati@gmail.com', 'Rm80a01yc0xZVXgraDhLRy92aHZQQT09', 3, 1, '2025-02-26 16:53:36', NULL, NULL, ''),
(28, '2025-02-27 12:00:37', 'Titis', 'titis@gmail.com', 'SjdzNFI3U1AzUlV1c1ArZ2JtNUR4QT09', 3, 1, '2025-02-27 12:00:37', NULL, NULL, ''),
(29, '2025-02-27 13:08:59', 'Titis', 'tatas@gmail.com', 'enRmd1lJaCtkQ1REdVJxdlVnNHN3Zz09', 3, 1, '2025-02-28 11:18:57', '2025-02-28 11:18:57', '127.0.0.1', '');

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
  `location_latitude` varchar(70) NOT NULL,
  `location_longitude` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id_bank` smallint(5) UNSIGNED NOT NULL,
  `id_employee` smallint(5) UNSIGNED NOT NULL,
  `bank_number` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_holder_name` varchar(100) NOT NULL
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
(23, 53, '122241', 'OCBC', 'Sumiyati');

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
(24, 41, 1, '2025-02-20', NULL, 1, 'test', 2, '2025-02-20'),
(25, 38, 2, '2025-02-20', '2025-02-21', 2, 'test', 2, '2025-02-20');

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
(11, 39, '2025-02-27', '2025-02-25', 'TESDT', 2);

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
(4, 53, '', 'Purwakarta', 'Purwakarta', 'Gantri', 'Situ bulued', 12002, ' test');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `id_contact` smallint(5) UNSIGNED NOT NULL,
  `id_employee` smallint(5) UNSIGNED NOT NULL,
  `name_contact` varchar(100) NOT NULL,
  `number_contact` varchar(50) NOT NULL,
  `as_contact` tinyint(4) NOT NULL COMMENT '0 = Keluarga, 1= Teman,',
  `address_contact` varchar(100) NOT NULL
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
(24, 53, 'Luna', '08223311223', 1, 'tes');

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
  `bonus` decimal(15,2) NOT NULL,
  `type_employee` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Kontrak, 2 = Magang, 3 = Permanen',
  `contract_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `id_division`, `id_position`, `id_product`, `email`, `no_hp`, `date_in`, `nip`, `name`, `gender`, `place_of_birth`, `date_of_birth`, `status`, `basic_salary`, `uang_makan`, `bonus`, `type_employee`, `contract_expired`) VALUES
(27, 1, 1, 48, 'agus@gmail.com', '0', '2022-12-01', '1212121213', 'Agus', 'L', 'Indramayu', '2001-12-01', 1, '4800000.00', '480000.00', '0.00', 1, NULL),
(30, 3, 2, 52, 'luna@gmail.com', '0', '2025-02-05', '11111222', 'Luna', 'P', 'Tangerang', '2012-12-01', 1, '3000000.00', '22222.00', '0.00', 1, NULL),
(38, 3, 2, 44, 'rita@email.com', '0', '2022-12-01', '10519199', 'Rita Rika ', 'L', '1212121', '2000-12-01', 1, '11000000.00', '480000.00', '0.00', 1, NULL),
(39, 1, 4, 45, 'alex@email.com', '0', '2024-01-17', '1051919991', 'Alex', 'L', 'Priuk', '2001-05-15', 1, '7000000.00', '480000.00', '0.00', 1, NULL),
(40, 3, 2, 45, 'zilong@gmail.com', '0', '2021-12-22', '12121212121', 'Zilong', 'L', 'London', '1999-12-01', 1, '4500000.00', '480000.00', '0.00', 1, NULL),
(41, 5, 1, 45, 'pika@gmail.com', '0', '2020-12-22', '1958238288', 'Pika', 'P', 'Campaka', '2002-02-22', 1, '3000000.00', '480000.00', '0.00', 1, NULL),
(42, 1, 2, 44, 'zuki@gmail.com', '0', '2023-12-02', '121212121', 'Zuki', 'L', 'Purwakarta', '2001-12-12', 1, '4000000.00', '480000.00', '0.00', 1, NULL),
(43, 3, 4, 52, 'dita@gmail.com', '0', '2024-12-14', '12121212', 'Dita', 'P', 'Cikampek', '2000-12-01', 1, '3000000.00', '190000.00', '0.00', 1, NULL),
(44, 5, 5, 52, 'dito@gmail.com', '0', '2025-02-08', '12121212212', 'Dito', 'L', 'Cikopo', '2002-12-12', 1, '1800000.00', '480000.00', '0.00', 1, NULL),
(45, 1, 2, 43, 'diki@gmail.com', '0', '2025-02-15', '121212121212', 'Diki', 'L', 'Cikopo', '2001-02-26', 1, '4000000.00', '480000.00', '0.00', 2, '2025-04-30'),
(46, 1, 1, 48, 'dodi@gmail.com', '0', '2025-02-01', '12121234', 'Dodi', 'L', 'Cikopo', '2000-02-13', 1, '1000000.00', '400000.00', '0.00', 2, '2025-08-23'),
(47, 4, 1, 48, 'arga@gmail.com', '0', '2025-02-01', '107239984', 'Arga', 'L', 'Indramayu', '1999-12-12', 1, '0.00', '480000.00', '0.00', 1, '2025-04-29'),
(48, 4, 4, 43, 'gara@gmail.com', '0', '2025-02-20', '108277533', 'Gara', 'L', 'Indramayu', '2002-12-01', 1, '0.00', '0.00', '0.00', 1, '2026-12-01'),
(49, 4, 1, 48, 'pawa@gmail.com', '0', '2025-02-17', '18092331', 'Pawa', 'L', 'Tangerang', '2000-12-09', 1, '0.00', '0.00', '0.00', 1, '2026-02-12'),
(51, 1, 1, 52, 'sumiyati@gmail.com', '0812223121', '2025-02-01', '11122112', 'Sumiyati', 'L', 'Indr', '1999-02-14', 1, '3000000.00', '380000.00', '0.00', 1, '2025-09-30'),
(52, 1, 2, 46, 'titis@gmail.com', '02323231231', '2025-02-01', '121213221', 'Titis', 'P', 'Tangerang', '2000-12-31', 1, '3000000.00', '480000.00', '0.00', 1, '2025-03-31'),
(53, 1, 4, 46, 'tatas@gmail.com', '02323231231', '2025-02-01', '12122122222', 'Tatas', 'L', 'Tangerang', '2000-02-22', 1, '3500000.00', '380000.00', '0.00', 1, '2025-04-30');

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
(43, '2024-12-26 11:06:46', '2024-12-26 11:06:46', 43, '1000000.00', 45, 'Test Yesterday', '2024-12-27 15:49:34'),
(48, '2024-12-27 15:37:05', '2024-12-27 15:37:05', 46, '232323.00', 39, 'Test sssRecord DATE', '2024-12-31 16:37:38'),
(49, '2024-12-27 15:42:06', '2024-12-20 15:41:00', 44, '11111.00', 23, '12121212', '2025-01-02 09:34:02'),
(50, '2024-12-27 15:42:46', '2024-11-26 15:42:00', 44, '10000.00', 40, 'Last month', '2024-12-27 15:42:46'),
(51, '2024-12-27 15:47:57', '2023-12-27 15:47:00', 43, '112123.00', 33, 'Test Last Year', '2024-12-27 15:47:57'),
(52, '2024-12-28 10:50:03', '2024-12-29 10:49:00', 48, '12122223.00', 48, 'Tests', '2025-01-02 09:32:43'),
(54, '2024-12-31 16:37:25', '2024-12-31 16:36:00', 48, '100000.00', 42, 'Motor odong2', '2024-12-31 16:37:25'),
(55, '2025-01-02 16:22:27', '2025-01-02 16:22:00', 45, '100000.00', 11, 'test2', '2025-01-21 10:43:14'),
(56, '2025-01-02 16:32:19', '2025-01-01 16:29:00', 45, '111242.00', 17, 'test1', '2025-01-21 10:41:48'),
(58, '2025-01-09 14:11:46', '2025-01-09 14:11:00', 44, '23232.00', 32, 'test3', '2025-01-21 10:42:05'),
(59, '2025-01-13 16:36:12', '2025-01-14 16:36:00', 44, '1000000.00', 34, 'test4', '2025-01-21 10:42:15'),
(60, '2025-01-20 09:44:48', '2025-01-20 09:44:00', 48, '1000000.00', 1, 'test5', '2025-01-21 10:42:22'),
(61, '2025-01-21 10:43:57', '2025-01-21 10:43:00', 44, '1000000.00', 52, 'test', '2025-01-21 10:43:57'),
(79, '2025-02-27 14:47:09', '2025-03-27 00:00:00', 46, '3480000.00', 22, '2025-03-27-tesst-121212', '2025-02-27 14:47:09'),
(80, '2025-02-27 14:47:09', '2025-03-27 00:00:00', 46, '3880000.00', 22, '2025-03-27-tesst-121212', '2025-02-27 14:47:09'),
(81, '2025-02-27 14:56:35', '2025-04-27 00:00:00', 46, '3480000.00', 22, '2025-04-27-tewqerqsdsa-tsssss', '2025-02-27 14:56:35'),
(82, '2025-02-27 14:56:35', '2025-04-27 00:00:00', 46, '3880000.00', 22, '2025-04-27-tewqerqsdsa-tsssss', '2025-02-27 14:56:35'),
(83, '2025-02-27 15:00:13', '2025-04-27 00:00:00', 46, '3480000.00', 22, '2025-04-27-test-tesett2', '2025-02-27 15:00:13'),
(84, '2025-02-27 15:00:13', '2025-04-27 00:00:00', 46, '3880000.00', 22, '2025-04-27-test-tesett2', '2025-02-27 15:00:13'),
(85, '2025-02-27 15:03:44', '2025-03-27 00:00:00', 46, '3320000.00', 22, '2025-03-27-test-testhol', '2025-02-27 15:03:44'),
(86, '2025-02-27 15:03:44', '2025-03-27 00:00:00', 46, '3880000.00', 22, '2025-03-27-test-testhol', '2025-02-27 15:03:44'),
(87, '2025-02-27 15:21:49', '2025-03-31 00:00:00', 45, '7300000.00', 22, '2025-03-31-test-tessst', '2025-02-27 15:21:49'),
(89, '2025-02-27 15:25:24', '2025-03-31 00:00:00', 46, '3080000.00', 22, '2025-03-31-rwdasw-wetfwqedfawd', '2025-02-27 15:25:24'),
(90, '2025-02-27 15:25:24', '2025-03-31 00:00:00', 46, '3880000.00', 22, '2025-03-31-rwdasw-wetfwqedfawd', '2025-02-27 15:25:24'),
(91, '2025-02-27 15:26:00', '2025-03-31 00:00:00', 45, '3380000.00', 22, '2025-03-31-12312321-23eq2wed', '2025-02-27 15:26:00'),
(92, '2025-02-27 15:38:40', '2025-03-31 00:00:00', 46, '3480000.00', 22, '2025-03-31-test-test', '2025-02-27 15:38:40'),
(93, '2025-02-27 15:38:40', '2025-03-31 00:00:00', 46, '3880000.00', 22, '2025-03-31-test-test', '2025-02-27 15:38:40'),
(94, '2025-02-27 15:39:31', '2025-03-31 00:00:00', 46, '3480000.00', 22, '2025-03-31-tessss-131212', '2025-02-27 15:39:31'),
(95, '2025-02-27 15:39:31', '2025-03-31 00:00:00', 46, '3880000.00', 22, '2025-03-31-tessss-131212', '2025-02-27 15:39:31'),
(96, '2025-02-27 16:24:00', '2025-03-31 00:00:00', 46, '3400000.00', 22, '2025-03-31-TERES-12121', '2025-02-27 16:24:00'),
(97, '2025-02-27 16:24:00', '2025-03-31 00:00:00', 46, '3816668.00', 22, '2025-03-31-TERES-12121', '2025-02-27 16:24:00'),
(98, '2025-02-27 16:57:50', '2025-03-31 00:00:00', 46, '3440000.00', 22, '2025-03-31-test-dscsadas', '2025-02-27 16:57:50'),
(99, '2025-02-27 16:57:50', '2025-03-31 00:00:00', 46, '3848334.00', 22, '2025-03-31-test-dscsadas', '2025-02-27 16:57:50'),
(100, '2025-02-28 14:19:24', '2025-02-28 14:19:00', 45, '1111111.00', 16, 'test', '2025-02-28 14:19:24'),
(101, '2025-02-28 14:21:37', '2025-02-28 14:19:00', 45, '2323232.00', 46, 'test', '2025-02-28 14:21:37'),
(102, '2025-02-28 14:37:44', '2025-03-31 00:00:00', 45, '7480000.00', 22, '2025-03-31-testt-test', '2025-02-28 14:37:44'),
(103, '2025-02-28 14:45:13', '2025-02-28 00:00:00', 45, '3480000.00', 22, '2025-02-28-23232323-testttttt', '2025-02-28 14:45:13'),
(104, '2025-02-28 14:47:55', '2025-02-28 00:00:00', 52, '3122222.00', 22, '2025-02-28-testt-12323211', '2025-02-28 14:47:55'),
(105, '2025-02-28 14:47:55', '2025-02-28 00:00:00', 52, '3290000.00', 22, '2025-02-28-testt-12323211', '2025-02-28 14:47:55'),
(106, '2025-02-28 14:53:20', '2025-02-28 00:00:00', 52, '3122222.00', 22, '2025-02-28-test-ttessst', '2025-02-28 14:53:20'),
(107, '2025-02-28 14:53:20', '2025-02-28 00:00:00', 52, '3290000.00', 22, '2025-02-28-test-ttessst', '2025-02-28 14:53:20');

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
(612, 1, 46, '2025-02-27', 4, 2, 1, '2025-03-02', '121212', '2025-03-02');

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
(11, 40, '1', '2025-02-15 00:00:00', '2025-02-15', '-', 2, 'test'),
(12, 39, '1', '2025-02-22 00:00:00', '2025-02-22', '-', 2, 'test'),
(13, 39, 'Izin Menghadiri Acara Keagamaan', '2025-02-22 00:00:00', '2025-02-23', '8cc08230537e020eec9caa84a99c5b66.jpeg', 3, 'test');

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
(1, 46, '2025-04-24', '2025-08-23', 'test', '2025-02-22 10:56:40');

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
(13, 30, '2025-02-28', '2025-02-28', '1.00', '18:00:00', '19:00:00', 'test', 2, '100000.00'),
(14, 43, '2025-02-28', '2025-02-28', '1.00', '18:00:00', '19:00:00', 'test', 2, '100000.00');

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
  `include_holiday` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Include, 2 = Exclude'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id_payroll`, `code_payroll`, `total_salary`, `total_employee`, `input_at`, `include_piutang`, `include_finance_record`, `include_holiday`) VALUES
(50, 'dscsadas', NULL, NULL, '2025-02-27', 1, 1, 1),
(51, 'test', NULL, NULL, '2025-02-28', 1, 1, 1),
(52, 'TESTT', NULL, NULL, '2025-02-28', 1, 2, 1),
(53, 'testttttt', NULL, NULL, '2025-02-28', 2, 1, 1),
(55, '12323211', NULL, NULL, '2025-02-28', 1, 1, 1),
(57, 'ttessst', NULL, NULL, '2025-02-28', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_component`
--

CREATE TABLE `payroll_component` (
  `id_payroll_component` int(10) UNSIGNED NOT NULL,
  `id_employee` int(11) UNSIGNED NOT NULL,
  `id_payroll` int(10) UNSIGNED NOT NULL,
  `bonus` decimal(10,0) NOT NULL,
  `tanggal_gajian` date NOT NULL,
  `periode_gajian` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `total_izin` tinyint(2) NOT NULL,
  `total` decimal(15,0) NOT NULL,
  `total_cuti` tinyint(2) NOT NULL,
  `total_overtime` decimal(15,0) NOT NULL,
  `total_dayoff` tinyint(2) NOT NULL,
  `piutang` decimal(15,0) DEFAULT NULL,
  `total_absen` int(11) NOT NULL,
  `potongan_absen` decimal(15,0) NOT NULL,
  `potongan_izin` decimal(15,0) NOT NULL,
  `absen_hari` decimal(15,0) NOT NULL,
  `izin_hari` decimal(15,0) NOT NULL,
  `libur_nasional_hari` decimal(15,0) NOT NULL,
  `total_libur_nasional` int(11) NOT NULL,
  `potongan_libur_nasional` decimal(15,0) NOT NULL,
  `total_potongan` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_component`
--

INSERT INTO `payroll_component` (`id_payroll_component`, `id_employee`, `id_payroll`, `bonus`, `tanggal_gajian`, `periode_gajian`, `description`, `total_izin`, `total`, `total_cuti`, `total_overtime`, `total_dayoff`, `piutang`, `total_absen`, `potongan_absen`, `potongan_izin`, `absen_hari`, `izin_hari`, `libur_nasional_hari`, `total_libur_nasional`, `potongan_libur_nasional`, `total_potongan`) VALUES
(57, 52, 50, '0', '2025-03-31', '2025-03-01', 'test', 0, '3440000', 0, '0', 0, '0', 0, '0', '0', '111111', '20000', '20000', 2, '40000', '40000'),
(58, 53, 50, '0', '2025-03-31', '2025-03-01', 'test', 0, '3848334', 0, '0', 0, '0', 0, '0', '0', '129630', '15833', '15833', 2, '31666', '31666'),
(59, 39, 51, '0', '2025-03-31', '2025-02-28', 'testt', 0, '7480000', 0, '0', 0, '0', 0, '0', '0', '259259', '20000', '20000', 0, '0', '0'),
(60, 40, 52, '0', '2025-03-31', '2025-02-28', 'TESSSST', 0, '4980000', 0, '0', 0, '0', 0, '0', '0', '166667', '20000', '20000', 0, '0', '0'),
(61, 41, 53, '0', '2025-02-28', '2025-02-01', '23232323', 0, '3480000', 1, '0', 0, '0', 0, '0', '0', '111111', '20000', '20000', 0, '0', '0'),
(62, 30, 55, '0', '2025-02-28', '2025-02-01', 'testt', 0, '3122222', 0, '100000', 1, '0', 0, '0', '0', '111111', '926', '926', 0, '0', '0'),
(63, 43, 55, '0', '2025-02-28', '2025-02-01', 'testt', 0, '3290000', 0, '100000', 0, '0', 0, '0', '0', '111111', '7917', '7917', 0, '0', '0'),
(64, 30, 57, '0', '2025-02-28', '2025-02-01', 'test', 0, '3122222', 0, '100000', 1, '0', 0, '0', '0', '111111', '926', '926', 0, '0', '0'),
(65, 43, 57, '0', '2025-02-28', '2025-02-01', 'test', 0, '3290000', 0, '100000', 0, '0', 0, '0', '0', '111111', '7917', '7917', 0, '0', '0');

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
(63, 43, 1, 2, '100000.00', '2025-04-03', '50000.00', 2, 0, 'test', '2025-01-25', 3, '50000', 3),
(64, 44, 1, 2, '10000.00', '2025-03-26', '10000.00', 2, 0, 'test', '2025-01-25', 3, '5000', 26),
(65, 30, 1, 2, '20000.00', '2025-03-26', '10000.00', 2, 0, 'test', '2025-01-25', 3, '10000', 26),
(66, 40, 1, 2, '10000.00', '2025-04-29', '0.00', 1, 0, 'test', '2025-02-28', 3, '5000', 20);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` smallint(5) UNSIGNED NOT NULL,
  `id_location` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) DEFAULT 'image.png',
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `visibility` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = show, 0 = hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_location`, `name_product`, `description`, `logo`, `url`, `status`, `visibility`) VALUES
(43, 1, 'Gadget Shop Purwakarta', 'Purwakarta', 'c389982f02a469c3682c5cdf77e0bb49.png', '', 1, 1),
(44, 1, 'Gadget Care Purwakarta', 'Purwakarta', 'b443e31dcaa71818ae499c4af77075b3.png', '', 1, 1),
(45, 1, 'CV.Multi Graha Radhika', 'Center', '4c6b65e753c369905c7ca9ac963af9b0.png', '', 1, 1),
(46, 1, 'PT Mencari Cinta Sejati', 'Dummy', 'faca02c6699118518c4d8aa38dd182e9.png', 'http://localhost/starter_ci/admin/product/product_page', 1, 1),
(48, 1, 'Gadget Shop Karawang', 'Karawang', 'adeacff83d2b31fee87dd30eb4b72568.png', 'http://localhost/phpmyadmin/sql.php?server=1&db=multigraharadhika&table=products&pos=0', 1, 1),
(52, 2, 'Gadget Care Subang', 'Subang', 'd5bebf1e289bfa9ce66420060a0982c9.jpg', '', 1, 1),
(53, 0, 'tos', 'test', 'f30a3fab6edcd19d9731d99341121e17.jpg', 'adasda.com', 1, 1);

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
(52, 66, '5000.00', ' 5000', '2025-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(10) UNSIGNED NOT NULL,
  `id_workshift` int(10) UNSIGNED NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = Tersedia, 2 = Dayoff, 3 = Holyday, 4 = Cuti, 5 = Izin',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_workshift`, `id_employee`, `status`, `start_date`, `end_date`, `waktu`) VALUES
(1192, 3, 39, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1193, 3, 39, 1, '2025-02-28', '2025-03-01', '2025-03-01'),
(1194, 3, 40, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1195, 3, 40, 1, '2025-02-28', '2025-03-01', '2025-03-01'),
(1196, 3, 41, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1197, 3, 41, 1, '2025-02-28', '2025-03-01', '2025-03-01'),
(1198, 3, 51, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1199, 3, 51, 1, '2025-02-28', '2025-03-01', '2025-03-01'),
(1200, 3, 30, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1201, 3, 43, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1202, 3, 30, 1, '2025-02-28', '2025-03-01', '2025-03-01'),
(1203, 3, 43, 1, '2025-02-28', '2025-03-01', '2025-03-01'),
(1204, 3, 44, 1, '2025-02-28', '2025-03-01', '2025-02-28'),
(1205, 3, 44, 1, '2025-02-28', '2025-03-01', '2025-03-01');

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
(3, 'SHFT1', 'Shift 01', '06:00:00', '20:00:00', 'TYRS');

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
  ADD PRIMARY KEY (`id_payroll`),
  ADD UNIQUE KEY `code_payroll` (`code_payroll`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_location` (`id_location`);

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
-- Indexes for table `type_izin`
--
ALTER TABLE `type_izin`
  ADD PRIMARY KEY (`id_type_izin`);

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
  MODIFY `id_address` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id_attendance` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id_bank` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `day_off`
--
ALTER TABLE `day_off`
  MODIFY `id_day_off` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id_division` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `domisili`
--
ALTER TABLE `domisili`
  MODIFY `id_domisili` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id_contact` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `finance_records`
--
ALTER TABLE `finance_records`
  MODIFY `id_record` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `holyday`
--
ALTER TABLE `holyday`
  MODIFY `id_holyday` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=613;

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_contract_extension`
--
ALTER TABLE `log_contract_extension`
  MODIFY `id_log_contract_extension` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id_overtime` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id_payroll` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `payroll_component`
--
ALTER TABLE `payroll_component`
  MODIFY `id_payroll_component` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
  MODIFY `id_purchase_piutang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1206;

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
-- AUTO_INCREMENT for table `type_izin`
--
ALTER TABLE `type_izin`
  MODIFY `id_type_izin` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workshift`
--
ALTER TABLE `workshift`
  MODIFY `id_workshift` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
