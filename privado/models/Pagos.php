<?php
require_once '../configuracion/database.php';

class Pagos {
    private $conexion;
    private $tabla = 'pagos';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function guardarPago($datos) {
        $query = "INSERT INTO " . $this->tabla . " (FacturaID, Monto, FechaPago) VALUES (:factura, :monto, :fecha)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':factura', $datos['factura']);
        $stmt->bindParam(':monto', $datos['monto']);
        $stmt->bindParam(':fecha', $datos['fecha']);

        return $stmt->execute();
    }

    public function obtenerPagosPorFactura($idFactura) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE FacturaID = :idFactura";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':idFactura', $idFactura);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
