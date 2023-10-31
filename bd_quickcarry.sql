--- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<< HEAD
-- Tiempo de generación: 23-10-2023 a las 09:14:00
=======
-- Tiempo de generación: 17-10-2023 a las 06:40:37
>>>>>>> 7d0a31440c35cba4c0865310bee07bcd2599288b
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_quickcarry`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `calle` varchar(11) NOT NULL,
  `chapa` int(4) NOT NULL,
  `id_localidad_almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `calle`, `chapa`, `id_localidad_almacen`) VALUES
(1, 'a', 1111, 1),
(2, 'a', 1101, 3),
(3, 'd', 5555, 37),
(4, 'f', 7777, 30),
(5, 'e', 8896, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignado`
--

CREATE TABLE `asignado` (
  `id_almacen` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conduce`
--

CREATE TABLE `conduce` (
  `id_vheiculo` varchar(255) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre_departamento`) VALUES
(1, 'Artigas'),
(2, 'Canelones'),
(3, 'Cerro Largo'),
(4, 'Colonia'),
(5, 'Durazno'),
(6, 'Flores'),
(7, 'Florida'),
(8, 'Lavalleja'),
(9, 'Maldonado'),
(10, 'Montevideo'),
(11, 'Paysandú'),
(12, 'Río Negro'),
(13, ' Rivera'),
(14, ' Rocha'),
(15, ' Salto'),
(16, 'San José'),
(17, 'Soriano'),
(18, 'Tacuarembó'),
(19, 'Treinta y Tres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinado`
--

CREATE TABLE `destinado` (
  `id_ruta` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `matricula` varchar(12) NOT NULL,
  `fecha_de_entrega` datetime DEFAULT NULL,
  `fecha_transporte` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `CI` int(11) NOT NULL,
  `nro_telefono` int(11) DEFAULT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `email`, `nombre`, `apellido`, `CI`, `nro_telefono`, `cargo`) VALUES
(1, 'long65tyco@gmail.com', 'Jose', 'Maria', 54788621, 935577, 0),
(3, 'NatLong9905@gmail.com', 'Nataniel', 'Long', 1247789, 934455, 1),
(4, 'sam@long', 'Sam', 'Sam', 4365467, 934444, 2),
(9, 'camionero23@mail.com', 'Manuel', 'Martinez', 5446798, 945678, 2),
(10, 'almacenero23@mail.com', 'Thomas', 'Torres', 2345678, 999999, 1),
(11, 'almacenero23@crecom.com', 'Maria', 'Jose', 1256777, 999999, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id_localidad` int(11) NOT NULL,
  `nombre_localidad` varchar(255) NOT NULL,
  `id_dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id_localidad`, `nombre_localidad`, `id_dep`) VALUES
(1, 'Centro', 10),
(2, 'Union', 10),
(3, 'Colonia del sacramento', 4),
(22, 'Artigas', 1),
(23, 'Canelones', 2),
(24, 'Melo', 3),
(25, 'Durazno', 5),
(26, 'Trinidad', 6),
(27, 'Florida', 7),
(28, 'Minas', 8),
(29, 'Maldonado', 9),
(30, 'Paysandú', 11),
(31, 'Fray Bentos', 12),
(32, 'Rivera', 13),
(33, 'Rocha', 14),
(34, 'Salto', 15),
(35, 'San José de Mayo', 16),
(36, 'Mercedes', 17),
(37, 'Tacuarembó', 18),
(38, 'Treinta y Tres', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `email` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`email`, `password`) VALUES
('almacenero23@crecom.com', '$2y$10$./5O8MeFqn0OVgY3S2J0oeMGhdD4JwRp6VGAV/ZT37zrfVMP7Eldq'),
('almacenero23@mail.com', '$2y$10$./5O8MeFqn0OVgY3S2J0oeMGhdD4JwRp6VGAV/ZT37zrfVMP7Eldq'),
('camionero23@mail.com', '$2y$10$./5O8MeFqn0OVgY3S2J0oeMGhdD4JwRp6VGAV/ZT37zrfVMP7Eldq'),
('long65tyco@gmail.com', '$2y$10$7PArTXWqqSIw/XU7cpm6OuQsRUrphZ9Ix2nPG9FOcfe6ip96hqAkC'),
('NatLong9905@gmail.com', 'Nana45'),
('sam@long', 'TT45OP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `lote_crecom` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `fecha_creacion`, `fecha_de_entrega`, `fecha_transporte`, `id_almacen`, `matricula_camion`, `id_destino`) VALUES
(4, '2023-09-17', NULL, NULL, 1, NULL, 1),
(10, '2023-10-12', NULL, NULL, NULL, NULL, 1);

>>>>>>> 7d0a31440c35cba4c0865310bee07bcd2599288b
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `nombre_paquete` varchar(255) NOT NULL,
  `dimenciones` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `fragil` int(11) DEFAULT NULL,
  `destino_calle` varchar(64) NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fecha_recibido` date DEFAULT NULL,
  `fecha_cargado` date DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `id_lote_portador` int(11) DEFAULT NULL,
  `id_localidad_destino` int(11) NOT NULL,
  `matricula_transporte` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `nombre_paquete`, `dimenciones`, `peso`, `fragil`, `destino_calle`, `fecha_entrega`, `fecha_recibido`, `fecha_cargado`, `fecha_ingreso`, `id_lote_portador`, `id_localidad_destino`, `matricula_transporte`) VALUES
<<<<<<< HEAD
(1, 'Botella de vino', 20, 200, 1, 'Reno 1444', NULL, NULL, NULL, '2023-10-23', 0, 33, NULL);
=======
(3, '', 500, 500, 1, '8 de octubre 2340', NULL, '2023-09-17', NULL, '2023-09-09', 4, 2, 'STL569'),
(4, '', 800, 200, 1, '', '2023-09-09', NULL, NULL, '2023-09-09', NULL, 1, 'STP1986'),
(5, 'Pistones', 15, 100, 0, 'AguaFria 1789', NULL, '2023-09-09', NULL, '2023-09-08', 4, 2, NULL),
(6, 'GA', 66, 66, 1, 'Flecha 2569', NULL, NULL, NULL, '2023-09-09', 4, 2, NULL),
(7, 'pack de vasos ', 700, 1000, 1, 'Pje. Dr. Francisco Schinca 2540', NULL, NULL, NULL, '2023-09-08', 4, 2, NULL),
(8, 'botellas', 700, 500, 1, '', NULL, NULL, NULL, '2023-09-10', 10, 2, NULL),
(9, 'Agua', 50, 50, 0, 'Aduana 2156', NULL, NULL, NULL, '2023-09-17', 10, 1, NULL);
>>>>>>> 7d0a31440c35cba4c0865310bee07bcd2599288b

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id_ruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id_ruta`) VALUES
(0),
(1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ruta` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `posicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ruta`, `id_almacen`, `posicion`) VALUES
(0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(12) NOT NULL,
  `estado` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `almacen_ibfk_1` (`id_localidad_almacen`);

--
-- Indices de la tabla `asignado`
--
ALTER TABLE `asignado`
  ADD PRIMARY KEY (`id_almacen`,`id_empleado`),
  ADD KEY `asignado_ibfk_2` (`id_empleado`);

--
-- Indices de la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD PRIMARY KEY (`id_vheiculo`,`id_empleado`),
  ADD KEY `conduce_ibfk_2` (`id_empleado`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `destinado`
--
ALTER TABLE `destinado`
  ADD PRIMARY KEY (`id_almacen`,`id_ruta`,`id_lote`) USING BTREE,
  ADD KEY `fk_lote` (`id_lote`),
  ADD KEY `fk_vehiculo` (`matricula`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_lote_portador` (`id_lote_portador`),
  ADD KEY `id_localidad_destino` (`id_localidad_destino`),
  ADD KEY `matricula_transporte` (`matricula_transporte`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_almacen`,`id_ruta`),
  ADD KEY `ubicacion_ibfk_1` (`id_ruta`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
<<<<<<< HEAD
=======
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
>>>>>>> 7d0a31440c35cba4c0865310bee07bcd2599288b
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
<<<<<<< HEAD
=======

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
>>>>>>> 7d0a31440c35cba4c0865310bee07bcd2599288b

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`id_localidad_almacen`) REFERENCES `localidad` (`id_localidad`);

--
-- Filtros para la tabla `asignado`
--
ALTER TABLE `asignado`
  ADD CONSTRAINT `asignado_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`),
  ADD CONSTRAINT `asignado_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `conduce`
--
ALTER TABLE `conduce`
  ADD CONSTRAINT `conduce_ibfk_1` FOREIGN KEY (`id_vheiculo`) REFERENCES `vehiculo` (`matricula`),
  ADD CONSTRAINT `conduce_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `destinado`
--
ALTER TABLE `destinado`
  ADD CONSTRAINT `fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`id_almacen`,`id_ruta`) REFERENCES `ubicacion` (`id_almacen`, `id_ruta`),
  ADD CONSTRAINT `fk_vehiculo` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `ubicacion_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`),
  ADD CONSTRAINT `ubicacion_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
