-- MySQL dump 10.13  Distrib 8.0.18, for Linux (x86_64)
--
-- Host: localhost    Database: jbl5xq
-- ------------------------------------------------------
-- Server version	8.0.26-google

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `jbl5xq`
--

USE `jbl5xq`;

--
-- Table structure for table `Actor`
--

DROP TABLE IF EXISTS `Actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Actor` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actor`
--

LOCK TABLES `Actor` WRITE;
/*!40000 ALTER TABLE `Actor` DISABLE KEYS */;
INSERT INTO `Actor` VALUES ('Adam Sandler'),('Allen Covert'),('Amy Hill'),('Audrey Hepburn'),('Blake Clark'),('Brian Tyree Henry'),('Chris Rock'),('Colin Quinn'),('Dan Aykroyd'),('David Spade'),('Drew Barrymore'),('Eric Andre'),('George Lopez'),('Gloria Estefan'),('Hunter March'),('Joyce Van Patten'),('Juan de Marcos'),('Kevin James'),('Krysten Ritter'),('Lidya Jewett'),('Lin-Manuel Miranda'),('Lusia Strus'),('Maria Bello'),('Maya Rudolph'),('Michael Rooker'),('Nicole Byer'),('Rob Schneider'),('Salma Hayek'),('Scott Dixon'),('Sean Astin'),('Tim Meadows'),('Tony Parker'),('Winslow Fegley'),('Ynairaly Simo'),('Zoe Saldana');
/*!40000 ALTER TABLE `Actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Comment` (
  `username` varchar(255) DEFAULT NULL,
  `commentText` varchar(255) DEFAULT NULL,
  KEY `username` (`username`),
  CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comment`
--

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;
INSERT INTO `Comment` VALUES ('user1','loved it'),('user2','wasn\'t that great'),('user3','it was awful'),('user4','would recommend'),('user5','eh'),('user6','could\'ve been better'),('user7','would watch again'),('user8','Best movie I\'ve ever seen'),('user9','great!'),('user10','not my favorite'),('user11','DO NOT WATCH'),('user12','waste of my time'),('user13','thought the actors were amazing'),('user1','that was great'),('user3','watching it again tomorrow'),('user5','great movie for the family'),('user8','not safe for children');
/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CommentsOn`
--

DROP TABLE IF EXISTS `CommentsOn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CommentsOn` (
  `time` time NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `showID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`time`),
  KEY `username` (`username`),
  KEY `showID` (`showID`),
  CONSTRAINT `CommentsOn_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `CommentsOn_ibfk_2` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CommentsOn`
--

LOCK TABLES `CommentsOn` WRITE;
/*!40000 ALTER TABLE `CommentsOn` DISABLE KEYS */;
INSERT INTO `CommentsOn` VALUES ('00:40:00','user1','s2322'),('01:40:00','user3','s6019'),('02:40:00','user5','s1208'),('03:40:00','user8','s2346'),('11:40:00','user1','s28'),('12:40:00','user2','s65'),('13:40:00','user3','s301'),('14:40:00','user4','s6019'),('15:40:00','user5','s1439'),('16:40:00','user6','s1208'),('17:40:00','user7','s2346'),('18:40:00','user8','s2322'),('19:40:00','user9','s2257'),('20:40:00','user10','s2189'),('21:40:00','user11','s2144'),('22:40:00','user12','s1208'),('23:40:00','user13','s2346');
/*!40000 ALTER TABLE `CommentsOn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Director`
--

DROP TABLE IF EXISTS `Director`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Director` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Director`
--

LOCK TABLES `Director` WRITE;
/*!40000 ALTER TABLE `Director` DISABLE KEYS */;
INSERT INTO `Director` VALUES ('Ariel Boles'),('Brandon Jeffords'),('Bryn Evans'),('David Yarovesky'),('Dennis Dugan'),('Eric Notarnicola'),('Florent Bodin'),('Helena Coan'),('Kirk DeMicco'),('Peter Segal'),('Troy Miller'),('Tyler Spindel');
/*!40000 ALTER TABLE `Director` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Directs`
--

DROP TABLE IF EXISTS `Directs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Directs` (
  `name` varchar(255) DEFAULT NULL,
  `showID` varchar(255) DEFAULT NULL,
  KEY `name` (`name`),
  KEY `showID` (`showID`),
  CONSTRAINT `Directs_ibfk_1` FOREIGN KEY (`name`) REFERENCES `director` (`name`),
  CONSTRAINT `Directs_ibfk_2` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Directs`
--

LOCK TABLES `Directs` WRITE;
/*!40000 ALTER TABLE `Directs` DISABLE KEYS */;
INSERT INTO `Directs` VALUES ('Dennis Dugan','s28'),('David Yarovesky','s65'),('Kirk DeMicco','s301'),('Brandon Jeffords','s301'),('Peter Segal','s6019'),('Florent Bodin','s1439'),('Helena Coan','s1208'),('Eric Notarnicola','s2346'),('Troy Miller','s2322'),('Bryn Evans','s2257'),('Ariel Boles','s2189'),('Tyler Spindel','s2144');
/*!40000 ALTER TABLE `Directs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Favorites`
--

DROP TABLE IF EXISTS `Favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Favorites` (
  `username` varchar(255) DEFAULT NULL,
  `showID` varchar(255) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `showID` (`showID`),
  CONSTRAINT `Favorites_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `Favorites_ibfk_2` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Favorites`
--

LOCK TABLES `Favorites` WRITE;
/*!40000 ALTER TABLE `Favorites` DISABLE KEYS */;
INSERT INTO `Favorites` VALUES ('user1','s1439'),('user1','s2346'),('user1','s2322'),('user1','s2189'),('user1','s2144'),('user3','s28'),('user4','s65'),('user5','s301'),('user6','s6019'),('user7','s1208'),('user10','s2322'),('user10','s2144'),('user10','s28'),('user16','s2189'),('user17','s301'),('user18','s2257'),('user19','s28'),('user20','s2346'),('user20','s2322'),('user20','s2189'),('user20','s2144');
/*!40000 ALTER TABLE `Favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Has`
--

DROP TABLE IF EXISTS `Has`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Has` (
  `username` varchar(255) DEFAULT NULL,
  `showID` varchar(255) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `showID` (`showID`),
  CONSTRAINT `Has_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `Has_ibfk_2` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Has`
--

LOCK TABLES `Has` WRITE;
/*!40000 ALTER TABLE `Has` DISABLE KEYS */;
INSERT INTO `Has` VALUES ('user1','s28'),('user2','s65'),('user3','s301'),('user4','s6019'),('user5','s1439'),('user6','s1208'),('user7','s2346'),('user8','s2322'),('user2','s2346'),('user4','s2346'),('user2','s301');
/*!40000 ALTER TABLE `Has` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Movie`
--

DROP TABLE IF EXISTS `Movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Movie` (
  `showID` varchar(255) NOT NULL,
  `movieName` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `releaseYear` int NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `typeOf` varchar(255) DEFAULT NULL,
  `duration` int DEFAULT NULL,
  PRIMARY KEY (`showID`),
  CONSTRAINT `isMovie` CHECK ((`typeOf` = _utf8mb3'Movie')),
  CONSTRAINT `notNULL` CHECK ((`duration` > 0)),
  CONSTRAINT `notNULLorZERO` CHECK (((`duration` > 0) and (`duration` <> NULL))),
  CONSTRAINT `nullNot` CHECK ((`duration` <> NULL))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Movie`
--

LOCK TABLES `Movie` WRITE;
/*!40000 ALTER TABLE `Movie` DISABLE KEYS */;
INSERT INTO `Movie` VALUES ('s1208','Audrey','TV-14',2020,'NULL','Movie',101),('s1439','Tony Parker: The Final Shot','TV-14',2020,'France','Movie',99),('s2144','Rob Schneider: Asian Momma, Mexican Kids','TV-MA',2020,'United States','Movie',44),('s2189','Sugar High','TV-G',2020,'United States','Movie',44),('s2257','Born Racer','R',2018,'New Zealand','Movie',89),('s2322','George Lopez: We\'ll Do It For Half','TV-MA',2020,'United States','Movie',52),('s2346','Eric Andre: Legalize Everything','TV-MA',2020,'United States','Movie',52),('s28','Grown Ups','PG-13',2010,'United States','Movie',103),('s301','Vivo','PG',2021,'Canada, United States','Movie',100),('s6019','50 First Dates','PG-13',2004,'United States','Movie',99),('s65','Nightbooks','TV-PG',2021,'NULL','Movie',103);
/*!40000 ALTER TABLE `Movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Movie_Country`
--

DROP TABLE IF EXISTS `Movie_Country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Movie_Country` (
  `showID` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`showID`,`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Movie_Country`
--

LOCK TABLES `Movie_Country` WRITE;
/*!40000 ALTER TABLE `Movie_Country` DISABLE KEYS */;
INSERT INTO `Movie_Country` VALUES ('s1208','NULL'),('s1439','France'),('s2144','United States'),('s2189','United States'),('s2257','New Zealand'),('s2322','United States'),('s2346','United States'),('s28','United States'),('s301','Canada'),('s301','United States'),('s6019','United States'),('s65','NULL');
/*!40000 ALTER TABLE `Movie_Country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Review`
--

DROP TABLE IF EXISTS `Review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Review` (
  `showID` varchar(255) DEFAULT NULL,
  `starRating` int DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  KEY `showID` (`showID`),
  KEY `username` (`username`),
  CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`),
  CONSTRAINT `Review_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Review`
--

LOCK TABLES `Review` WRITE;
/*!40000 ALTER TABLE `Review` DISABLE KEYS */;
INSERT INTO `Review` VALUES ('s28',3,'user1'),('s65',4,'user2'),('s301',5,'user3'),('s6019',1,'user4'),('s1439',1,'user5'),('s1208',2,'user6'),('s2346',2,'user7'),('s2322',3,'user8'),('s2346',4,'user2'),('s2346',5,'user4'),('s301',2,'user2');
/*!40000 ALTER TABLE `Review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StarsIn`
--

DROP TABLE IF EXISTS `StarsIn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `StarsIn` (
  `name` varchar(255) DEFAULT NULL,
  `showID` varchar(255) DEFAULT NULL,
  KEY `name` (`name`),
  KEY `showID` (`showID`),
  CONSTRAINT `StarsIn_ibfk_1` FOREIGN KEY (`name`) REFERENCES `actor` (`name`),
  CONSTRAINT `StarsIn_ibfk_2` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StarsIn`
--

LOCK TABLES `StarsIn` WRITE;
/*!40000 ALTER TABLE `StarsIn` DISABLE KEYS */;
INSERT INTO `StarsIn` VALUES ('Adam Sandler','s28'),('Kevin James','s28'),('Chris Rock','s28'),('David Spade','s28'),('Rob Schneider','s28'),('Salma Hayek','s28'),('Maria Bello','s28'),('Maya Rudolph','s28'),('Colin Quinn','s28'),('Tim Meadows','s28'),('Joyce Van Patten','s28'),('Winslow Fegley','s65'),('Lidya Jewett','s65'),('Krysten Ritter','s65'),('Winslow Fegley','s301'),('Lidya Jewett','s301'),('Krysten Ritter','s301'),('Lin-Manuel Miranda','s301'),('Ynairaly Simo','s301'),('Zoe Saldana','s301'),('Juan de Marcos','s301'),('Brian Tyree Henry','s301'),('Gloria Estefan','s301'),('Michael Rooker','s301'),('Nicole Byer','s301'),('Drew Barrymore','s6019'),('Sean Astin','s6019'),('Lusia Strus','s6019'),('Dan Aykroyd','s6019'),('Amy Hill','s6019'),('Allen Covert','s6019'),('Blake Clark','s6019'),('Adam Sandler','s6019'),('Maya Rudolph','s6019'),('Rob Schneider','s6019'),('Tony Parker','s1439'),('Audrey Hepburn','s1208'),('Eric Andre','s2346'),('George Lopez','s2322'),('Scott Dixon','s2257'),('Hunter March','s2189'),('Rob Schneider','s2144');
/*!40000 ALTER TABLE `StarsIn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('ginny','ginny@gmail.com','password'),('user1','user1@gmail.com',NULL),('user10','user10@gmail.com',NULL),('user11','user11@gmail.com',NULL),('user12','user12@gmail.com',NULL),('user13','user13@gmail.com',NULL),('user14','user14@gmail.com',NULL),('user15','user15@gmail.com',NULL),('user16','user16@gmail.com',NULL),('user17','user17@gmail.com',NULL),('user18','user18@gmail.com',NULL),('user19','user19@gmail.com',NULL),('user2','user2@gmail.com',NULL),('user20','user20@gmail.com',NULL),('user3','user3@gmail.com',NULL),('user4','user4@gmail.com',NULL),('user5','user5@gmail.com',NULL),('user6','user6@gmail.com',NULL),('user7','user7@gmail.com',NULL),('user8','user8@gmail.com',NULL),('user9','user9@gmail.com',NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Writes`
--

DROP TABLE IF EXISTS `Writes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Writes` (
  `username` varchar(255) DEFAULT NULL,
  `showID` varchar(255) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `showID` (`showID`),
  CONSTRAINT `Writes_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `Writes_ibfk_2` FOREIGN KEY (`showID`) REFERENCES `movie` (`showID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Writes`
--

LOCK TABLES `Writes` WRITE;
/*!40000 ALTER TABLE `Writes` DISABLE KEYS */;
INSERT INTO `Writes` VALUES ('user1','s28'),('user2','s65'),('user3','s301'),('user4','s6019'),('user5','s1439'),('user6','s1208'),('user7','s2346'),('user8','s2322'),('user2','s2346'),('user4','s2346'),('user2','s301');
/*!40000 ALTER TABLE `Writes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-15 20:06:41
