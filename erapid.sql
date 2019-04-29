-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Apr 2019 um 17:35
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `erapid`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `checklist`
--

CREATE TABLE `checklist` (
  `id` int(10) UNSIGNED NOT NULL,
  `clientId` int(11) NOT NULL,
  `elementId` int(11) NOT NULL,
  `custom` tinyint(1) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `checklist`
--

INSERT INTO `checklist` (`id`, `clientId`, `elementId`, `custom`, `position`) VALUES
(1, 2, 1, 0, 1),
(2, 2, 1, 1, 2),
(3, 1, 2, 0, 1),
(4, 1, 4, 0, NULL),
(5, 2, 3, 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `createdAt`, `updatedAt`) VALUES
(1, 'witzel', 'Dr. med. Achim Witzel<br>\r\nMarktstätte 11<br>\r\n78462 Konstanz\r\n', '2019-04-29 14:08:13', '2019-04-29 14:08:13'),
(2, 'denis-bau', 'DENIS Bauunternehmen<br>\r\nInh. Denis Omerbasic<br>\r\nRenchtalstr. 13<br>\r\n77704 Oberkirch-Nußbach', '2019-04-29 14:08:13', '2019-04-29 14:08:13');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customs`
--

CREATE TABLE `customs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `customs`
--

INSERT INTO `customs` (`id`, `name`, `description`, `content`) VALUES
(1, 'condoms', 'custom part for brothels', 'Please use condoms thanks.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `elements`
--

CREATE TABLE `elements` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `elements`
--

INSERT INTO `elements` (`id`, `name`, `description`, `content`) VALUES
(1, 'googleMaps', 'a map api', 'This site is using google maps'),
(2, 'openStreetMap', 'another map api', 'This site is using OpenStreetMaps'),
(3, 'googleAnalytics', 'tool to analyse the website', 'This site is using Google Analytics'),
(4, 'contactForm', 'a form to contact the site owner', 'This site is using a contact form');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `customs`
--
ALTER TABLE `customs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `customs`
--
ALTER TABLE `customs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
