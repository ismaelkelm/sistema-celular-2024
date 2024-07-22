<?php
require_once '../models/Accesorios.php';

class ControladorInventario {
    private $accesoriosModel;

    public function __construct() {
        $this->accesoriosModel = new Accesorios();
    }

    public function obtenerInventario() {
        return $this->accesoriosModel->obtenerTodosLosAccesorios();
    }

    public function actualizarInventario($idAccesorio, $cantidad) {
        return $this->accesoriosModel->actualizarStock($idAccesorio, $cantidad);
    }
}
?>
