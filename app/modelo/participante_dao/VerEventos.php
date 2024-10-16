<?php
require_once '../../modelo/conexionBD/Conexion.php';
require_once '../../modelo/entidades/entidades_publicacion/ElementoPublicacion.php';
require_once '../../modelo/entidades/entidades_publicacion/Publicacion.php';
class ObtenerEventos {
    
    private $conectar;

    public function __construct() {
        $this->conectar = new Conexion();
    }

    public function verEventos($estado='publicado') {
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT * FROM vista_publicaciones_usuario WHERE estado = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $result = $stmt->get_result();

        $publicaciones = [];
        while ($row = $result->fetch_assoc()) {
            $publicacion = new Publicacion(
                $row['idpublicacion'], $row['lugar'], $row['fecha'], $row['hora'],
                $row['categoria'], $row['url'], $row['cant_cupo'], $row['tipo_publico'], $row['nombre_c'],
                $row['estado']
            );

            // Obtener los elementos de la publicación
            $sqlElementos = "SELECT * FROM elemento_publicacion WHERE id_publicacion = ?";
            $stmtElementos = $conexion->prepare($sqlElementos);
            $stmtElementos->bind_param("i", $row['idpublicacion']);
            $stmtElementos->execute();
            $resultElementos = $stmtElementos->get_result();

            while ($elemento = $resultElementos->fetch_assoc()) {
                $publicacion->agregarElementoPublicacion(
                    new ElementoPublicacion($elemento['tipo_elemento'], $elemento['contenido'])
                );
            }

            $publicaciones[] = $publicacion;
        }

        return $publicaciones;
    }

    public function cerrarConexion()
    {
        $this->conectar->cerrarConexion();
    }
}

?>