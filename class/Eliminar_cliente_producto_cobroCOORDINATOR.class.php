<?php

class cliente_producto_cobroCOORDINATOR extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function createByPost(){
        $id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT);
        $cuenta_cobro = filter_input(INPUT_POST,'cuenta_cobro',FILTER_SANITIZE_STRING);
        $numero_cuenta = filter_input(INPUT_POST,'numero_cuenta',FILTER_SANITIZE_NUMBER_INT);
        $estado = filter_input(INPUT_POST,'estado',FILTER_SANITIZE_STRING);
        $observacion = filter_input(INPUT_POST,'observacion',FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_NUMBER_FLOAT);

        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO(0, $id_cliente_producto, $cuenta_cobro, $numero_cuenta, $estado, $observacion, $valor);
        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($this->getConexion());
        $result = $cliente_producto_cobroDAO->insert($cliente_producto_cobroDTO);

        return $result;
    }

    function updateByPost(){
        $id_cliente_producto_cobro = filter_input(INPUT_POST,'id_cliente_producto_cobro',FILTER_SANITIZE_NUMBER_INT);
        $id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT);
        $cuenta_cobro = filter_input(INPUT_POST,'cuenta_cobro',FILTER_SANITIZE_STRING);
        $numero_cuenta = filter_input(INPUT_POST,'numero_cuenta',FILTER_SANITIZE_NUMBER_INT);
        $estado = filter_input(INPUT_POST,'estado',FILTER_SANITIZE_STRING);
        $observacion = filter_input(INPUT_POST,'observacion',FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_NUMBER_FLOAT);

        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO($id_cliente_producto_cobro, $id_cliente_producto, $cuenta_cobro, $numero_cuenta, $estado, $observacion, $valor);
        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($this->getConexion());
        $result = $cliente_producto_cobroDAO->update($cliente_producto_cobroDTO);

        return $result;
    }

    function deleteByPost(){
        $id_cliente_producto_cobro = filter_input(INPUT_POST,'id_cliente_producto_cobro',FILTER_SANITIZE_NUMBER_INT);

        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($this->getConexion());
        $datos = $cliente_producto_cobroDAO->getById($id_cliente_producto_cobro);

        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO($datos->id_cliente_producto_cobro, $datos->id_cliente_producto, $datos->cuenta_cobro, $datos->numero_cuenta, 'cancelada', $datos->observacion, $datos->valor);
        
        $result = $cliente_producto_cobroDAO->update($cliente_producto_cobroDTO);

        return $result;
    }
}

?>