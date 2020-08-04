<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/EstadoConductorDAO.php";

class EstadoConductor extends Estado{
    private $EstadoConductorDAO;
    private $Conexion;

    public function EstadoConductor($idEstadoConductor = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idConductor = ""){
        parent::Estado($idEstadoConductor,$fecha,$idAccionEstado,$idOrden,$idConductor,2);
        $this -> EstadoConductorDAO = new EstadoConductorDAO($this -> idEstadoConductor, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idConductor);
        $this -> Conexion = new Conexion();
    }
}
?>