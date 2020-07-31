<?php
$idDespachador = $_POST['idDespachador'];
$estado = $_POST['estado'];

$despachador = new Despachador($idDespachador, "", "", "", "", "", $estado);

$res = $despachador -> updateEstado();
$ajax = array();

if ($res == 1) {
    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);