-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2020 a las 00:46:46
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segundoparcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `cupo` int(11) NOT NULL,
  `crate_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `cuatrimestre`, `cupo`, `crate_at`, `update_at`) VALUES
(1, 'p3', 3, 0, '2020-11-16 23:04:31', '2020-11-16 23:04:31'),
(2, 'p2', 4, 20, '2020-11-16 23:06:50', '2020-11-16 23:06:50'),
(3, 'lab', 4, 20, '2020-11-16 23:40:36', '2020-11-16 23:40:36'),
(4, 'spd', 4, 20, '2020-11-16 23:40:43', '2020-11-16 23:40:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'profesor'),
(2, 'alumno'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `crate_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `clave`, `tipo`, `crate_at`, `update_at`) VALUES
(1, 'pepe', 'pepe@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 21:59:47', '2020-11-16 21:59:47'),
(2, 'pepe', 'pepe2@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 22:01:00', '2020-11-16 22:01:00'),
(3, 'pepe', 'pepe3@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 22:02:04', '2020-11-16 22:02:04'),
(4, 'pepe', 'pepe5@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 22:09:18', '2020-11-16 22:09:18'),
(5, 'pepe', 'pepe8@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 22:09:36', '2020-11-16 22:09:36'),
(6, 'pepe2', 'pepe9@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 22:12:30', '2020-11-16 22:12:30'),
(7, 'pepe22', 'pepe98@mail.com', '&,3(S-#4V\n`', 0, '2020-11-16 22:12:53', '2020-11-16 22:12:53'),
(8, 'pepe228', 'pepe988@mail.com', '$,3(S-```\n`', 0, '2020-11-16 22:20:08', '2020-11-16 22:20:08'),
(9, 'pert', 'pepe9788@mail.com', '$,3(s-```\n`', 0, '2020-11-16 22:27:25', '2020-11-16 22:27:25'),
(10, 'admin', 'admin@mail.com', '$,3(S-```\n`', 0, '2020-11-16 22:44:59', '2020-11-16 22:44:59'),
(11, 'admin1', 'admin1@mail.com', '%,3(S-#4`\n`', 0, '2020-11-16 22:47:18', '2020-11-16 22:47:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
