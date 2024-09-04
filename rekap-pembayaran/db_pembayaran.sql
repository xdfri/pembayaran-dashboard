-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Sep 2024 pada 15.38
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembayaran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `id` int NOT NULL,
  `nama_santri` varchar(100) NOT NULL,
  `alamat` text,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`id`, `nama_santri`, `alamat`, `telepon`, `email`, `tanggal_lahir`) VALUES
(1, 'Ipul Gunawan', 'Jombang, indonesia ', '08571234431', 'gunawan@admin.com', '2007-11-21'),
(2, 'Ahmad Fadli', 'Jl. Mawar No. 1, Jakarta', '081234567890', 'ahmad@example.com', '2005-01-15'),
(3, 'Budi Santoso', 'Jl. Melati No. 2, Bandung', '082345678901', 'budi@example.com', '2005-02-20'),
(4, 'Cindy Natalia', 'Jl. Kenanga No. 3, Surabaya', '083456789012', 'cindy@example.com', '2005-03-25'),
(5, 'Dewi Puspita', 'Jl. Anggrek No. 4, Yogyakarta', '084567890123', 'dewi@example.com', '2005-04-30'),
(6, 'Eko Prabowo', 'Jl. Seroja No. 5, Semarang', '085678901234', 'eko@example.com', '2005-05-10'),
(7, 'Fina Kurniawati', 'Jl. Kamboja No. 6, Malang', '086789012345', 'fina@example.com', '2005-06-15'),
(8, 'Gita Wulandari', 'Jl. Tulip No. 7, Makassar', '087890123456', 'gita@example.com', '2005-07-20'),
(9, 'Hadi Wijaya', 'Jl. Anggrek No. 8, Palembang', '088901234567', 'hadi@example.com', '2005-08-25'),
(10, 'Ika Amelia', 'Jl. Srikaya No. 9, Pontianak', '089012345678', 'ika@example.com', '2005-09-30'),
(11, 'Joko Prasetyo', 'Jl. Manggis No. 10, Medan', '090123456789', 'joko@example.com', '2005-10-05'),
(12, 'Kiki Rahmawati', 'Jl. Melati No. 11, Batam', '091234567890', 'kiki@example.com', '2005-11-10'),
(13, 'Lia Marlina', 'Jl. Mawar No. 12, Jakarta', '092345678901', 'lia@example.com', '2005-12-15'),
(14, 'Miko Saputra', 'Jl. Melati No. 13, Bandung', '093456789012', 'miko@example.com', '2006-01-20'),
(15, 'Nina Sari', 'Jl. Kenanga No. 14, Surabaya', '094567890123', 'nina@example.com', '2006-02-25'),
(16, 'Omar Hadi', 'Jl. Anggrek No. 15, Yogyakarta', '095678901234', 'omar@example.com', '2006-03-30'),
(17, 'Putri Desi', 'Jl. Seroja No. 16, Semarang', '096789012345', 'putri@example.com', '2006-04-10'),
(18, 'Rani Kusuma', 'Jl. Kamboja No. 17, Malang', '097890123456', 'rani@example.com', '2006-05-15'),
(19, 'Sari Lestari', 'Jl. Tulip No. 18, Makassar', '098901234567', 'sari@example.com', '2006-06-20'),
(20, 'Tari Setiawan', 'Jl. Anggrek No. 19, Palembang', '099012345678', 'tari@example.com', '2006-07-25'),
(21, 'Udin Ramadhan', 'Jl. Srikaya No. 20, Pontianak', '100123456789', 'udin@example.com', '2006-08-30'),
(22, 'Vina Yuliana', 'Jl. Manggis No. 21, Medan', '101234567890', 'vina@example.com', '2006-09-05'),
(23, 'Wawan Gunawan', 'Jl. Melati No. 22, Batam', '102345678901', 'wawan@example.com', '2006-10-10'),
(24, 'Xena Arista', 'Jl. Mawar No. 23, Jakarta', '103456789012', 'xena@example.com', '2006-11-15'),
(25, 'Yudi Pratama', 'Jl. Melati No. 24, Bandung', '104567890123', 'yudi@example.com', '2006-12-20'),
(26, 'Zara Alifia', 'Jl. Kenanga No. 25, Surabaya', '105678901234', 'zara@example.com', '2007-01-25'),
(27, 'Ari Wibowo', 'Jl. Anggrek No. 26, Yogyakarta', '106789012345', 'ari@example.com', '2007-02-05'),
(28, 'Bella Juwita', 'Jl. Seroja No. 27, Semarang', '107890123456', 'bella@example.com', '2007-03-10'),
(29, 'Chandra Rinaldi', 'Jl. Kamboja No. 28, Malang', '108901234567', 'chandra@example.com', '2007-04-15'),
(30, 'Dina Fitria', 'Jl. Tulip No. 29, Makassar', '109012345678', 'dina@example.com', '2007-05-20'),
(31, 'Edy Kurniawan', 'Jl. Anggrek No. 30, Palembang', '110123456789', 'edy@example.com', '2007-06-25'),
(32, 'Farah Nurul', 'Jl. Srikaya No. 31, Pontianak', '111234567890', 'farah@example.com', '2007-07-30'),
(33, 'Gilang Setiawan', 'Jl. Manggis No. 32, Medan', '112345678901', 'gilang@example.com', '2007-08-05'),
(34, 'Hera Lestari', 'Jl. Melati No. 33, Batam', '113456789012', 'hera@example.com', '2007-09-10'),
(35, 'Indra Pratama', 'Jl. Mawar No. 34, Jakarta', '114567890123', 'indra@example.com', '2007-10-15'),
(36, 'Jeni Utami', 'Jl. Melati No. 35, Bandung', '115678901234', 'jeni@example.com', '2007-11-20'),
(37, 'Kusuma Wijaya', 'Jl. Kenanga No. 36, Surabaya', '116789012345', 'kusuma@example.com', '2007-12-25'),
(38, 'Lutfi Andi', 'Jl. Anggrek No. 37, Yogyakarta', '117890123456', 'lutfi@example.com', '2008-01-30'),
(39, 'Maya Sari', 'Jl. Seroja No. 38, Semarang', '118901234567', 'maya@example.com', '2008-02-05'),
(40, 'Nanda Susanti', 'Jl. Kamboja No. 39, Malang', '119012345678', 'nanda@example.com', '2008-03-10'),
(41, 'Oki Ramadhan', 'Jl. Tulip No. 40, Makassar', '120123456789', 'oki@example.com', '2008-04-15'),
(42, 'Fahri Dwi Hermawan', 'Jl. Gg Arjuna Banjarsari Dk Bugangin', '085784697338', 'kamil@admin.com', '2007-07-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int NOT NULL,
  `santri_id` int NOT NULL,
  `total_tagihan` text NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `tipe` enum('syariah','daftar ulang') NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `is_confirmed` tinyint(1) DEFAULT '0',
  `bulan` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `santri_id`, `total_tagihan`, `tanggal_jatuh_tempo`, `tipe`, `keterangan`, `created_at`, `updated_at`, `status`, `is_confirmed`, `bulan`) VALUES
(346, 1, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 15:15:07', 'Lunas', 1, '12'),
(347, 2, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(348, 3, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(349, 4, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(350, 5, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(351, 6, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(352, 7, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(353, 8, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(354, 9, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(355, 10, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(356, 11, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(357, 12, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(358, 13, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(359, 14, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(360, 15, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(361, 16, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(362, 17, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(363, 18, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(364, 19, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(365, 20, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(366, 21, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(367, 22, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(368, 23, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(369, 24, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(370, 25, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(371, 26, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(372, 27, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(373, 28, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(374, 29, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(375, 30, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(376, 31, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(377, 32, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(378, 33, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(379, 34, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(380, 35, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(381, 36, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(382, 37, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(383, 38, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(384, 39, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(385, 40, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(386, 41, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 14:57:32', 'Belum Lunas', 0, '12'),
(387, 42, '750.000', '2024-11-11', 'syariah', 'Tagihan massal untuk bulan September 2024', '2024-09-04 14:57:32', '2024-09-04 15:07:26', 'Lunas', 1, '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$lZ5VGBlyD/oOiHMrnHIssOvxUKA2QrLGTGIqno1UO19jW4QWASCR2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `santri_id` (`santri_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `santri`
--
ALTER TABLE `santri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
