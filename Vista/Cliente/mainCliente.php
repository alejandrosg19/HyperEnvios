<?php

$Orden = new Orden("", "", "", "", "", "", "", $_SESSION['id']);
$Orden->getLastOrdenCliente();
//
$estado = new Estado("", "", "", $Orden -> getIdOrden());
$data = $estado->getEstadosAsc();
//
//var_dump($data);
$last = $data[count($data) - 1][5];
//echo "<br>" . $last . "<br>";
//
$accionEstado = new AccionEstado();
$all = $accionEstado->getAllestados();
//var_dump($all);
//
//$posArray = array_search($last, $all[0]);
$posArray = array_search($last, array_column($all, 0));
//echo "<br>" . $posArray . "<br>";
?>
<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10">
            <div class="row pt-5">
                <div class="col-4" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title"> Ordenes entregadas </div>
                        <div class="cards-number"><?php echo "30000" ?></div>
                        <div class="cards-info"><span class="card-info-up"><i class="fas <?php echo "fa-arrow-down"  ?>"></i><?php echo "80" ?>%</span> Desde el Mes Pasado</div>
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
                <div class="col-4" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title"> Ordenes en proceso </div>
                        <div class="cards-number">$<?php echo "150.000" ?></div>
                        <div class="cards-info"><span class="card-info-down"><i class="fas <?php echo "fa-arrow-up" ?>"></i><?php echo "30" ?>%</span> Desde el Mes Pasado</div>
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
                <div class="col-4" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage " style="height: 172px">
                        <div class="cards-title"> Clientes </div>
                        <div class="cards-number"><?php echo "40" ?></div>
                        <div class="cards-info"><span class="card-info-up"><i class="fas <?php echo "fa-arrow-up" ?>"></i><?php echo "30" ?>%</span> Desde el Mes Pasado</div>
                        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="infoCards linetimeInfoCard graphdiv d-flex flex-row justify-content-center align-items-center">
                        <div class="timeLineCard">
                            <ul class="timeline" id="timeline">
                                <?php
                                for ($i = 0; $i < count($data); $i++) {
                                    $fecha = explode(" ", $data[$i][1]); 
                                ?>
                                    <li class="li complete">
                                        <div class="timestamp d-flex flex-column align-items-center">
                                            <span class="author"><?php echo ($data[$i][2] == 3 ? $data[$i][3] : ($data[$i][2] == 2 ? "Conductor": "Despachador") ) ?></span>
                                            <span class="date d-block"><?php  echo $fecha[0] ?><span>
                                            <!--<span class="date d-block"><?php  echo $fecha[1] ?><span>-->
                                        </div>
                                        <div class="status">
                                            <h4> <?php echo $data[$i][0] ?> </h4>
                                        </div>
                                    </li>
                                    <?php
                                }
                                for ($j = $posArray + 1; $j < count($all); $j++) {
                                    if ($all[$j][0] != 4) {
                                    ?>
                                        <li class="li">
                                            <div class="timestamp">
                                                <span class="author"></span>
                                                <span class="date"><span>
                                            </div>
                                            <div class="status">
                                                <h4> <?php echo $all[$j][1] ?> </h4>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
    let scrY = 0;
    let bool = true;

    $(function() {
        $('.timeLineCard').scrollLeft(100);
    })



    $('.timeLineCard').bind('mousewheel DOMMouseScroll', function(e) {
        var scrollTo = null;

        if (e.type == 'mousewheel') {
            scrollTo = (e.originalEvent.wheelDelta * -1);
        } else if (e.type == 'DOMMouseScroll') {
            scrollTo = 40 * e.originalEvent.detail;
        }

        if (scrollTo) {
            e.preventDefault();
            $(this).scrollLeft(scrollTo + $(this).scrollLeft());
        }
    });
</script>