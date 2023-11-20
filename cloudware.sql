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


INSERT INTO `empleado` (`id_empleado`, `email`, `nombre`, `apellido`, `CI`, `nro_telefono`, `cargo`) VALUES
(1, 'long65tyco@gmail.com', 'Jose', 'Maria', 54788671, 9932571, 0),
(3, 'NatLong9905@gmail.com', 'Nataniel', 'Rojas', 1247789, 934455, 1),
(9, 'camionero23@mail.com', 'Manuel', 'Martinez', 5446798, 945678, 2),
(10, 'almacenero23@mail.com', 'Thomas', 'Torres', 2345678, 999999, 1),
(11, 'almacenero23@crecom.com', 'Maria', 'Jose', 1256777, 999999, 4);

INSERT INTO `vehiculo` (`matricula`, `estado`, `modelo`, `rol`, `peso_maximo`) VALUES
('ATP1982', 0, 'Citroen', 1, 15000),
('STL5691', 0, 'Camioneta', 2, 2000),
('STP1986', 1, 'Camión pesado', 1, 15000);

INSERT INTO `login` (`email`, `password`) VALUES
('long65tyco@gmail.com', '$2y$10$7PArTXWqqSIw/XU7cpm6OuQsRUrphZ9Ix2nPG9FOcfe6ip96hqAkC'),
('almacenero23@crecom.com', '$2y$10$USNexGc.aBx2Lob3Ncq6OONat713EHpyEdYuKU002eTwHeM39FdEK'),
('almacenero23@mail.com', '$2y$10$IR3OD.sqbFn4ocNYFr/nDO.Z1Mn67F1tGWK9yQTsAESZZNTtI.E4S'),
('camionero23@mail.com', '$2y$10$kkpXVU8z/od8kq4cfcOW7OYbsPS.C13BS/cZSVzq5TRcYcrcx/OKa'),
('NatLong9905@gmail.com', '$2y$10$eMMkqvNofKkbiawtZxQEqum8Lb8fLZdd4ek85X8BQYmx0i3rCazDa');

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

INSERT INTO `almacen` (`id_almacen`, `calle`, `chapa`, `id_localidad_almacen`) VALUES
(1, 'Bulevar General Artigas', 1825, 1),
(2, 'Domingo Baqué', 465, 3),
(3, 'Doctor Domingo Catalina', 130, 37),
(4, 'Bulevar General Artigas', 770, 30),
(5, 'Wilson Ferreira Aldunate', 340, 22);

INSERT INTO `ruta` (`id_ruta`) VALUES
(0),
(1),
(2),
(3);

INSERT INTO `ubicacion` (`id_ruta`, `id_almacen`, `posicion`, `tempo_trecho`) VALUES
(0, 1, 0, NULL),
(1, 1, 0, NULL),
(2, 1, 0, '00:00:00'),
(3, 1, 0, '00:00:00'),
(2, 2, 1, '01:25:00'),
(1, 3, 1, NULL),
(2, 3, 2, '01:25:00'),
(2, 4, 3, '01:25:00'),
(3, 4, 1, '04:00:00'),
(1, 5, 3, NULL),
(3, 5, 2, '02:00:00');

INSERT INTO `lote` (`id_lote`, `fecha_creacion`, `lote_crecom`) VALUES
(7, '2023-11-02 09:01:41', 1),
(18, '2023-11-15 07:20:04', 1),
(20, '2023-11-15 09:50:10', 1),
(21, '2023-11-15 14:50:54', 0),
(22, '2023-11-15 11:03:20', 1),
(23, '2023-11-15 11:06:17', 0),
(24, '2023-11-15 11:26:47', 0);

INSERT INTO `destinado` (`id_ruta`, `id_almacen`, `id_lote`, `matricula`, `fecha_de_entrega`, `fecha_transporte`) VALUES
(0, 1, 7, 'STP1986', '2023-11-02 23:33:12', '2023-11-02 13:15:22'),
(0, 1, 18, 'ATP1982', '2023-11-15 15:04:49', '2023-11-15 13:08:12'),
(0, 1, 20, 'ATP1982', '2023-11-15 15:04:49', '2023-11-15 13:50:41'),
(0, 1, 22, 'ATP1982', '2023-11-15 15:04:49', '2023-11-15 15:03:26'),
(0, 1, 23, 'ATP1982', '2023-11-15 15:23:51', '2023-11-15 15:23:06'),
(2, 2, 24, 'ATP1982', '2023-11-15 15:31:00', '2023-11-15 15:29:20');

INSERT INTO `paquete` (`id_paquete`, `nombre_paquete`, `dimenciones`, `peso`, `fragil`, `destino_calle`, `fecha_entrega`, `fecha_recibido`, `fecha_cargado`, `fecha_ingreso`, `id_lote_portador`, `id_localidad_destino`, `matricula_transporte`) VALUES
(4, 'Agua', 220, 250, 0, 'Schinca 2540', NULL, NULL, NULL, '2023-11-02', 7, 2, NULL),
(5, 'Trampolin', 800, 12000, 0, 'Salto 1234', NULL, NULL, NULL, '2023-11-02', 8, 34, NULL),
(6, 'Casco de moto', 550, 1000, 0, 'Schinca 2540', NULL, NULL, NULL, '2023-11-05', NULL, 2, NULL),
(7, 'Jarrones chinos', 400, 4000, 1, 'Rivera 3674 Montevideo', NULL, NULL, NULL, '2023-11-14', NULL, 1, NULL),
(8, 'Set de ajedrez', 200, 400, 1, '', NULL, NULL, '0000-00-00', '0000-00-00', NULL, 0, NULL),
(9, 'Botella de vino fino', 280, 300, 1, 'Rivera 3674', NULL, NULL, NULL, '2023-11-14', NULL, 1, NULL),
(10, 'Pelota de football', 300, 420, 0, 'Rivera 3674', NULL, NULL, NULL, '2023-11-14', NULL, 1, NULL),
(11, 'Pelota de golf', 150, 200, 0, 'Schinca 2540', NULL, NULL, NULL, '2023-11-14', NULL, 2, NULL),
(12, 'Litro Agua tonica', 500, 1000, 1, 'Schinca 2540', NULL, NULL, NULL, '2023-11-14', NULL, 2, NULL),
(13, 'Bate de beisbol', 200, 200, 0, 'Schinca 2540', NULL, NULL, NULL, '2023-11-14', NULL, 2, NULL);




INSERT INTO `asignado` (`id_almacen`, `id_empleado`) VALUES
(1, 3),
(1, 10),
(2, 10),
(3, 3),
(3, 10),
(4, 3),
(4, 10),
(5, 3),
(5, 10);

INSERT INTO `conduce` (`id_matricula`, `id_empleado`) VALUES
('ATP1982', 9),
('STL5691', 9),
('STP1986', 9);


CREATE USER 'almacenero_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.paquete TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.lote TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.destinado TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.almacen TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.asignado TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.empleado TO 'almacenero_quickcarry_cw'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'empaquetador_crecom_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.paquete TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.lote TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.destinado TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON cloudware.almacen TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON cloudware.empleado TO 'empaquetador_crecom_cw'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'externo_seguimiento_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT ON cloudware.paquete TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.lote TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.destinado TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.almacen TO 'externo_seguimiento_cw'@'localhost'; 
FLUSH PRIVILEGES;


CREATE USER 'camionero_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE ON cloudware.paquete TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.destinado TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.vehiculo TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.lote TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.ubicacion TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'camionero_quickcarry_cw'@'localhost';
GRANT SELECT ON cloudware.almacen TO 'camionero_quickcarry_cw'@'localhost';  
GRANT SELECT ON cloudware.empleado TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.conduce TO 'camionero_quickcarry_cw'@'localhost'; 
FLUSH PRIVILEGES;