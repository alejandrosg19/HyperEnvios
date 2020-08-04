<?php

class OrdenDAO{
    private $idOrden;
    private $fecha;
    private $fechaEstimacion;
    private $direccionDestino;
    private $contacto; #Nombre de la persona a quien le llega el pedido
    private $numeroContacto;
    private $fechaLlegada;
    private $idCliente;
    private $idCita;
    private $idEnvio;
    private $idDespachador;
    private $OrdenDAO;
    private $Conexion;

    function OrdenDAO($idOrden = "", $fecha = "", $fechaEstimacion = "", $direccionDestino = "", $contacto = "", $numeroContacto = "", $fechaLlegada = "", $idCliente = "", $idCita = "", $idEnvio = "", $idDespachador = ""){
        $this -> idOrden = $idOrden;
        $this -> fecha = $fecha;
        $this -> fechaEstimacion = $fechaEstimacion;
        $this -> direccionDestino = $direccionDestino;
        $this -> contacto = $contacto;
        $this -> numeroContacto = $numeroContacto;
        $this -> fechaLlegada = $fechaLlegada;
        $this -> idCliente = $idCliente;
        $this -> idCita = $idCita;
        $this -> idEnvio = $idEnvio;
        $this -> idDespachador = $idDespachador;
    }
    public function getInfoOrden()
    {
        return "SELECT 
            orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, orden.numeroContacto, orden.fechaLlegada,
            item.referencia, item.nombre, item.descripcion, item.peso, item.fabricante, item.precio,
            cliente.nombre, cliente.email, 
            conductor.nombre, conductor.email,conductor.telefono
            FROM item 
            INNER JOIN orden ON fk_idOrden = idOrden
            INNER JOIN cliente ON fk_idCliente = idCliente
            INNER JOIN cita ON orden.FK_idCita = idCita
            INNER JOIN conductor ON FK_idConductor = idConductor
            WHERE orden.idOrden = '" . $this -> idOrden ."'";
    }

    function insertar(){
        return "INSERT INTO Orden (fecha, fechaEstimacion, direccionDestino, contacto, numeroContacto, FK_idCliente, FK_idCita)
                VALUES ('" . $this -> fecha . "','"  . $this -> fechaEstimacion . "','" . $this -> direccionDestino . "','" . $this -> contacto . "','"  . $this -> numeroContacto . "','" . $this -> idCliente . "','" . $this -> idCita . "')";
    }
}
?>