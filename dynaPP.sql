-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Mai 2019 um 15:30
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
-- Tabellenstruktur für Tabelle `categorys`
--

CREATE TABLE `categorys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `type` varchar(255) NOT NULL,
  `options` text,
  `hint` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `title`, `description`, `type`, `options`, `hint`) VALUES
(1, 'registereintrag', 'Registereintrag', 'Wenn Ihre Organisation in ein Register eingetragen ist, wählen Sie dieses bitte aus und vervollständigen Sie die Angaben.', 'select', '[\'kein Register\', \'Genossenschaftsregister\', \'Handelsregister\', \'Partnerschaftsregister\', \'Vereinsregister\']', 'Wenn Ihr Unternehmen z. B. im Handelsregister eingetragen ist, geben Sie bitte die Registernummer und das Registergericht an.');

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
(1, 'clientStatus', '%user% set the status of %client% from %oldValue% to %value%'),
(2, 'nameChange', '%user% changed the name for %client% from %oldValue% to %value%'),
(3, 'checked', '%user% set %element% of %client% from %oldValue% to %value%');

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
  `legalLink` varchar(255) DEFAULT NULL,
  `businessType` varchar(255) NOT NULL,
  `betreiber` text,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `bezeichnung` text,
  `street` varchar(255) NOT NULL,
  `additionalAddress` varchar(255) DEFAULT NULL,
  `plz` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `vertretenDurch` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `clients`
--

INSERT INTO `clients` (`id`, `name`, `legalLink`, `businessType`, `betreiber`, `vorname`, `nachname`, `bezeichnung`, `street`, `additionalAddress`, `plz`, `city`, `email`, `tel`, `fax`, `vertretenDurch`, `createdAt`, `updatedAt`) VALUES
(1, 'John Doe', 'https://google.de', '', NULL, NULL, NULL, NULL, '', NULL, 0, '', '', '', NULL, NULL, '2019-04-29 14:08:13', '2019-05-02 07:45:38'),
(2, 'Mr. Lorem ip', 'https://sv443.net/privacypolicy/de', '', NULL, NULL, NULL, NULL, '', NULL, 0, '', '', '', NULL, NULL, '2019-04-29 14:08:13', '2019-05-02 07:45:21'),
(3, 'ice creme', 'https://ice-creme.de/impressum', '', NULL, NULL, NULL, NULL, '', NULL, 0, '', '', '', NULL, NULL, '2019-05-02 06:55:33', '2019-05-02 07:44:56'),
(20, 'test1', 'test1', '', NULL, NULL, NULL, NULL, '', NULL, 0, '', '', '', NULL, NULL, '2019-05-03 10:28:30', '2019-05-03 10:28:30'),
(21, 'test2', 'test2', '', NULL, NULL, NULL, NULL, '', NULL, 0, '', '', '', NULL, NULL, '2019-05-03 10:28:44', '2019-05-03 10:28:44'),
(22, 'test3', 'test3', '', NULL, NULL, NULL, NULL, '', NULL, 0, '', '', '', NULL, NULL, '2019-05-03 10:28:44', '2019-05-03 10:28:44');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datenschutz`
--

CREATE TABLE `datenschutz` (
  `id` int(10) UNSIGNED NOT NULL,
  `clientId` int(11) NOT NULL,
  `elementId` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `datenschutz`
--

INSERT INTO `datenschutz` (`id`, `clientId`, `elementId`, `position`, `updatedAt`) VALUES
(1, 3, 2, NULL, '2019-05-02 07:33:49'),
(2, 4, 1, NULL, '2019-05-02 07:33:49'),
(3, 3, 5, NULL, '2019-05-02 07:33:53'),
(4, 2, 1, NULL, '2019-02-05 08:34:18');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `elements`
--

CREATE TABLE `elements` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `custom` tinyint(1) DEFAULT NULL,
  `site` varchar(255) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `selectOption` text,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `hint` text,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `elements`
--

INSERT INTO `elements` (`id`, `name`, `custom`, `site`, `category`, `selectOption`, `type`, `title`, `description`, `hint`, `content`) VALUES
(1, 'googleMaps', 0, 'datenschutz', NULL, NULL, '', 'Google Maps', 'Ja, auf der Website ist Google Maps eingebunden.', 'Einwilligung!', 'This site is using google maps'),
(2, 'openStreetMap', 0, 'datenschutz', NULL, NULL, '', 'OpenStreetMap', 'Ja, auf der Website ist OpenStreetMap eingebunden.', NULL, 'This site is using OpenStreetMaps'),
(3, 'googleAnalytics', 0, 'datenschutz', NULL, NULL, '', 'Google Analytics', 'Ja, die Website verwendet Google Analytics zum Erfassen des Nutzerverhaltens.', 'AV-Vertrag, IP-Anonymisierung & Demografische Merkmale!', 'This site is using Google Analytics'),
(4, 'contactForm', 0, 'datenschutz', NULL, NULL, '', 'Kontaktformular', 'Ja, die Website verfügt über ein Kontaktformular.', NULL, 'This site is using a contact form'),
(5, 'cookies', 1, 'datenschutz', NULL, NULL, '', 'Cookies', 'Ja, die Website nutzt Cookies.', 'Die Rechtslage zu Cookies ist aktuell leider ungeklärt. Die DSGVO trifft dazu keine eindeutigen Aussagen. Die ePrivacy-Verordnung, die diese Punkte regeln wird, tritt voraussichtlich erst 2019 in Kraft. Wir empfehlen bis zu einer verbindlichen Klärung insbesondere für Tracking-Cookies eine Einwilligung der Nutzer einzuholen.', 'This site is using cookies'),
(6, 'ustid', 0, 'impressum', NULL, NULL, 'input', 'Ust.-ID:', '', 'Es gibt keine generelle Pflicht, eine USt.-ID zu beantragen. Wenn Sie aber eine USt.-ID haben, müssen Sie diese im Impressum angeben.', 'This site has a ustid'),
(7, 'wirtschafts-id', 0, 'impressum', NULL, NULL, 'input', 'Wirtschafts-ID:', '', NULL, 'This site has a wirtschafts id'),
(8, 'Registernummer', 0, 'impressum', 1, '[\'Genossenschaftsregister\', \'Handelsregister\', \'Partnerschaftsregister\', \'Vereinsregister\']', 'input', 'Registernummer', NULL, NULL, 'This site has a registernummer'),
(9, 'Registergericht', 0, 'impressum', 1, '[\'Genossenschaftsregister\', \'Handelsregister\', \'Partnerschaftsregister\', \'Vereinsregister\']', 'input', 'Registergericht', NULL, NULL, 'This site has a Registergericht');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impressum`
--

CREATE TABLE `impressum` (
  `id` int(10) UNSIGNED NOT NULL,
  `clientId` int(11) NOT NULL,
  `elementId` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `impressum`
--

INSERT INTO `impressum` (`id`, `clientId`, `elementId`, `position`, `updatedAt`) VALUES
(1, 3, 5, NULL, '2019-05-02 07:32:28'),
(2, 3, 2, NULL, '2019-05-02 07:33:03'),
(3, 4, 1, NULL, '2019-04-17 07:32:44'),
(4, 2, 2, NULL, '2019-05-02 07:34:33');

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
(1, 2, '2019-04-30 06:15:19', 1, 'clientStatus', NULL, '1', '0'),
(2, 1, '2019-04-30 08:21:19', 2, 'nameChange', NULL, 'Mr. L.', 'Mr. Lorem ip'),
(3, 3, '2019-04-30 08:31:40', 1, 'checked', 4, '0', '1'),
(4, 1, '2019-05-02 07:29:24', 3, 'checked', 5, '0', '1'),
(5, 1, '2019-05-02 07:30:39', 3, 'nameChange', NULL, 'icecream', 'ice creme'),
(6, 1, '2019-05-02 07:31:25', 2, 'clientStatus', NULL, '1', '0'),
(7, 1, '2019-05-02 08:20:25', 2, 'clientStatus', NULL, '0', '1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

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
-- Indizes für die Tabelle `datenschutz`
--
ALTER TABLE `datenschutz`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `impressum`
--
ALTER TABLE `impressum`
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
-- AUTO_INCREMENT für Tabelle `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `datenschutz`
--
ALTER TABLE `datenschutz`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `impressum`
--
ALTER TABLE `impressum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
