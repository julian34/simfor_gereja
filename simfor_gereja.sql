-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 05:53 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simfor_gereja`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`) VALUES
(1, 'alberth', '123', 'Alberth Theodorus Wairara');

-- --------------------------------------------------------

--
-- Table structure for table `auth_grup_users`
--

CREATE TABLE `auth_grup_users` (
  `id_grup` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_grup_users`
--

INSERT INTO `auth_grup_users` (`id_grup`, `id_user`) VALUES
(1, 3),
(1, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_inventaris`
--

CREATE TABLE `data_inventaris` (
  `id_barang` int(11) NOT NULL,
  `id_jenisbarang` int(11) UNSIGNED NOT NULL,
  `id_ruangan` int(11) UNSIGNED NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `ukuran_barang` varchar(25) NOT NULL,
  `id_bahan` int(11) UNSIGNED NOT NULL,
  `tahun_pembelian` year(4) NOT NULL,
  `jumlah` varchar(11) NOT NULL,
  `harga` float NOT NULL,
  `id_sumberdana` int(11) UNSIGNED NOT NULL,
  `keadaan_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_jemaat`
--

CREATE TABLE `data_jemaat` (
  `nik` int(20) NOT NULL,
  `nama_jemaat` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `id_wijk` int(10) UNSIGNED NOT NULL,
  `id_ksp` int(10) UNSIGNED NOT NULL,
  `id_unsur` int(10) UNSIGNED NOT NULL,
  `status_baptis` enum('Sudah Baptis','Belum Baptis') NOT NULL,
  `status_sidi` enum('Sidi','Belunm Sidi') NOT NULL,
  `status_nikah` enum('Nikah','Belum Nikah') NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`, `keterangan`) VALUES
(1, 'Administrator', 'Admin Manajemen'),
(2, 'Sekretaris Jemaat', 'Sekretaris Jemaat'),
(3, 'Bendahara Barang', 'Bendahara Barang'),
(4, 'Pengurus Wijk', 'Pengurus Wijk');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenisbarang` int(11) NOT NULL,
  `nama_jenisbarang` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ksp`
--

CREATE TABLE `ksp` (
  `id_ksp` int(11) NOT NULL,
  `id_wijk` int(11) UNSIGNED NOT NULL,
  `nama_ksp` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(25) NOT NULL,
  `kode_ruangan` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unsur`
--

CREATE TABLE `unsur` (
  `id_unsur` int(11) NOT NULL,
  `nama_unsur` varchar(50) NOT NULL,
  `kode_unsur` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unsur`
--

INSERT INTO `unsur` (`id_unsur`, `nama_unsur`, `kode_unsur`, `keterangan`) VALUES
(2, 'Sekolah Minggu', 'SM', 'piupiupiu'),
(3, 'Persekutuan Anggota Muda', 'PAM', 'Apa niih');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(199) DEFAULT NULL,
  `username` varchar(199) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(199) NOT NULL DEFAULT 'default.png',
  `aktif` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `gambar`, `aktif`) VALUES
(1, 'Alberth Theodorus Wairara', 'dailiens', '202cb962ac59075b964b07152d234b70', 'default.png', 1),
(3, 'Julian Ray Allen Junior', 'jardmg', '7363a0d0604902af7b70b271a0b96480', 'default.png', 1),
(4, 'Frederik', 'edik', '202cb962ac59075b964b07152d234b70', 'default.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wijk`
--

CREATE TABLE `wijk` (
  `id_wijk` int(11) NOT NULL,
  `nama_wijk` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_grup_users`
--
ALTER TABLE `auth_grup_users`
  ADD KEY `id_grup` (`id_grup`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `data_inventaris`
--
ALTER TABLE `data_inventaris`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `data_jemaat`
--
ALTER TABLE `data_jemaat`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenisbarang`);

--
-- Indexes for table `ksp`
--
ALTER TABLE `ksp`
  ADD PRIMARY KEY (`id_ksp`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `unsur`
--
ALTER TABLE `unsur`
  ADD PRIMARY KEY (`id_unsur`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wijk`
--
ALTER TABLE `wijk`
  ADD PRIMARY KEY (`id_wijk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_inventaris`
--
ALTER TABLE `data_inventaris`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenisbarang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unsur`
--
ALTER TABLE `unsur`
  MODIFY `id_unsur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wijk`
--
ALTER TABLE `wijk`
  MODIFY `id_wijk` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
