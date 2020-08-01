<?php 

class LogAdministradorDAO{

    private $idLogAdministrador;
    private $fecha;
    private $browser;
    private $os;
    private $informacion;
    private $Administrador;
    private $accion;
    
    

    public function LogAdministradorDAO($idLogAdministrador = "", $fecha = "", $browser = "", $os = "", $informacion = "",  $Administrador = "", $accion = ""){
        $this -> idLogAdministrador = $idLogAdministrador;
        $this -> fecha = $fecha;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> informacion = $informacion;
        $this -> Administrador = $Administrador;
        $this -> accion = $accion;
    }

    public function insertar(){
        return "INSERT INTO LogAdministrador (fecha, browser, os, informacion,  FK_idAdministrador, FK_idAccion) 
                VALUES ('" . $this -> fecha . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> informacion . "', '" . $this -> Administrador . "', '" . $this -> accion . "')";
    }
    
    public function getInfoBasic(){
        return "SELECT idLogAdministrador, Fecha, informacion, FK_idAccion, browser, os, FK_idAdministrador, 1 
                FROM logAdministrador 
                WHERE idLogAdministrador = " . $this -> idLogAdministrador;
    }

}
?>