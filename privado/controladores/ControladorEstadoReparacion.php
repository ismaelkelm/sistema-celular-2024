<?php
require_once '../models/Reparaciones.php';

class ControladorEstadoReparacion {
    private $reparacionesModel;

    public function __construct() {
        $this->reparacionesModel = new Reparaciones();
    }

    public function obtenerEstadoReparacion($numeroOrden) {
        return $this->reparacionesModel->obtenerEstadoReparacion($numeroOrden);
    }

    public function actualizarEstadoReparacion($numeroOrden, $estado) {
        return $this->reparacionesModel->actualizarEstadoReparacion($numeroOrden, $estado);
    }
}
?>
