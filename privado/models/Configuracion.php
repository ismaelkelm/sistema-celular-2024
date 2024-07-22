<?php
require_once '../configuracion/database.php';

class Configuracion {
    private $conexion;
    private $tabla = 'configuracion';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function obtenerConfiguracion() {
        $query = "SELECT * FROM " . $this->tabla . " LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardarConfiguracion($datos) {
        $query = "UPDATE " . $this->tabla . " SET valor = :valor WHERE parametro = :parametro";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':valor', $datos['valor']);
        $stmt->bindParam(':parametro', $datos['parametro']);

        return $stmt->execute();
    }
}
?>
