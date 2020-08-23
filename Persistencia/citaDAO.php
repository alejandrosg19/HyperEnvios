<?php 

class CitaDAO{
    private $idCita;
    private $fechaCita;
    private $idConductor;

    public function CitaDAO($idCita = "", $fechaCita = "", $idConductor=""){
        $this -> idCita = $idCita;
        $this -> fechaCita = $fechaCita;
        $this -> idConductor = $idConductor;
    }

    public function insertar(){
        return "INSERT INTO Cita (fechaCita, FK_idConductor) 
                VALUES ('" . $this -> fechaCita ."', '" . $this -> idConductor  ."')";
    }

    public function getInfoName(){
        return "SELECT idCita, fechaCita, nombre
                FROM cita
                INNER JOIN Conductor on FK_idConductor = idConductor
                WHERE idCita = " . $this -> idCita;
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idCita, Cliente.nombre, direccion, fechaCita, Conductor.nombre 
                FROM Cita
                INNER JOIN Conductor on FK_idConductor = idConductor
                INNER JOIN Orden on FK_idCita = idCita
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE Cliente.nombre like '%". $str ."%' OR Conductor.nombre like '%" . $str . "%' OR fechaCita like '%" . $str . "%' OR direccion like '%" . $str . "%'
                ORDER BY fechaCita desc
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Cita
                INNER JOIN Conductor on FK_idConductor = idConductor
                INNER JOIN Orden on FK_idCita = idCita
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE Cliente.nombre like '%". $str ."%' OR Conductor.nombre like '%" . $str . "%' OR fechaCita like '%" . $str . "%' OR direccion like '%" . $str . "%'";
    }
    
    public function moreInfo(){
        return "SELECT Cliente.nombre, Cliente.email, Cliente.direccion, Conductor.nombre, Conductor.email, idCita, fechaCita
                FROM Cita
                INNER JOIN Conductor on idConductor = FK_idConductor
                INNER JOIN Orden on FK_idCita = idCita
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE idCita = " . $this -> idCita;
    }

    public function getOrdenesXRecoger(){
        return "SELECT count(idOrden) 
                FROM Orden 
                INNER JOIN Cita on FK_idCita = idCita 
                WHERE FK_idConductor = '" . $this -> idConductor . "' AND idOrden not in (
                    SELECT FK_idOrden
                    FROM estadoConductor
                    WHERE FK_idAccionEstado = '3'
                )";
    }

    public function getOrdenesRecogidas(){
        return "SELECT count(idOrden) 
                FROM Orden 
                INNER JOIN cita on FK_idCita = idCita
                WHERE FK_idConductor = '" . $this -> idConductor . "' and idOrden in ( 
                    SELECT FK_idOrden 
                    FROM estadoConductor
                    WHERE FK_idAccionEstado in (3) AND DATE_FORMAT(NOW(), '%m/%Y') = DATE_FORMAT(fecha, '%m/%Y')
                )";
    }

}