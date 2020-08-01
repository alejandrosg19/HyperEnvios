<?php 

class LogDespachadorDAO{

    private $idLogDespachador;
    private $fecha;
    private $browser;
    private $os;
    private $informacion;
    private $Despachador;
    private $accion;
    
    

    public function LogDespachadorDAO($idLogDespachador = "", $fecha = "", $browser = "", $os = "", $informacion = "",  $Despachador = "", $accion = ""){
        $this -> idLogDespachador = $idLogDespachador;
        $this -> fecha = $fecha;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> informacion = $informacion;
        $this -> Despachador = $Despachador;
        $this -> accion = $accion;
    }

    public function insertar(){
        return "INSERT INTO LogDespachador (fecha, browser, os, informacion,  FK_idDespachador, FK_idAccion) 
                VALUES ('" . $this -> fecha . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> informacion . "', '" . $this -> Despachador . "', '" . $this -> accion . "')";
    }

    public function getInfoBasic(){
        return "SELECT idLogDespachador, Fecha, informacion, FK_idAccion, browser, os, FK_idDespachador, 4 
                FROM logDespachador 
                WHERE idLogdespachador = " . $this -> idLogDespachador;
    }

}
?>