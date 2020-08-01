<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogDespachadorDAO.php";

class LogDespachador extends Log{

    private $LogDespachadorDAO;

    public function LogDespachador($idLogDespachador = "", $fecha = "", $browser = "", $os = "", $informacion = "", $Despachador = "", $accion = ""){

        parent::Log($idLogDespachador, $fecha, $browser, $os, $informacion, $Despachador, $accion, 4);
        $this -> LogDespachadorDAO = new LogDespachadorDAO($this -> idLog, $this -> fecha, $this -> browser, $this -> os, $this -> informacion,  $this -> user, $this -> accion);
        
    }

    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        echo $this -> LogDespachadorDAO -> insertar();
        $this -> Conexion -> ejecutar( $this -> LogDespachadorDAO -> insertar());
        $this -> Conexion -> cerrar();
    }

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogDespachadorDAO -> getInfoBasic());
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