<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/EstadoClienteDAO.php";

class EstadoCliente extends Estado{
    private $EstadoClienteDAO;
    private $Conexion;

    public function EstadoCliente($idEstadoCliente = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idCliente = ""){
        parent::Estado($idEstadoCliente,$fecha,$idAccionEstado,$idOrden,$idCliente,1);
        $this -> EstadoClienteDAO = new EstadoClienteDAO($this -> idEstadoCliente, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idCliente);
        $this -> Conexion = new Conexion();
    }
}
?>