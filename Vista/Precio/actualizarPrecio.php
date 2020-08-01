<?php

$idPrecio = $_GET['idPrecio'];

if (isset($_POST['actualizarPrecio'])) {

    $pesoMinimo = $_POST['pesoMinimo'];
    $pesoMaximo = $_POST['pesoMaximo'];
    $precio = $_POST['precio'];

    $Precio = new Precio($idPrecio, $pesoMinimo, $pesoMaximo, $precio);
    $res = $Precio->actualizar();

    if ($res == 1) {
        $msj = "El precio se ha actualizado satisfactoriamente.";
        $class = "alert-success";
    } else if ($res == 0) {
        $msj = "No hubo ningún cambio.";
        $class = "alert-warning";
    } else {
        $msj = "Ocurrió algo inesperado, intente de nuevo.";
        $class = "alert-danger";
    }
    include "Vista/Main/alert.php";
} else {
    $Precio = new Precio($idPrecio);
    $Precio->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h1>Actualizar Precio</h1>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Precio/actualizarPrecio.php") ?>&idPrecio=<?php echo $Precio->getIdPrecio() ?>" method="POST">
                        <div class="form-group">
                            <label>Precio Minimo</label>
                            <input class="form-control" name="pesoMinimo" type="number" placeholder="Ingrese el peso minimo" value="<?php echo $Precio->getPesoMinimo() ?>" required readonly="readonly">
                            <div class="invalid-feedback">
                                Por favor ingrese el peso minimo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Precio Maximo</label>
                            <input class="form-control" name="pesoMaximo" type="number" placeholder="Ingrese el peso maximo" value="<?php echo $Precio->getPesoMaximo() ?>" required readonly="readonly">
                            <div class="invalid-feedback">
                                Por favor ingrese el peso maximo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input class="form-control" name="precio" type="number" placeholder="Ingrese el precio" value="<?php echo $Precio->getPrecio() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el precio.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="actualizarPrecio" type="submit"> Actualizar precio </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>