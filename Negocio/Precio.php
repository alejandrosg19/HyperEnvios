<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/PrecioDAO.php";

class Precio{
    private $idPrecio;
    private $pesoMaximo;
    private $pesoMinimo;
    private $precio;
    private $PrecioDAO;
    private $Conexion;

    function Precio($idPrecio = "", $pesoMinimo = "", $pesoMaximo = "", $precio = ""){
        $this -> idPrecio = $idPrecio;
        $this -> pesoMaximo = $pesoMaximo;
        $this -> pesoMinimo = $pesoMinimo;
        $this -> precio = $precio;
        $this -> PrecioDAO = new PrecioDAO($this -> idPrecio, $this -> pesoMaximo, $this -> pesoMinimo, $this -> precio);
        $this -> Conexion = new Conexion();
    }
    /*
    *   Getters
    */
    function getIdPrecio(){
        return $this -> idPrecio;
    }
    function getPesoMaximo(){
        return $this -> pesoMaximo;
    }
    function getPesoMinimo(){
        return $this -> pesoMinimo;
    }
    function getPrecio(){
        return $this -> precio;
    }

    /* 
    *   methods
    */

    /*
     * Busca si ya existe algun peso con los pesos registrados 
     */
    function existePeso(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> PrecioDAO -> existePeso());
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }
    /*
     * Inserta un nuevo precio y sus pesos
     */
    function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> PrecioDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> PrecioDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> PrecioDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }   
    /**
     * Obtener información básica
     */
    public function getInfoBasic(){

        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> PrecioDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        
        $this -> pesoMinimo = $res[1];
        $this -> pesoMaximo = $res[2];
        $this -> precio = $res[3];

        $this -> Conexion -> cerrar();
    }
    /*
     * Actualiza la información del objeto 
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> PrecioDAO -> actualizar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
    /*
     * Elima Objeto
     */
    public function deletePrecio(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> PrecioDAO -> deletePrecio());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Busca precio dependiendo del peso
     */
    public function getPrecioPeso($peso){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> PrecioDAO -> getPrecioPeso($peso));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /**
     * Me devuelve el ultimo peso que manejamos
     */
    public function getMaxPeso(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> PrecioDAO -> getMaxPeso());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }
}
