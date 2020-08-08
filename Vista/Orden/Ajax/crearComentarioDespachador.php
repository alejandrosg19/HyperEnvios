<?php
$idOrden = $_POST['idOrden'];
$comentario = $_POST['comentario'];
$idDespachador = $_SESSION['id'];

$estadoDes = new EstadoDespachador("", "", "", $idOrden, $idDespachador);

$res = $estadoDes->getEstadoOrden();

$ajax = array(
    "status" => false,
    "data" => [],
    "msj" => "Ocurrió algo inesperado, por favor intente más tarde"
);

if ($res) {
    $fecha = getDateTime();
    $comentarioDespachador = new ComentarioDespachador("", $fecha, $comentario, $estadoDes->getIdEstado());
    $resComentario = $comentarioDespachador->insertar();

    if ($resComentario > 0) {

        $Despachador = new Despachador($idDespachador);
        $Despachador->getInfoBasic();
        $ajax['status'] = True;
        $ajax['data'] = array(
            "nombre" => $Despachador->getNombre(),
            "comentario" => $comentario,
            "fecha" => $fecha
        );
        $ajax['msj'] = "El comentario ha sido guardado correctamente";
    }
}else{
    $ajax['msj'] = "No puedes realizar comentarios en el estado actal.";
}

echo json_encode($ajax);
