<?php

class OrdenDAO
{
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

    function OrdenDAO($idOrden = "", $fecha = "", $fechaEstimacion = "", $direccionDestino = "", $contacto = "", $numeroContacto = "", $fechaLlegada = "", $idCliente = "", $idCita = "", $idEnvio = "", $idDespachador = "")
    {
        $this->idOrden = $idOrden;
        $this->fecha = $fecha;
        $this->fechaEstimacion = $fechaEstimacion;
        $this->direccionDestino = $direccionDestino;
        $this->contacto = $contacto;
        $this->numeroContacto = $numeroContacto;
        $this->fechaLlegada = $fechaLlegada;
        $this->idCliente = $idCliente;
        $this->idCita = $idCita;
        $this->idEnvio = $idEnvio;
        $this->idDespachador = $idDespachador;
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
            WHERE orden.idOrden = '" . $this->idOrden . "'";
    }

    public function getLastOrdenCliente(){
        return "SELECT idOrden
                FROM orden
                WHERE FK_idCliente = " . $this -> idCliente . "
                ORDER BY idOrden desc
                LIMIT 1";
    }

    function insertar()
    {
        return "INSERT INTO Orden (fecha, fechaEstimacion, direccionDestino, contacto, numeroContacto, FK_idCliente, FK_idCita)
                VALUES ('" . $this->fecha . "','"  . $this->fechaEstimacion . "','" . $this->direccionDestino . "','" . $this->contacto . "','"  . $this->numeroContacto . "','" . $this->idCliente . "','" . $this->idCita . "')";
    }
    public function filtroPaginado($str, $pag, $cant)
    {
        return "SELECT * from (
                    SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadodespachador.FK_idAccionEstado, accionestado.idAccion as accionestado, estadodespachador.fecha as fechaEstado
                    FROM estadodespachador
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on FK_idCliente = idCliente 
                    INNER JOIN cita on orden.FK_idCita = idCita 
                    INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                    INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                    WHERE (orden.fecha like '%" . $str . "%' OR 
                    cliente.nombre like '%" . $str . "%' OR
                    orden.direccionDestino like '%" . $str . "%' OR
                    orden.contacto like '%" . $str . "%' OR
                    conductor.nombre like '%" . $str . "%' OR
                    estadodespachador.FK_idAccionEstado like '%" . $str . "%' OR
                    accionestado.nombre like '%" . $str . "%') AND estadoDespachador.FK_idDespachador = '" . $this->idDespachador . "'
                    UNION ALL(
                    SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadoconductor.FK_idAccionEstado, accionestado.idAccion as accionestado, estadoconductor.fecha as fechaEstado
                    FROM estadoconductor
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on FK_idCliente = idCliente 
                    INNER JOIN cita on orden.FK_idCita = idCita 
                    INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                    INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                    WHERE (orden.fecha like '%" . $str . "%' OR 
                    cliente.nombre like '%" . $str . "%' OR
                    orden.direccionDestino like '%" . $str . "%' OR
                    orden.contacto like '%" . $str . "%' OR
                    conductor.nombre like '%" . $str . "%' OR
                    estadoconductor.FK_idAccionEstado like '%" . $str . "%' OR
                    accionestado.nombre like '%" . $str . "%') AND estadoconductor.FK_idAccionEstado = 3
                    AND orden.FK_idDespachador = '" . $this->idDespachador . "'
                    AND orden.idOrden NOT IN(
                    	SELECT fk_idOrden 
                        FROM estadodespachador 
                    )) 
                    ORDER by(fechaEstado) DESC) as T
                GROUP BY orden
                ORDER BY orden DESC
                LIMIT " . (($pag - 1) * $cant) . ", " . $cant;
    }

    public function filtroCantidad($str)
    {
        return "SELECT COUNT(orden) FROM(
                    SELECT * from (
                        SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadodespachador.FK_idAccionEstado, accionestado.idAccion as accionestado, estadodespachador.fecha as fechaEstado
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
                        accionestado.nombre like '%" . $str . "%' AND estadoDespachador.FK_idDespachador = '".$this -> idDespachador."'
                        UNION ALL(
                        SELECT orden.idOrden as orden, orden.fecha, cliente.nombre as cliente, orden.direccionDestino, orden.contacto, conductor.nombre as conductor, estadoconductor.FK_idAccionEstado, accionestado.idAccion as accionestado, estadoconductor.fecha as fechaEstado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN cliente on FK_idCliente = idCliente 
                        INNER JOIN cita on orden.FK_idCita = idCita 
                        INNER JOIN conductor on cita.FK_idConductor = conductor.idConductor 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                        WHERE (orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        conductor.nombre like '%" . $str . "%' OR
                        estadoconductor.FK_idAccionEstado like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%') AND estadoconductor.FK_idAccionEstado = 3
                        AND orden.FK_idDespachador = '" . $this->idDespachador . "'
                        AND orden.idOrden NOT IN(
                            SELECT orden.idOrden 
                            FROM estadodespachador 
                            INNER JOIN orden ON fk_idOrden = idOrden
                        ))  
                        ORDER by(fechaEstado) DESC) AS T
                    GROUP BY orden) AS T2";
    }

    public function filtroPaginadoCliente($str, $pag, $cant)
    {
        return "SELECT * FROM (
                    SELECT * FROM (
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadodespachador
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                        WHERE FK_idCliente = '" . $this->idCliente . "'
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadocliente.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadocliente
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                        WHERE orden.FK_idCliente = '" . $this->idCliente . "'
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                        WHERE FK_idCliente = '" . $this->idCliente . "'
                        ORDER BY FK_idAccionEstado DESC
                    ) as t
                    GROUP BY orden
                ) as b
                WHERE 
                fecha like '%" . $str . "%' OR
                fechaEstimacion like '%" . $str . "%' OR
                direccionDestino like '%" . $str . "%' OR
                Contacto like '%" . $str . "%'
                ORDER BY orden desc
                LIMIT " . (($pag - 1) * $cant) . ", " . $cant;
    }

    public function filtroCantidadCliente($str)
    {
        return "SELECT count(*) FROM (
                    SELECT * FROM (
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadodespachador
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                        WHERE FK_idCliente = '" . $this->idCliente . "'
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadocliente.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadocliente
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                        WHERE orden.FK_idCliente = '" . $this->idCliente . "'
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                        WHERE FK_idCliente = '" . $this->idCliente . "'
                        ORDER BY FK_idAccionEstado DESC
                    ) as t
                    GROUP BY orden
                ) as b
                WHERE 
                fecha like '%" . $str . "%' OR
                fechaEstimacion like '%" . $str . "%' OR
                direccionDestino like '%" . $str . "%' OR
                Contacto like '%" . $str . "%'";
    }

    public function filtroPaginadoAdministrador($str, $pag, $cant)
    {
        return "SELECT * FROM (
                    SELECT * FROM (
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadodespachador
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadocliente.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadocliente
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                    ) as t
                    GROUP BY orden
                    ORDER BY FK_idAccionEstado desc
                ) as b
                WHERE 
                orden like '%" . $str . "%' OR
                fecha like '%" . $str . "%' OR
                fechaEstimacion like '%" . $str . "%' OR
                direccionDestino like '%" . $str . "%' OR
                Contacto like '%" . $str . "%' OR
                accionestado like '%".$str."%'
                ORDER BY orden desc
                LIMIT " . (($pag - 1) * $cant) . ", " . $cant;
    }

    public function filtroCantidadAdministrador($str)
    {
        return "SELECT count(*) FROM (
                    SELECT * FROM (
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadodespachador
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadocliente.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadocliente
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                        union all
                        SELECT orden.idOrden as orden, orden.fecha, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                    ) as t
                    GROUP BY orden
                    ORDER BY FK_idAccionEstado desc
                ) as b
                WHERE 
                orden like '%" . $str . "%' OR 
                fecha like '%" . $str . "%' OR
                fechaEstimacion like '%" . $str . "%' OR
                direccionDestino like '%" . $str . "%' OR
                Contacto like '%" . $str . "%' OR
                accionestado like '%".$str."%'
                ";
    }

    public function filtroPaginadoConductor1($str, $pag, $cant, $idConductor)
    {                                    
        return "SELECT * from (
                    SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadocliente.FK_idAccionEstado, accionestado.nombre as accionestado, estadocliente.fecha as fechaEstado
                    FROM estadocliente
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on orden.FK_idCliente = idCliente 
                    INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                    INNER JOIN cita on orden.FK_idCita = idCita
                    WHERE (
                        orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.fechaEstimacion like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%'
                        ) AND cita.FK_idConductor = '" . $idConductor . "'
                        AND orden.idOrden NOT IN(
                            SELECT fk_idOrden 
                            FROM estadoconductor)
                    UNION ALL(
                    SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado, estadoconductor.fecha as fechaEstado
                    FROM estadoconductor
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on orden.FK_idCliente = idCliente 
                    INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                    WHERE (
                        orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.fechaEstimacion like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%'
                    ) AND (idAccion = 2 or idAccion = 3 or idAccion = 4) AND idAccion != 8 AND idAccion != 9 AND estadoconductor.FK_idConductor = '" . $idConductor . "')
                    ORDER by(fechaEstado) DESC) as T
                GROUP BY orden
                ORDER BY orden DESC
                LIMIT " . (($pag - 1) * $cant) . ", " . $cant;
    }
    public function filtroCantidadConductor1($str,$idConductor)
    {
        return "SELECT  COUNT(orden) FROM (
                    SELECT * FROM (
                        SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadocliente.FK_idAccionEstado, accionestado.nombre as accionestado, estadocliente.fecha as fechaEstado
                        FROM estadocliente
                            INNER JOIN orden on fk_idOrden = idOrden 
                            INNER JOIN cliente on orden.FK_idCliente = idCliente 
                            INNER JOIN accionestado on estadocliente.FK_idAccionEstado = accionestado.idAccion
                            INNER JOIN cita on orden.FK_idCita = idCita
                        WHERE (
                            orden.fecha like '%" . $str . "%' OR 
                            cliente.nombre like '%" . $str . "%' OR
                            orden.fechaEstimacion like '%" . $str . "%' OR
                            orden.direccionDestino like '%" . $str . "%' OR
                            orden.contacto like '%" . $str . "%' OR
                            accionestado.nombre like '%" . $str . "%'
                            ) AND cita.FK_idConductor = '" . $idConductor . "'
                            AND orden.idOrden NOT IN(
                                SELECT fk_idOrden 
                                FROM estadoconductor)
                        UNION ALL(
                        SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado, estadoconductor.fecha as fechaEstado
                        FROM estadoconductor
                            INNER JOIN orden on fk_idOrden = idOrden 
                            INNER JOIN cliente on orden.FK_idCliente = idCliente 
                            INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion
                        WHERE (
                            orden.fecha like '%" . $str . "%' OR 
                            cliente.nombre like '%" . $str . "%' OR
                            orden.fechaEstimacion like '%" . $str . "%' OR
                            orden.direccionDestino like '%" . $str . "%' OR
                            orden.contacto like '%" . $str . "%' OR
                            accionestado.nombre like '%" . $str . "%'
                            ) AND (idAccion = 2 or idAccion = 3 or idAccion = 4) AND estadoconductor.FK_idConductor = '" . $idConductor . "')
                        ORDER by(fechaEstado) DESC) as T
                    GROUP BY orden) as t2";
    }
    public function filtroPaginadoConductor2($str, $pag, $cant, $idConductor)
    {
        return "SELECT * from (
                    SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado, estadodespachador.fecha as fechaEstado
                    FROM estadodespachador
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on orden.FK_idCliente = idCliente 
                    INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                    INNER JOIN envio on orden.FK_idEnvio = idEnvio
                    WHERE (
                        orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.fechaEstimacion like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%'
                        ) 
                        AND idAccion  = 7
                        AND envio.FK_idConductor = '" . $idConductor . "'
                    UNION ALL(
                    SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado, estadoconductor.fecha as fechaEstado
                    FROM estadoconductor
                    INNER JOIN orden on fk_idOrden = idOrden 
                    INNER JOIN cliente on orden.FK_idCliente = idCliente 
                    INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion                
                    WHERE (
                        orden.fecha like '%" . $str . "%' OR 
                        cliente.nombre like '%" . $str . "%' OR
                        orden.fechaEstimacion like '%" . $str . "%' OR
                        orden.direccionDestino like '%" . $str . "%' OR
                        orden.contacto like '%" . $str . "%' OR
                        accionestado.nombre like '%" . $str . "%'
                    ) AND (idAccion = 8 or idAccion = 9) AND estadoconductor.FK_idConductor =  '" . $idConductor . "' ) 
                    ORDER by(fechaEstado) DESC) as T
                GROUP BY orden
                ORDER BY orden DESC
                LIMIT " . (($pag - 1) * $cant) . ", " . $cant;
    }
    public function filtroCantidadConductor2($str, $idConductor)
    {
        return "SELECT COUNT(orden) FROM(
                    SELECT * from (
                        SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadodespachador.FK_idAccionEstado, accionestado.nombre as accionestado, estadodespachador.fecha as fechaEstado
                        FROM estadodespachador
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN cliente on orden.FK_idCliente = idCliente 
                        INNER JOIN accionestado on estadodespachador.FK_idAccionEstado = accionestado.idAccion
                        INNER JOIN envio on orden.FK_idEnvio = idEnvio
                        WHERE (
                            orden.fecha like '%" . $str . "%' OR 
                            cliente.nombre like '%" . $str . "%' OR
                            orden.fechaEstimacion like '%" . $str . "%' OR
                            orden.direccionDestino like '%" . $str . "%' OR
                            orden.contacto like '%" . $str . "%' OR
                            accionestado.nombre like '%" . $str . "%'
                            )
                            AND idAccion  = 7
                            AND envio.FK_idConductor = '" . $idConductor . "'
                        UNION ALL(
                        SELECT orden.idOrden as orden, orden.fecha as fecha, cliente.nombre as cliente, orden.fechaEstimacion, orden.direccionDestino, orden.contacto, estadoconductor.FK_idAccionEstado, accionestado.nombre as accionestado, estadoconductor.fecha as fechaEstado
                        FROM estadoconductor
                        INNER JOIN orden on fk_idOrden = idOrden 
                        INNER JOIN cliente on orden.FK_idCliente = idCliente 
                        INNER JOIN accionestado on estadoconductor.FK_idAccionEstado = accionestado.idAccion                        
                        WHERE (
                            orden.fecha like '%" . $str . "%' OR 
                            cliente.nombre like '%" . $str . "%' OR
                            orden.fechaEstimacion like '%" . $str . "%' OR
                            orden.direccionDestino like '%" . $str . "%' OR
                            orden.contacto like '%" . $str . "%' OR
                            accionestado.nombre like '%" . $str . "%'
                        ) AND (idAccion = 8 or idAccion = 9) AND estadoconductor.FK_idConductor =  '" . $idConductor . "') 
                        ORDER by(fechaEstado) DESC) as T
                    GROUP BY orden
                    ORDER BY orden DESC) as t2";
    }

    public function actualizarEnvio(){
        return "UPDATE orden SET FK_idEnvio = '".$this ->  idEnvio."' WHERE idOrden = '".$this -> idOrden."'";
    }

    public function actualizarFechaLlegada(){
        return "UPDATE orden SET fechaLlegada = '" . $this ->fechaLlegada . "' WHERE idOrden = '" . $this -> idOrden . "'";
    }

    public function getOrdenesEnvio(){
        return "SELECT idOrden ,fechaEstimacion, fechaLlegada, Cliente.nombre as remitente, Contacto as receptor, numeroContacto
                FROM orden
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE FK_idEnvio = " . $this -> idEnvio;
    }
    public function ventas(){
        return "SELECT count(*) FROM orden where DATE_FORMAT(NOW(), '%m/%Y') = DATE_FORMAT(fecha, '%m/%Y')
        UNION ALL
        SELECT count(*) FROM orden where DATE_FORMAT(DATE_SUB(NOW(),INTERVAL '1' MONTH), '%m/%Y') = DATE_FORMAT(fecha, '%m/%Y')";
    }
    public function ingresos(){
        return "SELECT SUM(precio) FROM item 
                INNER JOIN orden ON FK_idOrden = idOrden
                WHERE  DATE_FORMAT(NOW(), '%m/%Y') = DATE_FORMAT(fecha, '%m/%Y')
                UNION ALL
                SELECT SUM(precio) FROM item 
                INNER JOIN orden ON FK_idOrden = idOrden
                WHERE  DATE_FORMAT(DATE_SUB(NOW(),INTERVAL '1' MONTH), '%m/%Y') = DATE_FORMAT(fecha, '%m/%Y')";
    }
    public function ventasxMes(){
        return "SELECT  t.fecha, COUNT(t.fecha) FROM(
                    SELECT DATE_FORMAT(fecha, '%M/%Y') as fecha FROM orden  ORDER by fecha DESC) as t
                GROUP BY (t.fecha)
                ORDER BY (fecha)  DESC
                LIMIT 10";
    }
    public function asignarDespachador(){
        return "UPDATE orden SET FK_idDespachador = '". $this -> idDespachador ."' WHERE idOrden = '". $this -> idOrden ."'";
    }

    public function getTotalOrdenes(){
        return "SELECT count(idOrden)
                FROM orden
                WHERE FK_idCliente = " . $this -> idCliente . "
                GROUP BY FK_idCliente";
    }

    public function getFechaPrimeraOrden(){
        return "SELECT fecha
                FROM orden
                WHERE FK_idCliente = " . $this -> idCliente . "
                ORDER BY fecha ASC
                LIMIT 1";
    }

    public function getOrdenesProceso(){
        return "SELECT count(idOrden) 
                FROM Orden 
                WHERE FK_idCliente = '" . $this -> idCliente . "' AND idOrden not in (
                    SELECT FK_idOrden
                    FROM EstadoConductor
                    WHERE FK_idAccionEstado in (9)
                )";
    }

    public function ordenesDespachador(){
        return "SELECT  DATE_FORMAT(NOW(), '%M/%Y') as fecha, count(*) FROM estadodespachador WHERE DATE_FORMAT(NOW(), '%m/%Y') = DATE_FORMAT(fecha, '%m/%Y') 
                AND FK_idAccionEstado = 7 AND FK_idDespachador = '". $this -> idDespachador ."'
                UNION ALL
                SELECT DATE_FORMAT(DATE_SUB(NOW(),INTERVAL '1' MONTH), '%M/%Y') as fecha, count(*) FROM estadodespachador WHERE  DATE_FORMAT(DATE_SUB(NOW(),INTERVAL '1' MONTH), '%m/%Y') =  DATE_FORMAT(fecha, '%m/%Y')
                AND FK_idAccionEstado = 7 AND FK_idDespachador = '". $this -> idDespachador ."'
                UNION ALL
                SELECT DATE_FORMAT(DATE_SUB(NOW(),INTERVAL '2' MONTH), '%M/%Y') as fecha, count(*) FROM estadodespachador WHERE  DATE_FORMAT(DATE_SUB(NOW(),INTERVAL '2' MONTH), '%m/%Y') =  DATE_FORMAT(fecha, '%m/%Y')
                AND FK_idAccionEstado = 7 AND FK_idDespachador = '". $this -> idDespachador ."'
                ORDER BY fecha  DESC";
    }
}
