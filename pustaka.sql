-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 10:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pustaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` varchar(12) NOT NULL,
  `tgl_booking` date NOT NULL,
  `batas_ambil` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(256) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `pengarang` varchar(128) NOT NULL,
  `penerbit` varchar(128) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `isbn` varchar(64) NOT NULL,
  `stok` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL,
  `dibooking` int(11) NOT NULL,
  `image` varchar(256) DEFAULT 'book-default-cover.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `id_kategori`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `stok`, `dipinjam`, `dibooking`, `image`) VALUES
(16, 'Membuat Web Dengan Framework Codeigniter; Studi Kasus Sistem Informasi Perpustakaan', 1, 'Gunawan Budi Sulistyo, Pudji Widodo', 'Graha Ilmu', 2020, '978-623-228-403-6', 19, 0, 0, 'Membuat_Web_Dengan_Framework_Codeigniter_Studi_Kasus_Sistem_Informasi_Perpustakaan.jpg'),
(18, 'Web programing : membangun aplikasi perpustakaan dengan framework codeigniter', 1, 'Maruloh, Nining Suryani, Evy Priyanti', 'Graha Ilmu', 2019, '978-623-228-220-9', 15, 0, 0, 'Web_programing_:_membangun_aplikasi_perpustakaan_dengan_framework_codeigniter.jpg'),
(19, 'Aplikasi basis data mahir menggunakan SQL', 1, 'M. Nandi S, Rahayu N, Widiarina, Suharyanto', 'Graha Ilmu', 2019, '978-623-228-180-6', 30, 0, 0, 'Aplikasi_basis_data_mahir_menggunakan_SQL.jpg'),
(20, 'Analisa Perancangan Sistem Informasi', 1, 'Fintri I, Yunita, Dinda AM, Artika S, Sriyadi', 'Graha Ilmu', 2020, '978-623-228-179-0', 15, 0, 0, 'Analisa_Perancangan_Sistem_Informasi.jpg'),
(21, 'PHP Komplet', 1, 'Jubilee Enterprise', 'Elex Media Komputindo', 2017, '9786020425306', 22, 0, 0, 'PHP_Komplet.jpg'),
(22, 'Komunikasi Lintas Budaya Memahami Teks Komunikasi, Media, Agama, dan Kebudayaan Indonesia', 5, 'Dr. Dedi Kurnia Syah P., M.Ikom.', 'Simbiosa Rekatama Media', 2016, '978-602-7973-40-4', 18, 0, 0, 'Komunikasi_Lintas_Budaya_Memahami_Teks_Komunikasi,_Media,_Agama,_dan_Kebudayaan_Indonesia.jpg'),
(23, 'Kolaborasi CodeIgniter dan Ajax dalam Perancangan CMS', 1, 'Anton Subagia', 'Elex Media Komputindo', 2018, '9786020459332', 19, 0, 0, 'Kolaborasi_CodeIgniter_dan_Ajax_dalam_Perancangan_CMS.jpg'),
(24, 'From Hobby to Money', 8, 'Deasylawati Prasetyaningtyas', 'Elex Media Komputindo', 2014, '9786020252834', 0, 0, 0, 'From_Hobby_to_Money.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `no_pinjam` varchar(12) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`no_pinjam`, `id_buku`, `denda`) VALUES
('11102024001', 16, 5000),
('11102024001', 19, 5000),
('11102024001', 20, 5000),
('11102024002', 16, 5000),
('11102024002', 19, 5000),
('11102024002', 21, 5000),
('11102024003', 21, 5000),
('22102024004', 16, 5000),
('30102024005', 16, 5000),
('30102024006', 16, 5000),
('30102024006', 21, 5000),
('30102024006', 19, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Komputer'),
(2, 'Bahasa'),
(3, 'Sains'),
(4, 'Hobby'),
(5, 'Komunikasi'),
(6, 'Hukum'),
(7, 'Agama'),
(8, 'Populer'),
(9, 'Komik'),
(12, 'Sci-Fi'),
(17, 'Horor');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `no_pinjam` varchar(12) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` enum('Pinjam','Kembali') NOT NULL,
  `total_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`no_pinjam`, `tgl_pinjam`, `id_booking`, `id_user`, `tgl_kembali`, `tgl_pengembalian`, `status`, `total_denda`) VALUES
('11102024001', '2024-10-11', '11102024001', 3, '2024-10-14', '2024-10-11', 'Kembali', 0),
('11102024002', '2024-10-11', '11102024001', 1, '2024-10-13', '2024-10-11', 'Kembali', 0),
('11102024003', '2024-10-11', '11102024001', 1, '2024-10-14', '2024-10-11', 'Kembali', 0),
('22102024004', '2024-10-22', '22102024001', 3, '2024-10-25', '2024-10-30', 'Kembali', 0),
('30102024005', '2024-10-30', '29102024001', 1, '2024-11-02', '2024-10-30', 'Kembali', 0),
('30102024006', '2024-10-30', '30102024001', 14, '2024-11-02', '2024-10-30', 'Kembali', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `id_user` varchar(12) NOT NULL,
  `email_user` varchar(128) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `penulis` varchar(128) NOT NULL,
  `penerbit` varchar(128) NOT NULL,
  `tahun_terbit` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `tgl_booking`, `id_user`, `email_user`, `id_buku`, `judul_buku`, `image`, `penulis`, `penerbit`, `tahun_terbit`) VALUES
(2, '2024-11-03 01:50:51', '14', 'furqon@gmail.com', 21, 'PHP Komplet', 'PHP_Komplet.jpg', 'Jubilee Enterprise', 'Elex Media Komputindo', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `email`, `image`, `password`, `role_id`, `is_active`, `tanggal_input`) VALUES
(1, 'Admin', '', 'admin@gmail.com', 'pro1717177968.jpg', '$2y$10$5ROA1t4kMw1BR5kIVDxcDu5FP.KOyeUq2MzYjOmTE76cG8kT/qA6q', 1, 1, 1716460816),
(3, 'Denny', '', 'denny@gmail.com', 'pro1717231116.jpg', '$2y$10$08RrguDMoFebdbF5Fu.i/.ReSo2kaijs5TFKGdLu86XSgHQEY.71i', 2, 1, 1717127742),
(14, 'Furqon', 'JL. Keadilan 43 Jakarta Timur DKJ Jakarta', 'furqon@gmail.com', 'default.jpg', '$2y$10$l4GjbfWEE3dVbP/0/GFrte8GDfB2UEqZmu6o6BViVrmAWZWtyFcya', 2, 1, 1730284248);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`no_pinjam`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
