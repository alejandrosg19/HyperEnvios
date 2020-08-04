<?php

    $precio = new Precio();
    $bool = true;
    $sumaTotal = 0;

    if (isset($_POST['pesos'])) {
        $pesos = $_POST['pesos'];
    } else {
        $pesos = array();
        $bool = false;
    }

    foreach ($pesos as $peso) {
        $data = $precio->getPrecioPeso($peso);
        if (count($data) > 0) {
            $sumaTotal += floatval($data);
        } else {
            $bool = false;
        }
    }


    $ajax = array(
        "status" => $bool,
        "data" => (($bool) ? number_format($sumaTotal, 2, ',', '.') : []),
        "msj" => (($bool) ? "La operación de ha completado correctamente" : "Ocurrió algo inesperado."),
    );

    echo json_encode($ajax);

?>