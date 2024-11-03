<?php
require_once '../../modelo/participante_dao/AsistirEventoDAO.php'; // Incluye el modelo de reporte

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_publicacion = $_POST['id_publicacion'];
    $id_evento = $_POST['id_evento'];
    $usuarioParticipante = $_SESSION['usuario'];
    $idParticipante = $usuarioParticipante["idusuario_participante"];

    //echo 'Id publicacion '.$id_publicacion.' participante'.$idParticipante;
    //echo 'Id evento '.$id_evento;
    
    $modeloAsistirEvento = new AsistirEventoDAO();
    $modeloAsistirEvento->cancelarAsistencia($id_publicacion, $id_evento);
    $modeloAsistirEvento->cerrarConexion();
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

?>