<?php
require_once '../models/Reparaciones.php';

class ControladorReparacion {
    private $reparacionesModel;

    public function __construct() {
        $this->reparacionesModel = new Reparaciones();
    }

    public function registrarReparacion($datos) {
        return $this->reparacionesModel->registrarReparacion($datos);
    }

    public function obtenerReparacion($idReparacion) {
        return $this->reparacionesModel->obtenerReparacion($idReparacion);
    }

    public function obtenerTodasLasReparaciones() {
        return $this->reparacionesModel->obtenerTodasLasReparaciones();
    }
}
?>
