<?php

/**
 * Registro de usuario
 */

if (isset($_POST['btn-registrar'])) {

    $correo = $_POST['email'];
    $clave = $_POST['clave'];

    $cliente = new Cliente("", "", $correo, $clave);
    $administrador = new Administrador("", "", $correo);
    $despachador = new Despachador("", "", $correo);
    $conductor = new Conductor("", "", $correo);

    if ($cliente->existeCorreo() || $administrador->existeCorreo() || $despachador->existeCorreo() || $conductor->existeCorreo()) {

        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {

        $res = $cliente->registrar();

        /**
         * Creo el objeto de log
         */
        $logCliente = new LogCliente("", getDateTime(), getBrowser(), getOS(), registrarCliente($correo,md5($clave),"1"), $res[1], 19);
        /**
         * Inserto el registro del log
         */
        $logCliente->insertar();

        if ($res[0] == 1) {
            $msj = "El registro fue exitoso, por favor revise su cuenta de correo para activar la cuenta.";
            $class = "alert-success";
        } else {
            $msj = "Ocurrió algo inesperado.";
            $class = "alert-danger";
        }
    }

    include "Vista/Main/alert.php";
}
/**
 * Mensaje luego de la activación
 */
if (isset($_GET['activacion'])) {

    $activacion = $_GET['activacion'];

    if ($activacion == 1) {
        $msj = "Su cuenta ha sido activada.";
        $class = "alert-success";
    } else {
        $msj = "Ocurrió algo inesperado.";
        $class = "alert-danger";
    }

    include "Vista/Main/alert.php";
}

/**
 *  Muestra el mensaje de error
 */

if (isset($_GET['error'])) {

    $error = $_GET['error'];

    if ($error == 1) {
        $class = "alert-danger";
        $msj = "El correo y la contraseña no coinciden, intente denuevo";
    } else if ($error == 2) {
        $class = "alert-warning";
        $msj = "Su cuenta no ha sido activada, por favor revise su correo";
    } else if ($error == 3) {
        $class = "alert-danger";
        $msj = "Su cuenta ha sido bloqueada, por favor contactese con el administrador";
    }

    include_once "Vista/Main/alert.php";
}

?>
<link rel="stylesheet" href="Static/css/index.css">
<script type="text/javascript" src="Static/js/index.js"></script>
<div class="hidden">
    <div class="form">
        <form action="index.php?pid=<?php echo base64_encode("Vista/Auth/autenticar.php") ?>" method="post">
            <div class="d-flex flex-row justify-content-center">
                <img src="static/img/logo.png" width=50>
            </div>
            <div>
                <h1>Log in</h1>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" type="email" placeholder="Type your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="pass" type="password" placeholder="Type your password">
            </div>
            <div class="form-group d-flex flex-column align-items-center">
                <input class="form-control btn btn-outline-secondary" name="btn-send" type="submit">
                <span class="mt-3">Don't have an account? <a href="#" class="registrarse">Sign In</a></span>
            </div>
        </form>
    </div>
</div>

<div class="hidden-registrar">
    <div class="form">
        <form action="index.php" method="POST">
            <div class="d-flex flex-row justify-content-center">
                <img src="static/img/web/logo1.png" width=50>
            </div>
            <div>
                <h1>Sign In</h1>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" type="email" placeholder="Type your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="clave" type="password" placeholder="Type your password">
            </div>
            <div class="form-group d-flex flex-column align-items-center">
                <input class="form-control btn btn-outline-secondary" name="btn-registrar" type="submit">
                <span class="mt-3">Already have an account? <a href="#" class="signIn">Log In</a></span>
            </div>
        </form>
    </div>
</div>

<div class="container-m">
    <div class="header">
        <div class="shadow">
            <div class="nav">
                <div class="nav-center">
                    <div class="nav-c-left">
                        <a href="#">HYPER ENVIOS</a>
                    </div>
                    <div class="nav-c-right">
                        <!--<div>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="icon-nav"><i class="far fa-file"></i></span> Sections</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <a class="dropdown-item" href="#"><span class="icon-dropdown"><i class="fas fa-chart-pie"></i></span> Action</a>
                                <a class="dropdown-item" href="#"><span class="icon-dropdown"><i class="fas fa-chart-pie"></i></span> Another action</a>
                                <a class="dropdown-item" href="#"><span class="icon-dropdown"><i class="fas fa-chart-pie"></i></span> Something else here</a>
                            </div>
                        </div>-->
                        <div>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="icon-nav"><i class="fas fa-user"></i></span> Sesion</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item signIn" href="#"> <span class="icon-dropdown"><i class="fas fa-sign-in-alt"></i></span>Log In</a>
                                <a class="dropdown-item registrarse" href="#"> <span class="icon-dropdown"><i class="fas fa-user-plus"></i></span>Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-view">
                <div class="main-top pl-4 pr-4">
                    <h3 class="mainTitle" style="text-align:center">Recogemos la mercancia y la llevamos a cualquier destino de Colombia.</h3>
                </div>
                <div class="main-bottom pl-4 pr-4">
                    <h5 class="secondTitle" style="text-align:center"> Sientete en confianza cuidaremos de tus envios</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row d-flex flex-column align-items-center" style="background-color: black;">
            <div class="col-10 d-flex flex-column align-items-center dark-text" style="padding-top: 250px;">
                <h1 class="articleText article1-top-title" style="text-align:center">Somos HYPER </h1>
                <p class="articleText article1-top-title-p1">Logistica y distribución de envios</p>
                <p class="articleText article1-top-title-p2">Grupo humano, íntegro, cálido y experto en brindar tranquilidad y confianza a sus clientes a través de soluciones logisticas innovadoras en la cadena de abastecimiento. Actuamos con responsabilidad y coherencia, y estamos comprometidos con la eficiente distribución de envios.</p>
            </div>
            <div class="col-lg-10 col-xl-7 d-flex flex-row justify-content-center wholeEffect">
                <div class="row" style="height: 500px; overflow: hidden">
                    <div class="col-3" style="max-width: 20%;">
                        <div class="columnEffect" style="z-index: 4;">
                            <div class="position-relative">
                                <a href="#">
                                    <div class="imgEffectContainer">
                                        <div class="imgEffect"><img src="Static/img/web/b4.png"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3" style="max-width: 20%;">
                        <div class="columnEffect" style="z-index: 3;">
                            <div class="position-relative">
                                <a href="#">
                                    <div class="imgEffectContainer">
                                        <div class="imgEffect"><img src="Static/img/web/b2.png"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3" style="max-width: 20%;">
                        <div class="columnEffect" style="z-index: 2;">
                            <div class="position-relative">
                                <a href="#">
                                    <div class="imgEffectContainer">
                                        <div class="imgEffect"><img src="Static/img/web/b3.png"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3" style="max-width: 20%;">
                        <div class="columnEffect" style="z-index: 1;">
                            <div class="position-relative">
                                <a href="#">
                                    <div class="imgEffectContainer">
                                        <div class="imgEffect"><img src="Static/img/web/b1.png"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row d-flex flex-row justify-content-center light-text" style="margin-top: 200px;">
            <div class="col-10 col-xl-3 d-flex flex-column justify-content-center basic-elements">
                <h1 class="article2-title">Envio Terrestre</h1>
                <span class="article2-subtitle">ESPECIFICACIONES DE ENVIO</span>
                <p class="article2-p">Servicio especializado para envío terrestre de Paquetes de 0.1 a 30 kilogramos, por unidad de empaque, el servicio se cobrará según el peso del paquete<br><strong>Nota:</strong><br>No se despachan paquetes con documentos tales como, notificaciones judiciales, licitaciones, bonos, dinero, documentos jurídicos o cualquier título valor.</p>
            </div>
            <div class="col-10 col-xl-5 d-flex flex-row justify-content-center mt-5 mb-5">
                <img src="Static/img/web/ipad.png" style="width: 100%">
            </div>
        </div>
        <div class="row d-flex flex-row justify-content-center" style="padding: 150px 0px 100px 0px;">
            <div class="col-10 col-xl-5 d-flex flex-column align-items-center">
                <h1 class="article2-title">Operación Logistica</h1>
                <span class="article2-subtitle">INFORMACIÓN Y REGISTRO DE LA OPERACIÓN</span>
                <p class="article2-p" style="text-align: center;">Monitoreamos el ingreso de sus productos a la bodega, registramos el proceso de almacenamiento y despacho de los mismos, brindándoles así, información en tiempo de real del proceso de su envio, todo diseñado a la medida de sus necesidades.</p>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 250px;">
        <div class="row d-flex flex-row justify-content-center" style="background-color: black; position: relative;">
            <div class="col-8 d-flex flex-row justify-content-center align-items-center" style="position: absolute; top:-204px">
                <div class="footerEffect footerImageLeft" style="z-index: 1;">
                    <img src="Static/img/web/bg9.png" width="150px">
                </div>
                <div class="footerEffect footerImageLeft" style="z-index: 2;">
                    <img src="Static/img/web/bg7.png" width="230px">
                </div>
                <div class="footerEffect" style="z-index: 3;">
                    <img src="Static/img/web/bg6.png" width="250px">
                </div>
                <div class="footerEffect footerImageRight" style="z-index: 2;">
                    <img src="Static/img/web/bg8.png" width="230px">
                </div>
                <div class="footerEffect footerImageRight" style="z-index: 1;">
                    <img src="Static/img/web/bg10.png" width="150px">
                </div>
            </div>
            <div class="container footerContainer">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div>
                            <h4>Sobre Nosotros</h4>
                        </div>
                        <div>
                            <p>
                                El mejor servicio de envíos de Colombia, con más de 50 años de trayectoria entregando sueños y esperanzas de nuestros clientes. Despachos en 6 días sin importar donde te encuentres.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div>
                            <h4>Contacto</h4>
                        </div>
                        <div>
                            <span>
                                contactocliente@hyperenvios.com
                            </span>
                            <span>
                                +57 3194607736
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div>
                            <h4>Menu</h4>
                        </div>
                        <div>
                            <p>
                                Contacto
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div>
                            <h4>Siguenos</h4>
                        </div>
                        <div>
                            <p>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(window).scroll(function(){
        if($(window).scrollTop() > 200){
            $(".nav").css({
                //"background-color":"rgba(168,101,58,0.8)"
                //"background-color":"rgba(78,74,102,0.8)"
                "background-color":"rgba(4,101,51,0.8)"
            })
        }else{
            $(".nav").css({
                "background-color":"transparent"
            })
        }
    });
</script>