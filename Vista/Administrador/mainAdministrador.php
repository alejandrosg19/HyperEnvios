<?php
$orden = new Orden();
$estado = new Estado();
$precio = new Precio();

/*Porcentaje de ordenes del mes actual en comparación mes anterior + cantidad de ordenes del mes*/
$ventas  = $orden->ventas();
$porcentajeOrdenes = intval((intval($ventas[0][0]) * 100 / intval($ventas[1][0])) - 100);
$cantOrdenes = $ventas[0][0];

/*Porcentaje de ingresos del mes actual en comparación mes anterior + valor en pesos de mes actual*/
$ingresos = $orden->ingresos();
$porcentajeIngresos = intval((intval($ingresos[0][0]) * 100 / intval($ingresos[1][0])) - 100);
$valorIngresos = $ingresos[0][0];

/*Organiza y escoge los 10 productos de mayor CANTIDAD en la bodega y suma los demas y los muestra en otros*/
$ventasxMes = $orden->ventasxMes();
$columnChart = "[ ['Fecha', 'Cantidad Ventas'],";
for ($i = 0; $i < count($ventasxMes); $i++) {
    $columnChart =  $columnChart . "['" . $ventasxMes[$i][0] . "'," . $ventasxMes[$i][1] . "],";
}
$columnChart =  $columnChart . "]";

/*Cantidad de ordenes que se encuentran en cada uno de los estados*/
$ordenesEstados = $estado->ordenesEstados();
$barChart = "[ ['Estado', 'Ordenes en Estado'],";
for ($i = 0; $i < count($ordenesEstados); $i++) {
    $barChart =  $barChart . "['" . $ordenesEstados[$i][0] . "'," . $ordenesEstados[$i][1] . "],";
}
$barChart =  $barChart . "]";

/*Cantidad de items que se encuentran en el rango de pesos*/
$itemPeso = $precio->itemPeso();
$pieChart = "[ ['Peso', 'Cantidad Productos'],";
for ($i = 0; $i < count($itemPeso); $i++) {
    $pieChart =  $pieChart . "['" . $itemPeso[$i][1] . " - " . $itemPeso[$i][2] . "'," . $itemPeso[$i][0] . "],";
}
$pieChart =  $pieChart . "]";

?>
<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10">
            <div class="row pt-5">
                <div class="col-4" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title"> Ordenes </div>
                        <div class="cards-number"><?php echo $cantOrdenes?></div>
                        <div class="cards-info"><span class="card-info-up"><i class="fas <?php echo($porcentajeOrdenes<0 ? "fa-arrow-down" : "fa-arrow-up") ?>"></i><?php echo $porcentajeOrdenes?>%</span> Desde el Mes Pasado</div>
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px; margin-top:32px">
                        <div class="cards-title"> Ingresos </div>
                        <div class="cards-number">$<?php echo $valorIngresos?></div>
                        <div class="cards-info"><span class="card-info-down"><i class="fas <?php echo($porcentajeIngresos<0 ? "fa-arrow-down" : "fa-arrow-up") ?>"></i><?php echo $porcentajeIngresos?>%</span> Desde el Mes Pasado</div>
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                    <div class="infoCards graphdiv graphicPercentage " style="height: 172px; margin-top:32px">
                        <div class="cards-title"> Customers </div>
                        <div class="cards-number">36,254</div>
                        <div class="cards-info"><span class="card-info-up"><i class="fas fa-arrow-up"></i>5,24%</span> Desde el Mes Pasado</div>
                        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>
                <div class="col-8" style="padding: 16px !important">
                    <div class="graphdiv grapichSells d-flex flex-column justify-content-center align-items-center" style="height: 580px">
                        <h5 class="chart-title">Información del envío</h5>
                        <div id="columnChart_div" style="width: 80%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="padding: 16px !important">
                    <div class="graphdiv graphicState d-flex flex-column justify-content-center align-items-center" style="height: 680px; padding:30px 50px 30px 50px">
                        <h5 class="chart-title">Información del envío</h5>
                        <div id="barChart_div" style="width: 100%; height: 440px;"></div>
                    </div>
                </div>
                <div class="col-6" style="padding: 16px !important">
                    <div class="graphdiv graphicItem  d-flex flex-column justify-content-center align-items-center" style="height: 680px; overflow: hidden;">
                        <h5 class="chart-title">Información del envío</h5>
                        <div id="pieChart_div" style="width: 80%; height: 440px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });

    /*ColumnChar*/
    google.charts.setOnLoadCallback(drawColumnChart);

    function drawColumnChart() {

        var data = new google.visualization.arrayToDataTable(<?php echo $columnChart ?>);


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
            document.getElementById('columnChart_div'));

        chart.draw(data, options);
    }

    /*BarChar*/
    google.charts.setOnLoadCallback(drawBarChart);

    function drawBarChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $barChart ?>);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);

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
        var chart = new google.visualization.BarChart(document.getElementById("barChart_div"));
        chart.draw(view, options);
    }

    /*Pie Chart*/
    google.charts.setOnLoadCallback(drawPieChart);

    function drawPieChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $pieChart ?>);

        var options = {
            title: 'Porcentaje de ',
            pieHole: 0.5,
            pieSliceTextStyle: {
                color: 'black',
            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart_div'));

        chart.draw(data, options);
    }
</script>