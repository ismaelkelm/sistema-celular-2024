<?php
require_once '../configuracion/database.php';

class Inventario {
    private $conexion;
    private $tabla = 'piezas';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function guardarInventario($datos) {
        $query = "INSERT INTO " . $this->tabla . " (PiezaID, Cantidad) VALUES (:pieza, :cantidad)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':pieza', $datos['pieza']);
        $stmt->bindParam(':cantidad', $datos['cantidad']);

        return $stmt->execute();
    }

    public function obtenerStockPorProducto($idProducto) {
        $query = "SELECT Cantidad FROM " . $this->tabla . " WHERE PiezaID = :idProducto";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardarPieza($datos) {
        $query = "INSERT INTO " . $this->tabla . " (PiezaID, Cantidad) VALUES (:pieza, :cantidad)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':pieza', $datos['pieza']);
        $stmt->bindParam(':cantidad', $datos['cantidad']);

        return $stmt->execute();
    }

    public function obtenerPiezaPorId($idPieza) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE PiezaID = :idPieza";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idPieza', $idPieza);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
