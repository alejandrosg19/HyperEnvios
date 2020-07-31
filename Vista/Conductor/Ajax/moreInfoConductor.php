<?php
    $idConductor = $_GET["idConductor"];
    $Conductor = new Conductor($idConductor);
    $Conductor -> getInfoBasic();
?>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de Conductor</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="row d-flex flex-row justify-content-center mb-4">
                    <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Conductor->getFoto() != "") ? $Conductor->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                    </div>
                </div>
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Tipo</th>
                                <td> Conductor</td>
                            </tr>
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $Conductor -> getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Dirección</th>
                                <td> <?php echo $Conductor->getTelefono() ?></td>
                            </tr>
                            <tr>
                                <th> Estado</th>
                                <td> <?php echo (($Conductor->getEstado() == 1)? "Activado": "Bloqueado")?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $Conductor->getCorreo() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>