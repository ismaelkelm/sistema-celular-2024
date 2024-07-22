<?php
require_once '../modelos/Reparacion.php';

class ControladorHistorial {
    public function obtenerHistorialReparaciones($idCliente) {
        $reparacionModelo = new Reparacion();
        return $reparacionModelo->obtenerHistorialPorCliente($idCliente);
    }
}
?>
