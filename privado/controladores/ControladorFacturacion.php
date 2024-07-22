<?php
require_once '../modelos/Factura.php';

class ControladorFacturacion {
    public function generarFactura($datos) {
        $facturaModelo = new Factura();
        return $facturaModelo->crearFactura($datos);
    }
}
?>
