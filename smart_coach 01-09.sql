CREATE DATABASE  IF NOT EXISTS `smart_coach` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `smart_coach`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: smart_coach
-- ------------------------------------------------------
-- Server version	5.6.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `correo_cli` varchar(100) NOT NULL,
  `pass_cli` varchar(32) NOT NULL,
  `nom_cli` varchar(150) NOT NULL,
  `fono_cli` int(11) NOT NULL,
  `fec_nac_cli` date NOT NULL,
  `vig_cli` bit(1) NOT NULL,
  `fec_plan_cli` date NOT NULL,
  `tipo_cli` int(11) DEFAULT NULL COMMENT 'tipo de cliente 0 casa 1 gimnasio',
  `servicio_cli` int(11) DEFAULT NULL COMMENT 'servicio contratado por el cliente 1 entrenameinto-2 nutricion- 3 full',
  PRIMARY KEY (`id_cli`),
  UNIQUE KEY `correo_cli_UNIQUE` (`correo_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'pablo.vicencio@clinicarioblanco.cl','bcfec6fe1842e8725be736c5576b0a0d','pablo',96643838,'1993-03-03','','2018-08-23',1,3),(2,'pablo.vicencioc@gmail.com','bcfec6fe1842e8725be736c5576b0a0d','sebastian',66438888,'1993-03-03','','2018-04-01',1,3),(3,'pablo.vicencio@correoaiep.cl','bcfec6fe1842e8725be736c5576b0a0d','karla',12312312,'1995-03-05','','2018-03-16',0,1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coach`
--

DROP TABLE IF EXISTS `coach`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coach` (
  `id_coach` int(11) NOT NULL AUTO_INCREMENT,
  `correo_coach` varchar(100) NOT NULL,
  `pass_coach` varchar(32) NOT NULL,
  `nom_coach` varchar(150) NOT NULL,
  `fono_coach` int(11) NOT NULL,
  `vig_coach` bit(1) NOT NULL,
  `super` bit(1) DEFAULT NULL,
  `fb_coach` varchar(50) DEFAULT NULL,
  `tipo_coach` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_coach`),
  UNIQUE KEY `correo_coach_UNIQUE` (`correo_coach`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coach`
--

LOCK TABLES `coach` WRITE;
/*!40000 ALTER TABLE `coach` DISABLE KEYS */;
INSERT INTO `coach` VALUES (1,'pvicencioc@hotmail.cl','e10adc3949ba59abbe56e057f20f883e','pablo coach',96643838,'','','kasrrg',1),(2,'killua_killer@outlook.es','bcfec6fe1842e8725be736c5576b0a0d','coach 1',78777777,'','\0','pablo.vicencio.3557',2);
/*!40000 ALTER TABLE `coach` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ejercicios` (
  `id_ejer` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ejer` varchar(100) DEFAULT NULL,
  `link_ejer` varchar(150) NOT NULL,
  `nota_ejer` varchar(240) DEFAULT NULL,
  `fk_id_musc` int(11) NOT NULL,
  `vig_ejer` bit(1) NOT NULL,
  `tipo_ejer` bit(1) NOT NULL,
  PRIMARY KEY (`id_ejer`),
  UNIQUE KEY `nom_ejer_UNIQUE` (`nom_ejer`),
  KEY `fk_id_musc_idx` (`fk_id_musc`),
  CONSTRAINT `fk_id_musc` FOREIGN KEY (`fk_id_musc`) REFERENCES `musculos` (`id_musc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicios`
--

LOCK TABLES `ejercicios` WRITE;
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
INSERT INTO `ejercicios` VALUES (1,'press banco plano','https://www.youtube.com/watch?v=ICaZxO7RmKs','prueba creacion de ejercicio ',1,'',''),(2,'sentadilla ','https://www.youtube.com/watch?v=6YPggJ4UEAY','Squat ejercicios y ejercicio  fitness para  cuadriceps, desarrollar los gluteos',3,'','');
/*!40000 ALTER TABLE `ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `esc_borg`
--

DROP TABLE IF EXISTS `esc_borg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esc_borg` (
  `id_esc` int(11) NOT NULL AUTO_INCREMENT,
  `esc` int(11) NOT NULL,
  `fec_esc` datetime NOT NULL,
  `fk_esc_rut` int(11) NOT NULL,
  `fk_esc_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_esc`,`fec_esc`),
  UNIQUE KEY `fk_esc_rut_UNIQUE` (`fk_esc_rut`),
  KEY `id_esc` (`id_esc`),
  KEY `fk_id_rut_idx` (`fk_esc_rut`),
  KEY `fk_id_cli_idx` (`fk_esc_cli`),
  CONSTRAINT `fk_esc_cli` FOREIGN KEY (`fk_esc_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_esc_rut` FOREIGN KEY (`fk_esc_rut`) REFERENCES `rutina` (`id_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esc_borg`
--

LOCK TABLES `esc_borg` WRITE;
/*!40000 ALTER TABLE `esc_borg` DISABLE KEYS */;
/*!40000 ALTER TABLE `esc_borg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eva_dieta`
--

DROP TABLE IF EXISTS `eva_dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eva_dieta` (
  `id_eva_dieta` int(11) NOT NULL AUTO_INCREMENT,
  `hambre_eva` int(11) NOT NULL,
  `horario_eva` int(11) DEFAULT NULL,
  `seg_dieta_eva` int(11) NOT NULL,
  `fec_eva` datetime NOT NULL,
  `fk_eva_dieta` int(11) DEFAULT NULL,
  `fk_eva_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_eva_dieta`),
  KEY `fk_eva_dieta_idx` (`fk_eva_dieta`),
  KEY `fk_eva_cli_idx` (`fk_eva_cli`),
  CONSTRAINT `fk_eva_cli` FOREIGN KEY (`fk_eva_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_eva_dieta` FOREIGN KEY (`fk_eva_dieta`) REFERENCES `nut_dieta` (`id_nut_dieta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eva_dieta`
--

LOCK TABLES `eva_dieta` WRITE;
/*!40000 ALTER TABLE `eva_dieta` DISABLE KEYS */;
INSERT INTO `eva_dieta` VALUES (1,0,0,4,'2018-05-02 07:50:10',8,1),(2,0,0,2,'2018-07-17 10:13:38',9,1);
/*!40000 ALTER TABLE `eva_dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion` (
  `id_eva` int(11) NOT NULL AUTO_INCREMENT,
  `enf_car_desc_eva` varchar(150) DEFAULT NULL,
  `les_ost_desc_eva` varchar(150) DEFAULT NULL,
  `enf_tab_eva` bit(1) DEFAULT NULL,
  `enf_diab_eva` bit(1) DEFAULT NULL,
  `enf_asma_eva` bit(1) DEFAULT NULL,
  `enf_hip_eva` bit(1) DEFAULT NULL,
  `porc_sent_eva` int(11) DEFAULT NULL,
  `obj_ent_eva` int(11) DEFAULT NULL,
  `alerg_ali_desc_eva` varchar(150) DEFAULT NULL,
  `into_ali_desc_eva` varchar(150) DEFAULT NULL,
  `alco_desc_ali_eva` varchar(150) DEFAULT NULL,
  `apet_eva` int(11) DEFAULT NULL,
  `digest_desc_eva` varchar(150) DEFAULT NULL,
  `agua_eva` int(11) DEFAULT NULL,
  `act_fisica_desc_eva` varchar(150) DEFAULT NULL,
  `desayuno_desc_eva` varchar(150) DEFAULT NULL,
  `colacion_desc_eva` varchar(150) DEFAULT NULL,
  `almuerzo_desc_eva` varchar(150) DEFAULT NULL,
  `once_desc_eva` varchar(150) DEFAULT NULL,
  `cena_desc_eva` varchar(150) DEFAULT NULL,
  `enc_frec_pan_eva` int(11) DEFAULT NULL,
  `enc_frec_frut_eva` int(11) DEFAULT NULL,
  `enc_frec_ens_eva` int(11) DEFAULT NULL,
  `ens_frec_huevo_eva` int(11) DEFAULT NULL,
  `enc_frec_pes_eva` int(11) DEFAULT NULL,
  `enc_frec_leg_eva` int(11) DEFAULT NULL,
  `enc_frec_golo_eva` int(11) DEFAULT NULL,
  `enc_frec_frit_eva` int(11) DEFAULT NULL,
  `enc_frec_azu_eva` int(11) DEFAULT NULL,
  `fk_id_cli_eva` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_eva`),
  KEY `fk_id_eva_cli_idx` (`fk_id_cli_eva`),
  CONSTRAINT `fk_id_eva_cli` FOREIGN KEY (`fk_id_cli_eva`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` VALUES (1,'No','No','\0','','\0','',10,3,'No','No','No',2,'test dig',3,'test act fis','test des','test colac','test alm','test once','test cena',1,2,3,4,5,6,7,8,9,1);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evo_cli`
--

DROP TABLE IF EXISTS `evo_cli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evo_cli` (
  `id_evo` int(11) NOT NULL AUTO_INCREMENT,
  `fec_evo` date NOT NULL,
  `est_evo` int(11) NOT NULL,
  `peso_evo` int(11) NOT NULL,
  `fk_id_cli` int(11) NOT NULL,
  PRIMARY KEY (`id_evo`),
  KEY `fk_id_cli_idx` (`fk_id_cli`),
  CONSTRAINT `fk_id_cli` FOREIGN KEY (`fk_id_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evo_cli`
--

LOCK TABLES `evo_cli` WRITE;
/*!40000 ALTER TABLE `evo_cli` DISABLE KEYS */;
INSERT INTO `evo_cli` VALUES (1,'2018-01-18',100,20,2),(2,'2018-01-23',160,54,3),(3,'2018-01-23',160,52,3),(4,'2018-01-23',162,55,1);
/*!40000 ALTER TABLE `evo_cli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musculos`
--

DROP TABLE IF EXISTS `musculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musculos` (
  `id_musc` int(11) NOT NULL AUTO_INCREMENT,
  `nom_musc` varchar(100) DEFAULT NULL,
  `fec_cre_musc` datetime NOT NULL,
  PRIMARY KEY (`id_musc`),
  UNIQUE KEY `nom_musc_UNIQUE` (`nom_musc`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musculos`
--

LOCK TABLES `musculos` WRITE;
/*!40000 ALTER TABLE `musculos` DISABLE KEYS */;
INSERT INTO `musculos` VALUES (1,'Pectorales','2018-01-18 15:53:49'),(2,'Espalda','2018-01-18 15:54:05'),(3,'Piernas','2018-01-18 15:54:19'),(4,'Bíceps','2018-01-18 15:54:35'),(5,'Tríceps','2018-01-18 15:54:55'),(6,'Hombros','2018-01-18 15:55:11');
/*!40000 ALTER TABLE `musculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nut_ali`
--

DROP TABLE IF EXISTS `nut_ali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nut_ali` (
  `id_nut_ali` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_ali` varchar(200) NOT NULL,
  `vig_nut_ali` bit(1) NOT NULL,
  `fk_id_ali_ga` int(11) NOT NULL,
  PRIMARY KEY (`id_nut_ali`),
  KEY `fk_ali_ga_idx` (`fk_id_ali_ga`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nut_ali`
--

LOCK TABLES `nut_ali` WRITE;
/*!40000 ALTER TABLE `nut_ali` DISABLE KEYS */;
INSERT INTO `nut_ali` VALUES (1,'Pan marraqueta sin miga','',1);
/*!40000 ALTER TABLE `nut_ali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nut_comidas`
--

DROP TABLE IF EXISTS `nut_comidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nut_comidas` (
  `id_nut_com` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_com` varchar(60) NOT NULL,
  `vig_nut_com` bit(1) NOT NULL,
  `desde_nut_com` time DEFAULT NULL,
  `hasta_nut_com` time DEFAULT NULL,
  PRIMARY KEY (`id_nut_com`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nut_comidas`
--

LOCK TABLES `nut_comidas` WRITE;
/*!40000 ALTER TABLE `nut_comidas` DISABLE KEYS */;
INSERT INTO `nut_comidas` VALUES (1,'Desayuno','','06:00:00','09:00:00'),(2,'Colación','','00:00:00','00:00:00'),(3,'Almuerzo','','12:00:00','16:00:00'),(4,'Once','','16:30:00','20:00:00'),(5,'Cena','','19:00:00','00:00:00');
/*!40000 ALTER TABLE `nut_comidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nut_det_dieta`
--

DROP TABLE IF EXISTS `nut_det_dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nut_det_dieta` (
  `id_nut_det_dieta` int(11) NOT NULL AUTO_INCREMENT,
  `fk_nut_det_com` int(11) NOT NULL,
  `fk_nut_det_ga` int(11) NOT NULL,
  `fk_nut_det_ali` int(11) NOT NULL,
  `fk_nut_det_uni` int(11) DEFAULT NULL,
  `fk_nut_dieta` int(11) NOT NULL,
  `vig_nut_det` bit(1) DEFAULT NULL,
  `nota_nut_det` varchar(200) DEFAULT NULL,
  `cant_nut_ali` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nut_det_dieta`),
  KEY `fk_det_com_idx` (`fk_nut_det_com`),
  KEY `fk_det_ga_idx` (`fk_nut_det_ga`),
  KEY `fk_det_ali_idx` (`fk_nut_det_ali`),
  KEY `fk_det_uni_idx` (`fk_nut_det_uni`),
  KEY `fk_det_dieta_idx` (`fk_nut_dieta`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nut_det_dieta`
--

LOCK TABLES `nut_det_dieta` WRITE;
/*!40000 ALTER TABLE `nut_det_dieta` DISABLE KEYS */;
INSERT INTO `nut_det_dieta` VALUES (1,4,1,1,1,3,'','test carga dieta',3),(2,1,1,1,1,4,'','test sin uni_med',4),(3,1,1,1,1,5,'','test',1),(4,1,1,1,1,6,'','test',2),(5,3,1,1,1,7,'','test carga med',2),(6,3,1,1,0,8,'','test carga dieta ',2),(7,1,1,1,0,9,'','test',3),(8,5,1,1,0,9,'','',2);
/*!40000 ALTER TABLE `nut_det_dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nut_dieta`
--

DROP TABLE IF EXISTS `nut_dieta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nut_dieta` (
  `id_nut_dieta` int(11) NOT NULL AUTO_INCREMENT,
  `fec_nut_dieta` datetime NOT NULL,
  `vig_nut_dieta` bit(1) NOT NULL,
  `fk_dieta_coach` int(11) NOT NULL,
  `fk_dieta_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nut_dieta`),
  KEY `fk_nut_dieta_coach_idx` (`fk_dieta_coach`),
  KEY `fk_die_cli_idx` (`fk_dieta_cli`),
  CONSTRAINT `fk_die_cli` FOREIGN KEY (`fk_dieta_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nut_dieta`
--

LOCK TABLES `nut_dieta` WRITE;
/*!40000 ALTER TABLE `nut_dieta` DISABLE KEYS */;
INSERT INTO `nut_dieta` VALUES (1,'2018-04-26 07:48:49','\0',2,1),(2,'2018-04-26 07:49:30','\0',2,1),(3,'2018-04-26 07:50:07','\0',2,1),(4,'2018-04-26 08:04:21','\0',2,1),(5,'2018-04-26 08:06:44','\0',2,1),(6,'2018-04-26 08:07:18','\0',2,1),(7,'2018-04-26 08:09:43','\0',2,1),(8,'2018-04-26 08:12:21','\0',2,1),(9,'2018-07-17 06:59:09','',2,1);
/*!40000 ALTER TABLE `nut_dieta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nut_gru_ali`
--

DROP TABLE IF EXISTS `nut_gru_ali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nut_gru_ali` (
  `id_nut_grup` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_grup` varchar(80) NOT NULL,
  `vig_nut_grup` bit(1) NOT NULL,
  PRIMARY KEY (`id_nut_grup`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nut_gru_ali`
--

LOCK TABLES `nut_gru_ali` WRITE;
/*!40000 ALTER TABLE `nut_gru_ali` DISABLE KEYS */;
INSERT INTO `nut_gru_ali` VALUES (1,'Cereales, pan y legumbres',''),(2,'Frutas',''),(3,'Verduras',''),(4,'Lácteos',''),(5,'Carnes y huevo',''),(6,'Aceites y alimentos altos en lípidos',''),(7,'Saborizantes',''),(8,'Edulcorantes calóricos',''),(9,'Endulcorantes no calóricos',''),(10,'Otros','');
/*!40000 ALTER TABLE `nut_gru_ali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nut_uni_med`
--

DROP TABLE IF EXISTS `nut_uni_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nut_uni_med` (
  `id_nut_uni` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_uni` varchar(60) NOT NULL,
  `img_nut_uni` varchar(100) NOT NULL,
  `vig_nut_uni` bit(1) NOT NULL,
  PRIMARY KEY (`id_nut_uni`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nut_uni_med`
--

LOCK TABLES `nut_uni_med` WRITE;
/*!40000 ALTER TABLE `nut_uni_med` DISABLE KEYS */;
INSERT INTO `nut_uni_med` VALUES (1,'Taza','',''),(2,'Cucharadas soperas','',''),(3,'Cucharaditas de té','',''),(4,'Puñado de la mano','','');
/*!40000 ALTER TABLE `nut_uni_med` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutina`
--

DROP TABLE IF EXISTS `rutina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutina` (
  `id_rut` int(11) NOT NULL AUTO_INCREMENT,
  `fec_rut` date NOT NULL,
  `rep_rut` int(11) NOT NULL,
  `series_rut` int(11) NOT NULL,
  `pausas_rut` int(11) NOT NULL,
  `vel_rut` int(11) NOT NULL,
  `nota_rut` varchar(100) DEFAULT NULL,
  `fk_id_cli` int(11) NOT NULL,
  `fk_id_ejer` int(11) NOT NULL,
  `fk_id_coach` int(11) NOT NULL,
  `vig_rut` bit(1) NOT NULL,
  `fec_reg_rut` datetime NOT NULL,
  `circuito` int(11) NOT NULL,
  PRIMARY KEY (`id_rut`),
  KEY `fk_id_cli_idx` (`fk_id_cli`),
  KEY `fk_id_ejer_idx` (`fk_id_ejer`),
  KEY `fk_id_coach_idx` (`fk_id_coach`),
  CONSTRAINT `fk_id_cli_rut` FOREIGN KEY (`fk_id_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_coach_rut` FOREIGN KEY (`fk_id_coach`) REFERENCES `coach` (`id_coach`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_ejer_rut` FOREIGN KEY (`fk_id_ejer`) REFERENCES `ejercicios` (`id_ejer`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutina`
--

LOCK TABLES `rutina` WRITE;
/*!40000 ALTER TABLE `rutina` DISABLE KEYS */;
INSERT INTO `rutina` VALUES (1,'0000-00-00',10,3,125,120,'test1',2,1,1,'\0','0000-00-00 00:00:00',0),(2,'0000-00-00',12,4,60,90,'prueba de ingreso ',1,1,1,'','2018-01-22 00:00:00',0),(3,'0000-00-00',7,5,30,60,'',1,1,1,'','2018-01-22 01:53:56',0),(4,'0000-00-00',12,4,20,50,'',1,1,1,'','2018-01-22 02:01:28',0),(5,'2018-01-30',8,5,10,30,'test',1,1,1,'\0','2018-01-22 02:05:23',0),(6,'2018-01-30',8,5,10,30,'test',1,1,1,'\0','2018-01-22 03:08:46',0),(7,'2018-01-30',4,2,23,24,'',1,1,1,'\0','2018-01-22 03:08:46',0),(9,'2018-01-30',8,4,123,1234,'weeee',1,1,1,'','2018-01-22 04:03:32',0),(10,'2018-01-30',12,3,90,60,'test guardado distintivo',1,1,1,'\0','2018-01-22 06:11:28',0),(11,'2018-03-15',10,3,20,20,'test',1,2,1,'','2018-03-01 05:54:20',0),(12,'2018-03-18',10,4,38,40,'',2,1,1,'\0','2018-03-17 07:07:41',0),(13,'2018-03-18',8,3,30,20,'prueba',2,2,1,'\0','2018-03-17 07:07:41',0),(14,'2018-03-17',12,3,45,27,'',2,2,1,'','2018-03-17 07:28:37',0),(15,'2018-03-21',4,8,20,30,'',1,1,1,'','2018-03-18 12:21:32',0),(16,'2018-03-23',10,3,30,30,'prueba ',2,1,1,'','2018-03-23 12:35:20',0),(17,'2018-03-24',8,3,20,30,'prueba',2,1,1,'','2018-03-24 02:27:16',0),(18,'2018-03-31',10,3,15,10,'test 31-mar-2018',1,1,1,'','2018-03-31 03:50:33',0),(19,'2018-04-05',10,4,20,20,'',1,1,1,'','2018-04-08 07:05:55',0),(20,'2018-04-08',8,3,20,20,'',2,1,1,'','2018-04-08 07:32:12',0),(21,'2018-04-13',8,3,10,1,'test',2,1,1,'','2018-04-14 12:42:28',0),(22,'2018-04-13',10,4,10,2,'test',2,2,1,'\0','2018-04-14 12:42:28',0),(23,'2018-04-14',8,3,10,1,'PRUEBA',2,1,1,'','2018-04-14 12:43:12',0),(24,'2018-05-07',10,1,0,3,'ejercicio de circuito sin pausa, pasar directamente al siguiente',1,1,1,'','2018-05-07 02:20:17',0),(25,'2018-05-07',10,1,0,2,'ejercicio de circuito sin pausa, pasar directamente al siguiente',1,2,1,'','2018-05-07 02:20:17',0),(26,'2018-08-23',8,3,10,2,'test',1,1,1,'','2018-08-23 03:21:10',0),(27,'2018-08-24',10,4,20,2,'test carga 24 -08',1,2,1,'\0','2018-08-23 03:21:48',0),(28,'2018-08-23',15,3,10,3,'',1,2,1,'\0','2018-08-23 07:30:08',0),(29,'2018-08-23',10,4,10,3,'',1,2,1,'\0','2018-08-23 07:37:57',0),(30,'2018-08-23',10,3,10,3,'test circuito',1,2,1,'\0','2018-08-23 07:43:09',0),(31,'2018-08-23',10,5,8,3,'test circuito',1,2,1,'\0','2018-08-23 07:49:37',0),(32,'2018-08-23',10,3,10,3,'test circuito',1,2,1,'\0','2018-08-23 08:04:53',1),(33,'2018-08-23',10,5,10,3,'test circuito 1',1,1,1,'\0','2018-08-23 08:06:43',1),(34,'2018-08-23',8,3,10,3,'test circuito 2',1,2,1,'\0','2018-08-23 08:06:43',1),(35,'2018-08-23',10,4,5,3,'test circuito 2',1,1,1,'\0','2018-08-23 08:06:43',1),(36,'2018-08-23',10,4,10,3,'test circuito 1',1,2,1,'\0','2018-08-23 08:10:37',1),(37,'2018-08-23',10,3,5,3,'test circuito 1.2',1,2,1,'\0','2018-08-23 08:10:37',1),(38,'2018-08-23',15,3,5,3,'test circuito 2',1,2,1,'\0','2018-08-23 08:10:37',1),(39,'2018-08-24',10,4,20,3,'test circuito',1,1,1,'','2018-08-24 09:22:50',0),(40,'2018-08-24',10,3,5,3,'test circuito',1,2,1,'\0','2018-08-24 09:24:35',0),(41,'2018-08-24',8,3,10,0,'test',1,1,1,'\0','2018-08-24 09:30:44',0),(42,'2018-08-24',8,3,10,3,'TEST',1,1,1,'','2018-08-24 09:38:18',0),(43,'2018-08-27',8,3,10,3,'test 1',1,1,1,'','2018-08-27 01:30:47',1),(44,'2018-08-27',10,4,5,3,'test 1.1',1,2,1,'','2018-08-27 01:30:47',1),(45,'2018-08-27',8,3,5,3,'test 2',1,1,1,'','2018-08-27 01:30:47',2),(46,'2018-08-27',10,4,5,3,'test',1,1,1,'','2018-08-27 01:30:47',0),(47,'2018-08-27',10,3,5,3,'test',1,1,1,'','2018-08-27 06:05:09',0),(48,'2018-08-28',10,4,20,3,'test',1,1,1,'\0','2018-08-27 06:08:36',0),(49,'2018-08-28',10,3,10,3,'test',1,2,1,'\0','2018-08-27 06:10:21',1),(50,'2018-08-28',10,4,5,2,'test 123',1,1,1,'\0','2018-08-27 06:31:11',2);
/*!40000 ALTER TABLE `rutina` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-01 21:56:14
