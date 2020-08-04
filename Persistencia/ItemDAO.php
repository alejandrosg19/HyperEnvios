<?php 

class ItemDAO{
    private $idItem;
    private $referencia;
    private $nombre;
    private $descripcion;
    private $peso;
    private $fabricante;
    private $precio;
    private $idOrden;

    public function ItemDAO($idItem = "", $referencia = "", $nombre = "", $descripcion = "", $peso = "", $fabricante = "", $precio = "", $idOrden = ""){
        $this -> idItem = $idItem;
        $this -> referencia = $referencia;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> peso = $peso;
        $this -> fabricante = $fabricante;
        $this -> precio = $precio;
        $this -> idOrden = $idOrden;
    }

    public function insertar(){
        return "INSERT INTO Item (referencia, nombre, descripcion, peso, fabricante, precio, FK_idOrden) 
                VALUES ('" . $this -> referencia ."', '" . $this -> nombre  ."','" . $this -> descripcion  ."', '" . $this -> peso  ."', '" . $this -> fabricante . "' ,'" . $this -> precio  ."','" . $this -> idOrden . "')";
    }

}

?>