-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2020 at 08:28 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_benang`
--

CREATE TABLE `kategori_benang` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_benang`
--

INSERT INTO `kategori_benang` (`kategori_id`, `kategori_nama`) VALUES
(1, 'PE'),
(2, 'Misty'),
(3, 'Katun'),
(4, 'TR'),
(5, 'TC'),
(6, 'Polyster'),
(7, 'Filamen'),
(8, 'POY'),
(9, 'Surban'),
(10, 'Spandex'),
(11, 'Sorban'),
(12, 'SDY'),
(13, 'Sarung Celana'),
(14, 'Sarung'),
(15, 'Rotoset'),
(16, 'Rotoset Lemah'),
(17, 'Rayon'),
(18, 'Pecah'),
(19, 'Nylon'),
(20, 'DTY'),
(21, 'Benang'),
(22, 'Roto');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(32) NOT NULL,
  `atribut` int(11) NOT NULL,
  `bobot` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `atribut`, `bobot`) VALUES
(2, 'Kecepatan pengiriman', 0, '4'),
(3, 'Standar harga penawaran', 1, '5'),
(5, 'Kecepatan respon', 0, '3'),
(6, 'Biaya pengiriman', 1, '3'),
(7, 'Kualitas benang', 0, '5'),
(8, 'Ketersediaan benang', 0, '4');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `id_penawaran` int(11) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `status_kirim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id`, `id_faktur`, `id_penawaran`, `jumlah`, `total`, `status`, `status_kirim`) VALUES
(20, 8, 2049432383, 33, 30, 330000, 1, 0),
(21, 8, 2049432383, 36, 5, 50000, 1, 0),
(22, 8, 1503828419, 37, 50, 50000, 1, 2),
(26, 8, 220990709, 37, 50, 500000, 1, 0),
(27, 8, 220990709, 35, 50, 600000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `benang_id` int(11) NOT NULL,
  `warna` varchar(64) NOT NULL,
  `jumlah` decimal(7,2) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `catatan` varchar(256) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal_valid` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `benang_id`, `warna`, `jumlah`, `tanggal_pesan`, `catatan`, `status`, `tanggal_valid`) VALUES
(45, 1, 'Grey', '1200.80', '2019-09-09', '', 0, '2019-09-12'),
(46, 5, 'Yellow', '4500.00', '2019-09-09', '', 0, '2019-09-11'),
(47, 75, 'White', '1345.00', '2019-09-09', '', 0, '2019-09-14'),
(48, 1, 'White', '1500.00', '2019-09-10', '', 0, '2019-09-12'),
(50, 1, 'White', '800.00', '2019-09-12', '', 0, '2019-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran`
--

CREATE TABLE `penawaran` (
  `id_penawaran` int(11) NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `id_benang` int(11) NOT NULL,
  `warna` varchar(128) NOT NULL,
  `jumlah_tersedia` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `biaya_kirim` int(11) NOT NULL,
  `contoh` varchar(256) DEFAULT NULL,
  `catatan` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penawaran`
--

INSERT INTO `penawaran` (`id_penawaran`, `id_pemasok`, `id_benang`, `warna`, `jumlah_tersedia`, `harga_satuan`, `biaya_kirim`, `contoh`, `catatan`) VALUES
(29, 27, 1, 'Grey', 2000, 12000, 50000, '86.jpg', ''),
(30, 27, 5, 'Yellow', 5000, 11000, 100000, '95.jpg', ''),
(31, 25, 1, 'Grey', 5000, 14000, 300000, '1147029281.jpg', ''),
(32, 25, 5, 'Yellow', 6000, 13000, 100000, '14.jpg', ''),
(33, 26, 1, 'Grey', 320, 11000, 0, 'default1.jpg', ''),
(35, 25, 1, 'Grey', 300, 12000, 100000, 'default11.jpg', ''),
(36, 26, 75, 'White', 5, 10000, 150000, 'default3.jpg', '    '),
(37, 37, 8, 'merah', 250, 10000, 100000, 'default.jpg', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `pengiriman` varchar(128) NOT NULL,
  `resi_pengiriman` varchar(30) NOT NULL,
  `bukti` varchar(256) NOT NULL,
  `status_kirim` int(11) NOT NULL,
  `cat` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pembelian`, `tgl_kirim`, `pengiriman`, `resi_pengiriman`, `bukti`, `status_kirim`, `cat`) VALUES
(2, 22, '2020-11-30', 'JNE', 'jp0919982828', 'LOGO3.png', 1, ''),
(3, 27, '2020-11-29', 'jnt', 'jp0919982828', 'default.jpg', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_faktur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total` bigint(20) NOT NULL,
  `status_pay` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `transaction_time` varchar(20) NOT NULL,
  `bank` varchar(15) DEFAULT NULL,
  `va_number` varchar(30) DEFAULT NULL,
  `url_pdf` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_faktur`, `id_user`, `tgl_pembelian`, `total`, `status_pay`, `payment_type`, `transaction_time`, `bank`, `va_number`, `url_pdf`) VALUES
(220990709, 8, '2020-11-29', 1100000, 200, 'bank_transfer', '2020-11-29 13:55:40', 'bca', '24767769111', 'https://app.sandbox.midtrans.com/snap/v1/transactions/9d9cea93-c'),
(1503828419, 8, '2020-11-29', 50000, 200, 'bank_transfer', '2020-11-29 13:21:17', 'bca', '24767549068', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f2342ec6-4'),
(2049432383, 8, '2020-11-29', 380000, 201, 'bank_transfer', '2020-11-29 12:10:32', 'bca', '24767057740', 'https://app.sandbox.midtrans.com/snap/v1/transactions/ad8f1d06-8');

-- --------------------------------------------------------

--
-- Table structure for table `subkategori_benang`
--

CREATE TABLE `subkategori_benang` (
  `subkategori_id` int(11) NOT NULL,
  `subkategori_nama` varchar(64) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkategori_benang`
--

INSERT INTO `subkategori_benang` (`subkategori_id`, `subkategori_nama`, `kategori_id`) VALUES
(1, 'PE 30s', 1),
(2, 'Misty 40s', 2),
(4, 'PE 40 TR', 1),
(5, 'Misty TR', 2),
(7, 'PE 10s', 1),
(8, 'PE 12s', 1),
(9, 'PE 20s', 1),
(10, 'PE 30s-M71', 1),
(11, 'PE 40s', 1),
(12, 'Polyster 75d', 6),
(13, 'Polyster 100d', 6),
(14, 'Polyster 150d', 6),
(15, 'Polyster 300d', 6),
(16, 'Katun 10s', 3),
(17, 'Katun 12s', 3),
(18, 'Katun 20s', 3),
(19, 'Katun 30s', 3),
(20, 'Katun 40s', 3),
(21, 'TR 10s', 4),
(22, 'TR 12s', 4),
(23, 'TR 20s', 4),
(24, 'TR 30s', 4),
(25, 'TR 40s', 4),
(26, 'TC 10s', 5),
(27, 'TC 12s', 5),
(28, 'TC 20s', 5),
(29, 'TC 30s', 5),
(30, 'TC 40s', 5),
(36, 'POY 10s', 8),
(37, 'POY 12s', 8),
(38, 'POY 20s', 8),
(39, 'POY 30s', 8),
(40, 'POY 40s', 8),
(41, 'Surban', 9),
(42, 'Spandex 30/75', 10),
(43, 'Sorban', 11),
(44, 'SDY 75/36', 12),
(45, 'Sarung Celana Anak', 13),
(46, 'Sarung Celana Dewasa', 13),
(47, 'Sarung Celana Doby/Atlas', 13),
(48, 'Sarung 150/48', 14),
(49, 'Rotoset 100/96', 15),
(50, 'Rotoset 150/144', 15),
(51, 'Rotoset 150/288/1', 15),
(52, 'Rotoset 150/36/1', 15),
(53, 'Rotoset 150/48', 15),
(54, 'Rotoset 150/72', 15),
(55, 'Rotoset 150/96', 15),
(56, 'Rotoset 300/96', 15),
(57, 'Rotoset 375/132', 15),
(58, 'Rotoset 75/36', 15),
(59, 'Rotoset Lemah 150/48', 16),
(60, 'Rayon 30s', 17),
(61, 'Polyster 350/96', 6),
(62, 'Polyster 600/144', 6),
(63, 'Polyster 75/36', 6),
(64, 'Pecah 150/36', 18),
(65, 'Pecah 150/48', 18),
(66, 'Pecah 75/36', 18),
(67, 'PE 20/2', 1),
(68, 'PE 20/2-M71', 1),
(69, 'PE 20/3', 1),
(70, 'PE 20s-M71', 1),
(71, 'PE 20s-M81', 1),
(72, 'PE 24s', 1),
(73, 'PE 30/2', 1),
(74, 'PE 34s', 1),
(75, 'Nylon SLG 70/2', 19),
(76, 'DTY 150/48', 20),
(77, 'Benang Starkis', 21),
(78, 'Katun 23s', 3),
(79, 'Benang Misty', 21),
(80, 'Benang Campur', 21),
(81, 'Benang Filamen', 21),
(82, 'Benang Jahit', 21),
(83, 'Benang Mix GR C', 21),
(84, 'Benang Mutugading', 21),
(85, 'Benang Sisa', 21),
(86, '300', 22);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `no_tlp` bigint(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `alamat`, `no_tlp`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Intan Muliawati', 'intanmuliawati32@gmail.com', 'Bandung', 82120241292, '$2y$10$32lFt5Uwq3viJkKIc3gBce4XcoRwELR8crIbX6h77xWlNotHqTaua', 1, 1, '2019-07-14'),
(8, 'Hafid Zaenal Mutaqin', 'hafidzm11@gmail.com', 'Bandung', 8122356299, '$2y$10$zkvCIi9KHXSC7bLN1gtsH.pyF.FjT7hzCpJiStLQuOStMaGlBlgne', 2, 1, '2019-07-14'),
(25, 'PT Majujaya', 'majujaya@gmail.com', 'Jakarta', 86574839488, '$2y$10$P4vcItXAMNThEhBMeL/B5eJ1wmVool..lEgcjKUg4MPwd50utTG9e', 4, 1, '2019-09-09'),
(26, 'Goan Ciparay', 'goanciparay@gmail.com', 'Ciparay , Bandung', 5951886, '$2y$10$VEO1iHSfQPWcfju8amgg6.GwrPS3iceH/0EaENZXDP2D6tW99w6yy', 4, 1, '2019-09-09'),
(27, 'PT Panjimas', 'panjimas@gmail.com', 'Surabaya', 8675849373, '$2y$10$caT9gEIbCW9yPIr6aZ5nUOSO080DIzPOixBvYxQpftruBJjejkL.S', 4, 1, '2019-09-09'),
(28, 'PT Agung Textile', 'agungtextile@gmail.com', 'Solo', 8137485744, '$2y$10$36HYUR6y0XUApEyqzWmF6.Fa1U6pTtbAoV04bw9iS0MIiPGDIw5cy', 4, 1, '2019-09-09'),
(29, 'Haji Gandi', 'gandi@gmail.com', 'Jakarta', 82174637288, '$2y$10$3i3Np6jA7D/7VC0GUyghn.F695d8ssTWM3BN7.rmjwQUWRrFpKs4O', 4, 1, '2019-09-09'),
(30, 'UD. Tuttalitut', 'tuttalitut@gmail.com', 'Bandung', 8144568388, '$2y$10$qbeyGUroEhCX5BlTATvL.u6qr0vRmQtlV9EryPvTGhJjJpe.eHMxi', 4, 1, '2019-09-09'),
(31, 'UD. Nadia', 'nadia@gmail.com', 'Bandung', 872637388488, '$2y$10$/ixqqk9AJ/nKCX7vtrItwOI15Hr2T3g7gwRuIDnOh3tVbBIAO714W', 4, 1, '2019-09-09'),
(32, 'PT Santex', 'santex@gmail.com', 'Bandung', 8144378288, '$2y$10$aF7mfpTmdpoQM9YYq9xEIutEXuD9.pgAYy2RagG2ESnxbELMbbVTy', 4, 1, '2019-09-09'),
(33, 'Alviansyah', 'alviansyah@gmail.com', 'Bandung', 82166784955, '$2y$10$adPg8t107sK1438NczgNB.Is4lQPesoeJOZn8EDafYxJ7J4bv86Ki', 4, 1, '2019-09-09'),
(37, 'cobasupp', 'cobasupplier@gmail.com', 'bandung', 82323111, '$2y$10$Utpg3aORtvjVhsIwb1LfYescXGJ.8ojARgOO.tG8q.Z9VZ.hfsnGG', 4, 1, '2020-11-29'),
(38, 'coba', 'coba2@gmail.com', 'bandung', 817171717, '$2y$10$AtyX1Fm48IW5XQ68JUJcGudGQiwh7t6Bdf4MeMNxHp.bNfNRYsss6', 4, 0, '2020-11-29'),
(39, 'admin', 'admin@gmail.com', 'jakarta', 817171717, '$2y$10$Ge.Mgkk2.azVCOWymZFBjOsmoS8S43EOzJafsOjiPElmZfI73tWKC', 1, 1, '2020-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'Anggota'),
(4, 'Supplier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_benang`
--
ALTER TABLE `kategori_benang`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_penawaran` (`id_penawaran`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benang_id` (`benang_id`);

--
-- Indexes for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD PRIMARY KEY (`id_penawaran`),
  ADD KEY `id_pemasok` (`id_pemasok`),
  ADD KEY `id_benang` (`id_benang`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_faktur`);

--
-- Indexes for table `subkategori_benang`
--
ALTER TABLE `subkategori_benang`
  ADD PRIMARY KEY (`subkategori_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_benang`
--
ALTER TABLE `kategori_benang`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `id_penawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subkategori_benang`
--
ALTER TABLE `subkategori_benang`
  MODIFY `subkategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_penawaran`) REFERENCES `penawaran` (`id_penawaran`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`benang_id`) REFERENCES `subkategori_benang` (`subkategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD CONSTRAINT `penawaran_ibfk_1` FOREIGN KEY (`id_benang`) REFERENCES `subkategori_benang` (`subkategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penawaran_ibfk_2` FOREIGN KEY (`id_pemasok`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_2` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkategori_benang`
--
ALTER TABLE `subkategori_benang`
  ADD CONSTRAINT `subkategori_benang_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_benang` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
