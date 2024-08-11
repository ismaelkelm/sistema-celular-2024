<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Registrar Nuevo Pedido de Reparación</h1>
    <form action="procesar_pedido.php" method="POST">
        <input type="hidden" name="id_cliente" value="<?php echo $_GET['id_cliente']; ?>">
        <input type="hidden" name="id_dispositivo" value="<?php echo $_GET['id_dispositivo']; ?>">
        <div class="form-group">
            <label for="fecha_de_pedido">Fecha de Pedido:</label>
            <input type="date" name="fecha_de_pedido" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" name="estado" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="numero_orden">Número de Orden:</label>
            <input type="text" name="numero_orden" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Pedido</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>
