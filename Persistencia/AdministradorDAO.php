<?php 

class AdministradorDAO{
    private $idAdministrador;
    private $nombre;
    private $correo;
    private $clave;
    private $foto;


    public function AdministradorDAO($idAdministardor = "", $nombre = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministardor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
    }

    /* 
    *   Functions
    */

    public function autenticar(){
        return "SELECT idAdministrador 
                FROM Administrador
                Where email = '" . $this -> correo . "' AND clave = '" . md5($this -> clave) . "'";
    }
    public function getInfoNav(){
        return "SELECT nombre, email, foto
                FROM administrador
                WHERE idAdministrador = " . $this -> idAdministrador;
    }
    public function existeCorreo(){
        return "SELECT idAdministrador
                FROM Administrador
                WHERE email = '" . $this -> correo . "'";
    }

}

?>