<?php 

    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $log = new Log();
    
    $data = $log -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $log -> filtroCantidad($str);
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "status" => ((count($data) > 0)? true : false),
        "DataT" => $data,
        "DataL" => "",
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>