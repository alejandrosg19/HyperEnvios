<?php 

class ConductorDAO{
    private $idConductor;
    private $nombre;
    private $correo;
    private $clave;
    private $telefono;
    private $foto;
    private $estado;

    public function ConductorDAO($idConductor = "", $nombre = "", $correo = "",  $clave = "", $telefono = "",$foto = "", $estado = ""){
        $this -> idConductor = $idConductor;
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
        return "SELECT idConductor, estado
                FROM conductor 
                WHERE email = '" . $this -> correo . "' AND clave ='" . md5($this -> clave) . "'";
    }

    public function getInfoNav(){
        return "SELECT nombre, email, foto
                FROM conductor
                WHERE idConductor = " . $this -> idConductor;
    }
    public function existeCorreo(){
        return "SELECT idConductor
                FROM Conductor
                WHERE email = '" . $this -> correo . "'";
    }
    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idConductor, nombre, email, estado 
                FROM Conductor 
                WHERE Conductor.nombre like '%". $str ."%' OR Conductor.email like '%" . $str . "%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Conductor
                WHERE Conductor.nombre like '%". $str ."%'  OR Conductor.email like '%" . $str . "%'";
    }

    public function insertar(){
        return "INSERT INTO Conductor (nombre, telefono, email, clave, foto, estado) 
                VALUES ('" . $this -> nombre ."', '" . $this -> telefono  ."','" . $this -> correo  ."', '" . md5($this -> clave)  ."', '" . $this -> foto . "' ,'" . $this -> estado  ."')";
    }
    public function updateEstado(){
        return "UPDATE Conductor
                SET
                    estado = ". $this -> estado . "
                WHERE idConductor = " . $this -> idConductor;
    }

    public function getInfoBasic(){
        return "SELECT idConductor, nombre, telefono, email, clave, foto, estado 
        FROM Conductor
        WHERE idConductor = ". $this -> idConductor;
    }
    
    public function existeNuevoCorreo($correo){
        return "SELECT idConductor
                FROM Conductor
                WHERE email = '" . $correo . "'";
    }

    public function actualizarCClave(){
        return "UPDATE Conductor
                SET
                    nombre = '" . $this -> nombre . "',
                    telefono = '" . $this -> telefono . "',
                    email = '" . $this -> correo . "',
                    estado = '" . $this -> estado . "',
                    clave = '" . $this -> clave . "'
                WHERE idConductor = ". $this -> idConductor;
    }

    public function actualizar(){
        return "UPDATE Conductor
                SET
                    nombre = '" . $this -> nombre . "',
                    telefono = '" . $this -> telefono . "',
                    email = '" . $this -> correo . "',
                    estado = '" . $this -> estado . "'
                WHERE idConductor = ". $this -> idConductor;
    }

    public function actualizarBasic(){
        return "UPDATE Conductor
                SET
                    nombre = '" . $this -> nombre . "',
                    telefono = '" . $this -> telefono . "',
                    email = '" . $this -> correo . "',
                    foto = '" . $this -> foto . "'
                WHERE idConductor = ". $this -> idConductor;
    }

    public function actualizarBasicClave(){
        return "UPDATE Conductor
                SET
                    nombre = '" . $this -> nombre . "',
                    telefono = '" . $this -> telefono . "',
                    email = '" . $this -> correo . "',
                    clave = '" . $this -> clave . "',
                    foto = '" . $this -> foto . "'
                WHERE idConductor = ". $this -> idConductor;
    }

    public function selectConductorDesocupado($fecha){
        return "SELECT idConductor 
                FROM conductor 
                WHERE idConductor NOT IN (SELECT FK_idConductor FROM envio WHERE fechaSalida = '" . $fecha . "') 
                AND idConductor NOT IN (SELECT FK_idConductor FROM cita WHERE fechaCita = '" . $fecha . "') 
                AND estado = 1;";
    }

    public function selectConductorCita($fecha){
        return "SELECT FK_idConductor, count(FK_idConductor) AS cantidad 
                FROM cita 
                INNER JOIN Conductor ON FK_idConductor = idConductor 
                WHERE FK_idConductor IN (
                    SELECT idConductor 
                    FROM conductor 
                    WHERE idConductor NOT IN (
                        SELECT FK_idConductor 
                        FROM envio 
                        WHERE fechaSalida = '" . $fecha . "'
                    ) and estado = 1
                ) and estado = 1 and fechaCita = '" . $fecha . "' 
                GROUP BY FK_idConductor
                ORDER BY cantidad;";
    }
}
?>