<?php

$idEnvio = $_GET['idEnvio'];

$envio = new Envio($idEnvio);

$res = $envio -> moreInfo();

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
                                <th> Fecha de estimación de llegada</th>
                                <td> <?php echo $res[2] ?></td>
                            </tr>
                            <tr>
                                <th> Fecha de llegada</th>
                                <td> <?php echo ($res[3] == null? "En transito" : $res[3]) ?></td>
                            </tr>
                            <tr>
                                <th> Dirección de envío</th>
                                <td> <?php echo $res[4] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        <div class="row justify-content-center">
            <h3>Remitente</h3>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $res[5] ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $res[6] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="row justify-content-center">
            <h3>Destinatario</h3>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $res[7] ?></td>
                            </tr>
                            <tr>
                                <th> Número telefónico</th>
                                <td> <?php echo $res[8] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="row justify-content-center">
            <h3>Conducto asignado</h3>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $res[9] ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $res[10] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>