<?php

class OrdenDAO{
    private $idOrden;
    private $fecha;
    private $fechaEstimacion;
    private $direccionDestino;
    private $contacto; #Nombre de la persona a quien le llega el pedido
    private $numeroContacto;
    private $fechaLlegada;
    private $idCliente;
    private $idCita;
    private $idEnvio;
    private $idDespachador;
    private $OrdenDAO;
    private $Conexion;

    function OrdenDAO($idOrden = "", $fecha = "", $fechaEstimacion = "", $direccionDestino = "", $contacto = "", $numeroContacto = "", $fechaLlegada = "", $idCliente = "", $idCita = "", $idEnvio = "", $idDespachador = ""){
        $this -> idOrden = $idOrden;
        $this -> fecha = $fecha;
        $this -> fechaEstimacion = $fechaEstimacion;
        $this -> direccionDestino = $direccionDestino;
        $this -> contacto = $contacto;
        $this -> numeroContacto = $numeroContacto;
        $this -> fechaLlegada = $fechaLlegada;
        $this -> idCliente = $idCliente;
        $this -> idCita = $idCita;
        $this -> idEnvio = $idEnvio;
        $this -> idDespachador = $idDespachador;
    }
    /*
    *   Getters
    */
    public function getIdOrden(){
        return $this -> idOrden;
    }
    public function getFecha(){
        return $this -> fecha;
    }
    public function getFechaEstimacion(){
        return $this -> fechaEstimacion;
    }
    public function getDireccionDestino(){
        return $this -> direccionDestino;
    }
    public function getContaco(){
        return $this -> contacto;
    }
    public function getNumeroContacto(){
        return  $this -> numeroContacto;
    }
    public function getFechaLlegada(){
        return $this -> fechaLlegada;
    }
    public function getIdCliente(){
        return $this -> idCliente;
    }
    public function getIdCita(){
        return $this -> idCita;
    }
    public function getIdEnvio(){
        return $this -> idEnvio;
    }
    public function getIdDespachador(){
        return $this -> idDespachador;
    }
}
?>