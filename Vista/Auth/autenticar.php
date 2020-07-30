<?php

$email = $_POST['email'];
$pass = $_POST['pass'];


$admin = new Administrador("", "",  $email, $pass);
$clien = new Cliente("", "",  $email, $pass);
$conduc = new Conductor("","", $email, $pass);
$desp = new Despachador("","", $email, $pass);

if ($admin->autenticar()) {
    $_SESSION['id'] = $admin->getIdAdministrador();
    $_SESSION['rol'] = 1;

    header('Location: index.php?pid=' . base64_encode('Vista/Administrador/mainAdministrador.php'));
} else if ($clien->autenticar()) {
    if ($clien->getEstado() == 1) {
        $_SESSION['id'] = $clien->getIdCliente();
        $_SESSION['rol'] = 2;

        header('Location: index.php?pid=' . base64_encode('Vista/Cliente/mainCliente.php'));
    } else if ($clien -> getEstado() == -1) {
        header('Location: index.php?error=2');
    } else if ($clien -> getEstado() == 0) {
        header('Location: index.php?error=3');
    }
}else if($conduc -> autenticar()){
    
    if ($conduc -> getEstado() == 1) {
        $_SESSION['id'] = $conduc -> getIdConductor();
        $_SESSION['rol'] = 3;
        
        header('Location: index.php?pid=' . base64_encode('Vista/Conductor/mainConductor.php'));
    } else if ($conduc -> getEstado() == 0) {
        header('Location: index.php?error=3');
    }
}else if($desp -> autenticar()){
    if ($desp -> getEstado() == 1) {
        $_SESSION['id'] = $desp->getIdDespachador();
        $_SESSION['rol'] = 4;

        header('Location: index.php?pid=' . base64_encode('Vista/Despachador/mainDespachador.php'));
    } else if ($desp -> getEstado() == 0) {
        header('Location: index.php?error=3');
    }
} else {
    header('Location: index.php?error=1');
}
?>