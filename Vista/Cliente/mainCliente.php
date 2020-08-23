<?php

$Orden = new Orden("", "", "", "", "", "", "", $_SESSION['id']);
$Orden->getLastOrdenCliente();
//
$estado = new Estado("", "", "", $Orden -> getIdOrden());
$data = $estado->getEstadosAsc();
//
//var_dump($data);
if(count($data) > 0){
    $last = $data[count($data) - 1][5];
}else{
    $last = 0;
}

//echo "<br>" . $last . "<br>";
//
$accionEstado = new AccionEstado();
$all = $accionEstado->getAllestados();
//var_dump($all);
//
//$posArray = array_search($last, $all[0]);
$posArray = array_search($last, array_column($all, 0));

/**
 * Ordenes realizadas
 */

$totalOrdenes = $Orden -> getTotalOrdenes();
$fechaPrimeraOrden = explode(" ", $Orden -> getFechaPrimeraOrden());

/**
 * Ordenes en progreso
 */

$TotalOrdenesProceso = $Orden -> getOrdenesProceso();


?>
<div class="container-fluid">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10">
            <div class="row pt-5">
                <div class="col-12 col-xl-6" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title"> Número de ordenes realizadas </div>
                        <div class="cards-number"><?php echo ($totalOrdenes != NULL ? $totalOrdenes : 0) ?></div>
                        <div class="cards-info"><?php echo ($totalOrdenes != NULL ? "Apartir del <span class='card-info-up'>". $fechaPrimeraOrden[0] . " </span>" : "Realiza tu primera orden <span class='card-info-up'><a class='card-info-up' href='index.php?pid=".base64_encode("Vista/Orden/crearOrden.php")."'>aquí</a></span>") ?></div>
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6" style="padding: 16px !important">
                    <div class="infoCards graphdiv graphicPercentage" style="height: 172px">
                        <div class="cards-title"> Número de ordenes en proceso </div>
                        <div class="cards-number"><?php echo ($TotalOrdenesProceso != NULL ? $TotalOrdenesProceso : "0" ) ?></div>
                        <div class="cards-info"><a class="cards-link" href="index.php?pid=<?php echo base64_encode("Vista/Orden/listarOrdenCliente.php") ?>">Ver más <span class="card-info-up"><i class="fas fa-plus"></i></span> </a></div>
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 16px 0px">
                <div class="col-12">
                    <div class="infoCards linetimeInfoCard graphdiv d-flex flex-column justify-content-center align-items-center">
                    <h5 class="chart-title">Última orden realizada</h5>
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