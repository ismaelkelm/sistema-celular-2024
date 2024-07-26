<?php
// Modelo para usuarios

class Usuario {
    public $id;
    public $nombre;
    public $email;

    function __construct($id, $nombre, $email) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
    }

    function obtenerDetalles() {
        // Implementar lógica para obtener detalles del usuario
    }
}
?>
