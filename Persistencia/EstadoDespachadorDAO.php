<?php
class EstadoDespachadorDAO{
    private $idEstadoDespachador;
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idDespachador;

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
    
    public function getEstadoOrden(){
        return "SELECT idEstadoDespachador, fecha, FK_idAccionEstado, FK_idOrden, FK_idDespachador
                FROM estadoDespachador
                WHERE FK_idOrden = '" . $this -> idOrden . "' AND FK_idDespachador = '" . $this -> idDespachador . "'
                ORDER BY fecha desc
                LIMIT 1";
    }
}
?>