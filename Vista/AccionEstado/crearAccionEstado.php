<?php

if (isset($_POST['crearAccionEstado'])) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $AccionEstado = new AccionEstado("", $nombre, $descripcion);

    if ($AccionEstado -> existeAccion()) {

        $msj = "El nombre de la acción ya se encuentra registrado.";
        $class = "alert-danger";
    } else {
        $res = $AccionEstado -> insertar();

        if ($res == 1) {
            $msj = "El precio se ha creado satisfactoriamente";
            $class = "alert-success";
        } else {
            $msj = "Ocurrió algo inesperado, intente de nuevo.";
            $class = "alert-danger";
        }
    }

    include "Vista/Main/alert.php";
}
?>
<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/AccionEstado/crearAccionEstado.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Crear Accion</h1>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" min="1" placeholder="Ingrese el nombre de la accion" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre de la acción.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <input class="form-control" name="descripcion" type="text" min="1" placeholder="Ingrese la descripcion de la acción" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la descripción de la acción.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="crearAccionEstado" type="submit"> Crear acción </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>