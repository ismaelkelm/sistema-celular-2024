<?php
require_once '../configuracion/database.php';

class Pedido {
    private $conexion;
    private $tabla = 'pedidos';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function guardarPedido($datos) {
        $query = "INSERT INTO " . $this->tabla . " (ClienteID, Estado, FechaCreacion, Descripcion) VALUES (:cliente, :estado, :fecha, :descripcion)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':cliente', $datos['cliente']);
        $stmt->bindParam(':estado', $datos['estado']);
        $stmt->bindParam(':fecha', $datos['fecha']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);

        return $stmt->execute();
    }

    public function obtenerPedidosPorCliente($idCliente) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE ClienteID = :idCliente";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
