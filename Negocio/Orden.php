<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/OrdenDAO.php";

class Orden{
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

    function Orden($idOrden = "", $fecha = "", $fechaEstimacion = "", $direccionDestino = "", $contacto = "", $numeroContacto = "", $fechaLlegada = "", $idCliente = "", $idCita = "", $idEnvio = "", $idDespachador = ""){
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
        $this -> OrderDAO = new OrdenDAO($this -> idOrden, $this -> fecha, $this -> fechaEstimacion, $this -> direccionDestino, $this -> contacto, $this ->numeroContacto, $this -> fechaLlegada, $this -> idCliente, $this -> idCita, $this -> idEnvio, $this -> idDespachador);
        $this -> Conexion = new Conexion();
    }
}
?>