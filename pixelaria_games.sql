-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2026 a las 00:34:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pixelaria_games`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') NOT NULL DEFAULT 'usuario',
  `archivado_en` datetime DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `dni`, `email`, `password_hash`, `rol`, `archivado_en`, `creado_en`) VALUES
(1, 'AdminYardo', 'Pixelaria', '50435504', 'yardo@pixelaria.com', '$2y$10$Vdf5vUaf8ZllHGR8.67iQuDl8I62k6lsdVkYyQTCdvhxjD0g0MDk.', 'admin', NULL, '2026-11-11 21:06:49'),
(2, 'usuariotest', 'bla', '3500000', 'heladera@gmail.com', '$2y$10$fMYkncWdwcnTEQXWnRfrPOmtebtngxaul6mJ15YsQd0Ec7Ch3I8ga', 'usuario', '2026-11-11 18:21:18', '2026-11-11 21:15:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(1, 'Minecraft', 'Explorá mundos, construí y sobreviví a tu manera.', 19999.00, 'img/minecraftg.avif'),
(2, 'Grand Theft Auto V', 'Un mundo abierto lleno de aventuras y posibilidades.', 24999.00, 'img/gta5.jpg\r\n'),
(3, 'The Witcher 3', 'Una aventura de rol en un mundo de fantasía.', 29999.00, 'img/witcher3.jpg'),
(4, 'Hollow Knight', 'Explorá un reino subterráneo lleno de misterios.', 12999.00, 'img/hollowknight.avif'),
(5, 'Cyberpunk 2077', 'Recorré una ciudad futurista en una aventura de acción.', 34999.00, 'img/cyberpunk.webp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
