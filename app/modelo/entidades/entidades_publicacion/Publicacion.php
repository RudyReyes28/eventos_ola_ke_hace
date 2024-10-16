<?php
class Publicacion {
    public $idPublicacion;
    public $publicador;
    public $lugar;
    public $fecha;
    public $hora;
    public $categoria;
    public $url;
    public $cantCupo;
    public $tipoPublico;

    public $estado;
    public $elementosPublicacion = [];

    public function __construct($id, $lugar, $fecha, $hora, $categoria, $url, $cantCupo, $tipoPublico, $publicador, $estado) {
        $this->idPublicacion = $id;
        $this->lugar = $lugar;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->categoria = $categoria;
        $this->url = $url;
        $this->cantCupo = $cantCupo;
        $this->tipoPublico = $tipoPublico;
        $this->publicador = $publicador;
        $this->estado = $estado;
    }

    public function agregarElementoPublicacion($elemento) {
        $this->elementosPublicacion[] = $elemento;
    }
}


?>