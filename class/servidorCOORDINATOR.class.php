<?php
class servidorCOORDINATOR extends conexion{
    function __construct($conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $id_servidor_detalle = filter_input(INPUT_POST,'id_servidor_detalle',FILTER_SANITIZE_NUMBER_INT);
        $ip = filter_input(INPUT_POST,'ip',FILTER_SANITIZE_STRING);
        $tipo = filter_input(INPUT_POST,'tipo',FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST,'estado',FILTER_SANITIZE_STRING);
        $periodicidad_pago = filter_input(INPUT_POST,'periodicidad_pago',FILTER_SANITIZE_STRING);
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $observacion = filter_input(INPUT_POST,'observacion',FILTER_SANITIZE_STRING);
        
        $servidorDTO = new servidorDTO(0, $id_servidor_detalle, $ip, $tipo, $estado, $periodicidad_pago, $nombre, $observacion);
        $servidorDAO = new servidorDAO($this->getConexion());
        $result = $servidorDAO->insert($servidorDTO);

        return $result;
    }

    function updateByPost(){
        $id_servidor = filter_input(INPUT_POST,'id_servidor',FILTER_SANITIZE_NUMBER_INT);
        $id_servidor_detalle = filter_input(INPUT_POST,'id_servidor_detalle',FILTER_SANITIZE_NUMBER_INT);
        $ip = filter_input(INPUT_POST,'ip',FILTER_SANITIZE_STRING);
        $tipo = filter_input(INPUT_POST,'tipo',FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST,'estado',FILTER_SANITIZE_STRING);
        $periodicidad_pago = filter_input(INPUT_POST,'periodicidad_pago',FILTER_SANITIZE_STRING);
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $observacion = filter_input(INPUT_POST,'observacion',FILTER_SANITIZE_STRING);
        
        $servidorDTO = new servidorDTO($id_servidor, $id_servidor_detalle, $ip, $tipo, $estado, $periodicidad_pago, $nombre, $observacion);
        $servidorDAO = new servidorDAO($this->getConexion());
        $result = $servidorDAO->update($servidorDTO);

        return $result;
    }

    function deleteByPost(){
        $id_servidor = filter_input(INPUT_POST,'id_servidor',FILTER_SANITIZE_NUMBER_INT);
        $servidorDAO = new servidorDAO($this->getConexion());
        $result = $servidorDAO->delete($id_servidor);

        return $result;
    }
}

?>