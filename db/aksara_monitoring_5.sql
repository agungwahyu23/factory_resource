-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2023 pada 18.22
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
(1, 'EMP202301', 'production admin', '085816908859', 'PRODUKSI', 'PT ABC', '1', 'admin_produksi', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'EMP202302', 'warehouse admin', '085816908859', 'GUDANG', 'PT Mandiri', '1', 'admin_gudang', '21232f297a57a5a743894a0e4a801fc3', 2),
(6, 'EMP202302', 'head admin', '085816908859', 'HEAD', 'PT Mandiri', '1', 'admin_head', 'fe01ce2a7fbac8fafaed7c982a04e229', 3);

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

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id`, `emp_id`, `code`, `date_order`, `status`, `note`) VALUES
(22, 1, 'REQ-3997', '2023-05-29', 2, ''),
(23, 1, 'REQ-8485', '2023-06-05', 2, '');

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

--
-- Dumping data untuk tabel `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`id`, `order_id`, `material_id`, `qty_requested`, `qty_received`, `qty_difference`, `saved_price`) VALUES
(75, 23, 8, 10, 10, NULL, 100000),
(76, 22, 8, 10, 5, NULL, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_raw_material`
--

CREATE TABLE `tb_raw_material` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_raw_material`
--

INSERT INTO `tb_raw_material` (`id`, `code`, `name`, `unit`, `price`, `qty_total`) VALUES
(8, 'MTR-5014', 'Sugar', 'Kg', 100000, 15),
(9, 'MTR-4829', 'Flour', 'Kg', 50000, NULL),
(10, 'MTR-3357', 'Egg', 'Kg', 25000, NULL),
(11, 'MTR-8343', 'Margarine', 'Kg', 75000, NULL),
(12, 'MTR-4333', 'Oil', 'L', 55000, NULL),
(13, 'MTR-4930', 'Chocolate', 'Gram', 15000, NULL);

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

--
-- Dumping data untuk tabel `tb_return`
--

INSERT INTO `tb_return` (`id`, `no_return`, `date_return`, `order_id`, `note`, `status`) VALUES
(5, 'RETRN-5908', '2023-05-31', NULL, '', 0);

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

--
-- Dumping data untuk tabel `tb_return_detail`
--

INSERT INTO `tb_return_detail` (`id`, `return_id`, `item_id`, `return_amount`, `information`) VALUES
(5, 5, 8, 100000, '');

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
(10, 22, 'RMP-8628', '2023-06-05', 3, 2),
(11, 23, 'RMP-1565', '2023-06-05', 3, 2);

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

--
-- Dumping data untuk tabel `tb_roadmap_detail`
--

INSERT INTO `tb_roadmap_detail` (`id`, `roadmap_id`, `material_id`, `qty_sent`) VALUES
(21, 10, 8, 10),
(23, 11, 8, 10);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `tb_raw_material`
--
ALTER TABLE `tb_raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_return`
--
ALTER TABLE `tb_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_return_detail`
--
ALTER TABLE `tb_return_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_roadmap`
--
ALTER TABLE `tb_roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_roadmap_detail`
--
ALTER TABLE `tb_roadmap_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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