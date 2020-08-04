<?php
class ComentarioConductorDAO{
    private $idComentarioConductor;
    private $fecha;
    private $comentario;
    private $idEstadoConductor;

    public function ComentarioConductorDAO($idComentarioConductor = "", $fecha = "", $comentario = "", $idEstadoConductor = ""){
        $this -> idComentarioConductor = $idComentarioConductor;
        $this -> fecha = $fecha;
        $this -> comentario = $comentario;
        $this -> idEstadoConductor = $idEstadoConductor;
    }
}
?>