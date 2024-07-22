<?php
require_once '../models/Pagos.php';

class ControladorFacturacion {
    private $pagosModel;

    public function __construct() {
        $this->pagosModel = new Pagos();
    }

    public function registrarPago($datos) {
        return $this->pagosModel->registrarPago($datos);
    }

    public function obtenerFacturas($clienteID) {
        // Lógica para obtener facturas de un cliente
    }
}
?>
