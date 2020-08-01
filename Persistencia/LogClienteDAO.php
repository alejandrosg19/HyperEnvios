<?php 

class LogClienteDAO{

    private $idLogCliente;
    private $fecha;
    private $browser;
    private $os;
    private $informacion;
    private $Cliente;
    private $accion;
    
    

    public function LogClienteDAO($idLogCliente = "", $fecha = "", $browser = "", $os = "", $informacion = "",  $Cliente = "", $accion = ""){
        $this -> idLogCliente = $idLogCliente;
        $this -> fecha = $fecha;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> informacion = $informacion;
        $this -> Cliente = $Cliente;
        $this -> accion = $accion;
    }

    public function insertar(){
        return "INSERT INTO LogCliente (fecha, browser, os, informacion,  FK_idCliente, FK_idAccion) 
                VALUES ('" . $this -> fecha . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> informacion . "', '" . $this -> Cliente . "', '" . $this -> accion . "')";
    }
    
    public function getInfoBasic(){
        return "SELECT idLogCliente, Fecha, informacion, FK_idAccion, browser, os, FK_idCliente, 2 
                FROM logCliente 
                WHERE idLogCliente = " . $this -> idLogCliente;
    }

}
?>