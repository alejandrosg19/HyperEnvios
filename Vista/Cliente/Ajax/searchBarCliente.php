<?php
$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$cliente = new Cliente();
$data = $cliente->filtroPaginado($str, $pagina, $cantPag);
$resultado = $cliente->filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Cliente/actualizarCliente.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>