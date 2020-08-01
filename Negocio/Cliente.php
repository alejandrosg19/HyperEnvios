<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ClienteDAO.php";

class Cliente{
    private $idCliente;
    private $nombre;
    private $correo;
    private $clave;
    private $direccion;
    private $foto;
    private $estado;
    private $codigoActivacion;
    private $ClienteDAO;
    private $Conexion;

    public function Cliente($idCliente = "", $nombre = "", $correo = "", $clave = "", $direccion = "", $foto = "", $estado = "", $codigoActivacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> direccion = $direccion;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> codigoActivacion = $codigoActivacion;
        $this -> ClienteDAO = new ClienteDAO($idCliente, $nombre, $correo, $clave, $direccion, $foto, $estado, $codigoActivacion);
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

    public function getDireccion(){
        return $this -> direccion;
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

    public function SetDireccion($direccion){
        $this -> direccion = $direccion;
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

    /**
     * Actualizar Nav información
     * Busca por el nombre, el correo y la imagen que tenga el usuario
     */

    public function getInfoNav(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> ClienteDAO -> getInfoNav());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[0];
        $this -> correo = $res[1];
        $this -> foto = $res[2];
        $this -> Conexion -> cerrar();
    }


    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

    /**
     * Buscar si un correo ya existe
     */

    public function existeCorreo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> existeCorreo());
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    /**
     * Insertar un nuevo Cliente
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que actualiza el estado de un cliente
     */
    public function updateEstado(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> updateEstado());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }


    /**
     * Obtener información básica
     */
    public function getInfoBasic(){

        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        
        $this -> nombre = $res[1];
        $this -> direccion = $res[2];
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
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> existeNuevoCorreo($correo));
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    /**
     * Actualiza la información del objeto actualizando la contraseña
     */
    public function actualizarCClave(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> actualizarCClave());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información del objeto sin actualizar la contraseña
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> actualizar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información básica del objeto sin actualizar la contraseña
     */
    public function actualizarBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> actualizarBasic());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function actualizarBasicClave(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ClienteDAO -> actualizarBasicClave());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
    
}
?>