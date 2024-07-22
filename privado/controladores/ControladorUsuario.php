<?php
require_once '../models/Usuarios.php';

class ControladorUsuario {
    private $usuariosModel;

    public function __construct() {
        $this->usuariosModel = new Usuarios();
    }

    public function agregarUsuario($datos) {
        return $this->usuariosModel->agregarUsuario($datos);
    }

    public function actualizarUsuario($idUsuario, $datos) {
        return $this->usuariosModel->actualizarUsuario($idUsuario, $datos);
    }

    public function eliminarUsuario($idUsuario) {
        return $this->usuariosModel->eliminarUsuario($idUsuario);
    }

    public function obtenerUsuario($idUsuario) {
        return $this->usuariosModel->obtenerUsuario($idUsuario);
    }

    public function obtenerTodosLosUsuarios() {
        return $this->usuariosModel->obtenerTodosLosUsuarios();
    }
}
?>
