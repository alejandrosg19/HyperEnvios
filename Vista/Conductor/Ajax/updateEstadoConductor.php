<?php
$idConductor = $_POST['idConductor'];
$estado = $_POST['estado'];

$conductor = new Conductor($idConductor, "", "", "", "", "", $estado);

$res = $conductor -> updateEstado();
$conductor -> getInfoBasic();
$ajax = array();

if ($res == 1) {

    if ($_SESSION['rol'] == 1) {
        /**
         * Creo el objeto de log
         */
        $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarEstado("Conductor", $conductor -> getIdConductor(), $conductor -> getNombre(), $conductor -> getEstado()), $_SESSION['id'], 7);
        /**
         * Inserto el registro del log
         */
        $logAdministrador -> insertar();
    }

    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);
