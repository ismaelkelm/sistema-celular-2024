<?php
require_once '../models/Usuarios.php';

class ControladorPerfil {
    private $usuariosModel;

    public function __construct() {
        $this->usuariosModel = new Usuarios();
    }

    public function obtenerPerfil($usuarioID) {
        return $this->usuariosModel->obtenerPerfilUsuario($usuarioID);
    }

    public function actualizarPerfil($usuarioID, $datos) {
        // Lógica para actualizar perfil
    }
}
?>
