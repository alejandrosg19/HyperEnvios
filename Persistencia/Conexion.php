<?php

class Conexion{
    private $msqli;
    private $result;

    public function abrir(){
        $this -> mysqli = new mysqli("localhost","root","background=FFF","proyectoFinalAplicaciones","3306");
        #$this -> mysqli = new mysqli("localhost","root","","proyectoFinalAplicaciones");
        $this -> mysqli -> set_charset("utf-8");
    }

    public function ejecutar($query){
        $this -> result = $this -> mysqli -> query($query);
    }

    public function extraer(){
        return $this -> result -> fetch_row();
    }

    public function cerrar(){
        $this -> mysqli -> close();
    }

    public function numFilas(){
        return $this -> result -> num_rows;
    }

    public function filasAfectadas(){
        return $this -> mysqli -> affected_rows;
    }

    public function getLastID(){
        return $this -> mysqli -> insert_id;
    }
}

?>