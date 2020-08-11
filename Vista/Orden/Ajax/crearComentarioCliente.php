<?php
$idOrden = $_POST['idOrden'];
$comentario = $_POST['comentario'];
$idCliente = $_SESSION['id'];

$estadoCliente = new EstadoCliente("", "", "", $idOrden, $idCliente);

$res = $estadoCliente->getEstadoOrdenNombre();

$ajax = array(
    "status" => false,
    "data" => [],
    "msj" => "Ocurrió algo inesperado, por favor intente más tarde"
);

if ($res) {
    $fecha = getDateTime();
    $comentarioCliente = new ComentarioCliente("", $fecha, $comentario, $estadoCliente->getIdEstado());
    $resComentario = $comentarioCliente->insertar();

    if ($resComentario > 0) {

        $Cliente = new Cliente($idCliente);
        $Cliente->getInfoBasic();

        if ($_SESSION['rol'] == 2) {
            $logCliente = new LogCliente("", getDateTime(), getBrowser(), getOS(), crearComentario($idOrden, $estadoCliente->getIdAccionEstado(), $fecha, $comentario), $_SESSION['id'], 15);
            /**
             * Inserto el registro del log
             */
            $logCliente->insertar();
        }

        $ajax['status'] = True;
        $ajax['data'] = array(
            "nombre" => $Cliente->getNombre(),
            "comentario" => $comentario,
            "fecha" => $fecha
        );
        $ajax['msj'] = "El comentario ha sido guardado correctamente";
    }
} else {
    $ajax['msj'] = "No puedes realizar comentarios en el estado actal.";
}

echo json_encode($ajax);
