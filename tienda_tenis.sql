-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2025 a las 21:23:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_tenis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Portatiles'),
(2, 'Computadores de Escritorio'),
(3, 'Respuestos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(13,2) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle_pedido`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 7, 13, 2, 2000000.00, 4000000.00),
(2, 8, 13, 2, 2000000.00, 4000000.00),
(3, 8, 14, 3, 1500000.00, 4500000.00),
(4, 8, 15, 4, 1100000.00, 4400000.00),
(5, 9, 15, 4, 1100000.00, 4400000.00),
(6, 9, 17, 2, 90000.00, 180000.00),
(7, 10, 15, 4, 1100000.00, 4400000.00),
(8, 10, 17, 2, 90000.00, 180000.00),
(9, 11, 16, 50, 2500000.00, 99999999.99),
(10, 11, 14, 1, 1500000.00, 1500000.00),
(11, 12, 16, 50, 2500000.00, 99999999.99),
(12, 12, 14, 1, 1500000.00, 1500000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_producto`, `nombre_archivo`) VALUES
(29, 14, '1751851492_dell3.webp'),
(30, 14, '1751851492_dell2.webp'),
(31, 14, '1751851492_dell1.webp'),
(32, 15, '1751851523_pcoficina.webp'),
(33, 16, '1751851643_apleescritorio.webp'),
(34, 17, '1751851768_ramddr52.webp'),
(35, 17, '1751851768_ramddr5.webp'),
(36, 18, '1751851854_fuentepoder2.webp'),
(37, 18, '1751851854_fuentepoder.webp'),
(38, 13, '1751920012_hpvictus3.jpeg'),
(39, 13, '1751920012_hpvictus2.jpeg'),
(40, 13, '1751920012_hpvictus.webp'),
(41, 19, '1751995860_hpvictus.webp'),
(42, 20, '1751995868_hpvictus.webp'),
(43, 21, '1751995877_fuentepoder2.webp'),
(44, 22, '1751995885_hpvictus2.jpeg'),
(45, 23, '1751995944_ramddr52.webp'),
(46, 24, '1751995968_fuentepoder2.webp'),
(47, 25, '1751995979_fuentepoder2.webp'),
(48, 26, '1751995986_apleescritorio.webp'),
(49, 27, '1751996027_pcescritorio.jpeg'),
(50, 28, '1751996038_ramddr52.webp'),
(51, 29, '1751999350_hpvictus2.jpeg'),
(52, 30, '1751999359_dell1.webp'),
(53, 31, '1751999366_dell1.webp'),
(54, 32, '1751999374_dell3.webp'),
(55, 33, '1751999382_dell2.webp'),
(56, 34, '1751999393_dell2.webp'),
(57, 35, '1751999402_dell3.webp'),
(58, 36, '1751999431_hpvictus3.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Entregado','En camino','Pendiente','Cancelado') NOT NULL DEFAULT 'Pendiente',
  `total` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `fecha`, `estado`, `total`) VALUES
(7, 5, '2025-07-07 04:49:31', 'Entregado', 0.00),
(8, 5, '2025-07-07 04:50:04', 'Cancelado', 0.00),
(9, 5, '2025-07-07 04:56:31', 'Cancelado', 1190000.00),
(10, 5, '2025-07-07 04:59:08', 'Pendiente', 4580000.00),
(11, 5, '2025-07-07 21:40:51', 'Cancelado', 99999999.99),
(12, 5, '2025-07-07 21:44:33', 'Pendiente', 126500000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especificaciones` varchar(200) DEFAULT NULL,
  `precio` decimal(13,2) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `marca` varchar(200) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `especificaciones`, `precio`, `id_categoria`, `marca`, `modelo`, `tipo`) VALUES
(13, 'HP VICTUS', 'i5 11°, GTX 1650', 2000000.00, 1, 'HP', 'VICTUS', '1'),
(14, 'Dell Inspiron', 'Ryzen 7 5700U', 1500000.00, 1, 'Dell', 'Inspiron', '1'),
(15, 'PC Oficina', 'I3 10°, 8GB RAM ', 1100000.00, 2, 'Compumax', 'Oficina', '2'),
(16, 'PC Escritorio', 'M3, 256GB SDD', 2500000.00, 2, 'Apple', 'Desktop', '2'),
(17, 'Modulo Ram', '8GB x2, 6400 MT/s', 90000.00, 3, 'Corsair', 'Gamer', '3'),
(18, 'Fuente de poder', '650w ', 100000.00, 3, 'Gigabyte', 'Generico', '3'),
(19, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(20, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(21, 'x', 'x', 1.00, 3, 'x', 'x', '3'),
(22, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(23, 'x', 'x', 1.00, 3, 'x', 'x', '3'),
(24, 'x', 'x', 1.00, 3, 'x', 'x', '3'),
(25, 'x', 'x', 1.00, 3, 'x', 'x', '3'),
(26, 'x', 'x', 1.00, 2, 'x', 'x', '2'),
(27, 'x', 'x', 1.00, 2, 'x', 'x', '2'),
(28, 'x', 'x', 1.00, 3, 'x', 'x', '3'),
(29, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(30, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(31, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(32, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(33, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(34, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(35, 'x', 'x', 1.00, 1, 'x', 'x', '1'),
(36, 'x', 'x', 1.00, 1, 'x', 'x', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('admin','cliente') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `rol`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$/mP8AqKJXHZ4ssrYeZGtFObrzbgaUGUYMvqUUdWQZcDb14D4.r8EG', 'admin'),
(2, 'Freyder Díaz Peñuela', 'freyderjapo@gmail.com', '$2y$10$aTb2F4/Ka3LqhcpgI3W36u3QG/ZQUKr0sdtZNpr0bZS4IUbPigDi.', 'cliente'),
(3, 'games', 'game@gmail.com', '$2y$10$QnzK.q0BUu3bC4ejefycEukveJOm2TGDFoc9lo8CnVBegQoQJ1Fh.', 'cliente'),
(4, 'yan', 'yan@gmail.com', '$2y$10$0Ez655/kPK3aBoRzPJGM.ebQezcoezsAluFyvEPISJ4rRhnoKce6m', 'cliente'),
(5, 'cliente', 'cliente@gmail.com', '$2y$10$6kxZtMzwwN/sybNedd3g5.d5HLptLho64ORzl2i96Dh172TEhfj8.', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `fk_detalle_pedido` (`id_pedido`),
  ADD KEY `fk_detalle_producto` (`id_producto`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_detalle_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
