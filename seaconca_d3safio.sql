-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-09-2018 a las 21:10:28
-- Versión del servidor: 5.6.39-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seaconca_d3safio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL,
  `correo_cli` varchar(100) NOT NULL,
  `pass_cli` varchar(32) NOT NULL,
  `nom_cli` varchar(150) NOT NULL,
  `fono_cli` int(11) NOT NULL,
  `fec_nac_cli` date NOT NULL,
  `vig_cli` bit(1) NOT NULL,
  `fec_plan_cli` date NOT NULL,
  `tipo_cli` int(11) DEFAULT NULL COMMENT 'tipo de cliente 0 casa 1 gimnasio',
  `servicio_cli` int(11) DEFAULT NULL COMMENT 'servicio contratado por el cliente 1 entrenameinto-2 nutricion- 3 full'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cli`, `correo_cli`, `pass_cli`, `nom_cli`, `fono_cli`, `fec_nac_cli`, `vig_cli`, `fec_plan_cli`, `tipo_cli`, `servicio_cli`) VALUES
(1, 'pablo.vicencio@clinicarioblanco.cl', 'bcfec6fe1842e8725be736c5576b0a0d', 'pablo', 96643838, '1993-03-03', b'1', '2018-08-23', 1, 3),
(2, 'pablo.vicencioc@gmail.com', 'bcfec6fe1842e8725be736c5576b0a0d', 'sebastian', 66438888, '1993-03-03', b'1', '2018-04-01', 1, 3),
(3, 'pablo.vicencio@correoaiep.cl', 'bcfec6fe1842e8725be736c5576b0a0d', 'karla', 12312312, '1995-03-05', b'1', '2018-03-16', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coach`
--

CREATE TABLE `coach` (
  `id_coach` int(11) NOT NULL,
  `correo_coach` varchar(100) NOT NULL,
  `pass_coach` varchar(32) NOT NULL,
  `nom_coach` varchar(150) NOT NULL,
  `fono_coach` int(11) NOT NULL,
  `vig_coach` bit(1) NOT NULL,
  `super` bit(1) DEFAULT NULL,
  `fb_coach` varchar(50) DEFAULT NULL,
  `tipo_coach` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `ejercicios` (
  `id_ejer` int(11) NOT NULL,
  `nom_ejer` varchar(100) DEFAULT NULL,
  `link_ejer` varchar(150) NOT NULL,
  `nota_ejer` varchar(240) DEFAULT NULL,
  `fk_id_musc` int(11) NOT NULL,
  `vig_ejer` bit(1) NOT NULL,
  `tipo_ejer` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `esc_borg` (
  `id_esc` int(11) NOT NULL,
  `esc` int(11) NOT NULL,
  `fec_esc` datetime NOT NULL,
  `fk_esc_rut` int(11) NOT NULL,
  `fk_esc_cli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id_eva` int(11) NOT NULL,
  `enf_car_desc_eva` varchar(150) DEFAULT NULL,
  `les_ost_desc_eva` varchar(150) DEFAULT NULL,
  `enf_tab_eva` bit(1) DEFAULT NULL,
  `enf_diab_eva` bit(1) DEFAULT NULL,
  `enf_asma_eva` bit(1) DEFAULT NULL,
  `enf_hip_eva` bit(1) DEFAULT NULL,
  `porc_sent_eva` int(11) DEFAULT NULL,
  `obj_ent_eva` int(11) DEFAULT NULL,
  `alerg_ali_desc_eva` varchar(150) DEFAULT NULL,
  `into_ali_desc_eva` varchar(150) DEFAULT NULL,
  `alco_desc_ali_eva` varchar(150) DEFAULT NULL,
  `apet_eva` int(11) DEFAULT NULL,
  `digest_desc_eva` varchar(150) DEFAULT NULL,
  `agua_eva` int(11) DEFAULT NULL,
  `act_fisica_desc_eva` varchar(150) DEFAULT NULL,
  `desayuno_desc_eva` varchar(150) DEFAULT NULL,
  `colacion_desc_eva` varchar(150) DEFAULT NULL,
  `almuerzo_desc_eva` varchar(150) DEFAULT NULL,
  `once_desc_eva` varchar(150) DEFAULT NULL,
  `cena_desc_eva` varchar(150) DEFAULT NULL,
  `enc_frec_pan_eva` int(11) DEFAULT NULL,
  `enc_frec_frut_eva` int(11) DEFAULT NULL,
  `enc_frec_ens_eva` int(11) DEFAULT NULL,
  `ens_frec_huevo_eva` int(11) DEFAULT NULL,
  `enc_frec_pes_eva` int(11) DEFAULT NULL,
  `enc_frec_leg_eva` int(11) DEFAULT NULL,
  `enc_frec_golo_eva` int(11) DEFAULT NULL,
  `enc_frec_frit_eva` int(11) DEFAULT NULL,
  `enc_frec_azu_eva` int(11) DEFAULT NULL,
  `fk_id_cli_eva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id_eva`, `enf_car_desc_eva`, `les_ost_desc_eva`, `enf_tab_eva`, `enf_diab_eva`, `enf_asma_eva`, `enf_hip_eva`, `porc_sent_eva`, `obj_ent_eva`, `alerg_ali_desc_eva`, `into_ali_desc_eva`, `alco_desc_ali_eva`, `apet_eva`, `digest_desc_eva`, `agua_eva`, `act_fisica_desc_eva`, `desayuno_desc_eva`, `colacion_desc_eva`, `almuerzo_desc_eva`, `once_desc_eva`, `cena_desc_eva`, `enc_frec_pan_eva`, `enc_frec_frut_eva`, `enc_frec_ens_eva`, `ens_frec_huevo_eva`, `enc_frec_pes_eva`, `enc_frec_leg_eva`, `enc_frec_golo_eva`, `enc_frec_frit_eva`, `enc_frec_azu_eva`, `fk_id_cli_eva`) VALUES
(1, 'No', 'No', b'0', b'1', b'0', b'1', 10, 3, 'No', 'No', 'No', 2, 'test dig', 3, 'test act fis', 'test des', 'test colac', 'test alm', 'test once', 'test cena', 1, 2, 3, 4, 5, 6, 7, 8, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eva_dieta`
--

CREATE TABLE `eva_dieta` (
  `id_eva_dieta` int(11) NOT NULL,
  `hambre_eva` int(11) NOT NULL,
  `horario_eva` int(11) DEFAULT NULL,
  `seg_dieta_eva` int(11) NOT NULL,
  `fec_eva` datetime NOT NULL,
  `fk_eva_dieta` int(11) DEFAULT NULL,
  `fk_eva_cli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eva_dieta`
--

INSERT INTO `eva_dieta` (`id_eva_dieta`, `hambre_eva`, `horario_eva`, `seg_dieta_eva`, `fec_eva`, `fk_eva_dieta`, `fk_eva_cli`) VALUES
(1, 0, 0, 4, '2018-05-02 07:50:10', 8, 1),
(2, 0, 0, 2, '2018-07-17 10:13:38', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evo_cli`
--

CREATE TABLE `evo_cli` (
  `id_evo` int(11) NOT NULL,
  `fec_evo` date NOT NULL,
  `est_evo` int(11) NOT NULL,
  `peso_evo` int(11) NOT NULL,
  `fk_id_cli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `musculos` (
  `id_musc` int(11) NOT NULL,
  `nom_musc` varchar(100) DEFAULT NULL,
  `fec_cre_musc` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `nut_ali` (
  `id_nut_ali` int(11) NOT NULL,
  `desc_nut_ali` varchar(200) NOT NULL,
  `vig_nut_ali` bit(1) NOT NULL,
  `fk_id_ali_ga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nut_ali`
--

INSERT INTO `nut_ali` (`id_nut_ali`, `desc_nut_ali`, `vig_nut_ali`, `fk_id_ali_ga`) VALUES
(1, 'Pan marraqueta sin miga', b'1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_comidas`
--

CREATE TABLE `nut_comidas` (
  `id_nut_com` int(11) NOT NULL,
  `desc_nut_com` varchar(60) NOT NULL,
  `vig_nut_com` bit(1) NOT NULL,
  `desde_nut_com` time DEFAULT NULL,
  `hasta_nut_com` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `nut_det_dieta` (
  `id_nut_det_dieta` int(11) NOT NULL,
  `fk_nut_det_com` int(11) NOT NULL,
  `fk_nut_det_ga` int(11) NOT NULL,
  `fk_nut_det_ali` int(11) NOT NULL,
  `fk_nut_det_uni` int(11) DEFAULT NULL,
  `fk_nut_dieta` int(11) NOT NULL,
  `vig_nut_det` bit(1) DEFAULT NULL,
  `nota_nut_det` varchar(200) DEFAULT NULL,
  `cant_nut_ali` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nut_det_dieta`
--

INSERT INTO `nut_det_dieta` (`id_nut_det_dieta`, `fk_nut_det_com`, `fk_nut_det_ga`, `fk_nut_det_ali`, `fk_nut_det_uni`, `fk_nut_dieta`, `vig_nut_det`, `nota_nut_det`, `cant_nut_ali`) VALUES
(1, 4, 1, 1, 1, 3, b'1', 'test carga dieta', 3),
(2, 1, 1, 1, 1, 4, b'1', 'test sin uni_med', 4),
(3, 1, 1, 1, 1, 5, b'1', 'test', 1),
(4, 1, 1, 1, 1, 6, b'1', 'test', 2),
(5, 3, 1, 1, 1, 7, b'1', 'test carga med', 2),
(6, 3, 1, 1, 0, 8, b'1', 'test carga dieta ', 2),
(7, 1, 1, 1, 0, 9, b'1', 'test', 3),
(8, 5, 1, 1, 0, 9, b'1', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_dieta`
--

CREATE TABLE `nut_dieta` (
  `id_nut_dieta` int(11) NOT NULL,
  `fec_nut_dieta` datetime NOT NULL,
  `vig_nut_dieta` bit(1) NOT NULL,
  `fk_dieta_coach` int(11) NOT NULL,
  `fk_dieta_cli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, '2018-04-26 08:12:21', b'0', 2, 1),
(9, '2018-07-17 06:59:09', b'1', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nut_gru_ali`
--

CREATE TABLE `nut_gru_ali` (
  `id_nut_grup` int(11) NOT NULL,
  `desc_nut_grup` varchar(80) NOT NULL,
  `vig_nut_grup` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `nut_uni_med` (
  `id_nut_uni` int(11) NOT NULL,
  `desc_nut_uni` varchar(60) NOT NULL,
  `img_nut_uni` varchar(100) NOT NULL,
  `vig_nut_uni` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `rutina` (
  `id_rut` int(11) NOT NULL,
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
  `circuito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`id_rut`, `fec_rut`, `rep_rut`, `series_rut`, `pausas_rut`, `vel_rut`, `nota_rut`, `fk_id_cli`, `fk_id_ejer`, `fk_id_coach`, `vig_rut`, `fec_reg_rut`, `circuito`) VALUES
(1, '0000-00-00', 10, 3, 125, 120, 'test1', 2, 1, 1, b'0', '0000-00-00 00:00:00', 0),
(2, '0000-00-00', 12, 4, 60, 90, 'prueba de ingreso ', 1, 1, 1, b'1', '2018-01-22 00:00:00', 0),
(3, '0000-00-00', 7, 5, 30, 60, '', 1, 1, 1, b'1', '2018-01-22 01:53:56', 0),
(4, '0000-00-00', 12, 4, 20, 50, '', 1, 1, 1, b'1', '2018-01-22 02:01:28', 0),
(5, '2018-01-30', 8, 5, 10, 30, 'test', 1, 1, 1, b'0', '2018-01-22 02:05:23', 0),
(6, '2018-01-30', 8, 5, 10, 30, 'test', 1, 1, 1, b'0', '2018-01-22 03:08:46', 0),
(7, '2018-01-30', 4, 2, 23, 24, '', 1, 1, 1, b'0', '2018-01-22 03:08:46', 0),
(9, '2018-01-30', 8, 4, 123, 1234, 'weeee', 1, 1, 1, b'1', '2018-01-22 04:03:32', 0),
(10, '2018-01-30', 12, 3, 90, 60, 'test guardado distintivo', 1, 1, 1, b'0', '2018-01-22 06:11:28', 0),
(11, '2018-03-15', 10, 3, 20, 20, 'test', 1, 2, 1, b'1', '2018-03-01 05:54:20', 0),
(12, '2018-03-18', 10, 4, 38, 40, '', 2, 1, 1, b'0', '2018-03-17 07:07:41', 0),
(13, '2018-03-18', 8, 3, 30, 20, 'prueba', 2, 2, 1, b'0', '2018-03-17 07:07:41', 0),
(14, '2018-03-17', 12, 3, 45, 27, '', 2, 2, 1, b'1', '2018-03-17 07:28:37', 0),
(15, '2018-03-21', 4, 8, 20, 30, '', 1, 1, 1, b'1', '2018-03-18 12:21:32', 0),
(16, '2018-03-23', 10, 3, 30, 30, 'prueba ', 2, 1, 1, b'1', '2018-03-23 12:35:20', 0),
(17, '2018-03-24', 8, 3, 20, 30, 'prueba', 2, 1, 1, b'1', '2018-03-24 02:27:16', 0),
(18, '2018-03-31', 10, 3, 15, 10, 'test 31-mar-2018', 1, 1, 1, b'1', '2018-03-31 03:50:33', 0),
(19, '2018-04-05', 10, 4, 20, 20, '', 1, 1, 1, b'1', '2018-04-08 07:05:55', 0),
(20, '2018-04-08', 8, 3, 20, 20, '', 2, 1, 1, b'1', '2018-04-08 07:32:12', 0),
(21, '2018-04-13', 8, 3, 10, 1, 'test', 2, 1, 1, b'1', '2018-04-14 12:42:28', 0),
(22, '2018-04-13', 10, 4, 10, 2, 'test', 2, 2, 1, b'0', '2018-04-14 12:42:28', 0),
(23, '2018-04-14', 8, 3, 10, 1, 'PRUEBA', 2, 1, 1, b'1', '2018-04-14 12:43:12', 0),
(24, '2018-05-07', 10, 1, 0, 3, 'ejercicio de circuito sin pausa, pasar directamente al siguiente', 1, 1, 1, b'1', '2018-05-07 02:20:17', 0),
(25, '2018-05-07', 10, 1, 0, 2, 'ejercicio de circuito sin pausa, pasar directamente al siguiente', 1, 2, 1, b'1', '2018-05-07 02:20:17', 0),
(26, '2018-08-23', 8, 3, 10, 2, 'test', 1, 1, 1, b'1', '2018-08-23 03:21:10', 0),
(27, '2018-08-24', 10, 4, 20, 2, 'test carga 24 -08', 1, 2, 1, b'0', '2018-08-23 03:21:48', 0),
(28, '2018-08-23', 15, 3, 10, 3, '', 1, 2, 1, b'0', '2018-08-23 07:30:08', 0),
(29, '2018-08-23', 10, 4, 10, 3, '', 1, 2, 1, b'0', '2018-08-23 07:37:57', 0),
(30, '2018-08-23', 10, 3, 10, 3, 'test circuito', 1, 2, 1, b'0', '2018-08-23 07:43:09', 0),
(31, '2018-08-23', 10, 5, 8, 3, 'test circuito', 1, 2, 1, b'0', '2018-08-23 07:49:37', 0),
(32, '2018-08-23', 10, 3, 10, 3, 'test circuito', 1, 2, 1, b'0', '2018-08-23 08:04:53', 1),
(33, '2018-08-23', 10, 5, 10, 3, 'test circuito 1', 1, 1, 1, b'0', '2018-08-23 08:06:43', 1),
(34, '2018-08-23', 8, 3, 10, 3, 'test circuito 2', 1, 2, 1, b'0', '2018-08-23 08:06:43', 1),
(35, '2018-08-23', 10, 4, 5, 3, 'test circuito 2', 1, 1, 1, b'0', '2018-08-23 08:06:43', 1),
(36, '2018-08-23', 10, 4, 10, 3, 'test circuito 1', 1, 2, 1, b'0', '2018-08-23 08:10:37', 1),
(37, '2018-08-23', 10, 3, 5, 3, 'test circuito 1.2', 1, 2, 1, b'0', '2018-08-23 08:10:37', 1),
(38, '2018-08-23', 15, 3, 5, 3, 'test circuito 2', 1, 2, 1, b'0', '2018-08-23 08:10:37', 1),
(39, '2018-08-24', 10, 4, 20, 3, 'test circuito', 1, 1, 1, b'1', '2018-08-24 09:22:50', 0),
(40, '2018-08-24', 10, 3, 5, 3, 'test circuito', 1, 2, 1, b'0', '2018-08-24 09:24:35', 0),
(41, '2018-08-24', 8, 3, 10, 0, 'test', 1, 1, 1, b'0', '2018-08-24 09:30:44', 0),
(42, '2018-08-24', 8, 3, 10, 3, 'TEST', 1, 1, 1, b'1', '2018-08-24 09:38:18', 0),
(43, '2018-08-27', 8, 3, 10, 3, 'test 1', 1, 1, 1, b'1', '2018-08-27 01:30:47', 1),
(44, '2018-08-27', 10, 4, 5, 3, 'test 1.1', 1, 2, 1, b'1', '2018-08-27 01:30:47', 1),
(45, '2018-08-27', 8, 3, 5, 3, 'test 2', 1, 1, 1, b'1', '2018-08-27 01:30:47', 2),
(46, '2018-08-27', 10, 4, 5, 3, 'test', 1, 1, 1, b'1', '2018-08-27 01:30:47', 0),
(47, '2018-08-27', 10, 3, 5, 3, 'test', 1, 1, 1, b'1', '2018-08-27 06:05:09', 0),
(48, '2018-08-28', 10, 4, 20, 3, 'test', 1, 1, 1, b'1', '2018-08-27 06:08:36', 0),
(49, '2018-08-28', 10, 3, 10, 3, 'test', 1, 2, 1, b'1', '2018-08-27 06:10:21', 1),
(50, '2018-08-28', 10, 4, 5, 2, 'test 123', 1, 1, 1, b'1', '2018-08-27 06:31:11', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cli`),
  ADD UNIQUE KEY `correo_cli_UNIQUE` (`correo_cli`);

--
-- Indices de la tabla `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id_coach`),
  ADD UNIQUE KEY `correo_coach_UNIQUE` (`correo_coach`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id_ejer`),
  ADD UNIQUE KEY `nom_ejer_UNIQUE` (`nom_ejer`),
  ADD KEY `fk_id_musc_idx` (`fk_id_musc`);

--
-- Indices de la tabla `esc_borg`
--
ALTER TABLE `esc_borg`
  ADD PRIMARY KEY (`id_esc`,`fec_esc`),
  ADD UNIQUE KEY `fk_esc_rut_UNIQUE` (`fk_esc_rut`),
  ADD KEY `id_esc` (`id_esc`),
  ADD KEY `fk_id_rut_idx` (`fk_esc_rut`),
  ADD KEY `fk_id_cli_idx` (`fk_esc_cli`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id_eva`),
  ADD KEY `fk_id_eva_cli_idx` (`fk_id_cli_eva`);

--
-- Indices de la tabla `eva_dieta`
--
ALTER TABLE `eva_dieta`
  ADD PRIMARY KEY (`id_eva_dieta`),
  ADD KEY `fk_eva_dieta_idx` (`fk_eva_dieta`),
  ADD KEY `fk_eva_cli_idx` (`fk_eva_cli`);

--
-- Indices de la tabla `evo_cli`
--
ALTER TABLE `evo_cli`
  ADD PRIMARY KEY (`id_evo`),
  ADD KEY `fk_id_cli_idx` (`fk_id_cli`);

--
-- Indices de la tabla `musculos`
--
ALTER TABLE `musculos`
  ADD PRIMARY KEY (`id_musc`),
  ADD UNIQUE KEY `nom_musc_UNIQUE` (`nom_musc`);

--
-- Indices de la tabla `nut_ali`
--
ALTER TABLE `nut_ali`
  ADD PRIMARY KEY (`id_nut_ali`),
  ADD KEY `fk_ali_ga_idx` (`fk_id_ali_ga`);

--
-- Indices de la tabla `nut_comidas`
--
ALTER TABLE `nut_comidas`
  ADD PRIMARY KEY (`id_nut_com`);

--
-- Indices de la tabla `nut_det_dieta`
--
ALTER TABLE `nut_det_dieta`
  ADD PRIMARY KEY (`id_nut_det_dieta`),
  ADD KEY `fk_det_com_idx` (`fk_nut_det_com`),
  ADD KEY `fk_det_ga_idx` (`fk_nut_det_ga`),
  ADD KEY `fk_det_ali_idx` (`fk_nut_det_ali`),
  ADD KEY `fk_det_uni_idx` (`fk_nut_det_uni`),
  ADD KEY `fk_det_dieta_idx` (`fk_nut_dieta`);

--
-- Indices de la tabla `nut_dieta`
--
ALTER TABLE `nut_dieta`
  ADD PRIMARY KEY (`id_nut_dieta`),
  ADD KEY `fk_nut_dieta_coach_idx` (`fk_dieta_coach`),
  ADD KEY `fk_die_cli_idx` (`fk_dieta_cli`);

--
-- Indices de la tabla `nut_gru_ali`
--
ALTER TABLE `nut_gru_ali`
  ADD PRIMARY KEY (`id_nut_grup`);

--
-- Indices de la tabla `nut_uni_med`
--
ALTER TABLE `nut_uni_med`
  ADD PRIMARY KEY (`id_nut_uni`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD PRIMARY KEY (`id_rut`),
  ADD KEY `fk_id_cli_idx` (`fk_id_cli`),
  ADD KEY `fk_id_ejer_idx` (`fk_id_ejer`),
  ADD KEY `fk_id_coach_idx` (`fk_id_coach`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `coach`
--
ALTER TABLE `coach`
  MODIFY `id_coach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id_ejer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `esc_borg`
--
ALTER TABLE `esc_borg`
  MODIFY `id_esc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id_eva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eva_dieta`
--
ALTER TABLE `eva_dieta`
  MODIFY `id_eva_dieta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `evo_cli`
--
ALTER TABLE `evo_cli`
  MODIFY `id_evo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `musculos`
--
ALTER TABLE `musculos`
  MODIFY `id_musc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nut_ali`
--
ALTER TABLE `nut_ali`
  MODIFY `id_nut_ali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nut_comidas`
--
ALTER TABLE `nut_comidas`
  MODIFY `id_nut_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `nut_det_dieta`
--
ALTER TABLE `nut_det_dieta`
  MODIFY `id_nut_det_dieta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `nut_dieta`
--
ALTER TABLE `nut_dieta`
  MODIFY `id_nut_dieta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nut_gru_ali`
--
ALTER TABLE `nut_gru_ali`
  MODIFY `id_nut_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `nut_uni_med`
--
ALTER TABLE `nut_uni_med`
  MODIFY `id_nut_uni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rutina`
--
ALTER TABLE `rutina`
  MODIFY `id_rut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_id_eva_cli` FOREIGN KEY (`fk_id_cli_eva`) REFERENCES `clientes` (`id_cli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
