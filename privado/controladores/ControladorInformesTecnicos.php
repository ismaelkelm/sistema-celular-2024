<?php
require_once '../modelos/InformesTecnicos.php';

class ControladorInformesTecnicos {
    public function generarInforme($datos) {
        $informesTecnicosModelo = new InformesTecnicos();
        return $informesTecnicosModelo->crearInforme($datos);
    }
}
?>
