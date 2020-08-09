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

    public function insertar(){
        return "INSERT INTO comentarioCliente (fecha, comentario, FK_idEstadoCliente) values ('" . $this -> fecha . "', '" . $this -> comentario . "', '" . $this -> idEstadoCliente . "')";
    }

    public function getComentariosActor(){
        return "SELECT Cliente.nombre, comentario, comentarioCliente.fecha as fecha 
                FROM comentarioCliente
                INNER JOIN estadoCliente on FK_idEstadoCliente = idEstadoCliente
                INNER JOIN Cliente on FK_idCliente = idCliente
                WHERE idEstadoCliente = " . $this -> idEstadoCliente . "
                ORDER BY fecha desc";
    }

    public function getInfo(){
        return "SELECT comentarioCliente.fecha, comentario 
                FROM comentarioCliente
                INNER JOIN estadoCliente ON FK_idEstadoCliente = idEstadoCliente
                WHERE idEstadoCliente = '" . $this->idEstadoCliente . "'
                ORDER BY fecha DESC";
    }
}
?>