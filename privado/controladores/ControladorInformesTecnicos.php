<?php
require_once '../models/InformesTecnicos.php';

class ControladorInformesTecnicos {
    private $informesModel;

    public function __construct() {
        $this->informesModel = new InformesTecnicos();
    }

    public function generarInforme($datos) {
        return $this->informesModel->generarInforme($datos);
    }

    public function obtenerInformes() {
        return $this->informesModel->obtenerInformes();
    }
}
?>
