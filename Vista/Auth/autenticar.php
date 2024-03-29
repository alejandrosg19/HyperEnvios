<?php

$email = $_POST['email'];
$pass = $_POST['pass'];


$admin = new Administrador("", "",  $email, $pass);
$clien = new Cliente("", "",  $email, $pass);
$conduc = new Conductor("", "", $email, $pass);
$desp = new Despachador("", "", $email, $pass);

if ($admin->autenticar()) {
    $_SESSION['id'] = $admin->getIdAdministrador();
    $_SESSION['rol'] = 1;

    /**
     * Registro de inicio de sesion
     */

    $logAdmin = new LogAdministrador("", getDateTime(), getBrowser(), getOS(), "", $_SESSION['id'], 1);
    $logAdmin->insertar();

    header('Location: index.php?pid=' . base64_encode('Vista/Administrador/mainAdministrador.php'));
} else if ($clien->autenticar()) {
    if ($clien->getEstado() == 1) {
        $_SESSION['id'] = $clien->getIdCliente();
        $_SESSION['rol'] = 2;

        /**
         * Registro de inicio de sesion
         */

        $logCliente = new LogCliente("", getDateTime(), getBrowser(), getOS(), "", $_SESSION['id'], 1);
        $logCliente -> insertar();

        header('Location: index.php?pid=' . base64_encode('Vista/Cliente/mainCliente.php'));
    } else if ($clien->getEstado() == -1) {
        header('Location: index.php?error=2');
    } else if ($clien->getEstado() == 0) {
        header('Location: index.php?error=3');
    }
} else if ($conduc->autenticar()) {

    if ($conduc->getEstado() == 1) {
        $_SESSION['id'] = $conduc->getIdConductor();
        $_SESSION['rol'] = 3;

        /**
         * Registro de inicio de sesion
         */

        $logConductor = new LogConductor("", getDateTime(), getBrowser(), getOS(), "", $_SESSION['id'], 1);
        $logConductor -> insertar();

        header('Location: index.php?pid=' . base64_encode('Vista/Conductor/mainConductor.php'));
    } else if ($conduc->getEstado() == 0) {
        header('Location: index.php?error=3');
    }
} else if ($desp->autenticar()) {
    if ($desp->getEstado() == 1) {
        $_SESSION['id'] = $desp->getIdDespachador();
        $_SESSION['rol'] = 4;

        $logDespachador = new LogDespachador("", getDateTime(), getBrowser(), getOS(), "", $_SESSION['id'], 1);
        $logDespachador -> insertar();

        header('Location: index.php?pid=' . base64_encode('Vista/Despachador/mainDespachador.php'));
    } else if ($desp->getEstado() == 0) {
        header('Location: index.php?error=3');
    }
} else {
    header('Location: index.php?error=1');
}
