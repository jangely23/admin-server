<?php

class cliente_producto_moduloCOORDINATOR extends conexion{
    function __construct(mysqli $conexion) {
        parent::__construct($conexion);
    }

    function createByPost(){
        $id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT);
        $result =0;
                
        for ($i = 0; $i < count($_POST['id_modulo']); $i++) {
            $id_modulo = filter_var($_POST['id_modulo'][$i],FILTER_SANITIZE_NUMBER_INT);
                
            $cliente_producto_moduloDTO = new cliente_producto_moduloDTO(0,$id_cliente_producto,$id_modulo);
            $cliente_producto_moduloDAO = new cliente_producto_moduloDAO($this->getConexion());
            $result = $cliente_producto_moduloDAO->insert($cliente_producto_moduloDTO);
        }

        return $result;
    }

    function updateByPost(){
        $id_cliente_producto_modulo = filter_input(INPUT_POST,'id_cliente_producto_modulo',FILTER_SANITIZE_NUMBER_INT);
        $id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT);
        $id_modulo = filter_input(INPUT_POST,'id_modulo',FILTER_SANITIZE_NUMBER_INT);
        
        $cliente_producto_moduloDTO = new cliente_producto_moduloDTO($id_cliente_producto_modulo,$id_cliente_producto,$id_modulo);
        $cliente_producto_moduloDAO = new cliente_producto_moduloDAO($this->getConexion());
        $result = $cliente_producto_moduloDAO->update($cliente_producto_moduloDTO);
        
        return $result;
    }

    function deleteByPost(){
        $id_cliente_producto_modulo = filter_input(INPUT_POST,'id_cliente_producto_modulo',FILTER_SANITIZE_NUMBER_INT);
   
        $cliente_producto_moduloDAO = new cliente_producto_moduloDAO($this->getConexion());
        $result = $cliente_producto_moduloDAO->delete($id_cliente_producto_modulo);
        
        return $result;
    }
}

?>