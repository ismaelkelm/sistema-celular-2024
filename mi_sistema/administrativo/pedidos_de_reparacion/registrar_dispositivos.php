<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Registrar Nuevo Dispositivo</h1>
    <form action="procesar_dispositivo.php" method="POST">
        <input type="hidden" name="id_cliente" value="<?php echo $_GET['id_cliente']; ?>">
        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="numero_de_serie">Número de Serie:</label>
            <input type="text" name="numero_de_serie" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" name="estado" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Dispositivo</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>
