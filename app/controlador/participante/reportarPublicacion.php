<?php
require_once '../../modelo/participante_dao/ReportePublicacion.php'; // Incluye el modelo de reporte
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_publicacion = $_POST['id_publicacion'];
    $usuarioParticipante = $_SESSION['usuario'];
    $idParticipante = $usuarioParticipante["idusuario_participante"];
    $motivo_reporte = $_POST['motivo_reporte'];

    //echo 'Id publicacion '.$id_publicacion.' participante'.$idParticipante. ' motivo '.$motivo_reporte.' ';
    
    $modeloReporte = new ReportePublicacion();
    $modeloReporte->insertarReporte($id_publicacion, $idParticipante, $motivo_reporte);
    $modeloReporte->cerrarConexion();
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

?>