<?php
    require_once '../../modelo/conexionBD/Conexion.php';

    class AsistirEventoDAO {
        private $conectar;

        public function __construct() {
            $this->conectar = new Conexion();
        }

        public function asistirEvento($id_publicacion, $idParticipante, $estado='asistiendo') {
            $conexion = $this->conectar->getConexion();
            $sql = "SELECT registrar_asistencia (?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iis", $id_publicacion, $idParticipante, $estado);
            $stmt->execute();
        }

        public function getEventosAsistidos($idParticipante) {
            $conexion = $this->conectar->getConexion();
            $stmt = $conexion->prepare('SELECT id_publicacion FROM asistir_evento WHERE id_usuario_p = ? AND estado_evento = "asistiendo"');
            $stmt->bind_param('i', $idParticipante);
            $stmt->execute();
            $res = $stmt->get_result();
            $eventosAsistidos = $res->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $eventosAsistidos;
        }

        public function misEventos($idParticipante) {
            $conexion = $this->conectar->getConexion();
            $stmt = $conexion->prepare('SELECT * FROM vista_eventos_asistidos WHERE id_usuario_p = ? AND estado_evento = "asistiendo"');
            $stmt->bind_param('i', $idParticipante);
            $stmt->execute();
            $res = $stmt->get_result();
            //$eventosAsistidos = $res->fetch_all(MYSQLI_ASSOC);

            $publicaciones = [];
            while ($row = $res->fetch_assoc()) {
                $publicacion = new Publicacion(
                    $row['idpublicacion'], $row['lugar'], $row['fecha'], $row['hora'],
                    $row['categoria'], $row['url'], $row['cant_cupo'], $row['tipo_publico'], ' ',
                    $row['estado']
                );

                $publicacion->idEventoAsistido = $row['id_evento'];
    
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

        public function cantidadMisEventos($idParticipante) {
            $conexion = $this->conectar->getConexion();
            $stmt = $conexion->prepare('SELECT COUNT(*) as total_eventos FROM vista_eventos_asistidos WHERE id_usuario_p = ? AND estado_evento = "asistiendo"');
            $stmt->bind_param('i', $idParticipante);
            $stmt->execute();
            $res = $stmt->get_result();
            $cantidadEventos = $res->fetch_assoc();
            $stmt->close();
            return $cantidadEventos['total_eventos'];
        }
        
        public function cancelarAsistencia($idPublicacion, $idEvento){
            $conexion = $this->conectar->getConexion();
            $stmt = $conexion->prepare('SELECT cancelar_asistencia(?, ?)');
            $stmt->bind_param('ii', $idEvento, $idPublicacion);
            $stmt->execute();
            $stmt->close();
        }

        public function cerrarConexion() {
            $this->conectar->cerrarConexion();
        }

        
    }


?>