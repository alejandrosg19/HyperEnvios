<?php 

$Cita = new Cita("", "", $_SESSION['id']);

$XRecoger = $Cita -> getOrdenesXRecoger();
$TotalRecogidasMes = $Cita -> getOrdenesRecogidas();

$Envio = new Envio("", "", $_SESSION['id']);

$XEntregar = $Envio -> getOrdenesxEntregar();
$TotalEnviosMes = $Envio -> getOrdenesEntregadas();

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