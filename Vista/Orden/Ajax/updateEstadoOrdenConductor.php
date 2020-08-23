<?php
$idOrden = $_POST['idOrden'];
$estado = $_POST['estado'];

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");


if ($estado == 3) { #Estado recogimos asignamos a orden despachador libre
    $despachador = new Despachador();
    $despachador->despachadorLibre();
    $orden = new Orden($idOrden, "", "", "", "", "", "", "", "", "", $despachador->getIdDespachador());
    $orden->asignarDespachador();
}
#Creando estado en estadoDConductor 
$estadoObj = new EstadoConductor("", $fecha, $estado, $idOrden, $_SESSION["id"]);

$res = $estadoObj->insert();

$ajax = array();
if ($res == 1) {

    if ($_SESSION['rol'] == 3) {
        /**
         * Creo el objeto de log
         */
        $logEstado = new AccionEstado($estado);
        $logEstado->getInfoBasic();
        $logConductor = new LogConductor("", getDateTime(), getBrowser(), getOS(), actualizarEstadoOrdenConductor($idOrden, $logEstado->getNombre()), $_SESSION['id'], 20);
        /**
         * Inserto el registro del log
         */
        $logConductor->insertar();
    }

    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);
