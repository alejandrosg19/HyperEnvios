<?php
$idOrden = $_POST['idOrden'];
$estado = $_POST['estado'];

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");

if ($estado == 7) { #Estado Depachado
    #Creando Envio
    $conductorDesocupado = new Conductor();
    $idConductor = $conductorDesocupado->selectConductorDesocupado($fecha);
    $envio = new Envio("", $fecha, $idConductor);
    $envio->insert();

    #Creando estado En Camino en estadoConductor
    $estadoConductor = new EstadoConductor("", $fecha, 8, $idOrden, $idConductor);
    $res1 = $estadoConductor -> insert();
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
