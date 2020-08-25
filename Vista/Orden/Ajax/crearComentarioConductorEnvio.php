<?php
$idOrden = $_POST['idOrden'];
$comentario = $_POST['comentario'];
$idConductor = $_SESSION['id'];

$estadoDes = new EstadoConductor("", "", "", $idOrden, $idConductor);

$res = $estadoDes->getEstadoOrdenNombre();

$ajax = array(
    "status" => false,
    "data" => [],
    "msj" => "Ocurrió algo inesperado, por favor intente más tarde"
);

if ($res) {
    $fecha = getDateTime();
    $comentarioConductor = new ComentarioConductor("", $fecha, $comentario, $estadoDes->getIdEstado());
    $resComentario = $comentarioConductor->insertar();

    if ($resComentario > 0) {

        $Conductor = new Conductor($idConductor);
        $Conductor->getInfoBasic();

        if ($_SESSION['rol'] == 3) {
            $logConductor = new LogConductor("", getDateTime(), getBrowser(), getOS(), crearComentario($idOrden, $estadoDes->getIdAccionEstado(), $fecha, $comentario), $_SESSION['id'], 17);
            /**
             * Inserto el registro del log
             */
            $logConductor -> insertar();
        }

        $ajax['status'] = True;
        $ajax['data'] = array(
            "nombre" => $Conductor->getNombre(),
            "comentario" => $comentario,
            "fecha" => $fecha
        );
        $ajax['msj'] = "El comentario ha sido guardado correctamente";
    }
}else{
    $ajax['msj'] = "No puedes realizar comentarios en el estado actual.";
}

echo json_encode($ajax);
