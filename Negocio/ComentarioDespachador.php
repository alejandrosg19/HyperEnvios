<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ComentarioDespachadorDAO.php";

class ComentarioDespachador{
    private $idComentarioDespachador;
    private $fecha;
    private $comentario;
    private $idEstadoDespachador;
    private $ComentarioDespachadorDAO;
    private $Conexion;

    public function ComentarioConductor($idComentarioDespachador = "", $fecha = "", $comentario = "", $idEstadoDespachador = ""){
        $this -> idComentarioDespachador = $idComentarioDespachador;
        $this -> fecha = $fecha;
        $this -> comentario = $comentario;
        $this -> idEstadoDespachador = $idEstadoDespachador;
        $this -> ComentarioDespachadorDAO = new ComentarioDespachadorDAO($this -> idComentarioDespachador, $this ->  fecha, $this -> comentario, $this -> idEstadoDespachador);
        $this -> Conexion = new Conexion();
    }

    /*
    *   Getters
    */
    public function getIdComentarioDespachador(){
        return $this -> idComentarioDespachador;
    }
    public function getFecha(){
        return $this ->  fecha;
    }
    public function getComentario(){
        return $this ->  comentario;
    }
    public function getIdEstadoDespachador(){
        return $this -> idEstadoDespachador;
    }

    /*
    *   Setters
    */

    public function setIdComentarioDespachador($idComentarioDespachador){
        $this -> idComentarioDespachador = $idComentarioDespachador;
    }
    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }
    public function setComentario($comentario){
        $this -> comentario = $comentario;
    }
    public function setIdEstadoDespachador($idEstadoDespachador){
        $this -> idEstadoDespachador = $idEstadoDespachador;
    }
}
?>