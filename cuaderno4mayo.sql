-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2023 a las 15:38:37
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`) VALUES
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
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `anyo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre`, `fecha_inicio`, `fecha_fin`, `anyo`) VALUES
(1, 'Curso Numero Uno', '2023-04-02 11:56:27', '2023-04-17 11:56:27', '2023-2023'),
(2, 'Curso Numero Dos', '2021-09-08 11:56:27', '2022-06-21 11:56:27', '2021-2022'),
(3, 'Curso 1', '2023-01-01 00:00:00', '2023-02-28 00:00:00', '2023'),
(4, 'Curso 2', '2023-03-01 00:00:00', '2023-04-30 00:00:00', '2023'),
(5, 'Curso 3', '2023-05-01 00:00:00', '2023-06-30 00:00:00', '2023'),
(6, 'Curso 4', '2023-07-01 00:00:00', '2023-08-31 00:00:00', '2023'),
(7, 'Curso 5', '2023-09-01 00:00:00', '2023-10-31 00:00:00', '2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluable`
--

CREATE TABLE `evaluable` (
  `id_evaluable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluable`
--

INSERT INTO `evaluable` (`id_evaluable`) VALUES
(3),
(11),
(12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_material`, `nombre`, `descripcion`, `archivo`, `id_curso`) VALUES
(0, 'asd', 'asdasdads', 'PepegaBakery.txt', 2),
(1, 'archivoprueba1', 'skjfhasdkjfhsadkkfljashdflkjashdflkasjdfhlkasjdfh', 'archivo.png', 1),
(2, 'pruebacurso2023', 'fsdfsdfsdfsdfsdfsdfdssfdsfdsdfsdffdsfdfdsdffds', 'curso2023.png', 2),
(3, 'Material 1', 'Descripción del material 1', 'archivo1.pdf', 1),
(4, 'Material 2', 'Descripción del material 2', 'archivo2.docx', 1),
(5, 'Material 3', 'Descripción del material 3', 'archivo3.txt', 1),
(6, 'Material 4', 'Descripción del material 4', 'archivo4.png', 1),
(7, 'Material 5', 'Descripción del material 5', 'archivo5.jpg', 1),
(9, 'Material 6', 'Descripción del material 6', 'archivo6.pdf', 2),
(10, 'Material 7', 'Descripción del material 7', 'archivo7.docx', 2),
(11, 'Material 8', 'Descripción del material 8', 'archivo8.txt', 2),
(12, 'Material 9', 'Descripción del material 9', 'archivo9.png', 2),
(13, 'Material 10', 'Descripción del material 10', 'archivo10.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noevaluable`
--

CREATE TABLE `noevaluable` (
  `id_noevaluable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noevaluable`
--

INSERT INTO `noevaluable` (`id_noevaluable`) VALUES
(0),
(2),
(4),
(9),
(10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participar_alumno`
--

CREATE TABLE `participar_alumno` (
  `id_alumno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participar_alumno`
--

INSERT INTO `participar_alumno` (`id_alumno`, `id_curso`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participar_profesor`
--

CREATE TABLE `participar_profesor` (
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participar_profesor`
--

INSERT INTO `participar_profesor` (`id_profesor`, `id_curso`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `clave` varchar(256) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `dni`, `clave`, `nombre`, `apellidos`, `mail`, `telefono`, `id_rol`) VALUES
(1, '12345678W', 'SHA2(\'1234\', 256)', 'Pedro', 'Picapiedra', 'pedro@gmail.com', 123123123, 1),
(2, '87654321E', '1234', 'Juan', 'Sanchez', 'juan@gmail.com', 567567567, 2),
(3, '11111111U', '1234', 'Ana', 'Brutus', 'ana@gmail.com', 111111111, 3),
(4, '22222222T', '1234', 'Emilio', 'Respetador', 'emilio@gmail.com', 222222222, 1),
(5, '55555555V', '1234', 'Manolo', 'Pelotas', 'manolo@gmail.com', 555555555, 2),
(6, '66666666H', '1234', 'Daniel', 'Hermoso', 'daniel@gmail.com', 666666666, 2),
(7, '12345678A', '1234', 'Juan', 'Pérez', 'juan.perez@example.com', 123456789, 1),
(8, '98765432B', '1234', 'María', 'García', 'maria.garcia@example.com', 987654321, 2),
(9, '56789012C', '1234', 'Pedro', 'Rodríguez', 'pedro.rodriguez@example.com', 654321987, 1),
(10, '12345678D', '1234', 'Ana', 'Martínez', 'ana.martinez@example.com', 789456123, 3),
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
(24, '54321987', '1234', 'Ana', 'Garcia', 'ana.garcia@example.com', 456789123, 1),
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
-- Disparadores `persona`
--
DELIMITER $$
CREATE TRIGGER `tr_insertar_alumno` AFTER INSERT ON `persona` FOR EACH ROW BEGIN
  IF NEW.id_rol = 2 THEN
    INSERT INTO Alumno (id_alumno) VALUES (NEW.id_persona);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_insertar_profesor` AFTER INSERT ON `persona` FOR EACH ROW BEGIN
  IF NEW.id_rol = 1 THEN
    INSERT INTO Profesor (id_profesor) VALUES (NEW.id_persona);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`) VALUES
(1),
(4),
(7),
(9),
(13),
(16),
(17),
(19),
(21),
(22),
(24),
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
-- Estructura de tabla para la tabla `realizar`
--

CREATE TABLE `realizar` (
  `id_alumno` int(11) NOT NULL,
  `id_evaluable` int(11) NOT NULL,
  `entrega_alumno` varchar(60) DEFAULT NULL,
  `nota` float NOT NULL,
  `observaciones` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `realizar`
--

INSERT INTO `realizar` (`id_alumno`, `id_evaluable`, `entrega_alumno`, `nota`, `observaciones`) VALUES
(2, 3, '', 7.8, ''),
(5, 3, NULL, 7, 'Buena nota'),
(6, 3, NULL, 9, 'dsf'),
(8, 3, NULL, 2, 'asd'),
(11, 3, NULL, 2, 'wads'),
(14, 3, NULL, 0, 'asd'),
(18, 3, NULL, 0, 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `descripcion`) VALUES
(1, 'Profesor'),
(2, 'Alumno'),
(3, 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `evaluable`
--
ALTER TABLE `evaluable`
  ADD PRIMARY KEY (`id_evaluable`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `noevaluable`
--
ALTER TABLE `noevaluable`
  ADD PRIMARY KEY (`id_noevaluable`);

--
-- Indices de la tabla `participar_alumno`
--
ALTER TABLE `participar_alumno`
  ADD PRIMARY KEY (`id_alumno`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `participar_profesor`
--
ALTER TABLE `participar_profesor`
  ADD PRIMARY KEY (`id_profesor`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id_profesor`);

--
-- Indices de la tabla `realizar`
--
ALTER TABLE `realizar`
  ADD PRIMARY KEY (`id_alumno`,`id_evaluable`),
  ADD KEY `id_evaluable` (`id_evaluable`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `Alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluable`
--
ALTER TABLE `evaluable`
  ADD CONSTRAINT `Evaluable_ibfk_1` FOREIGN KEY (`id_evaluable`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `Material_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `noevaluable`
--
ALTER TABLE `noevaluable`
  ADD CONSTRAINT `NoEvaluable_ibfk_1` FOREIGN KEY (`id_noevaluable`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participar_alumno`
--
ALTER TABLE `participar_alumno`
  ADD CONSTRAINT `Participar_Alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Participar_Alumno_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `participar_profesor`
--
ALTER TABLE `participar_profesor`
  ADD CONSTRAINT `Participar_Profesor_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id_profesor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Participar_Profesor_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `Persona_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `Profesor_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `realizar`
--
ALTER TABLE `realizar`
  ADD CONSTRAINT `Realizar_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Realizar_ibfk_2` FOREIGN KEY (`id_evaluable`) REFERENCES `evaluable` (`id_evaluable`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
