<?php
require_once '../models/Reparaciones.php';

class ControladorReparacionesAsignadas {
    private $reparacionesModel;

    public function __construct() {
        $this->reparacionesModel = new Reparaciones();
    }

    public function obtenerReparacionesAsignadas($idTecnico) {
        // Lógica para obtener reparaciones asignadas a un técnico
    }
}
?>
