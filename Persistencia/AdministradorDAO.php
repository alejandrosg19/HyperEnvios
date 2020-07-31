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
    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idAdministrador, nombre, email
                FROM Administrador 
                WHERE Administrador.nombre like '%". $str ."%' OR Administrador.email like '%" . $str . "%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Administrador
                WHERE Administrador.nombre like '%". $str ."%'  OR Administrador.email like '%" . $str . "%'";
    }

    public function insertar(){
        return "INSERT INTO Administrador (nombre, email, clave, foto) 
                VALUES ('" . $this -> nombre ."','" . $this -> correo  ."', '" . md5($this -> clave)  ."', '" . $this -> foto . "')";
    }

    public function getInfoBasic(){
        return "SELECT idAdministrador, nombre, email, clave, foto
        FROM Administrador
        WHERE idAdministrador = ". $this -> idAdministrador;
    }
    
    public function existeNuevoCorreo($correo){
        return "SELECT idAdministrador
                FROM Administrador
                WHERE email = '" . $correo . "'";
    }

    public function actualizarBasic(){
        return "UPDATE Administrador
                SET
                    nombre = '" . $this -> nombre . "',
                    email = '" . $this -> correo . "',
                    foto = '" . $this -> foto . "'
                WHERE idAdministrador = ". $this -> idAdministrador;
    }

    public function actualizarCClave(){
        return "UPDATE Administrador
                SET
                    nombre = '" . $this -> nombre . "',
                    email = '" . $this -> correo . "',
                    clave = '" . md5($this -> clave) . "',
                    foto =  '" . $this -> foto. "'
                WHERE idAdministrador = ". $this -> idAdministrador;
    }

    public function actualizar(){
        return "UPDATE Administrador
                SET
                    nombre = '" . $this -> nombre . "',
                    email = '" . $this -> correo . "',
                    foto =  '" . $this -> foto. "'
                WHERE idAdministrador = ". $this -> idAdministrador;
    }

}
