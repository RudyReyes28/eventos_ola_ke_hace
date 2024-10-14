<?php
require_once '../../modelo/autenticacion/registroUsuarios.php';
$error = '';

$usuario = $_POST['usuario'];
$passwordIngresada = $_POST['contrasenia'];

$conexion = new RegistroUsuario();
$usuarioE = $conexion->buscarUsuario($usuario); 



if ($usuarioE && password_verify($passwordIngresada, $usuarioE['password'])) {
    session_start();
    $idUsuario = $usuarioE['idusuario_registrado'];
    switch ($usuarioE['tipo_usuario']) {

        case 'publicador':
            $usuarioPublicador = $conexion->getPublicador($idUsuario);
            $_SESSION['usuario'] = $usuarioPublicador;
            header("Location: ../../vista/publicador/vistaPublicador.php");
            $conexion->cerrarConexion();
            exit;
        case 'administrador':
            $usuarioAdmin = $conexion->getAdministrador($idUsuario);
            $_SESSION['usuario'] = $usuarioAdmin;
            //header("Location: ../../vista/administrador/vistaAdministrador.php");
            $conexion->cerrarConexion();
            exit;
        case 'participante':
            $usuarioParticipante = $conexion->getParticipante($idUsuario);
            $_SESSION['usuario'] = $usuarioParticipante;
            //header("Location: ../../vista/participante/vistaParticipante.php");
            $conexion->cerrarConexion();
            exit;
        default:
            $error = "Tipo de usuarioE$usuarioE desconocido.";
            $conexion->cerrarConexion();
            break;
    }
} else {
    
     $error = "Usuario o contraseña incorrectos.";
    echo $error;
}

?>