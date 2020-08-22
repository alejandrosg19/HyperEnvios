<?php

$estado = new Estado();
$precio = new Precio();

/*Cantidad de ordenes que se encuentran en cada uno de los estados*/
$ordenesEstados = $estado->ordenesEstadosDespachador($_SESSION["id"]);
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
            <div class="row">
                <div class="col-12 col-xl-6" style="padding: 16px !important">
                    <div class="graphdiv graphicState d-flex flex-column justify-content-center align-items-center" style="height: 500px; ">
                        <h5 class="chart-title">Estados de Ordenes</h5>
                        <div id="barChart_div" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6" style="padding: 16px !important">
                    <div class="graphdiv graphicItem  d-flex flex-column justify-content-center align-items-center" style="height: 500px; overflow: hidden;">
                        <h5 class="chart-title">Peso Vendido</h5>
                        <div id="pieChart_div" style="width: 130%; height: 400px;"></div>
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
    /*google.charts.setOnLoadCallback(drawPieChart);

    function drawPieChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $pieChart ?>);

        var options = {
            title: 'Porcentaje de Peso Mas Vendido',
            pieHole: 0.5,
            pieSliceTextStyle: {
                color: 'black',
            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart_div'));

        chart.draw(data, options);
    }*/
</script>