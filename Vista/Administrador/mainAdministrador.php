<?php
$orden = new Orden();
$estado = new Estado();

/*Porcentaje de ordenes del mes actual en comparación mes anterior + cantidad de ordenes del mes*/
$ventas  = $orden->ventas();
$porcentajeOrdenes = intval((intval($ventas[0][0]) * 100 / intval($ventas[1][0])) - 100);
$cantOrdenes = $ventas[0][0];
echo $porcentajeOrdenes . "    " . $cantOrdenes;

/*Porcentaje de ingresos del mes actual en comparación mes anterior + valor en pesos de mes actual*/
$ingresos = $orden->ingresos();
$porcentajeIngresos = intval((intval($ingresos[0][0]) * 100 / intval($ingresos[1][0])) - 100);
$valorIngresos = $ingresos[0][0];
echo $porcentajeIngresos . "    " . $valorIngresos;

/*Organiza y escoge los 10 productos de mayor CANTIDAD en la bodega y suma los demas y los muestra en otros*/
$ventasxMes = $orden->ventasxMes();
$columnChar = "[ ['Fecha', 'Cantidad Ventas'],";
for ($i = 0; $i < count($ventasxMes); $i++) {
    $columnChar =  $columnChar . "['" . $ventasxMes[$i][0] . "'," . $ventasxMes[$i][1] . "],";
}
$columnChar =  $columnChar . "]";

/*Cantidad de ordenes que se encuentran en cada uno de los estados*/
$ordenesEstados = $estado->ordenesEstados();
$barChar = "[ ['Estado', 'Ordenes en Estado'],";
for ($i = 0; $i < count($ordenesEstados); $i++) {
    $barChar =  $barChar . "['" . $ordenesEstados[$i][0] . "'," . $ordenesEstados[$i][1] . "],";
}
$barChar =  $barChar . "]";


?>
<div class="container">
    <div class="row pt-5">
        <div class="col-4">
            <div class="graphicPercentage border m-2" style="height: 30vh;">
                Grafico Pordentaje 1
            </div>
            <div class="graphicPercentage border m-2" style="height: 30vh;">
                Grafico Porcentaje 2
            </div>
        </div>
        <div class="col-8">
            <div id="columnChar_div" class="grapichSells border m-2" style="height: 60vh;">
                Grafico de ventas por dia
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="graphicItem border m-2" style="height: 60vh;">
                Grafico de Torta Item
            </div>
        </div>
        <div class="col-6">
            <div class="graphicState border m-2" style="height: 60vh;">
                Grafico de ... Estado de Ordenes
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div id="barChar_div"></div>
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
</div>

<script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });

    /*ColumnChar*/
    google.charts.setOnLoadCallback(drawColumnChart);

    function drawColumnChart() {

        var data = new google.visualization.arrayToDataTable(<?php echo $columnChar ?>);


        var options = {
            title: 'Cantidad de Ventas Por Mes',
            hAxis: {
                title: 'Mes de Ventas',
            },
            vAxis: {
                title: 'Cantidad de Ventas'
            }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('columnChar_div'));

        chart.draw(data, options);
    }

    /*BarChar*/
    google.charts.setOnLoadCallback(drawBarChart);

    function drawBarChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $barChar ?>);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);

        /*var options = {
            title: "Cantidad de Ordenes en Cada Estado",
            width: 600,
            height: 400,
            bar: {
                groupWidth: "95%"
            },
            legend: {
                position: "none"
            },
        };*/
        var options = {
            title: 'Cantidad de Ordenes en Cada Estado',
            chartArea: {
                width: '50%'
            },
            hAxis: {
                title: 'Estados',
                minValue: 0
            },
            vAxis: {
                title: 'Ordenes'
            }
        };
        var chart = new google.visualization.BarChart(document.getElementById("barChar_div"));
        chart.draw(view, options);
    }
</script>