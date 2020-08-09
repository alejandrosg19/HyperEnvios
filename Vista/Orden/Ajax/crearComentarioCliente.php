<?php 
$idOrden = $_POST['idOrden'];
$comentario = $_POST['comentario'];
$idCliente = $_SESSION['id'];

$estadoCliente = new EstadoCliente("", "", "", $idOrden, $idCliente);

$res = $estadoCliente->getEstadoOrden();

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
        $Cliente -> getInfoBasic();
        $ajax['status'] = True;
        $ajax['data'] = array(
            "nombre" => $Cliente -> getNombre(),
            "comentario" => $comentario,
            "fecha" => $fecha
        );
        $ajax['msj'] = "El comentario ha sido guardado correctamente";
    }
}else{
    $ajax['msj'] = "No puedes realizar comentarios en el estado actal.";
}

echo json_encode($ajax);
?>