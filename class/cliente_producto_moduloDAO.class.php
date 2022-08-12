<?php
/*
 Entidad: cliente
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_moduloDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function getById(int $id_cliente_producto_modulo){
        $query = sprintf("SELECT * FROM cliente_producto_modulo WHERE id_cliente_producto_modulo=%d",$id_cliente_producto_modulo);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en cliente_producto_moduloDAO");
        }
    }

    function getByIdProductoModulo(int $id_cliente_producto_modulo, $id_modulo){
        $query = sprintf("SELECT * FROM cliente_producto_modulo WHERE id_cliente_producto=%d AND id_modulo=%d",$id_cliente_producto_modulo, $id_modulo);
        $result = $this->getConexion()->query($query);
        
        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en cliente_producto_moduloDAO");
        }
    }

    function getAll(int $id_cliente_producto = 0){
        $query = sprintf("SELECT * FROM cliente_producto_modulo WHERE id_cliente_producto=%d",$id_cliente_producto);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAll() en cliente_producto_moduloDAO");
        }
    }

    function insert(cliente_producto_moduloDTO $cliente_producto_moduloDTO){
        $query = sprintf('INSERT INTO cliente_producto_modulo (id_cliente_producto, id_modulo) values (%d, %d)', $cliente_producto_moduloDTO->getId_cliente_producto(), $cliente_producto_moduloDTO->getId_modulo());
        var_dump($query);
        $result = $this->getConexion()->query($query);
        
        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en cliente_producto_moduloDAO");
        }
    }

    function update(cliente_producto_moduloDTO $cliente_producto_moduloDTO){
        $query = sprintf('UPDATE cliente_producto_modulo SET id_cliente_producto=%d, id_modulo=%d WHERE id_cliente_producto_modulo=%d', $cliente_producto_moduloDTO->getId_cliente_producto(), $cliente_producto_moduloDTO->getId_modulo(), $cliente_producto_moduloDTO->getId_cliente_producto_modulo());
        $result = $this->getConexion()->query($query);
        
        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar update() en cliente_producto_moduloDAO");
        }
    }

    function delete(int $id_cliente_producto_modulo){
        $query = sprintf('DELETE FROM cliente_producto_modulo WHERE id_cliente_producto_modulo=%d', $id_cliente_producto_modulo);
        $result = $this->getConexion()->query($query);
        
        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar delete() en cliente_producto_moduloDAO");
        }
    }
}

?>