-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19. Apr, 2023 13:37 PM
-- Tjener-versjon: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `ad`
--

CREATE TABLE `ad` (
  `ad_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `leie` int(11) NOT NULL,
  `boligtype` varchar(255) NOT NULL,
  `areal` int(11) NOT NULL,
  `rom` int(11) NOT NULL,
  `etasje` int(11) NOT NULL,
  `leieperiode` varchar(255) NOT NULL,
  `ledigfra` date NOT NULL,
  `depositum` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `postnr` varchar(255) NOT NULL,
  `poststed` varchar(255) NOT NULL,
  `info` varchar(1000) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `ad`
--

INSERT INTO `ad` (`ad_id`, `title`, `leie`, `boligtype`, `areal`, `rom`, `etasje`, `leieperiode`, `ledigfra`, `depositum`, `usersId`, `adresse`, `postnr`, `poststed`, `info`, `isDeleted`) VALUES
(53, 'Lys og trivelig leilighet med to soverom', 10000, 'Leilighet', 132, 2, 2, 'korttidsleie', '2022-12-23', 20000, 2, 'Skiferveien 5B', '9801', 'Vadsø', 'Lys og trivelig leilighet med fin beliggenhet.\r\n\r\nLeiligheten er oppusset og modernisert bl.a. fine og tidsriktige farger i stua, nyere kjøkken og nytt baderomsinnredning fra 2019, samt to soverom, gang, yttergang og bod.\r\n\r\nLeiligheten ligger nært til turstier, dagligvarebutikk og barnehage.', 0),
(54, 'Innholdsrikt 5-roms midtrekkehus på Viebøen. Nært sykehuset og høyskolen.', 12000, 'Rekkehus', 124, 4, 1, 'langtidsleie', '2023-01-14', 24000, 3, 'Storetungrova 35', '6812', 'Førde', 'Velkommen til Storetungrova 35! \r\n\r\nBoligen går over to plan og har innholdsrik planløsning med bl.a 4 soverom, romslig bad med både dusj og badekar, gjestetoalett, samt separat vaskerom. I stuen er det vedovn, og det er utgang til vestvendt terrasse med takoverbygg. Kjøkkenet er romslig med innholdsrik innredning og god plass til spisebord. Hvitevarene følger med i handelen. \r\nParkeringsplass like ved med opplegg for elbil-lader.\r\n\r\nOmrådet er barnevennlig og solrikt, og det er gangavstand til turområder, butikker, barnehage, høyskolen og sykehuset.\r\n\r\nHusk visningspåmelding!', 0),
(55, 'Flytt rett inn i en nesten ny (2018) og snerten selveierleil. m/ balkong og garasjeplass. Elvenær beliggenhet.', 11000, 'Leilighet', 243, 3, 2, 'langtidsleie', '2022-12-23', 22000, 1, 'Glatveds gate 3', '3513', 'Hønefoss', 'Lev det enkle og urbane livet i sentrum!\r\nMed umiddelbar nærhet til alle sentrumsfasiliteter og grønne omgivelser langs elven, er dette den perfekte boligen for deg som vil ha både by og naturelementer tett på.\r\nNyt din nye botilværelse med en gjennomført standard som byr på vannbåren gulvvarme, balansert ventilasjonsanlegg, flislagt bad, et luftig soverom med fransk balkong, åpen stue- og kjøkkenløsning med utgang til balkong hvor du har et lekkert utsyn og morgensol.\r\nTidløse og innbydende overflater og innredninger som har minimalt med brukslitasje. Ingen TG2/TG3!\r\nI tillegg får du muligheten til å benytte deg av felles terrasse med fin utsikt over byen og du kan til og med huse overnattingsgjestene i sameiets hybeldel.\r\nOpplev en sjelden mulighet - meld deg på visning i dag!', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `fasiliteter`
--

CREATE TABLE `fasiliteter` (
  `fasilitetId` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `fasilitet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `fasiliteter`
--

INSERT INTO `fasiliteter` (`fasilitetId`, `ad_id`, `fasilitet`) VALUES
(37, 53, 'Møbler, Hvitevarer, Balkong, Terrasse, Parkering, Husdyr tillatt, Røyking tillatt'),
(38, 54, 'Møbler, Hvitevarer, Balkong, Terrasse, Parkering'),
(39, 55, 'Møbler, Hvitevarer, Balkong, Terrasse');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `images`
--

INSERT INTO `images` (`img_id`, `file_name`, `ad_id`) VALUES
(26, '53_440_178093189.jpg', 53),
(27, '53_440_541840763.jpg', 53),
(28, '53_440_671866307.jpg', 53),
(29, '53_440_1025861494.jpg', 53),
(30, '53_440_1037550178.jpg', 53),
(31, '54_388_339389345.jpg', 54),
(32, '54_388_824077699.jpg', 54),
(33, '54_388_1442501770.jpg', 54),
(34, '54_388_1588510603.jpg', 54),
(35, '55_436_464873657.jpg', 55),
(36, '55_436_1037312437.jpg', 55),
(37, '55_436_2052123031.jpg', 55),
(38, '55_436_2070413884.jpg', 55);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `messages`
--

INSERT INTO `messages` (`msg_id`, `message`, `sender`, `receiver`, `ad_id`, `created`) VALUES
(186, 'Hi, i want this', 'test', 'testbruker', 54, '2023-04-05 17:32:50'),
(187, 'asdasd', 'test', 'testbruker', 54, '2023-04-05 17:32:56'),
(188, 'sdafasdf', 'test', 'testbruker', 54, '2023-04-05 17:32:57');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `renters`
--

CREATE TABLE `renters` (
  `usersId` int(100) NOT NULL,
  `budget` int(100) NOT NULL,
  `wants` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `renters`
--

INSERT INTO `renters` (`usersId`, `budget`, `wants`) VALUES
(1, 0, 'Hvitevarer, Balkong, Terrasse, Parkering,  '),
(2, 0, 'Hvitevarer,  ');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `notif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersPwd`, `notif`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$0ST3UceF1rfe/OhbaqUivev6BfjabwRR0kPfkaiV7FE3vmHnFtOg2', 1),
(2, 'test2', 'warisaslami5@gmail.com', '$2y$10$zGuu1iDt.2y9k87SC7k6weCpfb6pItl3kQ.UYC50SACyH22qoBRem', 1),
(3, 'testbruker', 'testbruker@gmail.com', '$2y$10$P5Q7R6erLquH0F3jVfxRy.os9DfUW4Zb5qanza2XCtt8ZaMrq.Us.', 0),
(35, 'testbruker3', 'test3@gmail.com', '$2y$10$tlyQ64rX5QAfuBL0Pgtu4.PsEDNT3FAQKcybMfwswd8a8Ue2HQRD2', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_inbox`
--

CREATE TABLE `user_inbox` (
  `usersId` int(11) DEFAULT NULL,
  `uname` varchar(255) NOT NULL,
  `ad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `user_inbox`
--

INSERT INTO `user_inbox` (`usersId`, `uname`, `ad_id`) VALUES
(1, 'testbruker', 54),
(3, 'test', 54);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `usersID` (`usersId`);

--
-- Indexes for table `fasiliteter`
--
ALTER TABLE `fasiliteter`
  ADD PRIMARY KEY (`fasilitetId`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `renters`
--
ALTER TABLE `renters`
  ADD PRIMARY KEY (`usersId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- Indexes for table `user_inbox`
--
ALTER TABLE `user_inbox`
  ADD UNIQUE KEY `ucCodes` (`uname`,`ad_id`) USING BTREE,
  ADD KEY `usersId` (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad`
--
ALTER TABLE `ad`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `fasiliteter`
--
ALTER TABLE `fasiliteter`
  MODIFY `fasilitetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `ad_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`usersId`);

--
-- Begrensninger for tabell `fasiliteter`
--
ALTER TABLE `fasiliteter`
  ADD CONSTRAINT `fasiliteter_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`ad_id`);

--
-- Begrensninger for tabell `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`ad_id`);

--
-- Begrensninger for tabell `renters`
--
ALTER TABLE `renters`
  ADD CONSTRAINT `renters_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`usersId`);

--
-- Begrensninger for tabell `user_inbox`
--
ALTER TABLE `user_inbox`
  ADD CONSTRAINT `user_inbox_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`usersId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
