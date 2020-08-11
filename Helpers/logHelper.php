<?php 

function getOS(){

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $plataformas = array(
        'Windows 10' => 'Windows NT 10.0+',
        'Windows 8.1' => 'Windows NT 6.3+',
        'Windows 8' => 'Windows NT 6.2+',
        'Windows 7' => 'Windows NT 6.1+',
        'Windows Vista' => 'Windows NT 6.0+',
        'Windows XP' => 'Windows NT 5.1+',
        'Windows 2003' => 'Windows NT 5.2+',
        'Windows' => 'Windows otros',
        'iPhone' => 'iPhone',
        'iPad' => 'iPad',
        'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
        'Mac otros' => 'Macintosh',
        'Android' => 'Android',
        'BlackBerry' => 'BlackBerry',
        'Linux' => 'Linux',
    );
    foreach ($plataformas as $plataforma => $pattern) {
        if (preg_match('/(?i)' . $pattern . '/', $user_agent))
            return $plataforma;
    }
    return 'Otras';
}



function getBrowser(){

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($user_agent, 'MSIE') !== FALSE)
        return 'Internet explorer';
    elseif (strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
        return 'Microsoft Edge';
    elseif (strpos($user_agent, 'Trident') !== FALSE) //IE 11
        return 'Internet explorer';
    elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
        return "Opera Mini";
    elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
        return "Opera";
    elseif (strpos($user_agent, 'Firefox') !== FALSE)
        return 'Mozilla Firefox';
    elseif (strpos($user_agent, 'Chrome') !== FALSE)
        return 'Google Chrome';
    elseif (strpos($user_agent, 'Safari') !== FALSE)
        return "Safari";
    else
        return 'Otro';
}

function getDateTime(){
    $date = new DateTime();
    return $date->format('Y-m-d H:i:s');
}

function crearConductorNormal($nombre, $email, $telefono, $clave, $foto, $estado){
    $str = "Nombre:::". $nombre .
    ";;;Email:::" . $email .
    ";;;Telefono:::" . $telefono .
    ";;;Clave:::" . $clave .
    ";;;Foto:::" . $foto .
    ";;;Estado:::" . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));
    return $str;
}

function crearDespachadorNormal($nombre, $email, $telefono, $clave, $foto, $estado){
    $str = "Nombre:::". $nombre .
    ";;;Email:::" . $email .
    ";;;Telefono:::" . $telefono .
    ";;;Clave:::" . $clave .
    ";;;Foto:::" . $foto .
    ";;;Estado:::" . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));
    return $str;
}

function crearClienteNormal($nombre, $email, $direccion, $clave, $foto, $estado){
    $str = "Nombre:::". $nombre .
    ";;;Email:::" . $email .
    ";;;Direccion:::" . $direccion .
    ";;;Clave:::" . $clave .
    ";;;Foto:::" . $foto .
    ";;;Estado:::" . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));
    return $str;
}

function actualizarEstado($rol, $idCliente, $nombre, $estado){
    $str = "Rol:::" . $rol .
    ";;;Identificación:::" . $idCliente .
    ";;;Nombre:::" . $nombre .
    ";;;Estado:::" .  (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));
    return $str;
}

function actualizarCliente($idClienteC, $nombreC, $direccionC, $emailC, $claveC, $estadoC, $idCliente, $nombre, $direccion, $email, $clave, $estado){
    $str = "idCliente:::" . $idClienteC .
    ";;;Nombre:::" . $nombreC . 
    ";;;Dirección:::" . $direccionC . 
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Estado:::" . (($estadoC == 1)? "Activado" : (($estadoC == 0)? "Bloqueado" : "Desactivado")).
    "&&&idCliente:::" . $idCliente .
    ";;;Nombre:::" . $nombre . 
    ";;;Dirección:::" . $direccion . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Estado:::" . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));

    return $str;
}

function actualizarConductor($idConductorC, $nombreC, $telefonoC, $emailC, $claveC, $estadoC, $idConductor, $nombre, $telefono, $email, $clave, $estado){
    $str = "idConductor:::" . $idConductorC .
    ";;;Nombre:::" . $nombreC . 
    ";;;Teléfono:::" . $telefonoC . 
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Estado:::" . (($estadoC == 1)? "Activado" : (($estadoC == 0)? "Bloqueado" : "Desactivado")) .
    "&&&idConductor:::" . $idConductor .
    ";;;Nombre:::" . $nombre . 
    ";;;Telefono:::" . $telefono . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Estado:::" . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));

    return $str;
}

function actualizarDespachador($idDespachadorC, $nombreC, $telefonoC, $emailC, $claveC, $estadoC, $idDespachador, $nombre, $telefono, $email, $clave, $estado){
    $str = "idDespachador:::" . $idDespachadorC .
    ";;;Nombre:::" . $nombreC . 
    ";;;Teléfono:::" . $telefonoC . 
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Estado:::" . (($estadoC == 1)? "Activado" : (($estadoC == 0)? "Bloqueado" : "Desactivado")) .
    "&&&idDespachador:::" . $idDespachador .
    ";;;Nombre:::" . $nombre . 
    ";;;Telefono:::" . $telefono . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Estado:::" . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));

    return $str;
}

function actualizarInfoDespachador($idDespachadorC, $nombreC, $telefonoC, $emailC, $claveC, $fotoC, $idDespachador, $nombre, $telefono, $email, $clave, $foto){
    $str = "idDespachador:::" . $idDespachadorC .
    ";;;Nombre:::" . $nombreC . 
    ";;;Teléfono:::" . $telefonoC . 
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Foto:::" . $fotoC . 
    "&&&idDespachador:::" . $idDespachador .
    ";;;Nombre:::" . $nombre . 
    ";;;Telefono:::" . $telefono . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Foto:::" . $foto;

    return $str;
}

function actualizarInfoConductor($idConductorC, $nombreC, $telefonoC, $emailC, $claveC, $fotoC, $idConductor, $nombre, $telefono, $email, $clave, $foto){
    $str = "idConductor:::" . $idConductorC .
    ";;;Nombre:::" . $nombreC . 
    ";;;Teléfono:::" . $telefonoC . 
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Foto:::" . $fotoC . 
    "&&&idConductor:::" . $idConductor .
    ";;;Nombre:::" . $nombre . 
    ";;;Telefono:::" . $telefono . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Foto:::" . $foto;

    return $str;
}

function actualizarInfoCliente($idConductorC, $nombreC, $direccionC, $emailC, $claveC, $fotoC, $idConductor, $nombre, $direccion, $email, $clave, $foto){
    $str = "idCliente:::" . $idConductorC .
    ";;;Nombre:::" . $nombreC . 
    ";;;Dirección:::" . $direccionC . 
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Foto:::" . $fotoC . 
    "&&&idCliente:::" . $idConductor .
    ";;;Nombre:::" . $nombre . 
    ";;;Dirección:::" . $direccion . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Foto:::" . $foto;

    return $str;
}


function actualizarInfoAdministrador($idAdministradorC, $nombreC, $emailC, $claveC, $fotoC, $idAdministrador, $nombre, $email, $clave, $foto){
    $str = "idAdministrador:::" . $idAdministradorC .
    ";;;Nombre:::" . $nombreC .  
    ";;;Correo:::" . $emailC . 
    ";;;Clave:::" . $claveC . 
    ";;;Foto:::" . $fotoC . 
    "&&&idAdministrador:::" . $idAdministrador .
    ";;;Nombre:::" . $nombre . 
    ";;;Correo:::" . $email . 
    ";;;Clave:::" . $clave . 
    ";;;Foto:::" . $foto;

    return $str;
}

function crearOrden($fechaOrden, $fechaEstimacion, $direccionDestino, $contacto, $numeroContacto, $idCita, $fechaRecoleccion, $Conductor, $items){
    $str = "Fecha de creación:::" . $fechaOrden . 
    ";;;Fecha de estimación:::" . $fechaEstimacion . 
    ";;;Dirección de destino:::" . $direccionDestino . 
    ";;;Persona de contacto:::" . $contacto . 
    ";;;Número de contacto:::" . $numeroContacto .
    "%%%idCita:::" . $idCita .
    ";;;Fecha de recolección:::" . $fechaRecoleccion .
    ";;;Conductor:::" . $Conductor .
    "%%%";
    for($i = 0; $i < count($items); $i++){
        $str .="Referencia:::" . $items[$i][0] . 
        ";;;Nombre:::" . $items[$i][1] .
        ";;;Descripción:::" . $items[$i][2] .
        ";;;Peso:::" . $items[$i][3] .
        ";;;Fabricante:::" . $items[$i][4] .
        ";;;Precio:::" . $items[$i][5];
        if(count($items) != ($i+1)){
            $str .= "&&&";
        }
        
    }

    return $str;
}


function crearComentario($idOrden, $estado, $fecha, $comentario){
    $str = "idOrden:::" . $idOrden . 
    ";;;Estado:::" . $estado . 
    ";;;Fecha:::" . $fecha . 
    ";;;Comentario:::" . $comentario;

    return $str;
}
?>
