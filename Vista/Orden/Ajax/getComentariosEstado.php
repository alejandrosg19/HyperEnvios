<?php 
$idOrden = $_POST['idOrden'];
$estados = $_POST['estados'];
$estado = new Estado("","","",$idOrden);

#echo "eyyyyyy ". $estados;
#$res = $estado -> getEstadosAllOrden("3,5,6,7");
$res = $estado -> getEstadosAllOrden($estados);

$ajax = array(
    "status" => false,
    "data" => [],
    "msj" => "Ocurrió algo inesperado, por favor intente más tarde"
);

if($res){
    if($res[2] == 1){
        $comentario = new ComentarioDespachador("","","",$res[0]);
    }else if($res[2] == 2){
        $comentario = new ComentarioConductor("","","",$res[0]);
    }else if($res[2] == 3){
        $comentario = new ComentarioCliente("","","", $res[0]);
    }
    $resComentarios = $comentario -> getComentariosActor();
    if($resComentarios){
        $ajax['status'] = true;
        $ajax ['data'] = $resComentarios;
        $ajax['msj'] = "La consulta se ha realizado correctamente";
    }
}

echo json_encode($ajax);

?>