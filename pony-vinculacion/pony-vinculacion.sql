-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2023 a las 04:07:49
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pony-vinculacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `no_control` int(8) NOT NULL,
  `correo_institucional` varchar(255) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_paterno` varchar(30) NOT NULL,
  `apellido_materno` varchar(30) NOT NULL,
  `linkedin` varchar(256) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `foto_perfil` blob DEFAULT NULL,
  `hash` longtext NOT NULL,
  `curriculum` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `acronimo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `folio` int(11) NOT NULL,
  `rfc` varchar(18) NOT NULL,
  `nombre_comercial` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `tipo_empresa` varchar(30) NOT NULL,
  `sector` varchar(30) NOT NULL,
  `giro` varchar(30) NOT NULL,
  `numero_empleados` int(10) NOT NULL,
  `direccion_empresa` varchar(100) NOT NULL,
  `descripcion_empresa` varchar(100) NOT NULL,
  `sitio_web` varchar(100) NOT NULL,
  `nombre_encargado` varchar(100) NOT NULL,
  `puesto_encargado` varchar(100) NOT NULL,
  `telefono_empresa` int(10) NOT NULL,
  `correo_empresa` varchar(255) NOT NULL,
  `logo_empresa` longblob DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `imagen` longblob DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacante`
--

CREATE TABLE `vacante` (
  `id_vacante` int(11) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha_cierre` date NOT NULL,
  `datos_contacto` mediumtext NOT NULL,
  `categoria` varchar(256) NOT NULL,
  `carreras` text NOT NULL,
  `servicio_social` tinyint(1) NOT NULL,
  `practicas_profesionales` tinyint(1) NOT NULL,
  `vacante_laboral` tinyint(1) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `aceptada` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculacion`
--

CREATE TABLE `vinculacion` (
  `correo_institucional` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido_paterno` text NOT NULL,
  `apellido_materno` text NOT NULL,
  `puesto` text NOT NULL,
  `foto_perfil` longblob DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `telefono` text NOT NULL,
  `hash` text NOT NULL,
  `carrera` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`no_control`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`folio`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacante`
--
ALTER TABLE `vacante`
  ADD PRIMARY KEY (`id_vacante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacante`
--
ALTER TABLE `vacante`
  MODIFY `id_vacante` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
