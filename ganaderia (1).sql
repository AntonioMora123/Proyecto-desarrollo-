-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 00:01:55
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
-- Base de datos: `ganaderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `idAlmacen` int(50) NOT NULL,
  `nombre` char(30) DEFAULT NULL,
  `cantidad` int(60) DEFAULT NULL,
  `unidades` char(10) DEFAULT NULL,
  `PrecioPorUnidad` int(20) DEFAULT NULL,
  `PrecioTotal` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`idAlmacen`, `nombre`, `cantidad`, `unidades`, `PrecioPorUnidad`, `PrecioTotal`, `Fecha`) VALUES
(1, 'Maiz', 497, 'kg', 10, 5000.00, '2024-11-29'),
(3, 'agujas', 20, 'pieza', 5, 100.00, '2024-11-30'),
(4, 'Sal', 300, 'kg', 10, 3000.00, '2024-11-30'),
(5, 'Electrolitos', 500, 'kg', 10, 5000.00, '2024-11-30'),
(6, 'Soja', 300, 'kg', 10, 3000.00, '2024-11-11'),
(7, 'Salvado Trigo', 300, 'kg', 10, 3000.00, '2024-11-30'),
(8, 'Alfalfa Molida', 300, 'kg', 10, 3000.00, '2024-03-11'),
(9, ' Rastrojo', 1000, 'kg', 10, 10000.00, '2024-11-30'),
(11, 'Zilpaterol', 70, 'Kg', 98, 6860.00, '2024-11-30'),
(12, 'Microminerales', 400, 'kg', 35, 14000.00, '2024-11-30'),
(13, 'Paracetamol', 190, 'Ml', 23, 4600.00, '2024-03-11'),
(14, 'Diclofenaco', 115, 'Ml', 10, 1200.00, '2024-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `idAnimal` int(11) NOT NULL,
  `idCompraGanado` int(11) DEFAULT NULL,
  `NumeroArete` varchar(20) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Meses` int(11) DEFAULT NULL,
  `Clasificacion` varchar(50) DEFAULT NULL,
  `Fierro` int(11) DEFAULT NULL,
  `Peso` decimal(10,2) DEFAULT NULL,
  `PrecioCompra` decimal(10,2) DEFAULT NULL,
  `PrecioTotal` decimal(10,2) DEFAULT NULL,
  `Ganancia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`idAnimal`, `idCompraGanado`, `NumeroArete`, `Sexo`, `Meses`, `Clasificacion`, `Fierro`, `Peso`, `PrecioCompra`, `PrecioTotal`, `Ganancia`) VALUES
(9, 18, '145256', 'masculino', 25, 'toro', 852, 850.00, 30.00, 25500.00, 25500.00),
(10, 19, '852963', 'masculino', 25, 'toro', 24, 850.00, 10.00, 8500.00, 8500.00),
(11, 20, '987', 'masculino', 11, 'becerro', 1, 10.00, 10.00, 100.00, 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraganado`
--

CREATE TABLE `compraganado` (
  `idCompraGanado` int(11) NOT NULL,
  `N_Reemo` varchar(30) DEFAULT NULL,
  `Motivo` varchar(50) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `compraganado`
--

INSERT INTO `compraganado` (`idCompraGanado`, `N_Reemo`, `Motivo`, `Fecha`) VALUES
(17, '1231234125', 'cria', '2024-11-29'),
(18, '147258', 'engorda', '2024-12-01'),
(19, '25869', 'engorda', '2024-12-01'),
(20, '789', 'cria', '2024-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `ApellidoP` varchar(50) DEFAULT NULL,
  `ApellidoM` varchar(50) DEFAULT NULL,
  `Sexo` varchar(30) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Puesto` varchar(50) DEFAULT NULL,
  `Salario` decimal(10,2) DEFAULT NULL,
  `Clave` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `Nombre`, `ApellidoP`, `ApellidoM`, `Sexo`, `Telefono`, `Puesto`, `Salario`, `Clave`) VALUES
(18, 'Juanito', 'Perez', 'Meza', 'Masculino', '4561237890', 'Obrero', 12000.00, 'juan'),
(19, 'Anita', 'La', 'Huerfanita', 'Femenino', '7894561470', 'Dueño', 300000.00, 'juanita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ganaderos`
--

CREATE TABLE `ganaderos` (
  `IdGanadero` int(11) NOT NULL,
  `IdCompraGanado` int(11) DEFAULT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `RazonSocial` varchar(60) DEFAULT NULL,
  `Domicilio` varchar(60) DEFAULT NULL,
  `Localidad` varchar(30) DEFAULT NULL,
  `Municipio` varchar(30) DEFAULT NULL,
  `Estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ganaderos`
--

INSERT INTO `ganaderos` (`IdGanadero`, `IdCompraGanado`, `Nombre`, `RazonSocial`, `Domicilio`, `Localidad`, `Municipio`, `Estado`) VALUES
(1, 1, 'Juan', 'Ganaderia Rosas', 'Primero de Mayo', 'San Pedro', 'Salvatierra', 'Guanajuato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaganado`
--

CREATE TABLE `ventaganado` (
  `idVenta` int(11) NOT NULL,
  `idAnimal` int(11) DEFAULT NULL,
  `N_Reemo` varchar(30) DEFAULT NULL,
  `Destino` varchar(50) DEFAULT NULL,
  `TipoVenta` varchar(50) DEFAULT NULL,
  `PesoVenta` decimal(10,2) DEFAULT NULL,
  `PrecioVenta` decimal(10,2) DEFAULT NULL,
  `Ganancia` decimal(10,2) DEFAULT NULL,
  `FechaVenta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventaganado`
--

INSERT INTO `ventaganado` (`idVenta`, `idAnimal`, `N_Reemo`, `Destino`, `TipoVenta`, `PesoVenta`, `PrecioVenta`, `Ganancia`, `FechaVenta`) VALUES
(1, NULL, '1231234125', 'Yuriria', 'cria', 125.00, 13.00, -2065.00, '2024-11-29'),
(2, NULL, '1231234125', 'Salamanca', 'engorda', 486.00, 150.00, 69210.00, '2024-11-30'),
(3, NULL, '789', 'Yuriria', 'cria', 30.00, 100.00, 2900.00, '2024-12-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`idAlmacen`);

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`idAnimal`),
  ADD KEY `idCompraGanado` (`idCompraGanado`);

--
-- Indices de la tabla `compraganado`
--
ALTER TABLE `compraganado`
  ADD PRIMARY KEY (`idCompraGanado`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `ganaderos`
--
ALTER TABLE `ganaderos`
  ADD PRIMARY KEY (`IdGanadero`);

--
-- Indices de la tabla `ventaganado`
--
ALTER TABLE `ventaganado`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `idAnimal` (`idAnimal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `idAlmacen` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `compraganado`
--
ALTER TABLE `compraganado`
  MODIFY `idCompraGanado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ganaderos`
--
ALTER TABLE `ganaderos`
  MODIFY `IdGanadero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventaganado`
--
ALTER TABLE `ventaganado`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animales`
--
ALTER TABLE `animales`
  ADD CONSTRAINT `Animales_ibfk_1` FOREIGN KEY (`idCompraGanado`) REFERENCES `compraganado` (`idCompraGanado`);

--
-- Filtros para la tabla `ventaganado`
--
ALTER TABLE `ventaganado`
  ADD CONSTRAINT `VentaGanado_ibfk_1` FOREIGN KEY (`idAnimal`) REFERENCES `animales` (`idAnimal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
