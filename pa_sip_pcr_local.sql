-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 06:14 AM
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
('DSN0000002', 'PS002', 'dosen2@pcr.ac.id', 'Badu', 'JL AMAL', 'Y', 'assets/images/users/dosen.png', 2013, 'AML');

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
  `TANGGAL_GANTI` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`JADWAL_ID`, `MATA_KULIAH_ID`, `DOSEN_ID`, `KELAS_ID`, `RUANGAN_ID`, `JAM_KULIAH_ID`, `HARI`, `STATUS`, `TANGGAL_GANTI`) VALUES
('J000000001', 'MK00000001', 'DSN0000001', '3TKA', '281', '1', 'SELASA', 'AKTIF', '0000-00-00'),
('J000000002', 'MK00000002', 'DSN0000001', '3TKB', '284', '5', 'SENIN', 'AKTIF', '0000-00-00'),
('J000000003', 'MK00000003', 'DSN0000001', '3TKB', '151', '3', 'SELASA', 'AKTIF', '0000-00-00'),
('J000000004', 'MK00000001', 'DSN0000001', '3TKA', '281', '8', 'rabu', 'AKTIF', '0000-00-00'),
('J000000005', 'MK00000002', 'DSN0000001', '3TKA', '151', '7', 'kamis', 'AKTIF', '0000-00-00'),
('J000000006', 'MK00000002', 'DSN0000001', '4TIB', '151', '9', 'senin', 'AKTIF', '0000-00-00'),
('J000000010', 'MK00000002', 'DSN0000001', '3TKA', '119', '1', 'senin', 'AKTIF', '0000-00-00'),
('J000000011', 'MK00000001', 'DSN0000001', '3TKA', '119', '1', 'jumat', 'AKTIF', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_approval`
--

CREATE TABLE `tb_jadwal_approval` (
  `JADWAL_APPORVAL_ID` varchar(10) NOT NULL,
  `JADWAL_GANTI_ID` varchar(10) NOT NULL,
  `APPROVAL_STATUS` varchar(10) NOT NULL,
  `APPROVAL_BY` varchar(50) NOT NULL,
  `REJECT_BY` varchar(50) NOT NULL,
  `KET` text NOT NULL,
  `DTMUPD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_approval`
--

INSERT INTO `tb_jadwal_approval` (`JADWAL_APPORVAL_ID`, `JADWAL_GANTI_ID`, `APPROVAL_STATUS`, `APPROVAL_BY`, `REJECT_BY`, `KET`, `DTMUPD`) VALUES
('JA00000001', 'JG00000001', 'Y', 'admin', '-', '', '0000-00-00 00:00:00'),
('JA00000002', 'JG00000002', 'N', '-', 'admin', 'Ruangan tidak tersedia', '0000-00-00 00:00:00'),
('JA00000003', 'JG00000007', 'Y', 'admin', '-', '', '2018-07-08 11:30:03'),
('JA00000004', 'JG00000013', 'Y', 'admin', '-', '', '2018-07-08 11:30:11'),
('JA00000005', 'JG00000012', 'Y', 'admin', '-', '', '2018-07-08 11:30:40'),
('JA00000006', 'JG00000011', 'T', '-', 'admin', '', '2018-07-08 11:30:44'),
('JA00000007', 'JG00000010', 'T', '-', 'admin', '', '2018-07-08 11:33:33'),
('JA00000008', 'JG00000009', 'T', '-', 'admin', '', '2018-07-08 11:33:53'),
('JA00000009', 'JG00000008', 'T', '-', 'admin', '', '2018-07-08 11:34:14'),
('JA00000010', 'JG00000015', 'T', '-', 'admin', '', '2018-07-08 11:37:38'),
('JA00000011', 'JG00000014', 'T', '-', 'admin', '', '2018-07-08 11:37:56');

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
  `KET` text NOT NULL,
  `DTMUPD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_ganti`
--

INSERT INTO `tb_jadwal_ganti` (`JADWAL_GANTI_ID`, `JADWAL_ID`, `TANGGAL`, `PERTEMUAN_KE`, `RUANGAN_ID`, `JAM_KULIAH_ID`, `HARI`, `KET`, `DTMUPD`) VALUES
('JG00000001', 'J000000002', '2018-07-20', '2', 'R119', '1', 'JUMAT', 'Dosen cuti', '0000-00-00 00:00:00'),
('JG00000002', 'J000000003', '2018-07-16', '2', 'R119', '2', 'SENIN', 'Dosen cuti', '0000-00-00 00:00:00'),
('JG00000003', 'J000000002', '0000-00-00', '2', '151', '3', 'rabu', 'dfgdgf', '2018-07-07 10:59:39'),
('JG00000004', 'J000000010', '0000-00-00', '2', '120', '4', 'rabu', 'wewer', '2018-07-07 16:02:38'),
('JG00000005', 'J000000006', '0000-00-00', '2', '120', '3', 'kamis', 'wetert', '2018-07-07 16:05:42'),
('JG00000006', 'J000000003', '1970-01-01', '2', '120', '3', 'rabu', 'lkk', '2018-07-07 16:07:48'),
('JG00000007', 'J000000006', '2018-07-18', '2', '120', '3', 'rabu', 'ppp', '2018-07-07 16:10:40'),
('JG00000008', 'J000000002', '2018-07-18', '2', '120', '3', 'rabu', 'asdasd', '2018-07-07 16:23:41'),
('JG00000009', 'J000000006', '2018-07-11', '2', '120', '2', 'rabu', 'qweqw', '2018-07-07 16:26:06'),
('JG00000010', 'J000000001', '2018-07-11', '2', '120', '9', 'rabu', 'asda', '2018-07-07 21:19:46'),
('JG00000011', 'J000000001', '2018-07-26', '2', '151', '8', 'kamis', 'asdasd', '2018-07-07 21:20:02'),
('JG00000012', 'J000000005', '2018-07-18', '2', '281', '5', 'rabu', 'asdasd', '2018-07-07 21:20:15'),
('JG00000013', 'J000000002', '2018-07-19', '2', '151', '6', 'kamis', 'asd', '2018-07-07 21:20:27'),
('JG00000014', 'J000000006', '2018-07-18', '2', '151', '2', 'rabu', 'sdsd', '2018-07-08 16:34:41'),
('JG00000015', 'J000000006', '2018-07-19', '2', '120', '3', 'kamis', 'asdas', '2018-07-08 16:34:59'),
('JG00000016', 'J000000001', '2018-07-25', '2', '151', '3', 'rabu', 'asds', '2018-07-13 00:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jam_kuliah`
--

CREATE TABLE `tb_jam_kuliah` (
  `JAM_KULIAH_ID` int(2) NOT NULL,
  `JAM_KULIAH_MULAI` time NOT NULL,
  `JAM` int(2) NOT NULL,
  `KET` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jam_kuliah`
--

INSERT INTO `tb_jam_kuliah` (`JAM_KULIAH_ID`, `JAM_KULIAH_MULAI`, `JAM`, `KET`) VALUES
(1, '07:00:00', 7, '7 - 8'),
(2, '08:00:00', 8, '8 - 9'),
(3, '09:00:00', 9, '9 - 10'),
(4, '10:00:00', 10, '10 - 11'),
(5, '11:00:00', 11, '11 -12'),
(6, '12:00:00', 12, '12 - 13'),
(7, '13:00:00', 13, '13:-00-14:00'),
(8, '14:00:00', 14, '14:00-15:00'),
(9, '15:00:00', 15, '15:00-16:00'),
(10, '16:00:00', 16, '16:00-17:00');

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
(1556401050, '3TKB', 'Ajo', 'ajo', 'jl hungaria', 'N', 'assets\\images\\users\\dosen_icon.png', 2015),
(1556401051, '3TKB', 'Arif', 'arif', 'jl hungaria', 'N', 'assets\\images\\users\\dosen_icon.png', 2015);

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
('119', 'RKELAS', 'Ruang Kelas'),
('120', 'RKELAS', 'Ruang Kelas'),
('151', 'RKELAS', 'Ruang Kelas'),
('281', 'RLAB', 'Lab Jaringan'),
('284', 'RKELAS', 'Ruang Kelas');

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
-- Indexes for table `tb_jadwal_approval`
--
ALTER TABLE `tb_jadwal_approval`
  ADD PRIMARY KEY (`JADWAL_APPORVAL_ID`);

--
-- Indexes for table `tb_jadwal_ganti`
--
ALTER TABLE `tb_jadwal_ganti`
  ADD PRIMARY KEY (`JADWAL_GANTI_ID`);

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
