<?php

class EstadoConductorDAO{
    private $idEstadoConductor;
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idConductor;
    private $EstadoConductorDAO;
    private $Conexion;

    public function EstadoConductorDAO($idEstadoConductor = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idConductor = ""){
        $this -> idEstadoConductor = $idEstadoConductor;
        $this -> fecha = $fecha;
        $this -> idAccionEstado = $idAccionEstado;
        $this -> idOrden = $idOrden;
        $this -> idConductor = $idConductor;
    }

    public function insert(){
        return "INSERT INTO estadoConductor(fecha,FK_idAccionEstado,FK_idOrden,FK_idConductor)
                VALUES ('" . $this ->  fecha . "','" . $this -> idAccionEstado. "','" . $this -> idOrden . "','" . $this -> idConductor ."')";
    }
}
?>