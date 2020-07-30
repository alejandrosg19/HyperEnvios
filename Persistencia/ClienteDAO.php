<?php 

class ClienteDAO{
    private $idCliente;
    private $nombre;
    private $correo;
    private $clave;
    private $foto;
    private $estado;
    private $codigoActivacion;

    public function ClienteDAO($idCliente = "", $nombre = "", $correo = "", $clave = "", $foto = "", $estado = "", $codigoActivacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> codigoActivacion = $codigoActivacion;
    }

    public function autenticar(){
        return "SELECT idCliente, estado
                FROM cliente 
                WHERE email = '" . $this -> correo . "' AND clave ='" . md5($this -> clave) . "'";
    }

}
