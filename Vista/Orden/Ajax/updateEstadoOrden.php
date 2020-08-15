<?php
$idOrden = $_POST['idOrden'];
$estado = $_POST['estado'];

date_default_timezone_set('America/Bogota');
$fecha1 = date("Y-m-d");
$fecha = date("Y-m-d H:i:s");

if ($estado == 7) { #Estado Depachado

    #Buscar el envío que aun no tenga 5
    $searchEnvios = new Envio();
    if($searchEnvios -> getEnvioDesocupado() > 0){
        # Obtengo el id del envio que tiene menos de 5 ordenes por repartir
        $envio = new Envio($searchEnvios -> getIdEnvio());
        $envio -> getInfoBasic(); 
        $idEnvio = $envio -> getIdEnvio();
        $idConductor = $envio -> getIdConductor();
    }else{
        #Creando Envio
        $conductorDesocupado = new Conductor();
        $idConductor = $conductorDesocupado->selectConductorDesocupado($fecha);
        $envio = new Envio("", $fecha1, $idConductor);
        $idEnvio = $envio->insert();
    }
    

    #actualizando envio de orden
    $orden = new Orden($idOrden,"","","","","","","","",$idEnvio);
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
