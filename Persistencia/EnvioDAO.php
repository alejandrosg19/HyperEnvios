<?php

class EnvioDAO{
    private $idEnvio;
    private $fechaSalida;
    private $idConductor;

    public function EnvioDAO($idEnvio = "", $fechaSalida = "", $idConductor = ""){
        $this -> idEnvio = $idEnvio;
        $this -> fechaSalida = $fechaSalida;
        $this -> idConductor = $idConductor;
    }

    public function insert(){
        return "INSERT INTO envio(fechaSalida, FK_idConductor)
                VALUES ('" . $this -> fechaSalida . "','" . $this -> idConductor . "')";
    }
}
?>