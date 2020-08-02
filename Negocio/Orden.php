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
        $this -> OrdenDAO = new OrdenDAO($this -> idOrden, $this -> fecha, $this -> fechaEstimacion, $this -> direccionDestino, $this -> contacto, $this -> numeroContacto, $this -> fechaLlegada, $this -> idCliente, $this -> idCita, $this -> idEnvio, $this -> idDespachador);
        $this -> Conexion = new Conexion();
    }

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

    public function getContacto(){
        return $this -> contacto;
    }

    public function getNumeroContacto(){
        return $this -> numeroContacto;
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

    public function setIdOrden($idOrden){
        $this -> idOrden = $idOrden;
    }

    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }

    public function setFechaEstimacion($fechaEstimacion){
        $this -> fechaEstimacion = $fechaEstimacion;
    }

    public function setDireccionDestino($direccionDestino){
        $this -> direccionDestino = $direccionDestino;
    }

    public function setContacto($contacto){
        $this -> contacto = $contacto;
    }

    public function setNumeroContacto($numeroContacto){
        $this -> numeroContacto = $numeroContacto;
    }

    public function setFechaLlegada($fechaLlegada){
        $this -> fechaLlegada = $fechaLlegada;
    }

    public function setIdCliente($idCliente){
        $this -> idCliente = $idCliente;
    }

    public function setIdCita($idCita){
        $this -> idCita = $idCita;
    }

    public function setIdEnvio($idEnvio){
        $this -> idEnvio = $idEnvio;
    }

    public function setIdDespachador($idDespachador){
        $this -> idDespachador = $idDespachador;
    }
}
?>