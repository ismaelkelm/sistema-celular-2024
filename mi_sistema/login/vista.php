<?php
// Modelo para vistas

class Vista {
    public $id;
    public $nombre;

    function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}
?>
