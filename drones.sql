-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2023 at 05:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drones`
--

-- --------------------------------------------------------

--
-- Table structure for table `drone`
--

CREATE TABLE `drone` (
  `Serialnumber` varchar(15) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `position` float(15,9) NOT NULL,
  `timedate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drone`
--

INSERT INTO `drone` (`Serialnumber`, `Firstname`, `Lastname`, `email`, `phonenumber`, `position`, `timedate`) VALUES
('SN-1O0oV0ZWVa', 'Eulalia', 'Jones', 'eulalia.jones@example.com', '+210094377722', 95992.914062500, '2023-01-13 12:44:03'),
('SN-b5vabtVHTk', 'Modesto', 'Blick', 'modesto.blick@example.com', '+210433801467', 28173.664062500, '2023-01-13 12:49:05'),
('SN-b7gCzwu0ST', 'Marques', 'Wisozk', 'marques.wisozk@example.com', '+210450541895', 87110.382812500, '2023-01-13 12:44:03'),
('SN-lqoruc9jJe', 'Tressa', 'Prohaska', 'tressa.prohaska@example.com', '+210240842063', 63997.960937500, '2023-01-13 12:47:04'),
('SN-OeaTWJ5-wV', 'Stephanie', 'Zulauf', 'stephanie.zulauf@example.com', '+210874920398', 78741.101562500, '2023-01-13 12:50:05'),
('SN-ovlovCDQpK', 'Vernie', 'Kohler', 'vernie.kohler@example.com', '+210569910518', 67570.343750000, '2023-01-13 12:45:03'),
('SN-tLUPmavRo6', 'Alexandra', 'Mohr', 'alexandra.mohr@example.com', '+210249336180', 94050.492187500, '2023-01-13 12:42:02'),
('SN-uRwZvwe0Me', 'Keenan', 'West', 'keenan.west@example.com', '+210657047948', 82592.359375000, '2023-01-13 12:46:04'),
('SN-VCV-qSC7Gq', 'Merritt', 'Bailey', 'merritt.bailey@example.com', '+210683411535', 91770.289062500, '2023-01-13 12:47:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drone`
--
ALTER TABLE `drone`
  ADD PRIMARY KEY (`Serialnumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
