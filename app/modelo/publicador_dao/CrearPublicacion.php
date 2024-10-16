<?php
require_once '../../modelo/conexionBD/Conexion.php';
class CrearPublicacion
{
    private $conectar;
    public function __construct()
    {
        $this->conectar = new Conexion();
    }

    public function crearPublicacion($lugar,$fecha,$hora,$usuarioPublicador, $categoria, $url, $cantCupo, $tipoPublico){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT crear_publicacion(?, ?, ?, ?, ?, ?, ?, ?) AS idpublicacion";

        // Preparar la declaración
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssisssis", $lugar, $fecha, $hora, $usuarioPublicador, $categoria, $url, $cantCupo, $tipoPublico);
        // Ejecutar la consulta
        if (!$stmt->execute()) {
            return  false;
        }

        // Obtener el resultado (idpublicacion generado)
        $stmt->bind_result($idpublicacion);
        $stmt->fetch();
        $stmt->close();
        return $idpublicacion;

    }


    public function agregarElementosPublicacion($idPublicacion, $tipoElemento, $contenido)
    {
      
        $conexion = $this->conectar->getConexion();
        $sql = "INSERT INTO elemento_publicacion(id_publicacion, tipo_elemento, contenido) VALUES (?,?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iss", $idPublicacion, $tipoElemento, $contenido);
       
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }

        
    }

    
    public function cerrarConexion()
    {
        $this->conectar->cerrarConexion();
    }
}
