-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2024 a las 01:24:07
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

--
-- Volcado de datos para la tabla `accesorios_y_componentes`
--

INSERT INTO `accesorios_y_componentes` (`id_accesorios_y_componentes`, `nombre`, `descripcion`, `stock`, `precio`, `tipo`, `stockmin`, `stockmaximo`) VALUES
(1, 'Teclado', 'Teclado mecánico', 100, 50.00, 1, 10, 200),
(2, 'Ratón', 'Ratón ergonómico', 150, 25.00, 2, 5, 100),
(3, 'Monitor', 'Monitor 24 pulgadas', 50, 150.00, 3, 5, 30),
(4, 'Cable HDMI', 'Cable HDMI 2m', 200, 15.00, 4, 20, 1000),
(5, 'Webcam', 'Webcam HD', 75, 60.00, 5, 10, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_tecnico`
--

CREATE TABLE `area_tecnico` (
  `id_area_tecnico` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area_tecnico`
--

INSERT INTO `area_tecnico` (`id_area_tecnico`, `nombre`) VALUES
(1, 'Soporte Técnico'),
(2, 'Mantenimiento'),
(3, 'Instalaciones'),
(4, 'Desarrollo'),
(5, 'Investigación');

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

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_clientes`, `nombre`, `apellido`, `telefono`, `correo_electronico`, `direccion`, `dni`) VALUES
(1, 'Juan', 'Pérez', '123456789', 'juan.perez@example.com', 'Calle Falsa 123', '12345678A'),
(2, 'Ana', 'Gómez', '987654321', 'ana.gomez@example.com', 'Avenida Siempre Viva 742', '87654321B'),
(3, 'Luis', 'Rodríguez', '456123789', 'luis.rodriguez@example.com', 'Plaza Mayor 1', '45678912C'),
(4, 'María', 'Martínez', '321654987', 'maria.martinez@example.com', 'Calle Luna 9', '32165498D'),
(5, 'Pedro', 'Sánchez', '159753468', 'pedro.sanchez@example.com', 'Paseo del Prado 45', '15975347E');

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

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detalle_compra`, `cantidad`, `precio_unitario`, `id_factura_compra`, `id_accesorios_y_componentes`) VALUES
(2, 5, 100.00, 1, 1),
(3, 10, 200.00, 2, 2),
(4, 3, 50.00, 1, 3),
(5, 8, 150.00, 3, 4),
(6, 2, 300.00, 2, 5);

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

--
-- Volcado de datos para la tabla `detalle_reparaciones`
--

INSERT INTO `detalle_reparaciones` (`id_detalle_reparaciones`, `cantidad`, `precio_unitario`, `id_accesorios_y_componentes`, `id_pedidos_de_reparacion`) VALUES
(1, 2, 50.00, 1, 1),
(2, 1, 30.00, 2, 1),
(3, 4, 120.00, 3, 2),
(4, 3, 15.00, 4, 2),
(5, 5, 60.00, 5, 3);

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

--
-- Volcado de datos para la tabla `detalle_ventas_accesorios`
--

INSERT INTO `detalle_ventas_accesorios` (`id_detalle_ventas_accesorios`, `cantidad`, `precio_total`, `id_factura_venta_accesorio`, `id_accesorios_y_componentes`) VALUES
(1, 3, 150.00, 1, 1),
(2, 2, 50.00, 1, 2),
(3, 1, 140.00, 2, 3),
(4, 10, 120.00, 2, 4),
(5, 2, 120.00, 3, 5);

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
(1, 'Dell', 'XPS 15', 'D12345', 'Nuevo'),
(2, 'HP', 'Spectre x360', 'H67890', 'Usado'),
(3, 'Apple', 'MacBook Pro', 'A11223', 'Nuevo'),
(4, 'Lenovo', 'ThinkPad X1', 'L44556', 'Reparado'),
(5, 'Acer', 'Aspire 5', 'A77889', 'Nuevo');

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

--
-- Volcado de datos para la tabla `facturas_compra`
--

INSERT INTO `facturas_compra` (`id_facturas_compra`, `id_proveedores`, `fecha_de_emision`, `subtotal`, `impuestos`, `total`) VALUES
(1, 1, '2024-08-01', 1000.00, 200.00, 1200.00),
(2, 2, '2024-08-05', 800.00, 160.00, 960.00),
(3, 3, '2024-08-10', 1200.00, 240.00, 1440.00),
(4, 4, '2024-08-15', 600.00, 120.00, 720.00),
(5, 5, '2024-08-20', 400.00, 80.00, 480.00);

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

--
-- Volcado de datos para la tabla `facturas_venta_reparacion`
--

INSERT INTO `facturas_venta_reparacion` (`id_facturas_venta_reparacion`, `fecha_de_emision`, `subtotal`, `impuestos`, `total`) VALUES
(1, '2024-08-01', 300.00, 60.00, 360.00),
(2, '2024-08-05', 400.00, 80.00, 480.00),
(3, '2024-08-10', 250.00, 50.00, 300.00),
(4, '2024-08-15', 500.00, 100.00, 600.00),
(5, '2024-08-20', 350.00, 70.00, 420.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_venta_accesorio`
--

CREATE TABLE `factura_venta_accesorio` (
  `id_factura_venta_accesorio` int(11) NOT NULL,
  `numero_factura` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura_venta_accesorio`
--

INSERT INTO `factura_venta_accesorio` (`id_factura_venta_accesorio`, `numero_factura`, `fecha`) VALUES
(1, 'FAC-20240801', '2024-08-01'),
(2, 'FAC-20240802', '2024-08-02'),
(3, 'FAC-20240803', '2024-08-03'),
(4, 'FAC-20240804', '2024-08-04'),
(5, 'FAC-20240805', '2024-08-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cambios_contrasena`
--

CREATE TABLE `historial_cambios_contrasena` (
  `id_historial` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_cambios_contrasena`
--

INSERT INTO `historial_cambios_contrasena` (`id_historial`, `id_usuario`, `fecha_cambio`) VALUES
(1, 1, '2024-08-01 13:00:00'),
(2, 2, '2024-08-02 14:00:00'),
(3, 3, '2024-08-03 15:00:00'),
(4, 4, '2024-08-04 16:00:00'),
(5, 5, '2024-08-05 17:00:00');

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

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificaciones`, `id_usuario`, `mensaje`, `fecha_envio`) VALUES
(1, 1, 'Cambio de contraseña exitoso', '2024-08-01 12:00:00'),
(2, 2, 'Nueva factura generada', '2024-08-02 13:00:00'),
(3, 3, 'Nuevo pedido de reparación', '2024-08-03 14:00:00'),
(4, 4, 'Actualización de stock', '2024-08-04 15:00:00'),
(5, 5, 'Nuevo cliente registrado', '2024-08-05 16:00:00');

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

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pagos`, `fecha_pago`, `monto`, `id_tipo_pago`, `id_facturas_compra`, `id_facturas_venta_reparacion`, `id_factura_venta_accesorio`) VALUES
(1, '2024-08-01', 500.00, 1, 1, 0, 0),
(2, '2024-08-05', 300.00, 2, 0, 1, 0),
(3, '2024-08-10', 150.00, 1, 0, 0, 1),
(4, '2024-08-15', 700.00, 3, 2, 0, 0);

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

--
-- Volcado de datos para la tabla `pedidos_de_reparacion`
--

INSERT INTO `pedidos_de_reparacion` (`id_pedidos_de_reparacion`, `id_clientes`, `fecha_de_pedido`, `estado`, `numero_orden`, `observacion`, `id_usuario_tecnico`, `id_dispositivos`) VALUES
(1, 101, '2024-08-20', 'En espera', 'ORD001', 'Reparar pantalla rota', 5, 1),
(2, 102, '2024-08-22', 'En reparación', 'ORD002', 'Cambio de batería', 6, 2),
(3, 103, '2024-08-23', 'Completado', 'ORD003', 'Actualización de software', 7, 3),
(4, 104, '2024-08-25', 'En espera', 'ORD004', 'Problema de conexión Wi-Fi', 8, 4),
(5, 105, '2024-08-27', 'En reparación', 'ORD005', 'Sustitución del disco duro', 9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permisos`, `descripcion`) VALUES
(1, 'accesorios_y_componentes'),
(2, 'area_tecnico'),
(3, 'clientes'),
(4, 'detalle_compra'),
(5, 'detalle_reparaciones'),
(6, 'detalle_ventas_accesorios'),
(7, 'dispositivos'),
(9, 'facturas_compra'),
(10, 'facturas_venta_reparacion'),
(8, 'factura_venta_accesorio'),
(11, 'historial_cambios_contrasena'),
(12, 'notificaciones'),
(13, 'pagos'),
(14, 'pedidos_de_reparacion'),
(15, 'permisos'),
(16, 'permisos_en_roles'),
(17, 'proveedores'),
(18, 'roles'),
(19, 'tecnicos'),
(20, 'tipo_de_pago'),
(21, 'usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_en_roles`
--

CREATE TABLE `permisos_en_roles` (
  `id_roles` int(11) NOT NULL,
  `id_permisos` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos_en_roles`
--

INSERT INTO `permisos_en_roles` (`id_roles`, `id_permisos`, `estado`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(1, 6, 0),
(1, 7, 0),
(1, 8, 0),
(1, 9, 0),
(1, 10, 0),
(1, 11, 0),
(1, 12, 0),
(1, 13, 0),
(1, 14, 0),
(1, 15, 0),
(1, 16, 0),
(1, 17, 1),
(1, 18, 0),
(1, 19, 1),
(1, 20, 1),
(1, 21, 0),
(2, 1, 0),
(2, 2, 0),
(2, 3, 0),
(2, 4, 0),
(2, 5, 1),
(2, 6, 1),
(2, 7, 0),
(2, 8, 0),
(2, 9, 0),
(2, 10, 0),
(2, 11, 0),
(2, 12, 1),
(2, 13, 0),
(2, 14, 0),
(2, 15, 0),
(2, 16, 0),
(2, 17, 0),
(2, 18, 0),
(2, 19, 0),
(2, 20, 0),
(2, 21, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 0),
(3, 4, 0),
(3, 5, 1),
(3, 6, 1),
(3, 7, 0),
(3, 8, 0),
(3, 9, 0),
(3, 10, 0),
(3, 11, 0),
(3, 12, 1),
(3, 13, 0),
(3, 14, 0),
(3, 15, 0),
(3, 16, 0),
(3, 17, 0),
(3, 18, 0),
(3, 19, 0),
(3, 20, 0),
(3, 21, 0),
(4, 1, 0),
(4, 2, 0),
(4, 3, 0),
(4, 4, 0),
(4, 5, 0),
(4, 6, 0),
(4, 7, 0),
(4, 8, 0),
(4, 9, 0),
(4, 10, 0),
(4, 11, 0),
(4, 12, 0),
(4, 13, 0),
(4, 14, 0),
(4, 15, 0),
(4, 16, 0),
(4, 17, 0),
(4, 18, 0),
(4, 19, 0),
(4, 20, 0),
(4, 21, 0),
(5, 1, 0),
(5, 2, 0),
(5, 3, 0),
(5, 4, 0),
(5, 5, 1),
(5, 6, 1),
(5, 7, 0),
(5, 8, 0),
(5, 9, 0),
(5, 10, 0),
(5, 11, 0),
(5, 12, 1),
(5, 13, 0),
(5, 14, 0),
(5, 15, 0),
(5, 16, 0),
(5, 17, 0),
(5, 18, 0),
(5, 19, 0),
(5, 20, 0),
(5, 21, 0);

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

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedores`, `nombre`, `contacto`, `telefono`, `correo_electronico`, `direccion`) VALUES
(1, 'Proveedor A', 'Juan Pérez', '555-1234', 'juan.perez@proveedora.com', 'Calle Falsa 123, Ciudad, País'),
(2, 'Proveedor B', 'Ana Gómez', '555-5678', 'ana.gomez@proveedorb.com', 'Avenida Siempre Viva 456, Ciudad, País'),
(3, 'Proveedor C', 'Luis Martínez', '555-8765', 'luis.martinez@proveedorc.com', 'Boulevard Libertad 789, Ciudad, País'),
(4, 'Proveedor D', 'Marta Fernández', '555-4321', 'marta.fernandez@proveedord.com', 'Plaza Mayor 101, Ciudad, País'),
(5, 'Proveedor E', 'Carlos López', '555-2468', 'carlos.lopez@proveedore.com', 'Ronda Norte 202, Ciudad, País');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'administrativo'),
(3, 'tecnico'),
(4, 'cliente'),
(5, 'empleado');

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

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`id_tecnicos`, `nombre`, `id_usuario`, `id_area_tecnico`) VALUES
(1, 'Pedro Sánchez', 3, 1),
(2, 'Laura Martínez', 4, 2),
(3, 'Carlos Gómez', 5, 3),
(4, 'Ana Fernández', 6, 4),
(5, 'Luis Rodríguez', 7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_pago`
--

CREATE TABLE `tipo_de_pago` (
  `id_tipo_de_pago` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_de_pago`
--

INSERT INTO `tipo_de_pago` (`id_tipo_de_pago`, `descripcion`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta de Crédito'),
(3, 'Transferencia Bancaria'),
(4, 'Cheque'),
(5, 'PayPal');

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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellido`, `correo_electronico`, `contraseña`, `id_roles`) VALUES
(1, 'a', 'a', 'a@gmail.com', '$2y$10$3yUkYp8RbGyL5nZSgBUQxO3jHvnlkTtcbp8z3VzXIDkEmKZmKsOF.', 1),
(2, 'b', 'b', 'b@gmail.com', '$2y$10$O1OzhSgYZnA4rBoA7x1Jp.4SUQ.SwsOOXa3LnmHLlmMSCiNdG63XK', 2),
(3, 'tecnico1', 'tecnico1', 'tecnico1@gmail.com', '$2y$10$POZCBPZcTh191s/hgBfu.e05RWX02v2rkq3/t/sU1QiyoBXyNDvl2', 3),
(4, 'tecnico2', 'tecnico2', 'tecnico2@gmail.com', '$2y$10$etvX08UcFqI6pYTjRrrfQ.ue9viANbfnT5TyVp8sjZBBpNv3xyTsy', 3),
(5, 'tecnico3', 'tecnico3', 'tecnico3@gmail.com', '$2y$10$cSzZkTcvkBw/D.yy6lwUHO6CsyFmTKLX48EZLv3pAOVlAP1DC3VXu', 3),
(6, 'tecnico4', 'tecnico4', 'tecnico4@gmail.com', '$2y$10$hXvtobFxsA08Py0Q5lksXuAInrL6JBCzsJ/Xauw315JjEi1pbfe2i', 3),
(7, 'tecnico5', 'tecnico5', 'tecnico5@gmail.com', '$2y$10$E2tPKn88S16NgOFgbXGEMeaEcejn4o7JXw1NVTa7wHlwn556lcCAu', 3),
(8, 'd', 'd', 'd@gmail.com', '$2y$10$7PJUjtO7QO06tPxoM0XIIesQo9Uf62cX2rlrY5QaYrJLaSYLi27ji', 4),
(9, 'e', 'e', 'e@gmail.com', '$2y$10$Kbmjz3nkvB8QWJ9EZIbBSuMRh2NG1lnHKchdwGcn0CKLBUELqfhR.', 5);

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
  MODIFY `id_accesorios_y_componentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_reparaciones`
--
ALTER TABLE `detalle_reparaciones`
  MODIFY `id_detalle_reparaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  MODIFY `id_facturas_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas_venta_reparacion`
--
ALTER TABLE `facturas_venta_reparacion`
  MODIFY `id_facturas_venta_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial_cambios_contrasena`
--
ALTER TABLE `historial_cambios_contrasena`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos_de_reparacion`
--
ALTER TABLE `pedidos_de_reparacion`
  MODIFY `id_pedidos_de_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id_tecnicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
