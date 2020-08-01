<?php

$pagina = 1;
$numReg = 15;

$log = new Log();
$resultados = $log -> buscarPaginado($pagina, $numReg);
$cantPag = $log -> buscarCantidad();
$pagination = $cantPag / $numReg;
?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Buscar Log</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header bg-dark d-flex flex-row justify-content-between">
                    <div style="width: 182px;"></div>
                    <select id="select-cantidad">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15" selected>15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <input id="search" type="text" placeholder="search">
                </div>
                <div class="card-body form-table">
                    <div class="table-responsive-lg">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                    <th>Navegador</th>
                                    <th>SO</th>
                                    <th>Usuario</th>
                                    <th style="text-align:center;">Servicios</th>
                                </tr>
                            </thead>
                            <tbody id="tabla">
                                <?php
                                foreach ($resultados as $resultado) {
                                ?>
                                    <tr>
                                        <td><?php echo $resultado->getFecha() ?></td>
                                        <td><?php echo $resultado->getAccion() ?></td>
                                        <td><?php echo $resultado->getBrowser() ?></td>
                                        <td><?php echo $resultado->getOs() ?></td>
                                        <td><?php echo $resultado->getUser() ?></td>
                                        <td style='display:flex; justify-content:center;'><a href='#' class="moreInfoBtn" data-id="<?php echo $resultado->getIdLog() ?>" data-table="<?php echo $resultado->getTipo() ?>" data-toggle="modal" data-target="#moreInfo"><i class='fas fa-info-circle'></i></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-center ">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item page-item-list disabled" id="page-previous" data-page="<?php echo ($pagina - 1) ?>">
                                <span class="page-link">Previous</span>
                            </li>
                            <?php
                            for ($i = 0; $i < $pagination; $i++) {
                            ?>
                                <li class="page-item page-item-list page-numbers <?php echo (($i + 1) == $pagina) ? "active" : ""; ?>" data-page="<?php echo ($i + 1); ?>"><a class="page-link" href="#"><?php echo ($i + 1); ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item page-item-list <?php echo ($pagination <= 1) ? "disabled" : ""; ?>" id="page-next" data-page="<?php echo ($pagina + 1) ?>">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="moreInfo" class="modal fade show">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Información Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {

        /*
         * 
         */
        $("#tabla").on('click', ".moreInfoBtn", function() {
            $url = "indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/moreInfoLog.php") ?>&idLog=" + $(this).data("id") + "&idTable=" + $(this).data("table");
            $(".modal-body").load($url);
        });

        /*
         * Evento de buscar en la tabla
         */

        $("#search").on('keyup', function() {
            json = {
                "page": "1",
                "cantPag": $("#select-cantidad").val(),
                "search": $(this).val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarLog.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                // Imprime los datos de la tabla
                tablePrint(res.DataT);
                //Imprime la paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));

            });
        });

        /*
         * Evento de cambiar de página
         */

        $(".pagination").on('click', ".page-item-list", function() {
            if ($(this).data("page") != 0) {
                json = {
                    "page": $(this).data("page"),
                    "cantPag": $("#select-cantidad").val(),
                    "search": $("#search").val()
                };

                $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarLog.php") ?>", json, function(data) {
                    console.log(data);
                    res = JSON.parse(data);
                    //imprime los datos en la tabla
                    
                    if (res.status) {
                        tablePrint(res.DataT);
                        //Imprime paginación
                        paginationPrint(res.DataP, parseInt(res.Cpage));
                    }
                });
            }
        })

        /*
         * Evento de select (cantidad de registros a mostrar)
         */

        $("#select-cantidad").on('change', function() {
            json = {
                "page": "1",
                "cantPag": $(this).val(),
                "search": $("#search").val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarLog.php") ?>", json, function(data) {
                res = JSON.parse(data);
                //imprime los datos en la tabla
                tablePrint(res.DataT);
                //Imprime paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));
            });
        });

    });
    /*
     * Imprime los datos en la tabla
     */
    function tablePrint(DataT) {
        $("#tabla").empty();

        DataT.forEach(function(data) {
            
            $("#tabla").append(
                `<tr>
                    <td>${data[1]}</td>
                    <td>${data[7]}</td>
                    <td>${data[2]}</td>
                    <td>${data[3]}</td>
                    <td>${data[5]}</td>
                    <td style='display:flex; justify-content:center;'>
                        <a href='#' class='moreInfoBtn' data-toggle='modal' data-target='#moreInfo' data-id='${data[0]}' data-table='${data[8]}'>
                            <i class='fas fa-info-circle'></i>
                        </a>
                    </td>
                </tr>`
            );
        });
    }
    /*
     * Imprime la paginación de la tabla
     */
    function paginationPrint(cantPag, actualPage) {
        $(".page-numbers").remove();
        updateBefore(actualPage - 1);
        updateNext(actualPage + 1, Math.ceil(cantPag));
        for (let i = 0; i < cantPag; i++) {
            if ((i + 1) == actualPage) {
                $("#page-next").before("<li class='page-item page-item-list page-numbers active' data-page='" + (i + 1) + "'><a class='page-link' href='#'>" + (i + 1) + "</a></li>")
            } else {
                $("#page-next").before("<li class='page-item page-item-list page-numbers' data-page='" + (i + 1) + "'><a class='page-link' href='#'>" + (i + 1) + "</a></li>");
            }

        }
    }

    /*
     * Actualiza los botones anterior y siguiente
     */
    function updateBefore(previousNumber) {
        if (previousNumber <= 0) {
            $("#page-previous").addClass("disabled");
            $("#page-previous").data("page", 0);
        } else {
            $("#page-previous").removeClass("disabled");
            $("#page-previous").data("page", previousNumber);
        }

    }

    function updateNext(nextNumber, cantPag) {
        if (nextNumber > cantPag) {
            $("#page-next").addClass("disabled");
            $("#page-next").data("page", cantPag);

        } else {
            $("#page-next").data("page", nextNumber);
            $("#page-next").removeClass("disabled");
        }

    }
</script>