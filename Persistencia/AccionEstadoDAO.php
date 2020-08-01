<?php

class AccionEstadoDAO{
    private $idAccion;
    private $nombre;
    private $descripcion;

    function AccionEstadoDAO($idAccion = "", $nombre = "", $descripcion = ""){
        $this -> idAccion = $idAccion;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
    }

    function existeAccion(){
        return "SELECT * 
                FROM accionEstado
                WHERE 
                    nombre = '" . $this -> nombre . "'";
    }
    function insertar(){
        return "INSERT INTO accionEstado (nombre, descripcion)
                VALUES ('" . $this -> nombre . "','" . $this -> descripcion . "')";
    }
    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idAccion, nombre, descripcion
                FROM accionEstado
                WHERE accionEstado.nombre like '%". $str ."%' OR accionEstado.descripcion like '%" . $str . "%' 
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM accionEstado
                WHERE accionEstado.nombre like '%". $str ."%' OR accionEstado.descripcion like '%" . $str . "%'";
    }
    public function getInfoBasic(){
        return "SELECT idAccion, nombre, descripcion
        FROM accionEstado
        WHERE idAccion = ". $this -> idAccion;
    }
    public function actualizar(){
        return "UPDATE accionEstado
                SET
                    nombre = '" . $this -> nombre . "',
                    descripcion = '" . $this -> descripcion . "'
                WHERE idAccion = ". $this -> idAccion;
    }
}
