-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 03, 2023 at 02:16 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `tahun` year(4) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `baris_rak` int(3) NOT NULL,
  `nomor_rak` int(3) NOT NULL,
  `img` text NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(3) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `kode_buku`, `judul`, `tahun`, `pengarang`, `penerbit`, `baris_rak`, `nomor_rak`, `img`, `keterangan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'BKM25CE2', 'Habis Gelap Terbitlah Terang', 1990, 'gsdghasdg', 'gsdgsdaga', 2, 2, '0S3Z.jpg', 'hdfhdfhsd', '2023-02-28 15:51:01', 1, '0000-00-00 00:00:00', 0),
(3, 'BKD5SDVQ', 'Indahnya berbagi', 2020, 'gdsgsaggdsga', 'gsdgas', 20, 2, 'M368.jpg', 'gsdgasgas', '2023-02-28 15:52:35', 1, '0000-00-00 00:00:00', 0),
(4, 'BKFRW0J4', 'dsgsdga', 2021, 'gdsgsa', 'gsdgsag', 5, 24, '3J7M.jpg', '', '2023-03-01 12:11:20', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `kode_pinjam` varchar(8) NOT NULL,
  `kode_buku` varchar(8) NOT NULL,
  `nis` int(15) NOT NULL,
  `sampai` date NOT NULL,
  `hp` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_pinjam`, `kode_pinjam`, `kode_buku`, `nis`, `sampai`, `hp`, `keterangan`, `status`, `created_at`, `created_by`) VALUES
(4, 'PJQ1FCNJ', 'BKFRW0J4', 123456789, '2023-03-04', 2147483647, 'jhlkj', 1, '2023-03-01 01:23:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `foto` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama`, `jk`, `alamat`, `kelas`, `foto`, `created_at`, `created_by`) VALUES
(2, 123456789, 'Andri Saputra', 'Laki-laki', 'gsdgdsag', '4A', 'NSKX39.png', '2023-03-01 19:41:07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
