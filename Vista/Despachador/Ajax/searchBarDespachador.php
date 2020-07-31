<?php
$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$despachador = new Despachador();
$data = $despachador -> filtroPaginado($str, $pagina, $cantPag);
$resultado = $despachador -> filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Despachador/actualizarDespachador.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>