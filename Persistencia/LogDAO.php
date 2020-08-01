<?php 

class LogDAO{

    private $idLog;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $user;

    public function LogDAO($idLog = "", $fecha = "", $browser = "", $os = "", $informacion = "", $user = "", $accion = ""){
        $this -> idLog = $idLog;
        $this -> fecha = $fecha;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> informacion = $informacion;
        $this -> user = $user;
        $this -> accion = $accion;
    }
    
    public function buscarPaginado($pagina, $numReg){
        return "SELECT idLogAdministrador, Fecha, browser, os, informacion, Administrador.nombre, FK_idAccion, accion.nombre AS accion, 1 
                FROM logAdministrador 
                INNER JOIN accion ON FK_idAccion = idAccion 
                INNER JOIN Administrador ON FK_idAdministrador = idAdministrador 
                UNION ALL 
                SELECT idLogCliente, Fecha, browser, os, informacion, Cliente.nombre, FK_idAccion, accion.nombre AS accion, 2 
                FROM logCliente 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Cliente ON FK_idCliente = idCliente
                UNION ALL
                SELECT idLogConductor, Fecha, browser, os, informacion, Conductor.nombre, FK_idAccion, accion.nombre AS accion, 3 
                FROM logConductor 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Conductor ON FK_idConductor = idConductor
                UNION ALL
                SELECT idLogDespachador, Fecha, browser, os, informacion, Despachador.nombre, FK_idAccion, accion.nombre AS accion, 4 
                FROM logDespachador 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Despachador ON FK_idDespachador = idDespachador
                ORDER BY fecha desc
                LIMIT " . (($pagina - 1)*$numReg) . ", " . $numReg;
    }

    public function buscarCantidad(){
        return "SELECT count(*)
                FROM (
                    SELECT idLogAdministrador
                    FROM logAdministrador
                    UNION ALL 
                    SELECT idLogCliente
                    FROM logCliente 
                    UNION ALL
                    SELECT idLogConductor
                    FROM logConductor
                    UNION ALL
                    SELECT idLogDespachador
                    FROM logDespachador
                ) as TL";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idLogAdministrador, Fecha, browser, os, informacion, Administrador.nombre, FK_idAccion, accion.nombre AS accion, 1 
                FROM logAdministrador 
                INNER JOIN accion ON FK_idAccion = idAccion 
                INNER JOIN Administrador ON FK_idAdministrador = idAdministrador 
                WHERE Accion.nombre like '%". $str ."%' OR Administrador.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL 
                SELECT idLogCliente, Fecha, browser, os, informacion, Cliente.nombre, FK_idAccion, accion.nombre AS accion, 2 
                FROM logCliente 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Cliente ON FK_idCliente = idCliente
                WHERE Accion.nombre like '%". $str ."%' OR Cliente.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL
                SELECT idLogConductor, Fecha, browser, os, informacion, Conductor.nombre, FK_idAccion, accion.nombre AS accion, 3 
                FROM logConductor 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Conductor ON FK_idConductor = idConductor
                WHERE Accion.nombre like '%". $str ."%' OR Conductor.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL
                SELECT idLogDespachador, Fecha, browser, os, informacion, Despachador.nombre, FK_idAccion, accion.nombre AS accion, 4 
                FROM logDespachador 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Despachador ON FK_idDespachador = idDespachador
                WHERE Accion.nombre like '%". $str ."%' OR Despachador.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                ORDER BY fecha desc
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){

        return "SELECT count(*)
            FROM (
                SELECT idLogAdministrador, Fecha, browser, os, informacion, Administrador.nombre, FK_idAccion, accion.nombre AS accion, 1 
                FROM logAdministrador 
                INNER JOIN accion ON FK_idAccion = idAccion 
                INNER JOIN Administrador ON FK_idAdministrador = idAdministrador 
                WHERE Accion.nombre like '%". $str ."%' OR Administrador.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL 
                SELECT idLogCliente, Fecha, browser, os, informacion, Cliente.nombre, FK_idAccion, accion.nombre AS accion, 2 
                FROM logCliente 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Cliente ON FK_idCliente = idCliente
                WHERE Accion.nombre like '%". $str ."%' OR Cliente.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL
                SELECT idLogConductor, Fecha, browser, os, informacion, Conductor.nombre, FK_idAccion, accion.nombre AS accion, 3 
                FROM logConductor 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Conductor ON FK_idConductor = idConductor
                WHERE Accion.nombre like '%". $str ."%' OR Conductor.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL
                SELECT idLogDespachador, Fecha, browser, os, informacion, Despachador.nombre, FK_idAccion, accion.nombre AS accion, 4 
                FROM logDespachador 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Despachador ON FK_idDespachador = idDespachador
                WHERE Accion.nombre like '%". $str ."%' OR Despachador.nombre like '%" . $str . "%' OR fecha like '%" . $str . "%'
                ORDER BY fecha desc
            ) as TL";
    }
}
?>