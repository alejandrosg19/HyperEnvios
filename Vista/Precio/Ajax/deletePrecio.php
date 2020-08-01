<?php

$str = $_POST['search'];
$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];
$idPrecio = $_POST["idPrecio"];

$precio = new Precio($idPrecio);
$res = $precio -> deletePrecio();

$data = $precio->filtroPaginado($str, $pagina, $cantPag);
if($data==null){
    $data = $precio->filtroPaginado($str, ($pagina-1), $cantPag);
}
$resultado = $precio->filtroCantidad($str);
$cant = $resultado / $cantPag;

$status = "";
$msj = "";

if ($res == 1) {
    $status = true;
    $msj = "El precio se ha eliminado correctamente";
} else {
    $status = false;
    $msj = "Hubo un inconveniente, por favor intente de nuevo";
}

$ajax = array();
$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Precio/actualizarPrecio.php"),
    "Cpage" => $pagina,
    "DataP" => $cant,
    "status" => $status,
    "msj" => $msj
);
echo json_encode($ajax);
