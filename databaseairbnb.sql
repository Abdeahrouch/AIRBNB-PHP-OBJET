-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: tp-php-airbnb
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annonces` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `pays` varchar(150) NOT NULL,
  `ville` varchar(150) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `type_de_logement_id` int(10) NOT NULL,
  `taile` int(10) NOT NULL,
  `nbr_de_pieces` int(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `prix_par_nuit` int(10) NOT NULL,
  `nbr_de_couchages` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type_de_logement_id` (`type_de_logement_id`),
  CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`type_de_logement_id`) REFERENCES `type_de_logement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annonces`
--

LOCK TABLES `annonces` WRITE;
/*!40000 ALTER TABLE `annonces` DISABLE KEYS */;
/*!40000 ALTER TABLE `annonces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `annonces_equipement`
--

DROP TABLE IF EXISTS `annonces_equipement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annonces_equipement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `equipement_id` int(10) NOT NULL,
  `annonces_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `equipement_id` (`equipement_id`),
  KEY `annonces_id` (`annonces_id`),
  CONSTRAINT `annonces_equipement_ibfk_1` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`),
  CONSTRAINT `annonces_equipement_ibfk_2` FOREIGN KEY (`annonces_id`) REFERENCES `annonces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annonces_equipement`
--

LOCK TABLES `annonces_equipement` WRITE;
/*!40000 ALTER TABLE `annonces_equipement` DISABLE KEYS */;
/*!40000 ALTER TABLE `annonces_equipement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipement`
--

LOCK TABLES `equipement` WRITE;
/*!40000 ALTER TABLE `equipement` DISABLE KEYS */;
INSERT INTO `equipement` VALUES (1,'Wi-Fi'),(2,'Télévision'),(3,'Climatisation'),(4,'Chauffage'),(5,'Cuisine équipée'),(6,'Réfrigérateur'),(7,'Machine à café'),(8,'Micro-ondes'),(9,'Lave-vaisselle'),(10,'Lave-linge'),(11,'Sèche-linge'),(12,'Fer à repasser'),(13,'Sèche-cheveux'),(14,'Serviettes'),(15,'Draps'),(16,'Parking'),(17,'Piscine'),(18,'Balcon ou terrasse'),(19,'Jardin'),(20,'Barbecue'),(21,'Cheminée'),(22,'Bureau'),(23,'Gym'),(24,'Jacuzzi'),(25,'Sauna'),(26,'Ascenseur'),(27,'Détecteur de fumée'),(28,'Détecteur de monoxyde de carbone'),(29,'Kit de premiers secours'),(30,'Animaux autorisés'),(31,'Accès handicapé'),(32,'Lit bébé'),(33,'Chaise haute'),(34,'Jouets'),(35,'Console de jeux'),(36,'Lecteur DVD');
/*!40000 ALTER TABLE `equipement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos` (
  `annonces_id` int(10) NOT NULL,
  `image_path` varchar(150) NOT NULL,
  KEY `annonces_id` (`annonces_id`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`annonces_id`) REFERENCES `annonces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `annonces_id` int(10) NOT NULL,
  `date_debut` int(10) NOT NULL,
  `date_fin` int(10) NOT NULL,
  `nbr_de_personne` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `annonces_id` (`annonces_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`annonces_id`) REFERENCES `annonces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_de_logement`
--

DROP TABLE IF EXISTS `type_de_logement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_de_logement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_de_logement`
--

LOCK TABLES `type_de_logement` WRITE;
/*!40000 ALTER TABLE `type_de_logement` DISABLE KEYS */;
INSERT INTO `type_de_logement` VALUES (1,'Appartement'),(2,'Maison'),(4,'Chambre '),(5,'Maison '),(8,'Villa'),(16,'Château'),(18,'Igloo');
/*!40000 ALTER TABLE `type_de_logement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(150) NOT NULL,
  `is_hote` tinyint(1) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `date_inscription` int(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-08 14:52:23
