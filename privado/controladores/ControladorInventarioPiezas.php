<?php
require_once '../modelos/Inventario.php';

class ControladorInventarioPiezas {
    public function registrarPieza($datos) {
        $inventarioModelo = new Inventario();
        return $inventarioModelo->guardarPieza($datos);
    }

    public function verificarPieza($idPieza) {
        $inventarioModelo = new Inventario();
        return $inventarioModelo->obtenerPiezaPorId($idPieza);
    }
}
?>
