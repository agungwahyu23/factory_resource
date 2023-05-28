-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2023 pada 14.28
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aksara_monitoring`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name_of_item` varchar(100) DEFAULT NULL,
  `price_of_item` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `wh_loacation` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_employee`
--

CREATE TABLE `tb_employee` (
  `id` int(11) NOT NULL,
  `code_employee` varchar(10) DEFAULT NULL,
  `name_of_employee` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `part_of` varchar(50) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL COMMENT '0=default\r\n1=produksi\r\n2=gudang\r\n3=head\r\n4=kepala gudang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `code_employee`, `name_of_employee`, `no_telp`, `part_of`, `company`, `status`, `username`, `password`, `level`) VALUES
(1, 'EMP202301', 'admin production', '085816908859', 'PRODUKSI', 'PT ABC', '1', 'admin_produksi', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'EMP202302', 'admin warehouse', '085816908859', 'GUDANG', 'PT Mandiri', '1', 'admin_gudang', '21232f297a57a5a743894a0e4a801fc3', 2),
(6, 'EMP202302', 'admin head', '085816908859', 'HEAD', 'PT Mandiri', '1', 'admin_head', 'fe01ce2a7fbac8fafaed7c982a04e229', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_item`
--

CREATE TABLE `tb_item` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_item_material`
--

CREATE TABLE `tb_item_material` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `raw_material_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '1=diajukan\r\n2=acc\r\n3=ditolak',
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `qty_requested` int(11) DEFAULT NULL,
  `qty_received` int(11) DEFAULT NULL,
  `qty_difference` int(11) DEFAULT NULL,
  `saved_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_raw_material`
--

CREATE TABLE `tb_raw_material` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_raw_material`
--

INSERT INTO `tb_raw_material` (`id`, `code`, `name`, `unit`, `price`) VALUES
(8, 'MTR-5014', 'Sugar', 'Kg', 100000),
(9, 'MTR-4829', 'Flour', 'Kg', 50000),
(10, 'MTR-3357', 'Egg', 'Kg', 25000),
(11, 'MTR-8343', 'Margarine', 'Kg', 75000),
(12, 'MTR-4333', 'Oil', 'L', 55000),
(13, 'MTR-4930', 'Chocolate', 'Gram', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_return`
--

CREATE TABLE `tb_return` (
  `id` int(11) NOT NULL,
  `no_return` varchar(100) DEFAULT NULL,
  `date_return` date DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '0="submiter"\r\n1="accept"\r\n2="reject"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_return_detail`
--

CREATE TABLE `tb_return_detail` (
  `id` int(11) NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `return_amount` double DEFAULT NULL,
  `information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_roadmap`
--

CREATE TABLE `tb_roadmap` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `date_send` date DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '1=diproses\r\n2=dikirim\r\n3=diterima',
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_roadmap`
--

INSERT INTO `tb_roadmap` (`id`, `order_id`, `code`, `date_send`, `status`, `emp_id`) VALUES
(8, 1, '001', '2023-05-28', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_roadmap_detail`
--

CREATE TABLE `tb_roadmap_detail` (
  `id` int(11) NOT NULL,
  `roadmap_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `qty_sent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warehouse`
--

CREATE TABLE `tb_warehouse` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_default` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL COMMENT '0=employee; 1=admin; 2=bag produksi; 3=bag gudang; 4=kepala gudang; 5 kepala produksi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_item_material`
--
ALTER TABLE `tb_item_material`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_raw_material`
--
ALTER TABLE `tb_raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_return`
--
ALTER TABLE `tb_return`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_return_detail`
--
ALTER TABLE `tb_return_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_roadmap`
--
ALTER TABLE `tb_roadmap`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_roadmap_detail`
--
ALTER TABLE `tb_roadmap_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_item_material`
--
ALTER TABLE `tb_item_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tb_raw_material`
--
ALTER TABLE `tb_raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_return`
--
ALTER TABLE `tb_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_return_detail`
--
ALTER TABLE `tb_return_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_roadmap`
--
ALTER TABLE `tb_roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_roadmap_detail`
--
ALTER TABLE `tb_roadmap_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
