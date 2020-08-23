<?php 

$Cita = new Cita("", "", $_SESSION['id']);

$XRecoger = $Cita -> getOrdenesXRecoger();
$TotalRecogidasMes = $Cita -> getOrdenesRecogidas();

$Envio = new Envio("", "", $_SESSION['id']);

$XEntregar = $Envio -> getOrdenesxEntregar();
$TotalEnviosMes = $Envio -> getOrdenesEntregadas();

$estadoConductor = new EstadoConductor("", "", "", "", $_SESSION['id']);

$ordenes = $estadoConductor -> ordenesConductor();
$areaChart = "[ ['Mes', 'Ordenes Entregadas'],";
for ($i = 0; $i < count($ordenes); $i++) {
    $areaChart =  $areaChart . "['" . $ordenes[$i][0] . "'," . $ordenes[$i][1] . "],";
}
$areaChart =  $areaChart . "]";


?>
<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10">
            <div class="row pt-5">
                <div class="col-12 col-xl-6" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title">Cantidad de ordenes por recoger</div>
                        <div class="cards-number"><?php echo ($XRecoger != NULL? $XRecoger : "0") ?></div>
                        <div class="cards-info">En el ultimo mes se han recogio <span class="card-info-up" style="margin:0px"><?php echo ($TotalRecogidasMes != NULL ? $TotalRecogidasMes : "0" ) ?></span> ordenes</div>
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title">Cantidad de ordenes por entregar</div>
                        <div class="cards-number"><?php echo ($XEntregar != NULL? $XEntregar : "0" )  ?></div>
                        <div class="cards-info">En el ultimo mes se han entregado <span class="card-info-up" style="margin:0px"><?php echo ($TotalEnviosMes != NULL ? $TotalEnviosMes : "0" ) ?></span> ordenes</div>
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 16px 0px">
                <div class="col-12" style="padding: 16px !important">
                    <div class="graphdiv graphicState d-flex flex-column justify-content-center align-items-center" style="height: 500px; ">
                        <h5 class="chart-title">Ordenes entregadas por mes</h5>
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

    /*Area Chart*/
    google.charts.setOnLoadCallback(drawAreaChart);

    function drawAreaChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $areaChart ?>);

        var options = {
            title: 'Cantidad de ordenes entregadas por mes',
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