<?php
require_once '../configuracion/database.php';

class Factura {
    private $conexion;
    private $tabla = 'facturas';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function crearFactura($datos) {
        $query = "INSERT INTO " . $this->tabla . " (PedidoID, Monto, Fecha) VALUES (:pedido, :monto, :fecha)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':pedido', $datos['pedido']);
        $stmt->bindParam(':monto', $datos['monto']);
        $stmt->bindParam(':fecha', $datos['fecha']);

        return $stmt->execute();
    }
}
?>
