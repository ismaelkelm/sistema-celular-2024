<?php
// Implementa las funcionalidades relacionadas con la configuración aquí
// Por ejemplo: cargar, actualizar, y guardar configuraciones

class ControladorConfiguracion {
    public function cargarConfiguracion() {
        // Lógica para cargar configuración
    }

    public function actualizarConfiguracion($datos) {
        // Lógica para actualizar configuración
    }

    public function guardarConfiguracion($datos) {
        // Lógica para guardar configuración
    }
}
?>
<?php
require_once '../modelos/Configuraciones.php';

class ControladorConfiguracion {
    private $modeloConfiguracion;

    public function __construct() {
        $this->modeloConfiguracion = new Configuracion();
    }

    // Cargar configuración
    public function cargarConfiguracion() {
        try {
            $configuracion = $this->modeloConfiguracion->obtenerConfiguracion();
            if ($configuracion) {
                return json_encode($configuracion); // Retorna la configuración en formato JSON
            } else {
                return json_encode(["mensaje" => "No se encontró configuración"]);
            }
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]);
        }
    }

    // Actualizar configuración
    public function actualizarConfiguracion($datos) {
        try {
            // Validación simple
            if (empty($datos['parametro']) || empty($datos['valor'])) {
                return json_encode(["error" => "Parámetro o valor no pueden estar vacíos"]);
            }

            $resultado = $this->modeloConfiguracion->guardarConfiguracion($datos);
            if ($resultado) {
                return json_encode(["mensaje" => "Configuración actualizada exitosamente"]);
            } else {
                return json_encode(["error" => "No se pudo actualizar la configuración"]);
            }
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]);
        }
    }

    // Guardar nueva configuración
    public function guardarConfiguracion($datos) {
        try {
            // Validación simple
            if (empty($datos['parametro']) || empty($datos['valor'])) {
                return json_encode(["error" => "Parámetro o valor no pueden estar vacíos"]);
            }

            $resultado = $this->modeloConfiguracion->guardarConfiguracion($datos);
            if ($resultado) {
                return json_encode(["mensaje" => "Configuración guardada exitosamente"]);
            } else {
                return json_encode(["error" => "No se pudo guardar la configuración"]);
            }
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]);
        }
    }
}
?>
