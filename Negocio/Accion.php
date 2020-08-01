<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/AccionDAO.php";

class Accion{
    private $idAccion;
    private $nombre;

    private $Conexion;
    private $AccionDAO;

    public function Accion($idAccion = "", $nombre = ""){
        $this -> idAccion = $idAccion;
        $this -> nombre = $nombre;

        $this -> Conexion = new Conexion();
        $this -> AccionDAO = new AccionDAO($this -> idAccion, $this-> nombre);
    }

    /**
     * GETS
     */
    public function getIdAccion(){
        return $this -> idAccion;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    /**
     * SETS
     */
    public function setIdAccion($idAccion){
        $this -> idAccion = $idAccion;
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    } 

    /**
     * Methods
     */

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AccionDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[1];
        $this -> Conexion -> cerrar();
    }

}


?>