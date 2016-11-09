-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2016 a las 10:22:44
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `personal` int(11) NOT NULL,
  `login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `created_at`, `updated_at`, `fecha`, `hora`, `personal`, `login`) VALUES
(1, '2016-11-09 09:04:35', '2016-11-09 09:04:35', '2016-11-09', '04:04:35', 10, 'facebook'),
(2, '2016-11-09 09:05:43', '2016-11-09 09:05:43', '2016-11-09', '04:05:43', 10, 'google');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `created_at`, `updated_at`, `nombres`, `apellidos`, `email`, `estado`) VALUES
(2, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'romulo', 'cartolin lucas', 'romulo_771@hotmail.com', 1),
(3, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'katherine vaneza', 'farfan sanchez', 'k_farfan28@hotmail.com', 1),
(4, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'Erika Melissa', 'Huamán Zúñiga', 'erika.gestion2@gmail.com', 1),
(5, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'geraldine milagros', 'Torres medina', 'mily_1293@hotmail.com', 1),
(6, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'german antonio', 'nicho marcos', 'jato000747@hotmail.com', 1),
(7, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'Leslie Danitza', 'Chavez Pachas', 'leslie_chavezpachas@hotmail.com', 1),
(8, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'Tayron Walter', 'Ibañez Borjas', 'tay21_14@hotmail.com', 1),
(9, '2016-11-09 03:23:29', '0000-00-00 00:00:00', 'Nieves Yesenia', 'LLacza Cerna', 'nllacza26@hotmail.com', 1),
(10, '2016-11-09 08:17:50', '0000-00-00 00:00:00', 'juan carlos', 'quintanilla', 'quintanilla.peru@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal` (`personal`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
