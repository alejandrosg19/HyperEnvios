<?php 

class DespachadorDAO{
    private $idDespachador;
    private $nombre;
    private $correo;
    private $clave;
    private $telefono;
    private $foto;
    private $estado;

    public function DespachadorDAO($idDespachador = "", $nombre = "", $correo = "", $clave = "" , $telefono = "", $foto = "", $estado = ""){
        $this -> idDespachador = $idDespachador;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> telefono = $telefono;
        $this -> foto = $foto;
        $this -> estado = $estado;
    }

    /* 
    *   methods
    */

    public function autenticar(){
        return "SELECT idDespachador, estado
                FROM despachador 
                WHERE email = '" . $this -> correo . "' AND clave ='" . md5($this -> clave) . "'";
    }
    public function getInfoNav(){
        return "SELECT nombre, email, foto
                FROM despachador
                WHERE idDespchador = " . $this -> idDespachador;
    }
    public function existeCorreo(){
        return "SELECT idCliente
                FROM Cliente
                WHERE email = '" . $this -> correo . "'";
    }
    
}
?>