<?php

class EstadoClienteDAO{
    private $idEstadoCliente;
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idCliente;
    private $EstadoClienteDAO;
    private $Conexion;

    public function EstadoClienteDAO($idEstadoCliente = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idCliente = ""){
        $this -> idEstadoCliente = $idEstadoCliente;
        $this -> fecha = $fecha;
        $this -> idAccionEstado = $idAccionEstado;
        $this -> idOrden = $idOrden;
        $this -> idCliente = $idCliente;
    }
    public function insertar(){
        return "INSERT INTO EstadoCliente (fecha, FK_idAccionEstado, FK_idOrden, FK_idCliente) 
                VALUES('" . $this -> fecha. "','" . $this -> idAccionEstado . "','" . $this -> idOrden . "','" . $this -> idCliente . "')";
    }

    public function getEstadoOrden(){
        return "SELECT idEstadoCliente, fecha, FK_idAccionEstado, FK_idOrden, FK_idCliente
                FROM estadoCliente
                WHERE FK_idOrden = '" . $this -> idOrden . "' AND FK_idCliente = '" . $this -> idCliente . "'
                ORDER BY fecha desc
                LIMIT 1";
    }

    public function getEstadoOrdenNombre(){
        return "SELECT idEstadoCliente, fecha, nombre, FK_idOrden, FK_idCliente
                FROM estadoCliente
                INNER JOIN AccionEstado on idAccion = FK_idAccionEstado
                WHERE FK_idOrden = '" . $this -> idOrden . "' AND FK_idCliente = '" . $this -> idCliente . "'
                ORDER BY fecha desc
                LIMIT 1";
    }
}

?>