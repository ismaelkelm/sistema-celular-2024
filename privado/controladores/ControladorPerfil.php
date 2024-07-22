<?php
require_once '../modelos/Usuario.php';

class ControladorPerfil {
    public function obtenerPerfil($idUsuario) {
        $usuarioModelo = new Usuario();
        return $usuarioModelo->obtenerUsuarioPorId($idUsuario);
    }

    public function actualizarPerfil($idUsuario, $datos) {
        $usuarioModelo = new Usuario();
        return $usuarioModelo->actualizarUsuario($idUsuario, $datos);
    }
}
?>
