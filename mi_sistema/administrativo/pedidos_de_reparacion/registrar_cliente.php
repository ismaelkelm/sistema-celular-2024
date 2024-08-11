<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Registrar Nuevo Cliente</h1>
    <form action="procesar_cliente.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" name="correo_electronico" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Cliente</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>
