SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `calle` varchar(200) NOT NULL,
  `chapa` int(4) NOT NULL,
  `id_localidad_almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `localidad` (
  `id_localidad` int(11) NOT NULL,
  `nombre_localidad` varchar(255) NOT NULL,
  `id_dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `asignado` (
  `id_almacen` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `conduce` (
  `id_matricula` varchar(7) NOT NULL,
  `id_empleado` int(11) NOT NULL,
CONSTRAINT `checkMatriculaConduce` CHECK (substring(`id_matricula`,1,1) REGEXP '^[A-S]{1}$'
AND substring(`id_matricula`,2,2) REGEXP '^[A-X]{2}$'
AND substring(`id_matricula`,4,4) REGEXP '^[0-9]{4}$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `destinado` (
  `id_ruta` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `matricula` varchar(7) DEFAULT NULL,
  `fecha_de_entrega` datetime DEFAULT NULL,
  `fecha_transporte` datetime DEFAULT NULL,
CONSTRAINT `checkMatriculaDestinado` CHECK (substring(`matricula`,1,1) REGEXP '^[A-S]{1}$'
AND substring(`matricula`,2,1) REGEXP '^[T]{1}$'
AND substring(`matricula`,3,1) REGEXP '^[P]{1}$'                                          
AND substring(`matricula`,4,4) REGEXP '^[0-9]{4}$'),
CONSTRAINT `checkFechaEntregaLote` CHECK (`fecha_de_entrega`>=`fecha_transporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `CI` int(11) NOT NULL,
  `nro_telefono` int(11) DEFAULT NULL,
  `cargo` int(11) NOT NULL
  ,
    CONSTRAINT `correoEmp` check(`email` REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `login` (
  `email` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
    
    CONSTRAINT `correoLog` check(`email` REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `lote_crecom` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  `matricula_transporte` varchar(7) DEFAULT NULL,
CONSTRAINT `checkMatriculaTransporte` CHECK (substring(`matricula_transporte`,1,1) REGEXP '^[A-S]{1}$'
AND substring(`matricula_transporte`,2,1) REGEXP '^[T]{1}$'
AND substring(`matricula_transporte`,3,1) REGEXP '^[L,M]{1}$'                                          
AND substring(`matricula_transporte`,4,4) REGEXP '^[0-9]{4}$'),
CONSTRAINT `checkFechas` CHECK (`fecha_entrega`>=`fecha_cargado`>=`fecha_recibido`>=`fecha_ingreso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `ruta` (
  `id_ruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `ubicacion` (
  `id_ruta` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `posicion` int(11) NOT NULL,
  `tempo_trecho` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `vehiculo` (
  `matricula` varchar(7) NOT NULL,
  `estado` int(11) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `peso_maximo` int(50) NOT NULL,
CONSTRAINT `checkMatriculaVehiculos` CHECK (substring(`matricula`,1,1) REGEXP '^[A-S]{1}$'
AND substring(`matricula`,2,2) REGEXP '^[A-X]{2}$'
AND substring(`matricula`,4,4) REGEXP '^[0-9]{4}$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `almacen_ibfk_1` (`id_localidad_almacen`);


ALTER TABLE `asignado`
  ADD PRIMARY KEY (`id_almacen`,`id_empleado`),
  ADD KEY `asignado_ibfk_2` (`id_empleado`);

ALTER TABLE `conduce`
  ADD PRIMARY KEY (`id_matricula`,`id_empleado`),
  ADD KEY `conduce_ibfk_2` (`id_empleado`);

ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

ALTER TABLE `destinado`
  ADD PRIMARY KEY (`id_almacen`,`id_ruta`,`id_lote`) USING BTREE,
  ADD KEY `fk_lote` (`id_lote`),
  ADD KEY `fk_vehiculo` (`matricula`);

ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`);

ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_lote_portador` (`id_lote_portador`),
  ADD KEY `id_localidad_destino` (`id_localidad_destino`),
  ADD KEY `matricula_transporte` (`matricula_transporte`);


ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`);


ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_almacen`,`id_ruta`),
  ADD KEY `ubicacion_ibfk_1` (`id_ruta`);

ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);


ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;


ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`id_localidad_almacen`) REFERENCES `localidad` (`id_localidad`);

ALTER TABLE `asignado`
  ADD CONSTRAINT `asignado_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`),
  ADD CONSTRAINT `asignado_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

ALTER TABLE `conduce`
  ADD CONSTRAINT `conduce_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `vehiculo` (`matricula`),
  ADD CONSTRAINT `conduce_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

ALTER TABLE `destinado`
  ADD CONSTRAINT `fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`id_almacen`,`id_ruta`) REFERENCES `ubicacion` (`id_almacen`, `id_ruta`),
  ADD CONSTRAINT `fk_vehiculo` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

ALTER TABLE `ubicacion`
  ADD CONSTRAINT `ubicacion_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`),
  ADD CONSTRAINT `ubicacion_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);
COMMIT;