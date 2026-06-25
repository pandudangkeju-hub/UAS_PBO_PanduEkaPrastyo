-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jun 2026 pada 08.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1d_panduekaprastyo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `tarif_ukt` decimal(10,2) NOT NULL,
  `jenis_pembayaran` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) DEFAULT NULL,
  `dana_saku_subsidi` decimal(10,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt`, `jenis_pembayaran`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Fauzi', '250302001', 2, 5000000.00, 'mandiri', 'Golongan 4', 'Suryadi Boedi', NULL, NULL, NULL, NULL),
(2, 'Citra Lestari', '250302002', 4, 6500000.00, 'mandiri', 'Golongan 5', 'Bambang Hermawan', NULL, NULL, NULL, NULL),
(3, 'Eko Prasetyo', '250302003', 6, 4500000.00, 'mandiri', 'Golongan 3', 'Joko Susilo', NULL, NULL, NULL, NULL),
(4, 'Gita Permata', '250302004', 2, 7500000.00, 'mandiri', 'Golongan 6', 'Hendra Wijaya', NULL, NULL, NULL, NULL),
(5, 'Indra Wijaya', '250302005', 8, 5000000.00, 'mandiri', 'Golongan 4', 'Agus Budiman', NULL, NULL, NULL, NULL),
(6, 'Kevin Sanjaya', '250302006', 4, 6500000.00, 'mandiri', 'Golongan 5', 'Rudi Hartono', NULL, NULL, NULL, NULL),
(7, 'Larasati Putri', '250302007', 6, 4500000.00, 'mandiri', 'Golongan 3', 'Anwar Sadat', NULL, NULL, NULL, NULL),
(8, 'Budi Santoso', '250302008', 2, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0001', 950000.00, NULL, NULL),
(9, 'Dina Mariana', '250302009', 4, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2024-0042', 950000.00, NULL, NULL),
(10, 'Fajar Nugroho', '250302010', 6, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2023-0105', 900000.00, NULL, NULL),
(11, 'Hany Handayani', '250302011', 2, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0312', 950000.00, NULL, NULL),
(12, 'Joko Widodo', '250302012', 8, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2022-0019', 900000.00, NULL, NULL),
(13, 'Mega Utami', '250302013', 4, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2024-0789', 950000.00, NULL, NULL),
(14, 'Naufal Rizqi', '250302014', 6, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2023-0541', 900000.00, NULL, NULL),
(15, 'Rian Hidayat', '250302015', 4, 1500000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(16, 'Siti Aminah', '250302016', 6, 0.00, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.25),
(17, 'Taufik Hidayat', '250302017', 2, 2000000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Kemenpora RI', 3.40),
(18, 'Utami Lestari', '250302018', 4, 0.00, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', 3.75),
(19, 'Wawan Setiawan', '250302019', 6, 1200000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Yayasan Toyota Astra', 3.30),
(20, 'Yuni Shara', '250302020', 2, 0.00, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Pemprov', 3.50),
(21, 'Zainal Abidin', '250302021', 8, 1500000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
