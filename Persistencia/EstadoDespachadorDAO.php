<?php
class EstadoDespachadorDAO{
    private $idEstadoDespachador;
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idDespachador;
    private $EstadoDespachadorDAO;
    private $Conexion;

    public function EstadoDespachadorDAO($idEstadoDespachador = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idDespachador = ""){
        $this -> idEstadoDespachador = $idEstadoDespachador;
        $this -> fecha = $fecha;
        $this -> idAccionEstado = $idAccionEstado;
        $this -> idOrden = $idOrden;
        $this -> idDespachador = $idDespachador;
    }
}
?>