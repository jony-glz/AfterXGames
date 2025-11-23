-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql305.infinityfree.com
-- Tiempo de generación: 03-11-2025 a las 00:03:16
-- Versión del servidor: 11.4.7-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_40317778_afterx`
--
CREATE DATABASE afterx;
USE afterx;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id`, `id_pedido`, `id_producto`, `nombre_producto`, `precio`, `cantidad`) VALUES
(1, 1, 2, 'God Of War', '1249.00', 1),
(2, 2, 3, 'Ea2026', '1499.00', 1),
(3, 3, 6, 'Final Fantasy XVI', '899.00', 1),
(4, 4, 2, 'God Of War', '1249.00', 1),
(5, 5, 1, 'batman arkham night', '599.00', 1),
(6, 6, 3, 'Ea2026', '1499.00', 2),
(7, 7, 2, 'God Of War', '1249.00', 2),
(8, 8, 2, 'God Of War', '1249.00', 1),
(9, 9, 17, 'Sonic', '299.00', 1),
(10, 10, 15, 'Castlevania', '299.00', 1),
(12, 12, 2, 'God Of War', '1249.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `metodo_pago` enum('tarjeta','paypal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `total`, `fecha`, `metodo_pago`) VALUES
(1, NULL, '1249.00', '2025-10-30 14:00:03', 'paypal'),
(2, NULL, '1149.00', '2025-11-02 14:10:10', 'paypal'),
(3, NULL, '899.00', '2025-11-02 14:11:30', 'paypal'),
(4, NULL, '1249.00', '2025-11-02 14:24:59', 'paypal'),
(5, NULL, '549.00', '2025-11-02 14:29:24', 'paypal'),
(6, NULL, '2298.00', '2025-11-02 14:36:33', 'paypal'),
(7, 6, '2498.00', '2025-11-02 17:58:08', 'paypal'),
(8, NULL, '1249.00', '2025-11-02 20:20:00', 'paypal'),
(9, 8, '299.00', '2025-11-02 20:31:18', 'paypal'),
(10, NULL, '299.00', '2025-11-02 20:31:46', 'paypal'),
(11, NULL, '299.00', '2025-11-02 20:40:20', 'paypal'),
(12, NULL, '1249.00', '2025-11-02 20:40:51', 'paypal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `imagen`, `precio`, `stock`) VALUES
(1, 'Batman Arkham City', 'Batman: Arkham, acción y aventura en Gotham City.', 'batman.jpg', '549.00', 10),
(2, 'God Of War', 'Aventura épica de Kratos contra dioses y monstruos.', 'kratos.jpg', '1249.00', 13),
(3, 'EAsports 26', 'Futbol competitivo', 'fc26.jpeg', '1149.00', 4),
(4, 'Hollow Knight', 'Aventura oscura en un mundo subterráneo lleno de misterios.', 'Hk.jpg', '899.00', 8),
(5, 'Silent Hill 3', 'Horror psicológico en su máxima expresión.', 'SH4jpg.jpg', '399.00', 5),
(6, 'Final Fantasy XVI', 'Un nuevo viaje épico en un universo lleno de magia.', 'finalf.jpg', '899.00', 8),
(7, 'Mortal Kombat 1', 'Los clásicos regresan con combates más intensos.', 'mk.jpg', '799.00', 6),
(8, 'Call Of Duty', 'Acción y estrategia en una experiencia bélica moderna.', 'codjpg.jpg', '999.00', 12),
(9, 'Left 4 Dead 2', 'Sobrevive al apocalipsis zombie junto a tus amigos.', 'left.jpg', '349.00', 15),
(10, 'R.E.P.O', 'Misterio mediante monitos.', 'REPO.jpg', '249.00', 9),
(11, 'Rainbow Six Siege', 'shooter tactico.', 'R6.jpg', '549.00', 12),
(15, 'Castlevania', 'Vampiros y castillos medievales', 'cover-cv2.jpeg', '299.00', 8),
(17, 'Sonic', 'El erizo azul que corre mucho\r\n', 'cover-sonic.jpeg', '299.00', 4),
(19, 'Roblox', 'Juego multijugador online para diversiÃ³n', 'cover-rb.jpeg', '299.00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `rol` enum('admin','cliente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `nombre`, `correo`, `telefono`, `rol`) VALUES
(1, 'admin', '12345', 'carlos', 'admin@afterxgames.com', '871111111', 'admin'),
(2, 'cliente', 'gatito05', 'Bryan', 'cliente@afterxgames.com', '8717827827', 'cliente'),
(6, 'Bryan17', 'Gatito05.', 'Bryan Hernandez Saldivar', 'bryan17100510@gmail.com', '8714651706', 'cliente'),
(7, 'jony-glz', 'jona', 'Carlos ', 'jona@outlook.esp', '8711110000', 'cliente'),
(8, 'jony-15', 'jona', 'Jona', 'jona@outlook.mx', '8711110010', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
