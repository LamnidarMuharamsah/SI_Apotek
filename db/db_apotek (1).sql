-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Des 2016 pada 01.48
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `apoteker`
--

CREATE TABLE `apoteker` (
  `kodeApoteker` char(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tempatLahir` varchar(20) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apoteker`
--

INSERT INTO `apoteker` (`kodeApoteker`, `nama`, `tempatLahir`, `tanggalLahir`, `alamat`, `username`, `password`) VALUES
('AP0001', 'Admin 1', 'Bandung', '1995-12-12', 'JL. Raya Elite V', 'admin', 'c3284d0f94606de1fd2af172aba15bf3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat`
--

CREATE TABLE `detail_obat` (
  `kodeObat` char(6) NOT NULL,
  `kodeKadaluarsa` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `kodeTransaksi` char(6) DEFAULT NULL,
  `kodeObat` char(6) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kadaluarsa_obat`
--

CREATE TABLE `kadaluarsa_obat` (
  `kodeKadaluarsa` varchar(6) NOT NULL,
  `tglKadaluarsa` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kadaluarsa_obat`
--

INSERT INTO `kadaluarsa_obat` (`kodeKadaluarsa`, `tglKadaluarsa`) VALUES
('KO0001', '1995-12-23'),
('KO0002', '2016-12-24'),
('KO0003', '2017-04-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kodeObat` char(6) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `kodeSupplier` char(6) DEFAULT NULL,
  `satuan` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kodeObat`, `nama`, `stok`, `expire`, `harga`, `kodeSupplier`, `satuan`) VALUES
('OB0001', 'imboost', 10, '2016-12-30', 20000, 'SP0003', 'Botol'),
('OB0002', 'ctm', 12, '2016-12-30', 10000, 'SP0002', 'Kaplet'),
('OB0003', 'rifamfisin', 1, '2016-12-19', 20000, 'SP0002', 'Kaplet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `kodeSupplier` char(6) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `noHp` varchar(12) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kodeSupplier`, `nama`, `alamat`, `noHp`) VALUES
('SP0001', 'Doni k', 'JL. Raya Premium V', '07859999999'),
('SP0002', 'Jaya Farma', 'Jl. Jaya', '465657657'),
('SP0003', 'Kimia Farma', 'Jl. Kimia', '4535436456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kodeTransaksi` char(6) NOT NULL,
  `tanggalTransaksi` date DEFAULT NULL,
  `kodeApoteker` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apoteker`
--
ALTER TABLE `apoteker`
  ADD PRIMARY KEY (`kodeApoteker`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `kodeTransaksi` (`kodeTransaksi`),
  ADD KEY `kodeObat` (`kodeObat`);

--
-- Indexes for table `kadaluarsa_obat`
--
ALTER TABLE `kadaluarsa_obat`
  ADD PRIMARY KEY (`kodeKadaluarsa`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kodeObat`),
  ADD KEY `kodeSupplier` (`kodeSupplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kodeSupplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kodeTransaksi`),
  ADD KEY `kodeApoteker` (`kodeApoteker`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
