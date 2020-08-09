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

    public function insert(){
        return "INSERT INTO estadoDespachador(fecha,FK_idAccionEstado,FK_idOrden,FK_idDespachador)
                VALUES ('" . $this ->  fecha . "','" . $this -> idAccionEstado. "','" . $this -> idOrden . "','" . $this -> idDespachador ."')";
    }
}
?>