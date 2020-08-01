<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogDAO.php";

class Log{

    protected $idLog;
    protected $fecha;
    protected $informacion;
    protected $accion;
    protected $browser;
    protected $os;
    protected $user;
    protected $tipo;

    protected $Conexion;
    private $LogDAO; 

    public function Log($idLog = "", $fecha = "", $browser = "", $os = "", $informacion = "", $user = "", $accion = "", $tipo = ""){
        $this -> idLog = $idLog;
        $this -> fecha = $fecha;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> informacion = $informacion;
        $this -> user = $user;
        $this -> accion = $accion;
        $this -> tipo = $tipo;

        $this -> Conexion = new Conexion();
        $this -> LogDAO = new LogDAO($this -> idLog = $idLog, $this -> fecha = $fecha, $this -> informacion = $informacion, $this -> accion = $accion, $this -> browser = $browser, $this -> os = $os, $this -> user = $user);
    }

    /**
     * GETS
     */

    public function getIdLog(){
        return $this -> idLog;
    }

    public function getFecha(){
        return $this -> fecha;
    }

    public function getInformacion(){
        return $this -> informacion;
    }

    public function getAccion(){
        return $this -> accion;
    }

    public function getBrowser(){
        return $this -> browser;
    }

    public function getOs(){
        return $this -> os;
    }

    public function getUser(){
        return $this -> user;
    }

    public function getTipo(){
        return $this -> tipo;
    }

    /**
     * SETS
     */

    public function setIdLog($idLog){
        $this -> idLog = $idLog;
    }

    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }

    public function setInformacion($informacion){
        $this -> informacion = $informacion;
    }

    public function setAccion($accion){
        $this -> accion = $accion;
    }

    public function setBrowser($browser){
        $this -> browser = $browser;
    }

    public function setOs($os){
        $this -> os = $os;
    }
    
    public function setUser($user){
        $this -> user = $user;
    }

    public function setTipo($tipo){
        $this -> tipo = $tipo;
    }

    /**
     * Methods
     */
    public function buscarPaginado($pagina, $numReg){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> LogDAO -> buscarPaginado($pagina, $numReg));
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            //$idLog = "", $fecha = "", $browser = "", $os = "", $informacion = "", $user = "", $accion = "", $tipo = ""
            //idLogAdministrador, Fecha, browser, os, informacion, Administrador.nombre, FK_idAccion, accion.nombre AS accion, 1 
            array_push($resList, new Log($res[0], $res[1], $res[2], $res[3], $res[4], $res[5], $res[7], $res[8]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    public function buscarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogDAO -> buscarCantidad());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogDAO -> filtroPaginado($str, $pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidad($str){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }


}

?>