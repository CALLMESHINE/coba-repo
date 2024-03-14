-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2024 pada 02.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemdes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_bumdes`
--

CREATE TABLE `admin_bumdes` (
  `id_petugas` int(11) NOT NULL,
  `nm_petugas` varchar(25) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `id_bumdes` int(11) DEFAULT NULL,
  `alamat_asal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_bumdes`
--

INSERT INTO `admin_bumdes` (`id_petugas`, `nm_petugas`, `username`, `password`, `id_bumdes`, `alamat_asal`) VALUES
(14, 'rozak', 'mojosari', 'mojosari', 22, 'mojosari'),
(15, 'khafik', 'balekambang', 'balekambang', 23, 'balekambang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_pemdes_ekspres`
--

CREATE TABLE `admin_pemdes_ekspres` (
  `id_admin` int(11) NOT NULL,
  `nm_admin` varchar(15) DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_pemdes_ekspres`
--

INSERT INTO `admin_pemdes_ekspres` (`id_admin`, `nm_admin`, `no_hp`, `username`, `password`) VALUES
(3, 'khafik rozak', '081229568186', 'khafik', 'khafik'),
(4, 'rozak', '08975765482', 'khafik', 'khafik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nm_barang` varchar(50) DEFAULT NULL,
  `jml_barang` char(20) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `brt_barang` float DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `no_resi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_kirim`
--

CREATE TABLE `barang_kirim` (
  `id_barang_kirim` int(11) NOT NULL,
  `nm_barang` varchar(50) DEFAULT NULL,
  `jml_barang` char(20) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `no_resi` varchar(50) DEFAULT NULL,
  `brt_barang` float DEFAULT NULL,
  `id_pengiriman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_kirim`
--

INSERT INTO `barang_kirim` (`id_barang_kirim`, `nm_barang`, `jml_barang`, `id_kategori`, `no_resi`, `brt_barang`, `id_pengiriman`) VALUES
(116, 'WAJAN', '1', 14, 'PEMDES-99543436', 2, 145);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bumdes`
--

CREATE TABLE `bumdes` (
  `id_bumdes` int(11) NOT NULL,
  `nm_bumdes` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bumdes`
--

INSERT INTO `bumdes` (`id_bumdes`, `nm_bumdes`, `alamat`) VALUES
(22, 'BUMDES MOJOSARI', 'MOJOSARI'),
(23, 'BUMDES BALEKAMBANG', 'BALEKAMBANG'),
(24, 'BUMDES DERODUWUR', 'DERODUWUR'),
(25, 'BUMDES DERONGISOR', 'DERONGISOR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `nama_pengirim` varchar(30) DEFAULT NULL,
  `no_hp_pengirim` char(13) DEFAULT NULL,
  `alamat_asal` text DEFAULT NULL,
  `id_bumdes_asal` varchar(20) DEFAULT NULL,
  `id_bumdes_tujuan` varchar(20) DEFAULT NULL,
  `alamat_tujuan` text DEFAULT NULL,
  `nm_penerima` varchar(15) DEFAULT NULL,
  `no_hp_penerima` char(13) DEFAULT NULL,
  `status_kirim` varchar(15) DEFAULT NULL,
  `status_bayar` enum('lunas','bayar_ditempat') NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `waktu_status_kirim_packing` datetime DEFAULT NULL,
  `waktu_status_kirim_penyortiran` datetime DEFAULT NULL,
  `waktu_status_kirim_pengiriman` datetime DEFAULT NULL,
  `waktu_status_barang_sampai` datetime DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_barang_kirim` int(11) DEFAULT NULL,
  `nm_barang` varchar(50) DEFAULT NULL,
  `jml_barang` char(20) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `no_resi` varchar(50) DEFAULT NULL,
  `brt_barang` float DEFAULT NULL,
  `id_pengiriman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` varchar(50) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `harga_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nm_kategori`, `deskripsi`, `harga_kategori`) VALUES
(14, 'prabot', 'prabot', 5000),
(17, 'makanan', 'makan makan', 4500),
(18, 'elektronik', 'elektron', 5000),
(19, 'alat tulis', 'peralatan kantor dan sekolah', 2499);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nm_kecamatan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nm_kecamatan`) VALUES
(2, 'MOJOTENGAH'),
(4, 'WADASLINTANG'),
(5, 'KALIBAWANG'),
(6, 'WONOSOBO'),
(7, 'KEJAJAR'),
(8, 'KALIKAJAR'),
(9, 'KERTEK'),
(10, 'KEPIL'),
(11, 'SAPURAN'),
(12, 'WATUMALANG'),
(13, 'LEKSONO'),
(14, 'SUKOHARJO'),
(15, 'GARUNG'),
(16, 'KALIWIRO'),
(17, 'SELOMERTO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `nm_kurir` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nm_kurir`, `alamat`, `no_hp`, `username`, `password`) VALUES
(1, 'tugiman', 'Desa Mojosari, Kec. Mojotengah, Kab. Wonosobo', '081229568186', 'tugiman', 'tugiman'),
(4, 'rozak', 'Desa Mojosari, Kec. Mojotengah, Kab. Wonosobo', '081229568186', 'rozak', 'rozak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `nama_pengirim` varchar(30) DEFAULT NULL,
  `no_hp_pengirim` char(13) DEFAULT NULL,
  `alamat_asal` text DEFAULT NULL,
  `id_bumdes_asal` varchar(20) DEFAULT NULL,
  `id_bumdes_tujuan` varchar(20) DEFAULT NULL,
  `alamat_tujuan` text DEFAULT NULL,
  `nm_penerima` varchar(15) DEFAULT NULL,
  `no_hp_penerima` char(13) DEFAULT NULL,
  `status_kirim` varchar(15) DEFAULT NULL,
  `status_bayar` enum('lunas','bayar_ditempat') NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `waktu_status_kirim_packing` datetime DEFAULT NULL,
  `waktu_status_kirim_penyortiran` datetime DEFAULT NULL,
  `waktu_status_kirim_pengiriman` datetime DEFAULT NULL,
  `waktu_status_barang_sampai` datetime DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_petugas`, `nama_pengirim`, `no_hp_pengirim`, `alamat_asal`, `id_bumdes_asal`, `id_bumdes_tujuan`, `alamat_tujuan`, `nm_penerima`, `no_hp_penerima`, `status_kirim`, `status_bayar`, `id_kurir`, `total_bayar`, `waktu_status_kirim_packing`, `waktu_status_kirim_penyortiran`, `waktu_status_kirim_pengiriman`, `waktu_status_barang_sampai`, `id_kecamatan`) VALUES
(145, 15, 'khafik', '22', 'Desa lemiring Rt 06 Rw 02, Desa Mojosari, Kec. Mojotengah, Kab. Wonosobo', '22', '22', 'Desa lemiring Rt 06 Rw 02, Desa Mojosari, Kec. Mojotengah, Kab. Wonosobo', 'KHAFIK ROZAK', '12312', 'Packing Barang', 'lunas', 1, 10000, '2024-01-24 14:01:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(150, 14, 'KHAFIK', '1212', 'Desa lemiring Rt 06 Rw 02, Desa Mojosari, Kec. Mojotengah, Kab. Wonosobo', '22', '23', 'Desa lemiring Rt 06 Rw 02, Desa Mojosari, Kec. Mojotengah, Kab. Wonosobo', 'KHAFIK ROZAK', '1120', 'Packing Barang', 'lunas', 1, 0, '2024-01-26 22:21:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_bumdes`
--
ALTER TABLE `admin_bumdes`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `bum` (`id_bumdes`);

--
-- Indeks untuk tabel `admin_pemdes_ekspres`
--
ALTER TABLE `admin_pemdes_ekspres`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_kirim`
--
ALTER TABLE `barang_kirim`
  ADD PRIMARY KEY (`id_barang_kirim`) USING BTREE,
  ADD KEY `pengir` (`id_pengiriman`);

--
-- Indeks untuk tabel `bumdes`
--
ALTER TABLE `bumdes`
  ADD PRIMARY KEY (`id_bumdes`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`) USING BTREE,
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `bar` (`id_barang_kirim`),
  ADD KEY `peng` (`id_pengiriman`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`) USING BTREE,
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_bumdes`
--
ALTER TABLE `admin_bumdes`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `admin_pemdes_ekspres`
--
ALTER TABLE `admin_pemdes_ekspres`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `barang_kirim`
--
ALTER TABLE `barang_kirim`
  MODIFY `id_barang_kirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `bumdes`
--
ALTER TABLE `bumdes`
  MODIFY `id_bumdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_bumdes`
--
ALTER TABLE `admin_bumdes`
  ADD CONSTRAINT `bum` FOREIGN KEY (`id_bumdes`) REFERENCES `bumdes` (`id_bumdes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_kirim`
--
ALTER TABLE `barang_kirim`
  ADD CONSTRAINT `pengir` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `bar` FOREIGN KEY (`id_barang_kirim`) REFERENCES `barang_kirim` (`id_barang_kirim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `admin_bumdes` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peng` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `admin_bumdes` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
