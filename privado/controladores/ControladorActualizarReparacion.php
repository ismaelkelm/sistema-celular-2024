<?php
require_once '../models/Reparaciones.php';

class ControladorActualizarReparacion {
    private $reparacionesModel;

    public function __construct() {
        $this->reparacionesModel = new Reparaciones();
    }

    public function actualizarReparacion($idReparacion, $datos) {
        return $this->reparacionesModel->actualizarReparacion($idReparacion, $datos);
    }
}
?>
