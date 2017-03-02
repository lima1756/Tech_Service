-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2017 a las 04:21:01
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tech_service`
--
CREATE DATABASE IF NOT EXISTS `tech_service` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tech_service`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `tamanio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Afganistán'),
(2, 'Akrotiri'),
(3, 'Albania'),
(4, 'Alemania'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguila'),
(8, 'Antártida'),
(9, 'Antigua y Barbuda'),
(10, 'Antillas Neerlandesas'),
(11, 'Arabia Saudí'),
(12, 'Arctic Ocean'),
(13, 'Argelia'),
(14, 'Argentina'),
(15, 'Armenia'),
(16, 'Aruba'),
(17, 'Ashmore and Cartier Islands'),
(18, 'Atlantic Ocean'),
(19, 'Australia'),
(20, 'Austria'),
(21, 'Azerbaiyán'),
(22, 'Bahamas'),
(23, 'Bahráin'),
(24, 'Bangladesh'),
(25, 'Barbados'),
(26, 'Bélgica'),
(27, 'Belice'),
(28, 'Benín'),
(29, 'Bermudas'),
(30, 'Bielorrusia'),
(31, 'Birmania; Myanmar'),
(32, 'Bolivia'),
(33, 'Bosnia y Hercegovina'),
(34, 'Botsuana'),
(35, 'Brasil'),
(36, 'Brunéi'),
(37, 'Bulgaria'),
(38, 'Burkina Faso'),
(39, 'Burundi'),
(40, 'Bután'),
(41, 'Cabo Verde'),
(42, 'Camboya'),
(43, 'Camerún'),
(44, 'Canadá'),
(45, 'Chad'),
(46, 'Chile'),
(47, 'China'),
(48, 'Chipre'),
(49, 'Clipperton Island'),
(50, 'Colombia'),
(51, 'Comoras'),
(52, 'Congo'),
(53, 'Coral Sea Islands'),
(54, 'Corea del Norte'),
(55, 'Corea del Sur'),
(56, 'Costa de Marfil'),
(57, 'Costa Rica'),
(58, 'Croacia'),
(59, 'Cuba'),
(60, 'Dhekelia'),
(61, 'Dinamarca'),
(62, 'Dominica'),
(63, 'Ecuador'),
(64, 'Egipto'),
(65, 'El Salvador'),
(66, 'El Vaticano'),
(67, 'Emiratos Árabes Unidos'),
(68, 'Eritrea'),
(69, 'Eslovaquia'),
(70, 'Eslovenia'),
(71, 'España'),
(72, 'Estados Unidos'),
(73, 'Estonia'),
(74, 'Etiopía'),
(75, 'Filipinas'),
(76, 'Finlandia'),
(77, 'Fiyi'),
(78, 'Francia'),
(79, 'Gabón'),
(80, 'Gambia'),
(81, 'Gaza Strip'),
(82, 'Georgia'),
(83, 'Ghana'),
(84, 'Gibraltar'),
(85, 'Granada'),
(86, 'Grecia'),
(87, 'Groenlandia'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guernsey'),
(91, 'Guinea'),
(92, 'Guinea Ecuatorial'),
(93, 'Guinea-Bissau'),
(94, 'Guyana'),
(95, 'Haití'),
(96, 'Honduras'),
(97, 'Hong Kong'),
(98, 'Hungría'),
(99, 'India'),
(100, 'Indian Ocean'),
(101, 'Indonesia'),
(102, 'Irán'),
(103, 'Iraq'),
(104, 'Irlanda'),
(105, 'Isla Bouvet'),
(106, 'Isla Christmas'),
(107, 'Isla Norfolk'),
(108, 'Islandia'),
(109, 'Islas Caimán'),
(110, 'Islas Cocos'),
(111, 'Islas Cook'),
(112, 'Islas Feroe'),
(113, 'Islas Georgia del Sur y Sandwich del Sur'),
(114, 'Islas Heard y McDonald'),
(115, 'Islas Malvinas'),
(116, 'Islas Marianas del Norte'),
(117, 'Islas Marshall'),
(118, 'Islas Pitcairn'),
(119, 'Islas Salomón'),
(120, 'Islas Turcas y Caicos'),
(121, 'Islas Vírgenes Americanas'),
(122, 'Islas Vírgenes Británicas'),
(123, 'Israel'),
(124, 'Italia'),
(125, 'Jamaica'),
(126, 'Jan Mayen'),
(127, 'Japón'),
(128, 'Jersey'),
(129, 'Jordania'),
(130, 'Kazajistán'),
(131, 'Kenia'),
(132, 'Kirguizistán'),
(133, 'Kiribati'),
(134, 'Kuwait'),
(135, 'Laos'),
(136, 'Lesoto'),
(137, 'Letonia'),
(138, 'Líbano'),
(139, 'Liberia'),
(140, 'Libia'),
(141, 'Liechtenstein'),
(142, 'Lituania'),
(143, 'Luxemburgo'),
(144, 'Macao'),
(145, 'Macedonia'),
(146, 'Madagascar'),
(147, 'Malasia'),
(148, 'Malaui'),
(149, 'Maldivas'),
(150, 'Malí'),
(151, 'Malta'),
(152, 'Man, Isle of'),
(153, 'Marruecos'),
(154, 'Mauricio'),
(155, 'Mauritania'),
(156, 'Mayotte'),
(157, 'México'),
(158, 'Micronesia'),
(159, 'Moldavia'),
(160, 'Mónaco'),
(161, 'Mongolia'),
(162, 'Montenegro'),
(163, 'Montserrat'),
(164, 'Mozambique'),
(165, 'Mundo'),
(166, 'Namibia'),
(167, 'Nauru'),
(168, 'Navassa Island'),
(169, 'Nepal'),
(170, 'Nicaragua'),
(171, 'Níger'),
(172, 'Nigeria'),
(173, 'Niue'),
(174, 'Noruega'),
(175, 'Nueva Caledonia'),
(176, 'Nueva Zelanda'),
(177, 'Omán'),
(178, 'Pacific Ocean'),
(179, 'Países Bajos'),
(180, 'Pakistán'),
(181, 'Palaos'),
(182, 'Panamá'),
(183, 'Papúa-Nueva Guinea'),
(184, 'Paracel Islands'),
(185, 'Paraguay'),
(186, 'Perú'),
(187, 'Polinesia Francesa'),
(188, 'Polonia'),
(189, 'Portugal'),
(190, 'Puerto Rico'),
(191, 'Qatar'),
(192, 'Reino Unido'),
(193, 'República Centroafricana'),
(194, 'República Checa'),
(195, 'República Democrática del Congo'),
(196, 'República Dominicana'),
(197, 'Ruanda'),
(198, 'Rumania'),
(199, 'Rusia'),
(200, 'Sáhara Occidental'),
(201, 'Samoa'),
(202, 'Samoa Americana'),
(203, 'San Cristóbal y Nieves'),
(204, 'San Marino'),
(205, 'San Pedro y Miquelón'),
(206, 'San Vicente y las Granadinas'),
(207, 'Santa Helena'),
(208, 'Santa Lucía'),
(209, 'Santo Tomé y Príncipe'),
(210, 'Senegal'),
(211, 'Serbia'),
(212, 'Seychelles'),
(213, 'Sierra Leona'),
(214, 'Singapur'),
(215, 'Siria'),
(216, 'Somalia'),
(217, 'Southern Ocean'),
(218, 'Spratly Islands'),
(219, 'Sri Lanka'),
(220, 'Suazilandia'),
(221, 'Sudáfrica'),
(222, 'Sudán'),
(223, 'Suecia'),
(224, 'Suiza'),
(225, 'Surinam'),
(226, 'Svalbard y Jan Mayen'),
(227, 'Tailandia'),
(228, 'Taiwán'),
(229, 'Tanzania'),
(230, 'Tayikistán'),
(231, 'Territorio Británico del Océano Indico'),
(232, 'Territorios Australes Franceses'),
(233, 'Timor Oriental'),
(234, 'Togo'),
(235, 'Tokelau'),
(236, 'Tonga'),
(237, 'Trinidad y Tobago'),
(238, 'Túnez'),
(239, 'Turkmenistán'),
(240, 'Turquía'),
(241, 'Tuvalu'),
(242, 'Ucrania'),
(243, 'Uganda'),
(244, 'Unión Europea'),
(245, 'Uruguay'),
(246, 'Uzbekistán'),
(247, 'Vanuatu'),
(248, 'Venezuela'),
(249, 'Vietnam'),
(250, 'Wake Island'),
(251, 'Wallis y Futuna'),
(252, 'West Bank'),
(253, 'Yemen'),
(254, 'Yibuti'),
(255, 'Zambia'),
(256, 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('Nuevo','Espera','Diferido','Completado','Sin resolver') COLLATE utf8_unicode_ci NOT NULL,
  `detalles` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `fecha_hora`, `estado`, `detalles`) VALUES
(1, '2017-02-19 16:12:05', 'Completado', 'afdsfasdf\r\nzxcczxc'),
(2, '2017-02-19 16:12:05', 'Sin resolver', NULL),
(4, '2017-02-20 18:34:47', 'Nuevo', 'affdsds asdfasf \r\n524242\r\nsadas'),
(5, '2017-02-21 18:40:38', 'Nuevo', NULL),
(6, '2017-03-01 21:48:25', 'Nuevo', NULL),
(7, '2017-03-01 21:49:28', 'Nuevo', NULL),
(8, '2017-03-01 21:53:34', 'Nuevo', NULL),
(9, '2017-03-01 21:57:18', 'Nuevo', NULL),
(10, '2017-03-01 21:57:37', 'Nuevo', NULL),
(11, '2017-03-01 21:59:40', 'Nuevo', NULL),
(12, '2017-03-01 21:59:59', 'Nuevo', NULL),
(13, '2017-03-01 22:03:37', 'Nuevo', NULL),
(14, '2017-03-01 22:03:55', 'Nuevo', NULL),
(15, '2017-03-01 22:04:27', 'Nuevo', NULL),
(16, '2017-03-01 22:05:06', 'Nuevo', NULL),
(17, '2017-03-01 22:05:37', 'Nuevo', NULL),
(18, '2017-03-01 22:07:59', 'Nuevo', NULL),
(19, '2017-03-01 22:08:20', 'Nuevo', NULL),
(20, '2017-03-01 22:10:09', 'Nuevo', NULL),
(21, '2017-03-01 22:11:26', 'Nuevo', NULL),
(22, '2017-03-01 22:11:49', 'Nuevo', NULL),
(23, '2017-03-01 22:12:36', 'Nuevo', NULL),
(24, '2017-03-01 22:14:49', 'Nuevo', NULL),
(25, '2017-03-01 22:15:06', 'Nuevo', NULL),
(26, '2017-03-01 22:15:40', 'Nuevo', NULL),
(27, '2017-03-01 22:17:36', 'Nuevo', NULL),
(28, '2017-03-01 22:18:56', 'Nuevo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_anteriors`
--

CREATE TABLE `estado_anteriors` (
  `id_estado_ant` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_hora_cambio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgs_knowledge`
--

CREATE TABLE `imgs_knowledge` (
  `id` int(11) NOT NULL,
  `id_knowledge` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgs_tickets`
--

CREATE TABLE `imgs_tickets` (
  `id_img` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `imgs_tickets`
--

INSERT INTO `imgs_tickets` (`id_img`, `id_ticket`, `nombre`, `extension`) VALUES
(3, 7, 'CQ4aFwmWByGD3o5x0rXDO43qIdZZouagzRETDLfB.jpeg', 'jpeg'),
(4, 8, 'bu9dPmlREFGSRnu9CJ5cmXUdjWBaf5xov1Ra8UeE.jpeg', 'jpeg'),
(5, 9, 'QHMNf40HVQaTSC4cUOQbAXNguHpC6nbIYVqNjUkX.jpeg', 'jpeg'),
(6, 10, 'Y3emDD2SB82wkQOC3wuETqpZmBEFsbdpKGDEohtS.jpeg', 'jpeg'),
(7, 17, 'B8DBJ5a0RUqpsYr4iWJbNjLyE9yrTY7R2JIWBkvd.jpeg', 'jpeg'),
(8, 30, 'O8rlxIHkcI5XUnyMVEv0t7kqxMfiBmoNazfaG965.jpeg', 'jpeg'),
(9, 31, '5kLQJYuy5ySW9C0ZBFkThNTymhkVMJf1aBrEd2ru.jpeg', 'jpeg'),
(10, 32, '6rcvl4ggW3KSjORn2yY26oDNHLWR6o6kN9od9rLL.jpeg', 'jpeg'),
(11, 33, 'alwkVCpTVFwn0dXCx14neogPOu4NfyrRnwkmmQk9.jpeg', 'jpeg'),
(12, 34, '2IXBVtDrTJPcnpaCPfSm4iKGo5nOrTsb3bgi821c.jpeg', 'jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `knowledge`
--

CREATE TABLE `knowledge` (
  `id` int(11) NOT NULL,
  `pregunta` text COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` text COLLATE utf8_unicode_ci NOT NULL,
  `id_superuser` int(11) NOT NULL,
  `tema` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `knowledge`
--

INSERT INTO `knowledge` (`id`, `pregunta`, `respuesta`, `id_superuser`, `tema`) VALUES
(1, '¿Puedo eliminar System32?', 'No, no lo haga, son archivos escenciales del sistema.', 5504, 'Sistema'),
(2, '¿Me pide actualizar lo hago?', 'Si y solo si es una alerta del sistema y esta seguro que lo es, en caso contrario genere un ticket.', 5504, 'Sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamadas`
--

CREATE TABLE `llamadas` (
  `id_llamada` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_su` int(11) NOT NULL,
  `detalles` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `llamadas`
--

INSERT INTO `llamadas` (`id_llamada`, `fecha_hora`, `id_ticket_su`, `detalles`) VALUES
(1, '2017-02-23 18:44:56', 9, 'hsdgfsdg'),
(2, '2017-02-23 18:47:04', 9, 'hsdgfsdg\n\rsdfsafadfsdf'),
(3, '2017-02-23 18:54:53', 9, 'asdasdas'),
(4, '2017-02-23 18:54:55', 9, 'asdasdasdas'),
(5, '2017-02-23 18:54:57', 9, 'asdasdasd'),
(6, '2017-02-23 18:54:59', 9, 'asdasdasd'),
(7, '2017-02-23 18:55:01', 9, 'asdasdas'),
(8, '2017-02-23 18:55:03', 9, 'asdasdas'),
(9, '2017-02-23 18:55:19', 9, 'asdsdsa'),
(10, '2017-02-24 19:34:17', 13, 'fasdfads'),
(11, '2017-02-24 19:34:19', 13, 'asdfasdf'),
(12, '2017-02-24 19:34:20', 13, 'asdfadsf'),
(13, '2017-02-24 19:34:22', 13, 'sadfasdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mortals`
--

CREATE TABLE `mortals` (
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mortals`
--

INSERT INTO `mortals` (`id_usuario`) VALUES
(5200),
(5503),
(5505);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_su` int(11) NOT NULL,
  `id_SU` int(11) NOT NULL,
  `mensaje` text COLLATE utf8_unicode_ci NOT NULL,
  `id_nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `fecha_hora`, `id_ticket_su`, `id_SU`, `mensaje`, `id_nota`) VALUES
(1, '2017-02-22 18:36:40', 9, 5504, '4536456456546', NULL),
(2, '2017-02-22 18:36:54', 9, 5504, '546345245', 1),
(3, '2017-02-22 18:57:49', 9, 5504, 'fghdhdf', 2),
(4, '2017-02-22 19:49:48', 9, 5504, 'asdasdasd', 3),
(5, '2017-02-22 19:57:07', 9, 5504, 'Este comentario es serio :3', 4),
(6, '2017-02-24 19:34:01', 13, 5504, 'asdasdasd', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superusers`
--

CREATE TABLE `superusers` (
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `superusers`
--

INSERT INTO `superusers` (`id_usuario`) VALUES
(5504);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_mortal` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pregunta` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `id_mortal`, `fecha_hora`, `pregunta`, `descripcion`) VALUES
(17, 5505, '2017-02-19 17:00:34', 'Mi preguntita', 'Una descripcion'),
(28, 5505, '2017-02-20 18:34:47', '123456798', '987654321'),
(29, 5505, '2017-02-21 18:40:38', 'asdfadfasdfasdfadsf', 'asdf\r\nasdf\r\nasdf\r\nasdf'),
(30, 5505, '2017-03-01 21:48:25', 'dsafsfdfasdfasd', 'czxvzvzxcvzxc'),
(31, 5505, '2017-03-01 21:49:28', 'dsafsfdfasdfasd', 'czxvzvzxcvzxc'),
(32, 5505, '2017-03-01 21:53:34', 'dsafsfdfasdfasd', 'czxvzvzxcvzxc'),
(33, 5505, '2017-03-01 21:57:18', 'dsafsfdfasdfasd', 'czxvzvzxcvzxc'),
(34, 5505, '2017-03-01 21:57:37', 'dsafsfdfasdfasd', 'czxvzvzxcvzxc'),
(35, 5505, '2017-03-01 21:59:40', 'vvffsvf', 'sfsdgsdg'),
(36, 5505, '2017-03-01 21:59:59', 'vvffsvf', 'sfsdgsdg'),
(37, 5505, '2017-03-01 22:03:37', 'vzcxvxcvzxc', 'asdfafs'),
(38, 5505, '2017-03-01 22:03:55', 'mmmmmmmmmmm', 'mmnmn'),
(39, 5505, '2017-03-01 22:04:27', 'mmmmmnnnnnnnnnnn', 'mmmmmmmm'),
(40, 5505, '2017-03-01 22:05:06', '1111111', '1111111111111111111'),
(41, 5505, '2017-03-01 22:05:37', '2121', '12121'),
(42, 5505, '2017-03-01 22:07:59', 'czxczxczx', 'zvzxczx'),
(43, 5505, '2017-03-01 22:08:19', 'bxcvbxcvb', 'cvxbcxv'),
(44, 5505, '2017-03-01 22:10:09', 'zxcvzxc', 'vzxcvxzcv'),
(45, 5505, '2017-03-01 22:11:26', 'zxcvzxcv', 'zxcvzxcv'),
(46, 5505, '2017-03-01 22:11:49', 'czxcvxzc', 'cxzvx'),
(47, 5505, '2017-03-01 22:12:36', 'bncnb', 'bncxn'),
(48, 5505, '2017-03-01 22:14:49', 'xcvbxcv', 'bxcvbxcvb'),
(49, 5505, '2017-03-01 22:15:06', 'cvnc', 'vcncvnvbn'),
(50, 5505, '2017-03-01 22:15:40', 'vxcbc', 'vbxcvbv'),
(51, 5505, '2017-03-01 22:17:36', 'zxcvzxcvzxcv', 'zxcvxzcv'),
(52, 5505, '2017-03-01 22:18:56', 'zxcvzxcvxcz', 'zxcvzxcv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_sus`
--

CREATE TABLE `ticket_sus` (
  `id_ticketSU` int(11) NOT NULL,
  `id_SU` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `porcentaje` int(11) NOT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `prioridad` enum('alto','medio','bajo') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_sus`
--

INSERT INTO `ticket_sus` (`id_ticketSU`, `id_SU`, `id_ticket`, `fecha_hora`, `porcentaje`, `id_estado`, `prioridad`) VALUES
(9, 5504, 17, '2017-02-22 20:32:24', 5, 1, 'medio'),
(13, 5504, 28, '2017-02-22 20:36:06', 0, 4, 'alto'),
(14, 5500, 29, '2017-02-21 18:40:38', 0, 5, NULL),
(15, 5504, 30, '2017-03-01 21:48:25', 0, 6, NULL),
(16, 5504, 31, '2017-03-01 21:49:28', 0, 7, NULL),
(17, 5504, 32, '2017-03-01 21:53:34', 0, 8, NULL),
(18, 5504, 33, '2017-03-01 21:57:18', 0, 9, NULL),
(19, 5504, 34, '2017-03-01 21:57:37', 0, 10, NULL),
(20, 5504, 35, '2017-03-01 21:59:40', 0, 11, NULL),
(21, 5504, 36, '2017-03-01 21:59:59', 0, 12, NULL),
(22, 5504, 37, '2017-03-01 22:03:37', 0, 13, NULL),
(23, 5504, 38, '2017-03-01 22:03:55', 0, 14, NULL),
(24, 5504, 39, '2017-03-01 22:04:27', 0, 15, NULL),
(25, 5504, 40, '2017-03-01 22:05:06', 0, 16, NULL),
(26, 5504, 41, '2017-03-01 22:05:37', 0, 17, NULL),
(27, 5504, 42, '2017-03-01 22:07:59', 0, 18, NULL),
(28, 5504, 43, '2017-03-01 22:08:20', 0, 19, NULL),
(29, 5504, 44, '2017-03-01 22:10:09', 0, 20, NULL),
(30, 5504, 45, '2017-03-01 22:11:26', 0, 21, NULL),
(31, 5504, 46, '2017-03-01 22:11:49', 0, 22, NULL),
(32, 5504, 47, '2017-03-01 22:12:36', 0, 23, NULL),
(33, 5504, 48, '2017-03-01 22:14:49', 0, 24, NULL),
(34, 5504, 49, '2017-03-01 22:15:06', 0, 25, NULL),
(35, 5504, 50, '2017-03-01 22:15:40', 0, 26, NULL),
(36, 5504, 51, '2017-03-01 22:17:36', 0, 27, NULL),
(37, 5504, 52, '2017-03-01 22:18:56', 0, 28, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(61) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `areaTrabajo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `trabajo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_region` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nombre`, `apellido`, `cel`, `tel`, `ext`, `areaTrabajo`, `trabajo`, `id_region`, `remember_token`) VALUES
(5200, 'asdasd@asd.com', 'asdf', 'asdf', 'sadf', 'ads', 'asdf', 'asd', 'asf', 'asdf', 55, NULL),
(5500, '1@1.com', '123', '123', '123', '123', '123', '123', '123', '123', 123, NULL),
(5501, 'a@gmail.com', '123456789', 'Luis Iván', 'Morett Arévalo', '3311516589', '38254926', '123', 'una area', 'la empresa', 75, NULL),
(5503, 'l@l.com', '123123123', '654987', '789456', '123000', '00000', '99999', '9999', '6666', 1, NULL),
(5504, 'luisivanmorett@hotmail.com', '$2y$10$KZhWELgALLT9P7LyC/Mvwea5FnKJf4Ef733QDXJFDVpjMAtop8.oS', '123', '123', '123123', '123123', '12', '123123', '123123', 17, '2vZBawdXdDoIEs2ZJfEstoCKeEK0JP4J6JikxwgN0Wc0XA2giim4YscScP6E'),
(5505, 'luisivanmorett@gmail.com', '$2y$10$5TASH5o6wlg6bW48gqRBQO4.N0dixHHVYyDizCMzH.Ghnp9WshdcW', '231231123', '123123123', '123123123', '123123123', '123', '123123123', '123123123', 75, 'i907XBXEG4ojyPsnDGWyKBWw9hcacvpFol7Z5rMxBx8Kpu2zLZjz6tW8etVd');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `id_nota` (`id_nota`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`),
  ADD KEY `fecha_hora` (`fecha_hora`);

--
-- Indices de la tabla `estado_anteriors`
--
ALTER TABLE `estado_anteriors`
  ADD PRIMARY KEY (`id_estado_ant`);

--
-- Indices de la tabla `imgs_knowledge`
--
ALTER TABLE `imgs_knowledge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_knowledge` (`id_knowledge`);

--
-- Indices de la tabla `imgs_tickets`
--
ALTER TABLE `imgs_tickets`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_superuser` (`id_superuser`);

--
-- Indices de la tabla `llamadas`
--
ALTER TABLE `llamadas`
  ADD PRIMARY KEY (`id_llamada`),
  ADD KEY `id_ticket_su` (`id_ticket_su`);

--
-- Indices de la tabla `mortals`
--
ALTER TABLE `mortals`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ticket_su` (`id_ticket_su`),
  ADD KEY `id_nota` (`id_nota`),
  ADD KEY `id_SU` (`id_SU`);

--
-- Indices de la tabla `superusers`
--
ALTER TABLE `superusers`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `ticket_sus`
--
ALTER TABLE `ticket_sus`
  ADD PRIMARY KEY (`id_ticketSU`),
  ADD KEY `id_SU` (`id_SU`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_region` (`id_region`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `estado_anteriors`
--
ALTER TABLE `estado_anteriors`
  MODIFY `id_estado_ant` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imgs_tickets`
--
ALTER TABLE `imgs_tickets`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `llamadas`
--
ALTER TABLE `llamadas`
  MODIFY `id_llamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `ticket_sus`
--
ALTER TABLE `ticket_sus`
  MODIFY `id_ticketSU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5506;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
