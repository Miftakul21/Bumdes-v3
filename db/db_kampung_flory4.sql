-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2022 pada 05.04
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

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
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `level_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`, `level_admin`) VALUES
(1, 'Miftakul Huda', 'admin', 'admin', 'Administrasi'),
(7, 'Joko Tingkir', 'Joko123', 'Joko1234', 'Kepala');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE `tb_akun` (
  `kode_akun` varchar(20) NOT NULL,
  `nama_akun` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akun`
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
('5-112', 'beban Operasional dan Lain - Lain'),
('5-120', 'Akun Kami');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_index`
--

CREATE TABLE `tb_index` (
  `id_index` varchar(20) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_index`
--

INSERT INTO `tb_index` (`id_index`, `keterangan`) VALUES
('1', 'Arus Kas Kegiatan Operasi'),
('2', 'Arus Kas kegiatan Investasi'),
('3', 'Arus Kas Kegiatan Pendanaan'),
('4', 'Keuangan Gagal'),
('5', 'Apa Aja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `id_unit`, `nama_kegiatan`) VALUES
(5, 1, 'Joglo oleh-oleh'),
(6, 1, 'jasa marketing'),
(7, 1, 'Study Banding dan Tour de Flory'),
(9, 3, 'Showroom Tanaman'),
(10, 3, 'Iwak Kalen'),
(11, 3, 'Taman Kelinci dan Kolam mini'),
(14, 4, 'kuliner bali ndeso'),
(15, 4, 'wahana dolan ndeso'),
(19, 3, 'Jasa Lanscape taman'),
(20, 3, 'Pelatihan budidaya tanaman'),
(27, 4, 'Kopi Receh'),
(28, 1, 'Pengelolaan Warung Mewah'),
(29, 9, 'Pembelian Peralatan Dapur'),
(30, 9, 'Modal Untuk Sewa Tempat ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
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
-- Dumping data untuk tabel `tb_transaksi`
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
(78, 'T221031-001', '2022-10-31', 28, '3-111', '2', 'Peralatan Dapur', 20000000, 0),
(79, 'T221031-001', '2022-10-31', 28, '1-211', '1', 'Peralatan Dapur', 5000000, 0),
(80, 'T221102-001', '2022-11-02', 29, '1-111', '3', 'Beli Panci ', 10000000, 0),
(81, 'T221102-001', '2022-11-02', 29, '1-111', '1', 'Beli Panci ', 2500000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `nama_unit`) VALUES
(9, 'Warung Mewah'),
(10, 'Warung Kopi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `level_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `id_unit`, `level_user`) VALUES
(1, 'Miftakul', 'Mifta', 'Mifta123', 9, 'Transaksi'),
(6, 'Putra Dwi A.', 'PutraA4321', 'Putra54321', 9, 'Ketua');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `tb_index`
--
ALTER TABLE `tb_index`
  ADD PRIMARY KEY (`id_index`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indeks untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
