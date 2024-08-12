<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar el último número de orden
$query = "SELECT numero_orden FROM pedidos_de_reparacion ORDER BY id_pedidos_de_reparacion DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ultimo_numero_orden = $row['numero_orden'];
    
    // Extraer el número de la cadena (asumiendo el formato "ORD0001")
    $numero = intval(substr($ultimo_numero_orden, 3));
    $nuevo_numero_orden = "ORD" . str_pad($numero + 1, 4, "0", STR_PAD_LEFT);
} else {
    // Si no hay ningún registro, comenzamos con "ORD0001"
    $nuevo_numero_orden = "ORD0001";
}

// Opciones de estado
$estados = ["Pendiente", "En Progreso", "Cancelado", "Entregado"];
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="registrar_dispositivo.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Registrar Nuevo Pedido de Reparación</h1>
    <form action="procesar_pedido.php" method="POST">
        <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($_GET['id_cliente']); ?>">
        <input type="hidden" name="id_dispositivo" value="<?php echo htmlspecialchars($_GET['id_dispositivo']); ?>">
        
        <div class="form-group">
            <label for="fecha_de_pedido">Fecha de Pedido:</label>
            <input type="date" name="fecha_de_pedido" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" class="form-control" required>
                <?php foreach ($estados as $estado) { ?>
                    <option value="<?php echo htmlspecialchars($estado); ?>"><?php echo htmlspecialchars($estado); ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="numero_orden">Número de Orden:</label>
            <input type="text" name="numero_orden" class="form-control" value="<?php echo htmlspecialchars($nuevo_numero_orden); ?>" readonly>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrar Pedido</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>
