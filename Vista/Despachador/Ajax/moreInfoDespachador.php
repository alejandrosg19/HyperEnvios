<?php
    $idDespachador = $_GET["idDespachador"];
    $Despachador = new Despachador($idDespachador);
    $Despachador -> getInfoBasic();
?>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de Despachador</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="row d-flex flex-row justify-content-center mb-4">
                    <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Despachador->getFoto() != "") ? $Despachador->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                    </div>
                </div>
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Tipo</th>
                                <td> Despachador</td>
                            </tr>
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $Despachador -> getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Telefono</th>
                                <td> <?php echo $Despachador->getTelefono() ?></td>
                            </tr>
                            <tr>
                                <th> Estado</th>
                                <td> <?php echo (($Despachador->getEstado() == 1)? "Activado": "Bloqueado")?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $Despachador->getCorreo() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>