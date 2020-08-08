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
    public function getEstados()
    {
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
                )";
    }

}
