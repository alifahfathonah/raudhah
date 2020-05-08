-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2020 at 03:14 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `raudhah`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `category`, `created_at`, `updated_at`) VALUES
(7, 'Gedung A', 2, '2020-04-21 01:03:34', '2020-04-21 01:03:34'),
(8, 'Gedung B', 2, '2020-04-21 01:07:20', '2020-04-21 01:07:20'),
(9, 'Gedung C', 2, '2020-04-21 01:18:44', '2020-04-21 01:18:44'),
(13, 'Gedung X', 1, '2020-04-21 01:40:30', '2020-04-21 01:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `vnow` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `building_id`, `name`, `capacity`, `vnow`, `created_at`, `updated_at`) VALUES
(4, 13, 'Kelas 1', 40, 1, '2020-04-21 01:40:45', '2020-05-03 12:50:03'),
(5, 13, 'Kelas 2', 40, 0, '2020-04-21 01:40:54', '2020-05-03 10:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `examcards`
--

CREATE TABLE `examcards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registrant_id` bigint(20) NOT NULL,
  `index` bigint(20) NOT NULL,
  `numchar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` bigint(20) DEFAULT NULL,
  `classroom_id` bigint(20) DEFAULT NULL,
  `foodtable_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examcards`
--

INSERT INTO `examcards` (`id`, `registrant_id`, `index`, `numchar`, `room_id`, `classroom_id`, `foodtable_id`, `created_at`, `updated_at`) VALUES
(9, 20, 1, 'A001', 12, 4, 3, '2020-05-03 12:50:03', '2020-05-03 12:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foodtables`
--

CREATE TABLE `foodtables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `vnow` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foodtables`
--

INSERT INTO `foodtables` (`id`, `name`, `capacity`, `vnow`, `created_at`, `updated_at`) VALUES
(3, 'Meja 1', 9, 1, '2020-04-21 02:26:50', '2020-05-03 12:50:44'),
(4, 'Meja 2', 6, 0, '2020-04-21 02:27:14', '2020-05-03 12:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_17_142544_create_settings_table', 2),
(5, '2020_04_20_100252_create_buildings_table', 3),
(6, '2020_04_20_092904_create_rooms_table', 4),
(7, '2020_04_21_081445_create_classrooms_table', 5),
(8, '2020_04_21_085128_create_foodtables_table', 6),
(9, '2020_04_23_071320_create_payments_table', 7),
(10, '2020_04_25_220713_create_registrants_table', 8),
(11, '2020_04_29_000121_create_regsiblings_table', 9),
(12, '2020_05_01_001552_create_regschools_table', 10),
(13, '2020_05_01_143554_create_regparents_table', 11),
(14, '2020_05_02_192314_create_regsteps_table', 12),
(15, '2020_05_03_001326_create_nomorujians_table', 13),
(16, '2020_05_03_113003_create_examcards_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `nomorujians`
--

CREATE TABLE `nomorujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registrant_id` bigint(20) NOT NULL,
  `index` bigint(20) NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nomorujians`
--

INSERT INTO `nomorujians` (`id`, `registrant_id`, `index`, `number`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 'A0001', '2020-05-02 17:39:25', '2020-05-02 17:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paydate` date NOT NULL,
  `paynumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paynominal` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `paydate`, `paynumber`, `paynominal`, `created_at`, `updated_at`) VALUES
(1, '2020-04-25', '123ABC89098', 8000000, '2020-04-25 07:23:16', '2020-04-25 07:23:16'),
(2, '2020-04-20', '123ABC89099', 8000000, '2020-04-25 07:23:16', '2020-04-25 07:23:16'),
(3, '2020-04-22', '123ABC89100', 7500000, '2020-04-25 07:23:16', '2020-04-25 07:23:16'),
(4, '2020-03-11', '123ABC99999', 8000000, '2020-04-25 07:28:02', '2020-04-25 07:28:02'),
(5, '2020-04-22', '343433', 9000, '2020-05-03 13:59:40', '2020-05-03 13:59:40'),
(8, '2019-07-25', 'aaaa11111', 8000000, '2020-05-03 14:09:09', '2020-05-03 14:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `registrants`
--

CREATE TABLE `registrants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kknumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `bloodtype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `birthplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `consulat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wishes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achievement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition` text COLLATE utf8mb4_unicode_ci,
  `siblings` int(11) NOT NULL,
  `stepsiblings` int(11) NOT NULL,
  `totalsiblings` int(11) NOT NULL,
  `numposition` int(11) NOT NULL,
  `paynumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paydate` date DEFAULT NULL,
  `paynominal` bigint(20) DEFAULT NULL,
  `paybankaccount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payimg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paysubmitted` tinyint(1) NOT NULL DEFAULT '0',
  `isverified` tinyint(1) NOT NULL DEFAULT '0',
  `manualverify` tinyint(1) NOT NULL DEFAULT '0',
  `verified_at` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrants`
--

INSERT INTO `registrants` (`id`, `years`, `email`, `email_verified_at`, `password`, `kknumber`, `username`, `name`, `nickname`, `nisn`, `gender`, `bloodtype`, `weight`, `height`, `birthplace`, `birthdate`, `consulat`, `hobby`, `wishes`, `achievement`, `competition`, `siblings`, `stepsiblings`, `totalsiblings`, `numposition`, `paynumber`, `paydate`, `paynominal`, `paybankaccount`, `payimg`, `paysubmitted`, `isverified`, `manualverify`, `verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(20, '2020/2021', 'dosen.khairi@gmail.com', NULL, '$2y$10$5R5Uw7P8ODO27mId0bVpJOx1dmkHO6u4HdWq7zK8x/.R8bU1GN6F6', '987654321', '111', 'KHAIRI IBNUTAMA', 'KHERY', 555555, 1, 'B', 50, 161, 'PERBAUNGAN', '1987-06-24', NULL, 'KOMPUTER,PROGRAMMING', 'DOSEN', '2', 'KALIGRAFI TINGKAT DESA', 3, 0, 3, 1, '123ABC89098', NULL, NULL, NULL, '1588479870.png', 1, 1, 0, '2020-05-02', NULL, '2020-04-30 09:36:50', '2020-05-03 04:24:30'),
(21, '2020/2021', 'email@mail.com', NULL, '$2y$10$gqYKHACMIQrMjTk9RH4TmuOo58FXkdNBvBVhiXkfud8NyS9iBKp4y', '999999', '999999', 'NAMA LENGKAP', 'PANGGILANG', 999999, 2, 'AB', 40, 155, 'MEDAN', '2012-12-12', NULL, 'BERSEPEDA,BLOGGING,BOWLING', 'AKUNTAN', NULL, NULL, 1, 0, 1, 2, 'FT999999/RS', NULL, NULL, NULL, '1588482018.png', 1, 0, 0, NULL, NULL, '2020-05-03 04:47:20', '2020-05-03 14:09:09'),
(22, '2020/2021', 'e@mail.com', NULL, '$2y$10$kDQYtvgyFp1U7oPOrPqMAeL.S9dx/ueOIhz..lEZYmiKEhHE/WKfG', '44', '44', 'PENDAFTAR BERIKUTNYA', 'DAFTAR', 44, 1, 'O', 74, 168, 'PADANG', '2000-01-01', NULL, 'BERENANG', 'GUBERNUR,PENGACARA', NULL, NULL, 0, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2020-05-03 06:58:16', '2020-05-03 06:58:16'),
(23, '2020/2021', '88mail@e.com', NULL, '$2y$10$j5lJZ0D9X8FA8szWKqKsbOo8kzOHGAhD.WJGVnPIoDUtPVnC2sVGG', '88', '88', 'CALON SANTRI', 'CALON', 88, 1, 'A', 50, 165, 'IDI', '2002-04-12', NULL, NULL, NULL, '1', 'MAKAN', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2020-05-03 14:35:10', '2020-05-03 14:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `regparents`
--

CREATE TABLE `regparents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registrant_id` bigint(20) NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flive` tinyint(1) NOT NULL DEFAULT '1',
  `fadd` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fprov` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fwa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fedu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `freli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fmari` tinyint(1) NOT NULL DEFAULT '1',
  `fwork` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fsal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faddsal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mlive` tinyint(1) NOT NULL DEFAULT '1',
  `madd` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mprov` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mkab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mkec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mkel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mwa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mreli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mwork` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maddsal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `pembiayaan` tinyint(1) NOT NULL DEFAULT '1',
  `donaturname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donaturrels` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donaturphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donaturadd` text COLLATE utf8mb4_unicode_ci,
  `dprov` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dkab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dkec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dkel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berkasijz` tinyint(1) NOT NULL DEFAULT '1',
  `berkasskhun` tinyint(1) NOT NULL DEFAULT '1',
  `berkasnisn` tinyint(1) NOT NULL DEFAULT '1',
  `berkaskk` tinyint(1) NOT NULL DEFAULT '1',
  `berkasktp` tinyint(1) NOT NULL DEFAULT '1',
  `berkasfoto` tinyint(1) NOT NULL DEFAULT '1',
  `berkasrapor` tinyint(1) NOT NULL DEFAULT '1',
  `berkasskbb` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regparents`
--

INSERT INTO `regparents` (`id`, `registrant_id`, `fname`, `flive`, `fadd`, `fprov`, `fkab`, `fkec`, `fkel`, `fphone`, `fwa`, `fktp`, `fedu`, `freli`, `fmari`, `fwork`, `fsal`, `faddsal`, `mname`, `mlive`, `madd`, `mprov`, `mkab`, `mkec`, `mkel`, `mphone`, `mwa`, `mktp`, `medu`, `mreli`, `mwork`, `msal`, `maddsal`, `pembiayaan`, `donaturname`, `donaturrels`, `donaturphone`, `donaturadd`, `dprov`, `dkab`, `dkec`, `dkel`, `berkasijz`, `berkasskhun`, `berkasnisn`, `berkaskk`, `berkasktp`, `berkasfoto`, `berkasrapor`, `berkasskbb`, `created_at`, `updated_at`) VALUES
(3, 20, 'M. ROSADI NST.', 1, 'JALAN PASAR 1', 'SUMATERA UTARA', 'KABUPATEN MANDAILING NATAL', 'SINUNUKAN', 'SINUNUKAN IV', '0813 121 212', '0811 1111', '4444', 'S1', 'ISLAM', 1, 'KARYAWAN BUMN', '7,6 Juta - 9,5 Juta', '5.000.000', 'MURNIATI HARAHAP', 1, 'JALAN PASAR 1', 'SUMATERA UTARA', 'KABUPATEN MANDAILING NATAL', 'SINUNUKAN', 'SINUNUKAN IV', '0811 9999', NULL, '5555', 'SMA', 'ISLAM', 'MENGURUS RUMAH TANGGA', '500 Ribu - 1,9 Juta', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, 1, 1, 0, '2020-05-01 14:36:54', '2020-05-01 14:36:54'),
(4, 21, 'AYAH KANDUNG', 0, 'JALAN SETIA BUDI NO 121', 'SUMATERA UTARA', 'KOTA MEDAN', 'MEDAN SELAYANG', 'TANJUNG SARI', '0822 9988 9988', '0822 9988 9988', '999999', 'S3', 'ISLAM', 1, 'PEGAWAI NEGERI SIPIL', '3,6 Juta - 5,5 Juta', NULL, 'IBU KANDUNG', 1, 'JALAN SETIA BUDI NO 121', 'SUMATERA UTARA', 'KOTA MEDAN', 'MEDAN SELAYANG', 'TANJUNG SARI', '0852 7777 7777', '0852 7777 7777', '999999', 'SMA', 'ISLAM', 'MENGURUS RUMAH TANGGA', '500 Ribu - 1,9 Juta', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, '2020-05-03 04:52:29', '2020-05-03 04:52:29'),
(5, 22, 'AYAH PENDAFTAR', 0, 'JL PARAK GADANG', 'SUMATERA BARAT', 'KOTA PADANG', 'PADANG BARAT', 'GANTING PARAK GADANG', '0811 0000 222', '0811 0000 222', '4444', 'SD', 'ISLAM', 1, 'BURUH HARIAN LEPAS', '500 Ribu - 1,9 Juta', NULL, 'IBU PENDAFTAR', 0, 'JL PARAK GADANG', 'SUMATERA BARAT', 'KOTA PADANG', 'PADANG BARAT', 'GANTING PARAK GADANG', '0811 0000 222', NULL, '4444', 'SD', 'ISLAM', 'PEMBANTU RUMAH TANGGA', '500 Ribu - 1,9 Juta', NULL, 0, 'SANG DONATUR', 'DERMAWAN', '0811 0000 222', 'JL. JALAN DIMEDAN', 'SUMATERA UTARA', 'KOTA MEDAN', 'MEDAN JOHOR', 'TITI KUNING', 1, 1, 1, 1, 1, 1, 1, 1, '2020-05-03 07:05:03', '2020-05-03 07:05:03'),
(6, 23, 'CALON AYAH', 1, 'JL. MEDAN BANDA ACEH', 'ACEH', 'KABUPATEN ACEH TIMUR', 'IDI RAYEUK', 'ALUE LHOK', '0813 1234 5678', '0813 1234 5678', '88', 'SMA', 'ISLAM', 1, 'PETANI/PEKEBUN', '2 Juta - 3,5 Juta', NULL, 'CALON IBU', 1, 'JL. MEDAN BANDA ACEH', 'ACEH', 'KABUPATEN ACEH TIMUR', 'IDI RAYEUK', 'ALUE LHOK', '0831 8888 7777', NULL, '88', 'MTS', 'ISLAM', 'MENGURUS RUMAH TANGGA', '500 Ribu - 1,9 Juta', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, '2020-05-03 14:38:04', '2020-05-03 14:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `regschools`
--

CREATE TABLE `regschools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registrant_id` bigint(20) NOT NULL,
  `schfrom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schlvl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schstreet` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `schprov` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schkab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schkec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schkel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schpsn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schijazah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schskhun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pindahan` tinyint(1) NOT NULL DEFAULT '0',
  `psnfrom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnadd` text COLLATE utf8mb4_unicode_ci,
  `psnwhy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psndesc` text COLLATE utf8mb4_unicode_ci,
  `psnup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnlvl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psnrep` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regschools`
--

INSERT INTO `regschools` (`id`, `registrant_id`, `schfrom`, `schlvl`, `schname`, `schstreet`, `schprov`, `schkab`, `schkec`, `schkel`, `schpsn`, `schun`, `schijazah`, `schskhun`, `pindahan`, `psnfrom`, `psnadd`, `psnwhy`, `psndesc`, `psnup`, `psnlvl`, `psnto`, `psnrep`, `created_at`, `updated_at`) VALUES
(4, 20, 'NEGERI', 'SD', 'SD NEGERI 3 LANGSA', 'JALAN LILAWANGSA NO 35', 'ACEH', 'KOTA LANGSA', 'LANGSA KOTA', 'GAMPONG JAWA', '888888', '888889', '888887', '888886', 1, 'DARUL ADIB', 'JALAN AMPLAS NO 15', 'TUGAS ORANGTUA', 'ORANG TUA PINDAH TUGAS KE PADANG BULAN', '3', 'MTS', '4', 1, '2020-05-01 07:32:25', '2020-05-01 07:32:25'),
(5, 21, 'NEGERI', 'SMP', 'SMP NEGERI 1', 'JALAN SETIA BUDI', 'SUMATERA UTARA', 'KOTA MEDAN', 'MEDAN SELAYANG', 'TANJUNG SARI', '999999', '999999', '999999', '999999', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-05-03 04:49:39', '2020-05-03 04:49:39'),
(6, 22, 'NEGERI', 'SMP', 'SMP NEGERI 3', 'JL. JALAN DI PADANG', 'SUMATERA BARAT', 'KOTA PADANG', 'PADANG SELATAN', 'PARAK GADANG TIMUR', '44', '44', '44', '44', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-05-03 07:01:22', '2020-05-03 07:01:22'),
(7, 23, 'SWASTA', 'SD', 'SD JAYA', 'JALAN MEDAN - BANDA ACEH NO. 44', 'ACEH', 'KABUPATEN ACEH TIMUR', 'IDI RAYEUK', 'KUTA BLANG', '88', '88', '88', '88', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-05-03 14:36:11', '2020-05-03 14:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `regsiblings`
--

CREATE TABLE `regsiblings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registrant_id` bigint(20) NOT NULL,
  `siblingname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siblingrelation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siblingnik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siblingphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regsiblings`
--

INSERT INTO `regsiblings` (`id`, `registrant_id`, `siblingname`, `siblingrelation`, `siblingnik`, `siblingphone`, `created_at`, `updated_at`) VALUES
(56, 20, 'SABDA MAULANA', 'ADIK', '333333333', '0813 8899 2200', '2020-05-01 07:29:33', '2020-05-01 07:29:33'),
(57, 20, 'ZIKRI AULIA', 'ADIK', '333333334', '0819 7878 4444', '2020-05-01 07:29:33', '2020-05-01 07:29:33'),
(58, 20, 'NAZHIFATHURRAHMI', 'ADIK', '333333335', '0811 8898 989', '2020-05-01 07:29:33', '2020-05-01 07:29:33'),
(59, 21, 'SAUDARA KANDUNG', 'KAKAK', '999999', '0813 8899 2200', '2020-05-03 04:48:19', '2020-05-03 04:48:19'),
(60, 22, 'SAUDARA PENDAFTAR', 'KAKAK', '44', NULL, '2020-05-03 06:58:41', '2020-05-03 06:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `regsteps`
--

CREATE TABLE `regsteps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registrant_id` bigint(20) NOT NULL,
  `stepreg` int(11) NOT NULL DEFAULT '1',
  `steppay` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regsteps`
--

INSERT INTO `regsteps` (`id`, `registrant_id`, `stepreg`, `steppay`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 3, NULL, '2020-05-03 14:45:37'),
(2, 21, 1, 2, NULL, '2020-05-03 04:58:26'),
(3, 22, 1, 1, '2020-05-03 06:58:16', '2020-05-03 06:58:16'),
(4, 23, 1, 1, '2020-05-03 14:35:10', '2020-05-03 14:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `vnow` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `building_id`, `name`, `capacity`, `vnow`, `created_at`, `updated_at`) VALUES
(10, 8, 'Ruangan 1', 20, 0, '2020-04-21 01:07:32', '2020-05-03 12:50:44'),
(11, 8, 'Ruangan 2', 22, 0, '2020-04-21 01:07:53', '2020-05-03 12:44:53'),
(12, 7, 'Ruangan 3', 30, 1, '2020-05-03 08:18:25', '2020-05-03 12:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` bigint(20) NOT NULL,
  `registration` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shorts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `years`, `cost`, `registration`, `name`, `prefix`, `suffix`, `shorts`, `company`, `address`, `city`, `postal`, `phone`, `mobile`, `email`, `fax`, `logo`, `web`, `fb`, `ig`, `tw`, `created_at`, `updated_at`) VALUES
(1, '2020/2021', 8000000, 1, 'Ar-Raudlatul Hasanah', 'Pesantren', NULL, 'Raudhah', NULL, 'Jl. Letjen. Jamin Ginting Km. 11 Paya Bundung / Jl. Setia Budi Ujung Simpang Selayang', 'Medan', 20135, '(061) 8360135', '082362664000', NULL, NULL, 'logo.png', 'https://raudhah.ac.id/', 'https://www.facebook.com/Pondok-Pesantren-Ar-Raudlatul-Hasanah-1437021993295205/', 'https://www.instagram.com/raudhah2graphy', NULL, '2020-04-16 17:00:00', '2020-05-03 14:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nopic.png',
  `role` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `phone`, `password`, `photo`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Khairi Ibnutama', 'kaitama', 'admin@mail.com', NULL, '081264601987', '$2y$10$mx8tfrWGv.ZR5wxn5JP0Suj6ZmUAc2KCV1HeGHFag21Oa5SNFbhiS', 'nopic.png', 1, 'jH3QNGKVo3XbnZa6lCcl0CIXHvsQGsV1kBSdlpA2zxVIQDoGC4lSmqVVJTn6', '2020-04-17 05:38:22', '2020-04-17 05:38:22'),
(4, 'User Name', 'username', 'user@mail.com', NULL, '081244445555', '$2y$10$k59EuSMLKQVuG3F.8kVa1eYllUin6YKVfImzoTqMThWF8camOP0K6', 'nopic.png', 3, NULL, '2020-04-19 00:37:47', '2020-04-20 01:41:52'),
(5, 'User Kedua', 'seconduser', 'username@mail.com', NULL, NULL, '$2y$10$e5bsECr9NJ0PATw9ZwvzuOEQlHcZqOnhHrmBAk5U6UaxOpcaaN1yq', 'nopic.png', 3, NULL, '2020-04-19 00:55:53', '2020-04-20 01:42:22'),
(7, 'Super Visor', 'supervisor', 'spv@mail.com', NULL, '0812123123', '$2y$10$//whzkKGkv45YZ7QbdBCPOuiDqg2NwyrIQpHXl5gqBIRn48Fa7phK', 'nopic.png', 2, NULL, '2020-04-20 01:00:55', '2020-04-20 01:41:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examcards`
--
ALTER TABLE `examcards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `examcards_numchar_unique` (`numchar`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodtables`
--
ALTER TABLE `foodtables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomorujians`
--
ALTER TABLE `nomorujians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrants`
--
ALTER TABLE `registrants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registrants_email_unique` (`email`),
  ADD UNIQUE KEY `registrants_username_unique` (`username`);

--
-- Indexes for table `regparents`
--
ALTER TABLE `regparents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regschools`
--
ALTER TABLE `regschools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regsiblings`
--
ALTER TABLE `regsiblings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regsteps`
--
ALTER TABLE `regsteps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `examcards`
--
ALTER TABLE `examcards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foodtables`
--
ALTER TABLE `foodtables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nomorujians`
--
ALTER TABLE `nomorujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registrants`
--
ALTER TABLE `registrants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `regparents`
--
ALTER TABLE `regparents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regschools`
--
ALTER TABLE `regschools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `regsiblings`
--
ALTER TABLE `regsiblings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `regsteps`
--
ALTER TABLE `regsteps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;