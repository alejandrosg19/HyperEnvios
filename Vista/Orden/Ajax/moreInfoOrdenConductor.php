<?php
$idOrden = $_GET["idOrden"];
$orden = new Orden($idOrden);
$data = $orden->getInfoOrden();
?>

<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de Orden</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Fecha Orden</th>
                                <td><?php echo $data[0][0] ?></td>
                            </tr>
                            <tr>
                                <th> Fecha Estimación</th>
                                <td> <?php echo $data[0][1] ?></td>
                            </tr>
                            <tr>
                                <th> Dirección Destino</th>
                                <td> <?php echo $data[0][2] ?></td>
                            </tr>
                            <tr>
                                <th> Contacto Destinatario</th>
                                <td> <?php echo $data[0][3] ?></td>
                            </tr>
                            <tr>
                                <th> Numero Contacto</th>
                                <td> <?php echo $data[0][4] ?></td>
                            </tr>
                            <tr>
                                <th> Fecha Llegada a Bodega</th>
                                <td> <?php echo $data[0][5] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <h3 class="m-0">Información de Cliente</h3>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Nombre</th>
                                <td><?php echo $data[0][12] ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $data[0][13] ?></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <h3>Información de Productos</h3>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-12">
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th>Referencia</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Peso</th>
                                <th>Fabricante</th>
                                <th>Descripción</th>
                            </tr>
                            <?php
                            $item = 0;
                            for ($i = 0; $i < count($data); $i++) {
                                echo "<tr>";
                                echo "<td>" . $data[$i][6] . "</td>";
                                echo "<td>" . $data[$i][7] . "</td>";
                                echo "<td>" . $data[$i][9] . "</td>";
                                echo "<td>" . $data[$i][10] . "</td>";
                                echo "<td>" . $data[$i][11] . "</td>";
                                echo "<td>
                                        <a class='btn btn-primary' data-toggle='collapse' href='#collapseExample" . $item . "' role='button' aria-expanded='false' aria-controls='collapseExample'>
                                            Mostrar
                                        </a>
                                    </td>";
                                echo "</tr>";
                                echo "<tr>
                                        <td colspan='6' class='collapse' id='collapseExample" . $item . "'>";
                                echo $data[$i][8];
                                        "</td>
                                    </tr>";
                                $item++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>