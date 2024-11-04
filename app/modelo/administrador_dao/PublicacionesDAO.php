<?php
require_once '../../modelo/conexionBD/Conexion.php';
require_once '../../modelo/entidades/entidades_publicacion/ElementoPublicacion.php';
require_once '../../modelo/entidades/entidades_publicacion/Publicacion.php';

class PublicacionesDAO{
    private $conectar;
    public function __construct(){
        $this->conectar = new Conexion();
    }

    public function verPublicaciones(){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT * FROM vista_publicaciones_usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $publicaciones = [];
        while ($row = $result->fetch_assoc()) {
            $publicacion = new Publicacion(
                $row['idpublicacion'], $row['lugar'], $row['fecha'], $row['hora'],
                $row['categoria'], $row['url'], $row['cant_cupo'], $row['tipo_publico'], $row['nombre_c'],
                $row['estado']
            );

            $publicacion->cantReportes = $row['cant_reportes'];

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

    public function cantidadReportes(){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT COUNT(*) AS cantidad FROM reporte_publicacion WHERE reporte_aprobado = 'pendiente'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $cantidad = $result->fetch_assoc();
        return $cantidad['cantidad'];
    }

    public function cantidadAprobaciones(){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT COUNT(*) AS cantidad FROM publicacion WHERE estado = 'pendiente'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $cantidad = $result->fetch_assoc();
        return $cantidad['cantidad'];
    }

    public function verPublicacionesReportadas(){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT id_publicacion FROM reporte_publicacion WHERE reporte_aprobado = 'pendiente' GROUP BY id_publicacion;";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $publicaciones = [];
        while ($row = $result->fetch_assoc()) {
            $sqlPublicacion = "SELECT * FROM vista_publicaciones_usuario WHERE idpublicacion = ?";
            $stmtPublicacion = $conexion->prepare($sqlPublicacion);
            $stmtPublicacion->bind_param("i", $row['id_publicacion']);
            $stmtPublicacion->execute();
            $resultPublicacion = $stmtPublicacion->get_result();
            $publicacion = $resultPublicacion->fetch_assoc();

            $nuevaPublicacion = new Publicacion(
                $publicacion['idpublicacion'], $publicacion['lugar'], $publicacion['fecha'], $publicacion['hora'],
                $publicacion['categoria'], $publicacion['url'], $publicacion['cant_cupo'], $publicacion['tipo_publico'], $publicacion['nombre_c'],
                $publicacion['estado']
            );

            $nuevaPublicacion->cantReportes = $publicacion['cant_reportes'];

            // Obtener los elementos de la publicación
            $sqlElementos = "SELECT * FROM elemento_publicacion WHERE id_publicacion = ?";
            $stmtElementos = $conexion->prepare($sqlElementos);
            $stmtElementos->bind_param("i", $publicacion['idpublicacion']);
            $stmtElementos->execute();
            $resultElementos = $stmtElementos->get_result();

            while ($elemento = $resultElementos->fetch_assoc()) {
                $nuevaPublicacion->agregarElementoPublicacion(
                    new ElementoPublicacion($elemento['tipo_elemento'], $elemento['contenido'])
                );
            }

            // obtener los motivos de los reportes
            $sqlMotivos = "SELECT motivo_reporte FROM reporte_publicacion WHERE id_publicacion = ?";
            $stmtMotivos = $conexion->prepare($sqlMotivos);
            $stmtMotivos->bind_param("i", $publicacion['idpublicacion']);
            $stmtMotivos->execute();
            $resultMotivos = $stmtMotivos->get_result();
            while ($motivo = $resultMotivos->fetch_assoc()) {
                $nuevaPublicacion->agregarMotivoReporte($motivo['motivo_reporte']);
            }

            $publicaciones[] = $nuevaPublicacion;
        }

        return $publicaciones;

    }

    public function verPublicacionesPendientes(){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT * FROM vista_publicaciones_usuario WHERE estado = 'pendiente'";
        $stmt = $conexion->prepare($sql);
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

    public function aprobarPublicacion($idPublicacion){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT aprobar_publicacion(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idPublicacion);
        $stmt->execute();

    }

    public function rechazarPublicacion($idPublicacion){
        $conexion = $this->conectar->getConexion();
        $sql = "UPDATE publicacion SET estado = 'rechazado' WHERE idpublicacion = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idPublicacion);
        $stmt->execute();
    }

    public function aprobarReporte($idPublicacion){
        $conexion = $this->conectar->getConexion();
        $sql = "SELECT aprobarReportePublicacion(?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idPublicacion);
        $stmt->execute();
    }

    public function rechazarReporte($idPublicacion){
        $conexion = $this->conectar->getConexion();
        $sql = "UPDATE reporte_publicacion SET reporte_aprobado = 'rechazado' WHERE id_publicacion = ? AND reporte_aprobado = 'pendiente'";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idPublicacion);
        $stmt->execute();
    }

    public function cerrarConexion()
    {
        $this->conectar->cerrarConexion();
    }
}

?>