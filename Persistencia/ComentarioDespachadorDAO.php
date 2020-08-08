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

    public function insertar(){
        return "INSERT INTO comentarioDespachador (fecha, comentario, FK_idEstadoDespachador) values ('" . $this -> fecha . "', '" . $this -> comentario . "', '" . $this -> idEstadoDespachador . "')";
    }

    public function getComentariosActor(){
        return "SELECT Despachador.nombre, comentario, comentarioDespachador.fecha as fecha from comentarioDespachador
                INNER JOIN estadoDespachador on FK_idEstadoDespachador = idEstadoDespachador
                INNER JOIN Despachador on FK_idDespachador = idDespachador
                WHERE idEstadoDespachador =" . $this -> idEstadoDespachador . "
                ORDER BY fecha desc";
    }
}
?>