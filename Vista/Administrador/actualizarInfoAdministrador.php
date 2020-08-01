<?php

$idAdministrador = "";
if (isset($_GET['idAdministrador'])) {
    $idAdministrador = $_GET['idAdministrador'];
} else {
    $idAdministrador = $_SESSION["id"];
}


if (isset($_POST['actualizarAdministrador'])) {

    $nombreCompleto = trim($_POST['nombre']);
    $email = $_POST['email'];
    $clave = $_POST['clave'];



    $Conductor = new Conductor("", "", $email);
    $Administrador = new Administrador($idAdministrador);
    $Despachador = new Despachador("", "", $email);
    $cliente = new Cliente("", "", $email);
    $Administrador->getInfoBasic();

    if ($Administrador->getCorreo() != $email && ($Conductor->existeCorreo() || $cliente->existeCorreo() || $Despachador->existeCorreo() || $Administrador->existeNuevoCorreo($email))) {
        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
        $updateImg = 0;
        $rutaRemota = $Administrador->getFoto();
        if ($_FILES["imagen"]["name"] != "") {
            $updateImg = 1;
            if ($_FILES["imagen"]["type"] == "image/png" or $_FILES["imagen"]["type"] == "image/jpeg") {
                $updateImg = 2;
                $rutaLocal = $_FILES["imagen"]["tmp_name"];
                $tipo = $_FILES["imagen"]["type"];
                $tiempo = new DateTime();
                $rutaRemota = "Static/img/users/" . $tiempo->getTimestamp() . (($tipo == "image/png") ? ".png" : ".jpeg");

                $AdministradorAUX = new Administrador($idAdministrador, $nombreCompleto, $email, $clave, "");
                copy($rutaLocal, $rutaRemota);
                $AdministradorAUX->getInfoBasic();

                if ($AdministradorAUX->getFoto() != "") {
                    unlink($AdministradorAUX->getFoto());
                }
            }
        }

        if ($updateImg == 1) {
            $Administrador = new Administrador($idAdministrador);
            $Administrador->getInfoBasic();
        } else {
            $Administrador = new Administrador($idAdministrador, $nombreCompleto, $email, $clave, $rutaRemota);
        }


        if ($clave != "" and $updateImg != 1) {
            $res = $Administrador->actualizarCClave();
        } else if ($updateImg != 1) {
            $res = $Administrador->actualizar();
        }

        if ($updateImg == 1) {
            $res = 2;
        } else if ($updateImg == 2) {
            $res = 1;
        }

        if ($res == 1) {
            $msj = "El administrador se ha actualizado satisfactoriamente.";
            $class = "alert-success";
        } else if ($res == 0) {
            $msj = "No hubo ningún cambio.";
            $class = "alert-warning";
        } else if ($res == 2) {
            $msj = "Error en el tipo de archivo.";
            $class = "alert-danger";
        } else {
            $msj = "Ocurrió algo inesperado, intente de nuevo.";
            $class = "alert-danger";
        }
    }

    include "Vista/Main/alert.php";
} else {
    $Administrador = new Administrador($idAdministrador);
    $Administrador->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h1>Actualizar Administrador</h1>
                    </div>
                    <div class="row d-flex flex-row justify-content-center mb-4">
                        <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Administrador->getFoto() != "") ? $Administrador->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Administrador/actualizarAdministrador.php") ?>&idAdministrador=<?php echo $Administrador->getIdAdministrador() ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Ingrese su nombre" value="<?php echo $Administrador->getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo" value="<?php echo $Administrador->getCorreo() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el correo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group border-0">
                            <label for="foto">Cargar Foto</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input name="imagen" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Cargar</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" name="clave" type="password" value="" placeholder="Ingrese su contraseña">
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="actualizarAdministrador" type="submit"> Actualizar administrador </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>