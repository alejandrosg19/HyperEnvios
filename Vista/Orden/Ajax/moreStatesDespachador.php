<?php
$idOrden = $_GET["idOrden"];
$estado = new Estado("", "", "", $idOrden);
$data = $estado->getEstados();
?>

<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Estados de Orden</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                    <?php for ($i = 0; $i < count($data); $i++) {
                        echo "
                            <div class='row justify-content-center mt-3'>
                                <h3>Estado " . $data[$i][0] . "</h3>
                            </div>
                            <div class='table-responsive-lg d-flex flex-row justify-content-center'>
                                <table class='table' style='width: 80% !important'> 
                                    <tbody>
                                        <tr>
                                            <th> Fecha Estado</th>
                                            <td>" . $data[$i][1] . "</td>
                                        </tr>
                                        <tr>
                                            <th> " . ($data[$i][2] == 1 ? 'Despachador' : 'Conductor') . "</th>
                                            <td>" . $data[$i][3] . "</td>
                                        </tr>
                                        <tr>
                                            <th> Fecha Comentario</th>
                                            <td>" . ($data[$i][4] == '' ? 'No hay comentarios asociados a este estado' : $data[$i][4]) . "</td>
                                        </tr>
                                        <tr>
                                            <th> Comentario</th>
                                            <td>" . $data[$i][5] . "</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>";
                        }
                    ?>
            </div>
        </div>
    </div>
</div>