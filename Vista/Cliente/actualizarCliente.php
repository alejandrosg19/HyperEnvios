<?php

$idCliente = "";
$idCliente = $_GET['idCliente'];


if (isset($_POST['actualizarCliente'])) {

    $nombreCompleto = trim($_POST['nombre']);
    $direccion = $_POST['direcc'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];


    $Conductor = new Conductor("", "", $email);
    $Administrador = new Administrador("", "", $email);
    $Despachador = new Despachador("", "", $email);
    $Cliente = new Cliente($idCliente);
    $Cliente->getInfoBasic();

    if ($Cliente->getCorreo() != $email && ($Conductor->existeCorreo() || $Administrador->existeCorreo() || $Despachador->existeCorreo() || $Cliente->existeNuevoCorreo($email))) {
        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
        $copyCliente = $Cliente;
        $Cliente = new Cliente($idCliente, $nombreCompleto, $email, $clave, $direccion, "", $estado);

        if ($clave != "") {
            $res = $Cliente->actualizarCClave();
        } else {
            $res = $Cliente->actualizar();
        }

        if ($res == 1) {

            $msj = "El administrador se ha actualizado satisfactoriamente.";

            if ($_SESSION['rol'] == 1) {
                /**
                 * Creo el objeto de log
                 */
                $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarCliente($copyCliente -> getIdCliente(), $copyCliente -> getNombre(), $copyCliente -> getDireccion(), $copyCliente -> getCorreo(), $copyCliente -> getClave(), $copyCliente -> getEstado(), $idCliente, $nombreCompleto, $direccion, $email, md5($clave), $estado), $_SESSION['id'], 5);
                /**
                 * Inserto el registro del log
                 */
                $logAdministrador -> insertar();
            }

            $msj = "El cliente se ha actualizado satisfactoriamente.";
            $class = "alert-success";

        } else if ($res == 0) {

            $msj = "No hubo ningún cambio.";
            $class = "alert-warning";

        } else {
            $msj = "Ocurrió algo inesperado, intente de nuevo.";
            $class = "alert-danger";
        }

        $Cliente = new Cliente($idCliente);
        $Cliente->getInfoBasic();
    }

    include "Vista/Main/alert.php";

} else {

    $Cliente = new Cliente($idCliente);
    $Cliente->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h1>Actualizar Cliente</h1>
                    </div>
                    <div class="row d-flex flex-row justify-content-center mb-4">
                        <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Cliente->getFoto() != "") ? $Cliente->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Cliente/actualizarCliente.php") ?>&idCliente=<?php echo $Cliente->getIdCliente() ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Ingrese su nombre" value="<?php echo $Cliente->getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" name="direcc" type="text" placeholder="Ingrese la dirección de residencia" value="<?php echo $Cliente->getDireccion() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la dirección de residencia.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control" required>
                                <option value="" selected disabled>-- Estado --</option>
                                <option value="1" <?php echo ($Cliente->getEstado() == 1) ? "selected" : ""; ?>>Activado</option>
                                <option value="0" <?php echo ($Cliente->getEstado() == 0) ? "selected" : ""; ?>>Bloqueado</option>
                                <option value="-1" <?php echo ($Cliente->getEstado() == -1) ? "selected" : ""; ?>>Desactivado</option>
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
                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo" value="<?php echo $Cliente->getCorreo() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el correo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" name="clave" type="password" value="" placeholder="Ingrese su contraseña">
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="actualizarCliente" type="submit"> Actualizar cliente </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>