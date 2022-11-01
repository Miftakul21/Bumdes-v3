-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 05:10 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kampung_flory4`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) DEFAULT NULL,
  `nama_lengkap_admin` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `level_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `nama_lengkap_admin`, `username`, `password`, `level_admin`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'Administrasi'),
(3, 'kepala', 'kepala', 'kepala', 'kepala', 'Kepala'),
(4, 'staf', 'staf', 'staf', 'staf', 'Administrasi'),
(5, 'win', 'Tri Win', 'admin', 'admin2', 'Administrasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `kode_akun` varchar(20) NOT NULL,
  `nama_akun` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`kode_akun`, `nama_akun`) VALUES
('1-111', 'Kas'),
('1-112', 'Piutang'),
('1-113', 'Persediaan'),
('1-211', 'Peralatan'),
('1-212', 'Tanah dan Bangunan'),
('2-111', 'Hutang Usaha'),
('3-111', 'Modal'),
('3-211', 'Prive'),
('4-111', 'Pendapatan'),
('5-111', 'Beban Gaji'),
('5-112', 'beban Operasional dan Lain - Lain');

-- --------------------------------------------------------

--
-- Table structure for table `tb_index`
--

CREATE TABLE `tb_index` (
  `id_index` varchar(20) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_index`
--

INSERT INTO `tb_index` (`id_index`, `keterangan`) VALUES
('0', 'Tidak Semua'),
('1', 'Arus Kas Kegiatan Operasi'),
('2', 'Arus Kas kegiatan Investasi'),
('3', 'Arus Kas Kegiatan Pendanaan'),
('4', 'coba');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `id_unit`, `nama_kegiatan`) VALUES
(5, 1, 'Joglo oleh-oleh'),
(6, 1, 'jasa marketing'),
(7, 1, 'Study Banding dan Tour de Flory'),
(8, 1, 'Pengelolaan Taman Selfie'),
(9, 3, 'Showroom Tanaman'),
(10, 3, 'Iwak Kalen'),
(11, 3, 'Taman Kelinci dan Kolam mini'),
(12, 2, 'Outbond'),
(13, 2, 'Parkir'),
(14, 4, 'kuliner bali ndeso'),
(15, 4, 'wahana dolan ndeso'),
(19, 3, 'Jasa Lanscape taman'),
(20, 3, 'Pelatihan budidaya tanaman'),
(21, 2, 'Gerai Sovenir'),
(22, 2, 'Wahana Reguler'),
(23, 2, 'food court'),
(24, 2, 'HUMI'),
(25, 2, 'Jembatan Goyang'),
(26, 2, 'Bumper'),
(27, 4, 'Kopi Receh');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_jurnal` int(11) NOT NULL,
  `id_transaksi` char(14) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `kode_akun` varchar(20) DEFAULT NULL,
  `id_index` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `debet` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_jurnal`, `id_transaksi`, `tanggal`, `id_kegiatan`, `kode_akun`, `id_index`, `keterangan`, `debet`, `kredit`) VALUES
(1, 'T201114-001', '2020-11-01', 1, '1-111', '3', 'penerimaan kas dari investasi pemilik', 250000000, 0),
(2, 'T201114-002', '2020-11-01', 1, '1-212', '0', 'pembeliaan tanah dan bangunan tempat usaha', 185000000, 0),
(3, 'T201114-002', '2020-11-01', 1, '1-111', '2', 'pembeliaan tanah dan bangunan tempat usaha', 0, 185000000),
(6, 'T201114-003', '2020-11-01', 1, '1-211', '0', 'pembeliaan peralatan kantor', 85000000, 0),
(7, 'T201114-003', '2020-11-01', 1, '1-111', '1', 'pembeliaan peralatan kantor', 0, 50000000),
(8, 'T201114-004', '2020-11-01', 1, '1-111', '3', 'penerimaan kas dari investasi tambahan', 50000000, 0),
(9, 'T201114-005', '2020-11-01', 1, '1-113', '0', 'pembeliaan barang daganngan(persediaaan)', 45000000, 0),
(10, 'T201114-005', '2020-11-01', 1, '1-111', '1', 'pembeliaan barang daganngan(persediaaan)', 0, 45000000),
(11, 'T201114-006', '2020-11-01', 1, '1-111', '1', 'pendapatan dari penyewaan barang', 30000000, 0),
(12, 'T201114-006', '2020-11-01', 1, '1-112', '0', 'pendapatan dari penyewaan barang', 12000000, 0),
(13, 'T201114-007', '2020-11-01', 1, '1-111', '1', 'penerimaan hutang usaha dari siapa tgll 12/01/2020', 8000000, 0),
(14, 'T201114-007', '2020-11-01', 1, '1-112', '0', 'penerimaan hutang usaha dari siapa tgll 12/01/2020', 0, 8000000),
(15, 'T201114-008', '2020-11-01', 1, '1-111', '3', 'pengambilan kas pribadi pemilik', 0, 10000000),
(16, 'T201114-009', '2020-11-01', 1, '1-111', '1', 'pembayaran dari gaji karyawan', 0, 12500000),
(17, 'T201114-010', '2020-11-01', 1, '1-113', '0', 'pemakaian persediaan selama bulan ini', 0, 30000000),
(18, 'T201114-011', '2020-11-01', 1, '1-111', '3', 'kas dari hutang usaha', 250000000, 0),
(19, 'T201114-012', '2020-11-01', 1, '1-111', '1', 'penerimaan kas dari pembayaran piutang', 8000000, 0),
(20, 'T201114-012', '2020-11-01', 1, '1-112', '0', 'penerimaan kas dari pembayaran piutang', 0, 8000000),
(21, 'T201114-013', '2020-11-01', 4, '1-111', '0', 'ini keterangan 1', 250000000, 0),
(22, 'T201114-013', '2020-11-01', 4, '3-111', '0', 'ini keterangan 1', 0, 250000000),
(23, 'T201114-014', '2020-11-01', 4, '1-212', '0', 'ini keterangan 2', 185000000, 0),
(24, 'T201114-014', '2020-11-01', 4, '1-111', '0', 'ini keterangan 2', 0, 185000000),
(25, 'T201114-015', '2020-11-16', 4, '1-211', '0', 'ini keterangan 3', 85000000, 0),
(26, 'T201114-015', '2020-11-16', 4, '1-111', '0', 'ini keterangan 3', 0, 50000000),
(27, 'T201114-015', '2020-11-16', 4, '2-111', '0', 'ini keterangan 3', 0, 35000000),
(28, 'T201114-016', '2020-11-16', 4, '1-111', '0', 'ini keterangan 4', 50000000, 0),
(29, 'T201114-016', '2020-11-16', 4, '3-111', '0', 'ini keterangan 4', 0, 50000000),
(30, 'T201114-017', '2020-11-09', 4, '1-113', '0', 'ini keterangan 5', 45000000, 0),
(31, 'T201114-017', '2020-11-09', 4, '1-111', '0', 'ini keterangan 5', 0, 45000000),
(32, 'T201114-018', '2020-11-17', 4, '1-111', '0', 'ini keterangan 6', 30000000, 0),
(33, 'T201114-018', '2020-11-17', 4, '1-112', '0', 'ini keterangan 6', 12000000, 0),
(34, 'T201114-018', '2020-11-17', 4, '4-111', '0', 'ini keterangan 6', 0, 42000000),
(35, 'T201114-019', '2020-11-17', 4, '3-211', '0', 'ini keterangan 7', 10000000, 0),
(36, 'T201114-019', '2020-11-17', 4, '1-111', '0', 'ini keterangan 7', 0, 10000000),
(37, 'T201114-020', '2020-11-17', 4, '1-111', '0', 'ini keterangan 8', 8000000, 0),
(38, 'T201114-020', '2020-11-17', 4, '1-112', '0', 'ini keterangan 8', 0, 8000000),
(39, 'T201114-021', '2020-11-18', 4, '5-111', '0', 'ini keterangan 9', 12500000, 0),
(40, 'T201114-021', '2020-11-18', 4, '1-111', '0', 'ini keterangan 9', 0, 12500000),
(41, 'T201114-022', '2020-11-18', 4, '5-112', '0', 'ini keterangan 10', 30000000, 0),
(42, 'T201114-022', '2020-11-18', 4, '1-113', '0', 'ini keterangan 10', 0, 30000000),
(43, 'T201114-023', '2020-11-19', 4, '1-111', '0', 'ini keterangan 10', 250000000, 0),
(44, 'T201114-023', '2020-11-19', 4, '2-111', '0', 'ini keterangan 10', 0, 250000000),
(45, 'T201114-024', '2020-11-20', 4, '1-111', '0', 'ini keterangan 10', 8000000, 0),
(46, 'T201114-024', '2020-11-20', 4, '1-112', '0', 'ini keterangan 10', 0, 8000000),
(54, 'T201115-001', '2020-11-01', 5, '1-111', '3', 'penerimaan kas dari investasi pemilik', 250000000, 0),
(55, 'T201115-002', '2020-11-02', 5, '1-212', '0', 'pembeliaan tanah dan bangunan tempat usaha', 185000000, 0),
(56, 'T201115-002', '2020-11-02', 5, '1-111', '2', 'pembeliaan tanah dan bangunan tempat usaha', 0, 185000000),
(57, 'T201115-003', '2020-11-03', 5, '1-211', '0', 'pembeliaan peralatan kantor', 85000000, 0),
(58, 'T201115-003', '2020-11-03', 5, '1-111', '1', 'pembeliaan peralatan kantor', 0, 50000000),
(59, 'T201115-004', '2020-11-02', 5, '1-111', '3', 'penerimaan kas dari investasi tambahan', 50000000, 0),
(60, 'T201115-005', '2020-11-03', 5, '1-113', '0', 'pembeliaan barang daganngan(persediaaan)', 45000000, 0),
(61, 'T201115-005', '2020-11-03', 5, '1-111', '1', 'pembeliaan barang daganngan(persediaaan)', 0, 45000000),
(62, 'T201115-006', '2020-11-01', 5, '1-111', '1', 'pendapatan dari penyewaan barang', 30000000, 0),
(63, 'T201115-006', '2020-11-01', 5, '1-112', '0', 'pendapatan dari penyewaan barang', 12000000, 0),
(64, 'T201115-007', '2020-11-10', 5, '1-111', '3', 'pengambilan kas pribadi pemilik', 0, 10000000),
(65, 'T201115-008', '2020-11-10', 5, '1-111', '1', 'penerimaan hutang usaha dari siapa tgll 12/01/2020', 8000000, 0),
(66, 'T201115-008', '2020-11-10', 5, '1-112', '0', 'penerimaan hutang usaha dari siapa tgll 12/01/2020', 0, 8000000),
(67, 'T201115-009', '2020-11-11', 5, '1-111', '1', 'pembayaran dari gaji karyawan', 0, 12500000),
(68, 'T201115-010', '2020-11-11', 5, '1-113', '0', 'pemakaian persediaan selama bulan ini', 0, 30000000),
(69, 'T201115-011', '2020-11-12', 5, '1-111', '3', 'kas dari hutang usaha', 250000000, 0),
(70, 'T201115-012', '2020-11-15', 5, '1-111', '1', 'penerimaan kas dari pembayaran piutang', 8000000, 0),
(71, 'T201115-012', '2020-11-15', 5, '1-112', '0', 'penerimaan kas dari pembayaran piutang', 0, 8000000),
(72, 'T201115-013', '2020-11-15', 5, '2-111', '4', 'coba', 10000000, 0),
(73, 'T201115-014', '2020-11-15', 5, '3-211', '0', 'prive', 1000000000, 0),
(74, 'T201115-015', '2020-11-15', 5, '3-111', '0', 'modal', 300000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(30) DEFAULT NULL,
  `jenis_usaha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `nama_unit`, `jenis_usaha`) VALUES
(1, 'Kampung Flory', 'Jasa'),
(2, 'Dewi Flory', 'Jasa'),
(3, 'Taruna Tani', 'Jasa'),
(4, 'Bali Ndeso Group', 'Jasa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `nama_lengkap_user` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `level_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `nama_lengkap_user`, `username`, `password`, `id_unit`, `level_user`) VALUES
(2, 'flory1', 'flory1', 'flory1', 'flory1', 2, 'Transaksi'),
(5, 'flory2', 'flory2', 'flory2', 'flory2', 2, 'Ketua'),
(6, 'taruna', 'taruna', 'taruna', 'taruna', 3, 'Transaksi'),
(7, 'Bu Nuri', 'Bu Nuriiiii', 'nuri', 'nuri', 4, 'Transaksi'),
(8, 'Pak Santo', 'Pak Santooo', 'santo', 'santo', 1, 'Transaksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indexes for table `tb_index`
--
ALTER TABLE `tb_index`
  ADD PRIMARY KEY (`id_index`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
