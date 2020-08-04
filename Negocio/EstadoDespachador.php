<?php
require_once "Persistencia/EstadoDespachadorDAO.php";

class EstadoDespachador extends Estado{
    private $EstadoDespachadorDAO;

    public function EstadoDespachador($idEstadoDespachador = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idDespachador = ""){
        parent::Estado($idEstadoDespachador,$fecha,$idAccionEstado,$idOrden,$idDespachador,3);
        $this -> EstadoDespachadorDAO = new EstadoDespachadorDAO($this -> idEstado, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idActor);
    }
}
?>