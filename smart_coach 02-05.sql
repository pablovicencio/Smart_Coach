-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-05-2018 a las 21:00:34
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
  `tipo_cli` int(11) DEFAULT NULL COMMENT 'tipo de cliente 0 casa 1 gimnasio',
  `servicio_cli` int(11) DEFAULT NULL COMMENT 'servicio contratado por el cliente 1 entrenameinto-2 nutricion- 3 full',
  PRIMARY KEY (`id_cli`),
  UNIQUE KEY `correo_cli_UNIQUE` (`correo_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cli`, `correo_cli`, `pass_cli`, `nom_cli`, `fono_cli`, `fec_nac_cli`, `vig_cli`, `fec_plan_cli`, `tipo_cli`, `servicio_cli`) VALUES
(1, 'pablo.vicencio@clinicarioblanco.cl', 'bcfec6fe1842e8725be736c5576b0a0d', 'pablo', 96643838, '1993-03-03', b'1', '2018-04-30', 1, 2),
(2, 'pablo.vicencioc@gmail.com', 'bcfec6fe1842e8725be736c5576b0a0d', 'sebastian', 66438888, '1993-03-03', b'1', '2018-04-01', 1, 3),
(3, 'pablo.vicencio@correoaiep.cl', 'bcfec6fe1842e8725be736c5576b0a0d', 'karla', 12312312, '1995-03-05', b'1', '2018-03-16', 0, 1);

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
  `fb_coach` varchar(50) DEFAULT NULL,
  `tipo_coach` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_coach`),
  UNIQUE KEY `correo_coach_UNIQUE` (`correo_coach`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `coach`
--

INSERT INTO `coach` (`id_coach`, `correo_coach`, `pass_coach`, `nom_coach`, `fono_coach`, `vig_coach`, `super`, `fb_coach`, `tipo_coach`) VALUES
(1, 'pvicencioc@hotmail.cl', 'e10adc3949ba59abbe56e057f20f883e', 'pablo coach', 96643838, b'1', b'1', 'kasrrg', 1),
(2, 'killua_killer@outlook.es', 'bcfec6fe1842e8725be736c5576b0a0d', 'coach 1', 78777777, b'1', b'0', 'pablo.vicencio.3557', 2);

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
  `tipo_ejer` bit(1) NOT NULL,
  PRIMARY KEY (`id_ejer`),
  UNIQUE KEY `nom_ejer_UNIQUE` (`nom_ejer`),
  KEY `fk_id_musc_idx` (`fk_id_musc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id_ejer`, `nom_ejer`, `link_ejer`, `nota_ejer`, `fk_id_musc`, `vig_ejer`, `tipo_ejer`) VALUES
(1, 'press banco plano', 'https://www.youtube.com/watch?v=ICaZxO7RmKs', 'prueba creacion de ejercicio ', 1, b'1', b'1'),
(2, 'sentadilla ', 'https://www.youtube.com/watch?v=6YPggJ4UEAY', 'Squat ejercicios y ejercicio  fitness para  cuadriceps, desarrollar los gluteos', 3, b'1', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esc_borg`
--

CREATE TABLE IF NOT EXISTS `esc_borg` (
  `id_esc` int(11) NOT NULL AUTO_INCREMENT,
  `esc` int(11) NOT NULL,
  `fec_esc` datetime NOT NULL,
  `fk_esc_rut` int(11) NOT NULL,
  `fk_esc_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_esc`,`fec_esc`),
  UNIQUE KEY `fk_esc_rut_UNIQUE` (`fk_esc_rut`),
  KEY `id_esc` (`id_esc`),
  KEY `fk_id_rut_idx` (`fk_esc_rut`),
  KEY `fk_id_cli_idx` (`fk_esc_cli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id_evo` int(11) NOT NULL AUTO_INCREMENT,
  `enf_car_evo` int(11) DEFAULT NULL,
  `can_des_evo` int(11) DEFAULT NULL,
  `prob_ost_evo` int(11) DEFAULT NULL,
  `med_evo` int(11) DEFAULT NULL,
  `imp_evo` int(11) DEFAULT NULL,
  `act_sem_evo` int(11) DEFAULT NULL,
  `act_lab_evo` int(11) DEFAULT NULL,
  `act_inf_evo` int(11) DEFAULT NULL,
  `tiempo_casa_evo` int(11) DEFAULT NULL,
  `obj_evo` int(11) DEFAULT NULL,
  `fk_id_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evo`),
  KEY `fk_id_cli_idx` (`fk_id_cli`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eva_dieta`
--

CREATE TABLE IF NOT EXISTS `eva_dieta` (
  `id_eva_dieta` int(11) NOT NULL AUTO_INCREMENT,
  `hambre_eva` int(11) NOT NULL,
  `horario_eva` int(11) DEFAULT NULL,
  `seg_dieta_eva` int(11) NOT NULL,
  `fec_eva` datetime NOT NULL,
  `fk_eva_dieta` int(11) DEFAULT NULL,
  `fk_eva_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_eva_dieta`),
  KEY `fk_eva_dieta_idx` (`fk_eva_dieta`),
  KEY `fk_eva_cli_idx` (`fk_eva_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `eva_dieta`
--

INSERT INTO `eva_dieta` (`id_eva_dieta`, `hambre_eva`, `horario_eva`, `seg_dieta_eva`, `fec_eva`, `fk_eva_dieta`, `fk_eva_cli`) VALUES
(1, 0, 0, 4, '2018-05-02 07:50:10', 8, 1);

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
-- Estructura de tabla para la tabla `nut_ali`
--

CREATE TABLE IF NOT EXISTS `nut_ali` (
  `id_nut_ali` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_ali` varchar(200) NOT NULL,
  `vig_nut_ali` bit(1) NOT NULL,
  `fk_id_ali_ga` int(11) NOT NULL,
  PRIMARY KEY (`id_nut_ali`),
  KEY `fk_ali_ga_idx` (`fk_id_ali_ga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `nut_ali`
--

INSERT INTO `nut_ali` (`id_nut_ali`, `desc_nut_ali`, `vig_nut_ali`, `fk_id_ali_ga`) VALUES
(1, 'Pan marraqueta sin miga', b'1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_comidas`
--

CREATE TABLE IF NOT EXISTS `nut_comidas` (
  `id_nut_com` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_com` varchar(60) NOT NULL,
  `vig_nut_com` bit(1) NOT NULL,
  `desde_nut_com` time DEFAULT NULL,
  `hasta_nut_com` time DEFAULT NULL,
  PRIMARY KEY (`id_nut_com`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `nut_comidas`
--

INSERT INTO `nut_comidas` (`id_nut_com`, `desc_nut_com`, `vig_nut_com`, `desde_nut_com`, `hasta_nut_com`) VALUES
(1, 'Desayuno', b'1', '06:00:00', '09:00:00'),
(2, 'Colación', b'1', '00:00:00', '00:00:00'),
(3, 'Almuerzo', b'1', '12:00:00', '16:00:00'),
(4, 'Once', b'1', '16:30:00', '20:00:00'),
(5, 'Cena', b'1', '19:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_det_dieta`
--

CREATE TABLE IF NOT EXISTS `nut_det_dieta` (
  `id_nut_det_dieta` int(11) NOT NULL AUTO_INCREMENT,
  `fk_nut_det_com` int(11) NOT NULL,
  `fk_nut_det_ga` int(11) NOT NULL,
  `fk_nut_det_ali` int(11) NOT NULL,
  `fk_nut_det_uni` int(11) DEFAULT NULL,
  `fk_nut_dieta` int(11) NOT NULL,
  `vig_nut_det` bit(1) DEFAULT NULL,
  `nota_nut_det` varchar(200) DEFAULT NULL,
  `cant_nut_ali` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nut_det_dieta`),
  KEY `fk_det_com_idx` (`fk_nut_det_com`),
  KEY `fk_det_ga_idx` (`fk_nut_det_ga`),
  KEY `fk_det_ali_idx` (`fk_nut_det_ali`),
  KEY `fk_det_uni_idx` (`fk_nut_det_uni`),
  KEY `fk_det_dieta_idx` (`fk_nut_dieta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `nut_det_dieta`
--

INSERT INTO `nut_det_dieta` (`id_nut_det_dieta`, `fk_nut_det_com`, `fk_nut_det_ga`, `fk_nut_det_ali`, `fk_nut_det_uni`, `fk_nut_dieta`, `vig_nut_det`, `nota_nut_det`, `cant_nut_ali`) VALUES
(1, 4, 1, 1, 1, 3, b'1', 'test carga dieta', 3),
(2, 1, 1, 1, 1, 4, b'1', 'test sin uni_med', 4),
(3, 1, 1, 1, 1, 5, b'1', 'test', 1),
(4, 1, 1, 1, 1, 6, b'1', 'test', 2),
(5, 3, 1, 1, 1, 7, b'1', 'test carga med', 2),
(6, 3, 1, 1, 0, 8, b'1', 'test carga dieta ', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_dieta`
--

CREATE TABLE IF NOT EXISTS `nut_dieta` (
  `id_nut_dieta` int(11) NOT NULL AUTO_INCREMENT,
  `fec_nut_dieta` datetime NOT NULL,
  `vig_nut_dieta` bit(1) NOT NULL,
  `fk_dieta_coach` int(11) NOT NULL,
  `fk_dieta_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nut_dieta`),
  KEY `fk_nut_dieta_coach_idx` (`fk_dieta_coach`),
  KEY `fk_die_cli_idx` (`fk_dieta_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `nut_dieta`
--

INSERT INTO `nut_dieta` (`id_nut_dieta`, `fec_nut_dieta`, `vig_nut_dieta`, `fk_dieta_coach`, `fk_dieta_cli`) VALUES
(1, '2018-04-26 07:48:49', b'0', 2, 1),
(2, '2018-04-26 07:49:30', b'0', 2, 1),
(3, '2018-04-26 07:50:07', b'0', 2, 1),
(4, '2018-04-26 08:04:21', b'0', 2, 1),
(5, '2018-04-26 08:06:44', b'0', 2, 1),
(6, '2018-04-26 08:07:18', b'0', 2, 1),
(7, '2018-04-26 08:09:43', b'0', 2, 1),
(8, '2018-04-26 08:12:21', b'1', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_gru_ali`
--

CREATE TABLE IF NOT EXISTS `nut_gru_ali` (
  `id_nut_grup` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_grup` varchar(80) NOT NULL,
  `vig_nut_grup` bit(1) NOT NULL,
  PRIMARY KEY (`id_nut_grup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `nut_gru_ali`
--

INSERT INTO `nut_gru_ali` (`id_nut_grup`, `desc_nut_grup`, `vig_nut_grup`) VALUES
(1, 'Cereales, pan y legumbres', b'1'),
(2, 'Frutas', b'1'),
(3, 'Verduras', b'1'),
(4, 'Lácteos', b'1'),
(5, 'Carnes y huevo', b'1'),
(6, 'Aceites y alimentos altos en lípidos', b'1'),
(7, 'Saborizantes', b'1'),
(8, 'Edulcorantes calóricos', b'1'),
(9, 'Endulcorantes no calóricos', b'1'),
(10, 'Otros', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_uni_med`
--

CREATE TABLE IF NOT EXISTS `nut_uni_med` (
  `id_nut_uni` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nut_uni` varchar(60) NOT NULL,
  `img_nut_uni` varchar(100) NOT NULL,
  `vig_nut_uni` bit(1) NOT NULL,
  PRIMARY KEY (`id_nut_uni`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `nut_uni_med`
--

INSERT INTO `nut_uni_med` (`id_nut_uni`, `desc_nut_uni`, `img_nut_uni`, `vig_nut_uni`) VALUES
(1, 'Taza', '', b'1'),
(2, 'Cucharadas soperas', '', b'1'),
(3, 'Cucharaditas de té', '', b'1'),
(4, 'Puñado de la mano', '', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

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
(10, '2018-01-30', 12, 3, 90, 60, 'test guardado distintivo', 1, 1, 1, b'0', '2018-01-22 06:11:28'),
(11, '2018-03-15', 10, 3, 20, 20, 'test', 1, 2, 1, b'1', '2018-03-01 05:54:20'),
(12, '2018-03-18', 10, 4, 38, 40, '', 2, 1, 1, b'0', '2018-03-17 07:07:41'),
(13, '2018-03-18', 8, 3, 30, 20, 'prueba', 2, 2, 1, b'0', '2018-03-17 07:07:41'),
(14, '2018-03-17', 12, 3, 45, 27, '', 2, 2, 1, b'1', '2018-03-17 07:28:37'),
(15, '2018-03-21', 4, 8, 20, 30, '', 1, 1, 1, b'1', '2018-03-18 12:21:32'),
(16, '2018-03-23', 10, 3, 30, 30, 'prueba ', 2, 1, 1, b'1', '2018-03-23 12:35:20'),
(17, '2018-03-24', 8, 3, 20, 30, 'prueba', 2, 1, 1, b'1', '2018-03-24 02:27:16'),
(18, '2018-03-31', 10, 3, 15, 10, 'test 31-mar-2018', 1, 1, 1, b'1', '2018-03-31 03:50:33'),
(19, '2018-04-05', 10, 4, 20, 20, '', 1, 1, 1, b'1', '2018-04-08 07:05:55'),
(20, '2018-04-08', 8, 3, 20, 20, '', 2, 1, 1, b'1', '2018-04-08 07:32:12'),
(21, '2018-04-13', 8, 3, 10, 1, 'test', 2, 1, 1, b'1', '2018-04-14 12:42:28'),
(22, '2018-04-13', 10, 4, 10, 2, 'test', 2, 2, 1, b'0', '2018-04-14 12:42:28'),
(23, '2018-04-14', 8, 3, 10, 1, 'PRUEBA', 2, 1, 1, b'1', '2018-04-14 12:43:12');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD CONSTRAINT `fk_id_musc` FOREIGN KEY (`fk_id_musc`) REFERENCES `musculos` (`id_musc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `esc_borg`
--
ALTER TABLE `esc_borg`
  ADD CONSTRAINT `fk_esc_cli` FOREIGN KEY (`fk_esc_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_esc_rut` FOREIGN KEY (`fk_esc_rut`) REFERENCES `rutina` (`id_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `eva_dieta`
--
ALTER TABLE `eva_dieta`
  ADD CONSTRAINT `fk_eva_cli` FOREIGN KEY (`fk_eva_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_eva_dieta` FOREIGN KEY (`fk_eva_dieta`) REFERENCES `nut_dieta` (`id_nut_dieta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evo_cli`
--
ALTER TABLE `evo_cli`
  ADD CONSTRAINT `fk_id_cli` FOREIGN KEY (`fk_id_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nut_dieta`
--
ALTER TABLE `nut_dieta`
  ADD CONSTRAINT `fk_die_cli` FOREIGN KEY (`fk_dieta_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
