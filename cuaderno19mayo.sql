-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-05-2023 a las 12:02:13
-- Versión del servidor: 8.0.30-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cuaderno`
--
CREATE DATABASE IF NOT EXISTS `cuaderno` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cuaderno`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno`
--

CREATE TABLE `Alumno` (
  `id_alumno` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Alumno`
--

INSERT INTO `Alumno` (`id_alumno`) VALUES
(2),
(5),
(6),
(8),
(11),
(14),
(18),
(20),
(23),
(25),
(28),
(31),
(34),
(37),
(40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Curso`
--

CREATE TABLE `Curso` (
  `id_curso` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `anyo` varchar(40) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Curso`
--

INSERT INTO `Curso` (`id_curso`, `nombre`, `fecha_inicio`, `fecha_fin`, `anyo`) VALUES
(1, 'Curso Numero Uno', '2023-04-02 11:56:27', '2023-04-17 11:56:27', '2023-2023'),
(2, 'Curso Numero Dos', '2021-09-08 11:56:27', '2022-06-21 11:56:27', '2021-2022'),
(3, 'Curso 1', '2023-01-01 00:00:00', '2023-02-28 00:00:00', '2023'),
(4, 'Curso 2', '2023-03-01 00:00:00', '2023-04-30 00:00:00', '2023'),
(5, 'Curso 3', '2023-05-01 00:00:00', '2023-06-30 00:00:00', '2023'),
(6, 'Curso 4', '2023-07-01 00:00:00', '2023-08-31 00:00:00', '2023'),
(7, 'Curso 5', '2023-09-01 00:00:00', '2023-10-31 00:00:00', '2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evaluable`
--

CREATE TABLE `Evaluable` (
  `id_evaluable` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Evaluable`
--

INSERT INTO `Evaluable` (`id_evaluable`) VALUES
(11),
(12),
(26),
(29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Material`
--

CREATE TABLE `Material` (
  `id_material` int NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `id_curso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Material`
--

INSERT INTO `Material` (`id_material`, `nombre`, `descripcion`, `id_curso`) VALUES
(0, 'asd', 'asdasdads', 2),
(1, 'archivoprueba1', 'skjfhasdkjfhsadkkfljashdflkjashdflkasjdfhlkasjdfh', 1),
(2, 'pruebacurso2023', 'fsdfsdfsdfsdfsdfsdfdssfdsfdsdfsdffdsfdfdsdffds', 2),
(5, 'Material 3', 'Descripción del material 3', 1),
(6, 'Material 4', 'Descripción del material 4', 1),
(7, 'Material 5', 'Descripción del material 5', 1),
(9, 'Material 6', 'Descripción del material 6', 2),
(10, 'Material 7', 'Descripción del material 7', 2),
(11, 'Material 8', 'Descripción del material 8', 2),
(12, 'Material 9', 'Descripción del material 9', 2),
(13, 'Material 10', 'Descripción del material 10', 2),
(16, 'Entregable 1', 'asd', 2),
(19, 'Contenido 2', 'asddsaasddas', 1),
(21, 'asdasdas', '', 1),
(24, 'sdasasadsa', 'asdasdsdsad', 1),
(26, 'Material 1', 'Material para los alumnos de 1', 1),
(27, 'asd', 'asdasd', 2),
(28, 'asdasdsadsad', 'asdasddasasdasd', 2),
(29, 'Material entregable 2323123', 'asdads', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Noevaluable`
--

CREATE TABLE `Noevaluable` (
  `id_noevaluable` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Noevaluable`
--

INSERT INTO `Noevaluable` (`id_noevaluable`) VALUES
(0),
(2),
(9),
(10),
(24),
(27),
(28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participar_Alumno`
--

CREATE TABLE `Participar_Alumno` (
  `id_alumno` int NOT NULL,
  `id_curso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Participar_Alumno`
--

INSERT INTO `Participar_Alumno` (`id_alumno`, `id_curso`) VALUES
(6, 1),
(11, 1),
(2, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participar_Profesor`
--

CREATE TABLE `Participar_Profesor` (
  `id_profesor` int NOT NULL,
  `id_curso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Participar_Profesor`
--

INSERT INTO `Participar_Profesor` (`id_profesor`, `id_curso`) VALUES
(21, 1),
(26, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE `Persona` (
  `id_persona` int NOT NULL,
  `dni` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `clave` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` int NOT NULL,
  `id_rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`id_persona`, `dni`, `clave`, `nombre`, `apellidos`, `mail`, `telefono`, `id_rol`) VALUES
(2, '87654321E', '1234', 'Juan', 'Gonzalez', 'juan@gmail.com', 567567567, 2),
(3, '11111111U', '1234', 'Ana', 'Brutus', 'ana@gmail.com', 111111111, 3),
(4, '22222222T', '1234', 'Emilio', 'Respetador', 'emilio@gmail.com', 222222222, 1),
(5, '55555555V', '1234', 'Manolo', 'Pelotas', 'manolo@gmail.com', 555555555, 2),
(6, '66666666H', '1234', 'Daniel', 'Hermoso', 'daniel@gmail.com', 666666666, 2),
(8, '98765432B', '1234', 'María', 'García', 'maria.garcia@example.com', 987654321, 2),
(9, '56789012C', '1234', 'Pedrohijodeputa', 'Rodríguez', 'pedro.rodriguez@example.com', 654321987, 1),
(11, '98765432E', '1234', 'Javier', 'Sánchez', 'javier.sanchez@example.com', 654789321, 2),
(12, '45678901F', '1234', 'Laura', 'Gómez', 'laura.gomez@example.com', 456123789, 3),
(13, '78901234G', '1234', 'Carlos', 'Fernández', 'carlos.fernandez@example.com', 789654321, 1),
(14, '23456789H', '1234', 'Sofía', 'López', 'sofia.lopez@example.com', 654987321, 2),
(15, '98765432I', '1234', 'Manuel', 'Ramírez', 'manuel.ramirez@example.com', 987123456, 3),
(16, '12345678J', '1234', 'Isabel', 'Torres', 'isabel.torres@example.com', 321654987, 1),
(17, '123456789', 'micontrasena', 'Juan', 'Gomez', 'juan.gomez@example.com', 987654321, 1),
(18, '23481234M', '1234', 'Rufian', 'Mandela', 'rufi@gmail.com', 656767898, 2),
(19, '12345678', '1234', 'Juan', 'Perez', 'juan.perez@example.com', 123456789, 1),
(20, '98765432', '1234', 'Maria', 'Gomez', 'maria.gomez@example.com', 987654321, 2),
(21, '87654321', '1234', 'Pedro', 'Lopez', 'pedro.lopez@example.com', 654987123, 1),
(22, '76543219', '1234', 'Laura', 'Fernandez', 'laura.fernandez@example.com', 789654321, 1),
(23, '65432198', '1234', 'Carlos', 'Martinez', 'carlos.martinez@example.com', 987123456, 2),
(25, '43219876', '1234', 'Alberto', 'Ramirez', 'alberto.ramirez@example.com', 123456789, 2),
(26, '32198765', '1234', 'Eva', 'Morales', 'eva.morales@example.com', 987654321, 1),
(27, '21987654', '1234', 'Luis', 'Gonzalez', 'luis.gonzalez@example.com', 654987123, 1),
(28, '19876543', '1234', 'Marina', 'Diaz', 'marina.diaz@example.com', 789654321, 2),
(29, '98765431', '1234', 'Javier', 'Sanchez', 'javier.sanchez@example.com', 987123456, 1),
(30, '87654320', '1234', 'Cristina', 'Torres', 'cristina.torres@example.com', 456789123, 1),
(31, '76543218', '1234', 'Hector', 'Vargas', 'hector.vargas@example.com', 123456789, 2),
(32, '54321986', '1234', 'Sara', 'Perez', 'sara.perez@example.com', 987654321, 1),
(33, '43219875', '1234', 'Marcos', 'Gomez', 'marcos.gomez@example.com', 654987123, 1),
(34, '32198764', '1234', 'Beatriz', 'Lopez', 'beatriz.lopez@example.com', 789654321, 2),
(35, '21987653', '1234', 'Antonio', 'Fernandez', 'antonio.fernandez@example.com', 987123456, 1),
(36, '19876542', '1234', 'Isabel', 'Martinez', 'isabel.martinez@example.com', 456789123, 1),
(37, '98765430', '1234', 'Fernando', 'Garcia', 'fernando.garcia@example.com', 123456789, 2),
(38, '87654329', '1234', 'Rosa', 'Ramirez', 'rosa.ramirez@example.com', 987654321, 1),
(39, '76543217', '1234', 'Miguel', 'Morales', 'miguel.morales@example.com', 654987123, 1),
(40, '65432196', '1234', 'Carmen', 'Gonzalez', 'carmen.gonzalez@example.com', 789654321, 2);

--
-- Disparadores `Persona`
--
DELIMITER $$
CREATE TRIGGER `tr_insertar_alumno` AFTER INSERT ON `Persona` FOR EACH ROW BEGIN
  IF NEW.id_rol = 2 THEN
    INSERT INTO Alumno (id_alumno) VALUES (NEW.id_persona);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_insertar_profesor` AFTER INSERT ON `Persona` FOR EACH ROW BEGIN
  IF NEW.id_rol = 1 THEN
    INSERT INTO Profesor (id_profesor) VALUES (NEW.id_persona);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profesor`
--

CREATE TABLE `Profesor` (
  `id_profesor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Profesor`
--

INSERT INTO `Profesor` (`id_profesor`) VALUES
(4),
(9),
(13),
(16),
(17),
(19),
(21),
(22),
(26),
(27),
(29),
(30),
(32),
(33),
(35),
(36),
(38),
(39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Realizar`
--

CREATE TABLE `Realizar` (
  `id_alumno` int NOT NULL,
  `id_evaluable` int NOT NULL,
  `entrega_alumno` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nota` float NOT NULL,
  `observaciones` varchar(300) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Realizar`
--

INSERT INTO `Realizar` (`id_alumno`, `id_evaluable`, `entrega_alumno`, `nota`, `observaciones`) VALUES
(2, 11, NULL, 7, 'asd'),
(2, 26, NULL, 8.9, 'Buena nota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `id_rol` int NOT NULL,
  `descripcion` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`id_rol`, `descripcion`) VALUES
(1, 'Profesor'),
(2, 'Alumno'),
(3, 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumno`
--
ALTER TABLE `Alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `Curso`
--
ALTER TABLE `Curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `Evaluable`
--
ALTER TABLE `Evaluable`
  ADD PRIMARY KEY (`id_evaluable`);

--
-- Indices de la tabla `Material`
--
ALTER TABLE `Material`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `Noevaluable`
--
ALTER TABLE `Noevaluable`
  ADD PRIMARY KEY (`id_noevaluable`);

--
-- Indices de la tabla `Participar_Alumno`
--
ALTER TABLE `Participar_Alumno`
  ADD PRIMARY KEY (`id_alumno`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `Participar_Profesor`
--
ALTER TABLE `Participar_Profesor`
  ADD PRIMARY KEY (`id_profesor`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `Profesor`
--
ALTER TABLE `Profesor`
  ADD PRIMARY KEY (`id_profesor`);

--
-- Indices de la tabla `Realizar`
--
ALTER TABLE `Realizar`
  ADD PRIMARY KEY (`id_alumno`,`id_evaluable`),
  ADD KEY `id_evaluable` (`id_evaluable`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Curso`
--
ALTER TABLE `Curso`
  MODIFY `id_curso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Material`
--
ALTER TABLE `Material`
  MODIFY `id_material` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `Persona`
--
ALTER TABLE `Persona`
  MODIFY `id_persona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alumno`
--
ALTER TABLE `Alumno`
  ADD CONSTRAINT `Alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `Persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Evaluable`
--
ALTER TABLE `Evaluable`
  ADD CONSTRAINT `Evaluable_ibfk_1` FOREIGN KEY (`id_evaluable`) REFERENCES `Material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Material`
--
ALTER TABLE `Material`
  ADD CONSTRAINT `Material_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `Curso` (`id_curso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Noevaluable`
--
ALTER TABLE `Noevaluable`
  ADD CONSTRAINT `NoEvaluable_ibfk_1` FOREIGN KEY (`id_noevaluable`) REFERENCES `Material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Participar_Alumno`
--
ALTER TABLE `Participar_Alumno`
  ADD CONSTRAINT `Participar_Alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `Alumno` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Participar_Alumno_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `Curso` (`id_curso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Participar_Profesor`
--
ALTER TABLE `Participar_Profesor`
  ADD CONSTRAINT `Participar_Profesor_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `Profesor` (`id_profesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Participar_Profesor_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `Curso` (`id_curso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD CONSTRAINT `Persona_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `Rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Profesor`
--
ALTER TABLE `Profesor`
  ADD CONSTRAINT `Profesor_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `Persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Realizar`
--
ALTER TABLE `Realizar`
  ADD CONSTRAINT `Realizar_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `Alumno` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Realizar_ibfk_2` FOREIGN KEY (`id_evaluable`) REFERENCES `Evaluable` (`id_evaluable`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
