<?php
    include_once '../../modelo/administrador_dao/PublicacionesDAO.php';

    session_start();
    $idPublicacion = $_POST['id_publicacion'];
    $estado = $_POST['estado'];
    $aprobacion = new PublicacionesDAO();

    if($estado == 'aprobado'){
        $aprobacion->aprobarReporte($idPublicacion);
    }else{
        $aprobacion->rechazarReporte($idPublicacion);
    }
    $aprobacion->cerrarConexion();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>