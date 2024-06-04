-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2024 a las 01:17:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tareas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaEstimadaFinalizacion` date NOT NULL,
  `fechaFinalizacion` date DEFAULT NULL,
  `creadorTarea` varchar(250) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idPrioridad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `titulo`, `descripcion`, `fechaEstimadaFinalizacion`, `fechaFinalizacion`, `creadorTarea`, `observaciones`, `idEmpleado`, `idEstado`, `idPrioridad`, `created_at`, `updated_at`) VALUES
(1, 'Hello', 'ProbarFunciones', '2024-06-19', NULL, 'Jhonathan uni sisa', 'Vamos a mirar que todo funcione correctamente', 1, 1, 1, '2024-06-02 17:55:42', '2024-06-02 18:30:12'),
(2, 'ResivionFiltros', 'verificando que funcionen', '2024-06-02', NULL, 'Jhonathan uni sisa', 'Nada', 1, 1, 1, '2024-06-02 18:38:06', '2024-06-02 18:38:06'),
(3, 'Holaaa', 'Descripción de ejemplo', '2024-12-31', NULL, 'Nombre del creador', NULL, 1, 1, 2, '2024-06-03 21:10:23', '2024-06-03 21:10:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empleados_tareas` (`idEmpleado`),
  ADD KEY `fk_estados_tareas` (`idEstado`),
  ADD KEY `fk_prioridades_tareas` (`idPrioridad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_empleados_tareas` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `fk_estados_tareas` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `fk_prioridades_tareas` FOREIGN KEY (`idPrioridad`) REFERENCES `prioridades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
