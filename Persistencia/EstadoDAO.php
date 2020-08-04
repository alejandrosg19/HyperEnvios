<?php
class EstadoDAO
{
    private $idEstado;
    private $fecha;
    private $idAccionEstado;
    private $idOrden;
    private $idActor;


    public function Estado($idEstado = "", $fecha = "", $idAccionEstado = "", $idOrden = "", $idActor = "")
    {
        $this->idEstado = $idEstado;
        $this->fecha = $fecha;
        $this->idAccionEstado = $idAccionEstado;
        $this->idOrden = $idOrden;
        $this->idActor = $idActor;
    }
    public function filtroPaginado($str, $pag, $cant)
    {
        return "SELECT * from (
                    SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado, estadodespachador.fecha as fechaEstado
                    FROM estadodespachador
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on FK_idCliente = idCliente 
                    INNER JOIN cita on orden.FK_idCita = idCita 
                    INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                    INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                    WHERE orden.fecha like '%" . $str . "%' OR 
                    cliente.nombre like '%" . $str . "%' OR
                    orden.direccionDestino like '%" . $str . "%' OR
                    orden.contacto like '%" . $str . "%' OR
                    conductor.nombre like '%" . $str . "%' OR
                    estadodespachador.FK_idAccionEstado like '%" . $str . "%' OR
                    accionestado.nombre like '%" . $str . "%'
                    UNION ALL(
                    SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado, estadoconductor.fecha as fechaEstado
                    FROM estadoconductor
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on FK_idCliente = idCliente 
                    INNER JOIN cita on orden.FK_idCita = idCita 
                    INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                    INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                    WHERE orden.fecha like '%" . $str . "%' OR 
                    cliente.nombre like '%" . $str . "%' OR
                    orden.direccionDestino like '%" . $str . "%' OR
                    orden.contacto like '%" . $str . "%' OR
                    conductor.nombre like '%" . $str . "%' OR
                    estadoconductor.FK_idAccionEstado like '%" . $str . "%' OR
                    accionestado.nombre like '%" . $str . "%') 
                    ORDER by(fechaEstado) DESC) as T
                GROUP BY orden
                LIMIT " . (($pag - 1) * $cant) . ", " . $cant;
    }

    public function filtroCantidad($str)
    {
        return "SELECT COUNT(orden) FROM(
                    SELECT * from (
                        SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado, estadodespachador.fecha as fechaEstado
                        FROM estadodespachador
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN cliente on FK_idCliente = idCliente 
                        INNER JOIN cita on orden.FK_idCita = idCita 
                        INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                        INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                        WHERE orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        conductor.nombre like '%" . $str . "%' OR
                        estadodespachador.FK_idAccionEstado like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%'
                        UNION ALL(
                        SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado, estadoconductor.fecha as fechaEstado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN cliente on FK_idCliente = idCliente 
                        INNER JOIN cita on orden.FK_idCita = idCita 
                        INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                        WHERE orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        conductor.nombre like '%" . $str . "%' OR
                        estadoconductor.FK_idAccionEstado like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%') 
                        ORDER by(fechaEstado) DESC) AS T
                    GROUP BY orden) AS T2";
    }
}
