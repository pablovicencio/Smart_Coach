-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-01-2018 a las 20:57:03
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `smart_coach`
--
CREATE DATABASE IF NOT EXISTS `smart_coach` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `smart_coach`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `correo_cli` varchar(100) NOT NULL,
  `pass_cli` varchar(32) NOT NULL,
  `nom_cli` varchar(150) NOT NULL,
  `fono_cli` int(11) NOT NULL,
  `fec_nac_cli` date NOT NULL,
  `vig_cli` bit(1) NOT NULL,
  `fec_plan_cli` date NOT NULL,
  PRIMARY KEY (`id_cli`),
  UNIQUE KEY `correo_cli_UNIQUE` (`correo_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cli`, `correo_cli`, `pass_cli`, `nom_cli`, `fono_cli`, `fec_nac_cli`, `vig_cli`, `fec_plan_cli`) VALUES
(1, 'pablo.vicencio@clinicarioblanco.cl', '34a8bc0992fcc1a3c7b52008bf6a3642', 'pablo', 96643838, '1993-03-03', b'1', '2018-01-20'),
(2, 'pvicencioc@hotmail.cl', 'dff46a7573c072a4936b53e2c87a04b1', 'seba', 966438379, '1993-03-03', b'1', '2018-01-20'),
(3, 'pablo.vicencio@correoaiep.cl', '7963f3a04c977dc67f3299c68fec487f', 'karla', 12312312, '1995-03-05', b'1', '2018-01-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coach`
--

CREATE TABLE IF NOT EXISTS `coach` (
  `id_coach` int(11) NOT NULL AUTO_INCREMENT,
  `correo_coach` varchar(100) NOT NULL,
  `pass_coach` varchar(32) NOT NULL,
  `nom_coach` varchar(150) NOT NULL,
  `fono_coach` int(11) NOT NULL,
  `vig_coach` bit(1) NOT NULL,
  `super` bit(1) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_coach`),
  UNIQUE KEY `correo_coach_UNIQUE` (`correo_coach`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `coach`
--

INSERT INTO `coach` (`id_coach`, `correo_coach`, `pass_coach`, `nom_coach`, `fono_coach`, `vig_coach`, `super`, `color`) VALUES
(1, 'pvicencioc@hotmail.cl', 'bb64e875a5efc2944f8dd3b47e356ac8', 'pablo vicencio', 996643838, b'1', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE IF NOT EXISTS `ejercicios` (
  `id_ejer` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ejer` varchar(100) DEFAULT NULL,
  `link_ejer` varchar(150) NOT NULL,
  `nota_ejer` varchar(240) DEFAULT NULL,
  `fk_id_musc` int(11) NOT NULL,
  `vig_ejer` bit(1) NOT NULL,
  PRIMARY KEY (`id_ejer`),
  UNIQUE KEY `nom_ejer_UNIQUE` (`nom_ejer`),
  KEY `fk_id_musc_idx` (`fk_id_musc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id_ejer`, `nom_ejer`, `link_ejer`, `nota_ejer`, `fk_id_musc`, `vig_ejer`) VALUES
(1, 'press banco plano', 'https://www.youtube.com/watch?v=ICaZxO7RmKs', 'prueba creacion de ejercicio ', 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evo_cli`
--

CREATE TABLE IF NOT EXISTS `evo_cli` (
  `id_evo` int(11) NOT NULL AUTO_INCREMENT,
  `fec_evo` date NOT NULL,
  `est_evo` int(11) NOT NULL,
  `peso_evo` int(11) NOT NULL,
  `fk_id_cli` int(11) NOT NULL,
  PRIMARY KEY (`id_evo`),
  KEY `fk_id_cli_idx` (`fk_id_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `evo_cli`
--

INSERT INTO `evo_cli` (`id_evo`, `fec_evo`, `est_evo`, `peso_evo`, `fk_id_cli`) VALUES
(1, '2018-01-18', 100, 20, 2),
(2, '2018-01-23', 160, 54, 3),
(3, '2018-01-23', 160, 52, 3),
(4, '2018-01-23', 162, 55, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musculos`
--

CREATE TABLE IF NOT EXISTS `musculos` (
  `id_musc` int(11) NOT NULL AUTO_INCREMENT,
  `nom_musc` varchar(100) DEFAULT NULL,
  `fec_cre_musc` datetime NOT NULL,
  PRIMARY KEY (`id_musc`),
  UNIQUE KEY `nom_musc_UNIQUE` (`nom_musc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `musculos`
--

INSERT INTO `musculos` (`id_musc`, `nom_musc`, `fec_cre_musc`) VALUES
(1, 'Pectorales', '2018-01-18 15:53:49'),
(2, 'Espalda', '2018-01-18 15:54:05'),
(3, 'Piernas', '2018-01-18 15:54:19'),
(4, 'Bíceps', '2018-01-18 15:54:35'),
(5, 'Tríceps', '2018-01-18 15:54:55'),
(6, 'Hombros', '2018-01-18 15:55:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

CREATE TABLE IF NOT EXISTS `rutina` (
  `id_rut` int(11) NOT NULL AUTO_INCREMENT,
  `fec_rut` date NOT NULL,
  `rep_rut` int(11) NOT NULL,
  `series_rut` int(11) NOT NULL,
  `pausas_rut` int(11) NOT NULL,
  `vel_rut` int(11) NOT NULL,
  `nota_rut` varchar(100) DEFAULT NULL,
  `fk_id_cli` int(11) NOT NULL,
  `fk_id_ejer` int(11) NOT NULL,
  `fk_id_coach` int(11) NOT NULL,
  `vig_rut` bit(1) NOT NULL,
  `fec_reg_rut` datetime NOT NULL,
  PRIMARY KEY (`id_rut`),
  KEY `fk_id_cli_idx` (`fk_id_cli`),
  KEY `fk_id_ejer_idx` (`fk_id_ejer`),
  KEY `fk_id_coach_idx` (`fk_id_coach`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`id_rut`, `fec_rut`, `rep_rut`, `series_rut`, `pausas_rut`, `vel_rut`, `nota_rut`, `fk_id_cli`, `fk_id_ejer`, `fk_id_coach`, `vig_rut`, `fec_reg_rut`) VALUES
(1, '0000-00-00', 10, 3, 125, 120, 'test1', 2, 1, 1, b'0', '0000-00-00 00:00:00'),
(2, '0000-00-00', 12, 4, 60, 90, 'prueba de ingreso ', 1, 1, 1, b'1', '2018-01-22 00:00:00'),
(3, '0000-00-00', 7, 5, 30, 60, '', 1, 1, 1, b'1', '2018-01-22 01:53:56'),
(4, '0000-00-00', 12, 4, 20, 50, '', 1, 1, 1, b'1', '2018-01-22 02:01:28'),
(5, '2018-01-30', 8, 5, 10, 30, 'test', 1, 1, 1, b'0', '2018-01-22 02:05:23'),
(6, '2018-01-30', 8, 5, 10, 30, 'test', 1, 1, 1, b'0', '2018-01-22 03:08:46'),
(7, '2018-01-30', 4, 2, 23, 24, '', 1, 1, 1, b'0', '2018-01-22 03:08:46'),
(9, '2018-01-30', 8, 4, 123, 1234, 'weeee', 1, 1, 1, b'1', '2018-01-22 04:03:32'),
(10, '2018-01-30', 12, 3, 90, 60, 'test guardado distintivo', 1, 1, 1, b'0', '2018-01-22 06:11:28');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD CONSTRAINT `fk_id_musc` FOREIGN KEY (`fk_id_musc`) REFERENCES `musculos` (`id_musc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evo_cli`
--
ALTER TABLE `evo_cli`
  ADD CONSTRAINT `fk_id_cli` FOREIGN KEY (`fk_id_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `fk_id_cli_rut` FOREIGN KEY (`fk_id_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_coach_rut` FOREIGN KEY (`fk_id_coach`) REFERENCES `coach` (`id_coach`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_ejer_rut` FOREIGN KEY (`fk_id_ejer`) REFERENCES `ejercicios` (`id_ejer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
