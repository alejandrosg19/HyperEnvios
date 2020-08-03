<?php 

    $peso = $_POST['peso'];

    $precio = new Precio();

    $data = $precio -> getPrecioPeso($peso);

    $ajax = array(
        "status" => ((count($data) > 0)? true : false),
        "data" => $data,
        "msj" => ((count($data) > 0)? "La operación ha funcionado correctamente" : "Lo sentimos el peso introducido excede nuestros limites."),
    );
    echo json_encode($ajax);

?>