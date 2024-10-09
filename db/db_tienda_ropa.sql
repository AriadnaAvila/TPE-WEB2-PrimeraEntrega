-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 19:06:43
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
-- Base de datos: `db_tienda_ropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(11, 'Buzos'),
(12, 'Remeras'),
(13, 'Camperas'),
(14, 'Pantalones'),
(15, 'Accesorios'),
(16, 'Zapatillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `id_informacion` int(11) NOT NULL,
  `talle` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`id_informacion`, `talle`, `color`, `stock`, `id_producto`) VALUES
(1, 'L', 'Negro', 34, 1),
(2, '44', 'Verde', 42, 2),
(3, 'M', 'Azul', 20, 1),
(4, 'L', 'Negro', 15, 2),
(5, 'XL', 'Gris', 10, 3),
(6, 'M', 'Rojo', 25, 4),
(7, 'S', 'Verde', 30, 5),
(8, 'M', 'Blanco', 18, 6),
(9, 'L', 'Azul claro', 12, 7),
(10, 'S', 'Amarillo', 22, 8),
(11, 'M', 'Verde oscuro', 16, 9),
(12, 'L', 'Rosa', 14, 10),
(13, '32', 'Indigo', 20, 11),
(14, '34', 'Caqui', 12, 12),
(15, '36', 'Negro', 10, 13),
(16, '38', 'Gris claro', 15, 14),
(17, '40', 'Verde militar', 20, 15),
(18, 'M', 'Marrón', 25, 16),
(19, 'M', 'Negro', 18, 17),
(20, 'L', 'Azul', 22, 18),
(21, 'L', 'Verde', 14, 19),
(22, 'M', 'Naranja', 20, 20),
(23, 'S', 'Gris', 30, 21),
(24, 'M', 'Rojo', 25, 22),
(25, 'M', 'Negro', 15, 23),
(26, '38', 'Beige', 10, 24),
(27, '36', 'Verde claro', 12, 25),
(28, '34', 'Azul oscuro', 18, 26),
(29, '32', 'Gris claro', 16, 27),
(30, '40', 'Rojo', 20, 28),
(31, '42', 'Verde oscuro', 14, 29),
(32, '44', 'Negro', 22, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `precio` int(12) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `tipo`, `precio`, `id_categoria`) VALUES
(1, 'Buzo oversize estampado', 45999, 11),
(2, 'Pantalon cargo gabardina', 39500, 14),
(3, 'Buzo de algodón', 44999, 11),
(4, 'Buzo con capucha', 52499, 11),
(5, 'Buzo oversize', 59999, 11),
(6, 'Buzo de rayas', 49499, 11),
(7, 'Buzo estampado', 56999, 11),
(8, 'Remera básica', 29999, 12),
(9, 'Remera de manga corta', 37499, 12),
(10, 'Remera de manga larga', 40499, 12),
(11, 'Remera gráfica', 43499, 12),
(12, 'Remera de algodón orgánico', 47999, 12),
(13, 'Pantalón de jean', 59999, 14),
(14, 'Pantalón chino', 52499, 14),
(15, 'Pantalón deportivo', 41999, 14),
(16, 'Pantalón de lino', 49499, 14),
(17, 'Pantalón cargo', 59999, 14),
(18, 'Campera de cuero', 119999, 13),
(19, 'Campera de abrigo', 127499, 13),
(20, 'Campera bomber', 74999, 13),
(21, 'Campera impermeable', 86999, 13),
(22, 'Campera de mezclilla', 59999, 13),
(23, 'Bufanda de lana', 13499, 15),
(24, 'Gorra de béisbol', 7499, 15),
(25, 'Cinturón de cuero', 19499, 15),
(26, 'Guantes de invierno', 1049, 15),
(27, 'Mochila de tela', 1949, 15),
(28, 'Zapatillas deportivas', 7499, 16),
(29, 'Zapatillas casuales', 5999, 16),
(30, 'Zapatillas de running', 8999, 16),
(31, 'Zapatillas de skate', 6899, 16),
(32, 'Zapatillas de lona', 4499, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`) VALUES
(1, 'webadmin', '$2y$10$lAoakw4EB09qWqarXbx.WeAP2WZOHiqo.5r1AwQIJLaF/sAbweF5y');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD PRIMARY KEY (`id_informacion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `informacion`
--
ALTER TABLE `informacion`
  MODIFY `id_informacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD CONSTRAINT `informacion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
