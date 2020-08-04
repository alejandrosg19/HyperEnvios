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
}
?>