-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: gestion_alumnos
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `curso` int(4) NOT NULL DEFAULT 2023,
  PRIMARY KEY (`id_alumno`),
  UNIQUE KEY `alumnos_un` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (1,'12775213R','David','Cerezo','Hernández','david.cerher.1@educa.jcyl.es','634701064',2024),(2,'71960876V','Miguel','Cuevas','Burón','miguel.cuebur@educa.jcyl.es','672222823',2023),(3,'71971696S','Neo','Armada','Montero','neo.armmon@educa.jcyl.es','633726087',2026),(18,'1234','ad','as','','','',0),(19,'6','','','sa','','655454',0),(42,'41402303A','Asd','Jjjj','Dd','da@sda.es','ddd',2023),(43,'00015566H','Lkdlksdf','Qsñmkf','Lmnmkdsf','','',2017);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `ciclo` varchar(100) NOT NULL,
  `modulo1` varchar(100) NOT NULL,
  `modulo2` varchar(100) NOT NULL,
  `modulo3` varchar(100) DEFAULT NULL,
  `convocatoria` varchar(20) DEFAULT NULL,
  `fecha_exposicion` date DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `alumno` int(11) DEFAULT NULL,
  `tutor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`),
  UNIQUE KEY `proyectos_un` (`titulo`),
  UNIQUE KEY `proyectos_uni` (`alumno`),
  KEY `proyectos_FK` (`alumno`),
  KEY `proyectos_FK_1` (`tutor`),
  CONSTRAINT `proyectos_FK` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`id_alumno`),
  CONSTRAINT `proyectos_FK_1` FOREIGN KEY (`tutor`) REFERENCES `tutores` (`id_tutor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` VALUES (2,'Gestor Tareas','Gestor de tareas y eventos','daw','DAWES','DAWEC','DIW','','0000-00-00',0,1,1),(4,'asd','ñklhkabsd jhsag,df iuSAMNDFB KJ','0','2','3','0','','2023-12-30',0,42,NULL),(5,'jkkks','Ksakjss','daw','DAWEC','DAWES','DIW','','2023-12-30',9,2,2),(6,'Dfsdf. Kkn asd k salkdl','Dsffsdf sdfsñdpps d skdifop,  sdñfosjdofl,. Sd. S. F sdf. Asdasd. . Asdasd. . Asdasd','0','DAWES','DAWES','','','0000-00-00',0,19,NULL);
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutores`
--

DROP TABLE IF EXISTS `tutores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tutores` (
  `id_tutor` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_tutor`),
  UNIQUE KEY `profesores_un` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutores`
--

LOCK TABLES `tutores` WRITE;
/*!40000 ALTER TABLE `tutores` DISABLE KEYS */;
INSERT INTO `tutores` VALUES (1,'41402330K','Raquel','García','Galan','','123123212'),(2,'00000020C','Juan Antonio','Gascón','Sorribas','juan@gascon.iu','455855');
/*!40000 ALTER TABLE `tutores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(100) NOT NULL,
  `profesor` int(11) DEFAULT NULL,
  `alumno` int(11) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `rol` varchar(10) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuarios_FK` (`profesor`),
  KEY `usuarios_FK_1` (`alumno`),
  CONSTRAINT `usuarios_FK` FOREIGN KEY (`profesor`) REFERENCES `tutores` (`id_tutor`),
  CONSTRAINT `usuarios_FK_1` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'$2y$10$22eOEYfrAj5HOw.SODR.2uZDU8xiBL5frnaTJnZQXwg/l6Ej45OXu',NULL,1,'David','root'),(2,'$2y$10$nUk78lpxUH2GeJMmm9lzSeUhmRy1K4xDZHY5BisHxlNoTGNRZf6.C',1,NULL,'Raquel','tutor'),(3,'$2y$10$PBcqfHxuqHYEcldlrMW0UO5wy4UNQuI3pFJm8mylQSAo15X7921BG',NULL,3,'Neo','alumno'),(4,'$2y$10$DY.k35jrBbwD7f4k.4pp6.1ygUKsmevhzIJiAIrAl9SMpfHPli/7i',NULL,NULL,'Mario','alumno'),(8,'$2y$10$bpBBCxSrR4q6Dpcgdpa1TOi/nHjjiFIeT4GGDfu0EGDnHQYO1KsTq',NULL,NULL,'Jesus','alumno'),(10,'$2y$10$y1rT0vRYlZYifa1dmX8cGeBevuGSlHNGp4zb1RJBJqgxJAI1YLzF2',NULL,NULL,'Luis','alumno'),(11,'$2y$10$oOygmUm26SxhNhDjd342Me8mu.1CygbELfWAPKw9VPaT9dndl0MlC',NULL,NULL,'Fran','alumno');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gestion_alumnos'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-04 22:51:33
