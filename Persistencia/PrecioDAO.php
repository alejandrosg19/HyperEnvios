<?php

class PrecioDAO{
    private $idPrecio;
    private $pesoMaximo;
    private $pesoMinimo;
    private $precio;

    function PrecioDAO($idPrecio = "", $pesoMaximo = "", $pesoMinimo = "", $precio = ""){
        $this -> idPrecio = $idPrecio;
        $this -> pesoMaximo = $pesoMaximo;
        $this -> pesoMinimo = $pesoMinimo;
        $this -> precio = $precio;
    }
}
?>