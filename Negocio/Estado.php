<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/EstadoDAO.php";

class Estado
{
    protected $idEstado;
    protected $fecha;
    protected $idAccionEstado;
    protected $idOrden;
    protected $idActor;
    protected $tipo;
    protected $EstadoDAO;
    protected $Conexion;

    public function Estado($idEstado = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idActor = "", $tipo = "")
    {
        $this->idEstado = $idEstado;
        $this->fecha = $fecha;
        $this->idAccionEstado = $idAccionEstado;
        $this->idOrden = $idOrden;
        $this->idActor = $idActor;
        $this->tipo = $tipo;
        $this->EstadoDAO = new EstadoDAO($this->idEstado, $this->fecha, $this->idAccionEstado, $this->idOrden, $this->idActor);
        $this->Conexion = new Conexion();
    }

    /*
    *   Getters
    */
    public function getIdEstado()
    {
        return $this->idEstado;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getIdAccionEstado()
    {
        return $this->idAccionEstado;
    }
    public function getIdOrden()
    {
        return $this->idOrden;
    }
    public function getIdActor()
    {
        return $this->idActor;
    }
    public function getTipo()
    {
        return $this->tipo;
    }

    /*
    *   Setters
    */
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setIdAccionEstado($idAccionEstado)
    {
        $this->idAccionEstado = $idAccionEstado;
    }
    public function setIdOrden($idOrden)
    {
        $this->idOrden = $idOrden;
    }
    public function setIdActor($idActor)
    {
        $this->idActor = $idActor;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /* 
    *   methods
    */
    /*
     * Función que trae todos los estados asociados a una orden
     */
    public function getEstados()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->EstadoDAO->getEstados());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }

}
