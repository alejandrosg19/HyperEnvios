<?php

class EstadoConductorDAO{
    private $idEstadoConductor;
    private $fecha;
    private $idAccionEstado;
    private $irOrden;
    private $idConductor;
    private $EstadoConductorDAO;
    private $Conexion;

    public function EstadoConductorDAO($idEstadoConductor = "", $fecha = "", $idAccionEstado = "", $irOrden = "", $idConductor = ""){
        $this -> idEstadoConductor = $idEstadoConductor;
        $this -> fecha = $fecha;
        $this -> idAccionEstado = $idAccionEstado;
        $this -> irOrden = $irOrden;
        $this -> idConductor = $idConductor;
    }
}
?>