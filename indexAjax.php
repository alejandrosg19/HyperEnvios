<?php
session_start();

date_default_timezone_set('America/Bogota');

require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Conductor.php";
require_once "Negocio/Despachador.php";

if ($_GET['pid']) {
    $pid = base64_decode($_GET['pid']);
    include $pid;
}
