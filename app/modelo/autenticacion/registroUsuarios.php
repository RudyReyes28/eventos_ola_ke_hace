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
        // Conectar a la base de datos
        $conexion = $this->conectar->getConexion();
    
        // Preparar la consulta para buscar al usuario en la tabla usuario_registrado
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
    
        // Si no se encuentra el usuario
        return null;
    }
    public function cerrarConexion()
    {
        $this->conectar->cerrarConexion();
    }
}
