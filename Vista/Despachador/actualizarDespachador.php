<?php
$idDespachador = "";
if(isset($_GET['idDespachador'])){
    $idDespachador = $_GET['idDespachador'];
}else{
    $idDespachador = $_SESSION["id"];
}


if (isset($_POST['actualizarDespachador'])) {

    $nombreCompleto = trim($_POST['nombre']);
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];


    $Cliente = new Cliente("", "", $email);
    $Administrador = new Administrador("", "", $email);
    $Despachador = new Despachador($idDespachador);
    $Conductor = new Conductor("","",$email);
    $Despachador -> getInfoBasic();

    if ($Despachador -> getCorreo() != $email && ($Cliente -> existeCorreo() || $Administrador -> existeCorreo() || $Conductor -> existeCorreo() || $Despachador -> existeNuevoCorreo($email))) {
        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
        $copyDespachador = $Despachador;
        $Despachador = new Despachador($idDespachador, $nombreCompleto, $email, $clave, $telefono, "", $estado);

        if ($clave != "") {
            $res = $Despachador -> actualizarCClave();
        } else {
            $res = $Despachador -> actualizar();
        }

        if ($res == 1) {

            if ($_SESSION['rol'] == 1) {
                /**
                 * Creo el objeto de log
                 */
                $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarDespachador($copyDespachador -> getIdDespachador(), $copyDespachador -> getNombre(), $copyDespachador -> getTelefono(), $copyDespachador -> getCorreo(), $copyDespachador -> getClave(), $copyDespachador -> getEstado(), $idDespachador, $nombreCompleto, $telefono, $email, md5($clave), $estado), $_SESSION['id'], 11);
                /**
                 * Inserto el registro del log
                 */
                $logAdministrador -> insertar();
            }

            $msj = "El despachador se ha actualizado satisfactoriamente.";
            $class = "alert-success";
        } else if ($res == 0) {
            $msj = "No hubo ningún cambio.";
            $class = "alert-warning";
        } else {
            $msj = "Ocurrió algo inesperado, intente de nuevo.";
            $class = "alert-danger";
        }
    }

    include "Vista/Main/alert.php";
} else {
    $Despachador = new Despachador($idDespachador);
    $Despachador->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Despachador/actualizarDespachador.php") ?>&idDespachador=<?php echo $Despachador->getIdDespachador() ?>" method="POST">
                        <div class="form-title">
                            <h1>Actualizar Despachador</h1>
                        </div>
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Ingrese su nombre" value="<?php echo $Despachador -> getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input class="form-control" name="telefono" type="text" placeholder="Ingrese el teléfono de contacto" value="<?php echo $Despachador -> getTelefono() ?>" required>
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
                                <option value="1" <?php echo ($Despachador -> getEstado() == 1) ? "selected" : ""; ?>>Activado</option>
                                <option value="0" <?php echo ($Despachador -> getEstado() == 0) ? "selected" : ""; ?>>Bloqueado</option>
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
                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo" value="<?php echo $Despachador -> getCorreo() ?>" required>
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
                            <button class="btn btn-primary w-100" name="actualizarDespachador" type="submit"> Actualizar Despachador </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>