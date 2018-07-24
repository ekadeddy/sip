-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2018 at 06:04 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa_sip.pcr.local`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `ADMIN_ID` varchar(10) NOT NULL,
  `ADMIN_NAMA` varchar(50) NOT NULL,
  `ALAMAT` varchar(200) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `GENERASI` varchar(4) NOT NULL,
  `ADMIN_IMAGE_PATH` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`ADMIN_ID`, `ADMIN_NAMA`, `ALAMAT`, `STATUS`, `EMAIL`, `GENERASI`, `ADMIN_IMAGE_PATH`) VALUES
('1', 'Admin James Bond', 'Adn', 'Hamba ', 'admin', '2012', 'assets/images/users/admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `DOSEN_ID` varchar(10) NOT NULL,
  `PROGRAM_STUDI_ID` varchar(5) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `DOSEN_NAMA` varchar(50) NOT NULL,
  `ALAMAT` varchar(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `DOSEN_IMAGE_PATH` varchar(100) NOT NULL,
  `GENERASI` int(4) NOT NULL,
  `DOSEN_INISIAL` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`DOSEN_ID`, `PROGRAM_STUDI_ID`, `EMAIL`, `DOSEN_NAMA`, `ALAMAT`, `STATUS`, `DOSEN_IMAGE_PATH`, `GENERASI`, `DOSEN_INISIAL`) VALUES
('DSN0000001', 'PS001', 'dosen@pcr.ac.id', 'Adam', 'jl kebon jeruk', 'Y', 'assets/images/users/dosen_icon.png', 2012, 'ADM'),
('DSN0000002', 'PS002', 'badu@pcr.ac.id', 'Badu', 'JL AMAL', 'Y', 'assets/images/users/dosen.png', 2013, 'AML');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `JADWAL_ID` varchar(10) NOT NULL,
  `MATA_KULIAH_ID` varchar(10) NOT NULL,
  `DOSEN_ID` varchar(10) NOT NULL,
  `KELAS_ID` varchar(6) NOT NULL,
  `RUANGAN_ID` varchar(5) NOT NULL,
  `JAM_KULIAH_ID` varchar(2) NOT NULL,
  `HARI` varchar(10) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `TANGGAL_GANTI` date NOT NULL,
  `DTMUPD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`JADWAL_ID`, `MATA_KULIAH_ID`, `DOSEN_ID`, `KELAS_ID`, `RUANGAN_ID`, `JAM_KULIAH_ID`, `HARI`, `STATUS`, `TANGGAL_GANTI`, `DTMUPD`) VALUES
('J000000001', 'MK00000002', 'DSN0000001', '3TKA', '120', '1', 'SELASA', 'AKTIF', '0000-00-00', '2018-07-15 15:16:46'),
('J000000002', 'MK00000002', 'DSN0000001', '3TKB', '284', '5', 'SENIN', 'AKTIF', '0000-00-00', '0000-00-00 00:00:00'),
('J000000004', 'MK00000001', 'DSN0000001', '3TKA', '281', '8', 'RABU', 'AKTIF', '0000-00-00', '0000-00-00 00:00:00'),
('J000000005', 'MK00000002', 'DSN0000001', '3TKA', '151', '7', 'KAMIS', 'AKTIF', '0000-00-00', '0000-00-00 00:00:00'),
('J000000006', 'MK00000002', 'DSN0000001', '4TIB', '151', '9', 'SENIN', 'AKTIF', '0000-00-00', '2018-07-15 15:00:54'),
('J000000011', 'MK00000003', 'DSN0000001', '3TKA', '120', '1', 'JUMAT', 'AKTIF', '0000-00-00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_ganti`
--

CREATE TABLE `tb_jadwal_ganti` (
  `JADWAL_GANTI_ID` varchar(10) NOT NULL,
  `JADWAL_ID` varchar(10) NOT NULL,
  `TANGGAL` date NOT NULL,
  `PERTEMUAN_KE` varchar(3) NOT NULL,
  `RUANGAN_ID` varchar(5) NOT NULL,
  `JAM_KULIAH_ID` varchar(2) NOT NULL,
  `HARI` varchar(10) NOT NULL,
  `STATUS` varchar(3) NOT NULL,
  `REQUEST_TO` varchar(50) NOT NULL,
  `APPROVAL_BY` varchar(50) NOT NULL,
  `REJECT_BY` varchar(50) NOT NULL,
  `KET` text NOT NULL,
  `DTMUPD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_ganti`
--

INSERT INTO `tb_jadwal_ganti` (`JADWAL_GANTI_ID`, `JADWAL_ID`, `TANGGAL`, `PERTEMUAN_KE`, `RUANGAN_ID`, `JAM_KULIAH_ID`, `HARI`, `STATUS`, `REQUEST_TO`, `APPROVAL_BY`, `REJECT_BY`, `KET`, `DTMUPD`) VALUES
('JDG0000001', 'J000000002', '2018-07-31', '2', '151', '3', 'SELASA', 'APV', 'admin', 'admin', '-', '', '2018-07-22 05:05:54'),
('JDG0000002', 'J000000006', '2018-07-31', '2', '136', '3', 'SELASA', 'APV', 'admin', 'admin', '-', 'asdasd', '2018-07-22 01:53:01'),
('JDG0000003', 'J000000006', '2018-07-31', '2', '152', '3', 'SELASA', 'RJC', 'admin', '-', 'admin', 'asdas', '2018-07-22 02:04:10'),
('JDG0000004', 'J000000004', '2018-07-31', '2', '137', '2', 'SELASA', 'APV', 'admin', 'admin', '-', '', '2018-07-23 00:16:54'),
('JDG0000005', 'J000000001', '2018-07-31', '2', '137', '2', 'SELASA', 'RJC', 'admin', '-', 'admin', '', '2018-07-23 00:29:05'),
('JDG0000006', 'J000000006', '2018-08-01', '2', '125', '6', 'RABU', 'RJC', 'admin', '-', 'admin', 'KEMANA', '2018-07-23 00:31:03'),
('JDG0000007', 'J000000011', '2018-08-02', '2', '138', '1', 'KAMIS', 'REQ', 'admin', '-', '-', 'wtrsgfddsfd', '2018-07-23 02:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_ganti_history`
--

CREATE TABLE `tb_jadwal_ganti_history` (
  `JADWAL_GANTI_HISTORY_ID` varchar(10) NOT NULL,
  `JADWAL_GANTI_ID` varchar(10) NOT NULL,
  `JADWAL_ID` varchar(10) NOT NULL,
  `RUANGAN_ID` varchar(5) NOT NULL,
  `JAM_KULIAH_ID` varchar(2) NOT NULL,
  `TANGGAL` date NOT NULL,
  `PERTEMUAN_KE` int(3) NOT NULL,
  `HARI` varchar(10) NOT NULL,
  `STATUS` varchar(3) NOT NULL,
  `APPROVAL_BY` varchar(50) NOT NULL,
  `REJECT_BY` varchar(50) NOT NULL,
  `KET` text NOT NULL,
  `DTMUPD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_ganti_history`
--

INSERT INTO `tb_jadwal_ganti_history` (`JADWAL_GANTI_HISTORY_ID`, `JADWAL_GANTI_ID`, `JADWAL_ID`, `RUANGAN_ID`, `JAM_KULIAH_ID`, `TANGGAL`, `PERTEMUAN_KE`, `HARI`, `STATUS`, `APPROVAL_BY`, `REJECT_BY`, `KET`, `DTMUPD`) VALUES
('JGH0000001', 'JDG0000001', 'J000000002', '151', '3', '2018-07-31', 2, 'SELASA', 'REQ', '-', '-', 'asda', '2018-07-22 01:52:31'),
('JGH0000002', 'JDG0000002', 'J000000006', '136', '3', '2018-07-31', 2, 'SELASA', 'REQ', '-', '-', 'asdasd', '2018-07-22 01:53:01'),
('JGH0000003', 'JDG0000003', 'J000000006', '152', '3', '2018-07-31', 2, 'SELASA', 'RJC', '-', 'admin', 'asdas', '2018-07-22 02:04:10'),
('JGH0000004', 'JDG0000004', 'J000000004', '137', '2', '2018-07-31', 2, 'SELASA', 'REQ', '-', '-', 'asdas', '2018-07-22 13:14:34'),
('JGH0000005', 'JDG0000005', 'J000000001', '137', '2', '2018-07-31', 2, 'SELASA', 'REQ', '-', '-', 'asdas', '2018-07-22 23:00:45'),
('JGH0000006', 'JDG0000006', 'J000000006', '125', '6', '2018-08-01', 2, 'RABU', 'REQ', '-', '-', 'SADAS SADIS', '2018-07-23 00:24:05'),
('JGH0000007', 'JDG0000005', 'J000000001', '137', '2', '2018-07-31', 0, 'SELASA', 'RJC', '-', 'admin', '', '2018-07-23 00:29:05'),
('JGH0000008', 'JDG0000006', 'J000000006', '125', '6', '2018-08-01', 0, 'RABU', 'RJC', '-', 'admin', 'KEMANA', '2018-07-23 00:31:03'),
('JGH0000009', 'JDG0000007', 'J000000011', '138', '1', '2018-08-02', 2, 'KAMIS', 'REQ', '-', '-', 'wtrsgfddsfd', '2018-07-23 02:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_notif`
--

CREATE TABLE `tb_jadwal_notif` (
  `JADWAL_NOTIF_ID` varchar(10) NOT NULL,
  `JADWAL_GANTI_ID` varchar(10) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `READ_STATUS` varchar(1) NOT NULL,
  `NOTIF_TIPE` varchar(3) NOT NULL,
  `DTMUPD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_notif`
--

INSERT INTO `tb_jadwal_notif` (`JADWAL_NOTIF_ID`, `JADWAL_GANTI_ID`, `EMAIL`, `READ_STATUS`, `NOTIF_TIPE`, `DTMUPD`) VALUES
('N000000001', 'JDG0000001', 'admin', '1', 'ADM', '2018-07-23 02:47:02'),
('N000000002', 'JDG0000002', 'admin', '1', 'ADM', '2018-07-23 02:47:13'),
('N000000003', 'JDG0000002', 'dosen@pcr.ac.id', '1', 'DSN', '2018-07-23 02:56:17'),
('N000000004', 'JDG0000004', 'admin', '1', 'ADM', '2018-07-24 10:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jam_kuliah`
--

CREATE TABLE `tb_jam_kuliah` (
  `JAM_KULIAH_ID` int(2) NOT NULL,
  `JAM_KULIAH_MULAI` time NOT NULL,
  `JAM` varchar(2) NOT NULL,
  `KET` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jam_kuliah`
--

INSERT INTO `tb_jam_kuliah` (`JAM_KULIAH_ID`, `JAM_KULIAH_MULAI`, `JAM`, `KET`) VALUES
(1, '07:00:00', '07', '7 - 8'),
(2, '08:00:00', '08', '8 - 9'),
(3, '09:00:00', '9', '9 - 10'),
(4, '10:00:00', '10', '10 - 11'),
(5, '11:00:00', '11', '11 -12'),
(6, '12:00:00', '12', '12 - 13'),
(7, '13:00:00', '13', '13:-00-14:00'),
(8, '14:00:00', '14', '14:00-15:00'),
(9, '15:00:00', '15', '15:00-16:00'),
(10, '16:00:00', '16', '16:00-17:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `KELAS_ID` varchar(6) NOT NULL,
  `PROGRAM_STUDI_ID` varchar(5) NOT NULL,
  `KELAS_NAMA` varchar(50) NOT NULL,
  `SEMESTER` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`KELAS_ID`, `PROGRAM_STUDI_ID`, `KELAS_NAMA`, `SEMESTER`) VALUES
('1TKA', 'PS001', '1 TK A', '1'),
('3TKA', 'PS001', '3 TK A', '6'),
('3TKB', 'PS001', '3 TK B', '6'),
('4TIB', 'PS002', '4 TI B', '8');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `MAHASISWA_ID` int(10) NOT NULL,
  `KELAS_ID` varchar(6) NOT NULL,
  `MAHASISWA_NAMA` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ALAMAT` varchar(200) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `MAHASISWA_IMAGE_PATH` varchar(100) NOT NULL,
  `GENERASI` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`MAHASISWA_ID`, `KELAS_ID`, `MAHASISWA_NAMA`, `EMAIL`, `ALAMAT`, `STATUS`, `MAHASISWA_IMAGE_PATH`, `GENERASI`) VALUES
(1255301019, '3TKA', 'Eka Deddy Saputra', 'mahasiswa', 'jl kepompong', 'Y', 'assets\\images\\users\\eka_deddy.jpg', 2012),
(1556401049, '3TKB', 'Shelin', 'shelin', 'jl hungaria', 'N', 'assets\\images\\users\\shelin.jpg', 2015),
(1556401050, '3TKA', 'Ajo', 'ajo', 'jl hungaria', 'N', 'assets\\images\\users\\dosen_icon.png', 2015),
(1556401051, '4TIB', 'Arif', 'arif', 'jl hungaria', 'N', 'assets\\images\\users\\dosen_icon.png', 2015);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mata_kuliah`
--

CREATE TABLE `tb_mata_kuliah` (
  `MATA_KULIAH_ID` varchar(10) NOT NULL,
  `MATA_KULIAH_NAMA` varchar(50) NOT NULL,
  `SKS` int(2) NOT NULL,
  `JAM` int(2) NOT NULL,
  `STATUS` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mata_kuliah`
--

INSERT INTO `tb_mata_kuliah` (`MATA_KULIAH_ID`, `MATA_KULIAH_NAMA`, `SKS`, `JAM`, `STATUS`) VALUES
('MK00000001', 'Management Proyek', 2, 2, 'TEORI'),
('MK00000002', 'Teknologi WAN', 2, 4, 'PRAKTIKUM'),
('MK00000003', 'Teknologi WAN', 2, 2, 'TEORI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi_baca`
--

CREATE TABLE `tb_notifikasi_baca` (
  `BACA_ID` varchar(10) NOT NULL,
  `NOTIFIKASI_ID` varchar(10) NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi_ubah`
--

CREATE TABLE `tb_notifikasi_ubah` (
  `NOTIFIKASI_ID` varchar(10) NOT NULL,
  `JADWAL_ID` varchar(10) NOT NULL,
  `NOTIFIKASI_ISI` varchar(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_studi`
--

CREATE TABLE `tb_program_studi` (
  `PROGRAM_STUDI_ID` varchar(5) NOT NULL,
  `PROGRAM_STUDI_NAMA` varchar(50) NOT NULL,
  `JURUSAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_program_studi`
--

INSERT INTO `tb_program_studi` (`PROGRAM_STUDI_ID`, `PROGRAM_STUDI_NAMA`, `JURUSAN`) VALUES
('PS001', 'TEKNIK KOMPUTER', 'KOMPUTER'),
('PS002', 'TEKNIK INFORMATIKA', 'KOMPUTER');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `RUANGAN_ID` varchar(5) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `KETERANGAN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`RUANGAN_ID`, `STATUS`, `KETERANGAN`) VALUES
('118', 'RKELAS', 'Ruang Kelas'),
('119', 'RKELAS', 'Ruang Kelas'),
('120', 'RKELAS', 'Ruang Kelas'),
('124', 'RKELAS', 'Ruang Kelas'),
('125', 'RKELAS', 'Ruang Kelas'),
('126', 'RKELAS', 'Ruang Kelas'),
('127', 'RKELAS', 'Ruang Kelas'),
('128', 'RKELAS', 'Ruang Kelas'),
('129', 'RKELAS', 'Ruang Kelas'),
('130', 'RKELAS', 'Ruang Kelas'),
('133', 'RKELAS', 'Ruang Kelas'),
('134', 'RKELAS', 'Ruang Kelas'),
('135', 'RLAB', 'Ruang Lab Teknik Tenaga Listrik'),
('136', 'RLAB', 'Ruang Lab Teknik Tenaga Listrik'),
('137', 'RLAB', 'Ruang Lab Teknik Tenaga Listrik'),
('138', 'RLAB', 'Ruang Lab Teknik Tenaga Listrik'),
('140', 'RKELAS', 'Ruang Kelas'),
('151', 'RKELAS', 'Ruang Kelas'),
('152', 'RKELAS', 'Ruang Kelas'),
('153', 'RKELAS', 'Ruang Kelas'),
('154', 'RKELAS', 'Ruang Kelas'),
('155', 'RKELAS', 'Ruang Kelas'),
('156', 'RKELAS', 'Ruang Kelas'),
('190', 'RKELAS', 'Ruang Kelas'),
('191', 'RLAB', 'Ruang Lab Pneumatik dan Hidrolik'),
('192', 'RLAB', 'Ruang Lab Sistem Manufaktur'),
('193', 'RLAB', 'Ruang Lab Kontrol Otomatis'),
('210', 'RKELAS', 'Ruang Kelas'),
('211', 'RKELAS', 'Ruang Kelas'),
('215', 'RKELAS', 'Ruang Kelas'),
('217', 'RLAB', 'Ruang Lab Mekatronika'),
('218', 'RLAB', 'Ruang Lab Mekatronika'),
('224', 'RLAB', 'Ruang Lab Elektronika Dasar'),
('225', 'RLAB', 'Ruang Lab Digital dan Mikroprosessor'),
('226', 'RLAB', 'Ruang Lab Digital dan Mikroprosessor'),
('229', 'RLAB', 'Ruang Lab Rangkaian dan Pengukuran Listrik'),
('230', 'RLAB', 'Ruang Lab Rangkaian dan Pengukuran Listrik'),
('233', 'RLAB', 'Ruang Lab Elektronika Telekomunikasi'),
('234', 'RLAB', 'Ruang Lab Elektronika Telekomunikasi'),
('235', 'RLAB', 'Ruang Lab Elektronika Telekomunikasi'),
('236', 'RLAB', 'Ruang Lab Elektronika Telekomunikasi'),
('251', 'RLAB', 'Ruang Lab Akuntansi'),
('252', 'RKELAS', 'Ruang Kelas'),
('253', 'RKELAS', 'Ruang Kelas'),
('254', 'RKELAS', 'Ruang Kelas'),
('255', 'RLAB', 'Ruang Lab Akuntansi'),
('256', 'RKELAS', 'Ruang Kelas'),
('280', 'RLAB', 'Ruang Lab Mekatronika'),
('281', 'RLAB', 'Ruang Lab Jaringan'),
('282', 'RLAB', 'Ruang Lab Akuntansi'),
('283', 'RLAB', 'Ruang Lab Jaringan'),
('284', 'RLAB', 'Ruang Lab Komputer'),
('303', 'RKELAS', 'Ruang Kelas'),
('304', 'RKELAS', 'Ruang Kelas'),
('305', 'RKELAS', 'Ruang Kelas'),
('313', 'RLAB', 'Ruang Lab Komputer'),
('316', 'RLAB', 'Ruang Lab Komputer'),
('317', 'RLAB', 'Ruang Lab Komputer'),
('319', 'RLAB', 'Ruang Lab Komputer'),
('320', 'RLAB', 'Ruang Lab Komputer'),
('324', 'RLAB', 'Ruang Lab Komputer'),
('325', 'RLAB', 'Ruang Lab Komputer'),
('329', 'RLAB', 'Ruang Lab Komputer'),
('330', 'RLAB', 'Ruang Lab Komputer'),
('WS', 'RLAB', 'Ruang Lab Gambar Teknik'),
('WS1', 'RLAB', 'Ruang Lab Mechanical Workshop'),
('WS2', 'RLAB', 'Ruang Lab CNC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `USER_ID` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(50) NOT NULL,
  `USER_AKSES` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`USER_ID`, `USER_PASSWORD`, `USER_AKSES`) VALUES
('admin', 'dc647eb65e6711e155375218212b3964', 'adm'),
('ajo', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'mhs'),
('badu@pcr.ac.id', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'dsn'),
('dosen@pcr.ac.id', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'dsn'),
('mahasiswa', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'mhs'),
('shelin', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'mhs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`DOSEN_ID`),
  ADD UNIQUE KEY `DOSEN_ID` (`DOSEN_ID`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`JADWAL_ID`);

--
-- Indexes for table `tb_jadwal_ganti`
--
ALTER TABLE `tb_jadwal_ganti`
  ADD PRIMARY KEY (`JADWAL_GANTI_ID`);

--
-- Indexes for table `tb_jadwal_ganti_history`
--
ALTER TABLE `tb_jadwal_ganti_history`
  ADD PRIMARY KEY (`JADWAL_GANTI_HISTORY_ID`);

--
-- Indexes for table `tb_jadwal_notif`
--
ALTER TABLE `tb_jadwal_notif`
  ADD PRIMARY KEY (`JADWAL_NOTIF_ID`);

--
-- Indexes for table `tb_jam_kuliah`
--
ALTER TABLE `tb_jam_kuliah`
  ADD PRIMARY KEY (`JAM_KULIAH_ID`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`KELAS_ID`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`MAHASISWA_ID`);

--
-- Indexes for table `tb_mata_kuliah`
--
ALTER TABLE `tb_mata_kuliah`
  ADD PRIMARY KEY (`MATA_KULIAH_ID`);

--
-- Indexes for table `tb_notifikasi_baca`
--
ALTER TABLE `tb_notifikasi_baca`
  ADD PRIMARY KEY (`BACA_ID`);

--
-- Indexes for table `tb_notifikasi_ubah`
--
ALTER TABLE `tb_notifikasi_ubah`
  ADD PRIMARY KEY (`NOTIFIKASI_ID`);

--
-- Indexes for table `tb_program_studi`
--
ALTER TABLE `tb_program_studi`
  ADD PRIMARY KEY (`PROGRAM_STUDI_ID`);

--
-- Indexes for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`RUANGAN_ID`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
