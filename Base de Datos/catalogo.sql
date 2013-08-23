-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-08-2013 a las 06:26:00
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `catalogo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE IF NOT EXISTS `anuncio` (
  `id_anuncio` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(50) NOT NULL,
  `descripccion` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `condicion` varchar(50) NOT NULL,
  `expira` date NOT NULL,
  `estado` int(11) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_anuncio`),
  KEY `categoria` (`categoria`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`id_anuncio`, `producto`, `descripccion`, `precio`, `cantidad`, `condicion`, `expira`, `estado`, `prioridad`, `categoria`, `id_usuario`) VALUES
(5, 'ATI Radeon HD 7850', '860MHz Engine Clock, 2GB GDDR5 Memory, 1200MHz Memory Clock GDDR5', '3619.99', 1, 'Nuevo', '2013-09-21', 1, 0, 'Tarjetas de Video', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `busquedas`
--

CREATE TABLE IF NOT EXISTS `busquedas` (
  `id_busqueda` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `busqueda` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_busqueda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria`) VALUES
('Accesorios'),
('Adaptadores'),
('Cases'),
('Dispositivos de Almacenamiento'),
('HDD'),
('Memorias'),
('Monitores'),
('Procesadores'),
('Tarjetas de Video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(200) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  PRIMARY KEY (`id_imagen`),
  KEY `id_anuncio` (`id_anuncio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion_anuncio`
--

CREATE TABLE IF NOT EXISTS `puntuacion_anuncio` (
  `id_usuario` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `punteo` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_anuncio`),
  KEY `id_anuncio` (`id_anuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion_usuario`
--

CREATE TABLE IF NOT EXISTS `puntuacion_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_usuario2` int(11) NOT NULL,
  `punteo` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_usuario2`),
  KEY `id_usuario2` (`id_usuario2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `Administrador` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`,`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `password`, `nombre`, `apellido`, `direccion`, `correo`, `Administrador`) VALUES
(1, 'admin', 'admin', 'Administrador', '  ', '  ', 'admin@admin.com', 1),
(3, 'usuario1', 'usuario1', 'usuario1', 'usuario1', 'direccion', 'usuario1@usuario1.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `id_visita` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_visita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncio_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncio` (`id_anuncio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntuacion_anuncio`
--
ALTER TABLE `puntuacion_anuncio`
  ADD CONSTRAINT `puntuacion_anuncio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puntuacion_anuncio_ibfk_2` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncio` (`id_anuncio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntuacion_usuario`
--
ALTER TABLE `puntuacion_usuario`
  ADD CONSTRAINT `puntuacion_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puntuacion_usuario_ibfk_2` FOREIGN KEY (`id_usuario2`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
