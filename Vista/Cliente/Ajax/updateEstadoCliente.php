<?php
$idCliente = $_POST['idCliente'];
$estado = $_POST['estado'];

$cliente = new Cliente($idCliente, "", "", "", "", "", $estado);

$res = $cliente -> updateEstado();
$cliente -> getInfoBasic();
$ajax = array();

if ($res == 1) {

    if ($_SESSION['rol'] == 1) {
        /**
         * Creo el objeto de log
         */
        $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarEstado("Cliente", $cliente -> getIdCliente(), $cliente -> getNombre(), $cliente -> getEstado()), $_SESSION['id'], 4);
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
