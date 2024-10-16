<?php
require_once '../../modelo/publicador_dao/CrearPublicacion.php';
session_start();
$usuarioPublicador = $_SESSION['usuario'];
$nombreUsuario = $usuarioPublicador["nombre_c"];
$idPublicador = $usuarioPublicador["idusuario_publicacion"];
$lugar = $_POST['lugar'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$categoria = $_POST['categoria'];
$url = $_POST['url'];
$cantCupo = $_POST['cant_cupo'];
$tipoPublico = $_POST['tipo_publico'];

if (preg_match('/^\d{2}:\d{2}$/', $hora)) {
    $hora .= ':00';  // Agregamos los segundos
}
// Inicializar bandera de éxito
$success = true;

// Crear la publicación
$crearPublicacion = new CrearPublicacion();
$idPublicacion = $crearPublicacion->crearPublicacion($lugar, $fecha, $hora, $idPublicador, $categoria, $url, $cantCupo, $tipoPublico);

if (!$idPublicacion) {
    $success = false; // Si la creación falla, marcar como falso
}

// Procesar los elementos de texto
$tiposElementosTexto = $_POST['tipo_elemento_texto'];
$contenidoTexto = $_POST['contenido_texto'];

foreach ($tiposElementosTexto as $index => $tipoElemento) {
    if ($tipoElemento === 'h1' || $tipoElemento === 'p') {
        $realizado = $crearPublicacion->agregarElementosPublicacion($idPublicacion, $tipoElemento, $contenidoTexto[$index]);
        if (!$realizado) {
            $success = false; 
        }
    }
}

// Procesar los elementos de archivos
$tipoElementoFile = $_POST['tipo_elemento_archivo'];
$directorioDestino = 'uploads/'; 

if (!is_dir($directorioDestino)) {
    mkdir($directorioDestino, 0755, true);
}

foreach ($_FILES['contenido_archivo']['name'] as $index => $nombreArchivo) {
    if ($_FILES['contenido_archivo']['error'][$index] == 0) {
        $nombreTemporal = $_FILES['contenido_archivo']['tmp_name'][$index];
        $nombreFinal = $directorioDestino . basename($nombreArchivo);

        if (move_uploaded_file($nombreTemporal, $nombreFinal)) {
            $realizado = $crearPublicacion->agregarElementosPublicacion($idPublicacion, $tipoElementoFile[$index], $nombreFinal);
            if (!$realizado) {
                $success = false;
            }
        } else {
            $success = false; 
        }
    } else {
        $success = false;
    }
}

$crearPublicacion->cerrarConexion();

?>

<!-- HTML para confirmar la creación -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Publicación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #4CAF50;
        }
        .error {
            color: #e74c3c;
        }
        .success {
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($success): ?>
            <h1 class="success">¡Publicación creada con éxito!</h1>
            <p>La publicación fue registrada correctamente con todos los elementos.</p>
        <?php else: ?>
            <h1 class="error">Error al crear la publicación</h1>
            <p>Ocurrió un error durante el proceso de creación. Por favor, intenta nuevamente.</p>
        <?php endif; ?>
        <a href="../../vista/publicador/vistaPublicador.php">Volver al inicio</a>
    </div>
</body>
</html>