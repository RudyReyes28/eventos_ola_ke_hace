<?php
require_once '../../modelo/participante_dao/AsistirEventoDAO.php'; // Incluye el modelo de reporte
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_publicacion = $_POST['id_publicacionA'];
    $usuarioParticipante = $_SESSION['usuario'];
    $idParticipante = $usuarioParticipante["idusuario_participante"];

    //echo 'Id publicacion '.$id_publicacion.' participante'.$idParticipante;
    
    $modeloAsistirEvento = new AsistirEventoDAO();
    $modeloAsistirEvento->asistirEvento($id_publicacion, $idParticipante);
    $modeloAsistirEvento->cerrarConexion();
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

?>