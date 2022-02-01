<?php
/*
 Entidad: cliente_producto_pago
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_pagoDAO extends conexion{
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

    function getCount(string $txt_busqueda='', $id_cliente_producto=0){
 
        $sql_busqueda='';

        if($txt_busqueda != ''){
            $sql_busqueda = sprintf('AND (fecha_pago LIKE "%%%1$s%%" or medio_pago LIKE "%%%1$d%%" or valor LIKE "%%%1$s%%" or soporte LIKE "%%%1$s%%" or validacion LIKE "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT count(*) as cantidad FROM cliente_producto_pago WHERE id_cliente_producto=%d %s",$id_cliente_producto, $sql_busqueda);
        $result = $this->getConexion()->query($query);

        if($result){
            $obj = $result->fetch_object();
            return $obj->cantidad;
        }else{
            throw new Exception("error al intentar getCount() en cliente_producto_pagoDAO");
        }
    }

    function getAllPage(string $txt_busqueda = '', int $id_cliente_producto, $inicio, $muestra){
        $sql_busqueda='';

        if($txt_busqueda != ''){
            $sql_busqueda = sprintf('AND (fecha_pago LIKE "%%%1$s%%" or medio_pago LIKE "%%%1$d%%" or valor LIKE "%%%1$s%%" or soporte LIKE "%%%1$s%%" or validacion LIKE "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT * FROM cliente_producto_pago WHERE id_cliente_producto=%d %s ORDER BY id_cliente_producto_pago DESC LIMIT %d, %d",$id_cliente_producto, $sql_busqueda, $inicio, $muestra);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("error al intentar getAllPage() en cliente_producto_pagoDAO");
        }
    }


    function insert(cliente_producto_pagoDTO $cliente_producto_pagoDTO){
        $query = sprintf("INSERT INTO cliente_producto_pago (id_cliente_producto, medio_pago, valor, soporte, validacion) values (%d, '%s', %f, '%s', '%s')", $cliente_producto_pagoDTO->getId_cliente_producto(), $cliente_producto_pagoDTO->getMedio_pago(), $cliente_producto_pagoDTO->getValor(), $cliente_producto_pagoDTO->getSoporte(), $cliente_producto_pagoDTO->getValicacion());
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("error al intentar insert() en cliente_producto_pagoDAO");
        }
    }

    
}

?>