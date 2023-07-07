-- MariaDB dump 10.19  Distrib 10.11.3-MariaDB, for osx10.18 (arm64)
--
-- Host: localhost    Database: swapi
-- ------------------------------------------------------
-- Server version	10.11.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `film_person`
--

DROP TABLE IF EXISTS `film_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_person` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` bigint(20) unsigned NOT NULL,
  `person_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_person_film_id_foreign` (`film_id`),
  KEY `film_person_person_id_foreign` (`person_id`),
  CONSTRAINT `film_person_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  CONSTRAINT `film_person_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_person`
--

LOCK TABLES `film_person` WRITE;
/*!40000 ALTER TABLE `film_person` DISABLE KEYS */;
INSERT INTO `film_person` VALUES
(1,1,1),
(2,2,1),
(3,3,1),
(4,6,1),
(5,1,2),
(6,2,2),
(7,3,2),
(8,4,2),
(9,5,2),
(10,6,2),
(11,1,3),
(12,2,3),
(13,3,3),
(14,4,3),
(15,5,3),
(16,6,3),
(17,1,4),
(18,2,4),
(19,3,4),
(20,6,4),
(21,1,5),
(22,2,5),
(23,3,5),
(24,6,5),
(25,1,6),
(26,5,6),
(27,6,6),
(28,1,7),
(29,5,7),
(30,6,7),
(31,1,8),
(32,1,9),
(33,1,10),
(34,2,10),
(35,3,10),
(36,4,10),
(37,5,10),
(38,6,10),
(39,4,11),
(40,5,11),
(41,6,11),
(42,1,12),
(43,6,12),
(44,1,13),
(45,2,13),
(46,3,13),
(47,6,13),
(48,1,14),
(49,2,14),
(50,3,14),
(51,1,15),
(52,1,16),
(53,3,16),
(54,4,16),
(55,1,18),
(56,2,18),
(57,3,18),
(58,1,19),
(59,2,20),
(60,3,20),
(61,4,20),
(62,5,20),
(63,6,20),
(64,2,21),
(65,3,21),
(66,4,21),
(67,5,21),
(68,6,21),
(69,2,22),
(70,3,22),
(71,5,22),
(72,2,23),
(73,2,24),
(74,2,25),
(75,3,25),
(76,2,26),
(77,3,27),
(78,3,28),
(79,3,29),
(80,3,30),
(81,3,31),
(82,4,32),
(83,4,33),
(84,5,33),
(85,6,33),
(86,4,34),
(87,4,35),
(88,5,35),
(89,6,35),
(90,4,36),
(91,5,36),
(92,4,37),
(93,4,38),
(94,4,39),
(95,4,40),
(96,5,40),
(97,4,41),
(98,4,42),
(99,4,43),
(100,5,43),
(101,4,44),
(102,3,45),
(103,4,46),
(104,5,46),
(105,6,46),
(106,4,47),
(107,4,48),
(108,4,49),
(109,4,50),
(110,4,51),
(111,5,51),
(112,6,51),
(113,4,52),
(114,5,52),
(115,6,52),
(116,4,53),
(117,5,53),
(118,6,53),
(119,4,54),
(120,6,54),
(121,4,55),
(122,6,55),
(123,4,56),
(124,6,56),
(125,4,57),
(126,4,58),
(127,5,58),
(128,6,58),
(129,4,59),
(130,5,59),
(131,5,60),
(132,5,61),
(133,5,62),
(134,5,63),
(135,6,63),
(136,5,64),
(137,6,64),
(138,5,65),
(139,5,66),
(140,5,67),
(141,6,67),
(142,5,68),
(143,6,68),
(144,5,69),
(145,5,70),
(146,5,71),
(147,5,72),
(148,5,73),
(149,5,74),
(150,5,75),
(151,6,75),
(152,5,76),
(153,5,77),
(154,5,78),
(155,6,78),
(156,6,79),
(157,6,80),
(158,1,81),
(159,6,81),
(160,5,82),
(161,6,82),
(162,6,83);
/*!40000 ALTER TABLE `film_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_planet`
--

DROP TABLE IF EXISTS `film_planet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_planet` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` bigint(20) unsigned NOT NULL,
  `planet_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_planet_film_id_foreign` (`film_id`),
  KEY `film_planet_planet_id_foreign` (`planet_id`),
  CONSTRAINT `film_planet_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  CONSTRAINT `film_planet_planet_id_foreign` FOREIGN KEY (`planet_id`) REFERENCES `planets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_planet`
--

LOCK TABLES `film_planet` WRITE;
/*!40000 ALTER TABLE `film_planet` DISABLE KEYS */;
INSERT INTO `film_planet` VALUES
(1,1,1),
(2,3,1),
(3,4,1),
(4,5,1),
(5,6,1),
(6,1,2),
(7,6,2),
(8,1,3),
(9,2,4),
(10,2,5),
(11,3,5),
(12,6,5),
(13,2,6),
(14,3,7),
(15,3,8),
(16,4,8),
(17,5,8),
(18,6,8),
(19,3,9),
(20,4,9),
(21,5,9),
(22,6,9),
(23,5,10),
(24,5,11),
(25,6,12),
(26,6,13),
(27,6,14),
(28,6,15),
(29,6,16),
(30,6,17),
(31,6,18),
(32,6,19),
(33,2,27);
/*!40000 ALTER TABLE `film_planet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_species`
--

DROP TABLE IF EXISTS `film_species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_species` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` bigint(20) unsigned NOT NULL,
  `species_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_species_film_id_foreign` (`film_id`),
  KEY `film_species_species_id_foreign` (`species_id`),
  CONSTRAINT `film_species_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  CONSTRAINT `film_species_species_id_foreign` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_species`
--

LOCK TABLES `film_species` WRITE;
/*!40000 ALTER TABLE `film_species` DISABLE KEYS */;
INSERT INTO `film_species` VALUES
(1,1,1),
(2,2,1),
(3,3,1),
(4,4,1),
(5,5,1),
(6,6,1),
(7,1,2),
(8,2,2),
(9,3,2),
(10,4,2),
(11,5,2),
(12,6,2),
(13,1,3),
(14,2,3),
(15,3,3),
(16,6,3),
(17,1,4),
(18,1,5),
(19,3,5),
(20,2,6),
(21,3,6),
(22,4,6),
(23,5,6),
(24,6,6),
(25,2,7),
(26,3,8),
(27,3,9),
(28,3,10),
(29,4,11),
(30,4,12),
(31,5,12),
(32,4,13),
(33,5,13),
(34,4,14),
(35,3,15),
(36,4,15),
(37,5,15),
(38,6,15),
(39,4,16),
(40,4,17),
(41,4,18),
(42,4,19),
(43,6,19),
(44,4,20),
(45,6,20),
(46,4,21),
(47,4,22),
(48,4,23),
(49,6,23),
(50,4,24),
(51,6,24),
(52,4,25),
(53,6,25),
(54,4,26),
(55,6,26),
(56,4,27),
(57,6,27),
(58,5,28),
(59,6,28),
(60,5,29),
(61,6,29),
(62,5,30),
(63,6,30),
(64,5,31),
(65,5,32),
(66,5,33),
(67,6,33),
(68,5,34),
(69,6,34),
(70,5,35),
(71,6,35),
(72,6,36),
(73,6,37);
/*!40000 ALTER TABLE `film_species` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_starship`
--

DROP TABLE IF EXISTS `film_starship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_starship` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` bigint(20) unsigned NOT NULL,
  `starship_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_starship_film_id_foreign` (`film_id`),
  KEY `film_starship_starship_id_foreign` (`starship_id`),
  CONSTRAINT `film_starship_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  CONSTRAINT `film_starship_starship_id_foreign` FOREIGN KEY (`starship_id`) REFERENCES `starships` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_starship`
--

LOCK TABLES `film_starship` WRITE;
/*!40000 ALTER TABLE `film_starship` DISABLE KEYS */;
INSERT INTO `film_starship` VALUES
(1,1,2),
(2,3,2),
(3,6,2),
(4,1,3),
(5,2,3),
(6,3,3),
(7,1,5),
(8,1,9),
(9,1,10),
(10,2,10),
(11,3,10),
(12,1,11),
(13,2,11),
(14,3,11),
(15,1,12),
(16,2,12),
(17,3,12),
(18,1,13),
(19,2,15),
(20,3,15),
(21,2,17),
(22,3,17),
(23,2,21),
(24,5,21),
(25,2,22),
(26,3,22),
(27,2,23),
(28,3,23),
(29,3,27),
(30,3,28),
(31,3,29),
(32,4,31),
(33,4,32),
(34,5,32),
(35,6,32),
(36,4,39),
(37,5,39),
(38,4,40),
(39,4,41),
(40,5,43),
(41,5,47),
(42,5,48),
(43,6,48),
(44,5,49),
(45,5,52),
(46,5,58),
(47,6,59),
(48,6,61),
(49,6,63),
(50,6,64),
(51,6,65),
(52,6,66),
(53,6,68),
(54,6,74),
(55,6,75);
/*!40000 ALTER TABLE `film_starship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_vehicle`
--

DROP TABLE IF EXISTS `film_vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_vehicle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` bigint(20) unsigned NOT NULL,
  `vehicle_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_vehicle_film_id_foreign` (`film_id`),
  KEY `film_vehicle_vehicle_id_foreign` (`vehicle_id`),
  CONSTRAINT `film_vehicle_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  CONSTRAINT `film_vehicle_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_vehicle`
--

LOCK TABLES `film_vehicle` WRITE;
/*!40000 ALTER TABLE `film_vehicle` DISABLE KEYS */;
INSERT INTO `film_vehicle` VALUES
(1,1,4),
(2,5,4),
(3,1,6),
(4,1,7),
(5,1,8),
(6,2,8),
(7,3,8),
(8,2,14),
(9,2,16),
(10,3,16),
(11,2,18),
(12,3,18),
(13,2,19),
(14,3,19),
(15,2,20),
(16,3,24),
(17,3,25),
(18,3,26),
(19,3,30),
(20,4,33),
(21,6,33),
(22,4,34),
(23,4,35),
(24,4,36),
(25,4,37),
(26,4,38),
(27,4,42),
(28,5,44),
(29,5,45),
(30,5,46),
(31,5,50),
(32,6,50),
(33,5,51),
(34,5,53),
(35,6,53),
(36,5,54),
(37,5,55),
(38,5,56),
(39,6,56),
(40,5,57),
(41,6,60),
(42,6,62),
(43,6,67),
(44,6,69),
(45,6,70),
(46,6,71),
(47,6,72),
(48,6,73),
(49,6,76);
/*!40000 ALTER TABLE `film_vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `films`
--

DROP TABLE IF EXISTS `films`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `films` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `episode_id` varchar(255) NOT NULL,
  `opening_crawl` text NOT NULL,
  `director` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `release_date` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `edited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `films`
--

LOCK TABLES `films` WRITE;
/*!40000 ALTER TABLE `films` DISABLE KEYS */;
INSERT INTO `films` VALUES
(1,'A New Hope','4','It is a period of civil war.\r\nRebel spaceships, striking\r\nfrom a hidden base, have won\r\ntheir first victory against\r\nthe evil Galactic Empire.\r\n\r\nDuring the battle, Rebel\r\nspies managed to steal secret\r\nplans to the Empire\'s\r\nultimate weapon, the DEATH\r\nSTAR, an armored space\r\nstation with enough power\r\nto destroy an entire planet.\r\n\r\nPursued by the Empire\'s\r\nsinister agents, Princess\r\nLeia races home aboard her\r\nstarship, custodian of the\r\nstolen plans that can save her\r\npeople and restore\r\nfreedom to the galaxy....','George Lucas','Gary Kurtz, Rick McCallum','1977-05-25','2014-12-10T14:23:31.880000Z','2014-12-20T19:49:45.256000Z'),
(2,'The Empire Strikes Back','5','It is a dark time for the\r\nRebellion. Although the Death\r\nStar has been destroyed,\r\nImperial troops have driven the\r\nRebel forces from their hidden\r\nbase and pursued them across\r\nthe galaxy.\r\n\r\nEvading the dreaded Imperial\r\nStarfleet, a group of freedom\r\nfighters led by Luke Skywalker\r\nhas established a new secret\r\nbase on the remote ice world\r\nof Hoth.\r\n\r\nThe evil lord Darth Vader,\r\nobsessed with finding young\r\nSkywalker, has dispatched\r\nthousands of remote probes into\r\nthe far reaches of space....','Irvin Kershner','Gary Kurtz, Rick McCallum','1980-05-17','2014-12-12T11:26:24.656000Z','2014-12-15T13:07:53.386000Z'),
(3,'Return of the Jedi','6','Luke Skywalker has returned to\r\nhis home planet of Tatooine in\r\nan attempt to rescue his\r\nfriend Han Solo from the\r\nclutches of the vile gangster\r\nJabba the Hutt.\r\n\r\nLittle does Luke know that the\r\nGALACTIC EMPIRE has secretly\r\nbegun construction on a new\r\narmored space station even\r\nmore powerful than the first\r\ndreaded Death Star.\r\n\r\nWhen completed, this ultimate\r\nweapon will spell certain doom\r\nfor the small band of rebels\r\nstruggling to restore freedom\r\nto the galaxy...','Richard Marquand','Howard G. Kazanjian, George Lucas, Rick McCallum','1983-05-25','2014-12-18T10:39:33.255000Z','2014-12-20T09:48:37.462000Z'),
(4,'The Phantom Menace','1','Turmoil has engulfed the\r\nGalactic Republic. The taxation\r\nof trade routes to outlying star\r\nsystems is in dispute.\r\n\r\nHoping to resolve the matter\r\nwith a blockade of deadly\r\nbattleships, the greedy Trade\r\nFederation has stopped all\r\nshipping to the small planet\r\nof Naboo.\r\n\r\nWhile the Congress of the\r\nRepublic endlessly debates\r\nthis alarming chain of events,\r\nthe Supreme Chancellor has\r\nsecretly dispatched two Jedi\r\nKnights, the guardians of\r\npeace and justice in the\r\ngalaxy, to settle the conflict....','George Lucas','Rick McCallum','1999-05-19','2014-12-19T16:52:55.740000Z','2014-12-20T10:54:07.216000Z'),
(5,'Attack of the Clones','2','There is unrest in the Galactic\r\nSenate. Several thousand solar\r\nsystems have declared their\r\nintentions to leave the Republic.\r\n\r\nThis separatist movement,\r\nunder the leadership of the\r\nmysterious Count Dooku, has\r\nmade it difficult for the limited\r\nnumber of Jedi Knights to maintain \r\npeace and order in the galaxy.\r\n\r\nSenator Amidala, the former\r\nQueen of Naboo, is returning\r\nto the Galactic Senate to vote\r\non the critical issue of creating\r\nan ARMY OF THE REPUBLIC\r\nto assist the overwhelmed\r\nJedi....','George Lucas','Rick McCallum','2002-05-16','2014-12-20T10:57:57.886000Z','2014-12-20T20:18:48.516000Z'),
(6,'Revenge of the Sith','3','War! The Republic is crumbling\r\nunder attacks by the ruthless\r\nSith Lord, Count Dooku.\r\nThere are heroes on both sides.\r\nEvil is everywhere.\r\n\r\nIn a stunning move, the\r\nfiendish droid leader, General\r\nGrievous, has swept into the\r\nRepublic capital and kidnapped\r\nChancellor Palpatine, leader of\r\nthe Galactic Senate.\r\n\r\nAs the Separatist Droid Army\r\nattempts to flee the besieged\r\ncapital with their valuable\r\nhostage, two Jedi Knights lead a\r\ndesperate mission to rescue the\r\ncaptive Chancellor....','George Lucas','Rick McCallum','2005-05-19','2014-12-20T18:49:38.403000Z','2014-12-20T20:47:52.073000Z');
/*!40000 ALTER TABLE `films` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(15,'2019_12_14_000001_create_personal_access_tokens_table',1),
(16,'2023_06_01_111016_create_model_tables',2),
(17,'2023_06_01_113202_create_pivot_tables',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birth_year` varchar(255) NOT NULL,
  `eye_color` varchar(255) NOT NULL,
  `hair_color` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `mass` varchar(255) NOT NULL,
  `skin_color` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `edited` varchar(255) NOT NULL,
  `homeworld_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_homeworld_id_foreign` (`homeworld_id`),
  CONSTRAINT `people_homeworld_id_foreign` FOREIGN KEY (`homeworld_id`) REFERENCES `planets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES
(1,'Luke Skywalker','19BBY','blue','blond','172','77','fair','2014-12-09T13:50:51.644000Z','2014-12-20T21:17:56.891000Z',1),
(2,'C-3PO','112BBY','yellow','n/a','167','75','gold','2014-12-10T15:10:51.357000Z','2014-12-20T21:17:50.309000Z',1),
(3,'R2-D2','33BBY','red','n/a','96','32','white, blue','2014-12-10T15:11:50.376000Z','2014-12-20T21:17:50.311000Z',8),
(4,'Darth Vader','41.9BBY','yellow','none','202','136','white','2014-12-10T15:18:20.704000Z','2014-12-20T21:17:50.313000Z',1),
(5,'Leia Organa','19BBY','brown','brown','150','49','light','2014-12-10T15:20:09.791000Z','2014-12-20T21:17:50.315000Z',2),
(6,'Owen Lars','52BBY','blue','brown, grey','178','120','light','2014-12-10T15:52:14.024000Z','2014-12-20T21:17:50.317000Z',1),
(7,'Beru Whitesun lars','47BBY','blue','brown','165','75','light','2014-12-10T15:53:41.121000Z','2014-12-20T21:17:50.319000Z',1),
(8,'R5-D4','unknown','red','n/a','97','32','white, red','2014-12-10T15:57:50.959000Z','2014-12-20T21:17:50.321000Z',1),
(9,'Biggs Darklighter','24BBY','brown','black','183','84','light','2014-12-10T15:59:50.509000Z','2014-12-20T21:17:50.323000Z',1),
(10,'Obi-Wan Kenobi','57BBY','blue-gray','auburn, white','182','77','fair','2014-12-10T16:16:29.192000Z','2014-12-20T21:17:50.325000Z',20),
(11,'Anakin Skywalker','41.9BBY','blue','blond','188','84','fair','2014-12-10T16:20:44.310000Z','2014-12-20T21:17:50.327000Z',1),
(12,'Wilhuff Tarkin','64BBY','blue','auburn, grey','180','unknown','fair','2014-12-10T16:26:56.138000Z','2014-12-20T21:17:50.330000Z',21),
(13,'Chewbacca','200BBY','blue','brown','228','112','unknown','2014-12-10T16:42:45.066000Z','2014-12-20T21:17:50.332000Z',14),
(14,'Han Solo','29BBY','brown','brown','180','80','fair','2014-12-10T16:49:14.582000Z','2014-12-20T21:17:50.334000Z',22),
(15,'Greedo','44BBY','black','n/a','173','74','green','2014-12-10T17:03:30.334000Z','2014-12-20T21:17:50.336000Z',23),
(16,'Jabba Desilijic Tiure','600BBY','orange','n/a','175','1,358','green-tan, brown','2014-12-10T17:11:31.638000Z','2014-12-20T21:17:50.338000Z',24),
(18,'Wedge Antilles','21BBY','hazel','brown','170','77','fair','2014-12-12T11:08:06.469000Z','2014-12-20T21:17:50.341000Z',22),
(19,'Jek Tono Porkins','unknown','blue','brown','180','110','fair','2014-12-12T11:16:56.569000Z','2014-12-20T21:17:50.343000Z',26),
(20,'Yoda','896BBY','brown','white','66','17','green','2014-12-15T12:26:01.042000Z','2014-12-20T21:17:50.345000Z',28),
(21,'Palpatine','82BBY','yellow','grey','170','75','pale','2014-12-15T12:48:05.971000Z','2014-12-20T21:17:50.347000Z',8),
(22,'Boba Fett','31.5BBY','brown','black','183','78.2','fair','2014-12-15T12:49:32.457000Z','2014-12-20T21:17:50.349000Z',10),
(23,'IG-88','15BBY','red','none','200','140','metal','2014-12-15T12:51:10.076000Z','2014-12-20T21:17:50.351000Z',28),
(24,'Bossk','53BBY','red','none','190','113','green','2014-12-15T12:53:49.297000Z','2014-12-20T21:17:50.355000Z',29),
(25,'Lando Calrissian','31BBY','brown','black','177','79','dark','2014-12-15T12:56:32.683000Z','2014-12-20T21:17:50.357000Z',30),
(26,'Lobot','37BBY','blue','none','175','79','light','2014-12-15T13:01:57.178000Z','2014-12-20T21:17:50.359000Z',6),
(27,'Ackbar','41BBY','orange','none','180','83','brown mottle','2014-12-18T11:07:50.584000Z','2014-12-20T21:17:50.362000Z',31),
(28,'Mon Mothma','48BBY','blue','auburn','150','unknown','fair','2014-12-18T11:12:38.895000Z','2014-12-20T21:17:50.364000Z',32),
(29,'Arvel Crynyd','unknown','brown','brown','unknown','unknown','fair','2014-12-18T11:16:33.020000Z','2014-12-20T21:17:50.367000Z',28),
(30,'Wicket Systri Warrick','8BBY','brown','brown','88','20','brown','2014-12-18T11:21:58.954000Z','2014-12-20T21:17:50.369000Z',7),
(31,'Nien Nunb','unknown','black','none','160','68','grey','2014-12-18T11:26:18.541000Z','2014-12-20T21:17:50.371000Z',33),
(32,'Qui-Gon Jinn','92BBY','blue','brown','193','89','fair','2014-12-19T16:54:53.618000Z','2014-12-20T21:17:50.375000Z',28),
(33,'Nute Gunray','unknown','red','none','191','90','mottled green','2014-12-19T17:05:57.357000Z','2014-12-20T21:17:50.377000Z',18),
(34,'Finis Valorum','91BBY','blue','blond','170','unknown','fair','2014-12-19T17:21:45.915000Z','2014-12-20T21:17:50.379000Z',9),
(35,'Padmé Amidala','46BBY','brown','brown','185','45','light','2014-12-19T17:28:26.926000Z','2014-12-20T21:17:50.381000Z',8),
(36,'Jar Jar Binks','52BBY','orange','none','196','66','orange','2014-12-19T17:29:32.489000Z','2014-12-20T21:17:50.383000Z',8),
(37,'Roos Tarpals','unknown','orange','none','224','82','grey','2014-12-19T17:32:56.741000Z','2014-12-20T21:17:50.385000Z',8),
(38,'Rugor Nass','unknown','orange','none','206','unknown','green','2014-12-19T17:33:38.909000Z','2014-12-20T21:17:50.388000Z',8),
(39,'Ric Olié','unknown','blue','brown','183','unknown','fair','2014-12-19T17:45:01.522000Z','2014-12-20T21:17:50.392000Z',8),
(40,'Watto','unknown','yellow','black','137','unknown','blue, grey','2014-12-19T17:48:54.647000Z','2014-12-20T21:17:50.395000Z',34),
(41,'Sebulba','unknown','orange','none','112','40','grey, red','2014-12-19T17:53:02.586000Z','2014-12-20T21:17:50.397000Z',35),
(42,'Quarsh Panaka','62BBY','brown','black','183','unknown','dark','2014-12-19T17:55:43.348000Z','2014-12-20T21:17:50.399000Z',8),
(43,'Shmi Skywalker','72BBY','brown','black','163','unknown','fair','2014-12-19T17:57:41.191000Z','2014-12-20T21:17:50.401000Z',1),
(44,'Darth Maul','54BBY','yellow','none','175','80','red','2014-12-19T18:00:41.929000Z','2014-12-20T21:17:50.403000Z',36),
(45,'Bib Fortuna','unknown','pink','none','180','unknown','pale','2014-12-20T09:47:02.512000Z','2014-12-20T21:17:50.407000Z',37),
(46,'Ayla Secura','48BBY','hazel','none','178','55','blue','2014-12-20T09:48:01.172000Z','2014-12-20T21:17:50.409000Z',37),
(47,'Ratts Tyerel','unknown','unknown','none','79','15','grey, blue','2014-12-20T09:53:15.086000Z','2014-12-20T21:17:50.410000Z',38),
(48,'Dud Bolt','unknown','yellow','none','94','45','blue, grey','2014-12-20T09:57:31.858000Z','2014-12-20T21:17:50.414000Z',39),
(49,'Gasgano','unknown','black','none','122','unknown','white, blue','2014-12-20T10:02:12.223000Z','2014-12-20T21:17:50.416000Z',40),
(50,'Ben Quadinaros','unknown','orange','none','163','65','grey, green, yellow','2014-12-20T10:08:33.777000Z','2014-12-20T21:17:50.417000Z',41),
(51,'Mace Windu','72BBY','brown','none','188','84','dark','2014-12-20T10:12:30.846000Z','2014-12-20T21:17:50.420000Z',42),
(52,'Ki-Adi-Mundi','92BBY','yellow','white','198','82','pale','2014-12-20T10:15:32.293000Z','2014-12-20T21:17:50.422000Z',43),
(53,'Kit Fisto','unknown','black','none','196','87','green','2014-12-20T10:18:57.202000Z','2014-12-20T21:17:50.424000Z',44),
(54,'Eeth Koth','unknown','brown','black','171','unknown','brown','2014-12-20T10:26:47.902000Z','2014-12-20T21:17:50.427000Z',45),
(55,'Adi Gallia','unknown','blue','none','184','50','dark','2014-12-20T10:29:11.661000Z','2014-12-20T21:17:50.432000Z',9),
(56,'Saesee Tiin','unknown','orange','none','188','unknown','pale','2014-12-20T10:32:11.669000Z','2014-12-20T21:17:50.434000Z',47),
(57,'Yarael Poof','unknown','yellow','none','264','unknown','white','2014-12-20T10:34:48.725000Z','2014-12-20T21:17:50.437000Z',48),
(58,'Plo Koon','22BBY','black','none','188','80','orange','2014-12-20T10:49:19.859000Z','2014-12-20T21:17:50.439000Z',49),
(59,'Mas Amedda','unknown','blue','none','196','unknown','blue','2014-12-20T10:53:26.457000Z','2014-12-20T21:17:50.442000Z',50),
(60,'Gregar Typho','unknown','brown','black','185','85','dark','2014-12-20T11:10:10.381000Z','2014-12-20T21:17:50.445000Z',8),
(61,'Cordé','unknown','brown','brown','157','unknown','light','2014-12-20T11:11:39.630000Z','2014-12-20T21:17:50.449000Z',8),
(62,'Cliegg Lars','82BBY','blue','brown','183','unknown','fair','2014-12-20T15:59:03.958000Z','2014-12-20T21:17:50.451000Z',1),
(63,'Poggle the Lesser','unknown','yellow','none','183','80','green','2014-12-20T16:40:43.977000Z','2014-12-20T21:17:50.453000Z',11),
(64,'Luminara Unduli','58BBY','blue','black','170','56.2','yellow','2014-12-20T16:45:53.668000Z','2014-12-20T21:17:50.455000Z',51),
(65,'Barriss Offee','40BBY','blue','black','166','50','yellow','2014-12-20T16:46:40.440000Z','2014-12-20T21:17:50.457000Z',51),
(66,'Dormé','unknown','brown','brown','165','unknown','light','2014-12-20T16:49:14.640000Z','2014-12-20T21:17:50.460000Z',8),
(67,'Dooku','102BBY','brown','white','193','80','fair','2014-12-20T16:52:14.726000Z','2014-12-20T21:17:50.462000Z',52),
(68,'Bail Prestor Organa','67BBY','brown','black','191','unknown','tan','2014-12-20T16:53:08.575000Z','2014-12-20T21:17:50.463000Z',2),
(69,'Jango Fett','66BBY','brown','black','183','79','tan','2014-12-20T16:54:41.620000Z','2014-12-20T21:17:50.465000Z',53),
(70,'Zam Wesell','unknown','yellow','blonde','168','55','fair, green, yellow','2014-12-20T16:57:44.471000Z','2014-12-20T21:17:50.468000Z',54),
(71,'Dexter Jettster','unknown','yellow','none','198','102','brown','2014-12-20T17:28:27.248000Z','2014-12-20T21:17:50.470000Z',55),
(72,'Lama Su','unknown','black','none','229','88','grey','2014-12-20T17:30:50.416000Z','2014-12-20T21:17:50.473000Z',10),
(73,'Taun We','unknown','black','none','213','unknown','grey','2014-12-20T17:31:21.195000Z','2014-12-20T21:17:50.474000Z',10),
(74,'Jocasta Nu','unknown','blue','white','167','unknown','fair','2014-12-20T17:32:51.996000Z','2014-12-20T21:17:50.476000Z',9),
(75,'R4-P17','unknown','red, blue','none','96','unknown','silver, red','2014-12-20T17:43:36.409000Z','2014-12-20T21:17:50.478000Z',28),
(76,'Wat Tambor','unknown','unknown','none','193','48','green, grey','2014-12-20T17:53:52.607000Z','2014-12-20T21:17:50.481000Z',56),
(77,'San Hill','unknown','gold','none','191','unknown','grey','2014-12-20T17:58:17.049000Z','2014-12-20T21:17:50.484000Z',57),
(78,'Shaak Ti','unknown','black','none','178','57','red, blue, white','2014-12-20T18:44:01.103000Z','2014-12-20T21:17:50.486000Z',58),
(79,'Grievous','unknown','green, yellow','none','216','159','brown, white','2014-12-20T19:43:53.348000Z','2014-12-20T21:17:50.488000Z',59),
(80,'Tarfful','unknown','blue','brown','234','136','brown','2014-12-20T19:46:34.209000Z','2014-12-20T21:17:50.491000Z',14),
(81,'Raymus Antilles','unknown','brown','brown','188','79','light','2014-12-20T19:49:35.583000Z','2014-12-20T21:17:50.493000Z',2),
(82,'Sly Moore','unknown','white','none','178','48','pale','2014-12-20T20:18:37.619000Z','2014-12-20T21:17:50.496000Z',60),
(83,'Tion Medon','unknown','black','none','206','80','grey','2014-12-20T20:35:04.260000Z','2014-12-20T21:17:50.498000Z',12);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_species`
--

DROP TABLE IF EXISTS `person_species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person_species` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` bigint(20) unsigned NOT NULL,
  `species_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_species_person_id_foreign` (`person_id`),
  KEY `person_species_species_id_foreign` (`species_id`),
  CONSTRAINT `person_species_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `person_species_species_id_foreign` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_species`
--

LOCK TABLES `person_species` WRITE;
/*!40000 ALTER TABLE `person_species` DISABLE KEYS */;
INSERT INTO `person_species` VALUES
(1,2,2),
(2,3,2),
(3,8,2),
(4,13,3),
(5,15,4),
(6,16,5),
(7,20,6),
(8,23,2),
(9,24,7),
(10,27,8),
(11,30,9),
(12,31,10),
(13,33,11),
(14,36,12),
(15,37,12),
(16,38,12),
(17,40,13),
(18,41,14),
(19,44,22),
(20,45,15),
(21,46,15),
(22,47,16),
(23,48,17),
(24,49,18),
(25,50,19),
(26,52,20),
(27,53,21),
(28,54,22),
(29,55,23),
(30,56,24),
(31,57,25),
(32,58,26),
(33,59,27),
(34,63,28),
(35,64,29),
(36,65,29),
(37,66,1),
(38,67,1),
(39,68,1),
(40,70,30),
(41,71,31),
(42,72,32),
(43,73,32),
(44,74,1),
(45,76,33),
(46,77,34),
(47,78,35),
(48,79,36),
(49,80,3),
(50,83,37);
/*!40000 ALTER TABLE `person_species` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_starship`
--

DROP TABLE IF EXISTS `person_starship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person_starship` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` bigint(20) unsigned NOT NULL,
  `starship_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_starship_person_id_foreign` (`person_id`),
  KEY `person_starship_starship_id_foreign` (`starship_id`),
  CONSTRAINT `person_starship_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `person_starship_starship_id_foreign` FOREIGN KEY (`starship_id`) REFERENCES `starships` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_starship`
--

LOCK TABLES `person_starship` WRITE;
/*!40000 ALTER TABLE `person_starship` DISABLE KEYS */;
INSERT INTO `person_starship` VALUES
(1,1,12),
(2,1,22),
(3,4,13),
(4,9,12),
(5,10,48),
(6,10,59),
(7,10,64),
(8,10,65),
(9,10,74),
(10,11,39),
(11,11,59),
(12,11,65),
(13,13,10),
(14,13,22),
(15,14,10),
(16,14,22),
(17,18,12),
(18,19,12),
(19,22,21),
(20,25,10),
(21,29,28),
(22,31,10),
(23,35,39),
(24,35,49),
(25,35,64),
(26,39,40),
(27,44,41),
(28,58,48),
(29,60,39),
(30,79,74);
/*!40000 ALTER TABLE `person_starship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_vehicle`
--

DROP TABLE IF EXISTS `person_vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person_vehicle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` bigint(20) unsigned NOT NULL,
  `vehicle_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_vehicle_person_id_foreign` (`person_id`),
  KEY `person_vehicle_vehicle_id_foreign` (`vehicle_id`),
  CONSTRAINT `person_vehicle_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `person_vehicle_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_vehicle`
--

LOCK TABLES `person_vehicle` WRITE;
/*!40000 ALTER TABLE `person_vehicle` DISABLE KEYS */;
INSERT INTO `person_vehicle` VALUES
(1,1,14),
(2,1,30),
(3,5,30),
(4,10,38),
(5,11,44),
(6,11,46),
(7,13,19),
(8,18,14),
(9,32,38),
(10,44,42),
(11,67,55),
(12,70,45),
(13,79,60);
/*!40000 ALTER TABLE `person_vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planets`
--

DROP TABLE IF EXISTS `planets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rotation_period` varchar(255) NOT NULL,
  `orbital_period` varchar(255) NOT NULL,
  `diameter` varchar(255) NOT NULL,
  `climate` varchar(255) NOT NULL,
  `gravity` varchar(255) NOT NULL,
  `terrain` varchar(255) NOT NULL,
  `surface_water` varchar(255) NOT NULL,
  `population` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `edited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planets`
--

LOCK TABLES `planets` WRITE;
/*!40000 ALTER TABLE `planets` DISABLE KEYS */;
INSERT INTO `planets` VALUES
(1,'Tatooine','23','304','10465','arid','1 standard','desert','1','200000','2014-12-09T13:50:49.641000Z','2014-12-20T20:58:18.411000Z'),
(2,'Alderaan','24','364','12500','temperate','1 standard','grasslands, mountains','40','2000000000','2014-12-10T11:35:48.479000Z','2014-12-20T20:58:18.420000Z'),
(3,'Yavin IV','24','4818','10200','temperate, tropical','1 standard','jungle, rainforests','8','1000','2014-12-10T11:37:19.144000Z','2014-12-20T20:58:18.421000Z'),
(4,'Hoth','23','549','7200','frozen','1.1 standard','tundra, ice caves, mountain ranges','100','unknown','2014-12-10T11:39:13.934000Z','2014-12-20T20:58:18.423000Z'),
(5,'Dagobah','23','341','8900','murky','N/A','swamp, jungles','8','unknown','2014-12-10T11:42:22.590000Z','2014-12-20T20:58:18.425000Z'),
(6,'Bespin','12','5110','118000','temperate','1.5 (surface), 1 standard (Cloud City)','gas giant','0','6000000','2014-12-10T11:43:55.240000Z','2014-12-20T20:58:18.427000Z'),
(7,'Endor','18','402','4900','temperate','0.85 standard','forests, mountains, lakes','8','30000000','2014-12-10T11:50:29.349000Z','2014-12-20T20:58:18.429000Z'),
(8,'Naboo','26','312','12120','temperate','1 standard','grassy hills, swamps, forests, mountains','12','4500000000','2014-12-10T11:52:31.066000Z','2014-12-20T20:58:18.430000Z'),
(9,'Coruscant','24','368','12240','temperate','1 standard','cityscape, mountains','unknown','1000000000000','2014-12-10T11:54:13.921000Z','2014-12-20T20:58:18.432000Z'),
(10,'Kamino','27','463','19720','temperate','1 standard','ocean','100','1000000000','2014-12-10T12:45:06.577000Z','2014-12-20T20:58:18.434000Z'),
(11,'Geonosis','30','256','11370','temperate, arid','0.9 standard','rock, desert, mountain, barren','5','100000000000','2014-12-10T12:47:22.350000Z','2014-12-20T20:58:18.437000Z'),
(12,'Utapau','27','351','12900','temperate, arid, windy','1 standard','scrublands, savanna, canyons, sinkholes','0.9','95000000','2014-12-10T12:49:01.491000Z','2014-12-20T20:58:18.439000Z'),
(13,'Mustafar','36','412','4200','hot','1 standard','volcanoes, lava rivers, mountains, caves','0','20000','2014-12-10T12:50:16.526000Z','2014-12-20T20:58:18.440000Z'),
(14,'Kashyyyk','26','381','12765','tropical','1 standard','jungle, forests, lakes, rivers','60','45000000','2014-12-10T13:32:00.124000Z','2014-12-20T20:58:18.442000Z'),
(15,'Polis Massa','24','590','0','artificial temperate ','0.56 standard','airless asteroid','0','1000000','2014-12-10T13:33:46.405000Z','2014-12-20T20:58:18.444000Z'),
(16,'Mygeeto','12','167','10088','frigid','1 standard','glaciers, mountains, ice canyons','unknown','19000000','2014-12-10T13:43:39.139000Z','2014-12-20T20:58:18.446000Z'),
(17,'Felucia','34','231','9100','hot, humid','0.75 standard','fungus forests','unknown','8500000','2014-12-10T13:44:50.397000Z','2014-12-20T20:58:18.447000Z'),
(18,'Cato Neimoidia','25','278','0','temperate, moist','1 standard','mountains, fields, forests, rock arches','unknown','10000000','2014-12-10T13:46:28.704000Z','2014-12-20T20:58:18.449000Z'),
(19,'Saleucami','26','392','14920','hot','unknown','caves, desert, mountains, volcanoes','unknown','1400000000','2014-12-10T13:47:46.874000Z','2014-12-20T20:58:18.450000Z'),
(20,'Stewjon','unknown','unknown','0','temperate','1 standard','grass','unknown','unknown','2014-12-10T16:16:26.566000Z','2014-12-20T20:58:18.452000Z'),
(21,'Eriadu','24','360','13490','polluted','1 standard','cityscape','unknown','22000000000','2014-12-10T16:26:54.384000Z','2014-12-20T20:58:18.454000Z'),
(22,'Corellia','25','329','11000','temperate','1 standard','plains, urban, hills, forests','70','3000000000','2014-12-10T16:49:12.453000Z','2014-12-20T20:58:18.456000Z'),
(23,'Rodia','29','305','7549','hot','1 standard','jungles, oceans, urban, swamps','60','1300000000','2014-12-10T17:03:28.110000Z','2014-12-20T20:58:18.458000Z'),
(24,'Nal Hutta','87','413','12150','temperate','1 standard','urban, oceans, swamps, bogs','unknown','7000000000','2014-12-10T17:11:29.452000Z','2014-12-20T20:58:18.460000Z'),
(25,'Dantooine','25','378','9830','temperate','1 standard','oceans, savannas, mountains, grasslands','unknown','1000','2014-12-10T17:23:29.896000Z','2014-12-20T20:58:18.461000Z'),
(26,'Bestine IV','26','680','6400','temperate','unknown','rocky islands, oceans','98','62000000','2014-12-12T11:16:55.078000Z','2014-12-20T20:58:18.463000Z'),
(27,'Ord Mantell','26','334','14050','temperate','1 standard','plains, seas, mesas','10','4000000000','2014-12-15T12:23:41.661000Z','2014-12-20T20:58:18.464000Z'),
(28,'unknown','0','0','0','unknown','unknown','unknown','unknown','unknown','2014-12-15T12:25:59.569000Z','2014-12-20T20:58:18.466000Z'),
(29,'Trandosha','25','371','0','arid','0.62 standard','mountains, seas, grasslands, deserts','unknown','42000000','2014-12-15T12:53:47.695000Z','2014-12-20T20:58:18.468000Z'),
(30,'Socorro','20','326','0','arid','1 standard','deserts, mountains','unknown','300000000','2014-12-15T12:56:31.121000Z','2014-12-20T20:58:18.469000Z'),
(31,'Mon Cala','21','398','11030','temperate','1','oceans, reefs, islands','100','27000000000','2014-12-18T11:07:01.792000Z','2014-12-20T20:58:18.471000Z'),
(32,'Chandrila','20','368','13500','temperate','1','plains, forests','40','1200000000','2014-12-18T11:11:51.872000Z','2014-12-20T20:58:18.472000Z'),
(33,'Sullust','20','263','12780','superheated','1','mountains, volcanoes, rocky deserts','5','18500000000','2014-12-18T11:25:40.243000Z','2014-12-20T20:58:18.474000Z'),
(34,'Toydaria','21','184','7900','temperate','1','swamps, lakes','unknown','11000000','2014-12-19T17:47:54.403000Z','2014-12-20T20:58:18.476000Z'),
(35,'Malastare','26','201','18880','arid, temperate, tropical','1.56','swamps, deserts, jungles, mountains','unknown','2000000000','2014-12-19T17:52:13.106000Z','2014-12-20T20:58:18.478000Z'),
(36,'Dathomir','24','491','10480','temperate','0.9','forests, deserts, savannas','unknown','5200','2014-12-19T18:00:40.142000Z','2014-12-20T20:58:18.480000Z'),
(37,'Ryloth','30','305','10600','temperate, arid, subartic','1','mountains, valleys, deserts, tundra','5','1500000000','2014-12-20T09:46:25.740000Z','2014-12-20T20:58:18.481000Z'),
(38,'Aleen Minor','unknown','unknown','unknown','unknown','unknown','unknown','unknown','unknown','2014-12-20T09:52:23.452000Z','2014-12-20T20:58:18.483000Z'),
(39,'Vulpter','22','391','14900','temperate, artic','1','urban, barren','unknown','421000000','2014-12-20T09:56:58.874000Z','2014-12-20T20:58:18.485000Z'),
(40,'Troiken','unknown','unknown','unknown','unknown','unknown','desert, tundra, rainforests, mountains','unknown','unknown','2014-12-20T10:01:37.395000Z','2014-12-20T20:58:18.487000Z'),
(41,'Tund','48','1770','12190','unknown','unknown','barren, ash','unknown','0','2014-12-20T10:07:29.578000Z','2014-12-20T20:58:18.489000Z'),
(42,'Haruun Kal','25','383','10120','temperate','0.98','toxic cloudsea, plateaus, volcanoes','unknown','705300','2014-12-20T10:12:28.980000Z','2014-12-20T20:58:18.491000Z'),
(43,'Cerea','27','386','unknown','temperate','1','verdant','20','450000000','2014-12-20T10:14:48.178000Z','2014-12-20T20:58:18.493000Z'),
(44,'Glee Anselm','33','206','15600','tropical, temperate','1','lakes, islands, swamps, seas','80','500000000','2014-12-20T10:18:26.110000Z','2014-12-20T20:58:18.495000Z'),
(45,'Iridonia','29','413','unknown','unknown','unknown','rocky canyons, acid pools','unknown','unknown','2014-12-20T10:26:05.788000Z','2014-12-20T20:58:18.497000Z'),
(46,'Tholoth','unknown','unknown','unknown','unknown','unknown','unknown','unknown','unknown','2014-12-20T10:28:31.117000Z','2014-12-20T20:58:18.498000Z'),
(47,'Iktotch','22','481','unknown','arid, rocky, windy','1','rocky','unknown','unknown','2014-12-20T10:31:32.413000Z','2014-12-20T20:58:18.500000Z'),
(48,'Quermia','unknown','unknown','unknown','unknown','unknown','unknown','unknown','unknown','2014-12-20T10:34:08.249000Z','2014-12-20T20:58:18.502000Z'),
(49,'Dorin','22','409','13400','temperate','1','unknown','unknown','unknown','2014-12-20T10:48:36.141000Z','2014-12-20T20:58:18.504000Z'),
(50,'Champala','27','318','unknown','temperate','1','oceans, rainforests, plateaus','unknown','3500000000','2014-12-20T10:52:51.524000Z','2014-12-20T20:58:18.506000Z'),
(51,'Mirial','unknown','unknown','unknown','unknown','unknown','deserts','unknown','unknown','2014-12-20T16:44:46.318000Z','2014-12-20T20:58:18.508000Z'),
(52,'Serenno','unknown','unknown','unknown','unknown','unknown','rainforests, rivers, mountains','unknown','unknown','2014-12-20T16:52:13.357000Z','2014-12-20T20:58:18.510000Z'),
(53,'Concord Dawn','unknown','unknown','unknown','unknown','unknown','jungles, forests, deserts','unknown','unknown','2014-12-20T16:54:39.909000Z','2014-12-20T20:58:18.512000Z'),
(54,'Zolan','unknown','unknown','unknown','unknown','unknown','unknown','unknown','unknown','2014-12-20T16:56:37.250000Z','2014-12-20T20:58:18.514000Z'),
(55,'Ojom','unknown','unknown','unknown','frigid','unknown','oceans, glaciers','100','500000000','2014-12-20T17:27:41.286000Z','2014-12-20T20:58:18.516000Z'),
(56,'Skako','27','384','unknown','temperate','1','urban, vines','unknown','500000000000','2014-12-20T17:50:47.864000Z','2014-12-20T20:58:18.517000Z'),
(57,'Muunilinst','28','412','13800','temperate','1','plains, forests, hills, mountains','25','5000000000','2014-12-20T17:57:47.420000Z','2014-12-20T20:58:18.519000Z'),
(58,'Shili','unknown','unknown','unknown','temperate','1','cities, savannahs, seas, plains','unknown','unknown','2014-12-20T18:43:14.049000Z','2014-12-20T20:58:18.521000Z'),
(59,'Kalee','23','378','13850','arid, temperate, tropical','1','rainforests, cliffs, canyons, seas','unknown','4000000000','2014-12-20T19:43:51.278000Z','2014-12-20T20:58:18.523000Z'),
(60,'Umbara','unknown','unknown','unknown','unknown','unknown','unknown','unknown','unknown','2014-12-20T20:18:36.256000Z','2014-12-20T20:58:18.525000Z');
/*!40000 ALTER TABLE `planets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `species`
--

DROP TABLE IF EXISTS `species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `species` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `classification` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `average_height` varchar(255) NOT NULL,
  `average_lifespan` varchar(255) NOT NULL,
  `eye_colors` varchar(255) NOT NULL,
  `hair_colors` varchar(255) NOT NULL,
  `skin_colors` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `edited` varchar(255) NOT NULL,
  `homeworld_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `species_homeworld_id_foreign` (`homeworld_id`),
  CONSTRAINT `species_homeworld_id_foreign` FOREIGN KEY (`homeworld_id`) REFERENCES `planets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `species`
--

LOCK TABLES `species` WRITE;
/*!40000 ALTER TABLE `species` DISABLE KEYS */;
INSERT INTO `species` VALUES
(1,'Human','mammal','sentient','180','120','brown, blue, green, hazel, grey, amber','blonde, brown, black, red','caucasian, black, asian, hispanic','Galactic Basic','2014-12-10T13:52:11.567000Z','2014-12-20T21:36:42.136000Z',9),
(2,'Droid','artificial','sentient','n/a','indefinite','n/a','n/a','n/a','n/a','2014-12-10T15:16:16.259000Z','2014-12-20T21:36:42.139000Z',NULL),
(3,'Wookie','mammal','sentient','210','400','blue, green, yellow, brown, golden, red','black, brown','gray','Shyriiwook','2014-12-10T16:44:31.486000Z','2014-12-20T21:36:42.142000Z',14),
(4,'Rodian','sentient','reptilian','170','unknown','black','n/a','green, blue','Galatic Basic','2014-12-10T17:05:26.471000Z','2014-12-20T21:36:42.144000Z',23),
(5,'Hutt','gastropod','sentient','300','1000','yellow, red','n/a','green, brown, tan','Huttese','2014-12-10T17:12:50.410000Z','2014-12-20T21:36:42.146000Z',24),
(6,'Yoda\'s species','mammal','sentient','66','900','brown, green, yellow','brown, white','green, yellow','Galactic basic','2014-12-15T12:27:22.877000Z','2014-12-20T21:36:42.148000Z',28),
(7,'Trandoshan','reptile','sentient','200','unknown','yellow, orange','none','brown, green','Dosh','2014-12-15T13:07:47.704000Z','2014-12-20T21:36:42.151000Z',29),
(8,'Mon Calamari','amphibian','sentient','160','unknown','yellow','none','red, blue, brown, magenta','Mon Calamarian','2014-12-18T11:09:52.263000Z','2014-12-20T21:36:42.153000Z',31),
(9,'Ewok','mammal','sentient','100','unknown','orange, brown','white, brown, black','brown','Ewokese','2014-12-18T11:22:00.285000Z','2014-12-20T21:36:42.155000Z',7),
(10,'Sullustan','mammal','sentient','180','unknown','black','none','pale','Sullutese','2014-12-18T11:26:20.103000Z','2014-12-20T21:36:42.157000Z',33),
(11,'Neimodian','unknown','sentient','180','unknown','red, pink','none','grey, green','Neimoidia','2014-12-19T17:07:31.319000Z','2014-12-20T21:36:42.160000Z',18),
(12,'Gungan','amphibian','sentient','190','unknown','orange','none','brown, green','Gungan basic','2014-12-19T17:30:37.341000Z','2014-12-20T21:36:42.163000Z',8),
(13,'Toydarian','mammal','sentient','120','91','yellow','none','blue, green, grey','Toydarian','2014-12-19T17:48:56.893000Z','2014-12-20T21:36:42.165000Z',34),
(14,'Dug','mammal','sentient','100','unknown','yellow, blue','none','brown, purple, grey, red','Dugese','2014-12-19T17:53:11.214000Z','2014-12-20T21:36:42.167000Z',35),
(15,'Twi\'lek','mammals','sentient','200','unknown','blue, brown, orange, pink','none','orange, yellow, blue, green, pink, purple, tan','Twi\'leki','2014-12-20T09:48:02.406000Z','2014-12-20T21:36:42.169000Z',37),
(16,'Aleena','reptile','sentient','80','79','unknown','none','blue, gray','Aleena','2014-12-20T09:53:16.481000Z','2014-12-20T21:36:42.171000Z',38),
(17,'Vulptereen','unknown','sentient','100','unknown','yellow','none','grey','vulpterish','2014-12-20T09:57:33.128000Z','2014-12-20T21:36:42.173000Z',39),
(18,'Xexto','unknown','sentient','125','unknown','black','none','grey, yellow, purple','Xextese','2014-12-20T10:02:13.915000Z','2014-12-20T21:36:42.175000Z',40),
(19,'Toong','unknown','sentient','200','unknown','orange','none','grey, green, yellow','Tundan','2014-12-20T10:08:36.795000Z','2014-12-20T21:36:42.177000Z',41),
(20,'Cerean','mammal','sentient','200','unknown','hazel','red, blond, black, white','pale pink','Cerean','2014-12-20T10:15:33.765000Z','2014-12-20T21:36:42.179000Z',43),
(21,'Nautolan','amphibian','sentient','180','70','black','none','green, blue, brown, red','Nautila','2014-12-20T10:18:58.610000Z','2014-12-20T21:36:42.181000Z',44),
(22,'Zabrak','mammal','sentient','180','unknown','brown, orange','black','pale, brown, red, orange, yellow','Zabraki','2014-12-20T10:26:59.894000Z','2014-12-20T21:36:42.183000Z',45),
(23,'Tholothian','mammal','sentient','unknown','unknown','blue, indigo','unknown','dark','unknown','2014-12-20T10:29:13.798000Z','2014-12-20T21:36:42.186000Z',46),
(24,'Iktotchi','unknown','sentient','180','unknown','orange','none','pink','Iktotchese','2014-12-20T10:32:13.046000Z','2014-12-20T21:36:42.188000Z',47),
(25,'Quermian','mammal','sentient','240','86','yellow','none','white','Quermian','2014-12-20T10:34:50.827000Z','2014-12-20T21:36:42.189000Z',48),
(26,'Kel Dor','unknown','sentient','180','70','black, silver','none','peach, orange, red','Kel Dor','2014-12-20T10:49:21.692000Z','2014-12-20T21:36:42.191000Z',49),
(27,'Chagrian','amphibian','sentient','190','unknown','blue','none','blue','Chagria','2014-12-20T10:53:28.795000Z','2014-12-20T21:36:42.193000Z',50),
(28,'Geonosian','insectoid','sentient','178','unknown','green, hazel','none','green, brown','Geonosian','2014-12-20T16:40:45.618000Z','2014-12-20T21:36:42.195000Z',11),
(29,'Mirialan','mammal','sentient','180','unknown','blue, green, red, yellow, brown, orange','black, brown','yellow, green','Mirialan','2014-12-20T16:46:48.290000Z','2014-12-20T21:36:42.197000Z',51),
(30,'Clawdite','reptilian','sentient','180','70','yellow','none','green, yellow','Clawdite','2014-12-20T16:57:46.171000Z','2014-12-20T21:36:42.199000Z',54),
(31,'Besalisk','amphibian','sentient','178','75','yellow','none','brown','besalisk','2014-12-20T17:28:28.821000Z','2014-12-20T21:36:42.200000Z',55),
(32,'Kaminoan','amphibian','sentient','220','80','black','none','grey, blue','Kaminoan','2014-12-20T17:31:24.838000Z','2014-12-20T21:36:42.202000Z',10),
(33,'Skakoan','mammal','sentient','unknown','unknown','unknown','none','grey, green','Skakoan','2014-12-20T17:53:54.515000Z','2014-12-20T21:36:42.204000Z',56),
(34,'Muun','mammal','sentient','190','100','black','none','grey, white','Muun','2014-12-20T17:58:19.088000Z','2014-12-20T21:36:42.207000Z',57),
(35,'Togruta','mammal','sentient','180','94','red, orange, yellow, green, blue, black','none','red, white, orange, yellow, green, blue','Togruti','2014-12-20T18:44:03.246000Z','2014-12-20T21:36:42.209000Z',58),
(36,'Kaleesh','reptile','sentient','170','80','yellow','none','brown, orange, tan','Kaleesh','2014-12-20T19:45:42.537000Z','2014-12-20T21:36:42.210000Z',59),
(37,'Pau\'an','mammal','sentient','190','700','black','none','grey','Utapese','2014-12-20T20:35:06.777000Z','2014-12-20T21:36:42.212000Z',12);
/*!40000 ALTER TABLE `species` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `starships`
--

DROP TABLE IF EXISTS `starships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `starships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `starship_class` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `cost_in_credits` varchar(255) NOT NULL,
  `length` varchar(255) NOT NULL,
  `crew` varchar(255) NOT NULL,
  `passengers` varchar(255) NOT NULL,
  `max_atmosphering_speed` varchar(255) NOT NULL,
  `hyperdrive_rating` varchar(255) NOT NULL,
  `MGLT` varchar(255) NOT NULL,
  `cargo_capacity` varchar(255) NOT NULL,
  `consumables` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `edited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `starships`
--

LOCK TABLES `starships` WRITE;
/*!40000 ALTER TABLE `starships` DISABLE KEYS */;
INSERT INTO `starships` VALUES
(2,'CR90 corvette','CR90 corvette','corvette','Corellian Engineering Corporation','3500000','150','30-165','600','950','2.0','60','3000000','1 year','2014-12-10T14:20:33.369000Z','2014-12-20T21:23:49.867000Z'),
(3,'Star Destroyer','Imperial I-class Star Destroyer','Star Destroyer','Kuat Drive Yards','150000000','1,600','47,060','n/a','975','2.0','60','36000000','2 years','2014-12-10T15:08:19.848000Z','2014-12-20T21:23:49.870000Z'),
(5,'Sentinel-class landing craft','Sentinel-class landing craft','landing craft','Sienar Fleet Systems, Cyngus Spaceworks','240000','38','5','75','1000','1.0','70','180000','1 month','2014-12-10T15:48:00.586000Z','2014-12-20T21:23:49.873000Z'),
(9,'Death Star','DS-1 Orbital Battle Station','Deep Space Mobile Battlestation','Imperial Department of Military Research, Sienar Fleet Systems','1000000000000','120000','342,953','843,342','n/a','4.0','10','1000000000000','3 years','2014-12-10T16:36:50.509000Z','2014-12-20T21:26:24.783000Z'),
(10,'Millennium Falcon','YT-1300 light freighter','Light freighter','Corellian Engineering Corporation','100000','34.37','4','6','1050','0.5','75','100000','2 months','2014-12-10T16:59:45.094000Z','2014-12-20T21:23:49.880000Z'),
(11,'Y-wing','BTL Y-wing','assault starfighter','Koensayr Manufacturing','134999','14','2','0','1000km','1.0','80','110','1 week','2014-12-12T11:00:39.817000Z','2014-12-20T21:23:49.883000Z'),
(12,'X-wing','T-65 X-wing','Starfighter','Incom Corporation','149999','12.5','1','0','1050','1.0','100','110','1 week','2014-12-12T11:19:05.340000Z','2014-12-20T21:23:49.886000Z'),
(13,'TIE Advanced x1','Twin Ion Engine Advanced x1','Starfighter','Sienar Fleet Systems','unknown','9.2','1','0','1200','1.0','105','150','5 days','2014-12-12T11:21:32.991000Z','2014-12-20T21:23:49.889000Z'),
(15,'Executor','Executor-class star dreadnought','Star dreadnought','Kuat Drive Yards, Fondor Shipyards','1143350000','19000','279,144','38000','n/a','2.0','40','250000000','6 years','2014-12-15T12:31:42.547000Z','2014-12-20T21:23:49.893000Z'),
(17,'Rebel transport','GR-75 medium transport','Medium transport','Gallofree Yards, Inc.','unknown','90','6','90','650','4.0','20','19000000','6 months','2014-12-15T12:34:52.264000Z','2014-12-20T21:23:49.895000Z'),
(21,'Slave 1','Firespray-31-class patrol and attack','Patrol craft','Kuat Systems Engineering','unknown','21.5','1','6','1000','3.0','70','70000','1 month','2014-12-15T13:00:56.332000Z','2014-12-20T21:23:49.897000Z'),
(22,'Imperial shuttle','Lambda-class T-4a shuttle','Armed government transport','Sienar Fleet Systems','240000','20','6','20','850','1.0','50','80000','2 months','2014-12-15T13:04:47.235000Z','2014-12-20T21:23:49.900000Z'),
(23,'EF76 Nebulon-B escort frigate','EF76 Nebulon-B escort frigate','Escort ship','Kuat Drive Yards','8500000','300','854','75','800','2.0','40','6000000','2 years','2014-12-15T13:06:30.813000Z','2014-12-20T21:23:49.902000Z'),
(27,'Calamari Cruiser','MC80 Liberty type Star Cruiser','Star Cruiser','Mon Calamari shipyards','104000000','1200','5400','1200','n/a','1.0','60','unknown','2 years','2014-12-18T10:54:57.804000Z','2014-12-20T21:23:49.904000Z'),
(28,'A-wing','RZ-1 A-wing Interceptor','Starfighter','Alliance Underground Engineering, Incom Corporation','175000','9.6','1','0','1300','1.0','120','40','1 week','2014-12-18T11:16:34.542000Z','2014-12-20T21:23:49.907000Z'),
(29,'B-wing','A/SF-01 B-wing starfighter','Assault Starfighter','Slayn & Korpil','220000','16.9','1','0','950','2.0','91','45','1 week','2014-12-18T11:18:04.763000Z','2014-12-20T21:23:49.909000Z'),
(31,'Republic Cruiser','Consular-class cruiser','Space cruiser','Corellian Engineering Corporation','unknown','115','9','16','900','2.0','unknown','unknown','unknown','2014-12-19T17:01:31.488000Z','2014-12-20T21:23:49.912000Z'),
(32,'Droid control ship','Lucrehulk-class Droid Control Ship','Droid control ship','Hoersch-Kessel Drive, Inc.','unknown','3170','175','139000','n/a','2.0','unknown','4000000000','500 days','2014-12-19T17:04:06.323000Z','2014-12-20T21:23:49.915000Z'),
(39,'Naboo fighter','N-1 starfighter','Starfighter','Theed Palace Space Vessel Engineering Corps','200000','11','1','0','1100','1.0','unknown','65','7 days','2014-12-19T17:39:17.582000Z','2014-12-20T21:23:49.917000Z'),
(40,'Naboo Royal Starship','J-type 327 Nubian royal starship','yacht','Theed Palace Space Vessel Engineering Corps, Nubia Star Drives','unknown','76','8','unknown','920','1.8','unknown','unknown','unknown','2014-12-19T17:45:03.506000Z','2014-12-20T21:23:49.919000Z'),
(41,'Scimitar','Star Courier','Space Transport','Republic Sienar Systems','55000000','26.5','1','6','1180','1.5','unknown','2500000','30 days','2014-12-20T09:39:56.116000Z','2014-12-20T21:23:49.922000Z'),
(43,'J-type diplomatic barge','J-type diplomatic barge','Diplomatic barge','Theed Palace Space Vessel Engineering Corps, Nubia Star Drives','2000000','39','5','10','2000','0.7','unknown','unknown','1 year','2014-12-20T11:05:51.237000Z','2014-12-20T21:23:49.925000Z'),
(47,'AA-9 Coruscant freighter','Botajef AA-9 Freighter-Liner','freighter','Botajef Shipyards','unknown','390','unknown','30000','unknown','unknown','unknown','unknown','unknown','2014-12-20T17:24:23.509000Z','2014-12-20T21:23:49.928000Z'),
(48,'Jedi starfighter','Delta-7 Aethersprite-class interceptor','Starfighter','Kuat Systems Engineering','180000','8','1','0','1150','1.0','unknown','60','7 days','2014-12-20T17:35:23.906000Z','2014-12-20T21:23:49.930000Z'),
(49,'H-type Nubian yacht','H-type Nubian yacht','yacht','Theed Palace Space Vessel Engineering Corps','unknown','47.9','4','unknown','8000','0.9','unknown','unknown','unknown','2014-12-20T17:46:46.847000Z','2014-12-20T21:23:49.932000Z'),
(52,'Republic Assault ship','Acclamator I-class assault ship','assault ship','Rothana Heavy Engineering','unknown','752','700','16000','unknown','0.6','unknown','11250000','2 years','2014-12-20T18:08:42.926000Z','2014-12-20T21:23:49.935000Z'),
(58,'Solar Sailer','Punworcca 116-class interstellar sloop','yacht','Huppla Pasa Tisc Shipwrights Collective','35700','15.2','3','11','1600','1.5','unknown','240','7 days','2014-12-20T18:37:56.969000Z','2014-12-20T21:23:49.937000Z'),
(59,'Trade Federation cruiser','Providence-class carrier/destroyer','capital ship','Rendili StarDrive, Free Dac Volunteers Engineering corps.','125000000','1088','600','48247','1050','1.5','unknown','50000000','4 years','2014-12-20T19:40:21.902000Z','2014-12-20T21:23:49.941000Z'),
(61,'Theta-class T-2c shuttle','Theta-class T-2c shuttle','transport','Cygnus Spaceworks','1000000','18.5','5','16','2000','1.0','unknown','50000','56 days','2014-12-20T19:48:40.409000Z','2014-12-20T21:23:49.944000Z'),
(63,'Republic attack cruiser','Senator-class Star Destroyer','star destroyer','Kuat Drive Yards, Allanteen Six shipyards','59000000','1137','7400','2000','975','1.0','unknown','20000000','2 years','2014-12-20T19:52:56.232000Z','2014-12-20T21:23:49.946000Z'),
(64,'Naboo star skiff','J-type star skiff','yacht','Theed Palace Space Vessel Engineering Corps/Nubia Star Drives, Incorporated','unknown','29.2','3','3','1050','0.5','unknown','unknown','unknown','2014-12-20T19:55:15.396000Z','2014-12-20T21:23:49.948000Z'),
(65,'Jedi Interceptor','Eta-2 Actis-class light interceptor','starfighter','Kuat Systems Engineering','320000','5.47','1','0','1500','1.0','unknown','60','2 days','2014-12-20T19:56:57.468000Z','2014-12-20T21:23:49.951000Z'),
(66,'arc-170','Aggressive Reconnaissance-170 starfighte','starfighter','Incom Corporation, Subpro Corporation','155000','14.5','3','0','1000','1.0','100','110','5 days','2014-12-20T20:03:48.603000Z','2014-12-20T21:23:49.953000Z'),
(68,'Banking clan frigte','Munificent-class star frigate','cruiser','Hoersch-Kessel Drive, Inc, Gwori Revolutionary Industries','57000000','825','200','unknown','unknown','1.0','unknown','40000000','2 years','2014-12-20T20:07:11.538000Z','2014-12-20T21:23:49.956000Z'),
(74,'Belbullab-22 starfighter','Belbullab-22 starfighter','starfighter','Feethan Ottraw Scalable Assemblies','168000','6.71','1','0','1100','6','unknown','140','7 days','2014-12-20T20:38:05.031000Z','2014-12-20T21:23:49.959000Z'),
(75,'V-wing','Alpha-3 Nimbus-class V-wing starfighter','starfighter','Kuat Systems Engineering','102500','7.9','1','0','1050','1.0','unknown','60','15 hours','2014-12-20T20:43:04.349000Z','2014-12-20T21:23:49.961000Z');
/*!40000 ALTER TABLE `starships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `vehicle_class` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `length` varchar(255) NOT NULL,
  `cost_in_credits` varchar(255) NOT NULL,
  `crew` varchar(255) NOT NULL,
  `passengers` varchar(255) NOT NULL,
  `max_atmosphering_speed` varchar(255) NOT NULL,
  `cargo_capacity` varchar(255) NOT NULL,
  `consumables` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `edited` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES
(4,'Sand Crawler','Digger Crawler','wheeled','Corellia Mining Corporation','36.8 ','150000','46','30','30','50000','2 months','2014-12-10T15:36:25.724000Z','2014-12-20T21:30:21.661000Z'),
(6,'T-16 skyhopper','T-16 skyhopper','repulsorcraft','Incom Corporation','10.4 ','14500','1','1','1200','50','0','2014-12-10T16:01:52.434000Z','2014-12-20T21:30:21.665000Z'),
(7,'X-34 landspeeder','X-34 landspeeder','repulsorcraft','SoroSuub Corporation','3.4 ','10550','1','1','250','5','unknown','2014-12-10T16:13:52.586000Z','2014-12-20T21:30:21.668000Z'),
(8,'TIE/LN starfighter','Twin Ion Engine/Ln Starfighter','starfighter','Sienar Fleet Systems','6.4','unknown','1','0','1200','65','2 days','2014-12-10T16:33:52.860000Z','2014-12-20T21:30:21.670000Z'),
(14,'Snowspeeder','t-47 airspeeder','airspeeder','Incom corporation','4.5','unknown','2','0','650','10','none','2014-12-15T12:22:12Z','2014-12-20T21:30:21.672000Z'),
(16,'TIE bomber','TIE/sa bomber','space/planetary bomber','Sienar Fleet Systems','7.8','unknown','1','0','850','none','2 days','2014-12-15T12:33:15.838000Z','2014-12-20T21:30:21.675000Z'),
(18,'AT-AT','All Terrain Armored Transport','assault walker','Kuat Drive Yards, Imperial Department of Military Research','20','unknown','5','40','60','1000','unknown','2014-12-15T12:38:25.937000Z','2014-12-20T21:30:21.677000Z'),
(19,'AT-ST','All Terrain Scout Transport','walker','Kuat Drive Yards, Imperial Department of Military Research','2','unknown','2','0','90','200','none','2014-12-15T12:46:42.384000Z','2014-12-20T21:30:21.679000Z'),
(20,'Storm IV Twin-Pod cloud car','Storm IV Twin-Pod','repulsorcraft','Bespin Motors','7','75000','2','0','1500','10','1 day','2014-12-15T12:58:50.530000Z','2014-12-20T21:30:21.681000Z'),
(24,'Sail barge','Modified Luxury Sail Barge','sail barge','Ubrikkian Industries Custom Vehicle Division','30','285000','26','500','100','2000000','Live food tanks','2014-12-18T10:44:14.217000Z','2014-12-20T21:30:21.684000Z'),
(25,'Bantha-II cargo skiff','Bantha-II','repulsorcraft cargo skiff','Ubrikkian Industries','9.5','8000','5','16','250','135000','1 day','2014-12-18T10:48:03.208000Z','2014-12-20T21:30:21.688000Z'),
(26,'TIE/IN interceptor','Twin Ion Engine Interceptor','starfighter','Sienar Fleet Systems','9.6','unknown','1','0','1250','75','2 days','2014-12-18T10:50:28.225000Z','2014-12-20T21:30:21.691000Z'),
(30,'Imperial Speeder Bike','74-Z speeder bike','speeder','Aratech Repulsor Company','3','8000','1','1','360','4','1 day','2014-12-18T11:20:04.625000Z','2014-12-20T21:30:21.693000Z'),
(33,'Vulture Droid','Vulture-class droid starfighter','starfighter','Haor Chall Engineering, Baktoid Armor Workshop','3.5','unknown','0','0','1200','0','none','2014-12-19T17:09:53.584000Z','2014-12-20T21:30:21.697000Z'),
(34,'Multi-Troop Transport','Multi-Troop Transport','repulsorcraft','Baktoid Armor Workshop','31','138000','4','112','35','12000','unknown','2014-12-19T17:12:04.400000Z','2014-12-20T21:30:21.700000Z'),
(35,'Armored Assault Tank','Armoured Assault Tank','repulsorcraft','Baktoid Armor Workshop','9.75','unknown','4','6','55','unknown','unknown','2014-12-19T17:13:29.799000Z','2014-12-20T21:30:21.703000Z'),
(36,'Single Trooper Aerial Platform','Single Trooper Aerial Platform','repulsorcraft','Baktoid Armor Workshop','2','2500','1','0','400','none','none','2014-12-19T17:15:09.511000Z','2014-12-20T21:30:21.705000Z'),
(37,'C-9979 landing craft','C-9979 landing craft','landing craft','Haor Chall Engineering','210','200000','140','284','587','1800000','1 day','2014-12-19T17:20:36.373000Z','2014-12-20T21:30:21.707000Z'),
(38,'Tribubble bongo','Tribubble bongo','submarine','Otoh Gunga Bongameken Cooperative','15','unknown','1','2','85','1600','unknown','2014-12-19T17:37:37.924000Z','2014-12-20T21:30:21.710000Z'),
(42,'Sith speeder','FC-20 speeder bike','speeder','Razalon','1.5','4000','1','0','180','2','unknown','2014-12-20T10:09:56.095000Z','2014-12-20T21:30:21.712000Z'),
(44,'Zephyr-G swoop bike','Zephyr-G swoop bike','repulsorcraft','Mobquet Swoops and Speeders','3.68','5750','1','1','350','200','none','2014-12-20T16:24:16.026000Z','2014-12-20T21:30:21.714000Z'),
(45,'Koro-2 Exodrive airspeeder','Koro-2 Exodrive airspeeder','airspeeder','Desler Gizh Outworld Mobility Corporation','6.6','unknown','1','1','800','80','unknown','2014-12-20T17:17:33.526000Z','2014-12-20T21:30:21.716000Z'),
(46,'XJ-6 airspeeder','XJ-6 airspeeder','airspeeder','Narglatch AirTech prefabricated kit','6.23','unknown','1','1','720','unknown','unknown','2014-12-20T17:19:19.991000Z','2014-12-20T21:30:21.719000Z'),
(50,'LAAT/i','Low Altitude Assault Transport/infrantry','gunship','Rothana Heavy Engineering','17.4','unknown','6','30','620','170','unknown','2014-12-20T18:01:21.014000Z','2014-12-20T21:30:21.723000Z'),
(51,'LAAT/c','Low Altitude Assault Transport/carrier','gunship','Rothana Heavy Engineering','28.82','unknown','1','0','620','40000','unknown','2014-12-20T18:02:46.802000Z','2014-12-20T21:30:21.725000Z'),
(53,'AT-TE','All Terrain Tactical Enforcer','walker','Rothana Heavy Engineering, Kuat Drive Yards','13.2','unknown','6','36','60','10000','21 days','2014-12-20T18:10:07.560000Z','2014-12-20T21:30:21.728000Z'),
(54,'SPHA','Self-Propelled Heavy Artillery','walker','Rothana Heavy Engineering','140','unknown','25','30','35','500','7 days','2014-12-20T18:12:32.315000Z','2014-12-20T21:30:21.731000Z'),
(55,'Flitknot speeder','Flitknot speeder','speeder','Huppla Pasa Tisc Shipwrights Collective','2','8000','1','0','634','unknown','unknown','2014-12-20T18:15:20.312000Z','2014-12-20T21:30:21.735000Z'),
(56,'Neimoidian shuttle','Sheathipede-class transport shuttle','transport','Haor Chall Engineering','20','unknown','2','6','880','1000','7 days','2014-12-20T18:25:44.912000Z','2014-12-20T21:30:21.739000Z'),
(57,'Geonosian starfighter','Nantex-class territorial defense','starfighter','Huppla Pasa Tisc Shipwrights Collective','9.8','unknown','1','0','20000','unknown','unknown','2014-12-20T18:34:12.541000Z','2014-12-20T21:30:21.742000Z'),
(60,'Tsmeu-6 personal wheel bike','Tsmeu-6 personal wheel bike','wheeled walker','Z-Gomot Ternbuell Guppat Corporation','3.5','15000','1','1','330','10','none','2014-12-20T19:43:54.870000Z','2014-12-20T21:30:21.745000Z'),
(62,'Emergency Firespeeder','Fire suppression speeder','fire suppression ship','unknown','unknown','unknown','2','unknown','unknown','unknown','unknown','2014-12-20T19:50:58.559000Z','2014-12-20T21:30:21.749000Z'),
(67,'Droid tri-fighter','tri-fighter','droid starfighter','Colla Designs, Phlac-Arphocc Automata Industries','5.4','20000','1','0','1180','0','none','2014-12-20T20:05:19.992000Z','2014-12-20T21:30:21.752000Z'),
(69,'Oevvaor jet catamaran','Oevvaor jet catamaran','airspeeder','Appazanna Engineering Works','15.1','12125','2','2','420','50','3 days','2014-12-20T20:20:53.931000Z','2014-12-20T21:30:21.756000Z'),
(70,'Raddaugh Gnasp fluttercraft','Raddaugh Gnasp fluttercraft','air speeder','Appazanna Engineering Works','7','14750','2','0','310','20','none','2014-12-20T20:21:55.648000Z','2014-12-20T21:30:21.759000Z'),
(71,'Clone turbo tank','HAVw A6 Juggernaut','wheeled walker','Kuat Drive Yards','49.4','350000','20','300','160','30000','20 days','2014-12-20T20:24:45.587000Z','2014-12-20T21:30:21.762000Z'),
(72,'Corporate Alliance tank droid','NR-N99 Persuader-class droid enforcer','droid tank','Techno Union','10.96','49000','0','4','100','none','none','2014-12-20T20:26:55.522000Z','2014-12-20T21:30:21.765000Z'),
(73,'Droid gunship','HMP droid gunship','airspeeder','Baktoid Fleet Ordnance, Haor Chall Engineering','12.3','60000','0','0','820','0','none','2014-12-20T20:32:05.687000Z','2014-12-20T21:30:21.768000Z'),
(76,'AT-RT','All Terrain Recon Transport','walker','Kuat Drive Yards','3.2','40000','1','0','90','20','1 day','2014-12-20T20:47:49.189000Z','2014-12-20T21:30:21.772000Z');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-07 14:42:16
