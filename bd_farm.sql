-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 07:20:02
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
-- Base de datos: `bd_farm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buyout`
--

CREATE TABLE `buyout` (
  `buyId` int(11) NOT NULL,
  `buyDate` date NOT NULL,
  `buyPayment` varchar(15) NOT NULL,
  `buyCost` double NOT NULL,
  `supId` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `buyVoucher` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `cliId` int(11) NOT NULL,
  `cliName` varchar(35) NOT NULL,
  `cliLastName` varchar(35) NOT NULL,
  `cliGender` varchar(2) NOT NULL,
  `cliDNI` varchar(10) NOT NULL,
  `cliPhone` varchar(15) NOT NULL,
  `cliRUC` varchar(20) NOT NULL,
  `cliEmail` varchar(35) NOT NULL,
  `cliAddress` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`cliId`, `cliName`, `cliLastName`, `cliGender`, `cliDNI`, `cliPhone`, `cliRUC`, `cliEmail`, `cliAddress`) VALUES
(1, 'Beremis Samir', 'Vega Pasquel', 'M', '72875428', '+51 925463363', '123', 'vegasamir48@gmail.com', 'Jr. Grau N° 2212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detailbuyout`
--

CREATE TABLE `detailbuyout` (
  `buyId` int(11) NOT NULL,
  `proId` int(11) NOT NULL,
  `proQuantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detailseal`
--

CREATE TABLE `detailseal` (
  `seaId` int(11) NOT NULL,
  `proId` int(11) NOT NULL,
  `proQuantity` int(11) NOT NULL,
  `proImport` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `empId` int(11) NOT NULL,
  `empName` varchar(35) NOT NULL,
  `empLastName` varchar(35) NOT NULL,
  `empRol` varchar(30) NOT NULL,
  `empGender` varchar(1) NOT NULL,
  `empDNI` varchar(15) NOT NULL,
  `empPhone` varchar(15) NOT NULL,
  `empAddress` varchar(35) NOT NULL,
  `empEntryTime` varchar(15) NOT NULL,
  `empDepartureTime` varchar(15) NOT NULL,
  `empSalary` double NOT NULL,
  `useId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`empId`, `empName`, `empLastName`, `empRol`, `empGender`, `empDNI`, `empPhone`, `empAddress`, `empEntryTime`, `empDepartureTime`, `empSalary`, `useId`) VALUES
(0, 'Beremis Samir', 'Vega Pasquel', 'Administrador', 'M', '72875428', '+51 925463363', 'Jr. Grau N° 2212', '8:00 a.m.', '4:00 p.m.', 1025, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lab`
--

CREATE TABLE `lab` (
  `labId` int(11) NOT NULL,
  `labName` varchar(35) NOT NULL,
  `labAddress` varchar(35) NOT NULL,
  `labPhone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lab`
--

INSERT INTO `lab` (`labId`, `labName`, `labAddress`, `labPhone`) VALUES
(0, 'Unknown', 'Unknown', 'unknown');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `proId` int(11) NOT NULL,
  `proName` varchar(35) NOT NULL,
  `proConcentracion` varchar(30) NOT NULL,
  `proCost` double NOT NULL,
  `proSanRegistration` varchar(20) NOT NULL,
  `proExpiration` date NOT NULL,
  `proPresentation` varchar(20) NOT NULL,
  `labId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`proId`, `proName`, `proConcentracion`, `proCost`, `proSanRegistration`, `proExpiration`, `proPresentation`, `labId`) VALUES
(1, 'unknowner', '500 ml', 1.5, '123', '2022-11-07', 'Caja', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seal`
--

CREATE TABLE `seal` (
  `seaId` int(11) NOT NULL,
  `seaDate` date NOT NULL,
  `seaFee` double NOT NULL,
  `seaVoucher` varchar(20) NOT NULL,
  `cliId` int(11) NOT NULL,
  `empId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seal`
--

INSERT INTO `seal` (`seaId`, `seaDate`, `seaFee`, `seaVoucher`, `cliId`, `empId`) VALUES
(0, '2027-11-22', 0, 'Boleta', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

CREATE TABLE `supplier` (
  `supId` int(11) NOT NULL,
  `supName` varchar(35) NOT NULL,
  `supRUC` varchar(20) NOT NULL,
  `supAddress` varchar(20) NOT NULL,
  `supPhone` varchar(15) NOT NULL,
  `supBank` varchar(35) NOT NULL,
  `supAccount` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `useId` int(11) NOT NULL,
  `useDNI` varchar(11) NOT NULL,
  `useName` varchar(35) NOT NULL,
  `useLastName` varchar(35) NOT NULL,
  `useNametag` varchar(30) NOT NULL,
  `useEmail` varchar(35) NOT NULL,
  `usePassword` varchar(32) NOT NULL,
  `useRol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`useId`, `useDNI`, `useName`, `useLastName`, `useNametag`, `useEmail`, `usePassword`, `useRol`) VALUES
(0, '72875428', 'Beremis Samir', 'Vega Pasquel', 'AdministerVega', 'vegasamir48@gmail.com', '920b6811ba30b4755f68b9cb026f1dac', 'Administrador'),
(1, 'Unknowner', 'Mario', 'Arce Arauco', 'AdministerMaria', 'unknown@gmail.com', '202cb962ac59075b964b07152d234b70', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buyout`
--
ALTER TABLE `buyout`
  ADD PRIMARY KEY (`buyId`),
  ADD KEY `fk_buy_emp` (`empId`),
  ADD KEY `fk_buy_sup` (`supId`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cliId`);

--
-- Indices de la tabla `detailseal`
--
ALTER TABLE `detailseal`
  ADD KEY `fk_detsea_sea` (`seaId`),
  ADD KEY `fk_detsea_pro` (`proId`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empId`),
  ADD KEY `fk_emp_use` (`useId`);

--
-- Indices de la tabla `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`labId`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proId`),
  ADD KEY `fk_pro_lab` (`labId`);

--
-- Indices de la tabla `seal`
--
ALTER TABLE `seal`
  ADD PRIMARY KEY (`seaId`),
  ADD KEY `fk_sea_cli` (`cliId`),
  ADD KEY `fk_sea_emp` (`empId`);

--
-- Indices de la tabla `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supId`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`useId`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `buyout`
--
ALTER TABLE `buyout`
  ADD CONSTRAINT `fk_buy_emp` FOREIGN KEY (`empId`) REFERENCES `employee` (`empId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_buy_sup` FOREIGN KEY (`supId`) REFERENCES `supplier` (`supId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detailseal`
--
ALTER TABLE `detailseal`
  ADD CONSTRAINT `fk_detsea_pro` FOREIGN KEY (`proId`) REFERENCES `product` (`proId`),
  ADD CONSTRAINT `fk_detsea_sea` FOREIGN KEY (`seaId`) REFERENCES `seal` (`seaId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_emp_use` FOREIGN KEY (`useId`) REFERENCES `user` (`useId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_pro_lab` FOREIGN KEY (`labId`) REFERENCES `lab` (`labId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seal`
--
ALTER TABLE `seal`
  ADD CONSTRAINT `fk_sea_cli` FOREIGN KEY (`cliId`) REFERENCES `client` (`cliId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sea_emp` FOREIGN KEY (`empId`) REFERENCES `employee` (`empId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
