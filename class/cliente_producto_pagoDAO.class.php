<?php
/*
 Entidad: cliente_producto_pago
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_cobroDAO extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function getById(int $id_cliente_producto_pago){
            $query = sprintf("SELECT * FROM cliente_producto_pago WHERE id_cliente_producto_pago = '%d'",$id_cliente_producto_pago);
            $result = $this->getConexion()->query($query);

            if($result){
                if($result->num_rows != 0){
                    return $result->fetch_object();
                }else{
                    return 0;
                }
            }else{
                throw new Exception("Error al intentar getById() en cliente_producto_pagoDAO");
            }
    }
    
}

?>