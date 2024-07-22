<?php
require_once '../configuracion/database.php';

class StockAccesorios {
    private $conexion;
    private $tabla = 'stockaccesorios';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function agregarAccesorio($datos) {
        $query = "INSERT INTO " . $this->tabla . " (AccesorioID, Cantidad) VALUES (:accesorio, :cantidad)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':accesorio', $datos['accesorio']);
        $stmt->bindParam(':cantidad', $datos['cantidad']);

        return $stmt->execute();
    }

    public function actualizarStock($idAccesorio, $cantidad) {
        $query = "UPDATE " . $this->tabla . " SET Cantidad = :cantidad WHERE AccesorioID = :id";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':id', $idAccesorio);

        return $stmt->execute();
    }

    public function obtenerStockPorAccesorio($idAccesorio) {
        $query = "SELECT Cantidad FROM " . $this->tabla . " WHERE AccesorioID = :idAccesorio";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idAccesorio', $idAccesorio);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTodosLosAccesorios() {
        $query = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
