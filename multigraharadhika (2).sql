-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 03:46 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = ROOT, 2 = ADMIN',
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
(7, '2024-12-17 11:32:08', 'Admin', 'admin@admin.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2024-12-23 13:48:55', '2024-12-23 07:48:55', '127.0.0.1', ''),
(8, '2024-12-17 11:32:33', 'Super User', 'superuser@superuser.com', 'd1pEeHVad0diUnBTeUpPL0RTNTA3QT09', 1, 1, '2024-12-27 08:20:51', '2024-12-27 02:20:51', '127.0.0.1', '');

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
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` smallint(5) UNSIGNED NOT NULL,
  `id_product` smallint(5) UNSIGNED NOT NULL,
  `date_in` date NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `id_product`, `date_in`, `nip`, `name`, `gender`, `place_of_birth`, `date_of_birth`, `position`, `status`) VALUES
(13, 46, '2024-12-02', '110519199', 'Aditiya', 'L', 'Indramayu', '2001-12-01', 'Backend', 1),
(14, 46, '2024-12-12', '10519190', 'Glen', 'L', 'Tangerang', '2000-12-02', 'DevOps', 1),
(15, 46, '2024-01-02', '10519185', 'Budiono', 'L', 'Cilacap', '2000-12-12', 'Backend', 1),
(17, 46, '2024-12-12', '1112231314', 'Ayashe', 'P', 'Kyoto', '2001-12-01', 'Psikis', 1);

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
(40, '2024-12-23 16:44:01', '2024-11-23 16:44:01', 44, '23232.00', 39, 'sdsada', '2024-12-24 10:35:06'),
(42, '2024-12-24 10:01:19', '2024-12-24 10:01:19', 43, '100000.00', 15, '22222', '2024-12-24 10:01:19'),
(43, '2024-12-24 11:06:46', '2024-12-24 11:06:46', 43, '1000000.00', 45, 'sssda', '2024-12-24 15:11:54'),
(44, '2024-12-24 13:25:18', '2024-12-24 13:25:18', 44, '12223.00', 16, 'Tost', '2024-12-24 15:13:45');

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
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description`, `logo`, `url`, `status`) VALUES
(43, 'Laptop', 'Alat kerja', 'b776be37e30ff215250adb76544d35dc.jpeg', '', 1),
(44, 'Meja', 'Fasilitas Kerja', 'db611bd8416cb6126ccf44e359482b03.jpg', '', 1),
(45, 'Kursi', 'Fasilitas Kerja', '0537aec068c8d8193aa26edea568e203.png', '', 1),
(46, 'Mobil', 'Transportasi Kerja', 'faca02c6699118518c4d8aa38dd182e9.png', '', 1);

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `finance_records`
--
ALTER TABLE `finance_records`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_code`
--
ALTER TABLE `account_code`
  MODIFY `id_code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `finance_records`
--
ALTER TABLE `finance_records`
  MODIFY `id_record` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
