<?php
require_once '../configuracion/database.php';

class Diagnostico {
    private $conexion;
    private $tabla = 'diagnosticos';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    // Crear un nuevo diagnóstico
    public function crearDiagnostico($datos) {
        $query = "INSERT INTO " . $this->tabla . " (descripcion, reparacion_recomendada) VALUES (:descripcion, :reparacion_recomendada)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':reparacion_recomendada', $datos['reparacion_recomendada']);

        return $stmt->execute();
    }

    // Obtener todos los diagnósticos
    public function obtenerTodosDiagnosticos() {
        $query = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
