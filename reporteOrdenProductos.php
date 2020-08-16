<?php

//Requiere estado
require_once("Negocio/Estado.php");
require_once("Negocio/Orden.php");
require_once("Helpers/logHelper.php");

require_once("mpdf/vendor/autoload.php");

//plantilla HTML
//require_once("pdf/plantilla/index.php");

//Codigo CSS
$css = file_get_contents("pdf/css/style.css");



$idOrden = $_GET["idOrden"];
$orden = new Orden($idOrden);
$OrdenInfo = $orden->getInfoOrden();

$mpdf = new \Mpdf\Mpdf([]);

//$plantilla = getPlantilla($data);


$plantilla = '<body>
    <header class="clearfix">
        <div id="logo">
            <img src="pdf/img/logo1.png" width="100px">
        </div>
        <div id="company">
            <h2 class="name">Hyper</h2>
            <div>Calle 55 a # 45C - 39</div>
            <div>79-840-555</div>
            <div><a href="mailto:company@hyper.com">atencionalcliente@hyper.com</a></div>
            </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="invoice">
                <h1>Información de orden</h1>
                <div class="date">Fecha de creación: ' . getJustDate() . '</div>
                </div>
            </div>
        </div>
            <table>
                <tbody>
                <tr>
                    <th class="tableTH">Fecha Orden</th>
                    <td> ' . $OrdenInfo[0][0] . ' </td>
                </tr>
                <tr>
                    <th class="tableTH">Fecha Estimación</th>
                    <td> ' . $OrdenInfo[0][1] . ' </td>
                </tr>
                <tr>
                    <th class="tableTH">Dirección de destino</th>
                    <td> ' . $OrdenInfo[0][2] . ' </td>
                </tr>
                <tr>
                    <th class="tableTH">Receptor</th>
                    <td> ' . $OrdenInfo[0][3] . ' </td>
                </tr>
                <tr>
                    <th class="tableTH">Número de contacto</th>
                    <td> ' . $OrdenInfo[0][4] . ' </td>
                </tr>
                </tbody>
            </table>';

$plantilla .='<div>
                <h3>Información de Productos</h3>
            </div>
            <table class="tableProductos">
                <tbody>
                    <tr>
                        <th class="tableTHEstados">Referencia</th>
                        <th class="tableTHEstados">Nombre</th>
                        <th class="tableTHEstados">Precio</th>
                        <th class="tableTHEstados">Peso</th>
                        <th class="tableTHEstados">Fabricante</th>
                        <th class="tableTHEstados">Descripción</th>
                    </tr>';

                    for ($i = 0; $i < count($OrdenInfo); $i++) {
                        $plantilla .='<tr>
                            <td>' . $OrdenInfo[$i][6] . '</td>
                            <td>' . $OrdenInfo[$i][7] . '</td>
                            <td>' . $OrdenInfo[$i][9] . '</td>
                            <td>' . $OrdenInfo[$i][10] . '</td>
                            <td>' . $OrdenInfo[$i][11] . '</td>
                            <td>' . $OrdenInfo[$i][8] .'</td>
                        </tr>';
                    }
                    $plantilla .='</tbody>
                </table>';


$plantilla .= '
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>';



//$plantilla = "<h1>HOLA</h1>";

$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->Output();
