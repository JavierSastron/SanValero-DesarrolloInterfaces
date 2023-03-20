-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2023 a las 12:40:35
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestorrestauracion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_Categoria` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_Categoria`, `nombre`) VALUES
(1, 'Turca'),
(2, 'Italiana'),
(3, 'Española'),
(4, 'Americana'),
(5, 'Japones'),
(6, 'Tailandes'),
(7, 'China'),
(8, 'India');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineapedido`
--

CREATE TABLE `lineapedido` (
  `id_Lineapedido` int(11) NOT NULL,
  `id_Pedido` int(11) DEFAULT NULL,
  `id_Producto` int(11) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_Pedido` int(11) NOT NULL,
  `id_Usuario` int(11) DEFAULT NULL,
  `id_Restaurante` int(11) DEFAULT NULL,
  `fecha_realizacion` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_Producto` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagenUrl` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosrestaurante`
--

CREATE TABLE `productosrestaurante` (
  `id_Producto` int(11) DEFAULT NULL,
  `id_Restaurante` int(11) DEFAULT NULL,
  `totalVentas` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantecategorias`
--

CREATE TABLE `restaurantecategorias` (
  `id_Restaurante` int(11) DEFAULT NULL,
  `id_Categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_Restaurante` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `puntuacion` decimal(10,2) DEFAULT NULL,
  `veces_puntuado` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_Restaurante`, `nombre`, `direccion`, `descripcion`, `puntuacion`, `veces_puntuado`) VALUES
(1, 'Mega Dönner Kebab & Pizzeria 2', 'C. de María Zambrano, 48, 50018 Zaragoza', 'Restaurante familiar, buen servicio, más de 100 años haciendo felices a nuestros clientes. No tenemos ninguna demanda por sanidad desde hace 3 Horas, eso es un aumento del 300% respecto al resto de establecimientos similares.', '5.00', 100),
(2, 'Mega Dönner Kebab & Pizzeria 2', 'C. de María Zambrano, 48, 50018 Zaragoza', 'Restaurante familiar, buen servicio, más de 100 años haciendo felices a nuestros clientes. No tenemos ninguna demanda por sanidad desde hace 3 Horas, eso es un aumento del 300% respecto al resto de establecimientos similares.', '5.00', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_Usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido1` varchar(40) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido2` varchar(40) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellido1`, `apellido2`, `email`, `pass`) VALUES
(1, 'Javier', 'Sastron', 'Artigas', 'a23534@svalero.com', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD PRIMARY KEY (`id_Lineapedido`),
  ADD KEY `id_Pedido` (`id_Pedido`),
  ADD KEY `id_Producto` (`id_Producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_Pedido`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `id_Restaurante` (`id_Restaurante`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_Producto`);

--
-- Indices de la tabla `productosrestaurante`
--
ALTER TABLE `productosrestaurante`
  ADD KEY `id_Restaurante` (`id_Restaurante`),
  ADD KEY `id_Producto` (`id_Producto`);

--
-- Indices de la tabla `restaurantecategorias`
--
ALTER TABLE `restaurantecategorias`
  ADD KEY `id_Restaurante` (`id_Restaurante`),
  ADD KEY `id_Categoria` (`id_Categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_Restaurante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  MODIFY `id_Lineapedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_Producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id_Restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD CONSTRAINT `lineapedido_ibfk_1` FOREIGN KEY (`id_Pedido`) REFERENCES `pedidos` (`id_Pedido`),
  ADD CONSTRAINT `lineapedido_ibfk_2` FOREIGN KEY (`id_Producto`) REFERENCES `productos` (`id_Producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_Restaurante`) REFERENCES `restaurantes` (`id_Restaurante`);

--
-- Filtros para la tabla `productosrestaurante`
--
ALTER TABLE `productosrestaurante`
  ADD CONSTRAINT `productosrestaurante_ibfk_1` FOREIGN KEY (`id_Restaurante`) REFERENCES `restaurantes` (`id_Restaurante`),
  ADD CONSTRAINT `productosrestaurante_ibfk_2` FOREIGN KEY (`id_Producto`) REFERENCES `productos` (`id_Producto`);

--
-- Filtros para la tabla `restaurantecategorias`
--
ALTER TABLE `restaurantecategorias`
  ADD CONSTRAINT `restaurantecategorias_ibfk_1` FOREIGN KEY (`id_Restaurante`) REFERENCES `restaurantes` (`id_Restaurante`),
  ADD CONSTRAINT `restaurantecategorias_ibfk_2` FOREIGN KEY (`id_Categoria`) REFERENCES `categorias` (`id_Categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
