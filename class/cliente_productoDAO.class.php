<?php
/*
 Entidad: cliente_producto
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_productoDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function getById(int $id_cliente_producto){
        $query = sprintf("SELECT * FROM cliente_producto WHERE id_cliente_producto = %d",$id_cliente_producto);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else {
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en cliente_productoDAO");
        }
    }

    //funcion de uso exclusivo para cliente_productoCOORDINATOR
    function getByIdCustom(int $id_cliente){
        $query = sprintf("SELECT * FROM cliente_producto WHERE id_cliente = %d and estado ='activo'",$id_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->num_rows;
            }else {
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en cliente_productoDAO");
        }
    }

    function getCount(string $txt_busqueda=''){
        $sql_busqueda = '';
        if($txt_busqueda != ''){
            $sql_busqueda = sprintf('AND (ip_docker LIKE "%%%1$s%%" OR estado LIKE "%%%1$s%%" OR maxcall  LIKE "%%%1$f%%" OR referencia LIKE "%%%1$s%%" OR dominio LIKE "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT count(*) as cantidad FROM cliente_producto WHERE 1=1 %s ORDER BY id_cliente, id_producto", $sql_busqueda);

        $result = $this->getConexion()->query($query);

        if($result){
            $obj = $result->fetch_object();
            return $obj->cantidad;
        }else{
            throw new Exception("Error al intentar getCount() en cliente_productoDAO");
        }
    }

    function getAllPage(string $txt_busqueda="", int $inicio=0, int $muestra=10): mysqli_result{
        $sqlBusqueda = '';
        if($txt_busqueda != ''){
            $sql_busqueda = sprintf('AND (ip_docker LIKE "%%%1$s%%" OR estado LIKE "%%%1$s%%" OR maxcall  LIKE "%%%1$f%%" OR referencia LIKE "%%%1$s%%" OR dominio LIKE "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT * FROM cliente_producto WHERE 1=1 %s ORDER BY estado, id_cliente, id_producto limit %d, %d", $sql_busqueda, $inicio, $muestra);

        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAllPage() en cliente_productoDAO");
        }
    }

    function insert(cliente_productoDTO $cliente_productoDTO){
        $query = sprintf('INSERT INTO cliente_producto (id_servidor, id_cliente, id_producto, id_reseller, ip_docker, estado, maxcall, precio_venta, referencia, dominio, saldo, descuento) VALUES (%d, %d, %d, %d, "%s", "%s", "%s", %f, "%s", "%s", %f , %f)', $cliente_productoDTO->getId_servidor(), $cliente_productoDTO->getId_cliente(), $cliente_productoDTO->getId_producto(), $cliente_productoDTO->getId_reseller(), $cliente_productoDTO->getIp_docker(), $cliente_productoDTO->getEstado(),$cliente_productoDTO->getMaxcall(),$cliente_productoDTO->getPrecio_venta(), $cliente_productoDTO->getReferencia(), $cliente_productoDTO->getDominio(), $cliente_productoDTO->getSaldo(), $cliente_productoDTO->getDescuento());

        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en cliente_productoDAO");
        }
    }


    function update(cliente_productoDTO $cliente_productoDTO){
        $query = sprintf('UPDATE cliente_producto SET id_servidor=%d, id_cliente=%d, id_producto=%d, id_reseller=%d, ip_docker="%s", estado="%s", maxcall="%s", precio_venta=%f, referencia="%s", dominio="%s", saldo=%f, descuento=%f WHERE id_cliente_producto=%d', $cliente_productoDTO->getId_servidor(), $cliente_productoDTO->getId_cliente(), $cliente_productoDTO->getId_producto(), $cliente_productoDTO->getId_reseller(), $cliente_productoDTO->getIp_docker(), $cliente_productoDTO->getEstado(),$cliente_productoDTO->getMaxcall(),$cliente_productoDTO->getPrecio_venta(), $cliente_productoDTO->getReferencia(), $cliente_productoDTO->getDominio(), $cliente_productoDTO->getSaldo(), $cliente_productoDTO->getDescuento(), $cliente_productoDTO->getId_cliente_producto());
        
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar update() en cliente_productoDAO");
        }
    }

}

?>