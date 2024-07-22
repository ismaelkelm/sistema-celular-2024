<?php
require_once '../models/Usuarios.php';

class ControladorAutenticacion {
    private $usuariosModel;

    public function __construct() {
        $this->usuariosModel = new Usuarios();
    }

    public function autenticarUsuario($usuario, $password) {
        return $this->usuariosModel->autenticarUsuario($usuario, $password);
    }

    public function registrarUsuario($usuario, $password) {
        return $this->usuariosModel->registrarUsuario($usuario, $password);
    }
}
?>
