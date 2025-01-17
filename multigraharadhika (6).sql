-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 10:33 AM
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
(7, '2024-12-17 11:32:08', 'Admin', 'admin@admin.com', 'WG5lYjlxS2FaZUV2clc0WUYreUJodz09', 2, 1, '2025-01-06 11:42:38', '2025-01-06 11:42:38', '127.0.0.1', ''),
(8, '2024-12-17 11:32:33', 'Super User', 'superuser@superuser.com', 'd1pEeHVad0diUnBTeUpPL0RTNTA3QT09', 1, 1, '2025-01-17 15:06:26', '2025-01-17 15:06:26', '127.0.0.1', '20fa8f15cecb411184ecb29b07b84a83.jpg');

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
(1, 'Gadget Shop', 'Munjul', '08122334232', 'gadgetshop@dummy.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id_division` int(10) UNSIGNED NOT NULL,
  `code_division` varchar(20) NOT NULL,
  `name_division` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id_division`, `code_division`, `name_division`) VALUES
(1, 'IT', 'IT'),
(3, 'FIN', 'Finance');

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
(3, 13, 'adadada', '2323231231', 1, 'awdwda'),
(5, 14, 'Luna', '1212121', 0, 'Indramayu'),
(6, 13, 'Test 2', '02323231231', 0, 'ttttt'),
(7, 15, 'Aditiya Sulistiyani', '1212121', 0, 'Indramayu');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` smallint(5) UNSIGNED NOT NULL,
  `id_division` int(11) NOT NULL,
  `id_position` int(11) NOT NULL,
  `id_product` smallint(5) UNSIGNED NOT NULL,
  `date_in` date NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `basic_salary` decimal(15,2) NOT NULL,
  `uang_makan` decimal(15,2) NOT NULL,
  `bonus` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `id_division`, `id_position`, `id_product`, `date_in`, `nip`, `name`, `gender`, `place_of_birth`, `date_of_birth`, `status`, `basic_salary`, `uang_makan`, `bonus`) VALUES
(15, 1, 1, 46, '2024-01-02', '10519185', 'Budiono', 'L', 'Cilacap', '2000-12-12', 1, '121212.00', '12121.00', '12121.00'),
(24, 1, 1, 44, '2024-01-01', '1212122222', 'Miya', 'P', 'Purwakarta', '2001-12-01', 1, '121212.00', '121212.00', '12121.00'),
(25, 1, 1, 44, '2021-12-01', '121212122', 'Aditiya', 'L', 'Indramayu', '2001-12-12', 1, '1212121212.00', '12121212.00', '121212.00'),
(27, 1, 1, 48, '2022-12-01', '1212121213', 'Sinar Abadi', 'L', 'Indramayu', '2001-12-01', 1, '4800000.00', '480000.00', '0.00');

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
(55, '2025-01-02 16:22:27', '2025-01-02 16:22:00', 45, '100000.00', 53, 'asdsada', '2025-01-13 16:35:58'),
(56, '2025-01-02 16:32:19', '2025-01-01 16:29:00', 45, '111242.00', 17, 'test', '2025-01-02 16:32:19'),
(58, '2025-01-09 14:11:46', '2025-01-09 14:11:00', 44, '23232.00', 32, 'tost', '2025-01-09 15:05:29'),
(59, '2025-01-13 16:36:12', '2025-01-14 16:36:00', 44, '1000000.00', 34, 'tesssst', '2025-01-14 14:36:58');

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
(6, 'MGR', 'Manager');

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
  `visibility` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = show, 0 = hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description`, `logo`, `url`, `status`, `visibility`) VALUES
(43, 'Gadget Shop Purwakarta', 'Purwakarta', 'b776be37e30ff215250adb76544d35dc.jpeg', '', 1, 1),
(44, 'Gadget Care Purwakarta', 'Purwakarta', 'db611bd8416cb6126ccf44e359482b03.jpg', '', 1, 1),
(45, 'CV.Multi Graha Radhika', 'Center', '0537aec068c8d8193aa26edea568e203.png', '', 1, 0),
(46, 'PT Mencari Cinta Sejati', 'Dummy', 'faca02c6699118518c4d8aa38dd182e9.png', 'http://localhost/starter_ci/admin/product/product_page', 1, 0),
(48, 'Gadget Shop Karawang', 'Karawang', 'a25e4170b671f1c71f3b53263ef19b6a.jpeg', 'http://localhost/phpmyadmin/sql.php?server=1&db=multigraharadhika&table=products&pos=0', 1, 1);

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
  `payment_type` tinyint(1) NOT NULL COMMENT '1 = debit, 2 = kredit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id_purchases`, `id_supplier`, `created_at`, `input_at`, `total_amount`, `pot_amount`, `final_amount`, `remaining_amount`, `status_purchases`, `description`, `payment_type`) VALUES
(18, 5, '2025-01-17 11:43:33', '2025-01-17', '1000000.00', '200000.00', '800000.00', '0.00', 1, 'Kredit', 2),
(21, 5, '2025-01-17 14:07:59', '2025-01-16', '3000000.00', '1000000.00', '2000000.00', '1900000.00', 0, 'test', 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id_payment` int(10) UNSIGNED NOT NULL,
  `id_purchases` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_amount` decimal(15,2) NOT NULL,
  `description` text NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_payments`
--

INSERT INTO `purchase_payments` (`id_payment`, `id_purchases`, `created_at`, `payment_date`, `payment_amount`, `description`) VALUES
(53, 18, '2025-01-17 11:44:17', '2025-01-17 11:44:00', '68000.00', ' Test1 1'),
(54, 18, '2025-01-17 13:09:41', '2025-01-17 13:06:00', '732000.00', 'Lunas '),
(58, 21, '2025-01-17 14:08:44', '2025-01-17 14:08:00', '100000.00', ' Test');

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
(5, '2025-01-14 15:36:17', 'PT Sadbor', '12122121', 1, '2025-01-14 15:51:36');

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
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id_division`);

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
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`),
  ADD UNIQUE KEY `code_position` (`code_position`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

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
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_code`
--
ALTER TABLE `account_code`
  MODIFY `id_code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id_bank` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id_division` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id_contact` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `finance_records`
--
ALTER TABLE `finance_records`
  MODIFY `id_record` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id_position` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id_purchases` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id_payment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
