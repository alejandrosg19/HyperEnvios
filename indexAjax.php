<?php
session_start();

date_default_timezone_set('America/Bogota');

require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Conductor.php";
require_once "Negocio/Despachador.php";
require_once "Negocio/Log.php";
require_once "Negocio/LogAdministrador.php";
require_once "Negocio/LogCliente.php";
require_once "Negocio/LogConductor.php";
require_once "Negocio/LogDespachador.php";
require_once "Negocio/Accion.php";
require_once "Helpers/logHelper.php";

if ($_GET['pid']) {
    $pid = base64_decode($_GET['pid']);
    include $pid;
}
