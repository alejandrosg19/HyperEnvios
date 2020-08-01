<?php
    $idAccionEstado = $_GET["idAccionEstado"];
    $AccionEstado = new AccionEstado($idAccionEstado);
    $AccionEstado -> getInfoBasic();
?>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de Accion</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Tipo</th>
                                <td> Accion</td>
                            </tr>
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $AccionEstado -> getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Discripción</th>
                                <td> <?php echo $AccionEstado->getDescripcion() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>