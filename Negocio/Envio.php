<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/EnvioDAO.php";

class Envio{
    private $idEnvio;
    private $fechaSalida;
    private $idConductor;
    private $Conexion;
    private $EnvioDAO;

    public function Envio($idEnvio = "", $fechaSalida = "", $idConductor = ""){
        $this -> idEnvio = $idEnvio;
        $this -> fechaSalida = $fechaSalida;
        $this -> idConductor = $idConductor;
        $this -> Conexion = new Conexion();
        $this -> EnvioDAO = new EnvioDAO($this -> idEnvio, $this -> fechaSalida, $this -> idConductor);
    }

    public function getIdEnvio(){
        return $this -> idEnvio;
    }
    public function getFechaSalida(){
        return $this -> fechaSalida;
    }
    public function getIdConductor(){
        return $this -> idConductor;
    }
    /**
     * Inserta un nuevo envio
     */
    public function insert(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> EnvioDAO -> insert());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function getInfoFecha(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> EnvioDAO -> getInfoFecha());
        $res = $this -> Conexion -> extraer();
        $this -> idEnvio = $res[0];
        $this -> Conexion -> cerrar();
    }
}
