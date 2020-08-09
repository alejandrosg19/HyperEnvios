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
require_once "Negocio/Orden.php";
require_once "Negocio/Precio.php";
require_once "Negocio/AccionEstado.php";
require_once "Negocio/Estado.php";
require_once "Negocio/EstadoConductor.php";
require_once "Negocio/EstadoDespachador.php";
require_once "Negocio/ComentarioConductor.php";
require_once "Negocio/ComentarioDespachador.php";
require_once "Negocio/ComentarioCliente.php";
require_once "Negocio/Precio.php";
require_once "Negocio/Cita.php";
require_once "Negocio/Item.php";
require_once "Negocio/EstadoCliente.php";

if ($_GET['pid']) {
    $pid = base64_decode($_GET['pid']);
    include $pid;
}
