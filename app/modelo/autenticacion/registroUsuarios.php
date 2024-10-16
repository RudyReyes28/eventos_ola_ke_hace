<?php
require_once '../../modelo/conexionBD/Conexion.php';
class RegistroUsuario
{
    private $conectar;
    public function __construct()
    {
        $this->conectar = new Conexion();
    }

    public function buscarUsuario($usuario)
    {
      
        $conexion = $this->conectar->getConexion();
    
        $sql = "SELECT * FROM usuario_registrado WHERE ussername = ?";
    
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $usuario); 
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->get_result();
    
        if($resultado->num_rows > 0){
            return $resultado->fetch_assoc();
        }
    
        $stmt->close();
        // Si no se encuentra el usuario
        return null;
    }

    public function getPublicador($idUsuario){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT * FROM usuario_publicacion WHERE registro_usuario = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idUsuario); 
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();
    
        if($resultado->num_rows > 0){
            return $resultado->fetch_assoc();
        }
        $stmt->close();
        // Si no se encuentra el usuario
        return null;
    }

    public function getAdministrador($idUsuario){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT * FROM usuario_admin WHERE id_registro = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idUsuario); 
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();
    
        if($resultado->num_rows > 0){
            return $resultado->fetch_assoc();
        }
    
        $stmt->close();
        // Si no se encuentra el usuario
        return null;
    }

    public function getParticipante($idUsuario){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT * FROM usuario_participante WHERE id_registro = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idUsuario); 
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();
    
        if($resultado->num_rows > 0){
            return $resultado->fetch_assoc();
        }
        $stmt->close();
    
        // Si no se encuentra el usuario
        return null;
    }
    public function cerrarConexion()
    {
        $this->conectar->cerrarConexion();
    }
}
