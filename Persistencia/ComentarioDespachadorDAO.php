<?php

class ComentarioDespachadorDAO{
    private $idComentarioDespachador;
    private $fecha;
    private $comentario;
    private $idEstadoDespachador;

    public function ComentarioDespachadorDAO($idComentarioDespachador = "", $fecha = "", $comentario = "", $idEstadoDespachador = ""){
        $this -> idComentarioDespachador = $idComentarioDespachador;
        $this -> fecha = $fecha;
        $this -> comentario = $comentario;
        $this -> idEstadoDespachador = $idEstadoDespachador;
    }

    public function getInfo()
    {
        return "SELECT comentariodespachador.fecha, comentario 
                FROM comentariodespachador
                INNER JOIN estadodespachador ON FK_idEstadoDespachador = idEstadoDespachador
                WHERE idEstadoDespachador = '" . $this->idEstadoDespachador . "'
                ORDER BY fecha DESC";
    }
}
?>