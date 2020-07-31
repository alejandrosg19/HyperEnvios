<?php

if (isset($_POST['crearDespachador'])) {

    $nombreCompleto = trim($_POST['nombre']) . " " . trim($_POST['apellido']);
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    $Cliente = new Cliente("", "", $email);
    $Conductor = new Conductor("", "", $email);
    $Administrador = new Administrador("", "", $email);
    $Despachador = new Despachador("", $nombreCompleto, $email, $clave, $telefono, "", $estado);

    if ($Cliente -> existeCorreo() || $Conductor -> existeCorreo() || $Administrador -> existeCorreo() || $Despachador -> existeCorreo()) {

        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
        $res = $Despachador -> insertar();

        if ($res == 1) {
            $msj = "El despachador se ha creado satisfactoriamente";
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
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Despachador/crearDespachador.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Crear Despachador</h1>
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
                            <label>Teléfono</label>
                            <input class="form-control" name="telefono" type="number" placeholder="Ingrese el teléfono" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el telefono de contacto.
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
                            <button class="btn btn-primary w-100" name="crearDespachador" type="submit"> Crear Despachador </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>