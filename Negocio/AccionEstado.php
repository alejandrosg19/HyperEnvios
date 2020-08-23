<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/AccionEstadoDAO.php";

class AccionEstado{
    private $idAccion;
    private $nombre;
    private $descripcion;
    private $AccionEstadoDAO;
    private $Conexion;

    function AccionEstado($idAccion = "", $nombre = "", $descripcion = ""){
        $this -> idAccion = $idAccion;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> AccionEstadoDAO = new AccionEstadoDAO($this -> idAccion, $this -> nombre, $this -> descripcion);
        $this -> Conexion = new Conexion();
    }
    /*
    *   Getters
    */
    function getIdAccion(){
        return $this -> idAccion;
    }
    function getNombre(){
        return $this -> nombre;
    }
    function getDescripcion(){
        return $this -> descripcion;
    }
    /* 
    *   methods
    */

    /**
     * Funcion que obtiene toda la lista de estados
     */
    public function getAllestados(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> AccionEstadoDAO -> getAllestados());
        $resList =  Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }

        $this -> Conexion -> cerrar();
        return $resList;
    }

    /*
     * Busca si ya existe algun nombre de accion registrado
     */
    function existeAccion(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> AccionEstadoDAO -> existeAccion());
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }
    /*
     * Inserta una nueva accion
     */
    function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> AccionEstadoDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AccionEstadoDAO -> filtroPaginado($str, $pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidad($str){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AccionEstadoDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }   
    /**
     * Obtener información básica
     */
    public function getInfoBasic(){

        $this -> Conexion -> abrir();

        $this -> Conexion -> ejecutar( $this -> AccionEstadoDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[1];
        $this -> descripcion = $res[2];

        $this -> Conexion -> cerrar();
    }
    /*
     * Actualiza la información del objeto 
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AccionEstadoDAO -> actualizar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
}