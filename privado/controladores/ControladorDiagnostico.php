<?php
require_once '../modelos/Diagnostico.php';

class ControladorDiagnostico {
    public function registrarDiagnostico($datos) {
        $diagnosticoModelo = new Diagnostico();
        return $diagnosticoModelo->guardarDiagnostico($datos);
    }

    public function obtenerDiagnostico($idReparacion) {
        $diagnosticoModelo = new Diagnostico();
        return $diagnosticoModelo->obtenerDiagnosticoPorReparacion($idReparacion);
    }
}
?>
