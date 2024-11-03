<?php
require_once '../../modelo/participante_dao/VerEventos.php';
require_once '../../modelo/participante_dao/ReportePublicacion.php';
require_once '../../modelo/participante_dao/AsistirEventoDAO.php';
session_start();

if (isset($_SESSION['usuario'])) {
    $usuarioParticipante = $_SESSION['usuario'];
    $idParticipante = $usuarioParticipante["idusuario_participante"];

    $modeloAsistirEvento = new AsistirEventoDAO();
    $misEventos = $modeloAsistirEvento->misEventos($idParticipante);
    $cantidadEventos = $modeloAsistirEvento->cantidadMisEventos($idParticipante);
    $modeloAsistirEvento->cerrarConexion();

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body>

    <?php include 'menuParticipante.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col min-vh-100 py-3">
                <!-- toggler -->
                <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvas"></i>
                </button>
                <div class="container mt-4">
                    <h2>Mis Asistencias</h2>
                    <?php foreach ($misEventos as $publicacion): ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3>Lugar: <?= htmlspecialchars($publicacion->lugar); ?></h3>
                                <h5>Fecha:
                                    <?= htmlspecialchars($publicacion->fecha . ' Hora: ' . $publicacion->hora); ?>
                                </h5>
                                <?php if (empty($misEventos)): ?>
                                    <h5>No tienes eventos próximos.</h5>
                                <?php else: ?>

                                    <h5 class="card-text text-primary" id="countdown-<?= htmlspecialchars($publicacion->fecha); ?>">
                                        Cuenta regresiva: Cargando...
                                    </h5>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <p><strong>Categoría:</strong> <?= htmlspecialchars($publicacion->categoria); ?></p>
                                <p><strong>Cupo:</strong> <?= htmlspecialchars($publicacion->cantCupo); ?></p>
                                <p><strong>Tipo de público:</strong> <?= htmlspecialchars($publicacion->tipoPublico); ?></p>
                                <p><a href="<?= htmlspecialchars($publicacion->url); ?>">Ver más</a></p>

                                <h4>Detalles</h4>
                                <?php foreach ($publicacion->elementosPublicacion as $elemento): ?>
                                    <?php if ($elemento->tipoElemento == 'h1'): ?>
                                        <h1><?= htmlspecialchars($elemento->contenido); ?></h1>
                                    <?php elseif ($elemento->tipoElemento == 'p'): ?>
                                        <p><?= htmlspecialchars($elemento->contenido); ?></p>
                                    <?php elseif (strpos($elemento->contenido, '.jpg') !== false || strpos($elemento->contenido, '.png') !== false || strpos($elemento->contenido, '.JPG') !== false): ?>
                                        <!-- Mostrar imágenes -->
                                        <img src="../../controlador/publicador/<?= htmlspecialchars($elemento->contenido); ?>"
                                            alt="Imagen de la publicación" class="img-fluid">
                                    <?php elseif (strpos($elemento->contenido, '.mp4') !== false): ?>
                                        <!-- Mostrar videos -->
                                        <video controls class="w-100">
                                            <source
                                                src="../../controlador/publicador/<?= htmlspecialchars($elemento->contenido); ?>"
                                                type="video/mp4">
                                            Tu navegador no soporta la reproducción de videos.
                                        </video>
                                    <?php elseif (strpos($elemento->contenido, '.mp3') !== false || strpos($elemento->contenido, '.m4a') !== false): ?>
                                        <!-- Mostrar audios -->
                                        <audio controls>
                                            <source
                                                src="../../controlador/publicador/<?= htmlspecialchars($elemento->contenido); ?>"
                                                type="audio/mpeg">
                                            Tu navegador no soporta la reproducción de audios.
                                        </audio>
                                    <?php else: ?>
                                        <a href="<?= htmlspecialchars($elemento->contenido); ?>" target="_blank">Ver Archivo</a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="card-footer">
                                        <form action="../../controlador/participante/cancelarEvento.php" method="POST">
                                            <input type="hidden" name="id_publicacion" value="<?= htmlspecialchars($publicacion->idpublicacion); ?>">
                                            <input type="hidden" name="id_evento" value="<?= htmlspecialchars($publicacion->idEventoAsistido); ?>">
                                            <button type="submit" class="btn btn-danger">Cancelar Asistencia</button>
                                        </form>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>
            </div>


        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php foreach ($misEventos as $evento): ?>
                    (function () {
                        const fechaEvento = "<?= $evento->fecha . ' ' . $evento->hora; ?>";
                        const countdownElement = document.getElementById("countdown-<?= htmlspecialchars($evento->fecha); ?>");

                        function actualizarCuentaRegresiva() {
                            const ahora = new Date().getTime();
                            const eventoFecha = new Date(fechaEvento).getTime();
                            const distancia = eventoFecha - ahora;

                            if (distancia > 0) {
                                const dias = Math.floor(distancia / (1000 * 60 * 60 * 24));
                                const horas = Math.floor((distancia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutos = Math.floor((distancia % (1000 * 60 * 60)) / (1000 * 60));
                                const segundos = Math.floor((distancia % (1000 * 60)) / 1000);

                                countdownElement.textContent = `Cuenta regresiva: ${dias}d ${horas}h ${minutos}m ${segundos}s`;
                            } else {
                                countdownElement.textContent = "¡El evento ya comenzó!";
                            }
                        }

                        actualizarCuentaRegresiva();
                        setInterval(actualizarCuentaRegresiva, 1000);
                    })();
            <?php endforeach; ?>
        });
    </script>
</body>

</html>