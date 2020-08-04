<?php 


class EstadoClienteDAO{
    private $idEstadoCliente; 
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idCliente;

    public function EstadoClienteDAO($idEstadoCliente = "", $fecha ="", $idAccionEstado="", $idOrden="", $idCliente=""){
        $this -> idEstadoCliente = $idEstadoCliente;
        $this -> fecha = $fecha;
        $this -> idAccionEstado = $idAccionEstado;
        $this -> idOrden = $idOrden;
        $this -> idCliente = $idCliente;
    }

    public function insertar(){
        return "INSERT INTO EstadoCliente (fecha, FK_idAccionEstado, FK_idOrden, FK_idCliente) 
                VALUES('" . $this -> fecha. "','" . $this -> idAccionEstado . "','" . $this -> idOrden . "','" . $this -> idCliente . "')";
    }
}

?>