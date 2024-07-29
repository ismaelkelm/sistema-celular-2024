<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Obtener el ID de la factura desde la URL
$id_factura = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar la factura a editar
$query = "SELECT * FROM facturas WHERE id_facturas = $id_factura";
$result = mysqli_query($conn, $query);
$factura = mysqli_fetch_assoc($result);

if (!$factura) {
    die("Factura no encontrada.");
}

// Consultar proveedores para el select
$proveedores_query = "SELECT id_proveedores, nombre FROM proveedores";
$proveedores_result = mysqli_query($conn, $proveedores_query);
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Factura</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id_facturas" value="<?php echo htmlspecialchars($factura['id_facturas']); ?>">
        
        <div class="form-group">
            <label for="id_proveedores">Proveedor</label>
            <select class="form-control" id="id_proveedores" name="id_proveedores" required>
                <?php while ($proveedor = mysqli_fetch_assoc($proveedores_result)) { ?>
                    <option value="<?php echo htmlspecialchars($proveedor['id_proveedores']); ?>" 
                        <?php echo ($factura['id_proveedores'] == $proveedor['id_proveedores']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($proveedor['nombre']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="fecha_de_emision">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_de_emision" name="fecha_de_emision" 
                   value="<?php echo htmlspecialchars($factura['fecha_de_emision']); ?>" required>
        </div>
        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" 
                   value="<?php echo htmlspecialchars($factura['subtotal']); ?>" required>
        </div>
        <div class="form-group">
            <label for="impuestos">Impuestos</label>
            <input type="number" step="0.01" class="form-control" id="impuestos" name="impuestos" 
                   value="<?php echo htmlspecialchars($factura['impuestos']); ?>" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" class="form-control" id="total" name="total" 
                   value="<?php echo htmlspecialchars($factura['total']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
