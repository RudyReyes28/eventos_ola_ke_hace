<?php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <form action="../../controlador/autenticacion/procesar_registro.php" method="post">
            <div class="mb-3">
                <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombreCompleto" name="nombre_completo" required>
            </div>
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="mb-3">
                <label for="tipoUsuario" class="form-label">Tipo de Usuario</label>
                <select class="form-select" id="tipoUsuario" name="tipo_usuario" required>
                    <option value="">Seleccionar...</option>
                    <option value="publicador">Publicador</option>
                    <option value="participante">Participante</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>