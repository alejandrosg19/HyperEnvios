<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogConductorDAO.php";

class LogConductor extends Log{

    private $LogConductorDAO;

    public function LogConductor($idLogConductor = "", $fecha = "", $browser = "", $os = "", $informacion = "", $Conductor = "", $accion = ""){

        parent::Log($idLogConductor, $fecha, $browser, $os, $informacion, $Conductor, $accion, 3);
        $this -> LogConductorDAO = new LogConductorDAO($this -> idLog, $this -> fecha, $this -> browser, $this -> os, $this -> informacion,  $this -> user, $this -> accion);
        
    }

    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        echo $this -> LogConductorDAO -> insertar();
        $this -> Conexion -> ejecutar( $this -> LogConductorDAO -> insertar());
        $this -> Conexion -> cerrar();
    }

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogConductorDAO -> getInfoBasic());
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

}

?>