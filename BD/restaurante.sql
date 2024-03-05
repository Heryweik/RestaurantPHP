-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2024 a las 23:29:50
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
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CategoriaID` int(11) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CategoriaID`, `Descripcion`) VALUES
(1, 'alitas'),
(2, 'Bonneles'),
(3, 'Hamburguesas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ClienteID` int(11) NOT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `CuentaClienteID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ClienteID`, `Celular`, `Direccion`, `Edad`, `Correo`, `Nombre`, `CuentaClienteID`) VALUES
(1, '97037101', 'ecoplaza', 21, NULL, 'David Toledo', 1),
(5, NULL, NULL, NULL, NULL, NULL, 5),
(6, NULL, NULL, NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasclientes`
--

CREATE TABLE `cuentasclientes` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Contrasenia` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentasclientes`
--

INSERT INTO `cuentasclientes` (`Id`, `Usuario`, `Contrasenia`, `correo`) VALUES
(1, 'david', 'david', 'davidtoledo30@unitec.edu'),
(5, 'Ricardo', 'ricardo', 'placeholder@notreal.com'),
(6, 'Yhonny', 'Heryweik69', 'yhonny@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasempleados`
--

CREATE TABLE `cuentasempleados` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Contrasenia` varchar(255) NOT NULL,
  `NivelCuenta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentasempleados`
--

INSERT INTO `cuentasempleados` (`Id`, `Usuario`, `Contrasenia`, `NivelCuenta`) VALUES
(1, 'empleado', 'empleado', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `DescuentoID` int(11) NOT NULL,
  `Descuento` decimal(5,2) DEFAULT NULL,
  `MenuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleenvio`
--

CREATE TABLE `detalleenvio` (
  `DetalleEnvioID` int(11) NOT NULL,
  `MenuID` int(11) DEFAULT NULL,
  `EnvioID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `DetalleFacturaID` int(11) NOT NULL,
  `Costo` decimal(10,2) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `NumLinea` int(11) DEFAULT NULL,
  `MenuID` int(11) DEFAULT NULL,
  `FacturaID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `DetallePedidoID` int(11) NOT NULL,
  `MenuID` int(11) DEFAULT NULL,
  `PedidoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `EmpleadoID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Cargo` varchar(255) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Estado` varchar(100) DEFAULT NULL,
  `CuentaEmpleadoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `EnvioID` int(11) NOT NULL,
  `EnvioCosto` decimal(10,2) DEFAULT NULL,
  `ClienteID` int(11) DEFAULT NULL,
  `FacturaID` int(11) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `FacturaID` int(11) NOT NULL,
  `CAI` varchar(20) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `ISV` decimal(5,2) DEFAULT NULL,
  `FacturaNum` int(11) DEFAULT NULL,
  `RTN` varchar(15) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `ClienteID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `InventarioID` int(11) NOT NULL,
  `Disponibles` int(11) DEFAULT NULL,
  `FechaCaducidad` date DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `CompraID` int(11) DEFAULT NULL,
  `ProductoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`InventarioID`, `Disponibles`, `FechaCaducidad`, `Descripcion`, `CompraID`, `ProductoID`) VALUES
(2, 200, '2024-02-27', NULL, 3, 1),
(3, 100, '2024-02-28', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `MenuID` int(11) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `CategoriaID` int(11) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menuinventario`
--

CREATE TABLE `menuinventario` (
  `Costo` int(11) DEFAULT NULL,
  `MenuID` int(11) DEFAULT NULL,
  `ProductoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `MesaID` int(11) NOT NULL,
  `Estado` varchar(10) DEFAULT NULL,
  `Num_mesa` int(11) DEFAULT NULL,
  `Capacidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`MesaID`, `Estado`, `Num_mesa`, `Capacidad`) VALUES
(1, 'libre', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `pedido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pedido`)),
  `estado` tinyint(1) DEFAULT 0,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id`, `nombre`, `fecha`, `total`, `pedido`, `estado`, `direccion`, `telefono`, `email`) VALUES
(1, 'Yhonny Yupanky', '2024-03-05 15:53:43', 1640, '[{\"id\":\"2\",\"nombre\":\"Coca Cola\",\"precio\":\"410\",\"cantidad\":4,\"total\":2050}]', 1, 'MI casa', '9999-9999', 'yhonny296@gmail.com'),
(2, 'Yupanky', '2024-03-05 15:58:56', 1640, '[{\"id\":\"2\",\"nombre\":\"Coca Cola\",\"precio\":\"410\",\"cantidad\":4,\"total\":2050}]', 1, 'MI casa', '9999-9999', 'yhonny.ortega@unah.hn'),
(3, 'admin', '2024-03-05 16:00:29', 1640, '[{\"id\":\"2\",\"nombre\":\"Coca Cola\",\"precio\":\"410\",\"cantidad\":4,\"total\":2050}]', 1, 'MI casa', '9999-9999', 'yassterk@gmail.com'),
(4, 'Oscar', '2024-03-05 16:22:27', 3640, '[{\"id\":\"1\",\"nombre\":\"Pan\",\"precio\":\"50\",\"cantidad\":14,\"total\":500},{\"id\":\"7\",\"nombre\":\"Bonneles\",\"precio\":\"420\",\"cantidad\":7,\"total\":2940}]', 1, 'Su casa', '9999-9999', 'oscar@hotmail.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordencompras`
--

CREATE TABLE `ordencompras` (
  `CompraID` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Estado` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `ProductoID` int(11) DEFAULT NULL,
  `FechaIngreso` datetime DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordencompras`
--

INSERT INTO `ordencompras` (`CompraID`, `Cantidad`, `Estado`, `Precio`, `ProductoID`, `FechaIngreso`, `Descripcion`) VALUES
(3, 200, 'completado', 1000.00, 1, '2024-02-20 00:00:00', 'Compra de rodajas de pan'),
(4, 100, 'completado', 500.00, 1, '2024-02-21 00:00:00', 'Compra de mas pan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `PedidoID` int(11) NOT NULL,
  `MesaID` int(11) DEFAULT NULL,
  `FechaHora` datetime DEFAULT NULL,
  `EmpleadoID` int(11) DEFAULT NULL,
  `FacturaID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ProductoID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `CategoriaID` int(11) DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ProductoID`, `Nombre`, `Descripcion`, `CategoriaID`, `Precio`) VALUES
(1, 'Pan', 'Masa que incremento de tamaño con levadura', 1, 50),
(2, 'Coca Cola', 'El mejor refresco', 1, 410),
(3, 'Coca Cola', 'El mejor refresco', 2, 410),
(4, 'Coca Cola', 'El mejor refresco', 3, 410),
(5, 'Burger de Queso', 'Con mucho queso', 2, 320),
(6, 'Alitas', 'Con barbacoa', 3, 220),
(7, 'Bonneles', 'Picantes', 2, 420);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `ReservaID` int(11) NOT NULL,
  `Capacidad` smallint(6) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `ReservaMonto` decimal(10,2) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `MesaID` int(11) DEFAULT NULL,
  `ClienteID` int(11) DEFAULT NULL,
  `HoraIni` time NOT NULL,
  `HoraFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`ReservaID`, `Capacidad`, `Fecha`, `ReservaMonto`, `Nombre`, `MesaID`, `ClienteID`, `HoraIni`, `HoraFin`) VALUES
(2, 2, '2024-02-15', 175.00, 'david', 1, 1, '13:35:00', '16:35:00'),
(3, 3, '2024-02-20', 125.00, 'David', 1, 1, '19:39:00', '20:39:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retroalimentacion`
--

CREATE TABLE `retroalimentacion` (
  `ComentarioID` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Calificacion` int(11) DEFAULT NULL CHECK (`Calificacion` between 0 and 5),
  `Resena` varchar(255) DEFAULT NULL,
  `ClienteID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CategoriaID`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ClienteID`),
  ADD KEY `CuentaClienteID` (`CuentaClienteID`);

--
-- Indices de la tabla `cuentasclientes`
--
ALTER TABLE `cuentasclientes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `cuentasempleados`
--
ALTER TABLE `cuentasempleados`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`DescuentoID`),
  ADD KEY `MenuID` (`MenuID`);

--
-- Indices de la tabla `detalleenvio`
--
ALTER TABLE `detalleenvio`
  ADD PRIMARY KEY (`DetalleEnvioID`),
  ADD KEY `MenuID` (`MenuID`),
  ADD KEY `EnvioID` (`EnvioID`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`DetalleFacturaID`),
  ADD KEY `MenuID` (`MenuID`),
  ADD KEY `FacturaID` (`FacturaID`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`DetallePedidoID`),
  ADD KEY `MenuID` (`MenuID`),
  ADD KEY `PedidoID` (`PedidoID`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`EmpleadoID`),
  ADD KEY `CuentaEmpleadoID` (`CuentaEmpleadoID`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`EnvioID`),
  ADD KEY `ClienteID` (`ClienteID`),
  ADD KEY `FacturaID` (`FacturaID`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`FacturaID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`InventarioID`),
  ADD KEY `CompraID` (`CompraID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuID`),
  ADD KEY `CategoriaID` (`CategoriaID`);

--
-- Indices de la tabla `menuinventario`
--
ALTER TABLE `menuinventario`
  ADD KEY `MenuID` (`MenuID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`MesaID`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordencompras`
--
ALTER TABLE `ordencompras`
  ADD PRIMARY KEY (`CompraID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`PedidoID`),
  ADD KEY `MesaID` (`MesaID`),
  ADD KEY `EmpleadoID` (`EmpleadoID`),
  ADD KEY `FacturaID` (`FacturaID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ProductoID`),
  ADD KEY `fk_categoria` (`CategoriaID`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`ReservaID`),
  ADD KEY `MesaID` (`MesaID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- Indices de la tabla `retroalimentacion`
--
ALTER TABLE `retroalimentacion`
  ADD PRIMARY KEY (`ComentarioID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ClienteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentasclientes`
--
ALTER TABLE `cuentasclientes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentasempleados`
--
ALTER TABLE `cuentasempleados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `DescuentoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleenvio`
--
ALTER TABLE `detalleenvio`
  MODIFY `DetalleEnvioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `DetalleFacturaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `DetallePedidoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `EmpleadoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `EnvioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `FacturaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `InventarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `MesaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ordencompras`
--
ALTER TABLE `ordencompras`
  MODIFY `CompraID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `PedidoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `ReservaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `retroalimentacion`
--
ALTER TABLE `retroalimentacion`
  MODIFY `ComentarioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`CuentaClienteID`) REFERENCES `cuentasclientes` (`Id`);

--
-- Filtros para la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD CONSTRAINT `descuentos_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`);

--
-- Filtros para la tabla `detalleenvio`
--
ALTER TABLE `detalleenvio`
  ADD CONSTRAINT `detalleenvio_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`),
  ADD CONSTRAINT `detalleenvio_ibfk_2` FOREIGN KEY (`EnvioID`) REFERENCES `envios` (`EnvioID`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`FacturaID`) REFERENCES `facturacion` (`FacturaID`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`PedidoID`) REFERENCES `pedidos` (`PedidoID`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`CuentaEmpleadoID`) REFERENCES `cuentasempleados` (`Id`);

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`ClienteID`) REFERENCES `cliente` (`ClienteID`),
  ADD CONSTRAINT `envios_ibfk_2` FOREIGN KEY (`FacturaID`) REFERENCES `facturacion` (`FacturaID`);

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`ClienteID`) REFERENCES `cliente` (`ClienteID`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`CompraID`) REFERENCES `ordencompras` (`CompraID`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `producto` (`ProductoID`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `categoria` (`CategoriaID`);

--
-- Filtros para la tabla `menuinventario`
--
ALTER TABLE `menuinventario`
  ADD CONSTRAINT `menuinventario_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`),
  ADD CONSTRAINT `menuinventario_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `producto` (`ProductoID`);

--
-- Filtros para la tabla `ordencompras`
--
ALTER TABLE `ordencompras`
  ADD CONSTRAINT `ordencompras_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `producto` (`ProductoID`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`MesaID`) REFERENCES `mesas` (`MesaID`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`EmpleadoID`) REFERENCES `empleados` (`EmpleadoID`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`FacturaID`) REFERENCES `facturacion` (`FacturaID`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`CategoriaID`) REFERENCES `categoria` (`CategoriaID`);

--
-- Filtros para la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `reservaciones_ibfk_1` FOREIGN KEY (`MesaID`) REFERENCES `mesas` (`MesaID`),
  ADD CONSTRAINT `reservaciones_ibfk_2` FOREIGN KEY (`ClienteID`) REFERENCES `cliente` (`ClienteID`);

--
-- Filtros para la tabla `retroalimentacion`
--
ALTER TABLE `retroalimentacion`
  ADD CONSTRAINT `retroalimentacion_ibfk_1` FOREIGN KEY (`ClienteID`) REFERENCES `cliente` (`ClienteID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
