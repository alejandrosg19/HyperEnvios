<?php


$idConductor = $_SESSION['id'];

if (isset($_POST['actualizarInfoConductor'])) {

    $nombreCompleto = trim($_POST['nombre']);
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $oldUrl = trim($_POST['url_hidden']);
    $archivo = $_FILES['imagen']['name'];


    $Cliente = new Cliente("", "", $email);
    $Administrador = new Administrador("", "", $email);
    $Despachador = new Despachador("", "", $email);
    $Conductor = new Conductor($idConductor);
    $Conductor->getInfoBasic();

    if ($Conductor->getCorreo() != $email && ($Cliente->existeCorreo() || $Administrador->existeCorreo() || $Despachador->existeCorreo() || $Conductor->existeNuevoCorreo($email))) {
        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {

        if (isset($archivo) && $archivo != "") {

            $archivo = date("Y_m_d_H_i_s_") . $archivo;

            $tipo = $_FILES['imagen']['type'];
            $tamano = $_FILES['imagen']['size'];
            $temp = $_FILES['imagen']['tmp_name'];
            $url = trim('static/img/users/' . $archivo);

            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 9000000))) {

                $class = "alert-danger";
                $msj = "El tipo de archivo no es valido o el tamañano es demasiado grande";
            } else {
                if (move_uploaded_file($temp, $url)) {

                    if (file_exists($oldUrl)) {
                        unlink(trim($oldUrl));
                    }

                    $copyConductor = $Conductor;
                    $Conductor = new Conductor($idConductor, $nombreCompleto, $email, md5($clave), $telefono, $url);

                    if ($clave != "") {
                        $resInsert = $Conductor->actualizarBasicClave();
                    } else {
                        $resInsert = $Conductor->actualizarBasic();
                        $Conductor -> setClave($copyConductor -> getClave());
                    }

                    if ($resInsert == 1) {

                        if ($_SESSION['rol'] == 3) {

                            /**
                             * Creo el objeto de log
                             */

                            $logConductor = new LogConductor("", getDateTime(), getBrowser(), getOS(), actualizarInfoConductor($copyConductor->getIdConductor(), $copyConductor->getNombre(), $copyConductor->getTelefono(), $copyConductor->getCorreo(), $copyConductor->getClave(), $copyConductor->getFoto(), $Conductor->getIdConductor(), $Conductor->getNombre(), $Conductor->getTelefono(), $Conductor->getCorreo(), $Conductor->getClave(), $Conductor->getFoto()), $_SESSION['id'], 12);
                            /**
                             * Inserto el registro del log
                             */
                            $logConductor->insertar();
                        }

                        $class = "alert-success";
                        $msj = "La información se ha actualizado correctamente.";
                    } else if ($resInsert == 0) {
                        $class = "alert-warning";
                        $msj = "No se ha modificado ningún valor.";
                    } else {
                        $class = "alert-danger";
                        $msj = "Ocurrió algo inesperado";
                    }
                } else {
                    $class = "alert-danger";
                    $msj = "Ocurrió algo inesperado";
                }
            }
        } else {

            $copyConductor = $Conductor;
            $Conductor = new Conductor($idConductor, $nombreCompleto, $email, md5($clave), $telefono, $oldUrl);

            if ($clave != "") {
                $resInsert = $Conductor->actualizarBasicClave();
            } else {
                $resInsert = $Conductor->actualizarBasic();
                $Conductor -> setClave($copyConductor -> getClave());
            }

            if ($resInsert == 1) {

                if ($_SESSION['rol'] == 3) {

                    /**
                     * Creo el objeto de log
                     */

                    $logConductor = new LogConductor("", getDateTime(), getBrowser(), getOS(), actualizarInfoConductor($copyConductor->getIdConductor(), $copyConductor->getNombre(), $copyConductor->getTelefono(), $copyConductor->getCorreo(), $copyConductor->getClave(), $copyConductor->getFoto(), $Conductor->getIdConductor(), $Conductor->getNombre(), $Conductor->getTelefono(), $Conductor->getCorreo(), $Conductor->getClave(), $Conductor->getFoto()), $_SESSION['id'], 12);
                    /**
                     * Inserto el registro del log
                     */
                    $logConductor->insertar();
                }

                $class = "alert-success";
                $msj = "La información se ha actualizado correctamente.";
            } else if ($resInsert == 0) {
                $class = "alert-warning";
                $msj = "No se ha modificado ningún valor.";
            } else {
                $class = "alert-danger";
                $msj = "Ocurrió algo inesperado";
            }
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
                        <h1>Actualizar información personal</h1>
                    </div>
                    <div class="row d-flex flex-row justify-content-center mb-4">
                        <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Conductor->getFoto() != "") ? $Conductor->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Conductor/actualizarInfoConductor.php") ?>&idConductor=<?php echo $Conductor->getIdConductor() ?>" method="POST" enctype="multipart/form-data">
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
                            <input type="hidden" name="url_hidden" value="<?php echo $Conductor->getFoto() ?> ">
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
                            <button class="btn btn-primary w-100" name="actualizarInfoConductor" type="submit"> Actualizar información </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>