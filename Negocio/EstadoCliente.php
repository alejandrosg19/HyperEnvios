<?php 
require_once "Persistencia/Conexion.php";
require_once "Persistencia/EstadoClienteDAO.php";

class EstadoCliente extends Estado{
    
    private $EstadoClienteDAO;

    public function EstadoCliente($idEstadoCliente = "", $fecha ="", $idAccionEstado="", $idOrden="", $idCliente=""){
        parent::Estado($idEstadoCliente,$fecha,$idAccionEstado,$idOrden,$idCliente,1);
        $this -> EstadoClienteDAO = new EstadoClienteDAO($this -> idEstado, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idActor);
    }

    /**
     * Setters
     */
    public function setIdEstadoCliente($idEstadoCliente){
        $this -> idEstadoCliente = $idEstadoCliente;
    }

    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }

    public function setIdAccionEstado($idAccionEstado){
        $this -> idAccionEstado = $idAccionEstado;
    }

    public function setIdOrden($idOrden){
        $this -> idOrden = $idOrden;
    }

    public function setIdCliente($idCliente){
        $this -> idCliente = $idCliente;
    }
    
    /**
     * Getters
     */

    public function getIdEstadoCliente(){
        return $this -> idEstadoCliente;
    }

    public function getFecha(){
        return $this -> fecha;
    }

    public function getIdAccionEstado(){
        return $this -> idAccionEstado;
    }

    public function getIdOrden(){
        return $this -> idOrden;
    }

    public function getIdCliente(){
        return $this -> idCliente;
    }

    /**
     * Methods
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> EstadoClienteDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
}

?>