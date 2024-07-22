<?php
require_once '../models/HistorialReparaciones.php';

class ControladorHistorial {
    private $historialModel;

    public function __construct() {
        $this->historialModel = new HistorialReparaciones();
    }

    public function obtenerHistorial($idReparacion) {
        return $this->historialModel->obtenerHistorial($idReparacion);
    }
}
?>
