<?php 

$precio = new Precio();

$data = $precio -> getMaxPeso();

$ajax = array(
    "status" => ((count($data) > 0)? true : false),
    "data" => $data,
    "msj" => "El peso de uno de los items excede nuestros limites de peso."
);
echo json_encode($ajax);

?>