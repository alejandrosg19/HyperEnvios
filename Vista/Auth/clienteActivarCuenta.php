<?php 
$email = base64_decode($_GET['email']);
$cod = base64_decode($_GET['cod']);

$cliente = new Cliente("","",$email, "", "", "", "",$cod);

if($cliente -> verificarActivacion($cod)){
    header("Location: index.php?activacion=1");
}else{
    header("Location: index.php?activacion=2");
}
