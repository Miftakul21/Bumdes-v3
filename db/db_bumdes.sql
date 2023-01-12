-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2023 pada 14.00
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
-- Database: `db_bumdes`
--

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
('5-112', 'beban Operasional dan Lain - Lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota_pinjam`
--

CREATE TABLE `tb_anggota_pinjam` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dukuh` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `rw` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota_pinjam`
--

INSERT INTO `tb_anggota_pinjam` (`id`, `kode`, `nama`, `dukuh`, `alamat`, `rt`, `rw`) VALUES
(1, 'Pribadi', 'Joko Tingkir 123', 'Dukuh 5', 'Minggirsari 1', '02', '05'),
(2, 'Pribadi', 'Budi ', 'Dukuh 1', 'Minggirsari 1', '01', '05'),
(3, 'Pribadi ', 'Suparno', 'Dukuh 5', 'Minggirsari', '02', '02'),
(4, 'POK', 'Miftakul Huda', 'Dukuh 10', 'Minggirsari 1', '01', '01'),
(5, 'Pribadi', 'Andi', 'Dukuh ', 'Minggirsari', '01', '01'),
(10, 'Pribadi', 'Sri Wiyati', 'Dukuh 10', 'Minggirsari', '01', '01'),
(11, 'POK 1', 'Jaka T', 'Dukuh 1', 'Minggirsari 1', '01', '02'),
(12, 'Pribadi ', 'Kinanti', 'Dukuh 1', 'Minggirsari 1', '01', '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_angsuran`
--

CREATE TABLE `tb_angsuran` (
  `id_angsur` int(11) NOT NULL,
  `id_anggota` varchar(5) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `pokok` int(11) NOT NULL,
  `jasa` int(11) NOT NULL,
  `potongan_pelunasan` int(11) NOT NULL,
  `sisa_pinjaman_penelusuran` int(11) NOT NULL,
  `sisa_pinjaman_non_jasa` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_angsuran`
--

INSERT INTO `tb_angsuran` (`id_angsur`, `id_anggota`, `tanggal`, `pokok`, `jasa`, `potongan_pelunasan`, `sisa_pinjaman_penelusuran`, `sisa_pinjaman_non_jasa`, `keterangan`) VALUES
(43, '3', '2022-01-01', 200000, 40000, 0, 2160000, 1800000, 'Belum Lunas'),
(45, '3', '2022-02-02', 200000, 40000, 0, 1920000, 1600000, 'Belum Lunas'),
(46, '3', '2022-02-02', 200000, 40000, 0, 1680000, 1400000, 'Belum Lunas'),
(47, '3', '2022-02-02', 200000, 40000, 0, 1440000, 1200000, 'Belum Lunas'),
(49, '5', '2022-01-01', 80000, 16000, 0, 864000, 720000, 'Belum Lunas'),
(50, '3', '2022-03-04', 200000, 40000, 0, 1200000, 1000000, 'Belum Lunas'),
(51, '3', '2022-05-04', 200000, 40000, 0, 960000, 800000, 'Belum Lunas'),
(52, '3', '2022-08-04', 200000, 40000, 0, 720000, 600000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_angsuran_pinjam`
--

CREATE TABLE `tb_angsuran_pinjam` (
  `id_pinjaman` varchar(5) NOT NULL,
  `jangka_pinjaman` varchar(5) NOT NULL,
  `nominal_pinjaman` int(11) NOT NULL,
  `pokok` int(11) NOT NULL,
  `jasa` int(11) NOT NULL,
  `total_pokok_jasa` int(11) NOT NULL,
  `sisa_pinjaman_penelusuran` int(11) NOT NULL,
  `sisa_pinjaman_pokok_jasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_angsuran_pinjam`
--

INSERT INTO `tb_angsuran_pinjam` (`id_pinjaman`, `jangka_pinjaman`, `nominal_pinjaman`, `pokok`, `jasa`, `total_pokok_jasa`, `sisa_pinjaman_penelusuran`, `sisa_pinjaman_pokok_jasa`) VALUES
('1', '10', 2200000, 220000, 44000, 264000, 2200000, 0),
('2', '10', 500000, 50000, 10000, 60000, 500000, 600000),
('3', '10', 2000000, 200000, 40000, 240000, 2000000, 2400000),
('4', '10', 200000, 20000, 4000, 24000, 200000, 240000),
('5', '10', 800000, 80000, 16000, 96000, 800000, 960000),
('9', '10', 1000, 100, 20, 120, 1000, 1200),
('10', '10', 5000000, 500000, 100000, 600000, 5000000, 6000000),
('11', '10', 1000000, 100000, 20000, 120000, 1000000, 1200000),
('12', '10', 2500000, 250000, 50000, 300000, 2500000, 3000000);

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
('3', 'Arus Kas Kegiatan Pendanaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kas`
--

CREATE TABLE `tb_kas` (
  `id_kas` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `kode_akun` varchar(5) NOT NULL,
  `sumber` varchar(5) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kas`
--

INSERT INTO `tb_kas` (`id_kas`, `tanggal`, `id_transaksi`, `kode_akun`, `sumber`, `keterangan`, `debet`, `kredit`) VALUES
(1, '2022-12-07', 'T221207-001', '1-111', '1', 'Pemasukan Dana Unit Warung Mewah', 6000000, 0),
(2, '2022-12-07', 'T221207-002', '5-112', '1', 'Pembayaran wifi bulanan Desa', 0, 200000),
(3, '2022-12-07', 'T221207-003', '2-111', '3', 'Pembayaran Hutang Bank BRI (example)', 0, 600000),
(4, '2022-10-01', 'T221207-004', '3-111', '3', 'Pembelian Unit Ban, Pelampung, Tenaga Kerja', 9000000, 0),
(5, '2022-01-01', 'T221207-005', '5-112', '3', 'Investasi lahan untuk sacing ', 10000000, 0);

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
(30, 9, 'Modal Untuk Sewa Tempat '),
(31, 18, 'Bootcamp Web Programming'),
(32, 18, 'Koding harus pake kopi'),
(35, 16, 'Wisata Watu Bonang');

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
  `keterangan_transaksi` varchar(255) DEFAULT NULL,
  `debet` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_jurnal`, `id_transaksi`, `tanggal`, `id_kegiatan`, `kode_akun`, `id_index`, `keterangan_transaksi`, `debet`, `kredit`) VALUES
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
(81, 'T221102-001', '2022-11-02', 29, '1-111', '1', 'Beli Panci ', 2500000, 0),
(82, 'T221107-001', '2022-11-07', 30, '1-111', '1', 'jhvjhvghvhg', 900000, 0),
(83, 'T221107-001', '2022-11-07', 30, '1-111', '1', 'jhvjhvghvhg', 0, 80000),
(84, 'T221108-001', '2022-11-08', 29, '1-111', '1', 'Pembayaran SPP', 10000, 0),
(85, 'T221108-001', '2022-11-08', 29, '1-111', '1', 'Pembayaran SPP', 20000, 0),
(86, 'T221207-001', '2022-12-07', 35, '4-111', 'Arus Kas Kegiatan Op', 'Pendanaan modal untuk wisata watu bonang', 10000000, 0);

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
(16, 'Watu Bonang'),
(17, 'Warung Kopi'),
(18, 'Warung Coding');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_unit` varchar(20) NOT NULL,
  `level_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `id_unit`, `level_user`) VALUES
(1, 'admin', 'admin', '7488e331b8b64e5794da3fa4eb10ad5d', '-', 'Admin'),
(2, 'Miftakul Huda', 'mifta123', 'e5286a0d9c59e4a2edd1580deae332bd', '-', 'Bendahara'),
(3, 'Megawati', 'Mega', '46356784f9ece5d9d9319a8f3ddd2fdd', '-', 'Kepala Desa'),
(5, 'Arya', 'Arya', 'f728d78f5a5dfe25d633fdf0204ccae7', '9', 'Ketua'),
(6, 'User2', 'user2', '80ec08504af83331911f5882349af59d', '16', 'Ketua'),
(7, 'User 3', 'user3', '80ec08504af83331911f5882349af59d', '17', 'Ketua'),
(8, 'User 4', 'user4', '80ec08504af83331911f5882349af59d', '18', 'Ketua');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `tb_anggota_pinjam`
--
ALTER TABLE `tb_anggota_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_angsuran`
--
ALTER TABLE `tb_angsuran`
  ADD PRIMARY KEY (`id_angsur`);

--
-- Indeks untuk tabel `tb_index`
--
ALTER TABLE `tb_index`
  ADD PRIMARY KEY (`id_index`);

--
-- Indeks untuk tabel `tb_kas`
--
ALTER TABLE `tb_kas`
  ADD PRIMARY KEY (`id_kas`);

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
-- AUTO_INCREMENT untuk tabel `tb_anggota_pinjam`
--
ALTER TABLE `tb_anggota_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_angsuran`
--
ALTER TABLE `tb_angsuran`
  MODIFY `id_angsur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tb_kas`
--
ALTER TABLE `tb_kas`
  MODIFY `id_kas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
