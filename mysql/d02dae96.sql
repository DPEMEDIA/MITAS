-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: dd44000
-- Erstellungszeit: 08. Mrz 2020 um 18:00
-- Server-Version: 5.7.28-nmm1-log
-- PHP-Version: 7.1.33-nmm1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `d02dae96`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ms_booking`
--

CREATE TABLE `ms_booking` (
  `bookingid` int(8) NOT NULL,
  `storeid` int(4) NOT NULL,
  `userid` int(8) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telefon` varchar(13) NOT NULL,
  `product` varchar(64) NOT NULL,
  `status` varchar(16) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ms_product`
--

CREATE TABLE `ms_product` (
  `productid` int(8) NOT NULL,
  `productcatid` int(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `picture` varchar(128) NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tabellenstruktur für Tabelle `ms_product_category`
--

CREATE TABLE `ms_product_category` (
  `productcatid` int(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `parentid` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ms_product_category`
--

INSERT INTO `ms_product_category` (`productcatid`, `name`, `parentid`) VALUES
(1, 'Liquids', 0),
(2, 'Liquids', 1),
(3, 'Liquids Tabak', 2),
(4, 'Liquids Früchte', 2),
(5, 'Liquids Diverses', 2),
(7, 'Hardware', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ms_returns`
--

CREATE TABLE `ms_returns` (
  `returnid` int(8) NOT NULL,
  `storeid` int(4) NOT NULL,
  `userid` int(8) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `telefon` varchar(13) DEFAULT NULL,
  `email` varchar(64) DEFAULT '-',
  `product` varchar(64) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `bonnumber` varchar(16) NOT NULL,
  `bondate` date NOT NULL DEFAULT '0000-00-00',
  `dateofreturn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateofsuccess` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(16) NOT NULL,
  `note` varchar(255) DEFAULT '-'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tabellenstruktur für Tabelle `ms_roles`
--

CREATE TABLE `ms_roles` (
  `roleid` tinyint(1) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ms_roles`
--

INSERT INTO `ms_roles` (`roleid`, `name`) VALUES
(1, 'Administrator'),
(2, 'Filialleiter'),
(3, 'Mitarbeiter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ms_stores`
--

CREATE TABLE `ms_stores` (
  `storeid` int(4) NOT NULL,
  `short` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ms_stores`
--

INSERT INTO `ms_stores` (`storeid`, `short`, `name`) VALUES
(1, 'ZTR', 'Zentrale'),
(2, 'ST1', 'Store'),
(3, 'ST2', 'Store');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ms_users`
--

CREATE TABLE `ms_users` (
  `userid` int(8) NOT NULL,
  `storeid` int(4) NOT NULL,
  `roleid` tinyint(1) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(24) NOT NULL,
  `lastname` varchar(24) NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `online` int(16) NOT NULL,
  `returns` int(8) NOT NULL COMMENT 'Anzahl an Retouren',
  `booking` int(16) NOT NULL COMMENT 'Anzahl an Reservierungen',
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loginattempts` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ms_users`
--

INSERT INTO `ms_users` (`userid`, `storeid`, `roleid`, `username`, `password`, `firstname`, `lastname`, `locked`, `online`, `returns`, `booking`, `lastlogin`, `loginattempts`) VALUES
(1, 1, 1, 'Admin', '', '-', '-', 0, 1578674179, 0, 0, '2020-01-10 17:35:06', 0),
(2, 1, 1, 'A', '', '', '', 0, 0, 0, 0, '2019-03-25 23:27:43', 1),
(3, 1, 1, 'A', '', '', '', 0, 0, 0, 0, '2019-03-25 23:27:49', 0),
(4, 3, 3, 'A', '', '', '', 0, 0, 0, 0, '2019-03-25 23:27:54', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ms_booking`
--
ALTER TABLE `ms_booking`
  ADD PRIMARY KEY (`bookingid`);

--
-- Indizes für die Tabelle `ms_product`
--
ALTER TABLE `ms_product`
  ADD PRIMARY KEY (`productid`);

--
-- Indizes für die Tabelle `ms_product_category`
--
ALTER TABLE `ms_product_category`
  ADD PRIMARY KEY (`productcatid`);

--
-- Indizes für die Tabelle `ms_returns`
--
ALTER TABLE `ms_returns`
  ADD PRIMARY KEY (`returnid`);

--
-- Indizes für die Tabelle `ms_roles`
--
ALTER TABLE `ms_roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indizes für die Tabelle `ms_stores`
--
ALTER TABLE `ms_stores`
  ADD PRIMARY KEY (`storeid`);

--
-- Indizes für die Tabelle `ms_users`
--
ALTER TABLE `ms_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ms_booking`
--
ALTER TABLE `ms_booking`
  MODIFY `bookingid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `ms_product`
--
ALTER TABLE `ms_product`
  MODIFY `productid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT für Tabelle `ms_product_category`
--
ALTER TABLE `ms_product_category`
  MODIFY `productcatid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT für Tabelle `ms_returns`
--
ALTER TABLE `ms_returns`
  MODIFY `returnid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT für Tabelle `ms_stores`
--
ALTER TABLE `ms_stores`
  MODIFY `storeid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `ms_users`
--
ALTER TABLE `ms_users`
  MODIFY `userid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
