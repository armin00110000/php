-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Jan 2026 um 11:46
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `aID` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`aID`, `user`, `passwort`) VALUES
(1, 'chef', '$2y$10$xxiQe5QfiKToJzpyRykoV.Y/jtDRXTvS07bcmo5av4LhUw72OqEoW'),
(2, 'kellner', '$2y$10$xxiQe5QfiKToJzpyRykoV.Y/jtDRXTvS07bcmo5av4LhUw72OqEoW'),
(3, 'koch', '$2y$10$xxiQe5QfiKToJzpyRykoV.Y/jtDRXTvS07bcmo5av4LhUw72OqEoW');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellposition`
--

CREATE TABLE `bestellposition` (
  `position_id` int(11) NOT NULL,
  `bestellung_id` int(11) NOT NULL,
  `gericht_id` int(11) NOT NULL,
  `anzahl` int(11) NOT NULL DEFAULT 1,
  `einzelpreis` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `bestellposition`
--

INSERT INTO `bestellposition` (`position_id`, `bestellung_id`, `gericht_id`, `anzahl`, `einzelpreis`) VALUES
(8, 2, 8, 1, 5.50),
(9, 2, 7, 2, 6.00),
(10, 2, 10, 1, 2.50),
(11, 2, 11, 2, 4.50),
(12, 2, 4, 1, 11.00),
(13, 2, 2, 1, 9.50),
(14, 2, 3, 1, 10.00),
(15, 2, 5, 2, 7.50),
(16, 2, 6, 1, 5.50),
(17, 1, 8, 1, 5.50),
(18, 1, 7, 2, 6.00),
(19, 1, 9, 1, 3.00),
(20, 1, 12, 2, 2.00),
(21, 1, 10, 1, 2.50),
(22, 1, 4, 1, 11.00),
(23, 1, 3, 1, 10.00),
(24, 1, 5, 1, 7.50),
(25, 1, 6, 1, 5.50),
(26, 3, 12, 3, 2.00),
(27, 3, 6, 3, 5.50),
(28, 4, 11, 5, 4.50),
(29, 4, 2, 2, 9.50),
(36, 5, 8, 4, 5.50),
(37, 5, 9, 2, 3.00),
(38, 5, 11, 2, 4.50),
(39, 5, 4, 3, 11.00),
(40, 5, 3, 1, 10.00),
(41, 6, 8, 5, 5.50),
(42, 6, 9, 1, 3.00),
(43, 6, 10, 1, 2.50),
(44, 6, 11, 3, 4.50),
(45, 6, 4, 4, 11.00),
(46, 6, 3, 1, 10.00),
(47, 6, 6, 5, 5.50),
(48, 7, 12, 10, 2.00);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `bestellung_id` int(11) NOT NULL,
  `tisch_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'offen',
  `gesamtpreis` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`bestellung_id`, `tisch_id`, `status`, `gesamtpreis`) VALUES
(1, 7, 'abgeschlossen', 61.00),
(2, 3, 'abgeschlossen', 80.00),
(3, 9, 'storniert', 22.50),
(4, 6, 'storniert', 41.50),
(5, 1, 'offen', 80.00),
(6, 3, 'offen', 128.00),
(7, 8, 'offen', 20.00);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht`
--

CREATE TABLE `gericht` (
  `gericht_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `preis` decimal(10,2) NOT NULL,
  `kategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `gericht`
--

INSERT INTO `gericht` (`gericht_id`, `name`, `preis`, `kategorie`) VALUES
(1, 'Margherita Pizza', 8.50, 'Hauptgericht'),
(2, 'Salami Pizza', 9.50, 'Hauptgericht'),
(3, 'Spaghetti Carbonara', 10.00, 'Hauptgericht'),
(4, 'Lasagne', 11.00, 'Hauptgericht'),
(5, 'Caesar Salad', 7.50, 'Vorspeise'),
(6, 'Tomatensuppe', 5.50, 'Vorspeise'),
(7, 'Tiramisu', 6.00, 'Dessert'),
(8, 'Panna Cotta', 5.50, 'Dessert'),
(9, 'Cola', 3.00, 'Getränk'),
(10, 'Wasser', 2.50, 'Getränk'),
(11, 'Wein (Glas)', 4.50, 'Getränk'),
(12, 'Espresso', 2.00, 'Getränk');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tisch`
--

CREATE TABLE `tisch` (
  `tisch_id` int(11) NOT NULL,
  `tischnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tisch`
--

INSERT INTO `tisch` (`tisch_id`, `tischnummer`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aID`);

--
-- Indizes für die Tabelle `bestellposition`
--
ALTER TABLE `bestellposition`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `bestellung_id` (`bestellung_id`),
  ADD KEY `gericht_id` (`gericht_id`);

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`bestellung_id`),
  ADD KEY `tisch_id` (`tisch_id`);

--
-- Indizes für die Tabelle `gericht`
--
ALTER TABLE `gericht`
  ADD PRIMARY KEY (`gericht_id`);

--
-- Indizes für die Tabelle `tisch`
--
ALTER TABLE `tisch`
  ADD PRIMARY KEY (`tisch_id`),
  ADD UNIQUE KEY `tischnummer` (`tischnummer`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `aID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `bestellposition`
--
ALTER TABLE `bestellposition`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `bestellung_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `gericht`
--
ALTER TABLE `gericht`
  MODIFY `gericht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `tisch`
--
ALTER TABLE `tisch`
  MODIFY `tisch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellposition`
--
ALTER TABLE `bestellposition`
  ADD CONSTRAINT `bestellposition_ibfk_1` FOREIGN KEY (`bestellung_id`) REFERENCES `bestellung` (`bestellung_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bestellposition_ibfk_2` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`gericht_id`);

--
-- Constraints der Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `bestellung_ibfk_1` FOREIGN KEY (`tisch_id`) REFERENCES `tisch` (`tisch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
