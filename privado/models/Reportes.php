<?php
require_once '../configuracion/database.php';

class Reportes {
    private $conexion;
    private $tabla = 'reportes';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function reporteVentas($fechaInicio, $fechaFin) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE FechaGeneracion BETWEEN :inicio AND :fin AND TipoReporte = 'venta'";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':inicio', $fechaInicio);
        $stmt->bindParam(':fin', $fechaFin);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reporteReparaciones($fechaInicio, $fechaFin) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE FechaGeneracion BETWEEN :inicio AND :fin AND TipoReporte = 'reparacion'";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':inicio', $fechaInicio);
        $stmt->bindParam(':fin', $fechaFin);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
