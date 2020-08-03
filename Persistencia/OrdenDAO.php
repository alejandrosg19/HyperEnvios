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

    function insertar(){
        return "INSERT INTO Orden (fecha, fechaEstimacion, direccionDestino, contacto, numeroContacto, FK_idCliente, FK_idCita)
                VALUES ('" . $this -> fecha . "','"  . $this -> fechaEstimacion . "','" . $this -> direccionDestino . "','" . $this -> contacto . "','"  . $this -> numeroContacto . "','" . $this -> idCliente . "','" . $this -> idCita . "')";
    }
}
?>