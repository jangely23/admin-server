<?php
/*
 Entidad: prodcuto
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/
class productoDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function getById(int $id_producto){
        $query = sprintf("SELECT * FROM producto WHERE id_producto= '%d'", $id_producto);
        $result = $this->getConexion()->query($query);
        
        if ($result){
            if ($result->num_rows != 0 ){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en productoDAO");
        }
    }

    function getAll(string $txt_busqueda=''){
        $sqlBusqueda = '';
        if ($txt_busqueda != ''){
            $sqlBusqueda = sprintf('AND(nombre LIKE "%%%1$s%%" OR version LIKE "%%%1$s%%" OR estado LIKE "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT * FROM producto WHERE 1=1 %s ORDER BY nombre asc", $sqlBusqueda);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAll() en prodcutoDAO");
        }
    }

    function insert(productoDTO $productoDTO){
        $query = sprintf("INSERT INTO producto (nombre, version, estado) VALUES ('%s', '%s', '%s')", $productoDTO->getNombre(), $productoDTO->getVersion(), $productoDTO->getEstado());
        var_dump($query);
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en productoDAO");
        }
    }

    function update(productoDTO $productoDTO){
        $query = sprintf("UPDATE producto SET nombre='%s', version='%s', estado='%s' WHERE id_producto = '%d'",$productoDTO->getNombre(), $productoDTO->getVersion(), $productoDTO->getEstado(), $productoDTO->getId_producto());
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar insert() en productoDAO");
        }
    }

    function delete(int $id_producto){
        $query = sprintf("DELETE FROM producto WHERE id_producto = %d", $id_producto);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar delete() en productoDAO");
        }
    }
}
?>