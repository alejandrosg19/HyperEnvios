<<<<<<< HEAD
<?php

class EstadoClienteDAO{
    private $idEstadoCliente;
=======
<?php 


class EstadoClienteDAO{
    private $idEstadoCliente; 
>>>>>>> origin/master
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idCliente;
<<<<<<< HEAD
    private $EstadoClienteDAO;
    private $Conexion;

    public function EstadoClienteDAO($idEstadoCliente = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idCliente = ""){
=======

    public function EstadoClienteDAO($idEstadoCliente = "", $fecha ="", $idAccionEstado="", $idOrden="", $idCliente=""){
>>>>>>> origin/master
        $this -> idEstadoCliente = $idEstadoCliente;
        $this -> fecha = $fecha;
        $this -> idAccionEstado = $idAccionEstado;
        $this -> idOrden = $idOrden;
        $this -> idCliente = $idCliente;
    }
<<<<<<< HEAD
}
=======

    public function insertar(){
        return "INSERT INTO EstadoCliente (fecha, FK_idAccionEstado, FK_idOrden, FK_idCliente) 
                VALUES('" . $this -> fecha. "','" . $this -> idAccionEstado . "','" . $this -> idOrden . "','" . $this -> idCliente . "')";
    }
}

>>>>>>> origin/master
?>