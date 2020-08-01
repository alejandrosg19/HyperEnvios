<?php

if (isset($_POST['crearPrecio'])) {

    $precioMinimo = $_POST['precioMin'];
    $precioMaximo = $_POST['precioMax'];
    $precio = $_POST['precio'];

    $Precio = new Precio("", $precioMinimo, $precioMaximo, $precio);

    if ($Precio -> existePeso()) {

        $msj = "Alguno de los pesos suministrados o ambos ya se encuentran registrados.";
        $class = "alert-danger";
    } else {
        $res = $Precio -> insertar();

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
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Precio/crearPrecio.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Crear Precio</h1>
                        </div>
                        <div class="form-group">
                            <label>Peso Minimo</label>
                            <input class="form-control" name="precioMin" type="Number" min="1" placeholder="Ingrese el peso minimo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el peso minimo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Peso Maximo</label>
                            <input class="form-control" name="precioMax" type="Number" min="1" placeholder="Ingrese el peso maximo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el peso maximo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input class="form-control" name="precio" type="Number" min="1" placeholder="Ingrese el perso maximo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el precio para ese peso.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="crearPrecio" type="submit"> Crear precio </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>