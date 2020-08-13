<?php

$idCita = $_GET['idCita'];

$cita = new Cita($idCita);

$res = $cita -> moreInfo();

?>
<div class="row">

<div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de la cita</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> idCita</th>
                                <td> <?php echo $res[5] ?></td>
                            </tr>
                            <tr>
                                <th> Fecha de recolección</th>
                                <td> <?php echo $res[6] ?></td>
                            </tr>
                            <tr>
                                <th> Dirección de recolección</th>
                                <td> <?php echo $res[2] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        <div class="row justify-content-center">
            <h3>Cliente</h3>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $res[0] ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $res[1] ?></td>
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
                                <td> <?php echo $res[3] ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $res[4] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>