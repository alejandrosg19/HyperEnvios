<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ItemDAO.php";

class Item{
    private $idItem;
    private $referencia;
    private $nombre;
    private $descripcion;
    private $peso;
    private $fabricante;
    private $precio;
    private $idOrden;
    private $ItemDAO;
    private $Conexion;

    public function Item($idItem = "", $referencia = "", $nombre = "", $descripcion = "", $peso = "", $fabricante = "", $precio = "", $idOrden = ""){
        $this -> idItem = $idItem;
        $this -> referencia = $referencia;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> peso = $peso;
        $this -> fabricante = $fabricante;
        $this -> precio = $precio;
        $this -> idOrden = $idOrden;
        $this -> ItemDAO = new ItemDAO($this -> idItem, $this -> referencia, $this -> nombre, $this -> descripcion, $this -> peso, $this -> fabricante, $this -> precio, $this -> idOrden);
        $this -> Conexion = new Conexion();
    }

    /**
     * Setters
     */

    public function setIdItem($idItem){
        $this -> idItem = $idItem;
    }

    public function setReferencia($referencia){
        $this -> referencia = $referencia;
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function setDescripcion($descripcion){
        $this -> descripcion = $descripcion;
    }

    public function setPeso($peso){
        $this -> peso = $peso;
    }

    public function setFabricante($fabricante){
        $this -> fabricante = $fabricante;
    }

    public function setPrecio($precio){
        $this -> precio = $precio;
    }

    public function setIdOrden($idOrden){
        $this -> idOrden = $idOrden;
    }

    /**
     * Getters
     */

    public function getIdItem(){
        return $this -> idItem;
    }

    public function getReferencia(){
        return $this -> referencia;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getDescripcion(){
        return $this -> descripcion;
    }

    public function getPeso(){
        return $this -> peso;
    }

    public function getFabricante(){
        return $this -> fabricante;
    }

    public function getPrecio(){
        return $this -> precio;
    }

    public function getIdOrden(){
        return $this -> idOrden;
    }

    /**
     * Insertar un nuevo Item
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ItemDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ItemDAO -> getInfoBasic());
        $arrList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($arrList, $res);
        }
        $this -> Conexion -> cerrar();
        return $arrList;
    }
}

?>