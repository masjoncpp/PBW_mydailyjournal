-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2025 at 03:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `mydailyjournal`
--

-- --------------------------------------------------------
--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `tanggal` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `article`
--

INSERT INTO `article` (
    `id`,
    `judul`,
    `isi`,
    `gambar`,
    `tanggal`,
    `username`
  )
VALUES (
    1,
    'Perpustakaan Kampus',
    'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
    'perpus.webp',
    '2025-12-05',
    'admin'
  ),
  (
    2,
    'Mushola',
    'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
    'mushola.webp',
    '2025-12-05',
    'admin'
  ),
  (
    3,
    'Kelompok Belajar',
    'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
    'kelompok.jpg',
    '2025-12-05',
    'admin'
  ),
  (
    4,
    'Lab Komputer',
    'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
    'labkomp.jpg',
    '2025-12-05',
    'admin'
  ),
  (
    5,
    'Kelas',
    'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
    'kelas.jpg',
    '2025-12-05',
    'admin'
  ),
  (
    7,
    'Peresmian Mobil Esemka',
    'Walikota Solo Joko Widodo, meresmikan mobil esemka yang di produksi anak SMK Solo, Jawa Tengah',
    '20251211093904.jpg',
    '2025-12-11',
    'admin'
  ),
  (
    8,
    'BMW S1000RR',
    'SuperBike BMW S1000RR',
    '20251211094709.jpg',
    '2025-12-11',
    'admin'
  );
-- --------------------------------------------------------
--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `foto`)
VALUES (
    1,
    'admin',
    'e10adc3949ba59abbe56e057f20f883e',
    ''
  );
--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
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
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;
-- --------------------------------------------------------
--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `gambar` text,
  `tanggal` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (
    `judul`,
    `deskripsi`,
    `gambar`,
    `tanggal`,
    `username`
  )
VALUES (
    'Fakultas Ilmu Komputer',
    'Gedung Fakultas Ilmu Komputer Universitas Dian Nuswantoro',
    'sti.png',
    '2026-01-14',
    'admin'
  ),
  (
    'Kampus Udinus',
    'Kampus Universitas Dian Nuswantoro Semarang',
    'dinus.webp',
    '2026-01-14',
    'admin'
  ),
  (
    'Pratikum Komputer',
    'Kegiatan praktikum di Laboratorium Komputer',
    'labkomp.jpg',
    '2026-01-14',
    'admin'
  ),
  (
    'Suasana Kelas',
    'Kegiatan belajar mengajar di ruang kelas',
    'kelas.jpg',
    '2026-01-14',
    'admin'
  ),
  (
    'Kelompok Belajar',
    'Kegiatan belajar kelompok mahasiswa',
    'kelompok.jpg',
    '2026-01-14',
    'admin'
  ),
  (
    'Mushola Kampus',
    'Mushola untuk beribadah di lingkungan kampus',
    'mushola.webp',
    '2026-01-14',
    'admin'
  );
--
-- Additional user data
--

INSERT INTO `user` (`user`, `password`, `foto`)
VALUES ('danny', '21232f297a57a5a743894a0e4a801fc3', ''),
  ('budi', '21232f297a57a5a743894a0e4a801fc3', ''),
  ('dewi', '21232f297a57a5a743894a0e4a801fc3', ''),
  ('eko', '21232f297a57a5a743894a0e4a801fc3', ''),
  ('fitri', '21232f297a57a5a743894a0e4a801fc3', '');
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;