<?php
require_once '../models/Pedidos.php';

class ControladorPedido {
    private $pedidosModel;

    public function __construct() {
        $this->pedidosModel = new Pedidos();
    }

    public function registrarPedido($datos) {
        return $this->pedidosModel->registrarPedido($datos);
    }

    public function obtenerPedido($idPedido) {
        return $this->pedidosModel->obtenerPedido($idPedido);
    }

    public function obtenerTodosLosPedidos() {
        return $this->pedidosModel->obtenerTodosLosPedidos();
    }
}
?>
