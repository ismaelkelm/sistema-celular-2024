<?php
require_once '../modelos/Pedido.php';

class ControladorPedido {
    public function registrarPedido($datos) {
        $pedidoModelo = new Pedido();
        return $pedidoModelo->guardarPedido($datos);
    }

    public function obtenerPedidos($idCliente) {
        $pedidoModelo = new Pedido();
        return $pedidoModelo->obtenerPedidosPorCliente($idCliente);
    }
}
?>
