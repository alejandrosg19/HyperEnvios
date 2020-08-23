<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/OrdenDAO.php";

class Orden
{
    private $idOrden;
    private $fecha;
    private $fechaEstimacion;
    private $direccionDestino;
    private $contacto; #Nombre de la persona a quien le llega el pedido
    private $numeroContacto;
    private $fechaLlegada;
    private $idCliente;
    private $idCita;
    private $idEnvio;
    private $idDespachador;
    private $OrdenDAO;
    private $Conexion;

    function Orden($idOrden = "", $fecha = "", $fechaEstimacion = "", $direccionDestino = "", $contacto = "", $numeroContacto = "", $fechaLlegada = "", $idCliente = "", $idCita = "", $idEnvio = "", $idDespachador = "")
    {
        $this->idOrden = $idOrden;
        $this->fecha = $fecha;
        $this->fechaEstimacion = $fechaEstimacion;
        $this->direccionDestino = $direccionDestino;
        $this->contacto = $contacto;
        $this->numeroContacto = $numeroContacto;
        $this->fechaLlegada = $fechaLlegada;
        $this->idCliente = $idCliente;
        $this->idCita = $idCita;
        $this->idEnvio = $idEnvio;
        $this->idDespachador = $idDespachador;
        $this->OrdenDAO = new OrdenDAO($this->idOrden, $this->fecha, $this->fechaEstimacion, $this->direccionDestino, $this->contacto, $this->numeroContacto, $this->fechaLlegada, $this->idCliente, $this->idCita, $this->idEnvio, $this->idDespachador);
        $this->Conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdOrden()
    {
        return $this->idOrden;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getFechaEstimacion()
    {
        return $this->fechaEstimacion;
    }

    public function getDireccionDestino()
    {
        return $this->direccionDestino;
    }

    public function getContacto()
    {
        return $this->contacto;
    }

    public function getNumeroContacto()
    {
        return $this->numeroContacto;
    }

    public function getFechaLlegada()
    {
        return $this->fechaLlegada;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getIdCita()
    {
        return $this->idCita;
    }

    public function getIdEnvio()
    {
        return $this->idEnvio;
    }

    public function getIdDespachador()
    {
        return $this->idDespachador;
    }
    /*
    *   Setters
    */

    public function setIdOrden($idOrden)
    {
        $this->idOrden = $idOrden;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setFechaEstimacion($fechaEstimacion)
    {
        $this->fechaEstimacion = $fechaEstimacion;
    }

    public function setDireccionDestino($direccionDestino)
    {
        $this->direccionDestino = $direccionDestino;
    }

    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }

    public function setNumeroContacto($numeroContacto)
    {
        $this->numeroContacto = $numeroContacto;
    }

    public function setFechaLlegada($fechaLlegada)
    {
        $this->fechaLlegada = $fechaLlegada;
    }

    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    public function setIdCita($idCita)
    {
        $this->idCita = $idCita;
    }

    public function setIdEnvio($idEnvio)
    {
        $this->idEnvio = $idEnvio;
    }

    public function setIdDespachador($idDespachador)
    {
        $this->idDespachador = $idDespachador;
    }

    /* 
    *   methods
    */
    /*
    * Funcion que trae informaciòn de orden
    */
    public function getInfoOrden()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->getInfoOrden());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();
        return $resList;
    }

    function insertar()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->insertar());
        $res =  $this->Conexion->getLastID();
        $this->Conexion->cerrar();
        return $res;
    }
    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroPaginado($str, $pag, $cant));
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidad($str)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroCantidad($str));
        $res = $this->Conexion->extraer();
        $this->Conexion->cerrar();

        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginadoCliente($str, $pag, $cant)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroPaginadoCliente($str, $pag, $cant));
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidadCliente($str)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroCantidadCliente($str));
        $res = $this->Conexion->extraer();
        $this->Conexion->cerrar();

        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginadoAdministrador($str, $pag, $cant)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroPaginadoAdministrador($str, $pag, $cant));
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidadAdministrador($str)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroCantidadAdministrador($str));
        $res = $this->Conexion->extraer();
        $this->Conexion->cerrar();

        return $res[0];
    }
    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginadoConductor1($str, $pag, $cant, $idConductor)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroPaginadoConductor1($str, $pag, $cant, $idConductor));
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidadConductor1($str, $idConductor)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroCantidadConductor1($str, $idConductor));
        $res = $this->Conexion->extraer();
        $this->Conexion->cerrar();

        return $res[0];
    }
    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginadoConductor2($str, $pag, $cant, $idConductor)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroPaginadoConductor2($str, $pag, $cant, $idConductor));
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidadConductor2($str)
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->filtroCantidadConductor2($str));
        $res = $this->Conexion->extraer();
        $this->Conexion->cerrar();

        return $res[0];
    }

    public function actualizarEnvio()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->actualizarEnvio());
        $this->Conexion->cerrar();
    }

    public function getOrdenesEnvio()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->getOrdenesEnvio());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();

        return $resList;
    }
    /*
     * Trae en un consulta la cantidad de ordenes del mes actual y del mes anterior
     */
    public function ventas()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->ventas());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();
        return $resList;
    }
    /*
     * Trae en un consulta los ingresos de ordenes del mes actual y del mes anterior
     */
    public function ingresos()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->ingresos());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();
        return $resList;
    }
    /*
     * Trae la cantidad de ventas x mes de los ultimos 10 meses
     */
    public function ventasxMes()
    {
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->OrdenDAO->ventasxMes());
        $resList = array();
        while ($res = $this->Conexion->extraer()) {
            array_push($resList, $res);
        }
        $this->Conexion->cerrar();
        return $resList;
    }

    public function getLastOrdenCliente(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> OrdenDAO -> getLastOrdenCliente());
        $res = $this -> Conexion -> extraer();
        $this -> idOrden = $res[0];
        $this -> Conexion -> cerrar();
    }
}
