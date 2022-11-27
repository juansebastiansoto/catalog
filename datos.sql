-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2022 a las 18:30:08
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

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id`, `template`, `name`) VALUES
('003d6308-4ead-4404-b466-b85d15147762', 'ddea6120-c295-4313-b018-bd9f9a89ac17', 'Bulón_TROSCAAcme'),
('4f73403f-27de-4e17-af2b-e957f6fc400b', 'ddea6120-c295-4313-b018-bd9f9a89ac17', 'Bulón_TROSCAAcme_ACREST20'),
('569ea8ad-8ca2-4cc3-a535-011fef566734', 'ddea6120-c295-4313-b018-bd9f9a89ac17', 'Bulón_TROSCAAcme_ACREST10');

--
-- Volcado de datos para la tabla `materialProperties`
--

INSERT INTO `materialProperties` (`id`, `property`, `template`, `value`) VALUES
('003d6308-4ead-4404-b466-b85d15147762', '212628df-3977-4f19-8459-80bb407a05ef', 'c8a8a4dc-4a3d-4b1f-843e-16f717c86aff', 'acme'),
('4f73403f-27de-4e17-af2b-e957f6fc400b', 'e3a5c079-aa3f-4c4e-96d2-b59945364c63', 'c8a8a4dc-4a3d-4b1f-843e-16f717c86aff', 'Acme'),
('4f73403f-27de-4e17-af2b-e957f6fc400b', 'e891a763-03dd-45ef-92d4-2ddfdca2336a', '50a3f31a-6983-496a-87e5-faf7526de6bc', '20'),
('569ea8ad-8ca2-4cc3-a535-011fef566734', 'dd1c757d-cfcb-42a5-8f79-9a59a7211bf4', '50a3f31a-6983-496a-87e5-faf7526de6bc', '10'),
('569ea8ad-8ca2-4cc3-a535-011fef566734', 'edb794a6-5170-4a56-8523-68200c3103eb', 'c8a8a4dc-4a3d-4b1f-843e-16f717c86aff', 'Acme');

--
-- Volcado de datos para la tabla `template`
--

INSERT INTO `template` (`id`, `name`, `namePattern`) VALUES
('2d48398f-8ea5-4e95-b197-15d41d4823f6', 'Tuerca', 'Tuerca_{p1}_{p2}'),
('a9f4b69d-9333-4392-8538-f933862193cc', 'Tuerca2', 'T2_{p1}_{p2}'),
('ddea6120-c295-4313-b018-bd9f9a89ac17', 'Tornillo', 'Bulón_{p2}_{p1}');

--
-- Volcado de datos para la tabla `templateProperties`
--

INSERT INTO `templateProperties` (`id`, `property`, `name`, `shortname`, `valueType`, `options`) VALUES
('2d48398f-8ea5-4e95-b197-15d41d4823f6', '1b5e2a06-37c6-4b1f-a7b4-bc2e9ca73870', 'Diámetro nominal', 'DIANO', 'I', ''),
('2d48398f-8ea5-4e95-b197-15d41d4823f6', '5eb2f2fe-436c-43bc-a1ab-d51d1a9a3cbb', 'Tipo', 'TIPO', 'O', 'Almaneda\rAutobloqueante\rCabeza Moleteada\rCiega\rCon arandela de presión\rCuadrada\rHexagonal\rMariposa\rRanurada\r'),
('2d48398f-8ea5-4e95-b197-15d41d4823f6', '7432f0be-97a5-4446-ad01-168999c174ea', 'Medida entre caras', 'MEDCAR', 'I', ''),
('2d48398f-8ea5-4e95-b197-15d41d4823f6', '9a696ea8-ce18-4579-81a9-b2e5b99b6185', 'Espesor', 'ESP', 'I', ''),
('a9f4b69d-9333-4392-8538-f933862193cc', '8631cda4-8655-4bf0-ade9-14657bea6774', 'Ancho', 'ANC', 'I', ''),
('a9f4b69d-9333-4392-8538-f933862193cc', '9dcbfeec-90df-4861-a122-93bfc3ae61ac', 'Giro', 'GR', 'O', 'DerechaIzquierda\r'),
('ddea6120-c295-4313-b018-bd9f9a89ac17', '0f817621-77ac-492a-90ee-0ad89efd2f13', 'Largo del cuello', 'LCUE', 'I', ''),
('ddea6120-c295-4313-b018-bd9f9a89ac17', '4128e2af-ffae-41b2-b9e1-d065a81cc028', 'Amplitud de estrías', 'AMPEST', 'O', 'Ocho hilos\rPaso extrafino\rPaso fino\rPaso grueso\r'),
('ddea6120-c295-4313-b018-bd9f9a89ac17', '50a3f31a-6983-496a-87e5-faf7526de6bc', 'Altura de la cresta', 'ACREST', 'I', ''),
('ddea6120-c295-4313-b018-bd9f9a89ac17', '6cba1093-2b92-4cee-883f-4d71abe3d95f', 'Largo de la rosca', 'LROSCA', 'I', ''),
('ddea6120-c295-4313-b018-bd9f9a89ac17', '8b9207e3-a27e-43c5-832a-f159fdd7ff6e', 'Cabeza', 'CAB', 'O', 'Cilíndrica ranurada\rCuadrada Externa\rCuadrada Interna\rGota\rHexagonal\rHexagonal Interna\rPhillips\rPlana\r'),
('ddea6120-c295-4313-b018-bd9f9a89ac17', 'c8a8a4dc-4a3d-4b1f-843e-16f717c86aff', 'Tipo de Rosca', 'TROSCA', 'O', 'Acme\rCuadrada\rMétrica\rSierra\rUnificada\r');

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `authKey`, `accessToken`) VALUES
(2, 'seba', 'elsebasoto@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$bkpSWjRHanVoV2toTVZkSA$KMWKZv5axIocQcIht7TIaStNPMlZXGmfrF8sE7ZWC0M', '6917cabe05c8ab438c4ce7a7a84df829', '$2y$10$zGdT/LhihD/Ih56jxy58TuS5PZY1OaW8qiQTkhKfbmv2s5xXZx4M6');

--
-- Volcado de datos para la tabla `valueTypes`
--

INSERT INTO `valueTypes` (`id`, `name`) VALUES
('I', 'Numérico'),
('O', 'Opciones'),
('T', 'Texto');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
