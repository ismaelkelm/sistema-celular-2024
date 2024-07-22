<?php
require_once '../models/Piezas.php';

class ControladorInventarioPiezas {
    private $piezasModel;

    public function __construct() {
        $this->piezasModel = new Piezas();
    }

    public function obtenerInventarioPiezas() {
        return $this->piezasModel->obtenerTodasLasPiezas();
    }

    public function actualizarInventarioPiezas($idPieza, $cantidad) {
        return $this->piezasModel->actualizarPieza($idPieza, $cantidad);
    }
}
?>
