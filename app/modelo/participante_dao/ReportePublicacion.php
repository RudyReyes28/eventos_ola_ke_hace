<?php
require_once '../../modelo/conexionBD/Conexion.php';
class ReportePublicacion {
    
    private $conectar;

    public function __construct() {
        $this->conectar = new Conexion();
    }

    public function insertarReporte($id_publicacion, $id_usuario_participante, $motivo_reporte) {
        
        $conexion = $this->conectar->getConexion();
        $stmt = $conexion->prepare('SELECT manejar_reporte(?, ?, ?)');
        $stmt->bind_param('iis', $id_publicacion, $id_usuario_participante, $motivo_reporte);
        $stmt->execute();
        $stmt->close();

    }


    public function getReporte($idUsuario) {
        $conexion = $this->conectar->getConexion();
        $stmt = $conexion->prepare('SELECT id_publicacion FROM reporte_publicacion WHERE id_usuario_participante = ?');
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $res = $stmt->get_result();
        $reportes = $res->fetch_all(MYSQLI_ASSOC);

          $stmt->close();

         // Devolver el arreglo de reportes
         return $reportes;
    }

    public function cerrarConexion()
    {
        $this->conectar->cerrarConexion();
    }
}

?>