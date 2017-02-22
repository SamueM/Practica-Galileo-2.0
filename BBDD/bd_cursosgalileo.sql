-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2017 a las 18:50:44
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cursosgalileo`
--
CREATE DATABASE IF NOT EXISTS `bd_cursosgalileo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_cursosgalileo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `activo` enum('si','no') NOT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `id_usuario`, `titulo`, `descripcion`, `fecha_creacion`, `activo`, `foto`) VALUES
(1, 3, 'prueba 1', 'lorem ipsum amet', '2017-12-01', 'si', NULL),
(2, 3, 'prueba 2', 'lorem ipsum amet', '2017-12-01', 'si', NULL),
(3, 6, 'PHP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'php.png'),
(4, 7, 'Javascript', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'java.png'),
(5, 8, 'Diseño de Interfaces', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'interfaces.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscritos_curso`
--

CREATE TABLE `inscritos_curso` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `favorito` enum('si','no') NOT NULL,
  `cursando` enum('si','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inscritos_curso`
--

INSERT INTO `inscritos_curso` (`id_usuario`, `id_curso`, `favorito`, `cursando`) VALUES
(3, 1, 'no', 'si'),
(4, 1, 'no', 'si'),
(5, 3, 'si', 'si'),
(5, 4, 'si', 'si'),
(5, 5, 'si', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `activo` enum('si','no') NOT NULL,
  `url` varchar(200) NOT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id_tema`, `id_curso`, `titulo`, `descripcion`, `fecha_creacion`, `activo`, `url`, `foto`) VALUES
(1, 1, 'Tema 1', 'lorem ipsum amet', '2017-02-24', 'si', 'pdf.1', NULL),
(2, 1, 'Desarrollo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'tema2.pdf', NULL),
(3, 1, 'Conclusion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'tema3.pdf', NULL),
(4, 2, 'Introduccion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'php1.pdf', NULL),
(5, 2, 'Desarrollo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'php2.pdf', NULL),
(6, 2, 'Conclusion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'php3.pdf', NULL),
(7, 3, 'Introduccion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'js1.pdf', NULL),
(8, 3, 'Desarrollo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'js2.pdf', NULL),
(9, 3, 'Conclusion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'js3.pdf', NULL),
(10, 4, 'Introduccion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'interfaces1.pdf', NULL),
(11, 4, 'Desarrollo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'interfaces2.pdf', NULL),
(12, 4, 'Conclusion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean viverra, mauris non commodo dignissim, nunc ligula ultrices mauris, sed lacinia est tortor non urna. Duis porta efficitur tellus non ull', '2017-02-20', 'si', 'interfaces3.pdf', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `id_tipo_usuario` int(2) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `nombre`, `descripcion`) VALUES
(1, 'Super_Admin', 'Administrador súper.Sube a los usuarios de rango.'),
(2, 'Administrador', 'Cambian de rango a los usuarios(pasar de alumno a editor). Pueden activar/desactivar Usuarios, Módulos y Temas.'),
(3, 'Editor', 'Editor de cursos(profesor), puede crear su propio curso/módulo y subir sus propios temas.'),
(4, 'Suscriptor', 'Usuario registrado, puede acceder al los temas y valorar los temas del curso en el que está inscrito.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(2) NOT NULL,
  `nick` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `mail` varchar(100) NOT NULL,
  `telefono` int(9) DEFAULT NULL,
  `pass` varchar(100) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `activo` enum('si','no') NOT NULL,
  `solicita_edicion` enum('si','no') NOT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `nick`, `nombre`, `apellidos`, `mail`, `telefono`, `pass`, `fecha_nac`, `activo`, `solicita_edicion`, `foto`) VALUES
(1, 1, 'super', 'Super_Admin', '', 'super@galileo.es', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'si', 'no', NULL),
(2, 2, 'admin', 'Administrador', '', 'admin@galileo.es', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'si', 'no', NULL),
(3, 3, 'profe1', 'Profe1', '', 'profe1@galileo.es', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'si', 'no', NULL),
(4, 4, 'alumno1', 'Alumno1', '', 'alumno1@galileo.es', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'si', 'no', NULL),
(5, 4, 'alumno2', 'Alumno2', '', 'alumno2@galileo.es', 0, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'si', 'si', NULL),
(6, 3, 'Nicolas', 'Nicolas', 'Fdez Arellano', 'nicolas@gmail.com', 983659832, '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00', 'si', 'si', NULL),
(7, 3, 'David', 'David', 'Marín Álvarez', 'david@gmail.com', 626359585, '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00', 'si', 'si', NULL),
(8, 3, 'Angel', 'Angel', 'T. Domínguez', 'angel@gmail.com', 987589647, '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00', 'si', 'si', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id_usuario` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `voto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id_usuario`, `id_tema`, `voto`, `fecha`) VALUES
(3, 1, 5, '2017-02-17'),
(4, 1, 3, '2017-02-17'),
(5, 5, 5, '2017-02-20'),
(5, 6, 5, '2017-02-20'),
(5, 7, 5, '2017-02-20'),
(5, 8, 5, '2017-02-20'),
(5, 9, 5, '2017-02-20'),
(5, 10, 4, '2017-02-20'),
(5, 11, 1, '2017-02-20'),
(5, 12, 2, '2017-02-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `inscritos_curso`
--
ALTER TABLE `inscritos_curso`
  ADD PRIMARY KEY (`id_usuario`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nick` (`nick`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_usuario`,`id_tema`),
  ADD KEY `id_tema` (`id_tema`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `inscritos_curso`
--
ALTER TABLE `inscritos_curso`
  ADD CONSTRAINT `inscritos_curso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `inscritos_curso_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`);

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `inscritos_curso` (`id_usuario`),
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
