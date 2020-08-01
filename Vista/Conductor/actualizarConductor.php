<?php

$idConductor = "";
if (isset($_GET['idConductor'])) {
    $idConductor = $_GET['idConductor'];
} else {
    $idConductor = $_SESSION["id"];
}


if (isset($_POST['actualizarConductor'])) {

    $nombreCompleto = trim($_POST['nombre']);
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];


    $Cliente = new Cliente("", "", $email);
    $Administrador = new Administrador("", "", $email);
    $Despachador = new Despachador("", "", $email);
    $Conductor = new Conductor($idConductor);
    $Conductor->getInfoBasic();

    if ($Conductor->getCorreo() != $email && ($Cliente->existeCorreo() || $Administrador->existeCorreo() || $Despachador->existeCorreo() || $Conductor->existeNuevoCorreo($email))) {
        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
<<<<<<< HEAD

        $updateImg = 0;
        $rutaRemota = $Conductor->getFoto();
        if ($_FILES["imagen"]["name"] != "") {
            $updateImg = 1;
            if ($_FILES["imagen"]["type"] == "image/png" or $_FILES["imagen"]["type"] == "image/jpeg") {
                $updateImg = 2;
                $rutaLocal = $_FILES["imagen"]["tmp_name"];
                $tipo = $_FILES["imagen"]["type"];
                $tiempo = new DateTime();
                $rutaRemota = "Static/img/users/" . $tiempo->getTimestamp() . (($tipo == "image/png") ? ".png" : ".jpeg");
=======
        $copyConductor = $Conductor;
        $Conductor = new Conductor($idConductor, $nombreCompleto, $email, $clave, $telefono, "", $estado);
>>>>>>> 69009d682230703c4e8f656ca71fd1f85874e18f

                $ConductorAUX = new Conductor($idConductor, $nombreCompleto, $email, $clave, $telefono, "", $estado);
                copy($rutaLocal, $rutaRemota);
                $ConductorAUX->getInfoBasic();

                if ($ConductorAUX->getFoto() != "") {
                    unlink($ConductorAUX->getFoto());
                }
            }
        }

        if ($updateImg == 1) {
            $Conductor = new Conductor($idConductor);
            $Conductor->getInfoBasic();
        } else {
            $Conductor = new Conductor($idConductor, $nombreCompleto, $email, $clave, $telefono, $rutaRemota, $estado);
        }


        if ($clave != "" and $updateImg != 1) {
            $res = $Conductor->actualizarCClave();
        } else if ($updateImg != 1) {
            $res = $Conductor->actualizar();
        }

        if ($updateImg == 1) {
            $res = 2;
        } else if ($updateImg == 2) {
            $res = 1;
        }

        if ($res == 1) {
<<<<<<< HEAD
            $msj = "El administrador se ha actualizado satisfactoriamente.";
=======

            if ($_SESSION['rol'] == 1) {
                /**
                 * Creo el objeto de log
                 */
                $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarConductor($copyConductor -> getIdConductor(), $copyConductor -> getNombre(), $copyConductor -> getTelefono(), $copyConductor -> getCorreo(), $copyConductor -> getClave(), $copyConductor -> getEstado(), $idConductor, $nombreCompleto, $telefono, $email, md5($clave), $estado), $_SESSION['id'], 8);
                /**
                 * Inserto el registro del log
                 */
                $logAdministrador -> insertar();
            }

            $msj = "El conductor se ha actualizado satisfactoriamente.";
>>>>>>> 69009d682230703c4e8f656ca71fd1f85874e18f
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
    $Conductor = new Conductor($idConductor);
    $Conductor->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h1>Actualizar Conductor</h1>
                    </div>
                    <div class="row d-flex flex-row justify-content-center mb-4">
                        <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Conductor->getFoto() != "") ? $Conductor->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Conductor/actualizarConductor.php") ?>&idConductor=<?php echo $Conductor->getIdConductor() ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Ingrese su nombre" value="<?php echo $Conductor->getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input class="form-control" name="telefono" type="text" placeholder="Ingrese el teléfono de contacto" value="<?php echo $Conductor->getTelefono() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el teléfono de contacto.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control" required>
                                <option value="" selected disabled>-- Estado --</option>
                                <option value="1" <?php echo ($Conductor->getEstado() == 1) ? "selected" : ""; ?>>Activado</option>
                                <option value="0" <?php echo ($Conductor->getEstado() == 0) ? "selected" : ""; ?>>Bloqueado</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un estado.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo" value="<?php echo $Conductor->getCorreo() ?>" required>
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
                            <button class="btn btn-primary w-100" name="actualizarConductor" type="submit"> Actualizar conductor </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>