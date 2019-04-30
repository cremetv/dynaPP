-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Apr 2019 um 16:53
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
-- Tabellenstruktur für Tabelle `changes`
--

CREATE TABLE `changes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `changes`
--

INSERT INTO `changes` (`id`, `name`, `description`) VALUES
(1, 'clientStatus', '%user% set the status of %client% to %value%'),
(2, 'nameChange', '%user% changed the name for %client% to %value%'),
(3, 'checked', '%user% set %element% of client %client% to %value%');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `checklist`
--

CREATE TABLE `checklist` (
  `id` int(10) UNSIGNED NOT NULL,
  `clientId` int(11) NOT NULL,
  `elementId` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `checklist`
--

INSERT INTO `checklist` (`id`, `clientId`, `elementId`, `position`) VALUES
(1, 2, 1, 1),
(2, 2, 5, 2),
(3, 1, 2, 1),
(4, 1, 4, NULL),
(5, 2, 3, NULL);

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
(1, 'John Doe', 'John Doe<br>\r\nDankstreet 11<br>\r\n12345 Slowten\r\n', '2019-04-29 14:08:13', '2019-04-30 08:50:04'),
(2, 'Mr. Lorem ip', 'SV Boi<br>\r\nMr. sven boio<br>\r\ngheystreet. 13<br>\r\n42042 Benztown', '2019-04-29 14:08:13', '2019-04-30 08:50:13');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `elements`
--

CREATE TABLE `elements` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `custom` tinyint(1) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `elements`
--

INSERT INTO `elements` (`id`, `name`, `custom`, `description`, `content`) VALUES
(1, 'googleMaps', 0, 'a map api', 'This site is using google maps'),
(2, 'openStreetMap', 0, 'another map api', 'This site is using OpenStreetMaps'),
(3, 'googleAnalytics', 0, 'tool to analyse the website', 'This site is using Google Analytics'),
(4, 'contactForm', 0, 'a form to contact the site owner', 'This site is using a contact form'),
(5, 'cookies', 1, 'cookie stuff', 'This site is using cookies');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log`
--

CREATE TABLE `log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client` int(11) NOT NULL,
  `changes` varchar(255) NOT NULL,
  `element` int(11) DEFAULT NULL,
  `was` text NOT NULL,
  `isNow` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `log`
--

INSERT INTO `log` (`id`, `user`, `time`, `client`, `changes`, `element`, `was`, `isNow`) VALUES
(1, 2, '2019-04-30 08:31:19', 1, 'clientStatus', NULL, '1', '0'),
(2, 1, '2019-04-30 08:31:19', 2, 'nameChange', NULL, 'john doooe', 'John Doe'),
(3, 3, '2019-04-30 08:31:40', 1, 'checked', 4, '0', '1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `changes`
--
ALTER TABLE `changes`
  ADD PRIMARY KEY (`id`);

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
-- Indizes für die Tabelle `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `changes`
--
ALTER TABLE `changes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT für Tabelle `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
