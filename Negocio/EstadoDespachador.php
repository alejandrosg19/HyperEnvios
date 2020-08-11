<?php
require_once "Persistencia/EstadoDespachadorDAO.php";

class EstadoDespachador extends Estado{
    private $EstadoDespachadorDAO;

    public function EstadoDespachador($idEstadoDespachador = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idDespachador = ""){
        parent::Estado($idEstadoDespachador,$fecha,$idAccionEstado,$idOrden,$idDespachador,3);
        $this -> EstadoDespachadorDAO = new EstadoDespachadorDAO($this -> idEstado, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idActor);
    }
    /**
     * Inserta un nuevo estadoDespachador
     */
    public function insert(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> EstadoDespachadorDAO -> insert());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
    
    /**
     * Actualiza la información del objeto con los ID's
     */
    public function getEstadoOrden(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> EstadoDespachadorDAO -> getEstadoOrden());
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
     * Actualiza la información del objeto con el nombre de FK_idAccionEstado
     */

    public function getEstadoOrdenNombre(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> EstadoDespachadorDAO -> getEstadoOrdenNombre());
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
}
?>