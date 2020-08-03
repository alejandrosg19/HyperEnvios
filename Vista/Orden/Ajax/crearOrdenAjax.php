<?php 
                        
$direccionDestino = $_POST["direccionDestino"];
$personaContacto = $_POST["personaContacto"];
$numeroContacto = $_POST["numeroContacto"];
$fechaRecoleccion = $_POST["fechaRecoleccion"];
$fechaEstimacion = $_POST["fechaEstimacion"];
$items = $_POST["items"];

$date = new DateTime();
$idCliente = $_SESSION['id'];
/**
 * ACAAAA toca   realizar una busqueda de los conductores que estan disponibles dicho dìa respecto a el envio y la cita de recoleccion
 */
$Cita = new Cita("", $fechaRecoleccion, 1);
$idCita = $Cita -> insertar();

$Orden = new Orden("", $date -> format('Y-m-d H:i:s'), $fechaEstimacion, $direccionDestino, $personaContacto, $numeroContacto, "", $idCliente, $idCita);
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
        foreach($items as $item){
            $objItem = new Item("", $item[0], $item[1], $item[2], $item[3], $item[4], $precio -> getPrecioPeso($item[3]), $idOrden);
            $objItem -> insertar();
        }
    }
}

echo true;
?>