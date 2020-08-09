<?php
$idOrden = $_POST['idOrden'];
$estado = $_POST['estado'];

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");

$estado = new EstadoDespachador("", $fecha, $estado, $idOrden, $_SESSION["id"]);

$res = $estado -> insert();
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