<?php
require_once '../modelos/Reparacion.php';

class ControladorReparacion {
    public function registrarReparacion($datos) {
        $reparacionModelo = new Reparacion();
        return $reparacionModelo->guardarReparacion($datos);
    }

    public function actualizarReparacion($idReparacion, $estado) {
        $reparacionModelo = new Reparacion();
        return $reparacionModelo->actualizarEstado($idReparacion, $estado);
    }
}
?>
