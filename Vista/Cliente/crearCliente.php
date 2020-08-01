<?php

if (isset($_POST['crearCliente'])) {

    $nombreCompleto = trim($_POST['nombre']) . " " . trim($_POST['apellido']);
    $direccion = $_POST['direcc'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    $Cliente = new Cliente("", $nombreCompleto, $email, $clave, $direccion, "", $estado);
    $Conductor = new Conductor("", "", $email);
    $Administrador = new Administrador("", "", $email);
    $Despachador = new Despachador("", "", $email);

    if ($Cliente -> existeCorreo() || $Conductor -> existeCorreo() || $Administrador -> existeCorreo() || $Despachador -> existeCorreo()) {

        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
        $res = $Cliente -> insertar();

        if ($res == 1) {

            if ($_SESSION['rol'] == 1) {
                /**
                 * Creo el objeto de log
                 */
                $logAdministrador = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), crearClienteNormal($nombreCompleto, $email, $direccion, md5($clave), "", $estado), $_SESSION['id'], 3);
                /**
                 * Inserto el registro del log
                 */
                $logAdministrador -> insertar();
            }

            $msj = "El cliente se ha creado satisfactoriamente";
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
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Cliente/crearCliente.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Crear Cliente</h1>
                        </div>
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" name="nombre" type="text" placeholder="Ingrese su nombre" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="apellido" type="text" placeholder="Ingrese su apellido" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el apellido.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" name="direcc" type="text" placeholder="Ingrese la dirección de residencia" required>
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
                                <option value="1">Activado</option>
                                <option value="0">Bloqueado</option>
                                <option value="-1">Desactivado</option>
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
                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el correo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" name="clave" type="password" value="" placeholder="Ingrese su contraseña" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la contraseña.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="crearCliente" type="submit"> Crear cliente </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>