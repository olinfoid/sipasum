-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2024 pada 16.48
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
-- Database: `db_sipasum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perumahan`
--

CREATE TABLE `tbl_perumahan` (
  `id` int(11) NOT NULL,
  `nm_perumahan` text NOT NULL,
  `id_pengembang` int(11) NOT NULL DEFAULT 1,
  `luas_lahan_perumahan` varchar(100) NOT NULL,
  `luas_lahan_efektif` varchar(100) NOT NULL,
  `luas_lahan_non_efektif` varchar(100) NOT NULL,
  `jml_unit` int(11) NOT NULL,
  `maps` text NOT NULL,
  `foto` text NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perumahan`
--

INSERT INTO `tbl_perumahan` (`id`, `nm_perumahan`, `id_pengembang`, `luas_lahan_perumahan`, `luas_lahan_efektif`, `luas_lahan_non_efektif`, `jml_unit`, `maps`, `foto`, `id_kecamatan`, `id_desa`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 'D\' SAFFA REGENCY', 2, '4516.00', '1675.00', '2841.00', 32, 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1978.536069454018!2d108.1223604!3d-7.3457964!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f543eb9f5d2b3%3A0x1d1b77a4c9966175!2sPerum%20Karisma%20Residence%20Singaparna!5e0!3m2!1sid!2sid!4v1723203645755!5m2!1sid!2sid', '1727694499.jpg', 24, 218, '2024-11-13 15:13:03', '2024-11-14 07:46:45'),
(2, 'KARISMA RESIDENCE', 3, '16183.00', '10029.00', '6154.00', 101, 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1890.9446288792303!2d108.1223604!3d7.3457964!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f543eb9f5d2b3%3A0x1d1b77a4c9966175!2sPerum%20Karisma%20Residence%20Singaparna!5e1!3m2!1sid!2sid!4v1723205251929!5m2!1sid!2sid', '1724950061.png', 24, 217, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(3, 'CINTRAJA PERMAI', 4, '23020.00', '15300.00', '7720.00', 275, 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15045.029927630803!2d108.1413789!3d7.3483985!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5700181c3ad5%3A0xab944fa0882b7542!2sPerumahan%20cintaraja%20permai!5e1!3m2!1sid!2sid!4v1723448948549!5m2!1sid!2sid', '1723449570.png', 24, 218, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(4, 'DEDES REGENCY', 5, '1472.00', '0.00', '0.00', 15, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.292010591157!2d108.14740417476118!3d-7.344318792664358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57869dc91947%3A0xeb141ebc7f4aa210!2sPerum%20Dedes%20Regency!5e1!3m2!1sid!2sid!4v1723450679210!5m2!1sid!2sid', '1723452716.png', 24, 219, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(5, 'Bumi Manonjaya', 6, '2160.00', '0.00', '0.00', 21, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.260964726388!2d108.29781647476132!3d7.347987092660797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f59408fbd3e71%3A0x571fe18fd3d0f694!2sPerumahan%20Bumi%20Manonjaya!5e1!3m2!1sid!2sid!4v1723452974572!5m2!1sid!2sid', '1723453375.png', 22, 202, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(6, 'AS-SALAM PERMAI', 7, '4017.00', '0.00', '0.00', 26, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.98168829821!2d108.16431507476042!3d-7.262353092744463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f515faf662ec5%3A0xf23d68a4080e3b5d!2sPerum%20Assalam%20Permai%20Cisayong!5e1!3m2!1sid!2sid!4v1723525423208!5m2!1sid!2sid', '1723529429.png', 32, 291, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(7, 'Baitul Marhamah', 8, '11200.00', '0.00', '0.00', 121, 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15045.666557427501!2d108.1549706!3d-7.3295746!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57db543e82b3%3A0x3a05b213f1b34f0a!2sPerum%20baitul%20marhamah%204%20cikunir!5e1!3m2!1sid!2sid!4v1723531345169!5m2!1sid!2sid', '1723531407.png', 13, 124, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(8, 'Bumi Sariwangi Indah', 9, '2079.00', '0.00', '0.00', 15, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60187.3283892233!2d108.01920359255631!3d-7.294986684315815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f533a7c6143c9%3A0x16c6babc41f2df7d!2sKec.%20Sariwangi%2C%20Kabupaten%20Tasikmalaya%2C%20Jawa%20Barat!5e1!3m2!1sid!2sid!4v1723534529731!5m2!1sid!2sid', '1723534748.png', 30, 265, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(9, 'Talun Green Residence', 10, '2611.00', '0.00', '0.00', 21, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1658.9766105402161!2d108.05089917500075!3d-7.37475769263461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f552dfc75dfdb%3A0x84e836ea13575bcc!2sPerum%20Talun%20Green%20Residence!5e1!3m2!1sid!2sid!4v1723535164120!5m2!1sid!2sid', '1723535206.jpg', 25, 226, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(10, 'Grand Residence Al-Ridwan', 11, '17655.00', '0.00', '0.00', 122, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1659.0244879527347!2d108.12814449999999!3d-7.361971100000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5432d84dc85f%3A0xbeff0de177a3b248!2sPerumahan%20Grand%20Residence%20Alridwan!5e1!3m2!1sid!2sid!4v1723535540895!5m2!1sid!2sid', '1723536093.png', 26, 231, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(11, 'Puri Ciawi Kencana Tahap 2', 12, '77206.00', '0.00', '0.00', 513, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1659.8518852258085!2d108.14592479999999!3d7.137400899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f495efa140885%3A0xdf0a87b6588b1161!2sPerum%20Puri%20Ciawi%20Kencana!5e1!3m2!1sid!2sid!4v1723536316646!5m2!1sid!2sid', '1723536804.png', 36, 323, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(12, 'Puri Sukamulya', 13, '14630.00', '0.00', '0.00', 118, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1659.8518852258085!2d108.14592479999999!3d7.137400899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f495efa140885%3A0xdf0a87b6588b1161!2sPerum%20Puri%20Ciawi%20Kencana!5e1!3m2!1sid!2sid!4v1723536316646!5m2!1sid!2sid', '1723873899.png', 27, 242, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(13, 'Bumi Heulang Mangkak', 14, '17755.00', '0.00', '0.00', 112, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.9845727092443!2d108.09113097500062!3d7.355624992653322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f553b2cff4e01%3A0x998d40fcdee9eddc!2sPerum%20Bumi%20Heulangmangkak!5e0!3m2!1sid!2sid!4v1723874028865!5m2!1sid!2sid', '1723874313.png', 24, 215, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(14, 'Griya Sawati Indah', 15, '17350.00', '0.00', '0.00', 141, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.741450231119!2d108.16232767499864!3d7.155862792848595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f4eb50c463d29%3A0x66e7b02b8495b632!2sPerum%20Griya%20Sawati%20Indah!5e0!3m2!1sid!2sid!4v1723874461745!5m2!1sid!2sid', '1723874658.png', 39, 344, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(15, 'Bumi Palasari 2', 16, '13100.00', '0.00', '0.00', 120, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.86012021769!2d108.1470422!3d7.1421693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f4959baa2fa2b%3A0xa171b3f52ff609e5!2sPerumahan%20Palasari%202!5e0!3m2!1sid!2sid!4v1723874802783!5m2!1sid!2sid', '1723875025.png', 36, 322, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(16, 'Griya Salawu', 17, '30030.00', '0.00', '0.00', 235, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1663.6147387029064!2d108.04727380246764!3d7.380216599267761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ab908463a94f%3A0x1c8efe55582da6a7!2sKantor%20Pemasaran%20Perumahan%20Griya%20Salawu!5e0!3m2!1sid!2sid!4v1723875173852!5m2!1sid!2sid', '1723875360.png', 14, 138, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(17, 'Mutiara Putra Ciawi', 18, '53039.00', '0.00', '0.00', 410, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.631884816499!2d108.15470497475957!3d-7.168482592836282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f4fbd9b16306f%3A0x7e00a730125364db!2sPerumahan%20Mutiara%20Putra%20Ciawi%20Regency!5e0!3m2!1sid!2sid!4v1723876576894!5m2!1sid!2sid', '1723876694.png', 36, 320, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(18, 'Graha Jatihurip', 19, '13283.00', '0.00', '0.00', 99, 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15831.033197865758!2d108.1868205!3d7.2683229!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f51ada724e28d%3A0x33aef4ea4f4c979a!2sPerum%20graha%20jati%20hurip!5e0!3m2!1sid!2sid!4v1723877105724!5m2!1sid!2sid', '1723877222.jpg', 32, 288, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(19, 'Graha Jatiwangi', 20, '19254.00', '0.00', '0.00', 152, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.846643804921!2d108.1834135103135!3d7.25828829271818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f518c81474991%3A0x75cabc19d356438b!2sPERUMAHAN%20GRAHA%20JATIWANGI!5e0!3m2!1sid!2sid!4v1723877579104!5m2!1sid!2sid', '1723877622.png', 32, 292, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(20, 'Cikunir Kencana Raya', 21, '69704.00', '0.00', '0.00', 491, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.0925566189126!2d108.15422284135296!3d7.343502797406739!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f569769a382d9%3A0x6afb6fc15437c5d4!2sPerum%20Cikunir%20Kencana%20Raya%20H%206!5e0!3m2!1sid!2sid!4v1723877932843!5m2!1sid!2sid', '1723878102.png', 24, 220, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(21, 'Pondok Mangunreja', 22, '19080.00', '0.00', '0.00', 29, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.8408567453216!2d108.0977180747615!3d-7.371727692637576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f55799e0b94a7%3A0xc202d1a489c25ab9!2sPerum%20Pondok%20Mangunreja!5e0!3m2!1sid!2sid!4v1723878459382!5m2!1sid!2sid', '1723878571.png', 25, 227, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(22, 'Dedes Regency Tahap 2', 23, '1151.00', '0.00', '0.00', 11, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.0852933342585!2d108.14740417476118!3d7.344318792664358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57869dc91947%3A0xeb141ebc7f4aa210!2sPerum%20Dedes%20Regency!5e0!3m2!1sid!2sid!4v1723878745552!5m2!1sid!2sid', '1723878907.png', 24, 219, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(23, 'Sukaratu Residence', 24, '3004.00', '0.00', '0.00', 29, 'https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1723879090022!5m2!1sid!2sid!6m8!1m7!1sRegaVrVtwoZprGRC4I6Xpw!2m2!1d7.318319217806735!2d108.1531740245483!3f11.466743504600023!4f-1.5060827019296994!5f0.40023029412639716', '1723879246.png', 31, 276, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(24, 'Karang Regency', 25, '4170.00', '0.00', '0.00', 36, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.495068738525!2d108.1188770916544!3d7.629785739864379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65e3bfe0991993%3A0x778f96c1110a5b1!2sPerumahan%20Karang%20Regency!5e0!3m2!1sid!2sid!4v1723879404124!5m2!1sid!2sid', '1723879528.png', 2, 19, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(25, 'Villa Pesona Indah', 26, '4807.00', '0.00', '0.00', 29, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d832.2412434642257!2d108.15050281313728!3d7.145782166087677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f4950fd915e6f%3A0xae4b875e75075c97!2sCluster%20Villa%20Pesona%20Indah%2C%20No.29!5e0!3m2!1sid!2sid!4v1723879778878!5m2!1sid!2sid', '1723879916.png', 36, 322, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(26, 'Arjamukti Kencana Raya', 27, '67989.00', '0.00', '0.00', 436, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.28923008264!2d108.09844957476102!3d7.321373092686788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5313a34e27fb%3A0x5aefa260588cdd4a!2sArjamukti%20Kencana%20Raya!5e0!3m2!1sid!2sid!4v1723880094462!5m2!1sid!2sid', '1723880210.png', 28, 257, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(27, 'Puri Barata Indah', 28, '2185.00', '0.00', '0.00', 21, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126603.7958782147!2d108.28354706380023!3d7.424394907433976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65f5b079f3281b%3A0x7849c04efce183f1!2sKec.%20Cineam%2C%20Kabupaten%20Tasikmalaya%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1723880480363!5m2!1sid!2sid', '1723880625.png', 20, 186, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(28, 'Cikadongdong Pratama', 29, '9800.00', '0.00', '0.00', 80, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.0442270985413!2d108.16209387476133!3d7.348930692659837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5692e3e30179%3A0x2f99a1b3dd8ced74!2sPerum%20Cikadongdong%20Pratama!5e0!3m2!1sid!2sid!4v1723880871904!5m2!1sid!2sid', '1723880906.png', 24, 220, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(29, 'Puri Duta', 30, '3650.00', '0.00', '0.00', 17, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.19779712213!2d108.1904668!3d7.2182653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f4fcb350421ef%3A0xa4df40f632b550d2!2sPERUM%20PURI%20DUTA%20INDAH%20LEGOK%20RINGGIT!5e0!3m2!1sid!2sid!4v1723881083730!5m2!1sid!2sid', '1723881169.png', 34, 303, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(30, 'Saga Regency', 31, '16083.00', '0.00', '0.00', 79, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.876767195942!2d108.14416397499862!3d7.140246292863919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f49607f96beef%3A0xbbac05a7568f50b6!2sDigital!5e0!3m2!1sid!2sid!4v1723881359620!5m2!1sid!2sid', '1723881549.png', 36, 323, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(31, 'Margamulya Indah Regency Tahap 1', 32, '19594.00', '0.00', '0.00', 186, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.15328875596!2d108.14413239678956!3d7.3366762999999935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f56a3dcfedb47%3A0xcae0078221005f8f!2sPerumahan%20Margamulya%20Indah%20Regency!5e0!3m2!1sid!2sid!4v1724047490630!5m2!1sid!2sid', '1724047664.png', 24, 219, '2024-11-13 15:13:03', '2024-11-13 15:13:03'),
(32, 'Bale Resik', 33, '15247.00', '0.00', '0.00', 127, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.193839921569!2d108.13350917476116!3d7.332114692676277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f541b6f98bc1b%3A0x7963ce538a247e90!2sPerumahan%20Bale%20Resik!5e0!3m2!1sid!2sid!4v1724052065920!5m2!1sid!2sid', '1724052364.png', 24, 218, '2024-11-13 15:13:03', '2024-11-18 04:39:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perumahan_prasarana`
--

CREATE TABLE `tbl_perumahan_prasarana` (
  `id` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `jaringan_jalan` varchar(100) DEFAULT NULL,
  `jaringan_drainase` varchar(100) DEFAULT NULL,
  `jaringan_sanitasi` varchar(100) DEFAULT NULL,
  `jaringan_persampahan` varchar(100) DEFAULT NULL,
  `prasarana_lainnya` varchar(200) DEFAULT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perumahan_prasarana`
--

INSERT INTO `tbl_perumahan_prasarana` (`id`, `id_perumahan`, `jaringan_jalan`, `jaringan_drainase`, `jaringan_sanitasi`, `jaringan_persampahan`, `prasarana_lainnya`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 1, '766.9', '115.94', '0', '0', '0', '2024-08-08 21:48:56', '2024-08-08 21:48:56'),
(2, 2, '4113.39', '1500.3', '0', '0', '0', '2024-08-08 22:14:59', '2024-08-08 22:14:59'),
(3, 3, '5744.64', '1285.2', '0', '0', '0', '2024-08-11 17:59:30', '2024-08-11 17:59:30'),
(5, 4, '251.5', '0', '0', '0', '0', '2024-08-11 18:51:56', '2024-11-13 15:14:42'),
(6, 5, '375', '0', '0', '0', '0', '2024-08-11 19:02:55', '2024-11-13 15:14:45'),
(7, 6, '1116.6', '0', '0', '0', '0', '2024-08-12 16:10:30', '2024-11-13 15:14:48'),
(8, 7, '2823', '0', '0', '0', '0', '2024-08-12 16:43:27', '2024-11-13 15:14:57'),
(9, 8, '290.00', '0', '0', '0', '0', '2024-08-12 17:39:08', '2024-11-13 15:14:59'),
(10, 9, '509.65', '0', '0', '0', '0', '2024-08-12 17:46:46', '2024-11-13 15:15:03'),
(11, 10, '4806', '0', '0', '0', '0', '2024-08-12 18:01:33', '2024-11-13 15:15:06'),
(12, 11, '29587', '0', '0', '0', '0', '2024-08-12 18:13:24', '2024-11-13 15:15:09'),
(13, 12, '4548', '0', '0', '0', '0', '2024-08-16 15:51:39', '2024-11-13 15:15:12'),
(14, 13, '5070.5', '0', '0', '0', '0', '2024-08-16 15:58:33', '2024-11-13 15:15:15'),
(15, 14, '5512.50', '0', '0', '0', '0', '2024-08-16 16:04:18', '2024-11-13 15:15:17'),
(16, 15, '3767.6', '0', '0', '0', '0', '2024-08-16 16:10:25', '2024-11-13 15:15:23'),
(17, 16, '6.212.759', '0', '0', '0', '0', '2024-08-16 16:16:00', '2024-11-13 15:15:30'),
(18, 17, '14617', '0', '0', '0', '0', '2024-08-16 16:38:14', '2024-11-13 15:15:35'),
(19, 18, '3980.7', '0', '0', '0', '0', '2024-08-16 16:47:02', '2024-11-13 15:15:40'),
(20, 19, '7056.46', '0', '0', '0', '0', '2024-08-16 16:53:42', '2024-11-13 15:15:43'),
(21, 20, '17507', '0', '0', '0', '0', '2024-08-16 17:01:42', '2024-11-13 15:15:46'),
(22, 21, '5454.29', '0', '0', '0', '0', '2024-08-16 17:09:31', '2024-11-13 15:15:49'),
(23, 22, '280', '0', '0', '0', '0', '2024-08-16 17:15:07', '2024-11-13 15:15:54'),
(24, 23, '738.47', '0', '0', '0', '0', '2024-08-16 17:20:46', '2024-11-13 15:16:00'),
(25, 24, '867.5', '0', '0', '0', '0', '2024-08-16 17:25:28', '2024-11-13 15:16:03'),
(26, 25, '795.5', '0', '0', '0', '0', '2024-08-16 17:31:56', '2024-11-13 15:16:05'),
(27, 26, '21260', '0', '0', '0', '0', '2024-08-16 17:36:50', '2024-11-13 15:16:24'),
(28, 27, '602', '0', '0', '0', '0', '2024-08-16 17:43:45', '2024-11-13 15:16:27'),
(29, 28, '2790', '0', '0', '0', '0', '2024-08-16 17:48:26', '2024-11-13 15:16:30'),
(30, 29, '976', '0', '0', '0', '0', '2024-08-16 17:52:50', '2024-11-13 15:16:34'),
(31, 30, '4383', '0', '0', '0', '0', '2024-08-16 17:59:09', '2024-11-13 15:16:37'),
(32, 31, '6230', '0', '0', '0', '0', '2024-08-18 16:07:44', '2024-11-13 15:16:39'),
(33, 32, '4605', '0', '0', '0', '0', '2024-08-18 17:26:04', '2024-11-13 15:16:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perumahan_sarana`
--

CREATE TABLE `tbl_perumahan_sarana` (
  `id` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `peribadahan` varchar(100) DEFAULT NULL,
  `rekreasi_dan_olahraga` varchar(100) DEFAULT NULL,
  `pertamanan_dan_rth` varchar(100) DEFAULT NULL,
  `perniagaan` varchar(100) DEFAULT NULL,
  `fasilitas_sosial` varchar(100) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `kesehatan` varchar(100) DEFAULT NULL,
  `pemakaman` varchar(100) DEFAULT NULL,
  `parkir` varchar(100) DEFAULT NULL,
  `pelayanan_umum_dan_pemerintahan` varchar(100) DEFAULT NULL,
  `sarana_lainnya` varchar(100) DEFAULT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perumahan_sarana`
--

INSERT INTO `tbl_perumahan_sarana` (`id`, `id_perumahan`, `peribadahan`, `rekreasi_dan_olahraga`, `pertamanan_dan_rth`, `perniagaan`, `fasilitas_sosial`, `pendidikan`, `kesehatan`, `pemakaman`, `parkir`, `pelayanan_umum_dan_pemerintahan`, `sarana_lainnya`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 1, '1', '0', '0', '0', '0', '1', '0', '143', '47.85', '1', 'Masjid', '2024-08-08 21:48:56', '2024-11-15 05:45:40'),
(2, 2, '1', '0', '0', '0', '0', '0', '0', '360', '546', '0', '5267', '2024-08-08 22:14:59', '2024-11-15 05:44:49'),
(3, 3, '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2024-08-11 17:59:30', '2024-11-15 05:44:53'),
(5, 4, '0', '0', '0', '0', '0', '0', '0', '29.44', '0', '0', '0', '2024-08-11 18:51:56', '2024-11-13 15:20:02'),
(6, 5, '0', '0', '0', '0', '0', '0', '0', '43.2', '0', '0', '0', '2024-08-11 19:02:55', '2024-11-13 15:20:06'),
(7, 6, '0', '0', '0', '0', '0', '0', '0', '80.34', '330.6', '0', '0', '2024-08-12 16:10:30', '2024-11-13 15:20:12'),
(8, 7, '0', '0', '0', '0', '0', '0', '0', '224', '0', '0', '0', '2024-08-12 16:43:27', '2024-11-13 15:20:18'),
(9, 8, '0', '0', '0', '0', '0', '0', '0', '41.58', '196.3', '0', '0', '2024-08-12 17:39:08', '2024-11-13 15:20:24'),
(10, 9, '0', '0', '0', '0', '0', '0', '0', '52.22', '0', '0', '0', '2024-08-12 17:46:46', '2024-11-13 15:20:28'),
(11, 10, '1', '0', '0', '0', '0', '0', '0', '353.10', '431.5', '0', '0', '2024-08-12 18:01:33', '2024-11-15 05:44:58'),
(12, 11, '1', '0', '0', '0', '0', '0', '0', '1544.12', '1316.3', '0', '0', '2024-08-12 18:13:24', '2024-11-15 05:45:01'),
(13, 12, '0', '0', '0', '0', '0', '0', '0', '292.6', '0', '0', '0', '2024-08-16 15:51:39', '2024-11-13 15:20:41'),
(14, 13, '1', '0', '0', '0', '0', '0', '0', '355.1', '186.5', '0', '0', '2024-08-16 15:58:33', '2024-11-15 05:45:05'),
(15, 14, '1', '0', '0', '0', '0', '0', '0', '347', '0', '0', '0', '2024-08-16 16:04:18', '2024-11-15 05:45:08'),
(16, 15, '0', '0', '0', '0', '0', '0', '0', '262', '102.25', '0', '0', '2024-08-16 16:10:25', '2024-11-13 15:20:53'),
(17, 16, '1', '0', '0', '0', '0', '0', '0', '618.99', '0', '0', '0', '2024-08-16 16:16:00', '2024-11-15 05:45:13'),
(18, 17, '0', '0', '0', '0', '0', '0', '0', '1060.78', '188', '0', '0', '2024-08-16 16:38:14', '2024-11-13 15:21:01'),
(19, 18, '0', '0', '0', '0', '0', '0', '0', '265.66', '303.25', '0', '0', '2024-08-16 16:47:02', '2024-11-13 15:21:04'),
(20, 19, '0', '0', '0', '0', '0', '0', '0', '0', '385.08', '0', '0', '2024-08-16 16:53:42', '2024-11-13 15:21:08'),
(21, 20, '0', '0', '0', '0', '0', '0', '0', '1394.09', '3103', '0', '0', '2024-08-16 17:01:42', '2024-11-13 15:21:11'),
(22, 21, '0', '0', '0', '0', '0', '0', '0', '381.6', '0', '0', '0', '2024-08-16 17:09:31', '2024-11-13 15:21:16'),
(23, 22, '0', '0', '0', '0', '0', '0', '0', '23.02', '0', '0', '0', '2024-08-16 17:15:07', '2024-11-13 15:21:19'),
(24, 23, '0', '0', '0', '0', '0', '0', '0', '46.77', '0', '0', '0', '2024-08-16 17:20:46', '2024-11-13 15:21:22'),
(25, 24, '0', '0', '0', '0', '0', '0', '0', '83.4', '80', '0', '0', '2024-08-16 17:25:28', '2024-11-13 15:21:25'),
(26, 25, '0', '0', '0', '0', '0', '0', '0', '96.14', '0', '0', '0', '2024-08-16 17:31:56', '2024-11-13 15:21:29'),
(27, 26, '0', '0', '0', '0', '0', '0', '0', '1359.78', '0', '0', '0', '2024-08-16 17:36:50', '2024-11-13 15:21:33'),
(28, 27, '0', '0', '0', '0', '0', '0', '0', '43.7', '0', '0', '0', '2024-08-16 17:43:45', '2024-11-13 15:21:39'),
(29, 28, '0', '0', '0', '0', '0', '0', '0', '196', '0', '0', '0', '2024-08-16 17:48:26', '2024-11-13 15:21:42'),
(30, 29, '0', '0', '0', '0', '0', '0', '0', '73', '235', '0', '0', '2024-08-16 17:52:50', '2024-11-13 15:21:45'),
(31, 30, '0', '0', '0', '0', '0', '0', '0', '321.66', '0', '0', '0', '2024-08-16 17:59:09', '2024-11-13 15:21:48'),
(32, 31, '1', '0', '0', '0', '0', '0', '0', '392', '0', '0', '0', '2024-08-18 16:07:44', '2024-11-15 05:45:19'),
(33, 32, '0', '0', '0', '0', '0', '0', '0', '305', '0', '0', '0', '2024-08-18 17:26:04', '2024-11-13 15:22:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perumahan_utilitas`
--

CREATE TABLE `tbl_perumahan_utilitas` (
  `id` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `jaringan_penerangan` varchar(100) NOT NULL,
  `jaringan_air_bersih` enum('pdam','air_tanah') NOT NULL,
  `jaringan_listrik` enum('tersedia','tidak_tersedia') NOT NULL,
  `jaringan_telepon` enum('tersedia','tidak_tersedia') NOT NULL,
  `jaringan_pemadam_kebakaran` enum('tersedia','tidak_tersedia') NOT NULL,
  `gas` enum('tersedia','tidak_tersedia') NOT NULL,
  `transportasi` enum('tersedia','tidak_tersedia') NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perumahan_utilitas`
--

INSERT INTO `tbl_perumahan_utilitas` (`id`, `id_perumahan`, `jaringan_penerangan`, `jaringan_air_bersih`, `jaringan_listrik`, `jaringan_telepon`, `jaringan_pemadam_kebakaran`, `gas`, `transportasi`, `tgl_dibuat`, `tgl_ubah`) VALUES
(1, 1, '2', 'pdam', 'tidak_tersedia', 'tidak_tersedia', 'tidak_tersedia', 'tidak_tersedia', '', '2024-08-29 16:44:04', '2024-11-02 01:58:32'),
(2, 2, '2', 'pdam', 'tidak_tersedia', 'tidak_tersedia', 'tidak_tersedia', 'tidak_tersedia', '', '2024-08-29 16:47:42', '2024-11-02 01:58:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perusahaan_pengembang`
--

CREATE TABLE `tbl_perusahaan_pengembang` (
  `id` int(11) NOT NULL,
  `nm_perusahaan` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL,
  `no_tlp_perusahaan` varchar(16) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perusahaan_pengembang`
--

INSERT INTO `tbl_perusahaan_pengembang` (`id`, `nm_perusahaan`, `id_users`, `no_tlp_perusahaan`, `alamat_perusahaan`, `tgl_dibuat`, `tgl_diubah`) VALUES
(2, 'H. FARID HASIM', 2, '82000000001', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(3, 'PT. KHARISMA GRAHA PERSADA', 3, '82000000002', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(4, 'PT. WIDIA ASRI GUNA', 4, '82000000003', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(5, 'Ai Yuyun Yulia', 5, '82000000004', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(6, 'Edwin Thepradjaja', 6, '82000000005', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(7, 'ENCU', 7, '82000000006', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(8, 'H. Anang Suryana', 8, '82000000007', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(9, 'H. Euis Kaswati', 9, '82000000008', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(10, 'Pepi Sahal Mustafid', 10, '82000000009', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(11, 'PT. Asep Ridwan Achmad', 11, '82000000010', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(12, 'PT. Bina Samakhta', 12, '82000000011', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(13, 'PT. Bumi Citra Mandiri', 13, '82000000012', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(14, 'PT. Heulang Mangkak', 14, '82000000013', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(15, 'PT. Bumi Karya Asih', 15, '82000000014', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(16, 'PT. Bumi Palasari', 16, '82000000015', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(17, 'PT. Griya Menara Hijau', 17, '82000000016', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(18, 'PT. Graha Putra Nusantara', 18, '82000000017', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(19, 'PT. Hasan Dinar Graha', 19, '82000000018', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(20, 'PT. Hasan Dinar Graha', 20, '82000000019', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(21, 'PT. Persada Bumi Kencana', 21, '82000000020', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(22, 'PT. Semesta Utama Raya Mandiri', 22, '82000000021', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(23, 'Ai Yuyun Yulia', 23, '82000000022', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(24, 'Dedi Maryadi Bachtiar', 24, '82000000023', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(25, 'Maman, S.ip', 25, '82000000024', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(26, 'PT. Bumi Karya Asih', 26, '82000000025', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(27, 'PT. Persada Bumi Kencana', 27, '82000000026', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(28, 'Teguh Esa Kertanegara', 28, '82000000027', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(29, 'Barokah Afdillah', 29, '82000000028', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(30, 'Doddy Wasnirlan', 30, '82000000029', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(31, 'H. Arip Syaripudin', 31, '82000000030', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(32, 'PT.  Griya Bintang Pesona', 32, '82000000031', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27'),
(33, 'PT. Bagja Tiasa Abadia', 33, '82000000032', 'Belum Diketahui', '2024-11-13 15:08:27', '2024-11-13 15:08:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_psu_dokumen`
--

CREATE TABLE `tbl_psu_dokumen` (
  `id` int(11) NOT NULL,
  `id_permohonan_psu` int(11) NOT NULL,
  `surat_permohonan` varchar(100) NOT NULL,
  `surat_rekom_izin` varchar(100) NOT NULL,
  `foto_siteplan` varchar(100) NOT NULL,
  `surat_pernyataan_pemakaman` varchar(100) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_psu_dokumen`
--

INSERT INTO `tbl_psu_dokumen` (`id`, `id_permohonan_psu`, `surat_permohonan`, `surat_rekom_izin`, `foto_siteplan`, `surat_pernyataan_pemakaman`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 1, 'doc-2-1-surat_permohonan.pdf', 'doc-2-1-surat_rekom_izin.pdf', 'doc-2-1-siteplan.jpg', 'doc-2-1-surat_pernyataan_pemakaman.pdf', '2024-11-22 09:46:24', '2024-11-22 09:46:24'),
(2, 2, 'doc-3-2-surat_permohonan.pdf', 'doc-3-2-surat_rekom_izin.pdf', 'doc-3-2-siteplan.jpg', 'doc-3-2-surat_pernyataan_pemakaman.pdf', '2024-11-22 09:47:06', '2024-11-22 09:47:06'),
(3, 3, 'doc-4-3-surat_permohonan.pdf', 'doc-4-3-surat_rekom_izin.pdf', 'doc-4-3-siteplan.jpg', 'doc-4-3-surat_pernyataan_pemakaman.pdf', '2024-11-22 09:47:46', '2024-11-22 09:47:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_psu_permohonan`
--

CREATE TABLE `tbl_psu_permohonan` (
  `id` int(11) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  `tgl_permohonan` datetime NOT NULL,
  `tgl_verifikasi` datetime DEFAULT NULL,
  `tgl_pengesahan` datetime DEFAULT NULL,
  `tgl_penerbitan` datetime DEFAULT NULL,
  `status_permohonan` enum('permohonan','verifikasi','pengesahan','penerbitan','serah_terima_psu') NOT NULL,
  `tgl_dbuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_dubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_psu_permohonan`
--

INSERT INTO `tbl_psu_permohonan` (`id`, `id_perumahan`, `tgl_permohonan`, `tgl_verifikasi`, `tgl_pengesahan`, `tgl_penerbitan`, `status_permohonan`, `tgl_dbuat`, `tgl_dubah`) VALUES
(1, 1, '2024-11-22 09:46:24', NULL, NULL, NULL, 'serah_terima_psu', '2024-11-22 09:46:24', '2024-11-22 09:47:58'),
(2, 2, '2024-11-22 09:47:06', NULL, NULL, NULL, 'serah_terima_psu', '2024-11-22 09:47:06', '2024-11-22 09:48:05'),
(3, 3, '2024-11-22 09:47:46', NULL, NULL, NULL, 'serah_terima_psu', '2024-11-22 09:47:46', '2024-11-22 09:48:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_reff_kode_desa`
--

CREATE TABLE `tbl_reff_kode_desa` (
  `id` int(11) NOT NULL,
  `nm_desa` varchar(30) NOT NULL,
  `kd_desa` varchar(12) NOT NULL,
  `id_kd_kecamatan` int(11) NOT NULL,
  `kd_kecamatan` varchar(10) NOT NULL,
  `no_desa` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_reff_kode_desa`
--

INSERT INTO `tbl_reff_kode_desa` (`id`, `nm_desa`, `kd_desa`, `id_kd_kecamatan`, `kd_kecamatan`, `no_desa`) VALUES
(1, 'CIHERAS', '3206012001', 1, '320601', '2001'),
(2, 'CIPATUJAH', '3206012002', 1, '320601', '2002'),
(3, 'SINDANGKERTA', '3206012003', 1, '320601', '2003'),
(4, 'CIKAWUNGADING', '3206012004', 1, '320601', '2004'),
(5, 'BANTARKALONG', '3206012005', 1, '320601', '2005'),
(6, 'DARAWATI', '3206012006', 1, '320601', '2006'),
(7, 'NAGROG', '3206012007', 1, '320601', '2007'),
(8, 'PAMEUTINGAN', '3206012008', 1, '320601', '2008'),
(9, 'TOBONGJAYA', '3206012009', 1, '320601', '2009'),
(10, 'CIPANAS', '3206012010', 1, '320601', '2010'),
(11, 'KERTASARI', '3206012011', 1, '320601', '2011'),
(12, 'CIANDUM', '3206012012', 1, '320601', '2012'),
(13, 'NANGELASARI', '3206012013', 1, '320601', '2013'),
(14, 'PADAWARAS', '3206012014', 1, '320601', '2014'),
(15, 'SUKAHURIP', '3206012015', 1, '320601', '2015'),
(16, 'CIDADAP', '3206022001', 2, '320602', '2001'),
(17, 'CIAWI', '3206022002', 2, '320602', '2002'),
(18, 'CIKUPA', '3206022003', 2, '320602', '2003'),
(19, 'KARANGNUNGGAL', '3206022004', 2, '320602', '2004'),
(20, 'KARANGMEKAR', '3206022005', 2, '320602', '2005'),
(21, 'CIKUKULU', '3206022006', 2, '320602', '2006'),
(22, 'CIBATUIRENG', '3206022007', 2, '320602', '2007'),
(23, 'CIBATU', '3206022008', 2, '320602', '2008'),
(24, 'SARIMANGGU', '3206022009', 2, '320602', '2009'),
(25, 'SUKAWANGUN', '3206022010', 2, '320602', '2010'),
(26, 'CINTAWANGI', '3206022011', 2, '320602', '2011'),
(27, 'CIKAPINIS', '3206022012', 2, '320602', '2012'),
(28, 'SARIMUKTI', '3206022013', 2, '320602', '2013'),
(29, 'KUJANG', '3206022014', 2, '320602', '2014'),
(30, 'CIKALONG', '3206032001', 3, '320603', '2001'),
(31, 'KALAPAGENEP', '3206032002', 3, '320603', '2002'),
(32, 'CIKANCRA', '3206032003', 3, '320603', '2003'),
(33, 'SINGKIR', '3206032004', 3, '320603', '2004'),
(34, 'PANYIARAN', '3206032005', 3, '320603', '2005'),
(35, 'CIBEBER', '3206032006', 3, '320603', '2006'),
(36, 'CIKADU', '3206032007', 3, '320603', '2007'),
(37, 'MANDALAJAYA', '3206032008', 3, '320603', '2008'),
(38, 'CIDADALI', '3206032009', 3, '320603', '2009'),
(39, 'CIMANUK', '3206032010', 3, '320603', '2010'),
(40, 'SINDANGJAYA', '3206032011', 3, '320603', '2011'),
(41, 'KUBANGSARI', '3206032012', 3, '320603', '2012'),
(42, 'TONJONGSARI', '3206032013', 3, '320603', '2013'),
(43, 'CIBUNIASIH', '3206042001', 4, '320604', '2001'),
(44, 'PANGLIARAN', '3206042002', 4, '320604', '2002'),
(45, 'TONJONG', '3206042003', 4, '320604', '2003'),
(46, 'CIBONGAS', '3206042004', 4, '320604', '2004'),
(47, 'TAWANG', '3206042005', 4, '320604', '2005'),
(48, 'NEGLASARI', '3206042006', 4, '320604', '2006'),
(49, 'CIKAWUNG', '3206042007', 4, '320604', '2007'),
(50, 'JAYAMUKTI', '3206042008', 4, '320604', '2008'),
(51, 'MARGALUYU', '3206042009', 4, '320604', '2009'),
(52, 'MEKARSARI', '3206042010', 4, '320604', '2010'),
(53, 'PANCAWANGI', '3206042011', 4, '320604', '2011'),
(54, 'GUNUNGSARI', '3206052001', 5, '320605', '2001'),
(55, 'CILUMBA', '3206052002', 5, '320605', '2002'),
(56, 'PAKEMITAN', '3206052003', 5, '320605', '2003'),
(57, 'COGREG', '3206052004', 5, '320605', '2004'),
(58, 'CAYUR', '3206052005', 5, '320605', '2005'),
(59, 'LENGKONGBARANG', '3206052006', 5, '320605', '2006'),
(60, 'SINDANGASIH', '3206052007', 5, '320605', '2007'),
(61, 'TANJUNGBARANG', '3206052008', 5, '320605', '2008'),
(62, 'LINGGALAKSANA', '3206052009', 5, '320605', '2009'),
(63, 'CISEMPUR', '3206062001', 6, '320606', '2001'),
(64, 'SETIAWARAS', '3206062002', 6, '320606', '2002'),
(65, 'EUREUNPALAY', '3206062003', 6, '320606', '2003'),
(66, 'CIBALONG', '3206062004', 6, '320606', '2004'),
(67, 'SINGAJAYA', '3206062005', 6, '320606', '2005'),
(68, 'PARUNG', '3206062006', 6, '320606', '2006'),
(69, 'PARUNGPONTENG', '3206072001', 7, '320607', '2001'),
(70, 'CIGUNUNG', '3206072002', 7, '320607', '2002'),
(71, 'CIBANTENG', '3206072003', 7, '320607', '2003'),
(72, 'BARUMEKAR', '3206072004', 7, '320607', '2004'),
(73, 'CIBUNGUR', '3206072005', 7, '320607', '2005'),
(74, 'BURUJULJAYA', '3206072006', 7, '320607', '2006'),
(75, 'GIRIKANCANA', '3206072007', 7, '320607', '2007'),
(76, 'KARYABAKTI', '3206072008', 7, '320607', '2008'),
(77, 'SIMPANG', '3206082001', 8, '320608', '2001'),
(78, 'PARAKANHONJE', '3206082002', 8, '320608', '2002'),
(79, 'PAMIJAHAN', '3206082003', 8, '320608', '2003'),
(80, 'SUKAMAJU', '3206082004', 8, '320608', '2004'),
(81, 'WANGUNSARI', '3206082005', 8, '320608', '2005'),
(82, 'HEGARWANGI', '3206082006', 8, '320608', '2006'),
(83, 'WAKAP', '3206082007', 8, '320608', '2007'),
(84, 'SIRNAGALIH', '3206082008', 8, '320608', '2008'),
(85, 'MERTAJAYA', '3206092001', 9, '320609', '2001'),
(86, 'CIKADONGDONG', '3206092002', 9, '320609', '2002'),
(87, 'BOJONGASIH', '3206092003', 9, '320609', '2003'),
(88, 'SINDANGSARI', '3206092004', 9, '320609', '2004'),
(89, 'GIRIJAYA', '3206092005', 9, '320609', '2005'),
(90, 'TOBLONGAN', '3206092006', 9, '320609', '2006'),
(91, 'CIKUYA', '3206102001', 10, '320610', '2001'),
(92, 'CINTABODAS', '3206102002', 10, '320610', '2002'),
(93, 'CIPICUNG', '3206102003', 10, '320610', '2003'),
(94, 'BOJONGSARI', '3206102004', 10, '320610', '2004'),
(95, 'MEKARLAKSANA', '3206102005', 10, '320610', '2005'),
(96, 'BOJONGKAPOL', '3206112001', 11, '320611', '2001'),
(97, 'PEDANGKAMULYAN', '3206112002', 11, '320611', '2002'),
(98, 'BOJONGGAMBIR', '3206112003', 11, '320611', '2003'),
(99, 'CIROYOM', '3206112004', 11, '320611', '2004'),
(100, 'WANDASARI', '3206112005', 11, '320611', '2005'),
(101, 'CAMPAKASARI', '3206112006', 11, '320611', '2006'),
(102, 'MANGKONJAYA', '3206112007', 11, '320611', '2007'),
(103, 'KERTANEGLA', '3206112008', 11, '320611', '2008'),
(104, 'PURWARAHARJA', '3206112009', 11, '320611', '2009'),
(105, 'GIRIMUKTI', '3206112010', 11, '320611', '2010'),
(106, 'PARUMASAN', '3206122001', 12, '320612', '2001'),
(107, 'CUKANGKAWUNG', '3206122002', 12, '320612', '2002'),
(108, 'SODONGHILIR', '3206122003', 12, '320612', '2003'),
(109, 'CIKALONG', '3206122004', 12, '320612', '2004'),
(110, 'CIPAINGEUN', '3206122005', 12, '320612', '2005'),
(111, 'LEUWIDULANG', '3206122006', 12, '320612', '2006'),
(112, 'MUNCANG', '3206122007', 12, '320612', '2007'),
(113, 'SEPATNUNGGAL', '3206122008', 12, '320612', '2008'),
(114, 'CUKANGJAYAGUNA', '3206122009', 12, '320612', '2009'),
(115, 'RAKSAJAYA', '3206122010', 12, '320612', '2010'),
(116, 'PAKALONGAN', '3206122011', 12, '320612', '2011'),
(117, 'SUKABAKTI', '3206122012', 12, '320612', '2012'),
(118, 'TARAJU', '3206132001', 13, '320613', '2001'),
(119, 'CIKUBANG', '3206132002', 13, '320613', '2002'),
(120, 'DEUDEUL', '3206132003', 13, '320613', '2003'),
(121, 'PURWARAHAYU', '3206132004', 13, '320613', '2004'),
(122, 'SINGASARI', '3206132005', 13, '320613', '2005'),
(123, 'BANYUASIH', '3206132006', 13, '320613', '2006'),
(124, 'RAKSASARI', '3206132007', 13, '320613', '2007'),
(125, 'KERTARAHARJA', '3206132008', 13, '320613', '2008'),
(126, 'PAGERALAM', '3206132009', 13, '320613', '2009'),
(127, 'JAHIANG', '3206142001', 14, '320614', '2001'),
(128, 'SERANG', '3206142002', 14, '320614', '2002'),
(129, 'SALAWU', '3206142003', 14, '320614', '2003'),
(130, 'NEGLASARI', '3206142004', 14, '320614', '2004'),
(131, 'TANJUNGSARI', '3206142005', 14, '320614', '2005'),
(132, 'TENJOWARINGIN', '3206142006', 14, '320614', '2006'),
(133, 'SUNDAWENANG', '3206142007', 14, '320614', '2007'),
(134, 'KAWUNGSARI', '3206142008', 14, '320614', '2008'),
(135, 'SUKARASA', '3206142009', 14, '320614', '2009'),
(136, 'KUTAWARINGIN', '3206142010', 14, '320614', '2010'),
(137, 'KARANGMUKTI', '3206142011', 14, '320614', '2011'),
(138, 'MARGALAKSANA', '3206142012', 14, '320614', '2012'),
(139, 'MANDALASARI', '3206152001', 15, '320615', '2001'),
(140, 'SUKASARI', '3206152002', 15, '320615', '2002'),
(141, 'PUSPASARI', '3206152003', 15, '320615', '2003'),
(142, 'PUSPAHIANG', '3206152004', 15, '320615', '2004'),
(143, 'LUYUBAKTI', '3206152005', 15, '320615', '2005'),
(144, 'PUSPARAHAYU', '3206152006', 15, '320615', '2006'),
(145, 'CIMANGGU', '3206152007', 15, '320615', '2007'),
(146, 'PUSPAJAYA', '3206152008', 15, '320615', '2008'),
(147, 'CIKEUSAL', '3206162001', 16, '320616', '2001'),
(148, 'CIBALANARIK', '3206162002', 16, '320616', '2002'),
(149, 'SUKANAGARA', '3206162003', 16, '320616', '2003'),
(150, 'TANJUNGJAYA', '3206162004', 16, '320616', '2004'),
(151, 'CILOLOHAN', '3206162005', 16, '320616', '2005'),
(152, 'CINTAJAYA', '3206162006', 16, '320616', '2006'),
(153, 'SUKASENANG', '3206162007', 16, '320616', '2007'),
(154, 'SUKAPURA', '3206172001', 17, '320617', '2001'),
(155, 'LEUWIBUDAH', '3206172002', 17, '320617', '2002'),
(156, 'SIRNAJAYA', '3206172003', 17, '320617', '2003'),
(157, 'MEKARJAYA', '3206172004', 17, '320617', '2004'),
(158, 'LINGGARAJA', '3206172005', 17, '320617', '2005'),
(159, 'JANGGALA', '3206172006', 17, '320617', '2006'),
(160, 'MARGALAKSANA', '3206172007', 17, '320617', '2007'),
(161, 'TARUNAJAYA', '3206172008', 17, '320617', '2008'),
(162, 'MANDALAHAYU', '3206182001', 18, '320618', '2001'),
(163, 'MULYASARI', '3206182002', 18, '320618', '2002'),
(164, 'KAWITAN', '3206182003', 18, '320618', '2003'),
(165, 'MANDALAWANGI', '3206182004', 18, '320618', '2004'),
(166, 'KARYAWANGI', '3206182005', 18, '320618', '2005'),
(167, 'TANJUNGSARI', '3206182006', 18, '320618', '2006'),
(168, 'MANDALAGUNA', '3206182007', 18, '320618', '2007'),
(169, 'KARYAMANDALA', '3206182008', 18, '320618', '2008'),
(170, 'BANJARWARINGIN', '3206182009', 18, '320618', '2009'),
(171, 'KAPUTIHAN', '3206192001', 19, '320619', '2001'),
(172, 'SETIAWANGI', '3206192002', 19, '320619', '2002'),
(173, 'SUKAKERTA', '3206192003', 19, '320619', '2003'),
(174, 'NEGLASARI', '3206192004', 19, '320619', '2004'),
(175, 'JATIWARAS', '3206192005', 19, '320619', '2005'),
(176, 'PAPAYAN', '3206192006', 19, '320619', '2006'),
(177, 'CIWARAK', '3206192007', 19, '320619', '2007'),
(178, 'KERSAGALIH', '3206192008', 19, '320619', '2008'),
(179, 'MANDALAMEKAR', '3206192009', 19, '320619', '2009'),
(180, 'KERTARAHAYU', '3206192010', 19, '320619', '2010'),
(181, 'MANDALAHURIP', '3206192011', 19, '320619', '2011'),
(182, 'CISARUA', '3206202001', 20, '320620', '2001'),
(183, 'CIKONDANG', '3206202002', 20, '320620', '2002'),
(184, 'CIJULANG', '3206202003', 20, '320620', '2003'),
(185, 'CIAMPANAN', '3206202004', 20, '320620', '2004'),
(186, 'CINEAM', '3206202005', 20, '320620', '2005'),
(187, 'RAJADATU', '3206202006', 20, '320620', '2006'),
(188, 'ANCOL', '3206202007', 20, '320620', '2007'),
(189, 'NAGARATENGAH', '3206202008', 20, '320620', '2008'),
(190, 'PASIRMUKTI', '3206202009', 20, '320620', '2009'),
(191, 'MADIASARI', '3206202010', 20, '320620', '2010'),
(192, 'SIRNAJAYA', '3206212001', 21, '320621', '2001'),
(193, 'KARANGJAYA', '3206212002', 21, '320621', '2002'),
(194, 'KARANGLAYUNG', '3206212003', 21, '320621', '2003'),
(195, 'CITALAHAB', '3206212004', 21, '320621', '2004'),
(196, 'CIHAUR', '3206222001', 22, '320622', '2001'),
(197, 'CILANGKAP', '3206222002', 22, '320622', '2002'),
(198, 'PASIRPANJANG', '3206222003', 22, '320622', '2003'),
(199, 'CIBEBER', '3206222004', 22, '320622', '2004'),
(200, 'KAMULYAN', '3206222005', 22, '320622', '2005'),
(201, 'MANONJAYA', '3206222006', 22, '320622', '2006'),
(202, 'MARGALUYU', '3206222007', 22, '320622', '2007'),
(203, 'PASIRBATANG', '3206222008', 22, '320622', '2008'),
(204, 'KALIMANGGIS', '3206222009', 22, '320622', '2009'),
(205, 'MARGAHAYU', '3206222010', 22, '320622', '2010'),
(206, 'BATUSUMUR', '3206222011', 22, '320622', '2011'),
(207, 'GUNAJAYA', '3206222012', 22, '320622', '2012'),
(208, 'CINUNJANG', '3206232001', 23, '320623', '2001'),
(209, 'GUNUNGTANJUNG', '3206232002', 23, '320623', '2002'),
(210, 'BOJONGSARI', '3206232003', 23, '320623', '2003'),
(211, 'JATIJAYA', '3206232004', 23, '320623', '2004'),
(212, 'TANJUNGSARI', '3206232005', 23, '320623', '2005'),
(213, 'GIRIWANGI', '3206232006', 23, '320623', '2006'),
(214, 'MALATISUKA', '3206232007', 23, '320623', '2007'),
(215, 'CIKUNTEN', '3206242001', 24, '320624', '2001'),
(216, 'SINGAPARNA', '3206242002', 24, '320624', '2002'),
(217, 'CIPAKAT', '3206242003', 24, '320624', '2003'),
(218, 'CINTARAJA', '3206242004', 24, '320624', '2004'),
(219, 'CIKUNIR', '3206242005', 24, '320624', '2005'),
(220, 'CIKADONGDONG', '3206242006', 24, '320624', '2006'),
(221, 'SUKAASIH', '3206242007', 24, '320624', '2007'),
(222, 'SUKAMULYA', '3206242008', 24, '320624', '2008'),
(223, 'SINGASARI', '3206242009', 24, '320624', '2009'),
(224, 'SUKAHERANG', '3206242010', 24, '320624', '2010'),
(225, 'SUKASUKUR', '3206252001', 25, '320625', '2001'),
(226, 'SALEBU', '3206252002', 25, '320625', '2002'),
(227, 'MANGUNREJA', '3206252003', 25, '320625', '2003'),
(228, 'MARGAJAYA', '3206252004', 25, '320625', '2004'),
(229, 'PASIRSALAM', '3206252005', 25, '320625', '2005'),
(230, 'SUKALUYU', '3206252006', 25, '320625', '2006'),
(231, 'SUKARAME', '3206262001', 26, '320626', '2001'),
(232, 'SUKAMENAK', '3206262002', 26, '320626', '2002'),
(233, 'SUKAKARSA', '3206262003', 26, '320626', '2003'),
(234, 'PADASUKA', '3206262004', 26, '320626', '2004'),
(235, 'SUKARAPIH', '3206262005', 26, '320626', '2005'),
(236, 'WARGAKERTA', '3206262006', 26, '320626', '2006'),
(237, 'KERSAMAJU', '3206272001', 27, '320627', '2001'),
(238, 'NANGTANG', '3206272002', 27, '320627', '2002'),
(239, 'PUSPARAJA', '3206272003', 27, '320627', '2003'),
(240, 'JAYAPURA', '3206272004', 27, '320627', '2004'),
(241, 'LENGKONGJAYA', '3206272005', 27, '320627', '2005'),
(242, 'NANGGERANG', '3206272006', 27, '320627', '2006'),
(243, 'SUKAMANAH', '3206272007', 27, '320627', '2007'),
(244, 'SIRNARAJA', '3206272008', 27, '320627', '2008'),
(245, 'CIDUGALEUN', '3206272009', 27, '320627', '2009'),
(246, 'PARENTAS', '3206272010', 27, '320627', '2010'),
(247, 'PUSPAMUKTI', '3206272011', 27, '320627', '2011'),
(248, 'TENJONAGARA', '3206272012', 27, '320627', '2012'),
(249, 'CIGALONTANG', '3206272013', 27, '320627', '2013'),
(250, 'SIRNAGALIH', '3206272014', 27, '320627', '2014'),
(251, 'TANJUNGKARANG', '3206272015', 27, '320627', '2015'),
(252, 'SIRNAPUTRA', '3206272016', 27, '320627', '2016'),
(253, 'ARJASARI', '3206282001', 28, '320628', '2001'),
(254, 'CIAWANG', '3206282002', 28, '320628', '2002'),
(255, 'CIGADOG', '3206282003', 28, '320628', '2003'),
(256, 'LINGGAWANGI', '3206282004', 28, '320628', '2004'),
(257, 'JAYAMUKTI', '3206282005', 28, '320628', '2005'),
(258, 'MANDALAGIRI', '3206282006', 28, '320628', '2006'),
(259, 'LINGGAMULYA', '3206282007', 28, '320628', '2007'),
(260, 'CILAMPUNGHILIR', '3206292001', 29, '320629', '2001'),
(261, 'RANCAPAKU', '3206292002', 29, '320629', '2002'),
(262, 'MEKARJAYA', '3206292003', 29, '320629', '2003'),
(263, 'CISARUNI', '3206292004', 29, '320629', '2004'),
(264, 'PADAKEMBANG', '3206292005', 29, '320629', '2005'),
(265, 'SARIWANGI', '3206302001', 30, '320630', '2001'),
(266, 'SUKAHARJA', '3206302002', 30, '320630', '2002'),
(267, 'JAYARATU', '3206302003', 30, '320630', '2003'),
(268, 'LINGGASIRNA', '3206302004', 30, '320630', '2004'),
(269, 'SIRNASARI', '3206302005', 30, '320630', '2005'),
(270, 'SUKAMULIH', '3206302006', 30, '320630', '2006'),
(271, 'SELAWANGI', '3206302007', 30, '320630', '2007'),
(272, 'JAYAPUTRA', '3206302008', 30, '320630', '2008'),
(273, 'LINGGAJATI', '3206312001', 31, '320631', '2001'),
(274, 'TAWANGBANTENG', '3206312002', 31, '320631', '2002'),
(275, 'SINAGAR', '3206312003', 31, '320631', '2003'),
(276, 'GUNUNGSARI', '3206312004', 31, '320631', '2004'),
(277, 'SUKAMAHI', '3206312005', 31, '320631', '2005'),
(278, 'SUKAGALIH', '3206312006', 31, '320631', '2006'),
(279, 'SUKARATU', '3206312007', 31, '320631', '2007'),
(280, 'INDRAJAYA', '3206312008', 31, '320631', '2008'),
(281, 'CISAYONG', '3206322001', 32, '320632', '2001'),
(282, 'SUKAJADI', '3206322002', 32, '320632', '2002'),
(283, 'SUKASUKUR', '3206322003', 32, '320632', '2003'),
(284, 'SUKAMUKTI', '3206322004', 32, '320632', '2004'),
(285, 'NUSAWANGI', '3206322005', 32, '320632', '2005'),
(286, 'CIKADU', '3206322006', 32, '320632', '2006'),
(287, 'CILEULEUS', '3206322007', 32, '320632', '2007'),
(288, 'JATIHURIP', '3206322008', 32, '320632', '2008'),
(289, 'SUKASETIA', '3206322009', 32, '320632', '2009'),
(290, 'PURWASARI', '3206322010', 32, '320632', '2010'),
(291, 'SUKARAHARJA', '3206322011', 32, '320632', '2011'),
(292, 'MEKARWANGI', '3206322012', 32, '320632', '2012'),
(293, 'SANTANAMEKAR', '3206322013', 32, '320632', '2013'),
(294, 'BANYURASA', '3206332001', 33, '320633', '2001'),
(295, 'CALINGCING', '3206332002', 33, '320633', '2002'),
(296, 'SUKAHENING', '3206332003', 33, '320633', '2003'),
(297, 'KIARAJANGKUNG', '3206332004', 33, '320633', '2004'),
(298, 'KUDADEPA', '3206332005', 33, '320633', '2005'),
(299, 'BANYURESMI', '3206332006', 33, '320633', '2006'),
(300, 'SUNDAKERTA', '3206332007', 33, '320633', '2007'),
(301, 'DAWAGUNG', '3206342001', 34, '320634', '2001'),
(302, 'RAJAPOLAH', '3206342002', 34, '320634', '2002'),
(303, 'MANGGUNGJAYA', '3206342003', 34, '320634', '2003'),
(304, 'MANGGUNGSARI', '3206342004', 34, '320634', '2004'),
(305, 'SUKARAJA', '3206342005', 34, '320634', '2005'),
(306, 'RAJAMANDALA', '3206342006', 34, '320634', '2006'),
(307, 'SUKANAGALIH', '3206342007', 34, '320634', '2007'),
(308, 'TANJUNGPURA', '3206342008', 34, '320634', '2008'),
(309, 'CONDONG', '3206352001', 35, '320635', '2001'),
(310, 'BOJONGGAOK', '3206352002', 35, '320635', '2002'),
(311, 'SINDANGRAJA', '3206352003', 35, '320635', '2003'),
(312, 'KARANGMULYA', '3206352004', 35, '320635', '2004'),
(313, 'GERESIK', '3206352005', 35, '320635', '2005'),
(314, 'KARANGSEMBUNG', '3206352006', 35, '320635', '2006'),
(315, 'TANJUNGMEKAR', '3206352007', 35, '320635', '2007'),
(316, 'KARANGRESIK', '3206352008', 35, '320635', '2008'),
(317, 'GOMBONG', '3206362001', 36, '320636', '2001'),
(318, 'BUGEL', '3206362002', 36, '320636', '2002'),
(319, 'MARGASARI', '3206362003', 36, '320636', '2003'),
(320, 'PAKEMITAN', '3206362004', 36, '320636', '2004'),
(321, 'CIAWI', '3206362005', 36, '320636', '2005'),
(322, 'SUKAMANTRI', '3206362006', 36, '320636', '2006'),
(323, 'PASIRHUNI', '3206362007', 36, '320636', '2007'),
(324, 'CITAMBA', '3206362008', 36, '320636', '2008'),
(325, 'KERTAMUKTI', '3206362009', 36, '320636', '2009'),
(326, 'KURNIABAKTI', '3206362010', 36, '320636', '2010'),
(327, 'PAKEMITANKIDUL', '3206362011', 36, '320636', '2011'),
(328, 'KADIPATEN', '3206372001', 37, '320637', '2001'),
(329, 'DIRGAHAYU', '3206372002', 37, '320637', '2002'),
(330, 'CIBAHAYU', '3206372003', 37, '320637', '2003'),
(331, 'MEKARSARI', '3206372004', 37, '320637', '2004'),
(332, 'BUNIASIH', '3206372005', 37, '320637', '2005'),
(333, 'PAMOYANAN', '3206372006', 37, '320637', '2006'),
(334, 'CIPACING', '3206382001', 38, '320638', '2001'),
(335, 'PAGERAGEUNG', '3206382002', 38, '320638', '2002'),
(336, 'SUKAMAJU', '3206382003', 38, '320638', '2003'),
(337, 'TANJUNGKERTA', '3206382004', 38, '320638', '2004'),
(338, 'PUTERAN', '3206382005', 38, '320638', '2005'),
(339, 'GURANTENG', '3206382006', 38, '320638', '2006'),
(340, 'NANGGEWER', '3206382007', 38, '320638', '2007'),
(341, 'SUKAPADA', '3206382008', 38, '320638', '2008'),
(342, 'PAGERSARI', '3206382009', 38, '320638', '2009'),
(343, 'SUKADANA', '3206382010', 38, '320638', '2010'),
(344, 'CIPONDOK', '3206392001', 39, '320639', '2001'),
(345, 'SUKAMENAK', '3206392002', 39, '320639', '2002'),
(346, 'SUKARATU', '3206392003', 39, '320639', '2003'),
(347, 'BANJARSARI', '3206392004', 39, '320639', '2004'),
(348, 'TANJUNGSARI', '3206392005', 39, '320639', '2005'),
(349, 'SUKAPANCAR', '3206392006', 39, '320639', '2006'),
(350, 'SUKARESIK', '3206392007', 39, '320639', '2007'),
(351, 'MARGAMULYA', '3206392008', 39, '320639', '2008');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_reff_kode_kecamatan`
--

CREATE TABLE `tbl_reff_kode_kecamatan` (
  `id` int(11) NOT NULL,
  `nm_kecamatan` varchar(30) NOT NULL,
  `kd_kecamatan` varchar(10) NOT NULL,
  `kd_kab_kota` varchar(6) NOT NULL DEFAULT '3206',
  `no_kecamatan` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_reff_kode_kecamatan`
--

INSERT INTO `tbl_reff_kode_kecamatan` (`id`, `nm_kecamatan`, `kd_kecamatan`, `kd_kab_kota`, `no_kecamatan`) VALUES
(1, 'CIPATUJAH', '320601', '3206', '01'),
(2, 'KARANGNUNGGAL', '320602', '3206', '02'),
(3, 'CIKALONG', '320603', '3206', '03'),
(4, 'PANCATENGAH', '320604', '3206', '04'),
(5, 'CIKATOMAS', '320605', '3206', '05'),
(6, 'CIBALONG', '320606', '3206', '06'),
(7, 'PARUNGPONTENG', '320607', '3206', '07'),
(8, 'BANTARKALONG', '320608', '3206', '08'),
(9, 'BOJONGASIH', '320609', '3206', '09'),
(10, 'CULAMEGA', '320610', '3206', '10'),
(11, 'BOJONGGAMBIR', '320611', '3206', '11'),
(12, 'SODONGHILIR', '320612', '3206', '12'),
(13, 'TARAJU', '320613', '3206', '13'),
(14, 'SALAWU', '320614', '3206', '14'),
(15, 'PUSPAHIANG', '320615', '3206', '15'),
(16, 'TANJUNGJAYA', '320616', '3206', '16'),
(17, 'SUKARAJA', '320617', '3206', '17'),
(18, 'SALOPA', '320618', '3206', '18'),
(19, 'JATIWARAS', '320619', '3206', '19'),
(20, 'CINEAM', '320620', '3206', '20'),
(21, 'KARANGJAYA', '320621', '3206', '21'),
(22, 'MANONJAYA', '320622', '3206', '22'),
(23, 'GUNUNGTANJUNG', '320623', '3206', '23'),
(24, 'SINGAPARNA', '320624', '3206', '24'),
(25, 'MANGUNREJA', '320625', '3206', '25'),
(26, 'SUKARAME', '320626', '3206', '26'),
(27, 'CIGALONTANG', '320627', '3206', '27'),
(28, 'LEUWISARI', '320628', '3206', '28'),
(29, 'PADAKEMBANG', '320629', '3206', '29'),
(30, 'SARIWANGI', '320630', '3206', '30'),
(31, 'SUKARATU', '320631', '3206', '31'),
(32, 'CISAYONG', '320632', '3206', '32'),
(33, 'SUKAHENING', '320633', '3206', '33'),
(34, 'RAJAPOLAH', '320634', '3206', '34'),
(35, 'JAMANIS', '320635', '3206', '35'),
(36, 'CIAWI', '320636', '3206', '36'),
(37, 'KADIPATEN', '320637', '3206', '37'),
(38, 'PAGERAGEUNG', '320638', '3206', '38'),
(39, 'SUKARESIK', '320639', '3206', '39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `jns_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `nm_user`, `no_tlp`, `alamat`, `jns_kelamin`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 'Ilman H Oriza', '082214716209', 'Ciamis', 'laki-laki', '2024-10-30 12:54:20', '2024-11-11 17:41:14'),
(2, 'Dev-A', '082000000001', 'Belum diketahui', 'laki-laki', '2024-11-07 01:59:51', '2024-11-11 17:33:41'),
(3, 'Dev-B', '082000000002', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(4, 'Dev-C', '082000000003', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(5, 'Dev-D', '082000000004', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(6, 'Dev-E', '082000000005', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(7, 'Dev-F', '082000000006', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(8, 'Dev-G', '082000000007', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(9, 'Dev-H', '082000000008', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(10, 'Dev-I', '082000000009', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(11, 'Dev-J', '082000000010', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(12, 'Dev-K', '082000000011', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(13, 'Dev-L', '082000000012', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(14, 'Dev-M', '082000000013', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(15, 'Dev-N', '082000000014', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(16, 'Dev-O', '082000000015', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(17, 'Dev-P', '082000000016', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(18, 'Dev-Q', '082000000017', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(19, 'Dev-R', '082000000018', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(20, 'Dev-S', '082000000019', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(21, 'Dev-T', '082000000020', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(22, 'Dev-U', '082000000021', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(23, 'Dev-V', '082000000022', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(24, 'Dev-W', '082000000023', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(25, 'Dev-X', '082000000024', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(26, 'Dev-Y', '082000000025', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(27, 'Dev-Z', '082000000026', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(28, 'Dev-AA', '082000000027', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(29, 'Dev-AB', '082000000028', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(30, 'Dev-AC', '082000000029', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(31, 'Dev-AD', '082000000030', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(32, 'Dev-AE', '082000000031', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(33, 'Dev-AF', '082000000032', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45'),
(34, 'Dev-AG', '082000000033', 'Belum diketahui', 'laki-laki', '2024-11-07 02:05:01', '2024-11-11 17:33:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users_auth`
--

CREATE TABLE `tbl_users_auth` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status_akun` enum('aktif','tidak_aktif','dihapus') NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users_auth`
--

INSERT INTO `tbl_users_auth` (`id`, `id_users`, `username`, `password`, `status_akun`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 1, 'superadmin', 'admin', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(2, 2, 'dev-a', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(3, 3, 'dev-b', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(4, 4, 'dev-c', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(5, 5, 'dev-d', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(6, 6, 'dev-e', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(7, 7, 'dev-f', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(8, 8, 'dev-g', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(9, 9, 'dev-h', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(10, 10, 'dev-i', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(11, 11, 'dev-j', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(12, 12, 'dev-k', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(13, 13, 'dev-l', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(14, 14, 'dev-m', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(15, 15, 'dev-n', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(16, 16, 'dev-o', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(17, 17, 'dev-p', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(18, 18, 'dev-q', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(19, 19, 'dev-r', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(20, 20, 'dev-s', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(21, 21, 'dev-t', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(22, 22, 'dev-u', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(23, 23, 'dev-v', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(24, 24, 'dev-w', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(25, 25, 'dev-x', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(26, 26, 'dev-y', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(27, 27, 'dev-z', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(28, 28, 'dev-aa', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(29, 29, 'dev-ab', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(30, 30, 'dev-ac', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(31, 31, 'dev-ad', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(32, 32, 'dev-ae', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(33, 33, 'dev-af', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29'),
(34, 34, 'dev-ag', 'dev-1234', 'aktif', '2024-11-13 15:31:29', '2024-11-13 15:31:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users_role`
--

CREATE TABLE `tbl_users_role` (
  `id` int(11) NOT NULL,
  `nm_role` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users_role`
--

INSERT INTO `tbl_users_role` (`id`, `nm_role`, `keterangan`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 'superadmin', 'Khusus Superadmin Semua Fitur full Akses', '2024-10-30 13:36:18', '2024-10-30 13:36:18'),
(2, 'developer', 'Khusus Role Developer Perumahan', '2024-10-30 13:38:13', '2024-10-30 13:38:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users_role_relasi`
--

CREATE TABLE `tbl_users_role_relasi` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users_role_relasi`
--

INSERT INTO `tbl_users_role_relasi` (`id`, `id_users`, `id_role`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 1, 1, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(2, 2, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(3, 3, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(4, 4, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(5, 5, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(6, 6, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(7, 7, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(8, 8, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(9, 9, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(10, 10, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(11, 11, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(12, 12, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(13, 13, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(14, 14, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(15, 15, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(16, 16, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(17, 17, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(18, 18, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(19, 19, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(20, 20, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(21, 21, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(22, 22, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(23, 23, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(24, 24, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(25, 25, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(26, 26, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(27, 27, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(28, 28, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(29, 29, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(30, 30, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(31, 31, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(32, 32, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(33, 33, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24'),
(34, 34, 2, '2024-11-13 15:34:24', '2024-11-13 15:34:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_perumahan`
--
ALTER TABLE `tbl_perumahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_pengembang` (`id_pengembang`);

--
-- Indeks untuk tabel `tbl_perumahan_prasarana`
--
ALTER TABLE `tbl_perumahan_prasarana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indeks untuk tabel `tbl_perumahan_sarana`
--
ALTER TABLE `tbl_perumahan_sarana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indeks untuk tabel `tbl_perumahan_utilitas`
--
ALTER TABLE `tbl_perumahan_utilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indeks untuk tabel `tbl_perusahaan_pengembang`
--
ALTER TABLE `tbl_perusahaan_pengembang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tbl_psu_dokumen`
--
ALTER TABLE `tbl_psu_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permohonan_psu` (`id_permohonan_psu`);

--
-- Indeks untuk tabel `tbl_psu_permohonan`
--
ALTER TABLE `tbl_psu_permohonan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perumahan` (`id_perumahan`);

--
-- Indeks untuk tabel `tbl_reff_kode_desa`
--
ALTER TABLE `tbl_reff_kode_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rell_kd_kecamatan` (`id_kd_kecamatan`) USING BTREE;

--
-- Indeks untuk tabel `tbl_reff_kode_kecamatan`
--
ALTER TABLE `tbl_reff_kode_kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_kecamatan` (`kd_kecamatan`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_users_auth`
--
ALTER TABLE `tbl_users_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tbl_users_role`
--
ALTER TABLE `tbl_users_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_users_role_relasi`
--
ALTER TABLE `tbl_users_role_relasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_perumahan`
--
ALTER TABLE `tbl_perumahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tbl_perumahan_prasarana`
--
ALTER TABLE `tbl_perumahan_prasarana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_perumahan_sarana`
--
ALTER TABLE `tbl_perumahan_sarana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_perumahan_utilitas`
--
ALTER TABLE `tbl_perumahan_utilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_perusahaan_pengembang`
--
ALTER TABLE `tbl_perusahaan_pengembang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_psu_dokumen`
--
ALTER TABLE `tbl_psu_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_psu_permohonan`
--
ALTER TABLE `tbl_psu_permohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_reff_kode_desa`
--
ALTER TABLE `tbl_reff_kode_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT untuk tabel `tbl_reff_kode_kecamatan`
--
ALTER TABLE `tbl_reff_kode_kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_users_auth`
--
ALTER TABLE `tbl_users_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_users_role`
--
ALTER TABLE `tbl_users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_users_role_relasi`
--
ALTER TABLE `tbl_users_role_relasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_perumahan`
--
ALTER TABLE `tbl_perumahan`
  ADD CONSTRAINT `tbl_perumahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `tbl_reff_kode_kecamatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_perumahan_ibfk_2` FOREIGN KEY (`id_desa`) REFERENCES `tbl_reff_kode_desa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_perumahan_ibfk_3` FOREIGN KEY (`id_pengembang`) REFERENCES `tbl_perusahaan_pengembang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_perumahan_prasarana`
--
ALTER TABLE `tbl_perumahan_prasarana`
  ADD CONSTRAINT `tbl_perumahan_prasarana_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `tbl_perumahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_perumahan_sarana`
--
ALTER TABLE `tbl_perumahan_sarana`
  ADD CONSTRAINT `tbl_perumahan_sarana_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `tbl_perumahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_perumahan_utilitas`
--
ALTER TABLE `tbl_perumahan_utilitas`
  ADD CONSTRAINT `tbl_perumahan_utilitas_ibfk_1` FOREIGN KEY (`id_perumahan`) REFERENCES `tbl_perumahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_perusahaan_pengembang`
--
ALTER TABLE `tbl_perusahaan_pengembang`
  ADD CONSTRAINT `tbl_perusahaan_pengembang_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_psu_dokumen`
--
ALTER TABLE `tbl_psu_dokumen`
  ADD CONSTRAINT `tbl_psu_dokumen_ibfk_1` FOREIGN KEY (`id_permohonan_psu`) REFERENCES `tbl_psu_permohonan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_psu_permohonan`
--
ALTER TABLE `tbl_psu_permohonan`
  ADD CONSTRAINT `tbl_psu_permohonan_ibfk_2` FOREIGN KEY (`id_perumahan`) REFERENCES `tbl_perumahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_reff_kode_desa`
--
ALTER TABLE `tbl_reff_kode_desa`
  ADD CONSTRAINT `tbl_reff_kode_desa_ibfk_1` FOREIGN KEY (`id_kd_kecamatan`) REFERENCES `tbl_reff_kode_kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_users_auth`
--
ALTER TABLE `tbl_users_auth`
  ADD CONSTRAINT `tbl_users_auth_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_users_role_relasi`
--
ALTER TABLE `tbl_users_role_relasi`
  ADD CONSTRAINT `tbl_users_role_relasi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_users_role_relasi_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `tbl_users_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
