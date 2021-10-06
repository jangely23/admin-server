<?php

class cliente_producto_cobroCOORDINATOR extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function deleteByPost(){
        $id_cliente_producto_cobro = filter_input(INPUT_POST,'id_cliente_producto_cobro',FILTER_SANITIZE_NUMBER_INT);
        $cuenta_cobro = filter_input(INPUT_POST,'cuenta_cobro',FILTER_SANITIZE_STRING);

        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($this->getConexion());
        $datos = $cliente_producto_cobroDAO->getById($id_cliente_producto_cobro);

        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO($datos->id_cliente_producto_cobro, $datos->id_cliente_producto, $datos->cuenta_cobro, $datos->numero_cuenta, 'cancelada', $datos->observacion, $datos->valor);
        
        $result = $cliente_producto_cobroDAO->update($cliente_producto_cobroDTO);

        if($result){
            unlink("../public/pdf/$cuenta_cobro");
        }

        return $result;
    }
}

?>