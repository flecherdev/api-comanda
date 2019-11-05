-- MySQL dump 10.13  Distrib 8.0.13, for macos10.14 (x86_64)
--
-- Host: 127.0.0.1    Database: comanda
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(200) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `clave_empleado` varchar(200) DEFAULT NULL,
  `estado_empleado` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'jose',1,'123',1,'2019-06-05 02:15:50','0000-00-00 00:00:00'),(2,'pedro',2,'123',1,'2019-06-05 02:15:50','0000-00-00 00:00:00'),(3,'mariana',3,'123',1,'2019-06-05 02:15:50','0000-00-00 00:00:00'),(4,'micaela',4,'123',1,'2019-06-05 02:15:50','0000-00-00 00:00:00'),(5,'ezequiel',5,'123',1,'2019-06-05 02:15:50','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_mesa`
--

DROP TABLE IF EXISTS `estado_mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estado_mesa` (
  `id_estado_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estado_mesa` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_estado_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_mesa`
--

LOCK TABLES `estado_mesa` WRITE;
/*!40000 ALTER TABLE `estado_mesa` DISABLE KEYS */;
INSERT INTO `estado_mesa` VALUES (1,'esperando'),(2,'comiendo'),(3,'reservada'),(4,'cerrada'),(5,'pidiendo la cuenta');
/*!40000 ALTER TABLE `estado_mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estado` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'pendiente'),(2,'preparandose'),(3,'servir'),(4,'entregado'),(5,'finalizado'),(6,'preparado');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichadas`
--

DROP TABLE IF EXISTS `fichadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `fichadas` (
  `id_fichada` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `ingreso_fichada` datetime NOT NULL,
  `salida_fichada` datetime NOT NULL,
  PRIMARY KEY (`id_fichada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichadas`
--

LOCK TABLES `fichadas` WRITE;
/*!40000 ALTER TABLE `fichadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fichadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `menus` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(45) DEFAULT NULL,
  `precio_menu` double DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `descripcion_menu` blob,
  `foto_menu` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'arepas',100,3,_binary 'Los tragos son las bebidas que contienen etanol. Atendiendo a la elaboración, se puede distinguir entre bebidas producidas por fermentación alcohólica, en las que el contenido de alcohol no supera los 15 grados, y las producidas por destilación, generalmente a partir de un producto de fermentación. ','arepas_venezolanas.jpg'),(2,'pizza',150,3,_binary 'unas tortillas hechas a base de harina de maíz precocida o maíz molido, muy populares en Colombia y Venezuela.','pizza.jpg'),(3,'cerveza',100,2,_binary 'La cerveza ​ es una bebida alcohólica, no destilada, de sabor amargo, que se fabrica con granos de cebada germinados u otros cereales cuyo almidón se fermenta en agua con levadura y se aromatiza a menudo con lúpulo, entre otras plantas.​​','cerveza.jpg'),(4,'coca cola',100,1,_binary 'Coca-Cola, conocida comúnmente como Coca en muchos países hispanohablantes, es una bebida gaseosa y refrescante','coca_cola.jpg'),(5,'hamburguesa',300,3,_binary 'Coca-Cola, conocida comúnmente como Coca en muchos países hispanohablantes, es una bebida gaseosa y refrescante','hamburguesa-cusco.jpg'),(6,'tragos',100,1,_binary 'Los tragos son las bebidas que contienen etanol. Atendiendo a la elaboración, se puede distinguir entre bebidas producidas por fermentación alcohólica, en las que el contenido de alcohol no supera los 15 grados, y las producidas por destilación, generalmente a partir de un producto de fermentación. ','tragos.jpg'),(7,'milanesa',250,3,_binary 'Los tragos son las bebidas que contienen etanol. Atendiendo a la elaboración, se puede distinguir entre bebidas producidas por fermentación alcohólica, en las que el contenido de alcohol no supera los 15 grados, y las producidas por destilación, generalmente a partir de un producto de fermentación. ','milanesa_napolitana.jpg'),(8,'pepito ',300,3,_binary 'El pepito de ternera es un bocadillo caliente originario de España que suele elaborarse con pan francés y carne de ternera a la plancha o frita en aceite con algo de ajo laminado. Por regla general se trata de un solomillo.','pepito_venezolano.jpg');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mesas` (
  `id_mesa` int(11) NOT NULL,
  `codigo_mesa` varchar(150) DEFAULT NULL,
  `id_estado_mesa` int(11) DEFAULT NULL,
  `foto_mesa` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_mesa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,'mesa_01',1,'./Fotos/Mesas/MES01.jpg'),(2,'mesa_02',5,'./Fotos/Mesas/MES01.jpg'),(3,'mesa_03',2,'./Fotos/Mesas/MES01.jpg'),(4,'mesa_04',3,'./Fotos/Mesas/MES01.jpg'),(5,'mesa_o5',4,'./Fotos/Mesas/MES01.jpg');
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'bartender'),(2,'cervecero'),(3,'cocinero'),(4,'mozo'),(5,'administrador');
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-05 20:27:35
