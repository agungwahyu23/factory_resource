-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Mar 2023 pada 03.35
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
-- Database: `aksara_gohibachi2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `chef`
--

CREATE TABLE `chef` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gender` int(3) DEFAULT NULL COMMENT '1 (male),\r\n0 (female)',
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chef`
--

INSERT INTO `chef` (`id`, `name`, `email`, `phone`, `gender`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'Denio', 'deni@gmail.com', '01', 0, '2023-02-03', 0, '2023-02-03', 0),
(3, 'agung', 'agung@gmail.com', '1902', 1, '2023-02-03', 0, '2023-02-03', 0),
(5, 'Juna', 'juna@mailinator.com', '01180', 1, '2023-02-06', 0, '2023-02-06', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `package_schedule_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `floor_no` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `number_of_adult` double DEFAULT NULL,
  `number_of_kids` double DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `package_id`, `promo_id`, `booking_date`, `package_schedule_id`, `name`, `email`, `phone`, `street`, `floor_no`, `city`, `state`, `number_of_adult`, `number_of_kids`, `note`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 1, NULL, NULL, 'deni', '', '', '', '', '', '', 0, 0, '', '0000-00-00', 0, '0000-00-00', 0),
(2, 3, NULL, '2023-02-06', 6, 'Agung Wahyu Gunawan', 'agungwahyu23699@gmail.com', '085816908859', 'Mawar', '1', 'Sidoarjo', '-', 5, 5, '-', '2023-02-06', 0, '2023-02-06', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `chef_id` varchar(100) DEFAULT NULL,
  `package_code` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_recomended` int(2) DEFAULT NULL COMMENT '1 (recomended),\r\n0 (no recomended)',
  `term_policy` text DEFAULT NULL,
  `hour_duration` time DEFAULT NULL,
  `minute_duration` time DEFAULT NULL,
  `seo` varchar(200) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `package`
--

INSERT INTO `package` (`id`, `chef_id`, `package_code`, `slug`, `title`, `description`, `is_recomended`, `term_policy`, `hour_duration`, `minute_duration`, `seo`, `created_date`, `created_by`, `updated_date`, `updated_by`, `thumbnail`, `price`) VALUES
(3, '3', 'pkg001', 'pkg001-pick-2-proteins-per-person', 'Pick 2 proteins per person', '<b>$60.00 per adult </b><br>\r\n<b>$30.00 per child</b>\r\n<br>\r\n<ul>\r\n<li>Chicken </li>\r\n<li>NY Strip Steak</li>\r\n<li>Shrimp</li>\r\n<li>Scallops</li>\r\n<li>Salmon</li>\r\n<li>Filet Mignon (+$5.00)</li>\r\n<li>Lobster Tail (+$10.00)</li>\r\n</ul>\r\n<b>travel fee 20 miles up ,we gonna charge $3 per miles</b>\r\n', 1, '', '20:00:00', '21:30:00', 'Pick 2 proteins per person', '2023-02-06', 0, '2023-02-06', 0, 'thumbnail_230206-e5ad856b65.jpeg', '100'),
(4, '3', 'pkg002', 'pkg002-pick-3-proteins-per-person', 'Pick 3 proteins per person', '<b>$60.00 per adult </b><br>\r\n<b>$30.00 per child</b>\r\n<br>\r\n<ul>\r\n<li>Chicken </li>\r\n<li>NY Strip Steak</li>\r\n<li>Shrimp</li>\r\n<li>Scallops</li>\r\n<li>Salmon</li>\r\n<li>Filet Mignon (+$5.00)</li>\r\n<li>Lobster Tail (+$10.00)</li>\r\n</ul>\r\n<b>travel fee 20 miles up ,we gonna charge $3 per miles</b>\r\n', 0, '', '20:00:00', '21:30:00', 'Pick 3 proteins per person', '2023-02-06', 0, '2023-02-06', 0, 'thumbnail_230206-c954fc90c2.jpeg', '100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `package_image`
--

CREATE TABLE `package_image` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_default` int(3) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `package_image`
--

INSERT INTO `package_image` (`id`, `package_id`, `image`, `is_default`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 2, 'image_230205-3dc7fffe95.png', 1, '2023-02-05', 0, '2023-02-05', 0),
(5, 3, 'image_230206-885f19705c.jpeg', 0, '2023-02-06', 0, '2023-02-06', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `package_schedule`
--

CREATE TABLE `package_schedule` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `day` varchar(100) DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `package_schedule`
--

INSERT INTO `package_schedule` (`id`, `package_id`, `day`, `start`, `end`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 3, 'Monday', '12:00:00', '13:30:00', '2023-02-06', 0, '2023-02-06', 0),
(4, 3, 'Monday', '15:00:00', '16:30:00', '2023-02-06', 0, '2023-02-06', 0),
(5, 3, 'Monday', '18:00:00', '19:30:00', '2023-02-06', 0, '2023-02-06', 0),
(6, 3, 'Monday', '20:30:00', '22:00:00', '2023-02-06', 0, '2023-02-06', 0),
(7, 4, 'Monday', '12:00:00', '13:30:00', '2023-02-06', 0, '2023-02-06', 0),
(8, 4, 'Monday', '15:00:00', '16:30:00', '2023-02-06', 0, '2023-02-06', 0),
(9, 4, 'Monday', '18:00:00', '19:30:00', '2023-02-06', 0, '2023-02-06', 0),
(10, 4, 'Monday', '20:30:00', '22:00:00', '2023-02-06', 0, '2023-02-06', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code_referral` varchar(255) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL COMMENT '1 (active),\r\n0 (non active)',
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id`, `name`, `title`, `code_referral`, `date_start`, `date_end`, `description`, `image`, `is_active`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Promo up To 30%', 'Promo Valentine up To 30%', '#gohibachivalentine', '2023-02-05', '2023-02-06', 'get the best promo from us.\ndiscount up to 30% with a minimum order of 12 dollars', 'promo_230205-8a8028bd7d.png', 0, '2023-02-18', 1, '2023-02-18', 1),
(4, 'Promo March 50%', 'Promo March Up To 50%', 'marchpromo', '2023-02-18', '2023-02-18', ' Promo March 50%', 'no-image.png', 0, '2023-02-18', 1, '2023-02-18', 1),
(5, 'tes', 'sdfds', 'sdfs', '2023-02-18', '2023-02-18', 'sdsef', 'no-image.png', 0, '2023-02-18', 1, '2023-02-18', 1),
(6, 'sdfsd', 'sdfdsf', '', '2023-02-18', '2023-02-18', 'sdsf', 'no-image.png', 0, '2023-02-18', 1, '2023-02-18', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `question`
--

INSERT INTO `question` (`id`, `name`, `email`, `phone`, `message`, `created_date`) VALUES
(1, 'Agung', 'agungwahyu23699@gmail.com', '085816908859', NULL, '2023-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `header_image_id` int(11) DEFAULT NULL,
  `title_header` varchar(100) DEFAULT NULL,
  `company_desc` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `wa` varchar(20) DEFAULT NULL,
  `founding_date` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `maps` text DEFAULT NULL,
  `seo` varchar(200) DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `header_image_id`, `title_header`, `company_desc`, `email`, `phone`, `wa`, `founding_date`, `address`, `city`, `state`, `instagram`, `facebook`, `twitter`, `maps`, `seo`, `keyword`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, NULL, '<h1><strong><span xss=removed>Amazing</span> Food<br>\r\n<span xss=removed>Amazing</span> Service</str', 'Hibachi Mobile is a very unique Japanese cuisine experience. The concept is simple: whatever the group size or location, we travel to you - set up in backyards, garages and workplaces. We bring the very best fresh ingridients and cook it on our Teppanyaki grill to make any occasion a memorable one. The result: a fine blend of entertainment and dining!\r\n<br>\r\n<p>\r\n<h5>CATERING EVENTS</h5>\r\nBirthdays parties / Weddings / Sweet 16 / Baptisms / Anniversaries / Corporate / Events / Holiday parties / Any kind of event ...\r\n<p>We cater for numbers from 10 people upwards</p>\r\n<br>', 'gohibachi@mailinator.com', '087754314117', '6287754314117', '2023', '123 Street, New York, USA', 'New York', 'USA', 'https://www.instagram.com/agung_wahyu23/', 'https://web.facebook.com/agung.wahyu.547389', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2175469963145!2d112.72966547396909!3d-7.329446572082347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb423c9f28ff%3A0x30b02913187c105a!2sJl.%20Jemur%20Ngawinan%20I%20No.53%2C%20Jemur%20Wonosari%2C%20Kec.%20Wonocolo%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060237!5e0!3m2!1sid!2sid!4v1675533809995!5m2!1sid!2sid\" width=\"800\" height=\"600\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Amazing Food\r\nAmazing Servicedsfds', 'japanese food, hibachi, food, catering', '2023-02-04', 1, '2023-02-13', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `gender` int(2) DEFAULT NULL,
  `user_group` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `gender`, `user_group`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 1, 1, '0000-00-00', 0, '0000-00-00', 0),
(2, 'userr', 'd41d8cd98f00b204e9800998ecf8427e', 'userr@gmail.com', 0, 2, '2023-02-06', 1, '2023-02-06', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_group`
--

INSERT INTO `user_group` (`id`, `level`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'admin', '0000-00-00', 0, '0000-00-00', 0),
(2, 'user', '0000-00-00', 0, '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `package_image`
--
ALTER TABLE `package_image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `package_schedule`
--
ALTER TABLE `package_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `chef`
--
ALTER TABLE `chef`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `package_image`
--
ALTER TABLE `package_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `package_schedule`
--
ALTER TABLE `package_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
