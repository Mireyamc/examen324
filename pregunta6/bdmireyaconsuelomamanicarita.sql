-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2024 a las 22:07:50
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdmireyaconsuelomamanicarita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `saldo` int(255) NOT NULL DEFAULT 0,
  `fecha_cre` datetime NOT NULL,
  `id_us` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `tipo`, `saldo`, `fecha_cre`, `id_us`, `activo`) VALUES
(1, 'ahorro', 1200, '2024-04-16 17:06:00', 1, 1),
(2, 'ahorro', 500, '2024-04-16 21:43:00', 1, 0),
(5, 'ahorro', 0, '2024-04-16 22:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `fecha_h` datetime NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id`, `id_cuenta`, `id_us`, `fecha_h`, `tipo`, `monto`) VALUES
(1, 1, 1, '2024-04-16 23:05:00', 'deposito', 500),
(3, 1, 1, '2024-04-16 23:08:00', 'deposito', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(1000) NOT NULL,
  `tipo_us` varchar(255) NOT NULL DEFAULT 'cliente',
  `ci` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `telefono` int(11) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `depto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `tipo_us`, `ci`, `fecha`, `telefono`, `pwd`, `depto`) VALUES
(1, 'Camila Flores Pinto', 'cliente', '7685855 LP', '1996-12-03', 78899765, '12345', 'LP'),
(2, 'Layla Calle Ayaviri', 'cliente', '7865675 LP', '2000-02-09', 78987678, '54321', 'LP'),
(3, 'Alan Rivera Choque', 'administrador', '5764768 LP', '2000-04-16', 77788877, '12345', 'SC'),
(4, 'Pablo Mendoza Apaza', 'cliente', '7545678 LP', '1999-05-15', 77887788, '12345', 'PT'),
(5, 'Maria torres ayala', 'cliente', '4859483 LP', '1990-12-05', 67468867, '12345', 'SC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id_us_cuenta` (`id_us`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuenta_id_cuenta_transaccion` (`id_cuenta`),
  ADD KEY `usuario_id_us_` (`id_us`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `usuario_id_us_cuenta` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `cuenta_id_cuenta_transaccion` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id`),
  ADD CONSTRAINT `usuario_id_us_` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
