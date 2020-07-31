<?php
$idCliente = $_POST['idCliente'];
$estado = $_POST['estado'];

$cliente = new Cliente($idCliente, "", "", "", "", "", $estado);

$res = $cliente -> updateEstado();
$ajax = array();

if ($res == 1) {
    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);
