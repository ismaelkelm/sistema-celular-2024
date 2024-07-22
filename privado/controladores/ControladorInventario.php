<?php
require_once '../modelos/Inventario.php';

class ControladorInventario {
    public function registrarInventario($datos) {
        $inventarioModelo = new Inventario();
        return $inventarioModelo->guardarInventario($datos);
    }

    public function verificarStock($idProducto) {
        $inventarioModelo = new Inventario();
        return $inventarioModelo->obtenerStockPorProducto($idProducto);
    }
}
?>
