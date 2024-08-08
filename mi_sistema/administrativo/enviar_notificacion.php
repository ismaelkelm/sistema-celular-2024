<?php
// Incluir el archivo de conexión a la base de datos
require_once '../base_datos/db.php';

// Incluir los archivos de cabecera y pie de página
include('../includes/header.php');

// Verificar si se ha enviado el formulario para enviar una notificación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar_notificacion']) && isset($_POST['pedido_id'])) {
    $pedido_id = $_POST['pedido_id'];
    $canal = $_POST['canal']; // Canal de notificación (correo, celular, WhatsApp)

    // Consultar los detalles del pedido y del cliente
    $sql = "
        SELECT pr.numero_pedido, pr.estado, c.nombre, c.correo_electronico, c.telefono, c.id_clientes
        FROM pedidos_de_reparacion pr
        JOIN clientes c ON pr.id_clientes = c.id_clientes
        WHERE pr.id_pedidos_de_reparacion = ?
    ";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $nombre = $row['nombre'];
            $correo = $row['correo_electronico'];
            $telefono = $row['telefono'];
            $numero_pedido = $row['numero_pedido'];
            $id_cliente = $row['id_clientes'];

            // Mensaje de notificación
            $mensaje = "Estimado $nombre,\n\nSu pedido con número $numero_pedido ha sido completado.\nGracias por confiar en nosotros.\n\nSaludos,\nMi Empresa";

            // Enviar notificación según el canal seleccionado
            if ($canal == 'correo') {
                // Enviar notificación por correo
                $asunto = "Notificación de Pedido Completado";
                $cabeceras = "From: no-reply@miempresa.com";

                if (mail($correo, $asunto, $mensaje, $cabeceras)) {
                    echo "<p class='success-message'>Correo enviado a $correo</p>";
                } else {
                    echo "<p class='error-message'>Error al enviar el correo</p>";
                }
            } elseif ($canal == 'telefono') {
                // Enviar notificación por SMS (simulado aquí)
                echo "<p class='info-message'>Notificación enviada al teléfono $telefono: $mensaje</p>";
            } elseif ($canal == 'whatsapp') {
                // Enviar notificación por WhatsApp (simulado aquí)
                echo "<p class='info-message'>Notificación enviada a WhatsApp $telefono: $mensaje</p>";
            }

            // Insertar la notificación en la base de datos
            $sql_insert = "
                INSERT INTO notificaciones (id_usuarios, mensaje, fecha_de_envío, estado, numero_pedido)
                VALUES (?, ?, NOW(), 'enviado', ?)
            ";
            if ($stmt_insert = $conn->prepare($sql_insert)) {
                $stmt_insert->bind_param("sss", $id_cliente, $mensaje, $numero_pedido);
                $stmt_insert->execute();
                echo "<p class='success-message'>Notificación insertada en la base de datos</p>";
            } else {
                echo "<p class='error-message'>Error en la preparación de la consulta de inserción: " . $conn->error . "</p>";
            }
        } else {
            echo "<p class='error-message'>No se encontró el pedido con ID $pedido_id</p>";
        }
    } else {
        echo "<p class='error-message'>Error en la preparación de la consulta SQL: " . $conn->error . "</p>";
    }
}

// Consultar las reparaciones, uniendo las tablas clientes y dispositivos
$sql = "
    SELECT pr.id_pedidos_de_reparacion, pr.fecha_de_pedido, pr.estado, pr.numero_pedido,
           c.nombre AS nombre_cliente, d.marca, d.modelo, d.numero_de_serie
    FROM pedidos_de_reparacion pr
    JOIN clientes c ON pr.id_clientes = c.id_clientes
    JOIN dispositivos d ON pr.id_dispositivos = d.id_dispositivos
    ORDER BY pr.numero_pedido ASC
";

$result = $conn->query($sql);
?>

<div class="container">
    <h1>Enviar Notificaciones</h1>

    <button onclick="window.history.back();" class="btn-back">Volver Atrás</button>

    <?php if ($result->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de Pedido</th>
                    <th>Estado</th>
                    <th>Número de Pedido</th>
                    <th>Nombre del Cliente</th>
                    <th>Marca del Dispositivo</th>
                    <th>Modelo del Dispositivo</th>
                    <th>Número de Serie</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_de_pedido']); ?></td>
                        <td><?php echo htmlspecialchars($row['estado']); ?></td>
                        <td><?php echo htmlspecialchars($row['numero_pedido']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($row['marca']); ?></td>
                        <td><?php echo htmlspecialchars($row['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($row['numero_de_serie']); ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="pedido_id" value="<?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?>">
                                <label>Canal de Notificación:</label>
                                <select name="canal">
                                    <option value="correo">Correo Electrónico</option>
                                    <option value="telefono">Número de Celular</option>
                                    <option value="whatsapp">WhatsApp</option>
                                </select>
                                <input type="submit" name="enviar_notificacion" value="Enviar Notificación" class="btn-submit">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay reparaciones registradas.</p>
    <?php endif; ?>
</div>

<?php
// Incluir el pie de página
include('../includes/footer.php');

// Cerrar la conexión
$conn->close();
?>
