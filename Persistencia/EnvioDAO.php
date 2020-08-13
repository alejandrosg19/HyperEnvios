<?php

class EnvioDAO{
    private $idEnvio;
    private $fechaSalida;
    private $idConductor;

    public function EnvioDAO($idEnvio = "", $fechaSalida = "", $idConductor = ""){
        $this -> idEnvio = $idEnvio;
        $this -> fechaSalida = $fechaSalida;
        $this -> idConductor = $idConductor;
    }

    public function insert(){
        return "INSERT INTO envio(fechaSalida, FK_idConductor)
                VALUES ('" . $this -> fechaSalida . "','" . $this -> idConductor . "')";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idEnvio, Envio.fechaSalida, Orden.fechaLlegada, Orden.Contacto, Orden.direccionDestino, Conductor.nombre 
                FROM Envio
                INNER JOIN Conductor on FK_idConductor = idConductor
                INNER JOIN Orden on FK_idEnvio = idEnvio
                WHERE fechaSalida like '%". $str ."%' OR fechaLlegada like '%" . $str . "%' OR Contacto like '%" . $str . "%' OR direccionDestino like '%" . $str . "%' OR Conductor.nombre like '%" . $str . "%'
                ORDER BY fechaSalida desc
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Envio
                INNER JOIN Conductor on FK_idConductor = idConductor
                INNER JOIN Orden on FK_idEnvio = idEnvio
                WHERE fechaSalida like '%". $str ."%' OR fechaLlegada like '%" . $str . "%' OR Contacto like '%" . $str . "%' OR direccionDestino like '%" . $str . "%' OR Conductor.nombre like '%" . $str . "%'";
    }

    public function moreInfo(){
        return "SELECT idEnvio, Envio.fechaSalida, Orden.fechaEstimacion, Orden.fechaLlegada, Orden.direccionDestino, Cliente.nombre, Cliente.email, Orden.Contacto, Orden.numeroContacto,  Conductor.nombre, Conductor.email
                FROM Envio
                INNER JOIN Conductor on idConductor = FK_idConductor
                INNER JOIN Orden on FK_idEnvio = idEnvio
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE idEnvio = " . $this -> idEnvio;
    }
    
    public function getInfoFecha(){
        return "SELECT idEnvio FROM envio WHERE fechaSalida = '".$this -> fechaSalida."'";
    }
}
?>