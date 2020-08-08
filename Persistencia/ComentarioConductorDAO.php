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

    public function getInfo()
    {
        return "SELECT comentarioconductor.fecha, comentario 
                FROM comentarioconductor
                INNER JOIN estadoconductor ON FK_idEstadoConductor = idEstadoConductor
                WHERE idEstadoConductor = '" . $this->idEstadoConductor . "'
                ORDER BY fecha DESC";
    }
}
?>