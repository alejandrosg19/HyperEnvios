<?php
$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$accionEstado = new AccionEstado();
$data = $accionEstado->filtroPaginado($str, $pagina, $cantPag);
$resultado = $accionEstado->filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/AccionEstado/actualizarAccionEstado.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>