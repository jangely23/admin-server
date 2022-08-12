<?php

class moduloCOORDINATOR extends conexion{
    function __construct($conexion){
        parent:: __construct($conexion);
    }

    function createByPost(){
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $proveedor = filter_input(INPUT_POST,'proveedor',FILTER_SANITIZE_STRING);

        $moduloDTO = new moduloDTO(0, $nombre, $proveedor);
        $moduloDAO = new moduloDAO($this->getConexion());
        $result = $moduloDAO->insert($moduloDTO);

        return $result;
    }

    function updateByPost(){
        $id_modulo = filter_input(INPUT_POST,'id_modulo',FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $proveedor = filter_input(INPUT_POST,'proveedor',FILTER_SANITIZE_STRING);

        $moduloDTO = new moduloDTO($id_modulo, $nombre, $proveedor);
        $moduloDAO = new moduloDAO($this->getConexion());
        $result = $moduloDAO->update($moduloDTO);

        return $result;
    }

    function deleteByPost(){
        $id_modulo = filter_input(INPUT_POST,'id_modulo',FILTER_SANITIZE_NUMBER_INT);
        $moduloDAO = new moduloDAO($this->getConexion());
        $result = $moduloDAO->delete($id_modulo);

        return $result;
    }
}
?>