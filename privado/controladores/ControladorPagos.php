<?php
require_once '../models/Pagos.php';

class ControladorPagos {
    private $pagosModel;

    public function __construct() {
        $this->pagosModel = new Pagos();
    }

    public function registrarPago($datos) {
        return $this->pagosModel->registrarPago($datos);
    }

    public function verificarPago($numeroOrden) {
        return $this->pagosModel->verificarPago($numeroOrden);
    }
}
?>
