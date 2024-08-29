-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2024 a las 03:20:09
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
-- Base de datos: `pruebas_marquez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios_y_componentes`
--

CREATE TABLE `accesorios_y_componentes` (
  `id_accesorios_y_componentes` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo` int(11) NOT NULL,
  `stockmin` int(11) NOT NULL,
  `stockmaximo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_tecnico`
--

CREATE TABLE `area_tecnico` (
  `id_area_tecnico` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `dni` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle_compra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `id_factura_compra` int(11) NOT NULL,
  `id_accesorios_y_componentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reparaciones`
--

CREATE TABLE `detalle_reparaciones` (
  `id_detalle_reparaciones` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `id_accesorios_y_componentes` int(11) NOT NULL,
  `id_pedidos_de_reparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas_accesorios`
--

CREATE TABLE `detalle_ventas_accesorios` (
  `id_detalle_ventas_accesorios` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `id_factura_venta_accesorio` int(11) NOT NULL,
  `id_accesorios_y_componentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compra`
--

CREATE TABLE `facturas_compra` (
  `id_facturas_compra` int(11) NOT NULL,
  `id_proveedores` int(11) NOT NULL,
  `fecha_de_emision` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_venta_reparacion`
--

CREATE TABLE `facturas_venta_reparacion` (
  `id_facturas_venta_reparacion` int(11) NOT NULL,
  `fecha_de_emision` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_venta_accesorio`
--

CREATE TABLE `factura_venta_accesorio` (
  `id_factura_venta_accesorio` int(11) NOT NULL,
  `numero_factura` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cambios_contrasena`
--

CREATE TABLE `historial_cambios_contrasena` (
  `id_historial` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificaciones` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pagos` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  `id_facturas_compra` int(11) NOT NULL,
  `id_facturas_venta_reparacion` int(11) NOT NULL,
  `id_factura_venta_accesorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_de_reparacion`
--

CREATE TABLE `pedidos_de_reparacion` (
  `id_pedidos_de_reparacion` int(11) NOT NULL,
  `id_clientes` int(11) NOT NULL,
  `fecha_de_pedido` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `numero_orden` varchar(7) DEFAULT NULL,
  `observacion` varchar(45) DEFAULT NULL,
  `id_usuario_tecnico` int(11) DEFAULT NULL,
  `id_dispositivos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_en_roles`
--

CREATE TABLE `permisos_en_roles` (
  `id_roles` int(11) NOT NULL,
  `id_permisos` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id_tecnicos` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_area_tecnico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_pago`
--

CREATE TABLE `tipo_de_pago` (
  `id_tipo_de_pago` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `id_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios_y_componentes`
--
ALTER TABLE `accesorios_y_componentes`
  ADD PRIMARY KEY (`id_accesorios_y_componentes`);

--
-- Indices de la tabla `area_tecnico`
--
ALTER TABLE `area_tecnico`
  ADD PRIMARY KEY (`id_area_tecnico`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_clientes`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `fk_detalle_facturas_facturas_compra1_idx` (`id_factura_compra`),
  ADD KEY `fk_detalle_facturas_accesorios_y_componentes1_idx` (`id_accesorios_y_componentes`);

--
-- Indices de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  ADD PRIMARY KEY (`id_detalle_reparaciones`),
  ADD KEY `fk_detalle_reparaciones_accesorios_y_componentes1_idx` (`id_accesorios_y_componentes`),
  ADD KEY `fk_detalle_reparaciones_pedidos_de_reparacion1_idx` (`id_pedidos_de_reparacion`);

--
-- Indices de la tabla `detalle_ventas_accesorios`
--
ALTER TABLE `detalle_ventas_accesorios`
  ADD PRIMARY KEY (`id_detalle_ventas_accesorios`),
  ADD KEY `fk_detalle_ventas_accesorios_factura_venta_accesorio1_idx` (`id_factura_venta_accesorio`),
  ADD KEY `fk_detalle_ventas_accesorios_accesorios_y_componentes1_idx` (`id_accesorios_y_componentes`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id_dispositivos`);

--
-- Indices de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD PRIMARY KEY (`id_facturas_compra`),
  ADD KEY `fk_facturas_proveedores` (`id_proveedores`);

--
-- Indices de la tabla `facturas_venta_reparacion`
--
ALTER TABLE `facturas_venta_reparacion`
  ADD PRIMARY KEY (`id_facturas_venta_reparacion`);

--
-- Indices de la tabla `factura_venta_accesorio`
--
ALTER TABLE `factura_venta_accesorio`
  ADD PRIMARY KEY (`id_factura_venta_accesorio`);

--
-- Indices de la tabla `historial_cambios_contrasena`
--
ALTER TABLE `historial_cambios_contrasena`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `fk_historial_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificaciones`),
  ADD KEY `fk_notificaciones_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pagos`),
  ADD KEY `fk_pagos_tipo_de_pago1_idx` (`id_tipo_pago`),
  ADD KEY `fk_pagos_facturas_compra1_idx` (`id_facturas_compra`),
  ADD KEY `fk_pagos_facturas_venta_reparacion1_idx` (`id_facturas_venta_reparacion`),
  ADD KEY `fk_pagos_factura_venta_accesorio1_idx` (`id_factura_venta_accesorio`);

--
-- Indices de la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  ADD PRIMARY KEY (`id_pedidos_de_reparacion`),
  ADD KEY `fk_pedidos_de_reparacion_clientes` (`id_clientes`),
  ADD KEY `fk_pedidos_de_reparacion_dispositivos1_idx` (`id_dispositivos`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `permisos_en_roles`
--
ALTER TABLE `permisos_en_roles`
  ADD PRIMARY KEY (`id_roles`,`id_permisos`),
  ADD KEY `fk_permisos_en_roles_roles1_idx` (`id_roles`),
  ADD KEY `fk_permisos_en_roles_permisos1_idx` (`id_permisos`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`);

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
  ADD KEY `fk_tecnicos_usuarios_idx` (`id_usuario`),
  ADD KEY `fk_tecnicos_area_tecnico1_idx` (`id_area_tecnico`);

--
-- Indices de la tabla `tipo_de_pago`
--
ALTER TABLE `tipo_de_pago`
  ADD PRIMARY KEY (`id_tipo_de_pago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD KEY `fk_usuarios_roles1_idx` (`id_roles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios_y_componentes`
--
ALTER TABLE `accesorios_y_componentes`
  MODIFY `id_accesorios_y_componentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  MODIFY `id_detalle_reparaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  MODIFY `id_facturas_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas_venta_reparacion`
--
ALTER TABLE `facturas_venta_reparacion`
  MODIFY `id_facturas_venta_reparacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_cambios_contrasena`
--
ALTER TABLE `historial_cambios_contrasena`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  MODIFY `id_pedidos_de_reparacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id_tecnicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_facturas_accesorios_y_componentes1` FOREIGN KEY (`id_accesorios_y_componentes`) REFERENCES `accesorios_y_componentes` (`id_accesorios_y_componentes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_facturas_facturas_compra1` FOREIGN KEY (`id_factura_compra`) REFERENCES `facturas_compra` (`id_facturas_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  ADD CONSTRAINT `fk_detalle_reparaciones_accesorios_y_componentes1` FOREIGN KEY (`id_accesorios_y_componentes`) REFERENCES `accesorios_y_componentes` (`id_accesorios_y_componentes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_reparaciones_pedidos_de_reparacion1` FOREIGN KEY (`id_pedidos_de_reparacion`) REFERENCES `pedidos_de_reparacion` (`id_pedidos_de_reparacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ventas_accesorios`
--
ALTER TABLE `detalle_ventas_accesorios`
  ADD CONSTRAINT `fk_detalle_ventas_accesorios_accesorios_y_componentes1` FOREIGN KEY (`id_accesorios_y_componentes`) REFERENCES `accesorios_y_componentes` (`id_accesorios_y_componentes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_accesorios_factura_venta_accesorio1` FOREIGN KEY (`id_factura_venta_accesorio`) REFERENCES `mydb`.`factura_venta_accesorio` (`idfactura_venta_accesorio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD CONSTRAINT `fk_facturas_proveedores` FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_cambios_contrasena`
--
ALTER TABLE `historial_cambios_contrasena`
  ADD CONSTRAINT `fk_historial_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_factura_venta_accesorio1` FOREIGN KEY (`id_factura_venta_accesorio`) REFERENCES `factura_venta_accesorio` (`id_factura_venta_accesorio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pagos_facturas_compra1` FOREIGN KEY (`id_facturas_compra`) REFERENCES `facturas_compra` (`id_facturas_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pagos_facturas_venta_reparacion1` FOREIGN KEY (`id_facturas_venta_reparacion`) REFERENCES `facturas_venta_reparacion` (`id_facturas_venta_reparacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pagos_tipo_de_pago1` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_de_pago` (`id_tipo_de_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  ADD CONSTRAINT `fk_pedidos_de_reparacion_clientes` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pedidos_de_reparacion_dispositivos1` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permisos_en_roles`
--
ALTER TABLE `permisos_en_roles`
  ADD CONSTRAINT `fk_permisos_en_roles_permisos1` FOREIGN KEY (`id_permisos`) REFERENCES `permisos` (`id_permisos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permisos_en_roles_roles1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD CONSTRAINT `fk_tecnicos_area_tecnico1` FOREIGN KEY (`id_area_tecnico`) REFERENCES `area_tecnico` (`id_area_tecnico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tecnicos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
