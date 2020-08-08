<?php
$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$Orden = new Orden("","","","","","","","","","",$_SESSION["id"]);
$data = $Orden -> filtroPaginado($str, $pagina, $cantPag);
$resultado = $Orden->filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>