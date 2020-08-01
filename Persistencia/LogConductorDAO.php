<?php 

class LogConductorDAO{

    private $idLogConductor;
    private $fecha;
    private $browser;
    private $os;
    private $informacion;
    private $Conductor;
    private $accion;
    
    

    public function LogConductorDAO($idLogConductor = "", $fecha = "", $browser = "", $os = "", $informacion = "",  $Conductor = "", $accion = ""){
        $this -> idLogConductor = $idLogConductor;
        $this -> fecha = $fecha;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> informacion = $informacion;
        $this -> Conductor = $Conductor;
        $this -> accion = $accion;
    }

    public function insertar(){
        return "INSERT INTO LogConductor (fecha, browser, os, informacion,  FK_idConductor, FK_idAccion) 
                VALUES ('" . $this -> fecha . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> informacion . "', '" . $this -> Conductor . "', '" . $this -> accion . "')";
    }

    public function getInfoBasic(){
        return "SELECT idLogConductor, Fecha, informacion, FK_idAccion, browser, os, FK_idConductor, 3 
                FROM logConductor 
                WHERE idLogConductor = " . $this -> idLogConductor;
    }

}
?>