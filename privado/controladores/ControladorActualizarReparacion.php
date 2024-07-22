<?php
require_once '../modelos/Reparacion.php';

class ControladorActualizarReparacion {
    public function actualizarReparacion($idReparacion, $datos) {
        $reparacionModelo = new Reparacion();
        return $reparacionModelo->actualizarReparacion($idReparacion, $datos);
    }
}
?>
