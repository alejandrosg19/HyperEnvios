<?php
$idOrden = $_POST['idOrden'];
$comentario = $_POST['comentario'];
$idDespachador = $_SESSION['id'];

$orden = new Orden($idOrden);
$resOrden = $orden->lastEstado();
$ajax = array(
    "status" => false,
    "data" => [],
    "msj" => "Ocurrió algo inesperado, por favor intente más tarde"
);

if ($resOrden == 5 || $resOrden == 6 || $resOrden == 7) {
    $estadoDes = new EstadoDespachador("", "", "", $idOrden, $idDespachador);

    $res = $estadoDes->getEstadoOrdenNombre();

    if ($res) {
        $fecha = getDateTime();
        $comentarioDespachador = new ComentarioDespachador("", $fecha, $comentario, $estadoDes->getIdEstado());
        $resComentario = $comentarioDespachador->insertar();

        if ($resComentario > 0) {

            $Despachador = new Despachador($idDespachador);
            $Despachador->getInfoBasic();

            if ($_SESSION['rol'] == 4) {
                $logDespachador = new LogDespachador("", getDateTime(), getBrowser(), getOS(), crearComentario($idOrden, $estadoDes->getIdAccionEstado(), $fecha, $comentario), $_SESSION['id'], 16);
                /**
                 * Inserto el registro del log
                 */
                $logDespachador->insertar();
            }

            $ajax['status'] = True;
            $ajax['data'] = array(
                "nombre" => $Despachador->getNombre(),
                "comentario" => $comentario,
                "fecha" => $fecha
            );
            $ajax['msj'] = "El comentario ha sido guardado correctamente";
        }
    } else {
        $ajax['msj'] = "No puedes realizar comentarios en el estado actal.";
    }
}else{
    $ajax['msj'] = "No puedes realizar comentarios en el estado actual.";
}



echo json_encode($ajax);
