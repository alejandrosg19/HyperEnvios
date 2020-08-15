<?php
$idOrden = $_POST['idOrden'];
$estado = $_POST['estado'];

date_default_timezone_set('America/Bogota');
$fecha1 = date("Y-m-d");
$fecha = date("Y-m-d H:i:s");

if ($estado == 7) { #Estado Depachado
    #Creando Envio
    $conductorDesocupado = new Conductor();
    $idConductor = $conductorDesocupado->selectConductorDesocupado($fecha);
    $envio = new Envio("", $fecha1, $idConductor);
    $envio->insert();
    $envio->getInfoFecha();

    #actualizando envio de orden
    $orden = new Orden($idOrden,"","","","","","","","",$envio -> getIdEnvio());
    $orden -> actualizarEnvio();
}

#Creando estado en estadoDespachador  
$estado = new EstadoDespachador("", $fecha, $estado, $idOrden, $_SESSION["id"]);

$res = $estado->insert();
#$estado -> getInfoBasic();
$ajax = array();
if ($res == 1) {

    /*if ($_SESSION['rol'] == 1) {
        /**
         * Creo el objeto de log
         *//*
        $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarEstado("Cliente", $cliente -> getIdCliente(), $cliente -> getNombre(), $cliente -> getEstado()), $_SESSION['id'], 4);
        /**
         * Inserto el registro del log
         *//*
        $logAdministrador -> insertar();
    }*/

    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);
