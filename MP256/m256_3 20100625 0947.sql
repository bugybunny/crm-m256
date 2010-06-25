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
  `betreff` varchar(100) DEFAULT NULL,
  `problem` text,
  `mitarbeiter_ref` int(11) DEFAULT NULL,
  `kunden_ref` int(11) NOT NULL DEFAULT '0',
  `status_ref` int(11) NOT NULL DEFAULT '0',
  `supportart_ref` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`anfrage_nr`),
  KEY `FK_anfrage_mitarbeiter` (`mitarbeiter_ref`),
  KEY `FK_anfrage_kunden` (`kunden_ref`),
  KEY `FK_anfrage_status` (`status_ref`),
  KEY `FK_anfrage_supportart` (`supportart_ref`),
  CONSTRAINT `FK_anfrage_kunden` FOREIGN KEY (`kunden_ref`) REFERENCES `benutzer` (`id`),
  CONSTRAINT `FK_anfrage_mitarbeiter` FOREIGN KEY (`mitarbeiter_ref`) REFERENCES `benutzer` (`id`),
  CONSTRAINT `FK_anfrage_status` FOREIGN KEY (`status_ref`) REFERENCES `status` (`status_id`),
  CONSTRAINT `FK_anfrage_supportart` FOREIGN KEY (`supportart_ref`) REFERENCES `supportart` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `anfrage`
--

/*!40000 ALTER TABLE `anfrage` DISABLE KEYS */;
INSERT INTO `anfrage` (`anfrage_nr`,`datum`,`betreff`,`problem`,`mitarbeiter_ref`,`kunden_ref`,`status_ref`,`supportart_ref`) VALUES 
 (1,'2010-06-25 09:30:44','Unterst&uuml;tzung ben&ouml;tigt beim Fahrradfahren!','Leider kann ich nicht Fahrrad, oder wie wir in der Schweiz sagen Velo, fahren.\r\n\r\nBitte helfen Sie mir, ich verzweifle!!',NULL,1,1,1),
 (2,'2010-06-25 09:31:31','Bestellter Eierw&auml;rmer geht nicht','Hallo zusammen,\r\n\r\nIch habe mir letztens einen Eierw&auml;rmer gekauft. Jedoch l&auml;uft er nicht.\r\nIch habe es probiert, ihn in der Waschmaschine anzuschliessen, jedoch hat das auch nichts gebracht.\r\n\r\nIch habe den Anschluss RX30030, falls Ihnen das weiterhilf.\r\n\r\n\r\nVielen Dank, dass Sie sich meiner Reklamation annehmen,\r\n\r\nGruss\r\nAlessio Romagnoli',NULL,1,1,2),
 (3,'2010-06-25 09:32:53','Information &uuml;ber Ihren CleanTech2500','Hallo geehrtes Gremium\r\n\r\nIch habe letztens in der Zeitschrift \'Supermegacooleultradupersuper CleanTech2500s\' einen Artikel &uuml;ber Ihren neuen CleanTech2500 gelesen.\r\nLeider habe ich nichts verstanden.\r\n\r\n\r\nGruss\r\nAlessio Romagnoli',NULL,1,1,3),
 (4,'2010-06-25 09:33:53','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',NULL,1,1,4),
 (5,'2010-06-25 09:37:05','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n\r\nUt wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.',NULL,1,1,1),
 (6,'2010-06-25 09:38:19','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',NULL,1,1,2),
 (7,'2010-06-25 09:38:29','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',NULL,1,1,3),
 (8,'2010-06-25 09:38:42','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',16,1,3,4),
 (9,'2010-06-25 09:39:00','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',NULL,8,1,4),
 (10,'2010-06-25 09:39:30','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',NULL,9,1,4),
 (11,'2010-06-25 09:40:00','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',16,10,2,4),
 (12,'2010-06-25 09:40:30','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',NULL,11,1,4),
 (13,'2010-06-25 09:41:00','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',16,12,2,4),
 (14,'2010-06-25 09:42:00','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',15,1,2,3),
 (15,'2010-06-25 09:43:00','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',15,1,3,3),
 (16,'2010-06-25 09:44:00','Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',NULL,1,1,3);
/*!40000 ALTER TABLE `anfrage` ENABLE KEYS */;


--
-- Definition of table `antwort`
--

DROP TABLE IF EXISTS `antwort`;
CREATE TABLE `antwort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime DEFAULT NULL,
  `antwort` text,
  `anfrage_ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_antwort_anfrage` (`anfrage_ref`),
  CONSTRAINT `FK_antwort_anfrage` FOREIGN KEY (`anfrage_ref`) REFERENCES `anfrage` (`anfrage_nr`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antwort`
--

/*!40000 ALTER TABLE `antwort` DISABLE KEYS */;
INSERT INTO `antwort` (`id`,`datum`,`antwort`,`anfrage_ref`) VALUES 
 (1,'2010-06-25 09:41:55','Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',8),
 (2,'2010-06-25 09:46:14','Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',15);
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
  `rolle_ref` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_benutzer_rolle` (`rolle_ref`),
  CONSTRAINT `FK_benutzer_rolle` FOREIGN KEY (`rolle_ref`) REFERENCES `rolle` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `benutzer`
--

/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` (`id`,`login`,`name`,`vorname`,`email`,`pw`,`rolle_ref`) VALUES 
 (1,'alessio','Romagnolo','Alessio','alessio.romagnolo@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (2,'philippe','Defuns','Philippe','philippe.defuns@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (3,'alessandro','Manoiero','Alessandro','alessandro.manoiero@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (4,'marco','Syfrig','Marco','marco.syfrig@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (5,'sadik','Pepic','Sadik','sadik.pepic@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (6,'laura','Lüthi','Laura','laura.luethi@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (7,'rolf','Zgraggen','Rolf','rolf.zgraggen@bzzs.ch','202cb962ac59075b964b07152d234b70',2),
 (8,'kunde1','Kunde1','Kunde1','kunde1@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',2),
 (9,'kunde2','Kunde2','Kunde2','kunde2@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',2),
 (10,'kunde3','Kunde3','Kunde3','kunde3@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',2),
 (11,'kunde4','Kunde4','Kunde4','kunde4@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',2),
 (12,'kunde5','Kunde5','Kunde5','kunde5@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',2),
 (13,'supporter1','Supporter1','Supporter1','supporter1@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',1),
 (14,'supporter2','Supporter2','Supporter2','supporter2@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',1),
 (15,'supporter3','Supporter3','Supporter3','supporter3@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',1),
 (16,'supporter4','Supporter4','Supporter4','supporter4@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',1),
 (17,'supporter5','Supporter5','Supporter5','supporter5@bzzs.ch','c4ca4238a0b923820dcc509a6f75849b',1);
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;


--
-- Definition of table `benutzer_supportart`
--

DROP TABLE IF EXISTS `benutzer_supportart`;
CREATE TABLE `benutzer_supportart` (
  `benutzer_id` int(10) NOT NULL,
  `supportart_id` int(10) NOT NULL,
  PRIMARY KEY (`benutzer_id`,`supportart_id`) USING BTREE,
  KEY `FK_benutzer_supportart` (`supportart_id`),
  CONSTRAINT `FK_benutzer_supportart` FOREIGN KEY (`supportart_id`) REFERENCES `supportart` (`id`),
  CONSTRAINT `FK_supportart_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `benutzer_supportart`
--

/*!40000 ALTER TABLE `benutzer_supportart` DISABLE KEYS */;
INSERT INTO `benutzer_supportart` (`benutzer_id`,`supportart_id`) VALUES 
 (13,1),
 (17,1),
 (14,2),
 (15,3),
 (16,4);
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
 (1,'Technische Unterst&uuml;tzung'),
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
