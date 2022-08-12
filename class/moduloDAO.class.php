<?php

class moduloDAO extends conexion{
    function __construct(mysqli $conexion)  {
        parent::__construct($conexion);
    }

    function getById(int $id_modulo){
        $query = sprintf("SELECT * FROM modulo WHERE id_modulo = '%d'", $id_modulo);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Erro al intentar getById() en moduloDAO()");
        }
    }

    function getAll(){
        $query = "SELECT * FROM modulo ORDER BY nombre, proveedor";
        $result = $this->getConexion()->query($query);

        if ($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAll() en moduloDAO");
        }
    }

    function insert(moduloDTO $moduloDTO){
        $query = sprintf("INSERT INTO modulo (nombre, proveedor) VALUES ('%s', '%s')", $moduloDTO->getNombre(), $moduloDTO->getProveedor());
        $result = $this->getConexion()->query($query);

        if ($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en moduloDAO");
        }
    }

    function update(moduloDTO $moduloDTO){
        $query = sprintf("UPDATE modulo SET nombre ='%s', proveedor = '%s' WHERE id_modulo=%d", $moduloDTO->getNombre(), $moduloDTO->getProveedor(), $moduloDTO->getId_modulo());
        $result = $this->getConexion()->query($query);

        if ($result){
            return $result;
        }else{
            throw new Exception("Error al intentar update() en moduloDAO");
        }
    }

    function delete(int $id_modulo){
        $query = sprintf("DELETE FROM modulo WHERE id_modulo = %d", $id_modulo);
        $result = $this->getConexion()->query($query);

        if ($result){
            return $result;
        }else{
            throw new Exception("Error al intentar delete() en moduloDAO");
        }
    }
}

?>