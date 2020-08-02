<?php
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
                            <div class="row">
                                <div class="col-4">
                                    <label>Dirección de destino</label>
                                    <input class="form-control" name="DirContacto" type="text">
                                </div>
                                <div class="col-4">
                                    <label>Persona de contacto</label>
                                    <input class="form-control" name="contacto" type="text">
                                </div>
                                <div class="col-4">
                                    <label>Número de contacto</label>
                                    <input class="form-control" name="NoContacto" type="number">
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
                            <button class="btn-orden btn-style">Nuevo item</button>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="items-container">
                            <div class="row mt-4">
                                    <div class="col-2">
                                        <label># Referencia</label>
                                    </div>
                                    <div class="col-2">
                                        <label>Nombre</label>
                                    </div>
                                    <div class="col-2">
                                        <label>Descripción</label>
                                    </div>
                                    <div class="col-1">
                                        <label>Peso</label>
                                    </div>
                                    <div class="col-2">
                                        <label>Fabricante</label>
                                    </div>
                                    <div class="col-2">
                                        <label>Precio</label>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-2">
                                        <input class="form-control" name="referencia" type="text">
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" name="nombre" type="nombre">
                                    </div>
                                    <div class="col-2">
                                        <textarea class="form-control" name="descripcion" id="" cols="30" rows="1" ></textarea>
                                    </div>
                                    <div class="col-1">
                                        <input class="form-control" name="peso" type="number">
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" name="Fabricante" type="text">
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" type="Precio" type="number">
                                    </div>
                                    <div class="col-1 d-flex flex-row justify-content-center">
                                        <button class="btn btn-danger">x</button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-2">
                                        <input class="form-control" name="referencia" type="text">
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" name="nombre" type="nombre">
                                    </div>
                                    <div class="col-2">
                                        <textarea class="form-control" name="descripcion" id="" cols="30" rows="1" ></textarea>
                                    </div>
                                    <div class="col-1">
                                        <input class="form-control" name="peso" type="number">
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" name="Fabricante" type="text">
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control" type="Precio" type="number">
                                    </div>
                                    <div class="col-1 d-flex flex-row justify-content-center">
                                        <button class="btn btn-danger">x</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 d-flex flex-row justify-content-center">
                        <div class="col-5">
                            <button class="btn-style w-100">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>