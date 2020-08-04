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
    function setIdCita(){
        return $this -> idCita;
    }

    function setFechaCita(){
        return $this -> fechaCita;
    }

    function setIdConductor(){
        return $this -> idConductor;
    }

    /**
     * Getters
     */
    function getIdCita($idCita){
        $this -> idCita = $idCita;
    }

    function getFechaCita($fechaCita){
        $this -> fechaCita = $fechaCita;
    }

    function getIdConductor($idConductor){
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

}