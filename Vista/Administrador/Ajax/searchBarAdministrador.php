<?php
$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$administrador = new Administrador();
$data = $administrador -> filtroPaginado($str, $pagina, $cantPag);
$resultado = $administrador -> filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Administrador/actualizarAdministrador.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>