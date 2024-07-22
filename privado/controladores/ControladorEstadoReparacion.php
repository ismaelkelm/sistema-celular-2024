<?php
require_once '../modelos/Reparacion.php';

class ControladorEstadoReparacion {
    public function obtenerEstadoReparacion($idReparacion) {
        $reparacionModelo = new Reparacion();
        return $reparacionModelo->obtenerEstadoPorId($idReparacion);
    }
}
?>
