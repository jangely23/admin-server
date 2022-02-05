<?php
class cliente_producto_pagoCOORDINATOR extends conexion{
    function __construct($conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $id_cliente_producto = filter_input(INPUT_POST,"id_cliente_producto",FILTER_SANITIZE_NUMBER_INT);
        $medio_pago = filter_input(INPUT_POST,"medio_pago",FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST,"valor",FILTER_SANITIZE_NUMBER_FLOAT);
        $validacion = filter_input(INPUT_POST,"validacion",FILTER_SANITIZE_STRING);
        $nombre_soporte= $_FILES["soporte"]["name"].date("Ymdhis");
        $soporte = './public/images/soporte_pagos/'.basename($nombre_soporte);

        if(!move_uploaded_file($_FILES["soporte"]["tmp_name"], $soporte)){
            echo "<script type='text/javascript'> alert('no se pudo mover el soporte'); </script>";
        } 

       //Actualizar saldo en cliente producto
       $cliente_productoDAO = new cliente_productoDAO($this->getConexion());
       $datos_producto = $cliente_productoDAO->getById($id_cliente_producto);

       $nuevo_saldo = ($datos_producto->saldo - $valor);

       $cliente_productoDTO =  new cliente_productoDTO($datos_producto->id_cliente_producto, $datos_producto->id_servidor, $datos_producto->id_cliente, $datos_producto->id_producto, $datos_producto->id_reseller, $datos_producto->ip_docker, $datos_producto->estado, $datos_producto->maxcall, $datos_producto->precio_venta, $datos_producto->referencia, $datos_producto->dominio, $nuevo_saldo , $datos_producto->descuento);
       
       $result_update = $cliente_productoDAO->update($cliente_productoDTO);
       
        if($result_update){
            $cliente_producto_pagoDAO = new cliente_producto_pagoDAO($this->getConexion());
            $cliente_producto_pagoDTO = new cliente_producto_pagoDTO(0, $id_cliente_producto, date('Y-m-d h:i:s'), $medio_pago, $valor, $soporte, $validacion);  
    
            $result_pago = $cliente_producto_pagoDAO->insert($cliente_producto_pagoDTO);

            return $result_pago;
        }
   
    }

}


?>