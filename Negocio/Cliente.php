<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ClienteDAO.php";

class Cliente{
    private $idCliente;
    private $nombre;
    private $correo;
    private $clave;
    private $foto;
    private $estado;
    private $codigoActivacion;
    private $ClienteDAO;
    private $Conexion;

    public function Cliente($idCliente = "", $nombre = "", $correo = "", $clave = "", $foto = "", $estado = "", $codigoActivacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> codigoActivacion = $codigoActivacion;
        $this -> ClienteDAO = new ClienteDAO($idCliente, $nombre, $correo, $clave, $foto, $estado, $codigoActivacion);
        $this -> Conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdCliente(){
        return $this -> idCliente;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getClave(){
        return $this -> clave;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getEstado(){
        return $this -> estado;
    }

    public function getCodigoActivacion(){
        return $this -> codigoActivacion;
    }

    /*
    *   Setters
    */
    public function setIdCliente($idCliente){
        $this -> idCliente = $idCliente;
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function setCorreo($correo){
        $this -> correo = $correo;
    }

    public function setClave($clave){
        $this -> clave = $clave;
    }

    public function setFoto($foto){
        $this -> foto = $foto;
    }

    public function setEstado($estado){
        $this -> Estado = $estado;
    }

    public function setCodigoActivacion($codigoActivacion){
        $this -> codigoActivacion = $codigoActivacion;
    }

    /* 
    *   methods
    */

    public function autenticar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> autenticar());
        if($this -> Conexion -> numFilas() == 1){
            $res = $this -> Conexion -> extraer();
            $this -> idCliente = $res[0];
            $this -> estado = $res[1];
            $this -> Conexion -> cerrar();
            return True;
        }else{
            $this -> Conexion -> cerrar();
            return False;
        }
        
    }

    
}
?>