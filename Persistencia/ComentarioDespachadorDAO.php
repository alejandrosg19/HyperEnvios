<?php

class ComentarioDespachadorDAO{
    private $idComentarioDespachador;
    private $fecha;
    private $comentario;
    private $idEstadoDespachador;

    public function ComentarioConductorDAO($idComentarioDespachador = "", $fecha = "", $comentario = "", $idEstadoDespachador = ""){
        $this -> idComentarioDespachador = $idComentarioDespachador;
        $this -> fecha = $fecha;
        $this -> comentario = $comentario;
        $this -> idEstadoDespachador = $idEstadoDespachador;
    }
}
?>