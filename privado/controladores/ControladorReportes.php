<?php
require_once '../models/Reportes.php';

class ControladorReportes {
    private $reportesModel;

    public function __construct() {
        $this->reportesModel = new Reportes();
    }

    public function generarReporte($datos) {
        return $this->reportesModel->generarReporte($datos);
    }

    public function obtenerReporte($idReporte) {
        return $this->reportesModel->obtenerReporte($idReporte);
    }

    public function obtenerTodosLosReportes() {
        return $this->reportesModel->obtenerTodosLosReportes();
    }
}
?>
