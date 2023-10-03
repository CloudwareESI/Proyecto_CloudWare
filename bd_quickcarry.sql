
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `calle` varchar(11) NOT NULL,
  `chapa` int(4) NOT NULL,
  `id_localidad_almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `almacen` (`id_almacen`, `calle`, `chapa`, `id_localidad_almacen`) VALUES
(1, 'a', 1111, 1),
(2, 'a', 1101, 3);

CREATE TABLE `asignado` (
  `id_almacen` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `conduce` (
  `id_vheiculo` varchar(255) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `CI` int(11) NOT NULL,
  `nro_telefono` int(11) DEFAULT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `empleado` (`id_empleado`, `email`, `nombre`, `apellido`, `CI`, `nro_telefono`, `cargo`) VALUES
(1, 'long65tyco@gmail.com', 'Jose', 'Maria', 54788621, 935577, 0),
(3, 'NatLong9905@gmail.com', 'Nataniel', 'Long', 1247789, 934455, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id_localidad` int(11) NOT NULL,
  `nombre_localidad` varchar(255) NOT NULL,
  `id_dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `localidad` (`id_localidad`, `nombre_localidad`, `id_dep`) VALUES
(1, 'Centro', 10),
(2, 'Union', 10),
(3, 'Colonia del sacramento', 4);

CREATE TABLE `login` (
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `login` (`email`, `password`) VALUES
('long65tyco@gmail.com', 'Loooong'),
('NatLong9905@gmail.com', 'Nana45');

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_de_entrega` date DEFAULT NULL,
  `fecha_transporte` date DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `matricula_camion` varchar(12) DEFAULT NULL,
  `id_destino` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `fecha_creacion`, `fecha_de_entrega`, `fecha_transporte`, `id_almacen`, `matricula_camion`, `id_destino`) VALUES
(2, '2023-09-10', NULL, NULL, 1, NULL, 2),
(3, '2023-09-11', NULL, NULL, NULL, NULL, 2);

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `nombre_paquete` varchar(255) NOT NULL,
  `dimenciones` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `fragil` int(11) DEFAULT NULL,
  `destino_calle` varchar(16) NOT NULL,
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
(3, '', 500, 500, 1, '8 de octubre y 2', NULL, '2023-09-09', NULL, '2023-09-09', NULL, 2, 'STL569'),
(4, '', 800, 200, 1, 'a', NULL, '2023-09-09', NULL, '2023-09-09', NULL, 1, 'STP1986'),
(5, 'Pistones', 15, 100, 0, 'agua fria', NULL, '2023-09-09', NULL, '2023-09-08', 3, 2, NULL),
(6, 'GA', 66, 66, 1, '-', NULL, NULL, NULL, '2023-09-09', NULL, 2, NULL),
(7, 'pack de vasos ', 700, 1000, 1, '-', NULL, NULL, NULL, '2023-09-08', 3, 2, NULL),
(8, 'botellas', 700, 500, 135, '', NULL, NULL, NULL, '2023-09-10', 2, 2, NULL);

CREATE TABLE `ruta` (
  `id_ruta` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sigue`
--

CREATE TABLE `sigue` (
  `id_ruta` int(11) NOT NULL,
  `id_camion` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ubicacion` (
  `id_ruta` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `posicion` int(11) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `vehiculo` (
  `matricula` varchar(12) NOT NULL,
  `estado` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `id_parada` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vehiculo` (`matricula`, `estado`, `modelo`, `rol`) VALUES
('STL569', 1, 'Camioneta', 2),
('STP1986', 1, 'Camión pesado', 1);

ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `id_localidad_almacen` (`id_localidad_almacen`);

ALTER TABLE `asignado`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `id_empleado` (`id_empleado`);

ALTER TABLE `conduce`
  ADD PRIMARY KEY (`id_vheiculo`),
  ADD KEY `id_empleado` (`id_empleado`);


ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);


ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`),
  ADD KEY `id_dep` (`id_dep`);

ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_almacen` (`id_almacen`),
  ADD KEY `matricula_camion` (`matricula_camion`),
  ADD KEY `id_destino` (`id_destino`);

ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_lote_portador` (`id_lote_portador`),
  ADD KEY `id_localidad_destino` (`id_localidad_destino`),
  ADD KEY `matricula_transporte` (`matricula_transporte`);

ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`);

ALTER TABLE `sigue`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `id_camion` (`id_camion`);

ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_ruta`,`id_almacen`),
  ADD KEY `id_almacen` (`id_almacen`);

ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_parada` (`id_parada`);

ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `ruta`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`id_localidad_almacen`) REFERENCES `localidad` (`id_localidad`);

ALTER TABLE `vehiculo`
ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`id_parada`) REFERENCES `almacen` (`id_almacen`);
  
ALTER TABLE `asignado`
  ADD CONSTRAINT `asignado_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`),
  ADD CONSTRAINT `asignado_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

ALTER TABLE `conduce`
  ADD CONSTRAINT `conduce_ibfk_1` FOREIGN KEY (`id_vheiculo`) REFERENCES `vehiculo` (`matricula`),
  ADD CONSTRAINT `conduce_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_ibfk_1` FOREIGN KEY (`id_dep`) REFERENCES `departamento` (`id_departamento`);

ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`),
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`matricula_camion`) REFERENCES `vehiculo` (`matricula`),
  ADD CONSTRAINT `lote_ibfk_3` FOREIGN KEY (`id_destino`) REFERENCES `localidad` (`id_localidad`);

ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`id_lote_portador`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`id_localidad_destino`) REFERENCES `localidad` (`id_localidad`),
  ADD CONSTRAINT `paquete_ibfk_3` FOREIGN KEY (`matricula_transporte`) REFERENCES `vehiculo` (`matricula`);

ALTER TABLE `sigue`
  ADD CONSTRAINT `sigue_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`),
  ADD CONSTRAINT `sigue_ibfk_2` FOREIGN KEY (`id_camion`) REFERENCES `vehiculo` (`matricula`);

ALTER TABLE `ubicacion`
  ADD CONSTRAINT `ubicacion_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`),
  ADD CONSTRAINT `ubicacion_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);
COMMIT;