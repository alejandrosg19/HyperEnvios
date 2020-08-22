<?php 

    $peso = $_POST['peso'];

    $precio = new Precio();

    $data = $precio -> getPrecioPeso($peso);

    $ajax = array(
        "status" => (($data != null)? true : false),
        "data" => $data,
        "msj" => (($data != null)? "La operación ha funcionado correctamente" : "Lo sentimos el peso introducido excede nuestros limites."),
    );
    echo json_encode($ajax);

?>