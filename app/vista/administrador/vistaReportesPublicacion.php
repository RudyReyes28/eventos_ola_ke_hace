<?php
require_once '../../modelo/administrador_dao/PublicacionesDAO.php';
session_start();

if (isset($_SESSION['usuario'])) {
    $usuarioParticipante = $_SESSION['usuario'];
    $idParticipante = $usuarioParticipante["idusuario_admin"];
    
    
    $verPublicaciones = new PublicacionesDAO();
    $publicaciones = $verPublicaciones->verPublicacionesReportadas();
    $cantidadAprobaciones = $verPublicaciones->cantidadAprobaciones();
    $cantidadReportes = $verPublicaciones->cantidadReportes();
    $verPublicaciones->cerrarConexion();


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones Reportadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'menuAdmin.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col min-vh-100 py-3">
                <!-- toggler -->
                <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
                </button>
                <div class="container mt-4">
                    <h2>Publicaciones Reportadas</h2>
                    <?php foreach ($publicaciones as $publicacion): ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6><?= htmlspecialchars($publicacion->publicador); ?></h6>
                                <h6>Lugar: <?= htmlspecialchars($publicacion->lugar); ?></h6>
                                <h6>Cantidad de Reportes: <?= htmlspecialchars($publicacion->cantReportes)?></h6>
                                <h6>Fecha: <?= htmlspecialchars($publicacion->fecha . ' Hora: ' . $publicacion->hora); ?></h6>
                                <p><strong>Estado:</strong> <?= htmlspecialchars($publicacion->estado ? $publicacion->estado : 'Desconocido'); ?></p>
                                <p><strong>Motivos de Reportes:</strong></p>
                                
                                <?php foreach ($publicacion->motivoReportes as $motivo): ?>
                                    <p><?= htmlspecialchars($motivo); ?></p>
                                <?php endforeach; ?>
                            </div>
                            <div class="card-body">
                                <p><strong>Categoría:</strong> <?= htmlspecialchars($publicacion->categoria); ?></p>
                                <p><strong>Cupo:</strong> <?= htmlspecialchars($publicacion->cantCupo); ?></p>
                                <p><strong>Tipo de público:</strong> <?= htmlspecialchars($publicacion->tipoPublico); ?></p>
                                <p><a href="<?= htmlspecialchars($publicacion->url); ?>">Ver más</a></p>

                                <h4>Elementos de la Publicación</h4>
                                <?php foreach ($publicacion->elementosPublicacion as $elemento): ?>
                                    <?php if ($elemento->tipoElemento == 'h1'): ?>
                                        <h1><?= htmlspecialchars($elemento->contenido); ?></h1>
                                    <?php elseif ($elemento->tipoElemento == 'p'): ?>
                                        <p><?= htmlspecialchars($elemento->contenido); ?></p>
                                    <?php elseif (strpos($elemento->contenido, '.jpg') !== false || strpos($elemento->contenido, '.png') !== false  || strpos($elemento->contenido, '.JPG') !== false): ?>
                                        <!-- Mostrar imágenes -->
                                        <img src="../../controlador/publicador/<?= htmlspecialchars($elemento->contenido); ?>" alt="Imagen de la publicación" class="img-fluid">
                                    <?php elseif (strpos($elemento->contenido, '.mp4') !== false): ?>
                                        <!-- Mostrar videos -->
                                        <video controls class="w-100">
                                            <source src="../../controlador/publicador/<?= htmlspecialchars($elemento->contenido); ?>" type="video/mp4">
                                            Tu navegador no soporta la reproducción de videos.
                                        </video>
                                    <?php elseif (strpos($elemento->contenido, '.mp3') !== false|| strpos($elemento->contenido, '.m4a') !== false): ?>
                                        <!-- Mostrar audios -->
                                        <audio controls>
                                            <source src="../../controlador/publicador/<?= htmlspecialchars($elemento->contenido); ?>" type="audio/mpeg">
                                            Tu navegador no soporta la reproducción de audios.
                                        </audio>
                                    <?php else: ?>
                                        <a href="<?= htmlspecialchars($elemento->contenido); ?>" target="_blank">Ver Archivo</a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <form action="../../controlador/administrador/manejoReportes.php" method="post" >
                                    <input type="hidden" name="id_publicacion" value="<?= htmlspecialchars($publicacion->idPublicacion); ?>">
                                    <input type="hidden" name="estado" value="aprobado">
                                    <button type="submit" class="btn btn-warning">Aceptar Reporte</button>
                                </form>
                                <form action="../../controlador/administrador/manejoReportes.php" method="post">
                                    <input type="hidden" name="id_publicacion" value="<?= htmlspecialchars($publicacion->idPublicacion); ?>">
                                    <input type="hidden" name="estado" value="rechazado">
                                    <button type="submit" class="btn btn-danger">Rechazar Reporte</button>
                                </form>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>