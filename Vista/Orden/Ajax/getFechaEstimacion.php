<?php 

    $fecha = $_POST['fechaR'];

    $alea = rand(5,6);
    
    $fechaEstimacion = date("Y-m-d" ,strtotime($fecha."+ ".$alea." days"));

    $ajax = array(
        "status" => true,
        "data" => $fechaEstimacion,
        "msj" => "La operación ha funcionado correctamente"
    );
    echo json_encode($ajax);

?>