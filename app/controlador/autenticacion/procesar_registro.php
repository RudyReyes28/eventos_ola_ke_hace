<?php
    require_once '../../modelo/autenticacion/registroUsuarios.php';

    $nombreCompleto = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
    $tipoUsuario = $_POST['tipo_usuario'];

    $registro = new RegistroUsuario();

    if ($tipoUsuario == 'publicador') {
       $registro->registrarUsuarioPublicador($nombreCompleto, $usuario, $contrasenaHash);
    } else {
       $registro->registrarUsuarioParticipante($nombreCompleto, $usuario, $contrasenaHash);
    }


    header('Location: ../../vista/login/login.php');
?>