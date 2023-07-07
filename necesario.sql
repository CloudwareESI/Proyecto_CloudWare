-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2023 a las 05:38:48
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
-- Base de datos: `php`
--
CREATE DATABASE IF NOT EXISTS `php` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `direccion` varchar(64) NOT NULL,
  `ciudad` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `direccion`, `ciudad`) VALUES
(1, '8 de octubre y comercio ', 'montevideo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `nombre_lote` varchar(32) NOT NULL,
  `peso` decimal(16,0) NOT NULL COMMENT 'kg',
  `dimensiones` int(8) NOT NULL COMMENT 'cm2',
  `almacen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `nombre_lote`, `peso`, `dimensiones`, `almacen_id`) VALUES
(1, 'carrito_juancho', 2, 25, 1),
(4, 'caramelos_extranjeros', 1, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `empleado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `password`, `email`, `empleado`) VALUES
(2, 'Lucas', 'Caballero', 'NiceNiceNice', 'lucas.kaballero.19@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `fk_almacen_id` (`almacen_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `fk_almacen_id` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id_almacen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
