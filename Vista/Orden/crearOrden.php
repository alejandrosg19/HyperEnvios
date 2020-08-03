<?php


$fecha_actual = date("Y-m-d");
//sumo 1 día
$fecha = date("Y-m-d", strtotime($fecha_actual . "+ 4 days"));
$fechaFin =  date("Y-m-d", strtotime($fecha_actual . "+ 2 month"));

?>
<div class="container-fluid mt-5">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10 form-bg-orden">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex flex-row justify-content-center">
                        <div class="form-title">
                            <h1>Crear Orden</h1>
                        </div>
                        <div class="col-12">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <label>Dirección de destino</label>
                                    <input id="direccionDestino" class="form-control needed" name="DirContacto" type="text" placeholder="Ingrese la dirección de destino">
                                </div>
                                <div class="col-4">
                                    <label>Persona de contacto</label>
                                    <input id="personaContacto" class="form-control needed" name="contacto" type="text" placeholder="Ingrese el nombre de la persona de contacto">
                                </div>
                                <div class="col-4">
                                    <label>Número de contacto</label>
                                    <input id="numeroContacto" class="form-control needed" name="NoContacto" type="number" placeholder="Ingrese el número de la persona de contacto">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4">
                                    <label>Día de recolección</label>
                                    <input id="dayRecoleccion" class="form-control needed" name="fechaRecoleccion" type="date" min="<?php echo $fecha ?>" max="<?php echo $fechaFin ?>">
                                </div>
                                <div class="col-4">
                                    <label>Fecha Estimación</label>
                                    <input id="fechaEstimacion" class="form-control" name="DirContacto" type="date" value="" disabled>
                                </div>
                                <div class="col-4">
                                    <label>Precio total</label>
                                    <input id="precioTotal" class="form-control" name="contacto" type="text" value="" disabled>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-2">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-10 form-bg-orden">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex flex-row justify-content-center">
                        <div class="form-title">
                            <h1>Crear Items</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button id="nuevoItem" class="btn-orden btn-style">Nuevo item</button>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="items-container">
                                <div class="row mt-4">
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-2">
                                                <label># Referencia</label>
                                            </div>
                                            <div class="col-2">
                                                <label>Nombre</label>
                                            </div>
                                            <div class="col-2">
                                                <label>Descripción</label>
                                            </div>
                                            <div class="col-2">
                                                <label>Peso (Kg)</label>
                                            </div>
                                            <div class="col-2">
                                                <label>Fabricante</label>
                                            </div>
                                            <div class="col-2">
                                                <label>Precio</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                    </div>

                                </div>
                                <div class="row mt-4">
                                    <div class="col-11">
                                        <div class="row aItems">
                                            <div class="col-2">
                                                <input class="form-control needed" name="referencia" type="text">
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control needed" name="nombre" type="nombre">
                                            </div>
                                            <div class="col-2">
                                                <textarea class="form-control needed" name="descripcion" id="" cols="30" rows="1"></textarea>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control pesoEvent needed" name="peso" type="number">
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control needed" name="Fabricante" type="text">
                                            </div>
                                            <div class="col-2 precioEventP">
                                                <input class="form-control precioEventC" type="number" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex flex-row justify-content-center align-items-center">
                                        <button class="eliminarItem btn btn-danger">x</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 d-flex flex-row justify-content-center">
                        <div class="col-5">
                            <button id="crearOrden" type="button" class="btn-style w-100">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {

        $('body').on('change', '.needed', function() {
            $(this).removeClass("inputDanger");
        });

        /*
         * Obtener fecha de estimación
         */
        $('#dayRecoleccion').on('change', function() {
            json = {
                "fechaR": $(this).val()
            };
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Orden/Ajax/getFechaEstimacion.php") ?>", json, function(data) {
                res = JSON.parse(data);
                if (res.status) {
                    $("#fechaEstimacion").val(res.data);
                }
            });
        });

        /*
         * Elimina item
         */
        $('.items-container').on('click', '.eliminarItem', function() {

            $(this).parent().parent().remove();
            arr = getAllPesos();

            json = {
                "pesos": arr
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Orden/Ajax/getPrecioTotalAjax.php") ?>", json, function(data) {

                res = JSON.parse(data);
                if (res.status) {
                    $("#precioTotal").val("$ " + res.data);
                } else {
                    $("#precioTotal").val("$ 0,0");
                }

            });

        });

        /*
         * Crea item
         */
        $('#nuevoItem').on('click', function() {
            $('.items-container').append(`
                <div class="row mt-4">
                    <div class="col-11">
                        <div class="row aItems">
                            <div class="col-2">
                                <input class="form-control needed" name="referencia" type="text">
                            </div>
                            <div class="col-2">
                                <input class="form-control needed" name="nombre" type="nombre">
                            </div>
                            <div class="col-2">
                                <textarea class="form-control needed" name="descripcion" id="" cols="30" rows="1"></textarea>
                            </div>
                            <div class="col-2">
                                <input class="form-control pesoEvent needed" name="peso" type="number">
                            </div>
                            <div class="col-2">
                                <input class="form-control needed" name="Fabricante" type="text">
                            </div>
                            <div class="col-2 precioEventP">
                                <input class="form-control precioEvent" type="number" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex flex-row justify-content-center align-items-center">
                        <button class="eliminarItem btn btn-danger">x</button>
                    </div>
                </div>
            `);
        });

        $('.items-container').on('change', '.pesoEvent', function() {
            elem = $(this);
            json = {
                "peso": elem.val()
            };
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Orden/Ajax/getPrecioItemAjax.php") ?>", json, function(data) {

                res = JSON.parse(data);
                if (res.status) {
                    elem.parent().parent().children(".precioEventP").children().val(res.data);
                    removeDangerClass(elem);
                } else {
                    crearAlert(res.status, res.msj);
                    cambiarPrecioUnidad(elem);
                    setDangerClass(elem);
                }
            });
        });

        /*
         * Evento para obtener el precio total
         */
        $('.items-container').on('change', '.pesoEvent', function() {

            elem = $(this);
            arr = getAllPesos();

            json = {
                "pesos": arr
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Orden/Ajax/getPrecioTotalAjax.php") ?>", json, function(data) {

                res = JSON.parse(data);
                if (res.status) {
                    $("#precioTotal").val("$ " + res.data);
                } else {
                    $("#precioTotal").val("$ 0,0");
                }

            });

        });

        /*
         * Evento al intentar enviar la información
         */

        $('#crearOrden').on('click', function() {
            bool = checkPeso();
            if (bool) {
                $newB = checkFillInputs();
                if ($newB) {
                    console.log(getItems());

                    json = {
                        "direccionDestino": $("#direccionDestino").val(),
                        "personaContacto": $("#personaContacto").val(),
                        "numeroContacto": $("#numeroContacto").val(),
                        "fechaRecoleccion": $("#dayRecoleccion").val(),
                        "fechaEstimacion": $("#fechaEstimacion").val(),
                        "items": getItems()
                    }

                    $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Orden/Ajax/crearOrdenAjax.php") ?>", json, function(data) {
                        console.log(data);
                        res = JSON.parse(data);

                    });

                } else {
                    crearAlert(false, "Por favor llene todos los campos");
                }
            }
        });

    });

    function checkFillInputs() {
        bool = true;
        $('.needed').each(function() {
            if ($(this).val().trim() == "") {
                bool = false;
                setDangerClass($(this));
            }
        });
        return bool;
    }



    /*
     * Obtener un array con la informacion de todos los items
     */
    function getItems() {
        arrElem = new Array();
        arr = $(".aItems");
        console.log(arr);
        for (i = 0; i < arr.length; i++) {
            divChild = $(arr[i]).children();
            arrRow = new Array()
            for (j = 0; j < divChild.length - 1; j++) {
                elem = $(divChild[j]).children();
                arrRow.push($(elem[0]).val());
            }
            arrElem.push(arrRow);
        }

        return arrElem;
    }

    /*
     * Revisa si todos los pesos son menores o iguales al peso limite de la compañia 
     */
    function checkPeso() {

        bool = true;

        $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Orden/Ajax/getMaxPrecioAjax.php") ?>", function(data) {
            res = JSON.parse(data);
            if (res.status) {
                bool = checkEachPeso(res.data, false, res.msj);
            }
        });

        return bool;
    }


    /*
     * Revisa si algun peso es mayor al peso limite
     */
    function checkEachPeso(data, bool, msj) {
        bool = false;
        $(".pesoEvent").each(function() {
            if (parseInt($(this).val()) > parseInt(data)) {
                setDangerClass($(this));
                crearAlert(bool, msj)
                bool = true;
            }
        });

        return bool;
    }

    /*
     * Coloca la clase inputDanger en algun elemento
     */

    function setDangerClass(elem) {
        elem.addClass("inputDanger");
    }

    /*
     * Remueve la clase inputDanger
     */
    function removeDangerClass(elem) {
        elem.removeClass("inputDanger")
    }

    /*
     * Cambia el precio del item a vacio en caso tal de que el peso sea mayor a nuestro limite 
     */

    function cambiarPrecioUnidad(elem) {
        elem.parent().parent().children(".precioEventP").children().val("");
    }

    /*
     * Función para obtener todos los pesos de los objetos
     */
    function getAllPesos() {
        $pesos = new Array();
        $(".pesoEvent").each(function() {
            if ($(this).val() != "") {
                $pesos.push(parseInt($(this).val()));
            }
        });
        return $pesos;
    }

    /*
     * Genera una alert dinamica
     */
    function crearAlert(status, msj) {
        let className = "";

        if (status) {
            className = "alert-success";
        } else {
            className = "alert-danger";
        }

        $("#alert-ajax").html(`<div class="alert ${className} alert-dismissible fade show" role="alert" style="top: 0px;position: fixed; z-index:20; margin-top : 50px; transform: translateX(-50%); margin-left: 50%">
                        <span id="alert-ajax-msj">${msj}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);

    }
</script>