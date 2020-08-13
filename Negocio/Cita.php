<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/CitaDAO.php";

class Cita{
    private $idCita;
    private $fechaCita;
    private $idConductor;
    private $CitaDAO;
    private $Conexion;

    public function Cita($idCita = "", $fechaCita = "", $idConductor=""){
        $this -> idCita = $idCita;
        $this -> fechaCita = $fechaCita;
        $this -> idConductor = $idConductor;
        $this -> CitaDAO = new CitaDAO($this -> idCita, $this -> fechaCita, $this -> idConductor);
        $this -> Conexion = new Conexion();
    }

    /**
     * Setters
     */
    function getIdCita(){
        return $this -> idCita;
    }

    function getFechaCita(){
        return $this -> fechaCita;
    }

    function getIdConductor(){
        return $this -> idConductor;
    }

    /**
     * Getters
     */
    function setIdCita($idCita){
        $this -> idCita = $idCita;
    }

    function setFechaCita($fechaCita){
        $this -> fechaCita = $fechaCita;
    }

    function setIdConductor($idConductor){
        $this -> idConductor = $idConductor;
    }

    /**
     * Metodos
     */

    /**
     * Insertar un nuevo Cliente
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> CitaDAO -> insertar());
        $res =  $this -> Conexion -> getLastID();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function getInfoName(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> CitaDAO -> getInfoName());
        $res = $this -> Conexion -> extraer();
        $this -> fechaCita = $res[1];
        $this -> idConductor = $res[2];
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function moreInfo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> CitaDAO -> moreInfo());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> CitaDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> CitaDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

}