-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 03:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `item`
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
-- Table structure for table `tb_employee`
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
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `code_employee`, `name_of_employee`, `no_telp`, `part_of`, `company`, `status`, `username`, `password`, `level`) VALUES
(1, 'EMP202301', 'admin produksi', '085816908859', 'PRODUKSI', 'PT ABC', '1', 'admin_produksi', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'EMP202302', 'admin gudang', '085816908859', 'GUDANG', 'PT Mandiri', '1', 'admin_gudang', '21232f297a57a5a743894a0e4a801fc3', 2),
(6, 'EMP202302', 'admin head', '085816908859', 'HEAD', 'PT Mandiri', '1', 'admin_head', 'fe01ce2a7fbac8fafaed7c982a04e229', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id`, `code`, `name`, `price`, `stock`, `unit`, `warehouse_id`) VALUES
(1, 'ITEM-9730', 'Besi2', 500000, 10, 'pcs', 1),
(3, 'ITEM-4339', 'Biskuit', 100000, 100, 'pcs', 1),
(4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'ITEM-9750', 'Tes', 100000, 100, 'kg', 1),
(7, 'ITEM-5013', 'tes', 100000, 100, 'kg', 1),
(8, 'ITEM-6659', 'Tes', 100000, 100, 'kg', 1),
(9, 'ITEM-2556', 'jkhjk', 90000, 100, 'kg', 1),
(10, 'ITEM-4074', 'sfwef', 1, 1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_item_material`
--

CREATE TABLE `tb_item_material` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `raw_material_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_item_material`
--

INSERT INTO `tb_item_material` (`id`, `item_id`, `raw_material_id`) VALUES
(1, 10, 1),
(3, 1, 1),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `status` int(3) DEFAULT NULL COMMENT '1=diajukan\r\n2=acc\r\n3=ditolak',
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `emp_id`, `code`, `date_order`, `status`, `type`) VALUES
(4, 0, 'REQ-6721', '2023-03-13', 3, NULL),
(5, 0, 'REQ-4093', '2023-03-13', 1, NULL),
(6, 0, 'REQ-4773', '2023-03-14', 1, NULL),
(7, 0, 'REQ-6951', '2023-03-14', 1, NULL),
(8, 0, 'REQ-4352', '2023-03-19', 1, NULL),
(9, 0, 'REQ-4352', '2023-03-19', 2, 0),
(10, 0, 'REQ-4970', '2023-03-19', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
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
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`id`, `order_id`, `material_id`, `qty_requested`, `qty_received`, `qty_difference`, `saved_price`) VALUES
(3, 5, 1, NULL, NULL, NULL, NULL),
(4, 6, 1, NULL, NULL, NULL, NULL),
(6, 7, 1, NULL, NULL, NULL, NULL),
(11, 10, 4, 10, NULL, NULL, 300000),
(27, 9, 4, 10, 10, NULL, 300000),
(28, 9, 5, 9, 9, NULL, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_raw_material`
--

CREATE TABLE `tb_raw_material` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_raw_material`
--

INSERT INTO `tb_raw_material` (`id`, `code`, `name`, `unit`, `price`) VALUES
(1, 'MTR-2378', 'Gandum2', 'kg', 100000),
(3, 'MTR-7762', 'Sugar', 'kg', 100000),
(4, 'MTR-5677', 'Flour', 'kg', 300000),
(5, 'MTR-5851', 'Egg', 'Pcs', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_return`
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
-- Dumping data for table `tb_return`
--

INSERT INTO `tb_return` (`id`, `no_return`, `date_return`, `order_id`, `note`, `status`) VALUES
(1, 'RETRN-4745', '2023-04-02', NULL, 'tes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_return_detail`
--

CREATE TABLE `tb_return_detail` (
  `id` int(11) NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `return_amount` double DEFAULT NULL,
  `information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_return_detail`
--

INSERT INTO `tb_return_detail` (`id`, `return_id`, `item_id`, `return_amount`, `information`) VALUES
(1, 1, 1, 100000, 'expured');

-- --------------------------------------------------------

--
-- Table structure for table `tb_roadmap`
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
-- Dumping data for table `tb_roadmap`
--

INSERT INTO `tb_roadmap` (`id`, `order_id`, `code`, `date_send`, `status`, `emp_id`) VALUES
(3, 9, 'RMP-5368', '2023-03-25', 3, 1),
(4, 10, 'RMP-5368', '2023-03-25', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_roadmap_detail`
--

CREATE TABLE `tb_roadmap_detail` (
  `id` int(11) NOT NULL,
  `roadmap_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `qty_sent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_roadmap_detail`
--

INSERT INTO `tb_roadmap_detail` (`id`, `roadmap_id`, `material_id`, `qty_sent`) VALUES
(6, 3, 4, 10),
(7, 3, 5, 9),
(8, 4, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_warehouse`
--

CREATE TABLE `tb_warehouse` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_default` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_item_material`
--
ALTER TABLE `tb_item_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_raw_material`
--
ALTER TABLE `tb_raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_return`
--
ALTER TABLE `tb_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_return_detail`
--
ALTER TABLE `tb_return_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_roadmap`
--
ALTER TABLE `tb_roadmap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_roadmap_detail`
--
ALTER TABLE `tb_roadmap_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_item_material`
--
ALTER TABLE `tb_item_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_raw_material`
--
ALTER TABLE `tb_raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_return`
--
ALTER TABLE `tb_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_return_detail`
--
ALTER TABLE `tb_return_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_roadmap`
--
ALTER TABLE `tb_roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_roadmap_detail`
--
ALTER TABLE `tb_roadmap_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
