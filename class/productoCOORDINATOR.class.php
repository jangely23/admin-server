<?php
class productoCOORDINATOR extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $nombre = filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING);
        $version = filter_input(INPUT_POST,'version', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING);
        
        $productoDTO = new productoDTO(0, $nombre, $version, $estado);
        $productoDAO = new productoDAO($this->getConexion());
        $result = $productoDAO->insert($productoDTO);

        return $result;
    }

    function updateByPost(){
        $id_producto = filter_input(INPUT_POST,'id_producto', FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING);
        $version = filter_input(INPUT_POST,'version', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING);

        $productoDTO = new productoDTO($id_producto, $nombre, $version, $estado);
        $productoDAO = new productoDAO($this->getConexion());
        $result = $productoDAO->update($productoDTO);

        return $result;
    }

    function deleteByPost(){
        $id_producto = filter_input(INPUT_POST,'id_producto', FILTER_SANITIZE_NUMBER_INT);
        $productoDAO = new productoDAO($this->getConexion());
        $result = $productoDAO->delete($id_producto);

        return $result;
    }
}

?>