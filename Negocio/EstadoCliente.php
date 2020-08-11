<?php 
require_once "Persistencia/EstadoClienteDAO.php";

class EstadoCliente extends Estado{
    
    private $EstadoClienteDAO;

    public function EstadoCliente($idEstadoCliente = "", $fecha ="", $idAccionEstado="", $idOrden="", $idCliente=""){
        parent::Estado($idEstadoCliente,$fecha,$idAccionEstado,$idOrden,$idCliente,1);
        $this -> EstadoClienteDAO = new EstadoClienteDAO($this -> idEstado, $this -> fecha, $this -> idAccionEstado, $this -> idOrden, $this -> idActor);
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
    /**
     * Actualiza la información del objeto con los ID's
     */

    public function getEstadoOrden(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> EstadoClienteDAO -> getEstadoOrden());
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
        $this -> Conexion -> ejecutar( $this -> EstadoClienteDAO -> getEstadoOrdenNombre());
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