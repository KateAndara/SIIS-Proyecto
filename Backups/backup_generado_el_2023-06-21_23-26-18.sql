-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto-siis
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `tbl_cargos`
--

DROP TABLE IF EXISTS `tbl_cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_cargos` (
  `Id_Cargo` int NOT NULL AUTO_INCREMENT,
  `Nombre_cargo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`Id_Cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cargos`
--

LOCK TABLES `tbl_cargos` WRITE;
/*!40000 ALTER TABLE `tbl_cargos` DISABLE KEYS */;
INSERT INTO `tbl_cargos` VALUES (1,'Presidente'),(2,'Empleado'),(8,'PRUEBA');
/*!40000 ALTER TABLE `tbl_cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_clientes`
--

DROP TABLE IF EXISTS `tbl_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_clientes` (
  `Id_Cliente` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `DNI` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_clientes`
--

LOCK TABLES `tbl_clientes` WRITE;
/*!40000 ALTER TABLE `tbl_clientes` DISABLE KEYS */;
INSERT INTO `tbl_clientes` VALUES (1,'Consumidor Final','1111-11-11','0001'),(2,'INFORMATICA','2023-04-02','000000000000'),(3,'KATE ANDARA','2000-02-22','0801200011179'),(4,'PRUEBA','2023-04-05','000000000000'),(5,'ABICHUELA ','2001-01-25','0000000000011');
/*!40000 ALTER TABLE `tbl_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_clientes_contacto`
--

DROP TABLE IF EXISTS `tbl_clientes_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_clientes_contacto` (
  `Id_Cliente_Contacto` int NOT NULL AUTO_INCREMENT,
  `Id_Tipo_Contacto` int NOT NULL,
  `Id_Cliente` int NOT NULL,
  `Contacto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Cliente_Contacto`),
  KEY `fk_TBL_CLIENTES_CONTACTO_TBL_TIPO_CONTACTO1_idx` (`Id_Tipo_Contacto`),
  KEY `fk_TBL_CLIENTES_CONTACTO_TBL_CLIENTES1_idx` (`Id_Cliente`),
  CONSTRAINT `fk_TBL_CLIENTES_CONTACTO_TBL_CLIENTES1` FOREIGN KEY (`Id_Cliente`) REFERENCES `tbl_clientes` (`Id_Cliente`),
  CONSTRAINT `fk_TBL_CLIENTES_CONTACTO_TBL_TIPO_CONTACTO1` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_clientes_contacto`
--

LOCK TABLES `tbl_clientes_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_clientes_contacto` DISABLE KEYS */;
INSERT INTO `tbl_clientes_contacto` VALUES (1,1,3,'96543461'),(2,2,3,'kateandara@gmail.com'),(3,1,2,'88888889'),(4,1,4,'98765431'),(5,2,4,'prueba@gmail.com');
/*!40000 ALTER TABLE `tbl_clientes_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_compras`
--

DROP TABLE IF EXISTS `tbl_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_compras` (
  `Id_Compra` int NOT NULL AUTO_INCREMENT,
  `Id_Proveedor` int NOT NULL,
  `Fecha_compra` date DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Observacion` varchar(45) DEFAULT NULL,
  `Creado_por` varchar(45) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Modificado_por` varchar(45) DEFAULT NULL,
  `Fecha_modificacion` date DEFAULT NULL,
  `Cancelada` int DEFAULT '0',
  PRIMARY KEY (`Id_Compra`),
  KEY `fk_TBL_COMPRAS_TBL_PROVEEDORES1_idx` (`Id_Proveedor`),
  CONSTRAINT `fk_TBL_COMPRAS_TBL_PROVEEDORES1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `tbl_proveedores` (`Id_Proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compras`
--

LOCK TABLES `tbl_compras` WRITE;
/*!40000 ALTER TABLE `tbl_compras` DISABLE KEYS */;
INSERT INTO `tbl_compras` VALUES (37,1,'2023-04-11',10000.00,'contado','ADMINISTRADOR',NULL,NULL,NULL,0),(38,1,'2023-12-15',200.00,'contado','ADMINISTRADOR',NULL,NULL,NULL,0),(48,1,'2023-04-21',12000.00,'contado','',NULL,NULL,NULL,0),(49,1,'2023-04-21',10000.00,'contado','',NULL,NULL,NULL,0),(50,1,'2023-04-21',1200.00,'contado','',NULL,NULL,NULL,0),(51,5,'2023-04-27',1200.00,'contado','',NULL,NULL,NULL,0),(52,5,'2023-04-27',1200.00,'contado','',NULL,NULL,NULL,0),(53,4,'2023-05-13',1500.00,'contado','CAPACITACION',NULL,NULL,NULL,0),(54,6,'2023-06-21',10000.00,'contado','CAPACITACION',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `tbl_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_descuentos`
--

DROP TABLE IF EXISTS `tbl_descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_descuentos` (
  `Id_Descuento` int NOT NULL AUTO_INCREMENT,
  `Nombre_descuento` varchar(100) DEFAULT NULL,
  `Porcentaje_a_descontar` int DEFAULT NULL,
  PRIMARY KEY (`Id_Descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_descuentos`
--

LOCK TABLES `tbl_descuentos` WRITE;
/*!40000 ALTER TABLE `tbl_descuentos` DISABLE KEYS */;
INSERT INTO `tbl_descuentos` VALUES (0,'Sin descuento',0),(1,'promocion',10),(2,'2x1',50),(8,'INFORMATICA',5),(9,'PRUEBA',15);
/*!40000 ALTER TABLE `tbl_descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detalle_compra`
--

DROP TABLE IF EXISTS `tbl_detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_detalle_compra` (
  `Id_Detalle_Compra` int NOT NULL AUTO_INCREMENT,
  `Id_Compra` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  `Precio_libra` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Detalle_Compra`),
  KEY `fk_TBL_COMPRA_MATERIA_PRIMA_has_TBL_PROVEEDORES_TBL_COMPRA__idx` (`Id_Compra`),
  KEY `fk_TBL_DETALLE_COMPRA_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  CONSTRAINT `FK_Id_Compra_TBL_PROVEEDORES_TBL_COMPRAS` FOREIGN KEY (`Id_Compra`) REFERENCES `tbl_compras` (`Id_Compra`),
  CONSTRAINT `fk_TBL_DETALLE_COMPRA_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_compra`
--

LOCK TABLES `tbl_detalle_compra` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_compra` DISABLE KEYS */;
INSERT INTO `tbl_detalle_compra` VALUES (49,48,3,1,35.00),(50,49,3,1,35.00),(51,50,3,1,35.00),(52,51,3,1,35.00),(53,52,3,1,35.00),(54,53,3,1,35.00),(55,54,3,1,30.00);
/*!40000 ALTER TABLE `tbl_detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detalle_de_venta`
--

DROP TABLE IF EXISTS `tbl_detalle_de_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_detalle_de_venta` (
  `Id_Detalle_Venta` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` int NOT NULL,
  `Id_Venta` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Detalle_Venta`),
  KEY `fk_TBL_PRODUCTOS_has_TBL_VENTAS_TBL_VENTAS1_idx` (`Id_Venta`),
  KEY `fk_TBL_PRODUCTOS_has_TBL_VENTAS_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  CONSTRAINT `FK_Id_Producto_TBL_VENTAS_TBL_PRODUCTOS` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  CONSTRAINT `FK_Id_Venta_TBL_PRODUCTOS_TBL_VENTAS` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_de_venta`
--

LOCK TABLES `tbl_detalle_de_venta` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_de_venta` DISABLE KEYS */;
INSERT INTO `tbl_detalle_de_venta` VALUES (1,1,1,2,45.00),(24,1,16,4,45.00),(25,5,16,4,120.00),(26,1,17,5,45.00),(27,2,17,3,125.00),(28,5,17,4,120.00),(29,1,18,2,50.00),(30,1,19,3,50.00),(31,5,19,2,120.00),(32,2,19,3,125.00),(33,2,20,1,125.00),(34,5,20,1,120.00),(35,1,21,5,50.00),(36,1,22,2,50.00),(37,1,23,2,50.00);
/*!40000 ALTER TABLE `tbl_detalle_de_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detalle_producto_comprado`
--

DROP TABLE IF EXISTS `tbl_detalle_producto_comprado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_detalle_producto_comprado` (
  `Id_Detalle_Producto_Comprado` int NOT NULL AUTO_INCREMENT,
  `Id_Detalle_Compra` int NOT NULL,
  `Especie` varchar(45) DEFAULT NULL,
  `Peso_vivo` int DEFAULT NULL,
  `Canal` decimal(10,2) DEFAULT NULL,
  `Rendimiento` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Detalle_Producto_Comprado`),
  KEY `fk_TBL_DETALLE_PRODUCTO_COMPRADO_TBL_DETALLE_COMPRA1_idx` (`Id_Detalle_Compra`),
  CONSTRAINT `fk_TBL_DETALLE_PRODUCTO_COMPRADO_TBL_DETALLE_COMPRA1` FOREIGN KEY (`Id_Detalle_Compra`) REFERENCES `tbl_detalle_compra` (`Id_Detalle_Compra`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_producto_comprado`
--

LOCK TABLES `tbl_detalle_producto_comprado` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_producto_comprado` DISABLE KEYS */;
INSERT INTO `tbl_detalle_producto_comprado` VALUES (26,49,'cerdito',1234,123.00,9.97),(27,50,'cerdito',1234,123.00,9.97),(28,51,'cerdito',1234,123.00,9.97),(29,52,'1',1234,100.00,8.10),(30,53,'1',1234,123.00,9.97),(31,54,'1',165,75.00,45.45),(32,55,'1',178,65.00,36.52);
/*!40000 ALTER TABLE `tbl_detalle_producto_comprado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_errores`
--

DROP TABLE IF EXISTS `tbl_errores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_errores` (
  `Id_error` int NOT NULL AUTO_INCREMENT,
  `Error` varchar(100) DEFAULT NULL,
  `Codigo` varchar(45) DEFAULT NULL,
  `Mensaje` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_error`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_errores`
--

LOCK TABLES `tbl_errores` WRITE;
/*!40000 ALTER TABLE `tbl_errores` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_errores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_especies`
--

DROP TABLE IF EXISTS `tbl_especies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_especies` (
  `Id_Especie` int NOT NULL AUTO_INCREMENT,
  `Nombre_Especie` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_Especie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_especies`
--

LOCK TABLES `tbl_especies` WRITE;
/*!40000 ALTER TABLE `tbl_especies` DISABLE KEYS */;
INSERT INTO `tbl_especies` VALUES (1,'LECHON ');
/*!40000 ALTER TABLE `tbl_especies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado_proceso`
--

DROP TABLE IF EXISTS `tbl_estado_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_estado_proceso` (
  `Id_Estado_Proceso` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Estado_Proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado_proceso`
--

LOCK TABLES `tbl_estado_proceso` WRITE;
/*!40000 ALTER TABLE `tbl_estado_proceso` DISABLE KEYS */;
INSERT INTO `tbl_estado_proceso` VALUES (1,'En proceso'),(2,'Finalizado'),(3,'Cancelado');
/*!40000 ALTER TABLE `tbl_estado_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado_venta`
--

DROP TABLE IF EXISTS `tbl_estado_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_estado_venta` (
  `Id_Estado_Venta` int NOT NULL AUTO_INCREMENT,
  `Nombre_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Estado_Venta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado_venta`
--

LOCK TABLES `tbl_estado_venta` WRITE;
/*!40000 ALTER TABLE `tbl_estado_venta` DISABLE KEYS */;
INSERT INTO `tbl_estado_venta` VALUES (1,'Activo'),(2,'En Proceso');
/*!40000 ALTER TABLE `tbl_estado_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inventario`
--

DROP TABLE IF EXISTS `tbl_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_inventario` (
  `Id_Inventario` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` int NOT NULL,
  `Existencia` int DEFAULT NULL,
  PRIMARY KEY (`Id_Inventario`),
  KEY `fk_TBL_INVENTARIO_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  CONSTRAINT `FK_Id_Producto_TBL_INVENTARIO_TBL_PRODUCTOS` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inventario`
--

LOCK TABLES `tbl_inventario` WRITE;
/*!40000 ALTER TABLE `tbl_inventario` DISABLE KEYS */;
INSERT INTO `tbl_inventario` VALUES (1,3,4),(2,4,2),(3,1,-1),(4,2,15),(5,5,8),(6,7,0),(7,8,0),(8,9,0),(9,10,20);
/*!40000 ALTER TABLE `tbl_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kardex`
--

DROP TABLE IF EXISTS `tbl_kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kardex` (
  `Id_Kardex` int NOT NULL AUTO_INCREMENT,
  `Id_Usuario` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Id_Tipo_Movimiento` int DEFAULT NULL,
  `Cantidad` int DEFAULT NULL,
  `Fecha_hora` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Kardex`),
  KEY `fk_TBL_KARDEX_TBL_TIPO_MOVIMIENTO1_idx` (`Id_Tipo_Movimiento`),
  KEY `fk_TBL_KARDEX_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `fk_TBL_KARDEX_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  CONSTRAINT `fk_TBL_KARDEX_TBL_TIPO_MOVIMIENTO1` FOREIGN KEY (`Id_Tipo_Movimiento`) REFERENCES `tbl_tipo_movimiento` (`Id_Tipo_Movimiento`),
  CONSTRAINT `tbl_kardex_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kardex`
--

LOCK TABLES `tbl_kardex` WRITE;
/*!40000 ALTER TABLE `tbl_kardex` DISABLE KEYS */;
INSERT INTO `tbl_kardex` VALUES (97,21,3,1,1,'2023-04-21 20:55:00'),(98,21,3,1,1,'2023-04-21 21:01:24'),(99,21,3,2,1,'2023-04-21 21:03:00'),(100,21,1,1,5,'2023-04-21 21:03:14'),(101,21,2,1,5,'2023-04-21 21:03:45'),(102,21,1,2,5,'2023-04-21 21:04:19'),(103,21,2,2,5,'2023-04-21 21:04:19'),(104,21,1,2,4,'2023-04-21 21:08:34'),(105,21,5,2,4,'2023-04-21 21:08:34'),(106,21,3,1,1,'2023-04-21 21:37:52'),(107,21,3,2,1,'2023-04-21 21:39:12'),(108,21,1,1,5,'2023-04-21 21:39:54'),(109,21,1,2,5,'2023-04-21 21:40:39'),(110,21,1,2,5,'2023-04-21 21:44:50'),(111,21,2,2,3,'2023-04-21 21:44:50'),(112,21,5,2,4,'2023-04-21 21:44:50'),(113,21,1,2,2,'2023-04-24 15:03:14'),(114,21,2,2,2,'2023-04-24 15:03:14'),(115,21,5,2,2,'2023-04-24 15:03:14'),(116,21,3,1,1,'2023-04-26 21:34:19'),(117,21,3,1,1,'2023-04-26 21:35:04'),(118,21,3,2,1,'2023-04-26 21:39:31'),(119,21,1,1,5,'2023-04-26 21:40:24'),(120,21,5,1,4,'2023-04-26 21:40:38'),(121,21,1,2,5,'2023-04-26 21:41:38'),(122,21,5,2,4,'2023-04-26 21:41:38'),(123,21,1,2,3,'2023-04-26 21:47:03'),(124,21,5,2,2,'2023-04-26 21:47:03'),(125,21,2,2,3,'2023-04-26 21:47:03'),(126,21,2,2,1,'2023-04-26 21:47:03'),(127,21,5,2,1,'2023-04-26 21:47:03'),(128,21,2,2,1,'2023-04-26 21:49:46'),(129,21,5,2,1,'2023-04-26 21:49:46'),(130,21,1,2,5,'2023-04-27 15:13:58'),(131,21,3,1,1,'2023-05-12 21:22:32'),(132,21,1,2,2,'2023-05-12 21:26:27'),(133,21,1,2,10,'2023-05-12 21:26:27'),(134,21,3,1,1,'2023-06-21 15:16:55'),(135,21,3,2,2,'2023-06-21 15:18:19'),(136,21,1,1,10,'2023-06-21 15:18:36'),(137,21,5,1,8,'2023-06-21 15:18:43'),(138,21,2,1,15,'2023-06-21 15:18:55'),(139,21,1,2,2,'2023-06-21 15:23:28'),(140,21,1,2,2,'2023-06-21 15:23:28');
/*!40000 ALTER TABLE `tbl_kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_bitacora`
--

DROP TABLE IF EXISTS `tbl_ms_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_bitacora` (
  `Id_bitacora` int NOT NULL AUTO_INCREMENT,
  `Id_Usuario` int NOT NULL,
  `Id_Objeto` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Accion` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id_bitacora`),
  KEY `fk_TBL_MS_BITACORA_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  KEY `fk_TBL_MS_BITACORA_TBL_OBJETOS1_idx` (`Id_Objeto`),
  CONSTRAINT `FK_Id_Objeto_TBL_BITACORA_TBL_OBJETOS` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_objetos` (`Id_Objeto`),
  CONSTRAINT `FK_Id_Usuario_TBL_MS_BITACORA_TBL_MS_USUARIOS` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2802 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_bitacora`
--

LOCK TABLES `tbl_ms_bitacora` WRITE;
/*!40000 ALTER TABLE `tbl_ms_bitacora` DISABLE KEYS */;
INSERT INTO `tbl_ms_bitacora` VALUES (1415,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1416,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1417,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1418,21,4,'2023-04-19','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1419,21,1,'2023-04-19','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1420,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1421,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1422,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1423,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1424,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1425,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1426,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1427,21,37,'2023-04-20','Actualizar','Se actualizó un rol'),(1428,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1429,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1430,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1431,21,37,'2023-04-20','Actualizar','Se actualizó un rol'),(1432,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1433,21,24,'2023-04-20','Ingresar','Se ingresó a la pantalla de Ventas'),(1434,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1435,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1436,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1437,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1438,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1439,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1440,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1441,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1442,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1443,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1444,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1445,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1446,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1447,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1448,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1449,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1450,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1451,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1452,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1453,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1454,21,40,'2023-04-20','Actualizar','Se actualizó un parámetro'),(1455,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1456,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1457,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1458,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1459,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1460,21,40,'2023-04-20','Ingresar','Se ingresó a la pantalla de parámetros'),(1461,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1462,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1463,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1464,21,29,'2023-04-20','Ingresar','Se ingresó a la pantalla de Compras'),(1465,21,29,'2023-04-20','Ingresar','Se ingresó a la pantalla de Compras'),(1466,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1467,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1468,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1469,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1470,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1471,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1472,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1473,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1474,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1475,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1476,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1477,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1478,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1479,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1480,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1481,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1482,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1483,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1484,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1485,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1486,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1487,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1488,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1489,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1490,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1491,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1492,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1493,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1494,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1495,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1496,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1497,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1498,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1499,21,33,'2023-04-20','Ingresar','Se ingresó a la pantalla de Inventario'),(1500,21,1,'2023-04-20','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1501,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1502,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1503,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1504,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1505,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1506,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1507,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1508,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1509,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1510,21,42,'2023-04-20','Ingresar','Se ingresó a la pantalla de cargos'),(1511,21,42,'2023-04-20','Ingresar','Se ingresó a la pantalla de cargos'),(1512,21,31,'2023-04-20','Ingresar','Se ingresó a la pantalla de preguntas'),(1513,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1514,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1515,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1516,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1517,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1518,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1519,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1520,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1521,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1522,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1523,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1524,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1525,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1526,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1527,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1528,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1529,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1530,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1531,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1532,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1533,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1534,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1535,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1536,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1537,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1538,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1539,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1540,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1541,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1542,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1543,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1544,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1545,21,37,'2023-04-20','Insertar','Se insertó un  rol'),(1546,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1547,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1548,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1549,21,37,'2023-04-20','Eliminar','Se eliminó un  rol'),(1550,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1551,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1552,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1553,21,36,'2023-04-20','Actualizar','Se actualizó un usuario'),(1554,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1555,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1556,21,37,'2023-04-20','Actualizar','Se actualizó un rol'),(1557,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1558,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1559,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1560,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1561,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1562,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1563,21,36,'2023-04-20','Insertar','Se insertó un usuario'),(1564,21,36,'2023-04-20','Insertar','Se insertó un usuario'),(1565,21,36,'2023-04-20','Ingresar','Se ingresó a la pantalla de usuarios'),(1566,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1567,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1568,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1569,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1570,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1571,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1572,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1573,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1574,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1575,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1576,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1577,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1578,21,37,'2023-04-20','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1579,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1580,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1581,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1582,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1583,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1584,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1585,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1586,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1587,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1588,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1589,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1590,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1591,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1592,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1593,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1594,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1595,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1596,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1597,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1598,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1599,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1600,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1601,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1602,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1603,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1604,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1605,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1606,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1607,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1608,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1609,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1610,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1611,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1612,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1613,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1614,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1615,21,37,'2023-04-21','Actualizar','Se actualizó un rol'),(1616,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1617,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1618,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1619,21,31,'2023-04-21','Actualizar','Se actualizó una pregunta'),(1620,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1621,21,41,'2023-04-21','Ingresar','Se ingresó a la pantalla de objetos'),(1622,21,41,'2023-04-21','Ingresar','Se ingresó a la pantalla de objetos'),(1623,21,41,'2023-04-21','Ingresar','Se ingresó a la pantalla de objetos'),(1624,21,41,'2023-04-21','Ingresar','Se ingresó a la pantalla de objetos'),(1625,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1626,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1627,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1628,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1629,21,4,'2023-04-20','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1630,21,1,'2023-04-20','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1631,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1632,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1633,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1634,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1635,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1636,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1637,21,47,'2023-04-21','Insertar','Se insertó un nuevo de contacto de un Cliente'),(1638,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1639,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1640,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1641,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1642,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1643,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1644,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1645,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1646,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1647,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1648,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1649,21,47,'2023-04-21','Insertar','Se insertó un nuevo de contacto de un Cliente'),(1650,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1651,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1652,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1653,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1654,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1655,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1656,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1657,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1658,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1659,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1660,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1661,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1662,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1663,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1664,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1665,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1666,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1667,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1668,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1669,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1670,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1671,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1672,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1673,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1674,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1675,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1676,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1677,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1678,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1679,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1680,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1681,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1682,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1683,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1684,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1685,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1686,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1687,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1688,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1689,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1690,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1691,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1692,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1693,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1694,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1695,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1696,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1697,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1698,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1699,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1700,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1701,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1702,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1703,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1704,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1705,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1706,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1707,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1708,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1709,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1710,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1711,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1712,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1713,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1714,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1715,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1716,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1717,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1718,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1719,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1720,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1721,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1722,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1723,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1724,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1725,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1726,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1727,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1728,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1729,21,29,'2023-04-21','Ingresar','Se ingresó a la pantalla de Compras'),(1730,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1731,21,30,'2023-04-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(1732,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1733,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1734,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1735,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1736,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1737,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1738,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1739,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1740,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1741,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1742,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1743,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1744,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1745,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1746,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1747,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1748,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1749,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1750,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1751,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1752,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1753,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1754,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1755,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1756,21,33,'2023-04-21','Ingresar','Se ingresó a la pantalla de Inventario'),(1757,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1758,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1759,21,47,'2023-04-21','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1760,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1761,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1762,21,24,'2023-04-21','Ingresar','Se ingresó a la pantalla de Ventas'),(1763,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1764,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1765,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1766,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1767,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1768,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1769,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1770,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1771,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1772,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1773,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1774,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1775,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1776,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1777,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1778,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1779,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1780,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1781,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1782,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1783,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1784,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1785,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1786,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1787,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1788,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1789,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1790,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1791,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1792,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1793,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1794,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1795,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1796,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1797,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1798,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1799,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1800,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1801,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1802,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1803,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1804,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1805,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1806,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1807,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1808,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1809,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1810,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1811,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1812,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1813,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1814,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1815,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1816,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1817,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1818,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1819,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1820,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1821,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1822,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1823,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1824,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1825,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1826,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1827,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1828,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1829,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1830,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1831,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1832,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1833,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1834,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1835,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1836,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1837,21,37,'2023-04-21','Eliminar','Se eliminó un  rol'),(1838,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1839,21,37,'2023-04-21','Insertar','Se insertó un  rol'),(1840,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1841,21,37,'2023-04-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1842,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1843,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1844,21,31,'2023-04-21','Eliminar','Se eliminó una pregunta'),(1845,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1846,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1847,21,31,'2023-04-21','Actualizar','Se actualizó una pregunta'),(1848,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1849,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1850,21,31,'2023-04-21','Actualizar','Se actualizó una pregunta'),(1851,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1852,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1853,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1854,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1855,21,36,'2023-04-21','Ingresar','Se ingresó a la pantalla de usuarios'),(1856,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1857,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1858,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1859,21,31,'2023-04-21','Actualizar','Se actualizó una pregunta'),(1860,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1861,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1862,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1863,21,40,'2023-04-21','Ingresar','Se ingresó a la pantalla de parámetros'),(1864,21,41,'2023-04-21','Ingresar','Se ingresó a la pantalla de objetos'),(1865,21,41,'2023-04-21','Ingresar','Se ingresó a la pantalla de objetos'),(1866,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1867,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1868,21,31,'2023-04-21','Insertar','Se insertó una pregunta'),(1869,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1870,21,31,'2023-04-21','Eliminar','Se eliminó una pregunta'),(1871,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1872,21,31,'2023-04-21','Insertar','Se insertó una pregunta'),(1873,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1874,21,31,'2023-04-21','Eliminar','Se eliminó una pregunta'),(1875,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1876,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1877,21,31,'2023-04-21','Insertar','Se insertó una pregunta'),(1878,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1879,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1880,21,31,'2023-04-21','Insertar','Se insertó una pregunta'),(1881,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1882,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1883,21,31,'2023-04-21','Eliminar','Se eliminó una pregunta'),(1884,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1885,21,31,'2023-04-21','Insertar','Se insertó una pregunta'),(1886,21,31,'2023-04-21','Ingresar','Se ingresó a la pantalla de preguntas'),(1887,21,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1888,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1889,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1890,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1891,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1892,51,1,'2023-04-21','Inicio de Sesión','El usuario CORREGIDO ha ingresado al sistema'),(1893,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1894,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(1895,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1896,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1897,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1898,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1899,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1900,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(1901,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1902,51,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1903,51,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1904,51,4,'2023-04-21','Cierre de Sesión','El usuario CORREGIDO ha cerrado sesión'),(1905,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1906,21,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1907,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1908,21,37,'2023-04-22','Eliminar','Se eliminó un  rol'),(1909,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1910,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1911,21,37,'2023-04-22','Insertar','Se insertó un  rol'),(1912,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1913,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1914,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1915,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1916,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1917,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1918,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1919,21,37,'2023-04-22','Eliminar','Se eliminó un  rol'),(1920,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1921,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(1922,21,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1923,21,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1924,21,31,'2023-04-22','Ingresar','Se ingresó a la pantalla de preguntas'),(1925,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1926,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(1927,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1928,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1929,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(1930,51,1,'2023-04-21','Inicio de Sesión','El usuario CORREGIDO ha ingresado al sistema'),(1931,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1932,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1933,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1934,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1935,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1936,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1937,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1938,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1939,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1940,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1941,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1942,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(1943,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(1944,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1945,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1946,51,45,'2023-04-22','Ingresar','Se ingresó a la pantalla de talonario'),(1947,51,45,'2023-04-22','Actualizar','Se actualizó un registro de Talonario'),(1948,51,45,'2023-04-22','Ingresar','Se ingresó a la pantalla de talonario'),(1949,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1950,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1951,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1952,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1953,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1954,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1955,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1956,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1957,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1958,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1959,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1960,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1961,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1962,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1963,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1964,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1965,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1966,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1967,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1968,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(1969,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(1970,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1971,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1972,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1973,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1974,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1975,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1976,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1977,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1978,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1979,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1980,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(1981,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1982,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1983,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(1984,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1985,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1986,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1987,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1988,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(1989,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1990,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1991,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1992,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1993,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(1994,51,34,'2023-04-22','Insertar','Se insertó un Producto'),(1995,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(1996,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1997,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1998,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(1999,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2000,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2001,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2002,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2003,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2004,51,34,'2023-04-22','Eliminar','Se eliminó un Producto'),(2005,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2006,51,34,'2023-04-22','Eliminar','Se eliminó un Producto'),(2007,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2008,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2009,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2010,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2011,51,4,'2023-04-21','Cierre de Sesión','El usuario CORREGIDO ha cerrado sesión'),(2012,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2013,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2014,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2015,51,1,'2023-04-21','Inicio de Sesión','El usuario CORREGIDO ha ingresado al sistema'),(2016,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2017,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2018,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2019,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2020,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2021,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2022,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2023,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2024,51,42,'2023-04-22','Eliminar','Se eliminó un cargo'),(2025,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2026,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2027,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2028,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2029,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2030,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2031,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2032,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2033,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2034,51,46,'2023-04-22','Insertar','Se insertó un nuevo contacto de un proveedor'),(2035,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2036,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2037,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2038,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2039,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2040,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2041,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2042,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2043,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2044,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2045,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2046,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2047,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2048,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2049,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2050,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2051,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2052,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2053,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2054,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2055,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2056,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2057,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2058,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2059,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2060,51,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2061,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2062,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2063,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2064,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2065,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2066,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2067,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2068,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2069,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2070,51,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2071,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2072,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2073,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2074,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2075,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2076,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2077,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2078,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2079,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2080,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2081,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2082,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2083,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2084,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2085,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2086,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2087,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2088,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2089,51,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2090,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2091,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2092,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2093,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2094,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2095,51,42,'2023-04-22','Eliminar','Se eliminó un cargo'),(2096,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2097,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2098,51,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2099,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2100,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(2101,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2102,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2103,51,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2104,51,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2105,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2106,51,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2107,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2108,51,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2109,51,4,'2023-04-21','Cierre de Sesión','El usuario CORREGIDO ha cerrado sesión'),(2110,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2111,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2112,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2113,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2114,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2115,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2116,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2117,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2118,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2119,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2120,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2121,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2122,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2123,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2124,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2125,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2126,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2127,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2128,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2129,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2130,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2131,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2132,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2133,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2134,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2135,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2136,21,46,'2023-04-22','Insertar','Se eliminó un contacto de un proveedor'),(2137,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2138,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2139,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2140,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2141,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2142,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2143,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2144,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2145,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2146,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2147,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2148,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2149,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2150,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2151,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2152,21,46,'2023-04-22','Insertar','Se insertó un nuevo contacto de un proveedor'),(2153,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2154,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2155,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2156,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2157,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2158,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2159,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2160,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2161,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2162,21,47,'2023-04-22','Insertar','Se insertó un nuevo de contacto de un Cliente'),(2163,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2164,21,47,'2023-04-22','Actualizar','Se actualizó un contacto de un Cliente'),(2165,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2166,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2167,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2168,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2169,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2170,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2171,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2172,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2173,21,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2174,21,34,'2023-04-22','Insertar','Se insertó un Producto'),(2175,21,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2176,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2177,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2178,51,1,'2023-04-21','Inicio de Sesión','El usuario CORREGIDO ha ingresado al sistema'),(2179,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2180,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(2181,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2182,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2183,51,4,'2023-04-21','Cierre de Sesión','El usuario CORREGIDO ha cerrado sesión'),(2184,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2185,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2186,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2187,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2188,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2189,21,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2190,21,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2191,21,42,'2023-04-22','Insertar','Se insertó un cargo'),(2192,21,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2193,21,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2194,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2195,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2196,21,47,'2023-04-22','Actualizar','Se actualizó un contacto de un Cliente'),(2197,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2198,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2199,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2200,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2201,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2202,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2203,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2204,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2205,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2206,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2207,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2208,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2209,21,1,'2023-04-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2210,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2211,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2212,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2213,21,29,'2023-04-22','Ingresar','Se ingresó a la pantalla de Compras'),(2214,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2215,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2216,21,46,'2023-04-22','Insertar','Se insertó un nuevo contacto de un proveedor'),(2217,21,46,'2023-04-22','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2218,21,30,'2023-04-22','Ingresar','Se ingresó a la pantalla de Proveedores'),(2219,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2220,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2221,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2222,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2223,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2224,21,47,'2023-04-22','Insertar','Se insertó un nuevo de contacto de un Cliente'),(2225,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2226,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2227,21,47,'2023-04-22','Actualizar','Se actualizó un contacto de un Cliente'),(2228,21,47,'2023-04-22','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2229,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2230,21,24,'2023-04-22','Ingresar','Se ingresó a la pantalla de Ventas'),(2231,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2232,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2233,21,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2234,21,34,'2023-04-22','Insertar','Se insertó un Producto'),(2235,21,34,'2023-04-22','Ingresar','Se ingresó a la pantalla de Productos'),(2236,21,33,'2023-04-22','Ingresar','Se ingresó a la pantalla de Inventario'),(2237,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2238,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2239,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2240,21,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2241,21,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2242,21,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2243,21,42,'2023-04-22','Ingresar','Se ingresó a la pantalla de cargos'),(2244,21,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2245,21,4,'2023-04-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2246,51,1,'2023-04-21','Inicio de Sesión','El usuario CORREGIDO ha ingresado al sistema'),(2247,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2248,51,36,'2023-04-22','Actualizar','Se actualizó un usuario'),(2249,51,36,'2023-04-22','Ingresar','Se ingresó a la pantalla de usuarios'),(2250,51,37,'2023-04-22','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2251,21,1,'2023-04-22','Inicio de Sesión fallido','El usuario ADMINISTRADOR ha intentado ingresar al sistema'),(2252,21,1,'2023-04-22','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2253,21,37,'2023-04-23','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2254,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2255,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2256,21,37,'2023-04-23','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2257,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2258,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2259,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2260,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2261,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2262,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2263,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2264,21,4,'2023-04-22','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2265,21,1,'2023-04-22','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2266,21,37,'2023-04-23','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2267,21,37,'2023-04-23','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2268,21,37,'2023-04-23','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2269,21,24,'2023-04-23','Ingresar','Se ingresó a la pantalla de Ventas'),(2270,21,29,'2023-04-23','Ingresar','Se ingresó a la pantalla de Compras'),(2271,21,1,'2023-04-23','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2272,21,29,'2023-04-23','Ingresar','Se ingresó a la pantalla de Compras'),(2273,21,29,'2023-04-23','Ingresar','Se ingresó a la pantalla de Compras'),(2274,21,1,'2023-04-23','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2275,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2276,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2277,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2278,21,37,'2023-04-24','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2279,21,34,'2023-04-24','Ingresar','Se ingresó a la pantalla de Productos'),(2280,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2281,21,40,'2023-04-24','Ingresar','Se ingresó a la pantalla de parámetros'),(2282,21,37,'2023-04-24','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2283,21,33,'2023-04-24','Ingresar','Se ingresó a la pantalla de Inventario'),(2284,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2285,21,42,'2023-04-24','Ingresar','Se ingresó a la pantalla de especies'),(2286,21,42,'2023-04-24','Insertar','Se insertó una especie'),(2287,21,42,'2023-04-24','Ingresar','Se ingresó a la pantalla de especies'),(2288,21,42,'2023-04-24','Ingresar','Se ingresó a la pantalla de especies'),(2289,21,29,'2023-04-24','Ingresar','Se ingresó a la pantalla de Compras'),(2290,21,42,'2023-04-24','Ingresar','Se ingresó a la pantalla de especies'),(2291,21,29,'2023-04-24','Ingresar','Se ingresó a la pantalla de Compras'),(2292,21,44,'2023-04-24','Ingresar','Se ingresó a la pantalla de Tipos de productos'),(2293,21,1,'2023-04-24','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2294,21,40,'2023-04-24','Ingresar','Se ingresó a la pantalla de parámetros'),(2295,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2296,21,1,'2023-04-24','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2297,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2298,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2299,21,33,'2023-04-24','Ingresar','Se ingresó a la pantalla de Inventario'),(2300,21,34,'2023-04-24','Ingresar','Se ingresó a la pantalla de Productos'),(2301,21,34,'2023-04-24','Ingresar','Se ingresó a la pantalla de Productos'),(2302,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2303,21,24,'2023-04-24','Ingresar','Se ingresó a la pantalla de Ventas'),(2304,21,4,'2023-04-24','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2305,21,1,'2023-04-24','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2306,21,24,'2023-04-25','Ingresar','Se ingresó a la pantalla de Ventas'),(2307,21,37,'2023-04-25','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2308,21,24,'2023-04-25','Ingresar','Se ingresó a la pantalla de Ventas'),(2309,21,37,'2023-04-25','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2310,21,4,'2023-04-24','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2311,21,1,'2023-04-24','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2312,21,4,'2023-04-24','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2313,21,1,'2023-04-24','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2314,21,4,'2023-04-24','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2315,21,8,'2023-04-24','Recuperar Contraseña','Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),(2316,21,1,'2023-04-24','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2317,21,24,'2023-04-25','Ingresar','Se ingresó a la pantalla de Ventas'),(2318,21,24,'2023-04-25','Ingresar','Se ingresó a la pantalla de Ventas'),(2319,21,33,'2023-04-25','Ingresar','Se ingresó a la pantalla de Inventario'),(2320,21,24,'2023-04-25','Ingresar','Se ingresó a la pantalla de Ventas'),(2321,21,29,'2023-04-25','Ingresar','Se ingresó a la pantalla de Compras'),(2322,21,42,'2023-04-25','Ingresar','Se ingresó a la pantalla de especies'),(2323,21,34,'2023-04-25','Ingresar','Se ingresó a la pantalla de Productos'),(2324,21,42,'2023-04-25','Ingresar','Se ingresó a la pantalla de especies'),(2325,21,29,'2023-04-25','Ingresar','Se ingresó a la pantalla de Compras'),(2326,21,29,'2023-04-25','Ingresar','Se ingresó a la pantalla de Compras'),(2327,21,42,'2023-04-25','Ingresar','Se ingresó a la pantalla de especies'),(2328,21,30,'2023-04-25','Ingresar','Se ingresó a la pantalla de Proveedores'),(2329,21,33,'2023-04-25','Ingresar','Se ingresó a la pantalla de Inventario'),(2330,21,46,'2023-04-25','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2331,21,30,'2023-04-25','Ingresar','Se ingresó a la pantalla de Proveedores'),(2332,21,30,'2023-04-25','Ingresar','Se ingresó a la pantalla de Proveedores'),(2333,21,48,'2023-04-25','Ingresar','Se ingresó a la pantalla de Tipos de contactos'),(2334,21,42,'2023-04-25','Ingresar','Se ingresó a la pantalla de especies'),(2335,21,4,'2023-04-24','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2336,21,8,'2023-04-24','Recuperar Contraseña','Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),(2337,21,8,'2023-04-24','Recuperar Contraseña','Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),(2338,21,8,'2023-04-24','Recuperar Contraseña','Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),(2339,21,1,'2023-04-25','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2340,21,41,'2023-04-25','Ingresar','Se ingresó a la pantalla de objetos'),(2341,21,37,'2023-04-25','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2342,21,37,'2023-04-25','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2343,21,40,'2023-04-25','Ingresar','Se ingresó a la pantalla de parámetros'),(2344,21,40,'2023-04-25','Ingresar','Se ingresó a la pantalla de parámetros'),(2345,21,31,'2023-04-26','Ingresar','Se ingresó a la pantalla de preguntas'),(2346,21,41,'2023-04-26','Ingresar','Se ingresó a la pantalla de objetos'),(2347,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2348,21,4,'2023-04-25','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2349,21,8,'2023-04-25','Recuperar Contraseña','Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),(2350,21,1,'2023-04-25','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2351,21,40,'2023-04-26','Ingresar','Se ingresó a la pantalla de parámetros'),(2352,21,33,'2023-04-26','Ingresar','Se ingresó a la pantalla de Inventario'),(2353,21,33,'2023-04-26','Ingresar','Se ingresó a la pantalla de Inventario'),(2354,21,33,'2023-04-26','Ingresar','Se ingresó a la pantalla de Inventario'),(2355,21,33,'2023-04-26','Ingresar','Se ingresó a la pantalla de Inventario'),(2356,21,36,'2023-04-26','Ingresar','Se ingresó a la pantalla de usuarios'),(2357,21,36,'2023-04-26','Eliminar','Se eliminó un usuario'),(2358,21,36,'2023-04-26','Ingresar','Se ingresó a la pantalla de usuarios'),(2359,21,36,'2023-04-26','Ingresar','Se ingresó a la pantalla de usuarios'),(2360,21,36,'2023-04-26','Eliminar','Se eliminó un usuario'),(2361,21,36,'2023-04-26','Ingresar','Se ingresó a la pantalla de usuarios'),(2362,21,4,'2023-04-26','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2363,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2364,21,36,'2023-04-26','Ingresar','Se ingresó a la pantalla de usuarios'),(2365,21,36,'2023-04-26','Insertar','Se insertó un usuario'),(2366,21,36,'2023-04-26','Ingresar','Se ingresó a la pantalla de usuarios'),(2367,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2368,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2369,21,37,'2023-04-26','Insertar','Se insertó un  rol'),(2370,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2371,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2372,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2373,21,37,'2023-04-26','Actualizar','Se actualizó un rol'),(2374,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2375,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2376,21,37,'2023-04-26','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2377,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2378,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2379,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2380,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2381,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2382,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2383,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2384,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2385,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2386,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2387,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2388,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2389,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2390,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2391,21,46,'2023-04-27','Insertar','Se insertó un nuevo contacto de un proveedor'),(2392,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2393,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2394,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2395,21,47,'2023-04-27','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2396,21,47,'2023-04-27','Insertar','Se insertó un nuevo de contacto de un Cliente'),(2397,21,47,'2023-04-27','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2398,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2399,21,4,'2023-04-26','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2400,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2401,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2402,21,4,'2023-04-26','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2403,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2404,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2405,21,4,'2023-04-26','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2406,70,6,'2023-04-26','Auto registro','Se ha auto registrado el Usuario RUEBAC'),(2407,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2408,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2409,21,36,'2023-04-27','Insertar','Se insertó un usuario'),(2410,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2411,71,13,'2023-04-26','Configurar Preguntas Secretas','El usuario CAPACITACION ha configurado sus preguntas secretas'),(2412,71,5,'2023-04-26','Cambio de contraseña(Usuario Nuevo)','El usuario CAPACITACION ha cambiado la contraseña'),(2413,71,8,'2023-04-26','Recuperar Contraseña','Se envio correo para cambio de contraseña al usuario CAPACITACION'),(2414,71,8,'2023-04-26','Contraseña actualizada con éxito','El usuario CAPACITACION ha cambiado su contraseña'),(2415,71,1,'2023-04-26','Inicio de Sesión','El usuario CAPACITACION ha ingresado al sistema'),(2416,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2417,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2418,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2419,21,4,'2023-04-26','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2420,71,1,'2023-04-26','Inicio de Sesión','El usuario CAPACITACION ha ingresado al sistema'),(2421,71,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2422,71,4,'2023-04-26','Cierre de Sesión','El usuario CAPACITACION ha cerrado sesión'),(2423,71,12,'2023-04-26','Recuperar contraseña','El usuario CAPACITACION ha solicitado cambiar la contraseña por medio de preguntas secretas'),(2424,71,10,'2023-04-26','Contraseña actualizada con éxito','El usuario CAPACITACION cambió la contraseña por medio de preguntas secretas'),(2425,71,1,'2023-04-26','Inicio de Sesión','El usuario CAPACITACION ha ingresado al sistema'),(2426,71,4,'2023-04-26','Cierre de Sesión','El usuario CAPACITACION ha cerrado sesión'),(2427,21,1,'2023-04-26','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2428,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2429,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2430,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2431,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2432,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2433,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2434,21,30,'2023-04-27','Insertar','Se insertó un nuevo proveedor'),(2435,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2436,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2437,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2438,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2439,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2440,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2441,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2442,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2443,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2444,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2445,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2446,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2447,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2448,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2449,21,29,'2023-04-27','Ingresar','Se ingresó a la pantalla de Compras'),(2450,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2451,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2452,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2453,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2454,21,46,'2023-04-27','Insertar','Se insertó un nuevo contacto de un proveedor'),(2455,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2456,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2457,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2458,21,46,'2023-04-27','Insertar','Se insertó un nuevo contacto de un proveedor'),(2459,21,46,'2023-04-27','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2460,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2461,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2462,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2463,21,30,'2023-04-27','Ingresar','Se ingresó a la pantalla de Proveedores'),(2464,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2465,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2466,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2467,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2468,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2469,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2470,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2471,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2472,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2473,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2474,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2475,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2476,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2477,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2478,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2479,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2480,21,34,'2023-04-27','Ingresar','Se ingresó a la pantalla de Productos'),(2481,21,34,'2023-04-27','Insertar','Se insertó un Producto'),(2482,21,34,'2023-04-27','Ingresar','Se ingresó a la pantalla de Productos'),(2483,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2484,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2485,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Kardex'),(2486,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2487,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2488,21,37,'2023-04-27','Insertar','Se insertó un  rol'),(2489,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2490,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2491,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2492,21,40,'2023-04-27','Ingresar','Se ingresó a la pantalla de parámetros'),(2493,21,40,'2023-04-27','Ingresar','Se ingresó a la pantalla de parámetros'),(2494,21,40,'2023-04-27','Ingresar','Se ingresó a la pantalla de parámetros'),(2495,21,31,'2023-04-27','Ingresar','Se ingresó a la pantalla de preguntas'),(2496,21,41,'2023-04-27','Ingresar','Se ingresó a la pantalla de objetos'),(2497,21,41,'2023-04-27','Ingresar','Se ingresó a la pantalla de objetos'),(2498,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de cargos'),(2499,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de cargos'),(2500,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de especies'),(2501,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de cargos'),(2502,21,42,'2023-04-27','Insertar','Se insertó un cargo'),(2503,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de cargos'),(2504,21,42,'2023-04-27','Actualizar','Se actualizó un cargo'),(2505,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de cargos'),(2506,21,42,'2023-04-27','Eliminar','Se eliminó un cargo'),(2507,21,42,'2023-04-27','Ingresar','Se ingresó a la pantalla de cargos'),(2508,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2509,21,36,'2023-04-27','Actualizar','Se actualizó un usuario'),(2510,21,36,'2023-04-27','Actualizar','Se actualizó un usuario'),(2511,21,36,'2023-04-27','Actualizar','Se actualizó un usuario'),(2512,21,36,'2023-04-27','Actualizar','Se actualizó un usuario'),(2513,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2514,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2515,21,36,'2023-04-27','Ingresar','Se ingresó a la pantalla de usuarios'),(2516,21,37,'2023-04-27','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2517,21,1,'2023-04-27','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2518,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2519,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2520,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2521,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2522,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2523,21,1,'2023-04-27','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2524,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2525,21,4,'2023-04-27','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2526,21,1,'2023-04-27','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2527,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2528,21,33,'2023-04-27','Ingresar','Se ingresó a la pantalla de Inventario'),(2529,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2530,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2531,21,24,'2023-04-27','Ingresar','Se ingresó a la pantalla de Ventas'),(2532,21,4,'2023-04-27','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2533,21,1,'2023-04-27','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2534,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2535,21,4,'2023-04-27','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2536,21,1,'2023-04-27','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2537,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2538,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2539,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2540,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2541,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2542,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2543,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2544,21,40,'2023-04-28','Ingresar','Se ingresó a la pantalla de parámetros'),(2545,21,1,'2023-04-28','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2546,21,40,'2023-04-28','Ingresar','Se ingresó a la pantalla de parámetros'),(2547,21,40,'2023-04-28','Ingresar','Se ingresó a la pantalla de parámetros'),(2548,21,31,'2023-04-28','Ingresar','Se ingresó a la pantalla de preguntas'),(2549,21,31,'2023-04-28','Ingresar','Se ingresó a la pantalla de preguntas'),(2550,21,31,'2023-04-28','Ingresar','Se ingresó a la pantalla de preguntas'),(2551,21,31,'2023-04-28','Ingresar','Se ingresó a la pantalla de preguntas'),(2552,21,31,'2023-04-28','Ingresar','Se ingresó a la pantalla de preguntas'),(2553,21,41,'2023-04-28','Ingresar','Se ingresó a la pantalla de objetos'),(2554,21,41,'2023-04-28','Ingresar','Se ingresó a la pantalla de objetos'),(2555,21,41,'2023-04-28','Insertar','Se insertó un objeto'),(2556,21,41,'2023-04-28','Ingresar','Se ingresó a la pantalla de objetos'),(2557,21,36,'2023-04-28','Ingresar','Se ingresó a la pantalla de usuarios'),(2558,21,44,'2023-04-28','Ingresar','Se ingresó a la pantalla de Tipos de productos'),(2559,21,44,'2023-04-28','Ingresar','Se ingresó a la pantalla de Tipos de productos'),(2560,21,41,'2023-04-28','Ingresar','Se ingresó a la pantalla de objetos'),(2561,21,24,'2023-04-28','Ingresar','Se ingresó a la pantalla de Ventas'),(2562,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2563,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2564,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2565,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2566,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2567,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2568,21,37,'2023-04-28','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2569,21,24,'2023-04-28','Ingresar','Se ingresó a la pantalla de Ventas'),(2570,21,37,'2023-04-29','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2571,21,40,'2023-04-29','Ingresar','Se ingresó a la pantalla de parámetros'),(2572,21,40,'2023-04-29','Ingresar','Se ingresó a la pantalla de parámetros'),(2573,21,31,'2023-04-29','Ingresar','Se ingresó a la pantalla de preguntas'),(2574,21,41,'2023-04-29','Ingresar','Se ingresó a la pantalla de objetos'),(2575,21,37,'2023-04-29','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2576,21,37,'2023-04-29','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2577,21,4,'2023-04-28','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2578,21,1,'2023-04-28','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2579,21,36,'2023-04-29','Ingresar','Se ingresó a la pantalla de usuarios'),(2580,21,29,'2023-04-29','Ingresar','Se ingresó a la pantalla de Compras'),(2581,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de especies'),(2582,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de especies'),(2583,21,29,'2023-04-29','Ingresar','Se ingresó a la pantalla de Compras'),(2584,21,24,'2023-04-29','Ingresar','Se ingresó a la pantalla de Ventas'),(2585,21,37,'2023-04-29','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2586,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de especies'),(2587,21,29,'2023-04-29','Ingresar','Se ingresó a la pantalla de Compras'),(2588,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de especies'),(2589,21,29,'2023-04-29','Ingresar','Se ingresó a la pantalla de Compras'),(2590,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de especies'),(2591,21,30,'2023-04-29','Ingresar','Se ingresó a la pantalla de Proveedores'),(2592,21,46,'2023-04-29','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2593,21,30,'2023-04-29','Ingresar','Se ingresó a la pantalla de Proveedores'),(2594,21,30,'2023-04-29','Ingresar','Se ingresó a la pantalla de Proveedores'),(2595,21,44,'2023-04-29','Ingresar','Se ingresó a la pantalla de Tipos de productos'),(2596,21,24,'2023-04-29','Ingresar','Se ingresó a la pantalla de Ventas'),(2597,21,34,'2023-04-29','Ingresar','Se ingresó a la pantalla de Productos'),(2598,21,33,'2023-04-29','Ingresar','Se ingresó a la pantalla de Inventario'),(2599,21,33,'2023-04-29','Ingresar','Se ingresó a la pantalla de Kardex'),(2600,21,36,'2023-04-29','Ingresar','Se ingresó a la pantalla de usuarios'),(2601,21,37,'2023-04-29','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2602,21,31,'2023-04-29','Ingresar','Se ingresó a la pantalla de preguntas'),(2603,21,41,'2023-04-29','Ingresar','Se ingresó a la pantalla de objetos'),(2604,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de cargos'),(2605,21,48,'2023-04-29','Ingresar','Se ingresó a la pantalla de Tipos de contactos'),(2606,21,50,'2023-04-29','Ingresar','Se ingresó a la pantalla del Estado del proceso'),(2607,21,44,'2023-04-29','Ingresar','Se ingresó a la pantalla de Tipos de productos'),(2608,21,43,'2023-04-29','Ingresar','Se ingresó a la pantalla de Estado de Ventas'),(2609,21,49,'2023-04-29','Ingresar','Se ingresó a la pantalla de Tipos de Movimientos'),(2610,21,49,'2023-04-29','Ingresar','Se ingresó a la pantalla de Tipos de Movimientos'),(2611,21,4,'2023-04-29','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2612,21,12,'2023-04-29','Recuperar contraseña','El usuario ADMINISTRADOR ha solicitado cambiar la contraseña por medio de preguntas secretas'),(2613,21,1,'2023-04-29','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2614,21,24,'2023-04-29','Ingresar','Se ingresó a la pantalla de Ventas'),(2615,21,24,'2023-04-29','Ingresar','Se ingresó a la pantalla de Ventas'),(2616,21,29,'2023-04-29','Ingresar','Se ingresó a la pantalla de Compras'),(2617,21,42,'2023-04-29','Ingresar','Se ingresó a la pantalla de especies'),(2618,21,1,'2023-05-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2619,21,4,'2023-05-12','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2620,72,6,'2023-05-12','Auto registro','Se ha auto registrado el Usuario KAREN'),(2621,21,1,'2023-05-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2622,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2623,21,36,'2023-05-13','Actualizar','Se actualizó un usuario'),(2624,21,36,'2023-05-13','Actualizar','Se actualizó un usuario'),(2625,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2626,21,4,'2023-05-12','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2627,72,1,'2023-05-12','Inicio de Sesión','El usuario KAREN ha ingresado al sistema'),(2628,72,4,'2023-05-12','Cierre de Sesión','El usuario KAREN ha cerrado sesión'),(2629,21,1,'2023-05-12','Inicio de Sesión fallido','El usuario ADMINISTRADOR ha intentado ingresar al sistema'),(2630,21,1,'2023-05-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2631,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2632,21,42,'2023-05-13','Eliminar','Se eliminó un cargo'),(2633,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2634,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2635,21,43,'2023-05-13','Ingresar','Se ingresó a la pantalla de Estado de Ventas'),(2636,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2637,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2638,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2639,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2640,21,43,'2023-05-13','Ingresar','Se ingresó a la pantalla de Estado de Ventas'),(2641,21,44,'2023-05-13','Ingresar','Se ingresó a la pantalla de Tipos de productos'),(2642,21,46,'2023-05-13','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2643,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2644,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2645,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2646,21,48,'2023-05-13','Ingresar','Se ingresó a la pantalla de Tipos de contactos'),(2647,21,49,'2023-05-13','Ingresar','Se ingresó a la pantalla de Tipos de Movimientos'),(2648,21,49,'2023-05-13','Ingresar','Se ingresó a la pantalla de Tipos de Movimientos'),(2649,21,50,'2023-05-13','Ingresar','Se ingresó a la pantalla del Estado del proceso'),(2650,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2651,21,42,'2023-05-13','Insertar','Se insertó un cargo'),(2652,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2653,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2654,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2655,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de cargos'),(2656,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2657,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2658,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2659,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2660,21,34,'2023-05-13','Ingresar','Se ingresó a la pantalla de Productos'),(2661,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2662,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2663,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2664,21,34,'2023-05-13','Ingresar','Se ingresó a la pantalla de Productos'),(2665,21,34,'2023-05-13','Ingresar','Se ingresó a la pantalla de Productos'),(2666,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2667,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2668,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2669,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Inventario'),(2670,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Kardex'),(2671,21,33,'2023-05-13','Ingresar','Se ingresó a la pantalla de Kardex'),(2672,21,49,'2023-05-13','Ingresar','Se ingresó a la pantalla de Tipos de Movimientos'),(2673,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2674,21,46,'2023-05-13','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2675,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2676,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2677,21,46,'2023-05-13','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2678,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2679,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2680,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2681,21,46,'2023-05-13','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2682,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2683,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2684,21,46,'2023-05-13','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2685,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2686,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2687,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2688,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2689,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2690,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2691,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2692,21,30,'2023-05-13','Ingresar','Se ingresó a la pantalla de Proveedores'),(2693,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2694,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2695,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2696,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2697,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2698,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2699,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2700,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2701,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2702,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2703,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2704,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2705,21,45,'2023-05-13','Ingresar','Se ingresó a la pantalla de talonario'),(2706,21,45,'2023-05-13','Insertar','Se insertó un nuevo registro de Talonario'),(2707,21,45,'2023-05-13','Ingresar','Se ingresó a la pantalla de talonario'),(2708,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2709,21,45,'2023-05-13','Ingresar','Se ingresó a la pantalla de talonario'),(2710,21,45,'2023-05-13','Eliminar','Se eliminó un registro de Talonario'),(2711,21,45,'2023-05-13','Ingresar','Se ingresó a la pantalla de talonario'),(2712,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2713,21,24,'2023-05-13','Ingresar','Se ingresó a la pantalla de Ventas'),(2714,21,47,'2023-05-13','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2715,21,47,'2023-05-13','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2716,21,40,'2023-05-13','Ingresar','Se ingresó a la pantalla de parámetros'),(2717,21,40,'2023-05-13','Ingresar','Se ingresó a la pantalla de parámetros'),(2718,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2719,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2720,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2721,21,4,'2023-05-12','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2722,72,1,'2023-05-12','Inicio de Sesión','El usuario KAREN ha ingresado al sistema'),(2723,72,4,'2023-05-12','Cierre de Sesión','El usuario KAREN ha cerrado sesión'),(2724,21,1,'2023-05-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2725,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2726,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2727,21,4,'2023-05-12','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2728,72,1,'2023-05-12','Inicio de Sesión','El usuario KAREN ha ingresado al sistema'),(2729,72,34,'2023-05-13','Ingresar','Se ingresó a la pantalla de Productos'),(2730,72,4,'2023-05-12','Cierre de Sesión','El usuario KAREN ha cerrado sesión'),(2731,21,1,'2023-05-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2732,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2733,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2734,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2735,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2736,21,42,'2023-05-13','Ingresar','Se ingresó a la pantalla de especies'),(2737,21,29,'2023-05-13','Ingresar','Se ingresó a la pantalla de Compras'),(2738,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2739,21,37,'2023-05-13','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2740,21,36,'2023-05-13','Ingresar','Se ingresó a la pantalla de usuarios'),(2741,21,34,'2023-05-13','Ingresar','Se ingresó a la pantalla de Productos'),(2742,21,1,'2023-06-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2743,21,24,'2023-06-12','Ingresar','Se ingresó a la pantalla de Ventas'),(2744,21,36,'2023-06-12','Ingresar','Se ingresó a la pantalla de usuarios'),(2745,21,30,'2023-06-12','Ingresar','Se ingresó a la pantalla de Proveedores'),(2746,21,1,'2023-06-18','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2747,21,33,'2023-06-19','Ingresar','Se ingresó a la pantalla de Inventario'),(2748,21,1,'2023-06-19','Inicio de Sesión fallido','El usuario ADMINISTRADOR ha intentado ingresar al sistema'),(2749,21,1,'2023-06-19','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2750,21,24,'2023-06-20','Ingresar','Se ingresó a la pantalla de Ventas'),(2751,21,47,'2023-06-20','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2752,21,47,'2023-06-20','Ingresar','Se ingresó a la pantalla de contactos de Clientes'),(2753,21,34,'2023-06-20','Ingresar','Se ingresó a la pantalla de Productos'),(2754,21,29,'2023-06-20','Ingresar','Se ingresó a la pantalla de Compras'),(2755,21,42,'2023-06-20','Ingresar','Se ingresó a la pantalla de especies'),(2756,21,42,'2023-06-20','Ingresar','Se ingresó a la pantalla de especies'),(2757,21,29,'2023-06-20','Ingresar','Se ingresó a la pantalla de Compras'),(2758,21,1,'2023-06-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2759,21,24,'2023-06-21','Ingresar','Se ingresó a la pantalla de Ventas'),(2760,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de especies'),(2761,21,29,'2023-06-21','Ingresar','Se ingresó a la pantalla de Compras'),(2762,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de especies'),(2763,21,29,'2023-06-21','Ingresar','Se ingresó a la pantalla de Compras'),(2764,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2765,21,30,'2023-06-21','Insertar','Se insertó un nuevo proveedor'),(2766,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2767,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2768,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2769,21,46,'2023-06-21','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2770,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2771,21,46,'2023-06-21','Ingresar','Se ingresó a la pantalla de los contactos de proveedores'),(2772,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2773,21,30,'2023-06-21','Ingresar','Se ingresó a la pantalla de Proveedores'),(2774,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de especies'),(2775,21,29,'2023-06-21','Ingresar','Se ingresó a la pantalla de Compras'),(2776,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de especies'),(2777,21,29,'2023-06-21','Ingresar','Se ingresó a la pantalla de Compras'),(2778,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de especies'),(2779,21,29,'2023-06-21','Ingresar','Se ingresó a la pantalla de Compras'),(2780,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2781,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2782,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2783,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2784,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2785,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2786,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2787,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2788,21,34,'2023-06-21','Ingresar','Se ingresó a la pantalla de Productos'),(2789,21,33,'2023-06-21','Ingresar','Se ingresó a la pantalla de Inventario'),(2790,21,24,'2023-06-21','Ingresar','Se ingresó a la pantalla de Ventas'),(2791,21,24,'2023-06-21','Ingresar','Se ingresó a la pantalla de Ventas'),(2792,21,24,'2023-06-21','Ingresar','Se ingresó a la pantalla de Ventas'),(2793,21,37,'2023-06-21','Ingresar','Se ingresó a la pantalla de roles y permisos'),(2794,21,4,'2023-06-21','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(2795,21,1,'2023-06-21','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(2796,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de cargos'),(2797,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de cargos'),(2798,21,42,'2023-06-21','Ingresar','Se ingresó a la pantalla de cargos'),(2799,21,36,'2023-06-21','Ingresar','Se ingresó a la pantalla de usuarios'),(2800,21,36,'2023-06-21','Ingresar','Se ingresó a la pantalla de usuarios'),(2801,21,36,'2023-06-21','Ingresar','Se ingresó a la pantalla de usuarios');
/*!40000 ALTER TABLE `tbl_ms_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_hist_contraseña`
--

DROP TABLE IF EXISTS `tbl_ms_hist_contraseña`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_hist_contraseña` (
  `Id_Historial` int NOT NULL AUTO_INCREMENT,
  `Id_Usuario` int NOT NULL,
  `Contraseña` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id_Historial`),
  KEY `fk_TBL_MS_HIST_CONTRASEÑA_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  CONSTRAINT `FK_Id_Usuario_TBL_MS_HIST_CONTRASEÑA_TBL_MS_USUARIOS` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_hist_contraseña`
--

LOCK TABLES `tbl_ms_hist_contraseña` WRITE;
/*!40000 ALTER TABLE `tbl_ms_hist_contraseña` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ms_hist_contraseña` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_parametros`
--

DROP TABLE IF EXISTS `tbl_ms_parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_parametros` (
  `Id_Parametro` int NOT NULL AUTO_INCREMENT,
  `Parametro` varchar(50) DEFAULT NULL,
  `Valor` varchar(100) DEFAULT NULL,
  `Creado_por` varchar(45) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Modificado_por` varchar(45) DEFAULT NULL,
  `Fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`Id_Parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_parametros`
--

LOCK TABLES `tbl_ms_parametros` WRITE;
/*!40000 ALTER TABLE `tbl_ms_parametros` DISABLE KEYS */;
INSERT INTO `tbl_ms_parametros` VALUES (1,'CORREO_EXP','900',NULL,NULL,NULL,NULL),(2,'ADMIN_VIGENCIA','30',NULL,NULL,NULL,NULL),(3,'ADMIN_INTENTOS','2',NULL,NULL,NULL,NULL),(4,'ADMIN_PREGUNTAS','3',NULL,NULL,NULL,NULL),(5,'MAX_CONTRASENIA','15',NULL,NULL,NULL,NULL),(6,'MIN_CONTRASENIA','8',NULL,NULL,NULL,NULL),(7,'FEC_VENCIMIENTO','30',NULL,NULL,NULL,NULL),(8,'NOMBRE_EMPRESA','Empresa de servicios múltiples jóvenes profesionales de La Sierra de la Paz',NULL,NULL,NULL,NULL),(9,'LOGO','C:\\xampp\\htdocs\\SIIS-Proyecto\\img\\logo.jpg',NULL,NULL,NULL,NULL),(10,'HOST','localhost',NULL,NULL,NULL,NULL),(11,'USER','SIIS2',NULL,NULL,NULL,NULL),(12,'PASSWORD','12345',NULL,NULL,NULL,NULL),(13,'NAME','proyecto-siis',NULL,NULL,NULL,NULL),(14,'ruta','C:\\xampp\\htdocs\\SIIS-Proyecto\\Backups',NULL,NULL,NULL,NULL),(15,'IMPUESTO','10',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_ms_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_preguntas`
--

DROP TABLE IF EXISTS `tbl_ms_preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_preguntas` (
  `Id_Pregunta` int NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_preguntas`
--

LOCK TABLES `tbl_ms_preguntas` WRITE;
/*!40000 ALTER TABLE `tbl_ms_preguntas` DISABLE KEYS */;
INSERT INTO `tbl_ms_preguntas` VALUES (1,'¿Nombre de tu primera mascota?'),(2,'¿Ciudad de  Nacimiento?'),(3,'¿En que escuela estudiaste?'),(4,'¿Que carrera estudiaste?'),(5,'¿Cuál es tu color favorito?'),(6,'¿Cuál es tu clase Favorita?'),(7,'¿Cuál es tu lenguaje de programación favorito?'),(8,'¿Cuál es la fecha del cumpleaños de tu papá?'),(9,'¿Que país te gustaría visitar?'),(10,'CUÁL ES TU TIPO DE SANGRE?'),(11,'¿Cuál es tu comida favorita?'),(13,'¿Prueba?'),(14,'¿PruebaActualizada?'),(19,'¿PruebaNueva?'),(20,'¿PRUEBA NUEVA? '),(21,'PREGUNTA DE PRUEBA'),(26,'¿PRUEBANUEVA?'),(28,'¿QUÉ CARRERA ESTUDIAS?');
/*!40000 ALTER TABLE `tbl_ms_preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_preguntas_usuarios`
--

DROP TABLE IF EXISTS `tbl_ms_preguntas_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_preguntas_usuarios` (
  `Id_Preguntas_Usuario` int NOT NULL AUTO_INCREMENT,
  `Id_Usuario` int NOT NULL,
  `Id_Pregunta` int NOT NULL,
  `Respuesta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_Preguntas_Usuario`),
  KEY `fk_TBL_MS_USUARIOS_has_TBL_MS_PREGUNTAS_TBL_MS_PREGUNTAS1_idx` (`Id_Pregunta`),
  KEY `fk_TBL_MS_USUARIOS_has_TBL_MS_PREGUNTAS_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  CONSTRAINT `FK_Id_Pregunta_TBL_MS_USUARIOS_TBL_MS_PREGUNTAS` FOREIGN KEY (`Id_Pregunta`) REFERENCES `tbl_ms_preguntas` (`Id_Pregunta`),
  CONSTRAINT `FK_Id_Usuario_TBL_MS_PREGUNTAS_TBL_MS_USUARIOS` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_preguntas_usuarios`
--

LOCK TABLES `tbl_ms_preguntas_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_ms_preguntas_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_ms_preguntas_usuarios` VALUES (1,21,1,'Chuchi'),(2,21,2,'Tegucigalpa'),(3,21,3,'Desarrollo Juvenil'),(73,51,1,'Chuchi'),(74,51,2,'Tegucigalpa'),(75,51,3,'Desarrollo Juvenil'),(76,71,1,'Chuchi'),(77,71,2,'Tegucigalpa'),(78,71,28,'Informatica');
/*!40000 ALTER TABLE `tbl_ms_preguntas_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_roles`
--

DROP TABLE IF EXISTS `tbl_ms_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_roles` (
  `Id_Rol` int NOT NULL AUTO_INCREMENT,
  `Rol` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_roles`
--

LOCK TABLES `tbl_ms_roles` WRITE;
/*!40000 ALTER TABLE `tbl_ms_roles` DISABLE KEYS */;
INSERT INTO `tbl_ms_roles` VALUES (1,'ADMINISTRADOR','TODOS LOS PERMISOS'),(2,'USUARIO','Rol por defecto'),(3,'DEFAULT','Ningún permiso'),(74,'INFORMATICA','INFORMATICAS'),(101,'ROL DE PRUEBA','DESCRIPCIÓN DE PRUEBA '),(102,'CAPACITACION','ALGUNOS PERMISOS');
/*!40000 ALTER TABLE `tbl_ms_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ms_usuarios`
--

DROP TABLE IF EXISTS `tbl_ms_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ms_usuarios` (
  `Id_Usuario` int NOT NULL AUTO_INCREMENT,
  `Id_Rol` int NOT NULL,
  `Id_Cargo` int NOT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Nombre` varchar(60) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Contraseña` varchar(15) DEFAULT NULL,
  `Fecha_ultima_conexion` date DEFAULT NULL,
  `Preguntas_contestadas` int DEFAULT NULL,
  `Primer_ingreso` int DEFAULT NULL,
  `Fecha_vencimiento` date DEFAULT NULL,
  `DNI` varchar(16) DEFAULT NULL,
  `Correo_Electronico` varchar(45) DEFAULT NULL,
  `Creado_por` varchar(45) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Modificado_por` varchar(45) DEFAULT NULL,
  `Fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`Id_Usuario`),
  KEY `fk_TBL_MS_USUARIOS_TBL_MS_ROLES1_idx` (`Id_Rol`),
  KEY `fk_TBL_MS_USUARIOS_TBL_CARGOS1_idx` (`Id_Cargo`),
  CONSTRAINT `FK_Id_Rol_TBL_MS_USUARIOS_TBL_MS_ROLES` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_roles` (`Id_Rol`),
  CONSTRAINT `fk_TBL_MS_USUARIOS_TBL_CARGOS1` FOREIGN KEY (`Id_Cargo`) REFERENCES `tbl_cargos` (`Id_Cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_usuarios`
--

LOCK TABLES `tbl_ms_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_ms_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_ms_usuarios` VALUES (21,1,1,'ADMINISTRADOR','CAPACITACION','Activo','Prueba.11','2023-06-21',NULL,246,'2023-05-26','0000000000004','kateandaraRDGT3@gmail.com',NULL,'2023-02-25','','2023-04-26'),(51,1,1,'CORREGIDO','KATE VALLE','Activo','Prueba.2','2023-04-22',3,9,'2023-05-21','0801200011179','kateandara123@gmail.com','ADMINISTRADOR','2023-03-19','KATE','2023-04-21'),(58,2,1,'KATE','KATE','Eliminado','Prueba.1','2023-03-30',NULL,2,'2023-04-19','0801-2000-11179','kateandara1@gmail.com','ADMINISTRADOR','2023-03-19',NULL,NULL),(63,3,2,'ROOT','KATE','Eliminado','Prueba.1','2023-04-16',NULL,2,'2023-05-04','0801-2000-11179','kateandara1@gmail.com',NULL,'2023-04-04','ADMINISTRADOR','2023-04-04'),(64,2,2,'RONY','RONY','','Prueba.1',NULL,NULL,NULL,'2023-05-16','0000000000001','fabriciosuazo.thfb@gmail.com','','2023-04-16','','2023-04-20'),(65,74,1,'USER','Kate','Eliminado','Prueba.11','2023-04-19',NULL,6,'2023-05-16','0801200011178','andarakaterine@gmail.com','','2023-04-16','','2023-04-18'),(69,2,2,'PRUEBAF','ANDARA','Nuevo','Prueba.1',NULL,NULL,NULL,'2023-05-26','0000000000011','vallekat986@gmail.com','','2023-04-26',NULL,NULL),(70,3,2,'RUEBAC','KATE','Nuevo','Prueba.1',NULL,NULL,NULL,'2023-05-27','0000000000001','xxxxx@gmail.com',NULL,'2023-04-27',NULL,NULL),(71,2,2,'CAPACITACION','FANNY','Activo','Prueba.3','2023-04-27',3,3,'2023-05-26','0000000000111','kateandara@gmail.com','','2023-04-26',NULL,NULL),(72,2,2,'KAREN','Karen Aguilera','Activo','Prueba.1','2023-05-13',NULL,3,'2023-06-12','0000000000001','kateandara@gmail.com',NULL,'2023-05-13',NULL,NULL);
/*!40000 ALTER TABLE `tbl_ms_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_objetos`
--

DROP TABLE IF EXISTS `tbl_objetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_objetos` (
  `Id_Objeto` int NOT NULL AUTO_INCREMENT,
  `Objeto` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Tipo_objeto` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_objetos`
--

LOCK TABLES `tbl_objetos` WRITE;
/*!40000 ALTER TABLE `tbl_objetos` DISABLE KEYS */;
INSERT INTO `tbl_objetos` VALUES (1,'login','pantalla de inicio de sesión','pantalla'),(2,'recuperacion_Correo','pantalla de recuperación','pantalla'),(3,'registro','pantalla de autoregistro','pantalla'),(4,'log_out','Cerrar sesión','pantalla'),(5,'cambio_contra','Cambiar  contraseña si es nuevo','Pantalla'),(6,'autoregistro','Autoregistrarse','pantalla'),(7,'inactivo','Usuario inactivo o bloqueado','pantalla'),(8,'cambio_contraC','Actualización de contraseña por correo','pantalla'),(9,'editarusuario','Editar usuarios','pantalla'),(10,'cambio_contraPS','Cambio de contra por medio de preguntas secretas ','pantalla'),(11,'bloqueo','Usuario bloqueadao','pantalla'),(12,'recuperacion_Preguntas','pantalla de recuperación','pantalla'),(13,'PreguntasSecretas','Configuras Preguntas Secretas','pantalla'),(19,'Insertar_Permiso','Insertar Objetos','Pantalla'),(20,'Prueba','Sesión','Pantalla'),(21,'Insertar','Insertar datos','Pantalla'),(24,'Ventas','Ventas','Permiso'),(25,'Descuentos','Descuentos','Permiso'),(26,'Promociones','Promociones','Permiso'),(27,'Detalle de Venta','Detalle de Venta','Permiso'),(28,'Clientes','Clientes','Permiso'),(29,'Compras','Compras','Permiso'),(30,'Proveedores','Proveedores','Permiso'),(31,'Preguntas','Preguntas','Permiso'),(32,'Proceso de Producción','Proceso de Producción','Permiso'),(33,'Inventario','Inventario','Permiso'),(34,'Productos','Productos','Permiso'),(35,'Kardex','Kardex','Permiso'),(36,'Usuarios','Usuarios','Permiso'),(37,'Roles','Roles','Permiso'),(38,'Permisos','Permisos','Permiso'),(39,'Bitácora','Bitácora','Permiso'),(40,'Parámetros','Parámetros','Permiso'),(41,'Objetos','Objetos','Permiso'),(42,'Cargos','Cargos','Permiso'),(43,'Estado de venta','Estado de Venta','Permiso'),(44,'Tipo de Producto','Tipo de Producto','Permiso'),(45,'Talonario','Talonario','Permiso'),(46,'Contactos Proveedores','Contacto Proveedores','Permiso'),(47,'Contactos de Clientes','Contactos de Clientes','Permiso'),(48,'Tipo de Contacto','Tipo de Contacto','Permiso'),(49,'Tipo de Movimiento','Tipo de Movimiento','Permiso'),(50,'Estado del Proceso','Estado del Proceso','Permiso'),(51,'Backup','Backup','Permiso'),(69,'123','123','123');
/*!40000 ALTER TABLE `tbl_objetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permisos`
--

DROP TABLE IF EXISTS `tbl_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_permisos` (
  `Id_Permisos` int NOT NULL AUTO_INCREMENT,
  `Id_Rol` int NOT NULL,
  `Id_Objeto` int NOT NULL,
  `Permiso_insercion` varchar(1) DEFAULT NULL,
  `Permiso_eliminacion` varchar(1) DEFAULT NULL,
  `Permiso_actualizacion` varchar(1) DEFAULT NULL,
  `Permiso_consultar` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Id_Permisos`),
  KEY `FK_Id_Rol_TBL_PERMISOS_TBL_ROLES` (`Id_Rol`),
  KEY `FK_Id_Objeto_TBL_PERMISOS_TBL_OBJETOS` (`Id_Objeto`),
  CONSTRAINT `FK_Id_Objeto_TBL_PERMISOS_TBL_OBJETOS` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_objetos` (`Id_Objeto`),
  CONSTRAINT `FK_Id_Rol_TBL_PERMISOS_TBL_ROLES` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_roles` (`Id_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=1331 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permisos`
--

LOCK TABLES `tbl_permisos` WRITE;
/*!40000 ALTER TABLE `tbl_permisos` DISABLE KEYS */;
INSERT INTO `tbl_permisos` VALUES (3,3,9,'0','0','0','1'),(1107,101,24,'1','0','0','1'),(1108,101,25,'1','0','0','1'),(1109,101,26,'1','0','0','1'),(1110,101,27,'1','0','0','1'),(1111,101,28,'1','1','0','1'),(1112,101,29,'1','0','0','1'),(1113,101,30,'1','0','0','1'),(1114,101,31,'1','0','0','1'),(1115,101,32,'1','1','1','1'),(1116,101,33,'1','0','0','1'),(1117,101,34,'1','0','0','1'),(1118,101,35,'1','1','1','1'),(1119,101,36,'1','0','0','1'),(1120,101,37,'1','0','0','1'),(1121,101,38,'1','0','0','1'),(1122,101,39,'1','0','0','1'),(1123,101,40,'0','0','0','1'),(1124,101,41,'0','0','0','1'),(1125,101,42,'0','0','0','1'),(1126,101,43,'0','0','0','1'),(1127,101,44,'0','0','0','1'),(1128,101,45,'0','0','0','1'),(1129,101,46,'0','0','0','1'),(1130,101,47,'0','0','1','1'),(1131,101,48,'0','0','0','1'),(1132,101,49,'0','0','0','1'),(1133,101,50,'0','1','0','1'),(1134,101,51,'0','0','0','1'),(1163,102,24,'0','0','0','1'),(1164,102,25,'0','0','0','1'),(1165,102,26,'0','0','0','1'),(1166,102,27,'0','0','0','1'),(1167,102,28,'0','0','0','1'),(1168,102,29,'0','0','0','1'),(1169,102,30,'0','0','0','1'),(1170,102,31,'0','0','0','1'),(1171,102,32,'0','0','0','1'),(1172,102,33,'0','0','0','1'),(1173,102,34,'0','0','0','1'),(1174,102,35,'0','0','0','1'),(1175,102,36,'0','0','0','1'),(1176,102,37,'0','0','0','1'),(1177,102,38,'0','0','0','0'),(1178,102,39,'0','0','0','0'),(1179,102,40,'0','0','0','0'),(1180,102,41,'0','0','0','0'),(1181,102,42,'0','0','0','0'),(1182,102,43,'0','0','0','0'),(1183,102,44,'0','0','0','0'),(1184,102,45,'0','0','0','0'),(1185,102,46,'0','0','0','0'),(1186,102,47,'0','0','0','0'),(1187,102,48,'0','0','0','0'),(1188,102,49,'0','0','0','0'),(1189,102,50,'0','0','0','0'),(1190,102,51,'0','0','0','0'),(1191,74,24,'0','0','0','1'),(1192,74,25,'0','0','0','1'),(1193,74,26,'0','0','0','1'),(1194,74,27,'0','0','0','1'),(1195,74,28,'0','0','0','1'),(1196,74,29,'0','0','0','1'),(1197,74,30,'0','0','0','0'),(1198,74,31,'0','0','0','0'),(1199,74,32,'0','0','0','0'),(1200,74,33,'0','0','0','0'),(1201,74,34,'0','0','0','0'),(1202,74,35,'0','0','0','0'),(1203,74,36,'0','0','0','0'),(1204,74,37,'0','0','0','0'),(1205,74,38,'0','0','0','0'),(1206,74,39,'0','0','0','0'),(1207,74,40,'0','0','0','0'),(1208,74,41,'0','0','0','0'),(1209,74,42,'0','0','0','0'),(1210,74,43,'0','0','0','0'),(1211,74,44,'0','0','0','0'),(1212,74,45,'0','0','0','0'),(1213,74,46,'0','0','0','0'),(1214,74,47,'0','0','0','0'),(1215,74,48,'0','0','0','0'),(1216,74,49,'0','0','0','0'),(1217,74,50,'0','0','0','0'),(1218,74,51,'0','0','0','0'),(1219,2,24,'0','0','0','1'),(1220,2,25,'0','0','0','1'),(1221,2,26,'0','0','0','0'),(1222,2,27,'0','0','0','0'),(1223,2,28,'0','0','0','0'),(1224,2,29,'0','0','0','0'),(1225,2,30,'0','0','0','0'),(1226,2,31,'0','0','0','0'),(1227,2,32,'0','0','0','0'),(1228,2,33,'0','0','0','0'),(1229,2,34,'0','0','0','1'),(1230,2,35,'0','0','0','0'),(1231,2,36,'0','0','0','0'),(1232,2,37,'0','0','0','0'),(1233,2,38,'0','0','0','0'),(1234,2,39,'0','0','0','0'),(1235,2,40,'0','0','0','0'),(1236,2,41,'0','0','0','0'),(1237,2,42,'0','0','0','0'),(1238,2,43,'0','0','0','0'),(1239,2,44,'0','0','0','0'),(1240,2,45,'0','0','0','0'),(1241,2,46,'0','0','0','0'),(1242,2,47,'0','0','0','0'),(1243,2,48,'0','0','0','0'),(1244,2,49,'0','0','0','0'),(1245,2,50,'0','0','0','0'),(1246,2,51,'0','0','0','0'),(1303,1,24,'1','1','1','1'),(1304,1,25,'1','1','1','1'),(1305,1,26,'1','1','1','1'),(1306,1,27,'1','1','1','1'),(1307,1,28,'1','1','1','1'),(1308,1,29,'1','1','1','1'),(1309,1,30,'1','1','1','1'),(1310,1,31,'1','1','1','1'),(1311,1,32,'1','1','1','1'),(1312,1,33,'1','1','1','1'),(1313,1,34,'1','1','1','1'),(1314,1,35,'1','1','1','1'),(1315,1,36,'1','1','1','1'),(1316,1,37,'1','1','1','1'),(1317,1,38,'1','1','1','1'),(1318,1,39,'1','1','1','1'),(1319,1,40,'1','1','1','1'),(1320,1,41,'1','1','1','1'),(1321,1,42,'1','1','1','1'),(1322,1,43,'1','1','1','1'),(1323,1,44,'1','1','1','1'),(1324,1,45,'1','1','1','1'),(1325,1,46,'1','1','1','1'),(1326,1,47,'1','1','1','1'),(1327,1,48,'1','1','1','1'),(1328,1,49,'1','1','1','1'),(1329,1,50,'1','1','1','1'),(1330,1,51,'1','1','1','1');
/*!40000 ALTER TABLE `tbl_permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_proceso_produccion`
--

DROP TABLE IF EXISTS `tbl_proceso_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_proceso_produccion` (
  `Id_Proceso_Produccion` int NOT NULL AUTO_INCREMENT,
  `Id_Estado_Proceso` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  PRIMARY KEY (`Id_Proceso_Produccion`),
  KEY `fk_TBL_PROCESO_PRODUCCION_TBL_ESTADO_PROCESO1_idx` (`Id_Estado_Proceso`),
  CONSTRAINT `fk_TBL_PROCESO_PRODUCCION_TBL_ESTADO_PROCESO1` FOREIGN KEY (`Id_Estado_Proceso`) REFERENCES `tbl_estado_proceso` (`Id_Estado_Proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proceso_produccion`
--

LOCK TABLES `tbl_proceso_produccion` WRITE;
/*!40000 ALTER TABLE `tbl_proceso_produccion` DISABLE KEYS */;
INSERT INTO `tbl_proceso_produccion` VALUES (1,3,'2023-03-17'),(23,3,'2023-04-22'),(24,1,'2023-04-22'),(25,3,'2023-04-22'),(26,3,'2023-04-27'),(27,2,'2023-06-21');
/*!40000 ALTER TABLE `tbl_proceso_produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_producto_terminado_final`
--

DROP TABLE IF EXISTS `tbl_producto_terminado_final`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_producto_terminado_final` (
  `Id_Producto_Terminado_Final` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` int NOT NULL,
  `Id_Proceso_Produccion` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  PRIMARY KEY (`Id_Producto_Terminado_Final`),
  KEY `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  KEY `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PROCESO_PRODUCCION1_idx` (`Id_Proceso_Produccion`),
  CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PROCESO_PRODUCCION1` FOREIGN KEY (`Id_Proceso_Produccion`) REFERENCES `tbl_proceso_produccion` (`Id_Proceso_Produccion`),
  CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_producto_terminado_final`
--

LOCK TABLES `tbl_producto_terminado_final` WRITE;
/*!40000 ALTER TABLE `tbl_producto_terminado_final` DISABLE KEYS */;
INSERT INTO `tbl_producto_terminado_final` VALUES (25,1,27,10),(26,5,27,8),(27,2,27,15);
/*!40000 ALTER TABLE `tbl_producto_terminado_final` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_producto_terminado_mp`
--

DROP TABLE IF EXISTS `tbl_producto_terminado_mp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_producto_terminado_mp` (
  `Id_Producto_Terminado_Mp` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` int NOT NULL,
  `Id_Proceso_Produccion` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  PRIMARY KEY (`Id_Producto_Terminado_Mp`),
  KEY `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  KEY `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PROCESO_PRODUCCION1_idx` (`Id_Proceso_Produccion`),
  CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PROCESO_PRODUCCION1` FOREIGN KEY (`Id_Proceso_Produccion`) REFERENCES `tbl_proceso_produccion` (`Id_Proceso_Produccion`),
  CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_producto_terminado_mp`
--

LOCK TABLES `tbl_producto_terminado_mp` WRITE;
/*!40000 ALTER TABLE `tbl_producto_terminado_mp` DISABLE KEYS */;
INSERT INTO `tbl_producto_terminado_mp` VALUES (24,3,23,1),(25,3,25,1),(26,3,26,1),(27,3,27,2);
/*!40000 ALTER TABLE `tbl_producto_terminado_mp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_productos`
--

DROP TABLE IF EXISTS `tbl_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_productos` (
  `Id_Producto` int NOT NULL AUTO_INCREMENT,
  `Id_Tipo_Producto` int NOT NULL,
  `Nombre` varchar(60) DEFAULT NULL,
  `Unidad_medida` varchar(45) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Cantidad_maxima` int DEFAULT NULL,
  `Cantidad_minima` int DEFAULT NULL,
  PRIMARY KEY (`Id_Producto`),
  KEY `fk_TBL_PRODUCTOS_TBL_TIPO_PRODUCTO1_idx` (`Id_Tipo_Producto`),
  CONSTRAINT `fk_TBL_PRODUCTOS_TBL_TIPO_PRODUCTO1` FOREIGN KEY (`Id_Tipo_Producto`) REFERENCES `tbl_tipo_producto` (`Id_Tipo_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_productos`
--

LOCK TABLES `tbl_productos` WRITE;
/*!40000 ALTER TABLE `tbl_productos` DISABLE KEYS */;
INSERT INTO `tbl_productos` VALUES (1,1,'Chuleta','libra',50.00,15,2),(2,1,'Chorizo suelto','libra',125.00,10,2),(3,2,'Cerdito','Libra',10500.00,10,2),(4,2,'Vaca','Libra',80.00,10,2),(5,1,'Patas de cerdo','Libra',120.00,20,10),(7,1,'CHICHARRON','LIBRA',100.00,15,5),(8,1,'LOMO 1','LIBRA',70.00,10,2),(9,1,'PRUEBA 2','LIBRA',120.00,10,2),(10,1,'CAPACITACION1','LIBRA',150.00,10,2);
/*!40000 ALTER TABLE `tbl_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocion_producto`
--

DROP TABLE IF EXISTS `tbl_promocion_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_promocion_producto` (
  `Id_Promocion_Producto` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` int NOT NULL,
  `Id_Promocion` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  PRIMARY KEY (`Id_Promocion_Producto`),
  KEY `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PROMOCIONES1_idx` (`Id_Promocion`),
  KEY `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  CONSTRAINT `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  CONSTRAINT `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PROMOCIONES1` FOREIGN KEY (`Id_Promocion`) REFERENCES `tbl_promociones` (`Id_Promocion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocion_producto`
--

LOCK TABLES `tbl_promocion_producto` WRITE;
/*!40000 ALTER TABLE `tbl_promocion_producto` DISABLE KEYS */;
INSERT INTO `tbl_promocion_producto` VALUES (1,1,1,-2),(2,2,2,17),(4,5,2,12),(5,5,4,5),(6,5,5,5);
/*!40000 ALTER TABLE `tbl_promocion_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promociones`
--

DROP TABLE IF EXISTS `tbl_promociones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_promociones` (
  `Id_Promocion` int NOT NULL AUTO_INCREMENT,
  `Nombre_Promocion` varchar(100) DEFAULT NULL,
  `Precio_Venta` decimal(10,2) DEFAULT NULL,
  `Fecha_inicio` date DEFAULT NULL,
  `Fecha_final` date DEFAULT NULL,
  PRIMARY KEY (`Id_Promocion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promociones`
--

LOCK TABLES `tbl_promociones` WRITE;
/*!40000 ALTER TABLE `tbl_promociones` DISABLE KEYS */;
INSERT INTO `tbl_promociones` VALUES (1,'Verano',45.00,'2023-04-18','2023-04-30'),(2,'Invierno',100.00,'2023-04-20','2023-05-15'),(4,'INFORMATICA',100.00,'2023-04-21','2023-04-30'),(5,'PRUEBA',100.00,'2023-04-21','2023-04-30'),(6,'Combo 1',200.00,'2023-04-23','2023-04-24');
/*!40000 ALTER TABLE `tbl_promociones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_proveedores`
--

DROP TABLE IF EXISTS `tbl_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_proveedores` (
  `Id_Proveedor` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) DEFAULT NULL,
  `RTN` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id_Proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proveedores`
--

LOCK TABLES `tbl_proveedores` WRITE;
/*!40000 ALTER TABLE `tbl_proveedores` DISABLE KEYS */;
INSERT INTO `tbl_proveedores` VALUES (1,'Fanny','999'),(4,'INFORMATICA','11111111'),(5,'CAPACITACION','12345678'),(6,'ABI','1234556789');
/*!40000 ALTER TABLE `tbl_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_proveedores_contacto`
--

DROP TABLE IF EXISTS `tbl_proveedores_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_proveedores_contacto` (
  `Id_Proveedores_Contacto` int NOT NULL AUTO_INCREMENT,
  `Id_Tipo_Contacto` int NOT NULL,
  `Id_Proveedor` int NOT NULL,
  `Contacto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Proveedores_Contacto`),
  KEY `fk_PROVEEDORES_CONTACTO_TBL_TIPO_CONTACTO1_idx` (`Id_Tipo_Contacto`),
  KEY `fk_PROVEEDORES_CONTACTO_TBL_PROVEEDORES1_idx` (`Id_Proveedor`),
  CONSTRAINT `fk_PROVEEDORES_CONTACTO_TBL_PROVEEDORES1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `tbl_proveedores` (`Id_Proveedor`),
  CONSTRAINT `fk_PROVEEDORES_CONTACTO_TBL_TIPO_CONTACTO1` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proveedores_contacto`
--

LOCK TABLES `tbl_proveedores_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_proveedores_contacto` DISABLE KEYS */;
INSERT INTO `tbl_proveedores_contacto` VALUES (1,1,1,'99999999'),(3,2,1,'7777777777'),(4,1,1,'99889988'),(5,1,4,'99999999'),(6,1,4,'98765432'),(7,2,4,'prueba@gmail.com'),(8,1,5,'99999999'),(9,2,5,'prueba@gmail.com');
/*!40000 ALTER TABLE `tbl_proveedores_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_talonario`
--

DROP TABLE IF EXISTS `tbl_talonario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_talonario` (
  `Id_Talonario` int NOT NULL AUTO_INCREMENT,
  `Id_Usuario` int NOT NULL,
  `Numero_CAI` varchar(60) DEFAULT NULL,
  `Rango_Inicial` varchar(60) DEFAULT NULL,
  `Rango_final` varchar(60) DEFAULT NULL,
  `Rango_actual` varchar(60) DEFAULT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL,
  PRIMARY KEY (`Id_Talonario`),
  KEY `fk_TBL_TALONARIO_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  CONSTRAINT `fk_TBL_TALONARIO_TBL_MS_USUARIOS1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_talonario`
--

LOCK TABLES `tbl_talonario` WRITE;
/*!40000 ALTER TABLE `tbl_talonario` DISABLE KEYS */;
INSERT INTO `tbl_talonario` VALUES (1,21,'100-100-100-9','1','100','17','2023-05-06');
/*!40000 ALTER TABLE `tbl_talonario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_contacto`
--

DROP TABLE IF EXISTS `tbl_tipo_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_tipo_contacto` (
  `Id_Tipo_Contacto` int NOT NULL AUTO_INCREMENT,
  `Nombre_tipo_contacto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Tipo_Contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_contacto`
--

LOCK TABLES `tbl_tipo_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_contacto` DISABLE KEYS */;
INSERT INTO `tbl_tipo_contacto` VALUES (1,'Whatsapp'),(2,'Correo');
/*!40000 ALTER TABLE `tbl_tipo_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_movimiento`
--

DROP TABLE IF EXISTS `tbl_tipo_movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_tipo_movimiento` (
  `Id_Tipo_Movimiento` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Tipo_Movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_movimiento`
--

LOCK TABLES `tbl_tipo_movimiento` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_movimiento` DISABLE KEYS */;
INSERT INTO `tbl_tipo_movimiento` VALUES (1,'Entrada'),(2,'Salida');
/*!40000 ALTER TABLE `tbl_tipo_movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_producto`
--

DROP TABLE IF EXISTS `tbl_tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_tipo_producto` (
  `Id_Tipo_Producto` int NOT NULL AUTO_INCREMENT,
  `Nombre_tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Tipo_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_producto`
--

LOCK TABLES `tbl_tipo_producto` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_producto` DISABLE KEYS */;
INSERT INTO `tbl_tipo_producto` VALUES (1,'Producto terminado Final'),(2,'Producto terminado MP');
/*!40000 ALTER TABLE `tbl_tipo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ventas`
--

DROP TABLE IF EXISTS `tbl_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ventas` (
  `Id_Venta` int NOT NULL AUTO_INCREMENT,
  `Id_Cliente` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Id_Estado_Venta` int NOT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL,
  `Impuesto` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `RTN` varchar(45) DEFAULT NULL,
  `Numero_factura` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id_Venta`),
  KEY `fk_TBL_VENTAS_TBL_CLIENTES1_idx` (`Id_Cliente`),
  KEY `fk_TBL_VENTAS_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  KEY `fk_TBL_VENTAS_TBL_ESTADO_VENTA1_idx` (`Id_Estado_Venta`),
  CONSTRAINT `FK_Id_Cliente_TBL_VENTAS_TBL_CLIENTES` FOREIGN KEY (`Id_Cliente`) REFERENCES `tbl_clientes` (`Id_Cliente`),
  CONSTRAINT `fk_TBL_VENTAS_TBL_ESTADO_VENTA1` FOREIGN KEY (`Id_Estado_Venta`) REFERENCES `tbl_estado_venta` (`Id_Estado_Venta`),
  CONSTRAINT `fk_TBL_VENTAS_TBL_MS_USUARIOS1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ventas`
--

LOCK TABLES `tbl_ventas` WRITE;
/*!40000 ALTER TABLE `tbl_ventas` DISABLE KEYS */;
INSERT INTO `tbl_ventas` VALUES (1,1,21,1,81.00,8.10,89.10,'2023-04-18','12345','123456789-2'),(16,2,21,1,627.00,62.70,689.70,'2023-04-21','12345','100-100-100-9-12'),(17,4,21,1,918.00,91.80,1009.80,'2023-04-21','12345','100-100-100-9-13'),(18,1,21,1,100.00,10.00,110.00,'2023-04-24','','100-100-100-9-14'),(19,1,21,1,788.50,78.85,867.35,'2023-04-26','1234556789','100-100-100-9-15'),(20,1,21,1,245.00,24.50,269.50,'2023-04-26','',''),(21,1,21,1,250.00,25.00,275.00,'2023-04-27','',''),(22,1,21,1,535.00,53.50,588.50,'2023-05-12','','100-100-100-9-16'),(23,5,21,1,190.00,19.00,209.00,'2023-06-21','','100-100-100-9-17');
/*!40000 ALTER TABLE `tbl_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ventas_descuento`
--

DROP TABLE IF EXISTS `tbl_ventas_descuento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ventas_descuento` (
  `Id_Ventas_Descuento` int NOT NULL AUTO_INCREMENT,
  `Id_Venta` int NOT NULL,
  `Id_Descuento` int NOT NULL,
  `Porcentaje_descontado` varchar(11) DEFAULT NULL,
  `Total_descuento` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Ventas_Descuento`),
  KEY `fk_TBL_VENTAS_DESCUENTO_TBL_DESCUENTOS1_idx` (`Id_Descuento`),
  KEY `fk_TBL_VENTAS_DESCUENTO_TBL_VENTAS1_idx` (`Id_Venta`),
  CONSTRAINT `fk_TBL_VENTAS_DESCUENTO_TBL_DESCUENTOS1` FOREIGN KEY (`Id_Descuento`) REFERENCES `tbl_descuentos` (`Id_Descuento`),
  CONSTRAINT `fk_TBL_VENTAS_DESCUENTO_TBL_VENTAS1` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ventas_descuento`
--

LOCK TABLES `tbl_ventas_descuento` WRITE;
/*!40000 ALTER TABLE `tbl_ventas_descuento` DISABLE KEYS */;
INSERT INTO `tbl_ventas_descuento` VALUES (12,16,8,'5%',33.00),(13,17,9,'15%',162.00),(14,18,0,'0',0.00),(15,19,1,'10%',76.50),(16,20,0,'0',0.00),(17,21,0,'0',0.00),(18,22,9,'15%',15.00),(19,23,0,'0',0.00);
/*!40000 ALTER TABLE `tbl_ventas_descuento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ventas_promociones`
--

DROP TABLE IF EXISTS `tbl_ventas_promociones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ventas_promociones` (
  `Id_Venta_Promocion` int NOT NULL AUTO_INCREMENT,
  `Id_Promocion` int NOT NULL,
  `Id_Venta` int NOT NULL,
  `Precio_venta` decimal(10,2) DEFAULT NULL,
  `Cantidad` int DEFAULT NULL,
  PRIMARY KEY (`Id_Venta_Promocion`),
  KEY `fk_TBL_VENTAS_PROMOCIONES_TBL_PROMOCIONES1_idx` (`Id_Promocion`),
  KEY `fk_TBL_VENTAS_PROMOCIONES_TBL_VENTAS1_idx` (`Id_Venta`),
  CONSTRAINT `fk_TBL_VENTAS_PROMOCIONES_TBL_PROMOCIONES1` FOREIGN KEY (`Id_Promocion`) REFERENCES `tbl_promociones` (`Id_Promocion`),
  CONSTRAINT `fk_TBL_VENTAS_PROMOCIONES_TBL_VENTAS1` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ventas_promociones`
--

LOCK TABLES `tbl_ventas_promociones` WRITE;
/*!40000 ALTER TABLE `tbl_ventas_promociones` DISABLE KEYS */;
INSERT INTO `tbl_ventas_promociones` VALUES (1,2,18,100.00,2),(2,2,19,100.00,1),(3,1,22,45.00,10),(4,1,23,45.00,2);
/*!40000 ALTER TABLE `tbl_ventas_promociones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proyecto-siis'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-21 15:26:19
