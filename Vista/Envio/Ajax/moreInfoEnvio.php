<?php

$idEnvio = $_GET['idEnvio'];

$envio = new Envio($idEnvio);

$res = $envio->moreInfo();

$ordenes = new Orden("", "", "", "", "", "", "", "", "", $idEnvio);

$resOrdenes = $ordenes->getOrdenesEnvio();

?>
<div class="row">

    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información del envío</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Numero de envío</th>
                                <td> <?php echo $res[0] ?></td>
                            </tr>
                            <tr>
                                <th> Fecha de envío</th>
                                <td> <?php echo $res[1] ?></td>
                            </tr>
                            <tr>
                                <th> Conductor</th>
                                <td> <?php echo $res[2] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        
        <?php
        for ($i = 0; $i < count($resOrdenes); $i++) {
        ?>
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <h5>Orden #<?php echo ($i+1) ?></h5>
                    </div>
                    <div class="table-responsive-lg d-flex flex-row justify-content-center">
                        <table class="table" style="width: 80% !important">
                            <tbody id="tabla">
                                <tr>
                                    <th> Número de orden</th>
                                    <td> <a href="index.php?pid=<?php echo base64_encode("Vista/Orden/listarOrdenAdministrador.php") ?>&idOrden=<?php echo $resOrdenes[$i][0] ?>"><?php echo $resOrdenes[$i][0] ?></a></td>
                                </tr>
                                <tr>
                                    <th> Fecha de estiación</th>
                                    <td> <?php echo $resOrdenes[$i][1] ?></td>
                                </tr>
                                <tr>
                                    <th> Fecha de llegada</th>
                                    <td> <?php echo ($resOrdenes[$i][2] == null ? "En transito": $resOrdenes[$i][2]) ?></td>
                                </tr>
                                <tr>
                                    <th> Remitente</th>
                                    <td> <?php echo $resOrdenes[$i][3] ?></td>
                                </tr>
                                <tr>
                                    <th> Receptor</th>
                                    <td> <?php echo $resOrdenes[$i][4] ?></td>
                                </tr>
                                <tr>
                                    <th> Número de contacto</th>
                                    <td> <?php echo $resOrdenes[$i][5] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>