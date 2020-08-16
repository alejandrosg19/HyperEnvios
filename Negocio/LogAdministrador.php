<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogAdministradorDAO.php";
require_once "Log.php";

class LogAdministrador extends Log{

    private $LogAdministradorDAO;

    public function LogAdministrador($idLogAdmin = "", $fecha = "", $browser = "", $os = "", $informacion = "", $Administrador = "", $accion = ""){

        parent::Log($idLogAdmin, $fecha, $browser, $os, $informacion, $Administrador, $accion, 1);
        $this -> LogAdministradorDAO = new LogAdministradorDAO($this -> idLog, $this -> fecha, $this -> browser, $this -> os, $this -> informacion,  $this -> user, $this -> accion);
        
    }

    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogAdministradorDAO -> insertar());
        $this -> Conexion -> cerrar();
    }

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogAdministradorDAO -> getInfoBasic());
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