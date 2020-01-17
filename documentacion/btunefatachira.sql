-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2020 a las 18:08:02
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `btunefatachira`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `dataDashboard`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dataDashboard` ()  BEGIN 
	DECLARE usuarios int;
    DECLARE libros int;
    DECLARE posgrado int;
    DECLARE pregrado int;
    
    SELECT COUNT(*) INTO usuarios FROM tab_usuar WHERE statu_usua != 10;
    SELECT COUNT(*) INTO libros FROM tab_libros WHERE statu_libr != 10;
    SELECT COUNT(*) INTO posgrado FROM tab_postgr WHERE statu_post != 10;
    SELECT COUNT(*) INTO pregrado FROM tab_pregra WHERE statu_preg != 10;
    
    SELECT usuarios, libros, posgrado, pregrado;
END$$

DROP PROCEDURE IF EXISTS `editar_carrera`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_carrera` (`nombre_carr` VARCHAR(45), `identidad_carr` INT)  BEGIN
	UPDATE tab_carrer SET nombr_carr=nombre_carr  WHERE ident_carr=identidad_carr;
   END$$

DROP PROCEDURE IF EXISTS `editar_categoria`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_categoria` (`nombre_cate` VARCHAR(45), `identidad_cate` INT)  BEGIN
	UPDATE tab_catego SET nombr_cate=nombre_cate WHERE ident_cate=identidad_cate;
END$$

DROP PROCEDURE IF EXISTS `editar_especializacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_especializacion` (`nombre_espe` VARCHAR(45), `identidad_espe` INT)  BEGIN 
	UPDATE tab_especi SET nombr_espe=nombre_espe WHERE ident_espe=identidad_espe;
END$$

DROP PROCEDURE IF EXISTS `editar_libro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_libro` (IN `nombre_libr` VARCHAR(50), IN `descripcion_libr` VARCHAR(250), IN `autor_libro` VARCHAR(50), IN `identidad_cate` INT, IN `imagen_libr` VARCHAR(200), IN `identidad_libr` INT, IN `identidad_usua` INT)  BEGIN 
    UPDATE tab_libros SET nombr_libr=nombre_libr, descr_libr=descripcion_libr, autor_libr=autor_libro, ident_cate=identidad_cate, image_libr = imagen_libr, ident_usua = identidad_usua WHERE ident_libr=identidad_libr;
END$$

DROP PROCEDURE IF EXISTS `editar_postgrado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_postgrado` (`titulo_post` VARCHAR(80), `autor_post` VARCHAR(45), `tipo_post` VARCHAR(45), `identidad_espe` INT, `identidad_post` INT, `identidad_usua` INT)  BEGIN
	UPDATE tab_postgr SET titul_post=titulo_post, autor_post=autor_post, tipo_post=tipo_post, ident_espe=identidad_espe, ident_usua=identidad_usua WHERE ident_post=identidad_post;
    END$$

DROP PROCEDURE IF EXISTS `editar_pregrado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_pregrado` (IN `titulo_preg` VARCHAR(80), IN `autor_preg` VARCHAR(45), IN `tipo_preg` VARCHAR(45), IN `identidad_carr` INT, IN `identidad_preg` INT, IN `identidad_usua` INT)  BEGIN 
	 
	UPDATE tab_pregra SET titul_preg=titulo_preg, autor_preg=autor_preg, tipo_preg=tipo_preg, ident_carr=identidad_carr, ident_usua=identidad_usua WHERE ident_preg=identidad_preg;
    END$$

DROP PROCEDURE IF EXISTS `editar_usuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_usuario` (`nombre_usua` VARCHAR(45), `apellido_usua` VARCHAR(45), `correo_usua` VARCHAR(45), `usuario_usua` VARCHAR(45), `identidad_usua` INT, `imagen_usua` VARCHAR(45), `identidad` INT)  BEGIN
	UPDATE tab_usuar SET nombr_usua=nombre_usua, apeli_usua=apellido_usua, email_usua=correo_usua, usuar_usua=usuario_usua, ident_tipu=identidad_usua, fotou_usua = imagen_usua WHERE ident_usua=identidad;
    END$$

DROP PROCEDURE IF EXISTS `guardar_carrera`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_carrera` (`nombre_carr` VARCHAR(45))  BEGIN
	INSERT INTO tab_carrer(nombr_carr) VALUES(nombre_carr);
    END$$

DROP PROCEDURE IF EXISTS `guardar_categoria`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_categoria` (`nombr_cate` VARCHAR(45))  BEGIN
 INSERT INTO tab_catego(nombr_cate) VALUES(nombr_cate);
 END$$

DROP PROCEDURE IF EXISTS `guardar_especializacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_especializacion` (`nombre_espe` VARCHAR(45))  BEGIN 
	INSERT INTO tab_especi(nombr_espe) VALUES(nombre_espe);
    END$$

DROP PROCEDURE IF EXISTS `guardar_estudiante`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_estudiante` (`nombre_usua` VARCHAR(45), `apellido_usua` VARCHAR(45), `correo_usua` VARCHAR(45), `usuario_usua` VARCHAR(45), `contraseña_usua` VARCHAR(45), `imagen_usua` VARCHAR(45), `identidad_tipo` INT)  BEGIN
	INSERT INTO tab_usuar(nombr_usua,apeli_usua,email_usua,usuar_usua, contr_usua, statu_usua, fotou_usua, ident_tipu) VALUES(nombre_usua,apellido_usua,correo_usua,usuario_usua,contraseña_usua,imagen_usua, identidad_tipo);
    END$$

DROP PROCEDURE IF EXISTS `guardar_libro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_libro` (`nombre_libr` VARCHAR(50), `descripcion_libr` VARCHAR(250), `autor_libr` VARCHAR(50), `imagen_libr` VARCHAR(200), `archivo_libr` VARCHAR(45), `identidad_cate` INT, `identidad_usua` INT)  BEGIN
	INSERT INTO tab_libros(nombr_libr,descr_libr,autor_libr,image_libr, archi_libr, ident_cate, ident_usua) VALUES(nombre_libr,descripcion_libr,autor_libr,imagen_libr,archivo_libr,identidad_cate,identidad_usua);
    END$$

DROP PROCEDURE IF EXISTS `guardar_postgrado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_postgrado` (`titulo_post` VARCHAR(80), `autor_post` VARCHAR(45), `tipo_post` VARCHAR(45), `archivo_post` VARCHAR(60), `identidad_espe` INT, `identidad_usua` INT)  BEGIN 
	INSERT INTO tab_postgr(titul_post,autor_post,tipo_post, archi_post, ident_espe, ident_usua) VALUES(titulo_post,autor_post,tipo_post,archivo_post,identidad_espe,identidad_usua);
		END$$

DROP PROCEDURE IF EXISTS `guardar_pregrado`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_pregrado` (`titulo_preg` VARCHAR(80), `autor_preg` VARCHAR(45), `tipo_preg` VARCHAR(45), `archivo_preg` VARCHAR(60), `identidad_carr` INT, `identidad_usua` INT)  BEGIN
	INSERT INTO tab_pregra(titul_preg,autor_preg,tipo_preg, archi_preg, ident_carr, ident_usua) VALUES(titulo_preg,autor_preg,tipo_preg,archivo_preg,identidad_carr,identidad_usua);
    END$$

DROP PROCEDURE IF EXISTS `guardar_usuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_usuario` (`nombre_usua` VARCHAR(45), `apellido_usua` VARCHAR(45), `correo_usua` VARCHAR(45), `usuario_usua` VARCHAR(45), `contraseña_usua` VARCHAR(45), `imagen_usua` VARCHAR(45), `identidad_tipu` INT)  BEGIN 
	INSERT INTO tab_usuar(nombr_usua,apeli_usua,email_usua,usuar_usua, contr_usua, statu_usua, fotou_usua, ident_tipu) VALUES(nombre_usua,apellido_usua,correo_usua,usuario_usua,contraseña_usua,imagen_usua, identidad_tipu);
		END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edito_carr`
--

DROP TABLE IF EXISTS `edito_carr`;
CREATE TABLE `edito_carr` (
  `id` int(11) NOT NULL,
  `ident_carr` int(11) NOT NULL,
  `nom_anterior` varchar(45) NOT NULL,
  `nom_nuevo` varchar(45) NOT NULL,
  `statu_anterior` int(11) NOT NULL,
  `statu_nuevo` int(11) NOT NULL,
  `fecre_carr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edito_cate`
--

DROP TABLE IF EXISTS `edito_cate`;
CREATE TABLE `edito_cate` (
  `id` int(11) NOT NULL,
  `ident_cate` int(11) NOT NULL,
  `nom_anterior` varchar(45) NOT NULL,
  `nom_nuevo` varchar(45) NOT NULL,
  `statu_anterior` int(11) NOT NULL,
  `statu_nuevo` int(11) NOT NULL,
  `fecre_cate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edito_espe`
--

DROP TABLE IF EXISTS `edito_espe`;
CREATE TABLE `edito_espe` (
  `id` int(11) NOT NULL,
  `ident_espe` int(11) NOT NULL,
  `nom_anterior` varchar(45) NOT NULL,
  `nom_nuevo` varchar(45) NOT NULL,
  `statu_anterior` int(11) NOT NULL,
  `statu_nuevo` int(11) NOT NULL,
  `fecre_cate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edito_libros`
--

DROP TABLE IF EXISTS `edito_libros`;
CREATE TABLE `edito_libros` (
  `id` int(11) NOT NULL,
  `ident_libr` int(11) NOT NULL,
  `nom_anterior` varchar(50) NOT NULL,
  `nom_nuevo` varchar(50) NOT NULL,
  `descr_anterior` varchar(250) NOT NULL,
  `descr_nuevo` varchar(250) NOT NULL,
  `autor_anterior` varchar(50) NOT NULL,
  `autor_nuevo` varchar(50) NOT NULL,
  `image_anterior` varchar(200) NOT NULL,
  `image_nuevo` varchar(200) NOT NULL,
  `archi_anterior` varchar(45) NOT NULL,
  `archi_nuevo` varchar(45) NOT NULL,
  `statu_anterior` int(11) NOT NULL,
  `statu_nuevo` int(11) NOT NULL,
  `ident_cate_anterior` int(11) NOT NULL,
  `ident_cate_nuevo` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_libr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edito_libros`
--

INSERT INTO `edito_libros` (`id`, `ident_libr`, `nom_anterior`, `nom_nuevo`, `descr_anterior`, `descr_nuevo`, `autor_anterior`, `autor_nuevo`, `image_anterior`, `image_nuevo`, `archi_anterior`, `archi_nuevo`, `statu_anterior`, `statu_nuevo`, `ident_cate_anterior`, `ident_cate_nuevo`, `ident_usua`, `fecre_libr`, `usuario`) VALUES
(1, 1, 'INGLES BASICO', 'INGLES', 'INGLES PARA PRINCIPIANTES', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', 'AUGUSTO GHIO', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 1, 1, 9, 9, 1, '2020-01-16 12:44:45', 'root@localhost'),
(2, 1, 'INGLES', 'INGLES BASICO', 'INGLES PARA PRINCIPIANTES', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', 'AUGUSTO GHIO', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 1, 1, 9, 9, 2, '2020-01-16 12:45:20', 'root@localhost'),
(3, 1, 'INGLES BASICO', 'INGLES BASICO', 'INGLES PARA PRINCIPIANTES', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', 'AUGUSTO GHIO', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 1, 0, 9, 9, 2, '2020-01-16 12:45:32', 'root@localhost'),
(4, 1, 'INGLES BASICO', 'INGLES BASICO', 'INGLES PARA PRINCIPIANTES', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', 'AUGUSTO GHIO', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 0, 1, 9, 9, 2, '2020-01-16 12:46:04', 'root@localhost'),
(5, 1, 'INGLES BASICO', 'INGLES', 'INGLES PARA PRINCIPIANTES', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', 'AUGUSTO GHIO', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 1, 1, 9, 9, 2, '2020-01-16 12:54:28', 'bibliotecario@localhost'),
(6, 1, 'INGLES', 'INGLES BASICO', 'INGLES PARA PRINCIPIANTES', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', 'AUGUSTO GHIO', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 1, 1, 9, 9, 1, '2020-01-16 12:55:01', 'bibliotecario@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edito_postgrado`
--

DROP TABLE IF EXISTS `edito_postgrado`;
CREATE TABLE `edito_postgrado` (
  `id` int(11) NOT NULL,
  `ident_post` int(11) NOT NULL,
  `titul_anterior` varchar(80) NOT NULL,
  `titul_nuevo` varchar(80) NOT NULL,
  `fecre_post` varchar(45) NOT NULL,
  `autor_anterior` varchar(45) NOT NULL,
  `autor_nuevo` varchar(45) NOT NULL,
  `tipo_anterior` varchar(45) NOT NULL,
  `tipo_nuevo` varchar(45) NOT NULL,
  `archi_anterior` varchar(60) NOT NULL,
  `archi_nuevo` varchar(60) NOT NULL,
  `statu_anterior` int(11) NOT NULL,
  `statu_nuevo` int(11) NOT NULL,
  `ident_espe_anterior` int(11) NOT NULL,
  `ident_espe_nuevo` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edito_postgrado`
--

INSERT INTO `edito_postgrado` (`id`, `ident_post`, `titul_anterior`, `titul_nuevo`, `fecre_post`, `autor_anterior`, `autor_nuevo`, `tipo_anterior`, `tipo_nuevo`, `archi_anterior`, `archi_nuevo`, `statu_anterior`, `statu_nuevo`, `ident_espe_anterior`, `ident_espe_nuevo`, `ident_usua`, `fecha_creacion`, `usuario`) VALUES
(1, 1, 'WDOSCOWCNMDOWKDO', 'WDOSCOWCNMDOWKDO', '2020-01-15 09:34:10', 'OQJDQOJOWDOWOD', 'OQJDQOJOWDOWOD', 'Maestria', 'Maestria', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 1, 0, 4, 4, 1, '2020-01-16 11:35:54', 'root@localhost'),
(2, 1, 'WDOSCOWCNMDOWKDO', 'WDOSCOWCNMDOWKDO', '2020-01-15 09:34:10', 'OQJDQOJOWDOWOD', 'OQJDQOJOWDOWOD', 'Maestria', 'Maestria', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 0, 1, 4, 4, 1, '2020-01-16 11:36:12', 'root@localhost'),
(3, 1, 'WDOSCOWCNMDOWKDO', 'ANTHONY QUINTANA', '2020-01-15 09:34:10', 'OQJDQOJOWDOWOD', 'OQJDQOJOWDOWOD', 'Maestria', 'Maestria', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 1, 1, 4, 4, 1, '2020-01-16 11:36:28', 'root@localhost'),
(4, 1, 'ANTHONY QUINTANA', 'AGUSTIN GUANIPA', '2020-01-15 09:34:10', 'OQJDQOJOWDOWOD', 'OQJDQOJOWDOWOD', 'Maestria', 'Maestria', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 1, 1, 4, 4, 1, '2020-01-16 11:36:56', 'root@localhost'),
(5, 1, 'AGUSTIN GUANIPA', 'AGUSTIN GUANIPA', '2020-01-15 09:34:10', 'OQJDQOJOWDOWOD', 'OQJDQOJOWDOWOD', 'Maestria', 'Maestria', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 1, 0, 4, 4, 1, '2020-01-16 11:37:07', 'root@localhost'),
(6, 1, 'AGUSTIN GUANIPA', 'AGUSTIN GUANIPA', '2020-01-15 09:34:10', 'OQJDQOJOWDOWOD', 'OQJDQOJOWDOWOD', 'Maestria', 'Maestria', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 'postgrado_fa8c31ba90320acb18b9b12c50858a14.pdf', 0, 1, 4, 4, 1, '2020-01-16 11:38:01', 'root@localhost'),
(7, 1, 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL "ANA DOLORES FERNANDEZ"', 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', '2020-01-16 12:34:43', 'ALISSON GOMEZ', 'ALISSON GOM', 'Doctorado', 'Doctorado', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 1, 1, 3, 3, 1, '2020-01-16 12:47:23', 'root@localhost'),
(8, 1, 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', '2020-01-16 12:34:43', 'ALISSON GOM', 'ALISSON GOMEZ', 'Doctorado', 'Doctorado', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 1, 1, 3, 3, 2, '2020-01-16 12:48:30', 'root@localhost'),
(9, 1, 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', '2020-01-16 12:34:43', 'ALISSON GOMEZ', 'ALISSON GOMEZ', 'Doctorado', 'Doctorado', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 1, 0, 3, 3, 2, '2020-01-16 12:48:40', 'root@localhost'),
(10, 1, 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', '2020-01-16 12:34:43', 'ALISSON GOMEZ', 'ALISSON GOMEZ', 'Doctorado', 'Doctorado', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 0, 1, 3, 3, 2, '2020-01-16 12:48:48', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edito_pregrado`
--

DROP TABLE IF EXISTS `edito_pregrado`;
CREATE TABLE `edito_pregrado` (
  `id` int(11) NOT NULL,
  `ident_preg` int(11) NOT NULL,
  `titul_anterior` varchar(80) NOT NULL,
  `titul_nuevo` varchar(80) NOT NULL,
  `fecre_preg` varchar(45) NOT NULL,
  `autor_anterior` varchar(45) NOT NULL,
  `autor_nuevo` varchar(45) NOT NULL,
  `tipo_anterior` varchar(45) NOT NULL,
  `tipo_nuevo` varchar(45) NOT NULL,
  `archi_anterior` varchar(60) NOT NULL,
  `archi_nuevo` varchar(60) NOT NULL,
  `statu_anterior` int(11) NOT NULL,
  `statu_nuevo` int(11) NOT NULL,
  `ident_carr_anterior` int(11) NOT NULL,
  `ident_carr_nuevo` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edito_pregrado`
--

INSERT INTO `edito_pregrado` (`id`, `ident_preg`, `titul_anterior`, `titul_nuevo`, `fecre_preg`, `autor_anterior`, `autor_nuevo`, `tipo_anterior`, `tipo_nuevo`, `archi_anterior`, `archi_nuevo`, `statu_anterior`, `statu_nuevo`, `ident_carr_anterior`, `ident_carr_nuevo`, `ident_usua`, `fecha_creacion`, `usuario`) VALUES
(1, 2, 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', '2020-01-16 12:28:45', 'ANTHONY QUINTANA', 'ANTHONY QUINTANA', 'Pasantias', 'Trabajo especial de grado', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 1, 1, 1, 1, 1, '2020-01-16 12:31:34', 'root@localhost'),
(2, 2, 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', '2020-01-16 12:28:45', 'ANTHONY QUINTANA', 'ANTHONY QUINTANA', 'Trabajo especial de grado', 'Trabajo especial de grado', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 1, 1, 1, 3, 1, '2020-01-16 12:31:50', 'root@localhost'),
(3, 1, 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', '2020-01-16 12:27:37', 'CARLOS GUANIPA', 'CARLOS GUA', 'Pasantias', 'Pasantias', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 1, 1, 1, 1, 2, '2020-01-16 12:46:24', 'root@localhost'),
(4, 1, 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', '2020-01-16 12:27:37', 'CARLOS GUA', 'CARLOS GUANIPA', 'Pasantias', 'Pasantias', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 1, 1, 1, 1, 1, '2020-01-16 12:46:56', 'root@localhost'),
(5, 1, 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', '2020-01-16 12:27:37', 'CARLOS GUANIPA', 'CARLOS GUANIPA', 'Pasantias', 'Pasantias', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 1, 0, 1, 1, 1, '2020-01-16 12:47:04', 'root@localhost'),
(6, 2, 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', '2020-01-16 12:28:45', 'ANTHONY QUINTANA', 'ANTHONY QUINTANA', 'Trabajo especial de grado', 'Trabajo especial de grado', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 1, 0, 3, 3, 1, '2020-01-16 13:00:19', 'master@localhost'),
(7, 1, 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', '2020-01-16 12:27:37', 'CARLOS GUANIPA', 'CARLOS GUANIPA', 'Pasantias', 'Pasantias', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 0, 1, 1, 1, 1, '2020-01-16 13:00:28', 'master@localhost'),
(8, 2, 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', '2020-01-16 12:28:45', 'ANTHONY QUINTANA', 'ANTHONY QUINTANA', 'Trabajo especial de grado', 'Trabajo especial de grado', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 0, 1, 3, 3, 1, '2020-01-16 13:00:33', 'master@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elim_carr`
--

DROP TABLE IF EXISTS `elim_carr`;
CREATE TABLE `elim_carr` (
  `id` int(11) NOT NULL,
  `ident_carr` int(11) NOT NULL,
  `nombr_carr` varchar(45) NOT NULL,
  `statu_carr` int(11) NOT NULL,
  `fecre_carr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elim_carr`
--

INSERT INTO `elim_carr` (`id`, `ident_carr`, `nombr_carr`, `statu_carr`, `fecre_carr`, `usuario`) VALUES
(1, 1, 'INGENIERIA SISTEMAS', 1, '2020-01-16 12:11:40', 'root@localhost'),
(2, 2, 'INGENIERIA CIVIL', 1, '2020-01-16 12:13:23', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elim_cate`
--

DROP TABLE IF EXISTS `elim_cate`;
CREATE TABLE `elim_cate` (
  `id` int(11) NOT NULL,
  `ident_cate` int(11) NOT NULL,
  `nombr_cate` varchar(45) NOT NULL,
  `statu_cate` int(11) NOT NULL,
  `fecre_cate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elim_cate`
--

INSERT INTO `elim_cate` (`id`, `ident_cate`, `nombr_cate`, `statu_cate`, `fecre_cate`, `usuario`) VALUES
(1, 1, 'CIENCIAS SOCIALES', 1, '2020-01-16 12:13:07', 'root@localhost'),
(2, 2, 'EDUCACION FISICA Y DEPORTE', 1, '2020-01-16 12:13:07', 'root@localhost'),
(3, 3, 'INGLES', 1, '2020-01-16 12:13:07', 'root@localhost'),
(4, 4, 'INFORMATICA', 1, '2020-01-16 12:13:07', 'root@localhost'),
(5, 5, 'MATEMATICA', 1, '2020-01-16 12:13:07', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elim_espe`
--

DROP TABLE IF EXISTS `elim_espe`;
CREATE TABLE `elim_espe` (
  `id` int(11) NOT NULL,
  `ident_espe` int(11) NOT NULL,
  `nombr_espe` varchar(45) NOT NULL,
  `statu_espe` int(11) NOT NULL,
  `fecre_espe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elim_espe`
--

INSERT INTO `elim_espe` (`id`, `ident_espe`, `nombr_espe`, `statu_espe`, `fecre_espe`, `usuario`) VALUES
(1, 4, 'CIENCIAS JURIDICAS', 1, '2020-01-16 12:13:45', 'root@localhost'),
(2, 5, 'ESPECIALIZACION', 1, '2020-01-16 12:13:45', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elim_libros`
--

DROP TABLE IF EXISTS `elim_libros`;
CREATE TABLE `elim_libros` (
  `id` int(11) NOT NULL,
  `ident_libr` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_libr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elim_libros`
--

INSERT INTO `elim_libros` (`id`, `ident_libr`, `ident_usua`, `fecre_libr`, `usuario`) VALUES
(3, 22, 1, '2020-01-16 11:30:09', 'root@localhost'),
(4, 23, 2, '2020-01-16 11:30:09', 'root@localhost'),
(5, 24, 1, '2020-01-16 11:30:09', 'root@localhost'),
(6, 25, 1, '2020-01-16 12:11:14', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elim_postgrado`
--

DROP TABLE IF EXISTS `elim_postgrado`;
CREATE TABLE `elim_postgrado` (
  `id` int(11) NOT NULL,
  `ident_post` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elim_postgrado`
--

INSERT INTO `elim_postgrado` (`id`, `ident_post`, `ident_usua`, `fecre_post`, `usuario`) VALUES
(1, 1, 1, '2020-01-16 12:12:24', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elim_pregrado`
--

DROP TABLE IF EXISTS `elim_pregrado`;
CREATE TABLE `elim_pregrado` (
  `id` int(11) NOT NULL,
  `ident_preg` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_preg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elim_pregrado`
--

INSERT INTO `elim_pregrado` (`id`, `ident_preg`, `ident_usua`, `fecre_preg`, `usuario`) VALUES
(1, 1, 1, '2020-01-16 12:11:58', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estrada_libros`
--

DROP TABLE IF EXISTS `estrada_libros`;
CREATE TABLE `estrada_libros` (
  `id` int(11) NOT NULL,
  `ident_libr` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_libr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estrada_libros`
--

INSERT INTO `estrada_libros` (`id`, `ident_libr`, `ident_usua`, `fecre_libr`, `usuario`) VALUES
(1, 25, 1, '2020-01-16 11:30:41', 'root@localhost'),
(2, 1, 1, '2020-01-16 12:23:08', 'root@localhost'),
(3, 2, 1, '2020-01-16 12:24:55', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insert_carr`
--

DROP TABLE IF EXISTS `insert_carr`;
CREATE TABLE `insert_carr` (
  `id` int(11) NOT NULL,
  `ident_carr` int(11) NOT NULL,
  `nombr_carr` varchar(45) NOT NULL,
  `fecre_carr` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insert_carr`
--

INSERT INTO `insert_carr` (`id`, `ident_carr`, `nombr_carr`, `fecre_carr`, `usuario`) VALUES
(1, 0, 'INGENIERIA DE SISTEMAS', '2020-01-16 12:25:20', 'root@localhost'),
(2, 0, 'INGENIERIA CIVIL', '2020-01-16 12:25:29', 'root@localhost'),
(3, 0, 'INGENIERIA ELECTRICA', '2020-01-16 12:25:38', 'root@localhost'),
(4, 0, 'LICENCIATURA EN ADMINISTRACION', '2020-01-16 12:25:59', 'root@localhost'),
(5, 0, 'LICENCIATURA EN TURISMO', '2020-01-16 12:26:10', 'root@localhost'),
(6, 0, 'LICENCIATURA EN ECONOMIA SOCIAL', '2020-01-16 12:26:32', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insert_cate`
--

DROP TABLE IF EXISTS `insert_cate`;
CREATE TABLE `insert_cate` (
  `id` int(11) NOT NULL,
  `nombr_cate` varchar(45) NOT NULL,
  `fecre_cate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insert_cate`
--

INSERT INTO `insert_cate` (`id`, `nombr_cate`, `fecre_cate`, `usuario`) VALUES
(1, 'MATEMATICA', '2020-01-16 12:17:46', 'root@localhost'),
(2, 'FISICA', '2020-01-16 12:17:54', 'root@localhost'),
(3, 'LENGUAJE Y COMUNICACION', '2020-01-16 12:18:04', 'root@localhost'),
(4, 'LITERATURA', '2020-01-16 12:18:18', 'root@localhost'),
(5, 'INFORMATICA', '2020-01-16 12:18:25', 'root@localhost'),
(6, 'BIOLOGIA', '2020-01-16 12:19:12', 'root@localhost'),
(7, 'QUIMICA', '2020-01-16 12:19:31', 'root@localhost'),
(8, 'LOGICA', '2020-01-16 12:19:47', 'root@localhost'),
(9, 'IDIOMAS', '2020-01-16 12:20:43', 'root@localhost'),
(10, 'EDUCACION FISICA', '2020-01-16 12:23:27', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insert_espe`
--

DROP TABLE IF EXISTS `insert_espe`;
CREATE TABLE `insert_espe` (
  `id` int(11) NOT NULL,
  `ident_espe` int(11) NOT NULL,
  `nombr_espe` varchar(45) NOT NULL,
  `fecre_espe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insert_espe`
--

INSERT INTO `insert_espe` (`id`, `ident_espe`, `nombr_espe`, `fecre_espe`, `usuario`) VALUES
(1, 1, 'CIENCIAS JUIDICAS Y MILITARES', '2020-01-16 12:32:53', 'root@localhost'),
(2, 2, 'GERENCIA AMBIENTAL', '2020-01-16 12:33:03', 'root@localhost'),
(3, 3, 'INNOVACION EDUCATIVA', '2020-01-16 12:33:10', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insert_postgrado`
--

DROP TABLE IF EXISTS `insert_postgrado`;
CREATE TABLE `insert_postgrado` (
  `id` int(11) NOT NULL,
  `ident_post` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insert_postgrado`
--

INSERT INTO `insert_postgrado` (`id`, `ident_post`, `ident_usua`, `fecre_post`, `usuario`) VALUES
(1, 1, 1, '2020-01-16 12:34:43', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insert_pregrado`
--

DROP TABLE IF EXISTS `insert_pregrado`;
CREATE TABLE `insert_pregrado` (
  `id` int(11) NOT NULL,
  `ident_preg` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL,
  `fecre_preg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insert_pregrado`
--

INSERT INTO `insert_pregrado` (`id`, `ident_preg`, `ident_usua`, `fecre_preg`, `usuario`) VALUES
(1, 1, 1, '2020-01-16 12:27:37', 'root@localhost'),
(2, 2, 1, '2020-01-16 12:28:45', 'root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_carrer`
--

DROP TABLE IF EXISTS `tab_carrer`;
CREATE TABLE `tab_carrer` (
  `ident_carr` int(11) NOT NULL,
  `nombr_carr` varchar(45) DEFAULT NULL,
  `statu_carr` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_carrer`
--

INSERT INTO `tab_carrer` (`ident_carr`, `nombr_carr`, `statu_carr`) VALUES
(1, 'INGENIERIA DE SISTEMAS', 1),
(2, 'INGENIERIA CIVIL', 1),
(3, 'INGENIERIA ELECTRICA', 1),
(4, 'LICENCIATURA EN ADMINISTRACION', 1),
(5, 'LICENCIATURA EN TURISMO', 1),
(6, 'LICENCIATURA EN ECONOMIA SOCIAL', 1);

--
-- Disparadores `tab_carrer`
--
DROP TRIGGER IF EXISTS `edito_carr`;
DELIMITER $$
CREATE TRIGGER `edito_carr` BEFORE UPDATE ON `tab_carrer` FOR EACH ROW BEGIN 
	INSERT INTO edito_carr(ident_carr, nom_anterior, nom_nuevo, statu_anterior, statu_nuevo, usuario) VALUES(new.ident_carr, OLD.nombr_carr, new.nombr_carr, old.statu_carr, new.statu_carr, user()); 
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `elim_carr`;
DELIMITER $$
CREATE TRIGGER `elim_carr` AFTER DELETE ON `tab_carrer` FOR EACH ROW BEGIN 
	INSERT INTO elim_carr(ident_carr, nombr_carr, statu_carr, usuario) VALUES(OLD.ident_carr, old.nombr_carr, old.statu_carr, user()); 
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_carr`;
DELIMITER $$
CREATE TRIGGER `insert_carr` AFTER INSERT ON `tab_carrer` FOR EACH ROW BEGIN
	INSERT INTO insert_carr(nombr_carr,usuario) VALUES(new.nombr_carr, user());
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_catego`
--

DROP TABLE IF EXISTS `tab_catego`;
CREATE TABLE `tab_catego` (
  `ident_cate` int(11) NOT NULL,
  `nombr_cate` varchar(45) NOT NULL,
  `statu_cate` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_catego`
--

INSERT INTO `tab_catego` (`ident_cate`, `nombr_cate`, `statu_cate`) VALUES
(1, 'MATEMATICA', 1),
(2, 'FISICA', 1),
(3, 'LENGUAJE Y COMUNICACION', 1),
(4, 'LITERATURA', 1),
(5, 'INFORMATICA', 1),
(6, 'BIOLOGIA', 1),
(7, 'QUIMICA', 1),
(8, 'LOGICA', 1),
(9, 'IDIOMAS', 1),
(10, 'EDUCACION FISICA', 1);

--
-- Disparadores `tab_catego`
--
DROP TRIGGER IF EXISTS `edito_cate`;
DELIMITER $$
CREATE TRIGGER `edito_cate` BEFORE UPDATE ON `tab_catego` FOR EACH ROW BEGIN 
	INSERT INTO edito_cate(ident_cate, nom_anterior, nom_nuevo, statu_anterior, statu_nuevo, usuario) VALUES(new.ident_cate, OLD.nombr_cate, new.nombr_cate, old.statu_cate, new.statu_cate, user()); 
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `elim_cate`;
DELIMITER $$
CREATE TRIGGER `elim_cate` AFTER DELETE ON `tab_catego` FOR EACH ROW BEGIN
	INSERT INTO elim_cate(ident_cate, nombr_cate, statu_cate, usuario) VALUES(old.ident_cate, old.nombr_cate, old.statu_cate, user());
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_cate`;
DELIMITER $$
CREATE TRIGGER `insert_cate` AFTER INSERT ON `tab_catego` FOR EACH ROW BEGIN 
	INSERT INTO insert_cate(nombr_cate, usuario) VALUES(new.nombr_cate, user()); 
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_especi`
--

DROP TABLE IF EXISTS `tab_especi`;
CREATE TABLE `tab_especi` (
  `ident_espe` int(11) NOT NULL,
  `nombr_espe` varchar(45) DEFAULT NULL,
  `statu_espe` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_especi`
--

INSERT INTO `tab_especi` (`ident_espe`, `nombr_espe`, `statu_espe`) VALUES
(1, 'CIENCIAS JUIDICAS Y MILITARES', 1),
(2, 'GERENCIA AMBIENTAL', 1),
(3, 'INNOVACION EDUCATIVA', 1);

--
-- Disparadores `tab_especi`
--
DROP TRIGGER IF EXISTS `edito_espe`;
DELIMITER $$
CREATE TRIGGER `edito_espe` BEFORE UPDATE ON `tab_especi` FOR EACH ROW BEGIN 
	INSERT INTO edito_espe(ident_espe, nom_anterior, nom_nuevo, statu_anterior, statu_nuevo, usuario) VALUES(new.ident_espe, OLD.nombr_espe, new.nombr_espe, old.statu_espe, new.statu_espe, user()); 
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `elim_espe`;
DELIMITER $$
CREATE TRIGGER `elim_espe` AFTER DELETE ON `tab_especi` FOR EACH ROW BEGIN
	INSERT INTO elim_espe(ident_espe, nombr_espe, statu_espe, usuario) VALUES(old.ident_espe, old.nombr_espe, old.statu_espe, user());
    end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_espe`;
DELIMITER $$
CREATE TRIGGER `insert_espe` AFTER INSERT ON `tab_especi` FOR EACH ROW BEGIN 
	INSERT INTO insert_espe(ident_espe, nombr_espe, usuario) VALUES(new.ident_espe, new.nombr_espe, user()); 
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_libros`
--

DROP TABLE IF EXISTS `tab_libros`;
CREATE TABLE `tab_libros` (
  `ident_libr` int(11) NOT NULL,
  `nombr_libr` varchar(50) DEFAULT NULL,
  `descr_libr` varchar(250) DEFAULT NULL,
  `autor_libr` varchar(50) DEFAULT NULL,
  `fecre_libr` datetime DEFAULT CURRENT_TIMESTAMP,
  `image_libr` varchar(200) DEFAULT NULL,
  `archi_libr` varchar(45) NOT NULL,
  `statu_libr` int(1) DEFAULT '1',
  `ident_cate` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_libros`
--

INSERT INTO `tab_libros` (`ident_libr`, `nombr_libr`, `descr_libr`, `autor_libr`, `fecre_libr`, `image_libr`, `archi_libr`, `statu_libr`, `ident_cate`, `ident_usua`) VALUES
(1, 'INGLES BASICO', 'INGLES PARA PRINCIPIANTES', 'AUGUSTO GHIO', '2020-01-16 12:23:08', 'img_7a3cdd5336bb6f1b069386e18716a7a2.jpg', 'libro_7a3cdd5336bb6f1b069386e18716a7a2.pdf', 1, 9, 1),
(2, 'DEPORTE Y RECREACION', 'PRINCIPIO BASICOS DE LA EDUCACION FISICA COMO ACTIVIDAD RECREATIVA', 'ANTHONY QUINTANA', '2020-01-16 12:24:55', 'img_9ac67ea31495da0c91d2b44d34d116cb.jpg', 'libro_9ac67ea31495da0c91d2b44d34d116cb.pdf', 1, 10, 1);

--
-- Disparadores `tab_libros`
--
DROP TRIGGER IF EXISTS `edito_libros`;
DELIMITER $$
CREATE TRIGGER `edito_libros` BEFORE UPDATE ON `tab_libros` FOR EACH ROW BEGIN 
	INSERT INTO edito_libros(ident_libr, nom_anterior, nom_nuevo, descr_anterior, descr_nuevo, autor_anterior, autor_nuevo, image_anterior, image_nuevo, archi_anterior, archi_nuevo, statu_anterior, statu_nuevo, ident_cate_anterior, ident_cate_nuevo, ident_usua, usuario) VALUES(new.ident_libr, old.nombr_libr, new.nombr_libr, old.descr_libr, new.descr_libr, old.autor_libr, new.autor_libr, old.image_libr, new.image_libr, old.archi_libr, new.archi_libr, old.statu_libr, new.statu_libr, old.ident_cate, new.ident_cate, new.ident_usua, user()); 
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `elim_libros`;
DELIMITER $$
CREATE TRIGGER `elim_libros` AFTER DELETE ON `tab_libros` FOR EACH ROW BEGIN 
	INSERT INTO elim_libros(ident_libr, ident_usua, usuario) VALUES(old.ident_libr, old.ident_usua, user());
    end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `entrada_libros`;
DELIMITER $$
CREATE TRIGGER `entrada_libros` AFTER INSERT ON `tab_libros` FOR EACH ROW BEGIN 
	INSERT INTO estrada_libros(ident_libr, ident_usua, usuario)
    VALUES(new.ident_libr, new.ident_usua, user());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_postgr`
--

DROP TABLE IF EXISTS `tab_postgr`;
CREATE TABLE `tab_postgr` (
  `ident_post` int(11) NOT NULL,
  `titul_post` varchar(80) DEFAULT NULL,
  `fecre_post` datetime DEFAULT CURRENT_TIMESTAMP,
  `autor_post` varchar(45) DEFAULT NULL,
  `tipo_post` varchar(45) NOT NULL,
  `archi_post` varchar(60) NOT NULL,
  `statu_post` int(1) DEFAULT '1',
  `ident_espe` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_postgr`
--

INSERT INTO `tab_postgr` (`ident_post`, `titul_post`, `fecre_post`, `autor_post`, `tipo_post`, `archi_post`, `statu_post`, `ident_espe`, `ident_usua`) VALUES
(1, 'DESARROLLO DE PLAN EDUCATIVO PARA LA ESCUELA ESTADAL ', '2020-01-16 12:34:43', 'ALISSON GOMEZ', 'Doctorado', 'postgrado_faf7de501cb98a06b782db934884616c.pdf', 1, 3, 2);

--
-- Disparadores `tab_postgr`
--
DROP TRIGGER IF EXISTS `edito_postgrado`;
DELIMITER $$
CREATE TRIGGER `edito_postgrado` BEFORE UPDATE ON `tab_postgr` FOR EACH ROW BEGIN 
	INSERT INTO edito_postgrado(ident_post, titul_anterior, titul_nuevo, fecre_post, autor_anterior, autor_nuevo, tipo_anterior, tipo_nuevo, archi_anterior, archi_nuevo, statu_anterior, statu_nuevo, ident_espe_anterior, ident_espe_nuevo, ident_usua, usuario) VALUES(new.ident_post, old.titul_post, new.titul_post, new.fecre_post, old.autor_post, new.autor_post, old.tipo_post, new.tipo_post, old.archi_post, new.archi_post, old.statu_post, new.statu_post, old.ident_espe, new.ident_espe, new.ident_usua, user());
    end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `elim_postgrado`;
DELIMITER $$
CREATE TRIGGER `elim_postgrado` BEFORE DELETE ON `tab_postgr` FOR EACH ROW BEGIN	
	INSERT INTO elim_postgrado(ident_post, ident_usua, usuario) VALUES(old.ident_post, old.ident_usua, user());
    end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_postgrado`;
DELIMITER $$
CREATE TRIGGER `insert_postgrado` AFTER INSERT ON `tab_postgr` FOR EACH ROW BEGIN
	INSERT INTO insert_postgrado(ident_post, ident_usua, usuario) VALUES(new.ident_post, new.ident_usua, user());
    end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_pregra`
--

DROP TABLE IF EXISTS `tab_pregra`;
CREATE TABLE `tab_pregra` (
  `ident_preg` int(11) NOT NULL,
  `titul_preg` varchar(80) DEFAULT NULL,
  `fecre_preg` datetime DEFAULT CURRENT_TIMESTAMP,
  `autor_preg` varchar(45) DEFAULT NULL,
  `tipo_preg` varchar(45) NOT NULL,
  `archi_preg` varchar(60) NOT NULL,
  `statu_preg` int(1) DEFAULT '1',
  `ident_carr` int(11) NOT NULL,
  `ident_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_pregra`
--

INSERT INTO `tab_pregra` (`ident_preg`, `titul_preg`, `fecre_preg`, `autor_preg`, `tipo_preg`, `archi_preg`, `statu_preg`, `ident_carr`, `ident_usua`) VALUES
(1, 'DESARROLLO DE UN SISTEMA PARA LA GESTION DE LA BIBLIOTECA DE  LA UNEFA TACHIRA', '2020-01-16 12:27:37', 'CARLOS GUANIPA', 'Pasantias', 'pregrado_cf6d5c6f8c84215fc1a2fc2d7f3136f0.pdf', 1, 1, 1),
(2, 'IMPLANTACION DE UN SISTEMA ADMINISTRATIVO PARA LA EMPRESA SIGMAEMCA', '2020-01-16 12:28:45', 'ANTHONY QUINTANA', 'Trabajo especial de grado', 'pregrado_d4ccdd9f1026ede3cabd51c70afa0e9b.pdf', 1, 3, 1);

--
-- Disparadores `tab_pregra`
--
DROP TRIGGER IF EXISTS `edito_pregrado`;
DELIMITER $$
CREATE TRIGGER `edito_pregrado` BEFORE UPDATE ON `tab_pregra` FOR EACH ROW BEGIN 
	INSERT INTO edito_pregrado(ident_preg, titul_anterior, titul_nuevo, fecre_preg, autor_anterior, autor_nuevo, tipo_anterior, tipo_nuevo, archi_anterior, archi_nuevo, statu_anterior, statu_nuevo, ident_carr_anterior, ident_carr_nuevo, ident_usua, usuario) VALUES(new.ident_preg, old.titul_preg, new.titul_preg, new.fecre_preg, old.autor_preg, new.autor_preg, old.tipo_preg, new.tipo_preg, old.archi_preg, new.archi_preg, old.statu_preg, new.statu_preg, old.ident_carr, new.ident_carr, new.ident_usua, user());
    end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `elim_pregrado`;
DELIMITER $$
CREATE TRIGGER `elim_pregrado` AFTER DELETE ON `tab_pregra` FOR EACH ROW BEGIN
INSERT INTO elim_pregrado(ident_preg, ident_usua, usuario) VALUES(old.ident_preg, old.ident_usua, user());
end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_pregrado`;
DELIMITER $$
CREATE TRIGGER `insert_pregrado` AFTER INSERT ON `tab_pregra` FOR EACH ROW BEGIN
	INSERT INTO insert_pregrado(ident_preg, ident_usua, usuario) VALUES(new.ident_preg, new.ident_usua, user());
    end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tipusu`
--

DROP TABLE IF EXISTS `tab_tipusu`;
CREATE TABLE `tab_tipusu` (
  `ident_tipu` int(11) NOT NULL,
  `nombr_tipu` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_tipusu`
--

INSERT INTO `tab_tipusu` (`ident_tipu`, `nombr_tipu`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'BIBLIOTECARIO'),
(3, 'ESTUDIANTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_usuar`
--

DROP TABLE IF EXISTS `tab_usuar`;
CREATE TABLE `tab_usuar` (
  `ident_usua` int(11) NOT NULL,
  `nombr_usua` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `apeli_usua` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `email_usua` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `usuar_usua` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `contr_usua` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fotou_usua` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `statu_usua` int(1) DEFAULT '1',
  `ident_tipu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_usuar`
--

INSERT INTO `tab_usuar` (`ident_usua`, `nombr_usua`, `apeli_usua`, `email_usua`, `usuar_usua`, `contr_usua`, `fotou_usua`, `statu_usua`, `ident_tipu`) VALUES
(1, 'ANTHONY', 'QUINTANA', 'QUINTANAANTHONY7@GMAIL.COM', 'MASTER', '65fbef05e01fac390cb3fa073fb3e8cf', 'user.png', 1, 1),
(2, 'AGUSTIN', 'GUANIPA', 'AGUSTINGUANIPA@GMAIL.COM', 'AGUSTIN', '827ccb0eea8a706c4c34a16891f84e7b', 'user.png', 1, 2),
(3, 'YANIRA', 'FERNANDEZ', 'YANIRAFERNANDEZ@GMAIL.COM', 'YANIRA', '827ccb0eea8a706c4c34a16891f84e7b', 'img_bd693ac5f0e4baf3830c5facdfd524d1.jpg', 1, 2),
(4, 'CRISTIAN', 'QUINTANA', 'CRISTIANAQUINTANA@GMAIL.COM', 'CRISTIAN', '827ccb0eea8a706c4c34a16891f84e7b', 'user.png', 0, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `edito_carr`
--
ALTER TABLE `edito_carr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_carr` (`ident_carr`);

--
-- Indices de la tabla `edito_cate`
--
ALTER TABLE `edito_cate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_cate` (`ident_cate`);

--
-- Indices de la tabla `edito_espe`
--
ALTER TABLE `edito_espe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_espe` (`ident_espe`);

--
-- Indices de la tabla `edito_libros`
--
ALTER TABLE `edito_libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_libr` (`ident_libr`);

--
-- Indices de la tabla `edito_postgrado`
--
ALTER TABLE `edito_postgrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_post` (`ident_post`);

--
-- Indices de la tabla `edito_pregrado`
--
ALTER TABLE `edito_pregrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_preg` (`ident_preg`);

--
-- Indices de la tabla `elim_carr`
--
ALTER TABLE `elim_carr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_carr` (`ident_carr`);

--
-- Indices de la tabla `elim_cate`
--
ALTER TABLE `elim_cate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_cate` (`ident_cate`);

--
-- Indices de la tabla `elim_espe`
--
ALTER TABLE `elim_espe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_espe` (`ident_espe`);

--
-- Indices de la tabla `elim_libros`
--
ALTER TABLE `elim_libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_libr` (`ident_libr`);

--
-- Indices de la tabla `elim_postgrado`
--
ALTER TABLE `elim_postgrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_post` (`ident_post`);

--
-- Indices de la tabla `elim_pregrado`
--
ALTER TABLE `elim_pregrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_preg` (`ident_preg`);

--
-- Indices de la tabla `estrada_libros`
--
ALTER TABLE `estrada_libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_libr` (`ident_libr`),
  ADD KEY `ident_libr_2` (`ident_libr`);

--
-- Indices de la tabla `insert_carr`
--
ALTER TABLE `insert_carr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_carr` (`ident_carr`);

--
-- Indices de la tabla `insert_cate`
--
ALTER TABLE `insert_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insert_espe`
--
ALTER TABLE `insert_espe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_espe` (`ident_espe`);

--
-- Indices de la tabla `insert_postgrado`
--
ALTER TABLE `insert_postgrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_post` (`ident_post`);

--
-- Indices de la tabla `insert_pregrado`
--
ALTER TABLE `insert_pregrado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ident_preg` (`ident_preg`);

--
-- Indices de la tabla `tab_carrer`
--
ALTER TABLE `tab_carrer`
  ADD PRIMARY KEY (`ident_carr`);

--
-- Indices de la tabla `tab_catego`
--
ALTER TABLE `tab_catego`
  ADD PRIMARY KEY (`ident_cate`);

--
-- Indices de la tabla `tab_especi`
--
ALTER TABLE `tab_especi`
  ADD PRIMARY KEY (`ident_espe`);

--
-- Indices de la tabla `tab_libros`
--
ALTER TABLE `tab_libros`
  ADD PRIMARY KEY (`ident_libr`),
  ADD KEY `fk_tab_libros_tab_catego1_idx` (`ident_cate`),
  ADD KEY `ident_usua` (`ident_usua`);

--
-- Indices de la tabla `tab_postgr`
--
ALTER TABLE `tab_postgr`
  ADD PRIMARY KEY (`ident_post`),
  ADD KEY `fk_tab_postgr_tab_espe1_idx` (`ident_espe`),
  ADD KEY `ident_usua` (`ident_usua`);

--
-- Indices de la tabla `tab_pregra`
--
ALTER TABLE `tab_pregra`
  ADD PRIMARY KEY (`ident_preg`),
  ADD KEY `fk_tab_pregra_tab_carrer1_idx` (`ident_carr`),
  ADD KEY `ident_usua` (`ident_usua`);

--
-- Indices de la tabla `tab_tipusu`
--
ALTER TABLE `tab_tipusu`
  ADD PRIMARY KEY (`ident_tipu`);

--
-- Indices de la tabla `tab_usuar`
--
ALTER TABLE `tab_usuar`
  ADD PRIMARY KEY (`ident_usua`),
  ADD KEY `fk_tab_usuar_tab_tipusu1_idx` (`ident_tipu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `edito_carr`
--
ALTER TABLE `edito_carr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `edito_cate`
--
ALTER TABLE `edito_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `edito_espe`
--
ALTER TABLE `edito_espe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `edito_libros`
--
ALTER TABLE `edito_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `edito_postgrado`
--
ALTER TABLE `edito_postgrado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `edito_pregrado`
--
ALTER TABLE `edito_pregrado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `elim_carr`
--
ALTER TABLE `elim_carr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `elim_cate`
--
ALTER TABLE `elim_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `elim_espe`
--
ALTER TABLE `elim_espe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `elim_libros`
--
ALTER TABLE `elim_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `elim_postgrado`
--
ALTER TABLE `elim_postgrado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `elim_pregrado`
--
ALTER TABLE `elim_pregrado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estrada_libros`
--
ALTER TABLE `estrada_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `insert_carr`
--
ALTER TABLE `insert_carr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `insert_cate`
--
ALTER TABLE `insert_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `insert_espe`
--
ALTER TABLE `insert_espe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `insert_postgrado`
--
ALTER TABLE `insert_postgrado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `insert_pregrado`
--
ALTER TABLE `insert_pregrado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tab_carrer`
--
ALTER TABLE `tab_carrer`
  MODIFY `ident_carr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tab_catego`
--
ALTER TABLE `tab_catego`
  MODIFY `ident_cate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `tab_especi`
--
ALTER TABLE `tab_especi`
  MODIFY `ident_espe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tab_libros`
--
ALTER TABLE `tab_libros`
  MODIFY `ident_libr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tab_postgr`
--
ALTER TABLE `tab_postgr`
  MODIFY `ident_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tab_pregra`
--
ALTER TABLE `tab_pregra`
  MODIFY `ident_preg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tab_tipusu`
--
ALTER TABLE `tab_tipusu`
  MODIFY `ident_tipu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tab_usuar`
--
ALTER TABLE `tab_usuar`
  MODIFY `ident_usua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tab_libros`
--
ALTER TABLE `tab_libros`
  ADD CONSTRAINT `fk_tab_libros_tab_catego1` FOREIGN KEY (`ident_cate`) REFERENCES `tab_catego` (`ident_cate`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tab_libros_ibfk_1` FOREIGN KEY (`ident_usua`) REFERENCES `tab_usuar` (`ident_usua`);

--
-- Filtros para la tabla `tab_postgr`
--
ALTER TABLE `tab_postgr`
  ADD CONSTRAINT `fk_tab_postgr_tab_espe1` FOREIGN KEY (`ident_espe`) REFERENCES `tab_especi` (`ident_espe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tab_postgr_ibfk_1` FOREIGN KEY (`ident_usua`) REFERENCES `tab_usuar` (`ident_usua`);

--
-- Filtros para la tabla `tab_pregra`
--
ALTER TABLE `tab_pregra`
  ADD CONSTRAINT `fk_tab_pregra_tab_carrer1` FOREIGN KEY (`ident_carr`) REFERENCES `tab_carrer` (`ident_carr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tab_pregra_ibfk_1` FOREIGN KEY (`ident_usua`) REFERENCES `tab_usuar` (`ident_usua`);

--
-- Filtros para la tabla `tab_usuar`
--
ALTER TABLE `tab_usuar`
  ADD CONSTRAINT `tab_usuar_ibfk_1` FOREIGN KEY (`ident_tipu`) REFERENCES `tab_tipusu` (`ident_tipu`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
