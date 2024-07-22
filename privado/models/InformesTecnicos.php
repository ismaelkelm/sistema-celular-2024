<?php
require_once '../configuracion/database.php';

class InformesTecnicos {
    private $conexion;
    private $tabla = 'informes_tecnicos';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function crearInforme($datos) {
        $query = "INSERT INTO " . $this->tabla . " (ReparacionID, Informe, Fecha) VALUES (:reparacion, :informe, :fecha)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':reparacion', $datos['reparacion']);
        $stmt->bindParam(':informe', $datos['informe']);
        $stmt->bindParam(':fecha', $datos['fecha']);

        return $stmt->execute();
    }
}
?>
