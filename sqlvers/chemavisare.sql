-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 06 jul 2026 kl 21:05
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
(51, 'Ankomst, Lunch,  uppackning', '2026-07-21 13:00:00', 'Lunch: kebabgryta med ris'),
(52, 'Lära känna varandra', '2026-07-21 14:00:00', 'intro till lägret, flagghissning.'),
(53, 'Bibelstudium', '2026-07-21 15:00:00', ''),
(54, 'Fika', '2026-07-21 16:00:00', ''),
(55, 'Volleyboll', '2026-07-21 16:30:00', ''),
(56, 'Bad', '2026-07-21 17:30:00', ''),
(57, 'Gruppledarsamling', '2026-07-21 18:30:00', ''),
(58, 'Kvällsmat', '2026-07-21 19:00:00', 'Grilla korv'),
(59, 'Kvällskul', '2026-07-21 20:00:00', 'Janne och Andreas.L'),
(60, 'Lägerbål', '2026-07-21 21:30:00', ''),
(61, 'Tystnad', '2026-07-21 23:00:00', ''),
(62, 'Väckning', '2026-07-22 08:15:00', ''),
(63, 'Morgonbön', '2026-07-22 08:45:00', ''),
(64, 'Flagghissning', '2026-07-22 09:00:00', 'Frukost'),
(65, 'Ankomst Lilla byn', '2026-07-22 10:00:00', 'Fika för lilla byn'),
(66, 'Bytid', '2026-07-22 11:00:00', 'Lägret byggs upp, samling i byarna'),
(67, 'Bibelstudium', '2026-07-22 12:00:00', ''),
(68, 'Lunch', '2026-07-22 13:00:00', 'Lunch: Korv och mos'),
(69, 'Lägerinvigning', '2026-07-22 14:30:00', 'Foto, gruppindelning, tid i grupperna, femkampsgren 1'),
(70, 'Smörgåsbord', '2026-07-22 15:45:00', ''),
(71, 'Mellanmål', '2026-07-22 17:15:00', ''),
(72, 'Idrott', '2026-07-22 17:30:00', ''),
(73, 'Bad', '2026-07-22 18:30:00', 'Badansvariga: Knut, Sandra, Andreas.L'),
(74, 'Kvällsmat', '2026-07-22 19:15:00', 'Kvällsmat: Hamburgare'),
(75, 'Kvällskul', '2026-07-22 20:00:00', 'Flickornas afton och femkampsgren 2'),
(76, 'Lägerbål', '2026-07-22 21:30:00', ''),
(77, 'Tystnad', '2026-07-22 22:30:00', ''),
(78, 'Väckning', '2026-07-23 08:00:00', ''),
(79, 'Morgonbön', '2026-07-23 08:30:00', 'Byarna'),
(80, 'Flagghissning', '2026-07-23 08:50:00', ''),
(81, 'Frukost', '2026-07-23 09:00:00', ''),
(82, 'Bibelstudium', '2026-07-23 09:45:00', ''),
(83, 'Stora spårningen', '2026-07-23 10:30:00', 'Mellanmål i skogen'),
(84, 'Lunch', '2026-07-23 14:30:00', 'Köttfärsås och spagetti'),
(85, 'Idrott', '2026-07-23 16:00:00', ''),
(86, 'Bad och fritid', '2026-07-23 17:30:00', 'Badvakter: Mats, Johan, Bengt'),
(87, 'Kvällsmat', '2026-07-23 19:00:00', 'Pannkakor'),
(88, 'Kvällskul', '2026-07-23 20:00:00', 'Pojkarnas afton, femkamp 3'),
(89, 'Lägerbål', '2026-07-23 21:30:00', ''),
(90, 'Nattspårning', '2026-07-23 22:30:00', ''),
(91, 'Väckning', '2026-07-24 08:30:00', ''),
(92, 'Morgonbön', '2026-07-24 09:00:00', ''),
(93, 'Flagghissning', '2026-07-24 09:10:00', ''),
(94, 'Frukost', '2026-07-24 09:15:00', ''),
(95, 'Bibelstudium och bytid', '2026-07-24 10:00:00', 'Femkamp 4');

-- --------------------------------------------------------

--
-- Tabellstruktur `dagstema`
--

CREATE TABLE `dagstema` (
  `id` int(11) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `begin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `activiteter`
--
ALTER TABLE `activiteter`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `dagstema`
--
ALTER TABLE `dagstema`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `activiteter`
--
ALTER TABLE `activiteter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT för tabell `dagstema`
--
ALTER TABLE `dagstema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
