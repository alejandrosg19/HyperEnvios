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

    public function getEstadoOrdenNombre(){
        return "SELECT idEstadoConductor, fecha, nombre, FK_idOrden, FK_idConductor
                FROM estadoConductor
                INNER JOIN AccionEstado on idAccion = FK_idAccionEstado
                WHERE FK_idOrden = '" . $this -> idOrden . "' AND FK_idConductor = '" . $this -> idConductor . "'
                ORDER BY fecha desc
                LIMIT 1";
    }
}
