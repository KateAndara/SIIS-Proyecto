-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2023 a las 03:24:57
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto-siis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cargos`
--

CREATE TABLE `tbl_cargos` (
  `Id_Cargo` int NOT NULL,
  `Nombre_cargo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_cargos`
--

INSERT INTO `tbl_cargos` (`Id_Cargo`, `Nombre_cargo`) VALUES
(1, 'Presidente'),
(2, 'Empleado'),
(6, 'INFORMATICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `Id_Cliente` int NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `DNI` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`Id_Cliente`, `Nombre`, `Fecha_nacimiento`, `DNI`) VALUES
(1, 'Consumidor Final', '1111-11-11', '0001'),
(2, 'INFORMATICA', '2023-04-02', '000000000000'),
(3, 'KATE ANDARA', '2000-02-22', '0801200011179'),
(4, 'PRUEBA', '2023-04-05', '000000000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes_contacto`
--

CREATE TABLE `tbl_clientes_contacto` (
  `Id_Cliente_Contacto` int NOT NULL,
  `Id_Tipo_Contacto` int NOT NULL,
  `Id_Cliente` int NOT NULL,
  `Contacto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_clientes_contacto`
--

INSERT INTO `tbl_clientes_contacto` (`Id_Cliente_Contacto`, `Id_Tipo_Contacto`, `Id_Cliente`, `Contacto`) VALUES
(1, 1, 3, '96543461'),
(2, 2, 3, 'kateandara@gmail.com'),
(3, 1, 2, '88888889'),
(4, 1, 4, '98765431'),
(5, 2, 4, 'prueba@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

CREATE TABLE `tbl_compras` (
  `Id_Compra` int NOT NULL,
  `Id_Proveedor` int NOT NULL,
  `Fecha_compra` date DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Observacion` varchar(45) DEFAULT NULL,
  `Creado_por` varchar(45) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Modificado_por` varchar(45) DEFAULT NULL,
  `Fecha_modificacion` date DEFAULT NULL,
  `Cancelada` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_compras`
--

INSERT INTO `tbl_compras` (`Id_Compra`, `Id_Proveedor`, `Fecha_compra`, `Total`, `Observacion`, `Creado_por`, `Fecha_creacion`, `Modificado_por`, `Fecha_modificacion`, `Cancelada`) VALUES
(37, 1, '2023-04-11', '10000.00', 'contado', 'ADMINISTRADOR', NULL, NULL, NULL, 0),
(38, 1, '2023-12-15', '200.00', 'contado', 'ADMINISTRADOR', NULL, NULL, NULL, 0),
(48, 1, '2023-04-21', '12000.00', 'contado', '', NULL, NULL, NULL, 0),
(49, 1, '2023-04-21', '10000.00', 'contado', '', NULL, NULL, NULL, 0),
(50, 1, '2023-04-21', '1200.00', 'contado', '', NULL, NULL, NULL, 0),
(51, 5, '2023-04-27', '1200.00', 'contado', '', NULL, NULL, NULL, 0),
(52, 5, '2023-04-27', '1200.00', 'contado', '', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_descuentos`
--

CREATE TABLE `tbl_descuentos` (
  `Id_Descuento` int NOT NULL,
  `Nombre_descuento` varchar(100) DEFAULT NULL,
  `Porcentaje_a_descontar` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_descuentos`
--

INSERT INTO `tbl_descuentos` (`Id_Descuento`, `Nombre_descuento`, `Porcentaje_a_descontar`) VALUES
(0, 'Sin descuento', 0),
(1, 'promocion', 10),
(2, '2x1', 50),
(8, 'INFORMATICA', 5),
(9, 'PRUEBA', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_compra`
--

CREATE TABLE `tbl_detalle_compra` (
  `Id_Detalle_Compra` int NOT NULL,
  `Id_Compra` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  `Precio_libra` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_detalle_compra`
--

INSERT INTO `tbl_detalle_compra` (`Id_Detalle_Compra`, `Id_Compra`, `Id_Producto`, `Cantidad`, `Precio_libra`) VALUES
(49, 48, 3, 1, '35.00'),
(50, 49, 3, 1, '35.00'),
(51, 50, 3, 1, '35.00'),
(52, 51, 3, 1, '35.00'),
(53, 52, 3, 1, '35.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_de_venta`
--

CREATE TABLE `tbl_detalle_de_venta` (
  `Id_Detalle_Venta` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Id_Venta` int NOT NULL,
  `Cantidad` int DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_detalle_de_venta`
--

INSERT INTO `tbl_detalle_de_venta` (`Id_Detalle_Venta`, `Id_Producto`, `Id_Venta`, `Cantidad`, `Precio`) VALUES
(1, 1, 1, 2, '45.00'),
(24, 1, 16, 4, '45.00'),
(25, 5, 16, 4, '120.00'),
(26, 1, 17, 5, '45.00'),
(27, 2, 17, 3, '125.00'),
(28, 5, 17, 4, '120.00'),
(29, 1, 18, 2, '50.00'),
(30, 1, 19, 3, '50.00'),
(31, 5, 19, 2, '120.00'),
(32, 2, 19, 3, '125.00'),
(33, 2, 20, 1, '125.00'),
(34, 5, 20, 1, '120.00'),
(35, 1, 21, 5, '50.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_producto_comprado`
--

CREATE TABLE `tbl_detalle_producto_comprado` (
  `Id_Detalle_Producto_Comprado` int NOT NULL,
  `Id_Detalle_Compra` int NOT NULL,
  `Especie` varchar(45) DEFAULT NULL,
  `Peso_vivo` int DEFAULT NULL,
  `Canal` decimal(10,2) DEFAULT NULL,
  `Rendimiento` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_detalle_producto_comprado`
--

INSERT INTO `tbl_detalle_producto_comprado` (`Id_Detalle_Producto_Comprado`, `Id_Detalle_Compra`, `Especie`, `Peso_vivo`, `Canal`, `Rendimiento`) VALUES
(26, 49, 'cerdito', 1234, '123.00', '9.97'),
(27, 50, 'cerdito', 1234, '123.00', '9.97'),
(28, 51, 'cerdito', 1234, '123.00', '9.97'),
(29, 52, '1', 1234, '100.00', '8.10'),
(30, 53, '1', 1234, '123.00', '9.97');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_errores`
--

CREATE TABLE `tbl_errores` (
  `Id_error` int NOT NULL,
  `Error` varchar(100) DEFAULT NULL,
  `Codigo` varchar(45) DEFAULT NULL,
  `Mensaje` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especies`
--

CREATE TABLE `tbl_especies` (
  `Id_Especie` int NOT NULL,
  `Nombre_Especie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_especies`
--

INSERT INTO `tbl_especies` (`Id_Especie`, `Nombre_Especie`) VALUES
(1, 'LECHON ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_proceso`
--

CREATE TABLE `tbl_estado_proceso` (
  `Id_Estado_Proceso` int NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_estado_proceso`
--

INSERT INTO `tbl_estado_proceso` (`Id_Estado_Proceso`, `Descripcion`) VALUES
(1, 'En proceso'),
(2, 'Finalizado'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_venta`
--

CREATE TABLE `tbl_estado_venta` (
  `Id_Estado_Venta` int NOT NULL,
  `Nombre_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_estado_venta`
--

INSERT INTO `tbl_estado_venta` (`Id_Estado_Venta`, `Nombre_estado`) VALUES
(1, 'Activo'),
(2, 'En Proceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `Id_Inventario` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Existencia` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`Id_Inventario`, `Id_Producto`, `Existencia`) VALUES
(1, 3, 4),
(2, 4, 2),
(3, 1, 5),
(4, 2, 0),
(5, 5, 0),
(6, 7, 0),
(7, 8, 0),
(8, 9, 0),
(9, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_kardex`
--

CREATE TABLE `tbl_kardex` (
  `Id_Kardex` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Id_Tipo_Movimiento` int DEFAULT NULL,
  `Cantidad` int DEFAULT NULL,
  `Fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_kardex`
--

INSERT INTO `tbl_kardex` (`Id_Kardex`, `Id_Usuario`, `Id_Producto`, `Id_Tipo_Movimiento`, `Cantidad`, `Fecha_hora`) VALUES
(97, 21, 3, 1, 1, '2023-04-21 20:55:00'),
(98, 21, 3, 1, 1, '2023-04-21 21:01:24'),
(99, 21, 3, 2, 1, '2023-04-21 21:03:00'),
(100, 21, 1, 1, 5, '2023-04-21 21:03:14'),
(101, 21, 2, 1, 5, '2023-04-21 21:03:45'),
(102, 21, 1, 2, 5, '2023-04-21 21:04:19'),
(103, 21, 2, 2, 5, '2023-04-21 21:04:19'),
(104, 21, 1, 2, 4, '2023-04-21 21:08:34'),
(105, 21, 5, 2, 4, '2023-04-21 21:08:34'),
(106, 21, 3, 1, 1, '2023-04-21 21:37:52'),
(107, 21, 3, 2, 1, '2023-04-21 21:39:12'),
(108, 21, 1, 1, 5, '2023-04-21 21:39:54'),
(109, 21, 1, 2, 5, '2023-04-21 21:40:39'),
(110, 21, 1, 2, 5, '2023-04-21 21:44:50'),
(111, 21, 2, 2, 3, '2023-04-21 21:44:50'),
(112, 21, 5, 2, 4, '2023-04-21 21:44:50'),
(113, 21, 1, 2, 2, '2023-04-24 15:03:14'),
(114, 21, 2, 2, 2, '2023-04-24 15:03:14'),
(115, 21, 5, 2, 2, '2023-04-24 15:03:14'),
(116, 21, 3, 1, 1, '2023-04-26 21:34:19'),
(117, 21, 3, 1, 1, '2023-04-26 21:35:04'),
(118, 21, 3, 2, 1, '2023-04-26 21:39:31'),
(119, 21, 1, 1, 5, '2023-04-26 21:40:24'),
(120, 21, 5, 1, 4, '2023-04-26 21:40:38'),
(121, 21, 1, 2, 5, '2023-04-26 21:41:38'),
(122, 21, 5, 2, 4, '2023-04-26 21:41:38'),
(123, 21, 1, 2, 3, '2023-04-26 21:47:03'),
(124, 21, 5, 2, 2, '2023-04-26 21:47:03'),
(125, 21, 2, 2, 3, '2023-04-26 21:47:03'),
(126, 21, 2, 2, 1, '2023-04-26 21:47:03'),
(127, 21, 5, 2, 1, '2023-04-26 21:47:03'),
(128, 21, 2, 2, 1, '2023-04-26 21:49:46'),
(129, 21, 5, 2, 1, '2023-04-26 21:49:46'),
(130, 21, 1, 2, 5, '2023-04-27 15:13:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_bitacora`
--

CREATE TABLE `tbl_ms_bitacora` (
  `Id_bitacora` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Id_Objeto` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Accion` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ms_bitacora`
--

INSERT INTO `tbl_ms_bitacora` (`Id_bitacora`, `Id_Usuario`, `Id_Objeto`, `Fecha`, `Accion`, `Descripcion`) VALUES
(1415, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1416, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1417, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1418, 21, 4, '2023-04-19', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1419, 21, 1, '2023-04-19', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1420, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1421, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1422, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1423, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1424, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1425, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1426, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1427, 21, 37, '2023-04-20', 'Actualizar', 'Se actualizó un rol'),
(1428, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1429, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1430, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1431, 21, 37, '2023-04-20', 'Actualizar', 'Se actualizó un rol'),
(1432, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1433, 21, 24, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1434, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1435, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1436, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1437, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1438, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1439, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1440, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1441, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1442, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1443, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1444, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1445, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1446, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1447, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1448, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1449, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1450, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1451, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1452, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1453, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1454, 21, 40, '2023-04-20', 'Actualizar', 'Se actualizó un parámetro'),
(1455, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1456, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1457, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1458, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1459, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1460, 21, 40, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1461, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1462, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1463, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1464, 21, 29, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1465, 21, 29, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1466, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1467, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1468, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1469, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1470, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1471, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1472, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1473, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1474, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1475, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1476, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1477, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1478, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1479, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1480, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1481, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1482, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1483, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1484, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1485, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1486, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1487, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1488, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1489, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1490, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1491, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1492, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1493, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1494, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1495, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1496, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1497, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1498, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1499, 21, 33, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1500, 21, 1, '2023-04-20', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1501, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1502, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1503, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1504, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1505, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1506, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1507, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1508, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1509, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1510, 21, 42, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(1511, 21, 42, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(1512, 21, 31, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1513, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1514, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1515, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1516, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1517, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1518, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1519, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1520, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1521, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1522, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1523, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1524, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1525, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1526, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1527, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1528, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1529, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1530, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1531, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1532, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1533, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1534, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1535, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1536, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1537, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1538, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1539, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1540, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1541, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1542, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1543, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1544, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1545, 21, 37, '2023-04-20', 'Insertar', 'Se insertó un  rol'),
(1546, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1547, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1548, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1549, 21, 37, '2023-04-20', 'Eliminar', 'Se eliminó un  rol'),
(1550, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1551, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1552, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1553, 21, 36, '2023-04-20', 'Actualizar', 'Se actualizó un usuario'),
(1554, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1555, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1556, 21, 37, '2023-04-20', 'Actualizar', 'Se actualizó un rol'),
(1557, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1558, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1559, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1560, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1561, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1562, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1563, 21, 36, '2023-04-20', 'Insertar', 'Se insertó un usuario'),
(1564, 21, 36, '2023-04-20', 'Insertar', 'Se insertó un usuario'),
(1565, 21, 36, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1566, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1567, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1568, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1569, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1570, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1571, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1572, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1573, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1574, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1575, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1576, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1577, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1578, 21, 37, '2023-04-20', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1579, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1580, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1581, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1582, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1583, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1584, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1585, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1586, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1587, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1588, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1589, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1590, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1591, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1592, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1593, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1594, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1595, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1596, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1597, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1598, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1599, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1600, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1601, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1602, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1603, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1604, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1605, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1606, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1607, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1608, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1609, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1610, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1611, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1612, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1613, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1614, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1615, 21, 37, '2023-04-21', 'Actualizar', 'Se actualizó un rol'),
(1616, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1617, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1618, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1619, 21, 31, '2023-04-21', 'Actualizar', 'Se actualizó una pregunta'),
(1620, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1621, 21, 41, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(1622, 21, 41, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(1623, 21, 41, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(1624, 21, 41, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(1625, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1626, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1627, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1628, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1629, 21, 4, '2023-04-20', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1630, 21, 1, '2023-04-20', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1631, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1632, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1633, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1634, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1635, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1636, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1637, 21, 47, '2023-04-21', 'Insertar', 'Se insertó un nuevo de contacto de un Cliente'),
(1638, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1639, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1640, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1641, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1642, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1643, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1644, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1645, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1646, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1647, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1648, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1649, 21, 47, '2023-04-21', 'Insertar', 'Se insertó un nuevo de contacto de un Cliente'),
(1650, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1651, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1652, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1653, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1654, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1655, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1656, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1657, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1658, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1659, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1660, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1661, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1662, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1663, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1664, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1665, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1666, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1667, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1668, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1669, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1670, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1671, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1672, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1673, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1674, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1675, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1676, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1677, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1678, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1679, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1680, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1681, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1682, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1683, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1684, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1685, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1686, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1687, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1688, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1689, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1690, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1691, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1692, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1693, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1694, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1695, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1696, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1697, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1698, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1699, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1700, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1701, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1702, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1703, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1704, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1705, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1706, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1707, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1708, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1709, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1710, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1711, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1712, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1713, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1714, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1715, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1716, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1717, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1718, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1719, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1720, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1721, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1722, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1723, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1724, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1725, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1726, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1727, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1728, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1729, 21, 29, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1730, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1731, 21, 30, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(1732, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1733, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1734, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1735, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1736, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1737, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1738, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1739, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1740, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1741, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1742, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1743, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1744, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1745, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1746, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1747, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1748, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1749, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1750, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1751, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1752, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1753, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1754, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1755, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1756, 21, 33, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1757, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1758, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1759, 21, 47, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1760, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1761, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1762, 21, 24, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1763, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1764, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1765, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1766, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1767, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1768, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1769, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1770, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1771, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1772, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1773, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1774, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1775, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1776, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1777, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1778, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1779, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1780, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1781, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1782, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1783, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1784, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1785, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1786, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1787, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1788, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1789, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1790, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1791, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1792, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1793, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1794, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1795, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1796, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1797, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1798, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1799, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1800, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1801, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1802, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1803, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1804, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1805, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1806, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1807, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1808, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1809, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1810, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1811, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1812, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1813, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1814, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1815, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1816, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1817, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1818, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1819, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1820, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1821, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1822, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1823, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1824, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1825, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1826, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1827, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1828, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1829, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1830, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1831, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1832, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1833, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1834, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1835, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1836, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1837, 21, 37, '2023-04-21', 'Eliminar', 'Se eliminó un  rol'),
(1838, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1839, 21, 37, '2023-04-21', 'Insertar', 'Se insertó un  rol'),
(1840, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1841, 21, 37, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1842, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1843, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1844, 21, 31, '2023-04-21', 'Eliminar', 'Se eliminó una pregunta'),
(1845, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1846, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1847, 21, 31, '2023-04-21', 'Actualizar', 'Se actualizó una pregunta'),
(1848, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1849, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1850, 21, 31, '2023-04-21', 'Actualizar', 'Se actualizó una pregunta'),
(1851, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1852, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1853, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1854, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1855, 21, 36, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1856, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1857, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1858, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1859, 21, 31, '2023-04-21', 'Actualizar', 'Se actualizó una pregunta'),
(1860, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1861, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1862, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1863, 21, 40, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(1864, 21, 41, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(1865, 21, 41, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(1866, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1867, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1868, 21, 31, '2023-04-21', 'Insertar', 'Se insertó una pregunta'),
(1869, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1870, 21, 31, '2023-04-21', 'Eliminar', 'Se eliminó una pregunta'),
(1871, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1872, 21, 31, '2023-04-21', 'Insertar', 'Se insertó una pregunta'),
(1873, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1874, 21, 31, '2023-04-21', 'Eliminar', 'Se eliminó una pregunta'),
(1875, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1876, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1877, 21, 31, '2023-04-21', 'Insertar', 'Se insertó una pregunta'),
(1878, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1879, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1880, 21, 31, '2023-04-21', 'Insertar', 'Se insertó una pregunta'),
(1881, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1882, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1883, 21, 31, '2023-04-21', 'Eliminar', 'Se eliminó una pregunta'),
(1884, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1885, 21, 31, '2023-04-21', 'Insertar', 'Se insertó una pregunta'),
(1886, 21, 31, '2023-04-21', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1887, 21, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1888, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1889, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1890, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1891, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1892, 51, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario CORREGIDO ha ingresado al sistema'),
(1893, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1894, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(1895, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1896, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1897, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1898, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1899, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1900, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(1901, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1902, 51, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1903, 51, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1904, 51, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario CORREGIDO ha cerrado sesión'),
(1905, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1906, 21, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1907, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1908, 21, 37, '2023-04-22', 'Eliminar', 'Se eliminó un  rol'),
(1909, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1910, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1911, 21, 37, '2023-04-22', 'Insertar', 'Se insertó un  rol'),
(1912, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1913, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1914, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1915, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1916, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1917, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1918, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1919, 21, 37, '2023-04-22', 'Eliminar', 'Se eliminó un  rol'),
(1920, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1921, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(1922, 21, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1923, 21, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1924, 21, 31, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(1925, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1926, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(1927, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1928, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1929, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(1930, 51, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario CORREGIDO ha ingresado al sistema'),
(1931, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1932, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1933, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1934, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1935, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1936, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1937, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1938, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1939, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1940, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1941, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1942, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(1943, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(1944, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1945, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1946, 51, 45, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de talonario'),
(1947, 51, 45, '2023-04-22', 'Actualizar', 'Se actualizó un registro de Talonario'),
(1948, 51, 45, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de talonario'),
(1949, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1950, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1951, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1952, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1953, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1954, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1955, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1956, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1957, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1958, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1959, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1960, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1961, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1962, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1963, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1964, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1965, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1966, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1967, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1968, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(1969, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(1970, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1971, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1972, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1973, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1974, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1975, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1976, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1977, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1978, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1979, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1980, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(1981, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1982, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1983, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(1984, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1985, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1986, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1987, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1988, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(1989, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1990, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1991, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1992, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1993, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(1994, 51, 34, '2023-04-22', 'Insertar', 'Se insertó un Producto'),
(1995, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(1996, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1997, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1998, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(1999, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2000, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2001, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2002, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2003, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2004, 51, 34, '2023-04-22', 'Eliminar', 'Se eliminó un Producto'),
(2005, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2006, 51, 34, '2023-04-22', 'Eliminar', 'Se eliminó un Producto'),
(2007, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2008, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2009, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2010, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2011, 51, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario CORREGIDO ha cerrado sesión'),
(2012, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2013, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2014, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2015, 51, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario CORREGIDO ha ingresado al sistema'),
(2016, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2017, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2018, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2019, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2020, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras');
INSERT INTO `tbl_ms_bitacora` (`Id_bitacora`, `Id_Usuario`, `Id_Objeto`, `Fecha`, `Accion`, `Descripcion`) VALUES
(2021, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2022, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2023, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2024, 51, 42, '2023-04-22', 'Eliminar', 'Se eliminó un cargo'),
(2025, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2026, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2027, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2028, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2029, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2030, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2031, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2032, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2033, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2034, 51, 46, '2023-04-22', 'Insertar', 'Se insertó un nuevo contacto de un proveedor'),
(2035, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2036, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2037, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2038, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2039, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2040, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2041, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2042, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2043, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2044, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2045, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2046, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2047, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2048, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2049, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2050, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2051, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2052, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2053, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2054, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2055, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2056, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2057, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2058, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2059, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2060, 51, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2061, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2062, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2063, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2064, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2065, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2066, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2067, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2068, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2069, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2070, 51, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2071, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2072, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2073, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2074, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2075, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2076, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2077, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2078, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2079, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2080, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2081, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2082, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2083, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2084, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2085, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2086, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2087, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2088, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2089, 51, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2090, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2091, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2092, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2093, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2094, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2095, 51, 42, '2023-04-22', 'Eliminar', 'Se eliminó un cargo'),
(2096, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2097, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2098, 51, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2099, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2100, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(2101, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2102, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2103, 51, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2104, 51, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2105, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2106, 51, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2107, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2108, 51, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2109, 51, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario CORREGIDO ha cerrado sesión'),
(2110, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2111, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2112, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2113, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2114, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2115, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2116, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2117, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2118, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2119, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2120, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2121, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2122, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2123, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2124, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2125, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2126, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2127, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2128, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2129, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2130, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2131, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2132, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2133, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2134, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2135, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2136, 21, 46, '2023-04-22', 'Insertar', 'Se eliminó un contacto de un proveedor'),
(2137, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2138, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2139, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2140, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2141, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2142, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2143, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2144, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2145, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2146, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2147, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2148, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2149, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2150, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2151, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2152, 21, 46, '2023-04-22', 'Insertar', 'Se insertó un nuevo contacto de un proveedor'),
(2153, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2154, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2155, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2156, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2157, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2158, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2159, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2160, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2161, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2162, 21, 47, '2023-04-22', 'Insertar', 'Se insertó un nuevo de contacto de un Cliente'),
(2163, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2164, 21, 47, '2023-04-22', 'Actualizar', 'Se actualizó un contacto de un Cliente'),
(2165, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2166, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2167, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2168, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2169, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2170, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2171, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2172, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2173, 21, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2174, 21, 34, '2023-04-22', 'Insertar', 'Se insertó un Producto'),
(2175, 21, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2176, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2177, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2178, 51, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario CORREGIDO ha ingresado al sistema'),
(2179, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2180, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(2181, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2182, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2183, 51, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario CORREGIDO ha cerrado sesión'),
(2184, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2185, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2186, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2187, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2188, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2189, 21, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2190, 21, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2191, 21, 42, '2023-04-22', 'Insertar', 'Se insertó un cargo'),
(2192, 21, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2193, 21, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2194, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2195, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2196, 21, 47, '2023-04-22', 'Actualizar', 'Se actualizó un contacto de un Cliente'),
(2197, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2198, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2199, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2200, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2201, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2202, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2203, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2204, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2205, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2206, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2207, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2208, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2209, 21, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2210, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2211, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2212, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2213, 21, 29, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2214, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2215, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2216, 21, 46, '2023-04-22', 'Insertar', 'Se insertó un nuevo contacto de un proveedor'),
(2217, 21, 46, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2218, 21, 30, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2219, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2220, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2221, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2222, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2223, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2224, 21, 47, '2023-04-22', 'Insertar', 'Se insertó un nuevo de contacto de un Cliente'),
(2225, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2226, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2227, 21, 47, '2023-04-22', 'Actualizar', 'Se actualizó un contacto de un Cliente'),
(2228, 21, 47, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2229, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2230, 21, 24, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2231, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2232, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2233, 21, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2234, 21, 34, '2023-04-22', 'Insertar', 'Se insertó un Producto'),
(2235, 21, 34, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2236, 21, 33, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2237, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2238, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2239, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2240, 21, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2241, 21, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2242, 21, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2243, 21, 42, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2244, 21, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2245, 21, 4, '2023-04-21', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2246, 51, 1, '2023-04-21', 'Inicio de Sesión', 'El usuario CORREGIDO ha ingresado al sistema'),
(2247, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2248, 51, 36, '2023-04-22', 'Actualizar', 'Se actualizó un usuario'),
(2249, 51, 36, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2250, 51, 37, '2023-04-22', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2251, 21, 1, '2023-04-22', 'Inicio de Sesión fallido', 'El usuario ADMINISTRADOR ha intentado ingresar al sistema'),
(2252, 21, 1, '2023-04-22', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2253, 21, 37, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2254, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2255, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2256, 21, 37, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2257, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2258, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2259, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2260, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2261, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2262, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2263, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2264, 21, 4, '2023-04-22', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2265, 21, 1, '2023-04-22', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2266, 21, 37, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2267, 21, 37, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2268, 21, 37, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2269, 21, 24, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2270, 21, 29, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2271, 21, 1, '2023-04-23', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2272, 21, 29, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2273, 21, 29, '2023-04-23', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2274, 21, 1, '2023-04-23', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2275, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2276, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2277, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2278, 21, 37, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2279, 21, 34, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2280, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2281, 21, 40, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2282, 21, 37, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2283, 21, 33, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2284, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2285, 21, 42, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2286, 21, 42, '2023-04-24', 'Insertar', 'Se insertó una especie'),
(2287, 21, 42, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2288, 21, 42, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2289, 21, 29, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2290, 21, 42, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2291, 21, 29, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2292, 21, 44, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Tipos de productos'),
(2293, 21, 1, '2023-04-24', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2294, 21, 40, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2295, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2296, 21, 1, '2023-04-24', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2297, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2298, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2299, 21, 33, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2300, 21, 34, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2301, 21, 34, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2302, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2303, 21, 24, '2023-04-24', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2304, 21, 4, '2023-04-24', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2305, 21, 1, '2023-04-24', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2306, 21, 24, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2307, 21, 37, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2308, 21, 24, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2309, 21, 37, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2310, 21, 4, '2023-04-24', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2311, 21, 1, '2023-04-24', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2312, 21, 4, '2023-04-24', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2313, 21, 1, '2023-04-24', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2314, 21, 4, '2023-04-24', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2315, 21, 8, '2023-04-24', 'Recuperar Contraseña', 'Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),
(2316, 21, 1, '2023-04-24', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2317, 21, 24, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2318, 21, 24, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2319, 21, 33, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2320, 21, 24, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2321, 21, 29, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2322, 21, 42, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2323, 21, 34, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2324, 21, 42, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2325, 21, 29, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2326, 21, 29, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2327, 21, 42, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2328, 21, 30, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2329, 21, 33, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2330, 21, 46, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2331, 21, 30, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2332, 21, 30, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2333, 21, 48, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de Tipos de contactos'),
(2334, 21, 42, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2335, 21, 4, '2023-04-24', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2336, 21, 8, '2023-04-24', 'Recuperar Contraseña', 'Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),
(2337, 21, 8, '2023-04-24', 'Recuperar Contraseña', 'Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),
(2338, 21, 8, '2023-04-24', 'Recuperar Contraseña', 'Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),
(2339, 21, 1, '2023-04-25', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2340, 21, 41, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(2341, 21, 37, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2342, 21, 37, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2343, 21, 40, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2344, 21, 40, '2023-04-25', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2345, 21, 31, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(2346, 21, 41, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(2347, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2348, 21, 4, '2023-04-25', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2349, 21, 8, '2023-04-25', 'Recuperar Contraseña', 'Se envio correo para cambio de contraseña al usuario ADMINISTRADOR'),
(2350, 21, 1, '2023-04-25', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2351, 21, 40, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2352, 21, 33, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2353, 21, 33, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2354, 21, 33, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2355, 21, 33, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2356, 21, 36, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2357, 21, 36, '2023-04-26', 'Eliminar', 'Se eliminó un usuario'),
(2358, 21, 36, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2359, 21, 36, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2360, 21, 36, '2023-04-26', 'Eliminar', 'Se eliminó un usuario'),
(2361, 21, 36, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2362, 21, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2363, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2364, 21, 36, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2365, 21, 36, '2023-04-26', 'Insertar', 'Se insertó un usuario'),
(2366, 21, 36, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2367, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2368, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2369, 21, 37, '2023-04-26', 'Insertar', 'Se insertó un  rol'),
(2370, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2371, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2372, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2373, 21, 37, '2023-04-26', 'Actualizar', 'Se actualizó un rol'),
(2374, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2375, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2376, 21, 37, '2023-04-26', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2377, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2378, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2379, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2380, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2381, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2382, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2383, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2384, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2385, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2386, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2387, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2388, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2389, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2390, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2391, 21, 46, '2023-04-27', 'Insertar', 'Se insertó un nuevo contacto de un proveedor'),
(2392, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2393, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2394, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2395, 21, 47, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2396, 21, 47, '2023-04-27', 'Insertar', 'Se insertó un nuevo de contacto de un Cliente'),
(2397, 21, 47, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de contactos de Clientes'),
(2398, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2399, 21, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2400, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2401, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2402, 21, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2403, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2404, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2405, 21, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2406, 70, 6, '2023-04-26', 'Auto registro', 'Se ha auto registrado el Usuario RUEBAC'),
(2407, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2408, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2409, 21, 36, '2023-04-27', 'Insertar', 'Se insertó un usuario'),
(2410, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2411, 71, 13, '2023-04-26', 'Configurar Preguntas Secretas', 'El usuario CAPACITACION ha configurado sus preguntas secretas'),
(2412, 71, 5, '2023-04-26', 'Cambio de contraseña(Usuario Nuevo)', 'El usuario CAPACITACION ha cambiado la contraseña'),
(2413, 71, 8, '2023-04-26', 'Recuperar Contraseña', 'Se envio correo para cambio de contraseña al usuario CAPACITACION'),
(2414, 71, 8, '2023-04-26', 'Contraseña actualizada con éxito', 'El usuario CAPACITACION ha cambiado su contraseña'),
(2415, 71, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario CAPACITACION ha ingresado al sistema'),
(2416, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2417, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2418, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2419, 21, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2420, 71, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario CAPACITACION ha ingresado al sistema'),
(2421, 71, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2422, 71, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario CAPACITACION ha cerrado sesión'),
(2423, 71, 12, '2023-04-26', 'Recuperar contraseña', 'El usuario CAPACITACION ha solicitado cambiar la contraseña por medio de preguntas secretas'),
(2424, 71, 10, '2023-04-26', 'Contraseña actualizada con éxito', 'El usuario CAPACITACION cambió la contraseña por medio de preguntas secretas'),
(2425, 71, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario CAPACITACION ha ingresado al sistema'),
(2426, 71, 4, '2023-04-26', 'Cierre de Sesión', 'El usuario CAPACITACION ha cerrado sesión'),
(2427, 21, 1, '2023-04-26', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2428, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2429, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2430, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2431, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2432, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2433, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2434, 21, 30, '2023-04-27', 'Insertar', 'Se insertó un nuevo proveedor'),
(2435, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2436, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2437, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2438, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2439, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2440, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2441, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2442, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2443, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2444, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2445, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2446, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2447, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2448, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2449, 21, 29, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Compras'),
(2450, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2451, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2452, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2453, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2454, 21, 46, '2023-04-27', 'Insertar', 'Se insertó un nuevo contacto de un proveedor'),
(2455, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2456, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2457, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2458, 21, 46, '2023-04-27', 'Insertar', 'Se insertó un nuevo contacto de un proveedor'),
(2459, 21, 46, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de los contactos de proveedores'),
(2460, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2461, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2462, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2463, 21, 30, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Proveedores'),
(2464, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2465, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2466, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2467, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2468, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2469, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2470, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2471, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2472, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2473, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2474, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2475, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2476, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2477, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2478, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2479, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2480, 21, 34, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2481, 21, 34, '2023-04-27', 'Insertar', 'Se insertó un Producto'),
(2482, 21, 34, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Productos'),
(2483, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2484, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2485, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Kardex'),
(2486, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2487, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2488, 21, 37, '2023-04-27', 'Insertar', 'Se insertó un  rol'),
(2489, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2490, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2491, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2492, 21, 40, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2493, 21, 40, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2494, 21, 40, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de parámetros'),
(2495, 21, 31, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de preguntas'),
(2496, 21, 41, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(2497, 21, 41, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de objetos'),
(2498, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2499, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2500, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de especies'),
(2501, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2502, 21, 42, '2023-04-27', 'Insertar', 'Se insertó un cargo'),
(2503, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2504, 21, 42, '2023-04-27', 'Actualizar', 'Se actualizó un cargo'),
(2505, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2506, 21, 42, '2023-04-27', 'Eliminar', 'Se eliminó un cargo'),
(2507, 21, 42, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de cargos'),
(2508, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2509, 21, 36, '2023-04-27', 'Actualizar', 'Se actualizó un usuario'),
(2510, 21, 36, '2023-04-27', 'Actualizar', 'Se actualizó un usuario'),
(2511, 21, 36, '2023-04-27', 'Actualizar', 'Se actualizó un usuario'),
(2512, 21, 36, '2023-04-27', 'Actualizar', 'Se actualizó un usuario'),
(2513, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2514, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2515, 21, 36, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de usuarios'),
(2516, 21, 37, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos'),
(2517, 21, 1, '2023-04-27', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2518, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2519, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2520, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2521, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2522, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2523, 21, 1, '2023-04-27', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2524, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2525, 21, 4, '2023-04-27', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2526, 21, 1, '2023-04-27', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2527, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2528, 21, 33, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Inventario'),
(2529, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2530, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2531, 21, 24, '2023-04-27', 'Ingresar', 'Se ingresó a la pantalla de Ventas'),
(2532, 21, 4, '2023-04-27', 'Cierre de Sesión', 'El usuario ADMINISTRADOR ha cerrado sesión'),
(2533, 21, 1, '2023-04-27', 'Inicio de Sesión', 'El usuario ADMINISTRADOR ha ingresado al sistema'),
(2534, 21, 37, '2023-04-28', 'Ingresar', 'Se ingresó a la pantalla de roles y permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_hist_contraseña`
--

CREATE TABLE `tbl_ms_hist_contraseña` (
  `Id_Historial` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Contraseña` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_parametros`
--

CREATE TABLE `tbl_ms_parametros` (
  `Id_Parametro` int NOT NULL,
  `Parametro` varchar(50) DEFAULT NULL,
  `Valor` varchar(100) DEFAULT NULL,
  `Creado_por` varchar(45) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Modificado_por` varchar(45) DEFAULT NULL,
  `Fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ms_parametros`
--

INSERT INTO `tbl_ms_parametros` (`Id_Parametro`, `Parametro`, `Valor`, `Creado_por`, `Fecha_creacion`, `Modificado_por`, `Fecha_modificacion`) VALUES
(1, 'CORREO_EXP', '900', NULL, NULL, NULL, NULL),
(2, 'ADMIN_VIGENCIA', '30', NULL, NULL, NULL, NULL),
(3, 'ADMIN_INTENTOS', '2', NULL, NULL, NULL, NULL),
(4, 'ADMIN_PREGUNTAS', '3', NULL, NULL, NULL, NULL),
(5, 'MAX_CONTRASENIA', '15', NULL, NULL, NULL, NULL),
(6, 'MIN_CONTRASENIA', '8', NULL, NULL, NULL, NULL),
(7, 'FEC_VENCIMIENTO', '30', NULL, NULL, NULL, NULL),
(8, 'NOMBRE_EMPRESA', 'Empresa de servicios múltiples jóvenes profesionales de La Sierra de la Paz', NULL, NULL, NULL, NULL),
(9, 'LOGO', 'C:\\xampp\\htdocs\\SIIS-Proyecto\\img\\logo.jpg', NULL, NULL, NULL, NULL),
(10, 'HOST', 'localhost', NULL, NULL, NULL, NULL),
(11, 'USER', 'SIIS2', NULL, NULL, NULL, NULL),
(12, 'PASSWORD', '12345', NULL, NULL, NULL, NULL),
(13, 'NAME', 'proyecto-siis', NULL, NULL, NULL, NULL),
(14, 'ruta', 'C:\\xampp\\htdocs\\SIIS-Proyecto\\Backups', NULL, NULL, NULL, NULL),
(15, 'IMPUESTO', '10', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_preguntas`
--

CREATE TABLE `tbl_ms_preguntas` (
  `Id_Pregunta` int NOT NULL,
  `Pregunta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ms_preguntas`
--

INSERT INTO `tbl_ms_preguntas` (`Id_Pregunta`, `Pregunta`) VALUES
(1, '¿Nombre de tu primera mascota?'),
(2, '¿Ciudad de  Nacimiento?'),
(3, '¿En que escuela estudiaste?'),
(4, '¿Que carrera estudiaste?'),
(5, '¿Cuál es tu color favorito?'),
(6, '¿Cuál es tu clase Favorita?'),
(7, '¿Cuál es tu lenguaje de programación favorito?'),
(8, '¿Cuál es la fecha del cumpleaños de tu papá?'),
(9, '¿Que país te gustaría visitar?'),
(10, 'CUÁL ES TU TIPO DE SANGRE?'),
(11, '¿Cuál es tu comida favorita?'),
(13, '¿Prueba?'),
(14, '¿PruebaActualizada?'),
(19, '¿PruebaNueva?'),
(20, '¿PRUEBA NUEVA? '),
(21, 'PREGUNTA DE PRUEBA'),
(26, '¿PRUEBANUEVA?'),
(28, '¿QUÉ CARRERA ESTUDIAS?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_preguntas_usuarios`
--

CREATE TABLE `tbl_ms_preguntas_usuarios` (
  `Id_Preguntas_Usuario` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Id_Pregunta` int NOT NULL,
  `Respuesta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ms_preguntas_usuarios`
--

INSERT INTO `tbl_ms_preguntas_usuarios` (`Id_Preguntas_Usuario`, `Id_Usuario`, `Id_Pregunta`, `Respuesta`) VALUES
(1, 21, 1, 'Chuchi'),
(2, 21, 2, 'Tegucigalpa'),
(3, 21, 3, 'Desarrollo Juvenil'),
(73, 51, 1, 'Chuchi'),
(74, 51, 2, 'Tegucigalpa'),
(75, 51, 3, 'Desarrollo Juvenil'),
(76, 71, 1, 'Chuchi'),
(77, 71, 2, 'Tegucigalpa'),
(78, 71, 28, 'Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_roles`
--

CREATE TABLE `tbl_ms_roles` (
  `Id_Rol` int NOT NULL,
  `Rol` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ms_roles`
--

INSERT INTO `tbl_ms_roles` (`Id_Rol`, `Rol`, `Descripcion`) VALUES
(1, 'ADMINISTRADOR', 'TODOS LOS PERMISOS'),
(2, 'USUARIO', 'Rol por defecto'),
(3, 'DEFAULT', 'Ningún permiso'),
(74, 'INFORMATICA', 'INFORMATICAS'),
(101, 'ROL DE PRUEBA', 'DESCRIPCIÓN DE PRUEBA '),
(102, 'CAPACITACION', 'ALGUNOS PERMISOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_usuarios`
--

CREATE TABLE `tbl_ms_usuarios` (
  `Id_Usuario` int NOT NULL,
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
  `Fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ms_usuarios`
--

INSERT INTO `tbl_ms_usuarios` (`Id_Usuario`, `Id_Rol`, `Id_Cargo`, `Usuario`, `Nombre`, `Estado`, `Contraseña`, `Fecha_ultima_conexion`, `Preguntas_contestadas`, `Primer_ingreso`, `Fecha_vencimiento`, `DNI`, `Correo_Electronico`, `Creado_por`, `Fecha_creacion`, `Modificado_por`, `Fecha_modificacion`) VALUES
(21, 1, 1, 'ADMINISTRADOR', 'CAPACITACION', 'Activo', 'Prueba.11', '2023-04-28', NULL, 232, '2023-05-26', '0000000000004', 'kateandaraRDGT3@gmail.com', NULL, '2023-02-25', '', '2023-04-26'),
(51, 1, 1, 'CORREGIDO', 'KATE VALLE', 'Activo', 'Prueba.2', '2023-04-22', 3, 9, '2023-05-21', '0801200011179', 'kateandara123@gmail.com', 'ADMINISTRADOR', '2023-03-19', 'KATE', '2023-04-21'),
(58, 2, 1, 'KATE', 'KATE', 'Eliminado', 'Prueba.1', '2023-03-30', NULL, 2, '2023-04-19', '0801-2000-11179', 'kateandara1@gmail.com', 'ADMINISTRADOR', '2023-03-19', NULL, NULL),
(63, 3, 2, 'ROOT', 'KATE', 'Eliminado', 'Prueba.1', '2023-04-16', NULL, 2, '2023-05-04', '0801-2000-11179', 'kateandara1@gmail.com', NULL, '2023-04-04', 'ADMINISTRADOR', '2023-04-04'),
(64, 2, 2, 'RONY', 'RONY', '', 'Prueba.1', NULL, NULL, NULL, '2023-05-16', '0000000000001', 'fabriciosuazo.thfb@gmail.com', '', '2023-04-16', '', '2023-04-20'),
(65, 74, 1, 'USER', 'Kate', 'Eliminado', 'Prueba.11', '2023-04-19', NULL, 6, '2023-05-16', '0801200011178', 'andarakaterine@gmail.com', '', '2023-04-16', '', '2023-04-18'),
(69, 2, 2, 'PRUEBAF', 'ANDARA', 'Nuevo', 'Prueba.1', NULL, NULL, NULL, '2023-05-26', '0000000000011', 'vallekat986@gmail.com', '', '2023-04-26', NULL, NULL),
(70, 3, 2, 'RUEBAC', 'KATE', 'Nuevo', 'Prueba.1', NULL, NULL, NULL, '2023-05-27', '0000000000001', 'xxxxx@gmail.com', NULL, '2023-04-27', NULL, NULL),
(71, 2, 2, 'CAPACITACION', 'FANNY', 'Activo', 'Prueba.3', '2023-04-27', 3, 3, '2023-05-26', '0000000000111', 'kateandara@gmail.com', '', '2023-04-26', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_objetos`
--

CREATE TABLE `tbl_objetos` (
  `Id_Objeto` int NOT NULL,
  `Objeto` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Tipo_objeto` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_objetos`
--

INSERT INTO `tbl_objetos` (`Id_Objeto`, `Objeto`, `Descripcion`, `Tipo_objeto`) VALUES
(1, 'login', 'pantalla de inicio de sesión', 'pantalla'),
(2, 'recuperacion_Correo', 'pantalla de recuperación', 'pantalla'),
(3, 'registro', 'pantalla de autoregistro', 'pantalla'),
(4, 'log_out', 'Cerrar sesión', 'pantalla'),
(5, 'cambio_contra', 'Cambiar  contraseña si es nuevo', 'Pantalla'),
(6, 'autoregistro', 'Autoregistrarse', 'pantalla'),
(7, 'inactivo', 'Usuario inactivo o bloqueado', 'pantalla'),
(8, 'cambio_contraC', 'Actualización de contraseña por correo', 'pantalla'),
(9, 'editarusuario', 'Editar usuarios', 'pantalla'),
(10, 'cambio_contraPS', 'Cambio de contra por medio de preguntas secretas ', 'pantalla'),
(11, 'bloqueo', 'Usuario bloqueadao', 'pantalla'),
(12, 'recuperacion_Preguntas', 'pantalla de recuperación', 'pantalla'),
(13, 'PreguntasSecretas', 'Configuras Preguntas Secretas', 'pantalla'),
(19, 'Insertar_Permiso', 'Insertar Objetos', 'Pantalla'),
(20, 'Prueba', 'Sesión', 'Pantalla'),
(21, 'Insertar', 'Insertar datos', 'Pantalla'),
(24, 'Ventas', 'Ventas', 'Permiso'),
(25, 'Descuentos', 'Descuentos', 'Permiso'),
(26, 'Promociones', 'Promociones', 'Permiso'),
(27, 'Detalle de Venta', 'Detalle de Venta', 'Permiso'),
(28, 'Clientes', 'Clientes', 'Permiso'),
(29, 'Compras', 'Compras', 'Permiso'),
(30, 'Proveedores', 'Proveedores', 'Permiso'),
(31, 'Preguntas', 'Preguntas', 'Permiso'),
(32, 'Proceso de Producción', 'Proceso de Producción', 'Permiso'),
(33, 'Inventario', 'Inventario', 'Permiso'),
(34, 'Productos', 'Productos', 'Permiso'),
(35, 'Kardex', 'Kardex', 'Permiso'),
(36, 'Usuarios', 'Usuarios', 'Permiso'),
(37, 'Roles', 'Roles', 'Permiso'),
(38, 'Permisos', 'Permisos', 'Permiso'),
(39, 'Bitácora', 'Bitácora', 'Permiso'),
(40, 'Parámetros', 'Parámetros', 'Permiso'),
(41, 'Objetos', 'Objetos', 'Permiso'),
(42, 'Cargos', 'Cargos', 'Permiso'),
(43, 'Estado de venta', 'Estado de Venta', 'Permiso'),
(44, 'Tipo de Producto', 'Tipo de Producto', 'Permiso'),
(45, 'Talonario', 'Talonario', 'Permiso'),
(46, 'Contactos Proveedores', 'Contacto Proveedores', 'Permiso'),
(47, 'Contactos de Clientes', 'Contactos de Clientes', 'Permiso'),
(48, 'Tipo de Contacto', 'Tipo de Contacto', 'Permiso'),
(49, 'Tipo de Movimiento', 'Tipo de Movimiento', 'Permiso'),
(50, 'Estado del Proceso', 'Estado del Proceso', 'Permiso'),
(51, 'Backup', 'Backup', 'Permiso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_permisos`
--

CREATE TABLE `tbl_permisos` (
  `Id_Permisos` int NOT NULL,
  `Id_Rol` int NOT NULL,
  `Id_Objeto` int NOT NULL,
  `Permiso_insercion` varchar(1) DEFAULT NULL,
  `Permiso_eliminacion` varchar(1) DEFAULT NULL,
  `Permiso_actualizacion` varchar(1) DEFAULT NULL,
  `Permiso_consultar` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_permisos`
--

INSERT INTO `tbl_permisos` (`Id_Permisos`, `Id_Rol`, `Id_Objeto`, `Permiso_insercion`, `Permiso_eliminacion`, `Permiso_actualizacion`, `Permiso_consultar`) VALUES
(3, 3, 9, '0', '0', '0', '1'),
(1079, 1, 24, '1', '1', '1', '1'),
(1080, 1, 25, '1', '1', '1', '1'),
(1081, 1, 26, '1', '1', '1', '1'),
(1082, 1, 27, '1', '1', '1', '1'),
(1083, 1, 28, '1', '1', '1', '1'),
(1084, 1, 29, '1', '1', '1', '1'),
(1085, 1, 30, '1', '1', '1', '1'),
(1086, 1, 31, '1', '1', '1', '1'),
(1087, 1, 32, '1', '1', '1', '1'),
(1088, 1, 33, '1', '1', '1', '1'),
(1089, 1, 34, '1', '1', '1', '1'),
(1090, 1, 35, '1', '1', '1', '1'),
(1091, 1, 36, '1', '1', '1', '1'),
(1092, 1, 37, '1', '1', '1', '1'),
(1093, 1, 38, '1', '1', '1', '1'),
(1094, 1, 39, '1', '1', '1', '1'),
(1095, 1, 40, '1', '1', '1', '1'),
(1096, 1, 41, '1', '1', '1', '1'),
(1097, 1, 42, '1', '1', '1', '1'),
(1098, 1, 43, '1', '1', '1', '1'),
(1099, 1, 44, '1', '1', '1', '1'),
(1100, 1, 45, '1', '1', '1', '1'),
(1101, 1, 46, '1', '1', '1', '1'),
(1102, 1, 47, '1', '1', '1', '1'),
(1103, 1, 48, '1', '1', '1', '1'),
(1104, 1, 49, '1', '1', '1', '1'),
(1105, 1, 50, '1', '1', '1', '1'),
(1106, 1, 51, '1', '1', '1', '1'),
(1107, 101, 24, '1', '0', '0', '1'),
(1108, 101, 25, '1', '0', '0', '1'),
(1109, 101, 26, '1', '0', '0', '1'),
(1110, 101, 27, '1', '0', '0', '1'),
(1111, 101, 28, '1', '1', '0', '1'),
(1112, 101, 29, '1', '0', '0', '1'),
(1113, 101, 30, '1', '0', '0', '1'),
(1114, 101, 31, '1', '0', '0', '1'),
(1115, 101, 32, '1', '1', '1', '1'),
(1116, 101, 33, '1', '0', '0', '1'),
(1117, 101, 34, '1', '0', '0', '1'),
(1118, 101, 35, '1', '1', '1', '1'),
(1119, 101, 36, '1', '0', '0', '1'),
(1120, 101, 37, '1', '0', '0', '1'),
(1121, 101, 38, '1', '0', '0', '1'),
(1122, 101, 39, '1', '0', '0', '1'),
(1123, 101, 40, '0', '0', '0', '1'),
(1124, 101, 41, '0', '0', '0', '1'),
(1125, 101, 42, '0', '0', '0', '1'),
(1126, 101, 43, '0', '0', '0', '1'),
(1127, 101, 44, '0', '0', '0', '1'),
(1128, 101, 45, '0', '0', '0', '1'),
(1129, 101, 46, '0', '0', '0', '1'),
(1130, 101, 47, '0', '0', '1', '1'),
(1131, 101, 48, '0', '0', '0', '1'),
(1132, 101, 49, '0', '0', '0', '1'),
(1133, 101, 50, '0', '1', '0', '1'),
(1134, 101, 51, '0', '0', '0', '1'),
(1135, 2, 24, '1', '1', '1', '1'),
(1136, 2, 25, '1', '1', '1', '1'),
(1137, 2, 26, '0', '0', '0', '0'),
(1138, 2, 27, '0', '0', '0', '0'),
(1139, 2, 28, '0', '0', '0', '0'),
(1140, 2, 29, '0', '0', '0', '0'),
(1141, 2, 30, '0', '0', '0', '0'),
(1142, 2, 31, '0', '0', '0', '0'),
(1143, 2, 32, '0', '0', '0', '0'),
(1144, 2, 33, '0', '0', '0', '0'),
(1145, 2, 34, '0', '0', '0', '0'),
(1146, 2, 35, '0', '0', '0', '0'),
(1147, 2, 36, '0', '0', '0', '0'),
(1148, 2, 37, '0', '0', '0', '0'),
(1149, 2, 38, '0', '0', '0', '0'),
(1150, 2, 39, '0', '0', '0', '0'),
(1151, 2, 40, '0', '0', '0', '0'),
(1152, 2, 41, '0', '0', '0', '0'),
(1153, 2, 42, '0', '0', '0', '0'),
(1154, 2, 43, '0', '0', '0', '0'),
(1155, 2, 44, '0', '0', '0', '0'),
(1156, 2, 45, '0', '0', '0', '0'),
(1157, 2, 46, '0', '0', '0', '0'),
(1158, 2, 47, '0', '0', '0', '0'),
(1159, 2, 48, '0', '0', '0', '0'),
(1160, 2, 49, '0', '0', '0', '0'),
(1161, 2, 50, '0', '0', '0', '0'),
(1162, 2, 51, '0', '0', '0', '0'),
(1163, 102, 24, '0', '0', '0', '1'),
(1164, 102, 25, '0', '0', '0', '1'),
(1165, 102, 26, '0', '0', '0', '1'),
(1166, 102, 27, '0', '0', '0', '1'),
(1167, 102, 28, '0', '0', '0', '1'),
(1168, 102, 29, '0', '0', '0', '1'),
(1169, 102, 30, '0', '0', '0', '1'),
(1170, 102, 31, '0', '0', '0', '1'),
(1171, 102, 32, '0', '0', '0', '1'),
(1172, 102, 33, '0', '0', '0', '1'),
(1173, 102, 34, '0', '0', '0', '1'),
(1174, 102, 35, '0', '0', '0', '1'),
(1175, 102, 36, '0', '0', '0', '1'),
(1176, 102, 37, '0', '0', '0', '1'),
(1177, 102, 38, '0', '0', '0', '0'),
(1178, 102, 39, '0', '0', '0', '0'),
(1179, 102, 40, '0', '0', '0', '0'),
(1180, 102, 41, '0', '0', '0', '0'),
(1181, 102, 42, '0', '0', '0', '0'),
(1182, 102, 43, '0', '0', '0', '0'),
(1183, 102, 44, '0', '0', '0', '0'),
(1184, 102, 45, '0', '0', '0', '0'),
(1185, 102, 46, '0', '0', '0', '0'),
(1186, 102, 47, '0', '0', '0', '0'),
(1187, 102, 48, '0', '0', '0', '0'),
(1188, 102, 49, '0', '0', '0', '0'),
(1189, 102, 50, '0', '0', '0', '0'),
(1190, 102, 51, '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proceso_produccion`
--

CREATE TABLE `tbl_proceso_produccion` (
  `Id_Proceso_Produccion` int NOT NULL,
  `Id_Estado_Proceso` int NOT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_proceso_produccion`
--

INSERT INTO `tbl_proceso_produccion` (`Id_Proceso_Produccion`, `Id_Estado_Proceso`, `Fecha`) VALUES
(1, 3, '2023-03-17'),
(23, 3, '2023-04-22'),
(24, 1, '2023-04-22'),
(25, 3, '2023-04-22'),
(26, 3, '2023-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `Id_Producto` int NOT NULL,
  `Id_Tipo_Producto` int NOT NULL,
  `Nombre` varchar(60) DEFAULT NULL,
  `Unidad_medida` varchar(45) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Cantidad_maxima` int DEFAULT NULL,
  `Cantidad_minima` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`Id_Producto`, `Id_Tipo_Producto`, `Nombre`, `Unidad_medida`, `Precio`, `Cantidad_maxima`, `Cantidad_minima`) VALUES
(1, 1, 'Chuleta', 'libra', '50.00', 15, 2),
(2, 1, 'Chorizo suelto', 'libra', '125.00', 10, 2),
(3, 2, 'Cerdito', 'Libra', '10500.00', 10, 2),
(4, 2, 'Vaca', 'Libra', '80.00', 10, 2),
(5, 1, 'Patas de cerdo', 'Libra', '120.00', 20, 10),
(7, 1, 'CHICHARRON', 'LIBRA', '100.00', 15, 5),
(8, 1, 'LOMO 1', 'LIBRA', '70.00', 10, 2),
(9, 1, 'PRUEBA 2', 'LIBRA', '120.00', 10, 2),
(10, 1, 'CAPACITACION1', 'LIBRA', '150.00', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto_terminado_final`
--

CREATE TABLE `tbl_producto_terminado_final` (
  `Id_Producto_Terminado_Final` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Id_Proceso_Produccion` int NOT NULL,
  `Cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto_terminado_mp`
--

CREATE TABLE `tbl_producto_terminado_mp` (
  `Id_Producto_Terminado_Mp` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Id_Proceso_Produccion` int NOT NULL,
  `Cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_producto_terminado_mp`
--

INSERT INTO `tbl_producto_terminado_mp` (`Id_Producto_Terminado_Mp`, `Id_Producto`, `Id_Proceso_Produccion`, `Cantidad`) VALUES
(24, 3, 23, 1),
(25, 3, 25, 1),
(26, 3, 26, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promociones`
--

CREATE TABLE `tbl_promociones` (
  `Id_Promocion` int NOT NULL,
  `Nombre_Promocion` varchar(100) DEFAULT NULL,
  `Precio_Venta` decimal(10,2) DEFAULT NULL,
  `Fecha_inicio` date DEFAULT NULL,
  `Fecha_final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_promociones`
--

INSERT INTO `tbl_promociones` (`Id_Promocion`, `Nombre_Promocion`, `Precio_Venta`, `Fecha_inicio`, `Fecha_final`) VALUES
(1, 'Verano', '45.00', '2023-04-18', '2023-04-30'),
(2, 'Invierno', '100.00', '2023-04-20', '2023-05-15'),
(4, 'INFORMATICA', '100.00', '2023-04-21', '2023-04-30'),
(5, 'PRUEBA', '100.00', '2023-04-21', '2023-04-30'),
(6, 'Combo 1', '200.00', '2023-04-23', '2023-04-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promocion_producto`
--

CREATE TABLE `tbl_promocion_producto` (
  `Id_Promocion_Producto` int NOT NULL,
  `Id_Producto` int NOT NULL,
  `Id_Promocion` int NOT NULL,
  `Cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_promocion_producto`
--

INSERT INTO `tbl_promocion_producto` (`Id_Promocion_Producto`, `Id_Producto`, `Id_Promocion`, `Cantidad`) VALUES
(1, 1, 1, 10),
(2, 2, 2, 17),
(4, 5, 2, 12),
(5, 5, 4, 5),
(6, 5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `Id_Proveedor` int NOT NULL,
  `Nombre` varchar(60) DEFAULT NULL,
  `RTN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`Id_Proveedor`, `Nombre`, `RTN`) VALUES
(1, 'Fanny', '999'),
(4, 'INFORMATICA', '11111111'),
(5, 'CAPACITACION', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores_contacto`
--

CREATE TABLE `tbl_proveedores_contacto` (
  `Id_Proveedores_Contacto` int NOT NULL,
  `Id_Tipo_Contacto` int NOT NULL,
  `Id_Proveedor` int NOT NULL,
  `Contacto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_proveedores_contacto`
--

INSERT INTO `tbl_proveedores_contacto` (`Id_Proveedores_Contacto`, `Id_Tipo_Contacto`, `Id_Proveedor`, `Contacto`) VALUES
(1, 1, 1, '99999999'),
(3, 2, 1, '7777777777'),
(4, 1, 1, '99889988'),
(5, 1, 4, '99999999'),
(6, 1, 4, '98765432'),
(7, 2, 4, 'prueba@gmail.com'),
(8, 1, 5, '99999999'),
(9, 2, 5, 'prueba@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_talonario`
--

CREATE TABLE `tbl_talonario` (
  `Id_Talonario` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Numero_CAI` varchar(60) DEFAULT NULL,
  `Rango_Inicial` varchar(60) DEFAULT NULL,
  `Rango_final` varchar(60) DEFAULT NULL,
  `Rango_actual` varchar(60) DEFAULT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_talonario`
--

INSERT INTO `tbl_talonario` (`Id_Talonario`, `Id_Usuario`, `Numero_CAI`, `Rango_Inicial`, `Rango_final`, `Rango_actual`, `Fecha_Vencimiento`) VALUES
(1, 21, '100-100-100-9', '1', '100', '15', '2023-05-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_contacto`
--

CREATE TABLE `tbl_tipo_contacto` (
  `Id_Tipo_Contacto` int NOT NULL,
  `Nombre_tipo_contacto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_tipo_contacto`
--

INSERT INTO `tbl_tipo_contacto` (`Id_Tipo_Contacto`, `Nombre_tipo_contacto`) VALUES
(1, 'Whatsapp'),
(2, 'Correo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_movimiento`
--

CREATE TABLE `tbl_tipo_movimiento` (
  `Id_Tipo_Movimiento` int NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_tipo_movimiento`
--

INSERT INTO `tbl_tipo_movimiento` (`Id_Tipo_Movimiento`, `Descripcion`) VALUES
(1, 'Entrada'),
(2, 'Salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_producto`
--

CREATE TABLE `tbl_tipo_producto` (
  `Id_Tipo_Producto` int NOT NULL,
  `Nombre_tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_tipo_producto`
--

INSERT INTO `tbl_tipo_producto` (`Id_Tipo_Producto`, `Nombre_tipo`) VALUES
(1, 'Producto terminado Final'),
(2, 'Producto terminado MP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas`
--

CREATE TABLE `tbl_ventas` (
  `Id_Venta` int NOT NULL,
  `Id_Cliente` int NOT NULL,
  `Id_Usuario` int NOT NULL,
  `Id_Estado_Venta` int NOT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL,
  `Impuesto` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `RTN` varchar(45) DEFAULT NULL,
  `Numero_factura` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ventas`
--

INSERT INTO `tbl_ventas` (`Id_Venta`, `Id_Cliente`, `Id_Usuario`, `Id_Estado_Venta`, `Subtotal`, `Impuesto`, `Total`, `Fecha`, `RTN`, `Numero_factura`) VALUES
(1, 1, 21, 1, '81.00', '8.10', '89.10', '2023-04-18', '12345', '123456789-2'),
(16, 2, 21, 1, '627.00', '62.70', '689.70', '2023-04-21', '12345', '100-100-100-9-12'),
(17, 4, 21, 1, '918.00', '91.80', '1009.80', '2023-04-21', '12345', '100-100-100-9-13'),
(18, 1, 21, 1, '100.00', '10.00', '110.00', '2023-04-24', '', '100-100-100-9-14'),
(19, 1, 21, 1, '788.50', '78.85', '867.35', '2023-04-26', '1234556789', '100-100-100-9-15'),
(20, 1, 21, 1, '245.00', '24.50', '269.50', '2023-04-26', '', ''),
(21, 1, 21, 1, '250.00', '25.00', '275.00', '2023-04-27', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas_descuento`
--

CREATE TABLE `tbl_ventas_descuento` (
  `Id_Ventas_Descuento` int NOT NULL,
  `Id_Venta` int NOT NULL,
  `Id_Descuento` int NOT NULL,
  `Porcentaje_descontado` varchar(11) DEFAULT NULL,
  `Total_descuento` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ventas_descuento`
--

INSERT INTO `tbl_ventas_descuento` (`Id_Ventas_Descuento`, `Id_Venta`, `Id_Descuento`, `Porcentaje_descontado`, `Total_descuento`) VALUES
(12, 16, 8, '5%', '33.00'),
(13, 17, 9, '15%', '162.00'),
(14, 18, 0, '0', '0.00'),
(15, 19, 1, '10%', '76.50'),
(16, 20, 0, '0', '0.00'),
(17, 21, 0, '0', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas_promociones`
--

CREATE TABLE `tbl_ventas_promociones` (
  `Id_Venta_Promocion` int NOT NULL,
  `Id_Promocion` int NOT NULL,
  `Id_Venta` int NOT NULL,
  `Precio_venta` decimal(10,2) DEFAULT NULL,
  `Cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_ventas_promociones`
--

INSERT INTO `tbl_ventas_promociones` (`Id_Venta_Promocion`, `Id_Promocion`, `Id_Venta`, `Precio_venta`, `Cantidad`) VALUES
(1, 2, 18, '100.00', 2),
(2, 2, 19, '100.00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cargos`
--
ALTER TABLE `tbl_cargos`
  ADD PRIMARY KEY (`Id_Cargo`);

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`Id_Cliente`);

--
-- Indices de la tabla `tbl_clientes_contacto`
--
ALTER TABLE `tbl_clientes_contacto`
  ADD PRIMARY KEY (`Id_Cliente_Contacto`),
  ADD KEY `fk_TBL_CLIENTES_CONTACTO_TBL_TIPO_CONTACTO1_idx` (`Id_Tipo_Contacto`),
  ADD KEY `fk_TBL_CLIENTES_CONTACTO_TBL_CLIENTES1_idx` (`Id_Cliente`);

--
-- Indices de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD PRIMARY KEY (`Id_Compra`),
  ADD KEY `fk_TBL_COMPRAS_TBL_PROVEEDORES1_idx` (`Id_Proveedor`);

--
-- Indices de la tabla `tbl_descuentos`
--
ALTER TABLE `tbl_descuentos`
  ADD PRIMARY KEY (`Id_Descuento`);

--
-- Indices de la tabla `tbl_detalle_compra`
--
ALTER TABLE `tbl_detalle_compra`
  ADD PRIMARY KEY (`Id_Detalle_Compra`),
  ADD KEY `fk_TBL_COMPRA_MATERIA_PRIMA_has_TBL_PROVEEDORES_TBL_COMPRA__idx` (`Id_Compra`),
  ADD KEY `fk_TBL_DETALLE_COMPRA_TBL_PRODUCTOS1_idx` (`Id_Producto`);

--
-- Indices de la tabla `tbl_detalle_de_venta`
--
ALTER TABLE `tbl_detalle_de_venta`
  ADD PRIMARY KEY (`Id_Detalle_Venta`),
  ADD KEY `fk_TBL_PRODUCTOS_has_TBL_VENTAS_TBL_VENTAS1_idx` (`Id_Venta`),
  ADD KEY `fk_TBL_PRODUCTOS_has_TBL_VENTAS_TBL_PRODUCTOS1_idx` (`Id_Producto`);

--
-- Indices de la tabla `tbl_detalle_producto_comprado`
--
ALTER TABLE `tbl_detalle_producto_comprado`
  ADD PRIMARY KEY (`Id_Detalle_Producto_Comprado`),
  ADD KEY `fk_TBL_DETALLE_PRODUCTO_COMPRADO_TBL_DETALLE_COMPRA1_idx` (`Id_Detalle_Compra`);

--
-- Indices de la tabla `tbl_errores`
--
ALTER TABLE `tbl_errores`
  ADD PRIMARY KEY (`Id_error`);

--
-- Indices de la tabla `tbl_especies`
--
ALTER TABLE `tbl_especies`
  ADD PRIMARY KEY (`Id_Especie`);

--
-- Indices de la tabla `tbl_estado_proceso`
--
ALTER TABLE `tbl_estado_proceso`
  ADD PRIMARY KEY (`Id_Estado_Proceso`);

--
-- Indices de la tabla `tbl_estado_venta`
--
ALTER TABLE `tbl_estado_venta`
  ADD PRIMARY KEY (`Id_Estado_Venta`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`Id_Inventario`),
  ADD KEY `fk_TBL_INVENTARIO_TBL_PRODUCTOS1_idx` (`Id_Producto`);

--
-- Indices de la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD PRIMARY KEY (`Id_Kardex`),
  ADD KEY `fk_TBL_KARDEX_TBL_TIPO_MOVIMIENTO1_idx` (`Id_Tipo_Movimiento`),
  ADD KEY `fk_TBL_KARDEX_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_ms_bitacora`
--
ALTER TABLE `tbl_ms_bitacora`
  ADD PRIMARY KEY (`Id_bitacora`),
  ADD KEY `fk_TBL_MS_BITACORA_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  ADD KEY `fk_TBL_MS_BITACORA_TBL_OBJETOS1_idx` (`Id_Objeto`);

--
-- Indices de la tabla `tbl_ms_hist_contraseña`
--
ALTER TABLE `tbl_ms_hist_contraseña`
  ADD PRIMARY KEY (`Id_Historial`),
  ADD KEY `fk_TBL_MS_HIST_CONTRASEÑA_TBL_MS_USUARIOS1_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_ms_parametros`
--
ALTER TABLE `tbl_ms_parametros`
  ADD PRIMARY KEY (`Id_Parametro`);

--
-- Indices de la tabla `tbl_ms_preguntas`
--
ALTER TABLE `tbl_ms_preguntas`
  ADD PRIMARY KEY (`Id_Pregunta`);

--
-- Indices de la tabla `tbl_ms_preguntas_usuarios`
--
ALTER TABLE `tbl_ms_preguntas_usuarios`
  ADD PRIMARY KEY (`Id_Preguntas_Usuario`),
  ADD KEY `fk_TBL_MS_USUARIOS_has_TBL_MS_PREGUNTAS_TBL_MS_PREGUNTAS1_idx` (`Id_Pregunta`),
  ADD KEY `fk_TBL_MS_USUARIOS_has_TBL_MS_PREGUNTAS_TBL_MS_USUARIOS1_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_ms_roles`
--
ALTER TABLE `tbl_ms_roles`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `fk_TBL_MS_USUARIOS_TBL_MS_ROLES1_idx` (`Id_Rol`),
  ADD KEY `fk_TBL_MS_USUARIOS_TBL_CARGOS1_idx` (`Id_Cargo`);

--
-- Indices de la tabla `tbl_objetos`
--
ALTER TABLE `tbl_objetos`
  ADD PRIMARY KEY (`Id_Objeto`);

--
-- Indices de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  ADD PRIMARY KEY (`Id_Permisos`),
  ADD KEY `FK_Id_Rol_TBL_PERMISOS_TBL_ROLES` (`Id_Rol`),
  ADD KEY `FK_Id_Objeto_TBL_PERMISOS_TBL_OBJETOS` (`Id_Objeto`);

--
-- Indices de la tabla `tbl_proceso_produccion`
--
ALTER TABLE `tbl_proceso_produccion`
  ADD PRIMARY KEY (`Id_Proceso_Produccion`),
  ADD KEY `fk_TBL_PROCESO_PRODUCCION_TBL_ESTADO_PROCESO1_idx` (`Id_Estado_Proceso`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`Id_Producto`),
  ADD KEY `fk_TBL_PRODUCTOS_TBL_TIPO_PRODUCTO1_idx` (`Id_Tipo_Producto`);

--
-- Indices de la tabla `tbl_producto_terminado_final`
--
ALTER TABLE `tbl_producto_terminado_final`
  ADD PRIMARY KEY (`Id_Producto_Terminado_Final`),
  ADD KEY `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  ADD KEY `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PROCESO_PRODUCCION1_idx` (`Id_Proceso_Produccion`);

--
-- Indices de la tabla `tbl_producto_terminado_mp`
--
ALTER TABLE `tbl_producto_terminado_mp`
  ADD PRIMARY KEY (`Id_Producto_Terminado_Mp`),
  ADD KEY `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PRODUCTOS1_idx` (`Id_Producto`),
  ADD KEY `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PROCESO_PRODUCCION1_idx` (`Id_Proceso_Produccion`);

--
-- Indices de la tabla `tbl_promociones`
--
ALTER TABLE `tbl_promociones`
  ADD PRIMARY KEY (`Id_Promocion`);

--
-- Indices de la tabla `tbl_promocion_producto`
--
ALTER TABLE `tbl_promocion_producto`
  ADD PRIMARY KEY (`Id_Promocion_Producto`),
  ADD KEY `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PROMOCIONES1_idx` (`Id_Promocion`),
  ADD KEY `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PRODUCTOS1_idx` (`Id_Producto`);

--
-- Indices de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`Id_Proveedor`);

--
-- Indices de la tabla `tbl_proveedores_contacto`
--
ALTER TABLE `tbl_proveedores_contacto`
  ADD PRIMARY KEY (`Id_Proveedores_Contacto`),
  ADD KEY `fk_PROVEEDORES_CONTACTO_TBL_TIPO_CONTACTO1_idx` (`Id_Tipo_Contacto`),
  ADD KEY `fk_PROVEEDORES_CONTACTO_TBL_PROVEEDORES1_idx` (`Id_Proveedor`);

--
-- Indices de la tabla `tbl_talonario`
--
ALTER TABLE `tbl_talonario`
  ADD PRIMARY KEY (`Id_Talonario`),
  ADD KEY `fk_TBL_TALONARIO_TBL_MS_USUARIOS1_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_tipo_contacto`
--
ALTER TABLE `tbl_tipo_contacto`
  ADD PRIMARY KEY (`Id_Tipo_Contacto`);

--
-- Indices de la tabla `tbl_tipo_movimiento`
--
ALTER TABLE `tbl_tipo_movimiento`
  ADD PRIMARY KEY (`Id_Tipo_Movimiento`);

--
-- Indices de la tabla `tbl_tipo_producto`
--
ALTER TABLE `tbl_tipo_producto`
  ADD PRIMARY KEY (`Id_Tipo_Producto`);

--
-- Indices de la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD PRIMARY KEY (`Id_Venta`),
  ADD KEY `fk_TBL_VENTAS_TBL_CLIENTES1_idx` (`Id_Cliente`),
  ADD KEY `fk_TBL_VENTAS_TBL_MS_USUARIOS1_idx` (`Id_Usuario`),
  ADD KEY `fk_TBL_VENTAS_TBL_ESTADO_VENTA1_idx` (`Id_Estado_Venta`);

--
-- Indices de la tabla `tbl_ventas_descuento`
--
ALTER TABLE `tbl_ventas_descuento`
  ADD PRIMARY KEY (`Id_Ventas_Descuento`),
  ADD KEY `fk_TBL_VENTAS_DESCUENTO_TBL_DESCUENTOS1_idx` (`Id_Descuento`),
  ADD KEY `fk_TBL_VENTAS_DESCUENTO_TBL_VENTAS1_idx` (`Id_Venta`);

--
-- Indices de la tabla `tbl_ventas_promociones`
--
ALTER TABLE `tbl_ventas_promociones`
  ADD PRIMARY KEY (`Id_Venta_Promocion`),
  ADD KEY `fk_TBL_VENTAS_PROMOCIONES_TBL_PROMOCIONES1_idx` (`Id_Promocion`),
  ADD KEY `fk_TBL_VENTAS_PROMOCIONES_TBL_VENTAS1_idx` (`Id_Venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cargos`
--
ALTER TABLE `tbl_cargos`
  MODIFY `Id_Cargo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `Id_Cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes_contacto`
--
ALTER TABLE `tbl_clientes_contacto`
  MODIFY `Id_Cliente_Contacto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `Id_Compra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `tbl_descuentos`
--
ALTER TABLE `tbl_descuentos`
  MODIFY `Id_Descuento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_compra`
--
ALTER TABLE `tbl_detalle_compra`
  MODIFY `Id_Detalle_Compra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_de_venta`
--
ALTER TABLE `tbl_detalle_de_venta`
  MODIFY `Id_Detalle_Venta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_producto_comprado`
--
ALTER TABLE `tbl_detalle_producto_comprado`
  MODIFY `Id_Detalle_Producto_Comprado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tbl_errores`
--
ALTER TABLE `tbl_errores`
  MODIFY `Id_error` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_especies`
--
ALTER TABLE `tbl_especies`
  MODIFY `Id_Especie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_proceso`
--
ALTER TABLE `tbl_estado_proceso`
  MODIFY `Id_Estado_Proceso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_venta`
--
ALTER TABLE `tbl_estado_venta`
  MODIFY `Id_Estado_Venta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `Id_Inventario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  MODIFY `Id_Kardex` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_bitacora`
--
ALTER TABLE `tbl_ms_bitacora`
  MODIFY `Id_bitacora` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2535;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_hist_contraseña`
--
ALTER TABLE `tbl_ms_hist_contraseña`
  MODIFY `Id_Historial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_parametros`
--
ALTER TABLE `tbl_ms_parametros`
  MODIFY `Id_Parametro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_preguntas`
--
ALTER TABLE `tbl_ms_preguntas`
  MODIFY `Id_Pregunta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_preguntas_usuarios`
--
ALTER TABLE `tbl_ms_preguntas_usuarios`
  MODIFY `Id_Preguntas_Usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_roles`
--
ALTER TABLE `tbl_ms_roles`
  MODIFY `Id_Rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  MODIFY `Id_Usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `tbl_objetos`
--
ALTER TABLE `tbl_objetos`
  MODIFY `Id_Objeto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  MODIFY `Id_Permisos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1191;

--
-- AUTO_INCREMENT de la tabla `tbl_proceso_produccion`
--
ALTER TABLE `tbl_proceso_produccion`
  MODIFY `Id_Proceso_Produccion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `Id_Producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_producto_terminado_final`
--
ALTER TABLE `tbl_producto_terminado_final`
  MODIFY `Id_Producto_Terminado_Final` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tbl_producto_terminado_mp`
--
ALTER TABLE `tbl_producto_terminado_mp`
  MODIFY `Id_Producto_Terminado_Mp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tbl_promociones`
--
ALTER TABLE `tbl_promociones`
  MODIFY `Id_Promocion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_promocion_producto`
--
ALTER TABLE `tbl_promocion_producto`
  MODIFY `Id_Promocion_Producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `Id_Proveedor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores_contacto`
--
ALTER TABLE `tbl_proveedores_contacto`
  MODIFY `Id_Proveedores_Contacto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_talonario`
--
ALTER TABLE `tbl_talonario`
  MODIFY `Id_Talonario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_contacto`
--
ALTER TABLE `tbl_tipo_contacto`
  MODIFY `Id_Tipo_Contacto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_movimiento`
--
ALTER TABLE `tbl_tipo_movimiento`
  MODIFY `Id_Tipo_Movimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_producto`
--
ALTER TABLE `tbl_tipo_producto`
  MODIFY `Id_Tipo_Producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  MODIFY `Id_Venta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tbl_ventas_descuento`
--
ALTER TABLE `tbl_ventas_descuento`
  MODIFY `Id_Ventas_Descuento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_ventas_promociones`
--
ALTER TABLE `tbl_ventas_promociones`
  MODIFY `Id_Venta_Promocion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_clientes_contacto`
--
ALTER TABLE `tbl_clientes_contacto`
  ADD CONSTRAINT `fk_TBL_CLIENTES_CONTACTO_TBL_CLIENTES1` FOREIGN KEY (`Id_Cliente`) REFERENCES `tbl_clientes` (`Id_Cliente`),
  ADD CONSTRAINT `fk_TBL_CLIENTES_CONTACTO_TBL_TIPO_CONTACTO1` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`);

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `fk_TBL_COMPRAS_TBL_PROVEEDORES1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `tbl_proveedores` (`Id_Proveedor`);

--
-- Filtros para la tabla `tbl_detalle_compra`
--
ALTER TABLE `tbl_detalle_compra`
  ADD CONSTRAINT `FK_Id_Compra_TBL_PROVEEDORES_TBL_COMPRAS` FOREIGN KEY (`Id_Compra`) REFERENCES `tbl_compras` (`Id_Compra`),
  ADD CONSTRAINT `fk_TBL_DETALLE_COMPRA_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`);

--
-- Filtros para la tabla `tbl_detalle_de_venta`
--
ALTER TABLE `tbl_detalle_de_venta`
  ADD CONSTRAINT `FK_Id_Producto_TBL_VENTAS_TBL_PRODUCTOS` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  ADD CONSTRAINT `FK_Id_Venta_TBL_PRODUCTOS_TBL_VENTAS` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`);

--
-- Filtros para la tabla `tbl_detalle_producto_comprado`
--
ALTER TABLE `tbl_detalle_producto_comprado`
  ADD CONSTRAINT `fk_TBL_DETALLE_PRODUCTO_COMPRADO_TBL_DETALLE_COMPRA1` FOREIGN KEY (`Id_Detalle_Compra`) REFERENCES `tbl_detalle_compra` (`Id_Detalle_Compra`);

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `FK_Id_Producto_TBL_INVENTARIO_TBL_PRODUCTOS` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`);

--
-- Filtros para la tabla `tbl_kardex`
--
ALTER TABLE `tbl_kardex`
  ADD CONSTRAINT `fk_TBL_KARDEX_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  ADD CONSTRAINT `fk_TBL_KARDEX_TBL_TIPO_MOVIMIENTO1` FOREIGN KEY (`Id_Tipo_Movimiento`) REFERENCES `tbl_tipo_movimiento` (`Id_Tipo_Movimiento`),
  ADD CONSTRAINT `tbl_kardex_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_ms_bitacora`
--
ALTER TABLE `tbl_ms_bitacora`
  ADD CONSTRAINT `FK_Id_Objeto_TBL_BITACORA_TBL_OBJETOS` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_objetos` (`Id_Objeto`),
  ADD CONSTRAINT `FK_Id_Usuario_TBL_MS_BITACORA_TBL_MS_USUARIOS` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`);

--
-- Filtros para la tabla `tbl_ms_hist_contraseña`
--
ALTER TABLE `tbl_ms_hist_contraseña`
  ADD CONSTRAINT `FK_Id_Usuario_TBL_MS_HIST_CONTRASEÑA_TBL_MS_USUARIOS` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`);

--
-- Filtros para la tabla `tbl_ms_preguntas_usuarios`
--
ALTER TABLE `tbl_ms_preguntas_usuarios`
  ADD CONSTRAINT `FK_Id_Pregunta_TBL_MS_USUARIOS_TBL_MS_PREGUNTAS` FOREIGN KEY (`Id_Pregunta`) REFERENCES `tbl_ms_preguntas` (`Id_Pregunta`),
  ADD CONSTRAINT `FK_Id_Usuario_TBL_MS_PREGUNTAS_TBL_MS_USUARIOS` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`);

--
-- Filtros para la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  ADD CONSTRAINT `FK_Id_Rol_TBL_MS_USUARIOS_TBL_MS_ROLES` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_roles` (`Id_Rol`),
  ADD CONSTRAINT `fk_TBL_MS_USUARIOS_TBL_CARGOS1` FOREIGN KEY (`Id_Cargo`) REFERENCES `tbl_cargos` (`Id_Cargo`);

--
-- Filtros para la tabla `tbl_permisos`
--
ALTER TABLE `tbl_permisos`
  ADD CONSTRAINT `FK_Id_Objeto_TBL_PERMISOS_TBL_OBJETOS` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_objetos` (`Id_Objeto`),
  ADD CONSTRAINT `FK_Id_Rol_TBL_PERMISOS_TBL_ROLES` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_roles` (`Id_Rol`);

--
-- Filtros para la tabla `tbl_proceso_produccion`
--
ALTER TABLE `tbl_proceso_produccion`
  ADD CONSTRAINT `fk_TBL_PROCESO_PRODUCCION_TBL_ESTADO_PROCESO1` FOREIGN KEY (`Id_Estado_Proceso`) REFERENCES `tbl_estado_proceso` (`Id_Estado_Proceso`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `fk_TBL_PRODUCTOS_TBL_TIPO_PRODUCTO1` FOREIGN KEY (`Id_Tipo_Producto`) REFERENCES `tbl_tipo_producto` (`Id_Tipo_Producto`);

--
-- Filtros para la tabla `tbl_producto_terminado_final`
--
ALTER TABLE `tbl_producto_terminado_final`
  ADD CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PROCESO_PRODUCCION1` FOREIGN KEY (`Id_Proceso_Produccion`) REFERENCES `tbl_proceso_produccion` (`Id_Proceso_Produccion`),
  ADD CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_FINAL_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`);

--
-- Filtros para la tabla `tbl_producto_terminado_mp`
--
ALTER TABLE `tbl_producto_terminado_mp`
  ADD CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PROCESO_PRODUCCION1` FOREIGN KEY (`Id_Proceso_Produccion`) REFERENCES `tbl_proceso_produccion` (`Id_Proceso_Produccion`),
  ADD CONSTRAINT `fk_TBL_PRODUCTO_TERMINADO_MP_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`);

--
-- Filtros para la tabla `tbl_promocion_producto`
--
ALTER TABLE `tbl_promocion_producto`
  ADD CONSTRAINT `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PRODUCTOS1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`),
  ADD CONSTRAINT `fk_TBL_PRODUCTOS_has_TBL_PROMOCIONES_TBL_PROMOCIONES1` FOREIGN KEY (`Id_Promocion`) REFERENCES `tbl_promociones` (`Id_Promocion`);

--
-- Filtros para la tabla `tbl_proveedores_contacto`
--
ALTER TABLE `tbl_proveedores_contacto`
  ADD CONSTRAINT `fk_PROVEEDORES_CONTACTO_TBL_PROVEEDORES1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `tbl_proveedores` (`Id_Proveedor`),
  ADD CONSTRAINT `fk_PROVEEDORES_CONTACTO_TBL_TIPO_CONTACTO1` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`);

--
-- Filtros para la tabla `tbl_talonario`
--
ALTER TABLE `tbl_talonario`
  ADD CONSTRAINT `fk_TBL_TALONARIO_TBL_MS_USUARIOS1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`);

--
-- Filtros para la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD CONSTRAINT `FK_Id_Cliente_TBL_VENTAS_TBL_CLIENTES` FOREIGN KEY (`Id_Cliente`) REFERENCES `tbl_clientes` (`Id_Cliente`),
  ADD CONSTRAINT `fk_TBL_VENTAS_TBL_ESTADO_VENTA1` FOREIGN KEY (`Id_Estado_Venta`) REFERENCES `tbl_estado_venta` (`Id_Estado_Venta`),
  ADD CONSTRAINT `fk_TBL_VENTAS_TBL_MS_USUARIOS1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`Id_Usuario`);

--
-- Filtros para la tabla `tbl_ventas_descuento`
--
ALTER TABLE `tbl_ventas_descuento`
  ADD CONSTRAINT `fk_TBL_VENTAS_DESCUENTO_TBL_DESCUENTOS1` FOREIGN KEY (`Id_Descuento`) REFERENCES `tbl_descuentos` (`Id_Descuento`),
  ADD CONSTRAINT `fk_TBL_VENTAS_DESCUENTO_TBL_VENTAS1` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`);

--
-- Filtros para la tabla `tbl_ventas_promociones`
--
ALTER TABLE `tbl_ventas_promociones`
  ADD CONSTRAINT `fk_TBL_VENTAS_PROMOCIONES_TBL_PROMOCIONES1` FOREIGN KEY (`Id_Promocion`) REFERENCES `tbl_promociones` (`Id_Promocion`),
  ADD CONSTRAINT `fk_TBL_VENTAS_PROMOCIONES_TBL_VENTAS1` FOREIGN KEY (`Id_Venta`) REFERENCES `tbl_ventas` (`Id_Venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
