-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 18 jun 2026 kl 16:52
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `chemavisare`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `activiteter`
--

CREATE TABLE `activiteter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `begin` datetime NOT NULL DEFAULT current_timestamp(),
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `activiteter`
--

INSERT INTO `activiteter` (`id`, `name`, `begin`, `info`) VALUES
(1, 'lunch', '2026-06-17 12:00:00', ''),
(2, 'aktivitet', '2026-06-17 13:15:00', ''),
(3, 'aktivitet2', '2026-06-17 18:02:00', ''),
(4, 'aktivitet3', '2026-06-17 18:07:00', '');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `activiteter`
--
ALTER TABLE `activiteter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `activiteter`
--
ALTER TABLE `activiteter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
