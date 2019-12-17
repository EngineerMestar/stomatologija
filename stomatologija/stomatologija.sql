-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 04:09 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stomatologija`
--

-- --------------------------------------------------------

--
-- Table structure for table `drzava`
--

CREATE TABLE `drzava` (
  `id` int(11) NOT NULL,
  `country_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `continent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drzava`
--

INSERT INTO `drzava` (`id`, `country_name`, `continent_id`) VALUES
(1, 'Hrvatska', 1),
(2, 'Slovenia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_number` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `vat_number`, `email`, `password`) VALUES
(1, 'Pero', 'Peric', '12343212345', 'pero@peric.com', '$2y$10$dxZOi2/TzzSFE9m/E93Mz.sjYQyZxixf3qTiVbZ4DXZaekIPN/dNO');

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id` int(11) NOT NULL,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id`, `city_name`, `country_id`) VALUES
(1, 'Zagreb', 1),
(2, 'Maribor', 2),
(3, 'Split', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontinent`
--

CREATE TABLE `kontinent` (
  `id` int(11) NOT NULL,
  `continent_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kontinent`
--

INSERT INTO `kontinent` (`id`, `continent_name`) VALUES
(1, 'Europa'),
(2, 'Azija'),
(3, 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `ordinacija`
--

CREATE TABLE `ordinacija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordinacija`
--

INSERT INTO `ordinacija` (`id`, `naziv`, `city_name`) VALUES
(1, 'Zdravi Zubi j.d.o.o', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pacijent`
--

CREATE TABLE `pacijent` (
  `ID` int(11) NOT NULL,
  `OIB` int(11) NOT NULL,
  `Ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ordinacija_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pacijent`
--

INSERT INTO `pacijent` (`ID`, `OIB`, `Ime`, `Prezime`, `Ordinacija_ID`) VALUES
(1, 123456, 'Filip', 'Mestrovic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `radi_u`
--

CREATE TABLE `radi_u` (
  `ID` int(11) NOT NULL,
  `Ordinacija_ID` int(11) NOT NULL,
  `Stomatolog_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stomatolog`
--

CREATE TABLE `stomatolog` (
  `ID` int(11) NOT NULL,
  `OIB` int(11) NOT NULL,
  `Ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stomatolog`
--

INSERT INTO `stomatolog` (`ID`, `OIB`, `Ime`, `Prezime`) VALUES
(1, 987654, 'Jozo', 'Gasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drzava`
--
ALTER TABLE `drzava`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontinent`
--
ALTER TABLE `kontinent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordinacija`
--
ALTER TABLE `ordinacija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacijent`
--
ALTER TABLE `pacijent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `radi_u`
--
ALTER TABLE `radi_u`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stomatolog`
--
ALTER TABLE `stomatolog`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drzava`
--
ALTER TABLE `drzava`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kontinent`
--
ALTER TABLE `kontinent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordinacija`
--
ALTER TABLE `ordinacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pacijent`
--
ALTER TABLE `pacijent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radi_u`
--
ALTER TABLE `radi_u`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stomatolog`
--
ALTER TABLE `stomatolog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
