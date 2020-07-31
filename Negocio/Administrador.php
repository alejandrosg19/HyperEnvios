
<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/AdministradorDAO.php";

class Administrador{
    private $idAdministrador;
    private $nombre;
    private $correo;
    private $clave;
    private $foto;
    private $AdministradorDAO;
    private $Conexion;

    public function Administrador($idAdministardor = "", $nombre = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministardor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> AdministradorDAO = new AdministradorDAO($idAdministardor, $nombre, $correo, $clave, $foto);
        $this -> Conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdAdministrador(){
        return $this -> idAdministrador;
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

    /*
    *   Setters
    */
    public function setIdAdministrador($idAdministardor){
        $this -> idAdministrador = $idAdministardor;
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

    /* 
    *   Functions
    */

    public function autenticar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> autenticar());

        if($this -> Conexion -> numFilas() == 1){
            $res = $this -> Conexion -> extraer();
            $this -> idAdministrador = $res[0];
            $res = $this -> Conexion -> cerrar();
            return True;
        }else{
            $res = $this -> Conexion -> cerrar();
            return False;
        }
    }
    /**
     * Actualizar Nav información
     * Busca por el nombre, el correo y la imagen que tenga el usuario
     */

    public function getInfoNav(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> AdministradorDAO -> getInfoNav());
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
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> existeCorreo());
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

    /**
     * Insertar un nuevo Administrador
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }


    /**
     * Obtener información básica
     */
    public function getInfoBasic(){

        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        
        $this -> nombre = $res[1];
        $this -> correo = $res[2];
        $this -> clave = $res[3];
        $this -> foto = $res[4];
        
        $this -> Conexion -> cerrar();
    }

    /**
     * Busca si un correo enviado por parámetro ya existe
     */

    public function existeNuevoCorreo($correo){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> existeNuevoCorreo($correo));
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    /**
     * Actualiza la información del objeto actualizando la contraseña
     */
    public function actualizarCClave(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> actualizarCClave());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información del objeto sin actualizar la contraseña
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> AdministradorDAO -> actualizar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }
}

?>