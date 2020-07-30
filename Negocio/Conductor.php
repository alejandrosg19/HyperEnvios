<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ConductorDAO.php";

class Conductor{
    private $idConductor;
    private $nombre;
    private $correo;
    private $clave;
    private $telefono;
    private $foto;
    private $estado;
    private $ConductorDAO;
    private $Conexion;

    public function Conductor($idConductor = "", $nombre = "", $correo = "",  $clave = "", $telefono = "", $foto = "", $estado = ""){
        $this -> idConductor = $idConductor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> telefono = $telefono;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> ConductorDAO = new ConductorDAO($idConductor, $nombre, $correo, $clave, $telefono, $foto, $estado);
        $this -> Conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdConductor(){
        return $this -> idConductor;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getTelefono(){
        return $this -> telefono;
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

    public function setTelefono($telefono){
        $this -> telefono =  $telefono;
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


    /* 
    *   methods
    */

    /**
     * Metodo de autenticación en el sistema
     * Devuelve True si el correo y la contraseña coinciden
     * Devuelve False de lo contrario
    */

    public function autenticar(){
        $this -> Conexion -> abrir();
        echo $this -> ConductorDAO -> autenticar();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> autenticar());
        if($this -> Conexion -> numFilas() == 1){
            $res = $this -> Conexion -> extraer();
            $this -> idConductor = $res[0];
            $this -> estado = $res[1];
            $this -> Conexion -> cerrar();
            return True;
        }else{
            $this -> Conexion -> cerrar();
            return False;
        }
        
    }

    /**
     * Actualizar Nav información
     * Busca por el nombre, el correo y la imagen que tenga el usuario
     */
    public function getInfoNav(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> ConductorDAO -> getInfoNav());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[0];
        $this -> correo = $res[1];
        $this -> foto = $res[2];
        $this -> Conexion -> cerrar();
    }
    
    /**
     * Buscar si un correo ya existe
     */

    public function existeCorreo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> existeCorreo());
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

    /**
     * Insertar un nuevo Cliente
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que actualiza el estado de un cliente
     */
    public function updateEstado(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> updateEstado());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Obtener información básica
     */
    public function getInfoBasic(){

        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        
        $this -> nombre = $res[1];
        $this -> telefono = $res[2];
        $this -> correo = $res[3];
        $this -> clave = $res[4];
        $this -> foto = $res[5];
        $this -> estado = $res[6];
        
        $this -> Conexion -> cerrar();
    }

    /**
     * Busca si un correo enviado por parámetro ya existe
     */

    public function existeNuevoCorreo($correo){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> existeNuevoCorreo($correo));
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    /**
     * Actualiza la información del objeto actualizando la contraseña
     */
    public function actualizarCClave(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> actualizarCClave());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información del objeto sin actualizar la contraseña
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ConductorDAO -> actualizar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
}
?>