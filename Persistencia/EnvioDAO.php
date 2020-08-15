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
        return "SELECT idEnvio, fechaSalida, contador, nombre
                FROM(
                    Select Envio.idEnvio, Envio.fechaSalida, count(idEnvio) as contador, Conductor.nombre
                    FROM envio
                    INNER JOIN Orden on FK_idEnvio = idEnvio
                    INNER JOIN Conductor on FK_idConductor = idConductor
                    GROUP BY idEnvio
                    ORDER BY Envio.fechaSalida desc
                ) as T
                WHERE idEnvio like '%" . $str . "%' OR fechaSalida like '%" . $str . "%' OR contador like '%" . $str . "%' OR nombre like '%" . $str . "%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*)
            FROM(
                Select Envio.idEnvio, Envio.fechaSalida, count(idEnvio) as contador, Conductor.nombre
                FROM envio
                INNER JOIN Orden on FK_idEnvio = idEnvio
                INNER JOIN Conductor on FK_idConductor = idConductor
                GROUP BY idEnvio
                ORDER BY Envio.fechaSalida desc
            ) as T
            WHERE idEnvio like '%" . $str . "%' OR fechaSalida like '%" . $str . "%' OR contador like '%" . $str . "%' OR nombre like '%" . $str . "%'";
    }

    public function moreInfo(){
        return "SELECT Envio.idEnvio, Envio.fechaSalida, Conductor.nombre
                FROM envio
                INNER JOIN Conductor on FK_idConductor = idConductor 
                WHERE idEnvio = '" . $this -> idEnvio . "'
                ORDER BY Envio.fechaSalida DESC";
    }

    public function getInfoFecha(){
        return "SELECT idEnvio FROM envio WHERE fechaSalida = '".$this -> fechaSalida."'";
    }

    public function getEnvioDesocupado(){
        return "SELECT idEnvio
                FROM (
                    SELECT idEnvio, count(idEnvio) as conteo
                    FROM Envio
                    INNER JOIN Orden on FK_idEnvio = idEnvio
                    Group by idEnvio
                ) as t
                WHERE conteo < 5
                LIMIT 1";
    }

    public function getInfoBasic(){
        return "SELECT idEnvio, fechaSalida, FK_idConductor
                FROM envio 
                WHERE idEnvio = " . $this -> idEnvio;
    }

}
?>