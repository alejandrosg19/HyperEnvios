<?php
class EstadoDAO
{
    private $idEstado;
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idActor;


    public function EstadoDAO($idEstado = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idActor = "")
    {
        $this->idEstado = $idEstado;
        $this->fecha = $fecha;
        $this->idAccionEstado = $idAccionEstado;
        $this->idOrden = $idOrden;
        $this->idActor = $idActor;
    }
    /*public function getEstados(){
        return "SELECT 	accionestado.nombre, estadodespachador.fecha as fechaEstado, 1, despachador.nombre, idEstadoDespachador
                FROM estadodespachador
                INNER JOIN despachador ON FK_idDespachador = idDespachador
                INNER JOIN accionestado ON estadodespachador.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                UNION ALL(
                SELECT 	accionestado.nombre, estadoconductor.fecha as fechaEstado, 2, conductor.nombre, idEstadoConductor
                FROM estadoconductor
                INNER JOIN conductor ON FK_idConductor = idConductor
                INNER JOIN accionestado ON estadoconductor.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                ) ORDER BY fechaEstado DESC";
    }*/

    public function getEstados(){
        return "SELECT 	accionestado.nombre, estadodespachador.fecha as fechaEstado, 1, despachador.nombre, idEstadoDespachador, accionestado.idAccion
                FROM estadodespachador
                INNER JOIN despachador ON FK_idDespachador = idDespachador
                INNER JOIN accionestado ON estadodespachador.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                UNION ALL
                SELECT 	accionestado.nombre, estadoconductor.fecha as fechaEstado, 2, conductor.nombre, idEstadoConductor, accionestado.idAccion
                FROM estadoconductor
                INNER JOIN conductor ON FK_idConductor = idConductor
                INNER JOIN accionestado ON estadoconductor.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                UNION ALL
                SELECT 	accionestado.nombre, estadoCliente.fecha as fechaEstado, 3, cliente.nombre, idEstadoCliente, accionestado.idAccion
                FROM estadoCliente
                INNER JOIN cliente ON FK_idCliente = idCliente
                INNER JOIN accionestado ON estadoCliente.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                ORDER BY fechaEstado DESC";
    }

    public function getEstadosAsc(){
        return "SELECT 	accionestado.nombre, estadodespachador.fecha as fechaEstado, 1, despachador.nombre, idEstadoDespachador, accionestado.idAccion
                FROM estadodespachador
                INNER JOIN despachador ON FK_idDespachador = idDespachador
                INNER JOIN accionestado ON estadodespachador.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                UNION ALL
                SELECT 	accionestado.nombre, estadoconductor.fecha as fechaEstado, 2, conductor.nombre, idEstadoConductor, accionestado.idAccion
                FROM estadoconductor
                INNER JOIN conductor ON FK_idConductor = idConductor
                INNER JOIN accionestado ON estadoconductor.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                UNION ALL
                SELECT 	accionestado.nombre, estadoCliente.fecha as fechaEstado, 3, cliente.nombre, idEstadoCliente, accionestado.idAccion
                FROM estadoCliente
                INNER JOIN cliente ON FK_idCliente = idCliente
                INNER JOIN accionestado ON estadoCliente.fk_idAccionEstado = idAccion
                INNER JOIN orden ON FK_idOrden = idOrden 
                WHERE orden.idOrden = '" . $this->idOrden . "'
                ORDER BY fechaEstado ASC";
    }

    public function getLastEstado(){
        return "SELECT idAccion FROM 
                (   SELECT 	accionestado.idAccion
                    FROM estadodespachador
                    INNER JOIN despachador ON FK_idDespachador = idDespachador
                    INNER JOIN accionestado ON estadodespachador.fk_idAccionEstado = idAccion
                    INNER JOIN orden ON FK_idOrden = idOrden 
                    WHERE orden.idOrden = '" . $this->idOrden . "'
                    UNION ALL
                    SELECT 	accionestado.idAccion
                    FROM estadoconductor
                    INNER JOIN conductor ON FK_idConductor = idConductor
                    INNER JOIN accionestado ON estadoconductor.fk_idAccionEstado = idAccion
                    INNER JOIN orden ON FK_idOrden = idOrden 
                    WHERE orden.idOrden = '" . $this->idOrden . "'
                    UNION ALL
                    SELECT 	accionestado.idAccion
                    FROM estadoCliente
                    INNER JOIN cliente ON FK_idCliente = idCliente
                    INNER JOIN accionestado ON estadoCliente.fk_idAccionEstado = idAccion
                    INNER JOIN orden ON FK_idOrden = idOrden 
                    WHERE orden.idOrden = '" . $this->idOrden . "'
                    ORDER BY fechaEstado DESC
                ) as T
                ORDER BY idAccion Desc";
    }

    public function getEstadosAllOrden($strEstados){
        return "SELECT * from (
                        SELECT idEstadoDespachador as idEstado, FK_idAccionEstado, 1 as actor
                            FROM estadodespachador
                            INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                            WHERE FK_idOrden = '" . $this -> idOrden . "'
                            UNION ALL
                            SELECT idEstadoConductor as idEstado, FK_idAccionEstado, 2 as actor
                            FROM estadoconductor
                            INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                            WHERE FK_idOrden = '" . $this -> idOrden . "'
                            UNION ALL
                            SELECT idEstadoCliente as idEstado, FK_idAccionEstado, 3 as actor
                            FROM estadocliente
                            INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                            WHERE FK_idOrden = '" . $this -> idOrden . "'
                ) as T
                WHERE FK_idAccionEstado in (" . $strEstados . ")
                ORDER BY FK_idAccionEstado desc
                LIMIT 1";
    }

    public function ordenesEstados(){
        return "SELECT t2.estado, COUNT(t2.estado) FROM(
                    SELECT * FROM(
                        SELECT 	orden.idOrden as orden, accionestado.idAccion as idestado, accionestado.nombre as estado, estadodespachador.fecha as fechaEstado
                            FROM estadodespachador
                            INNER JOIN despachador ON FK_idDespachador = idDespachador
                            INNER JOIN accionestado ON estadodespachador.fk_idAccionEstado = idAccion
                            INNER JOIN orden ON FK_idOrden = idOrden 
                            UNION ALL
                            SELECT 	orden.idOrden as orden, accionestado.idAccion as idestado, accionestado.nombre as estado, estadoconductor.fecha as fechaEstado
                            FROM estadoconductor
                            INNER JOIN conductor ON FK_idConductor = idConductor
                            INNER JOIN accionestado ON estadoconductor.fk_idAccionEstado = idAccion
                            INNER JOIN orden ON FK_idOrden = idOrden 
                            UNION ALL
                            SELECT 	orden.idOrden as orden, accionestado.idAccion as idestado, accionestado.nombre as estado, estadoCliente.fecha as fechaEstado
                            FROM estadoCliente
                            INNER JOIN cliente ON FK_idCliente = idCliente
                            INNER JOIN accionestado ON estadoCliente.fk_idAccionEstado = idAccion
                            INNER JOIN orden ON FK_idOrden = idOrden 
                            ORDER BY fechaEstado DESC) as t
                        GROUP BY(t.orden)) as t2
                    GROUP BY(t2.estado)  
                ORDER BY (t2.idestado) ASC";
    }

}
