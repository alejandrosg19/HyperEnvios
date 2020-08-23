<?php

$estado = new Estado();
$orden = new Orden("","","","","","","","","","",$_SESSION["id"]);

/*Cantidad de ordenes que se encuentran en cada uno de los estados*/
$ordenesEstados = $estado->ordenesEstadosDespachador($_SESSION["id"]);
$barChart = "[ ['Estado', 'Ordenes en Estado'],";
for ($i = 0; $i < count($ordenesEstados); $i++) {
    $barChart =  $barChart . "['" . $ordenesEstados[$i][0] . "'," . $ordenesEstados[$i][1] . "],";
}
$barChart =  $barChart . "]";

/*Cantidad de items que se encuentran en el rango de pesos*/
$ordenes = $orden->ordenesDespachador();
$areaChart = "[ ['Mes', 'Ordenes Despachadas'],";
for ($i = 0; $i < count($ordenes); $i++) {
    $areaChart =  $areaChart . "['" . $ordenes[$i][0] . "'," . $ordenes[$i][1] . "],";
}
$areaChart =  $areaChart . "]";

?>

<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10">
            <div class="row" style="padding: 16px 0px">
                <div class="col-12 " style="padding: 16px !important">
                    <div class="graphdiv graphicState d-flex flex-column justify-content-center align-items-center" style="height: 500px; ">
                        <h5 class="chart-title">Estados de Ordenes</h5>
                        <div id="barChart_div" style="width: 100%; height: 420px;"></div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 16px 0px">
                <div class="col-12 " style="padding: 16px !important">
                    <div class="graphdiv graphicState d-flex flex-column justify-content-center align-items-center" style="height: 500px; ">
                        <h5 class="chart-title">Ordenes Despachadas</h5>
                        <div id="areaChart_div" style="width: 100%; height: 420px;"></div>
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

    /*Area Chart*/
    google.charts.setOnLoadCallback(drawAreaChart);

    function drawAreaChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $areaChart ?>);

        var options = {
            title: 'Cantidad de Ordenes Despachadas',
            hAxis: {
                title: 'Mes',
                titleTextStyle: {
                    color: '#333'
                }
            },
            vAxis: {
                minValue: 0
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('areaChart_div'));
        chart.draw(data, options);
    }
</script>