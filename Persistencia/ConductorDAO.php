<?php 

class ConductorDAO{
    private $idConductor;
    private $nombre;
    private $correo;
    private $clave;
    private $telefono;
    private $foto;
    private $estado;

    public function ConductorDAO($idConductor = "", $nombre = "", $correo = "",  $clave = "", $telefono = "",$foto = "", $estado = ""){
        $this -> idConductor = $idConductor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> telefono = $telefono;
        $this -> foto = $foto;
        $this -> estado = $estado;
    }

    /* 
    *   methods
    */

    public function autenticar(){
        return "SELECT idConductor, estado
                FROM conductor 
                WHERE email = '" . $this -> correo . "' AND clave ='" . md5($this -> clave) . "'";
    }

    public function getInfoNav(){
        return "SELECT nombre, email, foto
                FROM conductor
                WHERE idConductor = " . $this -> idConductor;
    }

    
}
?>