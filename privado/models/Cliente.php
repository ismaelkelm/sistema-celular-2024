<?php
require_once '../configuracion/database.php';

class Cliente {
    private $conexion;
    private $tabla = 'clientes';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function guardarCliente($datos) {
        $query = "INSERT INTO " . $this->tabla . " (Nombre, Email, Telefono) VALUES (:nombre, :email, :telefono)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':telefono', $datos['telefono']);

        return $stmt->execute();
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE ClienteID = :id LIMIT 1";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCliente($id, $datos) {
        $query = "UPDATE " . $this->tabla . " SET Nombre = :nombre, Email = :email, Telefono = :telefono WHERE ClienteID = :id";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function eliminarCliente($id) {
        $query = "DELETE FROM " . $this->tabla . " WHERE ClienteID = :id";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
