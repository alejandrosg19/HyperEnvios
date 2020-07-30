<?php
    session_start();
    date_default_timezone_set('America/Bogota');

    require_once "Negocio/Administrador.php";
    require_once "Negocio/Cliente.php";
    require_once "Negocio/Conductor.php";
    require_once "Negocio/Despachador.php";
    
    $pid = null;

    if(isset($_GET['cerrarSesion'])){
        session_destroy();
        $_SESSION = [];
    }
    if(isset($_GET['pid'])){
        $pid = base64_decode($_GET['pid']);
    }

    include "Vista/Main/header.php";
    
    $enter = Array('Vista/Auth/autenticar.php', 'Vista/Auth/clienteActivarCuenta.php');

    if(isset($pid)){

        if(isset($_SESSION['id'])){
            if($_SESSION['rol'] == 1){
                include "Vista/Administrador/navAdministrador.php";
                include $pid;
            }else if($_SESSION['rol'] == 2){
                include "Vista/Cliente/navCliente.php";
                include $pid;
                include "Vista/Cliente/footerCliente.php";
            }else if($_SESSION['rol'] == 3){
                include "Vista/Conductor/navConductor.php";
                include $pid;
            }else if($_SESSION['rol'] == 4){
                include "Vista/Despachador/navDespachador.php";
                include $pid;
            }else{
                include "Vista/Main/mainPage.php";/*Toca cambiarlo*/
            }
        }else if(in_array($pid, $enter)){
            include $pid;
        }else{
            header("Location: index.php");
        }

    }else{
        include "Vista/Main/mainPage.php";
        
        if(isset($_SESSION['id'])){
            session_destroy();
            $_SESSION = [];
        }
        
    }
    
    include "Vista/Main/footer.php";
?>