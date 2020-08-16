<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogClienteDAO.php";
require_once "Log.php";

class LogCliente extends Log{

    private $LogClienteDAO;

    public function LogCliente($idLogCliente = "", $fecha = "", $browser = "", $os = "", $informacion = "", $Cliente = "", $accion = ""){

        parent::Log($idLogCliente, $fecha, $browser, $os, $informacion, $Cliente, $accion, 2);
        $this -> LogClienteDAO = new LogClienteDAO($this -> idLog, $this -> fecha, $this -> browser, $this -> os, $this -> informacion,  $this -> user, $this -> accion);
        
    }

    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogClienteDAO -> insertar());
        $this -> Conexion -> cerrar();
    }

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogClienteDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();

        $this -> idLog = $res[0] ;
        $this -> fecha = $res[1];
        $this -> informacion = $res[2];
        $this -> accion = $res[3];
        $this -> browser = $res[4];
        $this -> os = $res[5];
        $this -> user = $res[6];
        $this -> tipo = $res[7];
        
        $this -> Conexion -> cerrar();
    }

    /*
     * Trae los clientes registrados en el mes pasado y el mes actual
     */
    public function Registros()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->LogClienteDAO->Registros());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();
        return $resList;
    }

}

?>