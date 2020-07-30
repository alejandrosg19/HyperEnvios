
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
        $this -> Foto = $foto;
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
}

?>