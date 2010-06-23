-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.37


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema m256_3
--

CREATE DATABASE IF NOT EXISTS m256_3;
USE m256_3;

--
-- Definition of table `anfrage`
--

DROP TABLE IF EXISTS `anfrage`;
CREATE TABLE `anfrage` (
  `anfrage_nr` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime DEFAULT '0000-00-00 00:00:00',
  `betreff` varchar(40) DEFAULT NULL,
  `problem` varchar(254) DEFAULT NULL,
  `mitarbeiter_ref` int(11) DEFAULT NULL,
  `kunden_ref` int(11) NOT NULL DEFAULT '0',
  `status_ref` int(11) NOT NULL DEFAULT '0',
  `supportart_ref` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`anfrage_nr`),
  UNIQUE KEY `IDX_Anfrage1` (`anfrage_nr`),
  KEY `IDX_Anfrage2` (`kunden_ref`),
  KEY `IDX_Anfrage3` (`status_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `anfrage`
--

/*!40000 ALTER TABLE `anfrage` DISABLE KEYS */;
/*!40000 ALTER TABLE `anfrage` ENABLE KEYS */;


--
-- Definition of table `antwort`
--

DROP TABLE IF EXISTS `antwort`;
CREATE TABLE `antwort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime DEFAULT NULL,
  `antwort` varchar(254) DEFAULT NULL,
  `anfrage_ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_Antwort1` (`anfrage_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antwort`
--

/*!40000 ALTER TABLE `antwort` DISABLE KEYS */;
/*!40000 ALTER TABLE `antwort` ENABLE KEYS */;


--
-- Definition of table `benutzer`
--

DROP TABLE IF EXISTS `benutzer`;
CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `vorname` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `pw` varchar(32) DEFAULT NULL,
  `rolle_ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_Benutzer1` (`id`),
  KEY `IDX_Benutzer2` (`rolle_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `benutzer`
--

/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` (`id`,`login`,`name`,`vorname`,`email`,`pw`,`rolle_ref`) VALUES 
 (33,'ale','manoiero','alex','ale@hotmail.com','4216455ceebbc3038bd0550c85b6a3bf',1);
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;


--
-- Definition of table `benutzer_supportart`
--

DROP TABLE IF EXISTS `benutzer_supportart`;
CREATE TABLE `benutzer_supportart` (
  `benutzer_id` int(10) unsigned NOT NULL,
  `supportart_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`benutzer_id`,`supportart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `benutzer_supportart`
--

/*!40000 ALTER TABLE `benutzer_supportart` DISABLE KEYS */;
INSERT INTO `benutzer_supportart` (`benutzer_id`,`supportart_id`) VALUES 
 (33,2);
/*!40000 ALTER TABLE `benutzer_supportart` ENABLE KEYS */;


--
-- Definition of table `rolle`
--

DROP TABLE IF EXISTS `rolle`;
CREATE TABLE `rolle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolle` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_Rolle1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolle`
--

/*!40000 ALTER TABLE `rolle` DISABLE KEYS */;
INSERT INTO `rolle` (`id`,`rolle`) VALUES 
 (1,'Mitarbeiter'),
 (2,'Kunde');
/*!40000 ALTER TABLE `rolle` ENABLE KEYS */;


--
-- Definition of table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `IDX_Status1` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`status_id`,`status`) VALUES 
 (1,'OPEN'),
 (2,'WORKING'),
 (3,'DONE'),
 (4,'REWORKING');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


--
-- Definition of table `supportart`
--

DROP TABLE IF EXISTS `supportart`;
CREATE TABLE `supportart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supportart` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_Supportart1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supportart`
--

/*!40000 ALTER TABLE `supportart` DISABLE KEYS */;
INSERT INTO `supportart` (`id`,`supportart`) VALUES 
 (1,'Technische UnterstÃƒÂ¼tzung'),
 (2,'Reklamation'),
 (3,'Produkte Informationen'),
 (4,'Lieferung');
/*!40000 ALTER TABLE `supportart` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
