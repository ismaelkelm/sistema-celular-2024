<?php
require_once '../modelos/Usuario.php';

class ControladorUsuario {
    public function registrarUsuario($datos) {
        $usuarioModelo = new Usuario();
        return $usuarioModelo->guardarUsuario($datos);
    }

    public function obtenerUsuario($id) {
        $usuarioModelo = new Usuario();
        return $usuarioModelo->obtenerUsuarioPorId($id);
    }
}
?>
