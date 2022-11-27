-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2022 a las 18:29:48
-- Versión del servidor: 10.5.15-MariaDB-0+deb11u1-log
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID del Material',
  `template` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'Template utilizado',
  `name` varchar(60) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Materiales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materialProperties`
--

CREATE TABLE `materialProperties` (
  `id` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID del material',
  `property` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID de la propiedad',
  `template` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID del template de la propiedad',
  `value` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'Valor de la propiedad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Propiedades del material';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `template`
--

CREATE TABLE `template` (
  `id` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID del template',
  `name` varchar(60) COLLATE utf8_bin NOT NULL COMMENT 'Nombre del template',
  `namePattern` text COLLATE utf8_bin NOT NULL COMMENT 'Patrón de nombrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Template de materiales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `templateProperties`
--

CREATE TABLE `templateProperties` (
  `id` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID de la propiedad en el template',
  `property` varchar(36) COLLATE utf8_bin NOT NULL COMMENT 'ID de la propiedad',
  `name` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'Nombre de la propiedad',
  `shortname` varchar(6) COLLATE utf8_bin NOT NULL COMMENT 'Nombre corto',
  `valueType` varchar(1) COLLATE utf8_bin NOT NULL COMMENT 'Tipo de valor',
  `options` text COLLATE utf8_bin NOT NULL COMMENT 'Valores admitidos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tempate de propiedades';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'ID',
  `username` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Nombre de usuario',
  `email` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'E-Mail',
  `password` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Contraseña',
  `authKey` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Key de sesión',
  `accessToken` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Token'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Listado de usuarios';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valueTypes`
--

CREATE TABLE `valueTypes` (
  `id` varchar(1) COLLATE utf8_bin NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tipos de valores';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_materialTemplate` (`template`);

--
-- Indices de la tabla `materialProperties`
--
ALTER TABLE `materialProperties`
  ADD PRIMARY KEY (`id`,`property`),
  ADD KEY `template` (`template`);

--
-- Indices de la tabla `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `templateProperties`
--
ALTER TABLE `templateProperties`
  ADD PRIMARY KEY (`id`,`property`),
  ADD KEY `fk_valueType` (`valueType`),
  ADD KEY `property` (`property`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valueTypes`
--
ALTER TABLE `valueTypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_materialTemplate` FOREIGN KEY (`template`) REFERENCES `template` (`id`);

--
-- Filtros para la tabla `materialProperties`
--
ALTER TABLE `materialProperties`
  ADD CONSTRAINT `fk_materialID` FOREIGN KEY (`id`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `fk_materialPropertyTemplate` FOREIGN KEY (`template`) REFERENCES `templateProperties` (`property`);

--
-- Filtros para la tabla `templateProperties`
--
ALTER TABLE `templateProperties`
  ADD CONSTRAINT `fk_templateID` FOREIGN KEY (`id`) REFERENCES `template` (`id`),
  ADD CONSTRAINT `fk_valueType` FOREIGN KEY (`valueType`) REFERENCES `valueTypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
