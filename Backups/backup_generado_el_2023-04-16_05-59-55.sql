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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cargos`
--

LOCK TABLES `tbl_cargos` WRITE;
/*!40000 ALTER TABLE `tbl_cargos` DISABLE KEYS */;
INSERT INTO `tbl_cargos` VALUES (1,'Presidente'),(2,'Empleado'),(3,'Tesorero'),(4,'Prueba');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_clientes`
--

LOCK TABLES `tbl_clientes` WRITE;
/*!40000 ALTER TABLE `tbl_clientes` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_clientes_contacto`
--

LOCK TABLES `tbl_clientes_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_clientes_contacto` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compras`
--

LOCK TABLES `tbl_compras` WRITE;
/*!40000 ALTER TABLE `tbl_compras` DISABLE KEYS */;
INSERT INTO `tbl_compras` VALUES (37,1,'2023-04-11',10000.00,'contado','ADMINISTRADOR',NULL,NULL,NULL,0),(38,1,'2023-12-15',200.00,'contado','ADMINISTRADOR',NULL,NULL,NULL,0);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_descuentos`
--

LOCK TABLES `tbl_descuentos` WRITE;
/*!40000 ALTER TABLE `tbl_descuentos` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_compra`
--

LOCK TABLES `tbl_detalle_compra` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_compra` DISABLE KEYS */;
INSERT INTO `tbl_detalle_compra` VALUES (36,37,3,1,30.00),(37,37,4,1,67.00),(38,38,3,2,30.00);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_de_venta`
--

LOCK TABLES `tbl_detalle_de_venta` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_de_venta` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_producto_comprado`
--

LOCK TABLES `tbl_detalle_producto_comprado` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_producto_comprado` DISABLE KEYS */;
INSERT INTO `tbl_detalle_producto_comprado` VALUES (13,36,'cerdito',156,75.00,48.08),(14,37,'Vaca',122,87.00,71.31),(15,38,'cerdito',190,90.00,47.37);
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
-- Table structure for table `tbl_estado_proceso`
--

DROP TABLE IF EXISTS `tbl_estado_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_estado_proceso` (
  `Id_Estado_Proceso` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Estado_Proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado_proceso`
--

LOCK TABLES `tbl_estado_proceso` WRITE;
/*!40000 ALTER TABLE `tbl_estado_proceso` DISABLE KEYS */;
INSERT INTO `tbl_estado_proceso` VALUES (1,'En proceso'),(2,'Finalizado');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado_venta`
--

LOCK TABLES `tbl_estado_venta` WRITE;
/*!40000 ALTER TABLE `tbl_estado_venta` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inventario`
--

LOCK TABLES `tbl_inventario` WRITE;
/*!40000 ALTER TABLE `tbl_inventario` DISABLE KEYS */;
INSERT INTO `tbl_inventario` VALUES (1,3,3),(2,4,1);
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
  `Id_Tipo_Movimiento` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  `Fecha_hora` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Kardex`),
  KEY `fk_TBL_KARDEX_TBL_TIPO_MOVIMIENTO1_idx` (`Id_Tipo_Movimiento`),
  KEY `fk_TBL_KARDEX_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `fk_TBL_KARDEX_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  CONSTRAINT `fk_TBL_KARDEX_TBL_TIPO_MOVIMIENTO1` FOREIGN KEY (`Id_Tipo_Movimiento`) REFERENCES `tbl_tipo_movimiento` (`Id_Tipo_Movimiento`),
  CONSTRAINT `tbl_kardex_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kardex`
--

LOCK TABLES `tbl_kardex` WRITE;
/*!40000 ALTER TABLE `tbl_kardex` DISABLE KEYS */;
INSERT INTO `tbl_kardex` VALUES (26,21,3,1,1,'2023-04-11 22:58:24'),(27,21,4,1,1,'2023-04-11 22:58:24'),(28,21,3,1,2,'2023-04-12 15:21:57'),(29,21,3,2,1,'2023-04-12 15:28:40'),(30,21,1,1,5,'2023-04-12 15:29:39'),(31,21,2,1,10,'2023-04-12 15:29:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=650 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_bitacora`
--

LOCK TABLES `tbl_ms_bitacora` WRITE;
/*!40000 ALTER TABLE `tbl_ms_bitacora` DISABLE KEYS */;
INSERT INTO `tbl_ms_bitacora` VALUES (591,21,4,'2023-03-31','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(592,21,1,'2023-03-31','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(593,21,4,'2023-04-01','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(594,21,1,'2023-04-01','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(595,21,1,'2023-04-01','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(596,21,1,'2023-04-02','Inicio de Sesión fallido','El usuario ADMINISTRADOR ha intentado ingresar al sistema'),(597,21,1,'2023-04-02','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(598,21,1,'2023-04-02','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(599,21,4,'2023-04-02','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(600,21,1,'2023-04-02','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(601,21,4,'2023-04-02','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(602,21,1,'2023-04-02','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(603,21,4,'2023-04-03','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(604,21,1,'2023-04-03','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(605,21,1,'2023-04-03','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(606,21,1,'2023-04-03','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(607,21,4,'2023-04-03','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(608,63,6,'2023-04-03','Auto registro','Se ha auto registrado el Usuario ROOT'),(609,21,1,'2023-04-03','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(610,21,4,'2023-04-03','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(611,63,1,'2023-04-03','Inicio de Sesión','El usuario ROOT ha ingresado al sistema'),(612,63,4,'2023-04-03','Cierre de Sesión','El usuario ROOT ha cerrado sesión'),(613,21,1,'2023-04-03','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(614,21,1,'2023-04-03','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(615,21,1,'2023-04-04','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(616,21,4,'2023-04-04','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(617,21,1,'2023-04-04','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(618,21,1,'2023-04-04','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(619,21,1,'2023-04-05','Inicio de Sesión fallido','El usuario ADMINISTRADOR ha intentado ingresar al sistema'),(620,21,1,'2023-04-05','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(621,21,4,'2023-04-05','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(622,21,1,'2023-04-06','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(623,21,4,'2023-04-06','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(624,21,1,'2023-04-06','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(625,21,4,'2023-04-06','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(626,21,1,'2023-04-06','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(627,21,1,'2023-04-07','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(628,21,4,'2023-04-07','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(629,21,1,'2023-04-07','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(630,21,1,'2023-04-09','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(631,21,1,'2023-04-10','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(632,21,4,'2023-04-10','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(633,51,1,'2023-04-10','Inicio de Sesión','El usuario CORREGIDO ha ingresado al sistema'),(634,51,4,'2023-04-10','Cierre de Sesión','El usuario CORREGIDO ha cerrado sesión'),(635,21,1,'2023-04-10','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(636,21,4,'2023-04-10','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(637,21,1,'2023-04-10','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(638,21,1,'2023-04-10','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(639,21,1,'2023-04-10','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(640,21,1,'2023-04-11','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(641,21,1,'2023-04-12','Inicio de Sesión fallido','El usuario ADMINISTRADOR ha intentado ingresar al sistema'),(642,21,1,'2023-04-12','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(643,21,4,'2023-04-12','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(644,21,1,'2023-04-14','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(645,21,1,'2023-04-14','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(646,21,1,'2023-04-15','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(647,21,4,'2023-04-15','Cierre de Sesión','El usuario ADMINISTRADOR ha cerrado sesión'),(648,21,1,'2023-04-15','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema'),(649,21,1,'2023-04-15','Inicio de Sesión','El usuario ADMINISTRADOR ha ingresado al sistema');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_parametros`
--

LOCK TABLES `tbl_ms_parametros` WRITE;
/*!40000 ALTER TABLE `tbl_ms_parametros` DISABLE KEYS */;
INSERT INTO `tbl_ms_parametros` VALUES (1,'CORREO_EXP','720',NULL,NULL,NULL,NULL),(2,'ADMIN_VIGENCIA','30',NULL,NULL,NULL,NULL),(3,'ADMIN_INTENTOS','2',NULL,NULL,NULL,NULL),(4,'ADMIN_PREGUNTAS','3',NULL,NULL,NULL,NULL),(5,'MAX_CONTRASENIA','15',NULL,NULL,NULL,NULL),(6,'MIN_CONTRASENIA','8',NULL,NULL,NULL,NULL),(7,'FEC_VENCIMIENTO','30',NULL,NULL,NULL,NULL),(8,'NOMBRE_EMPRESA','Empresa de servicios múltiples jóvenes profesionales de La Sierra de la Paz',NULL,NULL,NULL,NULL),(9,'LOGO','C:\\xampp\\htdocs\\SIIS-Proyecto\\img\\logo.png',NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_preguntas`
--

LOCK TABLES `tbl_ms_preguntas` WRITE;
/*!40000 ALTER TABLE `tbl_ms_preguntas` DISABLE KEYS */;
INSERT INTO `tbl_ms_preguntas` VALUES (1,'¿Nombre de tu primera mascota?'),(2,'¿Ciudad de  Nacimiento?'),(3,'¿En que escuela estudiaste?'),(4,'¿Que carrera estudiaste?'),(5,'¿Cuál es tu color favorito?'),(6,'¿Cuál es tu clase Favorita?'),(7,'¿Cuál es tu lenguaje de programación favorito?'),(8,'¿Cuál es la fecha del cumpleaños de tu papá?'),(9,'¿Que país te gustaría visitar?'),(10,'Cuál es tu tipo de sangre?'),(11,'¿Cuál es tu comida favorita?');
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_preguntas_usuarios`
--

LOCK TABLES `tbl_ms_preguntas_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_ms_preguntas_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_ms_preguntas_usuarios` VALUES (1,21,1,'Chuchi'),(2,21,2,'Tegucigalpa'),(3,21,3,'Desarrollo Juvenil'),(73,51,1,'Chuchi'),(74,51,2,'Tegucigalpa'),(75,51,3,'Desarrollo Juvenil');
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_roles`
--

LOCK TABLES `tbl_ms_roles` WRITE;
/*!40000 ALTER TABLE `tbl_ms_roles` DISABLE KEYS */;
INSERT INTO `tbl_ms_roles` VALUES (1,'Administrador','Todos los permisos'),(2,'Usuario','Rol por defecto'),(3,'Default','Ningún permiso'),(69,'AAAAÁ','Algunos permisos');
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ms_usuarios`
--

LOCK TABLES `tbl_ms_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_ms_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_ms_usuarios` VALUES (21,1,1,'ADMINISTRADOR','ADMINISTRADOR','Activo','Prueba.11','2023-04-16',NULL,171,NULL,NULL,'kateandara@gmail.com',NULL,'2023-02-25',NULL,NULL),(51,1,1,'CORREGIDO','KATERINE','Activo','Prueba.2','2023-04-11',3,3,'2023-04-19','0801-2000-11179','kateandara@gmail.com','ADMINISTRADOR','2023-03-19','ADMINISTRADOR','2023-03-25'),(58,2,1,'KATE','KATE','Activo','Prueba.1','2023-03-30',NULL,2,'2023-04-19','0801-2000-11179','kateandara@gmail.com','ADMINISTRADOR','2023-03-19',NULL,NULL),(59,2,1,'AAA','AAA','Nuevo','Four.150',NULL,NULL,NULL,'2023-04-19','0000000000000000','fabriciosuazo.thfb@gmail.com','ADMINISTRADOR','2023-03-20',NULL,NULL),(62,2,1,'INFORMATICA','INFORMATICA','Nuevo','Four.150',NULL,NULL,NULL,'2023-04-19','0000000000000000','fabriciosuazo.thfb@gmail.com','ADMINISTRADOR','2023-03-20',NULL,NULL),(63,3,2,'ROOT','KATE','Activo','Prueba.1','2023-04-04',NULL,1,'2023-05-04','0801-2000-11179','kateandara@gmail.com',NULL,'2023-04-04','ADMINISTRADOR','2023-04-04');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_objetos`
--

LOCK TABLES `tbl_objetos` WRITE;
/*!40000 ALTER TABLE `tbl_objetos` DISABLE KEYS */;
INSERT INTO `tbl_objetos` VALUES (1,'login','pantalla de inicio de sesión','pantalla'),(2,'recuperacion_Correo','pantalla de recuperación','pantalla'),(3,'registro','pantalla de autoregistro','pantalla'),(4,'log_out','Cerrar sesión','pantalla'),(5,'cambio_contra','Cambiar  contraseña si es nuevo','Pantalla'),(6,'autoregistro','Autoregistrarse','pantalla'),(7,'inactivo','Usuario inactivo o bloqueado','pantalla'),(8,'cambio_contraC','Actualización de contraseña por correo','pantalla'),(9,'editarusuario','Editar usuarios','pantalla'),(10,'cambio_contraPS','Cambio de contra por medio de preguntas secretas ','pantalla'),(11,'bloqueo','Usuario bloqueadao','pantalla'),(12,'recuperacion_Preguntas','pantalla de recuperación','pantalla'),(13,'PreguntasSecretas','Configuras Preguntas Secretas','pantalla'),(14,'eliminarusuario','Eliminar usuarios','pantalla'),(19,'Insertar_Permiso','Insertar Objetos','Pantalla'),(20,'Prueba','Sesión','Pantalla'),(21,'Insertar','Insertar datos','Pantalla');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permisos`
--

LOCK TABLES `tbl_permisos` WRITE;
/*!40000 ALTER TABLE `tbl_permisos` DISABLE KEYS */;
INSERT INTO `tbl_permisos` VALUES (1,1,9,'1','1','1','1'),(2,1,1,'1','1','1','1'),(3,3,9,'0','0','0','1'),(5,2,19,'0','0','0','1'),(6,2,1,'1','0','1','0'),(7,1,19,'1','1','1','1'),(8,1,5,'1','1','1','1'),(9,2,19,'0','0','0','1'),(10,2,6,'0','0','0','1'),(11,1,20,'1','1','1','0'),(13,1,10,'1','0','0','0');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proceso_produccion`
--

LOCK TABLES `tbl_proceso_produccion` WRITE;
/*!40000 ALTER TABLE `tbl_proceso_produccion` DISABLE KEYS */;
INSERT INTO `tbl_proceso_produccion` VALUES (1,1,'2023-03-17'),(10,2,'2023-04-12');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_producto_terminado_final`
--

LOCK TABLES `tbl_producto_terminado_final` WRITE;
/*!40000 ALTER TABLE `tbl_producto_terminado_final` DISABLE KEYS */;
INSERT INTO `tbl_producto_terminado_final` VALUES (5,1,10,5),(6,2,10,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_producto_terminado_mp`
--

LOCK TABLES `tbl_producto_terminado_mp` WRITE;
/*!40000 ALTER TABLE `tbl_producto_terminado_mp` DISABLE KEYS */;
INSERT INTO `tbl_producto_terminado_mp` VALUES (12,3,10,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_productos`
--

LOCK TABLES `tbl_productos` WRITE;
/*!40000 ALTER TABLE `tbl_productos` DISABLE KEYS */;
INSERT INTO `tbl_productos` VALUES (1,1,'Chuleta','libra',50.00,15,2),(2,1,'Chorizo suelto','libra',125.00,10,2),(3,2,'Cerdito','Libra',10500.00,10,2),(4,2,'Vaca','Libra',80.00,10,2);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocion_producto`
--

LOCK TABLES `tbl_promocion_producto` WRITE;
/*!40000 ALTER TABLE `tbl_promocion_producto` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promociones`
--

LOCK TABLES `tbl_promociones` WRITE;
/*!40000 ALTER TABLE `tbl_promociones` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proveedores`
--

LOCK TABLES `tbl_proveedores` WRITE;
/*!40000 ALTER TABLE `tbl_proveedores` DISABLE KEYS */;
INSERT INTO `tbl_proveedores` VALUES (1,'Fanny','999');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proveedores_contacto`
--

LOCK TABLES `tbl_proveedores_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_proveedores_contacto` DISABLE KEYS */;
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
  PRIMARY KEY (`Id_Talonario`),
  KEY `fk_TBL_TALONARIO_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  CONSTRAINT `fk_TBL_TALONARIO_TBL_MS_USUARIOS1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_talonario`
--

LOCK TABLES `tbl_talonario` WRITE;
/*!40000 ALTER TABLE `tbl_talonario` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_contacto`
--

LOCK TABLES `tbl_tipo_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_contacto` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
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
  `Numero_factura` int DEFAULT NULL,
  PRIMARY KEY (`Id_Venta`),
  KEY `fk_TBL_VENTAS_TBL_CLIENTES1_idx` (`Id_Cliente`),
  KEY `fk_TBL_VENTAS_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  KEY `fk_TBL_VENTAS_TBL_ESTADO_VENTA1_idx` (`Id_Estado_Venta`),
  CONSTRAINT `FK_Id_Cliente_TBL_VENTAS_TBL_CLIENTES` FOREIGN KEY (`Id_Cliente`) REFERENCES `tbl_clientes` (`Id_Cliente`),
  CONSTRAINT `fk_TBL_VENTAS_TBL_ESTADO_VENTA1` FOREIGN KEY (`Id_Estado_Venta`) REFERENCES `tbl_estado_venta` (`Id_Estado_Venta`),
  CONSTRAINT `fk_TBL_VENTAS_TBL_MS_USUARIOS1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ventas`
--

LOCK TABLES `tbl_ventas` WRITE;
/*!40000 ALTER TABLE `tbl_ventas` DISABLE KEYS */;
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
  `Porcentaje_descontado` int DEFAULT NULL,
  `Total_descuento` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Ventas_Descuento`),
  KEY `fk_TBL_VENTAS_DESCUENTO_TBL_DESCUENTOS1_idx` (`Id_Descuento`),
  KEY `fk_TBL_VENTAS_DESCUENTO_TBL_VENTAS1_idx` (`Id_Venta`),
  CONSTRAINT `fk_TBL_VENTAS_DESCUENTO_TBL_DESCUENTOS1` FOREIGN KEY (`Id_Descuento`) REFERENCES `tbl_descuentos` (`Id_Descuento`),
  CONSTRAINT `fk_TBL_VENTAS_DESCUENTO_TBL_VENTAS1` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ventas_descuento`
--

LOCK TABLES `tbl_ventas_descuento` WRITE;
/*!40000 ALTER TABLE `tbl_ventas_descuento` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ventas_promociones`
--

LOCK TABLES `tbl_ventas_promociones` WRITE;
/*!40000 ALTER TABLE `tbl_ventas_promociones` DISABLE KEYS */;
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

-- Dump completed on 2023-04-15 21:59:56
