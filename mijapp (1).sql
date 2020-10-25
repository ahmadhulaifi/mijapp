-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 04:33 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mijapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_pegawai`
--

CREATE TABLE `absen_pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `cuti` int(11) NOT NULL,
  `lain` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_update` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `divisi`, `sort`) VALUES
(1, 'Umum', 1),
(2, 'RA', 3),
(3, 'KB', 2),
(5, 'MI', 4),
(6, 'MTs', 5),
(7, 'MA', 6);

-- --------------------------------------------------------

--
-- Table structure for table `galeri_siswa`
--

CREATE TABLE `galeri_siswa` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_divisi` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri_siswa`
--

INSERT INTO `galeri_siswa` (`id`, `foto`, `id_divisi`) VALUES
(1, 'siswa1.jpg', 5),
(2, 'siswa2.png', 5),
(3, 'siswa3.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan_kode` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan_kode`, `jabatan`) VALUES
(1, 'STAFF', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nip` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role_kode` varchar(11) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `nama_panggilan` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `gelar` varchar(20) NOT NULL,
  `jalan_no` varchar(255) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `rw` varchar(10) NOT NULL,
  `desa_kel` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kd_pos` varchar(10) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `jalan_no_domisili` varchar(255) NOT NULL,
  `rt_domisili` varchar(10) NOT NULL,
  `rw_domisili` varchar(10) NOT NULL,
  `desa_kel_domisili` varchar(100) NOT NULL,
  `kecamatan_domisili` varchar(100) NOT NULL,
  `kd_pos_domisili` varchar(10) NOT NULL,
  `kota_domisili` varchar(100) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `no_npwp` varchar(20) NOT NULL,
  `no_bpjs_ketenagakerjaan` varchar(20) NOT NULL,
  `no_bpjs_kesehatan` varchar(20) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `no_rek` varchar(100) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `j_kel` varchar(255) NOT NULL,
  `tem_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_mulai_bekerja` date NOT NULL,
  `status_pegawai_kode` varchar(255) NOT NULL,
  `jabatan_kode` varchar(255) NOT NULL,
  `foto` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `username`, `password`, `role_kode`, `divisi`, `nama_panggilan`, `nama_lengkap`, `gelar`, `jalan_no`, `rt`, `rw`, `desa_kel`, `kecamatan`, `kd_pos`, `kota`, `jalan_no_domisili`, `rt_domisili`, `rw_domisili`, `desa_kel_domisili`, `kecamatan_domisili`, `kd_pos_domisili`, `kota_domisili`, `agama`, `status`, `no_ktp`, `no_kk`, `no_npwp`, `no_bpjs_ketenagakerjaan`, `no_bpjs_kesehatan`, `bank`, `no_rek`, `telepon`, `email`, `j_kel`, `tem_lahir`, `tgl_lahir`, `tgl_mulai_bekerja`, `status_pegawai_kode`, `jabatan_kode`, `foto`, `created_at`, `updated_at`, `last_user`) VALUES
(1, 54321, 'adminmij', '$2y$10$MDOTXFfFJGZGx61laENQWeWu8U.bWPFe0se.Npe.TKbsdvKMWsfsW', 'ADMIN', 'Umum', 'adminmij', 'Admin MIJ', 'S.Pd.I', 'nama jalan ', '01', '03', 'kembangan utara', 'kembangan', '11213', 'jakarta barat', '', '', '', '', '', '', '', 'islam', 'menikah', '', '', '2589', '', '', '', '', '', 'tes@gmail.com', 'laki-laki', 'Jakarta', '1991-08-01', '2014-05-20', 'PTT', 'STAFF', '1603373421_6405113475cce03d16b7.png', '0000-00-00 00:00:00', '2020-10-25 08:43:51', 'adminmij'),
(2, 85264, 'tumi', '$2y$10$hmxO4bMm5qW6N91Dtc0zsOUK0NDZl26uwv0pNTIMk9TfUnjq.YQ3i', 'TU', 'MI', 'TU update', 'TU MI update', 'MI', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '--- Agama ---', '', '', '', '', '', '', '', '', '', '', '--- Jenis Kelamin ---', 'Jakarta', '1988-06-22', '2000-02-14', 'PTT', 'STAFF', 'default.png', '0000-00-00 00:00:00', '2020-10-25 10:11:56', 'Admin MIJ'),
(3, 12345, 'pegawai', '$2y$10$wxL9wXG8ibCAtFi0r47GJ.r.gMDm95/d2Gx6bLa29w8I1HZ7kXlBa', 'KEPEGAWAIAN', 'Umum', 'pegawai', 'pegawai', '', 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'aaaa', '16161', 'aaaa', 'sass', '5', '6', 'adad', 'bbbbb', '15615616', 'bbbbbb', 'islam', 'Menikah', '1234511111', '5432', '123456', '1548949', '15151', 'bank', '1231315615', '4894311111', 'kelompokb.raistiqlal@gmail.com', 'laki-laki', 'jakarta', '2015-05-04', '2020-09-01', 'PTT', 'STAFF', 'default.png', '2020-09-10 12:16:51', '2020-10-25 09:26:48', 'Admin MIJ'),
(18, 164831, 'admin', '$2y$10$2TJmKfke9cwpX2XxGfq6SOGk4zp.uajgtPwpKouaUqxRTexX0n0ya', 'ADMIN', 'Umum', 'admin', 'admin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'islam', '', '', '', '', '', '', '', '', '', '', 'laki-laki', 'jakarta', '2020-10-15', '2020-10-09', 'PTT', 'STAFF', 'default.png', '2020-10-25 10:26:44', '2020-10-25 10:33:22', 'Admin MIJ');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `id_divisi` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `id_divisi`) VALUES
(6, '9', 6),
(9, '5', 5),
(10, '4', 5),
(11, '3', 5),
(12, 'Alumni', 3),
(13, 'Alumni', 2),
(14, 'Alumni', 5),
(15, 'Alumni', 6),
(16, 'Alumni', 7);

-- --------------------------------------------------------

--
-- Table structure for table `rombel`
--

CREATE TABLE `rombel` (
  `id` int(11) NOT NULL,
  `rombel` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rombel`
--

INSERT INTO `rombel` (`id`, `rombel`, `id_kelas`) VALUES
(2, '4A', 10),
(4, '4B', 10),
(5, '9A', 6),
(6, '9B', 6),
(7, 'Alumni KB', 12),
(8, 'Alumni RA', 13),
(9, 'Alumni MI', 14),
(10, 'Alumni MTs', 15),
(11, 'Alumni MA', 16),
(12, '3A', 11),
(13, '3B', 11);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `panggilan` varchar(255) NOT NULL,
  `j_kel` varchar(255) NOT NULL,
  `tem_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `ayah` varchar(255) NOT NULL,
  `pekerjaan_ayah` varchar(255) NOT NULL,
  `pendapatan_ayah` varchar(255) NOT NULL,
  `ibu` varchar(255) NOT NULL,
  `pekerjaan_ibu` varchar(255) NOT NULL,
  `pendapatan_ibu` varchar(255) NOT NULL,
  `tahun_lulus` varchar(255) NOT NULL,
  `lanjut_sekolah` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `last_user_update` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_rombel` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `username`, `password`, `nik`, `nisn`, `nama_lengkap`, `panggilan`, `j_kel`, `tem_lahir`, `tgl_lahir`, `alamat`, `no_hp`, `ayah`, `pekerjaan_ayah`, `pendapatan_ayah`, `ibu`, `pekerjaan_ibu`, `pendapatan_ibu`, `tahun_lulus`, `lanjut_sekolah`, `foto`, `last_user_update`, `created_at`, `updated_at`, `id_rombel`, `id_divisi`) VALUES
(1, 'coba1', '$2y$10$XqPh.yPN/STi/Q14kIaIl.2L1Xx1Xw7lnQFY9plKi0bK9CCSr58gy', '11111', '', 'nama coba1', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'default.png', 'Ahmad Hulaifi', '2020-10-13 01:47:00', '2020-10-22 10:21:41', 12, 5),
(2, 'coba1', '$2y$10$XqPh.yPN/STi/Q14kIaIl.2L1Xx1Xw7lnQFY9plKi0bK9CCSr58gy', '2222', '', 'nama coba1', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2019', '', 'default.png', 'Ahmad Hulaifi', '2020-10-13 01:47:00', '2020-10-22 10:45:45', 9, 5),
(3, 'coba1', '$2y$10$XqPh.yPN/STi/Q14kIaIl.2L1Xx1Xw7lnQFY9plKi0bK9CCSr58gy', '33333', '', 'nama coba1', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2012', '', 'default.png', 'Ahmad Hulaifi', '2020-10-13 01:47:00', '2020-10-22 10:50:23', 0, 5),
(4, 'coba1', '$2y$10$XqPh.yPN/STi/Q14kIaIl.2L1Xx1Xw7lnQFY9plKi0bK9CCSr58gy', '44444', '', 'nama MTs', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'default.png', 'Ahmad Hulaifi', '2020-10-13 01:47:00', '2020-10-13 03:34:38', 5, 6),
(5, 'coba1', '$2y$10$XqPh.yPN/STi/Q14kIaIl.2L1Xx1Xw7lnQFY9plKi0bK9CCSr58gy', '5555', '', 'nama MTs', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'default.png', 'Ahmad Hulaifi', '2020-10-13 01:47:00', '2020-10-13 03:34:38', 10, 6),
(6, 'coba1', '$2y$10$XqPh.yPN/STi/Q14kIaIl.2L1Xx1Xw7lnQFY9plKi0bK9CCSr58gy', '66666', '', 'nama MTs', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'default.png', 'Ahmad Hulaifi', '2020-10-13 01:47:00', '2020-10-13 03:34:38', 0, 6),
(83, 'siswa1', '$2y$10$Skzy9hWOTQbMEQOJM9N8HOTjsfKMOMuifsFBaD2AT6bvKSKUm.3QW', '147', '147', 'siswa1', 'siswa1', 'laki-laki', 'Jakarta', '2003-02-03', 'alamat1', '123', 'ayah1', 'pekerjaan ayah1', '< 5 Juta', 'ibu1', 'pekerjaan ibu1', 'tidak ada', '2000', 'sekolah lanjut', 'misiswa1.jpg', 'Ahmad Hulaifi', '2020-10-19 10:16:52', '2020-10-22 10:54:25', 9, 5),
(84, 'siswa2', '$2y$10$ESQN5WZg5Dtdf/Q3OxzzHuSer0jPmhsKYXGPW7vWqyG.Lec3BLHm.', '258', '258', 'siswa2', 'siswa2', 'perempuan', 'Jakarta', '2005-10-26', 'alamat2', '456', 'ayah2', 'pekerjaan ayah2', '5-8 Juta', 'ibu2', 'pekerjaan ibu2', 'tidak ada', '2015', 'sekolah lanjut', 'misiswa2.png', 'Ahmad Hulaifi', '2020-10-19 10:16:52', '2020-10-22 01:26:08', 0, 5),
(85, 'siswa3', '$2y$10$NCyRScOZCdJdc5LT9yaOneHjGK9w4ofpxCrPDNbAp1BRN3L33jJPu', '369', '369', 'siswa3', 'siswa3', 'laki-laki', 'Jakarta', '2006-08-16', 'alamat3', '789', 'ayah3', 'pekerjaan ayah3', '8-15 Juta', 'ibu3', 'pekerjaan ibu3', 'tidak ada', '2015', 'sekolah lanjut', 'misiswa3.png', 'Ahmad Hulaifi', '2020-10-19 10:16:52', '2020-10-22 01:26:08', 0, 5),
(88, 'tesupdate', '$2y$10$EzcFMg3WbXz9opT2DFqS8uXixDpsoO6cqeXqSRQtPnpXWNv2LYMWq', '789654', '', 'tesupdate', '', '', '', '2020-10-01', '', '', '', '', '', '', '', '', '2020', '', 'MI48622020-10-011603340226.jpeg', 'Admin MIJ', '2020-10-21 23:12:13', '2020-10-25 09:24:46', 9, 5),
(89, 'alumnimts1', '$2y$10$9YvH3VW1Rlo0RkSVFBcSRuFFtttxz3OqTlVIWPCeOTPUbTyasmz2S', '8469782542254', '8754623963', 'alumni mts 1', 'alum mts', 'perempuan', 'Jakarta', '2020-10-15', 'alamat rumah', '0813464552462', 'nama ayah', 'pekerjaan ayah', '< 5 Juta', 'nama ibu', 'pekerjaan ibu', 'tidak ada', '2020', 'sekolah lanjut', 'MTs84697825422542020-10-151603518795.png', 'Ahmad Hulaifi', '2020-10-24 00:53:15', '2020-10-24 00:53:15', 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `id` int(11) NOT NULL,
  `status_pegawai_kode` varchar(255) NOT NULL,
  `status_pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`id`, `status_pegawai_kode`, `status_pegawai`) VALUES
(1, 'PTT', 'Pegawai Tidak Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`, `aktif`) VALUES
(1, '2020 - 2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_kode` varchar(255) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_kode`, `menu_id`) VALUES
(1, 'admin', 1),
(2, 'admin', 2),
(3, 'kepegawaian', 1),
(4, 'admin', 4),
(6, 'ADMIN', 6),
(7, 'ADMIN', 5),
(8, 'KEPEGAWAIAN', 5),
(9, 'KEPEGAWAIAN', 6),
(10, 'ADMIN', 7),
(11, 'UMUM', 1),
(12, 'UMUM', 5),
(13, 'ADMIN', 9),
(14, 'TU', 9),
(15, 'TU', 1),
(16, 'TU', 5),
(17, 'PIMPINAN', 1),
(18, 'PIMPINAN', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `controller`, `icon`, `url`, `sort`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt', 'dashboard', 1),
(2, 'Menu', 'menu', 'fas fa-fw fa-tasks', '#', 6),
(4, 'Role', 'role', 'fas fa-fw fa-id-card', '#', 5),
(5, 'Profil', 'profil', 'fas fa-fw fa-user-circle', '#', 7),
(6, 'Pegawai', 'pegawai', 'fas fa-fw fa-users', '#', 3),
(7, 'Data Sekolah', 'datasekolah', 'fas fa-fw fa-school', '#', 2),
(9, 'Tata Usaha', 'tatausaha', 'fas fa-fw fa-book-open', '#', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_kode` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_kode`, `role`, `sort`) VALUES
(1, 'ADMIN', 'Admin', 1),
(2, 'KEPEGAWAIAN', 'Kepegawaian', 3),
(3, 'KAMAD', 'Kepala Madrasah', 5),
(4, 'TU', 'Tata usaha', 6),
(5, 'GURU', 'Guru', 7),
(6, 'KEUANGAN', 'Keuangan', 4),
(7, 'PIMPINAN', 'Pimpinan', 2),
(8, 'UMUM', 'Umum', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `sub_menu`, `icon`, `url`, `sort`, `is_active`) VALUES
(1, 2, 'Menu Management', 'far fa-fw fa-folder', 'menu', 1, 1),
(2, 2, 'Submenu Management', 'fas fa-fw fa-folder-open', 'menu/submenu', 2, 1),
(13, 4, 'Role Akses', 'fas  fa-fw fa-users-cog', 'role', 1, 1),
(14, 5, 'Profile Saya', 'fas fa-fw fa-user-edit', 'profil', 1, 1),
(15, 7, 'Divisi', 'fas fa-fw fa-sitemap', 'datasekolah/divisi', 1, 0),
(16, 7, 'Jabatan', 'fas fa-fw fa-id-badge', 'datasekolah/jabatan', 2, 1),
(17, 7, 'Status Pegawai', 'fas fa-fw fa-address-card', 'datasekolah/statuspegawai', 3, 1),
(19, 6, 'Data Pegawai', 'fas fa-fw fa-user-friends', 'pegawai', 1, 1),
(20, 6, 'Divisi karyawan', 'far fa-fw fa-address-book', 'pegawai/divisi', 2, 1),
(21, 6, 'Absen', 'fas fa-fw fa-clipboard-list', 'pegawai/absen', 3, 1),
(22, 5, 'Absen Saya', 'far fa-fw fa-list-alt', 'profil/absen', 2, 1),
(23, 4, 'User Role', 'fas fa-fw fa-user-cog', 'role/userrole', 2, 1),
(24, 7, 'Tahun Ajaran', 'fas fa-fw fa-calendar-week', 'datasekolah/tahun', 4, 1),
(25, 9, 'Kelas', 'fas fa-fw fa-chalkboard-teacher', 'tatausaha/kelas', 1, 1),
(26, 9, 'Rombel', 'fas fa-fw fa-chalkboard', 'tatausaha/rombel', 2, 1),
(27, 9, 'Data Siswa', 'fas fa-fw fa-user-friends', 'tatausaha/datasiswa', 3, 1),
(28, 9, 'setting kelas', 'fas fa-fw fa-id-card-alt', 'tatausaha/datasettingkelas', 5, 1),
(29, 9, 'Galeri Siswa', 'far fa-fw fa-images', 'tatausaha/galerisiswa', 4, 1),
(30, 9, 'Data Alumni', 'fas fa-fw fa-user-graduate', 'tatausaha/dataalumni', 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_pegawai`
--
ALTER TABLE `absen_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri_siswa`
--
ALTER TABLE `galeri_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rombel`
--
ALTER TABLE `rombel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_pegawai`
--
ALTER TABLE `absen_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galeri_siswa`
--
ALTER TABLE `galeri_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
