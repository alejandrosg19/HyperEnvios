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
$date = getDateTime();
$Orden = new Orden("", $date, $fechaEstimacion, $direccionDestino, $personaContacto, $numeroContacto, "", $idCliente, $idCita);
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

                if ($_SESSION['rol'] == 2) {
                    /**
                     * Busco toda la información de la cita
                     */
                    $citaInfo = new Cita($idCita);
                    $citaInfo -> getInfoName();
                    /**
                     * Busco toda la información de los items con un idOrden especifico
                     */
                    $ItemLog =  new Item("", "", "", "", "", "", "", $idOrden);
                    $resItem = $ItemLog -> getInfoBasic();
                    /**
                     * Creo el objeto de log
                     */
                    
                    $logCliente = new LogCliente("", getDateTime(), getBrowser(), getOS(), crearOrden($date, $fechaEstimacion, $direccionDestino, $personaContacto, $numeroContacto, $citaInfo -> getIdCita(), $citaInfo -> getFechaCita(), $citaInfo -> getIdConductor(), $resItem), $_SESSION['id'], 14);
                    /**
                     * Inserto el registro del log
                     */
                    $logCliente -> insertar();
                }

                $ajax['status'] = true; 
                $ajax['msj'] = "Orden creada satisfactoriamente.";
            }
        }
    }
}
echo json_encode($ajax);

?>