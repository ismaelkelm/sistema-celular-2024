<?php
require_once '../modelos/Diagnostico.php';

class ControladorDiagnostico {
    private $modeloDiagnostico;

    public function __construct() {
        $this->modeloDiagnostico = new Diagnostico();
    }

    // Diagnosticar un problema
    public function diagnosticarProblema($datos) {
        try {
            // Validación de datos
            if (empty($datos['descripcion']) || empty($datos['reparacion_recomendada'])) {
                return json_encode(["error" => "Descripción y recomendación de reparación son obligatorios"]);
            }

            $resultado = $this->modeloDiagnostico->crearDiagnostico($datos);
            if ($resultado) {
                return json_encode(["mensaje" => "Diagnóstico creado exitosamente"]);
            } else {
                return json_encode(["error" => "No se pudo crear el diagnóstico"]);
            }
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]);
        }
    }

    // Obtener diagnósticos
    public function obtenerDiagnosticos() {
        try {
            $diagnosticos = $this->modeloDiagnostico->obtenerTodosDiagnosticos();
            if ($diagnosticos) {
                return json_encode($diagnosticos); // Retorna la lista de diagnósticos en formato JSON
            } else {
                return json_encode(["mensaje" => "No se encontraron diagnósticos"]);
            }
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]);
        }
    }
}
?>
