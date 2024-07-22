<?php
require_once '../modelos/Reportes.php';

class ControladorReportes {
    public function generarReporteVentas($fechaInicio, $fechaFin) {
        $reportesModelo = new Reportes();
        return $reportesModelo->reporteVentas($fechaInicio, $fechaFin);
    }

    public function generarReporteReparaciones($fechaInicio, $fechaFin) {
        $reportesModelo = new Reportes();
        return $reportesModelo->reporteReparaciones($fechaInicio, $fechaFin);
    }
}
?>
