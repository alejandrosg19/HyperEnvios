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

    public function getComentariosActor(){
        return "SELECT Conductor.nombre, comentario, comentarioConductor.fecha as fecha from comentarioConductor
                INNER JOIN estadoConductor on FK_idEstadoConductor = idEstadoConductor
                INNER JOIN Conductor on FK_idConductor = idConductor
                WHERE idEstadoConductor = " . $this -> idEstadoConductor . "
                ORDER BY fecha asc";
    }
    public function getInfo(){
        return "SELECT comentarioconductor.fecha, comentario 
                FROM comentarioconductor
                INNER JOIN estadoconductor ON FK_idEstadoConductor = idEstadoConductor
                WHERE idEstadoConductor = '" . $this->idEstadoConductor . "'
                ORDER BY fecha DESC";
    }
}
?>