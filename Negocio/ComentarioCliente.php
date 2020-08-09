<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ComentarioClienteDAO.php";

class ComentarioCliente{
    private $idComentarioCliente;
    private $fecha;
    private $comentario;
    private $idEstadoCliente;
    private $ComentarioClienteDAO;
    private $Conexion;

    public function ComentarioCliente($idComentarioCliente = "", $fecha = "", $comentario = "", $idEstadoCliente = ""){
        $this -> idComentarioCliente = $idComentarioCliente;
        $this -> fecha = $fecha;
        $this -> comentario = $comentario;
        $this -> idEstadoCliente = $idEstadoCliente;
        $this -> ComentarioClienteDAO = new ComentarioClienteDAO($this -> idComentarioCliente, $this ->  fecha, $this -> comentario, $this -> idEstadoCliente);
        $this -> Conexion = new Conexion();
    }

    /*
    *   Getters
    */
    public function getIdComentarioCliente(){
        return $this -> idComentarioCliente;
    }
    public function getFecha(){
        return $this ->  fecha;
    }
    public function getComentario(){
        return $this ->  comentario;
    }
    public function getIdEstadoCliente(){
        return $this -> idEstadoCliente;
    }

    /*
    *   Setters
    */

    public function setIdComentarioCliente($idComentarioCliente){
        $this -> idComentarioCliente = $idComentarioCliente;
    }
    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }
    public function setComentario($comentario){
        $this -> comentario = $comentario;
    }
    public function setIdEstadoCliente($idEstadoCliente){
        $this -> idEstadoCliente = $idEstadoCliente;
    }

    /**
     * Methods
     */

    /**
     * Función que inserta un nuevo comentario de Cliente
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> ComentarioClienteDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Función que busca los comentarios de un estado especifico del cliente
     */
    public function getComentariosActor(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> ComentarioClienteDAO -> getComentariosActor());
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
    * Función que trae todos los comentario asociados a un estadoCliente
    */
    public function getInfo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ComentarioClienteDAO -> getInfo());
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }
}
?>