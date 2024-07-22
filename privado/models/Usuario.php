<?php
require_once '../configuracion/database.php';

class Usuario {
    private $conexion;
    private $tabla = 'usuarios';

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function autenticar($usuario, $contrasena) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE NombreUsuario = :usuario AND Password = :contrasena LIMIT 1";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : false;
    }

    public function guardarUsuario($datos) {
        $query = "INSERT INTO " . $this->tabla . " (NombreUsuario, Password, RolID, EmpleadoID) VALUES (:nombre, :password, :rol, :empleado)";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':password', $datos['password']);
        $stmt->bindParam(':rol', $datos['rol']);
        $stmt->bindParam(':empleado', $datos['empleado']);

        return $stmt->execute();
    }

    public function obtenerUsuarioPorId($id) {
        $query = "SELECT * FROM " . $this->tabla . " WHERE UsuarioID = :id LIMIT 1";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id, $datos) {
        $query = "UPDATE " . $this->tabla . " SET NombreUsuario = :nombre, Password = :password, RolID = :rol, EmpleadoID = :empleado WHERE UsuarioID = :id";
        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':password', $datos['password']);
        $stmt->bindParam(':rol', $datos['rol']);
        $stmt->bindParam(':empleado', $datos['empleado']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
