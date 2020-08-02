<?php


$idAdministrador = $_SESSION['id'];

if (isset($_POST['actualizarInfoAdministrador'])) {

    $nombreCompleto = trim($_POST['nombre']);
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $oldUrl = trim($_POST['url_hidden']);
    $archivo = $_FILES['imagen']['name'];


    $Cliente = new Cliente("", "", $email);
    $Administrador = new Administrador($idAdministrador);
    $Despachador = new Despachador("", "", $email);
    $Conductor = new Conductor("", "", $email);
    $Administrador->getInfoBasic();

    if ($Administrador->getCorreo() != $email && ($Conductor->existeCorreo() || $Cliente->existeCorreo() || $Despachador->existeCorreo() || $Administrador->existeNuevoCorreo($email))) {
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

                    $copyAdministrador = $Administrador;
                    $Administrador = new Administrador($idAdministrador, $nombreCompleto, $email, md5($clave), $url);

                    if ($clave != "") {
                        $resInsert = $Administrador->actualizarBasicClave();
                    } else {
                        $resInsert = $Administrador->actualizarBasic();
                        $Administrador->setClave($copyAdministrador->getClave());
                    }

                    if ($resInsert == 1) {

                        if ($_SESSION['rol'] == 1) {

                            /**
                             * Creo el objeto de log
                             */

                            $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarInfoAdministrador($copyAdministrador->getIdAdministrador(), $copyAdministrador->getNombre(), $copyAdministrador->getCorreo(), $copyAdministrador->getClave(), $copyAdministrador->getFoto(), $Administrador->getIdAdministrador(), $Administrador->getNombre(), $Administrador->getCorreo(), $Administrador->getClave(), $Administrador->getFoto()), $_SESSION['id'], 12);
                            /**
                             * Inserto el registro del log
                             */
                            $logAdministrador->insertar();
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

            $copyAdministrador = $Administrador;
            $Administrador = new Administrador($idAdministrador, $nombreCompleto, $email, md5($clave), $oldUrl);

            if ($clave != "") {
                $resInsert = $Administrador->actualizarBasicClave();
            } else {
                $resInsert = $Administrador->actualizarBasic();
                $Administrador->setClave($copyAdministrador->getClave());
            }

            if ($resInsert == 1) {

                if ($_SESSION['rol'] == 1) {

                    /**
                     * Creo el objeto de log
                     */

                    $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), actualizarInfoAdministrador($copyAdministrador->getIdAdministrador(), $copyAdministrador->getNombre(), $copyAdministrador->getCorreo(), $copyAdministrador->getClave(), $copyAdministrador->getFoto(), $Administrador->getIdAdministrador(), $Administrador->getNombre(), $Administrador->getCorreo(), $Administrador->getClave(), $Administrador->getFoto()), $_SESSION['id'], 12);
                    /**
                     * Inserto el registro del log
                     */
                    $logAdministrador->insertar();
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
                        <h1>Actualizar información personal</h1>
                    </div>
                    <div class="row d-flex flex-row justify-content-center mb-4">
                        <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($Administrador->getFoto() != "") ? $Administrador->getFoto() : "static/img/web/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Administrador/actualizarInfoAdministrador.php") ?>&idAdministrador=<?php echo $Administrador->getIdAdministrador() ?>" method="POST" enctype="multipart/form-data">
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
                            <input type="hidden" name="url_hidden" value="<?php echo $Administrador->getFoto() ?> ">
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
                            <button class="btn btn-primary w-100" name="actualizarInfoAdministrador" type="submit"> Actualizar información </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>