<?php 

class ClienteDAO{
    private $idCliente;
    private $nombre;
    private $correo;
    private $clave;
    private $direccion;
    private $foto;
    private $estado;
    private $codigoActivacion;

    public function ClienteDAO($idCliente = "", $nombre = "", $correo = "", $clave = "", $direccion = "", $foto = "", $estado = "", $codigoActivacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> direccion = $direccion;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> codigoActivacion = $codigoActivacion;
    }

    public function autenticar(){
        return "SELECT idCliente, estado
                FROM cliente 
                WHERE email = '" . $this -> correo . "' AND clave ='" . md5($this -> clave) . "'";
    }
    public function getInfoNav(){
        return "SELECT nombre, email, foto
                FROM cliente
                WHERE idCliente = " . $this -> idCliente;
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idCliente, nombre, email, estado 
                FROM Cliente 
                WHERE Cliente.nombre like '%". $str ."%' OR Cliente.email like '%" . $str . "%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Cliente
                WHERE Cliente.nombre like '%". $str ."%'  OR Cliente.email like '%" . $str . "%'";
    }

    public function existeCorreo(){
        return "SELECT idCliente
                FROM Cliente
                WHERE email = '" . $this -> correo . "'";
    }

    public function insertar(){
        return "INSERT INTO Cliente (nombre, direccion, email, clave, foto, estado) 
                VALUES ('" . $this -> nombre ."', '" . $this -> direccion  ."','" . $this -> correo  ."', '" . md5($this -> clave)  ."', '" . $this -> foto . "' ,'" . $this -> estado  ."')";
    }
    
    public function updateEstado(){
        return "UPDATE Cliente
                SET
                    estado = ". $this -> estado . "
                WHERE idCliente = " . $this -> idCliente;
    }

    public function getInfoBasic(){
        return "SELECT idCliente, nombre, direccion, email, clave, foto, estado 
        FROM Cliente 
        WHERE idCliente = ". $this -> idCliente;
    }
    
    public function existeNuevoCorreo($correo){
        return "SELECT idCliente
                FROM Cliente
                WHERE email = '" . $correo . "'";
    }

    public function actualizarCClave(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    direccion = '" . $this -> direccion . "',
                    email = '" . $this -> correo . "',
                    estado = '" . $this -> estado . "',
                    clave = '" . $this -> clave . "'
                WHERE idCliente = ". $this -> idCliente;
    }

    public function actualizar(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    direccion = '" . $this -> direccion . "',
                    email = '" . $this -> correo . "',
                    estado = '" . $this -> estado . "'
                WHERE idCliente = ". $this -> idCliente;
    }

    public function actualizarBasic(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    direccion = '" . $this -> direccion . "',
                    email = '" . $this -> correo . "',
                    foto = '" . $this -> foto . "'
                WHERE idCliente = ". $this -> idCliente;
    }

    public function actualizarBasicClave(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    direccion = '" . $this -> direccion . "',
                    email = '" . $this -> correo . "',
                    clave = '" . $this -> clave . "',
                    foto = '" . $this -> foto . "'
                WHERE idCliente = ". $this -> idCliente;
    }
}
