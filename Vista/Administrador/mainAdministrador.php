<?php
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            chartArea: {
                left: 0,
                top: 0,
                width: '100%',
                height: '100%'
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Move', 'Percentage'],
            ["King's pawn (e4)", 44],
            ["Queen's pawn (d4)", 31],
            ["Knight to King 3 (Nf3)", 12],
            ["Queen's bishop pawn (c4)", 10],
            ['Other', 3]
        ]);

        var options = {

            legend: {
                position: 'none'
            },
            bar: {
                groupWidth: "90%"
            }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
    };
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Opening Move', 'Percentage'],
            ["King's pawn (e4)", 44],
            ["Queen's pawn (d4)", 31],
            ["Knight to King 3 (Nf3)", 12],
            ["Queen's bishop pawn (c4)", 10],
            ['Other', 3]
        ]);

        var options = {
            legend: {
                position: 'none'
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            axes: {
                x: {
                    0: {
                        side: 'top',
                        label: 'Percentage'
                    } // Top x-axis.
                }
            },
            bar: {
                groupWidth: "90%"
            }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x'));
        chart.draw(data, options);
    };
</script>

<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10">
            <div class="row pt-5">
                <div class="col-4" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title"> Customers </div>
                        <div class="cards-number">36,254</div>
                        <div class="cards-info"><span class="card-info-up"><i class="fas fa-arrow-up"></i>5,24%</span> Since last month</div>
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px; margin-top:32px">
                        <div class="cards-title"> Customers </div>
                        <div class="cards-number">36,254</div>
                        <div class="cards-info"><span class="card-info-down"><i class="fas fa-arrow-down"></i>5,24%</span> Since last month</div>
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                    <div class="infoCards graphdiv graphicPercentage " style="height: 172px; margin-top:32px">
                        <div class="cards-title"> Customers </div>
                        <div class="cards-number">36,254</div>
                        <div class="cards-info"><span class="card-info-up"><i class="fas fa-arrow-up"></i>5,24%</span> Since last month</div>
                        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>
                <div class="col-8" style="padding: 16px !important">
                    <div class="graphdiv grapichSells d-flex flex-column justify-content-center align-items-center" style="height: 580px">
                        <h5 class="chart-title">Información del envío</h5>
                        <div id="top_x_div" style="width: 80%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="padding: 16px !important">
                    <div class="graphdiv graphicState d-flex flex-column justify-content-center align-items-center" style="height: 680px; padding:30px 50px 30px 50px">
                        <h5 class="chart-title">Información del envío</h5>
                        <div id="top_x" style="width: 100%; height: 440px;"></div>
                    </div>
                </div>
                <div class="col-6" style="padding: 16px !important">
                    <div class="graphdiv graphicItem  d-flex flex-column justify-content-center align-items-center" style="height: 680px; overflow: hidden;">
                        <h5 class="chart-title">Información del envío</h5>
                        <div id="piechart" style="width: 80%; height: 440px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>