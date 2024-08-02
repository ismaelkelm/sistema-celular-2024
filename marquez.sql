-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2024 a las 22:20:57
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
-- Base de datos: `marquez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id_accesorios` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripción` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id_accesorios`, `nombre`, `descripción`, `precio`, `stock`) VALUES
(1, 'Cargador USB', 'Cargador USB para dispositivos móviles', 15.00, 98),
(2, 'Funda Protectora', 'Funda protectora para teléfonos inteligentes', 25.00, 50),
(3, 'Auriculares Bluetooth', 'Auriculares Bluetooth con micrófono', 50.00, 29),
(4, 'Soporte para Teléfono', 'Soporte ajustable para teléfonos móviles', 20.00, 74);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `numero_pedido` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_clientes`, `nombre`, `telefono`, `correo_electronico`, `direccion`, `numero_pedido`) VALUES
(1, 'Juan Pérez', '555-1234', 'juan.perez@example.com', 'Calle Falsa 123', NULL),
(2, 'Ana Gómez', '555-5678', 'ana.gomez@example.com', 'Avenida Siempre Viva 742', NULL),
(3, 'Juan Pérez', '555-1234', 'juan.perez@example.com', 'Calle Falsa 123', 'ORD001'),
(4, 'Ana Gómez', '555-5678', 'ana.gomez@example.com', 'Avenida Siempre Viva 742', 'ORD002'),
(5, 'Carlos Martínez', '555-4321', 'carlos.martinez@example.com', 'Calle de la Luna 456', NULL),
(6, 'Laura Torres', '555-8765', 'laura.torres@example.com', 'Avenida del Sol 789', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_facturas`
--

CREATE TABLE `detalle_facturas` (
  `id_detalle_facturas` int(11) NOT NULL,
  `id_facturas` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reparaciones`
--

CREATE TABLE `detalle_reparaciones` (
  `id_detalle_reparaciones` int(11) NOT NULL,
  `id_reparacion` int(11) NOT NULL,
  `id_pieza` int(11) NOT NULL,
  `cantidad_usada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_reparaciones`
--

INSERT INTO `detalle_reparaciones` (`id_detalle_reparaciones`, `id_reparacion`, `id_pieza`, `cantidad_usada`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id_dispositivos` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `numero_de_serie` varchar(255) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id_dispositivos`, `marca`, `modelo`, `numero_de_serie`, `estado`) VALUES
(1, 'Marca A', 'Modelo A1', 'SN123456', 'Nuevo'),
(2, 'Marca B', 'Modelo B2', 'SN654321', 'Usado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleados` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleados`, `nombre`, `cargo`, `id_usuarios`) VALUES
(1, 'Roberto Ruiz', 'Gerente', 1),
(2, 'Claudia López', 'Técnico', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_facturas` int(11) NOT NULL,
  `id_proveedores` int(11) NOT NULL,
  `fecha_de_emision` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_facturas`, `id_proveedores`, `fecha_de_emision`, `subtotal`, `impuestos`, `total`) VALUES
(1, 1, '2024-07-01', 1000.00, 200.00, 1200.00),
(2, 2, '2024-07-05', 500.00, 100.00, 600.00),
(3, 2, '2024-07-05', 1500.00, 300.00, 1800.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL,
  `tipo_movimiento` enum('Ingreso','Egreso') NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_recibo` int(11) DEFAULT NULL,
  `id_ticket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimiento`, `tipo_movimiento`, `monto`, `fecha`, `descripcion`, `id_recibo`, `id_ticket`) VALUES
(1, 'Ingreso', 500.00, '2024-07-01', 'Ingreso por venta', 1, NULL),
(2, 'Egreso', 300.00, '2024-07-05', 'Pago de factura', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_financieros`
--

CREATE TABLE `movimientos_financieros` (
  `id_movimiento` int(11) NOT NULL,
  `tipo` enum('ingreso','egreso') NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_pago` int(11) DEFAULT NULL,
  `id_ticket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_financieros`
--

INSERT INTO `movimientos_financieros` (`id_movimiento`, `tipo`, `monto`, `fecha`, `descripcion`, `id_factura`, `id_pago`, `id_ticket`) VALUES
(1, 'ingreso', 1200.00, '2024-07-01', 'Venta de accesorios', 1, 1, 1),
(2, 'egreso', 600.00, '2024-07-05', 'Pago a proveedor', 1, 2, 1),
(3, 'ingreso', 500.00, '2024-07-10', 'Servicios prestados', 2, 1, 2),
(4, 'egreso', 200.00, '2024-07-15', 'Compra de suministros', 2, 2, 2),
(5, 'ingreso', 1200.00, '2024-07-01', 'Venta de accesorios', 1, 1, 1),
(6, 'egreso', 600.00, '2024-07-05', 'Pago a proveedor', 1, 2, 1),
(7, 'ingreso', 500.00, '2024-07-10', 'Servicios prestados', 2, 1, 2),
(8, 'egreso', 200.00, '2024-07-15', 'Compra de suministros', 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificaciones` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_de_envío` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `numero_pedido` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificaciones`, `id_usuarios`, `mensaje`, `fecha_de_envío`, `estado`, `numero_pedido`) VALUES
(1, 1, 'Nueva venta registrada', '2024-07-01', 'Pendiente', NULL),
(2, 2, 'Nueva reparación asignada', '2024-07-05', 'Leída', NULL),
(3, 1, 'Nueva venta registrada', '2024-07-01', 'Pendiente', 'ORD001'),
(4, 2, 'Nueva reparación asignada', '2024-07-05', 'Leída', 'ORD002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pagos` int(11) NOT NULL,
  `id_recibo` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pagos`, `id_recibo`, `monto`, `fecha_pago`) VALUES
(1, 1, 500.00, '2024-07-01'),
(2, 2, 300.00, '2024-07-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_de_reparacion`
--

CREATE TABLE `pedidos_de_reparacion` (
  `id_pedidos_de_reparacion` int(11) NOT NULL,
  `id_clientes` int(11) NOT NULL,
  `id_dispositivos` int(11) NOT NULL,
  `fecha_de_pedido` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `numero_pedido` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_de_reparacion`
--

INSERT INTO `pedidos_de_reparacion` (`id_pedidos_de_reparacion`, `id_clientes`, `id_dispositivos`, `fecha_de_pedido`, `estado`, `numero_pedido`) VALUES
(1, 1, 1, '2024-07-01', 'Pendiente', NULL),
(2, 2, 2, '2024-07-05', 'Completado', NULL),
(3, 1, 1, '2024-07-01', 'Pendiente', 'PED001'),
(4, 2, 2, '2024-07-05', 'Completado', 'PED002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas_y_componentes`
--

CREATE TABLE `piezas_y_componentes` (
  `id_piezas_y_componentes` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `piezas_y_componentes`
--

INSERT INTO `piezas_y_componentes` (`id_piezas_y_componentes`, `nombre`, `descripcion`, `stock`, `precio`) VALUES
(1, 'Pieza X', 'Descripción de la pieza X', 100, 50.00),
(2, 'Componente Y', 'Descripción del componente Y', 200, 30.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedores`, `nombre`, `contacto`, `telefono`, `correo_electronico`) VALUES
(1, 'Proveedor A', 'Carlos López', '555-8765', 'carlos.lopez@proveedora.com'),
(2, 'Proveedor B', 'Laura Martínez', '555-4321', 'laura.martinez@proveedora.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id_recibos` int(11) NOT NULL,
  `id_pagos` int(11) NOT NULL,
  `fecha_de_emision` date NOT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id_recibos`, `id_pagos`, `fecha_de_emision`, `monto`) VALUES
(1, 1, '2024-07-01', 500.00),
(2, 2, '2024-07-05', 300.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id_reparaciones` int(11) NOT NULL,
  `id_dispositivos` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_de_reparacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id_reparaciones`, `id_dispositivos`, `descripcion`, `estado`, `fecha_de_reparacion`) VALUES
(1, 1, 'Reemplazo de pantalla', 'Completada', '2024-07-10'),
(2, 2, 'Reparación de batería', 'En progreso', '2024-07-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id_tecnicos` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`id_tecnicos`, `nombre`, `especialidad`, `id_usuario`) VALUES
(1, 'Luis Martínez', 'Electrónica', 2),
(2, 'María Fernández', 'Software', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_tickets` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_dispositivos` int(11) DEFAULT NULL,
  `fecha_de_ticket` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_tickets`, `id_cliente`, `id_dispositivos`, `fecha_de_ticket`, `estado`) VALUES
(1, 1, 1, '2024-07-01', 'Abierto'),
(2, 2, 2, '2024-07-05', 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contraseña` varbinary(255) NOT NULL,
  `id_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `contraseña`, `id_roles`) VALUES
(1, 'admin', 0x2a32433633393641444545463141463836353637324434383733354330453345433842314139434543, 1),
(2, 'tecnico', 0x2a37373938413346323834463646303941354332393537434339363242353437453231363931414341, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_accesorios`
--

CREATE TABLE `ventas_accesorios` (
  `id_ventas_accesorios` int(11) NOT NULL,
  `id_clientes` int(11) NOT NULL,
  `id_accesorios` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_accesorios`
--

INSERT INTO `ventas_accesorios` (`id_ventas_accesorios`, `id_clientes`, `id_accesorios`, `cantidad`, `precio_total`, `fecha_venta`) VALUES
(1, 1, 1, 2, 30.00, '2024-07-10'),
(2, 2, 3, 1, 50.00, '2024-07-11'),
(3, 1, 4, 1, 20.00, '2024-07-12');

--
-- Disparadores `ventas_accesorios`
--
DELIMITER $$
CREATE TRIGGER `after_venta_accesorios` AFTER INSERT ON `ventas_accesorios` FOR EACH ROW BEGIN
  UPDATE `marquez`.`accesorios`
  SET `stock` = `stock` - NEW.cantidad
  WHERE `id_accesorios` = NEW.id_accesorios;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id_accesorios`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_clientes`);

--
-- Indices de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD PRIMARY KEY (`id_detalle_facturas`),
  ADD KEY `fk_detalle_facturas_facturas` (`id_facturas`);

--
-- Indices de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  ADD PRIMARY KEY (`id_detalle_reparaciones`),
  ADD KEY `fk_detalle_reparaciones_reparaciones` (`id_reparacion`),
  ADD KEY `fk_detalle_reparaciones_piezas_y_componentes` (`id_pieza`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id_dispositivos`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleados`),
  ADD KEY `fk_empleados_usuarios` (`id_usuarios`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_facturas`),
  ADD KEY `fk_facturas_proveedores` (`id_proveedores`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `fk_movimientos_recibos` (`id_recibo`),
  ADD KEY `fk_movimientos_tickets` (`id_ticket`);

--
-- Indices de la tabla `movimientos_financieros`
--
ALTER TABLE `movimientos_financieros`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `fk_movimientos_factura` (`id_factura`),
  ADD KEY `fk_movimientos_pago` (`id_pago`),
  ADD KEY `fk_movimientos_ticket` (`id_ticket`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificaciones`),
  ADD KEY `fk_notificaciones_usuarios` (`id_usuarios`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pagos`),
  ADD KEY `fk_pagos_recibos` (`id_recibo`);

--
-- Indices de la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  ADD PRIMARY KEY (`id_pedidos_de_reparacion`),
  ADD KEY `fk_pedidos_de_reparacion_clientes` (`id_clientes`),
  ADD KEY `fk_pedidos_de_reparacion_dispositivos` (`id_dispositivos`);

--
-- Indices de la tabla `piezas_y_componentes`
--
ALTER TABLE `piezas_y_componentes`
  ADD PRIMARY KEY (`id_piezas_y_componentes`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`id_recibos`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id_reparaciones`),
  ADD KEY `fk_reparaciones_dispositivos` (`id_dispositivos`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id_tecnicos`),
  ADD KEY `fk_tecnicos_usuarios` (`id_usuario`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_tickets`),
  ADD KEY `fk_tickets_clientes` (`id_cliente`),
  ADD KEY `fk_tickets_dispositivos` (`id_dispositivos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD KEY `fk_usuarios_roles` (`id_roles`);

--
-- Indices de la tabla `ventas_accesorios`
--
ALTER TABLE `ventas_accesorios`
  ADD PRIMARY KEY (`id_ventas_accesorios`),
  ADD KEY `fk_ventas_accesorios_clientes` (`id_clientes`),
  ADD KEY `fk_ventas_accesorios_accesorios` (`id_accesorios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id_accesorios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  MODIFY `id_detalle_facturas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  MODIFY `id_detalle_reparaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_facturas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimientos_financieros`
--
ALTER TABLE `movimientos_financieros`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  MODIFY `id_pedidos_de_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `piezas_y_componentes`
--
ALTER TABLE `piezas_y_componentes`
  MODIFY `id_piezas_y_componentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id_reparaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id_tecnicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_tickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas_accesorios`
--
ALTER TABLE `ventas_accesorios`
  MODIFY `id_ventas_accesorios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD CONSTRAINT `fk_detalle_facturas_facturas` FOREIGN KEY (`id_facturas`) REFERENCES `facturas` (`id_facturas`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  ADD CONSTRAINT `fk_detalle_reparaciones_piezas_y_componentes` FOREIGN KEY (`id_pieza`) REFERENCES `piezas_y_componentes` (`id_piezas_y_componentes`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detalle_reparaciones_reparaciones` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparaciones`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleados_usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_facturas_proveedores` FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movimientos_recibos` FOREIGN KEY (`id_recibo`) REFERENCES `recibos` (`id_recibos`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_movimientos_tickets` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_tickets`) ON DELETE SET NULL;

--
-- Filtros para la tabla `movimientos_financieros`
--
ALTER TABLE `movimientos_financieros`
  ADD CONSTRAINT `fk_movimientos_factura` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_facturas`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_movimientos_pago` FOREIGN KEY (`id_pago`) REFERENCES `pagos` (`id_pagos`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_movimientos_ticket` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_tickets`) ON DELETE SET NULL;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_recibos` FOREIGN KEY (`id_recibo`) REFERENCES `recibos` (`id_recibos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  ADD CONSTRAINT `fk_pedidos_de_reparacion_clientes` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pedidos_de_reparacion_dispositivos` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `fk_reparaciones_dispositivos` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD CONSTRAINT `fk_tecnicos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE SET NULL;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_clientes`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_tickets_dispositivos` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas_accesorios`
--
ALTER TABLE `ventas_accesorios`
  ADD CONSTRAINT `fk_ventas_accesorios_accesorios` FOREIGN KEY (`id_accesorios`) REFERENCES `accesorios` (`id_accesorios`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ventas_accesorios_clientes` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
