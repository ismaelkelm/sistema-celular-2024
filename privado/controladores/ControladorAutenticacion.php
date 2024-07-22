<?php
require_once '../modelos/Usuario.php';
require_once '../ayudantes/sesion.php';

class ControladorAutenticacion {
    public function iniciarSesion($usuario, $contrasena) {
        $usuarioModelo = new Usuario();
        $resultado = $usuarioModelo->autenticar($usuario, $contrasena);
        
        if ($resultado) {
            iniciarSesion($resultado);
            return true;
        } else {
            return false;
        }
    }

    public function cerrarSesion() {
        cerrarSesion();
    }
}
?>
