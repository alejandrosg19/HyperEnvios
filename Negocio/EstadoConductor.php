<?php
require_once "Persistencia/EstadoConductorDAO.php";

class EstadoConductor extends Estado{
    private $EstadoConductorDAO;

    public function EstadoConductor($idEstadoConductor = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idConductor = ""){
        parent::Estado($idEstadoConductor,$fecha,$idAccionEstado,$idOrden,$idConductor,2);
        $this -> EstadoConductorDAO = new EstadoConductorDAO($this -> idEstado, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idActor);
    }
    /**
     * Inserta un nuevo estadoConductor
     */
    public function insert(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> EstadoConductorDAO -> insert());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza la información del objeto con el nombre de FK_idAccionEstado
     */

    public function getEstadoOrdenNombre(){
        $this -> Conexion -> abrir();
        //echo $this -> EstadoConductorDAO -> getEstadoOrdenNombre();
        $this -> Conexion -> ejecutar( $this -> EstadoConductorDAO -> getEstadoOrdenNombre());
        if($this -> Conexion -> numFilas() > 0){
            $res = $this -> Conexion -> extraer();
            $this -> idEstado = $res[0];
            $this -> fecha = $res[1];
            $this -> idAccionEstado = $res[2];
            $this -> idOrden = $res[3];
            $this -> idActor = $res[4];
            return True;
        }else{
            $this -> Conexion -> cerrar();
            return False;
        }
        
    }

    /**
     * Ordenes entregadas por mes
     */

    public function ordenesConductor(){
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->EstadoConductorDAO->ordenesConductor());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();
        return $resList;
    }
}
