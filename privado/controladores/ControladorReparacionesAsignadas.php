<?php
require_once '../modelos/Reparacion.php';

class ControladorReparacionesAsignadas {
    public function obtenerReparacionesAsignadas($idTecnico) {
        $reparacionModelo = new Reparacion();
        return $reparacionModelo->obtenerReparacionesPorTecnico($idTecnico);
    }
}
?>
