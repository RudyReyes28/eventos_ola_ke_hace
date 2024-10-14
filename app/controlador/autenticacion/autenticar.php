<?php
require_once '../../modelo/autenticacion/registroUsuarios.php';
$error = '';

$usuario = $_POST['usuario'];
$passwordIngresada = $_POST['contrasenia'];

$conexion = new RegistroUsuario();
$usuarioE = $conexion->buscarUsuario($usuario); 
$conexion->cerrarConexion();

session_start();
if ($usuarioE && password_verify($passwordIngresada, $usuarioE['password'])) {
    
    switch ($usuarioE['tipo_usuario']) {
        case 'publicador':
            //header("Location: ../../vista/publicador/vistaPublicador.php");
            echo 'Usuario publicador encontrado';
            exit;
        case 'administrador':
            //header("Location: ../../vista/administrador/vistaAdministrador.php");
            echo 'Usuario administrador encontrado';
            exit;
        case 'participante':
            //header("Location: ../../vista/participante/vistaParticipante.php");
            echo 'Usuario participante encontrado';
            exit;
        default:
            $error = "Tipo de usuarioE$usuarioE desconocido.";
            break;
    }
} else {
    
     $error = "Usuario o contraseña incorrectos.";
    echo $error;
}

?>