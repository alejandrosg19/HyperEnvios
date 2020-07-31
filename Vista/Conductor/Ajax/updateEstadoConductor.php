<?php
$idConductor = $_POST['idConductor'];
$estado = $_POST['estado'];

$conductor = new Conductor($idConductor, "", "", "", "", "", $estado);

$res = $conductor -> updateEstado();
$ajax = array();

if ($res == 1) {
    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);
