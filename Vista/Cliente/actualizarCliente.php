<?php

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
    $cliente = new Cliente($idCliente);
    $cliente->getInfoBasic();

    if ($cliente->getCorreo() != $email && ($Conductor -> existeCorreo() || $Administrador -> existeCorreo() || $Despachador -> existeCorreo() || $cliente -> existeNuevoCorreo($email))) {
        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {

        $cliente = new Cliente($idCliente, $nombreCompleto, $email, $clave, $direccion, "", $estado);

        if ($clave != "") {
            $res = $cliente -> actualizarCClave();
        } else {
            $res = $cliente -> actualizar();
        }

        if ($res == 1) {
            $msj = "El cliente se ha actualizado satisfactoriamente.";
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
    $cliente = new Cliente($idCliente);
    $cliente->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" novalidate action="index.php?pid=<?php echo base64_encode("Vista/Cliente/actualizarCliente.php") ?>&idCliente=<?php echo $cliente->getIdCliente() ?>" method="POST">
                        <div class="form-title">
                            <h1>Actualizar Cliente</h1>
                        </div>
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input class="form-control" name="nombre" type="text" placeholder="Ingrese su nombre" value="<?php echo $cliente->getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" name="direcc" type="text" placeholder="Ingrese la dirección de residencia" value="<?php echo $cliente->getDireccion() ?>" required>
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
                                <option value="1" <?php echo ($cliente->getEstado() == 1) ? "selected" : ""; ?>>Activado</option>
                                <option value="0" <?php echo ($cliente->getEstado() == 0) ? "selected" : ""; ?>>Bloqueado</option>
                                <option value="-1" <?php echo ($cliente->getEstado() == -1) ? "selected" : ""; ?>>Desactivado</option>
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
                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo" value="<?php echo $cliente->getCorreo() ?>" required>
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