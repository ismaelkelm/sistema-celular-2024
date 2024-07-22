<?php
require_once '../modelos/Pagos.php';

class ControladorPagos {
    public function registrarPago($datos) {
        $pagosModelo = new Pagos();
        return $pagosModelo->guardarPago($datos);
    }

    public function verificarPago($idPedido) {
        $pagosModelo = new Pagos();
        return $pagosModelo->obtenerPagoPorPedido($idPedido);
    }
}
?>
