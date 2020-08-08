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

    public function ComentarioDespachador($idComentarioDespachador = "", $fecha = "", $comentario = "", $idEstadoDespachador = ""){
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

    /**
     * Methods
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> ComentarioDespachadorDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function getComentariosActor(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> ComentarioDespachadorDAO -> getComentariosActor());
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();
        return $resList;
    }
}
?>