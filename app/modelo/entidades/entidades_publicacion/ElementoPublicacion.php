<?php
class ElementoPublicacion {
    public $tipoElemento;
    public $contenido;

    public function __construct($tipoElemento, $contenido) {
        $this->tipoElemento = $tipoElemento;
        $this->contenido = $contenido;
    }
}

?>