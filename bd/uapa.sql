-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2020 a las 18:16:31
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uapa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga`
--

CREATE TABLE `carga` (
  `id_carga` int(11) NOT NULL,
  `id_esc` int(12) NOT NULL,
  `ciclo` varchar(10) CHARACTER SET latin1 NOT NULL,
  `clave` varchar(10) CHARACTER SET latin1 NOT NULL,
  `seccion` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `aula` varchar(15) CHARACTER SET latin1 NOT NULL,
  `dia` int(1) NOT NULL,
  `hi` time NOT NULL,
  `hf` time NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `carga_esc` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carga`
--

INSERT INTO `carga` (`id_carga`, `id_esc`, `ciclo`, `clave`, `seccion`, `aula`, `dia`, `hi`, `hf`, `fecha`, `carga_esc`) VALUES
(1868, 13, '2020-1-3', 'DER329', '1', '1-A-401', 5, '18:00:00', '19:50:00', '2020-03-08 02:12:35', 'Derecho'),
(1869, 13, '2020-1-3', 'DER329', '30', '1-A-406', 1, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Derecho'),
(1870, 13, '2020-1-3', 'DER413', '30', '1-A-407', 1, '10:10:00', '12:00:00', '2020-03-08 02:12:35', 'Derecho'),
(1871, 13, '2020-1-3', 'DER316', '30', '1-A-403', 1, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Derecho'),
(1872, 13, '2020-1-3', 'DER326', '30', '1-A-401', 1, '10:10:00', '12:00:00', '2020-03-08 02:12:35', 'Derecho'),
(1873, 13, '2020-1-3', 'EDU416', '10', '1-D-404', 7, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Educación'),
(1874, 13, '2020-1-3', 'EDU420', '10', '1-D-403', 7, '12:00:00', '14:00:00', '2020-03-08 02:12:35', 'Educación'),
(1875, 13, '2020-1-3', 'EDU427', '10', '1-B-207', 7, '10:10:00', '12:00:00', '2020-03-08 02:12:35', 'Educación'),
(1876, 13, '2020-1-3', 'EDU247', '10', '1-D-401', 7, '10:10:00', '12:00:00', '2020-03-08 02:12:35', 'Educación'),
(1877, 13, '2020-1-3', 'SOC350', '10', '1-B-103', 7, '12:01:00', '14:00:00', '2020-03-08 02:12:35', 'Educación'),
(1878, 13, '2020-1-3', 'SOC416', '20', '1-B-206', 7, '14:01:00', '15:50:00', '2020-03-08 02:12:35', 'Educación'),
(1879, 13, '2020-1-3', 'SOC417', '10', '1-D-405', 7, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Educación'),
(1880, 13, '2020-1-3', 'INF113', '30', '1-LAB. ELE', 1, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Ingenierria'),
(1881, 13, '2020-1-3', 'ISW233', '10', '1-A-INF-01', 7, '12:00:00', '14:00:00', '2020-03-08 02:12:35', 'Ingenierria'),
(1882, 13, '2020-1-3', 'ISW233', '30', '1-A-INF-01', 1, '12:00:00', '14:00:00', '2020-03-08 02:12:35', 'Ingenierria'),
(1883, 13, '2020-1-3', 'ISW315', '20', '1-A-INF-03', 7, '14:00:00', '16:00:00', '2020-03-08 02:12:35', 'Ingenierria'),
(1884, 13, '2020-1-3', 'INF251', '10', '1-D-INF-05', 7, '10:10:00', '12:00:00', '2020-03-08 02:12:35', 'Ingenierria'),
(1885, 13, '2020-1-3', 'INF324', '10', '1-A-INF-04', 7, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Ingenierria'),
(1886, 13, '2020-1-3', 'PRA300', '25', '1-B-205', 7, '14:10:00', '15:50:00', '2020-03-08 02:12:35', 'Pasantía'),
(1887, 13, '2020-1-3', 'ING201', '1', '1-B-201', 5, '16:10:00', '18:00:00', '2020-03-08 02:12:35', 'Idiomas'),
(1888, 13, '2020-1-3', 'ING201', '10', '1-B-303', 7, '10:10:00', '12:00:00', '2020-03-08 02:12:35', 'Idiomas'),
(1889, 13, '2020-1-3', 'ING201', 'GV70', 'VIRTUAL', 6, '11:43:00', '12:00:00', '2020-03-08 02:12:35', 'Idiomas'),
(1890, 13, '2020-1-3', 'ING203', '12', '1-B-105', 7, '08:00:00', '09:50:00', '2020-03-08 02:12:35', 'Idiomas'),
(1963, 13, '2020-2', 'DER329', '1', '1-A-401', 5, '18:00:00', '19:50:00', '2020-03-08 03:26:05', 'Derecho'),
(1964, 13, '2020-2', 'DER329', '30', '1-A-406', 1, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Derecho'),
(1965, 13, '2020-2', 'DER413', '30', '1-A-407', 1, '10:10:00', '12:00:00', '2020-03-08 03:26:05', 'Derecho'),
(1966, 13, '2020-2', 'DER316', '30', '1-A-403', 1, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Derecho'),
(1967, 13, '2020-2', 'DER326', '30', '1-A-401', 1, '10:10:00', '12:00:00', '2020-03-08 03:26:05', 'Derecho'),
(1968, 13, '2020-2', 'EDU416', '10', '1-D-404', 7, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Educación'),
(1969, 13, '2020-2', 'EDU420', '10', '1-D-403', 7, '12:00:00', '14:00:00', '2020-03-08 03:26:05', 'Educación'),
(1970, 13, '2020-2', 'EDU427', '10', '1-B-207', 7, '10:10:00', '12:00:00', '2020-03-08 03:26:05', 'Educación'),
(1971, 13, '2020-2', 'EDU247', '10', '1-D-401', 7, '10:10:00', '12:00:00', '2020-03-08 03:26:05', 'Educación'),
(1972, 13, '2020-2', 'SOC350', '10', '1-B-103', 7, '12:01:00', '14:00:00', '2020-03-08 03:26:05', 'Educación'),
(1973, 13, '2020-2', 'SOC416', '20', '1-B-206', 7, '14:01:00', '15:50:00', '2020-03-08 03:26:05', 'Educación'),
(1974, 13, '2020-2', 'SOC417', '10', '1-D-405', 7, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Educación'),
(1975, 13, '2020-2', 'INF113', '30', '1-LAB. ELE', 1, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1976, 13, '2020-2', 'ISW233', '10', '1-A-INF-01', 7, '12:00:00', '14:00:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1977, 13, '2020-2', 'ISW233', '30', '1-A-INF-01', 1, '12:00:00', '14:00:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1978, 13, '2020-2', 'ISW315', '20', '1-A-INF-03', 7, '14:00:00', '16:00:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1979, 13, '2020-2', 'INF251', '10', '1-D-INF-05', 7, '10:10:00', '12:00:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1980, 13, '2020-2', 'INF324', '10', '1-A-INF-04', 7, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1981, 13, '2020-2', 'PRA300', '25', '1-B-205', 7, '14:10:00', '15:50:00', '2020-03-08 03:26:05', 'Pasantía'),
(1982, 13, '2020-2', 'ING201', '1', '1-B-201', 5, '16:10:00', '18:00:00', '2020-03-08 03:26:05', 'Idiomas'),
(1983, 13, '2020-2', 'ING201', '10', '1-B-303', 7, '10:10:00', '12:00:00', '2020-03-08 03:26:05', 'Idiomas'),
(1984, 13, '2020-2', 'ING201', 'GV70', 'VIRTUAL', 6, '11:43:00', '12:00:00', '2020-03-08 03:26:05', 'Idiomas'),
(1985, 13, '2020-2', 'ING203', '12', '1-B-105', 7, '08:00:00', '09:50:00', '2020-03-08 03:26:05', 'Idiomas'),
(1986, 13, '2020-2', 'INF113', '30', '1-LAB. ELE', 1, '12:00:00', '14:00:00', '2020-03-08 03:26:05', 'Ingenierria'),
(1987, 13, '2020-3', 'DER329', '1', '1-A-401', 5, '18:00:00', '19:50:00', '2020-03-19 04:46:08', 'Derecho'),
(1988, 13, '2020-3', 'DER329', '30', '1-A-406', 1, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Derecho'),
(1989, 13, '2020-3', 'DER413', '30', '1-A-407', 1, '10:10:00', '12:00:00', '2020-03-19 04:46:08', 'Derecho'),
(1990, 13, '2020-3', 'DER316', '30', '1-A-403', 1, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Derecho'),
(1991, 13, '2020-3', 'DER326', '30', '1-A-401', 1, '10:10:00', '12:00:00', '2020-03-19 04:46:08', 'Derecho'),
(1992, 13, '2020-3', 'EDU416', '10', '1-D-404', 7, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Educación'),
(1993, 13, '2020-3', 'EDU420', '10', '1-D-403', 7, '12:00:00', '14:00:00', '2020-03-19 04:46:08', 'Educación'),
(1994, 13, '2020-3', 'EDU427', '10', '1-B-207', 7, '10:10:00', '12:00:00', '2020-03-19 04:46:08', 'Educación'),
(1995, 13, '2020-3', 'EDU247', '10', '1-D-401', 7, '10:10:00', '12:00:00', '2020-03-19 04:46:08', 'Educación'),
(1996, 13, '2020-3', 'SOC350', '10', '1-B-103', 7, '12:01:00', '14:00:00', '2020-03-19 04:46:08', 'Educación'),
(1997, 13, '2020-3', 'SOC416', '20', '1-B-206', 7, '14:01:00', '15:50:00', '2020-03-19 04:46:08', 'Educación'),
(1998, 13, '2020-3', 'SOC417', '10', '1-D-405', 7, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Educación'),
(1999, 13, '2020-3', 'INF113', '30', '1-LAB. ELE', 1, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Ingenierria'),
(2000, 13, '2020-3', 'ISW233', '10', '1-A-INF-01', 7, '12:00:00', '14:00:00', '2020-03-19 04:46:08', 'Ingenierria'),
(2001, 13, '2020-3', 'ISW233', '30', '1-A-INF-01', 1, '12:00:00', '14:00:00', '2020-03-19 04:46:08', 'Ingenierria'),
(2002, 13, '2020-3', 'ISW315', '20', '1-A-INF-03', 7, '14:00:00', '16:00:00', '2020-03-19 04:46:08', 'Ingenierria'),
(2003, 13, '2020-3', 'INF251', '10', '1-D-INF-05', 7, '10:10:00', '12:00:00', '2020-03-19 04:46:08', 'Ingenierria'),
(2004, 13, '2020-3', 'INF324', '10', '1-A-INF-04', 7, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Ingenierria'),
(2005, 13, '2020-3', 'PRA300', '25', '1-B-205', 7, '14:10:00', '15:50:00', '2020-03-19 04:46:08', 'Pasantía'),
(2006, 13, '2020-3', 'ING201', '1', '1-B-201', 5, '16:10:00', '18:00:00', '2020-03-19 04:46:08', 'Idiomas'),
(2007, 13, '2020-3', 'ING201', '10', '1-B-303', 7, '10:10:00', '12:00:00', '2020-03-19 04:46:08', 'Idiomas'),
(2008, 13, '2020-3', 'ING201', 'GV70', 'VIRTUAL', 6, '11:43:00', '12:00:00', '2020-03-19 04:46:08', 'Idiomas'),
(2009, 13, '2020-3', 'ING203', '12', '1-B-105', 7, '08:00:00', '09:50:00', '2020-03-19 04:46:08', 'Idiomas'),
(2010, 13, '2020-3', 'INF113', '30', '1-LAB. ELE', 1, '12:00:00', '14:00:00', '2020-03-19 04:46:08', 'Ingenierria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `id_comp` int(11) NOT NULL,
  `id_esc` int(12) NOT NULL,
  `clave_comp` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `desc_comp` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `prere_comp` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_comp` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id_comp`, `id_esc`, `clave_comp`, `desc_comp`, `prere_comp`, `estado_comp`) VALUES
(1, 11, 'EDU110', 'Introducción a la Educación a Distancia', 'BR.', 1),
(2, 11, 'PPE001', 'Curso Propedéutico de Español', 'BR.', 1),
(3, 11, 'SOC111', 'Orientación Universitaria', 'BR.', 1),
(4, 11, 'SOC112', 'Metodología de la Investigación I', 'BR.', 1),
(5, 11, 'LEN111', 'Español I', 'PPE-001', 1),
(6, 11, 'SOC135', 'Medio Ambiente y Sociedad', 'BR', 1),
(7, 11, 'LEN112', 'Español II', 'LEN-111', 1),
(8, 11, 'SOC121', 'Metodología de la Investigación II', 'SOC-112', 1),
(9, 11, 'PPM002', 'Curso Propedéutico Matemática', 'BR.', 1),
(10, 11, 'SOC114', 'Sociología', 'BR.', 1),
(11, 11, 'MAT111', 'Matemática Básica', 'PPM-002', 1),
(12, 11, 'DER121', 'Introducción al Estudio del Derecho Privado', 'BR.', 1),
(13, 11, 'DER123', 'Derecho Civil I (Las personas y Derecho Familiar)', 'DER-121', 1),
(14, 11, 'SOC132', 'Introducción a la Historia Social Dominicana', 'BR.', 1),
(15, 11, 'DER135', 'Historia del Derecho y de las Ideas Políticas', 'BR.', 1),
(16, 11, 'DER122', 'Sociología Jurídica', 'SOC-114', 1),
(17, 11, 'INF310', 'Tecnología  Información y la Comunicación I', 'BR.', 1),
(18, 11, 'DER124', 'Derecho Romano I', 'BR.', 1),
(19, 11, 'DER134', 'Derecho Civil II (Teoría de las Obligaciones)', 'DER-123', 1),
(20, 11, 'SOC116', 'El Ser Humano y su Contexto', 'BR.', 1),
(21, 11, 'DER127', 'Derecho Penal General', 'DER-121', 1),
(22, 11, 'DER131', 'Derecho Político y Constitucional', 'BR.', 1),
(23, 11, 'ING201', 'Inglés I', 'BR.', 1),
(24, 11, 'DER133', 'Derecho Penal I (Crímenes y Delitos contra las per', 'DER-127', 1),
(25, 11, 'DER312', 'Derecho Administrativo', 'DER-131', 1),
(26, 11, 'ING202', 'Inglés II', 'ING-201', 1),
(27, 11, 'DER211', 'Derecho Civil III (Los contratos y las Garantías)', 'DER-134', 1),
(28, 11, 'ING203', 'Inglés III', 'ING-202', 1),
(29, 11, 'DER213', 'Derecho Penal II (Crímenes y delitos contra la pro', 'DER-133', 1),
(30, 11, 'DER281', 'Filosofía y Lógica Jurídica', 'BR.', 1),
(31, 11, 'DER223', 'Derecho Civil IV  (Sucesiones  Liberalidades)', 'DER-211', 1),
(32, 11, 'DER301', 'Derecho Laboral I', 'DER-312', 1),
(33, 11, 'DER316', 'Derecho Laboral II', 'DER-301', 1),
(34, 11, 'DER314', 'Derecho Civil V (Responsabilidad Civil)', 'DER-223', 1),
(35, 11, 'DER270', 'Derecho Internacional Público y Privado', 'BR.', 1),
(36, 11, 'DER212', 'Derecho Procesal Civil I', 'DER-211', 1),
(37, 11, 'DER210', 'Derecho Procesal Penal I', 'DER-213', 1),
(38, 11, 'DER323', 'Derecho Civil VI (Derechos Intelectuales)', 'DER-314', 1),
(39, 11, 'DER224', 'Derecho Procesal Civil II (Los Recursos)', 'DER-212', 1),
(40, 11, 'DER300', 'Derecho Comercial I', 'DER-223', 1),
(41, 11, 'DER317', 'Práctica Jurídica I (Introd. a la Práctica Judicia', 'DER-210', 1),
(42, 11, 'DER226', 'Derecho Procesal Penal II', 'DER-210', 1),
(43, 11, 'PRA300', 'Práctica Profesional (Pasantía)  de 120 horas', '8º aprobado', 1),
(44, 11, 'DER329', 'Práctica Jurídica II (Servicio y Práctica judicial', 'DER-317', 1),
(45, 11, 'DER326', 'Derecho Comercial II', 'DER-300', 1),
(46, 11, 'DER327', 'Deontología Jurídica', 'DER-281', 1),
(47, 11, 'DER338', 'Derecho Inmobiliario', 'DER-121', 1),
(48, 11, 'DER232', 'Derecho Procesal Civil III (Las vías de ejecución)', 'DER-224', 1),
(49, 11, 'DER331', 'Legislación de Tránsito', 'DER-226', 1),
(50, 11, 'DER231', 'Criminología', 'DER-127', 1),
(51, 11, 'DER321', 'Derecho Comparado', 'DER-270', 1),
(52, 11, 'DER337', 'Legislación Monetaria y Financiera', 'DER-326', 1),
(53, 11, 'DER413', 'Práctica Jurídica III (Servicios especializados en', 'DER-329', 1),
(54, 11, 'DER402', 'Legislación Tributaria', 'DER-326', 1),
(55, 11, 'DER325', 'Penalogía y Derecho Penitenciario', 'DER-226', 1),
(56, 11, 'DER336', 'Derecho Notarial', 'DER-323', 1),
(57, 11, 'DER334', 'Medicina Forense', 'DER-413', 1),
(58, 11, 'DER403', 'Criminalistica', 'DER-231', 1),
(59, 11, 'SOC600', 'Curso Final de Grado', 'Ninguna asignatura pendiente', 1),
(60, 12, 'EDU114', 'Introducción a las Ciencias de la  Educación', 'BR', 1),
(61, 12, 'EDU123', 'Didáctica General', 'EDU-114', 1),
(62, 12, 'SOC214', 'Introducción a las Ciencias Sociales', 'BR.', 1),
(63, 12, 'EDU126', 'Sociología de la Educación', 'EDU-114', 1),
(64, 12, 'SOC134', 'Antropología General', 'BR:', 1),
(65, 12, 'EDU139', 'Fundamentos Filosóficos e Históricos de la Educaci', 'EDU-114', 1),
(66, 12, 'EDU116', ' Planificación y Gestión Áulica', 'EDU-123', 1),
(67, 12, 'PSI130', 'Psicología Evolutiva', 'BR', 1),
(68, 12, 'SOC218', 'Historia  de la Civilización Antigua', 'SOC-214', 1),
(69, 12, 'SOC328', 'Historia  de la Civilización Media', 'SOC-218', 1),
(70, 12, 'EDU230', 'Fundamentos y Estructura del Currículo Dominicano', 'EDU-139', 1),
(71, 12, 'SOC219', 'Geografía  General', 'SOC-214', 1),
(72, 12, 'EDU347', 'Recursos Didácticos  y Tecnológicos', '  INF-310', 1),
(73, 12, 'SOC126', 'Cultura, Folklore y Patrimonio Dominicano', 'BR', 1),
(74, 12, 'PSI220', 'Psicología Educativa', 'PSI-130', 1),
(75, 12, 'SOC229', 'Geografía  Universal', 'SOC-219', 1),
(76, 12, 'SOC338', 'Historia de Civilización Moderna y Contemporánea', 'SOC-328', 1),
(77, 12, 'SOC336', 'Geografía de América y el Caribe', 'SOC-229', 1),
(78, 12, 'SOC339', 'Historia de  América y el Caribe I', 'SOC -338', 1),
(79, 12, 'EDU348', 'Evaluación  de los Aprendizajes', 'EDU-116', 1),
(80, 12, 'PRA224', 'Práctica Docente I', 'EDU-116', 1),
(81, 12, 'SOC345', 'Historia de  América y el Caribe II', 'SOC -339', 1),
(82, 12, 'EDU437', 'Educación  para la Diversidad', 'EDU-230', 1),
(83, 12, 'SOC417', 'Geografía Dominicana I', 'SOC-336', 1),
(84, 12, 'EDU249', 'Didáctica Especial de las Ciencias Sociales', 'EDU-123', 1),
(85, 12, 'SOC416', 'Historia Dominicana I', 'SOC-339', 1),
(86, 12, 'SOC426', 'Historia Dominicana II', 'SOC-416', 1),
(87, 12, 'PRA235', 'Práctica Docente II', 'PRA-224', 1),
(88, 12, 'SOC427', 'Geografía Dominicana II', 'SOC-417', 1),
(89, 12, 'ECO121', 'Economía', 'MAT-111', 1),
(90, 12, 'INF318', 'Tecnología Aplicada a la Educación', 'INF-310', 1),
(91, 12, 'SOC350', 'Historia del Pensamiento  Político y Social', 'SOC-214', 1),
(92, 12, 'MAT131', 'Estadística I', 'MAT-111', 1),
(93, 12, 'SOC436', 'Historia Dominicana III', 'SOC-426', 1),
(94, 12, 'EDU436', 'Educación para la Paz  y Formación  Ciudadana.', 'EDU-230', 1),
(95, 12, 'FIL221', 'Ética Profesional de los Docentes', 'BR.', 1),
(96, 12, 'SOC425', 'Seminario de Ciencias Sociales', 'SOC-436', 1),
(97, 12, 'PRA245', 'Práctica Docente III', 'PRA-235', 1),
(98, 12, 'LEN134', 'Lingüística General', 'LEN-112', 1),
(99, 12, 'PSI117', 'Desarrollo del Lenguaje en la  Etapa Infantil', 'LEN-112', 1),
(100, 12, 'LEN225', 'Introducción al Estudio  Literario', 'LEN-134', 1),
(101, 12, 'LEN230', 'Literatura Infantil', 'LEN-225', 1),
(102, 12, ' SOC116', 'Ser Humano y su Contexto', 'BR.', 1),
(103, 12, 'LEN310', 'Fonología y Fonética', 'LEN-134', 1),
(104, 12, 'LEN240', 'Estudio de la Literatura Antigua  y Medieval', 'LEN-230', 1),
(105, 12, 'LEN 320', 'Estudio de la Literatura  Moderna y Contemporánea', 'LEN-240', 1),
(106, 12, 'EDU251', 'Didáctica Especial de la Lectura y la Escritura', 'EDU-123', 1),
(107, 12, 'LEN426', 'Historia de la  Lengua Española', 'LEN-310', 1),
(108, 12, 'LEN213', 'Sociolingüística', 'LEN-134', 1),
(109, 12, 'EDU244', 'Didáctica Especial de la Lengua Española', 'EDU-123', 1),
(110, 12, 'LEN335', 'Estudio de la Literatura Española', 'LEN-320', 1),
(111, 12, 'LEN416', 'Morfosintaxis', 'LEN-310', 1),
(112, 12, 'LEN336', 'Análisis de Textos Hispanos', 'LEN -335', 1),
(113, 12, 'LEN315', 'Redacción y Estilo', 'LEN-416', 1),
(114, 12, 'LEN 332', 'Taller Análisis del Discurso', 'LEN-416', 1),
(115, 12, 'PSI338', 'Psicolingüística', 'PSI-117', 1),
(116, 12, 'LEN337', 'Análisis de textos Dominicanos', 'LEN-336', 1),
(117, 12, 'EDU250', 'Didáctica Especial de la Literatura', 'EDU-123', 1),
(118, 12, 'LEN420', 'Estrategias de Producción Escrita', 'LEN-315', 1),
(119, 12, 'LEN 500', 'Seminario de Lengua Española', 'LEN-315', 1),
(120, 12, 'PARA300', 'Práctica Profesional  (Pasantía)  de 120 horas', '8º cuatrimestre aprobado', 1),
(121, 12, 'MAT130', 'Lógica y Teoría de Conjuntos', 'MAT-111', 1),
(122, 12, 'MAT112', 'Matemática I', 'MAT-111', 1),
(123, 12, 'MAT113', 'Matemática  II', 'MAT-112', 1),
(124, 12, 'PS1130', 'Psicología Evolutiva', 'BR.', 1),
(125, 12, 'MAT114', 'Matemática  III', 'MAT-113', 1),
(126, 12, 'MAT121', 'Geometría I', 'MAT-113', 1),
(127, 12, 'PS1220', 'Psicología Educativa', 'PSI-130', 1),
(128, 12, 'MAT133', 'Geometría II', 'MAT-121', 1),
(129, 12, 'EDU619', 'Didáctica Especial  de la Matemática', 'EDU-123', 1),
(130, 12, 'FIS111', 'Física I y Laboratorio', 'MAT-113', 1),
(131, 12, 'FIS112', 'Física II y Laboratorio', 'FIS-111', 1),
(132, 12, 'MAT221', 'Estadística II', 'MAT-131', 1),
(133, 12, 'MAT226', 'Trigonometría I', 'MAT-133', 1),
(134, 12, 'MAT222', 'Matemática Financiera I', 'MAT-114', 1),
(135, 12, 'MAT236', 'Trigonometría   II', 'MAT-226', 1),
(136, 12, 'FIS113', 'Física III y Laboratorio', 'FIS-112', 1),
(137, 12, 'MAT237', 'Cálculo Diferencial', 'MAT-226', 1),
(138, 12, 'MAT337', 'Cálculo Integral', 'MAT-237', 1),
(139, 12, 'EDU620', 'Didáctica Especial de la Física', 'EDU-123', 1),
(140, 12, 'FIS114', 'Física IV y Laboratorio', 'FIS-113', 1),
(141, 12, 'MAT329', 'Algebra Lineal', 'MAT-237', 1),
(142, 12, 'MAT340', 'Ecuaciones Diferenciales', 'MAT-337', 1),
(143, 12, 'EDU460', 'Seminario de Matemática y Física', 'MAT-337', 1),
(144, 12, 'MAT120', 'Matemática  en    Educación  Básica  I', 'MAT-111', 1),
(145, 12, 'EDU215', 'Planificación Educativa y Gestión Áulica  en Educa', 'EDU-123', 1),
(146, 12, 'MAT220', 'Matemática en Educación Básica  II', 'MAT-120', 1),
(147, 12, 'LEN216', 'Lengua Española  en Educación Básica  I', 'LEN-112', 1),
(148, 12, 'MAT240', 'Matemática en Educación Básica   III', 'MAT-220', 1),
(149, 12, 'LEN226', 'Lengua Española  en  Educación Básica  II', 'LEN-216', 1),
(150, 12, 'LEN236', 'Lengua Española  en  Educación Básica  III', 'LEN-226', 1),
(151, 12, 'EDU326', 'Recursos Didácticos y Tecnológicos en Educación Bá', 'INF-310', 1),
(152, 12, 'ECN216', 'Ciencias de la Naturaleza  en  Educación Básica  y', 'BR', 1),
(153, 12, 'SOC137', ' Ciencias  Sociales   en Educación Básica', 'SOC-132', 1),
(154, 12, 'EDU327', 'Evaluación de los Aprendizajes  en Educación Básic', ' EDU-215', 1),
(155, 12, 'EDU320', 'Legislación y Gestión Educativa', 'EDU-230', 1),
(156, 12, 'EDU416', 'Expresión Corporal y Psicomotricidad', 'EDU-230', 1),
(157, 12, 'EDU246', 'Didáctica  Especial de las Ciencias de la Naturale', 'EDU-123', 1),
(158, 12, 'EDU247', 'Didáctica Especial  de las Ciencias Sociales', 'EDU-123', 1),
(159, 12, 'EDU 248', 'Estrategias Lúdicas en  Educación Básica', 'EDU-230', 1),
(160, 12, 'EDU329', 'Educación, Familia y  Nutrición', 'EDU-230', 1),
(161, 12, 'EDU420', 'Educación Artística y Animación Sociocultural', 'EDU-230', 1),
(162, 12, 'EDU520', 'Seminario de Educación Básica', 'PRA-245', 1),
(163, 12, 'PRA325', 'Práctica Docente IV', 'PRA-245', 1),
(164, 12, 'EDU135', 'Aprendizaje Lógico-Matemático', 'MAT-111', 1),
(165, 12, 'LEN220', 'Lenguaje  y Comunicación en el Nivel Inicial', 'PSI-117', 1),
(166, 12, 'EDU210', 'Planificación Educativa y Gestión Áulica en el Niv', 'EDU-123', 1),
(167, 12, 'EDU223', 'Fundamentos del Currículo de la Educación Inicial', 'EDU-230', 1),
(168, 12, 'MAT118', 'Matemática en el Nivel Inicial', 'MAT-111', 1),
(169, 12, 'EDU136', 'Ciencias Sociales en el Nivel Inicial', 'SOC-132', 1),
(170, 12, 'ECN220', 'Ciencias de la Naturaleza y el Entorno', 'BR.', 1),
(171, 12, 'EDU319', 'Recursos Didácticos y Tecnológicos en Educación  I', 'INF-310', 1),
(172, 12, 'ECN320', 'Anatomía y Fisiología Humana', 'ECN-220', 1),
(173, 12, 'EDU325', 'Evaluación de los Aprendizajes en Educación Inicia', ' EDU-210', 1),
(174, 12, 'EDU344', 'Estrategias Lúdicas en Educación Inicial', 'EDU-230', 1),
(175, 12, 'EDU342', 'Educación Escénica  en el Nivel  Inicial', 'EDU-416', 1),
(176, 12, 'EDU519', 'Seminario de Educación Inicial', 'PRA-235', 1),
(177, 7, 'CBC102', 'Introducción a la Educación  a Distancia', 'BR', 1),
(178, 7, 'CBE103', 'Español I', 'BR', 1),
(179, 7, 'CBC104', 'Infotecnología para el Aprendizaje', 'BR', 1),
(180, 7, 'FGI101', 'Propedéutico de Ingeniería  ', 'BR', 1),
(181, 7, 'CBM106', 'Matemática Básica', 'FGI-101', 1),
(182, 7, 'CBE105', 'Español II', 'CBE-103', 1),
(183, 7, 'AGR101', 'Introducción a la Agrimensura', 'BR', 1),
(184, 7, 'FGC205', 'Metodología de la Investigación I  ', 'BR', 1),
(185, 7, 'FGF201', 'Física General', 'CBM-106', 1),
(186, 7, 'LAF201', 'Práctica de Física General', 'FGF-201 (CORREQ)', 1),
(187, 7, 'INF101', 'Informática para Agrimensores', 'AGR-101', 1),
(188, 7, 'FGM104', 'Geometría Descriptiva', 'CBM-106', 1),
(189, 7, 'AGR102', 'Topografía I y laboratorio', 'AGR-101', 1),
(190, 7, 'EDS423', 'Geografía Física  de la Isla de Santo Domingo', 'BR', 1),
(191, 7, 'AGR103', 'Dibujo Técnico', 'FGM-104', 1),
(192, 7, 'FGM208', 'Trigonometría Esférica', 'FGM-104', 1),
(193, 7, 'AGR204', 'Topografía II y Laboratorio', 'AGR-102', 1),
(194, 7, 'FGM209', 'Cálculo y Geometría Analítica', 'CBM-106', 1),
(195, 7, 'AGR205', 'Topografía III y Laboratorio', 'AGR-204', 1),
(196, 7, 'AGR206', 'Geodesia', 'AGR-204', 1),
(197, 7, 'AGR207', 'Dibujo Topográfico', 'AGR-103', 1),
(198, 7, 'FGD412', 'Derecho Inmobiliario para Agrimensores', 'AGR-101', 1),
(199, 7, 'AGR208', 'Topografía IV y Laboratorio', 'AGR-205', 1),
(200, 7, 'AGR209', 'Geodesia Satelital y Laboratorio', 'AGR-206', 1),
(201, 7, 'AGR210', 'Levantamiento Catastral', 'AGR-206', 1),
(202, 7, 'AGR211', 'Cartografía', 'AGR-209', 1),
(203, 7, 'AGR212', 'Catastro y Tasación', 'AGR-210', 1),
(204, 7, 'AGR213', 'Reglamentaciones Técnicas  en Mensuras Catastrales', 'FGD-412', 1),
(205, 7, 'AGR214', 'Levantamiento Hidrográfico', 'AGR-210', 1),
(206, 7, 'AGR315', 'Fotogrametría', 'AGR-211', 1),
(207, 7, 'FGN306', 'Presupuesto para Agrimensores', 'AGR-212', 1),
(208, 7, 'FGC409', 'Ética Profesional', 'BR', 1),
(209, 7, 'AGR316', 'Seminario de Agrimensura', 'AGR-213', 1),
(210, 7, 'CBC101', 'Taller de Orientación Universitaria', '', 1),
(211, 7, 'INF110', 'Introducción a la Informática', 'BR', 1),
(212, 7, 'MAT521', 'Análisis Matemático 1', 'MAT111', 1),
(213, 7, 'ADM101', 'Administración de Empresas I', 'BR', 1),
(214, 7, 'ISW134', 'Lógica Matemática', 'INF110', 1),
(215, 7, 'ISW133', 'Contabilidad y Finanzas', 'MAT111', 1),
(216, 7, 'ISW211', 'Teleinformática', 'INF110 / ISW134', 1),
(217, 7, 'MAT531', 'Análisis Matemático II', 'MAT521', 1),
(218, 7, 'INF321', 'Programación I', 'ISW134', 1),
(219, 7, 'ISW213', 'Probabilidades y Estadística', 'MAT521', 1),
(220, 7, 'IET110', 'Electrónica Básica', 'FIS111', 1),
(221, 7, 'ING204', 'Inglés IV', 'ING-203', 1),
(222, 7, 'INF322', 'Programación II', 'INF321', 1),
(223, 7, 'MAT321', 'Álgebra Lineal I', 'MAT111', 1),
(224, 7, 'ISW232', ' Sistema de Base de Datos I', 'INF321', 1),
(225, 7, 'INF312', 'Arquitectura de Hardware', 'IET110', 1),
(226, 7, 'ISW234', 'Ingeniería de Software  I', 'INF321', 1),
(227, 7, 'INF323', 'Programación III', 'INF322/ ISW232', 1),
(228, 7, 'INF113', 'Sistemas Operativos', 'INF325/ ISW211', 1),
(229, 7, 'ISW233', ' Sistema de Base de Datos II', 'ISW232', 1),
(230, 7, 'ISW314', 'Gráficos por computadoras', 'INF322/ MAT531', 1),
(231, 7, 'ISW315', 'Ingeniería de Software II', 'ISW234', 1),
(232, 7, 'INF324', 'Programación IV', 'INF323', 1),
(233, 7, 'ISW322', 'Inteligencia Artificial', 'ISW134', 1),
(234, 7, 'ISW313', 'Matemática Numérica', 'MAT531', 1),
(235, 7, 'ISW323', 'Gestión de Software', 'ISW315', 1),
(236, 7, 'INF251', 'Desarrollo de Aplicaciones Web', 'INF324/ISW233', 1),
(237, 7, 'INF410', 'Investigación de Operaciones  I', 'MAT531/ ISW313', 1),
(238, 7, 'ADM332', 'Elaboración  y Evaluación de Proyectos', 'ECO121/ MAT531', 1),
(239, 7, 'INF334', 'Informática Gerencial', 'ADM101 / INF110', 1),
(240, 7, 'FIL233', 'Ética Profesional', 'BR', 1),
(241, 7, 'INF411', 'Investigación de operaciones  II', 'INF410', 1),
(242, 7, 'ISW412', 'Automatización industrial', 'ISW314/ ISW322', 1),
(243, 7, 'ISW413', 'Seminario Profesional', 'SOC121/INF334', 1),
(244, 7, 'MER345', 'Comercio Electrónico', 'ECO-121 / INF334', 1),
(245, 7, 'ADM315', 'Administración  de los Recursos Productivos', 'ADM101', 1),
(246, 7, 'SOC412', 'Seminario de Investigación', 'ISW413', 1),
(247, 7, 'ISW421', 'Gestión del Conocimiento y la Toma de Decisiones', 'ISW322/ INF334', 1),
(248, 7, 'ISW414', 'Ciencia, Tecnología y Sociedad', 'BR', 1),
(249, 7, 'INF430', 'Simulación Digital', 'ISW412', 1),
(250, 7, 'ISW422', 'Desarrollo y Administración de Software', 'ISW315/ INF251', 1),
(251, 7, 'SOC500', 'Monografía Final', 'Ninguna asignatura pendiente', 1),
(252, 8, 'ADM102', 'Administración de Empresas II', 'ADM-101', 1),
(253, 8, 'MER133', 'Mercadotecnia I', 'BR.', 1),
(254, 8, 'CON121', 'Contabilidad I', 'MAT-111', 1),
(255, 8, 'INF311', 'Tecnología de la Información y la Comunicación II', 'INF-310', 1),
(256, 8, 'CON122', 'Contabilidad II', 'CON-121', 1),
(257, 8, 'MER214', 'Mercadotecnia II', 'MER-133', 1),
(258, 8, 'ECO225', 'Economía Aplicada', 'ECO-121', 1),
(259, 8, 'CON213', 'Contabilidad III', 'CON-122', 1),
(260, 8, 'ADM240', 'Emprendurismo y Empresa', 'ADM-102', 1),
(261, 8, 'ADM224', 'Negocio, Gobierno y Sociedad', 'ADM-102', 1),
(262, 8, 'CON314', 'Contabilidad de Costos I', 'CON-213', 1),
(263, 8, 'ADM330', 'Estructura Organizacional', 'ADM-102', 1),
(264, 8, 'PSI203', 'Gestión Humana I', 'ADM-102', 1),
(265, 8, 'MER224', 'Investigación de Mercado I', 'MER-214', 1),
(266, 8, 'CON321', 'Contabilidad de Costos II', 'CON-314', 1),
(267, 8, 'PSI204', 'Gestión Humana II', 'PSI-203', 1),
(268, 8, 'DER401', 'Legislación Comercial', 'BR.', 1),
(269, 8, 'ADM313', 'Control  de Calidad', 'ADM-315', 1),
(270, 8, 'ADM430', 'Práctica de Administración I', 'ADM-315', 1),
(271, 8, 'ADM316', 'Estrategia Empresarial', 'ADM-430', 1),
(272, 8, 'ADM431', 'Práctica de Administración II', 'ADM-430', 1),
(273, 8, 'ADM133', 'Planificación y Organización de Nuevas Empresas', 'ADM-330', 1),
(274, 8, 'ADM331', 'Presupuesto Empresarial', 'CON-321', 1),
(275, 8, 'ADM317', 'Administración Financiera I', 'CON-321', 1),
(276, 8, 'ADM318', 'Administración Financiera II', 'ADM-317', 1),
(277, 8, 'ADM435', 'Metodología de Análisis de Casos', 'ADM-316', 1),
(278, 8, 'DER400', 'Legislación Laboral', 'BR.', 1),
(279, 8, 'ADM328', 'Comercio y Negociaciones Internacionales', 'ADM-316', 1),
(280, 8, 'ADM416', 'Seminario de Administración', 'ADM-431', 1),
(281, 8, 'ADM324', 'Administración de Servicios', 'ADM-416', 1),
(282, 8, 'ADM401', 'Análisis y Elaboración Informes Técnicos', 'ADM-317', 1),
(283, 8, 'ADM436', 'Administración Estratégica', 'ADM-316', 1),
(284, 8, 'MAT132', 'Matemática II', 'MAT-111', 1),
(285, 8, 'CON221', 'Contabilidad IV', 'CON-213', 1),
(286, 8, 'CON231', 'Contabilidad V', 'CON-221', 1),
(287, 8, 'CON375', 'Contabilidad Superior I', 'CON-221', 1),
(288, 8, 'MAT223', 'Matemática Financiera II', 'MAT-222', 1),
(289, 8, 'CON376', 'Contabilidad Superior II', 'CON-375', 1),
(290, 8, 'CON421', 'Tributación e Impuestos Sobre la Renta I', 'CON-221', 1),
(291, 8, 'CON422', 'Tributación e Impuestos Sobre la Renta II', 'CON-421', 1),
(292, 8, 'MAT211', 'Cálculo I', '    MAT-132', 1),
(293, 8, 'CON312', 'Auditoria I', 'CON-231', 1),
(294, 8, 'CON323', 'Auditoria II', 'CON-312', 1),
(295, 8, 'CON324', 'Práctica de Contabilidad I', 'CON-321', 1),
(296, 8, 'CON325', 'Sistemas de Contabilidad', 'CON-376', 1),
(297, 8, 'CON427', 'Sistema de Contabilidad Gubernamental', 'CON-323', 1),
(298, 8, 'CON415', 'Práctica de Contabilidad II', 'CON 324', 1),
(299, 8, 'CON123', 'Contabilidad Computarizada  Práctica', 'CON-325', 1),
(300, 8, 'CON404', 'Finanzas Públicas', 'CON-427', 1),
(301, 8, 'CON423', 'Análisis e Introducción de Estados Financieros', 'CON-324', 1),
(302, 8, 'CON426', 'Contabilidad Gerencial', 'CON-123', 1),
(303, 8, 'CON425', 'Seminario de Contabilidad', 'CON-415', 1),
(304, 9, 'TUR121', 'Teoría y Técnica del Turismo I', 'BR.', 1),
(305, 9, 'TUR131', 'Teoría y Técnica del Turismo II/', 'TUR-121', 1),
(306, 9, 'TUR220', 'Geografía Turística Internacional', 'BR.', 1),
(307, 9, 'TUR135', 'Turismo Alternativo y Desarrollo Sostenible', 'TUR-131', 1),
(308, 9, 'TUR225', 'Gestión de Empresas Turísticas I', 'TUR-131', 1),
(309, 9, 'TUR231', 'Gestión de Empresas Turísticas  II', 'TUR-225', 1),
(310, 9, 'PPI003', 'Curso Propedéutico de  Inglés', 'BR.', 1),
(311, 9, 'TUR224', 'Estructura Hotelera', 'TUR-231', 1),
(312, 9, 'DER410', 'Legislación Laboral y Turística', 'BR.', 1),
(313, 9, 'TUR235', 'Planificación y Diseño de Productos Turísticos', 'TUR-231', 1),
(314, 9, 'SOC133', 'Geografía Turística de la Republica Dominica', 'BR.', 1),
(315, 9, 'ING111', 'Inglés Elemental I / Laboratorio', 'PPI-003', 1),
(316, 9, 'TUR327', 'Cultura, Folklore y Patrimonio Latinoamericano', 'BR.', 1),
(317, 9, 'TUR339', 'Etiqueta y Protocolo', 'TUR-231', 1),
(318, 9, 'ING112', 'Inglés Elemental II / Laboratorio', 'ING-111', 1),
(319, 9, 'ING122', 'Inglés Intermedio I / Laboratorio', 'ING-112', 1),
(320, 9, 'TUR336', ' Gestión de Establecimientos de Alimentos y Bebida', 'ADM-313', 1),
(321, 9, 'MER333', 'Mercados Turísticos', 'MER-133', 1),
(322, 9, 'TUR415', 'Estructura y Administración de Servicios de Viajes', 'TUR-231', 1),
(323, 9, 'ING131', 'Inglés Intermedio II / Laboratorio', 'ING-122', 1),
(324, 9, 'ING211', 'Inglés Avanzado I / Laboratorio', 'ING-131', 1),
(325, 9, 'TUR338', 'Higiene y Manipulación de Alimentos y Bebidas', 'ADM-336', 1),
(326, 9, 'ING221', 'Inglés Avanzado II / Laboratorio', 'ING-211', 1),
(327, 9, 'TUR337', 'Organización  de  Grupos y Eventos', 'TUR-339', 1),
(328, 9, 'ING227', 'Conversación Inglesa I', 'ING-221', 1),
(329, 9, 'TUR230', 'Gastronomía  Turística Nacional', 'TUR-338', 1),
(330, 9, 'ING327', 'Conversación Inglesa II', 'ING-227', 1),
(331, 9, 'PPF004', 'Curso Propedéutico de Francés', 'BR.', 1),
(332, 9, 'FRA113', 'Francés Elemental I / Laboratorio', 'PPF-004', 1),
(333, 9, 'FRA122', 'Francés Elemental II / Laboratorio', 'FRA-113', 1),
(334, 9, 'TUR330', 'Gastronomía Turística Internacional', '  TUR-338', 1),
(335, 9, 'TUR412', 'Seminario de Turismo', 'TUR-237', 1),
(336, 12, 'EDU427', 'Educación Musical', 'EDU-230', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compfacili`
--

CREATE TABLE `compfacili` (
  `id_compfacili` int(11) NOT NULL,
  `clave_comp` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_faci` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compfacili`
--

INSERT INTO `compfacili` (`id_compfacili`, `clave_comp`, `id_faci`) VALUES
(55, 'DER316    ', 1),
(56, 'DER326    ', 1),
(57, 'EDU420    ', 3),
(58, 'EDU427', 3),
(59, 'DER326', 2),
(61, 'EDU247', 4),
(62, 'SOC350', 4),
(63, 'SOC417', 4),
(64, 'SOC416', 4),
(65, 'INF113', 6),
(66, 'ISW233', 6),
(67, 'ISW315', 6),
(71, 'DER413', 2),
(72, 'DER329', 2),
(79, 'INF324', 8),
(81, 'INF251', 8),
(84, 'ING201', 9),
(85, 'ING203', 9),
(86, 'PRA300', 9),
(87, 'INF113', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conf_email`
--

CREATE TABLE `conf_email` (
  `id` int(11) NOT NULL,
  `smtpsecure` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `host` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `port` int(10) DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `setfrom` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `asunto` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subject` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `conf_email`
--

INSERT INTO `conf_email` (`id`, `smtpsecure`, `host`, `port`, `username`, `password`, `setfrom`, `asunto`, `subject`) VALUES
(1, 'ssl', 'smtp.gmail.com', 465, 'dionys.epson@gmail.com', '123456789', 'dionys.epson@gmail.com', 'Asignación De Facilitadores', 'Notificación de Asignacion de Facilitadores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `id_esc` int(11) NOT NULL,
  `des_esc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado_esc` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`id_esc`, `des_esc`, `estado_esc`) VALUES
(7, 'Escuela de Ingeniería y Tecnología', 1),
(8, 'Escuela de Negocios', 1),
(9, 'Escuela de Turismo', 1),
(11, 'Escuela de Ciencias Jurídicas y Políticas', 1),
(12, 'Escuela de Educación', 1),
(13, 'Todas Las Escuelas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facilihorario`
--

CREATE TABLE `facilihorario` (
  `id_hr` int(11) NOT NULL,
  `id_faci` int(12) NOT NULL,
  `dia` int(1) NOT NULL,
  `hi` time NOT NULL,
  `hf` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `facilihorario`
--

INSERT INTO `facilihorario` (`id_hr`, `id_faci`, `dia`, `hi`, `hf`) VALUES
(47, 6, 1, '08:00:00', '20:00:00'),
(48, 6, 7, '08:00:00', '20:00:00'),
(49, 4, 1, '08:00:00', '20:00:00'),
(50, 4, 7, '08:00:00', '20:00:00'),
(51, 3, 7, '08:00:00', '20:00:00'),
(52, 3, 1, '08:00:00', '20:00:00'),
(53, 1, 1, '08:00:00', '20:00:00'),
(54, 2, 1, '08:00:00', '20:00:00'),
(55, 2, 7, '08:00:00', '20:00:00'),
(56, 2, 5, '08:00:00', '20:00:00'),
(58, 8, 7, '08:00:00', '20:00:00'),
(59, 9, 5, '08:00:00', '20:00:00'),
(60, 9, 6, '08:00:00', '20:00:00'),
(61, 9, 7, '08:00:00', '20:00:00'),
(62, 8, 1, '08:00:00', '20:00:00'),
(63, 5, 7, '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facilitadores`
--

CREATE TABLE `facilitadores` (
  `id_faci` int(11) NOT NULL,
  `nom_faci` varchar(30) DEFAULT NULL,
  `apell_faci` varchar(30) DEFAULT NULL,
  `ced_faci` varchar(15) DEFAULT NULL,
  `date_faci` date DEFAULT NULL,
  `sex_faci` varchar(1) DEFAULT NULL,
  `tel_faci` varchar(15) DEFAULT NULL,
  `tel2_faci` varchar(50) DEFAULT NULL,
  `tel3_faci` varchar(50) DEFAULT NULL,
  `direcc_faci` varchar(100) DEFAULT NULL,
  `ocupa_faci` varchar(50) DEFAULT NULL,
  `est_civil_faci` varchar(1) DEFAULT NULL,
  `email_faci` varchar(50) DEFAULT NULL,
  `img_faci` varchar(50) DEFAULT NULL,
  `fec_faci` timestamp NULL DEFAULT current_timestamp(),
  `stado_faci` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facilitadores`
--

INSERT INTO `facilitadores` (`id_faci`, `nom_faci`, `apell_faci`, `ced_faci`, `date_faci`, `sex_faci`, `tel_faci`, `tel2_faci`, `tel3_faci`, `direcc_faci`, `ocupa_faci`, `est_civil_faci`, `email_faci`, `img_faci`, `fec_faci`, `stado_faci`) VALUES
(1, 'Aldo De Jesús', 'Peralta Lendof', '03100350482', '1975-01-05', 'm', '809-519-8540', '', '', 'Santiago', 'Maestría Derecho Internacional.', 'c', 'a.peralta.f@uapa.edu.do', NULL, '2020-03-07 23:02:38', 1),
(2, 'Emmy M. ', 'Reyes Rodríguez ', '03100580458', '1970-05-08', 'f', '829-580-3780', '', '', 'Santiago', 'Master Derecho Legal', 'c', 'e.reyes.f@uapa.edu.do', NULL, '2020-03-07 23:06:00', 1),
(3, 'Amarilis ', 'German', '03200806099', '1980-08-02', 'f', '849-648-0988', '', '', 'Santiago', 'Maestría En Educación Artística  ', 's', 'a.german.p@uapa.edu.do', NULL, '2020-03-07 23:12:50', 1),
(4, 'Efraín ', 'Cruz', '05400014545', '1990-12-15', 'm', '809-544-8065', '', '', 'La Vega', 'Doctorado ', 'd', 'e.cruz.f@uapa.edu.do', NULL, '2020-03-07 23:21:51', 1),
(5, 'Ana Miguelina ', 'Ortiz ', '03105587878', '1985-05-03', 'f', '809-488-2585', '', '', 'Santiago', 'Maestría ', 'p', 'a.ortiz.p@uapa.edu.do', NULL, '2020-03-07 23:35:27', 1),
(6, 'Concepción ', 'Ortiz López', '03105546545', '1983-12-04', 'm', '849-785-0035', '', '', 'Santiago', 'Maestría Programación', 'p', 'c.ortiz.f@uapa.edu.do', NULL, '2020-03-07 23:42:39', 1),
(8, 'Diógenes Amaury', 'Martínez Silverio', '05480804848', '1977-02-02', 'm', '809-588-4550', '', '', 'Santiago', 'Maestría Sistemas', 'c', 'Diogenes@gmail.com', NULL, '2020-03-08 01:56:38', 1),
(9, 'Ada ', 'Francisco ', '03100054849', '1970-08-11', 'f', '809-588-7550', '', '', 'Santiago', 'DIPLOMADO EN IDIOMAS', 's', 'ADA.FRANCISCO@GMAIL.COM', NULL, '2020-03-08 02:08:12', 1),
(15, 'Evelyn ', 'Delgado', '05501823232', '1986-05-12', 'f', '809-944-5321', '', '', 'Santiago', '', 's', 'evelyndelgado@gmail.com', NULL, '2020-03-19 04:40:58', 1);

--
-- Disparadores `facilitadores`
--
DELIMITER $$
CREATE TRIGGER `delete_facilitador` BEFORE DELETE ON `facilitadores` FOR EACH ROW BEGIN
  DELETE FROM compfacili WHERE OLD.id_faci = id_faci;
  DELETE FROM facilihorario WHERE OLD.id_faci = id_faci;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminarfacilitador` AFTER DELETE ON `facilitadores` FOR EACH ROW BEGIN
DELETE FROM compfacili WHERE old.id_faci = id_faci;
DELETE FROM facilihorario WHERE old.id_faci = id_faci;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_rep` int(12) NOT NULL,
  `id_esc` int(12) NOT NULL,
  `ciclo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `id_carga` int(12) NOT NULL,
  `clave_comp` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `seccion` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `aula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `dia` int(1) NOT NULL,
  `hi` time NOT NULL,
  `hf` time NOT NULL,
  `carga_esc` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `id_faci` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id_rep`, `id_esc`, `ciclo`, `id_carga`, `clave_comp`, `seccion`, `aula`, `dia`, `hi`, `hf`, `carga_esc`, `id_faci`) VALUES
(158, 13, '2020-1-3', 1868, 'DER329', '1', '1-A-401', 5, '18:00:00', '19:50:00', 'Derecho', 2),
(159, 13, '2020-1-3', 1869, 'DER329', '30', '1-A-406', 1, '08:00:00', '09:50:00', 'Derecho', 2),
(160, 13, '2020-1-3', 1870, 'DER413', '30', '1-A-407', 1, '10:10:00', '12:00:00', 'Derecho', 2),
(161, 13, '2020-1-3', 1871, 'DER316', '30', '1-A-403', 1, '08:00:00', '09:50:00', 'Derecho', 1),
(162, 13, '2020-1-3', 1872, 'DER326', '30', '1-A-401', 1, '10:10:00', '12:00:00', 'Derecho', 1),
(163, 13, '2020-1-3', 1874, 'EDU420', '10', '1-D-403', 7, '12:00:00', '14:00:00', 'Educación', 3),
(164, 13, '2020-1-3', 1875, 'EDU427', '10', '1-B-207', 7, '10:10:00', '12:00:00', 'Educación', 3),
(165, 13, '2020-1-3', 1876, 'EDU247', '10', '1-D-401', 7, '10:10:00', '12:00:00', 'Educación', 4),
(166, 13, '2020-1-3', 1877, 'SOC350', '10', '1-B-103', 7, '12:01:00', '14:00:00', 'Educación', 4),
(167, 13, '2020-1-3', 1878, 'SOC416', '20', '1-B-206', 7, '14:01:00', '15:50:00', 'Educación', 4),
(168, 13, '2020-1-3', 1879, 'SOC417', '10', '1-D-405', 7, '08:00:00', '09:50:00', 'Educación', 4),
(169, 13, '2020-1-3', 1880, 'INF113', '30', '1-LAB. ELE', 1, '08:00:00', '09:50:00', 'Ingenierria', 6),
(170, 13, '2020-1-3', 1881, 'ISW233', '10', '1-A-INF-01', 7, '12:00:00', '14:00:00', 'Ingenierria', 6),
(171, 13, '2020-1-3', 1882, 'ISW233', '30', '1-A-INF-01', 1, '12:00:00', '14:00:00', 'Ingenierria', 6),
(172, 13, '2020-1-3', 1883, 'ISW315', '20', '1-A-INF-03', 7, '14:00:00', '16:00:00', 'Ingenierria', 6),
(173, 13, '2020-1-3', 1884, 'INF251', '10', '1-D-INF-05', 7, '10:10:00', '12:00:00', 'Ingenierria', 8),
(174, 13, '2020-1-3', 1885, 'INF324', '10', '1-A-INF-04', 7, '08:00:00', '09:50:00', 'Ingenierria', 8),
(175, 13, '2020-1-3', 1886, 'PRA300', '25', '1-B-205', 7, '14:10:00', '15:50:00', 'Pasantía', 9),
(176, 13, '2020-1-3', 1887, 'ING201', '1', '1-B-201', 5, '16:10:00', '18:00:00', 'Idiomas', 9),
(177, 13, '2020-1-3', 1888, 'ING201', '10', '1-B-303', 7, '10:10:00', '12:00:00', 'Idiomas', 9),
(178, 13, '2020-1-3', 1889, 'ING201', 'GV70', 'VIRTUAL', 6, '11:43:00', '12:00:00', 'Idiomas', 9),
(179, 13, '2020-1-3', 1890, 'ING203', '12', '1-B-105', 7, '08:00:00', '09:50:00', 'Idiomas', 9),
(250, 13, '2020-2', 1963, 'DER329', '1', '1-A-401', 5, '18:00:00', '19:50:00', 'Derecho', 2),
(251, 13, '2020-2', 1964, 'DER329', '30', '1-A-406', 1, '08:00:00', '09:50:00', 'Derecho', 2),
(252, 13, '2020-2', 1965, 'DER413', '30', '1-A-407', 1, '10:10:00', '12:00:00', 'Derecho', 2),
(253, 13, '2020-2', 1966, 'DER316', '30', '1-A-403', 1, '08:00:00', '09:50:00', 'Derecho', 1),
(254, 13, '2020-2', 1967, 'DER326', '30', '1-A-401', 1, '10:10:00', '12:00:00', 'Derecho', 1),
(255, 13, '2020-2', 1969, 'EDU420', '10', '1-D-403', 7, '12:00:00', '14:00:00', 'Educación', 3),
(256, 13, '2020-2', 1970, 'EDU427', '10', '1-B-207', 7, '10:10:00', '12:00:00', 'Educación', 3),
(257, 13, '2020-2', 1971, 'EDU247', '10', '1-D-401', 7, '10:10:00', '12:00:00', 'Educación', 4),
(258, 13, '2020-2', 1972, 'SOC350', '10', '1-B-103', 7, '12:01:00', '14:00:00', 'Educación', 4),
(259, 13, '2020-2', 1973, 'SOC416', '20', '1-B-206', 7, '14:01:00', '15:50:00', 'Educación', 4),
(260, 13, '2020-2', 1974, 'SOC417', '10', '1-D-405', 7, '08:00:00', '09:50:00', 'Educación', 4),
(261, 13, '2020-2', 1975, 'INF113', '30', '1-LAB. ELE', 1, '08:00:00', '09:50:00', 'Ingenierria', 6),
(262, 13, '2020-2', 1976, 'ISW233', '10', '1-A-INF-01', 7, '12:00:00', '14:00:00', 'Ingenierria', 6),
(263, 13, '2020-2', 1977, 'ISW233', '30', '1-A-INF-01', 1, '12:00:00', '14:00:00', 'Ingenierria', 6),
(264, 13, '2020-2', 1978, 'ISW315', '20', '1-A-INF-03', 7, '14:00:00', '16:00:00', 'Ingenierria', 6),
(265, 13, '2020-2', 1979, 'INF251', '10', '1-D-INF-05', 7, '10:10:00', '12:00:00', 'Ingenierria', 8),
(266, 13, '2020-2', 1980, 'INF324', '10', '1-A-INF-04', 7, '08:00:00', '09:50:00', 'Ingenierria', 8),
(267, 13, '2020-2', 1981, 'PRA300', '25', '1-B-205', 7, '14:10:00', '15:50:00', 'Pasantía', 9),
(268, 13, '2020-2', 1982, 'ING201', '1', '1-B-201', 5, '16:10:00', '18:00:00', 'Idiomas', 9),
(269, 13, '2020-2', 1983, 'ING201', '10', '1-B-303', 7, '10:10:00', '12:00:00', 'Idiomas', 9),
(270, 13, '2020-2', 1984, 'ING201', 'GV70', 'VIRTUAL', 6, '11:43:00', '12:00:00', 'Idiomas', 9),
(271, 13, '2020-2', 1985, 'ING203', '12', '1-B-105', 7, '08:00:00', '09:50:00', 'Idiomas', 9),
(272, 13, '2020-2', 1986, 'INF113', '30', '1-LAB. ELE', 1, '12:00:00', '14:00:00', 'Ingenierria', 8),
(296, 13, '2020-3', 1987, 'DER329', '1', '1-A-401', 5, '18:00:00', '19:50:00', 'Derecho', 2),
(297, 13, '2020-3', 1988, 'DER329', '30', '1-A-406', 1, '08:00:00', '09:50:00', 'Derecho', 2),
(298, 13, '2020-3', 1989, 'DER413', '30', '1-A-407', 1, '10:10:00', '12:00:00', 'Derecho', 2),
(299, 13, '2020-3', 1990, 'DER316', '30', '1-A-403', 1, '08:00:00', '09:50:00', 'Derecho', 1),
(300, 13, '2020-3', 1991, 'DER326', '30', '1-A-401', 1, '10:10:00', '12:00:00', 'Derecho', 1),
(301, 13, '2020-3', 1993, 'EDU420', '10', '1-D-403', 7, '12:00:00', '14:00:00', 'Educación', 3),
(302, 13, '2020-3', 1994, 'EDU427', '10', '1-B-207', 7, '10:10:00', '12:00:00', 'Educación', 3),
(303, 13, '2020-3', 1995, 'EDU247', '10', '1-D-401', 7, '10:10:00', '12:00:00', 'Educación', 4),
(304, 13, '2020-3', 1996, 'SOC350', '10', '1-B-103', 7, '12:01:00', '14:00:00', 'Educación', 4),
(305, 13, '2020-3', 1997, 'SOC416', '20', '1-B-206', 7, '14:01:00', '15:50:00', 'Educación', 4),
(306, 13, '2020-3', 1998, 'SOC417', '10', '1-D-405', 7, '08:00:00', '09:50:00', 'Educación', 4),
(307, 13, '2020-3', 1999, 'INF113', '30', '1-LAB. ELE', 1, '08:00:00', '09:50:00', 'Ingenierria', 6),
(308, 13, '2020-3', 2000, 'ISW233', '10', '1-A-INF-01', 7, '12:00:00', '14:00:00', 'Ingenierria', 6),
(309, 13, '2020-3', 2001, 'ISW233', '30', '1-A-INF-01', 1, '12:00:00', '14:00:00', 'Ingenierria', 6),
(310, 13, '2020-3', 2002, 'ISW315', '20', '1-A-INF-03', 7, '14:00:00', '16:00:00', 'Ingenierria', 6),
(311, 13, '2020-3', 2003, 'INF251', '10', '1-D-INF-05', 7, '10:10:00', '12:00:00', 'Ingenierria', 8),
(312, 13, '2020-3', 2004, 'INF324', '10', '1-A-INF-04', 7, '08:00:00', '09:50:00', 'Ingenierria', 8),
(313, 13, '2020-3', 2005, 'PRA300', '25', '1-B-205', 7, '14:10:00', '15:50:00', 'Pasantía', 9),
(314, 13, '2020-3', 2006, 'ING201', '1', '1-B-201', 5, '16:10:00', '18:00:00', 'Idiomas', 9),
(315, 13, '2020-3', 2007, 'ING201', '10', '1-B-303', 7, '10:10:00', '12:00:00', 'Idiomas', 9),
(316, 13, '2020-3', 2008, 'ING201', 'GV70', 'VIRTUAL', 6, '11:43:00', '12:00:00', 'Idiomas', 9),
(317, 13, '2020-3', 2009, 'ING203', '12', '1-B-105', 7, '08:00:00', '09:50:00', 'Idiomas', 9),
(318, 13, '2020-3', 2010, 'INF113', '30', '1-LAB. ELE', 1, '12:00:00', '14:00:00', 'Ingenierria', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `last_name` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `sex` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `avatar` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `control` enum('admin','user') COLLATE latin1_spanish_ci NOT NULL DEFAULT 'user',
  `statu` int(1) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `name`, `last_name`, `password`, `email`, `sex`, `telefono`, `avatar`, `control`, `statu`, `date`) VALUES
(12, 'dionicio', 'dionicio', NULL, '3124ddfe8fdc75bdb6b307f300f4480704edc346', 'dionys.epson@gmail.com', NULL, NULL, NULL, 'admin', 1, '2020-02-25 03:07:11'),
(13, 'Héctor ', 'Héctor ', 'Duarte', 'ab9bbff2cd903a2cefef325a7d0c13335463ca23', 'hector.duarte056@gmail.com', 'm', NULL, NULL, 'admin', 1, '2020-02-27 23:21:06'),
(14, 'Lucy', 'Lucy', 'Duarte', 'f71385775f58771ede5a32ad0133be33fc402404', 'lucymarte@gmail.com', 'f', NULL, NULL, 'user', 1, '2020-03-02 22:49:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carga`
--
ALTER TABLE `carga`
  ADD PRIMARY KEY (`id_carga`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`id_comp`);

--
-- Indices de la tabla `compfacili`
--
ALTER TABLE `compfacili`
  ADD PRIMARY KEY (`id_compfacili`);

--
-- Indices de la tabla `conf_email`
--
ALTER TABLE `conf_email`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`id_esc`);

--
-- Indices de la tabla `facilihorario`
--
ALTER TABLE `facilihorario`
  ADD PRIMARY KEY (`id_hr`);

--
-- Indices de la tabla `facilitadores`
--
ALTER TABLE `facilitadores`
  ADD PRIMARY KEY (`id_faci`),
  ADD KEY `id_gne` (`id_faci`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_rep`),
  ADD UNIQUE KEY `id_carga` (`id_carga`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carga`
--
ALTER TABLE `carga`
  MODIFY `id_carga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2011;

--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
  MODIFY `id_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT de la tabla `compfacili`
--
ALTER TABLE `compfacili`
  MODIFY `id_compfacili` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `conf_email`
--
ALTER TABLE `conf_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `id_esc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `facilihorario`
--
ALTER TABLE `facilihorario`
  MODIFY `id_hr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `facilitadores`
--
ALTER TABLE `facilitadores`
  MODIFY `id_faci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_rep` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
