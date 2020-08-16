<?php

//Requiere estado
require_once("Negocio/Estado.php");
require_once("Negocio/Orden.php");
require_once("Negocio/ComentarioCliente.php");
require_once("Negocio/ComentarioConductor.php");
require_once("Negocio/ComentarioDespachador.php");
require_once("Helpers/logHelper.php");

require_once("mpdf/vendor/autoload.php");

//plantilla HTML
//require_once("pdf/plantilla/index.php");

//Codigo CSS
$css = file_get_contents("pdf/css/style.css");



$idOrden = $_GET["idOrden"];
$estado = new Estado("", "", "", $idOrden);
$data = $estado->getEstados();

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

for ($i = 0; $i < count($data); $i++) {
    $plantilla .= '<div>
                <h3 class="tituloEstado">Estado ' . $data[$i][0] . '</h3>
            </div>
            <div>
                <table class="table"> 
                    <tbody>
                        <tr>
                            <th class="tableTHEstados"> Fecha Estado</th>
                            <td>' . $data[$i][1] . '</td>
                        </tr>
                        <tr>
                            <th class="tableTHEstados"> ' . ($data[$i][2] == 1 ? 'Despachador' : 'Conductor') . '</th>
                            <td>' . $data[$i][3] . '</td>
                        </tr>';

                        $arrayComentario = 0;
                        if ($data[$i][2] == 1) {
                            $comentarioActor = new ComentarioDespachador("", "", "", $data[$i][4]);
                            $arrayComentario = $comentarioActor->getInfo();
                        } else if ($data[$i][2] == 2) {
                            $comentarioActor = new ComentarioConductor("", "", "", $data[$i][4]);
                            $arrayComentario = $comentarioActor->getInfo();
                        } else if ($data[$i][2] == 3) {
                            $comentarioActor = new ComentarioCliente("", "", "", $data[$i][4]);
                            $arrayComentario = $comentarioActor->getInfo();
                        }

                        if (count($arrayComentario) == 0) {
                            $plantilla .=   '<tr>
                                                <th class="tableTHEstados">Comentarios</th>
                                                <td>No hay comentarios asociados a este estado</td>  
                                            </tr>';
                        } else {
                            $plantilla .=   '<tr>
                                                <th class="tableTHEstados" >Comentarios</th>
                                                <td>';

                            for ($x = 0; $x < count($arrayComentario); $x++) {
                                $plantilla .=   '<table class="table"> 
                                                    <tbody>
                                                        <tr>
                                                            <th class="tableTHEstados">Fecha Comentario</th>
                                                            <td>' . $arrayComentario[$x][0] . '</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="tableTHEstados"> Comentario</th>
                                                            <td>' . $arrayComentario[$x][1] . '</td>
                                                        </tr>
                                                    </tbody>
                                                </table>';
                            }
                            $plantilla .=    '</td>  
                                        </tr>';
                        }
    $plantilla .= '
                    </tbody>
                </table>
            </div>';
}
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
