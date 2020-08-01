<?php
$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$precio = new Precio();
$data = $precio->filtroPaginado($str, $pagina, $cantPag);
$resultado = $precio->filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Precio/actualizarPrecio.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>