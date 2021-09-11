<?php 

class servidor_detalleCOORDINATOR extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $plan_servidor = filter_input(INPUT_POST,'plan',FILTER_SANITIZE_STRING);
        $ram = filter_input(INPUT_POST,'ram',FILTER_SANITIZE_STRING);
        $disco = filter_input(INPUT_POST,'disco',FILTER_SANITIZE_STRING);
        $procesador = filter_input(INPUT_POST,'procesador',FILTER_SANITIZE_STRING);
        $datacenter = filter_input(INPUT_POST,'datacenter',FILTER_SANITIZE_STRING);
        $raid = filter_input(INPUT_POST,'raid',FILTER_SANITIZE_STRING);
        $costo = filter_input(INPUT_POST,'costo',FILTER_SANITIZE_NUMBER_INT);
        $moneda = filter_input(INPUT_POST,'moneda',FILTER_SANITIZE_STRING);
        
        $servidor_detalleDTO = new servidor_detalleDTO(0,$plan_servidor, $ram, $disco, $procesador, $datacenter, $raid, $costo, $moneda);
        $servidor_detalleDAO = new servidor_detalleDAO($this->getConexion());
        $result = $servidor_detalleDAO->insert($servidor_detalleDTO);

        return $result;
    }

    function updateByPost(){
        $id_servidor_detalle = filter_input(INPUT_POST,'id_servidor_detalle',FILTER_SANITIZE_NUMBER_INT);
        $plan_servidor = filter_input(INPUT_POST,'plan',FILTER_SANITIZE_STRING);
        $ram = filter_input(INPUT_POST,'ram',FILTER_SANITIZE_STRING);
        $disco = filter_input(INPUT_POST,'disco',FILTER_SANITIZE_STRING);
        $procesador = filter_input(INPUT_POST,'procesador',FILTER_SANITIZE_STRING);
        $datacenter = filter_input(INPUT_POST,'datacenter',FILTER_SANITIZE_STRING);
        $raid = filter_input(INPUT_POST,'raid',FILTER_SANITIZE_STRING);
        $costo = filter_input(INPUT_POST,'costo',FILTER_SANITIZE_NUMBER_INT);
        $moneda = filter_input(INPUT_POST,'moneda',FILTER_SANITIZE_STRING);

        $servidor_detalleDTO = new servidor_detalleDTO($id_servidor_detalle,$plan_servidor, $ram, $disco, $procesador, $datacenter, $raid, $costo, $moneda);
        $servidor_detalleDAO = new servidor_detalleDAO($this->getConexion());
        $result = $servidor_detalleDAO->update($servidor_detalleDTO);

        return $result;
    }

    function deleteByPost(){
        $id_servidor_detalle = filter_input(INPUT_POST,'id_servidor_detalle',FILTER_SANITIZE_NUMBER_INT);
        $servidor_detalleDAO = new servidor_detalleDAO($this->getConexion());
        $result = $servidor_detalleDAO->delete($id_servidor_detalle);

        return $result;
    }
}

?>