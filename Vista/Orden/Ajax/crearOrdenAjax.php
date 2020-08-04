<?php 
                        
$direccionDestino = $_POST["direccionDestino"];
$personaContacto = $_POST["personaContacto"];
$numeroContacto = $_POST["numeroContacto"];
$fechaRecoleccion = $_POST["fechaRecoleccion"];
$fechaEstimacion = $_POST["fechaEstimacion"];
$items = $_POST["items"];
$idCliente = $_SESSION['id'];


$ajax = array(
    "status" => false,
    "data" => [],
    "msj" => "Ocurrió algo inesperado, por favor intente más tarde"
);


$conductor = new Conductor();

$idConductor = $conductor -> selectConductorDesocupado($fechaRecoleccion);

if($idConductor <= 0){
    $idConductor = $conductor -> selectConductorCita($fechaRecoleccion);
}


$Cita = new Cita("", $fechaRecoleccion, $idConductor);
$idCita = $Cita -> insertar();

$Orden = new Orden("", getDateTime(), $fechaEstimacion, $direccionDestino, $personaContacto, $numeroContacto, "", $idCliente, $idCita);
$idOrden = $Orden -> insertar();


if($idOrden > 0){
    $precio = new Precio();
    $bool = true;
    foreach($items as $item){
        $resPrecio = $precio -> getPrecioPeso($item[3]);
        if(!(count($resPrecio) > 0)){
            $bool = false;
        }
    }

    if($bool){
        $boolItem = true;
        foreach($items as $item){
            $objItem = new Item("", $item[0], $item[1], $item[2], $item[3], $item[4], $precio -> getPrecioPeso($item[3]), $idOrden);
            $resItem = $objItem -> insertar();
            if($resItem == 0){
                $boolItem = false;
            }
        }

        if($boolItem){
            $objEstadoCliente = new EstadoCliente("", getDateTime(), 1, $idOrden, $idCliente);
            $resEstado = $objEstadoCliente -> insertar();

            if($resEstado > 0){
                $ajax['status'] = true; 
                $ajax['msj'] = "Orden creada satisfactoriamente.";
            }
        }
    }
}
echo json_encode($ajax);

?>