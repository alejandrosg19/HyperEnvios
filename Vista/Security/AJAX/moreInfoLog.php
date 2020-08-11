<?php

$idLog = $_GET['idLog'];
$idTable = $_GET['idTable'];

if ($idTable == 1) {

    $log = new LogAdministrador($idLog);
    $log->getInfoBasic();
    $user = new Administrador($log->getUser());
} else if ($idTable == 2) {

    $log = new LogCliente($idLog);
    $log->getInfoBasic();
    $user = new Cliente($log->getUser());
} else if ($idTable == 3) {

    $log = new LogConductor($idLog);
    $log->getInfoBasic();
    $user = new Conductor($log->getUser());
} else if ($idTable == 4) {
    $log = new LogDespachador($idLog);
    $log->getInfoBasic();
    $user = new Despachador($log->getUser());
}

$user->getInfoBasic();

$accion = new Accion($log->getAccion());
$accion->getInfoBasic();

?>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de Usuario</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="row d-flex flex-row justify-content-center mb-4">
                    <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($user->getFoto() != "") ? $user->getFoto() : "Static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                    </div>
                </div>
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Cargo</th>
                                <td> <?php echo (($log->getTipo() == 1) ? "Administrador" : (($log->getTipo() == 2) ? "Cliente" : (($log->getTipo() == 3) ? "Conductor" : "Despachador" ))) ?></td>
                            </tr>
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $user->getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $user->getCorreo() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información del Log</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="table-responsive-lg">
                    <table class="table">
                        <tbody id="tabla">
                            <tr>
                                <th> Fecha y hora</th>
                                <td> <?php echo $log->getFecha() ?></td>
                            </tr>
                            <tr>
                                <th> Acción</th>
                                <td> <?php echo $accion->getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Información</th>
                                <td>
                                    <?php

                                    if ($log->getInformacion() != "") {
                                        if($log->getAccion() ==  14){
                                            $strTables = explode("%%%", $log->getInformacion());
                                            for($j = 0; $j < count($strTables); $j++){
                                            //foreach($strTables as $strTable){
                                                $strProd = explode("&&&", $strTables[$j]);

                                                if($j == 0){
                                                    echo "<h4 class='mt-4 mb-4'> Información de la orden</h4>";
                                                }else if($j == 1){
                                                    echo "<h4 class='mt-4 mb-4'> Información de la cita</h4>";
                                                }else if($j == 2){
                                                    echo "<h4 class='mt-4 mb-4'> Información de los items</h4>";
                                                }

                                                for($a = 0; $a < count($strProd); $a++){
                                                    $itemLines = explode(";;;", $strProd[$a]);

                                                    if($j == 2){
                                                        echo "<h6 class='mt-4 mb-3'> <b>Item No ".($a+1)."</b></h6>";
                                                    }
    
                                                    echo "<table class='mt-3 mb-3' style='min-width: 70%'>";
                                                    for($i = 0 ; $i <  count($itemLines); $i++){
                                                        echo "<tr>";
                                                        $col = explode(":::", $itemLines[$i]);
                                                        foreach($col as $info){
                                                            echo "<td>".$info."</td>";
                                                        }
                                                        echo "</tr>";
                                                    }
                                                    echo "</table>";
                                                }
                                            }
                                        }else{
                                            $strList = explode("&&&", $log->getInformacion());
                                            $cantReg = count($strList);
                                            $x = 1;
                                            foreach($strList as $list){
                                                if($cantReg > 1){
                                                    if($x == 1){
                                                        echo "<h4 style='margin:20px 0px 20px 0px'>Información previa</h4>";
                                                    }else if($x == 2){
                                                        echo "<h4 style='margin:20px 0px 20px 0px'>Información actual</h4>";
                                                    }
                                                }
                                                
                                                echo "<table>";
                                                $items = explode(";;;", $list);
                                                foreach($items as $line){
                                                    echo "<tr>";
                                                    $col = explode(":::", $line);
                                                    foreach($col as $info){
                                                        echo "<td>".$info."</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                                $x++;
                                            }
                                        }
                                    }


                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th> Navegador</th>
                                <td> <?php echo $log->getBrowser() ?></td>
                            </tr>
                            <tr>
                                <th> Sistema Operativo</th>
                                <td> <?php echo $log->getOs() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>