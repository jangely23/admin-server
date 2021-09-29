<?php 

require '../config/conexion.php';
require '../class/conexion.class.php';
require "../class/".$entidad."DTO.class.php";
require "../class/".$entidad."DAO.class.php";
require "../class/".$entidad."COORDINATOR.class.php";

switch ($entidad){
    case "cliente":
        require "../class/contacto_clienteDAO.class.php";
        require "../class/contacto_clienteDTO.class.php";
        break;
    case "cliente_producto":
        require "../class/clienteDAO.class.php";
        require "../class/clienteDTO.class.php";
        require "../class/servidorDAO.class.php";
        require "../class/servidorDTO.class.php";
        break;
    case "cliente_producto_modulo":
        require "../class/moduloDTO.class.php";
        require "../class/moduloDAO.class.php";
        break;
}


try{
    $modo = filter_input(INPUT_POST,"modo",FILTER_SANITIZE_STRING);

    $nombreCoordinador = $entidad."COORDINATOR";
    $coordinador = new $nombreCoordinador($conexion);
    
    switch ($modo){
        case "crear":
            $resultado = $coordinador->createByPost();
            break;
        case "editar":
            $resultado = $coordinador->updateByPost();
            break;
        case "eliminar":
            $resultado = $coordinador->deleteByPost();
            break;
    }

    if ($resultado){
        $respuesta = array("resultado" => "ok");
    }else{
        $respuesta = array("resultado" => "false");
    }

    $json = json_encode($respuesta);
    echo $json;

}catch (Exception $ex){
    $respuesta = array("resultado" => "error", "descripcion" => $ex->getMessage());
    $json = json_encode($respuesta);
    echo $json; 
}


?>