<?php
class ComentarioClienteDAO{
    private $idComentarioCliente;
    private $fecha;
    private $comentario;
    private $idEstadoCliente;

    public function ComentarioClienteDAO($idComentarioCliente = "", $fecha = "", $comentario = "", $idEstadoCliente = ""){
        $this -> idComentarioCliente = $idComentarioCliente;
        $this -> fecha = $fecha;
        $this -> comentario = $comentario;
        $this -> idEstadoCliente = $idEstadoCliente;
    }

    public function getComentariosActor(){
        return "SELECT Cliente.nombre, comentario, comentarioCliente.fecha as fecha from comentarioCliente
                INNER JOIN estadoCliente on FK_idEstadoCliente = idEstadoCliente
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE idEstadoCliente = " . $this -> idEstadoCliente . "
                ORDER BY fecha asc";
    }
}
?>