<?php
require_once '../modelos/Configuracion.php';

class ControladorConfiguracion {
    public function obtenerConfiguracion() {
        $configuracionModelo = new Configuracion();
        return $configuracionModelo->obtenerConfiguracion();
    }

    public function actualizarConfiguracion($datos) {
        $configuracionModelo = new Configuracion();
        return $configuracionModelo->guardarConfiguracion($datos);
    }
}
?>
