<?php
require_once '../configuracion/database.php';

class Reparacion {
    private $conexion;
    private $tabla = 'reparaciones';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function guardarReparacion($datos) {
        $query = "INSERT INTO " . $this->tabla . " (PedidoID, Estado, FechaInicio, FechaFin) VALUES (:pedido, :estado, :inicio, :fin)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':pedido', $datos['pedido']);
        $stmt->bindParam(':estado', $datos['estado']);
        $stmt->bindParam(':inicio', $datos['inicio']);
        $stmt->bindParam(':fin', $datos['fin']);

        return $stmt->execute();
    }

    public function actualizarEstado($idReparacion, $estado) {
        $query = "UPDATE " . $this->tabla . " SET Estado = :estado WHERE ReparacionID = :id";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $idReparacion);

        return $stmt->execute();
    }

    public function obtenerEstadoPorId($idReparacion) {
        $query = "SELECT Estado FROM " . $this->tabla . " WHERE ReparacionID = :id";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':id', $idReparacion);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerHistorialPorCliente($idCliente) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE ClienteID = :idCliente";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
