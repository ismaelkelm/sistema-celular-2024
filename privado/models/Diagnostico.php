<?php
require_once '../configuracion/database.php';

class Diagnostico {
    private $conexion;
    private $tabla = 'diagnosticos';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function guardarDiagnostico($datos) {
        $query = "INSERT INTO " . $this->tabla . " (ReparacionID, Diagnostico, Fecha) VALUES (:reparacion, :diagnostico, :fecha)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':reparacion', $datos['reparacion']);
        $stmt->bindParam(':diagnostico', $datos['diagnostico']);
        $stmt->bindParam(':fecha', $datos['fecha']);

        return $stmt->execute();
    }

    public function obtenerDiagnosticoPorReparacion($idReparacion) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE ReparacionID = :idReparacion";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idReparacion', $idReparacion);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
