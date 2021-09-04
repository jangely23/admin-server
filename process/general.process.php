<?php 

require '../config/conexion.php';
require '../class/conexion.class.php';
require "../class/".$entidad."DTO.class.php";
require "../class/".$entidad."DAO.class.php";
require "../class/".$entidad."COORDINATOR.class.php";

if($entidad == "cliente"){
    require "../class/contacto_clienteDAO.class.php";
    require "../class/contacto_clienteDTO.class.php";
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