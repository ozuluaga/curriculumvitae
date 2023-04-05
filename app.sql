-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-04-2023 a las 02:54:20
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleados`
--

CREATE TABLE `tbl_empleados` (
  `id` int(11) NOT NULL,
  `primer_nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `segundo_nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `primer_apellido` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_puesto` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_empleados`
--

INSERT INTO `tbl_empleados` (`id`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `foto`, `cv`, `id_puesto`, `fecha_ingreso`) VALUES
(1, 'Olvedo', 'De Jesus', 'Zuluaga', 'Ramirez', 'foto.jpg', 'cd.pdf', 1, '2023-04-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_puestos`
--

CREATE TABLE `tbl_puestos` (
  `id` int(11) NOT NULL,
  `nombre_puesto` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_puestos`
--

INSERT INTO `tbl_puestos` (`id`, `nombre_puesto`) VALUES
(1, 'Programador Jr.'),
(2, 'Programador Sr.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `passwor` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `usuario`, `passwor`, `correo`) VALUES
(1, 'olvedo', '123', 'olvedo@olvedo.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_puesto` (`id_puesto`);

--
-- Indices de la tabla `tbl_puestos`
--
ALTER TABLE `tbl_puestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_puestos`
--
ALTER TABLE `tbl_puestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  ADD CONSTRAINT `tbl_empleados_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `tbl_puestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
