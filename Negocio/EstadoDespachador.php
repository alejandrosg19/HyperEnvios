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
    
    public function getEstadoOrden(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> EstadoDespachadorDAO -> getEstadoOrden());
        if($this -> Conexion -> numFilas() > 0){
            $res = $this -> Conexion -> extraer();
            $this -> idEstado = $res[0];
            $this -> fecha = $res[1];
            $this -> FK_idAccionEstado = $res[2];
            $this -> FK_idOrden = $res[3];
            $this -> FK_idDespachador = $res[4];
            return True;
        }else{
            $this -> Conexion -> cerrar();
            return False;
        }
        
    }
}
?>