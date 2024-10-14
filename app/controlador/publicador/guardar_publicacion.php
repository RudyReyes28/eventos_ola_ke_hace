<?php
// Este archivo es guardar_publicacion.php
session_start();
$usuarioPublicador = $_SESSION['usuario'];
$nombreUsuario = $usuarioPublicador["nombre_c"];
echo" nombre usuario".$nombreUsuario."<br>";

// Imprimir los datos de la publicación
echo "<h1>Datos de la Publicación</h1>";
echo "Lugar: " . $_POST['lugar'] . "<br>";
echo "Fecha: " . $_POST['fecha'] . "<br>";
echo "Hora: " . $_POST['hora'] . "<br>";
echo "Categoría: " . $_POST['categoria'] . "<br>";
echo "URL: " . $_POST['url'] . "<br>";
echo "Cantidad de Cupo: " . $_POST['cant_cupo'] . "<br>";
echo "Tipo de Público: " . $_POST['tipo_publico'] . "<br>";

// Imprimir los elementos de la publicación (h1, p, video, img, audio)
echo "<h2>Elementos de la Publicación</h2>";

$tiposElementos = $_POST['tipo_elemento'];
$contenidos = $_POST['contenido'];

// Recorrer todos los elementos agregados
foreach ($tiposElementos as $index => $tipoElemento) {
    echo "<strong>Tipo de Elemento: </strong>" . $tipoElemento . "<br>";

    if ($tipoElemento === 'h1' || $tipoElemento === 'p') {
        // Mostrar texto para títulos y párrafos
        echo "<strong>Contenido: </strong>" . htmlspecialchars($contenidos[$index]) . "<br>";
    } else {
        // Mostrar el archivo subido para imágenes, videos y audios
        if (isset($_FILES['contenido']['name'][$index]) && $_FILES['contenido']['error'][$index] == 0) {
            $nombreArchivo = $_FILES['contenido']['name'][$index];
            echo "<strong>Archivo subido: </strong>" . htmlspecialchars($nombreArchivo) . "<br>";
        } else {
            echo "<strong>Error subiendo el archivo.</strong><br>";
        }
    }

    echo "<hr>";
}
?>