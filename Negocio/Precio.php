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

    function Precio($idPrecio = "", $pesoMaximo = "", $pesoMinimo = "", $precio = ""){
        $this -> idPrecio = $idPrecio;
        $this -> pesoMaximo = $pesoMaximo;
        $this -> pesoMinimo = $pesoMinimo;
        $this -> precio = $precio;
        $this -> PrecioDAO = new PrecioDAO($this -> idPrecio, $this -> pesoMaximo, $this -> pesoMinimo, $this -> precio);
        $this -> Conexion = new Conexion();
    }

    function existePeso(){
        $this -> Conexion -> Abrir();
        $this -> Conexion -> ejecutar();
    }
}
?>