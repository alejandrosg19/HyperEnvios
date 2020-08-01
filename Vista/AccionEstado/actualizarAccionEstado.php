<?php

$idAccionEstado = $_GET['idAccionEstado'];

if (isset($_POST['actualizarAccionEstado'])) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $accionEstado = new AccionEstado($idAccionEstado, $nombre, $descripcion);

    $res = 1; 
    if($accionEstado -> existeAccion()){
        $res = 2;
        $accionEstado -> getInfoBasic();
    }else{
        $res = $accionEstado->actualizar();
    }
    

    if ($res == 1) {
        $msj = "El Accion se ha actualizado satisfactoriamente.";
        $class = "alert-success";
    } else if ($res == 0) {
        $msj = "No hubo ningún cambio.";
        $class = "alert-warning";
    } else if($res == 2){
        $msj = "El nombre de la acción ya se encuentra registrado.";
        $class = "alert-danger";
    }else {
        $msj = "Ocurrió algo inesperado, intente de nuevo.";
        $class = "alert-danger";
    }
    include "Vista/Main/alert.php";
} else {
    $accionEstado = new AccionEstado($idAccionEstado);
    $accionEstado->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h1>Actualizar Accion</h1>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/AccionEstado/actualizarAccionEstado.php") ?>&idAccionEstado=<?php echo $accionEstado->getIdAccion() ?>" method="POST">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Ingrese el nombre de la accion" value="<?php echo $accionEstado->getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre de la acción.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input class="form-control" name="descripcion" type="text" placeholder="Ingrese la descripcion de la accion" value="<?php echo $accionEstado->getDescripcion() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la descripción de la acción.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="actualizarAccionEstado" type="submit"> Actualizar acción </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>